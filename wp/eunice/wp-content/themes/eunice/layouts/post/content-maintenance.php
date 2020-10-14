<!DOCTYPE html>
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
wp_head();

// Metabox
$eunice_id    = ( isset( $post ) ) ? $post->ID : 0;
$eunice_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $eunice_id;
$eunice_id    = ( eunice_is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $eunice_id;
$eunice_meta  = get_post_meta( $eunice_id, 'page_type_metabox', true );

if ($eunice_meta) {
  $eunice_content_padding = $eunice_meta['content_spacings'];
} else { $eunice_content_padding = ''; }
// Padding - Metabox
if ($eunice_content_padding && $eunice_content_padding !== 'padding-none') {
  $eunice_content_top_spacings = $eunice_meta['content_top_spacings'];
  $eunice_content_bottom_spacings = $eunice_meta['content_bottom_spacings'];
  if ($eunice_content_padding === 'padding-custom') {
    $eunice_content_top_spacings = $eunice_content_top_spacings ? 'padding-top:'. eunice_check_px($eunice_content_top_spacings) .';' : '';
    $eunice_content_bottom_spacings = $eunice_content_bottom_spacings ? 'padding-bottom:'. eunice_check_px($eunice_content_bottom_spacings) .';' : '';
    $eunice_custom_padding = $eunice_content_top_spacings . $eunice_content_bottom_spacings;
  } else {
    $eunice_custom_padding = '';
  }
} else {
  $eunice_custom_padding = '';
}
?>
</head>

	<body <?php body_class(); ?>>
    <div class="vt-maintenance-mode">
      <div class="container <?php echo esc_attr($eunice_content_padding); ?> ence-content-area" style="<?php echo esc_attr($eunice_custom_padding); ?>">
     	<div class="row">
        <?php
          $eunice_page = get_post( cs_get_option('maintenance_mode_page') );
          WPBMap::addAllMappedShortcodes();
          echo ( is_object( $eunice_page ) ) ? do_shortcode( $eunice_page->post_content ) : '';
        ?>
      </div>
      </div>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>