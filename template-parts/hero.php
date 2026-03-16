<?php
/**
 * Template part for displaying the hero section.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) {
    exit;
}

$hero_content = orthosmile_get_hero_content();

// Customizer values for stats
$stat_patients  = get_theme_mod('orthosmile_stat_patients', '2 500+');
$stat_years     = get_theme_mod('orthosmile_stat_years', '18');
$stat_success   = get_theme_mod('orthosmile_stat_success', '98%');
$stat_reviews   = get_theme_mod('orthosmile_stat_reviews', '500+');
$cabinet_name   = get_bloginfo('name') ?: __('OrthoSmile', 'orthosmile');

$hero_style = '';
if ($hero_content['image']) {
    $hero_style = ' style="background-image: url(' . esc_url($hero_content['image']) . ')"';
}
?>

<section class="hero" id="hero"<?php echo $hero_style; ?>>
    <div class="container">

        <!-- Left: content -->
        <div class="hero-content fade-in-up">

            <span class="hero-eyebrow">
                <span class="material-symbols-outlined">verified</span>
                <?php esc_html_e('Cabinet Orthodontique Certifié', 'orthosmile'); ?>
            </span>

            <h1 class="hero-title">
                <?php
                $title = $hero_content['title'];
                // Split title: last two words get the gradient-span treatment
                $words = explode(' ', $title);
                $last  = implode(' ', array_slice($words, -2));
                $first = trim(implode(' ', array_slice($words, 0, -2)));
                if ($first && $last) {
                    echo esc_html($first) . ' <span>' . esc_html($last) . '</span>';
                } else {
                    echo esc_html($title);
                }
                ?>
            </h1>

            <p class="hero-subtitle"><?php echo esc_html($hero_content['subtitle']); ?></p>

            <div class="hero-badges">
                <span class="hero-badge">
                    <span class="material-symbols-outlined">verified_user</span>
                    <?php esc_html_e('Invisalign Certifié', 'orthosmile'); ?>
                </span>
                <span class="hero-badge">
                    <span class="material-symbols-outlined">schedule</span>
                    <?php esc_html_e('Rendez-vous sous 48 h', 'orthosmile'); ?>
                </span>
                <span class="hero-badge">
                    <span class="material-symbols-outlined">sentiment_satisfied</span>
                    <?php esc_html_e('Prise en charge mutuelle', 'orthosmile'); ?>
                </span>
            </div>

            <div class="hero-actions">
                <a href="<?php echo esc_url($hero_content['cta_url']); ?>" class="btn btn-accent btn-lg">
                    <span class="material-symbols-outlined">calendar_month</span>
                    <?php echo esc_html($hero_content['cta_text']); ?>
                </a>
                <a href="#services" class="btn btn-outline btn-lg">
                    <?php esc_html_e('Découvrir nos soins', 'orthosmile'); ?>
                    <span class="material-symbols-outlined">arrow_downward</span>
                </a>
            </div>
        </div>

        <!-- Right: floating stats card -->
        <div class="hero-card">
            <div class="hero-card-header">
                <div class="hero-card-icon">
                    <span class="material-symbols-outlined">local_hospital</span>
                </div>
                <div>
                    <p class="hero-card-title"><?php echo esc_html($cabinet_name); ?></p>
                    <p class="hero-card-subtitle"><?php esc_html_e('Cabinet Orthodontique', 'orthosmile'); ?></p>
                </div>
            </div>

            <div class="hero-card-stats">
                <div class="hero-card-stat">
                    <span class="hero-stat-value"><?php echo esc_html($stat_patients); ?></span>
                    <span class="hero-stat-label"><?php esc_html_e('Patients traités', 'orthosmile'); ?></span>
                </div>
                <div class="hero-card-stat">
                    <span class="hero-stat-value"><?php echo esc_html($stat_years); ?></span>
                    <span class="hero-stat-label"><?php esc_html_e('Ans d\'expérience', 'orthosmile'); ?></span>
                </div>
                <div class="hero-card-stat">
                    <span class="hero-stat-value"><?php echo esc_html($stat_success); ?></span>
                    <span class="hero-stat-label"><?php esc_html_e('Taux de satisfaction', 'orthosmile'); ?></span>
                </div>
                <div class="hero-card-stat">
                    <span class="hero-stat-value"><?php echo esc_html($stat_reviews); ?></span>
                    <span class="hero-stat-label"><?php esc_html_e('Avis 5 étoiles', 'orthosmile'); ?></span>
                </div>
            </div>

            <div class="hero-card-cta">
                <a href="<?php echo esc_url($hero_content['cta_url']); ?>" class="btn btn-primary">
                    <span class="material-symbols-outlined">calendar_month</span>
                    <?php esc_html_e('Prendre rendez-vous', 'orthosmile'); ?>
                </a>
            </div>
        </div>

    </div>
</section>
