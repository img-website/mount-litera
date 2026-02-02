<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Options Pages: Header & Footer (site-wide)
 */
function mlzs_acf_options_pages() {
    if (!function_exists('acf_add_options_page')) {
        return;
    }
    acf_add_options_page(array(
        'page_title' => __('Header Settings', 'mlzs'),
        'menu_title' => __('Header', 'mlzs'),
        'menu_slug'  => 'acf-options-header',
        'capability' => 'edit_posts',
        'redirect'   => false,
    ));
    acf_add_options_page(array(
        'page_title' => __('Footer Settings', 'mlzs'),
        'menu_title' => __('Footer', 'mlzs'),
        'menu_slug'  => 'acf-options-footer',
        'capability' => 'edit_posts',
        'redirect'   => false,
    ));
}
add_action('acf/init', 'mlzs_acf_options_pages');
