<?php
/*
 * All Custom Shortcode for [theme_name] theme.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

if( ! function_exists( 'eunice_vt_shortcodes' ) ) {
  function eunice_vt_shortcodes( $options ) {
  $categories = array();
  $categories_gallery = get_terms( 'gallery_category', 'orderby=count&hide_empty=0' );
  foreach($categories_gallery as $category) {
    $categories[$category->term_id] = $category->name;
  }
// contact form 7 query
  $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
  $contact_forms = array();
  if ( $cf7 ) {
    foreach ( $cf7 as $cform ) {
      $contact_forms[ $cform->ID ] = $cform->post_title;
    }
  } else {
    $contact_forms[ esc_html__( 'No contact forms found', 'eunice-core' ) ] = 0;
  }

    $options       = array();

    $options[]     = array(
      'title'      => esc_html__('Eunice Shortcodes', 'eunice-core'),
      'shortcodes' => array(

        // Gallery
        array(
          'name'          => 'eunice_gallery',
          'title'         => esc_html__('Gallery', 'eunice-core'),
          'fields'        => array(
            array(
              'id' => 'gallery_type',
              'type' => 'select',
              'title' => esc_html__( 'Gallery Type', 'eunice-core' ),
              'options' => array(
                        '' => esc_html__( '--Select Gallery Type--', 'eunice-core' ),
                  'category-gallery'=> esc_html__( 'Category Gallery', 'eunice-core' ),
                  'single-post-gallery' =>  esc_html__( 'Single Post Gallery', 'eunice-core' ),
                  'single-gallery' => esc_html__( 'Single Gallery', 'eunice-core' ),
                ),
              ),
                array(
                  'id' => 'gallery_style',
                  'type' => 'select',
                  'title' => esc_html__( 'Gallery Style', 'eunice-core' ),
                  'options' => array(
                    '' => esc_html__( '--Select Style--', 'eunice-core' ),
                    'gallery_album'=>  esc_html__( 'Album', 'eunice-core' ),
                    'eu-gallery-grid'=>  esc_html__( 'Grid', 'eunice-core' ),
                   'eu-gallery-masonry'  => esc_html__( 'Masonry', 'eunice-core' ),
                   'eu-gallery-kenburns' =>  esc_html__( 'Kenburns', 'eunice-core' ),
                    'eu-gallery-ribbon' => esc_html__( 'Ribbon', 'eunice-core' ),
                     'eu-gallery-slider'=> esc_html__( 'Slider', 'eunice-core' ),
                  ),
                   'dependency' => array( 'gallery_type', '==', 'single-gallery'),
                ),
                array(
                  "id"  => "eu_gallery_images",
                  "type"        =>'gallery',
                  "title"     => esc_html__('Add Gallery Images', 'eunice-core'),
                   'dependency' => array(  'gallery_type', '==', 'single-gallery' ),
                ),
                array(
                  "id"  => "gallery_filter",
                  "type"        =>'switcher',
                  "title"     => esc_html__('Filter', 'eunice-core'),
                   'dependency' => array( 'gallery_type', '==', 'single-post-gallery'),
                ),
                array(
                  "id"  => "gallery_limit",
                  "type"        =>'text',
                  "title"     => esc_html__('Limits', 'eunice-core'),
                   'dependency' => array( 'gallery_type', '==', 'single-post-gallery'),
                ),
                array(
                  "id"  => "gallery_pagination",
                  "type"        =>'switcher',
                  "title"     => esc_html__('Pagination', 'eunice-core'),
                  'dependency' => array( 'gallery_type', '==', 'single-post-gallery'),
                ),
                array(
                  "id"  => "ribbon_type",
                  "type"        =>'switcher',
                  "title"     => esc_html__('Slide on Mousewheel', 'eunice-core'),
                  'dependency' => array( 'gallery_style', '==', 'eu-gallery-ribbon'),
                  ),
                  array(
                    "id"  => "pagination_type",
                    "type"        =>'select',
                    "title"     => esc_html__('Pagination Type', 'eunice-core'),
                    'options'       => array(
                     'navigation'  => esc_html__('Navigation', 'eunice-core'),
                     'ajax_load'  => esc_html__('Ajax Load', 'eunice-core'),
                    ),
                    'dependency' => array( 'gallery_pagination', '==', 'true'),
                  ),
                array(
                  'id'  => 'gallery_order',
                  'type' => 'select',
                  'title' => esc_html__( 'Order', 'eunice-core' ),
                  'options' => array(
                    '' =>  esc_html__( 'Select Gallery Order', 'eunice-core' ),
                    'ASC' =>  esc_html__('Asending', 'eunice-core'),
                    'DESC'=> esc_html__('Desending', 'eunice-core'),
                  ),
                  'dependency' => array( 'gallery_type', '==', 'single-post-gallery'),
                ),
                array(
                  'id' => 'gallery_orderby',
                  'type' => 'select',
                  'title' => esc_html__( 'Order By', 'eunice-core' ),
                  'options' => array(
                   'none' => esc_html__('None', 'eunice-core') ,
                    'ID'=>  esc_html__('ID', 'eunice-core'),
                     'author'=> esc_html__('Author', 'eunice-core'),
                     'title' => esc_html__('Title', 'eunice-core'),
                     'date'  => esc_html__('Date', 'eunice-core'),
                  ),
                  'dependency' => array( 'gallery_type', '==', 'single-post-gallery'),
                ),
                array(
                  "id"  => "gallery_show_category",
                  "type"        => 'text',
                  "title"     => esc_html__('Show only certain categories->(comma separated)', 'eunice-core'),
                ),

          ),
        ),
        // Gallery
        //album
        array(
          'name'          => 'eunice_album_std',
          'title'         => esc_html__('Gallery Albam', 'eunice-core'),
          'view'          => 'clone',
          'clone_id'      => 'eunice_gallery_album',
          'clone_title'   => esc_html__('Add New Album', 'eunice-core'),
          'fields'        => array(
                array(
                  'type' => 'text',
                  'title' => esc_html__( 'Extra Container Class', 'eunice-core' ),
                  'id' => 'container_class',
                  'desc' => esc_html__( 'Enter the title for your album.', 'eunice-core' ),
                ),
            ),
          'clone_fields' => array(
                array(
                  'type' => 'text',
                  'title' => esc_html__( 'Album Title', 'eunice-core' ),
                  'id' => 'album_title',
                  'desc' => esc_html__( 'Enter the title for your album.', 'eunice-core' ),
                ),
                array(
                  'type' => 'image',
                  "admin_label"=> true,
                  'title' => esc_html__( 'Album Cover Image', 'eunice-core' ),
                  'id' => 'cover_image',
                  'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
                  'desc' => esc_html__( 'Upload the cover image for your album.', 'eunice-core' ),
                ),
                array(
                  'type' => 'select',
                  'title' => esc_html__( 'Album Click Style', 'eunice-core' ),
                  'options' => array(
                   '' =>  esc_html__( '--select--', 'eunice-core' ),
                     'custom-link'=> esc_html__( 'Custom Link', 'eunice-core' ),
                    'custom-popups' => esc_html__( 'Popup Images', 'eunice-core' ),
                    'category-link' => esc_html__( 'Gallery Category Link', 'eunice-core' ) ,
                  ),
                  'id' => 'album_click_style',
                  'desc' => esc_html__( 'Select your album style.', 'eunice-core' ),
                ),
                array(
                  'type' => 'text',
                  'title' => esc_html__( 'Custom Link', 'eunice-core' ),
                  'id' => 'custom_link',
                  'dependency' => array('album_click_style', '==',  'custom-link'),
                ),
                array(
                  'type' => 'gallery',
                  'options' => '',
                  'title' => esc_html__( 'Popup Images', 'eunice-core' ),
                  'id' => 'popup_images',
                  'desc' => esc_html__( 'Upload popup images for this album.', 'eunice-core' ),
                  'dependency' => array( 'album_click_style', '==', 'custom-popups' ),
                ),
                array(
                  'type' => 'select',
                  'title' => esc_html__( 'Select Category', 'eunice-core' ),
                  'options'  => $categories,
                  'id' => 'category_link',
                  'desc' => esc_html__( 'Select category to link this album image.', 'eunice-core' ),
                  'dependency' => array( 'album_click_style', '==',  'category-link'),
                ),


            )
        ),

        // album

        // About Meta
        array(
          'name'          => 'about_contact',
          'title'         => esc_html__('About Meta', 'eunice-core'),
          'view'          => 'clone',
          'clone_id'      => 'about_social',
          'clone_title'   => esc_html__('Add New', 'eunice-core'),
          'fields'        => array(
            array(
                'id'        => 'container_width',
                'type'      => 'select',
                'title'     => esc_html__('Container Width', 'eunice-core'),
                 'options'  => array(
                    ''    => esc_html__('--Select--', 'eunice-core'),
                    '818' => esc_html__('818', 'eunice-core'),
                    '750' => esc_html__('750', 'eunice-core'),
                ),
              ),
              array(
                'id'        => 'notice',
                'type'      => 'notice',
                'class'      => 'info',
                'desc'     => esc_html__('Container Width use only needed', 'eunice-core'),
              ),
                array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => esc_html__('Contact Title', 'eunice-core'),
                  'desc'     => esc_html__('example: Contact or Mail or Email....', 'eunice-core'),
                ),
              array(
                'id'        => 'email',
                'type'      => 'text',
                'title'     => esc_html__('Email', 'eunice-core'),
              ),

              ),
            'clone_fields'  => array(
              array(
                'id'        => 'link',
                'type'      => 'text',
                'title'     => esc_html__('Social URL', 'eunice-core'),
              ),
              array(
                'id'        => 'icon',
                'type'      => 'icon',
                'title'     => esc_html__('Social Icon', 'eunice-core'),
              ),
            ),

        ),
        // About Meta

        // Address Info
        array(
          'name'          => 'eunice_contact',
          'title'         => esc_html__('Contact Page', 'eunice-core'),
          'view'          => 'clone',
          'clone_id'      => 'contact_adrs',
          'clone_title'   => esc_html__('Add New Address', 'eunice-core'),
          "fields"        => array(
              array(
                'type'  => 'select',
                'title' => esc_html__( 'Select contact form', 'js_composer' ),
                'id'    => 'id',
                'options' => $contact_forms,
                'desc'  => esc_html__( 'Choose previously created contact form from the drop down list.', 'js_composer' ),
              ),
              array(
                'type' => 'text',
                'title' => esc_html__( 'Title', 'eunice-core' ),
                'desc' => esc_html__( 'Enter Form title for your contact form.', 'eunice-core' ),
                'id' => 'form_title',
              ),
              array(
                'type' => 'textarea',
                'title' => esc_html__( 'Form Description', 'eunice-core' ),
                'desc' => esc_html__( 'Enter description that shows below title.', 'eunice-core' ),
                'id' => 'desc',
              ),
            ), // Params
            'clone_fields' => array(
                  array(
                      'type' => 'text',
                      'title' => 'Ender Address Title',
                      'id' => 'adrs_titl',
                  ),
                  array(
                      'type' => 'textarea',
                      'title' => 'Ender Address Info',
                      'id' => 'adrs_contact',
                      'desc' => 'Please separate with comma line breaking',
                  )
              )
        ),
        // Address Info

        // Google Map
        array(
          'name'          => 'google_maps',
          'title'         => esc_html__('Add Map', 'eunice-core'),
          'view'          => 'clone',
          'clone_id'      => 'gmap_locations',
          'clone_title'   => esc_html__('Add New Location', 'eunice-core'),
          'fields'        => array(
              array(
                "type"        =>'text',
                "title"     => esc_html__('Enter Map ID', 'eunice-core'),
                "id"  => "gmap_id",
                "desc" => esc_html__( 'Enter google map ID. If you\'re using this in <strong>Map Tab</strong> shortcode, enter unique ID for each map tabs. Else leave it as blank. <strong>Note : This should same as Tab ID in Map Tabs shortcode.</strong>', 'eunice-core'),
                'admin_label' => true,
              ),
              array(
                "type"        =>'text',
                "title"     => esc_html__('Enter your Google Map API Key', 'eunice-core'),
                "id"          => "gmap_api",
                "desc" => esc_html__( 'New Google Maps usage policy dictates that everyone using the maps should register for a free API key. <br />Please create a key for "Google Static Maps API" and "Google Maps Embed API" using the <a href="https://console.developers.google.com/project" target="_blank">Google Developers Console</a>.<br /> Or follow this step links : <br /><a href="https://console.developers.google.com/flows/enableapi?apiid=maps_embed_backend&keyType=CLIENT_SIDE&reusekey=true" target="_blank">1. Step One</a> <br /><a href="https://console.developers.google.com/flows/enableapi?apiid=static_maps_backend&keyType=CLIENT_SIDE&reusekey=true" target="_blank">2. Step Two</a><br /> If you still receive errors, please check following link : <a href="https://churchthemes.com/2016/07/15/page-didnt-load-google-maps-correctly/" target="_blank">How to Fix?</a>', 'eunice-core'),
              ),

              array(
                "type"        => "notice",
                "title"       => esc_html__( "Map Settings", 'eunice-core' ),
                "id"          => 'map_settings',
                'class'       => 'cs-info',
              ),
              array(
                'type' => 'select',
                'title' => esc_html__( 'Google Map Type', 'eunice-core' ),
                'options' => array(
                 ''=> esc_html__( 'Select Type', 'eunice-core' ),
                 'ROADMAP'  => esc_html__( 'ROADMAP', 'eunice-core' ) ,
                 'SATELLITE'=>  esc_html__( 'SATELLITE', 'eunice-core' ) ,
                 'HYBRID'   => esc_html__( 'HYBRID', 'eunice-core' ) ,
                 'TERRAIN' =>  esc_html__( 'TERRAIN', 'eunice-core' ),
                ),
                'id' => 'gmap_type',
                'desc' => esc_html__( 'Select your google map type.', 'eunice-core' ),
              ),
              array(
                'type' => 'select',
                'title' => esc_html__( 'Google Map Style', 'eunice-core' ),
                'options' => array(
                   ''=> esc_html__( 'Select Style', 'eunice-core' ) ,
                   "eunice-custom"=> esc_html__( 'Eunice', 'eunice-core' ),
                   "gray-scale"=> esc_html__( 'Gray Scale', 'eunice-core' ) ,
                   "mid-night"=> esc_html__( 'Mid Night', 'eunice-core' ) ,
                   'blue-water'=> esc_html__( 'Blue Water', 'eunice-core' ),
                   'light-dream'=> esc_html__( 'Light Dream', 'eunice-core' ),
                   'pale-dawn'=> esc_html__( 'Pale Dawn', 'eunice-core' ),
                   'apple-maps'=> esc_html__( 'Apple Maps-esque', 'eunice-core' ) ,
                   'blue-essence'=> esc_html__( 'Blue Essence', 'eunice-core' ),
                   'unsaturated-browns'=>  esc_html__( 'Unsaturated Browns', 'eunice-core' ),
                   'paper'=> esc_html__( 'Paper', 'eunice-core' ),
                   'midnight-commander'=> esc_html__( 'Midnight Commander', 'eunice-core' ) ,
                   'light-monochrome'=> esc_html__( 'Light Monochrome', 'eunice-core' ),
                   'flat-map'=> esc_html__( 'Flat Map', 'eunice-core' ),
                   'retro'=> esc_html__( 'Retro', 'eunice-core' ),
                   'becomeadinosaur'=> esc_html__( 'becomeadinosaur', 'eunice-core' ) ,
                   'neutral-blue'=> esc_html__( 'Neutral Blue', 'eunice-core' ),
                   'subtle-grayscale'=> esc_html__( 'Subtle Grayscale', 'eunice-core' ),
                   'ultra-light-labels'=> esc_html__( 'Ultra Light with Labels', 'eunice-core' ),
                   'shades-grey'=> esc_html__( 'Shades of Grey', 'eunice-core' ),
                ),
                'id' => 'gmap_style',
                'desc' => esc_html__( 'Select your google map style.', 'eunice-core' ),
                'dependency'  => array('gmap_type', '==', 'ROADMAP'),
              ),
              array(
                "type"        =>'text',
                "title"     => esc_html__('Height', 'eunice-core'),
                "id"  => "gmap_height",
                "desc" => esc_html__( "Enter the px value for map height. This will not work if you add this shortcode into the Map Tab shortcode.", 'eunice-core'),
              ),
              array(
                "type"      =>'image',
                "title"     => esc_html__('Common Marker', 'eunice-core'),
                "id"        => "gmap_common_marker",
                "desc"      => esc_html__( "Upload your custom marker.", 'eunice-core'),
              ),

              array(
                "type"      => "notice",
                "title"     => esc_html__( "Enable & Disable", 'eunice-core' ),
                "id"        => 'enb_disb',
              ),
              array(
                "type"        =>'switcher',
                "title"     => esc_html__('Scroll Wheel', 'eunice-core'),
                "id"  => "gmap_scroll_wheel",
              ),
              array(
                "type"        =>'switcher',
                "title"     => esc_html__('Street View Control', 'eunice-core'),
                "id"  => "gmap_street_view",
              ),
              array(
                "type"    =>'switcher',
                "title"   => esc_html__('Map Type Control', 'eunice-core'),
                "id"      => "gmap_maptype_control",
              ),

              // Map Markers
              array(
                "type"      => "notice",
                "desc"      => esc_html__( "Map Pins", 'eunice-core' ),
                "id"        => 'map_pins',
              ),
            ),
            'clone_fields' => array(
              array(
                'type' => 'text',
                'title' => esc_html__( 'Latitude', 'eunice-core' ),
                'id' => 'latitude',
                'desc' => esc_html__( 'Find Latitude : <a href="http://www.latlong.net/" target="_blank">latlong.net</a>', 'eunice-core' ),
              ),
              array(
                'type' => 'text',
                'title' => esc_html__( 'Longitude', 'eunice-core' ),
                'id' => 'longitude',
                'desc' => esc_html__( 'Find Longitude : <a href="http://www.latlong.net/" target="_blank">latlong.net</a>', 'eunice-core' ),
              ),
              array(
                'type' => 'image',
                'title' => esc_html__( 'Custom Marker', 'eunice-core' ),
                'id' => 'custom_marker',
                "desc" => esc_html__( "Upload your unique map marker if your want to differentiate from others.", 'eunice-core'),
              ),
              array(
                'type' => 'text',
                'title' => esc_html__( 'title', 'eunice-core' ),
                'id' => 'location_title',
              ),
              array(
                'type' => 'textarea',
                'title' => esc_html__( 'Content', 'eunice-core' ),
                'id' => 'location_text',
              ),
          ),
        ),
        // Google Map

      ),

    );

    /* Typography Shortcodes */
    $options[]     = array(
      'title'      => esc_html__('Typography and Image Block', 'eunice-core'),
      'shortcodes' => array(
        // typo
        array(
          'name'          => 'inner_title',
          'title'         => esc_html__('Inner Title', 'eunice-core'),
          'fields'        => array(
            array(
              'id'        => 'title',
              'type'      => 'text',
              'title'     => esc_html__('Content', 'eunice-core'),
            ),
            array(
              'id'        => 'heading_tags',
              'type'      => 'select',
              'title'     => esc_html__('Heading Type', 'eunice-core'),
              'options'   => array(
                'h1' => esc_html__('H1', 'eunice-core'),
                'h2' => esc_html__('H2', 'eunice-core'),
                'h3' => esc_html__('H3', 'eunice-core'),
                'h4' => esc_html__('H4', 'eunice-core'),
                'h5' => esc_html__('H5', 'eunice-core'),
                'h6' => esc_html__('H6', 'eunice-core'),
              ),
            ),
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'eunice-core'),
            ),
            array(
              'id'        => 'custom_css',
              'type'      => 'textarea',
              'title'     => esc_html__('Custom CSS', 'eunice-core'),
            ),

          ),
        ),
        array(
          'name'          => 'text_block',
          'title'         => esc_html__('Text Bloc', 'eunice-core'),
          'fields'        => array(
            array(
              'id'        => 'content_type',
              'type'      => 'select',
              'title'     => esc_html__('Block Type', 'eunice-core'),
              'options'   => array(
                'text-semi-strong' => esc_html__('Semi Strong', 'eunice-core'),
                'text-strong' => esc_html__('Strong', 'eunice-core'),
              ),
            ),
            array(
              'id'        => 'texts',
              'type'      => 'textarea',
              'title'     => esc_html__('Content', 'eunice-core'),
            ),
            array(
              'id'        => 'custom_css',
              'type'      => 'textarea',
              'title'     => esc_html__('Custom CSS', 'eunice-core'),
            ),
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'eunice-core'),
            ),

          ),
        ),
        array(
          'name'          => 'inner_link',
          'title'         => esc_html__('Inner Link', 'eunice-core'),
          'fields'        => array(
            array(
              'id'        => 'texts',
              'type'      => 'text',
              'title'     => esc_html__('Link Text', 'eunice-core'),
            ),
            array(
              'id'        => 'url',
              'type'      => 'text',
              'title'     => esc_html__('URL', 'eunice-core'),
              'attributes' => array(
                'placeholder'     => 'http://',
              ),
            ),
            array(
              'id'        => 'target_tab',
              'type'      => 'switcher',
              'title'     => __('Open New Tab?', 'eunice-core'),
              'on_text'     => __('Yes', 'eunice-core'),
              'off_text'     => __('No', 'eunice-core'),
            ),
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'eunice-core'),
            ),
            array(
              'id'        => 'custom_css',
              'type'      => 'textarea',
              'title'     => esc_html__('Custom CSS', 'eunice-core'),
            ),

          ),
        ),
        array(
          'name'          => 'ence_quote',
          'title'         => esc_html__('Quote Bloc', 'eunice-core'),
          'fields'        => array(
            array(
              'id'        => 'texts',
              'type'      => 'textarea',
              'title'     => esc_html__('Content', 'eunice-core'),
            ),
            array(
              'id'        => 'cite',
              'type'      => 'text',
              'title'     => esc_html__('Author', 'eunice-core'),
            ),
            array(
              'id'        => 'url',
              'type'      => 'text',
              'title'     => esc_html__('Author', 'eunice-core'),
              'attributes' => array(
                'placeholder'     => 'http://',
              ),
            ),
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'eunice-core'),
            ),
            array(
              'id'        => 'custom_css',
              'type'      => 'textarea',
              'title'     => esc_html__('Custom CSS', 'eunice-core'),
            ),

          ),
        ),
        array(
          'name'          => 'image_block',
          'title'         => esc_html__('Image Block', 'eunice-core'),
          'view'          => 'clone',
          'clone_id'      => 'single_image',
          'clone_title'   => esc_html__('Add Image', 'eunice-core'),
          'fields'        => array(
            array(
              'id'        => 'column',
              'type'      => 'select',
              'title'     => esc_html__('Select Image Column', 'eunice-core'),
              'options'   => array(
                'single-image' => esc_html__('Sinlg Column', 'eunice-core'),
                'two-image' => esc_html__('Two column', 'eunice-core'),
                'three-image' => esc_html__('Three column', 'eunice-core'),
                'four-image' => esc_html__('Four column', 'eunice-core'),
              ),
            ),
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'eunice-core'),
            ),
          ),
          'clone_fields' => array(
            array(
              'id'        => 'image',
              'type'      => 'image',
              'title'     => esc_html__('Upload Image', 'eunice-core'),
            ),
            array(
              'id'        => 'alt',
              'type'      => 'text',
              'title'     => esc_html__('Alt Text', 'eunice-core'),
            ),
          ),
        ),
        // Spacer
        array(
          'name'          => 'eunice_space',
          'title'         => esc_html__('Spacer', 'eunice-core'),
          'fields'        => array(

            array(
              'id'        => 'height',
              'type'      => 'text',
              'title'     => esc_html__('Height', 'eunice-core'),
              'attributes' => array(
                'placeholder'     => '20px',
              ),
            ),

          ),
        ),
        // Spacer

      ),
    );

    /* List Shortcodes */
    $options[]     = array(
      'title'      => esc_html__('Eunice Lists', 'eunice-core'),
      'shortcodes' => array(
        // Address Info
        array(
          'name'          => 'eunice_lists',
          'title'         => esc_html__('Eunice Vertical List', 'eunice-core'),
          'view'          => 'clone',
          'clone_id'      => 'eunice_list_item',
          'clone_title'   => esc_html__('Add New', 'eunice-core'),
          'fields'        => array(
            array(
              'id'        => 'container_width',
              'type'      => 'select',
              'title'     => esc_html__('Container Width', 'eunice-core'),
              'options'  => array(
                  ''    => esc_html__('--Select--', 'eunice-core'),
                  '818' => esc_html__('818', 'eunice-core'),
                  '750' => esc_html__('750', 'eunice-core'),
              ),
            ),
            array(
              'type'      => 'notice',
              'class'      => 'info',
              'content'     => esc_html__('Container Width use only needed', 'eunice-core'),
            ),
            array(
              'id'        => 'columns',
              'type'      => 'select',
              'title'     => esc_html__('Columns', 'eunice-core'),
              'options'  => array(
                ''    => esc_html__('--Select--', 'eunice-core'),
                'one_column' => esc_html__('1 Column', 'eunice-core'),
                'two_column' => esc_html__('2 Columns', 'eunice-core'),
                'three_column' => esc_html__('3 Columns', 'eunice-core'),
              ),
            ),
            array(
              'id'        => 'first_title',
              'type'      => 'text',
              'title'     => esc_html__('First Column Title', 'eunice-core'),
            ),
            array(
              'id'        => 'secound_title',
              'type'      => 'text',
              'title'     => esc_html__('2nd Column Title', 'eunice-core'),
            ),
            array(
              'id'        => 'third_title',
              'type'      => 'text',
              'title'     => esc_html__('3rd Column Title', 'eunice-core'),
            ),
          ),
          'clone_fields'  => array(
            array(
              'id'        => 'need_colum',
              'type'      => 'select',
              'title'     => esc_html__('Select Item\'s Column' , 'eunice-core'),
              'options'  => array(
                ''    => esc_html__('--Select--', 'eunice-core'),
                'first_column' => esc_html__('1st Column Item', 'eunice-core'),
                'secound_column' => esc_html__('2nd Column Item', 'eunice-core'),
                'third_column' => esc_html__('3rd Column Item', 'eunice-core'),
              ),
            ),
            array(
              'id'        => 'title',
              'type'      => 'text',
              'title'     => esc_html__('Title', 'eunice-core'),
            ),
            array(
              'id'        => 'url',
              'type'      => 'text',
              'title'     => esc_html__('URL', 'eunice-core'),
            ),
          ),
        ),

        array(
          'name'          => 'eunice_horizontal_list',
          'title'         => esc_html__('Eunice Horizontal List', 'eunice-core'),
          'view'          => 'clone',
          'clone_id'      => 'eunice_single_list',
          'clone_title'   => esc_html__('Add New List', 'eunice-core'),
          'fields'        => array(
            array(
              'id'        => 'container_width',
              'type'      => 'select',
              'title'     => esc_html__('Container Width', 'eunice-core'),
              'options'  => array(
                  ''    => esc_html__('--Select--', 'eunice-core'),
                  '818' => esc_html__('818', 'eunice-core'),
                  '750' => esc_html__('750', 'eunice-core'),
              ),
            ),
            array(
              'id'        => 'section_title',
              'type'      => 'text',
              'title'     => esc_html__('List Block Title', 'eunice-core'),
            ),

          ),
          'clone_fields'  => array(
            array(
              'id'        => 'title',
              'type'      => 'text',
              'title'     => esc_html__('List Title', 'eunice-core'),
            ),
            array(
              'id'        => 'link',
              'type'      => 'text',
              'title'     => esc_html__('Link', 'eunice-core'),
            ),
          ),
        ),

      ),
    );

  return $options;

  }
  add_filter( 'cs_shortcode_options', 'eunice_vt_shortcodes' );
}