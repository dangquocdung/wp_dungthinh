<?php
/*
 * Plugin Name: 360 Virtual Tour, Panorama WordPress Plugin
 * Plugin URI: https://panorama.jegtheme.com/
 * Description: 360 Virtual tour and Panorama Plugin for WordPress. Also support WooCommerce for Product Taging
 * Author: Jegtheme
 * Version: 1.0.5
 * Author URI: https://jegtheme.com/
 * License: GPL2+
 * Text Domain: wvt
 * Domain Path: /languages/
 */

defined( 'WVT' ) || define( 'WVT', 'wvt' );
defined( 'WVT_VERSION' ) || define( 'WVT_VERSION', '1.0.5' );
defined( 'WVT_URL' ) || define( 'WVT_URL', plugins_url( WVT ) );
defined( 'WVT_FILE' ) || define( 'WVT_FILE', __FILE__ );
defined( 'WVT_DIR' ) || define( 'WVT_DIR', plugin_dir_path( __FILE__ ) );
defined( 'WVT_PATH' ) || define( 'WVT_PATH', plugin_basename( __FILE__ ) );
defined( 'WVT_PLUGIN_ID' ) || define( 'WVT_PLUGIN_ID', 24936734 );

require_once 'includes/helper.php';

require_once 'includes/autoload.php';

\WVT\Init::get_instance();
