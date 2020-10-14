<?php
/**
 * Shortcode attributes
 * @var $atts
  * @var $name
 * @var $text
  * @var $title
 * @var $position
 * @var $image
 *   @var $signature
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_fixar_Quote
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
 
$img_id = preg_replace( '/[^\d]/', '', $image );
$img_link = wp_get_attachment_image_src( $img_id, 'large' );
$img_link = $img_link[0];
 
$signature_id = preg_replace( '/[^\d]/', '', $signature );
$signature_link = wp_get_attachment_image_src( $signature_id, 'large' );
$signature_link = $signature_link[0];
 
$out = $css_animation != '' && $css_animation != 'none' ? '<div class="b-quote-wrap animated" data-animation="' . esc_attr($css_animation) . '">' : '<div class="b-quote-wrap">';
$out .= '
  
<div class="b-quote">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6    "  >
                <blockquote class="b-quote-caption clearfix">
                    <div class="quote-icon">
                        <i class="fa fa-quote-left" aria-hidden="true"></i>
                    </div>
                    <h3 class="quote-title">
                        '.wp_kses_post($title).'
                    </h3>
                    <p class="quote-text">
                        '.wp_kses_post($text).'
                    </p>
                    <div class="quote-author">
                        <div class="quote-author-name">
                            '.wp_kses_post($name).'
                        </div>
                        <div class="quote-author-position">
                            '.wp_kses_post($position).'
                        </div>
                    </div>
                    <div class="quote-sign">
                        <img src="'.esc_url($signature_link).'" alt=" '.wp_kses_post($name).'">
                    </div>
                </blockquote>
            </div>
            <div class="col-xs-12 col-sm-6    "  >
                <div class="b-quote-photo">
                    <img src="'.esc_url($img_link).'" alt=" '.wp_kses_post($name).' class="img-responsive" >
                </div>
            </div>
        </div>
    </div>
</div>

</div> ';  

echo $out;	?>

