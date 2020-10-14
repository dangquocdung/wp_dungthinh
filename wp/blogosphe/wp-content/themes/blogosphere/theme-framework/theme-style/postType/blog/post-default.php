<?php
/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version		1.0.2
 * 
 * Post Default Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_post_metadata = !is_home() ? explode(',', $cmsmasters_metadata) : array();

list($cmsmasters_layout) = blogosphere_theme_page_layout_scheme();


$date = (in_array('date', $cmsmasters_post_metadata) || is_home()) ? true : false;
$categories = (get_the_category() && (in_array('categories', $cmsmasters_post_metadata) || is_home())) ? true : false;
$author = (in_array('author', $cmsmasters_post_metadata) || is_home()) ? true : false;
$comments = (comments_open() && (in_array('comments', $cmsmasters_post_metadata) || is_home())) ? true : false;
$likes = (in_array('likes', $cmsmasters_post_metadata) || (is_home() && CMSMASTERS_CONTENT_COMPOSER)) ? true : false;
$views = (in_array('views', $cmsmasters_post_metadata) || (is_home() && CMSMASTERS_CONTENT_COMPOSER)) ? true : false;
$more = (in_array('more', $cmsmasters_post_metadata) || is_home()) ? true : false;

$cmsmasters_post_format = get_post_format();

$cmsmasters_post_image_link = get_post_meta(get_the_ID(), 'cmsmasters_post_image_link', true);
$cmsmasters_post_images = explode(',', str_replace(' ', '', str_replace('img_', '', get_post_meta(get_the_ID(), 'cmsmasters_post_images', true))));
$cmsmasters_post_video_type = get_post_meta(get_the_ID(), 'cmsmasters_post_video_type', true);
$cmsmasters_post_video_link = get_post_meta(get_the_ID(), 'cmsmasters_post_video_link', true);
$cmsmasters_post_video_links = get_post_meta(get_the_ID(), 'cmsmasters_post_video_links', true);

?>
<!-- Start Post Default Article -->
<article id="post-<?php the_ID(); ?>" <?php post_class('cmsmasters_post_default'); ?>>
	<?php 
	echo '<div class="cmsmasters_post_inner">';
		
		if ($categories) {
			echo '<div class="cmsmasters_post_cont_info entry-meta">';
				
				$categories ? blogosphere_get_post_category(get_the_ID(), 'category', 'page') : '';
				
			echo '</div>';
		}
		
		
		blogosphere_post_heading(get_the_ID(), 'h3');
		
		
		if ($date || $author || $comments || $likes || $views) {
			echo '<div class="cmsmasters_post_info entry-meta">';
				
				$date ? blogosphere_get_post_date('page', 'default') : '';
				
				$author ? blogosphere_get_post_author('page') : '';
				
				$comments ? blogosphere_get_post_comments('page') : '';
				
				$likes ? blogosphere_get_post_likes('page') : '';
				
				$views ? blogosphere_get_post_views('page') : '';
				
			echo '</div>';
		}
		?>
		<div class="cmsmasters_post_cont">
		<?php
			if (
				($cmsmasters_post_format == 'gallery' && (sizeof($cmsmasters_post_images) > 1 || (sizeof($cmsmasters_post_images) == 1 && $cmsmasters_post_images[0] != '') || has_post_thumbnail())) || 
				($cmsmasters_post_format == 'video' && !post_password_required() && (($cmsmasters_post_video_type == 'selfhosted' && !empty($cmsmasters_post_video_links) && sizeof($cmsmasters_post_video_links) > 0) || ($cmsmasters_post_video_type == 'embedded' && $cmsmasters_post_video_link != '') || has_post_thumbnail())) || 
				($cmsmasters_post_format == '' && !post_password_required() && has_post_thumbnail()) || 
				($cmsmasters_post_format == 'image' && !post_password_required() && ($cmsmasters_post_image_link != '' || has_post_thumbnail()))
			) {
				echo '<div class="cmsmasters_post_image_wrapper">';
					if (is_sticky()) { 
						echo '<div class="cmsmasters_post_sticky">' . 
							'<h5>' . esc_html__('Featured Post', 'blogosphere') . '</h5>' . 
						'</div>'; 
					}
					
					if ($cmsmasters_post_format == 'image') {
						blogosphere_post_type_image(get_the_ID(), $cmsmasters_post_image_link, 'cmsmasters-full-masonry-thumb');
					} elseif ($cmsmasters_post_format == 'gallery') {
						blogosphere_post_type_slider(get_the_ID(), $cmsmasters_post_images, 'post-thumbnail');
					} elseif ($cmsmasters_post_format == '' && !post_password_required() && has_post_thumbnail()) {
						blogosphere_thumb(get_the_ID(), 'post-thumbnail', true, false, false, false, false, true, false);
					} elseif ($cmsmasters_post_format == 'video') {
						blogosphere_post_type_video(get_the_ID(), $cmsmasters_post_video_type, $cmsmasters_post_video_link, $cmsmasters_post_video_links);
					}
				
				echo '</div>';
			}
			
			
			if ($cmsmasters_post_format == 'audio') {
				$cmsmasters_post_audio_links = get_post_meta(get_the_ID(), 'cmsmasters_post_audio_links', true);
				
				blogosphere_post_type_audio($cmsmasters_post_audio_links);
			} 
			
			
			blogosphere_post_exc_cont(100);
			
			
			if ($more) {
				echo '<footer class="cmsmasters_post_footer entry-meta">';
					
					$more ? blogosphere_post_more(get_the_ID()) : '';
					
				echo '</footer>';
			}
			?>
		</div>
	</div>
</article>
<!-- Finish Post Default Article -->

