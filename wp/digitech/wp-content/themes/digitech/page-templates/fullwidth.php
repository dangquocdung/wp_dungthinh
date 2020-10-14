<?php
/**
 * Template Name: Full Width
 *
 * Description: Full Width page template
 *
 * @package WordPress
 * @subpackage Digitech_Theme
 * @since Digitech 1.0
 */
$digitech_opt = get_option( 'digitech_opt' );

get_header();
?>
<div class="main-container full-width">
	<div class="container">
		<?php Digitech_Class::digitech_breadcrumb(); ?> 
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>
	</div>
	<div class="page-content">
		<div class="container">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; ?>
		</div> 
	</div>
</div>
<?php get_footer(); ?>