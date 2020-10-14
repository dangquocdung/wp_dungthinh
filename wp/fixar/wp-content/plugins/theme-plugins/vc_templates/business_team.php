<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $min_slides
 * @var $carousel
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Business_Team
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$out_mem = '';
$carousel = $carousel == '' ? 'owl-carousel enable-owl-carousel' : $carousel;

$out = $css_animation != '' && $css_animation != 'none' ? '<div class="wrap-team-slider animated" data-animation="' . esc_attr($css_animation) . '">' : '<div class="wrap-team-slider">';

preg_match_all( '/\[business_team_member([^\]]+)\]/i', $content, $matches, PREG_OFFSET_CAPTURE );
if( isset( $matches[0] ) && !empty( $matches[0] ) ){
	$i=0;
	foreach( $matches[0] as $option ){
		$i++;
		$out_mem .= do_shortcode($option[0]);
	}
}

$out .= '
		<div class="team-carousel '.esc_attr($carousel).' owl-theme" data-items="4" data-responsive-items="1" data-pagination="true">
            '.$out_mem.'
        </div>
	';

$out .= '</div>'; 
echo $out;