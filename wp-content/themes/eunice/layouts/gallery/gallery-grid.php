<?php
$eunice_id    = ( isset( $post ) ) ? $post->ID : 0;
$gallery_metaboxes  = get_post_meta( $eunice_id, 'gallery_metaboxes', true );
$gallery_images = explode(',', $gallery_metaboxes["gallery_images_for_galleries"]);

$client_url = $gallery_metaboxes["client_url"];
$portfolio_client = $gallery_metaboxes["portfolio_client"];
$theme_gallery_url = cs_get_option('theme_gallery_url');

?>
<!--content start\-->
<div class="container container-width-990 gallery-vertical gallery-grid">
  <article class="entry-content-warp">
    <div class="entry-content">
      <!--content start\-->
      <div class="gallery-ver entry-content-text">
        <h2><?php the_title(); ?></h2>
        <?php the_content(); ?>
      </div><!--/end-->

      <!--meta  start\-->
      <div class="gallery-ver content-meta">
        <ul class="list-inline">
        <?php if( !empty($client_url) ){ ?>
          <li>
            <div class="single-meta">
              <h5 class="text-uppercase meta-title"><?php echo esc_html__('Website', 'eunice'); ?></h5>
              <a class="meta-cont" href="<?php echo esc_url($client_url); ?>"><?php echo esc_attr($client_url); ?></a>
            </div>
          </li>
        <?php }
        if( !empty($portfolio_client )){ ?>
          <li>
            <div class="single-meta">
              <h5 class="meta-title"><?php echo esc_html__('Clients', 'eunice'); ?></h5>
              <a class="meta-cont" href="<?php echo esc_url($client_url); ?>"><?php echo esc_attr($portfolio_client); ?></a>
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
    </div><!--/end-->

    <div class="gallery-single-img  gallery-single-grid-list-img">
      <div class="list-img porfolio-grid-list">
        <div  id="grid-warp" class="fit-grid">
        <?php
        foreach ($gallery_images as $key => $image) {
          $imagess = wp_get_attachment_image_src( $image, 'full' );
          $eunice_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
          $image_link = get_post_meta($image, '_image_media_link', true);
          $video_url = get_post_meta($image, '_video_media_url', true);
          $external_link = get_post_meta($image, '_external_link', true);
          if ( !empty( $image_link ) ) {
            $formate = 'image';
            $title = $eunice_alt;
            $data_poster = '';
            $txt = '';
            $data_sub_html = '';
            $link = $image_link;
          } elseif( !empty( $video_url ) ) {
            $formate = 'video';
            $data_poster = $imagess[0];
            $txt = '';
            $title = '';
            $link = $video_url;
            $data_sub_html = $eunice_alt;
          } elseif( !empty( $external_link ) ) {
            $formate = 'link';
            $data_poster = '';
            $txt = '';
            $title = '';
            $data_sub_html = '';
            $link = $external_link;
          } else {
            $formate = 'text';
            $data_poster = '';
            $title = '';
            $txt = $eunice_alt;
            $data_sub_html = '';
          }
        ?>
        <!-- Filter single image item start \-->
          <div class="grid-item grid-img media-box single-item">
            <div class="single-img">
              <img src="<?php echo esc_url($imagess[0]); ?>" alt="<?php echo esc_attr($eunice_alt); ?>">
              <div class="media-box-img-cation">
                <div class="media-light-box" data-format="<?php echo esc_attr($formate); ?>">
                <?php if( !empty( $external_link || $video_url || $image_link )): ?>
                  <a href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr($title); ?>" data-poster="<?php echo esc_attr($data_poster); ?>" data-sub-html="<?php echo esc_attr($data_sub_html); ?>" class="lightbox-btn"
                  <?php if(empty($external_link)) {
                  echo ' data-rel="lightgallery" ';
                  } ?>
                  >
                  </a>
                <?php else: ?>
                  <div class="lightbox-btn">
                    <?php echo esc_attr($txt); ?>
                  </div>
                <?php endif; ?>
                </div>
              </div>
            </div>
          </div><!--/ Filter single image item end-->
        <?php } ?>
        </div>
      </div>

      <!--gallery page  Paginate links start /-->
      <div class="fix paged-links">
        <div class="col-xs-6 prive-and-next-warp">
          <?php echo eunice_gallery_pagination(); ?>
        </div>

        <!-- pagenation link start /-->
        <div class="col-xs-6 pagenat-box">
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
        </div>
      </div>
    </div>
  </article><!--/content end-->
</div>