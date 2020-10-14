<?php
if( !class_exists('AArpr_Option_Type_Date') ){
	class AArpr_Option_Type_Date extends AArpr_Settings 
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
			$this->manifest = $this->options['date'];
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

			// input text
			$readonly = !isset($attrs['readonly']) || $attrs['readonly'] ? ' readonly="readonly"' : '';

			$html[] = '<input type="text"' . $readonly;
			$html[] = ' value="' . esc_attr($val) . '"';
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

			if( isset($attrs['label']) && trim($attrs['label']) != "" ){
				$html[] = ' placeholder="' . $attrs['label'] . '"';
			}
			
			$html[] = '/>';

			// input hidden
			$html[] = '<input type="hidden"';
			$html[] = ' value=""';
			$html[] = ' id="' . $the_id . '-format"';
			//$html[] = ' name="' . $the_name . '-format"';
			$html[] = '/>';
			
			$defaultDate = $val;
			//$defaultDate = '';
			//if ( isset($attrs['std']) && !empty($attrs['std']) )
			//	$defaultDate = $attrs['std'];
			//if ( isset($attrs['defaultDate']) && !empty($attrs['defaultDate']) )
			//	$defaultDate = $attrs['defaultDate'];
			
			$dateFormat = isset($attrs['format']) && !empty($attrs['format']) ? $attrs['format'] : 'yy-mm-dd';
			$defaultDate = !empty($defaultDate) ? $defaultDate : 'null';
			$yearRange = isset($attrs['yearRange']) && !empty($attrs['yearRange']) ? $attrs['yearRange'] : '';
			$altFormat = 'yy-mm-dd';

			$html[] = '<div class="AArpr-date-settings" style="display: none;"';
			$html[] = ' data-date_format="' . esc_attr( $dateFormat ) . '"';
			$html[] = ' data-default_date="' . esc_attr( $defaultDate ) . '"';
			$html[] = ' data-year_range="' . esc_attr( $yearRange ) . '"';
			$html[] = ' data-alt_format="' . esc_attr( $altFormat ) . '"';
			$html[] = '></div>';

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

			return $options;
		}
	}
}