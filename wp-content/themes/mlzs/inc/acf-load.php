<?php
/**
 * Load page-wise ACF field group definitions.
 */

if (!defined('ABSPATH')) {
    exit;
}

$acf_dir = get_template_directory() . '/inc/acf';
$files = glob($acf_dir . '/*.php');
if ($files) {
    foreach ($files as $file) {
        require_once $file;
    }
}
