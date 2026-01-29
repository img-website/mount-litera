<?php
/**
 * Template Name: Enquiry Form Page
 * Enquiry: Hero, Campus card, Contact card, Quick stats, Enquiry form, FAQ (ACF dynamic, icons dynamic)
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
$hero_badge     = $opt ? get_field('enquiry_hero_badge', $page_id) : null;
$hero_icon      = $opt ? get_field('enquiry_hero_icon', $page_id) : null;
$hero_headline  = $opt ? get_field('enquiry_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('enquiry_hero_highlight', $page_id) : null;
$hero_sub       = $opt ? get_field('enquiry_hero_subheadline', $page_id) : null;

$hero_badge     = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Get in Touch';
$hero_icon      = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'message-square';
$hero_headline  = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'Enquiry';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Form';
$hero_sub       = ($hero_sub !== '' && $hero_sub !== null) ? (string) $hero_sub : "Let's start your child's educational journey. Share your details and we'll reach out to you.";

// ——— Campus ———
$campus_icon   = $opt ? get_field('enquiry_campus_icon', $page_id) : null;
$campus_title  = $opt ? get_field('enquiry_campus_title', $page_id) : null;
$campus_addr_h = $opt ? get_field('enquiry_campus_address_heading', $page_id) : null;
$campus_addr   = $opt ? get_field('enquiry_campus_address', $page_id) : null;
$campus_map_url = $opt ? get_field('enquiry_campus_map_url', $page_id) : null;
$campus_map_text = $opt ? get_field('enquiry_campus_map_text', $page_id) : null;
$campus_map_icon = $opt ? get_field('enquiry_campus_map_icon', $page_id) : null;

$campus_icon   = (is_string($campus_icon) && trim($campus_icon) !== '') ? trim($campus_icon) : 'school';
$campus_title  = ($campus_title !== '' && $campus_title !== null) ? (string) $campus_title : 'Campus';
$campus_addr_h = ($campus_addr_h !== '' && $campus_addr_h !== null) ? (string) $campus_addr_h : 'Address';
$campus_addr   = ($campus_addr !== '' && $campus_addr !== null) ? (string) $campus_addr : "6th Mile Stone,\nSirmoli Village Road\nAlwar-Biwadi Highway,\nAlwar - 301028";
$campus_map_url = ($campus_map_url !== '' && $campus_map_url !== null) ? esc_url($campus_map_url) : 'https://maps.google.com/?q=6th+Mile+Stone+Sirmoli+Village+Road+Alwar+Biwadi+Highway+Alwar+301028';
$campus_map_text = ($campus_map_text !== '' && $campus_map_text !== null) ? (string) $campus_map_text : 'View on Map';
$campus_map_icon = (is_string($campus_map_icon) && trim($campus_map_icon) !== '') ? trim($campus_map_icon) : 'navigation';

// ——— Contact ———
$contact_icon   = $opt ? get_field('enquiry_contact_icon', $page_id) : null;
$contact_title  = $opt ? get_field('enquiry_contact_title', $page_id) : null;
$contact_phone_label = $opt ? get_field('enquiry_contact_phone_label', $page_id) : null;
$contact_phone_icon  = $opt ? get_field('enquiry_contact_phone_icon', $page_id) : null;
$contact_phone_number = $opt ? get_field('enquiry_contact_phone_number', $page_id) : null;
$contact_email_label = $opt ? get_field('enquiry_contact_email_label', $page_id) : null;
$contact_email_icon  = $opt ? get_field('enquiry_contact_email_icon', $page_id) : null;
$contact_emails = $opt ? get_field('enquiry_contact_emails', $page_id) : null;
$contact_call_text = $opt ? get_field('enquiry_contact_call_text', $page_id) : null;
$contact_call_icon  = $opt ? get_field('enquiry_contact_call_icon', $page_id) : null;
$contact_email_btn_text = $opt ? get_field('enquiry_contact_email_btn_text', $page_id) : null;
$contact_email_btn_icon = $opt ? get_field('enquiry_contact_email_btn_icon', $page_id) : null;

$contact_icon   = (is_string($contact_icon) && trim($contact_icon) !== '') ? trim($contact_icon) : 'phone';
$contact_title  = ($contact_title !== '' && $contact_title !== null) ? (string) $contact_title : 'Phone & E-mail';
$contact_phone_label = ($contact_phone_label !== '' && $contact_phone_label !== null) ? (string) $contact_phone_label : 'Admissions and Enquiry';
$contact_phone_icon  = (is_string($contact_phone_icon) && trim($contact_phone_icon) !== '') ? trim($contact_phone_icon) : 'phone-call';
$contact_phone_number = ($contact_phone_number !== '' && $contact_phone_number !== null) ? (string) $contact_phone_number : '+91 9672797979';
$contact_email_label = ($contact_email_label !== '' && $contact_email_label !== null) ? (string) $contact_email_label : 'Email Address';
$contact_email_icon  = (is_string($contact_email_icon) && trim($contact_email_icon) !== '') ? trim($contact_email_icon) : 'mail';
$contact_emails = ($contact_emails !== '' && $contact_emails !== null) ? (string) $contact_emails : "zeeschool.alw2k@gmail.com\nmlzs.alwar@mountlitera.com";
$contact_call_text = ($contact_call_text !== '' && $contact_call_text !== null) ? (string) $contact_call_text : 'Call Now';
$contact_call_icon  = (is_string($contact_call_icon) && trim($contact_call_icon) !== '') ? trim($contact_call_icon) : 'phone';
$contact_email_btn_text = ($contact_email_btn_text !== '' && $contact_email_btn_text !== null) ? (string) $contact_email_btn_text : 'Send Email';
$contact_email_btn_icon = (is_string($contact_email_btn_icon) && trim($contact_email_btn_icon) !== '') ? trim($contact_email_btn_icon) : 'mail';

// ——— Stats ———
$stat1_number = $opt ? get_field('enquiry_stat1_number', $page_id) : null;
$stat1_label  = $opt ? get_field('enquiry_stat1_label', $page_id) : null;
$stat2_number = $opt ? get_field('enquiry_stat2_number', $page_id) : null;
$stat2_label  = $opt ? get_field('enquiry_stat2_label', $page_id) : null;

$stat1_number = ($stat1_number !== '' && $stat1_number !== null) ? (string) $stat1_number : '24/7';
$stat1_label  = ($stat1_label !== '' && $stat1_label !== null) ? (string) $stat1_label : 'Support Available';
$stat2_number = ($stat2_number !== '' && $stat2_number !== null) ? (string) $stat2_number : '2 Hours';
$stat2_label  = ($stat2_label !== '' && $stat2_label !== null) ? (string) $stat2_label : 'Response Time';

// ——— Form ———
$form_icon    = $opt ? get_field('enquiry_form_icon', $page_id) : null;
$form_title   = $opt ? get_field('enquiry_form_title', $page_id) : null;
$form_subtitle = $opt ? get_field('enquiry_form_subtitle', $page_id) : null;
$form_action  = $opt ? get_field('enquiry_form_action', $page_id) : null;
$form_privacy_text = $opt ? get_field('enquiry_form_privacy_text', $page_id) : null;
$form_privacy_link = $opt ? get_field('enquiry_form_privacy_link', $page_id) : null;
$form_privacy_label = $opt ? get_field('enquiry_form_privacy_link_label', $page_id) : null;
$form_submit_text = $opt ? get_field('enquiry_form_submit_text', $page_id) : null;
$form_submit_icon = $opt ? get_field('enquiry_form_submit_icon', $page_id) : null;
$form_features = $opt ? get_field('enquiry_form_features', $page_id) : null;

$form_icon    = (is_string($form_icon) && trim($form_icon) !== '') ? trim($form_icon) : 'user-plus';
$form_title   = ($form_title !== '' && $form_title !== null) ? (string) $form_title : 'Submit Enquiry';
$form_subtitle = ($form_subtitle !== '' && $form_subtitle !== null) ? (string) $form_subtitle : "We'll contact you within 24 hours";
$form_action  = ($form_action !== '' && $form_action !== null) ? esc_url($form_action) : '';
if ($form_action === '') $form_action = $home_url . '#';
$form_privacy_text = ($form_privacy_text !== '' && $form_privacy_text !== null) ? (string) $form_privacy_text : 'By submitting, you agree to our';
$form_privacy_link = ($form_privacy_link !== '' && $form_privacy_link !== null) ? esc_url($form_privacy_link) : $home_url . '#';
$form_privacy_label = ($form_privacy_label !== '' && $form_privacy_label !== null) ? (string) $form_privacy_label : 'Privacy Policy';
$form_submit_text = ($form_submit_text !== '' && $form_submit_text !== null) ? (string) $form_submit_text : 'Submit Enquiry';
$form_submit_icon = (is_string($form_submit_icon) && trim($form_submit_icon) !== '') ? trim($form_submit_icon) : 'send';
$default_form_features = array(
    array('icon' => 'shield-check', 'label' => 'Secure Form'),
    array('icon' => 'clock', 'label' => 'Quick Response'),
    array('icon' => 'lock', 'label' => 'Data Protected'),
);
$form_features = (is_array($form_features) && count($form_features) >= 3) ? $form_features : $default_form_features;

// ——— FAQ ———
$faq_heading = $opt ? get_field('enquiry_faq_heading', $page_id) : null;
$faq_subtext = $opt ? get_field('enquiry_faq_subtext', $page_id) : null;
$faq_items   = $opt ? get_field('enquiry_faq_items', $page_id) : null;

$faq_heading = ($faq_heading !== '' && $faq_heading !== null) ? (string) $faq_heading : 'Frequently Asked Questions';
$faq_subtext = ($faq_subtext !== '' && $faq_subtext !== null) ? (string) $faq_subtext : 'Quick answers to common queries';
$default_faq = array(
    array('icon' => 'help-circle', 'question' => 'When will I get a response?', 'answer' => "Our team responds within 2-4 hours during working days. You'll receive a call and email confirmation."),
    array('icon' => 'help-circle', 'question' => 'What documents are needed?', 'answer' => 'Birth certificate, previous school reports, and address proof. We\'ll guide you through the process.'),
    array('icon' => 'help-circle', 'question' => 'Can I visit the campus?', 'answer' => 'Yes! Schedule a campus tour through this form or call us directly to book your visit.'),
    array('icon' => 'help-circle', 'question' => 'Is there an admission test?', 'answer' => 'For certain classes, yes. Our admission team will inform you about the specific requirements.'),
);
$faq_items = (is_array($faq_items) && !empty($faq_items)) ? $faq_items : $default_faq;

$contact_emails_array = array_filter(array_map('trim', explode("\n", $contact_emails)));
$first_email = !empty($contact_emails_array) ? $contact_emails_array[0] : 'mlzs.alwar@mountlitera.com';
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

    <!-- Enquiry Form Section -->
    <section class="relative px-4 sm:px-6 lg:px-8 py-12 sm:py-16 md:py-24 bg-background-light overflow-x-hidden">
        <div class="absolute top-0 left-0 -z-10 h-full w-full overflow-hidden">
            <div class="absolute -top-40 -right-40 h-[500px] w-[500px] rounded-full bg-indigo-velvet/5 blur-[100px]"></div>
            <div class="absolute top-1/2 -left-20 h-[300px] w-[300px] rounded-full bg-amber-flame/10 blur-[80px]"></div>
        </div>
        <div class="mx-auto max-w-7xl w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                <!-- Contact Information -->
                <div class="space-y-6 sm:space-y-8">
                    <!-- Campus Card -->
                    <div class="bg-gradient-to-br from-primary/5 to-primary-light/5 rounded-2xl sm:rounded-3xl p-6 sm:p-8 border border-primary/20 shadow-soft">
                        <div class="flex items-center gap-3 mb-4 sm:mb-6">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary to-primary-light flex items-center justify-center">
                                <i data-lucide="<?php echo esc_attr($campus_icon); ?>" class="w-6 h-6 text-white"></i>
                            </div>
                            <h2 class="text-base sm:text-lg md:text-xl font-bold text-primary"><?php echo esc_html($campus_title); ?></h2>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-start gap-3 group cursor-pointer">
                                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center shrink-0 mt-1 group-hover:bg-primary group-hover:text-white transition-colors">
                                    <i data-lucide="map-pin" class="w-5 h-5 text-primary group-hover:text-white"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs sm:text-sm font-bold text-text-main-light mb-1"><?php echo esc_html($campus_addr_h); ?></h4>
                                    <p class="text-xs sm:text-sm text-text-secondary-light"><?php echo nl2br(esc_html($campus_addr)); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 pt-6 border-t border-primary/20">
                            <a href="<?php echo $campus_map_url; ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-3 sm:px-4 py-2 sm:py-2.5 bg-primary text-white rounded-lg text-xs sm:text-sm font-medium hover:bg-primary-dark transition-colors group/btn">
                                <i data-lucide="<?php echo esc_attr($campus_map_icon); ?>" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                                <span><?php echo esc_html($campus_map_text); ?></span>
                            </a>
                        </div>
                    </div>

                    <!-- Contact Card -->
                    <div class="bg-gradient-to-br from-accent/5 to-accent-dark/5 rounded-2xl sm:rounded-3xl p-6 sm:p-8 border border-accent/20 shadow-soft">
                        <div class="flex items-center gap-3 mb-4 sm:mb-6">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-accent to-accent-dark flex items-center justify-center">
                                <i data-lucide="<?php echo esc_attr($contact_icon); ?>" class="w-6 h-6 text-white"></i>
                            </div>
                            <h2 class="text-base sm:text-lg md:text-xl font-bold text-accent"><?php echo esc_html($contact_title); ?></h2>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3 group cursor-pointer">
                                <div class="w-10 h-10 rounded-full bg-accent/10 flex items-center justify-center shrink-0 mt-1 group-hover:bg-accent group-hover:text-white transition-colors">
                                    <i data-lucide="<?php echo esc_attr($contact_phone_icon); ?>" class="w-5 h-5 text-accent group-hover:text-white"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs sm:text-sm font-bold text-text-main-light mb-1"><?php echo esc_html($contact_phone_label); ?></h4>
                                    <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $contact_phone_number)); ?>" class="text-xs sm:text-sm text-text-secondary-light hover:text-accent transition-colors"><?php echo esc_html($contact_phone_number); ?></a>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 group cursor-pointer">
                                <div class="w-10 h-10 rounded-full bg-accent/10 flex items-center justify-center shrink-0 mt-1 group-hover:bg-accent group-hover:text-white transition-colors">
                                    <i data-lucide="<?php echo esc_attr($contact_email_icon); ?>" class="w-5 h-5 text-accent group-hover:text-white"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs sm:text-sm font-bold text-text-main-light mb-1"><?php echo esc_html($contact_email_label); ?></h4>
                                    <div class="space-y-1">
                                        <?php foreach ($contact_emails_array as $em) : ?>
                                        <a href="mailto:<?php echo esc_attr($em); ?>" class="block text-xs sm:text-sm text-text-secondary-light hover:text-accent transition-colors"><?php echo esc_html($em); ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 pt-6 border-t border-accent/20">
                            <div class="flex flex-wrap gap-2">
                                <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $contact_phone_number)); ?>" class="inline-flex items-center gap-2 px-3 sm:px-4 py-2 sm:py-2.5 bg-accent text-white rounded-lg text-xs sm:text-sm font-medium hover:bg-accent-dark transition-colors group/btn">
                                    <i data-lucide="<?php echo esc_attr($contact_call_icon); ?>" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                                    <span><?php echo esc_html($contact_call_text); ?></span>
                                </a>
                                <a href="mailto:<?php echo esc_attr($first_email); ?>" class="inline-flex items-center gap-2 px-3 sm:px-4 py-2 sm:py-2.5 bg-white border border-accent text-accent rounded-lg text-xs sm:text-sm font-medium hover:bg-accent/5 transition-colors group/btn">
                                    <i data-lucide="<?php echo esc_attr($contact_email_btn_icon); ?>" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                                    <span><?php echo esc_html($contact_email_btn_text); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 gap-3 sm:gap-4">
                        <div class="bg-white rounded-xl p-4 text-center shadow-soft border border-border-light">
                            <div class="text-lg sm:text-xl md:text-2xl font-bold text-primary mb-1"><?php echo esc_html($stat1_number); ?></div>
                            <div class="text-xs sm:text-sm font-medium text-text-secondary-light"><?php echo esc_html($stat1_label); ?></div>
                        </div>
                        <div class="bg-white rounded-xl p-4 text-center shadow-soft border border-border-light">
                            <div class="text-lg sm:text-xl md:text-2xl font-bold text-accent mb-1"><?php echo esc_html($stat2_number); ?></div>
                            <div class="text-xs sm:text-sm font-medium text-text-secondary-light"><?php echo esc_html($stat2_label); ?></div>
                        </div>
                    </div>
                </div>

                <!-- Enquiry Form -->
                <div class="bg-gradient-to-br from-white to-primary/5 rounded-2xl sm:rounded-3xl p-6 sm:p-8 shadow-2xl border border-primary/20">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary to-primary-light flex items-center justify-center">
                            <i data-lucide="<?php echo esc_attr($form_icon); ?>" class="w-6 h-6 text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-primary"><?php echo esc_html($form_title); ?></h2>
                            <p class="text-xs sm:text-sm text-text-secondary-light mt-1"><?php echo esc_html($form_subtitle); ?></p>
                        </div>
                    </div>

                    <form class="form-horizontal space-y-4 sm:space-y-6" method="POST" action="<?php echo esc_url($form_action); ?>" role="form">
                        <div class="space-y-2">
                            <label class="block text-xs sm:text-sm font-medium text-text-main-light">Child's Name <span class="text-red-500">*</span></label>
                            <div class="relative group">
                                <i data-lucide="user" class="absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 w-4 h-4 sm:w-5 sm:h-5 text-text-secondary-light group-focus-within:text-primary transition-colors"></i>
                                <input type="text" class="form-control w-full pl-10 sm:pl-12 pr-4 py-2.5 sm:py-3.5 text-sm sm:text-base rounded-xl border-2 border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-text-secondary-light" name="name" placeholder="Enter Your Child Name" required>
                            </div>
                            <p class="text-xs text-text-secondary-light">Enter your child's full name</p>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-xs sm:text-sm font-medium text-text-main-light">Class <span class="text-red-500">*</span></label>
                            <div class="relative group">
                                <i data-lucide="graduation-cap" class="absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 w-4 h-4 sm:w-5 sm:h-5 text-text-secondary-light group-focus-within:text-primary transition-colors z-10"></i>
                                <select class="form-control w-full pl-10 sm:pl-12 pr-8 sm:pr-10 py-2.5 sm:py-3.5 text-sm sm:text-base rounded-xl border-2 border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all appearance-none cursor-pointer" name="class" required>
                                    <option value="" disabled selected>Select Class</option>
                                    <option value="1st">1st</option>
                                    <option value="2nd">2nd</option>
                                    <option value="3rd">3rd</option>
                                    <option value="4th">4th</option>
                                    <option value="5th">5th</option>
                                    <option value="6th">6th</option>
                                    <option value="7th">7th</option>
                                    <option value="8th">8th</option>
                                    <option value="9th">9th</option>
                                    <option value="11th (Science)">11th (Science)</option>
                                    <option value="11th (Commerce)">11th (Commerce)</option>
                                    <option value="11th (Humanities)">11th (Humanities)</option>
                                </select>
                                <i data-lucide="chevron-down" class="absolute right-3 sm:right-4 top-1/2 -translate-y-1/2 w-4 h-4 sm:w-5 sm:h-5 text-text-secondary-light pointer-events-none"></i>
                            </div>
                            <p class="text-xs text-text-secondary-light">Select the class for admission</p>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-xs sm:text-sm font-medium text-text-main-light">Contact Number <span class="text-red-500">*</span></label>
                            <div class="relative group">
                                <i data-lucide="phone" class="absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 w-4 h-4 sm:w-5 sm:h-5 text-text-secondary-light group-focus-within:text-primary transition-colors"></i>
                                <input type="tel" class="form-control w-full pl-10 sm:pl-12 pr-4 py-2.5 sm:py-3.5 text-sm sm:text-base rounded-xl border-2 border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-text-secondary-light" name="contactnumber" pattern="[0-9]{10}" placeholder="Enter Your Contact No. (10 digits)" required>
                            </div>
                            <p class="text-xs text-text-secondary-light">Enter 10-digit mobile number</p>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-xs sm:text-sm font-medium text-text-main-light">Email Address <span class="text-red-500">*</span></label>
                            <div class="relative group">
                                <i data-lucide="mail" class="absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 w-4 h-4 sm:w-5 sm:h-5 text-text-secondary-light group-focus-within:text-primary transition-colors"></i>
                                <input type="email" class="form-control w-full pl-10 sm:pl-12 pr-4 py-2.5 sm:py-3.5 text-sm sm:text-base rounded-xl border-2 border-border-light bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-text-secondary-light" name="emailid" placeholder="Enter Your Email Id" required>
                            </div>
                            <p class="text-xs text-text-secondary-light">We'll send confirmation to this email</p>
                        </div>

                        <div class="pt-4">
                            <button type="submit" name="submit" class="w-full px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-primary to-primary-dark text-white rounded-xl font-bold text-sm sm:text-base md:text-lg hover:shadow-[0_0_30px_rgba(61,52,139,0.4)] hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2 group/btn">
                                <span><?php echo esc_html($form_submit_text); ?></span>
                                <i data-lucide="<?php echo esc_attr($form_submit_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 group-hover/btn:translate-x-1 transition-transform"></i>
                            </button>
                            <p class="text-center text-xs sm:text-sm text-text-secondary-light mt-4">
                                <?php echo esc_html($form_privacy_text); ?> <a href="<?php echo esc_url($form_privacy_link); ?>" class="text-primary hover:underline"><?php echo esc_html($form_privacy_label); ?></a>
                            </p>
                        </div>

                        <div class="border-t border-border-light pt-6">
                            <div class="grid grid-cols-3 gap-3">
                                <?php
                                $feat_styles = array(0 => 'primary', 1 => 'accent', 2 => 'primary-light');
                                foreach (array_slice($form_features, 0, 3) as $fidx => $f) :
                                    $f_icon = (isset($f['icon']) && trim((string) $f['icon']) !== '') ? trim($f['icon']) : 'shield-check';
                                    $f_label = isset($f['label']) ? (string) $f['label'] : '';
                                    $f_style = isset($feat_styles[$fidx]) ? $feat_styles[$fidx] : 'primary';
                                    $f_box = $f_style === 'primary' ? 'bg-primary/10 text-primary' : ($f_style === 'accent' ? 'bg-accent/10 text-accent' : 'bg-primary-light/10 text-primary-light');
                                ?>
                                <div class="text-center">
                                    <div class="w-8 h-8 rounded-full <?php echo esc_attr($f_box); ?> flex items-center justify-center mx-auto mb-2">
                                        <i data-lucide="<?php echo esc_attr($f_icon); ?>" class="w-4 h-4"></i>
                                    </div>
                                    <p class="text-xs text-text-secondary-light"><?php echo esc_html($f_label); ?></p>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="mt-12 sm:mt-16 bg-gradient-to-r from-primary/5 to-accent/5 rounded-2xl sm:rounded-3xl p-6 sm:p-8 border border-primary/20">
                <div class="text-center mb-6">
                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-text-main-light mb-2"><?php echo esc_html($faq_heading); ?></h3>
                    <p class="text-xs sm:text-sm text-text-secondary-light"><?php echo esc_html($faq_subtext); ?></p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php foreach ($faq_items as $faq) :
                        $faq_icon = (isset($faq['icon']) && trim((string) $faq['icon']) !== '') ? trim($faq['icon']) : 'help-circle';
                        $faq_q = isset($faq['question']) ? (string) $faq['question'] : '';
                        $faq_a = isset($faq['answer']) ? (string) $faq['answer'] : '';
                        if ($faq_q === '') continue;
                    ?>
                    <div class="bg-white rounded-xl p-4 shadow-soft border border-border-light">
                        <h4 class="text-sm sm:text-base font-bold text-text-main-light mb-2 flex items-center gap-2">
                            <i data-lucide="<?php echo esc_attr($faq_icon); ?>" class="w-4 h-4 text-primary"></i>
                            <?php echo esc_html($faq_q); ?>
                        </h4>
                        <p class="text-xs sm:text-sm text-text-secondary-light"><?php echo esc_html($faq_a); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
