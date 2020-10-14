<?php 

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$bcol = 12/$columns;
$categories = (array) vc_param_group_parse_atts( $categories );
if ( !empty($categories) ): ?>
	<div class="widget-course-categories <?php echo esc_attr($el_class.' '.$style); ?>">
		<div class="row">
			<?php foreach ($categories as $item): ?>
				<?php
					$term = get_term_by( 'slug', $item['category'], 'edr_course_category' );
					if ( ! empty( $term ) && ! is_wp_error( $term ) ) {
						$link = get_term_link( $term, 'edr_course_category' );
				?>
					<div class="col-xs-6 col-sm-<?php echo esc_attr($bcol); ?>">
						<div class="category-wrapper">
							<a href="<?php echo esc_url($link); ?>">
								<?php if ( isset($item['image']) && $item['image'] ): ?>
									<?php $img = wp_get_attachment_image_src($item['image'], 'full'); ?>
									<?php if (isset($img[0]) && $img[0]) { ?>
						    			<?php studylms_display_image($img); ?>
									<?php } ?>
								<?php elseif( isset($item['icon']) && $item['icon'] ) : ?>
									<div class="icon">
										<i class="<?php echo esc_attr($item['icon']); ?>"></i>
									</div>
								<?php endif; ?>
								<h3><?php echo trim($item['name']); ?></h3>
							</a>
						</div>
					</div>
				<?php } ?>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>