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
 * Class Panorama_Map_Edit
 *
 * @package WVT
 */
class Panorama_Map_Edit extends Panorama_Edit_Abstract {

	/**
	 * Action Edit Panorama
	 *
	 * @var string
	 */
	public static $edit_nonce = 'edit-panorama-map';

	/**
	 * Edit Panorama
	 *
	 * @var string
	 */
	public static $action = 'wvt_edit_panorama_map';

	/**
	 * Panorama_Map_Edit constructor.
	 */
	public function __construct() {
		parent::__construct();

		add_action( 'init', array( $this, 'handle_edit_action' ) );
		add_action( 'wp_ajax_save_ajax_map', array( $this, 'handle_edit_action' ) );
		add_action( 'wvt_panorama_map_editor_footer', array( $this, 'render_html' ), 10 );
		add_action( 'wvt_panorama_map_editor_footer', array( Init::get_instance(), 'print_admin_footer' ), 99 );
	}

	/**
	 * Load all script
	 */
	public function enqueue_scripts() {
		parent::enqueue_scripts();

		wp_dequeue_script( 'wvt-admin' );

		wp_enqueue_script( 'wvt-admin-map',
			WVT_URL . '/assets/js/wvt-admin-map.js',
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
	}

	/**
	 * Check if WVT
	 *
	 * @return boolean
	 */
	public function check_is_wvt( $post_id ) {
		return get_post_type( $post_id ) === 'panorama-map';
	}

	/**
	 * Print Editor Template.
	 */
	public function render_panorama_editor() {
		include 'templates/panorama-map-editor.php';
	}

	/**
	 * Frontend Header Editor
	 */
	public function header_editor() {
		do_action( 'wvt_panorama_editor_header' );
	}

	/**
	 * Frontend Editor Footer
	 */
	public function footer_editor() {
		do_action( 'wvt_panorama_map_editor_footer' );
	}

	/**
	 * Handle Edit Action
	 */
	public function handle_edit_action() {
		if ( apply_filters( 'wvt_panorama_sandbox', false ) ) {
			return false;
		}

		if ( isset( $_POST['action'], $_POST['nonce'] ) && wp_verify_nonce( sanitize_key( $_POST['nonce'] ), self::$edit_nonce ) ) {
			$data              = wvt_sanitize_input_field( $_POST );
			$to_save           = array();
			$to_save['option'] = array();
			$action            = $data['action'];
			$post_id           = $this->post_id;

			if ( 'save_ajax_map' === $action ) {
				$post_id = $data['post_id'];
				$data    = $data['data'];
			}

			if ( self::$edit_nonce === $action || 'save_ajax_map' === $action ) {
				wp_update_post( array(
					'ID'         => $post_id,
					'post_title' => $data['option']['title'],
				) );

				$to_save['option'] = $data['option'];
				$to_save['pin']    = $data['pin'];

				update_post_meta( $post_id, Panorama_Map::$metabox, $to_save );
			}

			if ( 'save_ajax_map' === $action ) {
				wp_send_json_success();
			}
		}
	}

	/**
	 * Check if this panorama data is valid
	 *
	 * @todo: check post type, check if post meta available
	 *
	 * @return bool
	 */
	public function is_valid_panorama() {
		if ( $this->post_id ) {
			return true;
		}

		return false;
	}

	/**
	 * @return string Generated CSS
	 */
	public function generate_css() {
		$css     = '';
		$setting = Helper::get_panorama_map_option( $this->post_id );
		$option  = Helper::get_global_option();

		return $css;
	}

	/**
	 * Get Panorama List URL
	 *
	 * @return string
	 */
	public function get_panorama_list_url() {
		$page     = Init::get_instance()->get_admin_menu();
		$edit_url = add_query_arg( array(
			'page' => $page['wvt_map']['slug'],
		), admin_url( 'admin.php' ) );

		return $edit_url;
	}

	/**
	 * Render HTML for Editing Purpose
	 */
	public function render_html() {
		$edit_url = $this->get_panorama_list_url();

		if ( $this->is_valid_panorama() ) {
			?>
            <div class="wvt-edit">
                <div class="wvt-panel">
                    <div class="wvt-panel-content">
						<?php $this->edit_panorama(); ?>
                    </div>
                </div>
                <div class="wvt-preview">
                    <div class="wvt-toolbar">
                        <ul>
                            <li>&nbsp;</li>
                        </ul>
                        <div class="wvt-toolbar-right">
                            <a href="<?php echo esc_url( $edit_url ); ?>"
                               class="wvt-exit-button"><?php esc_html_e( 'Exit', 'wvt' ) ?></a>
                            <a href="#" class="wvt-save-button">
								<?php esc_html_e( 'Save Option', 'wvt' ) ?>
                            </a>
                        </div>
                    </div>
                    <style id="panorama-css">
                        <?php echo wvt_sanitize_output( $this->generate_css() ); ?>
                    </style>
                    <style id="additional-css">
                        <?php
							$setting = Helper::get_panorama_map_option($this->post_id);
							if ( isset( $setting['option']['css'] ) && $setting['option']['css'] ) {
								echo esc_html( $setting['option']['css'] );
							}
						?>
                    </style>
                    <div class="wvt-panorama-map-container">
                        <div class="wvt-panorama-map-wrapper">
                            <div class="wvt-panorama-map-image"></div>
                            <div class="wvt-panorama-map-pin">

                            </div>
                            <div class="wvt-panorama-tooltips">
                                <div class="wvt-tooltips-location">
                                    <div class="top">
                                        <span><?php esc_html_e( 'Top', 'wvt' ); ?></span>
                                        <strong>0%</strong>
                                    </div>
                                    <div class="left">
                                        <span><?php esc_html_e( 'Left', 'wvt' ); ?></span>
                                        <strong>0%</strong>
                                    </div>
                                </div>
                                <div class="wvt-tooltips-text">
									<?php esc_html_e( 'Click to add Map Pin', 'wvt' ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php
			$this->print_edit_template();
		}
	}

	/**
	 * Edit Panorama
	 */
	public function edit_panorama() {
		?>
        <div id="wvt-option-wrapper">
            <i class="fa fa-circle-o-notch fa-spin"></i>
            <div class="wvt-option-wrapper">
                <ul class="wvt-option-header"></ul>
                <form method="post" class="wvt-edit-panorama-form">
                    <div class="wvt-option-body"></div>
                    <input type="hidden" name="action" value="<?php echo esc_attr( self::$edit_nonce ); ?>"/>
                    <input type="hidden" name="nonce"
                           value="<?php echo esc_html( wp_create_nonce( self::$edit_nonce ) ); ?>">
                </form>
            </div>
        </div>
        <script type="text/javascript">
            (function ($) {
                $(document).ready(function () {
                    window.wvt_option = <?php echo wp_json_encode( Helper::get_panorama_map_option( $this->post_id ) ) ?>;
                    window.wvt_global = <?php echo wp_json_encode( $this->get_global_option() ); ?>;
                    window.wvt_edit = wvt.edit.build('wvt-option-wrapper', window.wvt_global, window.wvt_option)
                })
            })(jQuery)
        </script>
		<?php
	}

	/**
	 * Print panorama edit template
	 */
	public function print_edit_template() {
		?>
        <script id="tmpl-wvt-container-tabbed" type="text/html">
            <li class="tab-list" data-id="{{ data.id }}">{{{ data.title }}}</li>
        </script>
        <script id="tmpl-wvt-container-body" type="text/html">
            <div class="wvt-option-content" data-tab="{{ data.id }}">
                <div class="wvt-edit-panorama-wrapper">
                    <h2>{{{ data.title }}}</h2>
                </div>
                <div class="wvt-edit-panorama"></div>
                <div class="wvt-edit-panorama-button">
                    <input type="submit" value="<?php esc_html_e( 'Save Option', 'wvt' ); ?>"/>
                </div>
            </div>
        </script>
        <script id="tmpl-wvt-container-section-content" type="text/html">
            <div class="wvt-section-item">
                <div class="wvt-section-header" data-id="{{ data.id }}">
                    {{{ data.name }}} <span class="tab-delete dashicons dashicons-trash"></span>
                </div>
                <div class="wvt-section-content" data-id="{{ data.id }}"></div>
            </div>
        </script>
        <script id="tmpl-wvt-section-empty" type="text/html">
            <div class="wvt-section-empty" data-id="{{ data.id }}">
                <# if ( 'pin' === data.id ) { #>
                <h3><?php esc_html_e( 'Empty Pin', 'wvt' ); ?></h3>
                <span>
		        		<?php echo esc_html__( 'You can add map pin by hovering and click inside panorama map', 'wvt' ); ?>
		        	</span>
                <# } #>
            </div>
        </script>
        <script id="tmpl-wvt-flag-spot" type="text/html">
            <div class="wvt-flag-spot">
                <i class="fa fa-map-pin"></i>
                <i class="fa fa-map-marker"></i>
                <span class="hotspot"><?php esc_html_e( 'The hotspot will shown here.', 'wvt' ); ?></span>
                <span class="tour"><?php esc_html_e( 'The tour will shown here.', 'wvt' ); ?></span>
            </div>
            <div class="wvt-flag-toolbar">
                <span class="hotspot"><?php esc_html_e( 'Drag the panorama view to define the position of hotspot box.', 'wvt' ); ?></span>
                <span class="tour"><?php esc_html_e( 'Drag the panorama view to define the position of tour box.', 'wvt' ); ?></span>
                <a href="#" class="btn-new-tour"><?php esc_html_e( 'Add New', 'wvt' ); ?></a>
                <a href="#" class="btn-new-hotspot"><?php esc_html_e( 'Add New', 'wvt' ); ?></a>
            </div>
        </script>
		<?php
	}

	/**
	 * Get Global Option
	 */
	public function get_global_option() {
		// Option
		$option = array();
		foreach ( $this->get_option_fields() as $key => $field ) {
			$option[ $key ] = wvt_prepare_field( $key, $field );
		}

		// Hotspot
		$pin = array();
		foreach ( $this->get_pin_fields() as $key => $field ) {
			$pin[ $key ] = wvt_prepare_field( $key, $field );
		}

		return array(
			'id'          => $this->post_id,
			'nonce'       => wp_create_nonce( self::$edit_nonce ),
			'ajax'        => admin_url( 'admin-ajax.php' ),
			'action'      => self::$edit_nonce,
			'wvt_url'     => WVT_URL,
			'placeholder' => WVT_URL . '/assets/img/placeholder.jpg',
			'global'      => Helper::get_global_option(),
			'tab'         => array(
				array(
					'id'      => 'option',
					'type'    => 'single',
					'active'  => true,
					'title'   => esc_html__( 'Map', 'wvt' ),
					'options' => $option,
					'default' => Helper::get_panorama_option_default_setting()
				),
				array(
					'id'      => 'pin',
					'type'    => 'multi',
					'active'  => false,
					'title'   => esc_html__( 'Pin', 'wvt' ),
					'options' => $pin,
					'default' => Helper::get_pin_default_setting()
				),
			),
			'lang'        => array(
				'save'            => esc_html__( 'Save Option', 'wvt' ),
				'saving'          => esc_html__( 'Saving Option', 'wvt' ),
				'saved'           => esc_html__( 'Saved', 'wvt' ),
				'clicktocollapse' => esc_html__( 'Click to Open Section', 'wvt' ),
			)
		);
	}

	/**
	 * Get field for single hotspot fields
	 *
	 * @return array
	 */
	public function get_pin_fields() {
		$fields = array();

		$fields['key'] = array(
			'type'        => 'text',
			'disabled'    => true,
			'title'       => esc_html__( 'Pin Key', 'wvt' ),
			'description' => esc_html__( 'Pin key that you can use for css purpose.', 'wvt' ),
		);

		$fields['top'] = array(
			'type'     => 'text',
			'disabled' => true,
			'title'    => esc_html__( 'Pin Top', 'wvt' ),
		);

		$fields['left'] = array(
			'type'     => 'text',
			'disabled' => true,
			'title'    => esc_html__( 'Pin Left', 'wvt' ),
		);

		$fields['color'] = array(
			'type'  => 'color',
			'title' => esc_html__( 'Pin Color', 'wvt' ),
		);

		$fields['size'] = array(
			'type'        => 'slider',
			'title'       => esc_html__( 'Pin Size', 'wvt' ),
			'description' => esc_html__( 'Set pin size, bigger pin indicates that they need more attention.', 'wvt' ),
			'options'     => array(
				'min'  => 1,
				'max'  => 30,
				'step' => 1,
			),
		);

		$fields['panorama'] = array(
			'type'        => 'select',
			'title'       => esc_html__( 'Select Panorama', 'wvt' ),
			'description' => esc_html__( 'Select the single panorama that you want to use.', 'wvt' ),
			'options'     => Helper::get_post_list( 'single-panorama' ),
		);

		return $fields;
	}

	/**
	 * Get field for single panorama edit
	 *
	 * @return array
	 */
	public function get_option_fields() {
		$fields = array();

		$fields['title'] = array(
			'type'        => 'text',
			'title'       => esc_html__( 'Name Your Map', 'wvt' ),
			'description' => esc_html__( 'Provide name for your panorama map.', 'wvt' ),
		);

		$fields['map'] = array(
			'type'        => 'image',
			'title'       => esc_html__( 'Map Image', 'wvt' ),
			'description' => wp_kses( sprintf(
			/* translators: 1: URL of Documentation for How to generate Equirectangular Image */
				__( 'Upload your panorama map. <a href="%s" target="_blank">Find out how to panorama map work.</a>', 'wvt' ),
				'https://support.jegtheme.com/documentation/create-panorama-map/'
			), wp_kses_allowed_html() ),
		);

		return $fields;
	}
}
