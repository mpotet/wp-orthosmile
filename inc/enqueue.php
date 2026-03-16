<?php
/**
 * Enqueue scripts and styles.
 *
 * @package OrthoSmile
 */

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Localize the main script for AJAX usage.
 */
function orthosmile_enqueue_scripts() {
    wp_localize_script('orthosmile-main', 'orthosmile_ajax', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('orthosmile_nonce'),
    ]);
}

add_action('wp_enqueue_scripts', 'orthosmile_enqueue_scripts');