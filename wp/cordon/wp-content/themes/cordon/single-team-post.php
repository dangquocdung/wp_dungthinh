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
			<div class="container-fluid clearfix">
						
						
				<?php while (have_posts()) : the_post(); ?>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4"> 
                            <div class="port-inner">
                                
                                <div class="port-box"></div>
                                <div class="port-img width-img img-bg" data-background="<?php echo get_the_post_thumbnail_url(); ?>"></div>
                                <div class="img-mask"></div>
                                <div class="port-dbox">
                                    <div class="dbox-relative">
                                        <h3><?php the_title(); ?></h3>
                                        <p><?php echo esc_attr( get_post_meta($post->ID, 'tp_post', true)); ?></p>
                                        <ul class="team-sicon">
                                            <?php if ( get_post_meta($post->ID, 'fb_si', true) != "") { ?>
                                            <li>
                                                <a href="<?php echo esc_url( apply_filters('get_the_content', get_post_meta($post->ID, 'fb_si', true))); ?>">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </li>
                                            <?php } ?>
                                            <?php if ( get_post_meta($post->ID, 'twit_si', true) != "") { ?>
                                            <li>
                                                <a href="<?php echo esc_url(  apply_filters('get_the_content', get_post_meta($post->ID, 'twit_si', true))); ?>">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            </li>
                                            <?php } ?>
                                            <?php if ( get_post_meta($post->ID, 'pinterest_si', true) != "") { ?>
                                            <li>
                                                <a href="<?php echo esc_url(  apply_filters('get_the_content', get_post_meta($post->ID, 'pinterest_si', true))); ?>">
                                                    <i class="fa fa-pinterest"></i>
                                                </a>
                                            </li>
                                            <?php } ?>
                                            <?php if ( get_post_meta($post->ID, 'gp_si', true) != "") { ?>
                                            <li>
                                                <a href="<?php echo esc_url(  apply_filters('get_the_content', get_post_meta($post->ID, 'gp_si', true))); ?>">
                                                    <i class="fa fa-google-plus"></i>
                                                </a>
                                            </li>
                                            <?php } ?>
                                            <?php if ( get_post_meta($post->ID, 'instagram_si', true) != "") { ?>
                                            <li>
                                                <a href="<?php echo esc_url(  apply_filters('get_the_content', get_post_meta($post->ID, 'instagram_si', true))); ?>">
                                                    <i class="fa fa-instagram"></i>
                                                </a>
                                            </li>
                                            <?php } ?>
                                            <?php if ( get_post_meta($post->ID, 'xing_si', true) != "") { ?>
                                            <li>
                                                <a href="<?php echo esc_url(  apply_filters('get_the_content', get_post_meta($post->ID, 'xing_si', true))); ?>">
                                                    <i class="fa fa-xing"></i>
                                                </a>
                                            </li>
                                            <?php } ?>
                                            <!--ANOTHER SOCIAL ICON LIST-->
                                            <?php
                                                 /* get the icon list */
                                                 $socials =  get_post_meta($post->ID, 'another_si',  true);
                                                 
                                                 if ( ! empty( $socials ) ) {
                                                     foreach( $socials as $social ) {
                                                         echo '
                                                         <li><a href="' . esc_url($social['si_icon_link']) . '"><i class="fa ' . esc_attr($social['si_icon']) . '"></i></a></li>
                                                        ';
                                                     }
                                                 }				
                                            ?>
                                            <!--ANOTHER SOCIAL ICON LIST END-->
                                        
                                            <?php if ( get_post_meta($post->ID, 'email_si', true) != "") { ?>
                                            <li>
                                                <a href="mailto:<?php echo esc_attr(apply_filters('get_the_content', get_post_meta($post->ID, 'email_si', true))); ?>">
                                                    <i class="fa fa-envelope-o"></i>
                                                </a>
                                            </li>
                                            <?php } ?>
                                        </ul><!--/.team-sicon-->
                                    </div><!--/.dbox-relative-->
                                </div><!--/.port-dbox-->
                            
                            </div><!--/.port-inner-->
                            
                            
                    </div>
                </div>
                <?php endwhile; ?>
			</div><!--/.container-->
		</div><!--/.blog-wrapper-->


               
    <?php  get_footer(); ?>