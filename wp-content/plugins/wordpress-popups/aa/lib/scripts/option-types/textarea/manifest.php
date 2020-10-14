<?php 
if (!defined('AArpr_VERSION')) die('Forbidden');

$manifest 					= array();
$manifest['id'] 			= 'textarea';
$manifest['class'] 			= AArpr()->alias . '_Option_Type_Textarea';
$manifest['name'] 			= __('Textarea', 'AArpr');
$manifest['icon'] 			= 'fa-text-width';
$manifest['version'] 		= '1.0';
$manifest['init_file'] 		= 'init.class.php';