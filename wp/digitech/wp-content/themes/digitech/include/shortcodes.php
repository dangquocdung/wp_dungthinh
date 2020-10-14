<?php
function digitech_mainmenu_shortcode( $atts ) {
	$digitech_opt = get_option( 'digitech_opt' );

	$atts = shortcode_atts( array(
							'sticky_logoimage' => '',
							), $atts, 'roadmainmenu' );
	$html = '';
	
	ob_start(); ?>
	<div class="main-menu-wrapper">
		<div class="visible-small mobile-menu"> 
			<div class="mbmenu-toggler"><?php echo esc_html($digitech_opt['mobile_menu_label']);?><span class="mbmenu-icon"><i class="fa fa-bars"></i></span></div>
			<div class="clearfix"></div>
			<?php wp_nav_menu( array( 'theme_location' => 'mobilemenu', 'container_class' => 'mobile-menu-container', 'menu_class' => 'nav-menu' ) ); ?>
		</div>
		<div class="<?php if(isset($digitech_opt['sticky_header']) && $digitech_opt['sticky_header']) {echo 'header-sticky';} ?> <?php if ( is_admin_bar_showing() ) {echo 'with-admin-bar';} ?>">
			<div class="nav-container">
				<?php if( isset($atts['sticky_logoimage']) && $atts['sticky_logoimage']!=''){ ?>
					<div class="logo-sticky"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo  wp_get_attachment_url( $atts['sticky_logoimage']);?>" alt=" <?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> " /></a></div>
				<?php } ?>
				<div class="horizontal-menu visible-large">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'primary-menu-container', 'menu_class' => 'nav-menu' ) ); ?>
				</div> 
			</div> 
		</div>
	</div>	
	<?php
	$html .= ob_get_contents();

	ob_end_clean();
	
	return $html;
}

function digitech_roadcategoriesmenu_shortcode ( $atts ) {

	$digitech_opt = get_option( 'digitech_opt' );

	$html = '';

	ob_start();

	$cat_menu_class = '';

	if(isset($digitech_opt['categories_menu_home']) && $digitech_opt['categories_menu_home']) {
		$cat_menu_class .=' show_home';
	}
	if(isset($digitech_opt['categories_menu_sub']) && $digitech_opt['categories_menu_sub']) {
		$cat_menu_class .=' show_inner';
	}
	?>
	<div class="categories-menu-wrapper">
		<div class="categories-menu-inner">
			<div class="categories-menu visible-large <?php echo esc_attr($cat_menu_class); ?>">
				<div class="catemenu-toggler"><span><?php if(isset($digitech_opt['categories_menu_label'])) { echo esc_html($digitech_opt['categories_menu_label']); } else { esc_html_e('ALL CATEGORIES', 'digitech'); } ?></span></div>
				<div class="catemenu">
					<div class="catemenu-inner">
						<?php wp_nav_menu( array( 'theme_location' => 'categories', 'container_class' => 'categories-menu-container', 'menu_class' => 'categories-menu' ) ); ?>
						<div class="morelesscate">
							<span class="morecate"><i class="fa fa-plus"></i><?php if ( isset($digitech_opt['categories_more_label']) && $digitech_opt['categories_more_label']!='' ) { echo esc_html($digitech_opt['categories_more_label']); } else { esc_html_e('More Categories', 'digitech'); } ?></span>
							<span class="lesscate"><i class="fa fa-minus"></i><?php if ( isset($digitech_opt['categories_less_label']) && $digitech_opt['categories_less_label']!='' ) { echo esc_html($digitech_opt['categories_less_label']); } else { esc_html_e('Close Menu', 'digitech'); } ?></span>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<?php

	$html .= ob_get_contents();

	ob_end_clean();
	
	return $html;
}

