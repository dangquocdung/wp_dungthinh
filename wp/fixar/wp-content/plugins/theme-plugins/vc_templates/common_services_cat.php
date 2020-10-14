<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $cats
 * @var $per_row
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Banner
 */
$btn_text = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$out = $cnt = $class = '';

if( $cats == '' ):
	$out .= '<p>'.esc_html__('No departments selected. To fix this, please login to your WP Admin area and set the departments you want to show by editing this shortcode and setting one or more departments in the multi checkbox field "Departments".', 'fixar');
else: 
$cnt = $per_row == '' ? '3' : $per_row;
$out = $css_animation != '' && $css_animation != 'none' ? '<div class="animated123" data-animation="' . esc_attr($css_animation) . '">' : '<div>';
$appearance = $appearance != 'department-1' && $appearance != '' ? $appearance : 'department-1';
$cover_class = $appearance != 'department-1' && $appearance != '' ? $appearance.'-col-'.$cnt : 'our-services department-1'.'-col-'.$cnt;
$boxed = $appearance == 'department-2' ? 'list-services-2' : 'list-services';
$limit_text = $limit_text != '' ? $limit_text : 20;

$out .= '

	<div class="'.esc_attr($cover_class).'">
       
	';		
		
	$args = array( 'taxonomy' => 'services_category', 'hide_empty' => '0', 'include' => $cats);							
	$categories = get_categories ($args);								
	if( $categories ):
		foreach($categories as $cat) :
			$t_id = $cat->term_id;
			$cat_meta = get_option("services_category_$t_id");
			$link = !isset($cat_meta['pix_serv_url']) || $cat_meta['pix_serv_url'] == '' ? get_term_link( $cat ) : $cat_meta['pix_serv_url'];
			$button = $appearance != 'department-3' && $btn_text != '' ? '<a href="' . esc_url($link) . '" class="btn btn-primary">' . wp_kses_post($btn_text) . '</a>' : '';
			$icon = isset($cat_meta['pix_icon']) && $cat_meta['pix_icon'] != '' ? $cat_meta['pix_icon'] : '';
			$image = isset($cat_meta['pix_image']) && $cat_meta['pix_image'] != '' ? $cat_meta['pix_image'] : '';
			$icon_html = $image_html = $overlay_html = '';

if( $appearance != 'department-1' ) {

	if ($icon) {
		$icon_html = '<i class="glyph-icon icon fa '.esc_attr($icon).'" ></i>';
	}
	if ($image) {
		$image_html = 'style="background-image:url('.esc_url($image).')"';
	}
	if ($appearance != 'department-3') {
		$overlay_html = '<div class="'.esc_attr($boxed).'__overlay"></div>';
	}
	$out .= '
		<div class="'.esc_attr($appearance).'-item">
			<div class="'.esc_attr($boxed).'__item" >
				<div class="'.esc_attr($boxed).'__bg" '.$image_html.'></div>
				'.$overlay_html.'
				<a class="'.esc_attr($boxed).'__link clearfix" href="'.esc_url(esc_url($link)).'">
					'.$icon_html.'
					<h4 class="'.esc_attr($boxed).'__title">'.wp_kses_post($cat->name).'</h4>
					<div class="'.esc_attr($boxed).'__description">'.fixar_limit_words($cat->description, $limit_text).'</div>
				</a>
			</div>
		</div>
		';

} else {

	if ($icon) {
		$icon_html = '<span><i class="glyph-icon ' . esc_attr($icon) . '"></i></span>';
	}
	$out .= '
		<div class="department-1-item">
	        ' . $icon_html . '
	        <h4>' . wp_kses_post($cat->name) . '</h4>
	        <p>' . fixar_limit_words($cat->description, $limit_text) . '</p>
		    '.wp_kses_post($button).'
		</div>
		';

}
		 endforeach;
	endif;
	 
$out .= '            
    	
	</div>
	';

$out .= '</div>';
endif;	
echo $out;