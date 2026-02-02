<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Sitemap Page – Hero only. Page list is auto-generated from all published pages.
 */
function mlzs_acf_sitemap_field_group() {
    if (!function_exists('acf_add_local_field_group')) return;
    acf_add_local_field_group(array(
        'key' => 'group_mlzs_sitemap',
        'title' => __('Sitemap Page (Hero)', 'mlzs'),
        'fields' => array(
            array('key' => 'field_sitemap_tab_hero', 'label' => __('Hero', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_sitemap_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'sitemap_hero_badge', 'type' => 'text', 'default_value' => 'Site Map'),
            array('key' => 'field_sitemap_hero_headline', 'label' => __('Headline', 'mlzs'), 'name' => 'sitemap_hero_headline', 'type' => 'text', 'default_value' => 'Site'),
            array('key' => 'field_sitemap_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'sitemap_hero_highlight', 'type' => 'text', 'default_value' => 'Map'),
            array('key' => 'field_sitemap_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'sitemap_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Explore all pages of Mount Litera Zee School website. Find information about academics, facilities, admissions, and more.'),
        ),
        'location' => array(array(array('param' => 'page_template', 'operator' => '==', 'value' => 'sitemap.php'))),
    ));
}
add_action('acf/init', 'mlzs_acf_sitemap_field_group');
