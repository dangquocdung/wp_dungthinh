<?php
/**
 * Album - Shortcode Options
 */
add_action( 'init', 'ence_album_vc_map' );
if ( ! function_exists( 'ence_album_vc_map' ) ) {
  function ence_album_vc_map() {
    $categories = array();
    $categories_gallery = get_terms( 'gallery_category', 'orderby=count&hide_empty=0' );
    foreach($categories_gallery as $category) {
      $categories[$category->name] = $category->term_id;
    }
    vc_map( array(
      "name" => esc_html__( "Album", 'eunice-core'),
      "base" => "eunice_album",
      "description" => esc_html__( "Album Styles", 'eunice-core'),
      "icon" => "fa fa-briefcase color-green",
      "category" => euniceLib::ence_cat_name(),
      "params" => array(
        array(
          'type' => 'textfield',
          'value' => '',
          'heading' => esc_html__( 'Album Title', 'eunice-core' ),
          'param_name' => 'album_title',
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
          'description' => esc_html__( 'Enter the title for your album.', 'eunice-core' ),
        ),
        array(
          'type' => 'attach_image',
          'value' => '',
          "admin_label"=> true,
          'heading' => esc_html__( 'Album Cover Image', 'eunice-core' ),
          'param_name' => 'cover_image',
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
          'description' => esc_html__( 'Upload the cover image for your album.', 'eunice-core' ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => esc_html__( 'Album Click Style', 'eunice-core' ),
          'value' => array(
            esc_html__( '--select--', 'eunice-core' ) => '',
            esc_html__( 'Custom Link', 'eunice-core' ) => 'custom-link',
            esc_html__( 'Popup Images', 'eunice-core' ) => 'custom-popups',
            esc_html__( 'Gallery Category Link', 'eunice-core' ) => 'category-link',
          ),
          'admin_label' => true,
          'param_name' => 'album_click_style',
          'description' => esc_html__( 'Select your album style.', 'eunice-core' ),
        ),
        array(
          'type' => 'href',
          'heading' => esc_html__( 'Custom Link', 'eunice-core' ),
          'param_name' => 'custom_link',
          'dependency' => array(
            'element' => 'album_click_style',
            'value' => 'custom-link',
          ),
        ),
        array(
          'type' => 'attach_images',
          'value' => '',
          'heading' => esc_html__( 'Popup Images', 'eunice-core' ),
          'param_name' => 'popup_images',
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
          'description' => esc_html__( 'Upload popup images for this album.', 'eunice-core' ),
          'dependency' => array(
            'element' => 'album_click_style',
            'value' => 'custom-popups',
          ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => esc_html__( 'Select Category', 'eunice-core' ),
          'value'  => $categories,
          'param_name' => 'category_link',
          'description' => esc_html__( 'Select category to link this album image.', 'eunice-core' ),
          'dependency' => array(
            'element' => 'album_click_style',
            'value' => 'category-link',
          ),
        ),
        euniceLib::vt_class_option(),

      )
    ) );
  }
}
