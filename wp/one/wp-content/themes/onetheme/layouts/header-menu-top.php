<?php
   $onetheme_header_color = TT::get_mod('header_dark') == '1' ? 'dark' : 'light';  
   global $onetheme_header_layout_color; 
   $onetheme_header_color = !empty($onetheme_header_layout_color) ? $onetheme_header_layout_color : $onetheme_header_color;
 ?>

<div class="container">
    <div class="row">
        <div class="col-md-12 no-padd">
           <header class="wpc-header style-1 <?php print $onetheme_header_color;?>">
                <div class="header-top bg-c-1">
                    <div class="row">
                        <div class="col-xxs-12 col-xs-6 col-sm-4 col-md-3">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-wrap"> 
                                <img src="<?php echo esc_url(TT::get_mod('logo_image')); ?>" alt="<?php bloginfo('name');?>"/>
                                <div class="logo-text text-left"><i><?php esc_url(bloginfo('name'));?></i><br><span><?php esc_url(bloginfo('description'));?></span></div>
                            </a>
                        </div>
                        <div class="col-xxs-12 col-xs-6 col-sm-6 col-md-6">
                            <div class="header-contacts">
                                <a href="tel:<?php echo str_replace(' ', '', esc_attr(TT::get_mod('topbar_link_name'))); ?>"><i class="fa fa-phone"></i> <?php echo esc_attr(TT::get_mod('topbar_link_name')); ?></a>
                                <a href="mailto:<?php echo TT::get_mod('topbar_link1_name'); ?>"><i class="fa fa-envelope-o"></i> <?php echo esc_attr(TT::get_mod('topbar_link1_name')); ?></a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-3 padd-right30"> 
                            
                            <?php if( class_exists( 'woocommerce' ) ): ?>
                                <?php 
                                    global $woocommerce;
                                    $cart_url = $woocommerce->cart->get_cart_url();
                                ?>
                                <a href="<?php echo esc_url($cart_url); ?>" class="basket-btn fa fa-shopping-bag text-center">
                                    <span class="shopping-quantity">
                                        <?php echo WC()->cart->get_cart_contents_count(); ?>
                                    </span>
                                </a>
                            <?php endif; ?>

                            <?php if ( ! is_user_logged_in() ): ?>

                                <a href="#login-form" class="login-btn"><i class="fa fa-key" aria-hidden="true"></i><?php esc_html_e("Login", 'onetheme'); ?></a>
                           
                            <?php elseif (false): ?>
                                <div class="login-admin">
                                    <?php
                                        wp_loginout( esc_url(home_url()) ); // Display "Log Out" link.
                                        echo " | ";
                                        wp_register('', '');
                                    ?>
                                </div>
                                
                            <?php endif; ?> 
                        </div>
                        
                    </div>
                </div>
                <div class="header-bottom bg-c-1">
                    <?php get_template_part('layouts/nav-menu'); ?>
                </div>
            </header>
        </div>
    </div>
</div>