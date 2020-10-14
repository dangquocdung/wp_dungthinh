<?php
/**
 * WordPress Virtual Tour
 *
 * @author Jegtheme
 * @since 1.0.0
 * @package wordpress-virtual-tour
 */

namespace WVT;

use WVT\Form\Field\Field_Abstract;
use WVT\Integration\Elementor;
use WVT\Integration\Wpbakery;

/**
 * Class Init
 *
 * @package wordpress-virtual-tour
 */
class Init {
	/**
	 * Instance of Init.
	 *
	 * @var Init
	 */
	private static $instance;

	/**
	 * Instance of single panorama
	 *
	 * @var Single_Panorama
	 */
	private $panorama;

	/**
	 * Instance of Panorama Map
	 *
	 * @var Panorama_Map
	 */
	private $map;

	/**
	 * Plugin Update Instance
	 *
	 * @var Plugin
	 */
	private $plugin;

	/**
	 * Instance of frontend
	 *
	 * @var Frontend
	 */
	private $frontend;

	/**
	 * Instance of helper
	 *
	 * @var Helper
	 */
	private $helper;

	/**
	 * Instance of global option
	 *
	 * @var Global_Option
	 */
	private $global;

	/**
	 * WPBakery Page Builder Integration
	 *
	 * @var Wpbakery
	 */
	public $wpbakery;

	/**
	 * Elementor Page Builder Integration
	 *
	 * @var Elementor
	 */
	public $elementor;

	/**
	 * Singleton page for Init Class
	 *
	 * @return Init
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
		$this->frontend = Frontend::get_instance();

		add_action( 'plugins_loaded', array( $this, 'initialize_plugin' ) );
		add_action( 'plugins_loaded', array( $this, 'initialize_page_builder' ), 9 );

		if ( is_admin() ) {
			add_filter( 'wvt_get_admin_menu', array( &$this, 'get_admin_menu' ) );
			
			add_action( 'admin_enqueue_scripts', array( $this, 'load_assets' ) );
			add_action( 'admin_menu', array( $this, 'parent_menu' ) );
			add_action( 'admin_menu', array( $this, 'child_menu' ) );
			add_action( 'admin_footer', array( $this, 'print_admin_footer' ) );
			add_action( 'admin_print_footer_scripts', array( $this, 'print_admin_footer' ) );	
			add_action( 'admin_init', array( $this, 'dashboard_redirect' ) );
			add_action( 'wp_default_scripts', array( $this, 'wp_default_custom_scripts' ) );

			wvt_activation_hook( WVT_FILE );
		}
		
	}

	/**
	 * Default WP Custom Script
	 *
	 * Fix WP 5.5 issue
	 */
	public function wp_default_custom_scripts( $scripts ){
		if ( is_admin() && version_compare( get_bloginfo('version'),'5.5', '>=' ) ) {
			$scripts->add( 'wp-color-picker', '/wp-admin/js/color-picker.js', array( 'iris' ), false, 1 );
			did_action( 'init' ) && $scripts->localize(
				'wp-color-picker',
				'wpColorPickerL10n',
				array(
					'clear'            => esc_html__( 'Clear', 'wvt' ),
					'clearAriaLabel'   => esc_html__( 'Clear color', 'wvt' ),
					'defaultString'    => esc_html__( 'Default', 'wvt' ),
					'defaultAriaLabel' => esc_html__( 'Select default color', 'wvt' ),
					'pick'             => esc_html__( 'Select Color', 'wvt' ),
					'defaultLabel'     => esc_html__( 'Color value', 'wvt' ),
				)
			);
		}
	}

