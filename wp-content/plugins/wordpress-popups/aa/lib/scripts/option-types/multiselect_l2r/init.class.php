<?php
if( !class_exists('AArpr_Option_Type_Multiselect_l2r') ){
	class AArpr_Option_Type_Multiselect_l2r extends AArpr_Settings 
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
			$this->manifest = $this->options['multiselect-l2r'];
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
			
			$the_id = ( $box_id ) . '-' . esc_attr($elm_id) . '%s';
			$the_name = ( $box_id ) . '[' . esc_attr($elm_id) . '%s]';

			$html[] = '<div class="' . $this->plugin_alias . '-item-' . ( $this->manifest['id'] ) . ' AArpr-item-' . ( $this->manifest['id'] ) . '"';
			$html[] = ' style="';
			if( isset($attrs['width']) && trim($attrs['width']) != "" ){
				$html[] = 'width:' . $attrs['width'] . ';';
			}
			if( isset($attrs['height']) && trim($attrs['height']) != "" ){
				$html[] = 'height:' . $attrs['height'] . ';';
			}
			$html[] = '">';


			// filter options as available or selected
			$attrs['options'] = (array) $attrs['options'];
			$available = array(); $selected = array();
			foreach ($attrs['options'] as $key => $option ) {
				if( '' != $val ) {
					if ( in_array($key, $val) ) {
						$selected[] = $key;
					}
				}
			}
			$available = array_diff(array_keys($attrs['options']), $selected);

			// available options
			$html[] = '<div class="AArpr-multiselect-l2r-half AArpr-multiselect-available" style="margin-right: 2%;">';
			if( isset($attrs['info']['left']) ){
				$html[] = '<h5>' . ( $attrs['info']['left'] ) . '</h5>';
			}
			$html[] = '<select multiple="multiple"';
			$html[] = ' id="' . sprintf($the_id, '-available') . '"';
			$html[] = ' name="' . sprintf($the_name, '-available') . '[]"';
			$html[] = ' class="multisel_l2r_available" style="';
			$html[] = '"';
			$html[] = '>';
			
			if (count($available) > 0) {
				foreach ($attrs['options'] as $key => $option ) {
					if ( !in_array($key, $available) ) continue 1;
					$html[] = '<option value="' . esc_attr( $key ) . '">' . esc_html( $option ) . '</option>';
				} 
			}

			$html[] = '</select>';
			$html[] = '</div>';

			// selected options
			$html[] = '<div class="AArpr-multiselect-l2r-half AArpr-multiselect-selected">';
			if( isset($attrs['info']['right']) ){
				$html[] = '<h5>' . ( $attrs['info']['right'] ) . '</h5>';
			}
			$html[] = '<select multiple="multiple"';
			$html[] = ' id="' . sprintf($the_id, '') . '"';
			$html[] = ' name="' . sprintf($the_name, '') . '[]"';
			$html[] = ' class="multisel_l2r_selected" style="';
			$html[] = '"';
			$html[] = '>';

			if (count($selected) > 0) {
				foreach ($attrs['options'] as $key => $option ) {
					if ( !in_array($key, $selected) ) continue 1;
					$isselected = ' selected="selected"'; 
					$html[] = '<option'. $isselected .' value="' . esc_attr( $key ) . '">' . esc_html( $option ) . '</option>';
				} 
			}
			$html[] = '</select>';
			$html[] = '</div>';

			// left & right buttons
			$btn_id = sprintf($the_id, '');
			$btn_size = 'AArpr-button gray';
			if ( 'small' == $attrs['size'] ) {
				$btn_size .= ' AArpr-small';
			}
			
			$html[] = '<div style="clear:both"></div>';
			$html[] = '<div class="AArpr-multiselect-l2r-btn">';
			$html[] = 	'<span style="display: inline-block; width: 24%; text-align: center;">';
			$html[] = 		'<input id="' . $btn_id . '-moveright" type="button" value="' . __('Move Right', 'AArpr') . '" class="moveright ' . $btn_size . '">';
			$html[] = 	'</span>';
			$html[] = 	'<span style="display: inline-block; width: 24%; text-align: center;">';
			$html[] = 		'<input id="' . $btn_id . '-moverightall" type="button" value="' . __('Move Right All', 'AArpr') . '" class="moverightall ' . $btn_size . '">';
			$html[] = 	'</span>';
			$html[] = 	'<span style="display: inline-block; width: 24%; text-align: center;">';
			$html[] = 		'<input id="' . $btn_id . '-moveleft" type="button" value="' . __('Move Left', 'AArpr') . '" class="moveleft ' . $btn_size . '">';
			$html[] = 	'</span>';
			$html[] = 	'<span style="display: inline-block; width: 24%; text-align: center;">';
			$html[] = 		'<input id="' . $btn_id . '-moveleftall" type="button" value="' . __('Move Left All', 'AArpr') . '" class="moveleftall ' . $btn_size . '">';
			$html[] = 	'</span>';
			$html[] = '</div>';


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