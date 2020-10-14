<?php 

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( is_user_logged_in() ) {
	if ( class_exists('Studylms_Educator_Bookmark') ) {
		$ids = Studylms_Educator_Bookmark::get_bookmark();
		if ( !empty($ids) ) {
			$loop = studylms_educator_get_courses( '', -1, false, $ids );
			if ( $loop->have_posts() ) {
			?>
				<div class="widget widget-courses-bookmark <?php echo esc_attr($el_class); ?>">
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<div class="bookmark-item">
							<?php Edr_View::the_template( 'content-course-list-simple', array( 'bookmark' => true ) ); ?>
						</div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			<?php }
		} else {
			?>
			<div><?php esc_html_e('Do not have any item in your bookmark.', 'studylms'); ?></div>
			<?php
		}
	}
} else {
	?>
	<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>">
        <?php esc_html_e( 'Please login to view this page', 'studylms' ); ?>
    </a>
	<?php
}