<?php
/**
 * Footer Contact Form – Custom Post Type, AJAX handler, wp_mail.
 * Email: rmalwar.mlzs@gmail.com
 */

if (!defined('ABSPATH')) {
    exit;
}

define('MLZS_CONTACT_EMAIL', 'rmalwar.mlzs@gmail.com');
define('MLZS_CONTACT_NONCE_ACTION', 'mlzs_footer_contact');
define('MLZS_CONTACT_RATE_LIMIT_SECONDS', 60);

/**
 * Register Custom Post Type: Contact Submission
 */
function mlzs_register_contact_submission_cpt() {
    $labels = array(
        'name'               => _x('Contact Submissions', 'post type general name', 'mlzs'),
        'singular_name'      => _x('Contact Submission', 'post type singular name', 'mlzs'),
        'menu_name'          => _x('Contact Submissions', 'admin menu', 'mlzs'),
        'add_new'            => _x('Add New', 'contact submission', 'mlzs'),
        'add_new_item'       => __('Add New Submission', 'mlzs'),
        'edit_item'          => __('View Submission', 'mlzs'),
        'new_item'           => __('New Submission', 'mlzs'),
        'view_item'          => __('View Submission', 'mlzs'),
        'search_items'       => __('Search Submissions', 'mlzs'),
        'not_found'          => __('No submissions found.', 'mlzs'),
        'not_found_in_trash' => __('No submissions in trash.', 'mlzs'),
    );
    $args = array(
        'labels'              => $labels,
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 24,
        'menu_icon'           => 'dashicons-email-alt',
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'supports'            => array('title'),
        'has_archive'         => false,
        'rewrite'             => false,
        'query_var'           => false,
    );
    register_post_type('contact_submission', $args);
}
add_action('init', 'mlzs_register_contact_submission_cpt');

/**
 * Add meta columns to Contact Submissions list
 */
function mlzs_contact_submission_columns($columns) {
    $new = array();
    $new['cb'] = $columns['cb'];
    $new['title'] = __('Name', 'mlzs');
    $new['contact_email'] = __('Email', 'mlzs');
    $new['contact_phone'] = __('Phone', 'mlzs');
    $new['contact_message'] = __('Message', 'mlzs');
    $new['date'] = $columns['date'];
    return $new;
}
add_filter('manage_contact_submission_posts_columns', 'mlzs_contact_submission_columns');

function mlzs_contact_submission_column_content($column, $post_id) {
    switch ($column) {
        case 'contact_email':
            echo esc_html(get_post_meta($post_id, '_contact_email', true) ?: '—');
            break;
        case 'contact_phone':
            echo esc_html(get_post_meta($post_id, '_contact_phone', true) ?: '—');
            break;
        case 'contact_message':
            $msg = get_post_meta($post_id, '_contact_message', true);
            echo esc_html(wp_trim_words($msg, 10) ?: '—');
            break;
    }
}
add_action('manage_contact_submission_posts_custom_column', 'mlzs_contact_submission_column_content', 10, 2);

/**
 * Render meta in edit screen
 */
function mlzs_contact_submission_meta_box() {
    global $post;
    if (!$post || get_post_type($post) !== 'contact_submission') return;
    echo '<table class="form-table"><tbody>';
    echo '<tr><th>Email</th><td>' . esc_html(get_post_meta($post->ID, '_contact_email', true) ?: '—') . '</td></tr>';
    echo '<tr><th>Phone</th><td>' . esc_html(get_post_meta($post->ID, '_contact_phone', true) ?: '—') . '</td></tr>';
    echo '<tr><th>Message</th><td>' . esc_html(get_post_meta($post->ID, '_contact_message', true) ?: '—') . '</td></tr>';
    echo '</tbody></table>';
}
add_action('add_meta_boxes', function() {
    add_meta_box('mlzs_contact_meta', __('Contact Details', 'mlzs'), 'mlzs_contact_submission_meta_box', 'contact_submission', 'normal');
});

/**
 * AJAX handler: Footer Contact Form
 */
function mlzs_ajax_footer_contact() {
    header('Content-Type: application/json; charset=utf-8');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        wp_send_json_error(array('message' => __('Invalid request.', 'mlzs')));
    }

    $nonce = isset($_POST['mlzs_contact_nonce']) ? sanitize_text_field(wp_unslash($_POST['mlzs_contact_nonce'])) : '';
    if (!wp_verify_nonce($nonce, MLZS_CONTACT_NONCE_ACTION)) {
        wp_send_json_error(array('message' => __('Security check failed. Please refresh and try again.', 'mlzs')));
    }

    $ip = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'])) : '';
    $rate_key = 'mlzs_contact_' . md5($ip);
    if (get_transient($rate_key)) {
        wp_send_json_error(array('message' => __('Please wait a moment before sending another message.', 'mlzs')));
    }

    $name    = isset($_POST['contact_name']) ? sanitize_text_field(wp_unslash($_POST['contact_name'])) : '';
    $email   = isset($_POST['contact_email']) ? sanitize_email(wp_unslash($_POST['contact_email'])) : '';
    $phone   = isset($_POST['contact_phone']) ? sanitize_text_field(wp_unslash($_POST['contact_phone'])) : '';
    $message = isset($_POST['contact_message']) ? sanitize_textarea_field(wp_unslash($_POST['contact_message'])) : '';

    if (strlen($name) < 2) {
        wp_send_json_error(array('message' => __('Please enter your name.', 'mlzs')));
    }
    if (!is_email($email)) {
        wp_send_json_error(array('message' => __('Please enter a valid email address.', 'mlzs')));
    }
    if (strlen($message) < 5) {
        wp_send_json_error(array('message' => __('Please enter your message (at least 5 characters).', 'mlzs')));
    }

    $post_id = wp_insert_post(array(
        'post_type'   => 'contact_submission',
        'post_status' => 'publish',
        'post_title'  => $name . ' – ' . $email,
        'post_author' => 0,
    ));

    if (is_wp_error($post_id)) {
        wp_send_json_error(array('message' => __('Sorry, something went wrong. Please try again.', 'mlzs')));
    }

    update_post_meta($post_id, '_contact_name', $name);
    update_post_meta($post_id, '_contact_email', $email);
    update_post_meta($post_id, '_contact_phone', $phone);
    update_post_meta($post_id, '_contact_message', $message);

    $subject = sprintf(
        '[%s] New Contact: %s',
        get_bloginfo('name'),
        $name
    );
    $body = mlzs_email_body_contact($name, $email, $phone, $message);
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail(MLZS_CONTACT_EMAIL, $subject, $body, $headers);

    set_transient($rate_key, 1, MLZS_CONTACT_RATE_LIMIT_SECONDS);

    wp_send_json_success(array(
        'message' => __('Thank you! Your message has been sent. We will get back to you soon.', 'mlzs'),
    ));
}
add_action('wp_ajax_mlzs_footer_contact', 'mlzs_ajax_footer_contact');
add_action('wp_ajax_nopriv_mlzs_footer_contact', 'mlzs_ajax_footer_contact');
