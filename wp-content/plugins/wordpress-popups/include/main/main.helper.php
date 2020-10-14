<?php
/**
 * Amazon Helper module
 * http://www.aa-team.com
 * ======================
 *
 * @package		WooEnvato Contextual
 * @author		Andrei Dinca, AA-Team
 * @version		1.0
 */
!defined('ABSPATH') and exit;
if (class_exists('SMPNEW_Main_Helper') != true) {
    class SMPNEW_Main_Helper
    {
        const VERSION = '1.0';
		
		public $parent = array();

        public $config = array(
			"api_key" => ""
		);
		
        
        /**
         * The constructor
         */
        public function __construct( $parent=array() )
        {
        	$this->parent = $parent; // load parent

        	// create AJAX request
			add_action('wp_ajax_SMPNEW_ajax', array(
                $this,
                'ajax_requests'
            ));
        }
		
		private function print_error_response( $msg='' )
		{	
			die( json_encode( array(
				'status' 	=> 'invalid',
				'msg'		=> $msg
			) ) );  
		}
		
		
		/**
		 * Functions - for options file
		 */
		public function ajax_requests()
		{
			$action = isset($_REQUEST['sub_action']) ? $_REQUEST['sub_action'] : 'none';
			
			$allowed_action = array( 'check_amazon', );
			
			if( !in_array($action, $allowed_action) ){
				die(json_encode(array(
					'status' => 'valid',
					'html' => 'Invalid action!'
				)));
			}

			$html = array();

			if( 'check_amazon' == $action ){
				
				$smpnew = $this->parent;
				$config = $smpnew->settings();

				require_once( $smpnew->path( 'HELPERS_DIR', 'amz.helper.class.php' ) );
				if ( class_exists('SMPNEWAmazonHelper') ) {
					//$theHelper = SMPNEWAmazonHelper::getInstance( $smpnew );
					$theHelper = new SMPNEWAmazonHelper( $smpnew );
				}
				$theHelper->check_amazon();

				die(json_encode(array(
					'status' => 'valid',
					'html' => implode( "\n", $html )
				))); 
			}

			die(json_encode(array(
				'status' => 'valid',
				'html' => 'Invalid action!'
			)));
		}
	}
}
