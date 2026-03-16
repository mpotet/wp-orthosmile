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
?>

<section class="hero" id="hero">
    <div class="container">
        <div class="hero-content fade-in-up">
            <h1 class="hero-title"><?php echo esc_html($hero_content['title']); ?></h1>
            <p class="hero-subtitle"><?php echo esc_html($hero_content['subtitle']); ?></p>
            <div class="hero-actions">
                <a href="<?php echo esc_url($hero_content['cta_url']); ?>" class="btn btn-primary">
                    <?php echo esc_html($hero_content['cta_text']); ?>
                </a>
                <a href="#contact" class="btn btn-secondary">
                    <?php esc_html_e('Nous contacter', 'orthosmile'); ?>
                </a>
            </div>
        </div>
        
        <?php if ($hero_content['image']) : ?>
            <div class="hero-visual fade-in-up">
                <img src="<?php echo esc_url($hero_content['image']); ?>" alt="<?php echo esc_attr($hero_content['title']); ?>" class="hero-image">
            </div>
        <?php endif; ?>
    </div>
</section>