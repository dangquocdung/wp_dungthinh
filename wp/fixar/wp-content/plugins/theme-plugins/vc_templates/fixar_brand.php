<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $image
 * @var $url
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Brand
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$href = vc_build_link( $url );
$url = isset($href['url']) ? $href['url'] : '';
$blank = empty($href['target']) ? '_self' : $href['target'];

$img_id = preg_replace( '/[^\d]/', '', $image );
$img_link = wp_get_attachment_image_src( $img_id, 'large' );
$img_link = $img_link[0];
$image_meta = fixar_wp_get_attachment($img_id);
$image_alt = $image_meta['alt'] == '' ? $image_meta['title'] : $image_meta['alt'];

			
$out = '
    <div class="brand-logo">
		<a class="brand-logo-wrap" target="'.esc_attr($blank).'" href="'.esc_url($url).'"><img src="'.esc_url($img_link).'" alt="'.esc_attr($image_alt).'"></a>
	</div>
	';

echo $out;