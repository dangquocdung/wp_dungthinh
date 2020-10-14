<?php 
if (!defined('AArpr_VERSION')) die('Forbidden');

$manifest 					= array();
$manifest['id'] 			= 'input-type-number';
$manifest['class'] 			= AArpr()->alias . '_Input_Type_Number';
$manifest['name'] 			= __('Input Type Number', 'AArpr');
$manifest['icon'] 			= 'fa-sort-numeric-desc';
$manifest['version'] 		= '1.0';
$manifest['init_file'] 		= 'init.class.php';