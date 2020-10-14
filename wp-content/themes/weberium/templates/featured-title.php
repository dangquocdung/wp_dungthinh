<?php
/**
 * Featured Title
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer or Metabox
if ( ! weberium_get_mod( 'featured_title', true ) || weberium_metabox('hide_featured_title') )
    return;

// Get text more
$blog_title = weberium_get_mod( 'blog_featured_title' );
$blog_title   = $blog_title ? $blog_title : esc_html__( 'BLOG', 'weberium' );

$shop_title = weberium_get_mod( 'shop_featured_title' );
$shop_title   = $shop_title ? $shop_title : esc_html__( 'Shop', 'weberium' );

$title = esc_html__( 'Archives', 'weberium' );
if ( weberium_is_woocommerce_shop() )
    $title = $shop_title;
if ( is_post_type_archive( 'project' ) )
    $title = esc_html__( 'Project Archives', 'weberium' );
if ( is_home() or is_singular('post') ) {
    $title = $blog_title;
} elseif ( is_singular() ) {
    $title = get_the_title();
} elseif ( is_search() ) {
    $title = sprintf( esc_html__( 'Search results for &quot;%s&quot;', 'weberium' ), get_search_query() );
} elseif ( is_404() ) {
    $title = esc_html__( 'Error 404', 'weberium' );
} elseif ( is_author() ) {
    the_post();
    $title = sprintf( esc_html__( 'Author Archives: %s', 'weberium' ), get_the_author() );
    rewind_posts();
} elseif ( is_day() ) {
    $title = sprintf( esc_html__( 'Daily Archives: %s', 'weberium' ), get_the_date() );
} elseif ( is_month() ) {
    $title = sprintf( esc_html__( 'Monthly Archives: %s', 'weberium' ), get_the_date( 'F Y' ) );
} elseif ( is_year() ) {
    $title = sprintf( esc_html__( 'Yearly Archives: %s', 'weberium' ), get_the_date( 'Y' ) );
} elseif ( is_tax() || is_category() || is_tag() ) {
    $title = single_term_title( '', false );
}

// Return array to order contents
$featured_title_content = weberium_get_mod( 'featured_title_style' )
    ? explode( '_', weberium_get_mod( 'featured_title_style' ) )
    : array( "heading", "breadcrumbs" );
?>

<div id="featured-title" class="<?php echo weberium_feature_title_classes(); ?>" style="<?php echo weberium_background_css( 'featured_title_background_img' ); ?>">
    <div id="featured-title-inner" class="weberium-container clearfix">
        <div class="featured-title-inner-wrap">
            <?php
            foreach ( $featured_title_content as $content ) :
                // Get heading
                if ( 'heading' == $content ) {
                    // Dont load if disabled via Customizer
                    if ( weberium_get_mod( 'featured_title_heading', true ) ) : ?>
                        <div class="featured-title-heading-wrap">
                            <h1 class="featured-title-heading <?php echo weberium_feature_title_heading_classes(); ?>">
                                <?php echo esc_html( $title ); ?></h1>
                        </div>
                    <?php endif;
                }

                // Get breadcrumbs
                if ( 'breadcrumbs' == $content ) {
                    // Dont load if disabled via Customizer
                    if ( weberium_get_mod( 'featured_title_breadcrumbs', true ) ) : ?>
                        <div id="breadcrumbs">
                            <div class="breadcrumbs-inner">
                                <div class="breadcrumb-trail">
                                    <?php weberium_breadcrumbs(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif;
                } 
            endforeach; ?>
        </div>
    </div>
</div><!-- /#featured-title -->

