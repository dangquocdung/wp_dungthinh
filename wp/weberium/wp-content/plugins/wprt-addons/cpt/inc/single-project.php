<?php
get_header();

$related_title = weberium_get_mod( 'project_related_title' );
$related_title   = $related_title ? $related_title : esc_html__( 'RELATED PROJECTS', 'thecraft' );
$related_query = weberium_get_mod( 'project_related_query', '9' );
$related_column = weberium_get_mod( 'project_related_column', '4' );
$related_item_gap = weberium_get_mod( 'project_related_item_spacing', '17' );
$related_item_crop = weberium_get_mod( 'project_related_img_crop', 'square' );

$terms = get_the_terms( $post->ID, 'project_category' );
$term_ids = wp_list_pluck( $terms, 'term_id' );
?>
<div class="project-detail-wrap">
	<div class="weberium-container">
		<?php
		while ( have_posts() ) : the_post();
			the_content();
		endwhile; ?>
	</div>
</div>

<?php if ( weberium_get_mod( 'project_related', true )  ): ?>
<div class="project-related-wrap">
	<div class="title-wrap"><h2 class="title"><span><?php echo esc_html( $related_title ); ?></span></h2></div>
	<div class="weberium-container">
		<?php
		$query_args = array(
			'post_type' => 'project',
			'tax_query' => array(
				array(
				'taxonomy' => 'project_category',
				'field' => 'term_id',
				'terms' => $term_ids,
				'operator'=> 'IN'
				)),
			'ignore_sticky_posts' => 1,
			'post__not_in'=> array( $post->ID )
		);

		$query_args['posts_per_page'] = $related_query;
		$query = new WP_Query( $query_args );
		if ( $query->have_posts() ) : ?>
			<div class="project-related" data-gap="<?php echo esc_html( $related_item_gap ); ?>" data-column="<?php echo esc_html( $related_column ); ?>">
				<div class="owl-carousel owl-theme">
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<?php wp_enqueue_script( 'weberium-owlcarousel' ); ?>

					<div class="project-box style-1">
						<div class="inner">
							<?php
								if ( has_post_thumbnail() ) {
							    	$img_size = 'weberium-rectangle2';
		                    	}

		                    	$icon_html = sprintf('<div class="plus-icon"><a href="%1$s" title="%2$s"><span class="nz-plus4"></span></a></div>',
		                    		esc_url( get_the_permalink() ),
		                    		esc_attr( get_the_title() ),
		                    		weberium_get_image( array( 'size' => 'full', 'format' => 'src' ) )
		                    	);

		                    	$text_html = sprintf('<h2><span><a href="%1$s" title="%2$s">%3$s</a></span></h2>', esc_url( get_the_permalink() ), esc_attr( get_the_title() ), get_the_title() );

		                		echo '<div class="project-wrap"><div class="project-image">'. get_the_post_thumbnail( get_the_ID(), $img_size ) . $icon_html .'</div><div class="project-text">'. $text_html .'<div class="project-term">'. get_the_term_list( $post->ID, 'project_category', '<span>', ', </span><span>', '</span>' ) .'</div></div></div>';
							?>
		                </div>
					</div><!-- /.project-box -->
					<?php endwhile; ?>
				</div><!-- /.owl-carousel -->
			</div><!-- /.project-related -->
		<?php
		endif; wp_reset_postdata();
		?>
	</div><!-- /.weberium-container -->
</div><!-- /.project-related-wrap -->
<?php endif; ?>

<?php get_footer(); ?>