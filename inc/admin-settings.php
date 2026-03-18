<?php
/**
 * OrthoSmile — inc/admin-settings.php
 * Panneau d'administration custom (alternative au WP Customizer).
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* =========================================================
   ENREGISTREMENT DU MENU ADMIN
   ========================================================= */
function orthosmile_register_admin_menu() {
	$hook = add_menu_page(
		__( 'OrthoSmile — Paramètres', 'orthosmile' ),
		__( '⚙️ OrthoSmile', 'orthosmile' ),
		'manage_options',
		'orthosmile-settings',
		'orthosmile_settings_page',
		'dashicons-smile',
		62
	);
	// load-{hook} ne se déclenche QUE sur cette page — garantit wp_enqueue_media
	add_action( "load-{$hook}", function () {
		add_action( 'admin_enqueue_scripts', function () {
			wp_enqueue_media();
		} );
	} );
}
add_action( 'admin_menu', 'orthosmile_register_admin_menu' );

/* =========================================================
   SAUVEGARDE
   ========================================================= */
function orthosmile_save_options() {
	if (
		! isset( $_POST['orthosmile_nonce'] ) ||
		! wp_verify_nonce( $_POST['orthosmile_nonce'], 'orthosmile_save_options' ) ||
		! current_user_can( 'manage_options' )
	) return;

	// WordPress ajoute des slashes sur $_POST via wp_magic_quotes() — on les supprime avant de sanitizer
	$_POST = wp_unslash( $_POST );

	$tab = isset( $_POST['orthosmile_tab'] ) ? sanitize_key( $_POST['orthosmile_tab'] ) : 'general';

	/* ── Onglet Général ── */
	if ( $tab === 'general' ) {
		$fields = [
			'orthosmile_cabinet_name'   => 'sanitize_text_field',
			'orthosmile_cabinet_slogan' => 'sanitize_text_field',
			'orthosmile_phone_number'   => 'sanitize_text_field',
			'orthosmile_contact_email'  => 'sanitize_email',
			'orthosmile_contact_address'=> 'sanitize_text_field',
			'orthosmile_opening_hours'  => 'sanitize_text_field',
			'orthosmile_logo_url'       => 'esc_url_raw',
			'orthosmile_color_primary'  => 'sanitize_hex_color',
			'orthosmile_facebook_url'   => 'esc_url_raw',
			'orthosmile_instagram_url'  => 'esc_url_raw',
			'orthosmile_linkedin_url'   => 'esc_url_raw',
			'orthosmile_youtube_url'    => 'esc_url_raw',
		];
		foreach ( $fields as $key => $sanitizer ) {
			if ( isset( $_POST[ $key ] ) ) update_option( $key, $sanitizer( $_POST[ $key ] ) );
		}
	}

	/* ── Onglet Contenu ── */
	if ( $tab === 'content' ) {
		// Show/hide sections (checkboxes)
		$toggles = [ 'orthosmile_show_about', 'orthosmile_show_stats', 'orthosmile_show_doctors', 'orthosmile_show_services',
		             'orthosmile_show_gallery', 'orthosmile_show_testimonials', 'orthosmile_show_faq', 'orthosmile_show_cta' ];
		foreach ( $toggles as $toggle ) {
			update_option( $toggle, isset( $_POST[ $toggle ] ) ? '1' : '0' );
		}

		// À propos
		$about_fields = [
			'orthosmile_about_titre'      => 'sanitize_text_field',
			'orthosmile_about_sous_titre' => 'sanitize_text_field',
			'orthosmile_about_texte'      => 'sanitize_textarea_field',
			'orthosmile_about_image'      => 'esc_url_raw',
		];
		foreach ( $about_fields as $key => $sanitizer ) {
			if ( isset( $_POST[ $key ] ) ) update_option( $key, $sanitizer( $_POST[ $key ] ) );
		}

		// Hero
		$hero_fields = [
			'orthosmile_hero_title'              => 'sanitize_text_field',
			'orthosmile_hero_subtitle'           => 'sanitize_textarea_field',
			'orthosmile_hero_cta_text'           => 'sanitize_text_field',
			'orthosmile_hero_cta_url'            => 'sanitize_text_field',
			'orthosmile_hero_secondary_cta_text' => 'sanitize_text_field',
			'orthosmile_hero_secondary_cta_url'  => 'sanitize_text_field',
			'orthosmile_hero_image'              => 'esc_url_raw',
			'orthosmile_hero_image_alt'          => 'sanitize_text_field',
		];
		foreach ( $hero_fields as $key => $sanitizer ) {
			if ( isset( $_POST[ $key ] ) ) update_option( $key, $sanitizer( $_POST[ $key ] ) );
		}
		update_option( 'orthosmile_show_hero_image', isset( $_POST['orthosmile_show_hero_image'] ) ? '1' : '0' );

		// Hero badges
		for ( $i = 1; $i <= 3; $i++ ) {
			update_option( "orthosmile_hero_badge_{$i}_show", isset( $_POST["orthosmile_hero_badge_{$i}_show"] ) ? '1' : '0' );
			if ( isset( $_POST["orthosmile_hero_badge_{$i}_text"] ) )
				update_option( "orthosmile_hero_badge_{$i}_text", sanitize_text_field( $_POST["orthosmile_hero_badge_{$i}_text"] ) );
			if ( isset( $_POST["orthosmile_hero_badge_{$i}_icon"] ) )
				update_option( "orthosmile_hero_badge_{$i}_icon", sanitize_text_field( $_POST["orthosmile_hero_badge_{$i}_icon"] ) );
		}

		// Stats
		for ( $i = 1; $i <= 4; $i++ ) {
			if ( isset( $_POST["orthosmile_stat_{$i}_value"] ) )
				update_option( "orthosmile_stat_{$i}_value", sanitize_text_field( $_POST["orthosmile_stat_{$i}_value"] ) );
			if ( isset( $_POST["orthosmile_stat_{$i}_label"] ) )
				update_option( "orthosmile_stat_{$i}_label", sanitize_text_field( $_POST["orthosmile_stat_{$i}_label"] ) );
			if ( isset( $_POST["orthosmile_stat_{$i}_icon"] ) )
				update_option( "orthosmile_stat_{$i}_icon",  sanitize_text_field( $_POST["orthosmile_stat_{$i}_icon"] ) );
		}

		// Équipe
		$equipe_fields = [
			'orthosmile_equipe_title'      => 'sanitize_text_field',
			'orthosmile_equipe_subtitle'   => 'sanitize_textarea_field',
			'orthosmile_equipe_team_photo' => 'esc_url_raw',
			'orthosmile_equipe_rdv_label'  => 'sanitize_text_field',
		];
		foreach ( $equipe_fields as $key => $sanitizer ) {
			if ( isset( $_POST[ $key ] ) ) update_option( $key, $sanitizer( $_POST[ $key ] ) );
		}

		// Titres sections
		$title_fields = [
			'orthosmile_services_title'       => 'sanitize_text_field',
			'orthosmile_services_subtitle'    => 'sanitize_text_field',
			'orthosmile_faq_title'            => 'sanitize_text_field',
			'orthosmile_faq_subtitle'         => 'sanitize_text_field',
			'orthosmile_testimonials_title'   => 'sanitize_text_field',
			'orthosmile_testimonials_subtitle'=> 'sanitize_text_field',
			'orthosmile_gallery_title'        => 'sanitize_text_field',
			'orthosmile_gallery_subtitle'     => 'sanitize_text_field',
		];
		foreach ( $title_fields as $key => $sanitizer ) {
			if ( isset( $_POST[ $key ] ) ) update_option( $key, $sanitizer( $_POST[ $key ] ) );
		}

		// Témoignages
		for ( $i = 1; $i <= 6; $i++ ) {
			if ( isset( $_POST["orthosmile_testimonial_{$i}_name"] ) )
				update_option( "orthosmile_testimonial_{$i}_name",      sanitize_text_field( $_POST["orthosmile_testimonial_{$i}_name"] ) );
			if ( isset( $_POST["orthosmile_testimonial_{$i}_text"] ) )
				update_option( "orthosmile_testimonial_{$i}_text",      sanitize_textarea_field( $_POST["orthosmile_testimonial_{$i}_text"] ) );
			if ( isset( $_POST["orthosmile_testimonial_{$i}_rating"] ) )
				update_option( "orthosmile_testimonial_{$i}_rating",    absint( $_POST["orthosmile_testimonial_{$i}_rating"] ) );
			if ( isset( $_POST["orthosmile_testimonial_{$i}_treatment"] ) )
				update_option( "orthosmile_testimonial_{$i}_treatment", sanitize_text_field( $_POST["orthosmile_testimonial_{$i}_treatment"] ) );
		}

		// CTA
		$cta_fields = [
			'orthosmile_cta_title'        => 'sanitize_text_field',
			'orthosmile_cta_subtitle'     => 'sanitize_textarea_field',
			'orthosmile_cta_btn_text'     => 'sanitize_text_field',
			'orthosmile_cta_contact_text' => 'sanitize_text_field',
		];
		foreach ( $cta_fields as $key => $sanitizer ) {
			if ( isset( $_POST[ $key ] ) ) update_option( $key, $sanitizer( $_POST[ $key ] ) );
		}

		// Galerie
		for ( $i = 1; $i <= 3; $i++ ) {
			if ( isset( $_POST["orthosmile_gallery_{$i}_before"] ) )
				update_option( "orthosmile_gallery_{$i}_before", esc_url_raw( $_POST["orthosmile_gallery_{$i}_before"] ) );
			if ( isset( $_POST["orthosmile_gallery_{$i}_after"] ) )
				update_option( "orthosmile_gallery_{$i}_after",  esc_url_raw( $_POST["orthosmile_gallery_{$i}_after"] ) );
			if ( isset( $_POST["orthosmile_gallery_{$i}_label"] ) )
				update_option( "orthosmile_gallery_{$i}_label",  sanitize_text_field( $_POST["orthosmile_gallery_{$i}_label"] ) );
		}

		// Footer
		$footer_fields = [
			'orthosmile_footer_description' => 'sanitize_textarea_field',
			'orthosmile_footer_legal'       => 'sanitize_text_field',
		];
		foreach ( $footer_fields as $key => $sanitizer ) {
			if ( isset( $_POST[ $key ] ) ) update_option( $key, $sanitizer( $_POST[ $key ] ) );
		}
	}

	/* ── Onglet Intégrations ── */
	if ( $tab === 'integrations' ) {
		$fields = [
			'orthosmile_appointment_url' => 'esc_url_raw',
			'orthosmile_ga_id'           => 'sanitize_text_field',
		];
		foreach ( $fields as $key => $sanitizer ) {
			if ( isset( $_POST[ $key ] ) ) update_option( $key, $sanitizer( $_POST[ $key ] ) );
		}

		// Google Maps — wp_kses_post strip les <iframe>, allowlist dédiée
		if ( isset( $_POST['orthosmile_contact_map_embed'] ) ) {
			$iframe_allowed = [
				'iframe' => [
					'src'             => true,
					'width'           => true,
					'height'          => true,
					'style'           => true,
					'allowfullscreen' => true,
					'loading'         => true,
					'referrerpolicy'  => true,
					'frameborder'     => true,
					'title'           => true,
				],
			];
			update_option( 'orthosmile_contact_map_embed', wp_kses( wp_unslash( $_POST['orthosmile_contact_map_embed'] ), $iframe_allowed ) );
		}
	}

	/* ── Onglet SEO ── */
	if ( $tab === 'seo' ) {
		$fields = [
			'orthosmile_meta_desc' => 'sanitize_textarea_field',
			'orthosmile_og_image'  => 'esc_url_raw',
		];
		foreach ( $fields as $key => $sanitizer ) {
			if ( isset( $_POST[ $key ] ) ) update_option( $key, $sanitizer( $_POST[ $key ] ) );
		}
	}

	add_settings_error( 'orthosmile_messages', 'orthosmile_saved', __( '✅ Paramètres sauvegardés.', 'orthosmile' ), 'updated' );
}
add_action( 'admin_init', 'orthosmile_save_options' );

