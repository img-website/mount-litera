<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Non-Teaching Staff Page – Hero (stats 3, buttons Link), Table (staff repeater), CTA (Link buttons)
 */
function mlzs_acf_nonteach_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_nonteach',
        'title'                 => __('Non-Teaching Staff Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_nt_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_nt_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'nonteach_hero_badge', 'type' => 'text', 'default_value' => 'Support Team'),
            array('key' => 'field_nt_hero_headline_before', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'nonteach_hero_headline_before', 'type' => 'text', 'default_value' => 'Meet Our'),
            array('key' => 'field_nt_hero_headline_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'nonteach_hero_headline_highlight', 'type' => 'text', 'default_value' => 'Non-Teaching Staff'),
            array('key' => 'field_nt_hero_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'nonteach_hero_paragraph', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Our dedicated administrative and support team ensures smooth operations and provides essential services to create a seamless learning environment for our students and educators.'),
            array('key' => 'field_nt_hero_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'nonteach_hero_btn1_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. View All Staff).', 'mlzs')),
            array('key' => 'field_nt_hero_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'nonteach_hero_btn1_icon', 'type' => 'text', 'default_value' => 'arrow-down'),
            array('key' => 'field_nt_hero_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'nonteach_hero_btn2_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Search Staff).', 'mlzs')),
            array('key' => 'field_nt_hero_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'nonteach_hero_btn2_icon', 'type' => 'text', 'default_value' => 'search'),
            array('key' => 'field_nt_hero_stats', 'label' => __('Hero Stat Cards (3)', 'mlzs'), 'name' => 'nonteach_hero_stats', 'type' => 'repeater', 'layout' => 'row', 'min' => 3, 'max' => 3, 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_nt_stat_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'users'),
                array('key' => 'field_nt_stat_number', 'label' => __('Number/Text', 'mlzs'), 'name' => 'number', 'type' => 'text', 'default_value' => '11'),
                array('key' => 'field_nt_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Support Staff'),
            )),
            array('key' => 'field_nt_tab_table', 'label' => __('Staff Table', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_nt_search_placeholder', 'label' => __('Search Input Placeholder', 'mlzs'), 'name' => 'nonteach_search_placeholder', 'type' => 'text', 'default_value' => 'Search...'),
            array('key' => 'field_nt_table_heading', 'label' => __('Section Heading', 'mlzs'), 'name' => 'nonteach_table_heading', 'type' => 'text', 'default_value' => 'Non-Teaching Staff Directory'),
            array('key' => 'field_nt_table_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'nonteach_table_subtext', 'type' => 'text', 'default_value' => 'Complete list of our administrative and support staff with their designations'),
            array('key' => 'field_nt_table_stat_total_label', 'label' => __('Stat: Total Staff Label', 'mlzs'), 'name' => 'nonteach_table_stat_total_label', 'type' => 'text', 'default_value' => 'Total Staff', 'instructions' => __('Numbers are auto-calculated from staff table.', 'mlzs')),
            array('key' => 'field_nt_table_stat_admin_label', 'label' => __('Stat: Administrative Label', 'mlzs'), 'name' => 'nonteach_table_stat_admin_label', 'type' => 'text', 'default_value' => 'Administrative'),
            array('key' => 'field_nt_table_stat_support_label', 'label' => __('Stat: Support Staff Label', 'mlzs'), 'name' => 'nonteach_table_stat_support_label', 'type' => 'text', 'default_value' => 'Support Staff'),
            array('key' => 'field_nt_staff_rows', 'label' => __('Staff Rows', 'mlzs'), 'name' => 'nonteach_staff_rows', 'type' => 'repeater', 'layout' => 'table', 'min' => 0, 'button_label' => __('Add Staff', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_nt_staff_name', 'label' => __('Name', 'mlzs'), 'name' => 'name', 'type' => 'text'),
                array('key' => 'field_nt_staff_designation', 'label' => __('Designation', 'mlzs'), 'name' => 'designation', 'type' => 'select', 'choices' => array(
                    'PRINCIPAL' => 'PRINCIPAL',
                    'Executive Head' => 'Executive Head',
                    'ADMIN INCHARGE' => 'ADMIN INCHARGE',
                    'IT-EXECUTIVE' => 'IT-EXECUTIVE',
                    'ACCOUNTANT' => 'ACCOUNTANT',
                    'TRANSPORT INCHARGE' => 'TRANSPORT INCHARGE',
                    'EXAMINATION CONTROLLER' => 'EXAMINATION CONTROLLER',
                    'COUNSELLOR' => 'COUNSELLOR',
                    'STORE INCHARGE' => 'STORE INCHARGE',
                    'IT EXEC.' => 'IT EXEC.',
                    'NURSING STAFF' => 'NURSING STAFF',
                ), 'default_value' => '', 'allow_null' => 0, 'return_format' => 'value'),
            )),
            array('key' => 'field_nt_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_nt_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'nonteach_cta_heading', 'type' => 'text', 'default_value' => 'Join Our Support Team'),
            array('key' => 'field_nt_cta_paragraph', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'nonteach_cta_paragraph', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Are you looking for an opportunity to contribute to education? We\'re always looking for dedicated professionals to join our administrative and support team.'),
            array('key' => 'field_nt_cta_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'nonteach_cta_btn1_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. View Open Positions).', 'mlzs')),
            array('key' => 'field_nt_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'nonteach_cta_btn1_icon', 'type' => 'text', 'default_value' => 'arrow-right'),
            array('key' => 'field_nt_cta_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'nonteach_cta_btn2_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Contact HR).', 'mlzs')),
            array('key' => 'field_nt_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'nonteach_cta_btn2_icon', 'type' => 'text', 'default_value' => 'mail'),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'nonteach.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_nonteach_field_group');
