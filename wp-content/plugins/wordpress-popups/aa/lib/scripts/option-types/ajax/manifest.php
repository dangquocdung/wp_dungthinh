<?php 
if (!defined('AArpr_VERSION')) die('Forbidden');

$manifest 					= array();
$manifest['id'] 			= 'ajax';
$manifest['class'] 			= AArpr()->alias . '_Option_Type_Ajax';
$manifest['name'] 			= __( 'Option Ajax', 'AArpr' );
$manifest['css'] 			= array(
	'{prefix}option.css'			=> array(
		'src'		=> 'assets/option.css',
	),
);
$manifest['icon'] 			= 'fa-spinner';
$manifest['version'] 		= '1.0';
$manifest['init_file'] 		= 'init.class.php';