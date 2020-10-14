<?php
/*
 * The sidebar containing the main widget area.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

$eunice_blog_widget = cs_get_option('blog_widget');
$eunice_team_widget = cs_get_option('team_widget');

if (is_page()) {
	// Page Layout Options
	$eunice_page_layout = get_post_meta( get_the_ID(), 'page_layout_options', true );
}
if (is_single()) {
	$eunice_page_layout = get_post_meta( get_the_ID(), 'page_layout_options', true );
	if ($eunice_page_layout) {
		$eunice_single_blog_widget = $eunice_page_layout['page_sidebar_widget'];
	} else {
		$eunice_single_blog_widget = cs_get_option('single_blog_widget');
	}
}else{
	$eunice_single_blog_widget = cs_get_option('single_blog_widget');
}
?>

<div class="ence-sidebar">
	<?php if (is_page() && $eunice_page_layout['page_sidebar_widget']) {
		if (is_active_sidebar($eunice_page_layout['page_sidebar_widget'])) {
			dynamic_sidebar($eunice_page_layout['page_sidebar_widget']);
		}
	} elseif (!is_page() && $eunice_blog_widget && !$eunice_single_blog_widget) {
		if (is_active_sidebar($eunice_blog_widget)) {
			dynamic_sidebar($eunice_blog_widget);
		}
	} elseif (is_single() && $eunice_single_blog_widget) {
		if (is_active_sidebar($eunice_single_blog_widget)) {
			dynamic_sidebar($eunice_single_blog_widget);
		}
	} else {
		if (is_active_sidebar('sidebar-1')) {
			dynamic_sidebar( 'sidebar-1' );
		}
	} ?>
</div><!-- #secondary -->
