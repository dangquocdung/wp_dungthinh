<?php
/**
 * Edit Single Panorama
 *
 * @author Jegtheme
 * @since 1.0.0
 * @package wordpress-virtual-tour
 */

namespace WVT;

/**
 * Class Panorama_Map_Edit_Abstract
 *
 * @package WVT
 */
abstract class Panorama_Edit_Abstract {
	/**
	 * Post ID
	 *
	 * @var integer
	 */
	protected $post_id;

	/**
	 * Action Edit Panorama
	 *
	 * @var string
	 */
	public static $edit_nonce;

	/**
	 * Edit Panorama
	 *
	 * @var string
	 */
	public static $action;

	/**
	 * Panorama_Map_Edit_Abstract constructor.
	 */
	public function __construct() {
		add_action( 'admin_action_' . static::$action, [ $this, 'admin_init' ] );
	}

	/**
	 * Is admin init
	 */
	public function admin_init() {
		try {
			if ( ( isset( $_REQUEST['action'], $_REQUEST['nonce'], $_REQUEST['post'] ) && wp_verify_nonce( sanitize_key( $_REQUEST['nonce'] ), static::$action ) && $_REQUEST['action'] === static::$action ) || apply_filters( 'wvt_panorama_sandbox', false ) ) {
				$this->post_id = sanitize_text_field( wp_unslash( $_REQUEST['post'] ) );

				if ( ! $this->check_is_wvt( $this->post_id ) ) {
					throw new \Exception(
						sprintf( __( 'Invalid Post <a href="%s">Go Admin Panel</a>', 'wvt' ), $this->get_panorama_list_url() )
					);
				}

				header( 'Content-Type: ' . get_option( 'html_type' ) . '; charset=' . get_option( 'blog_charset' ) );

				$this->switch_to_post( $this->post_id );

				$this->set_editor_hook();

				$this->render_panorama_editor();

			} else {
				throw new \Exception(
					sprintf( __( 'Action & Nonce not valid <a href="%s">Go Admin Panel</a>', 'wvt' ), $this->get_panorama_list_url() )
				);
			}
		} catch ( \Exception $e ) {
			echo wp_kses( $e->getMessage(), wp_kses_allowed_html() );
		}

		die();
	}

	/**
	 * Setup global post data with current edited post
	 *
	 * @param integer $post_id Post ID.
	 */
	public function switch_to_post( $post_id ) {
		$post_id         = absint( $post_id );
		$GLOBALS['post'] = get_post( $post_id ); // WPCS: override ok.
		setup_postdata( $GLOBALS['post'] );
	}

