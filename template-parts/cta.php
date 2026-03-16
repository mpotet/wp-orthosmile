<?php
/**
 * Template part for displaying the CTA section.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) {
    exit;
}

$contact_info = orthosmile_get_contact_info();
?>

<section class="cta-section" id="cta">
    <div class="container">
        <div class="cta-content fade-in-up">
            <span class="cta-eyebrow"><?php esc_html_e('Commencez votre transformation', 'orthosmile'); ?></span>
            <h2 class="cta-title"><?php esc_html_e('Prêt à transformer votre sourire ?', 'orthosmile'); ?></h2>
            <p class="cta-subtitle">
                <?php esc_html_e('Prenez rendez-vous dès aujourd\'hui pour une consultation personnalisée. Notre équipe vous accompagne à chaque étape de votre parcours orthodontique.', 'orthosmile'); ?>
            </p>
            <div class="cta-buttons">
                <a href="<?php echo esc_url(orthosmile_get_appointment_url()); ?>" class="btn btn-accent btn-lg">
                    <span class="material-symbols-outlined">calendar_month</span>
                    <?php esc_html_e('Prendre rendez-vous', 'orthosmile'); ?>
                </a>
                <?php if (!empty($contact_info['phone'])) : ?>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $contact_info['phone'])); ?>" class="btn btn-outline btn-lg">
                        <span class="material-symbols-outlined">call</span>
                        <?php esc_html_e('Nous appeler', 'orthosmile'); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>