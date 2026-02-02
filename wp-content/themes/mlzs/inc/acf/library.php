<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Library Page – Hero, Overview, Features (6), Gallery (3), CTA (buttons = Link field)
 * Note: Image alt = use attachment alt from Media Library (upload time); do not add separate ACF alt field.
 */
function mlzs_acf_library_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_library',
        'title'                 => __('Library Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_lib_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lib_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'library_hero_badge', 'type' => 'text', 'default_value' => 'Campus Facilities'),
            array('key' => 'field_lib_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'library_hero_icon', 'type' => 'text', 'default_value' => 'book-open'),
            array('key' => 'field_lib_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'library_hero_headline', 'type' => 'text', 'default_value' => 'School'),
            array('key' => 'field_lib_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'library_hero_highlight', 'type' => 'text', 'default_value' => 'Library'),
            array('key' => 'field_lib_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'library_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'A 1000 SQ FT learning resource center fostering lifelong learning abilities and nurturing the love for reading'),
            array('key' => 'field_lib_tab_overview', 'label' => __('Library Overview', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lib_overview_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'library_overview_badge', 'type' => 'text', 'default_value' => 'Learning Resource Center'),
            array('key' => 'field_lib_overview_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'library_overview_heading', 'type' => 'text', 'default_value' => 'More Than Just Books'),
            array('key' => 'field_lib_overview_para1', 'label' => __('Paragraph 1', 'mlzs'), 'name' => 'library_overview_para1', 'type' => 'textarea', 'rows' => 4, 'default_value' => 'The 1000 SQ FT school library is a learning resource center in the widest sense as it houses information resources, expansive reading material, and digital data with internet access. The school library fosters the development of life-long learning abilities and inculcates love for reading in students.'),
            array('key' => 'field_lib_overview_para2', 'label' => __('Paragraph 2', 'mlzs'), 'name' => 'library_overview_para2', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'It also provides teachers with instructional material and professional resources, creating a comprehensive ecosystem for academic excellence.'),
            array('key' => 'field_lib_overview_image', 'label' => __('Right Image', 'mlzs'), 'name' => 'library_overview_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_lib_overview_stat_number', 'label' => __('Stat Box Number', 'mlzs'), 'name' => 'library_overview_stat_number', 'type' => 'text', 'default_value' => '1000'),
            array('key' => 'field_lib_overview_stat_label', 'label' => __('Stat Box Label', 'mlzs'), 'name' => 'library_overview_stat_label', 'type' => 'text', 'default_value' => 'SQ FT Area'),
            array('key' => 'field_lib_tab_features', 'label' => __('Salient Features (6)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lib_features_heading', 'label' => __('Section Heading (before highlight)', 'mlzs'), 'name' => 'library_features_heading', 'type' => 'text', 'default_value' => 'Salient'),
            array('key' => 'field_lib_features_highlight', 'label' => __('Section Heading (highlighted)', 'mlzs'), 'name' => 'library_features_highlight', 'type' => 'text', 'default_value' => 'Features'),
            array('key' => 'field_lib_features_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'library_features_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Our library is equipped with state-of-the-art facilities to enhance the learning experience'),
            array('key' => 'field_lib_features_items', 'label' => __('Feature Cards (6)', 'mlzs'), 'name' => 'library_features_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 6, 'max' => 6, 'button_label' => __('Add Feature', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_lib_feat_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'monitor'),
                array('key' => 'field_lib_feat_style', 'label' => __('Hover Border Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
                array('key' => 'field_lib_feat_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'E-Library Facility'),
                array('key' => 'field_lib_feat_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_lib_tab_gallery', 'label' => __('Library Gallery (3)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lib_gallery_heading', 'label' => __('Section Heading (before highlight)', 'mlzs'), 'name' => 'library_gallery_heading', 'type' => 'text', 'default_value' => 'Library'),
            array('key' => 'field_lib_gallery_highlight', 'label' => __('Section Heading (highlighted)', 'mlzs'), 'name' => 'library_gallery_highlight', 'type' => 'text', 'default_value' => 'Gallery'),
            array('key' => 'field_lib_gallery_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'library_gallery_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Explore our well-equipped library spaces designed for different age groups'),
            array('key' => 'field_lib_gallery_items', 'label' => __('Gallery Images (3)', 'mlzs'), 'name' => 'library_gallery_items', 'type' => 'repeater', 'layout' => 'row', 'min' => 3, 'max' => 3, 'button_label' => __('Add Image', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_lib_gallery_image', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array'),
            )),
            array('key' => 'field_lib_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lib_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'library_cta_heading', 'type' => 'text', 'default_value' => 'Visit Our Library'),
            array('key' => 'field_lib_cta_para', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'library_cta_para', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Experience our state-of-the-art library facilities firsthand. Schedule a visit to explore how we foster love for reading and research among our students.'),
            array('key' => 'field_lib_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'library_cta_btn1_icon', 'type' => 'text', 'default_value' => 'calendar'),
            array('key' => 'field_lib_cta_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'library_cta_btn1_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link popup mein "Link Text" = button label (e.g. Schedule Library Tour).', 'mlzs')),
            array('key' => 'field_lib_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'library_cta_btn2_icon', 'type' => 'text', 'default_value' => 'book-open'),
            array('key' => 'field_lib_cta_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'library_cta_btn2_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link popup mein "Link Text" = button label (e.g. View Reading List).', 'mlzs')),
            array('key' => 'field_lib_cta_stats', 'label' => __('CTA Stat Boxes (4)', 'mlzs'), 'name' => 'library_cta_stats', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_lib_cta_stat_number', 'label' => __('Number/Text', 'mlzs'), 'name' => 'number', 'type' => 'text', 'default_value' => '5000+'),
                array('key' => 'field_lib_cta_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Books Collection'),
                array('key' => 'field_lib_cta_stat_color', 'label' => __('Text Color', 'mlzs'), 'name' => 'color', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light', 'accent-dark' => 'Accent Dark'), 'default_value' => 'primary'),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'library.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_library_field_group');
