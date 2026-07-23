<?php
/**
 * Blog module: helpers, assets, AJAX smart search, related posts, breadcrumb.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Blog thumbnail size — 1200x630 (40:21, the standard social/OG ratio).
 * Hard-cropped so every card and featured image lines up perfectly.
 */
add_action('after_setup_theme', function () {
    add_image_size('mlzs-blog-thumb', 1200, 630, true);
}, 20);

/**
 * Extract a YouTube video ID from a URL or raw ID.
 */
function mlzs_youtube_id($url) {
    $url = trim((string) $url);
    if ($url === '') {
        return '';
    }
    if (preg_match('~(?:youtu\.be/|youtube\.com/(?:watch\?v=|embed/|shorts/|live/)|v=)([A-Za-z0-9_-]{11})~', $url, $m)) {
        return $m[1];
    }
    if (preg_match('~^[A-Za-z0-9_-]{11}$~', $url)) {
        return $url; // already an ID
    }
    return '';
}

/**
 * Estimated reading time (minutes) from post content.
 */
function mlzs_reading_time($post = null) {
    $post = get_post($post);
    if (!$post) {
        return 1;
    }
    $words = str_word_count(wp_strip_all_tags($post->post_content));
    return max(1, (int) ceil($words / 200));
}

/**
 * Featured image URL with a graceful fallback to the theme campus image.
 */
function mlzs_post_image_url($post_id = null, $size = 'large') {
    $post_id = $post_id ? $post_id : get_the_ID();
    $url = get_the_post_thumbnail_url($post_id, $size);
    if (!$url) {
        $url = get_template_directory_uri() . '/assets/img/skyline.webp';
    }
    return $url;
}

/**
 * First (primary) category of a post, or null.
 */
function mlzs_primary_category($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    $cats = get_the_category($post_id);
    return !empty($cats) ? $cats[0] : null;
}

/**
 * Permalink of the Blog listing page (slug "blog").
 */
function mlzs_blog_url() {
    $page = get_page_by_path('blog');
    return $page ? get_permalink($page->ID) : home_url('/blog/');
}

/**
 * Render one blog card (call inside the loop).
 */
function mlzs_the_blog_card() {
    get_template_part('template-parts/blog-card');
}

/**
 * True on any blog-related view.
 */
function mlzs_is_blog_context() {
    return is_singular('post') || is_home() || is_search() || is_category() || is_tag()
        || is_author() || is_date() || is_page_template('page-blog.php');
}

/**
 * Enqueue blog JS (smart search / filter) only on blog contexts.
 */
function mlzs_blog_assets() {
    if (!mlzs_is_blog_context()) {
        return;
    }
    $ver = wp_get_theme()->get('Version') ?: '1.0.0';
    wp_enqueue_style('mlzs-blog', get_template_directory_uri() . '/assets/css/blog.css', array('mlzs-custom'), $ver);
    wp_enqueue_script('mlzs-blog', get_template_directory_uri() . '/assets/Js/blog.js', array('mlzs-main', 'lucide-icons'), $ver, true);
    wp_localize_script('mlzs-blog', 'mlzsBlog', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('mlzs_blog_search'),
    ));
}
add_action('wp_enqueue_scripts', 'mlzs_blog_assets', 20);

/**
 * AJAX smart search: returns rendered cards + result count.
 */
function mlzs_ajax_blog_search() {
    check_ajax_referer('mlzs_blog_search', 'nonce');

    $q   = isset($_POST['q']) ? sanitize_text_field(wp_unslash($_POST['q'])) : '';
    $cat = isset($_POST['cat']) ? sanitize_title(wp_unslash($_POST['cat'])) : '';

    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 12,
        'ignore_sticky_posts' => true,
    );
    if ($q !== '') {
        $args['s'] = $q;
    }
    if ($cat !== '' && $cat !== 'all') {
        $args['category_name'] = $cat;
    }

    $query = new WP_Query($args);

    ob_start();
    if ($query->have_posts()) {
        echo '<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">';
        while ($query->have_posts()) {
            $query->the_post();
            mlzs_the_blog_card();
        }
        echo '</div>';
    } else {
        echo mlzs_blog_empty_state($q);
    }
    wp_reset_postdata();
    $html = ob_get_clean();

    wp_send_json_success(array(
        'html'  => $html,
        'count' => (int) $query->found_posts,
    ));
}
add_action('wp_ajax_mlzs_blog_search', 'mlzs_ajax_blog_search');
add_action('wp_ajax_nopriv_mlzs_blog_search', 'mlzs_ajax_blog_search');

