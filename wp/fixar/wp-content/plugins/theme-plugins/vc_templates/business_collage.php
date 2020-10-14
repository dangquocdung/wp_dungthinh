<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $image
 * @var $image_parallax
 * @var $row_overflow
 * @var $data_from
 * @var $data_to
 * @var $data_translatex
 * @var $data_translatey
 * @var $data_opacity
 * Shortcode class
 * @var $this WPBakeryShortCode_Business_Collage
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$img_id = preg_replace( '/[^\d]/', '', $image );
$img_link = wp_get_attachment_image_src( $img_id, 'large' );
$img_link = $img_link[0];
$image_meta = fixar_wp_get_attachment($img_id);
$image_alt = $image_meta['alt'] == '' ? $image_meta['title'] : $image_meta['alt'];

$data_from = $data_from == '' ? '0.95' : $data_from;
$data_to = $data_to == '' ? '0' : $data_to;
$data_translatex = $data_translatex == '' ? '100' : $data_translatex;
$data_translatey = $data_translatey == '' ? '100' : $data_translatey;
$data_opacity = $data_opacity == '' ? '0' : $data_opacity;

$out = '
		<div class="section-who-we-are">
			<div class="who-we-are-collage '.esc_attr($image_parallax).' hidden-sm hidden-xs">
				<img src="'.esc_url($img_link).'" alt="'.esc_attr($image_alt).'" class="animateme scrollme" data-rotatex="200" data-when="enter" data-from="'.esc_attr($data_from).'" data-to="'.esc_attr($data_to).'" data-opacity="'.esc_attr($data_opacity).'" data-translatey="'.esc_attr($data_translatey).'" />
				'.do_shortcode($content).'
			</div>
		</div>
	';

echo $out;