<?php
if( !class_exists('AArpr_Option_Type_Time') ){
	class AArpr_Option_Type_Time extends AArpr_Settings 
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
			$this->manifest = $this->options['time'];
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

			// params
			$timeFormat = 'HH:mm:ss';
			if ( isset($attrs['timeFormat']) && $attrs['timeFormat'] )
				$timeFormat = $attrs['timeFormat'];

			$__hourminsec_init = $this->getTimeDefault( $val );
			//$__hourminsec_init = array();
			//if ( isset($attrs['std']) && !empty($attrs['std']) )
			//	$__hourminsec_init = $this->getTimeDefault( $attrs['std'] );
			//if ( isset($attrs['defaultDate']) && !empty($attrs['defaultDate']) )
			//	$__hourminsec_init = $this->getTimeDefault( $attrs['defaultDate'] );
										
			$__hour_range = array();
			if ( isset($attrs['hour_range']) && !empty($attrs['hour_range']) )
				$__hour_range = $this->getTimeDefault( $attrs['hour_range'] );
										
			$__min_range = array();
			if ( isset($attrs['min_range']) && !empty($attrs['min_range']) )
				$__min_range = $this->getTimeDefault( $attrs['min_range'] );
				
			$__sec_range = array();
			if ( isset($attrs['sec_range']) && !empty($attrs['sec_range']) )
				$__sec_range = $this->getTimeDefault( $attrs['sec_range'] );

			$html[] = '<div class="AArpr-time-settings" style="display: none;"';
			$html[] = ' data-time_format="' . esc_attr( $timeFormat ) . '"';
			$html[] = ' data-hourminsec="' . esc_attr( implode( ':', $__hourminsec_init ) ) . '"';
			$html[] = ' data-hour_range="' . esc_attr( implode( ':', $__hour_range ) ) . '"';
			$html[] = ' data-min_range="' . esc_attr( implode( ':', $__min_range ) ) . '"';
			$html[] = ' data-sec_range="' . esc_attr( implode( ':', $__sec_range ) ) . '"';
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
	
		// retrieve default from option
		private function getTimeDefault( $range='0:0:0' ) {
			
			if ( empty($range) ) return array(0, 0, 0);
			
			$range = isset($range) && !empty($range) ? $range : '0:0:0';
			$range = explode(':', $range);

			if ( count($range)==3 )
				return array( (int) $range[0], (int) $range[1], (int) $range[2] );
			else if ( count($range)==2 )
				return array( (int) $range[0], (int) $range[1], 0 );
			else if ( count($range)==1 )
				return array( (int) $range[0], 0, 0 );
			else 
				return array(0, 0, 0);
		}
	}
}