<?php
/*
 * All Theme Options for Eunice theme.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

function eunice_vt_settings( $settings ) {

  $settings           = array(
    'menu_title'      => EUNICE_NAME . esc_html__(' Options', 'eunice'),
    'menu_slug'       => sanitize_title(EUNICE_NAME) . '_options',
    'menu_type'       => 'menu',
    'menu_icon'       => 'dashicons-awards',
    'menu_position'   => '4',
    'ajax_save'       => false,
    'show_reset_all'  => true,
    'framework_title' => EUNICE_NAME .' <small>V-'. EUNICE_VERSION .' by <a href="'. EUNICE_BRAND_URL .'" target="_blank">'. EUNICE_BRAND_NAME .'</a></small>',
  );

  return $settings;

}
add_filter( 'cs_framework_settings', 'eunice_vt_settings' );

// Theme Framework Options
function eunice_vt_options( $options ) {

  $options      = array(); // remove old options

  // ------------------------------
  // Theme Brand
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_brand',
    'title'    => esc_html__('Brand', 'eunice'),
    'icon'     => 'fa fa-bookmark',
    'sections' => array(

      // brand logo tab
      array(
        'name'     => 'brand_logo_title',
        'title'    => esc_html__('Logo', 'eunice'),
        'icon'     => 'fa fa-star',
        'fields'   => array(

          // Site Logo
          // Site Logo
          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('Site Logo', 'eunice')
          ),
          array(
            'id'    => 'brand_logo_default',
            'type'  => 'image',
            'title' => esc_html__('Default Logo', 'eunice'),
            'info'  => esc_html__('Upload your default logo here. If you not upload, then site title will load in this logo location.', 'eunice'),
            'add_title' => esc_html__('Add Logo', 'eunice'),
          ),
          array(
            'id'    => 'brand_logo_retina',
            'type'  => 'image',
            'title' => esc_html__('Retina Logo', 'eunice'),
            'info'  => esc_html__('Upload your retina logo here. Recommended size is 2x from default logo.', 'eunice'),
            'add_title' => esc_html__('Add Retina Logo', 'eunice'),
          ),
          array(
            'id'          => 'retina_width',
            'type'        => 'text',
            'title'       => esc_html__('Retina & Normal Logo Width', 'eunice'),
            'unit'        => 'px',
          ),
          array(
            'id'          => 'retina_height',
            'type'        => 'text',
            'title'       => esc_html__('Retina & Normal Logo Height', 'eunice'),
            'unit'        => 'px',
          ),

          // WordPress Admin Logo
          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('WordPress Admin Logo', 'eunice')
          ),
          array(
            'id'    => 'brand_logo_wp',
            'type'  => 'image',
            'title' => esc_html__('Login logo', 'eunice'),
            'info'  => esc_html__('Upload your WordPress login page logo here.', 'eunice'),
            'add_title' => esc_html__('Add Login Logo', 'eunice'),
          ),
        ) // end: fields
      ), // end: section

      // Fav
      array(
        'name'     => 'brand_fav',
        'title'    => esc_html__('Fav Icon', 'eunice'),
        'icon'     => 'fa fa-anchor',
        'fields'   => array(

            // -----------------------------
            // Begin: Fav
            // -----------------------------
            array(
              'id'    => 'brand_fav_icon',
              'type'  => 'image',
              'title' => esc_html__('Fav Icon', 'eunice'),
              'info'  => esc_html__('Upload your site fav icon, size should be 16x16.', 'eunice'),
              'add_title' => esc_html__('Add Fav Icon', 'eunice'),
            ),
            array(
              'id'    => 'iphone_icon',
              'type'  => 'image',
              'title' => esc_html__('Apple iPhone icon', 'eunice'),
              'info'  => esc_html__('Icon for Apple iPhone (57px x 57px). This icon is used for Bookmark on Home screen.', 'eunice'),
              'add_title' => esc_html__('Add iPhone Icon', 'eunice'),
            ),
            array(
              'id'    => 'iphone_retina_icon',
              'type'  => 'image',
              'title' => esc_html__('Apple iPhone retina icon', 'eunice'),
              'info'  => esc_html__('Icon for Apple iPhone retina (114px x114px). This icon is used for Bookmark on Home screen.', 'eunice'),
              'add_title' => esc_html__('Add iPhone Retina Icon', 'eunice'),
            ),
            array(
              'id'    => 'ipad_icon',
              'type'  => 'image',
              'title' => esc_html__('Apple iPad icon', 'eunice'),
              'info'  => esc_html__('Icon for Apple iPad (72px x 72px). This icon is used for Bookmark on Home screen.', 'eunice'),
              'add_title' => esc_html__('Add iPad Icon', 'eunice'),
            ),
            array(
              'id'    => 'ipad_retina_icon',
              'type'  => 'image',
              'title' => esc_html__('Apple iPad retina icon', 'eunice'),
              'info'  => esc_html__('Icon for Apple iPad retina (144px x 144px). This icon is used for Bookmark on Home screen.', 'eunice'),
              'add_title' => esc_html__('Add iPad Retina Icon', 'eunice'),
            ),

        ) // end: fields
      ), // end: section

    ),
  );

  // ------------------------------
  // Layout
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_layout',
    'title'  => esc_html__('Layout', 'eunice'),
    'icon'   => 'fa fa-file-text'
  );

  $options[]      = array(
    'name'        => 'theme_general',
    'title'       => esc_html__('General', 'eunice'),
    'icon'        => 'fa fa-wrench',

    // begin: fields
    'fields'      => array(

      // -----------------------------
      // Begin: Responsive
      // -----------------------------
      array(
        'id'    => 'theme_page_comments',
        'type'  => 'switcher',
        'title' => esc_html__('Page Comment', 'eunice'),
        'info' => esc_html__('Turn on if you want to show page comment.', 'eunice'),
        'default' => true,
      ),
      array(
        'id'    => 'theme_responsive',
        'type'  => 'switcher',
        'title' => esc_html__('Responsive', 'eunice'),
        'info' => esc_html__('Turn off if you don\'t want your site to be responsive.', 'eunice'),
        'default' => true,
      ),
      array(
        'id'    => 'page_preloader',
        'type'  => 'switcher',
        'title' => esc_html__('Page Preloader', 'eunice'),
        'info' => esc_html__('Turn On if you want to show Preloader in your pages.', 'eunice'),
        'default' => true,
      ),
      array(
        'id'    => 'upload_preloader',
        'type'  => 'image',
        'title' => esc_html__('Upload Preloader', 'eunice'),
        'info' => esc_html__('Upload if you want to show custom Preloader in your pages.', 'eunice'),
      ),

    ), // end: fields

  );

  // ------------------------------
  // Footer Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'footer_section',
    'title'    => esc_html__('Footer', 'eunice'),
    'icon'     => 'fa fa-ellipsis-h',
    'sections' => array(

      // footer socials
      array(
        'name'     => 'footer_socialsss',
        'title'    => esc_html__('Social Menus', 'eunice'),
        'icon'     => 'fa fa-th',
        'fields'   => array(
       array(
          'id'      => 'need_social',
          'type'    => 'switcher',
          'title'   => esc_html__('Show Social Menu', 'eunice'),
          'default' => true,
        ),
                // Start fields
      array(
        'id'                  => 'footer_socials',
        'type'                => 'group',
        'dependency' => array( 'need_social', '==', 'true' ),
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
          array(
            'id'              => 'social_icon',
            'type'            => 'icon',
            'title'           => esc_html__('Icon', 'eunice'),
            'info'           => esc_html__('Enter Social Icon Name', 'eunice'),
          ),
        ),

        'button_title'        => esc_html__('Add New Social Link', 'eunice'),
        'accordion_title'     => esc_html__('New Social Link', 'eunice'),

      ),
        )
      ),

      // footer copyright
      array(
        'name'     => 'footer_copyright_tab',
        'title'    => esc_html__('Copyright Bar', 'eunice'),
        'icon'     => 'fa fa-copyright',
        'fields'   => array(

          // Copyright
          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('Copyright Layout', 'eunice'),
          ),
          array(
            'id'    => 'need_copyright',
            'type'  => 'switcher',
            'title' => esc_html__('Enable Copyright Section', 'eunice'),
            'default' => true,
          ),
          array(
            'id'    => 'copyright_text',
            'type'  => 'textarea',
            'title' => esc_html__('Copyright Text', 'eunice'),
          ),

        )
      ),

    ),
  );

  // ------------------------------
  // Design
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_design',
    'title'  => esc_html__('Design', 'eunice'),
    'icon'   => 'fa fa-magic'
  );

  // ------------------------------
  // color section
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_color_section',
    'title'    => esc_html__('Colors', 'eunice'),
    'icon'     => 'fa fa-eyedropper',
    'fields' => array(

      array(
        'type'    => 'heading',
        'content' => esc_html__('Color Options', 'eunice'),
      ),
      array(
        'type'    => 'subheading',
        'wrap_class' => 'color-tab-content',
        'content' => esc_html__('All color options are available in our theme customizer. The reason of we used customizer options for color section is because, you can choose each part of color from there and see the changes instantly using customizer. Highly customizable colors are in Appearance > Customize', 'eunice'),
      ),

    ),
  );

  // ------------------------------
  // Typography section
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_typo_section',
    'title'    => esc_html__('Typography', 'eunice'),
    'icon'     => 'fa fa-header',
    'fields' => array(

      // Start fields
      array(
        'id'                  => 'typography',
        'type'                => 'group',
        'fields'              => array(
          array(
            'id'              => 'title',
            'type'            => 'text',
            'title'           => esc_html__('Title', 'eunice'),
          ),
          array(
            'id'              => 'selector',
            'type'            => 'textarea',
            'title'           => esc_html__('Selector', 'eunice'),
            'info'           => esc_html__('Enter css selectors like : <strong>body, .custom-class</strong>', 'eunice'),
          ),
          array(
            'id'              => 'font',
            'type'            => 'typography',
            'title'           => esc_html__('Font Family', 'eunice'),
          ),
          array(
            'id'              => 'size',
            'type'            => 'text',
            'title'           => esc_html__('Font Size', 'eunice'),
          ),
          array(
            'id'              => 'line_height',
            'type'            => 'text',
            'title'           => esc_html__('Line-Height', 'eunice'),
          ),
          array(
            'id'              => 'css',
            'type'            => 'textarea',
            'title'           => esc_html__('Custom CSS', 'eunice'),
          ),
        ),
        'button_title'        => esc_html__('Add New Typography', 'eunice'),
        'accordion_title'     => esc_html__('New Typography', 'eunice'),
        'default'             => array(
          array(
            'title'           => esc_html__('Body Typography', 'eunice'),
            'selector'        => 'body',
            'font'            => array(
              'family'        => 'Crimson+Text',
              'variant'       => 'regular',
            ),
            'size'            => '14px',
            'line_height'     => '1.42857143',
          ),
          array(
            'title'           => esc_html__('Menu Typography', 'eunice'),
            'selector'        => '.ence-navigation .navbar-nav > li > a, .mean-container .mean-nav ul li a',
            'font'            => array(
              'family'        => 'Raleway',
              'variant'       => 'regular',
            ),
            'size'            => '15px',
          ),
          array(
            'title'           => esc_html__('Sub Menu Typography', 'eunice'),
            'selector'        => '.dropdown-menu, .mean-container .mean-nav ul.sub-menu li a',
            'font'            => array(
              'family'        => 'Raleway',
              'variant'       => 'regular',
            ),
            'size'            => '14px',
            'line_height'     => '1.42857143',
          ),
          array(
            'title'           => esc_html__('Headings Typography', 'eunice'),
            'selector'        => 'h1, h2, h3, h4, h5, h6, .ence-location-name, .text-logo',
            'font'            => array(
              'family'        => 'Roboto Slab',
              'variant'       => 'regular',
            ),
          ),

        ),
      ),

      // Subset
      array(
        'id'                  => 'subsets',
        'type'                => 'select',
        'title'               => esc_html__('Subsets', 'eunice'),
        'class'               => 'chosen',
        'options'             => array(
          'latin'             => 'latin',
          'latin-ext'         => 'latin-ext',
          'cyrillic'          => 'cyrillic',
          'cyrillic-ext'      => 'cyrillic-ext',
          'greek'             => 'greek',
          'greek-ext'         => 'greek-ext',
          'vietnamese'        => 'vietnamese',
          'devanagari'        => 'devanagari',
          'khmer'             => 'khmer',
        ),
        'attributes'         => array(
          'data-placeholder' => 'Subsets',
          'multiple'         => 'multiple',
          'style'            => 'width: 200px;'
        ),
        'default'             => array( 'latin' ),
      ),

      array(
        'id'                  => 'font_weight',
        'type'                => 'select',
        'title'               => esc_html__('Font Weights', 'eunice'),
        'class'               => 'chosen',
        'options'             => array(
          '100'   => 'Thin 100',
          '100i'  => 'Thin 100 Italic',
          '200'   => 'Extra Light 200',
          '200i'  => 'Extra Light 200 Italic',
          '300'   => 'Light 300',
          '300i'  => 'Light 300 Italic',
          '400'   => 'Regular 400',
          '400i'  => 'Regular 400 Italic',
          '500'   => 'Medium 500',
          '500i'  => 'Medium 500 Italic',
          '600'   => 'Semi Bold 600',
          '600i'  => 'Semi Bold 600 Italic',
          '700'   => 'Bold 700',
          '700i'  => 'Bold 700 Italic',
          '800'   => 'Extra Bold 800',
          '800i'  => 'Extra Bold 800 Italic',
          '900'   => 'Black 900',
          '900i'  => 'Black 900 Italic',
        ),
        'attributes'         => array(
          'data-placeholder' => 'Font Weight',
          'multiple'         => 'multiple',
          'style'            => 'width: 200px;'
        ),
        'default'             => array( '400' ),
      ),

      // Custom Fonts Upload
      array(
        'id'                 => 'font_family',
        'type'               => 'group',
        'title'              => esc_html__('Upload Custom Fonts', 'eunice'),
        'button_title'       => esc_html__('Add New Custom Font', 'eunice'),
        'accordion_title'    => esc_html__('Adding New Font', 'eunice'),
        'accordion'          => true,
        'desc'               => esc_html__('It is simple. Only add your custom fonts and click to save. After you can check "Font Family" selector. Do not forget to Save!', 'eunice'),
        'fields'             => array(

          array(
            'id'             => 'name',
            'type'           => 'text',
            'title'          => esc_html__('Font-Family Name', 'eunice'),
            'attributes'     => array(
              'placeholder'  => 'for eg. Arial'
            ),
          ),

          array(
            'id'             => 'ttf',
            'type'           => 'upload',
            'title'          => 'Upload .ttf <small><i>(optional)</i></small>',
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'eunice'),
              'button_title' => 'Upload <i>.ttf</i>',
            ),
          ),

          array(
            'id'             => 'eot',
            'type'           => 'upload',
            'title'          => 'Upload .eot <small><i>(optional)</i></small>',
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'eunice'),
              'button_title' => 'Upload <i>.eot</i>',
            ),
          ),

          array(
            'id'             => 'svg',
            'type'           => 'upload',
            'title'          => 'Upload .svg <small><i>(optional)</i></small>',
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => 'Use this Font-Format',
              'button_title' => 'Upload <i>.svg</i>',
            ),
          ),

          array(
            'id'             => 'otf',
            'type'           => 'upload',
            'title'          => 'Upload .otf <small><i>(optional)</i></small>',
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => 'Use this Font-Format',
              'button_title' => 'Upload <i>.otf</i>',
            ),
          ),

          array(
            'id'             => 'woff',
            'type'           => 'upload',
            'title'          => 'Upload .woff <small><i>(optional)</i></small>',
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => 'Use this Font-Format',
              'button_title' => 'Upload <i>.woff</i>',
            ),
          ),

          array(
            'id'             => 'css',
            'type'           => 'textarea',
            'title'          => 'Extra CSS Style <small><i>(optional)</i></small>',
            'attributes'     => array(
              'placeholder'  => 'for eg. font-weight: normal;'
            ),
          ),

        ),
      ),
      // End All field

    ),
  );

  // ------------------------------
  // Pages
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_pages',
    'title'  => esc_html__('Pages', 'eunice'),
    'icon'   => 'fa fa-files-o'
  );

  // ------------------------------
  // Gallery Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'gallery_section',
    'title'    => esc_html__('Gallery', 'eunice'),
    'icon'     => 'fa fa-briefcase',
    'fields' => array(

      // gallery name change
      array(
        'type'    => 'notice',
        'class'   => 'info cs-vt-heading',
        'content' => esc_html__('Name Change', 'eunice')
      ),
      array(
        'id'      => 'theme_gallery_name',
        'type'    => 'text',
        'title'   => esc_html__('Gallery Name', 'eunice'),
        'attributes'     => array(
          'placeholder'  => esc_html__('Gallery', 'eunice'),
        ),
      ),
      array(
        'id'      => 'theme_gallery_slug',
        'type'    => 'text',
        'title'   => esc_html__('Gallery Slug', 'eunice'),
        'attributes'     => array(
          'placeholder'  => esc_html__('Gallery', 'eunice'),
        ),
      ),
      array(
        'id'      => 'theme_gallery_cat_slug',
        'type'    => 'text',
        'title'   => esc_html__('Gallery Category Slug', 'eunice'),
        'attributes'     => array(
          'placeholder'  => 'gallery-item'
        ),
      ),
      array(
        'id'      => 'theme_gallery_url',
        'type'    => 'text',
        'title'   => esc_html__('Gallery Category URL', 'eunice'),
        'attributes'     => array(
          'placeholder'  => 'http://www.yourdomain.com/gallery'
        ),
      ),
      array(
        'id'      => 'gallery_column',
        'type'    => 'select',
        'title'   => esc_html__('Gallery Column', 'eunice'),
        'options'    => array(
          'default-col'    => esc_html__('Default', 'eunice'),
          'three-columns'    => esc_html__('Three Columns', 'eunice'),
          'four-col'    => esc_html__('Four Columns', 'eunice'),
          'five-columns'    => esc_html__('Five Columns', 'eunice'),
        ),
      ),
      array(
        'id'      => 'gallery_single_pagination',
        'type'    => 'switcher',
        'title'   => esc_html__('Next & Prev Navigation', 'eunice'),
        'label'   => esc_html__('If you don\'t want next and previous navigation in gallery single pages, please turn this OFF.', 'eunice'),
        'default'   => true,
      ),
      // Gallery Listing

    ),
  );

  // ------------------------------
  // Blog Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'blog_section',
    'title'    => esc_html__('Blog', 'eunice'),
    'icon'     => 'fa fa-edit',
    'sections' => array(

      // blog general section
      array(
        'name'     => 'blog_general_tab',
        'title'    => esc_html__('General', 'eunice'),
        'icon'     => 'fa fa-cog',
        'fields'   => array(

          // Global Options
          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('Global Options', 'eunice')
          ),
          array(
            'id'      => 'eunice_blogs_columns',
            'type'    => 'select',
            'title'   => esc_html__('Blog Post Column', 'eunice'),
            'options'    => array(
              'three-col'    => esc_html__('Three Columns', 'eunice'),
              'four-col'    => esc_html__('Four Columns', 'eunice'),
              'five-col'    => esc_html__('Five Columns', 'eunice'),
            ),
            'default' => 'four-col'
          ),
          array(
            'id'         => 'theme_exclude_categories',
            'type'       => 'checkbox',
            'title'      => esc_html__('Exclude Categories', 'eunice'),
            'info'      => esc_html__('Select categories you want to exclude from blog page.', 'eunice'),
            'options'    => 'categories',
          ),
          array(
            'id'      => 'theme_blog_excerpt',
            'type'    => 'text',
            'title'   => esc_html__('Excerpt Length', 'eunice'),
            'info'   => esc_html__('Blog short content length, in blog listing pages.', 'eunice'),
            'default' => '55',
          ),
          array(
            'id'      => 'pagination_type',
            'type'    => 'select',
            'title'   => esc_html__('Pagination Type', 'eunice'),
            'options'    => array(
              'navigation'    => esc_html__('Navigation', 'eunice'),
              'ajax-load-more'   => esc_html__('Ajax Load', 'eunice'),
            ),
          ),
          array(
            'id'      => 'theme_metas_hide',
            'type'    => 'checkbox',
            'title'   => esc_html__('Meta\'s to hide', 'eunice'),
            'info'    => esc_html__('Check items you want to hide from blog/post meta field.', 'eunice'),
            'class'      => 'horizontal',
            'options'    => array(
              'category'   => esc_html__('Category', 'eunice'),
              'date'    => esc_html__('Date', 'eunice'),
              'author'     => esc_html__('Author', 'eunice'),
              'comments'      => esc_html__('Comments', 'eunice'),
            ),
            // 'default' => '30',
          ),
          // End fields

        )
      ),

      // blog single section
      array(
        'name'     => 'blog_single_tab',
        'title'    => esc_html__('Single', 'eunice'),
        'icon'     => 'fa fa-sticky-note',
        'fields'   => array(

          // Start fields
          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('Enable / Disable', 'eunice')
          ),
          array(
            'id'    => 'single_featured_image',
            'type'  => 'switcher',
            'title' => esc_html__('Featured Image', 'eunice'),
            'info' => esc_html__('If need to hide featured image from single blog post page, please turn this OFF.', 'eunice'),
            'default' => true,
          ),
          array(
            'id'    => 'single_author_info',
            'type'  => 'switcher',
            'title' => esc_html__('Author Info', 'eunice'),
            'info' => esc_html__('If need to hide author info on single blog page, please turn this OFF.', 'eunice'),
            'default' => true,
          ),
          array(
            'id'    => 'single_share_option',
            'type'  => 'switcher',
            'title' => esc_html__('Share Option', 'eunice'),
            'info' => esc_html__('If need to hide share option on single blog page, please turn this OFF.', 'eunice'),
            'default' => true,
          ),
           array(
            'id'    => 'blog_pagination',
            'type'  => 'switcher',
            'title' => esc_html__('Show Pagination', 'eunice'),
            'info' => esc_html__('Turn off if you don\'t want to show pagination.', 'eunice'),
            'default' => true,
          ),
           array(
            'id'    => 'ajax_navigation',
            'type'  => 'switcher',
            'title' => esc_html__('Ajax Navigation', 'eunice'),
            'info' => esc_html__('Turn off if you don\'t want to show pagination.', 'eunice'),
            'default' => true,
          ),
          array(
            'id'    => 'single_comment_form',
            'type'  => 'switcher',
            'title' => esc_html__('Comment Area/Form', 'eunice'),
            'info' => esc_html__('If need to hide comment area and that form on single blog page, please turn this OFF.', 'eunice'),
            'default' => true,
          ),

          // single widgets
          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('Sidebar', 'eunice')
          ),
          array(
            'id'             => 'single_sidebar_position',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Position', 'eunice'),
            'options'        => array(
              'sidebar-hide' => esc_html__('Hide', 'eunice'),
              'sidebar-right' => esc_html__('Right', 'eunice'),
              'sidebar-left' => esc_html__('Left', 'eunice'),
            ),
            'default_option' => 'Select sidebar position',
            'info'          => esc_html__('Default option : Right', 'eunice'),
          ),
          array(
            'id'             => 'single_blog_widget',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Widget', 'eunice'),
            'options'        => eunice_vt_registered_sidebars(),
            'default_option' => esc_html__('Select Widget', 'eunice'),
            'dependency'     => array('single_sidebar_position', '!=', 'sidebar-hide'),
            'info'          => esc_html__('Default option : Main Widget Area', 'eunice'),
          ),

        )
      ),

    ),
  );

  // ------------------------------
  // Extra Pages
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_extra_pages',
    'title'    => esc_html__('Extra Pages', 'eunice'),
    'icon'     => 'fa fa-clone',
    'sections' => array(

      // error 404 page
      array(
        'name'     => 'error_page_section',
        'title'    => esc_html__('404 Page', 'eunice'),
        'icon'     => 'fa fa-exclamation-triangle',
        'fields'   => array(

          // Start 404 Page
          array(
            'id'    => 'error_heading',
            'type'  => 'text',
            'title' => esc_html__('404 Page Heading', 'eunice'),
            'info'  => esc_html__('Enter 404 page heading.', 'eunice'),
          ),
          array(
            'id'    => 'error_page_content',
            'type'  => 'textarea',
            'title' => esc_html__('404 Page Content', 'eunice'),
            'info'  => esc_html__('Enter 404 page content.', 'eunice'),
            'shortcode' => true,
          ),
          array(
            'id'    => 'error_page_bg',
            'type'  => 'image',
            'title' => esc_html__('404 Page Background', 'eunice'),
            'info'  => esc_html__('Choose 404 page background styles.', 'eunice'),
            'add_title' => esc_html__('Add 404 Image', 'eunice'),
          ),
          array(
            'id'    => 'error_btn_text',
            'type'  => 'text',
            'title' => esc_html__('Button Text', 'eunice'),
            'info'  => esc_html__('Enter BACK TO HOME button text. If you want to change it.', 'eunice'),
          ),
          // End 404 Page

        ) // end: fields
      ), // end: fields section

      // maintenance mode page
      array(
        'name'     => 'maintenance_mode_section',
        'title'    => esc_html__('Maintenance Mode', 'eunice'),
        'icon'     => 'fa fa-hourglass-half',
        'fields'   => array(

          // Start Maintenance Mode
          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('If you turn this ON : Only Logged in users will see your pages. All other visiters will see, selected page of : Maintenance Mode Page', 'eunice')
          ),
          array(
            'id'             => 'enable_maintenance_mode',
            'type'           => 'switcher',
            'title'          => esc_html__('Maintenance Mode', 'eunice'),
            'default'        => false,
          ),
          array(
            'id'             => 'maintenance_mode_page',
            'type'           => 'select',
            'title'          => esc_html__('Maintenance Mode Page', 'eunice'),
            'options'        => 'pages',
            'default_option' => esc_html__('Select a page', 'eunice'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          array(
            'id'             => 'maintenance_mode_bg',
            'type'           => 'background',
            'title'          => esc_html__('Page Background', 'eunice'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          // End Maintenance Mode

        ) // end: fields
      ), // end: fields section

    )
  );

  // ------------------------------
  // Advanced
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_advanced',
    'title'  => esc_html__('Advanced', 'eunice'),
    'icon'   => 'fa fa-cog'
  );

  // ------------------------------
  // Misc Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'misc_section',
    'title'    => esc_html__('Misc', 'eunice'),
    'icon'     => 'fa fa-recycle',
    'sections' => array(
      // custom sidebar section
      array(
        'name'     => 'custom_sidebar_section',
        'title'    => esc_html__('Custom Sidebar', 'eunice'),
        'icon'     => 'fa fa-reorder',
        'fields'   => array(

          // start fields
          array(
            'id'              => 'custom_sidebar',
            'title'           => esc_html__('Sidebars', 'eunice'),
            'desc'            => esc_html__('Go to Appearance -> Widgets after create sidebars', 'eunice'),
            'type'            => 'group',
            'fields'          => array(
              array(
                'id'          => 'sidebar_name',
                'type'        => 'text',
                'title'       => esc_html__('Sidebar Name', 'eunice'),
              ),
              array(
                'id'          => 'sidebar_desc',
                'type'        => 'text',
                'title'       => esc_html__('Custom Description', 'eunice'),
              )
            ),
            'accordion'       => true,
            'button_title'    => esc_html__('Add New Sidebar', 'eunice'),
            'accordion_title' => esc_html__('New Sidebar', 'eunice'),
          ),
          // end fields

        )
      ),
      // custom sidebar section

      // Custom CSS/JS
      array(
        'name'        => 'custom_css_js_section',
        'title'       => esc_html__('Custom Codes', 'eunice'),
        'icon'        => 'fa fa-code',

        // begin: fields
        'fields'      => array(

          // Start Custom CSS/JS
          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('Custom CSS', 'eunice')
          ),
          array(
            'id'             => 'theme_custom_css',
            'type'           => 'textarea',
            'attributes' => array(
              'rows'        => 10,
              'placeholder' => esc_html__('Enter your CSS code here...', 'eunice'),
            ),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('Custom JS', 'eunice')
          ),
          array(
            'id'             => 'theme_custom_js',
            'type'           => 'textarea',
            'attributes' => array(
              'rows'     => 10,
              'placeholder'     => esc_html__('Enter your JS code here...', 'eunice'),
            ),
          ),
          // End Custom CSS/JS

        ) // end: fields
      ),

      // Translation
   array(
        'name'        => 'theme_translation_section',
        'title'       => esc_html__('Translation', 'eunice'),
        'icon'        => 'fa fa-language',

        // begin: fields
        'fields'      => array(

          // Start Translation
          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('Common Texts', 'eunice')
          ),
          array(
            'id'          => 'read_more_text',
            'type'        => 'text',
            'title'       => esc_html__('Read More Text', 'eunice'),
          ),
          array(
            'id'          => 'comment_heading',
            'type'        => 'text',
            'title'       => esc_html__('Leave Your Comments Text', 'eunice'),
          ),
          array(
            'id'          => 'newer_comments',
            'type'        => 'text',
            'title'       => esc_html__('Newer Comments Text', 'eunice'),
          ),
          array(
            'id'          => 'older_comments',
            'type'        => 'text',
            'title'       => esc_html__('Older Comments Text', 'eunice'),
          ),
          array(
            'id'          => 'close_comment',
            'type'        => 'text',
            'title'       => esc_html__('Comments are closed.', 'eunice'),
          ),
          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('Gallery Page', 'eunice')
          ),
          array(
            'id'          => 'portfolio_client_text',
            'type'        => 'text',
            'title'       => esc_html__('Portfolio Client', 'eunice'),
          ),
          array(
            'id'          => 'website_text',
            'type'        => 'text',
            'title'       => esc_html__('Client Website', 'eunice'),
          ),
          array(
            'id'          => 'Category_text',
            'type'        => 'text',
            'title'       => esc_html__('Single gallery Category', 'eunice'),
          ),
          array(
            'id'          => 'share_text',
            'type'        => 'text',
            'title'       => esc_html__('Share Text', 'eunice'),
          ),
          array(
            'id'          => 'share_on_text',
            'type'        => 'text',
            'title'       => esc_html__('Share On Tooltip Text', 'eunice'),
          ),
          array(
            'id'          => 'author_text',
            'type'        => 'text',
            'title'       => esc_html__('Author Text', 'eunice'),
          ),
          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('Pagination', 'eunice')
          ),
          array(
            'id'          => 'older_post',
            'type'        => 'text',
            'title'       => esc_html__('Older Posts Text', 'eunice'),
          ),
          array(
            'id'          => 'newer_post',
            'type'        => 'text',
            'title'       => esc_html__('Newer Posts Text', 'eunice'),
          ),
          array(
            'id'          => 'loadmoretxt',
            'type'        => 'text',
            'title'       => esc_html__('Ajax Load More Text', 'eunice'),
          ),
          array(
            'id'          => 'loadmore_message_blg',
            'type'        => 'text',
            'title'       => esc_html__('Ajax Load More Message for Blog', 'eunice'),
          ),
          array(
            'id'          => 'loadmore_message',
            'type'        => 'text',
            'title'       => esc_html__('Ajax Load More Message for gallery', 'eunice'),
          ),

          // End Translation

        ) // end: fields
      ),

    ),
  );

  // ------------------------------
  // backup                       -
  // ------------------------------
  $options[]   = array(
    'name'     => 'backup_section',
    'title'    => esc_html__('Backup', 'eunice'),
    'icon'     => 'fa fa-shield',
    'fields'   => array(

      array(
        'type'    => 'notice',
        'class'   => 'warning',
        'content' => esc_html__('You can save your current options. Download a Backup and Import.', 'eunice'),
      ),

      array(
        'type'    => 'backup',
      ),

    )
  );

  return $options;

}
add_filter( 'cs_framework_options', 'eunice_vt_options' );