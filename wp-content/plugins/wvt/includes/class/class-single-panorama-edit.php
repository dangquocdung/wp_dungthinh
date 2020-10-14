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
 * Class Single_Panorama_Edit
 *
 * @package WVT
 */
class Single_Panorama_Edit extends Panorama_Edit_Abstract {

	/**
	 * Action Edit Panorama
	 *
	 * @var string
	 */
	public static $edit_nonce = 'edit-panorama';

	/**
	 * Edit Panorama
	 *
	 * @var string
	 */
	public static $action = 'wvt_edit_panorama';

	/**
	 * Single_Panorama_Edit constructor.
	 */
	public function __construct() {
		parent::__construct();

		add_action( 'init', array( $this, 'handle_edit_action' ) );
		add_action( 'wp_ajax_save_data', array( $this, 'handle_edit_action' ) );
		add_action( 'wvt_panorama_editor_footer', array( $this, 'render_html' ), 10 );
		add_action( 'wvt_panorama_editor_footer', array( Init::get_instance(), 'print_admin_footer' ), 99 );
	}

	/**
	 * Check if WVT
	 *
	 * @return boolean
	 */
	public function check_is_wvt( $post_id ) {
		return get_post_type( $post_id ) === 'single-panorama';
	}

	/**
	 * Print Editor Template.
	 */
	public function render_panorama_editor() {
		include 'templates/panorama-editor.php';
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
		do_action( 'wvt_panorama_editor_footer' );
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

			if ( 'save_ajax' === $action ) {
				$post_id = $data['post_id'];
				$data    = $data['data'];
			}

			if ( self::$edit_nonce === $action || 'save_ajax' === $action ) {
				wp_update_post( array(
					'ID'         => $post_id,
					'post_title' => $data['option']['title'],
				) );

				$to_save['option']  = $data['option'];
				$to_save['hotspot'] = $data['hotspot'];
				$to_save['tour']    = $data['tour'];

				update_post_meta( $post_id, Single_Panorama::$metabox, $to_save );
			}

			if ( 'save_ajax' === $action ) {
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
	 *
	 *
	 * @return string Generated CSS
	 */
	public function generate_css() {
		$css     = '';
		$setting = Helper::get_panorama_option( $this->post_id );

		foreach ( $setting['option']['height'] as $device => $size ) {
			$css .= ".wvt-panorama-container[data-device='" . $device . "'] .panorama { height: " . $size . 'px; }' . "\n";
		}

		$option = Helper::get_global_option();

		if ( ! empty( $option['load_image'] ) ) {
			$css .= ".pnlm-container { background: url('" . $option['load_image'] . "'); }" . "\n";
		}

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
			'page' => $page['wvt_single']['slug'],
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
                            <li class="create-hotspot tooltip" title="<?php esc_html_e( 'Create Hotspot', 'wvt' ); ?>">
                                <i class="fa fa-map-pin"></i>
                            </li>
                            <li class="create-tour tooltip" title="<?php esc_html_e( 'Create Tour', 'wvt' ); ?>">
                                <i class="fa fa-map-marker"></i>
                            </li>
                            <li class="set-center tooltip"
                                title="<?php esc_html_e( 'Set Initial Coordinate', 'wvt' ); ?>">
                                <i class="fa fa-crosshairs"></i>
                            </li>
                            <li class="set-north tooltip" title="<?php esc_html_e( 'Set Panorama North', 'wvt' ); ?>">
                                <i class="fa fa-compass"></i>
                            </li>
                            <li class="choose-media tooltip" title="<?php esc_html_e( 'Device Mode', 'wvt' ); ?>">
                                <i class="fa fa-desktop"></i>
                                <div class="wvt-media-chooser">
                                    <ul>
                                        <li data-device="desktop">
                                            <i class="fa fa-desktop"></i> <?php esc_html_e( 'Desktop', 'wvt' ); ?>
                                        </li>
                                        <li data-device="tablet">
                                            <i class="fa fa-tablet"></i> <?php esc_html_e( 'Tablet', 'wvt' ); ?>
                                        </li>
                                        <li data-device="mobile">
                                            <i class="fa fa-mobile"></i> <?php esc_html_e( 'Phone', 'wvt' ); ?>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <div class="wvt-toolbar-right">
                            <a href="<?php echo esc_url( $edit_url ); ?>"
                               class="wvt-exit-button"><?php esc_html_e( 'Exit', 'wvt' ) ?></a>
                            <a href="#" class="wvt-save-button">
								<?php esc_html_e( 'Save Option', 'wvt' ) ?>
                            </a>
                            <div class="wvt-shortcode-copy">
                                <input type="text" readonly value="[wvt pid=<?php echo esc_html( $this->post_id ) ?>]">
                                <div class="wvt-shortcode-copied">
									<?php esc_html_e( 'Copied', 'wvt' ) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <style id="panorama-css">
                        <?php echo wvt_sanitize_output( $this->generate_css() ); ?>
                    </style>
                    <style id="additional-css">
                        <?php
							$setting = Helper::get_panorama_option($this->post_id);
							if ( isset( $setting['option']['css'] ) ) {
								echo esc_html($setting['option']['css']);
							}
						?>
                    </style>
                    <div class="wvt-panorama-container" data-device="desktop">
                        <div id="panorama" class="panorama"></div>
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
                    window.wvt_option = <?php echo wp_json_encode( Helper::get_panorama_option( $this->post_id ) ) ?>;
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
                <# if ( 'hotspot' === data.id ) { #>
                <h3><?php esc_html_e( 'Empty Hotspot', 'wvt' ); ?></h3>
                <span>
		        		<?php echo sprintf( esc_html__( 'You can add hotspot by clicking %s icon on the toolbar above.', 'wvt' ), '<i class="fa fa-map-pin"></i>' ); ?>
		        	</span>
                <# } #>

                <# if ( 'tour' === data.id ) { #>
                <h3><?php esc_html_e( 'Empty Tour', 'wvt' ); ?></h3>
                <span>
		        		<?php echo sprintf( esc_html__( 'You can add new tour by clicking %s icon on the toolbar above.', 'wvt' ), '<i class="fa fa-map-marker"></i>' ); ?>
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
		$hotspot = array();
		foreach ( $this->get_hotspot_fields() as $key => $field ) {
			$hotspot[ $key ] = wvt_prepare_field( $key, $field );
		}

		// Tour Spot
		$tour = array();
		foreach ( $this->get_tour_fields() as $key => $field ) {
			$tour[ $key ] = wvt_prepare_field( $key, $field );
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
					'title'   => esc_html__( 'Panorama', 'wvt' ),
					'options' => $option,
					'default' => Helper::get_option_default_setting()
				),
				array(
					'id'      => 'hotspot',
					'type'    => 'multi',
					'active'  => false,
					'title'   => esc_html__( 'Hotspot', 'wvt' ),
					'options' => $hotspot,
					'default' => Helper::get_hotspot_default_setting()
				),
				array(
					'id'      => 'tour',
					'type'    => 'multi',
					'active'  => false,
					'title'   => esc_html__( 'Tour', 'wvt' ),
					'options' => $tour,
					'default' => Helper::get_tour_default_setting()
				)
			),
			'lang'        => array(
				'save'            => esc_html__( 'Save Option', 'wvt' ),
				'saving'          => esc_html__( 'Saving Option', 'wvt' ),
				'saved'           => esc_html__( 'Saved', 'wvt' ),
				'spotlist'        => esc_html__( 'Hotspot & Tour List', 'wvt' ),
				'clicktocollapse' => esc_html__( 'Click event works on frontend only', 'wvt' )
			)
		);
	}

