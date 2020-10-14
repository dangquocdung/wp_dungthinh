<header id="apus-header" class="site-header apus-header header-v1 hidden-sm hidden-xs" role="banner">
    <div id="apus-topbar" class="apus-topbar">
        <div class="container">
            <?php if ( studylms_get_config('top_contact_info_v1') ): ?>
                <div class="left-topbar clearfix pull-left">
                    <?php echo trim(studylms_get_config('top_contact_info_v1')); ?>
                </div>
            <?php endif; ?>
            <div class="pull-right accept-account">
                <?php if( !is_user_logged_in() ){ ?>
                        <div class="login-topbar">
                            <a class="login" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_html_e('Login','studylms'); ?>"><?php esc_html_e('Login', 'studylms'); ?></a>
                            <a class="register" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_html_e('Sign Up','studylms'); ?>"><?php esc_html_e('Register', 'studylms'); ?></a>
                        </div>
                    <?php } else { ?>
                        <?php if ( has_nav_menu( 'topmenu' ) ) : ?>
                            <div class="site-header-topmenu">
                                <div class="dropdown login-topbar">
                                    <a class="account" href="#" data-toggle="dropdown" aria-expanded="true" role="button" aria-haspopup="true" data-delay="0">
                                        <?php esc_html_e( 'My Account', 'studylms' ); ?>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <?php
                                            $args = array(
                                                'theme_location' => 'topmenu',
                                                'container_class' => 'collapse navbar-collapse',
                                                'menu_class' => 'nav navbar-nav',
                                                'fallback_cb' => '',
                                                'menu_id' => 'topmenu-menu',
                                                'walker' => new Studylms_Nav_Menu()
                                            );
                                            wp_nav_menu($args);
                                        ?>
                                    </div>
                                </div>
                                
                            </div>
                        <?php endif; ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="headertop <?php echo (studylms_get_config('keep_header') ? 'main-sticky-header-wrapper' : ''); ?>">
        <div class="header-main clearfix <?php echo (studylms_get_config('keep_header') ? 'main-sticky-header' : ''); ?>">
            <div class="container">
                <div class="header-inner">
                        <div class="row">
                        <!-- LOGO -->
                            <div class="col-md-2">
                                <div class="logo-in-theme text-center">
                                    <?php get_template_part( 'page-templates/parts/logo' ); ?>
                                </div>
                            </div>
                            <div class="col-md-10 p-static">
                                <div class="left-menu clearfix">
                                    <!-- //LOGO -->
                                    <div class="heading-right pull-right hidden-sm hidden-xs">
                                        <div class="pull-right header-setting">
                                            <div class="apus-search pull-right">
                                               <button type="button" class="button-show-search button-setting"><i class="fa fa-search"></i></button>
                                            </div>
                                            <?php if ( studylms_get_config('show_woo_cart') && defined('STUDYLMS_WOOCOMMERCE_ACTIVED') && STUDYLMS_WOOCOMMERCE_ACTIVED ): ?>
                                                <div class="pull-right">
                                                    <!-- Setting -->
                                                    <div class="top-cart hidden-xs">
                                                        <?php get_template_part( 'woocommerce/cart/mini-cart-button' ); ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <?php if ( has_nav_menu( 'primary' ) ) : ?>
                                        <div class="main-menu  pull-right">
                                            <nav 
                                             data-duration="400" class="hidden-xs hidden-sm apus-megamenu slide animate navbar" role="navigation">
                                            <?php   $args = array(
                                                    'theme_location' => 'primary',
                                                    'container_class' => 'collapse navbar-collapse',
                                                    'menu_class' => 'nav navbar-nav megamenu',
                                                    'fallback_cb' => '',
                                                    'menu_id' => 'primary-menu',
                                                    'walker' => new Studylms_Nav_Menu()
                                                );
                                                wp_nav_menu($args);
                                            ?>
                                            </nav>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="full-top-search-form">
                <?php get_template_part( 'page-templates/parts/productsearchform-popup' ); ?>
            </div>
        </div>
    </div>
</header>