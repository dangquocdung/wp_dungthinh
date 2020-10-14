<?php
/* Woocommerce template. */
$fixar_id = fixar_woo_get_page_id();
$fixar_isProduct = false;

if ( is_single() && get_post_type() == 'product' ) {
	$fixar_isProduct = true;
}

$fixar_custom = $fixar_id > 0 ? get_post_custom($fixar_id) : array();
$fixar_layout = isset ($fixar_custom['pix_page_layout']) ? reset($fixar_custom['pix_page_layout']) : '2';
$fixar_sidebar = isset ($fixar_custom['pix_selected_sidebar'][0]) ? reset($fixar_custom['pix_selected_sidebar']) : 'sidebar-1';

if ( $fixar_isProduct === true ) {
	$fixar_useSettingsGlobal = fixar_get_option( 'shop_settings_global_product', 'on' );
	if ( $fixar_useSettingsGlobal == 'on' ) {
		$fixar_layout = fixar_get_option( 'shop_settings_sidebar_type', '2');
		$fixar_sidebar = fixar_get_option( 'shop_settings_sidebar_content', 'product-sidebar-1' );
	}
}

if ( ! is_active_sidebar($fixar_sidebar) ) $fixar_layout = '1';

get_header(); ?>


<section class="page-section">
	<div class="container">
		<div class="row">
			<main class="main-content">

				<?php fixar_show_sidebar( 'left', $fixar_layout, $fixar_sidebar, 1 ); ?>

				<div class="rtd <?php if ( $fixar_layout == 1 ) : ?>col-lg-12 col-md-12<?php else : ?>col-lg-9 col-md-8<?php endif; ?> col-sm-12 col-xs-12 left-column sidebar-type-<?php echo esc_attr($fixar_layout == 2 ? 'right' : ($fixar_layout == 3 ? 'left' : 'hide')); ?>">

					<?php  woocommerce_content(); ?>

				</div>

				<?php fixar_show_sidebar( 'right', $fixar_layout, $fixar_sidebar, 1 ); ?>

			</main>

		</div>
	</div>
</section>

<?php get_footer();?>
