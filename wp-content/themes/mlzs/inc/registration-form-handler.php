<?php
/**
 * Registration Form – CPT, AJAX, file uploads, wp_mail.
 * Student Registration form (form.php page).
 * Email: rmalwar.mlzs@gmail.com
 */

if (!defined('ABSPATH')) {
    exit;
}

define('MLZS_REG_EMAIL', 'rmalwar.mlzs@gmail.com');
define('MLZS_REG_NONCE_ACTION', 'mlzs_registration');
define('MLZS_REG_CPT', 'mlzs_student_reg');
define('MLZS_REG_RATE_LIMIT_SECONDS', 180);

/**
 * Register CPT: Student Registration
 */
function mlzs_register_student_registration_cpt() {
    $labels = array(
        'name'               => _x('Student Registrations', 'post type general name', 'mlzs'),
        'singular_name'      => _x('Student Registration', 'post type singular name', 'mlzs'),
        'menu_name'          => _x('Student Registrations', 'admin menu', 'mlzs'),
        'add_new_item'       => __('Add New Registration', 'mlzs'),
        'edit_item'          => __('View Registration', 'mlzs'),
        'search_items'       => __('Search Registrations', 'mlzs'),
        'not_found'          => __('No registrations found.', 'mlzs'),
    );
    $args = array(
        'labels'              => $labels,
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 27,
        'menu_icon'           => 'dashicons-id',
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'supports'            => array('title'),
        'has_archive'         => false,
        'rewrite'             => false,
        'query_var'           => false,
    );
    register_post_type(MLZS_REG_CPT, $args);
}
add_action('init', 'mlzs_register_student_registration_cpt', 5);

function mlzs_student_reg_columns($columns) {
    $new = array();
    $new['cb'] = $columns['cb'];
    $new['title'] = __('Child Name', 'mlzs');
    $new['reg_class'] = __('Class', 'mlzs');
    $new['reg_contact'] = __('Contact', 'mlzs');
    $new['reg_email'] = __('Email', 'mlzs');
    $new['date'] = $columns['date'];
    return $new;
}
add_filter('manage_' . MLZS_REG_CPT . '_posts_columns', 'mlzs_student_reg_columns');

function mlzs_student_reg_column_content($column, $post_id) {
    switch ($column) {
        case 'reg_class':
            echo esc_html(get_post_meta($post_id, '_reg_class_sought', true) ?: '—');
            break;
        case 'reg_contact':
            echo esc_html(get_post_meta($post_id, '_reg_mobile_permanent', true) ?: '—');
            break;
        case 'reg_email':
            echo esc_html(get_post_meta($post_id, '_reg_email', true) ?: '—');
            break;
    }
}
add_action('manage_' . MLZS_REG_CPT . '_posts_custom_column', 'mlzs_student_reg_column_content', 10, 2);

/**
 * Helper to render a meta box table (supports HTML in values for links).
 */
function mlzs_reg_render_table($fields) {
    echo '<table class="form-table"><tbody>';
    foreach ($fields as $label => $value) {
        $val = ($value === '' || $value === null) ? '—' : $value;
        $out = (is_string($val) && strpos($val, '<a ') === 0) ? $val : esc_html($val);
        echo '<tr><th scope="row" style="width:140px;">' . esc_html($label) . '</th><td>' . $out . '</td></tr>';
    }
    echo '</tbody></table>';
}

function mlzs_reg_photo_link($att_id) {
    if (!$att_id) return '—';
    $url = wp_get_attachment_url($att_id);
    return $url ? '<a href="' . esc_url($url) . '" target="_blank" rel="noopener">View</a>' : '—';
}

/**
 * Meta box: Registration & Child's Information
 */
