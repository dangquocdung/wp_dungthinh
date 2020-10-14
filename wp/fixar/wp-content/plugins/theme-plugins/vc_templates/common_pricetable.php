<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $typetable
 * @var $monthtext
 * @var $yeartext
 * @var $monthshort
 * @var $yearshort
 * @var $currency
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Pricetable
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$out_cont = '';

$section_cont = explode( '[/common_pricecol]', $content );
array_pop($section_cont);
if( is_array( $section_cont ) && !empty( $section_cont ) ){
	$i=0;
	foreach( $section_cont as $tab ){
		$i++;
		preg_match_all( '/common_pricecol([^\]]+)/i', $tab, $matches, PREG_OFFSET_CAPTURE );
		$tab_atts = shortcode_parse_atts( $matches[1][0][0] );
		if ( isset( $tab_atts['title'] ) ) {
			$class = isset($tab_atts['ispopular']) && $tab_atts['ispopular'] == true ? 'orange-heading' : 'blue-heading';
			$href = isset($tab_atts['link']) ? vc_build_link( $tab_atts['link'] ) : array('url'=>'');
			$class_year = $typetable == 'yearly' ? 'is-visible' : 'is-hidden';
			$class_month = in_array($typetable, array('', 'monthly')) ? 'is-visible' : 'is-hidden';
			$monthprice = isset($tab_atts['monthprice']) ? $tab_atts['monthprice'] : '';
			$yearprice = isset($tab_atts['yearprice']) ? $tab_atts['yearprice'] : '';
			$subtitle = isset($tab_atts['subtitle']) ? $tab_atts['yearprice'] : '';
		
			$out_cont .= '
				<div  class="col-md-4">
					<ul class="cd-pricing-wrapper reverse-animation  '.esc_attr($class).'">';
			if(in_array($typetable, array('', 'monthly'))){			
				$out_cont .= '
						<li data-type="monthly" class="is-ended '.esc_attr($class_month).' panel panel-default panel-price text-center">
							<div class="plan-item">
	                            <div class="item-heading '.esc_attr($class).' price-1">
	                                <h4>'.wp_kses_post($tab_atts['title']).'</h4>
	                                
	                            </div>
	                            <div class="item-body">
	                                <div class="price-count">
	                                    <span><i>'.wp_kses_post($currency).'</i>'.wp_kses_post($monthprice).'</span>
	                                </div>
	                               
	                               
	                                '.do_shortcode($tab."[/common_pricecol]").'
                                    
                                    <div class="price-btn-footer">
                                    
	                                <a href="'.esc_url($href['url']).'" class="btn btn-default">'.wp_kses_post($tab_atts['btntext']).'</a>
                                    
                                    </div>
                                    
	                            </div>
	                        </div>
						</li>';
			}
			if(in_array($typetable, array('', 'yearly'))){	
				$out_cont .= '
						<li data-type="yearly" class="is-ended li-last '.esc_attr($class_year).' panel panel-price">
							<div class="plan-item">
	                            <div class="item-heading '.esc_attr($class).' price-1">
	                                <h4>'.wp_kses_post($tab_atts['title']).'</h4>
	                                
	                            </div>
	                            <div class="item-body">
	                                <div class="price-count">
	                                    <span><i>'.wp_kses_post($currency).'</i>'.wp_kses_post($yearprice).'</span>
	                                </div>
	                               
	                                '.do_shortcode($tab."[/common_pricecol]").'
                                    
                                      <div class="price-btn-footer">
                                      
	                                <a href="'.esc_url($href['url']).'" class="btn btn-default">'.wp_kses_post($tab_atts['btntext']).'</a>
                                    
                                      </div>
                                      
                                      
	                            </div>
	                        </div>
						</li>';
			}
				$out_cont .= '		  
						</ul>
					
					</div>
				';			
		}	
											   
	}		        
}

$out = '
       <div class="cd-pricing-container cd-full-width cd-secondary-theme list-prices">
		
';
if($typetable == ''){
	$out .= '
				<div class="cd-pricing-switcher pricing-switcher">			
					<div data-toggle="buttons" class="btn-group">
						<label class="btn tmp-btn-price active"><input type="radio" checked="" id="monthly-1" value="monthly" name="duration-1"> '.wp_kses_post($monthtext).'</label>
						<label class="btn tmp-btn-price"><input type="radio" id="yearly-1" value="yearly" name="duration-1"> '.wp_kses_post($yeartext).'</label>
					</div>			  
				</div>
						
	';
}
$out .= '
				<div class="row no-gutter">
					'. $out_cont .'
				</div>
		
		</div>
';
 
echo $out;