<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $btn_text
 * @var $link
 
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Reviews
 */

$posts_style = 'carousel';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$date = '';
 
$args = array(
	'ignore_sticky_posts' => true,
	'posts_per_page' => 0,
);
if( is_numeric($count)  )
	$args['showposts'] = $count;
else
	$args['numberposts'] = -1;


$q = new WP_Query( $args );

if ($q->have_posts()):
$out = '<div class="tmpl-blog-grid">';
$out .= '<ul>';

		while ($q->have_posts()) :
			$q->the_post();
			$custom = get_post_custom(get_the_ID());
    
            $cats = wp_list_pluck(get_the_category(), 'name');
			$cats = implode(',', $cats);

			$get_avatar = get_avatar(get_the_author_meta('ID'), 85);
			preg_match("/src=['\"](.*?)['\"]/i", $get_avatar, $matches);
			$src = !empty($matches[1]) ? $matches[1] : '';
			$post_avatar = $src == '' ? '' : '<a class="post-avatar" href="'.esc_url(get_the_author_meta( 'user_url' )).'">
							<img class="" src="'.esc_url($src).'" alt="'.esc_attr(get_the_author_meta( 'display_name' )).'">
						</a>';

			if(fixar_get_option('blog_settings_categories', 1)){
				$categories = get_the_category(get_the_ID());
				if($categories){
					$cat = '';
					foreach($categories as $category) {
						$cat .= '<a href="'.esc_url(get_category_link( $category->term_id )).'" >'.wp_kses_post($category->cat_name).'</a> ';
					}
				}
			}

			if(fixar_get_option('blog_settings_date', 1)){
				$date = '<li><i class="fa fa-calendar"></i>'.wp_kses_post(get_the_time('j M y')).'</li>';
			}
			$thumbnail = get_the_post_thumbnail( get_the_ID() ) != '' ? get_the_post_thumbnail( get_the_ID(), 'fixar-news-thumb' ) : '';

$out .= '
			<li class="tmp-post-box">
				<div class="tmp-post">
					<div class="tmp-post-heading">
						<a class="tmp-post-image" href="'.esc_url(get_the_permalink()).'">
							'.wp_kses_post($thumbnail).'
						</a>
						
					</div>
					<div class="tmp-post-body">
                       <div class="tmp-post-content">
                         <span class="tmp-post-category">' . $cats . '</span>
						<h5 class="tmp-post-title"><a href="'.esc_url(get_the_permalink()).'">'.wp_kses_post(get_the_title()).'</a></h5>
						
					</div>	</div>
				</div>
			</li>
      ';

		 endwhile;
		 wp_reset_postdata();
$out .= '</ul>';

		 endif;

$out .= '
        <!--end-->
	</div>
	';

echo $out;
