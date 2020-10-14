<?php
if( !class_exists('AArpr_Option_Type_Textarea') ){
	class AArpr_Option_Type_Textarea extends AArpr_Settings 
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
			$this->manifest = $this->options['textarea'];
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
			
			if( isset( $attrs['hidden'] ) && trim($attrs['hidden']) != '' && $attrs['hidden'] == 'true' ) {
				$hidden = ' hide ';
			} else {
				$hidden = '';
			}

			$html[] = '<div class="' . $hidden . $this->plugin_alias . '-item-' . ( $this->manifest['id'] ) . '"';
			$html[] = ' style="';
			if( isset($attrs['width']) && trim($attrs['width']) != "" ){
				$html[] = 'width:' . $attrs['width'] . ';';
			}
			if( isset($attrs['height']) && trim($attrs['height']) != "" ){
				$html[] = 'height:' . $attrs['height'] . ';';
			}
			$html[] = '">';
			$html[] = '<textarea';
			$html[] = ' id="' . $the_id . '"';
			$html[] = ' name="' . $the_name . '"';

			$html[] = ' style="';
			if( isset($attrs['width']) && trim($attrs['width']) != "" ){
				$html[] = 'width:' . '100%' . ';';
			}
			if( isset($attrs['height']) && trim($attrs['height']) != "" ){
				$html[] = 'height:' . '100%' . ';';
			}
			$html[] = '"';

			if( isset($attrs['cols']) && trim($attrs['cols']) != "" ){
				$html[] = ' cols="' . $attrs['cols'] . '"';
			}
			if( isset($attrs['rows']) && trim($attrs['rows']) != "" ){
				$html[] = ' rows="' . $attrs['rows'] . '"';
			}

			$html[] = '>';
			$html[] = esc_attr($val);
			$html[] = '</textarea>';
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
			
			$options['cols'] = array(
		        'type' 			=> 'text',
		        'placeholder' 	=> __( 'Option cols (for style property)', 'AArpr'),
		        'title' 		=> __( 'Cols', 'AArpr'),
		        'force_width' 	=> '60%',
		        'desc' 			=> __( 'Type your option cols here. This will be autoconvert to option alias.', 'AArpr' )
		    );
			
			$options['rows'] = array(
		        'type' 			=> 'text',
		        'placeholder' 	=> __( 'Option rows (for style property)', 'AArpr'),
		        'title' 		=> __( 'Rows', 'AArpr'),
		        'force_width' 	=> '60%',
		        'desc' 			=> __( 'Type your option rows here. This will be autoconvert to option alias.', 'AArpr' )
		    );

			return $options;
		}
	}
}