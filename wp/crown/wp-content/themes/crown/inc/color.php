<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}
if (function_exists('G5CORE')) {
    add_action('template_redirect', 'crown_custom_css', 20);
}

function crown_custom_css()
{
    $custom_css = '';
    $custom_css .= crown_custom_text_color();
    $custom_css .= crown_custom_accent_color();
    $custom_css .= crown_custom_border_color();
    $custom_css .= crown_custom_heading_color();
    $custom_css .= crown_custom_caption_color();
    $custom_css .= crown_custom_placeholder_color();
    $custom_css .= crown_custom_primary_color();
    $custom_css .= crown_custom_secondary_color();
    $custom_css .= crown_custom_dark_color();
    $custom_css .= crown_custom_light_color();
    $custom_css .= crown_custom_gray_color();
    $custom_css .= crown_custom_body_font();
    $custom_css .= crown_custom_primary_font();
    $custom_css .= crown_custom_header_color();
    $custom_css .= crown_custom_comment_spacing();

    G5CORE()->custom_css()->addCss($custom_css);
}

function crown_custom_text_color()
{
	$text_color = G5CORE()->options()->color()->get_option('site_text_color');
	return <<<CSS
    
.gel-tab .vc_tta-tab > a {
  color: {$text_color} !important;
}

.gel-pricing-progress .pricing-feature.disable {
  color: {$text_color} !important;
}
.gel-pricing-progress .pricing-feature.disable .list-bullet {
  color: {$text_color} !important;
}

.gel-heading-description {
  color: {$text_color};
}

.gel-heading.gel-heading-custom-style-01 .gel-heading-subtitle {
  color: {$text_color};
}

.gel-heading.gel-heading-custom-style-02 .gel-heading-subtitle {
  color: {$text_color};
}

.gel-heading.gel-heading-custom-style-03 .gel-heading-subtitle {
  color: {$text_color};
}

.gel-heading.gel-heading-custom-style-04 .gel-heading-subtitle {
  color: {$text_color};
}

.gel-heading.gel-heading-custom-style-05 .gel-heading-subtitle {
  color: {$text_color};
}

.gel-heading.gel-heading-custom-style-06 .gel-heading-subtitle {
  color: {$text_color};
}

.text-color,
body,
.testimonial-job-color-99 .gel-testimonial-job,
.gel-testimonial-name-14 .gel-testimonial-bio,
.gel-our-team .gel-our-team-social,
.menu-horizontal .menu-item > a:hover,
.menu-horizontal .menu-item > a:focus,
.menu-horizontal .menu-current > a,
.menu-horizontal .current-menu-parent > a,
.menu-horizontal .current-menu-ancestor > a,
.menu-horizontal .current-menu-item > a,
.gel-footer-hover-color a,
.wp-block-image figcaption {
  color: {$text_color};
}

.text-border-color,
.gel-footer-border .gel-list-style-03 ul li:not(:last-child) {
  border-color: {$text_color};
}

.text-bg-color,
ul.g5blog__post-meta li:after {
  background-color: {$text_color};
}

.g5portfolio__single-navigation .nav-links > div .nav-subtitle {
  color: {$text_color};
}



.woocommerce .g5shop__product-item .g5shop__product-info .price,
.woocommerce ul.products li.product .price,
.woocommerce div.product .woocommerce-tabs ul.tabs li a {
  color: {$text_color};
}

CSS;


}

