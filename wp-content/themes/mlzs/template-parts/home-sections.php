<?php
/**
 * Home page dynamic sections: Testimonials · Blog · FAQ.
 * All content is ACF-driven; each section can be toggled off.
 */
if (!defined('ABSPATH')) {
    exit;
}
$hid = get_the_ID();
$f   = function ($name, $default = '') use ($hid) {
    if (!function_exists('get_field')) {
        return $default;
    }
    $v = get_field($name, $hid);
    return ($v === null || $v === '') ? $default : $v;
};

/* =========================================================================
   1) TESTIMONIALS (video reviews)
   ====================================================================== */
$tm_on     = function_exists('get_field') ? (bool) get_field('home_tm_enabled', $hid) : true;
$tm_videos = (array) $f('home_tm_videos', array());
if ($tm_on && !empty($tm_videos)) :
    $tm_channel = $f('home_tm_channel', '');
?>
<section id="testimonials" class="relative w-full overflow-hidden px-4 sm:px-6 lg:px-8 py-16 md:py-24 bg-gradient-to-br from-primary-dark via-slate-900 to-slate-950">
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-primary/20 rounded-full blur-[130px] pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-accent/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="relative z-10 max-w-7xl mx-auto">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/20 text-xs font-bold uppercase tracking-widest text-accent mb-5">
                <i data-lucide="message-circle-heart" class="w-4 h-4"></i><?php echo esc_html($f('home_tm_badge', 'Parent Feedback')); ?>
            </span>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white tracking-tight mb-4">
                <?php echo esc_html($f('home_tm_heading', 'Real Stories from')); ?>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame via-tiger-orange to-cayenne-red"><?php echo esc_html($f('home_tm_highlight', 'Real Parents')); ?></span>
            </h2>
            <p class="text-slate-300 font-light"><?php echo esc_html($f('home_tm_subtext', '')); ?></p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($tm_videos as $v) :
                $vid = mlzs_youtube_id(isset($v['video_url']) ? $v['video_url'] : '');
                if ($vid === '') { continue; }
                $thumb = (!empty($v['thumb']) && is_string($v['thumb'])) ? $v['thumb'] : 'https://i.ytimg.com/vi/' . $vid . '/hqdefault.jpg';
                $name  = isset($v['name']) && $v['name'] !== '' ? $v['name'] : 'Parent Review';
                $role  = isset($v['role']) ? $v['role'] : '';
            ?>
            <button type="button" class="mlzs-tm-card group relative block text-left rounded-2xl overflow-hidden border border-white/10 bg-white/5 hover:border-accent/50 transition-all duration-300 hover:-translate-y-1"
                    data-mlzs-video="<?php echo esc_attr($vid); ?>" aria-label="<?php echo esc_attr(sprintf(__('Play video: %s', 'mlzs'), $name)); ?>">
                <span class="block aspect-video overflow-hidden bg-slate-800">
                    <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($name); ?>" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                    <span class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></span>
                    <span class="absolute inset-0 flex items-center justify-center">
                        <span class="w-16 h-16 rounded-full bg-white/90 group-hover:bg-accent flex items-center justify-center shadow-2xl group-hover:scale-110 transition-all">
                            <i data-lucide="play" class="w-7 h-7 text-primary group-hover:text-white ml-1 fill-current"></i>
                        </span>
                    </span>
                </span>
                <span class="flex items-center gap-3 p-4">
                    <span class="w-10 h-10 rounded-full bg-primary/30 border border-white/15 flex items-center justify-center shrink-0">
                        <i data-lucide="user-round" class="w-5 h-5 text-accent"></i>
                    </span>
                    <span class="min-w-0">
                        <span class="block text-white font-bold text-sm truncate"><?php echo esc_html($name); ?></span>
                        <span class="block text-slate-400 text-xs truncate"><?php echo esc_html($role !== '' ? $role : 'Mount Litera Zee School, Alwar'); ?></span>
                    </span>
                    <i data-lucide="youtube" class="w-5 h-5 text-red-500 ml-auto shrink-0"></i>
                </span>
            </button>
            <?php endforeach; ?>
        </div>

        <?php if ($tm_channel) : ?>
        <div class="text-center mt-10">
            <a href="<?php echo esc_url($tm_channel); ?>" target="_blank" rel="noopener" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white font-semibold px-6 py-3 rounded-full transition-all">
                <i data-lucide="youtube" class="w-5 h-5 text-red-500"></i><?php esc_html_e('Watch more parent stories on YouTube', 'mlzs'); ?>
            </a>
        </div>
        <?php endif; ?>
    </div>

    <!-- video modal -->
    <div id="mlzs-video-modal" class="mlzs-vm" aria-hidden="true">
        <div class="mlzs-vm__backdrop" data-mlzs-vm-close></div>
        <div class="mlzs-vm__dialog" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e('Video testimonial', 'mlzs'); ?>">
            <button type="button" class="mlzs-vm__close" data-mlzs-vm-close aria-label="<?php esc_attr_e('Close', 'mlzs'); ?>">&times;</button>
            <div class="mlzs-vm__frame"></div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
