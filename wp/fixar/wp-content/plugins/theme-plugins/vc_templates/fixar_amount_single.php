<?php
/**
 * Shortcode attributes
 * @var $atts
 
 * @var $text
 
 * @var $title
 * @var $amount
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Amount_Single
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$out = '
<div class="stats row-counters pix-easy-chart"> 
	
	<div class="b-big-progress">
        <div class="big-progress-title">
            '.wp_kses_post($title).'
        </div>
        <div class="b-progress-list__item">
        <span data-percent="'.esc_attr($amount).'" class="b-progress-list__percent js-chart">
            <span class="js-percent">'.esc_html($amount).'</span>
        <canvas height="0" width="0"></canvas></span>
        </div>
        <div class="big-progress-description rtd">
            '.wp_kses_post($text).'
        </div>
    </div>
        
				
</div>
			

	';  

echo $out;