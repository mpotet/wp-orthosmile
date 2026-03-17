<?php
/**
 * Template part: FAQ accordion section.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) exit;

if (!get_theme_mod('show_faq', true)) return;

$section_title    = get_theme_mod('faq_title', 'Questions fréquentes');
$section_subtitle = get_theme_mod('faq_subtitle', 'Tout ce que vous souhaitez savoir sur l\'orthodontie');

$faqs = new WP_Query([
    'post_type'      => 'faq_item',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'post_status'    => 'publish',
]);
?>

<section class="faq-section" id="faq" aria-label="<?php esc_attr_e('Questions fréquentes', 'orthosmile'); ?>">
    <div class="container">

        <div class="section-header">
            <span class="section-eyebrow">
                <span class="material-symbols-outlined" aria-hidden="true">help</span>
                FAQ
            </span>
            <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
            <p class="section-subtitle"><?php echo esc_html($section_subtitle); ?></p>
        </div>

        <?php if ($faqs->have_posts()) : ?>
        <div class="faq-list" role="list">
            <?php $faq_index = 0; ?>
            <?php while ($faqs->have_posts()) : $faqs->the_post(); ?>
            <?php
            $answer = get_post_meta(get_the_ID(), '_faq_reponse', true) ?: get_the_content();
            $item_id = 'faq-item-' . get_the_ID();
            $panel_id = 'faq-panel-' . get_the_ID();
            ?>
            <div class="faq-item<?php echo $faq_index === 0 ? ' is-open' : ''; ?>" role="listitem" id="<?php echo esc_attr($item_id); ?>">
                <button class="faq-question"
                        aria-expanded="<?php echo $faq_index === 0 ? 'true' : 'false'; ?>"
                        aria-controls="<?php echo esc_attr($panel_id); ?>">
                    <span class="faq-question-text"><?php the_title(); ?></span>
                    <span class="faq-icon material-symbols-outlined" aria-hidden="true">
                        <?php echo $faq_index === 0 ? 'remove' : 'add'; ?>
                    </span>
                </button>
                <div class="faq-answer" id="<?php echo esc_attr($panel_id); ?>"
                     role="region"
                     <?php if ($faq_index !== 0) echo 'hidden'; ?>>
                    <div class="faq-answer-inner">
                        <?php echo wp_kses_post($answer); ?>
                    </div>
                </div>
            </div>
            <?php $faq_index++; ?>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <?php else : ?>
        <div class="faq-placeholder fade-in-up">
            <p class="placeholder-notice">
                <span class="material-symbols-outlined" aria-hidden="true">info</span>
                <?php esc_html_e('XXXX — Ajoutez vos questions fréquentes via l\'administration (FAQ → Ajouter une question).', 'orthosmile'); ?>
            </p>
        </div>
        <?php endif; ?>

    </div>
</section>