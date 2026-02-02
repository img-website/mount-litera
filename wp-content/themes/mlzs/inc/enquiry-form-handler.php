<?php
/**
 * Enquiry Form – Custom Post Type, AJAX handler, wp_mail.
 * Email: rmalwar.mlzs@gmail.com
 */

if (!defined('ABSPATH')) {
    exit;
}

define('MLZS_ENQUIRY_EMAIL', 'rmalwar.mlzs@gmail.com');
define('MLZS_ENQUIRY_NONCE_ACTION', 'mlzs_enquiry');
define('MLZS_ENQUIRY_RATE_LIMIT_SECONDS', 60);

/**
 * Register Custom Post Type: Enquiry Submission
 */
function mlzs_register_enquiry_submission_cpt() {
    $labels = array(
        'name'               => _x('Enquiry Submissions', 'post type general name', 'mlzs'),
        'singular_name'      => _x('Enquiry Submission', 'post type singular name', 'mlzs'),
        'menu_name'          => _x('Enquiry Submissions', 'admin menu', 'mlzs'),
        'add_new'            => _x('Add New', 'enquiry submission', 'mlzs'),
        'add_new_item'       => __('Add New Enquiry', 'mlzs'),
        'edit_item'          => __('View Enquiry', 'mlzs'),
        'new_item'           => __('New Enquiry', 'mlzs'),
        'view_item'          => __('View Enquiry', 'mlzs'),
        'search_items'       => __('Search Enquiries', 'mlzs'),
        'not_found'          => __('No enquiries found.', 'mlzs'),
        'not_found_in_trash' => __('No enquiries in trash.', 'mlzs'),
    );
    $args = array(
        'labels'              => $labels,
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'menu_icon'           => 'dashicons-welcome-learn-more',
        'supports'            => array('title'),
        'has_archive'         => false,
        'rewrite'             => false,
        'query_var'           => false,
    );
    register_post_type('enquiry_submission', $args);
}
add_action('init', 'mlzs_register_enquiry_submission_cpt');

/**
 * Add meta columns to Enquiry Submissions list
 */
function mlzs_enquiry_submission_columns($columns) {
    $new = array();
    $new['cb'] = $columns['cb'];
    $new['title'] = __('Child Name', 'mlzs');
    $new['enquiry_class'] = __('Class', 'mlzs');
    $new['enquiry_contact'] = __('Contact', 'mlzs');
    $new['enquiry_email'] = __('Email', 'mlzs');
    $new['date'] = $columns['date'];
    return $new;
}
add_filter('manage_enquiry_submission_posts_columns', 'mlzs_enquiry_submission_columns');

function mlzs_enquiry_submission_column_content($column, $post_id) {
    switch ($column) {
        case 'enquiry_class':
            echo esc_html(get_post_meta($post_id, '_enquiry_class', true) ?: '—');
            break;
        case 'enquiry_contact':
            echo esc_html(get_post_meta($post_id, '_enquiry_contact', true) ?: '—');
            break;
        case 'enquiry_email':
            echo esc_html(get_post_meta($post_id, '_enquiry_email', true) ?: '—');
            break;
    }
}
add_action('manage_enquiry_submission_posts_custom_column', 'mlzs_enquiry_submission_column_content', 10, 2);

/**
 * Render meta in edit screen
 */
function mlzs_enquiry_submission_meta_box() {
    global $post;
    if (!$post || get_post_type($post) !== 'enquiry_submission') return;
    echo '<table class="form-table"><tbody>';
    echo '<tr><th>Class</th><td>' . esc_html(get_post_meta($post->ID, '_enquiry_class', true) ?: '—') . '</td></tr>';
    echo '<tr><th>Contact Number</th><td>' . esc_html(get_post_meta($post->ID, '_enquiry_contact', true) ?: '—') . '</td></tr>';
    echo '<tr><th>Email</th><td>' . esc_html(get_post_meta($post->ID, '_enquiry_email', true) ?: '—') . '</td></tr>';
    echo '</tbody></table>';
}
add_action('add_meta_boxes', function() {
    add_meta_box('mlzs_enquiry_meta', __('Enquiry Details', 'mlzs'), 'mlzs_enquiry_submission_meta_box', 'enquiry_submission', 'normal');
});

