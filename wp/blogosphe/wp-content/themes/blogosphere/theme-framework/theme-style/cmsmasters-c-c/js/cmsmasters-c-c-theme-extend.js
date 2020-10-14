/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version		1.0.1
 * 
 * Theme Content Composer Schortcodes Extend
 * Created by CMSMasters
 * 
 */



/**
 * Removal Shortcode Progress Bar
 */

var shortcodes_new_fields = {};


for (var id in cmsmastersShortcodes) {
	if (id === 'cmsmasters_stats') {
		delete cmsmastersShortcodes[id];
	} else {
		shortcodes_new_fields[id] = cmsmastersShortcodes[id];
	}
}


cmsmastersShortcodes = shortcodes_new_fields;



/**
 * Posts Slider Extend
 */

var posts_slider_new_fields = {};


for (var id in cmsmastersShortcodes.cmsmasters_posts_slider.fields) {
	if (id === 'amount') {
		delete cmsmastersShortcodes.cmsmasters_posts_slider.fields[id];
	} else if (id === 'blog_metadata') {
		cmsmastersShortcodes.cmsmasters_posts_slider.fields[id]['choises'] = {
			'title' : 		cmsmasters_shortcodes.choice_title, 
			'excerpt' : 	cmsmasters_shortcodes.choice_excerpt, 
			'date' : 		cmsmasters_shortcodes.choice_date, 
			'categories' : 	cmsmasters_shortcodes.choice_categories, 
			'author' : 		cmsmasters_shortcodes.choice_author, 
			'comments' : 	cmsmasters_shortcodes.choice_comments, 
			'likes' : 		cmsmasters_shortcodes.choice_likes, 
			'views' : 		cmsmasters_theme_shortcodes.choice_views, 
			'more' : 		cmsmasters_shortcodes.choice_more 
		};
		
		
		posts_slider_new_fields[id] = cmsmastersShortcodes.cmsmasters_posts_slider.fields[id];
	} else if (id === 'portfolio_metadata') {
		cmsmastersShortcodes.cmsmasters_posts_slider.fields[id]['choises'] = {
			'title' : 		cmsmasters_shortcodes.choice_title, 
			'categories' : 	cmsmasters_shortcodes.choice_categories, 
			'comments' : 	cmsmasters_shortcodes.choice_comments, 
			'likes' : 		cmsmasters_shortcodes.choice_likes, 
			'views' : 		cmsmasters_theme_shortcodes.choice_views, 
			'rollover' : 	cmsmasters_shortcodes.choice_rollover 
		};
		
		posts_slider_new_fields[id] = cmsmastersShortcodes.cmsmasters_posts_slider.fields[id];
	} else if (id === 'columns') {
		delete cmsmastersShortcodes.cmsmasters_posts_slider.fields[id]['depend'];
		
		posts_slider_new_fields[id] = cmsmastersShortcodes.cmsmasters_posts_slider.fields[id];
	} else {
		posts_slider_new_fields[id] = cmsmastersShortcodes.cmsmasters_posts_slider.fields[id];
	}
}


cmsmastersShortcodes.cmsmasters_posts_slider.fields = posts_slider_new_fields;



/**
 * Portfolio Extend
 */

var portfolio_new_fields = {};


