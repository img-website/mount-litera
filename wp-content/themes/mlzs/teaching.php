<?php
/**
 * Template Name: Teaching Staff Page
 * Teaching: Hero (stats 3, buttons), Staff Table (name, subject, designation), Department cards (3), CTA. UI matches teaching.html exactly.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge   = $opt ? get_field('teaching_hero_badge', $page_id) : null;
$hero_before  = $opt ? get_field('teaching_hero_headline_before', $page_id) : null;
$hero_highlight = $opt ? get_field('teaching_hero_headline_highlight', $page_id) : null;
$hero_para    = $opt ? get_field('teaching_hero_paragraph', $page_id) : null;
$hero_btn1_link = $opt ? get_field('teaching_hero_btn1_link', $page_id) : null;
$hero_btn1_icon = $opt ? get_field('teaching_hero_btn1_icon', $page_id) : null;
$hero_btn2_link = $opt ? get_field('teaching_hero_btn2_link', $page_id) : null;
$hero_btn2_icon = $opt ? get_field('teaching_hero_btn2_icon', $page_id) : null;
$hero_stats   = $opt ? get_field('teaching_hero_stats', $page_id) : null;

$hero_badge   = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Our Educators';
$hero_before  = ($hero_before !== '' && $hero_before !== null) ? (string) $hero_before : 'Meet Our';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Teaching Staff';
$hero_para    = ($hero_para !== '' && $hero_para !== null) ? (string) $hero_para : 'Our dedicated team of educators brings passion, expertise, and innovation to the classroom every day. Meet the professionals who are shaping the future leaders of tomorrow.';
$hero_btn1_icon = (is_string($hero_btn1_icon) && trim($hero_btn1_icon) !== '') ? trim($hero_btn1_icon) : 'arrow-down';
$hero_btn2_icon = (is_string($hero_btn2_icon) && trim($hero_btn2_icon) !== '') ? trim($hero_btn2_icon) : 'search';

$hero_btn1_url = $hero_btn1_target = $hero_btn1_text = '';
if (!empty($hero_btn1_link) && is_array($hero_btn1_link)) {
    $hero_btn1_url   = isset($hero_btn1_link['url']) ? esc_url($hero_btn1_link['url']) : '#staff-table';
    $hero_btn1_target = isset($hero_btn1_link['target']) ? $hero_btn1_link['target'] : '_self';
    $hero_btn1_text  = isset($hero_btn1_link['title']) && trim((string) $hero_btn1_link['title']) !== '' ? (string) $hero_btn1_link['title'] : 'View All Staff';
} else { $hero_btn1_url = '#staff-table'; $hero_btn1_target = '_self'; $hero_btn1_text = 'View All Staff'; }

$hero_btn2_url = $hero_btn2_target = $hero_btn2_text = '';
if (!empty($hero_btn2_link) && is_array($hero_btn2_link)) {
    $hero_btn2_url   = isset($hero_btn2_link['url']) ? esc_url($hero_btn2_link['url']) : '#';
    $hero_btn2_target = isset($hero_btn2_link['target']) ? $hero_btn2_link['target'] : '_self';
    $hero_btn2_text  = isset($hero_btn2_link['title']) && trim((string) $hero_btn2_link['title']) !== '' ? (string) $hero_btn2_link['title'] : 'Search Staff';
} else { $hero_btn2_url = '#'; $hero_btn2_target = '_self'; $hero_btn2_text = 'Search Staff'; }

$default_hero_stats = array(
    array('icon' => 'users', 'number' => '70+', 'label' => 'Teaching Professionals'),
    array('icon' => 'award', 'number' => '45+', 'label' => 'PGT Qualified'),
    array('icon' => 'book-open', 'number' => '30+', 'label' => 'Subjects Covered'),
);
$hero_stats = (is_array($hero_stats) && count($hero_stats) >= 3) ? $hero_stats : $default_hero_stats;

// ——— Table ———
$search_placeholder = $opt ? get_field('teaching_search_placeholder', $page_id) : null;
$table_heading = $opt ? get_field('teaching_table_heading', $page_id) : null;
$table_subtext = $opt ? get_field('teaching_table_subtext', $page_id) : null;
$table_stat_total_label = $opt ? get_field('teaching_table_stat_total_label', $page_id) : null;
$table_stat_pgt_label = $opt ? get_field('teaching_table_stat_pgt_label', $page_id) : null;
$table_stat_subjects_label = $opt ? get_field('teaching_table_stat_subjects_label', $page_id) : null;
$table_stat_coaches_label = $opt ? get_field('teaching_table_stat_coaches_label', $page_id) : null;
$staff_rows = $opt ? get_field('teaching_staff_rows', $page_id) : null;

$search_placeholder = ($search_placeholder !== '' && $search_placeholder !== null) ? (string) $search_placeholder : 'Search...';
$table_heading = ($table_heading !== '' && $table_heading !== null) ? (string) $table_heading : 'Teaching Staff Directory';
$table_subtext = ($table_subtext !== '' && $table_subtext !== null) ? (string) $table_subtext : 'Complete list of our teaching faculty with their subjects and designations';
$table_stat_total_label = ($table_stat_total_label !== '' && $table_stat_total_label !== null) ? (string) $table_stat_total_label : 'Total Staff';
$table_stat_pgt_label = ($table_stat_pgt_label !== '' && $table_stat_pgt_label !== null) ? (string) $table_stat_pgt_label : 'PGT Teachers';
$table_stat_subjects_label = ($table_stat_subjects_label !== '' && $table_stat_subjects_label !== null) ? (string) $table_stat_subjects_label : 'Subjects';
$table_stat_coaches_label = ($table_stat_coaches_label !== '' && $table_stat_coaches_label !== null) ? (string) $table_stat_coaches_label : 'Coaches';

$default_staff = array(
    array('name' => 'MR. MOHIT AGAKWIA', 'subject' => 'ENGLISH', 'designation' => 'PGT'),
    array('name' => 'MR. PANAKI YADIM', 'subject' => 'ENGLISH', 'designation' => 'TGT'),
    array('name' => 'MR. SATYAM', 'subject' => 'ECONOMICS, BST', 'designation' => 'PGT'),
    array('name' => 'MR. ARJAT LAMBA', 'subject' => 'PHYSICS', 'designation' => 'PGT'),
    array('name' => 'MRS. GURVAN AKORA', 'subject' => 'ENGLISH', 'designation' => 'PBT'),
    array('name' => 'MR. AMT SHUANA', 'subject' => 'CHEMISTRY', 'designation' => 'PGT'),
    array('name' => 'MR. RAVI PANGDECUWA', 'subject' => 'IP/COMPUTER', 'designation' => 'PGT'),
    array('name' => 'MR. AMT YADIM', 'subject' => 'MATHS', 'designation' => 'PGT'),
    array('name' => 'MR. SAHOTEP DUMAS YADIM', 'subject' => 'PHYSICAL EDUCATION', 'designation' => 'PGT'),
    array('name' => 'MRS. DEPSHISHA', 'subject' => 'EVS', 'designation' => 'PBT'),
);
$staff_rows = is_array($staff_rows) && !empty($staff_rows) ? $staff_rows : $default_staff;

$table_stat_total = count($staff_rows);
$table_stat_pgt = 0;
$table_stat_coaches = 0;
$subjects_seen = array();
foreach ($staff_rows as $row) {
    $d = isset($row['designation']) ? (string) $row['designation'] : '';
    if (stripos($d, 'PGT') !== false) $table_stat_pgt++;
    if (stripos($d, 'COACH') !== false) $table_stat_coaches++;
    $sub = isset($row['subject']) ? trim((string) $row['subject']) : '';
    if ($sub !== '') $subjects_seen[$sub] = true;
}
$table_stat_subjects = count($subjects_seen);
if ($table_stat_subjects > 0 && $table_stat_subjects < 30) $table_stat_subjects = $table_stat_subjects . '+';

// Hero stats: labels/icons from CMS, numbers from staff table (dynamic)
$hero_stats_display = array();
foreach ($hero_stats as $s) {
    $icon = isset($s['icon']) ? trim((string) $s['icon']) : 'users';
    $label = isset($s['label']) ? (string) $s['label'] : '';
    if ($icon === 'award') {
        $num = $table_stat_pgt;
    } elseif ($icon === 'book-open') {
        $num = is_string($table_stat_subjects) ? $table_stat_subjects : (string) $table_stat_subjects;
    } else {
        $num = $table_stat_total;
    }
    $hero_stats_display[] = array('icon' => $icon, 'number' => $num, 'label' => $label);
}

// ——— Department cards (3) ———
$dept_heading = $opt ? get_field('teaching_dept_heading', $page_id) : null;
$dept_subtext = $opt ? get_field('teaching_dept_subtext', $page_id) : null;
$dept_cards = $opt ? get_field('teaching_dept_cards', $page_id) : null;

$dept_heading = ($dept_heading !== '' && $dept_heading !== null) ? (string) $dept_heading : 'Department Overview';
$dept_subtext = ($dept_subtext !== '' && $dept_subtext !== null) ? (string) $dept_subtext : 'Our teaching staff is organized into specialized departments to ensure comprehensive coverage of all subjects and activities';
$default_dept_cards = array(
    array('icon' => 'book-open', 'title' => 'Academic Faculty', 'subtitle' => 'Core Subjects', 'paragraph' => 'Our core academic team includes PGT and TGT teachers specializing in Mathematics, Science, English, Social Studies, and Languages.', 'count_label' => '45+ Teachers', 'badge_text' => 'Core', 'color' => 'primary'),
    array('icon' => 'music', 'title' => 'Arts & Culture', 'subtitle' => 'Creative Expression', 'paragraph' => 'Dedicated teachers for Music, Dance, Fine Arts, and Creative Arts to nurture artistic talents and cultural appreciation.', 'count_label' => '8+ Teachers', 'badge_text' => 'Arts', 'color' => 'accent'),
    array('icon' => 'dumbbell', 'title' => 'Sports & Athletics', 'subtitle' => 'Physical Education', 'paragraph' => 'Certified coaches for various sports including Basketball, Football, Swimming, Skating, Taekwondo, and Cricket.', 'count_label' => '10+ Coaches', 'badge_text' => 'Sports', 'color' => 'cayenne'),
);
$dept_cards = (is_array($dept_cards) && count($dept_cards) >= 3) ? $dept_cards : $default_dept_cards;

// ——— CTA ———
$cta_heading = $opt ? get_field('teaching_cta_heading', $page_id) : null;
$cta_para    = $opt ? get_field('teaching_cta_paragraph', $page_id) : null;
$cta_btn1_link = $opt ? get_field('teaching_cta_btn1_link', $page_id) : null;
$cta_btn1_icon = $opt ? get_field('teaching_cta_btn1_icon', $page_id) : null;
$cta_btn2_link = $opt ? get_field('teaching_cta_btn2_link', $page_id) : null;
$cta_btn2_icon = $opt ? get_field('teaching_cta_btn2_icon', $page_id) : null;

$cta_heading = ($cta_heading !== '' && $cta_heading !== null) ? (string) $cta_heading : 'Join Our Teaching Team';
$cta_para    = ($cta_para !== '' && $cta_para !== null) ? (string) $cta_para : 'Are you passionate about education and want to make a difference? We\'re always looking for talented educators to join our team.';
$cta_btn1_icon = (is_string($cta_btn1_icon) && trim($cta_btn1_icon) !== '') ? trim($cta_btn1_icon) : 'arrow-right';
$cta_btn2_icon = (is_string($cta_btn2_icon) && trim($cta_btn2_icon) !== '') ? trim($cta_btn2_icon) : 'mail';

$cta_btn1_url = $cta_btn1_target = $cta_btn1_text = '';
if (!empty($cta_btn1_link) && is_array($cta_btn1_link)) {
    $cta_btn1_url   = isset($cta_btn1_link['url']) ? esc_url($cta_btn1_link['url']) : '#';
    $cta_btn1_target = isset($cta_btn1_link['target']) ? $cta_btn1_link['target'] : '_self';
    $cta_btn1_text  = isset($cta_btn1_link['title']) && trim((string) $cta_btn1_link['title']) !== '' ? (string) $cta_btn1_link['title'] : 'View Open Positions';
} else { $cta_btn1_url = '#'; $cta_btn1_target = '_self'; $cta_btn1_text = 'View Open Positions'; }

$cta_btn2_url = $cta_btn2_target = $cta_btn2_text = '';
if (!empty($cta_btn2_link) && is_array($cta_btn2_link)) {
    $cta_btn2_url   = isset($cta_btn2_link['url']) ? esc_url($cta_btn2_link['url']) : '#';
    $cta_btn2_target = isset($cta_btn2_link['target']) ? $cta_btn2_link['target'] : '_self';
    $cta_btn2_text  = isset($cta_btn2_link['title']) && trim((string) $cta_btn2_link['title']) !== '' ? (string) $cta_btn2_link['title'] : 'Contact HR';
} else { $cta_btn2_url = '#'; $cta_btn2_target = '_self'; $cta_btn2_text = 'Contact HR'; }

// Helper: designation filter value for JS (PGT, TGT, PBT, COACH, OTHER)
function mlzs_teaching_designation_filter_value($designation) {
    $d = strtoupper((string) $designation);
    if (strpos($d, 'PGT') !== false) return 'PGT';
    if (strpos($d, 'TGT') !== false) return 'TGT';
    if (strpos($d, 'PBT') !== false) return 'PBT';
    if (strpos($d, 'COACH') !== false || strpos($d, 'TEACHER') !== false || strpos($d, 'LIBRARIAN') !== false || strpos($d, 'ASSIST') !== false) return 'COACH';
    return 'OTHER';
}
?>

    <!-- Hero Section (UI exactly as teaching.html) -->
    <section class="relative px-4 sm:px-6 lg:px-8 pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden bg-gradient-to-br from-[#3D348B] via-[#2d2566] to-[#1a1544]">
        <div class="absolute top-0 right-0 -z-10 h-full w-full overflow-hidden">
            <div class="absolute -top-40 -right-40 h-[500px] w-[500px] rounded-full bg-white/5 blur-[100px]"></div>
            <div class="absolute top-1/2 -left-20 h-[300px] w-[300px] rounded-full bg-[#F7B801]/10 blur-[80px]"></div>
            <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-1/2 bg-gradient-to-t from-black/10 to-transparent"></div>
        </div>
        <div class="max-w-7xl mx-auto w-full relative z-10">
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8">
                <div class="flex-1">
                    <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1 sm:py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-4 sm:mb-6">
                        <span class="relative flex h-2 w-2 sm:h-2.5 sm:w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#F7B801] opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 sm:h-2.5 sm:w-2.5 bg-[#F7B801]"></span>
                        </span>
                        <span class="text-[10px] sm:text-xs font-semibold text-white uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-[1.1] tracking-tight mb-4 sm:mb-6">
                        <?php echo esc_html($hero_before); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#F7B801] via-[#F18701] to-[#F35B04]"><?php echo esc_html($hero_highlight); ?></span>
                    </h1>
                    <p class="text-base sm:text-lg text-white/90 max-w-2xl leading-relaxed font-light mb-6 sm:mb-8">
                        <?php echo esc_html($hero_para); ?>
                    </p>
                    <div class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4">
                        <a href="<?php echo $hero_btn1_url; ?>" target="<?php echo esc_attr($hero_btn1_target); ?>" class="px-4 sm:px-6 py-2 sm:py-3 text-sm sm:text-base bg-gradient-to-r from-[#3D348B] to-[#2d2566] text-white rounded-full font-bold hover:shadow-[0_0_20px_rgba(61,52,139,0.5)] transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2 group">
                            <?php echo esc_html($hero_btn1_text); ?>
                            <i data-lucide="<?php echo esc_attr($hero_btn1_icon); ?>" class="size-4 sm:size-5"></i>
                        </a>
                        <a href="<?php echo $hero_btn2_url; ?>" target="<?php echo esc_attr($hero_btn2_target); ?>" class="px-4 sm:px-6 py-2 sm:py-3 text-sm sm:text-base bg-white/10 backdrop-blur-sm border border-white/30 text-white rounded-full font-bold hover:bg-white/20 transition-all flex items-center justify-center gap-2 group">
                            <i data-lucide="<?php echo esc_attr($hero_btn2_icon); ?>" class="size-4 sm:size-5"></i>
                            <?php echo esc_html($hero_btn2_text); ?>
                        </a>
                    </div>
                </div>
                <div class="w-full lg:w-auto grid grid-cols-1 md:grid-cols-3 lg:grid-cols-1 gap-4 lg:gap-6 bg-white/10 backdrop-blur-lg rounded-2xl p-4 sm:p-6 border border-white/20 shadow-xl">
                    <?php foreach ($hero_stats_display as $s) :
                        $s_icon = isset($s['icon']) ? trim((string) $s['icon']) : 'users';
                        $s_num = isset($s['number']) ? (string) $s['number'] : '';
                        $s_lab = isset($s['label']) ? (string) $s['label'] : '';
                        if ($s_icon === 'award') {
                            $s_color = 'text-[#7678ED]';
                            $s_bg = 'bg-[#7678ED]/20';
                        } elseif ($s_icon === 'book-open') {
                            $s_color = 'text-[#F35B04]';
                            $s_bg = 'bg-[#F35B04]/20';
                        } else {
                            $s_color = 'text-[#F7B801]';
                            $s_bg = 'bg-[#F7B801]/20';
                        }
                    ?>
                    <div class="flex items-center gap-3 sm:gap-4">
                        <div class="p-2.5 sm:p-3 rounded-full <?php echo esc_attr($s_bg); ?> shrink-0">
                            <i data-lucide="<?php echo esc_attr($s_icon); ?>" class="size-6 sm:size-7 md:size-8 <?php echo esc_attr($s_color); ?>"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-2xl sm:text-3xl font-bold text-white"><?php echo esc_html($s_num); ?></p>
                            <p class="text-xs sm:text-sm text-white/80 leading-tight"><?php echo esc_html($s_lab); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Teaching Staff Table Section -->
    <section id="staff-table" class="px-4 sm:px-6 lg:px-8 py-12 sm:py-16 md:py-24 bg-white scroll-mt-24">
        <div class="max-w-7xl mx-auto w-full">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 md:gap-6 mb-8 md:mb-12">
                <div class="mb-4 md:mb-0">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-2 md:mb-3"><?php echo esc_html($table_heading); ?></h2>
                    <p class="text-sm sm:text-base text-gray-600"><?php echo esc_html($table_subtext); ?></p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 w-full md:w-auto">
                    <div class="relative group flex-1 sm:flex-initial sm:w-auto">
                        <i data-lucide="search" class="absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 size-4 sm:size-5 text-gray-400 group-focus-within:text-[#3D348B] transition-colors"></i>
                        <input type="text" id="search-input" placeholder="<?php echo esc_attr($search_placeholder); ?>" class="pl-10 sm:pl-12 pr-4 py-2.5 sm:py-3 text-sm sm:text-base rounded-full border border-gray-300 focus:border-[#3D348B] focus:ring-2 focus:ring-[#3D348B]/20 transition-all w-full sm:w-56 md:w-64">
                    </div>
                    <div class="relative group flex-1 sm:flex-initial sm:w-auto">
                        <i data-lucide="filter" class="absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 size-4 sm:size-5 text-gray-400 group-focus-within:text-[#3D348B] transition-colors"></i>
                        <select id="designation-filter" class="pl-10 sm:pl-12 pr-8 sm:pr-10 py-2.5 sm:py-3 text-sm sm:text-base rounded-full border border-gray-300 focus:border-[#3D348B] focus:ring-2 focus:ring-[#3D348B]/20 appearance-none bg-white cursor-pointer w-full sm:w-44 md:w-48">
                            <option value="">All Designations</option>
                            <option value="PGT">PGT</option>
                            <option value="TGT">TGT</option>
                            <option value="PBT">PBT</option>
                            <option value="COACH">Coach</option>
                            <option value="OTHER">Other</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 mb-6 md:mb-8">
                <div class="bg-gradient-to-br from-[#3D348B]/10 to-transparent rounded-xl p-3 sm:p-4 border border-[#3D348B]/20">
                    <p class="text-xs sm:text-sm text-gray-600 mb-1"><?php echo esc_html($table_stat_total_label); ?></p>
                    <p class="text-xl sm:text-2xl font-bold text-[#3D348B]" data-stat-total><?php echo esc_html($table_stat_total); ?></p>
                </div>
                <div class="bg-gradient-to-br from-[#F7B801]/10 to-transparent rounded-xl p-3 sm:p-4 border border-[#F7B801]/20">
                    <p class="text-xs sm:text-sm text-gray-600 mb-1"><?php echo esc_html($table_stat_pgt_label); ?></p>
                    <p class="text-xl sm:text-2xl font-bold text-[#F7B801]" data-stat-pgt><?php echo esc_html($table_stat_pgt); ?></p>
                </div>
                <div class="bg-gradient-to-br from-[#7678ED]/10 to-transparent rounded-xl p-3 sm:p-4 border border-[#7678ED]/20">
                    <p class="text-xs sm:text-sm text-gray-600 mb-1"><?php echo esc_html($table_stat_subjects_label); ?></p>
                    <p class="text-xl sm:text-2xl font-bold text-[#7678ED]"><?php echo esc_html($table_stat_subjects); ?></p>
                </div>
                <div class="bg-gradient-to-br from-[#F35B04]/10 to-transparent rounded-xl p-3 sm:p-4 border border-[#F35B04]/20">
                    <p class="text-xs sm:text-sm text-gray-600 mb-1"><?php echo esc_html($table_stat_coaches_label); ?></p>
                    <p class="text-xl sm:text-2xl font-bold text-[#F35B04]"><?php echo esc_html($table_stat_coaches); ?></p>
                </div>
            </div>
            <div class="table-container overflow-x-auto rounded-2xl border border-gray-200 shadow-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-[#3D348B] to-[#2d2566]">
                        <tr>
                            <th scope="col" class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 text-left text-[10px] sm:text-xs font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center gap-1 sm:gap-2">
                                    <i data-lucide="hash" class="size-3 sm:size-4 hidden sm:inline"></i>
                                    <span class="hidden sm:inline">S. No.</span>
                                    <span class="sm:hidden">#</span>
                                </div>
                            </th>
                            <th scope="col" class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 text-left text-[10px] sm:text-xs font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center gap-1 sm:gap-2">
                                    <i data-lucide="user" class="size-3 sm:size-4"></i>
                                    Name
                                </div>
                            </th>
                            <th scope="col" class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 text-left text-[10px] sm:text-xs font-bold text-white uppercase tracking-wider hidden sm:table-cell">
                                <div class="flex items-center gap-1 sm:gap-2">
                                    <i data-lucide="book-open" class="size-3 sm:size-4"></i>
                                    Subject
                                </div>
                            </th>
                            <th scope="col" class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 text-left text-[10px] sm:text-xs font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center gap-1 sm:gap-2">
                                    <i data-lucide="award" class="size-3 sm:size-4"></i>
                                    <span class="hidden md:inline">Designation</span>
                                    <span class="md:hidden">Design.</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="staff-table-body" class="bg-white divide-y divide-gray-200">
                        <?php foreach ($staff_rows as $i => $row) :
                            $s_no = $i + 1;
                            $name = isset($row['name']) ? (string) $row['name'] : '';
                            $subject = isset($row['subject']) ? (string) $row['subject'] : '';
                            $desig = isset($row['designation']) ? (string) $row['designation'] : '';
                            if ($name === '' && $desig === '') continue;
                            $filter_val = mlzs_teaching_designation_filter_value($desig);
                            if (stripos($desig, 'PGT') !== false) {
                                $badge_class = 'bg-[#3D348B]/10 text-[#3D348B]';
                            } elseif (stripos($desig, 'TGT') !== false) {
                                $badge_class = 'bg-[#F7B801]/10 text-[#F7B801]';
                            } elseif (stripos($desig, 'PBT') !== false) {
                                $badge_class = 'bg-[#7678ED]/10 text-[#7678ED]';
                            } elseif (stripos($desig, 'COACH') !== false || stripos($desig, 'TEACHER') !== false || stripos($desig, 'LIBRARIAN') !== false || stripos($desig, 'ASSIST') !== false) {
                                $badge_class = 'bg-[#F35B04]/10 text-[#F35B04]';
                            } else {
                                $badge_class = 'bg-gray-100 text-gray-700';
                            }
                        ?>
                        <tr class="staff-row hover:bg-gray-50 transition-colors" data-name="<?php echo esc_attr($name); ?>" data-subject="<?php echo esc_attr($subject); ?>" data-designation="<?php echo esc_attr($desig); ?>" data-filter="<?php echo esc_attr($filter_val); ?>">
                            <td class="px-3 sm:px-4 md:px-6 py-2.5 sm:py-3 md:py-4 whitespace-nowrap">
                                <div class="text-xs sm:text-sm font-bold text-gray-900"><?php echo (int) $s_no; ?></div>
                            </td>
                            <td class="px-3 sm:px-4 md:px-6 py-2.5 sm:py-3 md:py-4">
                                <div class="text-xs sm:text-sm font-semibold text-gray-900 staff-name"><?php echo esc_html($name); ?></div>
                                <div class="text-xs text-gray-600 mt-0.5 sm:hidden"><?php echo esc_html($subject); ?></div>
                            </td>
                            <td class="px-3 sm:px-4 md:px-6 py-2.5 sm:py-3 md:py-4 hidden sm:table-cell">
                                <div class="text-xs sm:text-sm text-gray-900 staff-subject"><?php echo esc_html($subject); ?></div>
                            </td>
                            <td class="px-3 sm:px-4 md:px-6 py-2.5 sm:py-3 md:py-4 whitespace-nowrap">
                                <span class="px-2 sm:px-3 py-0.5 sm:py-1 rounded-full text-[10px] sm:text-xs font-bold <?php echo esc_attr($badge_class); ?> staff-designation"><?php echo esc_html($desig); ?></span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-6 md:mt-8 p-4 sm:p-6 bg-gray-50 rounded-2xl border border-gray-200">
                <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-3 sm:mb-4 flex items-center gap-2">
                    <i data-lucide="info" class="size-4 sm:size-5 text-[#3D348B]"></i>
                    Designation Legend
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4">
                    <div class="flex items-center gap-2 sm:gap-3">
                        <div class="w-3 h-3 rounded-full bg-[#3D348B] shrink-0"></div>
                        <div>
                            <p class="text-sm sm:text-base font-medium text-gray-900">PGT</p>
                            <p class="text-xs sm:text-sm text-gray-600">Post Graduate Teacher</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 sm:gap-3">
                        <div class="w-3 h-3 rounded-full bg-[#F7B801] shrink-0"></div>
                        <div>
                            <p class="text-sm sm:text-base font-medium text-gray-900">TGT</p>
                            <p class="text-xs sm:text-sm text-gray-600">Trained Graduate Teacher</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 sm:gap-3">
                        <div class="w-3 h-3 rounded-full bg-[#7678ED] shrink-0"></div>
                        <div>
                            <p class="text-sm sm:text-base font-medium text-gray-900">PBT</p>
                            <p class="text-xs sm:text-sm text-gray-600">Primary Basic Teacher</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 sm:gap-3">
                        <div class="w-3 h-3 rounded-full bg-[#F35B04] shrink-0"></div>
                        <div>
                            <p class="text-sm sm:text-base font-medium text-gray-900">Coach</p>
                            <p class="text-xs sm:text-sm text-gray-600">Sports & Activity Coach</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Department Breakdown -->
    <section class="px-4 sm:px-6 lg:px-8 py-12 sm:py-16 md:py-24 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto w-full">
            <div class="text-center mb-8 sm:mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-3 sm:mb-4"><?php echo esc_html($dept_heading); ?></h2>
                <p class="text-sm sm:text-base text-gray-600 max-w-2xl mx-auto px-4"><?php echo esc_html($dept_subtext); ?></p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                $dept_colors = array(
                        'primary' => array('border' => 'hover:border-[#3D348B]/20', 'icon_bg' => 'bg-[#3D348B]/10', 'icon_text' => 'text-[#3D348B]', 'badge' => 'bg-[#3D348B]/10 text-[#3D348B]'),
                        'accent'  => array('border' => 'hover:border-[#F7B801]/20', 'icon_bg' => 'bg-[#F7B801]/10', 'icon_text' => 'text-[#F7B801]', 'badge' => 'bg-[#F7B801]/10 text-[#F7B801]'),
                        'cayenne' => array('border' => 'hover:border-[#F35B04]/20', 'icon_bg' => 'bg-[#F35B04]/10', 'icon_text' => 'text-[#F35B04]', 'badge' => 'bg-[#F35B04]/10 text-[#F35B04]'),
                );
                $color_by_index = array('primary', 'accent', 'cayenne');
                foreach ($dept_cards as $idx => $card) :
                    $c_color = (isset($card['color']) && $card['color'] !== '') ? $card['color'] : (isset($color_by_index[$idx]) ? $color_by_index[$idx] : 'primary');
                    if (!isset($dept_colors[$c_color])) $c_color = 'primary';
                    $dc = $dept_colors[$c_color];
                    $c_icon = isset($card['icon']) ? trim((string) $card['icon']) : 'book-open';
                    $c_title = isset($card['title']) ? (string) $card['title'] : '';
                    $c_subtitle = isset($card['subtitle']) ? (string) $card['subtitle'] : '';
                    $c_para = isset($card['paragraph']) ? (string) $card['paragraph'] : '';
                    $c_count = isset($card['count_label']) ? (string) $card['count_label'] : '';
                    $c_badge = isset($card['badge_text']) ? (string) $card['badge_text'] : '';
                ?>
                <div class="group bg-white rounded-2xl p-4 sm:p-6 border border-gray-200 shadow-soft hover:shadow-xl <?php echo esc_attr($dc['border']); ?> transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center gap-3 sm:gap-4 mb-3 sm:mb-4">
                        <div class="p-2 sm:p-3 rounded-xl <?php echo esc_attr($dc['icon_bg']); ?> shrink-0">
                            <i data-lucide="<?php echo esc_attr($c_icon); ?>" class="size-5 sm:size-6 <?php echo esc_attr($dc['icon_text']); ?>"></i>
                        </div>
                        <div>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900"><?php echo esc_html($c_title); ?></h3>
                            <p class="text-xs sm:text-sm text-gray-600"><?php echo esc_html($c_subtitle); ?></p>
                        </div>
                    </div>
                    <p class="text-sm sm:text-base text-gray-600 mb-3 sm:mb-4"><?php echo esc_html($c_para); ?></p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs sm:text-sm text-gray-500"><?php echo esc_html($c_count); ?></span>
                        <span class="px-2 sm:px-3 py-1 rounded-full <?php echo esc_attr($dc['badge']); ?> text-xs font-bold"><?php echo esc_html($c_badge); ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        <div class="max-w-4xl mx-auto text-center">
            <div class="bg-gradient-to-r from-[#3D348B] to-[#2d2566] rounded-2xl sm:rounded-3xl p-6 sm:p-8 md:p-12 relative overflow-hidden">
                <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-64 h-64 rounded-full bg-white/5 blur-3xl"></div>
                <div class="relative z-10">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-4 sm:mb-6"><?php echo esc_html($cta_heading); ?></h2>
                    <p class="text-white/90 text-sm sm:text-base md:text-lg mb-6 sm:mb-8 max-w-2xl mx-auto">
                        <?php echo esc_html($cta_para); ?>
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center">
                        <a href="<?php echo $cta_btn1_url; ?>" target="<?php echo esc_attr($cta_btn1_target); ?>" class="px-4 sm:px-8 py-2 sm:py-4 text-sm sm:text-base bg-white text-[#3D348B] rounded-full font-bold hover:shadow-xl transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2 group">
                            <?php echo esc_html($cta_btn1_text); ?>
                            <i data-lucide="<?php echo esc_attr($cta_btn1_icon); ?>" class="size-4 sm:size-5 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        <a href="<?php echo $cta_btn2_url; ?>" target="<?php echo esc_attr($cta_btn2_target); ?>" class="px-4 sm:px-8 py-2 sm:py-4 text-sm sm:text-base bg-transparent border-2 border-white text-white rounded-full font-bold hover:bg-white/10 transition-all flex items-center justify-center gap-2 group">
                            <i data-lucide="<?php echo esc_attr($cta_btn2_icon); ?>" class="size-4 sm:size-5"></i>
                            <?php echo esc_html($cta_btn2_text); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    (function() {
        var searchInput = document.getElementById('search-input');
        var designationFilter = document.getElementById('designation-filter');
        var rows = document.querySelectorAll('.staff-row');
        function filterRows() {
            var q = (searchInput && searchInput.value) ? searchInput.value.toLowerCase().trim() : '';
            var desig = (designationFilter && designationFilter.value) ? designationFilter.value : '';
            var visible = 0;
            var pgtCount = 0;
            rows.forEach(function(tr) {
                var name = (tr.getAttribute('data-name') || '').toLowerCase();
                var subject = (tr.getAttribute('data-subject') || '').toLowerCase();
                var rowDesig = tr.getAttribute('data-designation') || '';
                var filterVal = tr.getAttribute('data-filter') || '';
                var matchSearch = !q || name.indexOf(q) !== -1 || subject.indexOf(q) !== -1 || rowDesig.toLowerCase().indexOf(q) !== -1;
                var matchDesig = !desig || filterVal === desig;
                var show = matchSearch && matchDesig;
                tr.style.display = show ? '' : 'none';
                if (show) {
                    visible++;
                    if (filterVal === 'PGT') pgtCount++;
                }
            });
            var totalEl = document.querySelector('[data-stat-total]');
            var pgtEl = document.querySelector('[data-stat-pgt]');
            if (totalEl) totalEl.textContent = visible;
            if (pgtEl) pgtEl.textContent = pgtCount;
        }
        if (searchInput) searchInput.addEventListener('input', filterRows);
        if (designationFilter) designationFilter.addEventListener('change', filterRows);
    })();
    </script>

<?php get_footer(); ?>
