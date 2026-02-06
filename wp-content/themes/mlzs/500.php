<?php
/**
 * 500 Internal Server Error – Server error template
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
        <div class="relative z-10 max-w-7xl mx-auto text-center">
            <p class="text-8xl sm:text-9xl font-bold text-white/20 select-none leading-none">500</p>
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mt-4 mb-4">Something Went Wrong</h1>
            <p class="text-slate-200 text-sm sm:text-base md:text-lg max-w-xl mx-auto mb-8">
                We're sorry. The server encountered an error and could not complete your request. Please try again later.
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
