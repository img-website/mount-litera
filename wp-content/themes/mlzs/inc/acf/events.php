<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Events Page - Hero and Events tabs data
 */
function mlzs_acf_events_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_mlzs_events_page',
        'title' => __('Events Page Sections', 'mlzs'),
        'fields' => array(
            array('key' => 'field_events_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_events_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'events_hero_badge', 'type' => 'text', 'default_value' => 'School Calendar'),
            array('key' => 'field_events_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'events_hero_icon', 'type' => 'text', 'default_value' => 'calendar-days'),
            array('key' => 'field_events_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'events_hero_headline', 'type' => 'text', 'default_value' => 'School'),
            array('key' => 'field_events_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'events_hero_highlight', 'type' => 'text', 'default_value' => 'Events'),
            array('key' => 'field_events_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'events_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Stay updated with all upcoming and completed school events at Mount Litera Zee School.'),

            array('key' => 'field_events_tab_events', 'label' => __('Events Data', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_events_section_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'events_section_icon', 'type' => 'text', 'default_value' => 'calendar-check-2'),
            array('key' => 'field_events_section_title', 'label' => __('Section Title', 'mlzs'), 'name' => 'events_section_title', 'type' => 'text', 'default_value' => 'Events'),
            array('key' => 'field_events_section_subtitle', 'label' => __('Section Subtitle', 'mlzs'), 'name' => 'events_section_subtitle', 'type' => 'text', 'default_value' => 'Explore upcoming and completed school events'),
            array(
                'key' => 'field_events_items',
                'label' => __('Events List', 'mlzs'),
                'name' => 'events_items',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => __('Add Event', 'mlzs'),
                'sub_fields' => array(
                    array(
                        'key' => 'field_events_item_image',
                        'label' => __('Event Image/Banner', 'mlzs'),
                        'name' => 'event_image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                        'library' => 'all',
                    ),
                    array(
                        'key' => 'field_events_item_title',
                        'label' => __('Event Title', 'mlzs'),
                        'name' => 'event_title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_events_item_date',
                        'label' => __('Event Date', 'mlzs'),
                        'name' => 'event_date',
                        'type' => 'date_picker',
                        'display_format' => 'd/m/Y',
                        'return_format' => 'Ymd',
                        'first_day' => 1,
                        'instructions' => __('Future date = Upcoming Events tab. Today/past date = Events tab.', 'mlzs'),
                    ),
                ),
            ),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'events.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_events_field_group');
