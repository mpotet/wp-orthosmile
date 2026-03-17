<?php
/**
 * Template part: Statistics / Trust counters section.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) exit;

if (!get_theme_mod('show_stats', true)) return;

$stats = [
    [
        'value' => get_theme_mod('stat_1_value', 'XXXX'),
        'label' => get_theme_mod('stat_1_label', 'XXXX - Légende statistique 1'),
        'icon'  => get_theme_mod('stat_1_icon', 'emoji_events'),
    ],
    [
        'value' => get_theme_mod('stat_2_value', 'XXXX'),
        'label' => get_theme_mod('stat_2_label', 'XXXX - Légende statistique 2'),
        'icon'  => get_theme_mod('stat_2_icon', 'groups'),
    ],
    [
        'value' => get_theme_mod('stat_3_value', 'XXXX'),
        'label' => get_theme_mod('stat_3_label', 'XXXX - Légende statistique 3'),
        'icon'  => get_theme_mod('stat_3_icon', 'verified'),
    ],
    [
        'value' => get_theme_mod('stat_4_value', 'XXXX'),
        'label' => get_theme_mod('stat_4_label', 'XXXX - Légende statistique 4'),
        'icon'  => get_theme_mod('stat_4_icon', 'star'),
    ],
];
?>

<section class="stats-section" id="stats" aria-label="<?php esc_attr_e('Nos chiffres', 'orthosmile'); ?>">
    <div class="container">
        <div class="stats-grid">
            <?php foreach ($stats as $stat) : ?>
            <div class="stat-card fade-in-up">
                <div class="stat-icon-wrap">
                    <span class="material-symbols-outlined" aria-hidden="true"><?php echo esc_html($stat['icon']); ?></span>
                </div>
                <span class="stat-value" data-target="<?php echo esc_attr(preg_replace('/[^0-9]/', '', $stat['value'])); ?>" data-suffix="<?php echo esc_attr(preg_replace('/[0-9]/', '', $stat['value'])); ?>">
                    <?php echo esc_html($stat['value']); ?>
                </span>
                <span class="stat-label"><?php echo esc_html($stat['label']); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
