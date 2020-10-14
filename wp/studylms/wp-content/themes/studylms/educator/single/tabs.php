<?php
	$course_id = get_the_ID();
	$instructors = studylms_educator_get_meta('instructors');
	$nb_instructors = 1;
	if (!empty($instructors) && is_array($instructors)) {
		$nb_instructors = count($instructors) + 1;
	}
	$obj = Edr_Courses::get_instance();
	$lesson = $obj->get_course_lessons($course_id);
	$nb_lesson = is_array($lesson) ? count($lesson) : 0;
?>
<ul class="nav nav-tabs">
	<li><a href="#course-description"><?php esc_html_e( 'Desciptions', 'studylms' ); ?></a></li>
	<li><a href="#course-instructors"><?php echo sprintf(__('Instructors <span>%s</span>', 'studylms'), $nb_instructors); ?></a></li>
	<li><a href="#course-program"><?php echo sprintf(__('Program <span>%s</span>', 'studylms'), $nb_lesson); ?></a></li>
	<?php if ( comments_open() || get_comments_number() ) { ?>
		<li><a href="#course-review"><?php echo sprintf(__('Review <span>%s</span>', 'studylms'), get_comments_number()); ?></a></li>
	<?php } ?>
</ul>