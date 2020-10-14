<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 *
 */

$fixar_custom = isset( $wp_query ) ? get_post_custom( $wp_query->get_queried_object_id() ) : '';
$fixar_layout = isset( $fixar_custom['pix_page_layout'] ) ? $fixar_custom['pix_page_layout'][0] : '2';
$fixar_sidebar = isset( $fixar_custom['pix_selected_sidebar'][0] ) ? $fixar_custom['pix_selected_sidebar'][0] : 'sidebar-1';

if ( ! is_active_sidebar($fixar_sidebar) ) $fixar_layout = '1';

?>

<?php get_header();?>
    <section class="page-content" >
        <div class="container">
            <div class="row">
            
                <?php fixar_show_sidebar( 'left', $fixar_layout, $fixar_sidebar ); ?>

				<div class="<?php if ( $fixar_layout == 1 ) : ?>col-lg-12 col-md-12<?php else : ?>col-lg-9 col-md-8 left-column sidebar-type-<?php echo esc_attr($fixar_layout == 2 ? 'right' : ($fixar_layout == 3 ? 'left' : 'hide')); ?><?php endif; ?> col-sm-12 col-xs-12">

                   <div class="rtd"> <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                        <?php $fixar_page_com_id = $post; ?>
		                <?php the_content(); ?>
                       
                       <div class="page-links">  <?php wp_link_pages();?></div>
                       
                       
		                <?php
		                if('open' == $fixar_page_com_id->comment_status) {
			                comments_template();
		                }
		                ?>
                    <?php endwhile; ?>
                       </div>

                </div>
                
                <?php fixar_show_sidebar( 'right', $fixar_layout, $fixar_sidebar ); ?>
                
            </div>
        </div>
    </section>
<?php get_footer(); ?>