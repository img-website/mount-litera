<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: School Timing Page – Hero, School Timings card, Important Persons, Additional info (3 cards)
 */
function mlzs_acf_timing_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_timing',
        'title'                 => __('School Timing Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_tim_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tim_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'timing_hero_badge', 'type' => 'text', 'default_value' => 'School Information'),
            array('key' => 'field_tim_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'timing_hero_icon', 'type' => 'text', 'default_value' => 'clock'),
            array('key' => 'field_tim_hero_headline_before', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'timing_hero_headline_before', 'type' => 'text', 'default_value' => 'School'),
            array('key' => 'field_tim_hero_headline_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'timing_hero_headline_highlight', 'type' => 'text', 'default_value' => 'Timing'),
            array('key' => 'field_tim_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'timing_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Find the complete schedule for academic sessions, important contacts, and key personnel at Mount Litera Zee School, Alwar.'),
            array('key' => 'field_tim_tab_timing', 'label' => __('School Timings Card', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tim_card_title', 'label' => __('Card Title', 'mlzs'), 'name' => 'timing_card_title', 'type' => 'text', 'default_value' => 'School Timings'),
            array('key' => 'field_tim_card_subtitle', 'label' => __('Card Subtitle', 'mlzs'), 'name' => 'timing_card_subtitle', 'type' => 'text', 'default_value' => 'Academic Session Schedule'),
            array('key' => 'field_tim_classes_heading', 'label' => __('Classes Heading', 'mlzs'), 'name' => 'timing_classes_heading', 'type' => 'text', 'default_value' => 'Classes I to XII'),
            array('key' => 'field_tim_summer_label', 'label' => __('Summer Label', 'mlzs'), 'name' => 'timing_summer_label', 'type' => 'text', 'default_value' => 'Summer'),
            array('key' => 'field_tim_summer_start', 'label' => __('Summer Start Time', 'mlzs'), 'name' => 'timing_summer_start', 'type' => 'time_picker', 'display_format' => 'g:i A', 'return_format' => 'g:i A'),
            array('key' => 'field_tim_summer_end', 'label' => __('Summer End Time', 'mlzs'), 'name' => 'timing_summer_end', 'type' => 'time_picker', 'display_format' => 'g:i A', 'return_format' => 'g:i A'),
            array('key' => 'field_tim_summer_caption', 'label' => __('Summer Caption', 'mlzs'), 'name' => 'timing_summer_caption', 'type' => 'text', 'default_value' => 'Morning to Early Afternoon Session'),
            array('key' => 'field_tim_winter_label', 'label' => __('Winter Label', 'mlzs'), 'name' => 'timing_winter_label', 'type' => 'text', 'default_value' => 'Winter'),
            array('key' => 'field_tim_winter_start', 'label' => __('Winter Start Time', 'mlzs'), 'name' => 'timing_winter_start', 'type' => 'time_picker', 'display_format' => 'g:i A', 'return_format' => 'g:i A'),
            array('key' => 'field_tim_winter_end', 'label' => __('Winter End Time', 'mlzs'), 'name' => 'timing_winter_end', 'type' => 'time_picker', 'display_format' => 'g:i A', 'return_format' => 'g:i A'),
            array('key' => 'field_tim_winter_caption', 'label' => __('Winter Caption', 'mlzs'), 'name' => 'timing_winter_caption', 'type' => 'text', 'default_value' => 'Late Morning to Afternoon Session'),
            array('key' => 'field_tim_note', 'label' => __('Note Text', 'mlzs'), 'name' => 'timing_note', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_tim_tab_persons', 'label' => __('Important Persons Card', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tim_persons_title', 'label' => __('Card Title', 'mlzs'), 'name' => 'timing_persons_title', 'type' => 'text', 'default_value' => 'Important Persons'),
            array('key' => 'field_tim_persons_subtitle', 'label' => __('Card Subtitle', 'mlzs'), 'name' => 'timing_persons_subtitle', 'type' => 'text', 'default_value' => 'Key Contacts & Administration'),
            array('key' => 'field_tim_persons_list', 'label' => __('Persons', 'mlzs'), 'name' => 'timing_persons_list', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'button_label' => __('Add Person', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tim_person_title', 'label' => __('Designation', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_tim_person_name', 'label' => __('Name', 'mlzs'), 'name' => 'name', 'type' => 'text'),
                array('key' => 'field_tim_person_email', 'label' => __('Email', 'mlzs'), 'name' => 'email', 'type' => 'email'),
                array('key' => 'field_tim_person_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'badge', 'type' => 'text'),
                array('key' => 'field_tim_person_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('principal' => 'Principal', 'admin' => 'Admin'), 'default_value' => 'admin'),
            )),
            array('key' => 'field_tim_guidelines_heading', 'label' => __('Contact Guidelines Heading', 'mlzs'), 'name' => 'timing_guidelines_heading', 'type' => 'text', 'default_value' => 'Contact Guidelines'),
            array('key' => 'field_tim_guidelines_list', 'label' => __('Guidelines List', 'mlzs'), 'name' => 'timing_guidelines_list', 'type' => 'repeater', 'layout' => 'row', 'min' => 0, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tim_guide_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_tim_tab_info', 'label' => __('Additional Info Cards', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tim_info_cards', 'label' => __('Info Cards (3)', 'mlzs'), 'name' => 'timing_info_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tim_info_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'calendar'),
                array('key' => 'field_tim_info_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_tim_info_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_tim_info_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'gray' => 'Gray'), 'default_value' => 'primary'),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'timing.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_timing_field_group');
