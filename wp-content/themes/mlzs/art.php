<?php
/**
 * Template Name: Art & Craft Page
 * Art & Craft: Hero, Main Content (description, labs, images), Curriculum, Benefits, CTA (ACF dynamic)
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
$hero_badge     = $opt ? get_field('art_hero_badge', $page_id) : null;
$hero_icon      = $opt ? get_field('art_hero_icon', $page_id) : null;
$hero_headline  = $opt ? get_field('art_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('art_hero_highlight', $page_id) : null;
$hero_sub       = $opt ? get_field('art_hero_subheadline', $page_id) : null;

$hero_badge     = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Creative Expression';
$hero_icon      = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'palette';
$hero_headline  = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'Art &';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Craft';
$hero_sub       = ($hero_sub !== '' && $hero_sub !== null) ? (string) $hero_sub : 'Nurturing imagination and creativity through hands-on artistic experiences';

// ——— Main content (description card) ———
$content_heading   = $opt ? get_field('art_content_heading', $page_id) : null;
$content_para1     = $opt ? get_field('art_content_para1', $page_id) : null;
$content_para2     = $opt ? get_field('art_content_para2', $page_id) : null;
$content_para3     = $opt ? get_field('art_content_para3', $page_id) : null;
$content_labs_heading = $opt ? get_field('art_content_labs_heading', $page_id) : null;
$content_junior_label = $opt ? get_field('art_content_junior_label', $page_id) : null;
$content_junior_classes = $opt ? get_field('art_content_junior_classes', $page_id) : null;
$content_senior_label = $opt ? get_field('art_content_senior_label', $page_id) : null;
$content_senior_classes = $opt ? get_field('art_content_senior_classes', $page_id) : null;

$content_heading   = ($content_heading !== '' && $content_heading !== null) ? (string) $content_heading : 'The Art of Creative Expression';
$content_para1     = ($content_para1 !== '' && $content_para1 !== null) ? (string) $content_para1 : 'Works of art are "intrinsically final": they appeal purely at the level of the imagination and aren\'t good for any practical utility.';
$content_para2     = ($content_para2 !== '' && $content_para2 !== null) ? (string) $content_para2 : 'As all arts in some way involve techniques that can be taught and learned, that are to some extent governed by rules and routine, and that produce a preconceived result, all arts involve craft.';
$content_para3     = ($content_para3 !== '' && $content_para3 !== null) ? (string) $content_para3 : 'So we have junior lab for class 1-4 and Senior lab for class 5-9 where students paint their imagination and try to nurture their inner craft skills.';
$content_labs_heading = ($content_labs_heading !== '' && $content_labs_heading !== null) ? (string) $content_labs_heading : 'Our Art Labs';
$content_junior_label = ($content_junior_label !== '' && $content_junior_label !== null) ? (string) $content_junior_label : 'Junior Art Lab';
$content_junior_classes = ($content_junior_classes !== '' && $content_junior_classes !== null) ? (string) $content_junior_classes : 'For Classes 1-4';
$content_senior_label = ($content_senior_label !== '' && $content_senior_label !== null) ? (string) $content_senior_label : 'Senior Art Lab';
$content_senior_classes = ($content_senior_classes !== '' && $content_senior_classes !== null) ? (string) $content_senior_classes : 'For Classes 5-9';

// ——— Images ———
$img1 = $opt ? get_field('art_image_1', $page_id) : null;
$img2 = $opt ? get_field('art_image_2', $page_id) : null;
$img1_url = '';
if (is_array($img1) && !empty($img1['url'])) $img1_url = (string) $img1['url'];
elseif (is_string($img1) && $img1 !== '') $img1_url = (string) $img1;
if ($img1_url === '') $img1_url = 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';

$img2_url = '';
if (is_array($img2) && !empty($img2['url'])) $img2_url = (string) $img2['url'];
elseif (is_string($img2) && $img2 !== '') $img2_url = (string) $img2;
if ($img2_url === '') $img2_url = 'https://images.unsplash.com/photo-1509228468518-180dd4864904?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';

$img1_title = $opt ? get_field('art_image_1_title', $page_id) : null;
$img1_caption = $opt ? get_field('art_image_1_caption', $page_id) : null;
$img2_title = $opt ? get_field('art_image_2_title', $page_id) : null;
$img2_caption = $opt ? get_field('art_image_2_caption', $page_id) : null;
$img1_title   = ($img1_title !== '' && $img1_title !== null) ? (string) $img1_title : 'Junior Art Lab';
$img1_caption = ($img1_caption !== '' && $img1_caption !== null) ? (string) $img1_caption : 'Classes 1-4 students exploring creativity';
$img2_title   = ($img2_title !== '' && $img2_title !== null) ? (string) $img2_title : 'Senior Craft Lab';
$img2_caption = ($img2_caption !== '' && $img2_caption !== null) ? (string) $img2_caption : 'Classes 5-9 developing advanced skills';

// ——— Curriculum & Activities ———
$curriculum_heading = $opt ? get_field('art_curriculum_heading', $page_id) : null;
$curriculum_items   = $opt ? get_field('art_curriculum_items', $page_id) : null;
$activities_heading = $opt ? get_field('art_activities_heading', $page_id) : null;
$activities_items   = $opt ? get_field('art_activities_items', $page_id) : null;

$curriculum_heading = ($curriculum_heading !== '' && $curriculum_heading !== null) ? (string) $curriculum_heading : 'Our Art Curriculum';
$activities_heading = ($activities_heading !== '' && $activities_heading !== null) ? (string) $activities_heading : 'Activities & Events';
$default_curriculum = array('Drawing & Sketching Techniques', 'Painting with Various Mediums', 'Clay Modeling & Sculpture', 'Paper Craft & Origami');
$default_activities = array('Annual Art Exhibition', 'Inter-School Competitions', 'Art Workshops with Experts', 'Festival Theme Projects');
$curriculum_items = (is_array($curriculum_items) && !empty($curriculum_items)) ? $curriculum_items : $default_curriculum;
$activities_items = (is_array($activities_items) && !empty($activities_items)) ? $activities_items : $default_activities;

// ——— Benefits ———
$benefits_heading = $opt ? get_field('art_benefits_heading', $page_id) : null;
$benefits_sub     = $opt ? get_field('art_benefits_sub', $page_id) : null;
$benefits_cards   = $opt ? get_field('art_benefits_cards', $page_id) : null;

$benefits_heading = ($benefits_heading !== '' && $benefits_heading !== null) ? (string) $benefits_heading : 'Benefits of Art Education';
$benefits_sub     = ($benefits_sub !== '' && $benefits_sub !== null) ? (string) $benefits_sub : 'Developing creativity, critical thinking, and emotional expression through art';
$default_benefits = array(
    array('icon' => 'brain', 'title' => 'Cognitive Development', 'description' => 'Art enhances critical thinking, problem-solving skills, and improves memory and concentration.', 'style' => 'primary'),
    array('icon' => 'heart', 'title' => 'Emotional Expression', 'description' => 'Provides a healthy outlet for emotions, reduces stress, and boosts self-esteem and confidence.', 'style' => 'accent'),
    array('icon' => 'users', 'title' => 'Social Skills', 'description' => 'Collaborative art projects teach teamwork, communication, and appreciation for diverse perspectives.', 'style' => 'primary-light'),
);
$benefits_cards = (is_array($benefits_cards) && count($benefits_cards) >= 3) ? $benefits_cards : $default_benefits;

// ——— CTA ———
$cta_heading   = $opt ? get_field('art_cta_heading', $page_id) : null;
$cta_desc      = $opt ? get_field('art_cta_description', $page_id) : null;
$cta_btn1      = $opt ? get_field('art_cta_btn_primary', $page_id) : null;
$cta_btn2      = $opt ? get_field('art_cta_btn_secondary', $page_id) : null;
$cta_icon1     = $opt ? get_field('art_cta_btn_primary_icon', $page_id) : null;
$cta_icon2     = $opt ? get_field('art_cta_btn_secondary_icon', $page_id) : null;
$cta_stats     = $opt ? get_field('art_cta_stats', $page_id) : null;

$cta_heading   = ($cta_heading !== '' && $cta_heading !== null) ? (string) $cta_heading : 'Explore Your Creative Potential';
$cta_desc      = ($cta_desc !== '' && $cta_desc !== null) ? (string) $cta_desc : 'Join our art programs and discover the joy of creative expression in our state-of-the-art art labs.';
$cta_btn1      = (is_array($cta_btn1) && !empty($cta_btn1['url'])) ? $cta_btn1 : array('url' => $home_url . '#', 'title' => 'View Art Schedule', 'target' => '');
$cta_btn2      = (is_array($cta_btn2) && !empty($cta_btn2['url'])) ? $cta_btn2 : array('url' => $home_url . '#', 'title' => 'Art Gallery', 'target' => '');
$cta_icon1     = (is_string($cta_icon1) && trim($cta_icon1) !== '') ? trim($cta_icon1) : 'calendar';
$cta_icon2     = (is_string($cta_icon2) && trim($cta_icon2) !== '') ? trim($cta_icon2) : 'image';
$default_cta_stats = array(
    array('number' => '2', 'label' => 'Specialized Labs'),
    array('number' => '9', 'label' => 'Grade Levels'),
    array('number' => 'Yearly', 'label' => 'Exhibition'),
    array('number' => 'Expert', 'label' => 'Guidance'),
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
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8 mb-8 sm:mb-12">
                <!-- Description Column -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-soft border border-border-light h-full">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-primary/10 to-accent/10 flex items-center justify-center">
                                <i data-lucide="brush" class="w-6 h-6 text-primary"></i>
                            </div>
                            <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-text-main-light">
                                <?php echo esc_html($content_heading); ?>
                            </h2>
                        </div>

                        <div class="space-y-4">
                            <p class="text-sm text-text-secondary-light leading-relaxed">
                                <?php echo esc_html($content_para1); ?>
                            </p>

                            <div class="bg-gradient-to-r from-primary/5 to-accent/5 rounded-lg p-4 border border-primary/10">
                                <p class="text-sm text-text-secondary-light leading-relaxed">
                                    <?php echo esc_html($content_para2); ?>
                                </p>
                            </div>

                            <p class="text-sm text-text-secondary-light leading-relaxed">
                                <?php echo esc_html($content_para3); ?>
                            </p>
                        </div>

                        <div class="mt-8 pt-6 border-t border-border-light">
                            <h3 class="text-sm font-bold text-text-main-light mb-4 flex items-center gap-2">
                                <i data-lucide="sparkles" class="w-4 h-4 text-accent"></i>
                                <?php echo esc_html($content_labs_heading); ?>
                            </h3>
                            <div class="space-y-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center">
                                        <i data-lucide="users" class="w-4 h-4 text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-text-main-light"><?php echo esc_html($content_junior_label); ?></div>
                                        <div class="text-xs text-text-secondary-light"><?php echo esc_html($content_junior_classes); ?></div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-accent/10 flex items-center justify-center">
                                        <i data-lucide="users" class="w-4 h-4 text-accent"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-text-main-light"><?php echo esc_html($content_senior_label); ?></div>
                                        <div class="text-xs text-text-secondary-light"><?php echo esc_html($content_senior_classes); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Columns -->
                <div class="lg:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                        <div class="group relative overflow-hidden rounded-xl sm:rounded-2xl shadow-soft hover:shadow-xl transition-all duration-500">
                            <div class="h-48 sm:h-56 md:h-64 bg-gray-100">
                                <img src="<?php echo esc_url($img1_url); ?>" alt="<?php echo esc_attr($img1_title); ?>" class="w-full h-full object-cover">
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4 md:p-6">
                                <div class="text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                    <h4 class="font-bold text-base sm:text-lg mb-1"><?php echo esc_html($img1_title); ?></h4>
                                    <p class="text-xs sm:text-sm opacity-90"><?php echo esc_html($img1_caption); ?></p>
                                </div>
                            </div>
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 rounded-full bg-white/90 backdrop-blur-sm text-primary text-xs font-bold">Art Lab</span>
                            </div>
                        </div>

                        <div class="group relative overflow-hidden rounded-xl sm:rounded-2xl shadow-soft hover:shadow-xl transition-all duration-500">
                            <div class="h-48 sm:h-56 md:h-64 bg-gray-100">
                                <img src="<?php echo esc_url($img2_url); ?>" alt="<?php echo esc_attr($img2_title); ?>" class="w-full h-full object-cover">
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4 md:p-6">
                                <div class="text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                    <h4 class="font-bold text-base sm:text-lg mb-1"><?php echo esc_html($img2_title); ?></h4>
                                    <p class="text-xs sm:text-sm opacity-90"><?php echo esc_html($img2_caption); ?></p>
                                </div>
                            </div>
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 rounded-full bg-white/90 backdrop-blur-sm text-accent text-xs font-bold">Craft Lab</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 sm:mt-8 bg-gradient-to-r from-primary/5 to-accent/5 rounded-xl sm:rounded-2xl p-6 border border-primary/10">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <h3 class="text-sm sm:text-base font-bold text-text-main-light flex items-center gap-2">
                                    <i data-lucide="award" class="w-4 h-4 sm:w-5 sm:h-5 text-primary"></i>
                                    <?php echo esc_html($curriculum_heading); ?>
                                </h3>
                                <ul class="space-y-2">
                                    <?php foreach ((array) $curriculum_items as $item) :
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
                            <div class="space-y-4">
                                <h3 class="text-sm sm:text-base font-bold text-text-main-light flex items-center gap-2">
                                    <i data-lucide="calendar" class="w-4 h-4 sm:w-5 sm:h-5 text-accent"></i>
                                    <?php echo esc_html($activities_heading); ?>
                                </h3>
                                <ul class="space-y-2">
                                    <?php foreach ((array) $activities_items as $item) :
                                        $text = is_array($item) ? (isset($item['text']) ? $item['text'] : '') : (string) $item;
                                        if ($text === '') continue;
                                    ?>
                                    <li class="flex items-start gap-2">
                                        <i data-lucide="star" class="w-4 h-4 text-accent mt-1 flex-shrink-0"></i>
                                        <span class="text-sm text-text-secondary-light"><?php echo esc_html($text); ?></span>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Benefits Section -->
            <div class="mb-8 sm:mb-12">
                <div class="text-center mb-8">
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-text-main-light mb-4">
                        <?php echo esc_html($benefits_heading); ?>
                    </h3>
                    <p class="text-sm sm:text-base text-text-secondary-light max-w-2xl mx-auto">
                        <?php echo esc_html($benefits_sub); ?>
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php
                    $benefit_styles = array('primary', 'accent', 'primary-light');
                    foreach (array_slice($benefits_cards, 0, 3) as $idx => $card) :
                        $b_icon = isset($card['icon']) && trim((string) $card['icon']) !== '' ? trim((string) $card['icon']) : 'brain';
                        $b_title = isset($card['title']) ? (string) $card['title'] : '';
                        $b_desc  = isset($card['description']) ? (string) $card['description'] : '';
                        $b_style = isset($card['style']) && in_array($card['style'], array('primary', 'accent', 'primary-light'), true) ? $card['style'] : (isset($benefit_styles[$idx]) ? $benefit_styles[$idx] : 'primary');
                        $box_bg = $b_style === 'primary' ? 'bg-primary/10' : ($b_style === 'accent' ? 'bg-accent/10' : 'bg-primary-light/10');
                        $icon_color = $b_style === 'primary' ? 'text-primary' : ($b_style === 'accent' ? 'text-accent' : 'text-primary-light');
                        $border_hover = $b_style === 'primary' ? 'hover:border-primary/30' : ($b_style === 'accent' ? 'hover:border-accent/30' : 'hover:border-primary-light/30');
                    ?>
                    <div class="bg-white rounded-xl sm:rounded-2xl p-6 shadow-soft border border-border-light <?php echo esc_attr($border_hover); ?> transition-all duration-300 hover:-translate-y-1">
                        <div class="w-12 h-12 rounded-lg <?php echo esc_attr($box_bg); ?> flex items-center justify-center mb-4">
                            <i data-lucide="<?php echo esc_attr($b_icon); ?>" class="w-6 h-6 <?php echo esc_attr($icon_color); ?>"></i>
                        </div>
                        <h4 class="text-base sm:text-lg font-bold text-text-main-light mb-3"><?php echo esc_html($b_title); ?></h4>
                        <p class="text-sm text-text-secondary-light">
                            <?php echo esc_html($b_desc); ?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="bg-gradient-to-r from-primary to-primary-dark rounded-xl sm:rounded-2xl p-6 sm:p-8 text-white">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-center">
                    <div>
                        <h2 class="text-lg sm:text-xl md:text-2xl font-bold mb-4"><?php echo esc_html($cta_heading); ?></h2>
                        <p class="text-sm text-white/80 mb-6">
                            <?php echo esc_html($cta_desc); ?>
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="<?php echo esc_url($cta_btn1['url']); ?>" <?php echo !empty($cta_btn1['target']) ? ' target="' . esc_attr($cta_btn1['target']) . '"' : ''; ?> class="px-4 py-2 sm:px-6 sm:py-3 bg-white text-primary rounded-full font-bold hover:bg-white/90 transition-all flex items-center justify-center gap-2 group text-sm">
                                <i data-lucide="<?php echo esc_attr($cta_icon1); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                                <?php echo esc_html(isset($cta_btn1['title']) ? $cta_btn1['title'] : 'View Art Schedule'); ?>
                            </a>
                            <a href="<?php echo esc_url($cta_btn2['url']); ?>" <?php echo !empty($cta_btn2['target']) ? ' target="' . esc_attr($cta_btn2['target']) . '"' : ''; ?> class="px-4 py-2 sm:px-6 sm:py-3 bg-white/20 border border-white/30 text-white rounded-full font-bold hover:bg-white/30 transition-all flex items-center justify-center gap-2 group text-sm">
                                <i data-lucide="<?php echo esc_attr($cta_icon2); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                                <?php echo esc_html(isset($cta_btn2['title']) ? $cta_btn2['title'] : 'Art Gallery'); ?>
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <?php foreach (array_slice($cta_stats, 0, 4) as $stat) : ?>
                        <div class="bg-white/10 rounded-xl p-4 text-center border border-white/20">
                            <div class="text-base sm:text-lg md:text-xl font-bold mb-2"><?php echo esc_html((string) (isset($stat['number']) ? $stat['number'] : '')); ?></div>
                            <div class="text-xs font-medium text-white/80"><?php echo esc_html((string) (isset($stat['label']) ? $stat['label'] : '')); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
