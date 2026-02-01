<?php
/**
 * Template Name: Open Air Theatre Page
 * Theatre: Hero, Overview (content + image + stats), Stage Features (3), Performance Gallery (3). UI matches theatre.html exactly.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge = $opt ? get_field('theatre_hero_badge', $page_id) : null;
$hero_icon = $opt ? get_field('theatre_hero_icon', $page_id) : null;
$hero_before = $opt ? get_field('theatre_hero_headline_before', $page_id) : null;
$hero_highlight = $opt ? get_field('theatre_hero_headline_highlight', $page_id) : null;
$hero_subtext = $opt ? get_field('theatre_hero_subtext', $page_id) : null;

$hero_badge = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Performing Arts';
$hero_icon = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'theater';
$hero_before = ($hero_before !== '' && $hero_before !== null) ? (string) $hero_before : 'Open Air';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Theatre';
$hero_subtext = ($hero_subtext !== '' && $hero_subtext !== null) ? (string) $hero_subtext : 'A magnificent venue for performances, assemblies, and cultural celebrations under the open sky';

// ——— Overview ———
$overview_heading = $opt ? get_field('theatre_overview_heading', $page_id) : null;
$overview_highlight = $opt ? get_field('theatre_overview_heading_highlight', $page_id) : null;
$overview_heading_after = $opt ? get_field('theatre_overview_heading_after', $page_id) : null;
$overview_para1 = $opt ? get_field('theatre_overview_para1', $page_id) : null;
$overview_para2 = $opt ? get_field('theatre_overview_para2', $page_id) : null;
$stat1_number = $opt ? get_field('theatre_stat1_number', $page_id) : null;
$stat1_label = $opt ? get_field('theatre_stat1_label', $page_id) : null;
$stat2_number = $opt ? get_field('theatre_stat2_number', $page_id) : null;
$stat2_label = $opt ? get_field('theatre_stat2_label', $page_id) : null;
$main_image = $opt ? get_field('theatre_main_image', $page_id) : null;
$stage_badge_title = $opt ? get_field('theatre_stage_badge_title', $page_id) : null;
$stage_badge_subtitle = $opt ? get_field('theatre_stage_badge_subtitle', $page_id) : null;

$overview_heading = ($overview_heading !== '' && $overview_heading !== null) ? (string) $overview_heading : 'The';
$overview_highlight = ($overview_highlight !== '' && $overview_highlight !== null) ? (string) $overview_highlight : 'Stage';
$overview_heading_after = ($overview_heading_after !== '' && $overview_heading_after !== null) ? (string) $overview_heading_after : 'of Excellence';
$overview_para1 = ($overview_para1 !== '' && $overview_para1 !== null) ? (string) $overview_para1 : 'Our open air theatre provides a magnificent venue for performances, assemblies, and cultural celebrations. With professional sound, lighting, and seating facilities, it\'s the perfect stage for students to showcase their talents.';
$overview_para2 = ($overview_para2 !== '' && $overview_para2 !== null) ? (string) $overview_para2 : 'The amphitheater-style design ensures excellent visibility for every audience member, creating an immersive experience for all performances and events.';
$stat1_number = ($stat1_number !== '' && $stat1_number !== null) ? (string) $stat1_number : '500+';
$stat1_label = ($stat1_label !== '' && $stat1_label !== null) ? (string) $stat1_label : 'Seating Capacity';
$stat2_number = ($stat2_number !== '' && $stat2_number !== null) ? (string) $stat2_number : '30+';
$stat2_label = ($stat2_label !== '' && $stat2_label !== null) ? (string) $stat2_label : 'Annual Events';
$stage_badge_title = ($stage_badge_title !== '' && $stage_badge_title !== null) ? (string) $stage_badge_title : 'Main Stage';
$stage_badge_subtitle = ($stage_badge_subtitle !== '' && $stage_badge_subtitle !== null) ? (string) $stage_badge_subtitle : 'Amphitheater Style';

$main_img_url = '';
if (!empty($main_image) && is_array($main_image) && !empty($main_image['url'])) $main_img_url = $main_image['url'];
elseif (!empty($main_image) && is_string($main_image)) $main_img_url = $main_image;
if ($main_img_url === '') $main_img_url = 'https://images.unsplash.com/photo-1514306191717-452ec28c7814?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';

// ——— Stage Features ———
$features_badge = $opt ? get_field('theatre_features_badge', $page_id) : null;
$features_heading = $opt ? get_field('theatre_features_heading', $page_id) : null;
$features_highlight = $opt ? get_field('theatre_features_heading_highlight', $page_id) : null;
$features_subtext = $opt ? get_field('theatre_features_subtext', $page_id) : null;
$features_list = $opt ? get_field('theatre_features_list', $page_id) : null;

$features_badge = ($features_badge !== '' && $features_badge !== null) ? (string) $features_badge : 'Stage Features';
$features_heading = ($features_heading !== '' && $features_heading !== null) ? (string) $features_heading : 'World-Class';
$features_highlight = ($features_highlight !== '' && $features_highlight !== null) ? (string) $features_highlight : 'Facilities';
$features_subtext = ($features_subtext !== '' && $features_subtext !== null) ? (string) $features_subtext : 'Equipped with professional sound, lighting, and seating for exceptional performances';

$default_features = array(
    array('icon' => 'speaker', 'title' => 'Professional Sound System', 'paragraph' => 'State-of-the-art audio equipment with surround sound capabilities for crystal clear audio during performances.', 'style' => 'primary'),
    array('icon' => 'sun', 'title' => 'Stage Lighting', 'paragraph' => 'Professional stage lighting system with multiple lighting modes for dramatic effects during performances.', 'style' => 'accent'),
    array('icon' => 'users', 'title' => 'Amphitheater Seating', 'paragraph' => 'Tiered seating arrangement providing excellent visibility for every audience member, rain or shine.', 'style' => 'primary-light'),
);
$features_list = (is_array($features_list) && count($features_list) >= 3) ? $features_list : $default_features;

// ——— Gallery ———
$gallery_badge = $opt ? get_field('theatre_gallery_badge', $page_id) : null;
$gallery_heading = $opt ? get_field('theatre_gallery_heading', $page_id) : null;
$gallery_highlight = $opt ? get_field('theatre_gallery_heading_highlight', $page_id) : null;
$gallery_subtext = $opt ? get_field('theatre_gallery_subtext', $page_id) : null;
$gallery_items = $opt ? get_field('theatre_gallery_items', $page_id) : null;

$gallery_badge = ($gallery_badge !== '' && $gallery_badge !== null) ? (string) $gallery_badge : 'Performance Gallery';
$gallery_heading = ($gallery_heading !== '' && $gallery_heading !== null) ? (string) $gallery_heading : 'Memorable';
$gallery_highlight = ($gallery_highlight !== '' && $gallery_highlight !== null) ? (string) $gallery_highlight : 'Moments';
$gallery_subtext = ($gallery_subtext !== '' && $gallery_subtext !== null) ? (string) $gallery_subtext : 'Capturing the magic of performances in our magnificent open air theatre';

$default_gallery = array(
    array('image' => array('url' => 'https://images.unsplash.com/photo-1501281667305-0d4e0ab4a5b5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'), 'title' => 'Cultural Festivals', 'caption' => 'Traditional dance and music performances', 'badge' => 'Dance'),
    array('image' => array('url' => 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'), 'title' => 'School Plays', 'caption' => 'Student-led theatrical productions', 'badge' => 'Drama'),
    array('image' => array('url' => 'https://images.unsplash.com/photo-1518609878373-06d740f60d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'), 'title' => 'Music Concerts', 'caption' => 'Orchestra and band performances', 'badge' => 'Music'),
);
$gallery_items = (is_array($gallery_items) && !empty($gallery_items)) ? $gallery_items : $default_gallery;

$feature_style_classes = array(
    'primary' => array('icon_bg' => 'from-primary/10 to-primary-light/10', 'icon_text' => 'text-primary', 'hover_bg' => 'group-hover:bg-primary', 'border' => 'hover:border-primary/30'),
    'accent' => array('icon_bg' => 'from-accent/10 to-amber-flame/10', 'icon_text' => 'text-accent', 'hover_bg' => 'group-hover:bg-accent', 'border' => 'hover:border-accent/30'),
    'primary-light' => array('icon_bg' => 'from-primary-light/10 to-slate-blue/10', 'icon_text' => 'text-primary-light', 'hover_bg' => 'group-hover:bg-primary-light', 'border' => 'hover:border-primary-light/30'),
);
$gallery_badge_styles = array('Dance' => 'bg-accent', 'Drama' => 'bg-primary', 'Music' => 'bg-primary-light');
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
                    <?php echo esc_html($hero_before); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame to-tiger-orange"><?php echo esc_html($hero_highlight); ?></span>
                </h1>
                <p class="text-base sm:text-lg md:text-xl text-slate-200 max-w-3xl mx-auto leading-relaxed">
                    <?php echo esc_html($hero_subtext); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Theatre Overview -->
    <section class="px-4 sm:px-6 lg:px-8 py-12 md:py-20 bg-background-light">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center mb-16">
                <div class="space-y-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary/10 to-accent/10 flex items-center justify-center">
                            <i data-lucide="theater" class="w-6 h-6 text-primary"></i>
                        </div>
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-text-main-light">
                            <?php echo esc_html($overview_heading); ?> <span class="text-primary"><?php echo esc_html($overview_highlight); ?></span> <?php echo esc_html($overview_heading_after); ?>
                        </h2>
                    </div>
                    <div class="space-y-4">
                        <div class="bg-gradient-to-r from-primary/5 to-transparent rounded-2xl p-6 border border-primary/10">
                            <p class="text-base sm:text-lg text-text-secondary-light leading-relaxed">
                                <?php echo esc_html($overview_para1); ?>
                            </p>
                        </div>
                        <div class="bg-white rounded-2xl p-6 shadow-soft border border-border-light">
                            <p class="text-base sm:text-lg text-text-secondary-light leading-relaxed">
                                <?php echo esc_html($overview_para2); ?>
                            </p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 md:gap-4 mt-6">
                        <div class="bg-white rounded-xl p-4 text-center shadow-sm border border-border-light">
                            <div class="text-xl md:text-2xl font-bold text-primary mb-2"><?php echo esc_html($stat1_number); ?></div>
                            <div class="text-xs md:text-sm font-medium text-text-secondary-light"><?php echo esc_html($stat1_label); ?></div>
                        </div>
                        <div class="bg-white rounded-xl p-4 text-center shadow-sm border border-border-light">
                            <div class="text-xl md:text-2xl font-bold text-accent mb-2"><?php echo esc_html($stat2_number); ?></div>
                            <div class="text-xs md:text-sm font-medium text-text-secondary-light"><?php echo esc_html($stat2_label); ?></div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border-4 border-white">
                        <img src="<?php echo esc_url($main_img_url); ?>" alt="Open Air Theatre" class="w-full h-[350px] md:h-[400px] object-cover" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/40 to-transparent"></div>
                    </div>
                    <div class="absolute -bottom-4 -left-4 md:-bottom-6 md:-left-6 bg-gradient-to-r from-primary to-primary-dark rounded-xl p-3 md:p-4 text-white shadow-2xl">
                        <div class="text-lg md:text-xl font-bold"><?php echo esc_html($stage_badge_title); ?></div>
                        <div class="text-xs font-medium uppercase tracking-wide"><?php echo esc_html($stage_badge_subtitle); ?></div>
                    </div>
                </div>
            </div>

            <!-- Theatre Features -->
            <div class="mb-16">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-accent/10 border border-accent/20 text-accent text-sm font-bold uppercase tracking-wider mb-4">
                        <i data-lucide="zap" class="w-4 h-4"></i>
                        <?php echo esc_html($features_badge); ?>
                    </div>
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-text-main-light mb-4">
                        <?php echo esc_html($features_heading); ?> <span class="text-primary"><?php echo esc_html($features_highlight); ?></span>
                    </h3>
                    <p class="text-base sm:text-lg text-text-secondary-light max-w-2xl mx-auto">
                        <?php echo esc_html($features_subtext); ?>
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php foreach ($features_list as $f) :
                        $f_style = isset($f['style']) ? $f['style'] : 'primary';
                        $fc = isset($feature_style_classes[$f_style]) ? $feature_style_classes[$f_style] : $feature_style_classes['primary'];
                        $f_icon = isset($f['icon']) ? trim((string) $f['icon']) : 'speaker';
                        $f_title = isset($f['title']) ? (string) $f['title'] : '';
                        $f_para = isset($f['paragraph']) ? (string) $f['paragraph'] : '';
                    ?>
                    <div class="group relative bg-white rounded-2xl p-6 shadow-soft hover:shadow-xl border border-border-light <?php echo esc_attr($fc['border']); ?> transition-all duration-300 hover:-translate-y-2">
                        <div class="absolute -top-3 left-6 w-12 h-12 rounded-xl bg-gradient-to-br <?php echo esc_attr($fc['icon_bg']); ?> flex items-center justify-center <?php echo esc_attr($fc['hover_bg']); ?> group-hover:text-white transition-colors">
                            <i data-lucide="<?php echo esc_attr($f_icon); ?>" class="w-6 h-6 <?php echo esc_attr($fc['icon_text']); ?> group-hover:text-white"></i>
                        </div>
                        <div class="pt-4">
                            <h4 class="text-lg sm:text-xl font-bold text-text-main-light mb-3"><?php echo esc_html($f_title); ?></h4>
                            <p class="text-sm sm:text-base text-text-secondary-light">
                                <?php echo esc_html($f_para); ?>
                            </p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Performance Gallery -->
            <div class="mb-16">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary/10 border border-primary/20 text-primary text-sm font-bold uppercase tracking-wider mb-4">
                        <i data-lucide="camera" class="w-4 h-4"></i>
                        <?php echo esc_html($gallery_badge); ?>
                    </div>
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-text-main-light mb-4">
                        <?php echo esc_html($gallery_heading); ?> <span class="text-primary"><?php echo esc_html($gallery_highlight); ?></span>
                    </h3>
                    <p class="text-base sm:text-lg text-text-secondary-light max-w-2xl mx-auto">
                        <?php echo esc_html($gallery_subtext); ?>
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($gallery_items as $g) :
                        $g_img = '';
                        if (!empty($g['image']) && is_array($g['image']) && !empty($g['image']['url'])) $g_img = $g['image']['url'];
                        elseif (!empty($g['image']) && is_string($g['image'])) $g_img = $g['image'];
                        if ($g_img === '') $g_img = 'https://images.unsplash.com/photo-1501281667305-0d4e0ab4a5b5?w=800&q=80';
                        $g_title = isset($g['title']) ? (string) $g['title'] : '';
                        $g_caption = isset($g['caption']) ? (string) $g['caption'] : '';
                        $g_badge = isset($g['badge']) ? (string) $g['badge'] : '';
                        $badge_class = isset($gallery_badge_styles[$g_badge]) ? $gallery_badge_styles[$g_badge] : 'bg-primary';
                    ?>
                    <div class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                        <div class="h-64">
                            <img src="<?php echo esc_url($g_img); ?>" alt="<?php echo esc_attr($g_title); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent"></div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 md:p-6 text-white">
                            <h4 class="text-lg sm:text-xl font-bold mb-2"><?php echo esc_html($g_title); ?></h4>
                            <p class="text-xs sm:text-sm opacity-90"><?php echo esc_html($g_caption); ?></p>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span class="px-2 py-1 md:px-3 rounded-full <?php echo esc_attr($badge_class); ?> text-white text-xs font-bold uppercase"><?php echo esc_html($g_badge); ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
