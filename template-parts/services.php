<?php
/**
 * Template part: Services / Traitements section.
 *
 * @package OrthoSmile
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! orthosmile_get_option( 'show_services', '1' ) ) return;

$section_title    = orthosmile_get_option( 'services_title',    __( 'Nos traitements orthodontiques', 'orthosmile' ) );
$section_subtitle = orthosmile_get_option( 'services_subtitle', __( 'Des solutions modernes adaptées à chaque profil', 'orthosmile' ) );

$traitements = new WP_Query( [
	'post_type'      => 'traitement',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
	'post_status'    => 'publish',
] );

$has_posts = $traitements->have_posts();

// Section masquée pour les visiteurs si aucun contenu
if ( ! $has_posts && ! current_user_can( 'manage_options' ) ) return;
?>

<section class="services-section" id="services" aria-label="<?php esc_attr_e( 'Nos traitements', 'orthosmile' ); ?>">
	<div class="container">

		<div class="section-header">
			<span class="section-eyebrow">
				<span class="material-symbols-outlined" aria-hidden="true">dentistry</span>
				<?php esc_html_e( 'Nos solutions', 'orthosmile' ); ?>
			</span>
			<h2 class="section-title"><?php echo esc_html( $section_title ); ?></h2>
			<p class="section-subtitle"><?php echo esc_html( $section_subtitle ); ?></p>
		</div>

		<?php if ( $has_posts ) : ?>
		<div class="services-grid">
			<?php while ( $traitements->have_posts() ) : $traitements->the_post(); ?>
			<?php
			$post_id          = get_the_ID();
			$icon             = get_post_meta( $post_id, '_traitement_icone', true ) ?: 'dentistry';
			$badge            = get_post_meta( $post_id, '_traitement_badge', true );
			$prix             = get_post_meta( $post_id, '_traitement_prix', true );
			$desc_raw         = get_post_meta( $post_id, '_traitement_description', true );
			$description_html = $desc_raw
				? wp_kses_post( wpautop( $desc_raw ) )
				: wp_kses_post( apply_filters( 'the_content', get_the_content() ) );
			?>
			<article class="service-card fade-in-up">
				<div class="service-card-inner">
					<div class="service-icon-wrap">
						<span class="material-symbols-outlined service-icon" aria-hidden="true"><?php echo esc_html( $icon ); ?></span>
					</div>
					<?php if ( $badge ) : ?>
						<span class="service-badge"><?php echo esc_html( $badge ); ?></span>
					<?php endif; ?>
					<h3 class="service-title"><?php the_title(); ?></h3>
					<?php if ( $description_html ) : ?>
						<div class="service-description"><?php echo $description_html; ?></div>
					<?php endif; ?>
					<?php if ( $prix ) : ?>
						<div class="service-price">
							<span class="material-symbols-outlined" aria-hidden="true">payments</span>
							<span><?php echo esc_html( $prix ); ?></span>
						</div>
					<?php endif; ?>
					<a href="<?php echo esc_url( orthosmile_get_appointment_url() ); ?>" class="service-cta">
						<?php esc_html_e( 'Prendre rendez-vous', 'orthosmile' ); ?>
						<span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
					</a>
				</div>
				<?php if ( has_post_thumbnail() ) : ?>
				<div class="service-image-wrap">
					<?php the_post_thumbnail( 'gallery-thumb', [ 'class' => 'service-image', 'loading' => 'lazy' ] ); ?>
				</div>
				<?php endif; ?>
			</article>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>

		<?php else : ?>
		<div class="orthosmile-empty-notice">
			<span class="material-symbols-outlined" aria-hidden="true">info</span>
			<p>
				<?php esc_html_e( 'Aucun traitement publié.', 'orthosmile' ); ?>
				<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=traitement' ) ); ?>">
					<?php esc_html_e( 'Ajouter des traitements →', 'orthosmile' ); ?>
				</a>
			</p>
		</div>
		<?php endif; ?>

	</div>
</section>
