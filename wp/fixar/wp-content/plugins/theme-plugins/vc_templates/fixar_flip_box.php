<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $icon
 * @var $type
 * @var $icon_pixelegant
 * @var $icon_pixflaticon
 * @var $icon_pixicomoon
 * @var $icon_pixfontawesome
 * @var $icon_pixsimple
 * @var $icon_fontawesome
 * @var $icon_openiconic
 * @var $icon_typicons
 * @var $icon_entypo
 * @var $icon_linecons
 * @var $title
 * @var $position
 * Shortcode class
 * @var $this WPBakeryShortCode_Box_Icon
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$out = $decor = '';

$icon = isset( ${"icon_" . $type} ) ? ${"icon_" . $type} : '';

$decor = $subtitle ? '<div class="number">'.wp_kses_post($subtitle).'</div>' : '';
$out = '<div class="wrap-features">';
$out .= '

		<div class="wrap-feature-item">
			<div class="feature-item">
				<div class="front face">
					<div class="ico "><i class="'.esc_attr($icon).'"></i></div>
					<div class="title">'.wp_kses_post($title).'</div>
					<div class="number">'.wp_kses_post($subtitle).'</div>
				</div>
				<div class="back face center">
					<div class="ico "><i class="'.esc_attr($icon).'"></i></div>
					<div class="title">'.wp_kses_post($title).'</div>
					<div class="text">'.do_shortcode($content).'</div>
				</div>
			</div>
		</div>
		
	';
$out .= '</div>'; 

echo $out;