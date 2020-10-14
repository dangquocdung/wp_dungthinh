<?php
get_header();
$sidebar_configs = studylms_get_lecturer_layout_configs();

studylms_render_breadcrumbs();
?>
<section id="main-container" class="main-content  <?php echo apply_filters('studylms_lecturer_content_class', 'container');?> inner">
	<div class="row">
		<?php if ( isset($sidebar_configs['left']) ) : ?>
			<div class="<?php echo esc_attr($sidebar_configs['left']['class']) ;?>">
			  	<aside class="sidebar sidebar-left" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			  		<?php if ( is_active_sidebar( $sidebar_configs['left']['sidebar'] ) ): ?>
			   			<?php dynamic_sidebar( $sidebar_configs['left']['sidebar'] ); ?>
			   		<?php endif; ?>
			  	</aside>
			</div>
		<?php endif; ?>

		<div id="main-content" class="col-sm-12 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">
			<main id="main" class="site-main layout-lecturer" role="main">

				<?php
					$user = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
					$author_info = get_the_author_meta( 'apus_edr_info', $user->ID );
					$author_more_info = get_the_author_meta( 'apus_edr_more_info', $user->ID );
				?>
				<div class="row">
					<div class="col-sm-3">
						<div class="author-photo-wrapper widget">
							<div class="author-photo">
								<?php echo get_avatar( $user->user_email , '285 '); ?>
							</div>
							<ul class="author-meta">
								<?php if ( isset($author_info['mobile']) && $author_info['mobile'] ): ?>
									<li><i class="fa fa-phone" aria-hidden="true"></i> <?php echo trim($author_info['mobile']); ?></li>
								<?php endif; ?>
								<?php if ( $user->user_email ): ?>
									<li><i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo trim($user->user_email); ?></li>
								<?php endif; ?>
								<?php if ( $user->user_url ): ?>
									<li><i class="fa fa-link" aria-hidden="true"></i> <?php echo trim($user->user_url); ?></li>
								<?php endif; ?>
							</ul>
							<div class="socials">
								<?php if ( isset($author_info['facebook']) && $author_info['facebook'] ): ?>
									<a href="<?php echo esc_url($author_info['facebook']); ?>" class="facebook"><i class="fa fa-facebook"></i></a>
								<?php endif; ?>
								<?php if ( isset($author_info['twitter']) && $author_info['twitter']): ?>
									<a href="<?php echo esc_url($author_info['twitter']); ?>" class="twitter"><i class="fa fa-twitter"></i></a>
								<?php endif; ?>
								<?php if ( isset($author_info['google']) && $author_info['google'] ): ?>
									<a href="<?php echo esc_url($author_info['google']); ?>" class="google"><i class="fa fa-google-plus"></i></a>
								<?php endif; ?>
								<?php if ( isset($author_info['linkedin']) && $author_info['linkedin'] ): ?>
									<a href="<?php echo esc_url($author_info['linkedin']); ?>" class="linkedin"><i class="fa fa-linkedin"></i></a>
								<?php endif; ?>
								<?php if ( isset($author_info['instagram']) && $author_info['instagram']): ?>
									<a href="<?php echo esc_url($author_info['instagram']); ?>" class="instagram"><i class="fa fa-instagram"></i></a>
								<?php endif; ?>
								<?php if ( isset($author_info['youtube']) && $author_info['youtube']): ?>
									<a href="<?php echo esc_url($author_info['youtube']); ?>" class="youtube"><i class="fa fa-youtube"></i></a>
								<?php endif; ?>
							</div>
						</div>
						<div class="author-send-message-wrapper">
							<!-- send message -->
							<?php get_template_part( 'page-templates/parts/send-message-form' ); ?>
						</div>
					</div>
					<div class="col-sm-9">
						<div class="author-header">
							<h2><?php echo trim($user->nickname); ?></h2>
							<ul class="author-more-info">
								<?php if ( isset($author_info['job']) ): ?>
									<li><?php echo sprintf(esc_html__('Role: %s', 'studylms'), $author_info['job']); ?></li>
								<?php endif; ?>
								<?php
								if ( isset($author_more_info['label']) && !empty($author_more_info['label']) && isset($author_more_info['volume']) && !empty($author_more_info['volume']) ) {
									foreach ($author_more_info['label'] as $key => $label) {
										?>
										<li><?php echo trim($label).': '.(isset($author_more_info['volume'][$key]) ? $author_more_info['volume'][$key] : ''); ?></li>
										<?php
									}
								}
								?>
							</ul>
						</div>
						<?php if ( !empty($user->user_description) ) { ?>
							<div class="author-content">
								<h2><?php esc_html_e( 'Biography', 'studylms' ); ?></h2>
								<?php echo trim($user->user_description); ?>
							</div>
						<?php } ?>
						<!-- course here -->
						<?php
							$loop = studylms_educator_get_courses( '', -1, $user->ID );
							if ( $loop->have_posts() ) {
								?>
								<div class="author-course">
									<h2><?php esc_html_e( 'Topics Handling', 'studylms' ); ?></h2>
									<ul class="author-course-wrapper">
										<li class="author-course-header">
											<div class="name"><?php esc_html_e( 'Course Name', 'studylms' ); ?></div>
											<div class="complexity"><?php esc_html_e( 'Complexity', 'studylms' ); ?></div>
											<div class="length"><?php esc_html_e( 'Length', 'studylms' ); ?></div>
										</li>
										<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
											<?php
												$difficulty = get_post_meta( get_the_ID(), '_edr_difficulty', true );
												$duration = studylms_educator_get_meta('duration');
											?>
											<li>
												<div class="name"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>
												<div class="complexity"><?php echo trim($difficulty); ?></div>
												<div class="length"><?php echo trim($duration); ?></div>
											</li>
										<?php endwhile; ?>
										<?php wp_reset_postdata(); ?>
									</ul>
								</div>
								<?php
							}
						?>
					</div>
				</div>

			</main><!-- .site-main -->
		</div><!-- .content-area -->
		<?php if ( isset($sidebar_configs['right']) ) : ?>
			<div class="<?php echo esc_attr($sidebar_configs['right']['class']) ;?>">
			  	<aside class="sidebar sidebar-right" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			   		<?php if ( is_active_sidebar( $sidebar_configs['right']['sidebar'] ) ): ?>
				   		<?php dynamic_sidebar( $sidebar_configs['right']['sidebar'] ); ?>
				   	<?php endif; ?>
			  	</aside>
			</div>
		<?php endif; ?>
		
	</div>
</section>
<?php get_footer(); ?>
