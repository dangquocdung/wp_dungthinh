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
<div class="monyxi_admin_notice monyxi_welcome_notice update-nag"><?php
	// Theme image
	if ( ($monyxi_theme_img = monyxi_get_file_url('screenshot.jpg')) != '') {
		?><div class="monyxi_notice_image"><img src="<?php echo esc_url($monyxi_theme_img); ?>" alt="<?php esc_attr_e('Theme screenshot', 'monyxi'); ?>"></div><?php
	}

	// Title
	?><h3 class="monyxi_notice_title"><?php
		// Translators: Add theme name and version to the 'Welcome' message
		echo esc_html(sprintf(esc_html__('Welcome to %1$s v.%2$s', 'monyxi'),
				$monyxi_theme_obj->name . (MONYXI_THEME_FREE ? ' ' . esc_html__('Free', 'monyxi') : ''),
				$monyxi_theme_obj->version
				));
	?></h3><?php

	// Description
	?><div class="monyxi_notice_text"><?php
		echo str_replace('. ', '.<br>', wp_kses_data($monyxi_theme_obj->description));
		if (!monyxi_exists_trx_addons()) {
			echo (!empty($monyxi_theme_obj->description) ? '<br><br>' : '')
					. wp_kses_data(__('Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'monyxi'));
		}
	?></div><?php

	// Buttons
	?><div class="monyxi_notice_buttons"><?php
		// Link to the page 'About Theme'
		?><a href="<?php echo esc_url(admin_url().'themes.php?page=monyxi_about'); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> <?php
			// Translators: Add theme name
			echo esc_html(sprintf(esc_html__('About %s', 'monyxi'), $monyxi_theme_obj->name));
		?></a><?php
		// Link to the page 'Install plugins'
		if (monyxi_get_value_gp('page')!='tgmpa-install-plugins') {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-plugins"></i> <?php esc_html_e('Install plugins', 'monyxi'); ?></a>
			<?php
		}
		// Link to the 'One-click demo import'
		if (function_exists('monyxi_exists_ocdi') && monyxi_exists_ocdi()) {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=pt-one-click-demo-import'); ?>" class="button button-primary"><i class="dashicons dashicons-download"></i> <?php esc_html_e('One Click Demo Import', 'monyxi'); ?></a>
			<?php
		} else if (!monyxi_storage_isset('required_plugins', 'one-click-demo-import') && function_exists('monyxi_exists_trx_addons') && monyxi_exists_trx_addons() && class_exists('trx_addons_demo_data_importer')) {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=trx_importer'); ?>" class="button button-primary"><i class="dashicons dashicons-download"></i> <?php esc_html_e('One Click Demo Import', 'monyxi'); ?></a>
			<?php
		}
		// Link to the Customizer
		?><a href="<?php echo esc_url(admin_url().'customize.php'); ?>" class="button"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Customizer', 'monyxi'); ?></a><?php
		// Link to the Theme Options
		if (!MONYXI_THEME_FREE) {
			?><span> <?php esc_html_e('or', 'monyxi'); ?> </span>
        	<a href="<?php echo esc_url(admin_url().'themes.php?page=theme_options'); ?>" class="button"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Options', 'monyxi'); ?></a><?php
        }
        // Dismiss this notice
        ?><a href="#" class="monyxi_hide_notice"><i class="dashicons dashicons-dismiss"></i> <span class="monyxi_hide_notice_text"><?php esc_html_e('Dismiss', 'monyxi'); ?></span></a>
	</div>
</div>