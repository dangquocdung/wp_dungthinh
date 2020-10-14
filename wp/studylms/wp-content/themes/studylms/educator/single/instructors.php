<?php
global $post;
$author_id = $post->post_author;
$instructors = studylms_educator_get_meta('instructors');
if ( !empty($instructors) ) {
	$instructors = array_merge(array($author_id), $instructors);
} else {
	$instructors = array($author_id);
}
if (!empty($instructors)):
	$users = studylms_get_lecturers_by_ids( $instructors );
	if ( !empty($users) ):
?>
		<h3 class="title-tab"><?php esc_html_e('About Instructor', 'studylms'); ?></h3>
		<ul class="list-instructors">
			<?php
				foreach ($users as $user) {
					$author_info = get_the_author_meta( 'apus_edr_info', $user->ID );
					
					$job = isset($author_info['job']) ? $author_info['job'] : '';
					?>
					<li>
						<div class="about-container media">
							<div class="avatar-img media-left">
								<?php echo get_avatar( get_the_author_meta( 'user_email' ), 200 ); ?>
							</div>
							<!-- .author-avatar -->
							<div class="description media-body">
								<h4 class="author-title">
									<a href="<?php echo esc_url( get_author_posts_url( $user->ID ) ); ?>">
										<?php echo get_the_author_meta('display_name', $user->ID ); ?>
									</a>
								</h4>
								<?php if ( $job ): ?>
									<span class="job"><?php echo trim($job); ?></span>
								<?php endif; ?>
								<div class="description">
									<?php echo trim(studylms_substring(get_the_author_meta('description', $user->ID ), 20, '...')); ?>
								</div>
								<a class="redmore" href="<?php echo esc_url( get_author_posts_url( $user->ID ) ); ?>">
									<?php esc_html_e( 'View Profile', 'studylms' ); ?>
								</a>
							</div>
						</div>
					</li>
					<?php
				}
			?>
		</ul>
	<?php endif; ?>
<?php endif; ?>