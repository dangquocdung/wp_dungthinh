<?php
/*
 * All Metabox related options for Eunice theme.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

function eunice_vt_metabox_options( $options ) {

  $options      = array();

  // -----------------------------------------
  // Post Metabox Options                    -
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'post_type_metabox',
    'title'     => esc_html__('Post Options', 'eunice'),
    'post_type' => 'post',
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

      // All Post Formats
      array(
        'name'   => 'section_post_formats',
        'fields' => array(
          // Standard, Image
          array(
            'title' => esc_html__('Standard Image', 'eunice'),
            'type'  => 'subheading',
            'content' => esc_html__('There is no Extra Option for this Post Format!', 'eunice'),
            'wrap_class' => 'vt-minimal-heading hide-title',
          ),
          // Standard, Image

          // Gallery
          array(
            'type'    => 'notice',
            'title'   => esc_html__('Gallery Format', 'eunice'),
            'wrap_class' => 'hide-title',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('Gallery Format', 'eunice')
          ),
          array(
            'id'          => 'gallery_post_format',
            'type'        => 'gallery',
            'title'       => esc_html__('Add Gallery', 'eunice'),
            'add_title'   => esc_html__('Add Image(s)', 'eunice'),
            'edit_title'  => esc_html__('Edit Image(s)', 'eunice'),
            'clear_title' => esc_html__('Clear Image(s)', 'eunice'),
          ),
          // Gallery
          // Video
          array(
            'id'    => 'video_post_format_meta',
            'type'    => 'text',
            'title'   => esc_html__('Add video URL', 'eunice'),
            'wrap_class' => 'show-title',
            'class'   => 'info cs-vt-heading',
          ),
          //quote
          array(
            'id'    => 'quote_post_format_meta_quote',
            'type'    => 'textarea',
            'title'   => esc_html__('Add Quote', 'eunice'),
            'wrap_class' => 'show-title',
            'class'   => 'info cs-vt-heading',
          ),
          array(
            'id'    => 'quote_post_format_meta',
            'type'    => 'text',
            'title'   => esc_html__('Add Author Name', 'eunice'),
            'wrap_class' => 'show-title',
            'class'   => 'info cs-vt-heading',
          ),
          array(
            'id'    => 'quote_post_format_meta_url',
            'type'    => 'text',
            'title'   => esc_html__('Add Author URL', 'eunice'),
            'wrap_class' => 'show-title',
            'class'   => 'info cs-vt-heading',
          )
          // Video

        ),
      ),

    ),
  );

  // -----------------------------------------
  // Post Metabox Options                    -
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'gallery_metaboxes',
    'title'     => esc_html__('Gallery Options', 'eunice'),
    'post_type' => 'gallery',
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

      // All Post Formats
      array(
        'name'   => 'section_gallery_metas',
        'fields' => array(
          array(
            'id'    => 'gallery_subtitle',
            'type'    => 'text',
            'title'   => esc_html__('Subtitle', 'eunice'),
            'class'   => 'info cs-vt-heading',
          ),
          // Gallery
          array(
            'id'          => 'gallery_images_for_galleries',
            'type'        => 'gallery',
            'title'       => esc_html__('Add Gallery', 'eunice'),
            'add_title'   => esc_html__('Add Image(s)', 'eunice'),
            'edit_title'  => esc_html__('Edit Image(s)', 'eunice'),
            'clear_title' => esc_html__('Clear Image(s)', 'eunice'),
          ),
          // Gallery

          // website
          array(
            'id'    => 'portfolio_website',
            'type'    => 'text',
            'title'   => esc_html__('Website', 'eunice'),
            'wrap_class' => 'show-title',
            'class'   => 'info cs-vt-heading',
          ),
          // website
          // client
          array(
            'id'    => 'portfolio_client',
            'type'    => 'text',
            'title'   => esc_html__('Client', 'eunice'),
            'wrap_class' => 'show-title',
            'class'   => 'info cs-vt-heading',
          ),
          // client
          // client url
          array(
            'id'    => 'client_url',
            'type'    => 'text',
            'title'   => esc_html__('Client URL', 'eunice'),
            'class'   => 'info cs-vt-heading',
          )
          // client url

        ),
      ),

    ),
  );

  $options[]    = array(
    'id'        => 'gallery_layoutaaa',
    'title'     => esc_html__('Single Gallery Layout', 'eunice'),
    'post_type' => 'gallery',
    'context'   => 'normal',
    'priority'  => 'high',
    'sections'  => array(
      // Gallery Layouts
      array(
        'name'   => 'single_gallery_layout',
        'fields' => array(

          // Layout
          array(
            'id'          => 'gallery_layouts',
            'type'        => 'select',
            'title'       => esc_html__('Gallery Layouts', 'eunice'),
            'options'     => array(
              'single-fullwidth'      => esc_html__('Full-Width Gallery', 'eunice'),
              'single-grid'           => esc_html__('Gallery grid system', 'eunice'),
              'single-masonry'        => esc_html__('Gallery Masonry', 'eunice'),
              'single-sidebar'        => esc_html__('Gallery Sidebar', 'eunice'),
              'single-vertical-list'  => esc_html__('Gallery Vertical List', 'eunice'),
              )

          ),
          // Layout

        ),
      ),

    ),
  );

  // -----------------------------------------
  // Page Metabox Options                    -
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'page_type_metabox',
    'title'     => esc_html__('Page Custom Options', 'eunice'),
    'post_type' => array('page'),
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

      // Title Section
      // Banner & Title Area
      array(
        'name'  => 'banner_title_section',
        'title' => esc_html__('Banner & Title Area', 'eunice'),
        'icon'  => 'fa fa-bullhorn',
        'fields' => array(
          array(
            'id'        => 'page_top_space',
            'type'      => 'text',
            'title'     => esc_html__('Page Top Space', 'eunice'),
            'attributes' => array(
              'placeholder' => esc_html__('20px', 'eunice'),
            ),
          ),
          array(
            'id'        => 'banner_type',
            'type'      => 'select',
            'title'     => esc_html__('Choose Banner Type', 'eunice'),
            'options'   => array(
              'default-title'    => esc_html__('Default Title', 'eunice'),
              'revolution-slider' => esc_html__('Shortcode [Rev Slider]', 'eunice'),
              'hide-title-area'   => esc_html__('Hide Title/Banner Area', 'eunice'),
            ),
          ),
          array(
            'id'        => 'banner_content_space',
            'type'      => 'text',
            'title'     => esc_html__('Content & Banner Space', 'eunice'),
            'attributes' => array(
              'placeholder' => esc_html__('20px', 'eunice'),
            ),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'    => 'page_revslider',
            'type'  => 'textarea',
            'title' => esc_html__('Revolution Slider or Any Shortcodes', 'eunice'),
            'desc' => esc_html__('Enter any shortcodes that you want to show in this page title area. Eg : Revolution Slider shortcode.', 'eunice'),
            'attributes' => array(
              'placeholder' => esc_html__('Enter your shortcode...', 'eunice'),
            ),
            'dependency'   => array('banner_type', '==', 'revolution-slider'),
          ),
           array(
            'id'    => 'page_custom_title',
            'type'  => 'text',
            'title' => esc_html__('Custom Title', 'eunice'),
            'attributes' => array(
              'placeholder' => esc_html__('Enter your custom title...', 'eunice'),
            ),
            'dependency' => array('banner_type', '==', 'default-title'),
          ),

          array(
            'id'    => 'page_title_align',
            'type'  => 'select',
            'title' => esc_html__('Title Align', 'eunice'),
            'dependency' => array('banner_type', '==', 'default-title'),
            'options' => array(
                'text-default' => esc_html__('Default', 'eunice'),
                'text-center' => esc_html__('Center', 'eunice'),
                'text-left' => esc_html__('Left', 'eunice'),
                'text-right' => esc_html__('Right', 'eunice'),
              )
          ),

        ),
      ),
      // Banner & Title Area
    ),
  );

  // -----------------------------------------
  // Page Layout
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'page_layout_options',
    'title'     => esc_html__('Page Layout', 'eunice'),
    'post_type' => array('page', 'post'),
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'page_layout_section',
        'fields' => array(

          array(
            'id'        => 'page_layout',
            'type'      => 'image_select',
            'options'   => array(
              'full-width'    => EUNICE_CS_IMAGES . '/page-1.png',
              'extra-width'   => EUNICE_CS_IMAGES . '/page-2.png',
              'left-sidebar'  => EUNICE_CS_IMAGES . '/page-3.png',
              'right-sidebar' => EUNICE_CS_IMAGES . '/page-4.png',
            ),
            'attributes' => array(
              'data-depend-id' => 'page_layout',
            ),
            'default'    => 'full-width',
            'radio'      => true,
            'wrap_class' => 'text-center',
          ),
          array(
            'id'            => 'page_sidebar_widget',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Widget', 'eunice'),
            'options'        => eunice_vt_registered_sidebars(),
            'default_option' => esc_html__('Select Widget', 'eunice'),
            'dependency'   => array('page_layout', 'any', 'left-sidebar,right-sidebar'),
          ),

        ),
      ),

    ),
  );

  // -----------------------------------------
  // Testimonial
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'testimonial_options',
    'title'     => esc_html__('Testimonial Client', 'eunice'),
    'post_type' => 'testimonials',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'testimonial_option_section',
        'fields' => array(

          array(
            'id'      => 'testi_name',
            'type'    => 'text',
            'title'   => esc_html__('Name', 'eunice'),
            'info'    => esc_html__('Enter client name', 'eunice'),
          ),
          array(
            'id'      => 'testi_pro',
            'type'    => 'text',
            'title'   => esc_html__('Profession', 'eunice'),
            'info'    => esc_html__('Enter client profession', 'eunice'),
          ),

        ),
      ),

    ),
  );

  // -----------------------------------------
  // Team
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'team_options',
    'title'     => esc_html__('Team Member Details', 'eunice'),
    'post_type' => 'teams',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'team_option_section',
        'fields' => array(

          array(
            'id'      => 'worker_title',
            'type'    => 'text',
            'attributes' => array(
              'placeholder' => esc_html__('Eg : Photographer', 'eunice'),
            ),
          ),
          array(
            'id'                  => 'member_socials',
            'title'               => esc_html__('Member Social', 'eunice'),
            'type'                => 'group',
            'fields'              => array(
              array(
                'id'              => 'title',
                'type'            => 'text',
                'title'           => esc_html__('Title', 'eunice'),
              ),
              array(
                'id'              => 'social_link',
                'type'            => 'text',
                'title'           => esc_html__('Social URL', 'eunice'),
                'info'           => esc_html__('Enter Social Links', 'eunice'),
              ),
            ),

            'button_title'        => esc_html__('Add New', 'eunice'),

          ),

        ),
      ),

    ),
  );

  return $options;

}
add_filter( 'cs_metabox_options', 'eunice_vt_metabox_options' );