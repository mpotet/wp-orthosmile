<?php
/**
 * Template part for displaying the services section.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) {
    exit;
}

// Get services from theme options or fallback to default
$services = get_theme_mod('services_list', [
    [
        'title' => __('Orthodontie Adulte', 'orthosmile'),
        'description' => __('Des traitements sur mesure pour adultes, discrets et efficaces pour redonner éclat à votre sourire.', 'orthosmile'),
        'icon' => 'face_6'
    ],
    [
        'title' => __('Orthodontie Enfant', 'orthosmile'),
        'description' => __('Prise en charge précoce pour guider le développement harmonieux de la dentition et de la mâchoire.', 'orthosmile'),
        'icon' => 'face_3'
    ],
    [
        'title' => __('Invisalign', 'orthosmile'),
        'description' => __('Aligneurs transparents pour un traitement invisible et amovible, adapté à votre mode de vie.', 'orthosmile'),
        'icon' => 'visibility_off'
    ],
    [
        'title' => __('Appareils Fixes', 'orthosmile'),
        'description' => __('Techniques classiques perfectionnées pour des résultats précis et durables sur tous types de cas.', 'orthosmile'),
        'icon' => 'settings'
    ],
    [
        'title' => __('Retenue Orthodontique', 'orthosmile'),
        'description' => __('Suivi et stabilisation après traitement pour garantir la pérennité de votre nouveau sourire.', 'orthosmile'),
        'icon' => 'check_circle'
    ],
    [
        'title' => __('Conseil & Prévention', 'orthosmile'),
        'description' => __('Éducation et accompagnement pour une hygiène optimale et une santé bucco-dentaire durable.', 'orthosmile'),
        'icon' => 'health_and_safety'
    ]
]);
?>

<section class="services-section" id="services">
    <div class="container">
        <div class="section-header fade-in-up">
            <span class="section-eyebrow"><?php esc_html_e('Nos Traitements', 'orthosmile'); ?></span>
            <h2 class="section-title"><?php esc_html_e('Nos Services', 'orthosmile'); ?></h2>
            <p class="section-subtitle"><?php esc_html_e('Une approche personnalisée pour chaque sourire, avec des solutions adaptées à votre âge, votre mode de vie et vos objectifs.', 'orthosmile'); ?></p>
        </div>

        <div class="services-grid">
            <?php foreach ($services as $index => $service) : ?>
                <div class="service-card fade-in-up" style="animation-delay: <?php echo (float)($index * 0.1); ?>s">
                    <div class="service-image">
                        <span class="material-symbols-outlined" aria-hidden="true"><?php echo esc_html($service['icon']); ?></span>
                    </div>
                    <div class="service-content">
                        <h3 class="service-title"><?php echo esc_html($service['title']); ?></h3>
                        <p class="service-description"><?php echo esc_html($service['description']); ?></p>
                        <a href="#contact" class="btn btn-secondary btn-sm">
                            <?php esc_html_e('En savoir plus', 'orthosmile'); ?>
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>