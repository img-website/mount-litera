<?php
/**
 * Template Name: Coming Soon Page
 * Static – Coming soon message for upcoming content
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$home_url = home_url('/');
?>
<main id="content" class="min-h-[60vh]">
    <section class="relative px-4 sm:px-6 lg:px-8 pt-32 pb-20 md:pt-40 md:pb-28 bg-gradient-to-br from-primary-dark via-primary to-primary-light overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-64 h-64 rounded-full bg-accent blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 rounded-full bg-accent-light blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-2xl mx-auto text-center">
            <div class="w-20 h-20 sm:w-24 sm:h-24 mx-auto mb-6 rounded-2xl bg-white/20 backdrop-blur-sm border border-white/30 flex items-center justify-center">
                <i data-lucide="sparkles" class="w-10 h-10 sm:w-12 sm:h-12 text-accent"></i>
            </div>
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-4">Coming Soon</h1>
            <p class="text-slate-200 text-sm sm:text-base md:text-lg mb-8">
                Something exciting is on the way. We're working on new content and will be live soon. Stay tuned!
            </p>
            <a href="<?php echo esc_url($home_url); ?>" class="inline-flex items-center gap-2 px-5 py-3 sm:px-6 sm:py-3.5 bg-white text-primary font-bold rounded-full hover:bg-slate-100 transition-all text-sm sm:text-base">
                <i data-lucide="home" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                Back to Home
            </a>
        </div>
    </section>
</main>
<?php
get_footer();
