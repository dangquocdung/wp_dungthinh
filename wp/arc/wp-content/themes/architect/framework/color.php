<?php
$root =dirname(dirname(dirname(dirname(dirname(__FILE__)))));
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
} elseif ( file_exists( $root.'/wp-config.php' ) ) {
    require_once( $root.'/wp-config.php' );
}
header("Content-type: text/css; charset=utf-8");
global $architect_option; 
?>

/* 01 MAIN STYLES
****************************************************************************************************/
::selection {
  color: #fff;
  background: <?php echo esc_attr( $architect_option['main-color'] ); ?>;
}
::-moz-selection {
  color: #fff;
  background: <?php echo esc_attr( $architect_option['main-color'] ); ?>;
}
/* default color: #00abc9 */
.icon-promotion,

.owl-partner-warp .prev-partners,
.owl-partner-warp .next-partners,
.owl-partner-warp .next-partners2,
.owl-partner-warp .prev-partners2,
.prev-team,
.next-team,
.sub-header a,
.process-item,
.slide-services .prev-detail-services,
.slide-services .next-detail-services,
ul.countdown li span,
.header-mobile-menu .mm-toggle,
.copyright a,
.navi-level-1.dot-seperator > li > a:after,
.navi-level-1.line-separator > li > a:after,
.navi-level-1.circle-separator > li > a:after,
.navi-level-1.square-separator > li > a:after,
.navi-level-1.plus-separator > li > a:after,
.navi-level-1.strip-separator > li > a:after,
.hover-style-4 .navi-level-1 li a:hover,
.header-v6 .right-header a:hover,
.sub-header .sub-header-content .breadcrumb-arc a,
.navi-level-1 > li .navi-level-2 li a:hover,
.btn-border:hover,
.btn-border:focus,
ul.list-link-footer li:hover a,
.arr-pj-container a:hover,
.sidebar-left .sidebar-style-2 li.current-menu-item a,
.sidebar-left .sidebar-style-2 li:hover a,
.portfolio-grid-2-warp .portfolio-grid-2-container .element-item .project-info h4:hover,
.portfolio-grid-2-warp .portfolio-grid-2-container .element-item .project-info a.cateProject:hover,
.portfolio-grid-1-warp .portfolio-grid-1-container .element-item .project-info a.cateProject:hover,
.portfolio-grid-1-warp .portfolio-grid-1-container .element-item .project-info h4:hover,
.portfolio-grid-3-warp .portfolio-grid-3-container .element-item .project-info h4:hover,
.portfolio-grid-3-warp .portfolio-grid-3-container .element-item .project-info a.cateProject:hover,
.latest-blog-post-data a:hover,
.footer-data .tags p a:hover, .footer-data .share p a:hover,
.comment-respond .logged-in-as a:hover,
.comments-area ol.comment-list li.comment .comment-content .reply a:hover,
ul.style-list-circle li a:hover,
.prev-team:hover,
.next-team:hover,
.view-more:hover,
.sidebar-left ul.sidebar-style-2 li:hover a,
.sidebar-right ul.sidebar-style-2 li:hover a,
.main-sidebar ul li:hover a,
.sidebar-right ul.sidebar-style-2 li.active a,
.form-search-home-6 .btn-search-home-6:hover,
.product-info h3:hover,
.sub-header a:hover,
table.shop_table .product-name a:hover,
.item-team .member-info .social-member a:hover,
.main-sidebar ul li:hover::before,
ul.social-dark li a,
.sidebar-left ul.sidebar-style-2 li.active a,
div.acc2.vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title>a,
.cart_list.product_list_widget .product-detail a:hover,
.woocommerce a.remove:hover,
.hover-style-4 .navi-level-1 > li > a:hover,
.line-separator ul.navi-level-1 > li > a:after, .circle-separator ul.navi-level-1 > li > a:after, 
.square-separator ul.navi-level-1 > li > a:after,
.plus-separator ul.navi-level-1 > li > a:after, .strip-separator ul.navi-level-1 > li > a:after 
{color:<?php echo esc_attr( $architect_option['main-color'] ); ?>;}

.woocommerce .cart_list.product_list_widget .product-detail a.remove:hover,
.woocommerce-cart .cart_list.product_list_widget .product-detail a.remove:hover,
.woocommerce .cart_item a.remove:hover
{
color:<?php echo esc_attr( $architect_option['main-color'] ); ?>!important;

}

