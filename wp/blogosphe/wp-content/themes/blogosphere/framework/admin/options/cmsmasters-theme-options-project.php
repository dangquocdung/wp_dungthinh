<?php 
/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version 	1.0.4
 * 
 * Project Options Functions
 * Created by CMSMasters
 * 
 */


if (!function_exists('blogosphere_get_custom_project_meta_fields')) {
function blogosphere_get_custom_project_meta_fields() {
	$cmsmasters_option = blogosphere_get_global_options();
	
	
	$cmsmasters_global_bottom_sidebar = (isset($cmsmasters_option['blogosphere' . '_bottom_sidebar']) && $cmsmasters_option['blogosphere' . '_bottom_sidebar'] !== '') ? (($cmsmasters_option['blogosphere' . '_bottom_sidebar'] == 1) ? 'true' : 'false') : 'true';
	
	$cmsmasters_global_bottom_sidebar_layout = (isset($cmsmasters_option['blogosphere' . '_bottom_sidebar_layout'])) ? $cmsmasters_option['blogosphere' . '_bottom_sidebar_layout'] : '14141414';
	
	$cmsmasters_global_bg = (isset($cmsmasters_option['blogosphere' . '_theme_layout']) && $cmsmasters_option['blogosphere' . '_theme_layout'] === 'boxed') ? true : false;
	
	
	$cmsmasters_global_portfolio_project_title = (isset($cmsmasters_option['blogosphere' . '_portfolio_project_title']) && $cmsmasters_option['blogosphere' . '_portfolio_project_title'] !== '') ? (($cmsmasters_option['blogosphere' . '_portfolio_project_title'] == 1) ? 'true' : 'false') : 'true';
	
	$cmsmasters_global_portfolio_project_details_title = (isset($cmsmasters_option['blogosphere' . '_portfolio_project_details_title']) && $cmsmasters_option['blogosphere' . '_portfolio_project_details_title'] !== '') ? $cmsmasters_option['blogosphere' . '_portfolio_project_details_title'] : '';
	
	$cmsmasters_global_portfolio_project_share_box = (isset($cmsmasters_option['blogosphere' . '_portfolio_project_share_box']) && $cmsmasters_option['blogosphere' . '_portfolio_project_share_box'] !== '') ? (($cmsmasters_option['blogosphere' . '_portfolio_project_share_box'] == 1) ? 'true' : 'false') : 'true';
	
	$cmsmasters_global_portfolio_project_author_box = (isset($cmsmasters_option['blogosphere' . '_portfolio_project_author_box']) && $cmsmasters_option['blogosphere' . '_portfolio_project_author_box'] !== '') ? (($cmsmasters_option['blogosphere' . '_portfolio_project_author_box'] == 1) ? 'true' : 'false') : 'true';
	
	$cmsmasters_global_portfolio_more_projects_box = (isset($cmsmasters_option['blogosphere' . '_portfolio_more_projects_box'])) ? $cmsmasters_option['blogosphere' . '_portfolio_more_projects_box'] : 'related';
	
	$cmsmasters_proportion = blogosphere_project_puzzle_proportion();
	
	
	$cmsmasters_option_name = 'cmsmasters_project_';
	
	
	$tabs_array = array();
	
	
	$tabs_array['cmsmasters_project'] = array( 
		'label' => esc_html__('Project', 'blogosphere'), 
		'value'	=> 'cmsmasters_project' 
	);
	
	
	$tabs_array['cmsmasters_layout'] = array( 
		'label' => esc_html__('Layout', 'blogosphere'), 
		'value'	=> 'cmsmasters_layout' 
	);
	
	
	if ($cmsmasters_global_bg) {
		$tabs_array['cmsmasters_bg'] = array( 
			'label' => esc_html__('Background', 'blogosphere'), 
			'value'	=> 'cmsmasters_bg' 
		);
	}
	
	
	$tabs_array['cmsmasters_heading'] = array( 
		'label' => esc_html__('Heading', 'blogosphere'), 
		'value'	=> 'cmsmasters_heading' 
	);
	
	
	$custom_project_meta_fields = array( 
		array( 
			'id'	=> 'cmsmasters_project_images', 
			'type'	=> 'content_start', 
			'box'	=> 'true', 
			'hide'	=> 'true' 
		), 
		array( 
			'label'	=> esc_html__('Project Images', 'blogosphere'), 
			'desc'	=> '', 
			'id'	=> $cmsmasters_option_name . 'images', 
			'type'	=> 'images_list', 
			'hide'	=> '', 
			'std'	=> '', 
			'frame' => 'post', 
			'multiple' => true 
		), 
		array( 
			'label'	=> esc_html__('Don\'t Show Featured Image in Open Project', 'blogosphere'), 
			'desc'	=> esc_html__('Don\'t Show', 'blogosphere'), 
			'id'	=> $cmsmasters_option_name . 'image_show', 
			'type'	=> 'checkbox', 
			'hide'	=> '', 
			'std'	=> 'false' 
		), 
		array( 
			'label'	=> esc_html__('Number of Columns', 'blogosphere'), 
			'desc'	=> '', 
			'id'	=> $cmsmasters_option_name . 'columns', 
			'type'	=> 'radio', 
			'hide'	=> 'true', 
			'std'	=> 'three', 
			'options' => array( 
				'three' => array( 
					'label' => esc_html__('Three', 'blogosphere'), 
					'value'	=> 'three' 
				), 
				'two' => array( 
					'label' => esc_html__('Two', 'blogosphere'), 
					'value'	=> 'two' 
				), 
				'one' => array( 
					'label' => esc_html__('One', 'blogosphere'), 
					'value'	=> 'one' 
				) 
			) 
		),
		array( 
			'id'	=> 'cmsmasters_project_images', 
			'type'	=> 'content_finish' 
		), 
		array( 
			'id'	=> 'cmsmasters_project_video', 
			'type'	=> 'content_start', 
			'box'	=> 'true', 
			'hide'	=> 'true' 
		), 
		array( 
			'label'	=> esc_html__('Video Type', 'blogosphere'), 
			'desc'	=> '', 
			'id'	=> $cmsmasters_option_name . 'video_type', 
			'type'	=> 'radio', 
			'hide'	=> '', 
			'std'	=> 'embedded', 
			'options' => array( 
				'embedded' => array( 
					'label' => esc_html__('Embedded (YouTube, Vimeo)', 'blogosphere'), 
					'value'	=> 'embedded' 
				), 
				'selfhosted' => array( 
					'label' => esc_html__('Self-Hosted', 'blogosphere'), 
					'value'	=> 'selfhosted' 
				) 
			) 
		), 
		array( 
			'label'	=> esc_html__('Embedded Video Link', 'blogosphere'), 
			'desc'	=> '', 
			'id'	=> $cmsmasters_option_name . 'video_link', 
			'type'	=> 'text_long', 
			'hide'	=> 'true', 
			'std'	=> '' 
		), 
		array( 
			'label'	=> esc_html__('Self-Hosted Video Links', 'blogosphere'), 
			'desc'	=> '', 
			'id'	=> $cmsmasters_option_name . 'video_links', 
			'type'	=> 'repeatable', 
			'hide'	=> 'true', 
			'std'	=> '' 
		), 
		array( 
			'id'	=> 'cmsmasters_project_video', 
			'type'	=> 'content_finish' 
		), 
		array( 
			'id'	=> $cmsmasters_option_name . 'tabs', 
			'type'	=> 'tabs', 
			'std'	=> 'cmsmasters_project', 
			'options' => $tabs_array 
		), 
		array( 
			'id'	=> 'cmsmasters_project', 
			'type'	=> 'tab_start', 
			'std'	=> 'true' 
		), 
		array( 
			'label'	=> esc_html__('Project Title', 'blogosphere'), 
			'desc'	=> esc_html__('Show', 'blogosphere'), 
			'id'	=> $cmsmasters_option_name . 'title', 
			'type'	=> 'checkbox', 
			'hide'	=> '', 
			'std'	=> $cmsmasters_global_portfolio_project_title 
		), 
		array( 
			'label'	=> esc_html__('Project Puzzle Image Size', 'blogosphere'), 
			'desc'	=> esc_html__('Recommended Project Puzzle Image dimensions, or other size, with the same ratio:', 'blogosphere') . '</br>', 
			'id'	=> $cmsmasters_option_name . 'size', 
			'type'	=> 'radio_img_pj', 
			'hide'	=> '', 
			'std'	=> 'one_x_one', 
			'options' => array( 
				'one_x_one' => array( 
					'img'	=> get_template_directory_uri() . '/framework/admin/inc/img/one_x_one.jpg', 
					'size' => 'No Gap or 1px Gap - 480 x ' . ((int) (480 * $cmsmasters_proportion)) . '<br />' . 'Large Gap - 480 x ' . ((int) (480 * $cmsmasters_proportion - blogosphere_project_puzzle_large_gar('one_x_one'))), 
					'label' => '1 x 1', 
					'value'	=> 'one_x_one' 
				), 
				'one_x_two' => array( 
					'img'	=> get_template_directory_uri() . '/framework/admin/inc/img/one_x_two.jpg', 
					'size' => 'No Gap or 1px Gap - 480 x ' . ((int) (960 * $cmsmasters_proportion)) . '<br />' . 'Large Gap - 480 x ' . blogosphere_project_puzzle_large_gar('one_x_two'), 
					'label' => '1 x 2', 
					'value'	=> 'one_x_two' 
				), 
				'one_x_three' => array( 
					'img'	=> get_template_directory_uri() . '/framework/admin/inc/img/one_x_three.jpg', 
					'size' => 'No Gap or 1px Gap - 480 x ' . ((int) (1440 * $cmsmasters_proportion)) . '<br />' . 'Large Gap - 480 x ' . blogosphere_project_puzzle_large_gar('one_x_three'), 
					'label' => '1 x 3', 
					'value'	=> 'one_x_three' 
				), 
				'two_x_one' => array( 
					'img'	=> get_template_directory_uri() . '/framework/admin/inc/img/two_x_one.jpg', 
					'size' => 'No Gap or 1px Gap - 960 x ' . ((int) (480 * $cmsmasters_proportion)) . '<br />' . 'Large Gap - 960 x ' . blogosphere_project_puzzle_large_gar('two_x_one'), 
					'label' => '2 x 1', 
					'value'	=> 'two_x_one' 
				), 
				'two_x_two' => array( 
					'img'	=> get_template_directory_uri() . '/framework/admin/inc/img/two_x_two.jpg', 
					'size' => 'No Gap or 1px Gap - 960 x ' . ((int) (960 * $cmsmasters_proportion)) . '<br />' . 'Large Gap - 960 x ' . ((int) (960 * $cmsmasters_proportion - blogosphere_project_puzzle_large_gar('two_x_two'))), 
					'label' => '2 x 2', 
					'value'	=> 'two_x_two' 
				), 
				'two_x_three' => array( 
					'img'	=> get_template_directory_uri() . '/framework/admin/inc/img/two_x_three.jpg', 
					'size' => 'No Gap or 1px Gap - 960 x ' . ((int) (1440 * $cmsmasters_proportion)) . '<br />' . 'Large Gap - 960 x ' . blogosphere_project_puzzle_large_gar('two_x_three'), 
					'label' => '2 x 3', 
					'value'	=> 'two_x_three' 
				), 
				'three_x_one' => array( 
					'img'	=> get_template_directory_uri() . '/framework/admin/inc/img/three_x_one.jpg', 
					'size' => 'No Gap or 1px Gap - 1440 x ' . ((int) (480 * $cmsmasters_proportion)) . '<br />' . 'Large Gap - 1440 x ' . blogosphere_project_puzzle_large_gar('three_x_one'), 
					'label' => '3 x 1', 
					'value'	=> 'three_x_one' 
				), 
				'three_x_two' => array( 
					'img'	=> get_template_directory_uri() . '/framework/admin/inc/img/three_x_two.jpg', 
					'size' => 'No Gap or 1px Gap - 1440 x ' . ((int) (960 * $cmsmasters_proportion)) . '<br />' . 'Large Gap - 1440 x ' . blogosphere_project_puzzle_large_gar('three_x_two'), 
					'label' => '3 x 2', 
					'value'	=> 'three_x_two' 
				), 
				'three_x_three' => array( 
					'img'	=> get_template_directory_uri() . '/framework/admin/inc/img/three_x_three.jpg', 
					'size' => 'No Gap or 1px Gap - 1440 x ' . ((int) (1440 * $cmsmasters_proportion)) . '<br />' . 'Large Gap - 1440 x ' . ((int) (1440 * $cmsmasters_proportion - blogosphere_project_puzzle_large_gar('three_x_three'))), 
					'label' => '3 x 3', 
					'value'	=> 'three_x_three' 
				), 
				'four_x_four' => array( 
					'img'	=> get_template_directory_uri() . '/framework/admin/inc/img/four_x_four.jpg', 
					'size' => 'No Gap or 1px Gap - 1920 x ' . ((int) (1920 * $cmsmasters_proportion)) . '<br />' . 'Large Gap - 1920 x ' . ((int) (1920 * $cmsmasters_proportion - blogosphere_project_puzzle_large_gar('four_x_four'))), 
					'label' => '4 x 4', 
					'value'	=> 'four_x_four' 
				) 
			) 
		), 
		array( 
			'label'	=> esc_html__('Project Puzzle Image (1px or No Gap)', 'blogosphere'), 
			'desc'	=> esc_html__('Choose image for Masonry Puzzle portfolio projects 1px or no gap', 'blogosphere'), 
			'id'	=> $cmsmasters_option_name . 'puzzle_image', 
			'type'	=> 'image', 
			'hide'	=> '', 
			'cancel' => 'true', 
			'std'	=> '', 
			'frame' => 'select', 
			'multiple' => false 
		), 
		array( 
			'label'	=> esc_html__('Project Puzzle Image (Large Gap)', 'blogosphere'), 
			'desc'	=> esc_html__('Choose image for Masonry Puzzle portfolio projects large gap', 'blogosphere'), 
			'id'	=> $cmsmasters_option_name . 'puzzle_large_gap_image', 
			'type'	=> 'image', 
			'hide'	=> '', 
			'cancel' => 'true', 
			'std'	=> '', 
			'frame' => 'select', 
			'multiple' => false 
		), 
		array( 
			'label'	=> esc_html__('Project Details Title', 'blogosphere'), 
			'desc'	=> '', 
			'id'	=> $cmsmasters_option_name . 'details_title', 
			'type'	=> 'text_long', 
			'hide'	=> '', 
			'std'	=> $cmsmasters_global_portfolio_project_details_title 
		), 
		array( 
			'label'	=> esc_html__('Project Info', 'blogosphere'), 
			'desc'	=> '', 
			'id'	=> $cmsmasters_option_name . 'features', 
			'type'	=> 'repeatable_multiple', 
			'hide'	=> '', 
			'std'	=> '' 
		), 
		array( 
			'label'	=> esc_html__("Project Link Text", 'blogosphere'), 
			'desc'	=> '', 
			'id'	=> $cmsmasters_option_name . 'link_text', 
			'type'	=> 'text', 
			'hide'	=> '', 
			'std'	=> esc_html__('View Project', 'blogosphere') 
		), 
		array( 
			'label'	=> esc_html__("Project Link URL", 'blogosphere'), 
			'desc'	=> '', 
			'id'	=> $cmsmasters_option_name . 'link_url', 
			'type'	=> 'text_long', 
			'hide'	=> '', 
			'std'	=> '' 
		), 
		array( 
			'label'	=> '', 
			'desc'	=> esc_html__('Redirect to project link URL instead of opening project page', 'blogosphere'), 
			'id'	=> $cmsmasters_option_name . 'link_redirect', 
			'type'	=> 'checkbox', 
			'hide'	=> '', 
			'std'	=> 'false' 
		), 
		array( 
			'label'	=> esc_html__("Project Link Target", 'blogosphere'), 
			'desc'	=> esc_html__('Open link in a new tab', 'blogosphere'), 
			'id'	=> $cmsmasters_option_name . 'link_target', 
			'type'	=> 'checkbox', 
			'hide'	=> '', 
			'std'	=> 'false' 
		), 
		array( 
			'label'	=> esc_html__('Project Features 1 Title', 'blogosphere'), 
			'desc'	=> '', 
			'id'	=> $cmsmasters_option_name . 'features_one_title', 
			'type'	=> 'text_long', 
			'hide'	=> '', 
			'std'	=> '' 
		), 
		array( 
			'label'	=> esc_html__('Project Features 1', 'blogosphere'), 
			'desc'	=> '', 
			'id'	=> $cmsmasters_option_name . 'features_one', 
			'type'	=> 'repeatable_multiple', 
			'hide'	=> '', 
			'std'	=> '' 
		), 
		array( 
			'label'	=> esc_html__('Project Features 2 Title', 'blogosphere'), 
			'desc'	=> '', 
			'id'	=> $cmsmasters_option_name . 'features_two_title', 
			'type'	=> 'text_long', 
			'hide'	=> '', 
			'std'	=> '' 
		), 
		array( 
			'label'	=> esc_html__('Project Features 2', 'blogosphere'), 
			'desc'	=> '', 
			'id'	=> $cmsmasters_option_name . 'features_two', 
			'type'	=> 'repeatable_multiple', 
			'hide'	=> '', 
			'std'	=> '' 
		), 
		array( 
			'label'	=> esc_html__('Project Features 3 Title', 'blogosphere'), 
			'desc'	=> '', 
			'id'	=> $cmsmasters_option_name . 'features_three_title', 
			'type'	=> 'text_long', 
			'hide'	=> '', 
			'std'	=> '' 
		), 
		array( 
			'label'	=> esc_html__('Project Features 3', 'blogosphere'), 
			'desc'	=> '', 
			'id'	=> $cmsmasters_option_name . 'features_three', 
			'type'	=> 'repeatable_multiple', 
			'hide'	=> '', 
			'std'	=> '' 
		), 
		array( 
			'label'	=> esc_html__('Sharing Box', 'blogosphere'), 
			'desc'	=> esc_html__('Show', 'blogosphere'), 
			'id'	=> $cmsmasters_option_name . 'sharing_box', 
			'type'	=> 'checkbox', 
			'hide'	=> '', 
			'std'	=> $cmsmasters_global_portfolio_project_share_box 
		), 
		array( 
			'label'	=> esc_html__('About Author Box', 'blogosphere'), 
			'desc'	=> esc_html__('Show', 'blogosphere'), 
			'id'	=> $cmsmasters_option_name . 'author_box', 
			'type'	=> 'checkbox', 
			'hide'	=> '', 
			'std'	=> $cmsmasters_global_portfolio_project_author_box 
		), 
		array( 
			'label'	=> esc_html__('More Posts Box', 'blogosphere'), 
			'desc'	=> '', 
			'id'	=> $cmsmasters_option_name . 'more_posts', 
			'type'	=> 'select', 
			'hide'	=> '', 
			'std'	=> $cmsmasters_global_portfolio_more_projects_box, 
			'options' => array( 
				'related' => array( 
					'label' => esc_html__('Show Related Tab', 'blogosphere'), 
					'value'	=> 'related' 
				), 
				'popular' => array( 
					'label' => esc_html__('Show Popular Tab', 'blogosphere'), 
					'value'	=> 'popular' 
				), 
				'recent' => array( 
					'label' => esc_html__('Show Recent Tab', 'blogosphere'), 
					'value'	=> 'recent' 
				), 
				'hide' => array( 
					'label' => esc_html__('Hide More Posts Box', 'blogosphere'), 
					'value'	=> 'hide' 
				) 
			) 
		), 
		array( 
			'id'	=> 'cmsmasters_project', 
			'type'	=> 'tab_finish' 
		), 
		array( 
			'id'	=> 'cmsmasters_layout', 
			'type'	=> 'tab_start', 
			'std'	=> '' 
		), 
		array( 
			'label'	=> esc_html__('Page Color Scheme', 'blogosphere'), 
			'desc'	=> '', 
			'id'	=> 'cmsmasters_page_scheme', 
			'type'	=> 'select_scheme', 
			'hide'	=> 'false', 
			'std'	=> 'default' 
		), 
		array( 
			'label'	=> esc_html__('Bottom Sidebar', 'blogosphere'), 
			'desc'	=> esc_html__('Show', 'blogosphere'), 
			'id'	=> 'cmsmasters_bottom_sidebar', 
			'type'	=> 'checkbox', 
			'hide'	=> '', 
			'std'	=> $cmsmasters_global_bottom_sidebar 
		), 
		array( 
			'label'	=> esc_html__('Choose Bottom Sidebar', 'blogosphere'), 
			'desc'	=> '', 
			'id'	=> 'cmsmasters_bottom_sidebar_id', 
			'type'	=> 'select_sidebar', 
			'hide'	=> 'true', 
			'std'	=> '' 
		), 
		array( 
			'label'	=> esc_html__('Choose Bottom Sidebar Layout', 'blogosphere'), 
			'desc'	=> '', 
			'id'	=> 'cmsmasters_bottom_sidebar_layout', 
			'type'	=> 'select', 
			'hide'	=> 'true', 
			'std'	=> $cmsmasters_global_bottom_sidebar_layout, 
			'options' => array( 
				'11' => array( 
					'label' => '1/1',
					'value'	=> '11' 
				), 
				'1212' => array( 
					'label' => '1/2 + 1/2',
					'value'	=> '1212' 
				), 
				'1323' => array( 
					'label' => '1/3 + 2/3',
					'value'	=> '1323' 
				), 
				'2313' => array( 
					'label' => '2/3 + 1/3',
					'value'	=> '2313' 
				), 
				'1434' => array( 
					'label' => '1/4 + 3/4',
					'value'	=> '1434' 
				), 
				'3414' => array( 
					'label' => '3/4 + 1/4',
					'value'	=> '3414' 
				), 
				'131313' => array( 
					'label' => '1/3 + 1/3 + 1/3',
					'value'	=> '131313' 
				), 
				'121414' => array( 
					'label' => '1/2 + 1/4 + 1/4',
					'value'	=> '121414' 
				), 
				'141214' => array( 
					'label' => '1/4 + 1/2 + 1/4',
					'value'	=> '141214' 
				), 
				'141412' => array( 
					'label' => '1/4 + 1/4 + 1/2',
					'value'	=> '141412' 
				), 
				'14141414' => array( 
					'label' => '1/4 + 1/4 + 1/4 + 1/4',
					'value'	=> '14141414' 
				) 
			) 
		), 
		array( 
			'id'	=> 'cmsmasters_layout', 
			'type'	=> 'tab_finish' 
		) 
	);
	
	
	return $custom_project_meta_fields;
}
}


