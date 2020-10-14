<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $fixarate
 * @var $cat_port
 * @var $perrow
 * @var $count
 * @var $type
 * @var $btnshow
 * @var $btntext
 * @var $css_animation
 * @var $tab_id
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Portfolio
 */
 $display = $thumb_size = $filter = $cat_port = $count = $btnshow = $btntext = $css_animation = $animate = $tab_id = $class_col = $btntext_pl = $btntext_cl = '';
 $out = $cnt = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$wdata = 'data-widget-id="common_portfolio" data-widget-name="C Portfolio"';
if ( $display == 'puzzle' ) {
	$add_class_port_col = 'col-xs-6';
	$class_col = 'portfolio-perrow-puzzle';
} elseif ( $perrow == '3' ) {
	$add_class_port_col = 'col-md-4 col-sm-4 col-xs-6';
	$class_col = 'portfolio-perrow-3';
} elseif ( $perrow == '4' ) {
	$add_class_port_col = 'col-md-3 col-sm-4 col-xs-6';
	$class_col = 'portfolio-perrow-4';
} else {
	$add_class_port_col = 'col-md-6 col-sm-6 col-xs-6';
	$class_col = 'portfolio-perrow-2';
}

if ( $cat_port == '' ) :
	$out .= '<p>'.esc_html__('No categories selected. To fix this, please login to your WP Admin area and set the categories you want to show by editing this shortcode and setting one or more categories in the multi checkbox field "Categories".', 'fixar');

