<?php
/**
 * Template part: Hero section.
 *
 * All texts and images are configurable via the Customizer (Appearance → Customize).
 * Leaving a field empty hides the corresponding element.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) exit;

/* ── Core content ─────────────────────────────────── */
$hero_title    = get_theme_mod('hero_title', __('Votre sourire parfait commence ici', 'orthosmile'));
$hero_subtitle = get_theme_mod('hero_subtitle', __('Décrivez votre cabinet et votre approche ici.', 'orthosmile'));
$hero_cta_text = get_theme_mod('hero_cta_text', __('Prendre rendez-vous', 'orthosmile'));
$hero_cta_url  = get_theme_mod('hero_cta_url', '') ?: orthosmile_get_appointment_url();

/* ── Secondary CTA ────────────────────────────────── */
$hero_secondary_cta_text = get_theme_mod('hero_secondary_cta_text', __('Voir nos traitements', 'orthosmile'));
$hero_secondary_cta_url  = get_theme_mod('hero_secondary_cta_url', '#services');

/* ── Eyebrow / cabinet name ───────────────────────── */
$cabinet_name = get_theme_mod('cabinet_name', get_bloginfo('name'));

/* ── Hero image (optional) ────────────────────────── */
$hero_image       = get_theme_mod('hero_image', '');
$hero_image_alt   = get_theme_mod('hero_image_alt', __('Photo du cabinet ou de l\'équipe', 'orthosmile'));
$show_hero_image  = get_theme_mod('show_hero_image', true);
$has_hero_image   = $show_hero_image && !empty($hero_image);

/* ── Badges (3 configurable, each optional) ───────── */
$badges = [];
for ($i = 1; $i <= 3; $i++) {
    $defaults = [
        1 => ['icon' => 'workspace_premium', 'text' => __('Spécialistes certifiés', 'orthosmile')],
        2 => ['icon' => 'visibility_off',    'text' => __('Invisalign Certified',    'orthosmile')],
        3 => ['icon' => 'child_care',        'text' => __('Pédiatrie & adultes',     'orthosmile')],
    ];
    $show = get_theme_mod("hero_badge_{$i}_show", true);
    $text = get_theme_mod("hero_badge_{$i}_text", $defaults[$i]['text']);
    $icon = get_theme_mod("hero_badge_{$i}_icon", $defaults[$i]['icon']);
    if ($show && !empty($text)) {
        $badges[] = ['text' => $text, 'icon' => $icon];
    }
}

$hero_class = 'hero' . ($has_hero_image ? '' : ' hero--no-image');
?>

<section class="<?php echo esc_attr($hero_class); ?>" id="hero">
    <div class="container">
        <div class="hero-grid">
            <div class="hero-content">

                <?php if (!empty($cabinet_name)) : ?>
                <div class="hero-eyebrow">
                    <span class="material-symbols-outlined" aria-hidden="true">verified</span>
                    <?php echo esc_html($cabinet_name ?: __('Cabinet Orthodontiste', 'orthosmile')); ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($hero_title)) : ?>
                <h1 class="hero-title"><?php echo esc_html($hero_title); ?></h1>
                <?php endif; ?>

                <?php if (!empty($hero_subtitle)) : ?>
                <p class="hero-subtitle"><?php echo esc_html($hero_subtitle); ?></p>
                <?php endif; ?>

                <?php if (!empty($badges)) : ?>
                <div class="hero-badges">
                    <?php foreach ($badges as $badge) : ?>
                    <span class="hero-badge">
                        <?php if (!empty($badge['icon'])) : ?>
                        <span class="material-symbols-outlined" aria-hidden="true"><?php echo esc_html($badge['icon']); ?></span>
                        <?php endif; ?>
                        <?php echo esc_html($badge['text']); ?>
                    </span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <div class="hero-actions">
                    <?php if (!empty($hero_cta_text) && !empty($hero_cta_url)) : ?>
                    <a href="<?php echo esc_url($hero_cta_url); ?>" class="btn btn-primary btn-lg">
                        <span class="material-symbols-outlined" aria-hidden="true">calendar_month</span>
                        <?php echo esc_html($hero_cta_text); ?>
                    </a>
                    <?php endif; ?>

                    <?php if (!empty($hero_secondary_cta_text) && !empty($hero_secondary_cta_url)) : ?>
                    <a href="<?php echo esc_url($hero_secondary_cta_url); ?>" class="btn btn-outline-white btn-lg">
                        <?php echo esc_html($hero_secondary_cta_text); ?>
                        <span class="material-symbols-outlined" aria-hidden="true">arrow_downward</span>
                    </a>
                    <?php endif; ?>
                </div>

            </div>

            <?php if ($has_hero_image) : ?>
            <div class="hero-image">
                <img src="<?php echo esc_url($hero_image); ?>"
                     alt="<?php echo esc_attr($hero_image_alt); ?>" />
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>
