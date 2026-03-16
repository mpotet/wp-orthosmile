<?php
/**
 * Extended Theme Customizer additions for additional sections.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add extended customizer options.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function orthosmile_customize_register_extended($wp_customize) {
    // Add section "Les Spécialistes"
    $wp_customize->add_section('orthosmile_specialists', [
        'title'    => __('Les Spécialistes', 'orthosmile'),
        'priority' => 90,
    ]);

    // Activer/désactiver la section
    $wp_customize->add_setting('orthosmile_enable_specialists', [
        'default'           => true,
        'sanitize_callback' => 'orthosmile_sanitize_checkbox',
    ]);

    $wp_customize->add_control('orthosmile_enable_specialists', [
        'label'    => __('Afficher la section "Les Spécialistes"', 'orthosmile'),
        'section'  => 'orthosmile_specialists',
        'settings' => 'orthosmile_enable_specialists',
        'type'     => 'checkbox',
    ]);

    // Titre de la section
    $wp_customize->add_setting('orthosmile_specialists_title', [
        'default'           => __('Nos Spécialistes', 'orthosmile'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('orthosmile_specialists_title', [
        'label'    => __('Titre de la section', 'orthosmile'),
        'section'  => 'orthosmile_specialists',
        'settings' => 'orthosmile_specialists_title',
        'type'     => 'text',
    ]);

    // Description de la section
    $wp_customize->add_setting('orthosmile_specialists_description', [
        'default'           => __('Une équipe de spécialistes dévoués pour votre santé bucco-dentaire.', 'orthosmile'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('orthosmile_specialists_description', [
        'label'    => __('Description de la section', 'orthosmile'),
        'section'  => 'orthosmile_specialists',
        'settings' => 'orthosmile_specialists_description',
        'type'     => 'textarea',
    ]);

    // Spécialiste 1
    $wp_customize->add_setting('orthosmile_specialist_1_name', [
        'default'           => __('Dr. Jean Dupont', 'orthosmile'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('orthosmile_specialist_1_name', [
        'label'    => __('Nom du Spécialiste 1', 'orthosmile'),
        'section'  => 'orthosmile_specialists',
        'settings' => 'orthosmile_specialist_1_name',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('orthosmile_specialist_1_title', [
        'default'           => __('Orthodontiste Senior', 'orthosmile'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('orthosmile_specialist_1_title', [
        'label'    => __('Titre du Spécialiste 1', 'orthosmile'),
        'section'  => 'orthosmile_specialists',
        'settings' => 'orthosmile_specialist_1_title',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('orthosmile_specialist_1_description', [
        'default'           => __('Spécialiste en orthodontie adulte avec plus de 15 ans d\'expérience.', 'orthosmile'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('orthosmile_specialist_1_description', [
        'label'    => __('Description du Spécialiste 1', 'orthosmile'),
        'section'  => 'orthosmile_specialists',
        'settings' => 'orthosmile_specialist_1_description',
        'type'     => 'textarea',
    ]);

    // Spécialiste 2
    $wp_customize->add_setting('orthosmile_specialist_2_name', [
        'default'           => __('Dr. Marie Martin', 'orthosmile'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('orthosmile_specialist_2_name', [
        'label'    => __('Nom du Spécialiste 2', 'orthosmile'),
        'section'  => 'orthosmile_specialists',
        'settings' => 'orthosmile_specialist_2_name',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('orthosmile_specialist_2_title', [
        'default'           => __('Orthodontiste Pédiatrique', 'orthosmile'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('orthosmile_specialist_2_title', [
        'label'    => __('Titre du Spécialiste 2', 'orthosmile'),
        'section'  => 'orthosmile_specialists',
        'settings' => 'orthosmile_specialist_2_title',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('orthosmile_specialist_2_description', [
        'default'           => __('Spécialiste en orthodontie infantile et préventive.', 'orthosmile'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('orthosmile_specialist_2_description', [
        'label'    => __('Description du Spécialiste 2', 'orthosmile'),
        'section'  => 'orthosmile_specialists',
        'settings' => 'orthosmile_specialist_2_description',
        'type'     => 'textarea',
    ]);

    // Spécialiste 3
    $wp_customize->add_setting('orthosmile_specialist_3_name', [
        'default'           => __('Dr. Pierre Bernard', 'orthosmile'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('orthosmile_specialist_3_name', [
        'label'    => __('Nom du Spécialiste 3', 'orthosmile'),
        'section'  => 'orthosmile_specialists',
        'settings' => 'orthosmile_specialist_3_name',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('orthosmile_specialist_3_title', [
        'default'           => __('Chirurgien Orthognathique', 'orthosmile'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('orthosmile_specialist_3_title', [
        'label'    => __('Titre du Spécialiste 3', 'orthosmile'),
        'section'  => 'orthosmile_specialists',
        'settings' => 'orthosmile_specialist_3_title',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('orthosmile_specialist_3_description', [
        'default'           => __('Expert en chirurgie orthognathique et traitements complexes.', 'orthosmile'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('orthosmile_specialist_3_description', [
        'label'    => __('Description du Spécialiste 3', 'orthosmile'),
        'section'  => 'orthosmile_specialists',
        'settings' => 'orthosmile_specialist_3_description',
        'type'     => 'textarea',
    ]);

    // Section "Nos Réalisations"
    $wp_customize->add_section('orthosmile_realizations', [
        'title'    => __('Nos Réalisations', 'orthosmile'),
        'priority' => 100,
    ]);

    $wp_customize->add_setting('orthosmile_enable_realizations', [
        'default'           => true,
        'sanitize_callback' => 'orthosmile_sanitize_checkbox',
    ]);

    $wp_customize->add_control('orthosmile_enable_realizations', [
        'label'    => __('Afficher la section "Nos Réalisations"', 'orthosmile'),
        'section'  => 'orthosmile_realizations',
        'settings' => 'orthosmile_enable_realizations',
        'type'     => 'checkbox',
    ]);

    $wp_customize->add_setting('orthosmile_realizations_title', [
        'default'           => __('Nos Réalisations', 'orthosmile'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('orthosmile_realizations_title', [
        'label'    => __('Titre de la section', 'orthosmile'),
        'section'  => 'orthosmile_realizations',
        'settings' => 'orthosmile_realizations_title',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('orthosmile_realizations_description', [
        'default'           => __('Découvrez quelques-unes de nos réalisations les plus marquantes.', 'orthosmile'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('orthosmile_realizations_description', [
        'label'    => __('Description de la section', 'orthosmile'),
        'section'  => 'orthosmile_realizations',
        'settings' => 'orthosmile_realizations_description',
        'type'     => 'textarea',
    ]);

    // Section "Témoignages"
    $wp_customize->add_section('orthosmile_testimonials_extended', [
        'title'    => __('Témoignages Clients', 'orthosmile'),
        'priority' => 110,
    ]);

    $wp_customize->add_setting('orthosmile_enable_testimonials', [
        'default'           => true,
        'sanitize_callback' => 'orthosmile_sanitize_checkbox',
    ]);

    $wp_customize->add_control('orthosmile_enable_testimonials', [
        'label'    => __('Afficher la section "Témoignages"', 'orthosmile'),
        'section'  => 'orthosmile_testimonials_extended',
        'settings' => 'orthosmile_enable_testimonials',
        'type'     => 'checkbox',
    ]);

    $wp_customize->add_setting('orthosmile_testimonials_title', [
        'default'           => __('Témoignages de nos patients', 'orthosmile'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('orthosmile_testimonials_title', [
        'label'    => __('Titre de la section', 'orthosmile'),
        'section'  => 'orthosmile_testimonials_extended',
        'settings' => 'orthosmile_testimonials_title',
        'type'     => 'text',
    ]);

    // Témoignage 1
    $wp_customize->add_setting('orthosmile_testimonial_1_text', [
        'default'           => __('Un traitement exceptionnel, des résultats au-delà de mes espérances !', 'orthosmile'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('orthosmile_testimonial_1_text', [
        'label'    => __('Témoignage 1', 'orthosmile'),
        'section'  => 'orthosmile_testimonials_extended',
        'settings' => 'orthosmile_testimonial_1_text',
        'type'     => 'textarea',
    ]);

    $wp_customize->add_setting('orthosmile_testimonial_1_author', [
        'default'           => __('Sophie L.', 'orthosmile'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('orthosmile_testimonial_1_author', [
        'label'    => __('Auteur du Témoignage 1', 'orthosmile'),
        'section'  => 'orthosmile_testimonials_extended',
        'settings' => 'orthosmile_testimonial_1_author',
        'type'     => 'text',
    ]);

    // Témoignage 2
    $wp_customize->add_setting('orthosmile_testimonial_2_text', [
        'default'           => __('L\'équipe est professionnelle et à l\'écoute. Je recommande vivement !', 'orthosmile'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('orthosmile_testimonial_2_text', [
        'label'    => __('Témoignage 2', 'orthosmile'),
        'section'  => 'orthosmile_testimonials_extended',
        'settings' => 'orthosmile_testimonial_2_text',
        'type'     => 'textarea',
    ]);

    $wp_customize->add_setting('orthosmile_testimonial_2_author', [
        'default'           => __('Marc D.', 'orthosmile'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('orthosmile_testimonial_2_author', [
        'label'    => __('Auteur du Témoignage 2', 'orthosmile'),
        'section'  => 'orthosmile_testimonials_extended',
        'settings' => 'orthosmile_testimonial_2_author',
        'type'     => 'text',
    ]);

    // Section "Infos Pratiques"
    $wp_customize->add_section('orthosmile_practical_info', [
        'title'    => __('Informations Pratiques', 'orthosmile'),
        'priority' => 120,
    ]);

    $wp_customize->add_setting('orthosmile_enable_practical_info', [
        'default'           => true,
        'sanitize_callback' => 'orthosmile_sanitize_checkbox',
    ]);

    $wp_customize->add_control('orthosmile_enable_practical_info', [
        'label'    => __('Afficher la section "Infos Pratiques"', 'orthosmile'),
        'section'  => 'orthosmile_practical_info',
        'settings' => 'orthosmile_enable_practical_info',
        'type'     => 'checkbox',
    ]);

    $wp_customize->add_setting('orthosmile_practical_info_title', [
        'default'           => __('Informations Pratiques', 'orthosmile'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('orthosmile_practical_info_title', [
        'label'    => __('Titre de la section', 'orthosmile'),
        'section'  => 'orthosmile_practical_info',
        'settings' => 'orthosmile_practical_info_title',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('orthosmile_practical_info_content', [
        'default'           => __('Prenez rendez-vous en ligne ou par téléphone. Nous sommes à votre écoute pour toutes questions.', 'orthosmile'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('orthosmile_practical_info_content', [
        'label'    => __('Contenu de la section', 'orthosmile'),
        'section'  => 'orthosmile_practical_info',
        'settings' => 'orthosmile_practical_info_content',
        'type'     => 'textarea',
    ]);

    // Section "Nos Valeurs"
    $wp_customize->add_section('orthosmile_values', [
        'title'    => __('Nos Valeurs', 'orthosmile'),
        'priority' => 130,
    ]);

    $wp_customize->add_setting('orthosmile_enable_values', [
        'default'           => true,
        'sanitize_callback' => 'orthosmile_sanitize_checkbox',
    ]);

    $wp_customize->add_control('orthosmile_enable_values', [
        'label'    => __('Afficher la section "Nos Valeurs"', 'orthosmile'),
        'section'  => 'orthosmile_values',
        'settings' => 'orthosmile_enable_values',
        'type'     => 'checkbox',
    ]);

    $wp_customize->add_setting('orthosmile_values_title', [
        'default'           => __('Nos Valeurs', 'orthosmile'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('orthosmile_values_title', [
        'label'    => __('Titre de la section', 'orthosmile'),
        'section'  => 'orthosmile_values',
        'settings' => 'orthosmile_values_title',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('orthosmile_value_1', [
        'default'           => __('Excellence', 'orthosmile'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('orthosmile_value_1', [
        'label'    => __('Valeur 1', 'orthosmile'),
        'section'  => 'orthosmile_values',
        'settings' => 'orthosmile_value_1',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('orthosmile_value_1_description', [
        'default'           => __('Nous visons l\'excellence dans chaque traitement que nous proposons.', 'orthosmile'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('orthosmile_value_1_description', [
        'label'    => __('Description Valeur 1', 'orthosmile'),
        'section'  => 'orthosmile_values',
        'settings' => 'orthosmile_value_1_description',
        'type'     => 'textarea',
    ]);

    $wp_customize->add_setting('orthosmile_value_2', [
        'default'           => __('Bienveillance', 'orthosmile'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('orthosmile_value_2', [
        'label'    => __('Valeur 2', 'orthosmile'),
        'section'  => 'orthosmile_values',
        'settings' => 'orthosmile_value_2',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('orthosmile_value_2_description', [
        'default'           => __('Nous traitons chaque patient avec bienveillance et respect.', 'orthosmile'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('orthosmile_value_2_description', [
        'label'    => __('Description Valeur 2', 'orthosmile'),
        'section'  => 'orthosmile_values',
        'settings' => 'orthosmile_value_2_description',
        'type'     => 'textarea',
    ]);

    $wp_customize->add_setting('orthosmile_value_3', [
        'default'           => __('Innovation', 'orthosmile'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('orthosmile_value_3', [
        'label'    => __('Valeur 3', 'orthosmile'),
        'section'  => 'orthosmile_values',
        'settings' => 'orthosmile_value_3',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('orthosmile_value_3_description', [
        'default'           => __('Nous adoptons les dernières technologies pour un meilleur confort.', 'orthosmile'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('orthosmile_value_3_description', [
        'label'    => __('Description Valeur 3', 'orthosmile'),
        'section'  => 'orthosmile_values',
        'settings' => 'orthosmile_value_3_description',
        'type'     => 'textarea',
    ]);
}

/**
 * Add hero stats customizer section.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function orthosmile_customize_hero_stats($wp_customize) {
    $wp_customize->add_section('orthosmile_hero_stats', [
        'title'    => __('Hero – Statistiques', 'orthosmile'),
        'priority' => 30,
        'panel'    => '',
    ]);

    $stats = [
        'orthosmile_stat_patients' => [
            'label'   => __('Stat : Patients traités', 'orthosmile'),
            'default' => '2 500+',
        ],
        'orthosmile_stat_years' => [
            'label'   => __('Stat : Années d\'expérience', 'orthosmile'),
            'default' => '18',
        ],
        'orthosmile_stat_success' => [
            'label'   => __('Stat : Taux de satisfaction', 'orthosmile'),
            'default' => '98%',
        ],
        'orthosmile_stat_reviews' => [
            'label'   => __('Stat : Avis 5 étoiles', 'orthosmile'),
            'default' => '500+',
        ],
    ];

    foreach ($stats as $setting_id => $args) {
        $wp_customize->add_setting($setting_id, [
            'default'           => $args['default'],
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control($setting_id, [
            'label'   => $args['label'],
            'section' => 'orthosmile_hero_stats',
            'type'    => 'text',
        ]);
    }
}
add_action('customize_register', 'orthosmile_customize_hero_stats');
add_action('customize_register', 'orthosmile_customize_register_extended');