function digitech_roadsocialicons_shortcode( $atts ) {
	$digitech_opt = get_option( 'digitech_opt' );

	$html = '';

	ob_start();

	if(isset($digitech_opt['social_icons'])) {
		echo '<ul class="social-icons">';
		foreach($digitech_opt['social_icons'] as $key=>$value ) {
			if($value!=''){
				if($key=='vimeo'){
					echo '<li><a class="'.esc_attr($key).' social-icon" href="'.esc_url($value).'" title="'.ucwords(esc_attr($key)).'" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>';
				} else {
					echo '<li><a class="'.esc_attr($key).' social-icon" href="'.esc_url($value).'" title="'.ucwords(esc_attr($key)).'" target="_blank"><i class="fa fa-'.esc_attr($key).'"></i></a></li>';
				}
			}
		}
		echo '</ul>';
	}

	$html .= ob_get_contents();

	ob_end_clean();
	
	return $html;
}

function digitech_roadminicart_shortcode( $atts ) {

	$html = '';

	ob_start();

	if ( class_exists( 'WC_Widget_Cart' ) ) {
		the_widget('Custom_WC_Widget_Cart');
	}

	$html .= ob_get_contents();

	ob_end_clean();
	
	return $html;
}

function digitech_roadproductssearch_shortcode( $atts ) {

	$html = '';

	ob_start();

	if( class_exists('WC_Widget_Product_Categories') && class_exists('WC_Widget_Product_Search') ) { ?>
  		<div class="header-search">
	  		<div class="search-without-dropdown">
		  		<div class="categories-container">
		  			<div class="cate-toggler-wrapper"><div class="cate-toggler"><span class="cate-text"><?php esc_html_e('All Categories', 'digitech');?></span></div></div>
		  			<?php the_widget('WC_Widget_Product_Categories', array('hierarchical' => true, 'title' => 'All Categories', 'orderby' => 'order')); ?>
		  		</div> 
		   		<?php the_widget('WC_Widget_Product_Search', array('title' => 'Search')); ?>
	  		</div>
  		</div>
	<?php }

	$html .= ob_get_contents();

	ob_end_clean();
	
	return $html;
}

function digitech_roadproductssearchdropdown_shortcode( $atts ) {

	$html = '';

	ob_start();

	if( class_exists('WC_Widget_Product_Categories') && class_exists('WC_Widget_Product_Search') ) { ?>
		<div class="header-search">
			<div class="search-dropdown">
				<?php the_widget('WC_Widget_Product_Search', array('title' => 'Search')); ?>
			</div>
		</div>
	<?php }

	$html .= ob_get_contents();

	ob_end_clean();
	
	return $html;
}

function digitech_brands_shortcode( $atts ) {
	global $digitech_opt;
	$brand_index = 0;
	
	if(isset($digitech_opt['brand_logos'])) {
		$brandfound = count($digitech_opt['brand_logos']);
	}
	$atts = shortcode_atts( array(
							'rowsnumber' => '1',
							'colsnumber' => '6',
							), $atts, 'ourbrands' );
	$html = '';
	
	if(isset($digitech_opt['brand_logos']) && $digitech_opt['brand_logos']) {
		$html .= '<div class="brands-carousel" data-col="'.$atts['colsnumber'].'">';
			foreach($digitech_opt['brand_logos'] as $brand) {
				if(is_ssl()){
					$brand['image'] = str_replace('http:', 'https:', $brand['image']);
				}
				$brand_index ++;
				if ( (0 == ( $brand_index - 1 ) % $atts['rowsnumber'] ) || $brand_index == 1) {
					$html .= '<div class="group">';
				}
				$html .= '<div>';
				$html .= '<a href="'.$brand['url'].'" title="'.$brand['title'].'">';
					$html .= '<img src="'.$brand['image'].'" alt="'.$brand['title'].'" />';
				$html .= '</a>';
				$html .= '</div>';
				if ( ( ( 0 == $brand_index % $atts['rowsnumber'] || $brandfound == $brand_index ))  ) {
					$html .= '</div>';
				}
			}
		$html .= '</div>';
	}
	
	return $html;
}

