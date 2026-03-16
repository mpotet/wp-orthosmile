<?php
/**
 * Theme Customizer additions.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function orthosmile_customize_register($wp_customize) {
    // Add panel for theme options
    $wp_customize->add_panel('orthosmile_theme_options', [
        'title'    => __('Options OrthoSmile', 'orthosmile'),
        'priority' => 30,
    ]);

    // Contact Information Section
    $wp_customize->add_section('orthosmile_contact_section', [
        'title'    => __('Coordonnées', 'orthosmile'),
        'priority' => 30,
        'panel'    => 'orthosmile_theme_options',
    ]);

    // Phone number
    $wp_customize->add_setting('phone_number', [
        'default'           => 'XXXX',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('phone_number', [
        'label'   => __('Numéro de téléphone', 'orthosmile'),
        'section' => 'orthosmile_contact_section',
        'type'    => 'text',
    ]);

    // Email
    $wp_customize->add_setting('contact_email', [
        'default'           => 'XXXX@XXXX.fr',
        'sanitize_callback' => 'sanitize_email',
    ]);

    $wp_customize->add_control('contact_email', [
        'label'   => __('Email', 'orthosmile'),
        'section' => 'orthosmile_contact_section',
        'type'    => 'email',
    ]);

    // Address
    $wp_customize->add_setting('contact_address', [
        'default'           => 'XXXX — Adresse du cabinet',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('contact_address', [
        'label'   => __('Adresse', 'orthosmile'),
        'section' => 'orthosmile_contact_section',
        'type'    => 'text',
    ]);

    // Opening hours
    $wp_customize->add_setting('opening_hours', [
        'default'           => 'XXXX — Horaires d\'ouverture',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('opening_hours', [
        'label'   => __('Horaires d\'ouverture', 'orthosmile'),
        'section' => 'orthosmile_contact_section',
        'type'    => 'text',
    ]);

    // Map embed
    $wp_customize->add_setting('contact_map_embed', [
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ]);

    $wp_customize->add_control('contact_map_embed', [
        'label'   => __('Code d\'intégration Google Maps', 'orthosmile'),
        'section' => 'orthosmile_contact_section',
        'type'    => 'textarea',
        'description' => __('Collez ici le code d\'intégration de Google Maps pour afficher votre localisation.', 'orthosmile'),
    ]);

    // Hero Section
    $wp_customize->add_section('orthosmile_hero_section', [
        'title'    => __('Section Héro', 'orthosmile'),
        'priority' => 40,
        'panel'    => 'orthosmile_theme_options',
    ]);

    // Hero title
    $wp_customize->add_setting('hero_title', [
        'default'           => 'XXXX — Titre principal',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);

    $wp_customize->add_control('hero_title', [
        'label'   => __('Titre principal', 'orthosmile'),
        'section' => 'orthosmile_hero_section',
        'type'    => 'text',
    ]);

    // Hero subtitle
    $wp_customize->add_setting('hero_subtitle', [
        'default'           => 'XXXX — Sous-titre de la page d\'accueil',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ]);

    $wp_customize->add_control('hero_subtitle', [
        'label'   => __('Sous-titre', 'orthosmile'),
        'section' => 'orthosmile_hero_section',
        'type'    => 'textarea',
    ]);

    // Hero CTA text
    $wp_customize->add_setting('hero_cta_text', [
        'default'           => 'Prendre rendez-vous',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);

    $wp_customize->add_control('hero_cta_text', [
        'label'   => __('Texte du bouton CTA', 'orthosmile'),
        'section' => 'orthosmile_hero_section',
        'type'    => 'text',
    ]);

    // Hero CTA URL
    $wp_customize->add_setting('hero_cta_url', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control('hero_cta_url', [
        'label'   => __('URL du bouton CTA', 'orthosmile'),
        'section' => 'orthosmile_hero_section',
        'type'    => 'url',
    ]);

    // Hero image
    $wp_customize->add_setting('hero_image', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image', [
        'label'   => __('Image de fond héro', 'orthosmile'),
        'section' => 'orthosmile_hero_section',
        'settings' => 'hero_image',
    ]));

    // Trust Section
    $wp_customize->add_section('orthosmile_trust_section', [
        'title'    => __('Section Confiance', 'orthosmile'),
        'priority' => 50,
        'panel'    => 'orthosmile_theme_options',
    ]);

    // Trust title
    $wp_customize->add_setting('trust_title', [
        'default'           => 'XXXX — Titre de la section confiance',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);

    $wp_customize->add_control('trust_title', [
        'label'   => __('Titre de la section', 'orthosmile'),
        'section' => 'orthosmile_trust_section',
        'type'    => 'text',
    ]);

    // Trust subtitle
    $wp_customize->add_setting('trust_subtitle', [
        'default'           => 'XXXX — Sous-titre de la section confiance',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ]);

    $wp_customize->add_control('trust_subtitle', [
        'label'   => __('Sous-titre de la section', 'orthosmile'),
        'section' => 'orthosmile_trust_section',
        'type'    => 'textarea',
    ]);

    // Trust item 1
    $wp_customize->add_setting('trust_1_value', [
        'default'           => 'XXXX',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);

    $wp_customize->add_control('trust_1_value', [
        'label'   => __('Valeur 1', 'orthosmile'),
        'section' => 'orthosmile_trust_section',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('trust_1_label', [
        'default'           => 'XXXX — Légende statistique 1',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);

    $wp_customize->add_control('trust_1_label', [
        'label'   => __('Légende 1', 'orthosmile'),
        'section' => 'orthosmile_trust_section',
        'type'    => 'text',
    ]);

    // Trust item 2
    $wp_customize->add_setting('trust_2_value', [
        'default'           => 'XXXX',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);

    $wp_customize->add_control('trust_2_value', [
        'label'   => __('Valeur 2', 'orthosmile'),
        'section' => 'orthosmile_trust_section',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('trust_2_label', [
        'default'           => 'XXXX — Légende statistique 2',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);

    $wp_customize->add_control('trust_2_label', [
        'label'   => __('Légende 2', 'orthosmile'),
        'section' => 'orthosmile_trust_section',
        'type'    => 'text',
    ]);

    // Trust item 3
    $wp_customize->add_setting('trust_3_value', [
        'default'           => 'XXXX',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);

    $wp_customize->add_control('trust_3_value', [
        'label'   => __('Valeur 3', 'orthosmile'),
        'section' => 'orthosmile_trust_section',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('trust_3_label', [
        'default'           => 'XXXX — Légende statistique 3',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);

    $wp_customize->add_control('trust_3_label', [
        'label'   => __('Légende 3', 'orthosmile'),
        'section' => 'orthosmile_trust_section',
        'type'    => 'text',
    ]);

    // Colors Section
    $wp_customize->add_section('orthosmile_colors_section', [
        'title'    => __('Couleurs', 'orthosmile'),
        'priority' => 60,
        'panel'    => 'orthosmile_theme_options',
    ]);

    // Primary color
    $wp_customize->add_setting('primary_color', [
        'default'           => '#0f766e',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', [
        'label'   => __('Couleur primaire', 'orthosmile'),
        'section' => 'orthosmile_colors_section',
        'settings' => 'primary_color',
    ]));

    // Accent color
    $wp_customize->add_setting('accent_color', [
        'default'           => '#d9c4a1',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'accent_color', [
        'label'   => __('Couleur d\'accent', 'orthosmile'),
        'section' => 'orthosmile_colors_section',
        'settings' => 'accent_color',
    ]));

    // Social Media Section
    $wp_customize->add_section('orthosmile_social_section', [
        'title'    => __('Réseaux Sociaux', 'orthosmile'),
        'priority' => 70,
        'panel'    => 'orthosmile_theme_options',
    ]);

    // Facebook URL
    $wp_customize->add_setting('facebook_url', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control('facebook_url', [
        'label'   => __('URL Facebook', 'orthosmile'),
        'section' => 'orthosmile_social_section',
        'type'    => 'url',
    ]);

    // Twitter URL
    $wp_customize->add_setting('twitter_url', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control('twitter_url', [
        'label'   => __('URL Twitter', 'orthosmile'),
        'section' => 'orthosmile_social_section',
        'type'    => 'url',
    ]);

    // Instagram URL
    $wp_customize->add_setting('instagram_url', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control('instagram_url', [
        'label'   => __('URL Instagram', 'orthosmile'),
        'section' => 'orthosmile_social_section',
        'type'    => 'url',
    ]);

    // LinkedIn URL
    $wp_customize->add_setting('linkedin_url', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control('linkedin_url', [
        'label'   => __('URL LinkedIn', 'orthosmile'),
        'section' => 'orthosmile_social_section',
        'type'    => 'url',
    ]);

    // Sections Display Section
    $wp_customize->add_section('orthosmile_sections_section', [
        'title'    => __('Affichage des Sections', 'orthosmile'),
        'priority' => 80,
        'panel'    => 'orthosmile_theme_options',
    ]);

    // Show services section
    $wp_customize->add_setting('show_services', [
        'default'           => true,
        'sanitize_callback' => 'orthosmile_sanitize_checkbox',
    ]);

    $wp_customize->add_control('show_services', [
        'label'   => __('Afficher la section Services', 'orthosmile'),
        'section' => 'orthosmile_sections_section',
        'type'    => 'checkbox',
    ]);

    // Show gallery section
    $wp_customize->add_setting('show_gallery', [
        'default'           => true,
        'sanitize_callback' => 'orthosmile_sanitize_checkbox',
    ]);

    $wp_customize->add_control('show_gallery', [
        'label'   => __('Afficher la section Galerie', 'orthosmile'),
        'section' => 'orthosmile_sections_section',
        'type'    => 'checkbox',
    ]);

    // Show doctors section
    $wp_customize->add_setting('show_doctors', [
        'default'           => true,
        'sanitize_callback' => 'orthosmile_sanitize_checkbox',
    ]);

    $wp_customize->add_control('show_doctors', [
        'label'   => __('Afficher la section Équipe', 'orthosmile'),
        'section' => 'orthosmile_sections_section',
        'type'    => 'checkbox',
    ]);

    // Show testimonials section
    $wp_customize->add_setting('show_testimonials', [
        'default'           => true,
        'sanitize_callback' => 'orthosmile_sanitize_checkbox',
    ]);

    $wp_customize->add_control('show_testimonials', [
        'label'   => __('Afficher la section Témoignages', 'orthosmile'),
        'section' => 'orthosmile_sections_section',
        'type'    => 'checkbox',
    ]);

    // Show FAQ section
    $wp_customize->add_setting('show_faq', [
        'default'           => true,
        'sanitize_callback' => 'orthosmile_sanitize_checkbox',
    ]);

    $wp_customize->add_control('show_faq', [
        'label'   => __('Afficher la section FAQ', 'orthosmile'),
        'section' => 'orthosmile_sections_section',
        'type'    => 'checkbox',
    ]);

    // Show CTA section
    $wp_customize->add_setting('show_cta', [
        'default'           => true,
        'sanitize_callback' => 'orthosmile_sanitize_checkbox',
    ]);

    $wp_customize->add_control('show_cta', [
        'label'   => __('Afficher la section Appel à l\'action', 'orthosmile'),
        'section' => 'orthosmile_sections_section',
        'type'    => 'checkbox',
    ]);

    // Appointment URL
    $wp_customize->add_setting('appointment_url', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control('appointment_url', [
        'label'   => __('URL de prise de rendez-vous', 'orthosmile'),
        'section' => 'orthosmile_contact_section',
        'type'    => 'url',
        'description' => __('Laissez vide pour utiliser la page de contact par défaut.', 'orthosmile'),
    ]);
}
add_action('customize_register', 'orthosmile_customize_register');

/**
 * Sanitize checkbox.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function orthosmile_sanitize_checkbox($checked) {
    return (bool) $checked;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function orthosmile_customize_preview_js() {
    wp_enqueue_script('orthosmile-customizer', get_template_directory_uri() . '/assets/js/customizer.js', ['customize-preview'], '1.0.0', true);
}
add_action('customize_preview_init', 'orthosmile_customize_preview_js');