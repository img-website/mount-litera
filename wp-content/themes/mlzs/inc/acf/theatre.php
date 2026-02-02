<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Open Air Theatre Page – Hero, Overview (content + image + stats), Features (3), Gallery (3)
 */
function mlzs_acf_theatre_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_theatre',
        'title'                 => __('Open Air Theatre Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_thr_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_thr_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'theatre_hero_badge', 'type' => 'text', 'default_value' => 'Performing Arts'),
            array('key' => 'field_thr_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'theatre_hero_icon', 'type' => 'text', 'default_value' => 'theater'),
            array('key' => 'field_thr_hero_headline_before', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'theatre_hero_headline_before', 'type' => 'text', 'default_value' => 'Open Air'),
            array('key' => 'field_thr_hero_headline_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'theatre_hero_headline_highlight', 'type' => 'text', 'default_value' => 'Theatre'),
            array('key' => 'field_thr_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'theatre_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'A magnificent venue for performances, assemblies, and cultural celebrations under the open sky'),
            array('key' => 'field_thr_tab_overview', 'label' => __('Overview Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_thr_overview_heading', 'label' => __('Section Heading (before highlight)', 'mlzs'), 'name' => 'theatre_overview_heading', 'type' => 'text', 'default_value' => 'The'),
            array('key' => 'field_thr_overview_highlight', 'label' => __('Section Heading (highlighted)', 'mlzs'), 'name' => 'theatre_overview_heading_highlight', 'type' => 'text', 'default_value' => 'Stage'),
            array('key' => 'field_thr_overview_heading_after', 'label' => __('Section Heading (after highlight)', 'mlzs'), 'name' => 'theatre_overview_heading_after', 'type' => 'text', 'default_value' => 'of Excellence'),
            array('key' => 'field_thr_overview_para1', 'label' => __('Paragraph 1', 'mlzs'), 'name' => 'theatre_overview_para1', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_thr_overview_para2', 'label' => __('Paragraph 2', 'mlzs'), 'name' => 'theatre_overview_para2', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_thr_stat1_number', 'label' => __('Stat 1 Number', 'mlzs'), 'name' => 'theatre_stat1_number', 'type' => 'text', 'default_value' => '500+'),
            array('key' => 'field_thr_stat1_label', 'label' => __('Stat 1 Label', 'mlzs'), 'name' => 'theatre_stat1_label', 'type' => 'text', 'default_value' => 'Seating Capacity'),
            array('key' => 'field_thr_stat2_number', 'label' => __('Stat 2 Number', 'mlzs'), 'name' => 'theatre_stat2_number', 'type' => 'text', 'default_value' => '30+'),
            array('key' => 'field_thr_stat2_label', 'label' => __('Stat 2 Label', 'mlzs'), 'name' => 'theatre_stat2_label', 'type' => 'text', 'default_value' => 'Annual Events'),
            array('key' => 'field_thr_main_image', 'label' => __('Main Theatre Image', 'mlzs'), 'name' => 'theatre_main_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_thr_stage_badge_title', 'label' => __('Stage Badge Title', 'mlzs'), 'name' => 'theatre_stage_badge_title', 'type' => 'text', 'default_value' => 'Main Stage'),
            array('key' => 'field_thr_stage_badge_subtitle', 'label' => __('Stage Badge Subtitle', 'mlzs'), 'name' => 'theatre_stage_badge_subtitle', 'type' => 'text', 'default_value' => 'Amphitheater Style'),
            array('key' => 'field_thr_tab_features', 'label' => __('Stage Features', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_thr_features_badge', 'label' => __('Features Badge', 'mlzs'), 'name' => 'theatre_features_badge', 'type' => 'text', 'default_value' => 'Stage Features'),
            array('key' => 'field_thr_features_heading', 'label' => __('Features Heading (before highlight)', 'mlzs'), 'name' => 'theatre_features_heading', 'type' => 'text', 'default_value' => 'World-Class'),
            array('key' => 'field_thr_features_highlight', 'label' => __('Features Heading (highlighted)', 'mlzs'), 'name' => 'theatre_features_heading_highlight', 'type' => 'text', 'default_value' => 'Facilities'),
            array('key' => 'field_thr_features_subtext', 'label' => __('Features Subtext', 'mlzs'), 'name' => 'theatre_features_subtext', 'type' => 'text', 'default_value' => 'Equipped with professional sound, lighting, and seating for exceptional performances'),
            array('key' => 'field_thr_features_list', 'label' => __('Feature Cards (3)', 'mlzs'), 'name' => 'theatre_features_list', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add Feature', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_thr_feat_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'speaker'),
                array('key' => 'field_thr_feat_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_thr_feat_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 3),
                array('key' => 'field_thr_feat_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_thr_tab_gallery', 'label' => __('Performance Gallery', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_thr_gallery_badge', 'label' => __('Gallery Badge', 'mlzs'), 'name' => 'theatre_gallery_badge', 'type' => 'text', 'default_value' => 'Performance Gallery'),
            array('key' => 'field_thr_gallery_heading', 'label' => __('Gallery Heading (before highlight)', 'mlzs'), 'name' => 'theatre_gallery_heading', 'type' => 'text', 'default_value' => 'Memorable'),
            array('key' => 'field_thr_gallery_highlight', 'label' => __('Gallery Heading (highlighted)', 'mlzs'), 'name' => 'theatre_gallery_heading_highlight', 'type' => 'text', 'default_value' => 'Moments'),
            array('key' => 'field_thr_gallery_subtext', 'label' => __('Gallery Subtext', 'mlzs'), 'name' => 'theatre_gallery_subtext', 'type' => 'text', 'default_value' => 'Capturing the magic of performances in our magnificent open air theatre'),
            array('key' => 'field_thr_gallery_items', 'label' => __('Gallery Items (3)', 'mlzs'), 'name' => 'theatre_gallery_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_thr_gal_image', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
                array('key' => 'field_thr_gal_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_thr_gal_caption', 'label' => __('Caption', 'mlzs'), 'name' => 'caption', 'type' => 'text'),
                array('key' => 'field_thr_gal_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'badge', 'type' => 'text', 'default_value' => 'Dance', 'instructions' => __('e.g. Dance, Drama, Music', 'mlzs')),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'theatre.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_theatre_field_group');
