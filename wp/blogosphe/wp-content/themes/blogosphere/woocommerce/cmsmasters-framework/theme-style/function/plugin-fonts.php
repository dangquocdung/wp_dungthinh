<?php
/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version 	1.0.0
 * 
 * WooCommerce Fonts Rules
 * Created by CMSMasters
 * 
 */


function blogosphere_woocommerce_fonts($custom_css) {
	$cmsmasters_option = blogosphere_get_global_options();
	
	
	$custom_css .= "
/***************** Start WooCommerce Font Styles ******************/

	/* Start Content Font */
	#page .remove,
	.shop_attributes th, 
	.woocommerce-checkout-payment a, 
	.woocommerce-checkout-payment span, 
	.woocommerce-checkout-payment {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_content_font_google_font']) . $cmsmasters_option['blogosphere' . '_content_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_content_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_content_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_content_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_content_font_font_style'] . ";
	}
	
	.shop_attributes th, 
	.woocommerce-checkout-payment a, 
	.woocommerce-checkout-payment span, 
	.woocommerce-checkout-payment,
	#shipping_method label {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_content_font_font_size'] - 1) . "px;
		text-transform:none;
	}
	
	/* Finish Content Font */
	
	
	/* Start Link Font */
	/* Finish Link Font */
	
	
	/* Start H1 Font */
	/* Finish H1 Font */
	
	
	/* Start H2 Font */
	h2 {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_h2_font_google_font']) . $cmsmasters_option['blogosphere' . '_h2_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_h2_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_h2_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_h2_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_h2_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['blogosphere' . '_h2_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['blogosphere' . '_h2_font_text_decoration'] . ";
	}
	/* Finish H2 Font */
	
	
	/* Start H3 Font */
	.cmsmasters_single_product .product_title, 
	.cmsmasters_products .product.product-category .woocommerce-loop-category__title, 
	.cmsmasters_product .cmsmasters_product_title, 
	.cmsmasters_product .cmsmasters_product_title a {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_h3_font_google_font']) . $cmsmasters_option['blogosphere' . '_h3_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_h3_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_h3_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_h3_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_h3_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['blogosphere' . '_h3_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['blogosphere' . '_h3_font_text_decoration'] . ";
	}
	
	.cmsmasters_single_product .product_title {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_h3_font_font_size'] + 2) . "px;
		line-height:" . ((int) $cmsmasters_option['blogosphere' . '_h3_font_line_height'] + 2) . "px;
	}
	/* Finish H3 Font */
	
	
	/* Start H4 Font */
	h4 {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_h4_font_google_font']) . $cmsmasters_option['blogosphere' . '_h4_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_h4_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_h4_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_h4_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_h4_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['blogosphere' . '_h4_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['blogosphere' . '_h4_font_text_decoration'] . ";
	}
	/* Finish H4 Font */
	
	
	/* Start H5 Font */
	.onsale, 
	.out-of-stock, 
	.stock, 
	.cart_totals table th,	
	.shipping-calculator-button, 
	.cart_totals > h2, 
	.shipping-calculator-form > p button, 
	#order_review_heading, 
	.woocommerce-checkout-review-order tbody td, 
	.woocommerce-checkout-review-order tfoot td, 
	.woocommerce-checkout-review-order tfoot th, 
	.cart_totals table .cart-subtotal .amount, 
	.cart_totals table .order-total .amount, 
	.checkout .form-row label, 
	.widget_layered_nav ul li, 
	.widget_layered_nav ul li a, 
	.widget_layered_nav_filters ul li, 
	.widget_layered_nav_filters ul li a, 
	.woocommerce-MyAccount-content .woocommerce-Addresses h3,
	.woocommerce-MyAccount-content .shop_table th,  
	.woocommerce-MyAccount-content .shop_table td,
	.woocommerce-MyAccount-content .shop_table td.woocommerce-orders-table__cell-order-number a,
	.widget_product_categories ul li, 
	.widget_product_categories ul li a, 
	.woocommerce-billing-fields > h3, 
	.woocommerce-shipping-fields > h3, 
	ul.order_details, 
	.woocommerce-additional-fields h3,
	.woocommerce-MyAccount-content form .form-row label, 
	.woocommerce-MyAccount-content legend, 
	#customer_login h2, 
	#customer_login label,
	section.products h2,	
	.shop_table tfoot th,
	.shop_table tfoot td,
	.woocommerce-column__title,
	.widget_rating_filter a,
	.woocommerce-MyAccount-navigation a,
	ul.order_details strong, 
	.comment-form-rating label, 
	.cmsmasters_single_product .price ins,
	.cmsmasters_single_product .price .woocommerce-Price-amount, 
	.woocommerce-customer-details h2, 
	.cross-sells h2, 
	.woocommerce-order-details__title, 
	.widget_shopping_cart .total, 
	.widget_shopping_cart .total strong {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_h5_font_google_font']) . $cmsmasters_option['blogosphere' . '_h5_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_h5_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_h5_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_h5_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_h5_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['blogosphere' . '_h5_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['blogosphere' . '_h5_font_text_decoration'] . ";
		letter-spacing:0;
	}
	
	.comment-form-rating label {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_h5_font_font_size'] - 3) . "px;
		line-height:" . ((int) $cmsmasters_option['blogosphere' . '_h5_font_line_height'] - 3) . "px;
	}
	
	.cmsmasters_single_product .price .woocommerce-Price-amount, 
	.cmsmasters_single_product .price ins {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_h5_font_font_size'] + 5) . "px;
		line-height:" . ((int) $cmsmasters_option['blogosphere' . '_h5_font_line_height'] + 5) . "px;
	}
	
	.cmsmasters_product .price, 
	.cmsmasters_product ins {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_h5_font_google_font']) . $cmsmasters_option['blogosphere' . '_h5_font_system_font'] . ";
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_h5_font_font_size'] + 1) . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_h5_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_h5_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_h5_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['blogosphere' . '_h5_font_text_transform'] . ";
	}
	
	.onsale, 
	.out-of-stock, 
	.stock {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_h5_font_font_size'] - 4) . "px;
		line-height:" . ((int) $cmsmasters_option['blogosphere' . '_h5_font_line_height'] - 4) . "px;
	}
	
	.widget_shopping_cart .total, 
	.widget_shopping_cart .total strong {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_h5_font_font_size'] + 2) . "px;
		line-height:" . ((int) $cmsmasters_option['blogosphere' . '_h5_font_line_height'] + 2) . "px;
	}
	/* Finish H5 Font */
	
	
	/* Start H6 Font */s
	.woocommerce-cart-form .shop_table .product-name a,
	.woocommerce-cart-form .shop_table .product-name strong,
	.woocommerce-cart-form .shop_table .product-total,
	.widget > .product_list_widget a, 
	.widget_shopping_cart .cart_list a, 
	.cmsmasters_added_product_info .cmsmasters_added_product_info_text, 
	.widget_shopping_cart_content .cart_list a {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_h6_font_google_font']) . $cmsmasters_option['blogosphere' . '_h6_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_h6_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_h6_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_h6_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_h6_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['blogosphere' . '_h6_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['blogosphere' . '_h6_font_text_decoration'] . ";
	}
	
	.woocommerce-cart-form .shop_table .product-name a,
	.woocommerce-cart-form .shop_table .product-name strong,
	.woocommerce-cart-form .shop_table .product-total {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_h6_font_font_size'] + 1) . "px;
	}
	/* Finish H6 Font */
	
	
	/* Start Button Font */
	.widget_shopping_cart_content .buttons .button {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_button_font_google_font']) . $cmsmasters_option['blogosphere' . '_button_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_button_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_button_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_button_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_button_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['blogosphere' . '_button_font_text_transform'] . ";
	}
	
	.cmsmasters_single_product .cart .single_add_to_cart_button {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_button_font_font_size'] - 1) . "px;
	}
	
	.shop_table input[type=submit] {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_button_font_font_size'] - 1) . "px;
		line-height:" . ((int) $cmsmasters_option['blogosphere' . '_button_font_line_height'] + 6) . "px;
	}
	
	.widget_price_filter .price_slider_amount .button, 
	.widget_shopping_cart_content .buttons .button {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_button_font_font_size'] - 2) . "px;
		line-height:" . ((int) $cmsmasters_option['blogosphere' . '_button_font_line_height'] - 4) . "px;
	}
	/* Finish Button Font */
	
	
	/* Start Text Fields Font */
	.select2-dropdown {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_input_font_google_font']) . $cmsmasters_option['blogosphere' . '_input_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_input_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_input_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_input_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_input_font_font_style'] . ";
	}
	/* Finish Text Fields Font */
	
	
	/* Start Small Text Font */
	.shop_table .product-name a,
	.shop_table .product-name strong,
	.shop_table .product-total,
	.cmsmasters_product del, 
	.shop_attributes td, 
	.widget > .product_list_widget .amount, 
	.widget > .product_list_widget .reviewer, 
	.cmsmasters_single_product .price del .woocommerce-Price-amount,
	.cmsmasters_single_product .product_meta, 
	.cmsmasters_single_product .product_meta a, 
	.cmsmasters_product .cmsmasters_product_cat, 
	.cmsmasters_product .cmsmasters_product_cat a, 
	.cmsmasters_woo_wrap_result .woocommerce-result-count, 
	.widget_shopping_cart_content .total, 
	.widget_shopping_cart_content .total strong, 
	.widget_shopping_cart .cart_list .quantity, 
	.woocommerce-customer-details table th, 
	.woocommerce-customer-details table td,
	.woocommerce-MyAccount-content .woocommerce-Addresses .woocommerce-Address-title a,
	.widget_shopping_cart_content .cart_list .quantity *, 
	.widget_shopping_cart_content .cart_list .quantity, 
	.widget_price_filter .price_slider_amount .price_label {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_small_font_google_font']) . $cmsmasters_option['blogosphere' . '_small_font_system_font'] . ";
		font-size:" . $cmsmasters_option['blogosphere' . '_small_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['blogosphere' . '_small_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['blogosphere' . '_small_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['blogosphere' . '_small_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['blogosphere' . '_small_font_text_transform'] . ";
	}
	
	.cmsmasters_single_product .price del .woocommerce-Price-amount {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_small_font_font_size'] + 4) . "px;
		line-height:" . ((int) $cmsmasters_option['blogosphere' . '_small_font_line_height'] + 4) . "px;
	}
	
	.widget_price_filter .price_slider_amount .price_label, 
	.cmsmasters_product del {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_small_font_font_size'] + 1) . "px;
	}
	
	.widget > .product_list_widget .reviewer, 
	.widget > .product_list_widget del .amount, 
	.shop_attributes td {
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_small_font_font_size'] - 1) . "px;
	}
	
	.shop_table .product-name a, 
	.shop_table .product-name strong, 
	.shop_table .product-total,
	.woocommerce-customer-details table th, 
	.woocommerce-customer-details table td,
	.widget_shopping_cart_content .total, 
	.widget_shopping_cart_content .total strong {
		font-family:" . blogosphere_get_google_font($cmsmasters_option['blogosphere' . '_small_font_google_font']) . $cmsmasters_option['blogosphere' . '_small_font_system_font'] . ";
		font-size:" . ((int) $cmsmasters_option['blogosphere' . '_small_font_font_size'] + 1) . "px;
	}
	
	/* Finish Small Text Font */

/***************** Finish WooCommerce Font Styles ******************/

";
	
	
	return $custom_css;
}

add_filter('blogosphere_theme_fonts_filter', 'blogosphere_woocommerce_fonts');

