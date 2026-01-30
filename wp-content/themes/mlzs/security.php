<?php
/**
 * Template Name: Safety & Security Page
 * Security: Hero, Safety Philosophy, Security Features, Multi-Layered, CTA – ACF dynamic
 */
if (!defined('ABSPATH')) exit;
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge = $opt ? get_field('security_hero_badge', $page_id) : null;
$hero_headline = $opt ? get_field('security_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('security_hero_highlight', $page_id) : null;
$hero_subtext = $opt ? get_field('security_hero_subtext', $page_id) : null;
$hero_badge = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Priority #1';
$hero_headline = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'Safety &';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Security';
$hero_subtext = ($hero_subtext !== '' && $hero_subtext !== null) ? (string) $hero_subtext : 'Ensuring a protected environment where every child feels secure to learn, grow, and thrive';

// ——— Philosophy ———
$philo_heading = $opt ? get_field('security_philo_heading', $page_id) : null;
$philo_cards = $opt ? get_field('security_philo_cards', $page_id) : null;
$philo_image = $opt ? get_field('security_philo_image', $page_id) : null;
$stat_number = $opt ? get_field('security_stat_number', $page_id) : null;
$stat_label = $opt ? get_field('security_stat_label', $page_id) : null;
$stat_sub = $opt ? get_field('security_stat_sub', $page_id) : null;
$philo_heading = ($philo_heading !== '' && $philo_heading !== null) ? (string) $philo_heading : 'Our Safety Philosophy';
$default_philo = array(
    array('icon' => 'heart', 'title' => 'Child-Centric Approach', 'paragraph' => 'Mount Litera management firmly believes that the optimum development of the child takes place in a safe and secure atmosphere and the desired goals can be achieved only if the mind is without fear.', 'style' => 'primary'),
    array('icon' => 'target', 'title' => 'Comprehensive Safety Policy', 'paragraph' => 'Safety for us is a comprehensive perspective. For this, school has a firm safety policy. Our safety policy ensures that each child feels that "I have the Right to Be myself and have the freedom to learn, work and play without having my heart, body and soul hurt".', 'style' => 'accent'),
);
$philo_cards = (is_array($philo_cards) && count($philo_cards) >= 2) ? $philo_cards : $default_philo;
$philo_img_url = '';
if (!empty($philo_image) && is_array($philo_image) && !empty($philo_image['url'])) $philo_img_url = $philo_image['url'];
if ($philo_img_url === '') $philo_img_url = 'https://images.unsplash.com/photo-1591123120675-6f7f1aae0e5b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80';
$stat_number = ($stat_number !== '' && $stat_number !== null) ? (string) $stat_number : '100%';
$stat_label = ($stat_label !== '' && $stat_label !== null) ? (string) $stat_label : 'Safety Commitment';
$stat_sub = ($stat_sub !== '' && $stat_sub !== null) ? (string) $stat_sub : 'Round-the-clock protection';

// ——— Features ———
$feat_heading = $opt ? get_field('security_features_heading', $page_id) : null;
$feat_subtext = $opt ? get_field('security_features_subtext', $page_id) : null;
$feat_list = $opt ? get_field('security_features', $page_id) : null;
$feat_heading = ($feat_heading !== '' && $feat_heading !== null) ? (string) $feat_heading : 'Security Features';
$feat_subtext = ($feat_subtext !== '' && $feat_subtext !== null) ? (string) $feat_subtext : 'Multi-layered security systems and protocols ensuring complete protection';
$default_feat = array(
    array('icon' => 'clock', 'title' => '24/7 Security', 'paragraph' => 'Round the clock security is provided by trained security personnel ensuring constant vigilance.', 'style' => 'primary'),
    array('icon' => 'id-card', 'title' => 'Identity Card System', 'paragraph' => 'Identity cards are issued to students as well as parents. Carrying Identity cards to school is mandatory for entry.', 'style' => 'accent'),
    array('icon' => 'fingerprint', 'title' => 'Biometric Attendance', 'paragraph' => 'Staff and students have biometric attendance facility for accurate tracking and security.', 'style' => 'primary-light'),
    array('icon' => 'bus', 'title' => 'Bus Safety', 'paragraph' => 'Attendant and bus incharge teacher on every route. Speed governors installed in all the buses for controlled travel.', 'style' => 'primary'),
    array('icon' => 'speaker', 'title' => 'PA System', 'paragraph' => 'Central PA System installed for instant communication and emergency announcements throughout the campus.', 'style' => 'accent'),
    array('icon' => 'flame', 'title' => 'Fire Safety', 'paragraph' => 'Fire Fighting System installed in each building with regular drills and maintenance checks.', 'style' => 'primary-light'),
    array('icon' => 'video', 'title' => 'CCTV Surveillance', 'paragraph' => 'Comprehensive CCTV system installed across campus for constant monitoring and security assurance.', 'style' => 'primary'),
);
$feat_list = (is_array($feat_list) && count($feat_list) >= 7) ? $feat_list : $default_feat;

// ——— Layers ———
$layers_heading = $opt ? get_field('security_layers_heading', $page_id) : null;
$layers_items = $opt ? get_field('security_layers_items', $page_id) : null;
$layers_heading = ($layers_heading !== '' && $layers_heading !== null) ? (string) $layers_heading : 'Multi-Layered Protection';
$default_layers = array(
    array('text' => 'Physical security personnel at all entry/exit points'),
    array('text' => 'Digital access control systems'),
    array('text' => 'Regular safety audits and inspections'),
    array('text' => 'Emergency response protocols'),
    array('text' => 'First-aid trained staff members'),
    array('text' => 'Parent notification systems'),
);
$layers_items = (is_array($layers_items) && count($layers_items) >= 6) ? $layers_items : $default_layers;

// ——— CTA ———
$cta_heading = $opt ? get_field('security_cta_heading', $page_id) : null;
$cta_para = $opt ? get_field('security_cta_para', $page_id) : null;
$cta_btn1 = $opt ? get_field('security_cta_btn1', $page_id) : null;
$cta_btn2 = $opt ? get_field('security_cta_btn2', $page_id) : null;
$cta_stats = $opt ? get_field('security_cta_stats', $page_id) : null;
$cta_heading = ($cta_heading !== '' && $cta_heading !== null) ? (string) $cta_heading : 'Your Child\'s Safety is Our Priority';
$cta_para = ($cta_para !== '' && $cta_para !== null) ? (string) $cta_para : 'We maintain the highest standards of safety and security to ensure that every child learns in a protected, nurturing environment. Our comprehensive safety measures provide parents with peace of mind.';
$cta_btn1_url = $cta_btn1_text = '#';
if (!empty($cta_btn1) && is_array($cta_btn1)) {
    $cta_btn1_url = isset($cta_btn1['url']) ? esc_url($cta_btn1['url']) : '#';
    $cta_btn1_text = isset($cta_btn1['title']) && trim($cta_btn1['title']) !== '' ? (string) $cta_btn1['title'] : 'Download Safety Manual';
} else { $cta_btn1_text = 'Download Safety Manual'; }
$cta_btn2_url = $cta_btn2_text = '#';
if (!empty($cta_btn2) && is_array($cta_btn2)) {
    $cta_btn2_url = isset($cta_btn2['url']) ? esc_url($cta_btn2['url']) : '#';
    $cta_btn2_text = isset($cta_btn2['title']) && trim($cta_btn2['title']) !== '' ? (string) $cta_btn2['title'] : 'Contact Safety Officer';
} else { $cta_btn2_text = 'Contact Safety Officer'; }
$default_cta_stats = array(
    array('number' => '24/7', 'label' => 'Security Coverage', 'color' => 'primary'),
    array('number' => '100%', 'label' => 'CCTV Coverage', 'color' => 'accent'),
    array('number' => '50+', 'label' => 'Safety Cameras', 'color' => 'primary-light'),
    array('number' => '0', 'label' => 'Incidents Reported', 'color' => 'accent-dark'),
);
$cta_stats = (is_array($cta_stats) && count($cta_stats) >= 4) ? $cta_stats : $default_cta_stats;
?>
    <!-- Hero -->
    <section class="relative bg-gradient-to-br from-primary via-primary-dark to-slate-900 px-4 sm:px-6 lg:px-8 pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')]"></div>
        <div class="absolute top-0 right-0 w-48 h-48 bg-accent/10 rounded-full blur-3xl"></div>
        <div class="relative z-10 max-w-7xl mx-auto">
            <div class="text-center text-white">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 backdrop-blur-md border border-white/30 mb-6 animate-fade-in-up">
                    <i data-lucide="shield-check" class="w-5 h-5 text-accent"></i>
                    <span class="text-sm font-semibold uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-6 tracking-tight">
                    <?php echo esc_html($hero_headline); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame to-tiger-orange"><?php echo esc_html($hero_highlight); ?></span>
                </h1>
                <p class="text-base sm:text-lg md:text-xl text-slate-200 max-w-3xl mx-auto leading-relaxed"><?php echo esc_html($hero_subtext); ?></p>
            </div>
        </div>
    </section>

    <!-- Safety Philosophy -->
    <section class="px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-text-main-light mb-4">
                    <?php
                    $philo_trim = trim($philo_heading);
                    if (preg_match('/^(.+)\s+Philosophy\s*$/i', $philo_trim, $pm)) {
                        echo esc_html(trim($pm[1])) . ' <span class="text-primary">Philosophy</span>';
                    } else {
                        echo esc_html($philo_trim);
                    }
                    ?>
                </h2>
                <div class="w-20 h-1 bg-gradient-to-r from-primary to-accent mx-auto rounded-full mb-6"></div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-start mb-16">
                <div class="space-y-6">
                    <?php foreach ($philo_cards as $pc) :
                        $pc_icon = isset($pc['icon']) ? trim((string) $pc['icon']) : 'heart';
                        $pc_title = isset($pc['title']) ? (string) $pc['title'] : '';
                        $pc_para = isset($pc['paragraph']) ? (string) $pc['paragraph'] : '';
                        $pc_style = isset($pc['style']) ? $pc['style'] : 'primary';
                        $pc_icon_bg = $pc_style === 'accent' ? 'bg-accent/10' : 'bg-primary/10';
                        $pc_icon_text = $pc_style === 'accent' ? 'text-accent' : 'text-primary';
                        $pc_card_class = $pc_style === 'accent' ? 'bg-gradient-to-r from-primary/5 to-accent/5 rounded-2xl p-6 md:p-8 border border-primary/20' : 'bg-white rounded-2xl p-6 md:p-8 shadow-soft border border-border-light';
                    ?>
                    <div class="<?php echo esc_attr($pc_card_class); ?>">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 rounded-xl <?php echo esc_attr($pc_icon_bg); ?> flex items-center justify-center">
                                <i data-lucide="<?php echo esc_attr($pc_icon); ?>" class="w-6 h-6 <?php echo esc_attr($pc_icon_text); ?>"></i>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-bold text-text-main-light"><?php echo esc_html($pc_title); ?></h3>
                        </div>
                        <p class="text-base sm:text-lg text-text-secondary-light leading-relaxed"><?php echo esc_html($pc_para); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="relative">
                    <div class="rounded-2xl overflow-hidden shadow-xl">
                        <img src="<?php echo esc_url($philo_img_url); ?>" alt="Safe School Environment" class="w-full h-[350px] md:h-[500px] object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/40 to-transparent"></div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 md:-bottom-6 md:-right-6 bg-white rounded-xl p-4 md:p-6 shadow-2xl max-w-xs">
                        <div class="text-2xl md:text-3xl font-bold text-primary mb-2"><?php echo esc_html($stat_number); ?></div>
                        <div class="text-xs md:text-sm font-bold text-text-main-light uppercase tracking-wide"><?php echo esc_html($stat_label); ?></div>
                        <p class="text-xs text-text-secondary-light mt-2"><?php echo esc_html($stat_sub); ?></p>
                    </div>
                </div>
            </div>

            <!-- Security Features -->
            <div class="mb-16">
                <div class="text-center mb-12">
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-text-main-light mb-4">
                        <?php
                        $feat_trim = trim($feat_heading);
                        if (preg_match('/^(.+)\s+Features\s*$/i', $feat_trim, $fm)) {
                            echo esc_html(trim($fm[1])) . ' <span class="text-primary">Features</span>';
                        } else {
                            echo esc_html($feat_trim);
                        }
                        ?>
                    </h3>
                    <p class="text-base sm:text-lg text-text-secondary-light max-w-2xl mx-auto"><?php echo esc_html($feat_subtext); ?></p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($feat_list as $fi => $f) :
                        $f_icon = isset($f['icon']) ? trim((string) $f['icon']) : 'clock';
                        $f_title = isset($f['title']) ? (string) $f['title'] : '';
                        $f_para = isset($f['paragraph']) ? (string) $f['paragraph'] : '';
                        $f_style = isset($f['style']) ? $f['style'] : 'primary';
                        $f_bg = $f_style === 'accent' ? 'bg-accent/10' : ($f_style === 'primary-light' ? 'bg-primary-light/10' : 'bg-primary/10');
                        $f_text = $f_style === 'accent' ? 'text-accent' : ($f_style === 'primary-light' ? 'text-primary-light' : 'text-primary');
                        $f_border = $f_style === 'accent' ? 'hover:border-accent/30' : ($f_style === 'primary-light' ? 'hover:border-primary-light/30' : 'hover:border-primary/30');
                        $f_hover_bg = $f_style === 'accent' ? 'group-hover:bg-accent' : ($f_style === 'primary-light' ? 'group-hover:bg-primary-light' : 'group-hover:bg-primary');
                        $f_col_span = ($fi === 6) ? ' md:col-span-2 lg:col-span-1' : '';
                    ?>
                    <div class="group bg-white rounded-2xl p-6 shadow-soft hover:shadow-xl border border-border-light <?php echo esc_attr($f_border . $f_col_span); ?> transition-all duration-300 hover:-translate-y-2">
                        <div class="w-12 h-12 rounded-xl <?php echo esc_attr($f_bg); ?> flex items-center justify-center mb-4 <?php echo esc_attr($f_hover_bg); ?> group-hover:text-white transition-colors">
                            <i data-lucide="<?php echo esc_attr($f_icon); ?>" class="w-6 h-6 <?php echo esc_attr($f_text); ?> group-hover:text-white"></i>
                        </div>
                        <h4 class="text-lg sm:text-xl font-bold text-text-main-light mb-3"><?php echo esc_html($f_title); ?></h4>
                        <p class="text-sm sm:text-base text-text-secondary-light"><?php echo esc_html($f_para); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Multi-Layered Protection -->
            <div class="mb-16">
                <div class="bg-gradient-to-r from-primary to-primary-dark rounded-2xl p-6 md:p-8 text-white">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-14 h-14 rounded-xl bg-white/20 flex items-center justify-center">
                            <i data-lucide="shield" class="w-7 h-7"></i>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-bold"><?php echo esc_html($layers_heading); ?></h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div class="space-y-3 md:space-y-4"><?php for ($i = 0; $i < 3 && isset($layers_items[$i]); $i++) : ?>
                            <div class="flex items-start gap-3">
                                <i data-lucide="check-circle" class="w-4 h-4 sm:w-5 sm:h-5 text-accent mt-1 flex-shrink-0"></i>
                                <p class="text-sm sm:text-base text-slate-200"><?php echo esc_html($layers_items[$i]['text']); ?></p>
                            </div>
                        <?php endfor; ?></div>
                        <div class="space-y-3 md:space-y-4"><?php for ($i = 3; $i < 6 && isset($layers_items[$i]); $i++) : ?>
                            <div class="flex items-start gap-3">
                                <i data-lucide="check-circle" class="w-4 h-4 sm:w-5 sm:h-5 text-accent mt-1 flex-shrink-0"></i>
                                <p class="text-sm sm:text-base text-slate-200"><?php echo esc_html($layers_items[$i]['text']); ?></p>
                            </div>
                        <?php endfor; ?></div>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="bg-gradient-to-r from-primary/10 to-accent/10 rounded-3xl p-6 md:p-8 lg:p-12 border border-primary/20">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-8 items-center">
                    <div>
                        <h3 class="text-2xl sm:text-3xl font-bold text-text-main-light mb-4"><?php echo esc_html($cta_heading); ?></h3>
                        <p class="text-base sm:text-lg text-text-secondary-light leading-relaxed mb-6"><?php echo esc_html($cta_para); ?></p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="<?php echo esc_url($cta_btn1_url); ?>" class="px-4 py-2 sm:px-6 sm:py-3 bg-primary text-white rounded-full font-bold hover:bg-primary-dark transition-all flex items-center justify-center gap-2 group w-full sm:w-auto text-sm sm:text-base">
                                <?php echo esc_html($cta_btn1_text); ?>
                                <i data-lucide="download" class="w-4 h-4 sm:w-5 sm:h-5 group-hover:translate-y-1 transition-transform"></i>
                            </a>
                            <a href="<?php echo esc_url($cta_btn2_url); ?>" class="px-4 py-2 sm:px-6 sm:py-3 bg-white border border-border-light text-text-main-light rounded-full font-bold hover:bg-gray-50 transition-all flex items-center justify-center gap-2 w-full sm:w-auto text-sm sm:text-base">
                                <i data-lucide="phone" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                                <?php echo esc_html($cta_btn2_text); ?>
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 md:gap-4">
                        <?php foreach ($cta_stats as $s) :
                            $s_num = isset($s['number']) ? (string) $s['number'] : '';
                            $s_lab = isset($s['label']) ? (string) $s['label'] : '';
                            $s_color = isset($s['color']) ? $s['color'] : 'primary';
                            $s_text = $s_color === 'accent' ? 'text-accent' : ($s_color === 'primary-light' ? 'text-primary-light' : ($s_color === 'accent-dark' ? 'text-accent-dark' : 'text-primary'));
                        ?>
                        <div class="bg-white rounded-xl p-4 md:p-6 text-center shadow-sm">
                            <div class="text-2xl md:text-3xl font-bold <?php echo esc_attr($s_text); ?> mb-2"><?php echo esc_html($s_num); ?></div>
                            <div class="text-xs md:text-sm font-medium text-text-secondary-light"><?php echo esc_html($s_lab); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
