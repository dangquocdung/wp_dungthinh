<?php

/* Top Bar
-------------------------------------------------------------- */
function weberium_cac_has_topbar_one() {
	$topbar_style = weberium_get_mod( 'top_bar_site_style', 'style-4' );
	if ( is_page() && weberium_metabox('top_bar_style') )
		$topbar_style = weberium_metabox('top_bar_style');

	if ( 'style-1' == $topbar_style ) { return true;
	} else { return false; }
}

function weberium_cac_has_topbar_two() {
	$topbar_style = weberium_get_mod( 'top_bar_site_style', 'style-4' );
	if ( is_page() && weberium_metabox('top_bar_style') )
		$topbar_style = weberium_metabox('top_bar_style');

	if ( 'style-2' == $topbar_style ) { return true;
	} else { return false; }
}

function weberium_cac_has_topbar_three() {
	$topbar_style = weberium_get_mod( 'top_bar_site_style', 'style-4' );
	if ( is_page() && weberium_metabox('top_bar_style') )
		$topbar_style = weberium_metabox('top_bar_style');

	if ( 'style-3' == $topbar_style ) { return true;
	} else { return false; }
}

function weberium_cac_has_topbar() {
	$topbar_style = weberium_get_mod( 'top_bar_site_style', 'style-4' );
	if ( is_page() && weberium_metabox('top_bar_style') )
		$topbar_style = weberium_metabox('top_bar_style');

	if ( 'style-4' != $topbar_style ) { return true;
	} else { return false; }
}

function weberium_cac_topbar_has_button() {
	if ( weberium_cac_has_topbar() && get_theme_mod( 'top_bar_button' ) ) {
		return true;
	} else {
		return false;
	}
}

/* Headers
-------------------------------------------------------------- */
function weberium_cac_has_header_one() {
	$header_style = weberium_get_mod( 'header_site_style', 'style-1' );
	if ( is_page() && weberium_metabox('header_style') )
		$header_style = weberium_metabox('header_style');

	if ( 'style-1' == $header_style ) { return true;
	} else { return false; }
}

function weberium_cac_has_header_two() {
	$header_style = weberium_get_mod( 'header_site_style', 'style-1' );
	if ( is_page() && weberium_metabox('header_style') )
		$header_style = weberium_metabox('header_style');

	if ( 'style-2' == $header_style ) { return true;
	} else { return false; }
}

function weberium_cac_has_header_three() {
	$header_style = weberium_get_mod( 'header_site_style', 'style-1' );
	if ( is_page() && weberium_metabox('header_style') )
		$header_style = weberium_metabox('header_style');

	if ( 'style-3' == $header_style ) { return true;
	} else { return false; }
}

function weberium_cac_has_header_four() {
	$header_style = weberium_get_mod( 'header_site_style', 'style-1' );
	if ( is_page() && weberium_metabox('header_style') )
		$header_style = weberium_metabox('header_style');

	if ( 'style-4' == $header_style ) { return true;
	} else { return false; }
}

function weberium_cac_has_header_two_and_four() {
	$header_style = weberium_get_mod( 'header_site_style', 'style-1' );
	if ( is_page() && weberium_metabox('header_style') )
		$header_style = weberium_metabox('header_style');

	if ( 'style-2' == $header_style || 'style-4' == $header_style ) { return true;
	} else { return false; }
}

function weberium_cac_header_search_icon() {
	return get_theme_mod( 'header_search_icon', true );
}

function weberium_cac_header_cart_icon() {
	if ( class_exists( 'woocommerce' ) && get_theme_mod( 'header_cart_icon', true ) ) {
		return true;	
	} else {
		return false;
	}
}

function weberium_cac_has_header_fixed() {
	return get_theme_mod( 'header_fixed', true );
}

/* WooCommerce
-------------------------------------------------------------- */
function weberium_cac_has_woo() {
	if ( class_exists( 'woocommerce' ) ) { return true;	}
	else { return false; }
}

