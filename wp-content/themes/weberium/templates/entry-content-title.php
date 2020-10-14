<?php
/**
 * Entry Content / Title
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get post title
if ( ! ( $title = get_the_title() ) )
	return;

$html = '<h2 class="post-title"><span><a href="%2$s" rel="bookmark">%1$s</a></span></h2>';

if ( is_single() ) {
	if ( weberium_get_mod( 'blog_single_title', true ) ) {
		$html = '<h1 class="post-title"><span>%1$s</span></h1>';
	} else { $html = ''; }
}

printf( $html, $title, esc_url( get_permalink() ) );