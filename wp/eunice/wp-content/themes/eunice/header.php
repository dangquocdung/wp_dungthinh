<?php
/*
 * The header for our theme.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<?php
$eunice_viewport = cs_get_option('theme_responsive');
if($eunice_viewport == 'on') { ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php }

// if the `wp_site_icon` function does not exist (ie we're on < WP 4.3)
if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
  if (cs_get_option('brand_fav_icon')) {
    echo '<link rel="shortcut icon" href="'. esc_url(wp_get_attachment_url(cs_get_option('brand_fav_icon'))) .'" />';
  } else { ?>
    <link rel="shortcut icon" href="<?php echo esc_url(EUNICE_IMAGES); ?>/favicon.png" />
  <?php }
  if (cs_get_option('iphone_icon')) {
    echo '<link rel="apple-touch-icon" sizes="57x57" href="'. esc_url(wp_get_attachment_url(cs_get_option('iphone_icon'))) .'" >';
  }
  if (cs_get_option('iphone_retina_icon')) {
    echo '<link rel="apple-touch-icon" sizes="114x114" href="'. esc_url(wp_get_attachment_url(cs_get_option('iphone_retina_icon'))) .'" >';
    echo '<link name="msapplication-TileImage" href="'. esc_url(wp_get_attachment_url(cs_get_option('iphone_retina_icon'))) .'" >';
  }
  if (cs_get_option('ipad_icon')) {
    echo '<link rel="apple-touch-icon" sizes="72x72" href="'. esc_url(wp_get_attachment_url(cs_get_option('ipad_icon'))) .'" >';
  }
  if (cs_get_option('ipad_retina_icon')) {
    echo '<link rel="apple-touch-icon" sizes="144x144" href="'. esc_url(wp_get_attachment_url(cs_get_option('ipad_retina_icon'))) .'" >';
  }
}
$eunice_all_element_color  = cs_get_customize_option( 'all_element_colors' );
?>
<meta name="msapplication-TileColor" content="<?php echo esc_attr($eunice_all_element_color); ?>">
<meta name="theme-color" content="<?php echo esc_attr($eunice_all_element_color); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php
// Metabox
global $post;
$eunice_id    = ( isset( $post ) ) ? $post->ID : false;
$eunice_id    = ( eunice_is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $eunice_id;
$eunice_id    = ( ! is_tag() && ! is_archive() && ! is_search() && ! is_404() ) ? $eunice_id : false;
$eunice_meta  = get_post_meta( $eunice_id, 'page_type_metabox', true );

wp_head();
?>
</head>
<body <?php echo body_class(); ?>>
<?php eunice_site_preloader(); ?>

  <div class="full-layouts">

    <!-- = Mobil View Menu and Logo start = \-->
    <div class="header mobil-view hidden-md hidden-lg">
      <div class=" col-xs-6 logo-area">
        <?php get_template_part( 'layouts/header/logo' ); ?>
      </div>
      <a href="#" class="col-xs-6 nav-view-btn"><i id="movil-nav-icon" class="fa fa-navicon"></i></a>
    </div> <!-- =/ Mobil View Menu and Logo end =-->

    <!-- = Header area start = \-->
    <div class="header-area">
      <div class="header-content">

        <!-- Header start\-->
        <header class="text-center header">
          <?php get_template_part( 'layouts/header/logo' ); ?>
        </header> <!--/ Header end-->
        <!-- Nav main menu start /-->
        <?php
          get_template_part( 'layouts/header/menu', 'bar' );
          get_template_part( 'layouts/footer/main', 'footer' );
        ?>

      </div>
    </div><!--/ = Header area end = -->