function mlzs_reg_meta_registration_child($post) {
    $id = $post->ID;
    $g = function($k) use ($id) { return get_post_meta($id, $k, true) ?: ''; };
    $age = ($g('_reg_age_years') || $g('_reg_age_months') || $g('_reg_age_days')) ? trim($g('_reg_age_years') . 'y ' . $g('_reg_age_months') . 'm ' . $g('_reg_age_days') . 'd') : '';
    $mother_tongue = trim(($g('_reg_mother_tongue') ?: '') . ($g('_reg_mother_tongue_other_text') ? ' / ' . $g('_reg_mother_tongue_other_text') : ''));
    $adm_cat = trim(($g('_reg_admission_category') ?: '') . ($g('_reg_admission_category_other_text') ? ' / ' . $g('_reg_admission_category_other_text') : ''));
    $fields = array(
        __('Session', 'mlzs') => trim($g('_reg_start_year') . '-' . $g('_reg_end_year'), '-'),
        __('Name', 'mlzs') => $g('_reg_child_name'),
        __('Sex', 'mlzs') => $g('_reg_sex'),
        __('Date of Birth', 'mlzs') => $g('_reg_dob'),
        __('Aadhar', 'mlzs') => $g('_reg_aadhar'),
        __('Age (as on 31 March)', 'mlzs') => $age,
        __('Blood Group', 'mlzs') => $g('_reg_blood_group'),
        __('Place of Birth', 'mlzs') => $g('_reg_place_of_birth'),
        __('City of Birth', 'mlzs') => $g('_reg_city_of_birth'),
        __('State of Birth', 'mlzs') => $g('_reg_state_of_birth'),
        __('Class Sought', 'mlzs') => $g('_reg_class_sought'),
        __('Admission Class (in words)', 'mlzs') => $g('_reg_admission_class_words'),
        __('Current School', 'mlzs') => $g('_reg_current_school'),
        __('Current Class', 'mlzs') => $g('_reg_current_class'),
        __('Nationality', 'mlzs') => $g('_reg_nationality'),
        __('Domicile', 'mlzs') => $g('_reg_domicile'),
        __('Source of Information', 'mlzs') => $g('_reg_source_info'),
        __('Mother Tongue', 'mlzs') => $mother_tongue,
        __('Admission Category', 'mlzs') => $adm_cat,
        __('Health Info', 'mlzs') => $g('_reg_health_info'),
        __('Student Photo', 'mlzs') => mlzs_reg_photo_link($g('_reg_student_photo')),
    );
    mlzs_reg_render_table($fields);
}

/**
 * Meta box: Father's Information
 */
function mlzs_reg_meta_father($post) {
    $id = $post->ID;
    $g = function($k) use ($id) { return get_post_meta($id, $k, true) ?: ''; };
    $fields = array(
        __('Name', 'mlzs') => $g('_reg_father_name'),
        __('Age', 'mlzs') => $g('_reg_father_age'),
        __('Academic Qualification', 'mlzs') => $g('_reg_father_qualification'),
        __('Aadhar Card Number', 'mlzs') => $g('_reg_father_aadhar'),
        __('Profession', 'mlzs') => $g('_reg_father_profession'),
        __('Organization', 'mlzs') => $g('_reg_father_organization'),
        __('Designation', 'mlzs') => $g('_reg_father_designation'),
        __('Office Address', 'mlzs') => $g('_reg_father_office_address'),
        __('City/State', 'mlzs') => $g('_reg_father_city_state'),
        __('Office Mobile Number', 'mlzs') => $g('_reg_father_office_mobile'),
        __('Mobile Number', 'mlzs') => $g('_reg_father_mobile'),
        __('Email', 'mlzs') => $g('_reg_father_email'),
        __('Father Photo', 'mlzs') => mlzs_reg_photo_link($g('_reg_father_photo')),
    );
    mlzs_reg_render_table($fields);
}

/**
 * Meta box: Mother's Information
 */
function mlzs_reg_meta_mother($post) {
    $id = $post->ID;
    $g = function($k) use ($id) { return get_post_meta($id, $k, true) ?: ''; };
    $fields = array(
        __('Name', 'mlzs') => $g('_reg_mother_name'),
        __('Age', 'mlzs') => $g('_reg_mother_age'),
        __('Academic Qualification', 'mlzs') => $g('_reg_mother_qualification'),
        __('Aadhar Card Number', 'mlzs') => $g('_reg_mother_aadhar'),
        __('Profession', 'mlzs') => $g('_reg_mother_profession'),
        __('Organization', 'mlzs') => $g('_reg_mother_organization'),
        __('Designation', 'mlzs') => $g('_reg_mother_designation'),
        __('Office Address', 'mlzs') => $g('_reg_mother_office_address'),
        __('City/State', 'mlzs') => $g('_reg_mother_city_state'),
        __('Office Mobile Number', 'mlzs') => $g('_reg_mother_office_mobile'),
        __('Mobile Number', 'mlzs') => $g('_reg_mother_mobile'),
        __('Email', 'mlzs') => $g('_reg_mother_email'),
        __('Mother Photo', 'mlzs') => mlzs_reg_photo_link($g('_reg_mother_photo')),
    );
    mlzs_reg_render_table($fields);
}

