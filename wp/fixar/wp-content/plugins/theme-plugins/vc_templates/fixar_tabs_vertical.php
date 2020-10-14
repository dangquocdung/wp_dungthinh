<?php
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_fixar_Tabs_Vertical
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$tabs = vc_param_group_parse_atts( $atts['tabs'] );
$tabs_nav = $tabs_content = '';
$count = 1;
foreach($tabs as $item){
	$img_out = '';
	$col_md = '7';
	$class = $count==1 ? 'active' : '';
	$icon = isset( $item['icon_'.$item['type']] ) ? $item['icon_'.$item['type']] : '';

	$tabs_nav .= '<li class="'.esc_attr($class).'"><i class="fa '.esc_attr($icon).'"></i><a href="#tab-' . esc_attr($count) . '" data-toggle="tab">' . wp_kses_post($item['title']) . '</a></li>';

	if(isset($item['image']) && $item['image'] != ''){
		$img = wp_get_attachment_image_src( $item['image'], 'medium' );
		$img_output = $img[0];
		$image_meta = fixar_wp_get_attachment($item['image']);
		$image_alt = $image_meta['alt'] == '' ? $image_meta['title'] : $image_meta['alt'];
		$img_out = '<div class="col-middle">
						<div class="col-middle-content"><img class="img-responsive v-tab-img" src="'.esc_url($img_output).'" alt="'.esc_attr($image_alt).'"></div>
					</div>';
	} else {
		$col_md = '12';
	}

	$tabs_content .= '
		<div class="tab-pane tab-pane-vertical '.esc_attr($class).'" id="tab-' . esc_attr($count) . '">
			<div class="row">
				<div class="row-same-height">
					'.wp_kses_post($img_out).'
					<div class="col-md-'.esc_attr($col_md).' col-sm-height col-middle">
						
						'.wp_kses_post($item['content']).'
					</div>
				</div>
			</div>
		</div>
	';

	$count ++;
}

$out = '
	<div class="wrap-tabs">
		<div class="row-same-height">
			<div class="col-md-3 col-sm-height col-middle">
				<ul class="nav-tabs-vertical">
					' . $tabs_nav . '
				</ul>
			</div>
			<div class="col-md-9 col-sm-height col-middle">
				<div class="tab-content">
					'. $tabs_content .'
				</div>
			</div>
		</div>
	</div>
';


echo $out;







 







