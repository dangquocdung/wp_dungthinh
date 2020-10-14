<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'style' => 'style-1',
	'alignment' => '',
	'gb_color' => '#b9e9e9',
	'bg_height' => '13px',
	'padding' => '0px 5% 3px 5%',
	'tag' => 'h2',
	'content_color' => '',
	'max_width' => '',
	'bottom_margin' => '',
	'font_family' => 'Default',
	'font_weight' => 'Default',
	'font_size' => '',
	'line_height' => '',
	'letter_spacing' => ''
), $atts ) );

$line_height = intval( $line_height );
$font_size = intval( $font_size );
$max_width = intval( $max_width );
$letter_spacing = intval( $letter_spacing );
$bottom_margin = intval( $bottom_margin );
$bg_height = intval( $bg_height );

$html = $cls = $css = $content_css = $inner_css = $heading_cls = '';
$cls = $alignment .' '. $style;
$content_css = 'margin-bottom: 0;';

if ( $font_weight != 'Default' ) $content_css .= 'font-weight:'. $font_weight .';';
if ( $letter_spacing ) $content_css .= 'letter-spacing:'. $letter_spacing .'px;';
if ( $font_size ) $content_css .= 'font-size:'. $font_size .'px;';
if ( $line_height ) $content_css .= 'line-height:'. $line_height .'px;';
if ( $font_family != 'Default' ) {
	weberium_enqueue_google_font( $font_family );
	$content_css .= 'font-family:'. $font_family .';';
}

if ( $content_color ) $content_css .= 'color:'. $content_color .';';
if ( $max_width ) $css .= 'margin: 0 auto;max-width:'. $max_width .'px;';
if ( $bottom_margin ) $css .= 'margin-bottom:'. $bottom_margin .'px;';

if ( $style == 'style-1' )
$html = sprintf( '<%3$s class="heading" style="%1$s">%2$s</%3$s>', 	$content_css, $content, $tag );

if ( $style == 'style-2' )
$html = sprintf( '<%3$s class="heading" style="%1$s"><span class="text">%2$s</span><span class="line"></span></%3$s>', 	$content_css, $content, $tag );

if ( $padding ) $inner_css .= 'padding:'. $padding .';';

if ( $gb_color ) {
	if ( $gb_color == '#b9e9e9' ) {
		$heading_cls .= ' accent-2';
	} else {
		$inner_css .= 'background-image: -webkit-gradient(linear, left top, right top, from('. $gb_color .'), to('. $gb_color .'));';
		$inner_css .= 'background-image: linear-gradient(to right,'. $gb_color .' 0%, '. $gb_color .' 100%);';
	}
}

if ( $bg_height )
	$inner_css .= 'background-size: 100% '. $bg_height .'px;';

if ( $style == 'style-3' )
$html = sprintf( '<%3$s class="heading %5$s" style="%1$s"><span style="%4$s">%2$s</span></%3$s>', $content_css, $content, $tag, $inner_css, $heading_cls );

printf(
	'<div class="weberium-single-heading clearfix %1$s" style="%2$s">
		%3$s
	</div>',
	$cls,
	$css,
	$html
); ?>