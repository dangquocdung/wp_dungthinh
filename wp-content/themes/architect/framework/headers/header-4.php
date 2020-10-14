<?php global $architect_option; ?>  
<div id="page">
        <div id="skrollr-body">
          
          <!-- End top Bar -->
          <header id="mainmenu" class="header-v2 header-v4 header-border header-fix header-bg-white <?php architect_header_class(); ?>" data-0="padding:10px;padding-left:40px;padding-right:40px;" data-251="padding:10px; padding-left:40px;padding-right:40px;top:0;">
          <div id="info" class="topbar topbar-position topbar-dark <?php if($architect_option['top_bar']!=true){echo 'hide-topbar';}else{} ?>" data-0="height:30px" data-251="height:0;">
            <div class="container">
                <div class="row">
                  <div class="col-md-12">
                  <?php echo htmlspecialchars_decode($architect_option['left_top']); ?>
                    <div class="language">
                      <?php echo htmlspecialchars_decode($architect_option['right_top']); ?>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <div class="container">
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
            </div><!-- End Left Header -->
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
                      'items_wrap'      => '<ul id="main-navi" class="navi-level-1 main-navi">%3$s</ul>',
                      'depth'           => 0,
                  );
                  if ( has_nav_menu( 'primary' ) ) {
                      wp_nav_menu( $primary );
                  }
              ?>         
            </nav><!-- End Nav -->
            <div class="right-header">
                <ul class="navi-level-1 sub-navi seperator-horizonal-line"> 
                  <li>
                    <?php if (class_exists('Woocommerce')) { ?>
                    <!-- Top Cart -->
                    <div class="cart-button dropdown">
                      <a href="#" class="dropdown-toggle cart-contents mini-cart" data-toggle="dropdown" >
                        <span aria-hidden="true" class="icon_bag_alt"></span> 
                        <span class="mini-cart-counter"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                      </a>
                      <div class="dropdown-menu top_cart_list_product">
                        <?php woocommerce_mini_cart(); ?>
                      </div>
                    </div>
                    <?php } ?>
                  </li> 
                  <li>
                    <a href="#" data-toggle="modal" data-target="#myModal" id="btn-search" class="reset-btn btn-in-navi"><i aria-hidden="true" class="icon_search"></i></a>
                  </li>
                  <li>
                    <a href="#"  class="mm-toggle">
                      <span aria-hidden="true" class="icon_menu"></span>
                    </a> 
                  </li>
                </ul>

            </div><!-- End Right Header -->
          </div>
          </header> 