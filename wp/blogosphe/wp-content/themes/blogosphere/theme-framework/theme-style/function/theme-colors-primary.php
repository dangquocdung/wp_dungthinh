<?php
/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version 	1.0.2
 * 
 * Theme Primary Color Schemes Rules
 * Created by CMSMasters
 * 
 */


function blogosphere_theme_colors_primary() {
	$cmsmasters_option = blogosphere_get_global_options();
	
	
	$cmsmasters_color_schemes = cmsmasters_color_schemes_list();
	
	
	$custom_css = "/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version 	1.0.2
 * 
 * Theme Primary Color Schemes Rules
 * Created by CMSMasters
 * 
 */

";
	
	
	foreach ($cmsmasters_color_schemes as $scheme => $title) {
		$rule = (($scheme != 'default') ? "html .cmsmasters_color_scheme_{$scheme} " : '');
		
		
		$custom_css .= "
/***************** Start {$title} Color Scheme Rules ******************/

	/* Start Main Content Font Color */
	" . (($scheme == 'default') ? "body," : '') . "
	" . (($scheme != 'default') ? ".cmsmasters_color_scheme_{$scheme}," : '') . "
	{$rule}.cmsmasters_post_masonry .cmsmasters_post_content {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_color']) . "
	}
	
	{$rule}select, 
	{$rule}option, 
	{$rule}.cmsmasters-form-builder small.db, 
	{$rule}input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]),
	{$rule}textarea {
		color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['blogosphere' . '_' . $scheme . '_color']) . ", .5);
	}
	
	{$rule}input::-webkit-input-placeholder {
		color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['blogosphere' . '_' . $scheme . '_color']) . ", .5);
	}
	
	{$rule}input:-moz-placeholder {
		color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['blogosphere' . '_' . $scheme . '_color']) . ", .5);
	}
	
	{$rule}textarea::-moz-placeholder {
		color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['blogosphere' . '_' . $scheme . '_color']) . ", .5);
	}
	
	{$rule}textarea::-webkit-input-placeholder {
		color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['blogosphere' . '_' . $scheme . '_color']) . ", .5);
	}
	
	{$rule}input:focus::-webkit-input-placeholder {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_color']) . "
	}
	
	{$rule}input:focus:-moz-placeholder {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_color']) . "
	}
	
	{$rule}textarea:focus::-moz-placeholder {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_color']) . "
	}
	
	{$rule}textarea:focus::-webkit-input-placeholder {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_color']) . "
	}
	
	{$rule}input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]):focus,
	{$rule}textarea:focus {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_color']) . "
	}
	/* Finish Main Content Font Color */
	
	
	/* Start Primary Color */
	{$rule}a,
	{$rule}h1 a:hover,
	{$rule}h2 a:hover,
	{$rule}h3 a:hover,
	{$rule}h4 a:hover,
	{$rule}h5 a:hover,
	{$rule}h6 a:hover,
	{$rule}.color_2,
	{$rule}.post_nav .post_nav_sub,
	{$rule}.post_nav a:hover .post_nav_sub,
	{$rule}.post_nav a:hover .post_nav_title,
	{$rule}#page .cmsmasters_social_icon:hover, 
	{$rule}.owl-buttons > div:hover,
	{$rule}.cmsmasters_likes a:hover, 
	{$rule}.cmsmasters_likes a:before,
	{$rule}.cmsmasters_likes a.active, 
	{$rule}.cmsmasters_views > span:before, 
	{$rule}.cmsmasters_views > span.active, 
	{$rule}.cmsmasters_comments a:hover,
	{$rule}.cmsmasters_notice .notice_close:hover,
	{$rule}.cmsmasters_post_timeline:hover .cmsmasters_post_date,
	{$rule}.cmsmasters_quotes_slider .cmsmasters_quote_subtitle_wrap > *,
	{$rule}.cmsmasters_quotes_grid .cmsmasters_quote_subtitle_wrap > *,
	{$rule}.cmsmasters_wrap_items_loader .cmsmasters_items_loader:hover,
	{$rule}.cmsmasters_items_filter_wrap .button,
	{$rule}.cmsmasters_breadcrumbs .cmsmasters_breadcrumbs_inner,
	{$rule}.cmsmasters_breadcrumbs .cmsmasters_breadcrumbs_inner a:hover,
	{$rule}.cmsmasters_wrap_more_items.cmsmasters_loading:before,
	{$rule}.cmsmasters_img_rollover_wrap .cmsmasters_img_rollover .cmsmasters_open_post_link:hover,
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_top:before,
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_heading_left .icon_box_heading:before,
	{$rule}.cmsmasters_project_grid .cmsmasters_project_category a:hover,
	{$rule}.cmsmasters_project_puzzle .cmsmasters_project_category a:hover, 
	{$rule}.cmsmasters_slider_project .cmsmasters_slider_project_category a:hover, 
	{$rule}.cmsmasters_pricing_table .cmsmasters_price_wrap .cmsmasters_period,
	{$rule}.cmsmasters_icon_list_items.cmsmasters_color_type_icon .cmsmasters_icon_list_icon:before,
	{$rule}.cmsmasters_stats.stats_mode_bars.stats_type_horizontal .cmsmasters_stat_wrap .cmsmasters_stat .cmsmasters_stat_inner:before, 
	{$rule}.cmsmasters_twitter_wrap .owl-buttons > div:hover, 
	{$rule}.cmsmasters_icon_wrap a:hover .cmsmasters_simple_icon,
	{$rule}.cmsmasters_icon_wrap a:hover .cmsmasters_simple_icon_title, 
	{$rule}.cmsmasters_stats.stats_mode_circles .cmsmasters_stat_wrap .cmsmasters_stat .cmsmasters_stat_inner:before, 
	{$rule}.bypostauthor > .comment-body .alignleft:before,
	{$rule}.cmsmasters_slider_post .cmsmasters_slider_post_cont_info > span,
	{$rule}.cmsmasters_slider_post .cmsmasters_slider_post_cont_info > span a:hover,
	{$rule}.cmsmasters_slider_post .cmsmasters_slider_post_category a:hover, 
	{$rule}.cmsmasters_slider_post .cmsmasters_slider_post_read_more:hover,
	{$rule}.cmsmasters_sitemap_wrap .cmsmasters_sitemap > li > a:hover,
	{$rule}.cmsmasters_sitemap_wrap .cmsmasters_sitemap > li > ul > li > a:hover,
	{$rule}.cmsmasters_sitemap_wrap .cmsmasters_sitemap_category > li > a:hover,
	{$rule}.cmsmasters_post_timeline .cmsmasters_post_category a:hover,
	{$rule}.cmsmasters_post_timeline .cmsmasters_post_cont_info,
	{$rule}.cmsmasters_post_timeline .cmsmasters_post_cont_info a:hover,
	{$rule}.cmsmasters_post_timeline .cmsmasters_post_read_more:hover,
	{$rule}.cmsmasters_post_puzzle .cmsmasters_post_category a:hover,
	{$rule}.cmsmasters_post_puzzle .cmsmasters_post_footer,
	{$rule}.cmsmasters_post_puzzle .cmsmasters_post_footer a:hover,
	{$rule}.cmsmasters_post_puzzle .cmsmasters_post_read_more:hover,
	{$rule}.cmsmasters_post_masonry .cmsmasters_post_category a:hover,
	{$rule}.cmsmasters_post_masonry .cmsmasters_post_cont_info,
	{$rule}.cmsmasters_post_masonry .cmsmasters_post_cont_info a:hover,
	{$rule}.cmsmasters_post_masonry .cmsmasters_post_read_more:hover,
	{$rule}.cmsmasters_post_default .cmsmasters_post_read_more:hover,
	{$rule}.cmsmasters_post_default .cmsmasters_post_cont_info a:hover, 
	{$rule}.cmsmasters_post_default .cmsmasters_post_author a:hover, 
	{$rule}.cmsmasters_post_default .cmsmasters_post_author, 
	{$rule}.cmsmasters_post_default .cmsmasters_post_date, 
	{$rule}.cmsmasters_open_post .cmsmasters_post_read_more:hover,
	{$rule}.cmsmasters_open_post .cmsmasters_post_author a:hover, 
	{$rule}.cmsmasters_open_post .cmsmasters_post_author, 
	{$rule}.cmsmasters_open_post .cmsmasters_post_category a:hover,
	{$rule}.cmsmasters_open_post .cmsmasters_post_date, 
	{$rule}.cmsmasters_open_post .cmsmasters_post_tags > a:hover, 
	{$rule}.cmsmasters_open_project .cmsmasters_project_tags > a:hover, 
	{$rule}.cmsmasters_open_project .project_details_item_desc a:hover, 
	{$rule}.cmsmasters_open_project .project_features_item_desc a:hover, 
	{$rule}.cmsmasters_open_profile .profile_details_item_desc a:hover, 
	{$rule}.cmsmasters_open_profile .profile_features_item_desc a:hover, 
	{$rule}.cmsmasters_open_profile .cmsmasters_profile_subtitle, 
	{$rule}.cmsmasters_open_project .project_details_item_desc a.active, 
	{$rule}.cmsmasters_open_profile .profile_details_item_desc a.active, 
	{$rule}.widget_rss ul li .rsswidget:hover, 
	{$rule}.widget_rss ul li .rss-date, 
	{$rule}.widget_custom_posts_tabs_entries .cmsmasters_tabs .cmsmasters_lpr_tabs_cont > a:hover, 
	{$rule}.widget_custom_posts_tabs_entries .cmsmasters_tabs .cmsmasters_lpr_tabs_cont > .published, 
	{$rule}.widget_custom_posts_tabs_entries .cmsmasters_tabs .cmsmasters_tab.tab_comments li small, 
	{$rule}.widget_custom_posts_tabs_entries .tab_comments li > a:first-child:hover, 
	{$rule}.widget_custom_contact_info_entries > span:before, 
	{$rule}.widget_custom_contact_info_entries .adress_wrap:before, 
	{$rule}.cmsmasters_archive_type .cmsmasters_archive_item_info > span, 
	{$rule}.cmsmasters_archive_type .cmsmasters_archive_item_info > span a:hover, 
	{$rule}.widget_pages ul li a:hover, 
	{$rule}.widget_categories ul li a:hover, 
	{$rule}.widget_archive ul li a:hover, 
	{$rule}.widget_meta ul li a:hover, 
	{$rule}.widget_recent_entries ul li a:hover,
	{$rule}#wp-calendar tfoot a:hover, 
	{$rule}.widget_nav_menu li a:hover, 
	{$rule}.widget_tag_cloud a:hover, 
	{$rule}.share_posts a:hover, 
	{$rule}.cmsmasters_post_default .cmsmasters_post_info > a:hover .cmsmasters_post_date, 
	{$rule}.cmsmasters_mailpoet_form .wysija-submit:hover, 
	{$rule}.cmsmasters_mailpoet_form .mailpoet_submit:hover, 
	{$rule}.comment-respond .comment-notes, 
	{$rule}.comment-respond .logged-in-as, 
	{$rule}.comment-respond .comment-notes a:hover, 
	{$rule}.comment-respond .logged-in-as a:hover, 
	{$rule}.widget_recent_comments .comment-author-link a:hover, 
	{$rule}.search_bar_wrap .search_button button:hover, 
	{$rule}.cmsmasters_comment_item .cmsmasters_comment_item_date, 
	{$rule}.cmsmasters_comment_item .comment-edit-link:hover, 
	{$rule}.cmsmasters_comment_item .comment-reply-link:hover, 
	{$rule}.cmsmasters_single_slider .cmsmasters_post_date, 
	{$rule}.share_posts .share_posts_title, 
	{$rule}.cmsmasters_attach_img .cmsmasters_attach_img_edit a, 
	{$rule}.cmsmasters_attach_img .cmsmasters_attach_img_meta a {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
	}
	
	" . (($scheme == 'default') ? "#slide_top," : '') . "
	" . (($scheme == 'default') ? "mark," : '') . "
	" . (($scheme != 'default') ? ".cmsmasters_color_scheme_{$scheme} mark," : '') . "
	{$rule}.cmsmasters_button:hover, 
	{$rule}.button:hover, 
	{$rule}input[type=submit]:hover, 
	{$rule}input[type=button]:hover, 
	{$rule}button:hover, 
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_box_top:before,
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_box_left_top:before,
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_box_left:before,
	{$rule}.cmsmasters_icon_list_items.cmsmasters_color_type_bg .cmsmasters_icon_list_item .cmsmasters_icon_list_icon,
	{$rule}.cmsmasters_icon_list_items.cmsmasters_color_type_icon .cmsmasters_icon_list_item:hover .cmsmasters_icon_list_icon,
	{$rule}.cmsmasters_stats.stats_mode_bars .cmsmasters_stat_wrap .cmsmasters_stat .cmsmasters_stat_inner {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.cmsmasters_icon_list_items.cmsmasters_color_type_border .cmsmasters_icon_list_item .cmsmasters_icon_list_icon:after,
	{$rule}.cmsmasters_mailpoet_form .wysija-submit:hover, 
	{$rule}.cmsmasters_mailpoet_form .mailpoet_submit:hover, 
	{$rule}input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]):focus,
	{$rule}textarea:focus {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
	}
	/* Finish Primary Color */
	
	
	/* Start Highlight Color */
	{$rule}a:hover,
	{$rule}a.cmsmasters_cat_color:hover,
	{$rule}.owl-buttons > div,
	{$rule}.cmsmasters_likes a, 
	{$rule}.cmsmasters_views > span, 
	{$rule}.cmsmasters_comments a,
	{$rule}#page .cmsmasters_social_icon, 
	{$rule}.cmsmasters_twitter_wrap .owl-buttons > div, 
	{$rule}.cmsmasters_wrap_items_loader .cmsmasters_items_loader,
	{$rule}.cmsmasters_notice .notice_close,
	{$rule}.cmsmasters_items_filter_wrap .button:hover,
	{$rule}.cmsmasters_items_filter_wrap .button.current,
	{$rule}.cmsmasters_items_filter_wrap li.current a,
	{$rule}.cmsmasters_img_rollover_wrap .cmsmasters_img_rollover .cmsmasters_open_post_link,
	{$rule}.cmsmasters_toggles .cmsmasters_toggle_wrap.current_toggle a,
	{$rule}.cmsmasters_toggles .cmsmasters_toggles_filter a.current_filter,
	{$rule}.cmsmasters_breadcrumbs .breadcrumbs_sep,
	{$rule}.cmsmasters_breadcrumbs .cmsmasters_breadcrumbs_inner a,
	{$rule}.cmsmasters_icon_wrap a .cmsmasters_simple_icon,
	{$rule}.cmsmasters_icon_wrap .cmsmasters_simple_icon_title, 
	{$rule}.cmsmasters_project_puzzle .cmsmasters_project_category a, 
	{$rule}.cmsmasters_project_grid .cmsmasters_project_category a,
	{$rule}.cmsmasters_slider_project .cmsmasters_slider_project_category a, 
	{$rule}.cmsmasters_slider_post .cmsmasters_slider_post_category a, 
	{$rule}.cmsmasters_slider_post .cmsmasters_slider_post_cont_info > span a,
	{$rule}.cmsmasters_slider_post .cmsmasters_slider_post_read_more,
	{$rule}.cmsmasters_tabs_list_item.current_tab a,
	{$rule}.cmsmasters_post_timeline .cmsmasters_post_category a,
	{$rule}.cmsmasters_post_timeline .cmsmasters_post_cont_info a,
	{$rule}.cmsmasters_post_timeline .cmsmasters_post_read_more,
	{$rule}.cmsmasters_post_puzzle .cmsmasters_post_category a,
	{$rule}.cmsmasters_post_puzzle .cmsmasters_post_footer a,
	{$rule}.cmsmasters_post_puzzle .cmsmasters_post_read_more,
	{$rule}.cmsmasters_post_masonry .cmsmasters_post_category a,
	{$rule}.cmsmasters_post_masonry .cmsmasters_post_cont_info a,
	{$rule}.cmsmasters_post_masonry .cmsmasters_post_read_more,
	{$rule}.cmsmasters_post_default .cmsmasters_post_read_more,
	{$rule}.cmsmasters_post_default .cmsmasters_post_cont_info a, 
	{$rule}.cmsmasters_post_default .cmsmasters_post_author a, 
	{$rule}.cmsmasters_open_post .cmsmasters_post_category a,
	{$rule}.cmsmasters_open_post .cmsmasters_post_read_more,
	{$rule}.cmsmasters_open_post .cmsmasters_post_author a, 
	{$rule}.cmsmasters_open_post .cmsmasters_post_tags > a, 
	{$rule}.cmsmasters_open_project .cmsmasters_project_tags > a, 
	{$rule}.cmsmasters_open_project .project_details_item_desc a, 
	{$rule}.cmsmasters_open_project .project_features_item_desc a, 
	{$rule}.cmsmasters_open_profile .profile_details_item_desc a, 
	{$rule}.cmsmasters_open_profile .profile_features_item_desc a, 
	{$rule}.cmsmasters_archive_type .cmsmasters_archive_item_info > span a, 
	{$rule}.cmsmasters_comment_item .comment-edit-link, 
	{$rule}.cmsmasters_comment_item .comment-reply-link, 
	{$rule}.search_bar_wrap .search_button button, 
	{$rule}.comment-respond .comment-notes a, 
	{$rule}.comment-respond .logged-in-as a, 
	{$rule}.share_posts a, 
	{$rule}#wp-calendar tfoot a, 
	{$rule}.widget_rss ul li .rsswidget, 
	{$rule}.widget_pages ul li a, 
	{$rule}.widget_categories ul li a, 
	{$rule}.widget_archive ul li a, 
	{$rule}.widget_meta ul li a, 
	{$rule}.widget_recent_entries ul li a, 
	{$rule}.widget_nav_menu li a, 
	{$rule}.widget_tag_cloud a, 
	{$rule}.widget_recent_comments, 
	{$rule}.cmsmasters_mailpoet_form .wysija-submit,
	{$rule}.cmsmasters_mailpoet_form .mailpoet_submit,
	{$rule}.widget_recent_comments .comment-author-link a, 
	{$rule}.cmsmasters_post_default .cmsmasters_post_info > a .cmsmasters_post_date, 
	{$rule}.widget_custom_posts_tabs_entries .tab_comments li, 
	{$rule}.widget_custom_posts_tabs_entries .tab_comments li .color_2, 
	{$rule}.widget_custom_posts_tabs_entries .tab_comments li > a:first-child, 
	{$rule}.widget_custom_posts_tabs_entries .cmsmasters_tabs .cmsmasters_lpr_tabs_cont > a, 
	{$rule}.cmsmasters_attach_img .cmsmasters_attach_img_edit a:hover, 
	{$rule}.cmsmasters_attach_img .cmsmasters_attach_img_meta a:hover,
	{$rule}.subpage_nav > span,
	{$rule}#page .cmsmasters_mailpoet_form form .mailpoet_message .mailpoet_validate_success,
	{$rule}#page .cmsmasters_mailpoet_form form .mailpoet_message .mailpoet_validate_error,
	{$rule}#page .cmsmasters_mailpoet_form form .parsley-errors-list .parsley-required,
	{$rule}#page .cmsmasters_mailpoet_form form .parsley-errors-list .parsley-custom-error-message {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_hover']) . "
	}
	
	" . (($scheme == 'default') ? "#slide_top:hover, " : '') . "
	{$rule}.owl-pagination .owl-page.active, 
	{$rule}.owl-pagination .owl-page:hover, 
	{$rule}.cmsmasters_tabs.tabs_mode_tour .cmsmasters_tabs_list_item:before, 
	{$rule}.cmsmasters_button, 
	{$rule}.button, 
	{$rule}input[type=submit], 
	{$rule}input[type=button], 
	{$rule}button {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_hover']) . "
	}
	
	{$rule}.cmsmasters_mailpoet_form .wysija-submit,
	{$rule}.cmsmasters_mailpoet_form .mailpoet_submit {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_hover']) . "
	}
	/* Finish Highlight Color */
	
	
	/* Start Headings Color */
	" . (($scheme == 'default') ? ".headline_outer," : '') . "
	" . (($scheme == 'default') ? ".headline_outer a:hover," : '') . "
	{$rule}h1,
	{$rule}h2,
	{$rule}h3,
	{$rule}h4,
	{$rule}h5,
	{$rule}h6,
	{$rule}h1 a,
	{$rule}h2 a,
	{$rule}h3 a,
	{$rule}h4 a,
	{$rule}h5 a,
	{$rule}h6 a,
	{$rule}fieldset legend,
	{$rule}.post_nav .post_nav_title,
	{$rule}blockquote footer,
	{$rule}table caption,
	{$rule}.cmsmasters_twitter_wrap .twr_icon, 
	{$rule}.cmsmasters_pricing_table .cmsmasters_price_wrap,
	{$rule}.cmsmasters_stats.stats_mode_bars.stats_type_horizontal .cmsmasters_stat_wrap .cmsmasters_stat .cmsmasters_stat_inner,
	{$rule}.cmsmasters_stats.stats_mode_bars.stats_type_vertical .cmsmasters_stat_wrap .cmsmasters_stat_title,
	{$rule}.cmsmasters_stats.stats_mode_circles .cmsmasters_stat_wrap .cmsmasters_stat .cmsmasters_stat_inner .cmsmasters_stat_counter_wrap,
	{$rule}.cmsmasters_stats.stats_mode_circles .cmsmasters_stat_wrap .cmsmasters_stat_title, 
	{$rule}.cmsmasters_stats.stats_mode_bars.stats_type_vertical .cmsmasters_stat_wrap .cmsmasters_stat .cmsmasters_stat_inner .cmsmasters_stat_title_counter_wrap, 
	{$rule}.cmsmasters_counters .cmsmasters_counter_wrap .cmsmasters_counter .cmsmasters_counter_inner .cmsmasters_counter_counter_wrap, 
	{$rule}.cmsmasters_counters .cmsmasters_counter_wrap .cmsmasters_counter .cmsmasters_counter_inner .cmsmasters_counter_title, 
	{$rule}.cmsmasters_dropcap.type1,
	{$rule}#wp-calendar tr th,
	{$rule}.cmsmasters_counters .cmsmasters_counter_wrap .cmsmasters_counter .cmsmasters_counter_inner:before, 
	{$rule}.cmsmasters_post_timeline .cmsmasters_post_date, 
	{$rule}.cmsmasters_sitemap_wrap .cmsmasters_sitemap > li > a,
	{$rule}.cmsmasters_sitemap_wrap .cmsmasters_sitemap > li > ul > li > a,
	{$rule}.cmsmasters_sitemap_wrap .cmsmasters_sitemap > li > ul > li > ul li a:before,
	{$rule}.cmsmasters_sitemap_wrap .cmsmasters_sitemap_category > li > a,
	{$rule}.cmsmasters_sitemap_wrap .cmsmasters_sitemap_category > li > ul li a:before,
	{$rule}.cmsmasters_sitemap_wrap .cmsmasters_sitemap_archive > li a:before {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_heading']) . "
	}
	
	{$rule}table thead tr,
	{$rule}.cmsmasters_dropcap.type2,
	{$rule}.cmsmasters_icon_list_items .cmsmasters_icon_list_item .cmsmasters_icon_list_icon,
	{$rule}form .formError .formErrorContent, 
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=checkbox] + span.wpcf7-list-item-label:after, 
	{$rule}.cmsmasters-form-builder .check_parent input[type=checkbox] + label:after, 
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=radio] + span.wpcf7-list-item-label:after, 
	{$rule}.cmsmasters-form-builder .check_parent input[type=radio] + label:after {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_heading']) . "
	}
	
	{$rule}form .formError .formErrorContent:before {
		" . cmsmasters_color_css('border-top-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_heading']) . "
	}
	
	{$rule}.cmsmasters_post_puzzle .cmsmasters_post_footer_info {
		background-color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['blogosphere' . '_' . $scheme . '_heading']) . ", .5);
	}
	
	{$rule}.cmsmasters_header_search_form {
		background-color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['blogosphere' . '_' . $scheme . '_heading']) . ", .55);
	}
	/* Finish Headings Color */
	
	
	/* Start Main Background Color */
	{$rule}.cmsmasters_button, 
	{$rule}.button, 
	{$rule}input[type=submit], 
	{$rule}input[type=button], 
	{$rule}button, 
	{$rule}.cmsmasters_button:hover, 
	{$rule}.button:hover, 
	{$rule}input[type=submit]:hover, 
	{$rule}input[type=button]:hover, 
	{$rule}button:hover, 
	{$rule}mark,
	{$rule}table thead th,
	{$rule}.cmsmasters_dropcap.type2,
	{$rule}form .formError .formErrorContent,
	{$rule}.cmsmasters_post_puzzle .cmsmasters_post_footer_info .cmsmasters_post_footer_info_inner a, 
	{$rule}.cmsmasters_post_puzzle .cmsmasters_post_footer_info .cmsmasters_post_footer_info_inner .cmsmasters_views > span, 
	{$rule}.cmsmasters_header_search_form .cmsmasters_header_search_form_close,
	{$rule}.cmsmasters_header_search_form button, 
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_box_left_top:before,
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_box_left:before,
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_box_top:before,
	{$rule}.cmsmasters_icon_list_items.cmsmasters_color_type_border .cmsmasters_icon_list_item .cmsmasters_icon_list_icon:before,
	{$rule}.cmsmasters_stats.stats_mode_bars.stats_type_vertical .cmsmasters_stat_wrap .cmsmasters_stat .cmsmasters_stat_inner,
	{$rule}.cmsmasters_header_search_form input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]) {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_post_puzzle .cmsmasters_post_footer_info .cmsmasters_post_footer_info_inner a:before,
	{$rule}.cmsmasters_post_puzzle .cmsmasters_post_footer_info .cmsmasters_post_footer_info_inner a:hover,
	{$rule}.cmsmasters_post_puzzle .cmsmasters_post_footer_info .cmsmasters_post_footer_info_inner a.active,
	{$rule}.cmsmasters_post_puzzle .cmsmasters_post_footer_info .cmsmasters_post_footer_info_inner .cmsmasters_views > span:before,
	{$rule}.cmsmasters_post_puzzle .cmsmasters_post_footer_info .cmsmasters_post_footer_info_inner .cmsmasters_views > span.active,
	{$rule}.cmsmasters_header_search_form .cmsmasters_header_search_form_close:hover, 
	{$rule}.cmsmasters_header_search_form button:hover {
		color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . ", .7);
	}
	
	{$rule}.cmsmasters_header_search_form input::-webkit-input-placeholder {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_header_search_form input:-moz-placeholder {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_header_search_form input:focus::-webkit-input-placeholder {
		color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . ", .7);
	}
	
	{$rule}.cmsmasters_header_search_form input:focus:-moz-placeholder {
		color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . ", .7);
	}
	
	" . (($scheme == 'default') ? "body," : '') . "
	" . (($scheme != 'default') ? ".cmsmasters_color_scheme_{$scheme}," : '') . "
	" . (($scheme == 'default') ? ".middle_inner," : '') . "
	" . (($scheme == 'default') ? ".headline_outer," : '') . "
	{$rule}.headline_outer .headline_inner.align_center .subtitle_wrapper .entry-subtitle,
	{$rule}.headline_outer .headline_inner.align_center .title_wrapper .entry-title,
	{$rule}.comment-respond .comment-reply-title,
	{$rule}.post_comments .post_comments_title,
	{$rule}.cmsmasters_content_slider .owl-buttons > div,
	{$rule}.cmsmasters_content_slider .owl-pagination > div,
	{$rule}.blog .owl-buttons > div,
	{$rule}.cmsmasters_mailpoet_form .wysija-paragraph:before,
	{$rule}.cmsmasters_mailpoet_form .mailpoet_paragraph:before,
	{$rule}.cmsmasters_open_project .owl-buttons > div,
	{$rule}.cmsmasters_post_default .cmsmasters_post_sticky h5,
	{$rule}.cmsmasters_project_puzzle .project_inner,
	{$rule}.cmsmasters_post_timeline .cmsmasters_post_date,
	{$rule}.post_nav .post_nav_thumb_wrap:before,
	{$rule}.about_author .cmsmasters_about_author_title_wrap .about_author_title,
	{$rule}.cmsmasters_single_slider .cmsmasters_single_slider_title_wrap .cmsmasters_single_slider_title,
	{$rule}.cmsmasters_icon_wrap .cmsmasters_simple_icon, 
	{$rule}.cmsmasters_wrap_items_loader .cmsmasters_items_loader,
	{$rule}.cmsmasters_wrap_items_loader .cmsmasters_items_loader:hover,
	{$rule}.cmsmasters_img_rollover_wrap .cmsmasters_img_rollover .cmsmasters_open_post_link,
	{$rule}.cmsmasters_img_rollover_wrap .cmsmasters_img_rollover .cmsmasters_open_post_link:hover,
	{$rule}input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]),
	{$rule}textarea,
	{$rule}option {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_content_slider .owl-pagination > div.active,
	{$rule}.cmsmasters_content_slider .owl-pagination > div:hover {
		background-color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . ", .5);
	}
	
	{$rule}.post.cmsmasters_post_puzzle .cmsmasters_post_content_wrapper:before, 
	{$rule}.cmsmasters_counters .cmsmasters_counter_wrap .cmsmasters_counter .cmsmasters_counter_inner:before {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_post_puzzle.one_x_two .cmsmasters_post_cont .cmsmasters_post_content_wrapper:before {
		border-right-color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . ", 1) !important;
	}
	
	{$rule}.cmsmasters_post_puzzle.one_x_one .cmsmasters_post_cont .cmsmasters_post_content_wrapper:nth-child(even):before {
		border-bottom-color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . ", 1) !important;
	}
	
	{$rule}.cmsmasters_post_puzzle.one_x_two:nth-child(even) .cmsmasters_post_cont .cmsmasters_post_content_wrapper:before {
		border-left-color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . ", 1) !important;
	}
	/* Finish Main Background Color */
	
	
	/* Start Alternate Background Color */
	" . (($scheme == 'default') ? "#slide_top," : '') . "
	{$rule}.cmsmasters_icon_list_items.cmsmasters_color_type_icon .cmsmasters_icon_list_icon_wrap, 
	{$rule}.cmsmasters_icon_list_items.cmsmasters_color_type_bg .cmsmasters_icon_list_item .cmsmasters_icon_list_icon:before {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_alternate']) . "
	}
	
	{$rule}select,
	{$rule}fieldset,
	{$rule}fieldset legend,
	{$rule}.img_placeholder_small, 
	{$rule}.cmsmasters_featured_block,
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_box_top,
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_box_left,
	{$rule}.cmsmasters_icon_list_items.cmsmasters_color_type_icon .cmsmasters_icon_list_icon,
	{$rule}.cmsmasters_stats.stats_mode_circles .cmsmasters_stat_wrap .cmsmasters_stat .cmsmasters_stat_inner, 
	{$rule}.gallery-item .gallery-icon,
	{$rule}.gallery-item .gallery-caption,
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=checkbox] + span.wpcf7-list-item-label:before, 
	{$rule}.cmsmasters-form-builder .check_parent input[type=checkbox] + label:before, 
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=radio] + span.wpcf7-list-item-label:before, 
	{$rule}.cmsmasters-form-builder .check_parent input[type=radio] + label:before {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_alternate']) . "
	}
	/* Finish Alternate Background Color */
	
	
	/* Start Borders Color */
	{$rule}.img_placeholder_small, 
	{$rule}.preloader {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_border']) . "
	}
	
	{$rule}.owl-pagination .owl-page,
	{$rule}.cmsmasters_quotes_grid .cmsmasters_quotes_vert:before,
	{$rule}.cmsmasters_quotes_grid .cmsmasters_quotes_vert:after,
	{$rule}.cmsmasters_quotes_grid .cmsmasters_quotes_vert span,
	{$rule}.cmsmasters_quotes_grid .cmsmasters_quotes_list:before,
	{$rule}.cmsmasters_wrap_items_loader:before,
	{$rule}.blog.timeline:before,
	{$rule}.comment-respond:before,
	{$rule}.comment-respond:after,
	{$rule}.post_comments:before,
	{$rule}.post_comments:after,
	{$rule}.about_author .cmsmasters_about_author_title_wrap:before, 
	{$rule}.cmsmasters_single_slider .cmsmasters_single_slider_title_wrap:before,
	{$rule}.headline_outer .headline_inner.align_center .headline_subtitle .subtitle_wrapper:before, 
	{$rule}.headline_outer .headline_inner.align_center .title_wrapper:before, 
	{$rule}.cmsmasters_sitemap_wrap .cmsmasters_sitemap > li:before {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_border']) . "
	}
	
	" . (($scheme == 'default') ? ".headline_outer," : '') . "
	{$rule}.cmsmasters_attach_img .cmsmasters_attach_img_info, 
	{$rule}input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]),
	{$rule}textarea,
	{$rule}option,
	{$rule}select,
	{$rule}hr,
	{$rule}table tr,
	{$rule}.img_placeholder_small,
	{$rule}.widget_categories ul li,
	{$rule}.cmsmasters_divider,
	{$rule}.cmsmasters_quotes_grid .cmsmasters_quote,
	{$rule}.cmsmasters_quotes_grid .cmsmasters_quotes_vert,
	{$rule}.cmsmasters_search > .about_author, 
	{$rule}.cmsmasters_archive > .about_author, 
	{$rule}.cmsmasters_widget_divider,
	{$rule}.cmsmasters_toggles .cmsmasters_toggle_wrap,
	{$rule}.cmsmasters_toggles .cmsmasters_toggle_title,
	{$rule}.cmsmasters_pricing_table .cmsmasters_pricing_item_inner,
	{$rule}.cmsmasters_tabs.tabs_mode_tour .cmsmasters_tabs_list_item,
	{$rule}.cmsmasters_img_rollover_wrap .img_placeholder,
	{$rule}.cmsmasters_icon_wrap .cmsmasters_simple_icon, 
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_box_top,
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_box_left,
	{$rule}.cmsmasters_icon_list_items.cmsmasters_icon_list_type_block .cmsmasters_icon_list_item,
	{$rule}.cmsmasters_icon_list_items.cmsmasters_color_type_bg .cmsmasters_icon_list_icon:after,
	{$rule}.cmsmasters_icon_list_items.cmsmasters_color_type_icon .cmsmasters_icon_list_icon:after, 
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=checkbox] + span.wpcf7-list-item-label:before, 
	{$rule}.cmsmasters-form-builder .check_parent input[type=checkbox] + label:before, 
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=radio] + span.wpcf7-list-item-label:before, 
	{$rule}.cmsmasters-form-builder .check_parent input[type=radio] + label:before {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_border']) . "
	}
	/* Finish Borders Color */
	
	
	/* Start Custom Rules */
	{$rule}::selection {
		" . cmsmasters_color_css('background', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . ";
	}
	
	{$rule}::-moz-selection {
		" . cmsmasters_color_css('background', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
	}
	";
	
	
	if ($scheme != 'default') {
		$custom_css .= "
		.cmsmasters_color_scheme_{$scheme}.cmsmasters_row_top_zigzag:before, 
		.cmsmasters_color_scheme_{$scheme}.cmsmasters_row_bot_zigzag:after {
			background-image: -webkit-linear-gradient(135deg, " . $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg'] . " 25%, transparent 25%), 
					-webkit-linear-gradient(45deg, " . $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg'] . " 25%, transparent 25%);
			background-image: -moz-linear-gradient(135deg, " . $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg'] . " 25%, transparent 25%), 
					-moz-linear-gradient(45deg, " . $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg'] . " 25%, transparent 25%);
			background-image: -ms-linear-gradient(135deg, " . $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg'] . " 25%, transparent 25%), 
					-ms-linear-gradient(45deg, " . $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg'] . " 25%, transparent 25%);
			background-image: -o-linear-gradient(135deg, " . $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg'] . " 25%, transparent 25%), 
					-o-linear-gradient(45deg, " . $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg'] . " 25%, transparent 25%);
			background-image: linear-gradient(315deg, " . $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg'] . " 25%, transparent 25%), 
					linear-gradient(45deg, " . $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg'] . " 25%, transparent 25%);
		}
		";
	}
	
	
	$custom_css .= "
	/* Finish Custom Rules */

