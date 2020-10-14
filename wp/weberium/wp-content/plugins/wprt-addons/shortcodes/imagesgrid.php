<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'mode' => 'grid',
	'auto' => 'false',
	'image_crop'	=> 'auto2',
	'images'	=> '',
	'column'		=> '4c',
	'column2'		=> '3c',
	'column3'		=> '2c',
	'column4'		=> '1c',
	'gapv'			=> '30',
	'gaph'			=> '30',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$column = intval( $column );
$column2 = intval( $column2 );
$column3 = intval( $column3 );
$column4 = intval( $column4 );
$gapv = intval( $gapv );
$gaph = intval( $gaph );

if ( empty( $gapv ) ) $gapv = 0;
if ( empty( $gaph ) ) $gaph = 0;


$html = '';
if ( ! empty( $images ) ) {
	wp_enqueue_script( 'weberium-cubeportfolio' );
	wp_enqueue_script( 'weberium-magnificpopup' );
	$images = explode( ',', trim($images) );

	$html  .= '<div class="weberium-images-grid" data-layout="'. $mode .'" data-column="'. esc_attr( $column ) .'" data-column2="'. esc_attr( $column2 ) .'" data-column3="'. esc_attr( $column3 ) .'" data-column4="'. esc_attr( $column4 ) .'" data-gaph="'. esc_html( $gaph ) .'" data-gaph="'. esc_html( $gaph ) .'" data-gapv="'. esc_html( $gapv ) .'" data-auto="'. $auto .'">';

	$html .= '<div id="images-wrap" class="cbp">';

	for ( $i=0; $i<count($images); $i++ ) {
	    $img_size = 'weberium-small-auto';
	    if ( $image_crop == 'square' ) $img_size = 'weberium-square';
	    if ( $image_crop == 'rectangle' ) $img_size = 'weberium-rectangle';
	    if ( $image_crop == 'rectangle2' ) $img_size = 'weberium-rectangle2';
	    if ( $image_crop == 'auto1' ) $img_size = 'weberium-medium-auto';
	    if ( $image_crop == 'auto3' ) $img_size = 'weberium-xsmall-auto';
	    if ( $image_crop == 'full' ) $img_size = 'full';

		$img_b = wp_get_attachment_image_src( $images[$i], $img_size );
		$img_f = wp_get_attachment_image_src( $images[$i], 'full' );

		$html .= sprintf('<div class="cbp-item"><div class="item-wrap"><a class="zoom-popup" href="%2$s"><i class="nz-magnifier3"></i></a><img src="%1$s" alt="image" /></div></div>',
			$img_b[0],
			$img_f[0]
		);
	}
	$html .= '</div></div>';
}
echo $html;
