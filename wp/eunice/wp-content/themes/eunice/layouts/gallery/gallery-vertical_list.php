<?php
$eunice_id    = ( isset( $post ) ) ? $post->ID : 0;
$gallery_metaboxes  = get_post_meta( $eunice_id, 'gallery_metaboxes', true );
$gallery_images = explode(',', $gallery_metaboxes["gallery_images_for_galleries"]);

$client_url = $gallery_metaboxes["client_url"];
$portfolio_client = $gallery_metaboxes["portfolio_client"];
$theme_gallery_url = cs_get_option('theme_gallery_url');
?>

<!--content start\-->
<div class="container container-width-990 gallery-vertical">
  <article class="entry-content-warp">
    <div class="entry-content">
      <!--content start\-->
      <div class="gallery-ver entry-content-text">
        <h2><?php the_title(); ?></h2>
        <?php the_content(); ?>
      </div><!--/end-->
      <!--meta  start\-->
      <div class="content-meta">
        <ul class="list-inline">
        <?php if( !empty($client_url) ){ ?>
          <li>
            <div class="single-meta">
              <h5 class="text-uppercase meta-title"><?php echo esc_html__('Website', 'eunice'); ?></h5>
              <a class="meta-cont" href=""><?php echo esc_attr($client_url); ?></a>
            </div>
          </li>
        <?php }  if( !empty($portfolio_client )){ ?>
          <li>
            <div class="single-meta">
              <h5 class="meta-title"><?php echo esc_html__('Clients', 'eunice'); ?></h5>
              <a class="meta-cont" href=""><?php echo esc_attr($portfolio_client); ?></a>
            </div>
          </li>
        <?php } if( !empty( get_the_term_list( $eunice_id, 'gallery_category', '', ',', '' ) ) ) { ?>
          <li>
            <div class="single-meta">
              <h5 class="meta-title"><?php echo esc_html__('Category', 'eunice'); ?></h5>
              <?php echo get_the_term_list( $eunice_id, 'gallery_category', '', ', ', '' );  ?>
            </div>
          </li>
        <?php } ?>
        </ul>
      </div><!--/end-->
    </div>
    <!--social like sharebox  start\-->
    <div class="gallery-ver socail-box">
      <!-- like box start\-->
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
      </div><!--/end-->

      <!-- share box start\-->
      <div class="col-xs-8 text-right socail-share-box">
        <?php echo eunice_wp_share_option(); ?>
      </div><!--/end-->
    </div><!--/end-->

    <!-- images verticale list start\-->
    <div class="gallery-ver gallery-single-img  gallery-single-vertical-list-img">
      <ul class="list-img">

      <?php
      foreach ($gallery_images as $key => $image) {
        $imagess = wp_get_attachment_image_src( $image, 'full' );
        $eunice_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
        $eunice_caption = get_post($image)->post_excerpt;
      ?>
        <!-- single image& caption start\-->
        <li>
        <img src="<?php echo esc_url($imagess[0]); ?>"
        alt="<?php echo esc_attr($eunice_alt); ?>">
          <div class="text-center port-vertical-cation">
            <h5>- <?php echo esc_attr($eunice_caption); ?></h5>
          </div>
        </li><!--/ end-->
      <?php } ?>
      </ul>

      <!--gallery page  Paginate links start /-->
      <div class="fix gallery-ver paged-links">
        <div class="col-xs-6 prive-and-next-warp">
          <?php echo eunice_gallery_pagination(); ?>
        </div>
        <!-- pagenation link start /-->
        <div class="col-xs-6 pagenat-box">
          <a href="">
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
        </div>
      </div>

    </div><!--/end-->
  </article><!--/content end-->
</div>