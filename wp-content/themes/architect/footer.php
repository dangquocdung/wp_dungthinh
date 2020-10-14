<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package architect
 */
global $architect_option; ?>

<!-- Footer --> 
<?php 
  if(isset($architect_option['footer_layout']) and $architect_option['footer_layout']=="footer2" ){
    get_template_part('framework/footers/footer-2'); 
  }elseif(isset($architect_option['footer_layout']) and $architect_option['footer_layout']=="footer3" ){
    get_template_part('framework/footers/footer-3'); 
  }else{ 
?>
  <footer class="footer-v1">
      <div class="footer-left">
        <?php if ($architect_option['logo_ft']['url'] != '') { ?>
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
              <img src="<?php echo esc_url($architect_option['logo_ft']['url']); ?> " class="img-responsive" alt="Image">
          </a>
        <?php } ?>            
      </div>
      <!-- End Left Footer -->
      <nav>
          <?php
            $primary = array(
                'theme_location'  => 'footermenu',
                'menu'            => '',
                'container'       => '',
                'container_class' => '',
                'container_id'    => '',
                'menu_class'      => '',
                'menu_id'         => '',
                'echo'            => true,
                'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                'walker'          => new wp_bootstrap_navwalker(),
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '<ul>%3$s</ul>',
                'depth'           => 0,
            );
            if ( has_nav_menu( 'footermenu' ) ) {
                wp_nav_menu( $primary );
            }
          ?> 
      </nav>
      <!-- End Nav Footer -->
      <div class="footer-right">
          <?php architect_custom_footer_socials(); ?>
      </div>
      <!-- End Right Footer -->
    </footer>
<?php } ?>
<!-- End Footer -->

    <section class="copyright">
        <?php echo wp_kses( $architect_option['footer_text'], wp_kses_allowed_html('post') ); ?>
    </section>
  </div>
</div>
<!-- End page -->
<a id="to-the-top"><i class="fa fa-angle-up"></i></a> 
<?php wp_footer(); ?>

</body>
</html>
