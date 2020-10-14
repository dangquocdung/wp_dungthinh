<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

define('CROWN_VERSION', '1.0.0');
define('CROWN_FILE_HANDLER', basename(get_template_directory()) . '-');

/**
 * Inlcude theme functions
 */
include_once get_parent_theme_file_path('inc/require-plugin.php');
include_once get_parent_theme_file_path('inc/core-functions.php');
include_once get_parent_theme_file_path('inc/template-functions.php');
include_once get_parent_theme_file_path('inc/template-tags.php');
include_once get_parent_theme_file_path('inc/customizer.php');
include_once get_parent_theme_file_path('inc/setup-data.php');
include_once get_parent_theme_file_path('inc/color.php');
include_once get_parent_theme_file_path('inc/wc-functions.php');
