<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Teacher Training Page – Hero, Workshops (2), Key Outcomes, CTA
 */
function mlzs_acf_teacher_training_field_group() {
    if (!function_exists('acf_add_local_field_group')) return;
    acf_add_local_field_group(array(
        'key' => 'group_mlzs_teacher_training',
        'title' => __('Teacher Training Page Sections', 'mlzs'),
        'fields' => array(
            array('key' => 'field_tt_tab_hero', 'label' => __('Hero', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tt_hero_icon', 'label' => __('Hero badge icon', 'mlzs'), 'name' => 'teacher_training_hero_icon', 'type' => 'text', 'default_value' => 'users', 'instructions' => __('Lucide icon name (e.g. users, graduation-cap).', 'mlzs')),
            array('key' => 'field_tt_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'teacher_training_hero_badge', 'type' => 'text', 'default_value' => 'Professional Development'),
            array('key' => 'field_tt_hero_headline', 'label' => __('Headline', 'mlzs'), 'name' => 'teacher_training_hero_headline', 'type' => 'text', 'default_value' => 'Teacher'),
            array('key' => 'field_tt_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'teacher_training_hero_highlight', 'type' => 'text', 'default_value' => 'Training'),
            array('key' => 'field_tt_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'teacher_training_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Empowering educators through continuous professional development and training workshops'),
            array('key' => 'field_tt_tab_workshop1', 'label' => __('Workshop 1', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tt_w1_icon', 'label' => __('Section icon', 'mlzs'), 'name' => 'teacher_training_w1_icon', 'type' => 'text', 'default_value' => 'book-open', 'instructions' => __('Lucide icon name (e.g. book-open, library).', 'mlzs')),
            array('key' => 'field_tt_w1_title', 'label' => __('Title', 'mlzs'), 'name' => 'teacher_training_w1_title', 'type' => 'text'),
            array('key' => 'field_tt_w1_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'teacher_training_w1_subtitle', 'type' => 'text'),
            array('key' => 'field_tt_w1_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'teacher_training_w1_paragraph', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_tt_w1_highlight', 'label' => __('Highlight box text', 'mlzs'), 'name' => 'teacher_training_w1_highlight', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_tt_w1_image', 'label' => __('Image', 'mlzs'), 'name' => 'teacher_training_w1_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_tt_w1_badge', 'label' => __('Badge text', 'mlzs'), 'name' => 'teacher_training_w1_badge', 'type' => 'text', 'default_value' => '4 Teachers Attended'),
            array('key' => 'field_tt_w1_sessions', 'label' => __('Sessions (3)', 'mlzs'), 'name' => 'teacher_training_w1_sessions', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tt_w1_sess_num', 'label' => __('Number', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                array('key' => 'field_tt_w1_sess_style', 'label' => __('Number style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
                array('key' => 'field_tt_w1_sess_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_tt_w1_sess_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_tt_tab_workshop2', 'label' => __('Workshop 2', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tt_w2_icon', 'label' => __('Section icon', 'mlzs'), 'name' => 'teacher_training_w2_icon', 'type' => 'text', 'default_value' => 'bar-chart-3', 'instructions' => __('Lucide icon name (e.g. bar-chart-3, monitor).', 'mlzs')),
            array('key' => 'field_tt_w2_title', 'label' => __('Title', 'mlzs'), 'name' => 'teacher_training_w2_title', 'type' => 'text'),
            array('key' => 'field_tt_w2_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'teacher_training_w2_subtitle', 'type' => 'text'),
            array('key' => 'field_tt_w2_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'teacher_training_w2_paragraph', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_tt_w2_highlight', 'label' => __('Highlight box text', 'mlzs'), 'name' => 'teacher_training_w2_highlight', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_tt_w2_image', 'label' => __('Image', 'mlzs'), 'name' => 'teacher_training_w2_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_tt_w2_badge', 'label' => __('Badge text', 'mlzs'), 'name' => 'teacher_training_w2_badge', 'type' => 'text', 'default_value' => '5 Teachers Attended'),
            array('key' => 'field_tt_w2_focus', 'label' => __('Focus Areas (2)', 'mlzs'), 'name' => 'teacher_training_w2_focus', 'type' => 'repeater', 'layout' => 'block', 'min' => 2, 'max' => 2, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tt_w2_focus_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'edit'),
                array('key' => 'field_tt_w2_focus_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent'), 'default_value' => 'primary'),
                array('key' => 'field_tt_w2_focus_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_tt_w2_focus_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_tt_tab_outcomes', 'label' => __('Key Outcomes', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tt_outcomes_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'teacher_training_outcomes_heading', 'type' => 'text', 'default_value' => 'Key Learning Outcomes'),
            array('key' => 'field_tt_outcomes', 'label' => __('Outcome Cards (4)', 'mlzs'), 'name' => 'teacher_training_outcomes', 'type' => 'repeater', 'layout' => 'block', 'min' => 4, 'max' => 4, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tt_out_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'target'),
                array('key' => 'field_tt_out_icon_style', 'label' => __('Icon colour', 'mlzs'), 'name' => 'icon_style', 'type' => 'select', 'choices' => array('primary' => __('Primary', 'mlzs'), 'primary-light' => __('Primary Light', 'mlzs'), 'accent' => __('Accent', 'mlzs'), 'accent-light' => __('Accent Light', 'mlzs')), 'default_value' => 'primary'),
                array('key' => 'field_tt_out_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_tt_out_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'text'),
            )),
            array('key' => 'field_tt_tab_cta', 'label' => __('CTA', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tt_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'teacher_training_cta_heading', 'type' => 'text', 'default_value' => 'Continuous Professional Development'),
            array('key' => 'field_tt_cta_paragraph', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'teacher_training_cta_paragraph', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_tt_cta_btn1_icon', 'label' => __('Button 1 icon', 'mlzs'), 'name' => 'teacher_training_cta_btn1_icon', 'type' => 'text', 'default_value' => 'calendar', 'instructions' => __('Lucide icon name.', 'mlzs')),
            array('key' => 'field_tt_cta_btn1', 'label' => __('Button 1', 'mlzs'), 'name' => 'teacher_training_cta_btn1', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_tt_cta_btn2_icon', 'label' => __('Button 2 icon', 'mlzs'), 'name' => 'teacher_training_cta_btn2_icon', 'type' => 'text', 'default_value' => 'book-open', 'instructions' => __('Lucide icon name.', 'mlzs')),
            array('key' => 'field_tt_cta_btn2', 'label' => __('Button 2', 'mlzs'), 'name' => 'teacher_training_cta_btn2', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_tt_cta_stats', 'label' => __('Stats (4)', 'mlzs'), 'name' => 'teacher_training_cta_stats', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tt_stat_number', 'label' => __('Number', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                array('key' => 'field_tt_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
        ),
        'location' => array(array(array('param' => 'page_template', 'operator' => '==', 'value' => 'teacher_training.php'))),
    ));
}
add_action('acf/init', 'mlzs_acf_teacher_training_field_group');
