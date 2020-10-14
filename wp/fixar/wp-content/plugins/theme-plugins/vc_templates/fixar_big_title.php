<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $shuffle
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_fixar_Big_Title
 */
$color = $gradient = $style = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$pix_title_class = 'pix'.rand();
if( $color == '' && ( ( get_post_meta(get_the_ID(), 'page_main_color', 1) != '' && get_post_meta(get_the_ID(), 'page_gradient_color', 1) != '')
    	            || ( get_post_meta(get_the_ID(), 'page_main_color', 1) == '' && fixar_get_option('style_settings_gradient_color', get_option('fixar_default_gradient_color')) != '' ) ) ){
    $color = get_post_meta(get_the_ID(), 'page_main_color', 1) != '' ? get_post_meta(get_the_ID(), 'page_main_color', 1) : fixar_get_option('style_settings_main_color', get_option('fixar_default_main_color'));
    $gradient = get_post_meta(get_the_ID(), 'page_gradient_color', 1) != '' ? get_post_meta(get_the_ID(), 'page_gradient_color', 1) : fixar_get_option('style_settings_gradient_color', get_option('fixar_default_gradient_color'));
    $style = '<style scoped> h3.b-upper-title.'.$pix_title_class.'{background: '.esc_attr($color).' !important;background: -webkit-linear-gradient(top, '.esc_attr($color).', '.esc_attr($gradient).') !important;background: -o-linear-gradient(bottom, '.esc_attr($color).', '.esc_attr($gradient).') !important;background: -moz-linear-gradient(bottom, '.esc_attr($color).', '.esc_attr($gradient).') !important;background: linear-gradient(to bottom, '.esc_attr($color).', '.esc_attr($gradient).') !important;-webkit-background-clip: text !important;-webkit-text-fill-color: transparent;}}</style>';
} elseif ( $color == '' ) {
    $color = '#cccccc';
    $style = ' <style scoped> h3.b-upper-title.'.$pix_title_class.'{background: '.esc_attr($color).';-webkit-background-clip: text !important;-webkit-text-fill-color: transparent;}</style>';
} else {
    $style = ' <style scoped> h3.b-upper-title.'.$pix_title_class.'{background: '.esc_attr($color).';-webkit-background-clip: text !important;-webkit-text-fill-color: transparent;}</style>';
}
 
$out = $css_animation != '' && $css_animation != 'none' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '';
if ($shuffle) $shuffle = 'shuffle';
$out .= '
	<h3 class="b-upper-title text-center slabtextdone '. esc_attr($pix_title_class) . ' '.esc_attr($shuffle).'" data-when="enter" data-from="1.0" data-to="0.0" data-easing="linear" data-crop="true" data-opacity="1.0" data-scalex="1.0" data-scaley="1.0" data-scalez="1.0" data-rotatex="0" data-rotatey="0" data-rotatez="0" data-translatex="0" data-translatey="300"  >
	    ' . $style . '
		<span class="slabtext slabtext-linesize-1 slabtext-linelength-11" >
		'.esc_html($title).'
		</span>
	</h3>

  		';
$out .= $css_animation != '' && $css_animation != 'none' ? '</div>' : '';
echo $out;
 