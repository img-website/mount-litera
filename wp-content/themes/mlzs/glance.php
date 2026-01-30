<?php
/**
 * Template Name: Life at a Glance Page
 * Glance: Hero, Intro row (Student Culture, Center image, Academic Excellence), Second row (Talents, Leadership, Life image), Key Highlights, Quote, CTA – ACF dynamic
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
$hero_badge     = $opt ? get_field('glance_hero_badge', $page_id) : null;
$hero_icon      = $opt ? get_field('glance_hero_icon', $page_id) : null;
$hero_headline  = $opt ? get_field('glance_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('glance_hero_highlight', $page_id) : null;
$hero_sub       = $opt ? get_field('glance_hero_subheadline', $page_id) : null;

$hero_badge     = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'School Life';
$hero_icon      = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'eye';
$hero_headline  = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'Life at Mount Litera';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Glance';
$hero_sub       = ($hero_sub !== '' && $hero_sub !== null) ? (string) $hero_sub : 'A glimpse into the vibrant, enriching, and transformative educational journey at our institution.';

// ——— First Row ———
$student_icon   = $opt ? get_field('glance_student_icon', $page_id) : null;
$student_title  = $opt ? get_field('glance_student_title', $page_id) : null;
$student_content = $opt ? get_field('glance_student_content', $page_id) : null;
$center_image   = $opt ? get_field('glance_center_image', $page_id) : null;
$center_caption = $opt ? get_field('glance_center_caption', $page_id) : null;
$academic_icon  = $opt ? get_field('glance_academic_icon', $page_id) : null;
$academic_title = $opt ? get_field('glance_academic_title', $page_id) : null;
$academic_content = $opt ? get_field('glance_academic_content', $page_id) : null;
$academic_note  = $opt ? get_field('glance_academic_note', $page_id) : null;

$student_icon   = (is_string($student_icon) && trim($student_icon) !== '') ? trim($student_icon) : 'users';
$student_title  = ($student_title !== '' && $student_title !== null) ? (string) $student_title : 'Student Culture';
$student_content = ($student_content !== '' && $student_content !== null) ? $student_content : 'Students set the tone for our school. They are passionate, principled committed, persistent and trained to excel. They share a desire to challenge themselves.<br><br>By cultivating qualities such as analytical reasoning, self criticism and intellectual honesty. A culture of critical thinking and risk taking is developed wherein everything and everyone is open to being challenged and questioned.';
$center_caption = ($center_caption !== '' && $center_caption !== null) ? (string) $center_caption : 'Vibrant Campus Life';
$academic_icon  = (is_string($academic_icon) && trim($academic_icon) !== '') ? trim($academic_icon) : 'award';
$academic_title = ($academic_title !== '' && $academic_title !== null) ? (string) $academic_title : 'Academic Excellence';
$academic_content = ($academic_content !== '' && $academic_content !== null) ? $academic_content : 'Their passion to succeed promotes a stimulating intellectual climate which help pursue excellence.<br><br>Apart from regular courses, our institutions offer examinations* in various subjects in collaboration with the University of Cambridge and offers subjects like Environmental Studies, Sustainable development programmes, Psychology etc. which enhance the skills to the optimum level.';
$academic_note  = ($academic_note !== '' && $academic_note !== null) ? (string) $academic_note : '*Subject to availability and student eligibility';

$center_image_url = '';
if (!empty($center_image)) {
    if (is_array($center_image) && !empty($center_image['url'])) $center_image_url = $center_image['url'];
    elseif (is_numeric($center_image)) $center_image_url = wp_get_attachment_image_url((int) $center_image, 'full') ?: '';
}
if ($center_image_url === '') $center_image_url = 'https://images.unsplash.com/photo-1498243691581-b145c3f54a5a?w=800&h=600&fit=crop';

// ——— Second Row ———
$talents_icon   = $opt ? get_field('glance_talents_icon', $page_id) : null;
$talents_title  = $opt ? get_field('glance_talents_title', $page_id) : null;
$talents_content = $opt ? get_field('glance_talents_content', $page_id) : null;
$leadership_icon = $opt ? get_field('glance_leadership_icon', $page_id) : null;
$leadership_title = $opt ? get_field('glance_leadership_title', $page_id) : null;
$leadership_content = $opt ? get_field('glance_leadership_content', $page_id) : null;
$life_image     = $opt ? get_field('glance_life_image', $page_id) : null;
$life_title     = $opt ? get_field('glance_life_title', $page_id) : null;
$life_subtitle  = $opt ? get_field('glance_life_subtitle', $page_id) : null;
$life_icon      = $opt ? get_field('glance_life_icon', $page_id) : null;

$talents_icon   = (is_string($talents_icon) && trim($talents_icon) !== '') ? trim($talents_icon) : 'music';
$talents_title  = ($talents_title !== '' && $talents_title !== null) ? (string) $talents_title : 'Developing Talents';
$talents_content = ($talents_content !== '' && $talents_content !== null) ? $talents_content : 'Theatre has been the backbone for improving the Standards of "Learning and Imparting meaningful Education through an experience" where the expressions of daily life are exhibited under the guidance of Professionals.<br><br>We invite the students to pursue higher education in music and theatre by streamlining the process for training under "master". We encourage every student to take part in Music, Theater and Dance be it Indian, Western, Classical or Popular.<br><br>It is our policy to support Choirs, Bands and present an Orchestra of Concert level.';
$leadership_icon = (is_string($leadership_icon) && trim($leadership_icon) !== '') ? trim($leadership_icon) : 'target';
$leadership_title = ($leadership_title !== '' && $leadership_title !== null) ? (string) $leadership_title : 'Leadership';
$leadership_content = ($leadership_content !== '' && $leadership_content !== null) ? $leadership_content : 'Learning is an essential part of our life. What carries us through life is our ability to grow, to discover new possibilities in ourselves and the world.<br><br>Our students will not shirk from the unknown fear, but embrace change with a consummate faith in the deepest principles of existence.<br><br>Living on the edge, leading from the edge, they respond to uncertainty by joyously seeking their balance in dynamic interaction with the challenges of life.';
$life_title     = ($life_title !== '' && $life_title !== null) ? (string) $life_title : 'Life at Mount Litera';
$life_subtitle  = ($life_subtitle !== '' && $life_subtitle !== null) ? (string) $life_subtitle : 'Moments that define the Mount Litera experience';
$life_icon      = (is_string($life_icon) && trim($life_icon) !== '') ? trim($life_icon) : 'image';

$life_image_url = '';
if (!empty($life_image)) {
    if (is_array($life_image) && !empty($life_image['url'])) $life_image_url = $life_image['url'];
    elseif (is_numeric($life_image)) $life_image_url = wp_get_attachment_image_url((int) $life_image, 'full') ?: '';
}
if ($life_image_url === '') $life_image_url = 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800&h=600&fit=crop';

// ——— Key Highlights ———
$hl_badge   = $opt ? get_field('glance_hl_badge', $page_id) : null;
$hl_icon    = $opt ? get_field('glance_hl_icon', $page_id) : null;
$hl_heading = $opt ? get_field('glance_hl_heading', $page_id) : null;
$hl_highlight = $opt ? get_field('glance_hl_highlight', $page_id) : null;
$hl_subtext = $opt ? get_field('glance_hl_subtext', $page_id) : null;
$hl_cards   = $opt ? get_field('glance_hl_cards', $page_id) : null;

$hl_badge   = ($hl_badge !== '' && $hl_badge !== null) ? (string) $hl_badge : 'Key Highlights';
$hl_icon    = (is_string($hl_icon) && trim($hl_icon) !== '') ? trim($hl_icon) : 'star';
$hl_heading = ($hl_heading !== '' && $hl_heading !== null) ? (string) $hl_heading : 'What Makes Us';
$hl_highlight = ($hl_highlight !== '' && $hl_highlight !== null) ? (string) $hl_highlight : 'Different';
$hl_subtext = ($hl_subtext !== '' && $hl_subtext !== null) ? (string) $hl_subtext : 'Our approach to education goes beyond academics to shape well-rounded individuals';
$default_hl_cards = array(
    array('icon' => 'brain', 'title' => 'Critical Thinking', 'description' => 'Developing analytical reasoning and intellectual honesty through challenging curriculum', 'style' => 'primary'),
    array('icon' => 'palette', 'title' => 'Arts & Creativity', 'description' => 'Comprehensive programs in theatre, music, dance, and visual arts with professional guidance', 'style' => 'accent'),
    array('icon' => 'graduation-cap', 'title' => 'Global Partnerships', 'description' => 'Cambridge University collaborations offering diverse subjects and international exposure', 'style' => 'primary-light'),
    array('icon' => 'trending-up', 'title' => 'Leadership Development', 'description' => 'Nurturing future leaders who embrace challenges and drive positive change', 'style' => 'accent-dark'),
);
$hl_cards = (is_array($hl_cards) && count($hl_cards) >= 4) ? $hl_cards : $default_hl_cards;

// ——— Quote ———
$quote_text   = $opt ? get_field('glance_quote_text', $page_id) : null;
$quote_author = $opt ? get_field('glance_quote_author', $page_id) : null;
$quote_title  = $opt ? get_field('glance_quote_title', $page_id) : null;

$quote_text   = ($quote_text !== '' && $quote_text !== null) ? (string) $quote_text : '"Living on the edge, leading from the edge, they respond to uncertainty by joyously seeking their balance in dynamic interaction with the challenges of life."';
$quote_author = ($quote_author !== '' && $quote_author !== null) ? (string) $quote_author : 'Mount Litera Philosophy';
$quote_title  = ($quote_title !== '' && $quote_title !== null) ? (string) $quote_title : 'Our approach to leadership and personal growth';

// ——— CTA ———
$cta_heading = $opt ? get_field('glance_cta_heading', $page_id) : null;
$cta_text    = $opt ? get_field('glance_cta_text', $page_id) : null;
$cta_btn1_icon = $opt ? get_field('glance_cta_btn1_icon', $page_id) : null;
$cta_btn1_link = $opt ? get_field('glance_cta_btn1_link', $page_id) : null;
$cta_btn2_icon = $opt ? get_field('glance_cta_btn2_icon', $page_id) : null;
$cta_btn2_link = $opt ? get_field('glance_cta_btn2_link', $page_id) : null;

$cta_heading   = ($cta_heading !== '' && $cta_heading !== null) ? (string) $cta_heading : 'Experience the Mount Litera Difference';
$cta_text     = ($cta_text !== '' && $cta_text !== null) ? (string) $cta_text : 'Join our community of passionate learners, thinkers, and leaders shaping the future.';
$cta_btn1_icon = (is_string($cta_btn1_icon) && trim($cta_btn1_icon) !== '') ? trim($cta_btn1_icon) : 'calendar';
$cta_btn2_icon = (is_string($cta_btn2_icon) && trim($cta_btn2_icon) !== '') ? trim($cta_btn2_icon) : 'download';
$cta_btn1_url = is_array($cta_btn1_link) && !empty($cta_btn1_link['url']) ? esc_url($cta_btn1_link['url']) : $home_url . '#';
$cta_btn1_target = is_array($cta_btn1_link) && !empty($cta_btn1_link['target']) ? $cta_btn1_link['target'] : '_self';
$cta_btn1_text = (is_array($cta_btn1_link) && !empty(trim((string) $cta_btn1_link['title']))) ? trim($cta_btn1_link['title']) : 'Schedule a Visit';
$cta_btn2_url = is_array($cta_btn2_link) && !empty($cta_btn2_link['url']) ? esc_url($cta_btn2_link['url']) : $home_url . '#';
$cta_btn2_target = is_array($cta_btn2_link) && !empty($cta_btn2_link['target']) ? $cta_btn2_link['target'] : '_self';
$cta_btn2_text = (is_array($cta_btn2_link) && !empty(trim((string) $cta_btn2_link['title']))) ? trim($cta_btn2_link['title']) : 'Download Brochure';
?>

    <!-- Hero Section -->
    <section class="relative px-4 sm:px-6 lg:px-8 pt-32 pb-10 md:pt-40 md:pb-24 bg-gradient-to-br from-primary-dark via-primary to-primary-light overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-64 h-64 rounded-full bg-accent blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 rounded-full bg-accent-light blur-3xl"></div>
        </div>
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/30 mb-4 sm:mb-6 animate-fade-in-up">
                    <i data-lucide="<?php echo esc_attr($hero_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 text-accent"></i>
                    <span class="text-xs sm:text-sm font-semibold text-white uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 sm:mb-6 tracking-tight">
                    <?php echo esc_html($hero_headline); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent to-accent-light"><?php echo esc_html($hero_highlight); ?></span>
                </h1>
                <p class="text-sm sm:text-base md:text-lg text-slate-200 mb-6 sm:mb-8 max-w-3xl mx-auto">
                    <?php echo esc_html($hero_sub); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="px-4 sm:px-6 lg:px-8 py-10 sm:py-12 md:py-16 bg-background-light">
        <div class="max-w-7xl mx-auto">
            <!-- First Row -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8 mb-10 sm:mb-12 md:mb-16">
                <div class="bg-white rounded-2xl p-4 sm:p-6 md:p-8 shadow-soft border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <h3 class="text-xl sm:text-2xl font-bold text-primary mb-3 sm:mb-4 flex items-center gap-2 sm:gap-3">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 rounded-lg bg-primary/10 flex items-center justify-center">
                            <i data-lucide="<?php echo esc_attr($student_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 text-primary"></i>
                        </div>
                        <?php echo esc_html($student_title); ?>
                    </h3>
                    <div class="space-y-3 sm:space-y-4 text-sm sm:text-base text-gray-600 leading-relaxed">
                        <?php echo wp_kses_post($student_content); ?>
                    </div>
                </div>
                <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-gray-100 to-gray-200 shadow-soft border border-gray-100 group">
                    <img src="<?php echo esc_url($center_image_url); ?>" alt="<?php echo esc_attr($center_caption); ?>" class="size-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent flex items-end p-4 sm:p-6">
                        <div class="text-white">
                            <h4 class="text-base sm:text-lg font-bold"><?php echo esc_html($center_caption); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl p-4 sm:p-6 md:p-8 shadow-soft border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <h3 class="text-xl sm:text-2xl font-bold text-primary-light mb-3 sm:mb-4 flex items-center gap-2 sm:gap-3">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 rounded-lg bg-primary-light/10 flex items-center justify-center">
                            <i data-lucide="<?php echo esc_attr($academic_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 text-primary-light"></i>
                        </div>
                        <?php echo esc_html($academic_title); ?>
                    </h3>
                    <div class="space-y-3 sm:space-y-4 text-sm sm:text-base text-gray-600 leading-relaxed">
                        <?php echo wp_kses_post($academic_content); ?>
                        <div class="text-xs text-gray-500 italic mt-3 sm:mt-4"><?php echo esc_html($academic_note); ?></div>
                    </div>
                </div>
            </div>

            <!-- Second Row -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
                <div class="bg-white rounded-2xl p-4 sm:p-6 md:p-8 shadow-soft border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4 sm:mb-6">
                        <h3 class="text-xl sm:text-2xl font-bold text-accent"><?php echo esc_html($talents_title); ?></h3>
                        <div class="w-8 h-8 sm:w-9 sm:h-9 md:w-10 md:h-10 rounded-full bg-accent/10 flex items-center justify-center shrink-0">
                            <i data-lucide="<?php echo esc_attr($talents_icon); ?>" class="w-5 h-5 sm:w-6 sm:h-6 text-accent"></i>
                        </div>
                    </div>
                    <div class="space-y-3 sm:space-y-4 text-sm sm:text-base text-gray-600 leading-relaxed">
                        <?php echo wp_kses_post($talents_content); ?>
                    </div>
                </div>
                <div class="bg-white rounded-2xl p-4 sm:p-6 md:p-8 shadow-soft border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4 sm:mb-6">
                        <h3 class="text-xl sm:text-2xl font-bold text-accent-dark"><?php echo esc_html($leadership_title); ?></h3>
                        <div class="w-8 h-8 sm:w-9 sm:h-9 md:w-10 md:h-10 rounded-full bg-accent-dark/10 flex items-center justify-center shrink-0">
                            <i data-lucide="<?php echo esc_attr($leadership_icon); ?>" class="w-5 h-5 sm:w-6 sm:h-6 text-accent-dark"></i>
                        </div>
                    </div>
                    <div class="space-y-3 sm:space-y-4 text-sm sm:text-base text-gray-600 leading-relaxed">
                        <?php echo wp_kses_post($leadership_content); ?>
                    </div>
                </div>
                <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-gray-100 to-gray-200 shadow-soft border border-gray-100 group">
                    <img src="<?php echo esc_url($life_image_url); ?>" alt="<?php echo esc_attr($life_title); ?>" class="w-full h-full min-h-[250px] sm:min-h-[300px] object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent flex flex-col justify-end p-4 sm:p-6">
                        <h3 class="text-xl sm:text-2xl font-bold text-white mb-1 sm:mb-2"><?php echo esc_html($life_title); ?></h3>
                        <div class="text-white/90 text-xs sm:text-sm">
                            <p><?php echo esc_html($life_subtitle); ?></p>
                        </div>
                    </div>
                    <div class="absolute top-3 right-3 sm:top-4 sm:right-4 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                        <i data-lucide="<?php echo esc_attr($life_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 text-white"></i>
                    </div>
                </div>
            </div>

            <!-- Key Highlights -->
            <div class="mt-10 sm:mt-12 md:mt-16">
                <div class="text-center mb-8 sm:mb-10 md:mb-12">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-primary/10 border border-primary/20 mb-3 sm:mb-4 animate-fade-in-up">
                        <i data-lucide="<?php echo esc_attr($hl_icon); ?>" class="w-3 h-3 sm:w-4 sm:h-4 text-primary"></i>
                        <span class="text-xs sm:text-sm font-semibold text-primary uppercase tracking-wider"><?php echo esc_html($hl_badge); ?></span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-3 sm:mb-4">
                        <?php echo esc_html($hl_heading); ?> <span class="text-primary"><?php echo esc_html($hl_highlight); ?></span>
                    </h2>
                    <p class="text-sm sm:text-base text-gray-600 max-w-2xl mx-auto">
                        <?php echo esc_html($hl_subtext); ?>
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 md:gap-6">
                    <?php foreach ($hl_cards as $card) :
                        $c_icon = isset($card['icon']) && trim((string) $card['icon']) !== '' ? trim($card['icon']) : 'star';
                        $c_title = isset($card['title']) ? (string) $card['title'] : '';
                        $c_desc = isset($card['description']) ? (string) $card['description'] : '';
                        $c_style = isset($card['style']) && trim((string) $card['style']) !== '' ? trim($card['style']) : 'primary';
                        $card_wrapper = 'bg-gradient-to-br from-primary/5 to-primary/10 rounded-2xl p-4 sm:p-5 md:p-6 border border-primary/20 hover:border-primary/40 transition-all group';
                        $icon_wrapper = 'w-10 h-10 sm:w-11 sm:h-11 md:w-12 md:h-12 rounded-xl bg-primary/20 flex items-center justify-center mb-3 sm:mb-4 group-hover:bg-primary group-hover:text-white transition-colors';
                        $icon_class = 'w-5 h-5 sm:w-6 sm:h-6 text-primary group-hover:text-white';
                        if ($c_style === 'accent') {
                            $card_wrapper = 'bg-gradient-to-br from-accent/5 to-accent/10 rounded-2xl p-4 sm:p-5 md:p-6 border border-accent/20 hover:border-accent/40 transition-all group';
                            $icon_wrapper = 'w-10 h-10 sm:w-11 sm:h-11 md:w-12 md:h-12 rounded-xl bg-accent/20 flex items-center justify-center mb-3 sm:mb-4 group-hover:bg-accent group-hover:text-white transition-colors';
                            $icon_class = 'w-5 h-5 sm:w-6 sm:h-6 text-accent group-hover:text-white';
                        } elseif ($c_style === 'primary-light') {
                            $card_wrapper = 'bg-gradient-to-br from-primary-light/5 to-primary-light/10 rounded-2xl p-4 sm:p-5 md:p-6 border border-primary-light/20 hover:border-primary-light/40 transition-all group';
                            $icon_wrapper = 'w-10 h-10 sm:w-11 sm:h-11 md:w-12 md:h-12 rounded-xl bg-primary-light/20 flex items-center justify-center mb-3 sm:mb-4 group-hover:bg-primary-light group-hover:text-white transition-colors';
                            $icon_class = 'w-5 h-5 sm:w-6 sm:h-6 text-primary-light group-hover:text-white';
                        } elseif ($c_style === 'accent-dark') {
                            $card_wrapper = 'bg-gradient-to-br from-accent-dark/5 to-accent-dark/10 rounded-2xl p-4 sm:p-5 md:p-6 border border-accent-dark/20 hover:border-accent-dark/40 transition-all group';
                            $icon_wrapper = 'w-10 h-10 sm:w-11 sm:h-11 md:w-12 md:h-12 rounded-xl bg-accent-dark/20 flex items-center justify-center mb-3 sm:mb-4 group-hover:bg-accent-dark group-hover:text-white transition-colors';
                            $icon_class = 'w-5 h-5 sm:w-6 sm:h-6 text-accent-dark group-hover:text-white';
                        }
                    ?>
                    <div class="<?php echo esc_attr($card_wrapper); ?>">
                        <div class="<?php echo esc_attr($icon_wrapper); ?>">
                            <i data-lucide="<?php echo esc_attr($c_icon); ?>" class="<?php echo esc_attr($icon_class); ?>"></i>
                        </div>
                        <h3 class="text-base sm:text-lg md:text-xl font-bold text-gray-900 mb-1 sm:mb-2"><?php echo esc_html($c_title); ?></h3>
                        <p class="text-xs sm:text-sm text-gray-600"><?php echo esc_html($c_desc); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Quote -->
            <div class="mt-10 sm:mt-12 md:mt-16 bg-gradient-to-r from-primary/10 to-primary-light/10 rounded-2xl p-4 sm:p-6 md:p-8 border border-primary/20">
                <div class="flex flex-col md:flex-row items-center gap-6 sm:gap-8">
                    <div class="md:w-1/4">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 rounded-full bg-gradient-to-br from-primary to-primary-light flex items-center justify-center mx-auto">
                            <i data-lucide="quote" class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 text-white"></i>
                        </div>
                    </div>
                    <div class="md:w-3/4">
                        <blockquote class="text-lg sm:text-xl md:text-2xl italic text-gray-700 mb-3 sm:mb-4">
                            <?php echo esc_html($quote_text); ?>
                        </blockquote>
                        <div class="flex items-center gap-3 sm:gap-4">
                            <div class="w-1 h-6 sm:h-8 bg-accent rounded-full"></div>
                            <div>
                                <p class="text-sm sm:text-base font-bold text-gray-900"><?php echo esc_html($quote_author); ?></p>
                                <p class="text-xs sm:text-sm text-gray-600"><?php echo esc_html($quote_title); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="px-4 sm:px-6 lg:px-8 [&_+_footer]:rounded-t-[0px] py-10 sm:py-12 md:py-16 bg-gradient-to-r from-primary-dark to-primary">
        <div class="max-w-7xl mx-auto">
            <div class="text-center text-white">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4 sm:mb-6"><?php echo esc_html($cta_heading); ?></h2>
                <p class="text-sm sm:text-base md:text-lg text-slate-200 mb-6 sm:mb-8 max-w-2xl mx-auto">
                    <?php echo esc_html($cta_text); ?>
                </p>
                <div class="flex flex-row gap-3 sm:gap-4 justify-center items-center">
                    <a href="<?php echo $cta_btn1_url; ?>" target="<?php echo esc_attr($cta_btn1_target); ?>" class="px-4 py-2 sm:px-6 sm:py-3 md:px-8 md:py-3 bg-white text-primary text-sm sm:text-base font-bold rounded-full hover:bg-slate-100 transition-all flex items-center justify-center gap-2 group">
                        <i data-lucide="<?php echo esc_attr($cta_btn1_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        <?php echo esc_html($cta_btn1_text); ?>
                    </a>
                    <a href="<?php echo $cta_btn2_url; ?>" target="<?php echo esc_attr($cta_btn2_target); ?>" class="px-4 py-2 sm:px-6 sm:py-3 md:px-8 md:py-3 bg-transparent border-2 border-white text-white text-sm sm:text-base font-bold rounded-full hover:bg-white/10 transition-all flex items-center justify-center gap-2 group">
                        <i data-lucide="<?php echo esc_attr($cta_btn2_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        <?php echo esc_html($cta_btn2_text); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
