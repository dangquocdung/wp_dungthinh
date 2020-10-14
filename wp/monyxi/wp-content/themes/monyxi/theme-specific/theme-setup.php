<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage MONYXI
 * @since MONYXI 1.0.22
 */

// If this theme is a free version of premium theme
if (!defined("MONYXI_THEME_FREE"))		define("MONYXI_THEME_FREE", false);
if (!defined("MONYXI_THEME_FREE_WP"))	define("MONYXI_THEME_FREE_WP", false);

// If this theme uses multiple skins
if (!defined("MONYXI_ALLOW_SKINS"))	define("MONYXI_ALLOW_SKINS", false);
if (!defined("MONYXI_DEFAULT_SKIN"))	define("MONYXI_DEFAULT_SKIN", 'default');

// Theme storage
// Attention! Must be in the global namespace to compatibility with WP CLI
$GLOBALS['MONYXI_STORAGE'] = array(

	// Theme required plugin's slugs
	'required_plugins' => array_merge(

		// List of plugins for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			// Required plugins
			// DON'T COMMENT OR REMOVE NEXT LINES!
			'trx_addons'					=> esc_html__('ThemeREX Addons', 'monyxi'),

			// If theme use OCDI instead (or both) ThemeREX Addons Installer
			

			// Recommended (supported) plugins for both (lite and full) versions
			// If plugin not need - comment (or remove) it
			'elementor'						=> esc_html__('Elementor', 'monyxi'),
			'contact-form-7'				=> esc_html__('Contact Form 7', 'monyxi'),
			'mailchimp-for-wp'				=> esc_html__('MailChimp for WP', 'monyxi'),
			'wp-gdpr-compliance'			=> esc_html__('WP GDPR Compliance', 'monyxi'),
            'trx_updater'			        => esc_html__('ThemeREX Updater', 'monyxi')
		),

		// List of plugins for the FREE version only
		//-----------------------------------------------------
		MONYXI_THEME_FREE 
			? array(
					//
					) 

		// List of plugins for the PREMIUM version only
		//-----------------------------------------------------
			: array(
					// Recommended (supported) plugins for the PRO (full) version
					// If plugin not need - comment (or remove) it
					'bbpress'					=> esc_html__('BBPress and BuddyPress', 'monyxi'),
					'essential-grid'			=> esc_html__('Essential Grid', 'monyxi'),
					'revslider'					=> esc_html__('Revolution Slider', 'monyxi'),
                    'instagram-feed'            => esc_html__('Smash Balloon Instagram Feed', 'monyxi'),
                    'search-filter'     		=> esc_html__('Search & Filter', 'monyxi'),
                    'wpgo-power-charts-lite'    => esc_html__('Power Charts Lite', 'monyxi'),
                    'learnpress'		       	=> esc_html__('Learnpress', 'monyxi'),
					)
	),

	// Theme-specific blog layouts
	'blog_styles' => array_merge(
		// Layouts for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			'excerpt'	=> array(
							'title'		=> esc_html__('Standard', 'monyxi'),
							'archive'	=> 'index-excerpt',
							'item'		=> 'content-excerpt',
							'styles'	=> 'excerpt'
							),
			'classic'	=> array(
							'title'		=> esc_html__('Classic', 'monyxi'),
							'archive'	=> 'index-classic',
							'item'		=> 'content-classic',
							'columns'	=> array(2,3),
							'styles'	=> 'classic'
							)
		),

		// Layouts for the FREE version only
		//-----------------------------------------------------
		MONYXI_THEME_FREE 
		? array() 

		// Layouts for the PREMIUM version only
		//-----------------------------------------------------
		: array(
			'masonry'	=> array(
							'title'		=> esc_html__('Masonry', 'monyxi'),
							'archive'	=> 'index-classic',
							'item'		=> 'content-classic',
							'columns'	=> array(2,3),
							'styles'	=> 'masonry'
							),
			'portfolio'	=> array(
							'title'		=> esc_html__('Portfolio', 'monyxi'),
							'archive'	=> 'index-portfolio',
							'item'		=> 'content-portfolio',
							'columns'	=> array(2,3,4),
							'styles'	=> 'portfolio'
							),
			'gallery'	=> array(
							'title'		=> esc_html__('Gallery', 'monyxi'),
							'archive'	=> 'index-portfolio',
							'item'		=> 'content-portfolio-gallery',
							'columns'	=> array(2,3,4),
							'styles'	=> array('portfolio', 'gallery')
							),
			'chess'	=> array(
							'title'		=> esc_html__('Chess', 'monyxi'),
							'archive'	=> 'index-chess',
							'item'		=> 'content-chess',
							'columns'	=> array(1,2,3),
							'styles'	=> 'chess'
							)
		)
	),

	// Key validator: market[env|loc]-vendor[axiom|ancora|themerex]
	'theme_pro_key'		=> MONYXI_THEME_FREE 
								? 'env-ancora'
								: '',

	// Theme-specific URLs (will be escaped in place of the output)
	'theme_demo_url'	=> 'http://monyxi.ancorathemes.com',
	'theme_doc_url'		=> 'http://monyxi.ancorathemes.com/doc',
    'theme_download_url'=> 'https://1.envato.market/c/1262870/275988/4415?subId1=ancora&u=themeforest.net/item/monyxi-cryptocurrency-trading-coach-wordpress-theme/22219932',

	'theme_support_url'	=> 'https://themerex.net/support',							// Ancora

	'theme_video_url'	=> 'https://www.youtube.com/channel/UCdIjRh7-lPVHqTTKpaf8PLA',	// Ancora

	// Comma separated slugs of theme-specific categories (for get relevant news in the dashboard widget)
	// (i.e. 'children,kindergarten')
	'theme_categories'  => '',

	// Responsive resolutions
	// Parameters to create css media query: min, max
	'responsive'		=> array(
						// By device
						'desktop'	=> array('min' => 1680),
						'notebook'	=> array('min' => 1280, 'max' => 1679),
						'tablet'	=> array('min' =>  768, 'max' => 1279),
						'mobile'	=> array('max' =>  767),
						// By size
						'xxl'		=> array('max' => 1679),
						'xl'		=> array('max' => 1439),
						'lg'		=> array('max' => 1279),
						'md'		=> array('max' => 1023),
						'sm'		=> array('max' =>  767),
						'sm_wp'		=> array('max' =>  600),
						'xs'		=> array('max' =>  479)
						)
);

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)