/* =========================================================
   PAGE HTML
   ========================================================= */
function orthosmile_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) return;

	$active_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'general';
	settings_errors( 'orthosmile_messages' );
	?>
	<div class="wrap orthosmile-admin-wrap">
		<h1 style="display:flex;align-items:center;gap:10px">
			<span style="font-size:2rem">😊</span>
			<?php esc_html_e( 'OrthoSmile — Paramètres du thème', 'orthosmile' ); ?>
		</h1>

		<nav class="nav-tab-wrapper" style="margin-bottom:20px">
			<?php
			$tabs = [
				'general'      => '🏠 ' . __( 'Général', 'orthosmile' ),
				'content'      => '📝 ' . __( 'Contenu', 'orthosmile' ),
				'integrations' => '🔌 ' . __( 'Intégrations', 'orthosmile' ),
				'seo'          => '📈 ' . __( 'SEO & Footer', 'orthosmile' ),
			];
			foreach ( $tabs as $slug => $label ) {
				$class = ( $active_tab === $slug ) ? 'nav-tab nav-tab-active' : 'nav-tab';
				$url   = admin_url( 'admin.php?page=orthosmile-settings&tab=' . $slug );
				printf( '<a href="%s" class="%s">%s</a>', esc_url( $url ), esc_attr( $class ), esc_html( $label ) );
			}
			?>
		</nav>

		<form method="post">
			<?php wp_nonce_field( 'orthosmile_save_options', 'orthosmile_nonce' ); ?>
			<input type="hidden" name="orthosmile_tab" value="<?php echo esc_attr( $active_tab ); ?>" />

			<?php
			if ( $active_tab === 'general' )      orthosmile_tab_general();
			elseif ( $active_tab === 'content' )  orthosmile_tab_content();
			elseif ( $active_tab === 'integrations' ) orthosmile_tab_integrations();
			elseif ( $active_tab === 'seo' )      orthosmile_tab_seo();
			?>

			<?php submit_button( __( 'Enregistrer les paramètres', 'orthosmile' ), 'primary large', 'submit', true, [ 'style' => 'margin-top:20px' ] ); ?>
		</form>
	</div>
	<?php
}

