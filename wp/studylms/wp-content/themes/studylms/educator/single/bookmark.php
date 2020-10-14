<div class="course-bookmark">
    <?php if ( class_exists('Studylms_Educator_Bookmark') ) { $post_id = get_the_ID(); ?>
        <?php if ( !is_user_logged_in() ) { ?>
            <div class="bookmark-not-login"><?php esc_html_e( 'Please login to bookmark this course.', 'studylms' ); ?></div>
            <a href="#apus-bookmark-not-login" class="apus-bookmark-not-login" data-id="<?php echo esc_attr($post_id); ?>">
                <?php esc_html_e( 'Bookmark This Course', 'studylms' ); ?>
            </a>
        <?php } else {
                $link = '';
                if ( studylms_get_config('course_bookmark_page_slug') ) {
                    $args = array(
                        'name'        => studylms_get_config('course_bookmark_page_slug'),
                        'post_type'   => 'page',
                        'post_status' => 'publish',
                        'numberposts' => 1
                    );
                    $s_posts = get_posts($args);
                    if( $s_posts ) {
                        $link = get_permalink($s_posts[0]->ID);
                    }
                }
                $added = Studylms_Educator_Bookmark::check_course_added($post_id);
                if ($added) {
                    ?>
                    <a href="<?php echo esc_url($link); ?>" class="apus-bookmark-added">
                        <?php esc_html_e( 'View Your Bookmark', 'studylms' ); ?>
                    </a>
                    <?php
                } else {
                    ?>
                    <a href="<?php echo esc_url($link); ?>" class="apus-bookmark-add" data-id="<?php echo esc_attr($post_id); ?>">
                        <?php esc_html_e( 'Bookmark This Course', 'studylms' ); ?>
                    </a>
                    <?php
                }
            }
        ?>
    <?php } ?>
</div>
