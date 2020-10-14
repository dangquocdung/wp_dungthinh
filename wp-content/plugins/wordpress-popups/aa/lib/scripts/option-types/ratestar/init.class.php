<?php
if( !class_exists('AArpr_Option_Type_Ratestar') ){
	class AArpr_Option_Type_Ratestar extends AArpr_Settings 
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
			$this->manifest = $this->options['ratestar'];
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

			$html[] = '<input type="hidden"';
			$html[] = ' value="' . esc_attr($val) . '"';
			$html[] = ' id="' . $the_id . '"';
			$html[] = ' name="' . $the_name . '"';
			$html[] = '/>';

			$nbstars = isset($attrs['nbstars']) && !empty($attrs['nbstars']) ? $attrs['nbstars'] : 10;
			$step = isset($attrs['step']) && !empty($attrs['step']) ? $attrs['step'] : 1;
			$input = '#' . $the_id;
			$readonly = isset($attrs['readonly']) && !empty($attrs['readonly']) ? $attrs['readonly'] : false;
			$resetable = isset($attrs['resetable']) && !empty($attrs['resetable']) ? $attrs['resetable'] : true;
			$star_size = isset($attrs['star_size']) && !empty($attrs['star_size']) ? $attrs['star_size'] : 16;
			
			$star_css = 'AArpr-rateit';
			$star_css .= '32' == $star_size ? ' bigstars' : '';
			
			$html[] = '<div class="' . $star_css . '"';
			//$html[] = ' id="AArpr-rateit-' . esc_attr( $elm_id ) . '"';
			$html[] = ' data-nbstars="' . esc_attr( $nbstars ) . '"';
			$html[] = ' data-step="' . esc_attr( $step ) . '"';
			$html[] = ' data-input="' . esc_attr( $input ) . '"';
			$html[] = ' data-readonly="' . esc_attr( $readonly ) . '"';
			$html[] = ' data-resetable="' . esc_attr( $resetable ) . '"';
			$html[] = ' data-starwidth="' . esc_attr( $star_size ) . '"';
			$html[] = ' data-starheight="' . esc_attr( $star_size ) . '"';
			$html[] = '></div>';
			
			$html[] = '<output for="' . $the_id . '" value="' . esc_attr($val) . '">' . ( !empty($val) ? $val : 0 ) . '</output>';
			
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