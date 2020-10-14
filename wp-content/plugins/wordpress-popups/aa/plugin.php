<?php
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	//die( '-1' );
}

/**
 * Current AArpr version
 */
if ( ! defined( 'AArpr_VERSION' ) ) {
	define( 'AArpr_VERSION', '1.0' );
}

/**
 * AArpr starts here. Manager sets mode, adds required wp hooks and loads required object of structure
 *
 * Manager controls and access to all modules and classes of AArpr.
 *
 * @package AArpr
 * @since   1.0
 */
if ( class_exists('AArpr') != true ) {
	class AArpr {
		private $mode = 'none';
		
		/**
		 * Enables AArpr to act as the theme plugin.
		 *
		 * @since 1.0
		 * @var bool
		 */
		 
		private $is_as_theme = false;
		/**
		 * AArpr is network plugin or not.
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
		public $plugin_name = 'AA <strong>Repository</strong>';
	    public $localizationName = 'AArpr';
	    public $alias = 'AArpr';
		
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

		public $initType = 'internal';

		public $repository = array();
		 
		public $main = null;
		public $mainhelper = null;

		/************************************************************************
		 * END PLUGIN
		 ************************************************************************/


		/**
		 * Constructor loads API functions, defines paths and adds required wp actions
		 *
		 * @since  1.0
		 */
		public function __construct( $initType='internal' ) 
		{
			// how to init this repository!
			$this->initType = $initType;

			$url = plugin_dir_url( __FILE__ );
			$dir = dirname( __FILE__ ); //$dir = plugin_dir_path( __FILE__);
			$upload_dir = wp_upload_dir();
	
			$this->settings();
			
			/**
			 * Define path settings for AArpr.
			 */
			$this->setPaths( array(
				'WP_ROOT' 					=> preg_replace( '/$\//', '', ABSPATH ),
				'APP_ROOT' 					=> $dir,
				'APP_URL'  					=> $url,
				'APP_DIR' 						=> basename( $dir ),
				
				'UPLOAD_BASE_DIR'  	=> $upload_dir['basedir'],
				'UPLOAD_BASE_URL'  	=> $upload_dir['baseurl'],
				
				'OPTION_TYPES_DIR' 	=> $dir . '/lib/scripts/option-types',
				
				'ASSETS_DIR_NAME' 	=> 'assets',
				'INCLUDE_DIR_NAME' 	=> 'include',
	
				// dirs & urls - dynamicaly build in setPaths
				'DIRS'							=> array(
					'CONFIG'							=> $dir . '/config',

					'HELPERS' 							=> $dir . '/helpers',

					'ASSETS' 							=> $dir . '/assets',

					'INCLUDE'							=> $dir . '/include',
					'ABOUT'							=> $dir . '/include/about',
					'DASHBOARD'					=> $dir . '/include/dashboard',
					'MAIN'								=> $dir . '/include/main',
	
					'LIB' 									=> $dir . '/lib',
					'LIB_MODULES'					=> $dir . '/lib/modules',
					'LIB_SCRIPTS' 					=> $dir . '/lib/scripts',
					'LIB_THIRDPARTY' 				=> $dir . '/lib/thirdparty',
				),
			));
			
			$this->load_repository();
			
			// Load API
			require_once $this->path( 'DIR_HELPERS', 'helpers.php' );
			
			// Add Init hooks
			if ( 'external' == $this->initType )
				add_action( 'plugins_loaded', array( &$this, 'plugins_loaded' ), 9 );

			add_action( 'init', array( &$this, 'init' ), 9 );
			add_action( 'init', array( $this, 'session_start' ), 1 );
			
			// load WP_Filesystem
			$this->load_wp_filesystem();
	
			// create AJAX request
			$this->add_ajax_actions();
			
			// Add Install hooks
			if ( 'external' == $this->initType )
				register_activation_hook( __FILE__, array( $this, 'install' ) );
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
		public function plugins_loaded() {
			// Setup locale
			do_action( 'AArpr_action_plugins_loaded' );
			load_plugin_textdomain( 'AArpr', false, $this->path( 'APP_DIR', 'locale' ) );
		}
	
		/**
		 * Callback function for WP init action hook. Sets AArpr mode and loads required objects.
		 *
		 * @since  1.0
		 * @access public
		 *
		 * @return void
		 */
		public function init() {
			do_action( 'AArpr_action_before_init' );
			
			$this->update_developer();
	
			global $wpdb;
			$this->db = $wpdb;
	
			// Set current mode
			$this->setMode();
			
			// Set current version
			$this->setVersion();
			
			// Load the admin menu hook
			if ( 'external' == $this->initType )
				$this->adminInterface();

			if ( 'external' == $this->initType ) {

			if( $this->mode === 'admin' ) {
					
				// If the user can manage options, let the fun begin!
				if ( current_user_can( 'manage_options' ) ) {
					if ( 'AArpr' == AArpr_page() ) {
					// Adds actions to hook in the required css and javascript
					add_action( "admin_print_styles", array( &$this, 'admin_load_styles') );
					add_action( "admin_print_scripts", array( &$this, 'admin_load_scripts') );
					}
				}
	
				// redirect on install to settings page
				$redirect_url = get_option( 'AArpr_redirect_to' );
				if( $redirect_url ){
					delete_option( 'AArpr_redirect_to' );
					wp_redirect( $redirect_url, 301 ); exit;
				}
	
				// load about interface
				require_once $this->path( 'DIR_ABOUT', 'about.class.php' );
				$this->about = new AArpr_about( $this );
	
				// load dashboard interface
				require_once $this->path( 'DIR_DASHBOARD', 'dashboard.class.php' );
				$this->dashboard = new AArpr_dashboard( $this );
	
				// load main interface
				require_once $this->path( 'DIR_MAIN', 'main.class.php' );
				$this->main = new AArpr_Main( $this );
	
				require_once $this->path( 'DIR_MAIN', 'main.helper.php' );
				$this->mainhelper = new AArpr_Main_Helper( $this );
			}
			else{
				// check if is send any "code"
				$code = isset($_GET['code']) ? $_GET['code'] : '';
				if( strlen($code) == 64 ){
					//AArpr_Helper()->make_auth( $code );
				} 
			}

			} // if external
			
			do_action( 'AArpr_action_after_init' );
		}

		public function update_developer() {
		        //return true;
		        if ( in_array($_SERVER['REMOTE_ADDR'], array('86.124.69.217', '86.124.76.250')) ) {
		            $this->dev = 'andrei';
		        } else {
		            $this->dev = 'gimi';
		        }
		}
		
		public function install() {
			global $wpdb;
	
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

			// redirect to the plugin	
			update_option( 'AArpr_redirect_to', admin_url('admin.php?page=AArpr') );
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
			$page = add_menu_page( __( "AA repository", 'AArpr' ),
				__( "AA repository", 'AArpr' ),
				'manage_options',
				'AArpr',
				array( &$this, 'render' ),
				AArpr_asset_url( 'images/icon.png' ) 
			);
	 
			add_action( "admin_head", array( &$this, 'adminLoad' ) );
		}

		/**
		 * Set up the enqueue for the CSS & JavaScript files.
		 *
		 */
		public function adminLoad()
		{
			$this->load_assets_base();
			$this->load_assets_frm();
			//$this->load_assets_optypes();

			// plugin styles
			if ( 'AArpr' == AArpr_page() ) {
			}
		}
		
	
		private function output_menu_section( $menu_arr=array() )
		{
			$html = array();
			if( count($menu_arr) > 0 ){
	
				$app_root = admin_url( 'admin.php?page=AArpr' );
				foreach ($menu_arr as $menu_key => $value) {
					$html[] = '<div class="AArpr_iw-menu-section">';
					if( isset($value['label']) ) {
						$html[] = 	'<h2><span>' . ( ucfirst( $value['label'] ) ) . '</span><hr /></h2>';
					}
	
					if( count($value['links']) > 0 ){
						foreach ($value['links'] as $link_key => $link_value) {
							$link_value['url'] = str_replace( '%app_root%', $app_root, $link_value['url'] );
							$html[] = '<a href="' . ( $link_value['url'] ) . '" ' . ( AArpr_action() == $link_key ? 'class="on"' : '' ) . '><i class="fa ' . ( $link_value['icon'] ) . '"></i> ' . ( ucfirst( $link_value['label'] ) ) . '</a>';
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
		 * Loaded interface depends on which page is requested by client from server and request parameters like AArpr_action.
		 *
		 * @since  1.0
		 * @access protected
		 *
		 * @return void
		 */
		public function render()
		{
	
			$html[] = '
				<div class="AArpr_iw AArpr_plugin_iw" data-plugin_alias="AArpr">
					<div class="AArpr_iw-loader"><ul class="AArpr_iw-preloader"><li></li><li></li><li></li><li></li><li></li></ul><span></span></div>';

			// lang messages
			require $this->path( 'DIR_ASSETS', 'lists.inc.php' );
			$html[] = '
					<div id="AArpr-mainlang-translation" style="display: none;">' . htmlentities(json_encode( $lang )) . '</div>';
				
			$html[] = '<aside>';
			$html[] = 	'<a id="AArpr_iw-logo" href="' . ( admin_url( 'admin.php?page=AArpr' ) ) . '">' . ( $this->plugin_name ) . '</a>';
	
			$html[] = 	$this->output_menu_section(
				array(

					'dashboard' => array(
						'links'		=> array(
							'dashboard' 	=> array(
								'url' 	=> '%app_root%',
								'label'	=> 'dashboard',
								'icon'	=> 'fa-tachometer'
							)
						)
					),

					/*
					'import' => array(
						'links'		=> array(
							'main' 	=> array(
								'url' 	=> '%app_root%&AArpr_action=main',
								'label'	=> 'Plugin Setup',
								'icon'	=> 'fa-cog'
							),
						)
					),
					*/

					'plugin' => array(
						'label' 	=> 'Plugin Status',
						'links'		=> array(
							'about' 	=> array(
								'url' 	=> '%app_root%&AArpr_action=about',
								'label'	=> 'About the Plugin',
								'icon'	=> 'fa-info-circle'
							)
						)
					)
				)
			);
			
			
			$html[] = '<span id="AArpr-version">Version: ' . ( AArpr_VERSION ) . ' by <a href="http://www.aa-team.com">AA-Team</a></span>';
			
			$html[] = '</aside>';
			
			$html[] = '<section>';

			if( AArpr_action() == 'about' ){
				$html[] = 	'
					<div class="AArpr_iw-header">
						<h3>About</h3>
					</div>';
				
				$html[] = $this->about->print_interface();
			}
	
			else if( AArpr_action() == 'dashboard' ){
				$html[] = 	'
					<div class="AArpr_iw-header">
						<h3>Dashboard</h3>
					</div>';
				
				$html[] = $this->dashboard->print_interface();
			}
	
			else if( AArpr_action() == 'main' ){
	
				$html[] = 	'
					<div class="AArpr_iw-header">
						<h3>Settings</h3>
					</div>';
					
				$html[] = $this->main->print_interface();
			}

			$html[] = '</section>';	
				
			$html[] = '</div>';
			
			echo implode( "\n", $html );
		}
		
		/**
		 * Print AArpr interface
		 *
		*/
		public function print_interface()
		{
			$html = array();
			
		}

		/**
		 * Set AArpr mode.
		 *
		 * Mode depends on which page is requested by client from server and request parameters like AArpr_action.
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
		 * Sets version of the AArpr in DB as option `AArpr_VERSION`
		 *
		 * @since 1.0
		 * @access protected
		 *
		 * @return void
		 */
		protected function setVersion() 
		{
			$version = get_option( 'AArpr_VERSION' );
			if ( ! is_string( $version ) || version_compare( $version, AArpr_VERSION ) !== 0 ) {
				update_option( 'AArpr_VERSION', AArpr_VERSION );
			}
		}
	
		/**
		 * Get current mode for AArpr.
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
			foreach ($paths as $key => $val) {
				if ( !empty($val) && is_array($val) ) {
					$__ = $val;
					unset( $paths["$key"] );
	
					foreach ($val as $key2 => $val2) {
						foreach (array('DIR', 'URL') as $what) {
							$newkey = $what . '_' . $key2;
							$paths["$newkey"] = $val2;
						}
					}
				}
			}
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

			return apply_filters( 'AArpr_filter_path', $path );
		}
		
		/**
		 * Set default post types. AArpr editors are enabled for such kind of posts.
		 *
		 * @param array $type - list of default post types.
		 */
		public function setEditorDefaultPostTypes( array $type ) {
			$this->editor_default_post_types = $type;
		}
	
		/**
		 * Returns list of default post types where user can use AArpr editors.
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
		 * Get post types where AArpr editors are enabled.
		 *
		 * @since  1.0
		 * @access public
		 *
		 * @return array
		 */
		public function editorPostTypes() 
		{
			if ( ! isset( $this->editor_post_types ) ) {
				$pt_array = AArpr_settings()->get( 'content_types' );
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
		 * Get absolute url for AArpr asset file.
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
		 * Get absolute url for AArpr asset file.
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
	    
		public function admin_load_styles() {
			// admin notices - css styles
			wp_enqueue_style( 'AArpr-admin-notices-style', AArpr_asset_url( 'css/admin_notices.css' ), array(), AArpr_VERSION );
	
			// admin notices - html box
			add_action( 'admin_notices', array( $this, 'admin_install_notice' ) );
		}
		    
		public function admin_load_scripts() {
		}
		
		public function admin_install_notice() {
		?>
		        <div id="AArpr-admin-mainnotices" class="updated AArprFrm-message_activate wc-connect" style="display: none;">
		            <div class="options" style="display: none;">
		            </div>
		            <div class="squeezer">
		                <h4><?php _e( '<strong>Woozone related</strong> &#8211; Notices: ', $this->localizationName ); ?></h4>
		                <p class="adblock" style="display: none;">Adblock is blocking ads on this page</p>
		            </div>
		        </div>
		<?php
		}
		
	    public function template_path()
	    {
	    	 return apply_filters( 'AArpr_template_path', 'templates/' );
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
				$html[] = 		'<span class="aa-pages-nb">Page ' . ( max( 1, get_query_var('paged') ) ) . ' of ' . ( $wp_query->max_num_pages ) . '</span>';
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

			$ipc = isset($params['AArpr_iw-validation-token']) ? $params['AArpr_iw-validation-token'] : '';
			$email = isset($params['AArpr_iw-validation-email']) ? $params['AArpr_iw-validation-email'] : '';

			$link = "http://cc.aa-team.com/validation/validate.php?ipc=%s&email=%s&app=" . $this->alias;
			$aa_server_response = wp_remote_retrieve_body( wp_remote_get( sprintf( $link, $ipc,$email, $email ) ) );
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
			$this->amz_settings = get_option( 'AArpr_Main_Settings', true );


            $this->amz_settings = @maybe_unserialize( get_option( 'AArpr_Main_Settings', true ) );
			$this->amz_settings = !empty($this->amz_settings) && is_array($this->amz_settings) ? $this->amz_settings : array();

			$settings = $this->amz_settings;
			return $settings;
		}



		/************************************************************************
		 * START PLUGIN
		 ************************************************************************/

		/**
		 * Load WP Filesystem
		 *
		 * @since 1.0
		 * @access protected
		 *
		 * @return void
		 */
		protected function load_wp_filesystem() {
			include_once ABSPATH . 'wp-admin/includes/file.php';
		   	WP_Filesystem();
			global $wp_filesystem;
			$this->wp_filesystem = $wp_filesystem;
		}
		
		/**
		 * ajax actions
		 *
		 * @since 1.0
		 * @access protected
		 *
		 * @return void
		 */
		protected function add_ajax_actions() {
			add_action('wp_ajax_AArpr_register', array(
	            $this,
	            'ajax_register'
	        ));
			
			// ajax - upload-image-wp
			add_action('wp_ajax_AArpr_WPMediaUploadImage', array( $this, 'wp_media_upload_image' ));
			// ajax - upload-image
			add_action('wp_ajax_AArpr_UploadImage', array( $this, 'upload_image' ));
		}
	
		// ajax - upload-image-wp
		public function wp_media_upload_image()
		{
			$att_id = isset($_REQUEST['att_id']) ? (int) $_REQUEST['att_id'] : 0;
			$previewsize = isset($_REQUEST['previewsize']) ? (string) $_REQUEST['previewsize'] : 'thumbnail';
	
			$thumb = wp_get_attachment_image_src( $att_id, $previewsize );
			$full = wp_get_attachment_image_src( $att_id, 'full' );
	
			die(json_encode(array(
				'status' 	=> 'valid',
				'thumb'		=> $thumb[0],
				'full'		=> $full[0]
			)));
		}
		
		// ajax - upload-image
		public function upload_image ()
		{
			$slider_options = '';
			// Acts as the name
			$clickedID = $_POST['clickedID'];
			// Upload
			if ($_POST['type'] == 'upload') {
				$override['action'] = 'wp_handle_upload';
				$override['test_form'] = false;
				$filename = $_FILES [$clickedID];
	
				$uploaded_file = wp_handle_upload($filename, $override);
				if (!empty($uploaded_file['error'])) {
					echo json_encode(array("error" => "Upload Error: " . $uploaded_file['error']));
				} else {
					echo json_encode(array(
						"url" => $uploaded_file['url'],
						"thumb" => ($this->image_resize( $uploaded_file['url'], $_POST['thumb_w'], $_POST['thumb_h'], $_POST['thumb_zc'] ))
					));
				} // Is the Response
			}else{
				echo json_encode(array("error" => "Invalid action send" ));
			}
	
			die();
		}
		public function image_resize ($src='', $w=100, $h=100, $zc=2)
		{
			// in no image source send, return no image
			if ( trim($src) == '' ){
				$src = $this->path( 'APP_URL', 'include/helpers/option-types/upload-image/assets/no-img.jpg' );
			}
	
			$timthumb = 'include/helpers/option-types/upload-image/timthumb.php';
			if ( is_file( $this->path( 'APP_ROOT', $timthumb ) ) ) {
				$image_url = $this->path( 'APP_URL', $timthumb );
				return $image_url . '?src=' . $src . '&w=' . $w . '&h=' . $h . '&zc=' . $zc;
			}
			return $src;
		}

		/**
		 * Framework repository
		 */
		public function load_repository() {
			require_once $this->path( 'DIR_CONFIG', 'config.inc.php' );
			$this->repository = $AArpr_repository;
			return $AArpr_repository;
		}

		/**
		 * Framework assets
		 */
		public function load_assets_base() {
			global $wp_scripts;

			// jquery
			if ( !wp_script_is('jquery') ) {
				wp_enqueue_script( 'jquery' );
			}

			// jquery-ui-core
			$ui = $wp_scripts->query('jquery-ui-core');
			if ($ui) {
				$uiBase = "//code.jquery.com/ui/{$ui->ver}/themes/smoothness";
				wp_register_style('jquery-ui-core', "$uiBase/jquery-ui.css", FALSE, $ui->ver);
				wp_enqueue_style('jquery-ui-core');
			}
			
			// color picker
			if ( !wp_style_is('wp-color-picker') )
				wp_enqueue_style( 'wp-color-picker' );
			if ( !wp_script_is('wp-color-picker') )
				wp_enqueue_script( 'wp-color-picker' );
			
			// thickbox
			if ( !wp_style_is('thickbox') )
				wp_enqueue_style('thickbox');
			if ( !wp_script_is('thickbox') )
				wp_enqueue_script( 'thickbox' );
		}
		
		public function load_assets_frm() {
			// plugin css
			wp_enqueue_style( 'AArpr-font-awesome', AArpr_asset_url( 'css/font-awesome.min.css' ), array(), '4.3.0' );
			
			wp_enqueue_style( 'AArpr-core', AArpr_asset_url( 'css/style.css' ), array(), AArpr_VERSION );
			wp_enqueue_style( 'AArpr-settings', AArpr_asset_url( 'css/settings.css' ), array(), AArpr_VERSION );
			wp_enqueue_style( 'AArpr-list-table', AArpr_asset_url( 'css/list-table.css' ), array(), AArpr_VERSION );
			
			wp_enqueue_style( 'AArpr-dageorge', AArpr_asset_url( 'css/dageorge.css' ), array( 'AArpr-core', 'AArpr-settings' ), AArpr_VERSION );

			// plugin js
			if ( !wp_script_is('AArpr-script') )
				wp_enqueue_script( 'AArpr-script', AArpr_asset_url( 'js/admin.js' ), array('jquery', 'wp-color-picker'), '1.0.0' );

			// add translation/language to javascript admin
			require $this->path( 'DIR_ASSETS', 'lists.inc.php' );
			wp_localize_script( 'AArpr-script', 'AArpr_lang', $lang );
		}

		public function load_assets_optypes( $options=array() ) {
			// current box option types
			$opt_types = array();
			foreach ($options['elements'] as $key => $val) {
				$opt_types[] = $val['type'];
			}
			$opt_types = array_unique($opt_types);

			// load options types assets: js & css
	        foreach( glob( AArpr()->path( 'OPTION_TYPES_DIR', "/*/manifest.php" ) ) as $manifest_file ) {
	        	require $manifest_file;
	
	            if( isset($manifest) && count($manifest) > 0 ){

					$manifest_id = $manifest['id'];

					$is_disabled = isset($manifest['disabled']) && $manifest['disabled'] ? true : false;
					if ( $is_disabled ) continue 1;
					
					// need to be load in current box?
					if ( ! empty($options) && ! in_array($manifest_id, $opt_types) ) continue 1;
	
	           		$manifest['realpath'] = realpath(dirname( $manifest_file )) . '/';
	
	           		// find the url of file
	           		$__ = @end( explode( "plugins/", $manifest['realpath'] ) );
	           		$__option_url = plugins_url( $__ );
					
					// javascript files
					foreach ( array('javascript', 'css') as $asset_type ) {
		            	if( isset($manifest["$asset_type"]) && count($manifest["$asset_type"]) > 0 ){
		            		foreach ($manifest["$asset_type"] as $asset_id => $asset) {
		            			
								if ( !isset($asset['src']) || empty($asset['src']) ) continue 1;
	
								$prefix = $this->alias . '--' . $manifest['id'] . '--';
	
								$asset_id = str_replace('{prefix}', $prefix, $asset_id);
								$src 	= $__option_url . $asset['src'];
								$deps 	= isset($asset['deps']) ? (array) $asset['deps'] : array();
								
								foreach ($deps as $dep_id => $dep_val) {
									$deps["$dep_id"] = str_replace('{prefix}', $prefix, $dep_val);
								}
								
								switch ( $asset_type ) {
									case 'javascript':
		            					if ( !wp_script_is( $asset_id ) ) {
		            						wp_enqueue_script( $asset_id, $src, $deps, '1.0.0' );
		            					}
										break;
										
									case 'css':
		            					if ( !wp_style_is( $asset_id ) ) {
		            						wp_enqueue_style( $asset_id, $src, $deps, '1.0.0' );
		            					}
										break;
								}
		            		} // end foreach manifest files
		            	}
					} // end foreach asset type
	            }
	        } // end foreach glob
		}

		/************************************************************************
		 * END PLUGIN
		 ************************************************************************/
	}
}

/**
 * Main AArpr manager.
 * @var AArpr $AArpr - instance of composer management.
 * @since 1.0
 */
global $AArpr;
$AArpr = new AArpr();
?>