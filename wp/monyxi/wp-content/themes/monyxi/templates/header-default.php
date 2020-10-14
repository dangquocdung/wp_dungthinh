<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage MONYXI
 * @since MONYXI 1.0
 */

$monyxi_header_css = '';
$monyxi_header_image = get_header_image();
$monyxi_header_video = monyxi_get_header_video();
if (!empty($monyxi_header_image) && monyxi_trx_addons_featured_image_override(is_singular() || monyxi_storage_isset('blog_archive') || is_category())) {
	$monyxi_header_image = monyxi_get_current_mode_image($monyxi_header_image);
}

?><header class="top_panel top_panel_default<?php
					echo !empty($monyxi_header_image) || !empty($monyxi_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($monyxi_header_video!='') echo ' with_bg_video';
					if ($monyxi_header_image!='') echo ' '.esc_attr(monyxi_add_inline_css_class('background-image: url('.esc_url($monyxi_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (monyxi_is_on(monyxi_get_theme_option('header_fullheight'))) echo ' header_fullheight monyxi-full-height';
					if (!monyxi_is_inherit(monyxi_get_theme_option('header_scheme')))
						echo ' scheme_' . esc_attr(monyxi_get_theme_option('header_scheme'));
					?>"><?php

	// Background video
	if (!empty($monyxi_header_video)) {
		get_template_part( apply_filters('monyxi_filter_get_template_part', 'templates/header-video') );
	}
	
	// Main menu
	if (monyxi_get_theme_option("menu_style") == 'top') {
		get_template_part( apply_filters('monyxi_filter_get_template_part', 'templates/header-navi') );
	}

	// Mobile header
	if (monyxi_is_on(monyxi_get_theme_option("header_mobile_enabled"))) {
		get_template_part( apply_filters('monyxi_filter_get_template_part', 'templates/header-mobile') );
	}
	
	// Page title and breadcrumbs area
	get_template_part( apply_filters('monyxi_filter_get_template_part', 'templates/header-title') );

	// Header widgets area
	get_template_part( apply_filters('monyxi_filter_get_template_part', 'templates/header-widgets') );

	// Display featured image in the header on the single posts
	// Comment next line to prevent show featured image in the header area
	// and display it in the post's content
	

?></header>