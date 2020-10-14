<?php
 /**
 * Amazon module
 * http://www.aa-team.com
 * ======================
 *
 * @package AArpr
 * @author		Andrei Dinca, AA-Team
 * @version		1.0
 */
! defined( 'ABSPATH' ) and exit;

if(class_exists('AArpr_Main') != true) {
	class AArpr_Main {
		
		const VERSION = '1.0';
		
		public $parent = array();


		/**
		 * The constructor
		 */
		public function __construct( $parent=array() )
		{
			$this->parent = $parent; // load parent
		}
		
		public function print_interface()
		{
			$html[] = '<div id="AArpr_iw-section-content" style="padding-right: 40px;">';
			$html[] = 	AArpr_Settings_Build_Options( AArpr_Load_Options( dirname( __FILE__ ) ), 'AArpr_Main_Settings' );
			$html[] = '</div>';
			
			return implode( "\n", $html );
		}
	}
}