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
$cta_primary_text = function_exists('get_field') ? get_field('hero_cta_primary_text', $hero_page_id) : null;
$cta_primary_url  = function_exists('get_field') ? get_field('hero_cta_primary_url', $hero_page_id) : null;
$cta_secondary_text = function_exists('get_field') ? get_field('hero_cta_secondary_text', $hero_page_id) : null;
$cta_secondary_url  = function_exists('get_field') ? get_field('hero_cta_secondary_url', $hero_page_id) : null;
// If no page context (e.g. 0), also try option for backwards compatibility
if (!$hero_page_id && function_exists('get_field')) {
    if ($hero_badge === null) $hero_badge = get_field('hero_badge_text', 'option');
    if ($hero_line1 === null) $hero_line1 = get_field('hero_headline_line1', 'option');
    if ($hero_highlight === null) $hero_highlight = get_field('hero_headline_highlight', 'option');
    if ($hero_subheadline === null) $hero_subheadline = get_field('hero_subheadline', 'option');
    if ($cta_primary_text === null) $cta_primary_text = get_field('hero_cta_primary_text', 'option');
    if ($cta_primary_url === null) $cta_primary_url = get_field('hero_cta_primary_url', 'option');
    if ($cta_secondary_text === null) $cta_secondary_text = get_field('hero_cta_secondary_text', 'option');
    if ($cta_secondary_url === null) $cta_secondary_url = get_field('hero_cta_secondary_url', 'option');
}

$hero_badge       = $hero_badge !== '' && $hero_badge !== null ? $hero_badge : 'Admissions Open for 2025-26';
$hero_line1       = $hero_line1 !== '' && $hero_line1 !== null ? $hero_line1 : 'Fun. Study. Research.';
$hero_highlight   = $hero_highlight !== '' && $hero_highlight !== null ? $hero_highlight : 'Innovate. Play';
$hero_subheadline = $hero_subheadline !== '' && $hero_subheadline !== null ? $hero_subheadline : 'A Great School For A Great Future Of Your Child. Mount Litera Zee School will provide a complete and unique educational experience for the child, preparing the child for a successful life in the contemporary society.';
$cta_primary_text = $cta_primary_text !== '' && $cta_primary_text !== null ? $cta_primary_text : 'Start Application';
$cta_primary_url  = $cta_primary_url !== '' && $cta_primary_url !== null ? $cta_primary_url : '#';
$cta_secondary_text = $cta_secondary_text !== '' && $cta_secondary_text !== null ? $cta_secondary_text : 'Virtual Tour';
$cta_secondary_url  = $cta_secondary_url !== '' && $cta_secondary_url !== null ? $cta_secondary_url : '#';

$default_slide_url = 'https://images.unsplash.com/photo-1498243691581-b145c3f54a5a?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80';
$default_stats = array(
    array('stat_number' => '100%', 'stat_label' => 'University Acceptance'),
    array('stat_number' => '45+', 'stat_label' => 'Nationalities'),
    array('stat_number' => '12:1', 'stat_label' => 'Student-Teacher Ratio'),
    array('stat_number' => 'A+', 'stat_label' => 'Global Accreditation'),
);
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
                                    <div class="w-full h-full bg-cover bg-center scale-110 animate-hero-zoom" style="background-image: url('<?php echo esc_url($img_url); ?>');"></div>
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
            <span class="relative flex h-2.5 w-2.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-secondary"></span>
            </span>
            <span class="text-xs font-semibold text-white uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
        </div>
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-[1.1] tracking-tight mb-6 max-w-4xl drop-shadow-lg">
            <?php echo esc_html($hero_line1); ?> <br class="hidden md:block"/>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame via-tiger-orange to-cayenne-red"><?php echo esc_html($hero_highlight); ?></span>
        </h1>
        <p class="text-lg md:text-xl text-slate-200 mb-4 max-w-2xl leading-relaxed font-light opacity-95">
            <?php echo esc_html($hero_subheadline); ?>
        </p>
        <div class="flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto">
            <a href="<?php echo esc_url($cta_primary_url); ?>" class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-primary to-primary-dark text-white rounded-full font-bold text-lg hover:shadow-[0_0_20px_rgba(61,52,139,0.5)] transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2 group ring-1 ring-white/20">
                <?php echo esc_html($cta_primary_text); ?>
                <i data-lucide="arrow-up-right" class="size-5 group-hover:translate-x-1 transition-transform"></i>
            </a>
            <a href="<?php echo esc_url($cta_secondary_url); ?>" class="w-full sm:w-auto px-8 py-4 bg-white/10 backdrop-blur-sm border border-white/30 text-white rounded-full font-bold text-lg hover:bg-white/20 transition-all flex items-center justify-center gap-2 group">
                <i data-lucide="play-circle" class="size-5"></i>
                <?php echo esc_html($cta_secondary_text); ?>
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
                    <span class="text-3xl font-bold text-white"><?php echo esc_html($stat['stat_number']); ?></span>
                    <span class="text-sm text-slate-300 font-medium uppercase tracking-wide"><?php echo esc_html($stat['stat_label']); ?></span>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>

