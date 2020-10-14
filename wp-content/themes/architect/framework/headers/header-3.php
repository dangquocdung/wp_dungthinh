<?php global $architect_option; ?>
<!-- header close -->

<div id="page">
  <div id="skrollr-body">
    <header class="header-v3 header-fix header-border header-bg-white <?php architect_header_class(); ?>"
       data-0="padding:10px;padding-left:40px;padding-right:40px;" data-251="padding:10px; padding-left:40px;padding-right:40px;top:0;">
       <div id="info" class="topbar topbar-position topbar-dark <?php if($architect_option['top_bar']!=true){echo 'hide-topbar';}else{} ?>" data-0="height:30px" data-251="height:0;">
          <div class="col-md-12">
             <?php echo htmlspecialchars_decode($architect_option['left_top']); ?>
             <div class="language">
                <?php echo htmlspecialchars_decode($architect_option['right_top']); ?>
             </div>
          </div>
       </div>
       <div class="left-header">
          <nav id="navi-left">
             <?php
                $primary = array(
                    'theme_location'  => 'leftmenu',
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
                if ( has_nav_menu( 'leftmenu' ) ) {
                    wp_nav_menu( $primary );
                }
            ?> 
          </nav>
       </div>
       <!-- End Left Header -->
       <div class="logo">
          <ul class="navi-level-1 main-navi">
              <li> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
                  <?php if($architect_option['logo']['url'] != ''){ ?>
                      <img src="<?php echo esc_url($architect_option['logo']['url']); ?>" class="img-responsive" alt="">
                  <?php } ?></a>
              </li>
             <li>
                <a href="#" class="mm-toggle hidden-lg hidden-md">
                <span aria-hidden="true" class="icon_menu"></span>
                </a> 
             </li>
          </ul>
       </div>
       <!-- End Logo -->
       <div class="right-header">
          <nav id="navi-right">
             <?php
                $primary = array(
                    'theme_location'  => 'rightmenu',
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
                if ( has_nav_menu( 'rightmenu' ) ) {
                    wp_nav_menu( $primary );
                }
            ?> 
          </nav>
       </div>
       <!-- End Right Header -->
    </header>
