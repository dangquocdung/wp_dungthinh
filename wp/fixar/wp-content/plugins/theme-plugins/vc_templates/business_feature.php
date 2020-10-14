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
 * Shortcode class
 * @var $this WPBakeryShortCode_Business_Feature
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$icon = isset( ${"icon_" . $type} ) ? ${"icon_" . $type} : '';
			
$out = '

        <div class="item-body">
            '.do_shortcode($content).'
        </div>
	';

echo $out;