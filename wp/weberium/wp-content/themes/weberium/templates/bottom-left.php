<?php
/**
 * Bottom Bar / Content
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get bottom content
$content = weberium_get_mod( 'bottom_copyright', '&copy; Copyright weberium. All rights reserved.' );
?>

<div class="bottom-bar-left">
    <?php
    // Display copyright site
    if ( $content ) : ?>

        <div id="copyright">
            <?php printf('%1$s', do_shortcode( $content ));  ?>
        </div><!-- /#copyright -->

    <?php endif; ?>
</div><!-- /.bottom-bar-left -->