/**
 * Allowed class values for validation
 */
function mlzs_enquiry_allowed_classes() {
    return array('1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '11th (Science)', '11th (Commerce)', '11th (Humanities)');
}

/**
 * AJAX handler: Enquiry Form
 */
function mlzs_ajax_enquiry() {
    header('Content-Type: application/json; charset=utf-8');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        wp_send_json_error(array('message' => __('Invalid request.', 'mlzs')));
    }

    $nonce = isset($_POST['mlzs_enquiry_nonce']) ? sanitize_text_field(wp_unslash($_POST['mlzs_enquiry_nonce'])) : '';
    if (!wp_verify_nonce($nonce, MLZS_ENQUIRY_NONCE_ACTION)) {
        wp_send_json_error(array('message' => __('Security check failed. Please refresh and try again.', 'mlzs')));
    }

    $ip = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'])) : '';
    $rate_key = 'mlzs_enquiry_' . md5($ip);
    if (get_transient($rate_key)) {
        wp_send_json_error(array('message' => __('Please wait a moment before submitting another enquiry.', 'mlzs')));
    }

    $name    = isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '';
    $class   = isset($_POST['class']) ? sanitize_text_field(wp_unslash($_POST['class'])) : '';
    $contact = isset($_POST['contactnumber']) ? sanitize_text_field(wp_unslash($_POST['contactnumber'])) : '';
    $email   = isset($_POST['emailid']) ? sanitize_email(wp_unslash($_POST['emailid'])) : '';

    if (strlen($name) < 2) {
        wp_send_json_error(array('message' => __('Please enter your child\'s name.', 'mlzs')));
    }
    $allowed = mlzs_enquiry_allowed_classes();
    if (!in_array($class, $allowed, true)) {
        wp_send_json_error(array('message' => __('Please select a valid class.', 'mlzs')));
    }
    if (!preg_match('/^[0-9]{10}$/', $contact)) {
        wp_send_json_error(array('message' => __('Please enter a valid 10-digit contact number.', 'mlzs')));
    }
    if (!is_email($email)) {
        wp_send_json_error(array('message' => __('Please enter a valid email address.', 'mlzs')));
    }

    $post_id = wp_insert_post(array(
        'post_type'   => 'enquiry_submission',
        'post_status' => 'publish',
        'post_title'  => $name . ' – ' . $class,
        'post_author' => 0,
    ));

    if (is_wp_error($post_id)) {
        wp_send_json_error(array('message' => __('Sorry, something went wrong. Please try again.', 'mlzs')));
    }

    update_post_meta($post_id, '_enquiry_name', $name);
    update_post_meta($post_id, '_enquiry_class', $class);
    update_post_meta($post_id, '_enquiry_contact', $contact);
    update_post_meta($post_id, '_enquiry_email', $email);

    $subject = sprintf(
        '[%s] New Admission Enquiry: %s – %s',
        get_bloginfo('name'),
        $name,
        $class
    );
    $body = "Child's Name: {$name}\n";
    $body .= "Class: {$class}\n";
    $body .= "Contact Number: {$contact}\n";
    $body .= "Email: {$email}\n";

    $headers = array('Content-Type: text/plain; charset=UTF-8');
    wp_mail(MLZS_ENQUIRY_EMAIL, $subject, $body, $headers);

    set_transient($rate_key, 1, MLZS_ENQUIRY_RATE_LIMIT_SECONDS);

    wp_send_json_success(array(
        'message' => __('Thank you! Your enquiry has been submitted. We will contact you within 24 hours.', 'mlzs'),
    ));
}
add_action('wp_ajax_mlzs_enquiry', 'mlzs_ajax_enquiry');
add_action('wp_ajax_nopriv_mlzs_enquiry', 'mlzs_ajax_enquiry');
