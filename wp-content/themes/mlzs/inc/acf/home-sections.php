<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Home page — Testimonials, FAQ and Blog sections (all dynamic).
 * Attaches to the Home page template.
 */
function mlzs_acf_home_sections_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key'    => 'group_mlzs_home_sections',
        'title'  => __('Home — Testimonials, FAQ & Blog', 'mlzs'),
        'fields' => array(

            /* ---------------- Testimonials ---------------- */
            array('key' => 'field_home_tm_tab', 'label' => __('Testimonials', 'mlzs'), 'type' => 'tab'),
            array('key' => 'field_home_tm_enabled', 'label' => __('Show Testimonials section', 'mlzs'), 'name' => 'home_tm_enabled', 'type' => 'true_false', 'ui' => 1, 'default_value' => 1),
            array('key' => 'field_home_tm_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'home_tm_badge', 'type' => 'text', 'default_value' => 'Parent Feedback'),
            array('key' => 'field_home_tm_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'home_tm_heading', 'type' => 'text', 'default_value' => 'Real Stories from'),
            array('key' => 'field_home_tm_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'home_tm_highlight', 'type' => 'text', 'default_value' => 'Real Parents'),
            array('key' => 'field_home_tm_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'home_tm_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Hear directly from parents about their experience at Mount Litera Zee School, Alwar.'),
            array(
                'key' => 'field_home_tm_videos', 'label' => __('Video Testimonials', 'mlzs'), 'name' => 'home_tm_videos',
                'type' => 'repeater', 'layout' => 'block', 'button_label' => __('Add Video', 'mlzs'),
                'instructions' => __('Paste a YouTube link or ID. Thumbnail is fetched automatically.', 'mlzs'),
                'sub_fields' => array(
                    array('key' => 'field_home_tm_v_url', 'label' => __('YouTube URL or ID', 'mlzs'), 'name' => 'video_url', 'type' => 'text', 'required' => 1, 'placeholder' => 'https://youtu.be/xxxxxxxxxxx'),
                    array('key' => 'field_home_tm_v_name', 'label' => __('Label', 'mlzs'), 'name' => 'name', 'type' => 'text', 'default_value' => 'Parent Review'),
                    array('key' => 'field_home_tm_v_role', 'label' => __('Sub-label (optional)', 'mlzs'), 'name' => 'role', 'type' => 'text', 'placeholder' => 'e.g. Parent, Class 6'),
                    array('key' => 'field_home_tm_v_thumb', 'label' => __('Custom thumbnail (optional)', 'mlzs'), 'name' => 'thumb', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'),
                ),
            ),
            array('key' => 'field_home_tm_channel', 'label' => __('YouTube channel URL', 'mlzs'), 'name' => 'home_tm_channel', 'type' => 'url', 'default_value' => 'https://www.youtube.com/channel/UCObLRJQu0KZKsIQFfXHz-XQ'),

            /* ---------------- Blog ---------------- */
            array('key' => 'field_home_blog_tab', 'label' => __('Blog', 'mlzs'), 'type' => 'tab'),
            array('key' => 'field_home_blog_enabled', 'label' => __('Show Blog section', 'mlzs'), 'name' => 'home_blog_enabled', 'type' => 'true_false', 'ui' => 1, 'default_value' => 1),
            array('key' => 'field_home_blog_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'home_blog_badge', 'type' => 'text', 'default_value' => 'From Our Blog'),
            array('key' => 'field_home_blog_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'home_blog_heading', 'type' => 'text', 'default_value' => 'Insights &'),
            array('key' => 'field_home_blog_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'home_blog_highlight', 'type' => 'text', 'default_value' => 'Guidance'),
            array('key' => 'field_home_blog_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'home_blog_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Admissions guidance, learning tips and stories for parents and students.'),
            array('key' => 'field_home_blog_count', 'label' => __('Number of posts', 'mlzs'), 'name' => 'home_blog_count', 'type' => 'number', 'default_value' => 3, 'min' => 1, 'max' => 6),

            /* ---------------- FAQ ---------------- */
            array('key' => 'field_home_faq_tab', 'label' => __('FAQ', 'mlzs'), 'type' => 'tab'),
            array('key' => 'field_home_faq_enabled', 'label' => __('Show FAQ section', 'mlzs'), 'name' => 'home_faq_enabled', 'type' => 'true_false', 'ui' => 1, 'default_value' => 1),
            array('key' => 'field_home_faq_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'home_faq_badge', 'type' => 'text', 'default_value' => 'Got Questions?'),
            array('key' => 'field_home_faq_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'home_faq_heading', 'type' => 'text', 'default_value' => 'Frequently Asked'),
            array('key' => 'field_home_faq_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'home_faq_highlight', 'type' => 'text', 'default_value' => 'Questions'),
            array('key' => 'field_home_faq_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'home_faq_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Quick answers to what parents ask us most.'),
            array(
                'key' => 'field_home_faq_items', 'label' => __('FAQs', 'mlzs'), 'name' => 'home_faq_items',
                'type' => 'repeater', 'layout' => 'block', 'button_label' => __('Add FAQ', 'mlzs'),
                'sub_fields' => array(
                    array('key' => 'field_home_faq_q', 'label' => __('Question', 'mlzs'), 'name' => 'question', 'type' => 'text', 'required' => 1),
                    array('key' => 'field_home_faq_a', 'label' => __('Answer', 'mlzs'), 'name' => 'answer', 'type' => 'textarea', 'rows' => 3, 'required' => 1),
                ),
            ),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'home.php')),
        ),
        'menu_order' => 5,
    ));
}
add_action('acf/init', 'mlzs_acf_home_sections_field_group');
