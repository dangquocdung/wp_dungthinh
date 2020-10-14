<?php
/*
 * All Front-End Helper Functions
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

/* Exclude category from blog */
if( ! function_exists( 'eunice_vt_excludeCat' ) ) {
  function eunice_vt_excludeCat($query) {
  	if ( $query->is_home ) {
  		$exclude_cat_ids = cs_get_option('theme_exclude_categories');
  		if($exclude_cat_ids) {
  			foreach( $exclude_cat_ids as $exclude_cat_id ) {
  				$exclude_from_blog[] = '-'. $exclude_cat_id;
  			}
  			$query->set('cat', implode(',', $exclude_from_blog));
  		}
  	}
  	return $query;
  }
  add_filter('pre_get_posts', 'eunice_vt_excludeCat');
}

/* Excerpt Length */
class EuniceExcerpt {

  // Default length (by WordPress)
  public static $length = 55;

  // Output: eunice_excerpt('short');
  public static $types = array(
    'short' => 25,
    'regular' => 55,
    'long' => 100
  );

  /**
   * Sets the length for the excerpt,
   * then it adds the WP filter
   * And automatically calls the_excerpt();
   *
   * @param string $new_length
   * @return void
   * @author Baylor Rae'
   */
  public static function length($new_length = 55) {
    EuniceExcerpt::$length = $new_length;
    add_filter('excerpt_length', 'EuniceExcerpt::new_length');
    EuniceExcerpt::output();
  }

  // Tells WP the new length
  public static function new_length() {
    if( isset(EuniceExcerpt::$types[EuniceExcerpt::$length]) )
      return EuniceExcerpt::$types[EuniceExcerpt::$length];
    else
      return EuniceExcerpt::$length;
  }

  // Echoes out the excerpt
  public static function output() {
    the_excerpt();
  }

}

// Custom Excerpt Length
if( ! function_exists( 'eunice_excerpt' ) ) {
  function eunice_excerpt($length = 55) {
    EuniceExcerpt::length($length);
  }
}

if ( ! function_exists( 'eunice_new_excerpt_more' ) ) {
  function eunice_new_excerpt_more( $more ) {
    return '[...]';
  }
  add_filter('excerpt_more', 'eunice_new_excerpt_more');
}

/* Tag Cloud Widget - Remove Inline Font Size */
if( ! function_exists( 'eunice_vt_tag_cloud' ) ) {
  function eunice_vt_tag_cloud($tag_string){
    return preg_replace("/style='font-size:.+pt;'/", '', $tag_string);
  }
  add_filter('wp_generate_tag_cloud', 'eunice_vt_tag_cloud', 10, 3);
}

/* Password Form */

function eunice_password_form() {
  global $post;

  $passs = '<div class="photo-proofing-warp">
        <div class="text-center password-protect-content">
            <div class="lock-icon"></div>
            <h2 class="text-uppercase">'.esc_html__( 'Password Protected Area', 'eunice' ).'</h2>
            <h4>'.esc_html__( 'Please enter your password here', 'eunice' ).':</h4>
            <div class="password-protect-form">';
  $passs .= '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post"><input name="post_password" type="password" placeholder="'. esc_html__('Password', 'eunice') .'" /><button type="submit" name="'. esc_html__('Submit', 'eunice') .'" /></button> </form>';
  $passs .= '</div> </div> </div>';
  return $passs;
}
add_filter( 'the_password_form', 'eunice_password_form' );

/* Maintenance Mode */
if( ! function_exists( 'eunice_vt_maintenance_mode' ) ) {
  function eunice_vt_maintenance_mode(){
    $maintenance_mode_page = cs_get_option( 'maintenance_mode_page' );
    $enable_maintenance_mode = cs_get_option( 'enable_maintenance_mode' );
    if ( isset($enable_maintenance_mode) && ! empty( $maintenance_mode_page ) && ! is_user_logged_in() ) {
      get_template_part('layouts/post/content', 'maintenance');
      exit;
    }
  }
  add_action( 'wp', 'eunice_vt_maintenance_mode', 1 );
}

