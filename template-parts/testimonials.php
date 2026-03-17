<?php
/**
 * Template part: Testimonials section.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) exit;

if (!get_theme_mod('show_testimonials', true)) return;

$section_title    = get_theme_mod('testimonials_title', 'Ce que disent nos patients');
$section_subtitle = get_theme_mod('testimonials_subtitle', 'Des centaines de familles nous font confiance');

// Up to 6 testimonials from customizer
$testimonials = [];
for ($i = 1; $i <= 6; $i++) {
    $name   = get_theme_mod('testimonial_' . $i . '_name', '');
    $text   = get_theme_mod('testimonial_' . $i . '_text', '');
    $rating = (int) get_theme_mod('testimonial_' . $i . '_rating', 5);
    $treat  = get_theme_mod('testimonial_' . $i . '_treatment', '');
    if ($name || $text) {
        $testimonials[] = compact('name', 'text', 'rating', 'treat');
    }
}

// If no customizer testimonials, show placeholder
if (empty($testimonials)) {
    $testimonials = [
        [
            'name'  => 'XXXX — Prénom Nom',
            'text'  => 'XXXX — Ajoutez un témoignage patient via Apparence → Personnaliser → Témoignages.',
            'rating' => 5,
            'treat' => 'XXXX — Traitement',
        ],
    ];
}
?>

<section class="testimonials-section" id="testimonials" aria-label="<?php esc_attr_e('Témoignages patients', 'orthosmile'); ?>">
    <div class="container">

        <div class="section-header">
            <span class="section-eyebrow">
                <span class="material-symbols-outlined" aria-hidden="true">format_quote</span>
                <?php esc_html_e('Témoignages', 'orthosmile'); ?>
            </span>
            <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
            <p class="section-subtitle"><?php echo esc_html($section_subtitle); ?></p>
        </div>

        <div class="testimonials-grid">
            <?php foreach ($testimonials as $testimonial) : ?>
            <div class="testimonial-card fade-in-up">
                <div class="testimonial-stars" aria-label="<?php echo esc_attr($testimonial['rating']); ?>/5 étoiles">
                    <?php for ($s = 0; $s < 5; $s++) : ?>
                        <span class="material-symbols-outlined <?php echo $s < $testimonial['rating'] ? 'filled' : 'empty'; ?>" aria-hidden="true">star</span>
                    <?php endfor; ?>
                </div>
                <blockquote class="testimonial-quote">
                    <p><?php echo esc_html($testimonial['text']); ?></p>
                </blockquote>
                <footer class="testimonial-footer">
                    <div class="testimonial-avatar" aria-hidden="true">
                        <span class="material-symbols-outlined">person</span>
                    </div>
                    <div class="testimonial-author">
                        <span class="testimonial-name"><?php echo esc_html($testimonial['name']); ?></span>
                        <?php if ($testimonial['treat']) : ?>
                            <span class="testimonial-treat"><?php echo esc_html($testimonial['treat']); ?></span>
                        <?php endif; ?>
                    </div>
                </footer>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>