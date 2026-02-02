<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Safety & Security Page – Hero, Philosophy, Features, CTA
 */
function mlzs_acf_security_field_group() {
    if (!function_exists('acf_add_local_field_group')) return;
    acf_add_local_field_group(array(
        'key' => 'group_mlzs_security',
        'title' => __('Safety & Security Page Sections', 'mlzs'),
        'fields' => array(
            array('key' => 'field_sec_tab_hero', 'label' => __('Hero', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_sec_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'security_hero_badge', 'type' => 'text', 'default_value' => 'Priority #1'),
            array('key' => 'field_sec_hero_headline', 'label' => __('Headline', 'mlzs'), 'name' => 'security_hero_headline', 'type' => 'text', 'default_value' => 'Safety &'),
            array('key' => 'field_sec_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'security_hero_highlight', 'type' => 'text', 'default_value' => 'Security'),
            array('key' => 'field_sec_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'security_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Ensuring a protected environment where every child feels secure to learn, grow, and thrive'),
            array('key' => 'field_sec_tab_philosophy', 'label' => __('Safety Philosophy', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_sec_philo_heading', 'label' => __('Section Heading', 'mlzs'), 'name' => 'security_philo_heading', 'type' => 'text', 'default_value' => 'Our Safety Philosophy'),
            array('key' => 'field_sec_philo_cards', 'label' => __('Philosophy Cards (2)', 'mlzs'), 'name' => 'security_philo_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 2, 'max' => 2, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_sec_philo_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'heart'),
                array('key' => 'field_sec_philo_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_sec_philo_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 4),
                array('key' => 'field_sec_philo_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_sec_philo_image', 'label' => __('Side Image', 'mlzs'), 'name' => 'security_philo_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_sec_stat_number', 'label' => __('Stat Number (e.g. 100%)', 'mlzs'), 'name' => 'security_stat_number', 'type' => 'text', 'default_value' => '100%'),
            array('key' => 'field_sec_stat_label', 'label' => __('Stat Label', 'mlzs'), 'name' => 'security_stat_label', 'type' => 'text', 'default_value' => 'Safety Commitment'),
            array('key' => 'field_sec_stat_sub', 'label' => __('Stat Subtext', 'mlzs'), 'name' => 'security_stat_sub', 'type' => 'text', 'default_value' => 'Round-the-clock protection'),
            array('key' => 'field_sec_tab_features', 'label' => __('Security Features', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_sec_features_heading', 'label' => __('Features Heading', 'mlzs'), 'name' => 'security_features_heading', 'type' => 'text', 'default_value' => 'Security Features'),
            array('key' => 'field_sec_features_subtext', 'label' => __('Features Subtext', 'mlzs'), 'name' => 'security_features_subtext', 'type' => 'text', 'default_value' => 'Multi-layered security systems and protocols ensuring complete protection'),
            array('key' => 'field_sec_features', 'label' => __('Feature Cards (7)', 'mlzs'), 'name' => 'security_features', 'type' => 'repeater', 'layout' => 'block', 'min' => 7, 'max' => 7, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_sec_feat_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'clock'),
                array('key' => 'field_sec_feat_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_sec_feat_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_sec_feat_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_sec_tab_layers', 'label' => __('Multi-Layered Protection', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_sec_layers_heading', 'label' => __('Section Heading', 'mlzs'), 'name' => 'security_layers_heading', 'type' => 'text', 'default_value' => 'Multi-Layered Protection'),
            array('key' => 'field_sec_layers_items', 'label' => __('Bullet Points (6)', 'mlzs'), 'name' => 'security_layers_items', 'type' => 'repeater', 'layout' => 'row', 'min' => 6, 'max' => 6, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_sec_layer_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_sec_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_sec_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'security_cta_heading', 'type' => 'text', 'default_value' => 'Your Child\'s Safety is Our Priority'),
            array('key' => 'field_sec_cta_para', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'security_cta_para', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_sec_cta_btn1', 'label' => __('Button 1 (e.g. Download Manual)', 'mlzs'), 'name' => 'security_cta_btn1', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_sec_cta_btn2', 'label' => __('Button 2 (e.g. Contact Officer)', 'mlzs'), 'name' => 'security_cta_btn2', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_sec_cta_stats', 'label' => __('CTA Stat Boxes (4)', 'mlzs'), 'name' => 'security_cta_stats', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_sec_stat_num', 'label' => __('Number', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                array('key' => 'field_sec_stat_lab', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
                array('key' => 'field_sec_stat_color', 'label' => __('Color', 'mlzs'), 'name' => 'color', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light', 'accent-dark' => 'Accent Dark'), 'default_value' => 'primary'),
            )),
        ),
        'location' => array(array(array('param' => 'page_template', 'operator' => '==', 'value' => 'security.php'))),
    ));
}
add_action('acf/init', 'mlzs_acf_security_field_group');
