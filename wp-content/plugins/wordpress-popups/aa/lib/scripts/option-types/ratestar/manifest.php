<?php 
if (!defined('AArpr_VERSION')) die('Forbidden');

$manifest 					= array();
$manifest['id'] 			= 'ratestar';
$manifest['class'] 			= AArpr()->alias . '_Option_Type_Ratestar';
$manifest['name'] 			= __('RateIt', 'AArpr');
$manifest['javascript'] 	= array(
	'{prefix}jquery.rateit.js' 	=> array(
		'src'		=> 'assets/jquery.rateit.min.js',
	),
	'{prefix}option.js'				=> array(
		'src'		=> 'assets/option.js',
		'deps'		=> array( '{prefix}jquery.rateit.js' ),
	),
);
$manifest['css'] 			= array(
	'{prefix}rateit.css'			=> array(
		'src'		=> 'assets/rateit.css',
	),
);
$manifest['icon'] 			= 'fa-arrows-h';
$manifest['version'] 		= '1.0';
$manifest['init_file'] 		= 'init.class.php';