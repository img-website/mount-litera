<?php
/**
 * Admission Registration Form – Custom Post Type, AJAX handler, wp_mail.
 * Email: rmalwar.mlzs@gmail.com
 */

if (!defined('ABSPATH')) {
    exit;
}

define('MLZS_ADMISSION_EMAIL', 'rmalwar.mlzs@gmail.com');
define('MLZS_ADMISSION_NONCE_ACTION', 'mlzs_admission');
define('MLZS_ADMISSION_RATE_LIMIT_SECONDS', 120);

define('MLZS_ADMISSION_CPT', 'mlzs_adm_reg');

/**
 * Register Custom Post Type: Admission Registration
 */
function mlzs_register_admission_registration_cpt() {
    $labels = array(
        'name'               => _x('Admission Registrations', 'post type general name', 'mlzs'),
        'singular_name'      => _x('Admission Registration', 'post type singular name', 'mlzs'),
        'menu_name'          => _x('Admission Registrations', 'admin menu', 'mlzs'),
        'add_new'            => _x('Add New', 'admission registration', 'mlzs'),
        'add_new_item'       => __('Add New Registration', 'mlzs'),
        'edit_item'          => __('View Registration', 'mlzs'),
        'new_item'           => __('New Registration', 'mlzs'),
        'view_item'          => __('View Registration', 'mlzs'),
        'search_items'       => __('Search Registrations', 'mlzs'),
        'not_found'          => __('No registrations found.', 'mlzs'),
        'not_found_in_trash' => __('No registrations in trash.', 'mlzs'),
    );
    $args = array(
        'labels'              => $labels,
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 26,
        'menu_icon'           => 'dashicons-clipboard',
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'supports'            => array('title'),
        'has_archive'         => false,
        'rewrite'             => false,
        'query_var'           => false,
    );
    register_post_type(MLZS_ADMISSION_CPT, $args);
}
add_action('init', 'mlzs_register_admission_registration_cpt', 5);

/**
 * Add meta columns to Admission Registrations list
 */
function mlzs_admission_registration_columns($columns) {
    $new = array();
    $new['cb'] = $columns['cb'];
    $new['title'] = __('Child Name', 'mlzs');
    $new['adm_class'] = __('Class Sought', 'mlzs');
    $new['adm_contact'] = __('Contact', 'mlzs');
    $new['adm_email'] = __('Email', 'mlzs');
    $new['date'] = $columns['date'];
    return $new;
}
add_filter('manage_' . MLZS_ADMISSION_CPT . '_posts_columns', 'mlzs_admission_registration_columns');

function mlzs_admission_registration_column_content($column, $post_id) {
    switch ($column) {
        case 'adm_class':
            echo esc_html(get_post_meta($post_id, '_adm_admission_class', true) ?: '—');
            break;
        case 'adm_contact':
            echo esc_html(get_post_meta($post_id, '_adm_contact', true) ?: '—');
            break;
        case 'adm_email':
            echo esc_html(get_post_meta($post_id, '_adm_email', true) ?: '—');
            break;
    }
}
add_action('manage_' . MLZS_ADMISSION_CPT . '_posts_custom_column', 'mlzs_admission_registration_column_content', 10, 2);

/**
 * Helper to render a meta box table.
 */
function mlzs_admission_render_table($fields) {
    echo '<table class="form-table"><tbody>';
    foreach ($fields as $label => $value) {
        echo '<tr><th scope="row">' . esc_html($label) . '</th><td>' . esc_html($value ?: '—') . '</td></tr>';
    }
    echo '</tbody></table>';
}

/**
 * Meta box: Registration & Child's Information
 */
