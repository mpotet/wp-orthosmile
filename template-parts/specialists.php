<?php
/**
 * Template part for displaying specialists section.
 *
 * @package OrthoSmile
 */

if (!get_theme_mod('orthosmile_enable_specialists', true)) {
    return;
}

$title       = get_theme_mod('orthosmile_specialists_title', __('Notre Équipe', 'orthosmile'));
$description = get_theme_mod('orthosmile_specialists_description', __('XXXX - description de votre équipe à personnaliser dans le Customiseur.', 'orthosmile'));
$team_photo  = get_theme_mod('orthosmile_team_photo', '');
$team_photo_caption = get_theme_mod('orthosmile_team_photo_caption', '');

$specialists = [];
for ($i = 1; $i <= 3; $i++) {
    $name  = get_theme_mod("orthosmile_specialist_{$i}_name", '');
    $title_s = get_theme_mod("orthosmile_specialist_{$i}_title", '');
    $desc  = get_theme_mod("orthosmile_specialist_{$i}_description", '');
    $photo = get_theme_mod("orthosmile_specialist_{$i}_photo", '');
    if ($name || $title_s) {
        $specialists[] = compact('name', 'title_s', 'desc', 'photo');
    }
}

if (empty($specialists)) {
    $specialists = [
        [
            'name'    => 'Dr. XXXX',
            'title_s' => __('XXXX - Titre', 'orthosmile'),
            'desc'    => __('XXXX - Présentation du praticien à personnaliser dans le Customiseur.', 'orthosmile'),
            'photo'   => '',
        ],
        [
            'name'    => 'Dr. XXXX',
            'title_s' => __('XXXX - Titre', 'orthosmile'),
            'desc'    => __('XXXX - Présentation du praticien à personnaliser dans le Customiseur.', 'orthosmile'),
            'photo'   => '',
        ],
        [
            'name'    => 'Dr. XXXX',
            'title_s' => __('XXXX - Titre', 'orthosmile'),
            'desc'    => __('XXXX - Présentation du praticien à personnaliser dans le Customiseur.', 'orthosmile'),
            'photo'   => '',
        ],
    ];
}
?>

<section class="specialists-section" id="specialists">
    <div class="container">
        <div class="section-header fade-in-up">
            <span class="section-eyebrow"><?php esc_html_e('L\'équipe', 'orthosmile'); ?></span>
            <h2 class="section-title"><?php echo esc_html($title); ?></h2>
            <p class="section-subtitle"><?php echo esc_html($description); ?></p>
        </div>

        <?php if ($team_photo) : ?>
        <div class="specialists-team-photo fade-in-up">
            <img src="<?php echo esc_url($team_photo); ?>"
                 alt="<?php esc_attr_e('Notre équipe', 'orthosmile'); ?>">
            <?php if ($team_photo_caption) : ?>
            <div class="specialists-team-photo-caption"><?php echo esc_html($team_photo_caption); ?></div>
            <?php endif; ?>
        </div>
        <?php else : ?>
        <div class="specialists-team-photo fade-in-up">
            <div class="specialists-team-photo-placeholder">
                <span class="material-symbols-outlined">groups</span>
                <p><?php esc_html_e('Ajoutez une photo de votre équipe dans le Customiseur → Les Spécialistes → Photo de l\'équipe', 'orthosmile'); ?></p>
            </div>
        </div>
        <?php endif; ?>

        <div class="specialists-grid">
            <?php foreach ($specialists as $specialist) : ?>
            <div class="specialist-card fade-in-up">
                <div class="specialist-photo">
                    <?php if (!empty($specialist['photo'])) : ?>
                        <img src="<?php echo esc_url($specialist['photo']); ?>"
                             alt="<?php echo esc_attr($specialist['name']); ?>">
                    <?php else : ?>
                        <div class="specialist-photo-placeholder">
                            <span class="material-symbols-outlined">person</span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="specialist-content">
                    <h3 class="specialist-name"><?php echo esc_html($specialist['name']); ?></h3>
                    <span class="specialist-title"><?php echo esc_html($specialist['title_s']); ?></span>
                    <p class="specialist-description"><?php echo esc_html($specialist['desc']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>