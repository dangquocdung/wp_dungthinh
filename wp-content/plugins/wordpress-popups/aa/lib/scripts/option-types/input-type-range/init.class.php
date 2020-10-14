<?php
if( !class_exists('AArpr_Input_Type_Range') ){
	class AArpr_Input_Type_Range extends AArpr_Settings 
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
			$this->manifest = $this->options['input-type-range'];
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
			$attrs = $this->build_element_size( $attrs );
			if( isset($attrs['type']) ) unset( $attrs['type'] );
 
			$html = array();
			
			$the_id = ( $box_id ) . '-' . esc_attr($elm_id);
			$the_name = ( $box_id ) . '[' . esc_attr($elm_id) . ']';

			$html[] = '<div class="' . $this->plugin_alias . '-item-' . ( $this->manifest['id'] ) . ' AArpr-item-' . ( $this->manifest['id'] ) . '"';
			$html[] = ' style="';
			if( isset($attrs['width']) && trim($attrs['width']) != "" ){
				$html[] = 'width:' . $attrs['width'] . ';';
			}
			if( isset($attrs['height']) && trim($attrs['height']) != "" ){
				$html[] = 'height:' . $attrs['height'] . ';';
			}
			$html[] = '">';

			$html[] = '<input type="range"';
			$html[] = ' value="' . esc_attr($val) . '"';
			$html[] = ' id="' . $the_id . '"';
			$html[] = ' name="' . $the_name . '"';

			$default_attrs = array(
				'min',
				'max',
				'step'
			);

			if( count($default_attrs) > 0 ){
				foreach ($default_attrs as $attr) {
					if( isset($attrs[$attr]) && trim($attrs[$attr]) != "" ){
						$html[] =  ' ' . ( $attr ) . '="' . $attrs[$attr] . '"';
					}
				}
			}
			
			$html[] = ' style="';
			if( isset($attrs['width']) && trim($attrs['width']) != "" ){
				$html[] = 'width:' . '90%' . ';';
			}
			if( isset($attrs['height']) && trim($attrs['height']) != "" ){
				$html[] = 'height:' . '100%' . ';';
			}
			$html[] = '"';
			
			$html[] = '/>';
			$html[] = '<output for="' . $the_id . '" value="' . esc_attr($val) . '">0</output>';
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
			
		    $options['std'] = array(
		        'type' 			=> 'text',
		        'title' 		=> __( 'Option default', 'AArpr'),
		        'force_width' 	=> '20%',
		        'desc' 			=> __( 'Type your option default value.', 'AArpr' )
		    );
			
		    $options['size'] = array(
		        'type' 			=> 'select',
		        'std'			=> '50%',
		        'title' 		=>  __( 'Option size', 'AArpr'),
		        'force_width' 	=> '40%',
		        'desc' 			=> __( 'Select your option size', 'AArpr' ),
		        'values'		=> $this->build_size_array()
		    );
			
			$options['width'] = array(
		        'type' 			=> 'text',
		        'placeholder' 	=> __( 'Option width (for style property)', 'AArpr'),
		        'title' 		=> __( 'Width', 'AArpr'),
		        'force_width' 	=> '60%',
		        'desc' 			=> __( 'Type your option width here. This will be autoconvert to option alias.', 'AArpr' )
		    );
			
			$options['height'] = array(
		        'type' 			=> 'text',
		        'placeholder' 	=> __( 'Option height (for style property)', 'AArpr'),
		        'title' 		=> __( 'Height', 'AArpr'),
		        'force_width' 	=> '60%',
		        'desc' 			=> __( 'Type your option height here. This will be autoconvert to option alias.', 'AArpr' )
		    ); 

		    $options['min'] = array(
		        'type' 			=> 'text',
		        'title' 		=> __( 'Min', 'AArpr'),
		        'force_width' 	=> '20%',
		        'desc' 			=> __( 'Specifies the minimum value for an input field', 'AArpr' )
		    );

		    $options['max'] = array(
		        'type' 			=> 'text',
		        'title' 		=> __( 'Max', 'AArpr'),
		        'force_width' 	=> '20%',
		        'desc' 			=> __( 'Specifies the maximum value for an input field', 'AArpr' )
		    );

		    $options['step'] = array(
		        'type' 			=> 'text',
		        'title' 		=> __( 'Step', 'AArpr'),
		        'force_width' 	=> '30%',
		        'desc' 			=> __( 'Specifies the legal number intervals for an input field', 'AArpr' )
		    );

			return $options;
		}
	}
}