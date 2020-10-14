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
 * @var $anchor
 * Shortcode class
 * @var $this WPBakeryShortCode_fixar_Anchor
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$icon = isset( ${"icon_" . $type} ) ? ${"icon_" . $type} : '';

$out = '
        <div class="wrap-service-nav">
			<div class="list-nav">
                <div class="list-wrap">
                    <a class="scroll" href="#'.esc_attr($anchor).'">
                        <div class="nav-item">
                            <span class="'.esc_attr($icon).'"></span>
                            <div class="text">'.wp_kses_post($title).'</div>
                        </div>
                    </a>
                </div>
            </div>
		</div>
';

echo $out;