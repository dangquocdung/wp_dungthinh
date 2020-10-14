<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage MONYXI
 * @since MONYXI 1.0.10
 */

// Footer sidebar
$monyxi_footer_name = monyxi_get_theme_option('footer_widgets');
$monyxi_footer_present = !monyxi_is_off($monyxi_footer_name) && is_active_sidebar($monyxi_footer_name);
if ($monyxi_footer_present) { 
	monyxi_storage_set('current_sidebar', 'footer');
	$monyxi_footer_wide = monyxi_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($monyxi_footer_name) ) {
		dynamic_sidebar($monyxi_footer_name);
	}
	$monyxi_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($monyxi_out)) {
		$monyxi_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $monyxi_out);
		$monyxi_need_columns = true;	//or check: strpos($monyxi_out, 'columns_wrap')===false;
		if ($monyxi_need_columns) {
			$monyxi_columns = max(0, (int) monyxi_get_theme_option('footer_columns'));
			if ($monyxi_columns == 0) $monyxi_columns = min(4, max(1, substr_count($monyxi_out, '<aside ')));
			if ($monyxi_columns > 1)
				$monyxi_out = preg_replace("/<aside([^>]*)class=\"widget/", "<aside$1class=\"column-1_".esc_attr($monyxi_columns).' widget', $monyxi_out);
			else
				$monyxi_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($monyxi_footer_wide) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$monyxi_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($monyxi_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'monyxi_action_before_sidebar' );
				monyxi_show_layout($monyxi_out);
				do_action( 'monyxi_action_after_sidebar' );
				if ($monyxi_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$monyxi_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>