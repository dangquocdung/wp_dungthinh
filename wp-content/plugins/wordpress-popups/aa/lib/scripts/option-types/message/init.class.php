<?php
if( !class_exists('AArpr_Option_Type_Message') ){
	class AArpr_Option_Type_Message extends AArpr_Settings 
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
			$this->manifest = $this->options['message'];
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

			$html[] = '<div class="' . $this->plugin_alias . '-message ' . $this->plugin_alias . '-' . ($attrs['status']);
			$html[] = ' ' . ($this->tabs_elements($this->box, $elm_id));
			$html[] = '">';
			$html[] = $attrs['html'];
			$html[] = '</div>';

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