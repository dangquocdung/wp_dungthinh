<?php

get_header(); ?>
        
		<!--HOME START-->
		<div id="home" class="clearfix">
			<!--HEADER START-->
			<?php get_template_part( 'loop/menu','normal'); ?>
			<!--HEADER END-->
		</div><!--/home end-->
		<!--HOME END--> 
        
        <div class="content blog-wrapper">

		<?php while (have_posts()) : the_post(); ?>
        <!--SLIDER HOME START-->
            <div class="home-slider ani-slider slider container-fluid" data-slick='{"autoplaySpeed": <?php echo esc_attr( get_post_meta($post->ID, 'slider_delay',  true));  ?>}'>
            
                		<?php 
                              /* get the slider list array */
                              $lists = get_post_meta($post->ID, 'slider_list',  true);
                              
                              if ( ! empty( $lists ) ) {
                                foreach( $lists as $list ) { ?>
                                
                                <div class="slide">
                                    <div class="slider-mask" data-animation="slideUpReturn" data-delay="0.1s"></div>
                                    <div class="slider-img-bg" data-animation="puffIn" data-delay="0.2s" data-animation-duration="0.7s" 
                                    data-background="<?php echo esc_url ( $list['slider_image'] );  ?>" 
                                    <?php if ( get_post_meta($post->ID, 'para_slide',  true) == 'on'){  ?>
                                    data-stellar-background-ratio="<?php echo esc_attr(get_post_meta($post->ID, 'para_ratio',  true));  ?>"
                                    <?php } ?> ></div>
                                    <div class="slider-box container-fluid">
                                        <div class="slider-content">
                                            <div class="slider-hidden">
                                                <h3 class="slider-title" data-animation="fadeInUp" data-delay="0.8s"><?php echo wp_kses_post( $list['title']);  ?></h3>
                                            </div><!--/.slider-hidden-->
                                            
                                            <div class="slider-line"  data-animation="swashIn" data-delay="0.5s"></div>
                                            
                                            <p class="slider-text" data-animation="fadeInDown" data-delay="1s">
                                                <?php echo wp_kses_post( $list['bottom_text']);  ?>
                                            </p>
                                            
                                            <?php if ( $list['slider_link'] != '' && $list['slider_text'] != ''){  ?>
                                                <div class="btn-relative" data-animation="swashIn" data-delay="1.5s" data-animation-duration="1s">
                                                    <a href="<?php echo esc_url($list['slider_link']);  ?>" class="slider-btn"><?php echo esc_attr($list['slider_text']);  ?></a>
                                                </div><!--/.btn-relative-->
                                            <?php } ?>
                                                
                                        </div><!--/.slider-content-->
                                    </div><!--/.slider-box-->
                                </div><!--/.slide-->
            
                                  
                                <?php } } ?>
                
                
            </div><!--/.slider-->
			<!--SLIDER HOME END-->                     
        
        <?php endwhile; ?>
        </div>
<?php  get_footer(); ?>