function crown_custom_accent_color()
{
	$accent_color            = G5CORE()->options()->color()->get_option( 'accent_color' );
	$accent_foreground_color = g5core_color_contrast( $accent_color );
	$accent_color_darken_075 = g5core_color_darken( $accent_color, '7.5%' );
	$accent_color_darken_10  = g5core_color_darken( $accent_color, '10%' );
	$accent_color_lighten_10 = g5core_color_lighten( $accent_color, '10%' );
	$accent_adjust_brightness_15 = g5core_color_adjust_brightness( $accent_color ,'15%');


    return <<<CSS
::-moz-selection {
  background-color: {$accent_color};
}

::selection {
  background-color: {$accent_color};
}

.btn,
button,
input[type=button],
input[type=reset],
input[type=submit] {
  color: {$accent_foreground_color};
  background-color: {$accent_color};
  border-color: {$accent_color};
}

.btn.btn-outline,
button.btn-outline,
input[type=button].btn-outline,
input[type=reset].btn-outline,
input[type=submit].btn-outline {
  color: {$accent_color};
}

.btn.btn-outline:focus, .btn.btn-outline:hover, .btn.btn-outline:active,
button.btn-outline:focus,
button.btn-outline:hover,
button.btn-outline:active,
input[type=button].btn-outline:focus,
input[type=button].btn-outline:hover,
input[type=button].btn-outline:active,
input[type=reset].btn-outline:focus,
input[type=reset].btn-outline:hover,
input[type=reset].btn-outline:active,
input[type=submit].btn-outline:focus,
input[type=submit].btn-outline:hover,
input[type=submit].btn-outline:active {
  background-color: {$accent_color};
  color: {$accent_foreground_color};
  border-color: {$accent_color};
}

.btn.btn-link,
button.btn-link,
input[type=button].btn-link,
input[type=reset].btn-link,
input[type=submit].btn-link {
  color: {$accent_color};
}
.btn.btn-accent {
  color: {$accent_foreground_color};
  background-color: {$accent_color};
  border-color: {$accent_color};
}
.btn.btn-accent:focus, .btn.btn-accent:hover, .btn.btn-accent:active {
  color: {$accent_foreground_color};
  background-color: {$accent_color_darken_075};
  border-color: {$accent_color_darken_10};
}
.btn.btn-accent.btn-outline {
  color: {$accent_color};
}
.btn.btn-accent.btn-outline:focus, .btn.btn-accent.btn-outline:hover, .btn.btn-accent.btn-outline:active {
  background-color: {$accent_color};
  color: {$accent_foreground_color};
  border-color: {$accent_color};
}
.btn.btn-accent.btn-link {
  color: {$accent_color};
}
.wp-block-button__link:not(.has-background):not(.has-text-color) {
  color: {$accent_foreground_color};
  background-color: {$accent_color};
  border-color: {$accent_color};
}
.wp-block-button__link:not(.has-background):not(.has-text-color):focus, .wp-block-button__link:not(.has-background):not(.has-text-color):hover, .wp-block-button__link:not(.has-background):not(.has-text-color):active {
  color: {$accent_foreground_color};
  background-color: {$accent_color_darken_075};
  border-color: {$accent_color_darken_10};
}
.wp-block-button__link:not(.has-background):not(.has-text-color).btn-outline {
  color: {$accent_color};
}
.wp-block-button__link:not(.has-background):not(.has-text-color).btn-outline:focus, .wp-block-button__link:not(.has-background):not(.has-text-color).btn-outline:hover, .wp-block-button__link:not(.has-background):not(.has-text-color).btn-outline:active {
  background-color: {$accent_color};
  color: {$accent_foreground_color};
  border-color: {$accent_color};
}
.wp-block-button__link:not(.has-background):not(.has-text-color).btn-link {
  color: {$accent_color};
}
.wp-block-button:not(.is-style-outline) .wp-block-button__link:hover {
  color: {$accent_foreground_color};
  background-color: {$accent_color};
  border-color: {$accent_color};
}
.wp-block-button:not(.is-style-outline) .wp-block-button__link:hover:focus, .wp-block-button:not(.is-style-outline) .wp-block-button__link:hover:hover, .wp-block-button:not(.is-style-outline) .wp-block-button__link:hover:active {
  color: {$accent_foreground_color};
  background-color: {$accent_color_darken_075};
  border-color: {$accent_color_darken_10};
}
.wp-block-button:not(.is-style-outline) .wp-block-button__link:hover.btn-outline {
  color: {$accent_color};
}
.wp-block-button:not(.is-style-outline) .wp-block-button__link:hover.btn-outline:focus, .wp-block-button:not(.is-style-outline) .wp-block-button__link:hover.btn-outline:hover, .wp-block-button:not(.is-style-outline) .wp-block-button__link:hover.btn-outline:active {
  background-color: {$accent_color};
  color: {$accent_foreground_color};
  border-color: {$accent_color};
}
.wp-block-button:not(.is-style-outline) .wp-block-button__link:hover.btn-link {
  color: {$accent_color};
}

.wp-block-button.is-style-outline .wp-block-button__link:hover {
  background-color: {$accent_color} !important;
}
.accent-text-color,
.gel-pricing-style-1 .pricing-name,
.gel-pricing-style-2 .pricing-name,
.gel-pricing-style-3 .pricing-name,
.gel-testimonial .author-attr h4 > a:hover,
.gel-heading-title mark,
.gel-heading-subtitle,
.title-view-demo a:hover,
.gel-icon-box .title > a:hover,
.gel-video-classic .view-video:hover,
.gel-our-team .gel-our-team-name > a:hover,
.g5core__single-breadcrumbs .breadcrumb-leaf,
.g5core__single-breadcrumbs > li:hover,
.g5core__social-share li:hover,
.wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color),
.article-post .entry-footer .link-more > a:hover,
.article-post .entry-footer .meta-comment a:hover,
.article-post .entry-title a:hover,
.article-post .entry-meta a:hover,
.comment-list .comment-reply-link:hover,
ul.g5blog__post-meta li:hover,
.g5blog__post-title:hover {
  color: {$accent_color};
}

.accent-bg-color,
.pricing-featured-text,
.gel-pricing-progress.pri-progress-50 .pricing-wrap-top,
.gel-heading-separate,
.gel-wpcf7.style2 .wpcf7-submit,
.gel-wpcf7.style3 .wpcf7-submit,
.g5core-back-to-top:focus,
.g5core-back-to-top:hover,
.g5core__paging.next-prev > a:not(.disable):hover,
.post-navigation .nav-links > div:hover,
.page-links > .page-links-text {
  background-color: {$accent_color};
}

.accent-border-color,
input[type=text]:focus,
input[type=email]:focus,
input[type=url]:focus,
input[type=password]:focus,
input[type=search]:focus,
input[type=number]:focus,
input[type=tel]:focus,
input[type=range]:focus,
input[type=date]:focus,
input[type=month]:focus,
input[type=week]:focus,
input[type=time]:focus,
input[type=datetime]:focus,
input[type=datetime-local]:focus,
input[type=color]:focus,
textarea:focus,
select:focus,
.gel-wpcf7.input-bg-transparent input:not(.btn):focus,
.gel-wpcf7.input-bg-transparent input:not(.btn):active,
.gel-wpcf7.style2 .wpcf7-submit,
.gel-wpcf7.style3 .wpcf7-submit,
.g5core__paging.next-prev > a:not(.disable):hover,
.wp-block-button.is-style-outline .wp-block-button__link:hover,
.post-navigation .nav-links > div:hover,
.page-links > .page-links-text {
  border-color: {$accent_color};
}

