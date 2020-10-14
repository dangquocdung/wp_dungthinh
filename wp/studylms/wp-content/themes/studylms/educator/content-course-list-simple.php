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
$bookmark = isset($bookmark) ? $bookmark : false;
?>
<article <?php if ($bookmark) { ?> id="bookmark-course-<?php echo esc_attr( get_the_ID() ); ?>" <?php } ?> class="edr-course edr-course-list-simple">
	<div class="media">
		<div class="media-left">
			<div class="edr-thumbnail-wrapper">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="edr-course__image">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $thumb_size ); ?></a>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="media-body">
			<div class="edr-course__header">
				<h2 class="edr-course__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<div class="edr-course__price <?php echo ($price > 0)?'':'free-label'; ?>"><?php echo trim($price_str); ?></div>
			</div>
		</div>
		<?php if ($bookmark) { ?>
			<div class="media-right media-middle">
				<a href="#bookmark-course-<?php echo esc_attr( get_the_ID() ); ?>" class="apus-bookmark-remove" data-id="<?php echo esc_attr( get_the_ID() ); ?>">
					<i class="fa fa-trash-o" aria-hidden="true"></i>
				</a>
			</div>
		<?php } ?>
	</div>
</article>