<?php
/**
 * Elementor Integration
 *
 * @author Jegtheme
 * @since 1.0.0
 * @package wordpress-virtual-tour
 */

namespace WVT\Integration;

use Elementor\Plugin;
use WVT\Elementor\Wvt;

/**
 * Class Init
 *
 * @package wordpress-virtual-tour
 */
class Elementor {
	/**
	 * Elementor constructor.
	 */
	public function __construct() {
		add_action( 'elementor/init', [ $this, 'register_group' ] );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_module' ] );
		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'frontend_script' ] );
        add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'editor_style' ] );
	}

	/**
	 * Editor script
	 */
	public function editor_style() {
        wp_enqueue_style( 'wvt-elementor-editor', WVT_URL . '/assets/css/wvt-dashboard.css', null, WVT_VERSION );
    }

	/**
	 * Frontend script
	 */
	public function frontend_script() {
		wp_enqueue_script( 'wvt-elementor-frontend', WVT_URL . '/assets/js/integration/elementor.frontend.js', null, WVT_VERSION, true );
	}

	/**
	 * Get option
	 *
	 * @return array Get array of option.
	 */
	public function get_option() {
		return Options::get_option();
	}

	/**
	 * Register Group
	 */
	public function register_group() {
		Plugin::$instance->elements_manager->add_category(
			$this->get_option()['id'],
			[ 'title' => $this->get_option()['category'] ],
			1
		);
	}

	/**
	 * Register Module
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Widget Manager.
	 */
	public function register_module( $widgets_manager ) {
		$widgets_manager->register_widget_type( new Wvt() );
	}
}