	/**
	 * Initialize Page Builder
	 */
	public function initialize_page_builder() {
		if ( defined( 'WPB_VC_VERSION' ) ) {
			$this->wpbakery = new Wpbakery();
		}

		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			$this->elementor = new Elementor();
		}
	}

	/**
	 * Dashboard redirect after plugin activation
	 */
	public function dashboard_redirect() {
		$redirect = get_transient( '_dashboard_redirect' );
		delete_transient( '_dashboard_redirect' );
		$redirect && wp_safe_redirect( admin_url( 'admin.php?page=wvt' ) );
	}

	/**
	 * Register control type
	 *
	 * @return array
	 */
	public function control_form_type() {
		$type = array(
			'standart'     => 'WVT\Form\Field\Standart',
			'text'         => 'WVT\Form\Field\Text',
			'color'        => 'WVT\Form\Field\Color',
			'select'       => 'WVT\Form\Field\Select',
			'checkbox'     => 'WVT\Form\Field\Checkbox',
			'radioimage'   => 'WVT\Form\Field\Radioimage',
			'slider'       => 'WVT\Form\Field\Slider',
			'iconpicker'   => 'WVT\Form\Field\Iconpicker',
			'heading'      => 'WVT\Form\Field\Heading',
			'alert'        => 'WVT\Form\Field\Alert',
			'textarea'     => 'WVT\Form\Field\Textarea',
			'texteditor'   => 'WVT\Form\Field\Texteditor',
			'number'       => 'WVT\Form\Field\Number',
			'image'        => 'WVT\Form\Field\Image',
			'repeater'     => 'WVT\Form\Field\Repeater',
			'cubemap'      => 'WVT\Form\Field\Cubemap',
			'coordinate'   => 'WVT\Form\Field\Coordinate',
			'deviceheight' => 'WVT\Form\Field\Deviceheight',
			'css'          => 'WVT\Form\Field\Css',
		);

		return apply_filters( 'jeg_register_control_form_type', $type );
	}

	/**
	 * Print template on admin footer
	 */
	public function print_admin_footer() {
		$controls = $this->control_form_type();

		foreach ( $controls as $type => $class ) {
			/** @var Field_Abstract $control */
			$control = new $class();
			$control->render_template();
		}
	}

	/**
	 * Load Asset
	 */
	public function load_assets() {
		wp_enqueue_style( 'wvt-dashboard', WVT_URL . '/assets/css/wvt-dashboard.css', null, WVT_VERSION );

		if ( $this->is_on_wvt_admin() ) {
			// Load Style.
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'wvt-form', WVT_URL . '/assets/css/wvt-form.css', null, WVT_VERSION );
			wp_enqueue_style( 'font-awesome', WVT_URL . '/assets/fonts/font-awesome/font-awesome.css', null, WVT_VERSION );
			wp_enqueue_style( 'wvt-frontend', WVT_URL . '/assets/css/wvt-frontend.css', null, WVT_VERSION );
			wp_enqueue_style( 'wvt-admin', WVT_URL . '/assets/css/wvt-admin.css', null, WVT_VERSION );
			wp_enqueue_style( 'pannellum', WVT_URL . '/assets/lib/pannellum/css/pannellum.css', null, WVT_VERSION );
			wp_enqueue_style( 'selectize', WVT_URL . '/assets/css/selectize.default.css', null, WVT_VERSION );
			wp_enqueue_style( 'magnific-popup', WVT_URL . '/assets/lib/magnific-popup/magnific-popup.css', null, WVT_VERSION );

			wp_enqueue_style( 'perfect-scrollbar', WVT_URL . '/assets/lib/perfect-scrollbar/perfect-scrollbar.css', null, WVT_VERSION );
			wp_enqueue_style( 'tooltipster', WVT_URL . '/assets/lib/tooltipster/css/tooltipster.bundle.min.css', null, WVT_VERSION );
			wp_enqueue_style( 'tooltipster-borderless', WVT_URL . '/assets/lib/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-borderless.min.css', null, WVT_VERSION );
			wp_enqueue_style( 'tooltipster-light', WVT_URL . '/assets/lib/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-light.min.css', null, WVT_VERSION );
			wp_enqueue_style( 'tooltipster-noir', WVT_URL . '/assets/lib/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-noir.min.css', null, WVT_VERSION );
			wp_enqueue_style( 'tooltipster-punk', WVT_URL . '/assets/lib/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-punk.min.css', null, WVT_VERSION );
			wp_enqueue_style( 'tooltipster-shadow', WVT_URL . '/assets/lib/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-shadow.min.css', null, WVT_VERSION );

			// Load Script.
			wp_enqueue_media();
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'underscore' );
			wp_enqueue_script( 'wp-util' );
			wp_enqueue_script( 'customize-base' );
			wp_enqueue_script( 'customize-controls' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_script( 'jquery-ui-spinner' );
			wp_enqueue_script( 'selectize', WVT_URL . '/assets/lib/vendor/selectize.js', null, WVT_VERSION, true );
			wp_enqueue_script( 'wvt-helper', WVT_URL . '/assets/js/wvt-helper.js', null, WVT_VERSION, true );
			wp_enqueue_script( 'wvt-form', WVT_URL . '/assets/js/wvt-form.js', null, WVT_VERSION, true );
			wp_enqueue_script( 'wvt-container', WVT_URL . '/assets/js/wvt-container.js', null, WVT_VERSION, true );
			wp_enqueue_script( 'bootstrap', WVT_URL . '/assets/lib/vendor/bootstrap.min.js', null, WVT_VERSION, true );
			wp_enqueue_script( 'bootstrap-iconpicker-iconset', WVT_URL . '/assets/lib/vendor/bootstrap-iconpicker-iconset-all.min.js', null, WVT_VERSION, true );
			wp_enqueue_script( 'bootstrap-iconpicker', WVT_URL . '/assets/lib/vendor/bootstrap-iconpicker.min.js', null, WVT_VERSION, true );
			wp_enqueue_script( 'wp-color-picker-alpha', WVT_URL . '/assets/lib/vendor/wp-color-picker-alpha.js', null, WVT_VERSION, true );
		}

		if ( function_exists( 'vc_is_frontend_editor' ) && vc_is_frontend_editor() ) {
			wp_enqueue_script('vc-frontend', WVT_URL . '/assets/js/integration/vc.frontend.js', null, WVT_VERSION, true);
		}
	}

	/**
	 * Check if we are on WVT Admin
	 *
	 * @return bool
	 */
	public function is_on_wvt_admin() {
		if ( isset( $_GET['page'] ) ) {
			$page = wp_unslash( $_GET['page'] );

			return in_array( $page, $this->get_admin_menu_slug_array(), true );
		}
	}

	/**
	 * Load All Required Instance for this plugin.
	 */
	public function initialize_plugin() {
		$this->helper 	= new Helper();
		$this->panorama = new Single_Panorama();
		$this->map      = new Panorama_Map();
		$this->plugin   = new Plugin();
		$this->global	= new Global_Option();
	}

	/**
	 * Parent Menu
	 */
	public function parent_menu() {
		add_menu_page( esc_html__( 'Virtual Tour', 'wvt' ), esc_html__( 'Virtual Tour', 'wvt' ), 'edit_theme_options', 'wvt', null, 'dashicons-screenoptions', 76 );
	}

	/**
	 * Child Menu
	 */
	public function child_menu() {
		$self  = $this;
		$menus = $this->get_admin_menu();

		foreach ( $menus as $menu ) {
			if ( $menu['show_on_menu'] ) {
				if ( $menu['action'] ) {
					add_submenu_page(
						'wvt', $menu['title'], $menu['menu'], 'edit_theme_options', $menu['slug'], function () use ( $self, $menu ) {
							$self->render_admin_content( $menu['action'] );
						}
					);
				} else {
					add_submenu_page(
						'wvt', $menu['title'], $menu['menu'], 'edit_theme_options', $menu['slug']
					);
				}
			}
		}
	}

	/**
	 * Render admin content
	 *
	 * @param array $action String of action.
	 */
	public function render_admin_content( $action ) {
		settings_errors();
		$logo = WVT_URL . '/assets/img/logo.png';
		?>
		<div class="wvt-admin">
			<div class="wvt-logo">
				<img src="<?php echo esc_url( $logo ); ?>" alt="<?php esc_html_e( 'WordPress Virtual Tour', 'wvt' ); ?>"/>
				<h1><?php esc_html_e( 'WordPress Virtual Tour', 'wvt' ); ?></h1>
			</div>
			<h2 class="nav-tab-wrapper">
				<?php
				$allmenu = apply_filters( 'wvt_get_admin_menu', '' );
				foreach ( $allmenu as $menu ) {
					$tabactive = isset( $_GET['page'] ) && ( $_GET['page'] === $menu['slug'] ) ? 'nav-tab-active' : '';
					$pageurl   = menu_page_url( $menu['slug'], false );
					?>
					<a href="<?php echo esc_url( $pageurl ); ?>" class="nav-tab <?php echo esc_attr( $tabactive ); ?>"><?php echo esc_html( $menu['title'] ); ?></a>
					<?php
				}
				?>
			</h2>
			<div class="wvt-content">
				<?php call_user_func( $action ); ?>
			</div>
		</div>
		<?php
	}

	/**
	 * Array of admin menu slug
	 *
	 * @return array
	 */
	public function get_admin_menu_slug_array() {
		$slugs = array();

		foreach ( $this->get_admin_menu() as $menu ) {
			if ( isset( $menu['slug'] ) ) {
				$slugs[] = $menu['slug'];
			}
		}

		return $slugs;
	}

	/**
	 * Admin Menu
	 *
	 * @return array
	 */
	public function get_admin_menu() {
		$menu = array(
			'wvt'        => array(
				'title'        => esc_html__( 'Dashboard', 'wvt' ),
				'menu'         => esc_html__( 'Dashboard', 'wvt' ),
				'slug'         => 'wvt',
				'action'       => array( $this, 'landing' ),
				'priority'     => 51,
				'show_on_menu' => true,
			),
			'wvt_global' => array(
				'title'        => esc_html__( 'Global Option', 'wvt' ),
				'menu'         => esc_html__( 'Global Option', 'wvt' ),
				'slug'         => 'wvt_global',
				'action'       => array( $this, 'globalOption' ),
				'priority'     => 53,
				'show_on_menu' => true,
			),
			'wvt_single' => array(
				'title'        => esc_html__( 'Single Panorama', 'wvt' ),
				'menu'         => esc_html__( 'Single Panorama', 'wvt' ),
				'slug'         => 'wvt_single',
				'action'       => array( $this, 'single' ),
				'priority'     => 55,
				'show_on_menu' => true,
			),
			'wvt_map'    => array(
				'title'        => esc_html__( 'Panorama Map', 'wvt' ),
				'menu'         => esc_html__( 'Panorama Map', 'wvt' ),
				'slug'         => 'wvt_map',
				'action'       => array( $this, 'map' ),
				'priority'     => 57,
				'show_on_menu' => true,
			),
		);

		return apply_filters( 'wvt_admin_menu', $menu );
	}

	/**
	 * Landing
	 */
	public function landing() {
		$this->plugin->html();
	}

	/**
	 * Single Page
	 */
	public function single() {
		$this->panorama->html();
	}

	/**
	 * Map Page
	 */
	public function map() {
		$this->map->html();
	}

	/**
	 *
	 */
	public function globalOption() {
		$this->global->html();
	}
}
