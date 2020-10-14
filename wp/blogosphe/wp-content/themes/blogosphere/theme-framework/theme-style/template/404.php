<?php
/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version 	1.0.2
 * 
 * 404 Error Page Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_option = blogosphere_get_global_options();

?>

</div>

<!-- Start Content -->
<div class="entry">
	<div class="error">
		<div class="error_bg">
			<div class="error_inner">
				<h1 class="error_title"><?php echo esc_html__('404', 'blogosphere'); ?></h1>
				<h2 class="error_subtitle"><?php echo esc_html__("We're sorry, but the page you were looking for doesn't exist.", 'blogosphere'); ?></h2>
				<div class="error_cont">
					<?php 
					if ($cmsmasters_option['blogosphere' . '_error_search']) { 
						get_search_form(); 
					}
					
					
					if ($cmsmasters_option['blogosphere' . '_error_sitemap_button'] && $cmsmasters_option['blogosphere' . '_error_sitemap_link'] != '') {
						echo '<div class="error_button_wrap"><a href="' . esc_url($cmsmasters_option['blogosphere' . '_error_sitemap_link']) . '" class="error_button">' . esc_html__('Sitemap', 'blogosphere') . '</a></div>';
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="content_wrap fullwidth">
<!-- Finish Content -->