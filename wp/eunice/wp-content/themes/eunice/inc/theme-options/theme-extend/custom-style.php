<?php
/*
 * Codestar Framework - Custom Style
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

/* All Dynamic CSS Styles */
if ( ! function_exists( 'eunice_dynamic_styles' ) ) {
  function eunice_dynamic_styles() {

    $all_element_color  = cs_get_customize_option( 'all_element_colors' );

  ob_start();

global $post;
$eunice_id    = ( isset( $post ) ) ? $post->ID : 0;
$eunice_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $eunice_id;
$eunice_id    = ( eunice_is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $eunice_id;
$eunice_meta  = get_post_meta( $eunice_id, 'page_type_metabox', true );

/* Body - Customizer */
$body_bg  = cs_get_customize_option( 'body_bg' );
if ($body_bg) {
echo <<<CSS
  body{
    background-color: {$body_bg};
  }
CSS;
}
$entry_content_color  = cs_get_customize_option( 'entry_content_color' );
if ($entry_content_color) {
echo <<<CSS
  body{
    color: {$entry_content_color};
  }
CSS;
}

/* Header - Customizer */
$header_area_bg_color  = cs_get_customize_option( 'header_area_bg_color' );
if ($header_area_bg_color) {
echo <<<CSS
  .header-area {
    background: {$header_area_bg_color};
  }
CSS;
}
$header_content_bg_color  = cs_get_customize_option( 'header_content_bg_color' );
if ($header_content_bg_color) {
echo <<<CSS
  .header-content {
    background-color: {$header_content_bg_color};
  }
CSS;
}

$header_menu_color  = cs_get_customize_option( 'header_menu_color' );
if ($header_menu_color) {
echo <<<CSS
  .navbar.main-menu > ul > li > a {
    color: {$header_menu_color};
  }
CSS;
}

$header_menu_hover_color  = cs_get_customize_option( 'header_menu_hover_color' );
if ($header_menu_hover_color) {
echo <<<CSS
  .navbar.main-menu > ul > li > a:hover {
    color: {$header_menu_hover_color};
  }
CSS;
}

$submenu_color  = cs_get_customize_option( 'submenu_color' );
if ($submenu_color) {
echo <<<CSS
  .navbar.main-menu > ul > li ul.sub-menu li a{
    color: {$submenu_color};
  }
CSS;
}

$submenu_hover_color  = cs_get_customize_option( 'submenu_hover_color' );
if ($submenu_hover_color) {
echo <<<CSS
  .sub-menu li.current_page_item, .sub-menu li.current_page_item a, .sub-menu a.current_page_item, .navbar.main-menu .sub-menu a:hover {
    color: {$submenu_hover_color};
  }
CSS;
}

/* Copyright */
$copyright_text_color  = cs_get_customize_option( 'copyright_text_color' );
$copyright_link_color  = cs_get_customize_option( 'copyright_link_color' );
$copyright_link_hover_color  = cs_get_customize_option( 'copyright_link_hover_color' );
$copyright_bg_color  = cs_get_customize_option( 'copyright_bg_color' );
$copyright_border_color  = cs_get_customize_option( 'copyright_border_color' );
if ($copyright_bg_color || $copyright_border_color) {
echo <<<CSS
  .no-class {}
  .ence-copyright {background: {$copyright_bg_color};border-color: {$copyright_border_color};}
CSS;
}
if ($copyright_text_color) {
echo <<<CSS
  .no-class {}
  .ence-copyright,
  .ence-copyright p {color: {$copyright_text_color};}
CSS;
}
if ($copyright_link_color) {
echo <<<CSS
  .no-class {}
  .ence-copyright a {color: {$copyright_link_color};}
CSS;
}
if ($copyright_link_hover_color) {
echo <<<CSS
  .no-class {}
  .ence-copyright a:hover {color: {$copyright_link_hover_color};}
CSS;
}

/* Primary Colors */
if ($all_element_color) {
echo <<<CSS
  .no-class {}
  .blockquote-two:before,
  input[type="submit"],
  .wpcf7 input[type="submit"],
  .ence-header-two #cart-trigger > span,
  .btn-secondary,
  .bpw-style-one .bpw-content .bpw-btn,
  .bpw-col-5.bpw-normal-size.bpw-style-one .bpw-content .bpw-btn,
  .bpw-style-two .ence-portfolio-item:hover .bpw-content,
  .bpw-filter li .btn-active:after,
  .ence-panel-one .panel-default > .panel-heading.accordion-active a:before,
  .nav-tabs > li.active > a:after,
  .ence-education li:before,
  .list-one li:before,
  .ence-blog-one .bp-top-meta > div:after,
  .wp-pagenavi span.current,
  .wp-pagenavi a:hover,
  .wp-link-pages span:hover,
  .wp-link-pages > span,
  .bcc-content .bcc-btn:after,
  .ence-sidenav li a:hover:before,
  .ence-sidenav li.current-menu-item a:before,
  .ence-sidenav li.current-menu-parent > a:before,
  .ence-sidenav > li.ence-active:before,
  .ence-download-btn,
  p.demo_store,
  .woocommerce div.product .woocommerce-tabs ul.tabs li.active a:after,
  span.onsale,
  .woocommerce #respond input#submit.alt,
  .woocommerce a.button.alt,
  .woocommerce button.button.alt,
  .woocommerce input.button.alt,
  .woocommerce #respond input#submit.alt.disabled,
  .woocommerce #respond input#submit.alt.disabled:hover,
  .woocommerce #respond input#submit.alt:disabled,
  .woocommerce #respond input#submit.alt:disabled:hover,
  .woocommerce #respond input#submit.alt:disabled[disabled],
  .woocommerce #respond input#submit.alt:disabled[disabled]:hover,
  .woocommerce a.button.alt.disabled,
  .woocommerce a.button.alt.disabled:hover,
  .woocommerce a.button.alt:disabled,
  .woocommerce a.button.alt:disabled:hover,
  .woocommerce a.button.alt:disabled[disabled],
  .woocommerce a.button.alt:disabled[disabled]:hover,
  .woocommerce button.button.alt.disabled,
  .woocommerce button.button.alt.disabled:hover,
  .woocommerce button.button.alt:disabled,
  .woocommerce button.button.alt:disabled:hover,
  .woocommerce button.button.alt:disabled[disabled],
  .woocommerce button.button.alt:disabled[disabled]:hover,
  .woocommerce input.button.alt.disabled,
  .woocommerce input.button.alt.disabled:hover,
  .woocommerce input.button.alt:disabled,
  .woocommerce input.button.alt:disabled:hover,
  .woocommerce input.button.alt:disabled[disabled],
  .woocommerce input.button.alt:disabled[disabled]:hover,
  .woocommerce-account .woocommerce form .form-row input.button,
  .woocommerce-checkout form > .form-row input.button,
  .woocommerce #respond input#submit.alt:hover,
  .woocommerce a.button.alt:hover,
  .woocommerce button.button.alt:hover,
  .woocommerce input.button.alt:hover,
  span.onsale,
  .woocommerce span.onsale,
  .ence-cta-fullwidth {background-color: {$all_element_color};}

  .ence-service-two .service-icon,
  .ence-service-three .service-icon,
  .ence-service-four .service-icon,
  .ence-service-five .service-icon,
  .ence-panel-two .panel-heading:after,
  .ence-panel-three .panel-title:hover strong,
  .ence-list-icon i,
  .comment-reply-title > a,
  .woocommerce .star-rating span,
  .woocommerce p.stars a,
  .woocommerce .woocommerce-message:before,
  .woocommerce div.product .stock,
  #add_payment_method .cart-collaterals .cart_totals .discount td,
  .woocommerce-cart .cart-collaterals .cart_totals .discount td,
  .woocommerce-checkout .cart-collaterals .cart_totals .discount td,
  .primary-color {color: {$all_element_color};}

  .bpw-style-two .ence-portfolio-item:hover .bpw-content,
  .history-first-section:after,
  .wp-pagenavi span.current,
  .wp-pagenavi a:hover,
  .wp-link-pages span:hover,
  .wp-link-pages > span {border-color: {$all_element_color};}

  .ence-panel-one .panel-default > .panel-heading.accordion-active a:after,
  .woocommerce .woocommerce-message {border-top-color: {$all_element_color};}
CSS;
}

// Content Colors
$body_color  = cs_get_customize_option( 'body_color' );
if ($body_color) {
echo <<<CSS
  .entry-content-text p {color: {$body_color};}
CSS;
}

$body_links_color  = cs_get_customize_option( 'body_links_color' );
if ($body_links_color) {
echo <<<CSS
  .entry-content-text a {color: {$body_links_color};}
CSS;
}

$body_link_hover_color  = cs_get_customize_option( 'body_link_hover_color' );
if ($body_link_hover_color) {
echo <<<CSS
  .entry-content-text a {color: {$body_link_hover_color};}
CSS;
}

// Maintenance Mode
$maintenance_mode_bg  = cs_get_option( 'maintenance_mode_bg' );
if ($maintenance_mode_bg) {
  $maintenance_css = ( ! empty( $maintenance_mode_bg['image'] ) ) ? 'background-image: url('. $maintenance_mode_bg['image'] .');' : '';
  $maintenance_css .= ( ! empty( $maintenance_mode_bg['repeat'] ) ) ? 'background-repeat: '. $maintenance_mode_bg['repeat'] .';' : '';
  $maintenance_css .= ( ! empty( $maintenance_mode_bg['position'] ) ) ? 'background-position: '. $maintenance_mode_bg['position'] .';' : '';
  $maintenance_css .= ( ! empty( $maintenance_mode_bg['attachment'] ) ) ? 'background-attachment: '. $maintenance_mode_bg['attachment'] .';' : '';
  $maintenance_css .= ( ! empty( $maintenance_mode_bg['size'] ) ) ? 'background-size: '. $maintenance_mode_bg['size'] .';' : '';
  $maintenance_css .= ( ! empty( $maintenance_mode_bg['color'] ) ) ? 'background-color: '. $maintenance_mode_bg['color'] .';' : '';
echo <<<CSS
  .no-class {}
  .vt-maintenance-mode {
    {$maintenance_css}
  }
CSS;
}

  echo eunice_vt_get_typography();

  $output = ob_get_clean();
  return $output;

  }

}

/**
 * Custom Font Family
 */
if ( ! function_exists( 'eunice_custom_font_load' ) ) {
  function eunice_custom_font_load() {

    $font_family       = cs_get_option( 'font_family' );

    ob_start();

    if( ! empty( $font_family ) ) {

      foreach ( $font_family as $font ) {
        echo '@font-face{';

        echo 'font-family: "'. $font['name'] .'";';

        if( empty( $font['css'] ) ) {
          echo 'font-style: normal;';
          echo 'font-weight: normal;';
        } else {
          echo esc_attr($font['css']);
        }

        echo ( ! empty( $font['ttf']  ) ) ? 'src: url('. esc_url($font['ttf']) .');' : '';
        echo ( ! empty( $font['eot']  ) ) ? 'src: url('. esc_url($font['eot']) .');' : '';
        echo ( ! empty( $font['svg']  ) ) ? 'src: url('. esc_url($font['svg']) .');' : '';
        echo ( ! empty( $font['woff'] ) ) ? 'src: url('. esc_url($font['woff']) .');' : '';
        echo ( ! empty( $font['otf']  ) ) ? 'src: url('. esc_url($font['otf']) .');' : '';

        echo '}';
      }

    }

    // Typography
    $output = ob_get_clean();
    return $output;
  }
}

/* Custom Styles */
if( ! function_exists( 'eunice_vt_custom_css' ) ) {
  function eunice_vt_custom_css() {
    wp_enqueue_style('eunice-default-style', get_template_directory_uri() . '/style.css');
    $output  = eunice_custom_font_load();
    $output .= eunice_dynamic_styles();
    $output .= cs_get_option( 'theme_custom_css' );
    $custom_css = eunice_compress_css_lines( $output );

    wp_add_inline_style( 'eunice-default-style', $custom_css );
  }
}

/* Custom JS */
if( ! function_exists( 'eunice_vt_custom_js' ) ) {
  function eunice_vt_custom_js() {
    if ( ! wp_script_is( 'scripts', 'done' ) ) {
      wp_enqueue_script( 'scripts' );
    }
    $output = cs_get_option( 'theme_custom_js' );
    wp_add_inline_script( 'jquery-migrate', $output );
  }
  add_action( 'wp_enqueue_scripts', 'eunice_vt_custom_js' );
}
