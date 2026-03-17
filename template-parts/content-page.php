<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @package OrthoSmile
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php orthosmile_post_thumbnail(); ?>

    <div class="entry-content">
        <?php
        the_content();
        wp_link_pages([
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'orthosmile'),
            'after'  => '</div>',
        ]);
        ?>
    </div>

    <?php if (get_edit_post_link()) : ?>
        <footer class="entry-footer">
            <?php edit_post_link(
                sprintf(
                    wp_kses(
                        __('Modifier <span class="screen-reader-text">%s</span>', 'orthosmile'),
                        ['span' => ['class' => []]]
                    ),
                    wp_kses_post(get_the_title())
                ),
                '<span class="edit-link">',
                '</span>'
            ); ?>
        </footer>
    <?php endif; ?>

</article>