for (var id in cmsmastersShortcodes.cmsmasters_portfolio.fields) {
	if (id === 'filter_text') { 
		delete cmsmastersShortcodes.cmsmasters_portfolio.fields[id];
	} else if (id === 'metadata_grid') {
		cmsmastersShortcodes.cmsmasters_portfolio.fields[id]['choises'] = {
			'title' : 		cmsmasters_shortcodes.choice_title, 
			'categories' : 	cmsmasters_shortcodes.choice_categories, 
			'excerpt' : 	cmsmasters_shortcodes.choice_excerpt, 
			'comments' : 	cmsmasters_shortcodes.choice_comments, 
			'likes' : 		cmsmasters_shortcodes.choice_likes, 
			'views' : 		cmsmasters_theme_shortcodes.choice_views, 
			'rollover' : 	cmsmasters_shortcodes.choice_rollover 
		};
		
		
		portfolio_new_fields[id] = cmsmastersShortcodes.cmsmasters_portfolio.fields[id];
	} else if (id === 'metadata_puzzle') {
		cmsmastersShortcodes.cmsmasters_portfolio.fields[id]['choises'] = {
			'title' : 		cmsmasters_shortcodes.choice_title, 
			'categories' : 	cmsmasters_shortcodes.choice_categories, 
			'likes' : 		cmsmasters_shortcodes.choice_likes, 
			'views' : 		cmsmasters_theme_shortcodes.choice_views, 
			'comments' : 	cmsmasters_shortcodes.choice_comments 
		};
		
		portfolio_new_fields[id] = cmsmastersShortcodes.cmsmasters_portfolio.fields[id];
	} else {
		portfolio_new_fields[id] = cmsmastersShortcodes.cmsmasters_portfolio.fields[id];
	}
}


cmsmastersShortcodes.cmsmasters_portfolio.fields = portfolio_new_fields;



/**
 * Blog Extend
 */

var blog_new_fields = {};


for (var id in cmsmastersShortcodes.cmsmasters_blog.fields) {
	if (id === 'layout') {
		cmsmastersShortcodes.cmsmasters_blog.fields[id]['choises']['side'] = cmsmasters_theme_shortcodes.blog_field_layout_mode_side;
		
		cmsmastersShortcodes.cmsmasters_blog.fields[id]['choises']['puzzle'] = cmsmasters_theme_shortcodes.blog_field_layout_mode_puzzle;
		
		blog_new_fields[id] = cmsmastersShortcodes.cmsmasters_blog.fields[id];
		
		blog_new_fields['puzzle_columns'] = { 
			type : 		'select', 
			title : 	cmsmasters_shortcodes.columns_count, 
			descr : 	cmsmasters_shortcodes.blog_field_columns_count_descr + "<br /><span>" + cmsmasters_shortcodes.note + ' ' + cmsmasters_shortcodes.blog_field_columns_count_descr_note + "</span>",  
			def : 		'3', 
			required : 	false, 
			width : 	'half', 
			choises : { 
						'2' : 	cmsmasters_theme_shortcodes.puzzle_layout_choice_one, 
						'3' : 	cmsmasters_theme_shortcodes.puzzle_layout_choice_three, 
						'4' : 	cmsmasters_theme_shortcodes.puzzle_layout_choice_four 
			}, 
			depend : 	'layout:puzzle' 
		};
		
	} else if (id === 'metadata') {
		cmsmastersShortcodes.cmsmasters_blog.fields[id]['choises'] = {
			'date' : 		cmsmasters_shortcodes.choice_date, 
			'categories' : 	cmsmasters_shortcodes.choice_categories, 
			'author' : 		cmsmasters_shortcodes.choice_author, 
			'comments' : 	cmsmasters_shortcodes.choice_comments, 
			'likes' : 		cmsmasters_shortcodes.choice_likes, 
			'views' : 		cmsmasters_theme_shortcodes.choice_views, 
			'more' : 		cmsmasters_shortcodes.choice_more 
		};
		
		
		blog_new_fields[id] = cmsmastersShortcodes.cmsmasters_blog.fields[id];
	} else {
		blog_new_fields[id] = cmsmastersShortcodes.cmsmasters_blog.fields[id];
	}
}


cmsmastersShortcodes.cmsmasters_blog.fields = blog_new_fields;

var blog_new_fields = {};


for (var id in cmsmastersShortcodes.cmsmasters_blog.fields) {
	if (id === 'filter_text') {
		delete cmsmastersShortcodes.cmsmasters_blog.fields[id];
	} else {
		blog_new_fields[id] = cmsmastersShortcodes.cmsmasters_blog.fields[id];
	}
}


cmsmastersShortcodes.cmsmasters_blog.fields = blog_new_fields;