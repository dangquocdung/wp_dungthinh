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

if(class_exists('SMPNEW_Tpl') != true) {
	class SMPNEW_Tpl {
		
		const VERSION = '1.0';
		
		public $parent = array();


		/**
		 * The constructor
		 */
		public function __construct( $parent=array() )
		{
			$this->parent = $parent; // load parent
			
			if ( 'tpl' == SMPNEW_action() )
				AArpr_Assets( 'optypes', array( 'options' => SMPNEW_Load_Options( $this->parent->path('TPL_DIR'), array('file' => 'options-tpl.php') ) ) );
		}
		
		public function print_interface()
		{
			$html[] = '<div id="SMPNEW_iw-section-content" style="padding-right: 40px;">';
			$html[] = 		SMPNEW_Settings_Build_Options( SMPNEW_Load_Options( dirname( __FILE__ ) ), 'SMPNEW_Tpl_Settings' );
			$html[] = '</div>';
			
			return implode( "\n", $html );
		}
	}
}