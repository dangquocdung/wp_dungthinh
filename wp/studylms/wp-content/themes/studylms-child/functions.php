<?php

function studylms_child_enqueue_styles() {
	if ( is_multisite() ) {
		wp_enqueue_style( 'studylms-child-style', get_stylesheet_uri() );
	} else {
		wp_enqueue_style( 'studylms-parent-style', get_template_directory_uri() . '/style.css' );
	}
}

add_action( 'wp_enqueue_scripts', 'studylms_child_enqueue_styles', 100 );