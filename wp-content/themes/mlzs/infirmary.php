<?php
/**
 * Template Name: Infirmary Page
 * Infirmary: Hero, Wellness Philosophy, Features, Hygiene, Gallery, CTA – ACF dynamic
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$home_url = home_url('/');
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge     = $opt ? get_field('infirmary_hero_badge', $page_id) : null;
$hero_icon      = $opt ? get_field('infirmary_hero_icon', $page_id) : null;
$hero_headline  = $opt ? get_field('infirmary_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('infirmary_hero_highlight', $page_id) : null;
$hero_sub       = $opt ? get_field('infirmary_hero_subheadline', $page_id) : null;

$hero_badge     = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Health & Wellness';
$hero_icon      = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'heart-pulse';
$hero_headline  = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'School';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Infirmary';
$hero_sub       = ($hero_sub !== '' && $hero_sub !== null) ? (string) $hero_sub : 'Dedicated healthcare facility ensuring the well-being of every learner during school hours';

// ——— Wellness Philosophy ———
$wellness_icon   = $opt ? get_field('infirmary_wellness_icon', $page_id) : null;
$wellness_heading = $opt ? get_field('infirmary_wellness_heading', $page_id) : null;
$wellness_highlight = $opt ? get_field('infirmary_wellness_highlight', $page_id) : null;
$wellness_para1 = $opt ? get_field('infirmary_wellness_para1', $page_id) : null;
$wellness_para2 = $opt ? get_field('infirmary_wellness_para2', $page_id) : null;
$wellness_image = $opt ? get_field('infirmary_wellness_image', $page_id) : null;
$wellness_badge_title   = $opt ? get_field('infirmary_wellness_badge_title', $page_id) : null;
$wellness_badge_subtitle = $opt ? get_field('infirmary_wellness_badge_subtitle', $page_id) : null;

$wellness_icon   = (is_string($wellness_icon) && trim($wellness_icon) !== '') ? trim($wellness_icon) : 'heart';
$wellness_heading = ($wellness_heading !== '' && $wellness_heading !== null) ? (string) $wellness_heading : 'Our Commitment to';
$wellness_highlight = ($wellness_highlight !== '' && $wellness_highlight !== null) ? (string) $wellness_highlight : 'Well-being';
$wellness_para1 = ($wellness_para1 !== '' && $wellness_para1 !== null) ? $wellness_para1 : 'At Mount Litera Zee School Alwar, the well-being of learners is of great importance to us. We provide direct nursing services to learners and staff members to maximize health and wellness in the school community.';
$wellness_para2 = ($wellness_para2 !== '' && $wellness_para2 !== null) ? $wellness_para2 : 'We understand that as the children spend most of their time in school, we could be faced with emergencies pertaining to the health of our students. Minor injuries during sports and games or while performing experiments and even common fever are unavoidable parts of growing.';
$wellness_badge_title   = ($wellness_badge_title !== '' && $wellness_badge_title !== null) ? (string) $wellness_badge_title : 'Ready';
$wellness_badge_subtitle = ($wellness_badge_subtitle !== '' && $wellness_badge_subtitle !== null) ? (string) $wellness_badge_subtitle : 'For Emergencies';

$wellness_image_url = '';
if (!empty($wellness_image)) {
    if (is_array($wellness_image) && !empty($wellness_image['url'])) $wellness_image_url = $wellness_image['url'];
    elseif (is_numeric($wellness_image)) $wellness_image_url = wp_get_attachment_image_url((int) $wellness_image, 'full') ?: '';
}
if ($wellness_image_url === '') $wellness_image_url = 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';

// ——— Infirmary Features ———
$feat_heading   = $opt ? get_field('infirmary_features_heading', $page_id) : null;
$feat_highlight = $opt ? get_field('infirmary_features_highlight', $page_id) : null;
$feat_subtext   = $opt ? get_field('infirmary_features_subtext', $page_id) : null;
$feat_center_icon  = $opt ? get_field('infirmary_features_center_icon', $page_id) : null;
$feat_center_title = $opt ? get_field('infirmary_features_center_title', $page_id) : null;
$feat_center_para  = $opt ? get_field('infirmary_features_center_para', $page_id) : null;
$feat_checklist = $opt ? get_field('infirmary_features_checklist', $page_id) : null;
$feat_nurse_icon  = $opt ? get_field('infirmary_features_nurse_icon', $page_id) : null;
$feat_nurse_title = $opt ? get_field('infirmary_features_nurse_title', $page_id) : null;
$feat_nurse_para  = $opt ? get_field('infirmary_features_nurse_para', $page_id) : null;
$feat_capacity_icon  = $opt ? get_field('infirmary_features_capacity_icon', $page_id) : null;
$feat_capacity_title = $opt ? get_field('infirmary_features_capacity_title', $page_id) : null;
$feat_capacity_para  = $opt ? get_field('infirmary_features_capacity_para', $page_id) : null;

$feat_heading   = ($feat_heading !== '' && $feat_heading !== null) ? (string) $feat_heading : 'Fully Equipped';
$feat_highlight = ($feat_highlight !== '' && $feat_highlight !== null) ? (string) $feat_highlight : 'Infirmary';
$feat_subtext   = ($feat_subtext !== '' && $feat_subtext !== null) ? (string) $feat_subtext : 'Strategically located at the heart of the school premise to provide immediate medical attention';
$feat_center_icon  = (is_string($feat_center_icon) && trim($feat_center_icon) !== '') ? trim($feat_center_icon) : 'shield-check';
$feat_center_title = ($feat_center_title !== '' && $feat_center_title !== null) ? (string) $feat_center_title : 'Emergency Preparedness';
$feat_center_para  = ($feat_center_para !== '' && $feat_center_para !== null) ? $feat_center_para : 'To meet these emergencies we have an Infirmary at the heart of the School premise. The school infirmary is equipped with the basic materials and facilities to address the health needs of learners while in school.';
$default_checklist = array(
    array('label' => 'First Aid Supplies', 'icon_style' => 'primary'),
    array('label' => 'Emergency Equipment', 'icon_style' => 'primary-light'),
    array('label' => 'Medication Storage', 'icon_style' => 'accent'),
    array('label' => 'Resting Area', 'icon_style' => 'primary'),
);
$feat_checklist = (is_array($feat_checklist) && !empty($feat_checklist)) ? $feat_checklist : $default_checklist;
$feat_nurse_icon  = (is_string($feat_nurse_icon) && trim($feat_nurse_icon) !== '') ? trim($feat_nurse_icon) : 'user-check';
$feat_nurse_title = ($feat_nurse_title !== '' && $feat_nurse_title !== null) ? (string) $feat_nurse_title : 'Qualified Nurse';
$feat_nurse_para  = ($feat_nurse_para !== '' && $feat_nurse_para !== null) ? $feat_nurse_para : 'An on-site trained and qualified nurse is available to manage and assess any health issues that may arise during school hours.';
$feat_capacity_icon  = (is_string($feat_capacity_icon) && trim($feat_capacity_icon) !== '') ? trim($feat_capacity_icon) : 'bed';
$feat_capacity_title = ($feat_capacity_title !== '' && $feat_capacity_title !== null) ? (string) $feat_capacity_title : 'Four-Bed Capacity';
$feat_capacity_para  = ($feat_capacity_para !== '' && $feat_capacity_para !== null) ? $feat_capacity_para : 'With a four bed capacity, the infirmary provides ample space for students requiring medical attention and rest.';

// ——— Hygiene & Wellness ———
$hygiene_icon   = $opt ? get_field('infirmary_hygiene_icon', $page_id) : null;
$hygiene_heading = $opt ? get_field('infirmary_hygiene_heading', $page_id) : null;
$hygiene_para   = $opt ? get_field('infirmary_hygiene_para', $page_id) : null;
$hygiene_tags   = $opt ? get_field('infirmary_hygiene_tags', $page_id) : null;
$hygiene_stats  = $opt ? get_field('infirmary_hygiene_stats', $page_id) : null;

$hygiene_icon   = (is_string($hygiene_icon) && trim($hygiene_icon) !== '') ? trim($hygiene_icon) : 'sparkles';
$hygiene_heading = ($hygiene_heading !== '' && $hygiene_heading !== null) ? (string) $hygiene_heading : 'Hygienic Excellence';
$hygiene_para   = ($hygiene_para !== '' && $hygiene_para !== null) ? $hygiene_para : 'The infirmary is hygienically maintained confirming to our belief of wellness of mind, body and soul. We follow strict sanitation protocols to ensure a clean and safe environment for all students.';
$default_hygiene_tags = array(array('label' => 'Daily Sanitization'), array('label' => 'Sterile Equipment'), array('label' => 'PPE Available'));
$hygiene_tags = (is_array($hygiene_tags) && !empty($hygiene_tags)) ? $hygiene_tags : $default_hygiene_tags;
$default_hygiene_stats = array(
    array('number' => '24/7', 'label' => 'Medical Support', 'color' => 'primary'),
    array('number' => '4', 'label' => 'Patient Beds', 'color' => 'primary-light'),
    array('number' => '100%', 'label' => 'Hygiene Standard', 'color' => 'accent'),
    array('number' => '1', 'label' => 'Qualified Nurse', 'color' => 'primary'),
);
$hygiene_stats = (is_array($hygiene_stats) && count($hygiene_stats) >= 4) ? $hygiene_stats : $default_hygiene_stats;

// ——— Medical Gallery ———
$gallery_heading = $opt ? get_field('infirmary_gallery_heading', $page_id) : null;
$gallery_highlight = $opt ? get_field('infirmary_gallery_highlight', $page_id) : null;
$gallery_subtext = $opt ? get_field('infirmary_gallery_subtext', $page_id) : null;
$gallery_items   = $opt ? get_field('infirmary_gallery_items', $page_id) : null;

$gallery_heading = ($gallery_heading !== '' && $gallery_heading !== null) ? (string) $gallery_heading : 'Infirmary';
$gallery_highlight = ($gallery_highlight !== '' && $gallery_highlight !== null) ? (string) $gallery_highlight : 'Facilities';
$gallery_subtext = ($gallery_subtext !== '' && $gallery_subtext !== null) ? (string) $gallery_subtext : 'Modern medical facilities designed specifically for school healthcare needs';
$default_gallery_items = array(
    array('image' => array('url' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'), 'title' => 'Medical Equipment', 'subtitle' => 'Fully stocked with essential medical supplies', 'badge' => 'Equipment', 'gradient' => 'primary'),
    array('image' => array('url' => 'https://images.unsplash.com/photo-1584467735871-8db71e18c3a6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'), 'title' => 'Care Area', 'subtitle' => 'Comfortable resting area for students', 'badge' => 'Care Zone', 'gradient' => 'primary-light'),
);
$gallery_items = (is_array($gallery_items) && count($gallery_items) >= 2) ? $gallery_items : $default_gallery_items;

// ——— CTA ———
$cta_heading = $opt ? get_field('infirmary_cta_heading', $page_id) : null;
$cta_para    = $opt ? get_field('infirmary_cta_para', $page_id) : null;
$cta_btn1_icon = $opt ? get_field('infirmary_cta_btn1_icon', $page_id) : null;
$cta_btn1_link = $opt ? get_field('infirmary_cta_btn1_link', $page_id) : null;
$cta_btn2_icon = $opt ? get_field('infirmary_cta_btn2_icon', $page_id) : null;
$cta_btn2_link = $opt ? get_field('infirmary_cta_btn2_link', $page_id) : null;
$cta_boxes   = $opt ? get_field('infirmary_cta_boxes', $page_id) : null;

$cta_heading = ($cta_heading !== '' && $cta_heading !== null) ? (string) $cta_heading : 'Health & Safety Protocols';
$cta_para    = ($cta_para !== '' && $cta_para !== null) ? $cta_para : 'Parents are notified immediately in case of any medical emergency. We maintain detailed health records and follow strict protocols for medication administration.';
$cta_btn1_icon = (is_string($cta_btn1_icon) && trim($cta_btn1_icon) !== '') ? trim($cta_btn1_icon) : 'file-text';
$cta_btn2_icon = (is_string($cta_btn2_icon) && trim($cta_btn2_icon) !== '') ? trim($cta_btn2_icon) : 'phone';
$cta_btn1_url = is_array($cta_btn1_link) && !empty($cta_btn1_link['url']) ? esc_url($cta_btn1_link['url']) : $home_url . '#';
$cta_btn1_target = is_array($cta_btn1_link) && !empty($cta_btn1_link['target']) ? $cta_btn1_link['target'] : '_self';
$cta_btn1_text = (is_array($cta_btn1_link) && !empty(trim((string) $cta_btn1_link['title']))) ? trim($cta_btn1_link['title']) : 'View Health Protocols';
$cta_btn2_url = is_array($cta_btn2_link) && !empty($cta_btn2_link['url']) ? esc_url($cta_btn2_link['url']) : $home_url . '#';
$cta_btn2_target = is_array($cta_btn2_link) && !empty($cta_btn2_link['target']) ? $cta_btn2_link['target'] : '_self';
$cta_btn2_text = (is_array($cta_btn2_link) && !empty(trim((string) $cta_btn2_link['title']))) ? trim($cta_btn2_link['title']) : 'Contact Nurse';
$default_cta_boxes = array(
    array('title' => 'Immediate', 'label' => 'Response Time'),
    array('title' => 'Parent', 'label' => 'Notification System'),
    array('title' => 'Health', 'label' => 'Records Maintained'),
    array('title' => 'Trained', 'label' => 'Medical Staff'),
);
$cta_boxes = (is_array($cta_boxes) && count($cta_boxes) >= 4) ? $cta_boxes : $default_cta_boxes;

// Helper: image URL from gallery item
if (!function_exists('mlzs_infirmary_gallery_img_url')) {
    function mlzs_infirmary_gallery_img_url($item) {
        if (empty($item) || !isset($item['image'])) return '';
        $img = $item['image'];
        if (is_array($img) && !empty($img['url'])) return $img['url'];
        if (is_numeric($img)) return wp_get_attachment_image_url((int) $img, 'full') ?: '';
        return '';
    }
}
?>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary via-primary-dark to-slate-900 px-4 sm:px-6 lg:px-8 pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')]"></div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-accent/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>

        <div class="relative z-10 max-w-7xl mx-auto">
            <div class="text-center text-white">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 backdrop-blur-md border border-white/30 mb-6 animate-fade-in-up">
                    <i data-lucide="<?php echo esc_attr($hero_icon); ?>" class="w-5 h-5 text-accent"></i>
                    <span class="text-sm font-semibold uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-6 tracking-tight">
                    <?php echo esc_html($hero_headline); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame to-tiger-orange"><?php echo esc_html($hero_highlight); ?></span>
                </h1>
                <p class="text-base sm:text-lg md:text-xl text-slate-200 max-w-3xl mx-auto leading-relaxed">
                    <?php echo esc_html($hero_sub); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Wellness Philosophy -->
    <section class="px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center mb-16">
                <div class="space-y-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary/10 to-primary-light/10 flex items-center justify-center">
                            <i data-lucide="<?php echo esc_attr($wellness_icon); ?>" class="w-6 h-6 text-primary"></i>
                        </div>
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-slate-900"><?php echo esc_html($wellness_heading); ?> <span class="text-primary"><?php echo esc_html($wellness_highlight); ?></span></h2>
                    </div>

                    <div class="space-y-4">
                        <div class="bg-gradient-to-r from-primary/5 to-primary-light/5 rounded-2xl p-6 border border-primary/20">
                            <p class="text-base sm:text-lg text-slate-700 leading-relaxed">
                                <?php echo esc_html($wellness_para1); ?>
                            </p>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-soft border border-slate-100">
                            <p class="text-base sm:text-lg text-slate-700 leading-relaxed">
                                <?php echo esc_html($wellness_para2); ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="rounded-2xl overflow-hidden shadow-xl border-4 border-white">
                        <img src="<?php echo esc_url($wellness_image_url); ?>" alt="<?php echo esc_attr($wellness_badge_title); ?>" class="w-full h-[350px] md:h-[400px] object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/30 to-transparent"></div>
                    </div>
                    <div class="absolute -bottom-4 -left-4 md:-bottom-6 md:-left-6 bg-gradient-to-br from-primary to-primary-light rounded-xl p-3 md:p-4 text-white shadow-2xl">
                        <div class="text-lg md:text-2xl font-bold"><?php echo esc_html($wellness_badge_title); ?></div>
                        <div class="text-xs font-medium uppercase tracking-wide"><?php echo esc_html($wellness_badge_subtitle); ?></div>
                    </div>
                </div>
            </div>

            <!-- Infirmary Features -->
            <div class="mb-16">
                <div class="text-center mb-12">
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-900 mb-4">
                        <?php echo esc_html($feat_heading); ?> <span class="text-primary"><?php echo esc_html($feat_highlight); ?></span>
                    </h3>
                    <p class="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto">
                        <?php echo esc_html($feat_subtext); ?>
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 bg-gradient-to-br from-white to-primary/5 rounded-2xl p-6 md:p-8 shadow-soft border border-primary/20 relative overflow-hidden">
                        <div class="absolute -right-10 -top-10 w-40 h-40 bg-gradient-to-br from-primary/10 to-transparent rounded-full"></div>
                        <div class="relative z-10">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-primary to-primary-light flex items-center justify-center">
                                    <i data-lucide="<?php echo esc_attr($feat_center_icon); ?>" class="w-7 h-7 text-white"></i>
                                </div>
                                <h4 class="text-lg sm:text-xl font-bold text-slate-900"><?php echo esc_html($feat_center_title); ?></h4>
                            </div>
                            <p class="text-sm sm:text-base text-slate-700 leading-relaxed mb-6">
                                <?php echo esc_html($feat_center_para); ?>
                            </p>

                            <div class="grid grid-cols-2 gap-3 md:gap-4">
                                <?php foreach ($feat_checklist as $chk) :
                                    $chk_label = isset($chk['label']) ? (string) $chk['label'] : '';
                                    $chk_style = isset($chk['icon_style']) && in_array($chk['icon_style'], array('primary','primary-light','accent'), true) ? $chk['icon_style'] : 'primary';
                                    $chk_bg = $chk_style === 'primary-light' ? 'bg-primary-light/10' : ($chk_style === 'accent' ? 'bg-accent/10' : 'bg-primary/10');
                                    $chk_text = $chk_style === 'primary-light' ? 'text-primary-light' : ($chk_style === 'accent' ? 'text-accent' : 'text-primary');
                                    if ($chk_label === '') continue;
                                ?>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full <?php echo esc_attr($chk_bg); ?> flex items-center justify-center">
                                        <i data-lucide="check" class="w-4 h-4 <?php echo esc_attr($chk_text); ?>"></i>
                                    </div>
                                    <span class="text-xs sm:text-sm text-slate-700 font-medium"><?php echo esc_html($chk_label); ?></span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white rounded-2xl p-6 shadow-soft border border-slate-100 hover:border-primary/30 transition-all duration-300 hover:-translate-y-2">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-light/10 to-accent/10 flex items-center justify-center mb-4">
                                <i data-lucide="<?php echo esc_attr($feat_nurse_icon); ?>" class="w-6 h-6 text-primary-light"></i>
                            </div>
                            <h4 class="text-lg sm:text-xl font-bold text-slate-900 mb-3"><?php echo esc_html($feat_nurse_title); ?></h4>
                            <p class="text-sm sm:text-base text-slate-600">
                                <?php echo $feat_nurse_para; ?>
                            </p>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-soft border border-slate-100 hover:border-accent/30 transition-all duration-300 hover:-translate-y-2">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-accent/10 to-accent-dark/10 flex items-center justify-center mb-4">
                                <i data-lucide="<?php echo esc_attr($feat_capacity_icon); ?>" class="w-6 h-6 text-accent"></i>
                            </div>
                            <h4 class="text-lg sm:text-xl font-bold text-slate-900 mb-3"><?php echo esc_html($feat_capacity_title); ?></h4>
                            <p class="text-sm sm:text-base text-slate-600">
                                <?php echo $feat_capacity_para; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hygiene & Wellness Section -->
            <div class="mb-16">
                <div class="bg-gradient-to-r from-primary/5 to-primary-light/5 rounded-3xl p-8 md:p-12 border border-primary/20">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                        <div>
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-primary-light to-accent flex items-center justify-center">
                                    <i data-lucide="<?php echo esc_attr($hygiene_icon); ?>" class="w-7 h-7 text-white"></i>
                                </div>
                                <h3 class="text-2xl sm:text-3xl font-bold text-slate-900"><?php echo esc_html($hygiene_heading); ?></h3>
                            </div>
                            <p class="text-base sm:text-lg text-slate-700 leading-relaxed mb-6">
                                <?php echo esc_html($hygiene_para); ?>
                            </p>

                            <div class="flex flex-wrap items-center gap-3 md:gap-4">
                                <?php foreach ($hygiene_tags as $tag) :
                                    $tlabel = isset($tag['label']) ? (string) $tag['label'] : '';
                                    if ($tlabel === '') continue;
                                ?>
                                <div class="flex items-center gap-2">
                                    <i data-lucide="shield" class="w-4 h-4 sm:w-5 sm:h-5 text-primary-light"></i>
                                    <span class="text-xs sm:text-sm font-medium text-slate-700"><?php echo esc_html($tlabel); ?></span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 md:gap-4">
                            <?php foreach ($hygiene_stats as $st) :
                                $st_num = isset($st['number']) ? (string) $st['number'] : '';
                                $st_lab = isset($st['label']) ? (string) $st['label'] : '';
                                $st_col = isset($st['color']) && in_array($st['color'], array('primary','primary-light','accent'), true) ? $st['color'] : 'primary';
                                $st_class = $st_col === 'primary-light' ? 'text-primary-light' : ($st_col === 'accent' ? 'text-accent' : 'text-primary');
                            ?>
                            <div class="bg-white rounded-xl p-4 md:p-6 text-center shadow-sm border border-slate-100">
                                <div class="text-xl md:text-2xl lg:text-3xl font-bold <?php echo esc_attr($st_class); ?> mb-2"><?php echo esc_html($st_num); ?></div>
                                <div class="text-xs md:text-sm font-medium text-slate-600"><?php echo esc_html($st_lab); ?></div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Medical Gallery -->
            <div class="mb-16">
                <div class="text-center mb-12">
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-900 mb-4">
                        <?php echo esc_html($gallery_heading); ?> <span class="text-primary"><?php echo esc_html($gallery_highlight); ?></span>
                    </h3>
                    <p class="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto">
                        <?php echo esc_html($gallery_subtext); ?>
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php foreach ($gallery_items as $gitem) :
                        $gimg = mlzs_infirmary_gallery_img_url($gitem);
                        if ($gimg === '') $gimg = 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                        $gtitle = isset($gitem['title']) ? (string) $gitem['title'] : '';
                        $gsub = isset($gitem['subtitle']) ? (string) $gitem['subtitle'] : '';
                        $gbadge = isset($gitem['badge']) ? (string) $gitem['badge'] : '';
                        $ggrad = isset($gitem['gradient']) && $gitem['gradient'] === 'primary-light' ? 'from-primary-light/50' : 'from-primary/50';
                    ?>
                    <div class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500">
                        <div class="h-64">
                            <img src="<?php echo esc_url($gimg); ?>" alt="<?php echo esc_attr($gtitle); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t <?php echo esc_attr($ggrad); ?> to-transparent"></div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 md:p-6 text-white">
                            <h4 class="text-lg sm:text-xl font-bold mb-2"><?php echo esc_html($gtitle); ?></h4>
                            <p class="text-xs sm:text-sm opacity-90"><?php echo esc_html($gsub); ?></p>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span class="px-2 py-1 md:px-3 rounded-full <?php echo $ggrad === 'from-primary-light/50' ? 'bg-primary-light' : 'bg-primary'; ?> text-white text-xs font-bold uppercase"><?php echo esc_html($gbadge); ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Health Protocol CTA -->
            <div class="bg-gradient-to-r from-primary to-primary-light rounded-3xl p-6 md:p-8 lg:p-12 text-white">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-8 items-center">
                    <div>
                        <h3 class="text-xl sm:text-2xl md:text-3xl font-bold mb-4"><?php echo esc_html($cta_heading); ?></h3>
                        <p class="text-sm sm:text-base md:text-lg text-white/80 leading-relaxed mb-6">
                            <?php echo esc_html($cta_para); ?>
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="<?php echo $cta_btn1_url; ?>" target="<?php echo esc_attr($cta_btn1_target); ?>" class="px-4 py-2 sm:px-6 sm:py-3 bg-white text-primary rounded-full font-bold hover:bg-white/90 transition-all flex items-center justify-center gap-2 group w-full sm:w-auto text-sm sm:text-base">
                                <?php echo esc_html($cta_btn1_text); ?>
                                <i data-lucide="<?php echo esc_attr($cta_btn1_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                            <a href="<?php echo $cta_btn2_url; ?>" target="<?php echo esc_attr($cta_btn2_target); ?>" class="px-4 py-2 sm:px-6 sm:py-3 bg-white/20 border border-white/30 text-white rounded-full font-bold hover:bg-white/30 transition-all flex items-center justify-center gap-2 group w-full sm:w-auto text-sm sm:text-base">
                                <i data-lucide="<?php echo esc_attr($cta_btn2_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                                <?php echo esc_html($cta_btn2_text); ?>
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 md:gap-4">
                        <?php foreach ($cta_boxes as $box) :
                            $bxtitle = isset($box['title']) ? (string) $box['title'] : '';
                            $bxlabel = isset($box['label']) ? (string) $box['label'] : '';
                        ?>
                        <div class="bg-white/10 rounded-xl p-4 md:p-6 text-center border border-white/20">
                            <div class="text-lg md:text-xl lg:text-2xl font-bold mb-2"><?php echo esc_html($bxtitle); ?></div>
                            <div class="text-xs md:text-sm font-medium text-white/80"><?php echo esc_html($bxlabel); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
