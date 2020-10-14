<?php
/**
 * Entry Content / None
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<div class="no-results">
	<div class="no-results-title">
		<h1><?php esc_html_e( 'Nothing Found', 'weberium' ); ?></h1>
	</div>

	<div class="no-results-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p><?php 
				printf( '
					<a href="%1$s">%2$s</a>',
					esc_url( admin_url( 'post-new.php' ) ),
					esc_html__( 'Get started here with your first post', 'weberium' )
				);
			?></p>
		<?php else : ?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'weberium' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</div><!-- /.no-results -->
