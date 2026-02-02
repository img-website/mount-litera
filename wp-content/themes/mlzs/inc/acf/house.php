<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: House System Page – Hero, Intro, 4 Houses (Blue/Green/Red/Ochre), Points & Achievements
 */
function mlzs_acf_house_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_house',
        'title'                 => __('House System Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_house_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_house_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'house_hero_badge', 'type' => 'text', 'default_value' => 'School Life'),
            array('key' => 'field_house_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'house_hero_icon', 'type' => 'text', 'default_value' => 'home'),
            array('key' => 'field_house_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'house_hero_headline', 'type' => 'text', 'default_value' => 'House'),
            array('key' => 'field_house_hero_highlight', 'label' => __('Headline (highlighted word)', 'mlzs'), 'name' => 'house_hero_highlight', 'type' => 'text', 'default_value' => 'System'),
            array('key' => 'field_house_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'house_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Fostering leadership, teamwork, and healthy competition through our four-house system, each named after legendary individuals who shaped history.'),
            array('key' => 'field_house_hero_pills', 'label' => __('House Pills (Hero)', 'mlzs'), 'name' => 'house_hero_pills', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add Pill', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_house_pill_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Blue House'),
                array('key' => 'field_house_pill_dot', 'label' => __('Dot Color (Tailwind)', 'mlzs'), 'name' => 'dot_color', 'type' => 'text', 'default_value' => 'bg-blue-500', 'instructions' => 'e.g. bg-blue-500, bg-green-500, bg-red-500, bg-yellow-500'),
            )),
            array('key' => 'field_house_tab_intro', 'label' => __('Introduction Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_house_intro_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'house_intro_badge', 'type' => 'text', 'default_value' => 'Our Philosophy'),
            array('key' => 'field_house_intro_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'house_intro_icon', 'type' => 'text', 'default_value' => 'users'),
            array('key' => 'field_house_intro_heading', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'house_intro_heading', 'type' => 'text', 'default_value' => 'Building Character Through'),
            array('key' => 'field_house_intro_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'house_intro_highlight', 'type' => 'text', 'default_value' => 'Healthy Competition'),
            array('key' => 'field_house_intro_para1', 'label' => __('Paragraph 1', 'mlzs'), 'name' => 'house_intro_para1', 'type' => 'textarea', 'rows' => 4, 'default_value' => 'All students in the school are divided into four Houses, named after individuals who contributed to a larger cause. They were rational thinkers whose actions were driven by reason rather than assumption. They were ethical and sensitive human beings who were not afraid to do what was right.'),
            array('key' => 'field_house_intro_para2', 'label' => __('Paragraph 2', 'mlzs'), 'name' => 'house_intro_para2', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Each house represents a different field - science, arts, philosophy, or exploration - allowing every student to realize their unique potential, bring about positive changes, and build a harmonious society.'),
            array('key' => 'field_house_intro_image', 'label' => __('Right Image', 'mlzs'), 'name' => 'house_intro_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_house_intro_overlay_icon', 'label' => __('Overlay Icon', 'mlzs'), 'name' => 'house_intro_overlay_icon', 'type' => 'text', 'default_value' => 'award'),
            array('key' => 'field_house_intro_overlay_title', 'label' => __('Overlay Title', 'mlzs'), 'name' => 'house_intro_overlay_title', 'type' => 'text', 'default_value' => 'Inter-House Competitions'),
            array('key' => 'field_house_intro_overlay_subtitle', 'label' => __('Overlay Subtitle', 'mlzs'), 'name' => 'house_intro_overlay_subtitle', 'type' => 'text', 'default_value' => 'Sports • Arts • Academics • Leadership'),
            array('key' => 'field_house_tab_blocks', 'label' => __('House Blocks (4 Houses)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_house_blocks', 'label' => __('Houses', 'mlzs'), 'name' => 'house_blocks', 'type' => 'repeater', 'layout' => 'block', 'min' => 4, 'max' => 4, 'button_label' => __('Add House', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_house_block_name', 'label' => __('House Name', 'mlzs'), 'name' => 'name', 'type' => 'text', 'default_value' => 'Blue House'),
                array('key' => 'field_house_block_color', 'label' => __('Color Theme', 'mlzs'), 'name' => 'color', 'type' => 'select', 'choices' => array('blue' => 'Blue', 'green' => 'Green', 'red' => 'Red', 'yellow' => 'Yellow'), 'default_value' => 'blue'),
                array('key' => 'field_house_block_image', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_house_block_card_icon', 'label' => __('Card Icon (on image)', 'mlzs'), 'name' => 'card_icon', 'type' => 'text', 'default_value' => 'compass'),
                array('key' => 'field_house_block_card_subtitle', 'label' => __('Card Subtitle (on image)', 'mlzs'), 'name' => 'card_subtitle', 'type' => 'text', 'default_value' => 'Exploration & Discovery'),
                array('key' => 'field_house_block_badge_icon', 'label' => __('Content Badge Icon', 'mlzs'), 'name' => 'badge_icon', 'type' => 'text', 'default_value' => 'navigation'),
                array('key' => 'field_house_block_badge_text', 'label' => __('Namesake (badge)', 'mlzs'), 'name' => 'badge_text', 'type' => 'text', 'default_value' => 'Christopher Columbus'),
                array('key' => 'field_house_block_heading', 'label' => __('Heading with dates', 'mlzs'), 'name' => 'heading', 'type' => 'text', 'default_value' => 'Christopher Columbus (1451-1506)'),
                array('key' => 'field_house_block_content', 'label' => __('Content (paragraphs)', 'mlzs'), 'name' => 'content', 'type' => 'wysiwyg'),
                array('key' => 'field_house_block_values', 'label' => __('House Values (tags)', 'mlzs'), 'name' => 'values', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Value', 'mlzs'), 'sub_fields' => array(
                    array('key' => 'field_house_block_value_label', 'label' => __('Value', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Courage'),
                )),
                array('key' => 'field_house_block_image_order', 'label' => __('Image Position', 'mlzs'), 'name' => 'image_position', 'type' => 'select', 'choices' => array('left' => 'Left', 'right' => 'Right'), 'default_value' => 'left'),
            )),
            array('key' => 'field_house_tab_points', 'label' => __('Points & Achievements', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_house_points_badge', 'label' => __('Section Badge', 'mlzs'), 'name' => 'house_points_badge', 'type' => 'text', 'default_value' => 'Current Standings'),
            array('key' => 'field_house_points_icon', 'label' => __('Section Badge Icon', 'mlzs'), 'name' => 'house_points_icon', 'type' => 'text', 'default_value' => 'trophy'),
            array('key' => 'field_house_points_heading', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'house_points_heading', 'type' => 'text', 'default_value' => 'House'),
            array('key' => 'field_house_points_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'house_points_highlight', 'type' => 'text', 'default_value' => 'Points & Achievements'),
            array('key' => 'field_house_points_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'house_points_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Track the ongoing competition between houses through various academic, sports, and cultural events'),
            array('key' => 'field_house_points_cards', 'label' => __('Points Cards (4)', 'mlzs'), 'name' => 'house_points_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 4, 'max' => 4, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_house_points_card_name', 'label' => __('House Name', 'mlzs'), 'name' => 'house_name', 'type' => 'text', 'default_value' => 'Blue House'),
                array('key' => 'field_house_points_card_namesake', 'label' => __('Namesake', 'mlzs'), 'name' => 'namesake', 'type' => 'text', 'default_value' => 'Christopher Columbus'),
                array('key' => 'field_house_points_card_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'compass'),
                array('key' => 'field_house_points_card_color', 'label' => __('Color Theme', 'mlzs'), 'name' => 'color', 'type' => 'select', 'choices' => array('blue' => 'Blue', 'green' => 'Green', 'red' => 'Red', 'yellow' => 'Yellow'), 'default_value' => 'blue'),
                array('key' => 'field_house_points_card_total', 'label' => __('Total Points', 'mlzs'), 'name' => 'total_points', 'type' => 'text', 'default_value' => '1,250'),
                array('key' => 'field_house_points_card_academic', 'label' => __('Academic Events', 'mlzs'), 'name' => 'academic', 'type' => 'text', 'default_value' => '420'),
                array('key' => 'field_house_points_card_sports', 'label' => __('Sports Events', 'mlzs'), 'name' => 'sports', 'type' => 'text', 'default_value' => '380'),
                array('key' => 'field_house_points_card_cultural', 'label' => __('Cultural Events', 'mlzs'), 'name' => 'cultural', 'type' => 'text', 'default_value' => '450'),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'house.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_house_field_group');
