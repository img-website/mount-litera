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

// Header: ACF Options (site-wide)
$opt = function_exists('get_field');
$header_logo_url    = $opt ? get_field('header_logo', 'option') : null;
$header_left_menu  = $opt ? get_field('header_left_menu', 'option') : null;
$header_right_menu = $opt ? get_field('header_right_menu', 'option') : null;
$header_full_menu  = $opt ? get_field('header_full_menu', 'option') : null;
$header_quick_actions = $opt ? get_field('header_quick_actions', 'option') : null;
$header_connect_heading = $opt ? get_field('header_connect_heading', 'option') : null;
$header_connect_email   = $opt ? get_field('header_connect_email', 'option') : null;
$header_connect_phone   = $opt ? get_field('header_connect_phone', 'option') : null;
// Social: reuse Footer settings (single source of truth – update only in Footer)
$header_social = $opt ? get_field('footer_social', 'option') : null;

$header_logo_url = (is_array($header_logo_url) && !empty($header_logo_url['url'])) ? $header_logo_url['url'] : (is_string($header_logo_url) && $header_logo_url !== '' ? $header_logo_url : '');
if ($header_logo_url === '') $header_logo_url = $theme_uri . '/assets/img/logo.webp';
$header_left_menu  = is_array($header_left_menu) ? array_slice($header_left_menu, 0, 3) : array();
$header_right_menu = is_array($header_right_menu) ? array_slice($header_right_menu, 0, 2) : array();
$default_left  = array(
    array('link' => array('url' => (string) $home_url, 'title' => 'Home', 'target' => '')),
    array('link' => array('url' => (string) $home_url . '#about', 'title' => 'About', 'target' => '')),
    array('link' => array('url' => (string) $home_url . '#academics', 'title' => 'Academics', 'target' => '')),
);
$default_right = array(
    array('link' => array('url' => (string) $home_url . '#admissions', 'title' => 'Admissions', 'target' => '')),
    array('link' => array('url' => (string) $home_url . '#campus-life', 'title' => 'Campus Life', 'target' => '')),
);
if (empty($header_left_menu))  $header_left_menu  = $default_left;
if (empty($header_right_menu)) $header_right_menu = $default_right;
$header_full_menu = is_array($header_full_menu) ? $header_full_menu : array();
if (empty($header_full_menu)) {
    $header_full_menu = array(
        array('link' => array('url' => (string) $home_url, 'title' => 'Home', 'target' => ''), 'children' => array()),
        array('link' => array('url' => (string) $home_url . '#about', 'title' => 'About', 'target' => ''), 'children' => array(
            array('link' => array('url' => (string) $home_url . '#about', 'title' => 'Our Story', 'target' => ''), 'children' => array()),
            array('link' => array('url' => (string) $home_url . '#about', 'title' => 'Team', 'target' => ''), 'children' => array()),
        )),
        array('link' => array('url' => (string) $home_url . '#academics', 'title' => 'Academics', 'target' => ''), 'children' => array(
            array('link' => array('url' => (string) $home_url . '#academics', 'title' => 'Programs', 'target' => ''), 'children' => array()),
            array('link' => array('url' => (string) $home_url . '#academics', 'title' => 'Curriculum', 'target' => ''), 'children' => array()),
        )),
        array('link' => array('url' => (string) $home_url . '#admissions', 'title' => 'Admissions', 'target' => ''), 'children' => array()),
        array('link' => array('url' => (string) $home_url . '#campus-life', 'title' => 'Campus Life', 'target' => ''), 'children' => array(
            array('link' => array('url' => (string) $home_url . '#campus-life', 'title' => 'Facilities', 'target' => ''), 'children' => array()),
            array('link' => array('url' => (string) $home_url . '#campus-life', 'title' => 'Events', 'target' => ''), 'children' => array()),
        )),
    );
}
$header_quick_actions = is_array($header_quick_actions) ? $header_quick_actions : array();
if (empty($header_quick_actions)) $header_quick_actions = array(
    array('link' => array('url' => (string) $home_url . '#admissions', 'title' => 'Apply Now', 'target' => '')),
    array('link' => array('url' => (string) $home_url . '#virtual-tour', 'title' => 'Virtual Tour', 'target' => '')),
    array('link' => array('url' => (string) $home_url . '#contact', 'title' => 'Contact Us', 'target' => '')),
);
$header_connect_heading = ($header_connect_heading !== '' && $header_connect_heading !== null) ? $header_connect_heading : 'Connect';
$header_connect_email   = ($header_connect_email !== '' && $header_connect_email !== null) ? $header_connect_email : 'mlzs.alwar@mountlitera.com';
$header_connect_phone   = ($header_connect_phone !== '' && $header_connect_phone !== null) ? $header_connect_phone : '+91 9672797979';
$header_social = is_array($header_social) ? $header_social : array();
if (empty($header_social)) {
    $header_social = array(
        array('icon' => 'instagram', 'link' => array('url' => '#', 'title' => 'Instagram', 'target' => '')),
        array('icon' => 'twitter', 'link' => array('url' => '#', 'title' => 'Twitter', 'target' => '')),
        array('icon' => 'linkedin', 'link' => array('url' => '#', 'title' => 'LinkedIn', 'target' => '')),
    );
}

