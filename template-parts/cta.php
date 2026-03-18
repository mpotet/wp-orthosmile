<?php
/**
 * Template part: CTA dark section.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) exit;

if ( ! orthosmile_get_option( 'show_cta', '1' ) ) return;

$cta_title    = orthosmile_get_option( 'cta_title',        __( 'Prêt à transformer votre sourire ?', 'orthosmile' ) );
$cta_subtitle = orthosmile_get_option( 'cta_subtitle',     __( 'Consultez nos spécialistes et bénéficiez d\'un bilan orthodontique offert.', 'orthosmile' ) );
$cta_btn      = orthosmile_get_option( 'cta_btn_text',     __( 'Prendre rendez-vous', 'orthosmile' ) );
$cta_contact  = orthosmile_get_option( 'cta_contact_text', __( 'Nous contacter', 'orthosmile' ) );
$rdv_url      = orthosmile_get_appointment_url();
$phone        = orthosmile_get_option( 'phone_number', '' );
?>

<section class="cta-section" id="cta">
    <div class="container">
        <div class="cta-content fade-in-up">
            <span class="cta-eyebrow">
                <span class="material-symbols-outlined" aria-hidden="true">favorite</span>
                <?php esc_html_e('Consultation offerte', 'orthosmile'); ?>
            </span>

            <h2 class="cta-title"><?php echo esc_html($cta_title); ?></h2>

            <p class="cta-subtitle"><?php echo esc_html($cta_subtitle); ?></p>

            <div class="cta-buttons">
                <a href="<?php echo esc_url($rdv_url); ?>" class="btn btn-gold btn-lg">
                    <span class="material-symbols-outlined" aria-hidden="true">calendar_month</span>
                    <?php echo esc_html($cta_btn); ?>
                </a>
                <a href="#contact" class="btn btn-outline-white btn-lg">
                    <?php echo esc_html($cta_contact); ?>
                </a>
            </div>

            <?php if ($phone) : ?>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="cta-phone">
                <span class="material-symbols-outlined" aria-hidden="true">call</span>
                <?php echo esc_html($phone); ?>
                <span style="opacity:.5;margin:0 .25rem;">&mdash;</span>
                <?php esc_html_e('Appelez-nous directement', 'orthosmile'); ?>
            </a>
            <?php endif; ?>
        </div>
    </div>
</section>