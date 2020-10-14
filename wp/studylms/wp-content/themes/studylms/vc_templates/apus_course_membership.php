<?php 

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$loop = new WP_Query( array(
	'post_type'      => EDR_PT_MEMBERSHIP,
	'posts_per_page' => $number,
	'post_status'    => 'publish',
	'order'          => 'ASC',
	'orderby'        => 'menu_order',
) );

if ( $loop->have_posts() ) :
	$columns = isset( $atts['columns'] ) ? $atts['columns'] : 1;
	?>
	<div class="widget widget-memberships <?php echo esc_attr($el_class); ?>">
		<div class="row edr-memberships">
			<?php
				while ( $loop->have_posts() ) {
					$loop->the_post();
					?>
					<div class="col-sm-4">
						<?php Edr_View::template_part( 'content', 'membership' ); ?>
					</div>
					<?php
				}
			?>
		</div>
	</div>
	<?php
	wp_reset_postdata();
endif;