<?php
/**
 * Form Export (PDF, Excel) and Import (Excel/CSV) for CPT submissions.
 * Adds Export and Import submenus under Contact, Enquiry, Admission, Student Registrations.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * CPT export/import configs.
 * Keys: post_type, menu_parent, page_title, get_row_data callback.
 */
function mlzs_form_export_get_configs() {
    return array(
        'contact_submission' => array(
            'post_type'   => 'contact_submission',
            'page_title'  => __('Contact Submissions', 'mlzs'),
            'get_headers' => array(__('Name', 'mlzs'), __('Email', 'mlzs'), __('Phone', 'mlzs'), __('Message', 'mlzs'), __('Date', 'mlzs')),
            'get_row'     => function($post) {
                return array(
                    get_post_meta($post->ID, '_contact_name', true) ?: '',
                    get_post_meta($post->ID, '_contact_email', true) ?: '',
                    get_post_meta($post->ID, '_contact_phone', true) ?: '',
                    get_post_meta($post->ID, '_contact_message', true) ?: '',
                    get_the_date('', $post),
                );
            },
            'import_map'  => array(0 => '_contact_name', 1 => '_contact_email', 2 => '_contact_phone', 3 => '_contact_message'),
            'import_title' => function($row) { return (isset($row[0]) ? $row[0] : '') . ' – ' . (isset($row[1]) ? $row[1] : ''); },
        ),
        'enquiry_submission' => array(
            'post_type'   => 'enquiry_submission',
            'page_title'  => __('Enquiry Submissions', 'mlzs'),
            'get_headers' => array(__('Child Name', 'mlzs'), __('Class', 'mlzs'), __('Contact', 'mlzs'), __('Email', 'mlzs'), __('Date', 'mlzs')),
            'get_row'     => function($post) {
                return array(
                    $post->post_title,
                    get_post_meta($post->ID, '_enquiry_class', true) ?: '',
                    get_post_meta($post->ID, '_enquiry_contact', true) ?: '',
                    get_post_meta($post->ID, '_enquiry_email', true) ?: '',
                    get_the_date('', $post),
                );
            },
            'import_map'  => array(0 => null, 1 => '_enquiry_class', 2 => '_enquiry_contact', 3 => '_enquiry_email'),
            'import_title' => function($row) { return (isset($row[0]) ? $row[0] : '') . ' – ' . (isset($row[1]) ? $row[1] : ''); },
        ),
        'mlzs_adm_reg' => array(
            'post_type'   => 'mlzs_adm_reg',
            'page_title'  => __('Admission Registrations', 'mlzs'),
            'get_headers' => array(
                __('Date', 'mlzs'), __('Enquiry No.', 'mlzs'), __('Child Name', 'mlzs'), __('DOB', 'mlzs'), __('Age', 'mlzs'),
                __('Current School', 'mlzs'), __('Class Sought', 'mlzs'),
                __('Father Name', 'mlzs'), __('Father Qualification', 'mlzs'), __('Father Occupation', 'mlzs'),
                __('Mother Name', 'mlzs'), __('Mother Qualification', 'mlzs'), __('Mother Occupation', 'mlzs'),
                __('Income', 'mlzs'), __('Address', 'mlzs'), __('Email', 'mlzs'), __('Contact', 'mlzs'), __('Preferred Visit Date', 'mlzs'),
                __('Created', 'mlzs'),
            ),
            'get_row'     => function($post) {
                $id = $post->ID;
                $g = function($k) use ($id) { return get_post_meta($id, $k, true) ?: ''; };
                $age = $g('_adm_age');
                if ($age === '') {
                    $age_y = $g('_adm_age_years');
                    $age_m = $g('_adm_age_months');
                    $age = ($age_y || $age_m) ? trim($age_y . 'y ' . $age_m . 'm') : '';
                }
                $income_val = $g('_adm_income');
                $income_labels = array('lt_6' => '< 6 Lacs', 'lt_10' => '< 10 Lacs', 'lt_20' => '< 20 Lacs');
                if (isset($income_labels[$income_val])) $income_val = $income_labels[$income_val];
                return array(
                    $g('_adm_date'), $g('_adm_enquiry_no'),
                    trim($g('_adm_child_first_name') . ' ' . $g('_adm_child_surname')), $g('_adm_child_dob'), $age,
                    $g('_adm_current_school'), $g('_adm_admission_class'),
                    trim($g('_adm_father_first_name') . ' ' . $g('_adm_father_surname')), $g('_adm_father_qualification'), $g('_adm_father_occupation'),
                    trim($g('_adm_mother_first_name') . ' ' . $g('_adm_mother_surname')), $g('_adm_mother_qualification'), $g('_adm_mother_occupation'),
                    $income_val, $g('_adm_address'), $g('_adm_email'), $g('_adm_contact'), $g('_adm_preferred_visit_date'),
                    get_the_date('', $post),
                );
            },
            'import_map'  => array(
                0 => '_adm_child_first_name', 1 => '_adm_admission_class',
                2 => '_adm_father_first_name', 3 => '_adm_mother_first_name',
                4 => '_adm_email', 5 => '_adm_contact',
            ),
            'import_title' => function($row) { return (isset($row[0]) ? $row[0] : '') . ' – ' . (isset($row[1]) ? $row[1] : ''); },
        ),
        'mlzs_student_reg' => array(
            'post_type'   => 'mlzs_student_reg',
            'page_title'  => __('Student Registrations', 'mlzs'),
            'get_headers' => array(
                __('Session', 'mlzs'), __('Child Name', 'mlzs'), __('Sex', 'mlzs'), __('DOB', 'mlzs'), __('Aadhar', 'mlzs'), __('Age', 'mlzs'), __('Blood Group', 'mlzs'),
                __('Place of Birth', 'mlzs'), __('City of Birth', 'mlzs'), __('State of Birth', 'mlzs'),
                __('Class Sought', 'mlzs'), __('Current School', 'mlzs'), __('Current Class', 'mlzs'), __('Nationality', 'mlzs'), __('Domicile', 'mlzs'),
                __('Source of Info', 'mlzs'), __('Mother Tongue', 'mlzs'), __('Admission Category', 'mlzs'), __('Health Info', 'mlzs'),
                __('Father Name', 'mlzs'), __('Father Age', 'mlzs'), __('Father Qualification', 'mlzs'), __('Father Profession', 'mlzs'), __('Father Mobile', 'mlzs'), __('Father Email', 'mlzs'),
                __('Mother Name', 'mlzs'), __('Mother Age', 'mlzs'), __('Mother Qualification', 'mlzs'), __('Mother Profession', 'mlzs'), __('Mother Mobile', 'mlzs'), __('Mother Email', 'mlzs'),
                __('Permanent Address', 'mlzs'), __('State', 'mlzs'), __('District', 'mlzs'), __('Mobile', 'mlzs'), __('PIN', 'mlzs'), __('Email', 'mlzs'),
                __('Created', 'mlzs'),
            ),
            'get_row'     => function($post) {
                $id = $post->ID;
                $g = function($k) use ($id) { return get_post_meta($id, $k, true) ?: ''; };
                $age = ($g('_reg_age_years') || $g('_reg_age_months') || $g('_reg_age_days')) ? trim($g('_reg_age_years') . 'y ' . $g('_reg_age_months') . 'm ' . $g('_reg_age_days') . 'd') : '';
                $mother_tongue = trim($g('_reg_mother_tongue') . ($g('_reg_mother_tongue_other_text') ? ' / ' . $g('_reg_mother_tongue_other_text') : ''));
                $adm_cat = trim($g('_reg_admission_category') . ($g('_reg_admission_category_other_text') ? ' / ' . $g('_reg_admission_category_other_text') : ''));
                $session = trim($g('_reg_start_year') . '-' . $g('_reg_end_year'), '-');
                $photo_url = function($att_id) { return $att_id ? (wp_get_attachment_url($att_id) ?: '') : ''; };
                return array(
                    $session, $g('_reg_child_name'), $g('_reg_sex'), $g('_reg_dob'), $g('_reg_aadhar'), $age, $g('_reg_blood_group'),
                    $g('_reg_place_of_birth'), $g('_reg_city_of_birth'), $g('_reg_state_of_birth'),
                    $g('_reg_class_sought'), $g('_reg_current_school'), $g('_reg_current_class'), $g('_reg_nationality'), $g('_reg_domicile'),
                    $g('_reg_source_info'), $mother_tongue, $adm_cat, $g('_reg_health_info'),
                    $g('_reg_father_name'), $g('_reg_father_age'), $g('_reg_father_qualification'), $g('_reg_father_profession'), $g('_reg_father_mobile'), $g('_reg_father_email'),
                    $g('_reg_mother_name'), $g('_reg_mother_age'), $g('_reg_mother_qualification'), $g('_reg_mother_profession'), $g('_reg_mother_mobile'), $g('_reg_mother_email'),
                    $g('_reg_permanent_address'), $g('_reg_state_permanent'), $g('_reg_district_permanent'), $g('_reg_mobile_permanent'), $g('_reg_pincode_permanent'), $g('_reg_email'),
                    get_the_date('', $post),
                );
            },
            'import_map'  => array(
                0 => '_reg_child_name', 1 => '_reg_class_sought',
                2 => '_reg_father_name', 3 => '_reg_mother_name',
                4 => '_reg_email', 5 => '_reg_mobile_permanent',
            ),
            'import_title' => function($row) { return (isset($row[0]) ? $row[0] : '') . ' – ' . (isset($row[1]) ? $row[1] : ''); },
        ),
        'mlzs_tc' => array(
            'post_type'   => 'mlzs_tc',
            'page_title'  => __('Transfer Certificates', 'mlzs'),
            'get_headers' => array(__('Serial Number', 'mlzs'), __('Student Name', 'mlzs'), __('Class', 'mlzs'), __('Issue Date', 'mlzs'), __('Valid Until', 'mlzs'), __('PDF Filename', 'mlzs'), __('Date', 'mlzs')),
            'get_row'     => function($post) {
                $id = $post->ID;
                $student = function_exists('get_field') ? get_field('tc_student_name', $id) : '';
                $class = function_exists('get_field') ? get_field('tc_class', $id) : '';
                $issue = function_exists('get_field') ? get_field('tc_issue_date', $id) : '';
                $valid = function_exists('get_field') ? get_field('tc_valid_until', $id) : '';
                $att_id = (int) get_post_meta($id, '_tc_pdf', true);
                $pdf_fn = '';
                if ($att_id) {
                    $p = get_attached_file($att_id);
                    $pdf_fn = $p ? basename($p) : (wp_get_attachment_url($att_id) ? basename(wp_get_attachment_url($att_id)) : '');
                }
                return array(
                    $post->post_title,
                    $student ?: '',
                    $class ?: '',
                    $issue ?: '',
                    $valid ?: '',
                    $pdf_fn,
                    get_the_date('', $post),
                );
            },
            'import_map'  => array(
                0 => '_tc_serial',
                1 => 'tc_student_name',
                2 => 'tc_class',
                3 => 'tc_issue_date',
                4 => 'tc_valid_until',
            ),
            'import_title' => function($row) { return isset($row[0]) ? trim((string) $row[0]) : ''; },
        ),
    );
}