.g5portfolio__post-title:hover,
.g5portfolio__post-cat a:hover,
.g5portfolio__single-navigation .nav-links > div .nav-title:hover,
.g5portfolio__single-navigation .nav-links .nav-back:hover {
  color: {$accent_color};
}

.woocommerce a.remove:hover:before,
.g5shop__search-product .result ul li:hover a,
.woocommerce-loop-category__title:hover,
.g5shop__loop-product-title:hover,
.woocommerce ul.products li.product .woocommerce-loop-category__title:hover,
.woocommerce ul.products li.product .woocommerce-loop-product__title:hover,
.g5shop__loop-product-cat:hover,
.g5shop__mini-cart ul.woocommerce-mini-cart li a:not(.remove):hover,
.g5shop__mini-cart ul.woocommerce-mini-cart li a:not(.remove):focus,
.g5shop__mini-cart ul.woocommerce-mini-cart li a:not(.remove):active,
.woocommerce-error a:hover,
.woocommerce-info a:hover,
.woocommerce-message a:hover,
ul.g5shop__price-filter .current > a,
.woocommerce ul.product_list_widget:not(.cart_list) li a:hover,
.woocommerce ul.product_list_widget:not(.cart_list) li a:focus,
.woocommerce ul.product_list_widget:not(.cart_list) li a:active,
.g5shop__product-gallery-video:hover,
.woocommerce div.product div.summary .product_title a:hover,
.woocommerce div.product div.summary .woocommerce-product-rating a:hover,
.woocommerce div.product form.cart table.group_table td.woocommerce-grouped-product-list-item__label a:hover,
.product_meta > span a:hover,
.woocommerce-cart .cart-collaterals .cart_totals .shipping-calculator-button:hover,
.woocommerce table.shop_table .product-name a:hover,
.woocommerce .woocommerce-form-login .lost_password a:hover,
.woocommerce-MyAccount-content > p:not(.woocommerce-info) a:hover {
  color: {$accent_color};
}

.g5shop_header-action-icon a > span,
.woocommerce div.product div.images .woocommerce-product-gallery__trigger:hover:after {
  background-color: {$accent_color};
}

.woocommerce div.product div.images .woocommerce-product-gallery__trigger:hover:before {
  border-color: {$accent_color};
}
CSS;

}



function crown_custom_border_color()
{
    $border_color = G5CORE()->options()->color()->get_option('border_color');
    return <<<CSS
.gel-tab .vc_tta-panels {
  border-top: solid 1px {$border_color} !important;
}
.gel-pricing-progress .pricing-features:after {
  background-color: {$border_color};
}

.gel-pricing-line .pricing-features:before {
  background-color: {$border_color};
}

.mailchimp-form-download .gel-mailchimp .form-email {
  border: 1px solid {$border_color} !important;
}

.mailchimp-form-border-input .gel-mailchimp .form-email {
  border: 1px solid {$border_color} !important;
}

@media only screen and (max-width: 991px) {
  .site-header .site-navigation {
    border-top: solid 1px {$border_color};
  }    
}

.wp-block-separator {
  border-bottom: 2px solid {$border_color};
}

.border-color,
hr,
blockquote,
table th,
table td,
table thead th,
input[type=text],
input[type=email],
input[type=url],
input[type=password],
input[type=search],
input[type=number],
input[type=tel],
input[type=range],
input[type=date],
input[type=month],
input[type=week],
input[type=time],
input[type=datetime],
input[type=datetime-local],
input[type=color],
textarea,
select,
.pricing-button .btn-outline,
.gel-pricing-progress,
.gel-pricing-line,
.gel-image-box-style-custom .gel-image-box .content-box,
.site-header .search-form-wrapper .search-form,
.g5core__paging.next-prev > a,
.g5core__cate-filer,
.wp-block-table th,
.wp-block-table td,
.wp-block-quote:not(.is-large):not(.is-style-large),
ul.wp-block-latest-posts.is-grid li,
.wp-block-tag-cloud a,
.author-info-wrap,
.comments-list-wrap,
.post-navigation .nav-links > div,
.page-links > .page-links-text,
.page-links > a,
.g5blog__post-large-image .g5blog__post-inner,
.g5blog__post-medium-image .g5blog__post-inner,
.g5blog__single-meta-bottom,
.g5blog__single,
.tagcloud a,
.widget_calendar caption {
  border-color: {$border_color};
}

.crown__portfolio-skin-boxed .g5portfolio__post-content,
.g5portfolio__single-navigation .nav-links {
  border-color: {$border_color};
}

@media (max-width: 767px) {
  .g5shop__tab-panel {
    border: 1px solid {$border_color};
  }
}

.g5shop__single-product-tabs.layout-3 .g5shop__tabs-container .nav-tabs .nav-link {
  border-color: {$border_color} {$border_color} {$border_color};
}
.g5shop__single-product-tabs.layout-3 .g5shop__tabs-container .nav-tabs .nav-link.active {
  border-color: {$border_color} #fff {$border_color} {$border_color};
}

.select2-container--default.select2-container--default .select2-selection--single,
.select2-dropdown.select2-dropdown,
.select2-container--default.select2-container--default .select2-search--dropdown .select2-search__field,
.g5shop__product-list-actions .g5shop__quick-view,
.g5shop__product-list-actions .yith-wcwl-add-to-wishlist a,
.g5shop__product-list-actions .compare,
.woocommerce .quantity .qty,
.g5shop__quantity .g5shop__quantity-inner .qty,
.g5shop__quantity .g5shop__quantity-inner .btn-number,
.g5shop__shop-toolbar.stretched .g5shop__shop-toolbar-inner,
.g5shop__shop-toolbar.stretched_content .g5shop__shop-toolbar-inner,
.g5shop__layout-list .g5shop__product-item-inner,
.g5shop__layout-list .g5shop__product-cat-item-inner,
.woocommerce div.product div.summary .product_meta,
.g5shop__panel-heading h4,
.g5shop__tabs-container .nav-tabs,
.g5shop__single-product-tabs.layout-3 .g5shop__panels-container,
.g5shop__single-product-tabs.layout-4 .g5shop__tab-panel,
.woocommerce #reviews #comments ol.commentlist li .comment-text,
.woocommerce-cart .cart-collaterals .cart_totals table tr td,
.woocommerce-cart .cart-collaterals .cart_totals table tr th,
.woocommerce table.shop_table,
.woocommerce table.shop_table td,
.woocommerce table.cart td.actions .coupon .input-text,
.woocommerce form.checkout_coupon,
.woocommerce form.login,
.woocommerce form.register,
.woocommerce-MyAccount-navigation ul,
.woocommerce-MyAccount-navigation ul li,
.woocommerce-MyAccount-content address,
.woocommerce-MyAccount-content fieldset {
  border-color: {$border_color};
}
    


CSS;

}

