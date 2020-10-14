<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $btn
 * @var $link
 * @var $service_title
 * @var $icon
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_fixar_Date
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

  
$out = '
 
	<li aria-hidden="false">
        <div class="pager-item">
            <div class="pager-item-title">
                '.wp_kses_post($title).'
            </div>
            <div class="pager-item-description">
                '.do_shortcode($content).'
            </div>
            <a href="'.esc_attr($link).'" class="btn btn-primary">'.wp_kses_post($btn).'</a>
        </div>
    </li>
    
 
	';

echo $out;