	/**
	 * Get field for single hotspot fields
	 *
	 * @return array
	 */
	public function get_hotspot_fields() {
		$fields = array();

		$fields['key'] = array(
			'type'        => 'text',
			'disabled'    => true,
			'title'       => esc_html__( 'Hotspot Key', 'wvt' ),
			'description' => esc_html__( 'Hotspot key that you can use for css purpose.', 'wvt' ),
		);

		$fields['title'] = array(
			'type'        => 'text',
			'title'       => esc_html__( 'Hotspot Title', 'wvt' ),
			'description' => esc_html__( 'Insert text for hotspot title.', 'wvt' ),
		);

		$fields['shape'] = array(
			'type'        => 'select',
			'title'       => esc_html__( 'Hotspot Shape', 'wvt' ),
			'description' => esc_html__( 'Choose hotspot shape.', 'wvt' ),
			'options'     => array(
				'circle'  => esc_html__( 'Circle', 'wvt' ),
				'square'  => esc_html__( 'Square', 'wvt' ),
				'rounded' => esc_html__( 'Rounded', 'wvt' ),
				'badge'   => esc_html__( 'Badge', 'wvt' ),
			),
		);

		$fields['badge'] = array(
			'type'        => 'radioimage',
			'title'       => esc_html__( 'Hotspot Badge', 'wvt' ),
			'description' => esc_html__( 'Badge for this hotspot.', 'wvt' ),
			'options'     => array(
				'1'  => WVT_URL . '/assets/img/badge/wvt-badge-1.png',
				'2'  => WVT_URL . '/assets/img/badge/wvt-badge-2.png',
				'3'  => WVT_URL . '/assets/img/badge/wvt-badge-3.png',
				'4'  => WVT_URL . '/assets/img/badge/wvt-badge-4.png',
				'5'  => WVT_URL . '/assets/img/badge/wvt-badge-5.png',
				'6'  => WVT_URL . '/assets/img/badge/wvt-badge-6.png',
				'7'  => WVT_URL . '/assets/img/badge/wvt-badge-7.png',
				'8'  => WVT_URL . '/assets/img/badge/wvt-badge-8.png',
				'9'  => WVT_URL . '/assets/img/badge/wvt-badge-9.png',
				'10' => WVT_URL . '/assets/img/badge/wvt-badge-10.png',
			),
			'dependency'  => array(
				array(
					'field'    => 'shape',
					'operator' => '===',
					'value'    => 'badge',
				),
			),
		);

		$fields['bgcolor'] = array(
			'type'        => 'color',
			'title'       => esc_html__( 'Hotspot Background Color', 'wvt' ),
			'description' => esc_html__( 'Choose background color for hotspot.', 'wvt' ),
			'dependency'  => array(
				array(
					'field'    => 'shape',
					'operator' => '!=',
					'value'    => 'badge',
				),
			),
		);

		$fields['width'] = array(
			'type'        => 'slider',
			'title'       => esc_html__( 'Hotspot Shape Width', 'wvt' ),
			'description' => esc_html__( 'Set shape size, bigger hotspot indicate that they need more attention.', 'wvt' ),
			'options'     => array(
				'min'  => 5,
				'max'  => 100,
				'step' => 1,
			),
		);

		$fields['icontype'] = array(
			'type'        => 'select',
			'title'       => esc_html__( 'Icon Type', 'wvt' ),
			'description' => esc_html__( 'Choose which icon type you want to use.', 'wvt' ),
			'options'     => array(
				'icon'  => esc_html__( 'Font Icon', 'wvt' ),
				'image' => esc_html__( 'Image', 'wvt' ),
			),
			'dependency'  => array(
				array(
					'field'    => 'shape',
					'operator' => '!=',
					'value'    => 'badge',
				),
			),
		);

		$fields['icon'] = array(
			'type'        => 'iconpicker',
			'title'       => esc_html__( 'Hotspot Icon', 'wvt' ),
			'description' => esc_html__( 'Icon for this hotspot.', 'wvt' ),
			'dependency'  => array(
				array(
					'field'    => 'icontype',
					'operator' => '===',
					'value'    => 'icon',
				),
				array(
					'field'    => 'shape',
					'operator' => '!=',
					'value'    => 'badge',
				),
			),
		);

		$fields['iconcolor'] = array(
			'type'        => 'color',
			'title'       => esc_html__( 'Hotspot Icon Color', 'wvt' ),
			'description' => esc_html__( 'Color for this hotspot icon.', 'wvt' ),
			'dependency'  => array(
				array(
					'field'    => 'icontype',
					'operator' => '===',
					'value'    => 'icon',
				),
				array(
					'field'    => 'shape',
					'operator' => '!=',
					'value'    => 'badge',
				),
			),
		);

		$fields['iconsize'] = array(
			'type'        => 'slider',
			'title'       => esc_html__( 'Icon Font size', 'wvt' ),
			'description' => esc_html__( 'Set hotspot size, bigger hotspot indicate that they need more attention.', 'wvt' ),
			'options'     => array(
				'min'  => 5,
				'max'  => 100,
				'step' => 1,
			),
			'dependency'  => array(
				array(
					'field'    => 'icontype',
					'operator' => '===',
					'value'    => 'icon',
				),
				array(
					'field'    => 'shape',
					'operator' => '!=',
					'value'    => 'badge',
				),
			),
		);

		$fields['iconimage'] = array(
			'type'        => 'image',
			'title'       => esc_html__( 'Image Icon', 'wvt' ),
			'description' => esc_html__( 'Upload your image icon.', 'wvt' ),
			'dependency'  => array(
				array(
					'field'    => 'icontype',
					'operator' => '==',
					'value'    => 'image',
				),
				array(
					'field'    => 'shape',
					'operator' => '!=',
					'value'    => 'badge',
				),
			),
		);

		$fields['coordinate'] = array(
			'type'        => 'coordinate',
			'title'       => esc_html__( 'Hotspot Coordinate', 'wvt' ),
			'description' => esc_html__( 'Set the coordinate for this hotspot.', 'wvt' )
		);

		$fields['hoverinfo'] = array(
			'type'        => 'alert',
			'title'       => esc_html__( 'Hover Behaviour', 'wvt' ),
			'description' => esc_html__( 'Any option to control hover behaviour.', 'wvt' ),
			'default'     => 'info'
		);

		$fields['hover'] = array(
			'type'        => 'select',
			'title'       => esc_html__( 'Hover Behaviour', 'wvt' ),
			'description' => esc_html__( 'Choose how hotspot behavior when hovered.', 'wvt' ),
			'options'     => array(
				'none'  => esc_html__( 'None', 'wvt' ),
				'short' => esc_html__( 'Short Tooltips', 'wvt' ),
				'long'  => esc_html__( 'Long Text Tooltips', 'wvt' ),
				'post'  => esc_html__( 'Post Content', 'wvt' ),
				'woo'   => esc_html__( 'WooCommerce Product', 'wvt' ),
			),
		);

		$fields['woo'] = array(
			'type'        => 'select',
			'title'       => esc_html__( 'Select Product', 'wvt' ),
			'description' => esc_html__( 'Select the WooCommerce product that you want to show.', 'wvt' ),
			'options'     => Helper::get_post_list( 'product' ),
			'dependency'  => array(
				array(
					'field'    => 'hover',
					'operator' => '==',
					'value'    => 'woo',
				),
			),
		);

		$fields['wooatc'] = array(
			'type'        => 'checkbox',
			'title'       => esc_html__( 'Enable Add To Cart', 'wvt' ),
			'description' => esc_html__( 'Check this option to show add to cart button on the product.', 'wvt' ),
			'dependency'  => array(
				array(
					'field'    => 'hover',
					'operator' => '==',
					'value'    => 'woo',
				),
			),
		);

		$fields['post'] = array(
			'type'        => 'select',
			'title'       => esc_html__( 'Select Post', 'wvt' ),
			'description' => esc_html__( 'Select the post that you want to show.', 'wvt' ),
			'options'     => Helper::get_post_list( 'post' ),
			'dependency'  => array(
				array(
					'field'    => 'hover',
					'operator' => '==',
					'value'    => 'post',
				),
			),
		);

		$fields['hovertheme'] = array(
			'type'        => 'select',
			'title'       => esc_html__( 'Hover Theme', 'wvt' ),
			'description' => esc_html__( 'Choose hover theme to be used.', 'wvt' ),
			'options'     => array(
				'default'    => esc_html__( 'Default', 'wvt' ),
				'borderless' => esc_html__( 'Borderless', 'wvt' ),
				'light'      => esc_html__( 'Light', 'wvt' ),
				'noir'       => esc_html__( 'Noir', 'wvt' ),
				'punk'       => esc_html__( 'Punk', 'wvt' ),
				'shadow'     => esc_html__( 'Shadow', 'wvt' ),
			),
			'dependency'  => array(
				array(
					'field'    => 'hover',
					'operator' => '!=',
					'value'    => 'none'
				),
			),
		);

		$fields['hoverminwidth'] = array(
			'type'        => 'slider',
			'title'       => esc_html__( 'Hover balloon min-width', 'wvt' ),
			'description' => esc_html__( 'Define the minimum width for the balloon.', 'wvt' ),
			'options'     => array(
				'min'  => 50,
				'max'  => 500,
				'step' => 1,
			),
			'dependency'  => array(
				array(
					'field'    => 'hover',
					'operator' => 'in',
					'value'    => array( 'short', 'long' ),
				),
			),
		);

		$fields['hovermaxwidth'] = array(
			'type'        => 'slider',
			'title'       => esc_html__( 'Hover balloon max-width', 'wvt' ),
			'description' => esc_html__( 'Define the maximum width for the balloon.', 'wvt' ),
			'options'     => array(
				'min'  => 50,
				'max'  => 600,
				'step' => 1,
			),
			'dependency'  => array(
				array(
					'field'    => 'hover',
					'operator' => 'in',
					'value'    => array( 'short', 'long' ),
				),
			),
		);

		$fields['hovertext'] = array(
			'type'        => 'text',
			'title'       => esc_html__( 'Tooltip Text', 'wvt' ),
			'description' => esc_html__( 'Insert text that shown on the tooltip when hotspot hovered.', 'wvt' ),
			'dependency'  => array(
				array(
					'field'    => 'hover',
					'operator' => '==',
					'value'    => 'short',
				),
			),
		);

		$fields['hoverposition'] = array(
			'type'        => 'select',
			'title'       => esc_html__( 'Tooltip Position', 'wvt' ),
			'description' => esc_html__( 'Position of tooltips.', 'wvt' ),
			'options'     => array(
				'auto'   => esc_html__( 'Auto', 'wvt' ),
				'top'    => esc_html__( 'Top', 'wvt' ),
				'right'  => esc_html__( 'Right', 'wvt' ),
				'bottom' => esc_html__( 'Bottom', 'wvt' ),
				'left'   => esc_html__( 'Left', 'wvt' ),
			),
			'dependency'  => array(
				array(
					'field'    => 'hover',
					'operator' => '==',
					'value'    => 'short',
				),
			),
		);

		$fields['hoverlongposition'] = array(
			'type'        => 'select',
			'title'       => esc_html__( 'Tooltip Position', 'wvt' ),
			'description' => esc_html__( 'Adjust the preferred position of tooltips.', 'wvt' ),
			'options'     => array(
				'top'    => esc_html__( 'Top', 'wvt' ),
				'right'  => esc_html__( 'Right', 'wvt' ),
				'bottom' => esc_html__( 'Bottom', 'wvt' ),
				'left'   => esc_html__( 'Left', 'wvt' ),
			),
			'dependency'  => array(
				array(
					'field'    => 'hover',
					'operator' => '==',
					'value'    => 'long',
				),
			),
			'multiple'    => true,
			'delete'      => false
		);

		$fields['hovercontent'] = array(
			'type'        => 'texteditor',
			'title'       => esc_html__( 'Tooltip Content', 'wvt' ),
			'description' => esc_html__( 'Tooltips content.', 'wvt' ),
			'dependency'  => array(
				array(
					'field'    => 'hover',
					'operator' => '==',
					'value'    => 'long',
				),
			),
		);

		$fields['clickinfo'] = array(
			'type'        => 'alert',
			'title'       => esc_html__( 'Click Behaviour', 'wvt' ),
			'description' => esc_html__( 'Any option to control click behaviour.', 'wvt' ),
			'default'     => 'info'
		);

		$fields['click'] = array(
			'type'        => 'select',
			'title'       => esc_html__( 'Click Behaviour', 'wvt' ),
			'description' => esc_html__( 'Choose how behavior reacts when hotspot clicked.', 'wvt' ),
			'options'     => array(
				'none'    => esc_html__( 'None', 'wvt' ),
				'url'     => esc_html__( 'Open new page', 'wvt' ),
				'video'   => esc_html__( 'Video Popup', 'wvt' ),
				'gallery' => esc_html__( 'Gallery Popup', 'wvt' ),
			),
		);

		$fields['url'] = array(
			'type'        => 'text',
			'title'       => esc_html__( 'Hotspot URL', 'wvt' ),
			'description' => esc_html__( 'Insert url for the hotspot.', 'wvt' ),
			'dependency'  => array(
				array(
					'field'    => 'click',
					'operator' => '==',
					'value'    => 'url',
				),
			),
		);

		$fields['video'] = array(
			'type'        => 'text',
			'title'       => esc_html__( 'Hotspot Video', 'wvt' ),
			'description' => esc_html__( 'Insert youtube or vimeo video.', 'wvt' ),
			'dependency'  => array(
				array(
					'field'    => 'click',
					'operator' => '==',
					'value'    => 'video',
				),
			),
		);

		$fields['gallery'] = array(
			'type'        => 'repeater',
			'title'       => esc_html__( 'Hotspot Gallery', 'wvt' ),
			'description' => esc_html__( 'Show gallery when icon clicked.', 'wvt' ),
			'choices'     => array(
				'limit' => 999
			),
			'default'     => array(
				array(
					'src'  => '',
					'text' => ''
				)
			),
			'row_label'   => array(
				'type'  => 'text',
				'value' => esc_attr__( 'Image', 'wvt' ),
				'field' => false,
			),
			'fields'      => array(
				'src'   => array(
					'type'        => 'image',
					'label'       => esc_attr__( 'Image', 'wvt' ),
					'description' => esc_attr__( 'Insert your image.', 'wvt' ),
					'id'          => 'src',
				),
				'title' => array(
					'type'        => 'text',
					'label'       => esc_attr__( 'Image Title', 'wvt' ),
					'description' => esc_attr__( 'Insert your image title.', 'wvt' ),
					'id'          => 'title',
				),
			),
			'dependency'  => array(
				array(
					'field'    => 'click',
					'operator' => '==',
					'value'    => 'gallery',
				),
			),
		);

		return $fields;
	}