else:

	$out .= '<div id="portfolio-'.esc_attr($tab_id).'" class="portfolio-list-section '.esc_attr($class_col).'">';

	if ( $content != '' ) :
		$out .= '
			<div class="section-heading text-center">
				<div class="section-subtitle">'.wp_kses_post(do_shortcode($content)).'</div>
				<div class="design-arrow"></div>
			</div>
		';
	endif;

	$port_categories = explode( ",", $cat_port );

	if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}

	$args = array(
		'post_type' => 'portfolio',
		'orderby' => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
		'tax_query' => array(
			array(
				'taxonomy' => 'portfolio_category',
				'field'    => 'slug',
				'terms'    => $port_categories
			)
		),
		'paged' => $paged
	);


	if ( is_numeric( $count ) && $count > 0 ) {
		$args['posts_per_page'] = $count;
	} else {
		$args['posts_per_page'] = -1;
	}

	$wp_query = new WP_Query( $args );

	if ( $filter == 'yes' && $display != 'grid' ) :
		$out .= '
				<div class="folio-isotop-filter row">
					<div class="col-md-12">
						<ul class="folio-option-set clearfix" >
		';

		$cat_include = array();
		foreach($port_categories as $key => $val){
			$term_cat = get_term_by('slug', $val, 'portfolio_category');
			if(isset($term_cat->term_id))
				$cat_include[] = $term_cat->term_id;
		}

		$categories = get_categories( array( 'type' => 'post', 'taxonomy' => 'portfolio_category', 'include' => implode(',', $cat_include) ) );

		$out .= '
							<li><a href="#" data-filter="*" class="selected">'.esc_html__("All", "fixar").'</a></li>
		';
							foreach ( $categories as $category ) {
								$group = $category->slug;
								$out .= '
								<li><a href="#" data-filter=".'.$group.'">'.$category->cat_name.'</a></li>
								';
							}

		$out .= '
						</ul>
					</div>
				</div>
		';
	endif;

	if ( $wp_query->have_posts() && $display != 'grid' ) {

		$out .= '
			<div class="row portfolio-masonry-holder list-works clearfix">
		';
		$i = $offset = 0;
		while ( $wp_query->have_posts() ) :
			$wp_query->the_post();
			$i++;
			$fixar_portfolio_post_type = ( class_exists( 'RW_Meta_Box' ) && rwmb_meta('post_types_select') != '' ) ? rwmb_meta('post_types_select') : 'image';

			$cats = wp_get_object_terms(get_the_ID(), 'portfolio_category');
			$cat_slugs = '';
			if ( ! empty($cats) ) {
				foreach ( $cats as $cat ) {
					$cat_slugs .= $cat->slug . " ";
				}
			}

			if( $display != 'puzzle' ){
				$img_size = 'fixar-portfolio-thumb';
			} else {
				$thumb_size = get_post_meta(get_the_ID(), 'pix_puzzle_size', true);
				$img_size = $thumb_size != '' ? 'fixar-'.$thumb_size : 'fixar-portfolio-thumb';
				$thumb_size = $thumb_size != '' ? $thumb_size : 'pix-portfolio-thumb';
			}
			$thumbnail = get_the_post_thumbnail(get_the_ID(), $img_size, array('class' => 'img-responsive'));
			$thumbnail_full = get_the_post_thumbnail_url(get_the_ID(), 'full');

			// potfolio category list linked
			$portfolio_link_term = fixar_get_post_terms( array( 'taxonomy' => 'portfolio_category', 'items_wrap' => '%s' ) );

			if($css_animation != '') {
				$animate = 'class="';
				$animate .= 'animated';
				$animate .= !empty($wow_duration) || !empty($wow_delay) || !empty($wow_offset) || !empty($wow_iteration) ? ' wow ' . esc_attr($css_animation) : '';
				$animate .= '"';
				$animate .= ' data-animation="'.esc_attr($css_animation).'"';
				$wow_group = !empty($wow_group) ? $wow_group : 1;
				$wow_group_delay = !empty($wow_group_delay) ? $wow_group_delay : 0;
				$animate .= !empty($wow_duration) ? ' data-wow-duration="'.esc_attr($wow_duration).'s"' : '';
				$animate .= !empty($wow_delay) ? ' data-wow-delay="'.esc_attr($wow_delay + $offset * $wow_group_delay).'s"' : '';
				$animate .= !empty($wow_offset) ? ' data-wow-offset="'.esc_attr($wow_offset).'"' : '';
				$animate .= !empty($wow_iteration) ? ' data-wow-iteration="'.esc_attr($wow_iteration).'"' : '';

				$offset = $i % $wow_group == 0 ? ++$offset : $offset;
			}

			if ( $display == 'puzzle' || $type == 'type_without_icons' || $type == 'type_without_space' ) :
			$no_space_class = $type == 'type_without_space' || $display == 'puzzle' ? 'pix-no-space ' : '';
			$out .= '
				<div '.wp_kses_post($animate).'>
					<div class="' . esc_attr($add_class_port_col). ' item '. esc_attr($no_space_class) . esc_attr($cat_slugs) . ' '.esc_attr($thumb_size).'" id="post-'.esc_attr(get_the_ID()).'">
						<div class="portfolio-item">
							<div class="portfolio-image">
								<a href="'.esc_url( get_permalink( get_the_ID() ) ).'">'.wp_kses_post($thumbnail).'</a>
								<div class="tmpl-portfolio-inner">
									<div class="gallery-item-hover">
										<a href="'.esc_url( $thumbnail_full ).'" class="fancybox">
											<span class="item-hover-icon"><i class="fa fa-search"></i></span>
										</a>
										<a href="'.esc_url( get_permalink( get_the_ID() ) ).'">
											<span class="item-hover-icon"><i class="fa fa-link"></i></span>
										</a>
									</div>
									<div class="portfolio-item-body">
										<div class="name">'.wp_kses_post( get_the_title() ).'</div>
										<div class="under-name">'.wp_kses_post( $portfolio_link_term ).'</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			';

			else :
			$fixar_portfolio_project_link = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_button_link') : '';
            $fixar_portfolio_client_link = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_client_link') : '';
            $fixar_portfolio_project_text = $btntext_pl != '' ? $btntext_pl : esc_html__( 'Project link', 'fixar' );
            $fixar_portfolio_client_text = $btntext_cl != '' ? $btntext_cl : esc_html__( 'Client link', 'fixar' );

            $btn_pl = $fixar_portfolio_project_link == '' ? '' : '<a href="'.esc_url( $fixar_portfolio_project_link ).'" class="btn-portfolio-first">'.wp_kses_post($fixar_portfolio_project_text).'</a>';
            $btn_cl = $fixar_portfolio_client_link == '' ? '' : '<a href="'.esc_url( $fixar_portfolio_client_link ).'" class="btn-portfolio-second">'.wp_kses_post($fixar_portfolio_client_text).'</a>';

			$out .= '
				<div '.wp_kses_post($animate).'>
					<div class="' . esc_attr($add_class_port_col). ' item '.esc_attr($cat_slugs). '" id="post-'.esc_attr(get_the_ID()).'">
						<div class="portfolio-item tmpl-portfolio-box-shadow">
							<div class="portfolio-image">
								<a href="'.esc_url( get_permalink( get_the_ID() ) ).'">'.wp_kses_post($thumbnail).'</a>								                                 
                            
                                <div class="tmpl-portfolio-external">   
									<div class="tmpl-portfolio-wrap">
                                
	                                    <h3>'.wp_kses_post( get_the_title() ).'</h3>
	                             
	                                    <div class="tmpl-portfolio-desc">                               
	                                        '.wp_kses_post( get_the_excerpt() ).'
	                                    </div>
	                               
	                                    '.wp_kses_post($btn_pl).'
	                                    '.wp_kses_post($btn_cl).'
	                               
	                                </div>                                
                                </div>                                                                
                                
							</div>
						</div>
						
					</div>
				</div>
			';

			endif;

		endwhile;

		$out .= '
		</div>
		';

		if ( get_next_posts_link( '', $wp_query->max_num_pages ) ) {
			if ( $btnshow == 'yes' || $btnshow == "" ) {

				$out .= '
					<div class="row">
						<div class="col-md-12 text-center">
							<div class="portfolio-pagination">
								<span data-current="'.esc_attr($paged).'" data-max-pages="'.esc_attr($wp_query->max_num_pages).'" class="load-more">' . get_next_posts_link( wp_kses_post($btntext), $wp_query->max_num_pages) . '</span>
							</div>
							<div class="portfolio-pagination-loading">
								<a href="javascript: void(0)" class="btn btn-default">'. esc_html__("Loading...", "fixar") .'</a>
							</div>
						</div>
					</div>
				';
			}
		}

	} elseif( $wp_query->have_posts() ) {

		apply_filters('fixar_grid_portfolio_enq', '');

		$out .= '
			<ul id="og-grid" class="og-grid">
		';

		while ($wp_query->have_posts()) :
			$wp_query->the_post();

			$fixar_portfolio_desc = (class_exists('RW_Meta_Box')) ? rwmb_meta('portfolio_desc') : '';
			$fixar_portfolio_full_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'fixar-portfolio-thumb', false);
			$fixar_portfolio_full_image_link = $fixar_portfolio_full_image[0];

			$out .= '
					<li>
						<a href="' . esc_url(get_permalink(get_the_ID())) . '"
                           data-largesrc="' . esc_url($fixar_portfolio_full_image_link) . '"
                           data-title="' . esc_attr(get_the_title()) . '"
                           data-description="'.wp_kses_post( get_the_excerpt() ).'">
							<img src="' . esc_url($fixar_portfolio_full_image_link) . '" alt="' . esc_attr(get_the_title()) . '"/>
						</a>
					</li>';

		endwhile;

		$out .= '
			</ul>
		';

	}

$out .= '</div>';
endif;

wp_reset_postdata();

echo $out;