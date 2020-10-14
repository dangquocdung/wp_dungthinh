<?php 
if (!defined('AArpr_VERSION')) die('Forbidden');

$manifest 					= array();
$manifest['id'] 			= 'upload-image-wp';
$manifest['class'] 			= AArpr()->alias . '_Option_Type_Upload_Image_WP';
$manifest['name'] 			= __('Upload Image WP', 'AArpr');
$manifest['javascript'] 	= array(
	'{prefix}option.js'				=> array(
		'src'		=> 'assets/option.js',
	),
);
$manifest['icon'] 			= 'fa-arrows-h';
$manifest['version'] 		= '1.0';
$manifest['init_file'] 		= 'init.class.php';