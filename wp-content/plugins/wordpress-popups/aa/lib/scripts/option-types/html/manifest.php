<?php 
if (!defined('AArpr_VERSION')) die('Forbidden');

$manifest 					= array();
$manifest['id'] 			= 'html';
$manifest['class'] 			= AArpr()->alias . '_Option_Type_HTML';
$manifest['name'] 			= __('HTML', 'AArpr');
$manifest['icon'] 			= 'fa-text-width';
$manifest['version'] 		= '1.0';
$manifest['init_file'] 		= 'init.class.php';