function crown_custom_heading_color()
{
    $heading_color = G5CORE()->options()->color()->get_option('heading_color');
    return <<<CSS
.heading-color,
h1,
h2,
h3,
h4,
h5,
h6,
.h1,
.h2,
.h3,
.h4,
.h5,
.h6,
blockquote p,
.gel-countdown .gel-countdown-value,
.gel-heading,
.gel-our-team .gel-our-team-social:hover,
.site-branding-text .site-title a,
.gel-footer-hover-color.dark a:hover,
.page-main-title,
.slick-dots li.slick-active,
.slick-dots li:hover,
.slick-arrow:active,
.slick-dots li:active,
.slick-arrow:focus,
.slick-dots li:focus,
.g5core__cate-filer li:hover,
.g5core__cate-filer li:active,
.g5core__cate-filer li.active,
.g5core__single-breadcrumbs .page-main-title,
.wp-block-archives li > a:hover,
.wp-block-categories li > a:hover,
.wp-block-archives .current-cat > a,
.wp-block-categories .current-cat > a,
.wp-block-latest-posts a:hover,
.wp-block-latest-comments a:hover,
.wp-block-tag-cloud a,
.wp-block-tag-cloud a:hover,
p.has-drop-cap:not(:focus)::first-letter,
.article-post .entry-footer .link-more > a,
.article-post .post-tags a:hover,
.article-post .post-tags label,
.comment-form .logged-in-as a:hover,
.comment-list .comment-reply-link,
.comment-list .comment-author .fn,
.comment-list .comment-author .fn > a,
.post-navigation .nav-links .nav-subtitle,
.page-numbers:not(ul),
.widget_product_search button:before,
.widget_search button:before,
.widget_rss ul a:hover,
.widget_recent_entries ul a:hover,
.widget_recent_comments ul a:hover,
.widget_meta ul a:hover,
ul.g5shop__price-filter li > a:hover,
ul.g5shop__product-sorting li > a:hover,
.woocommerce .woocommerce-widget-layered-nav .woocommerce-widget-layered-nav-list li > a:hover,
.widget_archive ul li > a:hover,
.widget_categories ul li > a:hover,
.widget_nav_menu ul li > a:hover,
.widget_pages ul li > a:hover,
.widget_product_categories ul li > a:hover,
ul.g5shop__price-filter .current-cat > a,
ul.g5shop__product-sorting .current-cat > a,
.woocommerce .woocommerce-widget-layered-nav .woocommerce-widget-layered-nav-list .current-cat > a,
.widget_archive ul .current-cat > a,
.widget_categories ul .current-cat > a,
.widget_nav_menu ul .current-cat > a,
.widget_pages ul .current-cat > a,
.widget_product_categories ul .current-cat > a,
.tagcloud a,
.tagcloud a:hover {
  color: {$heading_color};
}

.heading-bg-color,
.page-numbers:not(ul).current,
.page-numbers:not(ul):hover {
  background-color: {$heading_color};
}

.heading-border-color {
  border-color: {$heading_color};
}

.woocommerce div.product .woocommerce-tabs ul.tabs li:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li.active {
  border-bottom: 1px solid {$heading_color};
}

.g5shop__search-product .result ul li a,
.woocommerce .woocommerce-pagination ul.page-numbers li a,
.woocommerce .woocommerce-pagination ul.page-numbers li span,
.g5shop__product-list-actions .g5shop__quick-view:hover,
.g5shop__product-list-actions .g5shop__quick-view:active,
.g5shop__product-list-actions .g5shop__quick-view:focus,
.g5shop__product-list-actions .yith-wcwl-add-to-wishlist a:hover,
.g5shop__product-list-actions .yith-wcwl-add-to-wishlist a:active,
.g5shop__product-list-actions .yith-wcwl-add-to-wishlist a:focus,
.g5shop__product-list-actions .compare:hover,
.g5shop__product-list-actions .compare:active,
.g5shop__product-list-actions .compare:focus,
.g5shop__quantity label,
.g5shop__quantity .g5shop__quantity-inner .qty,
.g5shop__quantity .g5shop__quantity-inner .btn-number,
.g5shop__deal-heading,
.g5shop__swatch-text .g5shop__swatches-item.g5shop__sw-selected,
.g5shop__swatch-text .g5shop__swatches-item:hover,
.g5shop__reset_variations:hover,
.woocommerce table.wishlist_table .product-stock-status span.wishlist-in-stock,
.wishlist_table.mobile li .item-details table.item-details-table td.value,
.wishlist_table.mobile li table.additional-info td.value,
.woocommerce .widget_layered_nav_filters ul li a:hover,
.woocommerce .widget_price_filter .price_slider_amount .button,
.woocommerce ul.product_list_widget:not(.cart_list) li a,
ul.g5shop__product-sorting .current > a,
.g5shop__switch-layout a.active,
.g5shop__switch-layout a:hover,
.g5shop__switch-layout a:focus,
.g5shop__switch-layout a:active,
.g5shop__filter-button.active,
.g5shop__filter-button:hover,
.g5shop__filter-button:focus,
.g5shop__filter-button:active,
.woocommerce div.product form.cart table.variations td.label label,
.woocommerce div.product form.cart table.variations .reset_variations:hover,
.woocommerce div.product form.cart table.group_table td.woocommerce-grouped-product-list-item__label a,
.woocommerce div.product .woocommerce-tabs ul.tabs li:hover a,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
.g5shop__tabs-container .nav-tabs .nav-link:hover,
.g5shop__tabs-container .nav-tabs .nav-link.active,
.product_meta > span label,
.woocommerce table.shop_table th,
.woocommerce table.shop_table .product-name a,
.woocommerce table.shop_table .product-total,
.woocommerce table.shop_table .product-subtotal,
.woocommerce table.shop_table .product-price,
.woocommerce table.shop_table tr.order-total td,
.woocommerce table.shop_table tr.cart-subtotal td,
.woocommerce table.shop_table tr.tax-rate td,
.woocommerce table.shop_table_responsive tr td:before,
.woocommerce table.order_details tfoot,
.woocommerce-MyAccount-navigation ul li > a,
.woocommerce-MyAccount-content fieldset legend {
  color: {$heading_color};
}

.woocommerce .woocommerce-pagination ul.page-numbers li span.current,
.woocommerce .woocommerce-pagination ul.page-numbers li a:hover,
.woocommerce .woocommerce-widget-layered-nav ul.woocommerce-widget-layered-nav-list li.woocommerce-widget-layered-nav-list__item--chosen .g5shop__layered-nav-item:not(.layered-nav-item-color) > span,
.woocommerce .woocommerce-widget-layered-nav ul.woocommerce-widget-layered-nav-list .g5shop__layered-nav-item:not(.layered-nav-item-color):hover > span,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
.g5shop__tabs-container .nav-tabs .nav-link:before {
  background-color: {$heading_color};
}

.g5shop__product-list-actions .g5shop__quick-view:hover,
.g5shop__product-list-actions .g5shop__quick-view:active,
.g5shop__product-list-actions .g5shop__quick-view:focus,
.g5shop__product-list-actions .yith-wcwl-add-to-wishlist a:hover,
.g5shop__product-list-actions .yith-wcwl-add-to-wishlist a:active,
.g5shop__product-list-actions .yith-wcwl-add-to-wishlist a:focus,
.g5shop__product-list-actions .compare:hover,
.g5shop__product-list-actions .compare:active,
.g5shop__product-list-actions .compare:focus {
  border-color: {$heading_color};
}

.g5portfolio__post-title,
.g5portfolio__single-navigation .nav-links > div .nav-title,
.g5portfolio__single-meta label,
.g5portfolio__single-meta a:hover {
  color: {$heading_color};
}


CSS;

}

