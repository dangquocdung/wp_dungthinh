<?php
global $post;
$current_lesson_id = get_the_ID();
if ( ! empty( $lessons ) ) : ?>
	<ul class="edr-lessons">
		<?php foreach ( $lessons as $lesson ) :
			$obj = Edr_Access::get_instance();
			$access = $obj->can_study_lesson($lesson->ID);
		?>
			<li class="lesson <?php echo trim($current_lesson_id == $lesson->ID ? 'active' : ''); ?> <?php echo trim($access ? 'can-access' : ''); ?>">
				<div class="lesson-header">
					<?php if ($access) { ?>
						<a class="lesson-title" href="<?php echo esc_url( get_permalink( $lesson->ID ) ); ?>">
					<?php } ?>
						<?php echo esc_html( $lesson->post_title ); ?>
					<?php if ($access) { ?>
						</a>
					<?php } else { ?>
						<span class="can-not-access"><i class="mn-icon-316"></i></span>
					<?php } ?>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
