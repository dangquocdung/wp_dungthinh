<?php
/*
 * The template for displaying all single posts.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */
get_header();

// Single Sidebar
$single_sidebar_position = cs_get_option('single_sidebar_position');
$eunice_page_layout = get_post_meta( get_the_ID(), 'page_layout_options', true );
if($eunice_page_layout){
	$page_layout = $eunice_page_layout['page_layout'];
	if($page_layout === 'left-sidebar'){
		$blog_container_class = 'singlepage-with-left-sidebar fix';
	}elseif ($page_layout === 'right-sidebar') {
		$blog_container_class = 'singlepage-with-right-sidebar fix';
	}else{
		$blog_container_class = '';
	}
} else {
	if($single_sidebar_position === 'sidebar-left'){
		$blog_container_class = 'singlepage-with-left-sidebar fix';
	} elseif ($single_sidebar_position === 'sidebar-right') {
		$blog_container_class = 'singlepage-with-right-sidebar fix';
	} else {
		$blog_container_class = '';
	}
	$page_layout = '';
}

if ( 'gallery' == get_post_format() && $single_sidebar_position == 'sidebar-hide'){
	$styless = 'single-gallery-without-sidebar';
} else {
	$styless = '';
}
?>

<div class="main-content-area">
  <div class="content-warp">
	<div class="single-post-warp">
	    <!--start\-->
	    <div class="container container-width-1170 single-post-page-container <?php echo esc_attr($blog_container_class).' '.esc_attr($styless);?>">
			<?php
			if ($eunice_page_layout) {
				if ($page_layout == 'left-sidebar') {
					get_sidebar();
				}
			} elseif($single_sidebar_position === 'sidebar-left') {
				get_sidebar();
			}

			// Div Open
			if($eunice_page_layout){
				if($page_layout === 'left-sidebar'){
					echo '<div class="single-post-container">';
				}elseif ($page_layout === 'right-sidebar') {
					echo '<div class="fix single-post-container">';
				}else{
					echo '';
				}
			} else {
				if($single_sidebar_position === 'sidebar-left'){
					echo '<div class="single-post-container">';
				} elseif ($single_sidebar_position === 'sidebar-right') {
					echo '<div class="fix single-post-container">';
				} else {
					echo '';
				}
			}
			// Div Open End

			if ( have_posts() ) :
				/* Start the Loop */
				while ( have_posts() ) : the_post();
				if ( ! post_password_required() ) {
					get_template_part( 'layouts/post/content', 'single' );
				}else{
					the_content();
				}
				endwhile;
			else :
				get_template_part( 'layouts/post/content', 'none' );
			endif;
			    wp_reset_postdata();  // avoid errors further down the page

			// Div Close
			if($eunice_page_layout) {
				$page_layout = $eunice_page_layout['page_layout'];
				if($page_layout === 'left-sidebar'){
					echo '</div>';
				}elseif ($page_layout === 'right-sidebar') {
					echo '</div>';
				}else{
					echo '';
				}
			} else {
				if($single_sidebar_position === 'sidebar-left'){
					echo '</div>';
				} elseif ($single_sidebar_position === 'sidebar-right') {
					echo '</div>';
				} else {
					echo '';
				}
			}
			// Div Close End

			if ($eunice_page_layout) {
				if ($page_layout == 'right-sidebar') {
					get_sidebar();
				}
			} elseif($single_sidebar_position === 'sidebar-right') {
				get_sidebar();
			}
			?>
		</div>
	</div>
	</div>
</div>

<?php
get_footer();
