<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
    'border_color' => 'light',
    'border_style' => 'dotted',
    'wrap' => 'true',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$css = $cls = '';
$cls .= $border_style;
if ( $wrap == 'false' ) $cls .= ' no-border-wrap';
if ( $border_color == 'very-light' ) $cls .= ' very-light';

printf(
	'<div class="wprt-grid-box clearfix %2$s">
		%1$s
	</div>',
	do_shortcode($content),
	$cls
);