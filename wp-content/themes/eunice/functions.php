<?php
/*
 * Eunice Theme's Functions
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

/**
 * Define - Folder Paths
 */
define( 'EUNICE_THEMEROOT_PATH', get_template_directory() );
define( 'EUNICE_THEMEROOT_URI', get_template_directory_uri() );
define( 'EUNICE_CSS', EUNICE_THEMEROOT_URI . '/assets/css' );
define( 'EUNICE_IMAGES', EUNICE_THEMEROOT_URI . '/assets/images' );
define( 'EUNICE_SCRIPTS', EUNICE_THEMEROOT_URI . '/assets/js' );
define( 'EUNICE_FRAMEWORK', get_template_directory() . '/inc' );
define( 'EUNICE_LAYOUT', get_template_directory() . '/layouts' );
define( 'EUNICE_CS_IMAGES', EUNICE_THEMEROOT_URI . '/inc/theme-options/theme-extend/images' );
define( 'EUNICE_CS_FRAMEWORK', get_template_directory() . '/inc/theme-options/theme-extend' ); // Called in Icons field *.json
define( 'EUNICE_ADMIN_PATH', get_template_directory() . '/inc/theme-options/cs-framework' ); // Called in Icons field *.json

/**
 * Define - Global Theme Info's
 */
if (is_child_theme()) { // If Child Theme Active
	$eunice_theme_child = wp_get_theme();
	$eunice_get_parent = $eunice_theme_child->Template;
	$eunice_theme = wp_get_theme($eunice_get_parent);
} else { // Parent Theme Active
	$eunice_theme = wp_get_theme();
}
define('EUNICE_NAME', $eunice_theme->get( 'Name' ));
define('EUNICE_VERSION', $eunice_theme->get( 'Version' ));
define('EUNICE_BRAND_URL', $eunice_theme->get( 'AuthorURI' ));
define('EUNICE_BRAND_NAME', $eunice_theme->get( 'Author' ));

/**
 * All Main Files Include
 */
require_once( EUNICE_FRAMEWORK . '/init.php' );