<?php 
/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version		1.0.4
 * 
 * WooCommerce Template Functions
 * Created by CMSMasters
 * 
 */


/* Dynamic Cart */
function blogosphere_woocommerce_cart_dropdown() {
	global $woocommerce;
	
	$cmsmasters_option = blogosphere_get_global_options();
	
	if (
		!isset($cmsmasters_option['blogosphere' . '_woocommerce_cart_dropdown']) ||
		(
			isset($cmsmasters_option['blogosphere' . '_woocommerce_cart_dropdown']) &&
			!$cmsmasters_option['blogosphere' . '_woocommerce_cart_dropdown']
		)
	) {
		echo '<div class="cmsmasters_dynamic_cart_wrap">' . 
		'<div class="cmsmasters_dynamic_cart cmsmasters_dynamic_cart_couple">' .  
			'<a href="' . esc_js("javascript:void(0)") . '" class="cmsmasters_dynamic_cart_button cmsmasters_theme_icon_basket"></a>' . 
			'<span class="count">' . esc_html($woocommerce->cart->get_cart_contents_count()) . '</span>' . 
			'<div class="widget_shopping_cart_content"></div>' . 
		'</div>' . 
	'</div>';
	}
}


/* Woocommerce Header Cart */
function blogosphere_woocommerce_header_cart_link() {
	global $woocommerce;
	
	echo '<div class="cmsmasters_dynamic_cart_link_wrap cmsmasters_dynamic_cart_couple">' . 
		'<a href="' . esc_url(wc_get_cart_url()) . '" class="cmsmasters_theme_icon_basket cmsmasters_header_cart_link"></a>' . 
		'<span class="count">' . esc_html($woocommerce->cart->get_cart_contents_count()) . '</span>' . 
	'</div>';
}


/* Add to Cart Button */
function blogosphere_woocommerce_add_to_cart_button() {
	global $woocommerce, 
		$product;
	
	
	if ( 
		$product->is_purchasable() && 
		$product->is_type( 'simple' ) && 
		$product->is_in_stock() 
	) {
		echo '<a href="' . esc_url($product->add_to_cart_url()) . '" data-product_id="' . esc_attr($product->get_id()) . '" data-product_sku="' . esc_attr($product->get_sku()) . '" class="button add_to_cart_button cmsmasters_add_to_cart_button product_type_simple ajax_add_to_cart" title="' . esc_attr__('Add to Cart', 'blogosphere') . '">' . 
			'<span>' . esc_html__('Add to Cart', 'blogosphere') . '</span>' . 
		'</a>' . 
		'<a href="' . esc_url(wc_get_cart_url()) . '" class="button added_to_cart wc-forward" title="' . esc_attr__('View Cart', 'blogosphere') . '">' . 
			'<span>' . esc_html__('View Cart', 'blogosphere') . '</span>' . 
		'</a>';
	}
}


/* Rating */
function blogosphere_woocommerce_rating($icon_trans = '', $icon_color = '', $in_review = false, $comment_id = '', $show = true) {
	global $product;
	
	
	if (get_option( 'woocommerce_enable_review_rating') === 'no') {
		return;
	}
	
	
	$rating = (($in_review) ? intval(get_comment_meta($comment_id, 'rating', true)) : ($product->get_average_rating() ? $product->get_average_rating() : '0'));
	
	$itemtype = $in_review ? 'Rating' : 'AggregateRating';
	
	
	$out = "
<div class=\"cmsmasters_star_rating\" itemscope itemtype=\"http://schema.org/{$itemtype}\" title=\"" . sprintf(esc_html__('Rated %s out of 5', 'blogosphere'), $rating) . "\">
<div class=\"cmsmasters_star_trans_wrap\">
	<span class=\"{$icon_trans} cmsmasters_star\"></span>
	<span class=\"{$icon_trans} cmsmasters_star\"></span>
	<span class=\"{$icon_trans} cmsmasters_star\"></span>
	<span class=\"{$icon_trans} cmsmasters_star\"></span>
	<span class=\"{$icon_trans} cmsmasters_star\"></span>
</div>
<div class=\"cmsmasters_star_color_wrap\" data-width=\"width:" . (($rating / 5) * 100) . "%\">
	<div class=\"cmsmasters_star_color_inner\">
		<span class=\"{$icon_color} cmsmasters_star\"></span>
		<span class=\"{$icon_color} cmsmasters_star\"></span>
		<span class=\"{$icon_color} cmsmasters_star\"></span>
		<span class=\"{$icon_color} cmsmasters_star\"></span>
		<span class=\"{$icon_color} cmsmasters_star\"></span>
	</div>
</div>
<span class=\"rating dn\"><strong itemprop=\"ratingValue\">" . esc_html($rating) . "</strong> " . esc_html__('out of 5', 'blogosphere') . "</span>
</div>
";
	
	
	if ($show) {
		echo blogosphere_return_content($out);
	} else {
		return $out;
	}
}


/* Price Format */
function blogosphere_woocommerce_price_format($format, $currency_pos) {
	$format = '%2$s<span>%1$s</span>';

	switch ( $currency_pos ) {
		case 'left' :
			$format = '<span>%1$s</span>%2$s';
		break;
		case 'right' :
			$format = '%2$s<span>%1$s</span>';
		break;
		case 'left_space' :
			$format = '<span>%1$s&nbsp;</span>%2$s';
		break;
		case 'right_space' :
			$format = '%2$s<span>&nbsp;%1$s</span>';
		break;
	}
	
	return $format;
}
 
add_action('woocommerce_price_format', 'blogosphere_woocommerce_price_format', 1, 2);


/* Dynamic cart count update after ajax */
function blogosphere_woocommerce_header_add_to_cart_count( $dynamic_count ) {
	global $woocommerce;
	
	ob_start();
	
	?>
	<span class="count"><?php echo esc_html($woocommerce->cart->cart_contents_count); ?></span>
	<?php
	
	$dynamic_count['.cmsmasters_dynamic_cart_couple > span'] = ob_get_clean();
	
	return $dynamic_count;
}

add_filter('add_to_cart_fragments', 'blogosphere_woocommerce_header_add_to_cart_count');

