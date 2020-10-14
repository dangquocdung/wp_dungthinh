<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <meta name="author" content="<?php the_author_meta('display_name', 1); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" >	
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <!--  Favicon -->
	<?php
	if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
	
		// Output old, custom favicon feature.
		 if ( function_exists( 'ot_get_option' ) ) :if (ot_get_option( 'favicon_logo')) :  ?>
			<link rel="shortcut icon" href="<?php echo esc_url( ot_get_option( 'favicon_logo')); ?>"/>
			<?php  else :  ?>
			<link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri()); ?>/images/favicon.png" />
			<?php endif ; endif;
		}
     ?>
    <!--  Icon Touch -->
    <?php if ( function_exists( 'ot_get_option' ) ) :if (ot_get_option( 'touch_logo')) :  ?>
    <link rel="apple-touch-icon" href="<?php echo esc_url( ot_get_option( 'touch_logo')); ?>"/>
    <?php  else :  ?>
    <link rel="apple-touch-icon" href="<?php echo esc_url( get_template_directory_uri()); ?>/images/favicon-touch.png" />
    <?php endif ; endif; ?>	
	<?php wp_head(); ?> 
</head>
	
    <body <?php body_class(); ?>>
    
		<?php if (function_exists( 'ot_get_option' ) && ot_get_option( 'theme_style')=='dark'){?>
        <div class="dark-page main-wrapper clearfix">
        <?php } else {?>
        <div class="main-wrapper clearfix">
        <?php }?>
	
	
				<!--preloader function-->
                <?php if ( function_exists( 'ot_get_option' ) ) :if (ot_get_option( 'preloader_set')) :  
                 $cordon_preload = ot_get_option( 'preloader_set' ); if ($cordon_preload == 'show_home') {  ?>
                    
                    <?php  if (is_front_page() ){ ?>
                        	<!-- Preloader -->
                            <div id="preloader">
                                <div id="status">
                                    <div class="spinner">
                                      <div class="bounce1"></div>
                                      <div class="bounce2"></div>
                                      <div class="bounce3"></div>
                                    </div>
                                </div><!--status-->
                            </div><!--/preloader-->
                    
                    <?php } 
                } else if ($cordon_preload == 'show_all') {?>
                
                       	<!-- Preloader -->
                        <div id="preloader">
                            <div id="status">
                                <div class="spinner">
                                  <div class="bounce1"></div>
                                  <div class="bounce2"></div>
                                  <div class="bounce3"></div>
                                </div>
                            </div><!--status-->
                        </div><!--/preloader-->
                
                <?php  } endif ; endif; ?>