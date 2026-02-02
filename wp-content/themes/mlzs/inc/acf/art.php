<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Art & Craft Page – Hero, Main Content, Images, Curriculum, Benefits, CTA
 */
function mlzs_acf_art_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_art',
        'title'                 => __('Art & Craft Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_art_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_art_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'art_hero_badge', 'type' => 'text', 'default_value' => 'Creative Expression'),
            array('key' => 'field_art_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'art_hero_icon', 'type' => 'text', 'default_value' => 'palette'),
            array('key' => 'field_art_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'art_hero_headline', 'type' => 'text', 'default_value' => 'Art &'),
            array('key' => 'field_art_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'art_hero_highlight', 'type' => 'text', 'default_value' => 'Craft'),
            array('key' => 'field_art_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'art_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Nurturing imagination and creativity through hands-on artistic experiences'),
            array('key' => 'field_art_tab_content', 'label' => __('Main Content', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_art_content_heading', 'label' => __('Content Card Heading', 'mlzs'), 'name' => 'art_content_heading', 'type' => 'text', 'default_value' => 'The Art of Creative Expression'),
            array('key' => 'field_art_content_para1', 'label' => __('Paragraph 1', 'mlzs'), 'name' => 'art_content_para1', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_art_content_para2', 'label' => __('Paragraph 2 (highlight box)', 'mlzs'), 'name' => 'art_content_para2', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_art_content_para3', 'label' => __('Paragraph 3', 'mlzs'), 'name' => 'art_content_para3', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_art_content_labs_heading', 'label' => __('Art Labs Section Heading', 'mlzs'), 'name' => 'art_content_labs_heading', 'type' => 'text', 'default_value' => 'Our Art Labs'),
            array('key' => 'field_art_content_junior_label', 'label' => __('Junior Lab Label', 'mlzs'), 'name' => 'art_content_junior_label', 'type' => 'text', 'default_value' => 'Junior Art Lab'),
            array('key' => 'field_art_content_junior_classes', 'label' => __('Junior Lab Classes', 'mlzs'), 'name' => 'art_content_junior_classes', 'type' => 'text', 'default_value' => 'For Classes 1-4'),
            array('key' => 'field_art_content_senior_label', 'label' => __('Senior Lab Label', 'mlzs'), 'name' => 'art_content_senior_label', 'type' => 'text', 'default_value' => 'Senior Art Lab'),
            array('key' => 'field_art_content_senior_classes', 'label' => __('Senior Lab Classes', 'mlzs'), 'name' => 'art_content_senior_classes', 'type' => 'text', 'default_value' => 'For Classes 5-9'),
            array('key' => 'field_art_tab_images', 'label' => __('Images', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_art_image_1', 'label' => __('Image 1 (Junior Art Lab)', 'mlzs'), 'name' => 'art_image_1', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_art_image_1_title', 'label' => __('Image 1 Title', 'mlzs'), 'name' => 'art_image_1_title', 'type' => 'text', 'default_value' => 'Junior Art Lab'),
            array('key' => 'field_art_image_1_caption', 'label' => __('Image 1 Caption', 'mlzs'), 'name' => 'art_image_1_caption', 'type' => 'text', 'default_value' => 'Classes 1-4 students exploring creativity'),
            array('key' => 'field_art_image_2', 'label' => __('Image 2 (Senior Craft Lab)', 'mlzs'), 'name' => 'art_image_2', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_art_image_2_title', 'label' => __('Image 2 Title', 'mlzs'), 'name' => 'art_image_2_title', 'type' => 'text', 'default_value' => 'Senior Craft Lab'),
            array('key' => 'field_art_image_2_caption', 'label' => __('Image 2 Caption', 'mlzs'), 'name' => 'art_image_2_caption', 'type' => 'text', 'default_value' => 'Classes 5-9 developing advanced skills'),
            array('key' => 'field_art_tab_curriculum', 'label' => __('Curriculum & Activities', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_art_curriculum_heading', 'label' => __('Curriculum Heading', 'mlzs'), 'name' => 'art_curriculum_heading', 'type' => 'text', 'default_value' => 'Our Art Curriculum'),
            array('key' => 'field_art_curriculum_items', 'label' => __('Curriculum Items', 'mlzs'), 'name' => 'art_curriculum_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_art_curriculum_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_art_activities_heading', 'label' => __('Activities Heading', 'mlzs'), 'name' => 'art_activities_heading', 'type' => 'text', 'default_value' => 'Activities & Events'),
            array('key' => 'field_art_activities_items', 'label' => __('Activities Items', 'mlzs'), 'name' => 'art_activities_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_art_activities_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_art_tab_benefits', 'label' => __('Benefits Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_art_benefits_heading', 'label' => __('Benefits Heading', 'mlzs'), 'name' => 'art_benefits_heading', 'type' => 'text', 'default_value' => 'Benefits of Art Education'),
            array('key' => 'field_art_benefits_sub', 'label' => __('Benefits Subheading', 'mlzs'), 'name' => 'art_benefits_sub', 'type' => 'text', 'default_value' => 'Developing creativity, critical thinking, and emotional expression through art'),
            array('key' => 'field_art_benefits_cards', 'label' => __('Benefit Cards (3)', 'mlzs'), 'name' => 'art_benefits_cards', 'type' => 'repeater', 'min' => 3, 'max' => 3, 'layout' => 'block', 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_art_benefit_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'brain'),
                array('key' => 'field_art_benefit_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_art_benefit_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_art_benefit_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_art_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_art_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'art_cta_heading', 'type' => 'text', 'default_value' => 'Explore Your Creative Potential'),
            array('key' => 'field_art_cta_description', 'label' => __('CTA Description', 'mlzs'), 'name' => 'art_cta_description', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Join our art programs and discover the joy of creative expression in our state-of-the-art art labs.'),
            array('key' => 'field_art_cta_btn_primary', 'label' => __('Primary Button', 'mlzs'), 'name' => 'art_cta_btn_primary', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_art_cta_btn_primary_icon', 'label' => __('Primary Button Icon', 'mlzs'), 'name' => 'art_cta_btn_primary_icon', 'type' => 'text', 'default_value' => 'calendar'),
            array('key' => 'field_art_cta_btn_secondary', 'label' => __('Secondary Button', 'mlzs'), 'name' => 'art_cta_btn_secondary', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_art_cta_btn_secondary_icon', 'label' => __('Secondary Button Icon', 'mlzs'), 'name' => 'art_cta_btn_secondary_icon', 'type' => 'text', 'default_value' => 'image'),
            array('key' => 'field_art_cta_stats', 'label' => __('Stats (4 boxes)', 'mlzs'), 'name' => 'art_cta_stats', 'type' => 'repeater', 'min' => 4, 'max' => 4, 'layout' => 'table', 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_art_cta_stat_number', 'label' => __('Number', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                array('key' => 'field_art_cta_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
        ),
        'location' => array(
            array(
                array('param' => 'page_template', 'operator' => '==', 'value' => 'art.php'),
            ),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_art_field_group');
