<?php
/**
 * Shortcode attributes
 * @var $atts
  @var $ids
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Departaments
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$include = explode(',',$ids);
 ?>


<div class="b-scroll-slide">
    
    <!-- Sly slider -->
    <div class="b-sly-slider">
        <div id="frame" >
            <ul class="slidee">
            
            	<?php $departaments = get_terms(array('taxonomy'=>'services_category', 'include'=>$include)); 
            	if ($departaments)
            	foreach ($departaments as $departament) {  
            	$icon =    get_option('services_category_'. $departament->term_id )?>
                <li>
                    <div class="b-features-column-mod">
                        <div class="features-column-icon">
                            <i class="<?php echo esc_attr($icon['pix_icon']) ?>"></i>
                        </div>	
                        <h6 class="features-column-title">
                            <?php echo $departament->name ?>
                        </h6>
                        <div class="features-column-text">
                            <?php echo term_description( $departament->term_id, 'services_category' ); ?>
                        </div>
                        <a href="<?php echo get_term_link($departament->term_id, 'services_category') ?>" class="btn btn-primary">
                            <?php echo esc_html__('Detail', 'fixar') ?>
                        </a>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="scrollbar">
                        <div class="handle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


