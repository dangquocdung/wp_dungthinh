<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if (!class_exists('Studylms_Redux_Framework_Config')) {

    class Studylms_Redux_Framework_Config
    {
        public $args = array();
        public $sections = array();
        public $ReduxFramework;

        public function __construct()
        {
            if (!class_exists('ReduxFramework')) {
                return;
            }
            add_action('init', array($this, 'initSettings'), 10);
        }

        public function initSettings()
        {
            // Set the default arguments
            $this->setArguments();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        public function setSections()
        {
            global $wp_registered_sidebars;
            $sidebars = array();

            if ( !empty($wp_registered_sidebars) ) {
                foreach ($wp_registered_sidebars as $sidebar) {
                    $sidebars[$sidebar['id']] = $sidebar['name'];
                }
            }
            $columns = array( '1' => esc_html__('1 Column', 'studylms'),
                '2' => esc_html__('2 Columns', 'studylms'),
                '3' => esc_html__('3 Columns', 'studylms'),
                '4' => esc_html__('4 Columns', 'studylms'),
                '5' => esc_html__('5 Columns', 'studylms'),
                '6' => esc_html__('6 Columns', 'studylms')
            );
            
            $general_fields = array();
            if ( !function_exists( 'wp_site_icon' ) ) {
                $general_fields[] = array(
                    'id' => 'media-favicon',
                    'type' => 'media',
                    'title' => esc_html__('Favicon Upload', 'studylms'),
                    'desc' => esc_html__('', 'studylms'),
                    'subtitle' => esc_html__('Upload a 16px x 16px .png or .gif image that will be your favicon.', 'studylms'),
                );
            }
            $general_fields[] = array(
                'id' => 'preload',
                'type' => 'switch',
                'title' => esc_html__('Preload Website', 'studylms'),
                'default' => true,
            );
            $general_fields[] = array(
                'id' => 'image_lazy_loading',
                'type' => 'switch',
                'title' => esc_html__('Image Lazy Loading', 'studylms'),
                'default' => true,
            );
            $general_fields[] = array(
                'id' => 'google_map_api_key',
                'type' => 'text',
                'title' => esc_html__('Google Maps API Key', 'studylms'),
                'default' => '',
            );
            // General Settings Tab
            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => esc_html__('General', 'studylms'),
                'fields' => $general_fields
            );
            // Header
            $this->sections[] = array(
                'icon' => 'el el-website',
                'title' => esc_html__('Header', 'studylms'),
                'fields' => array(
                    array(
                        'id' => 'media-logo',
                        'type' => 'media',
                        'title' => esc_html__('Logo Upload', 'studylms'),
                        'subtitle' => esc_html__('Upload a .png or .gif image that will be your logo.', 'studylms'),
                    ),
                    array(
                        'id' => 'media-mobile-logo',
                        'type' => 'media',
                        'title' => esc_html__('Mobile Logo Upload', 'studylms'),
                        'subtitle' => esc_html__('Upload a .png or .gif image that will be your logo.', 'studylms'),
                    ),
                    array(
                        'id' => 'header_type',
                        'type' => 'select',
                        'title' => esc_html__('Header Layout Type', 'studylms'),
                        'subtitle' => esc_html__('Choose a header for your website.', 'studylms'),
                        'options' => studylms_get_header_layouts()
                    ),
                    array(
                        'id' => 'keep_header',
                        'type' => 'switch',
                        'title' => esc_html__('Keep Header When Scroll Mouse', 'studylms'),
                        'default' => false
                    ),
                    array(
                        'id' => 'show_woo_cart',
                        'type' => 'switch',
                        'title' => esc_html__('Show Woocommerce Cart', 'studylms'),
                        'default' => false
                    ),
                    array(
                        'id' => 'top_contact_info_v1',
                        'type' => 'editor',
                        'title' => esc_html__('Top Contact Information', 'studylms'),
                        'required' => array('header_type', '=', array('v1', 'v2'))
                    ),
                    array(
                        'id' => 'top_slogan',
                        'type' => 'editor',
                        'title' => esc_html__('Top Slogan', 'studylms'),
                        'required' => array('header_type', '=', array('v3'))
                    ),
                    array(
                        'id' => 'top_contact_info_v3',
                        'type' => 'editor',
                        'title' => esc_html__('Top Contact Information', 'studylms'),
                        'required' => array('header_type', '=', array('v3'))
                    ),
                )
            );
            
            // Footer
            $this->sections[] = array(
                'icon' => 'el el-website',
                'title' => esc_html__('Footer', 'studylms'),
                'fields' => array(
                    array(
                        'id' => 'footer_type',
                        'type' => 'select',
                        'title' => esc_html__('Footer Layout Type', 'studylms'),
                        'subtitle' => esc_html__('Choose a footer for your website.', 'studylms'),
                        'options' => studylms_get_footer_layouts()
                    ),
                    array(
                        'id' => 'back_to_top',
                        'type' => 'switch',
                        'title' => esc_html__('Back To Top Button', 'studylms'),
                        'subtitle' => esc_html__('Toggle whether or not to enable a back to top button on your pages.', 'studylms'),
                        'default' => true,
                    ),
                )
            );

            // Blog settings
            $this->sections[] = array(
                'icon' => 'el el-pencil',
                'title' => esc_html__('Blog', 'studylms'),
                'fields' => array(
                    array(
                        'id' => 'show_blog_breadcrumbs',
                        'type' => 'switch',
                        'title' => esc_html__('Breadcrumbs', 'studylms'),
                        'default' => 1
                    ),
                    array (
                        'title' => esc_html__('Breadcrumbs Background Color', 'studylms'),
                        'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'studylms').'</em>',
                        'id' => 'blog_breadcrumb_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'blog_breadcrumb_image',
                        'type' => 'media',
                        'title' => esc_html__('Breadcrumbs Background', 'studylms'),
                        'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'studylms'),
                    ),
                )
            );
            // Archive Blogs settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Blog & Post Archives', 'studylms'),
                'fields' => array(
                    array(
                        'id' => 'blog_archive_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'studylms'),
                        'subtitle' => esc_html__('Select the variation you want to apply on your store.', 'studylms'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Only', 'studylms'),
                                'alt' => esc_html__('Main Only', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left - Main Sidebar', 'studylms'),
                                'alt' => esc_html__('Left - Main Sidebar', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main - Right Sidebar', 'studylms'),
                                'alt' => esc_html__('Main - Right Sidebar', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left - Main - Right Sidebar', 'studylms'),
                                'alt' => esc_html__('Left - Main - Right Sidebar', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'blog_archive_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'studylms'),
                        'default' => false
                    ),
                    array(
                        'id' => 'blog_archive_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Left Sidebar', 'studylms'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'studylms'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'blog_archive_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Right Sidebar', 'studylms'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'studylms'),
                        'options' => $sidebars
                        
                    ),
                    array(
                        'id' => 'blog_display_mode',
                        'type' => 'select',
                        'title' => esc_html__('Display Mode', 'studylms'),
                        'options' => array(
                            'grid' => esc_html__('Grid Layout', 'studylms'),
                            'mansory' => esc_html__('Mansory Layout', 'studylms'),
                            'list' => esc_html__('List Layout', 'studylms'),
                            'chess' => esc_html__('Chess Layout', 'studylms'),
                            'timeline' => esc_html__('Timeline Layout', 'studylms'),
                        ),
                        'default' => 'grid'
                    ),
                    array(
                        'id' => 'blog_columns',
                        'type' => 'select',
                        'title' => esc_html__('Blog Columns', 'studylms'),
                        'options' => $columns,
                        'default' => 4
                    ),
                    array(
                        'id' => 'blog_item_style',
                        'type' => 'select',
                        'title' => esc_html__('Blog Item Style', 'studylms'),
                        'options' => array(
                            'grid' => esc_html__('Grid 1', 'studylms'),
                            'grid-v3' => esc_html__('Grid 2', 'studylms'),
                            'list' => esc_html__('List', 'studylms')
                        ),
                        'default' => 'grid'
                    ),
                    array(
                        'id' => 'blog_item_thumbsize',
                        'type' => 'text',
                        'title' => esc_html__('Thumbnail Size', 'studylms'),
                        'desc' => esc_html__('Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme.', 'studylms'),
                    ),

                )
            );
            // Single Blogs settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Blog', 'studylms'),
                'fields' => array(
                    
                    array(
                        'id' => 'blog_single_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'studylms'),
                        'subtitle' => esc_html__('Select the variation you want to apply on your store.', 'studylms'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Only', 'studylms'),
                                'alt' => esc_html__('Main Only', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left - Main Sidebar', 'studylms'),
                                'alt' => esc_html__('Left - Main Sidebar', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main - Right Sidebar', 'studylms'),
                                'alt' => esc_html__('Main - Right Sidebar', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left - Main - Right Sidebar', 'studylms'),
                                'alt' => esc_html__('Left - Main - Right Sidebar', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'blog_single_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'studylms'),
                        'default' => false
                    ),
                    array(
                        'id' => 'blog_single_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Blog Left Sidebar', 'studylms'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'studylms'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'blog_single_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Blog Right Sidebar', 'studylms'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'studylms'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'show_blog_social_share',
                        'type' => 'switch',
                        'title' => esc_html__('Show Social Share', 'studylms'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_blog_releated',
                        'type' => 'switch',
                        'title' => esc_html__('Show Releated Posts', 'studylms'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'number_blog_releated',
                        'type' => 'text',
                        'title' => esc_html__('Number of related posts to show', 'studylms'),
                        'required' => array('show_blog_releated', '=', '1'),
                        'default' => 4,
                        'min' => '1',
                        'step' => '1',
                        'max' => '20',
                        'type' => 'slider'
                    ),
                    array(
                        'id' => 'releated_blog_columns',
                        'type' => 'select',
                        'title' => esc_html__('Releated Blogs Columns', 'studylms'),
                        'required' => array('show_blog_releated', '=', '1'),
                        'options' => $columns,
                        'default' => 4
                    ),

                )
            );
            // Woocommerce
            $this->sections[] = array(
                'icon' => 'el el-shopping-cart',
                'title' => esc_html__('Woocommerce', 'studylms'),
                'fields' => array(
                    array(
                        'id' => 'show_product_breadcrumbs',
                        'type' => 'switch',
                        'title' => esc_html__('Breadcrumbs', 'studylms'),
                        'default' => 1
                    ),
                    array (
                        'title' => esc_html__('Breadcrumbs Background Color', 'studylms'),
                        'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'studylms').'</em>',
                        'id' => 'woo_breadcrumb_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'woo_breadcrumb_image',
                        'type' => 'media',
                        'title' => esc_html__('Breadcrumbs Background', 'studylms'),
                        'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'studylms'),
                    )
                )
            );
            // Archive settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Product Archives', 'studylms'),
                'fields' => array(
                    array(
                        'id' => 'product_archive_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'studylms'),
                        'subtitle' => esc_html__('Select the layout you want to apply on your archive product page.', 'studylms'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Content', 'studylms'),
                                'alt' => esc_html__('Main Content', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left Sidebar - Main Content', 'studylms'),
                                'alt' => esc_html__('Left Sidebar - Main Content', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main Content - Right Sidebar', 'studylms'),
                                'alt' => esc_html__('Main Content - Right Sidebar', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left Sidebar - Main Content - Right Sidebar', 'studylms'),
                                'alt' => esc_html__('Left Sidebar - Main Content - Right Sidebar', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'product_archive_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'studylms'),
                        'default' => false
                    ),
                    array(
                        'id' => 'product_archive_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Left Sidebar', 'studylms'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'studylms'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'product_archive_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Right Sidebar', 'studylms'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'studylms'),
                        'options' => $sidebars
                    ),
                    // array(
                    //     'id' => 'product_display_mode',
                    //     'type' => 'select',
                    //     'title' => esc_html__('Display Mode', 'studylms'),
                    //     'subtitle' => esc_html__('Choose a default layout archive product.', 'studylms'),
                    //     'options' => array('grid' => esc_html__('Grid', 'studylms'), 'list' => esc_html__('List', 'studylms')),
                    //     'default' => 'grid'
                    // ),
                    array(
                        'id' => 'number_products_per_page',
                        'type' => 'text',
                        'title' => esc_html__('Number of Products Per Page', 'studylms'),
                        'default' => 12,
                        'min' => '1',
                        'step' => '1',
                        'max' => '100',
                        'type' => 'slider'
                    ),
                    array(
                        'id' => 'product_columns',
                        'type' => 'select',
                        'title' => esc_html__('Product Columns', 'studylms'),
                        'options' => $columns,
                        'default' => 4
                    ),
                    array(
                        'id' => 'show_quickview',
                        'type' => 'switch',
                        'title' => esc_html__('Show Quick View', 'studylms'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_swap_image',
                        'type' => 'switch',
                        'title' => esc_html__('Show Second Image (Hover)', 'studylms'),
                        'default' => 1
                    ),
                )
            );
            // Product Page
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Single Product', 'studylms'),
                'fields' => array(
                    array(
                        'id' => 'product_single_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'studylms'),
                        'subtitle' => esc_html__('Select the layout you want to apply on your Single Product Page.', 'studylms'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Only', 'studylms'),
                                'alt' => esc_html__('Main Only', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left - Main Sidebar', 'studylms'),
                                'alt' => esc_html__('Left - Main Sidebar', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main - Right Sidebar', 'studylms'),
                                'alt' => esc_html__('Main - Right Sidebar', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left - Main - Right Sidebar', 'studylms'),
                                'alt' => esc_html__('Left - Main - Right Sidebar', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'product_single_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'studylms'),
                        'default' => false
                    ),
                    array(
                        'id' => 'product_single_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Product Left Sidebar', 'studylms'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'studylms'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'product_single_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Product Right Sidebar', 'studylms'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'studylms'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'show_product_social_share',
                        'type' => 'switch',
                        'title' => esc_html__('Show Social Share', 'studylms'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_product_review_tab',
                        'type' => 'switch',
                        'title' => esc_html__('Show Product Review Tab', 'studylms'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_product_releated',
                        'type' => 'switch',
                        'title' => esc_html__('Show Products Releated', 'studylms'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_product_upsells',
                        'type' => 'switch',
                        'title' => esc_html__('Show Products upsells', 'studylms'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'number_product_releated',
                        'title' => esc_html__('Number of related/upsells products to show', 'studylms'),
                        'default' => 4,
                        'min' => '1',
                        'step' => '1',
                        'max' => '20',
                        'type' => 'slider'
                    ),
                    array(
                        'id' => 'releated_product_columns',
                        'type' => 'select',
                        'title' => esc_html__('Releated Products Columns', 'studylms'),
                        'options' => $columns,
                        'default' => 4
                    )
                )
            );
            
            // Course
            $pages = array();
            if ( is_admin() ) {
                $args = array(
                    'sort_order' => 'asc',
                    'sort_column' => 'post_title',
                    'number' => '',
                    'post_type' => 'page',
                    'post_status' => 'publish'
                ); 
                $allpages = get_pages($args);
                if ( !empty($allpages) ) {
                    foreach ($allpages as $page) {
                        $pages[$page->post_name] = $page->post_title;
                    }
                }
            }
            $this->sections[] = array(
                'icon' => 'el el-pencil',
                'title' => esc_html__('Course', 'studylms'),
                'fields' => array(
                    array(
                        'id' => 'show_course_breadcrumbs',
                        'type' => 'switch',
                        'title' => esc_html__('Breadcrumbs', 'studylms'),
                        'default' => 1
                    ),
                    array (
                        'title' => esc_html__('Breadcrumbs Background Color', 'studylms'),
                        'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'studylms').'</em>',
                        'id' => 'course_breadcrumb_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'course_breadcrumb_image',
                        'type' => 'media',
                        'title' => esc_html__('Breadcrumbs Background', 'studylms'),
                        'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'studylms'),
                    ),
                    array (
                        'id' => 'course_bookmark_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;"> '.esc_html__('Course Bookmark Settings', 'studylms').'</h3>',
                    ),
                    array(
                        'id' => 'enable_course_bookmark',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Course Bookmark?', 'studylms'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'course_bookmark_page_slug',
                        'type' => 'select',
                        'title' => esc_html__('Bookmark Page', 'studylms'),
                        'options' => $pages,
                        'required' => array('enable_course_bookmark', 'equals', 1),
                    ),
                )
            );
            // Course Archive settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Course Archives', 'studylms'),
                'fields' => array(
                    array(
                        'id' => 'course_archive_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'studylms'),
                        'subtitle' => esc_html__('Select the layout you want to apply on your archive course page.', 'studylms'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Content', 'studylms'),
                                'alt' => esc_html__('Main Content', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left Sidebar - Main Content', 'studylms'),
                                'alt' => esc_html__('Left Sidebar - Main Content', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main Content - Right Sidebar', 'studylms'),
                                'alt' => esc_html__('Main Content - Right Sidebar', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left Sidebar - Main Content - Right Sidebar', 'studylms'),
                                'alt' => esc_html__('Left Sidebar - Main Content - Right Sidebar', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'course_archive_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'studylms'),
                        'default' => false
                    ),
                    array(
                        'id' => 'course_archive_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Left Sidebar', 'studylms'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'studylms'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'course_archive_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Right Sidebar', 'studylms'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'studylms'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'course_archive_display_mode',
                        'type' => 'select',
                        'title' => esc_html__('Display Mode', 'studylms'),
                        'options' => array(
                            'grid' => esc_html__('Grid', 'studylms'),
                            'list' => esc_html__('List', 'studylms'),
                        ),
                        'default' => 'grid'
                    ),
                    array(
                        'id' => 'number_courses_per_page',
                        'type' => 'text',
                        'title' => esc_html__('Number of Courses Per Page', 'studylms'),
                        'default' => 12,
                        'min' => '1',
                        'step' => '1',
                        'max' => '100',
                        'type' => 'slider'
                    ),
                    array(
                        'id' => 'course_columns',
                        'type' => 'select',
                        'title' => esc_html__('Course Columns', 'studylms'),
                        'options' => $columns,
                        'default' => 4
                    ),
                )
            );
            // Course Page
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Single Course', 'studylms'),
                'fields' => array(
                    array(
                        'id' => 'course_single_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'studylms'),
                        'subtitle' => esc_html__('Select the layout you want to apply on your Single Course Page.', 'studylms'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Only', 'studylms'),
                                'alt' => esc_html__('Main Only', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left - Main Sidebar', 'studylms'),
                                'alt' => esc_html__('Left - Main Sidebar', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main - Right Sidebar', 'studylms'),
                                'alt' => esc_html__('Main - Right Sidebar', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left - Main - Right Sidebar', 'studylms'),
                                'alt' => esc_html__('Left - Main - Right Sidebar', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'course_single_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'studylms'),
                        'default' => false
                    ),
                    array(
                        'id' => 'course_single_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Course Left Sidebar', 'studylms'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'studylms'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'course_single_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Course Right Sidebar', 'studylms'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'studylms'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'show_course_social_share',
                        'type' => 'switch',
                        'title' => esc_html__('Show Social Share', 'studylms'),
                        'default' => 1
                    ),
                )
            );
            // Lecturer
            $this->sections[] = array(
                'icon' => 'el el-pencil',
                'title' => esc_html__('Lecturer Profile', 'studylms'),
                'fields' => array(
                    array(
                        'id' => 'show_lecturer_breadcrumbs',
                        'type' => 'switch',
                        'title' => esc_html__('Breadcrumbs', 'studylms'),
                        'default' => 1
                    ),
                    array (
                        'title' => esc_html__('Breadcrumbs Background Color', 'studylms'),
                        'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'studylms').'</em>',
                        'id' => 'lecturer_breadcrumb_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'lecturer_breadcrumb_image',
                        'type' => 'media',
                        'title' => esc_html__('Breadcrumbs Background', 'studylms'),
                        'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'studylms'),
                    ),

                    array(
                        'id' => 'lecturer_profile_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Single Lecturer Layout', 'studylms'),
                        'subtitle' => esc_html__('Select the layout you want to apply on your Single Lecturer Page.', 'studylms'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Only', 'studylms'),
                                'alt' => esc_html__('Main Only', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left - Main Sidebar', 'studylms'),
                                'alt' => esc_html__('Left - Main Sidebar', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main - Right Sidebar', 'studylms'),
                                'alt' => esc_html__('Main - Right Sidebar', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left - Main - Right Sidebar', 'studylms'),
                                'alt' => esc_html__('Left - Main - Right Sidebar', 'studylms'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'lecturer_profile_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'studylms'),
                        'default' => false
                    ),
                    array(
                        'id' => 'lecturer_profile_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Lecturer Left Sidebar', 'studylms'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'studylms'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'lecturer_profile_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Lecturer Right Sidebar', 'studylms'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'studylms'),
                        'options' => $sidebars
                    ),
                )
            );

            // Event
            $this->sections[] = array(
                'icon' => 'el el-pencil',
                'title' => esc_html__('Event', 'studylms'),
                'fields' => array(
                    array(
                        'id' => 'show_event_breadcrumbs',
                        'type' => 'switch',
                        'title' => esc_html__('Breadcrumbs', 'studylms'),
                        'default' => 1
                    ),
                    array (
                        'title' => esc_html__('Breadcrumbs Background Color', 'studylms'),
                        'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'studylms').'</em>',
                        'id' => 'event_breadcrumb_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'event_breadcrumb_image',
                        'type' => 'media',
                        'title' => esc_html__('Breadcrumbs Background', 'studylms'),
                        'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'studylms'),
                    ),
                )
            );
            // Archive Event Settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Event Archives', 'studylms'),
                'fields' => array(
                    array(
                        'id' => 'event_archive_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Archive Event Layout', 'studylms'),
                        'subtitle' => esc_html__('Select the layout you want to apply on your archive event page.', 'studylms'),
                        'options' => array(
                            'main' => array(
                                'title' => 'Main Content',
                                'alt' => 'Main Content',
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => 'Left Sidebar - Main Content',
                                'alt' => 'Left Sidebar - Main Content',
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => 'Main Content - Right Sidebar',
                                'alt' => 'Main Content - Right Sidebar',
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => 'Left Sidebar - Main Content - Right Sidebar',
                                'alt' => 'Left Sidebar - Main Content - Right Sidebar',
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'event_archive_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'studylms'),
                        'default' => false
                    ),
                    array(
                        'id' => 'event_archive_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Left Sidebar', 'studylms'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'studylms'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'event_archive_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Right Sidebar', 'studylms'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'studylms'),
                        'options' => $sidebars
                    ),
                    // array(
                    //     'id' => 'event_archive_display_mode',
                    //     'type' => 'select',
                    //     'title' => esc_html__('Display Mode', 'studylms'),
                    //     'options' => array(
                    //         'grid' => esc_html__('Grid', 'studylms'),
                    //         'list' => esc_html__('List', 'studylms'),
                    //     ),
                    //     'default' => 'grid'
                    // ),
                    // array(
                    //     'id' => 'event_archive_columns',
                    //     'type' => 'select',
                    //     'title' => esc_html__('Events Columns', 'studylms'),
                    //     'options' => $columns,
                    //     'default' => 3,
                    //     'required' => array('event_archive_display_mode', 'equals', 'grid'),
                    // ),
                )
            );
            // Event Detail Page
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Single Event', 'studylms'),
                'fields' => array(
                    array(
                        'id' => 'event_single_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Single Event Layout', 'studylms'),
                        'subtitle' => esc_html__('Select the layout you want to apply on your Single Event Page.', 'studylms'),
                        'options' => array(
                            'main' => array(
                                'title' => 'Main Only',
                                'alt' => 'Main Only',
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => 'Left - Main Sidebar',
                                'alt' => 'Left - Main Sidebar',
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => 'Main - Right Sidebar',
                                'alt' => 'Main - Right Sidebar',
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => 'Left - Main - Right Sidebar',
                                'alt' => 'Left - Main - Right Sidebar',
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'event_single_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'studylms'),
                        'default' => false
                    ),
                    array(
                        'id' => 'event_single_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Event Left Sidebar', 'studylms'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'studylms'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'event_single_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Event Right Sidebar', 'studylms'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'studylms'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'show_event_social_share',
                        'type' => 'switch',
                        'title' => esc_html__('Show Social Share', 'studylms'),
                        'default' => 1
                    ),
                )
            );
            // 404 Page
            $this->sections[] = array(
                'icon' => 'el el-pencil',
                'title' => esc_html__('404 Page', 'studylms'),
                'fields' => array(
                    array(
                        'id' => '404_title',
                        'type' => 'text',
                        'title' => esc_html__('Title', 'studylms'),
                        'default' => 'Page not found'
                    ),
                    array(
                        'id' => '404_description',
                        'type' => 'textarea',
                        'title' => esc_html__('Desciption', 'studylms'),
                        'default' => 'We are sorry, but we can not find the page you were looking for'
                    ),
                )
            );
            // Style
            $this->sections[] = array(
                'icon' => 'el el-icon-css',
                'title' => esc_html__('Style', 'studylms'),
                'fields' => array(
                    array (
                        'id' => 'main_font_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;"> '.esc_html__('Content', 'studylms').'</h3>',
                    ),
                    array (
                        'title' => esc_html__('Main Theme Color', 'studylms'),
                        'subtitle' => esc_html__('The main color of the site.', 'studylms'),
                        'id' => 'main_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array (
                        'title' => esc_html__('Second Theme Color', 'studylms'),
                        'subtitle' => esc_html__('The Second color of the site.', 'studylms'),
                        'id' => 'second_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array (
                        'title' => esc_html__('Button Theme Background Color', 'studylms'),
                        'subtitle' => esc_html__('The Button color of the site.', 'studylms'),
                        'id' => 'button_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array (
                        'title' => esc_html__('Button Theme Background Hover Color', 'studylms'),
                        'subtitle' => esc_html__('The Button color of the site.', 'studylms'),
                        'id' => 'button_hover_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array (
                        'id' => 'site_background',
                        'type' => 'background',
                        'title' => esc_html__('Site Background', 'studylms'),
                        'output' => 'body'
                    ),
                    array (
                        'id' => 'container_bg',
                        'type' => 'color_rgba',
                        'title' => esc_html__('Container Background Color', 'studylms'),
                        'output' => array(
                            'background-color' =>'#apus-main-content,.wrapper-shop,.single-product .wrapper-shop, .detail-post #comments::before,.detail-post #comments::after,.detail-post #comments
                            .widget.upsells::before, .widget.upsells::after, .widget.related::before, .widget.related::after,.widget.related
                            '
                        )
                    ),
                    array (
                        'id' => 'forms_inputs_bg',
                        'type' => 'color_rgba',
                        'title' => esc_html__('Forms inputs Color', 'studylms'),
                        'output' => array(
                            'background-color' =>'.form-control, select, input[type="text"], input[type="email"], input[type="password"], input[type="tel"], textarea, textarea.form-control'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Typography', 'studylms'),
                'fields' => array(
                    
                    array (
                        'id' => 'main_font_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;"> '.esc_html__('Body Font', 'studylms').'</h3>',
                    ),
                    // Standard + Google Webfonts
                    array (
                        'title' => esc_html__('Font Face', 'studylms'),
                        'subtitle' => '<em>'.esc_html__('Pick the Main Font for your site.', 'studylms').'</em>',
                        'id' => 'main_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true
                    ),
                    array (
                        'title' => esc_html__('Font Face Second', 'studylms'),
                        'subtitle' => '<em>'.esc_html__('Pick the Second Font for your site( Heading).', 'studylms').'</em>',
                        'id' => 'second_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true
                    ),
                    
                    // Header
                    array (
                        'id' => 'secondary_font_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;"> '.esc_html__('Heading', 'studylms').'</h3>',
                    ),
                    array (
                        'title' => esc_html__('H1 Font', 'studylms'),
                        'subtitle' => '<em>'.esc_html__('Pick the H1 Font for your site.', 'studylms').'</em>',
                        'id' => 'h1_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true
                    ),
                    array (
                        'title' => esc_html__('H2 Font', 'studylms'),
                        'subtitle' => '<em>'.esc_html__('Pick the H2 Font for your site.', 'studylms').'</em>',
                        'id' => 'h2_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true
                    ),
                    array (
                        'title' => esc_html__('H3 Font', 'studylms'),
                        'subtitle' => '<em>'.esc_html__('Pick the H3 Font for your site.', 'studylms').'</em>',
                        'id' => 'h3_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true
                    ),
                    array (
                        'title' => esc_html__('H4 Font', 'studylms'),
                        'subtitle' => '<em>'.esc_html__('Pick the H4 Font for your site.', 'studylms').'</em>',
                        'id' => 'h4_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true
                    ),
                    array (
                        'title' => esc_html__('H5 Font', 'studylms'),
                        'subtitle' => '<em>'.esc_html__('Pick the H5 Font for your site.', 'studylms').'</em>',
                        'id' => 'h5_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true
                    ),
                    array (
                        'title' => esc_html__('H6 Font', 'studylms'),
                        'subtitle' => '<em>'.esc_html__('Pick the H6 Font for your site.', 'studylms').'</em>',
                        'id' => 'h6_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Top Bar', 'studylms'),
                'fields' => array(
                    array(
                        'id'=>'topbar_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'studylms'),
                        'output' => '#apus-topbar'
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'studylms'),
                        'id' => 'topbar_text_color',
                        'type' => 'color_rgba',
                        'output' => array(
                            'color' =>'#apus-topbar'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'studylms'),
                        'id' => 'topbar_link_color',
                        'type' => 'color_rgba',
                        'output' => array(
                            'color' =>'#apus-topbar a'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color When Hover', 'studylms'),
                        'id' => 'topbar_link_color_hover',
                        'type' => 'color_rgba',
                        'output' => array(
                            'color' =>'#apus-topbar a:hover,#apus-topbar a:active'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Header', 'studylms'),
                'fields' => array(
                    array(
                        'id'=>'header_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'studylms'),
                        'output' => '.header-v3 .headerbottom,.header-v3 .sticky-header,.header-v2 .sticky-header,.header-v2,.header-v1 .sticky-header'
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'studylms'),
                        'id' => 'header_text_color',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'#apus-header'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'studylms'),
                        'id' => 'header_link_color',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'#apus-header a'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color Active', 'studylms'),
                        'id' => 'header_link_color_active',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'#apus-header .active > a, #apus-header a:active, #apus-header a:hover'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Main Menu', 'studylms'),
                'fields' => array(
                    array(
                        'title' => esc_html__('Link Color', 'studylms'),
                        'id' => 'main_menu_link_color',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'#apus-header .navbar-nav.megamenu > li > a'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color Active', 'studylms'),
                        'id' => 'main_menu_link_color_active',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'#apus-header .navbar-nav.megamenu > li.active > a,#apus-header .navbar-nav.megamenu > li:hover > a,#apus-header .navbar-nav.megamenu > li:active > a'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Footer', 'studylms'),
                'fields' => array(
                    array(
                        'id'=>'footer_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'studylms'),
                        'output' => '.apus-footer'
                    ),
                    array(
                        'title' => esc_html__('Heading Color', 'studylms'),
                        'id' => 'footer_heading_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '#apus-footer .widgettitle ,#apus-footer .widget-title'
                        )
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'studylms'),
                        'id' => 'footer_text_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '#apus-footer, .apus-footer .contact-info, .apus-copyright'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'studylms'),
                        'id' => 'footer_link_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '#apus-footer a'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color Hover', 'studylms'),
                        'id' => 'footer_link_color_hover',
                        'type' => 'color',
                        'output' => array(
                            'color' => '#apus-footer a:hover,#apus-footer a:active'
                        )
                    ),
                )
            );
            
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Copyright', 'studylms'),
                'fields' => array(
                    array(
                        'id'=>'copyright_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'studylms'),
                        'output' => '.apus-copyright'
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'studylms'),
                        'id' => 'copyright_text_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '.apus-copyright'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'studylms'),
                        'id' => 'copyright_link_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '.apus-copyright a, .apus-copyright a i'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color Hover', 'studylms'),
                        'id' => 'copyright_link_color_hover',
                        'type' => 'color',
                        'output' => array(
                            'color' => '.apus-copyright a:hover .apus-copyright a i:hover'
                        )
                    ),
                )
            );

            // Social Media
            $this->sections[] = array(
                'icon' => 'el el-file',
                'title' => esc_html__('Social Media', 'studylms'),
                'fields' => array(
                    array(
                        'id' => 'facebook_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Facebook Share', 'studylms'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'twitter_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable twitter Share', 'studylms'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'linkedin_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable linkedin Share', 'studylms'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'tumblr_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable tumblr Share', 'studylms'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'google_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable google plus Share', 'studylms'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'pinterest_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable pinterest Share', 'studylms'),
                        'default' => 1
                    )
                )
            );
            // Custom Code
            $this->sections[] = array(
                'icon' => 'el-icon-css',
                'title' => esc_html__('Custom CSS/JS', 'studylms'),
                'fields' => array(
                    array (
                        'title' => esc_html__('Custom CSS', 'studylms'),
                        'subtitle' => esc_html__('Paste your custom CSS code here.', 'studylms'),
                        'id' => 'custom_css',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                    ),
                    
                    array (
                        'title' => esc_html__('Header JavaScript Code', 'studylms'),
                        'subtitle' => esc_html__('Paste your custom JS code here. The code will be added to the header of your site.', 'studylms'),
                        'id' => 'header_js',
                        'type' => 'ace_editor',
                        'mode' => 'javascript',
                    ),
                    
                    array (
                        'title' => esc_html__('Footer JavaScript Code', 'studylms'),
                        'subtitle' => esc_html__('Here is the place to paste your Google Analytics code or any other JS code you might want to add to be loaded in the footer of your website.', 'studylms'),
                        'id' => 'footer_js',
                        'type' => 'ace_editor',
                        'mode' => 'javascript',
                    ),
                )
            );
            $this->sections[] = array(
                'title' => esc_html__('Import / Export', 'studylms'),
                'desc' => esc_html__('Import and Export your Redux Framework settings from file, text or URL.', 'studylms'),
                'icon' => 'el-icon-refresh',
                'fields' => array(
                    array(
                        'id' => 'opt-import-export',
                        'type' => 'import_export',
                        'title' => esc_html__('Import Export', 'studylms'),
                        'subtitle' => esc_html__('Save and restore your Redux options', 'studylms'),
                        'full_width' => false,
                    ),
                ),
            );

            $this->sections[] = array(
                'type' => 'divide',
            );
        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments()
        {
            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $preset = studylms_get_demo_preset();
            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'studylms_theme_options'.$preset,
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'),
                // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'),
                // Version that appears at the top of your panel
                'menu_type' => 'menu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true,
                // Show the sections below the admin menu item or not
                'menu_title' => esc_html__('Theme Options', 'studylms'),
                'page_title' => esc_html__('Theme Options', 'studylms'),

                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '',
                // Set it you want google fonts to update weekly. A google_api_key value is required.
                'google_update_weekly' => false,
                // Must be defined to add google fonts to the typography module
                'async_typography' => true,
                // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar' => true,
                // Show the panel pages on the admin bar
                'admin_bar_icon' => 'dashicons-portfolio',
                // Choose an icon for the admin bar menu
                'admin_bar_priority' => 50,
                // Choose an priority for the admin bar menu
                'global_variable' => 'studylms_options',
                // Set a different name for your global variable other than the opt_name
                'dev_mode' => false,
                // Show the time the page took to load, etc
                'update_notice' => true,
                // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                'customizer' => true,
                // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority' => null,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon' => '',
                // Specify a custom URL to an icon
                'last_tab' => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options',
                // Page slug used to denote the panel
                'save_defaults' => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show' => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,
                // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info' => false,
                // REMOVE
                'use_cdn' => true
            );

            return $this->args;
        }

    }

    global $reduxConfig;
    $reduxConfig = new Studylms_Redux_Framework_Config();
}