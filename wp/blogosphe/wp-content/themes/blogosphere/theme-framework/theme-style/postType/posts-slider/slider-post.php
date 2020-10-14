<?php
/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version		1.0.2
 * 
 * Posts Slider Post Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_metadata = explode(',', $cmsmasters_post_metadata);


$title = in_array('title', $cmsmasters_metadata) ? true : false;
$excerpt = (in_array('excerpt', $cmsmasters_metadata) && blogosphere_slider_post_check_exc_cont('post')) ? true : false;
$date = in_array('date', $cmsmasters_metadata) ? true : false;
$categories = (get_the_category() && (in_array('categories', $cmsmasters_metadata))) ? true : false;
$author = in_array('author', $cmsmasters_metadata) ? true : false;
$comments = (comments_open() && (in_array('comments', $cmsmasters_metadata))) ? true : false;
$likes = in_array('likes', $cmsmasters_metadata) ? true : false;
$views = in_array('views', $cmsmasters_metadata) ? true : false;
$more = in_array('more', $cmsmasters_metadata) ? true : false;


$cmsmasters_post_format = get_post_format();

?>
<!-- Start Posts Slider Post Article -->
<article id="post-<?php the_ID(); ?>" <?php post_class('cmsmasters_slider_post'); ?>>
	<div class="cmsmasters_slider_post_outer">
	<?php
		echo '<div class="cmsmasters_slider_post_date_img_wrap">';
		
			blogosphere_thumb_rollover(get_the_ID(), 'cmsmasters-post-slider-thumb', false, false, false, false, false, false, false, false, true, false, false);
		
		echo '</div>';
		
		if ($categories || $title || $date || $author || $excerpt || $comments || $likes || $views || $more) {
			echo '<div class="cmsmasters_slider_post_inner">';
				
				$categories ? blogosphere_get_slider_post_category(get_the_ID(), 'category', 'post') : '';
				
				$title ? blogosphere_slider_post_heading(get_the_ID(), 'post', 'h4') : '';
				
				if ($date || $author) {
					echo '<div class="cmsmasters_slider_post_cont_info entry-meta">';
					
						$date ? blogosphere_get_slider_post_date('post') : '';
						
						$author ? blogosphere_get_slider_post_author('post') : '';
						
					echo '</div>';
				}
				
				
				$excerpt ? blogosphere_slider_post_exc_cont('post') : '';
				
				
				if ($comments || $likes || $views || $more) {
					echo '<footer class="cmsmasters_slider_post_footer entry-meta">';
						
						$comments ? blogosphere_get_slider_post_comments('post') : '';
						
						$likes ? blogosphere_slider_post_like('post') : '';
						
						$views ? blogosphere_slider_post_views('post') : '';
						
						if ($more) {
							echo '<div class="cmsmasters_slider_post_read_more_wrap">';
								blogosphere_slider_post_more(get_the_ID());
							echo '</div>';
						}

					echo '</footer>';
				}
				
			echo '</div>';
		}
	?>
	</div>
</article>
<!-- Finish Posts Slider Post Article -->

