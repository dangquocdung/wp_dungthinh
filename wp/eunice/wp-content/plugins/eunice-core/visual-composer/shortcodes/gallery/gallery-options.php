<?php
/**
 * Gallery - Shortcode Options
 */
add_action( 'init', 'ence_gallery_vc_map' );
if ( ! function_exists( 'ence_gallery_vc_map' ) ) {
  function ence_gallery_vc_map() {
    vc_map(
      array(
      "name" => esc_html__( "Gallery", 'eunice-core'),
      "base" => "ence_gallery",
      "description" => esc_html__( "Gallery Styles", 'eunice-core'),
      "icon" => "fa fa-briefcase color-green",
      "category" => EuniceLib::ence_cat_name(),
      "params" => array(
        array(
          'param_name' => 'gallery_type',
          'type' => 'dropdown',
          'heading' => esc_html__( 'Gallery Type', 'eunice-core' ),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
          'value' => array(
            esc_html__( '--Select Gallery Type--', 'eunice-core' ) => '',
            esc_html__( 'Category Gallery', 'eunice-core' ) => 'category-gallery',
            esc_html__( 'Single Post Gallery', 'eunice-core' ) => 'single-post-gallery',
            esc_html__( 'Single Gallery', 'eunice-core' ) => 'single-gallery',
          ),
          'admin_label' => true,
          'description' => esc_html__( 'Select your gallery style.', 'eunice-core' ),
        ),
        array(
          'param_name' => 'gallery_style',
          'type' => 'dropdown',
          'heading' => esc_html__( 'Gallery Style', 'eunice-core' ),
          'value' => array(
            esc_html__( '--Select Style--', 'eunice-core' ) => '',
            esc_html__( 'Grid', 'eunice-core' ) => 'eu-gallery-grid',
            esc_html__( 'Album', 'eunice-core' ) => 'gallery_album',
            esc_html__( 'Masonry', 'eunice-core' ) => 'eu-gallery-masonry',
            esc_html__( 'Kenburns', 'eunice-core' ) => 'eu-gallery-kenburns',
            esc_html__( 'Ribbon', 'eunice-core' ) => 'eu-gallery-ribbon',
            esc_html__( 'Slider', 'eunice-core' ) => 'eu-gallery-slider',
          ),
          'admin_label' => true,
          'description' => esc_html__( 'Select your gallery style.', 'eunice-core' ),
           'dependency' => array(
            'element' => 'gallery_type',
            'value' => 'single-gallery',
          ),
        ),
        array(
          "param_name"  => "gallery_limit",
          "type"        =>'textfield',
          "heading"     => esc_html__('Limit', 'eunice-core'),
          "placeholder"     => esc_html__('20', 'eunice-core'),
          "value"       => "",
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
           'dependency' => array(
            'element' => 'gallery_type',
            'value' => 'single-post-gallery',
          ),
        ),
        array(
          "param_name"  => "eu_gallery_images",
          "type"        =>'attach_images',
          "heading"     => esc_html__('Add Gallery Images', 'eunice-core'),
          "value"       => "",
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
           'dependency' => array(
            'element' => 'gallery_type',
            'value' => 'single-gallery',
          ),
        ),
        array(
          "param_name"  => "eu_gallery_column",
          "type"        =>'dropdown',
          "heading"     => esc_html__('Column', 'eunice-core'),
          'value' => array(
            esc_html__( '--Select--', 'eunice-core' ) => '',
            esc_html__( 'Three columns', 'eunice-core' ) => 'three-columns',
            esc_html__( 'Four columns', 'eunice-core' ) => 'four-columns',
            esc_html__( 'Five columns', 'eunice-core' ) => 'five-columns',
          ),
          'edit_field_class'   => 'vc_col-md-12 vc_column vt_field_space',
           'dependency' => array(
            'element' => 'gallery_type',
            'value' => 'single-post-gallery',
          ),
        ),
        array(
    	   "param_name"  => 'ends_opt',
          "type"        => "notice",
          "heading"     => esc_html__( "Enable & Disable", 'eunice-core' ),
    			'class'       => 'cs-warning',
    			'value'       => '',
    		),
        array(
          "param_name"  => "gallery_filter",
          "type"        =>'switcher',
          "heading"     => esc_html__('Filter', 'eunice-core'),
          'edit_field_class'   => 'vc_col-md-4 vc_column vt_field_space',
           'dependency' => array(
            'element' => 'gallery_type',
            'value' => 'single-post-gallery',
          ),
        ),
        array(
          "param_name"  => "gallery_pagination",
          "type"        =>'switcher',
          "heading"     => esc_html__('Pagination', 'eunice-core'),
          "value"       => "",
          "std"         => true,
          'edit_field_class'   => 'vc_col-md-4 vc_column vt_field_space',
           'dependency' => array(
            'element' => 'gallery_type',
            'value' => 'single-post-gallery',
          ),
        ),
        array(
          "param_name"  => "ribbon_type",
          "type"        =>'switcher',
          "heading"     => esc_html__('Slide on Mousewheel', 'eunice-core'),
          "value"       => "",
          "std"         => true,
          'edit_field_class'   => 'vc_col-md-4 vc_column vt_field_space',
           'dependency' => array(
            'element' => 'gallery_style',
            'value' => 'eu-gallery-ribbon',
          ),
        ),
        array(
          "param_name"  => "pagination_type",
          "type"        =>'dropdown',
          "heading"     => esc_html__('Pagination Type', 'eunice-core'),
          'value'       => array(
            esc_html__('Navigation', 'eunice-core') => 'navigation',
            esc_html__('Ajax Load', 'eunice-core') => 'ajax_load',
          ),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
           'dependency' => array(
            'element' => 'gallery_pagination',
            'value' => 'true',
          ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => esc_html__( 'Order', 'eunice-core' ),
          'value' => array(
            esc_html__( 'Select Gallery Order', 'eunice-core' ) => '',
            esc_html__('Asending', 'eunice-core') => 'ASC',
            esc_html__('Desending', 'eunice-core') => 'DESC',
          ),
          'dependency' => array(
            'element' => 'gallery_type',
            'value' => 'single-post-gallery',
          ),
          'param_name' => 'gallery_order',
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          'param_name' => 'gallery_orderby',
          'type' => 'dropdown',
          'heading' => esc_html__( 'Order By', 'eunice-core' ),
          'value' => array(
            esc_html__('None', 'eunice-core') => 'none',
            esc_html__('ID', 'eunice-core') => 'ID',
            esc_html__('Author', 'eunice-core') => 'author',
            esc_html__('Title', 'eunice-core') => 'title',
            esc_html__('Date', 'eunice-core') => 'date',
          ),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
          'dependency' => array(
            'element' => 'gallery_type',
            'value' => 'single-post-gallery',
          ),
        ),
          array(
            "param_name"  => "gallery_show_category",
            "type"        => 'textfield',
            "heading"     => esc_html__('Show only certain categories?', 'eunice-core'),
            "value"       => "",
            "description" => esc_html__( "Enter category SLUGS (comma separated) you want to display.", 'eunice-core')
          ),
        EuniceLib::vt_class_option(),


        // Stylings
        array(
    			"param_name"  => 'flst_opt',
          "type"        => "notice",
          "heading"     => esc_html__( "Colors", 'eunice-core' ),
    			'class'       => 'cs-warning',
    			'value'       => '',
          "group"       => esc_html__('Style', 'eunice-core'),
    		),
        array(
          "param_name"  => "overlay_bg_category_gallery",
          "type"        => 'colorpicker',
          "heading"     => esc_html__('Overlay Background', 'eunice-core'),
          "value"       => "",
          'edit_field_class'   => 'vc_col-md-4 vt_field_space',
          "group"       => esc_html__('Style', 'eunice-core'),
           'dependency' => array(
            'element' => 'gallery_type',
            'value' => 'category-gallery',
          ),
        ),
        array(
          "param_name"  => "title_color_category_gallery",
          "type"        => 'colorpicker',
          "heading"     => esc_html__('Title Color', 'eunice-core'),
          "value"       => "",
          'edit_field_class'   => 'vc_col-md-4 vt_field_space',
          "group"       => esc_html__('Style', 'eunice-core'),
           'dependency' => array(
            'element' => 'gallery_type',
            'value' => 'category-gallery',
          ),
        ),
        array(
          "param_name"  => "filter_color",
          "type"        => 'colorpicker',
          "heading"     => esc_html__('Color', 'eunice-core'),
          "value"       => "",
          'edit_field_class'   => 'vc_col-md-4 vt_field_space',
          "group"       => esc_html__('Style', 'eunice-core'),
          'dependency' => array(
            'element' => 'gallery_filter',
            'value' => 'true',
          ),
        ),
        array(
          "type"        => 'colorpicker',
          "heading"     => esc_html__('Image Overlay Color', 'eunice-core'),
          "param_name"  => "image_overlay_color",
          'edit_field_class'   => 'vc_col-md-4 vt_field_space',
          "group"       => esc_html__('Style', 'eunice-core'),
        ),
        array(
          "param_name"  => "gallery_title_size",
          "type"        => 'textfield',
          "heading"     => esc_html__('Title Size', 'eunice-core'),
          "value"       => "",
          'edit_field_class'   => 'vc_col-md-4 vt_field_space',
          "group"       => esc_html__('Style', 'eunice-core'),
        ),
        array(
          "type"        => 'colorpicker',
          "heading"     => esc_html__('Title Color', 'eunice-core'),
          "param_name"  => "gallery_title_color",
          "value"       => "",
          'edit_field_class'   => 'vc_col-md-4 vt_field_space',
          "group"       => esc_html__('Style', 'eunice-core'),
        ),
      )
    )
);
  }
}
