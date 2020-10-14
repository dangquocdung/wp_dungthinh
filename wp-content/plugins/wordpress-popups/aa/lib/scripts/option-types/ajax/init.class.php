<?php
if( !class_exists('AArpr_Option_Type_Ajax') ){
	class AArpr_Option_Type_Ajax extends AArpr_Settings 
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
			$this->manifest = $this->options['ajax'];
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

			if( '{{sub_action}}' == $attrs['sub_action'] ){
                $attrs['sub_action'] = isset($_REQUEST['sub_action']) ? $_REQUEST['sub_action'] : '';
            }

            $params = isset($attrs['params']) ? $attrs['params'] : '';
			if( '{{params}}' == $params ){
				$params = isset($_REQUEST['params']) ? $_REQUEST['params'] : array();
			}
			$params = (array) $params;

			$html = array();

			$show_wrap = isset($attrs['show_wrap']) ? (bool) $attrs['show_wrap'] : false;
			$show_wrap = $show_wrap && ('AArpr' != $this->plugin_alias);

			if ( $show_wrap ) {
				$html[] = '<div class="' . $this->plugin_alias . '-form-row';
				$html[] = ' ' . ($this->tabs_elements($this->box, $elm_id));
				$html[] = '">';
			}

			$html[] = '<div ';
			$html[] = ' data-params=\'' . ( count($params) > 0 ? json_encode($params) : '' ) . '\'';
			$html[] = ' data-label="' . ( isset($attrs['label']) ? $attrs['label'] : '' ) . '"';
			$html[] = ' data-action="' . ( isset($attrs['action']) ? $attrs['action'] : '' ) . '"';
			$html[] = ' data-sub_action="' . ( isset($attrs['sub_action']) ? $attrs['sub_action'] : '' ) . '"';
			$html[] = ' class="AArpr-ajax-action';
			$html[] = '">';
			$html[] = '</div>';
			
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