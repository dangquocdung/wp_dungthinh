<?php 
if (!defined('AArpr_VERSION')) die('Forbidden');

$manifest 					= array();
$manifest['id'] 			= 'multiselect';
$manifest['class'] 			= AArpr()->alias . '_Option_Type_Multiselect';
$manifest['name'] 			= __('Multiple Select', 'AArpr');
$manifest['icon'] 			= 'fa-arrows-h';
$manifest['version'] 		= '1.0';
$manifest['init_file'] 		= 'init.class.php';