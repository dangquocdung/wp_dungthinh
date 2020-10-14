<?php
/**
 * Entry Content
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
	<div class="post-content-archive-wrap clearfix">
	<?php get_template_part( 'templates/entry-content-media' ); ?>

	<div class="post-content-wrap">
	<?php
		get_template_part( 'templates/entry-content-meta' );
		get_template_part( 'templates/entry-content-title' );
	?>
	</div><!-- /.post-content-wrap -->
	</div><!-- /.post-content-archive-wrap -->
</article><!-- /.hentry -->