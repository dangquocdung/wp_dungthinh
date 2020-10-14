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
<article id="course-<?php echo intval( $course_id ); ?>" class="edr-course edr-course-list">
	<div class="row">
		<div class="col-md-4 col-sm-5">
			<div class="edr-thumbnail-wrapper">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="edr-course__image">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $thumb_size ); ?></a>
					</div>
				<?php endif; ?>
				<?php
					$duration = trim(studylms_educator_get_meta('duration'));
					if ( !empty($duration) ) {
						?>
						<div class="duration"><i class="mn-icon-1104"></i><?php echo trim($duration); ?></div>
						<?php
					}
				?>
			</div>
		</div>
		<div class="col-md-8 col-sm-7">
			<header class="edr-course__header">
				<div class="header-meta clearfix">
					<div class="category pull-left">
						<?php
		                    $terms = get_the_terms( $course_id, 'edr_course_category' );
		                    if ( !empty($terms) ) {
		                        foreach ( $terms as $term ) {
		                            echo '<a href="' . get_term_link( $term->term_id, 'edr_course_category' ) . '">' . $term->name . '</a>';
		                            break;
		                        }
		                    }
		                ?>
					</div>
				</div>
				<h2 class="edr-course__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			</header>
			<div class="meta-data clearfix">
				<div class="edr-teacher">
						<div class="avatar-img ">
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
				<div class="edr-course__price <?php echo ($price > 0)?'':'free-label'; ?>"><i class="mn-icon-961"></i> <?php echo trim($price_str); ?></div>
				<?php
				$registered = studylms_educator_get_students_by_course( get_the_ID() );
				?>
				<div class="edr-registered">
					<i class="mn-icon-393"></i> <?php echo count($registered); ?>
				</div>
				<div class="course-review pull-right">
					<?php
						$total_rating = studylms_get_total_rating( get_the_ID() );
						$total = studylms_get_total_reviews( get_the_ID() );
						studylms_print_review($total_rating, $total);
					?>
				</div>
			</div>
			<div class="meta-excerpt">
	            <?php if (! has_excerpt()) { ?>
	                <div class="entry-description"><?php echo trim(studylms_substring( get_the_content(), 20, '...' )); ?></div>
	            <?php } else { ?>
	                <div class="description"><?php echo trim(studylms_substring( get_the_excerpt(), 20, '...' )); ?></div>
	            <?php } ?>
			</div>
		</div>
	</div>
</article>