if ( !function_exists('monyxi_customizer_theme_setup1') ) {
	add_action( 'after_setup_theme', 'monyxi_customizer_theme_setup1', 1 );
	function monyxi_customizer_theme_setup1() {

		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		monyxi_storage_set('settings', array(

			'duplicate_options'		=> 'child',		// none  - use separate options for the main and the child-theme
													// child - duplicate theme options from the main theme to the child-theme only
													// both  - sinchronize changes in the theme options between main and child themes

			'customize_refresh'		=> 'auto',		// Refresh method for preview area in the Appearance - Customize:
													// auto - refresh preview area on change each field with Theme Options
													// manual - refresh only obn press button 'Refresh' at the top of Customize frame

			'max_load_fonts'		=> 5,			// Max fonts number to load from Google fonts or from uploaded fonts

			'comment_after_name'	=> true,		// Place 'comment' field after the 'name' and 'email'

			'icons_selector'		=> 'internal',	// Icons selector in the shortcodes:
													// standard VC (very slow) or Elementor's icons selector (not support images and svg)
													// internal - internal popup with plugin's or theme's icons list (fast and support images and svg)

			'icons_type'			=> 'icons',		// Type of icons (if 'icons_selector' is 'internal'):
													// icons  - use font icons to present icons
													// images - use images from theme's folder trx_addons/css/icons.png
													// svg    - use svg from theme's folder trx_addons/css/icons.svg

			'socials_type'			=> 'icons',		// Type of socials icons (if 'icons_selector' is 'internal'):
													// icons  - use font icons to present social networks
													// images - use images from theme's folder trx_addons/css/icons.png
													// svg    - use svg from theme's folder trx_addons/css/icons.svg

			'instagram_app'			=> 'client',	// Use internal Instagram App or user must create own application
													// to display photos from his account
													// internal - use our application
													// client   - user must create own application
			
			'check_min_version'		=> true,		// Check if exists a .min version of .css and .js and return path to it
													// instead the path to the original file
													// (if debug_mode is off and modification time of the original file < time of the .min file)

			'autoselect_menu'		=> true,		// Show any menu if no menu selected in the location 'main_menu'
													// (for example, the theme is just activated)

			'disable_jquery_ui'		=> false,		// Prevent loading custom jQuery UI libraries in the third-party plugins
		
			'use_mediaelements'		=> true,		// Load script "Media Elements" to play video and audio
			
			'tgmpa_upload'			=> false,		// Allow upload not pre-packaged plugins via TGMPA
			
			'allow_no_image'		=> false,		// Allow use image placeholder if no image present in the blog, related posts, post navigation, etc.

			'separate_schemes'		=> true, 		// Save color schemes to the separate files __color_xxx.css (true) or append its to the __custom.css (false)

			'allow_fullscreen'		=> false, 		// Allow cases 'fullscreen' and 'fullwide' for the body style in the Theme Options
													// In the Page Options this styles are present always (can be removed if filter 'monyxi_filter_allow_fullscreen' return false)

			'attachments_navigation'=> false 		// Add arrows on the single attachment page to navigate to the prev/next attachment
		));


		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		
		monyxi_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Exo 2',
				'family' => 'sans-serif',
				'styles' => '100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900'		// Parameter 'style' used only for the Google fonts
				),
			// Font-face packed with theme




		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		monyxi_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		// Attention! Font name in the parameter 'font-family' will be enclosed in the quotes and no spaces after comma!
		
		
		

		monyxi_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'monyxi'),
				'description'		=> esc_html__('Font settings of the main text of the site. Attention! For correct display of the site on mobile devices, use only units "rem", "em" or "ex"', 'monyxi'),
				'font-family'		=> '"Exo 2",sans-serif',
				'font-size' 		=> '1rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.64em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1.65em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'monyxi'),
                'font-family'		=> '"Exo 2",sans-serif',
				'font-size' 		=> '3.000em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '1.7em',
				'margin-bottom'		=> '0.455em'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'monyxi'),
                'font-family'		=> '"Exo 2",sans-serif',
				'font-size' 		=> '2.250em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.27em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '2.6em',
				'margin-bottom'		=> '0.58em'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'monyxi'),
                'font-family'		=> '"Exo 2",sans-serif',
				'font-size' 		=> '1.875em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.27em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '2.95em',
				'margin-bottom'		=> '0.59em'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'monyxi'),
                'font-family'		=> '"Exo 2",sans-serif',
				'font-size' 		=> '1.5em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.28em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '3.72em',
				'margin-bottom'		=> '0.56em'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'monyxi'),
                'font-family'		=> '"Exo 2",sans-serif',
				'font-size' 		=> '1.125em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.35em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '4.55em',
				'margin-bottom'		=> '0.64em'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'monyxi'),
                'font-family'		=> '"Exo 2",sans-serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.3em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '4.95em',
				'margin-bottom'		=> '0.65em'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'monyxi'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'monyxi'),
                'font-family'		=> '"Exo 2",sans-serif',
				'font-size' 		=> '1.8em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'monyxi'),
                'font-family'		=> '"Exo 2",sans-serif',
				'font-size' 		=> '16px',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '20px',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0'
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'monyxi'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'monyxi'),
				'font-family'		=> 'inherit',
				'font-size' 		=> '1em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',	// Attention! Firefox don't allow line-height less then 1.5em in the select
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'monyxi'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'monyxi'),
				'font-family'		=> 'inherit',
				'font-size' 		=> '14px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'monyxi'),
				'description'		=> esc_html__('Font settings of the main menu items', 'monyxi'),
                'font-family'		=> '"Exo 2",sans-serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'monyxi'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'monyxi'),
                'font-family'		=> '"Exo 2",sans-serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		monyxi_storage_set('scheme_color_groups', array(
			'main'	=> array(
							'title'			=> esc_html__('Main', 'monyxi'),
							'description'	=> esc_html__('Colors of the main content area', 'monyxi')
							),
			'alter'	=> array(
							'title'			=> esc_html__('Alter', 'monyxi'),
							'description'	=> esc_html__('Colors of the alternative blocks (sidebars, etc.)', 'monyxi')
							),
			'extra'	=> array(
							'title'			=> esc_html__('Extra', 'monyxi'),
							'description'	=> esc_html__('Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'monyxi')
							),
			'inverse' => array(
							'title'			=> esc_html__('Inverse', 'monyxi'),
							'description'	=> esc_html__('Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'monyxi')
							),
			'input'	=> array(
							'title'			=> esc_html__('Input', 'monyxi'),
							'description'	=> esc_html__('Colors of the form fields (text field, textarea, select, etc.)', 'monyxi')
							),
			)
		);
		monyxi_storage_set('scheme_color_names', array(
			'bg_color'	=> array(
							'title'			=> esc_html__('Background color', 'monyxi'),
							'description'	=> esc_html__('Background color of this block in the normal state', 'monyxi')
							),
			'bg_hover'	=> array(
							'title'			=> esc_html__('Background hover', 'monyxi'),
							'description'	=> esc_html__('Background color of this block in the hovered state', 'monyxi')
							),
			'bd_color'	=> array(
							'title'			=> esc_html__('Border color', 'monyxi'),
							'description'	=> esc_html__('Border color of this block in the normal state', 'monyxi')
							),
			'bd_hover'	=>  array(
							'title'			=> esc_html__('Border hover', 'monyxi'),
							'description'	=> esc_html__('Border color of this block in the hovered state', 'monyxi')
							),
			'text'		=> array(
							'title'			=> esc_html__('Text', 'monyxi'),
							'description'	=> esc_html__('Color of the plain text inside this block', 'monyxi')
							),
			'text_dark'	=> array(
							'title'			=> esc_html__('Text dark', 'monyxi'),
							'description'	=> esc_html__('Color of the dark text (bold, header, etc.) inside this block', 'monyxi')
							),
			'text_light'=> array(
							'title'			=> esc_html__('Text light', 'monyxi'),
							'description'	=> esc_html__('Color of the light text (post meta, etc.) inside this block', 'monyxi')
							),
			'text_link'	=> array(
							'title'			=> esc_html__('Link', 'monyxi'),
							'description'	=> esc_html__('Color of the links inside this block', 'monyxi')
							),
			'text_hover'=> array(
							'title'			=> esc_html__('Link hover', 'monyxi'),
							'description'	=> esc_html__('Color of the hovered state of links inside this block', 'monyxi')
							),
			'text_link2'=> array(
							'title'			=> esc_html__('Link 2', 'monyxi'),
							'description'	=> esc_html__('Color of the accented texts (areas) inside this block', 'monyxi')
							),
			'text_hover2'=> array(
							'title'			=> esc_html__('Link 2 hover', 'monyxi'),
							'description'	=> esc_html__('Color of the hovered state of accented texts (areas) inside this block', 'monyxi')
							),
			'text_link3'=> array(
							'title'			=> esc_html__('Link 3', 'monyxi'),
							'description'	=> esc_html__('Color of the other accented texts (buttons) inside this block', 'monyxi')
							),
			'text_hover3'=> array(
							'title'			=> esc_html__('Link 3 hover', 'monyxi'),
							'description'	=> esc_html__('Color of the hovered state of other accented texts (buttons) inside this block', 'monyxi')
							)
			)
		);
		monyxi_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'monyxi'),
				'internal' => true,
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#ffffff', //ok
					'bd_color'			=> '#eaeaea', //ok
		
					// Text and links colors
					'text'				=> '#878785', //ok
					'text_light'		=> '#878785', //ok
					'text_dark'			=> '#1b1a13', //ok
					'text_link'			=> '#1b1a13', //ok
					'text_hover'		=> '#da2431', //ok
					'text_link2'		=> '#1b1a13', //ok
					'text_hover2'		=> '#fadc20', //ok
					'text_link3'		=> '#ddb837',
					'text_hover3'		=> '#da2431',
		
					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#ffffff', //ok
					'alter_bg_hover'	=> '#f1f1f1', //ok
					'alter_bd_color'	=> '#e5e5e5',
					'alter_bd_hover'	=> '#dadada',
					'alter_text'		=> '#333333',
					'alter_light'		=> '#b7b7b7',
					'alter_dark'		=> '#1d1d1d',
					'alter_link'		=> '#fe7259',
					'alter_hover'		=> '#72cfd5',
					'alter_link2'		=> '#8be77c',
					'alter_hover2'		=> '#80d572',
					'alter_link3'		=> '#eec432',
					'alter_hover3'		=> '#ddb837',
		
					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#1b1a13', //ok
					'extra_bg_hover'	=> '#28272e',
					'extra_bd_color'	=> '#34332f', //ok
					'extra_bd_hover'	=> '#3d3d3d',
					'extra_text'		=> '#878785', //ok
					'extra_light'		=> '#878785', //ok
					'extra_dark'		=> '#7c7c7a', //ok
					'extra_link'		=> '#ffffff', //ok
					'extra_hover'		=> '#da2431', //ok?
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#f4f4f3', //ok
					'input_bg_hover'	=> '#f4f4f3', //ok
					'input_bd_color'	=> '#eaeaea', //ok
					'input_bd_hover'	=> '#c8c8c8', //ok
					'input_text'		=> '#878785', //ok
					'input_light'		=> '#878785', //ok
					'input_dark'		=> '#1b1a13', //ok
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#67bcc1',
					'inverse_bd_hover'	=> '#5aa4a9',
					'inverse_text'		=> '#1d1d1d',
					'inverse_light'		=> '#333333',
					'inverse_dark'		=> '#000000',
					'inverse_link'		=> '#ffffff',
					'inverse_hover'		=> '#1d1d1d'
				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'monyxi'),
				'internal' => true,
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#1b1a13', //ok
					'bd_color'			=> '#3a3930', //ok
		
					// Text and links colors
					'text'				=> '#7c7c7a', //ok
					'text_light'		=> '#7c7c7a', //ok
					'text_dark'			=> '#ffffff', //ok
					'text_link'			=> '#ffffff', //ok
					'text_hover'		=> '#fadc20', //ok
					'text_link2'		=> '#ffffff', //ok
					'text_hover2'		=> '#da2431', //ok
					'text_link3'		=> '#ddb837',
					'text_hover3'		=> '#da2431',

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#2a2921', //ok
					'alter_bg_hover'	=> '#f1f1f1', //ok
					'alter_bd_color'	=> '#464646',
					'alter_bd_hover'	=> '#4a4a4a',
					'alter_text'		=> '#a6a6a6',
					'alter_light'		=> '#5f5f5f',
					'alter_dark'		=> '#ffffff',
					'alter_link'		=> '#fedd02', //ok
					'alter_hover'		=> '#fe7259',
					'alter_link2'		=> '#8be77c',
					'alter_hover2'		=> '#80d572',
					'alter_link3'		=> '#eec432',
					'alter_hover3'		=> '#ddb837',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#ffffff', //ok
					'extra_bg_hover'	=> '#f3f5f7', //ok
					'extra_bd_color'	=> '#ebebeb', //ok
					'extra_bd_hover'	=> '#4a4a4a',
					'extra_text'		=> '#252525', //ok
					'extra_light'		=> '#7c7c7a', //ok
					'extra_dark'		=> '#878785', //ok
					'extra_link'		=> '#252525', //ok
					'extra_hover'		=> '#fadc20', //ok
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#2a2921', //ok
					'input_bg_hover'	=> '#2a2921', //ok
					'input_bd_color'	=> '#3b3b3b', //ok
					'input_bd_hover'	=> '#4a4a4a', //ok
					'input_text'		=> '#878785', //ok
					'input_light'		=> '#878785', //ok
					'input_dark'		=> '#ffffff', //ok
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#e36650',
					'inverse_bd_hover'	=> '#cb5b47',
					'inverse_text'		=> '#1d1d1d',
					'inverse_light'		=> '#5f5f5f',
					'inverse_dark'		=> '#000000',
					'inverse_link'		=> '#ffffff',
					'inverse_hover'		=> '#1d1d1d'
				)
			)
		
		));
		
		// Simple schemes substitution
		monyxi_storage_set('schemes_simple', array(
			// Main color	// Slave elements and it's darkness koef.
			'text_link'		=> array('alter_hover' => 1,	'extra_link' => 1, 'inverse_bd_color' => 0.85, 'inverse_bd_hover' => 0.7),
			'text_hover'	=> array('alter_link' => 1,		'extra_hover' => 1),
			'text_link2'	=> array('alter_hover2' => 1,	'extra_link2' => 1),
			'text_hover2'	=> array('alter_link2' => 1,	'extra_hover2' => 1),
			'text_link3'	=> array('alter_hover3' => 1,	'extra_link3' => 1),
			'text_hover3'	=> array('alter_link3' => 1,	'extra_hover3' => 1)
		));

		// Additional colors for each scheme
		// Parameters:	'color' - name of the color from the scheme that should be used as source for the transformation
		//				'alpha' - to make color transparent (0.0 - 1.0)
		//				'hue', 'saturation', 'brightness' - inc/dec value for each color's component
		monyxi_storage_set('scheme_colors_add', array(
			'bg_color_0'		=> array('color' => 'bg_color',			'alpha' => 0),
			'bg_color_02'		=> array('color' => 'bg_color',			'alpha' => 0.2),
			'bg_color_07'		=> array('color' => 'bg_color',			'alpha' => 0.7),
			'bg_color_08'		=> array('color' => 'bg_color',			'alpha' => 0.8),
			'bg_color_09'		=> array('color' => 'bg_color',			'alpha' => 0.9),
			'alter_bg_color_07'	=> array('color' => 'alter_bg_color',	'alpha' => 0.7),
			'alter_bg_color_04'	=> array('color' => 'alter_bg_color',	'alpha' => 0.4),
			'alter_bg_color_02'	=> array('color' => 'alter_bg_color',	'alpha' => 0.2),
			'alter_bd_color_02'	=> array('color' => 'alter_bd_color',	'alpha' => 0.2),
            'alter_bg_hover_02'	=> array('color' => 'alter_bg_hover',	'alpha' => 0.2),
            'alter_bg_hover_04'	=> array('color' => 'alter_bg_hover',	'alpha' => 0.4),
			'alter_link_02'		=> array('color' => 'alter_link',		'alpha' => 0.2),
			'alter_link_07'		=> array('color' => 'alter_link',		'alpha' => 0.7),
			'extra_bg_color_07'	=> array('color' => 'extra_bg_color',	'alpha' => 0.7),
			'extra_link_02'		=> array('color' => 'extra_link',		'alpha' => 0.2),
			'extra_link_07'		=> array('color' => 'extra_link',		'alpha' => 0.7),
			'text_dark_07'		=> array('color' => 'text_dark',		'alpha' => 0.7),
			'text_link_02'		=> array('color' => 'text_link',		'alpha' => 0.2),
			'text_hover_05'		=> array('color' => 'text_hover',		'alpha' => 0.5),
			'text_link_07'		=> array('color' => 'text_link',		'alpha' => 0.7),
			'text_hover2_09'		=> array('color' => 'text_hover2',		'alpha' => 0.9),
			'text_link_blend'	=> array('color' => 'text_link',		'hue' => 2, 'saturation' => -5, 'brightness' => 5),
			'alter_link_blend'	=> array('color' => 'alter_link',		'hue' => 2, 'saturation' => -5, 'brightness' => 5)
		));
		
		// Parameters to set order of schemes in the css
		monyxi_storage_set('schemes_sorted', array(
													'color_scheme', 'header_scheme', 'menu_scheme', 'sidebar_scheme', 'footer_scheme'
													));
		
		
		// -----------------------------------------------------------------
		// -- Theme specific thumb sizes
		// -----------------------------------------------------------------
		monyxi_storage_set('theme_thumbs', apply_filters('monyxi_filter_add_thumb_sizes', array(
			// Width of the image is equal to the content area width (without sidebar)
			// Height is fixed
			'monyxi-thumb-huge'		=> array(
												'size'	=> array(1170, 658, true),
												'title' => esc_html__( 'Huge image', 'monyxi' ),
												'subst'	=> 'trx_addons-thumb-huge'
												),
			// Width of the image is equal to the content area width (with sidebar)
			// Height is fixed
			'monyxi-thumb-big' 		=> array(
												'size'	=> array( 872, 491, true),
												'title' => esc_html__( 'Large image', 'monyxi' ),
												'subst'	=> 'trx_addons-thumb-big'
												),

			// Width of the image is equal to the 1/3 of the content area width (without sidebar)
			// Height is fixed
			'monyxi-thumb-med' 		=> array(
												'size'	=> array( 416, 234, true),
												'title' => esc_html__( 'Medium image', 'monyxi' ),
												'subst'	=> 'trx_addons-thumb-medium'
												),

			// Small square image (for avatars in comments, etc.)
			'monyxi-thumb-tiny' 		=> array(
												'size'	=> array(  90,  90, true),
												'title' => esc_html__( 'Small square avatar', 'monyxi' ),
												'subst'	=> 'trx_addons-thumb-tiny'
												),

			// Width of the image is equal to the content area width (with sidebar)
			// Height is proportional (only downscale, not crop)
			'monyxi-thumb-masonry-big' => array(
												'size'	=> array( 872,   0, false),		// Only downscale, not crop
												'title' => esc_html__( 'Masonry Large (scaled)', 'monyxi' ),
												'subst'	=> 'trx_addons-thumb-masonry-big'
												),

			// Width of the image is equal to the 1/3 of the full content area width (without sidebar)
			// Height is proportional (only downscale, not crop)
			'monyxi-thumb-masonry'		=> array(
												'size'	=> array( 370,   0, false),		// Only downscale, not crop
												'title' => esc_html__( 'Masonry (scaled)', 'monyxi' ),
												'subst'	=> 'trx_addons-thumb-masonry'
												),
            'monyxi-thumb-extra' 		=> array(
                                                'size'	=> array( 416, 268, true),
                                                'title' => esc_html__( 'Extra image', 'monyxi' ),
                                                'subst'	=> 'trx_addons-thumb-extra'
                                                )
			))
		);
	}
}




