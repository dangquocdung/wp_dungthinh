<?php
/**
 * Shortcode attributes
 * @var $atts

 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_fixar_Dates
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

 
 

$section_cont = explode( '[/fixar_service]', $content );
array_pop($section_cont);
if( is_array( $section_cont ) && !empty( $section_cont ) ){
	$i=0;
	$out_cont = '';
	$services = '';
	foreach( $section_cont as $option ){
			
		$out_cont .= do_shortcode($option.'[/fixar_service]');
		
		$cont = explode( ']', $option );
		$item_cont = isset($cont[1]) ? $cont[1] : '';
		$item_atts = shortcode_parse_atts( str_replace("[fixar_service", "", $cont[0]) );
		
		 
		$service_title = esc_html($item_atts['service_title'] ) ;
		$icon = esc_attr($item_atts['icon'] ) ;
		 
		$services .= ' 
        <a data-slide-index="'.$i.'" href=""  >
            <span class="pager-icon">
                <i class="'.$icon.'"></i>
            </span>
            <span class="circle">
                <span class="inner-circle"></span>
            </span>
            <span class="pager-title">
                '.$service_title.'
            </span>
        </a>
 
        ';
        $i++;	
      
	}		         
}

  



  ?>

 <div class="b-myservices">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12">
               
                <!-- bxslider with custom pager -->
                <div class="b-pager-slideshow-holder-mod">
                    <ul class="pager-slideshow  bxslider-services">
                         <?php echo $out_cont ?>
                    </ul>
                    <div class="custom-slideshow-controls hidden-sm">
                        <span id="pager-services-prev"></span>
                        <span id="pager-services-next"></span>
                    </div>
                </div>
                <!-- custom bxslider pager -->
                <div class="bx-pager bx-pager-services custom-pager-mod">
 					<?php echo $services ?>
                </div>
                <!-- END bxslider with custom pager -->
            </div>
        </div>
    </div>
</div>
                        
                        
 