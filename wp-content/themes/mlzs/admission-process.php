<?php
/**
 * Template Name: Admission Process Page
 * Admission Process: Hero, Process Steps, Entry Criteria, Documents, Registration Form (ACF dynamic)
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$home_url = home_url('/');
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge   = $opt ? get_field('admission_hero_badge', $page_id) : null;
$hero_icon    = $opt ? get_field('admission_hero_badge_icon', $page_id) : null;
$hero_headline = $opt ? get_field('admission_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('admission_hero_highlight', $page_id) : null;
$hero_sub     = $opt ? get_field('admission_hero_subheadline', $page_id) : null;

$hero_badge    = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Join Our Community';
$hero_icon     = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'user-plus';
$hero_headline = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'Admission';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Process';
$hero_sub      = ($hero_sub !== '' && $hero_sub !== null) ? (string) $hero_sub : 'A seamless and transparent admission process to welcome your child into our learning community';

// ——— Process Steps ———
$process_heading = $opt ? get_field('admission_process_heading', $page_id) : null;
$process_icon    = $opt ? get_field('admission_process_icon', $page_id) : null;
$process_steps   = $opt ? get_field('admission_process_steps', $page_id) : null;
$process_cta     = $opt ? get_field('admission_process_cta', $page_id) : null;
$process_cta_icon = $opt ? get_field('admission_process_cta_icon', $page_id) : null;
$_process_img    = $opt ? get_field('admission_process_image', $page_id) : null;
$process_img_cap = $opt ? get_field('admission_process_image_caption', $page_id) : null;

$process_heading = ($process_heading !== '' && $process_heading !== null) ? (string) $process_heading : 'Admission Process';
$process_icon    = (is_string($process_icon) && trim($process_icon) !== '') ? trim($process_icon) : 'clipboard-list';
$default_steps   = array(
    array('step_text' => 'Parents are required to fill the Enquiry form online or offline.'),
    array('step_text' => 'Take the preferred visit date.'),
    array('step_text' => 'Take the Registration/Admission form with interaction/test date.'),
    array('step_text' => 'The Registration/admission form is accepted along with the documents and fees.'),
    array('step_text' => 'Mode of payment of fees shall be in Cheque / Cash / UPI / NEFT.'),
);
$process_steps   = (is_array($process_steps) && !empty($process_steps)) ? $process_steps : $default_steps;
$process_cta     = (is_array($process_cta) && !empty($process_cta['url'])) ? $process_cta : array('url' => $home_url . '#registration-form', 'title' => 'Start Admission Process', 'target' => '');
$process_cta_icon = (is_string($process_cta_icon) && trim($process_cta_icon) !== '') ? trim($process_cta_icon) : 'arrow-down';
$process_img = '';
if (is_array($_process_img) && !empty($_process_img['url'])) $process_img = (string) $_process_img['url'];
elseif (is_string($_process_img) && $_process_img !== '') $process_img = (string) $_process_img;
if ($process_img === '') $process_img = 'https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=2070&auto=format&fit=crop';
$process_img_cap = ($process_img_cap !== '' && $process_img_cap !== null) ? (string) $process_img_cap : 'Seamless Admission Journey';

// ——— Entry Criteria ———
$entry_heading = $opt ? get_field('admission_entry_heading', $page_id) : null;
$entry_icon    = $opt ? get_field('admission_entry_icon', $page_id) : null;
$entry_intro   = $opt ? get_field('admission_entry_intro', $page_id) : null;
$entry_criteria = $opt ? get_field('admission_entry_criteria', $page_id) : null;
$_entry_img    = $opt ? get_field('admission_entry_image', $page_id) : null;
$entry_img_cap = $opt ? get_field('admission_entry_image_caption', $page_id) : null;

$entry_heading = ($entry_heading !== '' && $entry_heading !== null) ? (string) $entry_heading : 'Entry Criteria for Admission';
$entry_icon    = (is_string($entry_icon) && trim($entry_icon) !== '') ? trim($entry_icon) : 'target';
$entry_intro   = ($entry_intro !== '' && $entry_intro !== null) ? (string) $entry_intro : 'Admissions are granted to students on the basis of the following assessments:';
$default_criteria = array(
    array('label' => 'Grade 1:', 'description' => 'age 5+ as on April 1'),
    array('label' => 'Grade 2 onwards:', 'description' => 'Followed by written test'),
    array('label' => 'Entrance test', 'description' => 'is based on previous class syllabus.'),
    array('label' => 'Internal transfers:', 'description' => 'Students of Mount Litera Zee School need not required to give any entrance test or assessment.'),
);
$entry_criteria = (is_array($entry_criteria) && !empty($entry_criteria)) ? $entry_criteria : $default_criteria;
$entry_img = '';
if (is_array($_entry_img) && !empty($_entry_img['url'])) $entry_img = (string) $_entry_img['url'];
elseif (is_string($_entry_img) && $_entry_img !== '') $entry_img = (string) $_entry_img;
if ($entry_img === '') $entry_img = 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=2022&auto=format&fit=crop';
$entry_img_cap = ($entry_img_cap !== '' && $entry_img_cap !== null) ? (string) $entry_img_cap : 'Clear Entry Guidelines';

// ——— Documents ———
$docs_heading = $opt ? get_field('admission_docs_heading', $page_id) : null;
$docs_icon    = $opt ? get_field('admission_docs_icon', $page_id) : null;
$docs_intro   = $opt ? get_field('admission_docs_intro', $page_id) : null;
$docs_items   = $opt ? get_field('admission_docs_items', $page_id) : null;
$_docs_img   = $opt ? get_field('admission_docs_image', $page_id) : null;
$docs_img_cap = $opt ? get_field('admission_docs_image_caption', $page_id) : null;

$docs_heading = ($docs_heading !== '' && $docs_heading !== null) ? (string) $docs_heading : 'Documents Required';
$docs_icon    = (is_string($docs_icon) && trim($docs_icon) !== '') ? trim($docs_icon) : 'folder-open';
$docs_intro   = ($docs_intro !== '' && $docs_intro !== null) ? (string) $docs_intro : 'Documents to be submitted at the time of admission:';
$default_docs = array(
    array('icon' => 'file-text', 'title' => 'Birth Certificate', 'description' => 'Issued by Govt. Authority'),
    array('icon' => 'award', 'title' => 'Progress Card', 'description' => 'Previous academic year'),
    array('icon' => 'school', 'title' => 'Leaving Certificate', 'description' => 'From previous school'),
    array('icon' => 'home', 'title' => 'Residence Proof', 'description' => 'Valid address proof'),
    array('icon' => 'camera', 'title' => 'Passport Size Photographs', 'description' => 'Child, mother & father (2 each)'),
);
$docs_items = (is_array($docs_items) && !empty($docs_items)) ? $docs_items : $default_docs;
$docs_img = '';
if (is_array($_docs_img) && !empty($_docs_img['url'])) $docs_img = (string) $_docs_img['url'];
elseif (is_string($_docs_img) && $_docs_img !== '') $docs_img = (string) $_docs_img;
if ($docs_img === '') $docs_img = 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?q=80&w=2070&auto=format&fit=crop';
$docs_img_cap = ($docs_img_cap !== '' && $docs_img_cap !== null) ? (string) $docs_img_cap : 'Required Documentation';

// ——— Form Section ———
$form_badge   = $opt ? get_field('admission_form_badge', $page_id) : null;
$form_badge_icon = $opt ? get_field('admission_form_badge_icon', $page_id) : null;
$form_heading = $opt ? get_field('admission_form_heading', $page_id) : null;
$form_desc    = $opt ? get_field('admission_form_description', $page_id) : null;
$form_submit  = $opt ? get_field('admission_form_submit_text', $page_id) : null;
$form_terms   = $opt ? get_field('admission_form_terms_text', $page_id) : null;

$form_badge   = ($form_badge !== '' && $form_badge !== null) ? (string) $form_badge : 'Online Registration';
$form_badge_icon = (is_string($form_badge_icon) && trim($form_badge_icon) !== '') ? trim($form_badge_icon) : 'edit-3';
$form_heading = ($form_heading !== '' && $form_heading !== null) ? (string) $form_heading : 'Registration Form';
$form_desc    = ($form_desc !== '' && $form_desc !== null) ? (string) $form_desc : "Fill in the details below to begin your child's admission journey with us";
$form_submit  = ($form_submit !== '' && $form_submit !== null) ? (string) $form_submit : 'Submit Registration Form';
$form_terms   = ($form_terms !== '' && $form_terms !== null) ? (string) $form_terms : 'By submitting this form, you agree to our terms and conditions.';
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
                <?php echo esc_html($hero_headline); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-accent to-white"><?php echo esc_html($hero_highlight); ?></span>
            </h1>
            <p class="text-sm sm:text-base md:text-lg lg:text-xl text-white/90 max-w-3xl mx-auto leading-relaxed">
                <?php echo esc_html($hero_sub); ?>
            </p>
        </div>
    </section>

    <!-- Admissions Process Section -->
    <section class="relative px-4 sm:px-6 lg:px-8 py-12 sm:py-16 md:py-24 bg-background-light overflow-x-hidden">
        <div class="absolute top-0 left-0 -z-10 h-full w-full overflow-hidden">
            <div class="absolute -top-40 -right-40 h-[500px] w-[500px] rounded-full bg-indigo-velvet/5 blur-[100px]"></div>
            <div class="absolute top-1/2 -left-20 h-[300px] w-[300px] rounded-full bg-amber-flame/10 blur-[80px]"></div>
        </div>
        <div class="mx-auto max-w-7xl w-full">

            <!-- Process Steps -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center mb-16 sm:mb-20">
                <div class="order-2 lg:order-1">
                    <div class="bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 shadow-soft border border-border-light">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary to-primary-light flex items-center justify-center">
                                <i data-lucide="<?php echo esc_attr($process_icon); ?>" class="w-6 h-6 text-white"></i>
                            </div>
                            <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-primary"><?php echo esc_html($process_heading); ?></h2>
                        </div>
                        <div class="space-y-4 sm:space-y-5">
                            <?php foreach ($process_steps as $num => $step) : $step_text = isset($step['step_text']) ? (string) $step['step_text'] : ''; if ($step_text === '') continue; ?>
                            <div class="flex items-center gap-3 group">
                                <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center shrink-0 mt-1 group-hover:bg-primary group-hover:text-white transition-colors">
                                    <span class="text-sm font-bold text-primary group-hover:text-white"><?php echo (int) ($num + 1); ?></span>
                                </div>
                                <p class="text-sm text-text-secondary-light"><?php echo esc_html($step_text); ?></p>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="mt-8 pt-6 border-t border-border-light">
                            <a href="<?php echo esc_url($process_cta['url']); ?>"<?php echo !empty($process_cta['target']) ? ' target="' . esc_attr($process_cta['target']) . '"' : ''; ?> class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary text-white rounded-lg text-sm sm:text-base font-medium hover:bg-primary-dark transition-colors group/btn">
                                <span><?php echo esc_html(isset($process_cta['title']) ? $process_cta['title'] : 'Start Admission Process'); ?></span>
                                <i data-lucide="<?php echo esc_attr($process_cta_icon); ?>" class="w-4 h-4 group-hover/btn:translate-y-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="relative rounded-2xl sm:rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
                        <img src="<?php echo esc_url($process_img); ?>" alt="<?php echo esc_attr($process_img_cap); ?>" class="w-full h-auto object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-primary/90 to-transparent text-white">
                            <h3 class="text-base sm:text-lg font-bold"><?php echo esc_html($process_img_cap); ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Entry Criteria Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center mb-16 sm:mb-20">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl sm:rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
                        <img src="<?php echo esc_url($entry_img); ?>" alt="<?php echo esc_attr($entry_img_cap); ?>" class="w-full h-auto object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-accent/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-accent/90 to-transparent text-white">
                            <h3 class="text-base sm:text-lg font-bold"><?php echo esc_html($entry_img_cap); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="bg-gradient-to-br from-accent/5 to-accent-dark/5 rounded-2xl sm:rounded-3xl p-6 sm:p-8 shadow-soft border border-accent/20">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-accent to-accent-dark flex items-center justify-center">
                                <i data-lucide="<?php echo esc_attr($entry_icon); ?>" class="w-6 h-6 text-white"></i>
                            </div>
                            <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-accent-dark"><?php echo esc_html($entry_heading); ?></h2>
                        </div>
                        <p class="text-sm text-text-secondary-light mb-6"><?php echo esc_html($entry_intro); ?></p>
                        <div class="space-y-4">
                            <?php foreach ($entry_criteria as $item) : $lbl = isset($item['label']) ? (string) $item['label'] : ''; $desc = isset($item['description']) ? (string) $item['description'] : ''; ?>
                            <div class="flex items-center gap-3 group">
                                <div class="w-6 h-6 rounded-full bg-accent/10 flex items-center justify-center shrink-0 mt-1 group-hover:bg-accent group-hover:text-white transition-colors">
                                    <i data-lucide="check" class="w-3 h-3 text-accent group-hover:text-white"></i>
                                </div>
                                <p class="text-sm text-text-secondary-light">
                                    <?php if ($lbl !== '') : ?><span class="font-semibold text-text-main-light"><?php echo esc_html($lbl); ?></span> <?php endif; ?><?php echo esc_html($desc); ?>
                                </p>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documents Required Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center mb-16 sm:mb-20">
                <div class="order-2 lg:order-1">
                    <div class="bg-gradient-to-br from-primary-light/5 to-primary/5 rounded-2xl sm:rounded-3xl p-6 sm:p-8 shadow-soft border border-primary-light/20">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-light to-primary flex items-center justify-center">
                                <i data-lucide="<?php echo esc_attr($docs_icon); ?>" class="w-6 h-6 text-white"></i>
                            </div>
                            <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-primary"><?php echo esc_html($docs_heading); ?></h2>
                        </div>
                        <p class="text-sm text-text-secondary-light mb-6"><?php echo esc_html($docs_intro); ?></p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <?php
                            $doc_items = $docs_items;
                            $last_idx = count($doc_items) - 1;
                            foreach ($doc_items as $dix => $doc) :
                                $d_icon = isset($doc['icon']) && trim((string) $doc['icon']) !== '' ? trim((string) $doc['icon']) : 'file-text';
                                $d_title = isset($doc['title']) ? (string) $doc['title'] : '';
                                $d_desc  = isset($doc['description']) ? (string) $doc['description'] : '';
                                $span2 = ($dix === $last_idx && count($doc_items) % 2 === 1) ? ' sm:col-span-2' : '';
                            ?>
                            <div class="flex items-center gap-3 group<?php echo esc_attr($span2); ?>">
                                <div class="w-8 h-8 rounded-full bg-primary-light/10 flex items-center justify-center shrink-0 mt-1">
                                    <i data-lucide="<?php echo esc_attr($d_icon); ?>" class="w-4 h-4 text-primary-light"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-sm sm:text-base text-text-main-light mb-1"><?php echo esc_html($d_title); ?></h4>
                                    <p class="text-xs sm:text-sm text-text-secondary-light"><?php echo esc_html($d_desc); ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="relative rounded-2xl sm:rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
                        <img src="<?php echo esc_url($docs_img); ?>" alt="<?php echo esc_attr($docs_img_cap); ?>" class="w-full h-auto object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary-light/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-primary-light/90 to-transparent text-white">
                            <h3 class="text-base sm:text-lg font-bold"><?php echo esc_html($docs_img_cap); ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Registration Form Section -->
            <div id="registration-form" class="bg-gradient-to-br from-white to-primary/5 rounded-2xl sm:rounded-3xl p-6 sm:p-8 md:p-12 shadow-2xl border border-primary/20">
                <div class="text-center mb-8 sm:mb-12">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 border border-primary/30 text-primary text-xs font-bold uppercase tracking-wider mb-4">
                        <i data-lucide="<?php echo esc_attr($form_badge_icon); ?>" class="w-4 h-4"></i>
                        <?php echo esc_html($form_badge); ?>
                    </div>
                    <h2 class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold text-primary mb-4"><?php echo esc_html($form_heading); ?></h2>
                    <p class="text-sm sm:text-base text-text-secondary-light max-w-2xl mx-auto"><?php echo esc_html($form_desc); ?></p>
                </div>

                <form id="mlzs-admission-form" class="space-y-6 sm:space-y-8" method="post" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
                    <?php wp_nonce_field('mlzs_admission', 'mlzs_admission_nonce', false); ?>
                    <input type="hidden" name="action" value="mlzs_admission" />
                    <div id="mlzs-admission-form-message" class="hidden rounded-xl px-4 py-3 text-sm" role="alert" aria-live="polite"></div>
                    <!-- Date & Enquiry Number -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-text-main-light">Date <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i data-lucide="calendar" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-text-secondary-light"></i>
                                <input type="date" name="adm_date" class="w-full pl-10 pr-4 py-3 rounded-xl border border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" required>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-text-main-light">Enquiry / Registration No.</label>
                            <div class="relative">
                                <i data-lucide="hash" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-text-secondary-light"></i>
                                <input type="number" name="adm_enquiry_no" class="w-full pl-10 pr-4 py-3 rounded-xl border border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                            </div>
                            <span class="block text-xs text-text-secondary-light">(For office use only)</span>
                        </div>
                    </div>
                    <!-- Child's Name -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-text-main-light">Name of the child <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="relative">
                                <i data-lucide="user" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-text-secondary-light"></i>
                                <input type="text" name="child_first_name" placeholder="First Name" class="w-full pl-10 pr-4 py-3 rounded-xl border border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" required>
                            </div>
                            <div class="relative">
                                <i data-lucide="user" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-text-secondary-light"></i>
                                <input type="text" name="child_surname" placeholder="Surname" class="w-full pl-10 pr-4 py-3 rounded-xl border border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" required>
                            </div>
                        </div>
                    </div>
                    <!-- Date of Birth & Current Age -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-text-main-light">Date of Birth <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i data-lucide="calendar" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-text-secondary-light"></i>
                                <input type="date" name="child_dob" class="w-full pl-10 pr-4 py-3 rounded-xl border border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" required>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-text-main-light">Current Age</label>
                            <div class="grid grid-cols-3 gap-3">
                                <input type="number" name="age_years" placeholder="Years" class="w-full px-4 py-3 rounded-xl border border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-center">
                                <input type="number" name="age_months" placeholder="Months" class="w-full px-4 py-3 rounded-xl border border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-center">
                            </div>
                        </div>
                    </div>
                    <!-- Current School & Admission Sought -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-text-main-light">Current school & class</label>
                            <div class="relative">
                                <i data-lucide="school" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-text-secondary-light"></i>
                                <input type="text" name="current_school" class="w-full pl-10 pr-4 py-3 rounded-xl border border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-text-main-light">Class into which admission is sought <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i data-lucide="graduation-cap" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-text-secondary-light"></i>
                                <input type="text" name="admission_class" class="w-full pl-10 pr-4 py-3 rounded-xl border border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" required>
                            </div>
                        </div>
                    </div>
                    <!-- Father's Information -->
                    <div class="bg-primary/5 rounded-xl p-4 sm:p-6">
                        <h3 class="text-base sm:text-lg font-bold text-primary mb-4 flex items-center gap-2">
                            <i data-lucide="user" class="w-5 h-5"></i>
                            Father's Information
                        </h3>
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-text-main-light">Name of Father <span class="text-red-500">*</span></label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <input type="text" name="father_first_name" placeholder="First Name" class="w-full px-4 py-3 rounded-xl border border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" required>
                                    <input type="text" name="father_surname" placeholder="Surname" class="w-full px-4 py-3 rounded-xl border border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" required>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-text-main-light">Qualification</label>
                                    <div class="relative">
                                        <i data-lucide="book-open" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-text-secondary-light"></i>
                                        <input type="text" name="father_qualification" class="w-full pl-10 pr-4 py-3 rounded-xl border border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-text-main-light">Occupation (Please Specify)</label>
                                    <div class="relative">
                                        <i data-lucide="briefcase" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-text-secondary-light"></i>
                                        <input type="text" name="father_occupation" class="w-full pl-10 pr-4 py-3 rounded-xl border border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Mother's Information -->
                    <div class="bg-accent/5 rounded-xl p-4 sm:p-6">
                        <h3 class="text-base sm:text-lg font-bold text-accent mb-4 flex items-center gap-2">
                            <i data-lucide="user" class="w-5 h-5"></i>
                            Mother's Information
                        </h3>
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-text-main-light">Name of Mother <span class="text-red-500">*</span></label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <input type="text" name="mother_first_name" placeholder="First Name" class="w-full px-4 py-3 rounded-xl border border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" required>
                                    <input type="text" name="mother_surname" placeholder="Surname" class="w-full px-4 py-3 rounded-xl border border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" required>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-text-main-light">Qualification</label>
                                    <div class="relative">
                                        <i data-lucide="book-open" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-text-secondary-light"></i>
                                        <input type="text" name="mother_qualification" class="w-full pl-10 pr-4 py-3 rounded-xl border border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-text-main-light">Occupation (Please Specify)</label>
                                    <div class="relative">
                                        <i data-lucide="briefcase" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-text-secondary-light"></i>
                                        <input type="text" name="mother_occupation" class="w-full pl-10 pr-4 py-3 rounded-xl border border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Family Annual Income -->
                    <div class="space-y-3">
                        <h3 class="text-base sm:text-lg font-bold text-text-main-light">Family Annual Income</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <label class="flex items-center gap-3 p-3 rounded-xl border border-border-light bg-white hover:bg-primary/5 cursor-pointer">
                                <input type="radio" name="income" value="lt_6" class="w-4 h-4 text-primary">
                                <span class="text-text-main-light">&lt; 6 Lacs</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 rounded-xl border border-border-light bg-white hover:bg-primary/5 cursor-pointer">
                                <input type="radio" name="income" value="lt_10" class="w-4 h-4 text-primary">
                                <span class="text-text-main-light">&lt; 10 Lacs</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 rounded-xl border border-border-light bg-white hover:bg-primary/5 cursor-pointer">
                                <input type="radio" name="income" value="lt_20" class="w-4 h-4 text-primary">
                                <span class="text-text-main-light">&lt; 20 Lacs</span>
                            </label>
                        </div>
                    </div>
                    <!-- Address & Contact -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-text-main-light">Address <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <i data-lucide="home" class="absolute left-3 top-4 w-5 h-5 text-text-secondary-light"></i>
                            <textarea name="address" rows="3" class="w-full pl-10 pr-4 py-3 rounded-xl border border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" required></textarea>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-text-main-light">Email Id <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i data-lucide="mail" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-text-secondary-light"></i>
                                <input type="email" name="email" class="w-full pl-10 pr-4 py-3 rounded-xl border border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" required>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-text-main-light">Contact details <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i data-lucide="phone" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-text-secondary-light"></i>
                                <input type="tel" name="contact" class="w-full pl-10 pr-4 py-3 rounded-xl border border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" required>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-text-main-light">Please mention your preferred date for visit</label>
                        <div class="relative">
                            <i data-lucide="calendar" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-text-secondary-light"></i>
                            <input type="date" name="preferred_visit_date" class="w-full pl-10 pr-4 py-3 rounded-xl border border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                        </div>
                    </div>
                    <div class="pt-4">
                        <button id="mlzs-admission-submit-btn" type="submit" name="admission_registration" class="w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-primary to-primary-dark text-white rounded-xl font-bold text-sm sm:text-base md:text-lg hover:shadow-[0_0_30px_rgba(61,52,139,0.4)] hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2 group/btn mx-auto disabled:opacity-70 disabled:cursor-not-allowed">
                            <span class="mlzs-admission-btn-text"><?php echo esc_html($form_submit); ?></span>
                            <i data-lucide="send" class="w-4 h-4 sm:w-5 sm:h-5 group-hover/btn:translate-x-1 transition-transform mlzs-admission-btn-icon"></i>
                        </button>
                        <p class="text-center text-xs sm:text-sm text-text-secondary-light mt-4"><?php echo esc_html($form_terms); ?></p>
                    </div>
                </form>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
