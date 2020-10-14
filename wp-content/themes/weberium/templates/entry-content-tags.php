<?php
/**
 * Entry Content / Tags
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( is_single() && ! weberium_get_mod( 'blog_single_tags', true ) )
	return;

the_tags( '<div class="post-tags clearfix">','','</div>' );




