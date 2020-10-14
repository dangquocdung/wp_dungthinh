<?php
/**
 * Footer Promotion
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( ! weberium_get_mod( 'promotion', false ) ) return false;

$title = weberium_get_mod( 'promotion_title', 'SOME OF THE WORLD\'S BEST DESIN TEAMS INSPECT THE CRAFT SOLUTIONS' );
$button = weberium_get_mod( 'promotion_button', 'PURCHASE NOW' );
$button_url = weberium_get_mod( 'promotion_button_url', '#' );

$html = $text_html = '';
if ( $title ) $html .= sprintf( '
	<div class="heading-wrap">
		<div class="text-wrap">
			<span class="promo-icon"><i class="nz-diamond"></i></span>
			<h5 class="heading">%1$s</h5>
		</div>
	</div>', esc_html( $title ) );
if ( $button) $html .= sprintf( '
	<div class="button-wrap">
		<a href="%2$s" class="promo-btn">
			<span><span class="icon"><i class="nz-shop5"></i></span>%1$s</span>
		</a>
	</div>', esc_html( $button ), esc_url( $button_url ) );

if ( $title || $button )
	$text_html = sprintf( '<div class="inner">%1$s</div>', $html );

if ( $text_html )
	printf( '<div class="footer-promotion clearfix"><div class="weberium-container">%1$s</div></div>', $text_html );