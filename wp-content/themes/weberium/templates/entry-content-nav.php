<?php
/**
 * Entry Content / Navigation
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( is_single() && ! weberium_get_mod( 'weberium_blog_single_nav', true ) )
	return;

// Previous/next post navigation.
echo '<div class="clearfix">';
the_post_navigation( array(
	'next_text' => '<span class="meta-nav" aria-hidden="true">'. esc_html__( 'Next Article', 'weberium' ) .'</span>'.
		'<span class="screen-reader-text">'. esc_html__( 'Next Article:', 'weberium' ) .'</span> ',
	'prev_text' => '<span class="meta-nav" aria-hidden="true">'. esc_html__( 'Previous Article', 'weberium' ) .'</span>'.
		'<span class="screen-reader-text">'. esc_html__( 'Previous Article:', 'weberium' ) .'</span>',
) );
echo '</div>';