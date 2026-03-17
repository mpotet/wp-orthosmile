<?php
/**
 * Front page template.
 *
 * Used by WordPress when the front page is set to a static page
 * (Settings > Reading > Your homepage displays > A static page).
 * Delegates to the same homepage sections as home.php.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) exit;

get_header();
?>

<main id="main" class="site-main" role="main">

    <?php get_template_part('template-parts/hero'); ?>

    <?php get_template_part('template-parts/stats'); ?>

    <?php get_template_part('template-parts/doctors'); ?>

    <?php get_template_part('template-parts/services'); ?>

    <?php get_template_part('template-parts/gallery'); ?>

    <?php get_template_part('template-parts/testimonials'); ?>

    <?php get_template_part('template-parts/faq'); ?>

    <?php get_template_part('template-parts/cta'); ?>

</main>

<?php get_footer(); ?>
