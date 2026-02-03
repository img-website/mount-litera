<?php
/**
 * Template Name: Trust Page
 * Makkar Education Trust: Hero (trustees), Guiding Philosophy (3 visions), Objectives (6), Founding Trustees (3), CTA. UI matches trust.html exactly.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

/**
 * Get initials from full name (e.g. "Kamal Jhiriwal" -> "KJ")
 */
function mlzs_trust_initials($name) {
    if (empty($name) || !is_string($name)) return '';
    $parts = array_filter(array_map('trim', preg_split('/\s+/', $name)));
    if (empty($parts)) return strtoupper(substr($name, 0, 2));
    if (count($parts) === 1) return strtoupper(substr($parts[0], 0, 2));
    return strtoupper(substr($parts[0], 0, 1) . substr(end($parts), 0, 1));
}

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// Icon/card style classes
$trust_styles = array(
    'primary'   => array('bg' => 'bg-primary/10', 'icon' => 'text-primary', 'circle' => 'from-primary/10 to-primary/20', 'ring' => 'bg-primary/5', 'ring_hover' => 'group-hover:bg-primary/10', 'obj_hover' => 'group-hover:bg-primary'),
    'secondary' => array('bg' => 'bg-secondary/10', 'icon' => 'text-secondary', 'circle' => 'from-secondary/10 to-secondary/20', 'ring' => 'bg-secondary/5', 'ring_hover' => 'group-hover:bg-secondary/10', 'obj_hover' => 'group-hover:bg-secondary'),
    'accent'    => array('bg' => 'bg-accent/10', 'icon' => 'text-accent', 'circle' => 'from-accent/10 to-accent/20', 'ring' => 'bg-accent/5', 'ring_hover' => 'group-hover:bg-accent/10', 'obj_hover' => 'group-hover:bg-accent'),
);

// ——— Hero ———
$hero_badge = $opt ? get_field('trust_hero_badge', $page_id) : null;
$hero_title = $opt ? get_field('trust_hero_title', $page_id) : null;
$hero_quote = $opt ? get_field('trust_hero_quote', $page_id) : null;
$hero_intro = $opt ? get_field('trust_hero_intro', $page_id) : null;
$board_title = $opt ? get_field('trust_board_title', $page_id) : null;
$board_trustees = $opt ? get_field('trust_board_trustees', $page_id) : null;

$hero_badge = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Since 2009';
$hero_title = ($hero_title !== '' && $hero_title !== null) ? (string) $hero_title : 'Makkar Education Trust';
$hero_quote = ($hero_quote !== '' && $hero_quote !== null) ? (string) $hero_quote : "Where the vision is one year, cultivate flowers.\nWhere the vision is ten years, cultivate trees.\nWhere the vision is eternity, cultivate people.";
$hero_intro = ($hero_intro !== '' && $hero_intro !== null) ? (string) $hero_intro : 'Established on 3rd June 2009 with great vision, strong determination and powerful objectives, Makkar Education Trust is dedicated to nurturing future generations through quality education and holistic development.';
$board_title = ($board_title !== '' && $board_title !== null) ? (string) $board_title : 'Board of Trustees';

$default_board = array(
    array('name' => 'Mr. Kamal Jhiriwal', 'designation' => 'Founding Trustee', 'initials' => 'KJ', 'gradient' => 'primary-light-secondary'),
    array('name' => 'Mr. Rajan Jhiriwal', 'designation' => 'Managing Trustee', 'initials' => 'RJ', 'gradient' => 'primary-accent'),
    array('name' => 'Mr. Robin Jhiriwal', 'designation' => 'Trustee', 'initials' => 'RJ', 'gradient' => 'secondary-accent-dark'),
);
$board_trustees = (is_array($board_trustees) && !empty($board_trustees)) ? $board_trustees : $default_board;

// ——— Guiding Philosophy (Vision cards) ———
$philosophy_heading = $opt ? get_field('trust_philosophy_heading', $page_id) : null;
$philosophy_subtext = $opt ? get_field('trust_philosophy_subtext', $page_id) : null;
$vision_cards = $opt ? get_field('trust_vision_cards', $page_id) : null;

$philosophy_heading = ($philosophy_heading !== '' && $philosophy_heading !== null) ? (string) $philosophy_heading : 'Our Guiding Philosophy';
$philosophy_subtext = ($philosophy_subtext !== '' && $philosophy_subtext !== null) ? (string) $philosophy_subtext : 'Rooted in timeless wisdom, our approach to education transforms lives and shapes futures';

