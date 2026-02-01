<?php
/**
 * Template Name: Uniform Page
 * School Uniform: Hero, Color Guide, Summer Uniform, Winter Uniform, Common Accessories, Fabric Specs. UI matches uniform.html.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge = $opt ? get_field('uniform_hero_badge', $page_id) : null;
$hero_before = $opt ? get_field('uniform_hero_headline_before', $page_id) : null;
$hero_highlight = $opt ? get_field('uniform_hero_headline_highlight', $page_id) : null;
$hero_after = $opt ? get_field('uniform_hero_headline_after', $page_id) : null;
$hero_subtext = $opt ? get_field('uniform_hero_subtext', $page_id) : null;
$hero_btns = $opt ? get_field('uniform_hero_buttons', $page_id) : null;
$hero_image = $opt ? get_field('uniform_hero_image', $page_id) : null;
$hero_caption1 = $opt ? get_field('uniform_hero_caption1', $page_id) : null;
$hero_caption2 = $opt ? get_field('uniform_hero_caption2', $page_id) : null;

$hero_badge = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'School Dress Code';
$hero_before = ($hero_before !== '' && $hero_before !== null) ? (string) $hero_before : 'School';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Uniform';
$hero_after = ($hero_after !== '' && $hero_after !== null) ? (string) $hero_after : 'Guide';
$hero_subtext = ($hero_subtext !== '' && $hero_subtext !== null) ? (string) $hero_subtext : 'Explore our complete uniform specifications with detailed images and descriptions for both summer and winter seasons. Ensure your child is dressed correctly according to our school standards.';
$hero_img_url = (is_array($hero_image) && !empty($hero_image['url'])) ? $hero_image['url'] : 'https://images.unsplash.com/photo-1591123120675-6f7f1aae0e5b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
$hero_caption1 = ($hero_caption1 !== '' && $hero_caption1 !== null) ? (string) $hero_caption1 : 'School Uniform';
$hero_caption2 = ($hero_caption2 !== '' && $hero_caption2 !== null) ? (string) $hero_caption2 : 'Light Green & Navy Blue';

$default_btns = array(
    array('link' => array('url' => '#summer-uniform', 'title' => 'Summer Uniform'), 'icon' => 'sun', 'style' => 'summer'),
    array('link' => array('url' => '#winter-uniform', 'title' => 'Winter Uniform'), 'icon' => 'snowflake', 'style' => 'winter'),
    array('link' => array('url' => '#common-items', 'title' => 'Accessories'), 'icon' => 'package', 'style' => 'outline'),
);
$hero_btns = (is_array($hero_btns) && !empty($hero_btns)) ? $hero_btns : $default_btns;

// ——— Color Guide ———
$color_heading = $opt ? get_field('uniform_color_heading', $page_id) : null;
$color_subtext = $opt ? get_field('uniform_color_subtext', $page_id) : null;
$color_cards = $opt ? get_field('uniform_color_cards', $page_id) : null;

$color_heading = ($color_heading !== '' && $color_heading !== null) ? (string) $color_heading : 'Uniform Color Guide';
$color_subtext = ($color_subtext !== '' && $color_subtext !== null) ? (string) $color_subtext : 'Official colors and fabric specifications for all uniform items';

$default_colors = array(
    array('name' => 'Light Parrot Green', 'hex' => '#50C878', 'used_for' => 'Shirts', 'detail_label' => 'Fabric', 'detail_value' => 'Polycot (67/33)'),
    array('name' => 'Navy Blue', 'hex' => '#1E3A8A', 'used_for' => 'Trousers/Skirts', 'detail_label' => 'Fabric', 'detail_value' => 'Polyester Viscose (70/30)'),
    array('name' => 'School Blue', 'hex' => '#3D348B', 'used_for' => 'Accessories', 'detail_label' => 'Type', 'detail_value' => 'Belt, Tie'),
    array('name' => 'Accent Gold', 'hex' => '#F7B801', 'used_for' => 'Logo & Details', 'detail_label' => 'Type', 'detail_value' => 'Embroideries'),
);
$color_cards = (is_array($color_cards) && !empty($color_cards)) ? $color_cards : $default_colors;

// ——— Summer Uniform ———
$summer_badge = $opt ? get_field('uniform_summer_badge', $page_id) : null;
$summer_heading = $opt ? get_field('uniform_summer_heading', $page_id) : null;
$summer_subtext = $opt ? get_field('uniform_summer_subtext', $page_id) : null;
$summer_boys_title = $opt ? get_field('uniform_summer_boys_title', $page_id) : null;
$summer_boys_subtext = $opt ? get_field('uniform_summer_boys_subtext', $page_id) : null;
$summer_boys_items = $opt ? get_field('uniform_summer_boys_items', $page_id) : null;
$summer_boys_set = $opt ? get_field('uniform_summer_boys_set', $page_id) : null;
$summer_girls_title = $opt ? get_field('uniform_summer_girls_title', $page_id) : null;
$summer_girls_subtext = $opt ? get_field('uniform_summer_girls_subtext', $page_id) : null;
$summer_girls_items = $opt ? get_field('uniform_summer_girls_items', $page_id) : null;

$summer_badge = ($summer_badge !== '' && $summer_badge !== null) ? (string) $summer_badge : 'Academic Year 2015-16';
$summer_heading = ($summer_heading !== '' && $summer_heading !== null) ? (string) $summer_heading : 'Summer Uniform';
$summer_subtext = ($summer_subtext !== '' && $summer_subtext !== null) ? (string) $summer_subtext : 'Lightweight and comfortable for warmer months (March - October)';
$summer_boys_title = ($summer_boys_title !== '' && $summer_boys_title !== null) ? (string) $summer_boys_title : 'Boys Summer Uniform';
$summer_boys_subtext = ($summer_boys_subtext !== '' && $summer_boys_subtext !== null) ? (string) $summer_boys_subtext : 'Half-sleeve shirts with navy blue trousers';
$summer_girls_title = ($summer_girls_title !== '' && $summer_girls_title !== null) ? (string) $summer_girls_title : 'Girls Summer Uniform';
$summer_girls_subtext = ($summer_girls_subtext !== '' && $summer_girls_subtext !== null) ? (string) $summer_girls_subtext : 'Half-sleeve shirts with navy blue skirts';

$default_summer_boys = array(
    array('image' => array('url' => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'), 'title' => 'Summer Shirt', 'subtitle' => 'Half sleeves with navy blue lining', 'badge' => 'BOYS', 'badge_style' => 'boys', 'color_name' => 'Light Parrot Green', 'color_hex' => '#50C878', 'design' => 'Half Sleeves', 'fabric' => 'Polycot (67/33)', 'note' => 'Navy blue lining on sleeves. Must be neatly tucked in.'),
    array('image' => array('url' => 'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'), 'title' => 'Summer Trousers', 'subtitle' => 'Navy blue formal trousers', 'badge' => 'BOYS', 'badge_style' => 'boys', 'color_name' => 'Navy Blue', 'color_hex' => '#1E3A8A', 'design' => 'Regular fit', 'fabric' => 'Polyester Viscose (70/30)', 'note' => 'Must be properly fitted. No jeans or casual trousers allowed.'),
);
$summer_boys_items = (is_array($summer_boys_items) && !empty($summer_boys_items)) ? $summer_boys_items : $default_summer_boys;

$default_summer_set = array(
    array('image' => array('url' => 'https://images.unsplash.com/photo-1562774053-701939374585?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'), 'label' => 'Front View'),
    array('image' => array('url' => 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'), 'label' => 'Side View'),
    array('image' => array('url' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'), 'label' => 'Back View'),
);
$summer_boys_set = (is_array($summer_boys_set) && !empty($summer_boys_set)) ? $summer_boys_set : $default_summer_set;

$default_summer_girls = array(
    array('image' => array('url' => 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'), 'title' => 'Summer Shirt', 'subtitle' => 'Half sleeves with navy blue jacket lining', 'badge' => 'GIRLS', 'badge_style' => 'girls', 'color_name' => 'Light Parrot Green', 'color_hex' => '#50C878', 'design' => 'Half Sleeves', 'fabric' => 'Polycot (67/33)', 'note' => 'Includes navy blue jacket and sleeve lining. Must be neatly tucked in.'),
    array('image' => array('url' => 'https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'), 'title' => 'Summer Skirt', 'subtitle' => 'Navy blue pleated skirt', 'badge' => 'GIRLS', 'badge_style' => 'girls', 'color_name' => 'Navy Blue', 'color_hex' => '#1E3A8A', 'design' => 'Pleated', 'fabric' => 'Polyester Viscose (70/30)', 'note' => 'Skirt length should be knee-length. Well-ironed pleats required.'),
);
$summer_girls_items = (is_array($summer_girls_items) && !empty($summer_girls_items)) ? $summer_girls_items : $default_summer_girls;

// ——— Winter Uniform ———
$winter_badge = $opt ? get_field('uniform_winter_badge', $page_id) : null;
$winter_heading = $opt ? get_field('uniform_winter_heading', $page_id) : null;
$winter_subtext = $opt ? get_field('uniform_winter_subtext', $page_id) : null;
$winter_boys_title = $opt ? get_field('uniform_winter_boys_title', $page_id) : null;
$winter_boys_subtext = $opt ? get_field('uniform_winter_boys_subtext', $page_id) : null;
$winter_boys_items = $opt ? get_field('uniform_winter_boys_items', $page_id) : null;
$winter_blazer = $opt ? get_field('uniform_winter_blazer', $page_id) : null;
$winter_girls_title = $opt ? get_field('uniform_winter_girls_title', $page_id) : null;
$winter_girls_subtext = $opt ? get_field('uniform_winter_girls_subtext', $page_id) : null;
$winter_girls_items = $opt ? get_field('uniform_winter_girls_items', $page_id) : null;
$winter_options = $opt ? get_field('uniform_winter_options', $page_id) : null;

$winter_badge = ($winter_badge !== '' && $winter_badge !== null) ? (string) $winter_badge : 'Academic Year 2014-15';
$winter_heading = ($winter_heading !== '' && $winter_heading !== null) ? (string) $winter_heading : 'Winter Uniform';
$winter_subtext = ($winter_subtext !== '' && $winter_subtext !== null) ? (string) $winter_subtext : 'Warm and formal for cooler months (November - February)';
$winter_boys_title = ($winter_boys_title !== '' && $winter_boys_title !== null) ? (string) $winter_boys_title : 'Boys Winter Uniform';
$winter_boys_subtext = ($winter_boys_subtext !== '' && $winter_boys_subtext !== null) ? (string) $winter_boys_subtext : 'Full-sleeve shirts with sweater and optional blazer';
$winter_girls_title = ($winter_girls_title !== '' && $winter_girls_title !== null) ? (string) $winter_girls_title : 'Girls Winter Uniform';
$winter_girls_subtext = ($winter_girls_subtext !== '' && $winter_girls_subtext !== null) ? (string) $winter_girls_subtext : 'Choice between skirt or trousers with sweater';

$default_winter_boys = array(
    array('image' => array('url' => 'https://images.unsplash.com/photo-1599458254070-7f2dbe1bb4e4?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'), 'title' => 'Winter Shirt', 'badge' => 'FULL SLEEVE', 'color' => 'Light Green', 'detail1' => 'Polycot (67/33)'),
    array('image' => array('url' => 'https://images.unsplash.com/photo-1591195853828-11db59a44f6b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'), 'title' => 'Winter Trousers', 'badge' => 'PLEATED', 'color' => 'Navy Blue', 'detail1' => 'Pleats in front'),
    array('image' => array('url' => 'https://images.unsplash.com/photo-1574180045827-681f8a1a9622?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'), 'title' => 'Winter Sweater', 'badge' => 'STRIPED', 'color' => 'Navy Blue', 'detail1' => 'Green stripes'),
);
$winter_boys_items = (is_array($winter_boys_items) && !empty($winter_boys_items)) ? $winter_boys_items : $default_winter_boys;

$default_blazer = array('image' => array('url' => 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'), 'title' => 'School Blazer (Optional)', 'subtitle' => 'For formal occasions and extreme cold', 'color' => 'Navy Blue', 'design' => 'Double/Single breasted', 'logo' => 'Left chest pocket', 'primary_note' => 'Not compulsory for primary classes', 'note' => "The school decides blazer requirements based on local climatic conditions.");
$winter_blazer = (is_array($winter_blazer) && !empty($winter_blazer)) ? $winter_blazer : $default_blazer;

$default_winter_girls = array(
    array('image' => array('url' => 'https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'), 'title' => 'Winter Shirt', 'badge' => 'FULL SLEEVE', 'color' => 'Light Green', 'detail1' => 'Polycot (67/33)'),
    array('image' => array('url' => 'https://images.unsplash.com/photo-1599458254070-7f2dbe1bb4e4?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'), 'title' => 'Skirt/Trousers', 'badge' => 'OPTIONAL', 'color' => 'Navy Blue', 'detail1' => 'Skirt or Trousers'),
    array('image' => array('url' => 'https://images.unsplash.com/photo-1574180045827-681f8a1a9622?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'), 'title' => 'Winter Sweater', 'badge' => 'STRIPED', 'color' => 'Navy Blue', 'detail1' => 'Green stripes'),
);
$winter_girls_items = (is_array($winter_girls_items) && !empty($winter_girls_items)) ? $winter_girls_items : $default_winter_girls;

$default_winter_opts = array(
    array('icon' => 'thermometer', 'title' => 'Sweater Options', 'paragraph' => 'Students can choose between full-sleeved and sleeveless sweaters. The school arranges both options.', 'style' => 'green'),
    array('icon' => 'user', 'title' => "Girls' Options", 'paragraph' => "Girl students may choose between skirts and trousers based on local climatic conditions during winter months.", 'style' => 'accent'),
);
$winter_options = (is_array($winter_options) && !empty($winter_options)) ? $winter_options : $default_winter_opts;

// ——— Common Accessories ———
$acc_heading = $opt ? get_field('uniform_acc_heading', $page_id) : null;
$acc_subtext = $opt ? get_field('uniform_acc_subtext', $page_id) : null;
$acc_items = $opt ? get_field('uniform_acc_items', $page_id) : null;
$acc_instructions = $opt ? get_field('uniform_acc_instructions', $page_id) : null;

$acc_heading = ($acc_heading !== '' && $acc_heading !== null) ? (string) $acc_heading : 'Common Accessories';
$acc_subtext = ($acc_subtext !== '' && $acc_subtext !== null) ? (string) $acc_subtext : 'Items to be worn by both boys and girls as part of the complete uniform';

$default_acc = array(
    array('image' => array('url' => 'https://images.unsplash.com/photo-1588850561407-ed78c282e89b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'), 'title' => 'School Cap', 'description' => 'Navy blue with school logo', 'color_text' => 'Navy Blue', 'color_swatches' => array(array('hex' => '#1E3A8A', 'use_border' => 0))),
    array('image' => array('url' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'), 'title' => 'School Belt', 'description' => 'Black leather with school buckle', 'color_text' => 'Black', 'color_swatches' => array(array('hex' => '#111827', 'use_border' => 0))),
    array('image' => array('url' => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'), 'title' => 'School Tie', 'description' => 'Striped with school colors', 'color_text' => 'Striped', 'color_swatches' => array(array('hex' => '#3D348B', 'use_border' => 0), array('hex' => '#F7B801', 'use_border' => 0), array('hex' => '#50C878', 'use_border' => 0))),
    array('image' => array('url' => 'https://images.unsplash.com/photo-1588850561407-ed78c282e89b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'), 'title' => 'School Socks', 'description' => 'Navy blue or white', 'color_text' => 'Two options', 'color_swatches' => array(array('hex' => '#1E3A8A', 'use_border' => 0), array('hex' => '#ffffff', 'use_border' => 1))),
);
$acc_items = (is_array($acc_items) && !empty($acc_items)) ? $acc_items : $default_acc;

$default_inst = array(
    array('title' => 'Blazer Policy', 'paragraph' => "Blazers are not compulsory for primary classes. Implementation depends on the school's discretion considering local climatic conditions."),
    array('title' => 'Quality Standards', 'paragraph' => 'All uniform items must meet specified fabric ratios and color standards. Non-compliant uniforms will not be permitted.'),
    array('title' => 'Purchase Information', 'paragraph' => 'Uniforms available at school store (8 AM - 4 PM) and authorized vendors. Contact school for vendor details.'),
    array('title' => 'Regular Checks', 'paragraph' => 'Uniform checks will be conducted regularly. Students not adhering to uniform policy may face disciplinary action.'),
);
$acc_instructions = (is_array($acc_instructions) && !empty($acc_instructions)) ? $acc_instructions : $default_inst;

// ——— Fabric Specs ———
$fabric_heading = $opt ? get_field('uniform_fabric_heading', $page_id) : null;
$fabric_subtext = $opt ? get_field('uniform_fabric_subtext', $page_id) : null;
$fabric_cards = $opt ? get_field('uniform_fabric_cards', $page_id) : null;

$fabric_heading = ($fabric_heading !== '' && $fabric_heading !== null) ? (string) $fabric_heading : 'Fabric Specifications';
$fabric_subtext = ($fabric_subtext !== '' && $fabric_subtext !== null) ? (string) $fabric_subtext : 'Detailed fabric composition and care instructions';

$default_fabrics = array(
    array('icon' => 'leaf', 'title' => 'Polycot Fabric', 'subtitle' => 'For Light Green Shirts', 'comp1_label' => 'Polyester', 'comp1_value' => '67%', 'comp2_label' => 'Cotton', 'comp2_value' => '33%', 'style' => 'green', 'features' => array('Durable and long-lasting', 'Comfortable for daily wear', 'Easy to wash and maintain', 'Minimal wrinkling')),
    array('icon' => 'droplets', 'title' => 'Polyester Viscose', 'subtitle' => 'For Navy Blue Items', 'comp1_label' => 'Polyester', 'comp1_value' => '70%', 'comp2_label' => 'Viscose', 'comp2_value' => '30%', 'style' => 'navy', 'features' => array('Formal appearance', 'Good drape and fall', 'Color fastness', 'Wrinkle-resistant')),
);
$fabric_cards = (is_array($fabric_cards) && !empty($fabric_cards)) ? $fabric_cards : $default_fabrics;
?>

    <!-- Page Hero Section -->
    <section class="relative px-4 sm:px-6 lg:px-8 pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden bg-gradient-to-br from-primary via-primary-dark to-slate-900">
        <div class="absolute top-0 right-0 -z-10 h-full w-full overflow-hidden">
            <div class="absolute -top-40 -right-40 h-[500px] w-[500px] rounded-full bg-white/5 blur-[100px]"></div>
            <div class="absolute top-1/2 -left-20 h-[300px] w-[300px] rounded-full bg-accent/10 blur-[80px]"></div>
            <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-1/2 bg-gradient-to-t from-black/10 to-transparent"></div>
        </div>
        
        <div class="max-w-7xl mx-auto w-full relative z-10">
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8">
                <div class="flex-1">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-6">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-accent"></span>
                        </span>
                        <span class="text-xs font-semibold text-white uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                    </div>
                    
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-[1.1] tracking-tight mb-6">
                        <?php echo esc_html($hero_before); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame via-tiger-orange to-cayenne-red"><?php echo esc_html($hero_highlight); ?></span><?php echo $hero_after !== '' ? ' ' . esc_html($hero_after) : ''; ?>
                    </h1>
                    
                    <p class="text-lg text-white/90 max-w-2xl leading-relaxed font-light mb-8">
                        <?php echo esc_html($hero_subtext); ?>
                    </p>
                    
                    <div class="flex flex-wrap gap-4">
                        <?php 
                        $btn_style_map = array(
                            'summer' => 'bg-gradient-to-r from-[#50C878] to-[#3DAE57] hover:shadow-[0_0_20px_rgba(80,200,120,0.5)]',
                            'winter' => 'bg-gradient-to-r from-[#1E3A8A] to-[#1E40AF] hover:shadow-[0_0_20px_rgba(30,58,138,0.5)]',
                            'outline' => 'bg-white/10 backdrop-blur-sm border border-white/30 hover:bg-white/20',
                        );
                        $btn_icons = array(0 => 'sun', 1 => 'snowflake', 2 => 'package');
                        foreach ($hero_btns as $idx => $btn) :
                            $b_url = (is_array($btn['link']) && !empty($btn['link']['url'])) ? $btn['link']['url'] : '#';
                            $b_title = (is_array($btn['link']) && !empty($btn['link']['title'])) ? $btn['link']['title'] : 'Button';
                            $b_icon = isset($btn['icon']) ? trim((string) $btn['icon']) : (isset($btn_icons[$idx]) ? $btn_icons[$idx] : 'arrow-right');
                            $b_style_key = isset($btn['style']) ? (string) $btn['style'] : (['summer', 'winter', 'outline'][$idx] ?? 'outline');
                            $b_style = isset($btn_style_map[$b_style_key]) ? $btn_style_map[$b_style_key] : $btn_style_map['outline'];
                        ?>
                        <a href="<?php echo esc_url($b_url); ?>" class="px-4 py-2 sm:px-6 sm:py-3 <?php echo esc_attr($b_style); ?> text-white rounded-full font-bold transition-all transform hover:-translate-y-0.5 flex items-center gap-2 group text-sm sm:text-base">
                            <i data-lucide="<?php echo esc_attr($b_icon); ?>" class="size-4 sm:size-5 group-hover:rotate-90 transition-transform"></i>
                            <?php echo esc_html($b_title); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="relative mt-8 lg:mt-0">
                    <div class="w-64 h-64 md:w-80 md:h-80 rounded-2xl overflow-hidden border-4 border-white/20 shadow-2xl relative">
                        <img src="<?php echo esc_url($hero_img_url); ?>" alt="School Uniform Display" class="w-full h-full object-cover" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 text-white">
                            <p class="text-lg font-bold"><?php echo esc_html($hero_caption1); ?></p>
                            <p class="text-sm opacity-90"><?php echo esc_html($hero_caption2); ?></p>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-32 h-32 rounded-full bg-accent blur-2xl opacity-30 -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Uniform Color Guide -->
    <section class="px-4 sm:px-6 lg:px-8 py-16 bg-white">
        <div class="max-w-7xl mx-auto w-full">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4"><?php echo esc_html($color_heading); ?></h2>
                <p class="text-gray-600 max-w-3xl mx-auto"><?php echo esc_html($color_subtext); ?></p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach ($color_cards as $c) :
                    $c_name = isset($c['name']) ? (string) $c['name'] : '';
                    $c_hex = isset($c['hex']) ? (string) $c['hex'] : '#000';
                    $c_used = isset($c['used_for']) ? (string) $c['used_for'] : '';
                    $c_dl = isset($c['detail_label']) ? (string) $c['detail_label'] : '';
                    $c_dv = isset($c['detail_value']) ? (string) $c['detail_value'] : '';
                ?>
                <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 rounded-lg shadow-lg" style="background-color: <?php echo esc_attr($c_hex); ?>"></div>
                        <div>
                            <h3 class="font-bold text-gray-900"><?php echo esc_html($c_name); ?></h3>
                            <p class="text-sm text-gray-600">HEX: <?php echo esc_html($c_hex); ?></p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-700">Used For:</span>
                            <span class="text-sm font-medium text-gray-900"><?php echo esc_html($c_used); ?></span>
                        </div>
                        <?php if ($c_dl !== '' || $c_dv !== '') : ?>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-700"><?php echo esc_html($c_dl ?: 'Type'); ?>:</span>
                            <span class="text-sm font-medium text-gray-900"><?php echo esc_html($c_dv); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Summer Uniform Section -->
    <section id="summer-uniform" class="px-4 sm:px-6 lg:px-8 py-16 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto w-full">
            <div class="flex items-center justify-between mb-12">
                <div>
                    <span class="bg-gradient-to-br from-green-500 to-green-700 text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider mb-4 inline-flex items-center gap-2">
                        <i data-lucide="sun" class="size-4"></i>
                        <?php echo esc_html($summer_badge); ?>
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900"><?php echo esc_html($summer_heading); ?></h2>
                    <p class="text-gray-600"><?php echo esc_html($summer_subtext); ?></p>
                </div>
            </div>

            <!-- Boys Summer Uniform -->
            <div class="mb-20">
                <div class="flex items-center gap-3 mb-8">
                    <div class="p-3 rounded-lg bg-primary/10">
                        <i data-lucide="user" class="size-7 text-primary"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900"><?php echo esc_html($summer_boys_title); ?></h3>
                        <p class="text-gray-600"><?php echo esc_html($summer_boys_subtext); ?></p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <?php foreach ($summer_boys_items as $item) :
                        $img_url = (is_array($item['image']) && !empty($item['image']['url'])) ? $item['image']['url'] : '';
                        if (empty($img_url)) continue;
                        $badge_cl = (isset($item['badge_style']) && $item['badge_style'] === 'girls') ? 'bg-accent/10 text-accent' : 'bg-[#50C878]/10 text-[#50C878]';
                    ?>
                    <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-lg transition-all duration-300 ease-in-out hover:-translate-y-1 hover:shadow-xl">
                        <div class="h-48 overflow-hidden relative">
                            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($item['title'] ?? ''); ?>" class="w-full h-full object-cover" loading="lazy">
                            <div class="absolute top-4 left-4">
                                <span class="bg-gradient-to-br from-green-500 to-green-700 text-white px-3 py-1 rounded-full text-xs font-bold">SUMMER</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h4 class="text-xl font-bold text-gray-900 mb-2"><?php echo esc_html($item['title'] ?? ''); ?></h4>
                                    <p class="text-gray-600 text-sm"><?php echo esc_html($item['subtitle'] ?? ''); ?></p>
                                </div>
                                <span class="px-3 py-1 rounded-full <?php echo esc_attr($badge_cl); ?> text-xs font-bold"><?php echo esc_html($item['badge'] ?? ''); ?></span>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-6 h-6 rounded" style="background-color: <?php echo esc_attr($item['color_hex'] ?? '#50C878'); ?>"></div>
                                    <span class="text-sm text-gray-700">Color: <?php echo esc_html($item['color_name'] ?? ''); ?></span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <i data-lucide="scissors" class="size-4 text-gray-400"></i>
                                    <span class="text-sm text-gray-700">Design: <?php echo esc_html($item['design'] ?? ''); ?></span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <i data-lucide="package" class="size-4 text-gray-400"></i>
                                    <span class="text-sm text-gray-700">Fabric: <?php echo esc_html($item['fabric'] ?? ''); ?></span>
                                </div>
                            </div>
                            <?php if (!empty($item['note'])) : ?>
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <p class="text-xs text-gray-500"><?php echo esc_html($item['note']); ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="mt-8 bg-gradient-to-r from-[#50C878]/10 to-[#1E3A8A]/10 rounded-2xl p-8 border border-gray-200">
                    <div class="text-center mb-6">
                        <h4 class="text-xl font-bold text-gray-900 mb-2">Complete Summer Uniform Set</h4>
                        <p class="text-gray-600">How the complete uniform should look</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <?php foreach ($summer_boys_set as $s) :
                            $s_url = (is_array($s['image']) && !empty($s['image']['url'])) ? $s['image']['url'] : '';
                            if (empty($s_url)) continue;
                        ?>
                        <div class="text-center">
                            <div class="w-full h-48 rounded-xl overflow-hidden mb-4">
                                <img src="<?php echo esc_url($s_url); ?>" alt="<?php echo esc_attr($s['label'] ?? ''); ?>" class="w-full h-full object-cover" loading="lazy">
                            </div>
                            <p class="text-sm font-medium text-gray-900"><?php echo esc_html($s['label'] ?? ''); ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Girls Summer Uniform -->
            <div>
                <div class="flex items-center gap-3 mb-8">
                    <div class="p-3 rounded-lg bg-accent/10">
                        <i data-lucide="user" class="size-7 text-accent"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900"><?php echo esc_html($summer_girls_title); ?></h3>
                        <p class="text-gray-600"><?php echo esc_html($summer_girls_subtext); ?></p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <?php foreach ($summer_girls_items as $item) :
                        $img_url = (is_array($item['image']) && !empty($item['image']['url'])) ? $item['image']['url'] : '';
                        if (empty($img_url)) continue;
                        $badge_cl = (isset($item['badge_style']) && $item['badge_style'] === 'girls') ? 'bg-accent/10 text-accent' : 'bg-[#50C878]/10 text-[#50C878]';
                    ?>
                    <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-lg transition-all duration-300 ease-in-out hover:-translate-y-1 hover:shadow-xl">
                        <div class="h-48 overflow-hidden relative">
                            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($item['title'] ?? ''); ?>" class="w-full h-full object-cover" loading="lazy">
                            <div class="absolute top-4 left-4">
                                <span class="bg-gradient-to-br from-green-500 to-green-700 text-white px-3 py-1 rounded-full text-xs font-bold">SUMMER</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h4 class="text-xl font-bold text-gray-900 mb-2"><?php echo esc_html($item['title'] ?? ''); ?></h4>
                                    <p class="text-gray-600 text-sm"><?php echo esc_html($item['subtitle'] ?? ''); ?></p>
                                </div>
                                <span class="px-3 py-1 rounded-full <?php echo esc_attr($badge_cl); ?> text-xs font-bold"><?php echo esc_html($item['badge'] ?? ''); ?></span>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-6 h-6 rounded" style="background-color: <?php echo esc_attr($item['color_hex'] ?? '#50C878'); ?>"></div>
                                    <span class="text-sm text-gray-700">Color: <?php echo esc_html($item['color_name'] ?? ''); ?></span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <i data-lucide="scissors" class="size-4 text-gray-400"></i>
                                    <span class="text-sm text-gray-700">Design: <?php echo esc_html($item['design'] ?? ''); ?></span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <i data-lucide="package" class="size-4 text-gray-400"></i>
                                    <span class="text-sm text-gray-700">Fabric: <?php echo esc_html($item['fabric'] ?? ''); ?></span>
                                </div>
                            </div>
                            <?php if (!empty($item['note'])) : ?>
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <p class="text-xs text-gray-500"><?php echo esc_html($item['note']); ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Winter Uniform Section -->
    <section id="winter-uniform" class="px-4 sm:px-6 lg:px-8 py-16 bg-white">
        <div class="max-w-7xl mx-auto w-full">
            <div class="flex items-center justify-between mb-12">
                <div>
                    <span class="bg-gradient-to-br from-blue-800 to-blue-900 text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider mb-4 inline-flex items-center gap-2">
                        <i data-lucide="snowflake" class="size-4"></i>
                        <?php echo esc_html($winter_badge); ?>
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900"><?php echo esc_html($winter_heading); ?></h2>
                    <p class="text-gray-600"><?php echo esc_html($winter_subtext); ?></p>
                </div>
            </div>

            <!-- Boys Winter -->
            <div class="mb-20">
                <div class="flex items-center gap-3 mb-8">
                    <div class="p-3 rounded-lg bg-primary/10">
                        <i data-lucide="user" class="size-7 text-primary"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900"><?php echo esc_html($winter_boys_title); ?></h3>
                        <p class="text-gray-600"><?php echo esc_html($winter_boys_subtext); ?></p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <?php foreach ($winter_boys_items as $item) :
                        $img_url = (is_array($item['image']) && !empty($item['image']['url'])) ? $item['image']['url'] : '';
                        if (empty($img_url)) continue;
                        $badge_cl = (strpos($item['badge'] ?? '', 'SLEEVE') !== false) ? 'bg-[#50C878]/10 text-[#50C878]' : 'bg-[#1E3A8A]/10 text-[#1E3A8A]';
                        if (isset($item['badge']) && $item['badge'] === 'STRIPED') $badge_cl = 'bg-[#1E3A8A]/10 text-[#1E3A8A]';
                        if (isset($item['badge']) && $item['badge'] === 'PLEATED') $badge_cl = 'bg-[#1E3A8A]/10 text-[#1E3A8A]';
                    ?>
                    <div class="bg-white rounded-xl overflow-hidden border border-gray-200 shadow-sm transition-all duration-300 ease-in-out hover:-translate-y-1 hover:shadow-xl">
                        <div class="h-40 overflow-hidden">
                            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($item['title'] ?? ''); ?>" class="w-full h-full object-cover" loading="lazy">
                        </div>
                        <div class="p-5">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="font-bold text-gray-900"><?php echo esc_html($item['title'] ?? ''); ?></h4>
                                <span class="px-2 py-0.5 rounded-full <?php echo esc_attr($badge_cl); ?> text-xs font-bold"><?php echo esc_html($item['badge'] ?? ''); ?></span>
                            </div>
                            <div class="space-y-2">
                                <p class="text-sm text-gray-700"><span class="font-medium">Color:</span> <?php echo esc_html($item['color'] ?? ''); ?></p>
                                <p class="text-sm text-gray-700"><span class="font-medium"><?php echo esc_html(isset($item['detail1']) && strpos($item['detail1'], 'Polycot') !== false ? 'Fabric' : 'Design'); ?>:</span> <?php echo esc_html($item['detail1'] ?? ''); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Blazer -->
                <?php 
                $bl_img = (is_array($winter_blazer['image']) && !empty($winter_blazer['image']['url'])) ? $winter_blazer['image']['url'] : '';
                if (!empty($bl_img)) :
                ?>
                <div class="mt-8 bg-gradient-to-r from-[#1E3A8A]/5 to-transparent rounded-2xl p-8 border border-[#1E3A8A]/20">
                    <div class="flex flex-col md:flex-row items-center gap-8">
                        <div class="md:w-1/3">
                            <div class="rounded-xl overflow-hidden border border-gray-300">
                                <img src="<?php echo esc_url($bl_img); ?>" alt="School Blazer" class="w-full h-64 object-cover" loading="lazy">
                            </div>
                        </div>
                        <div class="md:w-2/3">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="p-2 rounded-lg bg-[#1E3A8A]/20">
                                    <i data-lucide="coat-hanger" class="size-6 text-[#1E3A8A]"></i>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-gray-900"><?php echo esc_html($winter_blazer['title'] ?? 'School Blazer (Optional)'); ?></h4>
                                    <p class="text-sm text-gray-600"><?php echo esc_html($winter_blazer['subtitle'] ?? ''); ?></p>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-700"><span class="font-medium">Color:</span> <?php echo esc_html($winter_blazer['color'] ?? 'Navy Blue'); ?></p>
                                    <p class="text-sm text-gray-700"><span class="font-medium">Design:</span> <?php echo esc_html($winter_blazer['design'] ?? 'Double/Single breasted'); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-700"><span class="font-medium">Logo:</span> <?php echo esc_html($winter_blazer['logo'] ?? 'Left chest pocket'); ?></p>
                                    <p class="text-sm text-gray-700"><span class="font-medium">Note:</span> <?php echo esc_html($winter_blazer['primary_note'] ?? 'Not compulsory for primary classes'); ?></p>
                                </div>
                            </div>
                            <?php if (!empty($winter_blazer['note'])) : ?>
                            <div class="mt-4 p-4 bg-white/50 rounded-lg border border-gray-200">
                                <p class="text-xs text-gray-600">
                                    <i data-lucide="info" class="size-4 inline mr-2 text-[#1E3A8A]"></i>
                                    <?php echo esc_html($winter_blazer['note']); ?>
                                </p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Girls Winter -->
            <div>
                <div class="flex items-center gap-3 mb-8">
                    <div class="p-3 rounded-lg bg-accent/10">
                        <i data-lucide="user" class="size-7 text-accent"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900"><?php echo esc_html($winter_girls_title); ?></h3>
                        <p class="text-gray-600"><?php echo esc_html($winter_girls_subtext); ?></p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <?php foreach ($winter_girls_items as $item) :
                        $img_url = (is_array($item['image']) && !empty($item['image']['url'])) ? $item['image']['url'] : '';
                        if (empty($img_url)) continue;
                        $badge_cl = ($item['badge'] ?? '') === 'STRIPED' ? 'bg-accent/10 text-accent' : (strpos($item['badge'] ?? '', 'SLEEVE') !== false ? 'bg-[#50C878]/10 text-[#50C878]' : 'bg-[#1E3A8A]/10 text-[#1E3A8A]');
                    ?>
                    <div class="bg-white rounded-xl overflow-hidden border border-gray-200 shadow-sm transition-all duration-300 ease-in-out hover:-translate-y-1 hover:shadow-xl">
                        <div class="h-40 overflow-hidden">
                            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($item['title'] ?? ''); ?>" class="w-full h-full object-cover" loading="lazy">
                        </div>
                        <div class="p-5">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="font-bold text-gray-900"><?php echo esc_html($item['title'] ?? ''); ?></h4>
                                <span class="px-2 py-0.5 rounded-full <?php echo esc_attr($badge_cl); ?> text-xs font-bold"><?php echo esc_html($item['badge'] ?? ''); ?></span>
                            </div>
                            <div class="space-y-2">
                                <p class="text-sm text-gray-700"><span class="font-medium">Color:</span> <?php echo esc_html($item['color'] ?? ''); ?></p>
                                <p class="text-sm text-gray-700"><span class="font-medium"><?php echo esc_html(isset($item['detail1']) && strpos($item['detail1'], 'Polycot') !== false ? 'Fabric' : 'Option'); ?>:</span> <?php echo esc_html($item['detail1'] ?? ''); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php foreach ($winter_options as $wo) :
                        $wo_style = isset($wo['style']) ? (string) $wo['style'] : 'green';
                        $wo_bg = $wo_style === 'accent' ? 'from-accent/5 to-transparent border-accent/20' : 'from-[#50C878]/5 to-transparent border-[#50C878]/20';
                        $wo_icon_bg = $wo_style === 'accent' ? 'bg-accent/10' : 'bg-[#50C878]/10';
                        $wo_icon_cl = $wo_style === 'accent' ? 'text-accent' : 'text-[#50C878]';
                    ?>
                    <div class="bg-gradient-to-br <?php echo esc_attr($wo_bg); ?> rounded-xl p-6 border <?php echo esc_attr($wo_style === 'accent' ? 'border-accent/20' : 'border-[#50C878]/20'); ?>">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 rounded-lg <?php echo esc_attr($wo_icon_bg); ?>">
                                <i data-lucide="<?php echo esc_attr($wo['icon'] ?? 'thermometer'); ?>" class="size-5 <?php echo esc_attr($wo_icon_cl); ?>"></i>
                            </div>
                            <h4 class="font-bold text-gray-900"><?php echo esc_html($wo['title'] ?? ''); ?></h4>
                        </div>
                        <p class="text-sm text-gray-700"><?php echo esc_html($wo['paragraph'] ?? ''); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Common Accessories Section -->
    <section id="common-items" class="px-4 sm:px-6 lg:px-8 py-16 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto w-full">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4"><?php echo esc_html($acc_heading); ?></h2>
                <p class="text-gray-600 max-w-2xl mx-auto"><?php echo esc_html($acc_subtext); ?></p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <?php foreach ($acc_items as $a) :
                    $a_url = (is_array($a['image']) && !empty($a['image']['url'])) ? $a['image']['url'] : '';
                    if (empty($a_url)) continue;
                ?>
                <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm transition-all duration-300 ease-in-out hover:-translate-y-1 hover:shadow-xl">
                    <div class="h-48 overflow-hidden relative">
                        <img src="<?php echo esc_url($a_url); ?>" alt="<?php echo esc_attr($a['title'] ?? ''); ?>" class="w-full h-full object-cover" loading="lazy">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 rounded-full bg-primary text-white text-xs font-bold">COMMON</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-2"><?php echo esc_html($a['title'] ?? ''); ?></h3>
                        <p class="text-sm text-gray-600 mb-4"><?php echo esc_html($a['description'] ?? ''); ?></p>
                        <?php 
                        $swatches = isset($a['color_swatches']) && is_array($a['color_swatches']) ? $a['color_swatches'] : array();
                        $color_text = isset($a['color_text']) ? (string) $a['color_text'] : (isset($a['color_info']) ? (string) $a['color_info'] : '');
                        if (!empty($swatches) || $color_text !== '') :
                            $swatch_count = count($swatches);
                            $swatch_size = $swatch_count >= 3 ? 'w-4 h-4' : 'w-6 h-6';
                            $swatch_gap = $swatch_count >= 3 ? 'gap-1' : 'gap-2';
                        ?>
                        <div class="flex items-center <?php echo esc_attr($swatch_gap); ?>">
                            <?php foreach ($swatches as $sw) : 
                                $hex = isset($sw['hex']) ? trim((string) $sw['hex']) : '#1E3A8A';
                                if ($hex === '') $hex = '#1E3A8A';
                                $use_border = !empty($sw['use_border']);
                            ?>
                            <div class="<?php echo esc_attr($swatch_size); ?> rounded flex-shrink-0<?php echo $use_border ? ' border border-gray-300' : ''; ?>" style="background-color: <?php echo esc_attr($hex); ?>;"></div>
                            <?php endforeach; ?>
                            <?php if ($color_text !== '') : ?>
                            <span class="text-sm text-gray-700<?php echo $swatch_count >= 3 ? ' ml-2' : ''; ?>"><?php echo esc_html($color_text); ?></span>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="mt-12 bg-white rounded-2xl p-8 border border-gray-200 shadow-lg">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 rounded-lg bg-[#F35B04]/10">
                        <i data-lucide="alert-circle" class="size-6 text-[#F35B04]"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900">Important Instructions</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php foreach (array_chunk($acc_instructions, 2) as $chunk) : ?>
                    <div class="space-y-4">
                        <?php foreach ($chunk as $inst) : ?>
                        <div class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="size-5 text-[#50C878] mt-1"></i>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1"><?php echo esc_html($inst['title'] ?? ''); ?></h4>
                                <p class="text-sm text-gray-700"><?php echo esc_html($inst['paragraph'] ?? ''); ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Fabric Details Section -->
    <section class="px-4 sm:px-6 lg:px-8 py-16 bg-white">
        <div class="max-w-7xl mx-auto w-full">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4"><?php echo esc_html($fabric_heading); ?></h2>
                <p class="text-gray-600 max-w-2xl mx-auto"><?php echo esc_html($fabric_subtext); ?></p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <?php foreach ($fabric_cards as $fc) :
                    $fc_style = isset($fc['style']) ? (string) $fc['style'] : 'green';
                    $fc_color = $fc_style === 'navy' ? '#1E3A8A' : '#50C878';
                    $fc_features = isset($fc['features']) && is_array($fc['features']) ? $fc['features'] : array();
                    $fc_bg = $fc_style === 'navy' ? 'background-image: linear-gradient(to right, rgba(30,58,138,0.2), transparent)' : 'background-image: linear-gradient(to right, rgba(80,200,120,0.2), transparent)';
                ?>
                <div class="rounded-2xl overflow-hidden border border-gray-200 p-8" style="<?php echo esc_attr($fc_bg); ?>">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-3 rounded-full bg-white">
                            <i data-lucide="<?php echo esc_attr($fc['icon'] ?? 'leaf'); ?>" class="size-8" style="color: <?php echo esc_attr($fc_color); ?>"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900"><?php echo esc_html($fc['title'] ?? ''); ?></h3>
                            <p class="text-gray-600"><?php echo esc_html($fc['subtitle'] ?? ''); ?></p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div class="bg-white/80 rounded-xl p-4">
                            <p class="text-sm text-gray-600 mb-1"><?php echo esc_html($fc['comp1_label'] ?? ''); ?></p>
                            <p class="text-2xl font-bold" style="color: <?php echo esc_attr($fc_color); ?>"><?php echo esc_html($fc['comp1_value'] ?? ''); ?></p>
                        </div>
                        <div class="bg-white/80 rounded-xl p-4">
                            <p class="text-sm text-gray-600 mb-1"><?php echo esc_html($fc['comp2_label'] ?? ''); ?></p>
                            <p class="text-2xl font-bold" style="color: <?php echo esc_attr($fc_color); ?>"><?php echo esc_html($fc['comp2_value'] ?? ''); ?></p>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <?php foreach ($fc_features as $feat) : 
                            $feat_text = is_array($feat) && isset($feat['text']) ? (string) $feat['text'] : (is_string($feat) ? $feat : '');
                            if ($feat_text === '') continue;
                        ?>
                        <div class="flex items-center gap-3">
                            <i data-lucide="check" class="size-5" style="color: <?php echo esc_attr($fc_color); ?>"></i>
                            <span class="text-gray-700"><?php echo esc_html($feat_text); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
