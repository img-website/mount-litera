<?php
/**
 * Error code pages – show 403, 500, 503 template when server sends error_code.
 * Configure server: ErrorDocument 403 /mount-litera/?error_code=403 (and 500, 503).
 */

if (!defined('ABSPATH')) {
    exit;
}

function mlzs_serve_error_code_page() {
    $code = isset($_GET['error_code']) ? absint($_GET['error_code']) : 0;
    $allowed = array(403, 404, 500, 503);
    if (!in_array($code, $allowed, true)) {
        return;
    }

    $templates = array(
        403 => '403.php',
        404 => '404.php',
        500 => '500.php',
        503 => '503.php',
    );
    $template = get_template_directory() . '/' . $templates[$code];
    if (!is_file($template)) {
        return;
    }

    $messages = array(
        403 => 'Forbidden',
        404 => 'Not Found',
        500 => 'Internal Server Error',
        503 => 'Service Unavailable',
    );
    status_header($code);
    nocache_headers();
    include $template;
    exit;
}
add_action('template_redirect', 'mlzs_serve_error_code_page', 1);
