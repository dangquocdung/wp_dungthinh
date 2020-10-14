<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $type
 * @var $carousel
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Team
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$out = $css_animation != '' && $css_animation != 'none' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '<div>';

$item_titles = $members = $cont = $item_cont = '';
$item_titles = explode( '[fixar_team_member', $content );


$i=0;

$out .= '

<div class="b-team-holder'.$type.'">



						

';

foreach ( $item_titles as $item ) { 
	$cont = explode( ']', $item );
	$item_cont = isset($cont[1]) ? $cont[1] : '';
	$item_atts = shortcode_parse_atts( str_replace("[fixar_team_member", "", $cont[0]) );
	if ( isset( $item_atts['name'] ) ) {
		$img_id = preg_replace( '/[^\d]/', '', $item_atts['image'] );
		$img_link = wp_get_attachment_image_src( $img_id, 'large' );
		$img_link = $img_link[0];
		$image_meta = fixar_wp_get_attachment($img_id);
		$image_alt = $image_meta['alt'] == '' ? $image_meta['title'] : $image_meta['alt'];
		
	 
		$final_scn1 = (!isset($item_atts['scn1']) || $item_atts['scn1'] == '') ? '': '<li><a style="color:#005394;" href="'.esc_url($item_atts['scn1']).'"><i class="'.esc_attr($item_atts['scn_icon1']).' "></i></a></li>';
		$final_scn2 = (!isset($item_atts['scn2']) || $item_atts['scn2'] == '') ? '': '<li><a style="color:#ff054f;" href="'.esc_url($item_atts['scn2']).'"><i class="'.esc_attr($item_atts['scn_icon2']).' "></i></a></li>';
		$final_scn3 = (!isset($item_atts['scn3']) || $item_atts['scn3'] == '') ? '': '<li><a style="color:#47aeff;" href="'.esc_url($item_atts['scn3']).'"><i class="'.esc_attr($item_atts['scn_icon3']).' "></i></a></li>';
		$final_scn4 = (!isset($item_atts['scn4']) || $item_atts['scn4'] == '') ? '': '<li><a style="color:#b50000;" href="'.esc_url($item_atts['scn4']).'"><i class="'.esc_attr($item_atts['scn_icon4']).' "></i></a></li>';
			
		$social = '';
 		if($final_scn1 || $final_scn2 || $final_scn3 || $final_scn4 ){
			$social = '
			<div class="b-socials">
                <ul class="list-inline">
				'.$final_scn1.$final_scn2.$final_scn3.$final_scn4.'
				</ul>
			</div>';
		}
		
		
		if ($type!='-mod')  
		$members .= '
		<div class="team-carousel-item">
            <div class="team-member">
            
            
            
                        
                <img src="'.esc_url($img_link).'" class="img-responsive" >
                <div class="member-caption">
                    <div class="member-name">
                        '.wp_kses_post($item_atts['name']).'
                    </div>
                    <div class="member-position">
                        '.wp_kses_post($item_atts['position']).'
                    </div>
                    '.$social.'
                </div>
            </div>
        </div> ';
		else
		$members .= 
		'<li class="team-list-item">
            <img src="'.esc_url($img_link).'" alt="/">
            <div class="member-list-caption">
                <div class="member-name">
                    '.wp_kses_post($item_atts['name']).'
                </div>
                <div class="member-position">
                    '.wp_kses_post($item_atts['position']).'
                </div>
               	'.$social.'
            </div>
        </li>';
	$i++;	
	}
}

 
if ($type!='-mod') 
	$out .= '
		<div class="b-slick-holder">
			<div class="b-team-carousel clearfix">
			'.$members.'
			</div>
		</div>
		<div class="b-slick-arrows">
		    <div class="custom-slideshow-controls">
		        <span id="team-slideshow-prev" class="slick-arrows-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
		        <span id="team-slideshow-next" class="slick-arrows-next"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
		    </div>
		</div>
	</div>
	';	
else
	$out .= '
		<div class="b-team-list">
	        <ul class="list-unstyled clearfix">
	            '.$members.'   
		        <li class="team-list-item last-list-item">
	                <img src="'.esc_url($img_link).'" >
	                <div class="member-list-caption">
	                    <div class="list-title">
	                        '.esc_html($title).'
	                    </div>
	                    <div class="list-description hidden-xs hidden-sm">
	                        '.esc_html($text).'
	                    </div>
	                    <a href="'.esc_attr($link).'" class="btn btn-submit text-uppercase">
	                        '.esc_html($button).'
	                    </a>
	                </div>
	            </li>
	        </ul>
	    </div>
	    
	</div>

	
	<div class="clearfix"></div>';




$out .= '
</div>'; 


echo $out; ?>







 







