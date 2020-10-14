<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Digitech_Theme
 * @since Digitech 1.0
 */
$digitech_opt = get_option( 'digitech_opt' );

get_header();
?>
<div class="main-container default-page">
	<div class="container">
		<?php Digitech_Class::digitech_breadcrumb(); ?> 
		<div class="row"> 
			<?php
			$customsidebar = get_post_meta( $post->ID, '_digitech_custom_sidebar', true );
			$customsidebar_pos = get_post_meta( $post->ID, '_digitech_custom_sidebar_pos', true );

			if($customsidebar != ''){
				if($customsidebar_pos == 'left' && is_active_sidebar( $customsidebar ) ) {
					echo '<div id="secondary" class="col-12 col-lg-3">';
						dynamic_sidebar( $customsidebar );
					echo '</div>';
				} 
			} else {
				if( $digitech_opt['sidebarse_pos']=='left'  || !isset($digitech_opt['sidebarse_pos']) ) {
					get_sidebar('page');
				}
			} ?>
			<div class="col-12 <?php if ( $customsidebar!='' || is_active_sidebar( 'sidebar-page' ) ) : ?>col-lg-9<?php endif; ?>">
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>
				<div class="page-content default-page">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', 'page' ); ?>
						<?php comments_template( '', true ); ?>
					<?php endwhile; // end of the loop. ?>
				</div>
			</div>
			<?php
			if($customsidebar != ''){
				if($customsidebar_pos == 'right' && is_active_sidebar( $customsidebar ) ) {
					echo '<div id="secondary" class="col-12 col-lg-3">';
						dynamic_sidebar( $customsidebar );
					echo '</div>';
				} 
			} else {
				if( $digitech_opt['sidebarse_pos']=='right' ) {
					get_sidebar('page');
				}
			} ?>
		</div>
	</div> 
	<!-- brand logo -->
	<?php 
		if(isset($digitech_opt['inner_brand']) && function_exists('digitech_brands_shortcode') && shortcode_exists( 'ourbrands' ) ){
			if($digitech_opt['inner_brand'] && isset($digitech_opt['brand_logos'][0]) && $digitech_opt['brand_logos'][0]['thumb']!=null) { ?>
				<div class="inner-brands">
					<div class="container">
						<?php if(isset($digitech_opt['inner_brand_title']) && $digitech_opt['inner_brand_title']!=''){ ?>
							<div class="title">
								<h3><?php echo esc_html( $digitech_opt['inner_brand_title'] ); ?></h3>
							</div>
						<?php } ?>
						<?php echo do_shortcode('[ourbrands]'); ?>
					</div>
				</div>
				
			<?php }
		}
	?>
	<!-- end brand logo --> 
</div>
<?php get_footer(); ?>