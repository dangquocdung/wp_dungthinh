<?php 
if (!defined('AArpr_VERSION')) die('Forbidden');

$manifest 					= array();
$manifest['id'] 			= 'date';
$manifest['class'] 			= AArpr()->alias . '_Option_Type_Date';
$manifest['name'] 			= __('Date', 'AArpr');
$manifest['javascript'] 	= array(
	'{prefix}option.js'				=> array(
		'src'		=> 'assets/option.js',
		'deps'		=> array( 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker' ),
	),
);
$manifest['icon'] 			= 'fa-arrows-h';
$manifest['version'] 		= '1.0';
$manifest['init_file'] 		= 'init.class.php';