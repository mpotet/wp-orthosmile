<?php
/**
 * Template part: Team / Doctors section — Splide carousel.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) exit;

if (!get_theme_mod('show_doctors', true)) return;

$section_title    = get_theme_mod('equipe_title', 'Notre équipe');
$section_subtitle = get_theme_mod('equipe_subtitle', 'Des spécialistes passionnés à votre service');
$team_image_id    = get_theme_mod('team_photo', '');

$praticiens = new WP_Query([
    'post_type'      => 'praticien',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'post_status'    => 'publish',
]);
?>

<section class="team-section" id="team" aria-label="<?php esc_attr_e('Notre équipe', 'orthosmile'); ?>">
    <div class="container">

        <div class="section-header">
            <span class="section-eyebrow">
                <span class="material-symbols-outlined" aria-hidden="true">groups</span>
                <?php esc_html_e('Nos praticiens', 'orthosmile'); ?>
            </span>
            <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
            <p class="section-subtitle"><?php echo esc_html($section_subtitle); ?></p>
        </div>

        <?php if ($team_image_id) : ?>
        <div class="team-banner fade-in-up">
            <?php
            $team_img_url = wp_get_attachment_image_url($team_image_id, 'team-banner');
            if (!$team_img_url) $team_img_url = wp_get_attachment_image_url($team_image_id, 'large');
            ?>
            <?php if ($team_img_url) : ?>
                <img src="<?php echo esc_url($team_img_url); ?>"
                     alt="<?php esc_attr_e('Photo de l\'équipe du cabinet', 'orthosmile'); ?>"
                     loading="lazy"
                     class="team-banner-img">
                <div class="team-banner-caption">
                    <span class="material-symbols-outlined" aria-hidden="true">verified</span>
                    <?php echo esc_html($section_title); ?> — <?php echo esc_html($section_subtitle); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if ($praticiens->have_posts()) : ?>
        <div class="splide team-splide" aria-label="<?php esc_attr_e('Carousel de l\'équipe', 'orthosmile'); ?>">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php while ($praticiens->have_posts()) : $praticiens->the_post(); ?>
                    <?php
                    $post_id    = get_the_ID();
                    $poste      = get_post_meta($post_id, '_praticien_poste', true);
                    $bio        = get_post_meta($post_id, '_praticien_bio', true);
                    $specialites = get_post_meta($post_id, '_praticien_specialites', true);
                    if (!is_array($specialites)) $specialites = [];
                    ?>
                    <li class="splide__slide">
                        <article class="praticien-card">
                            <div class="praticien-photo-wrap">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('praticien-card', [
                                        'class' => 'praticien-photo',
                                        'alt'   => get_the_title(),
                                    ]); ?>
                                <?php else : ?>
                                    <div class="praticien-photo praticien-photo-placeholder">
                                        <span class="material-symbols-outlined" aria-hidden="true">person</span>
                                    </div>
                                <?php endif; ?>
                                <div class="praticien-photo-overlay">
                                    <?php if ($specialites) : ?>
                                    <div class="praticien-specialties">
                                        <?php foreach (array_slice($specialites, 0, 3) as $spec) : ?>
                                            <span class="specialty-badge"><?php echo esc_html($spec); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="praticien-info">
                                <h3 class="praticien-name"><?php the_title(); ?></h3>
                                <?php if ($poste) : ?>
                                    <p class="praticien-poste"><?php echo esc_html($poste); ?></p>
                                <?php endif; ?>
                                <?php if ($bio) : ?>
                                    <p class="praticien-bio"><?php echo esc_html($bio); ?></p>
                                <?php endif; ?>
                            </div>
                        </article>
                    </li>
                    <?php endwhile; wp_reset_postdata(); ?>
                </ul>
            </div>
            <!-- Arrows -->
            <div class="splide__arrows">
                <button class="splide__arrow splide__arrow--prev" aria-label="<?php esc_attr_e('Précédent', 'orthosmile'); ?>">
                    <span class="material-symbols-outlined">arrow_back</span>
                </button>
                <button class="splide__arrow splide__arrow--next" aria-label="<?php esc_attr_e('Suivant', 'orthosmile'); ?>">
                    <span class="material-symbols-outlined">arrow_forward</span>
                </button>
            </div>
        </div>

        <?php else : ?>
        <!-- Placeholder if no praticien CPT entries yet -->
        <div class="team-placeholder fade-in-up">
            <p class="placeholder-notice">
                <span class="material-symbols-outlined" aria-hidden="true">info</span>
                <?php esc_html_e('XXXX — Ajoutez vos praticiens depuis l\'interface d\'administration (Praticiens → Ajouter).', 'orthosmile'); ?>
            </p>
        </div>
        <?php endif; ?>

    </div>
</section>