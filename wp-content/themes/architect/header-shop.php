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

<body <?php body_class('bg-light-grey template-border'); ?>>
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
  <div class="topbar topbar-transparent">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="topbar-left">
            <?php echo htmlspecialchars_decode($architect_option['topleft_shop']); ?>
            <div class="social-share">
                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook"></i></a>
                <a target="_blank" href="https://twitter.com/home?status=<?php the_permalink(); ?>"><i class="fa fa-twitter"></i></a>
                <a target="_blank" href="https://www.instagram.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            </div>
        </div>
        <p class="ads-text text-cap"><?php echo htmlspecialchars_decode($architect_option['top_head_shop']); ?> </p>
        <div class="topbar-right">
          <?php if ( is_user_logged_in() ) { ?>
            <div class="account">
              <a class="text-cap" href="<?php echo esc_url( home_url( '/' ) ); ?>/my-account/"><?php esc_html_e('Sign Out','architect'); ?></a>
            </div>
          <?php }else{ ?>
            <div class="account">
              <a class="text-cap" href="<?php echo esc_url( home_url( '/' ) ); ?>/my-account/"><?php esc_html_e('Sign in','architect'); ?></a>
              <a class="text-cap" href="<?php echo esc_url( home_url( '/' ) ); ?>/my-account/"><?php esc_html_e('Register','architect'); ?></a>
            </div>
          <?php } ?>
        </div>
        </div>
      </div>
    </div>
  </div>
  <div class="content-box effect8  clearfix">
    <header class="header-v6 <?php architect_header_class(); ?>">
      <div class="container container-fill-width">
        <div class="row">
          <div class="left-header">
                 
            <form role="search" method="get" class="form-inline form-search-home-6 woocommerce-product-search search-form" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
              <div class="form-group">
              <div class="input-group">
              <button class="btn-search-home-6 text-cap search-submit" type="submit"><span aria-hidden="true" class="icon_search"></span></button>
              <input type="search" id="woocommerce-product-search-field" class="form-control search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'architect' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'architect' ); ?>" />
              <input type="hidden" name="post_type" value="product" />
              </div>
              </div>
            </form>
          </div>
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
            <?php if($architect_option['logo']['url'] != ''){ ?>
                <img src="<?php echo esc_url($architect_option['logo']['url']); ?>" class="img-responsive" alt="">
            <?php } ?>
          </a>
            <div class="right-header">
              <ul class="navi-level-1">
                <li><a href="#">
                  <span aria-hidden="true" class="icon_heart_alt"></span>
                </a>
                </li>
                <li>
                  <?php if (class_exists('Woocommerce')) { ?>
                        <!-- Top Cart -->
                        <div class="cart-button dropdown">
                            <a href="#" class="dropdown-toggle cart-contents mini-cart" data-toggle="dropdown" ><span aria-hidden="true" class="icon_bag_alt">
                        </span> <span class="mini-cart-counter"><?php echo WC()->cart->get_cart_contents_count(); ?></span><span class="price-mini-cart"><?php echo WC()->cart->get_cart_subtotal(); ?></span></a>
                            <div class="dropdown-menu top_cart_list_product">
                                <?php woocommerce_mini_cart(); ?>
                            </div>
                        </div>
                    <?php } ?>
                </li>
                <li><a href="#" data-toggle="modal" data-target="#myModal" id="btn-search" class="reset-btn btn-in-navi"><span aria-hidden="true" class="icon_search"></span></a>
                </li>
                <li><a href="#" class="mm-toggle">
                    <span aria-hidden="true" class="icon_menu"></span>
                    </a> 
                </li>
              </ul>
            </div>
            <nav>
            <?php
                $primary = array(
                    'theme_location'  => 'shopmenu',
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
                    'items_wrap'      => '<ul class="navi-level-1 hover-style-2 main-navi">%3$s</ul>',
                    'depth'           => 0,
                );
                if ( has_nav_menu( 'shopmenu' ) ) {
                    wp_nav_menu( $primary );
                }
            ?> 
            </nav>  
      </div>
      </div>
      </header>