<?php
/**
 * Renders each course in the shortcode-courses.php template.
 *
 * @version 1.0.1
 */

$edr_courses = Edr_Courses::get_instance();
$course_id = get_the_ID();
$price = $edr_courses->get_course_price( $course_id );
$price_str = ( $price > 0 ) ? '<span class="letter-0">'.edr_format_price( $price ).'</span>' : _x( 'Free', 'price', 'studylms' );
$thumb_size = apply_filters( 'edr_courses_thumb_size', 'medium');
?>
<article id="course-<?php echo intval( $course_id ); ?>" class="edr-course edr-course-grid">
	<div class="edr-thumbnail-wrapper">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="edr-course__image">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $thumb_size ); ?></a>
			</div>
		<?php endif; ?>
	</div>
	<header class="edr-course__header">
		<div class="edr-course__price <?php echo ($price > 0)?'':'free-label'; ?>"><?php echo trim($price_str); ?></div>
		<h2 class="edr-course__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<div class="edr-teacher">
			<div class="avatar-img">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ),200 ); ?>
			</div>
			<!-- .author-avatar -->
			<div class="description">
				<h4 class="author-title">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>">
						<?php echo get_the_author(); ?>
					</a>
				</h4>
			</div>
		</div>
	</header>
	<div class="meta-data clearfix">
		<div class="header-meta clearfix">
			<?php
				$total_rating = studylms_get_total_rating( get_the_ID() );
				$total = studylms_get_total_reviews( get_the_ID() );
			?>
			<div class="info pull-left">
				<?php $registered = studylms_educator_get_students_by_course( get_the_ID() ); ?>
				<div class="edr-registered">
					<i class="mn-icon-393"></i> <?php echo count($registered); ?>
				</div>
				<div class="edr-comment">
					<i class="mn-icon-294"></i> <?php echo trim($total); ?>
				</div>
			</div>
			<div class="course-review pull-right">
				<?php studylms_print_review($total_rating, $total); ?>
			</div>
		</div>
		
	</div>
</article>