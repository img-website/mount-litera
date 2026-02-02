<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF: Registration Form Page – Hero, Logos, Note, Payment, Undertaking
 */
function mlzs_acf_form_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'   => 'group_mlzs_form',
        'title' => __('Registration Form Page', 'mlzs'),
        'fields' => array(
            array('key' => 'field_reg_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_reg_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'reg_hero_badge', 'type' => 'text', 'default_value' => 'Registration Form'),
            array('key' => 'field_reg_hero_icon', 'label' => __('Badge Icon (Lucide)', 'mlzs'), 'name' => 'reg_hero_icon', 'type' => 'text', 'default_value' => 'file-text'),
            array('key' => 'field_reg_hero_headline', 'label' => __('Headline', 'mlzs'), 'name' => 'reg_hero_headline', 'type' => 'text', 'default_value' => 'Student Registration'),
            array('key' => 'field_reg_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'reg_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Complete the registration form to begin your journey with Mount Litera Zee School. Fill in all required details accurately.'),
            array('key' => 'field_reg_tab_logos', 'label' => __('Form Header', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_reg_logo_mount', 'label' => __('Mount Litera Logo', 'mlzs'), 'name' => 'reg_logo_mount_litera', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_reg_logo_school', 'label' => __('School Logo', 'mlzs'), 'name' => 'reg_logo_school', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_reg_tab_note', 'label' => __('Note Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_reg_note_title', 'label' => __('Note Title', 'mlzs'), 'name' => 'reg_note_title', 'type' => 'text', 'default_value' => 'Note'),
            array('key' => 'field_reg_note_content', 'label' => __('Note Content', 'mlzs'), 'name' => 'reg_note_content', 'type' => 'textarea', 'rows' => 8),
            array('key' => 'field_reg_tab_pay', 'label' => __('Payment Details', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_reg_pay_title', 'label' => __('Payment Section Title', 'mlzs'), 'name' => 'reg_pay_title', 'type' => 'text', 'default_value' => 'Payment Related Details'),
            array('key' => 'field_reg_pay_amount', 'label' => __('Registration Fee Amount', 'mlzs'), 'name' => 'reg_pay_amount', 'type' => 'text', 'default_value' => '₹500'),
            array('key' => 'field_reg_pay_bank_name', 'label' => __('Bank Account Name', 'mlzs'), 'name' => 'reg_pay_bank_name', 'type' => 'text', 'default_value' => 'Mount Litera Zee School'),
            array('key' => 'field_reg_pay_acc_no', 'label' => __('Account Number', 'mlzs'), 'name' => 'reg_pay_acc_no', 'type' => 'text', 'default_value' => '011490300000097'),
            array('key' => 'field_reg_pay_ifsc', 'label' => __('IFSC Code', 'mlzs'), 'name' => 'reg_pay_ifsc', 'type' => 'text', 'default_value' => 'YESB0000114'),
            array('key' => 'field_reg_pay_bank_logo', 'label' => __('Bank Logo Image', 'mlzs'), 'name' => 'reg_pay_bank_logo', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_reg_pay_phone', 'label' => __('Contact Phone', 'mlzs'), 'name' => 'reg_pay_phone', 'type' => 'text', 'default_value' => '7665000317 / 9672797979'),
            array('key' => 'field_reg_pay_whatsapp', 'label' => __('WhatsApp Number', 'mlzs'), 'name' => 'reg_pay_whatsapp', 'type' => 'text', 'default_value' => '7665000317'),
            array('key' => 'field_reg_pay_email', 'label' => __('Payment Contact Email', 'mlzs'), 'name' => 'reg_pay_email', 'type' => 'text', 'default_value' => 'zeeschool.alw2k@gmail.com'),
            array('key' => 'field_reg_tab_undertaking', 'label' => __('Undertaking', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_reg_undertaking_text', 'label' => __('Undertaking Text', 'mlzs'), 'name' => 'reg_undertaking_text', 'type' => 'textarea', 'rows' => 5),
            array('key' => 'field_reg_form_submit', 'label' => __('Submit Button Text', 'mlzs'), 'name' => 'reg_form_submit_text', 'type' => 'text', 'default_value' => 'Submit Registration Form'),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'form.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_form_field_group');
