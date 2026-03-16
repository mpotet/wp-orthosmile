<?php
/**
 * Template part for displaying the gallery section.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) {
    exit;
}

// Get gallery images from theme options or fallback to default
$gallery_images = get_theme_mod('gallery_images', [
    [
        'before' => get_template_directory_uri() . '/assets/images/before-after-1-before.jpg',
        'after' => get_template_directory_uri() . '/assets/images/before-after-1-after.jpg',
        'title' => __('Cas de béance antérieure', 'orthosmile')
    ],
    [
        'before' => get_template_directory_uri() . '/assets/images/before-after-2-before.jpg',
        'after' => get_template_directory_uri() . '/assets/images/before-after-2-after.jpg',
        'title' => __('Correction de surplomb', 'orthosmile')
    ],
    [
        'before' => get_template_directory_uri() . '/assets/images/before-after-3-before.jpg',
        'after' => get_template_directory_uri() . '/assets/images/before-after-3-after.jpg',
        'title' => __('Alignement dentaire complet', 'orthosmile')
    ]
]);
?>

<section class="gallery-section" id="gallery">
    <div class="container">
        <div class="section-header fade-in-up">
            <h2 class="section-title"><?php esc_html_e('Galerie de Transformation', 'orthosmile'); ?></h2>
            <p class="section-subtitle"><?php esc_html_e('Découvrez des cas cliniques traités avec succès. Chaque sourire raconte une histoire de confiance retrouvée.', 'orthosmile'); ?></p>
        </div>
        
        <div class="gallery-grid">
            <?php foreach ($gallery_images as $index => $image) : ?>
                <div class="gallery-item fade-in-up" style="animation-delay: <?php echo $index * 0.1; ?>s">
                    <div class="before-after-card">
                        <div class="before-after-stage" data-before="<?php echo esc_url($image['before']); ?>" data-after="<?php echo esc_url($image['after']); ?>">
                            <div class="before-after-overlay">
                                <img src="<?php echo esc_url($image['after']); ?>" alt="<?php echo esc_attr($image['title']); ?> - Après" class="before-after-image">
                            </div>
                            <img src="<?php echo esc_url($image['before']); ?>" alt="<?php echo esc_attr($image['title']); ?> - Avant" class="before-after-image">
                            <div class="before-after-divider"></div>
                            <div class="before-after-handle">
                                <span class="material-symbols-outlined">compare</span>
                            </div>
                        </div>
                        <div class="gallery-overlay">
                            <h3 class="gallery-title"><?php echo esc_html($image['title']); ?></h3>
                            <span class="gallery-badge gallery-badge-before"><?php esc_html_e('Avant', 'orthosmile'); ?></span>
                            <span class="gallery-badge gallery-badge-after"><?php esc_html_e('Après', 'orthosmile'); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>