//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( !function_exists( 'monyxi_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options', 'monyxi_importer_set_options', 9 );
	function monyxi_importer_set_options($options=array()) {
		if (is_array($options)) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Allow import/export functionality
			$options['allow_import'] = true;
			$options['allow_export'] = true;
			// Prepare demo data
			$options['demo_url'] = esc_url(monyxi_get_protocol() . '://demofiles.ancorathemes.com/monyxi/');
			// Required plugins
			$options['required_plugins'] = array_keys(monyxi_storage_get('required_plugins'));
			// Set number of thumbnails to regenerate when its imported (if demo data was zipped without cropped images)
			// Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
			$options['regenerate_thumbnails'] = 3;
			// Default demo
			$options['files']['default']['title'] = esc_html__('Monyxi Demo', 'monyxi');
			$options['files']['default']['domain_dev'] = '';		// Developers domain
			$options['files']['default']['domain_demo']= esc_url(monyxi_get_protocol().'://monyxi.ancorathemes.com');		// Demo-site domain
			// If theme need more demo - just copy 'default' and change required parameter
			
			
			
			// Banners
			$options['banners'] = array(
				array(
					'image' => monyxi_get_file_url('theme-specific/theme-about/images/frontpage.png'),
					'title' => esc_html__('Front Page Builder', 'monyxi'),
					'content' => wp_kses(__("Create your front page right in the WordPress Customizer. There's no need any page builder. Simply enable/disable sections, fill them out with content, and customize to your liking.", 'monyxi'), 'monyxi_kses_content'),
					'link_url' => esc_url('//www.youtube.com/watch?v=VT0AUbMl_KA'),
					'link_caption' => esc_html__('Watch Video Introduction', 'monyxi'),
					'duration' => 20
					),
				array(
					'image' => monyxi_get_file_url('theme-specific/theme-about/images/layouts.png'),
					'title' => esc_html__('Layouts Builder', 'monyxi'),
					'content' => wp_kses(__('Use Layouts Builder to create and customize header and footer styles for your website. With a flexible page builder interface and custom shortcodes, you can create as many header and footer layouts as you want with ease.', 'monyxi'), 'monyxi_kses_content'),
					'link_url' => esc_url('//www.youtube.com/watch?v=pYhdFVLd7y4'),
					'link_caption' => esc_html__('Learn More', 'monyxi'),
					'duration' => 20
					),
				array(
					'image' => monyxi_get_file_url('theme-specific/theme-about/images/documentation.png'),
					'title' => esc_html__('Read Full Documentation', 'monyxi'),
					'content' => wp_kses(__('Need more details? Please check our full online documentation for detailed information on how to use Monyxi.', 'monyxi'), 'monyxi_kses_content'),
					'link_url' => esc_url(monyxi_storage_get('theme_doc_url')),
					'link_caption' => esc_html__('Online Documentation', 'monyxi'),
					'duration' => 15
					),
				array(
					'image' => monyxi_get_file_url('theme-specific/theme-about/images/video-tutorials.png'),
					'title' => esc_html__('Video Tutorials', 'monyxi'),
					'content' => wp_kses(__('No time for reading documentation? Check out our video tutorials and learn how to customize Monyxi in detail.', 'monyxi'), 'monyxi_kses_content'),
					'link_url' => esc_url(monyxi_storage_get('theme_video_url')),
					'link_caption' => esc_html__('Video Tutorials', 'monyxi'),
					'duration' => 15
					),
				array(
					'image' => monyxi_get_file_url('theme-specific/theme-about/images/studio.png'),
					'title' => esc_html__('Website Customization', 'monyxi'),
					'content' => wp_kses(__("Need a website fast? Order our custom service, and we'll build a website based on this theme for a very fair price. We can also implement additional functionality such as website translation, setting up WPML, and much more.", 'monyxi'), 'monyxi_kses_content'),
					esc_url('//themerex.net/offers/?utm_source=offers&utm_medium=click&utm_campaign=themeinstall'),
					'link_caption' => esc_html__('Contact Us', 'monyxi'),
					'duration' => 25
					)
				);
		}
		return $options;
	}
}


//------------------------------------------------------------------------
// OCDI support
//------------------------------------------------------------------------

