<?php
/**
 * Template Name: Transfer Certificate Page
 * Transfer Certificate: Hero, Search form, Help & Guidelines, Results sidebar. UI matches transfer_certificate.html exactly.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge = $opt ? get_field('tc_hero_badge', $page_id) : null;
$hero_icon = $opt ? get_field('tc_hero_icon', $page_id) : null;
$hero_before = $opt ? get_field('tc_hero_headline_before', $page_id) : null;
$hero_highlight = $opt ? get_field('tc_hero_headline_highlight', $page_id) : null;
$hero_subtext = $opt ? get_field('tc_hero_subtext', $page_id) : null;

$hero_badge = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Student Documents';
$hero_icon = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'file-certificate';
$hero_before = ($hero_before !== '' && $hero_before !== null) ? (string) $hero_before : 'Transfer';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Certificate';
$hero_subtext = ($hero_subtext !== '' && $hero_subtext !== null) ? (string) $hero_subtext : 'Search and verify your Transfer Certificate using the unique serial number';

// ——— Search Form ———
$search_title = $opt ? get_field('tc_search_title', $page_id) : null;
$search_subtitle = $opt ? get_field('tc_search_subtitle', $page_id) : null;
$search_placeholder = $opt ? get_field('tc_search_placeholder', $page_id) : null;
$search_info_text = $opt ? get_field('tc_search_info_text', $page_id) : null;
$search_btn_text = $opt ? get_field('tc_search_btn_text', $page_id) : null;
$search_info_boxes = $opt ? get_field('tc_search_info_boxes', $page_id) : null;

$search_title = ($search_title !== '' && $search_title !== null) ? (string) $search_title : 'Search Your TC';
$search_subtitle = ($search_subtitle !== '' && $search_subtitle !== null) ? (string) $search_subtitle : 'Find your Transfer Certificate using the serial number';
$search_placeholder = ($search_placeholder !== '' && $search_placeholder !== null) ? (string) $search_placeholder : 'TC-2024-XXXXX';
$search_info_text = ($search_info_text !== '' && $search_info_text !== null) ? (string) $search_info_text : 'Format: TC-YEAR-NUMBER (Example: TC-2024-12345)';
$search_btn_text = ($search_btn_text !== '' && $search_btn_text !== null) ? (string) $search_btn_text : 'Search Certificate';

$default_info_boxes = array(
    array('icon' => 'shield-check', 'title' => 'Secure Search', 'subtitle' => 'Encrypted verification', 'style' => 'primary'),
    array('icon' => 'clock', 'title' => 'Instant Results', 'subtitle' => 'Real-time verification', 'style' => 'primary-light'),
    array('icon' => 'download', 'title' => 'Download', 'subtitle' => 'Available after verification', 'style' => 'accent'),
);
$search_info_boxes = (is_array($search_info_boxes) && !empty($search_info_boxes)) ? $search_info_boxes : $default_info_boxes;

// ——— Help & Guidelines ———
$help_title = $opt ? get_field('tc_help_title', $page_id) : null;
$help_paragraph = $opt ? get_field('tc_help_paragraph', $page_id) : null;
$help_phone = $opt ? get_field('tc_help_phone', $page_id) : null;
$guidelines_title = $opt ? get_field('tc_guidelines_title', $page_id) : null;
$guidelines_list = $opt ? get_field('tc_guidelines_list', $page_id) : null;

$help_title = ($help_title !== '' && $help_title !== null) ? (string) $help_title : 'Need Help?';
$help_paragraph = ($help_paragraph !== '' && $help_paragraph !== null) ? (string) $help_paragraph : "Can't find your serial number? Contact our administration office for assistance.";
$help_phone = ($help_phone !== '' && $help_phone !== null) ? (string) $help_phone : '+919672797979';
$guidelines_title = ($guidelines_title !== '' && $guidelines_title !== null) ? (string) $guidelines_title : 'TC Guidelines';

$default_guidelines = array(
    array('text' => 'Valid for 6 months from issue date'),
    array('text' => 'Required for new school admission'),
);
$guidelines_list = (is_array($guidelines_list) && !empty($guidelines_list)) ? $guidelines_list : $default_guidelines;

// ——— Results Sidebar ———
$results_title = $opt ? get_field('tc_results_title', $page_id) : null;
$results_initial_heading = $opt ? get_field('tc_results_initial_heading', $page_id) : null;
$results_initial_text = $opt ? get_field('tc_results_initial_text', $page_id) : null;
$results_loading_heading = $opt ? get_field('tc_results_loading_heading', $page_id) : null;
$results_loading_text = $opt ? get_field('tc_results_loading_text', $page_id) : null;
$results_error_heading = $opt ? get_field('tc_results_error_heading', $page_id) : null;
$results_error_text = $opt ? get_field('tc_results_error_text', $page_id) : null;
$results_important_notes = $opt ? get_field('tc_results_important_notes', $page_id) : null;
$stats_total = $opt ? get_field('tc_stats_total', $page_id) : null;
$stats_year = $opt ? get_field('tc_stats_year', $page_id) : null;

$results_title = ($results_title !== '' && $results_title !== null) ? (string) $results_title : 'Search Results';
$results_initial_heading = ($results_initial_heading !== '' && $results_initial_heading !== null) ? (string) $results_initial_heading : 'Search Transfer Certificate';
$results_initial_text = ($results_initial_text !== '' && $results_initial_text !== null) ? (string) $results_initial_text : 'Enter the serial number to verify and view your Transfer Certificate details';
$results_loading_heading = ($results_loading_heading !== '' && $results_loading_heading !== null) ? (string) $results_loading_heading : 'Searching...';
$results_loading_text = ($results_loading_text !== '' && $results_loading_text !== null) ? (string) $results_loading_text : 'Verifying your Transfer Certificate details';
$results_error_heading = ($results_error_heading !== '' && $results_error_heading !== null) ? (string) $results_error_heading : 'Certificate Not Found';
$results_error_text = ($results_error_text !== '' && $results_error_text !== null) ? (string) $results_error_text : 'Please check the serial number and try again';

$default_notes = array(
    array('text' => 'This document is valid for admission in other schools'),
    array('text' => 'Keep a copy for your records'),
);
$results_important_notes = (is_array($results_important_notes) && !empty($results_important_notes)) ? $results_important_notes : $default_notes;

$stats_total = ($stats_total !== '' && $stats_total !== null) ? (string) $stats_total : '2,500+';
$stats_year = ($stats_year !== '' && $stats_year !== null) ? (string) $stats_year : '450+';
?>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary via-primary-dark to-slate-900 text-white pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMiIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjA1KSIvPjwvc3ZnPg==')] opacity-20"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent/10 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-light/10 rounded-full blur-[100px]"></div>
        
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white text-xs sm:text-sm font-bold uppercase tracking-wider mb-6">
                <i data-lucide="<?php echo esc_attr($hero_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                <?php echo esc_html($hero_badge); ?>
            </div>
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold mb-4 sm:mb-6">
                <?php echo esc_html($hero_before); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-accent to-white"><?php echo esc_html($hero_highlight); ?></span>
            </h1>
            <p class="text-sm sm:text-base md:text-lg lg:text-xl text-white/90 max-w-3xl mx-auto leading-relaxed">
                <?php echo esc_html($hero_subtext); ?>
            </p>
        </div>
    </section>

    <!-- Transfer Certificate Section -->
    <section class="relative px-4 sm:px-6 lg:px-8 py-12 sm:py-16 md:py-24 bg-background-light overflow-x-hidden">
        <div class="absolute top-0 left-0 -z-10 h-full w-full overflow-hidden">
            <div class="absolute -top-40 -right-40 h-[500px] w-[500px] rounded-full bg-indigo-velvet/5 blur-[100px]"></div>
            <div class="absolute top-1/2 -left-20 h-[300px] w-[300px] rounded-full bg-amber-flame/10 blur-[80px]"></div>
        </div>
        
        <div class="mx-auto max-w-7xl w-full">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
                <!-- Search Form Card -->
                <div class="lg:col-span-2">
                    <div class="bg-gradient-to-br from-white to-primary/5 rounded-2xl sm:rounded-3xl p-6 sm:p-8 shadow-2xl border border-primary/20">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary to-primary-light flex items-center justify-center">
                                <i data-lucide="search" class="w-6 h-6 text-white"></i>
                            </div>
                            <div>
                                <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-primary"><?php echo esc_html($search_title); ?></h2>
                                <p class="text-xs sm:text-sm text-text-secondary-light mt-1"><?php echo esc_html($search_subtitle); ?></p>
                            </div>
                        </div>

                        <form class="myform space-y-6" onsubmit="return mlzsSubmitTCForm(event)">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <label for="tc_search_text" class="text-sm font-medium text-text-main-light">
                                        Enter Serial Number <span class="text-red-500">*</span>
                                    </label>
                                    <span class="text-xs text-text-secondary-light bg-primary/10 px-2 py-1 rounded">Required</span>
                                </div>
                                <div class="relative group">
                                    <i data-lucide="hash" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-text-secondary-light group-focus-within:text-primary transition-colors"></i>
                                    <input type="text" name="search_text" id="tc_search_text" required
                                           placeholder="<?php echo esc_attr($search_placeholder); ?>"
                                           class="w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-text-secondary-light"
                                           aria-label="Enter Transfer Certificate Serial Number">
                                    <div class="absolute right-3 top-1/2 -translate-y-1/2">
                                        <i data-lucide="help-circle" class="w-4 h-4 text-text-secondary-light cursor-help" title="Enter the unique serial number printed on your Transfer Certificate"></i>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 text-xs text-text-secondary-light">
                                    <i data-lucide="info" class="w-3 h-3"></i>
                                    <span><?php echo esc_html($search_info_text); ?></span>
                                </div>
                            </div>

                            <div class="pt-4">
                                <button type="submit" name="search"
                                        class="w-full px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-primary to-primary-dark text-white rounded-xl font-bold text-sm sm:text-base md:text-lg hover:shadow-[0_0_30px_rgba(61,52,139,0.4)] hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2 group/btn">
                                    <span><?php echo esc_html($search_btn_text); ?></span>
                                    <i data-lucide="search" class="w-4 h-4 sm:w-5 sm:h-5 group-hover/btn:scale-110 transition-transform"></i>
                                </button>
                            </div>

                            <div class="border-t border-border-light pt-6">
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <?php
                                    $info_style_classes = array(
                                        'primary'      => array('bg' => 'bg-primary/10', 'icon' => 'text-primary'),
                                        'primary-light' => array('bg' => 'bg-primary-light/10', 'icon' => 'text-primary-light'),
                                        'accent'       => array('bg' => 'bg-accent/10', 'icon' => 'text-accent'),
                                    );
                                    foreach ($search_info_boxes as $box) :
                                        $b_icon = isset($box['icon']) ? trim((string) $box['icon']) : 'shield-check';
                                        $b_title = isset($box['title']) ? (string) $box['title'] : '';
                                        $b_subtitle = isset($box['subtitle']) ? (string) $box['subtitle'] : '';
                                        $b_style = isset($box['style']) ? (string) $box['style'] : 'primary';
                                        $ic = isset($info_style_classes[$b_style]) ? $info_style_classes[$b_style] : $info_style_classes['primary'];
                                    ?>
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full <?php echo esc_attr($ic['bg']); ?> flex items-center justify-center">
                                            <i data-lucide="<?php echo esc_attr($b_icon); ?>" class="w-4 h-4 <?php echo esc_attr($ic['icon']); ?>"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-text-main-light"><?php echo esc_html($b_title); ?></h4>
                                            <p class="text-xs text-text-secondary-light"><?php echo esc_html($b_subtitle); ?></p>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Help & Guidelines -->
                    <div class="mt-6 sm:mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        <div class="bg-white rounded-xl p-4 sm:p-6 shadow-soft border border-border-light">
                            <div class="flex items-center gap-3 mb-3">
                                <i data-lucide="help-circle" class="w-5 h-5 text-primary"></i>
                                <h3 class="text-base sm:text-lg font-bold text-text-main-light"><?php echo esc_html($help_title); ?></h3>
                            </div>
                            <p class="text-xs sm:text-sm text-text-secondary-light mb-3"><?php echo esc_html($help_paragraph); ?></p>
                            <a href="tel:<?php echo esc_attr(str_replace(' ', '', $help_phone)); ?>" class="text-primary font-medium text-xs sm:text-sm hover:underline flex items-center gap-1">
                                <i data-lucide="phone" class="w-3 h-3"></i>
                                <?php echo esc_html($help_phone); ?>
                            </a>
                        </div>
                        <div class="bg-white rounded-xl p-4 sm:p-6 shadow-soft border border-border-light">
                            <div class="flex items-center gap-3 mb-3">
                                <i data-lucide="file-text" class="w-5 h-5 text-accent"></i>
                                <h3 class="text-base sm:text-lg font-bold text-text-main-light"><?php echo esc_html($guidelines_title); ?></h3>
                            </div>
                            <ul class="text-xs sm:text-sm text-text-secondary-light space-y-1">
                                <?php foreach ($guidelines_list as $g) :
                                    $g_text = isset($g['text']) ? (string) $g['text'] : '';
                                    if ($g_text === '') continue;
                                ?>
                                <li class="flex items-start gap-2">
                                    <i data-lucide="check" class="w-3 h-3 text-accent mt-0.5"></i>
                                    <span><?php echo esc_html($g_text); ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Results Display Area -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24">
                        <div class="bg-gradient-to-br from-primary/5 to-primary-light/5 rounded-2xl sm:rounded-3xl p-6 sm:p-8 shadow-2xl border border-primary/20">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary-light to-primary flex items-center justify-center">
                                    <i data-lucide="file-check" class="w-5 h-5 text-white"></i>
                                </div>
                                <h2 class="text-base sm:text-lg md:text-xl font-bold text-primary"><?php echo esc_html($results_title); ?></h2>
                            </div>

                            <div id="tc-result" class="space-y-4 min-h-[200px]">
                                <div class="text-center py-8" id="tc-initial-state">
                                    <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-primary/10 flex items-center justify-center mx-auto mb-4">
                                        <i data-lucide="file-search" class="w-6 h-6 sm:w-8 sm:h-8 text-primary"></i>
                                    </div>
                                    <h3 class="text-base sm:text-lg font-bold text-text-main-light mb-2"><?php echo esc_html($results_initial_heading); ?></h3>
                                    <p class="text-xs sm:text-sm text-text-secondary-light"><?php echo esc_html($results_initial_text); ?></p>
                                </div>

                                <div id="tc-loading-state" class="hidden text-center py-8">
                                    <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-primary/10 flex items-center justify-center mx-auto mb-4 animate-pulse">
                                        <i data-lucide="loader" class="w-6 h-6 sm:w-8 sm:h-8 text-primary animate-spin"></i>
                                    </div>
                                    <h3 class="text-base sm:text-lg font-bold text-text-main-light mb-2"><?php echo esc_html($results_loading_heading); ?></h3>
                                    <p class="text-xs sm:text-sm text-text-secondary-light"><?php echo esc_html($results_loading_text); ?></p>
                                </div>

                                <div id="tc-error-state" class="hidden text-center py-8">
                                    <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                                        <i data-lucide="alert-circle" class="w-6 h-6 sm:w-8 sm:h-8 text-red-500"></i>
                                    </div>
                                    <h3 class="text-base sm:text-lg font-bold text-text-main-light mb-2"><?php echo esc_html($results_error_heading); ?></h3>
                                    <p class="text-xs sm:text-sm text-text-secondary-light mb-4" id="tc-error-message"><?php echo esc_html($results_error_text); ?></p>
                                    <button type="button" onclick="mlzsResetTCSearch()" class="px-3 sm:px-4 py-2 bg-primary text-white rounded-lg text-xs sm:text-sm font-medium hover:bg-primary-dark transition-colors">Try Again</button>
                                </div>

                                <div id="tc-success-state" class="hidden space-y-4">
                                    <div class="bg-white rounded-xl p-4 border border-green-200">
                                        <div class="flex items-center gap-3 mb-3">
                                            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-green-100 flex items-center justify-center">
                                                <i data-lucide="check-circle" class="w-4 h-4 sm:w-5 sm:h-5 text-green-600"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-sm sm:text-base font-bold text-text-main-light">Certificate Verified</h3>
                                                <p class="text-xs text-green-600">Status: Valid</p>
                                            </div>
                                        </div>
                                        <div class="space-y-3">
                                            <div class="flex justify-between items-center">
                                                <span class="text-xs sm:text-sm text-text-secondary-light">Serial Number</span>
                                                <span class="font-mono text-xs sm:text-sm font-bold text-primary" id="tc-serial">TC-2024-12345</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-xs sm:text-sm text-text-secondary-light">Student Name</span>
                                                <span class="text-xs sm:text-sm font-medium text-text-main-light" id="tc-student">Aarav Sharma</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-xs sm:text-sm text-text-secondary-light">Class</span>
                                                <span class="text-xs sm:text-sm font-medium text-text-main-light" id="tc-class">XII Science</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-xs sm:text-sm text-text-secondary-light">Issue Date</span>
                                                <span class="text-xs sm:text-sm font-medium text-text-main-light" id="tc-issue">15-05-2024</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-xs sm:text-sm text-text-secondary-light">Valid Until</span>
                                                <span class="text-xs sm:text-sm font-medium text-text-main-light" id="tc-valid">14-11-2024</span>
                                            </div>
                                        </div>
                                        <div class="mt-4 pt-4 border-t border-border-light">
                                            <div class="flex gap-2">
                                                <button type="button" onclick="mlzsDownloadTC()" class="flex-1 px-2 sm:px-3 py-2 bg-primary text-white rounded-lg text-xs sm:text-sm font-medium hover:bg-primary-dark transition-colors flex items-center justify-center gap-2">
                                                    <i data-lucide="download" class="w-3 h-3 sm:w-4 sm:h-4"></i> Download
                                                </button>
                                                <button type="button" onclick="mlzsPrintTC()" class="flex-1 px-2 sm:px-3 py-2 bg-white border border-primary text-primary rounded-lg text-xs sm:text-sm font-medium hover:bg-primary/5 transition-colors flex items-center justify-center gap-2">
                                                    <i data-lucide="printer" class="w-3 h-3 sm:w-4 sm:h-4"></i> Print
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gradient-to-r from-primary/5 to-primary-light/5 rounded-xl p-4 border border-primary/20">
                                        <h4 class="font-bold text-text-main-light mb-2 text-sm">Important Notes</h4>
                                        <ul class="text-xs text-text-secondary-light space-y-1">
                                            <?php foreach ($results_important_notes as $note) :
                                                $n_text = isset($note['text']) ? (string) $note['text'] : '';
                                                if ($n_text === '') continue;
                                            ?>
                                            <li class="flex items-start gap-2">
                                                <i data-lucide="alert-circle" class="w-3 h-3 text-primary mt-0.5"></i>
                                                <span><?php echo esc_html($n_text); ?></span>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 pt-6 border-t border-primary/20">
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="text-center">
                                        <div class="text-lg sm:text-xl md:text-2xl font-bold text-primary mb-1" id="tc-total-issued"><?php echo esc_html($stats_total); ?></div>
                                        <div class="text-xs text-text-secondary-light">TCs Issued</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-lg sm:text-xl md:text-2xl font-bold text-accent mb-1" id="tc-current-year"><?php echo esc_html($stats_year); ?></div>
                                        <div class="text-xs text-text-secondary-light">This Year</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script>
(function() {
    if (typeof window.mlzsSubmitTCForm === 'function') return;
    window.mlzsSubmitTCForm = function(event) {
        event.preventDefault();
        var searchText = document.getElementById('tc_search_text').value.trim();
        if (!searchText) {
            mlzsShowTCError("Please enter a serial number");
            return false;
        }
        mlzsShowTCLoading();
        setTimeout(function() {
            if (searchText.toLowerCase().indexOf('tc-2024') !== -1 || searchText.toLowerCase().indexOf('demo') !== -1) {
                mlzsShowTCSuccess(searchText);
            } else {
                mlzsShowTCError("Transfer Certificate not found. Please check the serial number.");
            }
        }, 1500);
        return false;
    };
    window.mlzsShowTCLoading = function() {
        document.getElementById('tc-initial-state').classList.add('hidden');
        document.getElementById('tc-loading-state').classList.remove('hidden');
        document.getElementById('tc-error-state').classList.add('hidden');
        document.getElementById('tc-success-state').classList.add('hidden');
    };
    window.mlzsShowTCSuccess = function(serialNumber) {
        document.getElementById('tc-initial-state').classList.add('hidden');
        document.getElementById('tc-loading-state').classList.add('hidden');
        document.getElementById('tc-error-state').classList.add('hidden');
        document.getElementById('tc-success-state').classList.remove('hidden');
        document.getElementById('tc-serial').textContent = serialNumber;
        var names = ["Aarav Sharma", "Vihaan Patel", "Aditya Singh", "Ananya Gupta", "Diya Kumar"];
        var classes = ["X Science", "XII Commerce", "XI Humanities", "IX", "VIII"];
        var randomName = names[Math.floor(Math.random() * names.length)];
        var randomClass = classes[Math.floor(Math.random() * classes.length)];
        var issueDate = new Date();
        var validDate = new Date(issueDate);
        validDate.setMonth(validDate.getMonth() + 6);
        var fmt = function(d) { return d.toLocaleDateString('en-IN', { day: '2-digit', month: '2-digit', year: 'numeric' }); };
        document.getElementById('tc-student').textContent = randomName;
        document.getElementById('tc-class').textContent = randomClass;
        document.getElementById('tc-issue').textContent = fmt(issueDate);
        document.getElementById('tc-valid').textContent = fmt(validDate);
        if (typeof lucide !== 'undefined' && lucide.createIcons) lucide.createIcons();
    };
    window.mlzsShowTCError = function(message) {
        document.getElementById('tc-initial-state').classList.add('hidden');
        document.getElementById('tc-loading-state').classList.add('hidden');
        document.getElementById('tc-error-state').classList.remove('hidden');
        document.getElementById('tc-success-state').classList.add('hidden');
        var el = document.getElementById('tc-error-message');
        if (el && message) el.textContent = message;
    };
    window.mlzsResetTCSearch = function() {
        document.getElementById('tc_search_text').value = '';
        document.getElementById('tc-initial-state').classList.remove('hidden');
        document.getElementById('tc-loading-state').classList.add('hidden');
        document.getElementById('tc-error-state').classList.add('hidden');
        document.getElementById('tc-success-state').classList.add('hidden');
    };
    window.mlzsDownloadTC = function() { alert("Download functionality would be implemented in production"); };
    window.mlzsPrintTC = function() { alert("Print functionality would be implemented in production"); };
    document.addEventListener('DOMContentLoaded', function() {
        var totalEl = document.getElementById('tc-total-issued');
        var yearEl = document.getElementById('tc-current-year');
        if (totalEl && yearEl) {
            [totalEl, yearEl].forEach(function(el) {
                var finalVal = el.textContent;
                var num = parseInt(finalVal.replace(/[^0-9]/g, ''), 10) || 0;
                var suffix = finalVal.indexOf('+') !== -1 ? '+' : '';
                el.textContent = '0' + suffix;
                var cur = 0;
                var inc = Math.max(1, Math.floor(num / 50));
                var t = setInterval(function() {
                    cur += inc;
                    if (cur >= num) { el.textContent = finalVal; clearInterval(t); }
                    else { el.textContent = Math.floor(cur) + suffix; }
                }, 30);
            });
        }
    });
})();
</script>

<?php get_footer(); ?>
