<?php 
if (!defined('AArpr_VERSION')) die('Forbidden');

$manifest 					= array();
$manifest['id'] 			= 'input-type-range';
$manifest['class'] 			= AArpr()->alias . '_Input_Type_Range';
$manifest['name'] 			= __('Input Type Range', 'AArpr');
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