<?php
/**
 * Header global - doctype, head, top ribbon, navigation.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) exit;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
$phone     = get_theme_mod('phone_number', '');
$email     = get_theme_mod('contact_email', '');
$hours     = get_theme_mod('opening_hours', '');
$rdv_url   = orthosmile_get_appointment_url();
$fb_url    = get_theme_mod('facebook_url', '');
$ig_url    = get_theme_mod('instagram_url', '');
$li_url    = get_theme_mod('linkedin_url', '');
?>

<!-- ── Top Ribbon ────────────────────────────────── -->
<div class="site-ribbon" role="banner">
    <div class="container ribbon-inner">

        <div class="ribbon-contacts">
            <?php if ($phone) : ?>
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="ribbon-contact">
                    <span class="material-symbols-outlined" aria-hidden="true">call</span>
                    <span><?php echo esc_html($phone); ?></span>
                </a>
            <?php endif; ?>
            <?php if ($email) : ?>
                <a href="mailto:<?php echo esc_attr($email); ?>" class="ribbon-contact">
                    <span class="material-symbols-outlined" aria-hidden="true">mail</span>
                    <span><?php echo esc_html($email); ?></span>
                </a>
            <?php endif; ?>
            <?php if ($hours) : ?>
                <span class="ribbon-hours">
                    <span class="material-symbols-outlined" aria-hidden="true">schedule</span>
                    <span><?php echo esc_html($hours); ?></span>
                </span>
            <?php endif; ?>
        </div>

        <div class="ribbon-actions">
            <?php if ($fb_url || $ig_url || $li_url) : ?>
            <div class="ribbon-social">
                <?php if ($fb_url) : ?>
                    <a href="<?php echo esc_url($fb_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                        <span class="material-symbols-outlined">group</span>
                    </a>
                <?php endif; ?>
                <?php if ($ig_url) : ?>
                    <a href="<?php echo esc_url($ig_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                        <span class="material-symbols-outlined">photo_camera</span>
                    </a>
                <?php endif; ?>
                <?php if ($li_url) : ?>
                    <a href="<?php echo esc_url($li_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                        <span class="material-symbols-outlined">business_center</span>
                    </a>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <a href="<?php echo esc_url($rdv_url); ?>" class="ribbon-cta">
                <span class="material-symbols-outlined" aria-hidden="true">calendar_month</span>
                <?php esc_html_e('Prendre rendez-vous', 'orthosmile'); ?>
            </a>
        </div>
    </div>
</div>

<!-- ── Main Header ───────────────────────────────── -->
<header id="masthead" class="site-header" role="banner">
    <div class="header-inner">

        <!-- Logo / Branding -->
        <div class="site-branding">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else :
                $cabinet_name = get_theme_mod('cabinet_name', get_bloginfo('name'));
                $cabinet_slogan = get_theme_mod('cabinet_slogan', get_bloginfo('description'));
            ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="site-name">
                    <?php echo esc_html($cabinet_name ?: get_bloginfo('name')); ?>
                </a>
                <?php if ($cabinet_slogan) : ?>
                    <span class="site-tagline"><?php echo esc_html($cabinet_slogan); ?></span>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <!-- Navigation -->
        <nav class="site-navigation" id="site-navigation"
             aria-label="<?php esc_attr_e('Navigation principale', 'orthosmile'); ?>">
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
                    <span class="material-symbols-outlined" aria-hidden="true">call</span>
                    <span><?php echo esc_html($phone); ?></span>
                </a>
            <?php endif; ?>
            <a href="<?php echo esc_url($rdv_url); ?>" class="btn-appointment">
                <?php esc_html_e('Rendez-vous', 'orthosmile'); ?>
            </a>
        </div>

        <!-- Mobile toggle -->
        <button class="menu-toggle" aria-controls="site-navigation" aria-expanded="false"
                aria-label="<?php esc_attr_e('Ouvrir le menu', 'orthosmile'); ?>">
            <span class="material-symbols-outlined" aria-hidden="true">menu</span>
        </button>
    </div>
</header>
