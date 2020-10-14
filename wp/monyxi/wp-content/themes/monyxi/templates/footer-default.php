<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage MONYXI
 * @since MONYXI 1.0.10
 */

?>
<footer class="footer_wrap footer_default<?php
				if (!monyxi_is_inherit(monyxi_get_theme_option('footer_scheme')))
					echo ' scheme_' . esc_attr(monyxi_get_theme_option('footer_scheme'));
				?>">
	<?php

	// Footer widgets area
	get_template_part( apply_filters('monyxi_filter_get_template_part', 'templates/footer-widgets') );

	// Logo
	get_template_part( apply_filters('monyxi_filter_get_template_part', 'templates/footer-logo') );

	// Socials
	get_template_part( apply_filters('monyxi_filter_get_template_part', 'templates/footer-socials') );

	// Menu
	get_template_part( apply_filters('monyxi_filter_get_template_part', 'templates/footer-menu') );

	// Copyright area
	get_template_part( apply_filters('monyxi_filter_get_template_part', 'templates/footer-copyright') );
	
	?>
</footer><!-- /.footer_wrap -->
