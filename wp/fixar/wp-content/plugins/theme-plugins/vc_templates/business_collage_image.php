<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $image
 * @var $img_top_bottom
 * @var $img_vpos
 * @var $img_left_right
 * @var $img_hpos
 * @var $data_from
 * @var $data_to
 * @var $data_translatex
 * @var $data_translatey
 * @var $data_opacity
 * Shortcode class
 * @var $this WPBakeryShortCode_Business_Collage_Image
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
$data_opacity = $data_opacity == '' ? '0' : $data_opacity;

$pix_style = $img_vpos != '' ? $img_top_bottom.':'.$img_vpos.'%;' : '';
$pix_style .= $img_hpos != '' ? $img_left_right.':'.$img_hpos.'%;' : '';

$out = '
		<div class="collage-item animateme scrollme" style="'.$pix_style.'" data-when="enter" data-from="'.esc_attr($data_from).'" data-to="'.esc_attr($data_to).'" data-opacity="'.esc_attr($data_opacity).'" data-translatex="'.esc_attr($data_translatex).'" data-translatey="'.esc_attr($data_translatey).'">
            <img src="'.esc_url($img_link).'" alt="'.esc_attr($image_alt).'" />
        </div>
	';

echo $out;