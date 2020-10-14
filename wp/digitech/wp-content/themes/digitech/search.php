<?php
/**
 * The template for displaying Search Results pages
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
			
				<div class="page-content blog-page blogs <?php echo esc_attr($digitech_blogclass); if($digitech_blogsidebar=='left') {echo ' left-sidebar'; } if($digitech_blogsidebar=='right') {echo ' right-sidebar'; } ?>">

					<header class="entry-header">
						<h1 class="entry-title"><?php if(isset($digitech_opt)) { echo esc_html($digitech_opt['blog_header_text']); } else { esc_html_e('Blog', 'digitech');}  ?></h1>
					</header>
					
					<?php if ( have_posts() ) : ?>
						
						<header class="archive-header">
							<h1 class="archive-title"><?php printf( wp_kses(__( 'Search Results for: %s', 'digitech' ), array('span'=>array())), '<span>' . get_search_query() . '</span>' ); ?></h1>
						</header><!-- .archive-header -->

						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', get_post_format() ); ?>
						<?php endwhile; ?>

						<?php Digitech_Class::digitech_pagination(); ?>

					<?php else : ?>

						<article id="post-0" class="post no-results not-found">
							<header class="entry-header">
								<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'digitech' ); ?></h1>
							</header>

							<div class="entry-content">
								<p><?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'digitech' ); ?></p>
								<?php get_search_form(); ?>
							</div><!-- .entry-content -->
						</article><!-- #post-0 -->

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