<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Reach Us Page – Hero, Contact & Location, Quick Actions, Map, Transportation
 */
function mlzs_acf_reach_field_group() {
    if (!function_exists('acf_add_local_field_group')) return;
    acf_add_local_field_group(array(
        'key' => 'group_mlzs_reach',
        'title' => __('Reach Us Page Sections', 'mlzs'),
        'fields' => array(
            array('key' => 'field_reach_tab_hero', 'label' => __('Hero', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_reach_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'reach_hero_badge', 'type' => 'text', 'default_value' => 'Get in Touch'),
            array('key' => 'field_reach_hero_headline', 'label' => __('Headline', 'mlzs'), 'name' => 'reach_hero_headline', 'type' => 'text', 'default_value' => 'Reach'),
            array('key' => 'field_reach_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'reach_hero_highlight', 'type' => 'text', 'default_value' => 'Us'),
            array('key' => 'field_reach_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'reach_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Connect with us at our campus or city offices. We\'re here to assist you with admissions, queries, and more.'),
            array('key' => 'field_reach_tab_contact', 'label' => __('Contact & Location', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_reach_bg_image', 'label' => __('Section Background Image', 'mlzs'), 'name' => 'reach_bg_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_reach_campus_title', 'label' => __('Main Campus Title', 'mlzs'), 'name' => 'reach_campus_title', 'type' => 'text', 'default_value' => 'Main Campus'),
            array('key' => 'field_reach_campus_address', 'label' => __('Campus Address', 'mlzs'), 'name' => 'reach_campus_address', 'type' => 'textarea', 'rows' => 4),
            array('key' => 'field_reach_campus_phone', 'label' => __('Campus Phone', 'mlzs'), 'name' => 'reach_campus_phone', 'type' => 'text'),
            array('key' => 'field_reach_campus_emails', 'label' => __('Campus Emails (one per line)', 'mlzs'), 'name' => 'reach_campus_emails', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_reach_city_offices', 'label' => __('City Offices (2)', 'mlzs'), 'name' => 'reach_city_offices', 'type' => 'repeater', 'layout' => 'block', 'min' => 2, 'max' => 2, 'button_label' => __('Add Office', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_reach_office_title', 'label' => __('Office Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_reach_office_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'building'),
                array('key' => 'field_reach_office_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'accent'),
                array('key' => 'field_reach_office_address', 'label' => __('Address', 'mlzs'), 'name' => 'address', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_reach_office_phone', 'label' => __('Phone', 'mlzs'), 'name' => 'phone', 'type' => 'text'),
                array('key' => 'field_reach_office_emails', 'label' => __('Emails (one per line)', 'mlzs'), 'name' => 'emails', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_reach_quick_cards', 'label' => __('Quick Action Cards (4)', 'mlzs'), 'name' => 'reach_quick_cards', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_reach_qc_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'phone-call'),
                array('key' => 'field_reach_qc_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_reach_qc_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'subtext', 'type' => 'text'),
                array('key' => 'field_reach_qc_link', 'label' => __('Link or Text', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array'),
                array('key' => 'field_reach_qc_style', 'label' => __('Color Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light', 'accent-dark' => 'Accent Dark'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_reach_map_heading', 'label' => __('Map Section Heading', 'mlzs'), 'name' => 'reach_map_heading', 'type' => 'text', 'default_value' => 'View on Map'),
            array('key' => 'field_reach_map_subtext', 'label' => __('Map Subtext', 'mlzs'), 'name' => 'reach_map_subtext', 'type' => 'text', 'default_value' => 'Find our campus location easily. Click for directions.'),
            array('key' => 'field_reach_map', 'label' => __('Campus Location (Map)', 'mlzs'), 'name' => 'reach_map', 'type' => 'google_map', 'instructions' => __('Search and select the campus location. Address will be used for the map bar and copy; embed and Get Directions link are generated automatically.', 'mlzs'), 'center_lat' => '27.6371647', 'center_lng' => '76.6359878', 'zoom' => 15, 'height' => 400),
            array('key' => 'field_reach_transport', 'label' => __('Transportation (3)', 'mlzs'), 'name' => 'reach_transport', 'type' => 'repeater', 'layout' => 'row', 'min' => 3, 'max' => 3, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_reach_trans_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'car'),
                array('key' => 'field_reach_trans_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_reach_trans_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_reach_trans_style', 'label' => __('Color Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
            )),
        ),
        'location' => array(array(array('param' => 'page_template', 'operator' => '==', 'value' => 'reach.php'))),
    ));
}
add_action('acf/init', 'mlzs_acf_reach_field_group');
