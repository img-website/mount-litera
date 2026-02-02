<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Gallery Page – Hero, Photo Gallery (masonry)
 */
function mlzs_acf_gallery_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_gallery',
        'title'                 => __('Gallery Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_gal_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_gal_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'gallery_hero_badge', 'type' => 'text', 'default_value' => 'Memories'),
            array('key' => 'field_gal_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'gallery_hero_icon', 'type' => 'text', 'default_value' => 'images'),
            array('key' => 'field_gal_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'gallery_hero_headline', 'type' => 'text', 'default_value' => 'Photo'),
            array('key' => 'field_gal_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'gallery_hero_highlight', 'type' => 'text', 'default_value' => 'Gallery'),
            array('key' => 'field_gal_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'gallery_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Capturing moments of excellence, creativity, and achievement at Mount Litera Zee School'),
            array('key' => 'field_gal_tab_gallery', 'label' => __('Photo Gallery', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_gal_images', 'label' => __('Gallery Images', 'mlzs'), 'name' => 'gallery_images', 'type' => 'gallery', 'return_format' => 'id', 'preview_size' => 'medium', 'library' => 'all', 'min' => 0, 'max' => 0, 'instructions' => __('Add images for the masonry gallery. Order is preserved.')),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'gallery.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_gallery_field_group');
