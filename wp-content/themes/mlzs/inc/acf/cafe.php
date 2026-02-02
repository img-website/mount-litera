<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Cafe (School Cafe) Page – Hero, Overview
 */
function mlzs_acf_cafe_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_cafe',
        'title'                 => __('Cafe Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_cafe_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key' => 'field_cafe_hero_badge',
                'label' => __('Badge Text', 'mlzs'),
                'name' => 'cafe_hero_badge',
                'type' => 'text',
                'default_value' => 'Campus Dining',
            ),
            array(
                'key' => 'field_cafe_hero_badge_icon',
                'label' => __('Badge Icon', 'mlzs'),
                'name' => 'cafe_hero_badge_icon',
                'type' => 'text',
                'default_value' => 'coffee',
            ),
            array(
                'key' => 'field_cafe_hero_headline',
                'label' => __('Headline (before highlight)', 'mlzs'),
                'name' => 'cafe_hero_headline',
                'type' => 'text',
                'default_value' => 'School',
            ),
            array(
                'key' => 'field_cafe_hero_highlight',
                'label' => __('Headline (highlighted)', 'mlzs'),
                'name' => 'cafe_hero_highlight',
                'type' => 'text',
                'default_value' => 'Cafe',
            ),
            array(
                'key' => 'field_cafe_hero_subheadline',
                'label' => __('Subheadline', 'mlzs'),
                'name' => 'cafe_hero_subheadline',
                'type' => 'textarea',
                'rows' => 2,
                'default_value' => 'A welcoming space for students to relax, refuel, and connect over nutritious meals and refreshments',
            ),
            array('key' => 'field_cafe_tab_overview', 'label' => __('Overview Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key' => 'field_cafe_overview_badge',
                'label' => __('Badge Text', 'mlzs'),
                'name' => 'cafe_overview_badge',
                'type' => 'text',
                'default_value' => 'Dining Experience',
            ),
            array(
                'key' => 'field_cafe_overview_heading',
                'label' => __('Section Heading', 'mlzs'),
                'name' => 'cafe_overview_heading',
                'type' => 'text',
                'default_value' => 'More Than Just Food',
            ),
            array(
                'key' => 'field_cafe_overview_description',
                'label' => __('Description Paragraphs', 'mlzs'),
                'name' => 'cafe_overview_description',
                'type' => 'textarea',
                'rows' => 5,
                'default_value' => "Our school cafe provides a comfortable and welcoming environment where students can enjoy nutritious meals, healthy snacks, and refreshing beverages. It serves as a social hub where students can relax, connect with friends, and recharge during breaks.\n\nWe prioritize health and nutrition, offering a variety of balanced meal options that cater to different dietary preferences and requirements.",
            ),
            array(
                'key' => 'field_cafe_overview_image',
                'label' => __('Right Side Image', 'mlzs'),
                'name' => 'cafe_overview_image',
                'type' => 'image',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_cafe_overview_card_title',
                'label' => __('Overlay Card Title', 'mlzs'),
                'name' => 'cafe_overview_card_title',
                'type' => 'text',
                'default_value' => 'Fresh',
            ),
            array(
                'key' => 'field_cafe_overview_card_label',
                'label' => __('Overlay Card Label', 'mlzs'),
                'name' => 'cafe_overview_card_label',
                'type' => 'text',
                'default_value' => 'Daily Meals',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'cafe.php',
                ),
            ),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_cafe_field_group');
