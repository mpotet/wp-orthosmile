<?php
/**
 * OrthoSmile — template-parts/about-section.php
 *
 * Section "À propos / Notre cabinet" : image + texte côte à côte.
 * Activée/désactivée via l'option orthosmile_show_about.
 *
 * @package OrthoSmile
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! orthosmile_get_option( 'show_about', '1' ) ) return;

$titre      = orthosmile_get_option( 'about_titre',      __( 'Notre cabinet', 'orthosmile' ) );
$sous_titre = orthosmile_get_option( 'about_sous_titre', '' );
$texte      = orthosmile_get_option( 'about_texte',      'XXXX' );
$image_url  = orthosmile_get_option( 'about_image',      '' );

// Pas de contenu configuré + visiteur → masquer la section
if (
	str_starts_with( $texte, 'XXXX' ) &&
	! $image_url &&
	! current_user_can( 'manage_options' )
) return;
?>

<section id="about" class="about-section" aria-label="<?php esc_attr_e( 'À propos du cabinet', 'orthosmile' ); ?>">
	<div class="container">

		<div class="section-header">
			<span class="section-eyebrow">
				<span class="material-symbols-outlined" aria-hidden="true">info</span>
				<?php esc_html_e( 'Notre cabinet', 'orthosmile' ); ?>
			</span>
			<h2 class="section-title"><?php echo esc_html( $titre ); ?></h2>
			<?php if ( $sous_titre ) : ?>
				<p class="section-subtitle"><?php echo esc_html( $sous_titre ); ?></p>
			<?php endif; ?>
		</div>

		<div class="about-inner <?php echo $image_url ? 'about-has-image' : 'about-no-image'; ?>">

			<?php if ( $image_url ) : ?>
			<div class="about-image-wrap">
				<img
					src="<?php echo esc_url( $image_url ); ?>"
					alt="<?php echo esc_attr( orthosmile_get_option( 'cabinet_name', get_bloginfo( 'name' ) ) ); ?>"
					class="about-image"
					loading="lazy"
				/>
			</div>
			<?php endif; ?>

			<div class="about-body">

				<?php if ( $texte ) : ?>
				<div class="about-text">
					<?php echo nl2br( esc_html( $texte ) ); ?>
				</div>
				<?php endif; ?>

				<?php if ( current_user_can( 'manage_options' ) && ( ! $texte || str_starts_with( $texte, 'XXXX' ) ) ) : ?>
				<div class="orthosmile-empty-notice">
					<span class="material-symbols-outlined" aria-hidden="true">info</span>
					<p>
						<?php esc_html_e( 'Section À propos non configurée.', 'orthosmile' ); ?>
						<a href="<?php echo esc_url( admin_url( 'admin.php?page=orthosmile-settings&tab=content' ) ); ?>">
							<?php esc_html_e( 'Configurer →', 'orthosmile' ); ?>
						</a>
					</p>
				</div>
				<?php endif; ?>

			</div>

		</div>

	</div>
</section>
