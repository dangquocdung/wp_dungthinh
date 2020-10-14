<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('monyxi_wpml_get_css')) {
	add_filter('monyxi_filter_get_css', 'monyxi_wpml_get_css', 10, 2);
	function monyxi_wpml_get_css($css, $args) {
		return $css;
	}
}
?>