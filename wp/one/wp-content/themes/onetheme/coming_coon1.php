<?php
 /* Template Name: Coming soon 1 */
  wp_head();  

  $coming_bg_image = TT::get_mod('coming_coon');
  $coming_style = TT::get_mod('coming_style');
  $coming_end_date = TT::get_mod('coming_end_date');
 ?>
  <!-- MAIN -->
    <div class="wpc-cs <?php echo esc_attr($coming_style); ?>"><img src="<?php echo esc_attr($coming_bg_image); ?>" alt="<?php esc_html_e("image", 'onetheme'); ?>" class="wpc-back-img">
        <main class="cs-main">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-wrap style-2"><img src="<?php echo esc_url(TT::get_mod('logo_image_coming')); ?>" alt="<?php esc_html_e("image", 'onetheme'); ?>">
                <div class="logo-text text-left"><i><?php esc_url(bloginfo('name'));?></i><br><span><?php esc_url(bloginfo('description'));?></span></div>
            </a>
            <h4 class="cs-subtitle">
            	<?php
	                $allowed_tags = array(
	                    'a' => array( 'href'=>array(), 'title'=>array()),
	                    'span' => array()
	                );
	                printf( wp_kses( '%s', $allowed_tags ), TT::get_mod('comming_title', 'onetheme') );
	            ?>
            </h4>
            <h1 class="cs-title"><b><?php esc_html_e("Coming", 'onetheme'); ?></b><?php esc_html_e("Soon", 'onetheme'); ?></h1>
            <div class="wpc-coming-soon style-2" data-end="<?php echo esc_attr($coming_end_date); ?>"></div>
        </main>
        <footer class="cs-footer"> 
        	<span class="cs-footer-copy">
        		<?php
	                $allowed_tags = array(
	                    'a' => array( 'href'=>array(), 'title'=>array()),
	                    'span' => array()
	                );
	                printf( wp_kses( '%s', $allowed_tags ), TT::get_mod('copyright_content', 'onetheme') );
	            ?>
    		</span>
        </footer>
    </div>
<?php wp_footer(); ?>