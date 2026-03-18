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
    // Priorité : options du panel admin custom (orthosmile_*)
    $value = get_option('orthosmile_' . $key, null);
    if ($value !== null && $value !== '') {
        return $value;
    }

    // Fallback : theme_mods Customizer (settings existants)
    $value = get_theme_mod($key, $default);
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
 * Get contact information.
 *
 * @return array
 */
function orthosmile_get_contact_info() {
    return [
        'address'       => orthosmile_get_option('contact_address', 'XXXX - Adresse du cabinet'),
        'phone'         => orthosmile_get_phone(),
        'email'         => orthosmile_get_option('contact_email', ''),
        'opening_hours' => orthosmile_get_opening_hours(),
        'map_embed'     => orthosmile_get_option('contact_map_embed'),
    ];
}

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