// Set theme specific OCDI options
if ( !function_exists( 'monyxi_ocdi_set_options' ) ) {
	add_filter( 'trx_addons_filter_ocdi_options', 'monyxi_ocdi_set_options', 9 );
	function monyxi_ocdi_set_options($options=array()) {
		if (is_array($options)) {
			// Prepare demo data
			$options['demo_url'] = esc_url(monyxi_get_protocol() . '://demofiles.ancorathemes.com/monyxi/');
			// Required plugins
			$options['required_plugins'] = array_keys(monyxi_storage_get('required_plugins'));
			// Demo-site domain			
			$options['files']['ocdi']['title'] = esc_html__('Monyxi OCDI Demo', 'monyxi');
			$options['files']['ocdi']['domain_demo'] = esc_url(monyxi_get_protocol().'://monyxi.ancorathemes.com');
			// If theme need more demo - just copy 'default' and change required parameter
			
			
			
		}
		return $options;
	}
}


// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('monyxi_create_theme_options')) {

	function monyxi_create_theme_options() {

		// Message about options override. 
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override = esc_html__('Attention! Some of these options can be overridden in the following sections (Blog, Plugins settings, etc.) or in the settings of individual pages', 'monyxi');
		
		// Color schemes number: if < 2 - hide fields with selectors
		$hide_schemes = count(monyxi_storage_get('schemes')) < 2;
		
		monyxi_storage_set('options', array(
		
			// 'Logo & Site Identity'
			'title_tagline' => array(
				"title" => esc_html__('Logo & Site Identity', 'monyxi'),
				"desc" => '',
				"priority" => 10,
				"type" => "section"
				),
			'logo_info' => array(
				"title" => esc_html__('Logo in the header', 'monyxi'),
				"desc" => '',
				"priority" => 20,
				"type" => "info",
				),
			'logo_text' => array(
				"title" => esc_html__('Use Site Name as Logo', 'monyxi'),
				"desc" => wp_kses_data( __('Use the site title and tagline as a text logo if no image is selected', 'monyxi') ),
				"class" => "monyxi_column-1_2 monyxi_new_row",
				"priority" => 30,
				"std" => 1,
				"type" => MONYXI_THEME_FREE ? "hidden" : "checkbox"
				),
			'logo_retina_enabled' => array(
				"title" => esc_html__('Allow retina display logo', 'monyxi'),
				"desc" => wp_kses_data( __('Show fields to select logo images for Retina display', 'monyxi') ),
				"class" => "monyxi_column-1_2",
				"priority" => 40,
				"refresh" => false,
				"std" => 0,
				"type" => MONYXI_THEME_FREE ? "hidden" : "checkbox"
				),
			'logo_zoom' => array(
				"title" => esc_html__('Logo zoom', 'monyxi'),
				"desc" => wp_kses_data( __("Zoom the logo. 1 - original size. Maximum size of logo depends on the actual size of the picture", 'monyxi') ),
				"std" => 1,
				"min" => 0.2,
				"max" => 2,
				"step" => 0.1,
				"refresh" => false,
				"type" => MONYXI_THEME_FREE ? "hidden" : "slider"
				),
			// Parameter 'logo' was replaced with standard WordPress 'custom_logo'
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'monyxi'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'monyxi') ),
				"class" => "monyxi_column-1_2",
				"priority" => 70,
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => MONYXI_THEME_FREE ? "hidden" : "image"
				),
			'logo_mobile_header' => array(
				"title" => esc_html__('Logo for the mobile header', 'monyxi'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the mobile header (if enabled in the section "Header - Header mobile"', 'monyxi') ),
				"class" => "monyxi_column-1_2 monyxi_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_mobile_header_retina' => array(
				"title" => esc_html__('Logo for the mobile header for Retina', 'monyxi'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'monyxi') ),
				"class" => "monyxi_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => MONYXI_THEME_FREE ? "hidden" : "image"
				),
			'logo_mobile' => array(
				"title" => esc_html__('Logo mobile', 'monyxi'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the mobile menu', 'monyxi') ),
				"class" => "monyxi_column-1_2 monyxi_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_mobile_retina' => array(
				"title" => esc_html__('Logo mobile for Retina', 'monyxi'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'monyxi') ),
				"class" => "monyxi_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => MONYXI_THEME_FREE ? "hidden" : "image"
				),
			'logo_side' => array(
				"title" => esc_html__('Logo side', 'monyxi'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu', 'monyxi') ),
				"class" => "monyxi_column-1_2 monyxi_new_row",
				"std" => '',
				
				"type" => "hidden"
				),
			'logo_side_retina' => array(
				"title" => esc_html__('Logo side for Retina', 'monyxi'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'monyxi') ),
				"class" => "monyxi_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',

				"type" => 'hidden'
				),
			
		
		
			// 'General settings'
			'general' => array(
				"title" => esc_html__('General Settings', 'monyxi'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 20,
				"type" => "section",
				),

			'general_layout_info' => array(
				"title" => esc_html__('Layout', 'monyxi'),
				"desc" => '',
				"type" => "info",
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'monyxi'),
				"desc" => wp_kses_data( __('Select width of the body content', 'monyxi') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'monyxi')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => monyxi_get_list_body_styles(false),
				"type" => "select"
				),
			'page_width' => array(
				"title" => esc_html__('Page width', 'monyxi'),
				"desc" => wp_kses_data( __("Total width of the site content and sidebar (in pixels). If empty - use default width", 'monyxi') ),
				"dependency" => array(
					'body_style' => array('boxed', 'wide')
				),
				"std" => 1308,
				"min" => 1000,
				"max" => 1400,
				"step" => 10,
				"refresh" => false,
				"customizer" => 'page',			// SASS variable's name to preview changes 'on fly'
				"type" => MONYXI_THEME_FREE ? "hidden" : "slider"
				),
			'boxed_bg_image' => array(
				"title" => esc_html__('Boxed bg image', 'monyxi'),
				"desc" => wp_kses_data( __('Select or upload image, used as background in the boxed body', 'monyxi') ),
				"dependency" => array(
					'body_style' => array('boxed')
				),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'monyxi')
				),
				"std" => '',
				"hidden" => true,
				"type" => "image"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'monyxi'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'monyxi') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'monyxi')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),

			'general_sidebar_info' => array(
				"title" => esc_html__('Sidebar', 'monyxi'),
				"desc" => '',
				"type" => "info",
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'monyxi'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'monyxi') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'monyxi')
				),
				"std" => 'right',
				"options" => array(),
				"type" => "switch"
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'monyxi'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'monyxi') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'monyxi')
				),
				"dependency" => array(
					'sidebar_position' => array('left', 'right')
				),
				"std" => 'sidebar_widgets',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_width' => array(
				"title" => esc_html__('Sidebar width', 'monyxi'),
				"desc" => wp_kses_data( __("Width of the sidebar (in pixels). If empty - use default width", 'monyxi') ),
				"std" => 374,
				"min" => 150,
				"max" => 500,
				"step" => 10,
				"refresh" => false,
				"customizer" => 'sidebar',		// SASS variable's name to preview changes 'on fly'
				"type" => MONYXI_THEME_FREE ? "hidden" : "slider"
				),
			'sidebar_gap' => array(
				"title" => esc_html__('Sidebar gap', 'monyxi'),
				"desc" => wp_kses_data( __("Gap between content and sidebar (in pixels). If empty - use default gap", 'monyxi') ),
				"std" => 62,
				"min" => 0,
				"max" => 100,
				"step" => 1,
				"refresh" => false,
				"customizer" => 'gap',			// SASS variable's name to preview changes 'on fly'
				"type" => MONYXI_THEME_FREE ? "hidden" : "slider"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'monyxi'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'monyxi') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),


			'general_widgets_info' => array(
				"title" => esc_html__('Additional widgets', 'monyxi'),
				"desc" => '',
				"type" => MONYXI_THEME_FREE ? "hidden" : "info",
				),
			'widgets_above_page' => array(
				"title" => esc_html__('Widgets at the top of the page', 'monyxi'),
				"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'monyxi') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'monyxi')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => MONYXI_THEME_FREE ? "hidden" : "select"
				),
			'widgets_above_content' => array(
				"title" => esc_html__('Widgets above the content', 'monyxi'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'monyxi') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'monyxi')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => MONYXI_THEME_FREE ? "hidden" : "select"
				),
			'widgets_below_content' => array(
				"title" => esc_html__('Widgets below the content', 'monyxi'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'monyxi') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'monyxi')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => MONYXI_THEME_FREE ? "hidden" : "select"
				),
			'widgets_below_page' => array(
				"title" => esc_html__('Widgets at the bottom of the page', 'monyxi'),
				"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'monyxi') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'monyxi')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => MONYXI_THEME_FREE ? "hidden" : "select"
				),

			'general_effects_info' => array(
				"title" => esc_html__('Design & Effects', 'monyxi'),
				"desc" => '',
				"type" => "info",
				),
			'border_radius' => array(
				"title" => esc_html__('Border radius', 'monyxi'),
				"desc" => wp_kses_data( __("Specify the border radius of the form fields and buttons in pixels", 'monyxi') ),
				"std" => 0,
				"min" => 0,
				"max" => 20,
				"step" => 1,
				"refresh" => false,
				"customizer" => 'rad',		// SASS name to preview changes 'on fly'
				
				"type" => "hidden"
				),

			'general_misc_info' => array(
				"title" => esc_html__('Miscellaneous', 'monyxi'),
				"desc" => '',
				"type" => MONYXI_THEME_FREE ? "hidden" : "info",
				),
			'seo_snippets' => array(
				"title" => esc_html__('SEO snippets', 'monyxi'),
				"desc" => wp_kses_data( __('Add structured data markup to the single posts and pages', 'monyxi') ),
				"std" => 0,
				"type" => MONYXI_THEME_FREE ? "hidden" : "checkbox"
				),
            'privacy_text' => array(
                "title" => esc_html__("Text with Privacy Policy link", 'monyxi'),
                "desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'monyxi') ),
                "std"   => wp_kses( __( 'I agree that my submitted data is being collected and stored.', 'monyxi'), 'monyxi_kses_content' ),
                "type"  => "text"
            ),

		
			// 'Header'
			'header' => array(
				"title" => esc_html__('Header', 'monyxi'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 30,
				"type" => "section"
				),

			'header_style_info' => array(
				"title" => esc_html__('Header style', 'monyxi'),
				"desc" => '',
				"type" => "info"
				),
			'header_type' => array(
				"title" => esc_html__('Header style', 'monyxi'),
				"desc" => wp_kses_data( __('Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'monyxi') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'monyxi')
				),
				"std" => 'default',
				"options" => monyxi_get_list_header_footer_types(),
				"type" => MONYXI_THEME_FREE || !monyxi_exists_trx_addons() ? "hidden" : "switch"
				),
			'header_style' => array(
				"title" => esc_html__('Select custom layout', 'monyxi'),
				"desc" => wp_kses( __("Select custom header from Layouts Builder", 'monyxi'), 'monyxi_kses_content' ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'monyxi')
				),
				"dependency" => array(
					'header_type' => array('custom')
				),
				"std" => MONYXI_THEME_FREE ? 'header-custom-elementor-header-default' : 'header-custom-header-default',
				"options" => array(),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'monyxi'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'monyxi') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'monyxi')
				),
				"std" => 'default',
				"options" => array(),
				"type" => MONYXI_THEME_FREE ? "hidden" : "switch"
				),
			'header_fullheight' => array(
				"title" => esc_html__('Header fullheight', 'monyxi'),
				"desc" => wp_kses_data( __("Enlarge header area to fill whole screen. Used only if header have a background image", 'monyxi') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'monyxi')
				),
				"std" => 0,
				"type" => MONYXI_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_zoom' => array(
				"title" => esc_html__('Header zoom', 'monyxi'),
				"desc" => wp_kses_data( __("Zoom the header title. 1 - original size", 'monyxi') ),
				"std" => 1,
				"min" => 0.3,
				"max" => 2,
				"step" => 0.1,
				"refresh" => false,
				"type" => MONYXI_THEME_FREE ? "hidden" : "slider"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwidth', 'monyxi'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'monyxi') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'monyxi')
				),
				"dependency" => array(
					'header_type' => array('default')
				),
				"std" => 1,
				"type" => MONYXI_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_widgets_info' => array(
				"title" => esc_html__('Header widgets', 'monyxi'),
				"desc" => wp_kses_data( __('Here you can place a widget slider, advertising banners, etc.', 'monyxi') ),
				"type" => "info"
				),
			'header_widgets' => array(
				"title" => esc_html__('Header widgets', 'monyxi'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on each page', 'monyxi') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'monyxi'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on this page', 'monyxi') ),
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'header_columns' => array(
				"title" => esc_html__('Header columns', 'monyxi'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'monyxi') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'monyxi')
				),
				"dependency" => array(
					'header_type' => array('default'),
					'header_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => monyxi_get_list_range(0,6),
				"type" => "select"
				),

			'menu_info' => array(
				"title" => esc_html__('Main menu', 'monyxi'),
				"desc" => wp_kses_data( __('Select main menu style, position and other parameters', 'monyxi') ),
				"type" => MONYXI_THEME_FREE ? "hidden" : "info"
				),
			'menu_style' => array(
				"title" => esc_html__('Menu position', 'monyxi'),
				"desc" => wp_kses_data( __('Select position of the main menu', 'monyxi') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'monyxi')
				),
				"std" => 'top',
				"options" => array(
					'top'	=> esc_html__('Top',	'monyxi'),
					
					
				),
				"type" => MONYXI_THEME_FREE || !monyxi_exists_trx_addons() ? "hidden" : "switch"
				),
			'menu_side_stretch' => array(
				"title" => esc_html__('Stretch sidemenu', 'monyxi'),
				"desc" => wp_kses_data( __('Stretch sidemenu to window height (if menu items number >= 5)', 'monyxi') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'monyxi')
				),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 0,
				"type" => MONYXI_THEME_FREE ? "hidden" : "checkbox"
				),
			'menu_side_icons' => array(
				"title" => esc_html__('Iconed sidemenu', 'monyxi'),
				"desc" => wp_kses_data( __('Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'monyxi') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'monyxi')
				),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => MONYXI_THEME_FREE ? "hidden" : "checkbox"
				),
			'menu_mobile_fullscreen' => array(
				"title" => esc_html__('Mobile menu fullscreen', 'monyxi'),
				"desc" => wp_kses_data( __('Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'monyxi') ),
				"std" => 1,
				"type" => MONYXI_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_image_info' => array(
				"title" => esc_html__('Header image', 'monyxi'),
				"desc" => '',
				"type" => MONYXI_THEME_FREE ? "hidden" : "info"
				),
			'header_image_override' => array(
				"title" => esc_html__('Header image override', 'monyxi'),
				"desc" => wp_kses_data( __("Allow override the header image with the page's/post's/product's/etc. featured image", 'monyxi') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'monyxi')
				),
				"std" => 0,
				"type" => MONYXI_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_mobile_info' => array(
				"title" => esc_html__('Mobile header', 'monyxi'),
				"desc" => wp_kses_data( __("Configure the mobile version of the header", 'monyxi') ),
				"priority" => 500,
				"dependency" => array(
					'header_type' => array('default')
				),
				"type" => MONYXI_THEME_FREE ? "hidden" : "info"
				),
			'header_mobile_enabled' => array(
				"title" => esc_html__('Enable the mobile header', 'monyxi'),
				"desc" => wp_kses_data( __("Use the mobile version of the header (if checked) or relayout the current header on mobile devices", 'monyxi') ),
				"dependency" => array(
					'header_type' => array('default')
				),
				"std" => 0,
				"type" => MONYXI_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_additional_info' => array(
				"title" => esc_html__('Additional info', 'monyxi'),
				"desc" => wp_kses_data( __('Additional info to show at the top of the mobile header', 'monyxi') ),
				"std" => '',
				"dependency" => array(
					'header_type' => array('default'),
					'header_mobile_enabled' => array(1)
				),
				"refresh" => false,
				"teeny" => false,
				"rows" => 20,
				"type" => MONYXI_THEME_FREE ? "hidden" : "text_editor"
				),
			'header_mobile_hide_info' => array(
				"title" => esc_html__('Hide additional info', 'monyxi'),
				"std" => 0,
				"dependency" => array(
					'header_type' => array('default'),
					'header_mobile_enabled' => array(1)
				),
				"type" => MONYXI_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_logo' => array(
				"title" => esc_html__('Hide logo', 'monyxi'),
				"std" => 0,
				"dependency" => array(
					'header_type' => array('default'),
					'header_mobile_enabled' => array(1)
				),
				"type" => MONYXI_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_login' => array(
				"title" => esc_html__('Hide login/logout', 'monyxi'),
				"std" => 0,
				"dependency" => array(
					'header_type' => array('default'),
					'header_mobile_enabled' => array(1)
				),
				"type" => MONYXI_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_search' => array(
				"title" => esc_html__('Hide search', 'monyxi'),
				"std" => 0,
				"dependency" => array(
					'header_type' => array('default'),
					'header_mobile_enabled' => array(1)
				),
				"type" => MONYXI_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_cart' => array(
				"title" => esc_html__('Hide cart', 'monyxi'),
				"std" => 0,
				"dependency" => array(
					'header_type' => array('default'),
					'header_mobile_enabled' => array(1)
				),
				"type" => MONYXI_THEME_FREE ? "hidden" : "checkbox"
				),


		
			// 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'monyxi'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 50,
				"type" => "section"
				),
			'footer_type' => array(
				"title" => esc_html__('Footer style', 'monyxi'),
				"desc" => wp_kses_data( __('Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'monyxi') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'monyxi')
				),
				"std" => 'default',
				"options" => monyxi_get_list_header_footer_types(),
				"type" => MONYXI_THEME_FREE || !monyxi_exists_trx_addons() ? "hidden" : "switch"
				),
			'footer_style' => array(
				"title" => esc_html__('Select custom layout', 'monyxi'),
				"desc" => wp_kses( __("Select custom footer from Layouts Builder", 'monyxi'), 'monyxi_kses_content' ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'monyxi')
				),
				"dependency" => array(
					'footer_type' => array('custom')
				),
				"std" => MONYXI_THEME_FREE ? 'footer-custom-elementor-footer-default' : 'footer-custom-footer-default',
				"options" => array(),
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'monyxi'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'monyxi') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'monyxi')
				),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 'footer_widgets',
				"options" => array(),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'monyxi'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'monyxi') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'monyxi')
				),
				"dependency" => array(
					'footer_type' => array('default'),
					'footer_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => monyxi_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwidth', 'monyxi'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'monyxi') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'monyxi')
				),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_in_footer' => array(
				"title" => esc_html__('Show logo', 'monyxi'),
				"desc" => wp_kses_data( __('Show logo in the footer', 'monyxi') ),
				'refresh' => false,
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_footer' => array(
				"title" => esc_html__('Logo for footer', 'monyxi'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the footer', 'monyxi') ),
				"dependency" => array(
					'footer_type' => array('default'),
					'logo_in_footer' => array(1)
				),
				"std" => '',
				"type" => "image"
				),
			'logo_footer_retina' => array(
				"title" => esc_html__('Logo for footer (Retina)', 'monyxi'),
				"desc" => wp_kses_data( __('Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'monyxi') ),
				"dependency" => array(
					'footer_type' => array('default'),
					'logo_in_footer' => array(1),
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => MONYXI_THEME_FREE ? "hidden" : "image"
				),
			'socials_in_footer' => array(
				"title" => esc_html__('Show social icons', 'monyxi'),
				"desc" => wp_kses_data( __('Show social icons in the footer (under logo or footer widgets)', 'monyxi') ),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => !monyxi_exists_trx_addons() ? "hidden" : "checkbox"
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'monyxi'),
				"desc" => wp_kses_data( __('Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'monyxi') ),
				"translate" => true,
				"std" => esc_html__('AncoraThemes &copy; {Y}. All rights reserved.', 'monyxi'),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"refresh" => false,
				"type" => "textarea"
				),
			
		
		
			// 'Blog'
			'blog' => array(
				"title" => esc_html__('Blog', 'monyxi'),
				"desc" => wp_kses_data( __('Options of the the blog archive', 'monyxi') ),
				"priority" => 70,
				"type" => "panel",
				),
		
				// Blog - Posts page
				'blog_general' => array(
					"title" => esc_html__('Posts page', 'monyxi'),
					"desc" => wp_kses_data( __('Style and components of the blog archive', 'monyxi') ),
					"type" => "section",
					),
				'blog_general_info' => array(
					"title" => esc_html__('General settings', 'monyxi'),
					"desc" => '',
					"type" => "info",
					),
				'blog_style' => array(
					"title" => esc_html__('Blog style', 'monyxi'),
					"desc" => '',
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'monyxi')
					),
					"dependency" => array(
                        '#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"std" => 'excerpt',
					"options" => array(),
					"type" => "select"
					),
				'first_post_large' => array(
					"title" => esc_html__('First post large', 'monyxi'),
					"desc" => wp_kses_data( __('Make your first post stand out by making it bigger', 'monyxi') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'monyxi')
					),
					"dependency" => array(
                        '#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
						'blog_style' => array('classic', 'masonry')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				"blog_content" => array( 
					"title" => esc_html__('Posts content', 'monyxi'),
					"desc" => wp_kses_data( __("Display either post excerpts or the full post content", 'monyxi') ),
					"std" => "excerpt",
					"dependency" => array(
						'blog_style' => array('excerpt')
					),
					"options" => array(
						'excerpt'	=> esc_html__('Excerpt',	'monyxi'),
						'fullpost'	=> esc_html__('Full post',	'monyxi')
					),
					"type" => "switch"
					),
				'excerpt_length' => array(
					"title" => esc_html__('Excerpt length', 'monyxi'),
					"desc" => wp_kses_data( __("Length (in words) to generate excerpt from the post content. Attention! If the post excerpt is explicitly specified - it appears unchanged", 'monyxi') ),
					"dependency" => array(
						'blog_style' => array('excerpt'),
						'blog_content' => array('excerpt')
					),
					"std" => 45,
					"type" => "text"
					),
				'blog_columns' => array(
					"title" => esc_html__('Blog columns', 'monyxi'),
					"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'monyxi') ),
					"std" => 2,
					"options" => monyxi_get_list_range(2,4),
					"type" => "hidden"
					),
				'post_type' => array(
					"title" => esc_html__('Post type', 'monyxi'),
					"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'monyxi') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'monyxi')
					),
					"dependency" => array(
                        '#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"linked" => 'parent_cat',
					"refresh" => false,
					"hidden" => true,
					"std" => 'post',
					"options" => array(),
					"type" => "select"
					),
				'parent_cat' => array(
					"title" => esc_html__('Category to show', 'monyxi'),
					"desc" => wp_kses_data( __('Select category to show in the blog archive', 'monyxi') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'monyxi')
					),
					"dependency" => array(
                        '#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"refresh" => false,
					"hidden" => true,
					"std" => '0',
					"options" => array(),
					"type" => "select"
					),
				'posts_per_page' => array(
					"title" => esc_html__('Posts per page', 'monyxi'),
					"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'monyxi') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'monyxi')
					),
					"dependency" => array(
                        '#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"hidden" => true,
					"std" => '',
					"type" => "text"
					),
				"blog_pagination" => array( 
					"title" => esc_html__('Pagination style', 'monyxi'),
					"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'monyxi') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'monyxi')
					),
					"std" => "pages",
					"dependency" => array(
                        '#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"options" => array(
						'pages'	=> esc_html__("Page numbers", 'monyxi'),
						'links'	=> esc_html__("Older/Newest", 'monyxi'),
						'more'	=> esc_html__("Load more", 'monyxi'),
						'infinite' => esc_html__("Infinite scroll", 'monyxi')
					),
					"type" => "select"
					),
				'show_filters' => array(
					"title" => esc_html__('Show filters', 'monyxi'),
					"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'monyxi') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'monyxi')
					),
					"dependency" => array(
                        '#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
						'blog_style' => array('portfolio', 'gallery')
					),
					"hidden" => true,
					"std" => 0,
					"type" => MONYXI_THEME_FREE ? "hidden" : "checkbox"
					),
	
				'blog_sidebar_info' => array(
					"title" => esc_html__('Sidebar', 'monyxi'),
					"desc" => '',
					"type" => "info",
					),
				'sidebar_position_blog' => array(
					"title" => esc_html__('Sidebar position', 'monyxi'),
					"desc" => wp_kses_data( __('Select position to show sidebar', 'monyxi') ),
					"std" => 'right',
					"options" => array(),
					"type" => "switch"
					),
				'sidebar_widgets_blog' => array(
					"title" => esc_html__('Sidebar widgets', 'monyxi'),
					"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'monyxi') ),
					"dependency" => array(
						'sidebar_position_blog' => array('left', 'right')
					),
					"std" => 'sidebar_widgets',
					"options" => array(),
					"type" => "select"
					),
				'expand_content_blog' => array(
					"title" => esc_html__('Expand content', 'monyxi'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'monyxi') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
	
	
				'blog_widgets_info' => array(
					"title" => esc_html__('Additional widgets', 'monyxi'),
					"desc" => '',
					"type" => MONYXI_THEME_FREE ? "hidden" : "info",
					),
				'widgets_above_page_blog' => array(
					"title" => esc_html__('Widgets at the top of the page', 'monyxi'),
					"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'monyxi') ),
					"std" => 'hide',
					"options" => array(),
					"type" => MONYXI_THEME_FREE ? "hidden" : "select"
					),
				'widgets_above_content_blog' => array(
					"title" => esc_html__('Widgets above the content', 'monyxi'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'monyxi') ),
					"std" => 'hide',
					"options" => array(),
					"type" => MONYXI_THEME_FREE ? "hidden" : "select"
					),
				'widgets_below_content_blog' => array(
					"title" => esc_html__('Widgets below the content', 'monyxi'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'monyxi') ),
					"std" => 'hide',
					"options" => array(),
					"type" => MONYXI_THEME_FREE ? "hidden" : "select"
					),
				'widgets_below_page_blog' => array(
					"title" => esc_html__('Widgets at the bottom of the page', 'monyxi'),
					"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'monyxi') ),
					"std" => 'hide',
					"options" => array(),
					"type" => MONYXI_THEME_FREE ? "hidden" : "select"
					),

				'blog_advanced_info' => array(
					"title" => esc_html__('Advanced settings', 'monyxi'),
					"desc" => '',
					"type" => "info",
					),
				'no_image' => array(
					"title" => esc_html__('Image placeholder', 'monyxi'),
					"desc" => wp_kses_data( __('Select or upload an image used as placeholder for posts without a featured image', 'monyxi') ),
					"std" => '',
					"type" => "image"
					),
				'time_diff_before' => array(
					"title" => esc_html__('Easy Readable Date Format', 'monyxi'),
					"desc" => wp_kses_data( __("For how many days to show the easy-readable date format (e.g. '3 days ago') instead of the standard publication date", 'monyxi') ),
					"std" => 5,
					"type" => "text"
					),
				'sticky_style' => array(
					"title" => esc_html__('Sticky posts style', 'monyxi'),
					"desc" => wp_kses_data( __('Select style of the sticky posts output', 'monyxi') ),
					"std" => 'inherit',
					"options" => array(
						'inherit' => esc_html__('Decorated posts', 'monyxi'),
						'columns' => esc_html__('Mini-cards',	'monyxi')
					),
					"type" => MONYXI_THEME_FREE ? "hidden" : "select"
					),
				"blog_animation" => array( 
					"title" => esc_html__('Animation for the posts', 'monyxi'),
					"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'monyxi') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'monyxi')
					),
					"dependency" => array(
                        '#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"std" => "none",
					"options" => array(),
					"type" => MONYXI_THEME_FREE ? "hidden" : "select"
					),
				'meta_parts' => array(
					"title" => esc_html__('Post meta', 'monyxi'),
					"desc" => wp_kses_data( __("If your blog page is created using the 'Blog archive' page template, set up the 'Post Meta' settings in the 'Theme Options' section of that page. Post counters and Share Links are available only if plugin ThemeREX Addons is active", 'monyxi') )
								. '<br>'
								. wp_kses_data( __("<b>Tip:</b> Drag items to change their order.", 'monyxi') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'monyxi')
					),
					"dependency" => array(
                        '#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'categories=1|date=1|counters=1|author=1|share=0|edit=0',
					"options" => array(
						'categories' => esc_html__('Categories', 'monyxi'),
						'date'		 => esc_html__('Post date', 'monyxi'),
						'author'	 => esc_html__('Post author', 'monyxi'),
						'counters'	 => esc_html__('Post counters', 'monyxi'),
						'share'		 => esc_html__('Share links', 'monyxi'),
						'edit'		 => esc_html__('Edit link', 'monyxi')
					),
					"type" => MONYXI_THEME_FREE ? "hidden" : "checklist"
				),
				'counters' => array(
					"title" => esc_html__('Post counters', 'monyxi'),
					"desc" => wp_kses_data( __("Show only selected counters. Attention! Likes and Views are available only if ThemeREX Addons is active", 'monyxi') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'monyxi')
					),
					"dependency" => array(
                        '#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'views=0|likes=0|comments=1',
					"options" => array(
						'views' => esc_html__('Views', 'monyxi'),
						'likes' => esc_html__('Likes', 'monyxi'),
						'comments' => esc_html__('Comments', 'monyxi')
					),
					"type" => MONYXI_THEME_FREE || !monyxi_exists_trx_addons() ? "hidden" : "checklist"
				),

				
				// Blog - Single posts
				'blog_single' => array(
					"title" => esc_html__('Single posts', 'monyxi'),
					"desc" => wp_kses_data( __('Settings of the single post', 'monyxi') ),
					"type" => "section",
					),
				'hide_featured_on_single' => array(
					"title" => esc_html__('Hide featured image on the single post', 'monyxi'),
					"desc" => wp_kses_data( __("Hide featured image on the single post's pages", 'monyxi') ),
					"override" => array(
						'mode' => 'page,post',
						'section' => esc_html__('Content', 'monyxi')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				'hide_sidebar_on_single' => array(
					"title" => esc_html__('Hide sidebar on the single post', 'monyxi'),
					"desc" => wp_kses_data( __("Hide sidebar on the single post's pages", 'monyxi') ),
					"std" => 0,
					"type" => "checkbox"
					),
				'show_post_meta' => array(
					"title" => esc_html__('Show post meta', 'monyxi'),
					"desc" => wp_kses_data( __("Display block with post's meta: date, categories, counters, etc.", 'monyxi') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'meta_parts_post' => array(
					"title" => esc_html__('Post meta', 'monyxi'),
					"desc" => wp_kses_data( __("Meta parts for single posts. Post counters and Share Links are available only if plugin ThemeREX Addons is active", 'monyxi') )
								. '<br>'
								. wp_kses_data( __("<b>Tip:</b> Drag items to change their order.", 'monyxi') ),
					"dependency" => array(
						'show_post_meta' => array(1)
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'categories=1|date=1|counters=1|author=1|share=0|edit=0',
					"options" => array(
						'categories' => esc_html__('Categories', 'monyxi'),
						'date'		 => esc_html__('Post date', 'monyxi'),
						'author'	 => esc_html__('Post author', 'monyxi'),
						'counters'	 => esc_html__('Post counters', 'monyxi'),
						'share'		 => esc_html__('Share links', 'monyxi'),
						'edit'		 => esc_html__('Edit link', 'monyxi')
					),
					"type" => MONYXI_THEME_FREE ? "hidden" : "checklist"
				),
				'counters_post' => array(
					"title" => esc_html__('Post counters', 'monyxi'),
					"desc" => wp_kses_data( __("Show only selected counters. Attention! Likes and Views are available only if plugin ThemeREX Addons is active", 'monyxi') ),
					"dependency" => array(
						'show_post_meta' => array(1)
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'views=0|likes=0|comments=1',
					"options" => array(
						'views' => esc_html__('Views', 'monyxi'),
						'likes' => esc_html__('Likes', 'monyxi'),
						'comments' => esc_html__('Comments', 'monyxi')
					),
					"type" => MONYXI_THEME_FREE || !monyxi_exists_trx_addons() ? "hidden" : "checklist"
				),
				'show_share_links' => array(
					"title" => esc_html__('Show share links', 'monyxi'),
					"desc" => wp_kses_data( __("Display share links on the single post", 'monyxi') ),
					"std" => 1,
					"type" => !monyxi_exists_trx_addons() ? "hidden" : "checkbox"
					),
				'show_author_info' => array(
					"title" => esc_html__('Show author info', 'monyxi'),
					"desc" => wp_kses_data( __("Display block with information about post's author", 'monyxi') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'blog_single_related_info' => array(
					"title" => esc_html__('Related posts', 'monyxi'),
					"desc" => '',
					"type" => "info",
					),
				'show_related_posts' => array(
					"title" => esc_html__('Show related posts', 'monyxi'),
					"desc" => wp_kses_data( __("Show section 'Related posts' on the single post's pages", 'monyxi') ),
					"override" => array(
						'mode' => 'page,post',
						'section' => esc_html__('Content', 'monyxi')
					),
					"std" => 1,
					"type" => "checkbox"
					),
				'related_posts' => array(
					"title" => esc_html__('Related posts', 'monyxi'),
					"desc" => wp_kses_data( __('How many related posts should be displayed in the single post? If 0 - no related posts are shown.', 'monyxi') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => monyxi_get_list_range(1,9),
					"type" => MONYXI_THEME_FREE ? "hidden" : "select"
					),
				'related_columns' => array(
					"title" => esc_html__('Related columns', 'monyxi'),
					"desc" => wp_kses_data( __('How many columns should be used to output related posts in the single page (from 2 to 4)?', 'monyxi') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => monyxi_get_list_range(1,4),
					"type" => MONYXI_THEME_FREE ? "hidden" : "switch"
					),
				'related_style' => array(
					"title" => esc_html__('Related posts style', 'monyxi'),
					"desc" => wp_kses_data( __('Select style of the related posts output', 'monyxi') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => monyxi_get_list_styles(1,2),
					
					"type" => "hidden"
					),
			'blog_end' => array(
				"type" => "panel_end",
				),
			
		
		
			// 'Colors'
			'panel_colors' => array(
				"title" => esc_html__('Colors', 'monyxi'),
				"desc" => '',
				"priority" => 300,
				"type" => "section"
				),

			'color_schemes_info' => array(
				"title" => esc_html__('Color schemes', 'monyxi'),
				"desc" => wp_kses_data( __('Color schemes for various parts of the site. "Inherit" means that this block is used the Site color scheme (the first parameter)', 'monyxi') ),
				"hidden" => $hide_schemes,
				"type" => "info",
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'monyxi'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'monyxi')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => $hide_schemes ? 'hidden' : "switch"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'monyxi'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'monyxi')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => $hide_schemes ? 'hidden' : "switch"
				),
			'menu_scheme' => array(
				"title" => esc_html__('Sidemenu Color Scheme', 'monyxi'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'monyxi')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				
				"type" => "hidden"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Sidebar Color Scheme', 'monyxi'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'monyxi')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => $hide_schemes ? 'hidden' : "switch"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'monyxi'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'monyxi')
				),
				"std" => 'dark',
				"options" => array(),
				"refresh" => false,
				"type" => $hide_schemes ? 'hidden' : "switch"
				),

			'color_scheme_editor_info' => array(
				"title" => esc_html__('Color scheme editor', 'monyxi'),
				"desc" => wp_kses_data(__('Select color scheme to modify. Attention! Only those sections in the site will be changed which this scheme was assigned to', 'monyxi') ),
				"type" => "info",
				),
			'scheme_storage' => array(
				"title" => esc_html__('Color scheme editor', 'monyxi'),
				"desc" => '',
				"std" => '$monyxi_get_scheme_storage',
				"refresh" => false,
				"colorpicker" => "tiny",
				"type" => "scheme_editor"
				),


			// 'Hidden'
			'media_title' => array(
				"title" => esc_html__('Media title', 'monyxi'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'monyxi') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Content', 'monyxi')
				),
				"hidden" => true,
				"std" => '',
				"type" => MONYXI_THEME_FREE ? "hidden" : "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'monyxi'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'monyxi') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Content', 'monyxi')
				),
				"hidden" => true,
				"std" => '',
				"type" => MONYXI_THEME_FREE ? "hidden" : "text"
				),


			// Internal options.
			// Attention! Don't change any options in the section below!
			// Use huge priority to call render this elements after all options!
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"priority" => 10000,
				"type" => "hidden",
				),

			'last_option' => array(		// Need to manually call action to include Tiny MCE scripts
				"title" => '',
				"desc" => '',
				"std" => 1,
				"type" => "hidden",
				),

		));


		// Prepare panel 'Fonts'
		// -------------------------------------------------------------
		$fonts = array(
		
			// 'Fonts'
			'fonts' => array(
				"title" => esc_html__('Typography', 'monyxi'),
				"desc" => '',
				"priority" => 200,
				"type" => "panel"
				),

			// Fonts - Load_fonts
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'monyxi'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'monyxi') )
						. '<br>'
						. wp_kses_data( __('Attention! Press "Refresh" button to reload preview area after the all fonts are changed', 'monyxi') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'monyxi'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'monyxi') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'monyxi') ),
				"class" => "monyxi_column-1_3 monyxi_new_row",
				"refresh" => false,
				"std" => '$monyxi_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=monyxi_get_theme_setting('max_load_fonts'); $i++) {
			if (monyxi_get_value_gp('page') != 'theme_options') {
				$fonts["load_fonts-{$i}-info"] = array(
					// Translators: Add font's number - 'Font 1', 'Font 2', etc
					"title" => esc_html(sprintf(esc_html__('Font %s', 'monyxi'), $i)),
					"desc" => '',
					"type" => "info",
					);
			}
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'monyxi'),
				"desc" => '',
				"class" => "monyxi_column-1_3 monyxi_new_row",
				"refresh" => false,
				"std" => '$monyxi_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'monyxi'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'monyxi') )
							: '',
				"class" => "monyxi_column-1_3",
				"refresh" => false,
				"std" => '$monyxi_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'monyxi'),
					'serif' => esc_html__('serif', 'monyxi'),
					'sans-serif' => esc_html__('sans-serif', 'monyxi'),
					'monospace' => esc_html__('monospace', 'monyxi'),
					'cursive' => esc_html__('cursive', 'monyxi'),
					'fantasy' => esc_html__('fantasy', 'monyxi')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'monyxi'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'monyxi') )
								. '<br>'
								. wp_kses_data( __('Attention! Each weight and style increase download size! Specify only used weights and styles.', 'monyxi') )
							: '',
				"class" => "monyxi_column-1_3",
				"refresh" => false,
				"std" => '$monyxi_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Fonts - H1..6, P, Info, Menu, etc.
		$theme_fonts = monyxi_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								// Translators: Add tag's name to make title 'H1 settings', 'P settings', etc.
								: esc_html(sprintf(esc_html__('%s settings', 'monyxi'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								// Translators: Add tag's name to make description
								: wp_kses( sprintf(__('Font settings of the "%s" tag.', 'monyxi'), $tag), 'monyxi_kses_content' ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$load_order = 1;
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = array();
					$load_order = 2;		// Load this option's value after all options are loaded (use option 'load_fonts' to build fonts list)
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'monyxi'),
						'100' => esc_html__('100 (Light)', 'monyxi'), 
						'200' => esc_html__('200 (Light)', 'monyxi'), 
						'300' => esc_html__('300 (Thin)',  'monyxi'),
						'400' => esc_html__('400 (Normal)', 'monyxi'),
						'500' => esc_html__('500 (Semibold)', 'monyxi'),
						'600' => esc_html__('600 (Semibold)', 'monyxi'),
						'700' => esc_html__('700 (Bold)', 'monyxi'),
						'800' => esc_html__('800 (Black)', 'monyxi'),
						'900' => esc_html__('900 (Black)', 'monyxi')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'monyxi'),
						'normal' => esc_html__('Normal', 'monyxi'), 
						'italic' => esc_html__('Italic', 'monyxi')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'monyxi'),
						'none' => esc_html__('None', 'monyxi'), 
						'underline' => esc_html__('Underline', 'monyxi'),
						'overline' => esc_html__('Overline', 'monyxi'),
						'line-through' => esc_html__('Line-through', 'monyxi')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'monyxi'),
						'none' => esc_html__('None', 'monyxi'), 
						'uppercase' => esc_html__('Uppercase', 'monyxi'),
						'lowercase' => esc_html__('Lowercase', 'monyxi'),
						'capitalize' => esc_html__('Capitalize', 'monyxi')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"class" => "monyxi_column-1_5",
					"refresh" => false,
					"load_order" => $load_order,
					"std" => '$monyxi_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters to Theme Options
		monyxi_storage_set_array_before('options', 'panel_colors', $fonts);


		// Add Header Video if WP version < 4.7
		// -----------------------------------------------------
		if (!function_exists('get_header_video_url')) {
			monyxi_storage_set_array_after('options', 'header_image_override', 'header_video', array(
				"title" => esc_html__('Header video', 'monyxi'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'monyxi') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'monyxi')
				),
				"std" => '',
				"type" => "video"
				)
			);
		}


		// Add option 'logo' if WP version < 4.5
		// or 'custom_logo' if current page is 'Theme Options'
		// ------------------------------------------------------
		if (!function_exists('the_custom_logo') || (isset($_REQUEST['page']) && $_REQUEST['page']=='theme_options')) {
			monyxi_storage_set_array_before('options', 'logo_retina', function_exists('the_custom_logo') ? 'custom_logo' : 'logo', array(
				"title" => esc_html__('Logo', 'monyxi'),
				"desc" => wp_kses_data( __('Select or upload the site logo', 'monyxi') ),
				"class" => "monyxi_column-1_2 monyxi_new_row",
				"priority" => 60,
				"std" => '',
				"type" => "image"
				)
			);
		}

	}
}


