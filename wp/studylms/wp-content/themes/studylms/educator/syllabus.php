<?php
global $post;
?>
<?php if ( ! empty( $syllabus ) ) : ?>
	<h2 class="title-tab"><?php esc_html_e( 'Curriculums', 'studylms' ); ?></h2>
	<div class="edr-syllabus">
		<?php $i = 1; foreach ( $syllabus as $group ) : ?>
			<?php if ( ! empty( $group['lessons'] ) ) : ?>
				<div class="group">
					<div class="group-header"><h3 class="group-title"><?php echo sprintf(esc_html__('Section %s - ', 'studylms'), $i); ?> <?php echo esc_html( $group['title'] ); ?></h3></div>
					<div class="group-body">
						<ul class="edr-lessons">
							<?php
								foreach ( $group['lessons'] as $lesson_id ) {
									if ( isset( $lessons[ $lesson_id ] ) ) {
										$post = $lessons[ $lesson_id ];
										setup_postdata( $post );
										$obj = Edr_Access::get_instance();
										$access = $obj->can_study_lesson($lesson_id);
										
										?>
											<li class="lesson <?php echo trim($access ? 'can-access' : ''); ?>">
												<div class="lessin-wrapper">
													<div class="lesson-icon">
														<span class="expand-lesson"><i class="mn-icon-193"></i></span>
														<?php $has_quiz = (boolean) get_post_meta( $lesson_id, '_edr_quiz', true );
														if ($has_quiz) { ?>
															<i class="mn-icon-274"></i>
														<?php } else { ?>
															<i class="mn-icon-316"></i>
														<?php } ?>
													</div>
													<div class="lesson-header">
														<?php if ($access) { ?>
															<a class="lesson-title" href="<?php the_permalink(); ?>">
														<?php } ?>
															<?php the_title(); ?>
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
										<?php
									}
								}
								wp_reset_postdata();
							?>
						</ul>
					</div>
				</div>
			<?php endif; ?>
		<?php $i++; endforeach; ?>
	</div>
<?php endif; ?>