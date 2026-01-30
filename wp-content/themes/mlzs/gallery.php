<?php
/**
 * Template Name: Photo Gallery Page
 * Gallery: Hero, Masonry photo gallery – ACF dynamic
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$theme_uri = get_template_directory_uri();
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge     = $opt ? get_field('gallery_hero_badge', $page_id) : null;
$hero_icon      = $opt ? get_field('gallery_hero_icon', $page_id) : null;
$hero_headline  = $opt ? get_field('gallery_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('gallery_hero_highlight', $page_id) : null;
$hero_sub       = $opt ? get_field('gallery_hero_subheadline', $page_id) : null;

$hero_badge     = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Memories';
$hero_icon      = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'images';
$hero_headline  = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'Photo';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Gallery';
$hero_sub       = ($hero_sub !== '' && $hero_sub !== null) ? (string) $hero_sub : 'Capturing moments of excellence, creativity, and achievement at Mount Litera Zee School';

// ——— Gallery images (ACF Gallery returns array of attachment IDs) ———
$gallery_images = $opt ? get_field('gallery_images', $page_id) : null;
$gallery_images = is_array($gallery_images) ? $gallery_images : array();
?>

<style>
/* Masonry layout – matches gallery.html */
.masonry-grid {
    column-count: 2;
    column-gap: 0.5rem;
}
@media (min-width: 640px) {
    .masonry-grid {
        column-count: 3;
        column-gap: 0.75rem;
    }
}
@media (min-width: 768px) {
    .masonry-grid {
        column-count: 4;
        column-gap: 1rem;
    }
}
@media (min-width: 1024px) {
    .masonry-grid {
        column-count: 5;
        column-gap: 1rem;
    }
}
.masonry-item {
    display: inline-block;
    width: 100%;
    margin-bottom: 0.5rem;
    break-inside: avoid;
    page-break-inside: avoid;
}
@media (min-width: 640px) {
    .masonry-item {
        margin-bottom: 0.75rem;
    }
}
@media (min-width: 768px) {
    .masonry-item {
        margin-bottom: 1rem;
    }
}
@keyframes blink {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.7; transform: scale(1.1); }
}
.masonry-item:hover .play-icon {
    animation: blink 1.5s ease-in-out infinite;
}
</style>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary via-primary-dark to-slate-900 px-4 sm:px-6 lg:px-8 pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')]"></div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-accent/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="relative z-10 max-w-7xl mx-auto">
            <div class="text-center text-white">
                <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-white/20 backdrop-blur-md border border-white/30 mb-4 sm:mb-6 animate-fade-in-up">
                    <i data-lucide="<?php echo esc_attr($hero_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 text-accent"></i>
                    <span class="text-xs sm:text-sm font-semibold uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold mb-4 sm:mb-6 tracking-tight">
                    <?php echo esc_html($hero_headline); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame to-tiger-orange"><?php echo esc_html($hero_highlight); ?></span>
                </h1>
                <p class="text-sm sm:text-base md:text-lg lg:text-xl text-slate-200 max-w-3xl mx-auto leading-relaxed">
                    <?php echo esc_html($hero_sub); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="relative bg-background-light px-4 sm:px-6 lg:px-8 py-12 sm:py-16 md:py-20">
        <div class="max-w-7xl mx-auto">
            <div class="masonry-grid" id="gallery-grid">
                <?php
                foreach ($gallery_images as $index => $attachment_id) {
                    $attachment_id = (int) $attachment_id;
                    if ($attachment_id <= 0) continue;
                    $full_url = wp_get_attachment_image_url($attachment_id, 'full');
                    $alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
                    if (empty($alt)) $alt = sprintf(__('Gallery Image %d', 'mlzs'), $index + 1);
                    if (!$full_url) continue;
                ?>
                <a href="<?php echo esc_url($full_url); ?>"
                   data-fancybox="gallery"
                   data-caption="<?php echo esc_attr($alt); ?>"
                   class="masonry-item group relative overflow-hidden rounded-lg sm:rounded-xl bg-gray-100 hover:scale-105 transition-transform duration-300 cursor-pointer block">
                    <img src="<?php echo esc_url($full_url); ?>"
                         alt="<?php echo esc_attr($alt); ?>"
                         class="w-full h-auto object-cover group-hover:opacity-90 transition-opacity"
                         loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-br from-black/40 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <i data-lucide="play" class="play-icon w-12 h-12 sm:w-14 sm:h-14 text-white bg-white/20 rounded-full p-3 backdrop-blur-sm"></i>
                    </div>
                </a>
                <?php } ?>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
