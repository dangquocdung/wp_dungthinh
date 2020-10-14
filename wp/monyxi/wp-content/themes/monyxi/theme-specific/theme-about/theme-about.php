<?php
/**
 * Information about this theme
 *
 * @package WordPress
 * @subpackage MONYXI
 * @since MONYXI 1.0.30
 */


// Redirect to the 'About Theme' page after switch theme
if (!function_exists('monyxi_about_after_switch_theme')) {
	add_action('after_switch_theme', 'monyxi_about_after_switch_theme', 1000);
	function monyxi_about_after_switch_theme() {
		update_option('monyxi_about_page', 1);
	}
}
if ( !function_exists('monyxi_about_after_setup_theme') ) {
	add_action( 'init', 'monyxi_about_after_setup_theme', 1000 );
	function monyxi_about_after_setup_theme() {
		if (!defined('WP_CLI') && get_option('monyxi_about_page') == 1) {
			update_option('monyxi_about_page', 0);
			wp_safe_redirect(admin_url().'themes.php?page=monyxi_about');
			exit();
		}
	}
}


// Add 'About Theme' item in the Appearance menu
if (!function_exists('monyxi_about_add_menu_items')) {
	add_action( 'admin_menu', 'monyxi_about_add_menu_items' );
	function monyxi_about_add_menu_items() {
		$theme = wp_get_theme();
		$theme_name = $theme->name . (MONYXI_THEME_FREE ? ' ' . esc_html__('Free', 'monyxi') : '');
		add_theme_page(
			// Translators: Add theme name to the page title
			sprintf(esc_html__('About %s', 'monyxi'), $theme_name),	//page_title
			// Translators: Add theme name to the menu title
			sprintf(esc_html__('About %s', 'monyxi'), $theme_name),	//menu_title
			'manage_options',											//capability
			'monyxi_about',											//menu_slug
			'monyxi_about_page_builder'								//callback

		);
	}
}


