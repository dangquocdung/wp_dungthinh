<?php
/**
 * WP Bakery Integration
 *
 * @author Jegtheme
 * @since 1.0.0
 * @package wordpress-virtual-tour
 */

namespace WVT\Integration;

use WVT\Helper;

/**
 * Class Init
 *
 * @package wordpress-virtual-tour
 */
class Wpbakery {
	/**
	 * Wpbakery_Integration constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'additional_control' ), 98 );
		add_action( 'init', array( $this, 'map_vc' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_script' ) );
	}

	public function map_vc() {
		if ( class_exists( 'WPBakeryVisualComposerAbstract' ) ) {
			$data = Options::get_option();

			$vc_options                = array();
			$vc_options['base']        = $data['id'];
			$vc_options['params']      = Helper::options_to_vc( $data['options'], $data['segments'] );
			$vc_options['name']        = $data['name'];
			$vc_options['category']    = $data['category'];
			$vc_options['icon']        = $data['id'];
			$vc_options['description'] = $data['name'];

			vc_map( $vc_options );
		}
	}

	/**
	 * Enqueue admin script
	 */
	public function admin_script() {
		wp_enqueue_style( 'selectize', WVT_URL . '/assets/css/selectize.default.css', null, WVT_VERSION );
		wp_enqueue_script( 'selectize', WVT_URL . '/assets/lib/vendor/selectize.js', null, WVT_VERSION, true );
	}

	/**
	 * Additional Control for WPBakery Page builder
	 */
	public function additional_control() {
		if ( class_exists( 'WPBakeryVisualComposerAbstract' ) ) {
			$params = array(
				array( 'select', array( $this, 'vc_select' ), WVT_URL . '/assets/js/integration/wpbakery.js' ),
			);

			foreach ( $params as $param ) {
				call_user_func_array( 'vc_add_shortcode_param', $param );
			}
		}
	}

	/**
	 * VC Select, Handle both single & multiple select. Also handle Ajax Loaded Option.
	 *
	 * @param array $settings Array of setting.
	 * @param mixed $value Value of element.
	 *
	 * @return string
	 */
	public function vc_select( $settings, $value ) {
		ob_start();

		$options = array();
		foreach ( $settings['value'] as $key => $val ) {
			$options[] = array(
				'value' => $val,
				'text'  => $key,
			);
		}

		?>
		<div class="wvt-select-wrapper" data-ajax="<?php echo esc_attr( $settings['ajax'] ); ?>" data-multiple="<?php echo esc_attr( $settings['multiple'] ); ?>" data-nonce="<?php echo esc_attr( $settings['nonce'] ); ?>">
			<select class='wpb_vc_param_value wpb-input input-sortable <?php echo esc_html( $settings['param_name'] ); ?> <?php echo esc_html( $settings['type'] ); ?>_field'
					name="<?php echo esc_attr( $settings['param_name'] ); ?>">
				<option value=''>&nbsp;</option>
				<?php
				foreach ( $options as $option ) {
					$select = ( $option['value'] == $value ) ? 'selected' : '';
					?>
					<option value='<?php echo esc_attr( $option['value'] ); ?>' <?php echo esc_attr( $select ); ?>><?php echo esc_html( $option['text'] ); ?></option>
					<?php
				}
				?>
			</select>
		</div>
		<?php
		return ob_get_clean();
	}
}
