<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package OrthoSmile
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e('Oops! Cette page n\'existe pas.', 'orthosmile'); ?></h1>
            </header>

            <div class="page-content">
                <p><?php esc_html_e('Il semble que la page que vous recherchez ait été déplacée, renommée ou supprimée.', 'orthosmile'); ?></p>

                <div class="error-actions">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                        <?php esc_html_e('Retour à l\'accueil', 'orthosmile'); ?>
                    </a>
                    <a href="#contact" class="btn btn-secondary">
                        <?php esc_html_e('Nous contacter', 'orthosmile'); ?>
                    </a>
                </div>

                <div class="error-search">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </section>
    </div>
</main>

<?php
get_footer();