// Load page-specific scripts and styles
if (!function_exists('monyxi_about_enqueue_scripts')) {
	add_action( 'admin_enqueue_scripts', 'monyxi_about_enqueue_scripts' );
	function monyxi_about_enqueue_scripts() {
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		if (is_object($screen) && $screen->id == 'appearance_page_monyxi_about') {
			// Scripts
			wp_enqueue_script( 'jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true );
			
			if (function_exists('monyxi_plugins_installer_enqueue_scripts'))
				monyxi_plugins_installer_enqueue_scripts();
			
			// Styles
			wp_enqueue_style( 'fontello-icons',  monyxi_get_file_url('css/font-icons/css/fontello-embedded.css'), array(), null );
			if ( ($fdir = monyxi_get_file_url('theme-specific/theme-about/theme-about.css')) != '' )
				wp_enqueue_style( 'monyxi-about',  $fdir, array(), null );
		}
	}
}


// Build 'About Theme' page
if (!function_exists('monyxi_about_page_builder')) {
	function monyxi_about_page_builder() {
		$theme = wp_get_theme();
		?>
		<div class="monyxi_about">

			<?php do_action('monyxi_action_theme_about_before_header', $theme); ?>

			<div class="monyxi_about_header">

				<?php do_action('monyxi_action_theme_about_before_logo'); ?>

				<div class="monyxi_about_logo"><?php
					$logo = monyxi_get_file_url('theme-specific/theme-about/logo.jpg');
					if (empty($logo)) $logo = monyxi_get_file_url('screenshot.jpg');
					if (!empty($logo)) {
						?><img src="<?php echo esc_url($logo); ?>"><?php
					}
				?></div>

				<?php do_action('monyxi_action_theme_about_before_title', $theme); ?>
				
				<h1 class="monyxi_about_title"><?php
					// Translators: Add theme name and version to the 'Welcome' message
					echo esc_html(sprintf(esc_html__('Welcome to %1$s %2$s v.%3$s', 'monyxi'),
											$theme->name,
											MONYXI_THEME_FREE ? esc_html__('Free', 'monyxi') : '',
											$theme->version
										)
								);
				?></h1>

				<?php do_action('monyxi_action_theme_about_before_description', $theme); ?>

				<div class="monyxi_about_description">
					<?php
					if (MONYXI_THEME_FREE) {
						?><p><?php
							// Translators: Add the download url and the theme name to the message
							echo wp_kses_data(sprintf(__('Now you are using Free version of <a href="%1$s">%2$s Pro Theme</a>.', 'monyxi'),
														esc_url(monyxi_storage_get('theme_download_url')),
														$theme->name
														)
												);
							// Translators: Add the theme name and supported plugins list to the message
							echo '<br>' . wp_kses_data(sprintf(__('This version is SEO- and Retina-ready. It also has a built-in support for parallax and slider with swipe gestures. %1$s Free is compatible with many popular plugins, such as %2$s', 'monyxi'),
														$theme->name,
														monyxi_about_get_supported_plugins()
														)
												);
						?></p>
						<p><?php
							// Translators: Add the download url to the message
							echo wp_kses_data(sprintf(__('We hope you have a great acquaintance with our themes. If you are looking for a fully functional website, you can get the <a href="%s">Pro Version here</a>', 'monyxi'),
														esc_url(monyxi_storage_get('theme_download_url'))
														)
												);
						?></p><?php
					} else {
						?><p><?php
							// Translators: Add the theme name to the message
							echo wp_kses_data(sprintf(__('%s is a Premium WordPress theme. It has a built-in support for parallax, slider with swipe gestures, and is SEO- and Retina-ready', 'monyxi'),
														$theme->name
														)
												);
						?></p>
						<p><?php
							// Translators: Add supported plugins list to the message
							echo wp_kses_data(sprintf(__('The Premium Theme is compatible with many popular plugins, such as %s', 'monyxi'),
														monyxi_about_get_supported_plugins()
														)
												);
						?></p><?php
					}
					?>
				</div>

				<?php do_action('monyxi_action_theme_about_after_description', $theme); ?>

			</div>

			<?php do_action('monyxi_action_theme_about_before_tabs', $theme); ?>

			<div id="monyxi_about_tabs" class="monyxi_tabs monyxi_about_tabs">
				<ul>
					<?php do_action('monyxi_action_theme_about_before_tabs_list', $theme); ?>
					<li><a href="#monyxi_about_section_start"><?php esc_html_e('Getting started', 'monyxi'); ?></a></li>
					<li><a href="#monyxi_about_section_actions"><?php esc_html_e('Recommended actions', 'monyxi'); ?></a></li>
					<?php do_action('monyxi_action_theme_about_after_tabs_list', $theme); ?>
				</ul>

				<?php do_action('monyxi_action_theme_about_before_tabs_sections', $theme); ?>

				<div id="monyxi_about_section_start" class="monyxi_tabs_section monyxi_about_section"><?php
				
					// Install required plugins
					if (!MONYXI_THEME_FREE_WP && !monyxi_exists_trx_addons()) {
						?><div class="monyxi_about_block"><div class="monyxi_about_block_inner">
							<h2 class="monyxi_about_block_title">
								<i class="dashicons dashicons-admin-plugins"></i>
								<?php esc_html_e('ThemeREX Addons', 'monyxi'); ?>
							</h2>
							<div class="monyxi_about_block_description"><?php
								esc_html_e('It is highly recommended that you install the companion plugin "ThemeREX Addons" to have access to the layouts builder, awesome shortcodes, team and testimonials, services and slider, and many other features ...', 'monyxi');
							?></div>
							<?php monyxi_plugins_installer_get_button_html('trx_addons'); ?>
						</div></div><?php
					}
					
					// Install recommended plugins
					?><div class="monyxi_about_block"><div class="monyxi_about_block_inner">
						<h2 class="monyxi_about_block_title">
							<i class="dashicons dashicons-admin-plugins"></i>
							<?php esc_html_e('Recommended plugins', 'monyxi'); ?>
						</h2>
						<div class="monyxi_about_block_description"><?php
							// Translators: Add the theme name to the message
							echo esc_html(sprintf(esc_html__('Theme %s is compatible with a large number of popular plugins. You can install only those that are going to use in the near future.', 'monyxi'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>"
						   class="monyxi_about_block_link button button-primary"><?php
							esc_html_e('Install plugins', 'monyxi');
						?></a>
					</div></div><?php
					
					// Customizer or Theme Options
					?><div class="monyxi_about_block"><div class="monyxi_about_block_inner">
						<h2 class="monyxi_about_block_title">
							<i class="dashicons dashicons-admin-appearance"></i>
							<?php esc_html_e('Setup Theme options', 'monyxi'); ?>
						</h2>
						<div class="monyxi_about_block_description"><?php
							esc_html_e('Using the WordPress Customizer you can easily customize every aspect of the theme. If you want to use the standard theme settings page - open Theme Options and follow the same steps there.', 'monyxi');
						?></div>
						<a href="<?php echo esc_url(admin_url().'customize.php'); ?>"
						   class="monyxi_about_block_link button button-primary"><?php
							esc_html_e('Customizer', 'monyxi');
						?></a>
						<?php if (!MONYXI_THEME_FREE) { ?>
							<?php esc_html_e('or', 'monyxi'); ?>
							<a href="<?php echo esc_url(admin_url().'themes.php?page=theme_options'); ?>"
							   class="monyxi_about_block_link button"><?php
								esc_html_e('Theme Options', 'monyxi');
							?></a>
						<?php } ?>
					</div></div><?php
					
					// Documentation
					?><div class="monyxi_about_block"><div class="monyxi_about_block_inner">
						<h2 class="monyxi_about_block_title">
							<i class="dashicons dashicons-book"></i>
							<?php esc_html_e('Read full documentation', 'monyxi');	?>
						</h2>
						<div class="monyxi_about_block_description"><?php
							// Translators: Add the theme name to the message
							echo esc_html(sprintf(esc_html__('Need more details? Please check our full online documentation for detailed information on how to use %s.', 'monyxi'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(monyxi_storage_get('theme_doc_url')); ?>"
						   target="_blank"
						   class="monyxi_about_block_link button button-primary"><?php
							esc_html_e('Documentation', 'monyxi');
						?></a>
					</div></div><?php
					
					// Video tutorials
					?><div class="monyxi_about_block"><div class="monyxi_about_block_inner">
						<h2 class="monyxi_about_block_title">
							<i class="dashicons dashicons-video-alt2"></i>
							<?php esc_html_e('Video tutorials', 'monyxi');	?>
						</h2>
						<div class="monyxi_about_block_description"><?php
							// Translators: Add the theme name to the message
							echo esc_html(sprintf(esc_html__('No time for reading documentation? Check out our video tutorials and learn how to customize %s in detail.', 'monyxi'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(monyxi_storage_get('theme_video_url')); ?>"
						   target="_blank"
						   class="monyxi_about_block_link button button-primary"><?php
							esc_html_e('Watch videos', 'monyxi');
						?></a>
					</div></div><?php
					
					// Support
					if (!MONYXI_THEME_FREE) {
						?><div class="monyxi_about_block"><div class="monyxi_about_block_inner">
							<h2 class="monyxi_about_block_title">
								<i class="dashicons dashicons-sos"></i>
								<?php esc_html_e('Support', 'monyxi'); ?>
							</h2>
							<div class="monyxi_about_block_description"><?php
								// Translators: Add the theme name to the message
								echo esc_html(sprintf(esc_html__('We want to make sure you have the best experience using %s and that is why we gathered here all the necessary informations for you.', 'monyxi'), $theme->name));
							?></div>
							<a href="<?php echo esc_url(monyxi_storage_get('theme_support_url')); ?>"
							   target="_blank"
							   class="monyxi_about_block_link button button-primary"><?php
								esc_html_e('Support', 'monyxi');
							?></a>
						</div></div><?php
					}
					
					// Online Demo
					?><div class="monyxi_about_block"><div class="monyxi_about_block_inner">
						<h2 class="monyxi_about_block_title">
							<i class="dashicons dashicons-images-alt2"></i>
							<?php esc_html_e('On-line demo', 'monyxi'); ?>
						</h2>
						<div class="monyxi_about_block_description"><?php
							// Translators: Add the theme name to the message
							echo esc_html(sprintf(esc_html__('Visit the Demo Version of %s to check out all the features it has', 'monyxi'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(monyxi_storage_get('theme_demo_url')); ?>"
						   target="_blank"
						   class="monyxi_about_block_link button button-primary"><?php
							esc_html_e('View demo', 'monyxi');
						?></a>
					</div></div>
					
				</div>



				<div id="monyxi_about_section_actions" class="monyxi_tabs_section monyxi_about_section"><?php
				
					// Install required plugins
					if (!MONYXI_THEME_FREE_WP && !monyxi_exists_trx_addons()) {
						?><div class="monyxi_about_block"><div class="monyxi_about_block_inner">
							<h2 class="monyxi_about_block_title">
								<i class="dashicons dashicons-admin-plugins"></i>
								<?php esc_html_e('ThemeREX Addons', 'monyxi'); ?>
							</h2>
							<div class="monyxi_about_block_description"><?php
								esc_html_e('It is highly recommended that you install the companion plugin "ThemeREX Addons" to have access to the layouts builder, awesome shortcodes, team and testimonials, services and slider, and many other features ...', 'monyxi');
							?></div>
							<?php monyxi_plugins_installer_get_button_html('trx_addons'); ?>
						</div></div><?php
					}
					
					// Install recommended plugins
					?><div class="monyxi_about_block"><div class="monyxi_about_block_inner">
						<h2 class="monyxi_about_block_title">
							<i class="dashicons dashicons-admin-plugins"></i>
							<?php esc_html_e('Recommended plugins', 'monyxi'); ?>
						</h2>
						<div class="monyxi_about_block_description"><?php
							// Translators: Add the theme name to the message
							echo esc_html(sprintf(esc_html__('Theme %s is compatible with a large number of popular plugins. You can install only those that are going to use in the near future.', 'monyxi'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>"
						   class="monyxi_about_block_link button button button-primary"><?php
							esc_html_e('Install plugins', 'monyxi');
						?></a>
					</div></div><?php
					
					// Customizer or Theme Options
					?><div class="monyxi_about_block"><div class="monyxi_about_block_inner">
						<h2 class="monyxi_about_block_title">
							<i class="dashicons dashicons-admin-appearance"></i>
							<?php esc_html_e('Setup Theme options', 'monyxi'); ?>
						</h2>
						<div class="monyxi_about_block_description"><?php
							esc_html_e('Using the WordPress Customizer you can easily customize every aspect of the theme. If you want to use the standard theme settings page - open Theme Options and follow the same steps there.', 'monyxi');
						?></div>
						<a href="<?php echo esc_url(admin_url().'customize.php'); ?>"
						   target="_blank"
						   class="monyxi_about_block_link button button-primary"><?php
							esc_html_e('Customizer', 'monyxi');
						?></a>
						<?php esc_html_e('or', 'monyxi'); ?>
						<a href="<?php echo esc_url(admin_url().'themes.php?page=theme_options'); ?>"
						   class="monyxi_about_block_link button"><?php
							esc_html_e('Theme Options', 'monyxi');
						?></a>
					</div></div>
					
				</div>

				<?php do_action('monyxi_action_theme_about_after_tabs_sections', $theme); ?>
				
			</div>

			<?php do_action('monyxi_action_theme_about_after_tabs', $theme); ?>

		</div>
		<?php
	}
}


// Utils
//------------------------------------

// Return supported plugin's names
if (!function_exists('monyxi_about_get_supported_plugins')) {
	function monyxi_about_get_supported_plugins() {
		return '"' . join('", "', array_values(monyxi_storage_get('required_plugins'))) . '"';
	}
}

require_once MONYXI_THEME_DIR . 'includes/plugins-installer/plugins-installer.php';
?>