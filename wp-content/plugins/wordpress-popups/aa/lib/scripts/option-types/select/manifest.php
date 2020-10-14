<?php 
if (!defined('AArpr_VERSION')) die('Forbidden');

$manifest 					= array();
$manifest['id'] 			= 'select';
$manifest['class'] 			= AArpr()->alias . '_Option_Type_Select';
$manifest['name'] 			= __('Select simple', 'AArpr');
$manifest['icon'] 			= 'fa-text-width';
$manifest['version'] 		= '1.0';
$manifest['init_file'] 		= 'init.class.php';