/***************** Finish {$title} Color Scheme Rules ******************/


/***************** Start {$title} Button Color Scheme Rules ******************/
	
	{$rule}.cmsmasters_button.cmsmasters_but_bg_hover {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_bg_hover:hover {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
	}
	
	
	{$rule}.cmsmasters_button.cmsmasters_but_bd_underline {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_bd_underline:hover {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
	}
	
	
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_left, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_right, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_top, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_bottom, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_expand_vert, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_expand_hor, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_expand_diag {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_left:hover, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_right:hover, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_top:hover, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_bottom:hover, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_expand_vert:hover, 
	{$rule}.cmsmasters_button.cm.sms_but_bg_expand_hor:hover, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_expand_diag:hover {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_left:after, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_right:after, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_top:after, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_bottom:after, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_expand_vert:after, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_expand_hor:after, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_expand_diag:after {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
	}
	
	
	{$rule}.cmsmasters_button.cmsmasters_but_shadow {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_shadow:hover {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
	}
	
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_dark_bg, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_light_bg, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_divider {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_dark_bg:hover, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_light_bg:hover, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_divider:hover {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_divider:after {
		" . cmsmasters_color_css('border-right-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_inverse {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_inverse:before {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_inverse:after {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_inverse:hover {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_inverse:hover:before {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_inverse:hover:after {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
	}
	
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_slide_left, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_slide_right {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_slide_left:hover, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_slide_right:hover {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
	}
	
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_hover_slide_left, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_hover_slide_right, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_hover_slide_top, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_hover_slide_bottom {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_hover_slide_left:hover, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_hover_slide_right:hover, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_hover_slide_top:hover, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_hover_slide_bottom:hover {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
	}

/***************** Finish {$title} Button Color Scheme Rules ******************/


";
	}
	
	
	return apply_filters('blogosphere_theme_colors_primary_filter', $custom_css);
}

