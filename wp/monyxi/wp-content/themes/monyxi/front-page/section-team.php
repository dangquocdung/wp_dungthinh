<div class="front_page_section front_page_section_team<?php
			$monyxi_scheme = monyxi_get_theme_option('front_page_team_scheme');
			if (!monyxi_is_inherit($monyxi_scheme)) echo ' scheme_'.esc_attr($monyxi_scheme);
			echo ' front_page_section_paddings_'.esc_attr(monyxi_get_theme_option('front_page_team_paddings'));
		?>"<?php
		$monyxi_css = '';
		$monyxi_bg_image = monyxi_get_theme_option('front_page_team_bg_image');
		if (!empty($monyxi_bg_image)) 
			$monyxi_css .= 'background-image: url('.esc_url(monyxi_get_attachment_url($monyxi_bg_image)).');';
		if (!empty($monyxi_css))
			echo ' style="' . esc_attr($monyxi_css) . '"';
?>><?php
	// Add anchor
	$monyxi_anchor_icon = monyxi_get_theme_option('front_page_team_anchor_icon');	
	$monyxi_anchor_text = monyxi_get_theme_option('front_page_team_anchor_text');	
	if ((!empty($monyxi_anchor_icon) || !empty($monyxi_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_team"'
										. (!empty($monyxi_anchor_icon) ? ' icon="'.esc_attr($monyxi_anchor_icon).'"' : '')
										. (!empty($monyxi_anchor_text) ? ' title="'.esc_attr($monyxi_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_team_inner<?php
			if (monyxi_get_theme_option('front_page_team_fullheight'))
				echo ' monyxi-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$monyxi_css = '';
			$monyxi_bg_mask = monyxi_get_theme_option('front_page_team_bg_mask');
			$monyxi_bg_color = monyxi_get_theme_option('front_page_team_bg_color');
			if (!empty($monyxi_bg_color) && $monyxi_bg_mask > 0)
				$monyxi_css .= 'background-color: '.esc_attr($monyxi_bg_mask==1
																	? $monyxi_bg_color
																	: monyxi_hex2rgba($monyxi_bg_color, $monyxi_bg_mask)
																).';';
			if (!empty($monyxi_css))
				echo ' style="' . esc_attr($monyxi_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_team_content_wrap content_wrap">
			<?php
			// Caption
			$monyxi_caption = monyxi_get_theme_option('front_page_team_caption');
			if (!empty($monyxi_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><h2 class="front_page_section_caption front_page_section_team_caption front_page_block_<?php echo !empty($monyxi_caption) ? 'filled' : 'empty'; ?>"><?php echo wp_kses($monyxi_caption, 'monyxi_kses_content'); ?></h2><?php
			}
		
			// Description (text)
			$monyxi_description = monyxi_get_theme_option('front_page_team_description');
			if (!empty($monyxi_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_description front_page_section_team_description front_page_block_<?php echo !empty($monyxi_description) ? 'filled' : 'empty'; ?>"><?php echo wp_kses(wpautop($monyxi_description), 'monyxi_kses_content'); ?></div><?php
			}
		
			// Content (widgets)
			?><div class="front_page_section_output front_page_section_team_output"><?php 
				if (is_active_sidebar('front_page_team_widgets')) {
					dynamic_sidebar( 'front_page_team_widgets' );
				} else if (current_user_can( 'edit_theme_options' )) {
					if (!monyxi_exists_trx_addons())
						monyxi_customizer_need_trx_addons_message();
					else
						monyxi_customizer_need_widgets_message('front_page_team_caption', 'ThemeREX Addons - Team');
				}
			?></div>
		</div>
	</div>
</div>