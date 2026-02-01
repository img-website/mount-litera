<?php
/**
 * Template Name: Testimonials Page
 * Parent Testimonials: Hero, Video grid (6+), More stories + info panel, Stats & CTA. UI matches testimonial.html exactly.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge = $opt ? get_field('testimonial_hero_badge', $page_id) : null;
$hero_icon = $opt ? get_field('testimonial_hero_icon', $page_id) : null;
$hero_before = $opt ? get_field('testimonial_hero_headline_before', $page_id) : null;
$hero_highlight = $opt ? get_field('testimonial_hero_headline_highlight', $page_id) : null;
$hero_subtext = $opt ? get_field('testimonial_hero_subtext', $page_id) : null;

$hero_badge = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Parent Feedback';
$hero_icon = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'message-circle-heart';
$hero_before = ($hero_before !== '' && $hero_before !== null) ? (string) $hero_before : 'Parent';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Testimonials';
$hero_subtext = ($hero_subtext !== '' && $hero_subtext !== null) ? (string) $hero_subtext : 'Hear what our parents have to say about their experience with Mount Litera Zee School';

// ——— Video section ———
$video_heading = $opt ? get_field('testimonial_video_heading', $page_id) : null;
$video_heading_highlight = $opt ? get_field('testimonial_video_heading_highlight', $page_id) : null;
$video_subtext = $opt ? get_field('testimonial_video_subtext', $page_id) : null;
$video_items = $opt ? get_field('testimonial_video_items', $page_id) : null;

$video_heading = ($video_heading !== '' && $video_heading !== null) ? (string) $video_heading : 'Video';
$video_heading_highlight = ($video_heading_highlight !== '' && $video_heading_highlight !== null) ? (string) $video_heading_highlight : 'Testimonials';
$video_subtext = ($video_subtext !== '' && $video_subtext !== null) ? (string) $video_subtext : 'Watch parents share their experiences and stories about their children\'s journey at our school';

/**
 * Get thumbnail URL from YouTube or Vimeo video URL. No upload needed.
 */
function mlzs_get_video_thumbnail_url($url) {
    if (empty($url) || !is_string($url)) return '';
    $url = trim($url);
    // YouTube: watch?v=ID, youtu.be/ID
    if (preg_match('#(?:youtube\.com/watch\?v=|youtu\.be/)([a-zA-Z0-9_-]+)#', $url, $m)) {
        return 'https://img.youtube.com/vi/' . $m[1] . '/hqdefault.jpg';
    }
    // Vimeo: vimeo.com/ID or player.vimeo.com/video/ID
    if (preg_match('#vimeo\.com/(?:video/)?(\d+)#', $url, $m)) {
        return 'https://vumbnail.com/' . $m[1] . '.jpg';
    }
    return '';
}

