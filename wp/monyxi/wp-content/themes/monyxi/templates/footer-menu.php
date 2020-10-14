<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage MONYXI
 * @since MONYXI 1.0.10
 */

// Footer menu
$monyxi_menu_footer = monyxi_get_nav_menu(array(
											'location' => 'menu_footer',
											'class' => 'sc_layouts_menu sc_layouts_menu_default'
											));
if (!empty($monyxi_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php monyxi_show_layout($monyxi_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>