<?php
/**
 * Header / Aside Content
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get default values
$content_one = weberium_get_mod( 'header_aside_info_one', '<span class="heading">Welcome to Best Website Building Tool</span>' );

// Get header style
$header_style = weberium_get_mod( 'header_site_style', 'style-1' );
if ( is_page() && weberium_metabox('header_style') )
    $header_style = weberium_metabox('header_style');

if ( $header_style == 'style-1' || $header_style == 'style-2' || $header_style == 'style-3' || $header_style == 'style-4' ) :
    get_template_part( 'templates/header-menu' );
endif; ?>

<?php if ( $header_style == 'style-5' ) : ?>
	<div id="header-aside">
        <?php 
        if ( weberium_get_mod( 'header_cart_icon', false ) )
            echo weberium_header_cart();
        
        if ( weberium_get_mod( 'header_search_icon', false ) )
            echo weberium_header_search();
        ?>

        <div class="header-info">
            <div class="inner">
                <?php
                if ( $content_one )
                printf('
                    <div class="info-one">
                        %1$s
                    </div>',
                    do_shortcode( $content_one )
                );
                ?>
            </div>
        </div>
	</div>
<?php endif; ?>



