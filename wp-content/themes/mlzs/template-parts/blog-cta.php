<?php
/**
 * Reusable call-to-action band for blog pages.
 */
if (!defined('ABSPATH')) {
    exit;
}
$admission = get_page_by_path('admission');
$enquiry   = get_page_by_path('enquiry');
$cta_url   = $admission ? get_permalink($admission->ID) : ($enquiry ? get_permalink($enquiry->ID) : home_url('/'));
$reach     = get_page_by_path('reach-us');
$reach_url = $reach ? get_permalink($reach->ID) : home_url('/');
?>
<section class="px-4 sm:px-6 lg:px-8 py-14 sm:py-20 bg-background-light">
    <div class="max-w-5xl mx-auto rounded-3xl overflow-hidden relative bg-gradient-to-r from-primary-dark via-primary to-primary-dark border border-primary/40 shadow-2xl">
        <div class="absolute top-0 right-0 w-80 h-80 bg-accent/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 px-6 sm:px-12 py-12 sm:py-14 text-center">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white tracking-tight mb-3">
                <?php esc_html_e('Considering Mount Litera Zee School for your child?', 'mlzs'); ?>
            </h2>
            <p class="text-slate-200 max-w-2xl mx-auto mb-8 font-light">
                <?php esc_html_e('Admissions are open. Talk to our team, book a campus visit, or start your enquiry today.', 'mlzs'); ?>
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="<?php echo esc_url($cta_url); ?>" class="w-full sm:w-auto bg-white text-primary font-bold px-8 py-4 rounded-full hover:shadow-[0_0_28px_rgba(255,255,255,0.35)] hover:-translate-y-0.5 transition-all inline-flex items-center justify-center gap-2">
                    <?php esc_html_e('Start Admission Enquiry', 'mlzs'); ?><i data-lucide="arrow-right" class="w-5 h-5"></i>
                </a>
                <a href="<?php echo esc_url($reach_url); ?>" class="w-full sm:w-auto bg-transparent border-2 border-white/70 text-white font-bold px-8 py-4 rounded-full hover:bg-white/10 transition-all inline-flex items-center justify-center gap-2">
                    <i data-lucide="map-pin" class="w-5 h-5"></i><?php esc_html_e('Visit Us', 'mlzs'); ?>
                </a>
            </div>
        </div>
    </div>
</section>
