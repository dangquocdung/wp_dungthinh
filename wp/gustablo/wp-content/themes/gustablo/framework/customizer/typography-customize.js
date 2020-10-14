/**
 * Update Typography Customizer settings live.
*/

( function( $ ) {

'use strict'

// Declare vars
var api = wp.customize;

var objFont = {
	body: "body",
	headings: "h1,h2,h3,h4,h5,h6, .font-heading, blockquote cite, .hentry .post-navigation .meta-nav, .hentry .post-author .name, .hentry .related-title, .hentry .post-related .post-item h4, .comments-area .comments-title, .comments-area .comment-reply-title, .comment-author, .comment-reply a",
	top_bar_content: "#top-bar .top-bar-content .content, #top-bar .top-bar-socials .texts",
	top_menu: ".top-bar-menu li a",
	header_aside_title: "#site-header .wprt-info .info-c > .title",
	main_menu: "#main-nav > ul > li > a",
	main_menu_dropdown: "#main-nav .sub-menu li a",
	mobile_menu: "#main-nav-mobi ul > li > a",
	featured_title: "#featured-title .featured-title-heading",
	blog_post_title: ".hentry .post-title",
	blog_single_post_title: ".post-content-single-wrap .hentry .post-title",
	blog_post_meta: ".hentry .post-meta",
	theme_button: ".wprt-button, .hentry .post-link a, .comment-respond #comment-reply, .wpcf7-form .wpcf7-submit, .wprt-subscribe .form-wrap .submit-wrap button, .footer-promotion .promo-btn",
	theme_pagination: ".wprt-pagination, .woocommerce-pagination",
	breadcrumbs: "#featured-title #breadcrumbs",
	sidebar_widget_title: "#sidebar .widget .widget-title",
	footer_widget_title: "#footer-widgets .widget .widget-title",
	widget_news_title: "#sidebar .widget.widget_recent_posts h3, #footer-widgets .widget.widget_recent_posts h3",
	widget_tweet_text: "#sidebar .widget.widget_twitter .tweet-item",
	widget_tag_text: ".hentry .post-tags a, #sidebar .widget.widget_tag_cloud .tagcloud a, #footer-widgets .widget.widget_tag_cloud .tagcloud a, .widget_product_tag_cloud .tagcloud a",
	entry_h1: "h1",
	entry_h2: "h2",
	entry_h3: "h3",
	entry_h4: "h4",
	copyright: "#copyright",
	bottom_menu: "#bottom ul.bottom-nav > li > a",
	woocommerce_product_title: ".products li h2",
	woocommerce_price: ".products li .price",
	woocommerce_single_product_title: ".woo-single-post-class .summary h1",
	woocommerce_single_price: ".woo-single-post-class .summary .price",
	woocommerce_single_tab_title: ".woo-single-post-class .woocommerce-tabs ul li > a",
	woocommerce_button: ".woocommerce-page .button"
};

$.each( objFont, function( k, v ) {
	api( k + "_typography[font-family]", function(e) {
	    e.bind(function(e) {
	        if (e) {
	            var t = (e.trim().toLowerCase().replace(" ", "-"), "customizer-typography-" + k + "-font-family"),
	                i = e.replace(" ", "%20");
	            i = i.replace(",", "%2C"), i = wprt.googleFontsUrl + "/css?family=" + e + ":300italic,400italic,600italic,700italic,800italic,400,300,600,700,800", $("#" + t).length ? $("#" + t).attr("href", i) : $("head").append('<link id="' + t + '" rel="stylesheet" type="text/css" href="' + i + '">')
	        }
	        var a = $(".customizer-typography-" + k + "-font-family");
	        if (e) {
	            var o = '<style class="customizer-typography-' + k + '-font-family">' + v + '{font-family: ' + e + ";</style>";
	            a.length ? a.replaceWith(o) : $("head").append(o)
	        } else a.remove()
	    })
	});
});

$.each( objFont, function( k, v ) {
	api( k + "_typography[font-weight]", function(e) {
	    e.bind(function(e) {
	        var t = $(".customizer-typography-" + k + "-font-weight");
	        if (e) {
	            var i = '<style class="customizer-typography-' + k + '-font-weight">' + v + '{font-weight: ' + e + ";</style>";
	            t.length ? t.replaceWith(i) : $("head").append(i)
	        } else t.remove()
	    })
	});
});

$.each( objFont, function( k, v ) {
	api( k + "_typography[font-style]", function(e) {
	    e.bind(function(e) {
	        var t = $(".customizer-typography-" + k + "-font-style");
	        if (e) {
	            var i = '<style class="customizer-typography-' + k + '-font-style">' + v + '{font-style: ' + e + ";</style>";
	            t.length ? t.replaceWith(i) : $("head").append(i)
	        } else t.remove()
	    })
	});
});

$.each( objFont, function( k, v ) {
	api( k + "_typography[font-size]", function(e) {
	    e.bind(function(e) {
	        var t = $(".customizer-typography-" + k + "-font-size");
	        if (e) {
	            var i = '<style class="customizer-typography-' + k + '-font-size">' + v + '{font-size: ' + e + ";</style>";
	            t.length ? t.replaceWith(i) : $("head").append(i)
	        } else t.remove()
	    })
	});
});

$.each( objFont, function( k, v ) {
	api( k + "_typography[color]", function(e) {
	    e.bind(function(e) {
	        var t = $(".customizer-typography-" + k + "-color");
	        if (e) {
	            var i = '<style class="customizer-typography-' + k + '-color">' + v + '{color: ' + e + ";</style>";
	            t.length ? t.replaceWith(i) : $("head").append(i)
	        } else t.remove()
	    })
	});
});

$.each( objFont, function( k, v ) {
	api( k + "_typography[line-height]", function(e) {
	    e.bind(function(e) {
	        var t = $(".customizer-typography-" + k + "-line-height");
	        if (e) {
	            var i = '<style class="customizer-typography-' + k + '-line-height">' + v + '{line-height: ' + e + ";</style>";
	            t.length ? t.replaceWith(i) : $("head").append(i)
	        } else t.remove()
	    })
	});
});

$.each( objFont, function( k, v ) {
	api( k + "_typography[letter-spacing]", function(e) {
	    e.bind(function(e) {
	        var t = $(".customizer-typography-" + k + "-letter-spacing");
	        if (e) {
	            var i = '<style class="customizer-typography-' + k + '-letter-spacing">' + v + '{letter-spacing: ' + e + ";</style>";
	            t.length ? t.replaceWith(i) : $("head").append(i)
	        } else t.remove()
	    })
	});
});

$.each( objFont, function( k, v ) {
	api( k + "_typography[text-transform]", function(e) {
	    e.bind(function(e) {
	        var t = $(".customizer-typography-" + k + "-text-transform");
	        if (e) {
	            var i = '<style class="customizer-typography-' + k + '-text-transform">' + v + '{text-transform: ' + e + ";</style>";
	            t.length ? t.replaceWith(i) : $("head").append(i)
	        } else t.remove()
	    })
	});
});

} )( jQuery );