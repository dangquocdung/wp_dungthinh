<?php
/**
 * Bottom Bar / Menu
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<div class="bottom-bar-right">
	<div class="bottom-bar-menu">
	    <?php
	    wp_nav_menu( array(
	        'theme_location' => 'bottom',
	        'fallback_cb'    => false,
	        'container'      => false,
	        'menu_class'     => 'bottom-nav',
	    ) );
	    ?>
	</div><!-- /.bottom-bar-menu -->

	<div class="bottom-socials">
	    <div class="inner">
		    <span class="icons">
		    <?php
		    // Get social options array
		    $profiles =  weberium_get_mod( 'bottom_social_profiles' );
		    $social_options = weberium_bottom_social_options();

		    foreach ( $social_options as $key => $val ) :
		        // Get URL from the theme mods
		        $url = isset( $profiles[$key] ) ? $profiles[$key] : '';

		        if ( $url ) :
		            // Display link
		            echo '<a href="'. esc_url($url) .'" title="'. esc_attr($val['label']) .'"><span class="'. esc_attr($val['icon_class']) .'"></span></a>';
		        endif;
		    endforeach; ?>
		    </span>
	    </div>
	</div><!-- /.top-bar-socials -->
</div><!-- /.bottom-bar-right -->



