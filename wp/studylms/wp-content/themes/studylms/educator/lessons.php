<?php
global $post;
if ( ! empty( $lessons ) ) : ?>
	<h2 class="edr-lessons-title"><?php esc_html_e( 'Curriculums', 'studylms' ); ?></h2>
	<ul class="edr-lessons">
		<?php $i = 1; foreach ( $lessons as $lesson ) :
			$post = $lesson;
			setup_postdata( $post );
			$obj = Edr_Access::get_instance();
			$access = $obj->can_study_lesson($lesson->ID);
		?>
			<li class="lesson <?php echo trim($access ? 'can-access' : ''); ?>">
				<div class="lessin-wrapper">
					<div class="lesson-icon">
						<span class="expand-lesson"><i class="mn-icon-193"></i></span>
						<?php $has_quiz = (boolean) get_post_meta( $lesson->ID, '_edr_quiz', true );
						if ($has_quiz) { ?>
							<i class="mn-icon-274"></i>
						<?php } else { ?>
							<i class="mn-icon-316"></i>
						<?php } ?>
					</div>
					<div class="lesson-header">
						<?php if ($access) { ?>
							<a class="lesson-title" href="<?php echo esc_url( get_permalink( $lesson->ID ) ); ?>">
						<?php } ?>
							<?php echo esc_html( $lesson->post_title ); ?>
						<?php if ($access) { ?>
							</a>
						<?php } ?>
					</div>
					<?php
						$duration = get_post_meta($post->ID, 'apus_lesson_duration', true);
					?>
					<div class="lesson-time">
						<?php echo trim($duration); ?>
					</div>
				</div>
				<?php if ( has_excerpt() ) : ?>
					<div class="lesson-excerpt"><?php the_excerpt(); ?></div>
				<?php endif; ?>
			</li>
		<?php $i++; endforeach; wp_reset_postdata(); ?>
	</ul>
<?php endif; ?>
