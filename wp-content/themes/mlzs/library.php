<?php
/**
 * Template Name: Library Page
 * Library: Hero, Overview, Salient Features (6), Gallery (3), CTA – ACF dynamic
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge     = $opt ? get_field('library_hero_badge', $page_id) : null;
$hero_icon      = $opt ? get_field('library_hero_icon', $page_id) : null;
$hero_headline  = $opt ? get_field('library_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('library_hero_highlight', $page_id) : null;
$hero_sub       = $opt ? get_field('library_hero_subheadline', $page_id) : null;

$hero_badge     = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Campus Facilities';
$hero_icon      = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'book-open';
$hero_headline  = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'School';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Library';
$hero_sub       = ($hero_sub !== '' && $hero_sub !== null) ? (string) $hero_sub : 'A 1000 SQ FT learning resource center fostering lifelong learning abilities and nurturing the love for reading';

// ——— Library Overview ———
$overview_badge   = $opt ? get_field('library_overview_badge', $page_id) : null;
$overview_heading = $opt ? get_field('library_overview_heading', $page_id) : null;
$overview_para1   = $opt ? get_field('library_overview_para1', $page_id) : null;
$overview_para2   = $opt ? get_field('library_overview_para2', $page_id) : null;
$overview_image   = $opt ? get_field('library_overview_image', $page_id) : null;
$overview_stat_num = $opt ? get_field('library_overview_stat_number', $page_id) : null;
$overview_stat_lab = $opt ? get_field('library_overview_stat_label', $page_id) : null;

$overview_badge   = ($overview_badge !== '' && $overview_badge !== null) ? (string) $overview_badge : 'Learning Resource Center';
$overview_heading = ($overview_heading !== '' && $overview_heading !== null) ? (string) $overview_heading : 'More Than Just Books';
$overview_para1   = ($overview_para1 !== '' && $overview_para1 !== null) ? (string) $overview_para1 : 'The 1000 SQ FT school library is a learning resource center in the widest sense as it houses information resources, expansive reading material, and digital data with internet access. The school library fosters the development of life-long learning abilities and inculcates love for reading in students.';
$overview_para2   = ($overview_para2 !== '' && $overview_para2 !== null) ? (string) $overview_para2 : 'It also provides teachers with instructional material and professional resources, creating a comprehensive ecosystem for academic excellence.';
$overview_stat_num = ($overview_stat_num !== '' && $overview_stat_num !== null) ? (string) $overview_stat_num : '1000';
$overview_stat_lab = ($overview_stat_lab !== '' && $overview_stat_lab !== null) ? (string) $overview_stat_lab : 'SQ FT Area';

$overview_image_url = '';
if (!empty($overview_image)) {
    if (is_array($overview_image) && !empty($overview_image['url'])) $overview_image_url = $overview_image['url'];
    elseif (is_numeric($overview_image)) $overview_image_url = wp_get_attachment_image_url((int) $overview_image, 'full') ?: '';
}
if ($overview_image_url === '') $overview_image_url = 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80';

// ——— Salient Features (6) ———
$feat_heading   = $opt ? get_field('library_features_heading', $page_id) : null;
$feat_highlight = $opt ? get_field('library_features_highlight', $page_id) : null;
$feat_subtext   = $opt ? get_field('library_features_subtext', $page_id) : null;
$feat_items     = $opt ? get_field('library_features_items', $page_id) : null;

$feat_heading   = ($feat_heading !== '' && $feat_heading !== null) ? (string) $feat_heading : 'Salient';
$feat_highlight = ($feat_highlight !== '' && $feat_highlight !== null) ? (string) $feat_highlight : 'Features';
$feat_subtext   = ($feat_subtext !== '' && $feat_subtext !== null) ? (string) $feat_subtext : 'Our library is equipped with state-of-the-art facilities to enhance the learning experience';

$default_feat_items = array(
    array('icon' => 'monitor', 'style' => 'primary', 'title' => 'E-Library Facility', 'paragraph' => 'Digital library resources with access to e-books, online journals, and digital publications for enhanced learning.'),
    array('icon' => 'shield', 'style' => 'accent', 'title' => 'Safe Browsing Environment', 'paragraph' => 'Surveillance system to monitor students and ensure safe internet browsing with content filtering.'),
    array('icon' => 'users', 'style' => 'primary-light', 'title' => 'Dedicated Reference Area', 'paragraph' => 'Specific reference area equipped with computers for both teachers and students to conduct research.'),
    array('icon' => 'newspaper', 'style' => 'primary', 'title' => 'Latest Publications', 'paragraph' => 'Subscription to latest magazines, newspapers, and journals for students and teachers to stay updated.'),
    array('icon' => 'wifi', 'style' => 'accent', 'title' => 'Digital Access', 'paragraph' => 'Computer and internet access available to all students and faculty members for research and learning.'),
    array('icon' => 'leaf', 'style' => 'primary-light', 'title' => 'Natural Ambiance', 'paragraph' => 'Library in the lap of nature providing a peaceful and inspiring environment for concentrated study.'),
);
$feat_items = (is_array($feat_items) && count($feat_items) >= 6) ? $feat_items : $default_feat_items;

// ——— Library Gallery (3) ———
$gallery_heading = $opt ? get_field('library_gallery_heading', $page_id) : null;
$gallery_highlight = $opt ? get_field('library_gallery_highlight', $page_id) : null;
$gallery_subtext = $opt ? get_field('library_gallery_subtext', $page_id) : null;
$gallery_items   = $opt ? get_field('library_gallery_items', $page_id) : null;

$gallery_heading   = ($gallery_heading !== '' && $gallery_heading !== null) ? (string) $gallery_heading : 'Library';
$gallery_highlight = ($gallery_highlight !== '' && $gallery_highlight !== null) ? (string) $gallery_highlight : 'Gallery';
$gallery_subtext   = ($gallery_subtext !== '' && $gallery_subtext !== null) ? (string) $gallery_subtext : 'Explore our well-equipped library spaces designed for different age groups';

$default_gallery_items = array(
    array('image' => array('url' => 'https://images.unsplash.com/photo-1589998059171-988d887df646?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')),
    array('image' => array('url' => 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')),
    array('image' => array('url' => 'https://images.unsplash.com/photo-1516979187457-637abb4f9353?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')),
);
$gallery_items = (is_array($gallery_items) && count($gallery_items) >= 3) ? $gallery_items : $default_gallery_items;

// ——— CTA ———
$cta_heading = $opt ? get_field('library_cta_heading', $page_id) : null;
$cta_para    = $opt ? get_field('library_cta_para', $page_id) : null;
$cta_btn1_icon = $opt ? get_field('library_cta_btn1_icon', $page_id) : null;
$cta_btn1_link = $opt ? get_field('library_cta_btn1_link', $page_id) : null;
$cta_btn2_icon = $opt ? get_field('library_cta_btn2_icon', $page_id) : null;
$cta_btn2_link = $opt ? get_field('library_cta_btn2_link', $page_id) : null;
$cta_stats   = $opt ? get_field('library_cta_stats', $page_id) : null;

$cta_heading  = ($cta_heading !== '' && $cta_heading !== null) ? (string) $cta_heading : 'Visit Our Library';
$cta_para     = ($cta_para !== '' && $cta_para !== null) ? (string) $cta_para : 'Experience our state-of-the-art library facilities firsthand. Schedule a visit to explore how we foster love for reading and research among our students.';
$cta_btn1_icon = (is_string($cta_btn1_icon) && trim($cta_btn1_icon) !== '') ? trim($cta_btn1_icon) : 'calendar';
$cta_btn2_icon = (is_string($cta_btn2_icon) && trim($cta_btn2_icon) !== '') ? trim($cta_btn2_icon) : 'book-open';

$cta_btn1_url = $cta_btn1_target = $cta_btn1_text = '';
if (!empty($cta_btn1_link) && is_array($cta_btn1_link)) {
    $cta_btn1_url    = isset($cta_btn1_link['url']) ? esc_url($cta_btn1_link['url']) : '';
    $cta_btn1_target  = isset($cta_btn1_link['target']) ? $cta_btn1_link['target'] : '_self';
    $cta_btn1_text    = isset($cta_btn1_link['title']) && trim((string) $cta_btn1_link['title']) !== '' ? (string) $cta_btn1_link['title'] : 'Schedule Library Tour';
} else {
    $cta_btn1_url = '#';
    $cta_btn1_target = '_self';
    $cta_btn1_text = 'Schedule Library Tour';
}

$cta_btn2_url = $cta_btn2_target = $cta_btn2_text = '';
if (!empty($cta_btn2_link) && is_array($cta_btn2_link)) {
    $cta_btn2_url    = isset($cta_btn2_link['url']) ? esc_url($cta_btn2_link['url']) : '';
    $cta_btn2_target = isset($cta_btn2_link['target']) ? $cta_btn2_link['target'] : '_self';
    $cta_btn2_text   = isset($cta_btn2_link['title']) && trim((string) $cta_btn2_link['title']) !== '' ? (string) $cta_btn2_link['title'] : 'View Reading List';
} else {
    $cta_btn2_url = '#';
    $cta_btn2_target = '_self';
    $cta_btn2_text = 'View Reading List';
}

$default_cta_stats = array(
    array('number' => '5000+', 'label' => 'Books Collection', 'color' => 'primary'),
    array('number' => '24/7', 'label' => 'E-Library Access', 'color' => 'accent'),
    array('number' => '50+', 'label' => 'Journals & Magazines', 'color' => 'primary-light'),
    array('number' => '100%', 'label' => 'Digital Safety', 'color' => 'accent-dark'),
);
$cta_stats = (is_array($cta_stats) && count($cta_stats) >= 4) ? $cta_stats : $default_cta_stats;

// Helper: gallery image URL from repeater row
function mlzs_library_gallery_img_url($row) {
    if (empty($row) || !is_array($row)) return '';
    $img = isset($row['image']) ? $row['image'] : null;
    if (empty($img)) return '';
    if (is_array($img) && !empty($img['url'])) return $img['url'];
    if (is_numeric($img)) return wp_get_attachment_image_url((int) $img, 'full') ?: '';
    return '';
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

    <!-- Library Overview -->
    <section class="px-4 sm:px-6 lg:px-8 py-12 md:py-20 bg-background-light">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center mb-12">
                <div class="space-y-6">
                    <div class="flex flex-col gap-4">
                        <span class="w-fit rounded-full bg-primary/10 px-4 py-2 text-sm font-bold uppercase tracking-wider text-primary ring-1 ring-primary/20">
                            <?php echo esc_html($overview_badge); ?>
                        </span>
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-text-main-light">
                            <?php echo esc_html($overview_heading); ?>
                        </h2>
                    </div>
                    <p class="text-base sm:text-lg text-text-secondary-light leading-relaxed">
                        <?php echo esc_html($overview_para1); ?>
                    </p>
                    <p class="text-base sm:text-lg text-text-secondary-light leading-relaxed">
                        <?php echo esc_html($overview_para2); ?>
                    </p>
                </div>
                <div class="relative">
                    <div class="relative rounded-[1rem] overflow-hidden shadow-2xl">
                        <img src="<?php echo esc_url($overview_image_url); ?>"
                             alt="School Library Interior"
                             class="w-full h-[350px] md:h-[400px] object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/40 to-transparent"></div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 bg-white rounded-xl p-4 shadow-xl">
                        <div class="text-3xl font-bold text-primary"><?php echo esc_html($overview_stat_num); ?></div>
                        <div class="text-sm font-bold text-text-main-light uppercase tracking-wide"><?php echo esc_html($overview_stat_lab); ?></div>
                    </div>
                </div>
            </div>

            <!-- Salient Features -->
            <div class="mb-16">
                <div class="text-center mb-10">
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-text-main-light mb-4">
                        <?php echo esc_html($feat_heading); ?> <span class="text-primary"><?php echo esc_html($feat_highlight); ?></span>
                    </h3>
                    <p class="text-base sm:text-lg text-text-secondary-light max-w-2xl mx-auto">
                        <?php echo esc_html($feat_subtext); ?>
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($feat_items as $item) :
                        $f_icon   = isset($item['icon']) && trim((string) $item['icon']) !== '' ? trim($item['icon']) : 'monitor';
                        $f_style  = isset($item['style']) && in_array($item['style'], array('primary', 'accent', 'primary-light'), true) ? $item['style'] : 'primary';
                        $f_title  = isset($item['title']) ? (string) $item['title'] : '';
                        $f_para   = isset($item['paragraph']) ? (string) $item['paragraph'] : '';
                        $hover_border = $f_style === 'accent' ? 'hover:border-accent/30' : ($f_style === 'primary-light' ? 'hover:border-primary-light/30' : 'hover:border-primary/30');
                        $icon_bg  = $f_style === 'accent' ? 'bg-accent/10' : ($f_style === 'primary-light' ? 'bg-primary-light/10' : 'bg-primary/10');
                        $icon_text = $f_style === 'accent' ? 'text-accent' : ($f_style === 'primary-light' ? 'text-primary-light' : 'text-primary');
                        $icon_hover = $f_style === 'accent' ? 'group-hover:bg-accent group-hover:text-white' : ($f_style === 'primary-light' ? 'group-hover:bg-primary-light group-hover:text-white' : 'group-hover:bg-primary group-hover:text-white');
                    ?>
                    <div class="group bg-white rounded-[1rem] p-6 shadow-soft hover:shadow-xl border border-border-light <?php echo esc_attr($hover_border); ?> transition-all duration-300 hover:-translate-y-2">
                        <div class="w-12 h-12 rounded-xl <?php echo esc_attr($icon_bg); ?> flex items-center justify-center mb-4 <?php echo esc_attr($icon_hover); ?> transition-colors">
                            <i data-lucide="<?php echo esc_attr($f_icon); ?>" class="w-6 h-6 <?php echo esc_attr($icon_text); ?> group-hover:text-white"></i>
                        </div>
                        <h4 class="text-lg sm:text-xl font-bold text-text-main-light mb-3"><?php echo esc_html($f_title); ?></h4>
                        <p class="text-sm sm:text-base text-text-secondary-light">
                            <?php echo esc_html($f_para); ?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Library Gallery -->
            <div class="mb-16">
                <div class="text-center mb-10">
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-text-main-light mb-4">
                        <?php echo esc_html($gallery_heading); ?> <span class="text-primary"><?php echo esc_html($gallery_highlight); ?></span>
                    </h3>
                    <p class="text-base sm:text-lg text-text-secondary-light max-w-2xl mx-auto">
                        <?php echo esc_html($gallery_subtext); ?>
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <?php foreach ($gallery_items as $gitem) :
                        $gimg = mlzs_library_gallery_img_url($gitem);
                        if ($gimg === '') $gimg = 'https://images.unsplash.com/photo-1589998059171-988d887df646?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                        $galt = (isset($gitem['image']) && is_array($gitem['image']) && isset($gitem['image']['alt']) && trim((string) $gitem['image']['alt']) !== '') ? trim((string) $gitem['image']['alt']) : 'Library';
                    ?>
                    <div class="group relative rounded-[1rem] overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                        <div class="h-64">
                            <img src="<?php echo esc_url($gimg); ?>"
                                 alt="<?php echo esc_attr($galt); ?>"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="mt-16 bg-gradient-to-r from-primary/10 to-accent/10 rounded-[1.5rem] p-8 md:p-12 border border-primary/20">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div>
                        <h3 class="text-2xl sm:text-3xl font-bold text-text-main-light mb-4"><?php echo esc_html($cta_heading); ?></h3>
                        <p class="text-base sm:text-lg text-text-secondary-light leading-relaxed mb-6">
                            <?php echo esc_html($cta_para); ?>
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="<?php echo $cta_btn1_url; ?>" target="<?php echo esc_attr($cta_btn1_target); ?>" class="px-4 py-2 sm:px-6 sm:py-3 bg-primary text-white rounded-full font-bold hover:bg-primary-dark transition-all flex items-center justify-center gap-2 group w-full sm:w-auto text-sm sm:text-base">
                                <?php echo esc_html($cta_btn1_text); ?>
                                <i data-lucide="<?php echo esc_attr($cta_btn1_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                            <a href="<?php echo $cta_btn2_url; ?>" target="<?php echo esc_attr($cta_btn2_target); ?>" class="px-4 py-2 sm:px-6 sm:py-3 bg-white border border-border-light text-text-main-light rounded-full font-bold hover:bg-gray-50 transition-all flex items-center justify-center gap-2 group w-full sm:w-auto text-sm sm:text-base">
                                <i data-lucide="<?php echo esc_attr($cta_btn2_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                                <?php echo esc_html($cta_btn2_text); ?>
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <?php foreach ($cta_stats as $st) :
                            $st_num  = isset($st['number']) ? (string) $st['number'] : '';
                            $st_lab  = isset($st['label']) ? (string) $st['label'] : '';
                            $st_col  = isset($st['color']) && in_array($st['color'], array('primary', 'accent', 'primary-light', 'accent-dark'), true) ? $st['color'] : 'primary';
                            $st_class = $st_col === 'accent' ? 'text-accent' : ($st_col === 'primary-light' ? 'text-primary-light' : ($st_col === 'accent-dark' ? 'text-accent-dark' : 'text-primary'));
                        ?>
                        <div class="bg-white rounded-xl p-6 text-center shadow-sm">
                            <div class="text-3xl font-bold <?php echo esc_attr($st_class); ?> mb-2"><?php echo esc_html($st_num); ?></div>
                            <div class="text-sm font-medium text-text-secondary-light"><?php echo esc_html($st_lab); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
