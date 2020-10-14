<?php
/**
 * Accent color
 *
 * @package gustablo
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'WPRT_Accent_Color' ) ) {
	class WPRT_Accent_Color {
		// Main constructor
		public function __construct() {
			add_filter( 'wprt_footer_css', array( 'WPRT_Accent_Color', 'generate' ), 1 );
		}

		// Generates arrays of elements to target
		private static function arrays( $return ) {
			// Color
			$texts = apply_filters( 'wprt_accent_texts', array(
				'.text-accent-color', '#site-logo .site-logo-text:hover',
				'.top-bar-style-2 #top-bar .top-bar-content .content:before',
				'.top-bar-style-1 #top-bar .top-bar-socials .icons a:hover',
				'.top-bar-style-2 #top-bar .top-bar-socials .icons a:hover',
				'.nav-top-cart-wrapper .nav-shop-cart ul li a.remove',
				'.nav-top-cart-wrapper .nav-shop-cart ul li a:hover',
				'.header-style-1 #site-header .header-search-icon:hover',
				'.header-style-1.cur-menu-2 #main-nav > ul > li.current-menu-item > a',
				'.header-style-1.cur-menu-2 #main-nav > ul > li.current-menu-parent > a',
				'.header-style-2 #main-nav > ul > li > a:hover',
				'.header-style-2 #site-header .header-search-icon:hover',
				'.header-style-2.cur-menu-2 #main-nav > ul > li.current-menu-item > a',
				'.header-style-2.cur-menu-2 #main-nav > ul > li.current-menu-parent > a',
				'.header-style-4 #main-nav > ul > li > a:hover',
				'.header-style-4.cur-menu-2 #main-nav > ul > li.current-menu-item > a',
				'.header-style-4.cur-menu-2 #main-nav > ul > li.current-menu-parent > a',
				'.header-style-5 #header-aside .header-info .heading:before',
				'#breadcrumbs a:hover',
				'#breadcrumbs .breadcrumb-trail > a:before, #breadcrumbs .breadcrumb-trail > span:before',
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
				'.widget.widget_archive ul li a:before',
				'#sidebar .widget.widget_twitter .tweet-text a',
				'.hentry .post-related .post-item h4 a:hover',
				'.bypostauthor > article .comment-author',
				'.logged-in-as a',
				// shortcodes
				'.wprt-divider.has-icon .icon-wrap > span.accent',
				'.wprt-list .icon.style-1.accent',
				'.wprt-list .icon.style-3',
				'.wprt-list .icon.style-6',
				'.wprt-info-list .title i',
				'.button-wrap.has-icon .wprt-button.white > span > .icon',
				'.wprt-icon.background .icon.accent',
				 '.wprt-icon-box.accent-outline .icon-wrap',
				 '.wprt-icon-box.grey-outline .icon-wrap',
				 '.wprt-icon-box.simple .icon-wrap.accent',
				 '.wprt-icon-box.grey-bg .icon-wrap',
				 '.wprt-image-box .item .title a:hover',
				 '.wprt-news .news-item .text-wrap .title a:hover',
				 '.wprt-news-simple .text-wrap .title a:hover',
				 '.wprt-counter .icon-wrap .icon.accent',
				 '.wprt-counter .number-wrap .number.accent',
				 '.wprt-counter .prefix.accent',
				 '.wprt-counter .suffix.accent',
				 '.wprt-accordions .accordion-item.active .accordion-heading:after',
				 '.wprt-accordions .accordion-item .accordion-heading:hover',
				 '.gallery-box.style-1 .gallery-text h2:hover a',
				 '.project-box.style-3 h2 a:hover',
				 '.wprt-subscribe.style-1.bg-light .heading-wrap:before',
				 '.wprt-subscribe.style-1.bg-dark .heading-wrap:before',
				 '.wprt-subscribe.style-2.bg-light .heading-wrap:before',
				 '.wprt-action-box.has-icon .heading-wrap > .text-wrap > .icon.accent',
				 '.wprt-price-table .price-table-price .figure.accent',
				 '.wprt-price-table .price-table-features ul.style-1 li > span:before',
				 '.food-box .food-detail .food-price',
				 '.wprt-testimonials .name.accent',
				'.wprt-news-event .title:hover a',
				 // Woocommerce
				 '.products li .price',
				 '.products li h2:hover, .products li .product-info .add_to_cart_button:hover',
				 '.woo-single-post-class .summary .price',
				 '.woocommerce-page .shop_table.cart .product-name a:hover',
				 '.woocommerce-page .woocommerce-message .button, .woocommerce-page .woocommerce-info .button, .woocommerce-page .woocommerce-error .button',
				 '.woocommerce-page .product_list_widget .product-title:hover, .woocommerce-page .widget_recent_reviews .product_list_widget a:hover, .woocommerce-page .product_list_widget .mini_cart_item a:hover',
				 '.woocommerce-page .widget_product_categories ul li a:hover',
				 '.woocommerce-page .shipping-calculator-button',
				 // Default Link
				 'a',
			) );

			// Background color
			$backgrounds = apply_filters( 'wprt_accent_backgrounds', array(
				'blockquote:before',
				'.top-bar-style-3 #top-bar',
				'.top-bar-menu li a:before',
				'.header-style-1 .nav-top-cart-wrapper .shopping-cart-items-count',
				'.header-style-1.cur-menu-1 #main-nav > ul > li.current-menu-item > a:before',
				'.header-style-1.cur-menu-1 #main-nav > ul > li.current-menu-parent > a:before',
				'.header-style-1.cur-menu-1 #main-nav > ul > li > a:before',
				'.header-style-1.cur-menu-3 #main-nav > ul > li.current-menu-item > a > span',
				'.header-style-1.cur-menu-3 #main-nav > ul > li.current-menu-parent > a > span',
				'.header-style-2 .nav-top-cart-wrapper .shopping-cart-items-count',
				'.header-style-2.cur-menu-1 #main-nav > ul > li.current-menu-item > a:before',
				'.header-style-2.cur-menu-1 #main-nav > ul > li.current-menu-parent > a:before',
				'.header-style-2.cur-menu-3 #main-nav > ul > li.current-menu-item > a > span',
				'.header-style-2.cur-menu-3 #main-nav > ul > li.current-menu-parent > a > span',
				'.header-style-2.cur-menu-4 #main-nav > ul > li > a:before',
				'.header-style-2.cur-menu-4 #main-nav > ul > li.current-menu-item > a:before, .header-style-2.cur-menu-4 #main-nav > ul > li.current-menu-parent > a:before',
				'.header-style-3 #site-header',
				'.header-style-4 .nav-top-cart-wrapper .shopping-cart-items-count',
				'.header-style-4.cur-menu-3 #main-nav > ul > li.current-menu-item > a > span',
				'.header-style-4.cur-menu-3 #main-nav > ul > li.current-menu-parent > a > span',
				'.header-style-4.cur-menu-4 #main-nav > ul > li.current-menu-item > a:before',
				'.header-style-4.cur-menu-4 #main-nav > ul > li.current-menu-parent > a:before',
				'.header-style-4.cur-menu-4 #main-nav > ul > li > a:before',
				'#main-nav .sub-menu li a:before',
				'.nav-top-cart-wrapper .nav-shop-cart:before',
				'#site-header .header-search-form:before',
				'#featured-title .featured-title-heading:before',
				'.post-media .slick-prev:hover, .post-media .slick-next:hover', '.post-media .slick-dots li.slick-active button',
				'.post-media > .post-cat a',
				'.header-style-4 #site-header .header-aside-btn a',
				'.wprt-pagination ul li a.page-numbers:hover',
				'.woocommerce-pagination .page-numbers li .page-numbers:hover',
				'.wprt-pagination ul li .page-numbers.current',
				'.woocommerce-pagination .page-numbers li .page-numbers.current',
				'.hentry .post-share a:hover:after',
				'.comments-area .comments-title:after',
				'.comments-area .comment-reply-title:after',
				'#scroll-top:hover:before',
				'.widget.widget_categories ul li a:before, .widget.widget_meta ul li a:before, .widget.widget_pages ul li a:before, .widget.widget_archive ul li a:before,.widget.widget_recent_entries ul li a:before, .widget.widget_recent_comments ul li:before, .widget.widget_nav_menu ul li a:before',
				'#sidebar .widget.widget_socials .socials a:hover, #footer-widgets .widget.widget_socials .socials a:hover',
				'.button-widget a:hover',
				'.hentry .post-author .author-socials > a:hover',
				'#sidebar .widget.widget_tag_cloud .tagcloud a:hover:after',
				'#footer-widgets .widget.widget_tag_cloud .tagcloud a:hover:after',
				'.widget_product_tag_cloud .tagcloud a:hover:after',
				'#footer-widgets .widget .widget-title > span:after',
				'#footer-widgets .widget.widget_recent_posts .recent-news .thumb.icon',
				'.post-date-custom > span:first-child',
				'#sidebar .widget .widget-title > span:after, #footer-widgets .widget .widget-title > span:after',
				'#sidebar .widget.widget_recent_posts .recent-news .thumb.icon, #footer-widgets .widget.widget_recent_posts .recent-news .thumb.icon',
				'#sidebar .widget.widget_twitter .tweet-icon',
				'.hentry .post-related .post-thumb .post-cat-related a',
				'.hentry .post-tags a:hover',
				'.hentry .post-tags a:hover:after',
				'.hentry .post-related .slick-next:hover, .hentry .post-related .slick-prev:hover',
				'.nav-top-cart-wrapper .nav-shop-cart .buttons > a:first-child',
				'.comment-reply a:hover',
				'.footer-promotion',
				// shortcodes
				'.wprt-button.accent',
				'.wprt-button.outline:hover',
				'.wprt-button.outline.ol-accent:hover',
				'.wprt-button.dark:hover',
				'.wprt-button.light:hover',
				'.wprt-button.very-light:hover',
				'.wprt-button.outline.dark:hover',
				'.wprt-button.outline.light:hover',
				'.wprt-button.outline.very-light:hover',
				'.wprt-list .icon.style-2',
				'.wprt-list .icon.style-5',
				'.wprt-headings .sep.accent',
				'.wprt-counter .sep.accent',
				'.wprt-icon.background .icon.bg-accent',
				'.wprt-icon-box .btn .simple-link:after',
				'.wprt-icon-box.accent-bg .icon-wrap', '.wprt-icon-box.grey-bg:hover .icon-wrap', '.wprt-icon-box.grey-bg .icon-wrap:after', '.wprt-icon-box.accent-outline:hover .icon-wrap', '.wprt-icon-box.accent-outline .icon-wrap:after', '.wprt-icon-box.grey-outline:hover .icon-wrap', '.wprt-icon-box.grey-outline .icon-wrap:after',
				'.wprt-image-box .item .simple-link:after',
				'.wprt-news .news-item .simple-link:after',
				'.wprt-news .post-date-custom > span:first-child',
				'.wprt-news .news-item .post-cat a',
				'#gallery-filter .cbp-filter-item.cbp-filter-item-active',
				'.gallery-box.style-1 .gallery-image .link, .gallery-box.style-1 .gallery-image .zoom-popup',
				'.gallery-box.style-2:hover .gallery-text',
				'.owl-theme .owl-nav [class*="owl-"]:hover',
				'.has-arrows .cbp-nav-next',
				'.has-arrows .cbp-nav-prev',
				'.bullet-style-1 .cbp-nav-pagination-active', '.bullet-style-2 .cbp-nav-pagination-active ',
				'.wprt-lines .line-1.accent, .wprt-lines .line-2.accent',
				'.wprt-navbar .menu > li.current-nav-item > a',
				'.wprt-progress.style-2.pstyle-1 .perc > span',
				'.wprt-progress .progress-animate.accent',
				'.wprt-socials a:hover', '.wprt-socials.style-2 a:hover',
				'.wprt-team .socials li a:hover',
				'.wprt-price-table .price-table-name .title.accent', '.wprt-price-table .price-table-price.accent',
				'.wprt-menu-list .value',
				'.owl-theme .owl-dots .owl-dot.active span',
				'.wprt-subscribe.bg-accent',
				'.wprt-subscribe .mc4wp-form .submit-wrap input',
				'.wprt-action-box.accent',
				'.wprt-accordions .accordion-item.active .accordion-heading:before',
				'.wprt-content-box .inner.accent, .wprt-content-box .inner.dark-accent, .wprt-content-box .inner.light-accent',
				'.wprt-image-video .icon-wrap:hover',
				'.wprt-countdown.accent .numb, .wprt-countdown.accent-grey .numb',
				// woocemmerce
				'.product .onsale',
				'.products li .product-info .add_to_cart_button:after, .products li .product-info .product_type_variable:after',
				'.woocommerce-page .wc-proceed-to-checkout .button', '.woocommerce-page #payment #place_order',
				'.woocommerce-page .widget_shopping_cart .wc-forward:hover, .woocommerce-page .widget_shopping_cart .wc-forward.checkout:hover',
				'.products li .product-info .added_to_cart',
				'.widget_product_categories ul li a:before',
			) );

			// Border color
			$borders = apply_filters( 'wprt_accent_borders', array(
				'.animsition-loading:after',
				'.wprt-pagination ul li a.page-numbers:hover',
				'.woocommerce-pagination .page-numbers li .page-numbers:hover',
				'.wprt-pagination ul li .page-numbers.current',
				'.woocommerce-pagination .page-numbers li .page-numbers.current',
				'#sidebar .widget.widget_socials .socials a:hover, #footer-widgets .widget.widget_socials .socials a:hover',
				'.button-widget a:hover',
				'.hentry .post-tags a:hover',
				'.hentry .post-tags a:hover:after',
				'#sidebar .widget.widget_tag_cloud .tagcloud a:hover:after',
				'#footer-widgets .widget.widget_tag_cloud .tagcloud a:hover:after',
				'.widget_product_tag_cloud .tagcloud a:hover:after',
				// shortcodes
				'.wprt-divider.divider-solid.accent',
				'.divider-icon-before.accent, .divider-icon-after.accent, .wprt-divider.has-icon .divider-double.accent',
				'.wprt-button.outline.ol-accent',
				'.wprt-button.outline.dark:hover',
				'.wprt-button.outline.light:hover',
				'.wprt-button.outline.very-light:hover',
				'.wprt-icon.outline .icon', 
				'.wprt-icon-box.grey-bg:hover .icon-wrap:after', '.wprt-icon-box.accent-outline .icon-wrap', '.wprt-icon-box.grey-outline:hover .icon-wrap',
				'.wprt-navbar .menu > li.current-nav-item > a',
				'.wprt-progress.style-2.pstyle-1 .perc > span:after',
				'.wprt-price-table.border-accent',
				'.wprt-tabs.style-1 .tab-title .item-title.active > span',
				'.wprt-tabs.style-2 .tab-title .item-title.active > span',
				// woocommerce
				'.woo-single-post-class .woocommerce-tabs ul li.active',
				'.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle',
				'.woocommerce-page .widget_shopping_cart .wc-forward',
				'.woocommerce-page .widget_shopping_cart .wc-forward:hover, .woocommerce-page .widget_shopping_cart .wc-forward.checkout:hover',
				'.woocommerce-page .widget_price_filter .price_slider_amount .button:hover'
			) );

			// Return array
			if ( 'texts' == $return ) {
				return $texts;
			} elseif ( 'backgrounds' == $return ) {
				return $backgrounds;
			} elseif ( 'borders' == $return ) {
				return $borders;
			}
		}

		// Generates the CSS output
		public static function generate( $output ) {

			// Get custom accent
			$default_accent = '#fd4100';
			$custom_accent  = wprt_get_mod( 'accent_color' );

			// Return if accent color is empty or equal to default
			if ( ! $custom_accent || ( $default_accent == $custom_accent ) )
				return $output;

			// Define css var
			$css = '';

			// Get arrays
			$texts       = self::arrays( 'texts' );
			$backgrounds = self::arrays( 'backgrounds' );
			$borders     = self::arrays( 'borders' );

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
			
			// Return CSS
			if ( ! empty( $css ) )
				$output .= '/*ACCENT COLOR*/'. $css;

			// Return output css
			return $output;
		}
	}
}

new WPRT_Accent_Color();