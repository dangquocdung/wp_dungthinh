<?php
/* ==========================================================
  Lists
=========================================================== */
if ( !function_exists('ence_list_function')) {
  function ence_list_function( $atts, $content = NULL ) {
    extract(shortcode_atts(array(
      'title'  => '',
      'list_items'  => '',
      'class'  => '',
      // Style
      'title_color'  => '',
      'title_size'  => '',
      'text_color'  => '',
      'text_size'  => '',
    ), $atts));

    // Group Field
    $list_items = (array) vc_param_group_parse_atts( $list_items );
    // Shortcode Style CSS
    $e_uniqid        = uniqid();
    $inline_style  = '';
    if ( $text_color || $text_size ) {
      $inline_style .= '.single-page-single-list.ence-list-'. $e_uniqid .' li, .single-page-single-list.ence-list-'. $e_uniqid .' li a {';
      $inline_style .= ( $text_color ) ? 'color:'. $text_color .';' : '';
      $inline_style .= ( $text_size ) ? 'font-size:'. eunice_core_check_px($text_size) .';' : '';
      $inline_style .= '}';
    }
    if ( $title_size || $title_color ) {
      $inline_style .= '.single-page-single-list.ence-list-'. $e_uniqid .' h3{';
      $inline_style .= ( $title_color ) ? 'color:'. $title_color .';' : '';
      $inline_style .= ( $title_size ) ? 'font-size:'. eunice_core_check_px($title_size) .';' : '';
      $inline_style .= '}';
    }

    // add inline style
    add_inline_style( $inline_style );
    $styled_class  = ' ence-list-'. $e_uniqid;

    // output
    $output = '<div class="single-page-single-list '.esc_attr( $class ).esc_attr( $styled_class ).'">';
    $output .= '<h3 class="list-title">'.$title.'</h3>';
    $output .= '<ul>';
    foreach ( $list_items as $list_item ) :
      $open_link = $list_item['open_link'] ? ' target="_blank"' : '';
      if ($list_item['list_url']) {
        $before = '<a href="'.$list_item['list_url'].'" '. $open_link .'>';
        $after  = '</a>';
      }else{
        $before = '';
        $after  = '';
      }
      $output .= '<li>'.$before.$list_item['list_title'].$after.'</li>';
    endforeach;
    $output .= '</ul></div>';

    return $output;
  }
}
add_shortcode( 'ence_list', 'ence_list_function' );
