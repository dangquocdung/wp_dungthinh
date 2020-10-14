<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $images
 * @var $link
 
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Laptop
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$out = $temp_out = '';

 
$images = explode( ',', $images );
 
foreach( $images as $image ){
	if ( $image > 0 ) {
		$img_thumbnail = wpb_getImageBySize( array( 'attach_id' => $image, 'thumb_size' => 'full' ) );
	} else {
		$img_thumbnail = array();
		$img_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
		$img_thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );
	}
	
	$out .=	'
				<div class="single-gallery-item">'.$img_thumbnail['thumbnail'].'	</div>	
			';
}
 ?> 

<div class="b-last-works"  >
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <h3 class="b-upper-title text-center">
                    <?php esc_attr_e('Last Works', 'fixar') ?> 
                </h3>
            </div>
        </div>
    </div>
    <!-- Last works slider holder -->
    <div class="b-slider-holder">
        <div class="mac-wrapper hidden-xs">
            <img src="<?php echo get_template_directory_uri() ?>/images/mac-wrapper.png" alt="/">
        </div>
        <div class="b-single-gallery-carousel owl-carousel owl-theme owl-responsive-0 owl-center" data-loop="true" data-center="true" data-auto-width="true" data-dots="false" data-nav="false" data-margin="0" data-responsive-class="true" data-responsive='{"0":{"items": "1"}}' data-slider-next=".gallery-next-owl" data-slider-prev=".gallery-prev-owl">

            <?php echo $out; ?>

        </div>
    </div>
    <div class="gallery-carousel-controls text-center">
        <ul class="list-inline">
            <li>
                <a class="owl-nav-btns gallery-prev-owl">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </a>
            </li>
            <li>
                <a href="<?php echo esc_attr($link); ?>" target="_blank" class="share-button">
                    <?php esc_attr_e('More Works', 'fixar') ?> 
                </a>
            </li>
            <li>
                <a class="owl-nav-btns gallery-next-owl">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
 