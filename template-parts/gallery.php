<?php
/**
 * Template part: Avant/Après gallery section.
 *
 * @package OrthoSmile
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! orthosmile_get_option( 'show_gallery', '1' ) ) return;

$section_title    = orthosmile_get_option( 'gallery_title',    __( 'Nos résultats', 'orthosmile' ) );
$section_subtitle = orthosmile_get_option( 'gallery_subtitle', __( 'Des transformations réelles, des sourires rayonnants', 'orthosmile' ) );

$gallery = [];
for ( $i = 1; $i <= 3; $i++ ) {
	$gallery[] = [
		'before' => orthosmile_get_option( "gallery_{$i}_before", '' ),
		'after'  => orthosmile_get_option( "gallery_{$i}_after",  '' ),
		'label'  => orthosmile_get_option( "gallery_{$i}_label",  '' ),
	];
}

// Vérifier si au moins une paire a une image
$has_content = false;
foreach ( $gallery as $g ) {
	if ( $g['before'] || $g['after'] ) { $has_content = true; break; }
}

// Section masquée pour les visiteurs si aucun contenu
if ( ! $has_content && ! current_user_can( 'manage_options' ) ) return;
?>

<section class="gallery-section" id="gallery" aria-label="<?php esc_attr_e( 'Galerie avant/après', 'orthosmile' ); ?>">
	<div class="container">

		<div class="section-header">
			<span class="section-eyebrow">
				<span class="material-symbols-outlined" aria-hidden="true">auto_awesome</span>
				<?php esc_html_e( 'Avant / Après', 'orthosmile' ); ?>
			</span>
			<h2 class="section-title"><?php echo esc_html( $section_title ); ?></h2>
			<p class="section-subtitle"><?php echo esc_html( $section_subtitle ); ?></p>
		</div>

		<?php if ( $has_content ) : ?>
		<div class="gallery-grid">
			<?php foreach ( $gallery as $index => $item ) : ?>
			<?php if ( ! $item['before'] && ! $item['after'] ) continue; ?>
			<div class="before-after-wrap fade-in-up">
				<div class="before-after-stage" data-index="<?php echo esc_attr( $index ); ?>">

					<!-- Before image -->
					<div class="before-after-base">
						<?php if ( $item['before'] ) : ?>
							<img src="<?php echo esc_url( $item['before'] ); ?>"
							     alt="<?php esc_attr_e( 'Avant traitement', 'orthosmile' ); ?>"
							     loading="lazy">
						<?php else : ?>
							<div class="before-after-placeholder">
								<span class="material-symbols-outlined">image</span>
								<?php esc_html_e( 'Avant', 'orthosmile' ); ?>
							</div>
						<?php endif; ?>
						<span class="ba-tag ba-tag--before"><?php esc_html_e( 'Avant', 'orthosmile' ); ?></span>
					</div>

					<!-- After overlay (clip-path reveal) -->
					<div class="before-after-overlay">
						<?php if ( $item['after'] ) : ?>
							<img src="<?php echo esc_url( $item['after'] ); ?>"
							     alt="<?php esc_attr_e( 'Après traitement', 'orthosmile' ); ?>"
							     loading="lazy">
						<?php else : ?>
							<div class="before-after-placeholder">
								<span class="material-symbols-outlined">image</span>
								<?php esc_html_e( 'Après', 'orthosmile' ); ?>
							</div>
						<?php endif; ?>
						<span class="ba-tag ba-tag--after"><?php esc_html_e( 'Après', 'orthosmile' ); ?></span>
					</div>

					<!-- Divider handle -->
					<div class="before-after-divider">
						<button class="before-after-handle" aria-label="<?php esc_attr_e( 'Glisser pour comparer', 'orthosmile' ); ?>">
							<span class="material-symbols-outlined" aria-hidden="true">swap_horiz</span>
						</button>
					</div>

				</div>
				<?php if ( $item['label'] ) : ?>
				<p class="ba-label"><?php echo esc_html( $item['label'] ); ?></p>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
		</div>

		<?php else : ?>
		<div class="orthosmile-empty-notice">
			<span class="material-symbols-outlined" aria-hidden="true">info</span>
			<p>
				<?php esc_html_e( 'Aucune photo avant/après configurée.', 'orthosmile' ); ?>
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=orthosmile-settings&tab=content' ) ); ?>">
					<?php esc_html_e( 'Ajouter des photos →', 'orthosmile' ); ?>
				</a>
			</p>
		</div>
		<?php endif; ?>

	</div>
</section>
