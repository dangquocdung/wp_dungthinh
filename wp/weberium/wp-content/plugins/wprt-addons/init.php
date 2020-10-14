<?php 
/*
Plugin Name: WPRT Addons 
Plugin URI: http://rollthemes.com/plugins/
Description: Extend Visual Composer with Advanced Shortcodes.
Version: 3.7.9
Author: RollThemes
Author URI: http://rollthemes.com
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Enqueue scripts
add_action( 'wp_enqueue_scripts', 'loadCssAndJs', 999999 );
function loadCssAndJs() {
	wp_enqueue_style( 'weberium-flexslider', plugins_url('assets/flexslider.css', __FILE__), array(), '2.3.6' );
	wp_register_script( 'weberium-flexslider', plugins_url('assets/flexslider.min.js', __FILE__), array('jquery'), '2.3.6', true );
	wp_enqueue_style( 'weberium-owlcarousel', plugins_url('assets/owl.carousel.css', __FILE__), array(), '2.2.1' );
	wp_register_script( 'weberium-owlcarousel', plugins_url('assets/owl.carousel.min.js', __FILE__), array('jquery'), '2.2.1', true );
	wp_enqueue_style( 'weberium-cubeportfolio', plugins_url('assets/cubeportfolio.min.css', __FILE__), array(), '3.4.0' );
	wp_register_script( 'weberium-cubeportfolio', plugins_url('assets/cubeportfolio.min.js', __FILE__), array('jquery'), '3.4.0', true );
	wp_register_script( 'weberium-countto', plugins_url('assets/countto.js', __FILE__), array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'weberium-equalize', plugins_url('assets/equalize.min.js', __FILE__), array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'weberium-imagesloaded', plugins_url('assets/imagesloaded.js', __FILE__), array('jquery'), '4.1.3', true );
	wp_enqueue_style( 'weberium-magnificpopup', plugins_url('assets/magnific.popup.css', __FILE__), array(), '1.0.0' );
	wp_register_script( 'weberium-magnificpopup', plugins_url('assets/magnific.popup.min.js', __FILE__), array('jquery'), '1.0.0', true );
	wp_enqueue_style( 'weberium-vegas', plugins_url('assets/vegas.css', __FILE__), array(), '2.3.1' );
	wp_register_script( 'weberium-vegas', plugins_url('assets/vegas.js', __FILE__), array('jquery'), '2.3.1', true );
	wp_enqueue_style( 'weberium-ytplayer', plugins_url('assets/ytplayer.css', __FILE__), array(), '3.0.2' );
	wp_register_script( 'weberium-ytplayer', plugins_url('assets/ytplayer.js', __FILE__), array('jquery'), '3.0.2', true );
	wp_enqueue_script( 'weberium-waypoints', plugins_url('assets/waypoints.js', __FILE__), array('jquery'), '2.0.4', true );
	wp_register_script( 'weberium-fittext', plugins_url('assets/fittext.js', __FILE__), array('jquery'), '1.1.0', true );
	wp_register_script( 'weberium-flowtype', plugins_url('assets/flowtype.js', __FILE__), array('jquery'), '1.3.0', true );
	wp_register_script( 'weberium-typed', plugins_url('assets/typed.js', __FILE__), array('jquery'), '1.1.0', true );
	wp_register_script( 'weberium-countdown', plugins_url('assets/countdown.js', __FILE__), array('jquery'), '1.0.0', true );
	wp_register_script( 'weberium-appear', plugins_url('assets/appear.js', __FILE__), array('jquery'), '0.3.6', true );
	
	wp_enqueue_style( 'weberium-shortcode', plugins_url('assets/shortcodes.css', __FILE__), array(), '1.0' );
	wp_enqueue_script( 'weberium-shortcode', plugins_url('assets/shortcodes.js', __FILE__), array('jquery'), '1.0', true );
	wp_enqueue_script('google-maps-api', 'https://maps.googleapis.com/maps/api/js', array(), 'v3');
}

// Add image sizes
add_action( 'after_setup_theme', 'add_image_sizes' );
function add_image_sizes() {
	add_image_size( 'weberium-square', 600, 600, true );
	add_image_size( 'weberium-square2', 400, 400, true );
	add_image_size( 'weberium-rectangle', 590, 550, true );
	add_image_size( 'weberium-rectangle2', 590, 520, true );
	add_image_size( 'weberium-rectangle3', 590, 430, true );
	add_image_size( 'weberium-medium-auto', 870, 9999 );
	add_image_size( 'weberium-small-auto', 600, 9999 );
	add_image_size( 'weberium-xsmall-auto', 480, 9999 );
}


// Map shortcodes to Visual Composer
require_once __DIR__ . '/vc-map.php';

// Include shortcodes files for Visual Composer
foreach ( glob( plugin_dir_path( __FILE__ ) . '/shortcodes/*.php' ) as $file ) {
	$filename = basename( $file );
	$tagname  = str_replace( '-', '_', pathinfo( $file, PATHINFO_FILENAME ) );

	add_shortcode( $tagname, function( $atts, $content = '' ) use( $file, $filename ) {
		ob_start();
		include $file;
		return ob_get_clean();
	} );
}

// Add user contact methods
if ( ! function_exists( 'weberium_socials_user_contact_methods' ) ) {
    function weberium_socials_user_contact_methods( $user_contact ) {

        $user_contact['rt_facebook']   = esc_html( 'Facebook URL' );
        $user_contact['rt_twitter'] = esc_html( 'Twitter URL' );
        $user_contact['rt_google_plus'] = esc_html( 'Google+ URL' );
        $user_contact['rt_linkedin'] = esc_html( 'LinkedIn URL' );
        $user_contact['rt_pinterest'] = esc_html( 'Pinterest URL' );
        $user_contact['rt_instagram'] = esc_html( 'Instagram URL' );

        // Unset fields you don’t need
        unset($user_contact['aim']);
        unset($user_contact['jabber']);

        return $user_contact;
    }

  add_filter( 'user_contactmethods', 'weberium_socials_user_contact_methods' );
}

// Google API
require_once __DIR__ . '/google-api.php';

// Custom Post Type
require_once __DIR__ . '/cpt/init.php';

// Widgets
require_once __DIR__ . '/widgets/init.php';

?>