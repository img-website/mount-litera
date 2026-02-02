<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Enquiry Page – Hero, Campus, Contact, Stats, Form heading/features, FAQ (all dynamic, icons dynamic)
 */
function mlzs_acf_enquiry_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_enquiry',
        'title'                 => __('Enquiry Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_enq_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_enq_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'enquiry_hero_badge', 'type' => 'text', 'default_value' => 'Get in Touch'),
            array('key' => 'field_enq_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'enquiry_hero_icon', 'type' => 'text', 'default_value' => 'message-square'),
            array('key' => 'field_enq_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'enquiry_hero_headline', 'type' => 'text', 'default_value' => 'Enquiry'),
            array('key' => 'field_enq_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'enquiry_hero_highlight', 'type' => 'text', 'default_value' => 'Form'),
            array('key' => 'field_enq_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'enquiry_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Let's start your child's educational journey. Share your details and we'll reach out to you."),
            array('key' => 'field_enq_tab_campus', 'label' => __('Campus Card', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_enq_campus_icon', 'label' => __('Card Icon', 'mlzs'), 'name' => 'enquiry_campus_icon', 'type' => 'text', 'default_value' => 'school'),
            array('key' => 'field_enq_campus_title', 'label' => __('Card Title', 'mlzs'), 'name' => 'enquiry_campus_title', 'type' => 'text', 'default_value' => 'Campus'),
            array('key' => 'field_enq_campus_address_heading', 'label' => __('Address Heading', 'mlzs'), 'name' => 'enquiry_campus_address_heading', 'type' => 'text', 'default_value' => 'Address'),
            array('key' => 'field_enq_campus_address', 'label' => __('Address (multiline)', 'mlzs'), 'name' => 'enquiry_campus_address', 'type' => 'textarea', 'rows' => 4),
            array('key' => 'field_enq_campus_map_url', 'label' => __('View on Map URL', 'mlzs'), 'name' => 'enquiry_campus_map_url', 'type' => 'url'),
            array('key' => 'field_enq_campus_map_text', 'label' => __('View on Map Button Text', 'mlzs'), 'name' => 'enquiry_campus_map_text', 'type' => 'text', 'default_value' => 'View on Map'),
            array('key' => 'field_enq_campus_map_icon', 'label' => __('Map Button Icon', 'mlzs'), 'name' => 'enquiry_campus_map_icon', 'type' => 'text', 'default_value' => 'navigation'),
            array('key' => 'field_enq_tab_contact', 'label' => __('Contact Card', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_enq_contact_icon', 'label' => __('Card Icon', 'mlzs'), 'name' => 'enquiry_contact_icon', 'type' => 'text', 'default_value' => 'phone'),
            array('key' => 'field_enq_contact_title', 'label' => __('Card Title', 'mlzs'), 'name' => 'enquiry_contact_title', 'type' => 'text', 'default_value' => 'Phone & E-mail'),
            array('key' => 'field_enq_contact_phone_label', 'label' => __('Phone Label', 'mlzs'), 'name' => 'enquiry_contact_phone_label', 'type' => 'text', 'default_value' => 'Admissions and Enquiry'),
            array('key' => 'field_enq_contact_phone_icon', 'label' => __('Phone Row Icon', 'mlzs'), 'name' => 'enquiry_contact_phone_icon', 'type' => 'text', 'default_value' => 'phone-call'),
            array('key' => 'field_enq_contact_phone_number', 'label' => __('Phone Number', 'mlzs'), 'name' => 'enquiry_contact_phone_number', 'type' => 'text'),
            array('key' => 'field_enq_contact_email_label', 'label' => __('Email Label', 'mlzs'), 'name' => 'enquiry_contact_email_label', 'type' => 'text', 'default_value' => 'Email Address'),
            array('key' => 'field_enq_contact_email_icon', 'label' => __('Email Row Icon', 'mlzs'), 'name' => 'enquiry_contact_email_icon', 'type' => 'text', 'default_value' => 'mail'),
            array('key' => 'field_enq_contact_emails', 'label' => __('Email Addresses (one per line)', 'mlzs'), 'name' => 'enquiry_contact_emails', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_enq_contact_call_text', 'label' => __('Call Button Text', 'mlzs'), 'name' => 'enquiry_contact_call_text', 'type' => 'text', 'default_value' => 'Call Now'),
            array('key' => 'field_enq_contact_call_icon', 'label' => __('Call Button Icon', 'mlzs'), 'name' => 'enquiry_contact_call_icon', 'type' => 'text', 'default_value' => 'phone'),
            array('key' => 'field_enq_contact_email_btn_text', 'label' => __('Email Button Text', 'mlzs'), 'name' => 'enquiry_contact_email_btn_text', 'type' => 'text', 'default_value' => 'Send Email'),
            array('key' => 'field_enq_contact_email_btn_icon', 'label' => __('Email Button Icon', 'mlzs'), 'name' => 'enquiry_contact_email_btn_icon', 'type' => 'text', 'default_value' => 'mail'),
            array('key' => 'field_enq_tab_stats', 'label' => __('Quick Stats', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_enq_stat1_number', 'label' => __('Stat 1 Number', 'mlzs'), 'name' => 'enquiry_stat1_number', 'type' => 'text', 'default_value' => '24/7'),
            array('key' => 'field_enq_stat1_label', 'label' => __('Stat 1 Label', 'mlzs'), 'name' => 'enquiry_stat1_label', 'type' => 'text', 'default_value' => 'Support Available'),
            array('key' => 'field_enq_stat2_number', 'label' => __('Stat 2 Number', 'mlzs'), 'name' => 'enquiry_stat2_number', 'type' => 'text', 'default_value' => '2 Hours'),
            array('key' => 'field_enq_stat2_label', 'label' => __('Stat 2 Label', 'mlzs'), 'name' => 'enquiry_stat2_label', 'type' => 'text', 'default_value' => 'Response Time'),
            array('key' => 'field_enq_tab_form', 'label' => __('Form Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_enq_form_icon', 'label' => __('Form Card Icon', 'mlzs'), 'name' => 'enquiry_form_icon', 'type' => 'text', 'default_value' => 'user-plus'),
            array('key' => 'field_enq_form_title', 'label' => __('Form Title', 'mlzs'), 'name' => 'enquiry_form_title', 'type' => 'text', 'default_value' => 'Submit Enquiry'),
            array('key' => 'field_enq_form_subtitle', 'label' => __('Form Subtitle', 'mlzs'), 'name' => 'enquiry_form_subtitle', 'type' => 'text', 'default_value' => "We'll contact you within 24 hours"),
            array('key' => 'field_enq_form_privacy_text', 'label' => __('Privacy Text', 'mlzs'), 'name' => 'enquiry_form_privacy_text', 'type' => 'text', 'default_value' => 'By submitting, you agree to our'),
            array('key' => 'field_enq_form_privacy_link', 'label' => __('Privacy Policy Link', 'mlzs'), 'name' => 'enquiry_form_privacy_link', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_enq_form_submit_text', 'label' => __('Submit Button Text', 'mlzs'), 'name' => 'enquiry_form_submit_text', 'type' => 'text', 'default_value' => 'Submit Enquiry'),
            array('key' => 'field_enq_form_submit_icon', 'label' => __('Submit Button Icon', 'mlzs'), 'name' => 'enquiry_form_submit_icon', 'type' => 'text', 'default_value' => 'send'),
            array('key' => 'field_enq_form_features', 'label' => __('Form Features (3 items: icon + label)', 'mlzs'), 'name' => 'enquiry_form_features', 'type' => 'repeater', 'min' => 3, 'max' => 3, 'layout' => 'table', 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_enq_form_feature_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'shield-check'),
                array('key' => 'field_enq_form_feature_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
            array('key' => 'field_enq_tab_faq', 'label' => __('FAQ Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_enq_faq_heading', 'label' => __('FAQ Heading', 'mlzs'), 'name' => 'enquiry_faq_heading', 'type' => 'text', 'default_value' => 'Frequently Asked Questions'),
            array('key' => 'field_enq_faq_subtext', 'label' => __('FAQ Subtext', 'mlzs'), 'name' => 'enquiry_faq_subtext', 'type' => 'text', 'default_value' => 'Quick answers to common queries'),
            array('key' => 'field_enq_faq_items', 'label' => __('FAQ Items (icon + question + answer)', 'mlzs'), 'name' => 'enquiry_faq_items', 'type' => 'repeater', 'layout' => 'block', 'button_label' => __('Add FAQ', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_enq_faq_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'help-circle'),
                array('key' => 'field_enq_faq_question', 'label' => __('Question', 'mlzs'), 'name' => 'question', 'type' => 'text'),
                array('key' => 'field_enq_faq_answer', 'label' => __('Answer', 'mlzs'), 'name' => 'answer', 'type' => 'textarea', 'rows' => 2),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'enquiry.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_enquiry_field_group');
