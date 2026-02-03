<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Alumni Feed Page – Hero, Alumni gallery, Suggestions form, Stats
 */
function mlzs_acf_feed_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_feed',
        'title'                 => __('Alumni Feed Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_feed_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_feed_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'feed_hero_badge', 'type' => 'text', 'default_value' => 'Alumni Network'),
            array('key' => 'field_feed_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'feed_hero_icon', 'type' => 'text', 'default_value' => 'users'),
            array('key' => 'field_feed_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'feed_hero_headline', 'type' => 'text', 'default_value' => 'Alumni'),
            array('key' => 'field_feed_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'feed_hero_highlight', 'type' => 'text', 'default_value' => 'Feed'),
            array('key' => 'field_feed_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'feed_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Celebrating the achievements of our alumni who continue to inspire and make us proud across the globe'),
            array('key' => 'field_feed_hero_badge_icon_color', 'label' => __('Hero Badge Icon Color Class', 'mlzs'), 'name' => 'feed_hero_badge_icon_color', 'type' => 'text', 'default_value' => 'text-accent', 'instructions' => __('Tailwind class, e.g. text-accent', 'mlzs')),
            array('key' => 'field_feed_hero_highlight_color', 'label' => __('Hero Headline Highlight Color Class', 'mlzs'), 'name' => 'feed_hero_highlight_color', 'type' => 'text', 'default_value' => 'text-transparent bg-clip-text bg-gradient-to-r from-amber-flame to-tiger-orange', 'instructions' => __('Tailwind classes for the highlighted word', 'mlzs')),
            array('key' => 'field_feed_hero_subheadline_color', 'label' => __('Hero Subheadline Color Class', 'mlzs'), 'name' => 'feed_hero_subheadline_color', 'type' => 'text', 'default_value' => 'text-slate-200', 'instructions' => __('Tailwind class', 'mlzs')),
            array('key' => 'field_feed_tab_alumni', 'label' => __('Alumni Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_feed_section_badge', 'label' => __('Section Badge', 'mlzs'), 'name' => 'feed_section_badge', 'type' => 'text', 'default_value' => 'Our Alumni Network'),
            array('key' => 'field_feed_section_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'feed_section_icon', 'type' => 'text', 'default_value' => 'users'),
            array('key' => 'field_feed_section_heading', 'label' => __('Section Heading (before highlight)', 'mlzs'), 'name' => 'feed_section_heading', 'type' => 'text', 'default_value' => 'Mount Litera'),
            array('key' => 'field_feed_section_highlight', 'label' => __('Section Heading (highlighted)', 'mlzs'), 'name' => 'feed_section_highlight', 'type' => 'text', 'default_value' => 'Alumni'),
            array('key' => 'field_feed_section_description', 'label' => __('Section Description', 'mlzs'), 'name' => 'feed_section_description', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Celebrating the achievements of our alumni who continue to inspire and make us proud across the globe.'),
            array('key' => 'field_feed_section_badge_color', 'label' => __('Section Badge Color Class', 'mlzs'), 'name' => 'feed_section_badge_color', 'type' => 'text', 'default_value' => 'text-primary', 'instructions' => __('Tailwind class for badge text/icon', 'mlzs')),
            array('key' => 'field_feed_section_heading_color', 'label' => __('Section Heading (normal) Color Class', 'mlzs'), 'name' => 'feed_section_heading_color', 'type' => 'text', 'default_value' => 'text-text-main-light', 'instructions' => __('Tailwind class', 'mlzs')),
            array('key' => 'field_feed_section_highlight_color', 'label' => __('Section Heading Highlight Color Class', 'mlzs'), 'name' => 'feed_section_highlight_color', 'type' => 'text', 'default_value' => 'text-transparent bg-clip-text bg-gradient-to-r from-primary to-primary-light', 'instructions' => __('Tailwind classes for highlighted word', 'mlzs')),
            array('key' => 'field_feed_section_description_color', 'label' => __('Section Description Color Class', 'mlzs'), 'name' => 'feed_section_description_color', 'type' => 'text', 'default_value' => 'text-text-secondary-light', 'instructions' => __('Tailwind class', 'mlzs')),
            array('key' => 'field_feed_gallery', 'label' => __('Alumni Gallery Items', 'mlzs'), 'name' => 'feed_gallery', 'type' => 'repeater', 'layout' => 'block', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_feed_gal_image', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
                array('key' => 'field_feed_gal_alt', 'label' => __('Alt Text', 'mlzs'), 'name' => 'alt', 'type' => 'text'),
                array('key' => 'field_feed_gal_title', 'label' => __('Caption Title', 'mlzs'), 'name' => 'caption_title', 'type' => 'text'),
                array('key' => 'field_feed_gal_subtitle', 'label' => __('Caption Subtitle', 'mlzs'), 'name' => 'caption_subtitle', 'type' => 'text'),
                array('key' => 'field_feed_gal_new_badge', 'label' => __('Show "New" badge', 'mlzs'), 'name' => 'show_new_badge', 'type' => 'true_false', 'ui' => 1, 'default_value' => 0),
                array('key' => 'field_feed_gal_span_two', 'label' => __('Span 2 columns (wide)', 'mlzs'), 'name' => 'span_two', 'type' => 'true_false', 'ui' => 1, 'default_value' => 0),
            )),
            array('key' => 'field_feed_tab_form', 'label' => __('Suggestions Form', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_feed_form_badge', 'label' => __('Form Badge Text', 'mlzs'), 'name' => 'feed_form_badge', 'type' => 'text', 'default_value' => 'Share Your Voice'),
            array('key' => 'field_feed_form_icon', 'label' => __('Form Badge Icon', 'mlzs'), 'name' => 'feed_form_icon', 'type' => 'text', 'default_value' => 'message-square'),
            array('key' => 'field_feed_form_title', 'label' => __('Form Title', 'mlzs'), 'name' => 'feed_form_title', 'type' => 'text', 'default_value' => 'Suggestions & Feedback'),
            array('key' => 'field_feed_form_subtitle', 'label' => __('Form Subtitle', 'mlzs'), 'name' => 'feed_form_subtitle', 'type' => 'text', 'default_value' => 'Your suggestions help us improve. Share your thoughts with us.'),
            array('key' => 'field_feed_form_privacy', 'label' => __('Privacy Note (below submit)', 'mlzs'), 'name' => 'feed_form_privacy', 'type' => 'text', 'default_value' => 'Your suggestions are confidential and will be used to improve our services.'),
            array('key' => 'field_feed_form_submit_text', 'label' => __('Submit Button Text', 'mlzs'), 'name' => 'feed_form_submit_text', 'type' => 'text', 'default_value' => 'Send Suggestion'),
            array('key' => 'field_feed_form_submit_icon', 'label' => __('Submit Button Icon', 'mlzs'), 'name' => 'feed_form_submit_icon', 'type' => 'text', 'default_value' => 'send'),
            array('key' => 'field_feed_form_badge_color', 'label' => __('Form Badge & Icon Color Class', 'mlzs'), 'name' => 'feed_form_badge_color', 'type' => 'text', 'default_value' => 'text-accent', 'instructions' => __('Tailwind class', 'mlzs')),
            array('key' => 'field_feed_form_title_color', 'label' => __('Form Title Color Class', 'mlzs'), 'name' => 'feed_form_title_color', 'type' => 'text', 'default_value' => 'text-white', 'instructions' => __('Tailwind class', 'mlzs')),
            array('key' => 'field_feed_form_subtitle_color', 'label' => __('Form Subtitle Color Class', 'mlzs'), 'name' => 'feed_form_subtitle_color', 'type' => 'text', 'default_value' => 'text-slate-300', 'instructions' => __('Tailwind class', 'mlzs')),
            array('key' => 'field_feed_form_privacy_color', 'label' => __('Form Privacy Note Color Class', 'mlzs'), 'name' => 'feed_form_privacy_color', 'type' => 'text', 'default_value' => 'text-slate-400', 'instructions' => __('Tailwind class', 'mlzs')),
            array('key' => 'field_feed_tab_stats', 'label' => __('Alumni Stats', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_feed_stats', 'label' => __('Stats (number + label)', 'mlzs'), 'name' => 'feed_stats', 'type' => 'repeater', 'min' => 0, 'max' => 6, 'layout' => 'table', 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_feed_stat_number', 'label' => __('Number/Text', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                array('key' => 'field_feed_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
                array('key' => 'field_feed_stat_number_color', 'label' => __('Number Color Class', 'mlzs'), 'name' => 'number_color', 'type' => 'text', 'default_value' => '', 'instructions' => __('e.g. text-primary, text-accent, text-primary-light, text-accent-dark. Blank = default by position.', 'mlzs')),
                array('key' => 'field_feed_stat_label_color', 'label' => __('Label Color Class', 'mlzs'), 'name' => 'label_color', 'type' => 'text', 'default_value' => '', 'instructions' => __('e.g. text-text-secondary-light. Blank = default.', 'mlzs')),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'feed.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_feed_field_group');
