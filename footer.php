<?php
/**
 * Footer global wrapper.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) exit;
?>

<?php get_template_part('template-parts/footer'); ?>

<!-- Scroll to top -->
<button class="scroll-to-top" id="scrollToTop"
        aria-label="<?php esc_attr_e('Retour en haut de page', 'orthosmile'); ?>">
    <span class="material-symbols-outlined" aria-hidden="true">keyboard_arrow_up</span>
</button>

<?php wp_footer(); ?>
</body>
</html>