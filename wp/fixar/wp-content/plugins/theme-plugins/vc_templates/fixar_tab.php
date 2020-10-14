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
 * @var $this WPBakeryShortCode_Section_Tab
 */
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
 
$link_btn = '';
if ($link)	
	$link_btn = '<a href="'.esc_attr($link).'" class="btn btn-additional">
                        '.esc_html__('more info', 'fixar').'
                    </a>';
                    
$out = '
		<div class="tab-pane" id="tab-' . esc_attr(( empty( $tab_id ) ? sanitize_title( $title ) : $tab_id )) . '">
			<div class="container">
				 
					<p>'.do_shortcode($content).'</p>'.
					
					$link_btn .'
					
					
				 
			</div>
		</div>
	';

echo $out;