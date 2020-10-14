<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 
 * @var $d
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_fixar_Date
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

  
$out = '
 
	
	<li>
	    <div class="pager-item">
	        <div class="pager-item-title">
	            '.wp_kses_post($title).'
	        </div>
	        <div class="pager-item-description">
	             '.do_shortcode($content).'
	        </div>
	    </div>
	</li>

	';

echo $out;