function crown_custom_caption_color()
{
    $caption_color = G5CORE()->options()->color()->get_option('caption_color');
    return <<<CSS

.caption-color,
.g5core__paging.next-prev > a,
.g5core__single-breadcrumbs,
.blocks-gallery-caption {
  color: {$caption_color};
}

.g5portfolio__single-navigation .nav-links .nav-back {
  color: {$caption_color};
}

.g5shop__loop-product-cat,
.g5shop__swatch-text .g5shop__swatches-item,
.g5shop__reset_variations {
  color: {$caption_color};
}

CSS;

}

function crown_custom_placeholder_color()
{
    $placeholder_color = G5CORE()->options()->color()->get_option('placeholder_color');
    return <<<CSS
textarea:-moz-placeholder,
select:-moz-placeholder,
input[type]:-moz-placeholder {
  color: {$placeholder_color};
}
textarea::-moz-placeholder,
select::-moz-placeholder,
input[type]::-moz-placeholder {
  color: {$placeholder_color};
}
textarea:-ms-input-placeholder,
select:-ms-input-placeholder,
input[type]:-ms-input-placeholder {
  color: {$placeholder_color};
}
textarea::-webkit-input-placeholder,
select::-webkit-input-placeholder,
input[type]::-webkit-input-placeholder {
  color: {$placeholder_color};
}
.g5core-search-form input[type=search]:-moz-placeholder {
  color: {$placeholder_color};
}
.g5core-search-form input[type=search]::-moz-placeholder {
  color: {$placeholder_color};
}
.g5core-search-form input[type=search]:-ms-input-placeholder {
  color: {$placeholder_color};
}
.g5core-search-form input[type=search]::-webkit-input-placeholder {
  color: {$placeholder_color};
}
.g5core-search-form button {
  color: {$placeholder_color};
}
CSS;

}

