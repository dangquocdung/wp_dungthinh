<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
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
 * @var $link
 * @var $target
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Socialbut
 */
$out = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$href = vc_build_link( $link );

$icon = isset( ${"icon_" . $type} ) ? ${"icon_" . $type} : '';
$blank = !empty($target) ? 'target="_blank"' : '';

$out = '
		<a '.$blank.' href="'.esc_url($href['url']).'">
			<div class="social-purple">
				<div class="social-purple-icon">
					<i class="fa '.esc_attr($icon).'"></i>
				</div>
				<div class="social-purple-text">
					'.wp_kses_post($title).'
				</div>
			</div>
		</a>
	';

echo $out;