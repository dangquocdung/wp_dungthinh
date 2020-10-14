<?php
/* ==========================================================
  Gallery
=========================================================== */
if ( !function_exists('ence_gallery_function')) {
  function ence_gallery_function( $atts, $content = NULL ) {
    extract(shortcode_atts(array(
      'gallery_type'  => '',
      'gallery_style'  => '',
      'eu_gallery_images'  => '',
      'gallery_filter'  => '',
      'gallery_pagination'  => '',
      'pagination_type'  => '',
      'eu_gallery_column'  => '',
      'gallery_orderby'  => '',
      'gallery_order'  => '',
      'gallery_show_category'  => '',
      'overlay_bg_category_gallery'  => '',
      'title_color_category_gallery'  => '',
      'filter_color'  => '',
      'image_overlay_color'  => '',
      'gallery_title_size'  => '',
      'gallery_title_color'  => '',
      'gallery_limit'  => '',
      'ribbon_type'  => '',
    ), $atts));
    ob_start();

    // Shortcode Style CSS
    $e_uniqid        = uniqid();

    // Gallery Filter
    if ( $gallery_filter == true ) : ?>
      <div class="filter-list-warp">
        <div id="filters" class="filter-btn-group">
          <!-- filter button list start \-->
          <ul>
            <li class="button is-checked all" data-filter="*"><?php echo esc_html__('All', 'eunice-core'); ?></li>
            <?php
            if ($gallery_show_category) {
              $cat_name = explode(',', $gallery_show_category);
              $terms = $cat_name;
              $count = count($terms);
              if ($count > 0) {
                foreach ($terms as $term) {
                  echo '<li class="button" data-filter=".cat-'. preg_replace('/\s+/', "", strtolower($term)) .'">' . str_replace('-', " ", strtolower($term)) . '</li>';
                }
              }
            } else {
              $terms = get_terms('gallery_category',  array( 'parent' => 0 ));
              $count = count($terms);
              $i=0;
              $term_list = '';
              if ($count > 0) {
                foreach ($terms as $term) {
                  $i++;
                  $term_list .= '<li class="button" data-filter=".cat-'. $term->slug .'">' . $term->name . '</li>';
                  if ($count != $i) {
                    $term_list .= '';
                  } else {
                    $term_list .= '';
                  }
                }
                echo $term_list;
              }
            }
            ?>
          </ul><!--/ filter button list end-->
          </div>
          <!-- filter item count-->
          <a class="filter-menu-show">
            <i class="fa fa-filter"></i><?php echo esc_html__('Filter', 'eunice-core'); ?> <span class="spatatror"></span>
            <span class="filter-item-count"></span> / <span class="init-item-count"></span>
          </a>
      </div>

    <?php
    endif; // gallery filter

      // Pagination
    	$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
      $args = array(
        'paged' => $paged,
        'post_type' => 'gallery',
        'posts_per_page' => (int)$gallery_limit,
        'gallery_category' => esc_attr($gallery_show_category),
        'order' => $gallery_order,
        'orderby' => $gallery_orderby,
      );
      $ence_port = new WP_Query( $args );

      if($gallery_type == 'single-post-gallery' ) { ?>
        <!-- filter container start\-->
        <div  id="filter-content" class="media-grid">
          <?php
          while( $ence_port->have_posts() ) : $ence_port->the_post();
            // Category
            global $post;
            $terms = wp_get_post_terms($post->ID,'gallery_category');
            foreach ($terms as $term) {
              $cat_class = 'cat-' . $term->slug;
            }
            $count = count($terms);
            $i=0;
            $cat_class = '';
            if ($count > 0) {
              foreach ($terms as $term) {
                $i++;
                $cat_class .= 'cat-'. $term->slug .' ';
                if ($count != $i) {
                  $cat_class .= '';
                } else {
                  $cat_class .= '';
                }
              }
            }
            // gallery column
            if( $eu_gallery_column == 'three-columns' ) {
              $col_class = ' three-columns';
            } elseif( $eu_gallery_column == 'five-columns' ) {
              $col_class = ' five-columns';
            } else {
              $col_class = '';
            } ?>
            <!-- Filter single image item start \-->
            <div class="grid-item media-box single-item <?php echo $cat_class.$col_class; ?>">
              <span class="single-img">
                <?php
                if(has_post_thumbnail()) {
                  the_post_thumbnail('full');
                } else {
                   echo '<img src="'.EUNICE_PLUGIN_IMGS.'/1000x800.jpg" alt="'.esc_attr( get_the_title() ).'">';
                }
                ?>
                <div class="media-box-img-cation">
                  <div class="like-count-box">
                  <?php 
                  if( function_exists('zilla_likes') ) {
                    $likes = esc_attr(get_post_meta($post->ID, '_zilla_likes', true));
                    $likes = (int) $likes;
                    zilla_likes();
                    if ($likes > 1) {
                      echo ' <span class="like-count">'. esc_html__('Likes', 'eunice') .'</span>';
                    }else{
                      echo ' <span class="like-count">'. esc_html__('Like', 'eunice') .'</span>';
                    }
                  } ?>
                  </div>
                  <div class="media-box-text">
                    <a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
                    <h6><?php  $gallery_metaboxes  = get_post_meta( $post->ID, 'gallery_metaboxes', true ); echo $gallery_metaboxes['gallery_subtitle']; ?></h6>
                  </div>
                </div>
              </span>
            </div><!--/ Filter single image item end-->
          <?php
          endwhile; // end post loop
          wp_reset_postdata(); ?>
        </div><!--/ Filter container end-->
        <?php
        if($gallery_pagination == 'true') :
          if( $pagination_type == 'ajax_load' ) :
            if( $gallery_limit < $ence_port->found_posts) :
              $loadmoretxt  = cs_get_option('loadmoretxt');
              $loadmoremessage  = cs_get_option('loadmore_message');
              $loadmoretxt = $loadmoretxt ? $loadmoretxt : esc_html__( 'Load More ', 'eunice-core' );
              $loadmoremessage = $loadmoremessage ? $loadmoremessage : esc_html__( 'There is no more gallery items', 'eunice-core' ); ?>
              <div class="load_more_gallery_messages"></div>
              <a class="load_more_btn gallery-load-more-posts" data-posts="<?php echo (int) $ence_port->found_posts; ?>"  data-class="<?php echo $col_class; ?>" data-message="<?php echo $loadmoremessage; ?>" data-page="1" data-url="<?php  echo admin_url( 'admin-ajax.php' ); ?>" data-orderby="<?php echo $gallery_orderby; ?>" data-order="<?php echo $gallery_order; ?>" data-totalPge="<?php echo $ence_port->max_num_pages; ?>" data-perpage="<?php echo $gallery_limit; ?>">
                <img class="loader_gif" src="<?php echo get_template_directory_uri(); ?>/assets/images/preloader.gif" alt="<?php echo esc_html__( 'Load More Icon', 'eunice-core' ); ?>">
                <span class="icon_pagination"><i class="fa fa-refresh"></i></span>
                <span class="txt"><?php echo $loadmoretxt; ?></span>
              </a>
              <?php
             endif;
          else :
            eunice_gallery_paging_nav($ence_port->max_num_pages,"",$paged);
          endif;
        endif;
       } elseif($gallery_type == 'category-gallery' ) { ?>
          <div  id="filter-content" class="media-grid">
            <?php
            $terms = get_terms( 'gallery_category', array( 'hide_empty' => false ) );
            foreach ($terms as $term) :
              $image_id = get_term_meta ( $term->term_id, 'gallery_category-image-id', true );
              if ($term->parent != 0) :  ?>
                <div class="grid-item media-box single-item album-media">
                  <a href="<?php echo get_term_link( $term, 'gallery_category' ); ?>" class="single-img">
                    <?php echo wp_get_attachment_image ( $image_id, array( 259, 185 ), true ); ?>
                    <div class="media-box-img-cation">
                      <div class="album media-box-text">
                        <h5><?php echo $term->name; ?></h5>
                      </div>
                    </div>
                  </a>
                </div>
              <?php
              endif;
            endforeach; // end terms foreach
            ?>
        </div>
      <?php
      } elseif( $gallery_type == 'single-gallery' ) {
        $gallery_images = explode(',', $eu_gallery_images); // call images
          if( $gallery_style == 'eu-gallery-grid' ){ ?>
            <div  id="grid-warp" class="fit-grid">
              <?php
              foreach ($gallery_images as $key => $image) :
                $imagess = wp_get_attachment_image_src( $image, 'full' );
                $eunice_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
                $image_link = get_post_meta($image, '_image_media_link', true);
                $video_url = get_post_meta($image, '_video_media_url', true);
                $external_link = get_post_meta($image, '_external_link', true);
                if ( !empty( $image_link ) ) {
                  $formate = 'image';
                  $title = 'title="'.$eunice_alt.'"';
                  $data_poster = '';
                  $txt = '';
                  $data_sub_html = '';
                  $link = $image_link;
                }elseif( !empty( $video_url ) ){
                  $formate = 'video';
                  $data_poster = 'data-poster="'.$imagess[0].'"';
                  $txt = '';
                  $title = '';
                  $link = $video_url;
                  $data_sub_html = 'data-sub-html="'.$eunice_alt.'"';
                }elseif( !empty( $external_link ) ){
                  $formate = 'link';
                  $data_poster = '';
                  $txt = '';
                  $title = '';
                  $data_sub_html = '';
                  $link = $external_link;
                }else{
                  $formate = 'text';
                  $data_poster = '';
                  $title = '';
                  $txt = $eunice_alt;
                  $data_sub_html = '';
                } ?>
                <!-- Filter single image item start \-->
                <div class="grid-item grid-img  media-box single-item">
                  <div class="single-img">
                    <img src="<?php echo $imagess[0]; ?>" alt="<?php echo $eunice_alt; ?>">
                      <div class="media-box-img-cation">
                        <div class="media-light-box" data-format="<?php echo $formate; ?>">
                          <?php if( !empty( $external_link || $video_url || $image_link )): ?>
                          <a href="<?php echo $link; ?>"
                              <?php echo $title.' '.$data_poster.' '.$data_sub_html.' '; if( !empty($external_link) ){ echo 'target="_blank"'; }  ?>
                              class="lightbox-btn"
                              <?php if (empty($external_link)) {
                              	echo ' data-rel="lightgallery" ';
                              } ?>
                              >
                          </a>
                          <?php else: ?>
                          <div class="lightbox-btn">
                              <?php echo $txt; ?>
                          </div>
                          <?php endif; ?>
                        </div>
                      </div>
                  </div>
                </div><!--/ Filter single image item end-->
              <?php endforeach; ?>
            </div>
          <?php
          } elseif($gallery_style == 'gallery_album' ){ ?>
          <div  id="filter-content" class="media-grid">
            <?php
            $terms = get_terms( 'gallery_category', array( 'hide_empty' => false ) );
            foreach ($gallery_images as $key => $image) :
              $imagess = wp_get_attachment_image_src( $image, 'full' );
              $eunice_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
              $eunice_caption = get_post($image)->post_excerpt;;
              $image_link = get_post_meta($image, '_image_media_link', true);
              $video_url = get_post_meta($image, '_video_media_url', true);
              $external_link = get_post_meta($image, '_external_link', true); ?>
              <div class="grid-item media-box single-item album-media">
                <a href="<?php echo esc_url( $external_link ); ?>" class="single-img">
                  <img src="<?php echo esc_url( $imagess[0] ); ?>" alt="">
                  <div class="media-box-img-cation">
                    <div class="album media-box-text">
                      <h5><?php echo $eunice_caption; ?></h5>
                    </div>
                  </div>
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        <?php
        } elseif( $gallery_style == 'eu-gallery-masonry' ){ ?>
          <div  id="grid-warp" class="masonary-grid">
          <?php
          foreach ($gallery_images as $key => $image) :
            $imagess = wp_get_attachment_image_src( $image, 'full' );
            $eunice_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
            $image_link = get_post_meta($image, '_image_media_link', true);
            $video_url = get_post_meta($image, '_video_media_url', true);
            $external_link = get_post_meta($image, '_external_link', true);
            if ( !empty( $image_link ) ) {
              $formate = 'image';
              $title = 'title="'.$eunice_alt.'"';
              $data_poster = '';
              $txt = '';
              $data_sub_html = '';
              $link = $image_link;
            }elseif( !empty( $video_url ) ){
              $formate = 'video';
              $data_poster = 'data-poster="'.$imagess[0].'"';
              $txt = '';
              $title = '';
              $link = $video_url;
              $data_sub_html = 'data-sub-html="'.$eunice_alt.'"';
            }elseif( !empty( $external_link ) ){
              $formate = 'link';
              $data_poster = '';
              $txt = '';
              $title = '';
              $data_sub_html = '';
              $link = $external_link;
            }else{
              $formate = 'text';
              $data_poster = '';
              $title = '';
              $txt = $eunice_alt;
              $data_sub_html = '';
            } ?>
            <!-- Filter single image item start \-->
            <div class="grid-item grid-img  media-box single-item">
              <div class="single-img">
                <img src="<?php echo esc_url( $imagess[0] ); ?>" alt="<?php echo esc_attr( $eunice_alt ); ?>">
                <div class="media-box-img-cation">
                  <div class="media-light-box" data-format="<?php echo esc_attr( $formate ); ?>">
                    <?php if( !empty( $external_link || $video_url || $image_link )): ?>
                    <a href="<?php echo esc_url( $link ); ?>"
                      <?php echo $title .' '. $data_poster .' '. $data_sub_html .' '; if( !empty($external_link) ){ echo 'target="_blank"'; }  ?>
                      class="lightbox-btn"
                       <?php if (empty($external_link)) {
                        echo ' data-rel="lightgallery" ';
                         } ?> >
                    </a>
                    <?php else: ?>
                    <div class="lightbox-btn">
                      <?php echo $txt; ?>
                    </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div><!--/ Filter single image item end-->
          <?php endforeach; ?>
          </div>
        <?php
        } elseif( $gallery_style == 'eu-gallery-slider' ){ ?>
          <!-- = Fullwidth  slider start = \-->
          <div id="fullwidth_slider_warp" class="full-screen same-controls">
            <div class="gallery-open"></div>
            <div id="gallery-slider" class="owl-carousel" data-slider-id="1">
              <?php
              foreach ($gallery_images as $key => $image) :
                $imagess = wp_get_attachment_image_src( $image, 'full' );
                $eunice_alt = get_post_meta($image, '_wp_attachment_image_alt', true); ?>
                <div class="slide-item">
                  <span class="slider-cation"><?php echo $eunice_alt; ?></span>
                  <img src="<?php echo esc_url( $imagess[0] ); ?>" alt="<?php echo esc_attr( $eunice_al ); ?>">
                </div>
              <?php endforeach; ?>
            </div>
            <div class="owl-thumbs" data-slider-id="1">
              <?php
              foreach ($gallery_images as $key => $image) :
                $imagess = wp_get_attachment_image_src( $image, 'full' );
                $eunice_alt = get_post_meta($image, '_wp_attachment_image_alt', true); ?>
                <div class="owl-thumb-item">
                  <img src="<?php echo esc_url( $imagess[0] ); ?>" alt="<?php echo esc_attr( $eunice_alt ); ?>">
                </div>
                <?php endforeach; ?>
            </div>
            <div class="gallary-slider-length"></div><!-- slider item count-->
            <div style="clear:both;"></div>
          </div><!--/ Fullwidth  slider end -->
        <?php
        } elseif( $gallery_style == 'eu-gallery-kenburns' ) { ?>
        <div class="kenburns-page-warp same-controls">
          <!-- kenburns effect fullwidth slider start \-->
          <canvas id="kb-canvas-slide">
            <p><?php echo esc_html__( 'Sorry, your browser does not support CANVAS', 'eunice-core' ); ?></p>
          </canvas>
          <!--  (kenburns-slide-img-init) This area must be display none-->
          <div class="kenburns-slide-img-init" style="display:none">
            <?php
            foreach ($gallery_images as $key => $image) {
              $imagess = wp_get_attachment_image_src( $image, 'full' );
              $eunice_alt = get_post_meta($image, '_wp_attachment_image_alt', true); ?>
            <!-- kenburns  slider single items start \-->
            <div class="single-kenburns">
              <img src="<?php echo esc_url( $imagess[0] ); ?>" alt="<?php echo esc_attr( $eunice_alt ); ?>" />
              <div class="kb_caption"><!-- caption -->
                <a href="" class="slider-cation"><?php echo esc_attr( $eunice_alt ); ?></a>
               </div>
            </div><!--/ kenburns  slider single items end-->
            <?php } ?>
          </div>
          <div class="sliders-caption"></div>
          <div class="kenburns-navigation">
            <a href="#" class="kenburns-prev-slide"><i class="fa fa-angle-left"></i></a>
            <a href="#" class="kenburns-next-slide"><i class="fa fa-angle-right"></i></a>
          </div>
          <div class="kenburns-slider-length gallary-slider-length">
            <span class="kenburns-count-index">0</span>/
            <span class="kenburns-all-count"></span>
          </div><!-- slider item count-->
          <div style="clear:both;"></div>
        </div><!-- kenburns effect fullwidth slider end \-->
        <?php
        } elseif( $gallery_style == 'eu-gallery-ribbon' ) {
          if($ribbon_type == 'true') {
              $ribbon_id = 'ribbon_carousel_mousewheel';
          } else {
            $ribbon_id = 'ribbon_carousel';
          } ?>
          <div class="ribbon_carousel_content same-controls">
          <!--ribbon carousel area start/-->
            <div id="<?php echo esc_attr( $ribbon_id ); ?>" class="ribbon_carousel">
              <?php
              foreach ($gallery_images as $key => $image) :
                $imagess = wp_get_attachment_image_src( $image, 'full' );
                $eunice_alt = get_post_meta($image, '_wp_attachment_image_alt', true); ?><div class="rib-single-item"><img src="<?php echo esc_url( $imagess[0] ); ?>" alt="<?php echo esc_attr( $eunice_alt ); ?>"></div><?php endforeach; ?>
              </div><!--/ ribbon carousel area end-->
              <div class="ribbon_carousel_length"></div><!-- slider item count-->
          </div>
        <?php
        }
      } // end of type if

    // Return outbut buffer
    return ob_get_clean();
  }
}
add_shortcode( 'ence_gallery', 'ence_gallery_function' );
