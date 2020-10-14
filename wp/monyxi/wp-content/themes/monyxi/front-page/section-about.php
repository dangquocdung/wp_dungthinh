<div class="front_page_section front_page_section_about<?php
			$monyxi_scheme = monyxi_get_theme_option('front_page_about_scheme');
			if (!monyxi_is_inherit($monyxi_scheme)) echo ' scheme_'.esc_attr($monyxi_scheme);
			echo ' front_page_section_paddings_'.esc_attr(monyxi_get_theme_option('front_page_about_paddings'));
		?>"<?php
		$monyxi_css = '';
		$monyxi_bg_image = monyxi_get_theme_option('front_page_about_bg_image');
		if (!empty($monyxi_bg_image)) 
			$monyxi_css .= 'background-image: url('.esc_url(monyxi_get_attachment_url($monyxi_bg_image)).');';
		if (!empty($monyxi_css))
			echo ' style="' . esc_attr($monyxi_css) . '"';
?>><?php
	// Add anchor
	$monyxi_anchor_icon = monyxi_get_theme_option('front_page_about_anchor_icon');	
	$monyxi_anchor_text = monyxi_get_theme_option('front_page_about_anchor_text');	
	if ((!empty($monyxi_anchor_icon) || !empty($monyxi_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_about"'
										. (!empty($monyxi_anchor_icon) ? ' icon="'.esc_attr($monyxi_anchor_icon).'"' : '')
										. (!empty($monyxi_anchor_text) ? ' title="'.esc_attr($monyxi_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_about_inner<?php
			if (monyxi_get_theme_option('front_page_about_fullheight'))
				echo ' monyxi-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$monyxi_css = '';
			$monyxi_bg_mask = monyxi_get_theme_option('front_page_about_bg_mask');
			$monyxi_bg_color = monyxi_get_theme_option('front_page_about_bg_color');
			if (!empty($monyxi_bg_color) && $monyxi_bg_mask > 0)
				$monyxi_css .= 'background-color: '.esc_attr($monyxi_bg_mask==1
																	? $monyxi_bg_color
																	: monyxi_hex2rgba($monyxi_bg_color, $monyxi_bg_mask)
																).';';
			if (!empty($monyxi_css))
				echo ' style="' . esc_attr($monyxi_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_about_content_wrap content_wrap">
			<?php
			// Caption
			$monyxi_caption = monyxi_get_theme_option('front_page_about_caption');
			if (!empty($monyxi_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><h2 class="front_page_section_caption front_page_section_about_caption front_page_block_<?php echo !empty($monyxi_caption) ? 'filled' : 'empty'; ?>"><?php echo wp_kses($monyxi_caption, 'monyxi_kses_content'); ?></h2><?php
			}
		
			// Description (text)
			$monyxi_description = monyxi_get_theme_option('front_page_about_description');
			if (!empty($monyxi_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_description front_page_section_about_description front_page_block_<?php echo !empty($monyxi_description) ? 'filled' : 'empty'; ?>"><?php echo wp_kses(wpautop($monyxi_description), 'monyxi_kses_content'); ?></div><?php
			}
			
			// Content
			$monyxi_content = monyxi_get_theme_option('front_page_about_content');
			if (!empty($monyxi_content) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_content front_page_section_about_content front_page_block_<?php echo !empty($monyxi_content) ? 'filled' : 'empty'; ?>"><?php
					$monyxi_page_content_mask = '%%CONTENT%%';
					if (strpos($monyxi_content, $monyxi_page_content_mask) !== false) {
						$monyxi_content = preg_replace(
									'/(\<p\>\s*)?'.$monyxi_page_content_mask.'(\s*\<\/p\>)/i',
									sprintf('<div class="front_page_section_about_source">%s</div>',
												apply_filters('the_content', get_the_content())),
									$monyxi_content
									);
					}
					monyxi_show_layout($monyxi_content);
				?></div><?php
			}
			?>
		</div>
	</div>
</div>