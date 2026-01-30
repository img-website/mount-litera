<?php
/**
 * Template Name: Teacher Training Page
 * Teacher Training: Hero, Workshop 1, Workshop 2, Key Outcomes, CTA. UI matches original HTML (font-size, border-radius, rounded preserved).
 */
if (!defined('ABSPATH')) exit;
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge = $opt ? get_field('teacher_training_hero_badge', $page_id) : null;
$hero_headline = $opt ? get_field('teacher_training_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('teacher_training_hero_highlight', $page_id) : null;
$hero_subtext = $opt ? get_field('teacher_training_hero_subtext', $page_id) : null;
$hero_icon = $opt ? get_field('teacher_training_hero_icon', $page_id) : null;
$hero_icon = ($hero_icon !== '' && $hero_icon !== null) ? sanitize_title((string) $hero_icon) : 'users';
$hero_badge = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Professional Development';
$hero_headline = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'Teacher';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Training';
$hero_subtext = ($hero_subtext !== '' && $hero_subtext !== null) ? (string) $hero_subtext : 'Empowering educators through continuous professional development and training workshops';

// ——— Workshop 1 ———
$w1_title = $opt ? get_field('teacher_training_w1_title', $page_id) : null;
$w1_subtitle = $opt ? get_field('teacher_training_w1_subtitle', $page_id) : null;
$w1_paragraph = $opt ? get_field('teacher_training_w1_paragraph', $page_id) : null;
$w1_highlight = $opt ? get_field('teacher_training_w1_highlight', $page_id) : null;
$w1_image = $opt ? get_field('teacher_training_w1_image', $page_id) : null;
$w1_badge = $opt ? get_field('teacher_training_w1_badge', $page_id) : null;
$w1_sessions = $opt ? get_field('teacher_training_w1_sessions', $page_id) : null;

$w1_icon = $opt ? get_field('teacher_training_w1_icon', $page_id) : null;
$w1_icon = ($w1_icon !== '' && $w1_icon !== null) ? sanitize_title((string) $w1_icon) : 'clipboard-check';
$w1_title = ($w1_title !== '' && $w1_title !== null) ? (string) $w1_title : 'Workshop on "Assessment and Evaluation"';
$w1_subtitle = ($w1_subtitle !== '' && $w1_subtitle !== null) ? (string) $w1_subtitle : 'Professional Development Session';
$w1_paragraph = ($w1_paragraph !== '' && $w1_paragraph !== null) ? (string) $w1_paragraph : 'A workshop on "Assessment and Evaluation" was held where four teachers of MLZS had attended to enhance their understanding of assessment methodologies.';
$w1_highlight = ($w1_highlight !== '' && $w1_highlight !== null) ? (string) $w1_highlight : 'The workshop covered the vision of making an individual a complete personality across various domains (technology, medicare, etc.) of the organization.';
$w1_badge = ($w1_badge !== '' && $w1_badge !== null) ? (string) $w1_badge : '4 Teachers Attended';

$w1_img_url = '';
if (!empty($w1_image) && is_array($w1_image) && !empty($w1_image['url'])) $w1_img_url = $w1_image['url'];
if ($w1_img_url === '') $w1_img_url = 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&q=80';

$default_w1_sessions = array(
    array('number' => '1', 'style' => 'primary', 'title' => 'Introduction Session', 'description' => 'Our Principal explained that in school scenarios, good curriculum standards and performance standards should have 80% planning, 10% implementation, and 10% feedback.'),
    array('number' => '2', 'style' => 'accent', 'title' => 'Cognitive Levels & MCIs', 'description' => 'Presented by Ms. Savita V. Singh, covering different types of test items, various cognitive levels based on revised Bloom\'s Taxonomy, and creating good Multiple Choice Items (MCIs).'),
    array('number' => '3', 'style' => 'primary-light', 'title' => 'MCI Evaluation', 'description' => 'Focused on evaluation of MCIs using standardized measures to ensure quality and effectiveness of assessment tools.'),
);
$w1_sessions = (is_array($w1_sessions) && count($w1_sessions) >= 3) ? $w1_sessions : $default_w1_sessions;

$session_style_classes = array(
    'primary' => 'bg-primary/10 text-primary',
    'accent' => 'bg-accent/10 text-accent',
    'primary-light' => 'bg-primary-light/10 text-primary-light',
);
$session_text_classes = array('primary' => 'text-primary', 'accent' => 'text-accent', 'primary-light' => 'text-primary-light');

// ——— Workshop 2 ———
$w2_title = $opt ? get_field('teacher_training_w2_title', $page_id) : null;
$w2_subtitle = $opt ? get_field('teacher_training_w2_subtitle', $page_id) : null;
$w2_paragraph = $opt ? get_field('teacher_training_w2_paragraph', $page_id) : null;
$w2_highlight = $opt ? get_field('teacher_training_w2_highlight', $page_id) : null;
$w2_image = $opt ? get_field('teacher_training_w2_image', $page_id) : null;
$w2_badge = $opt ? get_field('teacher_training_w2_badge', $page_id) : null;
$w2_focus = $opt ? get_field('teacher_training_w2_focus', $page_id) : null;

$w2_icon = $opt ? get_field('teacher_training_w2_icon', $page_id) : null;
$w2_icon = ($w2_icon !== '' && $w2_icon !== null) ? sanitize_title((string) $w2_icon) : 'bar-chart-3';
$w2_title = ($w2_title !== '' && $w2_title !== null) ? (string) $w2_title : 'Workshop on CCE & Assessment';
$w2_subtitle = ($w2_subtitle !== '' && $w2_subtitle !== null) ? (string) $w2_subtitle : 'Advanced Assessment Techniques';
$w2_paragraph = ($w2_paragraph !== '' && $w2_paragraph !== null) ? (string) $w2_paragraph : 'Five teachers from our school attended the workshop on Continuous and Comprehensive Evaluation (CCE), Assessment, How to frame MCIs, Calculation of p-value, and Findlay\'s Index.';
$w2_highlight = ($w2_highlight !== '' && $w2_highlight !== null) ? (string) $w2_highlight : 'The resource persons emphasized learning objectives and achieving goals in the classroom situation, focusing on practical application of assessment tools.';
$w2_badge = ($w2_badge !== '' && $w2_badge !== null) ? (string) $w2_badge : '5 Teachers Attended';

$w2_img_url = '';
if (!empty($w2_image) && is_array($w2_image) && !empty($w2_image['url'])) $w2_img_url = $w2_image['url'];
if ($w2_img_url === '') $w2_img_url = 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&q=80';

$default_w2_focus = array(
    array('icon' => 'edit', 'style' => 'primary', 'title' => 'MCI Development', 'description' => 'Ms. Alka focused on making MCIs, types of items, test execution, and evaluating student performance levels.'),
    array('icon' => 'calculator', 'style' => 'accent', 'title' => 'Statistical Analysis', 'description' => 'Ms. Sarita V. Singh explained statistical aspects including calculation of p-value and Findlay\'s index for better assessment design.'),
);
$w2_focus = (is_array($w2_focus) && count($w2_focus) >= 2) ? $w2_focus : $default_w2_focus;

$focus_style_classes = array('primary' => 'bg-primary/10 text-primary', 'accent' => 'bg-accent/10 text-accent');
$focus_icon_text = array('primary' => 'text-primary', 'accent' => 'text-accent');

// ——— Key Outcomes ———
$outcomes_heading = $opt ? get_field('teacher_training_outcomes_heading', $page_id) : null;
$outcomes = $opt ? get_field('teacher_training_outcomes', $page_id) : null;
$outcomes_heading = ($outcomes_heading !== '' && $outcomes_heading !== null) ? (string) $outcomes_heading : 'Key Learning Outcomes';

$outcome_icon_styles = array('primary' => 'bg-primary/10 text-primary', 'primary-light' => 'bg-primary-light/10 text-primary-light', 'accent' => 'bg-accent/10 text-accent', 'accent-light' => 'bg-accent-light/10 text-accent-light');
$default_outcomes = array(
    array('icon' => 'target', 'icon_style' => 'primary', 'title' => 'Better Planning', 'description' => '80-10-10 principle for curriculum standards'),
    array('icon' => 'brain', 'icon_style' => 'primary-light', 'title' => 'Cognitive Levels', 'description' => 'Understanding Bloom\'s Taxonomy applications'),
    array('icon' => 'file-check', 'icon_style' => 'accent', 'title' => 'MCI Excellence', 'description' => 'Creating effective multiple choice items'),
    array('icon' => 'trending-up', 'icon_style' => 'accent-light', 'title' => 'Statistical Tools', 'description' => 'p-value and Findlay\'s Index calculations'),
);
$outcomes = (is_array($outcomes) && count($outcomes) >= 4) ? $outcomes : $default_outcomes;

// ——— CTA ———
$cta_heading = $opt ? get_field('teacher_training_cta_heading', $page_id) : null;
$cta_paragraph = $opt ? get_field('teacher_training_cta_paragraph', $page_id) : null;
$cta_btn1 = $opt ? get_field('teacher_training_cta_btn1', $page_id) : null;
$cta_btn2 = $opt ? get_field('teacher_training_cta_btn2', $page_id) : null;
$cta_stats = $opt ? get_field('teacher_training_cta_stats', $page_id) : null;

$cta_heading = ($cta_heading !== '' && $cta_heading !== null) ? (string) $cta_heading : 'Continuous Professional Development';
$cta_paragraph = ($cta_paragraph !== '' && $cta_paragraph !== null) ? (string) $cta_paragraph : 'Our teachers undergo regular training and workshops to stay updated with the latest educational methodologies and assessment techniques.';

$cta_btn1_icon = $opt ? get_field('teacher_training_cta_btn1_icon', $page_id) : null;
$cta_btn2_icon = $opt ? get_field('teacher_training_cta_btn2_icon', $page_id) : null;
$cta_btn1_icon = ($cta_btn1_icon !== '' && $cta_btn1_icon !== null) ? sanitize_title((string) $cta_btn1_icon) : 'calendar';
$cta_btn2_icon = ($cta_btn2_icon !== '' && $cta_btn2_icon !== null) ? sanitize_title((string) $cta_btn2_icon) : 'book-open';
$cta_btn1_url = $cta_btn1_title = '#';
if (!empty($cta_btn1) && is_array($cta_btn1)) {
    $cta_btn1_url = isset($cta_btn1['url']) ? $cta_btn1['url'] : '#';
    $cta_btn1_title = isset($cta_btn1['title']) && trim($cta_btn1['title']) !== '' ? $cta_btn1['title'] : 'View Workshop Schedule';
} else { $cta_btn1_title = 'Training Schedule'; }
$cta_btn2_url = $cta_btn2_title = '#';
if (!empty($cta_btn2) && is_array($cta_btn2)) {
    $cta_btn2_url = isset($cta_btn2['url']) ? $cta_btn2['url'] : '#';
    $cta_btn2_title = isset($cta_btn2['title']) && trim($cta_btn2['title']) !== '' ? $cta_btn2['title'] : 'Resources';
} else { $cta_btn2_title = 'Resources'; }

$default_cta_stats = array(
    array('number' => '9', 'label' => 'Teachers Trained'),
    array('number' => '2', 'label' => 'Workshops'),
    array('number' => 'Expert', 'label' => 'Trainers'),
    array('number' => 'CCE', 'label' => 'Focused'),
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
                    <?php echo esc_html($hero_subtext); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Content Section (UI exactly as teacher_training.html) -->
    <section class="px-4 sm:px-6 lg:px-8 py-8 sm:py-12 md:py-16">
        <div class="max-w-7xl mx-auto">
            <!-- Workshop 1: Assessment and Evaluation -->
            <div class="mb-8 sm:mb-12">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8 items-start">
                    <!-- Content -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-xl sm:rounded-2xl p-6 shadow-soft border border-border-light">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center">
                                    <i data-lucide="<?php echo esc_attr($w1_icon); ?>" class="w-6 h-6 text-primary"></i>
                                </div>
                                <div>
                                    <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-text-main-light">
                                        <?php echo esc_html($w1_title); ?>
                                    </h2>
                                    <p class="text-sm text-text-secondary-light"><?php echo esc_html($w1_subtitle); ?></p>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <p class="text-sm text-text-secondary-light leading-relaxed">
                                    <?php echo esc_html($w1_paragraph); ?>
                                </p>
                                <div class="bg-gradient-to-r from-primary/5 to-primary-light/5 rounded-lg p-4 border border-primary/20">
                                    <p class="text-sm sm:text-base text-text-secondary-light">
                                        <?php echo esc_html($w1_highlight); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Session Details -->
                        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
                            <?php foreach ($w1_sessions as $s) :
                                $s_num = isset($s['number']) ? (string) $s['number'] : '';
                                $s_style = isset($s['style']) && isset($session_style_classes[$s['style']]) ? $session_style_classes[$s['style']] : $session_style_classes['primary'];
                                $s_title = isset($s['title']) ? (string) $s['title'] : '';
                                $s_desc = isset($s['description']) ? (string) $s['description'] : '';
                            ?>
                            <div class="bg-white rounded-xl p-4 shadow-sm border border-border-light">
                                <div class="flex items-center gap-2 mb-3">
                                    <?php $s_txt = isset($s['style']) && isset($session_text_classes[$s['style']]) ? $session_text_classes[$s['style']] : 'text-primary'; ?>
                                    <div class="w-8 h-8 rounded-full <?php echo esc_attr($s_style); ?> flex items-center justify-center">
                                        <span class="text-xs font-bold <?php echo esc_attr($s_txt); ?>"><?php echo esc_html($s_num); ?></span>
                                    </div>
                                    <h4 class="font-bold text-text-main-light"><?php echo esc_html($s_title); ?></h4>
                                </div>
                                <p class="text-xs sm:text-sm text-text-secondary-light">
                                    <?php echo esc_html($s_desc); ?>
                                </p>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- Image -->
                    <div class="relative">
                        <div class="group overflow-hidden rounded-xl sm:rounded-2xl shadow-soft border border-border-light">
                            <div class="aspect-square bg-gray-100 overflow-hidden relative">
                                <img src="<?php echo esc_url($w1_img_url); ?>" alt="<?php echo esc_attr($w1_title); ?>" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-br from-primary/20 to-primary-light/20"></div>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <div class="text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                    <h4 class="font-bold text-sm"><?php echo esc_html($w1_title); ?></h4>
                                    <p class="text-xs opacity-90"><?php echo esc_html($w1_subtitle); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-medium">
                                <i data-lucide="users" class="w-3 h-3"></i>
                                <span><?php echo esc_html($w1_badge); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Workshop 2: CCE and Assessment -->
            <div class="mb-8 sm:mb-12">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8 items-start">
                    <!-- Content -->
                    <div class="lg:col-span-2 order-1 lg:order-2">
                        <div class="bg-white rounded-xl sm:rounded-2xl p-6 shadow-soft border border-border-light">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-12 h-12 rounded-lg bg-accent/10 flex items-center justify-center">
                                    <i data-lucide="<?php echo esc_attr($w2_icon); ?>" class="w-6 h-6 text-accent"></i>
                                </div>
                                <div>
                                    <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-text-main-light">
                                        <?php echo esc_html($w2_title); ?>
                                    </h2>
                                    <p class="text-sm text-text-secondary-light"><?php echo esc_html($w2_subtitle); ?></p>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <p class="text-sm text-text-secondary-light leading-relaxed">
                                    <?php echo esc_html($w2_paragraph); ?>
                                </p>
                                <div class="bg-gradient-to-r from-accent/5 to-accent-light/5 rounded-lg p-4 border border-accent/20">
                                    <p class="text-sm sm:text-base text-text-secondary-light">
                                        <?php echo esc_html($w2_highlight); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Workshop Focus Areas -->
                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                            <?php foreach ($w2_focus as $f) :
                                $f_icon = isset($f['icon']) && trim($f['icon']) !== '' ? trim($f['icon']) : 'edit';
                                $f_style = isset($f['style']) && isset($focus_style_classes[$f['style']]) ? $focus_style_classes[$f['style']] : $focus_style_classes['primary'];
                                $f_title = isset($f['title']) ? (string) $f['title'] : '';
                                $f_desc = isset($f['description']) ? (string) $f['description'] : '';
                            ?>
                            <div class="bg-white rounded-xl p-4 shadow-sm border border-border-light">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-8 h-8 rounded-lg <?php echo esc_attr($f_style); ?> flex items-center justify-center">
                                        <i data-lucide="<?php echo esc_attr($f_icon); ?>" class="w-4 h-4 text-primary"></i>
                                    </div>
                                    <h4 class="font-bold text-text-main-light"><?php echo esc_html($f_title); ?></h4>
                                </div>
                                <p class="text-xs sm:text-sm text-text-secondary-light">
                                    <?php echo esc_html($f_desc); ?>
                                </p>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- Image -->
                    <div class="relative order-2 lg:order-1">
                        <div class="group overflow-hidden rounded-xl sm:rounded-2xl shadow-soft border border-border-light">
                            <div class="aspect-square bg-gray-100 overflow-hidden relative">
                                <img src="<?php echo esc_url($w2_img_url); ?>" alt="<?php echo esc_attr($w2_title); ?>" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-br from-accent/20 to-accent-dark/20"></div>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <div class="text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                    <h4 class="font-bold text-sm"><?php echo esc_html($w2_title); ?></h4>
                                    <p class="text-xs opacity-90"><?php echo esc_html($w2_subtitle); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-accent/10 text-accent-dark text-xs font-medium">
                                <i data-lucide="users" class="w-3 h-3"></i>
                                <span><?php echo esc_html($w2_badge); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Key Learning Outcomes -->
            <div class="mb-8 sm:mb-12">
                <div class="bg-gradient-to-r from-primary/5 to-accent/5 rounded-xl sm:rounded-2xl p-6 sm:p-8 border border-primary/20">
                    <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-text-main-light mb-6 text-center">
                        <?php echo esc_html($outcomes_heading); ?>
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                        <?php foreach ($outcomes as $o) :
                            $o_icon = isset($o['icon']) && trim($o['icon']) !== '' ? trim($o['icon']) : 'target';
                            $o_style_key = isset($o['icon_style']) && trim($o['icon_style']) !== '' ? $o['icon_style'] : 'primary';
                            $o_style = isset($outcome_icon_styles[$o_style_key]) ? $outcome_icon_styles[$o_style_key] : $outcome_icon_styles['primary'];
                            $o_title = isset($o['title']) ? (string) $o['title'] : '';
                            $o_desc = isset($o['description']) ? (string) $o['description'] : '';
                        ?>
                        <div class="bg-white rounded-xl p-4 text-center shadow-sm border border-border-light">
                            <?php $o_icon_clr = isset($outcome_icon_text[$o_style_key]) ? $outcome_icon_text[$o_style_key] : 'text-primary'; ?>
                            <div class="w-10 h-10 rounded-full <?php echo esc_attr($o_style); ?> flex items-center justify-center mx-auto mb-3">
                                <i data-lucide="<?php echo esc_attr($o_icon); ?>" class="w-5 h-5 <?php echo esc_attr($o_icon_clr); ?>"></i>
                            </div>
                            <h4 class="font-bold text-text-main-light mb-2"><?php echo esc_html($o_title); ?></h4>
                            <p class="text-xs text-text-secondary-light"><?php echo esc_html($o_desc); ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="bg-gradient-to-r from-primary to-primary-light rounded-xl sm:rounded-2xl p-6 sm:p-8 text-white">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-center">
                    <div>
                        <h3 class="text-lg sm:text-xl font-bold mb-4"><?php echo esc_html($cta_heading); ?></h3>
                        <p class="text-sm text-white/80 mb-6">
                            <?php echo esc_html($cta_paragraph); ?>
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="<?php echo esc_url($cta_btn1_url); ?>" class="px-4 py-2 sm:px-6 sm:py-3 bg-white text-primary rounded-full font-bold hover:bg-white/90 transition-all flex items-center justify-center gap-2 group text-sm">
                                <i data-lucide="<?php echo esc_attr($cta_btn1_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                                <?php echo esc_html($cta_btn1_title); ?>
                            </a>
                            <a href="<?php echo esc_url($cta_btn2_url); ?>" class="px-4 py-2 sm:px-6 sm:py-3 bg-white/20 border border-white/30 text-white rounded-full font-bold hover:bg-white/30 transition-all flex items-center justify-center gap-2 group text-sm">
                                <i data-lucide="<?php echo esc_attr($cta_btn2_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                                <?php echo esc_html($cta_btn2_title); ?>
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <?php foreach ($cta_stats as $s) :
                            $s_num = isset($s['number']) ? (string) $s['number'] : '';
                            $s_lab = isset($s['label']) ? (string) $s['label'] : '';
                        ?>
                        <div class="bg-white/10 rounded-xl p-4 text-center border border-white/20">
                            <div class="text-base sm:text-lg font-bold mb-2"><?php echo esc_html($s_num); ?></div>
                            <div class="text-xs font-medium text-white/80"><?php echo esc_html($s_lab); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
