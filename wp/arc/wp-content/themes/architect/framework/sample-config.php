<?php

    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "architect_option";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'opt_name' => 'architect_option',
        'use_cdn' => TRUE,
        'display_name'     => $theme->get('Name'),
        'display_version'  => $theme->get('Version'),
        'page_title' => esc_html__( 'Architect Options', 'architect' ),
        'update_notice' => FALSE,
        'admin_bar' => TRUE,
        'menu_type' => 'menu',
        'menu_title' => esc_html__( 'Architect Options', 'architect' ),
        'allow_sub_menu' => TRUE,
        'page_parent_post_type' => 'your_post_type',
        'customizer' => FALSE,
        'dev_mode'   => false,
        'default_mark' => '*',
        'hints' => array(
            'icon_position' => 'right',
            'icon_color' => 'lightgray',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'compiler' => TRUE,
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'database' => 'options',
        'transient_time' => '3600',
        'network_sites' => TRUE,
    );    

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'architect' ),
            'content' => esc_html__( 'This is the tab content, HTML is allowed.', 'architect' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'architect' ),
            'content' => esc_html__( 'This is the tab content, HTML is allowed.', 'architect' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_html__( 'This is the sidebar content, HTML is allowed.', 'architect' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    // ACTUAL DECLARATION OF SECTIONS          
    Redux::setSection( $opt_name, array(
        'icon' => ' el-icon-stackoverflow',
        'title' => esc_html__('Miscellaneous Settings', 'architect'),
        'fields' => array(
            array(
                'id'       => 'show_pre',
                'type'     => 'switch', 
                'title'    => esc_html__('Preload Off?', 'architect'),
                'subtitle' => esc_html__('Look, it\'s on!', 'architect'),
                'default'  => true,
            ),    
            array(
                'id' => 'img_pre',
                'type' => 'media',
                'url' => false,
                'title' => esc_html__('Image Preload', 'architect'),
                'compiler' => 'true',
                'desc' => esc_html__('Image Prelaod.', 'architect'),
                'default' => array('url' => get_template_directory_uri().'/images/logo.png'),                     
            ),
            array(
                'id' => 'bg_pre',
                'type' => 'color_rgba',
                'title' => esc_html__('background color Preload', 'architect'),
                'subtitle' => esc_html__('Pick the color for the background preload.', 'architect'),                
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1'
                ),
            ),               
            array(
                'id' => 'color_pre_text',
                'type' => 'color',
                'title' => esc_html__('Color Text Preload', 'architect'),
                'subtitle' => esc_html__('Pick the color for the text preload (default: #212121).', 'architect'),
                'default' => '#212121',
                'validate' => 'color',
            ),  
            array(
                'id'       => 'bread-switch',
                'type'     => 'switch', 
                'title'    => esc_html__('Breadcrumbs Off?', 'architect'),
                'subtitle' => esc_html__('Look, it\'s on!', 'architect'),
                'default'  => true,
            ),  
            array(
                'id' => 'gmap_api',
                'type' => 'text',
                'title' => esc_html__('Add your Google map api key.', 'architect'),
                'subtitle' => esc_html__('', 'architect'),
                'desc' => esc_html__('Create your Gmap API key here: https://developers.google.com/maps/documentation/javascript/', 'architect'),
                'default' => 'AIzaSyDZJDaC3vVJjxIi2QHgdctp3Acq8UR2Fgk'
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'icon' => ' el-icon-picture',
        'title' => esc_html__('Logo & Favicon Settings', 'architect'),
        'fields' => array(
            array(
                'id' => 'favicon',
                'type' => 'media',
                'url' => false,
                'title' => esc_html__('Favicon', 'architect'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => esc_html__('Favicon.', 'architect'),
                'subtitle' => esc_html__('Favicon', 'architect'),
               'default' => array('url' => get_template_directory_uri().'/images/favicon.png'),                     
            ),
            array(
                'id' => 'logo',
                'type' => 'media',
                'url' => false,
                'title' => esc_html__('Logo Static', 'architect'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => esc_html__('logo.', 'architect'),
                'subtitle' => esc_html__('Logo', 'architect'),
               'default' => array('url' => get_template_directory_uri().'/images/logo.png'),                     
            ),  
            array(
                'id' => 'logo2',
                'type' => 'media',
                'url' => false,
                'title' => esc_html__('Logo light', 'architect'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => esc_html__('logo light, use for header layout 2, 6.', 'architect'),
               'default' => array('url' => get_template_directory_uri().'/images/logo-invest.png'),                     
            ),                                             
        )
    ) );    
    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-qrcode',
        'title' => esc_html__('Header Settings', 'architect'),
        'fields' => array(
            array(
                'id'       => 'header_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Images Option for Header Layout', 'architect' ),
                'subtitle' => esc_html__( 'Use any header layout for all pages.', 'architect' ),
                'options'  => array(
                    'header1' => array(
                        'alt' => 'Header Layout 1',
                        'img' => get_template_directory_uri().'/images/theme-option/1.jpg'
                    ),
                    'header2' => array(
                        'alt' => 'Header Layout 2',
                        'img' => get_template_directory_uri().'/images/theme-option/2.png'
                    ),
                    'header3' => array(
                        'alt' => 'Header Layout 3',
                        'img' => get_template_directory_uri().'/images/theme-option/3.jpg'
                    ),
                    'header4' => array(
                        'alt' => 'Header Layout 4',
                        'img' => get_template_directory_uri().'/images/theme-option/4.jpg'
                    ),
                ),
                'default'  => 'header1'
            ),      
            array(
                'id' => 'header_color',
                'type' => 'color_rgba',
                'title' => esc_html__('Background color header', 'architect'),
                'subtitle' => esc_html__('Pick the color for the header.', 'architect'),
                
                'default'  => array(
                    'color' => '',
                    'alpha' => '1'
                ),
            ), 
            array(
                'id' => 'header_scroll',
                'type' => 'color_rgba',
                'title' => esc_html__('Background color header Scroll', 'architect'),
                'subtitle' => esc_html__('Pick the color for the header.', 'architect'),                
                'default'  => array(
                    'color' => '',
                    'alpha' => '1'
                ),
            ), 
            array(
                'id' => 'header_text',
                'type' => 'color_rgba',
                'title' => esc_html__('Text color header', 'architect'),
                'subtitle' => esc_html__('Pick the color for the text header.', 'architect'),                
                'default'  => array(
                    'color' => '',
                    'alpha' => '1'
                ),
            ), 
            array(
                'id' => 'header_border',
                'type' => 'color_rgba',
                'title' => esc_html__('Border color header', 'architect'),
                'subtitle' => esc_html__('Pick the border color for the border header.', 'architect'),                
                'default'  => array(
                    'color' => '',
                    'alpha' => '1'
                ),
            ), 
            array(
                'id' => 'phone_header',
                'type' => 'editor',
                'title' => esc_html__('Phone Number', 'architect'),
                'desc' => esc_html__('Phone in header', 'architect'),
                'default' => '1-800-123-6879'
            ),               
            array(
                'id' => 'style_hover_menu',
                'type' => 'select',
                'title' => esc_html__('Hover Menu Link Effect', 'architect'),
                'options'  => array(
                    'no' => esc_html__('No Effect', 'architect'), 
                    'line1' => esc_html__('Line Through Effect', 'architect'),     
                    'bg' => esc_html__('Background Effect', 'architect'), 
                    'text' => esc_html__('Text Color', 'architect'),     
                    'line2' => esc_html__('Line Expand', 'architect'),                        
                ),
                'default' => 'line1',
            ),                          
            array(
                'id' => 'style_seperator',
                'type' => 'select',
                'title' => esc_html__('Menu Seperator Style', 'architect'),
                'options'  => array(
                    'lineth' => esc_html__('Line Through Separator', 'architect'),     
                    'line' => esc_html__('Line Separator', 'architect'), 
                    'circle' => esc_html__('Circle Separator', 'architect'),     
                    'square' => esc_html__('Square Separator', 'architect'),      
                    'plus' => esc_html__('Plus Separator', 'architect'), 
                    'strip' => esc_html__('Strip Separator', 'architect'),     
                    'no' => esc_html__('No Separator', 'architect'),                     
                ),
                'default' => 'lineth',
            ),
            array(
                'id' => 'address',
                'type' => 'editor',
                'title' => esc_html__('Info', 'architect'),
                'desc' => esc_html__('Info in header. Show in mobile', 'architect'),
                'default' => '8th floor, 379 Hudson St,'
            ),                  
        )
    ) ); 
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Top Header', 'architect' ),
        'id'         => 'design-header',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'top_bar',
                'type'     => 'switch', 
                'title'    => esc_html__('Top Bar Off?', 'architect'),
                'subtitle' => esc_html__('Look, it\'s on!', 'architect'),
                'default'  => true,
            ),    
            array(
                'id' => 'top_color',
                'type' => 'color_rgba',
                'title' => esc_html__('background color top header', 'architect'),
                'subtitle' => esc_html__('Pick the color for the top header.', 'architect'),                
                'default'  => array(
                    'color' => '',
                    'alpha' => '1'
                ),
            ), 
            array(
                'id' => 'top_text_color',
                'type' => 'color_rgba',
                'title' => esc_html__('Text color top header', 'architect'),
                'subtitle' => esc_html__('Pick the color for the text top header.', 'architect'),                
                'default'  => array(
                    'color' => '',
                    'alpha' => '1'
                ),
            ),
            array(
                'id' => 'left_top',
                'type' => 'editor',
                'title' => esc_html__('Left Top', 'architect'),
                'desc' => esc_html__('Left top header', 'architect'),
                'default' => 'contact@architect.com'
            ),     
            array(
                'id' => 'right_top',
                'type' => 'editor',
                'title' => esc_html__('Right Top', 'architect'),
                'desc' => esc_html__('Right top header', 'architect'),
                'default' => ''
            ), 
        ),        
    ) );  

    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-blogger',
        'title' => esc_html__('Blog Settings', 'architect'),
        'fields' => array(
            array(
                'id' => 'bg_blog',
                'type' => 'media',
                'url' => false,
                'title' => esc_html__('Background Blog', 'architect'),
                'compiler' => 'true',                  
            ),  
            array(
                'id' => 'blog_excerpt',
                'type' => 'text',
                'title' => esc_html__('Blog custom excerpt lenght', 'architect'),
                'subtitle' => esc_html__('Input Blog custom excerpt lenght', 'architect'),
                'desc' => esc_html__('Blog custom excerpt lenght', 'architect'),
                'default' => '30'
            ),                         
            array(
                'id' => 'blog_layout',
                'type' => 'select',
                'title' => esc_html__('Blog Layout', 'architect'),
                'options'  => array(
                    'right_s' => esc_html__('Right Sidebar', 'architect'),     
                    'left_s' => esc_html__('Left Sidebar', 'architect'), 
                    'full' => esc_html__('Full Width', 'architect'),                        
                ),
                'default' => 'right_s',
            ),     
         )
    ) );     
    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-group',
        'title' => esc_html__('Social Settings', 'architect'),
        'fields' => array(
            array(
                'id' => 'facebook',
                'type' => 'text',
                'title' => esc_html__('Facebook Url', 'architect'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => 'https://www.facebook.com/',
            ),
            array(
                'id' => 'twitter',
                'type' => 'text',
                'title' => esc_html__('Twitter Url', 'architect'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => 'https://twitter.com/',
            ),
            array(
                'id' => 'google',
                'type' => 'text',
                'title' => esc_html__('Google+ Url', 'architect'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => 'https://plus.google.com',
            ),                      
            array(
                'id' => 'github',
                'type' => 'text',
                'title' => esc_html__('Github Url', 'architect'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => ''
            ),
            array(
                'id' => 'youtube',
                'type' => 'text',
                'title' => esc_html__('Youtube Url', 'architect'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => '',
            ),
            array(
                'id' => 'linkedin',
                'type' => 'text',
                'title' => esc_html__('Linkedin Url', 'architect'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => '',
            ),
            array(
                'id' => 'dribbble',
                'type' => 'text',
                'title' => esc_html__('Dribbble Url', 'architect'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => '',
            ),
            array(
                'id' => 'behance',
                'type' => 'text',
                'title' => esc_html__('Behance Url', 'architect'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => ''
            ),
            array(
                'id' => 'instagram',
                'type' => 'text',
                'title' => esc_html__('Instagram Url', 'architect'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => ''
            ),
            array(
                'id' => 'skype',
                'type' => 'text',
                'title' => esc_html__('Skype Url', 'architect'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => ''
            ),  
            array(
                'id' => 'pinterest',
                'type' => 'text',
                'title' => esc_html__('pinterest Url', 'architect'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => ''
            ), 
            array(
                'id' => 'flickr',
                'type' => 'text',
                'title' => esc_html__('flickr Url', 'architect'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => ''
            ), 
            array(
                'id' => 'vimeo',
                'type' => 'text',
                'title' => esc_html__('vimeo Url', 'architect'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => ''
            ), 
            array(
                'id' => 'tumblr',
                'type' => 'text',
                'title' => esc_html__('tumblr Url', 'architect'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => ''
            ), 
            array(
                'id' => 'soundcloud',
                'type' => 'text',
                'title' => esc_html__('soundcloud Url', 'architect'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => ''
            ), 
            array(
                'id' => 'lastfm',
                'type' => 'text',
                'title' => esc_html__('lastfm Url', 'architect'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => ''
            ), 
            array(
                'id' => 'rss',
                'type' => 'text',
                'title' => esc_html__('RSS Url', 'architect'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => '',
            ),  
            array(
                'id' => 'email',
                'type' => 'text',
                'title' => esc_html__('Email Address', 'architect'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => '',
            ), 
        )
    ) );
    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-hourglass',
        'title' => esc_html__('Coming Soon Settings', 'architect'),
        'fields' => array(  
            array(
                'id' => 'date_cs',
                'type' => 'date',
                'title' => esc_html__('Date Comming Soon', 'architect'),
                'default' => '12/30/2018',
            ), 
            array(
                'id' => 'bg_cs',
                'type' => 'media',
                'title' => esc_html__('Background Image', 'architect'),
                'subtitle' => esc_html__('Background Image', 'architect'),
                'desc' => esc_html__('Use For Coming Soon Page', 'architect'),
                'default' => array('url' => get_template_directory_uri().'/images/bg6.jpg')
            ), 
            array(
                'id' => 'title_cs',
                'type' => 'text',
                'title' => esc_html__('Title Coming Soon', 'architect'),
                'default' => 'OUR WEBSITE IS LAUNCHING SOON',
            ),
            array(
                'id' => 'stitle_cs',
                'type' => 'text',
                'title' => esc_html__('Subtitle Coming Soon', 'architect'),
                'default' => 'OUR SITE IS NOT READY YET, BUT WE ARE COMING SOON',
            ),                         
        )    
    ));

    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-hourglass',
        'title' => esc_html__('Shop Settings', 'architect'),
        'fields' => array(        
            array(
                'id' => 'topleft_shop',
                'type' => 'editor',
                'title' => esc_html__('Top Left header Shop', 'architect'),
                'default' => '',
            ),   
            array(
                'id' => 'top_head_shop',
                'type' => 'editor',
                'title' => esc_html__('Title Top head shop page', 'architect'),
                'default' => 'Free shipping for standard order over $100',
            ),     
            array(
                'id' => 'banner_shop',
                'type' => 'media',
                'title' => esc_html__('Banner subheader', 'architect'),
                'default' => array('url' => get_template_directory_uri().'/images/bg9.jpg')
            ),                      
        )    
    ));

    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-hourglass',
        'title' => esc_html__('404 Settings', 'architect'),
        'fields' => array(      
            array(
                'id' => 'image_404',
                'type' => 'media',
                'title' => esc_html__('Background Image', 'architect'),
                'subtitle' => esc_html__('Background Image', 'architect'),
                'desc' => esc_html__('Use For 404 Page', 'architect'),
                'default' => array('url' => get_template_directory_uri().'/images/404.jpg')
            ),                                 
        )    
    ));
    Redux::setSection( $opt_name, array(
        'icon' => ' el-icon-credit-card',
        'title' => esc_html__('Footer Settings', 'architect'),
        'fields' => array(   
            array(
                'id'       => 'footer_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Images Option For Footer Layout', 'architect' ),
                'subtitle' => esc_html__( 'Use any footer layout for all pages.', 'architect' ),
                'options'  => array(
                    'footer1' => array(
                        'alt' => 'Footer Layout 1',
                        'img' => get_template_directory_uri().'/images/theme-option/footer1.jpg'
                    ),
                    'footer2' => array(
                        'alt' => 'Footer Layout 2',
                        'img' => get_template_directory_uri().'/images/theme-option/footer2.jpg'
                    ),
                    'footer3' => array(
                        'alt' => 'Footer Layout 3',
                        'img' => get_template_directory_uri().'/images/theme-option/footer3.jpg'
                    ),
                ),
                'default'  => 'footer1'
            ),
            array(
                'id' => 'logo_ft',
                'type' => 'media',
                'url' => false,
                'title' => esc_html__('Logo Footer', 'architect'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => esc_html__('logo.', 'architect'),
                'subtitle' => esc_html__('Logo', 'architect'),
               'default' => array('url' => get_template_directory_uri().'/images/logo.png'),                     
            ),  
            array(
                'id'       => 'footer-select-pages',
                'type'     => 'select',
                'data'     => 'pages',
                'title'    => esc_html__( 'Pages Select Option', 'architect' ),
                'subtitle' => esc_html__( 'No validation can be done on this field type', 'architect' ),
                'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'architect' ),
            ),        
            array(
                'id'       => 'footer-select-pages-2',
                'type'     => 'select',
                'data'     => 'pages',
                'title'    => esc_html__( 'Pages Select Option. Select page footer shop page', 'architect' ),
                'subtitle' => esc_html__( 'No validation can be done on this field type', 'architect' ),
                'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'architect' ),
            ),             
            array(
                'id' => 'footer_text',
                'type' => 'editor',
                'title' => esc_html__('Footer Text', 'architect'),
                'subtitle' => esc_html__('Copyright Text', 'architect'),
                'default' => 'Copyright 2019 - architect by ThemeModern',
            ),                    
        )
    ) );
    
    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-website',
        'title' => esc_html__('Styling Options', 'architect'),
        'fields' => array(                
            array(
                'id' => 'main-color',
                'type' => 'color',
                'title' => esc_html__('Theme Main Color', 'architect'),
                'subtitle' => esc_html__('Pick the main color for the theme (default: #ebcd1e).', 'architect'),
                'default' => '#ebcd1e',
                'validate' => 'color',
            ),         
            array(
                'id' => 'color-2',
                'type' => 'color_rgba',
                'title' => esc_html__('Theme Color 2', 'architect'),
                'subtitle' => esc_html__('Pick the main color for the theme (default: rgba(235, 205, 30, 0.9)).', 'architect'),
                
                'default'  => array(
                    'color' => '#rgba(235, 205, 30, 0.9)',
                    'alpha' => '1'
                ),
            ),  
            array(
                'id' => 'body-font2',
                'type' => 'typography',
                'output' => array('body'),
                'title' => esc_html__('Body Font', 'architect'),
                'subtitle' => esc_html__('Specify the body font properties.', 'architect'),
                'google' => true,
                'default' => array(
                    'color' => '',
                    'font-size' => '',
                    'line-height' => '',
                    'font-family' => '',
                    'font-weight' => ''
                ),
            ),
             array(
                'id' => 'custom-css',
                'type' => 'ace_editor',
                'title' => esc_html__('CSS Code', 'architect'),
                'subtitle' => esc_html__('Paste your CSS code here.', 'architect'),
                'mode' => 'css',
                'theme' => 'monokai',
                'desc' => 'Possible modes can be found at http://ace.c9.io/.',
                'default' => "#header{\nmargin: 0 auto;\n}"
            ),
        )
    ) );

    /*
     * <--- END SECTIONS
     */
