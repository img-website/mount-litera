<?php
/**
 * Template Name: Campus / Origin Page
 * Origin: Hero, Campus Overview (4 items), Videos (2), Gallery (6), Features (4), CTA – ACF dynamic
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

function mlzs_origin_img_url($img) {
    if (empty($img)) return '';
    if (is_array($img) && !empty($img['url'])) return $img['url'];
    if (is_numeric($img)) return wp_get_attachment_image_url((int) $img, 'full') ?: '';
    return '';
}

// ——— Hero ———
$hero_bg_image = $opt ? get_field('origin_hero_bg_image', $page_id) : null;
$hero_badge   = $opt ? get_field('origin_hero_badge', $page_id) : null;
$hero_icon    = $opt ? get_field('origin_hero_icon', $page_id) : null;
$hero_before  = $opt ? get_field('origin_hero_headline_before', $page_id) : null;
$hero_highlight = $opt ? get_field('origin_hero_headline_highlight', $page_id) : null;
$hero_subtext = $opt ? get_field('origin_hero_subtext', $page_id) : null;

$hero_bg_url = '';
if (!empty($hero_bg_image) && is_array($hero_bg_image) && !empty($hero_bg_image['url'])) {
    $hero_bg_url = $hero_bg_image['url'];
}
$hero_badge   = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Campus Tour';
$hero_icon    = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'map-pin';
$hero_before  = ($hero_before !== '' && $hero_before !== null) ? (string) $hero_before : 'Our';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Campus';
$hero_subtext = ($hero_subtext !== '' && $hero_subtext !== null) ? (string) $hero_subtext : 'Discover the vibrant learning environment at Mount Litera Zee School, Alwar - 5 acres of inspiring spaces designed for holistic education.';

// ——— Campus Overview ———
$overview_section_image = $opt ? get_field('origin_overview_section_image', $page_id) : null;
$overview_heading = $opt ? get_field('origin_overview_heading', $page_id) : null;
$overview_location = $opt ? get_field('origin_overview_location', $page_id) : null;
$overview_icon   = $opt ? get_field('origin_overview_icon', $page_id) : null;
$overview_items  = $opt ? get_field('origin_overview_items', $page_id) : null;

$overview_img_url = '';
if (!empty($overview_section_image) && is_array($overview_section_image) && !empty($overview_section_image['url'])) {
    $overview_img_url = $overview_section_image['url'];
}
$overview_img_alt = (is_array($overview_section_image) && !empty($overview_section_image['alt']) && is_string($overview_section_image['alt'])) ? trim($overview_section_image['alt']) : 'Campus';

$overview_heading = ($overview_heading !== '' && $overview_heading !== null) ? (string) $overview_heading : 'Campus Overview';
$overview_location = ($overview_location !== '' && $overview_location !== null) ? (string) $overview_location : 'Sirmoli Village, Alwar';
$overview_icon   = (is_string($overview_icon) && trim($overview_icon) !== '') ? trim($overview_icon) : 'building-2';

$default_overview = array(
    array('icon' => 'map', 'style' => 'primary', 'title' => 'Prime Location', 'paragraph' => 'Mount Litera sits on 5 acres of charming buildings, green playing fields, and grand oak trees on Sirmoli Village. Just twenty minutes from Alwar Headquarter.'),
    array('icon' => 'users', 'style' => 'accent', 'title' => 'Collaborative Culture', 'paragraph' => 'The distinctive Mount Litera culture is decidedly collaborative, hands-on, friendly and open minded. Learning takes place not just in classrooms but in well-equipped buildings all over campus.'),
    array('icon' => 'tree-pine', 'style' => 'primary-light', 'title' => 'Primary School Environment', 'paragraph' => 'The Primary school has a long tradition of "carpe diem" - evident in the school garden and massive rope swing that flank its homey, sun-filled classrooms. Middle scholars enjoy their own space on campus, with decks, grassy courtyards and room to have fun with friends.'),
    array('icon' => 'monitor', 'style' => 'accent-dark', 'title' => 'Modern Classrooms', 'paragraph' => 'The Middle school classrooms are equipped with technology, and designed for seminar-style classes.'),
);
$overview_items = (is_array($overview_items) && count($overview_items) >= 4) ? $overview_items : $default_overview;

// ——— Videos ———
$video1_icon  = $opt ? get_field('origin_video1_icon', $page_id) : null;
$video1_title = $opt ? get_field('origin_video1_title', $page_id) : null;
$video1_url   = $opt ? get_field('origin_video1_url', $page_id) : null;
$video2_icon  = $opt ? get_field('origin_video2_icon', $page_id) : null;
$video2_title = $opt ? get_field('origin_video2_title', $page_id) : null;
$video2_url   = $opt ? get_field('origin_video2_url', $page_id) : null;

$video1_icon  = (is_string($video1_icon) && trim($video1_icon) !== '') ? trim($video1_icon) : 'play-circle';
$video1_title = ($video1_title !== '' && $video1_title !== null) ? (string) $video1_title : 'Campus Tour Video';
$video2_title = ($video2_title !== '' && $video2_title !== null) ? (string) $video2_title : 'Virtual Walkthrough';

// YouTube video ID from URL
function mlzs_origin_youtube_id($url) {
    if (empty($url) || !is_string($url)) return null;
    if (preg_match('#(?:youtube\.com/watch\?v=|youtu\.be/|youtube\.com/embed/|youtube\.com/v/)([a-zA-Z0-9_-]{11})#', $url, $m)) {
        return $m[1];
    }
    return null;
}
// YouTube title via oEmbed (no API key), cached 24h
function mlzs_origin_youtube_title($url) {
    $id = mlzs_origin_youtube_id($url);
    if (!$id) return '';
    $cache_key = 'origin_yt_title_' . $id;
    $cached = get_transient($cache_key);
    if ($cached !== false && is_string($cached)) return $cached;
    $oembed_url = 'https://www.youtube.com/oembed?url=' . rawurlencode('https://www.youtube.com/watch?v=' . $id) . '&format=json';
    $resp = wp_remote_get($oembed_url, array('timeout' => 10));
    if (is_wp_error($resp) || wp_remote_retrieve_response_code($resp) !== 200) return '';
    $body = wp_remote_retrieve_body($resp);
    $json = json_decode($body, true);
    $title = (is_array($json) && !empty($json['title']) && is_string($json['title'])) ? trim($json['title']) : '';
    if ($title !== '') set_transient($cache_key, $title, DAY_IN_SECONDS);
    return $title;
}
// YouTube duration via Data API v3 (requires API key in Options or constant MLZS_YOUTUBE_API_KEY), cached 24h
function mlzs_origin_youtube_duration($url) {
    $id = mlzs_origin_youtube_id($url);
    if (!$id) return '';
    $api_key = get_option('mlzs_youtube_api_key', '');
    if (defined('MLZS_YOUTUBE_API_KEY')) {
        $k = constant('MLZS_YOUTUBE_API_KEY');
        if (is_string($k) && $k !== '') $api_key = $k;
    }
    if ($api_key === '') return '';
    $cache_key = 'origin_yt_dur_' . $id;
    $cached = get_transient($cache_key);
    if ($cached !== false && is_string($cached)) return $cached;
    $api_url = 'https://www.googleapis.com/youtube/v3/videos?id=' . $id . '&part=contentDetails&key=' . rawurlencode($api_key);
    $resp = wp_remote_get($api_url, array('timeout' => 10));
    if (is_wp_error($resp) || wp_remote_retrieve_response_code($resp) !== 200) return '';
    $body = wp_remote_retrieve_body($resp);
    $json = json_decode($body, true);
    $duration_iso = '';
    if (is_array($json) && !empty($json['items'][0]['contentDetails']['duration'])) {
        $duration_iso = $json['items'][0]['contentDetails']['duration'];
    }
    if ($duration_iso === '') return '';
    try {
        $di = new DateInterval($duration_iso);
        $s = (int) $di->s;
        $m = (int) $di->i;
        $h = (int) $di->h;
        $formatted = ($h > 0 ? $h . ':' : '') . str_pad((string) $m, 2, '0', STR_PAD_LEFT) . ':' . str_pad((string) $s, 2, '0', STR_PAD_LEFT);
        set_transient($cache_key, $formatted, DAY_IN_SECONDS);
        return $formatted;
    } catch (Exception $e) {
        return '';
    }
}
// Derive label (YouTube title, filename, or fallback) and duration (YouTube API, attachment meta, or —)
function mlzs_origin_video_label_and_duration($url, $fallback_label = 'Video') {
    $label = $fallback_label;
    $duration = '';
    if (!empty($url) && is_string($url)) {
        $yt_id = mlzs_origin_youtube_id($url);
        if ($yt_id) {
            $title = mlzs_origin_youtube_title($url);
            if ($title !== '') $label = $title;
            $dur = mlzs_origin_youtube_duration($url);
            if ($dur !== '') $duration = $dur;
        } else {
            $path = parse_url($url, PHP_URL_PATH);
            if ($path) {
                $basename = basename($path);
                if ($basename !== '') $label = $basename;
            }
            $aid = attachment_url_to_postid($url);
            if ($aid) {
                $meta = wp_get_attachment_metadata($aid);
                if (!empty($meta['length_formatted'])) $duration = $meta['length_formatted'];
                elseif (isset($meta['length']) && is_numeric($meta['length'])) $duration = gmdate('i:s', (int) $meta['length']);
            }
        }
    }
    return array('label' => $label, 'duration' => $duration);
}
$v1 = mlzs_origin_video_label_and_duration($video1_url, 'Video 1');
$video1_label = $v1['label'];
$video1_duration = $v1['duration'] !== '' ? $v1['duration'] : '—';
$v2 = mlzs_origin_video_label_and_duration($video2_url, 'Video 2');
$video2_label = $v2['label'];
$video2_duration = $v2['duration'] !== '' ? $v2['duration'] : '—';

// YouTube thumbnail from URL (youtube.com/watch?v=ID, youtu.be/ID, youtube.com/embed/ID)
function mlzs_origin_youtube_thumbnail($url) {
    if (empty($url) || !is_string($url)) return null;
    $id = null;
    if (preg_match('#(?:youtube\.com/watch\?v=|youtu\.be/|youtube\.com/embed/|youtube\.com/v/)([a-zA-Z0-9_-]{11})#', $url, $m)) {
        $id = $m[1];
    }
    if (!$id) return null;
    return 'https://img.youtube.com/vi/' . $id . '/hqdefault.jpg';
}
$video1_thumb = mlzs_origin_youtube_thumbnail($video1_url);
$video2_thumb = mlzs_origin_youtube_thumbnail($video2_url);

// ——— Gallery ———
$gal_icon    = $opt ? get_field('origin_gallery_icon', $page_id) : null;
$gal_badge   = $opt ? get_field('origin_gallery_badge', $page_id) : null;
$gal_before  = $opt ? get_field('origin_gallery_heading_before', $page_id) : null;
$gal_highlight = $opt ? get_field('origin_gallery_heading_highlight', $page_id) : null;
$gal_subtext = $opt ? get_field('origin_gallery_subtext', $page_id) : null;
$gal_items   = $opt ? get_field('origin_gallery_items', $page_id) : null;
$gal_btn_link = $opt ? get_field('origin_gallery_btn_link', $page_id) : null;

$gal_icon    = (is_string($gal_icon) && trim($gal_icon) !== '') ? trim($gal_icon) : 'image';
$gal_badge   = ($gal_badge !== '' && $gal_badge !== null) ? (string) $gal_badge : 'Photo Gallery';
$gal_before  = ($gal_before !== '' && $gal_before !== null) ? (string) $gal_before : 'Explore Our';
$gal_highlight = ($gal_highlight !== '' && $gal_highlight !== null) ? (string) $gal_highlight : 'Campus';
$gal_subtext = ($gal_subtext !== '' && $gal_subtext !== null) ? (string) $gal_subtext : 'Take a visual tour through our state-of-the-art facilities and beautiful campus spaces.';

$default_gal = array(
    array('image' => array(), 'label' => 'Academic Building', 'caption' => 'Main campus entrance and academic block'),
    array('image' => array(), 'label' => 'Playground', 'caption' => 'Green playing fields and sports facilities'),
    array('image' => array(), 'label' => 'Classrooms', 'caption' => 'Modern, technology-equipped classrooms'),
    array('image' => array(), 'label' => 'Library', 'caption' => 'Well-stocked library and reading area'),
    array('image' => array(), 'label' => 'Science Lab', 'caption' => 'State-of-the-art science laboratories'),
    array('image' => array(), 'label' => 'Auditorium', 'caption' => 'Multi-purpose auditorium and stage'),
);
$gal_items = (is_array($gal_items) && count($gal_items) >= 6) ? $gal_items : $default_gal;

$gal_more_images = $opt ? get_field('origin_gallery_more_images', $page_id) : null;
$gal_more_images = is_array($gal_more_images) ? $gal_more_images : array();

$gal_btn_url = $gal_btn_target = $gal_btn_text = '';
if (!empty($gal_btn_link) && is_array($gal_btn_link)) {
    $gal_btn_url   = isset($gal_btn_link['url']) ? esc_url($gal_btn_link['url']) : '#';
    $gal_btn_target = isset($gal_btn_link['target']) ? $gal_btn_link['target'] : '_self';
    $gal_btn_text  = isset($gal_btn_link['title']) && trim((string) $gal_btn_link['title']) !== '' ? (string) $gal_btn_link['title'] : 'View Complete Gallery';
} else { $gal_btn_url = '#'; $gal_btn_target = '_self'; $gal_btn_text = 'View Complete Gallery'; }

// ——— Features ———
$feat_before  = $opt ? get_field('origin_features_heading_before', $page_id) : null;
$feat_highlight = $opt ? get_field('origin_features_heading_highlight', $page_id) : null;
$feat_subtext = $opt ? get_field('origin_features_subtext', $page_id) : null;
$feat_items   = $opt ? get_field('origin_features_items', $page_id) : null;

$feat_before  = ($feat_before !== '' && $feat_before !== null) ? (string) $feat_before : 'Campus';
$feat_highlight = ($feat_highlight !== '' && $feat_highlight !== null) ? (string) $feat_highlight : 'Features';
$feat_subtext = ($feat_subtext !== '' && $feat_subtext !== null) ? (string) $feat_subtext : 'Discover what makes our campus an ideal learning environment';

$default_feat = array(
    array('icon' => 'trees', 'style' => 'primary', 'title' => '5 Acre Campus', 'paragraph' => 'Spacious green environment with playing fields and gardens'),
    array('icon' => 'wifi', 'style' => 'accent', 'title' => 'Tech-Enabled', 'paragraph' => 'Modern classrooms with latest educational technology'),
    array('icon' => 'shield', 'style' => 'primary-light', 'title' => 'Safe & Secure', 'paragraph' => '24/7 security and surveillance across campus'),
    array('icon' => 'heart', 'style' => 'accent-dark', 'title' => 'Healthy Environment', 'paragraph' => 'Clean, hygienic facilities with medical support'),
);
$feat_items = (is_array($feat_items) && count($feat_items) >= 4) ? $feat_items : $default_feat;

// ——— CTA ———
$cta_heading = $opt ? get_field('origin_cta_heading', $page_id) : null;
$cta_para    = $opt ? get_field('origin_cta_paragraph', $page_id) : null;
$cta_btn1_link = $opt ? get_field('origin_cta_btn1_link', $page_id) : null;
$cta_btn1_icon = $opt ? get_field('origin_cta_btn1_icon', $page_id) : null;
$cta_btn2_link = $opt ? get_field('origin_cta_btn2_link', $page_id) : null;
$cta_btn2_icon = $opt ? get_field('origin_cta_btn2_icon', $page_id) : null;

$cta_heading = ($cta_heading !== '' && $cta_heading !== null) ? (string) $cta_heading : 'Experience Our Campus in Person';
$cta_para    = ($cta_para !== '' && $cta_para !== null) ? (string) $cta_para : 'Schedule a personalized campus tour and see for yourself what makes Mount Litera special.';
$cta_btn1_icon = (is_string($cta_btn1_icon) && trim($cta_btn1_icon) !== '') ? trim($cta_btn1_icon) : 'calendar';
$cta_btn2_icon = (is_string($cta_btn2_icon) && trim($cta_btn2_icon) !== '') ? trim($cta_btn2_icon) : 'phone';

$cta_btn1_url = $cta_btn1_target = $cta_btn1_text = '';
if (!empty($cta_btn1_link) && is_array($cta_btn1_link)) {
    $cta_btn1_url   = isset($cta_btn1_link['url']) ? esc_url($cta_btn1_link['url']) : '#';
    $cta_btn1_target = isset($cta_btn1_link['target']) ? $cta_btn1_link['target'] : '_self';
    $cta_btn1_text  = isset($cta_btn1_link['title']) && trim((string) $cta_btn1_link['title']) !== '' ? (string) $cta_btn1_link['title'] : 'Schedule a Tour';
} else { $cta_btn1_url = '#'; $cta_btn1_target = '_self'; $cta_btn1_text = 'Schedule a Tour'; }

$cta_btn2_url = $cta_btn2_target = $cta_btn2_text = '';
if (!empty($cta_btn2_link) && is_array($cta_btn2_link)) {
    $cta_btn2_url   = isset($cta_btn2_link['url']) ? esc_url($cta_btn2_link['url']) : '#';
    $cta_btn2_target = isset($cta_btn2_link['target']) ? $cta_btn2_link['target'] : '_self';
    $cta_btn2_text  = isset($cta_btn2_link['title']) && trim((string) $cta_btn2_link['title']) !== '' ? (string) $cta_btn2_link['title'] : 'Contact Admissions';
} else { $cta_btn2_url = '#'; $cta_btn2_target = '_self'; $cta_btn2_text = 'Contact Admissions'; }

$theme_skyline = get_template_directory_uri() . '/assets/img/skyline.webp';
?>

    <!-- Hero Section (matches origin.html: optional hero bg image) -->
    <section class="relative px-4 sm:px-6 lg:px-8 pt-28 sm:pt-28 md:pt-32 pb-12 sm:pb-16 md:pb-20 lg:pt-40 lg:pb-28 overflow-hidden <?php echo $hero_bg_url ? '' : 'bg-gradient-to-br from-primary-dark via-primary to-primary-light'; ?>"<?php if ($hero_bg_url) : ?> style="background-image: linear-gradient(135deg, rgba(61,52,139,0.85) 0%, rgba(118,120,237,0.75) 50%, rgba(247,184,1,0.6) 100%), url('<?php echo esc_url($hero_bg_url); ?>'); background-size: cover; background-position: center;"<?php endif; ?>>
        <?php if (!$hero_bg_url) : ?>
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-64 h-64 rounded-full bg-accent blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 rounded-full bg-accent-light blur-3xl"></div>
        </div>
        <?php endif; ?>
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-4 sm:mb-6">
                    <i data-lucide="<?php echo esc_attr($hero_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 text-accent"></i>
                    <span class="text-xs sm:text-sm font-semibold text-white uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 sm:mb-6 tracking-tight">
                    <?php echo esc_html($hero_before); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent to-accent-light"><?php echo esc_html($hero_highlight); ?></span>
                </h1>
                <p class="text-sm sm:text-base md:text-lg text-slate-200 mb-6 sm:mb-8 max-w-3xl mx-auto">
                    <?php echo esc_html($hero_subtext); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Campus Description Section -->
    <section class="px-4 sm:px-6 lg:px-8 py-10 sm:py-12 md:py-16 bg-background-light">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 sm:gap-10 md:gap-12">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl p-4 sm:p-6 md:p-8 shadow-soft border border-gray-100">
                        <div class="flex items-center gap-2 sm:gap-3 mb-6 sm:mb-8">
                            <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                                <i data-lucide="<?php echo esc_attr($overview_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 text-primary"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900"><?php echo esc_html($overview_heading); ?></h2>
                                <p class="text-sm sm:text-base md:text-lg text-gray-600"><?php echo esc_html($overview_location); ?></p>
                            </div>
                        </div>
                        <div class="space-y-4 sm:space-y-5 md:space-y-6">
                            <?php foreach ($overview_items as $ov) :
                                $ov_icon = isset($ov['icon']) ? trim((string) $ov['icon']) : 'map';
                                $ov_style = isset($ov['style']) ? $ov['style'] : 'primary';
                                $ov_title = isset($ov['title']) ? (string) $ov['title'] : '';
                                $ov_para = isset($ov['paragraph']) ? (string) $ov['paragraph'] : '';
                                $ov_bg = $ov_style === 'accent' ? 'bg-accent/10' : ($ov_style === 'primary-light' ? 'bg-primary-light/10' : ($ov_style === 'accent-dark' ? 'bg-accent-dark/10' : 'bg-primary/10'));
                                $ov_text = $ov_style === 'accent' ? 'text-accent' : ($ov_style === 'primary-light' ? 'text-primary-light' : ($ov_style === 'accent-dark' ? 'text-accent-dark' : 'text-primary'));
                                $ov_hover = $ov_style === 'accent' ? 'group-hover:bg-accent' : ($ov_style === 'primary-light' ? 'group-hover:bg-primary-light' : ($ov_style === 'accent-dark' ? 'group-hover:bg-accent-dark' : 'group-hover:bg-primary'));
                            ?>
                            <div class="flex items-start gap-3 sm:gap-4 group">
                                <div class="size-8 sm:size-9 md:size-10 shrink-0 rounded-full <?php echo esc_attr($ov_bg); ?> flex items-center justify-center <?php echo esc_attr($ov_hover); ?> group-hover:text-white transition-colors mt-1">
                                    <i data-lucide="<?php echo esc_attr($ov_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 <?php echo esc_attr($ov_text); ?> group-hover:text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-gray-900 mb-1 sm:mb-2"><?php echo esc_html($ov_title); ?></h3>
                                    <p class="text-sm sm:text-base text-gray-600 leading-relaxed"><?php echo esc_html($ov_para); ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="space-y-6 sm:space-y-8">
                    <?php if ($overview_img_url) : ?>
                    <div class="rounded-2xl overflow-hidden shadow-soft border border-gray-100 bg-gray-100">
                        <img src="<?php echo esc_url($overview_img_url); ?>" alt="<?php echo esc_attr($overview_img_alt); ?>" class="w-full h-auto object-cover aspect-[4/3] sm:aspect-video">
                    </div>
                    <?php endif; ?>
                    <div class="bg-white rounded-2xl p-4 sm:p-5 md:p-6 shadow-soft border border-gray-100 overflow-hidden">
                        <div class="mb-3 sm:mb-4 flex items-center justify-between">
                            <h3 class="text-base sm:text-lg md:text-xl font-bold text-gray-900"><?php echo esc_html($video1_title); ?></h3>
                            <i data-lucide="<?php echo esc_attr($video1_icon); ?>" class="w-5 h-5 sm:w-6 sm:h-6 text-primary"></i>
                        </div>
                        <div class="relative rounded-xl overflow-hidden bg-black aspect-video">
                            <?php if ($video1_thumb) : ?>
                            <div class="absolute inset-0 bg-cover bg-center" style="background-image:url('<?php echo esc_url($video1_thumb); ?>');"></div>
                            <div class="absolute inset-0 bg-black/30 flex items-center justify-center"></div>
                            <?php else : ?>
                            <div class="absolute inset-0 bg-gradient-to-br from-gray-900 to-gray-800"></div>
                            <?php endif; ?>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <?php if (!empty($video1_url)) : ?>
                                <a href="<?php echo esc_url($video1_url); ?>" data-fancybox="origin-video" data-caption="<?php echo esc_attr($video1_title); ?>" class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 rounded-full bg-white/20 backdrop-blur-sm border-2 border-white/30 flex items-center justify-center hover:bg-white/30 transition-all group">
                                    <i data-lucide="play" class="w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 text-white group-hover:scale-110 transition-transform"></i>
                                </a>
                                <?php else : ?>
                                <div class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 rounded-full bg-white/20 backdrop-blur-sm border-2 border-white/30 flex items-center justify-center">
                                    <i data-lucide="play" class="w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 text-white"></i>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="absolute bottom-2 left-2 right-2 sm:bottom-4 sm:left-4 sm:right-4 flex items-center justify-between text-white text-xs sm:text-sm drop-shadow-md">
                                <span><?php echo esc_html($video1_label); ?></span>
                                <span><?php echo esc_html($video1_duration); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl p-4 sm:p-5 md:p-6 shadow-soft border border-gray-100 overflow-hidden">
                        <div class="mb-3 sm:mb-4 flex items-center justify-between">
                            <h3 class="text-base sm:text-lg md:text-xl font-bold text-gray-900"><?php echo esc_html($video2_title); ?></h3>
                            <i data-lucide="<?php echo esc_attr($video2_icon); ?>" class="w-5 h-5 sm:w-6 sm:h-6 text-primary"></i>
                        </div>
                        <div class="relative rounded-xl overflow-hidden bg-black aspect-video">
                            <?php if ($video2_thumb) : ?>
                            <div class="absolute inset-0 bg-cover bg-center" style="background-image:url('<?php echo esc_url($video2_thumb); ?>');"></div>
                            <div class="absolute inset-0 bg-black/30 flex items-center justify-center"></div>
                            <?php else : ?>
                            <div class="absolute inset-0 bg-gradient-to-br from-primary-dark to-primary"></div>
                            <?php endif; ?>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <?php if (!empty($video2_url)) : ?>
                                <a href="<?php echo esc_url($video2_url); ?>" data-fancybox="origin-video" data-caption="<?php echo esc_attr($video2_title); ?>" class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 rounded-full bg-white/20 backdrop-blur-sm border-2 border-white/30 flex items-center justify-center hover:bg-white/30 transition-all group">
                                    <i data-lucide="play" class="w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 text-white group-hover:scale-110 transition-transform"></i>
                                </a>
                                <?php else : ?>
                                <div class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 rounded-full bg-white/20 backdrop-blur-sm border-2 border-white/30 flex items-center justify-center">
                                    <i data-lucide="play" class="w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 text-white"></i>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="absolute bottom-2 left-2 right-2 sm:bottom-4 sm:left-4 sm:right-4 flex items-center justify-between text-white text-xs sm:text-sm drop-shadow-md">
                                <span><?php echo esc_html($video2_label); ?></span>
                                <span><?php echo esc_html($video2_duration); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Campus Gallery Section -->
    <section class="px-4 sm:px-6 lg:px-8 py-10 sm:py-12 md:py-16 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-8 sm:mb-10 md:mb-12">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-primary/10 border border-primary/20 mb-3 sm:mb-4">
                    <i data-lucide="<?php echo esc_attr($gal_icon); ?>" class="w-3 h-3 sm:w-4 sm:h-4 text-primary"></i>
                    <span class="text-xs sm:text-sm font-semibold text-primary uppercase tracking-wider"><?php echo esc_html($gal_badge); ?></span>
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-3 sm:mb-4">
                    <?php echo esc_html($gal_before); ?> <span class="text-primary"><?php echo esc_html($gal_highlight); ?></span>
                </h2>
                <p class="text-sm sm:text-base text-gray-600 max-w-2xl mx-auto">
                    <?php echo esc_html($gal_subtext); ?>
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($gal_items as $g) :
                    $g_img = isset($g['image']) ? $g['image'] : null;
                    $g_url = mlzs_origin_img_url($g_img);
                    if ($g_url === '') $g_url = $theme_skyline;
                    $g_alt = (is_array($g_img) && isset($g_img['alt']) && trim((string) $g_img['alt']) !== '') ? trim($g_img['alt']) : (isset($g['label']) ? (string) $g['label'] : 'Campus');
                    $g_label = isset($g['label']) ? (string) $g['label'] : '';
                    $g_caption = isset($g['caption']) ? (string) $g['caption'] : '';
                ?>
                <div class="group relative overflow-hidden rounded-2xl bg-white shadow-soft border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="aspect-[4/3] overflow-hidden bg-gray-100">
                        <img src="<?php echo esc_url($g_url); ?>" alt="<?php echo esc_attr($g_alt); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    </div>
                    <div class="p-3 sm:p-4">
                        <div class="flex items-center justify-between mb-1 sm:mb-2">
                            <span class="text-xs font-bold text-primary uppercase tracking-wider"><?php echo esc_html($g_label); ?></span>
                            <i data-lucide="maximize" class="w-3 h-3 sm:w-4 sm:h-4 text-gray-400 group-hover:text-primary transition-colors"></i>
                        </div>
                        <p class="text-xs sm:text-sm text-gray-600"><?php echo esc_html($g_caption); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- More Images Grid (matches origin.html 470–497) -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 mt-8">
                <?php
                $more_list = !empty($gal_more_images) ? $gal_more_images : array_fill(0, 8, array());
                foreach ($more_list as $idx => $more_img) :
                    $more_url = !empty($more_img) ? mlzs_origin_img_url($more_img) : '';
                    if ($more_url === '') $more_url = $theme_skyline;
                    $more_alt = (is_array($more_img) && !empty($more_img['alt']) && is_string($more_img['alt'])) ? trim($more_img['alt']) : 'Campus View ' . ((int) $idx + 1);
                ?>
                <div class="group aspect-square overflow-hidden rounded-xl bg-gray-100 hover:shadow-lg transition-all duration-300">
                    <img src="<?php echo esc_url($more_url); ?>" alt="<?php echo esc_attr($more_alt); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                <?php endforeach; ?>
            </div>

            <div class="text-center mt-8 sm:mt-10 md:mt-12">
                <a href="<?php echo $gal_btn_url; ?>" target="<?php echo esc_attr($gal_btn_target); ?>" class="inline-flex items-center gap-2 px-4 py-2 sm:px-6 sm:py-3 md:px-8 md:py-3 bg-white border-2 border-primary text-primary text-sm sm:text-base font-bold rounded-full hover:bg-primary hover:text-white transition-all group">
                    <span><?php echo esc_html($gal_btn_text); ?></span>
                    <i data-lucide="arrow-right" class="w-4 h-4 sm:w-5 sm:h-5 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Campus Features Section -->
    <section class="px-4 sm:px-6 lg:px-8 py-10 sm:py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-8 sm:mb-10 md:mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-3 sm:mb-4">
                    <?php echo esc_html($feat_before); ?> <span class="text-primary"><?php echo esc_html($feat_highlight); ?></span>
                </h2>
                <p class="text-sm sm:text-base text-gray-600 max-w-2xl mx-auto">
                    <?php echo esc_html($feat_subtext); ?>
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 md:gap-6">
                <?php foreach ($feat_items as $f) :
                    $f_icon = isset($f['icon']) ? trim((string) $f['icon']) : 'trees';
                    $f_style = isset($f['style']) ? $f['style'] : 'primary';
                    $f_title = isset($f['title']) ? (string) $f['title'] : '';
                    $f_para = isset($f['paragraph']) ? (string) $f['paragraph'] : '';
                    $f_from = $f_style === 'accent' ? 'from-accent/5 to-accent/10' : ($f_style === 'primary-light' ? 'from-primary-light/5 to-primary-light/10' : ($f_style === 'accent-dark' ? 'from-accent-dark/5 to-accent-dark/10' : 'from-primary/5 to-primary/10'));
                    $f_border = $f_style === 'accent' ? 'border-accent/20 hover:border-accent/40' : ($f_style === 'primary-light' ? 'border-primary-light/20 hover:border-primary-light/40' : ($f_style === 'accent-dark' ? 'border-accent-dark/20 hover:border-accent-dark/40' : 'border-primary/20 hover:border-primary/40'));
                    $f_icon_bg = $f_style === 'accent' ? 'bg-accent/20' : ($f_style === 'primary-light' ? 'bg-primary-light/20' : ($f_style === 'accent-dark' ? 'bg-accent-dark/20' : 'bg-primary/20'));
                    $f_icon_text = $f_style === 'accent' ? 'text-accent' : ($f_style === 'primary-light' ? 'text-primary-light' : ($f_style === 'accent-dark' ? 'text-accent-dark' : 'text-primary'));
                    $f_hover = $f_style === 'accent' ? 'group-hover:bg-accent' : ($f_style === 'primary-light' ? 'group-hover:bg-primary-light' : ($f_style === 'accent-dark' ? 'group-hover:bg-accent-dark' : 'group-hover:bg-primary'));
                ?>
                <div class="bg-gradient-to-br <?php echo esc_attr($f_from); ?> rounded-2xl p-4 sm:p-5 md:p-6 border <?php echo esc_attr($f_border); ?> transition-all group">
                    <div class="w-10 h-10 sm:w-11 sm:h-11 md:w-12 md:h-12 rounded-xl <?php echo esc_attr($f_icon_bg); ?> flex items-center justify-center mb-3 sm:mb-4 <?php echo esc_attr($f_hover); ?> group-hover:text-white transition-colors">
                        <i data-lucide="<?php echo esc_attr($f_icon); ?>" class="w-5 h-5 sm:w-6 sm:h-6 <?php echo esc_attr($f_icon_text); ?> group-hover:text-white"></i>
                    </div>
                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-gray-900 mb-1 sm:mb-2"><?php echo esc_html($f_title); ?></h3>
                    <p class="text-xs sm:text-sm text-gray-600"><?php echo esc_html($f_para); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Visit Campus CTA -->
    <section class="px-4 sm:px-6 lg:px-8 py-10 sm:py-12 md:py-16 bg-gradient-to-r from-primary-dark to-primary text-white [&_+_footer]:rounded-t-[0px]">
        <div class="max-w-7xl mx-auto">
            <div class="text-center text-white">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4 sm:mb-6"><?php echo esc_html($cta_heading); ?></h2>
                <p class="text-sm sm:text-base md:text-lg text-slate-200 mb-6 sm:mb-8 max-w-2xl mx-auto">
                    <?php echo esc_html($cta_para); ?>
                </p>
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center">
                    <a href="<?php echo $cta_btn1_url; ?>" target="<?php echo esc_attr($cta_btn1_target); ?>" class="px-5 py-2.5 sm:px-6 sm:py-3 md:px-8 md:py-3 bg-white text-primary text-sm sm:text-base font-bold rounded-full hover:bg-slate-100 transition-all flex items-center justify-center gap-2 group">
                        <i data-lucide="<?php echo esc_attr($cta_btn1_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        <?php echo esc_html($cta_btn1_text); ?>
                    </a>
                    <a href="<?php echo $cta_btn2_url; ?>" target="<?php echo esc_attr($cta_btn2_target); ?>" class="px-5 py-2.5 sm:px-6 sm:py-3 md:px-8 md:py-3 bg-transparent border-2 border-white text-white text-sm sm:text-base font-bold rounded-full hover:bg-white/10 transition-all flex items-center justify-center gap-2 group">
                        <i data-lucide="<?php echo esc_attr($cta_btn2_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        <?php echo esc_html($cta_btn2_text); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
