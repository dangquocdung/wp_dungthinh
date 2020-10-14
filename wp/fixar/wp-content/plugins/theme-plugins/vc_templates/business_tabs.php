<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Business_Tabs
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if (!isset($css_animation))
	$css_animation = '';

$out = $css_animation != '' && $css_animation != 'none' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '<div>';

preg_match_all( '/business_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();
/**
 * vc_tabs
 *
 */
if ( isset( $matches[1] ) ) {
	$tab_titles = $matches[1];
}

$tabs_nav = '';
$tabs_nav .= '<ul class="nav nav-tabs">';
$i=0;
foreach ( $tab_titles as $tab ) {
	$i++;
	$tab_atts = shortcode_parse_atts( $tab[0] );
	if ( isset( $tab_atts['title'] ) ) {
		$class = $i==1 ? 'active' : '';
		$type = isset($tab_atts["type"]) ? $tab_atts["type"] : 'pixflaticon';
		$icon = isset( $tab_atts["icon_" . $type] ) ? $tab_atts["icon_" . $type] : '';
		$tabs_nav .= '

		<li class="'.esc_attr($class).'">
			<a data-toggle="tab" aria-expanded="true" href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '">
				<span class="icons '.esc_attr($icon).'"></span>
				<span>' . $tab_atts['title'] . '</span>
			</a>
		</li>';
	}
}
$tabs_nav .= '</ul>' . "\n";

$section_cont = explode( '[/business_tab]', $content );
array_pop($section_cont);
if( is_array( $section_cont ) && !empty( $section_cont ) ){
	$i=0;
	$out_cont = '';
	foreach( $section_cont as $option ){
		$i++;		
		$out_cont .= $i==1 ? str_replace('tab-pane', 'tab-pane active', do_shortcode($option.'[/business_tab]')) : do_shortcode($option.'[/business_tab]');
	}		         
}

$css_class =  ( $style ) ? $style : '';

$out .= '
    <div class="' . esc_attr($css_class) . '">
		<div class="wrap-services-tabs">
            <div class="wrap-tabs">
                <div class="container">
                    ' . $tabs_nav . '
                </div>
            </div>
            <div class="wrap-tabs-content">

                <div class="container">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        '. $out_cont .'
                    </div>
                </div>
            </div>
        </div>
    </div>    
	';

$out .= '</div>'; 
echo $out;