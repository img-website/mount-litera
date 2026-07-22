<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Pro: FAQs for blog posts (shown under the editor on Posts).
 * If left empty, the theme automatically detects an "FAQs" section written
 * inside the post content and renders it as the same accordion.
 */
function mlzs_acf_blog_faq_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key'    => 'group_mlzs_blog_faq',
        'title'  => __('FAQs (shown at the end of the post)', 'mlzs'),
        'fields' => array(
            array(
                'key'           => 'field_mlzs_faq_heading',
                'label'         => __('Section Heading', 'mlzs'),
                'name'          => 'faq_heading',
                'type'          => 'text',
                'default_value' => 'Frequently Asked Questions',
                'placeholder'   => 'Frequently Asked Questions',
                'instructions'  => __('Heading shown above the FAQ accordion.', 'mlzs'),
            ),
            array(
                'key'          => 'field_mlzs_faqs',
                'label'        => __('FAQs', 'mlzs'),
                'name'         => 'blog_faqs',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => __('Add FAQ', 'mlzs'),
                'instructions' => __('Add each question with its answer. Leave empty to auto-use an "FAQs" section written in the content above.', 'mlzs'),
                'sub_fields'   => array(
                    array(
                        'key'         => 'field_mlzs_faq_q',
                        'label'       => __('Question', 'mlzs'),
                        'name'        => 'faq_question',
                        'type'        => 'text',
                        'required'    => 1,
                        'placeholder' => __('e.g. What is the admission process?', 'mlzs'),
                    ),
                    array(
                        'key'          => 'field_mlzs_faq_a',
                        'label'        => __('Answer', 'mlzs'),
                        'name'         => 'faq_answer',
                        'type'         => 'wysiwyg',
                        'required'     => 1,
                        'tabs'         => 'all',
                        'toolbar'      => 'basic',
                        'media_upload' => 0,
                        'rows'         => 4,
                    ),
                ),
            ),
        ),
        'location' => array(
            array(array('param' => 'post_type', 'operator' => '==', 'value' => 'post')),
        ),
        'position'    => 'normal',
        'menu_order'  => 20,
        'description' => __('Renders a designed FAQ accordion and adds FAQ structured data.', 'mlzs'),
    ));
}
add_action('acf/init', 'mlzs_acf_blog_faq_field_group');
