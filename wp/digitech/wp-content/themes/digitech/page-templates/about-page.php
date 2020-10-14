<?php
/**
 * Template Name: About Template
 *
 * Description: About page template
 *
 * @package WordPress
 * @subpackage Digitech_Theme
 * @since Digitech 1.0
 */
$digitech_opt = get_option( 'digitech_opt' );

get_header();
?>
<div class="main-container about-page">
	<div class="container">
		<?php Digitech_Class::digitech_breadcrumb(); ?> 
	</div>
	<div class="about-container">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'page' ); ?>
		<?php endwhile; ?>
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