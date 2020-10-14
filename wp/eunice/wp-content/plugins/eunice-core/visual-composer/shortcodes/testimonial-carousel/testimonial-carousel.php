<?php
/* Testimonial Carousel */
if ( !function_exists('ence_testimonial_carousel_function')) {
  function ence_testimonial_carousel_function( $atts, $content = true ) {
    extract(shortcode_atts(array(
      'title'  => '',
      'class'  => '',
      // Listing
      'testimonial_limit'  => '',
      'testimonial_order'  => '',
      'testimonial_orderby'  => '',
      // Color & Style
      'title_color'  => '',
      'title_size'  => '',
      'content_color'  => '',
      'content_size'  => '',
      'name_color'  => '',
      'name_size'  => '',
      'profession_color'  => '',
      'profession_size'  => '',
    ), $atts));

    // Shortcode Style CSS
    $e_uniqid        = uniqid();
    $inline_style  = '';
    // Title
    if ( $title_color || $title_size ) {
      $inline_style .= '.ence-testi-carousel-'. $e_uniqid .'  .single-testimonial h3{';
      $inline_style .= ( $title_color ) ? 'color:'. $title_color .';' : '';
      $inline_style .= ( $title_size ) ? 'font-size:'. eunice_core_check_px($title_size) .';' : '';
      $inline_style .= '}';
    }
    // Content
    if ( $content_color || $content_size ) {
      $inline_style .= '.ence-testi-carousel-'. $e_uniqid .'  .single-testimonial blockquote, .ence-testi-carousel-'. $e_uniqid .' .single-testimonial p, .ence-testi-carousel-'. $e_uniqid .' .single-testimonial q {';
      $inline_style .= ( $content_color ) ? 'color:'. $content_color .';' : '';
      $inline_style .= ( $content_size ) ? 'font-size:'. eunice_core_check_px($content_size) .';' : '';
      $inline_style .= '}';
    }
    // Name
    if ( $name_color || $name_size ) {
      $inline_style .= '.ence-testi-carousel-'. $e_uniqid .' .single-testimonial .membar-intro-name{';
      $inline_style .= ( $name_color ) ? 'color:'. $name_color .';' : '';
      $inline_style .= ( $name_size ) ? 'font-size:'. eunice_core_check_px($name_size) .';' : '';
      $inline_style .= '}';
    }
    // Profesion
    if ( $profession_color || $profession_size ) {
      $inline_style .= '.ence-testi-carousel-'. $e_uniqid .' .single-testimonial .membar-intro-name span{';
      $inline_style .= ( $profession_color ) ? 'color:'. $profession_color .';' : '';
      $inline_style .= ( $profession_size ) ? 'font-size:'. eunice_core_check_px($profession_size) .';' : '';
      $inline_style .= '}';
    }

    // add inline style
    add_inline_style( $inline_style );
    $styled_class  = ' ence-testi-carousel-'. $e_uniqid;
    // Turn output buffer on
    ob_start();
    ?>
    <div class="text-center  testimonials-content <?php echo $class.$styled_class; ?>">
      <h3 class="testimonial-title"><?php echo $title; ?></h3>
      <div id="testimonials" class="fix member-testimonials">
        <?php
        $args = array(
          'post_type'           => 'testimonials',
          'order'               => $testimonial_order,
          'orderby'             => $testimonial_orderby,
          'posts_per_page'      => $testimonial_limit,
        );
        $query = new WP_Query( $args );
        if( $query->have_posts() ): while( $query->have_posts() ): $query->the_post();
        $testimonial_options = get_post_meta( get_the_ID(), 'testimonial_options', true );
        ?>
          <div class="text-center single-testimonial">
            <blockquote>
              <p>
                <q>
                  <?php the_content(); ?>
                </q>
              </p>
            </blockquote>
            <h4 class="membar-intro-name">
              <?php echo $testimonial_options['testi_name']; ?> - <span>
              <?php echo $testimonial_options['testi_pro']; ?></span>
            </h4>
          </div><!--/member single  testimonial end-->
        <?php
        endwhile;
        wp_reset_postdata();
        else:
          echo '<p>'.esc_html__( 'There is no Testimonial set', 'eunice-core' ).'</p>';
        endif; ?>
      </div>
    </div>
    <?php
    // Return outbut buffer
    return ob_get_clean();
  }
}
add_shortcode( 'ence_testimonial_carousel', 'ence_testimonial_carousel_function' );