	/**
	 * Get field for single tour spot fields
	 *
	 * @return array
	 */
	public function get_tour_fields() {
		$fields = array();

		$fields['key'] = array(
			'type'        => 'text',
			'disabled'    => true,
			'title'       => esc_html__( 'Tour Key', 'wvt' ),
			'description' => esc_html__( 'tour key that you can use for css purpose.', 'wvt' ),
		);

		$fields['title'] = array(
			'type'        => 'text',
			'title'       => esc_html__( 'Tour Title', 'wvt' ),
			'description' => esc_html__( 'Insert text for tour title.', 'wvt' ),
		);

		$fields['spot'] = array(
			'type'        => 'select',
			'title'       => esc_html__( 'Select Tour', 'wvt' ),
			'description' => esc_html__( 'Select the single panorama as tour spot.', 'wvt' ),
			'options'     => Helper::get_post_list( 'single-panorama' ),
		);

		$fields['shape'] = array(
			'type'        => 'select',
			'title'       => esc_html__( 'Tour Shape', 'wvt' ),
			'description' => esc_html__( 'Choose the tour shape.', 'wvt' ),
			'options'     => array(
				'circle'  => esc_html__( 'Circle', 'wvt' ),
				'square'  => esc_html__( 'Square', 'wvt' ),
				'rounded' => esc_html__( 'Rounded', 'wvt' ),
				'badge'   => esc_html__( 'Badge', 'wvt' ),
			),
		);

		$fields['badge'] = array(
			'type'        => 'radioimage',
			'title'       => esc_html__( 'Tour Badge', 'wvt' ),
			'description' => esc_html__( 'Badge for this tour.', 'wvt' ),
			'options'     => array(
				'1'  => WVT_URL . '/assets/img/badge/wvt-badge-1.png',
				'2'  => WVT_URL . '/assets/img/badge/wvt-badge-2.png',
				'3'  => WVT_URL . '/assets/img/badge/wvt-badge-3.png',
				'4'  => WVT_URL . '/assets/img/badge/wvt-badge-4.png',
				'5'  => WVT_URL . '/assets/img/badge/wvt-badge-5.png',
				'6'  => WVT_URL . '/assets/img/badge/wvt-badge-6.png',
				'7'  => WVT_URL . '/assets/img/badge/wvt-badge-7.png',
				'8'  => WVT_URL . '/assets/img/badge/wvt-badge-8.png',
				'9'  => WVT_URL . '/assets/img/badge/wvt-badge-9.png',
				'10' => WVT_URL . '/assets/img/badge/wvt-badge-10.png',
			),
			'dependency'  => array(
				array(
					'field'    => 'shape',
					'operator' => '===',
					'value'    => 'badge',
				),
			),
		);

		$fields['bgcolor'] = array(
			'type'        => 'color',
			'title'       => esc_html__( 'Tour Background Color', 'wvt' ),
			'description' => esc_html__( 'Choose background color for tour.', 'wvt' ),
			'dependency'  => array(
				array(
					'field'    => 'shape',
					'operator' => '!=',
					'value'    => 'badge',
				),
			),
		);

		$fields['width'] = array(
			'type'        => 'slider',
			'title'       => esc_html__( 'Tour Shape Width', 'wvt' ),
			'description' => esc_html__( 'Set shape size, bigger tour indicate that they need more attention.', 'wvt' ),
			'options'     => array(
				'min'  => 5,
				'max'  => 100,
				'step' => 1,
			),
		);

		$fields['icontype'] = array(
			'type'        => 'select',
			'title'       => esc_html__( 'Icon Type', 'wvt' ),
			'description' => esc_html__( 'Choose which icon type you want to use.', 'wvt' ),
			'options'     => array(
				'icon'  => esc_html__( 'Font Icon', 'wvt' ),
				'image' => esc_html__( 'Image', 'wvt' ),
			),
			'dependency'  => array(
				array(
					'field'    => 'shape',
					'operator' => '!=',
					'value'    => 'badge',
				),
			),
		);

		$fields['icon'] = array(
			'type'        => 'iconpicker',
			'title'       => esc_html__( 'Tour Icon', 'wvt' ),
			'description' => esc_html__( 'Icon for this tour.', 'wvt' ),
			'dependency'  => array(
				array(
					'field'    => 'icontype',
					'operator' => '===',
					'value'    => 'icon',
				),
				array(
					'field'    => 'shape',
					'operator' => '!=',
					'value'    => 'badge',
				),
			),
		);

		$fields['iconcolor'] = array(
			'type'        => 'color',
			'title'       => esc_html__( 'Tour Icon Color', 'wvt' ),
			'description' => esc_html__( 'Color for this tour icon.', 'wvt' ),
			'dependency'  => array(
				array(
					'field'    => 'icontype',
					'operator' => '===',
					'value'    => 'icon',
				),
				array(
					'field'    => 'shape',
					'operator' => '!=',
					'value'    => 'badge',
				),
			),
		);

		$fields['iconsize'] = array(
			'type'        => 'slider',
			'title'       => esc_html__( 'Icon Font Size', 'wvt' ),
			'description' => esc_html__( 'Set tour size, bigger tour indicate that they need more attention.', 'wvt' ),
			'options'     => array(
				'min'  => 5,
				'max'  => 100,
				'step' => 1,
			),
			'dependency'  => array(
				array(
					'field'    => 'icontype',
					'operator' => '===',
					'value'    => 'icon',
				),
				array(
					'field'    => 'shape',
					'operator' => '!=',
					'value'    => 'badge',
				),
			),
		);

		$fields['iconimage'] = array(
			'type'        => 'image',
			'title'       => esc_html__( 'Image Icon', 'wvt' ),
			'description' => esc_html__( 'Upload your image icon.', 'wvt' ),
			'dependency'  => array(
				array(
					'field'    => 'icontype',
					'operator' => '==',
					'value'    => 'image',
				),
				array(
					'field'    => 'shape',
					'operator' => '!=',
					'value'    => 'badge',
				),
			),
		);

		$fields['coordinate'] = array(
			'type'        => 'coordinate',
			'title'       => esc_html__( 'Tour Coordinate', 'wvt' ),
			'description' => esc_html__( 'Set the coordinate for this tour.', 'wvt' )
		);

		$fields['hoverinfo'] = array(
			'type'        => 'alert',
			'title'       => esc_html__( 'Hover Behaviour', 'wvt' ),
			'description' => esc_html__( 'Any option to control hover behavior.', 'wvt' ),
			'default'     => 'info'
		);

		$fields['hover'] = array(
			'type'        => 'select',
			'title'       => esc_html__( 'Hover Behaviour', 'wvt' ),
			'description' => esc_html__( 'Choose how hotspot behaviour when hovered.', 'wvt' ),
			'options'     => array(
				'none'  => esc_html__( 'None', 'wvt' ),
				'short' => esc_html__( 'Short Tooltips', 'wvt' ),
			),
		);

		$fields['hovertext'] = array(
			'type'        => 'text',
			'title'       => esc_html__( 'Tooltip Text', 'wvt' ),
			'description' => esc_html__( 'Insert text that shown on the tooltip when tour hovered.', 'wvt' ),
			'dependency'  => array(
				array(
					'field'    => 'hover',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		);

		$fields['hovertheme'] = array(
			'type'        => 'select',
			'title'       => esc_html__( 'Hover Theme', 'wvt' ),
			'description' => esc_html__( 'Choose hover theme to be used.', 'wvt' ),
			'options'     => array(
				'default'    => esc_html__( 'Default', 'wvt' ),
				'borderless' => esc_html__( 'Borderless', 'wvt' ),
				'light'      => esc_html__( 'Light', 'wvt' ),
				'noir'       => esc_html__( 'Noir', 'wvt' ),
				'punk'       => esc_html__( 'Punk', 'wvt' ),
				'shadow'     => esc_html__( 'Shadow', 'wvt' ),
			),
			'dependency'  => array(
				array(
					'field'    => 'hover',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		);

		$fields['hoverposition'] = array(
			'type'        => 'select',
			'title'       => esc_html__( 'Tooltip Position', 'wvt' ),
			'description' => esc_html__( 'Position of tooltips.', 'wvt' ),
			'options'     => array(
				'top'    => esc_html__( 'Top', 'wvt' ),
				'right'  => esc_html__( 'Right', 'wvt' ),
				'bottom' => esc_html__( 'Bottom', 'wvt' ),
				'left'   => esc_html__( 'Left', 'wvt' ),
			),
			'dependency'  => array(
				array(
					'field'    => 'hover',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		);

		$fields['hoverminwidth'] = array(
			'type'        => 'slider',
			'title'       => esc_html__( 'Hover balloon min-width', 'wvt' ),
			'description' => esc_html__( 'Define the minimum width for the balloon.', 'wvt' ),
			'options'     => array(
				'min'  => 50,
				'max'  => 500,
				'step' => 1,
			),
			'dependency'  => array(
				array(
					'field'    => 'hover',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		);

		$fields['hovermaxwidth'] = array(
			'type'        => 'slider',
			'title'       => esc_html__( 'Hover balloon max-width', 'wvt' ),
			'description' => esc_html__( 'Define the maximum width for the balloon.', 'wvt' ),
			'options'     => array(
				'min'  => 50,
				'max'  => 600,
				'step' => 1,
			),
			'dependency'  => array(
				array(
					'field'    => 'hover',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
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
			'title'       => esc_html__( 'Panorama Name', 'wvt' ),
			'description' => esc_html__( 'Provide name for your panorama.', 'wvt' ),
		);

		$fields['type'] = array(
			'type'        => 'select',
			'title'       => esc_html__( 'Panorama Type', 'wvt' ),
			'description' => wp_kses( sprintf(
				__( 'Choose your panorama image type. For more information about Panorama Type, <a href="%s" target="_blank">please refer to documentation.</a>', 'wvt' ),
				'https://support.jegtheme.com/documentation/create-single-panorama/'
			), wp_kses_allowed_html() ),
			'options'     => array(
				'equirectangular' => esc_html__( 'Equirectangular', 'wvt' ),
				'cubemap'         => esc_html__( 'Cubemap', 'wvt' ),
			),
		);

		$fields['equirectangular_external'] = array(
			'type'        => 'checkbox',
			'title'       => esc_html__( 'Use External Image', 'wvt' ),
			'description' => esc_html__( 'Check this option to use external image source or an image from CDN.', 'wvt' ),
			'dependency'  => array(
				array(
					'field'    => 'type',
					'operator' => '==',
					'value'    => 'equirectangular',
				),
			),
			'segment'     => 'option'
		);

		$fields['equirectangular_external_url'] = array(
			'type'        => 'text',
			'title'       => esc_html__( 'External Image', 'wvt' ),
			'description' => esc_html__( 'Insert image url.', 'wvt' ),
			'dependency'  => array(
				array(
					'field'    => 'type',
					'operator' => '==',
					'value'    => 'equirectangular',
				),
				array(
					'field'    => 'equirectangular_external',
					'operator' => '==',
					'value'    => true,
				),
			),
		);

		$fields['equirectangular'] = array(
			'type'        => 'image',
			'title'       => esc_html__( 'Equirectangular Image', 'wvt' ),
			'description' => wp_kses( sprintf(
				__( 'Upload your equirectangular image. <a target="_blank" href="%s">Find out how to create equirectangular image.</a>', 'wvt' ),
				'https://support.jegtheme.com/documentation/create-single-panorama/'
			), wp_kses_allowed_html() ),
			'dependency'  => array(
				array(
					'field'    => 'type',
					'operator' => '==',
					'value'    => 'equirectangular',
				),
				array(
					'field'    => 'equirectangular_external',
					'operator' => '==',
					'value'    => false,
				),
			),
			'segment'     => 'option'
		);

		$fields['cubemap'] = array(
			'type'        => 'cubemap',
			'title'       => esc_html__( 'Cubemap Image', 'wvt' ),
			'description' => wp_kses( sprintf(
				__( 'Upload your square ( 1 x 1 ) cubemap image. <a href="%s" target="_blank">Find out how to create cubemap image.</a>', 'wvt' ),
				'https://support.jegtheme.com/documentation/create-single-panorama/'
			), wp_kses_allowed_html() ),
			'dependency'  => array(
				array(
					'field'    => 'type',
					'operator' => 'in',
					'value'    => array( 'cubemap', 'cubemapmultires' ),
				),
			),
		);

		$fields['coordinate'] = array(
			'type'        => 'coordinate',
			'title'       => esc_html__( 'Initial Coordinate', 'wvt' ),
			'description' => esc_html__( 'Set your initial coordinate for panorama. Please use the control on the map above to set this value.', 'wvt' )
		);

		$fields['height'] = array(
			'type'        => 'deviceheight',
			'options'     => array(
				'desktop' => array(
					'min'  => 1,
					'max'  => 200,
					'step' => 1,
				),
				'tablet'  => array(
					'min'  => 1,
					'max'  => 200,
					'step' => 1,
				),
				'mobile'  => array(
					'min'  => 1,
					'max'  => 200,
					'step' => 1,
				),
			),
			'title'       => esc_html__( 'Panorama Height Dimension', 'wvt' ),
			'description' => esc_html__( 'The height based on the percentage (%) of panorama width. (Example: 100 means 1:1, 200 means 2:1).', 'wvt' ),
		);

		$fields['toolbar_scheme'] = array(
			'type'        => 'select',
			'title'       => esc_html__( 'Toolbar Scheme', 'wvt' ),
			'description' => esc_html__( 'Choose which toolbar scheme you want to use for your panorama.', 'wvt' ),
			'options'     => array(
				'default' => esc_html__( 'Default Toolbar', 'wvt' ),
				'top'     => esc_html__( 'Top Toolbar', 'wvt' ),
				'bottom'  => esc_html__( 'Bottom Toolbar', 'wvt' ),
			),
		);

		$fields['autorotate'] = array(
			'type'        => 'checkbox',
			'title'       => esc_html__( 'Enable Auto Rotate', 'wvt' ),
			'description' => esc_html__( 'Check this option to enable automatic rotation after panorama finish loading.', 'wvt' ),
		);

		$fields['autorotate_speed'] = array(
			'type'        => 'slider',
			'title'       => esc_html__( 'Auto Rotate Speed', 'wvt' ),
			'description' => esc_html__( 'Define auto rotate speed.', 'wvt' ),
			'options'     => array(
				'min'  => 1,
				'max'  => 20,
				'step' => 1,
			)
		);

		$fields['autorotate_direction'] = array(
			'type'        => 'select',
			'title'       => esc_html__( 'Auto Rotate Direction', 'wvt' ),
			'description' => esc_html__( 'Choose auto rotate direction for panorama image.', 'wvt' ),
			'options'     => array(
				'clockwise'        => esc_html__( 'Clockwise', 'wvt' ),
				'counterclockwise' => esc_html__( 'Counter Clockwise', 'wvt' ),
			)
		);

		$fields['autorotate_button'] = array(
			'type'        => 'checkbox',
			'title'       => esc_html__( 'Show Autorotate Control', 'wvt' ),
			'description' => esc_html__( 'Enable this option to show the auto rotate control.', 'wvt' ),
		);

		$fields['compass'] = array(
			'type'        => 'checkbox',
			'title'       => esc_html__( 'Show Compass', 'wvt' ),
			'description' => esc_html__( 'Enable this option to show the compass.', 'wvt' ),
		);

		$fields['north'] = array(
			'type'        => 'text',
			'title'       => esc_html__( 'Compass North Location', 'wvt' ),
			'description' => esc_html__( 'Set compass north location, you can also use above button to set compass north location.', 'wvt' ),
			'dependency'  => array(
				array(
					'field'    => 'compass',
					'operator' => '==',
					'value'    => true,
				),
			),
		);

		$fields['zoom'] = array(
			'type'        => 'checkbox',
			'title'       => esc_html__( 'Show Zoom Control', 'wvt' ),
			'description' => esc_html__( 'Enable this option to show the zoom control.', 'wvt' ),
		);

		$fields['fullscreen'] = array(
			'type'        => 'checkbox',
			'title'       => esc_html__( 'Show Fullscreen Control', 'wvt' ),
			'description' => esc_html__( 'Enable this option to show the fullscreen control.', 'wvt' ),
		);

		$fields['orientation'] = array(
			'type'        => 'checkbox',
			'title'       => esc_html__( 'Show Orientation Control', 'wvt' ),
			'description' => esc_html__( 'Enable this option to show the device orientation control. This button only available on mobile device.', 'wvt' ),
		);

		$fields['spotlist'] = array(
			'type'        => 'checkbox',
			'title'       => esc_html__( 'Show Hotspot & Tour List', 'wvt' ),
			'description' => esc_html__( 'Enable this option to show the hotspot & tour list info.', 'wvt' ),
		);

		$fields['map'] = array(
			'type'        => 'alert',
			'title'       => esc_html__( 'Panorama Map', 'wvt' ),
			'description' => esc_html__( 'Any option to control panorama map.', 'wvt' ),
			'default'     => 'info'
		);

		$fields['enable_map'] = array(
			'type'        => 'checkbox',
			'title'       => esc_html__( 'Show Panorama Map', 'wvt' ),
			'description' => esc_html__( 'Enable this option to show the panorama map.', 'wvt' ),
		);

		$fields['mapid'] = array(
			'type'        => 'select',
			'title'       => esc_html__( 'Select Panorama Map', 'wvt' ),
			'description' => esc_html__( 'Choose the panorama map that you want to use.', 'wvt' ),
			'options'     => Helper::get_post_list( 'panorama-map' ),
			'dependency'  => array(
				array(
					'field'    => 'enable_map',
					'operator' => '==',
					'value'    => true,
				),
			),
		);

		$fields['mapdimension'] = array(
			'type'        => 'slider',
			'title'       => esc_html__( 'Map Dimension', 'wvt' ),
			'description' => esc_html__( 'The dimension based on the percentage (%) of panorama container size. (Example: 10 means 1:10, 50 means 1:2).', 'wvt' ),
			'options'     => array(
				'min'  => 10,
				'max'  => 40,
				'step' => 1,
			),
			'dependency'  => array(
				array(
					'field'    => 'enable_map',
					'operator' => '==',
					'value'    => true,
				),
			),
		);

		$fields['css'] = array(
			'type'        => 'css',
			'title'       => esc_html__( 'CSS', 'wvt' ),
			'description' => esc_html__( 'Set CSS for this panorama.', 'wvt' ),
		);

		return $fields;
	}
}
