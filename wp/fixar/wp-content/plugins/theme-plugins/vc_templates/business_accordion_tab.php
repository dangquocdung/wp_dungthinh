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
 * @var $title
 * @var $tab_id
 * Shortcode class
 * @var $this WPBakeryShortCode_Business_Accordion_Tab
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$icon = isset( ${"icon_" . $type} ) ? ${"icon_" . $type} : '';
$out = '';

$out = '
		<div id="collapse' . esc_attr(( empty( $tab_id ) ? sanitize_title( $title ) : $tab_id )) . '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading' . esc_attr(( empty( $tab_id ) ? sanitize_title( $title ) : $tab_id )) . '">
			<div class="panel-body">'.do_shortcode($content).'</div>
		</div>
	';

echo $out;