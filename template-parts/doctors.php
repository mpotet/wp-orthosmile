<?php
/**
 * Template part for displaying the doctors/team section.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) {
    exit;
}

// Get team members from theme options or fallback to default
$team_members = get_theme_mod('team_members', [
    [
        'name' => __('Dr. Sophie Martin', 'orthosmile'),
        'position' => __('Orthodontiste Diplômée', 'orthosmile'),
        'bio' => __('Spécialiste en orthodontie depuis 15 ans, passionnée par les techniques modernes et les approches personnalisées pour chaque patient.', 'orthosmile'),
        'icon' => 'face_6'
    ],
    [
        'name' => __('Dr. Pierre Dupont', 'orthosmile'),
        'position' => __('Orthodontiste Pédiatrique', 'orthosmile'),
        'bio' => __('Expert en prise en charge précoce des enfants, il allie expertise médicale et approche bienveillante pour un suivi serein.', 'orthosmile'),
        'icon' => 'face_3'
    ],
    [
        'name' => __('Dr. Camille Bernard', 'orthosmile'),
        'position' => __('Orthodontiste Invisalign', 'orthosmile'),
        'bio' => __('Certifiée Invisalign depuis 8 ans, elle accompagne les patients adultes dans leur parcours de traitement discret.', 'orthosmile'),
        'icon' => 'visibility_off'
    ]
]);
?>

<section class="team-section" id="team">
    <div class="container">
        <div class="section-header fade-in-up">
            <span class="section-eyebrow"><?php esc_html_e('L\'Équipe', 'orthosmile'); ?></span>
            <h2 class="section-title"><?php esc_html_e('Notre Équipe', 'orthosmile'); ?></h2>
            <p class="section-subtitle"><?php esc_html_e('Une équipe passionnée et expérimentée, dédiée à votre santé bucco-dentaire et à la réalisation de votre sourire idéal.', 'orthosmile'); ?></p>
        </div>

        <div class="team-grid">
            <?php foreach ($team_members as $index => $member) : ?>
                <div class="team-card fade-in-up" style="animation-delay: <?php echo (float)($index * 0.1); ?>s">
                    <div class="team-image">
                        <span class="material-symbols-outlined" aria-hidden="true"><?php echo esc_html($member['icon']); ?></span>
                    </div>
                    <div class="team-content">
                        <h3 class="team-name"><?php echo esc_html($member['name']); ?></h3>
                        <span class="team-position"><?php echo esc_html($member['position']); ?></span>
                        <p class="team-bio"><?php echo esc_html($member['bio']); ?></p>
                        <a href="#contact" class="btn btn-secondary btn-sm"><?php esc_html_e('Prendre rendez-vous', 'orthosmile'); ?></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>