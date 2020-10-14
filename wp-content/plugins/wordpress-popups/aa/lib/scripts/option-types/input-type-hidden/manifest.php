<?php 
if (!defined('AArpr_VERSION')) die('Forbidden');

$manifest 					= array();
$manifest['id'] 			= 'input-type-hidden';
$manifest['class'] 			= AArpr()->alias . '_Input_Type_Hidden';
$manifest['name'] 			= __('Input Type Hidden', 'AArpr');
$manifest['icon'] 			= 'fa-link';
$manifest['version'] 		= '1.0';
$manifest['init_file'] 		= 'init.class.php';