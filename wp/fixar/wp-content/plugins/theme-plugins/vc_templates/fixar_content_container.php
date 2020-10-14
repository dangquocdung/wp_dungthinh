<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $style
 * Shortcode class
 * @var $this WPBakeryShortCode_fixar_Content_Container
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$styleClass = ( $style ) ? 'tmpl-content-style-' . $style : '';

$class_to_filter = vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $styleClass );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );


$style_attr = array();
$style_attr[] = ( $width ) ? 'width:'.esc_attr($width).' ' : '';
$style_attr[] = ( $height ) ? 'height:'.esc_attr($height).' ' : '';
if ($width || $height)
	$style_box_attr = 'style="' . implode(';', $style_attr) . '"';

$style_container_attr = ( $cwidth ) ? 'style="width:'.esc_attr($cwidth).'" ' : '';

$out = '
  <div class="tmpl-cc-container tmpl-content-container-' . esc_attr($position) . '" ' . $style_container_attr .'>
	<div class="tmpl-cc-box tmpl-content-container ' . esc_attr($css_class) . '" ' . $style_box_attr .'>'.do_shortcode($content).'</div>
  </div>';
echo $out;