	/**
	 * Editor filter
	 */
	public function set_editor_hook() {
		add_filter( 'show_admin_bar', '__return_false' );

		// Remove all HTML related WordPress actions
		remove_all_actions( 'wp_head' );
		remove_all_actions( 'wp_print_styles' );
		remove_all_actions( 'wp_print_head_scripts' );
		remove_all_actions( 'wp_footer' );

		// Enqueue Script
		add_action( 'wp_head', 'wp_enqueue_scripts', 1 );
		add_action( 'wp_head', 'wp_print_styles', 8 );
		add_action( 'wp_head', 'wp_print_head_scripts', 9 );
		add_action( 'wp_head', 'wp_site_icon' );
		add_action( 'wp_head', [ $this, 'header_editor' ], 100 );

		// Handle `wp_footer`
		add_action( 'wp_footer', 'wp_print_footer_scripts', 20 );
		add_action( 'wp_footer', 'wp_auth_check_html', 30 );
		add_action( 'wp_footer', [ $this, 'footer_editor' ] );

		// Handle `wp_enqueue_scripts`
		remove_all_actions( 'wp_enqueue_scripts' );

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ], 999999 );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ], 999999 );

		do_action( 'wvt_after_set_editor' );
	}


	/**
	 * Load all style
	 */
	public function enqueue_styles() {
		wp_enqueue_media();

		wp_register_style( 'font-awesome',
			WVT_URL . '/assets/fonts/font-awesome/font-awesome.css',
			[], '4.7.0'
		);

		wp_register_style( 'wvt-form',
			WVT_URL . '/assets/css/wvt-form.css',
			[], WVT_VERSION
		);

		wp_register_style( 'pannellum',
			WVT_URL . '/assets/lib/pannellum/css/pannellum.css',
			[], WVT_VERSION
		);

		wp_register_style( 'wvt-frontend',
			WVT_URL . '/assets/css/wvt-frontend.css',
			[], WVT_VERSION
		);

		wp_register_style( 'selectize',
			WVT_URL . '/assets/css/selectize.default.css',
			[], WVT_VERSION
		);

		wp_register_style( 'magnific-popup',
			WVT_URL . '/assets/lib/magnific-popup/magnific-popup.css',
			[], WVT_VERSION
		);

		wp_register_style( 'perfect-scrollbar',
			WVT_URL . '/assets/lib/perfect-scrollbar/perfect-scrollbar.css',
			[], WVT_VERSION
		);

		wp_register_style( 'tooltipster-borderless',
			WVT_URL . '/assets/lib/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-borderless.min.css',
			[], WVT_VERSION );

		wp_register_style( 'tooltipster-light',
			WVT_URL . '/assets/lib/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-light.min.css',
			[], WVT_VERSION );

		wp_register_style( 'tooltipster-noir',
			WVT_URL . '/assets/lib/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-noir.min.css',
			[], WVT_VERSION );

		wp_register_style( 'tooltipster-punk',
			WVT_URL . '/assets/lib/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-punk.min.css',
			[], WVT_VERSION );

		wp_register_style( 'tooltipster-shadow',
			WVT_URL . '/assets/lib/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-shadow.min.css',
			[], WVT_VERSION );


		wp_register_style( 'tooltipster',
			WVT_URL . '/assets/lib/tooltipster/css/tooltipster.bundle.min.css',
			[
				'tooltipster-borderless',
				'tooltipster-light',
				'tooltipster-noir',
				'tooltipster-punk',
				'tooltipster-shadow'
			],
			WVT_VERSION
		);

		wp_register_style( 'loader',
			WVT_URL . '/assets/lib/vendor/loaders.min.css',
			[], WVT_VERSION
		);

		wp_enqueue_style( 'wvt-admin',
			WVT_URL . '/assets/css/wvt-admin.css',
			[
				'common',
				'forms',
				'font-awesome',
				'wvt-form',
				'pannellum',
				'selectize',
				'loader',
				'magnific-popup',
				'perfect-scrollbar',
				'tooltipster',
				'wvt-frontend',
				'wp-color-picker',
			],
			WVT_VERSION );
	}

	/**
	 * Load all script
	 */
	public function enqueue_scripts() {
		wp_register_script( 'perfect-scrollbar',
			WVT_URL . '/assets/lib/perfect-scrollbar/perfect-scrollbar.min.js',
			[], '1.4.0', true
		);

		wp_register_script( 'tooltipster',
			WVT_URL . '/assets/lib/tooltipster/js/tooltipster.bundle.min.js',
			[], '4.2.6', true
		);

		wp_register_script( 'magnific-popup',
			WVT_URL . '/assets/lib/magnific-popup/jquery.magnific-popup.min.js',
			[], '1.1.0', true
		);

		wp_register_script( 'selectize',
			WVT_URL . '/assets/lib/vendor/selectize.js',
			[], '0.12.2', true
		);

		wp_register_script( 'wvt-form',
			WVT_URL . '/assets/js/wvt-form.js',
			[], WVT_VERSION, true
		);

		wp_register_script( 'wvt-helper',
			WVT_URL . '/assets/js/wvt-helper.js',
			[], WVT_VERSION, true
		);

		wp_register_script( 'wvt-container',
			WVT_URL . '/assets/js/wvt-container.js',
			[], WVT_VERSION, true
		);

		wp_register_script( 'bootstrap',
			WVT_URL . '/assets/lib/vendor/bootstrap.min.js',
			[], '3.3.7', true
		);

		wp_register_script( 'bootstrap-iconpicker-iconset',
			WVT_URL . '/assets/lib/vendor/bootstrap-iconpicker-iconset-all.min.js',
			[], '1.9.0', true
		);

		wp_register_script( 'bootstrap-iconpicker',
			WVT_URL . '/assets/lib/vendor/bootstrap-iconpicker.min.js',
			[ 'bootstrap', 'bootstrap-iconpicker-iconset' ], '1.9.0', true
		);

		wp_register_script( 'wp-color-picker-alpha',
			WVT_URL . '/assets/lib/vendor/wp-color-picker-alpha.js',
			[ 'wp-color-picker' ], '1.9.0', true
		);

		wp_register_script( 'raf',
			WVT_URL . '/assets/lib/pannellum/js/RequestAnimationFrame.js',
			[], WVT_VERSION, true
		);

		wp_register_script( 'libpannellum',
			WVT_URL . '/assets/lib/pannellum/js/libpannellum.js',
			[], WVT_VERSION, true
		);

		wp_register_script( 'pannellum',
			WVT_URL . '/assets/lib/pannellum/js/pannellum.js',
			[ 'raf', 'libpannellum' ], WVT_VERSION, true
		);

		wp_register_script( 'wvt-edit',
			WVT_URL . '/assets/js/wvt-edit.js',
			[], WVT_VERSION, true
		);

		wp_enqueue_script( 'wvt-admin',
			WVT_URL . '/assets/js/wvt-admin.js',
			[
				'jquery',
				'underscore',
				'wp-util',
				'customize-base',
				'customize-controls',
				'jquery-ui-spinner',
				'perfect-scrollbar',
				'tooltipster',
				'magnific-popup',
				'selectize',
				'wvt-edit',
				'wvt-form',
				'wvt-helper',
				'wvt-container',
				'bootstrap',
				'bootstrap-iconpicker-iconset',
				'bootstrap-iconpicker',
				'wp-color-picker-alpha',
				'pannellum',
			],
			WVT_VERSION,
			true
		);

		wp_enqueue_code_editor(
			array(
				'type' => 'text/css',
			)
		);

		wp_enqueue_editor();
	}


	/**
	 * Check if WVT
	 *
	 * @return boolean
	 */
	abstract public function check_is_wvt( $post_id );

	/**
	 * Print Editor Template.
	 */
	abstract public function render_panorama_editor();

	/**
	 * Get Panorama List URL
	 *
	 * @return string
	 */
	abstract public function get_panorama_list_url();

	/**
	 * Frontend Header Editor
	 */
	abstract public function header_editor();

	/**
	 * Frontend Editor Footer
	 */
	abstract public function footer_editor();
}
