<!DOCTYPE html>
<html <?php language_attributes(); ?> class="xl:text-[1vw] lg:text-[1.2vw] md:text-[1.3vw]">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-slate-50 text-slate-900 font-display overflow-x-hidden antialiased selection:bg-secondary selection:text-white'); ?>>
<?php wp_body_open(); ?>

<?php
$theme_uri = get_template_directory_uri();
$home_url  = home_url('/');
?>

<!-- Header Section -->
<header id="main-header" class="fixed w-full top-0 z-40 transition-all duration-500 ease-in-out h-24 text-white flex items-center border-b border-white/10 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-7xl mx-auto h-full relative flex justify-between items-center">

        <!-- LEFT MENU ITEMS (Desktop) -->
        <nav class="hidden lg:flex items-center justify-start w-5/12 pr-12 space-x-8">
            <a href="<?php echo esc_url($home_url); ?>" class="relative text-sm font-medium tracking-wide uppercase transition-colors after:content-[''] after:absolute after:w-0 after:h-px after:bottom-0 after:left-0 after:bg-current after:transition-all after:duration-300 hover:after:w-full">Home</a>
            <a href="<?php echo esc_url($home_url); ?>#about" class="relative text-sm font-medium tracking-wide uppercase transition-colors after:content-[''] after:absolute after:w-0 after:h-px after:bottom-0 after:left-0 after:bg-current after:transition-all after:duration-300 hover:after:w-full">About</a>
            <a href="<?php echo esc_url($home_url); ?>#academics" class="relative text-sm font-medium tracking-wide uppercase transition-colors after:content-[''] after:absolute after:w-0 after:h-px after:bottom-0 after:left-0 after:bg-current after:transition-all after:duration-300 hover:after:w-full">Academics</a>
        </nav>

        <!-- LOGO - Left on Mobile, Center on Desktop -->
        <div class="lg:absolute lg:left-1/2 lg:top-1/2 lg:transform lg:-translate-x-1/2 lg:-translate-y-1/2 lg:text-center lg:z-50">
            <a href="<?php echo esc_url($home_url); ?>" id="brand-logo" class="transition-all duration-500 flex items-center justify-center">
                <img src="<?php echo esc_url($theme_uri); ?>/assets/img/logo.webp" alt="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>" class="h-10 sm:h-12 md:h-14 lg:h-16 w-auto object-contain transition-all duration-500 brightness-0 invert">
            </a>
        </div>

        <!-- RIGHT MENU ITEMS (Desktop) -->
        <nav class="hidden lg:flex items-center justify-end w-5/12 pl-12 space-x-8">
            <a href="<?php echo esc_url($home_url); ?>#admissions" class="relative text-sm font-medium tracking-wide uppercase transition-colors after:content-[''] after:absolute after:w-0 after:h-px after:bottom-0 after:left-0 after:bg-current after:transition-all after:duration-300 hover:after:w-full">Admissions</a>
            <a href="<?php echo esc_url($home_url); ?>#campus-life" class="relative text-sm font-medium tracking-wide uppercase transition-colors after:content-[''] after:absolute after:w-0 after:h-px after:bottom-0 after:left-0 after:bg-current after:transition-all after:duration-300 hover:after:w-full">Campus Life</a>
            <button type="button" onclick="toggleMenu()" class="flex items-center gap-3 group focus:outline-none ml-4 pl-6 border-l border-current">
                <span class="text-xs font-bold tracking-[0.2em] uppercase group-hover:opacity-70 transition-opacity">Menu</span>
                <div class="space-y-1.5 group-hover:scale-110 transition-transform duration-300">
                    <span class="block w-6 h-0.5 bg-current transition-all"></span>
                    <span class="block w-4 h-0.5 bg-current ml-auto transition-all group-hover:w-6"></span>
                </div>
            </button>
        </nav>

        <!-- Mobile Menu Icon -->
        <button type="button" onclick="toggleMenu()" class="lg:hidden flex items-center justify-center w-10 h-10 rounded-full hover:bg-white/10 transition-colors" aria-label="Open menu">
            <i data-lucide="menu" class="w-5 h-5"></i>
        </button>
    </div>
</header>

