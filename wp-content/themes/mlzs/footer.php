<?php
$theme_uri = get_template_directory_uri();
$home_url  = home_url('/');

// Footer: ACF Options (site-wide). Fallbacks if ACF inactive or empty.
$opt = function_exists('get_field') ? true : false;
$footer_contact_badge       = $opt ? get_field('footer_contact_badge', 'option') : null;
$footer_contact_heading     = $opt ? get_field('footer_contact_heading', 'option') : null;
$footer_contact_description = $opt ? get_field('footer_contact_description', 'option') : null;
$footer_contact_email       = $opt ? get_field('footer_contact_email', 'option') : null;
$footer_contact_phone       = $opt ? get_field('footer_contact_phone', 'option') : null;
$footer_logo_url            = $opt ? get_field('footer_logo', 'option') : null;
$footer_tagline             = $opt ? get_field('footer_tagline', 'option') : null;
$footer_address_heading     = $opt ? get_field('footer_address_heading', 'option') : null;
$footer_address_text        = $opt ? get_field('footer_address_text', 'option') : null;
$footer_menu_heading        = $opt ? get_field('footer_menu_heading', 'option') : null;
$footer_menu_links          = $opt ? get_field('footer_menu_links', 'option') : null;
$footer_links_heading       = $opt ? get_field('footer_links_heading', 'option') : null;
$footer_links               = $opt ? get_field('footer_links', 'option') : null;
$footer_contact_col_heading = $opt ? get_field('footer_contact_col_heading', 'option') : null;
$footer_copyright           = $opt ? get_field('footer_copyright', 'option') : null;
$footer_developer_text      = $opt ? get_field('footer_developer_text', 'option') : null;
$footer_developer_image     = $opt ? get_field('footer_developer_image', 'option') : null;
$footer_social              = $opt ? get_field('footer_social', 'option') : null;

$footer_contact_badge       = ($footer_contact_badge !== '' && $footer_contact_badge !== null) ? $footer_contact_badge : 'Contact Us';
$footer_contact_heading     = ($footer_contact_heading !== '' && $footer_contact_heading !== null) ? $footer_contact_heading : 'Get In Touch';
$footer_contact_description = ($footer_contact_description !== '' && $footer_contact_description !== null) ? $footer_contact_description : "Have questions about admissions, programs, or campus life? We're here to help. Reach out to us and we'll get back to you soon.";
$footer_contact_email       = ($footer_contact_email !== '' && $footer_contact_email !== null) ? $footer_contact_email : 'mlzs.alwar@mountlitera.com';
$footer_contact_phone       = ($footer_contact_phone !== '' && $footer_contact_phone !== null) ? $footer_contact_phone : '+91 9672797979';
$footer_logo_url            = (is_array($footer_logo_url) && !empty($footer_logo_url['url'])) ? $footer_logo_url['url'] : (is_string($footer_logo_url) && $footer_logo_url !== '' ? $footer_logo_url : '');
$footer_tagline             = ($footer_tagline !== '' && $footer_tagline !== null) ? $footer_tagline : 'Empowering the next generation of leaders through excellence in education, innovation, and character building.';
$footer_address_heading     = ($footer_address_heading !== '' && $footer_address_heading !== null) ? $footer_address_heading : 'Campus Address';
$footer_address_text        = ($footer_address_text !== '' && $footer_address_text !== null) ? $footer_address_text : '6th Milestone, Jharkheda, Sirmoli Village Road, Alwar - Bhiwadi State Highway, Alwar - 301028 (Raj.)';
$footer_menu_heading        = ($footer_menu_heading !== '' && $footer_menu_heading !== null) ? $footer_menu_heading : 'Menu';
$footer_links_heading       = ($footer_links_heading !== '' && $footer_links_heading !== null) ? $footer_links_heading : 'Links';
$footer_contact_col_heading = ($footer_contact_col_heading !== '' && $footer_contact_col_heading !== null) ? $footer_contact_col_heading : 'Contact Us';
$footer_copyright           = ($footer_copyright !== '' && $footer_copyright !== null) ? $footer_copyright : 'Mount Litera Zee School, Alwar. All rights reserved.';
$footer_developer_text      = ($footer_developer_text !== '' && $footer_developer_text !== null) ? $footer_developer_text : 'Design & Developed By';
$footer_developer_image     = (is_array($footer_developer_image) && !empty($footer_developer_image['url'])) ? $footer_developer_image['url'] : (is_string($footer_developer_image) && $footer_developer_image !== '' ? $footer_developer_image : $theme_uri . '/assets/img/img.png');

