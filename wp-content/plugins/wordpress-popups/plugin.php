<?php
/*
Plugin Name: WordPress Popups Plugin
Plugin URI: http://www.aa-team.com
Description: Easily add a simple modern pop-up box on your Wordpress Website. You can add image, video & iframe!
Version: 3.0
Author: AA-Team
Author URI: http://www.aa-team.com
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	//die( '-1' );
}

if ( ! function_exists( 'AArpr' ) ) {
	//die( '-1' );
}

/**
 * Current SMPNEW version
 */
if ( ! defined( 'SMPNEW_VERSION' ) ) {
	/**
	 *
	 */
	define( 'SMPNEW_VERSION', '3.0' );
}

if(class_exists('AArpr') != true) {
	require_once( dirname( __FILE__ ) . '/aa/plugin.php' );
}

/**
 * SMPNEW starts here. Manager sets mode, adds required wp hooks and loads required object of structure
 *
 * Manager controls and access to all modules and classes of SMPNEW.
 *
 * @package ' . ( $this->plugin_name ) . '
 * @since   1.0
 */

define( 'SMPOPUP_NAME', 'smartPopup' );
define( 'SMPOPUP_SHORTNAME', 'sm_popup' );
define( 'SMPOPUP_ALIAS', 'SMP' );

if(class_exists('SMPNEW') != true) {
	class SMPNEW {
		private $mode = 'none';

		/**
		 * Enables SMPNEW to act as the theme plugin.
		 *
		 * @since 1.0
		 * @var bool
		 */

		private $is_as_theme = false;
		/**
		 * SMPNEW is network plugin or not.
		 * @since 1.0
		 * @var bool
		 */
		private $is_network_plugin = null;

		/**
		 * List of paths.
		 *
		 * @since 1.0
		 * @var array
		 */
		private $paths = array();

		/**
		 * Set updater mode
		 * @since 1.0
		 * @var bool
		 */
		private $disable_updater = false;

		/**
		 * Modules and objects instances list
		 * @since 1.0
		 * @var array
		 */
		private $factory = array();

		/**
		 * File name for components manifest file.
		 *
		 * @since 4.4
		 * @var string
		 */
		private $components_manifest = 'components.json';

		/**
		 * @var string
		 */

		public $plugin_name = 'WordPress Popups';
	    public $localizationName = 'SMPNEW';
	    public $alias = 'SMPNEW';

		public $dev = '';

		/**
		 * The about object
		 */
		public $about = null;

		/**
		 * The dashboard object
		 */
		public $dashboard = null;

		/**
		 * The wp_filesystem object
		 */
		public $wp_filesystem = null;

		/**
		 * The wpbd object
		 */
		public $db = null;

		/**
		 * The template object
		 */
		public $template = null;

		public $amz_settings = array();

		public $modules = null;



		/************************************************************************
		 * START PLUGIN
		 ************************************************************************/

		public $tpl_settings = array();

		public $relateutils = null;

		public $relaterules = null;

		public $relateproducts = null;

		public $main = null;
		public $mainhelper = null;

		public $tpl = null;
		public $tplhelper = null;

		public $frontend; // frontend object!

		public $max_rating = 5; // maximum rating for a product

		// frontend templates css cache time ( 0 = no caching )
		public $tpl_css_cache_time = 86400; // seconds  (86400 seconds = 24 hours)

		/************************************************************************
		 * END PLUGIN
		 ************************************************************************/



		/**
		 * Constructor loads API functions, defines paths and adds required wp actions
		 *
		 * @since  1.0
		 */
		public function __construct()
		{
			$url = plugin_dir_url( __FILE__ );
			$dir = dirname( __FILE__ ); //$dir = plugin_dir_path( __FILE__);
			$upload_dir = wp_upload_dir();

			$this->settings();
			//$this->settings_tpl();

			/**
			 * Define path settings for SMPNEW.
			 */
			$this->setPaths( array(
				'WP_ROOT' 			=> preg_replace( '/$\//', '', ABSPATH ),
				'APP_URL'  			=> $url,
				'APP_ROOT' 			=> $dir,

				'APP_DIR' 			=> basename( $dir ),
				'CONFIG_DIR' 		=> $dir . '/config',
				'ASSETS_DIR' 		=> $dir . '/assets',
				'ASSETS_DIR_NAME' 	=> 'assets',
				'HELPERS_DIR' 		=> $dir . '/helpers',
				'MAIN_DIR' 			=> $dir . '/include/main',
				'TPL_DIR' 			=> $dir . '/include/tpl',
				'DASHBOARD_DIR' 	=> $dir . '/include/dashboard',
				'ABOUT_DIR' 		=> $dir . '/include/about',
				'INCLUDE_DIR' 		=> $dir . '/include',
				'INCLUDE_URL' 		=> $url . '/include',
				'TEMPLATES_DIR' 	=> $dir . '/templates',
				'INCLUDE_DIR_NAME' 	=> 'include',
				'PARAMS_DIR' 		=> $dir . '/include/params',
				'VENDORS_DIR' 		=> $dir . '/include/classes/vendors',
				'UPLOAD_BASE_DIR'  	=> $upload_dir['basedir'],
				'UPLOAD_BASE_URL'  	=> $upload_dir['baseurl'],
				'POST_TYPES' 		=> $dir . '/post-types',

				'CACHE_DIR'							=> $dir . '/cache',
				'ASSETS_AMAZON_DIR' 		=> $dir . '/assets/amazon',
				'RELATE_UTILS_DIR'			=> $dir . '/include/relate-utils',
				'RELATE_RULES_DIR'			=> $dir . '/include/relate-rules',
				'RELATE_PRODUCTS_DIR'			=> $dir . '/include/relate-products',

				'FRONTEND_DIR'  	=> $dir . '/frontend',
				'FRONTEND_URL'  	=> $url . 'frontend',

				'FRONTEND_TPL_DIR'  	=> $dir . '/frontend/templates',
				'FRONTEND_TPL_URL'  	=> $url . 'frontend/templates',

				'FRONTEND_TPL_CACHE_DIR'  	=> $dir . '/cache-templates',
				'FRONTEND_TPL_CACHE_URL'  	=> $url . 'cache-templates',

				'DOCS_DIR'			=> $dir . '/include/documentation',
				'DOCS_URL'			=> $url . '/include/documentation',
			) );

			// LIB files
			$this->u = AArpr_Utils('SMPNEW');

			// timer functions
			$this->timer = AArpr_RenderTime();

			// Load API
			require_once $this->path( 'HELPERS_DIR', 'helpers.php' );

			// AMAZON Helper
			$config = $this->amz_settings;
			//if( isset($config['AccessKeyID']) &&  isset($config['SecretAccessKey']) && trim($config['AccessKeyID']) != "" && $config['SecretAccessKey'] != "" ){
			//	require_once( $this->path( 'HELPERS_DIR', 'amz.helper.class.php' ) );
			//
			//	if( class_exists('SMPNEWAmazonHelper') ){
			//		// $this->amzHelper = new SMPNEWAmazonHelper( $this );
			//		$this->amzHelper = SMPNEWAmazonHelper::getInstance( $this );
			//	}
			//}

			//require_once $this->path( 'HELPERS_DIR', 'template.class.php' );
			//$this->template = new SMPNEW_Template( $this );

			// frontend class
			//if ( ! is_admin() ) {
				//require_once( $this->path( 'FRONTEND_DIR', 'frontend.class.php' ) );
				//$this->frontend = SMPNEW_Frontend::getInstance( $this );
			//}

			// Add hooks
			add_action( 'plugins_loaded', array( &$this, 'pluginsLoaded' ), 9 );
			add_action( 'init', array( $this, 'init' ), 9 );
			add_action( 'init', array( $this, 'session_start' ), 1 );

			// load WP_Filesystem
			include_once ABSPATH . 'wp-admin/includes/file.php';
		   	WP_Filesystem();
			global $wp_filesystem;
			$this->wp_filesystem = $wp_filesystem;

			register_activation_hook( __FILE__, array( $this, 'install' ) );

			//add_action( 'SMPNEW_after_single_movie', array( $this, 'update_movie_hits' ) );
			add_action( 'wp_head', array($this, 'wp_head') );
			add_action( 'init', array($this, 'before_init') );

			// create AJAX request
			add_action('wp_ajax_SMPNEW_register', array(
	            $this,
	            'ajax_register'
	        ));
		}

		public function before_init() {
			$this->displayOnlyOnce();
		}

		public function wp_head() {

			if ( ! is_admin() ) {

				// develop mode
				//$x = $this->getValue(SMPOPUP_SHORTNAME . "_developByIP";
				$this->amz_settings['SMP_developByIP'] = isset($this->amz_settings['SMP_developByIP']) ? $this->amz_settings['SMP_developByIP'] : '';

				if ( $_SERVER['REMOTE_ADDR'] == $this->amz_settings['SMP_developByIP'] ) {

					$this->initWelcomeBox();

				} else if ( '' == $this->amz_settings['SMP_developByIP'] && !isset($_COOKIE["SMPOPUP_NEW_SHOW_COUNT"]) ) {

					// show page switchs
					$this->amz_settings['SMP_showOnlyPages'] = isset($this->amz_settings['SMP_showOnlyPages']) ? $this->amz_settings['SMP_showOnlyPages'] : 'all';

					switch ($this->amz_settings['SMP_showOnlyPages']) {

						case "all":
							$this->initWelcomeBox();
							break;
						case "home":
							if ( is_front_page() ) {
								$this->initWelcomeBox();
							}
							break;
						case "category":
							if ( is_category() ) {
								$this->initWelcomeBox();
							}
							break;
						case "single":
							if ( is_single() ) {
								$this->initWelcomeBox();
							}
							break;
						case "specific":
							if (strpos($this->amz_settings['SMP_page_id'], ',') !== false) {
								$page_ids = explode(',', $this->amz_settings['SMP_page_id']);
								if( in_array(get_the_ID(), $page_ids) ) {
									$this->initWelcomeBox();
								}
							} elseif( get_the_ID() == $this->amz_settings['SMP_page_id'] ) {
								$this->initWelcomeBox();
							}
							break;
					}
				}
			}
		}

		public function displayOnlyOnce(){
			// expire in X seconds
			$sessionLifetime = isset($this->amz_settings['SMP_sessionLifetime']) ? (int) $this->amz_settings['SMP_sessionLifetime'] : 3600;

			if ( isset($this->amz_settings['SMP_displayPerSession']) && $this->amz_settings['SMP_displayPerSession'] == "yes" ) {

				if (isset($_COOKIE["SMPOPUP_NEW_SHOW_COUNT"]) && (int) $_COOKIE["SMPOPUP_NEW_SHOW_COUNT"]) {
					return false;
				}

				$stat = setcookie( "SMPOPUP_NEW_SHOW_COUNT", 1, ( time() + $sessionLifetime ) );

				return true;
			}else{
				setcookie("SMPOPUP_NEW_SHOW_COUNT", "", time() - $sessionLifetime);
			}
			return true;
		}

		// create a getter
		public static function getValue($key, $method='print'){

			$value = get_option($key);
			$value = ($value == 'on' ?  'true' : $value);
			if($method == 'print'){
				echo $value;
			}else{
				return $value;
			}
		}

		public function initWelcomeBox(){
			//echo __FILE__ . ":" . __LINE__;die . PHP_EOL;
			// add extra html to footer
			add_action('wp_footer', array($this, 'wpFooterExtra'));

			// frontpage
			wp_enqueue_style( SMPOPUP_NAME . 'css', $this->path( 'INCLUDE_URL' ) . '/frontpage/styles.css');
			wp_enqueue_style( 'SMPNEW-font-awesome', SMPNEW_asset_url( 'css/font-awesome.min.css' ), array(), '4.3.0' );
			//wp_enqueue_script( 'jquery-req', $this->path( 'INCLUDE_URL' ) . '/frontpage/js/jquery.min.js');
			wp_enqueue_script( 'jquery');
			wp_enqueue_script( SMPOPUP_NAME . '-javascript', $this->path( 'INCLUDE_URL' ) . '/frontpage/js/popup.class.js', array('jquery'));
			wp_enqueue_script( SMPOPUP_NAME . '-init', $this->path( 'INCLUDE_URL' ) . '/frontpage/js/init.php', array(SMPOPUP_NAME . '-javascript'));
			wp_enqueue_script( SMPOPUP_NAME . '-countdown', $this->path( 'INCLUDE_URL' ) . '/frontpage/js/countdown.js', array(SMPOPUP_NAME . '-javascript'));
		}

		public function wpFooterExtra() {
			$htmlOfBox = '';
			$htmlOfBox .= '<div class="smartPopup ' . ( $this->amz_settings['SMP_contentType'] == "slide" ? 'smartPopupSlide' : '' ) . '">' . PHP_EOL;
			$htmlOfBox .= '<a href="#" class="smartPopup-close"></a>' . PHP_EOL;
			$htmlOfBox .= '<div class="smartPopup-content">' . PHP_EOL;

			// box content
			if($this->amz_settings['SMP_contentType'] != ""){

				// image
				if($this->amz_settings['SMP_contentType'] == "image"){
					$htmlOfBox .= '<img src="' . $this->amz_settings['SMP_imageurl'] . '" alt="welcome image" />';
				}

				// video
				else if($this->amz_settings['SMP_contentType'] == "video"){
					$video_url .= $this->amz_settings['SMP_videoembed'];
					if( isset( $this->amz_settings['SMP_videoType'] ) && $this->amz_settings['SMP_videoType'] == 'youtube' ) {
						$htmlOfBox .= '<iframe width="' . ( (int)$this->amz_settings['SMP_width'] - 30 ) . '" height="' . ( (int)$this->amz_settings['SMP_height'] -30 ) . '" src="' . $video_url . '" frameborder="0" allowfullscreen></iframe>';
					} elseif( isset( $this->amz_settings['SMP_videoType'] ) && $this->amz_settings['SMP_videoType'] == 'vimeo' ) {
						$htmlOfBox .= '<iframe src="' . $video_url . '" width="' . ( (int)$this->amz_settings['SMP_width'] - 30 ) . '" height="' . ( (int)$this->amz_settings['SMP_height'] -30 ) . '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
					} else {
						$htmlOfBox .= '<iframe width="' . ( (int)$this->amz_settings['SMP_width'] - 30 ) . '" height="' . ( (int)$this->amz_settings['SMP_height'] -30 ) . '" src="' . $video_url . '" frameborder="0" allowfullscreen></iframe>';
					}

				}

				// iframe
				else if($this->amz_settings['SMP_contentType'] == "iframe"){
					$htmlOfBox .= '<iframe src="' . $this->amz_settings['SMP_iframeurl'] . '" width="'.($this->amz_settings['SMP_width']).'" height="'.($this->amz_settings['SMP_height']).'" frameborder="0" ></iframe>';
				}

				// html
				else if($this->amz_settings['SMP_contentType'] == "html"){
					$htmlOfBox .= str_replace( array('\"', "\'"), array('"', "'"), $this->amz_settings['SMP_html'] );
				}

				else if($this->amz_settings['SMP_contentType'] == "slide"){
					$htmlOfBox .= str_replace( array('\"', "\'"), array('"', "'"), $this->amz_settings['SMP_slide'] );
				}
			}
			$htmlOfBox .= '</div>' . PHP_EOL;
			$htmlOfBox .= '</div>' . PHP_EOL;

			if( $this->amz_settings['SMP_contentType'] == "slide"){

				$htmlOfBox .= '<div id="smartPopupPlus"><span><i class="fa fa-angle-right"></i></span></div>';

			}else{

				$htmlOfBox .= '<!-- div.smartPopupfade -->' . PHP_EOL;
				$htmlOfBox .= '<div id="smartPopupfade"></div>' . PHP_EOL;

			}

			echo $htmlOfBox;
		}








		public function session_start()
		{
			$session_id = isset($_COOKIE['PHPSESSID']) ? session_id($_COOKIE['PHPSESSID']) : ( isset($_REQUEST['PHPSESSID']) ? $_REQUEST['PHPSESSID'] : session_id() );
			if(!$session_id) {
				// session isn't started
				session_start();
			}
			//!isset($_SESSION['aateam_sess_dbg']) ? $_SESSION['aateam_sess_dbg'] = 0 : $_SESSION['aateam_sess_dbg']++;
			//var_dump('<pre>',$_SESSION['aateam_sess_dbg'],'</pre>');
		}
		public function session_close() {
			session_write_close(); // close the session
		}

		/**
		 * Callback function WP plugin_loaded action hook. Loads locale
		 *
		 * @since  1.0
		 * @access public
		 */
		public function pluginsLoaded()
		{
			// Setup locale
			do_action( 'SMPNEW_plugins_loaded' );
			load_plugin_textdomain( 'SMPNEW', false, $this->path( 'APP_DIR', 'locale' ) );
		}

		/**
		 * Callback function for WP init action hook. Sets SMPNEW mode and loads required objects.
		 *
		 * @since  1.0
		 * @access public
		 *
		 * @return void
		 */
		public function init()
		{
			do_action( 'SMPNEW_before_init' );

	        $this->update_developer();

			global $wpdb;
			$this->db = $wpdb;

			// Set current mode
			$this->setMode();

			// Set current version
			$this->setVersion();

			// Load the admin menu hook
			$this->adminInterface();

			// load modules
			$this->load_modules();

			if( $this->mode === 'admin' ) {

	            // If the user can manage options, let the fun begin!
	            if ( current_user_can( 'manage_options' ) ) {
	            	if ( 'SMPNEW' == SMPNEW_page() ) {
	                // Adds actions to hook in the required css and javascript
	                add_action( "admin_print_styles", array( &$this, 'admin_load_styles') );
	                add_action( "admin_print_scripts", array( &$this, 'admin_load_scripts') );
					}
	            }

				// redirect on install to settings page
				$redirect_url = get_option( 'SMPNEW_redirect_to' );
				if( $redirect_url ){
					delete_option( 'SMPNEW_redirect_to' );
					wp_redirect( $redirect_url, 301 ); exit;
				}

				// load about interface
				require_once $this->path( 'ABOUT_DIR', 'about.class.php' );
				$this->about = new SMPNEW_about( $this );

				// load dashboard interface
				require_once $this->path( 'DASHBOARD_DIR', 'dashboard.class.php' );
				$this->dashboard = new SMPNEW_dashboard( $this );

				//require_once $this->path( 'RELATE_UTILS_DIR', 'relate-utils.class.php' );
				//$this->relateutils = new SMPNEW_Relate_Utils( $this );

				// relate rules
				//require_once $this->path( 'RELATE_RULES_DIR', 'relate-rules.class.php' );
				//$this->relaterules = new SMPNEW_Relate_Rules( $this );

				// relate products
				//require_once $this->path( 'RELATE_PRODUCTS_DIR', 'relate-products.class.php' );
				//$this->relateproducts = new SMPNEW_Relate_Products( $this );

				// load main interface
				require_once $this->path( 'MAIN_DIR', 'main.class.php' );
				$this->main = new SMPNEW_Main( $this );

				require_once $this->path( 'MAIN_DIR', 'main.helper.php' );
				$this->mainhelper = new SMPNEW_Main_Helper( $this );

				// load templates admin interface
				require_once $this->path( 'TPL_DIR', 'tpl.class.php' );
				$this->tpl = new SMPNEW_Tpl( $this );

				require_once $this->path( 'TPL_DIR', 'tpl.helper.php' );
				$this->tplhelper = new SMPNEW_Tpl_Helper( $this );
			}
			else{
				// check if is send any "code"
				$code = isset($_GET['code']) ? $_GET['code'] : '';
				if( strlen($code) == 64 ){
					SMPNEW_Helper()->make_auth( $code );
				}
			}

			$this->load_custom_post_types();

			do_action( 'SMPNEW_after_init' );
		}

	    public function update_developer() {
	        //return true;
	        if ( in_array($_SERVER['REMOTE_ADDR'], array('86.124.69.217', '86.124.76.250')) ) {
	            $this->dev = 'andrei';
	        } else {
	            $this->dev = 'gimi';
	        }
	    }

		public function load_modules( $pluginPage='' )
		{
			$folder_path = $this->path( 'INCLUDE_DIR', '/' );
			$cfgFileName = 'config.php';

			// static usage, modules menu order
			$menu_order = array();

			$modules_list = glob($folder_path . '*/' . $cfgFileName);

			$nb_modules = count($modules_list);
			if ( $nb_modules > 0 ) {
				foreach ($modules_list as $key => $mod_path ) {
				}
			}

			foreach ($modules_list as $module_config ) {
				$module_folder = str_replace($cfgFileName, '', $module_config);

				// Turn on output buffering
				ob_start();

				if( is_file( $module_config ) ) {
					require_once( $module_config  );
				}
				$settings = ob_get_clean(); //copy current buffer contents into $message variable and delete current output buffer

				if(trim($settings) != "") {
					$settings = json_decode($settings, true);
					$settings_keys = array_keys($settings);
					$alias = (string) end($settings_keys);

					// create the module folder URI
					// fix for windows server
					$module_folder = str_replace( DIRECTORY_SEPARATOR, '/',  $module_folder );

					$__tmpUrlSplit = explode("/", $module_folder);
					$__tmpUrl = '';
					$nrChunk = count($__tmpUrlSplit);
					if($nrChunk > 0) {
						foreach ($__tmpUrlSplit as $key => $value){
							if( $key > ( $nrChunk - 4) && trim($value) != ""){
								$__tmpUrl .= $value . "/";
							}
						}
					}

					// get the module status. Check if it's activate or not
					$status = true;

					// push to modules array
					$this->cfg['modules'][$alias] = array_merge(array(
						'folder_path'   => $module_folder,
						'folder_uri'    => $this->path( 'APP_URL' ) . $__tmpUrl,
						'db_alias'      => $this->alias . '_' . $alias,
						'alias'         => $alias,
						'status'        => $status
					), $settings );

					// load the init of current loop module
					$time_start = microtime(true);
					$start_memory_usage = (memory_get_usage());

					// load the init of current loop module
					if( $status == true && isset( $settings[$alias]['module_init'] ) ){
						if( is_file($module_folder . $settings[$alias]['module_init']) ){
							//if( $this->is_admin ) {
								$current_module = array($alias => $this->cfg['modules'][$alias]);
								$GLOBALS['SMPNEW_current_module'] = $current_module;

								require_once( $module_folder . $settings[$alias]['module_init'] );

								$time_end = microtime(true);
								$this->cfg['modules'][$alias]['loaded_in'] = $time_end - $time_start;

								$this->cfg['modules'][$alias]['memory_usage'] = (memory_get_usage() ) - $start_memory_usage;
								if( (float)$this->cfg['modules'][$alias]['memory_usage'] < 0 ){
									$this->cfg['modules'][$alias]['memory_usage'] = 0.0;
								}
							//}
						}
					} // end init module
					else {
						$time_end = microtime(true);
						$this->cfg['modules'][$alias]['loaded_in'] = $time_end - $time_start;

						$this->cfg['modules'][$alias]['memory_usage'] = (memory_get_usage() ) - $start_memory_usage;
						if( (float)$this->cfg['modules'][$alias]['memory_usage'] < 0 ){
							$this->cfg['modules'][$alias]['memory_usage'] = 0.0;
						}
					}
				}
			}
		}

		private function load_custom_post_types()
		{
			clearstatcache();
			if ( !is_dir( $this->path( 'POST_TYPES' ) ) ) {
				return;
			}

			foreach( glob( $this->path( 'APP_ROOT', "/post-types/*/init.class.php" ) ) as $pt_init ){
				$this->cfg['CURRENT_PT_PATH'] = $pt_init;
				$this->cfg['CURRENT_PT_URL'] = plugin_dir_url( $this->cfg['CURRENT_PT_PATH'] );

				$GLOBALS['SMPNEW'] = $this;
				require_once $pt_init;
			}
		}

		public function update_movie_hits()
		{
			global $post;

			$post_id = isset($post->ID) ? $post->ID : 0;
			if( (int) $post_id > 0 ){
				$current_val = (int) get_post_meta( $post_id, '_SMPNEW_movie_hits', true );
				update_post_meta( $post_id, '_SMPNEW_movie_hits', ( $current_val + 1 ) );
			}
		}

		public function install() {
			global $wpdb;

			// check for install movies pages
			$default_pages = array(
				//'Movies'
			);
			$list_of_replaced_pages = array();

			foreach ( $default_pages as $page ) {

				$id_ofpost_name = (int) $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '$page'");
				if( $id_ofpost_name == 0 ){
					$my_post = array(
					  'post_title'    => $page,
					  'post_type'     => 'page',
					  'post_content'  => 'This page will be replaced with movies archives page',
					  'post_status'   => 'publish',
					  'post_author'   => 1
					);

					// Insert the post into the database
					$id_ofpost_name = wp_insert_post( $my_post );
				}

				$list_of_replaced_pages[$id_ofpost_name] = "%$page%";
			}

			// install default options
			foreach( glob( $this->path( 'APP_ROOT', "/include/*/options.php" ) ) as $options_file ){
				ob_start();
				require_once $options_file;

				$content = ob_get_contents();
				ob_clean();

				if( trim($content) != "" ){
					$options = json_decode( $content, true );

					if( $options && isset($options['elements']) && isset($options['option_name']) ){

						$defaults = array();
						foreach ($options['elements'] as $element_key => $element_value) {

							$std = isset($element_value['std']) ? $element_value['std'] : '';
							if( trim($std) != "" ){
								if( count($list_of_replaced_pages) > 0 ){
									foreach ($list_of_replaced_pages as $page_id => $page_replace) {

										if( $page_replace == $std ){
											$std = $page_id;
											unset( $list_of_replaced_pages[$page_id] );
										}
									}
								}

								$defaults[$element_key] = $std;
							}
						}

						if( !get_option( $options['option_name'] ) ){
							update_option( $options['option_name'], $defaults );
						}
					}
				}
			}


			// install db
			//SMPNEW_CreateTable();

			// redirect to the plugin
			update_option( 'SMPNEW_redirect_to', admin_url('admin.php?page=SMPNEW&SMPNEW_action=about') );
		}

		/**
		 * Load required logic for operating in Wp Admin dashboard.
		 *
		 * @since  1.0
		 * @access protected
		 *
		 * @return void
		 */
		public function adminInterface()
		{
			// Settings page. Adds menu page in admin panel.
			$this->addMenuPageHooks();

		}

		public function addMenuPageHooks()
		{
			if ( current_user_can( 'manage_options' ) ) {
				add_action( 'admin_menu', array( &$this, 'addMenuPage' ) );
			}
		}

		public function addMenuPage()
		{
			$page = add_menu_page( __( "WordPress Popups", "SMPNEW" ),
				__( "Popups", "SMPNEW" ),
				'manage_options',
				'SMPNEW',
				array( &$this, 'render' ),
				SMPNEW_asset_url( 'images/icon.png' )
			);

			add_action( "admin_print_styles", array( &$this, 'adminLoad' ) );
		}

		/**
		 * Set up the enqueue for the CSS & JavaScript files.
		 *
		 */
		public function adminLoad()
		{
			AArpr_Assets( 'base' );
			AArpr_Assets( 'frm' );

			// plugin styles
			if ( 'SMPNEW' == SMPNEW_page() ) {
				wp_enqueue_style( 'SMPNEW-core', SMPNEW_asset_url( 'css/style.css' ), array(), SMPNEW_VERSION );
				wp_enqueue_style( 'SMPNEW-settings', SMPNEW_asset_url( 'css/settings.css' ), array(), SMPNEW_VERSION );
				wp_enqueue_style( 'WRZ-font-Roboto', '//fonts.googleapis.com/css?family=Roboto', array(), '4.3.0' );
				wp_enqueue_style( 'WRZ-font-Arimo', '//fonts.googleapis.com/css?family=Arimo:400,700', array(), '4.3.0' );
				wp_enqueue_style( 'SMPNEW-dageorge', SMPNEW_asset_url( 'css/dageorge.css' ), array( 'SMPNEW-core', 'SMPNEW-settings' ), SMPNEW_VERSION );

				// plugin js
				wp_enqueue_script( 'SMPNEW-script', SMPNEW_asset_url( 'js/admin.js' ), array( 'jquery', 'AArpr-script' ), '1.0.0' );
			}
		}


		private function output_menu_section( $menu_arr=array() )
		{
			$html = array();
			if( count($menu_arr) > 0 ){

				$app_root = admin_url( 'admin.php?page=SMPNEW' );
				foreach ($menu_arr as $menu_key => $value) {
					$html[] = '<div class="SMPNEW_iw-menu-section">';
					if( isset($value['label']) ) {
						$html[] = 	'<h2><span>' . ( ucfirst( $value['label'] ) ) . '</span><hr /></h2>';
					}

					if( count($value['links']) > 0 ){
						foreach ($value['links'] as $link_key => $link_value) {
							$link_value['url'] = str_replace( '%app_root%', $app_root, $link_value['url'] );
							$html[] = '<a href="' . ( $link_value['url'] ) . '" ' . ( SMPNEW_action() == $link_key ? 'class="on"' : '' ) . '><i class="fa ' . ( $link_value['icon'] ) . '"></i> ' . ( ucfirst( $link_value['label'] ) ) . '</a>';
						}
					}
					$html[] = '';
					$html[] = '</div>';
				}
			}

			return implode( "\n", $html );
		}

		/**
		 * Create Render points.
		 *
		 * Loaded interface depends on which page is requested by client from server and request parameters like SMPNEW_action.
		 *
		 * @since  1.0
		 * @access protected
		 *
		 * @return void
		 */
		public function render()
		{

			$html[] = '
				<div class="SMPNEW_iw AArpr_plugin_iw" data-plugin_alias="SMPNEW">
					<div class="SMPNEW_iw-loader"><ul class="SMPNEW_iw-preloader"><li></li><li></li><li></li><li></li><li></li></ul><span></span></div>';

			// lang messages
			require $this->path( 'ASSETS_DIR', 'lists.inc.php' );
			$html[] = '<div id="SMPNEW-mainlang-translation" style="display: none;">' . htmlentities(json_encode( $lang )) . '</div>';

			$html[] = '<aside>';
			$html[] = 	'<a id="SMPNEW_iw-logo" href="' . ( admin_url( 'admin.php?page=SMPNEW&SMPNEW_action=about' ) ) . '"><img src="' . ( SMPNEW_asset_url( 'images/relazon.png' ) ) . '" /></a>';

			$html[] = 	$this->output_menu_section(
				array(

				/*
					'dashboard' => array(
							'links'		=> array(
								'dashboard' 	=> array(
									'url' 	=> '%app_root%',
									'label'	=> 'dashboard',
									'icon'	=> 'fa-tachometer'
								)
							)
						),*/


					'import' => array(
						'label' 	=> 'Utilities',
						'links'		=> array(
							'main' 	=> array(
								'url' 	=> '%app_root%&SMPNEW_action=main',
								'label'	=> 'Plugin Setup',
								'icon'	=> 'fa-cogs'
							),
						)
					),
					'plugin' => array(
						'label' 	=> 'Status',
						'links'		=> array(
							'about' 	=> array(
								'url' 	=> '%app_root%&SMPNEW_action=about',
								'label'	=> 'About & Activation',
								'icon'	=> 'fa-info-circle'
							)
						)
					)
				)
			);


			$html[] = '<span id="SMPNEW-version">Version: ' . ( SMPNEW_VERSION ) . ' by <a href="http://www.aa-team.com">AA-Team</a></span>';

			$html[] = '</aside>';

			$html[] = '<section>';

			if( SMPNEW_action() == 'about' ){
				$html[] = 	'
					<div class="SMPNEW_iw-header">
						<h3>About</h3>
					</div>';

				$html[] = $this->about->print_interface();
			}

			else if( SMPNEW_action() == 'dashboard' ){
				$html[] = 	'
					<div class="SMPNEW_iw-header">
						<h3>Dashboard</h3>
					</div>';

				$html[] = $this->dashboard->print_interface();
			}

			else if( SMPNEW_action() == 'main' ){

				$html[] = 	'
					<div class="SMPNEW_iw-header">
						<h3>Settings</h3>
					</div>';

				$html[] = $this->main->print_interface();
			}

			$html[] = '</section>';

			$html[] = '</div>';

			echo implode( "\n", $html );
		}

		/**
		 * Print SMPNEW interface
		 *
		*/
		public function print_interface()
		{
			$html = array();

		}

		/**
		 * Set SMPNEW mode.
		 *
		 * Mode depends on which page is requested by client from server and request parameters like SMPNEW_action.
		 *
		 * @since  1.0
		 * @access protected
		 *
		 * @return void
		 */
		protected function setMode()
		{
			if ( is_admin() ) {
				$this->mode = 'admin';
			} else {
				$this->mode = 'frontend';
			}
		}

		/**
		 * Sets version of the SMPNEW in DB as option `SMPNEW_VERSION`
		 *
		 * @since 1.0
		 * @access protected
		 *
		 * @return void
		 */
		protected function setVersion()
		{
			$version = get_option( 'SMPNEW_VERSION' );
			if ( ! is_string( $version ) || version_compare( $version, SMPNEW_VERSION ) !== 0 ) {
				//add_action( 'SMPNEW_after_init', array( SMPNEW_settings(), 'rebuild' ) );
				update_option( 'SMPNEW_VERSION', SMPNEW_VERSION );
			}
		}

		/**
		 * Get current mode for SMPNEW.
		 *
		 * @since  1.0
		 * @access public
		 *
		 * @return string
		 */
		public function mode() {
			return $this->mode;
		}

		/**
		 * Setter for paths
		 *
		 * @since  1.0
		 * @access protected
		 *
		 * @param $paths
		 */
		protected function setPaths( $paths ) {
			$this->paths = $paths;
		}

		/**
		 * Gets absolute path for file/directory in filesystem.
		 *
		 * @since  1.0
		 * @access public
		 *
		 * @param $name - name of path dir
		 * @param string $file - file name or directory inside path
		 *
		 * @return string
		 */
		public function path( $name, $file = '' ) {
			$path = $this->paths[ $name ] . ( strlen( $file ) > 0 ? '/' . preg_replace( '/^\//', '', $file ) : '' );

			return apply_filters( 'SMPNEW_path_filter', $path );
		}

		/**
		 * Set default post types. SMPNEW editors are enabled for such kind of posts.
		 *
		 * @param array $type - list of default post types.
		 */
		public function setEditorDefaultPostTypes( array $type ) {
			$this->editor_default_post_types = $type;
		}

		/**
		 * Returns list of default post types where user can use SMPNEW editors.
		 *
		 * @since  1.0
		 * @access public
		 *
		 * @return array
		 */
		public function editorDefaultPostTypes() {
			return $this->editor_default_post_types;
		}

		/**
		 * Get post types where SMPNEW editors are enabled.
		 *
		 * @since  1.0
		 * @access public
		 *
		 * @return array
		 */
		public function editorPostTypes()
		{
			if ( ! isset( $this->editor_post_types ) ) {
				$pt_array = SMPNEW_settings()->get( 'content_types' );
				$this->editor_post_types = $pt_array ? $pt_array : $this->editorDefaultPostTypes();
			}

			return $this->editor_post_types;
		}

		/**
		 * Setter for as network plugin for MultiWP.
		 *
		 * @since  1.0
		 * @access public
		 *
		 * @param bool $value
		 */
		public function setAsNetworkPlugin( $value = true )
		{
			$this->is_network_plugin = $value;
		}

		/**
		 * Directory name where template files will be stored.
		 *
		 * @since  1.0
		 * @access public
		 *
		 * @return string
		 */
		public function uploadDir()
		{
			return 'templates';
		}

		/**
		 * Getter for plugin name variable.
		 * @since 1.0
		 *
		 * @return string
		 */
		public function pluginName()
		{
			return $this->plugin_name;
		}

		/**
		 * Get absolute url for SMPNEW asset file.
		 *
		 * Assets are css, javascript, less files and images.
		 *
		 * @since 4.2
		 *
		 * @param $file
		 *
		 * @return string
		 */
		public function includeUrl( $file )
		{
			return preg_replace( '/\s/', '%20', plugins_url( $this->path( 'INCLUDE_DIR_NAME', $file ), __FILE__  ) );
		}

		/**
		 * Get absolute url for SMPNEW asset file.
		 *
		 * Assets are css, javascript, less files and images.
		 *
		 * @since 4.2
		 *
		 * @param $file
		 *
		 * @return string
		 */
		public function assetUrl( $file )
		{
			return preg_replace( '/\s/', '%20', plugins_url( $this->path( 'ASSETS_DIR_NAME', $file ), __FILE__ ) );
		}

		public function mb_unserialize($serial_str)
		{
	        static $adds_slashes = -1;
	        if ($adds_slashes === -1) // Check if preg replace adds slashes
	            $adds_slashes = (false !== strpos( preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", 's:1:""";'), '\"' ));

	        $result = @unserialize( preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $serial_str) );
	        return ( $adds_slashes ? stripslashes_deep( $result ) : $result );
	    }

		public function print_filters_for( $hook = '' )
		{
		    global $wp_filter;
		    if( empty( $hook ) || !isset( $wp_filter[$hook] ) )
		        return;
		}


	    public function admin_load_styles()
	    {
	        // admin notices - css styles
	        wp_enqueue_style( 'SMPNEW-admin-notices-style', SMPNEW_asset_url( 'css/admin_notices.css' ), array(), SMPNEW_VERSION );

	        // admin notices - html box
	        add_action( 'admin_notices', array( $this, 'admin_install_notice' ) );
	    }

	    public function admin_load_scripts() {
	    }

	    public function admin_install_notice()
	    {
	    ?>
	        <div id="SMPNEW-admin-mainnotices" class="updated SMPNEWFrm-message_activate wc-connect" style="display: none;">
	            <div class="options" style="display: none;">
	            </div>
	            <div class="squeezer">
	                <h4><?php _e( '<strong>WordPress Popups</strong> &#8211; Notices: ', $this->localizationName ); ?></h4>
	                <p class="adblock" style="display: none;">Adblock is blocking ads on this page</p>
	            </div>
	        </div>
	    <?php
	    }

	    public function template_path()
	    {
	    	 return apply_filters( 'SMPNEW_template_path', 'templates/' );
	    }

		public function print_pagination( $wp_query=array() )
		{
			$html = array();
			if( $wp_query->post_count < $wp_query->found_posts ) {

				$big = 999999999; // need an unlikely integer
				$links = paginate_links( array(
					'base' => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $wp_query->max_num_pages,
					'prev_next' => false,
					'type' => 'list',
					'end_size'     => 3,
					'mid_size'     => 3
				) );

				$html[] = '<hr />';
				$html[] = '<div class="blog_row">';
				$html[] = 	'<nav class="post-pagination">';
				$html[] = 		$links;
				$html[] = 		'<span class="smpnew-pages-nb">Page ' . ( max( 1, get_query_var('paged') ) ) . ' of ' . ( $wp_query->max_num_pages ) . '</span>';
				$html[] = 	'</nav>';
				$html[] = '</div>';
			}

			return implode( "\n", $html );
		}

		public function get_pages()
		{
			$_pages = array();
			$pages = get_pages();
			if( $pages && count($pages) > 0 ){
		  		foreach ( $pages as $page ) {
		  			$_pages[$page->ID] = $page->post_title;
		  		}
		  	}

		  	return $_pages;
		}

		public function ajax_register()
		{
			parse_str( $_REQUEST['params'], $params );

			$ipc = isset($params['SMPNEW_iw-validation-token']) ? $params['SMPNEW_iw-validation-token'] : '';
			$email = isset($params['SMPNEW_iw-validation-email']) ? $params['SMPNEW_iw-validation-email'] : '';

			$link = "http://cc.aa-team.com/validation/validate.php?ipc=%s&email=%s&app=" . $this->alias;
			$aa_server_response = wp_remote_retrieve_body( wp_remote_get( sprintf( $link, $ipc, $email ) ) );
			if( $aa_server_response ){
				$aa_server_response = json_decode( $aa_server_response, true );
				if( $aa_server_response ){

					if( $aa_server_response['status'] == 'valid' ){
						if( isset($aa_server_response['html']) ){
							update_option( "_" . $this->alias . "_register_html", $aa_server_response['html'] );

							die( json_encode( array( 'status' => 'valid' ) ));
						}
					}
				}
			}
		}

		public function settings() {
            $this->amz_settings = @maybe_unserialize( get_option( 'SMPNEW_Main_Settings', true ) );
			$this->amz_settings = !empty($this->amz_settings) && is_array($this->amz_settings) ? $this->amz_settings : array();
			$this->build_amz_settings();

			//$this->amz_settings['country'] = isset($this->amz_settings['amz_country_default']) ? $this->amz_settings['amz_country_default'] : 'com';

			$settings = $this->amz_settings;
			return $settings;
		}



		/************************************************************************
		 * START PLUGIN
		 ************************************************************************/

		public function build_amz_settings( $new=array() ) {
			if ( !empty($new) && is_array($new) ) {
				$this->amz_settings = array_replace_recursive($this->amz_settings, $new);
			}
			return $this->amz_settings;
		}

		/************************************************************************
		 * END PLUGIN
		 ************************************************************************/
	}

	/**
	 * Main SMPNEW manager.
	 * @var SMPNEW $SMPNEW - instance of composer management.
	 * @since 1.0
	 */
	global $SMPNEW;
	$SMPNEW = new SMPNEW();
}
