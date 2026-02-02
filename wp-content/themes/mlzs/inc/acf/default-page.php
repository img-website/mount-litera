<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ACF Pro: Default Page Template – Hero (heading, subtext, background)
 * For pages using Default template (e.g. Terms & Conditions).
 */
function mlzs_acf_default_page_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'      => 'group_mlzs_default_page',
        'title'    => __('Page Hero', 'mlzs'),
        'fields'   => array(
            array('key' => 'field_dp_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key'           => 'field_dp_hero_heading',
                'label'         => __('Hero Heading', 'mlzs'),
                'name'          => 'default_page_hero_heading',
                'type'          => 'text',
                'instructions'  => __('Leave empty to use page title.', 'mlzs'),
            ),
            array(
                'key'  => 'field_dp_hero_subtext',
                'label'=> __('Hero Subtext', 'mlzs'),
                'name' => 'default_page_hero_subtext',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key'          => 'field_dp_hero_bg',
                'label'        => __('Background Image', 'mlzs'),
                'name'         => 'default_page_hero_bg_image',
                'type'         => 'image',
                'return_format'=> 'array',
                'preview_size' => 'medium',
            ),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'default')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_default_page_field_group');
