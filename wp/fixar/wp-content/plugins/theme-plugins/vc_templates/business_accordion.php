<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Business_Accordion
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$out = $out_cont = '';

$out = $css_animation != '' && $css_animation != 'none' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '<div>';

$section_cont = explode( '[/business_accordion_tab]', $content );
array_pop($section_cont);
if( is_array( $section_cont ) && !empty( $section_cont ) ){
	$i=0;
	foreach( $section_cont as $tab ){
		$i++;
		preg_match_all( '/business_accordion_tab([^\]]+)/i', $tab, $matches, PREG_OFFSET_CAPTURE );
		$tab_atts = shortcode_parse_atts( $matches[1][0][0] );
		$class = $i==1 ? 'active' : '';
		$type = isset($tab_atts["type"]) ? $tab_atts["type"] : 'pixsimple';
		$icon = isset( $tab_atts["icon_" . $type] ) ? $tab_atts["icon_" . $type] : '';
		$out_cont .= '<div class="panel-heading '.esc_attr($class).'" role="tab" id="heading' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '">
					<h5 class="panel-title"><a class="collapsed" data-toggle="collapse" data-parent="#accordion-one" href="#collapse' . esc_attr( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '" aria-expanded="true" aria-controls="collapse' . esc_attr( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '"><span class="accordion-icon"><span class="stacked-icon"><i class="fa '.esc_attr($icon).'"></i></span></span>'.wp_kses_post($tab_atts['title']).'</a></h5>
				</div>';
		$out_cont .= $i==1 ? str_replace('panel-collapse collapse', 'panel-collapse collapse in', do_shortcode($tab.'[/business_accordion_tab]')) : do_shortcode($tab.'[/business_accordion_tab]');
											   
	}		        
}

$out .= '
		<div id="accordion-one" role="tablist" aria-multiselectable="true">
			<div class="panel panel-default panel-alt-two">
				'.$out_cont.'
			</div>
		</div>	
	';

$out .= '</div>'; 
echo $out;