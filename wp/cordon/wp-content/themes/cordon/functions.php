<?php

		add_action( 'after_setup_theme', 'cordon_theme_setup' );
		function cordon_theme_setup() {
			/* Add filters, actions, and theme-supported features. */
			//THEME SUPORT FUNCTION
			//add thumbnail
			add_theme_support( 'post-thumbnails' );
			//custom background
			add_theme_support( 'custom-background' );
			add_theme_support( 'title-tag' );

			//automatic feed
			add_theme_support( 'automatic-feed-links' );
			//add menu homepage,portfolio and blog
			add_action( 'init', 'cordon_register_menu' );
			add_action( 'init', 'cordon_register_menu_all' );
			// Retrieve the directory for the localization files
			$lang_dir = ( get_template_directory() . '/lang');
			 
			// Set the theme's text domain using the unique identifier from above
			load_theme_textdomain('cordon', $lang_dir);
			
			//width content
			if ( ! isset( $content_width ) )$content_width = 1170;
			
			//theme styles
			//THEME SCRIPT AND STYLES
			//theme default script and styles
			add_action('wp_enqueue_scripts', 'cordon_theme_scripts');
			add_action('wp_enqueue_scripts', 'cordon_theme_styles');
			//color_schecmes script
			add_action( 'wp_enqueue_scripts', 'cordon_color_scheme' );
			//register sidebar
			add_action( 'widgets_init', 'cordon_sidebar' );
			
			
			
			
			
			//CUSTOM FILTER
			//wp title
			add_filter( 'wp_title', 'cordon_wp_title', 10, 2 );
			//custom search setting
			add_filter( 'get_search_form', 'cordon_search_form' );
			//custom excerpt
			add_filter( 'excerpt_length', 'cordon_excerpt_length', 10 );
			//remove [..] in excerpt
			add_filter('get_the_excerpt', 'cordon_trim_excerpt');
			//custom comment styles
			add_filter('comment_form_default_fields','cordon_modify_comment_form_fields');
			//tag cloud filter
			add_filter('wp_generate_tag_cloud', 'cordon_tag_cloud',10,1);
			//preloader script and styles
			add_action( 'wp_enqueue_scripts', 'cordon_preloader_set' );
			add_action( 'wp_enqueue_scripts', 'cordon_preloader' );
			//comment reply
			add_action(  'wp_enqueue_scripts', 'cordon_enqueue_comments_reply' );
			
			//add custom css in editor
			add_action( 'admin_init', 'cordon_add_editor_styles' );
			
			//add image size
			add_image_size( 'cordon-related-post', 500, 300, array( 'center', 'center' ) );
			
			//wp title tag back compat
			if ( ! function_exists( '_wp_render_title_tag' ) ) {
				function cordon_render_title() {
			?>
			<title><?php wp_title( '|', true, 'right' ); ?></title>
			<?php
				}
				add_action( 'wp_head', 'cordon_render_title' );
			}
	
	}
	
	//wp title 
	function cordon_wp_title( $title, $sep ) {
		global $paged, $page;
		if ( is_feed() ) {
		return $title;
		} // end if
		// Add the site name.
		$title .= get_bloginfo( 'name' );
		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
		} // end if
		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 ) {
		$title = sprintf( esc_html__( 'Page %s', 'cordon' ), max( $paged, $page ) ) . " $sep $title";
		} // end if
		return $title;
	}
	//tag cloud filter
	function cordon_tag_cloud($input){
	   return preg_replace('/ style=("|\')(.*?)("|\')/','',$input);
	}
	//add menu for homepage
	function cordon_register_menu() {
		register_nav_menu('ridianur-onepage-menu',esc_html__( 'Menu that display only in One Page Template Builder','cordon' ));
	}
	
	//add menu for blog
	function cordon_register_menu_all() {
		register_nav_menu('ridianur-homepage-menu',esc_html__( 'Menu that display in All page except the One Page Template Builder','cordon' ));
	}
	
	//custom excerpt function
	function cordon_excerpt_length( $length ) {
		return 60;
	}
	// Remove [...]
	function cordon_trim_excerpt($text) {
		$text = str_replace('[', '', $text);
		$text = str_replace(']', '', $text);
		return $text;
	}
	//adding sidebar widget
	function cordon_sidebar() {
		register_sidebar(array(
		'name' => esc_html__('Default Sidebar', 'cordon' ),
		'id' => 'default-sidebar',
		'description' => esc_html__('Appears as the sidebar on blog and pages', 'cordon' ),
		'before_widget' => '<div  id="%1$s" class="widget %2$s clearfix">','after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',));
	}

	
	/* Replacing the default WordPress search form with an HTML5 version */
	function cordon_search_form( $form ) {
		$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" > 
		<input type="search" placeholder="'.esc_html__('Search and hit enter...','cordon').'" value="' . get_search_query() . '" name="s" id="s" />
		<input type="submit" id="searchsubmit" />
		</form>';
		return $form;
	}
	//custom comment form
	function cordon_modify_comment_form_fields($fields){
		$req = get_option('require_name_email');
		$commenter = wp_get_current_commenter();
		$aria_req = ( $req ? " aria-required='true'" : '' ); 
		
		$fields['author'] = '<p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Name', 'cordon' ) . '</label> ' . 
		
		( $req ? '' : '' ) .
						
		'<input id="author" name="author" type="text" placeholder="'. esc_html__('Your Name ...','cordon').'" value="' . 
						
		esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
						
		$fields['email'] = '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'cordon' ) . '</label> ' .
		
		( $req ? '' : '' ) .
		
		'<input id="email" name="email" type="text" placeholder="'. esc_html__('Your Email ...','cordon') .'"  value="' . 
		
		esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
		
		$fields['url'] = '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'cordon' ) . '</label>' .
		
		'<input id="url" name="url" type="text" placeholder="'. esc_html__('Your Website ...','cordon').'" value="' . 
		
		esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';
		
		return $fields;
	}
	
	//comment reply script
	function cordon_enqueue_comments_reply() {
		 if ( is_single() ) { wp_enqueue_script( "comment-reply" ); }
	}
	
	/**
	 * Registers an editor stylesheet for the theme.
	 */
	function cordon_add_editor_styles() {
		add_editor_style( 'custom-editor-style.css' );
	}

	
	//THEME SCRIPTS & STYLES
	// include theme-script
	include( get_template_directory().'/inc/theme-style.php' );
	include( get_template_directory().'/inc/theme-script.php');
	//included preloader setting
	include( get_template_directory().'/inc/preloader.php');
	//include comment template
	include( get_template_directory().'/inc/comment-template.php');
	//include color schemes 
	include( get_template_directory().'/inc/color-schemes.php');
	//include related post
	include( get_template_directory().'/inc/related-post.php');

	//pagination
	include( get_template_directory().'/inc/pagination.php');
	//include TGM activation
	include( get_template_directory().'/inc/plugin-install.php');
	
	






 
 