<?php
/**
 * Error logger – log PHP errors and fatals, show in WP Admin (Tools > Error Log).
 */

if (!defined('ABSPATH')) {
    exit;
}

define('MLZS_ERROR_LOG_OPTION', 'mlzs_error_log');
define('MLZS_ERROR_LOG_MAX', 200);

function mlzs_error_log_entry($type, $message, $file = '', $line = 0, $context = array()) {
    $url = '';
    if (!empty($_SERVER['REQUEST_URI'])) {
        $url = (is_ssl() ? 'https://' : 'http://') . ($_SERVER['HTTP_HOST'] ?? '') . ($_SERVER['REQUEST_URI'] ?? '');
    }
    $entry = array(
        'time'    => current_time('mysql'),
        'type'    => $type,
        'message' => $message,
        'file'    => $file,
        'line'    => (int) $line,
        'url'     => $url,
        'context' => $context,
    );
    $log = get_option(MLZS_ERROR_LOG_OPTION, array());
    if (!is_array($log)) {
        $log = array();
    }
    array_unshift($log, $entry);
    $log = array_slice($log, 0, MLZS_ERROR_LOG_MAX);
    update_option(MLZS_ERROR_LOG_OPTION, $log, false);
}

function mlzs_error_handler($errno, $errstr, $errfile, $errline) {
    $types = array(
        E_ERROR             => 'E_ERROR',
        E_WARNING           => 'E_WARNING',
        E_PARSE             => 'E_PARSE',
        E_NOTICE            => 'E_NOTICE',
        E_CORE_ERROR        => 'E_CORE_ERROR',
        E_CORE_WARNING      => 'E_CORE_WARNING',
        E_COMPILE_ERROR     => 'E_COMPILE_ERROR',
        E_COMPILE_WARNING   => 'E_COMPILE_WARNING',
        E_USER_ERROR        => 'E_USER_ERROR',
        E_USER_WARNING      => 'E_USER_WARNING',
        E_USER_NOTICE       => 'E_USER_NOTICE',
        E_STRICT            => 'E_STRICT',
        E_RECOVERABLE_ERROR => 'E_RECOVERABLE_ERROR',
        E_DEPRECATED        => 'E_DEPRECATED',
        E_USER_DEPRECATED   => 'E_USER_DEPRECATED',
    );
    $type = isset($types[$errno]) ? $types[$errno] : 'Error#' . $errno;
    mlzs_error_log_entry($type, $errstr, $errfile, $errline, array('errno' => $errno));
    return false;
}

function mlzs_shutdown_error_log() {
    $e = error_get_last();
    if (!$e || !in_array($e['type'], array(E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR), true)) {
        return;
    }
    $types = array(
        E_ERROR         => 'Fatal',
        E_PARSE         => 'Parse',
        E_CORE_ERROR    => 'Core',
        E_COMPILE_ERROR => 'Compile',
    );
    $type = isset($types[$e['type']]) ? $types[$e['type']] : 'Fatal';
    mlzs_error_log_entry($type, $e['message'], $e['file'], $e['line'], array('errno' => $e['type']));
}
register_shutdown_function('mlzs_shutdown_error_log');

set_error_handler('mlzs_error_handler', E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED & ~E_STRICT);

function mlzs_error_log_admin_menu() {
    add_management_page(
        __('Error Log', 'mlzs'),
        __('Error Log', 'mlzs'),
        'manage_options',
        'mlzs-error-log',
        'mlzs_error_log_admin_page'
    );
}
add_action('admin_menu', 'mlzs_error_log_admin_menu');

function mlzs_error_log_admin_page() {
    if (!current_user_can('manage_options')) {
        wp_die(esc_html__('You do not have permission to access this page.', 'mlzs'));
    }

    if (isset($_POST['mlzs_clear_error_log']) && check_admin_referer('mlzs_clear_error_log')) {
        update_option(MLZS_ERROR_LOG_OPTION, array(), false);
        echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__('Error log cleared.', 'mlzs') . '</p></div>';
    }

    $log = get_option(MLZS_ERROR_LOG_OPTION, array());
    if (!is_array($log)) {
        $log = array();
    }
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Error Log', 'mlzs'); ?></h1>
        <p class="description"><?php esc_html_e('Recent PHP errors and fatal errors on the site. Which page had which error (detailed).', 'mlzs'); ?></p>

        <form method="post" style="margin-bottom: 1em;">
            <?php wp_nonce_field('mlzs_clear_error_log'); ?>
            <button type="submit" name="mlzs_clear_error_log" class="button button-secondary"><?php esc_html_e('Clear log', 'mlzs'); ?></button>
        </form>

        <?php if (empty($log)) : ?>
            <p><?php esc_html_e('No errors logged yet.', 'mlzs'); ?></p>
        <?php else : ?>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th style="width:140px"><?php esc_html_e('Time', 'mlzs'); ?></th>
                        <th style="width:100px"><?php esc_html_e('Type', 'mlzs'); ?></th>
                        <th><?php esc_html_e('Message', 'mlzs'); ?></th>
                        <th style="width:20%"><?php esc_html_e('Page / URL', 'mlzs'); ?></th>
                        <th style="width:25%"><?php esc_html_e('File', 'mlzs'); ?></th>
                        <th style="width:50px"><?php esc_html_e('Line', 'mlzs'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($log as $entry) :
                        $e = wp_parse_args($entry, array('time' => '', 'type' => '', 'message' => '', 'url' => '', 'file' => '', 'line' => 0));
                    ?>
                    <tr>
                        <td><?php echo esc_html($e['time']); ?></td>
                        <td><code><?php echo esc_html($e['type']); ?></code></td>
                        <td><strong><?php echo esc_html($e['message']); ?></strong></td>
                        <td><small title="<?php echo esc_attr($e['url']); ?>"><?php echo esc_html(wp_trim_words($e['url'], 8)); ?></small></td>
                        <td><small title="<?php echo esc_attr($e['file']); ?>"><?php echo esc_html(wp_trim_words($e['file'], 6)); ?></small></td>
                        <td><?php echo (int) $e['line']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <?php
}
