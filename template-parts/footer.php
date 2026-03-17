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
    'facebook'  => [
        'url'   => get_theme_mod('facebook_url', ''),
        'label' => 'Facebook',
        'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
    ],
    'instagram' => [
        'url'   => get_theme_mod('instagram_url', ''),
        'label' => 'Instagram',
        'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>',
    ],
    'linkedin'  => [
        'url'   => get_theme_mod('linkedin_url', ''),
        'label' => 'LinkedIn',
        'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>',
    ],
    'youtube'   => [
        'url'   => get_theme_mod('youtube_url', ''),
        'label' => 'YouTube',
        'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>',
    ],
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
                            <?php echo $social['svg']; ?>
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
                        <?php wp_list_pages([
                            'title_li' => '',
                            'depth'    => 1,
                        ]); ?>
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
                    <li><a href="#services"><?php echo esc_html($traitement->post_title); ?></a></li>
                    <?php endforeach; else : ?>
                    <li><a href="#services"><?php esc_html_e('Orthodontie adulte', 'orthosmile'); ?></a></li>
                    <li><a href="#services"><?php esc_html_e('Orthodontie enfant', 'orthosmile'); ?></a></li>
                    <li><a href="#services">Invisalign</a></li>
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
                <a href="<?php echo esc_url(home_url('/mentions-legales')); ?>"><?php esc_html_e('Mentions légales', 'orthosmile'); ?></a>
                &middot;
                <a href="<?php echo esc_url(home_url('/politique-confidentialite')); ?>"><?php esc_html_e('Confidentialité', 'orthosmile'); ?></a>
            </p>
        </div>
    </div>
</footer>
