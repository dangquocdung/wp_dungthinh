<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage MONYXI
 * @since MONYXI 1.0
 */

$monyxi_args = get_query_var('monyxi_logo_args');

// Site logo
$monyxi_logo_type   = isset($monyxi_args['type']) ? $monyxi_args['type'] : '';
$monyxi_logo_image  = monyxi_get_logo_image($monyxi_logo_type);
$monyxi_logo_text   = monyxi_is_on(monyxi_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$monyxi_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($monyxi_logo_image) || !empty($monyxi_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url(home_url('/')); ?>"><?php
		if (!empty($monyxi_logo_image)) {
			if (empty($monyxi_logo_type) && function_exists('the_custom_logo') && (int) $monyxi_logo_image > 0) {
				the_custom_logo();
			} else {
				$monyxi_attr = monyxi_getimagesize($monyxi_logo_image);
				echo '<img src="'.esc_url($monyxi_logo_image).'" alt="'.esc_attr($monyxi_logo_text).'"'.(!empty($monyxi_attr[3]) ? ' '.wp_kses_data($monyxi_attr[3]) : '').'>';
			}
		} else {
			monyxi_show_layout(monyxi_prepare_macros($monyxi_logo_text), '<span class="logo_text">', '</span>');
			monyxi_show_layout(monyxi_prepare_macros($monyxi_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>