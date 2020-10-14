<?php 
if (!defined('AArpr_VERSION')) die('Forbidden');

$manifest 					= array();
$manifest['id'] 			= 'input-type-password';
$manifest['class'] 			= AArpr()->alias . '_Input_Type_Password';
$manifest['name'] 			= __('Input Type Password', 'AArpr');
$manifest['icon'] 			= 'fa-key';
$manifest['version'] 		= '1.0';
$manifest['init_file'] 		= 'init.class.php';