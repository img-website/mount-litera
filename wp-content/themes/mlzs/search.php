<?php
/**
 * Search results — reuses the blog grid + a prominent search bar.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$hero_bg = get_template_directory_uri() . '/assets/img/skyline.webp';
$term    = get_search_query();
global $wp_query;
$found   = (int) $wp_query->found_posts;
?>
<main id="content">

    <section class="relative bg-cover bg-center px-4 sm:px-6 lg:px-8 overflow-hidden" style="background-image: linear-gradient(135deg, rgba(61,52,139,0.94) 0%, rgba(118,120,237,0.86) 55%, rgba(247,184,1,0.72) 100%), url('<?php echo esc_url($hero_bg); ?>');">
        <div class="relative z-10 w-full max-w-3xl mx-auto text-center pt-32 sm:pt-36 pb-14 sm:pb-16">
            <div class="mb-5 flex justify-center"><?php mlzs_breadcrumb(); ?></div>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white leading-tight tracking-tight mb-3 drop-shadow-lg">
                <?php esc_html_e('Search', 'mlzs'); ?>
            </h1>
            <p class="text-slate-200 mb-8">
                <?php printf(esc_html__('%1$d result(s) for “%2$s”', 'mlzs'), $found, esc_html($term)); ?>
            </p>
            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="max-w-xl mx-auto">
                <label for="mlzs-search-q" class="sr-only"><?php esc_html_e('Search', 'mlzs'); ?></label>
                <div class="relative">
                    <i data-lucide="search" class="absolute left-5 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                    <input id="mlzs-search-q" type="search" name="s" value="<?php echo esc_attr($term); ?>" autocomplete="off"
                        placeholder="<?php esc_attr_e('Search the website…', 'mlzs'); ?>"
                        class="w-full bg-white rounded-full pl-14 pr-28 py-4 text-gray-800 placeholder-gray-400 shadow-xl focus:ring-4 focus:ring-accent/40 focus:outline-none" />
                    <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 bg-primary hover:bg-primary-dark text-white font-bold text-sm px-6 py-2.5 rounded-full transition-colors"><?php esc_html_e('Search', 'mlzs'); ?></button>
                </div>
            </form>
        </div>
    </section>

    <section class="px-4 sm:px-6 lg:px-8 py-12 sm:py-16 bg-background-light">
        <div class="max-w-7xl mx-auto">
            <?php if (have_posts()) : ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php while (have_posts()) : the_post(); mlzs_the_blog_card(); endwhile; ?>
                </div>
                <?php
                $links = paginate_links(array('type' => 'array', 'prev_text' => '‹', 'next_text' => '›'));
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
                <?php echo mlzs_blog_empty_state($term); ?>
                <div class="text-center mt-8">
                    <a href="<?php echo esc_url(mlzs_blog_url()); ?>" class="inline-flex items-center gap-2 text-primary font-semibold hover:underline">
                        <i data-lucide="book-open" class="w-4 h-4"></i><?php esc_html_e('Browse all articles', 'mlzs'); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

</main>
<?php
get_footer();
