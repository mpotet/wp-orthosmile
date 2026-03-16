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

<!-- Premium Ribbon Header -->
<header id="masthead" class="site-header">
    <!-- Top Ribbon -->
    <div class="premium-ribbon">
        <div class="container">
            <div class="ribbon-content">
                <div class="ribbon-left">
                    <div class="ribbon-item">
                        <span class="material-symbols-outlined ribbon-icon">call</span>
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', orthosmile_get_phone())); ?>" class="ribbon-link">
                            <?php echo esc_html(orthosmile_get_phone()); ?>
                        </a>
                    </div>
                    <div class="ribbon-item">
                        <span class="material-symbols-outlined ribbon-icon">schedule</span>
                        <span class="ribbon-text"><?php echo esc_html(orthosmile_get_opening_hours()); ?></span>
                    </div>
                    <div class="ribbon-item">
                        <span class="material-symbols-outlined ribbon-icon">location_on</span>
                        <span class="ribbon-text"><?php echo esc_html(get_theme_mod('orthosmile_address', 'Paris')); ?></span>
                    </div>
                </div>
                <div class="ribbon-right">
                    <div class="social-links">
                        <?php
                        $social_links = [
                            'facebook' => get_theme_mod('orthosmile_facebook'),
                            'twitter' => get_theme_mod('orthosmile_twitter'),
                            'instagram' => get_theme_mod('orthosmile_instagram'),
                            'linkedin' => get_theme_mod('orthosmile_linkedin'),
                        ];
                        
                        foreach ($social_links as $platform => $url) {
                            if ($url) {
                                echo '<a href="' . esc_url($url) . '" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="' . ucfirst($platform) . '">';
                                echo '<span class="material-symbols-outlined">' . $platform . '</span>';
                                echo '</a>';
                            }
                        }
                        ?>
                    </div>
                    <div class="ribbon-actions">
                        <a href="<?php echo esc_url(orthosmile_get_appointment_url()); ?>" class="btn btn-outline ribbon-btn">
                            <span class="material-symbols-outlined">calendar_today</span>
                            Prendre rendez-vous
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="main-header">
        <div class="container">
            <div class="header-content">
                <div class="site-branding" itemprop="name">
                    <div class="brand-lockup">
                        <?php
                        if (has_custom_logo()) {
                            the_custom_logo();
                        } else {
                            ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <span class="brand-name"><?php bloginfo('name'); ?></span>
                                <span class="brand-tagline"><?php echo esc_html(get_theme_mod('orthosmile_tagline', 'Orthodontie de précision')); ?></span>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'orthosmile'); ?>">
                    <span class="material-symbols-outlined">menu</span>
                </button>

                <nav class="main-navigation" aria-label="<?php esc_attr_e('Navigation principale', 'orthosmile'); ?>">
                    <ul class="main-menu" id="primary-menu">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'primary',
                            'container'      => false,
                            'menu_class'     => 'main-menu',
                            'fallback_cb'    => 'orthosmile_primary_menu_fallback',
                            'items_wrap'     => '%3$s',
                        ]);
                        ?>
                    </ul>
                </nav>

                <div class="header-actions">
                    <a class="header-phone" href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', orthosmile_get_phone())); ?>">
                        <span class="material-symbols-outlined" aria-hidden="true">call</span>
                        <?php echo esc_html(orthosmile_get_phone()); ?>
                    </a>
                    <a class="btn btn-primary" href="<?php echo esc_url(orthosmile_get_appointment_url()); ?>">
                        <?php esc_html_e('Prendre rendez-vous', 'orthosmile'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>