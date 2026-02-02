<?php
/**
 * HTML Email Templates – Contact & Enquiry forms.
 * Uses table layout + inline CSS for email client compatibility.
 */

if (!defined('ABSPATH')) {
    exit;
}

define('MLZS_EMAIL_PRIMARY', '#3D348B');
define('MLZS_EMAIL_ACCENT', '#F7B801');
define('MLZS_EMAIL_TEXT', '#1e293b');
define('MLZS_EMAIL_TEXT_LIGHT', '#64748b');
define('MLZS_EMAIL_BORDER', '#e2e8f0');

/**
 * Wrapper for HTML emails – header, content area, footer.
 *
 * @param string $title   Section title (e.g. "New Contact Submission").
 * @param string $content HTML content (table rows).
 * @return string Full HTML email body.
 */
function mlzs_email_wrapper($title, $content) {
    $site_name = get_bloginfo('name');
    $date     = wp_date('l, F j, Y \a\t g:i A');
    $year     = wp_date('Y');

    return '<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . esc_html($title) . '</title>
</head>
<body style="margin:0;padding:0;background-color:#f1f5f9;font-family:\'Segoe UI\',Tahoma,Geneva,Verdana,sans-serif;-webkit-font-smoothing:antialiased;">
<table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:#f1f5f9;">
    <tr>
        <td align="center" style="padding:32px 16px;">
            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="max-width:560px;margin:0 auto;background:#ffffff;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,0.08);overflow:hidden;">
                <!-- Header -->
                <tr>
                    <td style="background:linear-gradient(135deg,' . MLZS_EMAIL_PRIMARY . ' 0%,#2d2566 100%);padding:28px 32px;text-align:center;">
                        <h1 style="margin:0;font-size:22px;font-weight:700;color:#ffffff;letter-spacing:-0.02em;">' . esc_html($site_name) . '</h1>
                        <p style="margin:8px 0 0;font-size:13px;color:rgba(255,255,255,0.85);">' . esc_html($title) . '</p>
                    </td>
                </tr>
                <!-- Content -->
                <tr>
                    <td style="padding:32px;">
                        <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="border-collapse:collapse;">
                            ' . $content . '
                        </table>
                    </td>
                </tr>
                <!-- Footer -->
                <tr>
                    <td style="padding:20px 32px;background:#f8fafc;border-top:1px solid ' . MLZS_EMAIL_BORDER . ';font-size:12px;color:' . MLZS_EMAIL_TEXT_LIGHT . ';">
                        <p style="margin:0;">Received on ' . esc_html($date) . '</p>
                        <p style="margin:8px 0 0;">This is an automated notification from your website. &copy; ' . esc_html($year) . ' ' . esc_html($site_name) . '. All rights reserved.</p>
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
 * Single row for email content table.
 *
 * @param string $label Label text.
 * @param string $value Value text.
 * @return string HTML table row.
 */
function mlzs_email_row($label, $value) {
    return '<tr>
        <td style="padding:12px 0;border-bottom:1px solid ' . MLZS_EMAIL_BORDER . ';">
            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td style="font-size:12px;font-weight:600;color:' . MLZS_EMAIL_TEXT_LIGHT . ';width:140px;vertical-align:top;">' . esc_html($label) . '</td>
                    <td style="font-size:15px;color:' . MLZS_EMAIL_TEXT . ';line-height:1.5;">' . nl2br(esc_html($value)) . '</td>
                </tr>
            </table>
        </td>
    </tr>';
}

/**
 * Build HTML body for Contact (footer) form submission.
 */
function mlzs_email_body_contact($name, $email, $phone, $message) {
    $rows = mlzs_email_row(__('Name', 'mlzs'), $name);
    $rows .= mlzs_email_row(__('Email', 'mlzs'), $email);
    $rows .= mlzs_email_row(__('Phone', 'mlzs'), $phone ?: '—');
    $rows .= mlzs_email_row(__('Message', 'mlzs'), $message);
    return mlzs_email_wrapper(__('New Contact Submission', 'mlzs'), $rows);
}

/**
 * Build HTML body for Enquiry form submission.
 */
function mlzs_email_body_enquiry($name, $class, $contact, $email) {
    $rows = mlzs_email_row(__("Child's Name", 'mlzs'), $name);
    $rows .= mlzs_email_row(__('Class', 'mlzs'), $class);
    $rows .= mlzs_email_row(__('Contact Number', 'mlzs'), $contact);
    $rows .= mlzs_email_row(__('Email', 'mlzs'), $email);
    return mlzs_email_wrapper(__('New Admission Enquiry', 'mlzs'), $rows);
}
