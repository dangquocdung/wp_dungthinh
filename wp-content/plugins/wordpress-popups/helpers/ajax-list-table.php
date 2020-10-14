<?php
//if ( ! class_exists( 'AArpr_List_Table_Ajax' ) )
	//???
//	require_once( ABSPATH . 'wp-content/plugins/aa/lib/scripts/ajax-list-table/ajax-list-table.php' );

AArpr_Repository( 'AArpr_List_Table_Ajax', array('call_init' => false) );


/* Hide notices to avoid AJAX errors
 * Sometimes the Class throws a notice about 'hook_suffix' being undefined,
 * which breaks every AJAX call.
 */
class SMPNEW_List_Table_Ajax extends AArpr_List_Table_Ajax 
{
	public $amz_settings;


	/**
	 * REQUIRED. Set up a constructor that references the parent constructor. We 
	 * use the parent reference to set some default configs.
	 */
	public function __construct( $the_plugin=null, $params=array() ) 
	{
		// Set parent defaults
		parent::__construct(
			$the_plugin,
			$params,
			'SMPNEW'
		);
		
		$this->amz_settings = $the_plugin->amz_settings;
	}

	public function prepare_items() 
	{
		parent::prepare_items();
	}
}