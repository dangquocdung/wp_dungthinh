<?php
// Logo Image
$eunice_brand_logo_default = cs_get_option('brand_logo_default');
$eunice_brand_logo_retina = cs_get_option('brand_logo_retina');

// Retina Size
$eunice_retina_width = cs_get_option('retina_width');
$eunice_retina_height = cs_get_option('retina_height');

if (isset($eunice_brand_logo_default)){
  echo '<div class="logo-img"><a href="'.esc_url(home_url( '/' )).'">';
  if ($eunice_brand_logo_retina){
    echo '<img src="'. esc_url(wp_get_attachment_url($eunice_brand_logo_retina)) .'" width="'. esc_attr($eunice_retina_width) .'" height="'. esc_attr($eunice_retina_height) .'" alt="" class="retina-logo">';
  }
  echo '<img src="'. esc_url(wp_get_attachment_url($eunice_brand_logo_default)) .'" alt="" class="default-logo" width="'. esc_attr($eunice_retina_width) .'" height="'. esc_attr($eunice_retina_height) .'">';
  echo '</a></div>';
} else {
  echo '<a href="'.esc_url(home_url( '/' )).'"><div class="text-uppercase site-logo logo-text">'. esc_attr(get_bloginfo( 'name' )) . '</div></a>';
}