$default_menu_links = array(
    array('link' => array('url' => (string) $home_url . '#about', 'title' => 'About Us', 'target' => '')),
    array('link' => array('url' => (string) $home_url . '#litera-experience', 'title' => 'Litera Experience', 'target' => '')),
    array('link' => array('url' => (string) $home_url . '#school-timing', 'title' => 'School Timing', 'target' => '')),
    array('link' => array('url' => (string) $home_url . '#academic-planner', 'title' => 'Academic Planner', 'target' => '')),
);
$default_footer_links = array(
    array('link' => array('url' => (string) $home_url . '#gallery', 'title' => 'Gallery', 'target' => '')),
    array('link' => array('url' => (string) $home_url . '#cbse', 'title' => 'CBSE Mandate', 'target' => '')),
    array('link' => array('url' => (string) $home_url . '#alumni', 'title' => 'Alumni Network', 'target' => '')),
    array('link' => array('url' => (string) $home_url . '#careers', 'title' => 'Careers', 'target' => '')),
);
$default_social = array(
    array('icon' => 'instagram', 'link' => array('url' => '#', 'title' => 'Instagram', 'target' => '')),
    array('icon' => 'linkedin', 'link' => array('url' => '#', 'title' => 'LinkedIn', 'target' => '')),
    array('icon' => 'twitter', 'link' => array('url' => '#', 'title' => 'Twitter', 'target' => '')),
    array('icon' => 'facebook', 'link' => array('url' => '#', 'title' => 'Facebook', 'target' => '')),
);
if (!is_array($footer_menu_links) || empty($footer_menu_links)) $footer_menu_links = $default_menu_links;
if (!is_array($footer_links) || empty($footer_links)) $footer_links = $default_footer_links;
if (!is_array($footer_social) || empty($footer_social)) $footer_social = $default_social;
?>
<!-- Footer Section -->
<footer class="relative w-full bg-slate-900 text-white px-4 sm:px-6 lg:px-8 pt-16 md:pt-24 lg:pt-32 pb-8 rounded-t-[40px] overflow-hidden border-t border-primary/30 shadow-[0_-10px_40px_rgba(61,52,139,0.1)] -mt-1">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-dark via-slate-900 to-slate-950 opacity-95 z-0"></div>
    <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-primary/10 rounded-full blur-[120px] pointer-events-none z-0 mix-blend-screen"></div>
    <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-accent/5 rounded-full blur-[100px] pointer-events-none z-0 mix-blend-screen"></div>
    <div class="layout-container flex flex-col max-w-7xl mx-auto w-full relative z-10">
        <div class="mb-20 rounded-3xl p-8 lg:p-12 relative overflow-hidden group bg-gradient-to-r from-primary-dark via-slate-900 to-primary-dark border border-primary/40 shadow-2xl">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-20"></div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start relative z-10">
                <div class="flex flex-col gap-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/20 border border-primary/30 w-fit backdrop-blur-sm">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-accent"></span>
                        </span>
                        <span class="text-xs font-bold text-accent uppercase tracking-widest"><?php echo esc_html( (string) $footer_contact_badge ); ?></span>
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight text-white"><?php echo esc_html( (string) $footer_contact_heading ); ?></h2>
                    <p class="text-slate-300 text-lg max-w-md font-light"><?php echo esc_html( (string) $footer_contact_description ); ?></p>
                    <div class="flex flex-col gap-4 mt-4">
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-primary/10 border border-primary/30 hover:border-accent/50 transition-all group">
                            <div class="p-2 rounded-lg bg-accent/20 group-hover:bg-accent/30 transition-colors">
                                <i data-lucide="mail" class="w-5 h-5 text-accent"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 uppercase tracking-wide">Email</p>
                                <a class="text-white font-medium hover:text-accent transition-colors" href="mailto:<?php echo esc_attr( (string) $footer_contact_email ); ?>"><?php echo esc_html( (string) $footer_contact_email ); ?></a>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-primary/10 border border-primary/30 hover:border-accent/50 transition-all group">
                            <div class="p-2 rounded-lg bg-accent/20 group-hover:bg-accent/30 transition-colors">
                                <i data-lucide="phone" class="w-5 h-5 text-accent"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 uppercase tracking-wide">Phone</p>
                                <a class="text-white font-medium hover:text-accent transition-colors" href="tel:<?php echo esc_attr( preg_replace('/\s+/', '', (string) $footer_contact_phone ) ); ?>"><?php echo esc_html( (string) $footer_contact_phone ); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-start lg:justify-end w-full">
                    <form class="w-full max-w-lg flex flex-col gap-4" method="post" action="<?php echo esc_url($home_url); ?>">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="relative group/input">
                                <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 size-5 text-slate-400 group-focus-within/input:text-accent transition-colors z-10"></i>
                                <input class="w-full bg-primary/20 border border-primary/40 rounded-xl pl-12 pr-4 py-3.5 text-white placeholder-gray-400 focus:ring-2 focus:ring-accent/50 focus:border-accent transition-all duration-300 shadow-inner" placeholder="Your Name" type="text" name="contact_name" required/>
                            </div>
                            <div class="relative group/input">
                                <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 size-5 text-slate-400 group-focus-within/input:text-accent transition-colors z-10"></i>
                                <input class="w-full bg-primary/20 border border-primary/40 rounded-xl pl-12 pr-4 py-3.5 text-white placeholder-gray-400 focus:ring-2 focus:ring-accent/50 focus:border-accent transition-all duration-300 shadow-inner" placeholder="Your Email" type="email" name="contact_email" required/>
                            </div>
                        </div>
                        <div class="relative group/input">
                            <i data-lucide="phone" class="absolute left-4 top-1/2 -translate-y-1/2 size-5 text-slate-400 group-focus-within/input:text-accent transition-colors z-10"></i>
                            <input class="w-full bg-primary/20 border border-primary/40 rounded-xl pl-12 pr-4 py-3.5 text-white placeholder-gray-400 focus:ring-2 focus:ring-accent/50 focus:border-accent transition-all duration-300 shadow-inner" placeholder="Phone Number (Optional)" type="tel" name="contact_phone"/>
                        </div>
                        <div class="relative group/input">
                            <i data-lucide="message-square" class="absolute left-4 top-4 size-5 text-slate-400 group-focus-within/input:text-accent transition-colors z-10"></i>
                            <textarea class="w-full bg-primary/20 border border-primary/40 rounded-xl pl-12 pr-4 py-3.5 text-white placeholder-gray-400 focus:ring-2 focus:ring-accent/50 focus:border-accent transition-all duration-300 shadow-inner resize-none min-h-[120px]" placeholder="Your Message" name="contact_message" required></textarea>
                        </div>
                        <button class="w-full bg-primary hover:bg-primary-dark text-white font-bold text-base px-8 py-4 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 shadow-[0_4px_14px_0_rgba(61,52,139,0.39)] hover:shadow-[0_6px_20px_rgba(61,52,139,0.23)] hover:-translate-y-0.5 active:translate-y-0 group/btn" type="submit">
                            <span>Send Message</span>
                            <i data-lucide="send" class="size-5 group-hover/btn:translate-x-1 transition-transform"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 lg:gap-8 mb-16">
            <div class="lg:col-span-4 flex flex-col gap-8 pr-4">
                <div class="flex items-center gap-4">
                    <a href="<?php echo esc_url($home_url); ?>" class="flex items-center">
                        <?php
                        $logo_src = $footer_logo_url !== '' ? $footer_logo_url : $theme_uri . '/assets/img/logo.webp';
                        ?>
                        <img src="<?php echo esc_url( (string) $logo_src ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>" class="h-12 md:h-14 w-auto object-contain brightness-0 invert">
                    </a>
                </div>
                <p class="text-slate-400 text-sm leading-7">
                    <?php echo esc_html( (string) $footer_tagline ); ?>
                </p>
                <div class="flex items-start gap-4 p-5 rounded-2xl bg-primary/10 border border-primary/30 hover:border-accent/50 transition-colors group cursor-default">
                    <div class="mt-1">
                        <i data-lucide="map-pin" class="w-6 h-6 text-accent group-hover:scale-110 transition-transform duration-300"></i>
                    </div>
                    <div>
                        <h3 class="text-white text-sm font-bold uppercase tracking-wide mb-1 group-hover:text-accent transition-colors"><?php echo esc_html( (string) $footer_address_heading ); ?></h3>
                        <p class="text-slate-400 text-sm leading-snug"><?php echo esc_html( (string) $footer_address_text ); ?></p>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-2 lg:col-start-6">
                <h3 class="text-white text-sm font-bold uppercase tracking-widest mb-6 flex items-center gap-2">
                    <span class="w-1 h-4 bg-accent rounded-full"></span>
                    <?php echo esc_html( (string) $footer_menu_heading ); ?>
                </h3>
                <ul class="flex flex-col gap-3">
                    <?php foreach ($footer_menu_links as $item) :
                        $m_link = isset($item['link']) && is_array($item['link']) ? $item['link'] : array('url' => '#', 'title' => '', 'target' => '');
                        $m_url   = isset($m_link['url']) && (string) $m_link['url'] !== '' ? (string) $m_link['url'] : '#';
                        $m_title = isset($m_link['title']) ? (string) $m_link['title'] : '';
                        if ($m_title === '') continue;
                        $m_target = isset($m_link['target']) && (string) $m_link['target'] !== '' ? (string) $m_link['target'] : '';
                    ?>
                    <li><a class="text-slate-400 hover:text-accent hover:translate-x-1 transition-all duration-300 inline-flex items-center gap-2 text-sm font-medium" href="<?php echo esc_url( $m_url ); ?>"<?php echo $m_target !== '' ? ' target="' . esc_attr( $m_target ) . '"' : ''; ?>><span class="w-1 h-1 rounded-full bg-accent opacity-0 hover:opacity-100 transition-opacity"></span><?php echo esc_html( $m_title ); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="lg:col-span-2">
                <h3 class="text-white text-sm font-bold uppercase tracking-widest mb-6 flex items-center gap-2">
                    <span class="w-1 h-4 bg-accent rounded-full"></span>
                    <?php echo esc_html( (string) $footer_links_heading ); ?>
                </h3>
                <ul class="flex flex-col gap-3">
                    <?php foreach ($footer_links as $item) :
                        $l_link  = isset($item['link']) && is_array($item['link']) ? $item['link'] : array('url' => '#', 'title' => '', 'target' => '');
                        $l_url   = isset($l_link['url']) && (string) $l_link['url'] !== '' ? (string) $l_link['url'] : '#';
                        $l_title = isset($l_link['title']) ? (string) $l_link['title'] : '';
                        if ($l_title === '') continue;
                        $l_target = isset($l_link['target']) && (string) $l_link['target'] !== '' ? (string) $l_link['target'] : '';
                    ?>
                    <li><a class="text-slate-400 hover:text-accent hover:translate-x-1 transition-all duration-300 inline-flex items-center gap-2 text-sm font-medium" href="<?php echo esc_url( $l_url ); ?>"<?php echo $l_target !== '' ? ' target="' . esc_attr( $l_target ) . '"' : ''; ?>><span class="w-1 h-1 rounded-full bg-accent opacity-0 hover:opacity-100 transition-opacity"></span><?php echo esc_html( $l_title ); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="lg:col-span-3">
                <h3 class="text-white text-sm font-bold uppercase tracking-widest mb-6 flex items-center gap-2">
                    <span class="w-1 h-4 bg-accent rounded-full"></span>
                    <?php echo esc_html( (string) $footer_contact_col_heading ); ?>
                </h3>
                <div class="flex flex-col gap-5">
                    <div class="flex items-center gap-4 group cursor-pointer">
                        <div class="w-14 h-14 rounded-full shrink-0 bg-white/5 border border-white/10 flex items-center justify-center text-accent group-hover:bg-primary group-hover:text-white group-hover:border-primary transition-all duration-300 shadow-lg group-hover:shadow-primary/40">
                            <i data-lucide="phone" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">Phone</p>
                            <a class="text-white font-semibold text-lg hover:text-accent transition-colors" href="tel:<?php echo esc_attr( preg_replace('/\s+/', '', (string) $footer_contact_phone ) ); ?>"><?php echo esc_html( (string) $footer_contact_phone ); ?></a>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 group cursor-pointer">
                        <div class="w-14 h-14 rounded-full shrink-0 bg-white/5 border border-white/10 flex items-center justify-center text-accent group-hover:bg-primary group-hover:text-white group-hover:border-primary transition-all duration-300 shadow-lg group-hover:shadow-primary/40">
                            <i data-lucide="mail" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">Email Address</p>
                            <a class="text-white font-semibold text-lg hover:text-accent transition-colors" href="mailto:<?php echo esc_attr( (string) $footer_contact_email ); ?>"><?php echo esc_html( (string) $footer_contact_email ); ?></a>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 group cursor-pointer mt-4">
                        <div class="w-14 h-14 rounded-full shrink-0 bg-white/5 border border-white/10 flex items-center justify-center text-accent group-hover:bg-primary group-hover:text-white group-hover:border-primary transition-all duration-300 shadow-lg group-hover:shadow-primary/40">
                            <i data-lucide="map-pin" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">Campus</p>
                            <p class="text-white font-semibold text-sm leading-relaxed"><?php echo esc_html( (string) $footer_address_text ); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-t border-primary/30 pt-8 flex flex-col-reverse md:flex-row justify-between items-center gap-6">
            <div class="text-center md:text-left">
                <p class="text-slate-500 text-sm">
                    Copyright &copy; <?php echo esc_html( date('Y') ); ?> <?php echo esc_html( (string) $footer_copyright ); ?>
                </p>
                <div class="flex items-center justify-center md:justify-start gap-2 mt-2">
                    <span class="text-slate-500 text-sm"><?php echo esc_html( (string) $footer_developer_text ); ?></span>
                    <img src="<?php echo esc_url( (string) $footer_developer_image ); ?>" alt="Developer" class="h-6 w-auto object-contain">
                </div>
            </div>
            <div class="flex items-center gap-3">
                <?php foreach ($footer_social as $s) :
                    $s_icon  = isset($s['icon']) && trim((string) $s['icon']) !== '' ? trim((string) $s['icon']) : 'circle';
                    $s_link  = isset($s['link']) && is_array($s['link']) ? $s['link'] : array('url' => '#', 'title' => $s_icon, 'target' => '');
                    $s_url   = isset($s_link['url']) && (string) $s_link['url'] !== '' ? (string) $s_link['url'] : '#';
                    $s_label = isset($s_link['title']) && (string) $s_link['title'] !== '' ? (string) $s_link['title'] : $s_icon;
                    $s_target = isset($s_link['target']) && (string) $s_link['target'] !== '' ? (string) $s_link['target'] : '';
                ?>
                <a class="w-10 h-10 rounded-full border border-primary/40 bg-primary/20 flex items-center justify-center text-gray-300 hover:bg-accent hover:text-white hover:border-accent hover:-translate-y-1 transition-all duration-300" href="<?php echo esc_url( $s_url ); ?>"<?php echo $s_target !== '' ? ' target="' . esc_attr( $s_target ) . '"' : ''; ?> aria-label="<?php echo esc_attr( $s_label ); ?>"><i data-lucide="<?php echo esc_attr( $s_icon ); ?>" class="size-5"></i></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
