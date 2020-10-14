<?php 
	/**  Theme_index  **/

	/* Define library Theme path */

    include_once( get_template_directory() . '/library/theme/styles_scripts.php' );
    include_once( get_template_directory() . '/library/theme/functions.php' );
    include_once( get_template_directory() . '/library/theme/blog.php' );
    include_once( get_template_directory() . '/library/theme/filters.php' );
    include_once( get_template_directory() . '/library/theme/import.php' );
    include_once( get_template_directory() . '/library/theme/comment_walker.php' );
    include_once( get_template_directory() . '/library/theme/menu_walker.php' );
    include_once( get_template_directory() . '/library/theme/portfolio_walker.php' );
    include_once( get_template_directory() . '/library/theme/customizer.php' );
    include_once( get_template_directory() . '/library/theme/woo.php' );
    include_once( get_template_directory() . '/library/theme/defaults.php' );

	include_once( get_template_directory() . '/library/about.php');

	add_action('after_setup_theme', 'fixar_theme_support_setup');
	function fixar_theme_support_setup(){
		add_theme_support('fixar_customize_opt');
		add_theme_support('default_customize_opt');
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
		add_image_size('fixar-thumb', 70, 70, false);
		// Define various thumbnail sizes
		$width = ( ( fixar_get_option( 'portfolio_settings_thumb_width', '556' ) ) &&
					 is_numeric( fixar_get_option( 'portfolio_settings_thumb_width', '556' ) ) &&
					 fixar_get_option( 'portfolio_settings_thumb_width', '556' ) > 0
				 ) ? fixar_get_option( 'portfolio_settings_thumb_width', '556' ) : 556;
		$height = ( ( fixar_get_option( 'portfolio_settings_thumb_height', '556' ) ) &&
					 is_numeric( fixar_get_option( 'portfolio_settings_thumb_height', '556' ) ) &&
					 fixar_get_option( 'portfolio_settings_thumb_height', '556' ) > 0
				 ) ? fixar_get_option( 'portfolio_settings_thumb_height', '556' ) : 556;
		add_image_size('fixar-portfolio-thumb', $width, $height, true);
		add_image_size('fixar-pix-puzzle-thumb-x', $width, $height/2, true);
		add_image_size('fixar-pix-puzzle-thumb-y', $width/2, $height, true);
		add_image_size('fixar-pix-puzzle-thumb-xy', $width/2, $height/2, true);
		add_image_size('fixar-portfolio-single', 620);
		add_image_size('fixar-news-thumb', 620, 415, true );
		add_image_size('fixar-services-thumb', 350, 233, true);
		add_image_size('fixar-application-thumb', 215, 380, true);

		global $pagenow;

//		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
//
//			wp_redirect(admin_url("themes.php?page=adminpanel")); // Your admin page URL
//
//		}

	}

	if ( ! isset( $content_width ) ) {
		$content_width = 1200;
	}

	//add_action( 'admin_menu', 'fixar_dashboard_menu' );
	function fixar_dashboard_menu(){
		remove_submenu_page( 'kaswara-framework', 'kaswara-demo-importer' );
	}

?>