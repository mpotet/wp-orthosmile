<?php
/**
 * Homepage template.
 * Loads all sections in order with show/hide checks.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) exit;

get_header();
?>

<main id="main" class="site-main" role="main">

    <?php get_template_part('template-parts/hero'); ?>

    <?php get_template_part('template-parts/stats'); ?>

    <?php get_template_part('template-parts/about-section'); ?>

    <?php get_template_part('template-parts/doctors'); ?>

    <?php get_template_part('template-parts/services'); ?>

    <?php get_template_part('template-parts/gallery'); ?>

    <?php get_template_part('template-parts/testimonials'); ?>

    <?php get_template_part('template-parts/faq'); ?>

    <?php get_template_part('template-parts/cta'); ?>

</main>

<?php get_footer(); ?>