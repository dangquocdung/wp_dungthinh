<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'style' => 'style-1',
	'alignment' => '',
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

$cls = $css = $content_css = '';
$cls = $alignment .' '. $style;
$content_css = 'margin-bottom: 0;';

if ( $font_weight != 'Default' ) $content_css .= 'font-weight:'. $font_weight .';';
if ( $letter_spacing ) $content_css .= 'letter-spacing:'. $letter_spacing .'px;';
if ( $font_size ) $content_css .= 'font-size:'. $font_size .'px;';
if ( $line_height ) $content_css .= 'line-height:'. $line_height .'px;';
if ( $font_family != 'Default' ) {
	wprt_enqueue_google_font( $font_family );
	$content_css .= 'font-family:'. $font_family .';';
}

if ( $content_color ) $content_css .= 'color:'. $content_color .';';
if ( $max_width ) $css .= 'margin: 0 auto;max-width:'. $max_width .'px;';
if ( $bottom_margin ) $css .= 'margin-bottom:'. $bottom_margin .'px;';

printf(
	'<div class="wprt-single-heading clearfix %1$s" style="%2$s">
		<%5$s class="heading" style="%3$s"><span class="text">%4$s</span><span class="line"></span></%5$s>
	</div>',
	$cls,
	$css,
	$content_css,
	$content,
	$tag
); ?>