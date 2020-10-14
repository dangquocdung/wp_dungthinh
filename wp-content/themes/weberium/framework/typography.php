<?php
/**
 * Typography
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start class
if ( ! class_exists( 'Weberium_Typography' ) ) {
	class Weberium_Typography {
		public function __construct() {
			// Customizer actions
			add_action( 'customize_register', array( 'Weberium_Typography' , 'register' ), 40 );

			// Loads Google fonts
			add_action( 'wp_enqueue_scripts', array( 'Weberium_Typography', 'load_fonts' ) );
		
			// CSS output
			if ( is_customize_preview() ) {
				add_action( 'customize_preview_init', array( 'Weberium_Typography', 'customize_preview_init' ) );
				add_action( 'wp_head', array( 'Weberium_Typography', 'live_preview_styles' ), 999 );
			} else {
				add_filter( 'weberium_footer_css', array( 'Weberium_Typography', 'footer_css' ), 99 );
			}
		}

		// Array of Typography settings to add to the customizer
		public static function elements() {
			// Set default font
			$body_default = 'Lato';
			$heading_default = 'Montserrat';

			// Return settings
			$array = apply_filters( 'weberium_typography_settings', array(
				'body' => array(
					'label' => esc_html__( 'Body', 'weberium' ),
					'target' => 'body',
					'defaults' => array(
						'font-family' => $body_default,
					),
				),
				'headings' => array(
					'label' => esc_html__( 'Headings', 'weberium' ),
					'target' => 'h1,h2,h3,h4,h5,h6, .font-heading, blockquote cite, .hentry .post-navigation .meta-nav, .hentry .post-author .name, .hentry .related-title, .hentry .post-related .post-item h4, .comments-area .comments-title, .comments-area .comment-reply-title, .comment-author, .comment-reply a, .hentry .post-title a',
					'defaults' => array(
						'font-family' => $heading_default,
					),
					'exclude' => array( 'font-size', 'line-height' ),
				),
				'top_bar_content' => array(
					'label' => esc_html__( 'Top Bar Content', 'weberium' ),
					'target' => '#top-bar .top-bar-content .content, #top-bar .top-bar-socials .texts',
					'exclude' => array( 'font-color' ),
				),
				'top_menu' => array(
					'label' => esc_html__( 'Top Menu', 'weberium' ),
					'target' => '.top-bar-menu li a',
					'exclude' => array( 'font-color' ),
					'active_callback' => 'weberium_cac_has_topbar',
				),
				'header_aside_title' => array(
					'label' => esc_html__( 'Header Aside Info: Title', 'weberium' ),
					'target' => '.header-style-5 #header-aside .header-info .heading',
					'exclude' => array( 'font-color' ),
				),
				'main_menu' => array(
					'label' => esc_html__( 'Main Menu', 'weberium' ),
					'target' => '#main-nav > ul > li > a',
					'exclude' => array( 'font-color', 'line-height' ),
				),
				'main_menu_dropdown' => array(
					'label' => esc_html__( 'Main Menu: Dropdowns', 'weberium' ),
					'target' => '#main-nav .sub-menu li a',
					'exclude' => array( 'font-color' ),
				),
				'mobile_menu' => array(
					'label' => esc_html__( 'Mobile Menu', 'weberium' ),
					'target' => '#main-nav-mobi ul > li > a',
					'exclude' => array( 'font-color', 'line-height' ),
				),
				'featured_title' => array(
					'label' => esc_html__( 'Featured Title', 'weberium' ),
					'target' => '#featured-title .featured-title-heading',
					'exclude' => array( 'font-color' ),
					'active_callback' => 'weberium_cac_has_featured_title_heading',
				),
				'breadcrumbs' => array(
					'label' => esc_html__( 'Breadcrumbs', 'weberium' ),
					'target' => '#featured-title #breadcrumbs',
					'exclude' => array( 'font-color', 'line-height' ),
					'active_callback' => 'weberium_cac_has_breadcrumbs',
				),
				'blog_post_title' => array(
					'label' => esc_html__( 'Blog Post Title', 'weberium' ),
					'target' => '.hentry .post-title',
					'exclude' => array( 'font-color' ),
				),
				'blog_single_post_title' => array(
					'label' => esc_html__( 'Blog Single Post Title', 'weberium' ),
					'target' => '.post-content-single-wrap .hentry .post-title',
					'exclude' => array( 'font-color' ),
				),
				'blog_post_meta' => array(
					'label' => esc_html__( 'Blog Post Meta', 'weberium' ),
					'target' => '.hentry .post-meta',
					'exclude' => array( 'font-color', 'line-height' ),
				),
				'theme_button' => array(
					'label' => esc_html__( 'Buttons', 'weberium' ),
					'target' => '.weberium-button, .hentry .post-link a, .comment-respond #comment-reply, .wpcf7-form .wpcf7-submit, .weberium-subscribe .form-wrap .submit-wrap button, .footer-promotion .promo-btn',
					'exclude' => array( 'font-color', 'line-height' ),
				),
				'theme_pagination' => array(
					'label' => esc_html__( 'Pagination', 'weberium' ),
					'target' => '.weberium-pagination, .woocommerce-pagination',
					'exclude' => array( 'font-color', 'line-height' ),
				),
				'sidebar_widget_title' => array(
					'label' => esc_html__( 'Sidebar Widget Title', 'weberium' ),
					'target' => '#sidebar .widget .widget-title',
				),
				'footer_widget_title' => array(
					'label' => esc_html__( 'Footer Widget Title', 'weberium' ),
					'target' => '#footer-widgets .widget .widget-title',
					'exclude' => array( 'font-color' ),
				),
				'widget_news_title' => array(
					'label' => esc_html__( 'Widget News: Title', 'weberium' ),
					'target' => '#sidebar .widget.widget_recent_posts h3, #footer-widgets .widget.widget_recent_posts h3',
					'exclude' => array( 'font-color' ),
				),
				'widget_tweet_text' => array(
					'label' => esc_html__( 'Widget Tweets: Text', 'weberium' ),
					'target' => '#sidebar .widget.widget_twitter .tweet-item',
					'exclude' => array( 'font-color' ),
				),
				'widget_tag_text' => array(
					'label' => esc_html__( 'Widget Tag Cloud: Text', 'weberium' ),
					'target' => '.hentry .post-tags a, #sidebar .widget.widget_tag_cloud .tagcloud a, #footer-widgets .widget.widget_tag_cloud .tagcloud a, .widget_product_tag_cloud .tagcloud a',
					'exclude' => array( 'font-color' ),
				),
				'entry_h1' => array(
					'label' => esc_html__( 'H1', 'weberium' ),
					'target' => 'h1',
				),
				'entry_h2' => array(
					'label' => esc_html__( 'H2', 'weberium' ),
					'target' => 'h2',
				),
				'entry_h3' => array(
					'label' => esc_html__( 'H3', 'weberium' ),
					'target' => 'h3',
				),
				'entry_h4' => array(
					'label' => esc_html__( 'H4', 'weberium' ),
					'target' => 'h4',
				),
				'copyright' => array(
					'label' => esc_html__( 'Copyright', 'weberium' ),
					'target' => '#copyright',
					'exclude' => array( 'font-color' ),
					'active_callback' => 'weberium_cac_has_bottombar',
				),
				'bottom_menu' => array(
					'label' => esc_html__( 'Bottom Menu', 'weberium' ),
					'target' => '#bottom ul.bottom-nav > li > a',
					'exclude' => array( 'font-color' ),
					'active_callback' => 'weberium_cac_has_bottombar',
				),
				'woocommerce_product_title' => array(
					'label' => esc_html__( 'Woocommerce: Product Title', 'weberium' ),
					'target' => '.products li h2',
					'exclude' => array( 'font-color' ),
					'active_callback' => 'weberium_cac_has_woo',
					
				),
				'woocommerce_price' => array(
					'label' => esc_html__( 'Woocommerce: Price Amount', 'weberium' ),
					'target' => '.products li .price',
					'exclude' => array( 'font-color' ),
					'active_callback' => 'weberium_cac_has_woo',
				),
				'woocommerce_single_product_title' => array(
					'label' => esc_html__( 'Woocommerce: Single Product Title', 'weberium' ),
					'target' => '.woo-single-post-class .summary h1',
					'exclude' => array( 'font-color' ),
					'active_callback' => 'weberium_cac_has_woo',
					
				),
				'woocommerce_single_price' => array(
					'label' => esc_html__( 'Woocommerce: Single Price Amount', 'weberium' ),
					'target' => '.woo-single-post-class .summary .price',
					'exclude' => array( 'font-color' ),
					'active_callback' => 'weberium_cac_has_woo',

				),
				'woocommerce_single_tab_title' => array(
					'label' => esc_html__( 'Woocommerce: Single Tab Title', 'weberium' ),
					'target' => '.woo-single-post-class .woocommerce-tabs ul li > a',
					'exclude' => array( 'font-color' ),
					'active_callback' => 'weberium_cac_has_woo',
				),
				'woocommerce_button' => array(
					'label' => esc_html__( 'Woocommerce: Buttons', 'weberium' ),
					'target' => '.woocommerce-page .button',
					'exclude' => array( 'font-color', 'line-height' ),
				),
			) );

			// Return array
			return $array;
		}

		// Loads js file for customizer preview
		public static function customize_preview_init() {
			wp_enqueue_script( 'weberium-typography-customize-preview',
				get_template_directory_uri() .'/framework/customizer/typography-customize.js',
				array( 'customize-preview' ),
				'1.0.0',
				true
			);
			wp_localize_script( 'weberium-typography-customize-preview', 'weberium', array(
				'googleFontsUrl' => weberium_get_google_fonts_url()
			) );
		}

		// Register typography options to the Customizer
		public static function register ( $wp_customize ) {

			// Get elements
			$elements = self::elements();

			// Return if elements are empty. This check is needed due to the filter added above
			if ( empty( $elements ) ) {
				return;
			}

			// Add General Panel
			$wp_customize->add_panel( 'weberium_typography', array(
				'priority' => 142,
				'capability' => 'edit_theme_options',
				'title' => esc_html__( 'Typography', 'weberium' ),
			) );

			// Add General Tab
			$wp_customize->add_section( 'weberium_typography_general' , array(
				'title' => esc_html__( 'General', 'weberium' ),
				'priority' => 1,
				'panel' => 'weberium_typography',
			) );

			// Load Fonts Subsets
			$wp_customize->add_setting( 'google_font_subsets', array(
				'type' => 'theme_mod',
				'default' => 'latin',
				'sanitize_callback' => 'esc_html',
			) );
			$wp_customize->add_control( new Weberium_Customize_Multicheck_Control( $wp_customize, 'google_font_subsets', array(
				'label' => esc_html__( 'Font Subsets', 'weberium' ),
				'section' => 'weberium_typography_general',
				'settings' => 'google_font_subsets',
				'priority' => 2,
				'choices' => array(
					'latin' => 'latin',
					'latin-ext' => 'latin-ext',
					'cyrillic' => 'cyrillic',
					'cyrillic-ext' => 'cyrillic-ext',
					'greek' => 'greek',
					'greek-ext' => 'greek-ext',
					'vietnamese' => 'vietnamese',
				),
			) ) );

			// Lopp through elements
			$count = '1';
			foreach( $elements as $element => $array ) {
				$count++;

				// Get label
				$label              = ! empty( $array['label'] ) ? $array['label'] : null;
				$exclude_attributes = ! empty( $array['exclude'] ) ? $array['exclude'] : false;
				$active_callback    = ! empty( $array['active_callback'] ) ? $array['active_callback'] : null;
				$description        = ! empty( $array['description'] ) ? $array['description'] : '';
				$transport          = 'postMessage'; // all settings should use AJAX

				// Get attributes
				if ( ! empty ( $array['attributes'] ) ) {
					$attributes = $array['attributes'];
				} else {
					$attributes = array(
						'font-family',
						'font-weight',
						'font-style',
						'text-transform',
						'font-size',
						'line-height',
						'letter-spacing',
						'font-color',
					);
				}

				// Allow for margin on this attribute
				if ( isset( $array['margin'] ) ) {
					$attributes[] = 'margin';
				}

				// Set keys equal to vals
				$attributes = array_combine( $attributes, $attributes );

				// Exclude attributes for specific options
				if ( $exclude_attributes ) {
					foreach ( $exclude_attributes as $key => $val ) {
						unset( $attributes[ $val ] );
					}
				}

				// Register new setting if label isn't empty
				if ( $label ) {

					// Define Section
					$wp_customize->add_section( 'weberium_typography_'. $element , array(
						'title' => $label,
						'priority' => $count,
						'panel' => 'weberium_typography',
						'description' => $description
					) );

					// Font Family
					if ( in_array( 'font-family', $attributes ) ) {

						// Get default
						$default = ! empty( $array['defaults']['font-family'] ) ? $array['defaults']['font-family'] : NULL;

						// Add setting
						$wp_customize->add_setting( $element .'_typography[font-family]', array(
							'type' => 'theme_mod',
							'default' => $default,
							'transport' => $transport,
							'sanitize_callback' => 'esc_html',
						) );

						// Add Control
						$wp_customize->add_control( new Weberium_Fonts_Dropdown_Custom_Control( $wp_customize, $element .'_typography[font-family]', array(
								'label' => esc_html__( 'Font Family', 'weberium' ),
								'section' => 'weberium_typography_'. $element,
								'settings' => $element .'_typography[font-family]',
								'priority' => 1,
								'active_callback' => $active_callback,
						) ) );

					}

					// Font Weight
					if ( in_array( 'font-weight', $attributes ) ) {
						$wp_customize->add_setting( $element .'_typography[font-weight]', array(
							'type' => 'theme_mod',
							'description' => esc_html__( 'Note: Not all Fonts support every font weight style.', 'weberium' ),
							'sanitize_callback' => 'absint',
							'transport' => $transport,
						) );
						$wp_customize->add_control( $element .'_typography[font-weight]', array(
							'label' => esc_html__( 'Font Weight', 'weberium' ),
							'section' => 'weberium_typography_'. $element,
							'settings' => $element .'_typography[font-weight]',
							'priority' => 2,
							'type' => 'select',
							'active_callback' => $active_callback,
							'choices' => array(
								'' => esc_html__( 'Default', 'weberium' ),
								'100' => esc_html__( 'Extra Light: 100', 'weberium' ),
								'200' => esc_html__( 'Light: 200', 'weberium' ),
								'300' => esc_html__( 'Book: 300', 'weberium' ),
								'400' => esc_html__( 'Normal: 400', 'weberium' ),
								'500' => esc_html__( 'Medium: 500', 'weberium' ),
								'600' => esc_html__( 'Semibold: 600', 'weberium' ),
								'700' => esc_html__( 'Bold: 700', 'weberium' ),
								'800' => esc_html__( 'Extra Bold: 800', 'weberium' ),
								'900' => esc_html__( 'Black: 900', 'weberium' ),
							),
							'description' => esc_html__( 'Important: Not all fonts support every font-weight.', 'weberium' ),
						) );
					}

					// Font Style
					if ( in_array( 'font-style', $attributes ) ) {
						$wp_customize->add_setting( $element .'_typography[font-style]', array(
							'type' => 'theme_mod',
							'sanitize_callback' => 'esc_html',
							'transport' => $transport,
						) );
						$wp_customize->add_control( $element .'_typography[font-style]', array(
							'label' => esc_html__( 'Font Style', 'weberium' ),
							'section' => 'weberium_typography_'. $element,
							'settings' => $element .'_typography[font-style]',
							'priority' => 3,
							'type' => 'select',
							'active_callback' => $active_callback,
							'choices' => array(
								'' => esc_html__( 'Default', 'weberium' ),
								'normal' => esc_html__( 'Normal', 'weberium' ),
								'italic' => esc_html__( 'Italic', 'weberium' ),
							),
						) );
					}

					// Text Transform
					if ( in_array( 'text-transform', $attributes ) ) {
						$wp_customize->add_setting( $element .'_typography[text-transform]', array(
							'type' => 'theme_mod',
							'sanitize_callback' => 'esc_html',
							'transport' => $transport,
						) );
						$wp_customize->add_control( $element .'_typography[text-transform]', array(
							'label' => esc_html__( 'Text Transform', 'weberium' ),
							'section' => 'weberium_typography_'. $element,
							'settings' => $element .'_typography[text-transform]',
							'priority' => 4,
							'type' => 'select',
							'active_callback' => $active_callback,
							'choices' => array(
								'' => esc_html__( 'Default', 'weberium' ),
								'capitalize' => esc_html__( 'Capitalize', 'weberium' ),
								'lowercase' => esc_html__( 'Lowercase', 'weberium' ),
								'uppercase' => esc_html__( 'Uppercase', 'weberium' ),
							),
						) );
					}

					// Font Size
					if ( in_array( 'font-size', $attributes ) ) {
						$wp_customize->add_setting( $element .'_typography[font-size]', array(
							'type' => 'theme_mod',
							'sanitize_callback' => 'esc_html',
							'transport' => $transport,
						) );
						$wp_customize->add_control( $element .'_typography[font-size]', array(
							'label' => esc_html__( 'Font Size', 'weberium' ),
							'section' => 'weberium_typography_'. $element,
							'settings' => $element .'_typography[font-size]',
							'priority' => 5,
							'type' => 'text',
							'description' => esc_html__( 'Value in px or em.', 'weberium' ),
							'active_callback' => $active_callback,
						) );
					}

					// Font Color
					if ( in_array( 'font-color', $attributes ) ) {
						$wp_customize->add_setting( $element .'_typography[color]', array(
							'type' => 'theme_mod',
							'default' => '',
							'sanitize_callback' => 'sanitize_hex_color',
							'transport' => $transport,
						) );
						$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $element .'_typography_color', array(
							'label' => esc_html__( 'Font Color', 'weberium' ),
							'section' => 'weberium_typography_'. $element,
							'settings' => $element .'_typography[color]',
							'priority' => 6,
							'active_callback' => $active_callback,
						) ) );
					}

					// Line Height
					if ( in_array( 'line-height', $attributes ) ) {
						$wp_customize->add_setting( $element .'_typography[line-height]', array(
							'type' => 'theme_mod',
							'sanitize_callback' => 'esc_html',
							'transport' => $transport,
						) );
						$wp_customize->add_control( $element .'_typography[line-height]',
							array(
								'label' => esc_html__( 'Line Height', 'weberium' ),
								'section' => 'weberium_typography_'. $element,
								'settings' => $element .'_typography[line-height]',
								'priority' => 7,
								'type' => 'text',
								'active_callback' => $active_callback,
						) );
					}

					// Letter Spacing
					if ( in_array( 'letter-spacing', $attributes ) ) {
						$wp_customize->add_setting( $element .'_typography[letter-spacing]', array(
							'type' => 'theme_mod',
							'sanitize_callback' => 'esc_html',
							'transport' => $transport,
						) );
						$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $element .'_typography_letter_spacing', array(
							'label' => esc_html__( 'Letter Spacing', 'weberium' ),
							'section' => 'weberium_typography_'. $element,
							'settings' => $element .'_typography[letter-spacing]',
							'priority' => 8,
							'type' => 'text',
							'active_callback' => $active_callback,
							'description' => esc_html__( 'Value in px or em.', 'weberium' ),
						) ) );
					}
				}
			}
		}

		// Loop through settings
		public static function loop( $return = 'css' ) {
			// Define Vars
			$css            = '';
			$fonts          = array();
			$elements       = self::elements();
			$preview_styles = array();

			// Loop through each elements that need typography styling applied to them
			foreach( $elements as $element => $array ) {

				// Add empty css var
				$add_css = '';

				// Get target and current mod
				$target  = isset( $array['target'] ) ? $array['target'] : '';
				$get_mod = weberium_get_mod( $element .'_typography' );

				// Attributes to loop through
				if ( ! empty( $array['attributes'] ) ) {
					$attributes = $array['attributes'];
				} else {
					$attributes = array(
						'font-family',
						'font-weight',
						'font-style',
						'font-size',
						'color',
						'line-height',
						'letter-spacing',
						'text-transform',
					);
				}

				// Loop through attributes
				foreach ( $attributes as $attribute ) {

					// Define val
					$default = isset( $array['defaults'][$attribute] ) ? $array['defaults'][$attribute] : NULL;
					$val     = isset ( $get_mod[$attribute] ) ? $get_mod[$attribute] : $default;

					// If there is a value lets do something
					if ( $val ) {

						// Sanitize
						$val = str_replace( '"', '', $val );

						// Sanitize data
						$val = ( 'font-size' == $attribute ) ? weberium_sanitize_data( $val, 'font_size' ) : $val;
						$val = ( 'letter-spacing' == $attribute ) ? weberium_sanitize_data( $val, 'px' ) : $val;

						// Add quotes around font-family && font family to scripts array
						if ( 'font-family' == $attribute ) {
							$fonts[] = $val;
							if ( strpos( $val, '"' ) || strpos( $val, ',' ) ) {
								$val = $val;
							} else {
								$val = '"'. esc_html( $val ) .'"';
							}
						}

						// Add to inline CSS
						if ( 'css' == $return ) {
							$add_css .= $attribute .':'. $val .';';
						}

						// Customizer styles need to be added for each attribute
						elseif ( 'preview_styles' == $return ) {
							$preview_styles['customizer-typography-'. $element .'-'. $attribute] = $target .'{'. $attribute .':'. $val .';}';
						}

					}

				}

				// Front-end inline CSS
				if ( $add_css && 'css' == $return ) {
					$css .= $target .'{'. $add_css .'}';
				}

			}

			// Return CSS
			if ( 'css' == $return && ! empty( $css ) ) {
				$css = '/*TYPOGRAPHY*/'. $css;
				return $css;
			}

			// Return styles
			if ( 'preview_styles' == $return && ! empty( $preview_styles ) ) {
				return $preview_styles;
			}

			// Return Fonts Array
			if ( 'fonts' == $return && ! empty( $fonts ) ) {
				return array_unique( $fonts ); // Return only 1 of each font
			}

		}

		// Outputs the typography custom CSS
		public static function footer_css( $output ) {
			$typography_css = self::loop( 'css' );
			if ( $typography_css ) {
				$output .= $typography_css;
			}
			return $output;
		}

		// Returns correct CSS to output to wp_head
		public static function live_preview_styles() {
			$live_preview_styles = self::loop( 'preview_styles' );
			if ( $live_preview_styles ) {
				foreach ( $live_preview_styles as $key => $val ) {
					if ( ! empty( $val ) ) {
						echo '<style class="'. $key .'"> '. $val .'</style>';
					}
				}
			}
		}

		// Loads Google fonts via wp_enqueue_style
		public static function load_fonts() {

			// Get fonts
			$fonts = self::loop( 'fonts' );

			// Loop through and enqueue fonts
			if ( ! empty( $fonts ) && is_array( $fonts ) ) {
				foreach ( $fonts as $font ) {
					weberium_enqueue_google_font( $font );
				}
			}

		}
	}

	new Weberium_Typography();
}
