<?php get_header(); ?>
<?php get_template_part( 'tpl', 'page-title' ); ?>
<div class="container marg-xs-t50 marg-lg-t65 padd-only-xs">
    <div class="row marg-xs-b0">
        <div class="col-sm-12 col-md-6">
            <div class="wpc-error style-2 text-center">
                <h4 class="error-subtitle"><?php esc_html_e("The Page you requested does not exist", 'onetheme'); ?></h4>
                <h2 class="error-title">4<span class="fa fa-chain-broken"></span>4</h2>
                <p class="error-text"><?php esc_html_e("Sorry, the post you are looking for is not available. Maybe you want to perform a search?", 'onetheme'); ?></p>
                <div class="error-buttons text-center"><a href="<?php echo esc_url(home_url('/')); ?>" class="wpc-btn style-2 size-2">
                <?php esc_html_e("go back", 'onetheme'); ?></a><a href="<?php echo esc_url(home_url('/')); ?>" class="wpc-btn size-2"><?php esc_html_e("go home", 'onetheme'); ?></a></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 marg-sm-t100"><img src="<?php echo esc_url(get_template_directory_uri().'/images/error.png');?>" alt="<?php esc_html_e("404!", 'onetheme'); ?>" class="outer-error-img img-responsive center-block"></div>
    </div>
</div>
<?php get_footer(); ?>