.sub-header .sub-header-content .breadcrumb-arc a:hover 
{color:<?php echo esc_attr( $architect_option['main-color'] ); ?>;}

.sidebar-left .sidebar-style-2 li.current-menu-item , 
.sidebar-left .sidebar-style-2 li:hover
  {border-right-color:<?php echo esc_attr( $architect_option['main-color'] ); ?>;}

.svg-triangle-icon,
.hexagon {
  stroke:<?php echo esc_attr( $architect_option['main-color'] ); ?>;
}


mark,
.item-promotion-h5,
.latest-blog-post-date,
.owl-item.synced .process-item,
.process-2-container .process-item span.order,
.section-dark-ourStatistics .ourStatis-item-2 .circle-statis,
.accordion-process .panel-default > .panel-heading .panel-title > a,
.accordion-process .panel-default > .panel-heading .panel-title > a.collapsed:hover,
.accordion-style-light .panel-default > .panel-heading .panel-title > a,
.accordion-style-light .panel-default > .panel-heading .panel-title > a.collapsed,.process-2-container .process-2-item span.order,
.mobile-menu .open + a,
.process-item:hover,
.arc-sorting div.fancy-select ul.options li.selected,
.arc-sorting div.fancy-select ul.options li:hover,
ul.social-dark li a:hover,
.accordion-style-light .panel-default > .panel-heading .panel-title > a.collapsed:hover,
.footer-mobile-menu ul.social li a:hover,
.mobile-menu > li:hover > a,
.mobile-menu li li:hover a,
ul.list-link-footer li:hover:before,
ul.social li a:hover,
ul.social li.active a,
#to-the-top:hover,
.btn-border-ghost:hover,
.btn-main-color,
.language div.fancy-select ul.options li.selected,
.language div.fancy-select ul.options li:hover,
.navi-level-1 > li .navi-level-2,
span.mini-cart-counter,
.main-sidebar .tagcloud a:hover,
.newsletter-field .newsletter-button,
nav .navi-level-1 > li > a:before,
nav .navi-level-1 > li:hover > a:before,
.comment-respond .btn-submit:hover,
.tab2.vc_tta-tabs:not([class*=vc_tta-gap]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-top .vc_tta-tab.vc_active>a,
.tab2.vc_tta-tabs:not([class*=vc_tta-gap]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-top .vc_tta-tab.vc_active>a:hover,
div.tab2.vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title>a ,
.tab3.vc_tta-tabs:not([class*=vc_tta-gap]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-top .vc_tta-tab.vc_active>a ,
.tab3.vc_tta-tabs:not([class*=vc_tta-gap]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-top .vc_tta-tab.vc_active>a:hover,
div.tab3.vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title>a,
div.tab4.vc_tta-tabs:not([class*=vc_tta-gap]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-top .vc_tta-tab.vc_active>a::after,
div.tab4.vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title>a:after,
div.acc1.vc_tta.vc_tta-accordion .vc_tta-controls-icon-position-left.vc_tta-panel-title>a:hover,
div.acc1.vc_tta-color-black.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title>a,
div.acc2.vc_tta-color-white.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title>a,
div.acc2.vc_tta-color-white.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title>a:hover,
ul.list-link-footer-2 li:hover:before,
.product-single.type-product button.button.alt.single_add_to_cart_button,
.woocommerce a.button.btn-main-color,
.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,
.woocommerce a.button.alt,
.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,
.project-terms a:hover h4:before,
.project-terms-2 a.current h4:before,
.project-terms-2 a:hover h4:before,
.project-terms a h4:before,
.project-terms a.current h4:before,
.project-terms-2 a h4:before, .tnp-field-button .tnp-button
{background-color:<?php echo esc_attr( $architect_option['main-color'] ); ?>;}

.avatar-testimonials img,
.avatar-testimonials-1-columns-v2 img,
.large-avatar img,
.blog-1-column-warp .customNavigation .btn:hover,
.form-subcribe input.form-control:focus,
.owl-item.synced .process-item,
.form-subcribe textarea.form-control:focus,
.owl-item.synced .process-item,
.accordion-style-light .panel-default > .panel-heading .panel-title > a,.item-team .member-info,
.form-subcribe form input:focus,
.tagcloud a:hover,
.testimonial-1-column-v2-warp .customNavigation .btn:hover,
.process-item:hover,
.form-contact input.form-control:focus,
.sidebar-left ul.sidebar-style-2 li:hover,
.sidebar-right ul.sidebar-style-2 li:hover,
.sidebar-left ul.sidebar-style-2 li.active,
.sidebar-right ul.sidebar-style-2 li.active,
.btn-coupon:hover,
.form-contact-arc input.form-control:focus,
.form-contact-arc textarea.form-control:focus,
.newsletter-comingsoon .newsletter-email:focus,
ul.countdown li,
.form-subcrible-footer .btn-subcrible-footer:hover,
ul.list-link-footer li:hover a,
.form-subcrible-footer input.form-control:focus,
.form-subcrible-footer input.form-control:hover,
.btn-border:hover,
.btn-border:focus,
.main-sidebar .wp-tag-cloud a:hover,
.top_cart_list_product .buttons .btn-border-white:hover
{border-color:<?php echo esc_attr( $architect_option['main-color'] ); ?>;}

div.vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title>a,
.vc_tta-tabs:not([class*=vc_tta-gap]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-top .vc_tta-tab.vc_active>a,
.dropdown-menu.top_cart_list_product
{border-top-color:<?php echo esc_attr( $architect_option['main-color'] ); ?>;}

.tab2.vc_tta.vc_tta-spacing-1 .vc_tta-tabs-list
{border-bottom-color:<?php echo esc_attr( $architect_option['main-color'] ); ?>;}

/* default color 2 */


.layer-1,
.blog-terms a h4:before,
.blog-terms a:hover h4:before,
.blog-terms a.current h4:before,
.main-sidebar .promotion .promotionText,
.element-item:hover .project-info,
.projectContainer .element-item:hover .project-info,
.ourteamGrid-warp .team-grid-item:hover .grid-team-overlay,
ul.social-dark li a:hover,
#overlay,
.modal-search, .lay-overlay
{background: <?php echo esc_attr( $architect_option['color-2']['rgba'] ); ?>;}

/* header background */
header.header-v4, header.header-v3, header.header-v2,header.header-v1 {
	background: <?php echo esc_attr( $architect_option['header_color']['rgba'] ); ?>;
}
header.header-v4, header.header-v3, header.header-v2,header.header-v1 
{
border-bottom-color: <?php echo esc_attr( $architect_option['header_border']['rgba'] ); ?>;
}
header.header-v4.skrollable-after, header.header-v3.skrollable-after, header.header-v2.skrollable-after,header.header-v1.skrollable-after,
header.header-v2.header-v4.skrollable-after
 {
	background: <?php echo esc_attr( $architect_option['header_scroll']['rgba'] ); ?>;
}
.header-v2 .navi-level-1 > li a, .header-v3 .navi-level-1 > li a, .header-v4 .navi-level-1 > li a, .header-v1 .navi-level-1 > li a
{
color: <?php echo esc_attr( $architect_option['header_text']['rgba'] ); ?>;
}
.topbar-dark 
{
color: <?php echo esc_attr( $architect_option['top_text_color']['rgba'] ); ?>;
}
.topbar-dark 
{
  background-color: <?php echo esc_attr( $architect_option['top_color']['rgba'] ); ?>;
}

.line-separator nav ul.navi-level-1 > li > a:after, .circle-separator nav ul.navi-level-1 > li > a:after, .square-separator nav ul.navi-level-1 > li > a:after,
.plus-separator nav ul.navi-level-1 > li > a:after, .strip-separator nav ul.navi-level-1 > li > a:after, .header-v3 ul.navi-level-1 > li > a:after,
.hover-style-4 nav .navi-level-1 > li:hover > a {
  color:<?php echo esc_attr( $architect_option['main-color'] ); ?>;
}
.hover-style-2 nav .navi-level-1 > li > a > span:before, .hover-style-3 nav .navi-level-1 > li > a > span:before,
.hover-style-5 nav .navi-level-1 > li > a > span:before{
  background-color:<?php echo esc_attr( $architect_option['main-color'] ); ?>;
}

/* preload */
#royal_preloader.logo .percentage {
  color: <?php echo esc_attr( $architect_option['color_pre_text'] ); ?>
}
<?php echo htmlspecialchars_decode($architect_option['custom-css']); ?>