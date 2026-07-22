<?php
/**
 * Single blog post — magazine-style reading layout:
 * sticky Table of Contents (left) · article (centre) · share + CTA rail (right).
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

while (have_posts()) :
    the_post();

    // Process once: heading ids (TOC), link marking, table wrapping, conclusion block.
    $content_html = apply_filters('the_content', get_the_content());
    mlzs_register_faq_toc();          // keep the FAQ section in the Table of Contents
    $faq_html     = mlzs_render_faqs();
    $toc_html     = mlzs_render_toc();

    $cat       = mlzs_primary_category(get_the_ID());
    $read      = mlzs_reading_time();
    $author_id = (int) get_post_field('post_author', get_the_ID());
    $share_url = rawurlencode(get_permalink());
    $share_txt = rawurlencode(get_the_title());
    $admission = get_page_by_path('admission');
    $cta_url   = $admission ? get_permalink($admission->ID) : home_url('/');
?>
<div class="mlzs-progress" aria-hidden="true"><span class="mlzs-progress__bar"></span></div>

<main id="content">
    <article>

    <!-- Hero -->
    <header class="relative px-4 sm:px-6 lg:px-8 overflow-hidden bg-gradient-to-br from-primary-dark via-primary to-primary-dark">
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-primary-light/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 w-full max-w-4xl mx-auto text-center pt-32 sm:pt-36 pb-32 sm:pb-40">
            <div class="mb-5 flex justify-center"><?php mlzs_breadcrumb(); ?></div>
            <?php if ($cat) : ?>
            <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-white bg-accent/90 px-4 py-1.5 rounded-full mb-5 hover:bg-accent transition-colors">
                <i data-lucide="tag" class="w-3.5 h-3.5"></i><?php echo esc_html($cat->name); ?>
            </a>
            <?php endif; ?>
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-[3.4rem] font-bold text-white leading-tight tracking-tight mb-6 drop-shadow-lg"><?php the_title(); ?></h1>
            <div class="flex items-center justify-center flex-wrap gap-x-5 gap-y-2 text-sm text-slate-200">
                <span class="inline-flex items-center gap-2"><i data-lucide="user" class="w-4 h-4 text-accent"></i><?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?></span>
                <span class="inline-flex items-center gap-2"><i data-lucide="calendar" class="w-4 h-4 text-accent"></i><?php echo esc_html(get_the_date()); ?></span>
                <span class="inline-flex items-center gap-2"><i data-lucide="clock" class="w-4 h-4 text-accent"></i><?php echo esc_html($read); ?> <?php esc_html_e('min read', 'mlzs'); ?></span>
            </div>
        </div>
    </header>

    <!-- Body -->
    <section class="px-4 sm:px-6 lg:px-8 pb-14 sm:pb-20 bg-white">
        <div class="max-w-7xl mx-auto w-full">

            <?php if (has_post_thumbnail()) : ?>
            <figure class="mb-12 lg:mb-16 -mt-24 sm:-mt-28 relative z-20 rounded-3xl overflow-hidden shadow-2xl border-4 border-white aspect-video bg-gray-100">
                <img src="<?php echo esc_url(mlzs_post_image_url(get_the_ID(), 'full')); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="w-full h-full object-cover" loading="eager" width="1280" height="720" />
            </figure>
            <?php endif; ?>

            <div class="lg:grid lg:grid-cols-[15rem_minmax(0,1fr)] xl:grid-cols-[16rem_minmax(0,1fr)_14rem] lg:gap-10 xl:gap-12">

                <!-- Table of contents (left) -->
                <?php if ($toc_html) : ?>
                <aside class="hidden lg:block">
                    <div class="sticky top-28"><?php echo $toc_html; // phpcs:ignore ?></div>
                </aside>
                <?php endif; ?>

                <!-- Article -->
                <div class="min-w-0">
                    <?php if ($toc_html) : ?>
                    <details class="mlzs-toc-mobile lg:hidden mb-8">
                        <summary><i data-lucide="list" class="w-4 h-4"></i><?php esc_html_e('On this page', 'mlzs'); ?><i data-lucide="chevron-down" class="w-4 h-4 mlzs-toc-mobile__chev"></i></summary>
                        <div class="pt-1"><?php echo $toc_html; // phpcs:ignore ?></div>
                    </details>
                    <?php endif; ?>

                    <div class="mlzs-article">
                        <?php echo $content_html; // phpcs:ignore ?>
                    </div>

                    <?php if ($faq_html) { echo $faq_html; // phpcs:ignore ?>
                    <?php } ?>

                    <?php $tags = get_the_tags(); ?>
                    <?php if (!empty($tags)) : ?>
                    <div class="mt-12 pt-8 border-t border-gray-100 flex flex-wrap items-center gap-2">
                        <span class="text-sm font-bold text-gray-700 mr-1"><?php esc_html_e('Tags:', 'mlzs'); ?></span>
                        <?php foreach ($tags as $t) : ?>
                        <a href="<?php echo esc_url(get_tag_link($t->term_id)); ?>" class="text-xs font-semibold text-gray-600 bg-gray-100 hover:bg-primary hover:text-white px-3 py-1.5 rounded-full transition-colors">#<?php echo esc_html($t->name); ?></a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Share (mobile / tablet) -->
                    <div class="mt-8 xl:hidden rounded-2xl bg-background-light border border-gray-100 p-5 flex flex-wrap items-center justify-between gap-4">
                        <p class="text-sm font-bold text-gray-800 m-0"><?php esc_html_e('Found this helpful? Share it', 'mlzs'); ?></p>
                        <div class="flex items-center gap-2">
                            <a href="https://api.whatsapp.com/send?text=<?php echo $share_txt; ?>%20<?php echo $share_url; ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e('Share on WhatsApp', 'mlzs'); ?>" class="mlzs-share"><?php mlzs_social_icon_svg('whatsapp', 'w-4 h-4'); ?></a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e('Share on Facebook', 'mlzs'); ?>" class="mlzs-share"><?php mlzs_social_icon_svg('facebook', 'w-4 h-4'); ?></a>
                            <a href="https://twitter.com/intent/tweet?text=<?php echo $share_txt; ?>&url=<?php echo $share_url; ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e('Share on X', 'mlzs'); ?>" class="mlzs-share"><?php mlzs_social_icon_svg('x', 'w-4 h-4'); ?></a>
                            <button type="button" data-mlzs-copy="<?php echo esc_url(get_permalink()); ?>" aria-label="<?php esc_attr_e('Copy link', 'mlzs'); ?>" class="mlzs-share mlzs-copy-link"><i data-lucide="link" class="w-4 h-4"></i></button>
                        </div>
                    </div>

                    <!-- Author -->
                    <div class="mt-6 rounded-2xl border border-gray-100 bg-white p-6 flex items-start gap-4 shadow-soft">
                        <div class="w-14 h-14 rounded-full bg-primary/10 text-primary flex items-center justify-center shrink-0">
                            <i data-lucide="graduation-cap" class="w-7 h-7"></i>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wider text-gray-500 font-bold mb-1 m-0"><?php esc_html_e('Written by', 'mlzs'); ?></p>
                            <p class="text-base font-bold text-gray-900 m-0"><?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?></p>
                            <p class="text-sm text-gray-600 mt-1 mb-0"><?php esc_html_e('Mount Litera Zee School, Alwar — sharing guidance for parents and students.', 'mlzs'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Right rail: share + admissions (desktop) -->
                <aside class="hidden xl:block">
                    <div class="sticky top-28 flex flex-col gap-5">
                        <div class="mlzs-rail">
                            <p class="mlzs-rail__title"><?php esc_html_e('Share', 'mlzs'); ?></p>
                            <div class="flex flex-wrap gap-2">
                                <a href="https://api.whatsapp.com/send?text=<?php echo $share_txt; ?>%20<?php echo $share_url; ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e('Share on WhatsApp', 'mlzs'); ?>" class="mlzs-share"><?php mlzs_social_icon_svg('whatsapp', 'w-4 h-4'); ?></a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e('Share on Facebook', 'mlzs'); ?>" class="mlzs-share"><?php mlzs_social_icon_svg('facebook', 'w-4 h-4'); ?></a>
                                <a href="https://twitter.com/intent/tweet?text=<?php echo $share_txt; ?>&url=<?php echo $share_url; ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e('Share on X', 'mlzs'); ?>" class="mlzs-share"><?php mlzs_social_icon_svg('x', 'w-4 h-4'); ?></a>
                                <button type="button" data-mlzs-copy="<?php echo esc_url(get_permalink()); ?>" aria-label="<?php esc_attr_e('Copy link', 'mlzs'); ?>" class="mlzs-share mlzs-copy-link"><i data-lucide="link" class="w-4 h-4"></i></button>
                            </div>
                        </div>
                        <div class="mlzs-rail mlzs-rail--cta">
                            <i data-lucide="sparkles" class="w-6 h-6 text-accent mb-2"></i>
                            <p class="mlzs-rail__cta-title"><?php esc_html_e('Admissions Open', 'mlzs'); ?></p>
                            <p class="mlzs-rail__cta-text"><?php esc_html_e('Talk to our team or book a campus visit.', 'mlzs'); ?></p>
                            <a href="<?php echo esc_url($cta_url); ?>" class="mlzs-rail__btn"><?php esc_html_e('Enquire now', 'mlzs'); ?><i data-lucide="arrow-right" class="w-4 h-4"></i></a>
                        </div>
                    </div>
                </aside>
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
