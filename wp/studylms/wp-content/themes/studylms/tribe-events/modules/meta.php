<?php
/**
 * Single Event Meta Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta.php
 *
 * @package TribeEventsCalendar
 */

do_action( 'tribe_events_single_meta_before' );


// Do we want to group venue meta separately?
$set_venue_apart = true;
?>

<?php
do_action( 'tribe_events_single_event_meta_primary_section_start' );
?>
<div class="event-meta">
	<?php
	// Always include the main event details in this first section
	tribe_get_template_part( 'modules/meta/details' );

	// Include organizer meta if appropriate
	if ( tribe_has_organizer() ) {
		tribe_get_template_part( 'modules/meta/organizer' );
	}

	do_action( 'tribe_events_single_event_meta_primary_section_end' );
	?>



	<?php if ( $set_venue_apart ) :
		tribe_get_template_part( 'modules/meta/venue' );
	endif;
	?>
</div>

<?php 
do_action( 'tribe_events_single_meta_after' );