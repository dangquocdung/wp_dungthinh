<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $icon
 * @var $text
 * @var $rb
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Info
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$fullcontent = ($content == "") ? "" : do_shortcode($content);
 
$out = $css_animation != '' && $css_animation != 'none' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '';
$out .= '
<div class="b-info-column '.esc_attr($rb).'">
    <div class="info-column-icon">
        <i class="'.esc_attr($icon).'"></i>
    </div>
    <h6 class="info-column-title">
        '.esc_html($title).'
    </h6>
    <div class="info-column-text">
        <p>
            '. ($text).'
        </p>
    </div>
</div>
 
  		';
$out .= $css_animation != '' && $css_animation != 'none' ? '</div>' : '';
echo $out;
 
?>

