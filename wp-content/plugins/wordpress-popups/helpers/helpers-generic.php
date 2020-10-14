<?php
/**
 * SMPNEW Main manager.
 *
 * @package SMPNEW
 * @since   1.0
 */
if ( ! function_exists( 'SMPNEW' ) ) {
	/**
	 * SMPNEW manager.
	 * @since 1.0
	 * @return SMPNEW
	 */
	function SMPNEW() {
		global $SMPNEW;
		return $SMPNEW;
	}
}

if ( ! function_exists( 'SMPNEW_Settings' ) ) {
	/**
	 * SMPNEW manager.
	 * @since 1.0
	 * @return SMPNEW_Settings
	 */
	function SMPNEW_Settings( $pms=array() ) {
		if ( ! function_exists( 'AArpr_Settings' ) ) {
			die( __FILE__ . ' | ' . __LINE__ . ' : ' . __('You need to install the AA repository!', 'SMPNEW') );
		}
		return AArpr_Settings( SMPNEW()->alias, $pms );
	}
}

if ( ! function_exists( 'SMPNEW_Ajax_Result' ) ) {
	/**
	 * SMPNEW manager.
	 * @since 1.0
	 * @return SMPNEW_Ajax_Result
	 */
	function SMPNEW_Ajax_Result( $response="", $status="valid", $return='die_json') 
	{
		$result = array();

		$result['status'] = $status;
		$result['response'] = $response;

		if( $return == 'die_json' ){
			die( json_encode( $result ) );
		}
		
		return $result;
	}
}

if ( ! function_exists( 'SMPNEW_Print_Grid' ) ) {
	/**
	 * SMPNEW manager.
	 * @since 1.0
	 * @return SMPNEW_Print_Grid
	 */
	function SMPNEW_Print_Grid( $get_html='', $size='6', $title='' ) 
	{
		$alias = SMPNEW()->alias;
		$html = array();
		
		$html[] = '<div class="' . ( $alias ) . '-grid-box ' . ( $alias ) . '-box-size-' . ( $size ) . '">';
		$html[] = 	'<div class="' . ( $alias ) . '-grid-box-content">';
		if( trim($title) != "" ){
			$html[] = 	'<h3 class="grid-box-label">' . ( $title ) . '</h3>';
		}
		$html[] = 		'<div class="' . ( $alias ) . '-grid-in-box-content">';
		$html[] = 			$get_html;
		$html[] = 		'</div>';
		$html[] = 	'</div>';
		$html[] = '</div>';

		return implode( "\n", $html );
	}
}

if ( ! function_exists( 'SMPNEW_Load_Styles' ) ) {
	/**
	 * SMPNEW manager.
	 * @since 1.0
	 * @return SMPNEW_Load_Styles
	 */
	function SMPNEW_Load_Styles( $css_files=array() ) 
	{
		if( count($css_files) > 0 ){
			return SMPNEW()->path( 'APP_URL', 'include/styles/load-style.php?files=' . implode( ",", $css_files ) );
		}
	}
}

if ( ! function_exists( 'SMPNEW_Settings_Build_Options' ) ) {
	/**
	 * SMPNEW manager.
	 * @since 1.0
	 * @return SMPNEW_Settings_Build_Options
	 */
	function SMPNEW_Settings_Build_Options( $options=array(), $box_id='', $pms=array() ) {
		$pms = array_replace_recursive( $pms, array(
			'options' 		=> $options,
			'box_id' 		=> $box_id
		));
		//var_dump('<pre>',$options,'</pre>');  
		$smpnew = SMPNEW_Settings( $pms );
		return $smpnew->build_options( $options, $box_id );
	}
}

if ( ! function_exists( 'SMPNEW_Load_Options' ) ) {
	/**
	 * SMPNEW manager.
	 * @since 1.0
	 * @return SMPNEW_Load_Options
	 */
	function SMPNEW_Load_Options( $dir, $pms=array() ) {
		SMPNEW_Settings(); // save settings first!

	    $pms = array_replace_recursive(array(
	    	'file'				=> 'options.php',
		), $pms);
		extract( $pms );

		$options = array();
			
		// find if we have a options.php into the same folder
		$options_file = $dir . '/' . $file;
		if( is_file($options_file) ){
			ob_start();
			require $options_file;

			$content = ob_get_contents();
			ob_clean();

			if( trim($content) != "" ){
				$options = json_decode( $content, true );
			}
		}
		return $options;
	}
}

if ( ! function_exists( 'SMPNEW_mapper' ) ) {
	/**
	 * SMPNEW manager.
	 * @since 1.0
	 * @return SMPNEW_Mapper
	 */
	function SMPNEW_mapper() {
		return SMPNEW()->mapper();
	}
}

