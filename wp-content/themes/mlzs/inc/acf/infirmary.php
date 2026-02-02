<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Infirmary Page – Hero, Wellness Philosophy, Features, Hygiene, Gallery, CTA
 */
function mlzs_acf_infirmary_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_infirmary',
        'title'                 => __('Infirmary Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_inf_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_inf_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'infirmary_hero_badge', 'type' => 'text', 'default_value' => 'Health & Wellness'),
            array('key' => 'field_inf_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'infirmary_hero_icon', 'type' => 'text', 'default_value' => 'heart-pulse'),
            array('key' => 'field_inf_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'infirmary_hero_headline', 'type' => 'text', 'default_value' => 'School'),
            array('key' => 'field_inf_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'infirmary_hero_highlight', 'type' => 'text', 'default_value' => 'Infirmary'),
            array('key' => 'field_inf_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'infirmary_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Dedicated healthcare facility ensuring the well-being of every learner during school hours'),
            array('key' => 'field_inf_tab_wellness', 'label' => __('Wellness Philosophy', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_inf_wellness_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'infirmary_wellness_icon', 'type' => 'text', 'default_value' => 'heart'),
            array('key' => 'field_inf_wellness_heading', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'infirmary_wellness_heading', 'type' => 'text', 'default_value' => 'Our Commitment to'),
            array('key' => 'field_inf_wellness_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'infirmary_wellness_highlight', 'type' => 'text', 'default_value' => 'Well-being'),
            array('key' => 'field_inf_wellness_para1', 'label' => __('Paragraph 1', 'mlzs'), 'name' => 'infirmary_wellness_para1', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'At Mount Litera Zee School Alwar, the well-being of learners is of great importance to us. We provide direct nursing services to learners and staff members to maximize health and wellness in the school community.'),
            array('key' => 'field_inf_wellness_para2', 'label' => __('Paragraph 2', 'mlzs'), 'name' => 'infirmary_wellness_para2', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'We understand that as the children spend most of their time in school, we could be faced with emergencies pertaining to the health of our students. Minor injuries during sports and games or while performing experiments and even common fever are unavoidable parts of growing.'),
            array('key' => 'field_inf_wellness_image', 'label' => __('Right Image', 'mlzs'), 'name' => 'infirmary_wellness_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_inf_wellness_badge_title', 'label' => __('Image Badge Title', 'mlzs'), 'name' => 'infirmary_wellness_badge_title', 'type' => 'text', 'default_value' => 'Ready'),
            array('key' => 'field_inf_wellness_badge_subtitle', 'label' => __('Image Badge Subtitle', 'mlzs'), 'name' => 'infirmary_wellness_badge_subtitle', 'type' => 'text', 'default_value' => 'For Emergencies'),
            array('key' => 'field_inf_tab_features', 'label' => __('Infirmary Features', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_inf_features_heading', 'label' => __('Section Heading (before highlight)', 'mlzs'), 'name' => 'infirmary_features_heading', 'type' => 'text', 'default_value' => 'Fully Equipped'),
            array('key' => 'field_inf_features_highlight', 'label' => __('Section Heading (highlighted)', 'mlzs'), 'name' => 'infirmary_features_highlight', 'type' => 'text', 'default_value' => 'Infirmary'),
            array('key' => 'field_inf_features_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'infirmary_features_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Strategically located at the heart of the school premise to provide immediate medical attention'),
            array('key' => 'field_inf_features_center_icon', 'label' => __('Center Card Icon', 'mlzs'), 'name' => 'infirmary_features_center_icon', 'type' => 'text', 'default_value' => 'shield-check'),
            array('key' => 'field_inf_features_center_title', 'label' => __('Center Card Title', 'mlzs'), 'name' => 'infirmary_features_center_title', 'type' => 'text', 'default_value' => 'Emergency Preparedness'),
            array('key' => 'field_inf_features_center_para', 'label' => __('Center Card Paragraph', 'mlzs'), 'name' => 'infirmary_features_center_para', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'To meet these emergencies we have an Infirmary at the heart of the School premise. The school infirmary is equipped with the basic materials and facilities to address the health needs of learners while in school.'),
            array('key' => 'field_inf_features_checklist', 'label' => __('Center Card Checklist', 'mlzs'), 'name' => 'infirmary_features_checklist', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_inf_check_item', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'First Aid Supplies'),
                array('key' => 'field_inf_check_icon_style', 'label' => __('Icon Style', 'mlzs'), 'name' => 'icon_style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'accent' => 'Accent'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_inf_features_nurse_icon', 'label' => __('Qualified Nurse Card – Icon', 'mlzs'), 'name' => 'infirmary_features_nurse_icon', 'type' => 'text', 'default_value' => 'user-check'),
            array('key' => 'field_inf_features_nurse_title', 'label' => __('Qualified Nurse Card – Title', 'mlzs'), 'name' => 'infirmary_features_nurse_title', 'type' => 'text', 'default_value' => 'Qualified Nurse'),
            array('key' => 'field_inf_features_nurse_para', 'label' => __('Qualified Nurse Card – Paragraph', 'mlzs'), 'name' => 'infirmary_features_nurse_para', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'An on-site trained and qualified nurse is available to manage and assess any health issues that may arise during school hours.'),
            array('key' => 'field_inf_features_capacity_icon', 'label' => __('Capacity Card – Icon', 'mlzs'), 'name' => 'infirmary_features_capacity_icon', 'type' => 'text', 'default_value' => 'bed'),
            array('key' => 'field_inf_features_capacity_title', 'label' => __('Capacity Card – Title', 'mlzs'), 'name' => 'infirmary_features_capacity_title', 'type' => 'text', 'default_value' => 'Four-Bed Capacity'),
            array('key' => 'field_inf_features_capacity_para', 'label' => __('Capacity Card – Paragraph', 'mlzs'), 'name' => 'infirmary_features_capacity_para', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'With a four bed capacity, the infirmary provides ample space for students requiring medical attention and rest.'),
            array('key' => 'field_inf_tab_hygiene', 'label' => __('Hygiene & Wellness', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_inf_hygiene_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'infirmary_hygiene_icon', 'type' => 'text', 'default_value' => 'sparkles'),
            array('key' => 'field_inf_hygiene_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'infirmary_hygiene_heading', 'type' => 'text', 'default_value' => 'Hygienic Excellence'),
            array('key' => 'field_inf_hygiene_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'infirmary_hygiene_para', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'The infirmary is hygienically maintained confirming to our belief of wellness of mind, body and soul. We follow strict sanitation protocols to ensure a clean and safe environment for all students.'),
            array('key' => 'field_inf_hygiene_tags', 'label' => __('Tags (e.g. Daily Sanitization)', 'mlzs'), 'name' => 'infirmary_hygiene_tags', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Tag', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_inf_hygiene_tag_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Daily Sanitization'),
            )),
            array('key' => 'field_inf_hygiene_stats', 'label' => __('Stat Boxes (4)', 'mlzs'), 'name' => 'infirmary_hygiene_stats', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_inf_stat_number', 'label' => __('Number/Text', 'mlzs'), 'name' => 'number', 'type' => 'text', 'default_value' => '24/7'),
                array('key' => 'field_inf_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Medical Support'),
                array('key' => 'field_inf_stat_color', 'label' => __('Text Color', 'mlzs'), 'name' => 'color', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'accent' => 'Accent'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_inf_tab_gallery', 'label' => __('Medical Gallery', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_inf_gallery_heading', 'label' => __('Section Heading (before highlight)', 'mlzs'), 'name' => 'infirmary_gallery_heading', 'type' => 'text', 'default_value' => 'Infirmary'),
            array('key' => 'field_inf_gallery_highlight', 'label' => __('Section Heading (highlighted)', 'mlzs'), 'name' => 'infirmary_gallery_highlight', 'type' => 'text', 'default_value' => 'Facilities'),
            array('key' => 'field_inf_gallery_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'infirmary_gallery_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Modern medical facilities designed specifically for school healthcare needs'),
            array('key' => 'field_inf_gallery_items', 'label' => __('Gallery Items (2)', 'mlzs'), 'name' => 'infirmary_gallery_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 2, 'max' => 2, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_inf_gallery_image', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_inf_gallery_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Medical Equipment'),
                array('key' => 'field_inf_gallery_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'subtitle', 'type' => 'text', 'default_value' => 'Fully stocked with essential medical supplies'),
                array('key' => 'field_inf_gallery_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'badge', 'type' => 'text', 'default_value' => 'Equipment'),
                array('key' => 'field_inf_gallery_gradient', 'label' => __('Overlay Gradient', 'mlzs'), 'name' => 'gradient', 'type' => 'select', 'choices' => array('primary' => 'from-primary/50', 'primary-light' => 'from-primary-light/50'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_inf_tab_cta', 'label' => __('Health Protocol CTA', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_inf_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'infirmary_cta_heading', 'type' => 'text', 'default_value' => 'Health & Safety Protocols'),
            array('key' => 'field_inf_cta_para', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'infirmary_cta_para', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Parents are notified immediately in case of any medical emergency. We maintain detailed health records and follow strict protocols for medication administration.'),
            array('key' => 'field_inf_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'infirmary_cta_btn1_icon', 'type' => 'text', 'default_value' => 'file-text'),
            array('key' => 'field_inf_cta_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'infirmary_cta_btn1_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link popup mein URL ke saath "Link Text" bhar den – wahi button par dikhega.', 'mlzs')),
            array('key' => 'field_inf_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'infirmary_cta_btn2_icon', 'type' => 'text', 'default_value' => 'phone'),
            array('key' => 'field_inf_cta_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'infirmary_cta_btn2_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link popup mein URL ke saath "Link Text" bhar den – wahi button par dikhega.', 'mlzs')),
            array('key' => 'field_inf_cta_boxes', 'label' => __('CTA Stat Boxes (4)', 'mlzs'), 'name' => 'infirmary_cta_boxes', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add Box', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_inf_cta_box_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Immediate'),
                array('key' => 'field_inf_cta_box_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Response Time'),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'infirmary.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_infirmary_field_group');