function mlzs_admission_meta_registration_child($post) {
    $id = $post->ID;
    $age_y = get_post_meta($id, '_adm_age_years', true);
    $age_m = get_post_meta($id, '_adm_age_months', true);
    $age = ($age_y || $age_m) ? trim($age_y . 'y ' . $age_m . 'm') : '';
    $fields = array(
        __('Date', 'mlzs') => get_post_meta($id, '_adm_date', true),
        __('Enquiry / Registration No.', 'mlzs') => get_post_meta($id, '_adm_enquiry_no', true),
        __("Child's Name", 'mlzs') => trim((get_post_meta($id, '_adm_child_first_name', true) ?: '') . ' ' . (get_post_meta($id, '_adm_child_surname', true) ?: '')),
        __('Date of Birth', 'mlzs') => get_post_meta($id, '_adm_child_dob', true),
        __('Current Age', 'mlzs') => $age,
        __('Current School & Class', 'mlzs') => get_post_meta($id, '_adm_current_school', true),
        __('Class into which admission is sought', 'mlzs') => get_post_meta($id, '_adm_admission_class', true),
    );
    mlzs_admission_render_table($fields);
}

/**
 * Meta box: Father's Information
 */
function mlzs_admission_meta_father($post) {
    $id = $post->ID;
    $fields = array(
        __('Name of Father', 'mlzs') => trim((get_post_meta($id, '_adm_father_first_name', true) ?: '') . ' ' . (get_post_meta($id, '_adm_father_surname', true) ?: '')),
        __('Qualification', 'mlzs') => get_post_meta($id, '_adm_father_qualification', true),
        __('Occupation', 'mlzs') => get_post_meta($id, '_adm_father_occupation', true),
    );
    mlzs_admission_render_table($fields);
}

/**
 * Meta box: Mother's Information
 */
function mlzs_admission_meta_mother($post) {
    $id = $post->ID;
    $fields = array(
        __('Name of Mother', 'mlzs') => trim((get_post_meta($id, '_adm_mother_first_name', true) ?: '') . ' ' . (get_post_meta($id, '_adm_mother_surname', true) ?: '')),
        __('Qualification', 'mlzs') => get_post_meta($id, '_adm_mother_qualification', true),
        __('Occupation', 'mlzs') => get_post_meta($id, '_adm_mother_occupation', true),
    );
    mlzs_admission_render_table($fields);
}

/**
 * Meta box: Family Annual Income & Contact
 */
function mlzs_admission_meta_family_contact($post) {
    $id = $post->ID;
    $income_val = get_post_meta($id, '_adm_income', true);
    $income_labels = array('lt_6' => '< 6 Lacs', 'lt_10' => '< 10 Lacs', 'lt_20' => '< 20 Lacs');
    if (isset($income_labels[$income_val])) {
        $income_val = $income_labels[$income_val];
    }
    $fields = array(
        __('Family Annual Income', 'mlzs') => $income_val,
        __('Address', 'mlzs') => get_post_meta($id, '_adm_address', true),
        __('Email', 'mlzs') => get_post_meta($id, '_adm_email', true),
        __('Contact', 'mlzs') => get_post_meta($id, '_adm_contact', true),
        __('Preferred Visit Date', 'mlzs') => get_post_meta($id, '_adm_preferred_visit_date', true),
    );
    mlzs_admission_render_table($fields);
}

add_action('add_meta_boxes', function() {
    add_meta_box('mlzs_admission_reg_child', __('Registration & Child\'s Information', 'mlzs'), 'mlzs_admission_meta_registration_child', MLZS_ADMISSION_CPT, 'normal', 'high');
    add_meta_box('mlzs_admission_father', __("Father's Information", 'mlzs'), 'mlzs_admission_meta_father', MLZS_ADMISSION_CPT, 'normal');
    add_meta_box('mlzs_admission_mother', __("Mother's Information", 'mlzs'), 'mlzs_admission_meta_mother', MLZS_ADMISSION_CPT, 'normal');
    add_meta_box('mlzs_admission_family_contact', __('Family Annual Income & Contact', 'mlzs'), 'mlzs_admission_meta_family_contact', MLZS_ADMISSION_CPT, 'normal');
});

