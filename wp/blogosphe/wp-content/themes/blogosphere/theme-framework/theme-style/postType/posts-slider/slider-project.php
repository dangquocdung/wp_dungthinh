<?php
/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version		1.0.2
 * 
 * Posts Slider Project Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_metadata = explode(',', $cmsmasters_project_metadata);


$title = in_array('title', $cmsmasters_metadata) ? true : false;
$excerpt = (in_array('excerpt', $cmsmasters_metadata) && blogosphere_slider_post_check_exc_cont('project')) ? true : false;
$categories = (get_the_terms(get_the_ID(), 'pj-categs') && in_array('categories', $cmsmasters_metadata)) ? true : false;
$comments = (comments_open() && in_array('comments', $cmsmasters_metadata)) ? true : false;
$likes = in_array('likes', $cmsmasters_metadata) ? true : false;
$views = in_array('views', $cmsmasters_metadata) ? true : false;
$rollover = in_array('rollover', $cmsmasters_metadata) ? true : false;


$cmsmasters_project_link_url = get_post_meta(get_the_ID(), 'cmsmasters_project_link_url', true);
$cmsmasters_project_link_redirect = get_post_meta(get_the_ID(), 'cmsmasters_project_link_redirect', true);
$cmsmasters_project_link_target = get_post_meta(get_the_ID(), 'cmsmasters_project_link_target', true);


$cmsmasters_post_format = get_post_format();

?>
<!-- Start Posts Slider Project Article -->
<article id="post-<?php the_ID(); ?>" <?php post_class('cmsmasters_slider_project'); ?>>
	<div class="cmsmasters_slider_project_outer">
	<?php 		
		if ($categories || $title || $excerpt || $likes || $comments || $views) {
			echo '<div class="cmsmasters_slider_project_inner">';
				
				
				if ($categories) {
					echo '<div class="cmsmasters_slider_project_cont_info entry-meta">';
						
						blogosphere_get_slider_post_category(get_the_ID(), 'pj-categs', 'project');
						
					echo '</div>';
				}
				
				
				$title ? blogosphere_slider_post_heading(get_the_ID(), 'project', 'h4', $cmsmasters_project_link_redirect, $cmsmasters_project_link_url, true, $cmsmasters_project_link_target) : '';
				
				
				blogosphere_thumb_rollover(get_the_ID(), 'cmsmasters-project-thumb', false, $rollover, false, false, false, false, false, false, true, $cmsmasters_project_link_redirect, $cmsmasters_project_link_url, $cmsmasters_project_link_target);
				
				
				$excerpt ? blogosphere_slider_post_exc_cont('project') : '';
				
				
				if ($likes || $comments || $views) {
					echo '<footer class="cmsmasters_slider_project_footer entry-meta">';
						
						($likes) ? blogosphere_slider_post_like('project') : '';
						
						($comments) ? blogosphere_get_slider_post_comments('project') : '';
						
						($views) ? blogosphere_slider_post_views('project') : '';
						
					echo '</footer>';
				}
				
				
			echo '</div>';
		}
	?>
	</div>
</article>
<!-- Finish Posts Slider Project Article -->

