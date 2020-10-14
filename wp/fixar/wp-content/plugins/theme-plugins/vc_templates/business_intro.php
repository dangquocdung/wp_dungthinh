<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $image
 * @var $img_size
 * @var $title
 * @var $show_arrow
 * @var $footer
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Business_Intro
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$out = $temp_out = '';

$show_arrow = !empty($show_arrow) ? '<img src="'.get_template_directory_uri().'/images/arrow.png" alt="'.esc_attr($title).'">' : '';

$img_id = preg_replace( '/[^\d]/', '', $image );
$img_link = wpb_getImageBySize( array( 'attach_id' => $image, 'thumb_size' => $img_size, 'class' => 'img-responsive' ) );
$img_link = $img_link['p_img_large'][0];
$image_meta = fixar_wp_get_attachment($img_id);
$image_alt = $image_meta['alt'] == '' ? $image_meta['title'] : $image_meta['alt'];

$out = $css_animation != '' && $css_animation != 'none' ? '<div class="section-intro animated" data-animation="' . esc_attr($css_animation) . '">' : '<div class="section-intro">';
$out .= '
        <div class="col-md-3 hidden-sm hidden-xs">
            <div class="iphone scrollme animateme" data-when="enter" data-from="0.5" data-to="0" data-opacity="0" data-translatex="-200" data-rotatez="90" style="opacity: 1; transform: translate3d(0px, 0px, 0px) rotateX(0deg) rotateY(0deg) rotateZ(0deg) scale3d(1, 1, 1);">
                <img src="'.esc_url($img_link).'" alt="'.esc_attr($image_alt).'">
            </div>
        </div>
        <div class="col-md-3 scrollme animateme" data-when="enter" data-from="0.5" data-to="0" data-crop="false" data-scale="1.5" data-opacity="0" style="opacity: 1; transform: translate3d(0px, 0px, 0px) rotateX(0deg) rotateY(0deg) rotateZ(0deg) scale3d(1, 1, 1);">
            <div class="arrow hidden-sm hidden-xs">'.$show_arrow.'</div>
            <div class="intro-title">'.wp_kses_post($title).'</div>
        </div>
        <div class="col-md-5 col-sm-12">
            <div class="intro-text">
                '.do_shortcode($content).'
            </div>
            <div class="under-intro-text">
                '.wp_kses_post($footer).'
            </div>
        </div>
	
</div>
	';	
echo $out;