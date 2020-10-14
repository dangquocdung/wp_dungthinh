<?php
/**
 * License
 *
 * @author Jegtheme
 * @since 1.0.0
 * @package wordpress-virtual-tour
 */

namespace WVT;

/**
 * Class License
 *
 * @package WVT
 */
class Frontend {
	/**
	 * Instance of Frontend.
	 *
	 * @var Frontend
	 */
	private static $instance;

	/**
	 * Sequence
	 *
	 * @var integer
	 */
	private static $sequence = 1;

	/**
	 * Singleton page for Init Class
	 *
	 * @return Frontend
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Init constructor.
	 */
	private function __construct() {
		$this->prepare_shortcode();
		$this->hook();
	}

	/**
	 * Frontend Hook
	 */
	public function hook() {
		add_action( 'wp_enqueue_scripts', array( $this, 'load_assets' ) );
		add_action( 'wp_head', array( $this, 'wvt_global' ) );
		add_action( 'wp_ajax_wvt_panorama', array( $this, 'get_panorama' ) );
		add_action( 'wp_ajax_nopriv_wvt_panorama', array( $this, 'get_panorama' ) );
	}

	/**
	 * Get Panorama
	 */
	public function get_panorama() {
		$post = get_post( $_POST['post_id'] );

		if ( $post && 'publish' === $post->post_status && 'single-panorama' === $post->post_type ) {
			wp_send_json_success( [
				'post_id' => $post->ID,
				'option'  => Helper::get_panorama_option( $post->ID )
			] );
		} else {
			wp_send_json_error();
		}
	}

	/**
	 * Global WVT
	 */
	public function wvt_global() {
		$option = Helper::get_global_option();

		$global = array(
			'ajax'        => admin_url( 'admin-ajax.php' ),
			'wvt_url'     => WVT_URL,
			'placeholder' => WVT_URL . '/assets/img/placeholder.jpg',
			'load_scene'  => isset( $option['load_scene'] ) ? $option['load_scene'] : 'ball-pulse',
			'context'     => isset( $option['context'] ) ? $option['context'] : esc_html__( 'Jegtheme', 'wvt' ),
			'context_url' => isset( $option['context_url'] ) ? $option['context_url'] : esc_url( 'http://jegtheme.com' ),
			'lang'        => [
				'save'     => esc_html__( 'Save Option', 'wvt' ),
				'saving'   => esc_html__( 'Saving Option', 'wvt' ),
				'saved'    => esc_html__( 'Saved', 'wvt' ),
				'spotlist' => esc_html__( 'Hotspot & Tour List', 'wvt' ),
			],
		);
		?>
        <script type="text/javascript">
            window.wvt_global = <?php echo wp_json_encode( $global ); ?>;
            window.wvtf = [];
        </script>
		<?php
	}

	/**
	 * Load Asset
	 */
	public function load_assets() {
		wp_enqueue_style( 'font-awesome', WVT_URL . '/assets/fonts/font-awesome/font-awesome.css', null, WVT_VERSION );
		wp_enqueue_style( 'pannellum', WVT_URL . '/assets/lib/pannellum/css/pannellum.css', null, WVT_VERSION );
		wp_enqueue_style( 'tooltipster', WVT_URL . '/assets/lib/tooltipster/css/tooltipster.bundle.min.css', null, WVT_VERSION );
		wp_enqueue_style( 'tooltipster-borderless', WVT_URL . '/assets/lib/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-borderless.min.css', null, WVT_VERSION );
		wp_enqueue_style( 'tooltipster-light', WVT_URL . '/assets/lib/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-light.min.css', null, WVT_VERSION );
		wp_enqueue_style( 'tooltipster-noir', WVT_URL . '/assets/lib/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-noir.min.css', null, WVT_VERSION );
		wp_enqueue_style( 'tooltipster-punk', WVT_URL . '/assets/lib/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-punk.min.css', null, WVT_VERSION );
		wp_enqueue_style( 'tooltipster-shadow', WVT_URL . '/assets/lib/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-shadow.min.css', null, WVT_VERSION );
		wp_enqueue_style( 'perfect-scrollbar', WVT_URL . '/assets/lib/perfect-scrollbar/perfect-scrollbar.css', null, '1.4.0' );
		wp_enqueue_style( 'magnific-popup', WVT_URL . '/assets/lib/magnific-popup/magnific-popup.css', null, WVT_VERSION );
		wp_enqueue_style( 'loader', WVT_URL . '/assets/lib/vendor/loaders.min.css', null, WVT_VERSION );
		wp_enqueue_style( 'wvt-frontend', WVT_URL . '/assets/css/wvt-frontend.css', null, WVT_VERSION );

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-draggable' );
		wp_enqueue_script( 'underscore' );
		wp_enqueue_script( 'wp-util' );
		wp_enqueue_script( 'tooltipster', WVT_URL . '/assets/lib/tooltipster/js/tooltipster.bundle.min.js', null, WVT_VERSION, true );
		wp_enqueue_script( 'magnific-popup', WVT_URL . '/assets/lib/magnific-popup/jquery.magnific-popup.min.js', null, '1.1.0', true );
		wp_enqueue_script( 'perfect-scrollbar', WVT_URL . '/assets/lib/perfect-scrollbar/perfect-scrollbar.min.js', null, '1.4.0', true );

		if ( SCRIPT_DEBUG ) {
			wp_enqueue_script( 'wvt-helper', WVT_URL . '/assets/js/wvt-helper.js', null, WVT_VERSION, true );
			wp_enqueue_script( 'wvt-frontend', WVT_URL . '/assets/js/wvt-frontend.js', null, WVT_VERSION, true );
        } else {
			wp_enqueue_script( 'wvt-frontend', WVT_URL . '/assets/js/wvt-frontend.min.js', null, WVT_VERSION, true );
        }

		wp_enqueue_script( 'raf', WVT_URL . '/assets/lib/pannellum/js/RequestAnimationFrame.js', null, WVT_VERSION, true );
		wp_enqueue_script( 'lib-pannellum', WVT_URL . '/assets/lib/pannellum/js/libpannellum.js', null, WVT_VERSION, true );
		wp_enqueue_script( 'pannellum', WVT_URL . '/assets/lib/pannellum/js/pannellum.js', null, WVT_VERSION, true );

		if ( function_exists( 'vc_is_page_editable' ) && vc_is_page_editable() ) {
			wp_enqueue_script( 'vc-page-iframe', WVT_URL . '/assets/js/integration/vc.page.iframe.js', null, WVT_VERSION, true );
		}
	}

