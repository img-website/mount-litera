<?php
/**
 * Template Name: Reach Us Page
 * Reach: Hero, Contact & Location, Quick Actions, Map, Transportation – ACF dynamic
 */
if (!defined('ABSPATH')) exit;
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge = $opt ? get_field('reach_hero_badge', $page_id) : null;
$hero_headline = $opt ? get_field('reach_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('reach_hero_highlight', $page_id) : null;
$hero_subtext = $opt ? get_field('reach_hero_subtext', $page_id) : null;
$hero_badge = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Get in Touch';
$hero_headline = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'Reach';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Us';
$hero_subtext = ($hero_subtext !== '' && $hero_subtext !== null) ? (string) $hero_subtext : 'Connect with us at our campus or city offices. We\'re here to assist you with admissions, queries, and more.';

// ——— Contact ———
$reach_bg_image = $opt ? get_field('reach_bg_image', $page_id) : null;
$campus_title = $opt ? get_field('reach_campus_title', $page_id) : null;
$campus_address = $opt ? get_field('reach_campus_address', $page_id) : null;
$campus_phone = $opt ? get_field('reach_campus_phone', $page_id) : null;
$campus_emails = $opt ? get_field('reach_campus_emails', $page_id) : null;
$city_offices = $opt ? get_field('reach_city_offices', $page_id) : null;
$campus_title = ($campus_title !== '' && $campus_title !== null) ? (string) $campus_title : 'Main Campus';
$campus_address = ($campus_address !== '' && $campus_address !== null) ? (string) $campus_address : "6th Mile, Sirmoli Village Road, Jahar Khera,\nAlwar-Bhiwadi State Highway,\nAlwar (Raj.) - 301028";
$campus_phone = ($campus_phone !== '' && $campus_phone !== null) ? (string) $campus_phone : '+91 9672797979';
$campus_emails = ($campus_emails !== '' && $campus_emails !== null) ? (string) $campus_emails : "zeeschool.alw2k@gmail.com\nmlzs.alwar@mountlitera.com";
$default_offices = array(
    array('title' => 'City Office - Moti Doongri', 'icon' => 'building', 'style' => 'accent', 'address' => "3, Moti Doongri\nAlwar - 301001", 'phone' => '+91 7665321781', 'emails' => ''),
    array('title' => 'City Office - Surya Nagar', 'icon' => 'building-2', 'style' => 'primary-light', 'address' => "B-3, Surya Nagar\nAlwar - 301001", 'phone' => '+91 7665009690', 'emails' => "kidzee385@kidzee.com\nprincipal@mlzsalwar.ac.in"),
);
$city_offices = (is_array($city_offices) && count($city_offices) >= 2) ? $city_offices : $default_offices;

$reach_bg_url = '';
if (!empty($reach_bg_image) && is_array($reach_bg_image) && !empty($reach_bg_image['url'])) $reach_bg_url = $reach_bg_image['url'];
if ($reach_bg_url === '') $reach_bg_url = 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2070&auto=format&fit=crop';

// ——— Quick cards ———
$quick_cards = $opt ? get_field('reach_quick_cards', $page_id) : null;
$default_qc = array(
    array('icon' => 'phone-call', 'title' => 'Call Us', 'subtext' => 'Speak directly with our team', 'link' => array('url' => 'tel:+919672797979', 'title' => '+91 9672797979'), 'style' => 'primary'),
    array('icon' => 'calendar', 'title' => 'Schedule Visit', 'subtext' => 'Book campus tour', 'link' => array('url' => '#', 'title' => 'Book Now →'), 'style' => 'accent'),
    array('icon' => 'mail', 'title' => 'Email Us', 'subtext' => 'Get quick response', 'link' => array('url' => 'mailto:mlzs.alwar@mountlitera.com', 'title' => 'Send Email'), 'style' => 'primary-light'),
    array('icon' => 'clock', 'title' => 'Office Hours', 'subtext' => 'Mon-Sat: 9:00 AM - 5:00 PM', 'link' => array(), 'style' => 'accent-dark'),
);
$quick_cards = (is_array($quick_cards) && count($quick_cards) >= 4) ? $quick_cards : $default_qc;

// ——— Map (ACF Google Map: embed + directions + address bar auto from one field) ———
$map_heading = $opt ? get_field('reach_map_heading', $page_id) : null;
$map_subtext = $opt ? get_field('reach_map_subtext', $page_id) : null;
$reach_map = $opt ? get_field('reach_map', $page_id) : null;
$map_heading = ($map_heading !== '' && $map_heading !== null) ? (string) $map_heading : 'View on Map';
$map_subtext = ($map_subtext !== '' && $map_subtext !== null) ? (string) $map_subtext : 'Find our campus location easily. Click for directions.';
$map_lat = isset($reach_map['lat']) && $reach_map['lat'] !== '' ? (string) $reach_map['lat'] : '27.6371647';
$map_lng = isset($reach_map['lng']) && $reach_map['lng'] !== '' ? (string) $reach_map['lng'] : '76.6359878';
$map_zoom = isset($reach_map['zoom']) && $reach_map['zoom'] !== '' ? (int) $reach_map['zoom'] : 15;
$map_address = isset($reach_map['address']) && $reach_map['address'] !== '' ? (string) $reach_map['address'] : '6th Mile, Sirmoli Village Road, Jahar Khera, Alwar-Bhiwadi State Highway, Alwar (RAJ.)';
$map_embed = 'https://maps.google.com/maps?q=' . $map_lat . ',' . $map_lng . '&z=' . (int) $map_zoom . '&output=embed';
$map_directions = 'https://www.google.com/maps/dir//' . $map_lat . ',' . $map_lng;

// ——— Transport ———
$transport = $opt ? get_field('reach_transport', $page_id) : null;
$default_transport = array(
    array('icon' => 'car', 'title' => 'By Car', 'paragraph' => 'Located on Alwar-Bhiwadi State Highway, 6th mile from city center. Ample parking available.', 'style' => 'primary'),
    array('icon' => 'bus', 'title' => 'By Bus', 'paragraph' => 'Regular bus services available from Alwar city center to Sirmoli Village Road.', 'style' => 'accent'),
    array('icon' => 'train', 'title' => 'By Train', 'paragraph' => 'Alwar Railway Station is 8 km from campus. Taxis and autos available from station.', 'style' => 'primary-light'),
);
$transport = (is_array($transport) && count($transport) >= 3) ? $transport : $default_transport;
?>
    <!-- Hero -->
    <section class="relative bg-gradient-to-br from-primary via-primary-dark to-slate-900 px-4 sm:px-6 lg:px-8 pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')]"></div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-accent/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="relative z-10 max-w-7xl mx-auto">
            <div class="text-center text-white">
                <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-white/20 backdrop-blur-md border border-white/30 mb-4 sm:mb-6 animate-fade-in-up">
                    <i data-lucide="map-pin" class="w-4 h-4 sm:w-5 sm:h-5 text-accent"></i>
                    <span class="text-xs sm:text-sm font-semibold uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold mb-4 sm:mb-6 tracking-tight">
                    <?php echo esc_html($hero_headline); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame to-tiger-orange"><?php echo esc_html($hero_highlight); ?></span>
                </h1>
                <p class="text-sm sm:text-base md:text-lg lg:text-xl text-slate-200 max-w-3xl mx-auto leading-relaxed"><?php echo esc_html($hero_subtext); ?></p>
            </div>
        </div>
    </section>

    <!-- Contact & Location -->
    <section class="relative px-4 sm:px-6 lg:px-8 py-12 sm:py-16 md:py-20 bg-background-light overflow-x-hidden">
        <div class="absolute top-0 left-0 -z-10 h-full w-full overflow-hidden">
            <div class="absolute -top-40 -right-40 h-[500px] w-[500px] rounded-full bg-indigo-velvet/5 blur-[100px]"></div>
            <div class="absolute top-1/2 -left-20 h-[300px] w-[300px] rounded-full bg-amber-flame/10 blur-[80px]"></div>
        </div>
        <div class="mx-auto max-w-7xl w-full">
            <div class="relative rounded-2xl sm:rounded-3xl overflow-hidden mb-10 sm:mb-12 md:mb-16 shadow-2xl">
                <div class="absolute inset-0">
                    <img src="<?php echo esc_url($reach_bg_url); ?>" alt="Campus" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-r from-primary/90 via-primary/80 to-primary/70"></div>
                </div>
                <div class="relative z-10 p-6 sm:p-8 md:p-12 lg:p-16">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                        <div class="bg-white/95 backdrop-blur-sm rounded-2xl p-6 sm:p-8 border border-white/30 shadow-2xl">
                            <div class="flex items-center gap-3 mb-4 sm:mb-6">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary to-primary-light flex items-center justify-center">
                                    <i data-lucide="school" class="w-6 h-6 text-white"></i>
                                </div>
                                <h2 class="text-base sm:text-lg md:text-xl font-bold text-primary"><?php echo esc_html($campus_title); ?></h2>
                            </div>
                            <div class="space-y-4 sm:space-y-6">
                                <div class="flex items-start gap-3 group cursor-pointer">
                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center shrink-0 group-hover:bg-primary group-hover:text-white transition-colors">
                                        <i data-lucide="map-pin" class="w-5 h-5 text-primary group-hover:text-white transition-transform duration-300 group-hover:scale-110"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-text-main-light mb-1">Address</h4>
                                        <p class="text-sm sm:text-base text-text-secondary-light"><?php echo nl2br(esc_html($campus_address)); ?></p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3 group cursor-pointer">
                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center shrink-0 group-hover:bg-primary group-hover:text-white transition-colors">
                                        <i data-lucide="phone" class="w-5 h-5 text-primary group-hover:text-white transition-transform duration-300 group-hover:scale-110"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-xs sm:text-sm font-bold text-text-main-light mb-1">Phone</h4>
                                        <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $campus_phone)); ?>" class="text-xs sm:text-sm text-text-secondary-light hover:text-primary transition-colors"><?php echo esc_html($campus_phone); ?></a>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3 group cursor-pointer">
                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center shrink-0 group-hover:bg-primary group-hover:text-white transition-colors">
                                        <i data-lucide="mail" class="w-5 h-5 text-primary group-hover:text-white transition-transform duration-300 group-hover:scale-110"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-xs sm:text-sm font-bold text-text-main-light mb-1">Email</h4>
                                        <div class="space-y-1"><?php foreach (array_filter(array_map('trim', explode("\n", $campus_emails))) as $em) : ?>
                                            <a href="mailto:<?php echo esc_attr($em); ?>" class="block text-xs sm:text-sm text-text-secondary-light hover:text-primary transition-colors"><?php echo esc_html($em); ?></a>
                                        <?php endforeach; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-6 sm:space-y-8">
                            <?php foreach ($city_offices as $off) :
                                $ot = isset($off['title']) ? (string) $off['title'] : '';
                                $oi = isset($off['icon']) ? trim((string) $off['icon']) : 'building';
                                $os = isset($off['style']) ? $off['style'] : 'accent';
                                $oa = isset($off['address']) ? (string) $off['address'] : '';
                                $op = isset($off['phone']) ? (string) $off['phone'] : '';
                                $oe = isset($off['emails']) ? (string) $off['emails'] : '';
                                $ograd = $os === 'primary-light' ? 'from-primary-light to-primary' : 'from-accent to-accent-dark';
                                $oicon = $os === 'primary-light' ? 'bg-primary-light/10' : 'bg-accent/10';
                                $oicontext = $os === 'primary-light' ? 'text-primary-light' : 'text-accent';
                            ?>
                            <div class="bg-white/95 backdrop-blur-sm rounded-2xl p-6 sm:p-8 border border-white/30 shadow-2xl">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br <?php echo esc_attr($ograd); ?> flex items-center justify-center">
                                        <i data-lucide="<?php echo esc_attr($oi); ?>" class="w-6 h-6 text-white"></i>
                                    </div>
                                    <h2 class="text-base sm:text-lg md:text-xl font-bold <?php echo esc_attr($oicontext); ?>"><?php echo esc_html($ot); ?></h2>
                                </div>
                                <div class="space-y-4">
                                    <?php
                                    $o_text = $os === 'primary-light' ? 'text-xs sm:text-sm' : 'text-sm sm:text-base';
                                    if ($oa !== '') : ?>
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-full <?php echo esc_attr($oicon); ?> flex items-center justify-center shrink-0">
                                            <i data-lucide="map-pin" class="w-4 h-4 <?php echo esc_attr($oicontext); ?>"></i>
                                        </div>
                                        <div>
                                            <p class="<?php echo esc_attr($o_text); ?> text-text-secondary-light"><?php echo nl2br(esc_html($oa)); ?></p>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if ($op !== '') : ?>
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-full <?php echo esc_attr($oicon); ?> flex items-center justify-center shrink-0">
                                            <i data-lucide="phone" class="w-4 h-4 <?php echo esc_attr($oicontext); ?>"></i>
                                        </div>
                                        <div>
                                            <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $op)); ?>" class="<?php echo esc_attr($o_text); ?> text-text-secondary-light hover:<?php echo esc_attr($oicontext); ?> transition-colors"><?php echo esc_html($op); ?></a>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if ($oe !== '') : $o_emails = array_filter(array_map('trim', explode("\n", $oe))); ?>
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-full <?php echo esc_attr($oicon); ?> flex items-center justify-center shrink-0">
                                            <i data-lucide="mail" class="w-4 h-4 <?php echo esc_attr($oicontext); ?>"></i>
                                        </div>
                                        <div>
                                            <div class="space-y-1">
                                                <?php foreach ($o_emails as $em) : ?>
                                                <a href="mailto:<?php echo esc_attr($em); ?>" class="block <?php echo esc_attr($o_text); ?> text-text-secondary-light hover:<?php echo esc_attr($oicontext); ?> transition-colors"><?php echo esc_html($em); ?></a>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Action Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-10 sm:mb-12 md:mb-16">
                <?php foreach ($quick_cards as $qc) :
                    $qc_icon = isset($qc['icon']) ? trim((string) $qc['icon']) : 'phone-call';
                    $qc_title = isset($qc['title']) ? (string) $qc['title'] : '';
                    $qc_sub = isset($qc['subtext']) ? (string) $qc['subtext'] : '';
                    $qc_link = isset($qc['link']) && is_array($qc['link']) ? $qc['link'] : array();
                    $qc_style = isset($qc['style']) ? $qc['style'] : 'primary';
                    $qc_url = !empty($qc_link['url']) ? esc_url($qc_link['url']) : '#';
                    $qc_text = !empty($qc_link['title']) ? (string) $qc_link['title'] : '';
                    $qc_bg = $qc_style === 'accent' ? 'bg-accent/10' : ($qc_style === 'primary-light' ? 'bg-primary-light/10' : ($qc_style === 'accent-dark' ? 'bg-accent-dark/10' : 'bg-primary/10'));
                    $qc_color = $qc_style === 'accent' ? 'text-accent' : ($qc_style === 'primary-light' ? 'text-primary-light' : ($qc_style === 'accent-dark' ? 'text-accent-dark' : 'text-primary'));
                    $qc_hover = $qc_style === 'accent' ? 'hover:border-accent/30' : ($qc_style === 'primary-light' ? 'hover:border-primary-light/30' : ($qc_style === 'accent-dark' ? 'hover:border-accent-dark/30' : 'hover:border-primary/30'));
                ?>
                <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 text-center shadow-soft border border-border-light <?php echo esc_attr($qc_hover); ?> hover:shadow-lg transition-all duration-300">
                    <div class="w-12 h-12 rounded-full <?php echo esc_attr($qc_bg); ?> flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="<?php echo esc_attr($qc_icon); ?>" class="w-6 h-6 <?php echo esc_attr($qc_color); ?>"></i>
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-text-main-light mb-2"><?php echo esc_html($qc_title); ?></h3>
                    <p class="text-xs sm:text-sm text-text-secondary-light mb-3"><?php echo esc_html($qc_sub); ?></p>
                    <?php if ($qc_text !== '') : ?>
                    <a href="<?php echo $qc_url; ?>" class="<?php echo esc_attr($qc_color); ?> font-medium text-sm hover:underline"><?php echo esc_html($qc_text); ?></a>
                    <?php else : ?>
                    <span class="<?php echo esc_attr($qc_color); ?> font-medium text-sm"><?php echo esc_html($qc_sub); ?></span>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Map -->
            <div class="bg-white rounded-2xl sm:rounded-3xl overflow-hidden shadow-2xl border border-border-light">
                <div class="p-6 sm:p-8 border-b border-border-light">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary to-primary-light flex items-center justify-center">
                            <i data-lucide="navigation" class="w-5 h-5 text-white"></i>
                        </div>
                        <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-text-main-light">
                            <?php
                            $map_heading_trim = trim($map_heading);
                            if (preg_match('/^(.+)\s+Map\s*$/i', $map_heading_trim, $m)) {
                                echo esc_html(trim($m[1])) . ' <span class="text-primary">Map</span>';
                            } else {
                                echo esc_html($map_heading_trim);
                            }
                            ?>
                        </h2>
                    </div>
                    <p class="text-xs sm:text-sm text-text-secondary-light"><?php echo esc_html($map_subtext); ?></p>
                </div>
                <div class="relative h-[300px] sm:h-[400px] md:h-[450px]">
                    <iframe src="<?php echo esc_url($map_embed); ?>" class="absolute inset-0 w-full h-full border-0 grayscale-[10%] contrast-[110%]" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Campus Location"></iframe>
                    <div class="absolute bottom-4 right-4 flex gap-2">
                        <button type="button" class="reach-get-directions px-3 sm:px-4 py-2 bg-primary text-white rounded-lg text-xs sm:text-sm font-medium hover:bg-primary-dark transition-colors flex items-center gap-2" data-dest-lat="<?php echo esc_attr($map_lat); ?>" data-dest-lng="<?php echo esc_attr($map_lng); ?>" data-dest-fallback="<?php echo esc_attr($map_directions); ?>">
                            <i data-lucide="navigation" class="w-3 h-3 sm:w-4 sm:h-4"></i> Get Directions
                        </button>
                    </div>
                </div>
                <div class="p-4 sm:p-6 bg-gradient-to-r from-primary/5 to-primary-light/5 border-t border-border-light">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <i data-lucide="map-pin" class="w-5 h-5 text-primary"></i>
                            <p class="text-sm sm:text-base text-text-secondary-light"><?php echo esc_html($map_address); ?></p>
                        </div>
                        <button type="button" data-copy-address="<?php echo esc_attr($map_address); ?>" class="reach-copy-address px-3 sm:px-4 py-2 bg-white border border-primary/30 text-primary rounded-lg text-xs sm:text-sm font-medium hover:bg-primary/5 transition-colors flex items-center gap-2 shrink-0">
                            <i data-lucide="copy" class="w-3 h-3 sm:w-4 sm:h-4"></i> Copy Address
                        </button>
                    </div>
                </div>
            </div>

            <!-- Transportation -->
            <div class="mt-8 sm:mt-10 grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
                <?php foreach ($transport as $t) :
                    $t_icon = isset($t['icon']) ? trim((string) $t['icon']) : 'car';
                    $t_title = isset($t['title']) ? (string) $t['title'] : '';
                    $t_para = isset($t['paragraph']) ? (string) $t['paragraph'] : '';
                    $t_style = isset($t['style']) ? $t['style'] : 'primary';
                    $t_gradient = $t_style === 'accent' ? 'from-accent/5 to-accent-dark/5' : ($t_style === 'primary-light' ? 'from-primary-light/5 to-primary/5' : 'from-primary/5 to-primary-light/5');
                    $t_border = $t_style === 'accent' ? 'border-accent/20' : ($t_style === 'primary-light' ? 'border-primary-light/20' : 'border-primary/20');
                    $t_icon_color = $t_style === 'accent' ? 'text-accent' : ($t_style === 'primary-light' ? 'text-primary-light' : 'text-primary');
                ?>
                <div class="bg-gradient-to-br <?php echo esc_attr($t_gradient); ?> rounded-xl sm:rounded-2xl p-4 sm:p-6 border <?php echo esc_attr($t_border); ?>">
                    <div class="flex items-center gap-3 mb-3">
                        <i data-lucide="<?php echo esc_attr($t_icon); ?>" class="w-6 h-6 <?php echo esc_attr($t_icon_color); ?>"></i>
                        <h3 class="text-base sm:text-lg font-bold text-text-main-light"><?php echo esc_html($t_title); ?></h3>
                    </div>
                    <p class="text-xs sm:text-sm text-text-secondary-light"><?php echo esc_html($t_para); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof lucide !== 'undefined' && lucide.createIcons) lucide.createIcons();

    // Copy address
    var btn = document.querySelector('.reach-copy-address');
    if (btn) {
        btn.addEventListener('click', function() {
            var address = btn.getAttribute('data-copy-address') || '';
            if (!address) return;
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(address).then(function() {
                    var orig = btn.innerHTML;
                    btn.innerHTML = '<i data-lucide="check" class="w-3 h-3 sm:w-4 sm:h-4"></i> Copied!';
                    btn.classList.remove('text-primary'); btn.classList.add('text-green-600');
                    if (typeof lucide !== 'undefined' && lucide.createIcons) lucide.createIcons();
                    setTimeout(function() { btn.innerHTML = orig; btn.classList.add('text-primary'); btn.classList.remove('text-green-600'); if (typeof lucide !== 'undefined' && lucide.createIcons) lucide.createIcons(); }, 2000);
                }).catch(function() {});
            }
        });
    }

    // Get Directions: use current location as origin, campus as destination
    var dirBtn = document.querySelector('.reach-get-directions');
    if (dirBtn) {
        dirBtn.addEventListener('click', function() {
            var destLat = dirBtn.getAttribute('data-dest-lat') || '';
            var destLng = dirBtn.getAttribute('data-dest-lng') || '';
            var fallback = dirBtn.getAttribute('data-dest-fallback') || '';
            var destUrl = 'https://www.google.com/maps/dir/?api=1&destination=' + encodeURIComponent(destLat + ',' + destLng) + '&travelmode=driving';
            if (!destLat || !destLng) {
                window.open(fallback || 'https://www.google.com/maps', '_blank', 'noopener');
                return;
            }
            if (!navigator.geolocation) {
                window.open(destUrl, '_blank', 'noopener');
                return;
            }
            var origText = dirBtn.innerHTML;
            dirBtn.disabled = true;
            dirBtn.innerHTML = '<i data-lucide="loader-2" class="w-3 h-3 sm:w-4 sm:h-4 animate-spin"></i> Getting location…';
            if (typeof lucide !== 'undefined' && lucide.createIcons) lucide.createIcons();
            navigator.geolocation.getCurrentPosition(
                function(pos) {
                    var lat = pos.coords.latitude;
                    var lng = pos.coords.longitude;
                    var url = 'https://www.google.com/maps/dir/?api=1&origin=' + encodeURIComponent(lat + ',' + lng) + '&destination=' + encodeURIComponent(destLat + ',' + destLng) + '&travelmode=driving';
                    window.open(url, '_blank', 'noopener');
                    dirBtn.innerHTML = origText;
                    dirBtn.disabled = false;
                    if (typeof lucide !== 'undefined' && lucide.createIcons) lucide.createIcons();
                },
                function() {
                    window.open(destUrl, '_blank', 'noopener');
                    dirBtn.innerHTML = origText;
                    dirBtn.disabled = false;
                    if (typeof lucide !== 'undefined' && lucide.createIcons) lucide.createIcons();
                },
                { enableHighAccuracy: true, timeout: 10000, maximumAge: 60000 }
            );
        });
    }
});
</script>
<?php get_footer(); ?>
