<?php global $architect_option; ?>

<div id="page">
  <div id="skrollr-body">
    <header id="mainmenu" class="header-v2 header-fix <?php architect_header_class(); ?>"
      data-0="padding:10px;padding-left:40px;padding-right:40px" data-251="padding:10px; padding-left:40px;padding-right:40px;top:0">
        <div class="left-header">
          <ul class="navi-level-1">
            <li>
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
                <?php if($architect_option['logo2']['url'] != ''){ ?>
                    <img src="<?php echo esc_url($architect_option['logo2']['url']); ?>" class="img-responsive" alt="">
                <?php }else{ ?>
                    <img src="<?php echo esc_url($architect_option['logo']['url']); ?>" class="img-responsive" alt="">
                <?php } ?>
              </a>
            </li>
            <li class="hidden-xs hidden-sm"><a class="tel-header" href="tel:<?php echo esc_attr($architect_option['phone_header']); ?>"><?php echo esc_attr($architect_option['phone_header']); ?></a></li>
          </ul>
        </div><!-- End Left Header -->
        <ul class="navi-level-1 sub-navi" >
          <li >
            <a href="#/" data-toggle="modal" data-target="#myModal" id="btn-search" class="reset-btn btn-in-navi"><span aria-hidden="true" class="icon_search"></span></a>
          </li>
          <li><?php if (class_exists('Woocommerce')) { ?>
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
          <li class="hidden-lg hidden-md">
            <a href="#" class="mm-toggle">
              <span aria-hidden="true" class="icon_menu"></span>
            </a> 
          </li>
                    <!-- End button mobile menu -->
        </ul>
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
        </nav><!-- End Nav -->        
    </header> 