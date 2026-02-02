<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Trust Page – Hero (Board of Trustees), Guiding Philosophy (3 visions), Objectives (6), Founding Trustees (3), CTA
 * Icon color dropdown for vision & objective cards.
 */
function mlzs_acf_trust_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_trust',
        'title'                 => __('Trust Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_tr_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tr_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'trust_hero_badge', 'type' => 'text', 'default_value' => 'Since 2009'),
            array('key' => 'field_tr_hero_title', 'label' => __('Main Title', 'mlzs'), 'name' => 'trust_hero_title', 'type' => 'text', 'default_value' => 'Makkar Education Trust'),
            array('key' => 'field_tr_hero_quote', 'label' => __('Quote (3 lines)', 'mlzs'), 'name' => 'trust_hero_quote', 'type' => 'textarea', 'rows' => 4, 'default_value' => "Where the vision is one year, cultivate flowers.\nWhere the vision is ten years, cultivate trees.\nWhere the vision is eternity, cultivate people.", 'new_lines' => 'br'),
            array('key' => 'field_tr_hero_intro', 'label' => __('Intro Paragraph', 'mlzs'), 'name' => 'trust_hero_intro', 'type' => 'textarea', 'rows' => 4, 'default_value' => 'Established on 3rd June 2009 with great vision, strong determination and powerful objectives, Makkar Education Trust is dedicated to nurturing future generations through quality education and holistic development.'),
            array('key' => 'field_tr_board_title', 'label' => __('Board Card Title', 'mlzs'), 'name' => 'trust_board_title', 'type' => 'text', 'default_value' => 'Board of Trustees'),
            array('key' => 'field_tr_board_trustees', 'label' => __('Board Trustees', 'mlzs'), 'name' => 'trust_board_trustees', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'button_label' => __('Add Trustee', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tr_board_name', 'label' => __('Name', 'mlzs'), 'name' => 'name', 'type' => 'text'),
                array('key' => 'field_tr_board_desig', 'label' => __('Designation', 'mlzs'), 'name' => 'designation', 'type' => 'text'),
                array('key' => 'field_tr_board_initials', 'label' => __('Initials (optional)', 'mlzs'), 'name' => 'initials', 'type' => 'text', 'instructions' => __('Leave empty to auto-generate from name', 'mlzs')),
                array('key' => 'field_tr_board_gradient', 'label' => __('Avatar Gradient', 'mlzs'), 'name' => 'gradient', 'type' => 'select', 'choices' => array('primary-light-secondary' => 'Primary Light to Secondary', 'primary-accent' => 'Primary to Accent', 'secondary-accent-dark' => 'Secondary to Accent Dark'), 'default_value' => 'primary-accent'),
            )),
            array('key' => 'field_tr_tab_philosophy', 'label' => __('Guiding Philosophy', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tr_philosophy_heading', 'label' => __('Section Heading', 'mlzs'), 'name' => 'trust_philosophy_heading', 'type' => 'text', 'default_value' => 'Our Guiding Philosophy'),
            array('key' => 'field_tr_philosophy_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'trust_philosophy_subtext', 'type' => 'text', 'default_value' => 'Rooted in timeless wisdom, our approach to education transforms lives and shapes futures'),
            array('key' => 'field_tr_vision_cards', 'label' => __('Vision Cards (3)', 'mlzs'), 'name' => 'trust_vision_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'max' => 3, 'button_label' => __('Add Vision', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tr_vision_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'flower', 'instructions' => __('e.g. flower, tree-pine, users', 'mlzs')),
                array('key' => 'field_tr_vision_style', 'label' => __('Icon Color', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'secondary' => 'Secondary', 'accent' => 'Accent'), 'default_value' => 'primary'),
                array('key' => 'field_tr_vision_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_tr_vision_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 3),
                array('key' => 'field_tr_vision_tag', 'label' => __('Tag / Label', 'mlzs'), 'name' => 'tag', 'type' => 'text', 'default_value' => 'Immediate Impact'),
            )),
            array('key' => 'field_tr_tab_objectives', 'label' => __('Objectives', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tr_obj_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'trust_obj_badge', 'type' => 'text', 'default_value' => 'Our Objectives'),
            array('key' => 'field_tr_obj_heading', 'label' => __('Section Heading', 'mlzs'), 'name' => 'trust_obj_heading', 'type' => 'text', 'default_value' => 'Purpose & Commitment'),
            array('key' => 'field_tr_obj_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'trust_obj_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Guided by a strong vision and determination, Makkar Education Trust is committed to transforming education and nurturing future leaders'),
            array('key' => 'field_tr_objectives', 'label' => __('Objectives (6)', 'mlzs'), 'name' => 'trust_objectives', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'button_label' => __('Add Objective', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tr_obj_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'target', 'instructions' => __('e.g. target, heart, shield, globe', 'mlzs')),
                array('key' => 'field_tr_obj_style', 'label' => __('Icon Color', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'secondary' => 'Secondary', 'accent' => 'Accent'), 'default_value' => 'primary'),
                array('key' => 'field_tr_obj_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_tr_obj_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 3),
            )),
            array('key' => 'field_tr_tab_trustees', 'label' => __('Founding Trustees', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tr_trustees_heading', 'label' => __('Section Heading', 'mlzs'), 'name' => 'trust_trustees_heading', 'type' => 'text', 'default_value' => 'Our Founding Trustees'),
            array('key' => 'field_tr_trustees_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'trust_trustees_subtext', 'type' => 'text', 'default_value' => 'Visionary leaders dedicated to transforming education and shaping futures'),
            array('key' => 'field_tr_trustees_list', 'label' => __('Trustees (3)', 'mlzs'), 'name' => 'trust_trustees_list', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'button_label' => __('Add Trustee', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tr_tr_name', 'label' => __('Name', 'mlzs'), 'name' => 'name', 'type' => 'text'),
                array('key' => 'field_tr_tr_desig', 'label' => __('Designation', 'mlzs'), 'name' => 'designation', 'type' => 'text'),
                array('key' => 'field_tr_tr_bio', 'label' => __('Bio / Description', 'mlzs'), 'name' => 'bio', 'type' => 'textarea', 'rows' => 3),
                array('key' => 'field_tr_tr_initials', 'label' => __('Initials (optional)', 'mlzs'), 'name' => 'initials', 'type' => 'text', 'instructions' => __('Leave empty to auto-generate from name', 'mlzs')),
                array('key' => 'field_tr_tr_gradient', 'label' => __('Avatar Gradient', 'mlzs'), 'name' => 'gradient', 'type' => 'select', 'choices' => array('primary-primary-light' => 'Primary to Primary Light', 'primary-dark-primary' => 'Primary Dark to Primary', 'primary-light-secondary' => 'Primary Light to Secondary'), 'default_value' => 'primary-primary-light'),
            )),
            array('key' => 'field_tr_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tr_cta_badge', 'label' => __('CTA Badge', 'mlzs'), 'name' => 'trust_cta_badge', 'type' => 'text', 'default_value' => 'Join Our Mission'),
            array('key' => 'field_tr_cta_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'trust_cta_icon', 'type' => 'text', 'default_value' => 'heart-handshake'),
            array('key' => 'field_tr_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'trust_cta_heading', 'type' => 'text', 'default_value' => 'Be Part of Our Educational Journey'),
            array('key' => 'field_tr_cta_paragraph', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'trust_cta_paragraph', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Together, let's cultivate people who will shape a better tomorrow. Join Makkar Education Trust in our mission to create eternal impact through education."),
            array('key' => 'field_tr_cta_btn1', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'trust_cta_btn1', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_tr_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'trust_cta_btn1_icon', 'type' => 'text', 'default_value' => 'handshake'),
            array('key' => 'field_tr_cta_btn2', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'trust_cta_btn2', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_tr_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'trust_cta_btn2_icon', 'type' => 'text', 'default_value' => 'book-open'),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'trust.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_trust_field_group');
