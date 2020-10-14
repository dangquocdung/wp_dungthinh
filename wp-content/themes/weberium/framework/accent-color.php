<?php
/**
 * Accent color
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'Weberium_Accent_Color' ) ) {
	class Weberium_Accent_Color {
		// Main constructor
		public function __construct() {
			add_filter( 'weberium_footer_css', array( 'Weberium_Accent_Color', 'generate' ), 1 );
		}

		// Generates arrays of elements to target
		private static function arrays( $return ) {
			// Color
			$texts = apply_filters( 'weberium_accent_texts', array(
				'.text-accent-color', '#site-logo .site-logo-text:hover',
				'.top-bar-style-1 #top-bar .top-bar-content .content:before',
				'.top-bar-style-2 #top-bar .top-bar-content .content:before',
				'.top-bar-style-1 #top-bar .top-bar-socials .icons a:hover',
				'.top-bar-style-2 #top-bar .top-bar-socials .icons a:hover',
				'.header-style-1.cur-menu-1 #main-nav > ul > li.current-menu-item > a',
				'.header-style-1.cur-menu-1 #main-nav > ul > li.current-menu-parent > a',
				'.header-style-1.cur-menu-2 #main-nav > ul > li.current-menu-item > a',
				'.header-style-1.cur-menu-2 #main-nav > ul > li.current-menu-parent > a',
				'.header-style-1.cur-menu-4 #main-nav > ul > li.current-menu-item > a',
				'.header-style-1.cur-menu-4 #main-nav > ul > li.current-menu-parent > a',
				'.header-style-1.cur-menu-5 #main-nav > ul > li.current-menu-item > a',
				'.header-style-1.cur-menu-5 #main-nav > ul > li.current-menu-parent > a',
				'.header-style-1.cur-menu-6 #main-nav > ul > li.current-menu-item > a',
				'.header-style-1.cur-menu-6 #main-nav > ul > li.current-menu-parent > a',
				'.header-style-2.cur-menu-2 #main-nav > ul > li.current-menu-item > a',
				'.header-style-2.cur-menu-2 #main-nav > ul > li.current-menu-parent > a',				
				'.header-style-1 #site-header .header-search-icon:hover',
				'.header-style-2 #main-nav > ul > li > a:hover',
				'.header-style-2 #site-header .header-search-icon:hover',
				'.header-style-4 #main-nav > ul > li > a:hover',
				'.header-style-4 #site-header .header-search-icon:hover',
				'.nav-top-cart-wrapper .nav-shop-cart ul li a.remove',
				'.nav-top-cart-wrapper .nav-shop-cart ul li a:hover',
				'#featured-title #breadcrumbs a:hover',
				'#featured-title #breadcrumbs .breadcrumb-trail > a:before, #featured-title #breadcrumbs .breadcrumb-trail > span:before',
				'.hentry .post-title a:hover', '.hentry .post-meta a:hover',
				'#footer-widgets .widget.widget_search .search-form .search-submit:before',
				'.widget.widget_categories ul li a:hover',
				'.widget.widget_meta ul li a:hover',
				'.widget.widget_pages ul li a:hover',
				'.widget.widget_archive ul li a:hover',
				'.widget.widget_recent_entries ul li a:hover',
				'.widget.widget_recent_comments ul li a:hover',
				'#sidebar .widget.widget_calendar caption',
				'#footer-widgets .widget.widget_calendar caption',
				'#sidebar .widget.widget_links ul li a:hover',
				'#footer-widgets .widget.widget_links ul li a:hover',
				'#sidebar .widget.widget_recent_posts h3 a:hover',
				'#footer-widgets .widget.widget_recent_posts h3 a:hover',
				'#sidebar .widget.widget_calendar tbody #today a',
				'#footer-widgets .widget.widget_calendar tbody #today a',
				'#footer-widgets .widget.widget_categories ul li a:hover',
				'#footer-widgets .widget.widget_meta ul li a:hover',
				'#footer-widgets .widget.widget_pages ul li a:hover',
				'#footer-widgets .widget.widget_archive ul li a:hover',
				'#footer-widgets .widget.widget_recent_entries ul li a:hover',
				'#footer-widgets .widget.widget_recent_comments ul li a:hover',
				'#sidebar .widget.widget.widget_information ul li i',
				'#footer-widgets .widget.widget.widget_information ul li i',
				'.widget.widget_nav_menu .menu > li > a:hover',
				'.widget.widget_categories ul li a:before, .widget.widget_meta ul li a:before, .widget.widget_pages ul li a:before',
				'.widget.widget_archive ul li a:before',
				'#sidebar .widget.widget_twitter .tweet-text a',
				'.hentry .post-related .post-item h4 a:hover',
				'.bypostauthor > article .comment-author',
				'.logged-in-as a',
				'#bottom ul.bottom-nav > li.current-menu-item > a',
				'#bottom .bottom-socials .icons a:hover',
				// shortcodes
				'.weberium-divider.has-icon .icon-wrap > span.accent',
				'.weberium-list .icon.style-1.accent',
				'.weberium-list .icon.style-3',
				'.weberium-list .icon.style-6',
				'.weberium-info-list .title i',
				'.button-wrap.has-icon .weberium-button.white > span > .icon',
				'.weberium-icon.background .icon.accent',
				 '.weberium-icon-box.accent-outline .icon-wrap',
				 '.weberium-icon-box.grey-outline .icon-wrap',
				 '.weberium-icon-box.simple .icon-wrap.accent',
				 '.weberium-icon-box.grey-bg .icon-wrap',
				 '.weberium-image-box .item .title a:hover',
				 '.weberium-news .news-item .text-wrap .title a:hover',
				 '.weberium-news-simple .text-wrap .title a:hover',
				 '.weberium-counter .icon-wrap .icon.accent',
				 '.weberium-counter .number-wrap .number.accent',
				 '.weberium-counter .prefix.accent',
				 '.weberium-counter .suffix.accent',
				'.weberium-accordions .accordion-item.active .accordion-heading:hover',
				'.weberium-accordions .accordion-item .accordion-heading:hover',
				'.weberium-accordions .accordion-item .accordion-heading:after',
				 '.project-box.style-1 .project-text h2:hover a',
				'.project-box.style-2 .project-text h2:hover a',
				 '.project-box.style-1 .plus-icon > a:hover',
				 '.project-box.style-2 .plus-icon > a:hover',
				 '.weberium-action-box.has-icon .heading-wrap > .text-wrap > .icon.accent',
				 '.weberium-price-table .price-table-price .figure.accent',
				 '.weberium-price-table .price-table-features ul.style-1 li > span:before',
				 '.weberium-countdown.accent .numb',
				 // Woocommerce
				 '.products li .price',
				 '.products li h2:hover, .products li .product-info .add_to_cart_button:hover',
				 '.woo-single-post-class .summary .price',
				 '.woocommerce-page .shop_table.cart .product-name a:hover',
				 '.woocommerce-page .woocommerce-message .button, .woocommerce-page .woocommerce-info .button, .woocommerce-page .woocommerce-error .button',
				 '.woocommerce-page .product_list_widget .product-title:hover, .woocommerce-page .widget_recent_reviews .product_list_widget a:hover, .woocommerce-page .product_list_widget .mini_cart_item a:hover',
				 '.woocommerce-page .widget_product_categories ul li a:hover',
				 // Default Link
				 'a',
			) );

			// Background color
			$backgrounds = apply_filters( 'weberium_accent_backgrounds', array(
				'blockquote:before',
				'.top-bar-style-3 #top-bar',
				'.top-bar-menu li a:before',
				'.top-bar-style-1 .top-bar-menu li a:before',
				'.top-bar-style-2 .top-bar-menu li a:before',
				'.top-bar-style-1 #top-bar .top-bar-button a:hover',
				'.top-bar-style-2 #top-bar .top-bar-button a:hover',
				'#main-nav li.megamenu > ul.sub-menu > .menu-item-has-children > a:before',
				'.header-style-1 .nav-top-cart-wrapper .shopping-cart-items-count',
				'.header-style-2 .nav-top-cart-wrapper .shopping-cart-items-count',
				'.header-style-3 #site-header',
				'.header-style-4 .nav-top-cart-wrapper .shopping-cart-items-count',
				'.header-style-1.cur-menu-1 #main-nav > ul > li.current-menu-item > a:before',
				'.header-style-1.cur-menu-1 #main-nav > ul > li.current-menu-parent > a:before',
				'.header-style-1.cur-menu-1 #main-nav > ul > li > a:before',
				'.header-style-1.cur-menu-3 #main-nav > ul > li.current-menu-item > a > span',
				'.header-style-1.cur-menu-3 #main-nav > ul > li.current-menu-parent > a > span',
				'.header-style-1.cur-menu-4 #main-nav > ul > li.current-menu-item > a:before',
				'.header-style-1.cur-menu-4 #main-nav > ul > li.current-menu-parent > a:before',
				'.header-style-1.cur-menu-4 #main-nav > ul > li > a:before',
				'.header-style-2.cur-menu-1 #main-nav > ul > li.current-menu-item > a:before',
				'.header-style-2.cur-menu-1 #main-nav > ul > li.current-menu-parent > a:before',
				'.header-style-2.cur-menu-1 #main-nav > ul > li > a:before',
				'.header-style-2.cur-menu-3 #main-nav > ul > li.current-menu-item > a > span',
				'.header-style-2.cur-menu-3 #main-nav > ul > li.current-menu-parent > a > span',
				'.header-style-2.cur-menu-4 #main-nav > ul > li.current-menu-item > a:before',
				'.header-style-2.cur-menu-4 #main-nav > ul > li.current-menu-parent > a:before',
				'.header-style-2.cur-menu-4 #main-nav > ul > li > a:before',
				'.header-style-4.cur-menu-3 #main-nav > ul > li.current-menu-item > a > span',
				'.header-style-4.cur-menu-3 #main-nav > ul > li.current-menu-parent > a > span',
				'.header-style-4.cur-menu-4 #main-nav > ul > li.current-menu-item > a:before',
				'.header-style-4.cur-menu-4 #main-nav > ul > li.current-menu-parent > a:before',
				'.header-style-4.cur-menu-4 #main-nav > ul > li > a:before',
				'#featured-title .featured-title-heading:before',
				'.post-media .slick-prev:hover, .post-media .slick-next:hover', '.post-media .slick-dots li.slick-active button',
				'.header-style-4 #site-header .header-aside-btn a',
				'.hentry .post-share a:hover:after',
				'.comments-area .comments-title:after',
				'.comments-area .comment-reply-title:after',
				'#scroll-top:hover:before',
				'.widget.widget_nav_menu .menu > li.current-menu-item:before',
				'#sidebar .widget.widget_socials .socials a:hover, #footer-widgets .widget.widget_socials .socials a:hover',
				'.button-widget a:hover',
				'#sidebar .widget.widget_tag_cloud .tagcloud a:hover',
				'#footer-widgets .widget.widget_tag_cloud .tagcloud a:hover',
				'.widget_product_tag_cloud .tagcloud a:hover',
				'#footer-widgets .widget .widget-title > span:after',
				'#sidebar .widget .widget-title > span:after, #footer-widgets .widget .widget-title > span:after',
				'.widget.widget_nav_menu .menu > li.current_page_parent:before, .widget.widget_nav_menu .menu > li.current-menu-item:before',
				'.hentry .post-link a',
				'.hentry .post-related .post-thumb .post-cat-related a',
				'.hentry .post-tags a:hover',
				'.hentry .post-related .slick-next:hover:before',
				'.hentry .post-related .slick-prev:hover:before',
				'.nav-top-cart-wrapper .nav-shop-cart .buttons > a:first-child',
				'.comment-reply a:hover',
				'.footer-promotion',
				// shortcodes
				'.weberium-button.accent',
				'.weberium-button.outline:hover',
				'.weberium-button.outline.ol-accent:hover',
				'.weberium-button.dark:hover',
				'.weberium-button.light:hover',
				'.weberium-button.very-light:hover',
				'.weberium-button.outline.dark:hover',
				'.weberium-button.outline.light:hover',
				'.weberium-button.outline.very-light:hover',
				'.weberium-list .icon.style-2',
				'.weberium-list .icon.style-5',
				'.weberium-headings .sep.accent',
				'.weberium-counter .sep.accent',
				'.weberium-icon.background .icon.bg-accent',
				'.weberium-icon-box .btn .simple-link:after',
				'.weberium-icon-box.accent-bg .icon-wrap', '.weberium-icon-box.grey-bg:hover .icon-wrap', '.weberium-icon-box.grey-bg .icon-wrap:after', '.weberium-icon-box.accent-outline:hover .icon-wrap', '.weberium-icon-box.accent-outline .icon-wrap:after', '.weberium-icon-box.grey-outline:hover .icon-wrap', '.weberium-icon-box.grey-outline .icon-wrap:after',
				'.weberium-image-box .item .simple-link:after',
				'.weberium-news .news-item .simple-link:after',
				'.weberium-news .post-date-custom > span:first-child',
				'#project-filter .cbp-filter-item:before',
				'.owl-theme .owl-nav [class*="owl-"]:hover',
				'.has-arrows .cbp-nav-next',
				'.has-arrows .cbp-nav-prev',
				'.bullet-style-1 .cbp-nav-pagination-active', '.bullet-style-2 .cbp-nav-pagination-active ',
				'.weberium-lines .line-1',
				'.weberium-navbar .menu > li.current-nav-item > a',
				'.weberium-progress.style-2.pstyle-1 .perc > span',
				'.weberium-progress .progress-animate.accent',
				'.weberium-socials a:hover', '.weberium-socials.style-2 a:hover',
				'.weberium-team .team-item .socials li a:hover',
				'.weberium-price-table .price-table-name .title.accent', '.weberium-price-table .price-table-price.accent',
				'.weberium-menu-list .value',
				'.owl-theme .owl-dots .owl-dot.active span',
				'.weberium-subscribe.bg-accent',
				'.weberium-subscribe .form-wrap .submit-wrap button',
				'.weberium-tabs.style-2 .tab-title .item-title.active',
				'.weberium-tabs.style-3 .tab-title .item-title.active',
				'.weberium-action-box.accent',
				'.weberium-countdown.accent-bg .column',
				'.weberium-content-box .inner.accent, .weberium-content-box .inner.dark-accent, .weberium-content-box .inner.light-accent',
				'.wpcf7-form .button-accent .wrap-submit input',
				'.weberium-subscribe.bg-dark .mc4wp-form .submit-wrap input',
				'.weberium-subscribe.bg-light .mc4wp-form .submit-wrap input',
				// woocemmerce
				'.product .onsale',
				'.products li .product-info .add_to_cart_button:after, .products li .product-info .product_type_variable:after',
				'.woocommerce-page .wc-proceed-to-checkout .button', '.woocommerce-page #payment #place_order',
				'.woocommerce-page .widget_shopping_cart .wc-forward:hover, .woocommerce-page .widget_shopping_cart .wc-forward.checkout:hover',
				'.products li .product-info .added_to_cart',
			) );

			// Border color
			$borders = apply_filters( 'weberium_accent_borders', array(
				'.animsition-loading:after',
				'.weberium-pagination ul li a.page-numbers:hover',
				'.woocommerce-pagination .page-numbers li .page-numbers:hover',
				'.woocommerce-pagination .page-numbers li .page-numbers.current',
				'#sidebar .widget.widget_tag_cloud .tagcloud a:hover',
				'#footer-widgets .widget.widget_tag_cloud .tagcloud a:hover',
				'.widget_product_tag_cloud .tagcloud a:hover',
				'.button-widget a:hover',
				'.hentry .post-tags a:hover',
				'.weberium-pagination ul li a.page-numbers:hover, .weberium-pagination ul li .page-numbers.current',
				'.comment-reply a:hover',
				// shortcodes
				'.weberium-divider.divider-solid.accent',
				'.divider-icon-before.accent, .divider-icon-after.accent, .weberium-divider.has-icon .divider-double.accent',
				'.weberium-button.outline.ol-accent',
				'.weberium-button.outline.dark:hover',
				'.weberium-button.outline.light:hover',
				'.weberium-button.outline.very-light:hover',
				'.weberium-icon.outline .icon', 
				'.weberium-icon-box.grey-bg:hover .icon-wrap:after', '.weberium-icon-box.accent-outline .icon-wrap', '.weberium-icon-box.grey-outline:hover .icon-wrap',
				'.weberium-navbar .menu > li.current-nav-item > a',
				'.weberium-progress.style-2.pstyle-1 .perc > span:after',
				'.weberium-tabs.style-1 .tab-title .item-title.active > span',
				'.weberium-tabs.style-2 .tab-title .item-title.active > span',
				'.weberium-tabs.style-4 .tab-title .item-title.active > span',
				'.weberium-price-table.border-accent',
				// woocommerce
				'.woo-single-post-class .woocommerce-tabs ul li.active',
				'.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle',
				'.woocommerce-page .widget_shopping_cart .wc-forward',
				'.woocommerce-page .widget_shopping_cart .wc-forward:hover, .woocommerce-page .widget_shopping_cart .wc-forward.checkout:hover',
				'.woocommerce-page .widget_price_filter .price_slider_amount .button:hover'
			) );

			// Second color
			$second_accent = apply_filters( 'weberium_sencond_accent', array(
				'.hentry .post-title > span',
				'.hentry .post-related .post-item h4 > span',
				'.products li h2 > span',
				'.woo-single-post-class .summary h1 > span',
				'.project-related-wrap .title > span'
			) );

			$second_accent2 = apply_filters( 'weberium_sencond_accent2', array(
				'.hentry .post-author .name:after',
				'.comment-author:after',
				'.woo-single-post-class .woocommerce-tabs .entry-content .meta .woocommerce-review__author:after'
			) );

			$second_accent3 = apply_filters( 'weberium_sencond_accent3', array(
				'.weberium-icon-box .heading.style-2.accent-2 span',
				'.weberium-single-heading.style-3 .heading.accent-2 span',
				'.weberium-team .name > span',
				'.weberium-testimonials .name > span',
				'.weberium-price-table .price-table-price .price-wrap > span',
				'.weberium-news .news-item .text-wrap .title > span',
				'.project-box.style-2 .project-text h2 > span',
			) );

			// Return array
			if ( 'texts' == $return ) {
				return $texts;
			} elseif ( 'backgrounds' == $return ) {
				return $backgrounds;
			} elseif ( 'borders' == $return ) {
				return $borders;
			} elseif ( 'second_accent' == $return ) {
				return $second_accent;
			} elseif ( 'second_accent2' == $return ) {
				return $second_accent2;
			} elseif ( 'second_accent3' == $return ) {
				return $second_accent3;
			}
		}

		// Generates the CSS output
		public static function generate( $output ) {

			// Get custom accent
			$default_accent = '#f54e24';
			$custom_accent  = weberium_get_mod( 'accent_color' );

			// Get custom second color
			$default_second_color = '#b9e9e9';
			$custom_second_color  = weberium_get_mod( 'second_color' );

			// Return if custom color is empty or equal to default
			if ( 
				( ! $custom_accent || ( $default_accent == $custom_accent ) )
				&& ( ! $custom_second_color || ( $default_second_color == $custom_second_color ) )
			)
			return $output;

			// Define css var
			$css = '';

			// Get arrays
			$texts = self::arrays( 'texts' );
			$backgrounds = self::arrays( 'backgrounds' );
			$borders = self::arrays( 'borders' );
			$second_accent = self::arrays( 'second_accent' );
			$second_accent2 = self::arrays( 'second_accent2' );
			$second_accent3 = self::arrays( 'second_accent3' );

			// Texts
			if ( ! empty( $texts ) )
				$css .= implode( ',', $texts ) .'{color:'. $custom_accent .';}';

			// Backgrounds
			if ( ! empty( $backgrounds ) )
				$css .= implode( ',', $backgrounds ) .'{background-color:'. $custom_accent .';}';

			// Borders
			if ( ! empty( $borders ) ) {
				foreach ( $borders as $key => $val ) {
					if ( is_array( $val ) ) {
						$css .= $key .'{';
						foreach ( $val as $key => $val ) {
							$css .= 'border-'. $val .'-color:'. $custom_accent .';';
						}
						$css .= '}'; 
					} else {
						$css .= $val .'{border-color:'. $custom_accent .';}';
					}
				}
			}

			// Second bg image
			if ( ! empty( $second_accent ) )
				$css .= implode( ',', $second_accent ) .'{background-image:linear-gradient(to right,'. $custom_second_color .' 0%, '. $custom_second_color .' 100%);}';

			// Second bg color
			if ( ! empty( $second_accent2 ) )
				$css .= implode( ',', $second_accent2 ) .'{background-color:'. $custom_second_color .';}';

			// Second bg color shortcodes
			if ( ! empty( $second_accent3 ) )
				$css .= implode( ',', $second_accent3 ) .'{background-image: -webkit-gradient(linear, left top, right top, from('. $custom_second_color .'), to('. $custom_second_color .')); background-image: linear-gradient(to right,'. $custom_second_color .' 0%, '. $custom_second_color .' 100%);}';

			// Return CSS
			if ( ! empty( $css ) )
				$output .= '/*ACCENT COLOR*/'. $css;

			// Return output css
			return $output;
		}
	}
}

new Weberium_Accent_Color();