function crown_custom_primary_color()
{
    $primary_color = G5CORE()->options()->color()->get_option('primary_color');
    $primary_color_foreground = g5core_color_contrast($primary_color);
    $primary_color_darken_075 = g5core_color_darken($primary_color, '7.5%');
    $primary_color_darken_10 = g5core_color_darken($primary_color, '10%');
    return <<<CSS
.btn.btn-primary {
  color: {$primary_color_foreground};
  background-color: {$primary_color};
  border-color: {$primary_color};
}
.btn.btn-primary:focus, .btn.btn-primary:hover, .btn.btn-primary:active {
  color: {$primary_color_foreground};
  background-color: {$primary_color_darken_075};
  border-color: {$primary_color_darken_10};
}
.btn.btn-primary.btn-outline {
  color: {$primary_color};
}
.btn.btn-primary.btn-outline:focus, .btn.btn-primary.btn-outline:hover, .btn.btn-primary.btn-outline:active {
  background-color: {$primary_color};
  color: {$primary_color_foreground};
  border-color: {$primary_color};
}
.btn.btn-primary.btn-link {
  color: {$primary_color};
}
.primary-color {
  color: {$primary_color};
}

.woocommerce .g5shop__product-item .g5shop__product-info .price ins,
.woocommerce ul.products li.product .price ins,
.woocommerce ul.product_list_widget:not(.cart_list) li ins,
.woocommerce div.product div.summary p.price ins,
.woocommerce div.product div.summary span.price ins {
  color: {$primary_color};
}


CSS;

}

function crown_custom_secondary_color()
{
    $secondary_color = G5CORE()->options()->color()->get_option('secondary_color');
    $secondary_color_foreground = g5core_color_contrast($secondary_color);
    $secondary_color_darken_075 = g5core_color_darken($secondary_color, '7.5%');
    $secondary_color_darken_10 = g5core_color_darken($secondary_color, '10%');
    return <<<CSS
.btn.btn-secondary {
  color: {$secondary_color_foreground};
  background-color: {$secondary_color};
  border-color: {$secondary_color};
}
.btn.btn-secondary:focus, .btn.btn-secondary:hover, .btn.btn-secondary:active {
  color: {$secondary_color_foreground};
  background-color: {$secondary_color_darken_075};
  border-color: {$secondary_color_darken_10};
}
.btn.btn-secondary.btn-outline {
  color: {$secondary_color};
}
.btn.btn-secondary.btn-outline:focus, .btn.btn-secondary.btn-outline:hover, .btn.btn-secondary.btn-outline:active {
  background-color: {$secondary_color};
  color: {$secondary_color_foreground};
  border-color: {$secondary_color};
}
.btn.btn-secondary.btn-link {
  color: {$secondary_color};
}

.gel-pricing-progress .pricing-features:before {
  background-color: {$secondary_color};
  z-index: 2;
}
.gel-wpcf7.style1 .wpcf7-submit {
  background-color: {$secondary_color};
  border-color: {$secondary_color};
}
.secondary-color {
  color: {$secondary_color};
}


CSS;


}

function crown_custom_dark_color()
{
    $dark_color = G5CORE()->options()->color()->get_option('dark_color');
    $dark_color_foreground = g5core_color_contrast($dark_color);
    $dark_color_darken_075 = g5core_color_darken($dark_color, '7.5%');
    $dark_color_darken_10 = g5core_color_darken($dark_color, '10%');
    return <<<CSS
.btn.btn-dark {
  color: #fff;
  background-color: {$dark_color};
  border-color: {$dark_color};
}
.btn.btn-dark:focus, .btn.btn-dark:hover, .btn.btn-dark:active {
  color: {$dark_color_foreground};
  background-color: {$dark_color_darken_075};
  border-color: {$dark_color_darken_10};
}
.btn.btn-dark.btn-outline {
  color: {$dark_color};
}
.btn.btn-dark.btn-outline:focus, .btn.btn-dark.btn-outline:hover, .btn.btn-dark.btn-outline:active {
  background-color: {$dark_color};
  color: {$dark_color_foreground};
  border-color: {$dark_color};
}
.btn.btn-dark.btn-link {
  color: {$dark_color};
}
.gel-tab .vc_tta-tab.vc_active > a {
  color: {$dark_color} !important;
}
.pricing-button .btn-outline {
  color: {$dark_color} !important;
}
.title-view-demo {
  color: {$dark_color};
}

.dark-color,
.gel-pricing-progress .pricing-feature,
.gel-pricing-style-1 .pricing-price-number,
.gel-pricing-style-1 .pricing-price-currency,
.gel-pricing-style-2 .pricing-price-number,
.gel-pricing-style-2 .pricing-price-currency,
.gel-pricing-style-3 .pricing-price-number,
.gel-pricing-style-3 .pricing-price-currency,
.gel-pricing-style-3 .pricing-name,
.gel-pricing-style-5 .pricing-price-number,
.gel-pricing-style-5 .pricing-price-currency,
.gel-testimonial-bio-18 .gel-testimonial-job,
.site-header {
  color: {$dark_color};
}


CSS;

}