$default_visions = array(
    array('icon' => 'flower', 'title' => 'One Year Vision', 'paragraph' => 'Where the vision is one year, we cultivate flowers - focusing on immediate growth, foundational skills, and blossoming talents that bring joy and beauty to the present.', 'tag' => 'Immediate Impact', 'style' => 'primary'),
    array('icon' => 'tree-pine', 'title' => 'Ten Year Vision', 'paragraph' => 'Where the vision is ten years, we cultivate trees - investing in deep roots, strong trunks, and branches that will provide shade and fruit for generations to come.', 'tag' => 'Sustainable Growth', 'style' => 'secondary'),
    array('icon' => 'users', 'title' => 'Eternal Vision', 'paragraph' => 'Where the vision is eternity, we cultivate people - shaping character, building values, and developing citizens who will positively impact society for generations to come.', 'tag' => 'Legacy Building', 'style' => 'accent'),
);
$vision_cards = (is_array($vision_cards) && !empty($vision_cards)) ? $vision_cards : $default_visions;

// ——— Objectives ———
$obj_badge = $opt ? get_field('trust_obj_badge', $page_id) : null;
$obj_heading = $opt ? get_field('trust_obj_heading', $page_id) : null;
$obj_subtext = $opt ? get_field('trust_obj_subtext', $page_id) : null;
$objectives = $opt ? get_field('trust_objectives', $page_id) : null;

$obj_badge = ($obj_badge !== '' && $obj_badge !== null) ? (string) $obj_badge : 'Our Objectives';
$obj_heading = ($obj_heading !== '' && $obj_heading !== null) ? (string) $obj_heading : 'Purpose & Commitment';
$obj_subtext = ($obj_subtext !== '' && $obj_subtext !== null) ? (string) $obj_subtext : 'Guided by a strong vision and determination, Makkar Education Trust is committed to transforming education and nurturing future leaders';

$default_objectives = array(
    array('icon' => 'target', 'title' => 'Quality Education', 'paragraph' => 'To provide world-class education that combines academic excellence with character building, preparing students for success in all spheres of life.', 'style' => 'primary'),
    array('icon' => 'heart', 'title' => 'Holistic Development', 'paragraph' => 'To nurture the physical, emotional, social, and intellectual development of every child, creating well-rounded individuals ready to face life\'s challenges.', 'style' => 'primary'),
    array('icon' => 'sparkles', 'title' => 'Innovation in Learning', 'paragraph' => 'To implement innovative teaching methodologies and modern educational technologies that make learning engaging, effective, and future-ready.', 'style' => 'primary'),
    array('icon' => 'shield', 'title' => 'Value-Based Education', 'paragraph' => 'To instill strong moral values, ethics, and social responsibility in students, creating responsible citizens who contribute positively to society.', 'style' => 'secondary'),
    array('icon' => 'globe', 'title' => 'Global Perspective', 'paragraph' => 'To develop global citizens with cross-cultural understanding, awareness of global issues, and skills to thrive in an interconnected world.', 'style' => 'secondary'),
    array('icon' => 'hand-heart', 'title' => 'Community Engagement', 'paragraph' => 'To actively engage with and contribute to the local community, creating partnerships that enhance educational opportunities and social welfare.', 'style' => 'accent'),
);
$objectives = (is_array($objectives) && !empty($objectives)) ? $objectives : $default_objectives;

// ——— Founding Trustees (detailed) ———
$trustees_heading = $opt ? get_field('trust_trustees_heading', $page_id) : null;
$trustees_subtext = $opt ? get_field('trust_trustees_subtext', $page_id) : null;
$trustees_list = $opt ? get_field('trust_trustees_list', $page_id) : null;

$trustees_heading = ($trustees_heading !== '' && $trustees_heading !== null) ? (string) $trustees_heading : 'Our Founding Trustees';
$trustees_subtext = ($trustees_subtext !== '' && $trustees_subtext !== null) ? (string) $trustees_subtext : 'Visionary leaders dedicated to transforming education and shaping futures';

