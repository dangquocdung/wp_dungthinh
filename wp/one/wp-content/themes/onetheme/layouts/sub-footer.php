<div class="wpc-footer bg-c-2 style-2 marg-lg-t50 wpc-overlay color-6">          
    <div class="footer-bottom bg-c-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-6 no-padd">
                    <div class="bottom-nav">
                    <?php
                        wp_nav_menu( array(
                            'menu_class'        => '',
                            'theme_location'    => 'footer',
                            'container'         => '',
                            'depth'             => 1,
                        ) );
                    ?>
                    </div>
                </div>
                <div class="col-md-6 col-md-pull-6">
                    <div class="footer-copyright"><?php
                        $allowed_tags = array(
                            'a' => array( 'href'=>array(), 'title'=>array()),
                            'span' => array()
                        );
                        printf( wp_kses( '%s', $allowed_tags ), TT::get_mod('copyright_content', '') );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>