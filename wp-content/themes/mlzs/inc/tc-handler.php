<?php
/**
 * Transfer Certificate (TC) – CPT, Admin Add TC form, Frontend search.
 * Stores: Serial Number + PDF file.
 */

if (!defined('ABSPATH')) {
    exit;
}

define('MLZS_TC_CPT', 'mlzs_tc');

/**
 * Register CPT: Transfer Certificate
 */
function mlzs_register_tc_cpt() {
    $labels = array(
        'name'               => _x('Transfer Certificates', 'post type general name', 'mlzs'),
        'singular_name'      => _x('Transfer Certificate', 'post type singular name', 'mlzs'),
        'menu_name'          => _x('Transfer Certificates', 'admin menu', 'mlzs'),
        'add_new'            => _x('Add New', 'TC', 'mlzs'),
        'add_new_item'       => __('Add New TC', 'mlzs'),
        'edit_item'          => __('Edit TC', 'mlzs'),
        'new_item'           => __('New TC', 'mlzs'),
        'view_item'          => __('View TC', 'mlzs'),
        'search_items'       => __('Search TCs', 'mlzs'),
        'not_found'          => __('No TCs found.', 'mlzs'),
        'not_found_in_trash' => __('No TCs in trash.', 'mlzs'),
    );
    $args = array(
        'labels'              => $labels,
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 28,
        'menu_icon'           => 'dashicons-media-document',
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'supports'            => array('title'),
        'has_archive'         => false,
        'rewrite'             => false,
        'query_var'           => false,
    );
    register_post_type(MLZS_TC_CPT, $args);
}
add_action('init', 'mlzs_register_tc_cpt', 5);

/**
 * Admin columns for TC list
 */
function mlzs_tc_columns($columns) {
    $new = array();
    $new['cb'] = $columns['cb'];
    $new['title'] = __('Serial Number', 'mlzs');
    $new['tc_pdf'] = __('PDF', 'mlzs');
    $new['date'] = $columns['date'];
    return $new;
}
add_filter('manage_' . MLZS_TC_CPT . '_posts_columns', 'mlzs_tc_columns');

function mlzs_tc_column_content($column, $post_id) {
    if ($column === 'tc_pdf') {
        $att_id = (int) get_post_meta($post_id, '_tc_pdf', true);
        if ($att_id) {
            $url = wp_get_attachment_url($att_id);
            echo $url ? '<a href="' . esc_url($url) . '" target="_blank" rel="noopener">' . esc_html__('View', 'mlzs') . '</a>' : '—';
        } else {
            echo '—';
        }
    }
}
add_action('manage_' . MLZS_TC_CPT . '_posts_custom_column', 'mlzs_tc_column_content', 10, 2);

/**
 * Change Title placeholder to "Enter Serial Number"
 */
function mlzs_tc_title_placeholder($title) {
    $screen = get_current_screen();
    if ($screen && $screen->post_type === MLZS_TC_CPT) {
        return __('Enter Serial Number', 'mlzs');
    }
    return $title;
}
add_filter('enter_title_here', 'mlzs_tc_title_placeholder');

/**
 * Meta box: TC PDF upload on Edit screen
 */
function mlzs_tc_meta_box($post) {
    if (!$post || get_post_type($post) !== MLZS_TC_CPT) return;
    wp_nonce_field('mlzs_tc_meta', 'mlzs_tc_meta_nonce');
    $att_id = (int) get_post_meta($post->ID, '_tc_pdf', true);
    $url = $att_id ? wp_get_attachment_url($att_id) : '';
    ?>
    <p><strong><?php esc_html_e('TC PDF File', 'mlzs'); ?></strong></p>
    <p class="description"><?php esc_html_e('Upload PDF file. Click "Publish" or "Update" to save.', 'mlzs'); ?></p>
    <p>
        <input type="file" name="tc_pdf_upload" id="tc_pdf_upload" accept=".pdf,application/pdf">
        <?php if ($url) : ?>
            <br><br><strong><?php esc_html_e('Current PDF:', 'mlzs'); ?></strong> <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener"><?php esc_html_e('View PDF', 'mlzs'); ?></a>
        <?php else : ?>
            <br><em><?php esc_html_e('No PDF uploaded yet.', 'mlzs'); ?></em>
        <?php endif; ?>
    </p>
    <?php
}