<!-- Full Page Sidebar / Overlay -->
<div id="full-menu" class="fixed inset-0 bg-slate-900 text-white z-50 transform -translate-y-full transition-transform duration-700 ease-[cubic-bezier(0.77,0,0.175,1)] flex flex-col overflow-y-auto">
    <div class="sticky top-0 w-full py-5 flex items-center justify-between px-4 sm:px-6 container mx-auto bg-slate-900 z-10 border-b border-primary/30">
        <span class="font-['Playfair_Display',serif] text-xl sm:text-2xl italic text-gray-300">Navigation</span>
        <button type="button" onclick="toggleMenu()" class="group flex items-center gap-2 sm:gap-3 hover:text-accent transition-colors" aria-label="Close menu">
            <span class="text-xs font-bold tracking-[0.2em] uppercase hidden sm:inline">Close</span>
            <div class="relative w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center border border-primary/40 rounded-full group-hover:border-accent group-hover:rotate-90 transition-all duration-500">
                <i data-lucide="x" class="w-4 h-4 sm:w-5 sm:h-5"></i>
            </div>
        </button>
    </div>
    <div class="flex-1 flex items-center justify-center container mx-auto px-4 sm:px-6 py-8 sm:py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 sm:gap-12 w-full max-w-5xl">
            <div class="space-y-2">
                <h3 class="text-xs font-bold tracking-[0.2em] text-gray-500 mb-4 sm:mb-6 uppercase">Explore</h3>
                <ul class="space-y-3 sm:space-y-4">
                    <li class="overflow-hidden"><a href="<?php echo esc_url($home_url); ?>" class="block font-['Playfair_Display',serif] text-3xl sm:text-4xl md:text-5xl hover:italic hover:text-accent transition-all transform hover:translate-x-2 sm:hover:translate-x-4 duration-300">Home</a></li>
                    <li class="overflow-hidden"><a href="<?php echo esc_url($home_url); ?>#about" class="block font-['Playfair_Display',serif] text-3xl sm:text-4xl md:text-5xl hover:italic hover:text-accent transition-all transform hover:translate-x-2 sm:hover:translate-x-4 duration-300">About</a></li>
                    <li class="overflow-hidden"><a href="<?php echo esc_url($home_url); ?>#academics" class="block font-['Playfair_Display',serif] text-3xl sm:text-4xl md:text-5xl hover:italic hover:text-accent transition-all transform hover:translate-x-2 sm:hover:translate-x-4 duration-300">Academics</a></li>
                    <li class="overflow-hidden"><a href="<?php echo esc_url($home_url); ?>#admissions" class="block font-['Playfair_Display',serif] text-3xl sm:text-4xl md:text-5xl hover:italic hover:text-accent transition-all transform hover:translate-x-2 sm:hover:translate-x-4 duration-300">Admissions</a></li>
                    <li class="overflow-hidden"><a href="<?php echo esc_url($home_url); ?>#campus-life" class="block font-['Playfair_Display',serif] text-3xl sm:text-4xl md:text-5xl hover:italic hover:text-accent transition-all transform hover:translate-x-2 sm:hover:translate-x-4 duration-300">Campus Life</a></li>
                </ul>
            </div>
            <div class="flex flex-col justify-between space-y-8 sm:space-y-10 mt-8 md:mt-0 md:pl-20 md:border-l border-white/10">
                <div>
                    <h3 class="text-xs font-bold tracking-[0.2em] text-gray-500 mb-4 sm:mb-6 uppercase">Quick Actions</h3>
                    <ul class="space-y-3 sm:space-y-4">
                        <li><a href="<?php echo esc_url($home_url); ?>#admissions" class="flex items-center gap-3 text-base sm:text-lg text-gray-300 hover:text-accent transition-colors group"><span class="w-1 h-5 sm:h-6 bg-primary/40 group-hover:bg-accent transition-colors"></span><span>Apply Now</span></a></li>
                        <li><a href="<?php echo esc_url($home_url); ?>#virtual-tour" class="flex items-center gap-3 text-base sm:text-lg text-gray-300 hover:text-accent transition-colors group"><span class="w-1 h-5 sm:h-6 bg-primary/40 group-hover:bg-accent transition-colors"></span><span>Virtual Tour</span></a></li>
                        <li><a href="<?php echo esc_url($home_url); ?>#contact" class="flex items-center gap-3 text-base sm:text-lg text-gray-300 hover:text-accent transition-colors group"><span class="w-1 h-5 sm:h-6 bg-primary/40 group-hover:bg-accent transition-colors"></span><span>Contact Us</span></a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xs font-bold tracking-[0.2em] text-gray-500 mb-3 sm:mb-4 uppercase">Connect</h3>
                    <p class="text-gray-400 mb-4 text-xs sm:text-sm font-light">mlzs.alwar@mountlitera.com <br> +91 9672797979</p>
                    <div class="flex gap-3 sm:gap-4">
                        <a href="#" class="w-9 h-9 sm:w-10 sm:h-10 border border-primary/40 rounded-full flex items-center justify-center hover:bg-accent hover:text-white hover:border-accent transition-all" aria-label="Instagram"><i data-lucide="instagram" class="w-4 h-4 sm:w-5 sm:h-5"></i></a>
                        <a href="#" class="w-9 h-9 sm:w-10 sm:h-10 border border-primary/40 rounded-full flex items-center justify-center hover:bg-accent hover:text-white hover:border-accent transition-all" aria-label="Twitter"><i data-lucide="twitter" class="w-4 h-4 sm:w-5 sm:h-5"></i></a>
                        <a href="#" class="w-9 h-9 sm:w-10 sm:h-10 border border-primary/40 rounded-full flex items-center justify-center hover:bg-accent hover:text-white hover:border-accent transition-all" aria-label="LinkedIn"><i data-lucide="linkedin" class="w-4 h-4 sm:w-5 sm:h-5"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
