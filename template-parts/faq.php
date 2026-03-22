<?php
/**
 * Template part: FAQ accordion section.
 *
 * @package OrthoSmile
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! orthosmile_get_option( 'show_faq', '1' ) ) return;

$section_title    = orthosmile_get_option( 'faq_title',    __( 'Questions fréquentes', 'orthosmile' ) );
$section_subtitle = orthosmile_get_option( 'faq_subtitle', __( 'Tout ce que vous souhaitez savoir sur l\'orthodontie', 'orthosmile' ) );

$faqs = new WP_Query( [
	'post_type'      => 'faq_item',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
	'post_status'    => 'publish',
] );

$has_posts = $faqs->have_posts();

// Section masquée pour les visiteurs si aucun contenu
if ( ! $has_posts && ! current_user_can( 'manage_options' ) ) return;
?>

<section class="faq-section" id="faq" aria-label="<?php esc_attr_e( 'Questions fréquentes', 'orthosmile' ); ?>">
	<div class="container">

		<div class="section-header">
			<span class="section-eyebrow">
				<span class="material-symbols-outlined" aria-hidden="true">help</span>
				FAQ
			</span>
			<h2 class="section-title"><?php echo esc_html( $section_title ); ?></h2>
			<p class="section-subtitle"><?php echo esc_html( $section_subtitle ); ?></p>
		</div>

		<?php if ( $has_posts ) : ?>
		<div class="faq-list" role="list">
			<?php $faq_index = 0; ?>
			<?php while ( $faqs->have_posts() ) : $faqs->the_post(); ?>
			<?php
			$answer   = get_the_content();
			$item_id  = 'faq-item-'  . get_the_ID();
			$panel_id = 'faq-panel-' . get_the_ID();
			?>
			<div class="faq-item<?php echo $faq_index === 0 ? ' is-open' : ''; ?>" role="listitem" id="<?php echo esc_attr( $item_id ); ?>">
				<button class="faq-question"
				        aria-expanded="<?php echo $faq_index === 0 ? 'true' : 'false'; ?>"
				        aria-controls="<?php echo esc_attr( $panel_id ); ?>">
					<span class="faq-question-text"><?php the_title(); ?></span>
					<span class="faq-icon material-symbols-outlined" aria-hidden="true">
						<?php echo $faq_index === 0 ? 'remove' : 'add'; ?>
					</span>
				</button>
				<div class="faq-answer" id="<?php echo esc_attr( $panel_id ); ?>"
				     role="region"
				     <?php if ( $faq_index !== 0 ) echo 'hidden'; ?>>
					<div class="faq-answer-inner">
						<?php echo wp_kses_post( $answer ); ?>
					</div>
				</div>
			</div>
			<?php $faq_index++; ?>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>

		<?php else : ?>
		<div class="orthosmile-empty-notice">
			<span class="material-symbols-outlined" aria-hidden="true">info</span>
			<p>
				<?php esc_html_e( 'Aucune question publiée.', 'orthosmile' ); ?>
				<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=faq_item' ) ); ?>">
					<?php esc_html_e( 'Ajouter des questions →', 'orthosmile' ); ?>
				</a>
			</p>
		</div>
		<?php endif; ?>

	</div>
</section>
