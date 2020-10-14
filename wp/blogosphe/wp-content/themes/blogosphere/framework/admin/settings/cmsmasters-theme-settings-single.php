<?php 
/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version		1.0.0
 * 
 * Admin Panel Post, Project, Profile Settings
 * Created by CMSMasters
 * 
 */


function blogosphere_options_single_tabs() {
	$tabs = array();
	
	
	$tabs['post'] = esc_attr__('Post', 'blogosphere');
	
	if (CMSMASTERS_PROJECT_COMPATIBLE && class_exists('Cmsmasters_Projects')) {
		$tabs['project'] = esc_attr__('Project', 'blogosphere');
	}
	
	if (CMSMASTERS_PROFILE_COMPATIBLE && class_exists('Cmsmasters_Profiles')) {
		$tabs['profile'] = esc_attr__('Profile', 'blogosphere');
	}
	
	
	return apply_filters('cmsmasters_options_single_tabs_filter', $tabs);
}


function blogosphere_options_single_sections() {
	$tab = blogosphere_get_the_tab();
	
	
	switch ($tab) {
	case 'post':
		$sections = array();
		
		$sections['post_section'] = esc_attr__('Blog Post Options', 'blogosphere');
		
		
		break;
	case 'project':
		$sections = array();
		
		$sections['project_section'] = esc_attr__('Portfolio Project Options', 'blogosphere');
		
		
		break;
	case 'profile':
		$sections = array();
		
		$sections['profile_section'] = esc_attr__('Person Block Profile Options', 'blogosphere');
		
		
		break;
	default:
		$sections = array();
		
		
		break;
	}
	
	
	return apply_filters('cmsmasters_options_single_sections_filter', $sections, $tab);
} 


