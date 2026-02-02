<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Principal's Message Page – Hero, Principal info, Message content, Vision (3), CTA
 */
function mlzs_acf_principal_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_principal',
        'title'                 => __('Principal\'s Message Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_principal_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_principal_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'principal_hero_badge', 'type' => 'text', 'default_value' => 'From the Principal\'s Desk'),
            array('key' => 'field_principal_hero_headline', 'label' => __('Headline', 'mlzs'), 'name' => 'principal_hero_headline', 'type' => 'text', 'default_value' => 'Principal\'s Message'),
            array('key' => 'field_principal_hero_quote', 'label' => __('Quote', 'mlzs'), 'name' => 'principal_hero_quote', 'type' => 'textarea', 'rows' => 2, 'default_value' => '"Education is not preparation for life; education is life itself."'),
            array('key' => 'field_principal_hero_intro', 'label' => __('Intro Paragraph', 'mlzs'), 'name' => 'principal_hero_intro', 'type' => 'textarea', 'rows' => 4, 'default_value' => 'Welcome to Mount Litera Zee School, Alwar - where we believe in nurturing minds, building character, and shaping futures. As Principal, I am honored to share our vision and commitment to excellence in education.'),
            array('key' => 'field_principal_name', 'label' => __('Principal Name', 'mlzs'), 'name' => 'principal_name', 'type' => 'text', 'default_value' => 'Abhishek Srivastava', 'instructions' => __('Initials are auto-derived from name (e.g. Abhishek Srivastava → AS).', 'mlzs')),
            array('key' => 'field_principal_title', 'label' => __('Principal Title', 'mlzs'), 'name' => 'principal_title', 'type' => 'text', 'default_value' => 'Principal'),
            array('key' => 'field_principal_school', 'label' => __('School Name', 'mlzs'), 'name' => 'principal_school', 'type' => 'text', 'default_value' => 'Mount Litera Zee School, Alwar'),
            array('key' => 'field_principal_hero_traits', 'label' => __('Hero Traits (3)', 'mlzs'), 'name' => 'principal_hero_traits', 'type' => 'repeater', 'layout' => 'row', 'min' => 3, 'max' => 3, 'button_label' => __('Add Trait', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_principal_trait_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'graduation-cap'),
                array('key' => 'field_principal_trait_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Educational Leadership'),
            )),
            array('key' => 'field_principal_tab_sidebar', 'label' => __('Principal Sidebar', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_principal_photo', 'label' => __('Principal Photo', 'mlzs'), 'name' => 'principal_photo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium', 'instructions' => __('Optional. If empty, initials are shown.', 'mlzs')),
            array('key' => 'field_principal_leadership_heading', 'label' => __('Leadership Philosophy Heading', 'mlzs'), 'name' => 'principal_leadership_heading', 'type' => 'text', 'default_value' => 'Leadership Philosophy'),
            array('key' => 'field_principal_leadership_para', 'label' => __('Leadership Paragraph', 'mlzs'), 'name' => 'principal_leadership_para', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Believing in the potential of every child and creating environments where they can discover and develop their unique talents.'),
            array('key' => 'field_principal_core_beliefs', 'label' => __('Core Beliefs (4)', 'mlzs'), 'name' => 'principal_core_beliefs', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add Belief', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_principal_belief_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text', 'default_value' => 'Every child is unique and gifted'),
            )),
            array('key' => 'field_principal_tab_message', 'label' => __('Message Content', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_principal_welcome_heading', 'label' => __('Welcome Heading', 'mlzs'), 'name' => 'principal_welcome_heading', 'type' => 'text', 'default_value' => 'Welcome to Our School Family'),
            array('key' => 'field_principal_welcome_icon', 'label' => __('Welcome Icon', 'mlzs'), 'name' => 'principal_welcome_icon', 'type' => 'text', 'default_value' => 'school'),
            array('key' => 'field_principal_welcome_highlight', 'label' => __('Welcome Highlight (box)', 'mlzs'), 'name' => 'principal_welcome_highlight', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_principal_welcome_para', 'label' => __('Welcome Paragraph', 'mlzs'), 'name' => 'principal_welcome_para', 'type' => 'textarea', 'rows' => 4),
            array('key' => 'field_principal_skills_heading', 'label' => __('21st Century Heading', 'mlzs'), 'name' => 'principal_skills_heading', 'type' => 'text', 'default_value' => 'Preparing for the 21st Century'),
            array('key' => 'field_principal_skills_icon', 'label' => __('21st Century Icon', 'mlzs'), 'name' => 'principal_skills_icon', 'type' => 'text', 'default_value' => 'zap'),
            array('key' => 'field_principal_skills_intro', 'label' => __('21st Century Intro', 'mlzs'), 'name' => 'principal_skills_intro', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_principal_skills_cards', 'label' => __('Skill Cards (4)', 'mlzs'), 'name' => 'principal_skills_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 4, 'max' => 4, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_principal_skill_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'brain'),
                array('key' => 'field_principal_skill_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'secondary' => 'Secondary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
                array('key' => 'field_principal_skill_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Critical Thinking'),
                array('key' => 'field_principal_skill_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_principal_commitment_heading', 'label' => __('Commitment Heading', 'mlzs'), 'name' => 'principal_commitment_heading', 'type' => 'text', 'default_value' => 'Our Educational Commitment'),
            array('key' => 'field_principal_commitment_icon', 'label' => __('Commitment Icon', 'mlzs'), 'name' => 'principal_commitment_icon', 'type' => 'text', 'default_value' => 'target'),
            array('key' => 'field_principal_commitment_items', 'label' => __('Commitment Items (3)', 'mlzs'), 'name' => 'principal_commitment_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_principal_commit_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check'),
                array('key' => 'field_principal_commit_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'secondary' => 'Secondary', 'accent' => 'Accent'), 'default_value' => 'primary'),
                array('key' => 'field_principal_commit_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Experiential Learning'),
                array('key' => 'field_principal_commit_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 3),
            )),
            array('key' => 'field_principal_closing_heading', 'label' => __('Closing Heading', 'mlzs'), 'name' => 'principal_closing_heading', 'type' => 'text', 'default_value' => 'A Personal Invitation'),
            array('key' => 'field_principal_closing_para', 'label' => __('Closing Paragraph', 'mlzs'), 'name' => 'principal_closing_para', 'type' => 'textarea', 'rows' => 4),
            array('key' => 'field_principal_closing_signature', 'label' => __('Closing Signature', 'mlzs'), 'name' => 'principal_closing_signature', 'type' => 'text', 'default_value' => 'Abhishek Srivastava'),
            array('key' => 'field_principal_closing_title', 'label' => __('Closing Title', 'mlzs'), 'name' => 'principal_closing_title', 'type' => 'text', 'default_value' => 'Principal'),
            array('key' => 'field_principal_closing_school', 'label' => __('Closing School', 'mlzs'), 'name' => 'principal_closing_school', 'type' => 'text', 'default_value' => 'Mount Litera Zee School, Alwar'),
            array('key' => 'field_principal_closing_exp_label', 'label' => __('Experience Label', 'mlzs'), 'name' => 'principal_closing_exp_label', 'type' => 'text', 'default_value' => 'Years of Educational Leadership Experience'),
            array('key' => 'field_principal_tab_vision', 'label' => __('Vision Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_principal_vision_heading', 'label' => __('Vision Heading', 'mlzs'), 'name' => 'principal_vision_heading', 'type' => 'text', 'default_value' => 'Our Vision for Every Student'),
            array('key' => 'field_principal_vision_subtext', 'label' => __('Vision Subtext', 'mlzs'), 'name' => 'principal_vision_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'At Mount Litera Zee School, we envision our students as future leaders equipped with knowledge, character, and compassion'),
            array('key' => 'field_principal_vision_items', 'label' => __('Vision Cards (3)', 'mlzs'), 'name' => 'principal_vision_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_principal_vision_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'book-open'),
                array('key' => 'field_principal_vision_gradient', 'label' => __('Gradient', 'mlzs'), 'name' => 'gradient', 'type' => 'select', 'choices' => array('primary' => 'Primary to Primary Light', 'secondary' => 'Secondary to Accent', 'accent' => 'Primary Light to Secondary'), 'default_value' => 'primary'),
                array('key' => 'field_principal_vision_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Academic Excellence'),
                array('key' => 'field_principal_vision_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_principal_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_principal_cta_badge', 'label' => __('CTA Badge', 'mlzs'), 'name' => 'principal_cta_badge', 'type' => 'text', 'default_value' => 'Experience Our Campus'),
            array('key' => 'field_principal_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'principal_cta_heading', 'type' => 'text', 'default_value' => 'Visit Us and See the Difference'),
            array('key' => 'field_principal_cta_para', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'principal_cta_para', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_principal_cta_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'principal_cta_btn1_link', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_principal_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'principal_cta_btn1_icon', 'type' => 'text', 'default_value' => 'calendar'),
            array('key' => 'field_principal_cta_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'principal_cta_btn2_link', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_principal_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'principal_cta_btn2_icon', 'type' => 'text', 'default_value' => 'message-circle'),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'principal.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_principal_field_group');
