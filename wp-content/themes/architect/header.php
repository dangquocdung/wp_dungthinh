<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package architect
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php global $architect_option; ?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

  <!-- Favicons
  ================================================== -->
  <?php architect_custom_favicon(); ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="mobile-menu-first">
  <div id="mobile-menu" class="mobile-menu">
    <div class="header-mobile-menu">
      <a href="tel:<?php echo esc_attr($architect_option['phone_header']); ?>"><?php echo esc_attr($architect_option['phone_header']); ?></a>
        <div class="mm-toggle">
          <span aria-hidden="true" class="icon_close"></span>
        </div>
    </div>
    <div class="mCustomScrollbar light" data-mcs-theme="minimal-dark">
      <?php
          $primary = array(
              'theme_location'  => 'primary',
              'menu'            => '',
              'container'       => '',
              'container_class' => '',
              'container_id'    => '',
              'menu_class'      => '',
              'menu_id'         => '',
              'echo'            => true,
              'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
              'walker'          => new wp_bootstrap_navwalker(),
              'before'          => '',
              'after'           => '',
              'link_before'     => '',
              'link_after'      => '',
              'items_wrap'      => '<ul>%3$s</ul>',
              'depth'           => 0,
          );
          if ( has_nav_menu( 'primary' ) ) {
              wp_nav_menu( $primary );
          }
      ?> 
      <div class="footer-mobile-menu">
          <?php architect_custom_header_socials(); ?>
          <?php echo htmlspecialchars_decode($architect_option['address']); ?>
      </div>
    </div>
  </div> 
</div> <!-- Mobile Menu -->

<div class="modal fade modal-search" id="myModal" tabindex="-1" role="dialog"   aria-hidden="true">
      <button type="button" class="close" data-dismiss="modal">×</button>
      <div class="modal-dialog myModal-search">
          <!-- Modal content-->
          <div class="modal-content">                                        
              <div class="modal-body">
                  <?php get_search_form(); ?>
              </div>
          </div>
      </div>
</div>

<div id="page">
  <div id="skrollr-body">

    <?php 
      if(isset($architect_option['header_layout']) and $architect_option['header_layout']=="header2" ){
        get_template_part('framework/headers/header-2'); 
      }elseif(isset($architect_option['header_layout']) and $architect_option['header_layout']=="header3" ){
        get_template_part('framework/headers/header-3'); 
      }elseif(isset($architect_option['header_layout']) and $architect_option['header_layout']=="header4" ){
        get_template_part('framework/headers/header-4'); 
      }else{ 
    ?>

    <header id="mainmenu" class="header-v1 header-border header-fix header-bg-white <?php architect_header_class(); ?>" data-0="padding:10px;padding-left:40px;padding-right:40px;" data-251="padding:10px; padding-left:40px;padding-right:40px;top:0;">
      <div id="info" class="topbar topbar-position topbar-dark <?php if($architect_option['top_bar']!=true){echo 'hide-topbar';}else{} ?>" data-0="height:30px" data-251="height:0;">
                    
        <div class="col-md-12">
            <?php echo htmlspecialchars_decode($architect_option['left_top']); ?>
            <div class="language">
              <?php echo htmlspecialchars_decode($architect_option['right_top']); ?>
            </div>
        </div>
            
      </div>
      <div class="left-header">
        <ul class="navi-level-1">
          <li>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
              <?php if($architect_option['logo']['url'] != ''){ ?>
                  <img src="<?php echo esc_url($architect_option['logo']['url']); ?>" class="img-responsive" alt="">
              <?php } ?>
            </a>
          </li>
        </ul>
      </div>
      <nav>      
      <?php
          $primary = array(
              'theme_location'  => 'primary',
              'menu'            => '',
              'container'       => '',
              'container_class' => '',
              'container_id'    => '',
              'menu_class'      => '',
              'menu_id'         => '',
              'echo'            => true,
              'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
              'walker'          => new wp_bootstrap_navwalker(),
              'before'          => '',
              'after'           => '',
              'link_before'     => '',
              'link_after'      => '',
              'items_wrap'      => '<ul class="navi-level-1 main-navi">%3$s</ul>',
              'depth'           => 0,
          );
          if ( has_nav_menu( 'primary' ) ) {
              wp_nav_menu( $primary );
          }
      ?> 
      </nav>
      <div class="right-header">
        <ul class="navi-level-1 sub-navi seperator-horizonal-line hover-style-4"> 
          <li class="header-tel"><a class="tel-header" href="tel:<?php echo esc_attr($architect_option['phone_header']); ?>"><?php echo esc_attr($architect_option['phone_header']); ?></a></li>
          <!-- Testing Search Box -->
          <li>
            <?php if (class_exists('Woocommerce')) { ?>
              <!-- Top Cart -->
              <div class="cart-button dropdown">
                  <a href="#" class="dropdown-toggle cart-contents mini-cart" data-toggle="dropdown" ><span aria-hidden="true" class="icon_bag_alt">
              </span> <span class="mini-cart-counter"><?php echo WC()->cart->get_cart_contents_count(); ?></span></a>
                  <div class="dropdown-menu top_cart_list_product">
                      <?php woocommerce_mini_cart(); ?>
                  </div>
              </div>
            <?php } ?>
          </li> 
          <li >
            <a  href="#" data-toggle="modal" data-target="#myModal" id="btn-search" class="reset-btn btn-in-navi"><span aria-hidden="true" class="icon_search"></span></a>
          </li>
          <li>
            <a href="#"  class="mm-toggle">
              <span aria-hidden="true" class="icon_menu"></span>
            </a> 
          </li>
        </ul>

      </div><!-- End Right Header --> 
    </header>
    <?php } ?>