function digitech_counter_shortcode( $atts ) {
	
	$atts = shortcode_atts( array(
							'image' => '',
							'number' => '100',
							'text' => 'Demo text',
							), $atts, 'digitech_counter' );
	$html = '';
	$html.='<div class="digitech-counter">';
		$html.='<div class="counter-image">';
			$html.='<img src="'.wp_get_attachment_url($atts['image']).'" alt="'.esc_attr( $atts['text'] ).'" />';
		$html.='</div>';
		$html.='<div class="counter-info">';
			$html.='<div class="counter-number">';
				$html.='<span>'.$atts['number'].'</span>';
			$html.='</div>';
			$html.='<div class="counter-text">';
				$html.='<span>'.$atts['text'].'</span>';
			$html.='</div>';
		$html.='</div>';
	$html.='</div>';
	
	return $html;
}

function digitech_popular_categories_shortcode( $atts ) {

	$atts = shortcode_atts( array(
		'category' => '',
		'image' => ''
	), $atts, 'popular_categories' );
	
	$html = '';
	
	$html .= '<div class="category-wrapper">';
		$pcategory = get_term_by( 'slug', $atts['category'], 'product_cat', 'ARRAY_A' );
		if($pcategory){
			$html .= '<div class="category-list">';
				$html .= '<h3><a href="'. get_term_link($pcategory['slug'], 'product_cat') .'">'. $pcategory['name'] .'</a></h3>';
				
				$html .= '<ul>';
					$args2 = array(
						'taxonomy'     => 'product_cat',
						'child_of'     => 0,
						'parent'       => $pcategory['term_id'],
						'orderby'      => 'name',
						'show_count'   => 0,
						'pad_counts'   => 0,
						'hierarchical' => 0,
						'title_li'     => '',
						'hide_empty'   => 0
					);
					$sub_cats = get_categories( $args2 );

					if($sub_cats) {
						foreach($sub_cats as $sub_category) {
							$html .= '<li><a href="'.get_term_link($sub_category->slug, 'product_cat').'">'.$sub_category->name.'</a></li>';
						}
					}
				$html .= '</ul>';
			$html .= '</div>';

			if ($atts['image']!='') {
			$html .= '<div class="cat-img">';
				$html .= '<a href="'.get_term_link($pcategory['slug'], 'product_cat').'"><img class="category-image" src="'.esc_attr($atts['image']).'" alt="'.esc_attr($pcategory['name']).'" /></a>';
			$html .= '</div>';
			}
		}
	$html .= '</div>';
	
	return $html;
}

