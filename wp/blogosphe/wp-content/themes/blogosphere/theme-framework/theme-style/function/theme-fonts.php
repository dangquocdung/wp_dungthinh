<?php
/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version 	1.0.3
 * 
 * Theme Fonts Rules
 * Created by CMSMasters
 * 
 */


function blogosphere_theme_fonts() {
	$cmsmasters_option = blogosphere_get_global_options();
	
	
	$custom_css = "/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version 	1.0.3
 * 
 * Theme Fonts Rules
 * Created by CMSMasters
 * 
 */


/***************** Start Theme Font Styles ******************/

	/* Start Content Font */
	body,
	#wp-calendar td, 
	.cmsmasters-form-builder label,
	.cmsmasters-form-builder small,
	.cmsmasters_mailpoet_form .mailpoet_paragraph,
	.cmsmasters_mailpoet_form .mailpoet_message {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_content_font_google_font']) . $cmsmasters_option['blogosphere' . '_content_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_content_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_content_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_content_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_content_font_font_style'] . ";
		letter-spacing:0;
	}
	
	#wp-calendar td, 
	.footer_copyright, 
	.cmsmasters_open_project .project_details_item_title, 
	.cmsmasters_open_project .project_features_item_title, 
	.cmsmasters_open_profile .profile_details_item_title, 
	.cmsmasters_open_profile .profile_features_item_title, 
	.post_comments .cmsmasters_comment_item_content, 
	.cmsmasters-form-builder label {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_content_font_font_size'] - 1) . "px;
	}
	
	.cmsmasters-form-builder small {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_content_font_font_size'] - 2) . "px;
		text-transform:none;
	}
	
	.cmsmasters_icon_list_items li:before {
		line-height:" . $cmsmasters_option['blogosphere' . '_content_font_line_height'] . "px;
	}
	/* Finish Content Font */


	/* Start Link Font */
	a,
	.subpage_nav > strong,
	.subpage_nav > span,
	.subpage_nav > a, 
	.subpage_nav > span:not([class]) {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_link_font_google_font']) . $cmsmasters_option['blogosphere' . '_link_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_link_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_link_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_link_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_link_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['blogosphere' . '_link_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['blogosphere' . '_link_font_text_decoration'] . ";
		letter-spacing:0;
	}
	/* Finish Link Font */


	/* Start Navigation Title Font */
	.navigation > li > a, 
	.top_line_nav > li > a, 
	.footer_nav > li > a {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_nav_title_font_google_font']) . $cmsmasters_option['blogosphere' . '_nav_title_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_nav_title_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_nav_title_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_nav_title_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_nav_title_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['blogosphere' . '_nav_title_font_text_transform'] . ";
		letter-spacing:0;
	}
	
	.cmsmasters_footer_small .footer_nav > li > a, 
	.top_line_nav > li > a {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_nav_title_font_font_size'] - 1) . "px;
	}
	
	/* Finish Navigation Title Font */


	/* Start Navigation Dropdown Font */
	.navigation ul li a,
	ul.navigation > li > a .nav_tag,
	ul.navigation > li > a .nav_subtitle,
	nav > div > ul div.menu-item-mega-container > ul > li > a, 
	.top_line_nav ul li a {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_nav_dropdown_font_google_font']) . $cmsmasters_option['blogosphere' . '_nav_dropdown_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_nav_dropdown_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_nav_dropdown_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_nav_dropdown_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_nav_dropdown_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['blogosphere' . '_nav_dropdown_font_text_transform'] . ";
		letter-spacing:0;
	}
	
	ul.navigation li a .nav_tag {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_nav_dropdown_font_font_size'] - 5) . "px;
		line-height:" . ((int) $cmsmasters_option['blogosphere' . '_nav_dropdown_font_line_height'] - 5) . "px;
	}
	
	nav > div > ul div.menu-item-mega-container > ul > li > a {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_nav_dropdown_font_font_size'] + 1) . "px;
	}
	
	ul.navigation li a .nav_subtitle {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_nav_dropdown_font_font_size'] - 1) . "px;
		text-transform:none;
	}
	
	.top_line_nav ul li a {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_nav_dropdown_font_font_size'] - 1) . "px;
	}
	
	.top_line_nav ul ul li a {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_nav_dropdown_font_font_size'] - 2) . "px;
	}
	
	/* Finish Navigation Dropdown Font */


	/* Start H1 Font */
	h1,
	h1 a,
	.logo .title, 
	.cmsmasters_post_timeline .cmsmasters_post_date .cmsmasters_day, 
	.cmsmasters_pricing_table .cmsmasters_price_wrap > span, 
	.cmsmasters_stats.stats_mode_circles .cmsmasters_stat_wrap .cmsmasters_stat .cmsmasters_stat_inner .cmsmasters_stat_counter_wrap, 
	.cmsmasters_counters .cmsmasters_counter_wrap .cmsmasters_counter .cmsmasters_counter_inner .cmsmasters_counter_counter_wrap,
	.cmsmasters_header_search_form input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]) {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_h1_font_google_font']) . $cmsmasters_option['blogosphere' . '_h1_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_h1_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_h1_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_h1_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_h1_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['blogosphere' . '_h1_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['blogosphere' . '_h1_font_text_decoration'] . ";
		" . ($cmsmasters_option['blogosphere' . '_h1_font_google_font'] != 'Montserrat:400,600,700' ? '' : 'letter-spacing:-2.4px;') . "
	}
	
	.cmsmasters_pricing_table .cmsmasters_price_wrap > span, 
	.cmsmasters_post_timeline .cmsmasters_post_date .cmsmasters_day, 
	.cmsmasters_header_search_form input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]) {
		letter-spacing:0;
	}
	
	.cmsmasters_pricing_table .cmsmasters_price_wrap > span, 
	.cmsmasters_post_timeline .cmsmasters_post_date .cmsmasters_day, 
	.cmsmasters_counters .cmsmasters_counter_wrap .cmsmasters_counter .cmsmasters_counter_inner .cmsmasters_counter_counter_wrap {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_h1_font_font_size'] - 4) . "px;
		line-height:" . ((int) $cmsmasters_option['blogosphere' . '_h1_font_line_height'] - 4) . "px;
	}
	
	.cmsmasters_icon_list_items.cmsmasters_icon_list_icon_type_number .cmsmasters_icon_list_item .cmsmasters_icon_list_icon:before,
	.cmsmasters_icon_box.box_icon_type_number:before,
	.cmsmasters_icon_box.cmsmasters_icon_heading_left.box_icon_type_number .icon_box_heading:before {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_h1_font_google_font']) . $cmsmasters_option['blogosphere' . '_h1_font_system_font'] . ";
		font-weight:" . $cmsmasters_option['blogosphere' . '_h1_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_h1_font_font_style'] . ";
	}
	/* Finish H1 Font */


	/* Start H2 Font */
	h2,
	h2 a,
	.cmsmasters_sitemap_wrap h1, 
	.cmsmasters_open_project .cmsmasters_project_title, 
	.cmsmasters_open_profile .cmsmasters_profile_title, 
	.cmsmasters_post_default .cmsmasters_post_title a, 
	.headline_outer .headline_inner .headline_text .entry-title, 
	.cmsmasters_sitemap_wrap .cmsmasters_sitemap > li > a {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_h2_font_google_font']) . $cmsmasters_option['blogosphere' . '_h2_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_h2_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_h2_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_h2_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_h2_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['blogosphere' . '_h2_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['blogosphere' . '_h2_font_text_decoration'] . ";
		" . ($cmsmasters_option['blogosphere' . '_h2_font_google_font'] != 'Montserrat:400,600,700' ? '' : 'letter-spacing:-1.8px;') . "
	}
	
	.headline_outer .headline_inner .headline_icon:before {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_h2_font_font_size'] - 2) . "px;
	}
	
	.headline_outer .headline_inner .headline_icon {
		padding-top:" . ((int) $cmsmasters_option['blogosphere' . '_h2_font_font_size'] - 4) . "px;
	}
	/* Finish H2 Font */


	/* Start H3 Font */
	h3, 
	h3 a, 
	.cmsmasters_archive_type .cmsmasters_archive_item_title, 
	.cmsmasters_archive_type .cmsmasters_archive_item_title a, 
	.cmsmasters_quotes_slider .cmsmasters_quote_title, 
	.cmsmasters_profile_vertical .cmsmasters_profile_header .cmsmasters_profile_title, 
	.cmsmasters_profile_vertical .cmsmasters_profile_header .cmsmasters_profile_title a, 
	.cmsmasters_project_grid .cmsmasters_project_header .cmsmasters_project_title, 
	.cmsmasters_project_grid .cmsmasters_project_header .cmsmasters_project_title a, 
	.cmsmasters_slider_project .cmsmasters_slider_project_title, 
	.cmsmasters_slider_project .cmsmasters_slider_project_title a, 
	.cmsmasters_project_puzzle .cmsmasters_project_header .cmsmasters_project_title, 
	.cmsmasters_project_puzzle .cmsmasters_project_header .cmsmasters_project_title a, 
	.cmsmasters_stats.stats_mode_circles .cmsmasters_stat_wrap .cmsmasters_stat_title {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_h3_font_google_font']) . $cmsmasters_option['blogosphere' . '_h3_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_h3_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_h3_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_h3_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_h3_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['blogosphere' . '_h3_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['blogosphere' . '_h3_font_text_decoration'] . ";
		" . ($cmsmasters_option['blogosphere' . '_h3_font_google_font'] != 'Montserrat:400,600,700' ? '' : 'letter-spacing:-1.2px;') . "
	}
	
	.cmsmasters_archive_type .cmsmasters_archive_item_title, 
	.cmsmasters_archive_type .cmsmasters_archive_item_title a, 
	.cmsmasters_post_puzzle .cmsmasters_post_title a {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_h3_font_font_size'] + 2) . "px;
		line-height:" . ((int) $cmsmasters_option['blogosphere' . '_h3_font_line_height'] + 2) . "px;
	}
	
	.cmsmasters_quotes_slider .cmsmasters_quote_title, 
	.cmsmasters_profile_vertical .cmsmasters_profile_header .cmsmasters_profile_title, 
	.cmsmasters_profile_vertical .cmsmasters_profile_header .cmsmasters_profile_title a {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_h3_font_font_size'] + 4) . "px;
		line-height:" . ((int) $cmsmasters_option['blogosphere' . '_h3_font_line_height'] + 4) . "px;
	}
	
	/* Finish H3 Font */


	/* Start H4 Font */
	h4, 
	h4 a, 
	#wp-calendar caption, 
	.post_nav .post_nav_title, 
	.widget_custom_popular_projects_entries .cmsmasters_slider_project_title a,
	.widget_custom_latest_projects_entries .cmsmasters_slider_project_title a,
	.cmsmasters_quotes_grid .cmsmasters_quote_title, 
	.cmsmasters_stats .cmsmasters_stat_wrap .cmsmasters_stat_title, 
	.cmsmasters_stats.stats_mode_bars .cmsmasters_stat_wrap .cmsmasters_stat .cmsmasters_stat_inner .cmsmasters_stat_counter_wrap, 
	.cmsmasters_sitemap_wrap .cmsmasters_sitemap > li > ul > li > a, 
	.cmsmasters_sitemap_wrap .cmsmasters_sitemap_category > li > a {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_h4_font_google_font']) . $cmsmasters_option['blogosphere' . '_h4_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_h4_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_h4_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_h4_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_h4_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['blogosphere' . '_h4_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['blogosphere' . '_h4_font_text_decoration'] . ";
		" . ($cmsmasters_option['blogosphere' . '_h4_font_google_font'] != 'Montserrat:400,600,700' ? '' : 'letter-spacing:-0.9px;') . "
	}
	
	.widget_custom_popular_projects_entries .cmsmasters_slider_project_title a,
	.widget_custom_latest_projects_entries .cmsmasters_slider_project_title a {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_h4_font_font_size'] + 2) . "px;
		line-height:" . ((int) $cmsmasters_option['blogosphere' . '_h4_font_line_height'] + 2) . "px;
	}
	
	.cmsmasters_stats.stats_mode_bars.stats_type_vertical .cmsmasters_stat_wrap .cmsmasters_stat {
		padding-top:" . ((int) $cmsmasters_option['blogosphere' . '_h4_font_line_height'] * 2 + 13) . "px;
	}
	
	.cmsmasters_stats.stats_mode_bars .cmsmasters_stat_wrap .cmsmasters_stat_container {
		height:" . ((int) $cmsmasters_option['blogosphere' . '_h4_font_line_height'] * 2 + 220 + 13) . "px;
	}
	/* Finish H4 Font */


	/* Start H5 Font */
	h5,
	h5 a, 
	figcaption, 
	figcaption a, 
	caption, 
	table thead th,
	table tfoot td,
	.widget .widgettitle, 
	.widget .widgettitle a, 
	#wp-calendar th, 
	#wp-calendar tfoot a, 
	.widget_custom_twitter_entries .tweet_time, 
	.cmsmasters_comment_item .comment-reply-link, 
	.about_author .about_author_title, 
	.cmsmasters_single_slider .cmsmasters_single_slider_title,
	.post_comments .post_comments_title, 
	.comment-respond .comment-reply-title, 
	.cmsmasters_twitter_wrap .published, 
	.cmsmasters_toggles .cmsmasters_toggle_title a, 
	.cmsmasters_tabs .cmsmasters_tabs_list_item a, 
	.cmsmasters_pricing_table .pricing_title, 
	.cmsmasters_slider_post .cmsmasters_slider_post_read_more, 
	.cmsmasters_post_default .cmsmasters_post_read_more, 
	.cmsmasters_post_puzzle .cmsmasters_post_read_more, 
	.cmsmasters_post_masonry .cmsmasters_post_read_more, 
	.cmsmasters_post_timeline .cmsmasters_post_read_more, 
	.cmsmasters_open_project .project_details_title, 
	.cmsmasters_open_project .project_features_title, 
	.cmsmasters_open_profile .profile_details_title, 
	.cmsmasters_open_profile .profile_features_title, 
	.cmsmasters_open_profile .profile_social_icons_title, 
	.cmsmasters_wrap_pagination ul li .page-numbers, 
	.cmsmasters-form-builder .form_info > label, 
	.wpcf7 label, 
	.headline_outer .headline_inner .headline_text .entry-subtitle, 
	.cmsmasters_img .cmsmasters_img_caption, 
	.cmsmasters_counters .cmsmasters_counter_wrap .cmsmasters_counter .cmsmasters_counter_inner .cmsmasters_counter_title {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_h5_font_google_font']) . $cmsmasters_option['blogosphere' . '_h5_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_h5_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_h5_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_h5_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_h5_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['blogosphere' . '_h5_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['blogosphere' . '_h5_font_text_decoration'] . ";
		letter-spacing:0;
	}
	
	.cmsmasters_twitter_wrap .published, 
	.widget_custom_twitter_entries .tweet_time, 
	.cmsmasters_comment_item .comment-reply-link, 
	.cmsmasters_post_default .cmsmasters_post_read_more, 
	.cmsmasters_post_puzzle .cmsmasters_post_read_more, 
	.cmsmasters_post_masonry .cmsmasters_post_read_more, 
	.cmsmasters_post_timeline .cmsmasters_post_read_more, 
	.widget_custom_posts_tabs_entries .cmsmasters_tabs .cmsmasters_tabs_list_item a, 
	.cmsmasters_slider_post .cmsmasters_slider_post_read_more {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_h5_font_font_size'] - 2) . "px;
		line-height:" . ((int) $cmsmasters_option['blogosphere' . '_h5_font_line_height'] - 2) . "px;
	}
	
	.cmsmasters_post_default .cmsmasters_post_sticky h5 {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_h5_font_font_size'] - 4) . "px;
		line-height:" . ((int) $cmsmasters_option['blogosphere' . '_h5_font_line_height'] - 4) . "px;
	}
	
	#wp-calendar tfoot a {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_h5_font_font_size'] - 3) . "px;
		line-height:" . ((int) $cmsmasters_option['blogosphere' . '_h5_font_line_height'] - 3) . "px;
	}
	
	.error .error_subtitle {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_h5_font_google_font']) . $cmsmasters_option['blogosphere' . '_h5_font_system_font'] . ";
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_h5_font_font_size'] + 5) . "px;
		line-height:" . ((int) $cmsmasters_option['blogosphere' . '_h5_font_line_height'] + 10) . "px;
		font-weight:normal;
		font-style:" . $cmsmasters_option['blogosphere' . '_h5_font_font_style'] . ";
		text-transform:none;
		text-decoration:none;
	}
	
	.comment-respond:before,
	.comment-respond:after,
	.post_comments:before,
	.post_comments:after {
		top:" . (((int) $cmsmasters_option['blogosphere' . '_h5_font_line_height'] / 2) + 5) . "px;
	}
	
	#wp-calendar th, 
	.cmsmasters_wrap_pagination ul li .page-numbers, 
	table tfoot td {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_h5_font_font_size'] - 1) . "px;
	}
	
	.cmsmasters_dropcap {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_h5_font_google_font']) . $cmsmasters_option['blogosphere' . '_h5_font_system_font'] . ";
		font-weight:" . $cmsmasters_option['blogosphere' . '_h5_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_h5_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['blogosphere' . '_h5_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['blogosphere' . '_h5_font_text_decoration'] . ";
	}
	
	.cmsmasters_dropcap.type1 {
		font-size:50px;
	}
	
	.cmsmasters_dropcap.type2 {
		font-size:25px;
	}
	/* Finish H5 Font */


	/* Start H6 Font */
	h6,
	h6 a,
	.comment-respond .comment-form-cookies-consent label,
	.widget_rss ul li .rsswidget, 
	.widget_custom_posts_tabs_entries .cmsmasters_tabs .cmsmasters_lpr_tabs_cont > a, 
	.cmsmasters_comment_item .cmsmasters_comment_item_title a, 
	.cmsmasters_comment_item .cmsmasters_comment_item_title {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_h6_font_google_font']) . $cmsmasters_option['blogosphere' . '_h6_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_h6_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_h6_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_h6_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_h6_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['blogosphere' . '_h6_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['blogosphere' . '_h6_font_text_decoration'] . ";
		" . ($cmsmasters_option['blogosphere' . '_h6_font_google_font'] != 'Montserrat:400,600,700' ? '' : 'letter-spacing:-0.7px;') . "
	}
	
	.cmsmasters_comment_item .cmsmasters_comment_item_title a, 
	.cmsmasters_comment_item .cmsmasters_comment_item_title {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_h6_font_font_size'] + 1) . "px;
	}
	
	.comment-respond .comment-form-cookies-consent label {
		font-weight:normal;
	}
	/* Finish H6 Font */


	/* Start Button Font */
	.error .error_button, 
	.cmsmasters_button, 
	.button, 
	input[type=submit], 
	input[type=button], 
	button {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_button_font_google_font']) . $cmsmasters_option['blogosphere' . '_button_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_button_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_button_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_button_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_button_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['blogosphere' . '_button_font_text_transform'] . ";
		letter-spacing:0;
	}
	
	.gform_wrapper .gform_footer input.button, 
	.gform_wrapper .gform_footer input[type=submit] {
		font-size:" . $cmsmasters_option['blogosphere' . '_button_font_font_size'] . "px !important;
	}
	
	.cmsmasters_items_filter_wrap .button {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_button_font_font_size'] + 1) . "px;
	}
	
	.cmsmasters_button.cmsmasters_but_icon_dark_bg, 
	.cmsmasters_button.cmsmasters_but_icon_light_bg, 
	.cmsmasters_button.cmsmasters_but_icon_divider, 
	.cmsmasters_button.cmsmasters_but_icon_inverse {
		padding-left:" . ((int) $cmsmasters_option['blogosphere' . '_button_font_line_height'] + 20) . "px;
	}
	
	.cmsmasters_button.cmsmasters_but_icon_dark_bg:before, 
	.cmsmasters_button.cmsmasters_but_icon_light_bg:before, 
	.cmsmasters_button.cmsmasters_but_icon_divider:before, 
	.cmsmasters_button.cmsmasters_but_icon_inverse:before, 
	.cmsmasters_button.cmsmasters_but_icon_dark_bg:after, 
	.cmsmasters_button.cmsmasters_but_icon_light_bg:after, 
	.cmsmasters_button.cmsmasters_but_icon_divider:after, 
	.cmsmasters_button.cmsmasters_but_icon_inverse:after {
		width:" . $cmsmasters_option['blogosphere' . '_button_font_line_height'] . "px;
	}
	/* Finish Button Font */


	/* Start Small Text Font */
	small, 
	.cmsmasters_likes, 
	.cmsmasters_likes a, 
	.cmsmasters_views, 
	.cmsmasters_comments,
	.cmsmasters_comments a,
	.widget_pages ul li a, 
	.widget_categories ul li a, 
	.widget_archive ul li a, 
	.widget_meta ul li a, 
	.widget_recent_entries ul li a,
	.widget_nav_menu li a, 
	.widget_rss ul li .rss-date,
	.cmsmasters_archive_type .cmsmasters_archive_item_type, 
	.widget_custom_posts_tabs_entries .cmsmasters_tabs .cmsmasters_lpr_tabs_cont > .published, 
	.comment-respond .comment-reply-title small a, 
	.cmsmasters_comment_item .comment-edit-link, 
	.cmsmasters_comment_item .cmsmasters_comment_item_date, 
	.about_author .about_author_cont .cmsmasters_author_website, 
	.cmsmasters_post_timeline .cmsmasters_post_date .cmsmasters_mon, 
	.cmsmasters_open_post .cmsmasters_post_date,
	.cmsmasters_open_post .cmsmasters_post_author,
	.cmsmasters_open_post .cmsmasters_post_author a,
	.cmsmasters_open_post .cmsmasters_post_category, 
	.cmsmasters_open_post .cmsmasters_post_category a, 
	.cmsmasters_single_slider .cmsmasters_post_date, 
	.cmsmasters_post_default .cmsmasters_post_info > a, 
	.cmsmasters_post_default .cmsmasters_post_date,
	.cmsmasters_post_default .cmsmasters_post_author,
	.cmsmasters_post_default .cmsmasters_post_author a,
	.cmsmasters_post_default .cmsmasters_post_cont_info a, 
	.cmsmasters_post_masonry .cmsmasters_post_category,
	.cmsmasters_post_masonry .cmsmasters_post_category a,
	.cmsmasters_post_masonry .cmsmasters_post_cont_info,
	.cmsmasters_post_masonry .cmsmasters_post_cont_info a,
	.cmsmasters_post_puzzle .cmsmasters_post_category,
	.cmsmasters_post_puzzle .cmsmasters_post_category a,
	.cmsmasters_post_puzzle .cmsmasters_post_footer,
	.cmsmasters_post_puzzle .cmsmasters_post_footer a,
	.cmsmasters_post_timeline .cmsmasters_post_category,
	.cmsmasters_post_timeline .cmsmasters_post_category a,
	.cmsmasters_post_timeline .cmsmasters_post_cont_info,
	.cmsmasters_post_timeline .cmsmasters_post_cont_info a,
	.cmsmasters_toggles .cmsmasters_toggles_filter, 
	.cmsmasters_toggles .cmsmasters_toggles_filter a, 
	.cmsmasters_icon_wrap .cmsmasters_simple_icon_title, 
	.cmsmasters_quotes_grid .cmsmasters_quote_subtitle_wrap,
	.cmsmasters_quotes_grid .cmsmasters_quote_subtitle_wrap .cmsmasters_quote_subtitle,
	.cmsmasters_quotes_grid .cmsmasters_quote_subtitle_wrap a,
	.cmsmasters_quotes_slider .cmsmasters_quote_subtitle_wrap,
	.cmsmasters_quotes_slider .cmsmasters_quote_subtitle_wrap .cmsmasters_quote_subtitle,
	.cmsmasters_quotes_slider .cmsmasters_quote_subtitle_wrap a,
	.cmsmasters_profile_vertical .cmsmasters_profile_header .cmsmasters_profile_subtitle,
	.cmsmasters_profile_horizontal .cmsmasters_profile_header .cmsmasters_profile_subtitle,
	.cmsmasters_pricing_table .cmsmasters_price_wrap .cmsmasters_period, 
	.cmsmasters_slider_post .cmsmasters_slider_post_cont_info > span, 
	.cmsmasters_slider_post .cmsmasters_slider_post_cont_info > span a, 
	.cmsmasters_slider_post .cmsmasters_slider_post_category a, 
	.cmsmasters_slider_project .cmsmasters_slider_project_category a, 
	.cmsmasters_project_puzzle .cmsmasters_project_category, 
	.cmsmasters_project_puzzle .cmsmasters_project_category a, 
	.cmsmasters_project_grid .cmsmasters_project_category,
	.cmsmasters_project_grid .cmsmasters_project_category a,
	.cmsmasters_breadcrumbs .cmsmasters_breadcrumbs_inner, 
	.cmsmasters_breadcrumbs .cmsmasters_breadcrumbs_inner a, 
	.cmsmasters_open_project .project_details_item_desc, 
	.cmsmasters_open_project .project_details_item_desc a, 
	.cmsmasters_open_project .project_features_item_desc, 
	.cmsmasters_open_project .project_features_item_desc a, 
	.cmsmasters_open_profile .profile_details_item_desc, 
	.cmsmasters_open_profile .profile_details_item_desc a, 
	.cmsmasters_open_profile .profile_features_item_desc, 
	.cmsmasters_open_profile .profile_features_item_desc a, 
	.cmsmasters_open_profile .cmsmasters_profile_subtitle, 
	.cmsmasters_archive_type .cmsmasters_archive_item_info > span, 
	.cmsmasters_archive_type .cmsmasters_archive_item_info > span a, 
	.cmsmasters_dynamic_cart .count, 
	.share_posts .share_posts_title, 
	.share_posts .share_posts_inner,
	.share_posts, 
	.post_nav .post_nav_sub, 
	.cmsmasters_open_project .cmsmasters_project_tags, 
	.cmsmasters_open_project .cmsmasters_project_tags > a, 
	.cmsmasters_open_post .cmsmasters_post_tags, 
	.cmsmasters_open_post .cmsmasters_post_tags > a,
	.cmsmasters_dynamic_cart_link_wrap .count, 
	form .formError .formErrorContent {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_small_font_google_font']) . $cmsmasters_option['blogosphere' . '_small_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_small_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_small_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_small_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_small_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['blogosphere' . '_small_font_text_transform'] . ";
		letter-spacing:0;
	}
	
	.widget_tag_cloud a {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_small_font_google_font']) . $cmsmasters_option['blogosphere' . '_small_font_system_font'] . ";
		font-weight:" . $cmsmasters_option['blogosphere' . '_small_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_small_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['blogosphere' . '_small_font_text_transform'] . ";
	}
	
	.widget_pages ul li a, 
	.widget_categories ul li a, 
	.widget_archive ul li a, 
	.widget_meta ul li a, 
	.widget_recent_entries ul li a, 
	.widget_nav_menu li a, 
	.cmsmasters_post_puzzle .cmsmasters_post_footer,
	.cmsmasters_post_puzzle .cmsmasters_post_footer a,
	.cmsmasters_post_default .cmsmasters_post_cont_info a, 
	.cmsmasters_icon_wrap .cmsmasters_simple_icon_title, 
	.cmsmasters_open_profile .cmsmasters_profile_subtitle, 
	.cmsmasters_archive_type .cmsmasters_archive_item_type, 
	.cmsmasters_slider_post .cmsmasters_slider_post_category a {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_small_font_font_size'] + 1) . "px;
	}
	
	.cmsmasters_post_puzzle .cmsmasters_post_category a {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_small_font_font_size'] + 2) . "px;
		line-height:" . ((int) $cmsmasters_option['blogosphere' . '_small_font_line_height'] + 2) . "px;
	}
	
	.cmsmasters_open_project .project_details_item_desc, 
	.cmsmasters_open_project .project_details_item_desc a, 
	.cmsmasters_open_project .project_features_item_desc, 
	.cmsmasters_open_project .project_features_item_desc a, 
	.cmsmasters_open_profile .profile_details_item_desc, 
	.cmsmasters_open_profile .profile_details_item_desc a, 
	.cmsmasters_open_profile .profile_features_item_desc, 
	.cmsmasters_open_profile .profile_features_item_desc a, 
	.cmsmasters_comment_item .comment-edit-link, 
	.about_author .about_author_cont .cmsmasters_author_website {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_small_font_font_size'] - 1) . "px;
	}
	
	.cmsmasters_dynamic_cart .count, 
	.cmsmasters_dynamic_cart_link_wrap .count {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_small_font_font_size'] - 2) . "px;
		line-height:" . ((int) $cmsmasters_option['blogosphere' . '_small_font_line_height'] - 2) . "px;
	}
	
	form .formError .formErrorContent {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_small_font_font_size'] - 3) . "px;
		line-height:" . ((int) $cmsmasters_option['blogosphere' . '_small_font_line_height'] - 3) . "px;
	}
	
	.header_top .meta_wrap, 
	.header_top .meta_wrap a {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_small_font_google_font']) . $cmsmasters_option['blogosphere' . '_small_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_small_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_small_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_small_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_small_font_font_style'] . ";
	}
	
	.gform_wrapper .description, 
	.gform_wrapper .gfield_description, 
	.gform_wrapper .gsection_description, 
	.gform_wrapper .instruction {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_small_font_google_font']) . $cmsmasters_option['blogosphere' . '_small_font_system_font'] . " !important;
		font-size:" . $cmsmasters_option['blogosphere' . '_small_font_font_size'] . "px !important;
		line-height:" . $cmsmasters_option['blogosphere' . '_small_font_line_height'] . "px !important;
	}
	/* Finish Small Text Font */


	/* Start Text Fields Font */
	input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]),
	textarea,
	select,
	option {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_input_font_google_font']) . $cmsmasters_option['blogosphere' . '_input_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_input_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_input_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_input_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_input_font_font_style'] . ";
		letter-spacing:0;
	}
	
	.gform_wrapper input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]),
	.gform_wrapper textarea, 
	.gform_wrapper select {
		font-size:" . $cmsmasters_option['blogosphere' . '_input_font_font_size'] . "px !important;
	}
	/* Finish Text Fields Font */


	/* Start Blockquote Font */
	.cmsmasters_quotes_slider .cmsmasters_quote_content, 
	blockquote {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_quote_font_google_font']) . $cmsmasters_option['blogosphere' . '_quote_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_quote_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_quote_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_quote_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_quote_font_font_style'] . ";
		letter-spacing:0;
	}
	
	.cmsmasters_quotes_slider .cmsmasters_quote_content {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_quote_font_font_size'] + 4) . "px;
		line-height:" . ((int) $cmsmasters_option['blogosphere' . '_quote_font_line_height'] + 4) . "px;
	}
	
	.cmsmasters_quotes_slider .cmsmasters_quote_noimg:before {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_quote_font_google_font']) . $cmsmasters_option['blogosphere' . '_quote_font_system_font'] . ";
	}
	
	q {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_quote_font_google_font']) . $cmsmasters_option['blogosphere' . '_quote_font_system_font'] . ";
		font-weight:" . $cmsmasters_option['blogosphere' . '_quote_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_quote_font_font_style'] . ";
	}
	/* Finish Blockquote Font */

/***************** Finish Theme Font Styles ******************/


";
	
	
	return apply_filters('blogosphere_theme_fonts_filter', $custom_css);
}

