<?php
/**
 * Template Name: School Cafe Page
 * Cafe: Hero, Overview (ACF dynamic)
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge    = $opt ? get_field('cafe_hero_badge', $page_id) : null;
$hero_icon     = $opt ? get_field('cafe_hero_badge_icon', $page_id) : null;
$hero_headline = $opt ? get_field('cafe_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('cafe_hero_highlight', $page_id) : null;
$hero_sub      = $opt ? get_field('cafe_hero_subheadline', $page_id) : null;

$hero_badge    = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Campus Dining';
$hero_icon     = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'coffee';
$hero_headline = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'School';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Cafe';
$hero_sub      = ($hero_sub !== '' && $hero_sub !== null) ? (string) $hero_sub : 'A welcoming space for students to relax, refuel, and connect over nutritious meals and refreshments';

// ——— Overview ———
$overview_badge   = $opt ? get_field('cafe_overview_badge', $page_id) : null;
$overview_heading = $opt ? get_field('cafe_overview_heading', $page_id) : null;
$overview_desc    = $opt ? get_field('cafe_overview_description', $page_id) : null;
$_overview_img    = $opt ? get_field('cafe_overview_image', $page_id) : null;
$overview_card_title = $opt ? get_field('cafe_overview_card_title', $page_id) : null;
$overview_card_label = $opt ? get_field('cafe_overview_card_label', $page_id) : null;

$overview_badge   = ($overview_badge !== '' && $overview_badge !== null) ? (string) $overview_badge : 'Dining Experience';
$overview_heading = ($overview_heading !== '' && $overview_heading !== null) ? (string) $overview_heading : 'More Than Just Food';
$overview_desc    = ($overview_desc !== '' && $overview_desc !== null) ? (string) $overview_desc : "Our school cafe provides a comfortable and welcoming environment where students can enjoy nutritious meals, healthy snacks, and refreshing beverages. It serves as a social hub where students can relax, connect with friends, and recharge during breaks.\n\nWe prioritize health and nutrition, offering a variety of balanced meal options that cater to different dietary preferences and requirements.";
$overview_img = '';
if (is_array($_overview_img) && !empty($_overview_img['url'])) $overview_img = (string) $_overview_img['url'];
elseif (is_string($_overview_img) && $_overview_img !== '') $overview_img = (string) $_overview_img;
if ($overview_img === '') $overview_img = 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80';
$overview_card_title = ($overview_card_title !== '' && $overview_card_title !== null) ? (string) $overview_card_title : 'Fresh';
$overview_card_label = ($overview_card_label !== '' && $overview_card_label !== null) ? (string) $overview_card_label : 'Daily Meals';
?>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary via-primary-dark to-slate-900 px-4 sm:px-6 lg:px-8 pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')]"></div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-accent/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="relative z-10 max-w-7xl mx-auto">
            <div class="text-center text-white">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 backdrop-blur-md border border-white/30 mb-6 animate-fade-in-up">
                    <i data-lucide="<?php echo esc_attr($hero_icon); ?>" class="w-5 h-5 text-accent"></i>
                    <span class="text-sm font-semibold uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-6 tracking-tight">
                    <?php echo esc_html($hero_headline); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame to-tiger-orange"><?php echo esc_html($hero_highlight); ?></span>
                </h1>
                <p class="text-base sm:text-lg md:text-xl text-slate-200 max-w-3xl mx-auto leading-relaxed">
                    <?php echo esc_html($hero_sub); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Cafe Overview Section -->
    <section class="px-4 sm:px-6 lg:px-8 py-12 md:py-20 bg-background-light">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <div class="space-y-6">
                    <div class="flex flex-col gap-4">
                        <span class="w-fit rounded-full bg-primary/10 px-4 py-2 text-sm font-bold uppercase tracking-wider text-primary ring-1 ring-primary/20">
                            <?php echo esc_html($overview_badge); ?>
                        </span>
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-text-main-light">
                            <?php echo esc_html($overview_heading); ?>
                        </h2>
                    </div>
                    <div class="space-y-4">
                        <?php foreach (preg_split('/\n\s*\n/', trim($overview_desc), -1, PREG_SPLIT_NO_EMPTY) as $p) : ?>
                            <p class="text-base sm:text-lg text-text-secondary-light leading-relaxed"><?php echo esc_html(trim($p)); ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="relative">
                    <div class="rounded-2xl overflow-hidden shadow-2xl">
                        <img src="<?php echo esc_url($overview_img); ?>" alt="<?php echo esc_attr($overview_heading); ?>" class="w-full h-[350px] md:h-[400px] object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/40 to-transparent"></div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 bg-white rounded-xl p-4 shadow-xl">
                        <div class="text-3xl font-bold text-primary"><?php echo esc_html($overview_card_title); ?></div>
                        <div class="text-sm font-bold text-text-main-light uppercase tracking-wide"><?php echo esc_html($overview_card_label); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
