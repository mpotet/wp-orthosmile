<?php
/**
 * Template part: Footer content.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) exit;

$cabinet_name  = get_theme_mod('cabinet_name', get_bloginfo('name'));
$footer_desc   = get_theme_mod('footer_description', '');
$footer_legal  = get_theme_mod('footer_legal', '');
$phone         = get_theme_mod('phone_number', '');
$email         = get_theme_mod('contact_email', '');
$address       = get_theme_mod('contact_address', '');
$hours         = get_theme_mod('opening_hours', '');
$rdv_url       = orthosmile_get_appointment_url();

$socials = [
    'facebook'  => ['url' => get_theme_mod('facebook_url', ''),  'icon' => 'group',           'label' => 'Facebook'],
    'instagram' => ['url' => get_theme_mod('instagram_url', ''), 'icon' => 'photo_camera',     'label' => 'Instagram'],
    'linkedin'  => ['url' => get_theme_mod('linkedin_url', ''),  'icon' => 'business_center',  'label' => 'LinkedIn'],
    'youtube'   => ['url' => get_theme_mod('youtube_url', ''),   'icon' => 'play_circle',      'label' => 'YouTube'],
];
?>

<footer class="site-footer" id="colophon" role="contentinfo">
    <div class="container">
        <div class="footer-grid">

            <!-- Brand column -->
            <div class="footer-brand">
                <?php if (has_custom_logo()) : ?>
                    <div style="filter:brightness(0) invert(1);opacity:.85;margin-bottom:.875rem;max-width:160px;">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo">
                        <?php echo esc_html($cabinet_name); ?>
                    </a>
                <?php endif; ?>

                <?php if ($footer_desc) : ?>
                    <p class="footer-description"><?php echo esc_html($footer_desc); ?></p>
                <?php else : ?>
                    <p class="footer-description"><?php esc_html_e('Cabinet d\'orthodontie spécialisé, offrant des traitements sur mesure pour tous les âges.', 'orthosmile'); ?></p>
                <?php endif; ?>

                <?php
                $has_social = array_filter(array_column($socials, 'url'));
                if ($has_social) : ?>
                <div class="footer-socials">
                    <?php foreach ($socials as $social) : ?>
                        <?php if ($social['url']) : ?>
                        <a href="<?php echo esc_url($social['url']); ?>"
                           target="_blank" rel="noopener noreferrer"
                           class="footer-social-link"
                           aria-label="<?php echo esc_attr($social['label']); ?>">
                            <span class="material-symbols-outlined" aria-hidden="true"><?php echo esc_html($social['icon']); ?></span>
                        </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Navigation column -->
            <div class="footer-col">
                <h4><?php esc_html_e('Navigation', 'orthosmile'); ?></h4>
                <?php if (has_nav_menu('footer')) : ?>
                    <?php wp_nav_menu([
                        'theme_location' => 'footer',
                        'container'      => false,
                        'menu_class'     => 'footer-links',
                        'depth'          => 1,
                        'fallback_cb'    => false,
                    ]); ?>
                <?php else : ?>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url(home_url('/')); ?>">
                            <span class="material-symbols-outlined">chevron_right</span>
                            <?php esc_html_e('Accueil', 'orthosmile'); ?>
                        </a></li>
                        <li><a href="#services">
                            <span class="material-symbols-outlined">chevron_right</span>
                            <?php esc_html_e('Traitements', 'orthosmile'); ?>
                        </a></li>
                        <li><a href="#team">
                            <span class="material-symbols-outlined">chevron_right</span>
                            <?php esc_html_e('Notre équipe', 'orthosmile'); ?>
                        </a></li>
                        <li><a href="#faq">
                            <span class="material-symbols-outlined">chevron_right</span>
                            <?php esc_html_e('FAQ', 'orthosmile'); ?>
                        </a></li>
                    </ul>
                <?php endif; ?>
            </div>

            <!-- Services column -->
            <div class="footer-col">
                <h4><?php esc_html_e('Traitements', 'orthosmile'); ?></h4>
                <ul class="footer-links">
                    <?php
                    $traitements = get_posts(['post_type' => 'traitement', 'numberposts' => 5, 'orderby' => 'menu_order', 'order' => 'ASC']);
                    if ($traitements) :
                        foreach ($traitements as $traitement) :
                    ?>
                    <li><a href="#services">
                        <span class="material-symbols-outlined">chevron_right</span>
                        <?php echo esc_html($traitement->post_title); ?>
                    </a></li>
                    <?php endforeach; else : ?>
                    <li><a href="#services"><span class="material-symbols-outlined">chevron_right</span><?php esc_html_e('Orthodontie adulte', 'orthosmile'); ?></a></li>
                    <li><a href="#services"><span class="material-symbols-outlined">chevron_right</span><?php esc_html_e('Orthodontie enfant', 'orthosmile'); ?></a></li>
                    <li><a href="#services"><span class="material-symbols-outlined">chevron_right</span>Invisalign</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Contact column -->
            <div class="footer-col">
                <h4><?php esc_html_e('Contact', 'orthosmile'); ?></h4>
                <ul class="footer-contact-list">
                    <?php if ($address) : ?>
                    <li>
                        <span class="material-symbols-outlined" aria-hidden="true">location_on</span>
                        <span><?php echo esc_html($address); ?></span>
                    </li>
                    <?php endif; ?>
                    <?php if ($phone) : ?>
                    <li>
                        <span class="material-symbols-outlined" aria-hidden="true">call</span>
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>">
                            <?php echo esc_html($phone); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if ($email) : ?>
                    <li>
                        <span class="material-symbols-outlined" aria-hidden="true">mail</span>
                        <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if ($hours) : ?>
                    <li>
                        <span class="material-symbols-outlined" aria-hidden="true">schedule</span>
                        <span><?php echo esc_html($hours); ?></span>
                    </li>
                    <?php endif; ?>
                </ul>

                <?php if ($rdv_url) : ?>
                <a href="<?php echo esc_url($rdv_url); ?>" class="btn btn-primary btn-sm" style="margin-top:1.25rem;">
                    <span class="material-symbols-outlined" aria-hidden="true">calendar_month</span>
                    <?php esc_html_e('Prendre rendez-vous', 'orthosmile'); ?>
                </a>
                <?php endif; ?>
            </div>
        </div><!-- .footer-grid -->

        <!-- Footer bottom bar -->
        <div class="footer-bottom">
            <p class="footer-legal">
                &copy; <?php echo date('Y'); ?> <?php echo esc_html($cabinet_name); ?>.
                <?php esc_html_e('Tous droits réservés.', 'orthosmile'); ?>
                <?php if ($footer_legal) : ?>
                    &mdash; <?php echo esc_html($footer_legal); ?>
                <?php endif; ?>
            </p>
            <p class="footer-legal">
                <?php esc_html_e('Thème', 'orthosmile'); ?>
                <a href="<?php echo esc_url(home_url('/mentions-legales')); ?>"><?php esc_html_e('Mentions légales', 'orthosmile'); ?></a>
                &middot;
                <a href="<?php echo esc_url(home_url('/politique-confidentialite')); ?>"><?php esc_html_e('Confidentialité', 'orthosmile'); ?></a>
            </p>
        </div>
    </div>
</footer>