/* =========================================================
   STYLES ADMIN PARTAGÉS
   ========================================================= */
function orthosmile_admin_card_styles() {
	?>
	<style>
	.orthosmile-admin-wrap .orthosmile-card{background:#fff;border:1px solid #ddd;border-radius:8px;padding:24px;margin-bottom:20px}
	.orthosmile-admin-wrap .orthosmile-card h2{margin-top:0;padding-bottom:10px;border-bottom:2px solid #007CBA;color:#1d2327}
	.orthosmile-admin-wrap .orthosmile-card table{width:100%}
	.orthosmile-admin-wrap .orthosmile-card th{width:220px;font-weight:600;color:#444}
	.orthosmile-notice-xxx{background:#fff8e1;border-left:4px solid #f0b429;padding:8px 12px;margin:0 0 16px;font-size:12px;color:#7a5c00;border-radius:0 4px 4px 0}
	.orthosmile-group{background:#f8f9fa;border:1px solid #e0e0e0;border-radius:6px;padding:14px;margin-bottom:10px}
	.orthosmile-group h4{margin:0 0 10px;color:#1d2327;font-size:13px;text-transform:uppercase;letter-spacing:.5px}
	</style>
	<?php
}

/* =========================================================
   ONGLET GÉNÉRAL
   ========================================================= */
function orthosmile_tab_general() {
	orthosmile_admin_card_styles();
	?>
	<div class="orthosmile-card">
		<div class="orthosmile-notice-xxx">💡 Les champs marqués <strong>XXXX</strong> sont des exemples à remplacer par vos vraies informations.</div>

		<h2><?php esc_html_e( '🏥 Cabinet', 'orthosmile' ); ?></h2>
		<table class="form-table">
			<tr>
				<th><?php esc_html_e( 'Nom du cabinet', 'orthosmile' ); ?></th>
				<td><input type="text" name="orthosmile_cabinet_name" value="<?php echo esc_attr( orthosmile_get_option( 'cabinet_name', 'XXXX - Nom du cabinet' ) ); ?>" class="large-text" /></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Slogan / Sous-titre', 'orthosmile' ); ?></th>
				<td><input type="text" name="orthosmile_cabinet_slogan" value="<?php echo esc_attr( orthosmile_get_option( 'cabinet_slogan', 'XXXX - Votre slogan' ) ); ?>" class="large-text" /></td>
			</tr>
		</table>
	</div>

	<div class="orthosmile-card">
		<h2><?php esc_html_e( '📞 Coordonnées', 'orthosmile' ); ?></h2>
		<table class="form-table">
			<tr>
				<th><?php esc_html_e( 'Téléphone', 'orthosmile' ); ?></th>
				<td><input type="tel" name="orthosmile_phone_number" value="<?php echo esc_attr( orthosmile_get_option( 'phone_number', 'XXXX' ) ); ?>" class="regular-text" placeholder="01 23 45 67 89" /></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Email', 'orthosmile' ); ?></th>
				<td><input type="email" name="orthosmile_contact_email" value="<?php echo esc_attr( orthosmile_get_option( 'contact_email', 'XXXX@XXXX.fr' ) ); ?>" class="regular-text" /></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Adresse', 'orthosmile' ); ?></th>
				<td><input type="text" name="orthosmile_contact_address" value="<?php echo esc_attr( orthosmile_get_option( 'contact_address', 'XXXX - Adresse du cabinet' ) ); ?>" class="large-text" /></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Horaires d\'ouverture', 'orthosmile' ); ?></th>
				<td>
					<input type="text" name="orthosmile_opening_hours" value="<?php echo esc_attr( orthosmile_get_option( 'opening_hours', 'XXXX - Lun-Ven 9h-19h' ) ); ?>" class="large-text" placeholder="Lun-Ven 9h-19h, Sam 9h-13h" />
					<p class="description"><?php esc_html_e( 'Affiché dans la barre info du header et la section Contact.', 'orthosmile' ); ?></p>
				</td>
			</tr>
		</table>
	</div>

	<div class="orthosmile-card">
		<h2><?php esc_html_e( '🖼️ Logo', 'orthosmile' ); ?></h2>
		<table class="form-table">
			<tr>
				<th><?php esc_html_e( 'URL du logo', 'orthosmile' ); ?></th>
				<td>
					<input type="url" name="orthosmile_logo_url" id="orthosmile-logo-url" value="<?php echo esc_attr( orthosmile_get_option( 'logo_url', '' ) ); ?>" class="large-text" placeholder="https://..." />
					<button type="button" class="button" id="orthosmile-logo-media"><?php esc_html_e( 'Choisir un logo', 'orthosmile' ); ?></button>
					<p class="description"><?php esc_html_e( 'Laissez vide pour utiliser le logo natif WordPress (Apparence → Personnaliser → Identité du site).', 'orthosmile' ); ?></p>
				</td>
			</tr>
		</table>
	</div>

	<div class="orthosmile-card">
		<h2><?php esc_html_e( '🎨 Couleur du thème', 'orthosmile' ); ?></h2>
		<table class="form-table">
			<tr>
				<th><?php esc_html_e( 'Couleur principale', 'orthosmile' ); ?></th>
				<td>
					<div style="display:flex;align-items:center;gap:10px;">
						<input type="color" id="os-color-primary-picker"
							value="<?php echo esc_attr( orthosmile_get_option( 'color_primary', '#0F766E' ) ?: '#0F766E' ); ?>"
							style="width:46px;height:36px;padding:2px;border:1px solid #ddd;border-radius:4px;cursor:pointer;">
						<input type="text" name="orthosmile_color_primary" id="os-color-primary-text"
							value="<?php echo esc_attr( orthosmile_get_option( 'color_primary', '' ) ); ?>"
							class="regular-text" placeholder="#0F766E" />
						<button type="button" class="button" id="os-color-reset"><?php esc_html_e( 'Réinitialiser', 'orthosmile' ); ?></button>
					</div>
					<p class="description"><?php esc_html_e( 'Laissez vide pour conserver les couleurs d\'origine du thème. Entrez un code hexadécimal (#RRGGBB) ou utilisez le sélecteur.', 'orthosmile' ); ?></p>
				</td>
			</tr>
		</table>
	</div>

	<div class="orthosmile-card">
		<h2><?php esc_html_e( '📱 Réseaux sociaux', 'orthosmile' ); ?></h2>
		<table class="form-table">
			<tr>
				<th><?php esc_html_e( 'Facebook URL', 'orthosmile' ); ?></th>
				<td><input type="url" name="orthosmile_facebook_url" value="<?php echo esc_attr( orthosmile_get_option( 'facebook_url', '' ) ); ?>" class="large-text" placeholder="https://facebook.com/votrecabinet" /></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Instagram URL', 'orthosmile' ); ?></th>
				<td><input type="url" name="orthosmile_instagram_url" value="<?php echo esc_attr( orthosmile_get_option( 'instagram_url', '' ) ); ?>" class="large-text" placeholder="https://instagram.com/votrecabinet" /></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'LinkedIn URL', 'orthosmile' ); ?></th>
				<td><input type="url" name="orthosmile_linkedin_url" value="<?php echo esc_attr( orthosmile_get_option( 'linkedin_url', '' ) ); ?>" class="large-text" placeholder="https://linkedin.com/company/votrecabinet" /></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'YouTube URL', 'orthosmile' ); ?></th>
				<td><input type="url" name="orthosmile_youtube_url" value="<?php echo esc_attr( orthosmile_get_option( 'youtube_url', '' ) ); ?>" class="large-text" placeholder="https://youtube.com/@votrecabinet" /></td>
			</tr>
		</table>
	</div>

	<script>
	jQuery(function($){
		function osMediaUpload(btnId, inputId){
			$('#' + btnId).on('click', function(){
				var frame = wp.media({ title: 'Sélectionner une image', button: { text: 'Utiliser cette image' }, multiple: false });
				frame.on('select', function(){
					$('#' + inputId).val( frame.state().get('selection').first().toJSON().url );
				});
				frame.open();
			});
		}
		osMediaUpload('orthosmile-logo-media',   'orthosmile-logo-url');

		// Sync couleur principale
		var picker = $('#os-color-primary-picker');
		var text   = $('#os-color-primary-text');
		picker.on('input change', function(){ text.val($(this).val()); });
		text.on('input change', function(){
			var v = $(this).val();
			if (/^#[0-9a-fA-F]{6}$/.test(v)) picker.val(v);
		});
		if (/^#[0-9a-fA-F]{6}$/.test(text.val())) picker.val(text.val());
		$('#os-color-reset').on('click', function(){
			text.val('');
			picker.val('#0F766E');
		});
	});
	</script>
	<?php
}

/* =========================================================
   ONGLET CONTENU
   ========================================================= */
function orthosmile_tab_content() {
	orthosmile_admin_card_styles();

	// Show/hide options actuelles
	$show = [];
	foreach ( ['about','stats','doctors','services','gallery','testimonials','faq','cta'] as $k ) {
		$val = get_option( 'orthosmile_show_' . $k, null );
		$show[$k] = ( $val !== null ) ? (bool) $val : true; // défaut : visible
	}
	?>

	<!-- ▸ Affichage des sections -->
	<div class="orthosmile-card">
		<h2><?php esc_html_e( '👁️ Affichage des sections', 'orthosmile' ); ?></h2>
		<p><?php esc_html_e( 'Cochez pour afficher une section sur la page d\'accueil.', 'orthosmile' ); ?></p>
		<table class="form-table">
			<?php
			$sections = [
				'about'        => __( 'Section À propos / Notre cabinet', 'orthosmile' ),
				'stats'        => __( 'Statistiques (compteurs)', 'orthosmile' ),
				'doctors'      => __( 'Équipe / Praticiens', 'orthosmile' ),
				'services'     => __( 'Traitements / Services', 'orthosmile' ),
				'gallery'      => __( 'Galerie Avant/Après', 'orthosmile' ),
				'testimonials' => __( 'Témoignages patients', 'orthosmile' ),
				'faq'          => __( 'FAQ', 'orthosmile' ),
				'cta'          => __( 'Section CTA (appel à l\'action)', 'orthosmile' ),
			];
			foreach ( $sections as $key => $label ) : ?>
				<tr>
					<th><?php echo esc_html( $label ); ?></th>
					<td>
						<label>
							<input type="checkbox" name="orthosmile_show_<?php echo esc_attr( $key ); ?>" value="1" <?php checked( $show[ $key ] ); ?> />
							<?php esc_html_e( 'Afficher', 'orthosmile' ); ?>
						</label>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>

	<!-- ▸ À propos -->
	<div class="orthosmile-card">
		<h2><?php esc_html_e( '📋 À propos / Notre cabinet', 'orthosmile' ); ?></h2>
		<table class="form-table">
			<tr>
				<th><?php esc_html_e( 'Titre de la section', 'orthosmile' ); ?></th>
				<td><input type="text" name="orthosmile_about_titre" value="<?php echo esc_attr( orthosmile_get_option( 'about_titre', 'Notre cabinet' ) ); ?>" class="large-text" /></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Sous-titre', 'orthosmile' ); ?></th>
				<td><input type="text" name="orthosmile_about_sous_titre" value="<?php echo esc_attr( orthosmile_get_option( 'about_sous_titre', '' ) ); ?>" class="large-text" /></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Texte de présentation', 'orthosmile' ); ?></th>
				<td>
					<textarea name="orthosmile_about_texte" rows="6" class="large-text"><?php echo esc_textarea( orthosmile_get_option( 'about_texte', '' ) ); ?></textarea>
					<p class="description"><?php esc_html_e( 'Histoire du cabinet, valeurs, approche, ce qui vous distingue.', 'orthosmile' ); ?></p>
				</td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Image (URL)', 'orthosmile' ); ?></th>
				<td>
					<input type="url" name="orthosmile_about_image" id="orthosmile-about-image" value="<?php echo esc_attr( orthosmile_get_option( 'about_image', '' ) ); ?>" class="large-text" placeholder="https://..." />
					<button type="button" class="button" id="orthosmile-about-media"><?php esc_html_e( 'Choisir une image', 'orthosmile' ); ?></button>
					<p class="description"><?php esc_html_e( 'Affichée à gauche du texte (layout 50/50). Laissez vide pour un texte pleine largeur.', 'orthosmile' ); ?></p>
				</td>
			</tr>
		</table>
	</div>

	<!-- ▸ Hero -->
	<div class="orthosmile-card">
		<h2><?php esc_html_e( '🦸 Section Héro', 'orthosmile' ); ?></h2>
		<table class="form-table">
			<tr>
				<th><?php esc_html_e( 'Titre principal', 'orthosmile' ); ?></th>
				<td><input type="text" name="orthosmile_hero_title" value="<?php echo esc_attr( orthosmile_get_option( 'hero_title', 'Votre sourire parfait commence ici' ) ); ?>" class="large-text" /></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Sous-titre', 'orthosmile' ); ?></th>
				<td><textarea name="orthosmile_hero_subtitle" rows="3" class="large-text"><?php echo esc_textarea( orthosmile_get_option( 'hero_subtitle', 'XXXX - Sous-titre de bienvenue' ) ); ?></textarea></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Texte bouton CTA principal', 'orthosmile' ); ?></th>
				<td><input type="text" name="orthosmile_hero_cta_text" value="<?php echo esc_attr( orthosmile_get_option( 'hero_cta_text', 'Prendre rendez-vous' ) ); ?>" class="regular-text" /></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'URL bouton CTA', 'orthosmile' ); ?></th>
				<td>
					<input type="text" name="orthosmile_hero_cta_url" value="<?php echo esc_attr( orthosmile_get_option( 'hero_cta_url', '' ) ); ?>" class="large-text" placeholder="" />
					<p class="description"><?php esc_html_e( 'Laissez vide pour utiliser l\'URL de prise de RDV (onglet Intégrations).', 'orthosmile' ); ?></p>
				</td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Texte bouton secondaire', 'orthosmile' ); ?></th>
				<td>
					<input type="text" name="orthosmile_hero_secondary_cta_text" value="<?php echo esc_attr( orthosmile_get_option( 'hero_secondary_cta_text', 'Voir nos traitements' ) ); ?>" class="regular-text" />
					<p class="description"><?php esc_html_e( 'Laissez vide pour masquer le bouton secondaire.', 'orthosmile' ); ?></p>
				</td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'URL bouton secondaire', 'orthosmile' ); ?></th>
				<td><input type="text" name="orthosmile_hero_secondary_cta_url" value="<?php echo esc_attr( orthosmile_get_option( 'hero_secondary_cta_url', '#services' ) ); ?>" class="regular-text" /></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Image héro (URL)', 'orthosmile' ); ?></th>
				<td>
					<input type="url" name="orthosmile_hero_image" id="orthosmile-hero-image" value="<?php echo esc_attr( orthosmile_get_option( 'hero_image', '' ) ); ?>" class="large-text" placeholder="https://..." />
					<button type="button" class="button" id="orthosmile-hero-media"><?php esc_html_e( 'Choisir une image', 'orthosmile' ); ?></button>
					<p class="description"><?php esc_html_e( 'Image portrait affichée à droite du texte.', 'orthosmile' ); ?></p>
				</td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Afficher l\'image héro', 'orthosmile' ); ?></th>
				<td>
					<label>
						<?php $show_hi = get_option( 'orthosmile_show_hero_image', null ); $show_hi = ( $show_hi !== null ) ? (bool)$show_hi : true; ?>
						<input type="checkbox" name="orthosmile_show_hero_image" value="1" <?php checked( $show_hi ); ?> />
						<?php esc_html_e( 'Cochez pour afficher l\'image à droite. Décochez pour un layout pleine largeur.', 'orthosmile' ); ?>
					</label>
				</td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Texte alternatif de l\'image', 'orthosmile' ); ?></th>
				<td><input type="text" name="orthosmile_hero_image_alt" value="<?php echo esc_attr( orthosmile_get_option( 'hero_image_alt', '' ) ); ?>" class="large-text" /></td>
			</tr>
		</table>

		<!-- Badges -->
		<?php
		$badge_defaults = [
			1 => [ 'text' => 'Spécialistes certifiés', 'icon' => 'workspace_premium' ],
			2 => [ 'text' => 'Invisalign Certified',   'icon' => 'visibility_off'    ],
			3 => [ 'text' => 'Pédiatrie & adultes',    'icon' => 'child_care'        ],
		];
		for ( $i = 1; $i <= 3; $i++ ) :
			$b_show = get_option( "orthosmile_hero_badge_{$i}_show", null );
			$b_show = ( $b_show !== null ) ? (bool)$b_show : true;
		?>
		<div class="orthosmile-group" style="margin-top:<?php echo $i === 1 ? '20' : '0'; ?>px">
			<h4><?php printf( esc_html__( 'Badge %d', 'orthosmile' ), $i ); ?></h4>
			<table class="form-table">
				<tr>
					<th style="width:160px"><?php esc_html_e( 'Afficher', 'orthosmile' ); ?></th>
					<td><label><input type="checkbox" name="orthosmile_hero_badge_<?php echo $i; ?>_show" value="1" <?php checked( $b_show ); ?> /> <?php esc_html_e( 'Visible', 'orthosmile' ); ?></label></td>
				</tr>
				<tr>
					<th><?php esc_html_e( 'Texte', 'orthosmile' ); ?></th>
					<td><input type="text" name="orthosmile_hero_badge_<?php echo $i; ?>_text" value="<?php echo esc_attr( orthosmile_get_option( "hero_badge_{$i}_text", $badge_defaults[$i]['text'] ) ); ?>" class="large-text" /></td>
				</tr>
				<tr>
					<th><?php esc_html_e( 'Icône Material Symbols', 'orthosmile' ); ?></th>
					<td>
						<input type="text" name="orthosmile_hero_badge_<?php echo $i; ?>_icon" value="<?php echo esc_attr( orthosmile_get_option( "hero_badge_{$i}_icon", $badge_defaults[$i]['icon'] ) ); ?>" class="regular-text" />
						<p class="description"><?php esc_html_e( 'Ex : workspace_premium, verified, star, favorite, child_care…', 'orthosmile' ); ?></p>
					</td>
				</tr>
			</table>
		</div>
		<?php endfor; ?>
	</div>

	<!-- ▸ Stats -->
	<div class="orthosmile-card">
		<h2><?php esc_html_e( '📊 Statistiques (compteurs)', 'orthosmile' ); ?></h2>
		<?php
		$stat_defaults = [
			1 => [ 'value' => 'XXXX', 'label' => 'XXXX - Légende stat 1', 'icon' => 'emoji_events' ],
			2 => [ 'value' => 'XXXX', 'label' => 'XXXX - Légende stat 2', 'icon' => 'groups'        ],
			3 => [ 'value' => 'XXXX', 'label' => 'XXXX - Légende stat 3', 'icon' => 'verified'      ],
			4 => [ 'value' => 'XXXX', 'label' => 'XXXX - Légende stat 4', 'icon' => 'star'          ],
		];
		for ( $i = 1; $i <= 4; $i++ ) : ?>
		<div class="orthosmile-group" style="margin-bottom:10px">
			<h4><?php printf( esc_html__( 'Stat %d', 'orthosmile' ), $i ); ?></h4>
			<table class="form-table">
				<tr>
					<th style="width:160px"><?php esc_html_e( 'Valeur', 'orthosmile' ); ?></th>
					<td><input type="text" name="orthosmile_stat_<?php echo $i; ?>_value" value="<?php echo esc_attr( orthosmile_get_option( "stat_{$i}_value", $stat_defaults[$i]['value'] ) ); ?>" class="regular-text" placeholder="1500+" /></td>
				</tr>
				<tr>
					<th><?php esc_html_e( 'Légende', 'orthosmile' ); ?></th>
					<td><input type="text" name="orthosmile_stat_<?php echo $i; ?>_label" value="<?php echo esc_attr( orthosmile_get_option( "stat_{$i}_label", $stat_defaults[$i]['label'] ) ); ?>" class="large-text" /></td>
				</tr>
				<tr>
					<th><?php esc_html_e( 'Icône Material', 'orthosmile' ); ?></th>
					<td>
						<input type="text" name="orthosmile_stat_<?php echo $i; ?>_icon" value="<?php echo esc_attr( orthosmile_get_option( "stat_{$i}_icon", $stat_defaults[$i]['icon'] ) ); ?>" class="regular-text" />
					</td>
				</tr>
			</table>
		</div>
		<?php endfor; ?>
	</div>

	<!-- ▸ Équipe -->
	<div class="orthosmile-card">
		<h2><?php esc_html_e( '👥 Équipe', 'orthosmile' ); ?></h2>
		<table class="form-table">
			<tr>
				<th><?php esc_html_e( 'Titre section équipe', 'orthosmile' ); ?></th>
				<td><input type="text" name="orthosmile_equipe_title" value="<?php echo esc_attr( orthosmile_get_option( 'equipe_title', 'Une équipe à votre écoute' ) ); ?>" class="large-text" /></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Sous-titre', 'orthosmile' ); ?></th>
				<td><textarea name="orthosmile_equipe_subtitle" rows="2" class="large-text"><?php echo esc_textarea( orthosmile_get_option( 'equipe_subtitle', 'XXXX - Présentation de votre équipe' ) ); ?></textarea></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Photo collective de l\'équipe (URL)', 'orthosmile' ); ?></th>
				<td>
					<input type="url" name="orthosmile_equipe_team_photo" id="orthosmile-equipe-photo" value="<?php echo esc_attr( orthosmile_get_option( 'equipe_team_photo', '' ) ); ?>" class="large-text" placeholder="https://..." />
					<button type="button" class="button" id="orthosmile-equipe-media"><?php esc_html_e( 'Choisir une image', 'orthosmile' ); ?></button>
					<p class="description"><?php esc_html_e( 'Bannière panoramique affichée au-dessus des cartes praticiens.', 'orthosmile' ); ?></p>
				</td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Label bouton RDV (praticiens)', 'orthosmile' ); ?></th>
				<td><input type="text" name="orthosmile_equipe_rdv_label" value="<?php echo esc_attr( orthosmile_get_option( 'equipe_rdv_label', 'Prendre rendez-vous' ) ); ?>" class="regular-text" /></td>
			</tr>
		</table>
	</div>

	<!-- ▸ Titres des sections -->
	<div class="orthosmile-card">
		<h2><?php esc_html_e( '✏️ Titres des sections', 'orthosmile' ); ?></h2>
		<table class="form-table">
			<tr><th colspan="2" style="font-size:13px;color:#666;font-style:italic"><?php esc_html_e( 'Traitements / Services', 'orthosmile' ); ?></th></tr>
			<tr>
				<th><?php esc_html_e( 'Titre', 'orthosmile' ); ?></th>
				<td><input type="text" name="orthosmile_services_title" value="<?php echo esc_attr( orthosmile_get_option( 'services_title', 'Nos traitements orthodontiques' ) ); ?>" class="large-text" /></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Sous-titre', 'orthosmile' ); ?></th>
				<td><input type="text" name="orthosmile_services_subtitle" value="<?php echo esc_attr( orthosmile_get_option( 'services_subtitle', 'Des solutions modernes adaptées à chaque profil' ) ); ?>" class="large-text" /></td>
			</tr>
			<tr><th colspan="2" style="font-size:13px;color:#666;font-style:italic;padding-top:20px"><?php esc_html_e( 'Témoignages', 'orthosmile' ); ?></th></tr>
			<tr>
				<th><?php esc_html_e( 'Titre', 'orthosmile' ); ?></th>
				<td><input type="text" name="orthosmile_testimonials_title" value="<?php echo esc_attr( orthosmile_get_option( 'testimonials_title', 'Ce que disent nos patients' ) ); ?>" class="large-text" /></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Sous-titre', 'orthosmile' ); ?></th>
				<td><input type="text" name="orthosmile_testimonials_subtitle" value="<?php echo esc_attr( orthosmile_get_option( 'testimonials_subtitle', 'Des centaines de familles nous font confiance' ) ); ?>" class="large-text" /></td>
			</tr>
			<tr><th colspan="2" style="font-size:13px;color:#666;font-style:italic;padding-top:20px"><?php esc_html_e( 'Galerie Avant/Après', 'orthosmile' ); ?></th></tr>
			<tr>
				<th><?php esc_html_e( 'Titre', 'orthosmile' ); ?></th>
				<td><input type="text" name="orthosmile_gallery_title" value="<?php echo esc_attr( orthosmile_get_option( 'gallery_title', 'Nos résultats' ) ); ?>" class="large-text" /></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Sous-titre', 'orthosmile' ); ?></th>
				<td><input type="text" name="orthosmile_gallery_subtitle" value="<?php echo esc_attr( orthosmile_get_option( 'gallery_subtitle', 'Des transformations réelles, des sourires rayonnants' ) ); ?>" class="large-text" /></td>
			</tr>
			<tr><th colspan="2" style="font-size:13px;color:#666;font-style:italic;padding-top:20px"><?php esc_html_e( 'FAQ', 'orthosmile' ); ?></th></tr>
			<tr>
				<th><?php esc_html_e( 'Titre', 'orthosmile' ); ?></th>
				<td><input type="text" name="orthosmile_faq_title" value="<?php echo esc_attr( orthosmile_get_option( 'faq_title', 'Questions fréquentes' ) ); ?>" class="large-text" /></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Sous-titre', 'orthosmile' ); ?></th>
				<td><input type="text" name="orthosmile_faq_subtitle" value="<?php echo esc_attr( orthosmile_get_option( 'faq_subtitle', "Tout ce que vous souhaitez savoir sur l'orthodontie" ) ); ?>" class="large-text" /></td>
			</tr>
		</table>
	</div>

	<!-- ▸ Témoignages -->
	<div class="orthosmile-card">
		<h2><?php esc_html_e( '⭐ Témoignages patients', 'orthosmile' ); ?></h2>
		<?php for ( $i = 1; $i <= 6; $i++ ) : ?>
		<div class="orthosmile-group" style="margin-bottom:10px">
			<h4><?php printf( esc_html__( 'Témoignage %d', 'orthosmile' ), $i ); ?></h4>
			<table class="form-table">
				<tr>
					<th style="width:160px"><?php esc_html_e( 'Prénom Nom', 'orthosmile' ); ?></th>
					<td><input type="text" name="orthosmile_testimonial_<?php echo $i; ?>_name" value="<?php echo esc_attr( orthosmile_get_option( "testimonial_{$i}_name", '' ) ); ?>" class="large-text" /></td>
				</tr>
				<tr>
					<th><?php esc_html_e( 'Texte', 'orthosmile' ); ?></th>
					<td><textarea name="orthosmile_testimonial_<?php echo $i; ?>_text" rows="3" class="large-text"><?php echo esc_textarea( orthosmile_get_option( "testimonial_{$i}_text", '' ) ); ?></textarea></td>
				</tr>
				<tr>
					<th><?php esc_html_e( 'Note /5', 'orthosmile' ); ?></th>
					<td>
						<select name="orthosmile_testimonial_<?php echo $i; ?>_rating">
							<?php for ( $n = 5; $n >= 1; $n-- ) : ?>
								<option value="<?php echo $n; ?>" <?php selected( (int) orthosmile_get_option( "testimonial_{$i}_rating", 5 ), $n ); ?>><?php echo $n; ?> ★</option>
							<?php endfor; ?>
						</select>
					</td>
				</tr>
				<tr>
					<th><?php esc_html_e( 'Traitement', 'orthosmile' ); ?></th>
					<td><input type="text" name="orthosmile_testimonial_<?php echo $i; ?>_treatment" value="<?php echo esc_attr( orthosmile_get_option( "testimonial_{$i}_treatment", '' ) ); ?>" class="large-text" placeholder="Invisalign, Bagues, Contention…" /></td>
				</tr>
			</table>
		</div>
		<?php endfor; ?>
	</div>

	<!-- ▸ CTA -->
	<div class="orthosmile-card">
		<h2><?php esc_html_e( '🎯 Section CTA', 'orthosmile' ); ?></h2>
		<table class="form-table">
			<tr>
				<th><?php esc_html_e( 'Titre', 'orthosmile' ); ?></th>
				<td><input type="text" name="orthosmile_cta_title" value="<?php echo esc_attr( orthosmile_get_option( 'cta_title', 'Prêt à transformer votre sourire ?' ) ); ?>" class="large-text" /></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Sous-titre', 'orthosmile' ); ?></th>
				<td><textarea name="orthosmile_cta_subtitle" rows="2" class="large-text"><?php echo esc_textarea( orthosmile_get_option( 'cta_subtitle', 'Consultez nos spécialistes et bénéficiez d\'un bilan orthodontique offert.' ) ); ?></textarea></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Texte bouton RDV', 'orthosmile' ); ?></th>
				<td><input type="text" name="orthosmile_cta_btn_text" value="<?php echo esc_attr( orthosmile_get_option( 'cta_btn_text', 'Prendre rendez-vous' ) ); ?>" class="regular-text" /></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Texte bouton contact', 'orthosmile' ); ?></th>
				<td><input type="text" name="orthosmile_cta_contact_text" value="<?php echo esc_attr( orthosmile_get_option( 'cta_contact_text', 'Nous contacter' ) ); ?>" class="regular-text" /></td>
			</tr>
		</table>
	</div>

	<!-- ▸ Galerie Avant/Après -->
	<div class="orthosmile-card">
		<h2><?php esc_html_e( '🖼️ Galerie Avant/Après', 'orthosmile' ); ?></h2>
		<p><?php esc_html_e( 'Configurez 1 à 3 paires d\'images. Les paires sans images sont ignorées.', 'orthosmile' ); ?></p>
		<?php for ( $i = 1; $i <= 3; $i++ ) : ?>
		<div class="orthosmile-group" style="margin-bottom:10px">
			<h4><?php printf( esc_html__( 'Cas clinique %d', 'orthosmile' ), $i ); ?></h4>
			<table class="form-table">
				<tr>
					<th style="width:160px"><?php esc_html_e( 'Image AVANT (URL)', 'orthosmile' ); ?></th>
					<td>
						<input type="url" name="orthosmile_gallery_<?php echo $i; ?>_before" id="orthosmile-gallery-<?php echo $i; ?>-before" value="<?php echo esc_attr( orthosmile_get_option( "gallery_{$i}_before", '' ) ); ?>" class="large-text" placeholder="https://..." />
						<button type="button" class="button orthosmile-gallery-media" data-target="orthosmile-gallery-<?php echo $i; ?>-before"><?php esc_html_e( 'Choisir', 'orthosmile' ); ?></button>
					</td>
				</tr>
				<tr>
					<th><?php esc_html_e( 'Image APRÈS (URL)', 'orthosmile' ); ?></th>
					<td>
						<input type="url" name="orthosmile_gallery_<?php echo $i; ?>_after" id="orthosmile-gallery-<?php echo $i; ?>-after" value="<?php echo esc_attr( orthosmile_get_option( "gallery_{$i}_after", '' ) ); ?>" class="large-text" placeholder="https://..." />
						<button type="button" class="button orthosmile-gallery-media" data-target="orthosmile-gallery-<?php echo $i; ?>-after"><?php esc_html_e( 'Choisir', 'orthosmile' ); ?></button>
					</td>
				</tr>
				<tr>
					<th><?php esc_html_e( 'Légende', 'orthosmile' ); ?></th>
					<td><input type="text" name="orthosmile_gallery_<?php echo $i; ?>_label" value="<?php echo esc_attr( orthosmile_get_option( "gallery_{$i}_label", "XXXX - Cas clinique {$i}" ) ); ?>" class="large-text" /></td>
				</tr>
			</table>
		</div>
		<?php endfor; ?>
	</div>

	<!-- ▸ Footer -->
	<div class="orthosmile-card">
		<h2><?php esc_html_e( '🔻 Footer', 'orthosmile' ); ?></h2>
		<table class="form-table">
			<tr>
				<th><?php esc_html_e( 'Description cabinet (footer)', 'orthosmile' ); ?></th>
				<td><textarea name="orthosmile_footer_description" rows="3" class="large-text"><?php echo esc_textarea( orthosmile_get_option( 'footer_description', 'XXXX - Description courte du cabinet pour le footer.' ) ); ?></textarea></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Texte légal (RPPS, mentions)', 'orthosmile' ); ?></th>
				<td>
					<input type="text" name="orthosmile_footer_legal" value="<?php echo esc_attr( orthosmile_get_option( 'footer_legal', '' ) ); ?>" class="large-text" placeholder="N° RPPS : XXXXXXXXX" />
				</td>
			</tr>
		</table>
	</div>

	<script>
	jQuery(function($){
		function osMediaUpload(btnId, inputId){
			$('#' + btnId).on('click', function(){
				var frame = wp.media({ title: 'Sélectionner une image', button: { text: 'Utiliser cette image' }, multiple: false });
				frame.on('select', function(){
					$('#' + inputId).val( frame.state().get('selection').first().toJSON().url );
				});
				frame.open();
			});
		}
		osMediaUpload('orthosmile-hero-media',   'orthosmile-hero-image');
		osMediaUpload('orthosmile-about-media',  'orthosmile-about-image');
		osMediaUpload('orthosmile-equipe-media',  'orthosmile-equipe-photo');

		// Galerie — boutons génériques via data-target
		$('.orthosmile-gallery-media').on('click', function(){
			var targetId = $(this).data('target');
			var frame = wp.media({ title: 'Sélectionner une image', button: { text: 'Utiliser cette image' }, multiple: false });
			frame.on('select', function(){
				$('#' + targetId).val( frame.state().get('selection').first().toJSON().url );
			});
			frame.open();
		});
	});
	</script>
	<?php
}

