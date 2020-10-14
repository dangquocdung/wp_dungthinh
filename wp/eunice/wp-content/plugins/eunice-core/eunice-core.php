<?php
/*
Plugin Name: Eunice Core
Plugin URI: https://victorthemes.com/themes/eunice
Description: Plugin to contain shortcodes and custom post types of the eunice theme.
Author: VictorThemes
Author URI: https://victorthemes.com/
Version: 1.6.2
Text Domain: eunice-core
*/

if( ! function_exists( 'eunice_block_direct_access' ) ) {
	function eunice_block_direct_access() {
		if( ! defined( 'ABSPATH' ) ) {
			exit( 'Forbidden' );
		}
	}
}

// Plugin URL
define( 'EUNICE_PLUGIN_URL', plugins_url( '/', __FILE__ ) );

// Plugin PATH
define( 'EUNICE_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'EUNICE_PLUGIN_ASTS', EUNICE_PLUGIN_URL . 'assets' );
define( 'EUNICE_PLUGIN_IMGS', EUNICE_PLUGIN_ASTS . '/images' );
define( 'EUNICE_PLUGIN_INC', EUNICE_PLUGIN_PATH . 'inc' );

// DIRECTORY SEPARATOR
define ( 'DS' , DIRECTORY_SEPARATOR );

// Eunice Shortcode Path
define( 'EUNICE_SHORTCODE_BASE_PATH', EUNICE_PLUGIN_PATH . 'visual-composer/' );
define( 'EUNICE_SHORTCODE_PATH', EUNICE_SHORTCODE_BASE_PATH . 'shortcodes/' );

/**
 * Check if Codestar Framework is Active or Not!
 */
function eunice_framework_active() {
  return ( defined( 'CS_VERSION' ) ) ? true : false;
}

/* VTHEME_NAME_P */
define('VTHEME_NAME_P', 'Eunice');

// Initial File
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('eunice-core/eunice-core.php')) {

	// Custom Post Type
	require_once( EUNICE_PLUGIN_INC . '/custom-post-type.php' );

  /* One Click Install */
  require_once( EUNICE_PLUGIN_INC . '/import/init.php' );

  // Shortcodes
  require_once( EUNICE_SHORTCODE_BASE_PATH . '/vc-setup.php' );
  if (is_plugin_active('js_composer/js_composer.php')) {
    require_once( EUNICE_SHORTCODE_BASE_PATH . '/lib/lib.php' );
  }
  require_once( EUNICE_PLUGIN_INC . '/custom-shortcodes/theme-shortcodes.php' );
  require_once( EUNICE_PLUGIN_INC . '/custom-shortcodes/custom-shortcodes.php' );

  // Widgets
  require_once( EUNICE_PLUGIN_INC . '/widgets/get-quote-widget.php' );
  require_once( EUNICE_PLUGIN_INC . '/widgets/nav-widget.php' );
  require_once( EUNICE_PLUGIN_INC . '/widgets/recent-posts.php' );
  require_once( EUNICE_PLUGIN_INC . '/widgets/testimonial-widget.php' );
  require_once( EUNICE_PLUGIN_INC . '/widgets/text-widget.php' );
  require_once( EUNICE_PLUGIN_INC . '/widgets/widget-extra-fields.php' );

}

/**
 * Plugin language
 */
function eunice_plugin_language_setup() {
  load_plugin_textdomain( 'eunice-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'eunice_plugin_language_setup' );

/* WPAUTOP for shortcode output */
if( ! function_exists( 'eunice_set_wpautop' ) ) {
  function eunice_set_wpautop( $content, $force = true ) {
    if ( $force ) {
      $content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
    }
    return do_shortcode( shortcode_unautop( $content ) );
  }
}

/* Use shortcodes in text widgets */
add_filter('widget_text', 'do_shortcode');

/* Shortcodes enable in the_excerpt */
add_filter('the_excerpt', 'do_shortcode');

/* Remove p tag and add by our self in the_excerpt */
remove_filter('the_excerpt', 'wpautop');

// Remove p tag and add by our self in the_content
remove_filter('the_content','wpautop');

// Testimonial Formating
add_filter('the_content','eunice_testimonial_formating');
function eunice_testimonial_formating($content) {
  if( get_post_type()=='testimonials' || get_post_type()=='teams' )
    return $content;
  else
   return wpautop($content);
}

/* Add Extra Social Fields in Admin User Profile */
function eunice_add_twitter_facebook( $contactmethods ) {
  $contactmethods['facebook'] = esc_html__('Facebook', 'eunice-core');
  $contactmethods['twitter'] = esc_html__('Twitter', 'eunice-core');
  $contactmethods['google_plus'] = esc_html__('Google Plus', 'eunice-core');
  $contactmethods['linkedin'] = esc_html__('Linkedin', 'eunice-core');
  $contactmethods['instagram'] = esc_html__('Instagram', 'eunice-core');
  $contactmethods['pinterest'] = esc_html__('Pinterest', 'eunice-core');
  return $contactmethods;
}
add_filter('user_contactmethods','eunice_add_twitter_facebook',10,1);

/**
 *
 * Encode string for backup options
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_encode_string' ) ) {
  function cs_encode_string( $string ) {
    return rtrim( strtr( call_user_func( 'base'. '64' .'_encode', addslashes( gzcompress( serialize( $string ), 9 ) ) ), '+/', '-_' ), '=' );
  }
}

/**
 *
 * Decode string for backup options
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_decode_string' ) ) {
  function cs_decode_string( $string ) {
    return unserialize( gzuncompress( stripslashes( call_user_func( 'base'. '64' .'_decode', rtrim( strtr( $string, '-_', '+/' ), '=' ) ) ) ) );
  }
}