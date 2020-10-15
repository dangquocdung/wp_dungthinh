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
} ?>

<?php

// Setup an array of venue details for use later in the template
$venue_details = array();

if ( $venue_name = tribe_get_venue() ) {
	$venue_details[] = $venue_name;
}

if ( $venue_address = tribe_get_venue_single_line_address(get_the_ID()) ) {
	$venue_details[] = $venue_address;
}
// Venue microformats
$has_venue_address = ( $venue_address ) ? ' location' : '';

// Organizer
$organizer = tribe_get_organizer();

$thumb_img = '';
if( has_post_thumbnail() ){
    $thumb_img = wp_get_attachment_image_url( get_post_thumbnail_id(),'full');
}
?>
<div class="wpc-event">
    <div class="event-place"><?php esc_html_e('in', 'onetheme'); ?>: <i><?php echo tribe_get_venue(); ?></i></div>
    <a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="event-img">
    	<img src="<?php echo esc_attr($thumb_img); ?>" class="wpc-back-img img-responsive" alt="<?php esc_html_e('Main image', 'onetheme'); ?>" data-s-hidden="1">
    	<h5 class="event-title"><?php the_title(); ?></h5>
	</a>
    <div class="event-info">
        <div class="info-date"><i class="fa fa-calendar-check-o"></i><?php echo tribe_get_start_date(); ?></div>
        <div class="info-route"><i class="fa fa-location-arrow"></i><?php echo tribe_get_address(); ?></div>
    </div>
    <div class="event-counter">
        <div class="wpc-coming-soon" data-end="<?php print tribe_get_start_date(get_the_ID(), false, $format = 'Y/m/d'); ?>"></div>
        <a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="further-btn">+</a></div>
</div>

