<?php
get_header();
$sidebar_configs = studylms_get_course_layout_configs();
$columns = studylms_get_config('course_columns', 1);
$bcol = floor( 12 / $columns );

studylms_render_breadcrumbs();
?>
<section id="main-container" class="main-content  <?php echo apply_filters('studylms_course_content_class', 'container');?> inner">
	
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
			<main id="main" class="site-main layout-course" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header hidden">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->

				<?php
				$layout = studylms_get_config('course_archive_display_mode', 'grid');
				if ($layout == 'grid') {
						$class = 'col-md-'.$bcol.($columns > 1 ? ' col-sm-6' : '');
					?>
					<div class="course-style-grid">
					    <div class="row">
					        <?php $count = 1; while ( have_posts() ) : the_post(); ?>
					            <div class="<?php echo esc_attr($class); ?> <?php echo ($count%$columns == 1) ? ' md-clearfix':''; ?> <?php echo ($columns > 1 && $count%2 == 1) ? ' sm-clearfix' : ''; ?>">
					                <?php get_template_part( 'educator/content', 'course' ); ?>
					            </div>
					        <?php $count++; endwhile; ?>
					    </div>
					</div>
					<?php
				} else {
					?>
					<div class="course-style-list">
						<?php while ( have_posts() ) : the_post(); ?>
			                <?php get_template_part( 'educator/content', 'course-list' ); ?>
				        <?php endwhile; ?>
					</div>
					<?php
				}
				// Previous/next page navigation.
				studylms_paging_nav();

			// If no content, include the "No posts found" template.
			else :
				get_template_part( 'post-formats/content', 'none' );

			endif;
			?>

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