<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Teaching Staff Page – Hero (stats 3, buttons), Table (staff: name, subject, designation), Department cards (3), CTA
 */
function mlzs_acf_teaching_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_teaching',
        'title'                 => __('Teaching Staff Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_tch_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tch_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'teaching_hero_badge', 'type' => 'text', 'default_value' => 'Our Educators'),
            array('key' => 'field_tch_hero_headline_before', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'teaching_hero_headline_before', 'type' => 'text', 'default_value' => 'Meet Our'),
            array('key' => 'field_tch_hero_headline_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'teaching_hero_headline_highlight', 'type' => 'text', 'default_value' => 'Teaching Staff'),
            array('key' => 'field_tch_hero_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'teaching_hero_paragraph', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Our dedicated team of educators brings passion, expertise, and innovation to the classroom every day. Meet the professionals who are shaping the future leaders of tomorrow.'),
            array('key' => 'field_tch_hero_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'teaching_hero_btn1_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. View All Staff).', 'mlzs')),
            array('key' => 'field_tch_hero_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'teaching_hero_btn1_icon', 'type' => 'text', 'default_value' => 'arrow-down'),
            array('key' => 'field_tch_hero_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'teaching_hero_btn2_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Search Staff).', 'mlzs')),
            array('key' => 'field_tch_hero_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'teaching_hero_btn2_icon', 'type' => 'text', 'default_value' => 'search'),
            array('key' => 'field_tch_hero_stats', 'label' => __('Hero Stat Cards (3)', 'mlzs'), 'name' => 'teaching_hero_stats', 'type' => 'repeater', 'layout' => 'row', 'min' => 3, 'max' => 3, 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tch_stat_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'users'),
                array('key' => 'field_tch_stat_number', 'label' => __('Number/Text', 'mlzs'), 'name' => 'number', 'type' => 'text', 'default_value' => '70+'),
                array('key' => 'field_tch_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Teaching Professionals'),
            )),
            array('key' => 'field_tch_tab_table', 'label' => __('Staff Table', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tch_search_placeholder', 'label' => __('Search Input Placeholder', 'mlzs'), 'name' => 'teaching_search_placeholder', 'type' => 'text', 'default_value' => 'Search...'),
            array('key' => 'field_tch_table_heading', 'label' => __('Section Heading', 'mlzs'), 'name' => 'teaching_table_heading', 'type' => 'text', 'default_value' => 'Teaching Staff Directory'),
            array('key' => 'field_tch_table_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'teaching_table_subtext', 'type' => 'text', 'default_value' => 'Complete list of our teaching faculty with their subjects and designations'),
            array('key' => 'field_tch_table_stat_total_label', 'label' => __('Stat: Total Staff Label', 'mlzs'), 'name' => 'teaching_table_stat_total_label', 'type' => 'text', 'default_value' => 'Total Staff', 'instructions' => __('Numbers are auto-calculated from staff table.', 'mlzs')),
            array('key' => 'field_tch_table_stat_pgt_label', 'label' => __('Stat: PGT Teachers Label', 'mlzs'), 'name' => 'teaching_table_stat_pgt_label', 'type' => 'text', 'default_value' => 'PGT Teachers'),
            array('key' => 'field_tch_table_stat_subjects_label', 'label' => __('Stat: Subjects Label', 'mlzs'), 'name' => 'teaching_table_stat_subjects_label', 'type' => 'text', 'default_value' => 'Subjects'),
            array('key' => 'field_tch_table_stat_coaches_label', 'label' => __('Stat: Coaches Label', 'mlzs'), 'name' => 'teaching_table_stat_coaches_label', 'type' => 'text', 'default_value' => 'Coaches'),
            array('key' => 'field_tch_staff_rows', 'label' => __('Staff Rows', 'mlzs'), 'name' => 'teaching_staff_rows', 'type' => 'repeater', 'layout' => 'table', 'min' => 0, 'button_label' => __('Add Staff', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tch_staff_name', 'label' => __('Name', 'mlzs'), 'name' => 'name', 'type' => 'text'),
                array('key' => 'field_tch_staff_subject', 'label' => __('Subject', 'mlzs'), 'name' => 'subject', 'type' => 'text'),
                array('key' => 'field_tch_staff_designation', 'label' => __('Designation', 'mlzs'), 'name' => 'designation', 'type' => 'text', 'instructions' => __('e.g. PGT, TGT, PBT, Coach, Music Teacher', 'mlzs')),
            )),
            array('key' => 'field_tch_tab_dept', 'label' => __('Department Cards', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tch_dept_heading', 'label' => __('Section Heading', 'mlzs'), 'name' => 'teaching_dept_heading', 'type' => 'text', 'default_value' => 'Department Overview'),
            array('key' => 'field_tch_dept_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'teaching_dept_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Our teaching staff is organized into specialized departments to ensure comprehensive coverage of all subjects and activities'),
            array('key' => 'field_tch_dept_cards', 'label' => __('Department Cards (3)', 'mlzs'), 'name' => 'teaching_dept_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tch_dept_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'book-open'),
                array('key' => 'field_tch_dept_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Academic Faculty'),
                array('key' => 'field_tch_dept_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'subtitle', 'type' => 'text', 'default_value' => 'Core Subjects'),
                array('key' => 'field_tch_dept_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 3),
                array('key' => 'field_tch_dept_count_label', 'label' => __('Count Label', 'mlzs'), 'name' => 'count_label', 'type' => 'text', 'default_value' => '45+ Teachers'),
                array('key' => 'field_tch_dept_badge_text', 'label' => __('Badge Text', 'mlzs'), 'name' => 'badge_text', 'type' => 'text', 'default_value' => 'Core'),
                array('key' => 'field_tch_dept_color', 'label' => __('Card Color', 'mlzs'), 'name' => 'color', 'type' => 'select', 'choices' => array('primary' => 'Primary (#3D348B)', 'accent' => 'Accent (#F7B801)', 'cayenne' => 'Cayenne (#F35B04)'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_tch_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tch_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'teaching_cta_heading', 'type' => 'text', 'default_value' => 'Join Our Teaching Team'),
            array('key' => 'field_tch_cta_paragraph', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'teaching_cta_paragraph', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Are you passionate about education and want to make a difference? We\'re always looking for talented educators to join our team.'),
            array('key' => 'field_tch_cta_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'teaching_cta_btn1_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. View Open Positions).', 'mlzs')),
            array('key' => 'field_tch_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'teaching_cta_btn1_icon', 'type' => 'text', 'default_value' => 'arrow-right'),
            array('key' => 'field_tch_cta_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'teaching_cta_btn2_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Contact HR).', 'mlzs')),
            array('key' => 'field_tch_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'teaching_cta_btn2_icon', 'type' => 'text', 'default_value' => 'mail'),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'teaching.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_teaching_field_group');
