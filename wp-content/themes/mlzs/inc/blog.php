<?php
/**
 * Blog module: helpers, assets, AJAX smart search, related posts, breadcrumb.
 */

if (!defined('ABSPATH')) {
    exit;
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
