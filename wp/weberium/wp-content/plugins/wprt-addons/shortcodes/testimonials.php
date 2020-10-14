<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'image' => '',
	'image_width' => '',
	'image_style' => 'image-circle',
	'text' => '',
	'text_color' => '',
	'wrap_background' => '#f0f0f0',
	'wrap_padding' => '',
	'wrap_rounded' => '',
	'box_shadow' => '',
	'name' => 'JOHN ROE',
	'name_color' => '',
	'position' => 'Sale Manager',
	'position_color' => '',
	'text_font_family' => 'Default',
	'text_font_weight' => 'Default',
	'text_font_size' => '',
	'text_font_style' => 'normal',
	'text_line_height' => '',
	'name_font_family' => 'Default',
	'name_font_weight' => 'Default',
	'name_font_size' => '',
	'name_line_height' => '',
	'position_font_family' => 'Default',
	'position_font_weight' => 'Default',
	'position_font_size' => '',
	'position_line_height' => '',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$text_line_height = intval( $text_line_height );
$name_line_height = intval( $name_line_height );
$position_line_height = intval( $position_line_height );

$text_font_size = intval( $text_font_size );
$name_font_size = intval( $name_font_size );
$position_font_size = intval( $position_font_size );

$image_width = intval( $image_width );

$cls = $image_style;
$text_css = $name_css = $position_css = $thumb_css = $name_pos_css = '';
$inner_css = $inner_html = $image_html = $text_html = $name_html = $position_html = '';

if ( $box_shadow ) $cls .= ' has-shadow'; 

$text_css .= 'font-style:'. $text_font_style .';';
if ( $text_font_weight != 'Default' ) $text_css .= 'font-weight:'. $text_font_weight .';';
if ( $text_color ) $text_css .= 'color: '. $text_color .';';
if ( $text_font_size ) $text_css .= 'font-size:'. $text_font_size .'px;';
if ( $text_line_height ) $text_css .= 'line-height:'. $text_line_height .'px;';
if ( $text_font_family != 'Default' ) {
    weberium_enqueue_google_font( $text_font_family );
    $text_css .= 'font-family:'. $text_font_family .';';
}

if ( $name_font_weight != 'Default' ) $name_css .= 'font-weight:'. $name_font_weight .';';
if ( $name_color ) $name_css .= 'color: '. $name_color .';';
if ( $name_font_size ) $name_css .= 'font-size:'. $name_font_size .'px;';
if ( $name_line_height ) $name_css .= 'line-height:'. $name_line_height .'px;';
if ( $name_font_family != 'Default' ) {
    weberium_enqueue_google_font( $name_font_family );
    $name_css .= 'font-family:'. $name_font_family .';';
}

if ( $position_font_weight != 'Default' ) $position_css .= 'font-weight:'. $position_font_weight .';';
if ( $position_color ) $position_css .= 'color: '. $position_color .';';
if ( $position_font_size ) $position_css .= 'font-size:'. $position_font_size .'px;';
if ( $position_line_height ) $position_css .= 'line-height:'. $position_line_height .'px;';
if ( $position_font_family != 'Default' ) {
    weberium_enqueue_google_font( $position_font_family );
    $position_css .= 'font-family:'. $position_font_family .';';
}

if ( $image_width ) {
	$thumb_css .= 'width:'. $image_width .'px; height:'. $image_width .'px;';
}

if ( $image ) {
    $image_html .= sprintf(
        '<div class="thumb" style="%2$s">%1$s</div>',
         wp_get_attachment_image( $image, 'full' ), $thumb_css
    );
}

if ( $text )
$text_html .= sprintf(
	'<blockquote class="text" style="%2$s">
	%1$s
	</blockquote>',
	$text, $text_css
);

$text_html = sprintf(
	'<blockquote class="text" style="%2$s">%1$s</blockquote>',
	$text, $text_css
);

if ( $wrap_background ) {
	$inner_css .= 'background-color: '. $wrap_background .';';
} else {
	$inner_css .= 'background-color: transparent;';
}

if ( $wrap_padding ) $inner_css .= 'padding:'. $wrap_padding .';';
if ( $wrap_rounded ) $inner_css .= 'border-radius:'. $wrap_rounded .'px;';

if ( $name || $position ) {
	if ( $name ) {
	    $name_html .= sprintf(
	    '<h6 class="name" style="%2$s"><span>%1$s</span></h6>',
	    $name, $name_css
	    );
	}

	if ( $position ) {
	    $position_html .= sprintf(
	    '<span class="position" style="%2$s">%1$s</span>',
	    $position, $position_css
	    );
	}
}

$inner_html .= sprintf(
    '<div class="inner" style="%6$s">
    <div class="clearfix">
    %1$s
    <div class="name-wrap">
    	<div class="name-pos" style="%5$s">%3$s %4$s</div>
    </div>
    </div>
    %2$s
    </div>',
    $image_html, $text_html, $name_html, $position_html, $name_pos_css, $inner_css
);

printf(
    '<div class="weberium-testimonials clearfix %2$s">
        %1$s
    </div>', 
    $inner_html,
    $cls
);