/* Widget Layouts */
if ( ! function_exists( 'eunice_vt_footer_widgets' ) ) {
  function eunice_vt_footer_widgets() {

    $output = '';
    $footer_widget_layout = cs_get_option('footer_widget_layout');

    if( $footer_widget_layout ) {

      switch ( $footer_widget_layout ) {
        case 1: $widget = array('piece' => 1, 'class' => 'col-md-12'); break;
        case 2: $widget = array('piece' => 2, 'class' => 'col-md-6'); break;
        case 3: $widget = array('piece' => 3, 'class' => 'col-md-4'); break;
        case 4: $widget = array('piece' => 4, 'class' => 'col-md-3 col-sm-6'); break;
        case 5: $widget = array('piece' => 3, 'class' => 'col-md-3', 'layout' => 'col-md-6', 'queue' => 1); break;
        case 6: $widget = array('piece' => 3, 'class' => 'col-md-3', 'layout' => 'col-md-6', 'queue' => 2); break;
        case 7: $widget = array('piece' => 3, 'class' => 'col-md-3', 'layout' => 'col-md-6', 'queue' => 3); break;
        case 8: $widget = array('piece' => 4, 'class' => 'col-md-2', 'layout' => 'col-md-6', 'queue' => 1); break;
        case 9: $widget = array('piece' => 4, 'class' => 'col-md-2', 'layout' => 'col-md-6', 'queue' => 4); break;
        default : $widget = array('piece' => 4, 'class' => 'col-md-3'); break;
      }

      for( $i = 1; $i < $widget["piece"]+1; $i++ ) {

        $widget_class = ( isset( $widget["queue"] ) && $widget["queue"] == $i ) ? $widget["layout"] : $widget["class"];

        $output .= '<div class="'. $widget_class .'">';
        ob_start();
        if (is_active_sidebar('footer-'. $i)) {
          dynamic_sidebar( 'footer-'. $i );
        }
        $output .= ob_get_clean();
        $output .= '</div>';

      }
    }

    return $output;

  }
}

if( ! function_exists( 'eunice_vt_top_bar' ) ) {
  function eunice_vt_top_bar() {

    $out     = '';

    if ( ( cs_get_option( 'top_left' ) || cs_get_option( 'top_right' ) ) ) {
      $out .= '<div class="ence-topbar"><div class="container"><div class="row">';
      $out .= eunice_vt_top_bar_modules( 'left' );
      $out .= eunice_vt_top_bar_modules( 'right' );
      $out .= '</div></div></div>';
    }

    return $out;
  }
}

/* WP Link Pages */
if ( ! function_exists( 'eunice_wp_link_pages' ) ) {
  function eunice_wp_link_pages() {
    $defaults = array(
      'before'           => '<div class="wp-link-pages">' . esc_html__( 'Pages:', 'eunice' ),
      'after'            => '</div>',
      'link_before'      => '<span>',
      'link_after'       => '</span>',
      'next_or_number'   => 'number',
      'separator'        => '',
      'pagelink'         => '%',
      'echo'             => 1
    );
    wp_link_pages( $defaults );
  }
}

/* Metas */
if ( ! function_exists( 'eunice_post_metas' ) ) {
  function eunice_post_metas() {
  $metas_hide = (array) cs_get_option( 'theme_metas_hide' );
  ?>

  <div class="<?php if( is_single() ){ echo 'post-info-meta'; } else { echo 'post-meta'; } ?>">
    <p>
    <?php if ( !in_array( 'date', $metas_hide ) ) { // Date Hide ?>
      <span class="post-date"><?php echo get_the_date('d F, Y'); ?></span>
    <?php } // Date Hides

    if ( !in_array( 'category', $metas_hide ) ) { // Category Hide
      if ( get_post_type() === 'post') {
        if( is_single() ){
            $category_list = get_the_category_list( ', ' );
          } else {
            $category_list = get_the_category_list( ', ' );
          }
        if ( $category_list ) {
          echo '<span class="post-category">&#45; '. $category_list .'</span>';
        }
      }
    } // Category Hides
    if( is_single() ){
      echo ' <span class="post-author">&#45;&nbsp;By&nbsp;<a href="'. esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ))).'">'. get_the_author().' </a> </span>';
    }
    ?>

    </p>
  </div>
  <?php
  }
}

