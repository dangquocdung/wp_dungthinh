<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage MONYXI
 * @since MONYXI 1.0
 */

// Page (category, tag, archive, author) title

if ( monyxi_need_page_title() ) {
	monyxi_sc_layouts_showed('title', true);
	monyxi_sc_layouts_showed('postmeta', false);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( false && is_single() )  {
							?><div class="sc_layouts_title_meta"><?php
								monyxi_show_post_meta(apply_filters('monyxi_filter_post_meta_args', array(
									'components' => monyxi_array_get_keys_by_value(monyxi_get_theme_option('meta_parts')),
									'counters' => monyxi_array_get_keys_by_value(monyxi_get_theme_option('counters')),
									'seo' => monyxi_is_on(monyxi_get_theme_option('seo_snippets'))
									), 'header', 1)
								);
							?></div><?php
						}
						
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$monyxi_blog_title = monyxi_get_blog_title();
							$monyxi_blog_title_text = $monyxi_blog_title_class = $monyxi_blog_title_link = $monyxi_blog_title_link_text = '';
							if (is_array($monyxi_blog_title)) {
								$monyxi_blog_title_text = $monyxi_blog_title['text'];
								$monyxi_blog_title_class = !empty($monyxi_blog_title['class']) ? ' '.$monyxi_blog_title['class'] : '';
								$monyxi_blog_title_link = !empty($monyxi_blog_title['link']) ? $monyxi_blog_title['link'] : '';
								$monyxi_blog_title_link_text = !empty($monyxi_blog_title['link_text']) ? $monyxi_blog_title['link_text'] : '';
							} else
								$monyxi_blog_title_text = $monyxi_blog_title;
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr($monyxi_blog_title_class); ?>"><?php
								$monyxi_top_icon = monyxi_get_category_icon();
								if (!empty($monyxi_top_icon)) {
									$monyxi_attr = monyxi_getimagesize($monyxi_top_icon);
									?><img src="<?php echo esc_url($monyxi_top_icon); ?>" alt="<?php esc_attr_e('Site icon', 'monyxi'); ?>" <?php if (!empty($monyxi_attr[3])) monyxi_show_layout($monyxi_attr[3]);?>><?php
								}
								echo wp_kses($monyxi_blog_title_text, 'monyxi_kses_content');
							?></h1>
							<?php
							if (!empty($monyxi_blog_title_link) && !empty($monyxi_blog_title_link_text)) {
								?><a href="<?php echo esc_url($monyxi_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($monyxi_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'monyxi_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>