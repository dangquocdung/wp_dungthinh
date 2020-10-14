<?php 
if (!defined('AArpr_VERSION')) die('Forbidden');

$manifest 					= array();
$manifest['id'] 			= 'input-type-email';
$manifest['class'] 			= AArpr()->alias . '_Input_Type_Email';
$manifest['name'] 			= __('Input Type Email', 'AArpr');
$manifest['icon'] 			= 'fa-envelope';
$manifest['version'] 		= '1.0';
$manifest['init_file'] 		= 'init.class.php';