/* =========================================================
   ONGLET INTÉGRATIONS
   ========================================================= */
function orthosmile_tab_integrations() {
	orthosmile_admin_card_styles();
	?>
	<div class="orthosmile-card">
		<div class="orthosmile-notice-xxx">💡 <?php esc_html_e( 'Ces intégrations sont toutes facultatives. Laissez un champ vide pour désactiver la fonctionnalité.', 'orthosmile' ); ?></div>

		<h2><?php esc_html_e( '📅 Prise de RDV en ligne', 'orthosmile' ); ?></h2>
		<p><?php esc_html_e( 'Configurez l\'URL vers votre outil de prise de rendez-vous (Doctolib, Calendly, etc.). Ce lien est utilisé par le bouton « Prendre rendez-vous » dans tout le thème.', 'orthosmile' ); ?></p>
		<table class="form-table">
			<tr>
				<th><?php esc_html_e( 'URL de prise de RDV', 'orthosmile' ); ?></th>
				<td>
					<input type="url" name="orthosmile_appointment_url" value="<?php echo esc_attr( orthosmile_get_option( 'appointment_url', '' ) ); ?>" class="large-text" placeholder="https://www.doctolib.fr/orthodontiste/..." />
					<p class="description"><?php esc_html_e( 'Laissez vide pour pointer automatiquement vers la page /contact.', 'orthosmile' ); ?></p>
				</td>
			</tr>
		</table>
	</div>

	<div class="orthosmile-card">
		<h2><?php esc_html_e( '🗺️ Google Maps — Carte interactive', 'orthosmile' ); ?></h2>
		<p><?php esc_html_e( 'Affichez une carte Google Maps sur la page Contact. Comment copier le code d\'intégration :', 'orthosmile' ); ?></p>
		<ol style="margin-left:1.5rem;line-height:2">
			<li><?php esc_html_e( 'Ouvrez maps.google.com et recherchez l\'adresse de votre cabinet.', 'orthosmile' ); ?></li>
			<li><?php esc_html_e( 'Cliquez sur « Partager » → onglet « Intégrer une carte ».', 'orthosmile' ); ?></li>
			<li><?php esc_html_e( 'Copiez le code HTML (balise &lt;iframe&gt;).', 'orthosmile' ); ?></li>
			<li><?php esc_html_e( 'Collez-le dans le champ ci-dessous et enregistrez.', 'orthosmile' ); ?></li>
		</ol>
		<table class="form-table">
			<tr>
				<th><?php esc_html_e( 'Code embed iframe', 'orthosmile' ); ?></th>
				<td>
					<textarea name="orthosmile_contact_map_embed" rows="5" class="large-text" placeholder='&lt;iframe src="https://www.google.com/maps/embed?pb=..." ...&gt;&lt;/iframe&gt;'><?php echo esc_textarea( orthosmile_get_option( 'contact_map_embed', '' ) ); ?></textarea>
					<p class="description"><?php esc_html_e( 'Collez ici le code &lt;iframe&gt; copié depuis Google Maps.', 'orthosmile' ); ?></p>
				</td>
			</tr>
		</table>
	</div>

	<div class="orthosmile-card">
		<h2><?php esc_html_e( '📊 Google Analytics 4 (GA4)', 'orthosmile' ); ?></h2>
		<p><?php esc_html_e( 'Suivez le trafic de votre site. Le code de suivi est injecté automatiquement dans toutes les pages.', 'orthosmile' ); ?></p>
		<p><?php esc_html_e( 'Comment obtenir votre Measurement ID : analytics.google.com → Admin → Flux de données → votre site → copiez l\'ID (format G-XXXXXXXXXX).', 'orthosmile' ); ?></p>
		<table class="form-table">
			<tr>
				<th><?php esc_html_e( 'GA4 Measurement ID', 'orthosmile' ); ?></th>
				<td>
					<input type="text" name="orthosmile_ga_id" value="<?php echo esc_attr( get_option( 'orthosmile_ga_id', '' ) ); ?>" placeholder="G-XXXXXXXXXX" class="regular-text" />
					<p class="description"><?php esc_html_e( 'Format : G-XXXXXXXXXX. Laissez vide pour désactiver le suivi.', 'orthosmile' ); ?></p>
				</td>
			</tr>
		</table>
	</div>
	<?php
}

