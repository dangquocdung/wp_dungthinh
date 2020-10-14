<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage MONYXI
 * @since MONYXI 1.0.10
 */

$monyxi_footer_id = str_replace('footer-custom-', '', monyxi_get_theme_option("footer_style"));
if ((int) $monyxi_footer_id == 0) {
	$monyxi_footer_id = monyxi_get_post_id(array(
												'name' => $monyxi_footer_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
												)
											);
} else {
	$monyxi_footer_id = apply_filters('monyxi_filter_get_translated_layout', $monyxi_footer_id);
}
$monyxi_footer_meta = get_post_meta($monyxi_footer_id, 'trx_addons_options', true);
if (!empty($monyxi_footer_meta['margin']) != '') 
	monyxi_add_inline_css(sprintf('.page_content_wrap{padding-bottom:%s}', esc_attr(monyxi_prepare_css_value($monyxi_footer_meta['margin']))));
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($monyxi_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($monyxi_footer_id))); 
						if (!monyxi_is_inherit(monyxi_get_theme_option('footer_scheme')))
							echo ' scheme_' . esc_attr(monyxi_get_theme_option('footer_scheme'));
						?>">
	<?php
    // Custom footer's layout
    do_action('monyxi_action_show_layout', $monyxi_footer_id);
	?>
</footer><!-- /.footer_wrap -->
