<?php
/**
 * Template part: Services / Traitements section.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) exit;

if (!get_theme_mod('show_services', true)) return;

$section_title    = get_theme_mod('services_title', 'Nos traitements orthodontiques');
$section_subtitle = get_theme_mod('services_subtitle', 'Des solutions modernes adaptées à chaque profil');

$traitements = new WP_Query([
    'post_type'      => 'traitement',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'post_status'    => 'publish',
]);
?>

<section class="services-section" id="services" aria-label="<?php esc_attr_e('Nos traitements', 'orthosmile'); ?>">
    <div class="container">

        <div class="section-header">
            <span class="section-eyebrow">
                <span class="material-symbols-outlined" aria-hidden="true">dentistry</span>
                <?php esc_html_e('Nos solutions', 'orthosmile'); ?>
            </span>
            <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
            <p class="section-subtitle"><?php echo esc_html($section_subtitle); ?></p>
        </div>

        <?php if ($traitements->have_posts()) : ?>
        <div class="services-grid">
            <?php while ($traitements->have_posts()) : $traitements->the_post(); ?>
            <?php
            $post_id     = get_the_ID();
            $icon        = get_post_meta($post_id, '_traitement_icone', true) ?: 'dentistry';
            $badge       = get_post_meta($post_id, '_traitement_badge', true);
            $prix        = get_post_meta($post_id, '_traitement_prix', true);
            $description = get_post_meta($post_id, '_traitement_description', true) ?: get_the_excerpt();
            ?>
            <article class="service-card fade-in-up">
                <div class="service-card-inner">
                    <div class="service-icon-wrap">
                        <span class="material-symbols-outlined service-icon" aria-hidden="true"><?php echo esc_html($icon); ?></span>
                    </div>
                    <?php if ($badge) : ?>
                        <span class="service-badge"><?php echo esc_html($badge); ?></span>
                    <?php endif; ?>
                    <h3 class="service-title"><?php the_title(); ?></h3>
                    <?php if ($description) : ?>
                        <p class="service-description"><?php echo esc_html($description); ?></p>
                    <?php endif; ?>
                    <?php if ($prix) : ?>
                        <div class="service-price">
                            <span class="material-symbols-outlined" aria-hidden="true">payments</span>
                            <span><?php echo esc_html($prix); ?></span>
                        </div>
                    <?php endif; ?>
                    <a href="<?php echo esc_url(orthosmile_get_appointment_url()); ?>" class="service-cta">
                        <?php esc_html_e('Prendre rendez-vous', 'orthosmile'); ?>
                        <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
                    </a>
                </div>
                <?php if (has_post_thumbnail()) : ?>
                <div class="service-image-wrap">
                    <?php the_post_thumbnail('gallery-thumb', ['class' => 'service-image', 'loading' => 'lazy']); ?>
                </div>
                <?php endif; ?>
            </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <?php else : ?>
        <div class="services-placeholder fade-in-up">
            <p class="placeholder-notice">
                <span class="material-symbols-outlined" aria-hidden="true">info</span>
                <?php esc_html_e('XXXX — Ajoutez vos traitements depuis l\'administration (Traitements → Ajouter).', 'orthosmile'); ?>
            </p>
        </div>
        <?php endif; ?>

    </div>
</section>