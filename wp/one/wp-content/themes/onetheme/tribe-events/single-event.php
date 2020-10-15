<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$event_id = get_the_ID();
if( has_post_thumbnail() ){
                $thumb_img = wp_get_attachment_image_url( get_post_thumbnail_id(),'full');
            }
  global $post;
  

?>

<article class="wpc-event-post clearfix">
    <div class="post-img">
        <!-- EVENT -->
        <div class="wpc-event event-single size-2">
            <div class="event-place"><?php esc_attr_e('in:', 'onetheme');?><i><?php echo tribe_get_venue(); ?></i></div>
	            <a href="#" class="event-img">
	           		<img src="<?php printf($thumb_img); ?>" class="wpc-back-img img-responsive" alt="<?php esc_html_e('Main image', 'onetheme'); ?>" data-s-hidden="1">
	            </a>
            <div class="event-info clearfix">
                <div class="info-left">
                    <div class="info-date"><i class="fa fa-calendar-check-o"></i><?php echo tribe_get_start_date(); ?></div>
                    <div class="info-route"><i class="fa fa-location-arrow"></i><?php echo tribe_get_address(); ?></div>
                </div>
                <div class="wpc-coming-soon" data-end="<?php print tribe_get_start_date($post, false, $format = 'Y/m/d'); ?>">
                </div>
            </div>
        </div>
    </div>
    <?php the_title( '<h3 class="tribe-events-single-event-title summary entry-title post-title">', '</h3>' ); ?>
    <div class="post-content">
      <?php while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<!-- Event featured image, but exclude link -->
				<!-- Event content -->
				<?php do_action( 'tribe_events_single_event_before_the_content' ); ?>
				<div class="tribe-events-single-event-description tribe-events-content entry-content description">
					<?php the_content(); ?>
				</div>
				<!-- .tribe-events-single-event-description -->
				<?php do_action( 'tribe_events_single_event_after_the_content' ); ?>

			</div><!-- #post-x -->
			<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template(); ?>
		<?php endwhile; ?>
    </div>
    <!-- TAGS -->
    <div class="wpc-post-tags">
        <?php if (get_the_tag_list()):?>
            <h5 class="post-tags-title no-padd-v"><i class="fa fa-tag"></i><?php esc_attr_e('Tags:', 'onetheme');?></h5>
            <ul class="post-tags-list">
                <li>
                    <?php 
                        $tag_list = get_the_tag_list();
                        if( !empty($tag_list) ):
                            echo get_the_tag_list('', ', ');
                        endif;
                    ?>
                 </li>
            </ul>
        <?php endif; ?>
    </div>
</article>

