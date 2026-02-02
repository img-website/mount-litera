<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Spiritual Programme Page – Hero, Intro, Daily Practices, Programme List, Benefits, CTA
 */
function mlzs_acf_spritual_field_group() {
    if (!function_exists('acf_add_local_field_group')) return;
    acf_add_local_field_group(array(
        'key' => 'group_mlzs_spritual',
        'title' => __('Spiritual Programme Page Sections', 'mlzs'),
        'fields' => array(
            array('key' => 'field_spritual_tab_hero', 'label' => __('Hero', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_spritual_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'spritual_hero_badge', 'type' => 'text', 'default_value' => 'Inner Growth'),
            array('key' => 'field_spritual_hero_headline', 'label' => __('Headline', 'mlzs'), 'name' => 'spritual_hero_headline', 'type' => 'text', 'default_value' => 'Spiritual'),
            array('key' => 'field_spritual_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'spritual_hero_highlight', 'type' => 'text', 'default_value' => 'Programme'),
            array('key' => 'field_spritual_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'spritual_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Nurturing inner peace, moral values, and universal harmony through diverse spiritual practices'),
            array('key' => 'field_spritual_tab_intro', 'label' => __('Introduction', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_spritual_intro_heading', 'label' => __('Intro Heading', 'mlzs'), 'name' => 'spritual_intro_heading', 'type' => 'text', 'default_value' => 'Interfaith Harmony & Spiritual Development'),
            array('key' => 'field_spritual_intro_paragraph', 'label' => __('Intro Paragraph', 'mlzs'), 'name' => 'spritual_intro_paragraph', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_spritual_faiths', 'label' => __('Four Faiths (4)', 'mlzs'), 'name' => 'spritual_faiths', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_spritual_faith_icon', 'label' => __('Icon (Lucide)', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'sun'),
                array('key' => 'field_spritual_faith_icon_style', 'label' => __('Icon box colour', 'mlzs'), 'name' => 'icon_style', 'type' => 'select', 'choices' => array('red' => __('Red', 'mlzs'), 'green' => __('Green', 'mlzs'), 'accent' => __('Accent (Amber)', 'mlzs'), 'blue' => __('Blue', 'mlzs')), 'default_value' => 'red'),
                array('key' => 'field_spritual_faith_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_spritual_faith_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'subtitle', 'type' => 'text'),
            )),
            array('key' => 'field_spritual_tab_practices', 'label' => __('Daily Practices', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_spritual_practices_heading', 'label' => __('Section Heading', 'mlzs'), 'name' => 'spritual_practices_heading', 'type' => 'text', 'default_value' => 'Daily Spiritual Practices'),
            array('key' => 'field_spritual_practices_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'spritual_practices_subtext', 'type' => 'text', 'default_value' => 'Regular activities that nurture spiritual growth and moral development'),
            array('key' => 'field_spritual_practice_cards', 'label' => __('Practice Cards (2)', 'mlzs'), 'name' => 'spritual_practice_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 2, 'max' => 2, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_spritual_pc_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'sunrise'),
                array('key' => 'field_spritual_pc_icon_style', 'label' => __('Icon box colour', 'mlzs'), 'name' => 'icon_style', 'type' => 'select', 'choices' => array('primary' => __('Primary', 'mlzs'), 'accent' => __('Accent', 'mlzs')), 'default_value' => 'primary'),
                array('key' => 'field_spritual_pc_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_spritual_pc_items', 'label' => __('Items', 'mlzs'), 'name' => 'items', 'type' => 'repeater', 'layout' => 'row', 'sub_fields' => array(
                    array('key' => 'field_spritual_pci_icon_style', 'label' => __('Item icon colour', 'mlzs'), 'name' => 'icon_style', 'type' => 'select', 'choices' => array('green' => __('Green', 'mlzs'), 'blue' => __('Blue', 'mlzs'), 'purple' => __('Purple', 'mlzs'), 'indigo' => __('Indigo', 'mlzs')), 'default_value' => 'green'),
                    array('key' => 'field_spritual_pci_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'mic'),
                    array('key' => 'field_spritual_pci_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                    array('key' => 'field_spritual_pci_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'textarea', 'rows' => 2),
                )),
            )),
            array('key' => 'field_spritual_tab_programme', 'label' => __('Programme List', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_spritual_programme_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'spritual_programme_heading', 'type' => 'text', 'default_value' => 'Complete Spiritual Programme'),
            array('key' => 'field_spritual_programme_items', 'label' => __('Programme Items', 'mlzs'), 'name' => 'spritual_programme_items', 'type' => 'repeater', 'layout' => 'row', 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_spritual_pi_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'book-open'),
                array('key' => 'field_spritual_pi_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
                array('key' => 'field_spritual_pi_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_spritual_pi_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'text'),
            )),
            array('key' => 'field_spritual_tab_benefits', 'label' => __('Benefits', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_spritual_benefits', 'label' => __('Benefit Cards (3)', 'mlzs'), 'name' => 'spritual_benefits', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_spritual_ben_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'brain'),
                array('key' => 'field_spritual_ben_icon_style', 'label' => __('Icon colour', 'mlzs'), 'name' => 'icon_style', 'type' => 'select', 'choices' => array('primary' => __('Primary', 'mlzs'), 'accent' => __('Accent', 'mlzs'), 'primary-light' => __('Primary Light', 'mlzs')), 'default_value' => 'primary'),
                array('key' => 'field_spritual_ben_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_spritual_ben_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 3),
            )),
            array('key' => 'field_spritual_tab_cta', 'label' => __('CTA', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_spritual_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'spritual_cta_heading', 'type' => 'text', 'default_value' => 'Join Our Spiritual Journey'),
            array('key' => 'field_spritual_cta_paragraph', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'spritual_cta_paragraph', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_spritual_cta_btn1', 'label' => __('Button 1', 'mlzs'), 'name' => 'spritual_cta_btn1', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_spritual_cta_btn2', 'label' => __('Button 2', 'mlzs'), 'name' => 'spritual_cta_btn2', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_spritual_cta_stats', 'label' => __('Stats (4)', 'mlzs'), 'name' => 'spritual_cta_stats', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_spritual_stat_number', 'label' => __('Number', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                array('key' => 'field_spritual_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
        ),
        'location' => array(array(array('param' => 'page_template', 'operator' => '==', 'value' => 'spritual.php'))),
    ));
}
add_action('acf/init', 'mlzs_acf_spritual_field_group');
