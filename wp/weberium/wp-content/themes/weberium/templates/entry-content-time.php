<?php
/**
 * Entry Content / Time
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! weberium_get_mod( 'blog_custom_date', false ) )
	return;

echo '<div class="post-date-custom"><span>'.get_the_date("d").'</span><span>'.get_the_date("M").'</span></div>';
