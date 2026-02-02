<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: Testimonials Page – Hero, Video grid (6+), More stories + info panel, Stats & CTA
 */
function mlzs_acf_testimonial_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_testimonial',
        'title'                 => __('Testimonials Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_tst_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tst_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'testimonial_hero_badge', 'type' => 'text', 'default_value' => 'Parent Feedback'),
            array('key' => 'field_tst_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'testimonial_hero_icon', 'type' => 'text', 'default_value' => 'message-circle-heart', 'instructions' => __('Lucide icon name.', 'mlzs')),
            array('key' => 'field_tst_hero_headline_before', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'testimonial_hero_headline_before', 'type' => 'text', 'default_value' => 'Parent'),
            array('key' => 'field_tst_hero_headline_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'testimonial_hero_headline_highlight', 'type' => 'text', 'default_value' => 'Testimonials'),
            array('key' => 'field_tst_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'testimonial_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Hear what our parents have to say about their experience with Mount Litera Zee School'),
            array('key' => 'field_tst_tab_video', 'label' => __('Video Testimonials', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tst_video_heading', 'label' => __('Section Heading (before highlight)', 'mlzs'), 'name' => 'testimonial_video_heading', 'type' => 'text', 'default_value' => 'Video'),
            array('key' => 'field_tst_video_heading_highlight', 'label' => __('Section Heading (highlighted)', 'mlzs'), 'name' => 'testimonial_video_heading_highlight', 'type' => 'text', 'default_value' => 'Testimonials'),
            array('key' => 'field_tst_video_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'testimonial_video_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Watch parents share their experiences and stories about their children\'s journey at our school'),
            array('key' => 'field_tst_video_items', 'label' => __('Video Cards', 'mlzs'), 'name' => 'testimonial_video_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'button_label' => __('Add Video', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tst_vid_video_url', 'label' => __('Video URL', 'mlzs'), 'name' => 'video_url', 'type' => 'oembed', 'return_format' => 'url', 'instructions' => __('Paste YouTube or Vimeo URL. Thumbnail is auto-fetched.', 'mlzs')),
                array('key' => 'field_tst_vid_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Parent Testimonial'),
                array('key' => 'field_tst_vid_hover_title', 'label' => __('Hover Title', 'mlzs'), 'name' => 'hover_title', 'type' => 'text', 'default_value' => 'Parent Experience'),
                array('key' => 'field_tst_vid_badge_style', 'label' => __('Badge Style', 'mlzs'), 'name' => 'badge_style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'accent' => 'Accent', 'primary-dark' => 'Primary Dark', 'primary-lighter' => 'Primary Lighter', 'accent-light' => 'Accent Light'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_tst_tab_more', 'label' => __('More Parent Stories', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tst_more_heading', 'label' => __('Block Heading', 'mlzs'), 'name' => 'testimonial_more_heading', 'type' => 'text', 'default_value' => 'More Parent Stories'),
            array('key' => 'field_tst_more_video', 'label' => __('Extra Video Card', 'mlzs'), 'name' => 'testimonial_more_video', 'type' => 'group', 'sub_fields' => array(
                array('key' => 'field_tst_mv_video_url', 'label' => __('Video URL', 'mlzs'), 'name' => 'video_url', 'type' => 'oembed', 'return_format' => 'url', 'instructions' => __('Paste YouTube or Vimeo URL. Thumbnail is auto-fetched.', 'mlzs')),
                array('key' => 'field_tst_mv_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_tst_mv_hover_title', 'label' => __('Hover Title', 'mlzs'), 'name' => 'hover_title', 'type' => 'text', 'default_value' => 'Watch video testimonial'),
            )),
            array('key' => 'field_tst_info_icon', 'label' => __('Info Panel Icon', 'mlzs'), 'name' => 'testimonial_info_icon', 'type' => 'text', 'default_value' => 'volume-2'),
            array('key' => 'field_tst_info_heading', 'label' => __('Info Panel Heading', 'mlzs'), 'name' => 'testimonial_info_heading', 'type' => 'text', 'default_value' => 'Real Stories, Real Experiences'),
            array('key' => 'field_tst_info_paragraph', 'label' => __('Info Panel Paragraph', 'mlzs'), 'name' => 'testimonial_info_paragraph', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Our parents share their genuine experiences and stories about how Mount Litera Zee School has made a positive impact on their children\'s lives.'),
            array('key' => 'field_tst_info_checklist', 'label' => __('Checklist (3)', 'mlzs'), 'name' => 'testimonial_info_checklist', 'type' => 'repeater', 'layout' => 'row', 'min' => 3, 'max' => 3, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tst_check_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_tst_tab_cta', 'label' => __('Stats & CTA', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tst_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'testimonial_cta_heading', 'type' => 'text', 'default_value' => 'Share Your Story'),
            array('key' => 'field_tst_cta_paragraph', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'testimonial_cta_paragraph', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Are you a parent with a story to share about your child\'s journey at Mount Litera Zee School? We\'d love to hear from you!'),
            array('key' => 'field_tst_cta_btn1', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'testimonial_cta_btn1', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Share Your Testimonial).', 'mlzs')),
            array('key' => 'field_tst_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'testimonial_cta_btn1_icon', 'type' => 'text', 'default_value' => 'message-circle'),
            array('key' => 'field_tst_cta_btn2', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'testimonial_cta_btn2', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Watch All Videos).', 'mlzs')),
            array('key' => 'field_tst_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'testimonial_cta_btn2_icon', 'type' => 'text', 'default_value' => 'play-circle'),
            array('key' => 'field_tst_cta_stats', 'label' => __('Stats (4)', 'mlzs'), 'name' => 'testimonial_cta_stats', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tst_stat_number', 'label' => __('Number/Text', 'mlzs'), 'name' => 'number', 'type' => 'text', 'default_value' => '7+'),
                array('key' => 'field_tst_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Video Testimonials'),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'testimonial.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_testimonial_field_group');
