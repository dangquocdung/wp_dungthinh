<?php
 /**
 * Amazon module
 * http://www.aa-team.com
 * ======================
 *
 * @package		SMPNEW_
 * @author		Andrei Dinca, AA-Team
 * @version		1.0
 */
! defined( 'ABSPATH' ) and exit;

if(class_exists('SMPNEW_Main') != true) {
	class SMPNEW_Main {
		
		const VERSION = '1.0';
		
		public $parent = array();


		/**
		 * The constructor
		 */
		public function __construct( $parent=array() )
		{
			$this->parent = $parent; // load parent
			
			if ( 'main' == SMPNEW_action() )
				AArpr_Assets( 'optypes', array( 'options' => SMPNEW_Load_Options( $this->parent->path('MAIN_DIR') ) ) );
		}
		
		public function print_interface()
		{
			$html[] = '<div id="SMPNEW_iw-section-content" style="padding-right: 40px;">';
			$html[] = 		SMPNEW_Settings_Build_Options( SMPNEW_Load_Options( dirname( __FILE__ ) ), 'SMPNEW_Main_Settings' );
			$html[] = '</div>';
			
			return implode( "\n", $html );
		}
	}
}