<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Uniform Page – Hero, Color Guide, Summer Uniform, Winter Uniform, Common Accessories, Fabric Specs
 */
function mlzs_acf_uniform_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_uniform',
        'title'                 => __('Uniform Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_uni_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_uni_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'uniform_hero_badge', 'type' => 'text', 'default_value' => 'School Dress Code'),
            array('key' => 'field_uni_hero_headline_before', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'uniform_hero_headline_before', 'type' => 'text', 'default_value' => 'School'),
            array('key' => 'field_uni_hero_headline_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'uniform_hero_headline_highlight', 'type' => 'text', 'default_value' => 'Uniform'),
            array('key' => 'field_uni_hero_headline_after', 'label' => __('Headline (after highlight)', 'mlzs'), 'name' => 'uniform_hero_headline_after', 'type' => 'text', 'default_value' => 'Guide'),
            array('key' => 'field_uni_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'uniform_hero_subtext', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_uni_hero_buttons', 'label' => __('Hero Buttons (3)', 'mlzs'), 'name' => 'uniform_hero_buttons', 'type' => 'repeater', 'layout' => 'row', 'min' => 0, 'button_label' => __('Add Button', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_uni_btn_link', 'label' => __('Link', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array'),
                array('key' => 'field_uni_btn_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'sun', 'instructions' => __('e.g. sun, snowflake, package', 'mlzs')),
                array('key' => 'field_uni_btn_style', 'label' => __('Color / Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('summer' => __('Summer Green', 'mlzs'), 'winter' => __('Winter Blue', 'mlzs'), 'outline' => __('Outline / Glass', 'mlzs')), 'default_value' => 'summer'),
            )),
            array('key' => 'field_uni_hero_image', 'label' => __('Hero Image', 'mlzs'), 'name' => 'uniform_hero_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_uni_hero_caption1', 'label' => __('Hero Caption Line 1', 'mlzs'), 'name' => 'uniform_hero_caption1', 'type' => 'text', 'default_value' => 'School Uniform'),
            array('key' => 'field_uni_hero_caption2', 'label' => __('Hero Caption Line 2', 'mlzs'), 'name' => 'uniform_hero_caption2', 'type' => 'text', 'default_value' => 'Light Green & Navy Blue'),
            array('key' => 'field_uni_tab_colors', 'label' => __('Color Guide', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_uni_color_heading', 'label' => __('Section Heading', 'mlzs'), 'name' => 'uniform_color_heading', 'type' => 'text', 'default_value' => 'Uniform Color Guide'),
            array('key' => 'field_uni_color_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'uniform_color_subtext', 'type' => 'text'),
            array('key' => 'field_uni_color_cards', 'label' => __('Color Cards (4)', 'mlzs'), 'name' => 'uniform_color_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'button_label' => __('Add Color', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_uni_color_name', 'label' => __('Color Name', 'mlzs'), 'name' => 'name', 'type' => 'text'),
                array('key' => 'field_uni_color_hex', 'label' => __('HEX Code', 'mlzs'), 'name' => 'hex', 'type' => 'text', 'default_value' => '#50C878'),
                array('key' => 'field_uni_color_used', 'label' => __('Used For', 'mlzs'), 'name' => 'used_for', 'type' => 'text'),
                array('key' => 'field_uni_color_detail_label', 'label' => __('Detail Label', 'mlzs'), 'name' => 'detail_label', 'type' => 'text', 'default_value' => 'Fabric'),
                array('key' => 'field_uni_color_detail_value', 'label' => __('Detail Value', 'mlzs'), 'name' => 'detail_value', 'type' => 'text'),
            )),
            array('key' => 'field_uni_tab_summer', 'label' => __('Summer Uniform', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_uni_summer_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'uniform_summer_badge', 'type' => 'text', 'default_value' => 'Academic Year 2015-16'),
            array('key' => 'field_uni_summer_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'uniform_summer_heading', 'type' => 'text', 'default_value' => 'Summer Uniform'),
            array('key' => 'field_uni_summer_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'uniform_summer_subtext', 'type' => 'text'),
            array('key' => 'field_uni_summer_boys_title', 'label' => __('Boys Section Title', 'mlzs'), 'name' => 'uniform_summer_boys_title', 'type' => 'text'),
            array('key' => 'field_uni_summer_boys_subtext', 'label' => __('Boys Section Subtext', 'mlzs'), 'name' => 'uniform_summer_boys_subtext', 'type' => 'text'),
            array('key' => 'field_uni_summer_boys_items', 'label' => __('Boys Items', 'mlzs'), 'name' => 'uniform_summer_boys_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_uni_sum_img', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_uni_sum_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_uni_sum_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'subtitle', 'type' => 'text'),
                array('key' => 'field_uni_sum_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'badge', 'type' => 'text', 'default_value' => 'BOYS'),
                array('key' => 'field_uni_sum_badge_style', 'label' => __('Badge Style', 'mlzs'), 'name' => 'badge_style', 'type' => 'select', 'choices' => array('boys' => 'Boys (Green)', 'girls' => 'Girls (Accent)'), 'default_value' => 'boys'),
                array('key' => 'field_uni_sum_color_name', 'label' => __('Color Name', 'mlzs'), 'name' => 'color_name', 'type' => 'text'),
                array('key' => 'field_uni_sum_color_hex', 'label' => __('Color HEX', 'mlzs'), 'name' => 'color_hex', 'type' => 'text'),
                array('key' => 'field_uni_sum_design', 'label' => __('Design', 'mlzs'), 'name' => 'design', 'type' => 'text'),
                array('key' => 'field_uni_sum_fabric', 'label' => __('Fabric', 'mlzs'), 'name' => 'fabric', 'type' => 'text'),
                array('key' => 'field_uni_sum_note', 'label' => __('Note', 'mlzs'), 'name' => 'note', 'type' => 'text'),
            )),
            array('key' => 'field_uni_summer_boys_set', 'label' => __('Boys Complete Set Images (3)', 'mlzs'), 'name' => 'uniform_summer_boys_set', 'type' => 'repeater', 'layout' => 'row', 'min' => 0, 'button_label' => __('Add Image', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_uni_set_img', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_uni_set_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Front View'),
            )),
            array('key' => 'field_uni_summer_girls_title', 'label' => __('Girls Section Title', 'mlzs'), 'name' => 'uniform_summer_girls_title', 'type' => 'text'),
            array('key' => 'field_uni_summer_girls_subtext', 'label' => __('Girls Section Subtext', 'mlzs'), 'name' => 'uniform_summer_girls_subtext', 'type' => 'text'),
            array('key' => 'field_uni_summer_girls_items', 'label' => __('Girls Items', 'mlzs'), 'name' => 'uniform_summer_girls_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_uni_sumg_img', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_uni_sumg_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_uni_sumg_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'subtitle', 'type' => 'text'),
                array('key' => 'field_uni_sumg_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'badge', 'type' => 'text', 'default_value' => 'GIRLS'),
                array('key' => 'field_uni_sumg_badge_style', 'label' => __('Badge Style', 'mlzs'), 'name' => 'badge_style', 'type' => 'select', 'choices' => array('boys' => 'Boys', 'girls' => 'Girls'), 'default_value' => 'girls'),
                array('key' => 'field_uni_sumg_color_name', 'label' => __('Color Name', 'mlzs'), 'name' => 'color_name', 'type' => 'text'),
                array('key' => 'field_uni_sumg_color_hex', 'label' => __('Color HEX', 'mlzs'), 'name' => 'color_hex', 'type' => 'text'),
                array('key' => 'field_uni_sumg_design', 'label' => __('Design', 'mlzs'), 'name' => 'design', 'type' => 'text'),
                array('key' => 'field_uni_sumg_fabric', 'label' => __('Fabric', 'mlzs'), 'name' => 'fabric', 'type' => 'text'),
                array('key' => 'field_uni_sumg_note', 'label' => __('Note', 'mlzs'), 'name' => 'note', 'type' => 'text'),
            )),
            array('key' => 'field_uni_tab_winter', 'label' => __('Winter Uniform', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_uni_winter_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'uniform_winter_badge', 'type' => 'text', 'default_value' => 'Academic Year 2014-15'),
            array('key' => 'field_uni_winter_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'uniform_winter_heading', 'type' => 'text', 'default_value' => 'Winter Uniform'),
            array('key' => 'field_uni_winter_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'uniform_winter_subtext', 'type' => 'text'),
            array('key' => 'field_uni_winter_boys_title', 'label' => __('Boys Section Title', 'mlzs'), 'name' => 'uniform_winter_boys_title', 'type' => 'text'),
            array('key' => 'field_uni_winter_boys_subtext', 'label' => __('Boys Section Subtext', 'mlzs'), 'name' => 'uniform_winter_boys_subtext', 'type' => 'text'),
            array('key' => 'field_uni_winter_boys_items', 'label' => __('Boys Items (3)', 'mlzs'), 'name' => 'uniform_winter_boys_items', 'type' => 'repeater', 'layout' => 'row', 'min' => 0, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_uni_win_img', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_uni_win_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_uni_win_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'badge', 'type' => 'text'),
                array('key' => 'field_uni_win_color', 'label' => __('Color', 'mlzs'), 'name' => 'color', 'type' => 'text'),
                array('key' => 'field_uni_win_detail1', 'label' => __('Detail', 'mlzs'), 'name' => 'detail1', 'type' => 'text'),
            )),
            array('key' => 'field_uni_winter_blazer', 'label' => __('Blazer (Group)', 'mlzs'), 'name' => 'uniform_winter_blazer', 'type' => 'group', 'sub_fields' => array(
                array('key' => 'field_uni_blazer_img', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_uni_blazer_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'School Blazer (Optional)'),
                array('key' => 'field_uni_blazer_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'subtitle', 'type' => 'text', 'default_value' => 'For formal occasions and extreme cold'),
                array('key' => 'field_uni_blazer_color', 'label' => __('Color', 'mlzs'), 'name' => 'color', 'type' => 'text', 'default_value' => 'Navy Blue'),
                array('key' => 'field_uni_blazer_design', 'label' => __('Design', 'mlzs'), 'name' => 'design', 'type' => 'text', 'default_value' => 'Double/Single breasted'),
                array('key' => 'field_uni_blazer_logo', 'label' => __('Logo', 'mlzs'), 'name' => 'logo', 'type' => 'text', 'default_value' => 'Left chest pocket'),
                array('key' => 'field_uni_blazer_primary_note', 'label' => __('Primary Note', 'mlzs'), 'name' => 'primary_note', 'type' => 'text', 'default_value' => 'Not compulsory for primary classes', 'instructions' => __('Short note in the grid, e.g. Not compulsory for primary classes', 'mlzs')),
                array('key' => 'field_uni_blazer_note', 'label' => __('Info Box Note', 'mlzs'), 'name' => 'note', 'type' => 'textarea', 'rows' => 2, 'instructions' => __('Full note in the info box below', 'mlzs')),
            )),
            array('key' => 'field_uni_winter_girls_title', 'label' => __('Girls Section Title', 'mlzs'), 'name' => 'uniform_winter_girls_title', 'type' => 'text'),
            array('key' => 'field_uni_winter_girls_subtext', 'label' => __('Girls Section Subtext', 'mlzs'), 'name' => 'uniform_winter_girls_subtext', 'type' => 'text'),
            array('key' => 'field_uni_winter_girls_items', 'label' => __('Girls Items (3)', 'mlzs'), 'name' => 'uniform_winter_girls_items', 'type' => 'repeater', 'layout' => 'row', 'min' => 0, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_uni_wing_img', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_uni_wing_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_uni_wing_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'badge', 'type' => 'text'),
                array('key' => 'field_uni_wing_color', 'label' => __('Color', 'mlzs'), 'name' => 'color', 'type' => 'text'),
                array('key' => 'field_uni_wing_detail1', 'label' => __('Detail', 'mlzs'), 'name' => 'detail1', 'type' => 'text'),
            )),
            array('key' => 'field_uni_winter_options', 'label' => __('Winter Options (2 cards)', 'mlzs'), 'name' => 'uniform_winter_options', 'type' => 'repeater', 'layout' => 'row', 'min' => 0, 'button_label' => __('Add Option', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_uni_opt_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'thermometer'),
                array('key' => 'field_uni_opt_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_uni_opt_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_uni_opt_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('green' => 'Green', 'accent' => 'Accent'), 'default_value' => 'green'),
            )),
            array('key' => 'field_uni_tab_accessories', 'label' => __('Common Accessories', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_uni_acc_heading', 'label' => __('Section Heading', 'mlzs'), 'name' => 'uniform_acc_heading', 'type' => 'text', 'default_value' => 'Common Accessories'),
            array('key' => 'field_uni_acc_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'uniform_acc_subtext', 'type' => 'text'),
            array('key' => 'field_uni_acc_items', 'label' => __('Accessory Items (4)', 'mlzs'), 'name' => 'uniform_acc_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_uni_acc_img', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_uni_acc_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_uni_acc_desc', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'text'),
                array('key' => 'field_uni_acc_color_text', 'label' => __('Color Text', 'mlzs'), 'name' => 'color_text', 'type' => 'text', 'instructions' => __('Label next to color swatches, e.g. Navy Blue, Black, Striped, Two options', 'mlzs')),
                array('key' => 'field_uni_acc_color_swatches', 'label' => __('Color Swatches', 'mlzs'), 'name' => 'color_swatches', 'type' => 'repeater', 'layout' => 'table', 'min' => 0, 'button_label' => __('Add Swatch', 'mlzs'), 'sub_fields' => array(
                    array('key' => 'field_uni_acc_swatch_hex', 'label' => __('HEX', 'mlzs'), 'name' => 'hex', 'type' => 'text', 'default_value' => '#1E3A8A', 'instructions' => __('e.g. #1E3A8A, #F7B801, #ffffff (use_border for white)', 'mlzs')),
                    array('key' => 'field_uni_acc_swatch_border', 'label' => __('Add Border', 'mlzs'), 'name' => 'use_border', 'type' => 'true_false', 'default_value' => 0, 'ui' => 1, 'instructions' => __('Check for white/light swatches', 'mlzs')),
                )),
            )),
            array('key' => 'field_uni_acc_instructions', 'label' => __('Important Instructions', 'mlzs'), 'name' => 'uniform_acc_instructions', 'type' => 'repeater', 'layout' => 'row', 'min' => 0, 'button_label' => __('Add Instruction', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_uni_inst_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_uni_inst_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_uni_tab_fabric', 'label' => __('Fabric Specifications', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_uni_fabric_heading', 'label' => __('Section Heading', 'mlzs'), 'name' => 'uniform_fabric_heading', 'type' => 'text', 'default_value' => 'Fabric Specifications'),
            array('key' => 'field_uni_fabric_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'uniform_fabric_subtext', 'type' => 'text'),
            array('key' => 'field_uni_fabric_cards', 'label' => __('Fabric Cards (2)', 'mlzs'), 'name' => 'uniform_fabric_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'button_label' => __('Add Fabric', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_uni_fab_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'leaf'),
                array('key' => 'field_uni_fab_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_uni_fab_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'subtitle', 'type' => 'text'),
                array('key' => 'field_uni_fab_comp1_label', 'label' => __('Component 1 Label', 'mlzs'), 'name' => 'comp1_label', 'type' => 'text'),
                array('key' => 'field_uni_fab_comp1_value', 'label' => __('Component 1 Value', 'mlzs'), 'name' => 'comp1_value', 'type' => 'text'),
                array('key' => 'field_uni_fab_comp2_label', 'label' => __('Component 2 Label', 'mlzs'), 'name' => 'comp2_label', 'type' => 'text'),
                array('key' => 'field_uni_fab_comp2_value', 'label' => __('Component 2 Value', 'mlzs'), 'name' => 'comp2_value', 'type' => 'text'),
                array('key' => 'field_uni_fab_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('green' => 'Green (#50C878)', 'navy' => 'Navy (#1E3A8A)'), 'default_value' => 'green'),
                array('key' => 'field_uni_fab_features', 'label' => __('Features List', 'mlzs'), 'name' => 'features', 'type' => 'repeater', 'layout' => 'table', 'min' => 0, 'button_label' => __('Add Feature', 'mlzs'), 'sub_fields' => array(
                    array('key' => 'field_uni_fab_feat_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
                )),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'uniform.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_uniform_field_group');
