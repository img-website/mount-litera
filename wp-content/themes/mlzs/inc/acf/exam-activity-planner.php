<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Exam Activity Planner Page – Hero, Exam blocks (III–V, VI–VIII, IX–XII), Activity tabs, Legend
 */
function mlzs_acf_exam_activity_planner_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_exam_activity_planner',
        'title'                 => __('Exam Activity Planner Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_eap_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_eap_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'eap_hero_badge', 'type' => 'text', 'default_value' => 'Academic Year 2025-2026'),
            array('key' => 'field_eap_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'eap_hero_icon', 'type' => 'text', 'default_value' => 'calendar-days'),
            array('key' => 'field_eap_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'eap_hero_headline', 'type' => 'text', 'default_value' => 'Exam & Activity'),
            array('key' => 'field_eap_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'eap_hero_highlight', 'type' => 'text', 'default_value' => 'Planner'),
            array('key' => 'field_eap_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'eap_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Comprehensive schedule for Half Yearly Examinations and Annual Activities at Mount Litera Zee School, Alwar. Stay updated with all academic and co-curricular events."),
            array('key' => 'field_eap_hero_btn1_label', 'label' => __('Button 1 Label', 'mlzs'), 'name' => 'eap_hero_btn1_label', 'type' => 'text', 'default_value' => 'Exam Schedule'),
            array('key' => 'field_eap_hero_btn1_link', 'label' => __('Button 1 Link (anchor)', 'mlzs'), 'name' => 'eap_hero_btn1_link', 'type' => 'text', 'default_value' => '#exam-planner'),
            array('key' => 'field_eap_hero_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'eap_hero_btn1_icon', 'type' => 'text', 'default_value' => 'book-open'),
            array('key' => 'field_eap_hero_btn2_label', 'label' => __('Button 2 Label', 'mlzs'), 'name' => 'eap_hero_btn2_label', 'type' => 'text', 'default_value' => 'Activity Planner'),
            array('key' => 'field_eap_hero_btn2_link', 'label' => __('Button 2 Link (anchor)', 'mlzs'), 'name' => 'eap_hero_btn2_link', 'type' => 'text', 'default_value' => '#activity-planner'),
            array('key' => 'field_eap_hero_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'eap_hero_btn2_icon', 'type' => 'text', 'default_value' => 'calendar'),
            array('key' => 'field_eap_tab_exam', 'label' => __('Exam Planner Blocks', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_eap_exam_blocks', 'label' => __('Exam Sections (Grades III–V, VI–VIII, IX–XII)', 'mlzs'), 'name' => 'eap_exam_blocks', 'type' => 'repeater', 'layout' => 'block', 'button_label' => __('Add Exam Section', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_eap_block_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'book-open'),
                array('key' => 'field_eap_block_title', 'label' => __('Section Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Half Yearly Exam - 2025-2026'),
                array('key' => 'field_eap_block_subtitle', 'label' => __('Section Subtitle (e.g. Grades: III to V)', 'mlzs'), 'name' => 'subtitle', 'type' => 'text', 'default_value' => 'Grades: III to V'),
                array('key' => 'field_eap_block_icon_style', 'label' => __('Icon box color', 'mlzs'), 'name' => 'icon_style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'primary-dark' => 'Primary Dark'), 'default_value' => 'primary'),
                array('key' => 'field_eap_verbal_heading', 'label' => __('Verbal Assessment Heading', 'mlzs'), 'name' => 'verbal_heading', 'type' => 'text', 'default_value' => 'Verbal Assessment Schedule'),
                array('key' => 'field_eap_verbal_note', 'label' => __('Verbal Note (below table)', 'mlzs'), 'name' => 'verbal_note', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_eap_verbal_note_icon', 'label' => __('Verbal Note Icon', 'mlzs'), 'name' => 'verbal_note_icon', 'type' => 'text', 'default_value' => 'info'),
                array('key' => 'field_eap_verbal_note_style', 'label' => __('Verbal note box style', 'mlzs'), 'name' => 'verbal_note_style', 'type' => 'select', 'choices' => array('blue' => 'Blue', 'amber' => 'Amber'), 'default_value' => 'blue'),
                array('key' => 'field_eap_verbal_rows', 'label' => __('Verbal Table Rows', 'mlzs'), 'name' => 'verbal_rows', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Row', 'mlzs'), 'sub_fields' => array(
                    array('key' => 'field_eap_vr_date', 'label' => __('Date', 'mlzs'), 'name' => 'date', 'type' => 'text'),
                    array('key' => 'field_eap_vr_day', 'label' => __('Day', 'mlzs'), 'name' => 'day', 'type' => 'text'),
                    array('key' => 'field_eap_vr_subject', 'label' => __('Subject', 'mlzs'), 'name' => 'subject', 'type' => 'text'),
                )),
                array('key' => 'field_eap_written_heading', 'label' => __('Written Assessment Heading', 'mlzs'), 'name' => 'written_heading', 'type' => 'text', 'default_value' => 'Written Assessment Schedule'),
                array('key' => 'field_eap_written_note', 'label' => __('Written Note (below table)', 'mlzs'), 'name' => 'written_note', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_eap_written_note_icon', 'label' => __('Written Note Icon', 'mlzs'), 'name' => 'written_note_icon', 'type' => 'text', 'default_value' => 'alert-circle'),
                array('key' => 'field_eap_written_note_style', 'label' => __('Written note box style', 'mlzs'), 'name' => 'written_note_style', 'type' => 'select', 'choices' => array('blue' => 'Blue', 'amber' => 'Amber'), 'default_value' => 'amber'),
                array('key' => 'field_eap_written_header_labels', 'label' => __('Written Table Column Headers (one per line, after Date)', 'mlzs'), 'name' => 'written_header_labels', 'type' => 'textarea', 'rows' => 3, 'instructions' => __('e.g. Grade III, Grade IV, Grade V', 'mlzs')),
                array('key' => 'field_eap_written_rows', 'label' => __('Written Table Rows', 'mlzs'), 'name' => 'written_rows', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Row', 'mlzs'), 'sub_fields' => array(
                    array('key' => 'field_eap_wr_date', 'label' => __('Date', 'mlzs'), 'name' => 'date', 'type' => 'text'),
                    array('key' => 'field_eap_wr_col1', 'label' => __('Col 1', 'mlzs'), 'name' => 'col1', 'type' => 'textarea', 'rows' => 1),
                    array('key' => 'field_eap_wr_col2', 'label' => __('Col 2', 'mlzs'), 'name' => 'col2', 'type' => 'textarea', 'rows' => 1),
                    array('key' => 'field_eap_wr_col3', 'label' => __('Col 3', 'mlzs'), 'name' => 'col3', 'type' => 'textarea', 'rows' => 1),
                    array('key' => 'field_eap_wr_col4', 'label' => __('Col 4', 'mlzs'), 'name' => 'col4', 'type' => 'textarea', 'rows' => 1),
                    array('key' => 'field_eap_wr_col5', 'label' => __('Col 5', 'mlzs'), 'name' => 'col5', 'type' => 'textarea', 'rows' => 1),
                )),
            )),
            array('key' => 'field_eap_tab_activity', 'label' => __('Activity Planner', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_eap_activity_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'eap_activity_icon', 'type' => 'text', 'default_value' => 'calendar'),
            array('key' => 'field_eap_activity_title', 'label' => __('Section Title', 'mlzs'), 'name' => 'eap_activity_title', 'type' => 'text', 'default_value' => 'Activity Planner 2025-2026'),
            array('key' => 'field_eap_activity_subtitle', 'label' => __('Section Subtitle', 'mlzs'), 'name' => 'eap_activity_subtitle', 'type' => 'text', 'default_value' => 'Annual Schedule of Events and Activities'),
            array('key' => 'field_eap_activity_tabs', 'label' => __('Month Tabs & Tables', 'mlzs'), 'name' => 'eap_activity_tabs', 'type' => 'repeater', 'layout' => 'block', 'button_label' => __('Add Tab', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_eap_atab_label', 'label' => __('Tab Label', 'mlzs'), 'name' => 'tab_label', 'type' => 'text', 'placeholder' => 'e.g. APRIL - OCTOBER'),
                array('key' => 'field_eap_atab_slug', 'label' => __('Tab Slug (no spaces)', 'mlzs'), 'name' => 'tab_slug', 'type' => 'text', 'placeholder' => 'apr-oct'),
                array('key' => 'field_eap_atab_month1', 'label' => __('Month 1 Header', 'mlzs'), 'name' => 'month1_heading', 'type' => 'text', 'placeholder' => 'APRIL'),
                array('key' => 'field_eap_atab_month2', 'label' => __('Month 2 Header', 'mlzs'), 'name' => 'month2_heading', 'type' => 'text', 'placeholder' => 'OCTOBER'),
                array('key' => 'field_eap_atab_rows', 'label' => __('Table Rows', 'mlzs'), 'name' => 'table_rows', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Row', 'mlzs'), 'sub_fields' => array(
                    array('key' => 'field_eap_atab_date1', 'label' => __('Date 1', 'mlzs'), 'name' => 'date1', 'type' => 'text'),
                    array('key' => 'field_eap_atab_desc1', 'label' => __('Description 1', 'mlzs'), 'name' => 'desc1', 'type' => 'textarea', 'rows' => 1),
                    array('key' => 'field_eap_atab_date2', 'label' => __('Date 2', 'mlzs'), 'name' => 'date2', 'type' => 'text'),
                    array('key' => 'field_eap_atab_desc2', 'label' => __('Description 2', 'mlzs'), 'name' => 'desc2', 'type' => 'textarea', 'rows' => 1),
                )),
            )),
            array('key' => 'field_eap_tab_legend', 'label' => __('Legend', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_eap_legend_items', 'label' => __('Legend Items', 'mlzs'), 'name' => 'eap_legend_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_eap_legend_abbrev', 'label' => __('Abbreviation', 'mlzs'), 'name' => 'abbrev', 'type' => 'text'),
                array('key' => 'field_eap_legend_full', 'label' => __('Full Text', 'mlzs'), 'name' => 'full_text', 'type' => 'text'),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'exam-activity-planner.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_exam_activity_planner_field_group');
