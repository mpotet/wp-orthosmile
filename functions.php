<?php
/**
 * Rôle: point d’entrée principal du thème.
 * Charge les modules /inc pour une architecture propre et maintenable.
 *
 * @package OrthoSmile
 */

if (! defined('ABSPATH')) {
    exit;
}

$orthosmile_includes = [
    'inc/theme-setup.php',
    'inc/enqueue.php',
    'inc/cpt.php',
    'inc/theme-options.php',
    'inc/admin-meta.php',
    'inc/acf-fields.php',
];


foreach ($orthosmile_includes as $file) {
    $path = get_template_directory() . '/' . $file;
    if (file_exists($path)) {
        require_once $path;
    }
}

// Charger les fichiers de traduction du thème
add_action('after_setup_theme', function () {
    load_theme_textdomain('orthosmile', get_template_directory() . '/languages');
});

// Gestion du formulaire de contact
add_action('admin_post_orthosmile_contact_form', 'orthosmile_handle_contact_form');
add_action('admin_post_nopriv_orthosmile_contact_form', 'orthosmile_handle_contact_form');

function orthosmile_handle_contact_form() {
    // Vérification du nonce
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce($_POST['contact_nonce'], 'contact_form')) {
        wp_die(__('Erreur de sécurité', 'orthosmile'));
    }

    // Récupération des données
    $name = sanitize_text_field($_POST['contact_name']);
    $email = sanitize_email($_POST['contact_email']);
    $phone = sanitize_text_field($_POST['contact_phone']);
    $subject = sanitize_text_field($_POST['contact_subject']);
    $message = sanitize_textarea_field($_POST['contact_message']);

    // Validation des champs requis
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        wp_die(__('Tous les champs requis doivent être remplis.', 'orthosmile'));
    }

    if (!is_email($email)) {
        wp_die(__('L\'adresse email n\'est pas valide.', 'orthosmile'));
    }

    // Préparation de l'email
    $to = get_option('admin_email');
    $subject_email = "Nouveau message de contact - $name";
    
    $body = "Nouveau message de contact reçu :\n\n";
    $body .= "Nom: $name\n";
    $body .= "Email: $email\n";
    $body .= "Téléphone: $phone\n";
    $body .= "Sujet: $subject\n\n";
    $body .= "Message:\n$message\n\n";
    $body .= "Date: " . date('d/m/Y H:i:s') . "\n";

    $headers = array('Content-Type: text/plain; charset=UTF-8');

    // Envoi de l'email
    if (wp_mail($to, $subject_email, $body, $headers)) {
        wp_redirect(add_query_arg('contact_success', '1', wp_get_referer()));
        exit;
    } else {
        wp_die(__('Erreur lors de l\'envoi du message. Veuillez réessayer.', 'orthosmile'));
    }
}

// Charger le customizer étendu
if (file_exists(get_template_directory() . '/inc/customizer-extended.php')) {
    require_once get_template_directory() . '/inc/customizer-extended.php';
}

// Affichage du message de succès
add_action('wp_head', function() {
    if (isset($_GET['contact_success'])) {
        echo '<style>.orthosmile-notice{position:fixed;top:20px;left:50%;transform:translateX(-50%);background:#0f766e;color:#fff;padding:14px 28px;border-radius:6px;z-index:9999;font-family:sans-serif;box-shadow:0 4px 12px rgba(0,0,0,.15)}</style>';
        echo '<div class="orthosmile-notice">' . esc_html__('Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.', 'orthosmile') . '</div>';
    }
});
