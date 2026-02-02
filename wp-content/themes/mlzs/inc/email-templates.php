<?php
/**
 * HTML Email Templates – Contact, Enquiry, Admission.
 * Premium card-based design. Inline CSS + tables for email client compatibility.
 */

if (!defined('ABSPATH')) {
    exit;
}

define('MLZS_EMAIL_PRIMARY', '#3D348B');
define('MLZS_EMAIL_PRIMARY_LIGHT', '#5b52a8');
define('MLZS_EMAIL_ACCENT', '#F7B801');
define('MLZS_EMAIL_TEXT', '#1e293b');
define('MLZS_EMAIL_TEXT_LIGHT', '#64748b');
define('MLZS_EMAIL_BG_SOFT', '#f8fafc');
define('MLZS_EMAIL_BORDER', '#e2e8f0');

/**
 * Base email wrapper – outer container, card, header, footer.
 */
function mlzs_email_wrapper($title, $content, $hero_subtitle = '') {
    $site_name = get_bloginfo('name');
    $date     = wp_date('l, F j, Y \a\t g:i A');
    $year     = wp_date('Y');
    $hero     = $hero_subtitle ? '<p style="margin:10px 0 0;font-size:15px;color:rgba(255,255,255,0.9);font-weight:500;">' . esc_html($hero_subtitle) . '</p>' : '<p style="margin:8px 0 0;font-size:13px;color:rgba(255,255,255,0.85);">' . esc_html($title) . '</p>';

    return '<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . esc_html($title) . '</title>
</head>
<body style="margin:0;padding:0;background-color:#e2e8f0;font-family:\'Segoe UI\',Tahoma,Geneva,Verdana,sans-serif;-webkit-font-smoothing:antialiased;">
<table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:#e2e8f0;">
    <tr>
        <td align="center" style="padding:40px 20px;">
            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="max-width:580px;margin:0 auto;background:#ffffff;border-radius:16px;box-shadow:0 10px 40px rgba(61,52,139,0.12),0 2px 10px rgba(0,0,0,0.06);overflow:hidden;">
                <tr>
                    <td style="background:linear-gradient(145deg,' . MLZS_EMAIL_PRIMARY . ' 0%,#2a2357 100%);padding:36px 40px;text-align:center;">
                        <h1 style="margin:0;font-size:24px;font-weight:700;color:#ffffff;letter-spacing:-0.03em;">' . esc_html($site_name) . '</h1>
                        ' . $hero . '
                    </td>
                </tr>
                <tr>
                    <td style="padding:0;">
                        ' . $content . '
                    </td>
                </tr>
                <tr>
                    <td style="padding:24px 40px;background:' . MLZS_EMAIL_BG_SOFT . ';border-top:1px solid ' . MLZS_EMAIL_BORDER . ';font-size:12px;color:' . MLZS_EMAIL_TEXT_LIGHT . ';text-align:center;">
                        <p style="margin:0;">' . esc_html($date) . ' &nbsp;•&nbsp; Automated notification</p>
                        <p style="margin:6px 0 0;opacity:0.8;">&copy; ' . esc_html($year) . ' ' . esc_html($site_name) . '</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>';
}

/**
 * Card block – section with optional header bar.
 */
function mlzs_email_card($content, $title = '', $accent = false) {
    $bg    = $accent ? 'background:linear-gradient(90deg,' . MLZS_EMAIL_ACCENT . ' 0%,#e5a800 100%);' : 'background:' . MLZS_EMAIL_PRIMARY . ';';
    $title_html = $title ? '<tr><td style="padding:14px 20px;' . $bg . 'color:#ffffff;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;">' . esc_html($title) . '</td></tr>' : '';
    return '<table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="margin-bottom:24px;border-radius:12px;overflow:hidden;border:1px solid ' . MLZS_EMAIL_BORDER . ';background:#ffffff;">
        ' . $title_html . '
        <tr><td style="padding:24px 28px;">' . $content . '</td></tr>
    </table>';
}

/**
 * Info row – label + value, minimal border.
 */
function mlzs_email_info_row($label, $value, $last = false) {
    $border = $last ? 'none' : 'border-bottom:1px solid ' . MLZS_EMAIL_BORDER . ';';
    $val = $value ?: '—';
    return '<table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="' . $border . '">
        <tr>
            <td style="padding:10px 0;font-size:12px;color:' . MLZS_EMAIL_TEXT_LIGHT . ';width:45%;vertical-align:top;">' . esc_html($label) . '</td>
            <td style="padding:10px 0;font-size:15px;color:' . MLZS_EMAIL_TEXT . ';font-weight:500;line-height:1.5;">' . nl2br(esc_html($val)) . '</td>
        </tr>
    </table>';
}