function mlzs_header_menu_level( $items, $depth = 0 ) {
    if (empty($items) || !is_array($items)) return;
    $depth = (int) $depth;
    $text_class = array(
        0 => 'font-[\'Playfair_Display\',serif] text-3xl sm:text-4xl md:text-5xl',
        1 => 'font-[\'Playfair_Display\',serif] text-xl sm:text-2xl md:text-3xl text-gray-300',
        2 => 'font-[\'Playfair_Display\',serif] text-xl sm:text-2xl md:text-3xl text-gray-300',
        3 => 'text-base sm:text-lg text-gray-500',
        4 => 'text-base sm:text-lg text-gray-500',
    );
    $wrap_class = array( 0 => 'space-y-3 sm:space-y-4', 1 => 'space-y-2 pl-4 sm:pl-6 mt-2 border-l border-white/20 ml-2', 2 => 'space-y-2 pl-4 mt-2 border-l border-white/20 ml-2', 3 => 'space-y-2 pl-4 mt-2 border-l border-white/20 ml-2', 4 => '' );
    $li_class = $depth === 0 ? 'overflow-hidden menu-item' : 'overflow-hidden';
    $arrow_sizes = array( 0 => 'w-6 h-6 sm:w-7 sm:h-7', 1 => 'w-5 h-5', 2 => 'w-4 h-4', 3 => 'w-4 h-4', 4 => 'w-4 h-4' );
    foreach ($items as $item) {
        $link = isset($item['link']) && is_array($item['link']) ? $item['link'] : array('url' => '#', 'title' => '', 'target' => '');
        $url   = isset($link['url']) && (string) $link['url'] !== '' ? (string) $link['url'] : '#';
        $title = isset($link['title']) ? (string) $link['title'] : '';
        if ($title === '') continue;
        $target = isset($link['target']) && (string) $link['target'] !== '' ? (string) $link['target'] : '';
        $target_attr = $target !== '' ? ' target="' . esc_attr($target) . '"' : '';
        $children = isset($item['children']) && is_array($item['children']) ? $item['children'] : array();
        $has_children = !empty($children) && $depth < 4;
        $tc = $text_class[$depth] ?? $text_class[4];
        $ac = $arrow_sizes[$depth] ?? 'w-4 h-4';
        if ($has_children) {
            echo '<li class="' . esc_attr($li_class) . ' has-submenu">';
            echo '<div class="menu-row flex items-center justify-between gap-4 w-full cursor-pointer ' . esc_attr($tc) . ' hover:italic hover:text-accent transition-all duration-300" data-toggle-submenu>';
            echo '<a href="' . esc_url($url) . '" class="flex-1 min-w-0 menu-link block hover:italic hover:text-accent transition-all transform hover:translate-x-2 sm:hover:translate-x-4 duration-300"' . $target_attr . '>' . esc_html($title) . '</a>';
            echo '<button type="button" class="menu-arrow-btn flex-shrink-0 w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded bg-white/10 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-accent" aria-expanded="false" aria-label="Toggle ' . esc_attr($title) . ' submenu">';
            echo '<span class="menu-arrow down-arrow transition-transform duration-300"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg></span></button></div>';
            echo '<ul class="menu-sub ' . esc_attr($wrap_class[$depth + 1] ?? '') . '">';
            mlzs_header_menu_level($children, $depth + 1);
            echo '</ul></li>';
        } else {
            echo '<li class="' . esc_attr($li_class) . '">';
            echo '<a href="' . esc_url($url) . '" class="menu-link flex items-center justify-between gap-4 w-full group/link ' . esc_attr($tc) . ' hover:italic hover:text-accent transition-all duration-300"' . $target_attr . '>';
            echo '<span class="block transition-transform duration-300 group-hover/link:translate-x-2 sm:group-hover/link:translate-x-4">' . esc_html($title) . '</span>';
            echo '<span class="menu-arrow flex-shrink-0 ' . esc_attr($ac) . ' opacity-70 group-hover/link:opacity-100 transition-all duration-300" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg></span></a></li>';
        }
    }
}
?>

