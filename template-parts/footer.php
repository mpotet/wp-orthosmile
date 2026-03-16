<?php
/**
 * Template part for displaying the footer.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) {
    exit;
}

$phone   = orthosmile_get_phone();
$email   = get_theme_mod('contact_email', '');
$address = get_theme_mod('contact_address', '');
$hours   = orthosmile_get_opening_hours();

$social_platforms = [
    'facebook'  => ['icon' => 'group',            'key' => 'orthosmile_facebook'],
    'instagram' => ['icon' => 'photo_camera',     'key' => 'orthosmile_instagram'],
    'linkedin'  => ['icon' => 'business_center',  'key' => 'orthosmile_linkedin'],
    'youtube'   => ['icon' => 'play_circle',      'key' => 'orthosmile_youtube'],
];
?>

<footer class="site-footer" role="contentinfo">
    <div class="footer-top">
        <div class="container">
            <div class="footer-grid">

                <!-- Brand -->
                <div class="footer-brand">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo">
                        <?php bloginfo('name'); ?>
                    </a>
                    <p class="footer-description">
                        <?php esc_html_e('Votre partenaire de confiance pour des soins orthodontiques de qualité. Des traitements personnalisés pour des sourires naturels et durables.', 'orthosmile'); ?>
                    </p>
                    <div class="footer-socials">
                        <?php foreach ($social_platforms as $platform => $info) :
                            $url = get_theme_mod($info['key'], '');
                            if ($url) : ?>
                                <a href="<?php echo esc_url($url); ?>" class="footer-social-link"
                                   target="_blank" rel="noopener noreferrer"
                                   aria-label="<?php echo esc_attr(ucfirst($platform)); ?>">
                                    <span class="material-symbols-outlined"><?php echo esc_html($info['icon']); ?></span>
                                </a>
                            <?php endif;
                        endforeach; ?>
                    </div>
                </div>

                <!-- Services -->
                <div class="footer-col">
                    <h4><?php esc_html_e('Traitements', 'orthosmile'); ?></h4>
                    <ul class="footer-links">
                        <li><a href="#services"><?php esc_html_e('Orthodontie Adulte', 'orthosmile'); ?></a></li>
                        <li><a href="#services"><?php esc_html_e('Orthodontie Enfant', 'orthosmile'); ?></a></li>
                        <li><a href="#services"><?php esc_html_e('Invisalign®', 'orthosmile'); ?></a></li>
                        <li><a href="#services"><?php esc_html_e('Appareils Fixes', 'orthosmile'); ?></a></li>
                        <li><a href="#services"><?php esc_html_e('Contention', 'orthosmile'); ?></a></li>
                    </ul>
                </div>

                <!-- Cabinet -->
                <div class="footer-col">
                    <h4><?php esc_html_e('Cabinet', 'orthosmile'); ?></h4>
                    <ul class="footer-links">
                        <li><a href="#team"><?php esc_html_e('Notre Équipe', 'orthosmile'); ?></a></li>
                        <li><a href="#trust"><?php esc_html_e('Pourquoi nous', 'orthosmile'); ?></a></li>
                        <li><a href="#gallery"><?php esc_html_e('Résultats', 'orthosmile'); ?></a></li>
                        <li><a href="#testimonials"><?php esc_html_e('Témoignages', 'orthosmile'); ?></a></li>
                        <li><a href="#faq"><?php esc_html_e('FAQ', 'orthosmile'); ?></a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="footer-col">
                    <h4><?php esc_html_e('Contact', 'orthosmile'); ?></h4>
                    <ul class="footer-contact-list">
                        <?php if ($phone) : ?>
                            <li>
                                <span class="material-symbols-outlined">call</span>
                                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>">
                                    <?php echo esc_html($phone); ?>
                                </a>
                            </li>
                        <?php endif;
                        if ($email) : ?>
                            <li>
                                <span class="material-symbols-outlined">mail</span>
                                <a href="mailto:<?php echo esc_attr($email); ?>">
                                    <?php echo esc_html($email); ?>
                                </a>
                            </li>
                        <?php endif;
                        if ($address) : ?>
                            <li>
                                <span class="material-symbols-outlined">location_on</span>
                                <span><?php echo esc_html($address); ?></span>
                            </li>
                        <?php endif;
                        if ($hours) : ?>
                            <li>
                                <span class="material-symbols-outlined">schedule</span>
                                <span><?php echo esc_html($hours); ?></span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="footer-bottom">
            <p class="footer-legal">
                &copy; <?php echo esc_html(gmdate('Y')); ?> <?php bloginfo('name'); ?>.
                <?php esc_html_e('Tous droits réservés.', 'orthosmile'); ?>
                <?php if (get_privacy_policy_url()) : ?>
                    &nbsp;·&nbsp;
                    <a href="<?php echo esc_url(get_privacy_policy_url()); ?>">
                        <?php esc_html_e('Politique de confidentialité', 'orthosmile'); ?>
                    </a>
                <?php endif; ?>
                <?php
                $legal_page = get_page_by_path('mentions-legales');
                if ($legal_page) : ?>
                    &nbsp;·&nbsp;
                    <a href="<?php echo esc_url(get_permalink($legal_page)); ?>">
                        <?php esc_html_e('Mentions légales', 'orthosmile'); ?>
                    </a>
                <?php endif; ?>
            </p>
            <p class="footer-legal">
                <?php
                /* translators: theme credit */
                printf(
                    esc_html__('Thème créé avec %s', 'orthosmile'),
                    '<span style="color:#5eead4">♥</span>'
                );
                ?>
            </p>
        </div>
    </div>
</footer>
