<?php
/**
 * Template part for displaying the footer.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) {
    exit;
}

$social_links = orthosmile_get_social_links();
?>

<footer class="site-footer" role="contentinfo">
    <div class="container">
        <div class="footer-container">
            <div class="footer-section">
                <div class="footer-logo"><?php bloginfo('name'); ?></div>
                <p class="footer-description">
                    <?php esc_html_e('Votre partenaire de confiance pour des soins orthodontiques de qualité. Des traitements personnalisés pour des sourires naturels et durables.', 'orthosmile'); ?>
                </p>
                <div class="footer-social">
                    <?php foreach ($social_links as $social) : ?>
                        <a href="<?php echo esc_url($social['url']); ?>" aria-label="<?php echo esc_attr($social['label']); ?>">
                            <span class="material-symbols-outlined"><?php echo esc_html($social['icon']); ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="footer-section">
                <h3><?php esc_html_e('Services', 'orthosmile'); ?></h3>
                <ul class="footer-links">
                    <li><a href="#services"><?php esc_html_e('Orthodontie Adulte', 'orthosmile'); ?></a></li>
                    <li><a href="#services"><?php esc_html_e('Orthodontie Enfant', 'orthosmile'); ?></a></li>
                    <li><a href="#services"><?php esc_html_e('Invisalign', 'orthosmile'); ?></a></li>
                    <li><a href="#services"><?php esc_html_e('Appareils Fixes', 'orthosmile'); ?></a></li>
                    <li><a href="#services"><?php esc_html_e('Retenue Orthodontique', 'orthosmile'); ?></a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3><?php esc_html_e('Informations', 'orthosmile'); ?></h3>
                <ul class="footer-links">
                    <li><a href="#team"><?php esc_html_e('Notre Équipe', 'orthosmile'); ?></a></li>
                    <li><a href="#faq"><?php esc_html_e('FAQ', 'orthosmile'); ?></a></li>
                    <li><a href="#gallery"><?php esc_html_e('Galerie', 'orthosmile'); ?></a></li>
                    <li><a href="#contact"><?php esc_html_e('Contact', 'orthosmile'); ?></a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3><?php esc_html_e('Contact', 'orthosmile'); ?></h3>
                <ul class="footer-links">
                    <li>
                        <span class="material-symbols-outlined">call</span>
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', orthosmile_get_phone())); ?>">
                            <?php echo esc_html(orthosmile_get_phone()); ?>
                        </a>
                    </li>
                    <li>
                        <span class="material-symbols-outlined">email</span>
                        <a href="mailto:<?php echo esc_attr(orthosmile_get_option('contact_email', 'contact@orthosmile.fr')); ?>">
                            <?php echo esc_html(orthosmile_get_option('contact_email', 'contact@orthosmile.fr')); ?>
                        </a>
                    </li>
                    <li>
                        <span class="material-symbols-outlined">location_on</span>
                        <?php echo esc_html(orthosmile_get_option('contact_address', '123 Rue de la Santé, 75000 Paris')); ?>
                    </li>
                </ul>
                
                <div class="footer-newsletter">
                    <h4><?php esc_html_e('Newsletter', 'orthosmile'); ?></h4>
                    <p><?php esc_html_e('Restez informé de nos actualités et conseils orthodontiques.', 'orthosmile'); ?></p>
                    <form class="newsletter-form">
                        <input type="email" class="newsletter-input" placeholder="<?php esc_attr_e('Votre email', 'orthosmile'); ?>" required>
                        <button type="submit" class="btn btn-secondary"><?php esc_html_e('S\'abonner', 'orthosmile'); ?></button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p class="site-legal">
                &copy; <?php echo esc_html(date('Y')); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('Tous droits réservés.', 'orthosmile'); ?>
                | 
                <a href="<?php echo esc_url(get_privacy_policy_url()); ?>"><?php esc_html_e('Politique de confidentialité', 'orthosmile'); ?></a>
                | 
                <a href="<?php echo esc_url(get_page_link(get_page_by_path('mentions-legales'))); ?>"><?php esc_html_e('Mentions légales', 'orthosmile'); ?></a>
            </p>
        </div>
    </div>
</footer>