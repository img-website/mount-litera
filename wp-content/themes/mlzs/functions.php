<?php
/**
 * Mount Litera Zee School (MLZS) Theme Functions
 */

if (!defined('ABSPATH')) {
    exit;
}

/** Theme setup, WebP, enqueue */
require_once get_template_directory() . '/inc/setup.php';

/** Settings > Env – API keys (YouTube, Google Maps) */
require_once get_template_directory() . '/inc/admin-env-settings.php';

/** HTML Email Templates */
require_once get_template_directory() . '/inc/email-templates.php';

/** Footer Contact Form – CPT, AJAX, wp_mail */
require_once get_template_directory() . '/inc/contact-form-handler.php';

/** Enquiry Form – CPT, AJAX, wp_mail */
require_once get_template_directory() . '/inc/enquiry-form-handler.php';

/** Admission Registration Form – CPT, AJAX, wp_mail */
require_once get_template_directory() . '/inc/admission-form-handler.php';

/**
 * One-time flush rewrite rules so new CPTs appear in admin.
 */
function mlzs_maybe_flush_rewrite_rules() {
    if (get_option('mlzs_flushed_rewrites') !== '1') {
        flush_rewrite_rules();
        update_option('mlzs_flushed_rewrites', '1');
    }
}
add_action('init', 'mlzs_maybe_flush_rewrite_rules', 999);

/**
 * Set ACF Google Maps API key from Settings > Env (ACF options page).
 */
function mlzs_acf_google_maps_api_key() {
    $key = function_exists('get_field') ? get_field('mlzs_google_maps_api_key', 'acf-options-env') : '';
    if (is_string($key) && $key !== '' && function_exists('acf_update_setting')) {
        acf_update_setting('google_api_key', $key);
    }
}
add_action('acf/init', 'mlzs_acf_google_maps_api_key', 5);

/** Page-wise ACF field groups */
require_once get_template_directory() . '/inc/acf-load.php';

