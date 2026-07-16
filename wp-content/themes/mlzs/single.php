<?php
/**
 * Single blog post. Yoast outputs the SEO meta + Article/Breadcrumb schema in the head.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

while (have_posts()) :
    the_post();
    $cat       = mlzs_primary_category(get_the_ID());
    $read      = mlzs_reading_time();
    $author_id = (int) get_post_field('post_author', get_the_ID());
    $share_url = urlencode(get_permalink());
    $share_txt = urlencode(get_the_title());
?>
<main id="content">

    <!-- Hero -->
    <article>
    <header class="relative px-4 sm:px-6 lg:px-8 overflow-hidden bg-gradient-to-br from-primary-dark via-primary to-primary-dark">
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-primary-light/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 w-full max-w-3xl mx-auto text-center pt-32 sm:pt-36 pb-14 sm:pb-16">
            <div class="mb-5 flex justify-center"><?php mlzs_breadcrumb(); ?></div>
            <?php if ($cat) : ?>
            <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-white bg-accent/90 px-4 py-1.5 rounded-full mb-5 hover:bg-accent transition-colors">
                <i data-lucide="tag" class="w-3.5 h-3.5"></i><?php echo esc_html($cat->name); ?>
            </a>
            <?php endif; ?>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white leading-tight tracking-tight mb-6 drop-shadow-lg">
                <?php the_title(); ?>
            </h1>
            <div class="flex items-center justify-center flex-wrap gap-x-5 gap-y-2 text-sm text-slate-200">
                <span class="inline-flex items-center gap-2"><i data-lucide="user" class="w-4 h-4 text-accent"></i><?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?></span>
                <span class="inline-flex items-center gap-2"><i data-lucide="calendar" class="w-4 h-4 text-accent"></i><?php echo esc_html(get_the_date()); ?></span>
                <span class="inline-flex items-center gap-2"><i data-lucide="clock" class="w-4 h-4 text-accent"></i><?php echo esc_html($read); ?> <?php esc_html_e('min read', 'mlzs'); ?></span>
            </div>
        </div>
    </header>

    <!-- Body -->
    <section class="px-4 sm:px-6 lg:px-8 py-12 sm:py-16 bg-white">
        <div class="max-w-3xl mx-auto">
            <?php if (has_post_thumbnail()) : ?>
            <figure class="mb-10 -mt-24 sm:-mt-28 relative z-20 rounded-2xl overflow-hidden shadow-2xl border-4 border-white aspect-video bg-gray-100">
                <img src="<?php echo esc_url(mlzs_post_image_url(get_the_ID(), 'large')); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="w-full h-full object-cover" loading="eager" width="1280" height="720" />
            </figure>
            <?php endif; ?>

            <div class="prose prose-slate prose-base sm:prose-lg max-w-none prose-headings:font-display prose-headings:text-slate-900 prose-a:text-primary prose-a:font-medium prose-a:no-underline hover:prose-a:underline prose-strong:text-slate-900 prose-img:rounded-xl prose-blockquote:border-l-primary prose-blockquote:bg-primary/5 prose-blockquote:py-1 prose-blockquote:not-italic">
                <?php the_content(); ?>
            </div>

            <?php
            $tags = get_the_tags();
            if (!empty($tags)) : ?>
            <div class="mt-10 pt-6 border-t border-gray-100 flex flex-wrap items-center gap-2">
                <span class="text-sm font-bold text-gray-700 mr-1"><?php esc_html_e('Tags:', 'mlzs'); ?></span>
                <?php foreach ($tags as $t) : ?>
                <a href="<?php echo esc_url(get_tag_link($t->term_id)); ?>" class="text-xs font-semibold text-gray-600 bg-gray-100 hover:bg-primary/10 hover:text-primary px-3 py-1.5 rounded-full transition-colors">#<?php echo esc_html($t->name); ?></a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Share -->
            <div class="mt-8 flex items-center gap-3">
                <span class="text-sm font-bold text-gray-700"><?php esc_html_e('Share:', 'mlzs'); ?></span>
                <a href="https://api.whatsapp.com/send?text=<?php echo $share_txt; ?>%20<?php echo $share_url; ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e('Share on WhatsApp', 'mlzs'); ?>" class="w-9 h-9 rounded-full bg-gray-100 hover:bg-primary hover:text-white text-gray-600 flex items-center justify-center transition-colors"><?php mlzs_social_icon_svg('whatsapp', 'w-4 h-4'); ?></a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e('Share on Facebook', 'mlzs'); ?>" class="w-9 h-9 rounded-full bg-gray-100 hover:bg-primary hover:text-white text-gray-600 flex items-center justify-center transition-colors"><?php mlzs_social_icon_svg('facebook', 'w-4 h-4'); ?></a>
                <a href="https://twitter.com/intent/tweet?text=<?php echo $share_txt; ?>&url=<?php echo $share_url; ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e('Share on X', 'mlzs'); ?>" class="w-9 h-9 rounded-full bg-gray-100 hover:bg-primary hover:text-white text-gray-600 flex items-center justify-center transition-colors"><?php mlzs_social_icon_svg('x', 'w-4 h-4'); ?></a>
                <button type="button" data-mlzs-copy="<?php echo esc_url(get_permalink()); ?>" aria-label="<?php esc_attr_e('Copy link', 'mlzs'); ?>" class="mlzs-copy-link w-9 h-9 rounded-full bg-gray-100 hover:bg-primary hover:text-white text-gray-600 flex items-center justify-center transition-colors"><i data-lucide="link" class="w-4 h-4"></i></button>
            </div>
        </div>
    </section>
    </article>

    <?php
    $related = mlzs_related_posts(get_the_ID(), 3);
    if ($related->have_posts()) : ?>
    <section class="px-4 sm:px-6 lg:px-8 py-12 sm:py-16 bg-background-light border-t border-gray-100">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-8 text-center"><?php esc_html_e('Related reading', 'mlzs'); ?></h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while ($related->have_posts()) : $related->the_post(); mlzs_the_blog_card(); endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php get_template_part('template-parts/blog-cta'); ?>

</main>
<?php
endwhile;
get_footer();
