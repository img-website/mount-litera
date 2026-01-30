<?php
/**
 * Template Name: Non-Teaching Staff Page
 * Non-teach: Hero (stats 3, buttons), Staff Table (repeater), CTA – ACF dynamic
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge   = $opt ? get_field('nonteach_hero_badge', $page_id) : null;
$hero_before  = $opt ? get_field('nonteach_hero_headline_before', $page_id) : null;
$hero_highlight = $opt ? get_field('nonteach_hero_headline_highlight', $page_id) : null;
$hero_para    = $opt ? get_field('nonteach_hero_paragraph', $page_id) : null;
$hero_btn1_link = $opt ? get_field('nonteach_hero_btn1_link', $page_id) : null;
$hero_btn1_icon = $opt ? get_field('nonteach_hero_btn1_icon', $page_id) : null;
$hero_btn2_link = $opt ? get_field('nonteach_hero_btn2_link', $page_id) : null;
$hero_btn2_icon = $opt ? get_field('nonteach_hero_btn2_icon', $page_id) : null;
$hero_stats   = $opt ? get_field('nonteach_hero_stats', $page_id) : null;

$hero_badge   = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Support Team';
$hero_before  = ($hero_before !== '' && $hero_before !== null) ? (string) $hero_before : 'Meet Our';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Non-Teaching Staff';
$hero_para    = ($hero_para !== '' && $hero_para !== null) ? (string) $hero_para : 'Our dedicated administrative and support team ensures smooth operations and provides essential services to create a seamless learning environment for our students and educators.';
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
    array('icon' => 'users', 'number' => '11', 'label' => 'Support Staff'),
    array('icon' => 'briefcase', 'number' => '8+', 'label' => 'Departments'),
    array('icon' => 'heart', 'number' => '24/7', 'label' => 'Support Available'),
);
$hero_stats = (is_array($hero_stats) && count($hero_stats) >= 3) ? $hero_stats : $default_hero_stats;

// ——— Table ———
$search_placeholder = $opt ? get_field('nonteach_search_placeholder', $page_id) : null;
$table_heading = $opt ? get_field('nonteach_table_heading', $page_id) : null;
$table_subtext = $opt ? get_field('nonteach_table_subtext', $page_id) : null;
$table_stat_total_label = $opt ? get_field('nonteach_table_stat_total_label', $page_id) : null;
$table_stat_admin_label = $opt ? get_field('nonteach_table_stat_admin_label', $page_id) : null;
$table_stat_support_label = $opt ? get_field('nonteach_table_stat_support_label', $page_id) : null;
$staff_rows = $opt ? get_field('nonteach_staff_rows', $page_id) : null;

$search_placeholder = ($search_placeholder !== '' && $search_placeholder !== null) ? (string) $search_placeholder : 'Search...';
$table_heading = ($table_heading !== '' && $table_heading !== null) ? (string) $table_heading : 'Non-Teaching Staff Directory';
$table_subtext = ($table_subtext !== '' && $table_subtext !== null) ? (string) $table_subtext : 'Complete list of our administrative and support staff with their designations';
$table_stat_total_label = ($table_stat_total_label !== '' && $table_stat_total_label !== null) ? (string) $table_stat_total_label : 'Total Staff';
$table_stat_admin_label = ($table_stat_admin_label !== '' && $table_stat_admin_label !== null) ? (string) $table_stat_admin_label : 'Administrative';
$table_stat_support_label = ($table_stat_support_label !== '' && $table_stat_support_label !== null) ? (string) $table_stat_support_label : 'Support Staff';

$default_staff = array(
    array('name' => 'MR. ABHISHEK SRIVASTVA', 'designation' => 'PRINCIPAL'),
    array('name' => 'Ms. SHABDIKA DATA', 'designation' => 'Executive Head'),
    array('name' => 'MR. DEEPENDRA CHOUDHARY', 'designation' => 'ADMIN INCHARGE'),
    array('name' => 'MR. GAJENDRA KUMAR SHARMA', 'designation' => 'IT-EXECUTIVE'),
    array('name' => 'MR. SURENDRA LAKHERA', 'designation' => 'ACCOUNTANT'),
    array('name' => 'MR. RAVINDAR KUMAR', 'designation' => 'TRANSPORT INCHARGE'),
    array('name' => 'MR. ASHISH TANEJA', 'designation' => 'EXAMINATION CONTROLLER'),
    array('name' => 'MRS. POOJA DUBEY', 'designation' => 'COUNSELLOR'),
    array('name' => 'MR. KAPIL KUMAR', 'designation' => 'STORE INCHARGE'),
    array('name' => 'MR. MUKESH KACHERA', 'designation' => 'IT EXEC.'),
    array('name' => 'MRS. ANAMIKA SHARMA', 'designation' => 'NURSING STAFF'),
);
$staff_rows = is_array($staff_rows) && !empty($staff_rows) ? $staff_rows : $default_staff;

// Stat numbers calculated from staff table (no separate CMS fields needed)
$table_stat_total = count($staff_rows);
$admin_designations = array('PRINCIPAL', 'Executive Head', 'ADMIN INCHARGE', 'INCHARGE', 'CONTROLLER', 'ACCOUNTANT', 'TRANSPORT INCHARGE', 'EXAMINATION CONTROLLER', 'STORE INCHARGE');
$table_stat_admin = 0;
foreach ($staff_rows as $row) {
    $d = isset($row['designation']) ? (string) $row['designation'] : '';
    foreach ($admin_designations as $ad) {
        if (stripos($d, $ad) !== false || $d === $ad) {
            $table_stat_admin++;
            break;
        }
    }
}
$table_stat_support = max(0, $table_stat_total - $table_stat_admin);

// ——— CTA ———
$cta_heading = $opt ? get_field('nonteach_cta_heading', $page_id) : null;
$cta_para    = $opt ? get_field('nonteach_cta_paragraph', $page_id) : null;
$cta_btn1_link = $opt ? get_field('nonteach_cta_btn1_link', $page_id) : null;
$cta_btn1_icon = $opt ? get_field('nonteach_cta_btn1_icon', $page_id) : null;
$cta_btn2_link = $opt ? get_field('nonteach_cta_btn2_link', $page_id) : null;
$cta_btn2_icon = $opt ? get_field('nonteach_cta_btn2_icon', $page_id) : null;

$cta_heading = ($cta_heading !== '' && $cta_heading !== null) ? (string) $cta_heading : 'Join Our Support Team';
$cta_para    = ($cta_para !== '' && $cta_para !== null) ? (string) $cta_para : 'Are you looking for an opportunity to contribute to education? We\'re always looking for dedicated professionals to join our administrative and support team.';
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
?>

    <!-- Hero Section (colors match nonteach.html exactly) -->
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
                    <?php foreach ($hero_stats as $s) :
                        $s_icon = isset($s['icon']) ? trim((string) $s['icon']) : 'users';
                        $s_num = isset($s['number']) ? (string) $s['number'] : '';
                        $s_lab = isset($s['label']) ? (string) $s['label'] : '';
                        // Colors exactly as nonteach.html: users → #F7B801, briefcase → #7678ED, heart → #F35B04
                        if ($s_icon === 'briefcase') {
                            $s_color = 'text-[#7678ED]';
                            $s_bg = 'bg-[#7678ED]/20';
                        } elseif ($s_icon === 'heart') {
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

    <!-- Staff Table Section -->
    <section id="staff-table" class="px-4 sm:px-6 lg:px-8 py-12 sm:py-16 md:py-24 bg-white scroll-mt-24">
        <div class="max-w-7xl mx-auto w-full">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 md:gap-6 mb-8 md:mb-12">
                <div class="mb-4 md:mb-0">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-2 md:mb-3"><?php echo esc_html($table_heading); ?></h2>
                    <p class="text-sm sm:text-base text-gray-600"><?php echo esc_html($table_subtext); ?></p>
                </div>
                <div class="relative group flex-1 sm:flex-initial sm:w-auto max-w-sm md:max-w-none">
                    <i data-lucide="search" class="absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 size-4 sm:size-5 text-gray-400 group-focus-within:text-[#3D348B] transition-colors"></i>
                    <input type="text" id="search-input" placeholder="<?php echo esc_attr($search_placeholder); ?>" class="pl-10 sm:pl-12 pr-4 py-2.5 sm:py-3 text-sm sm:text-base rounded-full border border-gray-300 focus:border-[#3D348B] focus:ring-2 focus:ring-[#3D348B]/20 transition-all w-full sm:w-56 md:w-64">
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4 mb-6 md:mb-8">
                <div class="bg-gradient-to-br from-[#3D348B]/10 to-transparent rounded-xl p-3 sm:p-4 border border-[#3D348B]/20">
                    <p class="text-xs sm:text-sm text-gray-600 mb-1"><?php echo esc_html($table_stat_total_label); ?></p>
                    <p class="text-xl sm:text-2xl font-bold text-[#3D348B]"><?php echo esc_html($table_stat_total); ?></p>
                </div>
                <div class="bg-gradient-to-br from-[#F7B801]/10 to-transparent rounded-xl p-3 sm:p-4 border border-[#F7B801]/20">
                    <p class="text-xs sm:text-sm text-gray-600 mb-1"><?php echo esc_html($table_stat_admin_label); ?></p>
                    <p class="text-xl sm:text-2xl font-bold text-[#F7B801]"><?php echo esc_html($table_stat_admin); ?></p>
                </div>
                <div class="bg-gradient-to-br from-[#7678ED]/10 to-transparent rounded-xl p-3 sm:p-4 border border-[#7678ED]/20 col-span-2 md:col-span-1">
                    <p class="text-xs sm:text-sm text-gray-600 mb-1"><?php echo esc_html($table_stat_support_label); ?></p>
                    <p class="text-xl sm:text-2xl font-bold text-[#7678ED]"><?php echo esc_html($table_stat_support); ?></p>
                </div>
            </div>
            <div class="table-container overflow-x-auto rounded-2xl border border-gray-200 shadow-lg">
                <table class="min-w-full divide-y divide-gray-200 staff-table">
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
                            <th scope="col" class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 text-left text-[10px] sm:text-xs font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center gap-1 sm:gap-2">
                                    <i data-lucide="award" class="size-3 sm:size-4"></i>
                                    <span class="hidden md:inline">Designation</span>
                                    <span class="md:hidden">Design.</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($staff_rows as $i => $row) :
                            $s_no = $i + 1;
                            $name = isset($row['name']) ? (string) $row['name'] : '';
                            $desig = isset($row['designation']) ? (string) $row['designation'] : '';
                            if ($name === '' && $desig === '') continue;
                            // Badge colors exactly as nonteach.html: PRINCIPAL/Executive → #3D348B, ADMIN/INCHARGE/CONTROLLER/ACCOUNTANT → #F7B801, IT/EXECUTIVE/EXEC → #7678ED, COUNSELLOR/NURSING → #F35B04, else gray
                            if (stripos($desig, 'PRINCIPAL') !== false || stripos($desig, 'Executive Head') !== false) {
                                $badge_class = 'bg-[#3D348B]/10 text-[#3D348B]';
                            } elseif (stripos($desig, 'ADMIN') !== false || stripos($desig, 'INCHARGE') !== false || stripos($desig, 'CONTROLLER') !== false || stripos($desig, 'ACCOUNTANT') !== false) {
                                $badge_class = 'bg-[#F7B801]/10 text-[#F7B801]';
                            } elseif (stripos($desig, 'IT') !== false || stripos($desig, 'EXECUTIVE') !== false || stripos($desig, 'EXEC') !== false) {
                                $badge_class = 'bg-[#7678ED]/10 text-[#7678ED]';
                            } elseif (stripos($desig, 'COUNSELLOR') !== false || stripos($desig, 'NURSING') !== false) {
                                $badge_class = 'bg-[#F35B04]/10 text-[#F35B04]';
                            } else {
                                $badge_class = 'bg-gray-100 text-gray-700';
                            }
                        ?>
                        <tr class="staff-row hover:bg-gray-50 transition-colors">
                            <td class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 text-sm font-medium text-gray-900"><?php echo (int) $s_no; ?></td>
                            <td class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 text-sm font-medium text-gray-900 staff-name"><?php echo esc_html($name); ?></td>
                            <td class="px-3 sm:px-4 md:px-6 py-3 sm:py-4">
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium <?php echo esc_attr($badge_class); ?> staff-designation"><?php echo esc_html($desig); ?></span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
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
                        <a href="<?php echo $cta_btn1_url; ?>" target="<?php echo esc_attr($cta_btn1_target); ?>" class="px-4 sm:px-8 py-2 sm:py-4 text-sm sm:text-base bg-white text-primary rounded-full font-bold hover:shadow-xl transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2 group">
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
        var rows = document.querySelectorAll('.staff-row');
        if (searchInput && rows.length) {
            searchInput.addEventListener('input', function() {
                var q = (this.value || '').toLowerCase().trim();
                rows.forEach(function(tr) {
                    var name = (tr.querySelector('.staff-name') && tr.querySelector('.staff-name').textContent) || '';
                    var desig = (tr.querySelector('.staff-designation') && tr.querySelector('.staff-designation').textContent) || '';
                    var show = !q || name.toLowerCase().indexOf(q) !== -1 || desig.toLowerCase().indexOf(q) !== -1;
                    tr.style.display = show ? '' : 'none';
                });
            });
        }
    })();
    </script>

<?php get_footer(); ?>
