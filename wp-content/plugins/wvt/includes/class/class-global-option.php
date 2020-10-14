<?php
/**
 * Panorama Global Option
 *
 * @author Jegtheme
 * @since 1.0.0
 * @package wordpress-virtual-tour
 */

namespace WVT;

/**
 * Class Global Option
 *
 * @package WVT
 */
class Global_Option {

	/**
	 * Action Create Panorama
	 *
	 * @var string
	 */
	private $global_action = 'global_action';

	/**
	 * Single_Panorama_Create constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'handle_global_action' ) );
		add_action( 'wp_ajax_save_global_option', array( $this, 'handle_global_action' ) );
	}

	/**
	 * Handle global action
	 */
	public function handle_global_action() {
		if ( isset( $_POST['action'], $_POST['nonce'] ) && wp_verify_nonce( sanitize_key( $_POST['nonce'] ), $this->global_action ) ) {
			$data    = wvt_sanitize_input_field( $_POST );
			$action  = $data['action'];
			$to_save = array();

			if ( 'save_global_option' === $action ) {
				$data = $data['data'];
			}

			$fields = array_keys( $this->get_fields() );
			foreach ( $data as $key => $content ) {
				if ( in_array( $key, $fields, true ) ) {
					$to_save[ $key ] = $content;
				}
			}

			update_option( 'wvt', $to_save );

			if('save_global_option' === $action) {
				wp_send_json_success();
			}
		}
	}

	/**
	 * HTML of Global Option
	 */
	public function html() {
		?>
		<div class="wvt-global-panorama">
			<form method="post">
				<div class="wvt-global-panorama-wrapper">
					<h2><?php esc_html_e( 'Global Option', 'wvt' ); ?></h2>
					<p><?php esc_html_e( 'Panorama option that apply for every single panorama item on WordPress Virtual Tour', 'wvt' ) ?></p>
				</div>
				<div id="global-panorama-form">
					<?php $this->create_global_script(); ?>
				</div>
				<div class="wvt-global-panorama-button wvt-panorama-button">
					<input type="submit" value="<?php esc_html_e( 'Save Option', 'wvt' ); ?>"/>
				</div>
			</form>
		</div>
		<?php
	}