/* Share Options */
if ( ! function_exists( 'eunice_wp_share_option' ) ) {
  function eunice_wp_share_option() {

    global $post;
    $page_url = get_permalink($post->ID );
    $media_url =  get_the_post_thumbnail_url();
    $title = $post->post_title;
    $content = $post->post_excerpt;
    $share_text = cs_get_option('share_text');
    $share_text = $share_text ? $share_text : esc_html__( 'Share ', 'eunice' );
    $share_on_text = cs_get_option('share_on_text');
    $share_on_text = $share_on_text ? $share_on_text : esc_html__( 'Share On', 'eunice' );
    $see_more_txt = cs_get_option('see_more_txt');
    $see_more_txt = $see_more_txt ? $see_more_txt : esc_html__( 'See More', 'eunice' );
    $hide_more_txt = cs_get_option('hide_more_txt');
    $hide_more_txt = $hide_more_txt ? $hide_more_txt : esc_html__( 'Hide', 'eunice' );
    ?>
    <span class="text-uppercase share-text"><?php echo esc_attr($share_text); ?>:</span>
    <ul class="list-inline">
      <li>
        <a href="//twitter.com/home?status=<?php print(urlencode($title)); ?>+<?php print(urlencode($page_url)); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Twitter', 'eunice'); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
      </li>
      <li>
        <a href="//www.facebook.com/sharer/sharer.php?u=<?php print(urlencode($page_url)); ?>&amp;t=<?php print(urlencode($title)); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Facebook', 'eunice'); ?>" target="_blank"><i class="fa fa-facebook-square"></i></a>
      </li>
      <li>
        <a href="http://pinterest.com/pin/create/button/?url=<?php print(urlencode($page_url)); ?>&amp;media=<?php print(urlencode($media_url)); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Pinterest', 'eunice'); ?>" target="_blank"><i class="fa fa-pinterest-p"></i></a>
      </li>
      <li>
        <a href="//plus.google.com/share?url=<?php print(urlencode($page_url)); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Google+', 'eunice'); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
      </li>
      <li class="hidden-icons">
        <a href="mailto:?subject=<?php print(urlencode($title)); ?>&amp;body=<?php print(urlencode($page_url)); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Email', 'eunice'); ?>" target="_blank"><i class="fa fa-envelope-o"></i></a>
      </li>
      <li class="hidden-icons">
        <a href="//www.linkedin.com/shareArticle?mini=true&amp;url=<?php print(urlencode($page_url)); ?>&amp;title=<?php print(urlencode($title)); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Linkedin', 'eunice'); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
      </li>
      <li class="share-plus">
        <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr($see_more_txt); ?>"><i class="fa fa-plus-square"></i></a>
      </li>
      <li class="share-minus hidden">
        <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr($hide_more_txt); ?>"><i class="fa fa-minus-square"></i></a>
      </li>
    </ul>
<?php
  }
}

/* Author Info */
if ( ! function_exists( 'eunice_author_info' ) ) {
  function eunice_author_info() {
    if (get_the_author_meta( 'url' )) {
      $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
      $website_url = get_the_author_meta( 'url' );
      $target = 'target="_blank"';
    } else {
      $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
      $website_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
      $target = '';
    }
    // variables
    $author_text = cs_get_option('author_text');
    $author_text = $author_text ? $author_text : esc_html__( 'Author', 'eunice' );
    $author_content = get_the_author_meta( 'description' );
    $facebook = get_the_author_meta( 'facebook' );
    $twitter = get_the_author_meta( 'twitter' );
    $google_plus = get_the_author_meta( 'google_plus' );
    $linkedin = get_the_author_meta( 'linkedin' );
    $instagram = get_the_author_meta( 'instagram' );
    $pinterest = get_the_author_meta( 'pinterest' );
if ($author_content) {
?>
    <!--author bio start\-->
  <div class="fix single-post-author-bio">
    <div class="single-post-author-bio-avatar">
      <?php echo get_avatar( get_the_author_meta( 'ID' ), 110 ); ?>
    </div>
    <div class="single-post-author-bio-desc">
    <h4><a href="<?php echo esc_url($author_url); ?>" class="author-name"><?php echo esc_attr(get_the_author_meta('first_name')) .' '. esc_attr(get_the_author_meta('last_name')); ?> <span>&#45; <?php esc_html_e( 'Author', 'eunice' ); ?></span></a></h4>
      <p><?php echo esc_attr(get_the_author_meta( 'description' )); ?></p>
      <ul class="list-inline s-post-author-bio-social">
        <?php if($facebook){ ?><li><a href="<?php echo esc_url($facebook) ?>"><i class="fa fa-facebook"></i></a></li>
        <?php } if($twitter) { ?><li><a href="<?php echo esc_url($twitter) ?>"><i class="fa fa-twitter"></i></a></li>
        <?php } if($google_plus) { ?><li><a href="<?php echo esc_url($google_plus) ?>"><i class="fa fa-google-plus"></i></a></li>
        <?php } if($linkedin) { ?><li><a href="<?php echo esc_url($linkedin) ?>"><i class="fa fa-linkedin"></i></a></li>
        <?php } if($instagram) { ?><li><a href="<?php echo esc_url($instagram) ?>"><i class="fa fa-instagram"></i></a></li>
        <?php } if($pinterest) { ?><li><a href="<?php echo esc_url($pinterest) ?>"><i class="fa fa-pinterest-p"></i></a></li>
        <?php } ?>
      </ul>

    </div>
  </div> <!--/end-->
<?php
} // if $author_content
  }
}

