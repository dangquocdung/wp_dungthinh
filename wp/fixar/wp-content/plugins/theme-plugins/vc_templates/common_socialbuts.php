<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $bg_color
 * @var $divider
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Socialbuts
 */
$out = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$out = $css_animation != '' && $css_animation != 'none' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '<div>';

$out .= '
		<div class="pix-item y1">
			<div class="pix-item-wrap">
				<div class="pix-item-text '.esc_attr($divider).' '.esc_attr($divider).'-x2 bg-purple">
					<div class="socials-purple">
						'.do_shortcode($content).'
					</div>
				</div>
			</div>
		</div>
	';

$out .= '</div>'; 
echo $out;