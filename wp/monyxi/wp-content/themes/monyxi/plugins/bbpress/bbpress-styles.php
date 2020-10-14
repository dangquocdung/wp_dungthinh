<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( !function_exists( 'monyxi_bbpress_get_css' ) ) {
	add_filter( 'monyxi_filter_get_css', 'monyxi_bbpress_get_css', 10, 2 );
	function monyxi_bbpress_get_css($css, $args) {
		if (isset($css['fonts']) && isset($args['fonts'])) {
			$fonts = $args['fonts'];
			$css['fonts'] .= <<<CSS

/* Buttons */
#buddypress .comment-reply-link,
#buddypress .generic-button a,
#buddypress a.button,
#buddypress button,
#buddypress input[type="button"],
#buddypress input[type="reset"],
#buddypress input[type="submit"],
#buddypress ul.button-nav li a,
a.bp-title-button,
#buddypress #item-nav ul li {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}
#bbpress-forums li.bbp-header,
#bbpress-forums li.bbp-footer,
.bbp-forums .bbp-forum-title,
li.bbp-topic-title .bbp-topic-permalink {
	{$fonts['h6_font-family']}
	{$fonts['h6_font-size']}

	{$fonts['h6_font-style']}
	{$fonts['h6_line-height']}
	{$fonts['h6_text-decoration']}
	{$fonts['h6_text-transform']}
	{$fonts['h6_letter-spacing']}
}
.bbp-meta .bbp-reply-post-date,
#buddypress table.profile-fields tr td.data,
#buddypress .current-visibility-level,
#buddypress div#item-header div#item-meta,
#buddypress .activity-list .activity-content .activity-inner  {
	{$fonts['info_font-family']}
}
#buddypress div.dir-search input[type="search"],
#buddypress div.dir-search input[type="text"],
#buddypress li.groups-members-search input[type="search"],
#buddypress li.groups-members-search input[type="text"],
#buddypress .standard-form input[type="color"],
#buddypress .standard-form input[type="date"],
#buddypress .standard-form input[type="datetime-local"],
#buddypress .standard-form input[type="datetime"],
#buddypress .standard-form input[type="email"],
#buddypress .standard-form input[type="month"],
#buddypress .standard-form input[type="number"],
#buddypress .standard-form input[type="password"],
#buddypress .standard-form input[type="range"],
#buddypress .standard-form input[type="search"],
#buddypress .standard-form input[type="tel"],
#buddypress .standard-form input[type="text"],
#buddypress .standard-form input[type="time"],
#buddypress .standard-form input[type="url"],
#buddypress .standard-form input[type="week"],
#buddypress .standard-form select,
#buddypress .standard-form textarea,
#bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content {
	{$fonts['input_font-family']}
	{$fonts['input_font-size']}
	{$fonts['input_font-weight']}
	{$fonts['input_font-style']}
	{$fonts['input_line-height']}
	{$fonts['input_text-decoration']}
	{$fonts['input_text-transform']}
	{$fonts['input_letter-spacing']}
}

CSS;
		}

		if (isset($css['vars']) && isset($args['vars'])) {
			$vars = $args['vars'];
			$css['vars'] .= <<<CSS
			
/* Buttons */
#buddypress .comment-reply-link,
#buddypress .generic-button a,
#buddypress a.button,
#buddypress button,
#buddypress input[type="button"],
#buddypress input[type="reset"],
#buddypress input[type="submit"],
#buddypress ul.button-nav li a,
#buddypress div.activity-meta a,
.bbpress_style_callouts #bbpress-forums div.bbp-reply-content,
a.bp-title-button {
	-webkit-border-radius: {$vars['rad']};
	    -ms-border-radius: {$vars['rad']};
			border-radius: {$vars['rad']};
}
.bbp_widget_login .bbp-logged-in img.avatar,
.bp-login-widget-user-avatar img.avatar,
.widget.buddypress div.item-avatar img.avatar,
.bbpress_style_callouts #bbpress-forums div.bbp-reply-author img.avatar {
	-webkit-border-radius: {$vars['rad50']};
	    -ms-border-radius: {$vars['rad50']};
			border-radius: {$vars['rad50']};
}
/* Fields */
#buddypress .dir-search input[type=search], #buddypress .dir-search input[type=text], #buddypress .groups-members-search input[type=search], #buddypress .groups-members-search input[type=text], #buddypress .standard-form input[type=color], #buddypress .standard-form input[type=date], #buddypress .standard-form input[type=datetime-local], #buddypress .standard-form input[type=datetime], #buddypress .standard-form input[type=email], #buddypress .standard-form input[type=month], #buddypress .standard-form input[type=number], #buddypress .standard-form input[type=password], #buddypress .standard-form input[type=range], #buddypress .standard-form input[type=search], #buddypress .standard-form input[type=tel], #buddypress .standard-form input[type=text], #buddypress .standard-form input[type=time], #buddypress .standard-form input[type=url], #buddypress .standard-form input[type=week], #buddypress .standard-form select, #buddypress .standard-form textarea {
	-webkit-border-radius: {$vars['rad']};
	    -ms-border-radius: {$vars['rad']};
			border-radius: {$vars['rad']};
}
CSS;
		}



		if (isset($css['colors']) && isset($args['colors'])) {
			$colors = $args['colors'];
			$css['colors'] .= <<<CSS

/* BBPress
---------------------------------------------------- */

/* Forums list */
#bbpress-forums ul.bbp-lead-topic,
#bbpress-forums ul.bbp-topics,
#bbpress-forums ul.bbp-forums,
#bbpress-forums ul.bbp-replies,
#bbpress-forums ul.bbp-search-results {
	border-color: {$colors['bd_color']};
}
#bbpress-forums .bbp-header div.bbp-reply-content a {
    color: {$colors['extra_link']};
}
.bbp-admin-links a:hover,
#bbpress-forums div.bbp-reply-content a:hover {
    color: {$colors['text_hover']};
}
#bbpress-forums li.bbp-header,
#bbpress-forums li.bbp-footer {
	background: {$colors['extra_bg_color']};
	border-color: {$colors['extra_bg_color']};
	color: {$colors['extra_link']};
}
.bbpress_style_light #bbpress-forums li.bbp-header,
.bbpress_style_light #bbpress-forums li.bbp-footer,
.bbpress_style_callouts #bbpress-forums li.bbp-header,
.bbpress_style_callouts #bbpress-forums li.bbp-footer {
	background: {$colors['alter_bg_color']};
}
#bbpress-forums li.bbp-body ul.forum,
#bbpress-forums li.bbp-body ul.topic {
    border-color: {$colors['bd_color']};
}
.bbpress_style_light #bbpress-forums li.bbp-body ul.forum,
.bbpress_style_light #bbpress-forums li.bbp-body ul.topic,
.bbpress_style_callouts #bbpress-forums li.bbp-body ul.forum,
.bbpress_style_callouts #bbpress-forums li.bbp-body ul.topic {
    border-color: {$colors['bd_color']};
}
#bbpress-forums div.odd,
#bbpress-forums ul.odd,
#bbpress-forums div.even,
#bbpress-forums ul.even {
	color: {$colors['text']};
	background-color: {$colors['bg_color']};
}
.bbpress_style_light #bbpress-forums div.odd,
.bbpress_style_light #bbpress-forums ul.odd,
.bbpress_style_light #bbpress-forums div.even,
.bbpress_style_light #bbpress-forums ul.even,
.bbpress_style_callouts #bbpress-forums div.odd,
.bbpress_style_callouts #bbpress-forums ul.odd,
.bbpress_style_callouts #bbpress-forums div.even,
.bbpress_style_callouts #bbpress-forums ul.even {
	color: {$colors['text']};
	background-color: transparent;
}

