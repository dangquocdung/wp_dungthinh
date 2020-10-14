<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$icon = isset( ${"icon_" . $type} ) ? ${"icon_" . $type} : '';
	
$href = vc_build_link( $link );
$a_target = isset( $href['target'] ) ? $href['target'] : '_self';
$btn = $btn_text != '' ? '<a href="'.esc_url($href['url']).'" target="'.esc_attr($a_target).'" class="btn btn-primary btn-sm pull-left">'.wp_kses_post($btn_text).'</a>' : '';
$subtitle_html = $subtitle == '' ? '' : '<h5>'.wp_kses_post($subtitle).'</h5>';
$icon_html = $icon == '' ? '' : '<div class="striped-icon-box"><div class="striped-icon-large"><span aria-hidden="true" class="'.esc_attr($icon).'"></span></div><div class="striped-icon-large-bg"></div></div>';

$out = '
	<div class="wrap-cards">

			<div class="box-heading">
				<h4>'.wp_kses_post($title).'</h4>
				'.wp_kses_post($subtitle_html).'
				'.wp_kses_post($icon_html).'
			</div>
			<div class="cards-text">
				'.do_shortcode($content).'
			</div>
			'.wp_kses_post($btn).'

	</div>
'; 

echo $out;