<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $disable_carousel
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Business_Services
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$disable_carousel = $disable_carousel == 1 ? 'owl-carousel enable-owl-carousel' : '';

$section_cont = explode( '[/section_service]', $content );
$out_cont = '';
array_pop($section_cont);
if( is_array( $section_cont ) && !empty( $section_cont ) ){
	$i=0;
	$out_cont = '';
	foreach( $section_cont as $option ){
		$i++;
		$out_cont .= ($i % 2) == 1 ? '<div class="pix-carousel">' : '';
		$out_cont .= do_shortcode($option.'[/section_service]');
		$out_cont .= ( (($i % 2) == 0 && $i <= count($section_cont)) || $i == count($section_cont) ) ? '</div>' : '';
	}		         
}

$out = '
		<div class="'.esc_attr($disable_carousel).' horizontal-owl-controls owl-theme" data-navigation="false" data-pagination="true" data-single-item="false" data-auto-play="false" data-transition-style="false" data-main-text-animation="false" data-min600="1" data-min800="1" data-min1200="1">
			'.$out_cont.'
		</div>
	';

echo $out;