<?php
/**
 * Theme setup & configuration.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) exit;

function orthosmile_setup() {
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'height'      => 120,
        'width'       => 360,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('custom-background', ['default-color' => 'ffffff']);
    add_theme_support('html5', ['comment-list','comment-form','search-form','gallery','caption','style','script']);
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');

    register_nav_menus([
        'primary' => __('Navigation principale', 'orthosmile'),
        'footer'  => __('Menu Footer', 'orthosmile'),
    ]);
}
add_action('after_setup_theme', 'orthosmile_setup');

/**
 * Register sidebars.
 */
function orthosmile_widgets_init() {
    $sidebar_args = [
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ];
    register_sidebar(array_merge($sidebar_args, ['name' => __('Footer 1', 'orthosmile'), 'id' => 'footer-1']));
    register_sidebar(array_merge($sidebar_args, ['name' => __('Footer 2', 'orthosmile'), 'id' => 'footer-2']));
    register_sidebar(array_merge($sidebar_args, ['name' => __('Footer 3', 'orthosmile'), 'id' => 'footer-3']));
    register_sidebar(array_merge($sidebar_args, ['name' => __('Sidebar', 'orthosmile'), 'id' => 'sidebar-1']));
}
add_action('widgets_init', 'orthosmile_widgets_init');

/**
 * Add theme image sizes.
 */
add_image_size('praticien-card', 480, 600, true);
add_image_size('team-banner', 1400, 560, true);
add_image_size('gallery-thumb', 800, 600, true);