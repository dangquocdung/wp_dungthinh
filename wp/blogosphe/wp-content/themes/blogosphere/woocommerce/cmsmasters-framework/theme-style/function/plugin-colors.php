<?php
/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version 	1.0.0
 * 
 * WooCommerce Colors Rules
 * Created by CMSMasters
 * 
 */


function blogosphere_woocommerce_colors($custom_css) {
	$cmsmasters_option = blogosphere_get_global_options();
	
	
	$cmsmasters_color_schemes = cmsmasters_color_schemes_list();
	
	
	foreach ($cmsmasters_color_schemes as $scheme => $title) {
		$rule = (($scheme != 'default') ? "html .cmsmasters_color_scheme_{$scheme} " : '');
		
		
		$custom_css .= "
/***************** Start {$title} WooCommerce Color Scheme Rules ******************/

	/* Start Main Content Font Color */
	{$rule}.select2-container .select2-choice, 
	{$rule}.select2-container.select2-drop-above .select2-choice, 
	{$rule}.select2-container.select2-container-active .select2-choice, 
	{$rule}.select2-container.select2-container-active.select2-drop-above .select2-choice, 
	{$rule}.select2-drop.select2-drop-active, 
	{$rule}.select2-drop.select2-drop-above.select2-drop-active {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_color']) . "
	}
	
	{$rule}.select2-dropdown .select2-results .select2-results__option,
	{$rule}.select2-container .select2-selection--single .select2-selection__rendered {
		color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['blogosphere' . '_' . $scheme . '_color']) . ", .5);
	}
	/* Finish Main Content Font Color */
	
	
	/* Start Primary Color */
	{$rule}.required, 
	{$rule}#page .remove:hover, 
	{$rule}.cmsmasters_products .product.product-category .woocommerce-loop-category__title:hover, 
	{$rule}.cmsmasters_products .product.product-category .woocommerce-loop-category__title mark, 
	{$rule}.shop_table .product-name a:hover,
	{$rule}.cmsmasters_star_rating .cmsmasters_star_color_wrap, 
	{$rule}.comment-form-rating .stars > span a:hover, 
	{$rule}.comment-form-rating .stars > span a.active, 
	{$rule}.widget_layered_nav ul li a:hover, 
	{$rule}.widget_layered_nav ul li.chosen a, 
	{$rule}.cmsmasters_product .button:hover,
	{$rule}.shipping-calculator-button:hover,
	{$rule}.widget_layered_nav_filters ul li a:hover, 
	{$rule}.shipping-calculator-form > p button:hover, 
	{$rule}.widget_layered_nav_filters ul li.chosen a, 
	{$rule}.widget_product_categories ul li a:hover, 
	{$rule}.widget_product_categories ul li.current-cat a, 
	{$rule}.widget > .product_list_widget a:hover, 
	{$rule}.cmsmasters_woo_tabs .cmsmasters_tabs_list_item a, 
	{$rule}.cmsmasters_single_product .product_meta span a:hover, 
	{$rule}.cmsmasters_single_product .product_meta, 
	{$rule}.widget_rating_filter a:hover,
	{$rule}.cmsmasters_product .cmsmasters_product_cat a:hover, 
	{$rule}.woocommerce-MyAccount-content .woocommerce-Addresses .woocommerce-Address-title a:hover, 
	{$rule}.widget > .product_list_widget ins .amount, 
	{$rule}.widget > .product_list_widget del, 
	{$rule}.widget > .product_list_widget del .amount, 
	{$rule}.woocommerce-MyAccount-content .shop_table td.woocommerce-orders-table__cell-order-number a:hover, 
	{$rule}.widget_shopping_cart .cart_list a:hover, 
	{$rule}.woocommerce-store-notice .woocommerce-store-notice__dismiss-link {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.woocommerce-store-notice, 
	{$rule}.select2-container--default .select2-results__option--highlighted[aria-selected],
	{$rule}.select2-container--default .select2-results__option--highlighted[data-selected] {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.select2-container.select2-container-active .select2-choice, 
	{$rule}.select2-container.select2-container-active.select2-drop-above .select2-choice, 
	{$rule}.select2-drop.select2-drop-active, 
	{$rule}.select2-drop.select2-drop-above.select2-drop-active,
	{$rule}.select2-container.select2-container--open .select2-selection--single,
	{$rule}.select2-container.select2-container--focus .select2-selection--single, 
	{$rule}.select2-dropdown {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
	}
	
	@media only screen and (max-width: 768px) {
		.shop_table.cart .cart_item .product-price .amount {
			" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_link']) . "
		}
	}
	
	
	/* Finish Primary Color */
	
	
	/* Start Highlight Color */
	{$rule}#page .remove, 
	{$rule}.widget_rating_filter a,
	{$rule}.shipping-calculator-form > p button, 
	{$rule}.shipping-calculator-button,
	{$rule}.cmsmasters_single_product .product_meta span span, 
	{$rule}.cmsmasters_single_product .product_meta span a, 
	{$rule}.shop_table .product-name a, 
	{$rule}.cmsmasters_product .cmsmasters_product_cat a, 
	{$rule}.cmsmasters_woo_tabs .cmsmasters_tabs_list_item a:hover, 
	{$rule}.cmsmasters_woo_tabs .cmsmasters_tabs_list_item.current_tab a, 
	{$rule}.woocommerce-MyAccount-content .woocommerce-Addresses .woocommerce-Address-title a, 
	{$rule}.woocommerce-MyAccount-content .shop_table td.woocommerce-orders-table__cell-order-number a, 
	{$rule}.woocommerce-MyAccount-navigation ul > li.is-active a, 
	{$rule}.cmsmasters_product .button {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_hover']) . "
	}
	
	{$rule}.link_hover_color {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_hover']) . "
	}
	/* Finish Highlight Color */
	
	
	/* Start Headings Color */
	{$rule}.onsale, 
	{$rule}.out-of-stock, 
	{$rule}.stock, 
	{$rule}.woocommerce-info, 
	{$rule}.woocommerce-message, 
	{$rule}.woocommerce-error, 
	{$rule}.woocommerce-error li, 
	{$rule}.cmsmasters_woo_wrap_result .woocommerce-result-count, 
	{$rule}.cmsmasters_product .cmsmasters_product_cat, 
	{$rule}.cmsmasters_product .price, 
	{$rule}.cmsmasters_single_product .price, 
	{$rule}.shop_table .amount, 
	{$rule}.cart_totals .shipping > th, 
	{$rule}.cart_totals .order-total > th, 
	{$rule}ul.order_details strong, 
	{$rule}.widget_layered_nav ul li, 
	{$rule}.widget_layered_nav ul li a, 
	{$rule}.widget_layered_nav_filters ul li, 
	{$rule}.widget_layered_nav_filters ul li a, 
	{$rule}.widget_product_categories ul li, 
	{$rule}.widget_product_categories ul li a, 
	{$rule}.widget > .product_list_widget .reviewer, 
	{$rule}.widget > .product_list_widget a, 
	{$rule}.widget > .product_list_widget ins .amount, 
	{$rule}.woocommerce-notice, 
	{$rule}.woocommerce-MyAccount-content > p, 
	{$rule}.widget_shopping_cart .cart_list a, 
	{$rule}.widget_shopping_cart .cart_list .quantity, 
	{$rule}.widget_shopping_cart .total, 
	{$rule}.cmsmasters_products .product.product-category .woocommerce-loop-category__title, 
	{$rule}.widget_price_filter .price_slider_amount .price_label {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_heading']) . "
	}	
	
	{$rule}ul.order_details li,  
	{$rule}.cart_totals table .cart-subtotal, 
	{$rule}.input-checkbox + label:after, 
	{$rule}.input-radio + label:after, 
	{$rule}.widget_price_filter .ui-slider-range, 
	{$rule}.widget_price_filter .ui-slider-handle, 
	{$rule}input.shipping_method + label:after, 
	{$rule}.select2-container--default .select2-results__option[aria-selected=true], 
	{$rule}.select2-container--default .select2-results__option[data-selected=true] {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_heading']) . "
	}
	
	{$rule}.cart_totals table .cart-subtotal {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_heading']) . "
	} 
	/* Finish Headings Color */
	
	
	/* Start Main Background Color */
	{$rule}ul.order_details, 
	{$rule}.woocommerce-store-notice, 
	{$rule}.woocommerce-store-notice p a, 
	{$rule}.woocommerce-store-notice p a:hover, 
	{$rule}.cart_totals table .cart-subtotal th, 
	{$rule}.cart_totals .cart-subtotal .amount, 
	{$rule}.cart_totals .cart-subtotal .cart-subtotal {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.onsale, 
	{$rule}.out-of-stock, 
	{$rule}.stock, 
	{$rule}section.products h2, 
	{$rule}.cmsmasters_product .button,
	{$rule}.cmsmasters_product .button:hover,
	{$rule}.select2-container .select2-selection--single, 
	{$rule}.woocommerce-store-notice .woocommerce-store-notice__dismiss-link {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_bg']) . "
	}
	/* Finish Main Background Color */
	
	
	/* Start Alternate Background Color */
	{$rule}.select2-container--default .select2-results__option[aria-selected=true], 
	{$rule}.select2-container--default .select2-results__option[data-selected=true], 
	{$rule}.select2-container--default .select2-results__option--highlighted[aria-selected],
	{$rule}.select2-container--default .select2-results__option--highlighted[data-selected] {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_alternate']) . "
	}
	
	{$rule}.select2-container .select2-choice, 
	{$rule}.select2-container.select2-drop-above .select2-choice, 
	{$rule}.select2-container.select2-container-active .select2-choice, 
	{$rule}.select2-container.select2-container-active.select2-drop-above .select2-choice, 
	{$rule}.select2-drop.select2-drop-active, 
	{$rule}.select2-drop.select2-drop-above.select2-drop-active, 
	{$rule}.input-checkbox + label:before, 
	{$rule}.input-radio + label:before, 
	{$rule}input.shipping_method + label:before, 
	{$rule}.cmsmasters_product, 
	{$rule}.woocommerce-checkout-payment, 
	{$rule}ul.order_details strong, 
	{$rule}.widget > .product_list_widget li, 
	{$rule}.widget_shopping_cart .cart_list, 
	{$rule}.select2-dropdown {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_alternate']) . "
	}
	/* Finish Alternate Background Color */
	
	
	/* Start Borders Color */
	{$rule}.cmsmasters_star_rating .cmsmasters_star_trans_wrap, 
	{$rule}.comment-form-rating .stars > span {
		" . cmsmasters_color_css('color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_border']) . "
	}
	
	{$rule}.widget_price_filter .price_slider,
	{$rule}section.products .cmsmasters_product_title_wrapper:before {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_border']) . "
	}
	
	{$rule}.select2-container .select2-choice, 
	{$rule}.select2-container.select2-drop-above .select2-choice, 
	{$rule}ul.order_details li strong, 
	{$rule}.input-checkbox + label:before, 
	{$rule}.input-radio + label:before, 
	{$rule}.woocommerce-checkout-payment, 
	{$rule}.woocommerce-info, 
	{$rule}.woocommerce-message, 
	{$rule}.woocommerce-error, 
	{$rule}input.shipping_method + label:before, 
	{$rule}.woocommerce-customer-details table,
	{$rule}.select2-container .select2-selection--single {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['blogosphere' . '_' . $scheme . '_border']) . "
	}
	/* Finish Borders Color */

/***************** Finish {$title} WooCommerce Color Scheme Rules ******************/

";
	}
	
	
	return $custom_css;
}

add_filter('blogosphere_theme_colors_secondary_filter', 'blogosphere_woocommerce_colors');

