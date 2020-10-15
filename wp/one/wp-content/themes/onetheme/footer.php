<?php 
    get_template_part('layouts/footer', 'defualt');
?>
    <div id="search"> 
        <span class="close"><?php esc_html_e('X','onetheme')?></span> 
        <form role="search" id="searchform" action="<?php echo esc_url(home_url('/')); ?>" method="get">
            <input value="" name="s" type="search" placeholder="<?php esc_html_e("Type to search","onetheme")?>"/>
        </form>
    </div>
    <div id="login-form">
        <div class="login-wrap clearfix">
            <div class="login-col wpc-overlay color-5">
                <img src="<?php echo esc_url(get_template_directory_uri().'/images/login-bg.jpg');?>" class="wpc-back-img img-responsive" alt="<?php bloginfo('name'); ?>">
                <div class="login-col-box">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-wrap style-2">
                        <img src="<?php echo esc_url(TT::get_mod('logo_image')); ?>" alt="<?php esc_url(bloginfo('name')); ?>">
                        <div class="logo-text text-left"><i><?php esc_url(bloginfo('name'));?></i><br><span><?php esc_url(bloginfo('description'));?></span></div>
                    </a>
                </div>
            </div>
            <div class="signup-col">
                <div class="signup-col-box">
                    <h3 class="log-from-caption"><?php esc_html_e("LOGIN FORM", 'onetheme'); ?></h3> 
                    <?php
                        if ( ! is_user_logged_in() ) { // Display WordPress login form:
                            $args = array(
                                'redirect' => admin_url(), 
                                'form_id' => 'log-inp',
                                'label_username' => esc_attr__('Username', 'onetheme'),
                                'label_password' => esc_attr__('Password', 'onetheme'),
                                'label_remember' => esc_attr__('Remember me', 'onetheme'),
                                'label_log_in' => esc_attr__('Log In now', 'onetheme'),
                                'remember' => true
                            );
                            wp_login_form( $args );
                        } else { // If logged in:
                            wp_loginout( esc_url(home_url('/')) ); // Display "Log Out" link.
                            echo " | ";
                            wp_register('', '', true); // Display "Site Admin" link.
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php wp_footer(); ?>
</div>
<!-- wrapper -->
</body>
</html>