function crown_custom_light_color()
{
    $light_color = G5CORE()->options()->color()->get_option('light_color');
    $light_color_foreground = g5core_color_contrast($light_color);
    $light_color_darken_075 = g5core_color_darken($light_color, '7.5%');
    $light_color_darken_10 = g5core_color_darken($light_color, '10%');
    return <<<CSS
.btn.btn-light {
  color: {$light_color_foreground};
  background-color: {$light_color};
  border-color: {$light_color};
}
.btn.btn-light:focus, .btn.btn-light:hover, .btn.btn-light:active {
  color: {$light_color_foreground};
  background-color: {$light_color_darken_075};
  border-color: {$light_color_darken_10};
}
.btn.btn-light.btn-outline {
  color: {$light_color};
}
.btn.btn-light.btn-outline:focus, .btn.btn-light.btn-outline:hover, .btn.btn-light.btn-outline:active {
  background-color: {$light_color};
  color: {$light_color_foreground};
  border-color: {$light_color};
}
.btn.btn-light.btn-link {
  color: {$light_color};
}
.pricing-button .btn-outline:hover {
  color: {$light_color} !important;
}

CSS;

}

function crown_custom_gray_color()
{
    $gray_color = G5CORE()->options()->color()->get_option('gray_color');
    $gray_color_foreground = g5core_color_contrast($gray_color);
    $gray_color_darken_075 = g5core_color_darken($gray_color, '7.5%');
    $gray_color_darken_10 = g5core_color_darken($gray_color, '10%');
    return <<<CSS
.btn.btn-gray {
  color: {$gray_color_foreground};
  background-color: {$gray_color};
  border-color: {$gray_color};
}
.btn.btn-gray:focus, .btn.btn-gray:hover, .btn.btn-gray:active {
  color: {$gray_color_foreground};
  background-color: {$gray_color_darken_075};
  border-color: {$gray_color_darken_10};
}
.btn.btn-gray.btn-outline {
  color: {$gray_color};
}
.btn.btn-gray.btn-outline:focus, .btn.btn-gray.btn-outline:hover, .btn.btn-gray.btn-outline:active {
  background-color: {$gray_color};
  color: {$gray_color_foreground};
  border-color: {$gray_color};
}
.btn.btn-gray.btn-link {
  color: {$gray_color};
}


.gray-color,
blockquote cite,
caption,
.page-sub-title,
.wp-block-quote cite,
.wp-block-quote footer,
.wp-block-quote__citation,
.author-info-content .desc {
  color: {$gray_color};
}

CSS;
}

function crown_custom_body_font()
{
    $font = g5core_process_font(G5CORE()->options()->typography()->get_option('body_font'));
    return <<<CSS
        .font-body,
        body,
        .gel-testimonial-bio-24 .gel-testimonial-name {
          font-family: {$font['font_family']};
        }
CSS;
}

function crown_custom_primary_font()
{
    $font = g5core_process_font(G5CORE()->options()->typography()->get_option('primary_font'));
    return <<<CSS
    
.desc-landing {
  font-family: {$font['font_family']};
}

.font-primary,
h1,
h2,
h3,
h4,
h5,
h6,
.h1,
.h2,
.h3,
.h4,
.h5,
.h6,
blockquote p,
blockquote cite,
input[type=text],
input[type=email],
input[type=url],
input[type=password],
input[type=search],
input[type=number],
input[type=tel],
input[type=range],
input[type=date],
input[type=month],
input[type=week],
input[type=time],
input[type=datetime],
input[type=datetime-local],
input[type=color],
textarea,
select,
.btn,
button,
input[type=button],
input[type=reset],
input[type=submit],
.gel-tab .vc_tta-tab > a,
.pricing-price-duration,
.gel-testimonial-bio-24 .gel-testimonial-bio,
.gel-countdown,
.gel-mailchimp .btn-rounded,
.site-branding,
.page-main-title,
.wp-block-quote cite,
.wp-block-quote footer,
.wp-block-quote__citation,
.wp-block-tag-cloud a,
p.has-drop-cap:not(:focus)::first-letter,
.article-post .post-tags label,
.comment-list .comment-author .fn,
.comment-list .comment-author .fn > a,
.tagcloud a {
  font-family: {$font['font_family']};
}

.g5portfolio__listing-wrap .g5core__cate-filer,
.g5portfolio__single-meta label {
  font-family: {$font['font_family']};
}

.woocommerce #respond input#submit,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button,
.woocommerce span.onsale,
.g5shop__product-flash,
.g5shop__quantity label,
.g5shop__mini-cart ul.woocommerce-mini-cart,
.g5shop_header-action-icon a > span,
.woocommerce ul.product_list_widget:not(.cart_list) li a,
.woocommerce div.product form.cart table.variations td.label label,
.woocommerce div.product .woocommerce-tabs ul.tabs li a,
.g5shop__tabs-container .nav-tabs .nav-link,
.product_meta > span label,
.woocommerce table.shop_table,
.woocommerce form .form-row label {
  font-family: {$font['font_family']};
}    
 
CSS;
}