<!-- Header Section -->
<header id="main-header" class="fixed w-full top-0 z-40 transition-all duration-500 ease-in-out h-24 text-white flex items-center border-b border-white/10 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-7xl mx-auto h-full relative flex justify-between items-center">

        <!-- LEFT MENU ITEMS (Desktop) max 3 -->
        <nav class="hidden lg:flex items-center justify-start w-5/12 pr-12 space-x-8">
            <?php foreach (array_slice($header_left_menu, 0, 3) as $item) :
                $link = isset($item['link']) && is_array($item['link']) ? $item['link'] : array('url' => '#', 'title' => '', 'target' => '');
                $url = isset($link['url']) && (string) $link['url'] !== '' ? (string) $link['url'] : '#';
                $title = isset($link['title']) ? (string) $link['title'] : '';
                if ($title === '') continue;
                $target = isset($link['target']) && (string) $link['target'] !== '' ? ' target="' . esc_attr((string) $link['target']) . '"' : '';
            ?>
            <a href="<?php echo esc_url($url); ?>" class="relative text-sm font-medium tracking-wide uppercase transition-colors after:content-[''] after:absolute after:w-0 after:h-px after:bottom-0 after:left-0 after:bg-current after:transition-all after:duration-300 hover:after:w-full"<?php echo $target; ?>><?php echo esc_html($title); ?></a>
            <?php endforeach; ?>
        </nav>

        <!-- LOGO -->
        <div class="lg:absolute lg:left-1/2 lg:top-1/2 lg:transform lg:-translate-x-1/2 lg:-translate-y-1/2 lg:text-center lg:z-50">
            <a href="<?php echo esc_url($home_url); ?>" id="brand-logo" class="transition-all duration-500 flex items-center justify-center">
                <img src="<?php echo esc_url( (string) $header_logo_url ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') . ' - ' . get_bloginfo('description') ); ?>" class="h-10 sm:h-12 md:h-14 lg:h-16 w-auto object-contain transition-all duration-500 brightness-0 invert">
            </a>
        </div>

        <!-- RIGHT MENU ITEMS (Desktop) max 2 -->
        <nav class="hidden lg:flex items-center justify-end w-5/12 pl-12 space-x-8">
            <?php foreach (array_slice($header_right_menu, 0, 2) as $item) :
                $link = isset($item['link']) && is_array($item['link']) ? $item['link'] : array('url' => '#', 'title' => '', 'target' => '');
                $url = isset($link['url']) && (string) $link['url'] !== '' ? (string) $link['url'] : '#';
                $title = isset($link['title']) ? (string) $link['title'] : '';
                if ($title === '') continue;
                $target = isset($link['target']) && (string) $link['target'] !== '' ? ' target="' . esc_attr((string) $link['target']) . '"' : '';
            ?>
            <a href="<?php echo esc_url($url); ?>" class="relative text-sm font-medium tracking-wide uppercase transition-colors after:content-[''] after:absolute after:w-0 after:h-px after:bottom-0 after:left-0 after:bg-current after:transition-all after:duration-300 hover:after:w-full"<?php echo $target; ?>><?php echo esc_html($title); ?></a>
            <?php endforeach; ?>
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
                <ul class="space-y-3 sm:space-y-4 menu-root">
                    <?php mlzs_header_menu_level($header_full_menu, 0); ?>
                </ul>
            </div>
            <div class="flex flex-col justify-between space-y-8 sm:space-y-10 mt-8 md:mt-0 md:pl-20 md:border-l border-white/10">
                <div>
                    <h3 class="text-xs font-bold tracking-[0.2em] text-gray-500 mb-4 sm:mb-6 uppercase">Quick Actions</h3>
                    <ul class="space-y-3 sm:space-y-4">
                        <?php foreach ($header_quick_actions as $qa) :
                            $qa_link = isset($qa['link']) && is_array($qa['link']) ? $qa['link'] : array('url' => '#', 'title' => '', 'target' => '');
                            $qa_url = isset($qa_link['url']) && (string) $qa_link['url'] !== '' ? (string) $qa_link['url'] : '#';
                            $qa_title = isset($qa_link['title']) ? (string) $qa_link['title'] : '';
                            if ($qa_title === '') continue;
                            $qa_target = isset($qa_link['target']) && (string) $qa_link['target'] !== '' ? ' target="' . esc_attr((string) $qa_link['target']) . '"' : '';
                        ?>
                        <li><a href="<?php echo esc_url($qa_url); ?>" class="flex items-center gap-3 text-base sm:text-lg text-gray-300 hover:text-accent transition-colors group"<?php echo $qa_target; ?>><span class="w-1 h-5 sm:h-6 bg-primary/40 group-hover:bg-accent transition-colors"></span><span><?php echo esc_html($qa_title); ?></span></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xs font-bold tracking-[0.2em] text-gray-500 mb-3 sm:mb-4 uppercase"><?php echo esc_html( (string) $header_connect_heading ); ?></h3>
                    <p class="text-gray-400 mb-4 text-xs sm:text-sm font-light"><?php echo esc_html( (string) $header_connect_email ); ?> <br> <?php echo esc_html( (string) $header_connect_phone ); ?></p>
                    <div class="flex gap-3 sm:gap-4">
                        <?php foreach ($header_social as $s) :
                            $s_icon  = isset($s['icon']) && trim((string) $s['icon']) !== '' ? trim((string) $s['icon']) : 'circle';
                            $s_link  = isset($s['link']) && is_array($s['link']) ? $s['link'] : array('url' => '#', 'title' => $s_icon, 'target' => '');
                            $s_url   = isset($s_link['url']) && (string) $s_link['url'] !== '' ? (string) $s_link['url'] : '#';
                            $s_label = isset($s_link['title']) && (string) $s_link['title'] !== '' ? (string) $s_link['title'] : $s_icon;
                            $s_target = isset($s_link['target']) && (string) $s_link['target'] !== '' ? ' target="' . esc_attr((string) $s_link['target']) . '"' : '';
                        ?>
                        <a href="<?php echo esc_url($s_url); ?>" class="w-9 h-9 sm:w-10 sm:h-10 border border-primary/40 rounded-full flex items-center justify-center hover:bg-accent hover:text-white hover:border-accent transition-all"<?php echo $s_target; ?> aria-label="<?php echo esc_attr($s_label); ?>"><i data-lucide="<?php echo esc_attr($s_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