	/**
	 * Add WVT shortcode
	 */
	public function prepare_shortcode() {
		add_shortcode( 'wvt', array( $this, 'generate_shortcode' ) );
	}

	/**
	 * Generate CSS
	 *
	 * @param string $item_id ID of item.
	 *
	 * @return string Generated CSS
	 */
	public function generate_css( $item_id, $data ) {
		$css    = '';
		$option = Helper::get_global_option();

		if ( ! empty( $option['load_image'] ) ) {
			$css .= "#{$item_id}.pnlm-container { background: url('" . $option['load_image'] . "'); }" . "\n";
		}

		$setting = $data['option'];

		foreach ( $setting['height'] as $key => $height ) {
			switch ( $key ) {
				case 'tablet':
					$deviceWidth = 768;
					break;
				case 'mobile':
					$deviceWidth = 600;
					break;
				default:
					$deviceWidth = 1200;
					break;
			}

			if ( 'desktop' === $key ) {
				$css .= "#{$item_id} { padding-bottom: {$height}%; }" . "\n";
			} else {
				$css .= "@media only screen and (max-width:{$deviceWidth}px) { 
					#{$item_id} { padding-bottom: {$height}%; } 
				}" . "\n";
			}
		}

		return $css;
	}

	/**
	 * Get Item ID
	 *
	 * @param array $id String ID.
	 *
	 * @return string ID of string
	 */
	public function get_id( $id ) {
		return 'wvt_' . $id . '_' . self::$sequence;
	}

	/**
	 * Generate shortcode for WVT
	 *
	 * @param array $attr Shortcode Attribute.
	 *
	 * @return String HTML string of shortcode.
	 *
	 * @throws \Exception Throw Exception.
	 */
	public function generate_shortcode( $attr ) {
		ob_start();
		try {
			if ( ! isset( $attr['pid'] ) ) {
				throw( new \Exception( esc_html__( 'No ID Available', 'wvt' ) ) );
			}

			$post = get_post( $attr['pid'] );

			if ( ! $post ) {
				throw( new \Exception( esc_html__( 'Panorama Not Available', 'wvt' ) ) );
			}

			if ( 'publish' !== $post->post_status ) {
				throw( new \Exception( esc_html__( 'This panorama is not published yet!', 'wvt' ) ) );
			}

			if ( 'single-panorama' !== $post->post_type ) {
				throw( new \Exception( esc_html__( 'Not an Panorama', 'wvt' ) ) );
			}

			$this->render_output( $post );
		} catch ( \Exception $e ) {
			// @todo Show Error
			jlog( $e->getMessage() );
		}

		return ob_get_clean();
	}

	/**
	 * Render Output
	 *
	 * @param $post
	 */
	public function render_output( $post ) {
		$id = $this->get_id( $post->ID );

		$options = [
			'post_id' => $post->ID,
			'option'  => Helper::get_panorama_option( $post->ID )
		];
		?>
        <div class="wvt-panorama-wrapper">
            <style id="<?php echo esc_html( $id ); ?>-panorama-css">
                <?php echo esc_html($this->generate_css($id, $options['option'])); ?>
                <?php echo isset( $options['option']['option']['css'] ) ? esc_html($options['option']['option']['css']) : ''; ?>
            </style>
            <div id="<?php echo esc_html( $id ); ?>" data-id="<?php echo esc_html( $post->ID ); ?>"
                 data-sequence="<?php echo esc_html( self::$sequence ); ?>" class="wvt-panorama">
                <div class="wvt-panorama-content"></div>
            </div>
            <script>
                window.wvtf['<?php echo esc_attr( $id ); ?>'] = <?php echo wp_json_encode( $options ); ?>;
            </script>
        </div>
		<?php

		// need to increase sequence
		self::$sequence ++;
	}
}
