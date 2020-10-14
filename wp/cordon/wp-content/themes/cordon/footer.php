
		<?php if ( is_singular() && function_exists( 'ot_get_option' )  && ot_get_option( 'footer_style') == 'foot_fixed') { ?>
        <div class="transparent clearfix"><!--to create margin bottom on contact section--></div>
        <?php } ?>
		<footer class="footer <?php if ( is_singular() &&  function_exists( 'ot_get_option' )  && ot_get_option( 'footer_style') == 'foot_fixed') { echo 'footer-two clearfix';}?>">
        
			<div class="container-fluid">
                <?php if  ( function_exists( 'ot_get_option' ) && ot_get_option( 'foot_img' ) != '') { ?>
            	<img class="footer-img" src="<?php echo esc_url (ot_get_option( 'foot_img' )); ?>"	 alt="logo">
                <?php } ?>
                <div class="clearboth clearfix"></div>
                <?php 
				if  ( function_exists( 'ot_get_option' ) && ot_get_option( 'fot_text' )) { 
				$cordon_fot_text = ot_get_option( 'fot_text' );
				echo wp_kses_post( $cordon_fot_text); } else { echo '<p> 11231 Buah Batu Bandung - Jawa barat Indonesia</p>
                <p>Made with <i class="fa fa-coffee"></i> in Bandung  &copy;2017 <a href="#">example.com</a></p>';}
				?>
                
                <ul class="footer-icon">
                    <?php if ( function_exists( 'ot_get_option' ) ) :if (ot_get_option( 'fb_foot')) :  ?>
                        <li><a href="<?php  echo esc_url( ot_get_option( 'fb_foot' )); ?>"><i class="fa fa-facebook"></i></a></li>
                    <?php endif ; endif; ?>
                    <?php if ( function_exists( 'ot_get_option' ) ) :if (ot_get_option( 'gp_foot')) :  ?>
                        <li><a href="<?php  echo esc_url(ot_get_option( 'gp_foot' )); ?>"><i class="fa fa-google-plus"></i></a></li>
                    <?php endif ; endif; ?>
                    <?php if ( function_exists( 'ot_get_option' ) ) :if (ot_get_option( 'twit_foot')) :  ?>
                        <li><a href="<?php  echo esc_url(ot_get_option( 'twit_foot') ); ?>"><i class="fa fa-twitter"></i></a></li>
                    <?php endif ; endif; ?>
                    <?php if ( function_exists( 'ot_get_option' ) ) :if (ot_get_option( 'insta_link')) :  ?>
                        <li><a href="<?php  echo esc_url(ot_get_option( 'insta_link') ); ?>"><i class="fa fa-instagram"></i></a></li>
                    <?php endif ; endif; ?>
                    <?php if ( function_exists( 'ot_get_option' ) ) :if (ot_get_option( 'pint_foot')) :  ?>
                        <li><a href="<?php  echo esc_url(ot_get_option( 'pint_foot' )); ?>"><i class="fa fa-pinterest"></i></a></li>
                    <?php endif ; endif; ?>
                    <?php if ( function_exists( 'ot_get_option' ) ) :if (ot_get_option( 'xing_foot')) :  ?>
                        <li><a href="<?php  echo esc_url(ot_get_option( 'xing_foot') ); ?>"><i class="fa fa-xing"></i></a></li>
                    <?php endif ; endif; ?>
                    <!--ANOTHER SOCIAL ICON LIST-->
                    <?php
                        if  ( function_exists( 'ot_get_option' )){
                         /* get the icon list */
                         $cordon_hsocials = ot_get_option( 'foot_as_icon', array() );
                         
                         if ( ! empty( $cordon_hsocials ) ) {
                             foreach( $cordon_hsocials as $cordon_hsocial ) {
                                 echo '
                                 <li><a href="' . esc_url( $cordon_hsocial['foot_as_link']) . '"><i class="fa ' . esc_attr( $cordon_hsocial['foot_soc_icon']) . '"></i></a></li>
                                ';
                             }
                         }
                        }				
                    ?>
                    <!--ANOTHER SOCIAL ICON LIST END-->
                </ul><!--/.footer-icon-->
			</div><!--/.container-fluid-->
		</footer><!--/.footer-->
        
        <!--to top button-->
        <a class="to-top" href="#"><i class="fa fa-long-arrow-up"></i></a>
    	</div><!--main-wrapper-->	
        
	<?php wp_footer(); ?>
	</body>
</html>