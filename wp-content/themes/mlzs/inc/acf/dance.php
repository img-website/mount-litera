<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Music & Dance Page – Hero, Intro, Gallery, Programs, Benefits, CTA
 */
function mlzs_acf_dance_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_dance',
        'title'                 => __('Music & Dance Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_dance_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_dance_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'dance_hero_badge', 'type' => 'text', 'default_value' => 'Rhythmic Expression'),
            array('key' => 'field_dance_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'dance_hero_icon', 'type' => 'text', 'default_value' => 'music'),
            array('key' => 'field_dance_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'dance_hero_headline', 'type' => 'text', 'default_value' => 'Music &'),
            array('key' => 'field_dance_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'dance_hero_highlight', 'type' => 'text', 'default_value' => 'Dance'),
            array('key' => 'field_dance_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'dance_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Where rhythm meets expression, creating harmony in mind, body, and soul'),
            array('key' => 'field_dance_tab_intro', 'label' => __('Introduction', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_dance_intro_heading', 'label' => __('Intro Heading', 'mlzs'), 'name' => 'dance_intro_heading', 'type' => 'text', 'default_value' => 'The Healing Power of Music & Dance'),
            array('key' => 'field_dance_intro_icon', 'label' => __('Intro Icon', 'mlzs'), 'name' => 'dance_intro_icon', 'type' => 'text', 'default_value' => 'heart'),
            array('key' => 'field_dance_intro_para1', 'label' => __('Intro Paragraph', 'mlzs'), 'name' => 'dance_intro_para1', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_dance_intro_box_heading', 'label' => __('Box Heading (Music Program)', 'mlzs'), 'name' => 'dance_intro_box_heading', 'type' => 'text', 'default_value' => 'Comprehensive Music Program'),
            array('key' => 'field_dance_intro_box_text', 'label' => __('Box Text', 'mlzs'), 'name' => 'dance_intro_box_text', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_dance_tab_gallery', 'label' => __('Gallery', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_dance_gallery_heading', 'label' => __('Gallery Heading (before highlight)', 'mlzs'), 'name' => 'dance_gallery_heading', 'type' => 'text', 'default_value' => 'Our'),
            array('key' => 'field_dance_gallery_highlight', 'label' => __('Gallery Heading (highlighted)', 'mlzs'), 'name' => 'dance_gallery_highlight', 'type' => 'text', 'default_value' => 'Performance Gallery'),
            array('key' => 'field_dance_gallery_sub', 'label' => __('Gallery Subheading', 'mlzs'), 'name' => 'dance_gallery_sub', 'type' => 'text', 'default_value' => 'Capturing moments of musical excellence and rhythmic expression'),
            array('key' => 'field_dance_gallery_images', 'label' => __('Gallery Images (first 4 = row 1, next 2 = row 2 large)', 'mlzs'), 'name' => 'dance_gallery_images', 'type' => 'repeater', 'layout' => 'block', 'button_label' => __('Add Image', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_dance_gallery_img', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_dance_gallery_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_dance_gallery_caption', 'label' => __('Caption', 'mlzs'), 'name' => 'caption', 'type' => 'text'),
                array('key' => 'field_dance_gallery_large', 'label' => __('Large (second row)', 'mlzs'), 'name' => 'large', 'type' => 'true_false', 'ui' => 1, 'default_value' => 0),
            )),
            array('key' => 'field_dance_tab_programs', 'label' => __('Programs', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_dance_programs_heading', 'label' => __('Programs Heading (before highlight)', 'mlzs'), 'name' => 'dance_programs_heading', 'type' => 'text', 'default_value' => 'Our'),
            array('key' => 'field_dance_programs_highlight', 'label' => __('Programs Heading (highlighted)', 'mlzs'), 'name' => 'dance_programs_highlight', 'type' => 'text', 'default_value' => 'Programs'),
            array('key' => 'field_dance_programs_sub', 'label' => __('Programs Subheading', 'mlzs'), 'name' => 'dance_programs_sub', 'type' => 'text', 'default_value' => 'Comprehensive music and dance education from 1st to 9th standard'),
            array('key' => 'field_dance_music_heading', 'label' => __('Music Program Heading', 'mlzs'), 'name' => 'dance_music_heading', 'type' => 'text', 'default_value' => 'Music Program'),
            array('key' => 'field_dance_music_icon', 'label' => __('Music Program Icon', 'mlzs'), 'name' => 'dance_music_icon', 'type' => 'text', 'default_value' => 'music-2'),
            array('key' => 'field_dance_music_items', 'label' => __('Music Program Items', 'mlzs'), 'name' => 'dance_music_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_dance_music_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_dance_dance_heading', 'label' => __('Dance Program Heading', 'mlzs'), 'name' => 'dance_dance_heading', 'type' => 'text', 'default_value' => 'Dance Program'),
            array('key' => 'field_dance_dance_icon', 'label' => __('Dance Program Icon', 'mlzs'), 'name' => 'dance_dance_icon', 'type' => 'text', 'default_value' => 'sparkles'),
            array('key' => 'field_dance_dance_items', 'label' => __('Dance Program Items', 'mlzs'), 'name' => 'dance_dance_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_dance_dance_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_dance_tab_benefits', 'label' => __('Benefits', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_dance_benefits_heading', 'label' => __('Benefits Heading', 'mlzs'), 'name' => 'dance_benefits_heading', 'type' => 'text', 'default_value' => 'Benefits of Music & Dance Education'),
            array('key' => 'field_dance_benefits_icon', 'label' => __('Benefits Icon', 'mlzs'), 'name' => 'dance_benefits_icon', 'type' => 'text', 'default_value' => 'star'),
            array('key' => 'field_dance_benefits_list', 'label' => __('Benefits (4 items)', 'mlzs'), 'name' => 'dance_benefits_list', 'type' => 'repeater', 'min' => 4, 'max' => 4, 'layout' => 'block', 'button_label' => __('Add Benefit', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_dance_benefit_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'brain'),
                array('key' => 'field_dance_benefit_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_dance_benefit_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_dance_benefit_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_dance_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_dance_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'dance_cta_heading', 'type' => 'text', 'default_value' => 'Join Our Rhythmic Journey'),
            array('key' => 'field_dance_cta_description', 'label' => __('CTA Description', 'mlzs'), 'name' => 'dance_cta_description', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_dance_cta_btn_primary', 'label' => __('Primary Button', 'mlzs'), 'name' => 'dance_cta_btn_primary', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_dance_cta_btn_primary_icon', 'label' => __('Primary Button Icon', 'mlzs'), 'name' => 'dance_cta_btn_primary_icon', 'type' => 'text', 'default_value' => 'calendar'),
            array('key' => 'field_dance_cta_btn_secondary', 'label' => __('Secondary Button', 'mlzs'), 'name' => 'dance_cta_btn_secondary', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_dance_cta_btn_secondary_icon', 'label' => __('Secondary Button Icon', 'mlzs'), 'name' => 'dance_cta_btn_secondary_icon', 'type' => 'text', 'default_value' => 'music'),
            array('key' => 'field_dance_cta_stats', 'label' => __('Stats (4 boxes)', 'mlzs'), 'name' => 'dance_cta_stats', 'type' => 'repeater', 'min' => 4, 'max' => 4, 'layout' => 'table', 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_dance_cta_stat_number', 'label' => __('Number', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                array('key' => 'field_dance_cta_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
        ),
        'location' => array(
            array(
                array('param' => 'page_template', 'operator' => '==', 'value' => 'dance.php'),
            ),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_dance_field_group');
