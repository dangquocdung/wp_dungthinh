<?php
// single portfolio script
function rdn_single_portfolio_script() {
	global $post;
	if ( is_singular( 'portfolio' ) ) {
		wp_enqueue_script('jquery-slick' ,plugins_url( '/element/js/slick.min.js' , __FILE__ ) , array('jquery'), null, true );
		wp_enqueue_script('slick-slider-animation' ,plugins_url( '/element/js/slick-animation.js' , __FILE__ ) , array('jquery'), null, true );
        wp_enqueue_script('imgbg-script',plugins_url( '/element/js/imgbg.js' , __FILE__ ) , array('jquery'), null, true );
		wp_enqueue_script('single-portfolio',plugins_url( '/element/js/portfolio.js' , __FILE__ ) , array('jquery'), null, true );
		wp_enqueue_script('slider-script',plugins_url( '/element/js/slider.js' , __FILE__ ) , array('jquery'), null, true );
		if (get_post_meta($post->ID, 'port_format', true) == 'port_two' && get_post_meta($post->ID, 'top_type', true) == 'top_content_slider' ){
			wp_enqueue_script('sliderbg-script',plugins_url( '/element/js/sliderbg.js' , __FILE__ ) , array('jquery'), null, true );
		}
		if (get_post_meta($post->ID, 'port_format', true) == 'port_two' && get_post_meta($post->ID, 'top_type', true) == 'top_content_youtube' ){
			wp_enqueue_script( 'cordon_ytPlayer', plugins_url( '/element/js/jquery.mb.YTPlayer.js' , __FILE__ ) ,array(),'', 'in_footer');
			wp_enqueue_script( 'cordon_homeyt', plugins_url( '/element/js/homeyt.js' , __FILE__ ) ,array(),'', 'in_footer');
		}
		if (get_post_meta($post->ID, 'port_format', true) == 'port_two' && get_post_meta($post->ID, 'top_type', true) == 'top_content_video' ){
			wp_enqueue_script('jquery-videojs',plugins_url( '/element/js/video.js' , __FILE__ ) , array('jquery'), null, true );
			wp_enqueue_script('jquery-big-video',plugins_url( '/element/js/bigvideo.js' , __FILE__ ) , array('jquery'), null, true );
			wp_enqueue_script('cordon-single-portfolio-video',plugins_url( '/element/js/singleport-video.js' , __FILE__ ) , array('jquery'), null, true );
		}
		
    }

}

add_action( 'wp_enqueue_scripts', 'rdn_single_portfolio_script',100 );



