<?php
/**
 * Visual Composer Library
 * Common Fields
 */
class EuniceLib {

	// Get Theme Name
	public static function ence_cat_name() {
		return esc_html__( "by VictorThemes", 'eunice-core' );
	}

	// Extra Class
	public static function vt_class_option() {
		return array(
		  "type" => "textfield",
		  "heading" => esc_html__( "Extra class name", 'eunice-core' ),
		  "param_name" => "class",
		  'value' => '',
		  "description" => esc_html__( "Custom styled class name.", 'eunice-core')
		);
	}

}

/*
 * Load All Shortcodes within a directory of visual-composer/shortcodes
 */
function ence_all_shortcodes() {
	$dirs = glob( EUNICE_SHORTCODE_PATH . '*', GLOB_ONLYDIR );
	if ( !$dirs ) return;
	foreach ($dirs as $dir) {
		$dirname = basename( $dir );

		/* Include all shortcodes backend options file */
		$options_file = $dir . DS . $dirname . '-options.php';
		$options = array();
		if ( file_exists( $options_file ) ) {
			include_once( $options_file );
		} else {
			continue;
		}

		/* Include all shortcodes frondend options file */
		$shortcode_class_file = $dir . DS . $dirname .'.php';
		if ( file_exists( $shortcode_class_file ) ) {
			include_once( $shortcode_class_file );
		}
	}
}
ence_all_shortcodes();

if( ! function_exists( 'vc_add_shortcode_param' ) && function_exists( 'add_shortcode_param' ) ) {
  function vc_add_shortcode_param( $name, $form_field_callback, $script_url = null ) {
    return add_shortcode_param( $name, $form_field_callback, $script_url );
  }
}

/* Inline Style */
global $all_inline_styles;
$all_inline_styles = array();
if( ! function_exists( 'add_inline_style' ) ) {
  function add_inline_style( $style ) {
    global $all_inline_styles;
    array_push( $all_inline_styles, $style );
  }
}

/* Enqueue Inline Styles */
if ( ! function_exists( 'eunice_enqueue_inline_styles' ) ) {
  function eunice_enqueue_inline_styles() {

    global $all_inline_styles;

    if ( ! empty( $all_inline_styles ) ) {
      echo '<style id="eunice-inline-style" type="text/css">'. eunice_compress_css_lines( join( '', $all_inline_styles ) ) .'</style>';
    }

  }
  add_action( 'wp_footer', 'eunice_enqueue_inline_styles' );
}

/* Validate px entered in field */
if( ! function_exists( 'eunice_core_check_px' ) ) {
  function eunice_core_check_px( $num ) {
    return ( is_numeric( $num ) ) ? $num . 'px' : $num;
  }
}
