<?php
$course_id = get_the_ID();
$duration = studylms_educator_get_meta('duration');
$registered = studylms_educator_get_students_by_course( $course_id );
$certificate = studylms_educator_get_meta('certificate');
$langauge = studylms_educator_get_meta('langauge');
$prerequisites = get_post_meta( $course_id, '_edr_prerequisites', true );
$difficulty = get_post_meta( $course_id, '_edr_difficulty', true );
$capacity = studylms_educator_get_meta('capacity');
$startcourse = studylms_educator_get_meta('startcourse');
$location = studylms_educator_get_meta('location');

$obj = Edr_Courses::get_instance();
$lesson = $obj->get_course_lessons($course_id);
$nb_lesson = is_array($lesson) ? count($lesson) : 0;
?>

<ul class="course-features">
	<?php if ( !empty($registered) ) { ?>
		<li>
			<i class="mn-icon-393"></i>
			<?php esc_html_e( 'Students:', 'studylms' ); ?>
			<span><?php echo count( $registered ); ?></span>
		</li>
	<?php } ?>
	<?php if ( !empty($duration) ) { ?>
		<li>
			<i class="mn-icon-1104"></i>
			<?php esc_html_e( 'Duration:', 'studylms' ); ?>
			<span><?php echo trim($duration); ?></span>
		</li>
	<?php } ?>
	<?php if ( !empty($nb_lesson) ) { ?>
		<li>
			<i class="mn-icon-1104"></i>
			<?php esc_html_e( 'Lessons:', 'studylms' ); ?>
			<span><?php echo trim($nb_lesson); ?></span>
		</li>
	<?php } ?>
	<?php if ( !empty($langauge) ) { ?>
		<li>
			<i class="mn-icon-560"></i>
			<?php esc_html_e( 'Language:', 'studylms' ); ?>
			<span><?php echo trim( $langauge ); ?></span>
		</li>
	<?php } ?>
	<?php if ( !empty($location) ) { ?>
		<li>
			<i class="mn-icon-1138"></i>
			<?php esc_html_e( 'Location:', 'studylms' ); ?>
			<span><?php echo trim($location); ?></span>
		</li>
	<?php } ?>
	<li>
		<i class="mn-icon-1104"></i>
		<?php esc_html_e( 'Prerequisites:', 'studylms' ); ?>
		<span><?php echo ($prerequisites ? esc_html__('Yes', 'studylms') : esc_html__('No', 'studylms') ); ?></span>
	</li>
	<?php if ( !empty($difficulty) ) { ?>
		<li>
			<i class="mn-icon-1013"></i>
			<?php esc_html_e( 'Skill Level:', 'studylms' ); ?>
			<span><?php echo trim( $difficulty ); ?></span>
		</li>
	<?php } ?>
	<?php if ( !empty($capacity) ) { ?>
		<li>
			<i class="mn-icon-613"></i>
			<?php esc_html_e( 'Course Capacity:', 'studylms' ); ?>
			<span><?php echo trim( $capacity ); ?></span>
		</li>
	<?php } ?>
	<?php if ( !empty($startcourse) ) { ?>
		<li>
			<i class="mn-icon-1128"></i>
			<?php esc_html_e( 'Start Course:', 'studylms' ); ?>
			<span><?php echo trim($startcourse); ?></span>
		</li>
	<?php } ?>
	<li>
		<i class="mn-icon-1240"></i>
		<?php esc_html_e( 'Certificate:', 'studylms' ); ?>
		<span><?php echo ($certificate ? esc_html__('Yes', 'studylms') : esc_html__('No', 'studylms') ); ?></span>
	</li>
</ul>
