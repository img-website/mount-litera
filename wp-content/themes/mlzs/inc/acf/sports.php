<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Sports Page – Hero, Overview, Philosophy, Facilities, Gallery
 */
function mlzs_acf_sports_field_group() {
    if (!function_exists('acf_add_local_field_group')) return;
    acf_add_local_field_group(array(
        'key' => 'group_mlzs_sports',
        'title' => __('Sports Page Sections', 'mlzs'),
        'fields' => array(
            array('key' => 'field_sports_tab_hero', 'label' => __('Hero', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_sports_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'sports_hero_badge', 'type' => 'text', 'default_value' => 'Athletics & Fitness'),
            array('key' => 'field_sports_hero_headline', 'label' => __('Headline', 'mlzs'), 'name' => 'sports_hero_headline', 'type' => 'text', 'default_value' => 'Games &'),
            array('key' => 'field_sports_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'sports_hero_highlight', 'type' => 'text', 'default_value' => 'Sports'),
            array('key' => 'field_sports_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'sports_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Fostering all-round development through diverse sporting activities and healthy competition'),
            array('key' => 'field_sports_tab_overview', 'label' => __('Overview', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_sports_overview_heading', 'label' => __('Overview Heading', 'mlzs'), 'name' => 'sports_overview_heading', 'type' => 'text', 'default_value' => 'Building Champions'),
            array('key' => 'field_sports_card1_text', 'label' => __('Card 1 Text', 'mlzs'), 'name' => 'sports_card1_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_sports_card2_text', 'label' => __('Card 2 Text', 'mlzs'), 'name' => 'sports_card2_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_sports_stat1_number', 'label' => __('Stat 1 Number', 'mlzs'), 'name' => 'sports_stat1_number', 'type' => 'text', 'default_value' => '12+'),
            array('key' => 'field_sports_stat1_label', 'label' => __('Stat 1 Label', 'mlzs'), 'name' => 'sports_stat1_label', 'type' => 'text', 'default_value' => 'Sports Activities'),
            array('key' => 'field_sports_stat2_number', 'label' => __('Stat 2 Number', 'mlzs'), 'name' => 'sports_stat2_number', 'type' => 'text', 'default_value' => '100%'),
            array('key' => 'field_sports_stat2_label', 'label' => __('Stat 2 Label', 'mlzs'), 'name' => 'sports_stat2_label', 'type' => 'text', 'default_value' => 'Student Participation'),
            array('key' => 'field_sports_overview_image', 'label' => __('Overview Image', 'mlzs'), 'name' => 'sports_overview_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_sports_badge_title', 'label' => __('Image Badge Title', 'mlzs'), 'name' => 'sports_badge_title', 'type' => 'text', 'default_value' => 'All-Round Development'),
            array('key' => 'field_sports_badge_subtext', 'label' => __('Image Badge Subtext', 'mlzs'), 'name' => 'sports_badge_subtext', 'type' => 'text', 'default_value' => 'Health & Fitness'),
            array('key' => 'field_sports_tab_philosophy', 'label' => __('Philosophy', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_sports_philosophy_heading', 'label' => __('Philosophy Heading', 'mlzs'), 'name' => 'sports_philosophy_heading', 'type' => 'text', 'default_value' => 'Our Sports Philosophy'),
            array('key' => 'field_sports_philosophy_paragraph', 'label' => __('Philosophy Paragraph', 'mlzs'), 'name' => 'sports_philosophy_paragraph', 'type' => 'textarea', 'rows' => 4),
            array('key' => 'field_sports_tab_facilities', 'label' => __('Facilities List', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_sports_facilities_badge', 'label' => __('Facilities Badge', 'mlzs'), 'name' => 'sports_facilities_badge', 'type' => 'text', 'default_value' => 'Available Sports'),
            array('key' => 'field_sports_facilities_heading', 'label' => __('Facilities Heading', 'mlzs'), 'name' => 'sports_facilities_heading', 'type' => 'text', 'default_value' => 'Wide Range of Activities'),
            array('key' => 'field_sports_facilities_highlight', 'label' => __('Facilities Highlight Word', 'mlzs'), 'name' => 'sports_facilities_highlight', 'type' => 'text', 'default_value' => 'Activities'),
            array('key' => 'field_sports_facilities_subtext', 'label' => __('Facilities Subtext', 'mlzs'), 'name' => 'sports_facilities_subtext', 'type' => 'text', 'default_value' => 'From outdoor team sports to indoor strategic games, we offer diverse sporting opportunities'),
            array('key' => 'field_sports_items', 'label' => __('Sports Items', 'mlzs'), 'name' => 'sports_items', 'type' => 'repeater', 'layout' => 'block', 'button_label' => __('Add Sport', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_sports_item_icon', 'label' => __('Icon (Lucide)', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'trophy'),
                array('key' => 'field_sports_item_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_sports_item_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_sports_tab_gallery', 'label' => __('Gallery', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_sports_gallery_badge', 'label' => __('Gallery Badge', 'mlzs'), 'name' => 'sports_gallery_badge', 'type' => 'text', 'default_value' => 'Photo Gallery'),
            array('key' => 'field_sports_gallery_heading', 'label' => __('Gallery Heading', 'mlzs'), 'name' => 'sports_gallery_heading', 'type' => 'text', 'default_value' => 'Sports Gallery'),
            array('key' => 'field_sports_gallery_highlight', 'label' => __('Gallery Highlight Word', 'mlzs'), 'name' => 'sports_gallery_highlight', 'type' => 'text', 'default_value' => 'Gallery'),
            array('key' => 'field_sports_gallery_subtext', 'label' => __('Gallery Subtext', 'mlzs'), 'name' => 'sports_gallery_subtext', 'type' => 'text', 'default_value' => 'Capturing moments of excellence, teamwork, and achievement in our sporting activities'),
            array('key' => 'field_sports_gallery_images', 'label' => __('Gallery Images', 'mlzs'), 'name' => 'sports_gallery_images', 'type' => 'gallery', 'return_format' => 'array', 'preview_size' => 'medium'),
        ),
        'location' => array(array(array('param' => 'page_template', 'operator' => '==', 'value' => 'sports.php'))),
    ));
}
add_action('acf/init', 'mlzs_acf_sports_field_group');
