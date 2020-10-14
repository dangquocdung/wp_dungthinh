<?php
/* ==========================================================
  ALBUM
=========================================================== */
if ( !function_exists('eunice_album_function')) {
  function eunice_album_function( $atts, $content = NULL ) {
    extract(shortcode_atts(array(
      'album_title'  => '',
      'cover_image'  => '',
      'album_click_style'  => '',
      'custom_link'  => '',
      'popup_images'  => '',
      'category_link'  => '',
    ), $atts));
    ob_start();

    // Shortcode Style CSS
    $e_uniqid        = uniqid();
    $custom_img_link = get_post_meta($cover_image, '_image_media_link', true);
    if ( $album_click_style == 'custom-popups' ) {
      $data_rel = 'data-rel="gallery"';
    } else {
      $data_rel = '';
    }

    $category_link = (int)$category_link;
    if ($album_click_style == 'custom-link') {
      $link = $custom_link;
    } elseif($album_click_style == 'custom-popups') {
      if( !empty($custom_img_link )) {
        $link = $custom_img_link;
      } else {
        $link = wp_get_attachment_image_url( $cover_image, 'full' );
      }
    } elseif($album_click_style == 'category-link') {
      $link = get_term_link( $category_link, 'gallery_category');
    } else {
      $link = '';
    }
    $popup_images = explode(',', $popup_images);

    if ( $cover_image ) {
      $cover_image = wp_get_attachment_image_url( $cover_image, 'full' );
    } else {
      $cover_image = EUNICE_PLUGIN_IMGS.'/featured-image.png';
    }
    ?>
    <div class="grid-item media-box single-item album-media album-custom-shortcode album-popup-gallery">
      <a href="<?php echo $link; ?>" class="single-img" <?php echo $data_rel; ?> >
        <img src="<?php echo esc_url( $cover_image ); ?>" alt="<?php echo esc_attr( $album_title ); ?>">
        <div class="media-box-img-cation">
          <div class="album media-box-text">
            <h5><?php echo $album_title; ?></h5>
          </div>
        </div>
      </a>
      <?php
      if(!empty($popup_images)):
        foreach ($popup_images as $key => $img) :
          $eunice_alt = get_post_meta($img, '_wp_attachment_image_alt', true);
          $attachment_title = get_the_title($img);
          if(!empty($eunice_alt)) {
            $eunice_altt = $eunice_alt;
          } else {
            $eunice_altt = $attachment_title;
          }
          echo '<a href="'.esc_url( wp_get_attachment_image_url( $img, 'full' ) ).'" data-sub-html="'.esc_attr( $eunice_altt ).'" data-rel="gallery"></a>';
        endforeach;
      endif;
      ?>
    </div><!--/ Filter single image item end-->
    <?php
    // Return outbut buffer
    return ob_get_clean();
  }
}
add_shortcode( 'eunice_album', 'eunice_album_function' );
