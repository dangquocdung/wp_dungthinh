<?php 
if (!defined('AArpr_VERSION')) die('Forbidden');

$manifest 					= array();
$manifest['id'] 			= 'input-type-url';
$manifest['class'] 			= AArpr()->alias . '_Input_Type_Url';
$manifest['name'] 			= __('Input Type Url', 'AArpr');
$manifest['icon'] 			= 'fa-link';
$manifest['version'] 		= '1.0';
$manifest['init_file'] 		= 'init.class.php';