 <?php /* Template Name: Single Service */ 

$fixar_custom = isset( $wp_query ) ? get_post_custom( $wp_query->get_queried_object_id() ) : '';
$fixar_layout = isset ($fixar_custom['pix_page_layout']) ? $fixar_custom['pix_page_layout'][0] : '2';
$fixar_sidebar = isset ($fixar_custom['pix_selected_sidebar'][0]) ? $fixar_custom['pix_selected_sidebar'][0] : 'services-sidebar-1';

if ( ! is_active_sidebar($fixar_sidebar) ) $fixar_layout = '1';

?>
<?php get_header();?>

<section class="page-content">
    <div class="container">
        <div class="row">
      
		<?php fixar_show_sidebar( 'left', $fixar_layout, $fixar_sidebar ); ?>
        
        <div class="<?php if ( $fixar_layout == 1 ) : ?>col-lg-12 col-md-12<?php else : ?>col-lg-9 col-md-8<?php endif; ?> col-sm-12 col-xs-12 left-column sidebar-type-<?php echo esc_attr($fixar_layout == 2 ? 'right' : ($fixar_layout == 3 ? 'left' : 'hide')); ?> rtd">

        	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
					
				$fixar_thumbnail = get_the_post_thumbnail($post->ID);
			
			?>

		        <?php the_content(); ?>
                
            <?php endwhile; ?>

		</div>

		<?php fixar_show_sidebar( 'right', $fixar_layout, $fixar_sidebar ); ?>

		</div>
	</div>
</section>
<?php get_footer();?>
