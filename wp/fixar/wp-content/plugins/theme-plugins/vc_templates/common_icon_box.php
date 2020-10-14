<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $type
 * @var $icon_pixelegant
 * @var $icon_pixflaticon
 * @var $icon_pixicomoon
 * @var $icon_pixfontawesome
 * @var $icon_pixsimple
 * @var $icon_fontawesome
 * @var $icon_openiconic
 * @var $icon_typicons
 * @var $icon_entypo
 * @var $icon_linecons
 * @var $title
 * @var $link
 * @var $spin
 * @var $color
 * @var $position
 * @var $show_decor
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Common_Icon_Box
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$href = vc_build_link( $link );

$icon = isset( ${"icon_" . $type} ) ? ${"icon_" . $type} : '';
$target = empty($href['target']) ? '' : 'target="'.esc_attr($href['target']).'"';
$icon_type = empty($spin) ? '' : 'fa-spin';
$show_icon = empty($href['url']) ? '<div class="striped-icon-xlarge"><span class="fa '.esc_attr($icon).' '.esc_attr($icon_type).'" ></span></div>' : '<a '.wp_kses_post($target).' href="'.esc_url($href['url']).'"><div class="striped-icon-xlarge"><span class="fa '.esc_attr($icon).' '.esc_attr($icon_type).'" ></span></div></a>';
$show_decor = ($show_decor == '') ? '' : '<div class="dotted-line hidden-sm hidden-xs"></div>';
$final_content = ($content == '') ? '' : '<p>'.do_shortcode($content).'</p>';


$wdata = 'data-widget-id="common_icon_box" data-widget-name="Icon Box"';
$animate = $animate_data = '';
if($css_animation != '') {
	$animate = 'animated';
	$animate .= !empty($wow_duration) || !empty($wow_delay) || !empty($wow_offset) || !empty($wow_iteration) ? ' wow ' . esc_attr($css_animation) : '';
	$animate_data .= 'data-animation="'.esc_attr($css_animation).'"';
	$animate_data .= !empty($wow_duration) ? ' data-wow-duration="'.esc_attr($wow_duration).'s"' : '';
	$animate_data .= !empty($wow_delay) ? ' data-wow-delay="'.esc_attr($wow_delay).'s"' : '';
	$animate_data .= !empty($wow_offset) ? ' data-wow-offset="'.esc_attr($wow_offset).'"' : '';
	$animate_data .= !empty($wow_iteration) ? ' data-wow-iteration="'.esc_attr($wow_iteration).'"' : '';
}

$out = '<div '.wp_kses_post($wdata).' class="'.esc_attr($animate).'" '.wp_kses_post($animate_data).'>';

$out .= '
        <article class="contact-item">
            '.wp_kses_post($show_decor).'
            '.wp_kses_post($show_icon).'
            <h5>'.wp_kses_post($title).'</h5>
            '.wp_kses_post($final_content).'
        </article>
	';		

$out .= '</div>'; 

echo $out;