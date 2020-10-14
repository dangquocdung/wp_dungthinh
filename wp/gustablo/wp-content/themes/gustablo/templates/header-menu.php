<?php
/**
 * Header / Menu
 *
 * @package gustablo
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<?php
// Get header style
$header_style = wprt_get_mod( 'header_site_style', 'style-1' );
if ( is_page() && wprt_metabox('header_style') )
    $header_style = wprt_metabox('header_style');
    
if ( $header_style != 'style-5' ) {
	if ( wprt_get_mod( 'header_search_icon', false ) )
		echo wprt_header_search();

	if ( wprt_get_mod( 'header_cart_icon', false ) )
		echo wprt_header_cart();
} ?>

<nav id="main-nav" class="main-nav">
	<?php
	wp_nav_menu( array(
		'theme_location' => 'primary',
		'link_before' => '<span>',
		'link_after'=>'</span>',
		'fallback_cb' => 'wprt_menu_fallback',
		'container' => false
	) );
	?>
</nav>

<ul class="nav-extend active">
	<?php if ( wprt_get_mod( 'header_search_icon', false ) ) : ?>
	<li class="ext"><?php get_search_form(); ?></li>
	<?php endif; ?>

	<?php if ( wprt_get_mod( 'header_cart_icon', false ) && class_exists( 'woocommerce' ) ) : ?>
	<li class="ext"><a class="cart-info" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php echo esc_attr__( 'View your shopping cart', 'gustablo' ); ?>"><?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'gustablo' ), WC()->cart->get_cart_contents_count() ); ?> <?php echo WC()->cart->get_cart_total(); ?></a></li>
	<?php endif; ?>
</ul>