/**
 * Friendly empty-state markup for the blog grid.
 */
function mlzs_blog_empty_state($query = '') {
    $msg = $query !== ''
        ? sprintf(esc_html__('No articles matched “%s”. Try another search or browse a category below.', 'mlzs'), esc_html($query))
        : esc_html__('No articles here yet. Please check back soon.', 'mlzs');
    return '<div class="bg-white rounded-2xl p-10 border border-gray-100 shadow-soft text-center">'
        . '<div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-primary/10 flex items-center justify-center"><i data-lucide="search-x" class="w-7 h-7 text-primary"></i></div>'
        . '<p class="text-gray-600 max-w-md mx-auto">' . $msg . '</p></div>';
}

/**
 * Related posts by shared category (falls back to recent).
 */
function mlzs_related_posts($post_id, $limit = 3) {
    $cats = wp_get_post_categories($post_id);
    $args = array(
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'posts_per_page'      => $limit,
        'post__not_in'        => array($post_id),
        'orderby'             => 'date',
        'order'               => 'DESC',
        'ignore_sticky_posts' => true,
    );
    if (!empty($cats)) {
        $args['category__in'] = $cats;
    }
    return new WP_Query($args);
}

/**
 * Self-contained breadcrumb (works without Yoast breadcrumb settings).
 * Yoast still outputs BreadcrumbList schema separately in the head.
 */
function mlzs_breadcrumb() {
    $sep  = '<span class="opacity-40 mx-2" aria-hidden="true">/</span>';
    $link = 'hover:text-accent transition-colors';
    echo '<nav class="flex items-center flex-wrap gap-y-1 text-sm text-white/85" aria-label="Breadcrumb">';
    echo '<a href="' . esc_url(home_url('/')) . '" class="' . $link . '">' . esc_html__('Home', 'mlzs') . '</a>';
    echo $sep . '<a href="' . esc_url(mlzs_blog_url()) . '" class="' . $link . '">' . esc_html__('Blog', 'mlzs') . '</a>';

    if (is_singular('post')) {
        $cat = mlzs_primary_category(get_the_ID());
        if ($cat) {
            echo $sep . '<a href="' . esc_url(get_category_link($cat->term_id)) . '" class="' . $link . '">' . esc_html($cat->name) . '</a>';
        }
        echo $sep . '<span class="text-white font-medium" aria-current="page">' . esc_html(wp_trim_words(get_the_title(), 8, '…')) . '</span>';
    } elseif (is_category()) {
        echo $sep . '<span class="text-white font-medium" aria-current="page">' . esc_html(single_cat_title('', false)) . '</span>';
    } elseif (is_tag()) {
        echo $sep . '<span class="text-white font-medium" aria-current="page">#' . esc_html(single_tag_title('', false)) . '</span>';
    } elseif (is_search()) {
        echo $sep . '<span class="text-white font-medium" aria-current="page">' . esc_html__('Search', 'mlzs') . '</span>';
    }
    echo '</nav>';
}

/**
 * Category filter chips (used on the listing + archive heroes).
 */
function mlzs_category_chips($active_slug = 'all') {
    $cats = get_terms(array('taxonomy' => 'category', 'hide_empty' => true, 'orderby' => 'name'));
    if (is_wp_error($cats) || empty($cats)) {
        return;
    }
    $base = 'px-4 py-2 rounded-full text-sm font-semibold transition-all whitespace-nowrap border';
    $on   = 'bg-primary text-white border-primary shadow-glow';
    $off  = 'bg-white text-gray-700 border-gray-200 hover:border-primary hover:text-primary';
    echo '<div class="flex flex-wrap items-center justify-center gap-2">';
    printf(
        '<a href="%s" data-cat="all" class="mlzs-cat-chip %s %s">%s</a>',
        esc_url(mlzs_blog_url()),
        esc_attr($base),
        $active_slug === 'all' ? esc_attr($on) : esc_attr($off),
        esc_html__('All', 'mlzs')
    );
    foreach ($cats as $c) {
        printf(
            '<a href="%s" data-cat="%s" class="mlzs-cat-chip %s %s">%s</a>',
            esc_url(get_category_link($c->term_id)),
            esc_attr($c->slug),
            esc_attr($base),
            $active_slug === $c->slug ? esc_attr($on) : esc_attr($off),
            esc_html($c->name)
        );
    }
    echo '</div>';
}

/**
 * Excerpt tuning for cards.
 */
