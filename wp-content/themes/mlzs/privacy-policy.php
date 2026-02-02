<?php
/**
 * Template Name: Privacy Policy Page
 * Used when the page is set as Privacy Policy in Settings > Privacy.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

$hero_heading  = $opt ? get_field('privacy_hero_heading', $page_id) : null;
$hero_subtext  = $opt ? get_field('privacy_hero_subtext', $page_id) : null;
$hero_bg       = $opt ? get_field('privacy_hero_bg_image', $page_id) : null;

$hero_heading  = ($hero_heading !== '' && $hero_heading !== null) ? (string) $hero_heading : get_the_title();
$hero_subtext  = ($hero_subtext !== '' && $hero_subtext !== null) ? (string) $hero_subtext : '';
$hero_bg_url   = (is_array($hero_bg) && !empty($hero_bg['url'])) ? $hero_bg['url'] : get_template_directory_uri() . '/assets/img/skyline.webp';
?>
<main id="content">
    
    <!-- Hero Section -->
    <section class="relative flex items-center justify-center bg-cover bg-center md:bg-fixed px-4 sm:px-6 lg:px-8 overflow-hidden" style="background-image: linear-gradient(135deg, rgba(61,52,139,0.9) 0%, rgba(118,120,237,0.8) 50%, rgba(247,184,1,0.7) 100%), url('<?php echo esc_url($hero_bg_url); ?>');">
        <div class="absolute inset-0 bg-gradient-to-b from-primary/90 via-primary/70 to-primary/50"></div>
        <div class="relative z-10 w-full max-w-7xl mx-auto text-center pt-28 sm:pt-32 pb-12 sm:pb-16">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold text-white leading-[1.1] tracking-tight mb-4 sm:mb-6 max-w-5xl mx-auto drop-shadow-lg px-2">
                <?php echo esc_html($hero_heading); ?>
            </h1>
            <?php if ($hero_subtext !== '') : ?>
            <p class="text-lg md:text-xl text-slate-200 max-w-3xl mx-auto leading-relaxed font-light opacity-95">
                <?php echo esc_html($hero_subtext); ?>
            </p>
            <?php endif; ?>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-background-light to-transparent"></div>
    </section>
    
    <!-- CTA Section -->
    <section class="relative px-4 sm:px-6 lg:px-8 py-12 sm:py-16 md:py-24 overflow-x-hidden">
        <div class="relative z-10 mx-auto max-w-7xl w-full prose prose-slate prose-base sm:prose-lg prose-headings:font-display prose-headings:text-slate-900 prose-a:text-primary prose-a:no-underline hover:prose-a:underline prose-strong:text-slate-900">
        <?php
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
        ?>
        </div>
    </section>
</main>
<?php
get_footer();
