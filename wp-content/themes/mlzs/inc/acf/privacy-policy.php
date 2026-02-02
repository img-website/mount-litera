<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ACF Pro: Privacy Policy Page – Hero (heading, subtext, background)
 */
function mlzs_acf_privacy_policy_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'      => 'group_mlzs_privacy_policy',
        'title'    => __('Privacy Policy Hero', 'mlzs'),
        'fields'   => array(
            array('key' => 'field_pp_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key'           => 'field_pp_hero_heading',
                'label'         => __('Hero Heading', 'mlzs'),
                'name'          => 'privacy_hero_heading',
                'type'          => 'text',
                'instructions'  => __('Leave empty to use page title.', 'mlzs'),
                'default_value' => 'Privacy Policy',
            ),
            array(
                'key'  => 'field_pp_hero_subtext',
                'label'=> __('Hero Subtext', 'mlzs'),
                'name' => 'privacy_hero_subtext',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key'          => 'field_pp_hero_bg',
                'label'        => __('Background Image', 'mlzs'),
                'name'         => 'privacy_hero_bg_image',
                'type'         => 'image',
                'return_format'=> 'array',
                'preview_size' => 'medium',
            ),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'privacy-policy.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_privacy_policy_field_group');