function crown_custom_header_color()
{
    $top_bar_border_color = G5CORE()->options()->header()->get_option('top_bar_border_color', '#ececec');
    $top_bar_text_hover_color = G5CORE()->options()->header()->get_option('top_bar_text_hover_color', '#999');

    $header_background_color = G5CORE()->options()->header()->get_option('header_background_color', '#ffffff');
    $header_text_color = G5CORE()->options()->header()->get_option('header_text_color', '#1b1b1b');
    $header_text_color_contract = g5core_color_contrast($header_text_color);
    $header_text_hover_color = G5CORE()->options()->header()->get_option('header_text_hover_color', '#999');
    $header_border_color = G5CORE()->options()->header()->get_option('header_border_color', '#ececec');


    $navigation_background_color = G5CORE()->options()->header()->get_option('navigation_background_color', '#ffffff');
    $navigation_text_color = G5CORE()->options()->header()->get_option('navigation_text_color', '#1b1b1b');
    $navigation_text_color_contract = g5core_color_contrast($navigation_text_color);
    $navigation_text_hover_color = G5CORE()->options()->header()->get_option('navigation_text_hover_color', '#999');
    $navigation_border_color = G5CORE()->options()->header()->get_option('navigation_border_color', '#ececec');


    $header_sticky_background_color = G5CORE()->options()->header()->get_option('header_sticky_background_color', '#fff');
    $header_sticky_text_color = G5CORE()->options()->header()->get_option('header_sticky_text_color', '#1b1b1b');
    $header_sticky_text_color_contract = g5core_color_contrast($header_sticky_text_color);
    $header_sticky_text_hover_color = G5CORE()->options()->header()->get_option('header_sticky_text_hover_color', '#999');
    $header_sticky_border_color = G5CORE()->options()->header()->get_option('header_sticky_border_color', '#eee');

    return <<<CSS_CUSTOM
div.g5shop_header-action-icon a > span {
	background-color: {$header_text_color};
	color: {$header_text_color_contract};
}
.sticky-area-wrap.sticky div.g5shop_header-action-icon a > span {
	background-color: {$header_sticky_text_color};
	color: {$header_sticky_text_color_contract};
}
.g5core-header-navigation div.g5shop_header-action-icon a > span {
	background-color: {$navigation_text_color};
	color: {$navigation_text_color_contract};
} 

.g5core-header-inner .select2-container--default.select2-container--default .select2-selection--single .select2-selection__rendered {
	color: {$header_text_color};
}
.g5core-header-inner .select2-container--default.select2-container--default .select2-selection--single .select2-selection__arrow b {
	border-color: {$header_text_color} transparent transparent transparent;
}
.g5core-header-inner .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
	border-color: transparent transparent {$header_text_color} transparent;
}

.g5core-header-navigation .select2-container--default.select2-container--default .select2-selection--single .select2-selection__rendered {
	color: {$navigation_text_color};
}
.g5core-header-navigation .select2-container--default.select2-container--default .select2-selection--single .select2-selection__arrow b {
	border-color: {$navigation_text_color} transparent transparent transparent;
}
.g5core-header-navigation .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
	border-color: transparent transparent {$navigation_text_color} transparent;
}


.g5core-header-inner ul.g5core-social-networks a:hover {
	color: {$header_text_hover_color};
}
.g5core-top-bar ul.g5core-social-networks a:hover {
	color: {$top_bar_text_hover_color};
}
.g5core-header-navigation ul.g5core-social-networks a:hover {
	color: {$navigation_text_hover_color};
}

.sticky-area-wrap.sticky .g5core-header-inner ul.g5core-social-networks a:hover {
	color: {$header_sticky_text_hover_color};
}


.g5core-header-customize-separate .g5core-header-customize-after_menu:not(.no-items):before,
.g5core-header-customize-separate .g5core-header-customize-before_menu:not(.no-items):after {
	border-color: {$header_border_color};
}

.g5core-header-customize-separate .g5core-header-navigation .g5core-header-customize-after_menu:not(.no-items):before,
.g5core-header-customize-separate .g5core-header-navigation .g5core-header-customize-before_menu:not(.no-items):after {
	border-color: {$navigation_border_color};
}

.g5core-header-customize-separate .sticky-area-wrap.sticky .g5core-header-customize-after_menu:not(.no-items):before,
.g5core-header-customize-separate .sticky-area-wrap.sticky .g5core-header-customize-before_menu:not(.no-items):after {
	border-color: {$header_sticky_border_color};
}

CSS_CUSTOM;
}

function crown_custom_comment_spacing()
{
    if (is_singular() && !crown_has_sidebar()) {
        $content_padding = G5CORE()->options()->layout()->get_option('content_padding');
        $content_padding_bottom = (is_array($content_padding) && isset($content_padding['bottom'])) ? $content_padding['bottom'] : '0';
        return <<<CSS
    @media (min-width: 992px) {
        body.no-sidebar .comments-area {
            margin-bottom: -{$content_padding_bottom}px;
        }
    }
CSS;
    }
    return '';
}