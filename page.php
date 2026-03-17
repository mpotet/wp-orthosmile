<?php
/**
 * Template for displaying pages.
 *
 * @package OrthoSmile
 */

get_header();
while (have_posts()) : the_post();
?>

<section class="page-banner">
    <div class="container">
        <h1 class="page-banner-title"><?php the_title(); ?></h1>
        <nav class="breadcrumb" aria-label="<?php esc_attr_e('Fil d\'Ariane', 'orthosmile'); ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Accueil', 'orthosmile'); ?></a>
            <span class="sep" aria-hidden="true">/</span>
            <span><?php the_title(); ?></span>
        </nav>
    </div>
</section>

<main id="primary" class="site-main">
    <div class="container">
        <div class="page-body">
            <?php get_template_part('template-parts/content', 'page'); ?>
            <?php if (comments_open() || get_comments_number()) comments_template(); ?>
        </div>
    </div>
</main>

<?php
endwhile;
get_footer();
