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

 
 

$section_cont = explode( '[/fixar_date]', $content );
array_pop($section_cont);
if( is_array( $section_cont ) && !empty( $section_cont ) ){
	$i=0;
	$out_cont = '';
	$dates = '';
	foreach( $section_cont as $option ){
			
		$out_cont .= do_shortcode($option.'[/fixar_date]');
		
		$cont = explode( ']', $option );
		$item_cont = isset($cont[1]) ? $cont[1] : '';
		$item_atts = shortcode_parse_atts( str_replace("[fixar_date", "", $cont[0]) );
		
		 
		$date = esc_html($item_atts['d'] ) ;
		 
		$dates .= ' 
        
        <a data-slide-index="'.$i.'" href="">
            <span class="pager-title">
                '.$date.'
            </span>
            <span class="circle">
                <span class="inner-circle"></span>
            </span>
        </a>
        
        ';
        $i++;	
      
	}		         
}

  



  ?>

 

<div class="b-history">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <h3 class="b-upper-title text-center">
                    <?php esc_attr_e('History','fixar') ?>
                </h3>
                <!-- bxslider with custom pager -->
                <div class="b-pager-slideshow-holder">
                    <ul class="pager-slideshow bxslider-pager">
                        <?php echo $out_cont ?>
                        
                    </ul>
                    <div class="custom-slideshow-controls hidden-xs">
                        <span id="pager-slideshow-prev">
                        	<a class="bx-prev" href=""><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                        </span>
                        <span id="pager-slideshow-next">
                        	<a class="bx-next" href=""><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </span>
                    </div>
                </div>
                <!-- custom bxslider pager -->
                <div class="bx-pager custom-pager">
                    <?php echo $dates ?>
                     
                </div>
                <!-- END bxslider with custom pager -->
            </div>
        </div>
    </div>
</div>