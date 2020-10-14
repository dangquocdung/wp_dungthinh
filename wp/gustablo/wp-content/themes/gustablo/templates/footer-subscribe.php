<?php
/**
 * Footer Subscribe
 *
 * @package gustablo
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( ! wprt_get_mod( 'subscribe', false ) ) return false;

$title = wprt_get_mod( 'subscribe_title', 'Newsletter Subscribe' );

if ( class_exists('MC4WP_MailChimp') ) {
	echo '<div class="footer-subscribe clearfix"><div class="wprt-container">';
	echo '<div class="text-wrap"><div class="heading-wrap">';
		if ( $title ) echo '<h5 class="heading">'. $title .'</h5>';
	echo '</div></div>';
	echo '<div class="form-wrap">';
		mc4wp_show_form(0);
	echo '</div>';
	echo '</div></div>';
}