/* Single forum */
#bbpress-forums div.bbp-forum-header,
#bbpress-forums div.bbp-topic-header{
	color: {$colors['alter_text']};
	border-color: {$colors['bd_color']};
	background-color: {$colors['alter_bg_color']};
}
#bbpress-forums div.bbp-reply-header {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_hover']};
	border-color: {$colors['bg_color']};
}
.bbpress_style_callouts #bbpress-forums div.bbp-reply-header {
	color: {$colors['text_light']};
	background-color: transparent;
}
.bbpress_style_callouts #bbpress-forums div.bbp-reply-header a,
.bbpress_style_callouts #bbpress-forums div.bbp-reply-header .bbp-admin-links {
	color: {$colors['text_light']};
}
.bbpress_style_callouts #bbpress-forums div.bbp-reply-header a:hover {
	color: {$colors['text_dark']};
}
.bbpress_style_callouts #bbpress-forums .bbp-body div.bbp-reply-content {
	border-color: {$colors['bd_color']};
}
.bbpress_style_callouts.type-topic #bbpress-forums ul.bbp-replies .bbp-body .bbp-reply-content:before {
	border-color: {$colors['bd_color']};
	background-color: {$colors['bg_color']};
}

span.bbp-admin-links {
	color: {$colors['alter_text']};
}
.bbp-forum-header a.bbp-forum-permalink,
.bbp-topic-header a.bbp-topic-permalink,
.bbp-reply-header a.bbp-reply-permalink {
	color: {$colors['text_hover']};
}
.bbp-forum-header a.bbp-forum-permalink:hover,
.bbp-topic-header a.bbp-topic-permalink:hover,
.bbp-reply-header a.bbp-reply-permalink:hover {
	color: {$colors['text_link']};
}

