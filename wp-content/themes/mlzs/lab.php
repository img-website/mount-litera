<?php
/**
 * Template Name: Lab Page
 * Lab: Hero, Intro, Computer/Science Labs, Quick Labs (3), Specialty Labs (3), Features (3), CTA – ACF dynamic
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$home_url = home_url('/');
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge     = $opt ? get_field('lab_hero_badge', $page_id) : null;
$hero_icon      = $opt ? get_field('lab_hero_icon', $page_id) : null;
$hero_headline  = $opt ? get_field('lab_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('lab_hero_highlight', $page_id) : null;
$hero_sub       = $opt ? get_field('lab_hero_subheadline', $page_id) : null;
$hero_buttons   = $opt ? get_field('lab_hero_buttons', $page_id) : null;

$hero_badge     = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Science & Technology';
$hero_icon      = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'flask-conical';
$hero_headline  = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'State-of-the-Art';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Laboratories';
$hero_sub       = ($hero_sub !== '' && $hero_sub !== null) ? (string) $hero_sub : 'Equipped with cutting-edge technology and modern facilities, our laboratories provide hands-on learning experiences that foster scientific curiosity and innovation.';
$default_hero_buttons = array(
    array('icon' => 'cpu', 'link' => array('url' => '#computer-lab', 'title' => 'Computer Labs', 'target' => '_self'), 'style' => 'blue'),
    array('icon' => 'flask-conical', 'link' => array('url' => '#science-lab', 'title' => 'Science Labs', 'target' => '_self'), 'style' => 'green'),
);
$hero_buttons = (is_array($hero_buttons) && count($hero_buttons) >= 2) ? $hero_buttons : $default_hero_buttons;

// ——— Intro ———
$intro_badge   = $opt ? get_field('lab_intro_badge', $page_id) : null;
$intro_icon    = $opt ? get_field('lab_intro_icon', $page_id) : null;
$intro_heading = $opt ? get_field('lab_intro_heading', $page_id) : null;
$intro_para    = $opt ? get_field('lab_intro_para', $page_id) : null;

$intro_badge   = ($intro_badge !== '' && $intro_badge !== null) ? (string) $intro_badge : 'Excellence';
$intro_icon    = (is_string($intro_icon) && trim($intro_icon) !== '') ? trim($intro_icon) : 'award';
$intro_heading = ($intro_heading !== '' && $intro_heading !== null) ? (string) $intro_heading : 'Among the Best CBSE Schools in Alwar';
$intro_para    = ($intro_para !== '' && $intro_para !== null) ? (string) $intro_para : 'Labs of Mount Litera Zee School provide all facilities as per the latest technology improvement, ensuring students get practical exposure to complement theoretical knowledge.';

// ——— Computer Lab ———
$computer_image = $opt ? get_field('lab_computer_image', $page_id) : null;
$computer_title = $opt ? get_field('lab_computer_title', $page_id) : null;
$computer_para1 = $opt ? get_field('lab_computer_para1', $page_id) : null;
$computer_para2 = $opt ? get_field('lab_computer_para2', $page_id) : null;

$computer_title = ($computer_title !== '' && $computer_title !== null) ? (string) $computer_title : 'Computer Labs';
$computer_para1 = ($computer_para1 !== '' && $computer_para1 !== null) ? (string) $computer_para1 : 'Our well established new technology computer labs surely meet the requirement of the students. As the time changes, technology is playing a vital role in the present world.';
$computer_para2 = ($computer_para2 !== '' && $computer_para2 !== null) ? (string) $computer_para2 : 'Browsing for new topics and gaining depth knowledge makes the students occupy the top positions in their academic and professional pursuits.';
$computer_image_url = '';
if (!empty($computer_image)) {
    if (is_array($computer_image) && !empty($computer_image['url'])) $computer_image_url = $computer_image['url'];
    elseif (is_numeric($computer_image)) $computer_image_url = wp_get_attachment_image_url((int) $computer_image, 'full') ?: '';
}
if ($computer_image_url === '') $computer_image_url = 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800&h=600&fit=crop';

// ——— Science Lab ———
$science_image = $opt ? get_field('lab_science_image', $page_id) : null;
$science_title = $opt ? get_field('lab_science_title', $page_id) : null;
$science_para1 = $opt ? get_field('lab_science_para1', $page_id) : null;
$science_para2 = $opt ? get_field('lab_science_para2', $page_id) : null;

$science_title = ($science_title !== '' && $science_title !== null) ? (string) $science_title : 'Composite Science Labs';
$science_para1 = ($science_para1 !== '' && $science_para1 !== null) ? (string) $science_para1 : 'All the labs for Physics, Chemistry, and Life Sciences are equipped with the latest material to fulfill the needs of the students.';
$science_para2 = ($science_para2 !== '' && $science_para2 !== null) ? (string) $science_para2 : 'The full-fledged labs provide good hands-on experience for all the students, allowing them to explore scientific concepts through practical experimentation.';
$science_image_url = '';
if (!empty($science_image)) {
    if (is_array($science_image) && !empty($science_image['url'])) $science_image_url = $science_image['url'];
    elseif (is_numeric($science_image)) $science_image_url = wp_get_attachment_image_url((int) $science_image, 'full') ?: '';
}
if ($science_image_url === '') $science_image_url = 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=800&h=600&fit=crop';

// ——— Quick Labs (3 cards) ———
$quick_cards = $opt ? get_field('lab_quick_cards', $page_id) : null;
$default_quick_cards = array(
    array(
        'image' => array('url' => 'https://images.unsplash.com/photo-1635070041078-e363dbe005cb?w=800&h=600&fit=crop'),
        'title' => 'Math Labs',
        'paragraph' => 'Our innovatively developed math lab creates interest among the students and helps to improve their learning skills through interactive mathematical tools and activities.',
        'footer_label' => 'Interactive Learning',
    ),
    array(
        'image' => array('url' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&h=600&fit=crop'),
        'title' => 'Language Lab',
        'paragraph' => 'Our well-equipped innovative lab is developed to make the students proficient in the language through advanced audio-visual tools and practice sessions.',
        'footer_label' => 'Language Proficiency',
    ),
    array(
        'image' => array('url' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800&h=600&fit=crop'),
        'title' => 'Social Science Lab',
        'paragraph' => 'This club prepares the students for the future, developing the habit of speaking and discussing various aspects of cities and countries through interactive sessions.',
        'footer_label' => 'Global Awareness',
    ),
);
$quick_cards = (is_array($quick_cards) && count($quick_cards) >= 3) ? $quick_cards : $default_quick_cards;

// ——— Specialty Labs ———
$specialty_badge   = $opt ? get_field('lab_specialty_badge', $page_id) : null;
$specialty_icon    = $opt ? get_field('lab_specialty_icon', $page_id) : null;
$specialty_heading = $opt ? get_field('lab_specialty_heading', $page_id) : null;
$specialty_highlight = $opt ? get_field('lab_specialty_highlight', $page_id) : null;
$specialty_cards   = $opt ? get_field('lab_specialty_cards', $page_id) : null;

$specialty_badge   = ($specialty_badge !== '' && $specialty_badge !== null) ? (string) $specialty_badge : 'Specialty Labs';
$specialty_icon    = (is_string($specialty_icon) && trim($specialty_icon) !== '') ? trim($specialty_icon) : 'beaker';
$specialty_heading = ($specialty_heading !== '' && $specialty_heading !== null) ? (string) $specialty_heading : 'Specialized';
$specialty_highlight = ($specialty_highlight !== '' && $specialty_highlight !== null) ? (string) $specialty_highlight : 'Laboratory Facilities';
$default_specialty_cards = array(
    array('image' => array('url' => 'https://images.unsplash.com/photo-1582719201952-0a3892aa25e0?w=800&h=600&fit=crop'), 'title' => 'Chemistry Lab', 'subtitle' => 'Advanced Equipment', 'paragraph' => ''),
    array('image' => array('url' => 'https://images.unsplash.com/photo-1635070041078-e363dbe005cb?w=800&h=600&fit=crop'), 'title' => 'Physics Lab', 'subtitle' => 'Modern Instruments', 'paragraph' => ''),
    array('image' => array('url' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=800&h=600&fit=crop'), 'title' => 'Robotic Lab', 'subtitle' => '', 'paragraph' => 'Robotics club is a platform for students to enhance their mechanical as well as analytical skills.'),
);
$specialty_cards = (is_array($specialty_cards) && count($specialty_cards) >= 3) ? $specialty_cards : $default_specialty_cards;

// ——— Key Features ———
$features_badge   = $opt ? get_field('lab_features_badge', $page_id) : null;
$features_icon    = $opt ? get_field('lab_features_icon', $page_id) : null;
$features_heading = $opt ? get_field('lab_features_heading', $page_id) : null;
$features_highlight = $opt ? get_field('lab_features_highlight', $page_id) : null;
$features_items   = $opt ? get_field('lab_features_items', $page_id) : null;

$features_badge   = ($features_badge !== '' && $features_badge !== null) ? (string) $features_badge : 'Key Features';
$features_icon    = (is_string($features_icon) && trim($features_icon) !== '') ? trim($features_icon) : 'check-circle';
$features_heading = ($features_heading !== '' && $features_heading !== null) ? (string) $features_heading : 'What Makes Our Labs';
$features_highlight = ($features_highlight !== '' && $features_highlight !== null) ? (string) $features_highlight : 'Exceptional';
$default_features_items = array(
    array('icon' => 'cpu', 'color' => 'blue', 'title' => 'Latest Technology', 'paragraph' => 'Equipped with modern equipment and tools as per the latest technological advancements.'),
    array('icon' => 'hand', 'color' => 'green', 'title' => 'Hands-on Learning', 'paragraph' => 'Practical exposure and experimentation to complement theoretical knowledge.'),
    array('icon' => 'award', 'color' => 'purple', 'title' => 'CBSE Standards', 'paragraph' => 'All facilities meet and exceed CBSE guidelines for laboratory infrastructure.'),
);
$features_items = (is_array($features_items) && count($features_items) >= 3) ? $features_items : $default_features_items;

// ——— CTA ———
$cta_icon     = $opt ? get_field('lab_cta_icon', $page_id) : null;
$cta_heading = $opt ? get_field('lab_cta_heading', $page_id) : null;
$cta_highlight = $opt ? get_field('lab_cta_highlight', $page_id) : null;
$cta_para    = $opt ? get_field('lab_cta_para', $page_id) : null;
$cta_btn_icon = $opt ? get_field('lab_cta_btn_icon', $page_id) : null;
$cta_btn_link = $opt ? get_field('lab_cta_btn_link', $page_id) : null;

$cta_icon     = (is_string($cta_icon) && trim($cta_icon) !== '') ? trim($cta_icon) : 'microscope';
$cta_heading  = ($cta_heading !== '' && $cta_heading !== null) ? (string) $cta_heading : 'Explore Our';
$cta_highlight = ($cta_highlight !== '' && $cta_highlight !== null) ? (string) $cta_highlight : 'Laboratories';
$cta_para     = ($cta_para !== '' && $cta_para !== null) ? (string) $cta_para : 'Experience firsthand how our state-of-the-art laboratories foster scientific curiosity and innovation among students.';
$cta_btn_icon = (is_string($cta_btn_icon) && trim($cta_btn_icon) !== '') ? trim($cta_btn_icon) : 'image';
$cta_btn_url = is_array($cta_btn_link) && !empty($cta_btn_link['url']) ? esc_url($cta_btn_link['url']) : $home_url . '#';
$cta_btn_target = is_array($cta_btn_link) && !empty($cta_btn_link['target']) ? $cta_btn_link['target'] : '_self';
$cta_btn_text = (is_array($cta_btn_link) && !empty(trim((string) $cta_btn_link['title']))) ? trim($cta_btn_link['title']) : 'View Gallery';

// Helper: image URL from repeater item
if (!function_exists('mlzs_lab_img_url')) {
    function mlzs_lab_img_url($item, $key = 'image') {
        if (empty($item) || !isset($item[$key])) return '';
        $img = $item[$key];
        if (is_array($img) && !empty($img['url'])) return $img['url'];
        if (is_numeric($img)) return wp_get_attachment_image_url((int) $img, 'full') ?: '';
        return '';
    }
}
?>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary/90 via-primary to-primary-dark text-white overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-green-500/10 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-10 md:pt-40 md:pb-24">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-6 animate-fade-in-up">
                    <i data-lucide="<?php echo esc_attr($hero_icon); ?>" class="w-4 h-4"></i>
                    <span class="text-sm font-semibold uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                    <?php echo esc_html($hero_headline); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame via-tiger-orange to-cayenne-red"><?php echo esc_html($hero_highlight); ?></span>
                </h1>
                <p class="text-base sm:text-lg md:text-xl text-slate-200 mb-8 max-w-2xl leading-relaxed">
                    <?php echo esc_html($hero_sub); ?>
                </p>
                <div class="flex flex-wrap gap-3">
                    <?php foreach ($hero_buttons as $btn) :
                        $b_icon  = isset($btn['icon']) && trim((string) $btn['icon']) !== '' ? trim($btn['icon']) : 'cpu';
                        $b_link_arr = isset($btn['link']) && is_array($btn['link']) ? $btn['link'] : array();
                        $b_url   = !empty($b_link_arr['url']) ? esc_url($b_link_arr['url']) : '#';
                        $b_label = !empty(trim((string) $b_link_arr['title'])) ? trim($b_link_arr['title']) : '';
                        $b_target = !empty($b_link_arr['target']) ? esc_attr($b_link_arr['target']) : '_self';
                        $b_style = isset($btn['style']) && $btn['style'] === 'green' ? 'green' : 'blue';
                        $b_class = $b_style === 'green' ? 'bg-gradient-to-r from-green-600 to-green-500 hover:shadow-[0_0_20px_rgba(34,197,94,0.5)]' : 'bg-gradient-to-r from-blue-600 to-blue-500 hover:shadow-[0_0_20px_rgba(37,99,235,0.5)]';
                        if ($b_label === '') $b_label = 'Learn More';
                    ?>
                    <a href="<?php echo $b_url; ?>" target="<?php echo $b_target; ?>" class="px-4 py-2 sm:px-6 sm:py-3 <?php echo esc_attr($b_class); ?> text-white rounded-full font-bold transition-all transform hover:-translate-y-0.5 flex items-center gap-2 group text-sm sm:text-base">
                        <i data-lucide="<?php echo esc_attr($b_icon); ?>" class="size-4 sm:size-5 group-hover:rotate-12 transition-transform"></i>
                        <?php echo esc_html($b_label); ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Introduction Section -->
    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary/10 text-primary mb-6">
                <i data-lucide="<?php echo esc_attr($intro_icon); ?>" class="w-5 h-5"></i>
                <span class="text-sm font-bold uppercase tracking-wider"><?php echo esc_html($intro_badge); ?></span>
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-slate-900 mb-6">
                <?php echo esc_html($intro_heading); ?>
            </h2>
            <p class="text-base sm:text-lg text-slate-600 leading-relaxed">
                <?php echo esc_html($intro_para); ?>
            </p>
        </div>
    </section>

    <!-- Laboratory Grid -->
    <section class="py-8 md:py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Computer Lab -->
            <div id="computer-lab" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center mb-20 scroll-mt-24">
                <div class="lg:col-span-5 order-1 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl group">
                        <div class="aspect-[4/3] relative">
                            <img src="<?php echo esc_url($computer_image_url); ?>" alt="<?php echo esc_attr($computer_title); ?>" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent"></div>
                    </div>
                </div>

                <div class="lg:col-span-7 order-2 lg:order-2">
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-900 mb-4"><?php echo esc_html($computer_title); ?></h3>
                    <div class="space-y-4 text-slate-600">
                        <p class="text-base sm:text-lg leading-relaxed">
                            <?php echo esc_html($computer_para1); ?>
                        </p>
                        <p class="text-sm sm:text-base leading-relaxed">
                            <?php echo esc_html($computer_para2); ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Science Lab -->
            <div id="science-lab" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center mb-20 scroll-mt-24">
                <div class="lg:col-span-7 order-2 lg:order-1">
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-900 mb-4"><?php echo esc_html($science_title); ?></h3>
                    <div class="space-y-4 text-slate-600">
                        <p class="text-base sm:text-lg leading-relaxed">
                            <?php echo esc_html($science_para1); ?>
                        </p>
                        <p class="text-sm sm:text-base leading-relaxed">
                            <?php echo esc_html($science_para2); ?>
                        </p>
                    </div>
                </div>

                <div class="lg:col-span-5 order-1 lg:order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl group">
                        <div class="aspect-[4/3] relative">
                            <img src="<?php echo esc_url($science_image_url); ?>" alt="<?php echo esc_attr($science_title); ?>" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent"></div>
                    </div>
                </div>
            </div>

            <!-- Quick Labs Grid (3 cards) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <?php foreach ($quick_cards as $card) :
                    $q_img = mlzs_lab_img_url($card, 'image');
                    if ($q_img === '') $q_img = 'https://images.unsplash.com/photo-1635070041078-e363dbe005cb?w=800&h=600&fit=crop';
                    $q_title = isset($card['title']) ? (string) $card['title'] : '';
                    $q_para  = isset($card['paragraph']) ? (string) $card['paragraph'] : '';
                    $q_foot  = isset($card['footer_label']) ? (string) $card['footer_label'] : '';
                ?>
                <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-soft hover:shadow-lg transition-all duration-300 hover:-translate-y-2">
                    <div class="h-48 relative overflow-hidden">
                        <img src="<?php echo esc_url($q_img); ?>" alt="<?php echo esc_attr($q_title); ?>" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 sm:p-8">
                        <h4 class="text-lg sm:text-xl font-bold text-slate-900 mb-3 sm:mb-4"><?php echo esc_html($q_title); ?></h4>
                        <p class="text-sm sm:text-base text-slate-600 leading-relaxed mb-4 sm:mb-6">
                            <?php echo esc_html($q_para); ?>
                        </p>
                        <div class="pt-4 border-t border-slate-100">
                            <div class="inline-flex items-center gap-2 text-primary font-medium text-sm sm:text-base">
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                <span><?php echo esc_html($q_foot); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Specialty Labs -->
            <div class="mb-16">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-accent/10 text-accent mb-6">
                        <i data-lucide="<?php echo esc_attr($specialty_icon); ?>" class="w-5 h-5"></i>
                        <span class="text-sm font-bold uppercase tracking-wider"><?php echo esc_html($specialty_badge); ?></span>
                    </div>
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-900 mb-6">
                        <?php echo esc_html($specialty_heading); ?> <span class="text-primary"><?php echo esc_html($specialty_highlight); ?></span>
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($specialty_cards as $card) :
                        $s_img = mlzs_lab_img_url($card, 'image');
                        if ($s_img === '') $s_img = 'https://images.unsplash.com/photo-1582719201952-0a3892aa25e0?w=800&h=600&fit=crop';
                        $s_title = isset($card['title']) ? (string) $card['title'] : '';
                        $s_sub   = isset($card['subtitle']) ? (string) $card['subtitle'] : '';
                        $s_para  = isset($card['paragraph']) ? (string) $card['paragraph'] : '';
                    ?>
                    <div class="group relative bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-soft hover:shadow-lg transition-all duration-300">
                        <div class="h-48 relative overflow-hidden">
                            <img src="<?php echo esc_url($s_img); ?>" alt="<?php echo esc_attr($s_title); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        </div>
                        <div class="p-5 sm:p-6">
                            <h4 class="text-base sm:text-lg font-bold text-slate-900 mb-2 sm:mb-3"><?php echo esc_html($s_title); ?></h4>
                            <?php if ($s_para !== '') : ?>
                            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                                <?php echo esc_html($s_para); ?>
                            </p>
                            <?php else : ?>
                            <p class="text-slate-500 text-xs sm:text-sm"><?php echo esc_html($s_sub); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 md:py-20 bg-gradient-to-b from-white to-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary/10 text-primary mb-6">
                    <i data-lucide="<?php echo esc_attr($features_icon); ?>" class="w-5 h-5"></i>
                    <span class="text-sm font-bold uppercase tracking-wider"><?php echo esc_html($features_badge); ?></span>
                </div>
                <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-900 mb-6">
                    <?php echo esc_html($features_heading); ?> <span class="text-primary"><?php echo esc_html($features_highlight); ?></span>
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php foreach ($features_items as $item) :
                    $f_icon  = isset($item['icon']) && trim((string) $item['icon']) !== '' ? trim($item['icon']) : 'cpu';
                    $f_color = isset($item['color']) && in_array($item['color'], array('blue','green','purple'), true) ? $item['color'] : 'blue';
                    $f_title = isset($item['title']) ? (string) $item['title'] : '';
                    $f_para  = isset($item['paragraph']) ? (string) $item['paragraph'] : '';
                    $f_bg    = $f_color === 'green' ? 'bg-green-100' : ($f_color === 'purple' ? 'bg-purple-100' : 'bg-blue-100');
                    $f_text  = $f_color === 'green' ? 'text-green-600' : ($f_color === 'purple' ? 'text-purple-600' : 'text-blue-600');
                ?>
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full <?php echo esc_attr($f_bg); ?> flex items-center justify-center mx-auto mb-6">
                        <i data-lucide="<?php echo esc_attr($f_icon); ?>" class="w-8 h-8 <?php echo esc_attr($f_text); ?>"></i>
                    </div>
                    <h4 class="text-base sm:text-lg font-bold text-slate-900 mb-3"><?php echo esc_html($f_title); ?></h4>
                    <p class="text-sm sm:text-base text-slate-600">
                        <?php echo esc_html($f_para); ?>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 md:py-20 [&_+_footer]:rounded-t-[0px] bg-slate-900 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="w-20 h-20 rounded-full bg-accent/20 flex items-center justify-center mx-auto mb-8">
                <i data-lucide="<?php echo esc_attr($cta_icon); ?>" class="w-10 h-10 text-accent"></i>
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-6">
                <?php echo esc_html($cta_heading); ?> <span class="text-accent"><?php echo esc_html($cta_highlight); ?></span>
            </h2>
            <p class="text-base sm:text-lg text-slate-300 mb-8 max-w-2xl mx-auto">
                <?php echo esc_html($cta_para); ?>
            </p>
            <div class="flex flex-row gap-4 justify-center">
                <a href="<?php echo $cta_btn_url; ?>" target="<?php echo esc_attr($cta_btn_target); ?>" class="inline-flex items-center gap-2 px-4 py-2 sm:px-8 sm:py-3 bg-transparent border border-white/30 text-white rounded-full font-bold hover:bg-white/10 transition-all text-sm sm:text-base">
                    <i data-lucide="<?php echo esc_attr($cta_btn_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    <?php echo esc_html($cta_btn_text); ?>
                </a>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
