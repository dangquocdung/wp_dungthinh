<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $icon
 * @var $tab_id
 * @var $title
 
 * @var $link
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_fixar_Tab_Links
 */
$type = 'link';
$out = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if( empty($tab_id) ){
	$out .= '<div class="smart-tabs">';
} else {
	$out .= '<div class="tab-pane" id="'.esc_attr($tab_id).'">';
}
if( isset($title) && !empty($title) ){
	$out .= '<h3 class="smart-tabs-title">'.wp_kses_post($title).'</h3>';
}


if( $type == 'contents' ){
	$out .= do_shortcode($content);
} else {

	$tabs = vc_param_group_parse_atts( $atts['tab_links'] );
	if( isset($tabs[0]['tab_title']) && isset($tabs[0]['content_id']) ) {
		$out .= isset($tab_id) && !empty($tab_id) ? '<ul class="smart-inner-tabs">' : '<ul>';
		foreach($tabs as $val){
			$active = isset($val['active']) && $val['active'] == 'active' ? 'class="active"' : '';
			$out .= '<li '.wp_kses_post($active).'><a href="#'.esc_attr($val['content_id']).'" data-toggle="tab">'.wp_kses_post($val['tab_title']).'</a></li>';
		}
		$out .= '</ul>';
	}
}

$out .= '</div>';

echo $out;