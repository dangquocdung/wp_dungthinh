<?php 
if (!defined('AArpr_VERSION')) die('Forbidden');

$manifest 					= array();
$manifest['id'] 			= 'upload-image';
$manifest['class'] 			= AArpr()->alias . '_Option_Type_Upload_Image';
$manifest['name'] 			= __('Upload Image', 'AArpr');
$manifest['javascript'] 	= array(
	'{prefix}ajaxupload.js' 	=> array(
		'src'		=> 'assets/ajaxupload.js',
	),
	'{prefix}option.js'				=> array(
		'src'		=> 'assets/option.js',
		'deps'		=> array( '{prefix}ajaxupload.js' ),
	),
);
$manifest['icon'] 			= 'fa-arrows-h';
$manifest['version'] 		= '1.0';
$manifest['init_file'] 		= 'init.class.php';

$manifest['disabled'] 		= true;