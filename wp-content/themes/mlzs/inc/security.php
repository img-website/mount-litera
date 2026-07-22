<?php
/**
 * Security hardening:
 *  - Comments fully disabled everywhere (UI, REST API, XML-RPC, feeds, direct POST)
 *  - XML-RPC / pingback attack surface removed
 *  - Upload types restricted; PHP execution blocked in /uploads (see uploads/.htaccess)
 *  - Admin file editor disabled, author enumeration blocked
 */

if (!defined('ABSPATH')) {
    exit;
}

/* =========================================================================
 * 1) COMMENTS — completely disabled
 * ====================================================================== */

/** Drop comment/trackback support from every post type. */
add_action('init', function () {
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
        }
        if (post_type_supports($post_type, 'trackbacks')) {
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}, 100);

/** Report comments/pings as closed, and never return existing comments. */
add_filter('comments_open', '__return_false', 20);
add_filter('pings_open', '__return_false', 20);
add_filter('comments_array', '__return_empty_array', 20);
add_filter('get_comments_number', '__return_zero', 20);

/** Hard-block any attempt to actually post a comment. */
function mlzs_block_comment_submission() {
    wp_die(
        esc_html__('Comments are disabled on this website.', 'mlzs'),
        esc_html__('Comments disabled', 'mlzs'),
        array('response' => 403)
    );
}
add_action('pre_comment_on_post', 'mlzs_block_comment_submission');
add_filter('preprocess_comment', function ($commentdata) {
    mlzs_block_comment_submission();
    return $commentdata;
}, 0);

/** Remove the comments REST API endpoints entirely. */
add_filter('rest_endpoints', function ($endpoints) {
    foreach (array_keys($endpoints) as $route) {
        if (strpos($route, '/wp/v2/comments') === 0) {
            unset($endpoints[$route]);
        }
    }
    return $endpoints;
}, 20);

/** Block comment feeds. */
add_action('template_redirect', function () {
    if (is_comment_feed()) {
        wp_die(
            esc_html__('Comment feeds are disabled.', 'mlzs'),
            esc_html__('Disabled', 'mlzs'),
            array('response' => 404)
        );
    }
}, 1);
add_filter('feed_links_show_comments_feed', '__return_false');
add_filter('post_comments_feed_link', '__return_empty_string', 20);

/** Admin: hide the Comments UI and block its screens. */
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
}, 100);

add_action('admin_init', function () {
    global $pagenow;
    if (in_array($pagenow, array('edit-comments.php', 'options-discussion.php'), true)) {
        wp_safe_redirect(admin_url());
        exit;
    }
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}, 100);

add_action('wp_before_admin_bar_render', function () {
    global $wp_admin_bar;
    if ($wp_admin_bar) {
        $wp_admin_bar->remove_menu('comments');
    }
});

/* =========================================================================
 * 2) XML-RPC / pingback — closed (common brute-force + DDoS vector)
 * ====================================================================== */

/**
 * Block the xmlrpc.php endpoint outright. The `xmlrpc_enabled` filter only turns
 * off authenticated methods — system.multicall / system.listMethods stay exposed
 * and are used for amplified brute-force attacks, so refuse the request early.
 */
add_action('init', function () {
    if (!empty($_SERVER['SCRIPT_FILENAME'])
        && basename((string) $_SERVER['SCRIPT_FILENAME']) === 'xmlrpc.php') {
        status_header(403);
        header('Content-Type: text/plain; charset=utf-8');
        echo 'XML-RPC is disabled on this website.';
        exit;
    }
}, 0);

add_filter('xmlrpc_enabled', '__return_false');
add_filter('xmlrpc_methods', '__return_empty_array', 20);
add_filter('wp_headers', function ($headers) {
    unset($headers['X-Pingback']);
    return $headers;
}, 20);
add_filter('bloginfo_url', function ($output, $show) {
    return ($show === 'pingback_url') ? '' : $output;
}, 20, 2);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');

/* =========================================================================
 * 3) UPLOADS — restrict what can ever be written
 * ====================================================================== */

/**
 * Whitelist of upload types. Anything not listed (php, phtml, exe, svg, html…)
 * is rejected for every user and every upload route (admin, REST, front-end forms).
 */
add_filter('upload_mimes', function ($mimes) {
    return array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'png'          => 'image/png',
        'gif'          => 'image/gif',
        'webp'         => 'image/webp',
        'avif'         => 'image/avif',
        'ico'          => 'image/x-icon',
        'pdf'          => 'application/pdf',
        'doc'          => 'application/msword',
        'docx'         => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'xls'          => 'application/vnd.ms-excel',
        'xlsx'         => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'ppt'          => 'application/vnd.ms-powerpoint',
        'pptx'         => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'csv'          => 'text/csv',
        'mp4'          => 'video/mp4',
        'webm'         => 'video/webm',
        'mp3'          => 'audio/mpeg',
    );
}, 99);

/**
 * Belt-and-braces: reject any filename carrying an executable extension,
 * including double extensions such as "photo.php.jpg".
 */
add_filter('wp_handle_upload_prefilter', function ($file) {
    $bad = '/\.(php\d?|phtml|phps|phar|cgi|pl|py|rb|sh|bash|asp|aspx|jsp|exe|dll|so|htaccess|htm|html|xhtml|shtml|svg|swf|js)(\.|$)/i';
    if (isset($file['name']) && preg_match($bad, $file['name'])) {
        $file['error'] = __('This file type is not allowed.', 'mlzs');
    }
    return $file;
}, 1);

/** Cap front-end (unauthenticated) uploads at 5 MB. */
add_filter('wp_handle_upload_prefilter', function ($file) {
    if (!is_user_logged_in() && !empty($file['size']) && $file['size'] > 5 * 1024 * 1024) {
        $file['error'] = __('File is too large. Maximum size is 5 MB.', 'mlzs');
    }
    return $file;
}, 2);

/* =========================================================================
 * 4) General hardening
 * ====================================================================== */

/** No editing theme/plugin PHP from wp-admin (limits damage if an account is stolen). */
if (!defined('DISALLOW_FILE_EDIT')) {
    define('DISALLOW_FILE_EDIT', true);
}

/** Block ?author=N user enumeration on the front end. */
add_action('template_redirect', function () {
    if (!is_admin() && isset($_GET['author']) && !is_user_logged_in()) {
        wp_safe_redirect(home_url('/'), 301);
        exit;
    }
}, 1);

/** Don't leak whether a username or the password was wrong. */
add_filter('login_errors', function () {
    return __('Invalid login details.', 'mlzs');
});

/** Remove the REST "users" endpoint for unauthenticated visitors. */
add_filter('rest_endpoints', function ($endpoints) {
    if (!is_user_logged_in()) {
        foreach (array_keys($endpoints) as $route) {
            if (strpos($route, '/wp/v2/users') === 0) {
                unset($endpoints[$route]);
            }
        }
    }
    return $endpoints;
}, 21);
