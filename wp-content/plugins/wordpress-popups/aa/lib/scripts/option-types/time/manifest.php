<?php 
if (!defined('AArpr_VERSION')) die('Forbidden');

$manifest 					= array();
$manifest['id'] 			= 'time';
$manifest['class'] 			= AArpr()->alias . '_Option_Type_Time';
$manifest['name'] 			= __('Time', 'AArpr');
$manifest['javascript'] 	= array(
	'{prefix}jquery.timepicker.js' 	=> array(
		'src'		=> 'assets/jquery.timepicker.min.js',
		'deps'		=> array( 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'jquery-ui-slider' ),
	),
	'{prefix}option.js'				=> array(
		'src'		=> 'assets/option.js',
		'deps'		=> array( '{prefix}jquery.timepicker.js' ),
	),
);
$manifest['css'] 	= array(
	'{prefix}jquery.timepicker.css' 	=> array(
		'src'		=> 'assets/jquery.timepicker.css',
	),
);
$manifest['icon'] 			= 'fa-arrows-h';
$manifest['version'] 		= '1.0';
$manifest['init_file'] 		= 'init.class.php';