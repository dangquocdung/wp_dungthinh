<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package architect
 */

if ( ! function_exists( 'architect_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function architect_entry_meta() {
    // Hide category and tag text for pages.
    if ( 'post' === get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list( esc_html__( ', ', 'architect' ) );
        if ( $categories_list && architect_theme_categorized_blog() ) {
            printf( '<span class="tags">' . esc_html__( ' %1$s', 'architect' ) . '</span>', $categories_list ); // WPCS: XSS OK.
        }
    }
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
    }

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date() )
    );

    $posted_on = sprintf(
        esc_html_x( '%s', 'post date', 'architect' ), $time_string );
    echo '<span class="dates"> ' . $posted_on . '</span>';
    //the_time( get_option( 'date_format' ) );
}
endif;
                      

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function architect_theme_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'architect_theme_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,

            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'architect_theme_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so architect_theme_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so architect_theme_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in architect_theme_categorized_blog.
 */
function architect_theme_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'architect_theme_categories' );
}
add_action( 'edit_category', 'architect_theme_category_transient_flusher' );
add_action( 'save_post',     'architect_theme_category_transient_flusher' );

if ( ! function_exists( 'architect_excerpt_length' ) ) :
/**** Change length of the excerpt ****/
function architect_excerpt_length() {
      global $architect_option;
      if(isset($architect_option['blog_excerpt'])){
        $limit = $architect_option['blog_excerpt'];
      }else{
        $limit = 15;
      }  
      $excerpt = explode(' ', get_the_excerpt(), $limit);

      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
      return $excerpt;
}
endif;

if ( ! function_exists( 'architect_excerpt' ) ) :
/** Excerpt Section Blog Post **/
function architect_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}
endif;

if ( ! function_exists( 'architect_tag_cloud_widget' ) ) :
/**custom function tag widgets**/
function architect_tag_cloud_widget($args) {
    $args['number'] = 0; //adding a 0 will display all tags
    $args['largest'] = 18; //largest tag
    $args['smallest'] = 14; //smallest tag
    $args['unit'] = 'px'; //tag font unit
    $args['format'] = 'list'; //ul with a class of wp-tag-cloud
    $args['exclude'] = ''; //exclude tags by ID
    return $args;
}
add_filter( 'widget_tag_cloud_args', 'architect_tag_cloud_widget' );
endif;

if ( ! function_exists( 'architect_pagination' ) ) :
//pagination
function architect_pagination($prev = '<i class="fa fa-angle-left"></i>', $next = '<i class="fa fa-angle-right"></i>', $pages='') {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    if($pages==''){
        global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
    }
    $pagination = array(
        'base'          => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
        'format'        => '',
        'current'       => max( 1, get_query_var('paged') ),
        'total'         => $pages,
        'prev_text' => $prev,
        'next_text' => $next,       
        'type'          => 'list',
        'end_size'      => 3,
        'mid_size'      => 3
);
    $return =  paginate_links( $pagination );
    echo str_replace( "<ul class='page-numbers'>", '<ul class="pagination">', $return );
}
endif;

