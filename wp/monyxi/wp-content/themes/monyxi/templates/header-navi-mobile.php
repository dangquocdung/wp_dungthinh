<?php
/**
 * The template to show mobile menu
 *
 * @package WordPress
 * @subpackage MONYXI
 * @since MONYXI 1.0
 */
?>
<div class="menu_mobile_overlay"></div>
<div class="menu_mobile menu_mobile_<?php echo esc_attr(monyxi_get_theme_option('menu_mobile_fullscreen') > 0 ? 'fullscreen' : 'narrow'); ?> scheme_dark">
	<div class="menu_mobile_inner">
		<a class="menu_mobile_close icon-cancel"></a><?php

		// Logo
		set_query_var('monyxi_logo_args', array('type' => 'mobile'));
		get_template_part( apply_filters('monyxi_filter_get_template_part', 'templates/header-logo') );
		set_query_var('monyxi_logo_args', array());

		// Mobile menu
		$monyxi_menu_mobile = monyxi_get_nav_menu('menu_mobile');
		if (empty($monyxi_menu_mobile)) {
			$monyxi_menu_mobile = apply_filters('monyxi_filter_get_mobile_menu', '');
			if (empty($monyxi_menu_mobile)) $monyxi_menu_mobile = monyxi_get_nav_menu('menu_main');
			if (empty($monyxi_menu_mobile)) $monyxi_menu_mobile = monyxi_get_nav_menu();
		}
		if (!empty($monyxi_menu_mobile)) {
			if (!empty($monyxi_menu_mobile))
				$monyxi_menu_mobile = str_replace(
					array('menu_main', 'id="menu-', 'sc_layouts_menu_nav', 'sc_layouts_hide_on_mobile', 'hide_on_mobile'),
					array('menu_mobile', 'id="menu_mobile-', '', '', ''),
					$monyxi_menu_mobile
					);
			if (strpos($monyxi_menu_mobile, '<nav ')===false)
				$monyxi_menu_mobile = sprintf('<nav class="menu_mobile_nav_area">%s</nav>', $monyxi_menu_mobile);
			monyxi_show_layout(apply_filters('monyxi_filter_menu_mobile_layout', $monyxi_menu_mobile));
		}

		// Social icons
		monyxi_show_layout(monyxi_get_socials_links(), '<div class="socials_mobile">', '</div>');
		?>
	</div>
</div>
