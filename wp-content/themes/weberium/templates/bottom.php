<?php
/**
 * Bottom Bar
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( ! weberium_get_mod( 'bottom_bar', true ) ) return false;

$bottom_style = weberium_get_mod( 'bottom_bar_style', 'style-1' );

if ( $bottom_style == 'style-1') { $top_content = array( "content", "menu" ); }
else { $top_content = array( "menu", "content" ); }
?>

<div id="bottom" class="clearfix <?php echo weberium_element_classes( 'bottom_bar_style' ); ?>">
<div id="bottom-bar-inner" class="weberium-container">
    <div class="bottom-bar-inner-wrap">
        <?php
        foreach ( $top_content as $content ) : 
            // Get bottom left
            if ( 'content' == $content ) 
                get_template_part( 'templates/bottom-left' );
            
            // Get bottom right
            if ( 'menu' == $content ) 
                get_template_part( 'templates/bottom-right' );
        endforeach; ?>
    </div>
</div>
</div><!-- /#bottom -->