<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Transport Page – Hero, Introduction, Bus Policy (rules with nested points), Bus Rules (with nested points), Fleet, CTA
 * Icon color dropdown where needed. Points ke andar nested points.
 */
function mlzs_acf_transport_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_transport',
        'title'                 => __('Transport Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_trans_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_trans_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'transport_hero_badge', 'type' => 'text', 'default_value' => 'Safe Transportation'),
            array('key' => 'field_trans_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'transport_hero_icon', 'type' => 'text', 'default_value' => 'bus'),
            array('key' => 'field_trans_hero_headline_before', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'transport_hero_headline_before', 'type' => 'text', 'default_value' => 'School'),
            array('key' => 'field_trans_hero_headline_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'transport_hero_headline_highlight', 'type' => 'text', 'default_value' => 'Transport'),
            array('key' => 'field_trans_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'transport_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Safe, reliable, and efficient transportation services for our students'),
            array('key' => 'field_trans_tab_intro', 'label' => __('Introduction Notice', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_trans_intro_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'transport_intro_icon', 'type' => 'text', 'default_value' => 'alert-circle'),
            array('key' => 'field_trans_intro_icon_style', 'label' => __('Icon Color', 'mlzs'), 'name' => 'transport_intro_icon_style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'accent' => 'Accent', 'green' => 'Green'), 'default_value' => 'primary'),
            array('key' => 'field_trans_intro_title', 'label' => __('Title', 'mlzs'), 'name' => 'transport_intro_title', 'type' => 'text', 'default_value' => 'Important Notice for Parents'),
            array('key' => 'field_trans_intro_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'transport_intro_paragraph', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Parents are requested to kindly go through the following rules and guidelines regarding school bus transportation.'),
            array('key' => 'field_trans_tab_policy', 'label' => __('Bus Policy & Guidelines', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_trans_policy_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'transport_policy_icon', 'type' => 'text', 'default_value' => 'clipboard-check'),
            array('key' => 'field_trans_policy_icon_style', 'label' => __('Icon Color', 'mlzs'), 'name' => 'transport_policy_icon_style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'accent' => 'Accent', 'green' => 'Green'), 'default_value' => 'primary'),
            array('key' => 'field_trans_policy_title', 'label' => __('Section Title', 'mlzs'), 'name' => 'transport_policy_title', 'type' => 'text', 'default_value' => 'Bus Policy & Guidelines'),
            array('key' => 'field_trans_policy_rules', 'label' => __('Policy Rules', 'mlzs'), 'name' => 'transport_policy_rules', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'button_label' => __('Add Rule', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_trans_rule_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'shield', 'instructions' => __('e.g. shield, clock, phone, map-pin', 'mlzs')),
                array('key' => 'field_trans_rule_style', 'label' => __('Icon Color', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'accent' => 'Accent', 'green' => 'Green'), 'default_value' => 'primary'),
                array('key' => 'field_trans_rule_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_trans_rule_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_trans_rule_sub_points', 'label' => __('Nested Points', 'mlzs'), 'name' => 'sub_points', 'type' => 'repeater', 'layout' => 'row', 'min' => 0, 'button_label' => __('Add Point', 'mlzs'), 'sub_fields' => array(
                    array('key' => 'field_trans_sub_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
                )),
            )),
            array('key' => 'field_trans_tab_rules', 'label' => __('Bus Rules & Regulations', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_trans_rules_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'transport_rules_icon', 'type' => 'text', 'default_value' => 'list-checks'),
            array('key' => 'field_trans_rules_icon_style', 'label' => __('Icon Color', 'mlzs'), 'name' => 'transport_rules_icon_style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'accent' => 'Accent', 'green' => 'Green'), 'default_value' => 'accent'),
            array('key' => 'field_trans_rules_title', 'label' => __('Section Title', 'mlzs'), 'name' => 'transport_rules_title', 'type' => 'text', 'default_value' => 'Bus Rules & Regulations'),
            array('key' => 'field_trans_rules_list', 'label' => __('Rules List', 'mlzs'), 'name' => 'transport_rules_list', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'button_label' => __('Add Rule', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_trans_rules_item_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_trans_rules_item_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_trans_rules_item_sub', 'label' => __('Nested Points', 'mlzs'), 'name' => 'sub_points', 'type' => 'repeater', 'layout' => 'row', 'min' => 0, 'button_label' => __('Add Point', 'mlzs'), 'sub_fields' => array(
                    array('key' => 'field_trans_rules_sub_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
                )),
            )),
            array('key' => 'field_trans_tab_fleet', 'label' => __('Transport Fleet', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_trans_fleet_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'transport_fleet_icon', 'type' => 'text', 'default_value' => 'image'),
            array('key' => 'field_trans_fleet_icon_style', 'label' => __('Icon Color', 'mlzs'), 'name' => 'transport_fleet_icon_style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'accent' => 'Accent', 'green' => 'Green'), 'default_value' => 'primary'),
            array('key' => 'field_trans_fleet_title', 'label' => __('Section Title', 'mlzs'), 'name' => 'transport_fleet_title', 'type' => 'text', 'default_value' => 'Our Transport Fleet'),
            array('key' => 'field_trans_fleet_image', 'label' => __('Fleet Image', 'mlzs'), 'name' => 'transport_fleet_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_trans_fleet_caption', 'label' => __('Image Caption', 'mlzs'), 'name' => 'transport_fleet_caption', 'type' => 'text', 'default_value' => 'Modern, Safe & Comfortable Buses'),
            array('key' => 'field_trans_fleet_features', 'label' => __('Fleet Features (4)', 'mlzs'), 'name' => 'transport_fleet_features', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'max' => 6, 'button_label' => __('Add Feature', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_trans_fleet_feat_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'shield'),
                array('key' => 'field_trans_fleet_feat_style', 'label' => __('Icon Color', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'accent' => 'Accent', 'green' => 'Green'), 'default_value' => 'primary'),
                array('key' => 'field_trans_fleet_feat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
            array('key' => 'field_trans_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_trans_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'transport_cta_heading', 'type' => 'text', 'default_value' => 'Need More Information?'),
            array('key' => 'field_trans_cta_paragraph', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'transport_cta_paragraph', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'For detailed bus routes, timings, and registration information, please contact our transport department.'),
            array('key' => 'field_trans_cta_btn1', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'transport_cta_btn1', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_trans_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'transport_cta_btn1_icon', 'type' => 'text', 'default_value' => 'phone'),
            array('key' => 'field_trans_cta_btn2', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'transport_cta_btn2', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_trans_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'transport_cta_btn2_icon', 'type' => 'text', 'default_value' => 'download'),
            array('key' => 'field_trans_cta_stats', 'label' => __('CTA Stats (4)', 'mlzs'), 'name' => 'transport_cta_stats', 'type' => 'repeater', 'layout' => 'row', 'min' => 0, 'max' => 6, 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_trans_stat_value', 'label' => __('Value', 'mlzs'), 'name' => 'value', 'type' => 'text'),
                array('key' => 'field_trans_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'transport.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_transport_field_group');
