<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage MONYXI
 * @since MONYXI 1.0.10
 */

// Logo
if (monyxi_is_on(monyxi_get_theme_option('logo_in_footer'))) {
	$monyxi_logo_image = monyxi_get_logo_image('footer');
	$monyxi_logo_text  = get_bloginfo( 'name' );
	if (!empty($monyxi_logo_image) || !empty($monyxi_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($monyxi_logo_image)) {
					$monyxi_attr = monyxi_getimagesize($monyxi_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'">'
							. '<img src="'.esc_url($monyxi_logo_image).'"'
								. ' class="logo_footer_image"'
								. ' alt="'.esc_attr__('Site logo', 'monyxi').'"'
								. (!empty($monyxi_attr[3]) ? ' ' . wp_kses_data($monyxi_attr[3]) : '')
							.'>'
						. '</a>' ;
				} else if (!empty($monyxi_logo_text)) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="'.esc_url(home_url('/')).'">'
								. esc_html($monyxi_logo_text)
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>