add_action('add_meta_boxes', function() {
    add_meta_box('mlzs_tc_pdf', __('TC PDF', 'mlzs'), 'mlzs_tc_meta_box', MLZS_TC_CPT, 'normal', 'high');
});

/**
 * Add enctype to post form for file uploads
 */
function mlzs_tc_post_edit_form_tag() {
    global $post;
    if ($post && get_post_type($post) === MLZS_TC_CPT) {
        echo ' enctype="multipart/form-data"';
    }
}
add_action('post_edit_form_tag', 'mlzs_tc_post_edit_form_tag');

/**
 * Save TC meta (Edit screen)
 */
function mlzs_tc_save_meta($post_id) {
    if (!isset($_POST['mlzs_tc_meta_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['mlzs_tc_meta_nonce'])), 'mlzs_tc_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (get_post_type($post_id) !== MLZS_TC_CPT) return;

    $title = get_the_title($post_id);
    if (!empty($title)) {
        update_post_meta($post_id, '_tc_serial', $title);
    }

    if (!empty($_FILES['tc_pdf_upload']['name']) && $_FILES['tc_pdf_upload']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['tc_pdf_upload'];
        if ($file['type'] === 'application/pdf') {
            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH . 'wp-admin/includes/media.php';
            require_once ABSPATH . 'wp-admin/includes/image.php';
            $overrides = array('test_form' => false, 'mimes' => array('pdf' => 'application/pdf'));
            $upload = wp_handle_upload($file, $overrides);
            if (!isset($upload['error'])) {
                $attachment = array(
                    'post_mime_type' => $upload['type'],
                    'post_title'     => sanitize_file_name(pathinfo($file['name'], PATHINFO_FILENAME)),
                    'post_content'   => '',
                    'post_status'    => 'inherit',
                );
                $att_id = wp_insert_attachment($attachment, $upload['file'], $post_id);
                if (!is_wp_error($att_id)) {
                    update_post_meta($post_id, '_tc_pdf', $att_id);
                }
            }
        }
    }
}
add_action('save_post_' . MLZS_TC_CPT, 'mlzs_tc_save_meta');

/**
 * AJAX: Frontend TC search
 */
function mlzs_ajax_tc_search() {
    header('Content-Type: application/json; charset=utf-8');
    $serial = isset($_POST['serial']) ? sanitize_text_field(wp_unslash($_POST['serial'])) : '';
    $serial = trim($serial);
    if (empty($serial)) {
        wp_send_json_error(array('message' => __('Please enter a serial number.', 'mlzs')));
    }

    global $wpdb;
    $posts = get_posts(array(
        'post_type'      => MLZS_TC_CPT,
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'meta_query'     => array(array('key' => '_tc_serial', 'value' => $serial, 'compare' => '=')),
    ));
    if (empty($posts)) {
        $id = $wpdb->get_var($wpdb->prepare(
            "SELECT ID FROM {$wpdb->posts} WHERE post_type = %s AND post_status = 'publish' AND BINARY post_title = %s LIMIT 1",
            MLZS_TC_CPT,
            $serial
        ));
        if ($id) {
            $posts = array(get_post($id));
        }
    }

    if (empty($posts)) {
        wp_send_json_error(array('message' => __('Transfer Certificate not found. Please check the serial number.', 'mlzs')));
    }

    $post = $posts[0];
    $att_id = (int) get_post_meta($post->ID, '_tc_pdf', true);
    $pdf_url = $att_id ? wp_get_attachment_url($att_id) : '';
    $student = function_exists('get_field') ? get_field('tc_student_name', $post->ID) : '';
    $class = function_exists('get_field') ? get_field('tc_class', $post->ID) : '';
    $issue = function_exists('get_field') ? get_field('tc_issue_date', $post->ID) : '';
    $valid = function_exists('get_field') ? get_field('tc_valid_until', $post->ID) : '';

    wp_send_json_success(array(
        'serial'   => $post->post_title,
        'pdf_url'  => $pdf_url,
        'student'  => $student,
        'class'    => $class,
        'issue'    => $issue,
        'valid'    => $valid,
    ));
}
add_action('wp_ajax_mlzs_tc_search', 'mlzs_ajax_tc_search');
add_action('wp_ajax_nopriv_mlzs_tc_search', 'mlzs_ajax_tc_search');
