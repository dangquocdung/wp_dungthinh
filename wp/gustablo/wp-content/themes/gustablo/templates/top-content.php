<?php
/**
 * Top Bar / Content
 *
 * @package gustablo
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get top content
$welcome = wprt_get_mod( 'top_bar_content_welcome', 'FREE STANDARD SHIPPING' );
$email = wprt_get_mod( 'top_bar_content_email', 'SUPPORT@NINZIO.COM' );
$phone = wprt_get_mod( 'top_bar_content_phone', '' );
$address = wprt_get_mod( 'top_bar_content_address', '' );
$time = wprt_get_mod( 'top_bar_content_time', '' );
?>

<div class="top-bar-content">
    <?php
    // Top content
    if ( $welcome ) : ?>
        <span class="welcome content">
            <?php echo do_shortcode( $welcome ); ?>
        </span>
    <?php endif;
    if ( $email ) : ?>
        <span class="email content">
            <?php echo do_shortcode( $email ); ?>
        </span>
    <?php endif;

    if ( $phone ) : ?>
        <span class="phone content">
            <?php echo do_shortcode( $phone ); ?>
        </span>
    <?php endif;

    if ( $address ) : ?>
        <span class="address content">
            <?php echo do_shortcode( $address ); ?>
        </span>
    <?php endif;

    if ( $time ) : ?>
        <span class="time content">
            <?php echo do_shortcode( $time ); ?>
        </span>
    <?php endif; ?>
</div><!-- /.top-bar-content -->

