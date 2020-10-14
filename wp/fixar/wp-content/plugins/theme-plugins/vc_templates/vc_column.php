<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_id
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column
 */
$el_class = $el_id = $width = $css = $offset = $css_animation = '';
$bg_image_src = $pix_gradient = $pix_gradient_style = $pix_gradient_class = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$jclass = $bgstyle == 'jarallax' ? 'vc_row_use_jarallax' : '';
$class_preset_text = ($ptextcolor) ? ' text-'.strtolower($ptextcolor) : '';
if ($ptextcolor == "Default")
	$class_preset_text = "";
$class_bg = $bgstyle == 'attachment' && !empty($bgimage) ? 'background-attachment-fixed' : '';
if( !empty($bgimage) ){
	$bg_image_id = preg_replace( '/[^\d]/', '', $bgimage );
	$bg_image_src = wp_get_attachment_image_src( $bg_image_id, 'full' );
	if ( ! empty( $bg_image_src[0] ) ) {
		$bg_image_src = $bg_image_src[0];
	}
}

$css_classes = array(
	$this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation ),
	'wpb_column',
	'vc_column_container',
	$width,
	$jclass,
	$class_preset_text,
);

if ( vc_shortcode_custom_css_has_property( $css, array(
	'border',
	'background',
) ) ) {
	$css_classes[] = 'vc_col-has-fill';
}

$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
if($bgstyle == 'attachment' && !empty($bgimage)) {
	$output .= '<div class="vc_column-inner ' . esc_attr($class_bg) . ' ' . esc_attr(trim(vc_shortcode_custom_css_class($css))) . '" style="background-image:url(' . esc_attr($bg_image_src) . ')" >';
}else{
	$output .= '<div class="vc_column-inner ' . esc_attr(trim(vc_shortcode_custom_css_class($css))) . '" >';
}
$output .= '<div class="wpb_wrapper">';

if($bgstyle == 'jarallax' && !empty($bgimage) ){
	wp_enqueue_script( 'jarallax' );
	$output .= '<div class="jarallax"';
	$arr_jarallax = array();
	if($jartype != 'Default' && $jartype != '')
		$arr_jarallax['type'] = $jartype;
	if($jarspeed != '')
		$arr_jarallax['speed'] = $jarspeed;
	if(empty($arr_jarallax))
		$arr_jarallax['speed'] = '0.2';
	$output .= ' data-jarallax=\''.json_encode($arr_jarallax).'\''; // parallax image
	$output .= ' style="background-image:url(' . esc_attr($bg_image_src) . ')"'; // parallax image
	$output .= '>
	<div class="jarallax-content">
		<div class="jarallax-content-inner">';
}