/* Project Puzzle Proportion For Large Gap */
if (!function_exists('blogosphere_project_puzzle_large_gar')) {

function blogosphere_project_puzzle_large_gar($image_size = 'default') {
	$padding = '';
	
	$project_puzzle_large_gar_parameter = blogosphere_project_puzzle_large_gar_parameters();
	
	$project_puzzle_proportion = blogosphere_project_puzzle_proportion();
	
	$projectStaticPadding = (($project_puzzle_large_gar_parameter['container_width'] + ($project_puzzle_large_gar_parameter['container_width'] / 100) * $project_puzzle_large_gar_parameter['bottomStaticPadding']) / 100) * $project_puzzle_large_gar_parameter['bottomStaticPadding'];
	
	$portfolio_container_width = $project_puzzle_large_gar_parameter['container_width'] + $projectStaticPadding;
	
	
	if ($image_size == 'three_x_two') {
		$padding = round(((1920 / 4 * 3) / ($portfolio_container_width / 4 * 3 - $projectStaticPadding)) * ($portfolio_container_width / 2 * $project_puzzle_proportion - $projectStaticPadding * $project_puzzle_proportion));
	} elseif ($image_size == 'three_x_one') {
		$padding = round(((1920 / 4 * 3) / ($portfolio_container_width / 4 * 3 - $projectStaticPadding)) * ($portfolio_container_width / 4 * $project_puzzle_proportion - $projectStaticPadding * $project_puzzle_proportion));
	} elseif ($image_size == 'two_x_three') {
		$padding = round(((1920 / 2) / ($portfolio_container_width / 2 - $projectStaticPadding)) * ($portfolio_container_width / 4 * 3 * $project_puzzle_proportion - $projectStaticPadding * $project_puzzle_proportion));
	} elseif ($image_size == 'two_x_one') {
		$padding = round(((1920 / 2) / ($portfolio_container_width / 2 - $projectStaticPadding)) * ($portfolio_container_width / 4 * $project_puzzle_proportion - $projectStaticPadding * $project_puzzle_proportion));
	} elseif ($image_size == 'one_x_three') {
		$padding = round(((1920 / 4) / ($portfolio_container_width / 4 - $projectStaticPadding)) * ($portfolio_container_width / 4 * 3 * $project_puzzle_proportion - $projectStaticPadding * $project_puzzle_proportion));
	} elseif ($image_size == 'one_x_two') {
		$padding = round(((1920 / 4) / ($portfolio_container_width / 4 - $projectStaticPadding)) * ($portfolio_container_width / 2 * $project_puzzle_proportion - $projectStaticPadding * $project_puzzle_proportion));
	} else {
		$padding = '0';
	}
	
	
	return $padding;
}

}


