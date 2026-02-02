<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Life & Development Page – Hero (ESP cards 4), Intro, Knowledge (4), Life Skills (4), Risk (2 boxes + leader 4), CTA (Link buttons)
 * Image alt = use attachment alt from Media Library; no separate ACF alt field.
 */
function mlzs_acf_life_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_life',
        'title'                 => __('Life & Development Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_life_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_life_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'life_hero_badge', 'type' => 'text', 'default_value' => 'Emergent Student Profile'),
            array('key' => 'field_life_hero_headline', 'label' => __('Headline', 'mlzs'), 'name' => 'life_hero_headline', 'type' => 'text', 'default_value' => 'ESP of Child'),
            array('key' => 'field_life_hero_quote', 'label' => __('Quote', 'mlzs'), 'name' => 'life_hero_quote', 'type' => 'textarea', 'rows' => 2, 'default_value' => '"Knowledge is of no value unless you put it into practice."'),
            array('key' => 'field_life_hero_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'life_hero_paragraph', 'type' => 'textarea', 'rows' => 4, 'default_value' => 'Emergent Student Profile is our promise and our goal. Everything we do in the school strives to achieve this for each child. While each child will take a different path towards this profile, we run the school with the firm belief that it is this profile that will enable our children to be leaders of the 21st century.'),
            array('key' => 'field_life_hero_cards', 'label' => __('ESP Cards (4)', 'mlzs'), 'name' => 'life_hero_cards', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_life_hero_card_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'brain'),
                array('key' => 'field_life_hero_card_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Knowledge'),
                array('key' => 'field_life_hero_card_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'subtitle', 'type' => 'text', 'default_value' => 'Higher order thinking & real understanding'),
            )),
            array('key' => 'field_life_tab_intro', 'label' => __('Introduction', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_life_intro_heading_before', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'life_intro_heading_before', 'type' => 'text', 'default_value' => 'Our Philosophy:'),
            array('key' => 'field_life_intro_heading_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'life_intro_heading_highlight', 'type' => 'text', 'default_value' => 'Child at the Center'),
            array('key' => 'field_life_intro_para1', 'label' => __('Paragraph 1', 'mlzs'), 'name' => 'life_intro_para1', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_life_intro_para2', 'label' => __('Paragraph 2', 'mlzs'), 'name' => 'life_intro_para2', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_life_intro_para3', 'label' => __('Paragraph 3', 'mlzs'), 'name' => 'life_intro_para3', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_life_intro_mantra_heading', 'label' => __('Mantra Card Heading', 'mlzs'), 'name' => 'life_intro_mantra_heading', 'type' => 'text', 'default_value' => 'Our Mantra'),
            array('key' => 'field_life_intro_mantra_icon', 'label' => __('Mantra Card Icon', 'mlzs'), 'name' => 'life_intro_mantra_icon', 'type' => 'text', 'default_value' => 'star'),
            array('key' => 'field_life_intro_mantra_quote', 'label' => __('Mantra Quote', 'mlzs'), 'name' => 'life_intro_mantra_quote', 'type' => 'textarea', 'rows' => 2, 'default_value' => '"This is the mantra through which we place the child at the centre of everything that we do & ensures single-minded devotion to the growth & development."'),
            array('key' => 'field_life_intro_life_skills_heading', 'label' => __('Life Skills Box Heading', 'mlzs'), 'name' => 'life_intro_life_skills_heading', 'type' => 'text', 'default_value' => 'Life Skills Education'),
            array('key' => 'field_life_intro_life_skills_para', 'label' => __('Life Skills Box Paragraph', 'mlzs'), 'name' => 'life_intro_life_skills_para', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Life skills education is the study of abilities for adaptive & positive behavior that enable individuals to deal effectively with the demands & the challenges of everyday life.'),
            array('key' => 'field_life_tab_knowledge', 'label' => __('Knowledge Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_life_knowledge_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'life_knowledge_badge', 'type' => 'text', 'default_value' => 'Pillar 01'),
            array('key' => 'field_life_knowledge_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'life_knowledge_heading', 'type' => 'text', 'default_value' => 'Knowledge Acquisition'),
            array('key' => 'field_life_knowledge_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'life_knowledge_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Our students will gain comprehensive knowledge across multiple domains to become well-rounded individuals'),
            array('key' => 'field_life_knowledge_cards', 'label' => __('Cards (4)', 'mlzs'), 'name' => 'life_knowledge_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 4, 'max' => 4, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_life_know_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'brain'),
                array('key' => 'field_life_know_style', 'label' => __('Icon Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'secondary' => 'Secondary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
                array('key' => 'field_life_know_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Higher Order Thinking Skills'),
                array('key' => 'field_life_know_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 3),
                array('key' => 'field_life_know_link', 'label' => __('Card Link (optional)', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Learn More).', 'mlzs')),
                array('key' => 'field_life_know_link_icon', 'label' => __('Link Icon', 'mlzs'), 'name' => 'link_icon', 'type' => 'text', 'default_value' => 'arrow-right'),
            )),
            array('key' => 'field_life_tab_lifeskills', 'label' => __('Life Skills Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_life_lifeskills_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'life_lifeskills_badge', 'type' => 'text', 'default_value' => 'Pillar 02'),
            array('key' => 'field_life_lifeskills_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'life_lifeskills_heading', 'type' => 'text', 'default_value' => 'Life Skills Development'),
            array('key' => 'field_life_lifeskills_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'life_lifeskills_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Our students will emerge out of school with essential life skills for success in the 21st century'),
            array('key' => 'field_life_lifeskills_items', 'label' => __('Skill Cards (4)', 'mlzs'), 'name' => 'life_lifeskills_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 4, 'max' => 4, 'button_label' => __('Add Skill', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_life_skill_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                array('key' => 'field_life_skill_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Effective Habits'),
                array('key' => 'field_life_skill_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 3),
                array('key' => 'field_life_skill_tags', 'label' => __('Tags (comma-separated)', 'mlzs'), 'name' => 'tags', 'type' => 'text', 'instructions' => __('e.g. Discipline, Time Management, Proactivity', 'mlzs')),
            )),
            array('key' => 'field_life_tab_risk', 'label' => __('Risk & Self-Management', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_life_risk_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'life_risk_badge', 'type' => 'text', 'default_value' => 'Pillar 03'),
            array('key' => 'field_life_risk_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'life_risk_heading', 'type' => 'text', 'default_value' => 'Risk Taking & Self-Management'),
            array('key' => 'field_life_risk_box1_title', 'label' => __('Box 1 Title', 'mlzs'), 'name' => 'life_risk_box1_title', 'type' => 'text', 'default_value' => 'The Courage to Decide'),
            array('key' => 'field_life_risk_box1_icon', 'label' => __('Box 1 Icon', 'mlzs'), 'name' => 'life_risk_box1_icon', 'type' => 'text', 'default_value' => 'shield-alert'),
            array('key' => 'field_life_risk_box1_para', 'label' => __('Box 1 Paragraph', 'mlzs'), 'name' => 'life_risk_box1_para', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_life_risk_box2_title', 'label' => __('Box 2 Title', 'mlzs'), 'name' => 'life_risk_box2_title', 'type' => 'text', 'default_value' => 'Self-Management'),
            array('key' => 'field_life_risk_box2_icon', 'label' => __('Box 2 Icon', 'mlzs'), 'name' => 'life_risk_box2_icon', 'type' => 'text', 'default_value' => 'user-cog'),
            array('key' => 'field_life_risk_box2_para', 'label' => __('Box 2 Paragraph', 'mlzs'), 'name' => 'life_risk_box2_para', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_life_risk_box2_tags', 'label' => __('Box 2 Tags (comma-separated)', 'mlzs'), 'name' => 'life_risk_box2_tags', 'type' => 'text', 'default_value' => 'Goal Setting, Self-Monitoring, Responsibility'),
            array('key' => 'field_life_risk_leader_title', 'label' => __('Leader Card Title', 'mlzs'), 'name' => 'life_risk_leader_title', 'type' => 'text', 'default_value' => 'The 21st Century Leader'),
            array('key' => 'field_life_risk_leader_icon', 'label' => __('Leader Card Header Icon', 'mlzs'), 'name' => 'life_risk_leader_icon', 'type' => 'text', 'default_value' => 'target'),
            array('key' => 'field_life_risk_leader_subtitle', 'label' => __('Leader Card Subtitle', 'mlzs'), 'name' => 'life_risk_leader_subtitle', 'type' => 'text', 'default_value' => 'Our Emergent Student Profile'),
            array('key' => 'field_life_risk_leader_items', 'label' => __('Leader Card Items (4)', 'mlzs'), 'name' => 'life_risk_leader_items', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_life_leader_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'lightbulb'),
                array('key' => 'field_life_leader_style', 'label' => __('Icon Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary-light' => 'Primary Light', 'secondary' => 'Secondary', 'accent' => 'Accent', 'primary-light-2' => 'Primary Light 2'), 'default_value' => 'primary-light'),
                array('key' => 'field_life_leader_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Innovative Thinker'),
                array('key' => 'field_life_leader_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'subtitle', 'type' => 'text', 'default_value' => 'Creates new solutions to complex problems'),
            )),
            array('key' => 'field_life_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_life_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'life_cta_heading', 'type' => 'text', 'default_value' => 'Join Us in Shaping Future Leaders'),
            array('key' => 'field_life_cta_para', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'life_cta_para', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'At Mount Litera Zee School, we don\'t just teach subjects - we build character, instill values, and develop life skills that prepare children for success in the 21st century.'),
            array('key' => 'field_life_cta_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'life_cta_btn1_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Explore Our Curriculum).', 'mlzs')),
            array('key' => 'field_life_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'life_cta_btn1_icon', 'type' => 'text', 'default_value' => 'book-open'),
            array('key' => 'field_life_cta_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'life_cta_btn2_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Schedule a Campus Visit).', 'mlzs')),
            array('key' => 'field_life_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'life_cta_btn2_icon', 'type' => 'text', 'default_value' => 'calendar'),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'life.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_life_field_group');