/**
 * Hero message block – for contact form message.
 */
function mlzs_email_message_block($message) {
    return '<table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="margin:0 0 24px;">
        <tr>
            <td style="padding:20px 24px;background:' . MLZS_EMAIL_BG_SOFT . ';border-left:4px solid ' . MLZS_EMAIL_PRIMARY . ';border-radius:0 8px 8px 0;font-size:15px;color:' . MLZS_EMAIL_TEXT . ';line-height:1.7;">' . nl2br(esc_html($message)) . '</td>
        </tr>
    </table>';
}

/**
 * Contact strip – email + phone in a row.
 */
function mlzs_email_contact_strip($email, $phone) {
    $phone_html = $phone ? ' &nbsp;<span style="color:' . MLZS_EMAIL_BORDER . ';">|</span>&nbsp; <strong>' . esc_html($phone) . '</strong>' : '';
    return '<p style="margin:0;font-size:14px;color:' . MLZS_EMAIL_TEXT_LIGHT . ';"><a href="mailto:' . esc_attr($email) . '" style="color:' . MLZS_EMAIL_PRIMARY . ';text-decoration:none;font-weight:600;">' . esc_html($email) . '</a>' . $phone_html . '</p>';
}

/**
 * Build HTML body for Contact (footer) form submission.
 */
function mlzs_email_body_contact($name, $email, $phone, $message) {
    $inner = '<p style="margin:0 0 20px;font-size:18px;font-weight:600;color:' . MLZS_EMAIL_TEXT . ';">' . esc_html($name) . '</p>';
    $inner .= mlzs_email_message_block($message);
    $inner .= mlzs_email_contact_strip($email, $phone);
    $content = '<div style="padding:32px 36px;">' . $inner . '</div>';
    return mlzs_email_wrapper(__('New Contact Submission', 'mlzs'), $content, sprintf(__('Message from %s', 'mlzs'), $name));
}

/**
 * Build HTML body for Enquiry form submission.
 */
function mlzs_email_body_enquiry($name, $class, $contact, $email) {
    $hero = sprintf(__('%s — Class %s', 'mlzs'), $name, $class);
    $highlight = '<table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="margin-bottom:24px;">
        <tr>
            <td style="padding:20px 24px;background:linear-gradient(90deg,rgba(61,52,139,0.1) 0%,rgba(61,52,139,0.02) 100%);border-radius:10px;border:1px solid rgba(61,52,139,0.15);">
                <p style="margin:0;font-size:20px;font-weight:700;color:' . MLZS_EMAIL_PRIMARY . ';">' . esc_html($name) . '</p>
                <p style="margin:6px 0 0;font-size:14px;color:' . MLZS_EMAIL_TEXT_LIGHT . ';">' . sprintf(esc_html__('Admission enquiry for Class %s', 'mlzs'), esc_html($class)) . '</p>
            </td>
        </tr>
    </table>';
    $rows = mlzs_email_info_row(__("Child's Name", 'mlzs'), $name, false);
    $rows .= mlzs_email_info_row(__('Class', 'mlzs'), $class, false);
    $rows .= mlzs_email_info_row(__('Contact Number', 'mlzs'), $contact, false);
    $rows .= mlzs_email_info_row(__('Email', 'mlzs'), $email, true);
    $content = '<div style="padding:32px 36px;">' . $highlight . mlzs_email_card($rows) . '</div>';
    return mlzs_email_wrapper(__('New Admission Enquiry', 'mlzs'), $content, $hero);
}

/**
 * Build HTML body for Admission Registration form submission.
 *
 * @param array $meta Post meta array (keys like _adm_date, _adm_child_first_name, etc.).
 * @return string Full HTML email body.
 */