function blogosphere_options_single_fields($set_tab = false) {
	if ($set_tab) {
		$tab = $set_tab;
	} else {
		$tab = blogosphere_get_the_tab();
	}
	
	
	$options = array();
	
	
	$defaults = blogosphere_settings_single_defaults();
	
	
	switch ($tab) {
	case 'post':
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'blogosphere' . '_blog_post_layout', 
			'title' => esc_html__('Layout Type', 'blogosphere'), 
			'desc' => '', 
			'type' => 'radio_img', 
			'std' => $defaults[$tab]['blogosphere' . '_blog_post_layout'], 
			'choices' => array( 
				esc_html__('Right Sidebar', 'blogosphere') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg' . '|r_sidebar', 
				esc_html__('Left Sidebar', 'blogosphere') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg' . '|l_sidebar', 
				esc_html__('Full Width', 'blogosphere') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg' . '|fullwidth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'blogosphere' . '_blog_post_title', 
			'title' => esc_html__('Post Title', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_blog_post_title'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'blogosphere' . '_blog_post_date', 
			'title' => esc_html__('Post Date', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_blog_post_date'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'blogosphere' . '_blog_post_cat', 
			'title' => esc_html__('Post Categories', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_blog_post_cat'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'blogosphere' . '_blog_post_author', 
			'title' => esc_html__('Post Author', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_blog_post_author'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'blogosphere' . '_blog_post_comment', 
			'title' => esc_html__('Post Comments', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_blog_post_comment'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'blogosphere' . '_blog_post_tag', 
			'title' => esc_html__('Post Tags', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_blog_post_tag'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'blogosphere' . '_blog_post_like', 
			'title' => esc_html__('Post Likes', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_blog_post_like'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'blogosphere' . '_blog_post_nav_box', 
			'title' => esc_html__('Posts Navigation Box', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_blog_post_nav_box'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'blogosphere' . '_blog_post_nav_order_cat', 
			'title' => esc_html__('Posts Navigation Order by Category', 'blogosphere'), 
			'desc' => esc_html__('enable', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_blog_post_nav_order_cat'] 
		);
		
		if (class_exists('Cmsmasters_Content_Composer')) {
			$options[] = array( 
				'section' => 'post_section', 
				'id' => 'blogosphere' . '_blog_post_share_box', 
				'title' => esc_html__('Sharing Box', 'blogosphere'), 
				'desc' => esc_html__('show', 'blogosphere'), 
				'type' => 'checkbox', 
				'std' => $defaults[$tab]['blogosphere' . '_blog_post_share_box'] 
			);
		}
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'blogosphere' . '_blog_post_author_box', 
			'title' => esc_html__('About Author Box', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_blog_post_author_box'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'blogosphere' . '_blog_more_posts_box', 
			'title' => esc_html__('More Posts Box', 'blogosphere'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => $defaults[$tab]['blogosphere' . '_blog_more_posts_box'], 
			'choices' => array( 
				esc_html__('Show Related Posts', 'blogosphere') . '|related', 
				esc_html__('Show Popular Posts', 'blogosphere') . '|popular', 
				esc_html__('Show Recent Posts', 'blogosphere') . '|recent', 
				esc_html__('Hide More Posts Box', 'blogosphere') . '|hide' 
			) 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'blogosphere' . '_blog_more_posts_count', 
			'title' => esc_html__('More Posts Box Items Number', 'blogosphere'), 
			'desc' => esc_html__('posts', 'blogosphere'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['blogosphere' . '_blog_more_posts_count'], 
			'min' => '2', 
			'max' => '20' 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'blogosphere' . '_blog_more_posts_pause', 
			'title' => esc_html__('More Posts Slider Pause Time', 'blogosphere'), 
			'desc' => esc_html__("in seconds, if '0' - autoslide disabled", 'blogosphere'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['blogosphere' . '_blog_more_posts_pause'], 
			'min' => '0', 
			'max' => '20' 
		);
		
		
		break;
	case 'project':
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'blogosphere' . '_portfolio_project_title', 
			'title' => esc_html__('Project Title', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_portfolio_project_title'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'blogosphere' . '_portfolio_project_details_title', 
			'title' => esc_html__('Project Details Title', 'blogosphere'), 
			'desc' => esc_html__('Enter a project details block title', 'blogosphere'), 
			'type' => 'text', 
			'std' => $defaults[$tab]['blogosphere' . '_portfolio_project_details_title'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'blogosphere' . '_portfolio_project_date', 
			'title' => esc_html__('Project Date', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_portfolio_project_date'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'blogosphere' . '_portfolio_project_cat', 
			'title' => esc_html__('Project Categories', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_portfolio_project_cat'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'blogosphere' . '_portfolio_project_author', 
			'title' => esc_html__('Project Author', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_portfolio_project_author'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'blogosphere' . '_portfolio_project_comment', 
			'title' => esc_html__('Project Comments', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_portfolio_project_comment'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'blogosphere' . '_portfolio_project_tag', 
			'title' => esc_html__('Project Tags', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_portfolio_project_tag'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'blogosphere' . '_portfolio_project_like', 
			'title' => esc_html__('Project Likes', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_portfolio_project_like'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'blogosphere' . '_portfolio_project_link', 
			'title' => esc_html__('Project Link', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_portfolio_project_link'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'blogosphere' . '_portfolio_project_share_box', 
			'title' => esc_html__('Sharing Box', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_portfolio_project_share_box'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'blogosphere' . '_portfolio_project_nav_box', 
			'title' => esc_html__('Projects Navigation Box', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_portfolio_project_nav_box'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'blogosphere' . '_portfolio_project_nav_order_cat', 
			'title' => esc_html__('Projects Navigation Order by Category', 'blogosphere'), 
			'desc' => esc_html__('enable', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_portfolio_project_nav_order_cat'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'blogosphere' . '_portfolio_project_author_box', 
			'title' => esc_html__('About Author Box', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_portfolio_project_author_box'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'blogosphere' . '_portfolio_more_projects_box', 
			'title' => esc_html__('More Projects Box', 'blogosphere'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => $defaults[$tab]['blogosphere' . '_portfolio_more_projects_box'], 
			'choices' => array( 
				esc_html__('Show Related Projects', 'blogosphere') . '|related', 
				esc_html__('Show Popular Projects', 'blogosphere') . '|popular', 
				esc_html__('Show Recent Projects', 'blogosphere') . '|recent', 
				esc_html__('Hide More Projects Box', 'blogosphere') . '|hide' 
			) 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'blogosphere' . '_portfolio_more_projects_count', 
			'title' => esc_html__('More Projects Box Items Number', 'blogosphere'), 
			'desc' => esc_html__('projects', 'blogosphere'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['blogosphere' . '_portfolio_more_projects_count'], 
			'min' => '2', 
			'max' => '20' 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'blogosphere' . '_portfolio_more_projects_pause', 
			'title' => esc_html__('More Projects Slider Pause Time', 'blogosphere'), 
			'desc' => esc_html__("in seconds, if '0' - autoslide disabled", 'blogosphere'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['blogosphere' . '_portfolio_more_projects_pause'], 
			'min' => '0', 
			'max' => '20' 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'blogosphere' . '_portfolio_project_slug', 
			'title' => esc_html__('Project Slug', 'blogosphere'), 
			'desc' => esc_html__('Enter a page slug that should be used for your projects single item', 'blogosphere'), 
			'type' => 'text', 
			'std' => $defaults[$tab]['blogosphere' . '_portfolio_project_slug'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'blogosphere' . '_portfolio_pj_categs_slug', 
			'title' => esc_html__('Project Categories Slug', 'blogosphere'), 
			'desc' => esc_html__('Enter page slug that should be used on projects categories archive page', 'blogosphere'), 
			'type' => 'text', 
			'std' => $defaults[$tab]['blogosphere' . '_portfolio_pj_categs_slug'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'blogosphere' . '_portfolio_pj_tags_slug', 
			'title' => esc_html__('Project Tags Slug', 'blogosphere'), 
			'desc' => esc_html__('Enter page slug that should be used on projects tags archive page', 'blogosphere'), 
			'type' => 'text', 
			'std' => $defaults[$tab]['blogosphere' . '_portfolio_pj_tags_slug'], 
			'class' => '' 
		);
		
		
		break;
	case 'profile':
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'blogosphere' . '_profile_post_title', 
			'title' => esc_html__('Profile Title', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_profile_post_title'] 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'blogosphere' . '_profile_post_details_title', 
			'title' => esc_html__('Profile Details Title', 'blogosphere'), 
			'desc' => esc_html__('Enter a profile details block title', 'blogosphere'), 
			'type' => 'text', 
			'std' => $defaults[$tab]['blogosphere' . '_profile_post_details_title'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'blogosphere' . '_profile_post_cat', 
			'title' => esc_html__('Profile Categories', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_profile_post_cat'] 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'blogosphere' . '_profile_post_comment', 
			'title' => esc_html__('Profile Comments', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_profile_post_comment'] 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'blogosphere' . '_profile_post_like', 
			'title' => esc_html__('Profile Likes', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_profile_post_like'] 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'blogosphere' . '_profile_post_nav_box', 
			'title' => esc_html__('Profiles Navigation Box', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_profile_post_nav_box'] 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'blogosphere' . '_profile_post_nav_order_cat', 
			'title' => esc_html__('Profiles Navigation Order by Category', 'blogosphere'), 
			'desc' => esc_html__('enable', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_profile_post_nav_order_cat'] 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'blogosphere' . '_profile_post_share_box', 
			'title' => esc_html__('Sharing Box', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_profile_post_share_box'] 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'blogosphere' . '_profile_post_slug', 
			'title' => esc_html__('Profile Slug', 'blogosphere'), 
			'desc' => esc_html__('Enter a page slug that should be used for your profiles single item', 'blogosphere'), 
			'type' => 'text', 
			'std' => $defaults[$tab]['blogosphere' . '_profile_post_slug'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'blogosphere' . '_profile_pl_categs_slug', 
			'title' => esc_html__('Profile Categories Slug', 'blogosphere'), 
			'desc' => esc_html__('Enter page slug that should be used on profiles categories archive page', 'blogosphere'), 
			'type' => 'text', 
			'std' => $defaults[$tab]['blogosphere' . '_profile_pl_categs_slug'], 
			'class' => '' 
		);
		
		
		break;
	}
	
	
	return apply_filters('cmsmasters_options_single_fields_filter', $options, $tab);
}

