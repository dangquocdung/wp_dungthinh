<?php
/**
 * Shortcode attributes
 * @var $atts
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
 * @var $tab_id
 * @var $title
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Business_Tab
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
			
$out = '
		<div id="tab-' . esc_attr(( empty( $tab_id ) ? sanitize_title( $title ) : $tab_id )) . '" class="tab-pane">
			'.do_shortcode($content).'
		</div>
	';

echo $out;