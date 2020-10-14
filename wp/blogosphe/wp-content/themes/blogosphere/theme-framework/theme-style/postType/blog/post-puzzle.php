<?php
/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version		1.0.2
 * 
 * Post Puzzle Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_post_metadata = !is_home() ? explode(',', $cmsmasters_metadata) : array();


$date = (in_array('date', $cmsmasters_post_metadata) || is_home()) ? true : false;
$categories = (get_the_category() && (in_array('categories', $cmsmasters_post_metadata) || is_home())) ? true : false;
$author = (in_array('author', $cmsmasters_post_metadata) || is_home()) ? true : false;
$comments = (comments_open() && (in_array('comments', $cmsmasters_post_metadata) || is_home())) ? true : false;
$likes = (in_array('likes', $cmsmasters_post_metadata) || is_home()) ? true : false;
$views = (in_array('views', $cmsmasters_post_metadata) || is_home()) ? true : false;
$more = (in_array('more', $cmsmasters_post_metadata) || is_home()) ? true : false;


$post_sort_categs = get_the_terms(0, 'category');

if ($post_sort_categs != '') {
	$post_categs = '';
	
	foreach ($post_sort_categs as $post_sort_categ) {
		$post_categs .= ' ' . $post_sort_categ->slug;
	}
	
	$post_categs = ltrim($post_categs, ' ');
}


$cmsmasters_post_format = get_post_format();

?>
<!-- Start Post Puzzle Article -->
<article id="post-<?php the_ID(); ?>" <?php post_class('cmsmasters_post_puzzle'); ?> data-category="<?php echo esc_attr($post_categs); ?>">
	<div class="cmsmasters_post_cont">
		<?php 
		echo '<div class="cmsmasters_post_image_wrapper">';
		
			if (has_post_thumbnail()) {
				blogosphere_thumb(get_the_ID(), 'cmsmasters-blog-puzzle-thumb', true, false, true, false, true, true, false);
			} else {
				blogosphere_post_format_icon_placeholder(get_the_ID(), 'image');
			}
			
			if ($comments || $likes || $views) {
				echo '<div class="cmsmasters_post_footer_info">' . 
					'<div class="cmsmasters_post_footer_info_inner">';
				
					$comments ? blogosphere_get_post_comments('page') : '';
					
					$likes ? blogosphere_get_post_likes('page') : '';
					
					$views ? blogosphere_get_post_views('page') : '';
					
				echo '</div>' . 
				'</div>';
			}
			
		echo '</div>' . 
		'<div class="cmsmasters_post_content_wrapper">' . 
			'<div class="cmsmasters_post_content_outer">' . 
				'<div class="cmsmasters_post_content_inner">';
			
					$categories ? blogosphere_get_post_category(get_the_ID(), 'category', 'page') : '';
					
					blogosphere_post_heading(get_the_ID(), 'h3');
					
					if ($date || $author) {
						echo '<footer class="cmsmasters_post_footer entry-meta">';
					
							$date ? blogosphere_get_post_date('page', 'puzzle') : '';
							
							$author ? blogosphere_get_post_author('page') : '';
							
						echo '</footer>';
					}
					
					
					if ($more) {
						echo '<div class="cmsmasters_read_more_wrap">';
						
							$more ? blogosphere_post_more(get_the_ID()) : '';
							
						echo '</div>';
					}
			
		echo '</div>' . 
			'</div>' . 
		'</div>';
	?>
	</div>
</article>
<!-- Finish Post Puzzle Article -->

