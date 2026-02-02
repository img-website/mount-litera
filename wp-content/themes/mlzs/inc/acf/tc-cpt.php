<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Transfer Certificate CPT – TC Details fields (Student Name, Class, Issue Date, Valid Until)
 */
function mlzs_acf_tc_cpt_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_tc_details',
        'title'                 => __('TC Details (optional)', 'mlzs'),
        'fields'                => array(
            array(
                'key' => 'field_tc_student_name',
                'label' => __('Student Name', 'mlzs'),
                'name' => 'tc_student_name',
                'type' => 'text',
                'instructions' => __('Shown on frontend when TC is found.', 'mlzs'),
            ),
            array(
                'key' => 'field_tc_class',
                'label' => __('Class', 'mlzs'),
                'name' => 'tc_class',
                'type' => 'text',
            ),
            array(
                'key' => 'field_tc_issue_date',
                'label' => __('Issue Date', 'mlzs'),
                'name' => 'tc_issue_date',
                'type' => 'date_picker',
                'display_format' => 'd-m-Y',
                'return_format' => 'd-m-Y',
                'first_day' => 1,
            ),
            array(
                'key' => 'field_tc_valid_until',
                'label' => __('Valid Until', 'mlzs'),
                'name' => 'tc_valid_until',
                'type' => 'date_picker',
                'display_format' => 'd-m-Y',
                'return_format' => 'd-m-Y',
                'first_day' => 1,
            ),
        ),
        'location' => array(
            array(array('param' => 'post_type', 'operator' => '==', 'value' => 'mlzs_tc')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_tc_cpt_field_group');
