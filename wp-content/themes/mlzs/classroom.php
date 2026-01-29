<?php
/**
 * Template Name: Classroom Page
 * Classroom: Hero, Overview, Features, Details, Comparison, CTA (ACF dynamic)
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$home_url = home_url('/');
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge   = $opt ? get_field('classroom_hero_badge', $page_id) : null;
$hero_icon    = $opt ? get_field('classroom_hero_badge_icon', $page_id) : null;
$hero_headline = $opt ? get_field('classroom_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('classroom_hero_highlight', $page_id) : null;
$hero_sub     = $opt ? get_field('classroom_hero_subheadline', $page_id) : null;
$hero_bullets = $opt ? get_field('classroom_hero_bullets', $page_id) : null;

$hero_badge    = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Campus Infrastructure';
$hero_icon     = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'school';
$hero_headline = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'World-Class';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Classrooms';
$hero_sub      = ($hero_sub !== '' && $hero_sub !== null) ? (string) $hero_sub : 'Designed to inspire learning and innovation, our classrooms set new standards in educational excellence with cutting-edge technology and spacious design.';
$default_bullets = array(
    array('text' => '650 SQ FT Classrooms'),
    array('text' => 'Interactive Technology'),
    array('text' => 'International Standards'),
);
$hero_bullets = (is_array($hero_bullets) && count($hero_bullets) >= 3) ? $hero_bullets : $default_bullets;
$hero_dot_classes = array('bg-accent', 'bg-primary-light', 'bg-green-500');

// ——— Overview ———
$overview_badge   = $opt ? get_field('classroom_overview_badge', $page_id) : null;
$overview_icon    = $opt ? get_field('classroom_overview_badge_icon', $page_id) : null;
$overview_heading = $opt ? get_field('classroom_overview_heading', $page_id) : null;
$overview_highlight = $opt ? get_field('classroom_overview_heading_highlight', $page_id) : null;
$overview_desc    = $opt ? get_field('classroom_overview_description', $page_id) : null;
$overview_card_icon = $opt ? get_field('classroom_overview_card_icon', $page_id) : null;
$overview_card_title = $opt ? get_field('classroom_overview_card_title', $page_id) : null;
$overview_card_desc  = $opt ? get_field('classroom_overview_card_description', $page_id) : null;
$overview_right_heading = $opt ? get_field('classroom_overview_right_heading', $page_id) : null;
$overview_right_text   = $opt ? get_field('classroom_overview_right_text', $page_id) : null;

$overview_badge   = ($overview_badge !== '' && $overview_badge !== null) ? (string) $overview_badge : 'International Standards';
$overview_icon    = (is_string($overview_icon) && trim($overview_icon) !== '') ? trim($overview_icon) : 'award';
$overview_heading = ($overview_heading !== '' && $overview_heading !== null) ? (string) $overview_heading : 'Learning Spaces That';
$overview_highlight = ($overview_highlight !== '' && $overview_highlight !== null) ? (string) $overview_highlight : 'Inspire Excellence';
$overview_desc    = ($overview_desc !== '' && $overview_desc !== null) ? (string) $overview_desc : "The classrooms of Mount Litera Zee School, Alwar are at par with international standards. All classrooms are replete with modular furniture and extensive display boards to ensure that students give their best to the process of learning and achievement.\n\nEach classroom spans an impressive area of 650 SQ FT which is 30% above the normal guidelines issued by CBSE, providing ample space for interactive learning and student movement.";
$overview_card_icon = (is_string($overview_card_icon) && trim($overview_card_icon) !== '') ? trim($overview_card_icon) : 'maximize-2';
$overview_card_title = ($overview_card_title !== '' && $overview_card_title !== null) ? (string) $overview_card_title : 'Spacious Design';
$overview_card_desc  = ($overview_card_desc !== '' && $overview_card_desc !== null) ? (string) $overview_card_desc : '650 SQ FT per classroom, exceeding CBSE guidelines by 30%';
$overview_right_heading = ($overview_right_heading !== '' && $overview_right_heading !== null) ? (string) $overview_right_heading : 'Interactive Learning Environment';
$overview_right_text   = ($overview_right_text !== '' && $overview_right_text !== null) ? (string) $overview_right_text : 'Designed for collaborative and engaging education';

// ——— Features ———
$features_badge   = $opt ? get_field('classroom_features_badge', $page_id) : null;
$features_icon    = $opt ? get_field('classroom_features_badge_icon', $page_id) : null;
$features_heading = $opt ? get_field('classroom_features_heading', $page_id) : null;
$features_intro   = $opt ? get_field('classroom_features_intro', $page_id) : null;
$features_cards   = $opt ? get_field('classroom_features_cards', $page_id) : null;

$features_badge   = ($features_badge !== '' && $features_badge !== null) ? (string) $features_badge : 'Technology Features';
$features_icon    = (is_string($features_icon) && trim($features_icon) !== '') ? trim($features_icon) : 'cpu';
$features_heading = ($features_heading !== '' && $features_heading !== null) ? (string) $features_heading : 'Integrated Smart Classroom Technology';
$features_intro   = ($features_intro !== '' && $features_intro !== null) ? (string) $features_intro : 'Equipped with state-of-the-art digital infrastructure to create immersive and interactive learning experiences';
$default_features = array(
    array('icon' => 'monitor', 'title' => 'Computer & Projector System', 'description' => "A computer along with a projector installed in each classroom (UKG onwards) where teachers and students can access various information available on the school's local area network server.", 'link' => null),
    array('icon' => 'tv', 'title' => 'Interactive White Board', 'description' => 'Interactive White Board with modern acoustics and Green Boards to facilitate learning along with IWBs, creating a dynamic teaching environment.', 'link' => null),
    array('icon' => 'book-open', 'title' => 'E-Content Library', 'description' => 'Class and Subject specific in-house developed e-content, tailored to our curriculum and teaching methodology for enhanced learning outcomes.', 'link' => null),
);
$features_cards = (is_array($features_cards) && count($features_cards) >= 3) ? $features_cards : $default_features;
$feature_gradient_classes = array('from-primary to-primary-dark', 'from-accent to-accent-dark', 'from-primary-light to-slate-blue');

// ——— Details ———
$details_left   = $opt ? get_field('classroom_details_left_cards', $page_id) : null;
$details_right_badge  = $opt ? get_field('classroom_details_right_badge', $page_id) : null;
$details_right_icon   = $opt ? get_field('classroom_details_right_badge_icon', $page_id) : null;
$details_right_heading = $opt ? get_field('classroom_details_right_heading', $page_id) : null;
$details_right_items  = $opt ? get_field('classroom_details_right_items', $page_id) : null;
$details_bottom_title = $opt ? get_field('classroom_details_bottom_title', $page_id) : null;
$details_bottom_text  = $opt ? get_field('classroom_details_bottom_text', $page_id) : null;

$default_details_left = array(
    array('icon' => 'wifi', 'icon_style' => 'blue', 'title' => 'High-Speed Internet', 'description' => 'Dedicated leased line for reliable internet access in every classroom'),
    array('icon' => 'clipboard-list', 'icon_style' => 'green', 'title' => 'Display Boards', 'description' => 'Extensive modular display boards for student work and information'),
    array('icon' => 'chair', 'icon_style' => 'purple', 'title' => 'Modular Furniture', 'description' => 'Ergonomic and flexible furniture for optimal learning comfort'),
    array('icon' => 'volume-2', 'icon_style' => 'amber', 'title' => 'Modern Acoustics', 'description' => 'Sound-optimized classrooms for clear audio during lessons'),
);
$details_left = (is_array($details_left) && count($details_left) >= 4) ? $details_left : $default_details_left;
$details_right_badge  = ($details_right_badge !== '' && $details_right_badge !== null) ? (string) $details_right_badge : 'Complete Package';
$details_right_icon   = (is_string($details_right_icon) && trim($details_right_icon) !== '') ? trim($details_right_icon) : 'check-circle';
$details_right_heading = ($details_right_heading !== '' && $details_right_heading !== null) ? (string) $details_right_heading : 'Everything for Optimal Learning';
$default_details_items = array(
    array('title' => 'Network Integration', 'description' => "Access to school's local area network server with educational resources"),
    array('title' => 'Dual Display Systems', 'description' => 'Combination of Interactive White Boards and traditional Green Boards'),
    array('title' => 'Custom E-Content', 'description' => 'Specially developed digital content for each class and subject'),
    array('title' => 'Reliable Connectivity', 'description' => 'Dedicated leased line ensuring uninterrupted internet access'),
    array('title' => 'Spacious Design', 'description' => '650 SQ FT classrooms providing ample space for movement and activities'),
);
$details_right_items = (is_array($details_right_items) && count($details_right_items) >= 5) ? $details_right_items : $default_details_items;
$details_bottom_title = ($details_bottom_title !== '' && $details_bottom_title !== null) ? (string) $details_bottom_title : '650 SQ FT Classrooms';
$details_bottom_text  = ($details_bottom_text !== '' && $details_bottom_text !== null) ? (string) $details_bottom_text : '30% above CBSE guidelines for optimal learning environment';

$detail_icon_styles = array('blue' => array('bg' => 'bg-blue-100', 'text' => 'text-blue-600'), 'green' => array('bg' => 'bg-green-100', 'text' => 'text-green-600'), 'purple' => array('bg' => 'bg-purple-100', 'text' => 'text-purple-600'), 'amber' => array('bg' => 'bg-amber-100', 'text' => 'text-amber-600'));

// ——— Comparison ———
$comp_badge   = $opt ? get_field('classroom_comparison_badge', $page_id) : null;
$comp_icon    = $opt ? get_field('classroom_comparison_badge_icon', $page_id) : null;
$comp_heading = $opt ? get_field('classroom_comparison_heading', $page_id) : null;
$comp_intro   = $opt ? get_field('classroom_comparison_intro', $page_id) : null;
$comp_bottom  = $opt ? get_field('classroom_comparison_bottom', $page_id) : null;

$comp_badge   = ($comp_badge !== '' && $comp_badge !== null) ? (string) $comp_badge : 'Advantage';
$comp_icon    = (is_string($comp_icon) && trim($comp_icon) !== '') ? trim($comp_icon) : 'trending-up';
$comp_heading = ($comp_heading !== '' && $comp_heading !== null) ? (string) $comp_heading : 'Why Our Classrooms Stand Out';
$comp_intro   = ($comp_intro !== '' && $comp_intro !== null) ? (string) $comp_intro : 'A comparative look at how our classroom infrastructure exceeds standard requirements';
$comp_bottom  = ($comp_bottom !== '' && $comp_bottom !== null) ? (string) $comp_bottom : 'Our classrooms not only meet but exceed both national and international standards, providing students with an environment conducive to holistic development and academic excellence.';

// Comparison columns (3 cards)
$comp_columns = $opt ? get_field('classroom_comparison_columns', $page_id) : null;
$default_comp_columns = array(
    array(
        'style' => 'standard',
        'icon' => 'home',
        'title' => 'Standard Classroom',
        'subtitle' => 'CBSE Minimum Requirements',
        'badge_text' => '',
        'rows' => array(
            array('label' => 'Classroom Size', 'value' => '500 SQ FT'),
            array('label' => 'Technology', 'value' => 'Basic'),
            array('label' => 'Furniture', 'value' => 'Standard'),
            array('label' => 'Connectivity', 'value' => 'Limited'),
        ),
        'bottom_label' => '',
        'bottom_text' => '',
    ),
    array(
        'style' => 'highlight',
        'icon' => 'star',
        'title' => 'MLZS Classroom',
        'subtitle' => 'International Standards',
        'badge_text' => 'Our Standard',
        'rows' => array(
            array('label' => 'Classroom Size', 'value' => '650 SQ FT'),
            array('label' => 'Technology', 'value' => 'Smart Class'),
            array('label' => 'Furniture', 'value' => 'Modular'),
            array('label' => 'Connectivity', 'value' => 'Dedicated Line'),
        ),
        'bottom_label' => '+30%',
        'bottom_text' => 'Above CBSE Guidelines',
    ),
    array(
        'style' => 'global',
        'icon' => 'globe',
        'title' => 'Global Standards',
        'subtitle' => 'International Benchmarks',
        'badge_text' => '',
        'rows' => array(
            array('label' => 'Interactive Tech', 'value' => '✓'),
            array('label' => 'Digital Content', 'value' => '✓'),
            array('label' => 'Network Access', 'value' => '✓'),
            array('label' => 'Spacious Design', 'value' => '✓'),
        ),
        'bottom_label' => '',
        'bottom_text' => '',
    ),
);
$comp_columns = (is_array($comp_columns) && count($comp_columns) >= 3) ? $comp_columns : $default_comp_columns;

// ——— CTA ———
$cta_icon   = $opt ? get_field('classroom_cta_icon', $page_id) : null;
$cta_heading = $opt ? get_field('classroom_cta_heading', $page_id) : null;
$cta_desc   = $opt ? get_field('classroom_cta_description', $page_id) : null;
$cta_primary = $opt ? get_field('classroom_cta_primary', $page_id) : null;
$cta_secondary = $opt ? get_field('classroom_cta_secondary', $page_id) : null;
$cta_icon1  = $opt ? get_field('classroom_cta_primary_icon', $page_id) : null;
$cta_icon2  = $opt ? get_field('classroom_cta_secondary_icon', $page_id) : null;

$cta_icon   = (is_string($cta_icon) && trim($cta_icon) !== '') ? trim($cta_icon) : 'eye';
$cta_heading = ($cta_heading !== '' && $cta_heading !== null) ? (string) $cta_heading : 'Experience Our Classrooms Firsthand';
$cta_desc   = ($cta_desc !== '' && $cta_desc !== null) ? (string) $cta_desc : 'See how our state-of-the-art classrooms create the perfect environment for learning, innovation, and growth.';
$cta_primary   = (is_array($cta_primary) && !empty($cta_primary['url'])) ? $cta_primary : array('url' => $home_url . '#', 'title' => 'Schedule a Campus Tour', 'target' => '');
$cta_secondary = (is_array($cta_secondary) && !empty($cta_secondary['url'])) ? $cta_secondary : array('url' => $home_url . '#', 'title' => 'Virtual Classroom Tour', 'target' => '');
$cta_icon1  = (is_string($cta_icon1) && trim($cta_icon1) !== '') ? trim($cta_icon1) : 'calendar';
$cta_icon2  = (is_string($cta_icon2) && trim($cta_icon2) !== '') ? trim($cta_icon2) : 'video';
?>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary/90 via-primary to-primary-dark text-white overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-72 h-72 bg-accent/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-primary-light/20 rounded-full blur-3xl"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-10 md:pt-40 md:pb-24">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 sm:px-4 sm:py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-4 sm:mb-6 animate-fade-in-up">
                    <i data-lucide="<?php echo esc_attr($hero_icon); ?>" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                    <span class="text-xs sm:text-sm font-semibold uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-6 leading-tight">
                    <?php echo esc_html($hero_headline); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame via-tiger-orange to-cayenne-red"><?php echo esc_html($hero_highlight); ?></span>
                </h1>
                <p class="text-sm sm:text-base md:text-lg text-slate-200 mb-8 max-w-2xl leading-relaxed">
                    <?php echo esc_html($hero_sub); ?>
                </p>
                <div class="flex flex-wrap gap-4">
                    <?php foreach (array_slice($hero_bullets, 0, 3) as $i => $bullet) :
                        $dot_class = isset($hero_dot_classes[$i]) ? $hero_dot_classes[$i] : 'bg-accent';
                        $text = isset($bullet['text']) ? (string) $bullet['text'] : '';
                    ?>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 sm:w-3 sm:h-3 rounded-full <?php echo esc_attr($dot_class); ?> animate-pulse"></div>
                        <span class="text-xs sm:text-sm font-medium"><?php echo esc_html($text); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Classroom Overview -->
    <section class="py-16 md:py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="animate-fade-in-up">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-primary/10 text-primary mb-4 sm:mb-6">
                        <i data-lucide="<?php echo esc_attr($overview_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        <span class="text-xs sm:text-sm font-bold uppercase tracking-wider"><?php echo esc_html($overview_badge); ?></span>
                    </div>
                    <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-900 mb-6">
                        <?php echo esc_html($overview_heading); ?> <span class="text-primary"><?php echo esc_html($overview_highlight); ?></span>
                    </h2>
                    <div class="space-y-4 text-slate-600">
                        <?php foreach (preg_split('/\n\s*\n/', trim($overview_desc), -1, PREG_SPLIT_NO_EMPTY) as $p) : ?>
                            <p class="text-sm sm:text-base leading-relaxed"><?php echo esc_html(trim($p)); ?></p>
                        <?php endforeach; ?>
                    </div>
                    <div class="mt-6 sm:mt-8 flex items-center gap-3 sm:gap-4 p-4 sm:p-6 bg-white rounded-2xl border border-slate-200 shadow-soft">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-primary/10 flex items-center justify-center">
                            <i data-lucide="<?php echo esc_attr($overview_card_icon); ?>" class="w-5 h-5 sm:w-6 sm:h-6 text-primary"></i>
                        </div>
                        <div>
                            <h4 class="text-sm sm:text-base font-bold text-slate-900 mb-1"><?php echo esc_html($overview_card_title); ?></h4>
                            <p class="text-xs sm:text-sm text-slate-600"><?php echo esc_html($overview_card_desc); ?></p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                        <div class="aspect-[4/3] bg-gradient-to-br from-slate-100 to-slate-200 relative">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center p-8">
                                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-white/80 backdrop-blur-sm flex items-center justify-center mx-auto mb-4 sm:mb-6 shadow-lg">
                                        <i data-lucide="users" class="w-8 h-8 sm:w-10 sm:h-10 text-primary"></i>
                                    </div>
                                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-slate-900 mb-2"><?php echo esc_html($overview_right_heading); ?></h3>
                                    <p class="text-xs sm:text-sm md:text-base text-slate-600"><?php echo esc_html($overview_right_text); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -top-6 -right-6 w-40 h-40 bg-accent/10 rounded-full blur-xl -z-10"></div>
                    <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-primary/10 rounded-full blur-xl -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Classroom Features -->
    <section class="pt-16 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-primary/10 text-primary mb-4 sm:mb-6">
                    <i data-lucide="<?php echo esc_attr($features_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    <span class="text-xs sm:text-sm font-bold uppercase tracking-wider"><?php echo esc_html($features_badge); ?></span>
                </div>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-900 mb-6">
                    <?php echo esc_html($features_heading); ?>
                </h2>
                <p class="text-sm sm:text-base text-slate-600 max-w-3xl mx-auto">
                    <?php echo esc_html($features_intro); ?>
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <?php foreach (array_slice($features_cards, 0, 3) as $idx => $card) :
                    $f_icon = isset($card['icon']) && trim((string) $card['icon']) !== '' ? trim((string) $card['icon']) : 'monitor';
                    $f_title = isset($card['title']) ? (string) $card['title'] : '';
                    $f_desc  = isset($card['description']) ? (string) $card['description'] : '';
                    $f_link  = isset($card['link']) && is_array($card['link']) && !empty($card['link']['url']) ? $card['link'] : null;
                    $f_grad  = isset($feature_gradient_classes[$idx]) ? $feature_gradient_classes[$idx] : 'from-primary to-primary-dark';
                ?>
                <div class="group bg-slate-50 rounded-2xl p-4 sm:p-6 md:p-8 border border-slate-200 hover:border-primary/30 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl cursor-pointer">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl bg-gradient-to-br <?php echo esc_attr($f_grad); ?> flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="<?php echo esc_attr($f_icon); ?>" class="w-6 h-6 sm:w-7 sm:h-7 text-white"></i>
                    </div>
                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-slate-900 mb-3 sm:mb-4"><?php echo esc_html($f_title); ?></h3>
                    <p class="text-xs sm:text-sm text-slate-600 mb-4 sm:mb-6 leading-relaxed"><?php echo esc_html($f_desc); ?></p>
                    <?php if ($f_link) : ?>
                    <a href="<?php echo esc_url($f_link['url']); ?>"<?php echo !empty($f_link['target']) ? ' target="' . esc_attr($f_link['target']) . '"' : ''; ?> class="inline-flex items-center gap-2 text-primary font-medium text-xs sm:text-sm group-hover:gap-3 transition-all">
                        <span><?php echo esc_html(isset($f_link['title']) && $f_link['title'] !== '' ? $f_link['title'] : 'Learn More'); ?></span>
                        <i data-lucide="arrow-right" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                    </a>
                    <?php else : ?>
                    <div class="inline-flex items-center gap-2 text-primary font-medium text-xs sm:text-sm group-hover:gap-3 transition-all">
                        <span>Learn More</span>
                        <i data-lucide="arrow-right" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Classroom Details Grid -->
    <section class="pb-16 md:py-20 bg-gradient-to-b from-white to-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="relative">
                    <div class="grid grid-cols-2 gap-4">
                        <?php
                        $detail_positions = array(0, 1, 0, 1);
                        $detail_mt = array('', 'mt-6 sm:mt-8', '', 'mt-6 sm:mt-8');
                        foreach (array_slice($details_left, 0, 4) as $dix => $card) :
                            $d_icon = isset($card['icon']) && trim((string) $card['icon']) !== '' ? trim((string) $card['icon']) : 'wifi';
                            $d_style = isset($card['icon_style']) && isset($detail_icon_styles[$card['icon_style']]) ? $card['icon_style'] : 'blue';
                            $styles = $detail_icon_styles[$d_style];
                            $d_title = isset($card['title']) ? (string) $card['title'] : '';
                            $d_desc  = isset($card['description']) ? (string) $card['description'] : '';
                        ?>
                        <div class="bg-white rounded-2xl p-4 sm:p-6 border border-slate-200 shadow-soft <?php echo esc_attr($detail_mt[$dix]); ?>">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg <?php echo esc_attr($styles['bg']); ?> flex items-center justify-center mb-3 sm:mb-4">
                                <i data-lucide="<?php echo esc_attr($d_icon); ?>" class="w-5 h-5 sm:w-6 sm:h-6 <?php echo esc_attr($styles['text']); ?>"></i>
                            </div>
                            <h4 class="text-sm sm:text-base font-bold text-slate-900 mb-1 sm:mb-2"><?php echo esc_html($d_title); ?></h4>
                            <p class="text-xs sm:text-sm text-slate-600"><?php echo esc_html($d_desc); ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="absolute -z-10 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-primary/5 rounded-full blur-3xl"></div>
                </div>
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-accent/10 text-accent mb-4 sm:mb-6">
                        <i data-lucide="<?php echo esc_attr($details_right_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        <span class="text-xs sm:text-sm font-bold uppercase tracking-wider"><?php echo esc_html($details_right_badge); ?></span>
                    </div>
                    <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-900 mb-6">
                        <?php echo esc_html($details_right_heading); ?>
                    </h2>
                    <div class="space-y-6">
                        <?php foreach (array_slice($details_right_items, 0, 5) as $item) :
                            $item_title = isset($item['title']) ? (string) $item['title'] : '';
                            $item_desc  = isset($item['description']) ? (string) $item['description'] : '';
                        ?>
                        <div class="flex items-start gap-3 sm:gap-4">
                            <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 mt-1">
                                <i data-lucide="check" class="w-3 h-3 sm:w-4 sm:h-4 text-primary"></i>
                            </div>
                            <div>
                                <h4 class="text-sm sm:text-base font-bold text-slate-900 mb-1"><?php echo esc_html($item_title); ?></h4>
                                <p class="text-xs sm:text-sm text-slate-600"><?php echo esc_html($item_desc); ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="mt-6 sm:mt-8 pt-6 sm:pt-8 border-t border-slate-200">
                        <div class="flex items-center gap-3 sm:gap-4 p-4 sm:p-6 bg-gradient-to-r from-primary/5 to-primary/10 rounded-2xl">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-white flex items-center justify-center shadow-lg">
                                <i data-lucide="ruler" class="w-6 h-6 sm:w-8 sm:h-8 text-primary"></i>
                            </div>
                            <div>
                                <h4 class="text-sm sm:text-base font-bold text-slate-900 mb-1"><?php echo esc_html($details_bottom_title); ?></h4>
                                <p class="text-xs sm:text-sm text-slate-600"><?php echo esc_html($details_bottom_text); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technology Comparison -->
    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-primary/10 text-primary mb-4 sm:mb-6">
                    <i data-lucide="<?php echo esc_attr($comp_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    <span class="text-xs sm:text-sm font-bold uppercase tracking-wider"><?php echo esc_html($comp_badge); ?></span>
                </div>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-900 mb-6">
                    <?php echo esc_html($comp_heading); ?>
                </h2>
                <p class="text-sm sm:text-base text-slate-600 max-w-3xl mx-auto">
                    <?php echo esc_html($comp_intro); ?>
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php foreach (array_slice($comp_columns, 0, 3) as $col) :
                    $c_style   = isset($col['style']) ? (string) $col['style'] : 'standard';
                    $c_icon    = isset($col['icon']) && trim((string) $col['icon']) !== '' ? trim((string) $col['icon']) : 'home';
                    $c_title   = isset($col['title']) ? (string) $col['title'] : '';
                    $c_subtitle = isset($col['subtitle']) ? (string) $col['subtitle'] : '';
                    $c_badge   = isset($col['badge_text']) ? (string) $col['badge_text'] : '';
                    $c_rows    = isset($col['rows']) && is_array($col['rows']) ? $col['rows'] : array();
                    $c_bottom_label = isset($col['bottom_label']) ? (string) $col['bottom_label'] : '';
                    $c_bottom_text  = isset($col['bottom_text']) ? (string) $col['bottom_text'] : '';

                    if ($c_style === 'highlight') {
                        $card_class = 'bg-gradient-to-b from-primary to-primary-dark rounded-2xl p-4 sm:p-6 md:p-8 text-white relative transform scale-105 shadow-2xl';
                        $icon_class = 'w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-white/20 flex items-center justify-center mx-auto mb-3 sm:mb-4';
                        $icon_inner = 'w-6 h-6 sm:w-8 sm:h-8 text-white';
                        $title_class = 'text-base sm:text-lg md:text-xl font-bold text-white mb-1 sm:mb-2';
                        $subtitle_class = 'text-xs sm:text-sm text-white/80';
                        $row_class = 'flex items-center justify-between p-2 sm:p-3 bg-white/10 rounded-lg backdrop-blur-sm';
                        $label_class = 'text-xs sm:text-sm';
                        $value_class = 'text-xs sm:text-sm font-bold';
                    } elseif ($c_style === 'global') {
                        $card_class = 'bg-slate-50 rounded-2xl p-4 sm:p-6 md:p-8 border border-slate-200';
                        $icon_class = 'w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-blue-100 flex items-center justify-center mx-auto mb-3 sm:mb-4';
                        $icon_inner = 'w-6 h-6 sm:w-8 sm:h-8 text-blue-600';
                        $title_class = 'text-base sm:text-lg md:text-xl font-bold text-slate-700 mb-1 sm:mb-2';
                        $subtitle_class = 'text-xs sm:text-sm text-slate-500';
                        $row_class = 'flex items-center justify-between p-2 sm:p-3 bg-white rounded-lg';
                        $label_class = 'text-xs sm:text-sm text-slate-600';
                        $value_class = 'text-xs sm:text-sm font-bold text-slate-700';
                    } else {
                        $card_class = 'bg-slate-50 rounded-2xl p-4 sm:p-6 md:p-8 border border-slate-200';
                        $icon_class = 'w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-slate-200 flex items-center justify-center mx-auto mb-3 sm:mb-4';
                        $icon_inner = 'w-6 h-6 sm:w-8 sm:h-8 text-slate-500';
                        $title_class = 'text-base sm:text-lg md:text-xl font-bold text-slate-700 mb-1 sm:mb-2';
                        $subtitle_class = 'text-xs sm:text-sm text-slate-500';
                        $row_class = 'flex items-center justify-between p-2 sm:p-3 bg-white rounded-lg';
                        $label_class = 'text-xs sm:text-sm text-slate-600';
                        $value_class = 'text-xs sm:text-sm font-bold text-slate-700';
                    }
                ?>
                <div class="<?php echo esc_attr($card_class); ?>">
                    <?php if ($c_style === 'highlight' && $c_badge !== '') : ?>
                    <div class="absolute -top-3 sm:-top-4 left-1/2 -translate-x-1/2">
                        <div class="px-3 py-1 sm:px-4 sm:py-1.5 rounded-full bg-accent text-white text-[10px] sm:text-xs font-bold uppercase tracking-wider"><?php echo esc_html($c_badge); ?></div>
                    </div>
                    <?php endif; ?>
                    <div class="text-center mb-6 sm:mb-8">
                        <div class="<?php echo esc_attr($icon_class); ?>">
                            <i data-lucide="<?php echo esc_attr($c_icon); ?>" class="<?php echo esc_attr($icon_inner); ?>"></i>
                        </div>
                        <h3 class="<?php echo esc_attr($title_class); ?>"><?php echo esc_html($c_title); ?></h3>
                        <p class="<?php echo esc_attr($subtitle_class); ?>"><?php echo esc_html($c_subtitle); ?></p>
                    </div>
                    <div class="space-y-2 sm:space-y-3 md:space-y-4">
                        <?php foreach ($c_rows as $row) :
                            $r_label = isset($row['label']) ? (string) $row['label'] : '';
                            $r_value = isset($row['value']) ? (string) $row['value'] : '';
                        ?>
                        <div class="<?php echo esc_attr($row_class); ?>">
                            <span class="<?php echo esc_attr($label_class); ?>"><?php echo esc_html($r_label); ?></span>
                            <span class="<?php echo esc_attr($value_class); ?>"><?php echo esc_html($r_value); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if ($c_style === 'highlight' && ($c_bottom_label !== '' || $c_bottom_text !== '')) : ?>
                    <div class="mt-6 sm:mt-8 pt-6 sm:pt-8 border-t border-white/20">
                        <div class="text-center">
                            <?php if ($c_bottom_label !== '') : ?><div class="text-lg sm:text-xl md:text-2xl font-bold mb-1"><?php echo esc_html($c_bottom_label); ?></div><?php endif; ?>
                            <?php if ($c_bottom_text !== '') : ?><p class="text-xs sm:text-sm text-white/80"><?php echo esc_html($c_bottom_text); ?></p><?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-8 sm:mt-12">
                <p class="text-sm sm:text-base text-slate-600 max-w-2xl mx-auto">
                    <?php echo esc_html($comp_bottom); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-12 sm:py-16 md:py-20 bg-gradient-to-r from-primary/5 via-primary/10 to-primary/5">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-white flex items-center justify-center mx-auto mb-6 sm:mb-8 shadow-lg">
                <i data-lucide="<?php echo esc_attr($cta_icon); ?>" class="w-8 h-8 sm:w-10 sm:h-10 text-primary"></i>
            </div>
            <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-900 mb-4 sm:mb-6">
                <?php echo esc_html($cta_heading); ?>
            </h2>
            <p class="text-sm sm:text-base text-slate-600 mb-6 sm:mb-8 max-w-2xl mx-auto">
                <?php echo esc_html($cta_desc); ?>
            </p>
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center">
                <a href="<?php echo esc_url($cta_primary['url']); ?>"<?php echo !empty($cta_primary['target']) ? ' target="' . esc_attr($cta_primary['target']) . '"' : ''; ?> class="inline-flex items-center gap-2 px-4 py-2 sm:px-8 sm:py-4 bg-primary text-white rounded-full font-bold text-sm sm:text-base md:text-lg hover:bg-primary-dark transition-all transform hover:-translate-y-0.5 shadow-lg hover:shadow-xl">
                    <i data-lucide="<?php echo esc_attr($cta_icon1); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    <?php echo esc_html(isset($cta_primary['title']) ? $cta_primary['title'] : 'Schedule a Campus Tour'); ?>
                </a>
                <a href="<?php echo esc_url($cta_secondary['url']); ?>"<?php echo !empty($cta_secondary['target']) ? ' target="' . esc_attr($cta_secondary['target']) . '"' : ''; ?> class="inline-flex items-center gap-2 px-4 py-2 sm:px-8 sm:py-4 bg-white text-primary border border-primary/30 rounded-full font-bold text-sm sm:text-base md:text-lg hover:bg-primary/5 transition-all transform hover:-translate-y-0.5 shadow-lg hover:shadow-xl">
                    <i data-lucide="<?php echo esc_attr($cta_icon2); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    <?php echo esc_html(isset($cta_secondary['title']) ? $cta_secondary['title'] : 'Virtual Classroom Tour'); ?>
                </a>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
