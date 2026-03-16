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
    
    // Enqueue simple stylesheet
    wp_enqueue_style('orthosmile-simple', get_template_directory_uri() . '/assets/css/simple.css', [], '1.0.0', 'all');
    
    // Enqueue Google Fonts
    wp_enqueue_style('orthosmile-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap', [], null);
}

function orthosmile_enqueue_scripts() {
    // Enqueue main script
    wp_enqueue_script('orthosmile-main', get_template_directory_uri() . '/assets/js/main.js', ['jquery'], '1.0.0', true);
    
    // Localize script for AJAX and service worker
    wp_localize_script('orthosmile-main', 'orthosmile_ajax', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('orthosmile_nonce'),
        'sw_url'   => get_template_directory_uri() . '/sw.js',
    ]);
}

// Hook into WordPress
add_action('wp_enqueue_scripts', 'orthosmile_enqueue_styles');
add_action('wp_enqueue_scripts', 'orthosmile_enqueue_scripts');