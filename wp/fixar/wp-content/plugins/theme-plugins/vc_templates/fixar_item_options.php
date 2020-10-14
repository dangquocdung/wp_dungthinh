<?php
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_fixar_Item_Options
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$options = vc_param_group_parse_atts( $atts['options'] );
$item_options_right = $item_options_left = array();
$count = 1;

$img = wp_get_attachment_image_src( $image, 'full' );
$img_output = $img[0];

foreach($options as $item){

	$align = $count%2 == 1 ? 'left' : 'right';

	$icon = isset( $item['icon_'.$item['type']] ) ? $item['icon_'.$item['type']] : '';

	if(isset($item['image_inner'])) {
		$img_inner = wp_get_attachment_image_src($item['image_inner'], 'large');
		$img_inner_output = $img_inner[0];
	} else {
		$img_inner_output = $img_output;
	}
	
	$out = '
	<div class="app-features '.esc_attr($align).'-features" data-src="'.esc_url($img_inner_output).'">
		<h5><span class="'.esc_attr($icon).'"></span>'.wp_kses_post($item['title']).'</h5>
		<p>'.do_shortcode($item['content']).'</p>
		
	</div>
	';

	if($align == "right"){
		$item_options_right[] = $out;
	}else{
		$item_options_left[] = $out;
	}

	$count ++;
}

$out = '
			<div class="application service-application">
				<div class="col-md-4 col-sm-6 service-application-col01">
					'.implode( "\n", $item_options_left ).'
				</div>
				<div class="col-md-4 hidden-sm hidden-xs service-application-col02">
					<div class="service-application-wrap">
						
						<div class="service-application-img">
					   		<img class="app-demo" src="'.esc_url($img_output).'" alt="'.esc_attr__('Item Options', 'fixar').'">
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 service-application-col03">
					'.implode( "\n", $item_options_right ).'
				</div>
			</div>
				';


echo $out;





 







