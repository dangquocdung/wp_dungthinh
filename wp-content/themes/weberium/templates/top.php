<?php
/**
 * Top Bar
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get Top style
$top_style = weberium_get_mod( 'top_bar_site_style', 'style-4' );
if ( is_page() && weberium_metabox('top_bar_style') )
    $top_style = weberium_metabox('top_bar_style');

if ( $top_style == 'style-4' ) 
    return;
?>

<div id="top-bar">
    <div id="top-bar-inner" class="weberium-container">
        <div class="top-bar-inner-wrap">
            <?php
            // Get topbar left
            get_template_part( 'templates/top-left' );
            
            // Get topbar right
            get_template_part( 'templates/top-right' );
            ?>
        </div>
    </div>
</div><!-- /#top-bar -->