<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Box_Title
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$fullcontent = ($content == "") ? "" : do_shortcode($content);
 
$out = $css_animation != '' && $css_animation != 'none' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '';
$out .= '
		<div class="tmpl-info-box">
    		 
    		'.$fullcontent.'
        </div>
  		';
$out .= $css_animation != '' && $css_animation != 'none' ? '</div>' : '';
echo $out;
 