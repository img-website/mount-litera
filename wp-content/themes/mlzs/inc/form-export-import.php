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
            'get_headers' => array(__('Child Name', 'mlzs'), __('Class', 'mlzs'), __('Father', 'mlzs'), __('Mother', 'mlzs'), __('Email', 'mlzs'), __('Contact', 'mlzs'), __('Date', 'mlzs')),
            'get_row'     => function($post) {
                $id = $post->ID;
                return array(
                    $post->post_title,
                    get_post_meta($id, '_adm_admission_class', true) ?: '',
                    trim((get_post_meta($id, '_adm_father_first_name', true) ?: '') . ' ' . (get_post_meta($id, '_adm_father_surname', true) ?: '')),
                    trim((get_post_meta($id, '_adm_mother_first_name', true) ?: '') . ' ' . (get_post_meta($id, '_adm_mother_surname', true) ?: '')),
                    get_post_meta($id, '_adm_email', true) ?: '',
                    get_post_meta($id, '_adm_contact', true) ?: '',
                    get_the_date('', $post),
                );
            },
            'import_map'  => array('child' => 0, 'class' => 1, 'father' => 2, 'mother' => 3, 'email' => 4, 'contact' => 5),
            'import_title' => function($row) { return (isset($row[0]) ? $row[0] : '') . ' – ' . (isset($row[1]) ? $row[1] : ''); },
        ),
        'mlzs_student_reg' => array(
            'post_type'   => 'mlzs_student_reg',
            'page_title'  => __('Student Registrations', 'mlzs'),
            'get_headers' => array(__('Child Name', 'mlzs'), __('Class', 'mlzs'), __('Father', 'mlzs'), __('Mother', 'mlzs'), __('Email', 'mlzs'), __('Mobile', 'mlzs'), __('Date', 'mlzs')),
            'get_row'     => function($post) {
                $id = $post->ID;
                return array(
                    get_post_meta($id, '_reg_child_name', true) ?: '',
                    get_post_meta($id, '_reg_class_sought', true) ?: '',
                    get_post_meta($id, '_reg_father_name', true) ?: '',
                    get_post_meta($id, '_reg_mother_name', true) ?: '',
                    get_post_meta($id, '_reg_email', true) ?: '',
                    get_post_meta($id, '_reg_mobile_permanent', true) ?: '',
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
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid #e2e8f0; padding: 8px 10px; text-align: left; }
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
    <table>
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
    </table>
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
            $count = mlzs_form_import_process($key, $_FILES['mlzs_import_file']);
            $message = '<div class="notice notice-success"><p>' . sprintf(esc_html__('%d rows imported successfully.', 'mlzs'), $count) . '</p></div>';
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
            <p>
                <a href="<?php echo esc_url(admin_url('admin.php?action=mlzs_export_csv&mlzs_export=' . $key . '&_wpnonce=' . wp_create_nonce('mlzs_export_' . $key))); ?>" class="button">
                    <?php esc_html_e('Download template CSV', 'mlzs'); ?>
                </a>
            </p>
            <form method="post" enctype="multipart/form-data">
                <?php wp_nonce_field('mlzs_import_' . $key, 'mlzs_import_nonce'); ?>
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

function mlzs_form_import_process($key, $file) {
    $configs = mlzs_form_export_get_configs();
    if (!isset($configs[$key]) || $configs[$key]['import_map'] === null) return 0;

    $cfg = $configs[$key];
    $path = $file['tmp_name'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    $rows = array();
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
            $rows = $sheet->toArray();
            array_shift($rows);
        } catch (Exception $e) {
            return 0;
        }
    } else {
        return 0;
    }

    $count = 0;
    $map = $cfg['import_map'];
    $title_fn = $cfg['import_title'];

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
        $count++;
    }
    return $count;
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
