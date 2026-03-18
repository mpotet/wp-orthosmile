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
    'inc/admin-settings.php',
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

/* ── CSS admin notices + about section ────────────────────── */
add_action( 'wp_enqueue_scripts', function () {
	wp_add_inline_style( 'orthosmile-main',
		/* Empty notices (admin only) */
		'.orthosmile-empty-notice{display:flex;align-items:flex-start;gap:10px;background:#e8f5e9;border-left:4px solid #0F766E;border-radius:0 6px 6px 0;padding:16px 20px;margin:24px 0;font-size:14px;color:#065f46}'
		. '.orthosmile-empty-notice .material-symbols-outlined{font-size:20px;flex-shrink:0;margin-top:1px}'
		. '.orthosmile-empty-notice p{margin:0}'
		. '.orthosmile-empty-notice a{color:#0F766E;font-weight:600;text-decoration:underline}'
		/* About section */
		. '.about-section{background:var(--color-bg-alt,#f0f9f5)}'
		. '.about-inner{display:grid;gap:3rem;align-items:center;margin-top:2.5rem}'
		. '.about-has-image{grid-template-columns:1fr 1fr}'
		. '.about-no-image{grid-template-columns:1fr;max-width:760px;margin-left:auto;margin-right:auto}'
		. '.about-image-wrap{border-radius:var(--radius-lg,12px);overflow:hidden;box-shadow:var(--shadow-lg)}'
		. '.about-image{width:100%;height:100%;object-fit:cover;display:block;max-height:480px}'
		. '.about-body{display:flex;flex-direction:column;gap:1.25rem}'
		. '.about-text{color:var(--color-text);line-height:1.8;font-size:1rem;white-space:pre-line}'
		. '@media(max-width:768px){.about-has-image{grid-template-columns:1fr}.about-image{max-height:280px}}'
	);
}, 20 );

/* ── GA4 injection ─────────────────────────────────────────── */
add_action('wp_head', function () {
    $ga_id = get_option('orthosmile_ga_id', '');
    if (!$ga_id) return;
    $ga_id = esc_js($ga_id);
    echo "<script async src=\"https://www.googletagmanager.com/gtag/js?id={$ga_id}\"></script>\n";
    echo "<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments)}gtag('js',new Date());gtag('config','{$ga_id}');</script>\n";
}, 1);

/* ── Notice succès contact ─────────────────────────────────── */
add_action('wp_head', function () {
    if (!isset($_GET['contact_success'])) return;
    $color = '#0F766E';
    printf(
        '<style>.os-notice{position:fixed;top:1.5rem;left:50%%;transform:translateX(-50%%);background:%s;color:#fff;padding:.875rem 2rem;border-radius:50px;z-index:9999;font-size:.9rem;font-weight:600;box-shadow:0 8px 24px rgba(0,0,0,.2);animation:os-slide .4s ease}</style>
         <style>@keyframes os-slide{from{opacity:0;transform:translateX(-50%%) translateY(-12px)}to{opacity:1;transform:translateX(-50%%) translateY(0)}}</style>
         <div class="os-notice">✓ %s</div>',
        esc_attr($color),
        esc_html__('Message envoyé avec succès !', 'orthosmile')
    );
});

/* =========================================================
   LANGUAGE SWITCHER — Admin Frontend Preview
   ========================================================= */

/**
 * Save locale choice in cookie and redirect to clean URL.
 * Triggered by ?orthosmile_lang=XX (admin only).
 */
add_action( 'init', 'orthosmile_handle_lang_switch', 1 );
function orthosmile_handle_lang_switch() {
	if ( is_admin() || ! is_user_logged_in() || ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( ! isset( $_GET['orthosmile_lang'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		return;
	}
	$lang    = sanitize_text_field( wp_unslash( $_GET['orthosmile_lang'] ) ); // phpcs:ignore WordPress.Security.NonceVerification
	$allowed = [ 'fr_FR', 'en_US', 'es_ES' ];
	$ssl     = is_ssl();
	if ( 'reset' === $lang ) {
		setcookie( 'orthosmile_preview_lang', '', time() - 3600, COOKIEPATH, COOKIE_DOMAIN, $ssl, true );
	} elseif ( in_array( $lang, $allowed, true ) ) {
		setcookie( 'orthosmile_preview_lang', $lang, 0, COOKIEPATH, COOKIE_DOMAIN, $ssl, true );
	}
	wp_safe_redirect( remove_query_arg( 'orthosmile_lang' ) );
	exit;
}

/**
 * Override locale from cookie (frontend only).
 */
add_filter( 'locale', 'orthosmile_preview_locale_filter' );
function orthosmile_preview_locale_filter( $locale ) {
	if ( defined( 'WP_ADMIN' ) && WP_ADMIN ) {
		return $locale;
	}
	if ( empty( $_COOKIE['orthosmile_preview_lang'] ) ) {
		return $locale;
	}
	$allowed = [ 'fr_FR', 'en_US', 'es_ES' ];
	$lang    = sanitize_text_field( $_COOKIE['orthosmile_preview_lang'] );
	return in_array( $lang, $allowed, true ) ? $lang : $locale;
}

/**
 * Add language switcher to WP Admin Bar on frontend.
 */
add_action( 'admin_bar_menu', 'orthosmile_admin_bar_lang_switcher', 999 );
function orthosmile_admin_bar_lang_switcher( $wp_admin_bar ) {
	if ( is_admin() || ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$current = get_locale();
	$langs   = [
		'fr_FR' => '🇫🇷 FR',
		'en_US' => '🇺🇸 EN',
		'es_ES' => '🇪🇸 ES',
	];
	$wp_admin_bar->add_node( [
		'id'    => 'orthosmile-lang',
		'title' => '🌐 ' . ( $langs[ $current ] ?? $current ),
		'href'  => '#',
	] );
	foreach ( $langs as $code => $label ) {
		$wp_admin_bar->add_node( [
			'parent' => 'orthosmile-lang',
			'id'     => 'orthosmile-lang-' . strtolower( str_replace( '_', '-', $code ) ),
			'title'  => ( $code === $current ? '✓ ' : '' ) . $label,
			'href'   => add_query_arg( 'orthosmile_lang', $code ),
		] );
	}
	if ( ! empty( $_COOKIE['orthosmile_preview_lang'] ) ) {
		$wp_admin_bar->add_node( [
			'parent' => 'orthosmile-lang',
			'id'     => 'orthosmile-lang-reset',
			'title'  => '↺ Langue du site',
			'href'   => add_query_arg( 'orthosmile_lang', 'reset' ),
		] );
	}
}
