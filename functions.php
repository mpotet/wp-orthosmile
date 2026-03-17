<?php
/**
 * OrthoSmile - Point d’entrée principal du thème.
 * Charge les modules /inc.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) exit;

/* ── Modules à charger ─────────────────────────────────────── */
$orthosmile_modules = [
    'inc/theme-setup.php',
    'inc/enqueue.php',
    'inc/template-functions.php',
    'inc/template-tags.php',
    'inc/customizer.php',
    'inc/cpt-praticien.php',
    'inc/cpt-traitement.php',
    'inc/cpt-faq.php',
];

foreach ($orthosmile_modules as $module) {
    $path = get_template_directory() . '/' . $module;
    if (file_exists($path)) {
        require_once $path;
    }
}

/* ── Traductions ───────────────────────────────────────────── */
add_action('after_setup_theme', function () {
    load_theme_textdomain('orthosmile', get_template_directory() . '/languages');
});

/* ── Formulaire de contact (page /contact) ─────────────────── */
add_action('admin_post_orthosmile_contact_form',        'orthosmile_handle_contact_form');
add_action('admin_post_nopriv_orthosmile_contact_form', 'orthosmile_handle_contact_form');

function orthosmile_handle_contact_form() {
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce($_POST['contact_nonce'], 'orthosmile_contact_form')) {
        wp_die(__('Erreur de sécurité', 'orthosmile'));
    }

    $name    = sanitize_text_field($_POST['contact_name'] ?? '');
    $email   = sanitize_email($_POST['contact_email'] ?? '');
    $phone   = sanitize_text_field($_POST['contact_phone'] ?? '');
    $subject = sanitize_text_field($_POST['contact_subject'] ?? '');
    $message = sanitize_textarea_field($_POST['contact_message'] ?? '');

    if (empty($name) || empty($email) || empty($subject) || empty($message) || !is_email($email)) {
        wp_die(__('Données invalides ou manquantes.', 'orthosmile'));
    }

    $to   = get_option('admin_email');
    $subj = sprintf(__('[OrthoSmile] Nouveau message de %s', 'orthosmile'), $name);
    $body = "Nom : $name\nEmail : $email\nTéléphone : $phone\nSujet : $subject\n\n$message\n\nDate : " . wp_date('d/m/Y H:i');

    wp_mail($to, $subj, $body, ['Content-Type: text/plain; charset=UTF-8']);
    wp_safe_redirect(add_query_arg('contact_success', '1', wp_get_referer() ?: home_url()));
    exit;
}

/* ── Notice succès contact ─────────────────────────────────── */
add_action('wp_head', function () {
    if (!isset($_GET['contact_success'])) return;
    $color = get_theme_mod('primary_color', '#0F766E');
    printf(
        '<style>.os-notice{position:fixed;top:1.5rem;left:50%%;transform:translateX(-50%%);background:%s;color:#fff;padding:.875rem 2rem;border-radius:50px;z-index:9999;font-size:.9rem;font-weight:600;box-shadow:0 8px 24px rgba(0,0,0,.2);animation:os-slide .4s ease}</style>
         <style>@keyframes os-slide{from{opacity:0;transform:translateX(-50%%) translateY(-12px)}to{opacity:1;transform:translateX(-50%%) translateY(0)}}</style>
         <div class="os-notice">✓ %s</div>',
        esc_attr($color),
        esc_html__('Message envoyé avec succès !', 'orthosmile')
    );
});
