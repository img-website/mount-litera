<?php
/**
 * Template Name: Transport Page
 * School Transport: Hero, Introduction, Bus Policy & Guidelines (with nested points), Bus Rules, Fleet, CTA. UI matches transport.html exactly.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// Icon style classes
$icon_styles = array(
    'primary'      => array('bg' => 'bg-primary/10', 'icon' => 'text-primary', 'box' => 'bg-primary/5'),
    'primary-light' => array('bg' => 'bg-primary-light/10', 'icon' => 'text-primary-light', 'box' => 'bg-primary-light/5'),
    'accent'       => array('bg' => 'bg-accent/10', 'icon' => 'text-accent', 'box' => 'bg-accent/5'),
    'green'        => array('bg' => 'bg-green-100', 'icon' => 'text-green-600', 'box' => 'bg-green-50'),
);

// ——— Hero ———
$hero_badge = $opt ? get_field('transport_hero_badge', $page_id) : null;
$hero_icon = $opt ? get_field('transport_hero_icon', $page_id) : null;
$hero_before = $opt ? get_field('transport_hero_headline_before', $page_id) : null;
$hero_highlight = $opt ? get_field('transport_hero_headline_highlight', $page_id) : null;
$hero_subtext = $opt ? get_field('transport_hero_subtext', $page_id) : null;

$hero_badge = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Safe Transportation';
$hero_icon = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'bus';
$hero_before = ($hero_before !== '' && $hero_before !== null) ? (string) $hero_before : 'School';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Transport';
$hero_subtext = ($hero_subtext !== '' && $hero_subtext !== null) ? (string) $hero_subtext : 'Safe, reliable, and efficient transportation services for our students';

// ——— Introduction Notice ———
$intro_icon = $opt ? get_field('transport_intro_icon', $page_id) : null;
$intro_title = $opt ? get_field('transport_intro_title', $page_id) : null;
$intro_paragraph = $opt ? get_field('transport_intro_paragraph', $page_id) : null;
$intro_icon_style = $opt ? get_field('transport_intro_icon_style', $page_id) : null;

$intro_icon = (is_string($intro_icon) && trim($intro_icon) !== '') ? trim($intro_icon) : 'alert-circle';
$intro_title = ($intro_title !== '' && $intro_title !== null) ? (string) $intro_title : 'Important Notice for Parents';
$intro_paragraph = ($intro_paragraph !== '' && $intro_paragraph !== null) ? (string) $intro_paragraph : 'Parents are requested to kindly go through the following rules and guidelines regarding school bus transportation.';
$intro_icon_style = ($intro_icon_style !== '' && $intro_icon_style !== null) ? (string) $intro_icon_style : 'primary';

// ——— Bus Policy & Guidelines ———
$policy_icon = $opt ? get_field('transport_policy_icon', $page_id) : null;
$policy_title = $opt ? get_field('transport_policy_title', $page_id) : null;
$policy_icon_style = $opt ? get_field('transport_policy_icon_style', $page_id) : null;
$policy_rules = $opt ? get_field('transport_policy_rules', $page_id) : null;

$policy_icon = (is_string($policy_icon) && trim($policy_icon) !== '') ? trim($policy_icon) : 'clipboard-check';
$policy_title = ($policy_title !== '' && $policy_title !== null) ? (string) $policy_title : 'Bus Policy & Guidelines';
$policy_icon_style = ($policy_icon_style !== '' && $policy_icon_style !== null) ? (string) $policy_icon_style : 'primary';

$default_policy_rules = array(
    array('icon' => 'shield', 'title' => 'Lady Escort on Every Bus', 'paragraph' => 'We provide a lady escort on the bus at all times for the safety and well-being of our students.', 'style' => 'primary', 'sub_points' => array()),
    array('icon' => 'clock', 'title' => 'Punctuality Required', 'paragraph' => 'Children should be ready and waiting at their stops 5 minutes before pick up time.', 'style' => 'primary', 'sub_points' => array()),
    array('icon' => 'calendar', 'title' => 'Tight Schedule', 'paragraph' => 'Bus routes are very tightly scheduled so that children and teachers get to school on time. The buses WILL NOT wait for latecomers either at the stop or at school for the return trip.', 'style' => 'primary', 'sub_points' => array()),
    array('icon' => 'phone', 'title' => 'Bus Communication', 'paragraph' => 'Each bus is equipped with a phone. Parents are encouraged to use this number when required:', 'style' => 'primary', 'sub_points' => array(
        array('text' => 'Inform the escort on the bus if your child is not attending the school for some reason.'),
        array('text' => 'Check if the bus is running late (for the return trip). As there is a traffic jam for as long as 15 minutes often and it is not possible to inform every parent.'),
    )),
    array('icon' => 'edit', 'title' => 'Route Changes', 'paragraph' => 'Any changes in pick up/drop off venue should be cleared with the office (in writing). The office will then inform the bus driver of the change.', 'style' => 'primary', 'sub_points' => array()),
    array('icon' => 'map-pin', 'title' => 'Service Coverage', 'paragraph' => 'The buses cannot provide door-to-door service, as this increases the time spent commuting to and from school.', 'style' => 'primary', 'sub_points' => array()),
    array('icon' => 'users', 'title' => 'Student Conduct', 'paragraph' => 'Students are expected to maintain proper decorum in the bus. The following are the BUS RULES:', 'style' => 'primary', 'sub_points' => array()),
);
$policy_rules = (is_array($policy_rules) && !empty($policy_rules)) ? $policy_rules : $default_policy_rules;

// ——— Bus Rules & Regulations ———
$rules_icon = $opt ? get_field('transport_rules_icon', $page_id) : null;
$rules_title = $opt ? get_field('transport_rules_title', $page_id) : null;
$rules_icon_style = $opt ? get_field('transport_rules_icon_style', $page_id) : null;
$rules_list = $opt ? get_field('transport_rules_list', $page_id) : null;

$rules_icon = (is_string($rules_icon) && trim($rules_icon) !== '') ? trim($rules_icon) : 'list-checks';
$rules_title = ($rules_title !== '' && $rules_title !== null) ? (string) $rules_title : 'Bus Rules & Regulations';
$rules_icon_style = ($rules_icon_style !== '' && $rules_icon_style !== null) ? (string) $rules_icon_style : 'accent';

$default_rules_list = array(
    array('title' => 'Engaging Activities', 'paragraph' => 'Different activities are conducted to make the best use of time during their journey in bus.', 'sub_points' => array()),
    array('title' => 'Safety First', 'paragraph' => 'Students should remain seated at all times and keep noise levels low.', 'sub_points' => array()),
    array('title' => 'Window Safety', 'paragraph' => 'Not stick hands or head out of the window for safety reasons.', 'sub_points' => array()),
    array('title' => 'Respectful Behavior', 'paragraph' => 'Not to be rude to people on the road and maintain proper conduct.', 'sub_points' => array()),
    array('title' => 'No Eating Policy', 'paragraph' => 'Not eat in the bus to maintain cleanliness and hygiene.', 'sub_points' => array()),
    array('title' => 'Cleanliness', 'paragraph' => 'Not litter things in the bus, failing which, penalties will be imposed, including exclusion from the bus service.', 'sub_points' => array()),
);
$rules_list = (is_array($rules_list) && !empty($rules_list)) ? $rules_list : $default_rules_list;

// ——— Transport Fleet ———
$fleet_icon = $opt ? get_field('transport_fleet_icon', $page_id) : null;
$fleet_title = $opt ? get_field('transport_fleet_title', $page_id) : null;
$fleet_icon_style = $opt ? get_field('transport_fleet_icon_style', $page_id) : null;
$fleet_image = $opt ? get_field('transport_fleet_image', $page_id) : null;
$fleet_caption = $opt ? get_field('transport_fleet_caption', $page_id) : null;
$fleet_features = $opt ? get_field('transport_fleet_features', $page_id) : null;

$fleet_icon = (is_string($fleet_icon) && trim($fleet_icon) !== '') ? trim($fleet_icon) : 'image';
$fleet_title = ($fleet_title !== '' && $fleet_title !== null) ? (string) $fleet_title : 'Our Transport Fleet';
$fleet_icon_style = ($fleet_icon_style !== '' && $fleet_icon_style !== null) ? (string) $fleet_icon_style : 'primary';
$fleet_img_url = (is_array($fleet_image) && !empty($fleet_image['url'])) ? $fleet_image['url'] : 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
$fleet_caption = ($fleet_caption !== '' && $fleet_caption !== null) ? (string) $fleet_caption : 'Modern, Safe & Comfortable Buses';

$default_fleet_features = array(
    array('icon' => 'shield', 'label' => 'GPS Tracking', 'style' => 'primary'),
    array('icon' => 'camera', 'label' => 'CCTV Cameras', 'style' => 'primary'),
    array('icon' => 'user-check', 'label' => 'Trained Drivers', 'style' => 'primary'),
    array('icon' => 'first-aid', 'label' => 'First Aid Kit', 'style' => 'primary'),
);
$fleet_features = (is_array($fleet_features) && !empty($fleet_features)) ? $fleet_features : $default_fleet_features;

// ——— CTA ———
$cta_heading = $opt ? get_field('transport_cta_heading', $page_id) : null;
$cta_paragraph = $opt ? get_field('transport_cta_paragraph', $page_id) : null;
$cta_btn1 = $opt ? get_field('transport_cta_btn1', $page_id) : null;
$cta_btn1_icon = $opt ? get_field('transport_cta_btn1_icon', $page_id) : null;
$cta_btn2 = $opt ? get_field('transport_cta_btn2', $page_id) : null;
$cta_btn2_icon = $opt ? get_field('transport_cta_btn2_icon', $page_id) : null;
$cta_stats = $opt ? get_field('transport_cta_stats', $page_id) : null;

$cta_heading = ($cta_heading !== '' && $cta_heading !== null) ? (string) $cta_heading : 'Need More Information?';
$cta_paragraph = ($cta_paragraph !== '' && $cta_paragraph !== null) ? (string) $cta_paragraph : 'For detailed bus routes, timings, and registration information, please contact our transport department.';
$cta_btn1_icon = (is_string($cta_btn1_icon) && trim($cta_btn1_icon) !== '') ? trim($cta_btn1_icon) : 'phone';
$cta_btn2_icon = (is_string($cta_btn2_icon) && trim($cta_btn2_icon) !== '') ? trim($cta_btn2_icon) : 'download';

$default_cta_stats = array(
    array('value' => '24/7', 'label' => 'Support'),
    array('value' => '100%', 'label' => 'Safety Record'),
    array('value' => 'GPS', 'label' => 'Enabled'),
    array('value' => 'Lady', 'label' => 'Escorts'),
);
$cta_stats = (is_array($cta_stats) && !empty($cta_stats)) ? $cta_stats : $default_cta_stats;
?>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary via-primary-dark to-slate-900 px-4 sm:px-6 lg:px-8 pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')]"></div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-accent/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto">
            <div class="text-center text-white">
                <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 rounded-full bg-white/20 backdrop-blur-md border border-white/30 mb-4 sm:mb-6 animate-fade-in-up">
                    <i data-lucide="<?php echo esc_attr($hero_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 text-accent"></i>
                    <span class="text-xs sm:text-sm font-semibold uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold mb-4 sm:mb-6 tracking-tight">
                    <?php echo esc_html($hero_before); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame to-tiger-orange"><?php echo esc_html($hero_highlight); ?></span>
                </h1>
                <p class="text-sm sm:text-base md:text-lg lg:text-xl text-slate-200 max-w-3xl mx-auto leading-relaxed">
                    <?php echo esc_html($hero_subtext); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="px-4 sm:px-6 lg:px-8 py-8 sm:py-12 md:py-16">
        <div class="max-w-7xl mx-auto">
            <!-- Introduction -->
            <div class="mb-8 sm:mb-12">
                <?php $intro_ic = isset($icon_styles[$intro_icon_style]) ? $icon_styles[$intro_icon_style] : $icon_styles['primary']; ?>
                <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 md:p-8 shadow-soft border border-border-light">
                    <div class="flex items-center gap-2 sm:gap-3 mb-4 sm:mb-6">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg <?php echo esc_attr($intro_ic['bg']); ?> flex items-center justify-center">
                            <i data-lucide="<?php echo esc_attr($intro_icon); ?>" class="w-5 h-5 sm:w-6 sm:h-6 <?php echo esc_attr($intro_ic['icon']); ?>"></i>
                        </div>
                        <h2 class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold text-text-main-light"><?php echo esc_html($intro_title); ?></h2>
                    </div>
                    <p class="text-sm sm:text-base md:text-lg text-text-secondary-light leading-relaxed"><?php echo esc_html($intro_paragraph); ?></p>
                </div>
            </div>

            <!-- Bus Policy & Guidelines -->
            <?php $policy_ic = isset($icon_styles[$policy_icon_style]) ? $icon_styles[$policy_icon_style] : $icon_styles['primary']; ?>
            <div class="bg-gradient-to-r from-primary/5 to-primary-light/5 rounded-xl sm:rounded-2xl p-4 sm:p-6 md:p-8 mb-8 sm:mb-12 border border-primary/20">
                <div class="flex items-center gap-2 sm:gap-3 mb-4 sm:mb-6">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg <?php echo esc_attr($policy_ic['bg']); ?> flex items-center justify-center">
                        <i data-lucide="<?php echo esc_attr($policy_icon); ?>" class="w-5 h-5 sm:w-6 sm:h-6 <?php echo esc_attr($policy_ic['icon']); ?>"></i>
                    </div>
                    <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-text-main-light"><?php echo esc_html($policy_title); ?></h2>
                </div>

                <div class="space-y-4 sm:space-y-6">
                    <?php foreach ($policy_rules as $rule) :
                        $r_icon = isset($rule['icon']) ? trim((string) $rule['icon']) : 'shield';
                        $r_title = isset($rule['title']) ? (string) $rule['title'] : '';
                        $r_para = isset($rule['paragraph']) ? (string) $rule['paragraph'] : '';
                        $r_style = isset($rule['style']) ? (string) $rule['style'] : 'primary';
                        $r_sub = isset($rule['sub_points']) && is_array($rule['sub_points']) ? $rule['sub_points'] : array();
                        $r_ic = isset($icon_styles[$r_style]) ? $icon_styles[$r_style] : $icon_styles['primary'];
                    ?>
                    <div class="flex items-start gap-3 sm:gap-4">
                        <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full <?php echo esc_attr($r_ic['bg']); ?> flex items-center justify-center flex-shrink-0 mt-0.5 sm:mt-1">
                            <i data-lucide="<?php echo esc_attr($r_icon); ?>" class="w-3.5 h-3.5 sm:w-4 sm:h-4 <?php echo esc_attr($r_ic['icon']); ?>"></i>
                        </div>
                        <div>
                            <h4 class="text-sm sm:text-base font-bold text-text-main-light mb-1 sm:mb-2"><?php echo esc_html($r_title); ?></h4>
                            <p class="text-xs sm:text-sm md:text-base text-text-secondary-light"><?php echo esc_html($r_para); ?></p>
                            <?php if (!empty($r_sub)) : ?>
                            <div class="space-y-1.5 sm:space-y-2 pl-0 sm:pl-0 mt-2 sm:mt-3">
                                <?php foreach ($r_sub as $sp) :
                                    $sp_text = isset($sp['text']) ? (string) $sp['text'] : '';
                                    if ($sp_text === '') continue;
                                ?>
                                <div class="flex items-start gap-2">
                                    <i data-lucide="check" class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-green-500 mt-0.5 sm:mt-1 flex-shrink-0"></i>
                                    <span class="text-xs sm:text-sm text-text-secondary-light"><?php echo esc_html($sp_text); ?></span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Bus Rules & Fleet -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 mb-8 sm:mb-12">
                <!-- Bus Rules & Regulations -->
                <?php $rules_ic = isset($icon_styles[$rules_icon_style]) ? $icon_styles[$rules_icon_style] : $icon_styles['accent']; ?>
                <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-soft border border-border-light">
                    <div class="flex items-center gap-2 sm:gap-3 mb-4 sm:mb-6">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg <?php echo esc_attr($rules_ic['bg']); ?> flex items-center justify-center">
                            <i data-lucide="<?php echo esc_attr($rules_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 <?php echo esc_attr($rules_ic['icon']); ?>"></i>
                        </div>
                        <h3 class="text-base sm:text-lg md:text-xl font-bold text-text-main-light"><?php echo esc_html($rules_title); ?></h3>
                    </div>
                    <div class="space-y-3 sm:space-y-4">
                        <?php foreach ($rules_list as $item) :
                            $item_title = isset($item['title']) ? (string) $item['title'] : '';
                            $item_para = isset($item['paragraph']) ? (string) $item['paragraph'] : '';
                            $item_sub = isset($item['sub_points']) && is_array($item['sub_points']) ? $item['sub_points'] : array();
                        ?>
                        <div class="flex items-start gap-2 sm:gap-3">
                            <div class="w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 mt-0.5 sm:mt-1">
                                <i data-lucide="check" class="w-2.5 h-2.5 sm:w-3 sm:h-3 text-green-600"></i>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-medium text-text-main-light mb-0.5 sm:mb-1"><?php echo esc_html($item_title); ?></h4>
                                <p class="text-xs sm:text-sm text-text-secondary-light"><?php echo esc_html($item_para); ?></p>
                                <?php if (!empty($item_sub)) : ?>
                                <div class="mt-2 space-y-1 pl-3 border-l-2 border-green-200">
                                    <?php foreach ($item_sub as $sp) :
                                        $sp_text = isset($sp['text']) ? (string) $sp['text'] : '';
                                        if ($sp_text === '') continue;
                                    ?>
                                    <p class="text-xs sm:text-sm text-text-secondary-light"><?php echo esc_html($sp_text); ?></p>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Our Transport Fleet -->
                <?php $fleet_ic = isset($icon_styles[$fleet_icon_style]) ? $icon_styles[$fleet_icon_style] : $icon_styles['primary']; ?>
                <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-soft border border-border-light">
                    <div class="flex items-center gap-2 sm:gap-3 mb-4 sm:mb-6">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg <?php echo esc_attr($fleet_ic['bg']); ?> flex items-center justify-center">
                            <i data-lucide="<?php echo esc_attr($fleet_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 <?php echo esc_attr($fleet_ic['icon']); ?>"></i>
                        </div>
                        <h3 class="text-base sm:text-lg md:text-xl font-bold text-text-main-light"><?php echo esc_html($fleet_title); ?></h3>
                    </div>
                    <div class="relative rounded-xl overflow-hidden border border-border-light">
                        <div class="aspect-w-16 aspect-h-9 bg-gray-100">
                            <img src="<?php echo esc_url($fleet_img_url); ?>" alt="School Bus" class="w-full h-48 sm:h-56 md:h-64 object-cover" loading="lazy">
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/50 to-transparent p-3 sm:p-4">
                            <p class="text-white text-xs sm:text-sm font-medium"><?php echo esc_html($fleet_caption); ?></p>
                        </div>
                    </div>
                    <div class="mt-4 sm:mt-6 grid grid-cols-2 gap-3 sm:gap-4">
                        <?php foreach ($fleet_features as $feat) :
                            $f_icon = isset($feat['icon']) ? trim((string) $feat['icon']) : 'shield';
                            $f_label = isset($feat['label']) ? (string) $feat['label'] : '';
                            $f_style = isset($feat['style']) ? (string) $feat['style'] : 'primary';
                            $f_ic = isset($icon_styles[$f_style]) ? $icon_styles[$f_style] : $icon_styles['primary'];
                        ?>
                        <div class="text-center p-2 sm:p-3 rounded-lg <?php echo esc_attr(isset($f_ic['box']) ? $f_ic['box'] : 'bg-primary/5'); ?>">
                            <i data-lucide="<?php echo esc_attr($f_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 <?php echo esc_attr($f_ic['icon']); ?> mx-auto mb-1 sm:mb-2"></i>
                            <div class="text-[10px] sm:text-xs font-medium text-text-main-light"><?php echo esc_html($f_label); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="bg-gradient-to-r from-primary to-primary-light rounded-xl sm:rounded-2xl p-4 sm:p-6 md:p-8 text-white">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-center">
                    <div>
                        <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-3 sm:mb-4"><?php echo esc_html($cta_heading); ?></h3>
                        <p class="text-xs sm:text-sm md:text-base text-white/80 mb-4 sm:mb-6"><?php echo esc_html($cta_paragraph); ?></p>
                        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                            <?php
                            $btn1_url = (is_array($cta_btn1) && !empty($cta_btn1['url'])) ? $cta_btn1['url'] : '#';
                            $btn1_title = (is_array($cta_btn1) && !empty($cta_btn1['title'])) ? $cta_btn1['title'] : 'Contact Transport Office';
                            $btn2_url = (is_array($cta_btn2) && !empty($cta_btn2['url'])) ? $cta_btn2['url'] : '#';
                            $btn2_title = (is_array($cta_btn2) && !empty($cta_btn2['title'])) ? $cta_btn2['title'] : 'Download Bus Routes';
                            ?>
                            <a href="<?php echo esc_url($btn1_url); ?>" class="px-4 py-2 sm:px-6 sm:py-3 bg-white text-primary rounded-full font-bold hover:bg-white/90 transition-all flex items-center justify-center gap-2 group text-xs sm:text-sm md:text-base">
                                <i data-lucide="<?php echo esc_attr($cta_btn1_icon); ?>" class="w-3.5 h-3.5 sm:w-4 sm:h-4 md:w-5 md:h-5"></i>
                                <?php echo esc_html($btn1_title); ?>
                            </a>
                            <a href="<?php echo esc_url($btn2_url); ?>" class="px-4 py-2 sm:px-6 sm:py-3 bg-white/20 border border-white/30 text-white rounded-full font-bold hover:bg-white/30 transition-all flex items-center justify-center gap-2 group text-xs sm:text-sm md:text-base">
                                <i data-lucide="<?php echo esc_attr($cta_btn2_icon); ?>" class="w-3.5 h-3.5 sm:w-4 sm:h-4 md:w-5 md:h-5"></i>
                                <?php echo esc_html($btn2_title); ?>
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 sm:gap-4">
                        <?php foreach ($cta_stats as $stat) :
                            $s_val = isset($stat['value']) ? (string) $stat['value'] : '';
                            $s_lbl = isset($stat['label']) ? (string) $stat['label'] : '';
                        ?>
                        <div class="bg-white/10 rounded-xl p-3 sm:p-4 text-center border border-white/20">
                            <div class="text-base sm:text-lg md:text-xl font-bold mb-1 sm:mb-2"><?php echo esc_html($s_val); ?></div>
                            <div class="text-[10px] sm:text-xs md:text-sm font-medium text-white/80"><?php echo esc_html($s_lbl); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