$default_trustees = array(
    array('name' => 'Mr. Kamal Jhiriwal', 'designation' => 'Founding Trustee', 'bio' => 'A visionary leader with deep commitment to educational transformation, Mr. Kamal Jhiriwal laid the foundation for the trust\'s enduring legacy of excellence and innovation in education.', 'initials' => 'KJ', 'gradient' => 'primary-primary-light'),
    array('name' => 'Mr. Rajan Jhiriwal', 'designation' => 'Managing Trustee', 'bio' => 'With strategic insight and administrative excellence, Mr. Rajan Jhiriwal ensures the trust\'s vision translates into impactful educational initiatives that nurture future generations.', 'initials' => 'RJ', 'gradient' => 'primary-dark-primary'),
    array('name' => 'Mr. Robin Jhiriwal', 'designation' => 'Trustee', 'bio' => 'Bringing innovation and fresh perspectives, Mr. Robin Jhiriwal contributes to the trust\'s mission of creating modern educational environments that prepare students for the challenges of tomorrow.', 'initials' => 'RJ', 'gradient' => 'primary-light-secondary'),
);
$trustees_list = (is_array($trustees_list) && !empty($trustees_list)) ? $trustees_list : $default_trustees;

// ——— CTA ———
$cta_badge = $opt ? get_field('trust_cta_badge', $page_id) : null;
$cta_icon = $opt ? get_field('trust_cta_icon', $page_id) : null;
$cta_heading = $opt ? get_field('trust_cta_heading', $page_id) : null;
$cta_paragraph = $opt ? get_field('trust_cta_paragraph', $page_id) : null;
$cta_btn1 = $opt ? get_field('trust_cta_btn1', $page_id) : null;
$cta_btn1_icon = $opt ? get_field('trust_cta_btn1_icon', $page_id) : null;
$cta_btn2 = $opt ? get_field('trust_cta_btn2', $page_id) : null;
$cta_btn2_icon = $opt ? get_field('trust_cta_btn2_icon', $page_id) : null;

