<?php 
if (!defined('AArpr_VERSION')) die('Forbidden');

$manifest 					= array();
$manifest['id'] 			= 'input-type-text';
$manifest['class'] 			= AArpr()->alias . '_Input_Type_Text';
$manifest['name'] 			= __('Input Type Text', 'AArpr');
$manifest['icon'] 			= 'fa-text-width';
$manifest['version'] 		= '1.0';
$manifest['init_file'] 		= 'init.class.php';