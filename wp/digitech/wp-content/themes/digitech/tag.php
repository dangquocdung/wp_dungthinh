<?php
/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
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
<div class="main-container page-wrapper">
	<div class="container">

		<?php Digitech_Class::digitech_breadcrumb(); ?> 

		<div class="row">
			
			<?php if($digitech_blogsidebar=='left') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
			
			<div class="col-12 <?php echo 'col-lg-'.$digitech_blogcolclass; ?>">
			
				<div class="page-content blogs blog-page <?php echo esc_attr($digitech_blogclass); if($digitech_blogsidebar=='left') {echo ' left-sidebar'; } if($digitech_blogsidebar=='right') {echo ' right-sidebar'; } ?>">

					<header class="entry-header">
						<h1 class="entry-title"><?php if(isset($digitech_opt)) { echo esc_html($digitech_opt['blog_header_text']); } else { esc_html_e('Blog', 'digitech');}  ?></h1>
					</header>

					<?php if ( have_posts() ) : ?>
						<header class="archive-header">
							<h1 class="archive-title"><?php printf( wp_kses(__( 'Tag Archives: %s', 'digitech' ), array('span'=>array())), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>

						<?php if ( tag_description() ) : // Show an optional tag description ?>
							<div class="archive-meta"><?php echo tag_description(); ?></div>
						<?php endif; ?>
						</header><!-- .archive-header -->

						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the post format-specific template for the content. If you want to
							 * this in a child theme then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							get_template_part( 'content', get_post_format() );

						endwhile;
						?>
						
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