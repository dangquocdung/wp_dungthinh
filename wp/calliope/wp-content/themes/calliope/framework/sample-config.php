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
    $opt_name = "theme_option";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'opt_name' => 'theme_option',
        'use_cdn' => TRUE,
        'display_name'     => $theme->get('Name'),
        'display_version'  => $theme->get('Version'),
        'page_title' => 'Calliope Options',
        'update_notice' => FALSE,
        'admin_bar' => TRUE,
        'menu_type' => 'menu',
        'menu_title' => 'Calliope Options',
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
            'title'   => esc_html__( 'Theme Information 1', 'calliope' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'calliope' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'calliope' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'calliope' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'calliope' );
    Redux::setHelpSidebar( $opt_name, $content );


    // ACTUAL DECLARATION OF SECTIONS          
            
    Redux::setSection( $opt_name, array(
        'icon' => ' el-icon-picture',
        'title' => __('Logo & Favicon Settings', 'calliope'),
        'fields' => array(
            array(
                'id' => 'favicon',
                'type' => 'media',
                'url' => true,
                'title' => __('Custom Favicon', 'calliope'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Upload your Favicon.', 'calliope'),
                'subtitle' => __('', 'calliope'),
                'default' => array('url' => get_template_directory_uri().'/images/favicon.png'),
            ),
            array(
                'id' => 'logo',
                'type' => 'media',
                'url' => true,
                'title' => __('Logo static', 'calliope'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Upload your logo static.', 'calliope'),
                'subtitle' => __('Recommended size: Height: 25px and Width: 134px', 'calliope'),
                'default' => array('url' => get_template_directory_uri().'/images/logo.png'),
            ),
            array(
                'id' => 'logo_width',
                'type' => 'text',
                'title' => __('Fix Width Logo static, Default: 120px', 'calliope'),
                'subtitle' => __('Input Width logo', 'calliope'),
                'desc' => __('', 'calliope'),
                'default' => ''
            ),  
            array(
                'id' => 'logo_height',
                'type' => 'text',
                'title' => __('Fix Height Logo static, Default: 40px', 'calliope'),
                'subtitle' => __('Input Height Logo', 'calliope'),
                'desc' => __('', 'calliope'),
                'default' => ''
            ),
            array(
                'id' => 'apple_icon',
                'type' => 'media',
                'url' => true,
                'title' => __('Apple Touch Icon 57x57', 'calliope'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Upload your Apple touch icon 57x57.', 'calliope'),
                'subtitle' => __('', 'calliope'),
                'default' => array('url' => get_template_directory_uri().'/images/apple-touch-icon.png'),
            ),                  
            array(
                'id' => 'apple_icon_72',
                'type' => 'media',
                'url' => true,
                'title' => __('Apple Touch Icon 72x72', 'calliope'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Upload your Apple touch icon 72x72.', 'calliope'),
                'subtitle' => __('', 'calliope'),
                'default' => array('url' => get_template_directory_uri().'/images/apple-touch-icon-72x72.png'),
            ),
            array(
                'id' => 'apple_icon_114',
                'type' => 'media',
                'url' => true,
                'title' => __('Apple Touch Icon 114x114', 'calliope'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Upload your Apple touch icon 114x114.', 'calliope'),
                'subtitle' => __('', 'calliope'),
                'default' => array('url' => get_template_directory_uri().'/images/apple-touch-icon-114x114.png'),
            ),                  
        )
    ) );
    
    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-repeat',
        'title' => __('Preload Settings', 'calliope'),
        'fields' => array(
            array(
                'id' => 'show_pre',
                'type' => 'select',
                'title' => __('Show Preload?', 'calliope'),
                'subtitle' => __('Option Show Preload', 'calliope'),
                'desc' => __('', 'calliope'),
                'options'  => array(
                    'yes' => 'Yes',
                    'no'  => 'No',
                ),
                'default' => 'yes',
            ),
                
         )
    ) );
    
    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-blogger',
        'title' => __('Blog Settings', 'calliope'),
        'fields' => array(
            array(
                'id' => 'bg_blog',
                'type' => 'media',
                'url' => true,
                'title' => __('Header Blog Single Background', 'calliope'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Upload your image background.', 'calliope'),
                'default' => array('url' => get_template_directory_uri().'/images/5.jpg'),
            ),      
            array(
                'id' => 'blog_title',
                'type' => 'text',
                'title' => __('Blog  Title', 'calliope'),
                'subtitle' => __('Input Blog Single Title', 'calliope'),
                'desc' => __('', 'calliope'),
                'default' => 'Blog Single'
            ),
            array(
                'id' => 'blog_stitle',
                'type' => 'textarea',
                'title' => __('Blog Single Subtitle', 'calliope'),
                'subtitle' => __('Input Blog Single Subtitle', 'calliope'),
                'desc' => __('', 'calliope'),
                'default' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
            ),
            array(
                'id' => 'blog_excerpt',
                'type' => 'text',
                'title' => __('Excerpt Blog', 'calliope'),
                'subtitle' => __('Short text in blog.', 'calliope'),
                'desc' => __('', 'calliope'),
                'default' => '50'
            ),      
            array(
                'id' => 'read_more',
                'type' => 'text',
                'title' => __('Button Text For Post', 'calliope'),
                'subtitle' => __('Input Button Text', 'calliope'),
                'desc' => __('', 'calliope'),
                'default' => 'Read more'
            ),
            array(
                'id' => 'comment',
                'type' => 'select',
                'title' => __('Show Comment?', 'calliope'),
                'subtitle' => __('Option Show Comment', 'calliope'),
                'desc' => __('', 'calliope'),
                'options'  => array(
                    'yes' => 'Yes',
                    'no'  => 'No',
                ),
                'default' => 'yes',
            ),
         )
    ) );
    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-graph',
        'title' => __('404 Settings', 'calliope'),
        'fields' => array(
             array(
                'id' => '404_title',
                'type' => 'text',
                'title' => __('404 Title', 'calliope'),
                'subtitle' => __('Input 404 Title', 'calliope'),
                'desc' => __('', 'calliope'),
                'default' => '404'
            ),                              
             array(
                'id' => '404_content',
                'type' => 'editor',
                'title' => __('404 Content', 'calliope'),
                'subtitle' => __('Enter 404 Content', 'calliope'),
                'desc' => __('', 'calliope'),
                'default' => 'The page you are looking for no longer exists. Perhaps you can return back to the sites homepage see you can find what you are looking for.'
            ),      
            array(
                'id' => 'back_404',
                'type' => 'text',
                'title' => __('Button Back Home', 'calliope'),                        
                'desc' => __('Text Button Go To Home.', 'calliope'),
                'subtitle' => __('', 'calliope'),
                'default' => 'Back To Home',
            ),                  
         )
    ) );

    Redux::setSection( $opt_name, array(
        'icon' => ' el-icon-credit-card',
        'title' => __('Footer Settings', 'calliope'),
        'fields' => array(  
            
            array(
                'id' => 'footer_text',
                'type' => 'editor',
                'title' => __('Footer Text', 'calliope'),
                'subtitle' => __('Copyright Text', 'calliope'),
                'default' => 'Copyright © 2015',
            ),
            array(
                'id' => 'logo_footer',
                'type' => 'media',
                'url' => true,
                'title' => __('Logo Footer', 'calliope'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Upload your logo static.', 'calliope'),
                'subtitle' => __('Recommended size: Height: 60px and Width: 20px', 'calliope'),
                'default' => array('url' => get_template_directory_uri().'/images/logo1.png'),
            ),
        )
    ) );
    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-website',
        'title' => __('Styling Options', 'calliope'),
        'fields' => array(
            array(
                'id' => 'main-color',
                'type' => 'color',
                'title' => __('Theme Main Color', 'calliope'),
                'subtitle' => __('Pick the main color for the theme (default: #e67e22).', 'calliope'),
                'default' => '#e67e22',
                'validate' => 'color',
            ),
            array(
                'id' => 'background_footer',
                'type' => 'color',
                'title' => __('Footer Background Color', 'calliope'),
                'subtitle' => __('Pick a background color for the footer (default: #3A3C42).', 'calliope'),
                'default' => '#3A3C42',
                'validate' => 'color',
            ),
            array(
                'id' => 'color_footer',
                'type' => 'color',
                'title' => __('Footer Color', 'calliope'),
                'subtitle' => __('Pick a  color for the footer (default: #fff).', 'calliope'),
                'default' => '#fff',
                'validate' => 'color',
            ),
            array(
                'id' => 'body-font2',
                'type' => 'typography',
                'output' => array('body'),
                'title' => __('Body Font', 'calliope'),
                'subtitle' => __('Specify the body font properties.', 'calliope'),
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
                'title' => __('CSS Code', 'calliope'),
                'subtitle' => __('Paste your CSS code here.', 'calliope'),
                'mode' => 'css',
                'theme' => 'monokai',
                'desc' => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                'default' => ""
            ),
        )
    ) );

    /*
     * <--- END SECTIONS
     */