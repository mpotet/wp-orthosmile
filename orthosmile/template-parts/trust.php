<?php
/**
 * Template part for displaying the trust section.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) {
    exit;
}

$trust_content = orthosmile_get_trust_content();
?>

<section class="trust-section" id="trust">
    <div class="container">
        <div class="section-header fade-in-up">
            <h2 class="section-title"><?php echo esc_html($trust_content['title']); ?></h2>
            <p class="section-subtitle"><?php echo esc_html($trust_content['subtitle']); ?></p>
        </div>
        
        <div class="trust-grid">
            <?php foreach ($trust_content['items'] as $index => $item) : ?>
                <div class="trust-card fade-in-up" style="animation-delay: <?php echo $index * 0.1; ?>s">
                    <span class="material-symbols-outlined trust-icon"><?php echo esc_html($item['icon']); ?></span>
                    <div class="trust-value"><?php echo esc_html($item['value']); ?></div>
                    <div class="trust-label"><?php echo esc_html($item['label']); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>