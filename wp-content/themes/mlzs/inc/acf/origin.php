<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Origin / Campus Page – Hero, Campus Overview (4 items), Videos (2), Gallery (6+), Features (4), CTA (Link buttons)
 * Image alt = use attachment alt from Media Library; no separate ACF alt field.
 */
function mlzs_acf_origin_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_origin',
        'title'                 => __('Campus / Origin Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_origin_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_origin_hero_bg_image', 'label' => __('Hero Background Image', 'mlzs'), 'name' => 'origin_hero_bg_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium', 'instructions' => __('Optional. Matches origin.html hero background.', 'mlzs')),
            array('key' => 'field_origin_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'origin_hero_badge', 'type' => 'text', 'default_value' => 'Campus Tour'),
            array('key' => 'field_origin_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'origin_hero_icon', 'type' => 'text', 'default_value' => 'map-pin'),
            array('key' => 'field_origin_hero_headline_before', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'origin_hero_headline_before', 'type' => 'text', 'default_value' => 'Our'),
            array('key' => 'field_origin_hero_headline_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'origin_hero_headline_highlight', 'type' => 'text', 'default_value' => 'Campus'),
            array('key' => 'field_origin_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'origin_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Discover the vibrant learning environment at Mount Litera Zee School, Alwar - 5 acres of inspiring spaces designed for holistic education.'),
            array('key' => 'field_origin_tab_overview', 'label' => __('Campus Overview', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_origin_overview_section_image', 'label' => __('Campus / Section Image', 'mlzs'), 'name' => 'origin_overview_section_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium', 'instructions' => __('Optional. Image shown beside overview (matches origin.html).', 'mlzs')),
            array('key' => 'field_origin_overview_heading', 'label' => __('Card Heading', 'mlzs'), 'name' => 'origin_overview_heading', 'type' => 'text', 'default_value' => 'Campus Overview'),
            array('key' => 'field_origin_overview_location', 'label' => __('Location Subtitle', 'mlzs'), 'name' => 'origin_overview_location', 'type' => 'text', 'default_value' => 'Sirmoli Village, Alwar'),
            array('key' => 'field_origin_overview_icon', 'label' => __('Card Icon', 'mlzs'), 'name' => 'origin_overview_icon', 'type' => 'text', 'default_value' => 'building-2'),
            array('key' => 'field_origin_overview_items', 'label' => __('Overview Items (4)', 'mlzs'), 'name' => 'origin_overview_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 4, 'max' => 4, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_origin_ov_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'map'),
                array('key' => 'field_origin_ov_style', 'label' => __('Icon Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light', 'accent-dark' => 'Accent Dark'), 'default_value' => 'primary'),
                array('key' => 'field_origin_ov_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Prime Location'),
                array('key' => 'field_origin_ov_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 3),
            )),
            array('key' => 'field_origin_video1_icon', 'label' => __('Video 1 Block Icon', 'mlzs'), 'name' => 'origin_video1_icon', 'type' => 'text', 'default_value' => 'play-circle'),
            array('key' => 'field_origin_video1_title', 'label' => __('Video 1 Title', 'mlzs'), 'name' => 'origin_video1_title', 'type' => 'text', 'default_value' => 'Campus Tour Video'),
            array('key' => 'field_origin_video1_url', 'label' => __('Video 1 URL (optional)', 'mlzs'), 'name' => 'origin_video1_url', 'type' => 'url', 'instructions' => __('Label and duration are auto-derived from the video.', 'mlzs')),
            array('key' => 'field_origin_video2_icon', 'label' => __('Video 2 Block Icon', 'mlzs'), 'name' => 'origin_video2_icon', 'type' => 'text', 'default_value' => 'video'),
            array('key' => 'field_origin_video2_title', 'label' => __('Video 2 Title', 'mlzs'), 'name' => 'origin_video2_title', 'type' => 'text', 'default_value' => 'Virtual Walkthrough'),
            array('key' => 'field_origin_video2_url', 'label' => __('Video 2 URL (optional)', 'mlzs'), 'name' => 'origin_video2_url', 'type' => 'url', 'instructions' => __('Label and duration are auto-derived from the video.', 'mlzs')),
            array('key' => 'field_origin_tab_gallery', 'label' => __('Campus Gallery', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_origin_gallery_icon', 'label' => __('Gallery Badge Icon', 'mlzs'), 'name' => 'origin_gallery_icon', 'type' => 'text', 'default_value' => 'image'),
            array('key' => 'field_origin_gallery_badge', 'label' => __('Gallery Badge', 'mlzs'), 'name' => 'origin_gallery_badge', 'type' => 'text', 'default_value' => 'Photo Gallery'),
            array('key' => 'field_origin_gallery_heading_before', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'origin_gallery_heading_before', 'type' => 'text', 'default_value' => 'Explore Our'),
            array('key' => 'field_origin_gallery_heading_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'origin_gallery_heading_highlight', 'type' => 'text', 'default_value' => 'Campus'),
            array('key' => 'field_origin_gallery_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'origin_gallery_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Take a visual tour through our state-of-the-art facilities and beautiful campus spaces.'),
            array('key' => 'field_origin_gallery_items', 'label' => __('Gallery Cards (6)', 'mlzs'), 'name' => 'origin_gallery_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 6, 'max' => 6, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_origin_gal_image', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_origin_gal_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Academic Building'),
                array('key' => 'field_origin_gal_caption', 'label' => __('Caption', 'mlzs'), 'name' => 'caption', 'type' => 'text', 'default_value' => 'Main campus entrance and academic block'),
            )),
            array('key' => 'field_origin_gallery_more_images', 'label' => __('More Images Grid', 'mlzs'), 'name' => 'origin_gallery_more_images', 'type' => 'gallery', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'library' => 'all', 'min' => 0, 'max' => 0, 'instructions' => __('Additional gallery images (grid below the 6 cards). Matches origin.html lines 470–497.', 'mlzs')),
            array('key' => 'field_origin_gallery_btn_link', 'label' => __('View Complete Gallery Button Link', 'mlzs'), 'name' => 'origin_gallery_btn_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label.', 'mlzs')),
            array('key' => 'field_origin_tab_features', 'label' => __('Campus Features (4)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_origin_features_heading_before', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'origin_features_heading_before', 'type' => 'text', 'default_value' => 'Campus'),
            array('key' => 'field_origin_features_heading_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'origin_features_heading_highlight', 'type' => 'text', 'default_value' => 'Features'),
            array('key' => 'field_origin_features_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'origin_features_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Discover what makes our campus an ideal learning environment'),
            array('key' => 'field_origin_features_items', 'label' => __('Feature Cards (4)', 'mlzs'), 'name' => 'origin_features_items', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add Feature', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_origin_feat_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'trees'),
                array('key' => 'field_origin_feat_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light', 'accent-dark' => 'Accent Dark'), 'default_value' => 'primary'),
                array('key' => 'field_origin_feat_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => '5 Acre Campus'),
                array('key' => 'field_origin_feat_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_origin_tab_cta', 'label' => __('Visit Campus CTA', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_origin_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'origin_cta_heading', 'type' => 'text', 'default_value' => 'Experience Our Campus in Person'),
            array('key' => 'field_origin_cta_paragraph', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'origin_cta_paragraph', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Schedule a personalized campus tour and see for yourself what makes Mount Litera special.'),
            array('key' => 'field_origin_cta_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'origin_cta_btn1_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Schedule a Tour).', 'mlzs')),
            array('key' => 'field_origin_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'origin_cta_btn1_icon', 'type' => 'text', 'default_value' => 'calendar'),
            array('key' => 'field_origin_cta_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'origin_cta_btn2_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Contact Admissions).', 'mlzs')),
            array('key' => 'field_origin_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'origin_cta_btn2_icon', 'type' => 'text', 'default_value' => 'phone'),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'origin.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_origin_field_group');
