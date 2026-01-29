<?php
/**
 * Template Name: Music & Dance Page
 * Music & Dance: Hero, Intro, Gallery, Programs, Benefits, CTA (ACF dynamic)
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$theme_uri = get_template_directory_uri();
$home_url = home_url('/');
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge     = $opt ? get_field('dance_hero_badge', $page_id) : null;
$hero_icon      = $opt ? get_field('dance_hero_icon', $page_id) : null;
$hero_headline  = $opt ? get_field('dance_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('dance_hero_highlight', $page_id) : null;
$hero_sub       = $opt ? get_field('dance_hero_subheadline', $page_id) : null;

$hero_badge     = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Rhythmic Expression';
$hero_icon      = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'music';
$hero_headline  = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'Music &';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Dance';
$hero_sub       = ($hero_sub !== '' && $hero_sub !== null) ? (string) $hero_sub : 'Where rhythm meets expression, creating harmony in mind, body, and soul';

// ——— Intro card ———
$intro_heading   = $opt ? get_field('dance_intro_heading', $page_id) : null;
$intro_icon      = $opt ? get_field('dance_intro_icon', $page_id) : null;
$intro_para1    = $opt ? get_field('dance_intro_para1', $page_id) : null;
$intro_box_heading = $opt ? get_field('dance_intro_box_heading', $page_id) : null;
$intro_box_text  = $opt ? get_field('dance_intro_box_text', $page_id) : null;

$intro_heading   = ($intro_heading !== '' && $intro_heading !== null) ? (string) $intro_heading : 'The Healing Power of Music & Dance';
$intro_icon      = (is_string($intro_icon) && trim($intro_icon) !== '') ? trim($intro_icon) : 'heart';
$intro_para1    = ($intro_para1 !== '' && $intro_para1 !== null) ? (string) $intro_para1 : 'Music which gives life to your expression and gesture doesn\'t matter how you use it, by singing or by playing. It indeed is a therapy to relax the mind so it has proven to be the best for kids to enjoy.';
$intro_box_heading = ($intro_box_heading !== '' && $intro_box_heading !== null) ? (string) $intro_box_heading : 'Comprehensive Music Program';
$intro_box_text  = ($intro_box_text !== '' && $intro_box_text !== null) ? (string) $intro_box_text : 'We are providing the learning of both vocal and instrumental music from 1st class up to 9th class, ensuring every student gets exposure to musical education.';

// ——— Gallery ———
$gallery_heading  = $opt ? get_field('dance_gallery_heading', $page_id) : null;
$gallery_highlight = $opt ? get_field('dance_gallery_highlight', $page_id) : null;
$gallery_sub     = $opt ? get_field('dance_gallery_sub', $page_id) : null;
$gallery_images  = $opt ? get_field('dance_gallery_images', $page_id) : null;

$gallery_heading  = ($gallery_heading !== '' && $gallery_heading !== null) ? (string) $gallery_heading : 'Our';
$gallery_highlight = ($gallery_highlight !== '' && $gallery_highlight !== null) ? (string) $gallery_highlight : 'Performance Gallery';
$gallery_sub     = ($gallery_sub !== '' && $gallery_sub !== null) ? (string) $gallery_sub : 'Capturing moments of musical excellence and rhythmic expression';
$default_gallery = array(
    array('image' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'title' => 'Vocal Training', 'caption' => 'Classroom session', 'large' => 0),
    array('image' => 'https://images.unsplash.com/photo-1510915361894-db8b60106cb1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'title' => 'Instrument Practice', 'caption' => 'Students learning', 'large' => 0),
    array('image' => 'https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'title' => 'Stage Show', 'caption' => 'Annual function', 'large' => 0),
    array('image' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'title' => 'Music Ensemble', 'caption' => 'Group performance', 'large' => 0),
    array('image' => 'https://images.unsplash.com/photo-1547036967-23d11aacaee0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'title' => 'Dance Performance', 'caption' => 'Traditional dance', 'large' => 1),
    array('image' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'title' => 'Expert Workshop', 'caption' => 'Special training session', 'large' => 1),
);
$gallery_images = (is_array($gallery_images) && !empty($gallery_images)) ? $gallery_images : $default_gallery;

// ——— Programs ———
$programs_heading   = $opt ? get_field('dance_programs_heading', $page_id) : null;
$programs_highlight = $opt ? get_field('dance_programs_highlight', $page_id) : null;
$programs_sub      = $opt ? get_field('dance_programs_sub', $page_id) : null;
$music_heading     = $opt ? get_field('dance_music_heading', $page_id) : null;
$music_icon        = $opt ? get_field('dance_music_icon', $page_id) : null;
$music_items       = $opt ? get_field('dance_music_items', $page_id) : null;
$dance_heading     = $opt ? get_field('dance_dance_heading', $page_id) : null;
$dance_icon        = $opt ? get_field('dance_dance_icon', $page_id) : null;
$dance_items       = $opt ? get_field('dance_dance_items', $page_id) : null;

$programs_heading   = ($programs_heading !== '' && $programs_heading !== null) ? (string) $programs_heading : 'Our';
$programs_highlight = ($programs_highlight !== '' && $programs_highlight !== null) ? (string) $programs_highlight : 'Programs';
$programs_sub      = ($programs_sub !== '' && $programs_sub !== null) ? (string) $programs_sub : 'Comprehensive music and dance education from 1st to 9th standard';
$music_heading     = ($music_heading !== '' && $music_heading !== null) ? (string) $music_heading : 'Music Program';
$music_icon        = (is_string($music_icon) && trim($music_icon) !== '') ? trim($music_icon) : 'music-2';
$dance_heading     = ($dance_heading !== '' && $dance_heading !== null) ? (string) $dance_heading : 'Dance Program';
$dance_icon        = (is_string($dance_icon) && trim($dance_icon) !== '') ? trim($dance_icon) : 'sparkles';
$default_music_items = array('Vocal Training (Classical & Western)', 'Instrumental Music (Keyboard, Guitar, Tabla)', 'Music Theory & Notation Reading', 'Choir & Group Singing');
$default_dance_items = array('Classical Dance Forms', 'Contemporary & Western Dance', 'Folk Dance Traditions', 'Choreography & Stage Presentation');
$music_items = (is_array($music_items) && !empty($music_items)) ? $music_items : $default_music_items;
$dance_items = (is_array($dance_items) && !empty($dance_items)) ? $dance_items : $default_dance_items;

// ——— Benefits ———
$benefits_heading = $opt ? get_field('dance_benefits_heading', $page_id) : null;
$benefits_icon   = $opt ? get_field('dance_benefits_icon', $page_id) : null;
$benefits_list   = $opt ? get_field('dance_benefits_list', $page_id) : null;

$benefits_heading = ($benefits_heading !== '' && $benefits_heading !== null) ? (string) $benefits_heading : 'Benefits of Music & Dance Education';
$benefits_icon   = (is_string($benefits_icon) && trim($benefits_icon) !== '') ? trim($benefits_icon) : 'star';
$default_benefits = array(
    array('icon' => 'brain', 'title' => 'Cognitive Development', 'description' => 'Improves memory, concentration, and mathematical abilities', 'style' => 'primary'),
    array('icon' => 'heart', 'title' => 'Emotional Well-being', 'description' => 'Reduces stress, boosts confidence, and enhances self-expression', 'style' => 'accent'),
    array('icon' => 'users', 'title' => 'Social Skills', 'description' => 'Develops teamwork, coordination, and cultural appreciation', 'style' => 'primary-light'),
    array('icon' => 'activity', 'title' => 'Physical Fitness', 'description' => 'Enhances coordination, flexibility, and overall physical health', 'style' => 'accent'),
);
$benefits_list = (is_array($benefits_list) && count($benefits_list) >= 4) ? $benefits_list : $default_benefits;

// ——— CTA ———
$cta_heading  = $opt ? get_field('dance_cta_heading', $page_id) : null;
$cta_desc    = $opt ? get_field('dance_cta_description', $page_id) : null;
$cta_btn1    = $opt ? get_field('dance_cta_btn_primary', $page_id) : null;
$cta_btn2    = $opt ? get_field('dance_cta_btn_secondary', $page_id) : null;
$cta_icon1   = $opt ? get_field('dance_cta_btn_primary_icon', $page_id) : null;
$cta_icon2   = $opt ? get_field('dance_cta_btn_secondary_icon', $page_id) : null;
$cta_stats   = $opt ? get_field('dance_cta_stats', $page_id) : null;

$cta_heading  = ($cta_heading !== '' && $cta_heading !== null) ? (string) $cta_heading : 'Join Our Rhythmic Journey';
$cta_desc    = ($cta_desc !== '' && $cta_desc !== null) ? (string) $cta_desc : 'Discover the joy of music and dance. Enroll in our programs and let your creativity flow.';
$cta_btn1    = (is_array($cta_btn1) && !empty($cta_btn1['url'])) ? $cta_btn1 : array('url' => $home_url . '#', 'title' => 'View Performance Schedule', 'target' => '');
$cta_btn2    = (is_array($cta_btn2) && !empty($cta_btn2['url'])) ? $cta_btn2 : array('url' => $home_url . '#', 'title' => 'Enroll in Music Program', 'target' => '');
$cta_icon1   = (is_string($cta_icon1) && trim($cta_icon1) !== '') ? trim($cta_icon1) : 'calendar';
$cta_icon2   = (is_string($cta_icon2) && trim($cta_icon2) !== '') ? trim($cta_icon2) : 'music';
$default_cta_stats = array(
    array('number' => '1-9', 'label' => 'Classes Covered'),
    array('number' => '2', 'label' => 'Program Types'),
    array('number' => 'Annual', 'label' => 'Concerts'),
    array('number' => 'Expert', 'label' => 'Faculty'),
);
$cta_stats = (is_array($cta_stats) && count($cta_stats) >= 4) ? $cta_stats : $default_cta_stats;
?>

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

    <!-- Content Section -->
    <section class="px-4 sm:px-6 lg:px-8 py-12 md:py-20 bg-background-light">
        <div class="max-w-7xl mx-auto">
            <!-- Introduction -->
            <div class="mb-8 sm:mb-12">
                <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 md:p-8 shadow-soft border border-border-light">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-primary/10 to-accent/10 flex items-center justify-center">
                            <i data-lucide="<?php echo esc_attr($intro_icon); ?>" class="w-6 h-6 text-accent"></i>
                        </div>
                        <div>
                            <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-text-main-light"><?php echo esc_html($intro_heading); ?></h2>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <p class="text-sm text-text-secondary-light leading-relaxed"><?php echo esc_html($intro_para1); ?></p>
                        <div class="bg-gradient-to-r from-primary/5 to-accent/5 rounded-lg p-4 sm:p-6 border border-primary/10">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="users" class="w-5 h-5 text-primary"></i>
                                </div>
                                <div>
                                    <h3 class="text-sm sm:text-base font-bold text-text-main-light mb-2"><?php echo esc_html($intro_box_heading); ?></h3>
                                    <p class="text-sm text-text-secondary-light"><?php echo esc_html($intro_box_text); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Gallery -->
            <div class="mb-8 sm:mb-12">
                <div class="text-center mb-6">
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-text-main-light mb-3">
                        <?php echo esc_html($gallery_heading); ?> <span class="text-primary"><?php echo esc_html($gallery_highlight); ?></span>
                    </h3>
                    <p class="text-sm sm:text-base text-text-secondary-light"><?php echo esc_html($gallery_sub); ?></p>
                </div>
                <?php
                $gallery_first = array();
                $gallery_second = array();
                foreach ($gallery_images as $i => $item) {
                    $url = '';
                    if (!empty($item['image'])) {
                        $url = is_array($item['image']) ? (isset($item['image']['url']) ? $item['image']['url'] : '') : (string) $item['image'];
                    }
                    if ($url === '' && isset($default_gallery[$i]['image'])) $url = $default_gallery[$i]['image'];
                    $title   = isset($item['title']) ? (string) $item['title'] : '';
                    $caption = isset($item['caption']) ? (string) $item['caption'] : '';
                    $large   = !empty($item['large']);
                    $entry = array('url' => $url, 'title' => $title, 'caption' => $caption, 'large' => $large);
                    if ($i < 4) $gallery_first[] = $entry;
                    else $gallery_second[] = $entry;
                }
                ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-4 sm:mb-6">
                    <?php foreach ($gallery_first as $img) : if (empty($img['url'])) continue; ?>
                    <div class="group relative overflow-hidden rounded-xl sm:rounded-2xl shadow-soft hover:shadow-xl transition-all duration-500">
                        <div class="h-48 sm:h-56 md:h-64 bg-gray-100">
                            <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['title']); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                            <div class="text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <h4 class="font-bold text-sm"><?php echo esc_html($img['title']); ?></h4>
                                <p class="text-xs opacity-90"><?php echo esc_html($img['caption']); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php if (!empty($gallery_second)) : ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                    <?php foreach ($gallery_second as $img) : if (empty($img['url'])) continue; ?>
                    <div class="group relative overflow-hidden rounded-xl sm:rounded-2xl shadow-soft hover:shadow-xl transition-all duration-500">
                        <div class="h-48 sm:h-64 md:h-80 bg-gray-100">
                            <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['title']); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                            <div class="text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <h4 class="font-bold text-sm"><?php echo esc_html($img['title']); ?></h4>
                                <p class="text-xs opacity-90"><?php echo esc_html($img['caption']); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Programs Offered -->
            <div class="mb-8 sm:mb-12">
                <div class="bg-gradient-to-r from-primary/5 to-accent/5 rounded-xl sm:rounded-2xl p-6 sm:p-8 border border-primary/10">
                    <div class="text-center mb-6">
                        <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-text-main-light mb-3">
                            <?php echo esc_html($programs_heading); ?> <span class="text-primary"><?php echo esc_html($programs_highlight); ?></span>
                        </h3>
                        <p class="text-sm sm:text-base text-text-secondary-light max-w-2xl mx-auto"><?php echo esc_html($programs_sub); ?></p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white rounded-xl p-4 sm:p-6 shadow-sm border border-border-light">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                                    <i data-lucide="<?php echo esc_attr($music_icon); ?>" class="w-5 h-5 text-primary"></i>
                                </div>
                                <h4 class="text-base sm:text-lg font-bold text-text-main-light"><?php echo esc_html($music_heading); ?></h4>
                            </div>
                            <ul class="space-y-3">
                                <?php foreach ((array) $music_items as $item) :
                                    $text = is_array($item) ? (isset($item['text']) ? $item['text'] : '') : (string) $item;
                                    if ($text === '') continue;
                                ?>
                                <li class="flex items-start gap-2">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-green-500 mt-1 flex-shrink-0"></i>
                                    <span class="text-sm text-text-secondary-light"><?php echo esc_html($text); ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="bg-white rounded-xl p-4 sm:p-6 shadow-sm border border-border-light">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 rounded-lg bg-accent/10 flex items-center justify-center">
                                    <i data-lucide="<?php echo esc_attr($dance_icon); ?>" class="w-5 h-5 text-accent"></i>
                                </div>
                                <h4 class="text-base sm:text-lg font-bold text-text-main-light"><?php echo esc_html($dance_heading); ?></h4>
                            </div>
                            <ul class="space-y-3">
                                <?php foreach ((array) $dance_items as $item) :
                                    $text = is_array($item) ? (isset($item['text']) ? $item['text'] : '') : (string) $item;
                                    if ($text === '') continue;
                                ?>
                                <li class="flex items-start gap-2">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-green-500 mt-1 flex-shrink-0"></i>
                                    <span class="text-sm text-text-secondary-light"><?php echo esc_html($text); ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Benefits & CTA -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
                <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-soft border border-border-light">
                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-text-main-light mb-6 flex items-center gap-2">
                        <i data-lucide="<?php echo esc_attr($benefits_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 text-accent"></i>
                        <?php echo esc_html($benefits_heading); ?>
                    </h3>
                    <div class="space-y-4">
                        <?php
                        $benefit_styles = array('primary', 'accent', 'primary-light', 'accent');
                        foreach (array_slice($benefits_list, 0, 4) as $idx => $b) :
                            $b_icon = isset($b['icon']) && trim((string) $b['icon']) !== '' ? trim((string) $b['icon']) : 'brain';
                            $b_title = isset($b['title']) ? (string) $b['title'] : '';
                            $b_desc  = isset($b['description']) ? (string) $b['description'] : '';
                            $b_style = isset($b['style']) ? (string) $b['style'] : (isset($benefit_styles[$idx]) ? $benefit_styles[$idx] : 'primary');
                            $box = $b_style === 'primary' ? 'bg-primary/10' : ($b_style === 'accent' ? 'bg-accent/10' : ($b_style === 'primary-light' ? 'bg-primary-light/10' : 'bg-accent/10'));
                            $icon_color = $b_style === 'primary' ? 'text-primary' : ($b_style === 'accent' ? 'text-accent' : 'text-primary-light');
                        ?>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full <?php echo esc_attr($box); ?> flex items-center justify-center flex-shrink-0 mt-1">
                                <i data-lucide="<?php echo esc_attr($b_icon); ?>" class="w-3 h-3 <?php echo esc_attr($icon_color); ?>"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-text-main-light mb-1"><?php echo esc_html($b_title); ?></h4>
                                <p class="text-xs sm:text-sm text-text-secondary-light"><?php echo esc_html($b_desc); ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-primary to-primary-dark rounded-xl sm:rounded-2xl p-4 sm:p-6 text-white">
                    <h3 class="text-base sm:text-lg md:text-xl font-bold mb-4"><?php echo esc_html($cta_heading); ?></h3>
                    <p class="text-sm text-white/80 mb-6"><?php echo esc_html($cta_desc); ?></p>
                    <div class="space-y-4">
                        <a href="<?php echo esc_url($cta_btn1['url']); ?>" <?php echo !empty($cta_btn1['target']) ? ' target="' . esc_attr($cta_btn1['target']) . '"' : ''; ?> class="w-full px-4 py-3 bg-white text-primary rounded-lg font-bold hover:bg-white/90 transition-all flex items-center justify-center gap-2 group text-sm">
                            <i data-lucide="<?php echo esc_attr($cta_icon1); ?>" class="w-4 h-4"></i>
                            <?php echo esc_html(isset($cta_btn1['title']) ? $cta_btn1['title'] : 'View Performance Schedule'); ?>
                        </a>
                        <a href="<?php echo esc_url($cta_btn2['url']); ?>" <?php echo !empty($cta_btn2['target']) ? ' target="' . esc_attr($cta_btn2['target']) . '"' : ''; ?> class="w-full px-4 py-3 bg-white/20 border border-white/30 text-white rounded-lg font-bold hover:bg-white/30 transition-all flex items-center justify-center gap-2 group text-sm">
                            <i data-lucide="<?php echo esc_attr($cta_icon2); ?>" class="w-4 h-4"></i>
                            <?php echo esc_html(isset($cta_btn2['title']) ? $cta_btn2['title'] : 'Enroll in Music Program'); ?>
                        </a>
                    </div>
                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <?php foreach (array_slice($cta_stats, 0, 4) as $stat) : ?>
                        <div class="text-center p-3 rounded-lg bg-white/10">
                            <div class="text-base sm:text-lg font-bold mb-1"><?php echo esc_html((string) (isset($stat['number']) ? $stat['number'] : '')); ?></div>
                            <div class="text-xs font-medium text-white/80"><?php echo esc_html((string) (isset($stat['label']) ? $stat['label'] : '')); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
