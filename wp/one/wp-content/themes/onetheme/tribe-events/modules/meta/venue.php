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
$phone = tribe_get_phone();
$website = tribe_get_venue_website_link();
?>

<div class="tribe-events-meta-group tribe-events-meta-group-venue">
	<dl>
		<?php do_action( 'tribe_events_single_meta_venue_section_start' ); ?>

		<dd class="author fn org"><i class="fa fa-map-marker"></i><?php echo tribe_get_venue(); ?></dd>

		<?php
		// Do we have an address?
		$address = tribe_address_exists() ? '<address class="tribe-events-address">' . tribe_get_full_address() . '</address>' : '';

		// Display if appropriate
		if ( ! empty( $address ) ) {
			echo esc_html('<dd class="location">' . "$address </dd>");
		}
		?>
		<?php if ( ! empty( $phone ) ): ?>
			<dt><?php esc_attr_e('Phone:', 'onetheme'); ?></dt>
			<dd class="tel"><?php echo esc_attr($phone); ?></dd>
		<?php endif ?>

		<?php if ( ! empty( $website ) ): ?>
			<dt><?php esc_attr_e('Website:', 'onetheme'); ?></dt>
			<dd class="url"><?php echo esc_html($website); ?></dd>
		<?php endif ?>

		<?php do_action( 'tribe_events_single_meta_venue_section_end' ); ?>
	</dl>
</div>