<?php
/**
 * ACF Pro – IDE stubs only. This file is NOT loaded by WordPress.
 * Removes "undefined function" warnings in Cursor/VS Code (Intelephense).
 * Delete this file if you don't use ACF Pro.
 */

if (!function_exists('acf_add_options_page')) {
    /** @param array<string, mixed> $options */
    function acf_add_options_page($options = array()) { return null; }
}
if (!function_exists('acf_add_local_field_group')) {
    /** @param array<string, mixed> $group */
    function acf_add_local_field_group($group = array()) { return null; }
}
if (!function_exists('get_field')) {
    /** @return mixed */
    function get_field($selector, $post_id = false, $format_value = true) { return null; }
}
if (!function_exists('have_rows')) {
    /** @param string $selector
     *  @param int|string|false $post_id
     *  @return bool */
    function have_rows($selector, $post_id = false) { return false; }
}
if (!function_exists('the_row')) {
    function the_row() { return null; }
}
if (!function_exists('get_sub_field')) {
    /** @return mixed */
    function get_sub_field($selector, $format_value = true) { return null; }
}
