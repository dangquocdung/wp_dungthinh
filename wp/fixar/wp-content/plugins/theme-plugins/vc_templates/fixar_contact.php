<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $cf
 * @var $lat
 * @var lng
 
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Contact
 */
 
 
 wp_enqueue_script('fixar-google-maps', get_template_directory_uri() . '/js/google-maps.js', array() , '1.1', true);
	
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if($image) {
    $img_id = preg_replace('/[^\d]/', '', $image);
    $img_link = wp_get_attachment_image_src($img_id, 'thumbnail');
    $img_link = $img_link[0];
} else {
    $img_link = get_template_directory_uri() . '/images/map-marker.png';
}
$width = $width == '' ? '100%' : $width;
$height = $height == '' ? '100%' : $height;
$zoom = $zoom == '' ? 8 : $zoom;
$scrollwheel = $scrollwheel == '' ? 'false' : $scrollwheel;

if(shortcode_exists('kswr_cf7')){
    $styleName ='default'; $styleType ='qaswara'; $styleButton ='qaswara';
 	$style = $outPut ='';
 	$classRandom = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'),0,8);
 	$customClass = 'kameleon-cf7-container'.$classRandom;

 	$kmcf7_styles = kaswara_get_single_option('kmcf7_styles');
 	if(is_array($kmcf7_styles)){
 		if(array_key_exists($cf7_style,$kmcf7_styles)){
 			$styleName = $kmcf7_styles[$cf7_style]['styleName'];
 			$styleType = $kmcf7_styles[$cf7_style]['styleType'];
 			$styleButton =$kmcf7_styles[$cf7_style]['styleButton'];
 			$style = $kmcf7_styles[$cf7_style]['theStyle'];
 		}
 	}

 	if($styleName == "default"){
 		$style = '--kmcf7-btn-fontsize: 16px;--kmcf7-btn-align: center;--kmcf7-btn-width: 50%;--kmcf7-btn-letterspacing: 1px;--kmcf7-btn-height: 45px;--kmcf7-btn-mgtop: 15px;--kmcf7-btn-mgbottom: 15px;--kmcf7-btn-border-radius: 0;--kmcf7-btn-color: #ccc;--kmcf7-btn-border-width: 0;--kmcf7-btn-bg-color: #111;--kmcf7-btn-border-color: #1a1a1a;--kmcf7-btn-color-hover: #fff;--kmcf7-btn-bg-color-hover: #269AD6;--kmcf7-btn-border-color-hover: #2492CA;--qaswara-input-height:50px;--qaswara-input-margin-top:15px;--qaswara-input-margin-bottom:15px;--qaswara-input-font-size:15px;  --qaswara-input-color: #888;    --qaswara-color: #bbb;     --qaswara-font-size:15px;--qaswara-border-width: 1px;  --qaswara-border-color:#eee;--qaswara-border-active-color:#269AD6;--qaswara-textarea-height:250px;;';
 	}

 	$outPut .= '<div class="kameleon-cf7-container '.$customClass.'" data-classname=".'.$customClass.'" data-style-name="'.esc_attr($styleName).'"  data-style="'.$styleType.'" data-button-style="'.$styleButton.'" data-style-css="'.$style.'" style="'.$style.'">'.do_shortcode( '[contact-form-7 id="'.esc_attr($cf).'"]' ).'</div>';
} else {
    $outPut .= '<div class="col-sm-6 col-sm-offset-3">
                    '.do_shortcode('[contact-form-7 id="'.esc_attr($cf).'"]').'
                </div>';
}
?>


<div class="b-map-form-holder">
    <div class="map-form-switcher">
        <div class="switcher-bg">
        <?php if($cf != '') : ?>
            <span class="switcher-text text-uppercase"><?php esc_attr_e('Form', 'fixar') ?></span>
            <span class="switcher-toggle">
                <span class="icon"></span>
        	</span>
        <?php endif; ?>
            <span class="switcher-text text-uppercase"><?php esc_attr_e('Map', 'fixar') ?></span>
        </div>
    </div>
    <div class="b-map"
    	data-zoom="<?php echo esc_attr($zoom) ?>"
    	data-lat="<?php echo esc_attr($lat) ?>"
    	data-lng="<?php echo esc_attr($lng) ?>"
    	data-scrollwheel="<?php echo esc_attr($scrollwheel) ?>"
    	data-image="<?php echo esc_attr($img_link) ?>"
    	 
    
    >
        <div id="map" class="ui-map"></div>
    </div>
    <?php if($cf != '') : ?>
    <div class="b-contact-form">
        <div class="container">
            <div class="row">
                <?php echo $outPut; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>


 