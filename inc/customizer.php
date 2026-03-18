<?php
/**
 * OrthoSmile — inc/customizer.php
 *
 * Le WP Customizer n'est plus utilisé.
 * Tous les réglages sont gérés dans le panel admin custom :
 * Tableau de bord → ⚙️ OrthoSmile → Paramètres du thème
 *
 * Les valeurs déjà sauvegardées dans theme_mods restent lisibles via
 * orthosmile_get_option() (fallback get_theme_mod()).
 *
 * @package OrthoSmile
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Injection des couleurs dynamiques depuis l'admin.
 * Si aucune couleur n'est configurée, rien n'est injecté
 * et main.css conserve ses valeurs d'origine.
 */
function orthosmile_inject_dynamic_colors() {
	$primary = get_option( 'orthosmile_color_primary', '' );
	if ( empty( $primary ) ) return;

	$teal_dark       = orthosmile_adjust_color( $primary, -20 );
	$teal_deep       = orthosmile_adjust_color( $primary, -40 );
	$teal_light      = orthosmile_adjust_color( $primary, 100 );
	$teal_ultralight = orthosmile_adjust_color( $primary, 170 );
	$bg_dark         = orthosmile_adjust_color( $primary, -60 );

	$hex = ltrim( $primary, '#' );
	$rgb = hexdec( substr( $hex, 0, 2 ) ) . ',' . hexdec( substr( $hex, 2, 2 ) ) . ',' . hexdec( substr( $hex, 4, 2 ) );

	echo '<style id="orthosmile-dynamic-colors">:root{'
		. '--color-teal:'            . esc_attr( $primary )         . ';'
		. '--color-teal-dark:'       . esc_attr( $teal_dark )       . ';'
		. '--color-teal-deep:'       . esc_attr( $teal_deep )       . ';'
		. '--color-teal-light:'      . esc_attr( $teal_light )      . ';'
		. '--color-teal-ultralight:' . esc_attr( $teal_ultralight ) . ';'
		. '--color-teal-rgb:'        . $rgb                         . ';'
		. '--color-bg-section:'      . esc_attr( $teal_ultralight ) . ';'
		. '--color-bg-dark:'         . esc_attr( $bg_dark )         . ';'
		. '}</style>' . "\n";
}
add_action( 'wp_head', 'orthosmile_inject_dynamic_colors', 20 );

/**
 * Ajuste la luminosité d'une couleur hexadécimale.
 * @param string $hex   Couleur (#RRGGBB ou #RGB)
 * @param int    $steps -255 à +255
 * @return string
 */
function orthosmile_adjust_color( $hex, $steps ) {
	$hex = ltrim( $hex, '#' );
	if ( strlen( $hex ) === 3 ) {
		$hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
	}
	$r = max( 0, min( 255, hexdec( substr( $hex, 0, 2 ) ) + $steps ) );
	$g = max( 0, min( 255, hexdec( substr( $hex, 2, 2 ) ) + $steps ) );
	$b = max( 0, min( 255, hexdec( substr( $hex, 4, 2 ) ) + $steps ) );
	return sprintf( '#%02x%02x%02x', $r, $g, $b );
}
