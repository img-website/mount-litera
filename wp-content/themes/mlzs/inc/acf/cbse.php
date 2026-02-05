<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: CBSE Mandate Page – Hero, Documents Section, Filters, Document Cards, Stats
 */
function mlzs_acf_cbse_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_cbse',
        'title'                 => __('CBSE Mandate Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_cbse_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_cbse_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'cbse_hero_badge', 'type' => 'text', 'default_value' => 'CBSE Compliance'),
            array('key' => 'field_cbse_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'cbse_hero_icon', 'type' => 'text', 'default_value' => 'shield-check'),
            array('key' => 'field_cbse_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'cbse_hero_headline', 'type' => 'text', 'default_value' => 'CBSE'),
            array('key' => 'field_cbse_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'cbse_hero_highlight', 'type' => 'text', 'default_value' => 'Mandate'),
            array('key' => 'field_cbse_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'cbse_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Essential documents, certificates, and academic planners for students, parents, and stakeholders'),
            array('key' => 'field_cbse_tab_section', 'label' => __('Documents Section Header', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_cbse_section_badge', 'label' => __('Section Badge', 'mlzs'), 'name' => 'cbse_section_badge', 'type' => 'text', 'default_value' => 'Important Documents'),
            array('key' => 'field_cbse_section_icon', 'label' => __('Section Badge Icon', 'mlzs'), 'name' => 'cbse_section_icon', 'type' => 'text', 'default_value' => 'folder-open'),
            array('key' => 'field_cbse_section_heading', 'label' => __('Section Heading (before highlight)', 'mlzs'), 'name' => 'cbse_section_heading', 'type' => 'text', 'default_value' => 'Related'),
            array('key' => 'field_cbse_section_heading_highlight', 'label' => __('Section Heading (highlighted)', 'mlzs'), 'name' => 'cbse_section_heading_highlight', 'type' => 'text', 'default_value' => 'Documents'),
            array('key' => 'field_cbse_section_description', 'label' => __('Section Description', 'mlzs'), 'name' => 'cbse_section_description', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_cbse_tab_filters', 'label' => __('Filter Buttons', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_cbse_filters', 'label' => __('Category Filters', 'mlzs'), 'name' => 'cbse_filters', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Filter', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_cbse_filter_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
                array('key' => 'field_cbse_filter_slug', 'label' => __('Slug (all, fee, certificate, result, safety)', 'mlzs'), 'name' => 'slug', 'type' => 'text', 'placeholder' => 'all'),
                array('key' => 'field_cbse_filter_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'folder'),
            )),
            array('key' => 'field_cbse_tab_documents', 'label' => __('Documents', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_cbse_documents', 'label' => __('Document Cards', 'mlzs'), 'name' => 'cbse_documents', 'type' => 'repeater', 'layout' => 'block', 'button_label' => __('Add Document', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_cbse_doc_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_cbse_doc_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'text'),
                array('key' => 'field_cbse_doc_pdf', 'label' => __('Upload PDF', 'mlzs'), 'name' => 'pdf_file', 'type' => 'file', 'return_format' => 'array', 'mime_types' => 'pdf', 'instructions' => __('Upload PDF document. If you add both PDF and URL, PDF will be used.', 'mlzs')),
                array('key' => 'field_cbse_doc_link', 'label' => __('Or paste URL (optional)', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Use if you do not upload a PDF (external link).', 'mlzs')),
                array('key' => 'field_cbse_doc_category', 'label' => __('Category (for filter)', 'mlzs'), 'name' => 'category', 'type' => 'select', 'choices' => array('fee' => 'Fee Structure', 'certificate' => 'Certificates', 'result' => 'Results', 'safety' => 'Safety & Compliance'), 'default_value' => 'certificate'),
                array('key' => 'field_cbse_doc_icon', 'label' => __('Corner Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'file-text'),
                array('key' => 'field_cbse_doc_button_text', 'label' => __('Button Text', 'mlzs'), 'name' => 'button_text', 'type' => 'text', 'default_value' => 'View Document'),
            )),
            array('key' => 'field_cbse_tab_stats', 'label' => __('Statistics', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_cbse_stats', 'label' => __('Stats (4 boxes)', 'mlzs'), 'name' => 'cbse_stats', 'type' => 'repeater', 'min' => 4, 'max' => 4, 'layout' => 'table', 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_cbse_stat_number', 'label' => __('Number', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                array('key' => 'field_cbse_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
        ),
        'location' => array(
            array(
                array('param' => 'page_template', 'operator' => '==', 'value' => 'cbse.php'),
            ),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_cbse_field_group');