/* =========================================================
   ONGLET SEO & FOOTER
   ========================================================= */
function orthosmile_tab_seo() {
	orthosmile_admin_card_styles();
	?>
	<div class="orthosmile-card">
		<h2><?php esc_html_e( '🔍 Meta SEO', 'orthosmile' ); ?></h2>
		<table class="form-table">
			<tr>
				<th><?php esc_html_e( 'Meta description homepage', 'orthosmile' ); ?></th>
				<td>
					<textarea name="orthosmile_meta_desc" rows="3" class="large-text"><?php echo esc_textarea( get_option( 'orthosmile_meta_desc', '' ) ); ?></textarea>
					<p class="description"><?php esc_html_e( '160 caractères max. Décrivez votre cabinet en une phrase pour les moteurs de recherche.', 'orthosmile' ); ?></p>
				</td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Image Open Graph', 'orthosmile' ); ?></th>
				<td>
					<input type="url" name="orthosmile_og_image" id="orthosmile-og-image" value="<?php echo esc_attr( get_option( 'orthosmile_og_image', '' ) ); ?>" class="large-text" placeholder="https://..." />
					<button type="button" class="button" id="orthosmile-og-media"><?php esc_html_e( 'Choisir une image', 'orthosmile' ); ?></button>
					<p class="description"><?php esc_html_e( 'Image affichée lors du partage sur les réseaux sociaux. Recommandé : 1200×630 px.', 'orthosmile' ); ?></p>
				</td>
			</tr>
		</table>
	</div>

	<script>
	jQuery(function($){
		$('#orthosmile-og-media').on('click', function(){
			var frame = wp.media({ title: 'Sélectionner une image', button: { text: 'Utiliser cette image' }, multiple: false });
			frame.on('select', function(){
				$('#orthosmile-og-image').val( frame.state().get('selection').first().toJSON().url );
			});
			frame.open();
		});
	});
	</script>
	<?php
}
