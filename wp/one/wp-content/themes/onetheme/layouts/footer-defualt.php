<?php
$footer1 = TT::get_option_bg_value('footer_bg_image');
?>
<footer id="footer" class="wpc-footer bg-c-2  marg-lg-t50 wpc-overlay color-6" style="<?php echo esc_attr($footer1); ?>">
    <div class="container footer-container">
        
        <div class="col-md-12">
            <div class="footer-logo text-center">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-wrap style-2"><img src="<?php echo esc_url(TT::get_mod('logo_image')); ?>" alt="<?php bloginfo('name');?>">
                    <div class="logo-text text-left"><i><?php esc_url(bloginfo('name'));?></i><br><span><?php esc_url(bloginfo('description'));?></span></div>
                </a>
            </div>
        </div>
        <div class="row">
            <?php
            $footer_col = 3;
            $footer_columns = array();
            $footer_style = TT::get_mod('footer_style');
            switch ($footer_style) {
                case '1':
                    $footer_col = 1;
                    $footer_columns = array(
                        'col-sm-12'
                    );
                    break;
                case '2':
                    $footer_col = 2;
                    $footer_columns = array(
                        'col-sm-6',
                        'col-sm-6'
                    );
                    break;
                case '3':
                    $footer_col = 3;
                    $footer_columns = array(
                        'col-sm-4',
                        'col-sm-4',
                        'col-sm-4'
                    );
                    break;
                case '4':
                    $footer_col = 4;
                    $footer_columns = array(

                        'col-sm-6 col-md-3',
                        'col-sm-6 col-md-3',
                        'col-sm-6 col-md-3',
                        'col-sm-6 col-md-3'
                    );
                    break;
                case '5':
                    $footer_col = 4;
                    $footer_columns = array(
                        'col-sm-6 col-md-4',
                        'col-sm-6 col-md-3',
                        'col-sm-6 col-md-2',
                        'col-sm-6 col-md-3'
                    );
                    break;
                default:
                    $footer_col = 3;
                    $footer_columns = array(
                        'col-sm-4',
                        'col-sm-4',
                        'col-sm-4'
                    );
                    break;
            }
            for ($i = 1; $i <= $footer_col; $i++) {

                if( is_active_sidebar('footer' . $i)){
                    print("<div class='" . $footer_columns[$i - 1] . " one-column footer-column-$i'>");
                    dynamic_sidebar('footer' . $i);
                    echo '</div>';
                }
                
            }
            ?>
            
            
        </div>
    </div>
   <?php get_template_part('layouts/sub', 'footer'); ?>
</footer>


