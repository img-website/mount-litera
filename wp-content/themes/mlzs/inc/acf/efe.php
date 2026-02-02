<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Eco Friendly Environment (EFE) Page – Hero, Top 3 Cards, No Smoking, Three Column, World Conservation, Community (all icons dynamic)
 */
function mlzs_acf_efe_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_efe',
        'title'                 => __('Eco Friendly Environment Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_efe_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_efe_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'efe_hero_badge', 'type' => 'text', 'default_value' => 'Sustainability Initiative'),
            array('key' => 'field_efe_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'efe_hero_icon', 'type' => 'text', 'default_value' => 'leaf'),
            array('key' => 'field_efe_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'efe_hero_headline', 'type' => 'text', 'default_value' => 'Eco Friendly'),
            array('key' => 'field_efe_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'efe_hero_highlight', 'type' => 'text', 'default_value' => 'Environment'),
            array('key' => 'field_efe_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'efe_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Committed to creating a sustainable future through innovative environmental practices and community awareness'),
            array('key' => 'field_efe_tab_top', 'label' => __('Top 3 Cards', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_efe_top_cards', 'label' => __('Zero Garbage / Paper Recycling / Holding Exhibitions', 'mlzs'), 'name' => 'efe_top_cards', 'type' => 'repeater', 'min' => 3, 'max' => 3, 'layout' => 'block', 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_efe_top_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'trash-2'),
                array('key' => 'field_efe_top_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_efe_top_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'textarea', 'rows' => 4),
            )),
            array('key' => 'field_efe_tab_smoking', 'label' => __('No Smoking Zone', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_efe_smoking_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'efe_smoking_icon', 'type' => 'text', 'default_value' => 'ban'),
            array('key' => 'field_efe_smoking_title', 'label' => __('Section Title', 'mlzs'), 'name' => 'efe_smoking_title', 'type' => 'text', 'default_value' => 'No Smoking Zone'),
            array('key' => 'field_efe_smoking_text', 'label' => __('Paragraph', 'mlzs'), 'name' => 'efe_smoking_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_efe_smoking_box1_icon', 'label' => __('Box 1 Icon', 'mlzs'), 'name' => 'efe_smoking_box1_icon', 'type' => 'text', 'default_value' => 'shield'),
            array('key' => 'field_efe_smoking_box1_title', 'label' => __('Box 1 Title', 'mlzs'), 'name' => 'efe_smoking_box1_title', 'type' => 'text', 'default_value' => 'Anti Poly Bag Campaign'),
            array('key' => 'field_efe_smoking_box1_text', 'label' => __('Box 1 Text', 'mlzs'), 'name' => 'efe_smoking_box1_text', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_efe_smoking_box2_icon', 'label' => __('Box 2 Icon', 'mlzs'), 'name' => 'efe_smoking_box2_icon', 'type' => 'text', 'default_value' => 'book-open'),
            array('key' => 'field_efe_smoking_box2_title', 'label' => __('Box 2 Title', 'mlzs'), 'name' => 'efe_smoking_box2_title', 'type' => 'text', 'default_value' => 'Environment Quotient'),
            array('key' => 'field_efe_smoking_box2_text', 'label' => __('Box 2 Text', 'mlzs'), 'name' => 'efe_smoking_box2_text', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_efe_tab_three', 'label' => __('Three Column Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_efe_three_cards', 'label' => __('Rakhi Tying / Earth Watch / Van Mahotsav (3 cards)', 'mlzs'), 'name' => 'efe_three_cards', 'type' => 'repeater', 'min' => 3, 'max' => 3, 'layout' => 'block', 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_efe_three_icon', 'label' => __('Card Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'heart'),
                array('key' => 'field_efe_three_title', 'label' => __('Card Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_efe_three_description', 'label' => __('Card Description', 'mlzs'), 'name' => 'description', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_efe_three_sub_boxes', 'label' => __('Sub boxes (icon + title + text)', 'mlzs'), 'name' => 'sub_boxes', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Box', 'mlzs'), 'sub_fields' => array(
                    array('key' => 'field_efe_three_sub_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                    array('key' => 'field_efe_three_sub_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                    array('key' => 'field_efe_three_sub_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'textarea', 'rows' => 2),
                )),
                array('key' => 'field_efe_three_list_items', 'label' => __('List items (icon + text) – use if no sub boxes', 'mlzs'), 'name' => 'list_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                    array('key' => 'field_efe_three_list_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                    array('key' => 'field_efe_three_list_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
                )),
            )),
            array('key' => 'field_efe_tab_world', 'label' => __('World Conservation Day', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_efe_world_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'efe_world_icon', 'type' => 'text', 'default_value' => 'globe'),
            array('key' => 'field_efe_world_title', 'label' => __('Section Title', 'mlzs'), 'name' => 'efe_world_title', 'type' => 'text', 'default_value' => 'World Conservation Day'),
            array('key' => 'field_efe_world_text', 'label' => __('Paragraph', 'mlzs'), 'name' => 'efe_world_text', 'type' => 'textarea', 'rows' => 5),
            array('key' => 'field_efe_world_boxes', 'label' => __('Two boxes (icon + title + description)', 'mlzs'), 'name' => 'efe_world_boxes', 'type' => 'repeater', 'min' => 2, 'max' => 2, 'layout' => 'table', 'button_label' => __('Add Box', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_efe_world_box_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'users'),
                array('key' => 'field_efe_world_box_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_efe_world_box_text', 'label' => __('Description', 'mlzs'), 'name' => 'text', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_efe_tab_community', 'label' => __('Community Involvement', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_efe_community_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'efe_community_icon', 'type' => 'text', 'default_value' => 'users'),
            array('key' => 'field_efe_community_title', 'label' => __('Section Title', 'mlzs'), 'name' => 'efe_community_title', 'type' => 'text', 'default_value' => 'Community Involvement'),
            array('key' => 'field_efe_community_text', 'label' => __('Paragraph', 'mlzs'), 'name' => 'efe_community_text', 'type' => 'textarea', 'rows' => 5),
            array('key' => 'field_efe_community_boxes', 'label' => __('Three boxes (icon + label)', 'mlzs'), 'name' => 'efe_community_boxes', 'type' => 'repeater', 'min' => 3, 'max' => 3, 'layout' => 'table', 'button_label' => __('Add Box', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_efe_community_box_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'file-text'),
                array('key' => 'field_efe_community_box_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'efe.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_efe_field_group');
