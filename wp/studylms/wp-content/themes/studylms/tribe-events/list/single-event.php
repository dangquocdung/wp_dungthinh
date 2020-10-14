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
$start = strtotime($post->EventStartDate);
$day = date('d', $start);

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
<div class="tribe-events-list event-grid">
      <!-- Event date -->
      
      <div class="tribe-events-image">
        <?php echo tribe_event_featured_image( null, 'full' ) ?>
        <!-- Event Title -->
        <div class="tribe-events-title-wrapper">
          <?php do_action( 'tribe_events_before_the_event_title' ) ?>
          <h2 class="tribe-events-list-event-title">
            <a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
              <?php the_title() ?>
            </a>
          </h2>
          <?php do_action( 'tribe_events_after_the_event_title' ) ?>
        </div>
      </div>
      <div class="tribe-events-inner">
    		
    		<div class="entry-date-wrapper">
          <div class="entry-date">
            <span class="day"><?php echo esc_attr( $day ); ?></span>
            <span class="month-year"><?php echo esc_attr( date('M Y', $start) ); ?></span>
          </div>
        </div>
        <div class="entry-meta-wrapper">
          <!-- Event Cost -->
          <?php if ( tribe_get_cost() ) : ?>
            <div class="tribe-event-cost">
              <span><i class="mn-icon-961"></i><?php echo tribe_get_cost( null, true ); ?></span>
            </div>
          <?php endif; ?>
      	  <div class="info-time">
             <i class="mn-icon-1111"></i><?php echo esc_html( $start_datetime ) ?> <span class="space"><?php echo esc_html_e('to','studylms'); ?></span> <?php echo esc_html( $end_datetime ) ?>
          </div>
          <?php if ( tribe_get_address( $venue_id ) ) : ?>
            <!-- Venue Display Info -->
            <div class="tribe-events-venue-details">
              <i class="mn-icon-1142"></i><?php echo tribe_get_address( $venue_id ); ?>
            </div> <!-- .tribe-events-venue-details -->
          <?php endif; ?>
        </div>
      </div>
</div>