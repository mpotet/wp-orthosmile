<?php
/**
 * Template part for displaying the testimonials section.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) {
    exit;
}

// Get testimonials from theme options or fallback to default
$testimonials = get_theme_mod('testimonials_list', [
    [
        'quote' => __('Un suivi exceptionnel du début à la fin. Mon sourire a complètement changé ma vie !',
        'author' => __('Marie Dupont', 'orthosmile'),
        'role' => __('Patient adulte', 'orthosmile'),
        'icon' => 'face_6'
    ],
    [
        'quote' => __('L\'équipe est à l\'écoute et très professionnelle. Mon fils a adoré ses rendez-vous.',
        'author' => __('Jean Martin', 'orthosmile'),
        'role' => __('Parent d\'enfant', 'orthosmile'),
        'icon' => 'face_3'
    ],
    [
        'quote' => __('Des résultats au-delà de mes espérances. Discrétion et efficacité au rendez-vous.',
        'author' => __('Sophie Bernard', 'orthosmile'),
        'role' => __('Patient Invisalign', 'orthosmile'),
        'icon' => 'visibility_off'
    ]
]);
?>

<section class="testimonials-section" id="testimonials">
    <div class="container">
        <div class="section-header fade-in-up">
            <h2 class="section-title"><?php esc_html_e('Témoignages', 'orthosmile'); ?></h2>
            <p class="section-subtitle"><?php esc_html_e('Ce que nos patients disent de leur expérience avec notre cabinet. Leur satisfaction est notre plus belle récompense.', 'orthosmile'); ?></p>
        </div>
        
        <div class="testimonials-slider fade-in-up">
            <?php foreach ($testimonials as $index => $testimonial) : ?>
                <div class="testimonial-card" style="animation-delay: <?php echo $index * 0.2; ?>s">
                    <blockquote class="testimonial-quote">
                        "<?php echo esc_html($testimonial['quote']); ?>"
                    </blockquote>
                    <div class="testimonial-author">
                        <div class="author-image">
                            <span class="material-symbols-outlined"><?php echo esc_html($testimonial['icon']); ?></span>
                        </div>
                        <div class="author-info">
                            <h4><?php echo esc_html($testimonial['author']); ?></h4>
                            <p><?php echo esc_html($testimonial['role']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>