add_filter('excerpt_length', function ($len) {
    return 28;
}, 20);
add_filter('excerpt_more', function ($more) {
    return '…';
});

/* ---------------------------------------------------------------------------
 * Article content processing: heading anchors (for the Table of Contents)
 * and internal / external link marking.
 * ------------------------------------------------------------------------- */

$GLOBALS['mlzs_toc_items']   = array();
$GLOBALS['mlzs_faq_items']   = array();
$GLOBALS['mlzs_faq_heading'] = '';
$GLOBALS['mlzs_faq_id']      = '';

/**
 * Adds ids to h2/h3, collects the TOC, and tags links as internal/external.
 * Call via apply_filters('the_content', ...) once, then read mlzs_get_toc().
 */
function mlzs_process_article_content($content) {
    if (!is_singular('post') || trim((string) $content) === '') {
        return $content;
    }

    $GLOBALS['mlzs_toc_items'] = array();
    $home_host = strtolower((string) wp_parse_url(home_url(), PHP_URL_HOST));

    $prev = libxml_use_internal_errors(true);
    $dom  = new DOMDocument('1.0', 'UTF-8');
    $ok   = $dom->loadHTML(
        '<?xml encoding="utf-8" ?><div id="mlzs-root">' . $content . '</div>',
        LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
    );
    libxml_clear_errors();
    libxml_use_internal_errors($prev);
    if (!$ok) {
        return $content;
    }

    $xpath = new DOMXPath($dom);

    // Heading anchors + TOC
    $used = array();
    foreach ($xpath->query('//h2|//h3') as $h) {
        $text = trim(preg_replace('/\s+/', ' ', $h->textContent));
        if ($text === '') {
            continue;
        }
        $id = $h->getAttribute('id');
        if ($id === '') {
            $base = sanitize_title($text);
            if ($base === '') {
                $base = 'section';
            }
            $id = $base;
            $n  = 2;
            while (isset($used[$id])) {
                $id = $base . '-' . $n;
                $n++;
            }
            $h->setAttribute('id', $id);
        }
        $used[$id] = true;
        $GLOBALS['mlzs_toc_items'][] = array(
            'id'    => $id,
            'text'  => $text,
            'level' => (int) substr($h->nodeName, 1),
        );
    }

    // Internal vs external links
    foreach ($xpath->query('//a[@href]') as $a) {
        $href = trim($a->getAttribute('href'));
        if ($href === '' || $href[0] === '#'
            || stripos($href, 'mailto:') === 0
            || stripos($href, 'tel:') === 0) {
            continue;
        }
        $host     = strtolower((string) wp_parse_url($href, PHP_URL_HOST));
        $external = ($host !== '' && $host !== $home_host);
        $class    = trim($a->getAttribute('class') . ' ' . ($external ? 'mlzs-link mlzs-link--ext' : 'mlzs-link'));
        $a->setAttribute('class', $class);
        if ($external) {
            $a->setAttribute('target', '_blank');
            $a->setAttribute('rel', 'noopener noreferrer');
        }
    }

    // Wrap tables so they scroll horizontally on small screens
    foreach (iterator_to_array($xpath->query('//table')) as $table) {
        $parent = $table->parentNode;
        if (!$parent) {
            continue;
        }
        if ($parent->nodeName === 'div' && strpos((string) $parent->getAttribute('class'), 'mlzs-table-wrap') !== false) {
            continue;
        }
        $wrap = $dom->createElement('div');
        $wrap->setAttribute('class', 'mlzs-table-wrap');
        $parent->replaceChild($wrap, $table);
        $wrap->appendChild($table);
    }

    // Pull an "FAQs" section out of the content so it can render as an accordion.
    // Runs before the conclusion wrap so the conclusion never swallows the FAQs.
    $faq_h = null;
    foreach ($xpath->query('//h2') as $h) {
        if (preg_match('/^\s*(faq\'?s?|frequently asked questions)\b/i', trim($h->textContent))) {
            $faq_h = $h;
            break;
        }
    }
    if ($faq_h) {
        $items  = array();
        $cur    = null;
        $remove = array($faq_h);
        $node   = $faq_h->nextSibling;
        while ($node) {
            if ($node->nodeType === XML_ELEMENT_NODE) {
                $name = strtolower($node->nodeName);
                if ($name === 'h2') {
                    break; // next section starts
                }
                $text = trim(preg_replace('/\s+/', ' ', $node->textContent));
                if ($name === 'h3' || $name === 'h4') {
                    if ($cur) { $items[] = $cur; }
                    $cur = array('q' => $text, 'a' => '');
                } elseif ($name === 'ol' || $name === 'ul') {
                    $lis = $node->getElementsByTagName('li');
                    if ($lis->length) {
                        if ($cur) { $items[] = $cur; }
                        $cur = array('q' => trim(preg_replace('/\s+/', ' ', $lis->item(0)->textContent)), 'a' => '');
                    }
                } elseif ($cur !== null && $text !== '') {
                    $inner = '';
                    foreach ($node->childNodes as $ch) {
                        $inner .= $dom->saveHTML($ch);
                    }
                    $cur['a'] .= ($name === 'p') ? '<p>' . $inner . '</p>' : $dom->saveHTML($node);
                }
            }
            $remove[] = $node;
            $node = $node->nextSibling;
        }
        if ($cur) { $items[] = $cur; }

        if (!empty($items)) {
            $GLOBALS['mlzs_faq_items']   = $items;
            $GLOBALS['mlzs_faq_heading'] = trim(preg_replace('/\s+/', ' ', $faq_h->textContent));
            $GLOBALS['mlzs_faq_id']      = $faq_h->getAttribute('id');
            foreach ($remove as $n) {
                if ($n->parentNode) {
                    $n->parentNode->removeChild($n);
                }
            }
        }
    }

    // Give the closing section ("Conclusion", "Key takeaways"…) its own designed block
    $conclusion = null;
    foreach ($xpath->query('//h2') as $h) {
        if (preg_match('/\b(conclusion|final thoughts?|in summary|summary|key takeaways?|wrapping up|bottom line|to sum up)\b/i', $h->textContent)) {
            $conclusion = $h;
            break;
        }
    }
    if ($conclusion && $conclusion->parentNode) {
        $wrap = $dom->createElement('div');
        $wrap->setAttribute('class', 'mlzs-conclusion');
        $conclusion->parentNode->insertBefore($wrap, $conclusion);
        $node = $conclusion;
        while ($node) {
            $next = $node->nextSibling;
            $wrap->appendChild($node);
            $node = $next;
        }
    }

    $roots = $xpath->query('//div[@id="mlzs-root"]');
    if (!$roots->length) {
        return $content;
    }
    $html = '';
    foreach ($roots->item(0)->childNodes as $child) {
        $html .= $dom->saveHTML($child);
    }
    return $html !== '' ? $html : $content;
}
add_filter('the_content', 'mlzs_process_article_content', 12);

