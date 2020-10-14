<?php
/**
 * The template for displaying Author Archive pages
 *
 * Used to display archive-type pages for posts by an author.
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
		Digitech_Class::digitech_post_thumbnail_size('digitech-category-thumb');
		break;
	case 'largeimage':
		$digitech_blogclass = 'blog-large';
		$digitech_blogcolclass = 9;
		$digitech_postthumb = '';
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
			<div class="col-12 <?php echo 'col-lg-'.$digitech_blogcolclass; ?>">

				<div class="blog-page blogs <?php echo esc_attr($digitech_blogclass); if($digitech_blogsidebar=='left') {echo ' left-sidebar'; } if($digitech_blogsidebar=='right') {echo ' right-sidebar'; } ?>">

					<header class="entry-header">
						<h1 class="entry-title"><?php if(isset($digitech_opt)) { echo esc_html($digitech_opt['blog_header_text']); } else { esc_html_e('Blog', 'digitech');}  ?></h1>
					</header>

					<?php if ( have_posts() ) : ?>

						<?php
							/* Queue the first post, that way we know
							 * what author we're dealing with (if that is the case).
							 *
							 * We reset this later so we can run the loop
							 * properly with a call to rewind_posts().
							 */
							the_post();
						?>

						<header class="archive-header">
							<h1 class="archive-title"><?php printf( esc_html__( 'Author Archives: %s', 'digitech' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
						</header><!-- .archive-header -->

						<?php
							/* Since we called the_post() above, we need to
							 * rewind the loop back to the beginning that way
							 * we can run the loop properly, in full.
							 */
							rewind_posts();
						?>

						<?php
						// If a user has filled out their description, show a bio on their entries.
						if ( get_the_author_meta( 'description' ) ) : ?>
						<div class="author-info archives">
							<div class="author-avatar">
								<?php
								/**
								 * Filter the author bio avatar size.
								 *
								 * @since Digitech 1.0
								 *
								 * @param int $size The height and width of the avatar in pixels.
								 */
								$author_bio_avatar_size = apply_filters( 'digitech_author_bio_avatar_size', 68 );
								echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
								?>
							</div><!-- .author-avatar -->
							<div class="author-description">
								<h2><?php printf( esc_html__( 'About %s', 'digitech' ), get_the_author() ); ?></h2>
								<p><?php the_author_meta( 'description' ); ?></p>
							</div><!-- .author-description	-->
						</div><!-- .author-info -->
						<?php endif; ?>

						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', get_post_format() ); ?>
						<?php endwhile; ?>
						
						<?php Digitech_Class::digitech_pagination(); ?>

					<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif; ?>
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