<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
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
		Digitech_Class::digitech_post_thumbnail_size('digitech-post-thumb');
		break;
	case 'largeimage':
		$digitech_blogclass = 'blog-large';
		$digitech_blogcolclass = 9;
		Digitech_Class::digitech_post_thumbnail_size('digitech-post-thumbwide');
		break;
	case 'grid':
		$digitech_blogclass = 'grid';
		$digitech_blogcolclass = 9;
		Digitech_Class::digitech_post_thumbnail_size('digitech-post-thumbwide');
		break;
	default:
		$digitech_blogclass = 'blog-nosidebar';
		$digitech_blogcolclass = 12;
		$digitech_blogsidebar = 'none';
		Digitech_Class::digitech_post_thumbnail_size('digitech-post-thumb');
}
?>

<div class="main-container">
	<div class="container">

		<?php Digitech_Class::digitech_breadcrumb(); ?> 

		<div class="row">
			<?php if($digitech_blogsidebar=='left') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
			
			<div class="page-content col-12 <?php echo 'col-lg-'.$digitech_blogcolclass; ?>">
			
				<div class="blog-page blogs <?php echo esc_attr($digitech_blogclass); if($digitech_blogsidebar=='left') {echo ' left-sidebar'; } if($digitech_blogsidebar=='right') {echo ' right-sidebar'; } ?>">

					<header class="entry-header">
						<h1 class="entry-title"><?php if(isset($digitech_opt) && ($digitech_opt !='')) { echo esc_html($digitech_opt['blog_header_text']); } else { esc_html_e('Blog', 'digitech');}  ?></h1>
					</header>

					<div class="blog-wrapper">
						
						<?php if ( have_posts() ) : ?>

							<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>
								
								<?php get_template_part( 'content', get_post_format() ); ?>
								
							<?php endwhile; ?>

							<?php Digitech_Class::digitech_pagination(); ?>
							
						<?php else : ?>

							<article id="post-0" class="post no-results not-found">

							<?php if ( current_user_can( 'edit_posts' ) ) :
								// Show a different message to a logged-in user who can add posts.
							?>
								<header class="entry-header">
									<h1 class="entry-title"><?php esc_html_e( 'No posts to display', 'digitech' ); ?></h1>
								</header>

								<div class="entry-content">
									<p><?php printf( wp_kses(__( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'digitech' ), array('a'=>array('href'=>array()))), admin_url( 'post-new.php' ) ); ?></p>
								</div><!-- .entry-content -->

							<?php else :
								// Show the default message to everyone else.
							?>
								<header class="entry-header">
									<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'digitech' ); ?></h1>
								</header>

								<div class="entry-content">
									<p><?php esc_html_e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'digitech' ); ?></p>
									<?php get_search_form(); ?>
								</div><!-- .entry-content -->
							<?php endif; // end current_user_can() check ?>

							</article><!-- #post-0 -->

						<?php endif; // end have_posts() check ?>
						
					</div>

				</div>
				
			</div>
			<?php if( $digitech_blogsidebar=='right') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
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