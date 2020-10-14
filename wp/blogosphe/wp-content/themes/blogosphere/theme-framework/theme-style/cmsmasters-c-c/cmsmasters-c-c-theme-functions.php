<?php
/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version 	1.0.1
 * 
 * Theme Content Composer Functions
 * Created by CMSMasters
 * 
 */


/* Register JS Scripts */
function blogosphere_theme_register_c_c_scripts() {
	global $pagenow;
	
	
	if ( 
		$pagenow == 'post-new.php' || 
		($pagenow == 'post.php' && isset($_GET['post']) && get_post_type($_GET['post']) != 'attachment') 
	) {
		wp_enqueue_script('blogosphere-composer-shortcodes-extend', get_template_directory_uri() . '/theme-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/cmsmasters-c-c/js/cmsmasters-c-c-theme-extend.js', array('cmsmasters_composer_shortcodes_js'), '1.0.0', true);
		
		wp_localize_script('blogosphere-composer-shortcodes-extend', 'cmsmasters_theme_shortcodes', array( 
			/* Blog */
			'blog_field_layout_mode_puzzle' => 		esc_attr__('Puzzle', 'blogosphere'), 
			'blog_field_layout_mode_side' => 		esc_attr__('Side', 'blogosphere'), 
			'puzzle_layout_choice_one' => 			esc_attr__('One per row (fullwidth)', 'blogosphere'), 
			'puzzle_layout_choice_three' => 		esc_attr__('Three per row', 'blogosphere'), 
			'puzzle_layout_choice_four' => 			esc_attr__('Four per row', 'blogosphere'), 
			'choice_views' => 						esc_attr__('Views', 'blogosphere') 
		));
	}
}

add_action('admin_enqueue_scripts', 'blogosphere_theme_register_c_c_scripts');



// Quotes Shortcode Attributes Filter
add_filter('cmsmasters_blog_atts_filter', 'cmsmasters_blog_atts');

function cmsmasters_blog_atts() {
	return array( 
		'shortcode_id' => 		'', 
		'orderby' => 			'date', 
		'order' => 				'DESC', 
		'count' => 				'1000', 
		'categories' => 		'', 
		'layout' => 			'standard', 
		'layout_mode' => 		'', 
		'columns' => 			'', 
		'puzzle_columns' => 	'', 
		'metadata' => 			'', 
		'filter' => 			'', 
		'filter_text' => 		'', 
		'filter_cats_text' => 	'', 
		'pagination' => 		'pagination', 
		'more_text' => 			'', 
		'classes' => 			'' 
	);
}