/**
 * Meta box: Address & Contact
 */
function mlzs_reg_meta_address_contact($post) {
    $id = $post->ID;
    $g = function($k) use ($id) { return get_post_meta($id, $k, true) ?: ''; };
    $fields = array(
        __('Permanent Address', 'mlzs') => $g('_reg_permanent_address'),
        __('State', 'mlzs') => $g('_reg_state_permanent'),
        __('District', 'mlzs') => $g('_reg_district_permanent'),
        __('Mobile No.', 'mlzs') => $g('_reg_mobile_permanent'),
        __('PIN Code', 'mlzs') => $g('_reg_pincode_permanent'),
        __('Resident Address', 'mlzs') => $g('_reg_resident_address'),
        __('Resident State', 'mlzs') => $g('_reg_state_resident'),
        __('Resident District', 'mlzs') => $g('_reg_district_resident'),
        __('Resident Mobile No.', 'mlzs') => $g('_reg_mobile_resident'),
        __('Resident PIN Code', 'mlzs') => $g('_reg_pincode_resident'),
        __('Email', 'mlzs') => $g('_reg_email'),
    );
    mlzs_reg_render_table($fields);
}

add_action('add_meta_boxes', function() {
    add_meta_box('mlzs_reg_reg_child', __('Registration & Child\'s Information', 'mlzs'), 'mlzs_reg_meta_registration_child', MLZS_REG_CPT, 'normal', 'high');
    add_meta_box('mlzs_reg_father', __("Father's Information", 'mlzs'), 'mlzs_reg_meta_father', MLZS_REG_CPT, 'normal');
    add_meta_box('mlzs_reg_mother', __("Mother's Information", 'mlzs'), 'mlzs_reg_meta_mother', MLZS_REG_CPT, 'normal');
    add_meta_box('mlzs_reg_address_contact', __('Address & Contact', 'mlzs'), 'mlzs_reg_meta_address_contact', MLZS_REG_CPT, 'normal');
});

/**
 * AJAX handler: Registration Form (with file uploads)
 */
