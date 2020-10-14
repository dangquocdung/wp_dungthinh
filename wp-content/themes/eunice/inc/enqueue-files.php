<?php
/*
 * All CSS and JS files are enqueued from this file
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

/**
 * Enqueue Files for FrontEnd
 */
if ( ! function_exists( 'eunice_vt_scripts_styles' ) ) {
  function eunice_vt_scripts_styles() {

    // Styles
    wp_enqueue_style( 'font-awesome', EUNICE_THEMEROOT_URI . '/inc/theme-options/cs-framework/assets/css/font-awesome.min.css' );
    wp_enqueue_style( 'bootstrap-datepicker-css', EUNICE_CSS .'/bootstrap-datepicker.min.css', array(), '1.6.4', 'all' );
    wp_enqueue_style( 'bootstrap-css', EUNICE_CSS .'/bootstrap.min.css', array(), '3.3.6', 'all' );
    wp_enqueue_style( 'animate-css', EUNICE_CSS .'/animate.css', array(), '3.3.6', 'all' );
    wp_enqueue_style( 'owl-carousel', EUNICE_CSS .'/owl.carousel.css', array(), '2.4', 'all' );
    wp_enqueue_style( 'gallery-slider', EUNICE_CSS .'/gallery-slider/gallery-slider.css', array(), '2.4', 'all' );
    wp_enqueue_style( 'eunice-metro', EUNICE_CSS .'/metro.css', array(), EUNICE_VERSION, 'all' );
    wp_enqueue_style( 'eunice-styles', EUNICE_CSS .'/styles.css', array(), EUNICE_VERSION, 'all' );

    // Scripts
    wp_enqueue_script( 'modernizr-js', EUNICE_SCRIPTS . '/vendor/modernizr-2.8.3.min.js', array(), '2.8.3', false );
    wp_enqueue_script( 'eunice-scripts', EUNICE_SCRIPTS . '/scripts.js', array( 'jquery' ), EUNICE_VERSION, true );
    wp_enqueue_script( 'respond-js', EUNICE_SCRIPTS . '/vendor/respond.min.js', array(), '2.8.3', false );
    wp_enqueue_script( 'bootstrap-js', EUNICE_SCRIPTS . '/bootstrap.min.js', array( 'jquery' ), '3.3.6', true );
    wp_enqueue_script( 'eunice-plugins', EUNICE_SCRIPTS . '/plugins.js', array( 'jquery' ), EUNICE_VERSION, true );
    wp_enqueue_script( 'eunice-metro', EUNICE_SCRIPTS . '/metro.js', array( 'jquery' ), EUNICE_VERSION, true );
    wp_enqueue_script( 'eunice-ajax-load-more', EUNICE_SCRIPTS . '/ajax-load-more.js', array( 'jquery' ), '3.3.6', true  );

    // Comments
    wp_enqueue_script( 'validate-js', EUNICE_SCRIPTS . '/jquery.validate.min.js', array( 'jquery' ), '1.9.0', true );
    wp_add_inline_script( 'validate-js', 'jQuery(document).ready(function($) {$("#commentform").validate({rules: {author: {required: true,minlength: 2},email: {required: true,email: true},comment: {required: true,minlength: 10}}});});' );

    // Responsive Active
    $eunice_viewport = cs_get_option('theme_responsive');
    if($eunice_viewport == 'on') {
      wp_enqueue_style( 'eunice-responsive', EUNICE_CSS .'/responsive.css', array(), EUNICE_VERSION, 'all' );
    }

    // Adds support for pages with threaded comments
    if ( is_singular() && comments_open() ) {
      wp_enqueue_script( 'comment-reply' );
    }

  }
  add_action( 'wp_enqueue_scripts', 'eunice_vt_scripts_styles' );
}

/**
 * Enqueue Files for BackEnd
 */
if ( ! function_exists( 'eunice_vt_admin_scripts_styles' ) ) {
  function eunice_vt_admin_scripts_styles() {

    wp_enqueue_style( 'admin-main', EUNICE_CSS . '/admin-styles.css', true );
    wp_enqueue_script( 'admin-scripts', EUNICE_SCRIPTS . '/admin-scripts.js', true );

  }
  add_action( 'admin_enqueue_scripts', 'eunice_vt_admin_scripts_styles' );
}

/* Enqueue All Styles */
if ( ! function_exists( 'eunice_vt_wp_enqueue_styles' ) ) {
  function eunice_vt_wp_enqueue_styles() {
    eunice_vt_google_fonts();
    add_action( 'wp_head', 'eunice_vt_custom_css', 99 );
  }
  add_action( 'wp_enqueue_scripts', 'eunice_vt_wp_enqueue_styles' );
}