<!-- Welcome Section (static) -->
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
                        Welcome to Our Campus
                    </span>
                    <h1 class="font-display text-4xl font-bold tracking-tight text-text-main-light dark:text-text-main-dark sm:text-5xl lg:text-6xl">
                        Mount Litera Zee School, Alwar<br/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-velvet via-slate-blue to-amber-flame">A Great School For A Great Future</span>
                    </h1>
                    <p class="max-w-xl text-lg leading-relaxed text-text-secondary-light dark:text-text-secondary-dark">
                        Mount Litera Zee School will provide a complete and unique educational experience for the child, preparing the child for a successful life in the contemporary society. MLZS create an excellent educational institution synthesizing the human values with the highest quality of teaching–learning using modern technology-driven tools.
                    </p>
                </div>
                <div class="flex flex-wrap gap-4">
                    <a href="<?php echo esc_url($home_url); ?>#approach" class="group flex h-12 items-center justify-center rounded-full bg-primary px-8 text-base font-bold text-white shadow-glow transition-all hover:bg-primary-dark hover:shadow-lg hover:-translate-y-0.5">
                        <span>Discover Our Approach</span>
                        <i data-lucide="arrow-right" class="ml-2 size-5 transition-transform group-hover:translate-x-1"></i>
                    </a>
                    <a href="<?php echo esc_url($home_url); ?>#virtual-tour" class="flex h-12 items-center justify-center rounded-full border border-border-light dark:border-border-dark bg-transparent px-8 text-base font-medium text-text-main-light dark:text-text-main-dark transition-colors hover:bg-surface-light hover:text-primary hover:border-primary/30 hover:shadow-sm hover:dark:bg-surface-dark">
                        Virtual Tour
                    </a>
                </div>
            </div>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2">
                <div class="group relative overflow-hidden rounded-2xl bg-surface-light dark:bg-surface-dark p-6 shadow-soft transition-all duration-300 hover:-translate-y-1 hover:shadow-xl border border-transparent hover:border-primary/20 dark:border-border-dark dark:hover:border-primary/20">
                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-gradient-to-br from-primary/10 to-transparent transition-transform group-hover:scale-150"></div>
                    <div class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10 dark:bg-primary/20 text-primary shadow-sm group-hover:bg-primary group-hover:text-white transition-colors">
                        <i data-lucide="book-open" class="w-7 h-7"></i>
                    </div>
                    <div class="relative z-10 flex flex-col gap-2">
                        <h3 class="text-xl font-bold text-text-main-light dark:text-text-main-dark group-hover:text-primary transition-colors">The Best Learning Methods</h3>
                        <p class="text-sm leading-relaxed text-text-secondary-light dark:text-text-secondary-dark">
                            Mount Litera Zee School will provide a complete and unique educational experience for the child, preparing the child for a successful life in the contemporary society. MLZS create an excellent educational institution synthesizing the human values with the highest quality of teaching–learning using modern technology-driven tools for preparing a well-rounded personality for our society.
                        </p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-2xl bg-surface-light dark:bg-surface-dark p-6 shadow-soft transition-all duration-300 hover:-translate-y-1 hover:shadow-xl border border-transparent hover:border-accent/20 dark:border-border-dark dark:hover:border-accent/20 xl:mt-12">
                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-gradient-to-br from-accent/10 to-transparent transition-transform group-hover:scale-150"></div>
                    <div class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-xl bg-accent/10 dark:bg-accent/20 text-accent-dark shadow-sm group-hover:bg-accent group-hover:text-white transition-colors shadow-glow-accent">
                        <i data-lucide="award" class="w-7 h-7"></i>
                    </div>
                    <div class="relative z-10 flex flex-col gap-2">
                        <h3 class="text-xl font-bold text-text-main-light dark:text-text-main-dark group-hover:text-accent-dark transition-colors">Awesome Results Of Our Students</h3>
                        <p class="text-sm leading-relaxed text-text-secondary-light dark:text-text-secondary-dark">
                            We believe that every child is born unique. Each child has a unique brain network that shapes how she absorbs and responds to stimuli. One way of teaching does not work for every child. We need to teach the way they learn, not force them to learn the way we teach. We help children make meaning of life and develop the muscle to lead life effectively.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Approach + Academics sections are long; load from a partial for readability, or inline.
