<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $title_strong
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
 * @var $position
 * @var $link
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Business_Review
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$icon = isset( ${"icon_" . $type} ) ? ${"icon_" . $type} : '';
$href = vc_build_link( $link );
$href = empty($href['url']) ? '#' : $href['url'];

$out = '
		<div class="pix-info-icon-item">
			<h5 class="text-transform size15">'.wp_kses_post($title).'</h5>
			<p>'.do_shortcode($content).'</p>
			<div class="pix-media-box divider-right-bot"><i class="fa '.esc_attr($icon).'"></i></div>
		</div>
	';

echo $out;