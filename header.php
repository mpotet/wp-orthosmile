<?php
/**
 * Role: en-tete global (doctype, head, navigation).
 *
 * @package OrthoSmile
 */

if (! defined('ABSPATH')) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Top Ribbon -->
<div class="site-ribbon" role="banner">
    <div class="container ribbon-inner">
        <div class="ribbon-contacts">
            <?php
            $phone = orthosmile_get_phone();
            $email = get_theme_mod('contact_email', '');
            $hours = orthosmile_get_opening_hours();
            if ($phone) : ?>
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="ribbon-contact">
                    <span class="material-symbols-outlined">call</span>
                    <span><?php echo esc_html($phone); ?></span>
                </a>
            <?php endif;
            if ($email) : ?>
                <a href="mailto:<?php echo esc_attr($email); ?>" class="ribbon-contact">
                    <span class="material-symbols-outlined">mail</span>
                    <span><?php echo esc_html($email); ?></span>
                </a>
            <?php endif;
            if ($hours) : ?>
                <span class="ribbon-hours">
                    <span class="material-symbols-outlined">schedule</span>
                    <span><?php echo esc_html($hours); ?></span>
                </span>
            <?php endif; ?>
        </div>

        <div class="ribbon-actions">
            <?php
            $social_platforms = [
                'facebook'  => ['icon' => 'group',    'key' => 'orthosmile_facebook'],
                'instagram' => ['icon' => 'photo_camera', 'key' => 'orthosmile_instagram'],
                'linkedin'  => ['icon' => 'business_center', 'key' => 'orthosmile_linkedin'],
            ];
            $has_social = false;
            foreach ($social_platforms as $platform => $info) {
                $url = get_theme_mod($info['key'], '');
                if ($url) {
                    if (!$has_social) { echo '<div class="ribbon-social">'; $has_social = true; }
                    printf(
                        '<a href="%s" target="_blank" rel="noopener noreferrer" aria-label="%s"><span class="material-symbols-outlined">%s</span></a>',
                        esc_url($url), esc_attr(ucfirst($platform)), esc_html($info['icon'])
                    );
                }
            }
            if ($has_social) { echo '</div>'; }
            ?>
            <a href="<?php echo esc_url(orthosmile_get_appointment_url()); ?>" class="ribbon-cta">
                <span class="material-symbols-outlined">calendar_month</span>
                <?php esc_html_e('Prendre rendez-vous', 'orthosmile'); ?>
            </a>
        </div>
    </div>
</div>

<!-- Main Header -->
<header id="masthead" class="site-header" role="banner">
    <div class="header-inner">
        <!-- Logo / branding -->
        <div class="site-branding">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="site-name">
                    <?php bloginfo('name'); ?>
                </a>
                <?php
                $tagline = get_theme_mod('orthosmile_tagline', get_bloginfo('description'));
                if ($tagline) : ?>
                    <span class="site-tagline"><?php echo esc_html($tagline); ?></span>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <!-- Navigation -->
        <nav class="site-navigation" id="site-navigation" aria-label="<?php esc_attr_e('Navigation principale', 'orthosmile'); ?>">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'main-menu',
                'fallback_cb'    => 'orthosmile_primary_menu_fallback',
                'items_wrap'     => '<ul class="main-menu" id="primary-menu">%3$s</ul>',
            ]);
            ?>
        </nav>

        <!-- Desktop CTA -->
        <div class="header-cta-group">
            <?php if ($phone) : ?>
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="header-phone-btn">
                    <span class="material-symbols-outlined">call</span>
                    <span><?php echo esc_html($phone); ?></span>
                </a>
            <?php endif; ?>
            <a href="<?php echo esc_url(orthosmile_get_appointment_url()); ?>" class="btn-appointment">
                <?php esc_html_e('Rendez-vous', 'orthosmile'); ?>
            </a>
        </div>

        <!-- Mobile toggle -->
        <button class="menu-toggle" aria-controls="site-navigation" aria-expanded="false"
                aria-label="<?php esc_attr_e('Ouvrir le menu', 'orthosmile'); ?>">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>
</header>