/* ==============================================
   Custom Comment Area Modification
=============================================== */
if ( ! function_exists( 'eunice_comment_modification' ) ) {
  function eunice_comment_modification($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    if ( 'div' == $args['style'] ) {
      $tag = 'div';
      $add_below = 'comment';
    } else {
      $tag = 'li';
      $add_below = 'div-comment';
    }
    $comment_class = empty( $args['has_children'] ) ? '' : 'parent';
  ?>

  <<?php echo esc_attr($tag); ?> <?php comment_class('item ' . $comment_class .' ' ); ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>

   <div id="div-comment-<?php comment_ID() ?>">

    <?php endif; ?>
    <div class="comment-theme">
        <div class="comment-image">
          <?php if ( $args['avatar_size'] != 0 ) {
            echo get_avatar( $comment, 80 );
          } ?>
        </div>
    </div>
    <div class="comment-main-area">
      <div class="comment-wrapper">
      <div class="pxls-comments-meta">
        <h4><?php printf( '%s', get_comment_author() ); ?></h4>
         <span class="says"><?php esc_html_e('Says', 'eunice'); ?></span>
        <span class="comments-date">
          <?php echo get_comment_date('d M Y'); echo ' - '; ?> <?php echo get_comment_time(); ?>
        </span>
        </div>
        <div class="comment-content">
          <?php comment_text(); ?>
        </div>
        <div class="comments-reply">
        <?php
          comment_reply_link( array_merge( $args, array(
          'reply_text' => '<span class="comment-reply-link">'. esc_html__('Reply','eunice') .'</span>',
          'before' => '',
          'class'  => '',
          'depth' => $depth,
          'max_depth' => $args['max_depth']
          ) ) );
        ?>
        </div>
        <?php if ( $comment->comment_approved == '0' ) : ?>
        <em class="comment-awaiting-moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'eunice' ); ?></em>
        <?php endif; ?>
      </div>

    </div>
  <?php if ( 'div' != $args['style'] ) : ?>
  </div>
  <?php endif;
  }
}

