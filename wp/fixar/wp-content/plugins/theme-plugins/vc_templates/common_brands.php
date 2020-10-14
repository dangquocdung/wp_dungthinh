<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $brands_per_page
 * @var $disable_carousel
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Brands
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$carousel = $carousel == '' ? 'owl-carousel enable-owl-carousel' : $carousel;
$class = $carousel == 'disable-owl-carousel' ? 'brand-wrap-vertical' : '';
$brands_per_page = is_numeric($brands_per_page) ? $brands_per_page : 5;

$out = '
		<div class="section-brands '.esc_attr($class).' '.esc_attr($carousel).' owl-theme" data-pagination="false" data-navigation="true" data-min-slides="'.esc_attr($brands_per_page).'">
			'.do_shortcode($content).'
		</div>
	';

echo $out;