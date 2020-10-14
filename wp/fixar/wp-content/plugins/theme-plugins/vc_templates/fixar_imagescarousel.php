<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $images
 * @var $img_size
 * @var $autoplay
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Imagescarousel
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$out = $temp_out = '';

wp_enqueue_script( 'fixar_pix_carousel_js' );
wp_enqueue_style( 'fixar_pix_carousel_css' );

$images = explode( ',', $images );
$autoplay = is_numeric($autoplay) && $autoplay > 0 ? $autoplay : false;
$navtext = array('<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>');

foreach( $images as $image ){
	if ( $image > 0 ) {
		$img_thumbnail = wpb_getImageBySize( array( 'attach_id' => $image, 'thumb_size' => $img_size ) );
	} else {
		$img_thumbnail = array();
		$img_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
		$img_thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );
	}
	
	$temp_out .=	'
				<div class="img-fleet">
                <div class="tmpl-fleet-overlay">
									
                                    
                                    <div class="fleet-info">
                                     
										<a href="'.wp_get_attachment_url($image).'"  class="fancybox">
											<span class="item-hover-icon"><i class="fa fa-search"></i></span>
										</a>
                                        
                                        <h4>'.get_the_title($image).'</h4>
									 </div>
                                     
                                     
									
                                </div>
                '.$img_thumbnail['thumbnail'].'	
                </div>	
			';
}
$out = $css_animation != '' && $css_animation != 'none' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '<div>';
$out .= '

	<div class="fleet-gallery owl-carousel enable-owl-carousel owl-theme" data-items="'.esc_attr($itemscount).'" data-responsive-items="'.esc_attr($ritemcount).'" data-pagination="'.esc_attr($pagination).'" data-navigation="'.esc_attr($navigation).'" data-auto-play="'.esc_attr($autoplay).'" data-nav-text=\''.json_encode($navtext).'\'>
        '.$temp_out.'
        	   
	</div>
	
</div>
	';	
echo $out;