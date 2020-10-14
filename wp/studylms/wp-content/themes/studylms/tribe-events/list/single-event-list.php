<?php
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

global $post;
$day = mysql2date('d', $post->EventStartDate, true);
$month = mysql2date('F', $post->EventStartDate, true);
$week = mysql2date('l', $post->EventStartDate, true);

// Setup an array of venue details for use later in the template
$venue_details = tribe_get_venue_details();

// Venue
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';
// Organizer
$organizer = tribe_get_organizer();
$start_datetime = tribe_get_start_date();

$end_datetime = tribe_get_end_date();
$venue_id = tribe_get_venue_id( get_the_ID() );
?>
<div class="event-item list-events">
  <div class="tribe-events-list event-list">

    <div class="tribe-events-inner">
      <div class="media">
        <div class="media-left media-middle">
          <div class="entry-date-wrapper">
            <div class="entry-date">
              <div class="top">
                <span class="day text-theme"><?php echo esc_attr( $day ); ?></span>
                <span class="month"><?php  echo trim( $month ); ?></span>
              </div>
              <span class="week"><?php echo trim( $week ); ?></span>
            </div>
          </div>
        </div>
        <div class="media-body media-middle">
          <div class="entry-meta-wrapper">
            <h2 class="tribe-events-list-event-title">
              <a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
                <?php the_title() ?>
              </a>
            </h2>
            <div class="meta-time">
              <span class="info-time">
                 <?php echo esc_html( $start_datetime ) ?>  -  <?php echo esc_html( $end_datetime ) ?>
              </span>
              <?php if ( tribe_get_address( $venue_id ) ) : ?>
                <!-- Venue Display Info -->
                <span class="tribe-events-venue-details">
                  | <?php echo tribe_get_address( $venue_id ); ?>
                </span> <!-- .tribe-events-venue-details -->
              <?php endif; ?>
            </div>
            <a class="btn btn-default btn-border2x btn-sm" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
              <?php esc_html_e( 'View More', 'studylms' ); ?>
            </a>
          </div>
        </div>
        <div class="media-right media-middle">
          <div class="tribe-events-image">
            <?php echo tribe_event_featured_image( null, 'studylms-event-thumb' ) ?>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>