/**
 * AJAX handler: Admission Registration Form
 */
function mlzs_ajax_admission() {
    header('Content-Type: application/json; charset=utf-8');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        wp_send_json_error(array('message' => __('Invalid request.', 'mlzs')));
    }

    $nonce = isset($_POST['mlzs_admission_nonce']) ? sanitize_text_field(wp_unslash($_POST['mlzs_admission_nonce'])) : '';
    if (!wp_verify_nonce($nonce, MLZS_ADMISSION_NONCE_ACTION)) {
        wp_send_json_error(array('message' => __('Security check failed. Please refresh and try again.', 'mlzs')));
    }

    $ip = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'])) : '';
    $rate_key = 'mlzs_admission_' . md5($ip);
    if (get_transient($rate_key)) {
        wp_send_json_error(array('message' => __('Please wait a moment before submitting another registration.', 'mlzs')));
    }

    $adm_date = isset($_POST['adm_date']) ? sanitize_text_field(wp_unslash($_POST['adm_date'])) : '';
    $adm_enquiry_no = isset($_POST['adm_enquiry_no']) ? sanitize_text_field(wp_unslash($_POST['adm_enquiry_no'])) : '';
    $child_first = isset($_POST['child_first_name']) ? sanitize_text_field(wp_unslash($_POST['child_first_name'])) : '';
    $child_surname = isset($_POST['child_surname']) ? sanitize_text_field(wp_unslash($_POST['child_surname'])) : '';
    $child_dob = isset($_POST['child_dob']) ? sanitize_text_field(wp_unslash($_POST['child_dob'])) : '';
    $age_years = isset($_POST['age_years']) ? sanitize_text_field(wp_unslash($_POST['age_years'])) : '';
    $age_months = isset($_POST['age_months']) ? sanitize_text_field(wp_unslash($_POST['age_months'])) : '';
    $current_school = isset($_POST['current_school']) ? sanitize_text_field(wp_unslash($_POST['current_school'])) : '';
    $admission_class = isset($_POST['admission_class']) ? sanitize_text_field(wp_unslash($_POST['admission_class'])) : '';
    $father_first = isset($_POST['father_first_name']) ? sanitize_text_field(wp_unslash($_POST['father_first_name'])) : '';
    $father_surname = isset($_POST['father_surname']) ? sanitize_text_field(wp_unslash($_POST['father_surname'])) : '';
    $father_qual = isset($_POST['father_qualification']) ? sanitize_text_field(wp_unslash($_POST['father_qualification'])) : '';
    $father_occ = isset($_POST['father_occupation']) ? sanitize_text_field(wp_unslash($_POST['father_occupation'])) : '';
    $mother_first = isset($_POST['mother_first_name']) ? sanitize_text_field(wp_unslash($_POST['mother_first_name'])) : '';
    $mother_surname = isset($_POST['mother_surname']) ? sanitize_text_field(wp_unslash($_POST['mother_surname'])) : '';
    $mother_qual = isset($_POST['mother_qualification']) ? sanitize_text_field(wp_unslash($_POST['mother_qualification'])) : '';
    $mother_occ = isset($_POST['mother_occupation']) ? sanitize_text_field(wp_unslash($_POST['mother_occupation'])) : '';
    $income = isset($_POST['income']) ? sanitize_text_field(wp_unslash($_POST['income'])) : '';
    $address = isset($_POST['address']) ? sanitize_textarea_field(wp_unslash($_POST['address'])) : '';
    $email = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
    $contact = isset($_POST['contact']) ? sanitize_text_field(wp_unslash($_POST['contact'])) : '';
    $preferred_visit = isset($_POST['preferred_visit_date']) ? sanitize_text_field(wp_unslash($_POST['preferred_visit_date'])) : '';

    if (strlen($adm_date) < 5) {
        wp_send_json_error(array('message' => __('Please enter the date.', 'mlzs')));
    }
    if (strlen($child_first) < 2) {
        wp_send_json_error(array('message' => __('Please enter child\'s first name.', 'mlzs')));
    }
    if (strlen($child_surname) < 2) {
        wp_send_json_error(array('message' => __('Please enter child\'s surname.', 'mlzs')));
    }
    if (strlen($child_dob) < 5) {
        wp_send_json_error(array('message' => __('Please enter date of birth.', 'mlzs')));
    }
    if (strlen($admission_class) < 1) {
        wp_send_json_error(array('message' => __('Please enter class for admission.', 'mlzs')));
    }
    if (strlen($father_first) < 2 || strlen($father_surname) < 2) {
        wp_send_json_error(array('message' => __('Please enter father\'s name.', 'mlzs')));
    }
    if (strlen($mother_first) < 2 || strlen($mother_surname) < 2) {
        wp_send_json_error(array('message' => __('Please enter mother\'s name.', 'mlzs')));
    }
    if (strlen($address) < 5) {
        wp_send_json_error(array('message' => __('Please enter address.', 'mlzs')));
    }
    if (!is_email($email)) {
        wp_send_json_error(array('message' => __('Please enter a valid email address.', 'mlzs')));
    }
    $contact_digits = preg_replace('/\D/', '', $contact);
    if (strlen($contact_digits) !== 10) {
        wp_send_json_error(array('message' => __('Please enter a valid 10-digit contact number.', 'mlzs')));
    }
    $contact = $contact_digits;

    $child_name = trim($child_first . ' ' . $child_surname);
    $post_id = wp_insert_post(array(
        'post_type'   => MLZS_ADMISSION_CPT,
        'post_status' => 'publish',
        'post_title'  => $child_name . ' – ' . $admission_class,
        'post_author' => 0,
    ));

    if (is_wp_error($post_id)) {
        wp_send_json_error(array('message' => __('Sorry, something went wrong. Please try again.', 'mlzs')));
    }

    $meta = array(
        '_adm_date' => $adm_date,
        '_adm_enquiry_no' => $adm_enquiry_no,
        '_adm_child_first_name' => $child_first,
        '_adm_child_surname' => $child_surname,
        '_adm_child_dob' => $child_dob,
        '_adm_age_years' => $age_years,
        '_adm_age_months' => $age_months,
        '_adm_current_school' => $current_school,
        '_adm_admission_class' => $admission_class,
        '_adm_father_first_name' => $father_first,
        '_adm_father_surname' => $father_surname,
        '_adm_father_qualification' => $father_qual,
        '_adm_father_occupation' => $father_occ,
        '_adm_mother_first_name' => $mother_first,
        '_adm_mother_surname' => $mother_surname,
        '_adm_mother_qualification' => $mother_qual,
        '_adm_mother_occupation' => $mother_occ,
        '_adm_income' => $income,
        '_adm_address' => $address,
        '_adm_email' => $email,
        '_adm_contact' => $contact,
        '_adm_preferred_visit_date' => $preferred_visit,
    );
    foreach ($meta as $k => $v) {
        update_post_meta($post_id, $k, $v);
    }

    $subject = sprintf('[%s] New Admission Registration: %s – %s', get_bloginfo('name'), $child_name, $admission_class);
    $body = mlzs_email_body_admission($meta);
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail(MLZS_ADMISSION_EMAIL, $subject, $body, $headers);

    set_transient($rate_key, 1, MLZS_ADMISSION_RATE_LIMIT_SECONDS);

    wp_send_json_success(array(
        'message' => __('Thank you! Your registration has been submitted. We will contact you soon.', 'mlzs'),
    ));
}
add_action('wp_ajax_mlzs_admission', 'mlzs_ajax_admission');
add_action('wp_ajax_nopriv_mlzs_admission', 'mlzs_ajax_admission');
