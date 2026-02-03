<?php
/**
 * ACF Field Checker – Report pages/options where ACF fields are empty.
 * Usage: Visit as Admin: yoursite.com/?mlzs_acf_check=1
 * Removed after use or keep for future checks.
 */
if (!defined('ABSPATH')) {
    exit;
}

function mlzs_acf_check_run() {
    if (!isset($_GET['mlzs_acf_check']) || $_GET['mlzs_acf_check'] !== '1') {
        return;
    }
    if (!current_user_can('manage_options') || !function_exists('get_field_objects')) {
        if (current_user_can('manage_options')) {
            wp_die('ACF not active or get_field_objects not available.');
        }
        return;
    }

    $report = array();
    $pages = get_posts(array(
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'title',
        'order'          => 'ASC',
    ));

    foreach ($pages as $page) {
        $template = get_post_meta($page->ID, '_wp_page_template', true) ?: 'default';
        $objects = get_field_objects($page->ID);
        if (!is_array($objects)) {
            continue;
        }
        foreach ($objects as $key => $field) {
            $val = isset($field['value']) ? $field['value'] : get_field($key, $page->ID);
            if (mlzs_acf_check_is_empty($val, $field)) {
                $report[] = array(
                    'type'     => 'page',
                    'title'    => $page->post_title,
                    'id'       => $page->ID,
                    'template' => $template,
                    'field'    => $field['label'] ?? $key,
                    'key'      => $key,
                );
            }
        }
    }

    // Options (Header, Footer, etc.)
    $opt_pages = array('option', 'acf-options-header', 'acf-options-footer', 'acf-options-env');
    foreach ($opt_pages as $opt_key) {
        $objects = get_field_objects($opt_key);
        if (!is_array($objects)) {
            continue;
        }
        foreach ($objects as $key => $field) {
            $val = isset($field['value']) ? $field['value'] : get_field($key, $opt_key);
            if (mlzs_acf_check_is_empty($val, $field)) {
                $report[] = array(
                    'type'  => 'options',
                    'title' => $opt_key,
                    'id'    => 0,
                    'template' => '—',
                    'field' => $field['label'] ?? $key,
                    'key'   => $key,
                );
            }
        }
    }

    mlzs_acf_check_render_report($report);
    exit;
}

function mlzs_acf_check_is_empty($val, $field) {
    if ($val === null || $val === '') {
        return true;
    }
    if (is_array($val)) {
        if (isset($field['type']) && $field['type'] === 'repeater') {
            return count($val) === 0;
        }
        if (isset($field['type']) && $field['type'] === 'flexible_content') {
            return count($val) === 0;
        }
        return empty($val);
    }
    if (is_numeric($val) && (int) $val === 0 && (isset($field['type']) && $field['type'] === 'image')) {
        return true;
    }
    return false;
}

function mlzs_acf_check_render_report($report) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>ACF Empty Fields Report</title>
        <style>
            body { font-family: -apple-system, sans-serif; margin: 20px; background: #f5f5f5; }
            h1 { color: #1d2327; }
            table { border-collapse: collapse; background: #fff; box-shadow: 0 1px 3px rgba(0,0,0,.1); }
            th, td { padding: 10px 12px; text-align: left; border-bottom: 1px solid #ddd; }
            th { background: #3D348B; color: #fff; }
            tr:hover { background: #f9f9f9; }
            .type-page { }
            .type-options { background: #f0f6fc; }
            .count { font-size: 14px; color: #666; margin-bottom: 16px; }
            .back { display: inline-block; margin-bottom: 16px; color: #3D348B; }
        </style>
    </head>
    <body>
        <a class="back" href="<?php echo esc_url(admin_url()); ?>">&larr; Back to Admin</a>
        <h1>ACF Empty Fields Report</h1>
        <p class="count">Total empty fields: <strong><?php echo count($report); ?></strong></p>
        <?php if (empty($report)) : ?>
            <p>No empty ACF fields found on any page or options.</p>
        <?php else : ?>
            <table>
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Page / Options</th>
                        <th>Template</th>
                        <th>Field (label)</th>
                        <th>Field key</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($report as $r) : ?>
                    <tr class="type-<?php echo esc_attr($r['type']); ?>">
                        <td><?php echo esc_html($r['type']); ?></td>
                        <td><?php echo esc_html($r['title']); ?><?php if ($r['id']) echo ' (ID ' . (int) $r['id'] . ')'; ?></td>
                        <td><?php echo esc_html($r['template']); ?></td>
                        <td><?php echo esc_html($r['field']); ?></td>
                        <td><code><?php echo esc_html($r['key']); ?></code></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </body>
    </html>
    <?php
}

add_action('template_redirect', 'mlzs_acf_check_run', 5);