function mlzs_email_body_admission($meta) {
    $v = function($key) use ($meta) { return isset($meta[$key]) ? (string) $meta[$key] : ''; };
    $income_labels = array('lt_6' => '< 6 Lacs', 'lt_10' => '< 10 Lacs', 'lt_20' => '< 20 Lacs');
    $income_val = isset($income_labels[$v('_adm_income')]) ? $income_labels[$v('_adm_income')] : ($v('_adm_income') ?: '—');

    $child_name = trim($v('_adm_child_first_name') . ' ' . $v('_adm_child_surname'));
    $class_sought = $v('_adm_admission_class');
    $hero = $child_name . ' — Class ' . $class_sought;

    $age = ($v('_adm_age_years') || $v('_adm_age_months')) ? trim($v('_adm_age_years') . ' yrs ' . $v('_adm_age_months') . ' months') : '—';

    $child_rows = mlzs_email_info_row(__('Date', 'mlzs'), $v('_adm_date'), false);
    $child_rows .= mlzs_email_info_row(__('Enquiry/Reg. No.', 'mlzs'), $v('_adm_enquiry_no') ?: '—', false);
    $child_rows .= mlzs_email_info_row(__("Child's Name", 'mlzs'), $child_name, false);
    $child_rows .= mlzs_email_info_row(__('Date of Birth', 'mlzs'), $v('_adm_child_dob'), false);
    $child_rows .= mlzs_email_info_row(__('Current Age', 'mlzs'), $age, false);
    $child_rows .= mlzs_email_info_row(__('Current School', 'mlzs'), $v('_adm_current_school') ?: '—', false);
    $child_rows .= mlzs_email_info_row(__('Class Sought', 'mlzs'), $class_sought, true);

    $father_name = trim($v('_adm_father_first_name') . ' ' . $v('_adm_father_surname'));
    $father_rows = mlzs_email_info_row(__('Name', 'mlzs'), $father_name, false);
    $father_rows .= mlzs_email_info_row(__('Qualification', 'mlzs'), $v('_adm_father_qualification') ?: '—', false);
    $father_rows .= mlzs_email_info_row(__('Occupation', 'mlzs'), $v('_adm_father_occupation') ?: '—', true);

    $mother_name = trim($v('_adm_mother_first_name') . ' ' . $v('_adm_mother_surname'));
    $mother_rows = mlzs_email_info_row(__('Name', 'mlzs'), $mother_name, false);
    $mother_rows .= mlzs_email_info_row(__('Qualification', 'mlzs'), $v('_adm_mother_qualification') ?: '—', false);
    $mother_rows .= mlzs_email_info_row(__('Occupation', 'mlzs'), $v('_adm_mother_occupation') ?: '—', true);

    $contact_rows = mlzs_email_info_row(__('Family Annual Income', 'mlzs'), $income_val, false);
    $contact_rows .= mlzs_email_info_row(__('Address', 'mlzs'), $v('_adm_address'), false);
    $contact_rows .= mlzs_email_info_row(__('Email', 'mlzs'), $v('_adm_email'), false);
    $contact_rows .= mlzs_email_info_row(__('Contact', 'mlzs'), $v('_adm_contact'), false);
    $contact_rows .= mlzs_email_info_row(__('Preferred Visit Date', 'mlzs'), $v('_adm_preferred_visit_date') ?: '—', true);

    $cards = mlzs_email_card($child_rows, __("Child's Information", 'mlzs'), false);
    $cards .= mlzs_email_card($father_rows, __("Father's Information", 'mlzs'), true);
    $cards .= mlzs_email_card($mother_rows, __("Mother's Information", 'mlzs'), false);
    $cards .= mlzs_email_card($contact_rows, __('Family & Contact', 'mlzs'), false);

    $content = '<div style="padding:32px 36px;">' . $cards . '</div>';
    return mlzs_email_wrapper(__('New Admission Registration', 'mlzs'), $content, $hero);
}

/**
 * Build HTML body for Student Registration form (form.php).
 *
 * @param array $meta Post meta (keys _reg_child_name, _reg_dob, etc.).
 * @return string Full HTML email body.
 */
