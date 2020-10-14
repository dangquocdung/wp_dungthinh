<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'arrow' => 'simple',
	'padding' => '10px 0px 10px 0px',
	'margin' => '0px 0px 0px 0px',
	'border_color' => '#dddddd',
	'border_width' => '1px 0px 1px 0px',
	'border_style' => 'solid',
	'title' => '',
	'title_color' => '',
	'title_width' => '150px',
	'text_color' => '',
	'title_font_family' => 'Default',
	'title_font_weight' => 'Default',
	'title_font_size' => '',
	'text_font_family' => 'Default',
	'text_font_weight' => 'Default',
	'text_font_size' => '',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$title_width = intval( $title_width );

$title_font_size = intval( $title_font_size );
$text_font_size = intval( $text_font_size );

$html = $cls = $css = $icon_html = '';
$title_css = $text_css = '';
$css .= 'border-style:'. $border_style .';';

if ( $border_color && $border_width ) $css .= 'border-width: '. $border_width .';border-color:'. $border_color .';';
if ( $padding ) $css .= 'padding:'. $padding .';';
if ( $margin ) $css .= 'margin:'. $margin .';';

if ( $title_font_weight != 'Default' ) $title_css .= 'font-weight:'. $title_font_weight .';';
if ( $title_color ) $title_css .= 'color:'. $title_color .';';
if ( $title_font_size ) $title_css .= 'font-size:'. $title_font_size .'px;';
if ( $title_width ) $title_css .= 'width:'. $title_width .'px;';
if ( $title_font_family != 'Default' ) {
	wprt_enqueue_google_font( $title_font_family );
	$title_css .= 'font-family:'. $title_font_family .';';
}

if ( $text_font_weight != 'Default' ) $text_css .= 'font-weight:'. $text_font_weight .';';
if ( $text_color ) $text_css .= 'color:'. $text_color .';';
if ( $text_font_size ) $text_css .= 'font-size:'. $text_font_size .'px;';
if ( $text_font_family != 'Default' ) {
	wprt_enqueue_google_font( $text_font_family );
	$text_css .= 'font-family:'. $text_font_family .';';
}

if ( $arrow == 'style-1' ) $icon_html = '<i class="craft-plus2"></i>';
if ( $arrow == 'style-2' ) $icon_html = '<i class="craft-arrow-right4"></i>';
if ( $arrow == 'style-3' ) $icon_html = '<i class="craft-arrow-right5"></i>';

if ( $title ) {
	$html .= sprintf('
		<div class="title" style="%1$s">
			%3$s %2$s
		</div>',
		$title_css,
		$title,
		$icon_html
	);	
}

if ( $content ) {
	$html .= sprintf('
		<div class="text" style="%1$s">
			%2$s
		</div>',
		$text_css,
		$content
	);	
}

printf(
	'<div class="wprt-info-list clearfix %1$s" style="%2$s">%3$s</div>',
	$cls,
	$css,
	$html 
);