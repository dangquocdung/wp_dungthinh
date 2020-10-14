<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $css_animation
 * @var $type
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Tabs
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

 

$out = $css_animation != '' && $css_animation != 'none' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '<div>';
$out .='<div class="b-regular-tabs">';
preg_match_all( '/fixar_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();
/**
 * vc_tabs
 *
 */
if ( isset( $matches[1] ) ) {
	$tab_titles = $matches[1];
}
 
$tabs_nav = '';

?>


<!-- Regular tabs -->
    <div class="<?php echo  esc_attr($type) ?>">
  
            <div class="row">
                <div class="col-xs-12 col-sm-12 text-center">
 
                    <!-- Nav tabs -->
                    <ul class="tabs-controls list-inline" role="tablist">
                        <?php
                        $i=0;
 
                        foreach ( $tab_titles as $tab ) {
							$i++;
							$tab_atts = shortcode_parse_atts( $tab[0] );
							if ( isset( $tab_atts['title'] ) ) {
								$class = $i==1 ? 'active' : '';
								$aria = $i==1 ? 'true' : 'false';
								
								if ($type == 'b-about-tabs')
								$tabs_nav .= '
								<li role="presentation" class="'.esc_attr($class).'">
									<a href="#tab-' .   ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) )  . '" data-toggle="tab" aria-expanded="'.esc_attr($aria).'"> 
										<span class="tabs-icon">
                                            <i class="' .   $tab_atts['icon']   . '"></i>
                                        </span>
										<span class="tabs-name">
	                                        ' .   $tab_atts['title']   . '
	                                    </span>
	                                    <span class="tabs-circle">
                                            <span class="inner-circle"></span>
                                        </span>
									</a>
								</li>';
								else 
								
								$tabs_nav .= '
								<li role="presentation" class="'.esc_attr($class).'">
									<a href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '" data-toggle="tab" aria-expanded="'.esc_attr($aria).'">' . $tab_atts['title'] . '
										 
									</a>
								</li>';
							}
						}
						
						echo $tabs_nav ;
						?>
                        
                         
                    </ul>
                </div>
            </div>
     
        <!-- Tab panes -->
        <div class="tab-content">
            <?php 
            
             

				$section_cont = explode( '[/fixar_tab]', $content );
				array_pop($section_cont);
				if( is_array( $section_cont ) && !empty( $section_cont ) ){
					$i=0;
					$out_cont = '';
					foreach( $section_cont as $option ){
						$i++;
						$out_cont .= $i==1 ? str_replace('tab-pane', 'tab-pane active', do_shortcode($option.'[/fixar_tab]')) : do_shortcode($option.'[/fixar_tab]');
					}		         
				}

 
            echo $out_cont ?>
        </div>
    </div>