$default_videos = array(
    array('video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'title' => 'Parent Testimonial 1', 'hover_title' => 'Parent Experience', 'badge_style' => 'primary'),
    array('video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'title' => 'Parent Testimonial 2', 'hover_title' => 'Parent Feedback', 'badge_style' => 'primary-light'),
    array('video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'title' => 'Parent Testimonial 3', 'hover_title' => 'Success Story', 'badge_style' => 'accent'),
);
$video_items = is_array($video_items) && !empty($video_items) ? $video_items : $default_videos;

// ——— More stories block ———
$more_heading = $opt ? get_field('testimonial_more_heading', $page_id) : null;
$more_video = $opt ? get_field('testimonial_more_video', $page_id) : null;
$info_icon = $opt ? get_field('testimonial_info_icon', $page_id) : null;
$info_heading = $opt ? get_field('testimonial_info_heading', $page_id) : null;
$info_paragraph = $opt ? get_field('testimonial_info_paragraph', $page_id) : null;
$info_checklist = $opt ? get_field('testimonial_info_checklist', $page_id) : null;

$more_heading = ($more_heading !== '' && $more_heading !== null) ? (string) $more_heading : 'More Parent Stories';
$more_video = is_array($more_video) && !empty($more_video) ? $more_video : array('video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'title' => 'Parent Testimonial', 'hover_title' => 'Parent Experience');
$info_icon = (is_string($info_icon) && trim($info_icon) !== '') ? trim($info_icon) : 'volume-2';
$info_heading = ($info_heading !== '' && $info_heading !== null) ? (string) $info_heading : 'Real Stories, Real Experiences';
$info_paragraph = ($info_paragraph !== '' && $info_paragraph !== null) ? (string) $info_paragraph : 'Our parents share their genuine experiences and stories about how Mount Litera Zee School has made a positive impact on their children\'s lives.';
$default_checklist = array(
    array('text' => 'Authentic parent feedback'),
    array('text' => 'Real transformation stories'),
    array('text' => 'Insights into school life'),
);
$info_checklist = is_array($info_checklist) && count($info_checklist) >= 3 ? $info_checklist : $default_checklist;

// ——— Stats & CTA ———
$cta_heading = $opt ? get_field('testimonial_cta_heading', $page_id) : null;
$cta_paragraph = $opt ? get_field('testimonial_cta_paragraph', $page_id) : null;
$cta_btn1 = $opt ? get_field('testimonial_cta_btn1', $page_id) : null;
$cta_btn1_icon = $opt ? get_field('testimonial_cta_btn1_icon', $page_id) : null;
$cta_btn2 = $opt ? get_field('testimonial_cta_btn2', $page_id) : null;
$cta_btn2_icon = $opt ? get_field('testimonial_cta_btn2_icon', $page_id) : null;
$cta_stats = $opt ? get_field('testimonial_cta_stats', $page_id) : null;

$cta_heading = ($cta_heading !== '' && $cta_heading !== null) ? (string) $cta_heading : 'Share Your Story';
$cta_paragraph = ($cta_paragraph !== '' && $cta_paragraph !== null) ? (string) $cta_paragraph : 'Are you a parent with a story to share about your child\'s journey at Mount Litera Zee School? We\'d love to hear from you!';
$cta_btn1_icon = (is_string($cta_btn1_icon) && trim($cta_btn1_icon) !== '') ? trim($cta_btn1_icon) : 'message-circle';
$cta_btn2_icon = (is_string($cta_btn2_icon) && trim($cta_btn2_icon) !== '') ? trim($cta_btn2_icon) : 'play-circle';

$cta_btn1_url = $cta_btn1_target = $cta_btn1_text = '#';
if (!empty($cta_btn1) && is_array($cta_btn1)) {
    $cta_btn1_url = isset($cta_btn1['url']) ? esc_url($cta_btn1['url']) : '#';
    $cta_btn1_target = isset($cta_btn1['target']) ? $cta_btn1['target'] : '_self';
    $cta_btn1_text = isset($cta_btn1['title']) && trim((string) $cta_btn1['title']) !== '' ? (string) $cta_btn1['title'] : 'Share Your Testimonial';
} else { $cta_btn1_text = 'Share Your Testimonial'; }

$cta_btn2_url = $cta_btn2_target = $cta_btn2_text = '#';
if (!empty($cta_btn2) && is_array($cta_btn2)) {
    $cta_btn2_url = isset($cta_btn2['url']) ? esc_url($cta_btn2['url']) : '#';
    $cta_btn2_target = isset($cta_btn2['target']) ? $cta_btn2['target'] : '_self';
    $cta_btn2_text = isset($cta_btn2['title']) && trim((string) $cta_btn2['title']) !== '' ? (string) $cta_btn2['title'] : 'Watch All Videos';
} else { $cta_btn2_text = 'Watch All Videos'; }

$default_cta_stats = array(
    array('number' => '7+', 'label' => 'Video Testimonials'),
    array('number' => '100%', 'label' => 'Parent Satisfaction'),
    array('number' => 'Real', 'label' => 'Stories'),
    array('number' => 'Trusted', 'label' => 'Feedback'),
);
$cta_stats = (is_array($cta_stats) && count($cta_stats) >= 4) ? $cta_stats : $default_cta_stats;

$badge_styles = array(
    'primary' => 'bg-primary text-white',
    'primary-light' => 'bg-primary-light text-white',
    'accent' => 'bg-accent text-white',
    'primary-dark' => 'bg-primary-dark text-white',
    'primary-lighter' => 'bg-primary-lighter text-primary-dark',
    'accent-light' => 'bg-accent-light text-white',
);
$gradient_overlays = array(
    'primary' => 'from-primary/40 to-primary-light/40',
    'primary-light' => 'from-primary-light/40 to-accent/40',
    'accent' => 'from-accent/40 to-accent-dark/40',
    'primary-dark' => 'from-primary-dark/40 to-primary/40',
    'primary-lighter' => 'from-primary-lighter/40 to-primary-light/40',
    'accent-light' => 'from-accent-light/40 to-cayenne-red/40',
);
?>

    <!-- Hero Section (UI exactly as testimonial.html) -->
    <section class="relative bg-gradient-to-br from-primary via-primary-dark to-slate-900 px-4 sm:px-6 lg:px-8 pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')]"></div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-accent/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="relative z-10 max-w-7xl mx-auto">
            <div class="text-center text-white">
                <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-white/20 backdrop-blur-md border border-white/30 mb-4 sm:mb-6 animate-fade-in-up">
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

    <!-- Video Testimonials Section -->
    <section class="px-4 sm:px-6 lg:px-8 py-8 sm:py-12 md:py-16">
        <div class="max-w-7xl mx-auto">
            <div class="mb-8 sm:mb-12">
                <div class="text-center mb-8">
<h2 class="text-lg sm:text-xl md:text-2xl font-bold text-text-main-light mb-4">
                                        <?php echo esc_html($video_heading); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-accent"><?php echo esc_html($video_heading_highlight); ?></span>
                                    </h2>
                    <p class="text-sm text-text-secondary-light max-w-2xl mx-auto">
                        <?php echo esc_html($video_subtext); ?>
                    </p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    <?php foreach ($video_items as $idx => $item) :
                        $video_url = isset($item['video_url']) ? (is_string($item['video_url']) ? $item['video_url'] : '') : '';
                        if ($video_url !== '') $video_url = esc_url($video_url);
                        else $video_url = '#';
                        $img_url = mlzs_get_video_thumbnail_url($video_url);
                        if ($img_url === '') $img_url = 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&q=80';
                        $title = isset($item['title']) ? (string) $item['title'] : 'Parent Testimonial';
                        $badge_text = 'Video ' . ($idx + 1);
                        $hover_title = isset($item['hover_title']) ? (string) $item['hover_title'] : 'Click to play video';
                        $style = isset($item['badge_style']) ? $item['badge_style'] : 'primary';
                        $badge_class = isset($badge_styles[$style]) ? $badge_styles[$style] : $badge_styles['primary'];
                        $gradient = isset($gradient_overlays[$style]) ? $gradient_overlays[$style] : $gradient_overlays['primary'];
                    ?>
                    <div class="group relative overflow-hidden rounded-xl sm:rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 cursor-pointer" onclick="mlzsOpenVideoModal('<?php echo esc_js($video_url); ?>', '<?php echo esc_js($title); ?>')">
                        <div class="aspect-video bg-gray-100 overflow-hidden">
                            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($title); ?>" class="w-full h-full object-cover" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-br <?php echo esc_attr($gradient); ?> flex items-center justify-center">
                                <div class="text-center p-4">
                                    <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-white/30 backdrop-blur-sm flex items-center justify-center mx-auto mb-3 sm:mb-4 group-hover:scale-110 transition-transform">
                                        <i data-lucide="play" class="w-6 h-6 sm:w-8 sm:h-8 text-white ml-1"></i>
                                    </div>
                                    <p class="text-xs sm:text-sm text-white font-medium"><?php echo esc_html($title); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3 sm:p-4">
                            <div class="text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <p class="font-bold text-xs sm:text-sm mb-1"><?php echo esc_html($hover_title); ?></p>
                                <p class="text-xs opacity-90">Click to play video</p>
                            </div>
                        </div>
                        <div class="absolute top-3 left-3 sm:top-4 sm:left-4">
                            <span class="px-2 py-1 rounded-full <?php echo esc_attr($badge_class); ?> text-xs font-bold"><?php echo esc_html($badge_text); ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- More Parent Stories -->
            <div class="mb-8 sm:mb-12">
                <div class="bg-gradient-to-r from-primary/5 to-accent/5 rounded-xl sm:rounded-2xl p-6 border border-primary/20">
                    <h3 class="text-base sm:text-lg font-bold text-text-main-light mb-6 text-center">
                        <?php echo esc_html($more_heading); ?>
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php
                        $mv_url = isset($more_video['video_url']) && is_string($more_video['video_url']) ? esc_url($more_video['video_url']) : '#';
                        $mv_img = mlzs_get_video_thumbnail_url($mv_url);
                        if ($mv_img === '') $mv_img = 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800&q=80';
                        $mv_title = isset($more_video['title']) ? (string) $more_video['title'] : 'Parent Testimonial';
                        $mv_hover = isset($more_video['hover_title']) ? (string) $more_video['hover_title'] : 'Watch video testimonial';
                        ?>
                        <div class="group relative overflow-hidden rounded-xl shadow-soft hover:shadow-lg transition-all duration-300 cursor-pointer" onclick="mlzsOpenVideoModal('<?php echo esc_js($mv_url); ?>', '<?php echo esc_js($mv_title); ?>')">
                            <div class="aspect-video bg-gray-100 overflow-hidden">
                                <img src="<?php echo esc_url($mv_img); ?>" alt="<?php echo esc_attr($mv_title); ?>" class="w-full h-full object-cover" loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-br from-tiger-orange/40 to-cayenne-red/40 flex items-center justify-center">
                                    <div class="text-center p-4">
                                        <div class="w-12 h-12 rounded-full bg-white/30 backdrop-blur-sm flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                                            <i data-lucide="play" class="w-6 h-6 text-white ml-1"></i>
                                        </div>
                                        <p class="text-xs sm:text-sm text-white font-medium"><?php echo esc_html($mv_title); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3">
                                <div class="text-white transform translate-y-3 group-hover:translate-y-0 transition-transform duration-300">
                                    <p class="font-bold text-xs mb-1"><?php echo esc_html($mv_hover); ?></p>
                                    <p class="text-xs opacity-90">Watch video testimonial</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl p-6 shadow-soft border border-border-light">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                                    <i data-lucide="<?php echo esc_attr($info_icon); ?>" class="w-5 h-5 text-primary"></i>
                                </div>
                                <h4 class="text-base sm:text-lg font-bold text-text-main-light"><?php echo esc_html($info_heading); ?></h4>
                            </div>
                            <p class="text-sm text-text-secondary-light mb-4">
                                <?php echo esc_html($info_paragraph); ?>
                            </p>
                            <div class="space-y-3">
                                <?php foreach ($info_checklist as $check) :
                                    $check_text = isset($check['text']) ? (string) $check['text'] : '';
                                    if ($check_text === '') continue;
                                ?>
                                <div class="flex items-center gap-2">
                                    <i data-lucide="check" class="w-4 h-4 text-green-500 shrink-0"></i>
                                    <span class="text-sm text-text-secondary-light"><?php echo esc_html($check_text); ?></span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats & CTA -->
            <div class="bg-gradient-to-r from-primary to-primary-light rounded-xl sm:rounded-2xl p-6 sm:p-8 text-white">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-center">
                    <div>
                        <h2 class="text-lg sm:text-xl font-bold mb-4"><?php echo esc_html($cta_heading); ?></h2>
                        <p class="text-sm text-white/80 mb-6">
                            <?php echo esc_html($cta_paragraph); ?>
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="<?php echo $cta_btn1_url; ?>" target="<?php echo esc_attr($cta_btn1_target); ?>" class="px-4 py-2 sm:px-6 sm:py-3 bg-white text-primary rounded-full font-bold hover:bg-white/90 transition-all flex items-center justify-center gap-2 group text-sm">
                                <i data-lucide="<?php echo esc_attr($cta_btn1_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                                <?php echo esc_html($cta_btn1_text); ?>
                            </a>
                            <a href="<?php echo $cta_btn2_url; ?>" target="<?php echo esc_attr($cta_btn2_target); ?>" class="px-4 py-2 sm:px-6 sm:py-3 bg-white/20 border border-white/30 text-white rounded-full font-bold hover:bg-white/30 transition-all flex items-center justify-center gap-2 group text-sm">
                                <i data-lucide="<?php echo esc_attr($cta_btn2_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                                <?php echo esc_html($cta_btn2_text); ?>
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <?php foreach ($cta_stats as $stat) :
                            $num = isset($stat['number']) ? (string) $stat['number'] : '';
                            $lab = isset($stat['label']) ? (string) $stat['label'] : '';
                        ?>
                        <div class="bg-white/10 rounded-xl p-4 text-center border border-white/20">
                            <div class="text-base sm:text-lg font-bold mb-2"><?php echo esc_html($num); ?></div>
                            <div class="text-xs font-medium text-white/80"><?php echo esc_html($lab); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Modal: YouTube/Vimeo = iframe, direct URL = video tag -->
    <div id="mlzs-video-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90 backdrop-blur-sm">
        <div class="relative w-full max-w-5xl mx-4">
            <button type="button" onclick="mlzsCloseVideoModal()" class="absolute -top-12 right-0 text-white hover:text-accent transition-colors flex items-center gap-2">
                <span class="text-sm font-medium">Close</span>
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
            <div class="relative w-full aspect-video bg-black rounded-lg overflow-hidden">
                <iframe id="mlzs-modal-iframe" class="w-full h-full hidden" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <video id="mlzs-modal-video" class="w-full h-full hidden" controls autoplay>
                    Your browser does not support the video tag.
                </video>
            </div>
            <h3 id="mlzs-video-title" class="text-white text-lg font-bold mt-4 text-center"></h3>
        </div>
    </div>

    <script>
    (function() {
        function embedUrl(url) {
            if (!url) return null;
            var m = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/);
            if (m) return 'https://www.youtube.com/embed/' + m[1] + '?autoplay=1';
            m = url.match(/vimeo\.com\/(?:video\/)?(\d+)/);
            if (m) return 'https://player.vimeo.com/video/' + m[1] + '?autoplay=1';
            return null;
        }
        function openModal(url, title) {
            var modal = document.getElementById('mlzs-video-modal');
            var iframe = document.getElementById('mlzs-modal-iframe');
            var video = document.getElementById('mlzs-modal-video');
            var titleEl = document.getElementById('mlzs-video-title');
            if (!modal || !titleEl) return;
            titleEl.textContent = title || '';
            var emb = embedUrl(url);
            if (emb && iframe) {
                iframe.src = emb;
                iframe.classList.remove('hidden');
                if (video) { video.classList.add('hidden'); video.pause(); video.removeAttribute('src'); }
            } else if (video) {
                video.src = url || '';
                video.classList.remove('hidden');
                if (iframe) { iframe.classList.add('hidden'); iframe.removeAttribute('src'); }
            }
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
            if (typeof lucide !== 'undefined' && lucide.createIcons) lucide.createIcons();
        }
        function closeModal() {
            var modal = document.getElementById('mlzs-video-modal');
            var iframe = document.getElementById('mlzs-modal-iframe');
            var video = document.getElementById('mlzs-modal-video');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
            if (iframe) { iframe.removeAttribute('src'); iframe.classList.add('hidden'); }
            if (video) { video.pause(); video.removeAttribute('src'); video.classList.add('hidden'); }
            document.body.style.overflow = '';
        }
        window.mlzsOpenVideoModal = openModal;
        window.mlzsCloseVideoModal = closeModal;
        document.getElementById('mlzs-video-modal') && document.getElementById('mlzs-video-modal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });
    })();
    </script>

<?php get_footer(); ?>
