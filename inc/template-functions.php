<?php
/**
 * Custom template functions for this theme.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get theme option with fallback.
 *
 * @param string $key Option key.
 * @param mixed  $default Default value.
 * @return mixed
 */
function orthosmile_get_option($key, $default = false) {
    $value = get_theme_mod($key, $default);
    
    // If value is empty and we have a default, return default
    if (empty($value) && $default !== false) {
        return $default;
    }
    
    return $value;
}

/**
 * Get phone number from theme options.
 *
 * @return string
 */
function orthosmile_get_phone() {
    return orthosmile_get_option('phone_number', '');
}

/**
 * Get opening hours from theme options.
 *
 * @return string
 */
function orthosmile_get_opening_hours() {
    return orthosmile_get_option('opening_hours', '');
}

/**
 * Get appointment URL from theme options.
 *
 * @return string
 */
function orthosmile_get_appointment_url() {
    $url = orthosmile_get_option('appointment_url');
    if ($url) {
        return $url;
    }
    
    // Fallback to contact page
    $contact_page = get_page_by_path('contact');
    if ($contact_page) {
        return get_permalink($contact_page->ID);
    }
    
    return '#';
}

/**
 * Get social media links.
 *
 * @return array
 */
function orthosmile_get_social_links() {
    $social_links = [];
    
    $facebook = orthosmile_get_option('facebook_url');
    $twitter = orthosmile_get_option('twitter_url');
    $instagram = orthosmile_get_option('instagram_url');
    $linkedin = orthosmile_get_option('linkedin_url');
    
    if ($facebook) {
        $social_links['facebook'] = [
            'url' => $facebook,
            'icon' => 'facebook',
            'label' => 'Facebook'
        ];
    }
    
    if ($twitter) {
        $social_links['twitter'] = [
            'url' => $twitter,
            'icon' => 'twitter',
            'label' => 'Twitter'
        ];
    }
    
    if ($instagram) {
        $social_links['instagram'] = [
            'url' => $instagram,
            'icon' => 'instagram',
            'label' => 'Instagram'
        ];
    }
    
    if ($linkedin) {
        $social_links['linkedin'] = [
            'url' => $linkedin,
            'icon' => 'linkedin',
            'label' => 'LinkedIn'
        ];
    }
    
    return $social_links;
}

/**
 * Get primary color from theme options.
 *
 * @return string
 */
function orthosmile_get_primary_color() {
    return orthosmile_get_option('primary_color', '#0f766e');
}

/**
 * Get accent color from theme options.
 *
 * @return string
 */
function orthosmile_get_accent_color() {
    return orthosmile_get_option('accent_color', '#d9c4a1');
}

/**
 * Check if a section should be shown.
 *
 * @param string $section Section key.
 * @param bool   $default Default value.
 * @return bool
 */
function orthosmile_show_section($section, $default = true) {
    return orthosmile_get_option('show_' . $section, $default);
}

/**
 * Get hero section content.
 *
 * @return array
 */
function orthosmile_get_hero_content() {
    return [
        'title' => orthosmile_get_option('hero_title', 'XXXX — Titre principal'),
        'subtitle' => orthosmile_get_option('hero_subtitle', 'XXXX — Sous-titre'),
        'cta_text' => orthosmile_get_option('hero_cta_text', 'Prendre rendez-vous'),
        'cta_url' => orthosmile_get_option('hero_cta_url', orthosmile_get_appointment_url()),
        'image' => orthosmile_get_option('hero_image'),
    ];
}

/**
 * Get trust section content.
 *
 * @return array
 */
function orthosmile_get_trust_content() {
    return [
        'title' => orthosmile_get_option('trust_title', 'XXXX — Titre section confiance'),
        'subtitle' => orthosmile_get_option('trust_subtitle', 'XXXX — Sous-titre section confiance'),
        'items' => [
            [
                'value' => orthosmile_get_option('trust_1_value', 'XXXX'),
                'label' => orthosmile_get_option('trust_1_label', 'XXXX — Légende 1'),
                'icon' => 'workspace_premium'
            ],
            [
                'value' => orthosmile_get_option('trust_2_value', 'XXXX'),
                'label' => orthosmile_get_option('trust_2_label', 'XXXX — Légende 2'),
                'icon' => 'groups'
            ],
            [
                'value' => orthosmile_get_option('trust_3_value', 'XXXX'),
                'label' => orthosmile_get_option('trust_3_label', 'XXXX — Légende 3'),
                'icon' => 'health_and_safety'
            ]
        ]
    ];
}

/**
 * Get contact information.
 *
 * @return array
 */
function orthosmile_get_contact_info() {
    return [
        'address'       => orthosmile_get_option('contact_address', 'XXXX — Adresse du cabinet'),
        'phone'         => orthosmile_get_phone(),
        'email'         => orthosmile_get_option('contact_email', ''),
        'opening_hours' => orthosmile_get_opening_hours(),
        'map_embed'     => orthosmile_get_option('contact_map_embed'),
    ];
}

/**
 * Generate inline CSS for dynamic colors.
 *
 * @return string
 */
function orthosmile_get_inline_styles() {
    $primary_color = orthosmile_get_primary_color();
    $accent_color = orthosmile_get_accent_color();
    
    $styles = "
        :root {
            --os-primary: {$primary_color};
            --os-accent: {$accent_color};
            --os-primary-dark: " . orthosmile_darken_color($primary_color, 10) . ";
        }
    ";
    
    return $styles;
}

/**
 * Darken a hex color.
 *
 * @param string $hex Color in hex format.
 * @param int    $percent Percentage to darken.
 * @return string
 */
function orthosmile_darken_color($hex, $percent) {
    // Remove # if present
    $hex = str_replace('#', '', $hex);
    
    // Convert to decimal
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    
    // Darken
    $r = round($r * (100 - $percent) / 100);
    $g = round($g * (100 - $percent) / 100);
    $b = round($b * (100 - $percent) / 100);
    
    // Convert back to hex
    $r = ($r < 255) ? dechex($r) : 'ff';
    $g = ($g < 255) ? dechex($g) : 'ff';
    $b = ($b < 255) ? dechex($b) : 'ff';
    
    // Add leading zeros if necessary
    $color = (strlen($r) < 2) ? '0' . $r : $r;
    $color .= (strlen($g) < 2) ? '0' . $g : $g;
    $color .= (strlen($b) < 2) ? '0' . $b : $b;
    
    return '#' . $color;
}

/**
 * Add inline styles to head.
 */
function orthosmile_add_inline_styles() {
    echo '<style type="text/css">' . orthosmile_get_inline_styles() . '</style>';
}
add_action('wp_head', 'orthosmile_add_inline_styles');

/**
 * Custom navigation fallback.
 */
function orthosmile_primary_menu_fallback() {
    echo '<ul class="menu-fallback">';
    wp_list_pages([
        'title_li' => '',
        'depth'    => 1,
    ]);
    echo '</ul>';
}