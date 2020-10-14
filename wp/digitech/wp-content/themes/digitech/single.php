<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Digitech_Theme
 * @since Digitech 1.0
 */

$digitech_opt = get_option( 'digitech_opt' );

get_header();

$digitech_bloglayout = 'sidebar';
if(isset($digitech_opt['blog_layout']) && $digitech_opt['blog_layout']!=''){
	$digitech_bloglayout = $digitech_opt['blog_layout'];
}
if(isset($_GET['layout']) && $_GET['layout']!=''){
	$digitech_bloglayout = $_GET['layout'];
}
$digitech_blogsidebar = 'right';
if(isset($digitech_opt['sidebarblog_pos']) && $digitech_opt['sidebarblog_pos']!=''){
	$digitech_blogsidebar = $digitech_opt['sidebarblog_pos'];
}
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$digitech_blogsidebar = $_GET['sidebar'];
}
if ( !is_active_sidebar( 'sidebar-1' ) )  {
	$digitech_bloglayout = 'nosidebar';
}
switch($digitech_bloglayout) {
	case 'sidebar':
		$digitech_blogclass = 'blog-sidebar';
		$digitech_blogcolclass = 9;
		break;
	default:
		$digitech_blogclass = 'blog-nosidebar'; //for both fullwidth and no sidebar
		$digitech_blogcolclass = 12;
		$digitech_blogsidebar = 'none';
}
?>
<div class="main-container">

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
				if($digitech_blogsidebar=='left') {
					get_sidebar();
				}
			} ?>
			
			<div class="col-12 <?php echo 'col-lg-'.$digitech_blogcolclass; ?>">

				<div class="page-content blog-page single <?php echo esc_attr($digitech_blogclass); if($digitech_blogsidebar=='left') {echo ' left-sidebar'; } if($digitech_blogsidebar=='right') {echo ' right-sidebar'; } ?>">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', get_post_format() ); ?>

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
				if($digitech_blogsidebar=='right') {
					get_sidebar();
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