function digitech_latestposts_shortcode( $atts ) {
	global $digitech_opt;
	$post_index = 0;
	$atts = shortcode_atts( array(
		'posts_per_page' => 5,
		'order' => 'DESC',
		'orderby' => 'post_date',
		'image' => 'wide', //square
		'length' => 20,
		'rowsnumber' => '1',
		'colsnumber' => '2',
		'image1' => 'square',
	), $atts, 'latestposts' );
	
	if($atts['image']=='wide'){
		$imagesize = 'digitech-post-thumbwide';
	} else {
		$imagesize = 'digitech-post-thumb';
	}
	$html = '';

	$postargs = array(
		'posts_per_page'   => $atts['posts_per_page'],
		'offset'           => 0,
		'category'         => '',
		'category_name'    => '',
		'orderby'          => $atts['orderby'],
		'order'            => $atts['order'],
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'post',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'post_status'      => 'publish',
		'suppress_filters' => true );
	
	$postslist = get_posts( $postargs );

	$html.='<div class="posts-carousel" data-col="'.$atts['colsnumber'].'">';

			foreach ( $postslist as $post ) {
				$post_index ++;
				if ( (0 == ( $post_index - 1 ) % $atts['rowsnumber'] ) || $post_index == 1) {
					$html .= '<div class="group">';
				}
				$html.='<div class="item-col">';
					$html.='<div class="post-wrapper">';

					// author link
					$author_id = $post->post_author;
					$author_url = get_author_posts_url( get_the_author_meta( 'ID', $author_id ) );
					$author_name = get_the_author_meta( 'user_nicename', $author_id );
					
					//comment variables
					$num_comments = (int)get_comments_number($post->ID);
					$write_comments = '';
					if ( comments_open($post->ID) ) {
						if ( $num_comments == 0 ) {
							$comments = wp_kses(__('<span>0</span> comments', 'digitech'), array('span'=>array()));
						} elseif ( $num_comments > 1 ) {
							$comments = '<span>'.$num_comments .'</span>'. esc_html__(' comments', 'digitech');
						} else {
							$comments = wp_kses(__('<span>1</span> comment', 'digitech'), array('span'=>array()));
						}
						$write_comments = '<a href="' . get_comments_link($post->ID) .'">'. $comments.'</a>';
					}
					
					$html.='<div class="post-thumb">'; 

						$html.='<a href="'.get_the_permalink($post->ID).'">'.get_the_post_thumbnail($post->ID, $imagesize).'</a>';

					$html.='</div>';
					
					$html.='<div class="post-info">';

						$html.='<div class="post-date">'.get_the_date().'</div>';

						$html.='<h3 class="post-title"><a href="'.get_the_permalink($post->ID).'">'.get_the_title($post->ID).'</a></h3>';

						$html.='<div class="post-meta">';
							
							$html.='<p class="post-comment">'.$write_comments.'</p>';

						$html.='</div>';

						$html.='<div class="post-excerpt">';
							$html.= Digitech_Class::digitech_excerpt_by_id($post, $length = $atts['length']);
						$html.='</div>';
						
						$html.='<p class="post-author">';

							$html.= sprintf(get_avatar($author_id));
							$html.= sprintf( wp_kses(__( '%s', 'digitech' ), array('a'=>array('href'=>array()))), __('Posted by ', 'digitech').'<a href="'.$author_url.'">'.$author_name.' </a>' );
						$html.='</p>';

						$html.='<a class="readmore" href="'.get_the_permalink($post->ID).'">'.'<span>' .esc_html($digitech_opt['readmore_text']). '</span>'.'</a>';

					$html.='</div>';

				$html.='</div>';
			$html.='</div>';
			if ( ( ( 0 == $post_index % $atts['rowsnumber'] || $atts['posts_per_page'] == $post_index ))  ) {
				$html .= '</div>';
			}
		}
	$html.='</div>';

	wp_reset_postdata();
	
	return $html;
}

function digitech_magnifier_options($att) {  
	$enable_slider 	= get_option('yith_wcmg_enableslider') == 'yes' ? true : false;
	$slider_items = get_option( 'yith_wcmg_slider_items', 3 ); 
	if ( !isset($slider_items) || ( $slider_items == null ) ) $slider_items = 3;

	wp_enqueue_script('digitech-magnifier', get_template_directory_uri() . '/js/product-magnifier-var.js');
	wp_localize_script('digitech-magnifier', 'digitech_magnifier_vars', array(
		
			'responsive' => get_option('yith_wcmg_slider_responsive') == 'yes' ? 'true' : 'false',
			'circular' => get_option('yith_wcmg_slider_circular') == 'yes' ? 'true' : 'false',
			'infinite' => get_option('yith_wcmg_slider_infinite') == 'yes' ? 'true' : 'false',

			'visible' => esc_js(apply_filters( 'woocommerce_product_thumbnails_columns', $slider_items )),

			'zoomWidth' => get_option('yith_wcmg_zoom_width'),
			'zoomHeight' => get_option('yith_wcmg_zoom_height'),
			'position' => get_option('yith_wcmg_zoom_position'),

			'lensOpacity' => get_option('yith_wcmg_lens_opacity'),
			'softFocus' => get_option('yith_wcmg_softfocus') == 'yes' ? 'true' : 'false',
			'phoneBehavior' => get_option('yith_wcmg_zoom_mobile_position'),
			'loadingLabel' => stripslashes(get_option('yith_wcmg_loading_label')),
		)
	);
}
?>