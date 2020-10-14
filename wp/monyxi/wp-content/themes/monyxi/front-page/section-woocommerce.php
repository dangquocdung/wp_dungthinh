<div class="front_page_section front_page_section_woocommerce<?php
			$monyxi_scheme = monyxi_get_theme_option('front_page_woocommerce_scheme');
			if (!monyxi_is_inherit($monyxi_scheme)) echo ' scheme_'.esc_attr($monyxi_scheme);
			echo ' front_page_section_paddings_'.esc_attr(monyxi_get_theme_option('front_page_woocommerce_paddings'));
		?>"<?php
		$monyxi_css = '';
		$monyxi_bg_image = monyxi_get_theme_option('front_page_woocommerce_bg_image');
		if (!empty($monyxi_bg_image)) 
			$monyxi_css .= 'background-image: url('.esc_url(monyxi_get_attachment_url($monyxi_bg_image)).');';
		if (!empty($monyxi_css))
			echo ' style="' . esc_attr($monyxi_css) . '"';
?>><?php
	// Add anchor
	$monyxi_anchor_icon = monyxi_get_theme_option('front_page_woocommerce_anchor_icon');	
	$monyxi_anchor_text = monyxi_get_theme_option('front_page_woocommerce_anchor_text');	
	if ((!empty($monyxi_anchor_icon) || !empty($monyxi_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_woocommerce"'
										. (!empty($monyxi_anchor_icon) ? ' icon="'.esc_attr($monyxi_anchor_icon).'"' : '')
										. (!empty($monyxi_anchor_text) ? ' title="'.esc_attr($monyxi_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_woocommerce_inner<?php
			if (monyxi_get_theme_option('front_page_woocommerce_fullheight'))
				echo ' monyxi-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$monyxi_css = '';
			$monyxi_bg_mask = monyxi_get_theme_option('front_page_woocommerce_bg_mask');
			$monyxi_bg_color = monyxi_get_theme_option('front_page_woocommerce_bg_color');
			if (!empty($monyxi_bg_color) && $monyxi_bg_mask > 0)
				$monyxi_css .= 'background-color: '.esc_attr($monyxi_bg_mask==1
																	? $monyxi_bg_color
																	: monyxi_hex2rgba($monyxi_bg_color, $monyxi_bg_mask)
																).';';
			if (!empty($monyxi_css))
				echo ' style="' . esc_attr($monyxi_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
			<?php
			// Content wrap with title and description
			$monyxi_caption = monyxi_get_theme_option('front_page_woocommerce_caption');
			$monyxi_description = monyxi_get_theme_option('front_page_woocommerce_description');
			if (!empty($monyxi_caption) || !empty($monyxi_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				// Caption
				if (!empty($monyxi_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo !empty($monyxi_caption) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses($monyxi_caption, 'monyxi_kses_content');
					?></h2><?php
				}
			
				// Description (text)
				if (!empty($monyxi_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo !empty($monyxi_description) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses(wpautop($monyxi_description), 'monyxi_kses_content');
					?></div><?php
				}
			}
		
			// Content (widgets)
			?><div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs"><?php 
				$monyxi_woocommerce_sc = monyxi_get_theme_option('front_page_woocommerce_products');
				if ($monyxi_woocommerce_sc == 'products') {
					$monyxi_woocommerce_sc_ids = monyxi_get_theme_option('front_page_woocommerce_products_per_page');
					$monyxi_woocommerce_sc_per_page = count(explode(',', $monyxi_woocommerce_sc_ids));
				} else {
					$monyxi_woocommerce_sc_per_page = max(1, (int) monyxi_get_theme_option('front_page_woocommerce_products_per_page'));
				}
				$monyxi_woocommerce_sc_columns = max(1, min($monyxi_woocommerce_sc_per_page, (int) monyxi_get_theme_option('front_page_woocommerce_products_columns')));
				echo do_shortcode("[{$monyxi_woocommerce_sc}"
									. ($monyxi_woocommerce_sc == 'products' 
											? ' ids="'.esc_attr($monyxi_woocommerce_sc_ids).'"' 
											: '')
									. ($monyxi_woocommerce_sc == 'product_category' 
											? ' category="'.esc_attr(monyxi_get_theme_option('front_page_woocommerce_products_categories')).'"' 
											: '')
									. ($monyxi_woocommerce_sc != 'best_selling_products' 
											? ' orderby="'.esc_attr(monyxi_get_theme_option('front_page_woocommerce_products_orderby')).'"'
											  . ' order="'.esc_attr(monyxi_get_theme_option('front_page_woocommerce_products_order')).'"' 
											: '')
									. ' per_page="'.esc_attr($monyxi_woocommerce_sc_per_page).'"' 
									. ' columns="'.esc_attr($monyxi_woocommerce_sc_columns).'"' 
									. ']');
			?></div>
		</div>
	</div>
</div>