<?php
/*
 * Define class AArpr_Settings
 * Make sure you skip down to the end of this file, as there are a few
 * lines of code that are very important.
 */
!defined('ABSPATH') and exit;

if (class_exists('AArpr_Settings') != true) {
    
    class AArpr_Settings
    {
        /*
         * Some required plugin information
         */
        const VERSION = '1.0';
		public $plugin_alias = '';
		
		public $save_status = false;
        public $options = array();

		public static $size_values = array('small', 'medium', 'large');

		public $params = array();
		public $current = array(
			'box_id'				=> '',
			'options'			=> array(),
			'option_types'	=> array(),
		);


        /**
         * @var Singleton The reference to *Singleton* instance of this class
         */
        private static $instance;

        /**
         * Returns the *Singleton* instance of this class.
         *
         * @return Singleton The *Singleton* instance.
         */
        public static function getInstance( $plugin_alias='', $pms=array() )
        {
            if (null === static::$instance) {
                static::$instance = new static( $plugin_alias, $pms );
            }
            
            return static::$instance;
        }

        /*
         * Required __construct() function that initalizes the AArpr_Settings
         */
        public function __construct( $plugin_alias='', $pms=array() )
        {
        	$this->plugin_alias = !empty($plugin_alias) ? $plugin_alias : AArpr()->alias;

			$this->set_params( $pms );

            $this->save_settings();

        	$this->load_option_types();
        }

		public function set_params( $pms ) {
			if ( empty($pms) ) return false;
			if ( ! isset($pms['box_id'], $pms['options']) ) return false;

			$this->params = $pms;
			extract( $pms );

			// current box id
			$box_id = isset($box_id) ? $box_id : '';
			$this->current['box_id'] = $box_id;

			// current box options
			$opt = isset($options) ? $options : array();
			$this->current['options'] = $opt;

			// current box option types
			$opt_types = array();
			foreach ($this->current['options']['elements'] as $key => $val) {
				$opt_types[] = $val['type'];
			}
			$opt_types = array_unique($opt_types);
			$this->current['option_types'] = $opt_types;
			//var_dump('<pre>',$this->current['option_types'],'</pre>'); 
		}

        public function load_option_types()
        {
            foreach( glob( AArpr()->path( 'OPTION_TYPES_DIR', "/*/manifest.php" ) ) as $manifest_file ){
                require $manifest_file;

                if ( isset($manifest) && count($manifest) > 0 ) {

					$manifest_id = $manifest['id'];

					// is disabled?
					$is_disabled = isset($manifest['disabled']) && $manifest['disabled'] ? true : false;
					if ( $is_disabled ) continue 1;

					// need to be load in current box?
					if ( ! empty($this->current['option_types']) && ! in_array($manifest_id, $this->current['option_types']) ) continue 1;
					
					if ( ! isset($this->options[$manifest_id]) ) {

                        $manifest['realpath'] = realpath(dirname( $manifest_file )) . '/';
                        $this->options[$manifest_id] = $manifest;

                        if( file_exists( $manifest['realpath'] . $manifest['init_file'] ) ){
                            require_once realpath(dirname( $manifest_file )) . '/' . $manifest['init_file'];
                        }
                    }
                }
            } // end foreach
        }

		public function save_settings()
		{
			$box_id = isset( $_REQUEST['box_id'] ) ? (string) $_REQUEST['box_id'] : '';
			$form_saved = isset( $_REQUEST['' . ( $this->plugin_alias ) . '-form-saved'] )
				? (boolean) $_REQUEST['' . ( $this->plugin_alias ) . '-form-saved'] : false;

			if( $form_saved === true && trim($box_id) != "" ){
				$params = isset( $_REQUEST[$box_id] ) ? $_REQUEST[$box_id] : array();

				if( count($params) > 0 ){
					update_option( $box_id, $params );
					$this->save_status = true;
				} 
			}
		}
        
        /*
         * Build options, method
         * ---------------------
         * this will create you interface via options array elements
         */
        public function build_options( $options = array(), $box_id = '' )
        {
            // reset as array, this will stock all the html content, and at the end return it
            $html = array();

            if (count($options) == 0) {
                return 'Please fill with some options content first!';
            }
    
            $noRowElements = array(
                'ajax',
                'app',
                'html',
                //'message',
                'input-type-hidden',
            );
            $settings      = array();

            // get the values from DB
            $settings = get_option( $box_id );
			
            if( !isset($options['buttons']) || $options['buttons'] != false ){

                $html[] = '<form method="POST" class="' . ( $this->plugin_alias ) . '-form" id="' . ($box_id) . '" action="">';

    			$html[] = '<div class="' . $this->plugin_alias . '-message ' . $this->plugin_alias . '-success ' . ( $this->save_status == false ? $this->plugin_alias . '-display-none' : '' ) . '">Saved successfully!</div>';

                // create a hidden input for sending the prefix
                $html[] = 	'<input type="hidden" name="box_id" value="' . ($box_id) . '" />';
    			$html[] = 	'<input type="hidden" name="' . ( $this->plugin_alias ) . '-form-saved" value="1" />';
            }

           	$box = isset($options) ? $options : array();

			if( !isset($options['tabs_status']) || $options['tabs_status'] != false ){
            	$html[] = $this->tabs_header($box); // tabs html header
			}
  
            // loop the box elements
            if (isset($options['elements']) && count($options['elements']) > 0) {
                
                // loop the box elements now
                foreach ($options['elements'] as $elm_id => $value) {
                    
                    // some helpers. Reset an each loop, prevent collision
                    $val          = '';
                    $select_value = '';
                    $checked      = '';
                    $option_name  = isset($option_name) ? $option_name : '';
                    
                    // Set default value to $val
                    if (isset($value['std'])) {
                        $val = $value['std'];
                    }

                    // If the option is already saved, ovveride $val
                    if ( ( $value['type'] != 'info' ) ) {
                        if ( isset($settings[($elm_id)] )
                            && (
                                ( !is_array($settings[($elm_id)]) && @trim($settings[($elm_id)]) != "" )
                                ||
                                ( is_array($settings[($elm_id)]) )
                            )
                        ) {
                                $val = $settings[( $elm_id )];
                                // Striping slashes of non-array options
                                if ( !is_array($val) ) {
                                    $val = stripslashes( $val );
                                }
                        }
                    }

                    // If there is a description save it for labels
                    //$explain_value = '';
                    //if (isset($value['desc'])) {
                    //    $explain_value = $value['desc'];
                    //}

                    if ( ! in_array($value['type'], $noRowElements) ) {
                    	
						$row_css_reset = isset($value['row_css_reset']) && $value['row_css_reset']
							? ' AArpr-row-css-reset ' . $this->plugin_alias . '-row-css-reset' : '';
						//$row_css_reset = ''; //DEBUG

                        // the row and the label 
                        $row_label = (isset($value['label']) ? ucwords( $value['label'] ) : '');
						$row_label = (isset($value['title']) ? ucwords( $value['title'] ) : '');
                        $html[] = '<div class="' . ( $this->plugin_alias ) . '-form-row' . ($this->tabs_elements($box, $elm_id)) . $row_css_reset . '">';
						//if( $value['type'] != 'message' ){
							$html[] = 	'<label for="' . ( $box_id ) . '[' . ($elm_id) . ']">' . $row_label . '</label>';
							$html[] = 	'<div class="' . ( $this->plugin_alias ) . '-form-item">';
						//}
                    }

                    if( isset($this->options[$value['type']]) ){
                        $class = $this->options[$value['type']]['class'];
                        $class = $class::getInstance( $this->plugin_alias, array(
                        	'options'	=> $options,
                        	'box_id'		=> $box_id
						));
						$class->_set_box( $options );
                        $html[] = $class->_render( $elm_id, $box_id, $val, $value );
                    }
                    else{
                         $html[] = '<div class="' . ( $this->plugin_alias ) . '-message ' . ( $this->plugin_alias ) . '-message-error">Invalid option type: <strong>' . ( $value['type'] ) . '</strong></div>';
                    }

					// the element description
                    if( isset($value['desc']) ){
                        $html[] = '<span class="' . ( $this->plugin_alias ) . '-form-note">' . ( ucfirst( $value['desc'] ) ) . '</span>';
					}

  					if ( ! in_array($value['type'], $noRowElements) ) {
                        // close: .' . ( $this->plugin_alias ) . '-form-row
                        $html[] = '</div>';
                        //if( $value['type'] != 'message' ){
                        	$html[] = '</div>';	
                        //}
                    }
                }
            }
            
			if( !isset($options['buttons']) || $options['buttons'] != false ){
				// AArpr-message use for status message, default it's hidden
				$html[] = '<div class="' . $this->plugin_alias . '-message" id="' . $this->plugin_alias . '-status-box" style="display:none;"></div>';

				// buttons for saving settings
				$html[] = '<div class="' . $this->plugin_alias . '-button-row">
    				<input type="submit" value="Save Settings" class="' . $this->plugin_alias . '-button yellow ' . $this->plugin_alias . '-saveOptions" />
    			</div>';

    			$html[] = '<div class="' . $this->plugin_alias . '-message ' . $this->plugin_alias . '-success ' . ( $this->save_status == false ? $this->plugin_alias . '-display-none' : '' ) . '">Saved successfully!</div>';

				// close: form
				$html[] = '</form>';
			}

			// return the $html
			return implode("\n", $html);
        }

        //make Tabs!
        public function tabs_header( $box ) {
            $html = array();

            // get tabs
            $tabs = isset($box['tabs']) ? $box['tabs'] : array();
 
            if (is_array($tabs) && count($tabs)>0) {
                $html[] = '<ul class="' . $this->plugin_alias . '-settings-tabs">';
                foreach ($tabs as $key_tab => $value_tab) {
                    $html[] = '<li><a href="#' . ( $key_tab ) . '">' . ( $value_tab['label']  ) . '</a></li>';
                }
                $html[] = '</ul>';
            }

            // return the $html
            return implode("\n", $html);
        }

        public function tabs_elements($box, $elemKey) {
            // get tabs
            $__tabs = isset($box['tabs']) ? $box['tabs'] : array();

            $__ret = '';
            if (is_array($__tabs) && count($__tabs)>0) {
                foreach ($__tabs as $tabClass => $tabElements) {

                    $tabElements = $tabElements['elements'];
                    $tabElements = trim($tabElements);
                    $tabElements = array_map('trim', explode(',', $tabElements));

                    if (in_array($elemKey, $tabElements)) {
                        $__ret .= ($tabClass.' '); //support element on multiple tabs!
					}
                }
            }
            return ' '.trim($__ret).' ';
        }


		/**
		 * April 2016 - by Jimmy, george@aa-team.com
		 */
		public function build_element_size( $attrs=array() ) {
			$type = $attrs['type'];

			if( isset($attrs['force_width']) && trim($attrs['force_width']) != "" ){
				$attrs['width'] = $attrs['force_width'];
			}
			if( isset($attrs['force_height']) && trim($attrs['force_height']) != "" ){
				$attrs['height'] = $attrs['force_height'];
			}
			if( isset($attrs['size']) && trim($attrs['size']) != "" ){
				if ( in_array($attrs['size'], self::$size_values) ) {

					$width = '33.3%'; $height = '100px';
					$star_size = '16';
					switch ($attrs['size']) {
						case 'small':
							$width = '33.3%'; $height = '100px';
							$star_size = '16';
							break;
							
						case 'medium':
							$width = '66.7%'; $height = '200px';
							$star_size = '32';
							break;
							
						case 'large':
							$width = '99.9%'; $height = '350px';
							$star_size = '32';
							break;
					}
					
					$attrs['width'] = $width;
					if ( in_array($type, array('textarea', 'multiselect', 'multiselect_l2r')) ) {
						if ( 'multiselect_l2r' == $type ) {
							$height = ( (int) $height + 50 ) + 'px';
						}
						$attrs['height'] = $height;
					}
					if ( 'ratestar' == $type ) {
						$attrs['star_size'] = $star_size;
					}
				}
				else {
					$attrs['width'] = $attrs['size'];
				}
			}
			
			// validate width, height values
			foreach (array('width', 'height') as $prop) {
				if( isset($attrs["$prop"]) && trim($attrs["$prop"]) != "" ){
					switch ( substr($attrs["$prop"], -1) ) {
						case '%':
							break;
						
						case 'x':
							break;
							
						default:
							$attrs["$prop"] = ((int) $attrs["$prop"]) . 'px';
							break; 
					}
				}
			}

			return $attrs;
		}

		public function build_size_array()
		{
			$values = array();
			foreach ( self::$size_values as $val ) {
				$values[$val] = $val;
			}
			foreach( array_slice( range( 0, 100, 10), 1) as $val ){
				$val = $val . "%";
				$values[$val] = $val . ' of parent container';
			}

			return $values;
		}
    }
}