if ( ! function_exists( 'SMPNEW_main_settings' ) ) {
	/**
	 * Shorthand for SMPNEW settings.
	 * @since 1.0
	 * @return SMPNEW_Settings
	 */
	function SMPNEW_main_settings() {
		return SMPNEW()->settings();
	}
}

if ( ! function_exists( 'SMPNEW_path_dir' ) ) {
	/**
	 * Get file/directory path in SMPNEW.
	 *
	 * @param string $name - path name
	 * @param string $file
	 *
	 * @since 1.0
	 * @return string
	 */
	function SMPNEW_path_dir( $name, $file = '' ) {
		return SMPNEW()->path( $name, $file );
	}
}

if ( ! function_exists( 'SMPNEW_upload_dir' ) ) {
	/**
	 * Temporary files upload dir;
	 * @since 1.0
	 * @return string
	 */
	function SMPNEW_upload_dir() {
		return SMPNEW()->uploadDir();
	}
}

if ( ! function_exists( 'SMPNEW_post_param' ) ) {
	/**
	 * Get param value from $_POST if exists.
	 *
	 * @param $param
	 * @param $default
	 *
	 * @since 1.0
	 * @return null|string - null for undefined param.
	 */
	function SMPNEW_post_param( $param, $default = null ) {
		return isset( $_POST[ $param ] ) ? $_POST[ $param ] : $default;
	}
}

if ( ! function_exists( 'SMPNEW_get_param' ) ) {
	/**
	 * Get param value from $_GET if exists.
	 *
	 * @param $param
	 * @param $default
	 *
	 * @since 1.0
	 * @return null|string - null for undefined param.
	 */
	function SMPNEW_get_param( $param, $default = null ) {
		return isset( $_GET[ $param ] ) ? $_GET[ $param ] : $default;
	}
}

if ( ! function_exists( 'SMPNEW_request_param' ) ) {
	/**
	 * Get param value from $_REQUEST if exists.
	 *
	 * @param $param
	 * @param $default
	 *
	 * @since 4.4
	 * @return null|string - null for undefined param.
	 */
	function SMPNEW_request_param( $param, $default = null ) {
		return isset( $_REQUEST[ $param ] ) ? $_REQUEST[ $param ] : $default;
	}
}

if ( ! function_exists( 'SMPNEW_action' ) ) {
	/**
	 * Get SMPNEW special action param.
	 * @since 1.0
	 * @return string|null
	 */
	function SMPNEW_action() {
		$SMPNEW_action = 'main';
		if ( isset( $_GET['SMPNEW_action'] ) ) {
			$SMPNEW_action = $_GET['SMPNEW_action'];
		} elseif ( isset( $_POST['SMPNEW_action'] ) ) {
			$SMPNEW_action = $_POST['SMPNEW_action'];
		}

		return $SMPNEW_action;
	}
}

if ( ! function_exists( 'SMPNEW_asset_url' ) ) {
	/**
	 * Get full url for assets.
	 *
	 * @param string $file
	 *
	 * @since 4.2
	 * @return string
	 */
	function SMPNEW_asset_url( $file ) {
		return SMPNEW()->assetUrl( $file );
	}
}

if ( ! function_exists( 'SMPNEW_locate_template' ) ) {
	function SMPNEW_locate_template( $template_name, $template_path = '', $default_path = '' ) 
	{
	    if ( ! $template_path ) {
	        $template_path = 'templates/';
	    }

	    if ( ! $default_path ) {
	        $default_path = SMPNEW()->path( 'TEMPLATES_DIR', '' );
	    }
 
	    // Look within passed path within the theme - this is priority.
	    $template = locate_template(
	        array(
	            trailingslashit( $template_path ) . $template_name,
	            $template_name
	        )
	    );

	    // Get default template/
	    if ( ! $template ) {
	        $template = $default_path . $template_name;
	    }

	    // Return what we found.
	    return apply_filters( 'SMPNEW_locate_template', $template, $template_name, $template_path );
	}
}

if ( ! function_exists( 'SMPNEW_plugin_name' ) ) {
	/**
	 * Plugin name for SMPNEW.
	 *
	 * @since 1.0
	 * @return string
	 */
	function SMPNEW_plugin_name() {
		return SMPNEW()->pluginName();
	}
}
		
if ( ! function_exists( 'SMPNEW_page' ) ) {
	/**
	 * Get AA special page param.
	 * @since 1.0
	 * @return string|null
	 */
	function SMPNEW_page() {
		$SMPNEW_page = '';
		if ( isset( $_GET['page'] ) ) {
			$SMPNEW_page = $_GET['page'];
		} elseif ( isset( $_POST['page'] ) ) {
			$SMPNEW_page = $_POST['page'];
		}

		return $SMPNEW_page;
	}
}
?>