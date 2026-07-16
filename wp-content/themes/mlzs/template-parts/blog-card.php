<?php
/**
 * Blog card — used in listing, archives, search and AJAX results.
 * Must be called inside the loop (uses current post context).
 */
if (!defined('ABSPATH')) {
    exit;
}

$cat  = mlzs_primary_category(get_the_ID());
$img  = mlzs_post_image_url(get_the_ID(), 'large');
$read = mlzs_reading_time();
?>
<article class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-soft hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">
    <a href="<?php the_permalink(); ?>" class="block overflow-hidden aspect-[16/10] bg-gray-100" tabindex="-1" aria-hidden="true">
        <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" width="640" height="400" />
    </a>
    <div class="p-5 sm:p-6 flex flex-col flex-1">
        <?php if ($cat) : ?>
        <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="inline-flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-primary mb-3 self-start bg-primary/10 px-3 py-1 rounded-full hover:bg-primary/20 transition-colors">
            <i data-lucide="tag" class="w-3 h-3"></i><?php echo esc_html($cat->name); ?>
        </a>
        <?php endif; ?>
        <h3 class="text-lg font-bold text-gray-900 mb-2 leading-snug line-clamp-2 group-hover:text-primary transition-colors">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        <p class="text-sm text-gray-600 leading-relaxed mb-4 line-clamp-3 flex-1"><?php echo esc_html(get_the_excerpt()); ?></p>
        <div class="flex items-center justify-between text-xs text-gray-500 mt-auto pt-4 border-t border-gray-100">
            <span class="inline-flex items-center gap-1.5"><i data-lucide="calendar" class="w-3.5 h-3.5"></i><?php echo esc_html(get_the_date()); ?></span>
            <span class="inline-flex items-center gap-1.5"><i data-lucide="clock" class="w-3.5 h-3.5"></i><?php echo esc_html($read); ?> <?php esc_html_e('min read', 'mlzs'); ?></span>
        </div>
    </div>
</article>
