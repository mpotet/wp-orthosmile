<?php
/**
 * Template part for displaying specialists section.
 *
 * @package OrthoSmile
 */

// Check if specialists section is enabled
if (!get_theme_mod('orthosmile_enable_specialists', true)) {
    return;
}

// Get specialists data
$title = get_theme_mod('orthosmile_specialists_title', __('Nos Spécialistes', 'orthosmile'));
$description = get_theme_mod('orthosmile_specialists_description', __('Une équipe de spécialistes dévoués pour votre santé bucco-dentaire.', 'orthosmile'));

$specialist_1_name = get_theme_mod('orthosmile_specialist_1_name', __('Dr. Jean Dupont', 'orthosmile'));
$specialist_1_title = get_theme_mod('orthosmile_specialist_1_title', __('Orthodontiste Senior', 'orthosmile'));
$specialist_1_description = get_theme_mod('orthosmile_specialist_1_description', __('Spécialiste en orthodontie adulte avec plus de 15 ans d\'expérience.', 'orthosmile'));

$specialist_2_name = get_theme_mod('orthosmile_specialist_2_name', __('Dr. Marie Martin', 'orthosmile'));
$specialist_2_title = get_theme_mod('orthosmile_specialist_2_title', __('Orthodontiste Pédiatrique', 'orthosmile'));
$specialist_2_description = get_theme_mod('orthosmile_specialist_2_description', __('Spécialiste en orthodontie infantile et préventive.', 'orthosmile'));

$specialist_3_name = get_theme_mod('orthosmile_specialist_3_name', __('Dr. Pierre Bernard', 'orthosmile'));
$specialist_3_title = get_theme_mod('orthosmile_specialist_3_title', __('Chirurgien Orthognathique', 'orthosmile'));
$specialist_3_description = get_theme_mod('orthosmile_specialist_3_description', __('Expert en chirurgie orthognathique et traitements complexes.', 'orthosmile'));
?>

<section class="specialists-section" id="specialists">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><?php echo esc_html($title); ?></h2>
            <p class="section-subtitle"><?php echo esc_html($description); ?></p>
        </div>
        
        <div class="specialists-grid">
            <div class="specialist-card">
                <div class="specialist-content">
                    <h3 class="specialist-name"><?php echo esc_html($specialist_1_name); ?></h3>
                    <div class="specialist-title"><?php echo esc_html($specialist_1_title); ?></div>
                    <p class="specialist-description"><?php echo esc_html($specialist_1_description); ?></p>
                </div>
            </div>
            
            <div class="specialist-card">
                <div class="specialist-content">
                    <h3 class="specialist-name"><?php echo esc_html($specialist_2_name); ?></h3>
                    <div class="specialist-title"><?php echo esc_html($specialist_2_title); ?></div>
                    <p class="specialist-description"><?php echo esc_html($specialist_2_description); ?></p>
                </div>
            </div>
            
            <div class="specialist-card">
                <div class="specialist-content">
                    <h3 class="specialist-name"><?php echo esc_html($specialist_3_name); ?></h3>
                    <div class="specialist-title"><?php echo esc_html($specialist_3_title); ?></div>
                    <p class="specialist-description"><?php echo esc_html($specialist_3_description); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>