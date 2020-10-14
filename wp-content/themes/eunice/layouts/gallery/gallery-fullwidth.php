<?php
$eunice_id    = ( isset( $post ) ) ? $post->ID : 0;
$gallery_metaboxes  = get_post_meta( $eunice_id, 'gallery_metaboxes', true );
$gallery_images = explode(',', $gallery_metaboxes["gallery_images_for_galleries"]);

$client_url = $gallery_metaboxes["client_url"];
$portfolio_client = $gallery_metaboxes["portfolio_client"];
$theme_gallery_url = cs_get_option('theme_gallery_url');
?>

  <div id="fullwidth_slider_warp" class="gallery eunice-fw same-controls">

    <div id="gallery-slider" class="owl-carousel">
    <?php
      foreach ($gallery_images as $key => $image) {
      $imagess = wp_get_attachment_image_src( $image, 'full' );
      $eunice_alt = get_post_meta($image, '_wp_attachment_image_alt', true); ?>
        <div class="slide-item">
          <span class="slider-cation"> <?php echo esc_attr($eunice_alt); ?></span>
          <img src="<?php echo esc_url($imagess[0]); ?>" alt="<?php echo esc_attr($eunice_alt); ?>">
        </div>
      <?php  }  ?>
    </div>
    <div class="gallery-slider-length gallary-slider-length"></div>
    <div class="clear-both"></div>
  </div>

  <!--content start\-->
  <div class="container container-width-990">
    <article class="entry-content-warp gallery-single-fullwidth-warp">

    <!--gallery content start\-->
    <div class="entry-content">

      <!--content text start\-->
      <div class="entry-content-text">
        <h2><?php the_title(); ?></h2>
        <?php the_content(); ?>
      </div><!--/content text end-->

      <!-- gallery meta start\-->
      <div class="content-meta">
        <ul class="list-inline">
        <?php if( !empty($client_url) ){ ?>
          <li>
            <div class="single-meta">
              <h5 class="text-uppercase meta-title"><?php esc_html_e('Website', 'eunice'); ?></h5>
              <a class="meta-cont" href="<?php echo esc_url($client_url); ?>"><?php echo esc_attr($client_url); ?></a>
            </div>
          </li>
        <?php } if( !empty($portfolio_client )){ ?>
          <li>
            <div class="single-meta">
              <h5 class="meta-title"><?php esc_html_e('Clients', 'eunice'); ?></h5>
              <a class="meta-cont" href="<?php echo esc_url($client_url); ?>"><?php echo esc_attr($portfolio_client); ?></a>
            </div>
          </li>
        <?php } if( !empty( get_the_term_list( $eunice_id, 'gallery_category', '', ',', '' ) ) ) { ?>
          <li>
            <div class="single-meta">
              <h5 class="meta-title"><?php esc_html_e('Category', 'eunice'); ?></h5>
              <?php echo get_the_term_list( $eunice_id, 'gallery_category', '', ', ', '' );  ?>
            </div>
          </li>
        <?php } ?>
        </ul>
      </div><!--/ gallery meta end-->

    </div><!--/gallery content end-->

    <!--gallery social start /-->
    <div class="socail-box">
      <div class="col-xs-4 text-left">
        <div class="post-like">
          <?php if( function_exists('zilla_likes') ) {
            zilla_likes();
            $likes = esc_attr(get_post_meta($post->ID, '_zilla_likes', true));
            $likes = (int) $likes;
            if ($likes > 1) {
              echo ' <span class="zila-like-prefix-custom">'. esc_html__('Likes', 'eunice') .'</span>';
            } else {
              echo ' <span class="zila-like-prefix-custom">'. esc_html__('Like', 'eunice') .'</span>';
            }
          } ?>
        </div>
      </div>
      <div class="col-xs-8 text-right socail-share-box">
        <?php echo eunice_wp_share_option(); ?>
      </div>
    </div><!--/ gallery social end-->

    <!--gallery page  Paginate links start /-->
    <div class="fix paged-links">

      <div class="col-xs-6 prive-and-next-warp">
        <?php echo eunice_gallery_pagination(); ?>
      </div>

      <!-- pagenation link start /-->
      <divA class="col-xs-6 pagenat-box">
        <a href="<?php echo esc_url($theme_gallery_url); ?>">
          <span class="pagenat-top-box">
            <span></span>
            <span></span>
            <span></span>
          </span>
          <span class="pagenat-bottom-box">
            <span></span>
            <span></span>
            <span></span>
          </span>
        </a>
      </div><!--/ end-->

      </div><!--gallery page  Paginate links end /-->

    </article><!--/content end-->
  </div>