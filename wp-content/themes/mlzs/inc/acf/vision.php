<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Vision & Mission Page – Hero, Vision section, Mission section
 */
function mlzs_acf_vision_field_group() {
    if (!function_exists('acf_add_local_field_group')) return;
    acf_add_local_field_group(array(
        'key' => 'group_mlzs_vision',
        'title' => __('Vision & Mission Page Sections', 'mlzs'),
        'fields' => array(
            array('key' => 'field_vis_tab_hero', 'label' => __('Hero', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_vis_hero_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'vision_hero_badge', 'type' => 'text', 'default_value' => 'Our Guiding Principles'),
            array('key' => 'field_vis_hero_before', 'label' => __('Headline Before', 'mlzs'), 'name' => 'vision_hero_headline_before', 'type' => 'text', 'default_value' => 'Vision'),
            array('key' => 'field_vis_hero_highlight', 'label' => __('Headline Highlighted', 'mlzs'), 'name' => 'vision_hero_headline_highlight', 'type' => 'text', 'default_value' => '&'),
            array('key' => 'field_vis_hero_after', 'label' => __('Headline After', 'mlzs'), 'name' => 'vision_hero_headline_after', 'type' => 'text', 'default_value' => 'Mission'),
            array('key' => 'field_vis_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'vision_hero_subtext', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_vis_hero_bg', 'label' => __('Background Image', 'mlzs'), 'name' => 'vision_hero_bg_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_vis_tab_vision', 'label' => __('Vision Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_vis_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'vision_section_icon', 'type' => 'text', 'default_value' => 'eye'),
            array('key' => 'field_vis_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'vision_section_badge', 'type' => 'text', 'default_value' => 'Our Vision'),
            array('key' => 'field_vis_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'vision_section_heading', 'type' => 'text'),
            array('key' => 'field_vis_para1', 'label' => __('Paragraph 1', 'mlzs'), 'name' => 'vision_section_para1', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_vis_para2', 'label' => __('Paragraph 2', 'mlzs'), 'name' => 'vision_section_para2', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_vis_list_label', 'label' => __('List Label', 'mlzs'), 'name' => 'vision_section_list_label', 'type' => 'text', 'default_value' => 'The vision of Mount Litera Zee School envisages:'),
            array('key' => 'field_vis_list_items', 'label' => __('List Items', 'mlzs'), 'name' => 'vision_section_list_items', 'type' => 'repeater', 'layout' => 'table', 'min' => 0, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_vis_list_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_vis_highlight1', 'label' => __('Highlight Box 1', 'mlzs'), 'name' => 'vision_highlight1', 'type' => 'group', 'sub_fields' => array(
                array('key' => 'field_vis_h1_number', 'label' => __('Number/Title', 'mlzs'), 'name' => 'number', 'type' => 'text', 'default_value' => 'Complete'),
                array('key' => 'field_vis_h1_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Educational Experience'),
            )),
            array('key' => 'field_vis_highlight2', 'label' => __('Highlight Box 2', 'mlzs'), 'name' => 'vision_highlight2', 'type' => 'group', 'sub_fields' => array(
                array('key' => 'field_vis_h2_number', 'label' => __('Number/Title', 'mlzs'), 'name' => 'number', 'type' => 'text', 'default_value' => 'Unique'),
                array('key' => 'field_vis_h2_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Learning Approach'),
            )),
            array('key' => 'field_vis_main_img', 'label' => __('Main Image', 'mlzs'), 'name' => 'vision_main_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_vis_overlay_img', 'label' => __('Overlay Image', 'mlzs'), 'name' => 'vision_overlay_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_vis_tab_mission', 'label' => __('Mission Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_vis_mission_main_img', 'label' => __('Main Image', 'mlzs'), 'name' => 'vision_mission_main_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_vis_mission_overlay_img', 'label' => __('Overlay Image', 'mlzs'), 'name' => 'vision_mission_overlay_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_vis_mission_img_title', 'label' => __('Image Overlay Title', 'mlzs'), 'name' => 'vision_mission_image_title', 'type' => 'text', 'default_value' => 'Shaping Global Minds'),
            array('key' => 'field_vis_mission_img_subtitle', 'label' => __('Image Overlay Subtitle', 'mlzs'), 'name' => 'vision_mission_image_subtitle', 'type' => 'text', 'default_value' => 'On Indian soil with world-class standards'),
            array('key' => 'field_vis_mission_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'vision_mission_icon', 'type' => 'text', 'default_value' => 'target'),
            array('key' => 'field_vis_mission_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'vision_mission_badge', 'type' => 'text', 'default_value' => 'Our Mission'),
            array('key' => 'field_vis_mission_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'vision_mission_heading', 'type' => 'text'),
            array('key' => 'field_vis_mission_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'vision_mission_paragraph', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_vis_mission_pillars_heading', 'label' => __('Pillars Heading', 'mlzs'), 'name' => 'vision_mission_pillars_heading', 'type' => 'text', 'default_value' => 'Our Mission Pillars'),
            array('key' => 'field_vis_mission_pillars', 'label' => __('Mission Pillars', 'mlzs'), 'name' => 'vision_mission_pillars', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'button_label' => __('Add Pillar', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_vis_pillar_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'globe'),
                array('key' => 'field_vis_pillar_style', 'label' => __('Color', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent'), 'default_value' => 'primary'),
                array('key' => 'field_vis_pillar_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_vis_pillar_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
        ),
        'location' => array(array(array('param' => 'page_template', 'operator' => '==', 'value' => 'vision.php'))),
    ));
}
add_action('acf/init', 'mlzs_acf_vision_field_group');
