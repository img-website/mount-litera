<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Transfer Certificate Page – Hero, Search form, Help & Guidelines, Results sidebar
 */
function mlzs_acf_transfer_certificate_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_transfer_certificate',
        'title'                 => __('Transfer Certificate Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_tc_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tc_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'tc_hero_badge', 'type' => 'text', 'default_value' => 'Student Documents'),
            array('key' => 'field_tc_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'tc_hero_icon', 'type' => 'text', 'default_value' => 'file-certificate'),
            array('key' => 'field_tc_hero_headline_before', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'tc_hero_headline_before', 'type' => 'text', 'default_value' => 'Transfer'),
            array('key' => 'field_tc_hero_headline_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'tc_hero_headline_highlight', 'type' => 'text', 'default_value' => 'Certificate'),
            array('key' => 'field_tc_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'tc_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Search and verify your Transfer Certificate using the unique serial number'),
            array('key' => 'field_tc_tab_search', 'label' => __('Search Form', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tc_search_title', 'label' => __('Search Title', 'mlzs'), 'name' => 'tc_search_title', 'type' => 'text', 'default_value' => 'Search Your TC'),
            array('key' => 'field_tc_search_subtitle', 'label' => __('Search Subtitle', 'mlzs'), 'name' => 'tc_search_subtitle', 'type' => 'text', 'default_value' => 'Find your Transfer Certificate using the serial number'),
            array('key' => 'field_tc_search_placeholder', 'label' => __('Input Placeholder', 'mlzs'), 'name' => 'tc_search_placeholder', 'type' => 'text', 'default_value' => 'TC-2024-XXXXX'),
            array('key' => 'field_tc_search_info_text', 'label' => __('Input Info Text', 'mlzs'), 'name' => 'tc_search_info_text', 'type' => 'text', 'default_value' => 'Format: TC-YEAR-NUMBER (Example: TC-2024-12345)'),
            array('key' => 'field_tc_search_btn_text', 'label' => __('Submit Button Text', 'mlzs'), 'name' => 'tc_search_btn_text', 'type' => 'text', 'default_value' => 'Search Certificate'),
            array('key' => 'field_tc_search_info_boxes', 'label' => __('Info Boxes (3)', 'mlzs'), 'name' => 'tc_search_info_boxes', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'max' => 3, 'button_label' => __('Add Box', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tc_search_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'shield-check', 'instructions' => __('e.g. shield-check, clock, download', 'mlzs')),
                array('key' => 'field_tc_search_box_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_tc_search_box_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'subtitle', 'type' => 'text'),
                array('key' => 'field_tc_search_box_style', 'label' => __('Color / Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'accent' => 'Accent'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_tc_tab_help', 'label' => __('Help & Guidelines', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tc_help_title', 'label' => __('Help Card Title', 'mlzs'), 'name' => 'tc_help_title', 'type' => 'text', 'default_value' => 'Need Help?'),
            array('key' => 'field_tc_help_paragraph', 'label' => __('Help Paragraph', 'mlzs'), 'name' => 'tc_help_paragraph', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Can't find your serial number? Contact our administration office for assistance."),
            array('key' => 'field_tc_help_phone', 'label' => __('Help Phone', 'mlzs'), 'name' => 'tc_help_phone', 'type' => 'text', 'default_value' => '+91 9672797979'),
            array('key' => 'field_tc_guidelines_title', 'label' => __('Guidelines Card Title', 'mlzs'), 'name' => 'tc_guidelines_title', 'type' => 'text', 'default_value' => 'TC Guidelines'),
            array('key' => 'field_tc_guidelines_list', 'label' => __('Guidelines List', 'mlzs'), 'name' => 'tc_guidelines_list', 'type' => 'repeater', 'layout' => 'row', 'min' => 0, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tc_guide_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_tc_tab_results', 'label' => __('Results Sidebar', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tc_results_title', 'label' => __('Results Title', 'mlzs'), 'name' => 'tc_results_title', 'type' => 'text', 'default_value' => 'Search Results'),
            array('key' => 'field_tc_results_initial_heading', 'label' => __('Initial State Heading', 'mlzs'), 'name' => 'tc_results_initial_heading', 'type' => 'text', 'default_value' => 'Search Transfer Certificate'),
            array('key' => 'field_tc_results_initial_text', 'label' => __('Initial State Text', 'mlzs'), 'name' => 'tc_results_initial_text', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Enter the serial number to verify and view your Transfer Certificate details'),
            array('key' => 'field_tc_results_loading_heading', 'label' => __('Loading State Heading', 'mlzs'), 'name' => 'tc_results_loading_heading', 'type' => 'text', 'default_value' => 'Searching...'),
            array('key' => 'field_tc_results_loading_text', 'label' => __('Loading State Text', 'mlzs'), 'name' => 'tc_results_loading_text', 'type' => 'text', 'default_value' => 'Verifying your Transfer Certificate details'),
            array('key' => 'field_tc_results_error_heading', 'label' => __('Error State Heading', 'mlzs'), 'name' => 'tc_results_error_heading', 'type' => 'text', 'default_value' => 'Certificate Not Found'),
            array('key' => 'field_tc_results_error_text', 'label' => __('Error State Text', 'mlzs'), 'name' => 'tc_results_error_text', 'type' => 'text', 'default_value' => 'Please check the serial number and try again'),
            array('key' => 'field_tc_results_important_notes', 'label' => __('Important Notes (Success State)', 'mlzs'), 'name' => 'tc_results_important_notes', 'type' => 'repeater', 'layout' => 'row', 'min' => 0, 'button_label' => __('Add Note', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tc_note_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_tc_stats_total', 'label' => __('Stats: Total TCs Issued', 'mlzs'), 'name' => 'tc_stats_total', 'type' => 'text', 'default_value' => '2,500+'),
            array('key' => 'field_tc_stats_year', 'label' => __('Stats: This Year', 'mlzs'), 'name' => 'tc_stats_year', 'type' => 'text', 'default_value' => '450+'),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'transfer-certificate.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_transfer_certificate_field_group');