$cta_badge = ($cta_badge !== '' && $cta_badge !== null) ? (string) $cta_badge : 'Join Our Mission';
$cta_icon = (is_string($cta_icon) && trim($cta_icon) !== '') ? trim($cta_icon) : 'heart-handshake';
$cta_heading = ($cta_heading !== '' && $cta_heading !== null) ? (string) $cta_heading : 'Be Part of Our Educational Journey';
$cta_paragraph = ($cta_paragraph !== '' && $cta_paragraph !== null) ? (string) $cta_paragraph : "Together, let's cultivate people who will shape a better tomorrow. Join Makkar Education Trust in our mission to create eternal impact through education.";
$cta_btn1_icon = (is_string($cta_btn1_icon) && trim($cta_btn1_icon) !== '') ? trim($cta_btn1_icon) : 'handshake';
$cta_btn2_icon = (is_string($cta_btn2_icon) && trim($cta_btn2_icon) !== '') ? trim($cta_btn2_icon) : 'book-open';
?>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 md:pt-40 md:pb-28 px-4 sm:px-6 lg:px-8 overflow-hidden bg-gradient-to-br from-slate-900 via-primary-dark to-primary">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 rounded-full bg-secondary/20 blur-3xl"></div>
            <div class="absolute bottom-1/4 right-1/4 w-80 h-80 rounded-full bg-accent/10 blur-3xl"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-6">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-secondary"></span>
                        </span>
                        <span class="text-xs font-semibold text-white uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                    </div>
                    
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                        <?php echo esc_html($hero_title); ?>
                    </h1>
                    
                    <div class="relative pl-8 border-l-4 border-secondary mb-8">
                        <?php
                        $hero_quote_contains_br = (strpos($hero_quote, '<br') !== false) || (strpos($hero_quote, '<p') !== false);
                        $hero_quote_html = $hero_quote_contains_br ? wp_kses_post($hero_quote) : nl2br(esc_html($hero_quote));
                        ?>
                        <p class="text-xl text-slate-200 italic font-serif">
                            <?php echo $hero_quote_html; ?>
                        </p>
                    </div>
                    
                    <p class="text-lg text-slate-200 mb-8 leading-relaxed">
                        <?php echo esc_html($hero_intro); ?>
                    </p>
                </div>
                
                <div class="lg:w-1/2">
                    <div class="relative">
                        <div class="absolute -top-6 -right-6 w-72 h-72 bg-secondary/20 rounded-full blur-2xl"></div>
                        <div class="relative bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 shadow-2xl">
                            <h2 class="text-2xl font-bold text-white mb-6 text-center"><?php echo esc_html($board_title); ?></h2>
                            <div class="space-y-6">
                                <?php
                                $grad_map = array(
                                    'primary-light-secondary' => 'from-primary-light to-secondary',
                                    'primary-accent' => 'from-primary to-accent',
                                    'secondary-accent-dark' => 'from-secondary to-accent-dark',
                                );
                                foreach ($board_trustees as $t) :
                                    $t_name = isset($t['name']) ? (string) $t['name'] : '';
                                    $t_desig = isset($t['designation']) ? (string) $t['designation'] : '';
                                    $t_init = isset($t['initials']) && $t['initials'] !== '' ? (string) $t['initials'] : mlzs_trust_initials($t_name);
                                    $t_grad = isset($t['gradient']) ? (string) $t['gradient'] : 'primary-accent';
                                    $grad_class = isset($grad_map[$t_grad]) ? $grad_map[$t_grad] : 'from-primary to-accent';
                                ?>
                                <div class="flex items-center gap-4 p-4 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
                                    <div class="w-16 h-16 rounded-full bg-gradient-to-br <?php echo esc_attr($grad_class); ?> flex items-center justify-center text-white font-bold text-xl shrink-0">
                                        <?php echo esc_html($t_init); ?>
                                    </div>
                                    <div>
                                        <h3 class="text-white font-bold text-lg"><?php echo esc_html($t_name); ?></h3>
                                        <p class="text-slate-300 text-sm"><?php echo esc_html($t_desig); ?></p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission Section -->
    <section class="py-16 md:py-24 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4"><?php echo esc_html($philosophy_heading); ?></h2>
                <p class="text-lg text-slate-600 max-w-3xl mx-auto"><?php echo esc_html($philosophy_subtext); ?></p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <?php foreach ($vision_cards as $v) :
                    $v_icon = isset($v['icon']) ? trim((string) $v['icon']) : 'flower';
                    $v_title = isset($v['title']) ? (string) $v['title'] : '';
                    $v_para = isset($v['paragraph']) ? (string) $v['paragraph'] : '';
                    $v_tag = isset($v['tag']) ? (string) $v['tag'] : '';
                    $v_style = isset($v['style']) ? (string) $v['style'] : 'primary';
                    $vs = isset($trust_styles[$v_style]) ? $trust_styles[$v_style] : $trust_styles['primary'];
                ?>
                <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-50 to-white p-8 border border-slate-200 shadow-soft hover:shadow-xl hover:border-secondary/30 transition-all duration-300">
                    <div class="absolute -top-10 -right-10 w-40 h-40 rounded-full <?php echo esc_attr($vs['ring']); ?> <?php echo esc_attr(isset($vs['ring_hover']) ? $vs['ring_hover'] : ''); ?> transition-colors"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 rounded-xl bg-gradient-to-br <?php echo esc_attr($vs['circle']); ?> flex items-center justify-center mb-6">
                            <i data-lucide="<?php echo esc_attr($v_icon); ?>" class="w-8 h-8 <?php echo esc_attr($vs['icon']); ?>"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-4"><?php echo esc_html($v_title); ?></h3>
                        <p class="text-slate-600 mb-4"><?php echo esc_html($v_para); ?></p>
                        <?php if ($v_tag !== '') : ?>
                        <div class="flex items-center <?php echo esc_attr($vs['icon']); ?> font-medium">
                            <span><?php echo esc_html($v_tag); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Objectives Section -->
    <section class="py-16 md:py-24 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-primary/5 via-white to-secondary/5">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 rounded-full bg-primary/10 text-primary text-sm font-bold uppercase tracking-wider mb-4"><?php echo esc_html($obj_badge); ?></span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4"><?php echo esc_html($obj_heading); ?></h2>
                <p class="text-lg text-slate-600 max-w-3xl mx-auto"><?php echo esc_html($obj_subtext); ?></p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($objectives as $obj) :
                    $o_icon = isset($obj['icon']) ? trim((string) $obj['icon']) : 'target';
                    $o_title = isset($obj['title']) ? (string) $obj['title'] : '';
                    $o_para = isset($obj['paragraph']) ? (string) $obj['paragraph'] : '';
                    $o_style = isset($obj['style']) ? (string) $obj['style'] : 'primary';
                    $os = isset($trust_styles[$o_style]) ? $trust_styles[$o_style] : $trust_styles['primary'];
                ?>
                <div class="group bg-white rounded-2xl p-8 border border-slate-200 shadow-soft hover:shadow-xl hover:border-primary/30 transition-all duration-300">
                    <div class="flex items-start gap-6">
                        <div class="w-14 h-14 rounded-xl <?php echo esc_attr($os['bg']); ?> flex items-center justify-center shrink-0 <?php echo esc_attr(isset($os['obj_hover']) ? $os['obj_hover'] : 'group-hover:bg-primary'); ?> group-hover:text-white transition-colors">
                            <i data-lucide="<?php echo esc_attr($o_icon); ?>" class="w-7 h-7 <?php echo esc_attr($os['icon']); ?> group-hover:text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 mb-3"><?php echo esc_html($o_title); ?></h3>
                            <p class="text-slate-600"><?php echo esc_html($o_para); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Founding Trustees Details -->
    <section class="py-16 md:py-24 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-primary/5 via-white to-primary/10">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4"><?php echo esc_html($trustees_heading); ?></h2>
                <p class="text-lg text-slate-600 max-w-3xl mx-auto"><?php echo esc_html($trustees_subtext); ?></p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <?php
                $trustee_grad_map = array(
                    'primary-primary-light' => array('ring' => 'from-primary to-primary-light', 'text' => 'text-primary'),
                    'primary-dark-primary' => array('ring' => 'from-primary-dark to-primary', 'text' => 'text-primary-dark'),
                    'primary-light-secondary' => array('ring' => 'from-primary-light to-secondary', 'text' => 'text-primary-light'),
                );
                foreach ($trustees_list as $tr) :
                    $tr_name = isset($tr['name']) ? (string) $tr['name'] : '';
                    $tr_desig = isset($tr['designation']) ? (string) $tr['designation'] : '';
                    $tr_bio = isset($tr['bio']) ? (string) $tr['bio'] : '';
                    $tr_init = isset($tr['initials']) && $tr['initials'] !== '' ? (string) $tr['initials'] : mlzs_trust_initials($tr_name);
                    $tr_grad = isset($tr['gradient']) ? (string) $tr['gradient'] : 'primary-primary-light';
                    $tr_gc = isset($trustee_grad_map[$tr_grad]) ? $trustee_grad_map[$tr_grad] : $trustee_grad_map['primary-primary-light'];
                ?>
                <div class="group text-center">
                    <div class="relative mb-6 mx-auto w-48 h-48">
                        <div class="absolute inset-0 rounded-full bg-gradient-to-br <?php echo esc_attr($tr_gc['ring']); ?> group-hover:from-secondary group-hover:to-accent transition-all duration-300"></div>
                        <div class="absolute inset-2 rounded-full bg-white flex items-center justify-center">
                            <div class="text-4xl font-bold <?php echo esc_attr($tr_gc['text']); ?>"><?php echo esc_html($tr_init); ?></div>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-2"><?php echo esc_html($tr_name); ?></h3>
                    <p class="text-secondary font-medium mb-4"><?php echo esc_html($tr_desig); ?></p>
                    <p class="text-slate-600"><?php echo esc_html($tr_bio); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 md:py-24 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-primary to-primary-dark">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 px-6 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-6">
                <i data-lucide="<?php echo esc_attr($cta_icon); ?>" class="w-5 h-5 text-secondary"></i>
                <span class="text-sm font-semibold text-white"><?php echo esc_html($cta_badge); ?></span>
            </div>
            
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6"><?php echo esc_html($cta_heading); ?></h2>
            <p class="text-xl text-slate-200 mb-8 max-w-2xl mx-auto"><?php echo esc_html($cta_paragraph); ?></p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <?php
                $btn1_url = (is_array($cta_btn1) && !empty($cta_btn1['url'])) ? $cta_btn1['url'] : '#';
                $btn1_title = (is_array($cta_btn1) && !empty($cta_btn1['title'])) ? $cta_btn1['title'] : 'Partner With Us';
                $btn2_url = (is_array($cta_btn2) && !empty($cta_btn2['url'])) ? $cta_btn2['url'] : '#';
                $btn2_title = (is_array($cta_btn2) && !empty($cta_btn2['title'])) ? $cta_btn2['title'] : 'Learn About Our Schools';
                ?>
                <a href="<?php echo esc_url($btn1_url); ?>" class="inline-flex items-center justify-center px-4 py-2 sm:px-8 sm:py-4 bg-white text-primary font-bold rounded-full hover:bg-slate-100 transition-all transform hover:-translate-y-1 shadow-lg hover:shadow-xl text-sm sm:text-base">
                    <i data-lucide="<?php echo esc_attr($cta_btn1_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 mr-2"></i>
                    <?php echo esc_html($btn1_title); ?>
                </a>
                <a href="<?php echo esc_url($btn2_url); ?>" class="inline-flex items-center justify-center px-4 py-2 sm:px-8 sm:py-4 bg-secondary text-white font-bold rounded-full hover:bg-accent-dark transition-all transform hover:-translate-y-1 shadow-lg hover:shadow-xl text-sm sm:text-base">
                    <i data-lucide="<?php echo esc_attr($cta_btn2_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 mr-2"></i>
                    <?php echo esc_html($btn2_title); ?>
                </a>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
