<?php
/**
 * Single Event Meta (Venue) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/venue.php
 *
 * @package TribeEventsCalendar
 */

if ( ! tribe_get_venue_id() ) {
	return;
}

?>

<div class="venue_wrapper">
	<div class="media">
		<div class="media-left">
			<i class="mn-icon-1138"></i>
		</div>
		<div class="media-body">
			<div class="media-info-inner">
				<h3><?php echo esc_html__('Address :', 'studylms'); ?></h3>
				<span class="media-content">
					<?php
						$address = tribe_address_exists() ? '<address class="tribe-events-address">' . tribe_get_full_address() . '</address>' : '';
						echo trim($address);
					?>
				</span>
			</div>
		</div>
	</div>
</div>