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
 * Enqueue scripts and styles.
 */
function orthosmile_enqueue_styles() {
    // Enqueue main theme stylesheet
    wp_enqueue_style('orthosmile-style', get_stylesheet_uri());
}

function orthosmile_enqueue_scripts() {
    // Localize already-enqueued main script for AJAX (registered in theme-setup.php)
    wp_localize_script('orthosmile-main', 'orthosmile_ajax', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('orthosmile_nonce'),
    ]);
}

// Hook into WordPress
add_action('wp_enqueue_scripts', 'orthosmile_enqueue_styles');
add_action('wp_enqueue_scripts', 'orthosmile_enqueue_scripts');