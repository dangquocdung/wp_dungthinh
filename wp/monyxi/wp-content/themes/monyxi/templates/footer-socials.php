<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage MONYXI
 * @since MONYXI 1.0.10
 */


// Socials
if ( monyxi_is_on(monyxi_get_theme_option('socials_in_footer')) && ($monyxi_output = monyxi_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php monyxi_show_layout($monyxi_output); ?>
		</div>
	</div>
	<?php
}
?>