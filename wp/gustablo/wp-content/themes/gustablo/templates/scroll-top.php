<?php
/**
 * Scroll Top Button
 *
 * @package gustablo
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( ! wprt_get_mod( 'scroll_top', true ) ) return false;
?>

<a id="scroll-top"></a>