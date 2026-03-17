<?php
/**
 * Theme Customizer - unified settings for OrthoSmile.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) exit;

/* ============================================================
   SANITIZE HELPERS  (declared once)
   ============================================================ */
if (!function_exists('orthosmile_sanitize_checkbox')) {
    function orthosmile_sanitize_checkbox($checked) {
        return (bool) $checked;
    }
}

/* ============================================================
   MAIN REGISTER CALLBACK
   ============================================================ */
function orthosmile_customize_register($wp_customize) {

    /* ── Panel principal ─────────────────────────────────── */
    $wp_customize->add_panel('orthosmile_panel', [
        'title'    => __('⚙️ Options OrthoSmile', 'orthosmile'),
        'priority' => 30,
    ]);

    /* ================================================================
       SECTION 1 - GLOBAL (nom cabinet, slogan, favicon)
       ================================================================ */
    $wp_customize->add_section('orthosmile_global', [
        'title'    => __('🏥 Cabinet - Global', 'orthosmile'),
        'panel'    => 'orthosmile_panel',
        'priority' => 10,
    ]);

    $wp_customize->add_setting('cabinet_name', ['default' => 'XXXX - Nom du cabinet', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
    $wp_customize->add_control('cabinet_name', ['label' => __('Nom du cabinet', 'orthosmile'), 'section' => 'orthosmile_global', 'type' => 'text']);

    $wp_customize->add_setting('cabinet_slogan', ['default' => 'XXXX - Votre slogan', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
    $wp_customize->add_control('cabinet_slogan', ['label' => __('Slogan / Sous-titre cabinet', 'orthosmile'), 'section' => 'orthosmile_global', 'type' => 'text']);

    /* ================================================================
       SECTION 2 - CONTACT
       ================================================================ */
    $wp_customize->add_section('orthosmile_contact_section', [
        'title'    => __('📞 Coordonnées', 'orthosmile'),
        'panel'    => 'orthosmile_panel',
        'priority' => 20,
    ]);

    $wp_customize->add_setting('phone_number', ['default' => 'XXXX', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('phone_number', ['label' => __('Numéro de téléphone', 'orthosmile'), 'section' => 'orthosmile_contact_section', 'type' => 'text']);

    $wp_customize->add_setting('contact_email', ['default' => 'XXXX@XXXX.fr', 'sanitize_callback' => 'sanitize_email']);
    $wp_customize->add_control('contact_email', ['label' => __('Email', 'orthosmile'), 'section' => 'orthosmile_contact_section', 'type' => 'email']);

    $wp_customize->add_setting('contact_address', ['default' => 'XXXX - Adresse du cabinet', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('contact_address', ['label' => __('Adresse', 'orthosmile'), 'section' => 'orthosmile_contact_section', 'type' => 'text']);

    $wp_customize->add_setting('opening_hours', ['default' => 'XXXX - Lun-Ven 9h-19h', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('opening_hours', ['label' => __('Horaires d\'ouverture', 'orthosmile'), 'section' => 'orthosmile_contact_section', 'type' => 'text']);

    $wp_customize->add_setting('appointment_url', ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('appointment_url', [
        'label'       => __('URL prise de RDV (Doctolib, etc.)', 'orthosmile'),
        'description' => __('Laissez vide pour pointer vers la page /contact.', 'orthosmile'),
        'section'     => 'orthosmile_contact_section',
        'type'        => 'url',
    ]);

    $wp_customize->add_setting('contact_map_embed', ['default' => '', 'sanitize_callback' => 'wp_kses_post']);
    $wp_customize->add_control('contact_map_embed', [
        'label'       => __('Code intégration Google Maps (iframe)', 'orthosmile'),
        'section'     => 'orthosmile_contact_section',
        'type'        => 'textarea',
    ]);

    /* ================================================================
       SECTION 3 - HERO
       ================================================================ */
    $wp_customize->add_section('orthosmile_hero_section', [
        'title'    => __('🦸 Section Héro', 'orthosmile'),
        'panel'    => 'orthosmile_panel',
        'priority' => 30,
    ]);

    $wp_customize->add_setting('hero_title', ['default' => 'Votre sourire parfait commence ici', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
    $wp_customize->add_control('hero_title', ['label' => __('Titre principal', 'orthosmile'), 'section' => 'orthosmile_hero_section', 'type' => 'text']);

    $wp_customize->add_setting('hero_subtitle', ['default' => 'XXXX - Sous-titre de bienvenue (ex: Cabinet orthodontiste à Paris)', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage']);
    $wp_customize->add_control('hero_subtitle', ['label' => __('Sous-titre', 'orthosmile'), 'section' => 'orthosmile_hero_section', 'type' => 'textarea']);

    $wp_customize->add_setting('hero_cta_text', ['default' => 'Prendre rendez-vous', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
    $wp_customize->add_control('hero_cta_text', ['label' => __('Texte bouton CTA principal', 'orthosmile'), 'section' => 'orthosmile_hero_section', 'type' => 'text']);

    $wp_customize->add_setting('hero_cta_url', ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('hero_cta_url', ['label' => __('URL bouton CTA (laissez vide = appointment_url)', 'orthosmile'), 'section' => 'orthosmile_hero_section', 'type' => 'url']);

    $wp_customize->add_setting('hero_image', ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image', [
        'label'    => __('Image verticale à droite du Hero', 'orthosmile'),
        'description' => __('Image portrait, cabinet ou équipe. S’affiche à droite du texte.', 'orthosmile'),
        'section'  => 'orthosmile_hero_section',
        'settings' => 'hero_image',
    ]));

    $wp_customize->add_setting('show_hero_image', ['default' => true, 'sanitize_callback' => 'orthosmile_sanitize_checkbox']);
    $wp_customize->add_control('show_hero_image', [
        'label'       => __('Afficher l\'image du héro', 'orthosmile'),
        'description' => __('Décochez pour un layout pleine largeur sans image.', 'orthosmile'),
        'section'     => 'orthosmile_hero_section',
        'type'        => 'checkbox',
    ]);

    $wp_customize->add_setting('hero_image_alt', ['default' => '', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('hero_image_alt', [
        'label'   => __('Texte alternatif de l\'image (accessibilité)', 'orthosmile'),
        'section' => 'orthosmile_hero_section',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('hero_secondary_cta_text', ['default' => __('Voir nos traitements', 'orthosmile'), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
    $wp_customize->add_control('hero_secondary_cta_text', [
        'label'       => __('Texte bouton secondaire', 'orthosmile'),
        'description' => __('Laissez vide pour masquer le bouton secondaire.', 'orthosmile'),
        'section'     => 'orthosmile_hero_section',
        'type'        => 'text',
    ]);

    $wp_customize->add_setting('hero_secondary_cta_url', ['default' => '#services', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('hero_secondary_cta_url', [
        'label'   => __('URL bouton secondaire', 'orthosmile'),
        'section' => 'orthosmile_hero_section',
        'type'    => 'text',
    ]);

    /* ── Hero Badges (3 × texte + icône + visible) ── */
    $hero_badge_defaults = [
        1 => ['icon' => 'workspace_premium', 'text' => __('Spécialistes certifiés', 'orthosmile')],
        2 => ['icon' => 'visibility_off',    'text' => __('Invisalign Certified',      'orthosmile')],
        3 => ['icon' => 'child_care',        'text' => __('Pédiatrie & adultes',  'orthosmile')],
    ];

    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting("hero_badge_{$i}_show", ['default' => true, 'sanitize_callback' => 'orthosmile_sanitize_checkbox']);
        $wp_customize->add_control("hero_badge_{$i}_show", [
            'label'   => sprintf(__('Badge %d - Afficher', 'orthosmile'), $i),
            'section' => 'orthosmile_hero_section',
            'type'    => 'checkbox',
        ]);

        $wp_customize->add_setting("hero_badge_{$i}_text", ['default' => $hero_badge_defaults[$i]['text'], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
        $wp_customize->add_control("hero_badge_{$i}_text", [
            'label'   => sprintf(__('Badge %d - Texte', 'orthosmile'), $i),
            'section' => 'orthosmile_hero_section',
            'type'    => 'text',
        ]);

        $wp_customize->add_setting("hero_badge_{$i}_icon", ['default' => $hero_badge_defaults[$i]['icon'], 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control("hero_badge_{$i}_icon", [
            'label'       => sprintf(__('Badge %d - Icône Material Symbols', 'orthosmile'), $i),
            'description' => __('Ex : workspace_premium, verified, star, favorite…', 'orthosmile'),
            'section'     => 'orthosmile_hero_section',
            'type'        => 'text',
        ]);
    }

    /* ================================================================
       SECTION 4 - STATS (compteurs)
       ================================================================ */
    $wp_customize->add_section('orthosmile_stats_section', [
        'title'    => __('📊 Statistiques (compteurs)', 'orthosmile'),
        'panel'    => 'orthosmile_panel',
        'priority' => 40,
    ]);

    $stats = [
        'stat_1' => ['XXXX', 'XXXX - Légende stat 1', 'emoji_events'],
        'stat_2' => ['XXXX', 'XXXX - Légende stat 2', 'groups'],
        'stat_3' => ['XXXX', 'XXXX - Légende stat 3', 'verified'],
        'stat_4' => ['XXXX', 'XXXX - Légende stat 4', 'star'],
    ];

    foreach ($stats as $key => [$val_default, $label_default, $icon_default]) {
        $n = substr($key, -1);
        $wp_customize->add_setting("{$key}_value", ['default' => $val_default, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
        $wp_customize->add_control("{$key}_value", ['label' => sprintf(__('Stat %d - Valeur', 'orthosmile'), $n), 'section' => 'orthosmile_stats_section', 'type' => 'text']);

        $wp_customize->add_setting("{$key}_label", ['default' => $label_default, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
        $wp_customize->add_control("{$key}_label", ['label' => sprintf(__('Stat %d - Légende', 'orthosmile'), $n), 'section' => 'orthosmile_stats_section', 'type' => 'text']);

        $wp_customize->add_setting("{$key}_icon", ['default' => $icon_default, 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control("{$key}_icon", ['label' => sprintf(__('Stat %d - Icône Material', 'orthosmile'), $n), 'section' => 'orthosmile_stats_section', 'type' => 'text']);
    }

    /* ================================================================
       SECTION 5 - ÉQUIPE (photo équipe collective)
       ================================================================ */
    $wp_customize->add_section('orthosmile_equipe_section', [
        'title'    => __('👥 Équipe', 'orthosmile'),
        'panel'    => 'orthosmile_panel',
        'priority' => 50,
    ]);

    $wp_customize->add_setting('equipe_title', ['default' => 'Une équipe à votre écoute', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
    $wp_customize->add_control('equipe_title', ['label' => __('Titre section équipe', 'orthosmile'), 'section' => 'orthosmile_equipe_section', 'type' => 'text']);

    $wp_customize->add_setting('equipe_subtitle', ['default' => 'XXXX - Présentation de votre équipe', 'sanitize_callback' => 'sanitize_textarea_field']);
    $wp_customize->add_control('equipe_subtitle', ['label' => __('Sous-titre section équipe', 'orthosmile'), 'section' => 'orthosmile_equipe_section', 'type' => 'textarea']);

    $wp_customize->add_setting('equipe_team_photo', ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'equipe_team_photo', [
        'label'       => __('Photo collective de l\'équipe', 'orthosmile'),
        'description' => __('Image panoramique affichée en bannière au-dessus des cartes praticiens.', 'orthosmile'),
        'section'     => 'orthosmile_equipe_section',
        'settings'    => 'equipe_team_photo',
    ]));

    $wp_customize->add_setting('equipe_rdv_label', ['default' => 'Prendre rendez-vous', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('equipe_rdv_label', ['label' => __('Label bouton RDV sur les cartes praticien', 'orthosmile'), 'section' => 'orthosmile_equipe_section', 'type' => 'text']);

    /* ================================================================
       SECTION 7 - RÉSEAUX SOCIAUX
       ================================================================ */
    $wp_customize->add_section('orthosmile_social_section', [
        'title'    => __('📲 Réseaux Sociaux', 'orthosmile'),
        'panel'    => 'orthosmile_panel',
        'priority' => 70,
    ]);

    $socials = ['facebook' => 'Facebook', 'instagram' => 'Instagram', 'linkedin' => 'LinkedIn', 'youtube' => 'YouTube'];
    foreach ($socials as $key => $label) {
        $wp_customize->add_setting("{$key}_url", ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
        $wp_customize->add_control("{$key}_url", ['label' => __("URL $label", 'orthosmile'), 'section' => 'orthosmile_social_section', 'type' => 'url']);
    }

    /* ================================================================
       SECTION 8 - AFFICHAGE DES SECTIONS
       ================================================================ */
    $wp_customize->add_section('orthosmile_sections_section', [
        'title'    => __('👁️ Affichage des Sections', 'orthosmile'),
        'panel'    => 'orthosmile_panel',
        'priority' => 80,
    ]);

    $sections_toggle = [
        'show_stats'        => __('Afficher les statistiques', 'orthosmile'),
        'show_doctors'      => __('Afficher la section Équipe', 'orthosmile'),
        'show_services'     => __('Afficher la section Services/Traitements', 'orthosmile'),
        'show_gallery'      => __('Afficher la galerie Avant/Après', 'orthosmile'),
        'show_testimonials' => __('Afficher les témoignages', 'orthosmile'),
        'show_faq'          => __('Afficher la FAQ', 'orthosmile'),
        'show_cta'          => __('Afficher le CTA final', 'orthosmile'),
    ];

    foreach ($sections_toggle as $key => $label) {
        $wp_customize->add_setting($key, ['default' => true, 'sanitize_callback' => 'orthosmile_sanitize_checkbox']);
        $wp_customize->add_control($key, ['label' => $label, 'section' => 'orthosmile_sections_section', 'type' => 'checkbox']);
    }

    /* ================================================================
       SECTION 9 - CTA FINAL
       ================================================================ */
    $wp_customize->add_section('orthosmile_cta_section', [
        'title'    => __('🎯 Section CTA (appel à l\'action)', 'orthosmile'),
        'panel'    => 'orthosmile_panel',
        'priority' => 90,
    ]);

    $wp_customize->add_setting('cta_title', ['default' => 'Prêt à transformer votre sourire ?', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
    $wp_customize->add_control('cta_title', ['label' => __('Titre CTA', 'orthosmile'), 'section' => 'orthosmile_cta_section', 'type' => 'text']);

    $wp_customize->add_setting('cta_subtitle', ['default' => 'Consultez nos spécialistes et bénéficiez d\'un bilan orthodontique offert.', 'sanitize_callback' => 'sanitize_textarea_field']);
    $wp_customize->add_control('cta_subtitle', ['label' => __('Sous-titre CTA', 'orthosmile'), 'section' => 'orthosmile_cta_section', 'type' => 'textarea']);

    $wp_customize->add_setting('cta_btn_text', ['default' => 'Prendre rendez-vous', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('cta_btn_text', ['label' => __('Texte bouton CTA', 'orthosmile'), 'section' => 'orthosmile_cta_section', 'type' => 'text']);

    $wp_customize->add_setting('cta_contact_text', ['default' => 'Nous contacter', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('cta_contact_text', ['label' => __('Texte bouton secondaire (contact)', 'orthosmile'), 'section' => 'orthosmile_cta_section', 'type' => 'text']);

    /* ================================================================
       SECTION 10 - FOOTER
       ================================================================ */
    $wp_customize->add_section('orthosmile_footer_section', [
        'title'    => __('🔻 Footer', 'orthosmile'),
        'panel'    => 'orthosmile_panel',
        'priority' => 100,
    ]);

    $wp_customize->add_setting('footer_description', ['default' => 'XXXX - Description courte du cabinet pour le footer.', 'sanitize_callback' => 'sanitize_textarea_field']);
    $wp_customize->add_control('footer_description', ['label' => __('Description cabinet (footer)', 'orthosmile'), 'section' => 'orthosmile_footer_section', 'type' => 'textarea']);

    $wp_customize->add_setting('footer_legal', ['default' => '', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('footer_legal', ['label' => __('Texte légal (ex: RPPS, mentions)', 'orthosmile'), 'section' => 'orthosmile_footer_section', 'type' => 'text']);

    /* ================================================================
       SECTION 11 - TÉMOIGNAGES (6 témoignages patients)
       ================================================================ */
    $wp_customize->add_section('orthosmile_testimonials_section', [
        'title'    => __('⭐ Témoignages patients', 'orthosmile'),
        'panel'    => 'orthosmile_panel',
        'priority' => 85,
    ]);

    $wp_customize->add_setting('testimonials_title', ['default' => 'Ce que disent nos patients', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('testimonials_title', ['label' => __('Titre section témoignages', 'orthosmile'), 'section' => 'orthosmile_testimonials_section', 'type' => 'text']);

    $wp_customize->add_setting('testimonials_subtitle', ['default' => 'Des centaines de familles nous font confiance', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('testimonials_subtitle', ['label' => __('Sous-titre témoignages', 'orthosmile'), 'section' => 'orthosmile_testimonials_section', 'type' => 'text']);

    for ($i = 1; $i <= 6; $i++) {
        $wp_customize->add_setting("testimonial_{$i}_name",      ['default' => '', 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_setting("testimonial_{$i}_text",      ['default' => '', 'sanitize_callback' => 'sanitize_textarea_field']);
        $wp_customize->add_setting("testimonial_{$i}_rating",    ['default' => 5,  'sanitize_callback' => 'absint']);
        $wp_customize->add_setting("testimonial_{$i}_treatment", ['default' => '', 'sanitize_callback' => 'sanitize_text_field']);

        $wp_customize->add_control("testimonial_{$i}_name",      ['label' => sprintf(__('Témoignage %d - Prénom Nom', 'orthosmile'), $i), 'section' => 'orthosmile_testimonials_section', 'type' => 'text']);
        $wp_customize->add_control("testimonial_{$i}_text",      ['label' => sprintf(__('Témoignage %d - Texte', 'orthosmile'), $i),    'section' => 'orthosmile_testimonials_section', 'type' => 'textarea']);
        $wp_customize->add_control("testimonial_{$i}_rating",    ['label' => sprintf(__('Témoignage %d - Note /5', 'orthosmile'), $i),  'section' => 'orthosmile_testimonials_section', 'type' => 'number', 'input_attrs' => ['min' => 1, 'max' => 5]]);
        $wp_customize->add_control("testimonial_{$i}_treatment", ['label' => sprintf(__('Témoignage %d - Traitement', 'orthosmile'), $i), 'section' => 'orthosmile_testimonials_section', 'type' => 'text']);
    }

    /* ================================================================
       SECTION 12 - GALERIE AVANT/APRÈS (3 paires d'images)
       ================================================================ */
    $wp_customize->add_section('orthosmile_gallery_section', [
        'title'    => __('🖼️ Galerie Avant/Après', 'orthosmile'),
        'panel'    => 'orthosmile_panel',
        'priority' => 75,
    ]);

    $wp_customize->add_setting('gallery_title', ['default' => 'Nos résultats', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('gallery_title', ['label' => __('Titre section galerie', 'orthosmile'), 'section' => 'orthosmile_gallery_section', 'type' => 'text']);

    $wp_customize->add_setting('gallery_subtitle', ['default' => 'Des transformations réelles, des sourires rayonnants', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('gallery_subtitle', ['label' => __('Sous-titre galerie', 'orthosmile'), 'section' => 'orthosmile_gallery_section', 'type' => 'text']);

    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting("gallery_{$i}_before", ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
        $wp_customize->add_setting("gallery_{$i}_after",  ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
        $wp_customize->add_setting("gallery_{$i}_label",  ['default' => "XXXX - Cas clinique {$i}", 'sanitize_callback' => 'sanitize_text_field']);

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "gallery_{$i}_before", [
            'label'   => sprintf(__('Cas %d - Image AVANT', 'orthosmile'), $i),
            'section' => 'orthosmile_gallery_section',
        ]));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "gallery_{$i}_after", [
            'label'   => sprintf(__('Cas %d - Image APRÈS', 'orthosmile'), $i),
            'section' => 'orthosmile_gallery_section',
        ]));
        $wp_customize->add_control("gallery_{$i}_label", ['label' => sprintf(__('Cas %d - Légende', 'orthosmile'), $i), 'section' => 'orthosmile_gallery_section', 'type' => 'text']);
    }

    /* ================================================================
       SECTION 13 - TITRES DES SECTIONS (services, FAQ)
       ================================================================ */
    $wp_customize->add_section('orthosmile_section_titles', [
        'title'    => __('📝 Titres des sections', 'orthosmile'),
        'panel'    => 'orthosmile_panel',
        'priority' => 72,
    ]);

    $wp_customize->add_setting('services_title',    ['default' => 'Nos traitements orthodontiques', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('services_title',    ['label' => __('Titre section Traitements', 'orthosmile'), 'section' => 'orthosmile_section_titles', 'type' => 'text']);
    $wp_customize->add_setting('services_subtitle', ['default' => 'Des solutions modernes adaptées à chaque profil', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('services_subtitle', ['label' => __('Sous-titre Traitements', 'orthosmile'), 'section' => 'orthosmile_section_titles', 'type' => 'text']);

    $wp_customize->add_setting('faq_title',    ['default' => 'Questions fréquentes', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('faq_title',    ['label' => __('Titre section FAQ', 'orthosmile'), 'section' => 'orthosmile_section_titles', 'type' => 'text']);
    $wp_customize->add_setting('faq_subtitle', ['default' => 'Tout ce que vous souhaitez savoir sur l\'orthodontie', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('faq_subtitle', ['label' => __('Sous-titre FAQ', 'orthosmile'), 'section' => 'orthosmile_section_titles', 'type' => 'text']);

}
add_action('customize_register', 'orthosmile_customize_register');

/**
 * Customizer live preview JS.
 */
function orthosmile_customize_preview_js() {
    wp_enqueue_script('orthosmile-customizer', get_template_directory_uri() . '/assets/js/customizer.js', ['customize-preview'], '2.0.0', true);
}
add_action('customize_preview_init', 'orthosmile_customize_preview_js');