function mlzs_form_export_get_posts($post_type, $limit = 10000) {
    return get_posts(array(
        'post_type'      => $post_type,
        'post_status'    => 'any',
        'posts_per_page' => $limit,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ));
}

function mlzs_form_export_csv_escape($val) {
    $val = (string) $val;
    if (strpos($val, ',') !== false || strpos($val, '"') !== false || strpos($val, "\n") !== false) {
        return '"' . str_replace('"', '""', $val) . '"';
    }
    return $val;
}

function mlzs_form_export_download_csv() {
    if (!current_user_can('edit_posts')) return;
    $key = isset($_GET['mlzs_export']) ? sanitize_key(wp_unslash($_GET['mlzs_export'])) : '';
    $configs = mlzs_form_export_get_configs();
    if (!isset($configs[$key])) return;

    $cfg = $configs[$key];
    $posts = mlzs_form_export_get_posts($cfg['post_type']);
    $get_row = $cfg['get_row'];
    $headers = $cfg['get_headers'];

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . sanitize_file_name($cfg['page_title']) . '-' . wp_date('Y-m-d') . '.csv"');

    $out = fopen('php://output', 'w');
    fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF));
    fputcsv($out, $headers);

    foreach ($posts as $post) {
        fputcsv($out, $get_row($post));
    }
    fclose($out);
    exit;
}

