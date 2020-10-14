<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $form_id
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Block_Cform7
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$out = '';

$out = $css_animation != '' && $css_animation != 'none' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '<div>';
$out .= do_shortcode('[contact-form-7 id="'.esc_attr($form_id).'"]');
$out .= '</div>';

echo $out;