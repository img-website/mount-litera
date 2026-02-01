<?php
/**
 * Template Name: Core Values Page
 * Our Core Values: Hero, WRFC Mantra, Core Values Table, Values in Action, CTA. UI matches value.html.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// Icon color/style mapping
$value_styles = array(
    'primary' => array('bg' => 'bg-[#3D348B]/10', 'icon' => 'text-[#3D348B]', 'hover_bg' => 'group-hover:bg-[#3D348B]', 'hover_icon' => 'group-hover:text-white'),
    'primary-light' => array('bg' => 'bg-[#7678ED]/10', 'icon' => 'text-[#7678ED]', 'hover_bg' => 'group-hover:bg-[#7678ED]', 'hover_icon' => 'group-hover:text-white'),
    'accent' => array('bg' => 'bg-[#F7B801]/10', 'icon' => 'text-[#F7B801]', 'hover_bg' => 'group-hover:bg-[#F7B801]', 'hover_icon' => 'group-hover:text-white'),
    'accent-dark' => array('bg' => 'bg-[#F18701]/10', 'icon' => 'text-[#F18701]', 'hover_bg' => 'group-hover:bg-[#F18701]', 'hover_icon' => 'group-hover:text-white'),
);

// Card gradient styles for Values in Action
$card_gradients = array(
    'primary' => 'from-[#3D348B] to-[#7678ED]',
    'accent' => 'from-[#F7B801] to-[#F18701]',
    'primary-light' => 'from-[#7678ED] to-[#3D348B]',
);

// ——— Hero ———
$hero_badge = $opt ? get_field('value_hero_badge', $page_id) : null;
$hero_before = $opt ? get_field('value_hero_headline_before', $page_id) : null;
$hero_highlight = $opt ? get_field('value_hero_headline_highlight', $page_id) : null;
$hero_subtext = $opt ? get_field('value_hero_subtext', $page_id) : null;
$hero_bg = $opt ? get_field('value_hero_bg_image', $page_id) : null;

$hero_badge = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Foundation of Leadership';
$hero_before = ($hero_before !== '' && $hero_before !== null) ? (string) $hero_before : 'Our';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Core Values';
$hero_subtext = ($hero_subtext !== '' && $hero_subtext !== null) ? (string) $hero_subtext : "What's Right For the Child (WRFC) - Our guiding mantra that filters all our decisions and actions";
$hero_bg_url = (is_array($hero_bg) && !empty($hero_bg['url'])) ? $hero_bg['url'] : 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80';

// ——— WRFC Mantra ———
$wrfc_main_img = $opt ? get_field('value_wrfc_main_image', $page_id) : null;
$wrfc_overlay_img = $opt ? get_field('value_wrfc_overlay_image', $page_id) : null;
$wrfc_icon = $opt ? get_field('value_wrfc_icon', $page_id) : null;
$wrfc_badge = $opt ? get_field('value_wrfc_badge', $page_id) : null;
$wrfc_heading = $opt ? get_field('value_wrfc_heading', $page_id) : null;
$wrfc_para1 = $opt ? get_field('value_wrfc_para1', $page_id) : null;
$wrfc_para2 = $opt ? get_field('value_wrfc_para2', $page_id) : null;
$wrfc_philo_heading = $opt ? get_field('value_wrfc_philo_heading', $page_id) : null;
$wrfc_philo_icon = $opt ? get_field('value_wrfc_philo_icon', $page_id) : null;
$wrfc_philo_points = $opt ? get_field('value_wrfc_philo_points', $page_id) : null;

$wrfc_main_url = (is_array($wrfc_main_img) && !empty($wrfc_main_img['url'])) ? $wrfc_main_img['url'] : 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80';
$wrfc_overlay_url = (is_array($wrfc_overlay_img) && !empty($wrfc_overlay_img['url'])) ? $wrfc_overlay_img['url'] : $wrfc_main_url;
$wrfc_icon = ($wrfc_icon !== '' && $wrfc_icon !== null) ? trim((string) $wrfc_icon) : 'heart';
$wrfc_badge = ($wrfc_badge !== '' && $wrfc_badge !== null) ? (string) $wrfc_badge : 'Our Mantra';
$wrfc_heading = ($wrfc_heading !== '' && $wrfc_heading !== null) ? (string) $wrfc_heading : "What's Right For the Child (WRFC)";
$wrfc_para1 = ($wrfc_para1 !== '' && $wrfc_para1 !== null) ? (string) $wrfc_para1 : 'At the core of everything we do at Mount Litera Zee School is one simple question: What\'s Right For the Child (WRFC) - this is the mantra through which we filter all our decisions and actions.';
$wrfc_para2 = ($wrfc_para2 !== '' && $wrfc_para2 !== null) ? (string) $wrfc_para2 : 'WRFC helps us keep the child at the centre of everything that we do and ensures single minded devotion to her growth and development.';
$wrfc_philo_heading = ($wrfc_philo_heading !== '' && $wrfc_philo_heading !== null) ? (string) $wrfc_philo_heading : 'The WRFC Philosophy';
$wrfc_philo_icon = ($wrfc_philo_icon !== '' && $wrfc_philo_icon !== null) ? trim((string) $wrfc_philo_icon) : 'star';
$default_philo = array(array('text' => 'Filters every decision we make'), array('text' => 'Keeps the child at the center of all actions'), array('text' => 'Ensures devotion to growth and development'));
$wrfc_philo_points = (is_array($wrfc_philo_points) && !empty($wrfc_philo_points)) ? $wrfc_philo_points : $default_philo;

// ——— Core Values Table ———
$table_badge = $opt ? get_field('value_table_badge', $page_id) : null;
$table_icon = $opt ? get_field('value_table_icon', $page_id) : null;
$table_heading = $opt ? get_field('value_table_heading', $page_id) : null;
$table_subtext = $opt ? get_field('value_table_subtext', $page_id) : null;
$table_col1_title = $opt ? get_field('value_table_col1_title', $page_id) : null;
$table_col1_sub = $opt ? get_field('value_table_col1_sub', $page_id) : null;
$table_col2_title = $opt ? get_field('value_table_col2_title', $page_id) : null;
$table_col2_sub = $opt ? get_field('value_table_col2_sub', $page_id) : null;
$values_rows = $opt ? get_field('value_table_rows', $page_id) : null;

$table_badge = ($table_badge !== '' && $table_badge !== null) ? (string) $table_badge : 'Foundation of Leadership';
$table_icon = ($table_icon !== '' && $table_icon !== null) ? trim((string) $table_icon) : 'shield';
$table_heading_before = $opt ? get_field('value_table_heading_before', $page_id) : null;
$table_heading_highlight = $opt ? get_field('value_table_heading_highlight', $page_id) : null;
$table_heading_before = ($table_heading_before !== '' && $table_heading_before !== null) ? (string) $table_heading_before : 'Core Values That';
$table_heading_highlight = ($table_heading_highlight !== '' && $table_heading_highlight !== null) ? (string) $table_heading_highlight : 'Shape Leaders';
$table_subtext = ($table_subtext !== '' && $table_subtext !== null) ? (string) $table_subtext : 'Our students role model these values, building the foundation for true leadership';
$table_col1_title = ($table_col1_title !== '' && $table_col1_title !== null) ? (string) $table_col1_title : 'Core Value';
$table_col1_sub = ($table_col1_sub !== '' && $table_col1_sub !== null) ? (string) $table_col1_sub : 'The principle we uphold';
$table_col2_title = ($table_col2_title !== '' && $table_col2_title !== null) ? (string) $table_col2_title : 'Definition';
$table_col2_sub = ($table_col2_sub !== '' && $table_col2_sub !== null) ? (string) $table_col2_sub : 'How we live this value';
$default_values = array(
    array('icon' => 'shield-check', 'style' => 'primary', 'title' => 'Integrity', 'subtitle' => 'Moral and ethical strength', 'definition' => 'Honouring your word'),
    array('icon' => 'brain', 'style' => 'primary-light', 'title' => 'Open Mindedness', 'subtitle' => 'Willingness to consider new ideas', 'definition' => 'Be flexible and adaptive to new experiences and ideas'),
    array('icon' => 'user-check', 'style' => 'accent', 'title' => 'Authenticity', 'subtitle' => 'Being true to oneself', 'definition' => 'Alignment between who you say you are and who you actually are being'),
    array('icon' => 'smile', 'style' => 'accent-dark', 'title' => 'Humility', 'subtitle' => 'Modest view of one\'s importance', 'definition' => 'Ability to laugh at oneself'),
    array('icon' => 'trending-up', 'style' => 'primary', 'title' => 'Growth Mindset', 'subtitle' => 'Belief in development and improvement', 'definition' => 'Belief that their intelligence can be developed over time through their own effort'),
    array('icon' => 'heart', 'style' => 'primary-light', 'title' => 'Compassion', 'subtitle' => 'Sympathetic concern for others', 'definition' => 'Being sensitive and caring towards the needs of others'),
);
$values_rows = (is_array($values_rows) && !empty($values_rows)) ? $values_rows : $default_values;

// ——— Values in Action ———
$action_badge = $opt ? get_field('value_action_badge', $page_id) : null;
$action_icon = $opt ? get_field('value_action_icon', $page_id) : null;
$action_heading = $opt ? get_field('value_action_heading', $page_id) : null;
$action_subtext = $opt ? get_field('value_action_subtext', $page_id) : null;
$action_cards = $opt ? get_field('value_action_cards', $page_id) : null;

$action_badge = ($action_badge !== '' && $action_badge !== null) ? (string) $action_badge : 'Values in Action';
$action_icon = ($action_icon !== '' && $action_icon !== null) ? trim((string) $action_icon) : 'zap';
$action_heading_before = $opt ? get_field('value_action_heading_before', $page_id) : null;
$action_heading_highlight = $opt ? get_field('value_action_heading_highlight', $page_id) : null;
$action_heading_after = $opt ? get_field('value_action_heading_after', $page_id) : null;
$action_heading_before = ($action_heading_before !== '' && $action_heading_before !== null) ? (string) $action_heading_before : 'Living Our';
$action_heading_highlight = ($action_heading_highlight !== '' && $action_heading_highlight !== null) ? (string) $action_heading_highlight : 'Values';
$action_heading_after = ($action_heading_after !== '' && $action_heading_after !== null) ? (string) $action_heading_after : 'Daily';
$action_heading = ($action_heading !== '' && $action_heading !== null) ? (string) $action_heading : '';
$action_subtext = ($action_subtext !== '' && $action_subtext !== null) ? (string) $action_subtext : 'How our core values translate into everyday actions and decisions at Mount Litera Zee School';
$default_action = array(
    array('icon' => 'users', 'style' => 'primary', 'title' => 'Student-Centered', 'paragraph' => 'Every decision, from curriculum design to extracurricular activities, is filtered through the WRFC lens, ensuring the child remains at the center.'),
    array('icon' => 'award', 'style' => 'accent', 'title' => 'Role Modeling', 'paragraph' => 'Teachers and staff embody these values, providing living examples for students to observe, learn from, and emulate in their own lives.'),
    array('icon' => 'sparkles', 'style' => 'primary-light', 'title' => 'Holistic Development', 'paragraph' => 'Beyond academics, we focus on character building, emotional intelligence, and social responsibility, nurturing well-rounded individuals.'),
);
$action_cards = (is_array($action_cards) && !empty($action_cards)) ? $action_cards : $default_action;

// ——— CTA ———
$cta_heading = $opt ? get_field('value_cta_heading', $page_id) : null;
$cta_paragraph = $opt ? get_field('value_cta_paragraph', $page_id) : null;
$cta_btn1 = $opt ? get_field('value_cta_btn1', $page_id) : null;
$cta_btn2 = $opt ? get_field('value_cta_btn2', $page_id) : null;
$cta_stats = $opt ? get_field('value_cta_stats', $page_id) : null;

$cta_heading = ($cta_heading !== '' && $cta_heading !== null) ? (string) $cta_heading : 'Experience Our Values';
$cta_paragraph = ($cta_paragraph !== '' && $cta_paragraph !== null) ? (string) $cta_paragraph : 'At Mount Litera Zee School, our core values are not just words on a page - they are lived experiences that shape every aspect of our educational environment. Join us in nurturing the next generation of values-driven leaders.';
$default_stats = array(
    array('number' => 'WRFC', 'label' => 'Guiding Principle', 'style' => 'primary'),
    array('number' => '6', 'label' => 'Core Values', 'style' => 'accent'),
    array('number' => 'Daily', 'label' => 'Practice', 'style' => 'primary-light'),
    array('number' => '100%', 'label' => 'Commitment', 'style' => 'accent-dark'),
);
$cta_stats = (is_array($cta_stats) && !empty($cta_stats)) ? $cta_stats : $default_stats;
$stat_colors = array('primary' => 'text-[#3D348B]', 'accent' => 'text-[#F7B801]', 'primary-light' => 'text-[#7678ED]', 'accent-dark' => 'text-[#F18701]');
?>

    <!-- Hero Section -->
    <section class="relative min-h-[70vh] flex items-center justify-center px-4 sm:px-6 lg:px-8 bg-cover bg-center bg-fixed" style="background-image: linear-gradient(135deg, rgba(61,52,139,0.9) 0%, rgba(118,120,237,0.8) 50%, rgba(247,184,1,0.7) 100%), url('<?php echo esc_url($hero_bg_url); ?>');">
        <div class="absolute inset-0 bg-gradient-to-b from-[#3D348B]/90 via-[#3D348B]/70 to-[#3D348B]/50"></div>
        <div class="relative z-10 w-full max-w-7xl mx-auto text-center pt-28 sm:pt-32 pb-16">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/20 backdrop-blur-md border border-white/30 mb-6">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-accent"></span>
                </span>
                <span class="text-xs font-semibold text-white uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
            </div>
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-[1.1] tracking-tight mb-6 max-w-5xl mx-auto drop-shadow-lg">
                <?php echo esc_html($hero_before); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame via-tiger-orange to-cayenne-red"><?php echo esc_html($hero_highlight); ?></span>
            </h1>
            <p class="text-lg md:text-xl text-slate-200 mb-8 max-w-3xl mx-auto leading-relaxed font-light opacity-95">
                <?php echo esc_html($hero_subtext); ?>
            </p>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-background-light to-transparent"></div>
    </section>

    <!-- WRFC Mantra Section -->
    <section class="relative px-4 sm:px-6 lg:px-8 py-16 md:py-24 bg-background-light">
        <div class="absolute top-0 left-0 -z-10 h-full w-full overflow-hidden">
            <div class="absolute -top-40 -right-40 h-[500px] w-[500px] rounded-full bg-primary/5 blur-[100px]"></div>
            <div class="absolute top-1/2 -left-20 h-[300px] w-[300px] rounded-full bg-accent/10 blur-[80px]"></div>
        </div>
        <div class="mx-auto max-w-7xl w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <div class="relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                        <img src="<?php echo esc_url($wrfc_main_url); ?>" alt="Children at Mount Litera Zee School" class="w-full h-[500px] object-cover" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-tr from-primary/60 to-transparent"></div>
                    </div>
                    <div class="absolute -bottom-6 -left-6 w-48 h-48 rounded-3xl overflow-hidden border-4 border-white shadow-2xl">
                        <img src="<?php echo esc_url($wrfc_overlay_url); ?>" alt="Student Learning" class="w-full h-full object-cover" loading="lazy">
                    </div>
                </div>
                <div class="flex flex-col gap-8">
                    <div class="flex flex-col gap-6">
                        <div class="flex items-center gap-3">
                            <div class="p-3 rounded-xl bg-gradient-to-br from-accent to-accent-dark">
                                <i data-lucide="<?php echo esc_attr($wrfc_icon); ?>" class="w-8 h-8 text-white"></i>
                            </div>
                            <span class="rounded-full bg-accent/10 px-3 py-1 text-xs font-bold uppercase tracking-wider text-accent ring-1 ring-accent/20"><?php echo esc_html($wrfc_badge); ?></span>
                        </div>
                        <h2 class="font-display text-4xl font-bold tracking-tight text-text-main-light sm:text-5xl lg:text-6xl">
                            <?php echo esc_html($wrfc_heading); ?>
                        </h2>
                        <div class="space-y-4 text-lg leading-relaxed text-text-secondary-light">
                            <p><?php echo nl2br(esc_html($wrfc_para1)); ?></p>
                            <p><?php echo nl2br(esc_html($wrfc_para2)); ?></p>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-primary/10 to-accent/10 rounded-2xl p-8 border border-primary/20">
                        <div class="flex items-center gap-3 mb-6">
                            <i data-lucide="<?php echo esc_attr($wrfc_philo_icon); ?>" class="w-6 h-6 text-accent"></i>
                            <h3 class="text-2xl font-bold text-text-main-light"><?php echo esc_html($wrfc_philo_heading); ?></h3>
                        </div>
                        <div class="space-y-4 text-text-secondary-light">
                            <?php foreach ($wrfc_philo_points as $pt) :
                                $pt_text = is_array($pt) && isset($pt['text']) ? (string) $pt['text'] : (is_string($pt) ? $pt : '');
                                if ($pt_text === '') continue;
                            ?>
                            <div class="flex items-start gap-3">
                                <i data-lucide="check" class="w-5 h-5 text-accent mt-1 flex-shrink-0"></i>
                                <p><?php echo esc_html($pt_text); ?></p>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values Table Section -->
    <section class="relative px-4 sm:px-6 lg:px-8 py-16 md:py-24 bg-white overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-accent/5 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="mx-auto max-w-7xl w-full relative">
            <div class="text-center mb-16">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <div class="p-2 rounded-lg bg-primary/10">
                        <i data-lucide="<?php echo esc_attr($table_icon); ?>" class="w-6 h-6 text-primary"></i>
                    </div>
                    <span class="rounded-full bg-primary/10 px-3 py-1 text-xs font-bold uppercase tracking-wider text-primary ring-1 ring-primary/20"><?php echo esc_html($table_badge); ?></span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-text-main-light mb-6"><?php echo esc_html($table_heading_before); ?> <span class="bg-gradient-to-r from-primary via-primary-light to-accent bg-clip-text text-transparent"><?php echo esc_html($table_heading_highlight); ?></span></h2>
                <p class="text-lg text-text-secondary-light max-w-3xl mx-auto"><?php echo esc_html($table_subtext); ?></p>
            </div>
            <div class="bg-white rounded-3xl overflow-hidden shadow-xl border border-border-light">
                <div class="bg-gradient-to-r from-primary to-primary-light p-6 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="text-center md:text-left">
                            <h3 class="text-2xl font-bold text-white"><?php echo esc_html($table_col1_title); ?></h3>
                            <p class="text-sm text-white/80 mt-1"><?php echo esc_html($table_col1_sub); ?></p>
                        </div>
                        <div class="text-center md:text-left">
                            <h3 class="text-2xl font-bold text-white"><?php echo esc_html($table_col2_title); ?></h3>
                            <p class="text-sm text-white/80 mt-1"><?php echo esc_html($table_col2_sub); ?></p>
                        </div>
                    </div>
                </div>
                <div class="divide-y divide-border-light">
                    <?php foreach ($values_rows as $row) :
                        $r_style = isset($row['style']) ? (string) $row['style'] : 'primary';
                        $rs = isset($value_styles[$r_style]) ? $value_styles[$r_style] : $value_styles['primary'];
                    ?>
                    <div class="group hover:bg-background-light transition-colors duration-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6 md:p-8">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl <?php echo esc_attr($rs['bg']); ?> flex items-center justify-center <?php echo esc_attr($rs['hover_bg']); ?> transition-colors">
                                    <i data-lucide="<?php echo esc_attr($row['icon'] ?? 'shield-check'); ?>" class="w-6 h-6 <?php echo esc_attr($rs['icon']); ?> <?php echo esc_attr($rs['hover_icon']); ?> transition-colors"></i>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-text-main-light"><?php echo esc_html($row['title'] ?? ''); ?></h4>
                                    <p class="text-sm text-slate-500"><?php echo esc_html($row['subtitle'] ?? ''); ?></p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <p class="text-lg text-text-secondary-light leading-relaxed"><?php echo esc_html($row['definition'] ?? ''); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Values in Action Section -->
    <section class="relative px-4 sm:px-6 lg:px-8 py-16 md:py-24 bg-gradient-to-b from-white to-background-light overflow-hidden">
        <div class="mx-auto max-w-7xl w-full">
            <div class="text-center mb-16">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <div class="p-2 rounded-lg bg-accent/10">
                        <i data-lucide="<?php echo esc_attr($action_icon); ?>" class="w-6 h-6 text-accent"></i>
                    </div>
                    <span class="rounded-full bg-accent/10 px-3 py-1 text-xs font-bold uppercase tracking-wider text-accent ring-1 ring-accent/20"><?php echo esc_html($action_badge); ?></span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-text-main-light mb-6"><?php echo esc_html($action_heading_before); ?> <span class="bg-gradient-to-r from-amber-flame via-tiger-orange to-cayenne-red bg-clip-text text-transparent"><?php echo esc_html($action_heading_highlight); ?></span> <?php echo esc_html($action_heading_after); ?></h2>
                <p class="text-lg text-text-secondary-light max-w-3xl mx-auto"><?php echo esc_html($action_subtext); ?></p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php 
                $card_hover_borders = array('primary' => 'hover:border-primary/30', 'accent' => 'hover:border-accent/30', 'primary-light' => 'hover:border-primary-light/30');
                foreach ($action_cards as $card) :
                    $c_style = isset($card['style']) ? (string) $card['style'] : 'primary';
                    $c_grad = isset($card_gradients[$c_style]) ? $card_gradients[$c_style] : $card_gradients['primary'];
                    $c_hover = isset($card_hover_borders[$c_style]) ? $card_hover_borders[$c_style] : 'hover:border-primary/30';
                ?>
                <div class="group bg-white rounded-2xl p-8 shadow-soft hover:shadow-xl border border-border-light <?php echo esc_attr($c_hover); ?> transition-all duration-300 hover:-translate-y-2">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br <?php echo esc_attr($c_grad); ?> flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="<?php echo esc_attr($card['icon'] ?? 'users'); ?>" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-text-main-light mb-4"><?php echo esc_html($card['title'] ?? ''); ?></h3>
                    <p class="text-text-secondary-light leading-relaxed"><?php echo esc_html($card['paragraph'] ?? ''); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <!-- CTA -->
            <div class="mt-16 bg-gradient-to-r from-primary/10 to-accent/10 rounded-3xl p-8 md:p-12 border border-primary/20">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-text-main-light mb-6"><?php echo esc_html($cta_heading); ?></h2>
                        <p class="text-text-secondary-light leading-relaxed mb-6"><?php echo esc_html($cta_paragraph); ?></p>
                        <div class="flex flex-wrap gap-4">
                            <?php if (is_array($cta_btn1) && !empty($cta_btn1['url'])) : ?>
                            <a href="<?php echo esc_url($cta_btn1['url']); ?>" class="px-6 py-3 bg-primary text-white rounded-full font-bold hover:bg-primary-dark transition-all flex items-center gap-2 group">
                                <?php echo esc_html($cta_btn1['title'] ?? 'Schedule a Visit'); ?>
                                <i data-lucide="calendar" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                            <?php else : ?>
                            <a href="#" class="px-6 py-3 bg-primary text-white rounded-full font-bold hover:bg-primary-dark transition-all flex items-center gap-2 group">
                                Schedule a Visit
                                <i data-lucide="calendar" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                            <?php endif; ?>
                            <?php if (is_array($cta_btn2) && !empty($cta_btn2['url'])) : ?>
                            <a href="<?php echo esc_url($cta_btn2['url']); ?>" class="px-6 py-3 bg-white border border-border-light text-text-main-light rounded-full font-bold hover:bg-gray-50 transition-all flex items-center gap-2 group">
                                <i data-lucide="download" class="w-5 h-5"></i>
                                <?php echo esc_html($cta_btn2['title'] ?? 'Download Prospectus'); ?>
                            </a>
                            <?php else : ?>
                            <a href="#" class="px-6 py-3 bg-white border border-border-light text-text-main-light rounded-full font-bold hover:bg-gray-50 transition-all flex items-center gap-2 group">
                                <i data-lucide="download" class="w-5 h-5"></i>
                                Download Prospectus
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <?php foreach ($cta_stats as $st) :
                            $st_style = isset($st['style']) ? (string) $st['style'] : 'primary';
                            $st_color = isset($stat_colors[$st_style]) ? $stat_colors[$st_style] : $stat_colors['primary'];
                        ?>
                        <div class="bg-white rounded-2xl p-6 text-center shadow-sm">
                            <div class="text-3xl font-bold <?php echo esc_attr($st_color); ?> mb-2"><?php echo esc_html($st['number'] ?? ''); ?></div>
                            <div class="text-sm font-medium text-text-secondary-light"><?php echo esc_html($st['label'] ?? ''); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
