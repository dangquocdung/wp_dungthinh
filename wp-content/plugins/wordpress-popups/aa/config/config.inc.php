<?php
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$AArpr_repository = array(

	//::::::::::::::::::::::::::::::::::::::::::
	//:: AA repository

	// AArpr : is always loaded!
	'AArpr'									=> array(
		'module_init'							=> array(
			'file'											=> 'plugin.php',
			'path'										=> array( 'APP_ROOT' ),
			'class'										=> array( 'AArpr' ),
		),
		'depend'								=> array(),
		'func'										=> array( 'AArpr' ), // external func
	),


	//::::::::::::::::::::::::::::::::::::::::::
	//:: SCRIPTS

	// Amazon Webservices Client Class
	'AArpr_aaAmazonWS'			=> array(
		'module_init'							=> array(
			'file'											=> 'aaAmazonWS.class.php',
			'path'										=> array( 'DIR_LIB_SCRIPTS', 'amazon/' ),
			'class'										=> array( 'AArpr_aaAmazonWS', array(
				'AccessKeyID'								=> '',
				'SecretAccessKey'							=> '',
				'country'										=> '',
				'main_aff_id'									=> '',
			)),
		),
		'depend'								=> array( 'AArpr' ),
		'func'										=> array( 'AArpr_aaAmazonWS', array(
			'the_plugin'								=> null,
			'params'									=> array(), // AccessKeyID, SecretAccessKey, country, main_aff_id
			'settings'									=> array() // the_plugin settings 
		)), // external func
	),
	
	// AArpr_RenderTime
	'AArpr_RenderTime'				=> array(
		'module_init'							=> array(
			'file'											=> 'runtime.php',
			'path'										=> array( 'DIR_LIB_SCRIPTS', 'runtime/' ),
			'class'										=> array( 'AArpr_RenderTime', array(
				'parent'											=> '',
			)),
		),
		'depend'								=> array( 'AArpr' ),
		'func'										=> array( 'AArpr_RenderTime' ), // external func
	),
	
	// AArpr Utils Class
	'AArpr_Utils'							=> array(
		'module_init'							=> array(
			'file'											=> 'utils.php',
			'path'										=> array( 'DIR_LIB_SCRIPTS', 'utils/' ),
			'class'										=> array( 'AArpr_Utils', array(
				'parent'											=> '',
				'plugin_alias'									=> '',
			)),
		),
		'depend'								=> array( 'AArpr' ),
		'func'										=> array( 'AArpr_Utils', array(
				'plugin_alias'									=> '',
		)), // external func
	),
	
	// AArpr Settings class
	'AArpr_Settings'						=> array(
		'module_init'							=> array(
			'file'											=> 'settings.class.php',
			'path'										=> array( 'DIR_LIB_SCRIPTS', 'option-types/' ),
			'class'										=> array( 'AArpr_Settings', array(
				'plugin_alias'									=> '',
				'pms'											=> array()
			)),
		),
		'depend'								=> array(),
		'func'										=> array( 'AArpr_Settings', array(
				'plugin_alias'									=> '',
				'pms'											=> array()
		)), // external func
	),
	
	// AArpr Ajax List Table class based on WP_List_Table
	'AArpr_List_Table_Ajax'			=> array(
		'module_init'							=> array(
			'file'											=> 'ajax-list-table.php',
			'path'										=> array( 'DIR_LIB_SCRIPTS', 'ajax-list-table/' ),
			'class'										=> array( 'AArpr_List_Table_Ajax' ),
		),
		'depend'								=> array( 'AArpr' ),
		'func'										=> array( 'AArpr_List_Table_Ajax', array(
				'pms'									=> '', // the_plugin, params, plugin_alias
		)), // external func
	),


	//::::::::::::::::::::::::::::::::::::::::::
	//:: THIRDPARTY

	// AArpr scsscc
	'AArpr_scssc'							=> array(
		'module_init'							=> array(
			'file'											=> 'scss.inc.php',
			'path'										=> array( 'DIR_LIB_THIRDPARTY', 'scssphp/' ),
			'class'										=> array( 'AArpr_scssc' ),
		),
		'depend'								=> array(),
		'func'										=> array( 'AArpr_scssc', array(
				'pms'									=> '',
		)), // external func
	),
	
	// AArpr phpQuery
	'AArpr_phpQuery'							=> array(
		'module_init'							=> array(
			'file'											=> 'phpQuery.php',
			'path'										=> array( 'DIR_LIB_THIRDPARTY', 'php-query/' ),
			'class'										=> array( 'AArprphpQuery' ),
		),
		'depend'								=> array(),
		'func'										=> array( 'AArpr_List_Table_Ajax', array(
				'pms'									=> '', // file, path, class
		)), // external func
	),

);

?>