/* Title Area */
if ( ! function_exists( 'eunice_title_area' ) ) {
  function eunice_title_area() {

    global $post, $wp_query;

    // Get post meta in all type of WP pages
    $eunice_id    = ( isset( $post ) ) ? $post->ID : 0;
    $eunice_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $eunice_id;
    $eunice_id    = ( eunice_is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $eunice_id;
    $eunice_meta  = get_post_meta( $eunice_id, 'page_type_metabox', true );
    if ($eunice_meta && (!is_archive() || eunice_is_woocommerce_shop())) {
      $custom_title = $eunice_meta['page_custom_title'];
      if ($custom_title) {
        $custom_title = $custom_title;
      } elseif(post_type_archive_title()) {
        post_type_archive_title();
      } else {
        $custom_title = '';
      }
    } else { $custom_title = ''; }

    /**
     * For strings with necessary HTML, use the following:
     * Note that I'm only including the actual allowed HTML for this specific string.
     * More info: https://codex.wordpress.org/Function_Reference/wp_kses
     */
    $allowed_html_array = array(
        'a' => array(
          'href' => array(),
        ),
        'span' => array(
          'class' => array(),
        )
    );

    if ( is_home() ) {
      bloginfo('');
    } elseif ( is_search() ) {
      printf( esc_html__( 'Search Results for %s', 'eunice' ), '<span>' . get_search_query() . '</span>' );
    } elseif ( is_category() || is_tax() ){
      single_cat_title();
    } elseif ( is_tag() ){
      single_tag_title(esc_html__('Posts Tagged: ', 'eunice'));
    } elseif ( is_archive() ){
      if ( is_day() ) {
        printf( wp_kses( esc_html__( 'Archive for %s', 'eunice' ), $allowed_html_array ), get_the_date());
      } elseif ( is_month() ) {
        printf( wp_kses( esc_html__( 'Archive for %s', 'eunice' ), $allowed_html_array ), get_the_date( 'F, Y' ));
      } elseif ( is_year() ) {
        printf( wp_kses( esc_html__( 'Archive for %s', 'eunice' ), $allowed_html_array ), get_the_date( 'Y' ));
      } elseif ( is_author() ) {
        printf( wp_kses( esc_html__( 'Posts by: %s', 'eunice' ), $allowed_html_array ), get_the_author_meta( 'display_name', $wp_query->post->post_author ));
      } elseif( eunice_is_woocommerce_shop() ) {
        echo esc_attr($custom_title);
      } elseif ( is_post_type_archive() ) {
        post_type_archive_title();
      } else {
        esc_html_e( 'Archives', 'eunice' );
      }
    } elseif( is_404() ) {
      esc_html_e('404 Error', 'eunice');
    } elseif( $custom_title ) {
      echo esc_attr($custom_title);
    } else {
      the_title();
    }

  }
}

/**
 * PAGINATION FUNCTIONS
 */
if ( ! function_exists( 'eunice_load_more_ajax' ) ) {
  function eunice_load_more_ajax() {
      $paged 		= $_POST["page"]+1;
      $category   = $_POST["category"];
      $search_term 	= $_POST["search_term"];
      $author 	= $_POST["author"];
      $tag 		= $_POST["tag"];
      $query = new WP_Query(
        array(
          'tag' => $tag,
          'category_name' => $category,
          's' => $search_term,
          'author_name' => $author,
          'post_type' => 'post',
          'paged'     => $paged,
          'post_status' => 'publish',
        ));
        if ( $query->have_posts() ) :
          while ( $query->have_posts() ) : $query->the_post();
            get_template_part( 'layouts/post/content' );
          endwhile;
        endif;
        wp_reset_postdata();
      die();
    }
  add_action( 'wp_ajax_eunice_load_more_ajax', 'eunice_load_more_ajax' );
  add_action( 'wp_ajax_nopriv_eunice_load_more_ajax', 'eunice_load_more_ajax' );
}

/*PAGING NAV*/
if ( ! function_exists( 'eunice_paging_nav' ) ) {
  function eunice_paging_nav() {
    global $wp_query;
    $big = 999999999;
    if(is_archive()){
      if (is_category()) {
          $category =  single_cat_title( '', false );
        } else {
          $category = '';
        }
        if (is_author()) {
          $author = get_the_author_meta( 'display_name', $wp_query->post->post_author );
        } else {
          $author = '';
        }
        if (is_tag()) {
          $tags = single_tag_title('', false);
        } else {
          $tags = '';
        }
        if (is_year()) {
          $year = get_the_date('Y');
        } else {
          if (is_month()) {
            $month = get_the_date('m');
            $year = get_the_date('Y');
          } else {
            if (is_day()) {
              $day = get_the_date('d');
              $month = get_the_date('m');
              $year = get_the_date('Y');
            } else {
              $day = '';
              $month = '';
              $year = '';
            }
            $day = '';
            $month = '';
            $year = '';
          }
          $day = '';
          $month = '';
          $year = '';
        }
    } else {
       $tags = '';
       $author = '';
       $category = '';
       $year = '';
       $month = '';
       $day = '';
    }
    if (is_search()) {
      $search_term = (isset($_GET['searchterm'])) ? $_GET['searchterm'] : 0;
      $classname = 'search';
    } else {
      $search_term = '';
      $classname = '';
    }
    $preloader_option = cs_get_option('pagination_type');
    $loadmoretxt = cs_get_option('loadmoretxt');
    $loadmore_message_blg = cs_get_option('loadmore_message_blg');
    $loadmoretxt = ($loadmoretxt) ? $loadmoretxt : 'Load More';
    $loadmore_message_blg = ($loadmore_message_blg) ? $loadmore_message_blg : 'All Loaded';
    if($preloader_option == 'ajax-load-more'){ ?>
      <div class="load_more_blog_messages"></div>
      <a class="btn load_more_btn load-more-posts" data-posts="<?php echo esc_attr($wp_query->found_posts); ?>" data-search="<?php echo esc_attr($search_term); ?>" data-tag="<?php echo esc_attr($tags); ?>" data-author="<?php echo esc_attr($author); ?>" data-category="<?php echo esc_attr($category); ?>" data-message="<?php echo esc_attr($loadmore_message_blg); ?>" data-page="1" data-url="<?php echo esc_url(admin_url( 'admin-ajax.php' )); ?>" data-offset="10"><img class="loader_gif" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/preloader.gif" alt=""> <span class="icon_pagination"><i class="fa fa-refresh"></i></span> <span class="txt"> <?php echo esc_attr($loadmoretxt); ?></span></a>
      <?php
      } else { ?>
        <div class="wp-link-pages pagination_home">
        <?php echo paginate_links( array(
            'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
            'format' => '?paged=%#%',
            'prev_text' => '<i class="fa fa-angle-left"></i>',
            'next_text' => '<i class="fa fa-angle-right"></i>',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
            'type' => 'plain'
          )); ?>
        </div>
  <?php }

  }
}

/**
 * GALLERY PAGING NAV
 */
if ( ! function_exists( 'eunice_gallery_load_more_ajax' ) ) {
  function eunice_gallery_load_more_ajax() {

    $paged = $_POST["page"]+1;
    $post_limit = $_POST["postPerPage"];
    $gallery_order = $_POST["order"];
    $gallery_orderby = $_POST["orderby"];
    $col_class = $_POST["col_class"];
    $category = $_POST["category"];
    $author = $_POST["author"];

    $args = array(
    'paged' => $paged,
    'gallery_category' => esc_attr($category),
    'author' => esc_attr($author),
    'post_type' => 'gallery',
    'post_status' => 'publish',
    'posts_per_page' => (int)$post_limit,
    'order' => esc_attr($gallery_order),
    'orderby' => esc_attr($gallery_orderby),
    );
    $ence_port = new WP_Query( $args );

    if ( $ence_port->have_posts() ) :
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
            $cat_class .= 'cat-'. $term->slug;
            if ($count != $i) {
              $cat_class .= '';
            } else {
              $cat_class .= '';
            }
          }
        }
        $eunice_large_image =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'fullsize', false, '' );
        $eunice_large_image = $eunice_large_image[0];
        if ($eunice_large_image) {
          $cover_image = '<img src="'.$eunice_large_image.'" alt="'.get_the_title().'">';
        } else {
          $cover_image = '<img src="'.EUNICE_PLUGIN_IMGS.'/featured-image.png" alt="'.get_the_title().'">';
        }
  ?>
  <!-- Filter single image item start \-->
  <div class="grid-item media-box single-item <?php echo esc_attr($cat_class).' '.esc_attr($col_class); ?>">
    <a href="<?php the_permalink(); ?>" class="single-img">
      <?php echo $cover_image; ?>
      <div class="media-box-img-cation">
        <div class="like-count-box">
          <span class="like-icon fa fa-heart-o"></span>
          <span class="like-count"><?php if(function_exists('zilla_likes')){ echo esc_attr(get_post_meta($post->ID, '_zilla_likes', true)); } ?>  <?php esc_html_e('Likes', 'eunice'); ?></span>
        </div>
        <div class="media-box-text">
          <h5><?php the_title(); ?></h5>
          <h6><?php $gallery_metaboxes = get_post_meta( $post->ID, 'gallery_metaboxes', true ); echo esc_attr($gallery_metaboxes['gallery_subtitle']); ?></h6>
        </div>
      </div>
    </a>
  </div><!--/ Filter single image item end-->
  <?php endwhile; // end post loop
  wp_reset_postdata();
  else :
   echo 0;
  endif; ?>
  <?php
    die();
  }
  add_action( 'wp_ajax_eunice_gallery_load_more_ajax', 'eunice_gallery_load_more_ajax' );
  add_action( 'wp_ajax_nopriv_eunice_gallery_load_more_ajax', 'eunice_gallery_load_more_ajax' );
}

