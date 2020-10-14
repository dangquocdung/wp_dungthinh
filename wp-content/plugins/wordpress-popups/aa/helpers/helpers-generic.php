<?php
/**
 * AArpr Main manager.
 *
 * @package AArpr
 * @since   1.0
 */
if ( ! function_exists( 'AArpr' ) ) {
	/**
	 * AArpr manager.
	 * @since 1.0
	 * @return AArpr
	 */
	function AArpr() {
		global $AArpr;
		return $AArpr;
	}
}

if ( ! function_exists( 'AArpr_Settings' ) ) {
	/**
	 * AArpr manager.
	 * @since 1.0
	 * @return AArpr_Settings
	 */
	function AArpr_Settings( $plugin_alias='', $pms=array() ) {

		return AArpr_Repository( 'AArpr_Settings', array(
			'call_init'				=> true,

			'plugin_alias' 			=> $plugin_alias,
			'pms' 					=> $pms,
		));
		// END HERE

		// load class
		require_once( AArpr()->path( 'DIR_LIB_SCRIPTS', 'option-types/settings.class.php' ) );

		return new AArpr_Settings( $plugin_alias, $pms );
	}
}

if ( ! function_exists( 'AArpr_Ajax_Result' ) ) {
	/**
	 * AArpr manager.
	 * @since 1.0
	 * @return AArpr_Ajax_Result
	 */
	function AArpr_Ajax_Result( $response="", $status="valid", $return='die_json') 
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

if ( ! function_exists( 'AArpr_Print_Grid' ) ) {
	/**
	 * AArpr manager.
	 * @since 1.0
	 * @return AArpr_Settings
	 */
	function AArpr_Print_Grid( $get_html='', $size='6', $title='' ) 
	{
		$alias = AArpr()->alias;
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

if ( ! function_exists( 'AArpr_Load_Styles' ) ) {
	/**
	 * AArpr manager.
	 * @since 1.0
	 * @return AArpr_Load_Styles
	 */
	function AArpr_Load_Styles( $css_files=array() ) 
	{
		if( count($css_files) > 0 ){
			return AArpr()->path( 'APP_URL', 'include/styles/load-style.php?files=' . implode( ",", $css_files ) );
		}
	}
}

if ( ! function_exists( 'AArpr_Settings_Build_Options' ) ) {
	/**
	 * AArpr manager.
	 * @since 1.0
	 * @return AArpr_Settings
	 */
	function AArpr_Settings_Build_Options( $options=array(), $box_id='', $pms=array() ) {
		$pms = array_replace_recursive( $pms, array(
			'options' 		=> $options,
			'box_id' 		=> $box_id
		));
		//var_dump('<pre>',$options,'</pre>');  
		$aa = AArpr_Settings( AArpr()->alias, $pms );
		return $aa->build_options( $options, $box_id );
	}
}

if ( ! function_exists( 'AArpr_Load_Options' ) ) {
	/**
	 * AArpr manager.
	 * @since 1.0
	 * @return AArpr_Settings
	 */
	function AArpr_Load_Options( $dir, $pms=array() ) {
	    AArpr_Settings( AArpr()->alias ); // save settings first!

	    $pms = array_replace_recursive(array(
	    	'file'				=> 'options.php',
		), $pms);
		extract( $pms );

		$options = array();

		// find if we have a options.php into the same folder
		$options_file = $dir . '/' . $file;
		if( is_file($options_file) ){

			ob_start();
			require_once $options_file;

			$content = ob_get_contents();
			ob_clean();
 
			if( trim($content) != "" ){
				$options = json_decode( $content, true );
			}
		}
		return $options;
	}
}

if ( ! function_exists( 'AArpr_mapper' ) ) {
	/**
	 * Shorthand for AArpr Mapper.
	 * @since 1.0
	 * @return AArpr_Mapper
	 */
	function AArpr_mapper() {
		return AArpr()->mapper();
	}
}

if ( ! function_exists( 'AArpr_main_settings' ) ) {
	/**
	 * Shorthand for AArpr settings.
	 * @since 1.0
	 * @return AArpr_main_settings
	 */
	function AArpr_main_settings() {
		return AArpr()->settings();
	}
}

if ( ! function_exists( 'AArpr_path_dir' ) ) {
	/**
	 * Get file/directory path in AArpr.
	 *
	 * @param string $name - path name
	 * @param string $file
	 *
	 * @since 1.0
	 * @return string
	 */
	function AArpr_path_dir( $name, $file = '' ) {
		return AArpr()->path( $name, $file );
	}
}

if ( ! function_exists( 'AArpr_upload_dir' ) ) {
	/**
	 * Temporary files upload dir;
	 * @since 1.0
	 * @return string
	 */
	function AArpr_upload_dir() {
		return AArpr()->uploadDir();
	}
}

if ( ! function_exists( 'AArpr_post_param' ) ) {
	/**
	 * Get param value from $_POST if exists.
	 *
	 * @param $param
	 * @param $default
	 *
	 * @since 1.0
	 * @return null|string - null for undefined param.
	 */
	function AArpr_post_param( $param, $default = null ) {
		return isset( $_POST[ $param ] ) ? $_POST[ $param ] : $default;
	}
}

if ( ! function_exists( 'AArpr_get_param' ) ) {
	/**
	 * Get param value from $_GET if exists.
	 *
	 * @param $param
	 * @param $default
	 *
	 * @since 1.0
	 * @return null|string - null for undefined param.
	 */
	function AArpr_get_param( $param, $default = null ) {
		return isset( $_GET[ $param ] ) ? $_GET[ $param ] : $default;
	}
}

if ( ! function_exists( 'AArpr_request_param' ) ) {
	/**
	 * Get param value from $_REQUEST if exists.
	 *
	 * @param $param
	 * @param $default
	 *
	 * @since 4.4
	 * @return null|string - null for undefined param.
	 */
	function AArpr_request_param( $param, $default = null ) {
		return isset( $_REQUEST[ $param ] ) ? $_REQUEST[ $param ] : $default;
	}
}

if ( ! function_exists( 'AArpr_action' ) ) {
	/**
	 * Get AArpr special action param.
	 * @since 1.0
	 * @return string|null
	 */
	function AArpr_action() {
		$AArpr_action = 'dashboard';
		if ( isset( $_GET['AArpr_action'] ) ) {
			$AArpr_action = $_GET['AArpr_action'];
		} elseif ( isset( $_POST['AArpr_action'] ) ) {
			$AArpr_action = $_POST['AArpr_action'];
		}
		
		return $AArpr_action;
	}
}

if ( ! function_exists( 'AArpr_asset_url' ) ) {
	/**
	 * Get full url for assets.
	 *
	 * @param string $file
	 *
	 * @since 4.2
	 * @return string
	 */
	function AArpr_asset_url( $file ) {
		return AArpr()->assetUrl( $file );
	}
}

if ( ! function_exists( 'AArpr_locate_template' ) ) {
	function AArpr_locate_template( $template_name, $template_path = '', $default_path = '' ) 
	{
	    if ( ! $template_path ) {
	        $template_path = 'templates/';
	    }

	    if ( ! $default_path ) {
	        $default_path = AArpr()->path( 'TEMPLATES_DIR', '' );
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
	    return apply_filters( 'AArpr_locate_template', $template, $template_name, $template_path );
	}
}

if ( ! function_exists( 'AArpr_plugin_name' ) ) {
	/**
	 * Plugin name for AArpr.
	 *
	 * @since 1.0
	 * @return string
	 */
	function AArpr_plugin_name() {
		return AArpr()->pluginName();
	}
}

if ( ! function_exists( 'AArpr_page' ) ) {
	/**
	 * Get AArpr special page param.
	 * @since 1.0
	 * @return string|null
	 */
	function AArpr_page() {
		$AArpr_page = '';
		if ( isset( $_GET['page'] ) ) {
			$AArpr_page = $_GET['page'];
		} elseif ( isset( $_POST['page'] ) ) {
			$AArpr_page = $_POST['page'];
		}

		return $AArpr_page;
	}
}
?>