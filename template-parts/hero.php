<?php
/**
 * Template part: Hero section.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) exit;

$hero_title    = get_theme_mod('hero_title', 'Votre sourire parfait commence ici');
$hero_subtitle = get_theme_mod('hero_subtitle', 'XXXX — Décrivez votre cabinet et votre approche ici.');
$hero_cta_text = get_theme_mod('hero_cta_text', 'Prendre rendez-vous');
$hero_cta_url  = get_theme_mod('hero_cta_url', '') ?: orthosmile_get_appointment_url();
$hero_image    = get_theme_mod('hero_image', '');
$phone         = get_theme_mod('phone_number', '');

$stat_1_v = get_theme_mod('stat_1_value', 'XXXX');
$stat_1_l = get_theme_mod('stat_1_label', 'XXXX — Légende');
$stat_2_v = get_theme_mod('stat_2_value', 'XXXX');
$stat_2_l = get_theme_mod('stat_2_label', 'XXXX — Légende');
$stat_3_v = get_theme_mod('stat_3_value', 'XXXX');
$stat_3_l = get_theme_mod('stat_3_label', 'XXXX — Légende');
$stat_4_v = get_theme_mod('stat_4_value', 'XXXX');
$stat_4_l = get_theme_mod('stat_4_label', 'XXXX — Légende');

$cabinet_name = get_theme_mod('cabinet_name', get_bloginfo('name'));

$hero_style = '';
if ($hero_image) {
    $hero_style = 'background-image:url(' . esc_url($hero_image) . ')';
}
?>


<section class="hero" id="hero">
    <div class="container">
        <div class="hero-grid">
            <div class="hero-content">
                <div class="hero-eyebrow">
                    <span class="material-symbols-outlined" aria-hidden="true">verified</span>
                    <?php echo esc_html($cabinet_name ?: __('Cabinet Orthodontiste', 'orthosmile')); ?>
                </div>
                <h1 class="hero-title">Nos traitements orthodontiques</h1>
                <p class="hero-subtitle">Des solutions modernes adaptées à chaque profil</p>
                <div class="hero-badges">
                    <span class="hero-badge">
                        <span class="material-symbols-outlined" aria-hidden="true">workspace_premium</span>
                        <?php esc_html_e('Spécialistes certifiés', 'orthosmile'); ?>
                    </span>
                    <span class="hero-badge">
                        <span class="material-symbols-outlined" aria-hidden="true">visibility_off</span>
                        Invisalign Certified
                    </span>
                    <span class="hero-badge">
                        <span class="material-symbols-outlined" aria-hidden="true">child_care</span>
                        <?php esc_html_e('Pédiatrie & adultes', 'orthosmile'); ?>
                    </span>
                </div>
                <div class="hero-actions">
                    <a href="<?php echo esc_url($hero_cta_url); ?>" class="btn btn-primary btn-lg">
                        <span class="material-symbols-outlined" aria-hidden="true">calendar_month</span>
                        <?php echo esc_html($hero_cta_text); ?>
                    </a>
                    <a href="#services" class="btn btn-outline-white btn-lg">
                        <?php esc_html_e('Voir nos traitements', 'orthosmile'); ?>
                        <span class="material-symbols-outlined" aria-hidden="true">arrow_downward</span>
                    </a>
                </div>
            </div>
            <div class="hero-image">
                <?php if ($hero_image) : ?>
                    <img src="<?php echo esc_url($hero_image); ?>" alt="Photo du cabinet ou équipe" />
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
