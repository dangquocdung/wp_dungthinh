<?php
/*
 * The template for gallery category pages.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */
get_header();

if (eunice_is_post_type('eunice')) {
	$eunice_gallery_style = cs_get_option('gallery_style');
	$eunice_gallery_style = $eunice_gallery_style ? $eunice_gallery_style : 'one';
}

$loadmoretxt  = cs_get_option('loadmoretxt');
$loadmoremessage  = cs_get_option('loadmore_message');
$loadmoretxt = $loadmoretxt ? $loadmoretxt : esc_html__( 'Load More ', 'eunice' );
$loadmoremessage = $loadmoremessage ? $loadmoremessage : esc_html__( 'There is no more gallery items', 'eunice' );

// single post er gallery gulo shortcode dia asbe
$eu_gallery_column = cs_get_option('gallery_column');
if( $eu_gallery_column == 'three-columns' ){
  $col_class = 'three-columns';
}elseif( $eu_gallery_column == 'five-columns' ){
  $col_class = 'five-columns';
}else{
  $col_class = '';
}

global $wp_query;
global $paged;
global $page;
?>

<div class="main-content-area">
    <div class="content-warp"><!-- filter container start\-->
    <div  id="filter-content" class="media-grid">
      <?php while(have_posts() ) : the_post();
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
                            <span class="like-count"><?php if(function_exists('zilla_likes')){ echo esc_attr(get_post_meta($post->ID, '_zilla_likes', true)); } ?> <?php esc_html_e('Likes', 'eunice'); ?></span>
                        </div>
                        <div class="media-box-text">
                            <h5><?php the_title(); ?></h5>
                            <h6><?php $gallery_metaboxes = get_post_meta( $post->ID, 'gallery_metaboxes', true ); echo esc_attr($gallery_metaboxes['gallery_subtitle']); ?></h6>
                        </div>
                    </div>
                </a>
          </div><!--/ Filter single image item end-->
      <?php endwhile;  ?>
    </div><!--/ Filter container end-->

<?php if($wp_query->max_num_pages >1){
  if (is_author()) {
    $author = get_the_author_meta( 'display_name', $wp_query->post->post_author );
  } else {
    $author = '';
  }
  if (is_tax()) {
    $category = single_cat_title( '', false );
  } else {
    $category = '';
  }
?>
  <div class="load_more_gallery_messages"></div>
   <a class="load_more_btn gallery-load-more-posts" data-posts="<?php echo esc_attr($wp_query->found_posts); ?>"  data-author="<?php echo esc_attr($author); ?>" data-category="<?php echo esc_attr($category);  ?>" data-class="<?php echo esc_attr($col_class); ?>" data-message="<?php echo esc_attr($loadmoremessage); ?>" data-page="1" data-url="<?php echo esc_url(admin_url( 'admin-ajax.php' )); ?>"><img class="loader_gif" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/preloader.gif" alt=""> <span class="icon_pagination"><i class="fa fa-refresh"></i></span> <span class="txt"><?php echo esc_attr($loadmoretxt); ?></span></a>
<?php } ?>

	</div> <!-- Row -->
</div> <!-- Container -->

<?php
get_footer();