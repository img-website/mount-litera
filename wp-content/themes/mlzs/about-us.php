<?php
/**
 * Template Name: About Us Page
 * About Us: Hero, Mission & Overview, Legacy, CTA, Values & Philosophy (ACF dynamic)
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
$hero_badge    = $opt ? get_field('about_hero_badge', $page_id) : null;
$hero_headline = $opt ? get_field('about_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('about_hero_highlight', $page_id) : null;
$hero_suffix   = $opt ? get_field('about_hero_headline_suffix', $page_id) : null;
$hero_sub      = $opt ? get_field('about_hero_subheadline', $page_id) : null;
$hero_cta1     = $opt ? get_field('about_hero_cta_primary', $page_id) : null;
$hero_cta2     = $opt ? get_field('about_hero_cta_secondary', $page_id) : null;
$hero_icon1    = $opt ? get_field('about_hero_cta_primary_icon', $page_id) : null;
$hero_icon2    = $opt ? get_field('about_hero_cta_secondary_icon', $page_id) : null;
$hero_bg       = $opt ? get_field('about_hero_bg_image', $page_id) : null;

$hero_badge    = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Our Story & Legacy';
$hero_headline = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'About';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Mount Litera';
$hero_suffix   = ($hero_suffix !== '' && $hero_suffix !== null) ? (string) $hero_suffix : 'Zee School';
$hero_sub      = ($hero_sub !== '' && $hero_sub !== null) ? (string) $hero_sub : 'Preparing leaders of the 21st century through innovative education that blends tradition with modernity, values with technology.';
$hero_cta1     = (is_array($hero_cta1) && !empty($hero_cta1['url'])) ? $hero_cta1 : array('url' => $home_url . '#mission', 'title' => 'Our Mission', 'target' => '');
$hero_cta2     = (is_array($hero_cta2) && !empty($hero_cta2['url'])) ? $hero_cta2 : array('url' => $home_url . '#legacy', 'title' => 'Our Legacy', 'target' => '');
$hero_icon1    = (is_string($hero_icon1) && trim($hero_icon1) !== '') ? trim($hero_icon1) : 'arrow-down';
$hero_icon2    = (is_string($hero_icon2) && trim($hero_icon2) !== '') ? trim($hero_icon2) : 'history';
$hero_bg       = (is_string($hero_bg) && $hero_bg !== '') ? $hero_bg : 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80';
if (is_array($hero_bg) && !empty($hero_bg['url'])) $hero_bg = $hero_bg['url'];

// ——— Mission ———
$mission_badge   = $opt ? get_field('about_mission_badge', $page_id) : null;
$mission_heading = $opt ? get_field('about_mission_heading', $page_id) : null;
$mission_paras   = $opt ? get_field('about_mission_paragraphs', $page_id) : null;
$mission_stats   = $opt ? get_field('about_mission_stats', $page_id) : null;
$mission_img     = $opt ? get_field('about_mission_image', $page_id) : null;
$mission_img_title = $opt ? get_field('about_mission_image_title', $page_id) : null;
$mission_img_cap  = $opt ? get_field('about_mission_image_caption', $page_id) : null;

$mission_badge   = ($mission_badge !== '' && $mission_badge !== null) ? (string) $mission_badge : 'Our Endeavour';
$mission_heading = ($mission_heading !== '' && $mission_heading !== null) ? (string) $mission_heading : 'Mount Litera Zee School';
$mission_paras   = ($mission_paras !== '' && $mission_paras !== null) ? (string) $mission_paras : "Mount Litera Zee School is an endeavor by the Essel Group to prepare leaders of the 21st century through its Education arm, Zee Learn Limited.\n\nWith more than 65 schools in 55 cities, Mount Litera Zee School is India's fastest growing network of K12 schools.\n\nZee Learn Limited has its preschool network Kidzee with more than 1350 preschools in India and is Asia's largest network of preschools.";
$default_mission_stats = array(
    array('number' => '65+', 'label' => 'Schools Across India'),
    array('number' => '55', 'label' => 'Cities'),
);
$mission_stats = (is_array($mission_stats) && count($mission_stats) >= 2) ? $mission_stats : $default_mission_stats;
$_mission_img = $mission_img;
$mission_img = '';
if (is_array($_mission_img) && !empty($_mission_img['url'])) $mission_img = (string) $_mission_img['url'];
elseif (is_string($_mission_img) && $_mission_img !== '') $mission_img = (string) $_mission_img;
if ($mission_img === '') $mission_img = 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80';
$mission_img_title = ($mission_img_title !== '' && $mission_img_title !== null) ? (string) $mission_img_title : 'Innovative Learning Environment';
$mission_img_cap   = ($mission_img_cap !== '' && $mission_img_cap !== null) ? (string) $mission_img_cap : 'State-of-the-art infrastructure for holistic development';

// ——— Legacy ———
$legacy_badge   = $opt ? get_field('about_legacy_badge', $page_id) : null;
$legacy_icon    = $opt ? get_field('about_legacy_badge_icon', $page_id) : null;
$legacy_heading = $opt ? get_field('about_legacy_heading', $page_id) : null;
$legacy_highlight = $opt ? get_field('about_legacy_highlight', $page_id) : null;
$legacy_suffix  = $opt ? get_field('about_legacy_heading_suffix', $page_id) : null;
$legacy_intro   = $opt ? get_field('about_legacy_intro', $page_id) : null;
$legacy_image   = $opt ? get_field('about_legacy_image', $page_id) : null;
$legacy_year    = $opt ? get_field('about_legacy_year', $page_id) : null;
$legacy_year_label = $opt ? get_field('about_legacy_year_label', $page_id) : null;
$legacy_year_cap  = $opt ? get_field('about_legacy_year_caption', $page_id) : null;
$legacy_paras   = $opt ? get_field('about_legacy_paragraphs', $page_id) : null;
$legacy_vision_title = $opt ? get_field('about_legacy_vision_title', $page_id) : null;
$legacy_vision_text  = $opt ? get_field('about_legacy_vision_text', $page_id) : null;
$legacy_stats   = $opt ? get_field('about_legacy_stats', $page_id) : null;

$legacy_badge   = ($legacy_badge !== '' && $legacy_badge !== null) ? (string) $legacy_badge : 'Our Legacy';
$legacy_icon    = (is_string($legacy_icon) && trim($legacy_icon) !== '') ? trim($legacy_icon) : 'sparkles';
$legacy_heading = ($legacy_heading !== '' && $legacy_heading !== null) ? (string) $legacy_heading : 'The';
$legacy_highlight = ($legacy_highlight !== '' && $legacy_highlight !== null) ? (string) $legacy_highlight : 'Legacy';
$legacy_suffix  = ($legacy_suffix !== '' && $legacy_suffix !== null) ? (string) $legacy_suffix : 'of Excellence';
$legacy_intro   = ($legacy_intro !== '' && $legacy_intro !== null) ? (string) $legacy_intro : "Pioneering educational innovation since 1994, shaping minds and building futures";
$_legacy_img = $legacy_image;
$legacy_image = '';
if (is_array($_legacy_img) && !empty($_legacy_img['url'])) $legacy_image = (string) $_legacy_img['url'];
elseif (is_string($_legacy_img) && $_legacy_img !== '') $legacy_image = (string) $_legacy_img;
if ($legacy_image === '') $legacy_image = 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80';
$legacy_year    = ($legacy_year !== '' && $legacy_year !== null) ? (string) $legacy_year : '1994';
$legacy_year_label = ($legacy_year_label !== '' && $legacy_year_label !== null) ? (string) $legacy_year_label : 'Year of Foundation';
$legacy_year_cap  = ($legacy_year_cap !== '' && $legacy_year_cap !== null) ? (string) $legacy_year_cap : 'Innovation leader in Indian education';
$legacy_paras   = ($legacy_paras !== '' && $legacy_paras !== null) ? (string) $legacy_paras : "Mount Litera Zee School is an endeavour by the Essel Group led by Shri Subhash Chandra to prepare leaders of the 21st century through its education arm, Zee Learn Limited.\n\nZee Learn Limited is an innovation leader in Indian education since 1994. We introduced various firsts in the country ranging from Zeed, Kidzee preschools, Mount Litera Zee Schools, Mount Litera School International, BrainCalfeSchool Programs and Zee Institutes of Media Art and Creative Art.";
$legacy_vision_title = ($legacy_vision_title !== '' && $legacy_vision_title !== null) ? (string) $legacy_vision_title : 'Our Vision';
$legacy_vision_text  = ($legacy_vision_text !== '' && $legacy_vision_text !== null) ? (string) $legacy_vision_text : 'The aim of Mount Litera Zee Schools is to establish social spaces in the country for providing quality educational experiences to improve human capital and create quality manpower for a knowledge society.';
$default_legacy_stats = array(
    array('number' => '1350+', 'label' => 'Preschools'),
    array('number' => '100%', 'label' => 'Focus on Quality'),
    array('number' => '28+', 'label' => 'Years of Excellence'),
);
$legacy_stats = (is_array($legacy_stats) && count($legacy_stats) >= 3) ? $legacy_stats : $default_legacy_stats;

// ——— CTA ———
$cta_badge   = $opt ? get_field('about_cta_badge', $page_id) : null;
$cta_icon    = $opt ? get_field('about_cta_badge_icon', $page_id) : null;
$cta_heading = $opt ? get_field('about_cta_heading', $page_id) : null;
$cta_highlight = $opt ? get_field('about_cta_highlight', $page_id) : null;
$cta_desc    = $opt ? get_field('about_cta_description', $page_id) : null;
$cta_primary = $opt ? get_field('about_cta_primary', $page_id) : null;
$cta_secondary = $opt ? get_field('about_cta_secondary', $page_id) : null;
$cta_icon1   = $opt ? get_field('about_cta_primary_icon', $page_id) : null;
$cta_icon2   = $opt ? get_field('about_cta_secondary_icon', $page_id) : null;

$cta_badge   = ($cta_badge !== '' && $cta_badge !== null) ? (string) $cta_badge : 'Join Our Community';
$cta_icon    = (is_string($cta_icon) && trim($cta_icon) !== '') ? trim($cta_icon) : 'star';
$cta_heading = ($cta_heading !== '' && $cta_heading !== null) ? (string) $cta_heading : 'Be Part of the Mount Litera';
$cta_highlight = ($cta_highlight !== '' && $cta_highlight !== null) ? (string) $cta_highlight : 'Legacy';
$cta_desc    = ($cta_desc !== '' && $cta_desc !== null) ? (string) $cta_desc : "Join India's fastest growing network of K12 schools and give your child the gift of world-class education combined with strong values and innovative learning.";
$cta_primary   = (is_array($cta_primary) && !empty($cta_primary['url'])) ? $cta_primary : array('url' => $home_url . '#', 'title' => 'Start Admission Process', 'target' => '');
$cta_secondary = (is_array($cta_secondary) && !empty($cta_secondary['url'])) ? $cta_secondary : array('url' => $home_url . '#', 'title' => 'Schedule a Visit', 'target' => '');
$cta_icon1   = (is_string($cta_icon1) && trim($cta_icon1) !== '') ? trim($cta_icon1) : 'arrow-right';
$cta_icon2   = (is_string($cta_icon2) && trim($cta_icon2) !== '') ? trim($cta_icon2) : 'phone';

// ——— Values ———
$values_badge   = $opt ? get_field('about_values_badge', $page_id) : null;
$values_icon    = $opt ? get_field('about_values_badge_icon', $page_id) : null;
$values_heading = $opt ? get_field('about_values_heading', $page_id) : null;
$values_highlight = $opt ? get_field('about_values_highlight', $page_id) : null;
$values_intro   = $opt ? get_field('about_values_intro', $page_id) : null;
$values_cards   = $opt ? get_field('about_values_cards', $page_id) : null;
$commit_heading = $opt ? get_field('about_commitment_heading', $page_id) : null;
$commit_text    = $opt ? get_field('about_commitment_text', $page_id) : null;
$commit_cta1    = $opt ? get_field('about_commitment_cta_primary', $page_id) : null;
$commit_cta2    = $opt ? get_field('about_commitment_cta_secondary', $page_id) : null;
$commit_icon1  = $opt ? get_field('about_commitment_cta_primary_icon', $page_id) : null;
$commit_icon2  = $opt ? get_field('about_commitment_cta_secondary_icon', $page_id) : null;
$commit_stats  = $opt ? get_field('about_commitment_stats', $page_id) : null;

$values_badge   = ($values_badge !== '' && $values_badge !== null) ? (string) $values_badge : 'Our Values';
$values_icon    = (is_string($values_icon) && trim($values_icon) !== '') ? trim($values_icon) : 'heart';
$values_heading = ($values_heading !== '' && $values_heading !== null) ? (string) $values_heading : 'Educational';
$values_highlight = ($values_highlight !== '' && $values_highlight !== null) ? (string) $values_highlight : 'Philosophy';
$values_intro   = ($values_intro !== '' && $values_intro !== null) ? (string) $values_intro : 'We believe in creating social spaces for quality education that builds human capital for a knowledge society';
$default_values_cards = array(
    array('icon' => 'users', 'title' => 'Social Spaces', 'description' => 'Establishing inclusive social spaces that foster collaboration, creativity, and community building among students.', 'style' => 'primary'),
    array('icon' => 'graduation-cap', 'title' => 'Quality Education', 'description' => 'Providing exceptional educational experiences that combine academic excellence with character development.', 'style' => 'accent'),
    array('icon' => 'target', 'title' => 'Human Capital', 'description' => 'Developing quality manpower equipped with skills, values, and knowledge to thrive in contemporary society.', 'style' => 'primary-light'),
);
$values_cards = (is_array($values_cards) && count($values_cards) >= 3) ? $values_cards : $default_values_cards;
$commit_heading = ($commit_heading !== '' && $commit_heading !== null) ? (string) $commit_heading : 'Our Commitment to Excellence';
$commit_text    = ($commit_text !== '' && $commit_text !== null) ? (string) $commit_text : 'Mount Litera Zee School synthesizes human values with the highest quality of teaching-learning using modern technology-driven tools. We prepare well-rounded personalities who can lead effectively in our contemporary society.';
$commit_cta1    = (is_array($commit_cta1) && !empty($commit_cta1['url'])) ? $commit_cta1 : array('url' => $home_url . '#', 'title' => 'Explore Academics', 'target' => '');
$commit_cta2    = (is_array($commit_cta2) && !empty($commit_cta2['url'])) ? $commit_cta2 : array('url' => $home_url . '#', 'title' => 'Download Brochure', 'target' => '');
$commit_icon1   = (is_string($commit_icon1) && trim($commit_icon1) !== '') ? trim($commit_icon1) : 'arrow-right';
$commit_icon2   = (is_string($commit_icon2) && trim($commit_icon2) !== '') ? trim($commit_icon2) : 'download';
$default_commit_stats = array(
    array('number' => '21st', 'label' => 'Century Leaders'),
    array('number' => '100%', 'label' => 'Focus on Innovation'),
    array('number' => '65+', 'label' => 'Schools Network'),
    array('number' => '1350+', 'label' => 'Preschool Centers'),
);
$commit_stats = (is_array($commit_stats) && count($commit_stats) >= 4) ? $commit_stats : $default_commit_stats;
?>

    <!-- Hero Section -->
    <section class="relative min-h-[60vh] sm:min-h-[70vh] flex items-center justify-center bg-cover bg-center md:bg-fixed px-4 sm:px-6 lg:px-8 overflow-hidden" style="background-image: linear-gradient(135deg, rgba(61,52,139,0.9) 0%, rgba(118,120,237,0.8) 50%, rgba(247,184,1,0.7) 100%), url('<?php echo esc_url($hero_bg); ?>');">
        <div class="absolute inset-0 bg-gradient-to-b from-primary/90 via-primary/70 to-primary/50"></div>
        <div class="relative z-10 w-full max-w-7xl mx-auto text-center pt-28 sm:pt-32 pb-12 sm:pb-16">
            <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 rounded-full bg-white/20 backdrop-blur-md border border-white/30 mb-4 sm:mb-6 animate-fade-in-up">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-secondary"></span>
                </span>
                <span class="text-xs font-semibold text-white uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
            </div>
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold text-white leading-[1.1] tracking-tight mb-4 sm:mb-6 max-w-5xl mx-auto drop-shadow-lg px-2">
                <?php echo esc_html($hero_headline); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame via-tiger-orange to-cayenne-red"><?php echo esc_html($hero_highlight); ?></span> <?php echo esc_html($hero_suffix); ?>
            </h1>
            <p class="text-base sm:text-lg md:text-xl text-slate-200 mb-6 sm:mb-8 max-w-3xl mx-auto leading-relaxed font-light opacity-95 px-2">
                <?php echo esc_html($hero_sub); ?>
            </p>
            <div class="flex flex-col sm:flex-row flex-wrap justify-center gap-3 sm:gap-4 px-2">
                <a href="<?php echo esc_url($hero_cta1['url']); ?>" <?php echo !empty($hero_cta1['target']) ? ' target="' . esc_attr($hero_cta1['target']) . '"' : ''; ?> class="px-4 sm:px-8 py-2 sm:py-3 bg-gradient-to-r from-primary to-primary-dark text-white rounded-full font-bold text-sm sm:text-lg hover:shadow-[0_0_20px_rgba(61,52,139,0.5)] transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2 group ring-1 ring-white/20 w-full sm:w-auto">
                    <?php echo esc_html(isset($hero_cta1['title']) ? $hero_cta1['title'] : 'Our Mission'); ?>
                    <i data-lucide="<?php echo esc_attr($hero_icon1); ?>" class="size-4 sm:size-5 transition-transform"></i>
                </a>
                <a href="<?php echo esc_url($hero_cta2['url']); ?>" <?php echo !empty($hero_cta2['target']) ? ' target="' . esc_attr($hero_cta2['target']) . '"' : ''; ?> class="px-4 sm:px-8 py-2 sm:py-3 bg-white/10 backdrop-blur-sm border border-white/30 text-white rounded-full font-bold text-sm sm:text-lg hover:bg-white/20 transition-all flex items-center justify-center gap-2 group w-full sm:w-auto">
                    <i data-lucide="<?php echo esc_attr($hero_icon2); ?>" class="size-4 sm:size-5"></i>
                    <?php echo esc_html(isset($hero_cta2['title']) ? $hero_cta2['title'] : 'Our Legacy'); ?>
                </a>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-background-light to-transparent"></div>
    </section>

    <!-- Mission & Overview Section -->
    <section id="mission" class="relative px-4 sm:px-6 lg:px-8 py-12 sm:py-16 md:py-24 bg-background-light overflow-x-hidden">
        <div class="absolute top-0 left-0 -z-10 h-full w-full overflow-hidden">
            <div class="absolute -top-40 -right-40 h-[500px] w-[500px] rounded-full bg-indigo-velvet/5 blur-[100px]"></div>
            <div class="absolute top-1/2 -left-20 h-[300px] w-[300px] rounded-full bg-amber-flame/10 blur-[80px]"></div>
        </div>
        <div class="mx-auto max-w-7xl w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-12 lg:gap-20 items-center">
                <div class="flex flex-col gap-6 sm:gap-8 order-2 lg:order-1">
                    <div class="flex flex-col gap-4 sm:gap-6">
                        <span class="w-fit rounded-full bg-primary/10 px-3 py-1 text-xs font-bold uppercase tracking-wider text-primary ring-1 ring-primary/20"><?php echo esc_html($mission_badge); ?></span>
                        <h2 class="font-display text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-text-main-light"><?php echo esc_html($mission_heading); ?></h2>
                        <div class="space-y-3 sm:space-y-4 text-base sm:text-lg leading-relaxed text-text-secondary-light">
                            <?php foreach (preg_split('/\n\s*\n/', trim($mission_paras), -1, PREG_SPLIT_NO_EMPTY) as $p) : ?>
                                <p><?php echo esc_html(trim($p)); ?></p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 sm:gap-6 mt-2 sm:mt-4">
                        <?php foreach (array_slice($mission_stats, 0, 2) as $stat) : ?>
                        <div class="bg-gradient-to-br from-white/90 to-white/95 backdrop-blur-[10px] border border-white/20 shadow-[0_8px_32px_rgba(31,38,135,0.1)] rounded-2xl p-4 sm:p-6 text-center border-border-light">
                            <div class="text-3xl sm:text-4xl font-bold text-primary mb-2"><?php echo esc_html((string) (isset($stat['number']) ? $stat['number'] : '')); ?></div>
                            <div class="text-xs sm:text-sm font-medium text-text-secondary-light uppercase tracking-wide"><?php echo esc_html((string) (isset($stat['label']) ? $stat['label'] : '')); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="relative order-1 lg:order-2 mb-8 lg:mb-0">
                    <div class="relative rounded-2xl sm:rounded-3xl overflow-hidden shadow-2xl">
                        <img src="<?php echo esc_url($mission_img); ?>" alt="<?php echo esc_attr($mission_img_title); ?>" class="w-full h-[300px] sm:h-[350px] md:h-[400px] object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-6 md:p-8 text-white">
                            <h3 class="text-xl sm:text-2xl font-bold mb-2"><?php echo esc_html($mission_img_title); ?></h3>
                            <p class="text-xs sm:text-sm opacity-90"><?php echo esc_html($mission_img_cap); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Legacy Section -->
    <section id="legacy" class="relative px-4 sm:px-6 lg:px-8 py-12 sm:py-16 md:py-24 bg-gradient-to-b from-background-light to-primary/5 overflow-x-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-accent/5 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="mx-auto max-w-7xl w-full">
            <div class="text-center mb-10 sm:mb-12 md:mb-16">
                <span class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 rounded-full bg-accent/10 border border-accent/30 text-accent text-xs font-bold uppercase tracking-wider mb-4">
                    <i data-lucide="<?php echo esc_attr($legacy_icon); ?>" class="w-4 h-4"></i>
                    <?php echo esc_html($legacy_badge); ?>
                </span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-text-main-light mb-4 sm:mb-6 px-2">
                    <?php echo esc_html($legacy_heading); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-primary-light to-accent"><?php echo esc_html($legacy_highlight); ?></span> <?php echo esc_html($legacy_suffix); ?>
                </h2>
                <p class="text-base sm:text-lg text-text-secondary-light max-w-3xl mx-auto px-2"><?php echo esc_html($legacy_intro); ?></p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-12 items-start lg:items-center">
                <div class="relative order-2 lg:order-1">
                    <div class="relative rounded-2xl sm:rounded-3xl overflow-hidden shadow-2xl">
                        <img src="<?php echo esc_url($legacy_image); ?>" alt="<?php echo esc_attr($legacy_highlight . ' ' . $legacy_suffix); ?>" class="w-full h-[300px] sm:h-[400px] md:h-[500px] object-cover">
                        <div class="absolute inset-0 bg-gradient-to-tr from-primary/70 to-transparent"></div>
                    </div>
                    <div class="absolute bottom-0 left-2 sm:-bottom-4 sm:-left-4 bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-2xl max-w-[calc(100%-1rem)] sm:max-w-xs z-10">
                        <div class="text-3xl sm:text-4xl md:text-5xl font-bold text-primary mb-1 sm:mb-2"><?php echo esc_html($legacy_year); ?></div>
                        <div class="text-xs sm:text-sm font-bold text-text-main-light uppercase tracking-wide"><?php echo esc_html($legacy_year_label); ?></div>
                        <p class="text-xs text-text-secondary-light mt-1 sm:mt-2"><?php echo esc_html($legacy_year_cap); ?></p>
                    </div>
                </div>
                <div class="space-y-6 sm:space-y-8 order-1 lg:order-2">
                    <div class="space-y-4 sm:space-y-6">
                        <?php foreach (preg_split('/\n\s*\n/', trim($legacy_paras), -1, PREG_SPLIT_NO_EMPTY) as $p) : ?>
                            <p class="text-base sm:text-lg leading-relaxed text-text-secondary-light"><?php echo esc_html(trim($p)); ?></p>
                        <?php endforeach; ?>
                    </div>
                    <div class="bg-white rounded-xl sm:rounded-2xl p-6 sm:p-8 shadow-soft border border-border-light">
                        <h3 class="text-xl sm:text-2xl font-bold text-primary mb-3 sm:mb-4"><?php echo esc_html($legacy_vision_title); ?></h3>
                        <p class="text-sm sm:text-base text-text-secondary-light leading-relaxed"><?php echo esc_html($legacy_vision_text); ?></p>
                    </div>
                    <div class="grid grid-cols-3 gap-3 sm:gap-4">
                        <?php foreach (array_slice($legacy_stats, 0, 3) as $i => $stat) :
                            if ($i === 0) { $bg = 'bg-primary/5'; $text = 'text-primary'; }
                            elseif ($i === 1) { $bg = 'bg-accent/5'; $text = 'text-accent'; }
                            else { $bg = 'bg-primary/5'; $text = 'text-primary'; }
                        ?>
                        <div class="<?php echo esc_attr($bg); ?> rounded-lg sm:rounded-xl p-3 sm:p-4 text-center">
                            <div class="text-xl sm:text-2xl font-bold <?php echo esc_attr($text); ?> mb-1"><?php echo esc_html((string) (isset($stat['number']) ? $stat['number'] : '')); ?></div>
                            <div class="text-xs font-medium text-text-secondary-light"><?php echo esc_html((string) (isset($stat['label']) ? $stat['label'] : '')); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative px-4 sm:px-6 lg:px-8 py-12 sm:py-16 md:py-24 overflow-x-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-primary via-primary-dark to-slate-900"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-20"></div>
        <div class="relative z-10 mx-auto max-w-7xl w-full">
            <div class="text-center text-white">
                <span class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 text-white text-xs font-bold uppercase tracking-wider mb-4 sm:mb-6">
                    <i data-lucide="<?php echo esc_attr($cta_icon); ?>" class="w-4 h-4"></i>
                    <?php echo esc_html($cta_badge); ?>
                </span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 sm:mb-6 px-2">
                    <?php echo esc_html($cta_heading); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame to-tiger-orange"><?php echo esc_html($cta_highlight); ?></span>
                </h2>
                <p class="text-base sm:text-lg text-slate-200 max-w-2xl mx-auto mb-8 sm:mb-10 leading-relaxed px-2"><?php echo esc_html($cta_desc); ?></p>
                <div class="flex flex-col sm:flex-row flex-wrap justify-center gap-3 sm:gap-4 px-2">
                    <a href="<?php echo esc_url($cta_primary['url']); ?>" <?php echo !empty($cta_primary['target']) ? ' target="' . esc_attr($cta_primary['target']) . '"' : ''; ?> class="px-4 sm:px-8 py-2 sm:py-4 bg-white text-primary rounded-full font-bold text-sm sm:text-lg hover:shadow-[0_0_30px_rgba(255,255,255,0.3)] transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2 group w-full sm:w-auto">
                        <?php echo esc_html(isset($cta_primary['title']) ? $cta_primary['title'] : 'Start Admission Process'); ?>
                        <i data-lucide="<?php echo esc_attr($cta_icon1); ?>" class="size-4 sm:size-5 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="<?php echo esc_url($cta_secondary['url']); ?>" <?php echo !empty($cta_secondary['target']) ? ' target="' . esc_attr($cta_secondary['target']) . '"' : ''; ?> class="px-4 sm:px-8 py-2 sm:py-4 bg-transparent border-2 border-white text-white rounded-full font-bold text-sm sm:text-lg hover:bg-white/10 transition-all flex items-center justify-center gap-2 group w-full sm:w-auto">
                        <i data-lucide="<?php echo esc_attr($cta_icon2); ?>" class="size-4 sm:size-5"></i>
                        <?php echo esc_html(isset($cta_secondary['title']) ? $cta_secondary['title'] : 'Schedule a Visit'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Values & Philosophy Section -->
    <section class="relative px-4 sm:px-6 lg:px-8 py-12 sm:py-16 md:py-24 bg-gradient-to-b from-white to-background-light overflow-x-hidden">
        <div class="absolute top-0 left-0 w-full h-20 bg-gradient-to-b from-white to-transparent"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="mx-auto max-w-7xl w-full relative z-10">
            <div class="text-center mb-10 sm:mb-12 md:mb-16">
                <span class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 rounded-full bg-primary/10 border border-primary/30 text-primary text-xs font-bold uppercase tracking-wider mb-4">
                    <i data-lucide="<?php echo esc_attr($values_icon); ?>" class="w-4 h-4"></i>
                    <?php echo esc_html($values_badge); ?>
                </span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-text-main-light mb-4 sm:mb-6 px-2">
                    <?php echo esc_html($values_heading); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-primary-light to-accent"><?php echo esc_html($values_highlight); ?></span>
                </h2>
                <p class="text-base sm:text-lg text-text-secondary-light max-w-3xl mx-auto px-2"><?php echo esc_html($values_intro); ?></p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                <?php
                $value_styles = array('primary', 'accent', 'primary-light');
                foreach (array_slice($values_cards, 0, 3) as $idx => $card) :
                    $v_icon = isset($card['icon']) && trim((string) $card['icon']) !== '' ? trim((string) $card['icon']) : 'users';
                    $v_title = isset($card['title']) ? (string) $card['title'] : '';
                    $v_desc  = isset($card['description']) ? (string) $card['description'] : '';
                    $v_style = isset($card['style']) && in_array($card['style'], array('primary', 'accent', 'primary-light'), true) ? $card['style'] : (isset($value_styles[$idx]) ? $value_styles[$idx] : 'primary');
                    if ($v_style === 'primary') {
                        $box_bg = 'bg-primary/10'; $box_border = 'hover:border-primary/30'; $icon_text = 'text-primary'; $icon_hover = 'group-hover:bg-primary';
                    } elseif ($v_style === 'accent') {
                        $box_bg = 'bg-accent/10'; $box_border = 'hover:border-accent/30'; $icon_text = 'text-accent'; $icon_hover = 'group-hover:bg-accent';
                    } else {
                        $box_bg = 'bg-primary-light/10'; $box_border = 'hover:border-primary-light/30'; $icon_text = 'text-primary-light'; $icon_hover = 'group-hover:bg-primary-light';
                    }
                ?>
                <div class="group relative bg-white rounded-xl sm:rounded-2xl p-6 sm:p-8 shadow-soft hover:shadow-xl border border-border-light <?php echo esc_attr($box_border); ?> transition-all duration-300 hover:-translate-y-2">
                    <div class="absolute -top-3 sm:-top-4 left-6 sm:left-8 w-12 h-12 sm:w-16 sm:h-16 rounded-xl sm:rounded-2xl <?php echo esc_attr($box_bg); ?> flex items-center justify-center <?php echo esc_attr($icon_hover); ?> group-hover:text-white transition-colors">
                        <i data-lucide="<?php echo esc_attr($v_icon); ?>" class="w-6 h-6 sm:w-8 sm:h-8 <?php echo esc_attr($icon_text); ?> group-hover:text-white"></i>
                    </div>
                    <div class="pt-6 sm:pt-8">
                        <h3 class="text-xl sm:text-2xl font-bold text-text-main-light mb-3 sm:mb-4"><?php echo esc_html($v_title); ?></h3>
                        <p class="text-sm sm:text-base text-text-secondary-light leading-relaxed"><?php echo esc_html($v_desc); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="mt-10 sm:mt-12 md:mt-16 bg-gradient-to-r from-primary/10 to-accent/10 rounded-2xl sm:rounded-3xl p-6 sm:p-8 md:p-12 border border-primary/20">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 items-center">
                    <div>
                        <h3 class="text-2xl sm:text-3xl font-bold text-text-main-light mb-4 sm:mb-6"><?php echo esc_html($commit_heading); ?></h3>
                        <p class="text-sm sm:text-base text-text-secondary-light leading-relaxed mb-4 sm:mb-6"><?php echo esc_html($commit_text); ?></p>
                        <div class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4">
                            <a href="<?php echo esc_url($commit_cta1['url']); ?>" <?php echo !empty($commit_cta1['target']) ? ' target="' . esc_attr($commit_cta1['target']) . '"' : ''; ?> class="px-5 sm:px-6 py-2.5 sm:py-3 bg-primary text-white rounded-full font-bold text-sm sm:text-base hover:bg-primary-dark transition-all flex items-center justify-center gap-2 group w-full sm:w-auto">
                                <?php echo esc_html(isset($commit_cta1['title']) ? $commit_cta1['title'] : 'Explore Academics'); ?>
                                <i data-lucide="<?php echo esc_attr($commit_icon1); ?>" class="size-4 sm:size-5 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                            <a href="<?php echo esc_url($commit_cta2['url']); ?>" <?php echo !empty($commit_cta2['target']) ? ' target="' . esc_attr($commit_cta2['target']) . '"' : ''; ?> class="px-5 sm:px-6 py-2.5 sm:py-3 bg-white border border-border-light text-text-main-light rounded-full font-bold text-sm sm:text-base hover:bg-gray-50 transition-all flex items-center justify-center gap-2 group w-full sm:w-auto">
                                <i data-lucide="<?php echo esc_attr($commit_icon2); ?>" class="size-4 sm:size-5"></i>
                                <?php echo esc_html(isset($commit_cta2['title']) ? $commit_cta2['title'] : 'Download Brochure'); ?>
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 sm:gap-6">
                        <?php
                        $commit_text_classes = array('text-primary', 'text-accent', 'text-primary-light', 'text-accent-dark');
                        foreach (array_slice($commit_stats, 0, 4) as $cidx => $cstat) :
                            $cc = isset($commit_text_classes[$cidx]) ? $commit_text_classes[$cidx] : 'text-primary';
                        ?>
                        <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 text-center shadow-sm">
                            <div class="text-2xl sm:text-3xl font-bold <?php echo esc_attr($cc); ?> mb-2"><?php echo esc_html((string) (isset($cstat['number']) ? $cstat['number'] : '')); ?></div>
                            <div class="text-xs sm:text-sm font-medium text-text-secondary-light"><?php echo esc_html((string) (isset($cstat['label']) ? $cstat['label'] : '')); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