function mlzs_email_body_registration($meta) {
    $v = function($key) use ($meta) { return isset($meta[$key]) ? (string) $meta[$key] : ''; };
    $child_name = $v('_reg_child_name');
    $class_sought = $v('_reg_class_sought');
    $hero = $child_name . ' — ' . $class_sought;

    $child_rows = mlzs_email_info_row(__('Session', 'mlzs'), $v('_reg_start_year') . '-' . $v('_reg_end_year'), false);
    $child_rows .= mlzs_email_info_row(__("Child's Name", 'mlzs'), $child_name, false);
    $child_rows .= mlzs_email_info_row(__('Sex', 'mlzs'), $v('_reg_sex') ?: '—', false);
    $child_rows .= mlzs_email_info_row(__('Date of Birth', 'mlzs'), $v('_reg_dob'), false);
    $child_rows .= mlzs_email_info_row(__('Aadhar', 'mlzs'), $v('_reg_aadhar') ?: '—', false);
    $child_rows .= mlzs_email_info_row(__('Age (as on 31 Mar)', 'mlzs'), trim($v('_reg_age_years') . 'y ' . $v('_reg_age_months') . 'm ' . $v('_reg_age_days') . 'd') ?: '—', false);
    $child_rows .= mlzs_email_info_row(__('Blood Group', 'mlzs'), $v('_reg_blood_group') ?: '—', false);
    $child_rows .= mlzs_email_info_row(__('Place/City/State of Birth', 'mlzs'), trim($v('_reg_place_of_birth') . ', ' . $v('_reg_city_of_birth') . ', ' . $v('_reg_state_of_birth'), ', ') ?: '—', false);
    $child_rows .= mlzs_email_info_row(__('Class Sought', 'mlzs'), $class_sought, false);
    $child_rows .= mlzs_email_info_row(__('Current School', 'mlzs'), $v('_reg_current_school') ?: '—', false);
    $child_rows .= mlzs_email_info_row(__('Current Class', 'mlzs'), $v('_reg_current_class') ?: '—', false);
    $child_rows .= mlzs_email_info_row(__('Nationality', 'mlzs'), $v('_reg_nationality') ?: '—', false);
    $child_rows .= mlzs_email_info_row(__('Domicile', 'mlzs'), $v('_reg_domicile') ?: '—', false);
    $child_rows .= mlzs_email_info_row(__('Source of Info', 'mlzs'), $v('_reg_source_info') ?: '—', false);
    $child_rows .= mlzs_email_info_row(__('Mother Tongue', 'mlzs'), $v('_reg_mother_tongue') ?: '—', false);
    $child_rows .= mlzs_email_info_row(__('Admission Category', 'mlzs'), $v('_reg_admission_category') ?: '—', false);
    $child_rows .= mlzs_email_info_row(__('Health Info', 'mlzs'), $v('_reg_health_info') ?: '—', true);

    $father_rows = mlzs_email_info_row(__('Name', 'mlzs'), $v('_reg_father_name'), false);
    $father_rows .= mlzs_email_info_row(__('Age', 'mlzs'), $v('_reg_father_age') ?: '—', false);
    $father_rows .= mlzs_email_info_row(__('Qualification', 'mlzs'), $v('_reg_father_qualification') ?: '—', false);
    $father_rows .= mlzs_email_info_row(__('Profession', 'mlzs'), $v('_reg_father_profession') ?: '—', false);
    $father_rows .= mlzs_email_info_row(__('Organization', 'mlzs'), $v('_reg_father_organization') ?: '—', false);
    $father_rows .= mlzs_email_info_row(__('Mobile', 'mlzs'), $v('_reg_father_mobile'), false);
    $father_rows .= mlzs_email_info_row(__('Email', 'mlzs'), $v('_reg_father_email'), true);

    $mother_rows = mlzs_email_info_row(__('Name', 'mlzs'), $v('_reg_mother_name'), false);
    $mother_rows .= mlzs_email_info_row(__('Age', 'mlzs'), $v('_reg_mother_age') ?: '—', false);
    $mother_rows .= mlzs_email_info_row(__('Qualification', 'mlzs'), $v('_reg_mother_qualification') ?: '—', false);
    $mother_rows .= mlzs_email_info_row(__('Profession', 'mlzs'), $v('_reg_mother_profession') ?: '—', false);
    $mother_rows .= mlzs_email_info_row(__('Organization', 'mlzs'), $v('_reg_mother_organization') ?: '—', false);
    $mother_rows .= mlzs_email_info_row(__('Mobile', 'mlzs'), $v('_reg_mother_mobile'), false);
    $mother_rows .= mlzs_email_info_row(__('Email', 'mlzs'), $v('_reg_mother_email') ?: '—', true);

    $contact_rows = mlzs_email_info_row(__('Permanent Address', 'mlzs'), $v('_reg_permanent_address'), false);
    $contact_rows .= mlzs_email_info_row(__('Resident Address', 'mlzs'), $v('_reg_resident_address') ?: '—', false);
    $contact_rows .= mlzs_email_info_row(__('State/District (Permanent)', 'mlzs'), trim($v('_reg_state_permanent') . ', ' . $v('_reg_district_permanent'), ', ') ?: '—', false);
    $contact_rows .= mlzs_email_info_row(__('Mobile', 'mlzs'), $v('_reg_mobile_permanent'), false);
    $contact_rows .= mlzs_email_info_row(__('PIN Code', 'mlzs'), $v('_reg_pincode_permanent') ?: '—', false);
    $contact_rows .= mlzs_email_info_row(__('Email', 'mlzs'), $v('_reg_email'), true);

    $cards = mlzs_email_card($child_rows, __("Child's Information", 'mlzs'), false);
    $cards .= mlzs_email_card($father_rows, __("Father's Information", 'mlzs'), true);
    $cards .= mlzs_email_card($mother_rows, __("Mother's Information", 'mlzs'), false);
    $cards .= mlzs_email_card($contact_rows, __('Address & Contact', 'mlzs'), false);

    $content = '<div style="padding:32px 36px;">' . $cards . '</div>';
    return mlzs_email_wrapper(__('New Student Registration', 'mlzs'), $content, $hero);
}
