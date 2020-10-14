<?php
if( !class_exists('AArpr_Option_Type_Upload_Image_WP') ){
	class AArpr_Option_Type_Upload_Image_WP extends AArpr_Settings 
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
			$this->manifest = $this->options['upload-image-wp'];
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


			// build upload wp image box
			$image = ''; $image_full = '';

			$preview_size = (isset($attrs['preview_size']) ? $attrs['preview_size'] : 'thumbnail');
			if ( (int) $val > 0 ) {
				$image = wp_get_attachment_image_src( $val, $preview_size );
				$image_full = wp_get_attachment_image_src( $val, 'full' );
				if( count($image) > 0 ){
					$image = $image[0];
				}
				if( count($image_full) > 0 ){
					$image_full = $image_full[0];
				}
			}
			
			$btn_size = 'AArpr-button';
			if ( 'small' == $attrs['size'] ) {
				$btn_size .= ' AArpr-small';
			}

			$html[] = '<div class="AArpr-upload-image-wp-box">';
			$html[] = 	'<a data-previewsize="' . ( $preview_size ) . '" class="upload_image_button_wp ' . $btn_size . ' blue" style="' . ( trim($val) != '' ? 'display: none;' : '' ) . '" href="#">' . ( $attrs['value'] ) . '</a>';
			$html[] = 	'<input type="hidden"';
			$html[] = 	' value="' . esc_attr($val) . '"';
			//$html[] = 	' id="' . $the_id . '"';
			$html[] = 	' name="' . $the_name . '"';
			$html[] = 	'/>';

			if ( !empty($image_full) ) {
				$html[] = 	'<a href="' . ( $image_full ) . '" target="_blank" class="upload_image_preview" style="display: ' . ( trim($val) == "" ? 'none' : 'block' ). '">';
			}
			if ( !empty($image) ) {
				$html[] =	'<img src="' . ( $image ) . '" style="display: ' . ( trim($val) == "" ? 'none' : 'inline-block' ). '">';
			}
			$html[] = 	'</a>';
			$html[] =	'<div class="AArpr-prev-buttons" style="display: ' . ( trim($val) == "" ? 'none' : 'inline-block' ). '">';
			$html[] = 		'<span class="change_image_button_wp ' . $btn_size . ' green">' . __('Change Image', 'AArpr') . '</span>';
			$html[] = 		'<span class="remove_image_button_wp ' . $btn_size . ' red">' . __('Remove Image', 'AArpr') . '</span>';
			$html[] =	'</div>';
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