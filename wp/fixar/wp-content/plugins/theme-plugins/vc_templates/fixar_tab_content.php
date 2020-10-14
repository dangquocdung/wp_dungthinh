<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $css_animation
 * @var $type
 * Shortcode class
 * @var $this WPBakeryShortCode_fixar_Tab_Content
 */

$out = $out_cont = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

preg_match_all( '/fixar_tab_links([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_links = array();
if ( isset( $matches[1] ) ) {
	$tab_links = $matches[1];
}
$tab_active_id = '';
foreach ( $tab_links as $tab ) {
	$tab_atts = shortcode_parse_atts( $tab[0] );
	if ( isset( $tab_atts['active_content'] ) && $tab_atts['active_content'] == 'active' ) {
		$tab_active_id = $tab_atts['tab_id'];
		break;
	}
}

$out .='<div class="smart-tabs">';
if( isset($content_title) && !empty($content_title) ){
	$out .= '<h3 class="smart-tabs-title">'.wp_kses_post($content_title).'</h3>';
}

$out .=' <div class="tab-content">';

$section_cont = explode( '[/fixar_tab_links]', $content );
array_pop($section_cont);
if( is_array( $section_cont ) && !empty( $section_cont ) ){
    $i=0;
    foreach( $section_cont as $option ){
        $i++;
        if($tab_active_id){
            $out_cont .= str_replace( 'class="tab-pane" id="'.esc_attr($tab_active_id).'"', 'class="tab-pane active" id="'.esc_attr($tab_active_id).'"', do_shortcode( $option . '[/fixar_tab_links]' ) );
        } else {
	        $out_cont .= $i == 1 ? str_replace( 'tab-pane', 'tab-pane active', do_shortcode( $option . '[/fixar_tab_links]' ) ) : do_shortcode( $option . '[/fixar_tab_links]' );
        }
    }
}

$out .=  $out_cont.'
        </div>
    </div>';

echo $out;