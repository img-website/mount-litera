<?php
/**
 * Template Name: Vision & Mission Page
 * Vision & Mission: Hero, Vision section, Mission section. UI matches vision.html.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// Icon color mapping for Mission Pillars
$pillar_styles = array(
    'primary' => array('bg' => 'bg-primary/10', 'icon' => 'text-primary'),
    'accent' => array('bg' => 'bg-accent/10', 'icon' => 'text-accent'),
);

// ——— Hero ———
$hero_badge = $opt ? get_field('vision_hero_badge', $page_id) : null;
$hero_before = $opt ? get_field('vision_hero_headline_before', $page_id) : null;
$hero_highlight = $opt ? get_field('vision_hero_headline_highlight', $page_id) : null;
$hero_after = $opt ? get_field('vision_hero_headline_after', $page_id) : null;
$hero_subtext = $opt ? get_field('vision_hero_subtext', $page_id) : null;
$hero_bg = $opt ? get_field('vision_hero_bg_image', $page_id) : null;

$hero_badge = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Our Guiding Principles';
$hero_before = ($hero_before !== '' && $hero_before !== null) ? (string) $hero_before : 'Vision';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : '&';
$hero_after = ($hero_after !== '' && $hero_after !== null) ? (string) $hero_after : 'Mission';
$hero_subtext = ($hero_subtext !== '' && $hero_subtext !== null) ? (string) $hero_subtext : "Shaping tomorrow's leaders through innovative education that blends traditional values with modern excellence";
$hero_bg_url = (is_array($hero_bg) && !empty($hero_bg['url'])) ? $hero_bg['url'] : 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80';

// ——— Vision Section ———
$vision_icon = $opt ? get_field('vision_section_icon', $page_id) : null;
$vision_badge = $opt ? get_field('vision_section_badge', $page_id) : null;
$vision_heading = $opt ? get_field('vision_section_heading', $page_id) : null;
$vision_para1 = $opt ? get_field('vision_section_para1', $page_id) : null;
$vision_para2 = $opt ? get_field('vision_section_para2', $page_id) : null;
$vision_list_label = $opt ? get_field('vision_section_list_label', $page_id) : null;
$vision_list_items = $opt ? get_field('vision_section_list_items', $page_id) : null;
$vision_highlight1 = $opt ? get_field('vision_highlight1', $page_id) : null;
$vision_highlight2 = $opt ? get_field('vision_highlight2', $page_id) : null;
$vision_main_img = $opt ? get_field('vision_main_image', $page_id) : null;
$vision_overlay_img = $opt ? get_field('vision_overlay_image', $page_id) : null;

$vision_icon = ($vision_icon !== '' && $vision_icon !== null) ? trim((string) $vision_icon) : 'eye';
$vision_badge = ($vision_badge !== '' && $vision_badge !== null) ? (string) $vision_badge : 'Our Vision';
$vision_heading = ($vision_heading !== '' && $vision_heading !== null) ? (string) $vision_heading : 'Preparing Leaders for Tomorrow';
$vision_para1 = ($vision_para1 !== '' && $vision_para1 !== null) ? (string) $vision_para1 : 'Mount Litera Zee School will provide a complete and unique educational experience for the child, preparing him / her for a successful life in the contemporary society.';
$vision_para2 = ($vision_para2 !== '' && $vision_para2 !== null) ? (string) $vision_para2 : '';
$vision_list_label = ($vision_list_label !== '' && $vision_list_label !== null) ? (string) $vision_list_label : 'The vision of Mount Litera Zee School envisages:';
$default_vision_list = array(array('text' => 'To create an excellent educational institution synthesizing the human values with the highest quality of teaching-learning using modern technology-driven tools for preparing a well-rounded personality for our society.'));
$vision_list_items = (is_array($vision_list_items) && !empty($vision_list_items)) ? $vision_list_items : $default_vision_list;
$vision_highlight1 = (is_array($vision_highlight1) && !empty($vision_highlight1)) ? $vision_highlight1 : array('number' => 'Complete', 'label' => 'Educational Experience');
$vision_highlight2 = (is_array($vision_highlight2) && !empty($vision_highlight2)) ? $vision_highlight2 : array('number' => 'Unique', 'label' => 'Learning Approach');
$vision_main_url = (is_array($vision_main_img) && !empty($vision_main_img['url'])) ? $vision_main_img['url'] : 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80';
$vision_overlay_url = (is_array($vision_overlay_img) && !empty($vision_overlay_img['url'])) ? $vision_overlay_img['url'] : $vision_main_url;

// ——— Mission Section ———
$mission_main_img = $opt ? get_field('vision_mission_main_image', $page_id) : null;
$mission_overlay_img = $opt ? get_field('vision_mission_overlay_image', $page_id) : null;
$mission_img_title = $opt ? get_field('vision_mission_image_title', $page_id) : null;
$mission_img_subtitle = $opt ? get_field('vision_mission_image_subtitle', $page_id) : null;
$mission_icon = $opt ? get_field('vision_mission_icon', $page_id) : null;
$mission_badge = $opt ? get_field('vision_mission_badge', $page_id) : null;
$mission_heading = $opt ? get_field('vision_mission_heading', $page_id) : null;
$mission_paragraph = $opt ? get_field('vision_mission_paragraph', $page_id) : null;
$mission_pillars_heading = $opt ? get_field('vision_mission_pillars_heading', $page_id) : null;
$mission_pillars = $opt ? get_field('vision_mission_pillars', $page_id) : null;

$mission_main_url = (is_array($mission_main_img) && !empty($mission_main_img['url'])) ? $mission_main_img['url'] : 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80';
$mission_overlay_url = (is_array($mission_overlay_img) && !empty($mission_overlay_img['url'])) ? $mission_overlay_img['url'] : 'https://images.unsplash.com/photo-1577896851231-70ef18881754?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80';
$mission_img_title = ($mission_img_title !== '' && $mission_img_title !== null) ? (string) $mission_img_title : 'Shaping Global Minds';
$mission_img_subtitle = ($mission_img_subtitle !== '' && $mission_img_subtitle !== null) ? (string) $mission_img_subtitle : 'On Indian soil with world-class standards';
$mission_icon = ($mission_icon !== '' && $mission_icon !== null) ? trim((string) $mission_icon) : 'target';
$mission_badge = ($mission_badge !== '' && $mission_badge !== null) ? (string) $mission_badge : 'Our Mission';
$mission_heading = ($mission_heading !== '' && $mission_heading !== null) ? (string) $mission_heading : 'Developing Leaders of the 21st Century';
$mission_paragraph = ($mission_paragraph !== '' && $mission_paragraph !== null) ? (string) $mission_paragraph : 'To shape global minds on the Indian soil. To ensure this, the school will give every student an access to world-class infrastructure, and an innovative curriculum that promotes the all-round development of the child imbibing traditional values.';
$mission_pillars_heading = ($mission_pillars_heading !== '' && $mission_pillars_heading !== null) ? (string) $mission_pillars_heading : 'Our Mission Pillars';
$default_pillars = array(
    array('icon' => 'globe', 'style' => 'primary', 'title' => 'Global Minds', 'paragraph' => 'Shaping international perspectives while staying rooted in Indian values'),
    array('icon' => 'building-2', 'style' => 'accent', 'title' => 'World-Class Infrastructure', 'paragraph' => 'Providing access to state-of-the-art facilities and learning environments'),
    array('icon' => 'book-open', 'style' => 'primary', 'title' => 'Innovative Curriculum', 'paragraph' => 'Promoting all-round development through cutting-edge educational approaches'),
);
$mission_pillars = (is_array($mission_pillars) && !empty($mission_pillars)) ? $mission_pillars : $default_pillars;
?>

    <!-- Hero Section -->
    <section class="relative min-h-[60vh] flex items-center justify-center px-4 sm:px-6 lg:px-8 bg-cover bg-center" style="background-image: linear-gradient(135deg, rgba(61,52,139,0.9) 0%, rgba(118,120,237,0.8) 50%, rgba(247,184,1,0.7) 100%), url('<?php echo esc_url($hero_bg_url); ?>');">
        <div class="absolute inset-0 bg-gradient-to-b from-primary/90 via-primary/70 to-primary/50"></div>
        <div class="relative z-10 w-full max-w-7xl mx-auto text-center pt-28 sm:pt-32 pb-16">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/20 backdrop-blur-md border border-white/30 mb-6">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-secondary"></span>
                </span>
                <span class="text-xs font-semibold text-white uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
            </div>
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-[1.1] tracking-tight mb-6 max-w-5xl mx-auto drop-shadow-lg">
                <?php echo esc_html($hero_before); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame via-tiger-orange to-cayenne-red"><?php echo esc_html($hero_highlight); ?></span> <?php echo esc_html($hero_after); ?>
            </h1>
            <p class="text-lg md:text-xl text-slate-200 mb-8 max-w-3xl mx-auto leading-relaxed font-light opacity-95">
                <?php echo esc_html($hero_subtext); ?>
            </p>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-background-light to-transparent"></div>
    </section>

    <!-- Vision Section -->
    <section class="relative px-4 sm:px-6 lg:px-8 py-16 md:py-24 bg-background-light">
        <div class="absolute top-0 left-0 -z-10 h-full w-full overflow-hidden">
            <div class="absolute -top-40 -right-40 h-[500px] w-[500px] rounded-full bg-indigo-velvet/5 blur-[100px]"></div>
            <div class="absolute top-1/2 -left-20 h-[300px] w-[300px] rounded-full bg-amber-flame/10 blur-[80px]"></div>
        </div>
        <div class="mx-auto max-w-7xl w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-start">
                <div class="flex flex-col gap-8">
                    <div class="flex flex-col gap-6">
                        <div class="flex items-center gap-3">
                            <div class="p-3 rounded-xl bg-gradient-to-br from-secondary to-accent-dark">
                                <i data-lucide="<?php echo esc_attr($vision_icon); ?>" class="w-8 h-8 text-white"></i>
                            </div>
                            <span class="w-fit rounded-full bg-accent/10 px-3 py-1 text-xs font-bold uppercase tracking-wider text-accent ring-1 ring-accent/20"><?php echo esc_html($vision_badge); ?></span>
                        </div>
                        <h2 class="font-display text-4xl font-bold tracking-tight text-text-main-light sm:text-5xl lg:text-6xl">
                            <?php echo esc_html($vision_heading); ?>
                        </h2>
                        <div class="space-y-4 text-lg leading-relaxed text-text-secondary-light">
                            <p><?php echo nl2br(esc_html($vision_para1)); ?></p>
                            <?php if ($vision_para2 !== '') : ?><p><?php echo nl2br(esc_html($vision_para2)); ?></p><?php endif; ?>
                            <?php if ($vision_list_label !== '') : ?>
                            <p class="font-medium text-primary"><?php echo esc_html($vision_list_label); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($vision_list_items)) : ?>
                            <div class="bg-white rounded-2xl p-8 border border-border-light shadow-soft">
                                <ul class="space-y-4 text-text-secondary-light">
                                    <?php foreach ($vision_list_items as $li) :
                                        $li_text = is_array($li) && isset($li['text']) ? (string) $li['text'] : (is_string($li) ? $li : '');
                                        if ($li_text === '') continue;
                                    ?>
                                    <li class="pl-6 before:content-['✓'] before:inline-block before:w-6 before:-ml-6 before:text-secondary before:font-bold">
                                        <?php echo esc_html($li_text); ?>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-6 mt-4">
                        <div class="bg-white rounded-2xl p-6 text-center border border-border-light shadow-soft">
                            <div class="text-3xl font-bold text-primary mb-2"><?php echo esc_html($vision_highlight1['number'] ?? 'Complete'); ?></div>
                            <div class="text-sm font-medium text-text-secondary-light"><?php echo esc_html($vision_highlight1['label'] ?? 'Educational Experience'); ?></div>
                        </div>
                        <div class="bg-white rounded-2xl p-6 text-center border border-border-light shadow-soft">
                            <div class="text-3xl font-bold text-accent mb-2"><?php echo esc_html($vision_highlight2['number'] ?? 'Unique'); ?></div>
                            <div class="text-sm font-medium text-text-secondary-light"><?php echo esc_html($vision_highlight2['label'] ?? 'Learning Approach'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                        <img src="<?php echo esc_url($vision_main_url); ?>" alt="Vision of Mount Litera Zee School" class="w-full h-[500px] object-cover" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-tr from-primary/60 to-transparent"></div>
                    </div>
                    <div class="absolute -bottom-6 -left-6 w-48 h-48 rounded-3xl overflow-hidden border-4 border-white shadow-2xl">
                        <img src="<?php echo esc_url($vision_overlay_url); ?>" alt="Students Learning Together" class="w-full h-full object-cover" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="relative px-4 sm:px-6 lg:px-8 py-16 md:py-24 bg-gradient-to-b from-white to-background-light overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-accent/5 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="mx-auto max-w-7xl w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <div class="relative order-2 lg:order-1">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                        <img src="<?php echo esc_url($mission_main_url); ?>" alt="Mission of Mount Litera Zee School" class="w-full h-[500px] object-cover" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-tl from-accent/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                            <h3 class="text-2xl font-bold mb-2"><?php echo esc_html($mission_img_title); ?></h3>
                            <p class="text-sm opacity-90"><?php echo esc_html($mission_img_subtitle); ?></p>
                        </div>
                    </div>
                    <div class="absolute -bottom-6 -right-6 w-48 h-48 rounded-3xl overflow-hidden border-4 border-white shadow-2xl">
                        <img src="<?php echo esc_url($mission_overlay_url); ?>" alt="Global Education" class="w-full h-full object-cover" loading="lazy">
                    </div>
                </div>
                <div class="flex flex-col gap-8 order-1 lg:order-2">
                    <div class="flex flex-col gap-6">
                        <div class="flex items-center gap-3">
                            <div class="p-3 rounded-xl bg-gradient-to-br from-primary to-primary-light">
                                <i data-lucide="<?php echo esc_attr($mission_icon); ?>" class="w-8 h-8 text-white"></i>
                            </div>
                            <span class="w-fit rounded-full bg-primary/10 px-3 py-1 text-xs font-bold uppercase tracking-wider text-primary ring-1 ring-primary/20"><?php echo esc_html($mission_badge); ?></span>
                        </div>
                        <h2 class="font-display text-4xl font-bold tracking-tight text-text-main-light sm:text-5xl lg:text-6xl">
                            <?php echo esc_html($mission_heading); ?>
                        </h2>
                        <div class="space-y-6 text-lg leading-relaxed text-text-secondary-light">
                            <p><?php echo nl2br(esc_html($mission_paragraph)); ?></p>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-primary/5 to-accent/5 rounded-2xl p-8 border border-primary/20">
                        <h3 class="text-2xl font-bold text-text-main-light mb-6"><?php echo esc_html($mission_pillars_heading); ?></h3>
                        <div class="space-y-6">
                            <?php foreach ($mission_pillars as $p) :
                                $p_style = isset($p['style']) ? (string) $p['style'] : 'primary';
                                $ps = isset($pillar_styles[$p_style]) ? $pillar_styles[$p_style] : $pillar_styles['primary'];
                            ?>
                            <div class="flex items-start gap-4">
                                <div class="shrink-0 w-12 h-12 rounded-xl <?php echo esc_attr($ps['bg']); ?> flex items-center justify-center">
                                    <i data-lucide="<?php echo esc_attr($p['icon'] ?? 'globe'); ?>" class="w-6 h-6 <?php echo esc_attr($ps['icon']); ?>"></i>
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold text-text-main-light mb-2"><?php echo esc_html($p['title'] ?? ''); ?></h4>
                                    <p class="text-text-secondary-light"><?php echo esc_html($p['paragraph'] ?? ''); ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
