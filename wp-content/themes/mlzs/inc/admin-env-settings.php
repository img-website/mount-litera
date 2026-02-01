<?php
/**
 * Settings > Env – API keys via ACF (tabs).
 * Keys stored in wp_options via ACF, not wp-config.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Env options sub page under Settings.
 */
function mlzs_env_acf_options_page() {
    if (!function_exists('acf_add_options_sub_page')) {
        return;
    }
    acf_add_options_sub_page(array(
        'page_title'  => __('Environment Keys', 'mlzs'),
        'menu_title'  => __('Env', 'mlzs'),
        'menu_slug'   => 'acf-options-env',
        'parent_slug' => 'options-general.php',
        'post_id'     => 'acf-options-env',
        'capability'  => 'manage_options',
    ));
}
add_action('acf/init', 'mlzs_env_acf_options_page');

/**
 * ACF Field Group: Env (Options Page) – Tabs + API key fields.
 */
function mlzs_acf_env_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'    => 'group_mlzs_env',
        'title'  => __('Environment Keys', 'mlzs'),
        'fields' => array(
            array('key' => 'field_env_tab_youtube', 'label' => __('YouTube API', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key'           => 'field_env_youtube_api_key',
                'label'         => __('YouTube API Key', 'mlzs'),
                'name'          => 'mlzs_youtube_api_key',
                'type'          => 'text',
                'instructions'  => __('Used for fetching video duration and title (e.g. on Campus / Origin page). Get your key from Google Cloud Console.', 'mlzs'),
                'placeholder'   => 'AIzaSy...',
            ),
            array('key' => 'field_env_tab_google_maps', 'label' => __('Google Maps API', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key'           => 'field_env_google_maps_api_key',
                'label'         => __('Google Maps API Key', 'mlzs'),
                'name'          => 'mlzs_google_maps_api_key',
                'type'          => 'text',
                'instructions'  => __('Used for ACF Google Map fields and Reach page map. Enable Maps JavaScript API in Google Cloud Console.', 'mlzs'),
                'placeholder'   => 'AIzaSy...',
            ),
        ),
        'location' => array(
            array(array('param' => 'options_page', 'operator' => '==', 'value' => 'acf-options-env')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_env_field_group');
