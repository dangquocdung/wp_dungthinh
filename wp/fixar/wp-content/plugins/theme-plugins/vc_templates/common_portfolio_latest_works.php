<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $cat_port
 * @var $count
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Portfolio_Latest_Works
 */
$cat_port = $count = $css_animation = '';
$out = $cnt = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

global $post;

$css_animation_class = $css_animation != '' && $css_animation != 'none' ? ' wow ' . $css_animation : '';

if ( $cat_port == '' ) :
	$out .= '<p>'.esc_html__('No categories selected. To fix this, please login to your WP Admin area and set the categories you want to show by editing this shortcode and setting one or more categories in the multi checkbox field "Categories".', 'fixar');

else:

	$out .= '
		<div class="latest-works-section clearfix">
			<div class="scroll-pane ">
	';

	$port_categories = get_objects_in_term( explode( ",", $cat_port ), 'portfolio_category');

	$args = array(
				'post_type' => 'portfolio',
				'post__in' => $port_categories
			);


	if ( is_numeric( $count ) && $count > 0 ) {
		$args['posts_per_page'] = $count;
	}
	else {
		$args['posts_per_page'] = -1;
	}

	$wp_query = new WP_Query( $args );

	if ( $wp_query->have_posts() ) :
		$out .= '
			<div class="scroll-content">
		';

		while ( $wp_query->have_posts() ) :
			$wp_query->the_post();

			$thumbnail = get_the_post_thumbnail($post->ID, 'fixar-portfolio-thumb');

			$full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
			$link = $full_image[0];


			$out .= '

				<div class="scroll-content-item '. esc_attr($css_animation_class) . '" id="post-'.esc_attr(get_the_ID()).'">
					<a href="'.esc_url( get_permalink( get_the_ID() ) ).'">'.wp_kses_post($thumbnail).'</a>
					<div class="name">'.wp_kses_post( get_the_title() ).'</div>
				</div>

			';

		endwhile;

		$out .= '
			</div>
		';

	endif;

$out .= '
			<div class="scroll-bar-wrap ">
				<div class="scroll-bar"></div>
			</div>
		</div>
	</div>
';
endif;

wp_reset_postdata();

echo $out;