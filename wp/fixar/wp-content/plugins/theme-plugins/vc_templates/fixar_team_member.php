<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $image
 * @var $name
 * @var $position
 * @var $btn_txt
 * @var $email
 * @var $scn1
 * @var $scn_icon1
 * @var $scn2
 * @var $scn_icon2
 * @var $scn3
 * @var $scn_icon3
 * @var $scn4
 * @var $scn_icon4
 * @var $scn5
 * @var $scn_icon5
 * @var $scn6
 * @var $scn_icon6
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Team_Member
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$img_id = preg_replace( '/[^\d]/', '', $image );
$img_link = wp_get_attachment_image_src( $img_id, 'large' );
$img_link = $img_link[0];
$image_meta = fixar_pix_wp_get_attachment($img_id);
$image_alt = $image_meta['alt'] == '' ? $image_meta['title'] : $image_meta['alt'];

$final_scn1 = ($scn1 == '') ? '': '<li><a href="'.esc_url($scn1).'"><span class="ef '.esc_attr($scn_icon1).'"></span></a></li>';
$final_scn2 = ($scn2 == '') ? '': '<li><a href="'.esc_url($scn2).'"><span class="ef '.esc_attr($scn_icon2).'"></span></a></li>';
$final_scn3 = ($scn3 == '') ? '': '<li><a href="'.esc_url($scn3).'"><span class="ef '.esc_attr($scn_icon3).'"></span></a></li>';
$final_scn4 = ($scn4 == '') ? '': '<li><a href="'.esc_url($scn4).'"><span class="ef '.esc_attr($scn_icon4).'"></span></a></li>';
//$final_scn5 = ($scn5 == '') ? '': '<li><a href="'.esc_url($scn5).'"><span class="ef '.esc_attr($scn_icon5).'"></span></a></li>';
//$final_scn6 = ($scn6 == '') ? '': '<li><a href="'.esc_url($scn6).'"><span class="ef '.esc_attr($scn_icon6).'"></span></a></li>';
			
$out = '
		<div class="item">
			<div class="team-img">
				<img src="'.esc_url($img_link).'" alt="'.esc_attr($image_alt).'">
			</div>
			<div class="team-info-block">
				<h4>'.wp_kses_post($name).'</h4>
				<div class="post">'.wp_kses_post($position).'</div>
				<div class="team-text">
					'.do_shortcode($content).'
				</div>';
				if($scn1 || $scn2 || $scn3 || $scn4 ){
					$out .= '
					<ul class="social-circle">
						'.$final_scn1.$final_scn2.$final_scn3.$final_scn4.'
					</ul>';
				}
				$out .= '
			</div>
		</div>
		
	';
echo $out;