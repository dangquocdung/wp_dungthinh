<article id="post-<?php the_ID(); ?>" <?php post_class('article-post'); ?>>
	<header class="entry-header">
		<?php crown_get_template('post/entry-title') ?>
		<?php crown_get_template('post/entry-meta') ?>
	</header><!-- .entry-header -->

	<?php crown_get_template('post/entry-thumbnail') ?>
	<?php crown_get_template('post/entry-content') ?>
	<?php crown_get_template('post/entry-footer') ?>

</article><!-- #post-## -->