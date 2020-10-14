<?php
/**
 * Plugin Name: Cordon WordPress Theme Plugin Bundle
 * Plugin URI: http://themeforest.net/user/ridianur
 * Description: This is plugin bundle for <strong style="color:#000;">Cordon WordPress Theme</strong>.
 * Author: ridianur
 * Author URI: http://themeforest.net/user/ridianur
 * Version: 1.2
 */


define( 'CORDON__FILE__', __FILE__ );
define( 'CORDON_URL', plugins_url( '/', CORDON__FILE__ ) );

//CUSTOM POST TYPE SETTING
//include team custom post type  & metaboxes
include('inc/team.php');
include('inc/team-metaboxes.php');
//include portfolio custom post type,metaboxes & single portfolio script
include('inc/portfolio.php');
include('inc/portfolio-metaboxes.php');
include('inc/single-portfolio.php');
//include testimonial custom post type  & metaboxes
include('inc/testimonial.php');
include('inc/testimonial-metaboxes.php');
//include client custom post type  & metaboxes
include('inc/client.php');
include('inc/client-metaboxes.php');
//include contact custom post type  
include('inc/contact.php');
//include google map
include('inc/google-map.php');
//included theme options & import
include('inc/theme-import.php');
include('inc/theme-options.php');
//included theme import
include('inc/sharebox.php');
//include Post  metaboxes  
include('inc/post-metaboxes.php');
//include Page  metaboxes  
include('inc/page-metaboxes.php');
//include slider &  metaboxes  
include('inc/rdn-slider.php');
//include pagebuilder element 
include('inc/builder-options.php'); 
include('inc/element.php');
include('inc/element/slider-widget.php');
include('inc/element/big-title.php');
include('inc/element/team-block.php');
include('inc/element/testimonial.php');
include('inc/element/portfolio-wide.php');
include('inc/element/client-post.php');
include('inc/element/contact-post.php');
include('inc/element/contact-text.php');
include('inc/element/google-map.php');
include('inc/element/title-block.php');
include('inc/element/text-icon.php');
include('inc/element/blockquote.php');
include('inc/element/hero-title.php');
include('inc/element/top-title.php');
include('inc/element/title-line.php');
include('inc/element/image-title.php');
include('inc/element/image-bg.php');
include('inc/element/banner.php');
include('inc/element/blog-post.php');
include('inc/element/about-me.php');

//about us widget
include('inc/about-us.php');
//flickrfeed widget & shortcode
include('inc/flickr-feed.php');
include('inc/flickr-widget.php');

//prebuild layout
include('inc/prebuild.php');
//one click importer
include('inc/one-click.php');
//plugin translation
function rdn_textdomain_translation() {
    load_plugin_textdomain('cordon_plg', false, dirname(plugin_basename(__FILE__)) . '/lang/');
} // end custom_theme_setup
add_action('after_setup_theme', 'rdn_textdomain_translation');

//adding optiontree into themes
/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );
	/**
 * Optional: set 'ot_show_new_layout' filter to false.
 * This will hide the "New Layout" section on the Theme Options page.
 */
add_filter( 'ot_show_new_layout', '__return_false' );


function admin_style() {
  wp_enqueue_style('admin-styles', CORDON_URL.'inc/css/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

