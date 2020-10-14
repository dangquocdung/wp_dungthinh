<header id="apus-header" class="site-header apus-header header-v3 hidden-sm hidden-xs" role="banner">
    <div id="apus-topbar" class="apus-topbar">
        <div class="container">
            <?php if ( studylms_get_config('top_slogan') ): ?>
                <div class="pull-left slogan">
                    <?php echo trim(studylms_get_config('top_slogan')); ?>
                </div>
            <?php endif; ?>

            <?php if(is_active_sidebar('socials-sidebar')){ ?>
                <div class="pull-right">
                    <?php dynamic_sidebar('socials-sidebar'); ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="header-top">
        <div class="container">
            <div class="logo-in-theme pull-left">
                <?php get_template_part( 'page-templates/parts/logo-dark' ); ?>
            </div>
            <?php if ( studylms_get_config('top_contact_info_v3') ): ?>
                <div class="pull-right">
                    <?php echo trim(studylms_get_config('top_contact_info_v3')); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="headerbottom p-relative <?php echo (studylms_get_config('keep_header') ? 'main-sticky-header-wrapper' : ''); ?>">
        <div class="header-main clearfix <?php echo (studylms_get_config('keep_header') ? 'main-sticky-header' : ''); ?>">
            <div class="container">
                <div class="header-inner pull-left clearfix">
                    <?php if ( has_nav_menu( 'primary' ) ) : ?>
                        <div class="main-menu  pull-left">
                            <nav data-duration="400" class="hidden-xs hidden-sm apus-megamenu slide animate navbar" role="navigation">
                            <?php $args = array(
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
                    <div class="heading-right pull-left hidden-sm hidden-xs">
                        <div class="header-setting">
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
                </div>
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
            <div class="full-top-search-form">
                <?php get_template_part( 'page-templates/parts/productsearchform-popup' ); ?>
            </div>
        </div>
    </div>
</header>