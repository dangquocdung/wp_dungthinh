<?php
/**
 * Shortcode attributes
 * @var $atts
 
 * @var $text
 
 * @var $title
 * @var $amount
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Box_Amount
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

 

$out = $css_animation != '' && $css_animation != 'none' ? '<div class="tmpl-stats" data-animation="' . esc_attr($css_animation) . '">' : '<div class="tmpl-stats">';
$out .= '
 	 <div class="tmpl-stats-type tmpl-stats-type-01">
	    
        <div class="tmpl-stats-icon"><i class="'.esc_attr($icon).'"></i></div>
        <div class="tmpl-stats-box">
	    <span data-percent="'.esc_attr($amount).'" class="js-chart">
	        <span class="js-percent">'.esc_attr($amount).'</span>
	    </span>
	 
	    <h6 class="tmpl-stat-title">
	        '.wp_kses_post($title).'
	    </h6>
	    <div class="tmpl-stat-item-text">
	            '.wp_kses_post($text).'
	    </div>
	</div>
  </div>			
</div>			

	';  

echo $out;