$gradient_colors = vc_param_group_parse_atts( $atts['gradient_colors'] );
if(isset($gradient_colors[0]['gradient_color']) && $gradient_colors[0]['gradient_color'] != ''){
    $pix_gradient_class = 'pix_gradient_colors_'.rand();
    $gradient_direction = $gradient_direction == '' ? 'to right' : $gradient_direction;
    $gradient_angle = $gradient_angle == '' ? '90' : $gradient_angle;
    $pix_directions_arr = array(
        'to right' => array('-webkit' => 'left', '-o-linear' => 'right', '-moz-linear' => 'right', 'linear' => 'to right',),
        'to left' => array('-webkit' => 'right', '-o-linear' => 'left', '-moz-linear' => 'left', 'linear' => 'to left',),
        'to bottom' => array('-webkit' => 'top', '-o-linear' => 'bottom', '-moz-linear' => 'bottom', 'linear' => 'to bottom',),
        'to top' => array('-webkit' => 'bottom', '-o-linear' => 'top', '-moz-linear' => 'top', 'linear' => 'to top',),
        'to bottom right' => array('-webkit' => 'left top', '-o-linear' => 'bottom right', '-moz-linear' => 'bottom right', 'linear' => 'to bottom right',),
        'to bottom left' => array('-webkit' => 'right top', '-o-linear' => 'bottom left', '-moz-linear' => 'bottom left', 'linear' => 'to bottom left',),
        'to top right' => array('-webkit' => 'left bottom', '-o-linear' => 'top right', '-moz-linear' => 'top right', 'linear' => 'to top right',),
        'to top left' => array('-webkit' => 'right bottom', '-o-linear' => 'top left', '-moz-linear' => 'top left', 'linear' => 'to top left',),
        'angle' => array('-webkit' => $gradient_angle.'deg', '-o-linear' => $gradient_angle.'deg', '-moz-linear' => $gradient_angle.'deg', 'linear' => $gradient_angle.'deg',),

    );
    $gradient_opacity = $gradient_opacity == '' ? 1 : $gradient_opacity;
    foreach($gradient_colors as $val){
        $pix_gradient .= ','.$val['gradient_color'];
    }
    $pix_gradient_style = $pix_gradient == '' && isset($pix_directions_arr[$gradient_direction]) ? '' : '
jQuery(function($){
    $("head").append("<style>.vc_row-overlay.'.$pix_gradient_class.'{background: '.esc_attr($gradient_colors[0]['gradient_color']).';background: -webkit-linear-gradient('.$pix_directions_arr[$gradient_direction]['-webkit'].esc_attr($pix_gradient).');background: -o-linear-gradient('.$pix_directions_arr[$gradient_direction]['-o-linear'].esc_attr($pix_gradient).');background: -moz-linear-gradient('.$pix_directions_arr[$gradient_direction]['-moz-linear'].esc_attr($pix_gradient).');background: linear-gradient('.$pix_directions_arr[$gradient_direction]['linear'].esc_attr($pix_gradient).');opacity:'.esc_attr($gradient_opacity).';}</style>");
});
';
}
wp_add_inline_script( 'fixar-custom', $pix_gradient_style );
$sect_color = $sect_rgba = '';
if( $pix_gradient_class != '') {
    $output .= '<span class="vc_row-overlay ' . esc_attr($pix_gradient_class) . '" ></span>';
}else{
    $decor_dg = preg_split('/\{/', $css);
    preg_match_all( '/{([^\}]+)/i', $css, $matches, PREG_OFFSET_CAPTURE );
    if(isset($matches[1][0][0])){
        foreach( explode( ';', $matches[1][0][0] ) as $val ){
            $pix_rand = isset($css_id[0]) && $css_id[0] != '' ? $css_id[0] : rand();
            $pix_color_class = 'pix-color-overlay-'.$pix_rand;
            if( substr_count($val, 'background')>0 && substr_count($val, 'rgba')>0 ){

                foreach( explode( ' ', $val ) as $val_exp ){

                    if( substr_count($val_exp, 'rgba')>0 ){
                        $sect_rgba = $val_exp;
                        $output .= '<span class="vc_row-overlay '.esc_attr($pix_color_class).'"></span>';
                        $pix_color_overlay = '
jQuery(function($){
    $("head").append("<style> .'.$pix_color_class.'.vc_row-overlay{ background-color: '.$val_exp.' !important;}</style>");
});';
                        wp_add_inline_script( 'fixar-custom', $pix_color_overlay );
                    }
                }
            }
            if( substr_count($val, 'background')>0 && substr_count($val, '#')>0 ){
                foreach( explode( ' ', $val ) as $val_exp ){
                    if( substr_count($val_exp, '#')>0 ){
                        $sect_color = $val_exp;
                        $pix_sep_element = isset($decor_dg[0]) ? '
jQuery(function($){
    $("head").append("<style> '.$decor_dg[0]. ' .section-heading.white-heading .sep-element:after{ background: '.$val_exp.';}</style>");
});' : '';
                        wp_add_inline_script( 'fixar-custom', $pix_sep_element );
                    }
                }
            }
        }
    }
}

$output .= wpb_js_remove_wpautop( $content );

if( $bgstyle == 'jarallax' ){
	$output .= '</div></div></div>';
}

$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo $output;
