<?php
/**
 * Template Name: Games & Sports Page
 * Sports: Hero, Overview, Philosophy, Facilities List, Gallery (ACF dynamic; gallery uses Fancybox popup)
 */
if (!defined('ABSPATH')) exit;
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge = $opt ? get_field('sports_hero_badge', $page_id) : null;
$hero_headline = $opt ? get_field('sports_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('sports_hero_highlight', $page_id) : null;
$hero_subtext = $opt ? get_field('sports_hero_subtext', $page_id) : null;
$hero_badge = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Athletics & Fitness';
$hero_headline = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'Games &';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Sports';
$hero_subtext = ($hero_subtext !== '' && $hero_subtext !== null) ? (string) $hero_subtext : 'Fostering all-round development through diverse sporting activities and healthy competition';

// ——— Overview ———
$overview_heading = $opt ? get_field('sports_overview_heading', $page_id) : null;
$card1_text = $opt ? get_field('sports_card1_text', $page_id) : null;
$card2_text = $opt ? get_field('sports_card2_text', $page_id) : null;
$stat1_number = $opt ? get_field('sports_stat1_number', $page_id) : null;
$stat1_label = $opt ? get_field('sports_stat1_label', $page_id) : null;
$stat2_number = $opt ? get_field('sports_stat2_number', $page_id) : null;
$stat2_label = $opt ? get_field('sports_stat2_label', $page_id) : null;
$overview_image = $opt ? get_field('sports_overview_image', $page_id) : null;
$badge_title = $opt ? get_field('sports_badge_title', $page_id) : null;
$badge_subtext = $opt ? get_field('sports_badge_subtext', $page_id) : null;

$overview_heading = ($overview_heading !== '' && $overview_heading !== null) ? (string) $overview_heading : 'Building Champions';
$card1_text = ($card1_text !== '' && $card1_text !== null) ? (string) $card1_text : 'Sports is an important activity, which has to be carried out to take care of the all-round development of the students and to inculcate a sense of healthy competition amongst them.';
$card2_text = ($card2_text !== '' && $card2_text !== null) ? (string) $card2_text : 'We provide facilities to students to pursue a wide range of sporting activities in the campus. The outdoor facilities include football and cricket fields, basketball, and volleyball, along with an indoor recreation hall for chess, carom, etc.';
$stat1_number = ($stat1_number !== '' && $stat1_number !== null) ? (string) $stat1_number : '12+';
$stat1_label = ($stat1_label !== '' && $stat1_label !== null) ? (string) $stat1_label : 'Sports Activities';
$stat2_number = ($stat2_number !== '' && $stat2_number !== null) ? (string) $stat2_number : '100%';
$stat2_label = ($stat2_label !== '' && $stat2_label !== null) ? (string) $stat2_label : 'Student Participation';
$badge_title = ($badge_title !== '' && $badge_title !== null) ? (string) $badge_title : 'All-Round Development';
$badge_subtext = ($badge_subtext !== '' && $badge_subtext !== null) ? (string) $badge_subtext : 'Health & Fitness';

$overview_img_url = '';
if (!empty($overview_image) && is_array($overview_image) && !empty($overview_image['url'])) $overview_img_url = $overview_image['url'];
if ($overview_img_url === '') $overview_img_url = 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';

// ——— Philosophy ———
$philosophy_heading = $opt ? get_field('sports_philosophy_heading', $page_id) : null;
$philosophy_paragraph = $opt ? get_field('sports_philosophy_paragraph', $page_id) : null;
$philosophy_heading = ($philosophy_heading !== '' && $philosophy_heading !== null) ? (string) $philosophy_heading : 'Our Sports Philosophy';
$philosophy_paragraph = ($philosophy_paragraph !== '' && $philosophy_paragraph !== null) ? (string) $philosophy_paragraph : "Along with the academics, the benefits of sports cannot be undermined for the wholesome development of the student. Knowing the importance of sports in today's scientific era, due emphasis is laid on every student's participation in various sports events, to ensure the shaping of the overall personality, health and fitness of an individual student.";

// ——— Facilities list ———
$facilities_badge = $opt ? get_field('sports_facilities_badge', $page_id) : null;
$facilities_heading = $opt ? get_field('sports_facilities_heading', $page_id) : null;
$facilities_highlight = $opt ? get_field('sports_facilities_highlight', $page_id) : null;
$facilities_subtext = $opt ? get_field('sports_facilities_subtext', $page_id) : null;
$sports_items = $opt ? get_field('sports_items', $page_id) : null;

$facilities_badge = ($facilities_badge !== '' && $facilities_badge !== null) ? (string) $facilities_badge : 'Available Sports';
$facilities_heading = ($facilities_heading !== '' && $facilities_heading !== null) ? (string) $facilities_heading : 'Wide Range of Activities';
$facilities_highlight = ($facilities_highlight !== '' && $facilities_highlight !== null) ? (string) $facilities_highlight : 'Activities';
$facilities_subtext = ($facilities_subtext !== '' && $facilities_subtext !== null) ? (string) $facilities_subtext : 'From outdoor team sports to indoor strategic games, we offer diverse sporting opportunities';

$default_sports_items = array(
    array('icon' => 'target', 'title' => 'Basketball', 'style' => 'primary'),
    array('icon' => 'circle', 'title' => 'Tennis', 'style' => 'accent'),
    array('icon' => 'grid', 'title' => 'Chess', 'style' => 'primary-light'),
    array('icon' => 'target', 'title' => 'Cricket', 'style' => 'primary'),
    array('icon' => 'zap', 'title' => 'Skating', 'style' => 'accent'),
    array('icon' => 'circle', 'title' => 'Football', 'style' => 'primary-light'),
    array('icon' => 'users', 'title' => 'Kho Kho', 'style' => 'primary'),
    array('icon' => 'rotate-cw', 'title' => 'Cycling', 'style' => 'accent'),
    array('icon' => 'activity', 'title' => 'Volleyball', 'style' => 'primary-light'),
    array('icon' => 'grid', 'title' => 'Carrom', 'style' => 'primary'),
    array('icon' => 'circle', 'title' => 'Lawn Tennis', 'style' => 'accent'),
    array('icon' => 'shield', 'title' => 'Taekwondo', 'style' => 'primary-light'),
);
$sports_items = (is_array($sports_items) && !empty($sports_items)) ? $sports_items : $default_sports_items;

// ——— Gallery ———
$gallery_badge = $opt ? get_field('sports_gallery_badge', $page_id) : null;
$gallery_heading = $opt ? get_field('sports_gallery_heading', $page_id) : null;
$gallery_highlight = $opt ? get_field('sports_gallery_highlight', $page_id) : null;
$gallery_subtext = $opt ? get_field('sports_gallery_subtext', $page_id) : null;
$gallery_images = $opt ? get_field('sports_gallery_images', $page_id) : null;

$gallery_badge = ($gallery_badge !== '' && $gallery_badge !== null) ? (string) $gallery_badge : 'Photo Gallery';
$gallery_heading = ($gallery_heading !== '' && $gallery_heading !== null) ? (string) $gallery_heading : 'Sports Gallery';
$gallery_highlight = ($gallery_highlight !== '' && $gallery_highlight !== null) ? (string) $gallery_highlight : 'Gallery';
$gallery_subtext = ($gallery_subtext !== '' && $gallery_subtext !== null) ? (string) $gallery_subtext : 'Capturing moments of excellence, teamwork, and achievement in our sporting activities';

// Default gallery image URLs (fallback when no ACF gallery)
$default_gallery_urls = array(
    'https://images.unsplash.com/photo-1546519638-68e109498ffc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    'https://images.unsplash.com/photo-1576678927484-cc907957088c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    'https://images.unsplash.com/photo-1551958219-acbc608c6377?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    'https://images.unsplash.com/photo-1530549387789-4c1017266635?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
);
$gallery_list = array();
if (is_array($gallery_images) && !empty($gallery_images)) {
    foreach ($gallery_images as $img) {
        $id = isset($img['ID']) ? (int) $img['ID'] : (isset($img['id']) ? (int) $img['id'] : 0);
        $full_url = $id ? wp_get_attachment_image_url($id, 'full') : (isset($img['url']) ? $img['url'] : '');
        $alt = $id ? get_post_meta($id, '_wp_attachment_image_alt', true) : (isset($img['alt']) ? $img['alt'] : '');
        if (empty($alt)) $alt = 'Sports activity';
        if ($full_url) $gallery_list[] = array('url' => $full_url, 'alt' => $alt);
    }
}
if (empty($gallery_list)) {
    foreach ($default_gallery_urls as $i => $u) {
        $gallery_list[] = array('url' => $u, 'alt' => sprintf(__('Sports Activity %d', 'mlzs'), $i + 1));
    }
}

// Style classes for sports items (icon box hover)
$item_style_classes = array(
    'primary' => 'bg-primary/10 text-primary group-hover:bg-primary group-hover:text-white hover:border-primary/30',
    'accent' => 'bg-accent/10 text-accent group-hover:bg-accent group-hover:text-white hover:border-accent/30',
    'primary-light' => 'bg-primary-light/10 text-primary-light group-hover:bg-primary-light group-hover:text-white hover:border-primary-light/30',
);
?>
    <!-- Hero -->
    <section class="relative bg-gradient-to-br from-primary via-primary-dark to-slate-900 px-4 sm:px-6 lg:px-8 pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')]"></div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-accent/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="relative z-10 max-w-7xl mx-auto">
            <div class="text-center text-white">
                <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-white/20 backdrop-blur-md border border-white/30 mb-4 sm:mb-6 animate-fade-in-up">
                    <i data-lucide="trophy" class="w-4 h-4 sm:w-5 sm:h-5 text-accent"></i>
                    <span class="text-xs sm:text-sm font-semibold uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold mb-4 sm:mb-6 tracking-tight">
                    <?php echo esc_html($hero_headline); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame to-tiger-orange"><?php echo esc_html($hero_highlight); ?></span>
                </h1>
                <p class="text-sm sm:text-base md:text-lg lg:text-xl text-slate-200 max-w-3xl mx-auto leading-relaxed">
                    <?php echo esc_html($hero_subtext); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Sports Overview -->
    <section class="px-4 sm:px-6 lg:px-8 py-12 md:py-20 bg-background-light">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center mb-16">
                <div class="space-y-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary/10 to-accent/10 flex items-center justify-center">
                            <i data-lucide="activity" class="w-6 h-6 text-primary"></i>
                        </div>
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-text-main-light">
                            <?php echo esc_html($overview_heading); ?>
                        </h2>
                    </div>
                    <div class="space-y-4">
                        <div class="bg-gradient-to-r from-primary/5 to-transparent rounded-2xl p-6 border border-primary/10">
                            <p class="text-sm sm:text-base text-text-secondary-light leading-relaxed"><?php echo esc_html($card1_text); ?></p>
                        </div>
                        <div class="bg-white rounded-2xl p-6 shadow-soft border border-border-light">
                            <p class="text-sm sm:text-base text-text-secondary-light leading-relaxed"><?php echo esc_html($card2_text); ?></p>
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
                    <div class="rounded-2xl overflow-hidden shadow-2xl border-4 border-white">
                        <img src="<?php echo esc_url($overview_img_url); ?>" alt="<?php echo esc_attr__('Sports Activities', 'mlzs'); ?>" class="w-full h-[350px] md:h-[400px] object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/40 to-transparent"></div>
                    </div>
                    <div class="absolute -bottom-4 -left-4 md:-bottom-6 md:-left-6 bg-gradient-to-r from-primary to-primary-dark rounded-xl p-3 md:p-4 text-white shadow-2xl">
                        <div class="text-lg md:text-xl font-bold"><?php echo esc_html($badge_title); ?></div>
                        <div class="text-xs font-medium uppercase tracking-wide"><?php echo esc_html($badge_subtext); ?></div>
                    </div>
                </div>
            </div>

            <!-- Sports Philosophy -->
            <div class="mb-16">
                <div class="bg-gradient-to-r from-primary/5 via-accent/5 to-primary/5 rounded-3xl p-8 md:p-12 border border-primary/10">
                    <div class="max-w-4xl mx-auto text-center">
                        <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-text-main-light mb-4">
                            <?php echo esc_html($philosophy_heading); ?>
                        </h3>
                        <p class="text-sm sm:text-base text-text-secondary-light leading-relaxed mb-6">
                            <?php echo esc_html($philosophy_paragraph); ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Sports Facilities List -->
            <div class="mb-16">
                <div class="text-center mb-10">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-accent/10 border border-accent/20 text-accent text-sm font-bold uppercase tracking-wider mb-4">
                        <i data-lucide="zap" class="w-4 h-4"></i>
                        <?php echo esc_html($facilities_badge); ?>
                    </div>
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-text-main-light mb-4">
                        <?php echo esc_html($facilities_heading); ?> <span class="text-primary"><?php echo esc_html($facilities_highlight); ?></span>
                    </h3>
                    <p class="text-sm sm:text-base text-text-secondary-light max-w-2xl mx-auto">
                        <?php echo esc_html($facilities_subtext); ?>
                    </p>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    <?php foreach ($sports_items as $item) :
                        $icon = isset($item['icon']) && trim($item['icon']) !== '' ? trim($item['icon']) : 'trophy';
                        $title = isset($item['title']) ? (string) $item['title'] : '';
                        $style = isset($item['style']) && isset($item_style_classes[$item['style']]) ? $item['style'] : 'primary';
                        $style_class = isset($item_style_classes[$style]) ? $item_style_classes[$style] : $item_style_classes['primary'];
                    ?>
                    <div class="group bg-white rounded-xl p-4 shadow-soft hover:shadow-xl border border-border-light hover:border-primary/30 transition-all duration-300 hover:-translate-y-2 text-center">
                        <div class="w-12 h-12 rounded-lg <?php echo esc_attr($style_class); ?> flex items-center justify-center mb-3 mx-auto transition-colors">
                            <i data-lucide="<?php echo esc_attr($icon); ?>" class="w-6 h-6"></i>
                        </div>
                        <h4 class="text-sm font-bold text-text-main-light"><?php echo esc_html($title); ?></h4>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Sports Gallery (Fancybox popup) -->
    <section class="px-4 sm:px-6 lg:px-8 py-12 md:py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-10 md:mb-12">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-primary/10 border border-primary/20 mb-3 sm:mb-4">
                    <i data-lucide="image" class="w-3 h-3 sm:w-4 sm:h-4 text-primary"></i>
                    <span class="text-xs sm:text-sm font-semibold text-primary uppercase tracking-wider"><?php echo esc_html($gallery_badge); ?></span>
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-text-main-light mb-3 sm:mb-4">
                    Sports <span class="text-primary"><?php echo esc_html($gallery_highlight); ?></span>
                </h2>
                <p class="text-sm sm:text-base text-text-secondary-light max-w-2xl mx-auto">
                    <?php echo esc_html($gallery_subtext); ?>
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                <?php foreach ($gallery_list as $index => $img) :
                    $url = isset($img['url']) ? $img['url'] : '';
                    $alt = isset($img['alt']) ? $img['alt'] : sprintf(__('Sports Activity %d', 'mlzs'), $index + 1);
                    if ($url === '') continue;
                ?>
                <a href="<?php echo esc_url($url); ?>"
                   data-fancybox="sports-gallery"
                   data-caption="<?php echo esc_attr($alt); ?>"
                   class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 block">
                    <div class="h-48 sm:h-56 md:h-64">
                        <img src="<?php echo esc_url($url); ?>"
                             alt="<?php echo esc_attr($alt); ?>"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                             loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