/* Scroll Top Button
-------------------------------------------------------------- */
function weberium_cac_has_scroll_top() {
	return get_theme_mod( 'scroll_top', true );
}

/* Sidebar Widget
-------------------------------------------------------------- */
function weberium_cac_hasnt_title_widget_search_three() {
	$style = get_theme_mod( 'sidebar_widget_search_style' );
	if ( 'style-3' != $style ) {
		return true;
	} else {
		return false;
	}
}

function weberium_cac_has_title_widget_twitter_one() {
	$style = get_theme_mod( 'sidebar_widget_twitter_style' );
	if ( 'style-1' == $style ) {
		return true;
	} else {
		return false;
	}
}

/* Blog
-------------------------------------------------------------- */
function weberium_cac_has_grid_blog() {
	if ( is_page_template( 'templates/page-blog-grid.php' ) ) {
		return true;
	} else {
		return false;
	}
}

function weberium_cac_has_list_blog() {
	if ( is_page_template( 'templates/page-blog-list.php' ) ) {
		return true;
	} else {
		return false;
	}
}

function weberium_cac_has_std_blog() {
	if ( !weberium_cac_has_grid_blog() && !weberium_cac_has_list_blog() ) {
		return true;
	} else {
		return false;
	}
}

/* Layout
-------------------------------------------------------------- */
function weberium_cac_has_boxed_layout() {
	if ( 'boxed' == get_theme_mod( 'site_layout_style', 'full-width' ) ) {
		return true;
	} else {
		return false;
	}
}

function weberium_cac_has_breadcrumbs() {
	if ( function_exists( 'yoast_breadcrumb' ) ) {
		return true;
	} else {
		return get_theme_mod( 'breadcrumbs', true );
	}
}

/* Featured Title
-------------------------------------------------------------- */
function weberium_cac_has_featured_title() {
	return get_theme_mod( 'featured_title', true );
}

function weberium_cac_has_featured_title_breadcrumbs() {
	if ( weberium_cac_has_featured_title() && get_theme_mod( 'featured_title_breadcrumbs' ) ) {
		return true;
	} else {
		return false;
	}
}

function weberium_cac_has_featured_title_bcrums_center1() {
	if ( weberium_cac_has_featured_title_breadcrumbs()
		&& 'heading_breadcrumbs_centered' == get_theme_mod( 'featured_title_style' ) ) {
		return true;
	} else {
		return false;
	}
}

function weberium_cac_has_featured_title_bcrums_center2() {
	if ( weberium_cac_has_featured_title_breadcrumbs()
		&& 'breadcrumbs_heading_centered' == get_theme_mod( 'featured_title_style' ) ) {
		return true;
	} else {
		return false;
	}
}

function weberium_cac_has_featured_title_heading() {
	if ( weberium_cac_has_featured_title() && get_theme_mod( 'featured_title_heading' ) ) {
		return true;
	} else {
		return false;
	}
}

function weberium_cac_has_featured_title_heading_center1() {
	if ( weberium_cac_has_featured_title_heading()
		&& 'heading_breadcrumbs_centered' == get_theme_mod( 'featured_title_style' ) ) {
		return true;
	} else {
		return false;
	}
}

function weberium_cac_has_featured_title_heading_center2() {
	if ( weberium_cac_has_featured_title_heading()
		&& 'breadcrumbs_heading_centered' == get_theme_mod( 'featured_title_style' ) ) {
		return true;
	} else {
		return false;
	}
}

// Project Single Page
function weberium_cac_has_single_project() {
	if ( is_singular('project') ) {
		return true;
	} else {
		return false;
	}
}

function weberium_cac_has_related_project() {
	if ( weberium_get_mod( 'project_related', true ) && weberium_cac_has_single_project() ) {
		return true;
	};
}

/* Footer
-------------------------------------------------------------- */
function weberium_cac_has_footer_widgets() {
	return get_theme_mod( 'footer_widgets', true );
}

/* Bottom Bar
-------------------------------------------------------------- */
function weberium_cac_has_bottombar() {
	return get_theme_mod( 'bottom_bar', true );
}