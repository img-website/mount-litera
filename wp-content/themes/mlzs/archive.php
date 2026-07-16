<?php
/**
 * Archive (category / tag / date / author) — blog grid with hero.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$hero_bg = get_template_directory_uri() . '/assets/img/skyline.webp';

$active_slug = 'all';
if (is_category()) {
    $term = get_queried_object();
    $active_slug = isset($term->slug) ? $term->slug : 'all';
    $title = single_cat_title('', false);
    $desc  = term_description();
    $eyebrow = __('Category', 'mlzs');
} elseif (is_tag()) {
    $title = '#' . single_tag_title('', false);
    $desc  = term_description();
    $eyebrow = __('Tag', 'mlzs');
} elseif (is_author()) {
    $title = get_the_author();
    $desc  = wpautop(get_the_author_meta('description'));
    $eyebrow = __('Author', 'mlzs');
} else {
    $title = get_the_archive_title();
    $desc  = '';
    $eyebrow = __('Archive', 'mlzs');
}
?>
<main id="content">

    <section class="relative bg-cover bg-center px-4 sm:px-6 lg:px-8 overflow-hidden" style="background-image: linear-gradient(135deg, rgba(61,52,139,0.94) 0%, rgba(118,120,237,0.86) 55%, rgba(247,184,1,0.72) 100%), url('<?php echo esc_url($hero_bg); ?>');">
        <div class="relative z-10 w-full max-w-4xl mx-auto text-center pt-32 sm:pt-36 pb-14 sm:pb-16">
            <div class="mb-5 flex justify-center"><?php mlzs_breadcrumb(); ?></div>
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-semibold uppercase tracking-wider text-white mb-5">
                <i data-lucide="folder-open" class="w-4 h-4"></i><?php echo esc_html($eyebrow); ?>
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white leading-tight tracking-tight mb-4 drop-shadow-lg"><?php echo esc_html($title); ?></h1>
            <?php if ($desc) : ?>
            <div class="text-base sm:text-lg text-slate-200 max-w-2xl mx-auto leading-relaxed font-light"><?php echo wp_kses_post($desc); ?></div>
            <?php endif; ?>
        </div>
    </section>

    <section class="px-4 sm:px-6 lg:px-8 py-12 sm:py-16 bg-background-light">
        <div class="max-w-7xl mx-auto">
            <div class="mb-8 overflow-x-auto no-scrollbar"><?php mlzs_category_chips($active_slug); ?></div>

            <?php if (have_posts()) : ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php while (have_posts()) : the_post(); mlzs_the_blog_card(); endwhile; ?>
                </div>

                <?php
                $links = paginate_links(array(
                    'type'      => 'array',
                    'prev_text' => '‹',
                    'next_text' => '›',
                ));
                if ($links) : ?>
                <nav class="flex justify-center gap-2 mt-12" aria-label="<?php esc_attr_e('Pagination', 'mlzs'); ?>">
                    <?php foreach ($links as $link) :
                        $is_current = strpos($link, 'current') !== false;
                        $cls = $is_current ? 'bg-primary text-white border-primary' : 'bg-white text-gray-700 border-gray-200 hover:border-primary hover:text-primary';
                        echo '<span class="inline-flex [&_a]:px-4 [&_a]:py-2 [&_span]:px-4 [&_span]:py-2 [&_*]:rounded-lg [&_*]:border [&_*]:font-semibold [&_*]:text-sm ' . esc_attr($cls) . '">' . wp_kses_post($link) . '</span>';
                    endforeach; ?>
                </nav>
                <?php endif; ?>
            <?php else : ?>
                <?php echo mlzs_blog_empty_state(''); ?>
            <?php endif; ?>
        </div>
    </section>

    <?php get_template_part('template-parts/blog-cta'); ?>

</main>
<?php
get_footer();
