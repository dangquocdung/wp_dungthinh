<?php
/**
 * The main template file
 */

$fixar_postpage_id = get_option( 'page_for_posts' );
$fixar_frontpage_id = get_option( 'page_on_front' );
$fixar_page_id = isset($wp_query) ? $wp_query->get_queried_object_id() : '';

if ( $fixar_page_id == $fixar_postpage_id && $fixar_postpage_id != $fixar_frontpage_id ) :
	$fixar_custom = isset( $wp_query ) ? get_post_custom( $wp_query->get_queried_object_id() ) : '';
	$fixar_layout = isset( $fixar_custom['pix_page_layout'] ) ? $fixar_custom['pix_page_layout'][0] : '2';
	$fixar_sidebar = isset( $fixar_custom['pix_selected_sidebar'][0] ) ? $fixar_custom['pix_selected_sidebar'][0] : 'sidebar-1';
else :
	$fixar_layout = fixar_get_option('blog_settings_sidebar_type', '2');
	$fixar_sidebar = fixar_get_option('blog_settings_sidebar_content', 'sidebar-1');
endif;

if ( ! is_active_sidebar($fixar_sidebar) ) $fixar_layout = '1';
?>
<?php get_header();?>

<section class="blog-content-section">
	<div class="container">
		<div class="row">
			<?php fixar_show_sidebar( 'left', $fixar_layout, $fixar_sidebar ); ?>

			<div class="<?php if ( $fixar_layout == 1 ) : ?>col-lg-12 col-md-12<?php else : ?>col-lg-9 col-md-8<?php endif; ?> col-sm-12 col-xs-12 left-column sidebar-type-<?php echo esc_attr($fixar_layout == 2 ? 'right' : ($fixar_layout == 3 ? 'left' : 'hide')); ?>">
			<?php
				$wp_query = new WP_Query();
	            $pp = get_option('posts_per_page');
	            $wp_query->query( 'posts_per_page='.$pp.'&paged='.$paged );
	            get_template_part( 'loop', 'index' );
			?>
			<?php 
				the_posts_pagination( array(
			        'prev_text'          => esc_html__( '&lt;', 'fixar' ),
			        'next_text'          => esc_html__( '&gt;', 'fixar' ),
			        'screen_reader_text' => esc_html__( '&nbsp;', 'fixar'),
			        'type' => 'list'
			    ) );
			?>
			</div>
			<!-- end col -->

			<?php fixar_show_sidebar( 'right', $fixar_layout, $fixar_sidebar ); ?>
		</div>
		<!-- end row -->
	</div>
</section>
<?php get_footer(); ?>
