<?php
/**
 * Elementor Integration
 *
 * @author Jegtheme
 * @since 1.0.0
 * @package wordpress-virtual-tour
 */

namespace WVT\Elementor;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use WVT\Frontend;
use WVT\Integration\Options;

/**
 * Class Init
 *
 * @package wordpress-virtual-tour
 */
class Wvt extends Widget_Base {
	/**
	 * Get element name.
	 *
	 * Retrieve the element name.
	 *
	 * @since 1.4.0
	 * @access public
	 *
	 * @return string The name.
	 */
	public function get_name() {
		return Options::get_option()['id'];
	}

	/**
	 * Get element title.
	 *
	 * @return string Element title.
	 */
	public function get_title() {
		return Options::get_option()['name'];
	}

	/**
	 * Get widget categories.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		$category = Options::get_option()['category'];

		return [ sanitize_title( $category ) ];
	}

	/**
	 * Register controls.
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$options = Options::get_option();

		$this->start_controls_section( $options['segments']['id'], array(
			'label' => $options['segments']['name'],
			'tab'   => Controls_Manager::TAB_CONTENT,
		) );

		foreach($options['options'] as $key => $option) {
			if('select' === $option['type']) {
				$this->add_control(
					$key,
					[
						'label'       => $option['title'],
						'type'        => $option['type'],
						'default'     => $option['default'],
						'options'     => call_user_func( $option['options'] ),
						'label_block' => true,
						'description' => $option['description'],
					]
				);
			}
		}

		$this->end_controls_section();
	}

	/**
	 * Render Element
	 */
	protected function render() {
		$settings = $this->get_settings();
		echo Frontend::get_instance()->generate_shortcode($settings);
	}

	/**
	 * Render element output in the editor.
	 *
	 * Used to generate the live preview, using a Backbone JavaScript template.
	 *
	 * @since 2.0.0
	 * @access protected
	 */
	protected function _content_template() {}
}
