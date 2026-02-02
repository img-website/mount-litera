<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Media / Multimedia Page – Hero, Intro (2 cols), Core Features (3), USP, Creative Team (3), Benefits (student 4 + teacher 3), CTA (Link buttons)
 * Image alt = use attachment alt from Media Library; no separate ACF alt field.
 */
function mlzs_acf_media_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_media',
        'title'                 => __('Multimedia Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_media_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_media_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'media_hero_badge', 'type' => 'text', 'default_value' => 'Digital Learning'),
            array('key' => 'field_media_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'media_hero_icon', 'type' => 'text', 'default_value' => 'tv'),
            array('key' => 'field_media_hero_headline_before', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'media_hero_headline_before', 'type' => 'text', 'default_value' => 'Interactive'),
            array('key' => 'field_media_hero_headline_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'media_hero_headline_highlight', 'type' => 'text', 'default_value' => 'Multimedia Classes'),
            array('key' => 'field_media_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'media_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Pioneering digital education with cutting-edge multimedia classrooms that blend technology with pedagogy for an immersive learning experience.'),
            array('key' => 'field_media_tab_intro', 'label' => __('Introduction', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_media_intro_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'media_intro_badge', 'type' => 'text', 'default_value' => 'Innovation'),
            array('key' => 'field_media_intro_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'media_intro_icon', 'type' => 'text', 'default_value' => 'zap'),
            array('key' => 'field_media_intro_heading_before', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'media_intro_heading_before', 'type' => 'text', 'default_value' => 'Revolutionizing Education Through'),
            array('key' => 'field_media_intro_heading_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'media_intro_heading_highlight', 'type' => 'text', 'default_value' => 'Technology'),
            array('key' => 'field_media_intro_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'media_intro_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Mount Litera Zee School is the first school in the city to implement this advanced interactive classroom solution, setting new standards in digital education.'),
            array('key' => 'field_media_intro_left_icon', 'label' => __('Left Card Icon', 'mlzs'), 'name' => 'media_intro_left_icon', 'type' => 'text', 'default_value' => 'globe'),
            array('key' => 'field_media_intro_left_title', 'label' => __('Left Card Title', 'mlzs'), 'name' => 'media_intro_left_title', 'type' => 'text', 'default_value' => 'World-Class Interactive Solution'),
            array('key' => 'field_media_intro_left_para1', 'label' => __('Left Card Paragraph 1', 'mlzs'), 'name' => 'media_intro_left_para1', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_media_intro_left_para2', 'label' => __('Left Card Paragraph 2', 'mlzs'), 'name' => 'media_intro_left_para2', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_media_intro_left_image', 'label' => __('Left Column Image', 'mlzs'), 'name' => 'media_intro_left_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_media_intro_left_image_caption', 'label' => __('Left Image Overlay Caption', 'mlzs'), 'name' => 'media_intro_left_image_caption', 'type' => 'text', 'default_value' => 'Interactive Multimedia Classroom'),
            array('key' => 'field_media_intro_left_image_icon', 'label' => __('Left Image Overlay Icon', 'mlzs'), 'name' => 'media_intro_left_image_icon', 'type' => 'text', 'default_value' => 'tv'),
            array('key' => 'field_media_intro_right_image', 'label' => __('Right Column Image', 'mlzs'), 'name' => 'media_intro_right_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_media_intro_right_image_caption', 'label' => __('Right Image Overlay Caption', 'mlzs'), 'name' => 'media_intro_right_image_caption', 'type' => 'text', 'default_value' => 'Cloud-Based Learning Content'),
            array('key' => 'field_media_intro_right_image_icon', 'label' => __('Right Image Overlay Icon', 'mlzs'), 'name' => 'media_intro_right_image_icon', 'type' => 'text', 'default_value' => 'cloud'),
            array('key' => 'field_media_intro_right_icon', 'label' => __('Right Card Icon', 'mlzs'), 'name' => 'media_intro_right_icon', 'type' => 'text', 'default_value' => 'cloud'),
            array('key' => 'field_media_intro_right_title', 'label' => __('Right Card Title', 'mlzs'), 'name' => 'media_intro_right_title', 'type' => 'text', 'default_value' => 'Advanced Technology Infrastructure'),
            array('key' => 'field_media_intro_right_para1', 'label' => __('Right Card Paragraph 1', 'mlzs'), 'name' => 'media_intro_right_para1', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_media_intro_right_para2', 'label' => __('Right Card Paragraph 2', 'mlzs'), 'name' => 'media_intro_right_para2', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_media_tab_features', 'label' => __('Core Features (3)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_media_features_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'media_features_badge', 'type' => 'text', 'default_value' => 'Core Technology'),
            array('key' => 'field_media_features_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'media_features_icon', 'type' => 'text', 'default_value' => 'cpu'),
            array('key' => 'field_media_features_heading_before', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'media_features_heading_before', 'type' => 'text', 'default_value' => 'Cutting-Edge'),
            array('key' => 'field_media_features_heading_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'media_features_heading_highlight', 'type' => 'text', 'default_value' => 'Multimedia Features'),
            array('key' => 'field_media_features_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'media_features_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Our multimedia classrooms are equipped with the latest technology to create an engaging and effective learning environment.'),
            array('key' => 'field_media_features_items', 'label' => __('Feature Cards (3)', 'mlzs'), 'name' => 'media_features_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add Feature', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_media_feat_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'projector'),
                array('key' => 'field_media_feat_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
                array('key' => 'field_media_feat_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Advanced Projector Systems'),
                array('key' => 'field_media_feat_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_media_tab_usp', 'label' => __('USP Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_media_usp_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'media_usp_badge', 'type' => 'text', 'default_value' => 'Unique Advantages'),
            array('key' => 'field_media_usp_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'media_usp_icon', 'type' => 'text', 'default_value' => 'sparkles'),
            array('key' => 'field_media_usp_heading_before', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'media_usp_heading_before', 'type' => 'text', 'default_value' => 'Multiple Learning'),
            array('key' => 'field_media_usp_heading_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'media_usp_heading_highlight', 'type' => 'text', 'default_value' => 'Experiences Model'),
            array('key' => 'field_media_usp_items', 'label' => __('USP Items (3)', 'mlzs'), 'name' => 'media_usp_items', 'type' => 'repeater', 'layout' => 'row', 'min' => 3, 'max' => 3, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_media_usp_icon_style', 'label' => __('Icon Style', 'mlzs'), 'name' => 'icon_style', 'type' => 'select', 'choices' => array('green' => 'Green', 'blue' => 'Blue', 'purple' => 'Purple'), 'default_value' => 'green'),
                array('key' => 'field_media_usp_icon_name', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'book-open'),
                array('key' => 'field_media_usp_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Lesson Plan Approach'),
                array('key' => 'field_media_usp_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_media_usp_right_title', 'label' => __('Right Card Title', 'mlzs'), 'name' => 'media_usp_right_title', 'type' => 'text', 'default_value' => 'Pioneering Achievement'),
            array('key' => 'field_media_usp_right_items', 'label' => __('Right Card Items (3)', 'mlzs'), 'name' => 'media_usp_right_items', 'type' => 'repeater', 'layout' => 'row', 'min' => 3, 'max' => 3, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_media_usp_right_item_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'star'),
                array('key' => 'field_media_usp_right_item_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'First in the City'),
                array('key' => 'field_media_usp_right_item_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'text', 'default_value' => 'First school in the city to implement this advanced interactive classroom solution'),
            )),
            array('key' => 'field_media_tab_team', 'label' => __('Creative Team (3)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_media_team_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'media_team_badge', 'type' => 'text', 'default_value' => 'Behind the Scenes'),
            array('key' => 'field_media_team_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'media_team_icon', 'type' => 'text', 'default_value' => 'users'),
            array('key' => 'field_media_team_heading_before', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'media_team_heading_before', 'type' => 'text', 'default_value' => 'Our In-House'),
            array('key' => 'field_media_team_heading_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'media_team_heading_highlight', 'type' => 'text', 'default_value' => 'Creative Team'),
            array('key' => 'field_media_team_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'media_team_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'A dedicated team of professionals working continuously to develop engaging and effective multimedia content for our students.'),
            array('key' => 'field_media_team_items', 'label' => __('Team Cards (3)', 'mlzs'), 'name' => 'media_team_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_media_team_card_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'user-check'),
                array('key' => 'field_media_team_card_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
                array('key' => 'field_media_team_card_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Experienced Teachers'),
                array('key' => 'field_media_team_card_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_media_team_card_label', 'label' => __('Footer Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Curriculum Experts'),
            )),
            array('key' => 'field_media_team_banner_heading', 'label' => __('Banner Heading', 'mlzs'), 'name' => 'media_team_banner_heading', 'type' => 'text', 'default_value' => 'Continuous Content Development'),
            array('key' => 'field_media_team_banner_para', 'label' => __('Banner Paragraph', 'mlzs'), 'name' => 'media_team_banner_para', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Our creative team continuously creates, develops, and uploads lesson content, ensuring that students always have access to fresh, relevant, and engaging educational materials tailored to their learning needs.'),
            array('key' => 'field_media_tab_benefits', 'label' => __('Benefits Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_media_benefits_student_icon', 'label' => __('Student Badge Icon', 'mlzs'), 'name' => 'media_benefits_student_icon', 'type' => 'text', 'default_value' => 'graduation-cap'),
            array('key' => 'field_media_benefits_student_badge', 'label' => __('Student Badge', 'mlzs'), 'name' => 'media_benefits_student_badge', 'type' => 'text', 'default_value' => 'Student Benefits'),
            array('key' => 'field_media_benefits_student_heading', 'label' => __('Student Heading (before highlight)', 'mlzs'), 'name' => 'media_benefits_student_heading', 'type' => 'text', 'default_value' => 'Preparing Students for'),
            array('key' => 'field_media_benefits_student_highlight', 'label' => __('Student Heading (highlighted)', 'mlzs'), 'name' => 'media_benefits_student_highlight', 'type' => 'text', 'default_value' => 'Tomorrow\'s World'),
            array('key' => 'field_media_benefits_student_items', 'label' => __('Student Items (4)', 'mlzs'), 'name' => 'media_benefits_student_items', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_media_ben_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Enhanced Engagement'),
                array('key' => 'field_media_ben_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_media_benefits_teacher_icon', 'label' => __('Teacher Badge Icon', 'mlzs'), 'name' => 'media_benefits_teacher_icon', 'type' => 'text', 'default_value' => 'user-plus'),
            array('key' => 'field_media_benefits_teacher_badge', 'label' => __('Teacher Badge', 'mlzs'), 'name' => 'media_benefits_teacher_badge', 'type' => 'text', 'default_value' => 'Teacher Benefits'),
            array('key' => 'field_media_benefits_teacher_heading', 'label' => __('Teacher Heading (before highlight)', 'mlzs'), 'name' => 'media_benefits_teacher_heading', 'type' => 'text', 'default_value' => 'Empowering Our'),
            array('key' => 'field_media_benefits_teacher_highlight', 'label' => __('Teacher Heading (highlighted)', 'mlzs'), 'name' => 'media_benefits_teacher_highlight', 'type' => 'text', 'default_value' => 'Educators'),
            array('key' => 'field_media_benefits_teacher_items', 'label' => __('Teacher Items (3+)', 'mlzs'), 'name' => 'media_benefits_teacher_items', 'type' => 'repeater', 'layout' => 'row', 'min' => 3, 'max' => 6, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_media_ben_t_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Enhanced Teaching Tools'),
                array('key' => 'field_media_ben_t_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_media_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_media_cta_icon', 'label' => __('CTA Icon', 'mlzs'), 'name' => 'media_cta_icon', 'type' => 'text', 'default_value' => 'video'),
            array('key' => 'field_media_cta_heading_before', 'label' => __('CTA Heading (before highlight)', 'mlzs'), 'name' => 'media_cta_heading_before', 'type' => 'text', 'default_value' => 'Experience Interactive'),
            array('key' => 'field_media_cta_heading_highlight', 'label' => __('CTA Heading (highlighted)', 'mlzs'), 'name' => 'media_cta_heading_highlight', 'type' => 'text', 'default_value' => 'Learning'),
            array('key' => 'field_media_cta_para', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'media_cta_para', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'See firsthand how our multimedia classrooms are transforming education and preparing students for success in the digital age.'),
            array('key' => 'field_media_cta_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'media_cta_btn1_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Schedule a Demo Class).', 'mlzs')),
            array('key' => 'field_media_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'media_cta_btn1_icon', 'type' => 'text', 'default_value' => 'calendar'),
            array('key' => 'field_media_cta_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'media_cta_btn2_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Download Brochure).', 'mlzs')),
            array('key' => 'field_media_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'media_cta_btn2_icon', 'type' => 'text', 'default_value' => 'download'),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'media.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_media_field_group');