/** TOC items collected from the last processed article. */
function mlzs_get_toc() {
    return isset($GLOBALS['mlzs_toc_items']) ? $GLOBALS['mlzs_toc_items'] : array();
}

/** Render the Table of Contents (returns '' when there aren't enough sections). */
function mlzs_render_toc($class = '') {
    $items = mlzs_get_toc();
    if (count($items) < 2) {
        return '';
    }
    ob_start(); ?>
    <nav class="mlzs-toc <?php echo esc_attr($class); ?>" aria-label="<?php esc_attr_e('Table of contents', 'mlzs'); ?>">
        <p class="mlzs-toc__title"><i data-lucide="list" class="w-4 h-4"></i><?php esc_html_e('On this page', 'mlzs'); ?></p>
        <ol class="mlzs-toc__list">
            <?php foreach ($items as $item) : ?>
            <li class="mlzs-toc__item mlzs-toc__item--h<?php echo (int) $item['level']; ?>">
                <a href="#<?php echo esc_attr($item['id']); ?>" data-toc-link="<?php echo esc_attr($item['id']); ?>"><?php echo esc_html($item['text']); ?></a>
            </li>
            <?php endforeach; ?>
        </ol>
    </nav>
    <?php
    return trim(ob_get_clean());
}

/* ---------------------------------------------------------------------------
 * FAQs — from ACF fields, or auto-detected from an "FAQs" section in the content.
 * ------------------------------------------------------------------------- */

/**
 * FAQ list for the current post: ACF repeater first, otherwise the section
 * extracted from the post content. Each item is array('q' => ..., 'a' => html).
 */
function mlzs_get_faqs() {
    if (function_exists('get_field')) {
        $rows = get_field('blog_faqs', get_the_ID());
        if (is_array($rows) && !empty($rows)) {
            $out = array();
            foreach ($rows as $row) {
                $q = isset($row['faq_question']) ? trim((string) $row['faq_question']) : '';
                $a = isset($row['faq_answer']) ? trim((string) $row['faq_answer']) : '';
                if ($q !== '') {
                    $out[] = array('q' => $q, 'a' => $a);
                }
            }
            if (!empty($out)) {
                return $out;
            }
        }
    }
    return !empty($GLOBALS['mlzs_faq_items']) ? $GLOBALS['mlzs_faq_items'] : array();
}

