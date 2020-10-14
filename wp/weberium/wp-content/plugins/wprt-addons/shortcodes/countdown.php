<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'style' => 'style-1',
    'time' => 'December 30, 2018 8:30:00',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$cls = $style;

if ( $style == 'style-1' ) { $cls .= ' accent'; }
else { $cls .= ' accent-bg'; }

if ( $time ) {
	wp_enqueue_script( 'weberium-countdown' );

	printf( '<div class="weberium-countdown clearfix %1$s" data-date="%2$s"></div>', $cls, esc_html( $time ) );
}
