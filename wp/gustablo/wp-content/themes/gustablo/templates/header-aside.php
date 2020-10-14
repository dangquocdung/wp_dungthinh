<?php
/**
 * Header / Aside Content
 *
 * @package gustablo
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get header style
$header_style = wprt_get_mod( 'header_site_style', 'style-4' );
if ( is_page() && wprt_metabox('header_style') )
    $header_style = wprt_metabox('header_style');

    get_template_part( 'templates/header-menu' );
?>



