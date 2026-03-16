<?php
/**
 * The main template file.
 *
 * @package OrthoSmile
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title">
                <?php
                if (is_home() && !is_front_page()) {
                    single_post_title();
                } elseif (is_home()) {
                    _e('Derniers Articles', 'orthosmile');
                }
                ?>
            </h1>
        </header>

        <?php
        if (have_posts()) :
            echo '<div class="blog-grid">';

            while (have_posts()) :
                the_post();
                get_template_part('template-parts/content', get_post_type());
            endwhile;

            echo '</div>';

            the_posts_pagination([
                'prev_text' => '<span class="material-symbols-outlined">arrow_back</span><span>' . __('Précédent', 'orthosmile') . '</span>',
                'next_text' => '<span>' . __('Suivant', 'orthosmile') . '</span><span class="material-symbols-outlined">arrow_forward</span>',
            ]);

        else :
            get_template_part('template-parts/content', 'none');
        endif;
        ?>
    </div>
</main>

<?php
get_footer();