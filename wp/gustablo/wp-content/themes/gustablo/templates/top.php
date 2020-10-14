<?php
/**
 * Top Bar
 *
 * @package gustablo
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get Top style
$top_style = wprt_get_mod( 'top_bar_site_style', 'style-4' );
if ( is_page() && wprt_metabox('top_bar_style') )
    $top_style = wprt_metabox('top_bar_style');

if ( $top_style == 'style-4' ) 
    return;
?>

<div id="top-bar">
    <div id="top-bar-inner" class="wprt-container">
        <div class="top-bar-inner-wrap">
            <?php
            // Get topbar content
            get_template_part( 'templates/top-content' );
            
            // Get topbar socials
            get_template_part( 'templates/top-socials' );
            ?>
        </div>
    </div>
</div><!-- /#top-bar -->