/* =========================================================================
   2) BLOG (latest posts)
   ====================================================================== */
$blog_on = function_exists('get_field') ? (bool) get_field('home_blog_enabled', $hid) : true;
if ($blog_on) :
    $count = (int) $f('home_blog_count', 3);
    $count = $count > 0 ? $count : 3;
    $bq = new WP_Query(array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => $count, 'ignore_sticky_posts' => true));
    if ($bq->have_posts()) :
?>
<section id="blog" class="relative w-full px-4 sm:px-6 lg:px-8 py-16 md:py-24 bg-background-light">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5 mb-10">
            <div class="max-w-2xl">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary/10 border border-primary/20 text-xs font-bold uppercase tracking-widest text-primary mb-4">
                    <i data-lucide="book-open" class="w-4 h-4"></i><?php echo esc_html($f('home_blog_badge', 'From Our Blog')); ?>
                </span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 tracking-tight mb-3">
                    <?php echo esc_html($f('home_blog_heading', 'Insights &')); ?>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-primary-light"><?php echo esc_html($f('home_blog_highlight', 'Guidance')); ?></span>
                </h2>
                <p class="text-gray-600 font-light"><?php echo esc_html($f('home_blog_subtext', '')); ?></p>
            </div>
            <a href="<?php echo esc_url(mlzs_blog_url()); ?>" class="inline-flex items-center gap-2 shrink-0 bg-primary hover:bg-primary-dark text-white font-bold px-6 py-3 rounded-full transition-all hover:-translate-y-0.5 shadow-[0_4px_14px_0_rgba(61,52,139,0.39)]">
                <?php esc_html_e('View all articles', 'mlzs'); ?><i data-lucide="arrow-right" class="w-5 h-5"></i>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while ($bq->have_posts()) : $bq->the_post(); mlzs_the_blog_card(); endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; endif; ?>

<?php
/* =========================================================================
   3) FAQ (accordion)
   ====================================================================== */
$faq_on    = function_exists('get_field') ? (bool) get_field('home_faq_enabled', $hid) : true;
$faq_items = (array) $f('home_faq_items', array());
if ($faq_on && !empty($faq_items)) :
    $reach = get_page_by_path('reach-us');
    $reach_url = $reach ? get_permalink($reach->ID) : home_url('/#contact');
?>
<section id="faq" class="relative w-full px-4 sm:px-6 lg:px-8 py-16 md:py-24 bg-white">
    <div class="max-w-4xl mx-auto">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-accent/15 border border-accent/30 text-xs font-bold uppercase tracking-widest text-accent-dark mb-5">
                <i data-lucide="help-circle" class="w-4 h-4"></i><?php echo esc_html($f('home_faq_badge', 'Got Questions?')); ?>
            </span>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 tracking-tight mb-4">
                <?php echo esc_html($f('home_faq_heading', 'Frequently Asked')); ?>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-primary-light"><?php echo esc_html($f('home_faq_highlight', 'Questions')); ?></span>
            </h2>
            <p class="text-gray-600 font-light"><?php echo esc_html($f('home_faq_subtext', '')); ?></p>
        </div>

        <div class="mlzs-hfaq" data-mlzs-accordion>
            <?php foreach ($faq_items as $i => $item) :
                $q = isset($item['question']) ? $item['question'] : '';
                $a = isset($item['answer']) ? $item['answer'] : '';
                if ($q === '') { continue; }
            ?>
            <details class="mlzs-hfaq__item" name="mlzs-home-faq"<?php echo $i === 0 ? ' open' : ''; ?>>
                <summary class="mlzs-hfaq__q">
                    <span class="mlzs-hfaq__num"><?php echo esc_html($i + 1); ?></span>
                    <span class="flex-1"><?php echo esc_html($q); ?></span>
                    <i data-lucide="chevron-down" class="mlzs-hfaq__chev w-5 h-5"></i>
                </summary>
                <div class="mlzs-hfaq__a"><?php echo wp_kses_post(wpautop($a)); ?></div>
            </details>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-10">
            <p class="text-gray-600 mb-4"><?php esc_html_e('Still have a question?', 'mlzs'); ?></p>
            <a href="<?php echo esc_url($reach_url); ?>" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-bold px-7 py-3.5 rounded-full transition-all hover:-translate-y-0.5 shadow-[0_4px_14px_0_rgba(61,52,139,0.39)]">
                <i data-lucide="messages-square" class="w-5 h-5"></i><?php esc_html_e('Talk to our team', 'mlzs'); ?>
            </a>
        </div>
    </div>

    <?php
    // FAQPage structured data for the home FAQ
    $schema = array('@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => array());
    foreach ($faq_items as $item) {
        if (empty($item['question'])) { continue; }
        $schema['mainEntity'][] = array(
            '@type' => 'Question', 'name' => wp_strip_all_tags($item['question']),
            'acceptedAnswer' => array('@type' => 'Answer', 'text' => wp_strip_all_tags($item['answer'])),
        );
    }
    if (!empty($schema['mainEntity'])) {
        echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
    }
    ?>
</section>
<?php endif; ?>
