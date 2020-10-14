<?php 
//preloader custom setting
function cordon_preloader_set() {
	if  ( function_exists( 'ot_get_option' )){
        $color =  ot_get_option( 'loader_color' );
        $loader_bg = "
		#preloader{background-color: $color;}
		";   
		if ( function_exists( 'ot_get_option' ) && ot_get_option( 'loader_color' )) {           
        wp_add_inline_style( 'cordon-theme-style', $loader_bg );
		}
	}
}


function cordon_preloader() {
	if  ( function_exists( 'ot_get_option' )){
		$preload = ot_get_option( 'preloader_set' );
		if ( function_exists( 'ot_get_option' ) ) : if ($preload == 'show_home') :
			wp_enqueue_script( 'preloader', get_template_directory_uri() . '/js/loader.js',array(),'', 'in_footer');
			endif ;  endif;
		if ( function_exists( 'ot_get_option' ) ) : if ($preload == 'show_all') :
			wp_enqueue_script( 'preloader', get_template_directory_uri() . '/js/loader.js',array(),'', 'in_footer');
			endif ;  endif;
	}
}    



