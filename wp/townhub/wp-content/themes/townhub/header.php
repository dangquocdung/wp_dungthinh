<?php
/* banner-php */
/**
 * The header for our theme 
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials 
 *
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg" itemscope> 
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="profile" href="//gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php 
if(townhub_get_option('show_loader', true ) ) : 
    $loader_icon = townhub_get_option('loader_icon');
?>
    <!--loader-->
    <div class="loader-wrap">
        <div class="loader-inner<?php if(!empty($loader_icon)) echo ' loader-image-inner'; ?>">
        <?php if(!empty($loader_icon)): ?>
            <div class="loader-icon-img">
                <?php echo wp_get_attachment_image( $loader_icon, 'full', false, array('class'=>'no-lazy')); ?> 
            </div>
        <?php else: ?>
            <div class="loader-inner-cirle"></div>
        <?php endif; ?>
        </div>
    </div>
    <!--loader end-->
    <div id="main-theme">
<?php else :?>
    <div id="main-theme" class="is-hide-loader">
<?php endif;?>

        <!-- header-->
        <header id="masthead" class="townhub-header main-header dark-header fs-header sticky">

            <div class="logo-holder">
                <?php 
                if(has_custom_logo()) the_custom_logo(); 
                else echo '<a class="custom-logo-link logo-text" href="'.esc_url( home_url('/' ) ).'"><h2>'.get_bloginfo( 'name' ).'</h2></a>'; 
                ?>
            </div>
            <!-- header-search_btn-->         
            <?php if(townhub_get_option('show_fixed_search', true )) echo do_shortcode( townhub_check_shortcode('[townhub_search_top]', 'townhub_search_top') );?>


            <!-- header opt -->
            <?php /* if(townhub_get_option('show_addlisting', true ))*/ echo do_shortcode( townhub_check_shortcode('[townhub_submit_button]', 'townhub_submit_button') );?>
             
            
            
            <?php if(townhub_get_option('show_wishlist', true )) echo do_shortcode( townhub_check_shortcode('[townhub_wishlist]', 'townhub_wishlist') );?>

            <?php 
                 if(townhub_get_option('show_userprofile', true )) echo do_shortcode( townhub_check_shortcode('[townhub_login style="'.townhub_get_option('user_menu_style').'"]', 'townhub_login') ); 
            ?>
            <!-- header opt end--> 
            <?php 
            if(is_active_sidebar('header-languages')){
                dynamic_sidebar('header-languages');
            } ?>
            
            <!-- lang-wrap-->
            
            <!-- lang-wrap end-->                                 
            <!-- nav-button-wrap--> 
            <div class="nav-button-wrap color-bg">
                <div class="nav-button">
                    <span></span><span></span><span></span>
                </div>
            </div>
            <!-- nav-button-wrap end-->
            <?php if ( has_nav_menu( 'top' ) ) : ?>
                <!--  .nav-holder -->
                <div class="nav-holder main-menu">
                    <?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
                </div><!-- .nav-holder -->
            <?php endif; ?>

        </header>
        <!--  header end -->
        <!--  wrapper  -->
        <div id="wrapper">
            <!-- Content-->
            <div class="content">

                