/** Heading shown above the FAQ accordion. */
function mlzs_faq_heading() {
    if (function_exists('get_field')) {
        $h = trim((string) get_field('faq_heading', get_the_ID()));
        if ($h !== '') {
            return $h;
        }
    }
    if (!empty($GLOBALS['mlzs_faq_heading'])) {
        return $GLOBALS['mlzs_faq_heading'];
    }
    return __('Frequently Asked Questions', 'mlzs');
}

/** Anchor id used by the FAQ section (and the TOC link). */
function mlzs_faq_anchor() {
    return !empty($GLOBALS['mlzs_faq_id']) ? $GLOBALS['mlzs_faq_id'] : 'faqs';
}

/** Make sure the FAQ section appears in the Table of Contents. */
function mlzs_register_faq_toc() {
    if (!mlzs_get_faqs()) {
        return;
    }
    $id = mlzs_faq_anchor();
    foreach ($GLOBALS['mlzs_toc_items'] as $item) {
        if ($item['id'] === $id) {
            return; // already there (came from the content)
        }
    }
    $GLOBALS['mlzs_toc_items'][] = array('id' => $id, 'text' => mlzs_faq_heading(), 'level' => 2);
}

/**
 * Render the FAQ accordion + FAQPage structured data.
 * Note: Google restricts FAQ *rich results* to government/health sites, but the
 * markup still helps AI search engines understand the Q&A.
 */
function mlzs_render_faqs() {
    $items = mlzs_get_faqs();
    if (empty($items)) {
        return '';
    }
    $id      = mlzs_faq_anchor();
    $heading = mlzs_faq_heading();

    $schema = array('@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => array());
    foreach ($items as $item) {
        $schema['mainEntity'][] = array(
            '@type'          => 'Question',
            'name'           => wp_strip_all_tags($item['q']),
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text'  => trim(wp_strip_all_tags($item['a'])),
            ),
        );
    }

    ob_start(); ?>
    <section class="mlzs-faq" id="<?php echo esc_attr($id); ?>" aria-labelledby="<?php echo esc_attr($id); ?>-title">
        <div class="mlzs-faq__head">
            <span class="mlzs-faq__badge"><i data-lucide="help-circle" class="w-4 h-4"></i><?php esc_html_e('FAQ', 'mlzs'); ?></span>
            <h2 class="mlzs-faq__title" id="<?php echo esc_attr($id); ?>-title"><?php echo esc_html($heading); ?></h2>
        </div>
        <div class="mlzs-faq__list" data-mlzs-accordion>
            <?php foreach ($items as $i => $item) : ?>
            <?php // name="" makes browsers treat these as one exclusive accordion; JS below covers older browsers ?>
            <details class="mlzs-faq__item" name="mlzs-faq-<?php echo esc_attr($id); ?>"<?php echo $i === 0 ? ' open' : ''; ?>>
                <summary class="mlzs-faq__q">
                    <span class="mlzs-faq__num"><?php echo esc_html($i + 1); ?></span>
                    <span class="mlzs-faq__qtext"><?php echo esc_html($item['q']); ?></span>
                    <i data-lucide="chevron-down" class="mlzs-faq__chev w-5 h-5"></i>
                </summary>
                <div class="mlzs-faq__a"><?php echo wp_kses_post($item['a']); ?></div>
            </details>
            <?php endforeach; ?>
        </div>
    </section>
    <script type="application/ld+json"><?php echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>
    <?php
    return trim(ob_get_clean());
}

/**
 * Repair responsive-image srcset when an attachment's metadata "file" lost its
 * date-folder path (a common artifact of migrated / WebP-converted media).
 * Without this, srcset URLs drop the /YYYY/MM/ folder and 404, so inserted
 * content images fail to load even though the main src is correct.
 */
add_filter('wp_calculate_image_srcset_meta', function ($image_meta, $size_array, $image_src, $attachment_id) {
    if (!empty($image_meta['file']) && dirname($image_meta['file']) === '.') {
        $attached = get_post_meta($attachment_id, '_wp_attached_file', true);
        if ($attached && dirname($attached) !== '.') {
            $image_meta['file'] = $attached;
        }
    }
    return $image_meta;
}, 10, 4);