#bbpress-forums fieldset.bbp-form {
	border-color: {$colors['bd_color']};
}
.quicktags-toolbar {
    background: {$colors['alter_bg_hover']};
    border-color: {$colors['alter_bd_hover']};
}


/* Buddy Press
---------------------------------------------------- */

/* Tabs */
#buddypress div.item-list-tabs ul li a {
	color: {$colors['alter_dark']};
	background-color: {$colors['alter_bg_color']};
}
#buddypress div.item-list-tabs ul li a:hover,
#buddypress div.item-list-tabs ul li.current a,
#buddypress div.item-list-tabs ul li.selected a {
	color: {$colors['inverse_dark']};
	background-color: {$colors['alter_link']};
}

#buddypress #header-cover-image {
	background-color: {$colors['alter_bg_color']};
}
#buddypress div#item-header-cover-image .user-nicename a, 
#buddypress div#item-header-cover-image .user-nicename {
	color: {$colors['alter_dark']};
}
#buddypress #item-header-cover-image #item-header-avatar img.avatar {
	border-color: {$colors['alter_bd_color']};
}

#buddypress div#item-header div#item-meta {
	color: {$colors['alter_light']};
}

#buddypress table.notifications,
#buddypress table.notifications tr td,
#buddypress table.notifications tr th {
	border-color: {$colors['alter_bd_color']};
}
#buddypress table.notifications tr th {
	color: {$colors['alter_dark']};
	background-color: {$colors['alter_bg_color']};
}
#buddypress table.profile-fields tr td,
#buddypress table.profile-fields tr th {
	color: {$colors['text_dark']};
}

#buddypress ul.item-list,
#buddypress ul.item-list li,
#buddypress table.forum tr td.label,
#buddypress table.messages-notices tr td.label,
#buddypress table.notifications tr td.label,
#buddypress table.notifications-settings tr td.label,
#buddypress table.profile-fields tr td.label,
#buddypress table.wp-profile-fields tr td.label,
.activity-list li.bbp_topic_create .activity-content .activity-inner,
.activity-list li.bbp_reply_create .activity-content .activity-inner {
	border-color: {$colors['bd_color']};
}

/* Widgets
----------------------------------- */
.widget_bp_core_login_widget .bp-login-widget-user-link a {
	color: {$colors['alter_dark']};
}
.widget_bp_core_login_widget .bp-login-widget-user-link a:hover {
	color: {$colors['alter_link']};
}

.widget_bp_core_members_widget #members-list li .item-title a {
	color: {$colors['alter_dark']};
}
.widget_bp_core_members_widget #members-list li .item-title a:hover {
	color: {$colors['alter_link']};
}
.widget_bp_core_members_widget #members-list-options a {
	color: {$colors['bg_color']};
	background-color: {$colors['alter_dark']};
}
.widget_bp_core_members_widget #members-list-options a:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['alter_link']};
}
.widget_bp_core_members_widget #members-list-options a.selected,
.widget_bp_core_members_widget #members-list-options a.selected:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['alter_hover']};
}




#bbpress-forums .bbp-forum-info .bbp-forum-content {
    color: {$colors['text']};
}
.bbp-author-name {
     color: {$colors['text']};
}
#bbp-user-navigation li a:hover,
.bbp-topics li a:hover,
.bbp-forums li a:hover,
.bbp-forum-info .bbp-forum-title:hover,
.bbp-author-name:hover {
     color: {$colors['text_hover']};
}






CSS;
		}
		
		return $css;
	}
}
?>