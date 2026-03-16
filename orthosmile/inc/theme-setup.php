<?php
/**
 * Theme setup and configuration
 * 
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Set up theme defaults and register support for various WordPress features.
 */
function orthosmile_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // Enable support for custom logo.
    add_theme_support('custom-logo', [
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    // Enable support for custom backgrounds.
    add_theme_support('custom-background', [
        'default-color' => 'ffffff',
    ]);

    // Enable support for custom headers.
    add_theme_support('custom-header', [
        'default-image' => '',
        'width'         => 1200,
        'height'        => 400,
        'flex-width'    => true,
        'flex-height'   => true,
    ]);

    // Enable support for HTML5 markup.
    add_theme_support('html5', [
        'comment-list',
        'comment-form',
        'search-form',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Enable support for post formats.
    add_theme_support('post-formats', [
        'image',
        'video',
        'gallery',
        'quote',
        'link',
    ]);

    // Register navigation menus.
    register_nav_menus([
        'primary' => __('Primary Menu', 'orthosmile'),
        'footer'  => __('Footer Menu', 'orthosmile'),
    ]);

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for core custom logo.
    add_theme_support(
        'custom-logo',
        [
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ]
    );

    // Add support for editor styles.
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');

    // Add support for responsive embedded content.
    add_theme_support('responsive-embeds');
}

add_action('after_setup_theme', 'orthosmile_setup');

/**
 * Register widget area.
 */
function orthosmile_widgets_init() {
    register_sidebar([
        'name'          => __('Footer 1', 'orthosmile'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in your footer.', 'orthosmile'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);

    register_sidebar([
        'name'          => __('Footer 2', 'orthosmile'),
        'id'            => 'footer-2',
        'description'   => __('Add widgets here to appear in your footer.', 'orthosmile'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);

    register_sidebar([
        'name'          => __('Footer 3', 'orthosmile'),
        'id'            => 'footer-3',
        'description'   => __('Add widgets here to appear in your footer.', 'orthosmile'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);

    register_sidebar([
        'name'          => __('Sidebar', 'orthosmile'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'orthosmile'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);
}

add_action('widgets_init', 'orthosmile_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function orthosmile_scripts() {
    // Main stylesheet
    wp_enqueue_style('orthosmile-style', get_stylesheet_uri(), [], wp_get_theme()->get('Version'));
    wp_style_add_data('orthosmile-style', 'rtl', 'replace');

    // Theme stylesheet
    wp_enqueue_style('orthosmile-main', get_template_directory_uri() . '/assets/css/main.css', [], wp_get_theme()->get('Version'));

    // Google Fonts
    wp_enqueue_style('orthosmile-fonts', 'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@400;600;700;800&display=swap', [], null);

    // Material Icons
    wp_enqueue_style('orthosmile-icons', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200', [], null);

    // Main JavaScript
    wp_enqueue_script('orthosmile-main', get_template_directory_uri() . '/assets/js/main.js', ['jquery'], wp_get_theme()->get('Version'), true);

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'orthosmile_scripts');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
    require get_template_directory() . '/inc/woocommerce.php';
}