function mlzs_ajax_registration() {
    header('Content-Type: application/json; charset=utf-8');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        wp_send_json_error(array('message' => __('Invalid request.', 'mlzs')));
    }

    $nonce = isset($_POST['mlzs_registration_nonce']) ? sanitize_text_field(wp_unslash($_POST['mlzs_registration_nonce'])) : '';
    if (!wp_verify_nonce($nonce, MLZS_REG_NONCE_ACTION)) {
        wp_send_json_error(array('message' => __('Security check failed. Please refresh and try again.', 'mlzs')));
    }

    $ip = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'])) : '';
    $rate_key = 'mlzs_reg_' . md5($ip);
    if (get_transient($rate_key)) {
        wp_send_json_error(array('message' => __('Please wait before submitting another registration.', 'mlzs')));
    }

    $child_name = isset($_POST['child_name']) ? sanitize_text_field(wp_unslash($_POST['child_name'])) : '';
    if (strlen($child_name) < 2) {
        wp_send_json_error(array('message' => __('Please enter child\'s name.', 'mlzs')));
    }

    $email = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
    if (!is_email($email)) {
        wp_send_json_error(array('message' => __('Please enter a valid email address.', 'mlzs')));
    }

    $mobile = isset($_POST['mobile_permanent']) ? sanitize_text_field(wp_unslash($_POST['mobile_permanent'])) : '';
    $mobile_digits = preg_replace('/\D/', '', $mobile);
    if (strlen($mobile_digits) < 10) {
        wp_send_json_error(array('message' => __('Please enter a valid 10-digit contact number.', 'mlzs')));
    }

    // File uploads
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    $upload_overrides = array('test_form' => false, 'mimes' => array('jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif', 'webp' => 'image/webp'));

    $student_photo_id = 0;
    if (!empty($_FILES['student_photo']['name']) && $_FILES['student_photo']['error'] === UPLOAD_ERR_OK) {
        $file = wp_handle_upload($_FILES['student_photo'], $upload_overrides);
        if (!isset($file['error'])) {
            $attachment = array(
                'post_mime_type' => $file['type'],
                'post_title'     => sanitize_file_name(pathinfo($_FILES['student_photo']['name'], PATHINFO_FILENAME)),
                'post_content'   => '',
                'post_status'    => 'inherit',
            );
            $student_photo_id = wp_insert_attachment($attachment, $file['file']);
            if (!is_wp_error($student_photo_id)) {
                wp_generate_attachment_metadata($student_photo_id, $file['file']);
            } else {
                $student_photo_id = 0;
            }
        }
    }

    $mother_photo_id = 0;
    if (!empty($_FILES['mother_photo']['name']) && $_FILES['mother_photo']['error'] === UPLOAD_ERR_OK) {
        $file = wp_handle_upload($_FILES['mother_photo'], $upload_overrides);
        if (!isset($file['error'])) {
            $attachment = array('post_mime_type' => $file['type'], 'post_title' => sanitize_file_name(pathinfo($_FILES['mother_photo']['name'], PATHINFO_FILENAME)), 'post_content' => '', 'post_status' => 'inherit');
            $mother_photo_id = wp_insert_attachment($attachment, $file['file']);
            if (!is_wp_error($mother_photo_id)) wp_generate_attachment_metadata($mother_photo_id, $file['file']);
            else $mother_photo_id = 0;
        }
    }

    $father_photo_id = 0;
    if (!empty($_FILES['father_photo']['name']) && $_FILES['father_photo']['error'] === UPLOAD_ERR_OK) {
        $file = wp_handle_upload($_FILES['father_photo'], $upload_overrides);
        if (!isset($file['error'])) {
            $attachment = array('post_mime_type' => $file['type'], 'post_title' => sanitize_file_name(pathinfo($_FILES['father_photo']['name'], PATHINFO_FILENAME)), 'post_content' => '', 'post_status' => 'inherit');
            $father_photo_id = wp_insert_attachment($attachment, $file['file']);
            if (!is_wp_error($father_photo_id)) wp_generate_attachment_metadata($father_photo_id, $file['file']);
            else $father_photo_id = 0;
        }
    }

    $stream = isset($_POST['stream']) ? sanitize_text_field(wp_unslash($_POST['stream'])) : '';
    $class_sought = '';
    if ($stream === '1to10') $class_sought = isset($_POST['class_1to10']) ? sanitize_text_field(wp_unslash($_POST['class_1to10'])) : '';
    elseif ($stream === 'xi') $class_sought = 'XI - ' . (isset($_POST['class_xi']) ? sanitize_text_field(wp_unslash($_POST['class_xi'])) : '');
    elseif ($stream === 'xii') $class_sought = 'XII - ' . (isset($_POST['class_xii']) ? sanitize_text_field(wp_unslash($_POST['class_xii'])) : '');
    if (empty($class_sought)) $class_sought = isset($_POST['admission_class_words']) ? sanitize_text_field(wp_unslash($_POST['admission_class_words'])) : '';

    $post_id = wp_insert_post(array(
        'post_type'   => MLZS_REG_CPT,
        'post_status' => 'publish',
        'post_title'  => $child_name . ' – ' . $class_sought,
        'post_author' => 0,
    ));

    if (is_wp_error($post_id)) {
        wp_send_json_error(array('message' => __('Sorry, something went wrong. Please try again.', 'mlzs')));
    }

    $meta_map = array(
        'startyear' => '_reg_start_year', 'endyear' => '_reg_end_year',
        'child_name' => '_reg_child_name', 'sex' => '_reg_sex', 'dob' => '_reg_dob', 'aadhar' => '_reg_aadhar',
        'age_years' => '_reg_age_years', 'age_months' => '_reg_age_months', 'age_days' => '_reg_age_days', 'blood_group' => '_reg_blood_group',
        'place_of_birth' => '_reg_place_of_birth', 'city_of_birth' => '_reg_city_of_birth', 'state_of_birth' => '_reg_state_of_birth',
        'admission_class_words' => '_reg_admission_class_words', 'current_school' => '_reg_current_school', 'current_class' => '_reg_current_class',
        'nationality' => '_reg_nationality', 'domicile' => '_reg_domicile',
        'permanent_address' => '_reg_permanent_address', 'resident_address' => '_reg_resident_address',
        'state_permanent' => '_reg_state_permanent', 'district_permanent' => '_reg_district_permanent',
        'state_resident' => '_reg_state_resident', 'district_resident' => '_reg_district_resident',
        'mobile_permanent' => '_reg_mobile_permanent', 'pincode_permanent' => '_reg_pincode_permanent',
        'mobile_resident' => '_reg_mobile_resident', 'pincode_resident' => '_reg_pincode_resident',
        'email' => '_reg_email', 'health_info' => '_reg_health_info',
        'mother_name' => '_reg_mother_name', 'mother_age' => '_reg_mother_age', 'mother_qualification' => '_reg_mother_qualification',
        'mother_aadhar' => '_reg_mother_aadhar', 'mother_profession' => '_reg_mother_profession', 'mother_organization' => '_reg_mother_organization',
        'mother_designation' => '_reg_mother_designation', 'mother_office_address' => '_reg_mother_office_address',
        'mother_city_state' => '_reg_mother_city_state', 'mother_office_mobile' => '_reg_mother_office_mobile',
        'mother_mobile' => '_reg_mother_mobile', 'mother_email' => '_reg_mother_email',
        'father_name' => '_reg_father_name', 'father_age' => '_reg_father_age', 'father_qualification' => '_reg_father_qualification',
        'father_aadhar' => '_reg_father_aadhar', 'father_profession' => '_reg_father_profession', 'father_organization' => '_reg_father_organization',
        'father_designation' => '_reg_father_designation', 'father_office_address' => '_reg_father_office_address',
        'father_city_state' => '_reg_father_city_state', 'father_office_mobile' => '_reg_father_office_mobile',
        'father_mobile' => '_reg_father_mobile', 'father_email' => '_reg_father_email',
    );
    foreach ($meta_map as $post_key => $meta_key) {
        $val = isset($_POST[$post_key]) ? (is_array($_POST[$post_key]) ? array_map('sanitize_text_field', array_map('wp_unslash', $_POST[$post_key])) : sanitize_text_field(wp_unslash($_POST[$post_key]))) : '';
        if (is_array($val)) $val = implode(', ', $val);
        update_post_meta($post_id, $meta_key, $val);
    }
    update_post_meta($post_id, '_reg_class_sought', $class_sought);
    update_post_meta($post_id, '_reg_student_photo', $student_photo_id);
    update_post_meta($post_id, '_reg_mother_photo', $mother_photo_id);
    update_post_meta($post_id, '_reg_father_photo', $father_photo_id);

    foreach (array('source_info', 'mother_tongue', 'mother_tongue_other_text', 'admission_category', 'admission_category_other_text') as $k) {
        $v = isset($_POST[$k]) ? (is_array($_POST[$k]) ? implode(', ', array_map('sanitize_text_field', array_map('wp_unslash', $_POST[$k]))) : sanitize_text_field(wp_unslash($_POST[$k]))) : '';
        update_post_meta($post_id, '_reg_' . $k, $v);
    }

    $meta_for_email = array();
    foreach (get_post_meta($post_id) as $k => $arr) {
        if (strpos($k, '_reg_') === 0) $meta_for_email[$k] = isset($arr[0]) ? $arr[0] : '';
    }

    $subject = sprintf('[%s] New Student Registration: %s – %s', get_bloginfo('name'), $child_name, $class_sought);
    $body = function_exists('mlzs_email_body_registration') ? mlzs_email_body_registration($meta_for_email) : '';
    if ($body) {
        $headers = array('Content-Type: text/html; charset=UTF-8');
        wp_mail(MLZS_REG_EMAIL, $subject, $body, $headers);
    }

    set_transient($rate_key, 1, MLZS_REG_RATE_LIMIT_SECONDS);

    wp_send_json_success(array(
        'message' => __('Thank you! Your registration has been submitted successfully. We will contact you soon.', 'mlzs'),
    ));
}
add_action('wp_ajax_mlzs_registration', 'mlzs_ajax_registration');
add_action('wp_ajax_nopriv_mlzs_registration', 'mlzs_ajax_registration');
