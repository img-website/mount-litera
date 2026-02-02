<?php
/**
 * Template Name: Sitemap Page
 * User-facing HTML sitemap (Hero + search + pages with Yoast meta). Yoast SEO XML sitemap is separate; no conflict.
 */
if (!defined('ABSPATH')) exit;
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge = $opt ? get_field('sitemap_hero_badge', $page_id) : null;
$hero_headline = $opt ? get_field('sitemap_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('sitemap_hero_highlight', $page_id) : null;
$hero_subtext = $opt ? get_field('sitemap_hero_subtext', $page_id) : null;
$hero_badge = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Site Map';
$hero_headline = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'Site';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Map';
$hero_subtext = ($hero_subtext !== '' && $hero_subtext !== null) ? (string) $hero_subtext : 'Explore all pages of Mount Litera Zee School website. Find information about academics, facilities, admissions, and more.';

// ——— All published pages (flat list for search; exclude this sitemap page) ———
$all_pages = get_pages(array(
    'post_type'   => 'page',
    'post_status' => 'publish',
    'sort_column' => 'menu_order',
    'sort_order'  => 'ASC',
    'exclude'     => array($page_id),
));

/**
 * Get page meta: page name, Yoast title (as sitemap description), image URL.
 */
function mlzs_sitemap_page_meta($p) {
    $id = (int) $p->ID;
    // Page name (first/top) – post title
    $page_name = get_the_title($p);
    // Description (below page name) – Yoast meta title
    $desc = get_post_meta($id, '_yoast_wpseo_title', true);
    if (empty($desc)) {
        $desc = get_post_meta($id, '_yoast_wpseo_metadesc', true);
    }
    if (empty($desc) && !empty($p->post_excerpt)) {
        $desc = $p->post_excerpt;
    }
    if (empty($desc)) {
        $desc = wp_trim_words(wp_strip_all_tags($p->post_content), 25);
    }
    // Image: Yoast OG image (ID or URL) or featured image
    $img_url = '';
    $img_id = get_post_meta($id, '_yoast_wpseo_opengraph-image-id', true);
    if (!empty($img_id) && is_numeric($img_id)) {
        $img_url = wp_get_attachment_image_url((int) $img_id, 'medium');
    }
    if (empty($img_url)) {
        $img_url = get_post_meta($id, '_yoast_wpseo_opengraph-image', true);
    }
    if (empty($img_url)) {
        $img_id = get_post_thumbnail_id($id);
        if ($img_id) {
            $img_url = wp_get_attachment_image_url($img_id, 'medium');
        }
    }
    return array(
        'page_name' => $page_name,
        'desc'      => $desc,
        'img'       => $img_url,
    );
}
?>
    <!-- Hero -->
    <section class="relative bg-gradient-to-br from-primary via-primary-dark to-slate-900 text-white overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-20"></div>
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-accent/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-primary-light/10 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-20 md:pt-40 md:pb-28">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-6">
                    <i data-lucide="map" class="w-4 h-4 sm:w-5 sm:h-5 text-accent"></i>
                    <span class="text-xs sm:text-sm font-bold text-white uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold mb-6 leading-tight">
                    <?php echo esc_html($hero_headline); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame via-tiger-orange to-cayenne-red"><?php echo esc_html($hero_highlight); ?></span>
                </h1>
                <p class="text-sm sm:text-base md:text-lg lg:text-xl text-slate-200 mb-8 max-w-2xl leading-relaxed">
                    <?php echo esc_html($hero_subtext); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content: search bar + all pages -->
    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Search bar -->
            <div class="mb-10">
                <label for="sitemap-search" class="sr-only"><?php esc_html_e('Search pages', 'mlzs'); ?></label>
                <div class="relative">
                    <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                    <input type="text" id="sitemap-search" placeholder="<?php esc_attr_e('Search pages by title or description...', 'mlzs'); ?>" class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all text-slate-800" autocomplete="off" />
                    <span id="sitemap-no-results" class="hidden absolute right-4 top-1/2 -translate-y-1/2 text-sm text-slate-500"><?php esc_html_e('No matches', 'mlzs'); ?></span>
                </div>
            </div>

            <!-- Page cards grid (filterable) -->
            <div id="sitemap-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                if (!empty($all_pages)) :
                    foreach ($all_pages as $p) :
                        $url = get_permalink($p);
                        $meta = mlzs_sitemap_page_meta($p);
                        $search_text = strtolower($meta['page_name'] . ' ' . $meta['desc'] . ' ' . $p->post_name);
                ?>
                <div class="sitemap-card group bg-white border border-slate-200 rounded-2xl overflow-hidden hover:border-primary hover:shadow-lg transition-all duration-300" data-search="<?php echo esc_attr($search_text); ?>">
                    <div class="flex flex-col h-full">
                        <?php if (!empty($meta['img'])) : ?>
                        <div class="aspect-video bg-slate-100 overflow-hidden">
                            <img src="<?php echo esc_url($meta['img']); ?>" alt="" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy" />
                        </div>
                        <?php else : ?>
                        <div class="aspect-video bg-primary/5 flex items-center justify-center">
                            <i data-lucide="file-text" class="w-12 h-12 text-primary/40"></i>
                        </div>
                        <?php endif; ?>
                        <div class="p-5 flex flex-col flex-1">
                            <h2 class="text-lg font-bold text-slate-900 group-hover:text-primary transition-colors mb-2"><?php echo esc_html($meta['page_name']); ?></h2>
                            <?php if (!empty($meta['desc'])) : ?>
                            <p class="text-sm text-slate-600 mb-4 flex-1 line-clamp-2"><?php echo esc_html($meta['desc']); ?></p>
                            <?php else : ?>
                            <p class="text-sm text-slate-500 mb-4 flex-1"><?php echo esc_html($p->post_name); ?></p>
                            <?php endif; ?>
                            <a href="<?php echo esc_url($url); ?>" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-primary text-white font-medium text-sm hover:bg-primary-dark transition-colors w-fit">
                                <span><?php esc_html_e('View Page', 'mlzs'); ?></span>
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
                    endforeach;
                else :
                ?>
                <p class="text-slate-600 col-span-full"><?php esc_html_e('No published pages to display.', 'mlzs'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <script>
    (function() {
        var search = document.getElementById('sitemap-search');
        var cards = document.querySelectorAll('.sitemap-card');
        var noResults = document.getElementById('sitemap-no-results');
        if (!search || !cards.length) return;
        search.addEventListener('input', function() {
            var q = (this.value || '').toLowerCase().trim();
            var visible = 0;
            cards.forEach(function(card) {
                var text = (card.getAttribute('data-search') || '').toLowerCase();
                var show = !q || text.indexOf(q) !== -1;
                card.style.display = show ? '' : 'none';
                if (show) visible++;
            });
            noResults.classList.toggle('hidden', visible > 0 || !q);
        });
    })();
    </script>
<?php get_footer(); ?>
