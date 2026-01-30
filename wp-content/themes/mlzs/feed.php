<?php
/**
 * Template Name: Alumni Feed Page
 * Alumni Feed: Hero, Alumni gallery, Suggestions form, Stats – ACF dynamic
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
$hero_badge     = $opt ? get_field('feed_hero_badge', $page_id) : null;
$hero_icon      = $opt ? get_field('feed_hero_icon', $page_id) : null;
$hero_headline  = $opt ? get_field('feed_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('feed_hero_highlight', $page_id) : null;
$hero_sub       = $opt ? get_field('feed_hero_subheadline', $page_id) : null;

$hero_badge     = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Alumni Network';
$hero_icon      = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'users';
$hero_headline  = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'Alumni';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Feed';
$hero_sub       = ($hero_sub !== '' && $hero_sub !== null) ? (string) $hero_sub : 'Celebrating the achievements of our alumni who continue to inspire and make us proud across the globe';
$hero_badge_icon_color = $opt ? get_field('feed_hero_badge_icon_color', $page_id) : null;
$hero_highlight_color = $opt ? get_field('feed_hero_highlight_color', $page_id) : null;
$hero_subheadline_color = $opt ? get_field('feed_hero_subheadline_color', $page_id) : null;
$hero_badge_icon_color = (is_string($hero_badge_icon_color) && trim($hero_badge_icon_color) !== '') ? trim($hero_badge_icon_color) : 'text-accent';
$hero_highlight_color = (is_string($hero_highlight_color) && trim($hero_highlight_color) !== '') ? trim($hero_highlight_color) : 'text-transparent bg-clip-text bg-gradient-to-r from-amber-flame to-tiger-orange';
$hero_subheadline_color = (is_string($hero_subheadline_color) && trim($hero_subheadline_color) !== '') ? trim($hero_subheadline_color) : 'text-slate-200';

// ——— Alumni Section ———
$section_badge = $opt ? get_field('feed_section_badge', $page_id) : null;
$section_icon  = $opt ? get_field('feed_section_icon', $page_id) : null;
$section_heading = $opt ? get_field('feed_section_heading', $page_id) : null;
$section_highlight = $opt ? get_field('feed_section_highlight', $page_id) : null;
$section_description = $opt ? get_field('feed_section_description', $page_id) : null;
$feed_gallery   = $opt ? get_field('feed_gallery', $page_id) : null;

$section_badge = ($section_badge !== '' && $section_badge !== null) ? (string) $section_badge : 'Our Alumni Network';
$section_icon  = (is_string($section_icon) && trim($section_icon) !== '') ? trim($section_icon) : 'users';
$section_heading = ($section_heading !== '' && $section_heading !== null) ? (string) $section_heading : 'Mount Litera';
$section_highlight = ($section_highlight !== '' && $section_highlight !== null) ? (string) $section_highlight : 'Alumni';
$section_description = ($section_description !== '' && $section_description !== null) ? (string) $section_description : 'Celebrating the achievements of our alumni who continue to inspire and make us proud across the globe.';
$section_badge_color = $opt ? get_field('feed_section_badge_color', $page_id) : null;
$section_heading_color = $opt ? get_field('feed_section_heading_color', $page_id) : null;
$section_highlight_color = $opt ? get_field('feed_section_highlight_color', $page_id) : null;
$section_description_color = $opt ? get_field('feed_section_description_color', $page_id) : null;
$section_badge_color = (is_string($section_badge_color) && trim($section_badge_color) !== '') ? trim($section_badge_color) : 'text-primary';
$section_heading_color = (is_string($section_heading_color) && trim($section_heading_color) !== '') ? trim($section_heading_color) : 'text-text-main-light';
$section_highlight_color = (is_string($section_highlight_color) && trim($section_highlight_color) !== '') ? trim($section_highlight_color) : 'text-transparent bg-clip-text bg-gradient-to-r from-primary to-primary-light';
$section_description_color = (is_string($section_description_color) && trim($section_description_color) !== '') ? trim($section_description_color) : 'text-text-secondary-light';
$default_gallery = array(
    array('image' => array('url' => 'https://www.mlzsalwar.ac.in/img/alumni_2024-25.webp'), 'alt' => 'Alumni 2024-25', 'caption_title' => 'Alumni 2024-25', 'caption_subtitle' => 'Latest batch achievements', 'show_new_badge' => 1, 'span_two' => 0),
    array('image' => array('url' => 'https://www.mlzsalwar.ac.in/img/alumni_2023-24.webp'), 'alt' => 'Alumni 2023-24', 'caption_title' => 'Alumni 2023-24', 'caption_subtitle' => 'Previous batch success stories', 'show_new_badge' => 0, 'span_two' => 0),
    array('image' => array('url' => 'https://www.mlzsalwar.ac.in/img/Alumni-1.jpg'), 'alt' => 'Alumni Achievements', 'caption_title' => 'Alumni Achievements', 'caption_subtitle' => 'Notable accomplishments', 'show_new_badge' => 0, 'span_two' => 0),
    array('image' => array('url' => 'https://www.mlzsalwar.ac.in/img/Alumni-2.jpg'), 'alt' => 'Alumni Network', 'caption_title' => 'Alumni Network', 'caption_subtitle' => 'Global connections', 'show_new_badge' => 0, 'span_two' => 0),
    array('image' => array('url' => 'https://www.mlzsalwar.ac.in/img/Alumni-3.jpg'), 'alt' => 'Alumni Events', 'caption_title' => 'Alumni Events', 'caption_subtitle' => 'Annual reunions and gatherings', 'show_new_badge' => 0, 'span_two' => 1),
);
$feed_gallery = (is_array($feed_gallery) && !empty($feed_gallery)) ? $feed_gallery : $default_gallery;

// ——— Suggestions Form ———
$form_badge   = $opt ? get_field('feed_form_badge', $page_id) : null;
$form_icon    = $opt ? get_field('feed_form_icon', $page_id) : null;
$form_title   = $opt ? get_field('feed_form_title', $page_id) : null;
$form_subtitle = $opt ? get_field('feed_form_subtitle', $page_id) : null;
$form_action  = $opt ? get_field('feed_form_action', $page_id) : null;
$form_privacy = $opt ? get_field('feed_form_privacy', $page_id) : null;
$form_submit_text = $opt ? get_field('feed_form_submit_text', $page_id) : null;
$form_submit_icon = $opt ? get_field('feed_form_submit_icon', $page_id) : null;

$form_badge   = ($form_badge !== '' && $form_badge !== null) ? (string) $form_badge : 'Share Your Voice';
$form_icon    = (is_string($form_icon) && trim($form_icon) !== '') ? trim($form_icon) : 'message-square';
$form_title   = ($form_title !== '' && $form_title !== null) ? (string) $form_title : 'Suggestions & Feedback';
$form_subtitle = ($form_subtitle !== '' && $form_subtitle !== null) ? (string) $form_subtitle : 'Your suggestions help us improve. Share your thoughts with us.';
$form_action  = ($form_action !== '' && $form_action !== null) ? esc_url($form_action) : $home_url . '#';
$form_privacy = ($form_privacy !== '' && $form_privacy !== null) ? (string) $form_privacy : 'Your suggestions are confidential and will be used to improve our services.';
$form_submit_text = ($form_submit_text !== '' && $form_submit_text !== null) ? (string) $form_submit_text : 'Send Suggestion';
$form_submit_icon = (is_string($form_submit_icon) && trim($form_submit_icon) !== '') ? trim($form_submit_icon) : 'send';
$form_badge_color = $opt ? get_field('feed_form_badge_color', $page_id) : null;
$form_title_color = $opt ? get_field('feed_form_title_color', $page_id) : null;
$form_subtitle_color = $opt ? get_field('feed_form_subtitle_color', $page_id) : null;
$form_privacy_color = $opt ? get_field('feed_form_privacy_color', $page_id) : null;
$form_badge_color = (is_string($form_badge_color) && trim($form_badge_color) !== '') ? trim($form_badge_color) : 'text-accent';
$form_title_color = (is_string($form_title_color) && trim($form_title_color) !== '') ? trim($form_title_color) : 'text-white';
$form_subtitle_color = (is_string($form_subtitle_color) && trim($form_subtitle_color) !== '') ? trim($form_subtitle_color) : 'text-slate-300';
$form_privacy_color = (is_string($form_privacy_color) && trim($form_privacy_color) !== '') ? trim($form_privacy_color) : 'text-slate-400';

// ——— Alumni Stats ———
$feed_stats = $opt ? get_field('feed_stats', $page_id) : null;
$default_stats = array(
    array('number' => '1000+', 'label' => 'Alumni Network'),
    array('number' => '50+', 'label' => 'Countries'),
    array('number' => '95%', 'label' => 'Satisfaction'),
    array('number' => 'Annual', 'label' => 'Reunions'),
);
$feed_stats = (is_array($feed_stats) && !empty($feed_stats)) ? $feed_stats : $default_stats;

// Helper: image URL from ACF gallery item (image array or ID or URL string)
if (!function_exists('mlzs_feed_img_url')) {
    function mlzs_feed_img_url($item) {
        if (empty($item) || !isset($item['image'])) return '';
        $img = $item['image'];
        if (is_array($img) && !empty($img['url'])) return $img['url'];
        if (is_numeric($img)) return wp_get_attachment_image_url((int) $img, 'full') ?: '';
        if (is_string($img)) return $img;
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
                <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-white/20 backdrop-blur-md border border-white/30 mb-4 sm:mb-6 animate-fade-in-up">
                    <i data-lucide="<?php echo esc_attr($hero_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 <?php echo esc_attr($hero_badge_icon_color); ?>"></i>
                    <span class="text-xs sm:text-sm font-semibold uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold mb-4 sm:mb-6 tracking-tight">
                    <?php echo esc_html($hero_headline); ?> <span class="<?php echo esc_attr($hero_highlight_color); ?>"><?php echo esc_html($hero_highlight); ?></span>
                </h1>
                <p class="text-sm sm:text-base md:text-lg lg:text-xl <?php echo esc_attr($hero_subheadline_color); ?> max-w-3xl mx-auto leading-relaxed">
                    <?php echo esc_html($hero_sub); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Alumni Section -->
    <section class="relative px-4 sm:px-6 lg:px-8 py-12 sm:py-16 md:py-20 bg-background-light overflow-x-hidden">
        <div class="absolute top-0 left-0 -z-10 h-full w-full overflow-hidden">
            <div class="absolute -top-40 -right-40 h-[500px] w-[500px] rounded-full bg-indigo-velvet/5 blur-[100px]"></div>
            <div class="absolute top-1/2 -left-20 h-[300px] w-[300px] rounded-full bg-amber-flame/10 blur-[80px]"></div>
        </div>
        <div class="mx-auto max-w-7xl w-full">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
                <!-- Alumni Gallery - Left Side -->
                <div class="lg:col-span-2">
                    <div class="mb-8 md:mb-12">
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 border border-primary/30 <?php echo esc_attr($section_badge_color); ?> text-xs font-bold uppercase tracking-wider mb-3">
                            <i data-lucide="<?php echo esc_attr($section_icon); ?>" class="w-4 h-4"></i>
                            <?php echo esc_html($section_badge); ?>
                        </span>
                        <h2 class="text-lg sm:text-xl md:text-2xl font-bold <?php echo esc_attr($section_heading_color); ?> mb-4">
                            <?php echo esc_html($section_heading); ?> <span class="<?php echo esc_attr($section_highlight_color); ?>"><?php echo esc_html($section_highlight); ?></span>
                        </h2>
                        <div class="w-20 h-1 bg-gradient-to-r from-primary to-accent rounded-full mb-4 sm:mb-6"></div>
                        <p class="text-sm <?php echo esc_attr($section_description_color); ?> max-w-2xl">
                            <?php echo esc_html($section_description); ?>
                        </p>
                    </div>

                    <!-- Alumni Images Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 md:gap-8">
                        <?php foreach ($feed_gallery as $gal_item) :
                            $img_src = mlzs_feed_img_url($gal_item);
                            if ($img_src === '') continue;
                            $gal_alt = isset($gal_item['alt']) ? (string) $gal_item['alt'] : '';
                            $cap_title = isset($gal_item['caption_title']) ? (string) $gal_item['caption_title'] : '';
                            $cap_sub = isset($gal_item['caption_subtitle']) ? (string) $gal_item['caption_subtitle'] : '';
                            $show_new = !empty($gal_item['show_new_badge']);
                            $span_two = !empty($gal_item['span_two']);
                            $col_span_class = $span_two ? ' sm:col-span-2' : '';
                        ?>
                        <a href="<?php echo esc_url($img_src); ?>"
                           data-fancybox="alumni-gallery"
                           data-caption="<?php echo esc_attr($cap_title . ($cap_sub ? ' - ' . $cap_sub : '')); ?>"
                           class="group relative overflow-hidden rounded-2xl border-2 border-primary/30 hover:border-primary/60 transition-all duration-300 hover:shadow-xl hover:-translate-y-2<?php echo esc_attr($col_span_class); ?> block">
                            <div class="aspect-[4/3] overflow-hidden">
                                <img src="<?php echo esc_url($img_src); ?>"
                                     alt="<?php echo esc_attr($gal_alt); ?>"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 p-3 sm:p-4 bg-gradient-to-t from-primary/90 to-transparent text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                <h4 class="text-base sm:text-lg font-bold mb-1"><?php echo esc_html($cap_title); ?></h4>
                                <p class="text-xs sm:text-sm opacity-90"><?php echo esc_html($cap_sub); ?></p>
                            </div>
                            <?php if ($show_new) : ?>
                            <div class="absolute top-4 right-4">
                                <span class="px-2 py-1 bg-primary text-white text-xs font-bold rounded-full">New</span>
                            </div>
                            <?php endif; ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Suggestions Form - Right Side -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24">
                        <div class="bg-gradient-to-br from-primary via-primary-dark to-slate-900 rounded-2xl p-6 md:p-8 border border-primary/40 shadow-2xl">
                            <div class="mb-6 md:mb-8">
                                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 mb-4">
                                    <i data-lucide="<?php echo esc_attr($form_icon); ?>" class="w-4 h-4 <?php echo esc_attr($form_badge_color); ?>"></i>
                                    <span class="text-xs font-bold <?php echo esc_attr($form_badge_color); ?> uppercase tracking-wider"><?php echo esc_html($form_badge); ?></span>
                                </div>
                                <h3 class="text-base sm:text-lg md:text-xl font-bold <?php echo esc_attr($form_title_color); ?> mb-3"><?php echo esc_html($form_title); ?></h3>
                                <p class="text-xs sm:text-sm <?php echo esc_attr($form_subtitle_color); ?>">
                                    <?php echo esc_html($form_subtitle); ?>
                                </p>
                            </div>

                            <form method="post" action="<?php echo esc_url($form_action); ?>" class="space-y-4 md:space-y-6">
                                <!-- Name Field -->
                                <div class="relative group/input">
                                    <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 md:w-5 md:h-5 text-slate-400 group-focus-within/input:text-accent transition-colors z-10"></i>
                                    <input type="text"
                                           id="name"
                                           name="name"
                                           placeholder="Your Name..."
                                           required
                                           class="w-full bg-white/10 border border-white/20 rounded-xl pl-12 pr-4 py-3 md:py-3.5 text-white placeholder-gray-400 focus:ring-2 focus:ring-accent/50 focus:border-accent transition-all duration-300 shadow-inner backdrop-blur-sm"
                                           aria-required="true">
                                </div>
                                <!-- Email Field -->
                                <div class="relative group/input">
                                    <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 md:w-5 md:h-5 text-slate-400 group-focus-within/input:text-accent transition-colors z-10"></i>
                                    <input type="email"
                                           id="email"
                                           name="email"
                                           placeholder="Your email..."
                                           required
                                           class="w-full bg-white/10 border border-white/20 rounded-xl pl-12 pr-4 py-3 md:py-3.5 text-white placeholder-gray-400 focus:ring-2 focus:ring-accent/50 focus:border-accent transition-all duration-300 shadow-inner backdrop-blur-sm"
                                           aria-required="true">
                                </div>
                                <!-- Class Field -->
                                <div class="relative group/input">
                                    <i data-lucide="graduation-cap" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 md:w-5 md:h-5 text-slate-400 group-focus-within/input:text-accent transition-colors z-10"></i>
                                    <input type="text"
                                           id="phone"
                                           name="phone"
                                           placeholder="Class..."
                                           required
                                           class="w-full bg-white/10 border border-white/20 rounded-xl pl-12 pr-4 py-3 md:py-3.5 text-white placeholder-gray-400 focus:ring-2 focus:ring-accent/50 focus:border-accent transition-all duration-300 shadow-inner backdrop-blur-sm"
                                           aria-required="true">
                                </div>
                                <!-- Message Field -->
                                <div class="relative group/input">
                                    <i data-lucide="edit-3" class="absolute left-4 top-4 w-4 h-4 md:w-5 md:h-5 text-slate-400 group-focus-within/input:text-accent transition-colors z-10"></i>
                                    <textarea rows="4"
                                              name="message"
                                              placeholder="Your suggestions..."
                                              required
                                              class="w-full bg-white/10 border border-white/20 rounded-xl pl-12 pr-4 py-3 md:py-3.5 text-white placeholder-gray-400 focus:ring-2 focus:ring-accent/50 focus:border-accent transition-all duration-300 shadow-inner backdrop-blur-sm resize-none"
                                              aria-required="true"></textarea>
                                </div>
                                <!-- Submit Button -->
                                <div class="pt-2">
                                    <button type="submit"
                                            name="submit"
                                            class="w-full bg-gradient-to-r from-accent to-accent-dark text-white font-bold px-6 py-3 md:px-8 md:py-4 rounded-xl hover:shadow-[0_0_30px_rgba(247,184,1,0.4)] hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2 group/btn">
                                        <span><?php echo esc_html($form_submit_text); ?></span>
                                        <i data-lucide="<?php echo esc_attr($form_submit_icon); ?>" class="w-4 h-4 md:w-5 md:h-5 group-hover/btn:translate-x-1 transition-transform"></i>
                                    </button>
                                </div>
                                <!-- Privacy Note -->
                                <p class="text-xs <?php echo esc_attr($form_privacy_color); ?> text-center mt-4">
                                    <?php echo esc_html($form_privacy); ?>
                                </p>
                            </form>
                        </div>

                        <!-- Alumni Stats -->
                        <div class="mt-6 md:mt-8 grid grid-cols-2 gap-3 md:gap-4">
                            <?php
                            $default_stat_number_colors = array('text-primary', 'text-accent', 'text-primary-light', 'text-accent-dark');
                            $default_stat_label_color = 'text-text-secondary-light';
                            foreach ($feed_stats as $idx => $stat) :
                                $num = isset($stat['number']) ? (string) $stat['number'] : '';
                                $lbl = isset($stat['label']) ? (string) $stat['label'] : '';
                                if ($num === '' && $lbl === '') continue;
                                $num_color = isset($stat['number_color']) && trim((string) $stat['number_color']) !== '' ? trim($stat['number_color']) : (isset($default_stat_number_colors[$idx]) ? $default_stat_number_colors[$idx] : 'text-primary');
                                $lbl_color = isset($stat['label_color']) && trim((string) $stat['label_color']) !== '' ? trim($stat['label_color']) : $default_stat_label_color;
                            ?>
                            <div class="bg-white rounded-xl p-3 sm:p-4 text-center shadow-soft border border-slate-100">
                                <div class="text-base sm:text-lg md:text-xl font-bold <?php echo esc_attr($num_color); ?> mb-1"><?php echo esc_html($num); ?></div>
                                <div class="text-xs font-medium <?php echo esc_attr($lbl_color); ?>"><?php echo esc_html($lbl); ?></div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