if ( ! function_exists( 'eunice_gallery_paging_nav_ajax' ) ) {
  function eunice_gallery_paging_nav_ajax() {
    $loadmoretxt  = cs_get_option('loadmoretxt');
    $loadmoremessage  = cs_get_option('loadmore_message');
    $loadmoretxt = $loadmoretxt ? $loadmoretxt : esc_html__( 'Load More ', 'eunice' );
    $loadmoremessage = $loadmoremessage ? $loadmoremessage : esc_html__( 'There is no more gallery items', 'eunice' ); ?>
    <div class="load_more_gallery_messages"></div>
     <a class="load_more_btn gallery-load-more-posts" data-message="<?php echo esc_attr($loadmoremessage); ?>" data-page="1" data-url="<?php  echo esc_url(admin_url( 'admin-ajax.php' )); ?>"><img class="loader_gif" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/preloader.gif" alt=""> <span class="icon_pagination"><i class="fa fa-refresh"></i></span> <span class="txt"><?php echo esc_attr($loadmoretxt); ?></span></a>
  <?php  }
}

if ( ! function_exists( 'eunice_gallery_paging_nav' ) ) {
  function eunice_gallery_paging_nav($numpages = '', $pagerange = '', $paged='') {
    if (empty($pagerange)) {
      $pagerange = 2;
    }
    if (empty($paged)) {
      $paged = 1;
    }
    if ($numpages == '') {
      global $wp_query;
      $numpages = $wp_query->max_num_pages;
      if(!$numpages) {
        $numpages = 1;
      }
    }
    $big = 999999999;
?>
  <div class="wp-link-pages pagination_home gallery">
    <?php  echo paginate_links( array(
      'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
      'format' => '?page=%#%',
      'prev_text' => '<i class="fa fa-angle-left"></i>',
      'next_text' => '<i class="fa fa-angle-right"></i>',
      'current' => $paged,
      'total' => $numpages,
      'type' => 'plain'
    )); ?>
  </div>
<?php
  }
}

