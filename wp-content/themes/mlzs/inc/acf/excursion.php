<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Excursion Page – Hero, Uttarakhand trip, Village Experience, Outbound, Benefits, CTA
 */
function mlzs_acf_excursion_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_excursion',
        'title'                 => __('Excursion Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_exc_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_exc_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'excursion_hero_badge', 'type' => 'text', 'default_value' => 'Learning Beyond Classroom'),
            array('key' => 'field_exc_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'excursion_hero_icon', 'type' => 'text', 'default_value' => 'map-pin'),
            array('key' => 'field_exc_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'excursion_hero_headline', 'type' => 'text', 'default_value' => 'Educational'),
            array('key' => 'field_exc_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'excursion_hero_highlight', 'type' => 'text', 'default_value' => 'Excursions'),
            array('key' => 'field_exc_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'excursion_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Exploring the world, connecting with nature, and creating lifelong memories through educational trips'),
            array('key' => 'field_exc_tab_uttarakhand', 'label' => __('Uttarakhand Trip', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_exc_utt_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'excursion_uttarakhand_icon', 'type' => 'text', 'default_value' => 'mountain'),
            array('key' => 'field_exc_utt_title', 'label' => __('Section Title', 'mlzs'), 'name' => 'excursion_uttarakhand_title', 'type' => 'text', 'default_value' => 'Uttarakhand Educational Excursion'),
            array('key' => 'field_exc_utt_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'excursion_uttarakhand_subtitle', 'type' => 'text', 'default_value' => 'Dehradun, Rishikesh, Mussoorie & Nainital'),
            array('key' => 'field_exc_utt_description', 'label' => __('Description', 'mlzs'), 'name' => 'excursion_uttarakhand_description', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_exc_utt_images', 'label' => __('Trip Images (2)', 'mlzs'), 'name' => 'excursion_uttarakhand_images', 'type' => 'repeater', 'min' => 0, 'max' => 6, 'layout' => 'block', 'button_label' => __('Add Image', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_exc_utt_img', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
                array('key' => 'field_exc_utt_img_alt', 'label' => __('Alt Text', 'mlzs'), 'name' => 'alt', 'type' => 'text'),
                array('key' => 'field_exc_utt_caption_title', 'label' => __('Caption Title', 'mlzs'), 'name' => 'caption_title', 'type' => 'text'),
                array('key' => 'field_exc_utt_caption_sub', 'label' => __('Caption Subtitle', 'mlzs'), 'name' => 'caption_subtitle', 'type' => 'text'),
            )),
            array('key' => 'field_exc_utt_activities_heading', 'label' => __('Activities Heading', 'mlzs'), 'name' => 'excursion_uttarakhand_activities_heading', 'type' => 'text', 'default_value' => 'Activities Participated'),
            array('key' => 'field_exc_utt_activities_icon', 'label' => __('Activities Icon', 'mlzs'), 'name' => 'excursion_uttarakhand_activities_icon', 'type' => 'text', 'default_value' => 'activity'),
            array('key' => 'field_exc_utt_activities', 'label' => __('Activities (icon + label)', 'mlzs'), 'name' => 'excursion_uttarakhand_activities', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_exc_utt_act_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'palette'),
                array('key' => 'field_exc_utt_act_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
            array('key' => 'field_exc_tab_village', 'label' => __('Village Experience', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_exc_village_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'excursion_village_icon', 'type' => 'text', 'default_value' => 'home'),
            array('key' => 'field_exc_village_title', 'label' => __('Title', 'mlzs'), 'name' => 'excursion_village_title', 'type' => 'text', 'default_value' => 'Village Immersion Experience'),
            array('key' => 'field_exc_village_description', 'label' => __('Description', 'mlzs'), 'name' => 'excursion_village_description', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_exc_village_items', 'label' => __('List Items (icon + text)', 'mlzs'), 'name' => 'excursion_village_items', 'type' => 'repeater', 'layout' => 'block', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_exc_village_item_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                array('key' => 'field_exc_village_item_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_exc_tab_outbound', 'label' => __('Outbound Programs', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_exc_outbound_images', 'label' => __('Images (2)', 'mlzs'), 'name' => 'excursion_outbound_images', 'type' => 'repeater', 'min' => 0, 'max' => 6, 'layout' => 'block', 'button_label' => __('Add Image', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_exc_out_img', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
                array('key' => 'field_exc_out_img_alt', 'label' => __('Alt Text', 'mlzs'), 'name' => 'alt', 'type' => 'text'),
                array('key' => 'field_exc_out_caption_title', 'label' => __('Caption Title', 'mlzs'), 'name' => 'caption_title', 'type' => 'text'),
                array('key' => 'field_exc_out_caption_sub', 'label' => __('Caption Subtitle', 'mlzs'), 'name' => 'caption_subtitle', 'type' => 'text'),
            )),
            array('key' => 'field_exc_outbound_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'excursion_outbound_icon', 'type' => 'text', 'default_value' => 'trees'),
            array('key' => 'field_exc_outbound_title', 'label' => __('Title', 'mlzs'), 'name' => 'excursion_outbound_title', 'type' => 'text', 'default_value' => 'Outbound Programs'),
            array('key' => 'field_exc_outbound_description', 'label' => __('Description', 'mlzs'), 'name' => 'excursion_outbound_description', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_exc_outbound_quote', 'label' => __('Quote (italic block)', 'mlzs'), 'name' => 'excursion_outbound_quote', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_exc_outbound_paragraph', 'label' => __('Second Paragraph', 'mlzs'), 'name' => 'excursion_outbound_paragraph', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_exc_tab_benefits', 'label' => __('Benefits Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_exc_benefits_heading', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'excursion_benefits_heading', 'type' => 'text', 'default_value' => 'Benefits of'),
            array('key' => 'field_exc_benefits_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'excursion_benefits_highlight', 'type' => 'text', 'default_value' => 'Educational Excursions'),
            array('key' => 'field_exc_benefits_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'excursion_benefits_subtext', 'type' => 'text', 'default_value' => 'Learning beyond classroom walls for holistic development'),
            array('key' => 'field_exc_benefits_cards', 'label' => __('Benefit Cards (icon, title, description)', 'mlzs'), 'name' => 'excursion_benefits_cards', 'type' => 'repeater', 'min' => 1, 'layout' => 'block', 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_exc_ben_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'users'),
                array('key' => 'field_exc_ben_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_exc_ben_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_exc_ben_style', 'label' => __('Card style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-alt' => 'Primary (border)'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_exc_tab_cta', 'label' => __('Upcoming CTA', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_exc_cta_title', 'label' => __('CTA Title', 'mlzs'), 'name' => 'excursion_cta_title', 'type' => 'text', 'default_value' => 'Upcoming Excursions'),
            array('key' => 'field_exc_cta_text', 'label' => __('CTA Text', 'mlzs'), 'name' => 'excursion_cta_text', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_exc_cta_btn1_label', 'label' => __('Button 1 Label', 'mlzs'), 'name' => 'excursion_cta_btn1_label', 'type' => 'text', 'default_value' => 'View Schedule'),
            array('key' => 'field_exc_cta_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'excursion_cta_btn1_link', 'type' => 'url'),
            array('key' => 'field_exc_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'excursion_cta_btn1_icon', 'type' => 'text', 'default_value' => 'calendar'),
            array('key' => 'field_exc_cta_btn2_label', 'label' => __('Button 2 Label', 'mlzs'), 'name' => 'excursion_cta_btn2_label', 'type' => 'text', 'default_value' => 'Photo Gallery'),
            array('key' => 'field_exc_cta_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'excursion_cta_btn2_link', 'type' => 'url'),
            array('key' => 'field_exc_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'excursion_cta_btn2_icon', 'type' => 'text', 'default_value' => 'camera'),
            array('key' => 'field_exc_cta_stats', 'label' => __('Stats (number + label)', 'mlzs'), 'name' => 'excursion_cta_stats', 'type' => 'repeater', 'min' => 0, 'max' => 6, 'layout' => 'table', 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_exc_cta_stat_number', 'label' => __('Number/Text', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                array('key' => 'field_exc_cta_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'excursion.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_excursion_field_group');
