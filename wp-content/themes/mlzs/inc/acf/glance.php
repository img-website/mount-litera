<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Life at a Glance Page – Hero, Intro row, Second row, Key Highlights, Quote, CTA
 */
function mlzs_acf_glance_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_glance',
        'title'                 => __('Life at a Glance Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_glance_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_glance_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'glance_hero_badge', 'type' => 'text', 'default_value' => 'School Life'),
            array('key' => 'field_glance_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'glance_hero_icon', 'type' => 'text', 'default_value' => 'eye'),
            array('key' => 'field_glance_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'glance_hero_headline', 'type' => 'text', 'default_value' => 'Life at Mount Litera'),
            array('key' => 'field_glance_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'glance_hero_highlight', 'type' => 'text', 'default_value' => 'Glance'),
            array('key' => 'field_glance_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'glance_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'A glimpse into the vibrant, enriching, and transformative educational journey at our institution.'),
            array('key' => 'field_glance_tab_row1', 'label' => __('First Row (Intro)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_glance_student_icon', 'label' => __('Student Culture – Icon', 'mlzs'), 'name' => 'glance_student_icon', 'type' => 'text', 'default_value' => 'users'),
            array('key' => 'field_glance_student_title', 'label' => __('Student Culture – Title', 'mlzs'), 'name' => 'glance_student_title', 'type' => 'text', 'default_value' => 'Student Culture'),
            array('key' => 'field_glance_student_content', 'label' => __('Student Culture – Content', 'mlzs'), 'name' => 'glance_student_content', 'type' => 'wysiwyg', 'default_value' => 'Students set the tone for our school. They are passionate, principled committed, persistent and trained to excel. They share a desire to challenge themselves.<br><br>By cultivating qualities such as analytical reasoning, self criticism and intellectual honesty. A culture of critical thinking and risk taking is developed wherein everything and everyone is open to being challenged and questioned.'),
            array('key' => 'field_glance_center_image', 'label' => __('Center – Image', 'mlzs'), 'name' => 'glance_center_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_glance_center_caption', 'label' => __('Center – Caption', 'mlzs'), 'name' => 'glance_center_caption', 'type' => 'text', 'default_value' => 'Vibrant Campus Life'),
            array('key' => 'field_glance_academic_icon', 'label' => __('Academic Excellence – Icon', 'mlzs'), 'name' => 'glance_academic_icon', 'type' => 'text', 'default_value' => 'award'),
            array('key' => 'field_glance_academic_title', 'label' => __('Academic Excellence – Title', 'mlzs'), 'name' => 'glance_academic_title', 'type' => 'text', 'default_value' => 'Academic Excellence'),
            array('key' => 'field_glance_academic_content', 'label' => __('Academic Excellence – Content', 'mlzs'), 'name' => 'glance_academic_content', 'type' => 'wysiwyg', 'default_value' => 'Their passion to succeed promotes a stimulating intellectual climate which help pursue excellence.<br><br>Apart from regular courses, our institutions offer examinations* in various subjects in collaboration with the University of Cambridge and offers subjects like Environmental Studies, Sustainable development programmes, Psychology etc. which enhance the skills to the optimum level.'),
            array('key' => 'field_glance_academic_note', 'label' => __('Academic Excellence – Footnote', 'mlzs'), 'name' => 'glance_academic_note', 'type' => 'text', 'default_value' => '*Subject to availability and student eligibility'),
            array('key' => 'field_glance_tab_row2', 'label' => __('Second Row', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_glance_talents_icon', 'label' => __('Developing Talents – Icon', 'mlzs'), 'name' => 'glance_talents_icon', 'type' => 'text', 'default_value' => 'music'),
            array('key' => 'field_glance_talents_title', 'label' => __('Developing Talents – Title', 'mlzs'), 'name' => 'glance_talents_title', 'type' => 'text', 'default_value' => 'Developing Talents'),
            array('key' => 'field_glance_talents_content', 'label' => __('Developing Talents – Content', 'mlzs'), 'name' => 'glance_talents_content', 'type' => 'wysiwyg', 'default_value' => 'Theatre has been the backbone for improving the Standards of "Learning and Imparting meaningful Education through an experience" where the expressions of daily life are exhibited under the guidance of Professionals.<br><br>We invite the students to pursue higher education in music and theatre by streamlining the process for training under "master". We encourage every student to take part in Music, Theater and Dance be it Indian, Western, Classical or Popular.<br><br>It is our policy to support Choirs, Bands and present an Orchestra of Concert level.'),
            array('key' => 'field_glance_leadership_icon', 'label' => __('Leadership – Icon', 'mlzs'), 'name' => 'glance_leadership_icon', 'type' => 'text', 'default_value' => 'target'),
            array('key' => 'field_glance_leadership_title', 'label' => __('Leadership – Title', 'mlzs'), 'name' => 'glance_leadership_title', 'type' => 'text', 'default_value' => 'Leadership'),
            array('key' => 'field_glance_leadership_content', 'label' => __('Leadership – Content', 'mlzs'), 'name' => 'glance_leadership_content', 'type' => 'wysiwyg', 'default_value' => 'Learning is an essential part of our life. What carries us through life is our ability to grow, to discover new possibilities in ourselves and the world.<br><br>Our students will not shirk from the unknown fear, but embrace change with a consummate faith in the deepest principles of existence.<br><br>Living on the edge, leading from the edge, they respond to uncertainty by joyously seeking their balance in dynamic interaction with the challenges of life.'),
            array('key' => 'field_glance_life_image', 'label' => __('Life at School – Image', 'mlzs'), 'name' => 'glance_life_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_glance_life_title', 'label' => __('Life at School – Title', 'mlzs'), 'name' => 'glance_life_title', 'type' => 'text', 'default_value' => 'Life at Mount Litera'),
            array('key' => 'field_glance_life_subtitle', 'label' => __('Life at School – Subtitle', 'mlzs'), 'name' => 'glance_life_subtitle', 'type' => 'text', 'default_value' => 'Moments that define the Mount Litera experience'),
            array('key' => 'field_glance_life_icon', 'label' => __('Life at School – Badge Icon', 'mlzs'), 'name' => 'glance_life_icon', 'type' => 'text', 'default_value' => 'image'),
            array('key' => 'field_glance_tab_highlights', 'label' => __('Key Highlights', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_glance_hl_badge', 'label' => __('Section Badge', 'mlzs'), 'name' => 'glance_hl_badge', 'type' => 'text', 'default_value' => 'Key Highlights'),
            array('key' => 'field_glance_hl_icon', 'label' => __('Section Badge Icon', 'mlzs'), 'name' => 'glance_hl_icon', 'type' => 'text', 'default_value' => 'star'),
            array('key' => 'field_glance_hl_heading', 'label' => __('Section Heading (before highlight)', 'mlzs'), 'name' => 'glance_hl_heading', 'type' => 'text', 'default_value' => 'What Makes Us'),
            array('key' => 'field_glance_hl_highlight', 'label' => __('Section Heading (highlighted)', 'mlzs'), 'name' => 'glance_hl_highlight', 'type' => 'text', 'default_value' => 'Different'),
            array('key' => 'field_glance_hl_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'glance_hl_subtext', 'type' => 'text', 'default_value' => 'Our approach to education goes beyond academics to shape well-rounded individuals'),
            array('key' => 'field_glance_hl_cards', 'label' => __('Highlight Cards', 'mlzs'), 'name' => 'glance_hl_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 4, 'max' => 4, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_glance_hl_card_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'brain'),
                array('key' => 'field_glance_hl_card_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_glance_hl_card_desc', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'text'),
                array('key' => 'field_glance_hl_card_style', 'label' => __('Card colour', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => __('Primary', 'mlzs'), 'accent' => __('Accent', 'mlzs'), 'primary-light' => __('Primary Light', 'mlzs'), 'accent-dark' => __('Accent Dark', 'mlzs')), 'default_value' => 'primary'),
            )),
            array('key' => 'field_glance_tab_quote', 'label' => __('Quote Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_glance_quote_text', 'label' => __('Quote Text', 'mlzs'), 'name' => 'glance_quote_text', 'type' => 'textarea', 'rows' => 3, 'default_value' => '"Living on the edge, leading from the edge, they respond to uncertainty by joyously seeking their balance in dynamic interaction with the challenges of life."'),
            array('key' => 'field_glance_quote_author', 'label' => __('Author Name', 'mlzs'), 'name' => 'glance_quote_author', 'type' => 'text', 'default_value' => 'Mount Litera Philosophy'),
            array('key' => 'field_glance_quote_title', 'label' => __('Author Title/Subtitle', 'mlzs'), 'name' => 'glance_quote_title', 'type' => 'text', 'default_value' => 'Our approach to leadership and personal growth'),
            array('key' => 'field_glance_tab_cta', 'label' => __('Call to Action', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_glance_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'glance_cta_heading', 'type' => 'text', 'default_value' => 'Experience the Mount Litera Difference'),
            array('key' => 'field_glance_cta_text', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'glance_cta_text', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Join our community of passionate learners, thinkers, and leaders shaping the future.'),
            array('key' => 'field_glance_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'glance_cta_btn1_icon', 'type' => 'text', 'default_value' => 'calendar'),
            array('key' => 'field_glance_cta_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'glance_cta_btn1_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link popup mein URL ke saath "Link Text" bhar den – wahi button par dikhega.', 'mlzs')),
            array('key' => 'field_glance_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'glance_cta_btn2_icon', 'type' => 'text', 'default_value' => 'download'),
            array('key' => 'field_glance_cta_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'glance_cta_btn2_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link popup mein URL ke saath "Link Text" bhar den – wahi button par dikhega.', 'mlzs')),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'glance.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_glance_field_group');
