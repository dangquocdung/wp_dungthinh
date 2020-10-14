<?php
/*
    Plugin Name: Architect Visual Composer
    Plugin URI: http://thememodern.com/
    Description: Architect Visual Composer is Child of WPBakery Visual Composer, require install WPBakery Visual Composer plugin.
    Version: 1.1
    Author: ThemeModern
    Author URI: http://thememodern.com/
    Domain Path: /languages/
	Text Domain: otvcp-i10n    
    License: GPLv2 or later
*/

//definitions
if(!defined('OTVCP_PATH')) define( 'OTVCP_PATH', plugin_dir_path(__FILE__) );
if(!defined('OTVCP_DIR')) define( 'OTVCP_DIR', plugin_dir_url(__FILE__) );

function otvcp_localisation() {
	load_plugin_textdomain( 'otvcp-i10n', FALSE, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action('init', 'otvcp_localisation');

//required functions & classes
require_once(OTVCP_PATH . 'functions/shortcodes.php');
require_once(OTVCP_PATH . 'functions/vc_shortcode.php');

?>