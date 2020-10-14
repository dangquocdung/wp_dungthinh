<?php
if( !class_exists('AArpr_Option_Type_Upload_Image') ){
	class AArpr_Option_Type_Upload_Image extends AArpr_Settings 
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
			$this->manifest = $this->options['upload-image'];
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
			$thumbSize = array_merge(array(
				'w'		=> '100',
				'h'		=> '100',
				'zc'	=> '2',
			), $attrs);

			$html[] = '<table border="0">';
			$html[] = 	'<tr>';
			$html[] = 		'<td>';
			$html[] = 			'<input class="upload-input-text" name="' . ( $the_name ) . '" id="' . ( $the_id ) . '_upload" type="text" value="' . ( $val ) . '" />';

			$html[] = 			'<script type="text/javascript">
								jQuery("#' . ( $the_id ) . '_upload").data({
									"w"		: ' . ( $thumbSize['w'] ) . ',
									"h"		: ' . ( $thumbSize['h'] ) . ',
									"zc"	: ' . ( $thumbSize['zc'] ) . '
								});
								</script>';

			$html[] = 		'</td>';
			$html[] = 		'<td>';
			$html[] = 			'<a href="#" class="button upload_button" id="' . ( $the_id ) . '">' . ( $attrs['value'] ) . '</a> ';
			//$html[] =			'<a href="#" class="button reset_button ' . $hide . '" id="reset_' . ( $the_id ) . '" title="' . ( $the_id ) . '">' . __('Remove', 'AArpr') . '</a> ';
			$html[] = 		'</td>';
			$html[] = 	'</tr>';
			$html[] = '</table>';

			$html[] = '<a class="thickbox" id="uploaded_image_' . ( $the_id ) . '" href="' . ( $val ) . '" target="_blank">';

			if (!empty($val)) {
				$imgSrc = AArpr()->image_resize( $val, $thumbSize['w'], $thumbSize['h'], $thumbSize['zc'] );
				$html[] = '<img style="border: 1px solid #dadada;" id="image_' . ( $the_id ) . '" src="' . ( $imgSrc ) . '" />';
			}
			$html[] = '</a>';

			$html[] = '<script type="text/javascript">
				jQuery(document).ready(function(){
					AArpr_loadAjaxUpload( jQuery("#' . ( $the_id ) . '") );
				});
				</script>';


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