<?php
/**
 * Template part: Testimonials section.
 *
 * @package OrthoSmile
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! orthosmile_get_option( 'show_testimonials', '1' ) ) return;

$section_title    = orthosmile_get_option( 'testimonials_title',    __( 'Ce que disent nos patients', 'orthosmile' ) );
$section_subtitle = orthosmile_get_option( 'testimonials_subtitle', __( 'Des centaines de familles nous font confiance', 'orthosmile' ) );

// Up to 6 testimonials from admin options
$testimonials = [];
for ( $i = 1; $i <= 6; $i++ ) {
	$name   = orthosmile_get_option( 'testimonial_' . $i . '_name', '' );
	$text   = orthosmile_get_option( 'testimonial_' . $i . '_text', '' );
	$rating = (int) orthosmile_get_option( 'testimonial_' . $i . '_rating', 5 );
	$treat  = orthosmile_get_option( 'testimonial_' . $i . '_treatment', '' );
	if ( $name || $text ) {
		$testimonials[] = compact( 'name', 'text', 'rating', 'treat' );
	}
}

// Section masquée pour les visiteurs si aucun témoignage configuré
if ( empty( $testimonials ) && ! current_user_can( 'manage_options' ) ) return;
?>

<section class="testimonials-section" id="testimonials" aria-label="<?php esc_attr_e( 'Témoignages patients', 'orthosmile' ); ?>">
	<div class="container">

		<div class="section-header">
			<span class="section-eyebrow">
				<span class="material-symbols-outlined" aria-hidden="true">format_quote</span>
				<?php esc_html_e( 'Témoignages', 'orthosmile' ); ?>
			</span>
			<h2 class="section-title"><?php echo esc_html( $section_title ); ?></h2>
			<p class="section-subtitle"><?php echo esc_html( $section_subtitle ); ?></p>
		</div>

		<?php if ( ! empty( $testimonials ) ) : ?>
		<div class="testimonials-grid">
			<?php foreach ( $testimonials as $testimonial ) : ?>
			<div class="testimonial-card fade-in-up">
				<div class="testimonial-stars" aria-label="<?php echo esc_attr( $testimonial['rating'] ); ?>/5 étoiles">
					<?php for ( $s = 0; $s < 5; $s++ ) : ?>
						<span class="material-symbols-outlined <?php echo $s < $testimonial['rating'] ? 'filled' : 'empty'; ?>" aria-hidden="true">star</span>
					<?php endfor; ?>
				</div>
				<blockquote class="testimonial-quote">
					<p><?php echo esc_html( $testimonial['text'] ); ?></p>
				</blockquote>
				<footer class="testimonial-footer">
					<div class="testimonial-avatar" aria-hidden="true">
						<span class="material-symbols-outlined">person</span>
					</div>
					<div class="testimonial-author">
						<span class="testimonial-name"><?php echo esc_html( $testimonial['name'] ); ?></span>
						<?php if ( $testimonial['treat'] ) : ?>
							<span class="testimonial-treat"><?php echo esc_html( $testimonial['treat'] ); ?></span>
						<?php endif; ?>
					</div>
				</footer>
			</div>
			<?php endforeach; ?>
		</div>

		<?php else : ?>
		<div class="orthosmile-empty-notice">
			<span class="material-symbols-outlined" aria-hidden="true">info</span>
			<p>
				<?php esc_html_e( 'Aucun témoignage configuré.', 'orthosmile' ); ?>
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=orthosmile-settings&tab=content' ) ); ?>">
					<?php esc_html_e( 'Ajouter des témoignages →', 'orthosmile' ); ?>
				</a>
			</p>
		</div>
		<?php endif; ?>

	</div>
</section>
