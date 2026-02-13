<?php
/**
 * Template Name: Home Page
 * Home page: Hero (ACF dynamic), Welcome, Approach, Academics (static)
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$home_url = home_url('/');
$theme_uri = get_template_directory_uri();

// Hero: ACF fields from current page (Page Template = Home Page). Fallback to option or defaults.
$hero_page_id = get_queried_object_id();
$hero_badge       = function_exists('get_field') ? get_field('hero_badge_text', $hero_page_id) : null;
$hero_line1       = function_exists('get_field') ? get_field('hero_headline_line1', $hero_page_id) : null;
$hero_highlight   = function_exists('get_field') ? get_field('hero_headline_highlight', $hero_page_id) : null;
$hero_subheadline = function_exists('get_field') ? get_field('hero_subheadline', $hero_page_id) : null;
$cta_primary_link   = function_exists('get_field') ? get_field('hero_cta_primary', $hero_page_id) : null;
$cta_secondary_link = function_exists('get_field') ? get_field('hero_cta_secondary', $hero_page_id) : null;
$cta_primary_icon   = function_exists('get_field') ? get_field('hero_cta_primary_icon', $hero_page_id) : null;
$cta_secondary_icon = function_exists('get_field') ? get_field('hero_cta_secondary_icon', $hero_page_id) : null;
// If no page context (e.g. 0), also try option for backwards compatibility
if (!$hero_page_id && function_exists('get_field')) {
    if ($hero_badge === null) $hero_badge = get_field('hero_badge_text', 'option');
    if ($hero_line1 === null) $hero_line1 = get_field('hero_headline_line1', 'option');
    if ($hero_highlight === null) $hero_highlight = get_field('hero_headline_highlight', 'option');
    if ($hero_subheadline === null) $hero_subheadline = get_field('hero_subheadline', 'option');
    if ($cta_primary_link === null) $cta_primary_link = get_field('hero_cta_primary', 'option');
    if ($cta_secondary_link === null) $cta_secondary_link = get_field('hero_cta_secondary', 'option');
    if ($cta_primary_icon === null) $cta_primary_icon = get_field('hero_cta_primary_icon', 'option');
    if ($cta_secondary_icon === null) $cta_secondary_icon = get_field('hero_cta_secondary_icon', 'option');
}

$hero_badge       = $hero_badge !== '' && $hero_badge !== null ? $hero_badge : 'Admissions Open for 2025-26';
$hero_line1       = $hero_line1 !== '' && $hero_line1 !== null ? $hero_line1 : 'Fun. Study. Research.';
$hero_highlight   = $hero_highlight !== '' && $hero_highlight !== null ? $hero_highlight : 'Innovate. Play';
$hero_subheadline = $hero_subheadline !== '' && $hero_subheadline !== null ? $hero_subheadline : 'A Great School For A Great Future Of Your Child. Mount Litera Zee School will provide a complete and unique educational experience for the child, preparing the child for a successful life in the contemporary society.';
// ACF link: array( 'url' => '', 'title' => '', 'target' => '' ) or null
$cta_primary_link   = (is_array($cta_primary_link) && !empty($cta_primary_link['url'])) ? $cta_primary_link : array( 'url' => '#', 'title' => 'Start Application', 'target' => '' );
$cta_secondary_link = (is_array($cta_secondary_link) && !empty($cta_secondary_link['url'])) ? $cta_secondary_link : array( 'url' => '#', 'title' => 'Virtual Tour', 'target' => '' );
$cta_primary_icon   = (is_string($cta_primary_icon) && trim($cta_primary_icon) !== '') ? trim($cta_primary_icon) : 'arrow-up-right';
$cta_secondary_icon = (is_string($cta_secondary_icon) && trim($cta_secondary_icon) !== '') ? trim($cta_secondary_icon) : 'play-circle';

$default_slide_url = 'https://images.unsplash.com/photo-1498243691581-b145c3f54a5a?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80';
$default_stats = array(
    array('stat_number' => '100%', 'stat_label' => 'University Acceptance'),
    array('stat_number' => '45+', 'stat_label' => 'Nationalities'),
    array('stat_number' => '12:1', 'stat_label' => 'Student-Teacher Ratio'),
    array('stat_number' => 'A+', 'stat_label' => 'Global Accreditation'),
);

// Welcome Section: ACF with fallbacks
$welcome_badge     = function_exists('get_field') ? get_field('welcome_badge', $hero_page_id) : null;
$welcome_heading1  = function_exists('get_field') ? get_field('welcome_heading_line1', $hero_page_id) : null;
$welcome_highlight = function_exists('get_field') ? get_field('welcome_heading_highlight', $hero_page_id) : null;
$welcome_desc      = function_exists('get_field') ? get_field('welcome_description', $hero_page_id) : null;
$welcome_cta1 = function_exists('get_field') ? get_field('welcome_cta_primary', $hero_page_id) : null;
$welcome_cta2 = function_exists('get_field') ? get_field('welcome_cta_secondary', $hero_page_id) : null;
$welcome_cta1_icon = function_exists('get_field') ? get_field('welcome_cta_primary_icon', $hero_page_id) : null;
$welcome_cta2_icon = function_exists('get_field') ? get_field('welcome_cta_secondary_icon', $hero_page_id) : null;
$welcome_badge     = $welcome_badge !== '' && $welcome_badge !== null ? $welcome_badge : 'Welcome to Our Campus';
$welcome_heading1  = $welcome_heading1 !== '' && $welcome_heading1 !== null ? $welcome_heading1 : 'Mount Litera Zee School, Alwar';
$welcome_highlight = $welcome_highlight !== '' && $welcome_highlight !== null ? $welcome_highlight : 'A Great School For A Great Future';
$welcome_desc      = $welcome_desc !== '' && $welcome_desc !== null ? $welcome_desc : 'Mount Litera Zee School will provide a complete and unique educational experience for the child, preparing the child for a successful life in the contemporary society. MLZS create an excellent educational institution synthesizing the human values with the highest quality of teaching–learning using modern technology-driven tools.';
$welcome_cta1 = (is_array($welcome_cta1) && !empty($welcome_cta1['url'])) ? $welcome_cta1 : array( 'url' => (string) $home_url . '#approach', 'title' => 'Discover Our Approach', 'target' => '' );
$welcome_cta2 = (is_array($welcome_cta2) && !empty($welcome_cta2['url'])) ? $welcome_cta2 : array( 'url' => (string) $home_url . '#virtual-tour', 'title' => 'Virtual Tour', 'target' => '' );
$welcome_cta1_icon = (is_string($welcome_cta1_icon) && trim($welcome_cta1_icon) !== '') ? trim($welcome_cta1_icon) : 'arrow-right';
$welcome_cta2_icon = (is_string($welcome_cta2_icon) && trim($welcome_cta2_icon) !== '') ? trim($welcome_cta2_icon) : '';
$default_welcome_cards = array(
    array('card_icon' => 'book-open', 'card_title' => 'The Best Learning Methods', 'card_description' => 'Mount Litera Zee School will provide a complete and unique educational experience for the child, preparing the child for a successful life in the contemporary society. MLZS create an excellent educational institution synthesizing the human values with the highest quality of teaching–learning using modern technology-driven tools for preparing a well-rounded personality for our society.', 'card_style' => 'primary'),
    array('card_icon' => 'award', 'card_title' => 'Awesome Results Of Our Students', 'card_description' => 'We believe that every child is born unique. Each child has a unique brain network that shapes how she absorbs and responds to stimuli. One way of teaching does not work for every child. We need to teach the way they learn, not force them to learn the way we teach. We help children make meaning of life and develop the muscle to lead life effectively.', 'card_style' => 'accent'),
);

// Approach Section: ACF with fallbacks
$approach_badge       = function_exists('get_field') ? get_field('approach_badge', $hero_page_id) : null;
$approach_heading     = function_exists('get_field') ? get_field('approach_heading', $hero_page_id) : null;
$approach_description = function_exists('get_field') ? get_field('approach_description', $hero_page_id) : null;
$approach_pillars_raw  = function_exists('get_field') ? get_field('approach_pillars', $hero_page_id) : null;
$approach_badge       = ($approach_badge !== '' && $approach_badge !== null) ? $approach_badge : 'Our Philosophy';
$approach_heading     = ($approach_heading !== '' && $approach_heading !== null) ? $approach_heading : 'The Litera Octave Approach';
$approach_description = ($approach_description !== '' && $approach_description !== null) ? $approach_description : 'A holistic framework for world-class education, seamlessly integrating eight core pillars of excellence to nurture future leaders.';
$default_approach_img  = 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80';
$default_approach_pillars = array(
    array('icon' => 'bar-chart-3', 'label' => 'Assessment', 'tag' => 'Litera Assessment', 'title_line1' => 'Litera', 'title_highlight' => 'Assessment', 'description' => 'Our assessments focus on identifying what students are good at instead of whether they are good or not. MLZS assessments take place on a continuous basis and at the child\'s pace rather than through only stressful periodic exams. Assessment patterns are based on feedback from various stakeholders including parents.', 'pills' => array('Continuous', 'Child\'s Pace', 'Holistic'), 'button' => array('url' => '#', 'title' => 'Explore Program', 'target' => ''), 'image' => $default_approach_img),
);
// Normalize ACF repeater into same shape as defaults for template
$approach_pillars = array();
if (is_array($approach_pillars_raw) && !empty($approach_pillars_raw)) {
    foreach ($approach_pillars_raw as $row) {
        $pills = array();
        if (!empty($row['pills']) && is_array($row['pills'])) {
            foreach ($row['pills'] as $p) {
                $t = isset($p['pill_text']) ? trim((string) $p['pill_text']) : '';
                if ($t !== '') $pills[] = $t;
            }
        }
        $btn = isset($row['button']) && is_array($row['button']) && !empty($row['button']['url']) ? $row['button'] : array('url' => '#', 'title' => 'Explore Program', 'target' => '');
        $img = '';
        if (!empty($row['image'])) {
            $img = is_array($row['image']) ? ($row['image']['url'] ?? '') : $row['image'];
        }
        if ($img === '') $img = $default_approach_img;
        $approach_pillars[] = array(
            'icon'          => (isset($row['icon']) && trim((string) $row['icon']) !== '') ? trim((string) $row['icon']) : 'bar-chart-3',
            'label'         => (isset($row['label']) && trim((string) $row['label']) !== '') ? trim((string) $row['label']) : 'Pillar',
            'tag'           => isset($row['tag']) ? (string) $row['tag'] : '',
            'title_line1'   => isset($row['title_line1']) ? (string) $row['title_line1'] : 'Litera',
            'title_highlight' => isset($row['title_highlight']) ? (string) $row['title_highlight'] : '',
            'description'   => isset($row['description']) ? (string) $row['description'] : '',
            'pills'         => $pills,
            'button'        => $btn,
            'image'         => $img,
        );
    }
}
if (empty($approach_pillars)) {
    $approach_pillars = $default_approach_pillars;
}

// Academics Section: ACF with fallbacks
$academics_badge_text   = function_exists('get_field') ? get_field('academics_badge_text', $hero_page_id) : null;
$academics_badge_icon   = function_exists('get_field') ? get_field('academics_badge_icon', $hero_page_id) : null;
$academics_heading      = function_exists('get_field') ? get_field('academics_heading', $hero_page_id) : null;
$academics_description  = function_exists('get_field') ? get_field('academics_description', $hero_page_id) : null;
$academics_tabs_raw     = function_exists('get_field') ? get_field('academics_tabs', $hero_page_id) : null;
$academics_cta_raw      = function_exists('get_field') ? get_field('academics_cta', $hero_page_id) : null;
$academics_badge_text   = ($academics_badge_text !== '' && $academics_badge_text !== null) ? $academics_badge_text : 'Student Life';
$academics_badge_icon   = (is_string($academics_badge_icon) && trim($academics_badge_icon) !== '') ? trim($academics_badge_icon) : 'graduation-cap';
$academics_heading      = ($academics_heading !== '' && $academics_heading !== null) ? $academics_heading : 'Academics & Beyond';
$academics_description = ($academics_description !== '' && $academics_description !== null) ? $academics_description : 'We believe education extends far beyond the classroom walls. Explore the diverse opportunities that shape our students into well-rounded global leaders through arts, sports, and community engagement.';
$academics_cta         = (is_array($academics_cta_raw) && !empty($academics_cta_raw['url'])) ? $academics_cta_raw : array( 'url' => (string) $home_url . '#', 'title' => 'View All Activities', 'target' => '' );
$default_academics_img  = 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80';
$default_academics_tabs = array(
    array(
        'tab_icon' => 'palette', 'tab_label' => 'Fun & Art', 'tab_slug' => 'fun',
        'cards' => array(
            array( 'image' => $default_academics_img, 'tag' => 'Clubs', 'tag_style' => 'primary', 'title' => 'Litera Clubs', 'description' => 'Mount Litera Zee School encourages students to participate in a wide-range of clubs in schools including clubs like Literary Club, STEM Club, Health and Wellness Club etc.', 'link' => array( 'url' => '#', 'title' => 'Explore Clubs', 'target' => '' ) ),
            array( 'image' => $default_academics_img, 'tag' => 'Excursions', 'tag_style' => 'accent', 'title' => 'Field Trips', 'description' => 'Field trips are a popular activity for all students. Kids love to explore new places with their friends. We understand that any trip cannot qualify as a field trip.', 'link' => array( 'url' => '#', 'title' => 'View Gallery', 'target' => '' ) ),
        ),
    ),
    array(
        'tab_icon' => 'trophy', 'tab_label' => 'Sports', 'tab_slug' => 'sports',
        'cards' => array(
            array( 'image' => 'https://images.unsplash.com/photo-1576678927484-cc907957088c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80', 'tag' => '', 'tag_style' => 'primary', 'title' => 'Sports', 'description' => 'Swami Vivekananda famously said, "Be strong, my young friends; that is my advice to you. You will be nearer to Heaven through football than through the study of the Gita."', 'link' => array( 'url' => '#', 'title' => 'Explore Sports', 'target' => '' ) ),
            array( 'image' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80', 'tag' => '', 'tag_style' => 'primary', 'title' => 'Fitness & Wellness', 'description' => 'Track and field, yoga, and fitness sessions help students build stamina, discipline, and lifelong healthy habits.', 'link' => array( 'url' => '#', 'title' => 'View Programs', 'target' => '' ) ),
        ),
    ),
    array(
        'tab_icon' => 'party-popper', 'tab_label' => 'Events', 'tab_slug' => 'events',
        'cards' => array(
            array( 'image' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80', 'tag' => '', 'tag_style' => 'primary', 'title' => 'Mount Litera Olympiad', 'description' => 'The Mount Litera Olympiad is an inter-MLZS competition in which students from all MLZS participate to showcase their talent in various fields.', 'link' => array( 'url' => '#', 'title' => 'View Highlights', 'target' => '' ) ),
            array( 'image' => $default_academics_img, 'tag' => '', 'tag_style' => 'primary', 'title' => 'Events and Celebrations', 'description' => 'Mount Litera Zee Schools organise various events and celebrations throughout the year. The chief of them is the Annual Function.', 'link' => array( 'url' => '#', 'title' => 'Explore Gallery', 'target' => '' ) ),
        ),
    ),
);
$academics_tabs = array();
if (is_array($academics_tabs_raw) && !empty($academics_tabs_raw)) {
    foreach ($academics_tabs_raw as $row) {
        $slug = isset($row['tab_slug']) ? preg_replace('/[^a-z0-9_-]/i', '', (string) $row['tab_slug']) : 'tab-' . count($academics_tabs);
        if ($slug === '') $slug = 'tab-' . count($academics_tabs);
        $cards = array();
        if (!empty($row['cards']) && is_array($row['cards'])) {
            foreach ($row['cards'] as $c) {
                $img = isset($c['image']) ? (is_array($c['image']) ? ($c['image']['url'] ?? '') : $c['image']) : $default_academics_img;
                if ($img === '') $img = $default_academics_img;
                $lnk = isset($c['link']) && is_array($c['link']) && !empty($c['link']['url']) ? $c['link'] : array( 'url' => '#', 'title' => 'Explore', 'target' => '' );
                $cards[] = array(
                    'image' => $img,
                    'tag' => isset($c['tag']) ? (string) $c['tag'] : '',
                    'tag_style' => (isset($c['tag_style']) && $c['tag_style'] === 'accent') ? 'accent' : 'primary',
                    'title' => isset($c['title']) ? (string) $c['title'] : '',
                    'description' => isset($c['description']) ? (string) $c['description'] : '',
                    'link' => $lnk,
                );
            }
        }
        if (!empty($cards)) {
            $academics_tabs[] = array(
                'tab_icon' => (isset($row['tab_icon']) && trim((string) $row['tab_icon']) !== '') ? trim((string) $row['tab_icon']) : 'circle',
                'tab_label' => isset($row['tab_label']) ? (string) $row['tab_label'] : 'Tab',
                'tab_slug' => $slug,
                'cards' => $cards,
            );
        }
    }
}
if (empty($academics_tabs)) {
    $academics_tabs = $default_academics_tabs;
}
?>

<!-- Hero Section (dynamic via ACF) -->
<div class="relative flex-grow flex items-center justify-center min-h-[100svh] w-full overflow-hidden px-4 sm:px-6 lg:px-8">
    <div class="absolute inset-0 z-0 hero-swiper-container">
        <div class="swiper w-full h-full">
            <div class="swiper-wrapper">
                <?php
                $hero_id = get_queried_object_id() ?: 'option';
                $has_slides = function_exists('have_rows') && have_rows('hero_slides', $hero_id);
                if ($has_slides) {
                    while (have_rows('hero_slides', $hero_id)) {
                        the_row();
                        $img = get_sub_field('slide_image');
                        if ($img) {
                            $img_url = is_array($img) ? ($img['url'] ?? '') : $img;
                            if ($img_url) {
                                ?>
                                <div class="swiper-slide">
                                    <div class="w-full h-full bg-cover bg-center scale-110 animate-hero-zoom" style="background-image: url('<?php echo esc_url( (string) $img_url ); ?>');"></div>
                                </div>
                                <?php
                            }
                        }
                    }
                }
                if (!$has_slides || !function_exists('have_rows')) {
                    ?>
                    <div class="swiper-slide">
                        <div class="w-full h-full bg-cover bg-center scale-110 animate-hero-zoom" style="background-image: url('<?php echo esc_url($default_slide_url); ?>');"></div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="absolute inset-0 bg-indigo-velvet/40 mix-blend-multiply z-10"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-indigo-velvet/90 via-indigo-velvet/50 to-indigo-velvet/10 z-10"></div>
    </div>
    <div class="relative z-10 w-full max-w-7xl mx-auto pt-32 flex flex-col items-center text-center lg:items-start lg:text-left">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-4 animate-fade-in-up">
            <span class="relative flex size-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"></span>
                <span class="relative inline-flex rounded-full size-3 bg-secondary"></span>
            </span>
            <span class="md:text-base text-xs font-semibold text-white uppercase tracking-wider"><?php echo esc_html( (string) $hero_badge ); ?></span>
        </div>
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-[1.1] tracking-tight mb-6 max-w-4xl drop-shadow-lg">
            <?php echo esc_html( (string) $hero_line1 ); ?> <br class="hidden md:block"/>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame via-tiger-orange to-cayenne-red"><?php echo esc_html( (string) $hero_highlight ); ?></span>
        </h1>
        <p class="text-lg md:text-xl text-slate-200 mb-4 max-w-2xl leading-relaxed font-light opacity-95">
            <?php echo esc_html( (string) $hero_subheadline ); ?>
        </p>
        <div class="flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto">
            <a href="<?php echo esc_url( (string) ( $cta_primary_link['url'] ?? '#' ) ); ?>"<?php echo !empty($cta_primary_link['target']) ? ' target="' . esc_attr( (string) $cta_primary_link['target'] ) . '"' : ''; ?> class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-primary to-primary-dark text-white rounded-full font-bold text-lg hover:shadow-[0_0_20px_rgba(61,52,139,0.5)] transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2 group ring-1 ring-white/20">
                <?php echo esc_html( (string) ( $cta_primary_link['title'] ?? 'Start Application' ) ); ?>
                <i data-lucide="<?php echo esc_attr( (string) $cta_primary_icon ); ?>" class="size-5 group-hover:translate-x-1 transition-transform"></i>
            </a>
            <a href="<?php echo esc_url( (string) ( $cta_secondary_link['url'] ?? '#' ) ); ?>"<?php echo !empty($cta_secondary_link['target']) ? ' target="' . esc_attr( (string) $cta_secondary_link['target'] ) . '"' : ''; ?> class="w-full sm:w-auto px-8 py-4 bg-white/10 backdrop-blur-sm border border-white/30 text-white rounded-full font-bold text-lg hover:bg-white/20 transition-all flex items-center justify-center gap-2 group">
                <i data-lucide="<?php echo esc_attr( (string) $cta_secondary_icon ); ?>" class="size-5"></i>
                <?php echo esc_html( (string) ( $cta_secondary_link['title'] ?? 'Virtual Tour' ) ); ?>
            </a>
        </div>
        <div class="mt-16 lg:mt-24 grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-16 border-t border-white/10 py-4 w-full">
            <?php
            $stats = $default_stats;
            $stats_id = get_queried_object_id() ?: 'option';
            if (function_exists('have_rows') && have_rows('hero_stats', $stats_id)) {
                $stats = array();
                while (have_rows('hero_stats', $stats_id)) {
                    the_row();
                    $num = get_sub_field('stat_number');
                    $lbl = get_sub_field('stat_label');
                    if ($num !== '' || $lbl !== '') {
                        $stats[] = array('stat_number' => $num, 'stat_label' => $lbl);
                    }
                }
            }
            if (empty($stats)) {
                $stats = $default_stats;
            }
            foreach ($stats as $stat) {
                ?>
                <div class="flex flex-col gap-1">
                    <span class="text-3xl font-bold text-white"><?php echo esc_html( (string) ( $stat['stat_number'] ?? '' ) ); ?></span>
                    <span class="text-sm text-slate-300 font-medium uppercase tracking-wide"><?php echo esc_html( (string) ( $stat['stat_label'] ?? '' ) ); ?></span>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>

<!-- Welcome Section (dynamic via ACF) -->
<section class="relative px-4 sm:px-6 lg:px-8 py-16 md:py-24 bg-background-light dark:bg-background-dark" id="about">
    <div class="absolute top-0 left-0 -z-10 h-full w-full overflow-hidden">
        <div class="absolute -top-40 -right-40 h-[500px] w-[500px] rounded-full bg-indigo-velvet/5 blur-[100px]"></div>
        <div class="absolute top-1/2 -left-20 h-[300px] w-[300px] rounded-full bg-amber-flame/10 blur-[80px]"></div>
    </div>
    <div class="mx-auto max-w-7xl w-full">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <div class="flex flex-col gap-8">
                <div class="flex flex-col gap-6">
                    <span class="w-fit rounded-full bg-primary/10 px-3 py-1 text-xs font-bold uppercase tracking-wider text-primary dark:text-primary-dark ring-1 ring-primary/20">
                        <?php echo esc_html( (string) $welcome_badge ); ?>
                    </span>
                    <h2 class="font-display text-4xl font-bold tracking-tight text-text-main-light dark:text-text-main-dark sm:text-5xl lg:text-6xl">
                        <?php echo esc_html( (string) $welcome_heading1 ); ?><br/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-velvet via-slate-blue to-amber-flame"><?php echo esc_html( (string) $welcome_highlight ); ?></span>
                    </h2>
                    <p class="max-w-xl text-lg leading-relaxed text-text-secondary-light dark:text-text-secondary-dark">
                        <?php echo esc_html( (string) $welcome_desc ); ?>
                    </p>
                </div>
                <div class="flex flex-wrap gap-4">
                    <a href="<?php echo esc_url( (string) ( $welcome_cta1['url'] ?? '#' ) ); ?>"<?php echo !empty($welcome_cta1['target']) ? ' target="' . esc_attr( (string) $welcome_cta1['target'] ) . '"' : ''; ?> class="group flex h-12 items-center justify-center rounded-full bg-primary px-8 text-base font-bold text-white shadow-glow transition-all hover:bg-primary-dark hover:shadow-lg hover:-translate-y-0.5">
                        <span><?php echo esc_html( (string) ( $welcome_cta1['title'] ?? 'Discover Our Approach' ) ); ?></span>
                        <?php if ( $welcome_cta1_icon !== '' ) : ?><i data-lucide="<?php echo esc_attr( (string) $welcome_cta1_icon ); ?>" class="ml-2 size-5 transition-transform group-hover:translate-x-1"></i><?php endif; ?>
                    </a>
                    <a href="<?php echo esc_url( (string) ( $welcome_cta2['url'] ?? '#' ) ); ?>"<?php echo !empty($welcome_cta2['target']) ? ' target="' . esc_attr( (string) $welcome_cta2['target'] ) . '"' : ''; ?> class="flex h-12 items-center justify-center rounded-full border border-border-light dark:border-border-dark bg-transparent px-8 text-base font-medium text-text-main-light dark:text-text-main-dark transition-colors hover:bg-surface-light hover:text-primary hover:border-primary/30 hover:shadow-sm hover:dark:bg-surface-dark">
                        <?php if ( $welcome_cta2_icon !== '' ) : ?><i data-lucide="<?php echo esc_attr( (string) $welcome_cta2_icon ); ?>" class="mr-2 size-5"></i><?php endif; ?>
                        <?php echo esc_html( (string) ( $welcome_cta2['title'] ?? 'Virtual Tour' ) ); ?>
                    </a>
                </div>
            </div>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2">
                <?php
                $welcome_cards = $default_welcome_cards;
                if (function_exists('have_rows') && have_rows('welcome_cards', $hero_page_id)) {
                    $welcome_cards = array();
                    while (have_rows('welcome_cards', $hero_page_id)) {
                        the_row();
                        $welcome_cards[] = array(
                            'card_icon'        => get_sub_field('card_icon') ?: 'book-open',
                            'card_title'       => get_sub_field('card_title') ?: '',
                            'card_description' => get_sub_field('card_description') ?: '',
                            'card_style'       => get_sub_field('card_style') ?: 'primary',
                        );
                    }
                }
                foreach ($welcome_cards as $idx => $card) {
                    $is_accent = isset($card['card_style']) && $card['card_style'] === 'accent';
                    $card_classes = $is_accent
                        ? 'border-transparent hover:border-accent/20 dark:border-border-dark dark:hover:border-accent/20 xl:mt-12'
                        : 'border-transparent hover:border-primary/20 dark:border-border-dark dark:hover:border-primary/20';
                    $gradient = $is_accent ? 'from-accent/10' : 'from-primary/10';
                    $icon_bg = $is_accent ? 'bg-accent/10 dark:bg-accent/20 text-accent-dark shadow-glow-accent group-hover:bg-accent' : 'bg-primary/10 dark:bg-primary/20 text-primary shadow-sm group-hover:bg-primary';
                    $title_hover = $is_accent ? 'group-hover:text-accent-dark' : 'group-hover:text-primary';
                    $icon_name = isset($card['card_icon']) && $card['card_icon'] !== '' ? $card['card_icon'] : 'book-open';
                    ?>
                    <div class="group relative overflow-hidden rounded-2xl bg-surface-light dark:bg-surface-dark p-6 shadow-soft transition-all duration-300 hover:-translate-y-1 hover:shadow-xl border <?php echo esc_attr($card_classes); ?>">
                        <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-gradient-to-br <?php echo esc_attr($gradient); ?> to-transparent transition-transform group-hover:scale-150"></div>
                        <div class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-xl <?php echo esc_attr($icon_bg); ?> group-hover:text-white transition-colors">
                            <i data-lucide="<?php echo esc_attr($icon_name); ?>" class="w-7 h-7"></i>
                        </div>
                        <div class="relative z-10 flex flex-col gap-2">
                            <h3 class="text-xl font-bold text-text-main-light dark:text-text-main-dark <?php echo esc_attr($title_hover); ?> transition-colors"><?php echo esc_html( (string) ( $card['card_title'] ?? '' ) ); ?></h3>
                            <p class="text-sm leading-relaxed text-text-secondary-light dark:text-text-secondary-dark">
                                <?php echo esc_html( (string) ( $card['card_description'] ?? '' ) ); ?>
                            </p>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php
// Approach + Academics sections are long; load from a partial for readability, or inline.
// Inlining Approach and Academics (shortened for response - will include full HTML).
?>
<!-- Approach Section (dynamic via ACF) -->
<section id="approach" class="w-full bg-slate-900 border-b border-primary/30 px-4 sm:px-6 lg:px-8 py-16 md:py-24">
    <div class="max-w-7xl mx-auto w-full">
        <div class="flex flex-col items-center justify-start relative z-10">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-[1200px] h-[600px] bg-primary/20 blur-[150px] rounded-full pointer-events-none -z-10 mix-blend-screen"></div>
            <div class="absolute top-[20%] right-[10%] w-[400px] h-[400px] bg-accent/10 blur-[120px] rounded-full pointer-events-none -z-10"></div>
            <div class="w-full flex flex-col gap-4">
                <div class="flex flex-col items-center text-center gap-4">
                    <span class="px-3 py-1 rounded-full bg-primary/30 border border-primary/50 text-accent text-xs font-bold uppercase tracking-wider shadow-[0_0_10px_rgba(247,184,1,0.1)]"><?php echo esc_html( (string) $approach_badge ); ?></span>
                    <h2 class="text-4xl md:text-5xl font-bold text-white tracking-tight"><?php echo esc_html( (string) $approach_heading ); ?></h2>
                    <p class="text-slate-400 text-lg max-w-2xl font-light">
                        <?php echo esc_html( (string) $approach_description ); ?>
                    </p>
                </div>
                <div class="w-full relative lg:px-10 md:px-6 px-4">
                    <div class="swiper approach-thumbs-swiper py-6 px-2 no-scrollbar">
                        <div class="swiper-wrapper flex">
                            <?php foreach ($approach_pillars as $tab) : ?>
                                <div class="swiper-slide inline-flex justify-center">
                                    <button type="button" class="group flex flex-col items-center gap-3 min-w-[50px] sm:min-w-[100px] cursor-pointer">
                                        <div class="size-12 sm:size-16 rounded-2xl bg-slate-800/80 border border-white/5 group-hover:border-accent/50 flex items-center justify-center transition-all duration-300 group-hover:shadow-[0_0_20px_rgba(247,184,1,0.15)] group-hover:-translate-y-1">
                                            <i data-lucide="<?php echo esc_attr( (string) $tab['icon'] ); ?>" class="size-6 sm:size-8 text-white group-hover:text-accent transition-colors"></i>
                                        </div>
                                        <span class="text-xs sm:text-sm font-medium text-slate-400 group-hover:text-accent transition-colors"><?php echo esc_html( (string) $tab['label'] ); ?></span>
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="swiper-button-prev approach-nav-prev absolute left-0 top-1/2 -translate-y-1/2 -ml-4 z-20 hidden lg:flex items-center justify-center w-10 h-10 rounded-full bg-slate-800 border border-slate-700 text-white hover:bg-accent hover:text-slate-900 cursor-pointer transition-all shadow-lg hover:shadow-accent/50">
                        <i data-lucide="chevron-left" class="size-5"></i>
                    </div>
                    <div class="swiper-button-next approach-nav-next absolute right-0 top-1/2 -translate-y-1/2 -mr-4 z-20 hidden lg:flex items-center justify-center w-10 h-10 rounded-full bg-slate-800 border border-slate-700 text-white hover:bg-accent hover:text-slate-900 cursor-pointer transition-all shadow-lg hover:shadow-accent/50">
                        <i data-lucide="chevron-right" class="size-5"></i>
                    </div>
                </div>
                <div class="w-full relative mt-4">
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-velvet/30 via-slate-blue/20 to-amber-flame/20 blur-2xl -z-10 rounded-[2rem]"></div>
                    <div class="swiper approach-main-swiper w-full">
                        <div class="swiper-wrapper">
                            <?php foreach ($approach_pillars as $pillar) :
                                $pillar_tag   = (string) ( $pillar['tag'] ?? '' );
                                $pillar_t1    = (string) ( $pillar['title_line1'] ?? 'Litera' );
                                $pillar_th    = (string) ( $pillar['title_highlight'] ?? '' );
                                $pillar_desc  = (string) ( $pillar['description'] ?? '' );
                                $pillar_pills = isset($pillar['pills']) && is_array($pillar['pills']) ? $pillar['pills'] : array();
                                $pillar_btn   = isset($pillar['button']) && is_array($pillar['button']) ? $pillar['button'] : array( 'url' => '#', 'title' => 'Explore Program', 'target' => '' );
                                $pillar_img   = (string) ( $pillar['image'] ?? $default_approach_img );
                            ?>
                            <div class="swiper-slide">
                                <div class="bg-primary/5 rounded-[2rem] p-1 md:p-1.5 w-full bg-slate-900/60 backdrop-blur-xl border border-accent/30 shadow-[0_0_30px_rgba(247,184,1,0.1)]">
                                    <div class="flex flex-col md:flex-row items-stretch bg-slate-900/90 rounded-[1.8rem] overflow-hidden relative">
                                        <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9IiNmZmZmZmYiLz48L3N2Zz4=')] pointer-events-none"></div>
                                        <div class="flex-1 p-8 md:p-12 flex flex-col justify-center gap-6 order-2 md:order-1 z-10">
                                            <div class="flex items-center gap-3 mb-2">
                                                <div class="size-10 rounded-full bg-primary/20 flex items-center justify-center border border-primary/30 shadow-[0_0_10px_rgba(61,52,139,0.3)]">
                                                    <i data-lucide="<?php echo esc_attr( (string) $pillar['icon'] ); ?>" class="size-5 text-accent"></i>
                                                </div>
                                                <?php if ($pillar_tag !== '') : ?><span class="text-accent font-bold tracking-wider text-sm uppercase"><?php echo esc_html( $pillar_tag ); ?></span><?php endif; ?>
                                            </div>
                                            <h3 class="text-3xl md:text-4xl font-bold text-white">
                                                <?php echo esc_html( $pillar_t1 ); ?>
                                                <?php if ($pillar_th !== '') : ?><br/><span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame to-tiger-orange"><?php echo esc_html( $pillar_th ); ?></span><?php endif; ?>
                                            </h3>
                                            <?php if ($pillar_desc !== '') : ?><p class="text-slate-400 leading-relaxed text-lg"><?php echo esc_html( $pillar_desc ); ?></p><?php endif; ?>
                                            <?php if (!empty($pillar_pills)) : ?>
                                            <div class="flex flex-wrap gap-3 mt-4">
                                                <?php foreach ($pillar_pills as $pill) : ?><span class="px-4 py-2 rounded-full bg-slate-800 text-accent-light text-sm font-medium border border-accent/30 shadow-sm"><?php echo esc_html( (string) $pill ); ?></span><?php endforeach; ?>
                                            </div>
                                            <?php endif; ?>
                                            <div class="pt-4">
                                                <a href="<?php echo esc_url( (string) ( $pillar_btn['url'] ?? '#' ) ); ?>"<?php echo !empty($pillar_btn['target']) ? ' target="' . esc_attr( (string) $pillar_btn['target'] ) . '"' : ''; ?> class="flex items-center gap-2 text-white font-bold group hover:text-accent transition-colors"><?php echo esc_html( (string) ( $pillar_btn['title'] ?? 'Explore Program' ) ); ?> <i data-lucide="arrow-right" class="size-5 group-hover:translate-x-1 group-hover:text-accent transition-all"></i></a>
                                            </div>
                                        </div>
                                        <div class="relative w-full md:w-[45%] h-64 md:h-auto order-1 md:order-2">
                                            <div class="w-full h-full bg-cover bg-center" style="background-image: url('<?php echo esc_url( $pillar_img ); ?>');">
                                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent md:bg-gradient-to-l opacity-90"></div>
                                                <div class="absolute inset-0 bg-primary/30 mix-blend-multiply"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="swiper-pagination approach-pagination flex justify-center gap-2 mt-4"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Academics Section (dynamic via ACF) -->
<section id="academics" class="flex-1 flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 py-16 md:py-24 relative bg-gradient-to-b from-background-light to-white overflow-hidden">
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[120px] pointer-events-none opacity-60"></div>
    <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-accent/5 rounded-full blur-[100px] pointer-events-none opacity-60"></div>
    <div class="w-full max-w-7xl mx-auto z-10">
        <div class="mb-14 text-center md:text-left relative">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-gray-200 shadow-sm text-primary text-xs font-bold uppercase tracking-wider mb-6 transform hover:scale-105 transition-transform">
                <i data-lucide="<?php echo esc_attr( (string) $academics_badge_icon ); ?>" class="w-4 h-4"></i>
                <?php echo esc_html( (string) $academics_badge_text ); ?>
            </div>
            <h2 class="text-5xl md:text-6xl font-medium tracking-tight text-gray-900 mb-6">
                <?php echo esc_html( (string) $academics_heading ); ?>
            </h2>
            <p class="text-gray-500 max-w-2xl text-lg leading-relaxed font-light">
                <?php echo esc_html( (string) $academics_description ); ?>
            </p>
        </div>
        <div class="flex flex-col gap-10">
            <div class="flex overflow-x-auto pb-4 md:pb-0 no-scrollbar">
                <div class="sm:inline-flex flex max-sm:w-full p-1.5 bg-white rounded-full border border-gray-200 shadow-sm">
                    <?php foreach ($academics_tabs as $idx => $atab) : ?>
                    <button type="button" class="academics-tab px-8 py-3 rounded-full text-sm font-medium text-gray-500 hover:text-gray-900 hover:bg-gray-50 transition-all flex items-center gap-2.5 group max-sm:w-full justify-center" data-academics-tab="<?php echo esc_attr( (string) $atab['tab_slug'] ); ?>">
                        <i data-lucide="<?php echo esc_attr( (string) $atab['tab_icon'] ); ?>" class="size-5 md:block hidden group-hover:text-primary transition-colors"></i>
                        <?php echo esc_html( (string) $atab['tab_label'] ); ?>
                    </button>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php foreach ($academics_tabs as $idx => $atab) : ?>
            <div class="academics-panel grid grid-cols-1 lg:grid-cols-2 gap-8 animate-fade-in <?php echo $idx > 0 ? 'hidden' : ''; ?>" data-academics-panel="<?php echo esc_attr( (string) $atab['tab_slug'] ); ?>">
                <?php foreach ($atab['cards'] as $card) :
                    $card_img = (string) ( $card['image'] ?? $default_academics_img );
                    $card_tag = (string) ( $card['tag'] ?? '' );
                    $is_accent = isset($card['tag_style']) && $card['tag_style'] === 'accent';
                    $gradient_class = $is_accent ? 'from-accent/10' : 'from-primary/5';
                    $tag_class = $is_accent ? 'bg-accent/10 text-accent' : 'bg-primary/10 text-primary';
                    $card_link = isset($card['link']) && is_array($card['link']) ? $card['link'] : array( 'url' => '#', 'title' => 'Explore', 'target' => '' );
                ?>
                <a href="<?php echo esc_url( (string) ( $card_link['url'] ?? '#' ) ); ?>"<?php echo !empty($card_link['target']) ? ' target="' . esc_attr( (string) $card_link['target'] ) . '"' : ''; ?> class="group relative flex flex-col sm:flex-row items-center sm:items-start gap-6 p-6 rounded-2xl bg-white border border-gray-100 shadow-soft hover:shadow-xl hover:border-primary/20 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl <?php echo esc_attr( $gradient_class ); ?> to-transparent rounded-bl-full pointer-events-none transition-opacity duration-300 opacity-50 group-hover:opacity-100"></div>
                    <div class="relative shrink-0 overflow-hidden rounded-xl w-full sm:w-40 h-48 sm:h-40 shadow-inner">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 ease-out group-hover:scale-110" style="background-image: url('<?php echo esc_url( $card_img ); ?>');"></div>
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                    </div>
                    <div class="flex flex-col justify-center h-full flex-1 w-full text-center sm:text-left z-10">
                        <?php if ($card_tag !== '') : ?><span class="px-2 py-0.5 rounded <?php echo esc_attr( $tag_class ); ?> text-[10px] font-bold uppercase tracking-wide mb-2 inline-block w-fit mx-auto sm:mx-0"><?php echo esc_html( $card_tag ); ?></span><?php endif; ?>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors"><?php echo esc_html( (string) ( $card['title'] ?? '' ) ); ?></h3>
                        <?php if ( (string) ( $card['description'] ?? '' ) !== '' ) : ?><p class="text-sm text-gray-500 leading-relaxed mb-4"><?php echo esc_html( (string) $card['description'] ); ?></p><?php endif; ?>
                        <div class="flex items-center justify-center sm:justify-start text-xs font-bold text-primary uppercase tracking-wider group/link"><?php echo esc_html( (string) ( $card_link['title'] ?? 'Explore' ) ); ?> <i data-lucide="arrow-right" class="w-3 h-3 ml-1 transition-transform group-hover/link:translate-x-1"></i></div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
            <div class="flex justify-center md:justify-start pt-4">
                <a class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white border border-gray-200 text-sm font-semibold text-gray-800 hover:text-primary hover:border-primary/30 hover:shadow-md transition-all group" href="<?php echo esc_url( (string) ( $academics_cta['url'] ?? '#' ) ); ?>"<?php echo !empty($academics_cta['target']) ? ' target="' . esc_attr( (string) $academics_cta['target'] ) . '"' : ''; ?>>
                    <?php echo esc_html( (string) ( $academics_cta['title'] ?? 'View All Activities' ) ); ?>
                    <i data-lucide="arrow-right" class="size-5 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
