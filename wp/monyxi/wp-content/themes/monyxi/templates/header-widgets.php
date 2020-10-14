<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage MONYXI
 * @since MONYXI 1.0
 */

// Header sidebar
$monyxi_header_name = monyxi_get_theme_option('header_widgets');
$monyxi_header_present = !monyxi_is_off($monyxi_header_name) && is_active_sidebar($monyxi_header_name);
if ($monyxi_header_present) { 
	monyxi_storage_set('current_sidebar', 'header');
	$monyxi_header_wide = monyxi_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($monyxi_header_name) ) {
		dynamic_sidebar($monyxi_header_name);
	}
	$monyxi_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($monyxi_widgets_output)) {
		$monyxi_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $monyxi_widgets_output);
		$monyxi_need_columns = strpos($monyxi_widgets_output, 'columns_wrap')===false;
		if ($monyxi_need_columns) {
			$monyxi_columns = max(0, (int) monyxi_get_theme_option('header_columns'));
			if ($monyxi_columns == 0) $monyxi_columns = min(6, max(1, substr_count($monyxi_widgets_output, '<aside ')));
			if ($monyxi_columns > 1)
				$monyxi_widgets_output = preg_replace("/<aside([^>]*)class=\"widget/", "<aside$1class=\"column-1_".esc_attr($monyxi_columns).' widget', $monyxi_widgets_output);
			else
				$monyxi_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($monyxi_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$monyxi_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($monyxi_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'monyxi_action_before_sidebar' );
				monyxi_show_layout($monyxi_widgets_output);
				do_action( 'monyxi_action_after_sidebar' );
				if ($monyxi_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$monyxi_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>