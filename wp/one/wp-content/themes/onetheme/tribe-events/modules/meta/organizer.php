<?php
/**
 * Single Event Meta (Organizer) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
 *
 * @package TribeEventsCalendar
 */

$phone = tribe_get_organizer_phone();
$email = tribe_get_organizer_email();
$website = tribe_get_organizer_website_link();
?>

<div class="tribe-events-meta-group tribe-events-meta-group-organizer">
	<dl>
		<?php do_action( 'tribe_events_single_meta_organizer_section_start' ); ?>

		<?php if ( ! empty( $phone ) ): ?>
			<dd class="tel"><i class="fa fa-phone"></i><?php echo esc_attr($phone); ?></dd>
		<?php endif ?>

		<?php if ( ! empty( $email ) ): ?>
			<dd class="email"><i class="fa fa-envelope-o"></i><?php echo esc_attr($email); ?></dd>
		<?php endif ?>

		<?php if ( ! empty( $website ) ): ?>
			<dd class="url"><i class="fa fa-link"></i><?php printf('%s', $website); ?></dd>
		<?php endif ?>

		<?php do_action( 'tribe_events_single_meta_organizer_section_end' ); ?>
	</dl>
</div>