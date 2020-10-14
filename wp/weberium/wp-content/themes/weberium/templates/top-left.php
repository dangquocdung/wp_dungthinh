<?php
/**
 * Top Bar / Left
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get top content
$welcome = weberium_get_mod( 'top_bar_content_welcome', '' );
$email = weberium_get_mod( 'top_bar_content_email', 'SUPPORT@NINZIO.COM' );
$phone = weberium_get_mod( 'top_bar_content_phone', 'PHONE +7 (100) 450-460' );
$address = weberium_get_mod( 'top_bar_content_address', '' );
?>

<div class="top-bar-left">
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
    <?php endif; ?>
</div><!-- /.top-bar-left -->

