<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var youtube
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Box_Title
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$fullcontent = ($content == "") ? "" : do_shortcode($content);
 
$out = $css_animation != '' && $css_animation != 'none' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '';
$out .= '
<div class="b-video">
    <div class="video-caption text-center">
      
        <a class="popup-youtube video-icon" href="https://www.youtube.com/watch?v='.esc_attr($youtube).'">
            <i class="fa fa-caret-right" aria-hidden="true"></i>
        </a>
         <h5>'.esc_html($title).'</h5>
         <h6>'.esc_html($title2).'</h6>
    </div>
</div>
 
  		';
$out .= $css_animation != '' && $css_animation != 'none' ? '</div>' : '';
echo $out;
 
?>

