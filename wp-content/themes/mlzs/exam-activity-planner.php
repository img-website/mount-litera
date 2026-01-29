<?php
/**
 * Template Name: Exam Activity Planner Page
 * Exam & Activity Planner: Hero, Exam blocks (III–V, VI–VIII, IX–XII), Activity tabs, Legend – ACF dynamic
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge    = $opt ? get_field('eap_hero_badge', $page_id) : null;
$hero_icon     = $opt ? get_field('eap_hero_icon', $page_id) : null;
$hero_headline = $opt ? get_field('eap_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('eap_hero_highlight', $page_id) : null;
$hero_sub      = $opt ? get_field('eap_hero_subheadline', $page_id) : null;
$btn1_label    = $opt ? get_field('eap_hero_btn1_label', $page_id) : null;
$btn1_link     = $opt ? get_field('eap_hero_btn1_link', $page_id) : null;
$btn1_icon     = $opt ? get_field('eap_hero_btn1_icon', $page_id) : null;
$btn2_label    = $opt ? get_field('eap_hero_btn2_label', $page_id) : null;
$btn2_link     = $opt ? get_field('eap_hero_btn2_link', $page_id) : null;
$btn2_icon     = $opt ? get_field('eap_hero_btn2_icon', $page_id) : null;

$hero_badge     = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Academic Year 2025-2026';
$hero_icon      = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'calendar-days';
$hero_headline  = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'Exam & Activity';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Planner';
$hero_sub       = ($hero_sub !== '' && $hero_sub !== null) ? (string) $hero_sub : "Comprehensive schedule for Half Yearly Examinations and Annual Activities at Mount Litera Zee School, Alwar. Stay updated with all academic and co-curricular events.";
$btn1_label     = ($btn1_label !== '' && $btn1_label !== null) ? (string) $btn1_label : 'Exam Schedule';
$btn1_link      = ($btn1_link !== '' && $btn1_link !== null) ? esc_attr($btn1_link) : '#exam-planner';
$btn1_icon      = (is_string($btn1_icon) && trim($btn1_icon) !== '') ? trim($btn1_icon) : 'book-open';
$btn2_label     = ($btn2_label !== '' && $btn2_label !== null) ? (string) $btn2_label : 'Activity Planner';
$btn2_link      = ($btn2_link !== '' && $btn2_link !== null) ? esc_attr($btn2_link) : '#activity-planner';
$btn2_icon      = (is_string($btn2_icon) && trim($btn2_icon) !== '') ? trim($btn2_icon) : 'calendar';

// ——— Exam blocks ———
$exam_blocks_raw = $opt ? get_field('eap_exam_blocks', $page_id) : null;
$default_exam_blocks = array(
    array(
        'icon' => 'book-open', 'title' => 'Half Yearly Exam - 2025-2026', 'subtitle' => 'Grades: III to V', 'icon_style' => 'primary',
        'verbal_heading' => 'Verbal Assessment Schedule', 'verbal_note' => 'Two subjects will be assessed each day. Computer Practical exam will be held during their respective class periods from 2nd to 11th September.', 'verbal_note_icon' => 'info', 'verbal_note_style' => 'blue',
        'verbal_rows' => array(
            array('date' => '10/09/25', 'day' => 'Wednesday', 'subject' => 'EVS and Mathematics'),
            array('date' => '12/09/25', 'day' => 'Friday', 'subject' => 'English and Hindi'),
        ),
        'written_heading' => 'Written Assessment Schedule', 'written_note' => 'Exam scheduled on 11th & 12th September will be conducted in regular school timing i.e. 7:30am to 1:30 pm.', 'written_note_icon' => 'alert-circle', 'written_note_style' => 'amber',
        'written_header_labels' => "Grade III\nGrade IV\nGrade V",
        'written_rows' => array(
            array('date' => '11/09/25, Thursday', 'col1' => 'Value Education', 'col2' => 'Value Education', 'col3' => 'Value Education', 'col4' => '', 'col5' => ''),
            array('date' => '12/09/25, Friday', 'col1' => 'Reasoning', 'col2' => 'Reasoning', 'col3' => 'Reasoning', 'col4' => '', 'col5' => ''),
        ),
    ),
);
$exam_blocks = (is_array($exam_blocks_raw) && !empty($exam_blocks_raw)) ? $exam_blocks_raw : $default_exam_blocks;

// ——— Activity planner ———
$activity_icon    = $opt ? get_field('eap_activity_icon', $page_id) : null;
$activity_title   = $opt ? get_field('eap_activity_title', $page_id) : null;
$activity_subtitle = $opt ? get_field('eap_activity_subtitle', $page_id) : null;
$activity_tabs_raw = $opt ? get_field('eap_activity_tabs', $page_id) : null;

$activity_icon     = (is_string($activity_icon) && trim($activity_icon) !== '') ? trim($activity_icon) : 'calendar';
$activity_title    = ($activity_title !== '' && $activity_title !== null) ? (string) $activity_title : 'Activity Planner 2025-2026';
$activity_subtitle = ($activity_subtitle !== '' && $activity_subtitle !== null) ? (string) $activity_subtitle : 'Annual Schedule of Events and Activities';

$default_activity_tabs = array(
    array('tab_label' => 'APRIL - OCTOBER', 'tab_slug' => 'apr-oct', 'month1_heading' => 'APRIL', 'month2_heading' => 'OCTOBER', 'table_rows' => array(
        array('date1' => '2', 'desc1' => 'New Session Begins (I-VIII)', 'date2' => '1', 'desc2' => 'Maha Navami'),
        array('date1' => '5', 'desc1' => 'Fun with Sports (I-V)', 'date2' => '2', 'desc2' => 'Dussehra Gandhi Jayanti'),
    )),
);
$activity_tabs = (is_array($activity_tabs_raw) && !empty($activity_tabs_raw)) ? $activity_tabs_raw : $default_activity_tabs;

// ——— Legend ———
$legend_raw = $opt ? get_field('eap_legend_items', $page_id) : null;
$default_legend = array(
    array('abbrev' => 'IHC', 'full_text' => 'Inter House Competition'),
    array('abbrev' => 'PTM', 'full_text' => 'Parent Teacher Meeting'),
    array('abbrev' => 'SST', 'full_text' => 'Social Studies'),
);
$legend_items = (is_array($legend_raw) && !empty($legend_raw)) ? $legend_raw : $default_legend;

$icon_style_map = array('primary' => 'primary', 'primary-light' => 'primary-light', 'primary-dark' => 'primary-dark');
$verbal_header_bg = array('primary' => 'primary', 'primary-light' => 'primary-light', 'primary-dark' => 'primary-dark');
$written_header_bg = array('primary' => 'accent', 'primary-light' => 'accent-dark', 'primary-dark' => 'accent-light');
?>

    <!-- Hero Section -->
    <section class="relative px-4 sm:px-6 lg:px-8 pt-32 pb-20 md:pt-40 md:pb-28 bg-gradient-to-br from-primary-dark via-primary to-primary-light overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-64 h-64 rounded-full bg-accent blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 rounded-full bg-accent-light blur-3xl"></div>
        </div>
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-6">
                    <i data-lucide="<?php echo esc_attr($hero_icon); ?>" class="w-5 h-5 text-accent"></i>
                    <span class="text-sm font-semibold text-white uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 sm:mb-6 tracking-tight">
                    <?php echo esc_html($hero_headline); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent to-accent-light"><?php echo esc_html($hero_highlight); ?></span>
                </h1>
                <p class="text-sm sm:text-base md:text-lg text-slate-200 mb-6 sm:mb-8 max-w-3xl mx-auto">
                    <?php echo esc_html($hero_sub); ?>
                </p>
                <div class="flex flex-wrap justify-center gap-3 sm:gap-4">
                    <a href="<?php echo $btn1_link; ?>" class="px-4 py-2 sm:px-6 sm:py-3 bg-white text-primary text-sm sm:text-base font-bold rounded-full hover:bg-slate-100 transition-all flex items-center gap-2 group">
                        <i data-lucide="<?php echo esc_attr($btn1_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        <?php echo esc_html($btn1_label); ?>
                    </a>
                    <a href="<?php echo $btn2_link; ?>" class="px-4 py-2 sm:px-6 sm:py-3 bg-transparent border-2 border-white text-white text-sm sm:text-base font-bold rounded-full hover:bg-white/10 transition-all flex items-center gap-2 group">
                        <i data-lucide="<?php echo esc_attr($btn2_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        <?php echo esc_html($btn2_label); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="px-4 sm:px-6 lg:px-8 py-16 bg-background-light">
        <div class="max-w-7xl mx-auto">

            <?php
            $block_ids = array('exam-planner', '', '');
            foreach ($exam_blocks as $idx => $block) :
                $b_icon   = (isset($block['icon']) && trim((string) $block['icon']) !== '') ? trim($block['icon']) : 'book-open';
                $b_title = isset($block['title']) ? (string) $block['title'] : '';
                $b_sub   = isset($block['subtitle']) ? (string) $block['subtitle'] : '';
                $b_style = isset($block['icon_style']) ? $block['icon_style'] : 'primary';
                $v_head  = isset($block['verbal_heading']) ? (string) $block['verbal_heading'] : 'Verbal Assessment Schedule';
                $v_note  = isset($block['verbal_note']) ? (string) $block['verbal_note'] : '';
                $v_note_icon = (isset($block['verbal_note_icon']) && trim((string) $block['verbal_note_icon']) !== '') ? trim($block['verbal_note_icon']) : 'info';
                $v_note_style = isset($block['verbal_note_style']) ? $block['verbal_note_style'] : 'blue';
                $w_head  = isset($block['written_heading']) ? (string) $block['written_heading'] : 'Written Assessment Schedule';
                $w_note  = isset($block['written_note']) ? (string) $block['written_note'] : '';
                $w_note_icon = (isset($block['written_note_icon']) && trim((string) $block['written_note_icon']) !== '') ? trim($block['written_note_icon']) : 'alert-circle';
                $w_note_style = isset($block['written_note_style']) ? $block['written_note_style'] : 'amber';
                $v_rows  = isset($block['verbal_rows']) && is_array($block['verbal_rows']) ? $block['verbal_rows'] : array();
                $w_rows  = isset($block['written_rows']) && is_array($block['written_rows']) ? $block['written_rows'] : array();
                $w_headers = isset($block['written_header_labels']) ? array_filter(array_map('trim', explode("\n", (string) $block['written_header_labels']))) : array();

                $box_bg = $b_style === 'primary' ? 'bg-primary/10' : ($b_style === 'primary-light' ? 'bg-primary-light/10' : 'bg-primary-dark/10');
                $icon_color = $b_style === 'primary' ? 'text-primary' : ($b_style === 'primary-light' ? 'text-primary-light' : 'text-primary-dark');
                $dot_color = $b_style === 'primary' ? 'bg-primary' : ($b_style === 'primary-light' ? 'bg-primary-light' : 'bg-primary-dark');
                $verbal_th_bg = $b_style === 'primary' ? 'bg-primary' : ($b_style === 'primary-light' ? 'bg-primary-light' : 'bg-primary-dark');
                $written_th_bg = $b_style === 'primary' ? 'bg-accent' : ($b_style === 'primary-light' ? 'bg-accent-dark' : 'bg-accent-light');
                $scroll_id = isset($block_ids[$idx]) && $block_ids[$idx] !== '' ? $block_ids[$idx] : '';
                if ($b_title === '') continue;
            ?>
            <div <?php echo $scroll_id ? 'id="' . esc_attr($scroll_id) . '"' : ''; ?> class="mb-12 sm:mb-16 md:mb-20 scroll-mt-24">
                <div class="flex items-center gap-2 sm:gap-3 mb-6 sm:mb-8">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 rounded-xl <?php echo esc_attr($box_bg); ?> flex items-center justify-center">
                        <i data-lucide="<?php echo esc_attr($b_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 <?php echo esc_attr($icon_color); ?>"></i>
                    </div>
                    <div>
                        <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900"><?php echo esc_html($b_title); ?></h2>
                        <?php if ($b_sub !== '') : ?><p class="text-sm sm:text-base md:text-lg <?php echo esc_attr($icon_color); ?> font-semibold"><?php echo esc_html($b_sub); ?></p><?php endif; ?>
                    </div>
                </div>

                <!-- Verbal Assessment -->
                <?php if (!empty($v_rows)) : ?>
                <div class="mb-8 sm:mb-10 md:mb-12">
                    <div class="inline-flex items-center gap-2 mb-3 sm:mb-4">
                        <div class="w-2 h-2 sm:w-3 sm:h-3 rounded-full <?php echo esc_attr($dot_color); ?>"></div>
                        <h3 class="text-base sm:text-lg md:text-xl font-bold text-gray-900"><?php echo esc_html($v_head); ?></h3>
                    </div>
                    <div class="overflow-x-auto rounded-2xl border border-gray-200 shadow-soft">
                        <table class="w-full min-w-full">
                            <thead>
                                <tr class="<?php echo esc_attr($verbal_th_bg); ?> text-white">
                                    <th class="py-2 px-3 sm:py-3 sm:px-4 md:py-4 md:px-6 text-left font-bold text-xs sm:text-sm uppercase tracking-wider">Date</th>
                                    <th class="py-2 px-3 sm:py-3 sm:px-4 md:py-4 md:px-6 text-left font-bold text-xs sm:text-sm uppercase tracking-wider">Day</th>
                                    <th class="py-2 px-3 sm:py-3 sm:px-4 md:py-4 md:px-6 text-left font-bold text-xs sm:text-sm uppercase tracking-wider">Subject</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php foreach ($v_rows as $row) : ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-2 px-3 sm:py-3 sm:px-4 md:py-4 md:px-6 text-xs sm:text-sm font-medium text-gray-900"><?php echo esc_html(isset($row['date']) ? $row['date'] : ''); ?></td>
                                    <td class="py-2 px-3 sm:py-3 sm:px-4 md:py-4 md:px-6 text-xs sm:text-sm text-gray-700"><?php echo esc_html(isset($row['day']) ? $row['day'] : ''); ?></td>
                                    <td class="py-2 px-3 sm:py-3 sm:px-4 md:py-4 md:px-6 text-xs sm:text-sm text-gray-700"><?php echo nl2br(esc_html(isset($row['subject']) ? $row['subject'] : '')); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if ($v_note !== '') : ?>
                    <div class="mt-3 sm:mt-4 p-3 sm:p-4 <?php echo $v_note_style === 'amber' ? 'bg-amber-50 rounded-xl border border-amber-100' : 'bg-blue-50 rounded-xl border border-blue-100'; ?>">
                        <p class="text-xs sm:text-sm text-gray-700 flex items-start gap-2">
                            <i data-lucide="<?php echo esc_attr($v_note_icon); ?>" class="w-3 h-3 sm:w-4 sm:h-4 <?php echo $v_note_style === 'amber' ? 'text-amber-500' : 'text-blue-500'; ?> mt-0.5 flex-shrink-0"></i>
                            <span><b>Note:</b> <?php echo esc_html($v_note); ?></span>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <!-- Written Assessment -->
                <?php if (!empty($w_rows)) : ?>
                <div class="mb-8 sm:mb-10 md:mb-12">
                    <div class="inline-flex items-center gap-2 mb-3 sm:mb-4">
                        <div class="w-2 h-2 sm:w-3 sm:h-3 rounded-full <?php echo $b_style === 'primary' ? 'bg-accent' : ($b_style === 'primary-light' ? 'bg-accent-dark' : 'bg-accent-light'); ?>"></div>
                        <h3 class="text-base sm:text-lg md:text-xl font-bold text-gray-900"><?php echo esc_html($w_head); ?></h3>
                    </div>
                    <div class="overflow-x-auto rounded-2xl border border-gray-200 shadow-soft">
                        <table class="w-full min-w-full">
                            <thead>
                                <tr class="<?php echo esc_attr($written_th_bg); ?> text-white">
                                    <th class="py-2 px-3 sm:py-3 sm:px-4 md:py-4 md:px-6 text-left font-bold text-xs sm:text-sm uppercase tracking-wider">Date</th>
                                    <?php foreach ($w_headers as $wh) : ?><th class="py-2 px-3 sm:py-3 sm:px-4 md:py-4 md:px-6 text-left font-bold text-xs sm:text-sm uppercase tracking-wider"><?php echo esc_html($wh); ?></th><?php endforeach; ?>
                                    <?php if (empty($w_headers)) : ?>
                                        <th class="py-2 px-3 sm:py-3 sm:px-4 md:py-4 md:px-6 text-left font-bold text-xs sm:text-sm uppercase tracking-wider">Col 1</th>
                                        <th class="py-2 px-3 sm:py-3 sm:px-4 md:py-4 md:px-6 text-left font-bold text-xs sm:text-sm uppercase tracking-wider">Col 2</th>
                                        <th class="py-2 px-3 sm:py-3 sm:px-4 md:py-4 md:px-6 text-left font-bold text-xs sm:text-sm uppercase tracking-wider">Col 3</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php foreach ($w_rows as $row) :
                                    $cols = array();
                                    for ($c = 1; $c <= 5; $c++) {
                                        $cols[] = isset($row['col' . $c]) ? trim((string) $row['col' . $c]) : '';
                                    }
                                    $num_cols = !empty($w_headers) ? count($w_headers) : 3;
                                    if ($num_cols === 0) $num_cols = 3;
                                ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-2 px-3 sm:py-3 sm:px-4 md:py-4 md:px-6 text-xs sm:text-sm font-medium text-gray-900"><?php echo esc_html(isset($row['date']) ? $row['date'] : ''); ?></td>
                                    <?php for ($c = 0; $c < $num_cols && $c < 5; $c++) : ?><td class="py-2 px-3 sm:py-3 sm:px-4 md:py-4 md:px-6 text-xs sm:text-sm text-gray-700"><?php echo nl2br(esc_html($cols[$c])); ?></td><?php endfor; ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if ($w_note !== '') : ?>
                    <div class="mt-3 sm:mt-4 p-3 sm:p-4 <?php echo $w_note_style === 'amber' ? 'bg-amber-50 rounded-xl border border-amber-100' : 'bg-blue-50 rounded-xl border border-blue-100'; ?>">
                        <p class="text-xs sm:text-sm text-gray-700 flex items-start gap-2">
                            <i data-lucide="<?php echo esc_attr($w_note_icon); ?>" class="w-3 h-3 sm:w-4 sm:h-4 <?php echo $w_note_style === 'amber' ? 'text-amber-500' : 'text-blue-500'; ?> mt-0.5 flex-shrink-0"></i>
                            <span><b>Note:</b> <?php echo esc_html($w_note); ?></span>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>

            <!-- Activity Planner Section -->
            <div id="activity-planner" class="bg-white rounded-2xl p-4 sm:p-6 md:p-8 shadow-soft border border-gray-100 scroll-mt-24">
                <div class="flex items-center gap-2 sm:gap-3 mb-6 sm:mb-8">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 rounded-xl bg-gradient-to-br from-primary to-accent flex items-center justify-center">
                        <i data-lucide="<?php echo esc_attr($activity_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900"><?php echo esc_html($activity_title); ?></h2>
                        <p class="text-sm sm:text-base md:text-lg text-gray-600"><?php echo esc_html($activity_subtitle); ?></p>
                    </div>
                </div>

                <!-- Month Tabs -->
                <?php if (!empty($activity_tabs)) : ?>
                <div class="mb-6 sm:mb-8 overflow-x-auto">
                    <div class="flex space-x-2 pb-2">
                        <?php foreach ($activity_tabs as $at_idx => $atab) :
                            $tab_label = isset($atab['tab_label']) ? (string) $atab['tab_label'] : '';
                            $tab_slug  = isset($atab['tab_slug']) ? sanitize_title($atab['tab_slug']) : 'tab-' . $at_idx;
                            if ($tab_label === '') continue;
                            $active = $at_idx === 0;
                        ?>
                        <button type="button" class="activity-month-tab px-3 py-2 sm:px-5 sm:py-2.5 md:px-6 md:py-3 rounded-full font-bold text-xs sm:text-sm transition-all whitespace-nowrap <?php echo $active ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'; ?>" data-month="<?php echo esc_attr($tab_slug); ?>">
                            <?php echo esc_html($tab_label); ?>
                        </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Activity Tables -->
                <div class="space-y-8">
                    <?php foreach ($activity_tabs as $at_idx => $atab) :
                        $tab_slug = isset($atab['tab_slug']) ? sanitize_title($atab['tab_slug']) : 'tab-' . $at_idx;
                        $m1 = isset($atab['month1_heading']) ? (string) $atab['month1_heading'] : 'Month 1';
                        $m2 = isset($atab['month2_heading']) ? (string) $atab['month2_heading'] : 'Month 2';
                        $rows = isset($atab['table_rows']) && is_array($atab['table_rows']) ? $atab['table_rows'] : array();
                        $hidden = $at_idx !== 0;
                    ?>
                    <div class="activity-table <?php echo $hidden ? 'hidden' : ''; ?>" data-month="<?php echo esc_attr($tab_slug); ?>">
                        <div class="overflow-x-auto rounded-xl border border-gray-200">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gradient-to-r from-primary to-primary-light text-white">
                                        <th class="py-2 px-3 sm:py-3 sm:px-4 md:py-4 md:px-6 text-left font-bold text-xs sm:text-sm uppercase tracking-wider" colspan="2"><?php echo esc_html($m1); ?></th>
                                        <th class="py-2 px-3 sm:py-3 sm:px-4 md:py-4 md:px-6 text-left font-bold text-xs sm:text-sm uppercase tracking-wider" colspan="2"><?php echo esc_html($m2); ?></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <?php foreach ($rows as $r) : ?>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="py-2 px-3 sm:py-3 sm:px-4 md:py-4 md:px-6 text-xs sm:text-sm font-medium text-gray-900 border-r border-gray-200"><?php echo esc_html(isset($r['date1']) ? $r['date1'] : ''); ?></td>
                                        <td class="py-2 px-3 sm:py-3 sm:px-4 md:py-4 md:px-6 text-xs sm:text-sm text-gray-700 border-r border-gray-200"><?php echo nl2br(esc_html(isset($r['desc1']) ? $r['desc1'] : '')); ?></td>
                                        <td class="py-2 px-3 sm:py-3 sm:px-4 md:py-4 md:px-6 text-xs sm:text-sm font-medium text-gray-900 border-r border-gray-200"><?php echo esc_html(isset($r['date2']) ? $r['date2'] : ''); ?></td>
                                        <td class="py-2 px-3 sm:py-3 sm:px-4 md:py-4 md:px-6 text-xs sm:text-sm text-gray-700"><?php echo nl2br(esc_html(isset($r['desc2']) ? $r['desc2'] : '')); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Legend -->
                <?php if (!empty($legend_items)) : ?>
                <div class="mt-8 p-4 bg-gray-50 rounded-xl border border-gray-200">
                    <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-3 flex items-center gap-2">
                        <i data-lucide="info" class="w-4 h-4"></i>
                        <?php esc_html_e('Legend & Abbreviations', 'mlzs'); ?>
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <?php
                        $legend_dots = array('bg-primary', 'bg-accent', 'bg-primary-light');
                        foreach ($legend_items as $lidx => $leg) :
                            $abbrev = isset($leg['abbrev']) ? (string) $leg['abbrev'] : '';
                            $full  = isset($leg['full_text']) ? (string) $leg['full_text'] : '';
                            if ($abbrev === '' && $full === '') continue;
                            $dot_class = isset($legend_dots[$lidx]) ? $legend_dots[$lidx] : 'bg-primary';
                        ?>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full <?php echo esc_attr($dot_class); ?>"></div>
                            <span class="text-gray-700"><?php echo esc_html($abbrev); ?> = <?php echo esc_html($full); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <script>
    (function() {
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof lucide !== 'undefined' && lucide.createIcons) lucide.createIcons();
            var tabs = document.querySelectorAll('.activity-month-tab');
            var tables = document.querySelectorAll('.activity-table');
            tabs.forEach(function(tab) {
                tab.addEventListener('click', function() {
                    var month = this.getAttribute('data-month');
                    tabs.forEach(function(t) { t.classList.remove('bg-primary', 'text-white'); t.classList.add('bg-gray-100', 'text-gray-700'); });
                    this.classList.remove('bg-gray-100', 'text-gray-700'); this.classList.add('bg-primary', 'text-white');
                    tables.forEach(function(tbl) {
                        tbl.classList.toggle('hidden', tbl.getAttribute('data-month') !== month);
                    });
                });
            });
        });
    })();
    </script>

<?php get_footer(); ?>
