<?php
/**
 * Scripts and styles enqueue - OrthoSmile
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) exit;

function orthosmile_scripts() {
    $ver = wp_get_theme()->get('Version');

    /* ── Google Fonts : Plus Jakarta Sans ─────────────────── */
    wp_enqueue_style(
        'orthosmile-fonts',
        'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap',
        [],
        null
    );

    /* ── Material Symbols Outlined ────────────────────────── */
    wp_enqueue_style(
        'orthosmile-icons',
        'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200',
        [],
        null
    );

    /* ── Splide (carousel) - CDN ──────────────────────────── */
    wp_enqueue_style('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', [], '4.1.4');
    wp_enqueue_script('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', [], '4.1.4', true);

    /* ── Theme stylesheet ─────────────────────────────────── */
    wp_enqueue_style('orthosmile-style', get_stylesheet_uri(), [], $ver);
    wp_enqueue_style('orthosmile-main', get_template_directory_uri() . '/assets/css/main.css', ['orthosmile-fonts', 'orthosmile-icons', 'splide'], $ver);

    /* ── Main JS (defer via true = footer) ─────────────────── */
    wp_enqueue_script('orthosmile-main', get_template_directory_uri() . '/assets/js/main.js', ['splide'], $ver, true);

    wp_localize_script('orthosmile-main', 'orthosmile_ajax', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('orthosmile_nonce'),
    ]);

    /* ── Comment reply ─────────────────────────────────────── */
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'orthosmile_scripts');