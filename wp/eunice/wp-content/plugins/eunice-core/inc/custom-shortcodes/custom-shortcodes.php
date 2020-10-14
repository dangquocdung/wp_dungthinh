<?php
/* Gallery Shortcode */
if ( !function_exists('ence_gallery_custom_shortcode_function')) {
  function ence_gallery_custom_shortcode_function( $atts, $content = NULL ) {
    extract(shortcode_atts(array(
      'gallery_type'  => '',
      'gallery_style'  => '',
      'eu_gallery_images'  => '',
      'gallery_filter'  => '',
      'gallery_pagination'  => '',
      'pagination_type'  => '',
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
    // Shortcode Style CSS
    $e_uniqid        = uniqid();
    ob_start();

    if ($gallery_filter == true) { // Gallery Filter ?>
      <div class="filter-list-warp">
        <div id="filters" class="filter-btn-group">
          <ul>
            <li class="button is-checked" data-filter="*"><?php echo esc_html__('All', 'eunice-core'); ?></li>
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
              if ( $count > 0 ) {
                foreach ( $terms as $term ) {
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
      <!-- filter item count start\-->
        <a class="filter-menu-show" href="#">
            <i class="fa fa-filter"></i><?php echo esc_html__('Filter', 'eunice-core'); ?> <span class="spatatror"></span>
            <span class="filter-item-count"></span> / <span class="init-item-count"></span>
        </a><!--/ filter item count end-->
      </div>
    <?php
    }

    // Pagination
    $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
    $args = array(
      'paged' => $paged,
      'post_type' => 'gallery',
      'posts_per_page' => (int)$gallery_limit,
      'gallery_category' => esc_attr($gallery_show_category),
      'orderby' => $gallery_orderby,
      'order' => $gallery_order
    );
    $ence_port = new WP_Query( $args );

    if($gallery_type == 'single-post-gallery' ){ ?>
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
      ?>
     <!-- Filter single image item start \-->
      <div class="grid-item media-box single-item <?php echo $cat_class; ?>">
            <a href="<?php the_permalink(); ?>" class="single-img">
                <?php
                if (has_post_thumbnail()) {
                  the_post_thumbnail('full');
                }else{ ?>
                  <img src="<?php echo EUNICE_PLUGIN_IMGS; ?>/1000x800.jpg" alt="">
               <?php } ?>
                <div class="media-box-img-cation">
                    <div class="like-count-box">
                        <span class="like-icon fa fa-heart-o"></span>
                        <span class="like-count"><?php if(function_exists('zilla_likes')){ echo get_post_meta($post->ID, '_zilla_likes', true); } ?> Likes</span>
                    </div>
                    <div class="media-box-text">
                        <h5><?php the_title(); ?></h5>
                        <h6><?php  $gallery_metaboxes  = get_post_meta( $post->ID, 'gallery_metaboxes', true ); echo $gallery_metaboxes['gallery_subtitle']; ?></h6>
                    </div>
                </div>
            </a>
      </div><!--/ Filter single image item end-->
      <?php endwhile; // end post loop ?>
    </div><!--/ Filter container end-->
      <?php
        if($gallery_pagination == true){
          if( $pagination_type == 'ajax_load' ){
            eunice_gallery_paging_nav_ajax();
          }else{
            eunice_gallery_paging_nav($ence_port->max_num_pages,"",$paged);
          }
        }
    } elseif($gallery_type == 'category-gallery' ){ ?>
        <div  id="filter-content" class="media-grid">
          <?php
          $terms = get_terms( 'gallery_category', array( 'hide_empty' => false ) );
          foreach ($terms as $term) :
            $image_id = get_term_meta ( $term->term_id, 'gallery_category-image-id', true );
            if ($term->parent != 0) : ?>
              <div class="grid-item media-box single-item album-media">
                <a href="<?php echo get_term_link( $term, 'gallery_category' ); ?>" class="single-img">
                  <?php $images = wp_get_attachment_image ( $image_id, array( 259, 185 ), true );
                    if (!$images) {
                      echo '<img src="'.EUNICE_PLUGIN_IMGS.'/cat-image.jpg" alt="'.$term->name.'">';
                    }else{
                      echo $images;
                    } ?>
                  <div class="media-box-img-cation">
                    <div class="album media-box-text">
                        <h5><?php echo $term->name; ?></h5>
                    </div>
                  </div>
                </a>
              </div>
          <?php
            endif;
          endforeach;
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
                } elseif( !empty( $video_url ) ) {
                    $formate = 'video';
                    $data_poster = 'data-poster="'.$imagess[0].'"';
                    $txt = '';
                    $title = '';
                    $link = $video_url;
                    $data_sub_html = 'data-sub-html="'.$eunice_alt.'"';
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
            <?php endforeach; // end foreach ?>
        </div>
      <?php
      } elseif($gallery_style == 'gallery_album' ) { ?>
        <div  id="filter-content" class="media-grid">
          <?php
          $terms = get_terms( 'gallery_category', array( 'hide_empty' => false ) );
          foreach ($gallery_images as $key => $image) :
            $imagess = wp_get_attachment_image_src( $image, 'full' );
            $eunice_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
            $eunice_caption = get_post($image)->post_excerpt;
            $image_link = get_post_meta($image, '_image_media_link', true);
            $video_url = get_post_meta($image, '_video_media_url', true);
            $external_link = get_post_meta($image, '_external_link', true);
            ?>
            <div class="grid-item media-box single-item album-media">
              <a href="<?php echo esc_url( $external_link ); ?>" class="single-img">
                <img src="<?php echo esc_url( $imagess[0] ); ?>" alt="<?php echo esc_attr( $eunice_alt ); ?>">
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
                  <div class="media-light-box" data-format="<?php echo $formate; ?>">
                    <?php if( !empty( $external_link || $video_url || $image_link )): ?>
                    <a href="<?php echo $link; ?>"
                      <?php echo $title.' '.$data_poster.' '.$data_sub_html.' '; if( !empty($external_link) ){ echo 'target="_blank"'; }  ?>
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
      } elseif( $gallery_style == 'eu-gallery-slider' ) { ?>
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
                <img src="<?php echo esc_url( $imagess[0] ); ?>" alt="<?php echo $eunice_al; ?>">
              </div>
            <?php endforeach; ?>
          </div>
          <div class="owl-thumbs" data-slider-id="1">
            <?php
            foreach ($gallery_images as $key => $image) :
              $imagess = wp_get_attachment_image_src( $image, 'full' );
              $eunice_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
              ?>
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
              <p><?php esc_html_e('Sorry, your browser does not support CANVAS'); ?></p>
            </canvas>
              <!--  (kenburns-slide-img-init) This area must be display none-->
            <div class="kenburns-slide-img-init" style="display:none">
            <?php
            foreach ($gallery_images as $key => $image) :
              $imagess = wp_get_attachment_image_src( $image, 'full' );
              $eunice_alt = get_post_meta($image, '_wp_attachment_image_alt', true); ?>
              <!-- kenburns  slider single items start \-->
              <div class="single-kenburns">
                <img src="<?php echo $imagess[0]; ?>" alt="<?php echo $eunice_alt; ?>" />
                <div class="kb_caption"><!-- caption -->
                  <a href="" class="slider-cation"><?php echo $eunice_alt; ?></a>
                 </div>
              </div><!--/ kenburns  slider single items end-->
              <?php endforeach; ?>
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
        if($ribbon_type == 'true'){
            $ribbon_id = 'ribbon_carousel_mousewheel';
        } else {
          $ribbon_id = 'ribbon_carousel';
        } ?>
        <div class="ribbon_carousel_content same-controls">
        <!--ribbon carousel area start/-->
          <div id="<?php echo $ribbon_id; ?>" class="ribbon_carousel">
            <?php
            foreach ($gallery_images as $key => $image) :
              $imagess = wp_get_attachment_image_src( $image, 'full' );
              $eunice_alt = get_post_meta($image, '_wp_attachment_image_alt', true); ?><div class="rib-single-item">
                <img src="<?php echo $imagess[0]; ?>" alt="<?php echo $eunice_alt; ?>">
              </div><?php endforeach; ?>
              </div><!--/ ribbon carousel area end-->
            <div class="ribbon_carousel_length"></div><!-- slider item count-->
        </div>
    <?php }
    } // end of type if

  // Return outbut buffer
    return ob_get_clean();
  }
} // gallery shortcode
add_shortcode( 'eunice_gallery', 'ence_gallery_custom_shortcode_function' );

 /*List*/
function eunice_lists_shortcode_function($atts, $content = true) {
  extract(shortcode_atts(array(
    "container_width" => '',

  ), $atts));
 if( !empty( $container_width ) ){
          $width = 'container-width-'.$container_width;
  } else {
    $width = '';
  }

  $result = '<div class="fix text-center single-page-list-content">';
  $result .= do_shortcode( $content );
  $result .= '</div>';

  return $result;
}
add_shortcode("eunice_lists", "eunice_lists_shortcode_function");

function eunice_list_item_shortcode_function($atts, $content = true) {
  extract(shortcode_atts(array(
    "title" => '',
    "lists" => '',
  ), $atts));

  $result = '<div class="single-page-single-list">
    <h3 class="list-title">'.$title.'</h3><ul>';
    $linebreak = ",";
    $separator = ":";
    $seperated_list = explode($linebreak, $lists);
    foreach ($seperated_list as $item) :
        list($item_text, $item_links) = explode($separator, trim($item));
        if (empty($item_links) || !isset($item_links)) {
           $result .= '<li>' . $item_text . '</li>';
        }else{
          $result .= '<li><a href="http://' . $item_links . '">' . $item_text . '</a></li>';
        }
    endforeach;
  $result .= '</ul> </div>';

  return $result;
}
add_shortcode("eunice_list_item", "eunice_list_item_shortcode_function");

/*Horizontal List*/
function horizontal_list_shortcode($atts, $content = true) {
  extract(shortcode_atts(array(
    "section_title" => '',
    "container_width" => '',
  ), $atts));
      if(!empty($container_width)){
         $width = 'container-width'.$container_width;
      }else{
        $width = '';
      }
  $result = '<div class="about-me-meta-single '.$width.'">
    <span class="title"> '.$section_title.': </span><div class="meta">';
  $result .= substr( trim( do_shortcode($content) ), 0, -1);
  $result .= '</div> </div>';

  return $result;
}
add_shortcode("eunice_horizontal_list", "horizontal_list_shortcode");

/*Single List*/
function single_list_shortcode($atts, $content = true) {
  extract(shortcode_atts(array(
    "title" => '',
    "link" => '',
  ), $atts));

  if(empty($link) || !isset($link)){
      $output = '<span>' . $title . '</span>, ';
  } else {
    $output = '<a href="' . $link . '">' . $title . '</a>, ';
  }

 return $output;
}
add_shortcode('eunice_single_list', 'single_list_shortcode' );

function about_contact_info($atts, $content = true) {
  extract(shortcode_atts(array(
    "email" => '',
    "title" => '',
    "container_width" => '',
  ), $atts));
  ob_start();

  if(!empty($container_width)){
     $width = 'container-width'.$container_width;
  } else {
    $width = '';
  }
?>
  <div class="about-me-contact-info <?php echo $width; ?>">
    <div class="text-left col-xs-6 about-me-contact-mail">
      <?php echo $title; ?> : <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
    </div>
    <div class="text-right col-xs-6 about-me-socail">
      <ul class="list-inline">
        <?php echo do_shortcode($content); ?>
      </ul>
    </div>
  </div>

<?php
 return ob_get_clean();
}
add_shortcode('about_contact', 'about_contact_info' );

/*Social Shortcode*/
function about_social_shortcode($atts, $content = NULL) {
  extract(shortcode_atts(array(
    "link" => '',
    "icon" => '',
  ), $atts));

  $result = '<li><a href="'.$link.'"><i class="'.$icon.'"></i></a></li>';

  return $result;
}
add_shortcode("about_social", "about_social_shortcode");

/*Text block shortcode*/
function text_block_shortcode($atts, $content = NULL) {
  extract(shortcode_atts(array(
    "texts" => '',
    "content_type" => '',
    "custom_css" => '',
    "custom_class" => '',
  ), $atts));

  $result = '<p class="'.$content_type.' '.$custom_class.'" style="'.$custom_css.'">'.$texts.'</p>';

  return $result;
}
add_shortcode("text_block", "text_block_shortcode");

/*Inner Title shortcode*/
function inner_title_shortcode($atts, $content = NULL) {
  extract(shortcode_atts(array(
    "title" => '',
    "custom_css" => '',
    "custom_class" => '',
    "heading_tags" => '',
  ), $atts));

  if ($custom_css) {
    $custom_css = 'style="'.$custom_css.'"';
  } else {
    $custom_css = '';
  }

  $result = '<'.$heading_tags.' class="content-inner-title '.$custom_class.'" '.$custom_css.'>'.$title.'</'.$heading_tags.'>';

  return $result;
}
add_shortcode("inner_title", "inner_title_shortcode");

/*Inner Link*/
function inner_link_shortcode($atts, $content = NULL) {
  extract(shortcode_atts(array(
    "texts" => '',
    "url" => '',
    "target_tab" => '',
    "custom_css" => '',
    "custom_class" => '',
  ), $atts));

  $target_tab = $target_tab ? 'target="_blank"' : '';

  $result = '<a class="content-inner-link '.$custom_class.'" '.$target_tab.' href="'.$url.'" style="'.$custom_css.'">'.$texts.'</a>';

  return $result;
}
add_shortcode("inner_link", "inner_link_shortcode");

/*Inner quote*/
function ence_quote_shortcode($atts, $content = NULL) {
  extract(shortcode_atts(array(
    "texts" => '',
    "cite" => '',
    "url" => '',
    "custom_css" => '',
    "custom_class" => '',
  ), $atts));
  $result = '<p class="text-strong '.$custom_class.'">
      <q style="'.$custom_css.'">'.$texts.'</q>
      &nbsp;&#45;<span class="intro"><a href="'.$url.'">'.$cite.'</a></span>
    </p>';

  return $result;
}
add_shortcode("ence_quote", "ence_quote_shortcode");

/* Image block */
function image_block_shortcode($atts, $content = true) {
  extract(shortcode_atts(array(
    "column" => '',
    "custom_class" => '',
  ), $atts));

  $result = '<div class="content-inner-img '.$column.' '.$custom_class.'">'.do_shortcode( $content ).'</div>';

  return $result;
}
add_shortcode("image_block", "image_block_shortcode");

/*Single Image*/
function single_image_shortcode($atts, $content = true) {
  extract(shortcode_atts(array(
    "image" => '',
    "alt" => '',
  ), $atts));

  $image = wp_get_attachment_image_url( $image, 'full' );
  $result = '
    <figure class="con-inner-img-single">
        <img src="'.$image.'" alt="'.$alt.'">
    </figure>
  ';

  return $result;
}
add_shortcode("single_image", "single_image_shortcode");

/*Space*/
function eunice_spacer_function($atts, $content = true) {
  extract(shortcode_atts(array(
    "height" => '',
  ), $atts));
  $height = str_replace('px', '', $height);
  $result = '<div class="clearfix" style="height: '. $height .'px;"></div>';

  return $result;
}
add_shortcode("eunice_space", "eunice_spacer_function");

/* Address Infos */
function vt_address_infos_function($atts, $content = true) {
  extract(shortcode_atts(array(
    "custom_class" => ''
  ), $atts));

  $result = '<div class="ence-top-info '. $custom_class .'">'. do_shortcode($content) .'</div>';

  return $result;
}
add_shortcode("vt_address_infos", "vt_address_infos_function");

/* Address Info */
function vt_address_info_function($atts, $content = NULL) {
  extract(shortcode_atts(array(
    "address_style" => '',
    "info_icon" => '',
    "info_icon_color" => '',
    "info_main_text" => '',
    "info_main_text_link" => '',
    "info_main_text_color" => '',
    "info_sec_text" => '',
    "info_sec_text_link" => '',
    "info_sec_text_color" => '',
    "target_tab" => ''
  ), $atts));

 // Color
  $info_icon_color = $info_icon_color ? 'color:'. $info_icon_color .';' : '';
  $info_main_text_color = $info_main_text_color ? 'color:'. $info_main_text_color .';' : '';
  $info_sec_text_color = $info_sec_text_color ? 'color:'. $info_sec_text_color .';' : '';

  $address_style = ( $address_style === 'style-two' ) ? 'ence-ai-two' : '';
  $target_tab = ( $target_tab === '1' ) ? 'target="_blank"' : '';
  $info_icon = ( isset( $info_icon ) ) ? '<i class="'. $info_icon .'" style="'. $info_icon_color .'"></i>' : '';

  if (isset( $info_main_text ) && !$info_main_text_link ) {
    $info_main_text = '<span style="'. $info_main_text_color .'">'. $info_main_text .'</span>';
  } elseif (isset( $info_main_text ) && isset( $info_main_text_link )) {
    $info_main_text = '<span><a href="'. $info_main_text_link .'" '. $target_tab .'  style="'. $info_main_text_color .'">'. $info_main_text .'</a></span>';
  } else {
    $info_main_text = '';
  }
  if (isset( $info_sec_text ) && !$info_sec_text_link ) {
    $info_sec_text = '<p style="'. $info_sec_text_color .'">'. $info_sec_text .'</p>';
  } elseif (isset( $info_sec_text ) && isset( $info_sec_text_link )) {
    $info_sec_text = '<a href="'. $info_sec_text_link .'" '. $target_tab .' style="'. $info_sec_text_color .'">'. $info_sec_text .'</a>';
  } else {
    $info_sec_text = '';
  }

  $result = '<div class="ence-address-info '. $address_style .'">'. $info_icon .'<div class="ence-ai-content">'. $info_main_text . $info_sec_text .'</div></div>';

  return $result;
}
add_shortcode("vt_address_info", "vt_address_info_function");

/*Contact*/
if ( !function_exists('eunice_contact_shortcode')) {
  function eunice_contact_shortcode( $atts, $content = true ) {
    extract(shortcode_atts(array(
      'id'  => '',
      'form_title'  => 'Let\'s work together.',
      'description'  => 'Don’t hesitate to chat with us, just drop a line below or contact via email.',
    ), $atts));

    ob_start();
?>
    <div class="container container-width-990  contact-container">
      <div class="entry-content-warp">
      <div class="entry-content-contact">
        <div class="text-center contact-page-heading">
          <h2><?php echo $form_title; ?></h2>
          <p><?php echo $description; ?></p>
        </div>
        <div class="contact-page-info row">
          <div class="text-left col-sm-4 contact-info">
            <?php echo do_shortcode( $content ); ?>
          </div>
            <!--contact form start\-->
          <div class="col-sm-8 contact-form">
            <?php echo do_shortcode( '[contact-form-7 id="'. $id .'"]' ); ?>
          </div><!--/contact form end-->
        </div>
        </div>
      </div>
    </div>
  <?php

   return ob_get_clean();
  }
}
add_shortcode( 'eunice_contact', 'eunice_contact_shortcode' );



/*Contact clone */
if ( !function_exists('contact_adrs_shortcode')) {
  function contact_adrs_shortcode( $atts, $content = true ) {
    extract(shortcode_atts(array(
      'adrs_titl'  => '',
      "adrs_contact"  => '',
    ), $atts));
  ob_start();
?>
  <div class="contact-single-info">
    <address class="contact-address">
      <h4><?php echo $adrs_titl; ?></h4>
      <?php
        $addrs =  str_replace(",", "<br>", $adrs_contact);
        echo $addrs;
      ?>
    </address>
  </div>
<?php
   return ob_get_clean();
  }
}
add_shortcode( 'contact_adrs', 'contact_adrs_shortcode' );

/*Contact Meta shortcode*/
if ( !function_exists('contact_meta_shortcode')) {
  function contact_meta_shortcode( $atts, $content = true ) {
    extract(shortcode_atts(array(
      'adrs_titl'  => '',
      "adrs_contact"  => '',
    ), $atts));
    ob_start(); ?>
    <div class="contact-single-info">
      <address class="contact-address">
        <h4><?php echo $adrs_titl; ?></h4>
        <?php
          $addrs =  str_replace(",", "<br>", $adrs_contact);
          echo $addrs;
        ?>
      </address>
    </div>
  <?php
  return ob_get_clean();
  }
}
add_shortcode( 'contact_meta', 'contact_meta_shortcode' );

if ( !function_exists('contact_meta_social_shortcode')) {
  function contact_meta_social_shortcode( $atts, $content = true ) {
    extract(shortcode_atts(array(
      'adrs_titl'  => '',
      "adrs_contact"  => '',
    ), $atts));
    ob_start();
    ?>
    <div class="contact-single-info">
      <address class="contact-address">
        <h4><?php echo $adrs_titl; ?></h4>
        <?php
          $addrs =  str_replace(",", "<br>", $adrs_contact);
          echo $addrs;
        ?>
      </address>
    </div>
   <?php

   return ob_get_clean();
  }
}
add_shortcode( 'contact_meta_social', 'contact_meta_social_shortcode' );

/*album shortcode*/
if ( !function_exists('eunice_gallery_function')) {
  function eunice_gallery_function( $atts, $content  ) {
    extract(shortcode_atts(array(
      'container_class'  => '',
    ), $atts));
    ob_start(); ?>

    <div  id="filter-content" class="media-grid <?php echo $container_class; ?>">
      <?php echo do_shortcode( $content ); ?>
    </div>

   <?php
   return ob_get_clean();
  }
}
add_shortcode( 'eunice_album_std', 'ence_gallery_function' );

if ( !function_exists('eunice_gallery_album_function')) {
  function eunice_gallery_album_function( $atts, $content) {
    extract(shortcode_atts(array(
      'album_title'  => '',
      'cover_image'  => '',
      'album_click_style'  => '',
      'custom_link'  => '',
      'popup_images'  => '',
      'category_link'  => '',
    ), $atts));

    // Shortcode Style CSS
    $e_uniqid        = uniqid();
    ob_start();

    if ( $album_click_style == 'custom-popups' ) {
      $data_rel = 'data-rel="gallery"';
    } else {
      $data_rel = '';
    }

    $category_link = (int)$category_link;
    if ($album_click_style == 'custom-link') {
      $link = $custom_link;
    } elseif($album_click_style == 'custom-popups') {
      $link = wp_get_attachment_image_url( $cover_image, 'full' );
    } elseif($album_click_style == 'category-link') {
      $link = get_term_link( $category_link, 'gallery_category');
    } else {
      $link = '';
    }
    $popup_images = explode(',', $popup_images);
    ?>
    <div class="grid-item media-box single-item album-media album-custom-shortcode">
      <a href="<?php echo $link; ?>" class="single-img" <?php echo $data_rel; ?> >
          <img src="<?php echo wp_get_attachment_image_url( $cover_image, 'full' ); ?>" alt="<?php echo esc_attr( $album_title ); ?>">
          <div class="media-box-img-cation">
              <div class="album media-box-text">
                  <h5><?php echo $album_title; ?></h5>
              </div>
          </div>
      </a>
        <?php if(!empty($popup_images)):
          foreach ($popup_images as $key => $img) : ?>
            <a href="<?php echo wp_get_attachment_image_url( $img, 'full' ); ?>" data-rel="gallery"></a>
        <?php
          endforeach;
        endif;
          ?>
    </div><!--/ Filter single image item end-->
<?php

    // Return outbut buffer
    return ob_get_clean();
  }
}
add_shortcode( 'eunice_gallery_album', 'eunice_gallery_function' );