// Returns a list of options that can be overridden for CPT
if (!function_exists('monyxi_options_get_list_cpt_options')) {
	function monyxi_options_get_list_cpt_options($cpt, $title='') {
		if (empty($title)) $title = ucfirst($cpt);
		return array(
					"header_info_{$cpt}" => array(
						"title" => esc_html__('Header', 'monyxi'),
						"desc" => '',
						"type" => "info",
						),
					"header_type_{$cpt}" => array(
						"title" => esc_html__('Header style', 'monyxi'),
						"desc" => wp_kses_data( __('Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'monyxi') ),
						"std" => 'inherit',
						"options" => monyxi_get_list_header_footer_types(true),
						"type" => MONYXI_THEME_FREE ? "hidden" : "switch"
						),
					"header_style_{$cpt}" => array(
						"title" => esc_html__('Select custom layout', 'monyxi'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select custom layout to display the site header on the %s pages', 'monyxi'), $title) ),
						"dependency" => array(
							"header_type_{$cpt}" => array('custom')
						),
						"std" => 'inherit',
						"options" => array(),
						"type" => MONYXI_THEME_FREE ? "hidden" : "select"
						),
					"header_position_{$cpt}" => array(
						"title" => esc_html__('Header position', 'monyxi'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select position to display the site header on the %s pages', 'monyxi'), $title) ),
						"std" => 'inherit',
						"options" => array(),
						"type" => MONYXI_THEME_FREE ? "hidden" : "switch"
						),
					"header_image_override_{$cpt}" => array(
						"title" => esc_html__('Header image override', 'monyxi'),
						"desc" => wp_kses_data( __("Allow override the header image with the post's featured image", 'monyxi') ),
						"std" => 'inherit',
						"options" => array(
							'inherit' => esc_html__('Inherit', 'monyxi'),
							1 => esc_html__('Yes', 'monyxi'),
							0 => esc_html__('No', 'monyxi'),
						),
						"type" => MONYXI_THEME_FREE ? "hidden" : "switch"
						),
					"header_widgets_{$cpt}" => array(
						"title" => esc_html__('Header widgets', 'monyxi'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select set of widgets to show in the header on the %s pages', 'monyxi'), $title) ),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
						
					"sidebar_info_{$cpt}" => array(
						"title" => esc_html__('Sidebar', 'monyxi'),
						"desc" => '',
						"type" => "info",
						),
					"sidebar_position_{$cpt}" => array(
						"title" => esc_html__('Sidebar position', 'monyxi'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select position to show sidebar on the %s pages', 'monyxi'), $title) ),
						"std" => 'left',
						"options" => array(),
						"type" => "switch"
						),
					"sidebar_widgets_{$cpt}" => array(
						"title" => esc_html__('Sidebar widgets', 'monyxi'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select sidebar to show on the %s pages', 'monyxi'), $title) ),
						"dependency" => array(
							"sidebar_position_{$cpt}" => array('left', 'right')
						),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
					"hide_sidebar_on_single_{$cpt}" => array(
						"title" => esc_html__('Hide sidebar on the single pages', 'monyxi'),
						"desc" => wp_kses_data( __("Hide sidebar on the single page", 'monyxi') ),
						"std" => 'inherit',
						"options" => array(
							'inherit' => esc_html__('Inherit', 'monyxi'),
							1 => esc_html__('Hide', 'monyxi'),
							0 => esc_html__('Show', 'monyxi'),
						),
						"type" => "switch"
						),
						
					"footer_info_{$cpt}" => array(
						"title" => esc_html__('Footer', 'monyxi'),
						"desc" => '',
						"type" => "info",
						),
					"footer_type_{$cpt}" => array(
						"title" => esc_html__('Footer style', 'monyxi'),
						"desc" => wp_kses_data( __('Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'monyxi') ),
						"std" => 'inherit',
						"options" => monyxi_get_list_header_footer_types(true),
						"type" => MONYXI_THEME_FREE ? "hidden" : "switch"
						),
					"footer_style_{$cpt}" => array(
						"title" => esc_html__('Select custom layout', 'monyxi'),
						"desc" => wp_kses_data( __('Select custom layout to display the site footer', 'monyxi') ),
						"std" => 'inherit',
						"dependency" => array(
							"footer_type_{$cpt}" => array('custom')
						),
						"options" => array(),
						"type" => MONYXI_THEME_FREE ? "hidden" : "select"
						),
					"footer_widgets_{$cpt}" => array(
						"title" => esc_html__('Footer widgets', 'monyxi'),
						"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'monyxi') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default')
						),
						"std" => 'footer_widgets',
						"options" => array(),
						"type" => "select"
						),
					"footer_columns_{$cpt}" => array(
						"title" => esc_html__('Footer columns', 'monyxi'),
						"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'monyxi') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default'),
							"footer_widgets_{$cpt}" => array('^hide')
						),
						"std" => 0,
						"options" => monyxi_get_list_range(0,6),
						"type" => "select"
						),
					"footer_wide_{$cpt}" => array(
						"title" => esc_html__('Footer fullwidth', 'monyxi'),
						"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'monyxi') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default')
						),
						"std" => 0,
						"type" => "checkbox"
						),
						
					"widgets_info_{$cpt}" => array(
						"title" => esc_html__('Additional panels', 'monyxi'),
						"desc" => '',
						"type" => MONYXI_THEME_FREE ? "hidden" : "info",
						),
					"widgets_above_page_{$cpt}" => array(
						"title" => esc_html__('Widgets at the top of the page', 'monyxi'),
						"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'monyxi') ),
						"std" => 'hide',
						"options" => array(),
						"type" => MONYXI_THEME_FREE ? "hidden" : "select"
						),
					"widgets_above_content_{$cpt}" => array(
						"title" => esc_html__('Widgets above the content', 'monyxi'),
						"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'monyxi') ),
						"std" => 'hide',
						"options" => array(),
						"type" => MONYXI_THEME_FREE ? "hidden" : "select"
						),
					"widgets_below_content_{$cpt}" => array(
						"title" => esc_html__('Widgets below the content', 'monyxi'),
						"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'monyxi') ),
						"std" => 'hide',
						"options" => array(),
						"type" => MONYXI_THEME_FREE ? "hidden" : "select"
						),
					"widgets_below_page_{$cpt}" => array(
						"title" => esc_html__('Widgets at the bottom of the page', 'monyxi'),
						"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'monyxi') ),
						"std" => 'hide',
						"options" => array(),
						"type" => MONYXI_THEME_FREE ? "hidden" : "select"
						)
					);
	}
}


// Return lists with choises when its need in the admin mode
if (!function_exists('monyxi_options_get_list_choises')) {
	add_filter('monyxi_filter_options_get_list_choises', 'monyxi_options_get_list_choises', 10, 2);
	function monyxi_options_get_list_choises($list, $id) {
		if (is_array($list) && count($list)==0) {
			if (strpos($id, 'header_style')===0)
				$list = monyxi_get_list_header_styles(strpos($id, 'header_style_')===0);
			else if (strpos($id, 'header_position')===0)
				$list = monyxi_get_list_header_positions(strpos($id, 'header_position_')===0);
			else if (strpos($id, 'header_widgets')===0)
				$list = monyxi_get_list_sidebars(strpos($id, 'header_widgets_')===0, true);
			else if (strpos($id, '_scheme') > 0)
				$list = monyxi_get_list_schemes($id!='color_scheme');
			else if (strpos($id, 'sidebar_widgets')===0)
				$list = monyxi_get_list_sidebars(strpos($id, 'sidebar_widgets_')===0, true);
			else if (strpos($id, 'sidebar_position')===0)
				$list = monyxi_get_list_sidebars_positions(strpos($id, 'sidebar_position_')===0);
			else if (strpos($id, 'widgets_above_page')===0)
				$list = monyxi_get_list_sidebars(strpos($id, 'widgets_above_page_')===0, true);
			else if (strpos($id, 'widgets_above_content')===0)
				$list = monyxi_get_list_sidebars(strpos($id, 'widgets_above_content_')===0, true);
			else if (strpos($id, 'widgets_below_page')===0)
				$list = monyxi_get_list_sidebars(strpos($id, 'widgets_below_page_')===0, true);
			else if (strpos($id, 'widgets_below_content')===0)
				$list = monyxi_get_list_sidebars(strpos($id, 'widgets_below_content_')===0, true);
			else if (strpos($id, 'footer_style')===0)
				$list = monyxi_get_list_footer_styles(strpos($id, 'footer_style_')===0);
			else if (strpos($id, 'footer_widgets')===0)
				$list = monyxi_get_list_sidebars(strpos($id, 'footer_widgets_')===0, true);
			else if (strpos($id, 'blog_style')===0)
				$list = monyxi_get_list_blog_styles(strpos($id, 'blog_style_')===0);
			else if (strpos($id, 'post_type')===0)
				$list = monyxi_get_list_posts_types();
			else if (strpos($id, 'parent_cat')===0)
				$list = monyxi_array_merge(array(0 => esc_html__('- Select category -', 'monyxi')), monyxi_get_list_categories());
			else if (strpos($id, 'blog_animation')===0)
				$list = monyxi_get_list_animations_in();
			else if ($id == 'color_scheme_editor')
				$list = monyxi_get_list_schemes();
			else if (strpos($id, '_font-family') > 0)
				$list = monyxi_get_list_load_fonts(true);
		}
		return $list;
	}
}
?>