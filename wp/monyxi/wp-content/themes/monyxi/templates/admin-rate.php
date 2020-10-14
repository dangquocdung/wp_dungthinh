<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage MONYXI
 * @since MONYXI 1.0.1
 */
 
$monyxi_theme_obj = wp_get_theme();

?>
<div class="monyxi_admin_notice monyxi_rate_notice update-nag"><?php
	// Theme image
	if ( ($monyxi_theme_img = monyxi_get_file_url('screenshot.jpg')) != '') {
		?><div class="monyxi_notice_image"><img src="<?php echo esc_url($monyxi_theme_img); ?>" alt="<?php esc_attr_e('Theme screenshot', 'monyxi'); ?>"></div><?php
	}

	// Title
	?><h3 class="monyxi_notice_title"><a href="<?php echo esc_url(monyxi_storage_get('theme_download_url')); ?>" target="_blank"><?php
		// Translators: Add theme name and version to the 'Welcome' message
		echo esc_html(sprintf(esc_html__('Rate our theme "%s", please', 'monyxi'),
				$monyxi_theme_obj->name . (MONYXI_THEME_FREE ? ' ' . esc_html__('Free', 'monyxi') : '')
				));
	?></a></h3><?php
	
	// Description
	?><div class="monyxi_notice_text">
		<p><?php echo wp_kses_data(__('We are glad you chose our WP theme for your website. You’ve done well customizing your website and we hope that you’ve enjoyed working with our theme.', 'monyxi')); ?></p>
		<p><?php echo wp_kses_data(__('It would be just awesome if you spend just a minute of your time to rate our theme or the customer service you’ve received from us.', 'monyxi')); ?></p>
		<p class="monyxi_notice_text_info"><?php echo wp_kses_data(__('* We love receiving 5-star ratings, because our CEO Henry Rise gives $5 to homeless dog shelter for every 5-star rating we get! Save the planet with us!', 'monyxi')); ?></p>
	</div><?php

	// Buttons
	?><div class="monyxi_notice_buttons"><?php
		// Link to the theme download page
		?><a href="<?php echo esc_url(monyxi_storage_get('theme_download_url')); ?>" class="button button-primary" target="_blank"><i class="dashicons dashicons-star-filled"></i> <?php
			// Translators: Add theme name
			echo esc_html(sprintf(esc_html__('Rate theme %s', 'monyxi'), $monyxi_theme_obj->name));
		?></a><?php
		// Link to the theme support
		?><a href="<?php echo esc_url(monyxi_storage_get('theme_support_url')); ?>" class="button" target="_blank"><i class="dashicons dashicons-sos"></i> <?php
			esc_html_e('Support', 'monyxi');
		?></a><?php
		// Link to the theme documentation
		?><a href="<?php echo esc_url(monyxi_storage_get('theme_doc_url')); ?>" class="button" target="_blank"><i class="dashicons dashicons-book"></i> <?php
			esc_html_e('Documentation', 'monyxi');
		?></a><?php
		// Dismiss
		?><a href="#" class="monyxi_hide_notice"><i class="dashicons dashicons-dismiss"></i> <span class="monyxi_hide_notice_text"><?php esc_html_e('Dismiss', 'monyxi'); ?></span></a>
	</div>
</div>