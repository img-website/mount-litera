<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Lab Page – Hero, Intro, Computer/Science Labs, Quick Labs (3), Specialty Labs (3), Features (3), CTA
 */
function mlzs_acf_lab_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_lab',
        'title'                 => __('Lab Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_lab_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lab_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'lab_hero_badge', 'type' => 'text', 'default_value' => 'Science & Technology'),
            array('key' => 'field_lab_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'lab_hero_icon', 'type' => 'text', 'default_value' => 'flask-conical'),
            array('key' => 'field_lab_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'lab_hero_headline', 'type' => 'text', 'default_value' => 'State-of-the-Art'),
            array('key' => 'field_lab_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'lab_hero_highlight', 'type' => 'text', 'default_value' => 'Laboratories'),
            array('key' => 'field_lab_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'lab_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Equipped with cutting-edge technology and modern facilities, our laboratories provide hands-on learning experiences that foster scientific curiosity and innovation.'),
            array('key' => 'field_lab_hero_buttons', 'label' => __('Hero Buttons (2)', 'mlzs'), 'name' => 'lab_hero_buttons', 'type' => 'repeater', 'layout' => 'row', 'min' => 2, 'max' => 2, 'button_label' => __('Add Button', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_lab_hero_btn_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'cpu'),
                array('key' => 'field_lab_hero_btn_link', 'label' => __('Link', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link popup mein URL (ya #section-id) aur "Link Text" bhar den – wahi button par dikhega. Target bhi set kar sakte hain.', 'mlzs')),
                array('key' => 'field_lab_hero_btn_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('blue' => 'Blue (Computer)', 'green' => 'Green (Science)'), 'default_value' => 'blue'),
            )),
            array('key' => 'field_lab_tab_intro', 'label' => __('Introduction Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lab_intro_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'lab_intro_badge', 'type' => 'text', 'default_value' => 'Excellence'),
            array('key' => 'field_lab_intro_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'lab_intro_icon', 'type' => 'text', 'default_value' => 'award'),
            array('key' => 'field_lab_intro_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'lab_intro_heading', 'type' => 'text', 'default_value' => 'Among the Best CBSE Schools in Alwar'),
            array('key' => 'field_lab_intro_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'lab_intro_para', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Labs of Mount Litera Zee School provide all facilities as per the latest technology improvement, ensuring students get practical exposure to complement theoretical knowledge.'),
            array('key' => 'field_lab_tab_main', 'label' => __('Computer & Science Labs', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lab_computer_image', 'label' => __('Computer Lab – Image', 'mlzs'), 'name' => 'lab_computer_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_lab_computer_title', 'label' => __('Computer Lab – Title', 'mlzs'), 'name' => 'lab_computer_title', 'type' => 'text', 'default_value' => 'Computer Labs'),
            array('key' => 'field_lab_computer_para1', 'label' => __('Computer Lab – Paragraph 1', 'mlzs'), 'name' => 'lab_computer_para1', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Our well established new technology computer labs surely meet the requirement of the students. As the time changes, technology is playing a vital role in the present world.'),
            array('key' => 'field_lab_computer_para2', 'label' => __('Computer Lab – Paragraph 2', 'mlzs'), 'name' => 'lab_computer_para2', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Browsing for new topics and gaining depth knowledge makes the students occupy the top positions in their academic and professional pursuits.'),
            array('key' => 'field_lab_science_image', 'label' => __('Science Lab – Image', 'mlzs'), 'name' => 'lab_science_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_lab_science_title', 'label' => __('Science Lab – Title', 'mlzs'), 'name' => 'lab_science_title', 'type' => 'text', 'default_value' => 'Composite Science Labs'),
            array('key' => 'field_lab_science_para1', 'label' => __('Science Lab – Paragraph 1', 'mlzs'), 'name' => 'lab_science_para1', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'All the labs for Physics, Chemistry, and Life Sciences are equipped with the latest material to fulfill the needs of the students.'),
            array('key' => 'field_lab_science_para2', 'label' => __('Science Lab – Paragraph 2', 'mlzs'), 'name' => 'lab_science_para2', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'The full-fledged labs provide good hands-on experience for all the students, allowing them to explore scientific concepts through practical experimentation.'),
            array('key' => 'field_lab_tab_quick', 'label' => __('Quick Labs (3 cards)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lab_quick_cards', 'label' => __('Quick Labs Cards', 'mlzs'), 'name' => 'lab_quick_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_lab_quick_image', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_lab_quick_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Math Labs'),
                array('key' => 'field_lab_quick_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 3),
                array('key' => 'field_lab_quick_footer', 'label' => __('Footer Label', 'mlzs'), 'name' => 'footer_label', 'type' => 'text', 'default_value' => 'Interactive Learning'),
            )),
            array('key' => 'field_lab_tab_specialty', 'label' => __('Specialty Labs (3)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lab_specialty_badge', 'label' => __('Section Badge', 'mlzs'), 'name' => 'lab_specialty_badge', 'type' => 'text', 'default_value' => 'Specialty Labs'),
            array('key' => 'field_lab_specialty_icon', 'label' => __('Section Badge Icon', 'mlzs'), 'name' => 'lab_specialty_icon', 'type' => 'text', 'default_value' => 'beaker'),
            array('key' => 'field_lab_specialty_heading', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'lab_specialty_heading', 'type' => 'text', 'default_value' => 'Specialized'),
            array('key' => 'field_lab_specialty_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'lab_specialty_highlight', 'type' => 'text', 'default_value' => 'Laboratory Facilities'),
            array('key' => 'field_lab_specialty_cards', 'label' => __('Specialty Cards (3)', 'mlzs'), 'name' => 'lab_specialty_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_lab_spec_image', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_lab_spec_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Chemistry Lab'),
                array('key' => 'field_lab_spec_subtitle', 'label' => __('Subtitle or Paragraph', 'mlzs'), 'name' => 'subtitle', 'type' => 'text', 'default_value' => 'Advanced Equipment', 'instructions' => 'Short tag (e.g. Advanced Equipment) or leave empty and use paragraph'),
                array('key' => 'field_lab_spec_para', 'label' => __('Paragraph (optional, for Robotic etc)', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_lab_tab_features', 'label' => __('Key Features (3)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lab_features_badge', 'label' => __('Section Badge', 'mlzs'), 'name' => 'lab_features_badge', 'type' => 'text', 'default_value' => 'Key Features'),
            array('key' => 'field_lab_features_icon', 'label' => __('Section Badge Icon', 'mlzs'), 'name' => 'lab_features_icon', 'type' => 'text', 'default_value' => 'check-circle'),
            array('key' => 'field_lab_features_heading', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'lab_features_heading', 'type' => 'text', 'default_value' => 'What Makes Our Labs'),
            array('key' => 'field_lab_features_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'lab_features_highlight', 'type' => 'text', 'default_value' => 'Exceptional'),
            array('key' => 'field_lab_features_items', 'label' => __('Feature Items (3)', 'mlzs'), 'name' => 'lab_features_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_lab_feat_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'cpu'),
                array('key' => 'field_lab_feat_color', 'label' => __('Color', 'mlzs'), 'name' => 'color', 'type' => 'select', 'choices' => array('blue' => 'Blue', 'green' => 'Green', 'purple' => 'Purple'), 'default_value' => 'blue'),
                array('key' => 'field_lab_feat_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Latest Technology'),
                array('key' => 'field_lab_feat_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_lab_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lab_cta_icon', 'label' => __('CTA Icon', 'mlzs'), 'name' => 'lab_cta_icon', 'type' => 'text', 'default_value' => 'microscope'),
            array('key' => 'field_lab_cta_heading', 'label' => __('CTA Heading (before highlight)', 'mlzs'), 'name' => 'lab_cta_heading', 'type' => 'text', 'default_value' => 'Explore Our'),
            array('key' => 'field_lab_cta_highlight', 'label' => __('CTA Heading (highlighted)', 'mlzs'), 'name' => 'lab_cta_highlight', 'type' => 'text', 'default_value' => 'Laboratories'),
            array('key' => 'field_lab_cta_para', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'lab_cta_para', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Experience firsthand how our state-of-the-art laboratories foster scientific curiosity and innovation among students.'),
            array('key' => 'field_lab_cta_btn_icon', 'label' => __('Button Icon', 'mlzs'), 'name' => 'lab_cta_btn_icon', 'type' => 'text', 'default_value' => 'image'),
            array('key' => 'field_lab_cta_btn_link', 'label' => __('Button Link', 'mlzs'), 'name' => 'lab_cta_btn_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link popup mein "Link Text" = button label (e.g. View Gallery).', 'mlzs')),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'lab.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_lab_field_group');
