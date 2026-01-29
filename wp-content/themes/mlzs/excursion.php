<?php
/**
 * Template Name: Educational Excursions Page
 * Excursion: Hero, Uttarakhand trip, Village Experience, Outbound, Benefits, CTA – ACF dynamic
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$theme_uri = get_template_directory_uri();
$home_url = home_url('/');
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge     = $opt ? get_field('excursion_hero_badge', $page_id) : null;
$hero_icon      = $opt ? get_field('excursion_hero_icon', $page_id) : null;
$hero_headline  = $opt ? get_field('excursion_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('excursion_hero_highlight', $page_id) : null;
$hero_sub       = $opt ? get_field('excursion_hero_subheadline', $page_id) : null;

$hero_badge     = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Learning Beyond Classroom';
$hero_icon      = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'map-pin';
$hero_headline  = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'Educational';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Excursions';
$hero_sub       = ($hero_sub !== '' && $hero_sub !== null) ? (string) $hero_sub : 'Exploring the world, connecting with nature, and creating lifelong memories through educational trips';

// ——— Uttarakhand ———
$utt_icon    = $opt ? get_field('excursion_uttarakhand_icon', $page_id) : null;
$utt_title   = $opt ? get_field('excursion_uttarakhand_title', $page_id) : null;
$utt_subtitle = $opt ? get_field('excursion_uttarakhand_subtitle', $page_id) : null;
$utt_desc    = $opt ? get_field('excursion_uttarakhand_description', $page_id) : null;
$utt_images  = $opt ? get_field('excursion_uttarakhand_images', $page_id) : null;
$utt_act_heading = $opt ? get_field('excursion_uttarakhand_activities_heading', $page_id) : null;
$utt_act_icon   = $opt ? get_field('excursion_uttarakhand_activities_icon', $page_id) : null;
$utt_activities = $opt ? get_field('excursion_uttarakhand_activities', $page_id) : null;

$utt_icon    = (is_string($utt_icon) && trim($utt_icon) !== '') ? trim($utt_icon) : 'mountain';
$utt_title   = ($utt_title !== '' && $utt_title !== null) ? (string) $utt_title : 'Uttarakhand Educational Excursion';
$utt_subtitle = ($utt_subtitle !== '' && $utt_subtitle !== null) ? (string) $utt_subtitle : 'Dehradun, Rishikesh, Mussoorie & Nainital';
$utt_desc    = ($utt_desc !== '' && $utt_desc !== null) ? (string) $utt_desc : 'After the final term exams, students went on an educational excursion to Dehradun, Rishikesh, Mussoorie and Nainital, Uttarakhand. The students had a wonderful time during this excursion and participated enthusiastically in various activities.';
$utt_act_heading = ($utt_act_heading !== '' && $utt_act_heading !== null) ? (string) $utt_act_heading : 'Activities Participated';
$utt_act_icon   = (is_string($utt_act_icon) && trim($utt_act_icon) !== '') ? trim($utt_act_icon) : 'activity';
$default_utt_images = array(
    array('image' => array('url' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80'), 'alt' => 'Mountain Adventure', 'caption_title' => 'Mountain Adventure', 'caption_subtitle' => 'Exploring Uttarakhand'),
    array('image' => array('url' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800&q=80'), 'alt' => 'Group Activity', 'caption_title' => 'Group Learning', 'caption_subtitle' => 'Team activities'),
);
$utt_images = (is_array($utt_images) && !empty($utt_images)) ? $utt_images : $default_utt_images;
$default_utt_activities = array(array('icon' => 'palette', 'label' => 'Painting'), array('icon' => 'waves', 'label' => 'Rafting'));
$utt_activities = (is_array($utt_activities) && !empty($utt_activities)) ? $utt_activities : $default_utt_activities;

// ——— Village Experience ———
$village_icon = $opt ? get_field('excursion_village_icon', $page_id) : null;
$village_title = $opt ? get_field('excursion_village_title', $page_id) : null;
$village_desc  = $opt ? get_field('excursion_village_description', $page_id) : null;
$village_items = $opt ? get_field('excursion_village_items', $page_id) : null;

$village_icon  = (is_string($village_icon) && trim($village_icon) !== '') ? trim($village_icon) : 'home';
$village_title = ($village_title !== '' && $village_title !== null) ? (string) $village_title : 'Village Immersion Experience';
$village_desc  = ($village_desc !== '' && $village_desc !== null) ? (string) $village_desc : 'The students travelled high into the villages on the mountains and witnessed rural life in all its beauty. They lived with the villagers and learnt firsthand that India truly lives in its villages.';
$default_village_items = array(
    array('icon' => 'check-circle', 'text' => 'Cultural immersion with local communities'),
    array('icon' => 'check-circle', 'text' => 'Understanding rural lifestyle and traditions'),
    array('icon' => 'check-circle', 'text' => 'Learning about sustainable living practices'),
);
$village_items = (is_array($village_items) && !empty($village_items)) ? $village_items : $default_village_items;

// ——— Outbound ———
$out_images  = $opt ? get_field('excursion_outbound_images', $page_id) : null;
$out_icon    = $opt ? get_field('excursion_outbound_icon', $page_id) : null;
$out_title   = $opt ? get_field('excursion_outbound_title', $page_id) : null;
$out_desc    = $opt ? get_field('excursion_outbound_description', $page_id) : null;
$out_quote   = $opt ? get_field('excursion_outbound_quote', $page_id) : null;
$out_para2   = $opt ? get_field('excursion_outbound_paragraph', $page_id) : null;

$default_out_images = array(
    array('image' => array('url' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=800&q=80'), 'alt' => 'Forest Exploration', 'caption_title' => 'Nature Walk', 'caption_subtitle' => 'Exploring forests'),
    array('image' => array('url' => 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=800&q=80'), 'alt' => 'Adventure Activity', 'caption_title' => 'Team Building', 'caption_subtitle' => 'Group activities'),
);
$out_images = (is_array($out_images) && !empty($out_images)) ? $out_images : $default_out_images;
$out_icon  = (is_string($out_icon) && trim($out_icon) !== '') ? trim($out_icon) : 'trees';
$out_title = ($out_title !== '' && $out_title !== null) ? (string) $out_title : 'Outbound Programs';
$out_desc  = ($out_desc !== '' && $out_desc !== null) ? (string) $out_desc : 'Outbound programmes are a great opportunity to learn from Nature and from each other. The activities build trust and team spirit and inculcate a spirit of adventure.';
$out_quote = ($out_quote !== '' && $out_quote !== null) ? (string) $out_quote : '"Walking amid the forest they explore the world, connect with the earth and experience a sense of wonder."';
$out_para2 = ($out_para2 !== '' && $out_para2 !== null) ? (string) $out_para2 : 'The students unwound themselves and returned home with a rewarding experience and the trip would surely be cherished in their memories forever.';

// ——— Benefits ———
$ben_heading  = $opt ? get_field('excursion_benefits_heading', $page_id) : null;
$ben_highlight = $opt ? get_field('excursion_benefits_highlight', $page_id) : null;
$ben_subtext  = $opt ? get_field('excursion_benefits_subtext', $page_id) : null;
$ben_cards    = $opt ? get_field('excursion_benefits_cards', $page_id) : null;

$ben_heading   = ($ben_heading !== '' && $ben_heading !== null) ? (string) $ben_heading : 'Benefits of';
$ben_highlight = ($ben_highlight !== '' && $ben_highlight !== null) ? (string) $ben_highlight : 'Educational Excursions';
$ben_subtext   = ($ben_subtext !== '' && $ben_subtext !== null) ? (string) $ben_subtext : 'Learning beyond classroom walls for holistic development';
$default_ben_cards = array(
    array('icon' => 'users', 'title' => 'Team Building', 'description' => 'Develops trust, cooperation, and communication skills through shared experiences and group activities.', 'style' => 'primary'),
    array('icon' => 'compass', 'title' => 'Adventure Spirit', 'description' => 'Encourages exploration, risk-taking in safe environments, and develops problem-solving abilities.', 'style' => 'accent'),
    array('icon' => 'heart', 'title' => 'Cultural Awareness', 'description' => 'Fosters appreciation for diversity, rural lifestyles, and develops empathy and understanding.', 'style' => 'primary-alt'),
);
$ben_cards = (is_array($ben_cards) && !empty($ben_cards)) ? $ben_cards : $default_ben_cards;

// ——— CTA ———
$cta_title   = $opt ? get_field('excursion_cta_title', $page_id) : null;
$cta_text    = $opt ? get_field('excursion_cta_text', $page_id) : null;
$cta_btn1_label = $opt ? get_field('excursion_cta_btn1_label', $page_id) : null;
$cta_btn1_link  = $opt ? get_field('excursion_cta_btn1_link', $page_id) : null;
$cta_btn1_icon  = $opt ? get_field('excursion_cta_btn1_icon', $page_id) : null;
$cta_btn2_label = $opt ? get_field('excursion_cta_btn2_label', $page_id) : null;
$cta_btn2_link  = $opt ? get_field('excursion_cta_btn2_link', $page_id) : null;
$cta_btn2_icon  = $opt ? get_field('excursion_cta_btn2_icon', $page_id) : null;
$cta_stats   = $opt ? get_field('excursion_cta_stats', $page_id) : null;

$cta_title   = ($cta_title !== '' && $cta_title !== null) ? (string) $cta_title : 'Upcoming Excursions';
$cta_text    = ($cta_text !== '' && $cta_text !== null) ? (string) $cta_text : 'Stay updated with our upcoming educational trips and adventure programs. Give your child the gift of experiential learning.';
$cta_btn1_label = ($cta_btn1_label !== '' && $cta_btn1_label !== null) ? (string) $cta_btn1_label : 'View Schedule';
$cta_btn1_link  = ($cta_btn1_link !== '' && $cta_btn1_link !== null) ? esc_url($cta_btn1_link) : $home_url . '#';
$cta_btn1_icon  = (is_string($cta_btn1_icon) && trim($cta_btn1_icon) !== '') ? trim($cta_btn1_icon) : 'calendar';
$cta_btn2_label = ($cta_btn2_label !== '' && $cta_btn2_label !== null) ? (string) $cta_btn2_label : 'Photo Gallery';
$cta_btn2_link  = ($cta_btn2_link !== '' && $cta_btn2_link !== null) ? esc_url($cta_btn2_link) : $home_url . '#';
$cta_btn2_icon  = (is_string($cta_btn2_icon) && trim($cta_btn2_icon) !== '') ? trim($cta_btn2_icon) : 'camera';
$default_cta_stats = array(
    array('number' => '4', 'label' => 'Destinations'),
    array('number' => 'Multiple', 'label' => 'Activities'),
    array('number' => 'Rural', 'label' => 'Immersion'),
    array('number' => 'Life-long', 'label' => 'Memories'),
);
$cta_stats = (is_array($cta_stats) && !empty($cta_stats)) ? $cta_stats : $default_cta_stats;

// Helper: image URL from ACF image field (array or ID) or URL string
if (!function_exists('mlzs_excursion_img_url')) {
    function mlzs_excursion_img_url($item) {
        if (empty($item)) return '';
        if (isset($item['image'])) {
            if (is_array($item['image']) && !empty($item['image']['url'])) return $item['image']['url'];
            if (is_numeric($item['image'])) return wp_get_attachment_image_url((int) $item['image'], 'full') ?: '';
            if (is_string($item['image'])) return $item['image'];
        }
        return '';
    }
}
?>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary via-primary-dark to-slate-900 px-4 sm:px-6 lg:px-8 pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')]"></div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-accent/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="relative z-10 max-w-7xl mx-auto">
            <div class="text-center text-white">
                <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-white/20 backdrop-blur-md border border-white/30 mb-4 sm:mb-6 animate-fade-in-up">
                    <i data-lucide="<?php echo esc_attr($hero_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 text-accent"></i>
                    <span class="text-xs sm:text-sm font-semibold uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold mb-4 sm:mb-6 tracking-tight">
                    <?php echo esc_html($hero_headline); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame to-tiger-orange"><?php echo esc_html($hero_highlight); ?></span>
                </h1>
                <p class="text-sm sm:text-base md:text-lg lg:text-xl text-slate-200 max-w-3xl mx-auto leading-relaxed">
                    <?php echo esc_html($hero_sub); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="px-4 sm:px-6 lg:px-8 py-8 sm:py-12 md:py-16">
        <div class="max-w-7xl mx-auto">

            <!-- Uttarakhand Trip Section -->
            <div class="mb-8 sm:mb-12">
                <div class="bg-white rounded-xl sm:rounded-2xl p-6 shadow-soft border border-border-light mb-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-primary/10 to-accent/10 flex items-center justify-center">
                            <i data-lucide="<?php echo esc_attr($utt_icon); ?>" class="w-6 h-6 text-primary"></i>
                        </div>
                        <div>
                            <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-text-main-light"><?php echo esc_html($utt_title); ?></h2>
                            <p class="text-sm text-text-secondary-light"><?php echo esc_html($utt_subtitle); ?></p>
                        </div>
                    </div>
                    <p class="text-sm text-text-secondary-light leading-relaxed mb-6"><?php echo esc_html($utt_desc); ?></p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 mb-8">
                    <!-- Images & Activities -->
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <?php foreach (array_slice($utt_images, 0, 4) as $img_item) :
                                $img_src = mlzs_excursion_img_url($img_item);
                                if ($img_src === '') continue;
                                $img_alt = isset($img_item['alt']) ? (string) $img_item['alt'] : '';
                                $cap_title = isset($img_item['caption_title']) ? (string) $img_item['caption_title'] : '';
                                $cap_sub = isset($img_item['caption_subtitle']) ? (string) $img_item['caption_subtitle'] : '';
                            ?>
                            <div class="group relative overflow-hidden rounded-xl shadow-soft hover:shadow-lg transition-all duration-300">
                                <div class="aspect-square bg-gray-100 overflow-hidden">
                                    <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr($img_alt); ?>" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-br from-primary/20 to-primary-dark/20"></div>
                                </div>
                                <?php if ($cap_title !== '' || $cap_sub !== '') : ?>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3">
                                    <div class="text-white transform translate-y-3 group-hover:translate-y-0 transition-transform duration-300">
                                        <?php if ($cap_title !== '') : ?><h4 class="font-bold text-xs mb-1"><?php echo esc_html($cap_title); ?></h4><?php endif; ?>
                                        <?php if ($cap_sub !== '') : ?><p class="text-xs opacity-90"><?php echo esc_html($cap_sub); ?></p><?php endif; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="bg-gradient-to-r from-primary/5 to-accent/5 rounded-lg p-4 border border-primary/10">
                            <h4 class="font-bold text-text-main-light mb-3 flex items-center gap-2">
                                <i data-lucide="<?php echo esc_attr($utt_act_icon); ?>" class="w-4 h-4 text-primary"></i>
                                <?php echo esc_html($utt_act_heading); ?>
                            </h4>
                            <div class="grid grid-cols-2 gap-3">
                                <?php foreach ($utt_activities as $act) :
                                    $act_icon = (isset($act['icon']) && trim((string) $act['icon']) !== '') ? trim($act['icon']) : 'circle';
                                    $act_label = isset($act['label']) ? (string) $act['label'] : '';
                                    if ($act_label === '') continue;
                                ?>
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center">
                                        <i data-lucide="<?php echo esc_attr($act_icon); ?>" class="w-3 h-3 text-primary"></i>
                                    </div>
                                    <span class="text-sm text-text-secondary-light"><?php echo esc_html($act_label); ?></span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Village Experience -->
                    <div class="bg-gradient-to-r from-primary/5 to-accent/5 rounded-xl p-6 border border-primary/10">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                                <i data-lucide="<?php echo esc_attr($village_icon); ?>" class="w-5 h-5 text-primary"></i>
                            </div>
                            <h3 class="text-base sm:text-lg font-bold text-text-main-light"><?php echo esc_html($village_title); ?></h3>
                        </div>
                        <p class="text-sm text-text-secondary-light leading-relaxed mb-4"><?php echo esc_html($village_desc); ?></p>
                        <div class="space-y-3 mt-6">
                            <?php foreach ($village_items as $vi) :
                                $vi_icon = (isset($vi['icon']) && trim((string) $vi['icon']) !== '') ? trim($vi['icon']) : 'check-circle';
                                $vi_text = isset($vi['text']) ? (string) $vi['text'] : '';
                                if ($vi_text === '') continue;
                            ?>
                            <div class="flex items-start gap-2">
                                <i data-lucide="<?php echo esc_attr($vi_icon); ?>" class="w-4 h-4 text-primary mt-1 flex-shrink-0"></i>
                                <span class="text-sm text-text-secondary-light"><?php echo esc_html($vi_text); ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Outbound Programs Section -->
            <div class="mb-8 sm:mb-12">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <?php foreach (array_slice($out_images, 0, 4) as $img_item) :
                                $img_src = mlzs_excursion_img_url($img_item);
                                if ($img_src === '') continue;
                                $img_alt = isset($img_item['alt']) ? (string) $img_item['alt'] : '';
                                $cap_title = isset($img_item['caption_title']) ? (string) $img_item['caption_title'] : '';
                                $cap_sub = isset($img_item['caption_subtitle']) ? (string) $img_item['caption_subtitle'] : '';
                            ?>
                            <div class="group relative overflow-hidden rounded-xl shadow-soft hover:shadow-lg transition-all duration-300">
                                <div class="aspect-square bg-gray-100 overflow-hidden">
                                    <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr($img_alt); ?>" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-br from-primary-light/20 to-primary/20"></div>
                                </div>
                                <?php if ($cap_title !== '' || $cap_sub !== '') : ?>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3">
                                    <div class="text-white transform translate-y-3 group-hover:translate-y-0 transition-transform duration-300">
                                        <?php if ($cap_title !== '') : ?><h4 class="font-bold text-xs mb-1"><?php echo esc_html($cap_title); ?></h4><?php endif; ?>
                                        <?php if ($cap_sub !== '') : ?><p class="text-xs opacity-90"><?php echo esc_html($cap_sub); ?></p><?php endif; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-primary/5 to-accent/5 rounded-xl p-6 border border-primary/10">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                                <i data-lucide="<?php echo esc_attr($out_icon); ?>" class="w-5 h-5 text-primary"></i>
                            </div>
                            <h3 class="text-base sm:text-lg font-bold text-text-main-light"><?php echo esc_html($out_title); ?></h3>
                        </div>
                        <p class="text-sm text-text-secondary-light leading-relaxed mb-4"><?php echo esc_html($out_desc); ?></p>
                        <?php if ($out_quote !== '') : ?>
                        <div class="bg-white rounded-lg p-4 mb-4 border border-primary/10">
                            <p class="text-sm text-text-secondary-light italic"><?php echo esc_html($out_quote); ?></p>
                        </div>
                        <?php endif; ?>
                        <p class="text-sm sm:text-base text-text-secondary-light leading-relaxed"><?php echo esc_html($out_para2); ?></p>
                    </div>
                </div>
            </div>

            <!-- Benefits Section -->
            <div class="mb-8 sm:mb-12">
                <div class="text-center mb-8">
                    <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-text-main-light mb-4">
                        <?php echo esc_html($ben_heading); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-accent"><?php echo esc_html($ben_highlight); ?></span>
                    </h3>
                    <p class="text-sm text-text-secondary-light max-w-2xl mx-auto"><?php echo esc_html($ben_subtext); ?></p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php foreach ($ben_cards as $card) :
                        $c_icon = (isset($card['icon']) && trim((string) $card['icon']) !== '') ? trim($card['icon']) : 'users';
                        $c_title = isset($card['title']) ? (string) $card['title'] : '';
                        $c_desc = isset($card['description']) ? (string) $card['description'] : '';
                        $c_style = isset($card['style']) ? $card['style'] : 'primary';
                        $border_hover = $c_style === 'accent' ? 'hover:border-accent/20' : 'hover:border-primary/20';
                        $box_bg = $c_style === 'accent' ? 'bg-accent/10' : 'bg-primary/10';
                        $icon_color = $c_style === 'accent' ? 'text-accent' : 'text-primary';
                        if ($c_title === '') continue;
                    ?>
                    <div class="bg-white rounded-xl sm:rounded-2xl p-6 shadow-soft border border-border-light <?php echo esc_attr($border_hover); ?> transition-all duration-300 hover:-translate-y-1">
                        <div class="w-12 h-12 rounded-lg <?php echo esc_attr($box_bg); ?> flex items-center justify-center mb-4">
                            <i data-lucide="<?php echo esc_attr($c_icon); ?>" class="w-6 h-6 <?php echo esc_attr($icon_color); ?>"></i>
                        </div>
                        <h4 class="text-base sm:text-lg font-bold text-text-main-light mb-3"><?php echo esc_html($c_title); ?></h4>
                        <p class="text-sm text-text-secondary-light"><?php echo esc_html($c_desc); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Upcoming Excursions CTA -->
            <div class="bg-gradient-to-r from-primary to-primary-light rounded-xl sm:rounded-2xl p-6 sm:p-8 text-white">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-center">
                    <div>
                        <h3 class="text-lg sm:text-xl font-bold mb-4"><?php echo esc_html($cta_title); ?></h3>
                        <p class="text-sm text-white/80 mb-6"><?php echo esc_html($cta_text); ?></p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="<?php echo $cta_btn1_link; ?>" class="px-4 py-2 sm:px-6 sm:py-3 bg-white text-primary rounded-full font-bold hover:bg-white/90 transition-all flex items-center justify-center gap-2 group text-sm">
                                <i data-lucide="<?php echo esc_attr($cta_btn1_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                                <?php echo esc_html($cta_btn1_label); ?>
                            </a>
                            <a href="<?php echo $cta_btn2_link; ?>" class="px-4 py-2 sm:px-6 sm:py-3 bg-white/20 border border-white/30 text-white rounded-full font-bold hover:bg-white/30 transition-all flex items-center justify-center gap-2 group text-sm">
                                <i data-lucide="<?php echo esc_attr($cta_btn2_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                                <?php echo esc_html($cta_btn2_label); ?>
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <?php foreach ($cta_stats as $stat) :
                            $s_num = isset($stat['number']) ? (string) $stat['number'] : '';
                            $s_label = isset($stat['label']) ? (string) $stat['label'] : '';
                            if ($s_num === '' && $s_label === '') continue;
                        ?>
                        <div class="bg-white/10 rounded-xl p-4 text-center border border-white/20">
                            <?php if ($s_num !== '') : ?><div class="text-base sm:text-lg font-bold mb-2"><?php echo esc_html($s_num); ?></div><?php endif; ?>
                            <?php if ($s_label !== '') : ?><div class="text-xs font-medium text-white/80"><?php echo esc_html($s_label); ?></div><?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
