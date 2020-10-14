<?php
if( !class_exists('AArpr_Option_Type_App') ){
	class AArpr_Option_Type_App extends AArpr_Settings 
	{
		public $manifest;
		private static $instance;
		
		public $plugin_alias;
		public $box = null;
		

        public static function getInstance( $plugin_alias='', $pms=array() )
        {
            if (null === static::$instance) {
                static::$instance = new static( $plugin_alias, $pms );
            }
            
            return static::$instance;
        }

		public function __construct( $plugin_alias='', $pms=array() )
		{
			parent::__construct( $plugin_alias, $pms );
			$this->plugin_alias = $plugin_alias;

			// load the manifest array
			$this->manifest = $this->options['app'];
		}

		public function _set_box( $box ) {
			$this->box = $box;
		}
		

		/**
		 * @param string $elm_id
		 * @param string $box_id
		 * @param string $val
		 * @param array $value
		 *
		 * @return string
		 *
		 * @internal
		 */
		protected function _render( $elm_id, $box_id, $val, $attrs ) 
		{
			if( isset($attrs['type']) ) unset( $attrs['type'] );

			$html = array();

			$show_wrap = isset($attrs['show_wrap']) ? (bool) $attrs['show_wrap'] : false;
			$show_wrap = $show_wrap && ('AArpr' != $this->plugin_alias);

			if ( $show_wrap ) {
				$html[] = '<div class="' . $this->plugin_alias . '-form-row';
				$html[] = ' ' . ($this->tabs_elements($this->box, $elm_id));
				$html[] = '">';
			}
			
			$file = $attrs['path'];

			clearstatcache();
			if ( is_file($file) && is_readable($file) ) {
				// Turn on output buffering
				ob_start();

				require_once( $file  );

				//copy current buffer contents into $message variable and delete current output buffer
				$html[] = ob_get_clean();
			}
			else {
				$html[] = sprintf( __( '%s option type - invalid file!', 'AArpr'), 'app' );
			}
 
			if ( $show_wrap ) {
				$html[] = '</div>';
			}

			return implode( "\n", $html );
		}
	
		public function options()
		{
			$options = array();

			$options['label'] = array(
		        'type' 			=> 'text',
		        'placeholder' 	=> __( 'Option label (Title)', 'AArpr'),
		        'title' 		=> __( 'Title', 'AArpr'),
		        'force_width' 	=> '60%',
		        'desc' 			=> __( 'Type your option label here. This will be autoconvert to option alias.', 'AArpr' )
		    );

		    $options['desc'] = array(
		        'type' 			=> 'textarea',
		        'placeholder' 	=> __( 'Option description', 'AArpr'),
		        'title' 		=> __( 'Description', 'AArpr'),
		        'force_width' 	=> '70%',
		        'desc' 			=> __( 'Option description here', 'AArpr' )
		    );

			return $options;
		}
	}
}