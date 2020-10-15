<?php

if (!function_exists('tt_customizer_options')):

    function tt_customizer_options() {
        global $onetheme_sidebars;

        $template_uri = get_template_directory_uri();

        $pages = array();
        $all_pages = get_pages();
        foreach ($all_pages as $page) {
            $pages[$page->ID] = $page->post_title;
        }
        $themeton_folio_link = 'http://themeforest.net/user/themeton/portfolio';
        $option = array(
            // General
            array(
                'type' => 'section',
                'id' => 'colors',
                'label' => esc_html__('General', 'onetheme'),
                'desc' => '',
                'controls' => array(
                    array(
                        'type' => 'color',
                        'id' => 'brand-color',
                        'desc' => 'site color',
                        'label' => esc_html__('Brand Color', 'onetheme'), 
                        'default' => getLessValue('brand-color')
                    ),
                    array(
                        'type' => 'color',
                        'id' => 'color-title',
                        'label' => esc_html__('Title color', 'onetheme'),
                        'default' => getLessValue('color-title'),
                        'desc' =>'Content title color option'
                    ),
                    array(
                        'type' => 'color',
                        'id' => 'color-text',
                        'label' => esc_html__('Content text color', 'onetheme'), 
                        'default' => getLessValue('color-text'),
                        'desc' =>'Content  text color option'
                    ),
                    array(
                        'type' => 'color',
                        'id' => 'content-bg-color',
                        'label' => esc_html__('Background color', 'onetheme'), 
                        'default' => getLessValue('content-bg-color'),
                        'desc' =>'Main page content background color'
                    ),
                    array(
                        'id' => 'preloader',
                        'label' => esc_html__('Preloader loading', 'onetheme'), 
                        'default' => '1',
                        'type' => 'switch',
                        'desc' =>'Disable  or enable the preloader'
                    ),
                )
            ),// end General

            // Fonts
            array(
                'type' => 'section',
                'id' => 'font',
                'label' => esc_html__('Font', 'onetheme'), 
                'desc' => '',
                'controls' => array(
                   
                    array(
                        'type' => 'font',
                        'id' => 'font-title',
                        'label' => esc_html__('Title Font normal', 'onetheme'), 
                        'default' => getLessValue('font-title'),
                        'desc' =>'Content title font option'
                    ),
                    array(
                        'type' => 'font',
                        'id' => 'font-text',
                        'label' => esc_html__('Text Font', 'onetheme'), 
                        'default' => getLessValue('font-text'),
                        'desc' =>'Content text font option'
                    ),
                    array(
                        'type' => 'font',
                        'id' => 'font-second',
                        'label' => esc_html__('Secondary Font', 'onetheme'), 
                        'default' => getLessValue('font-second'),
                        'description' => esc_html__('Some small lists and button fonts.', 'onetheme'), 
                    ),
                    array(
                        'type' => 'font',
                        'id' => 'menu-font',
                        'label' => esc_html__('Menu Font', 'onetheme'), 
                        'default' => getLessValue('menu-font'),
                        'desc' =>'Menu item font'
                    ),
                    
                )
            ),// end Fonts

            /* header */
             array(
                'type' => 'section',
                'id' => 'section_header_style',
                'label' => esc_html__('Logo and Header', 'onetheme'),
                'desc' => '',
                'controls' => array(
                    array(
                        'type' => 'image',
                        'id' => 'logo_image',
                        'label' => 'Logo Image',
                        'default' => get_template_directory_uri() ."/images/logo-2.png",
                        'desc' =>'Header logo option'
                    ),
                    array(
                        'id' => 'page_title_image',
                        'label' => 'Page title background Image',
                        'default' => get_template_directory_uri() . '/images/banner.jpg|cover|center-top|scroll',
                        'type' => 'bg_image',
                        'desc' =>'Page header main picture background option'
                    ),
                    array(
                        'id' => 'header_option_section',
                        'type' => 'sub_title',
                        'label' => 'Header Options',
                        'default' => ''
                    ),
                    array(
                        'id' => 'header_layout',
                        'label' => 'Header Layout',
                        'default' => 'header_wrapped',
                        'type' => 'select',
                        'choices' => array(
                            'header_full'         => 'Header area fullwidth',
                            'header_wrapped'     => 'Header area wrapped'
                        )
                    ),
                    array(
                        'id' => 'header_dark',
                        'label' => esc_html__('Header layout dark?', 'onetheme'), 
                        'default' => '0',
                        'type' => 'switch',
                    ),
                    array(
                        'id' => 'search_btn',
                        'label' => esc_html__('Header search button', 'onetheme'), 
                        'default' => '0',
                        'type' => 'switch',
                        'desc' =>'Disable  or enable '
                    ),
                     
                    array(
                        'id' => 'topbar_link_name',
                        'label' => 'Phone number',
                        'default' => '+ 123 456 7890',
                        'type' => 'textarea',
                    ),
                     
                    array(
                        'id' => 'topbar_link1_name',
                        'label' => 'Contact info',
                        'default' => 'info@yourcompany.com',
                        'type' => 'textarea',

                    ),
                )
            ),
            // header end
            //coming soon

             array(
                'type' => 'section',
                'id' => 'page_coming_soon',
                'label' => esc_html__('Coming Soon Options', 'onetheme'), 
                'controls' => array(
                    
                    array(
                        'id' => 'coming_coon',
                        'label' => 'Coming Soon background Image',
                        'default' => get_template_directory_uri() . '/images/banner-6.jpg',
                        'type' => 'image',
                        'desc' =>'Only coming soon page background picture option'
                    ),
                    array(
                        'type' => 'image',
                        'id' => 'logo_image_coming',
                        'label' => 'Logo Image',
                        'default' => get_template_directory_uri() ."/images/logo-3.png",
                        'desc' =>'Logo changer option'
                    ),
                    array(
                        'id' => 'coming_style',
                        'label' => 'Coming soon ',
                        'default' => 'dark-cs',
                        'type' => 'select',
                        'desc' =>'Coming soon page style option',
                        'choices' => array(
                            'light-cs' => 'Light',
                            'dark-cs' => 'Dark',
                        )
                    ),
                    array(
                        'id' => 'comming_title',
                        'label' => 'Coming Soon sub title text',
                        'default' => esc_html__('We will be here soon, stay with us', 'onetheme'),
                        'desc' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'id' => 'coming_end_date',
                        'label' => 'Coming Soon End Date',
                        'default' =>'2016/10/31',
                        'desc' => '',
                        'type' => 'date',
                        'desc' =>'Time counter option'                        
                    ),
                ),
            ), 
             //end comming coom 
            
            // Footer
           array(
                'type' => 'section',
                'id' => 'section_footer',
                'label' => 'Footer',
                'controls' => array(
                    array(
                        'id' => 'footer_style',
                        'label' => 'Footer Columns',
                        'default' => '3',
                        'type' => 'select',
                         'desc' =>'Footer column layour option',
                        'choices' => array(
                            '1' => 'Full',
                            '2' => '2 Columns',
                            '3' => '3 Columns',
                            '4' => '4 Columns',
                            '5' => '1/3 + 1/6 + 1/4 + 1/4',
                        )
                    ),
                    array(
                        'id' => 'footer-color',
                        'label' => 'Footer Text Color',
                        'default' => getLessValue('footer-color'),
                        'type' => 'color',
                         'desc' =>'Footer text color option'
                    ),
                    array(
                        'id' => 'sub-footer-bg',
                        'label' => 'Sub Footer Background Color',
                        'default' => getLessValue('sub-footer-bg'),
                        'type' => 'color',
                         'desc' =>'Sub footer background color option'
                    ),
                    // Footer Images
                    array(
                        'id' => 'footer_bg_image_section',
                        'type' => 'sub_title',
                        'label' => 'Footer top image',
                        'default' => '',
                    ),
                    array(
                        'id' => 'copyright_content',
                        'label' => 'Footer text',
                        'default' => '&copy; 2016. All rights reserved. <a href="'.esc_url($themeton_folio_link).'" target="_blank">Themeton</a>.',
                        'desc' => '',
                        'type' => 'textarea'
                    ),
                    // flicr

                    array(
                        'id' => 'footer_bg_image',
                        'label' => 'Footer Backround image',
                        'default' => get_template_directory_uri() . '/images/footer-bg.jpg|cover|center-top|scroll',
                        'type' => 'bg_image',
                         'desc' =>'Footer background picture option'
                    ),

                ),
            ), // end Footer

            // Extras
            array(
                'id' => 'panel_extra',
                'label' => esc_html__('Extras', 'onetheme'),
                'desc' => esc_html__('Export Import and Custom CSS.', 'onetheme'),
                'sections' => array(
                    // Backup
                    array(
                        'type' => 'section',
                        'id' => 'section_backup',
                        'label' => esc_html__('Export/Import', 'onetheme'), 
                        'desc' => '',
                        'controls' => array(
                            array(
                                'id' => 'backup_settings',
                                'label' => esc_html__('Export Data', 'onetheme'),
                                'desc' => esc_html__('Copy to Customizer Data', 'onetheme'),
                                'default' => '',
                                'type' => 'backup'
                            ),
                            array(
                                'id' => 'import_settings',
                                'label' => esc_html__('Import Data', 'onetheme'), 
                                'desc' => esc_html__('Import Customizer Exported Data', 'onetheme'),
                                'default' => '',
                                'type' => 'import'
                            ),
                        ),
                    ), // end backup
                    // Custom
                    array(
                        'type' => 'section',
                        'id' => 'section_custom_css',
                        'label' => esc_html__('Custom CSS', 'onetheme'), 
                        'desc' => '',
                        'controls' => array(
                            array(
                                'id' => 'custom_css',
                                'label' => esc_html__('Custom CSS (general)', 'onetheme'), 
                                'default' => '',
                                'type' => 'textarea'
                            ),
                            array(
                                'id' => 'custom_css_tablet',
                                'label' => esc_html__('Tablet CSS', 'onetheme'), 
                                'default' => '',
                                'type' => 'textarea',
                                'desc' => esc_html__('Screen width between 768px and 991px.', 'onetheme')
                            ),
                            array(
                                'id' => 'custom_css_widephone',
                                'label' => esc_html__('Wide Phone CSS', 'onetheme'), 
                                'default' => '',
                                'type' => 'textarea',
                                'desc' => esc_html__('Screen width between 481px and 767px. Ex: iPhone landscape.', 'onetheme')
                            ),
                            array(
                                'id' => 'custom_css_phone',
                                'label' => esc_html__('Phone CSS', 'onetheme'),
                                'default' => '',
                                'type' => 'textarea',
                                'desc' => esc_html__('Screen width up to 480px. Ex: iPhone portrait.', 'onetheme')
                            ),
                        )
                    ) // end Custom
                )
            ) // end Extras
        );

        return $option;
    }
endif;
function tt_theme_customize_setup(){
    // create instance of TT Theme Customizer
    new TT_Theme_Customizer();
}
add_action( 'after_setup_theme', 'tt_theme_customize_setup' );