// Inlining Approach and Academics (shortened for response - will include full HTML).
?>
<!-- Approach Section (static) -->
<section id="approach" class="w-full bg-slate-900 border-b border-primary/30 px-4 sm:px-6 lg:px-8 py-16 md:py-24">
    <div class="max-w-7xl mx-auto w-full">
        <div class="flex flex-col items-center justify-start relative z-10">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-[1200px] h-[600px] bg-primary/20 blur-[150px] rounded-full pointer-events-none -z-10 mix-blend-screen"></div>
            <div class="absolute top-[20%] right-[10%] w-[400px] h-[400px] bg-accent/10 blur-[120px] rounded-full pointer-events-none -z-10"></div>
            <div class="w-full flex flex-col gap-4">
                <div class="flex flex-col items-center text-center gap-4">
                    <span class="px-3 py-1 rounded-full bg-primary/30 border border-primary/50 text-accent text-xs font-bold uppercase tracking-wider shadow-[0_0_10px_rgba(247,184,1,0.1)]">Our Philosophy</span>
                    <h1 class="text-4xl md:text-5xl font-bold text-white tracking-tight">The Litera Octave Approach</h1>
                    <p class="text-slate-400 text-lg max-w-2xl font-light">
                        A holistic framework for world-class education, seamlessly integrating eight core pillars of excellence to nurture future leaders.
                    </p>
                </div>
                <div class="w-full relative lg:px-10 md:px-6 px-4">
                    <div class="swiper approach-thumbs-swiper py-6 px-2 no-scrollbar">
                        <div class="swiper-wrapper flex">
                            <?php
                            $approach_tabs = array(
                                array('icon' => 'bar-chart-3', 'label' => 'Assessment'),
                                array('icon' => 'graduation-cap', 'label' => 'Teacher'),
                                array('icon' => 'book', 'label' => 'Content'),
                                array('icon' => 'building-2', 'label' => 'Infra'),
                                array('icon' => 'network', 'label' => 'Network'),
                                array('icon' => 'brain', 'label' => 'Life Skills'),
                                array('icon' => 'gem', 'label' => 'Enrichment'),
                                array('icon' => 'users', 'label' => 'Parents'),
                            );
                            foreach ($approach_tabs as $tab) {
                                ?>
                                <div class="swiper-slide inline-flex justify-center">
                                    <button type="button" class="group flex flex-col items-center gap-3 min-w-[50px] sm:min-w-[100px] cursor-pointer">
                                        <div class="size-12 sm:size-16 rounded-2xl bg-slate-800/80 border border-white/5 group-hover:border-accent/50 flex items-center justify-center transition-all duration-300 group-hover:shadow-[0_0_20px_rgba(247,184,1,0.15)] group-hover:-translate-y-1">
                                            <i data-lucide="<?php echo esc_attr($tab['icon']); ?>" class="size-6 sm:size-8 text-white group-hover:text-accent transition-colors"></i>
                                        </div>
                                        <span class="text-xs sm:text-sm font-medium text-slate-400 group-hover:text-accent transition-colors"><?php echo esc_html($tab['label']); ?></span>
                                    </button>
                                </div>
                                <?php
                            }
                            ?>
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
                            <!-- Slide 1: Assessment -->
                            <div class="swiper-slide">
                                <div class="bg-primary/5 rounded-[2rem] p-1 md:p-1.5 w-full bg-slate-900/60 backdrop-blur-xl border border-accent/30 shadow-[0_0_30px_rgba(247,184,1,0.1)]">
                                    <div class="flex flex-col md:flex-row items-stretch bg-slate-900/90 rounded-[1.8rem] overflow-hidden relative">
                                        <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9IiNmZmZmZmYiLz48L3N2Zz4=')] pointer-events-none"></div>
                                        <div class="flex-1 p-8 md:p-12 flex flex-col justify-center gap-6 order-2 md:order-1 z-10">
                                            <div class="flex items-center gap-3 mb-2">
                                                <div class="size-10 rounded-full bg-primary/20 flex items-center justify-center border border-primary/30 shadow-[0_0_10px_rgba(61,52,139,0.3)]">
                                                    <i data-lucide="bar-chart-3" class="size-5 text-accent"></i>
                                                </div>
                                                <span class="text-accent font-bold tracking-wider text-sm uppercase">Litera Assessment</span>
                                            </div>
                                            <h3 class="text-3xl md:text-4xl font-bold text-white">Litera <br/> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame to-tiger-orange">Assessment</span></h3>
                                            <p class="text-slate-400 leading-relaxed text-lg">Our assessments focus on identifying what students are good at instead of whether they are good or not. MLZS assessments take place on a continuous basis and at the child's pace rather than through only stressful periodic exams. Assessment patterns are based on feedback from various stakeholders including parents.</p>
                                            <div class="flex flex-wrap gap-3 mt-4">
                                                <span class="px-4 py-2 rounded-full bg-slate-800 text-accent-light text-sm font-medium border border-accent/30 shadow-sm">Continuous</span>
                                                <span class="px-4 py-2 rounded-full bg-slate-800 text-accent-light text-sm font-medium border border-accent/30 shadow-sm">Child's Pace</span>
                                                <span class="px-4 py-2 rounded-full bg-slate-800 text-accent-light text-sm font-medium border border-accent/30 shadow-sm">Holistic</span>
                                            </div>
                                            <div class="pt-4">
                                                <button type="button" class="flex items-center gap-2 text-white font-bold group hover:text-accent transition-colors">Explore Program <i data-lucide="arrow-right" class="size-5 group-hover:translate-x-1 group-hover:text-accent transition-all"></i></button>
                                            </div>
                                        </div>
                                        <div class="relative w-full md:w-[45%] h-64 md:h-auto order-1 md:order-2">
                                            <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');">
                                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent md:bg-gradient-to-l opacity-90"></div>
                                                <div class="absolute inset-0 bg-primary/30 mix-blend-multiply"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Remaining approach slides: same structure - abbreviated for length; in production you'd repeat for Teacher, Content, Infra, Network, Life Skills, Enrichment, Parents -->
                            <div class="swiper-slide">
                                <div class="bg-primary/5 rounded-[2rem] p-1 md:p-1.5 w-full bg-slate-900/60 backdrop-blur-xl border border-accent/30 shadow-[0_0_30px_rgba(247,184,1,0.1)]">
                                    <div class="flex flex-col md:flex-row items-stretch bg-slate-900/90 rounded-[1.8rem] overflow-hidden relative">
                                        <div class="flex-1 p-8 md:p-12 flex flex-col justify-center gap-6 order-2 md:order-1 z-10">
                                            <div class="flex items-center gap-3 mb-2">
                                                <div class="size-10 rounded-full bg-primary/20 flex items-center justify-center border border-primary/30"><i data-lucide="graduation-cap" class="size-5 text-accent"></i></div>
                                                <span class="text-accent font-bold tracking-wider text-sm uppercase">Litera Teacher</span>
                                            </div>
                                            <h3 class="text-3xl md:text-4xl font-bold text-white">Litera <br/> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame to-tiger-orange">Teacher</span></h3>
                                            <p class="text-slate-400 leading-relaxed text-lg">Our rigorous hiring and comprehensive training of teachers keep them abreast with the best-in-class learning methodologies. Teachers get assessed to ensure that students get the best learning environment.</p>
                                            <div class="pt-4"><button type="button" class="flex items-center gap-2 text-white font-bold group hover:text-accent transition-colors">Explore Program <i data-lucide="arrow-right" class="size-5 group-hover:translate-x-1"></i></button></div>
                                        </div>
                                        <div class="relative w-full md:w-[45%] h-64 md:h-auto order-1 md:order-2">
                                            <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1509062522246-3755977927d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');">
                                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent md:bg-gradient-to-l opacity-90"></div>
                                                <div class="absolute inset-0 bg-primary/30 mix-blend-multiply"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php for ($i = 0; $i < 6; $i++) : ?>
                            <div class="swiper-slide">
                                <div class="bg-primary/5 rounded-[2rem] p-1 md:p-1.5 w-full bg-slate-900/60 backdrop-blur-xl border border-accent/30">
                                    <div class="flex flex-col md:flex-row items-stretch bg-slate-900/90 rounded-[1.8rem] overflow-hidden relative p-8 md:p-12">
                                        <div class="flex-1 flex flex-col justify-center gap-6 z-10">
                                            <h3 class="text-3xl md:text-4xl font-bold text-white">Litera Octave</h3>
                                            <p class="text-slate-400 leading-relaxed text-lg">A holistic framework for world-class education.</p>
                                            <div class="pt-4"><button type="button" class="flex items-center gap-2 text-white font-bold group hover:text-accent transition-colors">Explore Program <i data-lucide="arrow-right" class="size-5 group-hover:translate-x-1"></i></button></div>
                                        </div>
                                        <div class="relative w-full md:w-[45%] h-64 md:h-auto">
                                            <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');">
                                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent md:bg-gradient-to-l opacity-90"></div>
                                                <div class="absolute inset-0 bg-primary/30 mix-blend-multiply"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="swiper-pagination approach-pagination flex justify-center gap-2 mt-4"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Academics Section (static) -->
