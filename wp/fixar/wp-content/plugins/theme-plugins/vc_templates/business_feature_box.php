<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $border_color
 * @var $link
 * @var $btn_text
 * @var $target
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Business_Feature_Box
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$href = vc_build_link( $link );

$pix_title_class = 'pix'.rand();
$color = $border_color == '' ? '' : '
<script>
jQuery(function($){
    $("head").append("<style> .pix-title-center .pix-title.'.$pix_title_class.' h3:after {border-color: '.esc_attr($border_color).'}</style>");
});
 </script>';
$blank = !empty($target) ? 'target="_blank"' : '';
$finalbutton = ($btn_text == '') ? '': '<a '.$blank.' href="'.esc_url($link).'" class="btn-learn-more">'.esc_attr($btn_text).'</a>';

$out = $css_animation != '' && $css_animation != 'none' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '<div>';
$out .= '
	<div class="pix-item">
		'.$color.'
		<div class=" pix-title-center pix-title-small-box">
			<div class="pix-title '.esc_attr($pix_title_class).'">
				<h3 class="h3">'.wp_kses_post($title).'</h3>
			</div>
			<div class="after-title-info">
				<p>'.do_shortcode($content).'</p>
				'.$finalbutton.'
			</div>
		</div>
	</div>
'; 

$out .= '</div>';

echo $out;