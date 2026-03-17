<?php
/**
 * Template part: Avant/Après gallery section.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) exit;

if (!get_theme_mod('show_gallery', true)) return;

$section_title    = get_theme_mod('gallery_title',    __('Nos résultats', 'orthosmile'));
$section_subtitle = get_theme_mod('gallery_subtitle', __('Des transformations réelles, des sourires rayonnants', 'orthosmile'));

$gallery = [
    [
        'before' => get_theme_mod('gallery_1_before', ''),
        'after'  => get_theme_mod('gallery_1_after', ''),
        'label'  => get_theme_mod('gallery_1_label', 'XXXX - Cas clinique 1'),
    ],
    [
        'before' => get_theme_mod('gallery_2_before', ''),
        'after'  => get_theme_mod('gallery_2_after', ''),
        'label'  => get_theme_mod('gallery_2_label', 'XXXX - Cas clinique 2'),
    ],
    [
        'before' => get_theme_mod('gallery_3_before', ''),
        'after'  => get_theme_mod('gallery_3_after', ''),
        'label'  => get_theme_mod('gallery_3_label', 'XXXX - Cas clinique 3'),
    ],
];

// Only show if at least one pair has an image
$has_content = false;
foreach ($gallery as $g) {
    if ($g['before'] || $g['after']) { $has_content = true; break; }
}
?>

<section class="gallery-section" id="gallery" aria-label="<?php esc_attr_e('Galerie avant/après', 'orthosmile'); ?>">
    <div class="container">

        <div class="section-header">
            <span class="section-eyebrow">
                <span class="material-symbols-outlined" aria-hidden="true">auto_awesome</span>
                <?php esc_html_e('Avant / Après', 'orthosmile'); ?>
            </span>
            <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
            <p class="section-subtitle"><?php echo esc_html($section_subtitle); ?></p>
        </div>

        <?php if ($has_content) : ?>
        <div class="gallery-grid">
            <?php foreach ($gallery as $index => $item) : ?>
            <?php if (!$item['before'] && !$item['after']) continue; ?>
            <div class="before-after-wrap fade-in-up">
                <div class="before-after-stage" data-index="<?php echo esc_attr($index); ?>">

                    <!-- Before image -->
                    <div class="before-after-base">
                        <?php if ($item['before']) : ?>
                            <img src="<?php echo esc_url($item['before']); ?>"
                                 alt="<?php esc_attr_e('Avant traitement', 'orthosmile'); ?>"
                                 loading="lazy">
                        <?php else : ?>
                            <div class="before-after-placeholder">
                                <span class="material-symbols-outlined">image</span>
                                <?php esc_html_e('Avant', 'orthosmile'); ?>
                            </div>
                        <?php endif; ?>
                        <span class="ba-tag ba-tag--before"><?php esc_html_e('Avant', 'orthosmile'); ?></span>
                    </div>

                    <!-- After overlay (clip-path reveal) -->
                    <div class="before-after-overlay">
                        <?php if ($item['after']) : ?>
                            <img src="<?php echo esc_url($item['after']); ?>"
                                 alt="<?php esc_attr_e('Après traitement', 'orthosmile'); ?>"
                                 loading="lazy">
                        <?php else : ?>
                            <div class="before-after-placeholder">
                                <span class="material-symbols-outlined">image</span>
                                <?php esc_html_e('Après', 'orthosmile'); ?>
                            </div>
                        <?php endif; ?>
                        <span class="ba-tag ba-tag--after"><?php esc_html_e('Après', 'orthosmile'); ?></span>
                    </div>

                    <!-- Divider handle -->
                    <div class="before-after-divider">
                        <button class="before-after-handle" aria-label="<?php esc_attr_e('Glisser pour comparer', 'orthosmile'); ?>">
                            <span class="material-symbols-outlined" aria-hidden="true">swap_horiz</span>
                        </button>
                    </div>

                </div>
                <?php if ($item['label']) : ?>
                <p class="ba-label"><?php echo esc_html($item['label']); ?></p>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>

        <?php else : ?>
        <div class="gallery-placeholder fade-in-up">
            <p class="placeholder-notice">
                <span class="material-symbols-outlined" aria-hidden="true">info</span>
                <?php esc_html_e('XXXX - Ajoutez vos photos avant/après via Apparence → Personnaliser → Galerie.', 'orthosmile'); ?>
            </p>
        </div>
        <?php endif; ?>

    </div>
</section>