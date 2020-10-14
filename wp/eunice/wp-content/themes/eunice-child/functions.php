<?php
/**
 * Enqueues child theme stylesheet, loading first the parent theme stylesheet.
 */
function eunice_custom_enqueue_child_theme_styles() {
	wp_enqueue_style( 'eunice-child-style', get_stylesheet_uri(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'eunice_custom_enqueue_child_theme_styles', 11 );