<?php 
/* Template Name: error 2*/
get_header(); ?>

 <?php get_template_part( 'tpl', 'page-title' ); ?>
<div class="container marg-xs-t100 marg-lg-t140 padd-only-xs">
    <div class="row marg-xs-b0">
        <div class="col-sm-12 ">
            <div class="wpc-error text-center">
                <h2 class="error-title">4<span class="fa fa-chain-broken"></span>4</h2>
                <h4 class="error-subtitle"><?php esc_html_e("The Page you requested does not exist", 'onetheme'); ?></h4>
                <p class="error-text"><?php esc_html_e("Sorry, the post you are looking for is not available. Maybe you want to perform a search?", 'onetheme'); ?></p>
                <div class="error-buttons text-center"><a href="<?php echo esc_url(home_url('/')); ?>" class="wpc-btn style-2 size-2">
                <?php esc_html_e("go back", 'onetheme'); ?></a><a href="<?php echo esc_url(home_url('/')); ?>" class="wpc-btn size-2"><?php esc_html_e("go home", 'onetheme'); ?></a></div>
            </div>
        </div>
         <img src="<?php echo esc_url(get_template_directory_uri().'/images/error.png');?>" alt="<?php esc_html_e("404!", 'onetheme'); ?>" class="outer-error-img img-responsive center-block"> 
    </div>
</div>
<?php get_footer(); ?>

