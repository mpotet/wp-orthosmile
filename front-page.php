<?php
/**
 * Front page template.
 *
 * Used when "A static page" is set as homepage
 * (Settings > Reading > Your homepage displays > A static page).
 * Delegates to home.php to avoid duplication.
 *
 * @package OrthoSmile
 */

if ( ! defined( 'ABSPATH' ) ) exit;

require get_template_directory() . '/home.php';
