<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]>
<!-->
<html class="no-js" lang="en"><!--<![endif]-->
<head><?php wp_head(); ?></head>
<body>

<div id="preloader">
	<div id="status">&nbsp;</div>
</div>
<?php while (have_posts()) : the_post()?>
		<?php the_content(); ?>
	</div>	
<?php endwhile; ?>
<?php get_footer(); ?>