<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Fee Structure Page – Hero, Documents section header.
 * PDF list is pulled from CBSE Mandate page (fee category only).
 */
function mlzs_acf_fee_structure_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_fee_structure',
        'title'                 => __('Fee Structure Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_fs_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_fs_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'fs_hero_badge', 'type' => 'text', 'default_value' => 'Fee Information'),
            array('key' => 'field_fs_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'fs_hero_icon', 'type' => 'text', 'default_value' => 'file-text'),
            array('key' => 'field_fs_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'fs_hero_headline', 'type' => 'text', 'default_value' => 'Fee'),
            array('key' => 'field_fs_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'fs_hero_highlight', 'type' => 'text', 'default_value' => 'Structure'),
            array('key' => 'field_fs_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'fs_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'View and download fee structure PDFs for different classes. Data is managed from the CBSE Mandate page (Fee category).'),
            array('key' => 'field_fs_tab_section', 'label' => __('Documents Section Header', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_fs_section_badge', 'label' => __('Section Badge', 'mlzs'), 'name' => 'fs_section_badge', 'type' => 'text', 'default_value' => 'Fee PDFs'),
            array('key' => 'field_fs_section_icon', 'label' => __('Section Badge Icon', 'mlzs'), 'name' => 'fs_section_icon', 'type' => 'text', 'default_value' => 'file-text'),
            array('key' => 'field_fs_section_heading', 'label' => __('Section Heading (before highlight)', 'mlzs'), 'name' => 'fs_section_heading', 'type' => 'text', 'default_value' => 'Fee'),
            array('key' => 'field_fs_section_heading_highlight', 'label' => __('Section Heading (highlighted)', 'mlzs'), 'name' => 'fs_section_heading_highlight', 'type' => 'text', 'default_value' => 'Documents'),
            array('key' => 'field_fs_section_description', 'label' => __('Section Description', 'mlzs'), 'name' => 'fs_section_description', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Download fee structure PDFs for various classes. Add or edit these documents from the CBSE Mandate page under the Fee category.'),
        ),
        'location' => array(
            array(
                array('param' => 'page_template', 'operator' => '==', 'value' => 'fee-structure.php'),
            ),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_fee_structure_field_group');