if ( ! function_exists( 'architect_custom_wp_admin_style' ) ) :
function architect_custom_wp_admin_style() {

        wp_register_style( 'architect_custom_wp_admin_css', get_template_directory_uri() . '/framework/admin/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'architect_custom_wp_admin_css' );

        wp_enqueue_script( 'architect-backend-js', get_template_directory_uri()."/framework/admin/admin-script.js", array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script( 'architect-backend-js' );
}
add_action( 'admin_enqueue_scripts', 'architect_custom_wp_admin_style' );
endif;

if ( ! function_exists( 'architect_search_form' ) ) :
/* Custom form search */
function architect_search_form( $form ) {
    $form = '<form class="search-form" role="search" method="get" action="' . esc_url(home_url( '/' )) . '" >  
        <input type="search" id="search" class="search-field" value="' . get_search_query() . '" name="s" placeholder="'.__('Search', 'architect').'" />
        <button class="search-submit" type="submit"><i class="fa fa-search"></i></button>
    </form>';
    return $form;
}
add_filter( 'get_search_form', 'architect_search_form' );
endif;

/* Custom comment List: */
function architect_theme_comment($comment, $args, $depth) {    
   $GLOBALS['comment'] = $comment; ?>
   <li class="comment">
      <div class="comment-body">
        <div class="comment-meta">
            <div class="comment-author vcard">
                <?php echo get_avatar($comment,$size='50',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=100' ); ?>
            </div>
        </div>
        <div class="comment-content">
            <?php if ($comment->comment_approved == '0'){ ?>
                 <p><em><?php esc_html_e('Your comment is awaiting moderation.','architect') ?></em></p>
            <?php }else{ ?>
                <?php comment_text() ?>
             <?php } ?>
            <cite class="fn"><?php printf(__('%s','architect'), get_comment_author_link()) ?></cite> -
            <a class="comment-date"><span><?php the_time( get_option( 'date_format' ) ); ?></span></a>
            <div class="reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
        </div>   
      </div>
    </li> 
<?php
}
if ( ! function_exists( 'architect_custom_header_socials' ) ) :
/**
 * Prints HTML with Custom Favicon.
 */
function architect_custom_header_socials() {
    global $architect_option;
    
    echo '<ul class="social">';
      if($architect_option['facebook']!=''){ 
          echo '<li class="facebook"><a target="_blank" href="' . esc_url($architect_option['facebook']) . '"><i class="fa fa-facebook"></i></a></li>';
      } 
      if($architect_option['twitter']!=''){ 
          echo '<li class="twitter"><a target="_blank" href="' . esc_url($architect_option['twitter']) . '"><i class="fa fa-twitter"></i></a></li>';
      } 
      if($architect_option['google']!=''){ 
          echo '<li class="google-plus"><a target="_blank" href="' . esc_url($architect_option['google']) . '"><i class="fa fa-google-plus"></i></a></li>';
      }   
      if($architect_option['youtube']!=''){ 
          echo '<li class="youtube"><a target="_blank" href="' . esc_url($architect_option['youtube']) . '"><i class="fa fa-youtube-play"></i></a></li>';
      } 
      if($architect_option['linkedin']!=''){ 
          echo '<li class="linkedin"><a target="_blank" href="' . esc_url($architect_option['linkedin']) . '"><i class="fa fa-linkedin"></i></a></li>';
      }  
      if($architect_option['pinterest']!=''){ 
          echo '<li class="pinterest"><a target="_blank" href="' . esc_url($architect_option['pinterest']) . '"><i class="fa fa-pinterest"></i></a></li>';
      } 
      if($architect_option['flickr']!=''){ 
          echo '<li class="flickr"><a target="_blank" href="' . esc_url($architect_option['flickr']) . '"><i class="fa fa-flickr"></i></a></li>';
      } 
      if($architect_option['instagram']!=''){ 
           echo '<li class="instagram"><a target="_blank" href="' . esc_url($architect_option['instagram']) . '"><i class="fa fa-instagram"></i></a></li>';            
      } 
      if($architect_option['github']!=''){ 
          echo '<li class="github"><a target="_blank" href="' . esc_url($architect_option['github']) . '"><i class="fa fa-github"></i></a></li>';
      } 
      if($architect_option['dribbble']!=''){ 
          echo '<li class="dribbble"><a target="_blank" href="' . esc_url($architect_option['dribbble']) . '"><i class="fa fa-dribbble"></i></a></li>';
      } 
      if($architect_option['behance']!=''){ 
          echo '<li class="behance"><a target="_blank" href="' . esc_url($architect_option['behance']) . '"><i class="fa fa-behance"></i></a></li>';
      }   
      if($architect_option['skype']!=''){ 
           echo '<li class="skype"><a href="' . esc_attr($architect_option['skype']) . '"><i class="fa fa-skype"></i></a></li>';
      } 
      if($architect_option['vimeo']!=''){ 
          echo '<li class="vimeo"><a target="_blank" href="' . esc_url($architect_option['vimeo']) . '"><i class="fa fa-vimeo"></i></a></li>';
      }   
      if($architect_option['tumblr']!=''){ 
          echo '<li class="tumblr"><a target="_blank" href="' . esc_url($architect_option['tumblr']) . '"><i class="fa fa-tumblr"></i></a></li>';
      } 
      if($architect_option['soundcloud']!=''){ 
          echo '<li class="soundcloud"><a target="_blank" href="' . esc_url($architect_option['soundcloud']) . '"><i class="fa fa-soundcloud"></i></a></li>';
      } 
      if($architect_option['lastfm']!=''){ 
          echo '<li class="lastfm"><a target="_blank" href="' . esc_url($architect_option['lastfm']) . '"><i class="fa fa-lastfm"></i></a></li>';            
      } 
      if($architect_option['rss']!=''){ 
          echo '<li class="rss"><a target="_blank" href="' . esc_url($architect_option['rss']) . '"><i class="fa fa-rss"></i></a></li>';            
      } 
      if($architect_option['email']!=''){ 
          echo '<li class="email"><a href="mailto:' . esc_attr($architect_option['email']) . '"><i class="fa fa-envelope"></i></a></li>';            
      } 
    echo '</ul>';

}
endif;

if ( ! function_exists( 'architect_custom_footer_socials' ) ) :
/**
 * Prints HTML with Custom Favicon.
 */
function architect_custom_footer_socials() {
    global $architect_option;
    
    echo '<ul class="social social-footer">';
      if($architect_option['facebook']!=''){ 
          echo '<li class="facebook"><a target="_blank" href="' . esc_url($architect_option['facebook']) . '"><i class="fa fa-facebook"></i></a></li>';
      } 
      if($architect_option['twitter']!=''){ 
          echo '<li class="twitter"><a target="_blank" href="' . esc_url($architect_option['twitter']) . '"><i class="fa fa-twitter"></i></a></li>';
      } 
      if($architect_option['google']!=''){ 
          echo '<li class="google-plus"><a target="_blank" href="' . esc_url($architect_option['google']) . '"><i class="fa fa-google-plus"></i></a></li>';
      }   
      if($architect_option['youtube']!=''){ 
          echo '<li class="youtube"><a target="_blank" href="' . esc_url($architect_option['youtube']) . '"><i class="fa fa-youtube-play"></i></a></li>';
      } 
      if($architect_option['linkedin']!=''){ 
          echo '<li class="linkedin"><a target="_blank" href="' . esc_url($architect_option['linkedin']) . '"><i class="fa fa-linkedin"></i></a></li>';
      }  
      if($architect_option['pinterest']!=''){ 
          echo '<li class="pinterest"><a target="_blank" href="' . esc_url($architect_option['pinterest']) . '"><i class="fa fa-pinterest"></i></a></li>';
      } 
      if($architect_option['flickr']!=''){ 
          echo '<li class="flickr"><a target="_blank" href="' . esc_url($architect_option['flickr']) . '"><i class="fa fa-flickr"></i></a></li>';
      } 
      if($architect_option['instagram']!=''){ 
           echo '<li class="instagram"><a target="_blank" href="' . esc_url($architect_option['instagram']) . '"><i class="fa fa-instagram"></i></a></li>';            
      } 
      if($architect_option['github']!=''){ 
          echo '<li class="github"><a target="_blank" href="' . esc_url($architect_option['github']) . '"><i class="fa fa-github"></i></a></li>';
      } 
      if($architect_option['dribbble']!=''){ 
          echo '<li class="dribbble"><a target="_blank" href="' . esc_url($architect_option['dribbble']) . '"><i class="fa fa-dribbble"></i></a></li>';
      } 
      if($architect_option['behance']!=''){ 
          echo '<li class="behance"><a target="_blank" href="' . esc_url($architect_option['behance']) . '"><i class="fa fa-behance"></i></a></li>';
      }   
      if($architect_option['skype']!=''){ 
           echo '<li class="skype"><a href="' . esc_attr($architect_option['skype']) . '"><i class="fa fa-skype"></i></a></li>';
      } 
      if($architect_option['vimeo']!=''){ 
          echo '<li class="vimeo"><a target="_blank" href="' . esc_url($architect_option['vimeo']) . '"><i class="fa fa-vimeo"></i></a></li>';
      }   
      if($architect_option['tumblr']!=''){ 
          echo '<li class="tumblr"><a target="_blank" href="' . esc_url($architect_option['tumblr']) . '"><i class="fa fa-tumblr"></i></a></li>';
      } 
      if($architect_option['soundcloud']!=''){ 
          echo '<li class="soundcloud"><a target="_blank" href="' . esc_url($architect_option['soundcloud']) . '"><i class="fa fa-soundcloud"></i></a></li>';
      } 
      if($architect_option['lastfm']!=''){ 
          echo '<li class="lastfm"><a target="_blank" href="' . esc_url($architect_option['lastfm']) . '"><i class="fa fa-lastfm"></i></a></li>';            
      } 
      if($architect_option['rss']!=''){ 
          echo '<li class="rss"><a target="_blank" href="' . esc_url($architect_option['rss']) . '"><i class="fa fa-rss"></i></a></li>';            
      } 
      if($architect_option['email']!=''){ 
          echo '<li class="email"><a href="mailto:' . esc_attr($architect_option['email']) . '"><i class="fa fa-envelope"></i></a></li>';            
      } 
    echo '</ul>';

}
endif;

if ( ! function_exists( 'architect_custom_favicon' ) ) :
/**
 * Prints HTML with Custom Favicon.
 */
function architect_custom_favicon() {
    global $architect_option;
    
    if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {        
        if($architect_option['favicon']['url'] !=''){ 
            echo '<link rel="shortcut icon" href="'.($architect_option['favicon']['url']).'">';    
        }
    } 
}
endif;


if ( ! function_exists( 'architect_header_class' ) ) :
/**
 * Add specific CSS class by filter
 */
function architect_header_class() {
  global $architect_option;
  $header_classes = array();

  if($architect_option['style_hover_menu']=='line1'){
    $header_classes[] = 'hover-style-2';
  }elseif($architect_option['style_hover_menu']=='bg'){
    $header_classes[] = 'hover-style-3';
  }elseif($architect_option['style_hover_menu']=='text'){
    $header_classes[] = 'hover-style-4';
  }elseif($architect_option['style_hover_menu']=='line2'){
    $header_classes[] = 'hover-style-5';
  }else{
    $header_classes[] = 'no-effect';
  }

  if($architect_option['style_seperator']=='line'){
    $header_classes[] = 'line-separator';
  }elseif($architect_option['style_seperator']=='circle'){
    $header_classes[] = 'circle-separator';
  }elseif($architect_option['style_seperator']=='square'){
    $header_classes[] = 'square-separator';
  }elseif($architect_option['style_seperator']=='plus'){
    $header_classes[] = 'plus-separator';
  }elseif($architect_option['style_seperator']=='strip'){
    $header_classes[] = 'strip-separator';
  }else{
    $header_classes[] = 'no-separator';
  }
  
  // return the $classes array
  echo implode( ' ', $header_classes );
}
endif;

