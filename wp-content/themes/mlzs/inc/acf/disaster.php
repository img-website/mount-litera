<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Disaster Management Page – full content dynamic, all icons dynamic (Hero, Aim/Need/Committee, SDMP a/b, Dissemination, Drills, Safety, Health, CTA)
 */
function mlzs_acf_disaster_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_disaster',
        'title'                 => __('Disaster Management Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_disaster_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_disaster_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'disaster_hero_badge', 'type' => 'text', 'default_value' => 'Safety First'),
            array('key' => 'field_disaster_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'disaster_hero_icon', 'type' => 'text', 'default_value' => 'shield-alert'),
            array('key' => 'field_disaster_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'disaster_hero_headline', 'type' => 'text', 'default_value' => 'Disaster'),
            array('key' => 'field_disaster_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'disaster_hero_highlight', 'type' => 'text', 'default_value' => 'Management'),
            array('key' => 'field_disaster_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'disaster_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Ensuring student and staff safety through comprehensive preparedness and response planning'),
            array('key' => 'field_disaster_tab_aim', 'label' => __('Aim & Need & Committee', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_disaster_aim_icon', 'label' => __('Aim Box Icon', 'mlzs'), 'name' => 'disaster_aim_icon', 'type' => 'text', 'default_value' => 'target'),
            array('key' => 'field_disaster_aim_heading', 'label' => __('Aim Heading', 'mlzs'), 'name' => 'disaster_aim_heading', 'type' => 'text', 'default_value' => 'Aim'),
            array('key' => 'field_disaster_aim_text', 'label' => __('Aim Text', 'mlzs'), 'name' => 'disaster_aim_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_disaster_need_icon', 'label' => __('Need Box Icon', 'mlzs'), 'name' => 'disaster_need_icon', 'type' => 'text', 'default_value' => 'alert-triangle'),
            array('key' => 'field_disaster_need_heading', 'label' => __('Need Heading', 'mlzs'), 'name' => 'disaster_need_heading', 'type' => 'text', 'default_value' => 'Need For Disaster Management Plan'),
            array('key' => 'field_disaster_need_text', 'label' => __('Need Text', 'mlzs'), 'name' => 'disaster_need_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_disaster_committee_icon', 'label' => __('Committee Box Icon', 'mlzs'), 'name' => 'disaster_committee_icon', 'type' => 'text', 'default_value' => 'users'),
            array('key' => 'field_disaster_committee_heading', 'label' => __('Committee Heading', 'mlzs'), 'name' => 'disaster_committee_heading', 'type' => 'text', 'default_value' => 'Disaster Management Committee'),
            array('key' => 'field_disaster_committee_intro', 'label' => __('Committee Intro', 'mlzs'), 'name' => 'disaster_committee_intro', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_disaster_committee_members', 'label' => __('Committee Members (one per line)', 'mlzs'), 'name' => 'disaster_committee_members', 'type' => 'textarea', 'rows' => 8),
            array('key' => 'field_disaster_committee_students', 'label' => __('Committee Students Line', 'mlzs'), 'name' => 'disaster_committee_students', 'type' => 'text', 'placeholder' => 'e.g. Students: Riya Verma, Deepak Yadav, Parth Sharma', 'instructions' => __('Optional. Shown below members with bold styling (mt-2 font-medium). Leave blank to hide.', 'mlzs')),
            array('key' => 'field_disaster_side_image', 'label' => __('Side Image (above committee)', 'mlzs'), 'name' => 'disaster_side_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_disaster_tab_sdmp', 'label' => __('SDMP Document', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_disaster_sdmp_heading', 'label' => __('SDMP Heading', 'mlzs'), 'name' => 'disaster_sdmp_heading', 'type' => 'text', 'default_value' => 'Preparation of the School Disaster Management Plan Document'),
            array('key' => 'field_disaster_sdmp_intro', 'label' => __('SDMP Intro', 'mlzs'), 'name' => 'disaster_sdmp_intro', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_disaster_sdmp_items', 'label' => __('SDMP Content: use label "a)" or "b)" for blocks, icon+text for list items', 'mlzs'), 'name' => 'disaster_sdmp_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Row', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_disaster_sdmp_label', 'label' => __('Label (e.g. a) or b))', 'mlzs'), 'name' => 'label', 'type' => 'text', 'placeholder' => 'a), b), or leave blank'),
                array('key' => 'field_disaster_sdmp_item_icon', 'label' => __('Icon (leave blank for paragraph rows)', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                array('key' => 'field_disaster_sdmp_item_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_disaster_tab_dissem', 'label' => __('Dissemination', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_disaster_dissem_heading', 'label' => __('Dissemination Heading', 'mlzs'), 'name' => 'disaster_dissem_heading', 'type' => 'text', 'default_value' => 'Dissemination Of The Information On SDMP To Everybody In The School'),
            array('key' => 'field_disaster_dissem_intro', 'label' => __('Dissemination Intro', 'mlzs'), 'name' => 'disaster_dissem_intro', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_disaster_dissem_activities', 'label' => __('Activities (icon + label)', 'mlzs'), 'name' => 'disaster_dissem_activities', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Activity', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_disaster_dissem_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                array('key' => 'field_disaster_dissem_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
            array('key' => 'field_disaster_tab_drills', 'label' => __('Mock Drills', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_disaster_drills_heading_icon', 'label' => __('Drills Section Icon', 'mlzs'), 'name' => 'disaster_drills_heading_icon', 'type' => 'text', 'default_value' => 'alarm-clock'),
            array('key' => 'field_disaster_drills_heading', 'label' => __('Drills Section Heading', 'mlzs'), 'name' => 'disaster_drills_heading', 'type' => 'text', 'default_value' => 'Mock Drills'),
            array('key' => 'field_disaster_drills_intro', 'label' => __('Drills Intro Paragraph', 'mlzs'), 'name' => 'disaster_drills_intro', 'type' => 'textarea', 'rows' => 4),
            array('key' => 'field_disaster_drills_cards', 'label' => __('Drill Cards (3)', 'mlzs'), 'name' => 'disaster_drills_cards', 'type' => 'repeater', 'min' => 3, 'max' => 3, 'layout' => 'block', 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_disaster_drill_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_disaster_drill_icon', 'label' => __('Card Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'earthquake'),
                array('key' => 'field_disaster_drill_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
                array('key' => 'field_disaster_drill_items', 'label' => __('Items (icon + text per item)', 'mlzs'), 'name' => 'items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                    array('key' => 'field_disaster_drill_item_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                    array('key' => 'field_disaster_drill_item_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
                )),
            )),
            array('key' => 'field_disaster_tab_safety', 'label' => __('Safety Precautions', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_disaster_safety_cyclones_heading', 'label' => __('Cyclones Heading', 'mlzs'), 'name' => 'disaster_safety_cyclones_heading', 'type' => 'text', 'default_value' => 'Safety Precautions During Cyclones'),
            array('key' => 'field_disaster_safety_cyclones_para', 'label' => __('Cyclones Paragraph', 'mlzs'), 'name' => 'disaster_safety_cyclones_para', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_disaster_safety_cyclones_list', 'label' => __('Cyclones List (icon + text)', 'mlzs'), 'name' => 'disaster_safety_cyclones_list', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_disaster_cyclone_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                array('key' => 'field_disaster_cyclone_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_disaster_safety_general_heading', 'label' => __('General Precautions Heading', 'mlzs'), 'name' => 'disaster_safety_general_heading', 'type' => 'text', 'default_value' => 'General Precautions During Cyclone'),
            array('key' => 'field_disaster_safety_general_list', 'label' => __('General List (icon + text)', 'mlzs'), 'name' => 'disaster_safety_general_list', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_disaster_general_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                array('key' => 'field_disaster_general_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_disaster_tab_health', 'label' => __('Health & Guidelines', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_disaster_health_norms_heading', 'label' => __('Health Norms Heading', 'mlzs'), 'name' => 'disaster_health_norms_heading', 'type' => 'text', 'default_value' => 'Health and Safety Norms'),
            array('key' => 'field_disaster_health_norms_items', 'label' => __('Health Norms (icon + label)', 'mlzs'), 'name' => 'disaster_health_norms_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_disaster_norm_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                array('key' => 'field_disaster_norm_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
            array('key' => 'field_disaster_health_hygiene_heading', 'label' => __('Hygiene Heading', 'mlzs'), 'name' => 'disaster_health_hygiene_heading', 'type' => 'text', 'default_value' => 'Health and Hygiene Measures'),
            array('key' => 'field_disaster_health_hygiene_list', 'label' => __('Hygiene List (icon + text)', 'mlzs'), 'name' => 'disaster_health_hygiene_list', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_disaster_hygiene_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                array('key' => 'field_disaster_hygiene_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_disaster_guidelines_heading', 'label' => __('Guidelines Heading', 'mlzs'), 'name' => 'disaster_guidelines_heading', 'type' => 'text', 'default_value' => 'Guidelines'),
            array('key' => 'field_disaster_guidelines_list', 'label' => __('Guidelines (icon + text)', 'mlzs'), 'name' => 'disaster_guidelines_list', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_disaster_guideline_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                array('key' => 'field_disaster_guideline_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_disaster_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_disaster_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'disaster_cta_heading', 'type' => 'text', 'default_value' => 'Student Safety Measures'),
            array('key' => 'field_disaster_cta_measures', 'label' => __('Measures (icon + text)', 'mlzs'), 'name' => 'disaster_cta_measures', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Measure', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_disaster_cta_measure_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                array('key' => 'field_disaster_cta_measure_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_disaster_cta_btn_primary', 'label' => __('Primary Button', 'mlzs'), 'name' => 'disaster_cta_btn_primary', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_disaster_cta_btn_primary_icon', 'label' => __('Primary Button Icon', 'mlzs'), 'name' => 'disaster_cta_btn_primary_icon', 'type' => 'text', 'default_value' => 'download'),
            array('key' => 'field_disaster_cta_btn_secondary', 'label' => __('Secondary Button', 'mlzs'), 'name' => 'disaster_cta_btn_secondary', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_disaster_cta_btn_secondary_icon', 'label' => __('Secondary Button Icon', 'mlzs'), 'name' => 'disaster_cta_btn_secondary_icon', 'type' => 'text', 'default_value' => 'calendar'),
            array('key' => 'field_disaster_cta_stats', 'label' => __('Stats (4 boxes)', 'mlzs'), 'name' => 'disaster_cta_stats', 'type' => 'repeater', 'min' => 4, 'max' => 4, 'layout' => 'table', 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_disaster_cta_stat_number', 'label' => __('Number', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                array('key' => 'field_disaster_cta_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'disaster.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_disaster_field_group');
