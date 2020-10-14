<?php 
if (!defined('AArpr_VERSION')) die('Forbidden');

$manifest 					= array();
$manifest['id'] 			= 'app';
$manifest['class'] 			= AArpr()->alias . '_Option_Type_App';
$manifest['name'] 			= __( 'Option App', 'AArpr' );
$manifest['icon'] 			= 'fa-spinner';
$manifest['version'] 		= '1.0';
$manifest['init_file'] 		= 'init.class.php';