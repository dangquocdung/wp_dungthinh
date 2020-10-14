<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $title_before
 * @var $show_decor
 * @var $color
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Block_Title
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


$title_before = ($title_before == '') ? '' : '<div class="section-subtitle">'.wp_kses_post($title_before).'</div>';
$show_decor = (empty($show_decor)) ? '' : '<div class="sep-element"></div>';

$out = $css_animation != '' && $css_animation != 'none' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '';
$out .= '
	<div class="section-heading ' . esc_attr($color) . '">
        '.$title_before.'
		<div class="section-title">'.wp_kses_post($title).'</div>
		'.$show_decor.'
	</div>
';
$out .= $css_animation != '' && $css_animation != 'none' ? '</div>' : '';
echo $out;