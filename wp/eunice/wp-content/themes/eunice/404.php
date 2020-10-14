<?php
/*
 * The template for displaying 404 pages (not found).
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

// Theme Options
$eunice_error_heading = cs_get_option('error_heading');
$eunice_error_page_content = cs_get_option('error_page_content');
$eunice_error_page_bg = cs_get_option('error_page_bg');
$eunice_error_btn_text = cs_get_option('error_btn_text');

$eunice_error_heading = ( $eunice_error_heading ) ? $eunice_error_heading : esc_html__( '404', 'eunice' );
$eunice_error_page_content = ( $eunice_error_page_content ) ? $eunice_error_page_content : esc_html__( 'Sorry, the page you are looking for is not available', 'eunice' );
$eunice_error_page_bg = ( $eunice_error_page_bg ) ? wp_get_attachment_url($eunice_error_page_bg) : EUNICE_IMAGES . '/404-bg.jpg';
$eunice_error_btn_text = ( $eunice_error_btn_text ) ? $eunice_error_btn_text : esc_html__( 'BACK TO HOME', 'eunice' );

get_header(); ?>

	<!-- Content -->
  <div class="main-content-area">
	<div class="content-warp">

		<div class="page-404 page-404-wrap" style="background: url('<?php echo esc_url($eunice_error_page_bg); ?>');">
			<div class="container-width-750  entry-content">
				<h1><?php echo esc_attr($eunice_error_heading); ?></h1>
				<p><?php echo esc_attr($eunice_error_page_content); ?></p>
				<a href="<?php echo esc_url(home_url( '/' )); ?>"><?php echo esc_attr($eunice_error_btn_text); ?></a>
			</div>
		</div>

	</div>
	</div>
	<!-- Content -->

<?php
get_footer();
