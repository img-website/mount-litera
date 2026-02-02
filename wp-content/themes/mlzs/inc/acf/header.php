<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Field Group: Header (Options Page) – Bar: left max 3, right max 2; Full menu: nested max 4 levels
 */
function mlzs_acf_header_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'    => 'group_mlzs_header',
        'title'  => __('Header Content', 'mlzs'),
        'fields' => array(
            array('key' => 'field_header_tab_bar', 'label' => __('Bar (Logo + Left/Right)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key'   => 'field_header_logo',
                'label' => __('Logo', 'mlzs'),
                'name'  => 'header_logo',
                'type'  => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
                'instructions' => __('Leave empty to use theme logo.', 'mlzs'),
            ),
            array(
                'key'   => 'field_header_left_menu',
                'label' => __('Left Menu (max 3)', 'mlzs'),
                'name'  => 'header_left_menu',
                'type'  => 'repeater',
                'min'   => 0,
                'max'   => 3,
                'layout' => 'table',
                'button_label' => __('Add Link', 'mlzs'),
                'sub_fields' => array(
                    array('key' => 'field_header_left_link', 'label' => __('Link', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array'),
                ),
            ),
            array(
                'key'   => 'field_header_right_menu',
                'label' => __('Right Menu (max 2)', 'mlzs'),
                'name'  => 'header_right_menu',
                'type'  => 'repeater',
                'min'   => 0,
                'max'   => 2,
                'layout' => 'table',
                'button_label' => __('Add Link', 'mlzs'),
                'sub_fields' => array(
                    array('key' => 'field_header_right_link', 'label' => __('Link', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array'),
                ),
            ),
            array('key' => 'field_header_tab_full', 'label' => __('Full Menu (Overlay)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key'   => 'field_header_full_menu',
                'label' => __('Explore Menu (nested, max 4 levels)', 'mlzs'),
                'name'  => 'header_full_menu',
                'type'  => 'repeater',
                'layout' => 'block',
                'button_label' => __('Add Item', 'mlzs'),
                'sub_fields' => array(
                    array('key' => 'field_header_full_link', 'label' => __('Link', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array'),
                    array(
                        'key'   => 'field_header_full_children',
                        'label' => __('Submenu (Level 2)', 'mlzs'),
                        'name'  => 'children',
                        'type'  => 'repeater',
                        'layout' => 'block',
                        'button_label' => __('Add', 'mlzs'),
                        'sub_fields' => array(
                            array('key' => 'field_header_full_link_2', 'label' => __('Link', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array'),
                            array(
                                'key'   => 'field_header_full_children_3',
                                'label' => __('Submenu (Level 3)', 'mlzs'),
                                'name'  => 'children',
                                'type'  => 'repeater',
                                'layout' => 'block',
                                'button_label' => __('Add', 'mlzs'),
                                'sub_fields' => array(
                                    array('key' => 'field_header_full_link_3', 'label' => __('Link', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array'),
                                    array(
                                        'key'   => 'field_header_full_children_4',
                                        'label' => __('Submenu (Level 4 – last)', 'mlzs'),
                                        'name'  => 'children',
                                        'type'  => 'repeater',
                                        'layout' => 'table',
                                        'button_label' => __('Add', 'mlzs'),
                                        'sub_fields' => array(
                                            array('key' => 'field_header_full_link_4', 'label' => __('Link', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array'),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'key'   => 'field_header_quick_actions',
                'label' => __('Quick Actions', 'mlzs'),
                'name'  => 'header_quick_actions',
                'type'  => 'repeater',
                'layout' => 'table',
                'button_label' => __('Add Link', 'mlzs'),
                'sub_fields' => array(
                    array('key' => 'field_header_quick_link', 'label' => __('Link', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array'),
                ),
            ),
            array('key' => 'field_header_tab_connect', 'label' => __('Connect (Overlay)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_header_connect_heading', 'label' => __('Connect Heading', 'mlzs'), 'name' => 'header_connect_heading', 'type' => 'text', 'default_value' => 'Connect'),
            array('key' => 'field_header_connect_email', 'label' => __('Email', 'mlzs'), 'name' => 'header_connect_email', 'type' => 'text', 'default_value' => 'mlzs.alwar@mountlitera.com'),
            array('key' => 'field_header_connect_phone', 'label' => __('Phone', 'mlzs'), 'name' => 'header_connect_phone', 'type' => 'text', 'default_value' => '+91 9672797979'),
            array(
                'key'   => 'field_header_connect_social_note',
                'label' => __('Social Links', 'mlzs'),
                'name'  => '',
                'type'  => 'message',
                'message' => __('Social links are taken from Footer settings. Edit Footer → Copyright & Social to update icons and URLs for both header overlay and footer.', 'mlzs'),
            ),
        ),
        'location' => array(
            array(array('param' => 'options_page', 'operator' => '==', 'value' => 'acf-options-header')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_header_field_group');
