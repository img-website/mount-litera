<?php
if (!defined('ABSPATH')) { exit; }

/**
 * ACF Field Group: Footer (Options Page)
 */
function mlzs_acf_footer_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'    => 'group_mlzs_footer',
        'title'  => __('Footer Content', 'mlzs'),
        'fields' => array(
            array(
                'key'   => 'field_footer_tab_contact',
                'label' => __('Contact CTA Box (Top)', 'mlzs'),
                'name'  => '',
                'type'  => 'tab',
            ),
            array(
                'key'   => 'field_footer_contact_badge',
                'label' => __('Badge Text', 'mlzs'),
                'name'  => 'footer_contact_badge',
                'type'  => 'text',
                'default_value' => 'Contact Us',
            ),
            array(
                'key'   => 'field_footer_contact_heading',
                'label' => __('Heading', 'mlzs'),
                'name'  => 'footer_contact_heading',
                'type'  => 'text',
                'default_value' => 'Get In Touch',
            ),
            array(
                'key'   => 'field_footer_contact_description',
                'label' => __('Description', 'mlzs'),
                'name'  => 'footer_contact_description',
                'type'  => 'textarea',
                'rows'  => 3,
                'default_value' => 'Have questions about admissions, programs, or campus life? We\'re here to help. Reach out to us and we\'ll get back to you soon.',
            ),
            array(
                'key'   => 'field_footer_contact_email',
                'label' => __('Email', 'mlzs'),
                'name'  => 'footer_contact_email',
                'type'  => 'text',
                'default_value' => 'mlzs.alwar@mountlitera.com',
            ),
            array(
                'key'   => 'field_footer_contact_phone',
                'label' => __('Phone', 'mlzs'),
                'name'  => 'footer_contact_phone',
                'type'  => 'text',
                'default_value' => '+91 9672797979',
            ),
            array(
                'key'   => 'field_footer_tab_main',
                'label' => __('Logo & Tagline', 'mlzs'),
                'name'  => '',
                'type'  => 'tab',
            ),
            array(
                'key'   => 'field_footer_logo',
                'label' => __('Footer Logo', 'mlzs'),
                'name'  => 'footer_logo',
                'type'  => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
                'instructions' => __('Leave empty to use theme logo.', 'mlzs'),
            ),
            array(
                'key'   => 'field_footer_tagline',
                'label' => __('Tagline', 'mlzs'),
                'name'  => 'footer_tagline',
                'type'  => 'textarea',
                'rows'  => 3,
                'default_value' => 'Empowering the next generation of leaders through excellence in education, innovation, and character building.',
            ),
            array(
                'key'   => 'field_footer_address_heading',
                'label' => __('Address Block Heading', 'mlzs'),
                'name'  => 'footer_address_heading',
                'type'  => 'text',
                'default_value' => 'Campus Address',
            ),
            array(
                'key'   => 'field_footer_address_text',
                'label' => __('Address', 'mlzs'),
                'name'  => 'footer_address_text',
                'type'  => 'textarea',
                'rows'  => 3,
                'default_value' => '6th Milestone, Jharkheda, Sirmoli Village Road, Alwar - Bhiwadi State Highway, Alwar - 301028 (Raj.)',
            ),
            array(
                'key'   => 'field_footer_tab_menus',
                'label' => __('Menu & Links Columns', 'mlzs'),
                'name'  => '',
                'type'  => 'tab',
            ),
            array(
                'key'   => 'field_footer_menu_heading',
                'label' => __('Menu Column Heading', 'mlzs'),
                'name'  => 'footer_menu_heading',
                'type'  => 'text',
                'default_value' => 'Menu',
            ),
            array(
                'key'   => 'field_footer_menu_links',
                'label' => __('Menu Links', 'mlzs'),
                'name'  => 'footer_menu_links',
                'type'  => 'repeater',
                'layout' => 'table',
                'button_label' => __('Add Link', 'mlzs'),
                'sub_fields' => array(
                    array(
                        'key' => 'field_footer_menu_link',
                        'label' => __('Link', 'mlzs'),
                        'name' => 'link',
                        'type' => 'link',
                        'return_format' => 'array',
                        'instructions' => __('Link text (title) and URL in one field.', 'mlzs'),
                    ),
                ),
            ),
            array(
                'key'   => 'field_footer_links_heading',
                'label' => __('Links Column Heading', 'mlzs'),
                'name'  => 'footer_links_heading',
                'type'  => 'text',
                'default_value' => 'Links',
            ),
            array(
                'key'   => 'field_footer_links',
                'label' => __('Links', 'mlzs'),
                'name'  => 'footer_links',
                'type'  => 'repeater',
                'layout' => 'table',
                'button_label' => __('Add Link', 'mlzs'),
                'sub_fields' => array(
                    array(
                        'key' => 'field_footer_link',
                        'label' => __('Link', 'mlzs'),
                        'name' => 'link',
                        'type' => 'link',
                        'return_format' => 'array',
                        'instructions' => __('Link text (title) and URL in one field.', 'mlzs'),
                    ),
                ),
            ),
            array(
                'key'   => 'field_footer_contact_col_heading',
                'label' => __('Contact Column Heading', 'mlzs'),
                'name'  => 'footer_contact_col_heading',
                'type'  => 'text',
                'default_value' => 'Contact Us',
            ),
            array(
                'key'   => 'field_footer_tab_bottom',
                'label' => __('Copyright & Social', 'mlzs'),
                'name'  => '',
                'type'  => 'tab',
            ),
            array(
                'key'   => 'field_footer_copyright',
                'label' => __('Copyright Text', 'mlzs'),
                'name'  => 'footer_copyright',
                'type'  => 'text',
                'default_value' => 'Mount Litera Zee School, Alwar. All rights reserved.',
                'instructions' => __('Year is added automatically. e.g. "Mount Litera Zee School, Alwar. All rights reserved."', 'mlzs'),
            ),
            array(
                'key'   => 'field_footer_developer_text',
                'label' => __('Developer Credit Text', 'mlzs'),
                'name'  => 'footer_developer_text',
                'type'  => 'text',
                'default_value' => 'Design & Developed By',
            ),
            array(
                'key'   => 'field_footer_developer_image',
                'label' => __('Developer Image', 'mlzs'),
                'name'  => 'footer_developer_image',
                'type'  => 'image',
                'return_format' => 'url',
                'preview_size' => 'thumbnail',
                'instructions' => __('Leave empty to use theme default.', 'mlzs'),
            ),
            array(
                'key'   => 'field_footer_social',
                'label' => __('Social Links', 'mlzs'),
                'name'  => 'footer_social',
                'type'  => 'repeater',
                'layout' => 'table',
                'button_label' => __('Add Social', 'mlzs'),
                'sub_fields' => array(
                    array(
                        'key'   => 'field_footer_social_icon',
                        'label' => __('Icon', 'mlzs'),
                        'name'  => 'icon',
                        'type'  => 'text',
                        'placeholder' => 'e.g. instagram, linkedin, twitter, facebook',
                        'default_value' => 'instagram',
                    ),
                    array(
                        'key' => 'field_footer_social_link',
                        'label' => __('Link', 'mlzs'),
                        'name' => 'link',
                        'type' => 'link',
                        'return_format' => 'array',
                        'instructions' => __('Link URL. Link title used as aria-label.', 'mlzs'),
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'acf-options-footer',
                ),
            ),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_footer_field_group');