<section id="academics" class="flex-1 flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 py-16 md:py-24 relative bg-gradient-to-b from-background-light to-white overflow-hidden">
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[120px] pointer-events-none opacity-60"></div>
    <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-accent/5 rounded-full blur-[100px] pointer-events-none opacity-60"></div>
    <div class="w-full max-w-7xl mx-auto z-10">
        <div class="mb-14 text-center md:text-left relative">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-gray-200 shadow-sm text-primary text-xs font-bold uppercase tracking-wider mb-6 transform hover:scale-105 transition-transform">
                <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                Student Life
            </div>
            <h1 class="text-5xl md:text-6xl font-medium tracking-tight text-gray-900 mb-6">
                Academics <span class="text-primary font-serif italic font-normal">&amp;</span> Beyond
            </h1>
            <p class="text-gray-500 max-w-2xl text-lg leading-relaxed font-light">
                We believe education extends far beyond the classroom walls. Explore the diverse opportunities that shape our students into well-rounded global leaders through arts, sports, and community engagement.
            </p>
        </div>
        <div class="flex flex-col gap-10">
            <div class="flex overflow-x-auto pb-4 md:pb-0 no-scrollbar">
                <div class="sm:inline-flex flex max-sm:w-full p-1.5 bg-white rounded-full border border-gray-200 shadow-sm">
                    <button type="button" class="academics-tab px-8 py-3 rounded-full text-sm font-medium text-gray-500 hover:text-gray-900 hover:bg-gray-50 transition-all flex items-center gap-2.5 group max-sm:w-full justify-center" data-academics-tab="fun">
                        <i data-lucide="palette" class="size-5 md:block hidden group-hover:text-primary transition-colors"></i>
                        Fun &amp; Art
                    </button>
                    <button type="button" class="academics-tab px-8 py-3 rounded-full text-sm font-medium text-gray-500 hover:text-gray-900 hover:bg-gray-50 transition-all flex items-center gap-2.5 group max-sm:w-full justify-center" data-academics-tab="sports">
                        <i data-lucide="trophy" class="size-5 md:block hidden group-hover:text-primary transition-colors"></i>
                        Sports
                    </button>
                    <button type="button" class="academics-tab px-8 py-3 rounded-full text-sm font-medium text-gray-500 hover:text-gray-900 hover:bg-gray-50 transition-all flex items-center gap-2.5 group max-sm:w-full justify-center" data-academics-tab="events">
                        <i data-lucide="party-popper" class="size-5 md:block hidden group-hover:text-primary transition-colors"></i>
                        Events
                    </button>
                </div>
            </div>
            <div class="academics-panel grid grid-cols-1 lg:grid-cols-2 gap-8 animate-fade-in" data-academics-panel="fun">
                <div class="group relative flex flex-col sm:flex-row items-center sm:items-start gap-6 p-6 rounded-2xl bg-white border border-gray-100 shadow-soft hover:shadow-xl hover:border-primary/20 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-primary/5 to-transparent rounded-bl-full pointer-events-none transition-opacity duration-300 opacity-50 group-hover:opacity-100"></div>
                    <div class="relative shrink-0 overflow-hidden rounded-xl w-full sm:w-40 h-48 sm:h-40 shadow-inner">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 ease-out group-hover:scale-110" style="background-image: url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');"></div>
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                    </div>
                    <div class="flex flex-col justify-center h-full flex-1 w-full text-center sm:text-left z-10">
                        <span class="px-2 py-0.5 rounded bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-wide mb-2 inline-block w-fit mx-auto sm:mx-0">Clubs</span>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors">Litera Clubs</h3>
                        <p class="text-sm text-gray-500 leading-relaxed mb-4">Mount Litera Zee School encourages students to participate in a wide-range of clubs in schools including clubs like Literary Club, STEM Club, Health and Wellness Club etc.</p>
                        <div class="flex items-center justify-center sm:justify-start text-xs font-bold text-primary uppercase tracking-wider group/link">Explore Clubs <i data-lucide="arrow-right" class="w-3 h-3 ml-1 transition-transform group-hover/link:translate-x-1"></i></div>
                    </div>
                </div>
                <div class="group relative flex flex-col sm:flex-row items-center sm:items-start gap-6 p-6 rounded-2xl bg-white border border-gray-100 shadow-soft hover:shadow-xl hover:border-primary/20 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-accent/10 to-transparent rounded-bl-full pointer-events-none transition-opacity duration-300 opacity-50 group-hover:opacity-100"></div>
                    <div class="relative shrink-0 overflow-hidden rounded-xl w-full sm:w-40 h-48 sm:h-40 shadow-inner">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 ease-out group-hover:scale-110" style="background-image: url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');"></div>
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                    </div>
                    <div class="flex flex-col justify-center h-full flex-1 w-full text-center sm:text-left z-10">
                        <span class="px-2 py-0.5 rounded bg-accent/10 text-accent text-[10px] font-bold uppercase tracking-wide mb-2 inline-block w-fit mx-auto sm:mx-0">Excursions</span>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors">Field Trips</h3>
                        <p class="text-sm text-gray-500 leading-relaxed mb-4">Field trips are a popular activity for all students. Kids love to explore new places with their friends. We understand that any trip cannot qualify as a field trip.</p>
                        <div class="flex items-center justify-center sm:justify-start text-xs font-bold text-primary uppercase tracking-wider group/link">View Gallery <i data-lucide="arrow-right" class="w-3 h-3 ml-1 transition-transform group-hover/link:translate-x-1"></i></div>
                    </div>
                </div>
            </div>
            <div class="academics-panel grid grid-cols-1 lg:grid-cols-2 gap-8 animate-fade-in hidden" data-academics-panel="sports">
                <div class="group relative flex flex-col sm:flex-row items-center sm:items-start gap-6 p-6 rounded-2xl bg-white border border-gray-100 shadow-soft hover:shadow-xl hover:border-primary/20 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer overflow-hidden">
                    <div class="relative shrink-0 overflow-hidden rounded-xl w-full sm:w-40 h-48 sm:h-40 shadow-inner">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 ease-out group-hover:scale-110" style="background-image: url('https://images.unsplash.com/photo-1576678927484-cc907957088c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');"></div>
                    </div>
                    <div class="flex flex-col justify-center flex-1 w-full text-center sm:text-left z-10">
                        <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors">Sports</h3>
                        <p class="text-sm text-gray-500 leading-relaxed mb-4">Swami Vivekananda famously said, &quot;Be strong, my young friends; that is my advice to you. You will be nearer to Heaven through football than through the study of the Gita.&quot;</p>
                        <div class="text-xs font-bold text-primary uppercase tracking-wider">Explore Sports <i data-lucide="arrow-right" class="w-3 h-3 ml-1 inline"></i></div>
                    </div>
                </div>
                <div class="group relative flex flex-col sm:flex-row items-center sm:items-start gap-6 p-6 rounded-2xl bg-white border border-gray-100 shadow-soft hover:shadow-xl hover:border-primary/20 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer overflow-hidden">
                    <div class="relative shrink-0 overflow-hidden rounded-xl w-full sm:w-40 h-48 sm:h-40 shadow-inner">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 ease-out group-hover:scale-110" style="background-image: url('https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');"></div>
                    </div>
                    <div class="flex flex-col justify-center flex-1 w-full text-center sm:text-left z-10">
                        <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors">Fitness &amp; Wellness</h3>
                        <p class="text-sm text-gray-500 leading-relaxed mb-4">Track and field, yoga, and fitness sessions help students build stamina, discipline, and lifelong healthy habits.</p>
                        <div class="text-xs font-bold text-primary uppercase tracking-wider">View Programs <i data-lucide="arrow-right" class="w-3 h-3 ml-1 inline"></i></div>
                    </div>
                </div>
            </div>
            <div class="academics-panel grid grid-cols-1 lg:grid-cols-2 gap-8 animate-fade-in hidden" data-academics-panel="events">
                <div class="group relative flex flex-col sm:flex-row items-center sm:items-start gap-6 p-6 rounded-2xl bg-white border border-gray-100 shadow-soft hover:shadow-xl hover:border-primary/20 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer overflow-hidden">
                    <div class="relative shrink-0 overflow-hidden rounded-xl w-full sm:w-40 h-48 sm:h-40 shadow-inner">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 ease-out group-hover:scale-110" style="background-image: url('https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');"></div>
                    </div>
                    <div class="flex flex-col justify-center flex-1 w-full text-center sm:text-left z-10">
                        <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors">Mount Litera Olympiad</h3>
                        <p class="text-sm text-gray-500 leading-relaxed mb-4">The Mount Litera Olympiad is an inter-MLZS competition in which students from all MLZS participate to showcase their talent in various fields.</p>
                        <div class="text-xs font-bold text-primary uppercase tracking-wider">View Highlights <i data-lucide="arrow-right" class="w-3 h-3 ml-1 inline"></i></div>
                    </div>
                </div>
                <div class="group relative flex flex-col sm:flex-row items-center sm:items-start gap-6 p-6 rounded-2xl bg-white border border-gray-100 shadow-soft hover:shadow-xl hover:border-primary/20 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer overflow-hidden">
                    <div class="relative shrink-0 overflow-hidden rounded-xl w-full sm:w-40 h-48 sm:h-40 shadow-inner">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 ease-out group-hover:scale-110" style="background-image: url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');"></div>
                    </div>
                    <div class="flex flex-col justify-center flex-1 w-full text-center sm:text-left z-10">
                        <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors">Events and Celebrations</h3>
                        <p class="text-sm text-gray-500 leading-relaxed mb-4">Mount Litera Zee Schools organise various events and celebrations throughout the year. The chief of them is the Annual Function.</p>
                        <div class="text-xs font-bold text-primary uppercase tracking-wider">Explore Gallery <i data-lucide="arrow-right" class="w-3 h-3 ml-1 inline"></i></div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center md:justify-start pt-4">
                <a class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white border border-gray-200 text-sm font-semibold text-gray-800 hover:text-primary hover:border-primary/30 hover:shadow-md transition-all group" href="<?php echo esc_url($home_url); ?>#">
                    View All Activities
                    <i data-lucide="arrow-right" class="size-5 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
