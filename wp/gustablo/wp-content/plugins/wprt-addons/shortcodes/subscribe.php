<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'style' => 'style-1',
	'padding' => '',
	'background' => 'accent',
    'heading' => 'Newsletter Subscribe',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$cls = $css = '';
$cls .= $style .' bg-'. $background;
if ( $padding ) $css .= 'padding:'. $padding .';';

if ( class_exists('MC4WP_MailChimp') ) {
	echo '<div class="wprt-subscribe clearfix '. $cls .'" style="'. $css .'"><div class="text-wrap"><div class="heading-wrap">';
	if ( $heading ) echo '<h5 class="heading">'. $heading .'</h5>';
	echo '</div></div>';
	mc4wp_show_form(0);
	echo '</div>';
}