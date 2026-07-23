<?php
/**
 * Template Name: Blog
 * Blog listing at /blog/ with smart search + category filter.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$hero_bg = get_template_directory_uri() . '/assets/img/skyline.webp';

$search    = isset($_GET['bs']) ? sanitize_text_field(wp_unslash($_GET['bs'])) : '';
$active    = isset($_GET['cat']) ? sanitize_title(wp_unslash($_GET['cat'])) : 'all';
$paged     = isset($_GET['pg']) ? max(1, (int) $_GET['pg']) : 1;
$per_page  = 9;

$args = array(
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => $per_page,
    'paged'               => $paged,
    'ignore_sticky_posts' => true,
);
if ($search !== '') {
    $args['s'] = $search;
}
if ($active !== '' && $active !== 'all') {
    $args['category_name'] = $active;
}
$blog_query = new WP_Query($args);
?>
<main id="content">

    <!-- Hero -->
    <section class="relative bg-cover bg-center px-4 sm:px-6 lg:px-8 overflow-hidden" style="background-image: linear-gradient(135deg, rgba(61,52,139,0.94) 0%, rgba(118,120,237,0.86) 55%, rgba(247,184,1,0.72) 100%), url('<?php echo esc_url($hero_bg); ?>');">
        <div class="relative z-10 w-full max-w-5xl mx-auto text-center pt-32 sm:pt-36 pb-14 sm:pb-16">
            <div class="mb-5 flex justify-center"><?php mlzs_breadcrumb(); ?></div>
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-semibold uppercase tracking-wider text-white mb-5">
                <i data-lucide="book-open" class="w-4 h-4"></i><?php esc_html_e('School Blog', 'mlzs'); ?>
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-[1.1] tracking-tight mb-4 drop-shadow-lg">
                <?php esc_html_e('Insights, Stories &amp; Guidance', 'mlzs'); ?>
            </h1>
            <p class="text-base sm:text-lg text-slate-200 max-w-2xl mx-auto leading-relaxed font-light">
                <?php esc_html_e('Admissions guidance, learning tips and life at Mount Litera Zee School, Alwar — written for parents and students.', 'mlzs'); ?>
            </p>

            <!-- Smart search -->
            <form role="search" method="get" action="<?php echo esc_url(mlzs_blog_url()); ?>" id="mlzs-blog-search" class="mt-8 max-w-xl mx-auto">
                <label for="mlzs-blog-q" class="sr-only"><?php esc_html_e('Search articles', 'mlzs'); ?></label>
                <div class="relative">
                    <i data-lucide="search" class="absolute left-5 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                    <input id="mlzs-blog-q" type="search" name="bs" value="<?php echo esc_attr($search); ?>" autocomplete="off"
                        placeholder="<?php esc_attr_e('Search articles… e.g. admissions, exams, activities', 'mlzs'); ?>"
                        class="w-full bg-white rounded-full pl-14 pr-28 py-4 text-gray-800 placeholder-gray-400 shadow-xl focus:ring-4 focus:ring-accent/40 focus:outline-none" />
                    <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 bg-primary hover:bg-primary-dark text-white font-bold text-sm px-6 py-2.5 rounded-full transition-colors">
                        <?php esc_html_e('Search', 'mlzs'); ?>
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Filter + results -->
    <section class="px-4 sm:px-6 lg:px-8 py-12 sm:py-16 bg-background-light">
        <div class="max-w-7xl mx-auto">

            <div class="mb-8 overflow-x-auto no-scrollbar"><?php mlzs_category_chips($active); ?></div>

            <p id="mlzs-blog-count" class="text-sm text-gray-500 mb-6" aria-live="polite">
                <?php
                if ($search !== '') {
                    printf(esc_html__('%1$d result(s) for “%2$s”', 'mlzs'), (int) $blog_query->found_posts, esc_html($search));
                } else {
                    printf(esc_html__('%d article(s)', 'mlzs'), (int) $blog_query->found_posts);
                }
                ?>
            </p>

            <div id="mlzs-blog-results">
                <?php if ($blog_query->have_posts()) : ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php while ($blog_query->have_posts()) : $blog_query->the_post(); mlzs_the_blog_card(); endwhile; ?>
                    </div>

                    <?php
                    $total = (int) $blog_query->max_num_pages;
                    if ($total > 1) :
                        $links = paginate_links(array(
                            'base'      => add_query_arg('pg', '%#%'),
                            'format'    => '',
                            'current'   => $paged,
                            'total'     => $total,
                            'type'      => 'array',
                            'prev_text' => '‹',
                            'next_text' => '›',
                            'add_args'  => array_filter(array('bs' => $search ?: null, 'cat' => $active !== 'all' ? $active : null)),
                        ));
                        if ($links) :
                    ?>
                    <nav class="flex justify-center gap-2 mt-12" aria-label="<?php esc_attr_e('Blog pagination', 'mlzs'); ?>">
                        <?php foreach ($links as $link) :
                            $is_current = strpos($link, 'current') !== false;
                            $cls = $is_current
                                ? 'bg-primary text-white border-primary'
                                : 'bg-white text-gray-700 border-gray-200 hover:border-primary hover:text-primary';
                            echo '<span class="inline-flex [&_a]:px-4 [&_a]:py-2 [&_span]:px-4 [&_span]:py-2 [&_*]:rounded-lg [&_*]:border [&_*]:font-semibold [&_*]:text-sm ' . esc_attr($cls) . '">' . wp_kses_post($link) . '</span>';
                        endforeach; ?>
                    </nav>
                    <?php endif; endif; ?>

                <?php else : ?>
                    <?php echo mlzs_blog_empty_state($search); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php get_template_part('template-parts/blog-cta'); ?>

</main>
<?php
wp_reset_postdata();
get_footer();
