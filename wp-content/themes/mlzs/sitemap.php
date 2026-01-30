<?php
/**
 * Template Name: Sitemap Page
 * User-facing HTML sitemap (Hero + sections with links). Yoast SEO XML sitemap is separate; no conflict.
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

// ——— All published pages (auto; exclude this sitemap page) ———
$all_pages = get_pages(array(
    'post_type'   => 'page',
    'post_status' => 'publish',
    'sort_column' => 'menu_order',
    'sort_order'  => 'ASC',
    'exclude'     => array($page_id),
));
$by_parent = array();
foreach ($all_pages as $p) {
    $pid = (int) $p->post_parent;
    if (!isset($by_parent[$pid])) $by_parent[$pid] = array();
    $by_parent[$pid][] = $p;
}
$icon_style_classes = array(
    'primary' => 'bg-primary/10 text-primary',
    'green'   => 'bg-green-100 text-green-600',
    'blue'    => 'bg-blue-100 text-blue-600',
    'purple'  => 'bg-purple-100 text-purple-600',
    'amber'   => 'bg-amber-100 text-amber-600',
);
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

    <!-- Main Content: all published pages (auto) -->
    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php
            $style_keys = array_keys($icon_style_classes);
            $style_index = 0;
            // Top-level pages
            if (!empty($by_parent[0])) :
                $sec_style = $icon_style_classes[$style_keys[$style_index % count($style_keys)]];
                $style_index++;
            ?>
            <div class="mb-16">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-12 h-12 rounded-lg <?php echo esc_attr($sec_style); ?> flex items-center justify-center">
                        <i data-lucide="layout" class="w-6 h-6"></i>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-900"><?php esc_html_e('Pages', 'mlzs'); ?></h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php foreach ($by_parent[0] as $p) :
                        $url = get_permalink($p);
                        $title = get_the_title($p);
                    ?>
                    <a href="<?php echo esc_url($url); ?>" class="group p-6 bg-white border border-slate-200 rounded-2xl hover:border-primary hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-colors">
                                <i data-lucide="file-text" class="w-5 h-5 text-primary group-hover:text-white"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-primary transition-colors"><?php echo esc_html($title); ?></h3>
                        </div>
                        <p class="text-sm text-slate-600"><?php echo esc_html($p->post_name); ?></p>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif;

            // Child pages grouped by parent
            if (!empty($by_parent[0])) {
                foreach ($by_parent[0] as $parent_page) {
                    $pid = (int) $parent_page->ID;
                    if (empty($by_parent[$pid])) continue;
                    $sec_style = $icon_style_classes[$style_keys[$style_index % count($style_keys)]];
                    $style_index++;
                    ?>
            <div class="mb-16">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-12 h-12 rounded-lg <?php echo esc_attr($sec_style); ?> flex items-center justify-center">
                        <i data-lucide="folder" class="w-6 h-6"></i>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-900"><?php echo esc_html(get_the_title($parent_page)); ?></h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php foreach ($by_parent[$pid] as $p) :
                        $url = get_permalink($p);
                        $title = get_the_title($p);
                    ?>
                    <a href="<?php echo esc_url($url); ?>" class="group p-6 bg-white border border-slate-200 rounded-2xl hover:border-primary hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-colors">
                                <i data-lucide="file-text" class="w-5 h-5 text-primary group-hover:text-white"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-primary transition-colors"><?php echo esc_html($title); ?></h3>
                        </div>
                        <p class="text-sm text-slate-600"><?php echo esc_html($p->post_name); ?></p>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
                    <?php
                }
            }

            if (empty($all_pages)) : ?>
            <p class="text-slate-600"><?php esc_html_e('No published pages to display.', 'mlzs'); ?></p>
            <?php endif; ?>
        </div>
    </section>

<?php get_footer(); ?>
