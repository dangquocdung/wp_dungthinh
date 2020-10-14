<?php
/**
 * Page title templage
 */
?>
<?php if (is_archive() || (is_home() && !is_front_page()) || is_page() || is_search() || is_404()): ?>
	<div class="page-header">
		<div class="container">
			<?php if ((is_home() && !is_front_page()) || (is_page())): ?>
				<div class="page-main-title"><?php echo crown_get_page_title() ?></div>
			<?php else: ?>
				<h1 class="page-main-title"><?php echo crown_get_page_title() ?></h1>
			<?php endif; ?>
			<?php if (is_archive()): ?>
				<?php the_archive_description( '<div class="page-sub-title">', '</div>' );?>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>