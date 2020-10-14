<?php
/**
 * Header / Menu
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<?php
// Get header style
$header_style = weberium_get_mod( 'header_site_style', 'style-1' );
if ( is_page() && weberium_metabox('header_style') )
    $header_style = weberium_metabox('header_style');

$search = weberium_get_mod( 'header_search_icon', false );
$cart = weberium_get_mod( 'header_cart_icon', false );

if ( $search || $cart ) {
	echo '<div class="cart-search-wrap">';
	if ( $search ) echo weberium_header_search();
	if ( $cart ) echo weberium_header_cart();
	echo '</div>';
} ?>

<nav id="main-nav" class="main-nav">
	<?php
	wp_nav_menu( array(
		'theme_location' => 'primary',
		'link_before' => '<span>',
		'link_after'=>'</span>',
		'fallback_cb' => false,
		'container' => false
	) );
	?>
</nav>

<ul class="nav-extend active">
	<?php if ( weberium_get_mod( 'header_search_icon', false ) ) : ?>
	<li class="ext"><?php get_search_form(); ?></li>
	<?php endif; ?>

	<?php if ( weberium_get_mod( 'header_cart_icon', false ) && class_exists( 'woocommerce' ) ) : ?>
	<li class="ext"><a class="cart-info" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php echo esc_attr__( 'View your shopping cart', 'weberium' ); ?>"><?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'weberium' ), WC()->cart->get_cart_contents_count() ); ?> <?php echo WC()->cart->get_cart_total(); ?></a></li>
	<?php endif; ?>
</ul>
