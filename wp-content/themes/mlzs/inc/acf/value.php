<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Core Values Page – Hero, WRFC Mantra, Core Values Table, Values in Action, CTA
 */
function mlzs_acf_value_field_group() {
    if (!function_exists('acf_add_local_field_group')) return;
    acf_add_local_field_group(array(
        'key' => 'group_mlzs_value',
        'title' => __('Core Values Page Sections', 'mlzs'),
        'fields' => array(
            array('key' => 'field_val_tab_hero', 'label' => __('Hero', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_val_hero_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'value_hero_badge', 'type' => 'text', 'default_value' => 'Foundation of Leadership'),
            array('key' => 'field_val_hero_before', 'label' => __('Headline Before', 'mlzs'), 'name' => 'value_hero_headline_before', 'type' => 'text', 'default_value' => 'Our'),
            array('key' => 'field_val_hero_highlight', 'label' => __('Headline Highlighted', 'mlzs'), 'name' => 'value_hero_headline_highlight', 'type' => 'text', 'default_value' => 'Core Values'),
            array('key' => 'field_val_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'value_hero_subtext', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_val_hero_bg', 'label' => __('Background Image', 'mlzs'), 'name' => 'value_hero_bg_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_val_tab_wrfc', 'label' => __('WRFC Mantra', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_val_wrfc_main_img', 'label' => __('Main Image', 'mlzs'), 'name' => 'value_wrfc_main_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_val_wrfc_overlay_img', 'label' => __('Overlay/Small Image', 'mlzs'), 'name' => 'value_wrfc_overlay_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_val_wrfc_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'value_wrfc_icon', 'type' => 'text', 'default_value' => 'heart'),
            array('key' => 'field_val_wrfc_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'value_wrfc_badge', 'type' => 'text', 'default_value' => 'Our Mantra'),
            array('key' => 'field_val_wrfc_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'value_wrfc_heading', 'type' => 'text'),
            array('key' => 'field_val_wrfc_para1', 'label' => __('Paragraph 1', 'mlzs'), 'name' => 'value_wrfc_para1', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_val_wrfc_para2', 'label' => __('Paragraph 2', 'mlzs'), 'name' => 'value_wrfc_para2', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_val_wrfc_philo_heading', 'label' => __('Philosophy Box Heading', 'mlzs'), 'name' => 'value_wrfc_philo_heading', 'type' => 'text', 'default_value' => 'The WRFC Philosophy'),
            array('key' => 'field_val_wrfc_philo_icon', 'label' => __('Philosophy Icon', 'mlzs'), 'name' => 'value_wrfc_philo_icon', 'type' => 'text', 'default_value' => 'star'),
            array('key' => 'field_val_wrfc_philo_points', 'label' => __('Philosophy Points', 'mlzs'), 'name' => 'value_wrfc_philo_points', 'type' => 'repeater', 'layout' => 'table', 'min' => 0, 'button_label' => __('Add Point', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_val_philo_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_val_tab_table', 'label' => __('Core Values Table', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_val_table_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'value_table_badge', 'type' => 'text', 'default_value' => 'Foundation of Leadership'),
            array('key' => 'field_val_table_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'value_table_icon', 'type' => 'text', 'default_value' => 'shield'),
            array('key' => 'field_val_table_heading', 'label' => __('Heading (full - fallback)', 'mlzs'), 'name' => 'value_table_heading', 'type' => 'text'),
            array('key' => 'field_val_table_heading_before', 'label' => __('Heading Before Highlight', 'mlzs'), 'name' => 'value_table_heading_before', 'type' => 'text', 'default_value' => 'Core Values That'),
            array('key' => 'field_val_table_heading_highlight', 'label' => __('Heading Highlighted', 'mlzs'), 'name' => 'value_table_heading_highlight', 'type' => 'text', 'default_value' => 'Shape Leaders'),
            array('key' => 'field_val_table_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'value_table_subtext', 'type' => 'text'),
            array('key' => 'field_val_table_col1_title', 'label' => __('Column 1 Title', 'mlzs'), 'name' => 'value_table_col1_title', 'type' => 'text', 'default_value' => 'Core Value'),
            array('key' => 'field_val_table_col1_sub', 'label' => __('Column 1 Subtitle', 'mlzs'), 'name' => 'value_table_col1_sub', 'type' => 'text', 'default_value' => 'The principle we uphold'),
            array('key' => 'field_val_table_col2_title', 'label' => __('Column 2 Title', 'mlzs'), 'name' => 'value_table_col2_title', 'type' => 'text', 'default_value' => 'Definition'),
            array('key' => 'field_val_table_col2_sub', 'label' => __('Column 2 Subtitle', 'mlzs'), 'name' => 'value_table_col2_sub', 'type' => 'text', 'default_value' => 'How we live this value'),
            array('key' => 'field_val_table_rows', 'label' => __('Values Rows', 'mlzs'), 'name' => 'value_table_rows', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'button_label' => __('Add Value', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_val_row_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'shield-check'),
                array('key' => 'field_val_row_style', 'label' => __('Color Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'accent' => 'Accent', 'accent-dark' => 'Accent Dark'), 'default_value' => 'primary'),
                array('key' => 'field_val_row_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_val_row_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'subtitle', 'type' => 'text'),
                array('key' => 'field_val_row_definition', 'label' => __('Definition', 'mlzs'), 'name' => 'definition', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_val_tab_action', 'label' => __('Values in Action', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_val_action_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'value_action_badge', 'type' => 'text', 'default_value' => 'Values in Action'),
            array('key' => 'field_val_action_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'value_action_icon', 'type' => 'text', 'default_value' => 'zap'),
            array('key' => 'field_val_action_heading_before', 'label' => __('Heading Before', 'mlzs'), 'name' => 'value_action_heading_before', 'type' => 'text', 'default_value' => 'Living Our'),
            array('key' => 'field_val_action_heading_highlight', 'label' => __('Heading Highlighted', 'mlzs'), 'name' => 'value_action_heading_highlight', 'type' => 'text', 'default_value' => 'Values'),
            array('key' => 'field_val_action_heading_after', 'label' => __('Heading After', 'mlzs'), 'name' => 'value_action_heading_after', 'type' => 'text', 'default_value' => 'Daily'),
            array('key' => 'field_val_action_heading', 'label' => __('Heading (full fallback)', 'mlzs'), 'name' => 'value_action_heading', 'type' => 'text'),
            array('key' => 'field_val_action_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'value_action_subtext', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_val_action_cards', 'label' => __('Action Cards (3)', 'mlzs'), 'name' => 'value_action_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_val_card_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'users'),
                array('key' => 'field_val_card_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
                array('key' => 'field_val_card_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_val_card_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_val_tab_cta', 'label' => __('CTA', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_val_cta_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'value_cta_heading', 'type' => 'text', 'default_value' => 'Experience Our Values'),
            array('key' => 'field_val_cta_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'value_cta_paragraph', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_val_cta_btn1', 'label' => __('Button 1 (Schedule Visit)', 'mlzs'), 'name' => 'value_cta_btn1', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_val_cta_btn2', 'label' => __('Button 2 (Download Prospectus)', 'mlzs'), 'name' => 'value_cta_btn2', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_val_cta_stats', 'label' => __('Stat Boxes (4)', 'mlzs'), 'name' => 'value_cta_stats', 'type' => 'repeater', 'layout' => 'row', 'min' => 0, 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_val_stat_number', 'label' => __('Number/Text', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                array('key' => 'field_val_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
                array('key' => 'field_val_stat_style', 'label' => __('Color', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light', 'accent-dark' => 'Accent Dark'), 'default_value' => 'primary'),
            )),
        ),
        'location' => array(array(array('param' => 'page_template', 'operator' => '==', 'value' => 'value.php'))),
    ));
}
add_action('acf/init', 'mlzs_acf_value_field_group');