function mlzs_form_export_pdf_page() {
    if (!current_user_can('edit_posts')) wp_die(__('Unauthorized', 'mlzs'));

    $key = isset($_GET['mlzs_export']) ? sanitize_key(wp_unslash($_GET['mlzs_export'])) : '';
    $configs = mlzs_form_export_get_configs();
    if (!isset($configs[$key])) wp_die(__('Invalid export', 'mlzs'));

    $cfg = $configs[$key];
    $posts = mlzs_form_export_get_posts($cfg['post_type']);
    $get_row = $cfg['get_row'];
    $headers = $cfg['get_headers'];

    $site = get_bloginfo('name');
    ?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo esc_html($cfg['page_title']); ?> – <?php echo esc_html($site); ?></title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; padding: 24px; color: #1e293b; }
        h1 { font-size: 20px; margin-bottom: 8px; }
        .sub { font-size: 12px; color: #64748b; margin-bottom: 20px; }
        .table-wrap { overflow-x: auto; margin-bottom: 20px; }
        table { width: 100%; min-width: max-content; border-collapse: collapse; font-size: 11px; }
        th, td { border: 1px solid #e2e8f0; padding: 6px 8px; text-align: left; font-size: 10px; }
        th { background: #f1f5f9; font-weight: 600; }
        tr:nth-child(even) { background: #fafafa; }
        .actions { margin-bottom: 20px; }
        .btn { display: inline-block; padding: 10px 20px; background: #3D348B; color: #fff; text-decoration: none; border-radius: 6px; font-size: 14px; cursor: pointer; border: none; }
        .btn:hover { background: #2d2566; }
        @media print { .actions { display: none; } body { padding: 12px; } }
    </style>
</head>
<body>
    <div class="actions">
        <button type="button" class="btn" onclick="window.print()"><?php esc_html_e('Print / Save as PDF', 'mlzs'); ?></button>
    </div>
    <h1><?php echo esc_html($cfg['page_title']); ?></h1>
    <p class="sub"><?php echo esc_html($site); ?> – <?php echo esc_html(wp_date('F j, Y')); ?> – <?php echo count($posts); ?> <?php esc_html_e('entries', 'mlzs'); ?></p>
    <div class="table-wrap"><table>
        <thead><tr>
            <th>#</th>
            <?php foreach ($headers as $h) : ?><th><?php echo esc_html($h); ?></th><?php endforeach; ?>
        </tr></thead>
        <tbody>
        <?php foreach ($posts as $i => $post) :
            $row = $get_row($post);
            ?><tr><td><?php echo (int) ($i + 1); ?></td><?php
            foreach ($row as $cell) {
                echo '<td>' . esc_html($cell) . '</td>';
            }
        ?></tr><?php endforeach; ?>
        </tbody>
    </table></div>
</body>
</html><?php
    exit;
}

function mlzs_form_export_admin_menus() {
    $configs = mlzs_form_export_get_configs();
    foreach ($configs as $key => $cfg) {
        $parent = 'edit.php?post_type=' . $cfg['post_type'];
        add_submenu_page(
            $parent,
            __('Export', 'mlzs') . ' – ' . $cfg['page_title'],
            __('Export', 'mlzs'),
            'edit_posts',
            'mlzs-export-' . $key,
            function() use ($key) { mlzs_form_export_render_page($key); }
        );
        add_submenu_page(
            $parent,
            __('Import', 'mlzs') . ' – ' . $cfg['page_title'],
            __('Import', 'mlzs'),
            'edit_posts',
            'mlzs-import-' . $key,
            function() use ($key) { mlzs_form_import_render_page($key); }
        );
    }
}
add_action('admin_menu', 'mlzs_form_export_admin_menus', 20);

function mlzs_form_export_render_page($key = '') {
    if (empty($key)) $key = isset($_GET['mlzs_type']) ? sanitize_key(wp_unslash($_GET['mlzs_type'])) : '';
    $configs = mlzs_form_export_get_configs();
    if (!isset($configs[$key])) {
        echo '<p>' . esc_html__('Invalid export type.', 'mlzs') . '</p>';
        return;
    }
    $cfg = $configs[$key];
    ?>
    <div class="wrap">
        <h1><?php echo esc_html__('Export', 'mlzs'); ?> – <?php echo esc_html($cfg['page_title']); ?></h1>
        <div class="card" style="max-width: 480px; padding: 20px;">
            <p><?php esc_html_e('Download all submissions in the selected format:', 'mlzs'); ?></p>
            <p>
                <a href="<?php echo esc_url(admin_url('admin.php?action=mlzs_export_csv&mlzs_export=' . $key . '&_wpnonce=' . wp_create_nonce('mlzs_export_' . $key))); ?>" class="button button-primary">
                    <?php esc_html_e('Download Excel (CSV)', 'mlzs'); ?>
                </a>
                <a href="<?php echo esc_url(admin_url('admin.php?mlzs_export=' . $key . '&mlzs_format=pdf&_wpnonce=' . wp_create_nonce('mlzs_export_pdf_' . $key))); ?>" target="_blank" class="button">
                    <?php esc_html_e('Download PDF', 'mlzs'); ?>
                </a>
            </p>
            <p class="description"><?php esc_html_e('PDF opens in a new tab. Use Print → Save as PDF to download.', 'mlzs'); ?></p>
        </div>
    </div>
    <?php
}

function mlzs_form_import_render_page($key = '') {
    if (empty($key)) $key = isset($_GET['mlzs_type']) ? sanitize_key(wp_unslash($_GET['mlzs_type'])) : '';
    $configs = mlzs_form_export_get_configs();
    if (!isset($configs[$key])) {
        echo '<p>' . esc_html__('Invalid import type.', 'mlzs') . '</p>';
        return;
    }
    $cfg = $configs[$key];
    if ($cfg['import_map'] === null) {
        echo '<div class="wrap"><h1>' . esc_html__('Import', 'mlzs') . ' – ' . esc_html($cfg['page_title']) . '</h1>';
        echo '<p>' . esc_html__('Bulk import is not available for this form type. Use Export to get a template CSV.', 'mlzs') . '</p></div>';
        return;
    }

    $message = '';
    if (isset($_POST['mlzs_import_nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['mlzs_import_nonce'])), 'mlzs_import_' . $key)) {
        if (!empty($_FILES['mlzs_import_file']['tmp_name'])) {
            $pdf_folder = ($key === 'mlzs_tc' && isset($_POST['tc_pdf_folder'])) ? trim(sanitize_text_field(wp_unslash($_POST['tc_pdf_folder'])), '/\\') : '';
            $result = mlzs_form_import_process($key, $_FILES['mlzs_import_file'], $pdf_folder);
            $msg = is_array($result) ? sprintf(esc_html__('%d rows imported.', 'mlzs'), $result['count']) . (isset($result['pdf_linked']) && $result['pdf_linked'] > 0 ? ' ' . sprintf(esc_html__('%d PDFs linked.', 'mlzs'), $result['pdf_linked']) : '') : sprintf(esc_html__('%d rows imported.', 'mlzs'), (int) $result);
            $message = '<div class="notice notice-success"><p>' . $msg . '</p></div>';
        } else {
            $message = '<div class="notice notice-error"><p>' . esc_html__('Please select a CSV file.', 'mlzs') . '</p></div>';
        }
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html__('Import', 'mlzs'); ?> – <?php echo esc_html($cfg['page_title']); ?></h1>
        <?php echo $message; ?>
        <div class="card" style="max-width: 560px; padding: 20px;">
            <p><?php esc_html_e('Upload a CSV or Excel file to bulk import. First row should be headers. Use the Export CSV as a template.', 'mlzs'); ?></p>
            <?php if ($key === 'mlzs_tc') : ?>
            <p><strong><?php esc_html_e('TC Import:', 'mlzs'); ?></strong> <?php esc_html_e('Add "PDF Filename" column (e.g. tc123.pdf). PDFs must be in wp-content/uploads/ – enter folder below.', 'mlzs'); ?></p>
            <?php endif; ?>
            <p>
                <a href="<?php echo esc_url(admin_url('admin.php?action=mlzs_export_csv&mlzs_export=' . $key . '&_wpnonce=' . wp_create_nonce('mlzs_export_' . $key))); ?>" class="button">
                    <?php esc_html_e('Download template CSV', 'mlzs'); ?>
                </a>
            </p>
            <form method="post" enctype="multipart/form-data">
                <?php wp_nonce_field('mlzs_import_' . $key, 'mlzs_import_nonce'); ?>
                <?php if ($key === 'mlzs_tc') : ?>
                <p>
                    <label><strong><?php esc_html_e('PDFs folder', 'mlzs'); ?></strong>
                    <input type="text" name="tc_pdf_folder" class="regular-text" placeholder="2026/02" value="<?php echo esc_attr(wp_date('Y/m')); ?>"></label>
                    <span class="description"><?php esc_html_e('Relative to wp-content/uploads/ (where your PDFs are)', 'mlzs'); ?></span>
                </p>
                <?php endif; ?>
                <p>
                    <input type="file" name="mlzs_import_file" accept=".csv,.xlsx,.xls" required>
                </p>
                <p>
                    <button type="submit" class="button button-primary"><?php esc_html_e('Import', 'mlzs'); ?></button>
                </p>
            </form>
        </div>
    </div>
    <?php
}

function mlzs_form_import_process($key, $file, $pdf_folder = '') {
    $configs = mlzs_form_export_get_configs();
    if (!isset($configs[$key]) || $configs[$key]['import_map'] === null) return 0;

    $cfg = $configs[$key];
    $path = $file['tmp_name'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    $rows = array();
    $headers = array();
    if ($ext === 'csv') {
        $h = fopen($path, 'r');
        if (!$h) return 0;
        $headers = fgetcsv($h);
        while (($row = fgetcsv($h)) !== false) {
            $rows[] = $row;
        }
        fclose($h);
    } elseif (($ext === 'xlsx' || $ext === 'xls') && class_exists('PhpOffice\PhpSpreadsheet\IOFactory')) {
        try {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($path);
            $sheet = $spreadsheet->getActiveSheet();
            $all = $sheet->toArray();
            $headers = isset($all[0]) ? $all[0] : array();
            array_shift($all);
            $rows = $all;
        } catch (Exception $e) {
            return 0;
        }
    } else {
        return 0;
    }

    $pdf_col = null;
    if ($key === 'mlzs_tc' && !empty($headers)) {
        foreach ($headers as $i => $h) {
            if (is_string($h) && stripos($h, 'pdf') !== false) {
                $pdf_col = $i;
                break;
            }
        }
    }
    if ($key === 'mlzs_tc' && $pdf_col === null) $pdf_col = 5;

    $count = 0;
    $pdf_linked = 0;
    $map = $cfg['import_map'];
    $title_fn = $cfg['import_title'];
    $is_tc = ($key === 'mlzs_tc');
    $uploads = $is_tc && $pdf_folder ? wp_upload_dir() : null;
    $base_dir = '';
    if ($is_tc && $pdf_folder && $uploads && isset($uploads['basedir'])) {
        $base_dir = wp_normalize_path(trailingslashit($uploads['basedir']) . str_replace('\\', '/', trim($pdf_folder, '/\\')) . '/');
    }

    foreach ($rows as $row) {
        if (empty($row) || (count($row) === 1 && trim((string) $row[0]) === '')) continue;

        $title = $title_fn($row);
        if (empty(trim($title))) continue;

        $post_id = wp_insert_post(array(
            'post_type'   => $cfg['post_type'],
            'post_status' => 'publish',
            'post_title'  => sanitize_text_field($title),
            'post_author' => get_current_user_id(),
        ));

        if (is_wp_error($post_id)) continue;

        foreach ($map as $idx => $meta_key) {
            if ($meta_key && isset($row[$idx])) {
                update_post_meta($post_id, $meta_key, sanitize_text_field(wp_unslash($row[$idx])));
            }
        }

        $pdf_idx = ($is_tc && $pdf_col !== null) ? $pdf_col : 5;
        if ($is_tc && $base_dir && isset($row[$pdf_idx]) && trim((string) $row[$pdf_idx]) !== '') {
            $pdf_name = trim(sanitize_file_name(wp_unslash($row[$pdf_idx])));
            if ($pdf_name !== '' && substr(strtolower($pdf_name), -4) === '.pdf') {
                $filepath = wp_normalize_path($base_dir . $pdf_name);
                if (is_file($filepath) && is_readable($filepath)) {
                    require_once ABSPATH . 'wp-admin/includes/file.php';
                    require_once ABSPATH . 'wp-admin/includes/media.php';
                    require_once ABSPATH . 'wp-admin/includes/image.php';
                    $attach_id = attachment_url_to_postid($uploads['baseurl'] . '/' . trim($pdf_folder, '/\\') . '/' . $pdf_name);
                    if (!$attach_id) {
                        $attachment = array(
                            'post_mime_type' => 'application/pdf',
                            'post_title'     => pathinfo($pdf_name, PATHINFO_FILENAME),
                            'post_content'   => '',
                            'post_status'    => 'inherit',
                        );
                        $attach_id = wp_insert_attachment($attachment, $filepath, $post_id);
                    }
                    if ($attach_id && !is_wp_error($attach_id)) {
                        update_post_meta($post_id, '_tc_pdf', $attach_id);
                        $pdf_linked++;
                    }
                }
            }
        }
        $count++;
    }
    return $is_tc && $pdf_folder ? array('count' => $count, 'pdf_linked' => $pdf_linked) : $count;
}

add_action('admin_init', function() {
    if (isset($_GET['action']) && $_GET['action'] === 'mlzs_export_csv' && isset($_GET['mlzs_export'])) {
        $key = sanitize_key(wp_unslash($_GET['mlzs_export']));
        if (current_user_can('edit_posts') && wp_verify_nonce(isset($_GET['_wpnonce']) ? sanitize_text_field(wp_unslash($_GET['_wpnonce'])) : '', 'mlzs_export_' . $key)) {
            mlzs_form_export_download_csv();
        }
    }
    if (isset($_GET['mlzs_format']) && $_GET['mlzs_format'] === 'pdf' && isset($_GET['mlzs_export'])) {
        $key = sanitize_key(wp_unslash($_GET['mlzs_export']));
        if (current_user_can('edit_posts') && wp_verify_nonce(isset($_GET['_wpnonce']) ? sanitize_text_field(wp_unslash($_GET['_wpnonce'])) : '', 'mlzs_export_pdf_' . $key)) {
            mlzs_form_export_pdf_page();
        }
    }
});
