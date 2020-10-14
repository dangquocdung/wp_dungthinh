<?php 
if (!defined('AArpr_VERSION')) die('Forbidden');

$manifest 					= array();
$manifest['id'] 			= 'multiselect-l2r';
$manifest['class'] 			= AArpr()->alias . '_Option_Type_Multiselect_l2r';
$manifest['name'] 			= __('Multiple Select L2R', 'AArpr');
$manifest['javascript'] 	= array(
	'{prefix}option.js'				=> array(
		'src'		=> 'assets/option.js',
	),
);
$manifest['css'] 			= array(
	'{prefix}option.css'			=> array(
		'src'		=> 'assets/option.css',
	),
);
$manifest['icon'] 			= 'fa-arrows-h';
$manifest['version'] 		= '1.0';
$manifest['init_file'] 		= 'init.class.php';