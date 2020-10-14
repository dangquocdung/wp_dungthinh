<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $btn_text
 * @var $link
 * @var $skin
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Reviews
 */
global $post; 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$date = '';

$fixar_options = get_option('fixar_general_settings');
$skin = $skin == '' ? 'pix-lastnews-light' : $skin;

$out = $css_animation != '' && $css_animation != 'none' ? '<div class="animated '.esc_attr($skin).'" data-animation="' . esc_attr($css_animation) . '">' : '<div class="'.esc_attr($skin).'">';

$out .= '
		<div class="solid blog-list-container">
                <div class="dark-content">
		';

$args = array(
			'ignore_sticky_posts' => true,
			'showposts' => 3,
		);

$wp_query = new WP_Query( $args );
			 					
	if ($wp_query->have_posts()):
		$i=0;
		$cnt = $wp_query->post_count;	
 		
		while ($wp_query->have_posts()) : 							
			$wp_query->the_post();
			$custom = get_post_custom(get_the_ID());
			$i++;
			if(fixar_get_option('blog_show_category', '1')){
				$categories = get_the_category(get_the_ID());
				if($categories){
					$cat = '';						
					foreach($categories as $category) {
						$cat .= '<a href="'.esc_url(get_category_link( $category->term_id )).'" >'.wp_kses_post($category->cat_name).'</a> ';
					}						
				}
			}
			if(fixar_get_option('blog_show_date', '1')){
				$date = '<span>'.wp_kses_post(get_the_time('F j Y')).'</span>';
			}

			$thumbnail = get_the_post_thumbnail( get_the_ID() ) != '' ? get_the_post_thumbnail( get_the_ID(), 'fixar-post-thumb' ) : '<img src="'.esc_url(get_template_directory_uri()).'/images/no_image.png">';

			$out .= '

				<div class="col-md-4">
                    <div class="list-blog-item">
                        <div class="blog-image img-hover-effect">
                            <a class="post-image" href="'.esc_url(get_the_permalink()).'">'.wp_kses_post($thumbnail).'</a>
                        </div>
                        <div class="tags">
                            '.wp_kses_post($date).'
                            <span> | </span>
                            <span>'.wp_kses_post($cat).'</span>
                        </div>
                        <div class="blog-description">
                            <h4><a href="'.esc_url(get_the_permalink()).'">'.wp_kses_post(get_the_title()).'</a></h4>
                            <p>'.get_the_excerpt().'</p>
                            <a href="'.esc_url(get_the_permalink()).'" class="read-more"><i class="fa fa-long-arrow-right"></i></a>
                        </div>

					</div>
				</div>

			';

		endwhile;

	endif;
	 
$out .= '
			</div>
		</div>
        <!--end-->
	</div>
	';
	
echo $out;