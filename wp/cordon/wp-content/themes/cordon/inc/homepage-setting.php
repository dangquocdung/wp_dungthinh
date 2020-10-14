<?php 
function cordon_homepage_script() {
	if ( is_page_template( 'homepage-slider.php' ) 
	|| is_page_template( 'homepage-custom-layout.php' ) && function_exists( 'ot_get_option' ) && ot_get_option( 'home_setting') == 'slider_bg_home' ){
		wp_enqueue_script( 'cordon_imagebg', get_template_directory_uri() . '/js/imagebg.js',array(),'', 'in_footer');
	} 
	
	if ( is_page_template( 'homepage-video.php' ) 
	|| is_page_template( 'homepage-custom-layout.php' ) && function_exists( 'ot_get_option' ) && ot_get_option( 'home_setting') == 'video_bg_home' ){
		wp_enqueue_script( 'cordon_video', get_template_directory_uri() . '/js/video.js',array(),'', 'in_footer');
		wp_enqueue_script( 'cordon_bigvideo', get_template_directory_uri() . '/js/bigvideo.js',array(),'', 'in_footer');
		wp_enqueue_script( 'cordon_homeyt', get_template_directory_uri() . '/js/homevid.js',array(),'', 'in_footer');
	} 
	if ( is_page_template( 'homepage-youtube.php' )|| 
	is_page_template( 'homepage-custom-layout.php' ) && function_exists( 'ot_get_option' ) && ot_get_option( 'home_setting') == 'youtube_bg_home' ){
		wp_enqueue_script( 'cordon_ytPlayer', get_template_directory_uri() . '/js/jquery.mb.YTPlayer.js',array(),'', 'in_footer');
		wp_enqueue_script( 'cordon_homeyt', get_template_directory_uri() . '/js/homeyt.js',array(),'', 'in_footer');
	}
}