	/**
	 * Get field for single panorama creation
	 */
	public function get_fields() {
		$fields = array();

		$fields['context'] = array(
			'type'        => 'text',
			'title'       => esc_html__( 'Right Click Text', 'wvt' ),
			'description' => esc_html__( 'Text showing when right click on map.', 'wvt' ),
		);

		$fields['context_url'] = array(
			'type'        => 'text',
			'title'       => esc_html__( 'Right Click URL', 'wvt' ),
			'description' => esc_html__( 'URL on right click text.', 'wvt' ),
		);

		$fields['load_image'] = array(
			'type'        => 'image',
			'title'       => esc_html__( 'Image Load Background', 'wvt' ),
			'description' => esc_html__( 'Image background during load image.', 'wvt' ),
		);

		$fields['load_scene'] = array(
			'type'        => 'select',
			'title'       => esc_html__( 'Scene Loader', 'wvt' ),
			'description' => esc_html__( 'Choose panorama scene loader.', 'wvt' ),
			'options'     => array(
				'ball-pulse'				 => esc_html__( 'Circle Pulse', 'wvt' ),
				'ball-grid-pulse'			 => esc_html__( 'Circle Grid Pulse', 'wvt' ),
				'ball-clip-rotate'			 => esc_html__( 'Circle Clip Rotate', 'wvt' ),
				'ball-clip-rotate-pulse'	 => esc_html__( 'Circle Clip Rotate Pulse', 'wvt' ),
				'ball-clip-rotate-multiple'  => esc_html__( 'Circle Clip Rotate Multiple', 'wvt' ),
				'ball-pulse-rise'			 => esc_html__( 'Circle Pulse Rise', 'wvt' ),
				'ball-rotate'				 => esc_html__( 'Circle Rotate', 'wvt' ),
				'ball-zig-zag'				 => esc_html__( 'Circle Zig Zag', 'wvt' ),
				'ball-zig-zag-deflect'		 => esc_html__( 'Circle Zig Zag Deflect', 'wvt' ),
				'ball-triangle-path'		 => esc_html__( 'Circle Triangle Path', 'wvt' ),
				'ball-scale'				 => esc_html__( 'Circle Scale', 'wvt' ),
				'ball-scale-multiple'		 => esc_html__( 'Circle Scale Multiple', 'wvt' ),
				'ball-pulse-sync'			 => esc_html__( 'Circle Pulse Synce', 'wvt' ),
				'ball-beat'					 => esc_html__( 'Circle Beat', 'wvt' ),
				'ball-scale-ripple'			 => esc_html__( 'Circle Scale Ripple', 'wvt' ),
				'ball-scale-ripple-multiple' => esc_html__( 'Circle Scale Ripple Multiple', 'wvt' ),
				'ball-spin-fade-loader'		 => esc_html__( 'Circle Spin Fade Loader', 'wvt' ),
				'ball-grid-beat'			 => esc_html__( 'Circle Grid Beat', 'wvt' ),
				'square-spin'				 => esc_html__( 'Square Spin', 'wvt' ),
				'cube-transition'			 => esc_html__( 'Cube Transition', 'wvt' ),
				'line-scale'				 => esc_html__( 'Line Scale', 'wvt' ),
				'line-scale-party'			 => esc_html__( 'Line Scale Party', 'wvt' ),
				'line-scale-pulse-out'		 => esc_html__( 'Line Scale Pulse Out', 'wvt' ),
				'line-scale-pulse-out-rapid' => esc_html__( 'Line Scale Pulse Out Rapid', 'wvt' ),
				'line-spin-fade-loader'		 => esc_html__( 'Line Spin Fade Loader', 'wvt' ),
				'triangle-skew-spin'		 => esc_html__( 'Triangle Skew Spin', 'wvt' ),
				'pacman'					 => esc_html__( 'Pacman', 'wvt' ),
				'semi-circle-spin'			 => esc_html__( 'Semi Circle Spin', 'wvt' ),
			),
		);

		return $fields;
	}

	/**
	 * Get Global Option
	 */
	public function get_global_option() {
		return array(
			'nonce'  => wp_create_nonce( $this->global_action ),
			'ajax'   => admin_url( 'admin-ajax.php' ),
			'action' => $this->global_action,
			'lang'   => array(
				'save'   => esc_html__( 'Save Option', 'wvt' ),
				'saving' => esc_html__( 'Saving Option', 'wvt' ),
				'saved'  => esc_html__( 'Saved', 'wvt' )
			)
		);
	}

	/**
	 * Render Create Panorama Script
	 */
	public function create_global_script() {
		$settings = array();
		$fields   = $this->get_fields();

		foreach ( $fields as $key => $field ) {
			$settings[ $key ] = wvt_prepare_field( $key, $field );
		}

		?>
		<input type="hidden" name="action" value="<?php echo esc_attr( $this->global_action ); ?>"/>
		<input type="hidden" name="nonce" value="<?php echo esc_html( wp_create_nonce( $this->global_action ) ); ?>">
		<script type="text/javascript">
		(function ($) {
			$(document).ready(function () {
              	window.wvt_option = <?php echo wp_json_encode( $settings ); ?>;
              	window.wvt_global = <?php echo wp_json_encode($this->get_global_option()); ?>;
              	var values = <?php echo wp_json_encode(Helper::get_global_option()); ?>;
				if (undefined !== wvt.option) {
					wvt.option.build('wvt-global-panorama', 'global-panorama-form', window.wvt_option, values, true)
				}
			})
		})(jQuery)
		</script>
		<?php
	}
}
