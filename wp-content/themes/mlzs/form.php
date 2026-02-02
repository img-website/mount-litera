<?php
/**
 * Template Name: Registration Form Page
 * Student Registration Form: Hero, full registration form with file uploads. UI matches form.html.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$theme_uri = get_template_directory_uri();
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge   = $opt ? get_field('reg_hero_badge', $page_id) : null;
$hero_icon    = $opt ? get_field('reg_hero_icon', $page_id) : null;
$hero_headline = $opt ? get_field('reg_hero_headline', $page_id) : null;
$hero_sub     = $opt ? get_field('reg_hero_subtext', $page_id) : null;

$hero_badge    = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Registration Form';
$hero_icon     = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'file-text';
$hero_headline = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'Student Registration';
$hero_sub      = ($hero_sub !== '' && $hero_sub !== null) ? (string) $hero_sub : 'Complete the registration form to begin your journey with Mount Litera Zee School. Fill in all required details accurately.';

// ——— Form Header Logos ———
$_logo_mount = $opt ? get_field('reg_logo_mount_litera', $page_id) : null;
$_logo_school = $opt ? get_field('reg_logo_school', $page_id) : null;
$logo_mount = (is_array($_logo_mount) && !empty($_logo_mount['url'])) ? $_logo_mount['url'] : 'https://www.mlzsalwar.ac.in/new/images/mount-litera.png';
$logo_school = (is_array($_logo_school) && !empty($_logo_school['url'])) ? $_logo_school['url'] : 'https://www.mlzsalwar.ac.in/new/images/slogo.png';

// ——— Session Years (dynamic: current + next) ———
$current_year = (int) wp_date('Y');
$years_start = range($current_year - 5, $current_year + 1);
$years_end   = range($current_year - 4, $current_year + 2);
$default_start = $current_year;
$default_end   = $current_year + 1;

// ——— Note Section ———
$note_title = $opt ? get_field('reg_note_title', $page_id) : null;
$note_content = $opt ? get_field('reg_note_content', $page_id) : null;
$note_title = ($note_title !== '' && $note_title !== null) ? (string) $note_title : 'Note';
$default_note = "Please attach photocopy of the following supporting documents:\n1. Birth certificate of the child (Issued by municipal corporation or any competent authority)\n2. Proof of Residence. (Passport/Voter Id/Electricity Bill/Ration card)\n3. Proof of Sibling if studying at MLZS (Wherever Applicable)\n4. Final progress Report of the previous class and recent Progress report of the current class.\n5. Aadhar Card copy of the child, Mother & Father\n\nTwo recent passport size photographs of the child and each Parent to be submitted.\nShort-listed student will be informed by Post/Telephone/Email.\nIncomplete forms are liable to be rejected without any intimation.";
$note_content = ($note_content !== '' && $note_content !== null) ? (string) $note_content : $default_note;

// ——— Payment Section ———
$pay_title = $opt ? get_field('reg_pay_title', $page_id) : null;
$pay_amount = $opt ? get_field('reg_pay_amount', $page_id) : null;
$pay_bank_name = $opt ? get_field('reg_pay_bank_name', $page_id) : null;
$pay_acc_no = $opt ? get_field('reg_pay_acc_no', $page_id) : null;
$pay_ifsc = $opt ? get_field('reg_pay_ifsc', $page_id) : null;
$pay_phone = $opt ? get_field('reg_pay_phone', $page_id) : null;
$pay_whatsapp = $opt ? get_field('reg_pay_whatsapp', $page_id) : null;
$pay_email = $opt ? get_field('reg_pay_email', $page_id) : null;
$_pay_bank_img = $opt ? get_field('reg_pay_bank_logo', $page_id) : null;

$pay_title = ($pay_title !== '' && $pay_title !== null) ? (string) $pay_title : 'Payment Related Details';
$pay_amount = ($pay_amount !== '' && $pay_amount !== null) ? (string) $pay_amount : '₹500';
$pay_bank_name = ($pay_bank_name !== '' && $pay_bank_name !== null) ? (string) $pay_bank_name : 'Mount Litera Zee School';
$pay_acc_no = ($pay_acc_no !== '' && $pay_acc_no !== null) ? (string) $pay_acc_no : '011490300000097';
$pay_ifsc = ($pay_ifsc !== '' && $pay_ifsc !== null) ? (string) $pay_ifsc : 'YESB0000114';
$pay_phone = ($pay_phone !== '' && $pay_phone !== null) ? (string) $pay_phone : '7665000317 / 9672797979';
$pay_whatsapp = ($pay_whatsapp !== '' && $pay_whatsapp !== null) ? (string) $pay_whatsapp : '7665000317';
$pay_email = ($pay_email !== '' && $pay_email !== null) ? (string) $pay_email : 'zeeschool.alw2k@gmail.com';
$pay_bank_img = (is_array($_pay_bank_img) && !empty($_pay_bank_img['url'])) ? $_pay_bank_img['url'] : 'https://www.mlzsalwar.ac.in/new/images/bank.png';

// ——— Undertaking ———
$undertaking_text = $opt ? get_field('reg_undertaking_text', $page_id) : null;
$undertaking_text = ($undertaking_text !== '' && $undertaking_text !== null) ? (string) $undertaking_text : 'I/We hereby certify that the information is correct to the best of my/our knowledge and belief. Further, I/we fully understand that if any information is found to be false/incorrect, the admission of my/our ward will stand cancelled. I/We also understand that the application for registration does not guarantee admission to my/our ward. If My/Our son/daughter is selected for admission, we hereby agree and give consent to abide by the rules and regulation for school as applicable now and as amended from time to time.';

// ——— Form labels / submit ———
$form_submit = $opt ? get_field('reg_form_submit_text', $page_id) : null;
$form_submit = ($form_submit !== '' && $form_submit !== null) ? (string) $form_submit : 'Submit Registration Form';
?>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary via-primary-dark to-slate-900 text-white pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-20"></div>
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-accent/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-primary-light/10 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="layout-container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-6">
                    <i data-lucide="<?php echo esc_attr($hero_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 text-accent"></i>
                    <span class="text-xs sm:text-sm font-bold text-white uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold mb-4 sm:mb-6 leading-tight">
                    <?php echo esc_html($hero_headline); ?>
                </h1>
                <p class="text-sm sm:text-base md:text-lg lg:text-xl text-white/90 max-w-2xl mx-auto leading-relaxed">
                    <?php echo esc_html($hero_sub); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Registration Form Section -->
    <section class="relative px-4 sm:px-6 lg:px-8 py-8 sm:py-12 bg-background-light overflow-x-hidden">
        <div class="absolute top-0 left-0 -z-10 h-full w-full overflow-hidden">
            <div class="absolute -top-40 -right-40 h-[500px] w-[500px] rounded-full bg-indigo-velvet/5 blur-[100px]"></div>
            <div class="absolute top-1/2 -left-20 h-[300px] w-[300px] rounded-full bg-amber-flame/10 blur-[80px]"></div>
        </div>
        <div class="mx-auto max-w-6xl w-full">
            <div class="bg-white rounded-2xl sm:rounded-3xl shadow-2xl border-4 border-primary overflow-hidden">
                <form id="mlzs-registration-form" method="post" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" enctype="multipart/form-data">
                    <?php wp_nonce_field('mlzs_registration', 'mlzs_registration_nonce', false); ?>
                    <input type="hidden" name="action" value="mlzs_registration">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-primary via-primary-dark to-primary p-4 sm:p-6 text-white">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <img src="<?php echo esc_url($logo_mount); ?>" alt="Mount Litera Logo" class="h-10 sm:h-12 w-auto bg-white p-1 rounded-md">
                            <div class="h-12 w-px bg-white/30 hidden sm:block"></div>
                            <img src="<?php echo esc_url($logo_school); ?>" alt="School Logo" class="h-10 sm:h-12 w-auto bg-white p-1 rounded-md">
                        </div>
                        <div class="text-center sm:text-right">
                            <h4 class="text-xs sm:text-sm md:text-base font-bold uppercase tracking-wider">REGISTRATION FORM - SESSION</h4>
                            <div class="flex items-center justify-center sm:justify-end gap-2 mt-2">
                                <select name="startyear" id="reg_startyear" class="bg-white/20 backdrop-blur-sm border border-white/30 rounded-lg px-2 sm:px-3 py-1 sm:py-1.5 text-white text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-white/50 cursor-pointer appearance-none pr-6 sm:pr-8">
                                    <?php foreach ($years_start as $y) : ?>
                                        <option class="text-black" value="<?php echo (int) $y; ?>" <?php selected($y, $default_start); ?>><?php echo (int) $y; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="text-white">-</span>
                                <select name="endyear" id="reg_endyear" class="bg-white/20 backdrop-blur-sm border border-white/30 rounded-lg px-2 sm:px-3 py-1 sm:py-1.5 text-white text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-white/50 cursor-pointer appearance-none pr-6 sm:pr-8">
                                    <?php foreach ($years_end as $y) : ?>
                                        <option class="text-black" value="<?php echo (int) $y; ?>" <?php selected($y, $default_end); ?>><?php echo (int) $y; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="margin-bottom p-4 sm:p-6 md:p-8">
                    <div id="mlzs-registration-form-message" class="hidden rounded-xl px-4 py-3 text-sm mb-6" role="alert" aria-live="polite"></div>
                    <div class="mb-8">
                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                            <div class="flex-1">
                                <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-primary leading-tight">MOUNT LITERA ZEE SCHOOL</h1>
                                <p class="text-xs sm:text-sm text-text-secondary-light mt-2">Alwar, Rajasthan</p>
                            </div>
                            <div class="w-full md:w-48">
                                <div class="border-2 border-dashed border-primary rounded-xl p-4 text-center reg-photo-box" data-reg-photo="student">
                                    <div class="relative">
                                        <div class="reg-photo-placeholder w-32 h-32 mx-auto bg-gray-100 rounded-lg flex items-center justify-center mb-3">
                                            <i data-lucide="camera" class="w-8 h-8 text-gray-400"></i>
                                        </div>
                                        <div class="reg-photo-preview hidden w-32 h-32 mx-auto rounded-lg overflow-hidden mb-3 bg-gray-100">
                                            <img src="" alt="Preview" class="w-full h-full object-cover">
                                        </div>
                                        <button type="button" class="reg-photo-remove hidden absolute -top-1 -right-1 w-7 h-7 rounded-full bg-red-500 text-white flex items-center justify-center hover:bg-red-600 shadow transition-colors z-10" title="Remove photo">
                                            <i data-lucide="x" class="w-4 h-4"></i>
                                        </button>
                                        <input type="file" required name="student_photo" id="fileToUpload" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                                    </div>
                                    <label for="fileToUpload" class="text-sm font-medium text-primary cursor-pointer">Student Photo *</label>
                                    <p class="text-xs text-text-secondary-light mt-1">Click to upload passport photo</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-8">
                        <!-- Section 1: Source of Information -->
                        <div class="bg-primary/5 rounded-xl p-4 sm:p-6">
                            <label class="block text-base sm:text-lg font-bold text-primary mb-4">1. How did you learn about the opening of Registration at Mount Litera Zee School</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
                                <?php foreach (array('Advertisement' => 'advertisement', 'Website' => 'website', 'Pre-School' => 'preschool', 'Friends' => 'friends', 'Other' => 'other') as $lbl => $val) : ?>
                                    <label class="flex items-center gap-2 p-2 sm:p-3 bg-white rounded-lg border border-border-light hover:border-primary/50 cursor-pointer transition-colors">
                                        <input type="checkbox" name="source_info[]" value="<?php echo esc_attr($val); ?>" class="w-3 h-3 sm:w-4 sm:h-4 text-primary">
                                        <span class="text-xs sm:text-sm"><?php echo esc_html($lbl); ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Section 2: Child's Basic Information -->
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-xs sm:text-sm font-medium text-text-main-light">2. Name of the Child <span class="text-red-500">*</span></label>
                                    <input type="text" name="child_name" required class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-xs sm:text-sm font-medium text-text-main-light">Sex <span class="text-red-500">*</span></label>
                                    <div class="flex gap-4">
                                        <label class="flex items-center gap-2"><input type="radio" name="sex" value="male" class="w-3 h-3 sm:w-4 sm:h-4 text-primary"><span class="text-xs sm:text-sm">Male</span></label>
                                        <label class="flex items-center gap-2"><input type="radio" name="sex" value="female" class="w-3 h-3 sm:w-4 sm:h-4 text-primary"><span class="text-xs sm:text-sm">Female</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-xs sm:text-sm font-medium text-text-main-light">3. Date of Birth <span class="text-red-500">*</span></label>
                                    <input type="date" name="dob" required class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-xs sm:text-sm font-medium text-text-main-light">4. Aadhar Card Number</label>
                                    <input type="text" name="aadhar" class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                                </div>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-4 sm:p-6">
                                <div class="grid grid-cols-1 sm:grid-cols-5 gap-4">
                                    <div class="space-y-2 sm:col-span-3">
                                        <label class="block text-xs sm:text-sm font-medium text-text-main-light">5. Age as on 31 March</label>
                                        <div class="flex gap-2">
                                            <input type="text" name="age_years" placeholder="Years" class="flex-1 px-3 py-2 text-xs sm:text-sm rounded-lg border border-border-light">
                                            <input type="text" name="age_months" placeholder="Months" class="flex-1 px-3 py-2 text-xs sm:text-sm rounded-lg border border-border-light">
                                            <input type="text" name="age_days" placeholder="Days" class="flex-1 px-3 py-2 text-xs sm:text-sm rounded-lg border border-border-light">
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-xs sm:text-sm font-medium text-text-main-light">6. Blood Group</label>
                                        <input type="text" name="blood_group" class="w-full px-3 py-2 text-xs sm:text-sm rounded-lg border border-border-light">
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-xs sm:text-sm font-medium text-text-main-light">7. Place of Birth</label>
                                    <input type="text" name="place_of_birth" class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-xs sm:text-sm font-medium text-text-main-light">8. City of Birth</label>
                                    <input type="text" name="city_of_birth" class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-xs sm:text-sm font-medium text-text-main-light">9. State of Birth</label>
                                    <input type="text" name="state_of_birth" class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white">
                                </div>
                            </div>
                            <div class="bg-primary/5 rounded-xl p-4 sm:p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="block text-xs sm:text-sm font-medium text-text-main-light">10. Admission sought in Class (in words) <span class="text-red-500">*</span></label>
                                        <input type="text" name="admission_class_words" required class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-xs sm:text-sm font-medium text-text-main-light">Select Class <span class="text-red-500">*</span></label>
                                        <div class="space-y-3">
                                            <label class="flex items-center gap-2">
                                                <input type="radio" name="stream" value="1to10" class="w-3 h-3 sm:w-4 sm:h-4 text-primary">
                                                <span class="text-xs sm:text-sm">I to X</span>
                                                <select name="class_1to10" class="ml-2 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg border border-border-light text-xs sm:text-sm">
                                                    <?php foreach (array('Class I','Class II','Class III','Class IV','Class V','Class VI','Class VII','Class VIII','Class IX','Class X') as $i => $c) : ?>
                                                        <option value="<?php echo esc_attr($c); ?>"><?php echo esc_html($c); ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </label>
                                            <label class="flex items-center gap-2">
                                                <input type="radio" name="stream" value="xi" class="w-3 h-3 sm:w-4 sm:h-4 text-primary">
                                                <span class="text-xs sm:text-sm">XI</span>
                                                <select name="class_xi" class="ml-2 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg border border-border-light text-xs sm:text-sm">
                                                    <option value="Commerce">Commerce</option>
                                                    <option value="Science">Science</option>
                                                    <option value="Humanities">Humanities</option>
                                                </select>
                                            </label>
                                            <label class="flex items-center gap-2">
                                                <input type="radio" name="stream" value="xii" class="w-3 h-3 sm:w-4 sm:h-4 text-primary">
                                                <span class="text-xs sm:text-sm">XII</span>
                                                <select name="class_xii" class="ml-2 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg border border-border-light text-xs sm:text-sm">
                                                    <option value="Commerce">Commerce</option>
                                                    <option value="Science">Science</option>
                                                    <option value="Humanities">Humanities</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-xs sm:text-sm font-medium text-text-main-light">11. Current School Name <span class="text-red-500">*</span></label>
                                    <input type="text" name="current_school" required class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-xs sm:text-sm font-medium text-text-main-light">12. Current Class <span class="text-red-500">*</span></label>
                                    <input type="text" name="current_class" required class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-xs sm:text-sm font-medium text-text-main-light">13. Nationality <span class="text-red-500">*</span></label>
                                    <input type="text" name="nationality" class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-xs sm:text-sm font-medium text-text-main-light">14. Domicile of</label>
                                    <input type="text" name="domicile" class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white">
                                </div>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-4 sm:p-6">
                                <label class="block text-base sm:text-lg font-medium text-text-main-light mb-4">15. Mother Tongue</label>
                                <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">
                                    <label class="flex items-center gap-2"><input type="checkbox" name="mother_tongue[]" value="hindi" class="w-3 h-3 sm:w-4 sm:h-4 text-primary"><span class="text-xs sm:text-sm">Hindi</span></label>
                                    <label class="flex items-center gap-2"><input type="checkbox" name="mother_tongue[]" value="english" class="w-3 h-3 sm:w-4 sm:h-4 text-primary"><span class="text-xs sm:text-sm">English</span></label>
                                    <div class="sm:col-span-2 flex items-center gap-2">
                                        <label class="flex items-center gap-2 shrink-0"><input type="checkbox" name="mother_tongue_other" value="1" class="w-3 h-3 sm:w-4 sm:h-4 text-primary"><span class="text-xs sm:text-sm">Other</span></label>
                                        <input type="text" name="mother_tongue_other_text" class="flex-1 px-2 sm:px-3 py-1 sm:py-1.5 text-xs sm:text-sm rounded-lg border border-border-light">
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-4 sm:p-6">
                                <label class="block text-base sm:text-lg font-medium text-text-main-light mb-4">16. Admission Category</label>
                                <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">
                                    <label class="flex items-center gap-2"><input type="checkbox" name="admission_category[]" value="gen" class="w-3 h-3 sm:w-4 sm:h-4 text-primary"><span class="text-xs sm:text-sm">Gen</span></label>
                                    <label class="flex items-center gap-2"><input type="checkbox" name="admission_category[]" value="ews" class="w-3 h-3 sm:w-4 sm:h-4 text-primary"><span class="text-xs sm:text-sm">EWS</span></label>
                                    <div class="sm:col-span-2 flex items-center gap-2">
                                        <label class="flex items-center gap-2 shrink-0"><input type="checkbox" name="admission_category_other" value="1" class="w-3 h-3 sm:w-4 sm:h-4 text-primary"><span class="text-xs sm:text-sm">Other</span></label>
                                        <input type="text" name="admission_category_other_text" class="flex-1 px-2 sm:px-3 py-1 sm:py-1.5 text-xs sm:text-sm rounded-lg border border-border-light">
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="block text-xs sm:text-sm font-medium text-text-main-light">17. Permanent Address <span class="text-red-500">*</span></label>
                                        <textarea name="permanent_address" required rows="4" class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"></textarea>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-xs sm:text-sm font-medium text-text-main-light">18. Resident Address</label>
                                        <textarea name="resident_address" rows="4" class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"></textarea>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="space-y-2">
                                            <label class="block text-xs sm:text-sm font-medium text-text-main-light">State <span class="text-red-500">*</span></label>
                                            <input type="text" name="state_permanent" required class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white">
                                        </div>
                                        <div class="space-y-2">
                                            <label class="block text-xs sm:text-sm font-medium text-text-main-light">District <span class="text-red-500">*</span></label>
                                            <input type="text" name="district_permanent" required class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white">
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="space-y-2">
                                            <label class="block text-xs sm:text-sm font-medium text-text-main-light">State</label>
                                            <input type="text" name="state_resident" class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white">
                                        </div>
                                        <div class="space-y-2">
                                            <label class="block text-xs sm:text-sm font-medium text-text-main-light">District</label>
                                            <input type="text" name="district_resident" class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white">
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="space-y-2">
                                            <label class="block text-xs sm:text-sm font-medium text-text-main-light">Mobile No. <span class="text-red-500">*</span></label>
                                            <input type="tel" name="mobile_permanent" required class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white">
                                        </div>
                                        <div class="space-y-2">
                                            <label class="block text-xs sm:text-sm font-medium text-text-main-light">PIN Code <span class="text-red-500">*</span></label>
                                            <input type="text" name="pincode_permanent" required class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white">
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="space-y-2">
                                            <label class="block text-xs sm:text-sm font-medium text-text-main-light">Mobile No.</label>
                                            <input type="tel" name="mobile_resident" class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white">
                                        </div>
                                        <div class="space-y-2">
                                            <label class="block text-xs sm:text-sm font-medium text-text-main-light">PIN Code</label>
                                            <input type="text" name="pincode_resident" class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white">
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-xs sm:text-sm font-medium text-text-main-light">19. E-mail-id <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" required class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-xs sm:text-sm font-medium text-text-main-light">20. Is your child suffering from any Chronic Disease/Illness/Allergy/disabilities? <span class="text-red-500">*</span></label>
                                    <input type="text" name="health_info" required class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border-2 border-border-light bg-white" placeholder="Type None if not applicable">
                                </div>
                            </div>
                        </div>

                        <!-- Parents Information -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Mother's Information -->
                            <div class="border-2 border-primary/30 rounded-xl p-4 sm:p-6">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-10 h-10 rounded-lg bg-green-500 flex items-center justify-center">
                                        <i data-lucide="user" class="w-5 h-5 text-white"></i>
                                    </div>
                                    <h3 class="text-base sm:text-lg font-bold text-text-main-light">Mother's Information</h3>
                                </div>
                                <div class="space-y-3">
                                    <div class="border-2 border-dashed border-primary rounded-lg p-4 text-center relative reg-photo-box" data-reg-photo="mother">
                                        <div class="reg-photo-placeholder w-24 h-24 mx-auto bg-gray-100 rounded-lg flex items-center justify-center mb-2">
                                            <i data-lucide="camera" class="w-6 h-6 text-gray-400"></i>
                                        </div>
                                        <div class="reg-photo-preview hidden w-24 h-24 mx-auto rounded-lg overflow-hidden mb-2 bg-gray-100">
                                            <img src="" alt="Preview" class="w-full h-full object-cover">
                                        </div>
                                        <button type="button" class="reg-photo-remove hidden absolute top-2 right-2 w-6 h-6 rounded-full bg-red-500 text-white flex items-center justify-center hover:bg-red-600 shadow transition-colors z-10" title="Remove photo">
                                            <i data-lucide="x" class="w-3 h-3"></i>
                                        </button>
                                        <input type="file" name="mother_photo" id="fileToUpload1" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                                        <label for="fileToUpload1" class="text-sm font-medium text-primary cursor-pointer">Upload Mother's Photo</label>
                                    </div>
                                    <div class="grid grid-cols-2 gap-3">
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">Name <span class="text-red-500">*</span></label><input type="text" name="mother_name" required class="w-full px-3 py-2 text-xs sm:text-sm rounded-lg border border-border-light"></div>
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">Age</label><input type="text" name="mother_age" class="w-full px-3 py-2 text-xs sm:text-sm rounded-lg border border-border-light"></div>
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">Academic Qualification</label><input type="text" name="mother_qualification" class="w-full px-3 py-2 text-xs sm:text-sm rounded-lg border border-border-light"></div>
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">Aadhar Card Number</label><input type="text" name="mother_aadhar" class="w-full px-3 py-2 text-xs sm:text-sm rounded-lg border border-border-light"></div>
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">Profession <span class="text-red-500">*</span></label><input type="text" name="mother_profession" required class="w-full px-3 py-2 rounded-lg border border-border-light"></div>
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">Organization</label><input type="text" name="mother_organization" class="w-full px-3 py-2 text-xs sm:text-sm rounded-lg border border-border-light"></div>
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">Designation</label><input type="text" name="mother_designation" class="w-full px-3 py-2 text-xs sm:text-sm rounded-lg border border-border-light"></div>
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">Office Address</label><input type="text" name="mother_office_address" class="w-full px-3 py-2 text-xs sm:text-sm rounded-lg border border-border-light"></div>
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">City/State</label><input type="text" name="mother_city_state" class="w-full px-3 py-2 text-xs sm:text-sm rounded-lg border border-border-light"></div>
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">Office Mobile Number</label><input type="text" name="mother_office_mobile" class="w-full px-3 py-2 text-xs sm:text-sm rounded-lg border border-border-light"></div>
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">Mobile Number <span class="text-red-500">*</span></label><input type="text" name="mother_mobile" required class="w-full px-3 py-2 rounded-lg border border-border-light"></div>
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">E-mail</label><input type="email" name="mother_email" class="w-full px-3 py-2 text-xs sm:text-sm rounded-lg border border-border-light"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Father's Information -->
                            <div class="border-2 border-primary/30 rounded-xl p-4 sm:p-6">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-10 h-10 rounded-lg bg-blue-500 flex items-center justify-center">
                                        <i data-lucide="user" class="w-5 h-5 text-white"></i>
                                    </div>
                                    <h3 class="text-base sm:text-lg font-bold text-text-main-light">Father's Information</h3>
                                </div>
                                <div class="space-y-3">
                                    <div class="border-2 border-dashed border-primary rounded-lg p-4 text-center relative reg-photo-box" data-reg-photo="father">
                                        <div class="reg-photo-placeholder w-24 h-24 mx-auto bg-gray-100 rounded-lg flex items-center justify-center mb-2">
                                            <i data-lucide="camera" class="w-6 h-6 text-gray-400"></i>
                                        </div>
                                        <div class="reg-photo-preview hidden w-24 h-24 mx-auto rounded-lg overflow-hidden mb-2 bg-gray-100">
                                            <img src="" alt="Preview" class="w-full h-full object-cover">
                                        </div>
                                        <button type="button" class="reg-photo-remove hidden absolute top-2 right-2 w-6 h-6 rounded-full bg-red-500 text-white flex items-center justify-center hover:bg-red-600 shadow transition-colors z-10" title="Remove photo">
                                            <i data-lucide="x" class="w-3 h-3"></i>
                                        </button>
                                        <input type="file" name="father_photo" id="fileToUpload2" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                                        <label for="fileToUpload2" class="text-sm font-medium text-primary cursor-pointer">Upload Father's Photo</label>
                                    </div>
                                    <div class="grid grid-cols-2 gap-3">
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">Name <span class="text-red-500">*</span></label><input type="text" name="father_name" required class="w-full px-3 py-2 rounded-lg border border-border-light"></div>
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">Age</label><input type="text" name="father_age" class="w-full px-3 py-2 text-xs sm:text-sm rounded-lg border border-border-light"></div>
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">Academic Qualification</label><input type="text" name="father_qualification" class="w-full px-3 py-2 text-xs sm:text-sm rounded-lg border border-border-light"></div>
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">Aadhar Card Number</label><input type="text" name="father_aadhar" class="w-full px-3 py-2 text-xs sm:text-sm rounded-lg border border-border-light"></div>
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">Profession <span class="text-red-500">*</span></label><input type="text" name="father_profession" required class="w-full px-3 py-2 rounded-lg border border-border-light"></div>
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">Organization</label><input type="text" name="father_organization" class="w-full px-3 py-2 text-xs sm:text-sm rounded-lg border border-border-light"></div>
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">Designation</label><input type="text" name="father_designation" class="w-full px-3 py-2 text-xs sm:text-sm rounded-lg border border-border-light"></div>
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">Office Address</label><input type="text" name="father_office_address" class="w-full px-3 py-2 text-xs sm:text-sm rounded-lg border border-border-light"></div>
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">City/State</label><input type="text" name="father_city_state" class="w-full px-3 py-2 text-xs sm:text-sm rounded-lg border border-border-light"></div>
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">Office Mobile Number</label><input type="text" name="father_office_mobile" class="w-full px-3 py-2 text-xs sm:text-sm rounded-lg border border-border-light"></div>
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">Mobile Number <span class="text-red-500">*</span></label><input type="text" name="father_mobile" required class="w-full px-3 py-2 rounded-lg border border-border-light"></div>
                                        <div class="space-y-1"><label class="text-xs font-medium text-text-secondary-light">E-mail <span class="text-red-500">*</span></label><input type="email" name="father_email" required class="w-full px-3 py-2 rounded-lg border border-border-light"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Note and Payment -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div class="bg-green-50 rounded-xl p-4 sm:p-6 border border-green-200">
                                <h4 class="text-base sm:text-lg font-bold text-green-800 mb-4"><?php echo esc_html($note_title); ?></h4>
                                <div class="text-xs sm:text-sm text-green-700 whitespace-pre-line"><?php echo esc_html($note_content); ?></div>
                            </div>
                            <div class="bg-blue-50 rounded-xl p-4 sm:p-6 border border-blue-200">
                                <h4 class="text-base sm:text-lg font-bold text-blue-800 mb-4"><?php echo esc_html($pay_title); ?></h4>
                                <div class="space-y-3 text-xs sm:text-sm text-blue-700">
                                    <p>After completing the formalities kindly deposit <span class="font-bold"><?php echo esc_html($pay_amount); ?></span> as registration fee in below mentioned account detail.</p>
                                    <div class="bg-white rounded-lg p-4 border border-blue-300">
                                        <h5 class="font-bold text-blue-900 mb-2"><?php echo esc_html($pay_bank_name); ?></h5>
                                        <div class="flex items-center gap-2 mb-2">
                                            <img src="<?php echo esc_url($pay_bank_img); ?>" alt="Bank" class="w-6 h-6">
                                            <span>Yes Bank Account Number:</span>
                                            <span class="font-mono font-bold"><?php echo esc_html($pay_acc_no); ?></span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span>IFSC Number:</span>
                                            <span class="font-mono font-bold"><?php echo esc_html($pay_ifsc); ?></span>
                                        </div>
                                    </div>
                                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mt-4">
                                        <p class="text-yellow-800 font-medium mb-2">Kindly send reference number and name to the following detail:</p>
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-2"><i data-lucide="phone" class="w-4 h-4 text-blue-600"></i><span class="font-medium"><?php echo esc_html($pay_phone); ?></span></div>
                                            <div class="flex items-center gap-2"><i data-lucide="message-circle" class="w-4 h-4 text-green-600"></i><span class="font-medium">WhatsApp: <?php echo esc_html($pay_whatsapp); ?></span></div>
                                            <div class="flex items-center gap-2"><i data-lucide="mail" class="w-4 h-4 text-red-600"></i><span class="font-medium"><?php echo esc_html($pay_email); ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Undertaking -->
                        <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                            <h3 class="text-lg sm:text-xl font-bold text-center text-gray-800 mb-4">UNDERTAKING</h3>
                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <input type="checkbox" required class="w-4 h-4 sm:w-5 sm:h-5 text-primary mt-1">
                                    <p class="text-xs sm:text-sm text-gray-700 leading-relaxed"><?php echo esc_html($undertaking_text); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="text-center">
                            <button type="submit" id="mlzs-registration-submit-btn" class="px-6 sm:px-12 py-3 sm:py-4 bg-gradient-to-r from-primary to-primary-dark text-white rounded-xl font-bold text-sm sm:text-base md:text-lg hover:shadow-[0_0_30px_rgba(61,52,139,0.4)] hover:-translate-y-1 transition-all duration-300 inline-flex items-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed">
                                <span class="mlzs-registration-btn-text"><?php echo esc_html($form_submit); ?></span>
                                <i data-lucide="send" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                            </button>
                            <p class="text-xs sm:text-sm text-text-secondary-light mt-4">All fields marked with <span class="text-red-500">*</span> are mandatory</p>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
