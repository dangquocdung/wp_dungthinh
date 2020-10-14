<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$bcol = 12/$columns;
if ( $columns == 5 ) {
	$bcol = 'cus-5';
}
$loop = studylms_educator_get_courses($course_type, $number);
if ( $loop->have_posts() ) :
?>
	<div class="widget widget-courses <?php echo esc_attr($el_class.' '.$layout_type); ?> <?php echo esc_attr( ($layout_type == 'list-v1') ? 'under-line': ''); ?>">
		<?php if ($title!=''): ?>
	        <h3 class="widget-title">
	            <span><?php echo esc_attr( $title ); ?></span>
		    </h3>
	    <?php endif; ?>
		<?php if ( $layout_type == 'grid' ) { ?>
			<div class="row">
				<?php $i = 0; while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<div class="col-md-<?php echo esc_attr($bcol); ?> col-sm-6 <?php echo ($i%$columns == 0) ? 'md-clearfix':''; ?> <?php echo ($i%2 == 0) ? 'sm-clearfix':''; ?>">
						<?php Edr_View::template_part( 'content', 'course' ); ?>
					</div>
				<?php $i++; endwhile; ?>
			</div>
		<?php } elseif ( $layout_type == 'carousel' ) { ?>
			<div class="owl-carousel owl-carousel-top" data-items="<?php echo esc_attr($columns); ?>" data-carousel="owl" data-smallmedium="2" data-extrasmall="2" data-pagination="false" data-nav="true">
			    <?php while ( $loop->have_posts() ): $loop->the_post(); ?>
		            <div class="item">
		               	<?php Edr_View::template_part( 'content', 'course' ); ?>
		            </div>
			    <?php endwhile; ?>
			</div> 
		<?php } elseif ( $layout_type == 'list-v1' ) { ?>
			<div class="widget-content">
			    <?php while ( $loop->have_posts() ): $loop->the_post(); ?>
		            <div class="course-item">
						<?php Edr_View::template_part( 'content-course-list', 'v1' ); ?>
					</div>
			    <?php endwhile; ?>
			</div>
		<?php } else { ?>
			<div class="widget-content">
			    <?php while ( $loop->have_posts() ): $loop->the_post(); ?>
		            <div class="course-item">
						<?php Edr_View::template_part( 'content-course-list', 'simple' ); ?>
					</div>
			    <?php endwhile; ?>
			</div>
		<?php } ?>
		<?php wp_reset_postdata(); ?>
	</div>
<?php endif; ?>