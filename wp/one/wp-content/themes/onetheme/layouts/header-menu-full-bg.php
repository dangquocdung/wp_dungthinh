<?php
   $onetheme_header_color = TT::get_mod('header_dark') == '1' ? 'dark' : 'light';  
   global $onetheme_header_layout_color;
   $onetheme_header_color = !empty($onetheme_header_layout_color) ? $onetheme_header_layout_color : $onetheme_header_color;
 ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 no-padd">
            <header class="wpc-header style-2 <?php print $onetheme_header_color;?>">
                <div class="header-top bg-c-1">
                    <div class="container no-padd-xs">
                    <div class="row">
                        <div class="col-xxs-12 col-xs-6 col-sm-3 col-md-2 col-sm-push-5 col-md-pull-5">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-wrap"><img src="<?php echo esc_url(TT::get_mod('logo_image')); ?>" alt="<?php esc_attr_e('logo', 'onetheme')?>">
                                <div class="logo-text text-left"><i><?php esc_url(bloginfo('name'));?></i><br><span><?php esc_url(bloginfo('description'));?></span></div>
                            </a>
                        </div>
                        <div class="col-xxs-12 col-xs-6 col-sm-5 col-md-5 col-sm-pull-3 col-md-pull-2">
                            <div class="header-contacts">
                                <a href="tel:<?php echo str_replace(' ', '', esc_attr(TT::get_mod('topbar_link_name'))); ?>"><i class="fa fa-phone"></i> <?php echo esc_attr(TT::get_mod('topbar_link_name')); ?></a>
                                <a href="mailto:<?php echo esc_attr(TT::get_mod('topbar_link1_name')); ?>"><i class="fa fa-envelope-o"></i> <?php echo esc_attr(TT::get_mod('topbar_link1_name')); ?></a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-5">
                            <?php if( class_exists( 'woocommerce' ) ): ?>
                                <?php 
                                    $cart_url='';
                                    global $woocommerce;
                                    $cart_url = $woocommerce->cart->get_cart_url();
                                ?>
                                 <a class="basket-btn fa fa-shopping-bag text-center" href="<?php echo esc_url($cart_url); ?>">
                                        <span class="shopping-quantity"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                                </a>
                            <?php endif; ?>

                            <?php if ( ! is_user_logged_in() ): ?>

                                 <a href="#login-form" class="login-btn"><i class="fa fa-key" aria-hidden="true"></i><?php esc_html_e("Login", 'onetheme'); ?></a>
                           
                            <?php elseif (false): ?>
                                <div class="login-admin">
                                    <?php
                                        wp_loginout( esc_url(home_url()) ); // Display "Log Out" link.
                                        echo "  ";
                                        wp_register('', '');
                                    ?>
                                </div>
                                
                            <?php endif; ?> 
                        </div>
                     </div>   
                    </div>
                </div>
                <div class="header-bottom bg-c-1">
                    <div class="container no-padd">
                     <?php get_template_part('layouts/nav-menu'); ?>
                    </div>
                </div>
            </header>
        </div>
    </div>
</div>