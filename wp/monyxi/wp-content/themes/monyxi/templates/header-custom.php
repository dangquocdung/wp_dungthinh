<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage MONYXI
 * @since MONYXI 1.0.06
 */

$monyxi_header_css = '';
$monyxi_header_image = get_header_image();
$monyxi_header_video = monyxi_get_header_video();
if (!empty($monyxi_header_image) && monyxi_trx_addons_featured_image_override(is_singular() || monyxi_storage_isset('blog_archive') || is_category())) {
	$monyxi_header_image = monyxi_get_current_mode_image($monyxi_header_image);
}

$monyxi_header_id = str_replace('header-custom-', '', monyxi_get_theme_option("header_style"));
if ((int) $monyxi_header_id == 0) {
	$monyxi_header_id = monyxi_get_post_id(array(
												'name' => $monyxi_header_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
												)
											);
} else {
	$monyxi_header_id = apply_filters('monyxi_filter_get_translated_layout', $monyxi_header_id);
}
$monyxi_header_meta = get_post_meta($monyxi_header_id, 'trx_addons_options', true);
if (!empty($monyxi_header_meta['margin']) != '') 
	monyxi_add_inline_css(sprintf('.page_content_wrap{padding-top:%s}', esc_attr(monyxi_prepare_css_value($monyxi_header_meta['margin']))));

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($monyxi_header_id); 
				?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($monyxi_header_id)));
				echo !empty($monyxi_header_image) || !empty($monyxi_header_video) 
					? ' with_bg_image' 
					: ' without_bg_image';
				if ($monyxi_header_video!='') 
					echo ' with_bg_video';
				if ($monyxi_header_image!='') 
					echo ' '.esc_attr(monyxi_add_inline_css_class('background-image: url('.esc_url($monyxi_header_image).');'));
				if (is_single() && has_post_thumbnail()) 
					echo ' with_featured_image';
				if (monyxi_is_on(monyxi_get_theme_option('header_fullheight'))) 
					echo ' header_fullheight monyxi-full-height';
				if (!monyxi_is_inherit(monyxi_get_theme_option('header_scheme')))
					echo ' scheme_' . esc_attr(monyxi_get_theme_option('header_scheme'));
				?>"><?php

	// Background video
	if (!empty($monyxi_header_video)) {
		get_template_part( apply_filters('monyxi_filter_get_template_part', 'templates/header-video') );
	}
		
	// Custom header's layout
	do_action('monyxi_action_show_layout', $monyxi_header_id);

	// Header widgets area
	get_template_part( apply_filters('monyxi_filter_get_template_part', 'templates/header-widgets') );
		
?></header>