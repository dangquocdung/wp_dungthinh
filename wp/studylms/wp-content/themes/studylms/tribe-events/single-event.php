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

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();
$event_id = get_the_ID();

?>

<?php while ( have_posts() ) :  the_post(); ?>
	<?php
	global $post;
	$start = strtotime($post->EventStartDate);
	?>
	<div class="clearfix single-event">

		<div id="tribe-events-content" class="tribe-events-single">
			<!-- Notices -->
			<?php tribe_the_notices(); ?>
			<div class="tribe-events-schedule hidden tribe-clearfix">
				<?php echo tribe_events_event_schedule_details( $event_id, '<div class="events-meta">', '</div>' ); ?>
				<?php if ( tribe_get_cost() ) : ?>
					<span class="tribe-events-divider">|</span>
					<span class="tribe-events-cost"><?php echo tribe_get_cost( null, true ) ?></span>
				<?php endif; ?>
			</div>

			<!-- Event content -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			<div class="tribe-events-single-event-description tribe-events-content entry-content description">
				
				<div class="image-event">
					<div class="image-thumbnail">
						<?php the_post_thumbnail('full'); ?>
					</div>
					<!-- meta -->
					<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
					<?php
						if ( ! apply_filters( 'tribe_events_single_event_meta_legacy_mode', false ) ) {
							tribe_get_template_part( 'modules/meta' );
						} else {
							echo tribe_events_single_event_meta();
						}
					?>
					<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
				</div>
				<?php the_title( '<h1 class="tribe-events-single-event-title">', '</h1>' ); ?>
				
				<div class="clearfix"></div>
				<!-- content -->
				<h3 class="title"><?php echo esc_html__('Event Description', 'studylms'); ?></h3>
				<?php the_content(); ?>
				
				<!-- countdown -->
				<div class="apus-countdown" data-time="timmer"
		             data-date="<?php echo date('m',$start).'-'.date('d',$start).'-'.date('Y',$start).'-'. date('H',$start) . '-' . date('i',$start) . '-' .  date('s',$start) ; ?>">
		        </div>

				<!-- event speaker -->
				<?php
					$speakers = get_post_meta( get_the_ID(), 'apus_event_speakers', true );
					if ( !empty($speakers) ) {
				?>
						<h3 class="title"><?php echo esc_html__('Event Speaker', 'studylms'); ?></h3>
						<div class="speaker-content">
							<?php $speaker_desc = get_post_meta( get_the_ID(), 'apus_event_speaker_desc', true);
								echo trim($speaker_desc);
							?>
						</div>
						<div class="speakers">
							<div class="owl-carousel" data-items="4" data-carousel="owl" data-smallmedium="3" data-extrasmall="2" data-pagination="false" data-nav="true">
								<?php foreach ($speakers as $author_id) :?>
									<?php
										$user = get_user_by( 'id', $author_id );
										if ( !empty($user) ) {
											$author_info = get_the_author_meta( 'apus_edr_info', $author_id );
									?>
											<div class="item">
												<div class="avarta"><?php echo get_avatar( $author_id, 280); ?></div>
												<div class="content">
													<h3 class="name-teacher"><?php echo trim($user->display_name); ?></h3>
													<?php if ( isset($author_info['job']) ): ?><div class="job"><?php echo trim($author_info['job']); ?></div><?php endif; ?>
												</div>
											</div>
									<?php } ?>
								<?php endforeach; ?>
							</div>
						</div>
				<?php } ?>
				<!-- event map -->
				<?php
				$set_venue_apart = apply_filters( 'tribe_events_single_event_the_meta_group_venue', false, get_the_ID() );

				// If we have no map to embed and no need to keep the venue separate...
				if ( ! $set_venue_apart && ! tribe_embed_google_map() ) {
					tribe_get_template_part( 'modules/meta/venue' );
				} else {
					// If the venue meta has not already been displayed then it will be printed separately by default
					tribe_get_template_part( 'modules/meta/map' );
				}
				?>
			</div>
			<?php if( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>

		</div><!-- #tribe-events-content -->
	</div>
<?php endwhile; ?>