/**
 * COMMENTS
 */
if(! function_exists( 'eunice_remove_comment_fields' )){
  function eunice_remove_comment_fields($fields) {
    unset($fields['url']);
    return $fields;
  }
  add_filter('comment_form_default_fields','eunice_remove_comment_fields');
}

/**
 * PRELOADER
 */
if(! function_exists( 'eunice_site_preloader' )){
  function eunice_site_preloader(){
    $preloader_option  = cs_get_option('page_preloader');
    $upload_preloader  = cs_get_option('upload_preloader');
    if( $preloader_option == true ) {
      if($upload_preloader) {
        $img_meta = wp_get_attachment_metadata($upload_preloader);
        $margin_left = $img_meta['width']/2;
        $margin_top = $img_meta['height']/2;
      } else {
        $margin_left = '';
        $margin_top ='';
      }
    ?>
  <div id="cap-mask-preloder">
    <?php if( !empty($upload_preloader) ) { ?>
      <img src="<?php echo esc_url(wp_get_attachment_url($upload_preloader)) ; ?>" style="margin-left: -<?php echo esc_attr($margin_left); ?>px; margin-top: -<?php echo esc_attr($margin_top); ?>px; " >
    <?php } else { ?>
      <!-- animated preloder start \-->
      <div data-role="preloader" data-type="ring" data-style="dark" style="margin: auto" class="preloader-ring dark-style"></div>
  <?php  }  ?>
    <div class="prelod-bg"></div>
  </div><!--/ animated preloder end-->
<?php
    }
  }
}

/**
 * GALLERY PAGINATION
 */
if(! function_exists( 'eunice_gallery_pagination' )){
  function eunice_gallery_pagination(){
    $next_post = get_next_post(false);
    $prev_post = get_previous_post(false);
    if (!$next_post) {
      $class_next = 'disabled_next';
    } else {
      $class_next = '';
    }
    if( !$prev_post ){
      $class_prev = 'disabled_prev';
    } else {
      $class_prev = '';
    }
    $gallery_single_pagination = cs_get_option('gallery_single_pagination');
    $link = '';
    if (get_previous_post()) {
      $link .= '<a class="prive-link '.$class_prev.'" href="'.get_the_permalink( $prev_post->ID).'" ><span class="fa fa-angle-left"></span></a>';
    } else {
      $link .= '';
    }
    $link .= '<span class="link-spa"></span>';
    if(get_next_post()) {
      $link .= '<a class="next-link '.$class_next.'" href="'.get_the_permalink( $next_post->ID).'" ><span class="fa fa-angle-right"></span></a>';
    } else {
      $link .= '';
    }
    if ($gallery_single_pagination == true) {
      return $link;
    }
  }
}
