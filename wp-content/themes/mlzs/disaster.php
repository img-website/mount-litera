<?php
/**
 * Template Name: Disaster Management Page
 * Disaster Management: full content from disaster.html – Hero, Aim/Need/Committee, SDMP (a/b structure), Dissemination, Drills, Safety, Health, CTA. All content & icons dynamic.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$theme_uri = get_template_directory_uri();
$home_url = home_url('/');
$opt = function_exists('get_field');

$default_list_icon = 'check-circle';

// ——— Hero ———
$hero_badge     = $opt ? get_field('disaster_hero_badge', $page_id) : null;
$hero_icon      = $opt ? get_field('disaster_hero_icon', $page_id) : null;
$hero_headline  = $opt ? get_field('disaster_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('disaster_hero_highlight', $page_id) : null;
$hero_sub       = $opt ? get_field('disaster_hero_subheadline', $page_id) : null;

$hero_badge     = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Safety First';
$hero_icon      = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'shield-alert';
$hero_headline  = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'Disaster';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Management';
$hero_sub       = ($hero_sub !== '' && $hero_sub !== null) ? (string) $hero_sub : 'Ensuring student and staff safety through comprehensive preparedness and response planning';

// ——— Aim & Need & Committee ———
$aim_icon    = $opt ? get_field('disaster_aim_icon', $page_id) : null;
$aim_heading = $opt ? get_field('disaster_aim_heading', $page_id) : null;
$aim_text    = $opt ? get_field('disaster_aim_text', $page_id) : null;
$need_icon    = $opt ? get_field('disaster_need_icon', $page_id) : null;
$need_heading = $opt ? get_field('disaster_need_heading', $page_id) : null;
$need_text    = $opt ? get_field('disaster_need_text', $page_id) : null;
$committee_icon    = $opt ? get_field('disaster_committee_icon', $page_id) : null;
$committee_heading = $opt ? get_field('disaster_committee_heading', $page_id) : null;
$committee_intro   = $opt ? get_field('disaster_committee_intro', $page_id) : null;
$committee_members = $opt ? get_field('disaster_committee_members', $page_id) : null;
$side_image = $opt ? get_field('disaster_side_image', $page_id) : null;

$aim_icon    = (is_string($aim_icon) && trim($aim_icon) !== '') ? trim($aim_icon) : 'target';
$aim_heading = ($aim_heading !== '' && $aim_heading !== null) ? (string) $aim_heading : 'Aim';
$aim_text    = ($aim_text !== '' && $aim_text !== null) ? (string) $aim_text : 'To ensure that the safety of the students and the staff is maintained during an emergency. The Disaster Management Plan is an instrument for achieving this aim in the school.';
$need_icon    = (is_string($need_icon) && trim($need_icon) !== '') ? trim($need_icon) : 'alert-triangle';
$need_heading = ($need_heading !== '' && $need_heading !== null) ? (string) $need_heading : 'Need For Disaster Management Plan';
$need_text    = ($need_text !== '' && $need_text !== null) ? (string) $need_text : 'The school is a densely populated place and has small children that are one of the most vulnerable groups in the society. To reduce this vulnerability particularly for schools, it is important to have a School Disaster Management Plan.';
$committee_icon    = (is_string($committee_icon) && trim($committee_icon) !== '') ? trim($committee_icon) : 'users';
$committee_heading = ($committee_heading !== '' && $committee_heading !== null) ? (string) $committee_heading : 'Disaster Management Committee';
$committee_intro   = ($committee_intro !== '' && $committee_intro !== null) ? (string) $committee_intro : 'Following are the members of school Disaster Management Committee who shall be taking care of the whole plan & drill.';
$committee_members = ($committee_members !== '' && $committee_members !== null) ? (string) $committee_members : "Mr. Lalit Bora\nMr. Anil Saini\nMr. Jitendra Gupta\nMrs. Shweta Prajapati\nMrs. Nitisha Joshi\nMrs. Indu Mittal";
$committee_students = $opt ? get_field('disaster_committee_students', $page_id) : null;
$committee_students = ($committee_students !== '' && $committee_students !== null) ? trim((string) $committee_students) : 'Students: Riya Verma, Deepak Yadav, Parth Sharma';
$side_image_url = '';
if (is_array($side_image) && !empty($side_image['url'])) {
    $side_image_url = $side_image['url'];
} elseif (is_string($side_image) && $side_image !== '') {
    $side_image_url = $side_image;
}
if ($side_image_url === '') {
    $side_image_url = 'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?w=800&q=80';
}

// ——— SDMP (a) and b) structure preserved) ———
$sdmp_heading = $opt ? get_field('disaster_sdmp_heading', $page_id) : null;
$sdmp_intro   = $opt ? get_field('disaster_sdmp_intro', $page_id) : null;
$sdmp_items   = $opt ? get_field('disaster_sdmp_items', $page_id) : null;

$sdmp_heading = ($sdmp_heading !== '' && $sdmp_heading !== null) ? (string) $sdmp_heading : 'Preparation of the School Disaster Management Plan Document';
$sdmp_intro   = ($sdmp_intro !== '' && $sdmp_intro !== null) ? (string) $sdmp_intro : 'The School Disaster Management Plan Document contains information as given below:';
$default_sdmp = array(
    array('label' => 'a)', 'icon' => '', 'text' => 'Physical location and demographic details of the school building and its surrounding environs including number of Classrooms, Laboratories, Activities Rooms, Play Grounds / Open spaces etc.'),
    array('label' => 'b)', 'icon' => '', 'text' => 'Material resources available in the school such as:'),
    array('label' => '', 'icon' => 'check', 'text' => 'Stretchers'),
    array('label' => '', 'icon' => 'check', 'text' => 'Fire extinguishers'),
    array('label' => '', 'icon' => 'check', 'text' => 'Ladders'),
    array('label' => '', 'icon' => 'check', 'text' => 'Thick ropes'),
);
$sdmp_items = (is_array($sdmp_items) && !empty($sdmp_items)) ? $sdmp_items : $default_sdmp;

// ——— Dissemination ———
$dissem_heading = $opt ? get_field('disaster_dissem_heading', $page_id) : null;
$dissem_intro   = $opt ? get_field('disaster_dissem_intro', $page_id) : null;
$dissem_activities = $opt ? get_field('disaster_dissem_activities', $page_id) : null;

$dissem_heading = ($dissem_heading !== '' && $dissem_heading !== null) ? (string) $dissem_heading : 'Dissemination Of The Information On SDMP To Everybody In The School';
$dissem_intro   = ($dissem_intro !== '' && $dissem_intro !== null) ? (string) $dissem_intro : 'Information about preparation of School Disaster Management Plan is disseminated through innovative activities like:';
$default_activities = array(
    array('icon' => 'palette', 'label' => 'Art Work'),
    array('icon' => 'pen-tool', 'label' => 'Poetry Writing'),
    array('icon' => 'theater', 'label' => 'Drama'),
    array('icon' => 'gamepad-2', 'label' => 'Sports'),
    array('icon' => 'activity', 'label' => 'Rescue Drills'),
    array('icon' => 'brain', 'label' => 'Memory Games'),
);
$dissem_activities = (is_array($dissem_activities) && !empty($dissem_activities)) ? $dissem_activities : $default_activities;

// ——— Mock Drills (all 3 cards, per-item icons – Fire uses alert-circle in HTML) ———
$drills_heading_icon = $opt ? get_field('disaster_drills_heading_icon', $page_id) : null;
$drills_heading     = $opt ? get_field('disaster_drills_heading', $page_id) : null;
$drills_intro       = $opt ? get_field('disaster_drills_intro', $page_id) : null;
$drills_cards       = $opt ? get_field('disaster_drills_cards', $page_id) : null;

$drills_heading_icon = (is_string($drills_heading_icon) && trim($drills_heading_icon) !== '') ? trim($drills_heading_icon) : 'alarm-clock';
$drills_heading     = ($drills_heading !== '' && $drills_heading !== null) ? (string) $drills_heading : 'Mock Drills';
$drills_intro       = ($drills_intro !== '' && $drills_intro !== null) ? (string) $drills_intro : 'Mock drills are conducted to train students and teachers and to test the various elements of your response plan in order to evaluate and revise it. During a disaster, life-protecting actions must be taken immediately. Drills and exercises are an extremely important part of your preparedness plan because they teach students, staff and parents how to respond to the complications of an actual disaster. The following drills should be conducted at least twice a year:';
$default_drill_cards = array(
    array('title' => 'Earthquake Drill', 'icon' => 'earthquake', 'style' => 'primary', 'items' => array(
        array('icon' => 'check-circle', 'text' => 'Practice drop, cover, and hold'),
        array('icon' => 'check-circle', 'text' => 'Evacuate classroom in less than 1 minute'),
        array('icon' => 'check-circle', 'text' => 'Evacuate school in less than 4 minutes'),
        array('icon' => 'check-circle', 'text' => 'Help those who need assistance'),
        array('icon' => 'check-circle', 'text' => 'Stay away from weak areas'),
    )),
    array('title' => 'Fire / Chemical Accident Drill', 'icon' => 'flame', 'style' => 'accent', 'items' => array(
        array('icon' => 'alert-circle', 'text' => 'Practice mock drills every month'),
        array('icon' => 'alert-circle', 'text' => 'Write clear instructions in Labs & Kitchen'),
        array('icon' => 'alert-circle', 'text' => 'Weekly quizzes on emergency procedures'),
        array('icon' => 'alert-circle', 'text' => 'Chemical safety protocols'),
        array('icon' => 'alert-circle', 'text' => 'First aid for chemical accidents'),
    )),
    array('title' => 'Cyclone Drill', 'icon' => 'wind', 'style' => 'primary-light', 'items' => array(
        array('icon' => 'radio', 'text' => 'Listen to cyclone warnings'),
        array('icon' => 'megaphone', 'text' => 'Make announcements in each class'),
        array('icon' => 'power-off', 'text' => 'Put off electricity'),
        array('icon' => 'gas', 'text' => 'Remove or close gas connections'),
        array('icon' => 'shield', 'text' => 'Explain outdoor safety measures'),
    )),
);
$drills_cards = (is_array($drills_cards) && count($drills_cards) >= 3) ? $drills_cards : $default_drill_cards;

// ——— Safety ———
$safety_cyclones_heading = $opt ? get_field('disaster_safety_cyclones_heading', $page_id) : null;
$safety_cyclones_para    = $opt ? get_field('disaster_safety_cyclones_para', $page_id) : null;
$safety_cyclones_list    = $opt ? get_field('disaster_safety_cyclones_list', $page_id) : null;
$safety_general_heading  = $opt ? get_field('disaster_safety_general_heading', $page_id) : null;
$safety_general_list     = $opt ? get_field('disaster_safety_general_list', $page_id) : null;

$safety_cyclones_heading = ($safety_cyclones_heading !== '' && $safety_cyclones_heading !== null) ? (string) $safety_cyclones_heading : 'Safety Precautions During Cyclones';
$safety_cyclones_para    = ($safety_cyclones_para !== '' && $safety_cyclones_para !== null) ? (string) $safety_cyclones_para : 'Cyclones generally strike with prior deterioration weather positions. In case cyclonic conditions develop during school hours:';
$default_cyclones = array(
    array('icon' => 'radio', 'text' => 'Listen to radio/TV for latest weather bulletins'),
    array('icon' => 'home', 'text' => 'Arrange for dispatch of children to homes'),
    array('icon' => 'package', 'text' => 'Prepare emergency kit with essential items'),
    array('icon' => 'arrow-up', 'text' => 'Shift to higher floors if area gets flooded'),
    array('icon' => 'shield', 'text' => 'Use boiled and filtered drinking water only'),
);
$safety_cyclones_list = (is_array($safety_cyclones_list) && !empty($safety_cyclones_list)) ? $safety_cyclones_list : $default_cyclones;
$safety_general_heading = ($safety_general_heading !== '' && $safety_general_heading !== null) ? (string) $safety_general_heading : 'General Precautions During Cyclone';
$default_general = array(
    array('icon' => 'ban', 'text' => "Don't allow children in floodwaters"),
    array('icon' => 'zap-off', 'text' => 'Stay away from electric poles & power-lines'),
    array('icon' => 'snake', 'text' => 'Beware of snakes during floods'),
    array('icon' => 'plug', 'text' => 'Avoid using electrical appliances'),
    array('icon' => 'alert-circle', 'text' => 'Seek medical help for any sickness'),
);
$safety_general_list = (is_array($safety_general_list) && !empty($safety_general_list)) ? $safety_general_list : $default_general;

// ——— Health & Guidelines ———
$health_norms_heading   = $opt ? get_field('disaster_health_norms_heading', $page_id) : null;
$health_norms_items     = $opt ? get_field('disaster_health_norms_items', $page_id) : null;
$health_hygiene_heading = $opt ? get_field('disaster_health_hygiene_heading', $page_id) : null;
$health_hygiene_list    = $opt ? get_field('disaster_health_hygiene_list', $page_id) : null;
$guidelines_heading     = $opt ? get_field('disaster_guidelines_heading', $page_id) : null;
$guidelines_list        = $opt ? get_field('disaster_guidelines_list', $page_id) : null;

$health_norms_heading   = ($health_norms_heading !== '' && $health_norms_heading !== null) ? (string) $health_norms_heading : 'Health and Safety Norms';
$default_norms = array(
    array('icon' => 'droplet', 'label' => 'Water safety report'),
    array('icon' => 'zap', 'label' => 'Electrical maintenance'),
    array('icon' => 'home', 'label' => 'Sanitation condition'),
    array('icon' => 'sun', 'label' => 'Illumination'),
    array('icon' => 'volume-2', 'label' => 'Noise control'),
    array('icon' => 'wind', 'label' => 'Ventilation'),
    array('icon' => 'shield', 'label' => 'Weather protection'),
    array('icon' => 'bus', 'label' => 'Travel safety norms'),
);
$health_norms_items = (is_array($health_norms_items) && !empty($health_norms_items)) ? $health_norms_items : $default_norms;
$health_hygiene_heading = ($health_hygiene_heading !== '' && $health_hygiene_heading !== null) ? (string) $health_hygiene_heading : 'Health and Hygiene Measures';
$default_hygiene = array(
    array('icon' => 'calendar', 'text' => 'Daily cleaning schedule for all spaces'),
    array('icon' => 'shield', 'text' => 'Regular disinfectant usage schedule'),
    array('icon' => 'trash-2', 'text' => 'Proper waste disposal systems'),
    array('icon' => 'test-tube', 'text' => 'Regular water testing'),
);
$health_hygiene_list = (is_array($health_hygiene_list) && !empty($health_hygiene_list)) ? $health_hygiene_list : $default_hygiene;
$guidelines_heading = ($guidelines_heading !== '' && $guidelines_heading !== null) ? (string) $guidelines_heading : 'Guidelines';
$default_guidelines = array(
    array('icon' => 'clipboard-check', 'text' => "SDMC to ensure every student's safety by complying with health and safety norms"),
    array('icon' => 'calendar', 'text' => 'Maintain maintenance schedule for all safety aspects'),
    array('icon' => 'file-text', 'text' => 'Prepare comprehensive disaster management manual'),
    array('icon' => 'activity', 'text' => 'Conduct safety audit twice a year'),
    array('icon' => 'first-aid', 'text' => 'First-aid boxes available at multiple locations'),
    array('icon' => 'user-check', 'text' => 'Annual health check-ups for students and staff'),
);
$guidelines_list = (is_array($guidelines_list) && !empty($guidelines_list)) ? $guidelines_list : $default_guidelines;

// ——— CTA ———
$cta_heading  = $opt ? get_field('disaster_cta_heading', $page_id) : null;
$cta_measures = $opt ? get_field('disaster_cta_measures', $page_id) : null;
$cta_btn1     = $opt ? get_field('disaster_cta_btn_primary', $page_id) : null;
$cta_btn2     = $opt ? get_field('disaster_cta_btn_secondary', $page_id) : null;
$cta_icon1    = $opt ? get_field('disaster_cta_btn_primary_icon', $page_id) : null;
$cta_icon2    = $opt ? get_field('disaster_cta_btn_secondary_icon', $page_id) : null;
$cta_stats    = $opt ? get_field('disaster_cta_stats', $page_id) : null;

$cta_heading  = ($cta_heading !== '' && $cta_heading !== null) ? (string) $cta_heading : 'Student Safety Measures';
$default_measures = array(
    array('icon' => 'bus', 'text' => 'Safe alighting and entering school buses'),
    array('icon' => 'shield', 'text' => 'Classrooms free of sharp objects'),
    array('icon' => 'eye', 'text' => 'No class left unattended'),
    array('icon' => 'users', 'text' => 'Monitoring during break times'),
    array('icon' => 'stairs', 'text' => 'Supervised movement on staircases'),
);
$cta_measures = (is_array($cta_measures) && !empty($cta_measures)) ? $cta_measures : $default_measures;
$cta_btn1  = (is_array($cta_btn1) && !empty($cta_btn1['url'])) ? $cta_btn1 : array('url' => $home_url . '#', 'title' => 'Download Safety Manual', 'target' => '');
$cta_btn2  = (is_array($cta_btn2) && !empty($cta_btn2['url'])) ? $cta_btn2 : array('url' => $home_url . '#', 'title' => 'Drill Schedule', 'target' => '');
$cta_icon1 = (is_string($cta_icon1) && trim($cta_icon1) !== '') ? trim($cta_icon1) : 'download';
$cta_icon2 = (is_string($cta_icon2) && trim($cta_icon2) !== '') ? trim($cta_icon2) : 'calendar';
$default_cta_stats = array(
    array('number' => '2x', 'label' => 'Annual Drills'),
    array('number' => '6+3', 'label' => 'Committee Members'),
    array('number' => '24/7', 'label' => 'Safety Monitoring'),
    array('number' => '100%', 'label' => 'Preparedness'),
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
    <section class="px-4 sm:px-6 lg:px-8 py-8 sm:py-12 md:py-16">
        <div class="max-w-7xl mx-auto">
            <!-- Aim & Introduction -->
            <div class="mb-8 sm:mb-12">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8 items-start">
                    <div class="lg:col-span-2 space-y-6 md:sticky top-20">
                        <div class="bg-white rounded-xl sm:rounded-2xl p-6 shadow-soft border border-border-light">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                                    <i data-lucide="<?php echo esc_attr($aim_icon); ?>" class="w-5 h-5 text-primary"></i>
                                </div>
                                <h3 class="text-base sm:text-lg font-bold text-text-main-light"><?php echo esc_html($aim_heading); ?></h3>
                            </div>
                            <p class="text-sm text-text-secondary-light"><?php echo esc_html($aim_text); ?></p>
                        </div>
                        <div class="bg-gradient-to-r from-primary/5 to-accent/5 rounded-xl sm:rounded-2xl p-6 border border-primary/10">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 rounded-lg bg-accent/10 flex items-center justify-center">
                                    <i data-lucide="<?php echo esc_attr($need_icon); ?>" class="w-5 h-5 text-accent"></i>
                                </div>
                                <h3 class="text-base sm:text-lg font-bold text-text-main-light"><?php echo esc_html($need_heading); ?></h3>
                            </div>
                            <p class="text-sm text-text-secondary-light"><?php echo esc_html($need_text); ?></p>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div class="group overflow-hidden rounded-xl sm:rounded-2xl shadow-soft border border-border-light">
                            <div class="aspect-square bg-gray-100 overflow-hidden relative">
                                <img src="<?php echo esc_url($side_image_url); ?>" alt="Disaster Management" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-br from-primary/20 to-accent/20"></div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl sm:rounded-2xl p-6 shadow-soft border border-border-light">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                                    <i data-lucide="<?php echo esc_attr($committee_icon); ?>" class="w-5 h-5 text-primary"></i>
                                </div>
                                <h3 class="text-base sm:text-lg font-bold text-text-main-light"><?php echo esc_html($committee_heading); ?></h3>
                            </div>
                            <p class="text-sm text-text-secondary-light mb-3"><?php echo esc_html($committee_intro); ?></p>
                            <div class="text-sm text-text-secondary-light space-y-1">
                                <?php foreach (array_filter(array_map('trim', explode("\n", $committee_members))) as $line) : ?>
                                <p>• <?php echo esc_html($line); ?></p>
                                <?php endforeach; ?>
                                <?php if ($committee_students !== '') : ?>
                                <p class="mt-2 font-medium">• <?php echo esc_html($committee_students); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SDMP Document & Dissemination (a) b) structure preserved) -->
            <div class="mb-8 sm:mb-12">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
                    <div class="bg-gradient-to-r from-primary/5 to-primary/10 rounded-xl sm:rounded-2xl p-6 border border-primary/10">
                        <h4 class="text-base sm:text-lg font-bold text-text-main-light mb-4"><?php echo esc_html($sdmp_heading); ?></h4>
                        <p class="text-sm text-text-secondary-light mb-4"><?php echo esc_html($sdmp_intro); ?></p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <?php
                            $sdmp_blocks = array();
                            $sdmp_list = array();
                            foreach ($sdmp_items as $it) {
                                $lbl = isset($it['label']) ? trim((string) $it['label']) : '';
                                $txt = isset($it['text']) ? trim((string) $it['text']) : '';
                                $ic = isset($it['icon']) ? trim((string) $it['icon']) : '';
                                if ($txt === '') continue;
                                if ($lbl !== '' && $ic === '') {
                                    $sdmp_blocks[] = array('label' => $lbl, 'text' => $txt);
                                } else {
                                    $sdmp_list[] = array('icon' => $ic !== '' ? $ic : $default_list_icon, 'text' => $txt);
                                }
                            }
                            ?>
                            <div class="space-y-3">
                                <?php if (!empty($sdmp_blocks)) : ?>
                                <div class="flex items-start gap-2">
                                    <span class="font-bold text-primary"><?php echo esc_html($sdmp_blocks[0]['label']); ?></span>
                                    <span class="text-sm text-text-secondary-light"><?php echo esc_html($sdmp_blocks[0]['text']); ?></span>
                                </div>
                                <?php elseif (!empty($sdmp_list)) : ?>
                                <div class="space-y-1">
                                    <?php foreach ($sdmp_list as $sub) : ?>
                                    <div class="flex items-center gap-2">
                                        <i data-lucide="<?php echo esc_attr($sub['icon']); ?>" class="w-3 h-3 text-primary flex-shrink-0"></i>
                                        <span class="text-sm text-text-secondary-light"><?php echo esc_html($sub['text']); ?></span>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="space-y-3">
                                <?php if (count($sdmp_blocks) >= 2) : ?>
                                <div class="flex items-start gap-2">
                                    <span class="font-bold text-primary"><?php echo esc_html($sdmp_blocks[1]['label']); ?></span>
                                    <span class="text-sm text-text-secondary-light"><?php echo esc_html($sdmp_blocks[1]['text']); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($sdmp_list) && !empty($sdmp_blocks)) : ?>
                                <div class="space-y-1 <?php echo count($sdmp_blocks) >= 2 ? 'ml-6' : ''; ?>">
                                    <?php foreach ($sdmp_list as $sub) : ?>
                                    <div class="flex items-center gap-2">
                                        <i data-lucide="<?php echo esc_attr($sub['icon']); ?>" class="w-3 h-3 text-primary flex-shrink-0"></i>
                                        <span class="text-sm text-text-secondary-light"><?php echo esc_html($sub['text']); ?></span>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-accent/5 to-accent/10 rounded-xl sm:rounded-2xl p-6 border border-accent/10">
                        <h4 class="text-base sm:text-lg font-bold text-text-main-light mb-4"><?php echo esc_html($dissem_heading); ?></h4>
                        <p class="text-sm text-text-secondary-light mb-4"><?php echo esc_html($dissem_intro); ?></p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            <?php foreach ($dissem_activities as $act) :
                                $a_icon = (isset($act['icon']) && trim((string) $act['icon']) !== '') ? trim($act['icon']) : $default_list_icon;
                                $a_label = isset($act['label']) ? (string) $act['label'] : '';
                                if ($a_label === '') continue;
                            ?>
                            <div class="text-center p-3 rounded-lg bg-accent/5">
                                <i data-lucide="<?php echo esc_attr($a_icon); ?>" class="w-5 h-5 text-accent mx-auto mb-2"></i>
                                <span class="text-xs font-medium text-text-main-light"><?php echo esc_html($a_label); ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mock Drills Section -->
            <div class="mb-8 sm:mb-12">
                <div class="bg-white rounded-xl sm:rounded-2xl p-6 shadow-soft border border-border-light mb-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center">
                            <i data-lucide="<?php echo esc_attr($drills_heading_icon); ?>" class="w-6 h-6 text-primary"></i>
                        </div>
                        <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-text-main-light"><?php echo esc_html($drills_heading); ?></h3>
                    </div>
                    <p class="text-sm text-text-secondary-light leading-relaxed"><?php echo esc_html($drills_intro); ?></p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php
                    $style_map = array(
                        'primary' => array('bg' => 'from-primary/5 to-white', 'border' => 'border-primary/10', 'box' => 'bg-primary/10', 'icon' => 'text-primary'),
                        'accent' => array('bg' => 'from-accent/5 to-white', 'border' => 'border-accent/10', 'box' => 'bg-accent/10', 'icon' => 'text-accent'),
                        'primary-light' => array('bg' => 'from-primary-light/5 to-white', 'border' => 'border-primary-light/10', 'box' => 'bg-primary-light/10', 'icon' => 'text-primary-light'),
                    );
                    foreach ($drills_cards as $card) :
                        $d_title = isset($card['title']) ? (string) $card['title'] : '';
                        $d_icon = (isset($card['icon']) && trim((string) $card['icon']) !== '') ? trim($card['icon']) : 'earthquake';
                        $d_style = isset($card['style']) ? (string) $card['style'] : 'primary';
                        $d_items = isset($card['items']) && is_array($card['items']) ? $card['items'] : array();
                        $st = isset($style_map[$d_style]) ? $style_map[$d_style] : $style_map['primary'];
                        $check_class = $d_style === 'primary' ? 'text-primary' : ($d_style === 'accent' ? 'text-accent' : 'text-primary-light');
                    ?>
                    <div class="bg-gradient-to-b <?php echo esc_attr($st['bg']); ?> rounded-xl p-6 border <?php echo esc_attr($st['border']); ?>">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-lg <?php echo esc_attr($st['box']); ?> flex items-center justify-center">
                                <i data-lucide="<?php echo esc_attr($d_icon); ?>" class="w-5 h-5 <?php echo esc_attr($st['icon']); ?>"></i>
                            </div>
                            <h4 class="font-bold text-text-main-light"><?php echo esc_html($d_title); ?></h4>
                        </div>
                        <ul class="space-y-2">
                            <?php foreach ($d_items as $item) :
                                $item_text = is_array($item) ? (isset($item['text']) ? $item['text'] : '') : (string) $item;
                                if ($item_text === '') continue;
                                $item_icon = (is_array($item) && isset($item['icon']) && trim((string) $item['icon']) !== '') ? trim($item['icon']) : $default_list_icon;
                            ?>
                            <li class="flex items-start gap-2">
                                <i data-lucide="<?php echo esc_attr($item_icon); ?>" class="w-4 h-4 <?php echo esc_attr($check_class); ?> mt-1 flex-shrink-0"></i>
                                <span class="text-sm text-text-secondary-light"><?php echo esc_html($item_text); ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Safety Precautions Grid -->
            <div class="mb-8 sm:mb-12">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
                    <div class="lg:col-span-2">
                        <div class="bg-gradient-to-r from-primary/5 to-primary/10 rounded-xl sm:rounded-2xl p-6 border border-primary/10">
                            <h4 class="font-bold text-text-main-light mb-3"><?php echo esc_html($safety_cyclones_heading); ?></h4>
                            <p class="text-sm text-text-secondary-light mb-4"><?php echo esc_html($safety_cyclones_para); ?></p>
                            <ul class="space-y-2">
                                <?php foreach ($safety_cyclones_list as $c) :
                                    $ci = (isset($c['icon']) && trim((string) $c['icon']) !== '') ? trim($c['icon']) : $default_list_icon;
                                    $ct = isset($c['text']) ? (string) $c['text'] : '';
                                    if ($ct === '') continue;
                                ?>
                                <li class="flex items-start gap-2">
                                    <i data-lucide="<?php echo esc_attr($ci); ?>" class="w-4 h-4 text-primary mt-1 flex-shrink-0"></i>
                                    <span class="text-sm text-text-secondary-light"><?php echo esc_html($ct); ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-accent/5 to-accent/10 rounded-xl sm:rounded-2xl p-6 border border-accent/10">
                        <h4 class="font-bold text-text-main-light mb-3"><?php echo esc_html($safety_general_heading); ?></h4>
                        <ul class="space-y-2">
                            <?php foreach ($safety_general_list as $g) :
                                $gi = (isset($g['icon']) && trim((string) $g['icon']) !== '') ? trim($g['icon']) : $default_list_icon;
                                $gt = isset($g['text']) ? (string) $g['text'] : '';
                                if ($gt === '') continue;
                            ?>
                            <li class="flex items-start gap-2">
                                <i data-lucide="<?php echo esc_attr($gi); ?>" class="w-4 h-4 text-accent mt-1 flex-shrink-0"></i>
                                <span class="text-sm text-text-secondary-light"><?php echo esc_html($gt); ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Health & Safety Norms -->
            <div class="mb-8 sm:mb-12">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
                    <div class="space-y-6">
                        <div class="bg-white rounded-xl sm:rounded-2xl p-6 shadow-soft border border-border-light">
                            <h4 class="font-bold text-text-main-light mb-4"><?php echo esc_html($health_norms_heading); ?></h4>
                            <div class="grid grid-cols-2 gap-3">
                                <?php foreach ($health_norms_items as $n) :
                                    $ni = (isset($n['icon']) && trim((string) $n['icon']) !== '') ? trim($n['icon']) : $default_list_icon;
                                    $nl = isset($n['label']) ? (string) $n['label'] : '';
                                    if ($nl === '') continue;
                                ?>
                                <div class="flex items-center gap-2">
                                    <i data-lucide="<?php echo esc_attr($ni); ?>" class="w-3 h-3 text-primary flex-shrink-0"></i>
                                    <span class="text-xs text-text-secondary-light"><?php echo esc_html($nl); ?></span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-primary/5 to-primary/10 rounded-xl p-6 border border-primary/10">
                            <h4 class="font-bold text-text-main-light mb-3"><?php echo esc_html($health_hygiene_heading); ?></h4>
                            <ul class="space-y-2">
                                <?php foreach ($health_hygiene_list as $h) :
                                    $hi = (isset($h['icon']) && trim((string) $h['icon']) !== '') ? trim($h['icon']) : $default_list_icon;
                                    $ht = isset($h['text']) ? (string) $h['text'] : '';
                                    if ($ht === '') continue;
                                ?>
                                <li class="flex items-start gap-2">
                                    <i data-lucide="<?php echo esc_attr($hi); ?>" class="w-3 h-3 text-primary mt-1 flex-shrink-0"></i>
                                    <span class="text-xs text-text-secondary-light"><?php echo esc_html($ht); ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-accent/5 to-accent/10 rounded-xl sm:rounded-2xl p-6 border border-accent/10">
                        <h4 class="font-bold text-text-main-light mb-4"><?php echo esc_html($guidelines_heading); ?></h4>
                        <div class="space-y-3">
                            <?php foreach ($guidelines_list as $gl) :
                                $gli = (isset($gl['icon']) && trim((string) $gl['icon']) !== '') ? trim($gl['icon']) : $default_list_icon;
                                $glt = isset($gl['text']) ? (string) $gl['text'] : '';
                                if ($glt === '') continue;
                            ?>
                            <div class="flex items-start gap-2">
                                <i data-lucide="<?php echo esc_attr($gli); ?>" class="w-4 h-4 text-accent mt-1 flex-shrink-0"></i>
                                <span class="text-sm text-text-secondary-light"><?php echo esc_html($glt); ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Safety Measures CTA -->
            <div class="bg-gradient-to-r from-primary to-primary-light rounded-xl sm:rounded-2xl p-6 sm:p-8 text-white">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-center">
                    <div>
                        <h2 class="text-lg sm:text-xl font-bold mb-4"><?php echo esc_html($cta_heading); ?></h2>
                        <div class="space-y-3 mb-6">
                            <?php foreach ($cta_measures as $m) :
                                $mi = (isset($m['icon']) && trim((string) $m['icon']) !== '') ? trim($m['icon']) : $default_list_icon;
                                $mt = isset($m['text']) ? (string) $m['text'] : '';
                                if ($mt === '') continue;
                            ?>
                            <div class="flex items-start gap-2">
                                <i data-lucide="<?php echo esc_attr($mi); ?>" class="w-4 h-4 text-white mt-1 flex-shrink-0"></i>
                                <span class="text-sm text-white/90"><?php echo esc_html($mt); ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="<?php echo esc_url($cta_btn1['url']); ?>" <?php echo !empty($cta_btn1['target']) ? ' target="' . esc_attr($cta_btn1['target']) . '"' : ''; ?> class="px-4 py-2 sm:px-6 sm:py-3 bg-white text-primary rounded-full font-bold hover:bg-white/90 transition-all flex items-center justify-center gap-2 group text-sm">
                                <i data-lucide="<?php echo esc_attr($cta_icon1); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                                <?php echo esc_html(isset($cta_btn1['title']) ? $cta_btn1['title'] : 'Download Safety Manual'); ?>
                            </a>
                            <a href="<?php echo esc_url($cta_btn2['url']); ?>" <?php echo !empty($cta_btn2['target']) ? ' target="' . esc_attr($cta_btn2['target']) . '"' : ''; ?> class="px-4 py-2 sm:px-6 sm:py-3 bg-white/20 border border-white/30 text-white rounded-full font-bold hover:bg-white/30 transition-all flex items-center justify-center gap-2 group text-sm">
                                <i data-lucide="<?php echo esc_attr($cta_icon2); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                                <?php echo esc_html(isset($cta_btn2['title']) ? $cta_btn2['title'] : 'Drill Schedule'); ?>
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <?php foreach (array_slice($cta_stats, 0, 4) as $stat) : ?>
                        <div class="bg-white/10 rounded-xl p-4 text-center border border-white/20">
                            <div class="text-base sm:text-lg font-bold mb-2"><?php echo esc_html((string) (isset($stat['number']) ? $stat['number'] : '')); ?></div>
                            <div class="text-xs font-medium text-white/80"><?php echo esc_html((string) (isset($stat['label']) ? $stat['label'] : '')); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
