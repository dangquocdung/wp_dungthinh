<?php
global $post;
$course_id = $post->ID;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row">
        <div class="col-sm-9">
            <div class="entry-head">
                <div class="info-left">
                    <?php if (get_the_title()) { ?>
                        <h4 class="entry-title">
                            <?php the_title(); ?>
                        </h4>
                    <?php } ?>
                </div>
            </div>
            <div class="info-meta edr-course clearfix">
                <div class="edr-teacher pull-left">
                    <div class="avatar-img ">
                        <?php echo get_avatar( get_the_author_meta( 'user_email' ),200 ); ?>
                    </div>
                    <!-- .author-avatar -->
                    <div class="description">
                        <div class="title">
                            <?php echo esc_html__('author','studylms'); ?>
                        </div>
                        <h4 class="author-title">
                            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>">
                                <?php echo get_the_author(); ?>
                            </a>
                        </h4>
                    </div>
                </div>
                
                <?php
                    $terms = get_the_terms( $course_id, 'edr_course_category' );
                    if ( !empty($terms) ) {
                        ?>
                        <div class="category pull-left">
                            <div class="left-icon">
                                <i class="fa fa-bookmark-o text-theme" aria-hidden="true"></i>
                            </div>
                            <div class="right-categor">
                                <div class="title">
                                    <?php echo esc_html__('Category','studylms'); ?>
                                </div>
                                <?php 
                                foreach ( $terms as $term ) {
                                    echo '<a href="' . get_term_link( $term->term_id, 'edr_course_category' ) . '">' . $term->name . '</a>';
                                    break;
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                ?>
                <div class="course-review pull-right">
                    <?php
                        $total_rating = studylms_get_total_rating( get_the_ID() );
                        $total = studylms_get_total_reviews( get_the_ID() );
                    ?>
                    <?php studylms_print_review($total_rating, $total); ?>
                </div>
            </div>
        	<div class="entry-thumb <?php echo  (!has_post_thumbnail() ? 'no-thumb' : ''); ?>">
        		<?php
                    $thumb = studylms_post_thumbnail();
                    echo trim($thumb);
                ?>
        	</div>
        	<div class="detail-content">
                <?php
                    remove_action( 'edr_before_single_course_content', 'edr_display_course_info' );
                    remove_action( 'edr_after_single_course_content', 'edr_display_lessons' );
                ?>

                <div id="course-description" class="entry-description">
                    <h3 class="title-tab"><?php echo esc_html__('Course Description', 'studylms') ?></h3>
                    <?php the_content(); ?>
                </div><!-- /entry-content -->

                <div id="course-program">
                    <?php edr_display_lessons($course_id); ?>
                </div><!-- /entry-lesson -->

                <?php if ( studylms_get_config('show_course_social_share', true) || studylms_get_config('enable_course_bookmark', true) ) { ?>
                    <div class="course-socials-bookmark clearfix">
                        <?php if ( studylms_get_config('show_course_social_share', true) ) { ?>
                            <div class="course-socials pull-left">
                                <?php get_template_part( 'page-templates/parts/sharebox-course' ); ?>
                            </div>
                        <?php } ?>

                        <?php if ( studylms_get_config('enable_course_bookmark', true) ) { ?>
                            <div class="pull-right">
                            <?php get_template_part( 'educator/single/bookmark' ); ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
                
                <?php get_template_part( 'educator/single/instructors' ); ?>
                
                <?php
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }
                ?>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="sidebar">
                <div class="widget widget-special-features">
                    <?php
                        $buy_html = edr_get_buy_widget( array( 'object_id' => $course_id, 'object_type' => EDR_PT_COURSE, 'label' => esc_html__( 'Take this course', 'studylms' ) ) ); ?>
                    <?php if (!empty($buy_html)) { ?>
                        <div class="widget-title-special">
                            <?php echo trim($buy_html); ?>
                        </div>
                    <?php } else {
                        ?>
                        <div class="widget-title-special">
                            <div class="edr-buy-widget__link">
                            <?php echo esc_html__( 'Course Features', 'studylms' ); ?>
                            </div>
                        </div>
                        <?php
                    } ?>
                    <div class="widget-content">
                        <?php if (!empty($buy_html)) { ?>
                            <div class="widget-price">
                                <div class="price-label"><?php esc_html_e( 'Price:', 'studylms' ); ?></div>
                                <?php echo trim($buy_html); ?>
                            </div>
                        <?php } ?>
                        <?php get_template_part( 'educator/single/course-features' ); ?>
                    </div>
                </div>

                <?php if ( is_active_sidebar( 'single-course-sidebar' ) ) : ?>
                    <div class="widget-area">
                        <?php dynamic_sidebar( 'single-course-sidebar' ); ?>
                    </div><!-- .widget-area -->
                <?php endif; ?>
            </div>
        </div>
    </div>
</article>