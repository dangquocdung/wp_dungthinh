<?php 
if (!defined('AArpr_VERSION')) die('Forbidden');

$manifest 					= array();
$manifest['id'] 			= 'input-type-color';
$manifest['class'] 			= AArpr()->alias . '_Input_Type_Color';
$manifest['name'] 			= __('Input Type Color', 'AArpr');
$manifest['icon'] 			= 'fa-crosshairs';
$manifest['version'] 		= '1.0';
$manifest['init_file'] 		= 'init.class.php';