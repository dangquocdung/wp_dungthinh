<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('digitech_Theme_Config')) {

    class digitech_Theme_Config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => esc_html__('Section via hook', 'digitech'),
                'desc' => esc_html__('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'digitech'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'digitech'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'digitech'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'digitech'); ?>" />
                <?php endif; ?>

                <h4><?php echo ''.$this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'digitech'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'digitech'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' .__('Tags', 'digitech') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo ''.$this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' .__('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'digitech') . '</p>',__('http://codex.wordpress.org/Child_Themes', 'digitech'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            
            // General
            $this->sections[] = array(
                'title'     => esc_html__('General', 'digitech'),
                'desc'      => esc_html__('General theme options', 'digitech'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(
                    array(
                        'id'        => 'background_opt',
                        'type'      => 'background',
                        'output'    => array('body'),
                        'title'     => esc_html__('Body background', 'digitech'),
                        'subtitle'  => esc_html__('Upload image or select color. Only work with box layout', 'digitech'),
                        'default'   => array('background-color' => '#e8e8e8'),
                    ),
                    array(
                        'id'        => 'page_content_background',
                        'type'      => 'background',
                        'output'    => array('.page-wrapper'),
                        'title'     => esc_html__('Page content background', 'digitech'),
                        'subtitle'  => esc_html__('Select background for page content (default: #ffffff).', 'digitech'),
                        'default'   => array('background-color' => '#ffffff'),
                    ),
                    array( 
                        'id'       => 'border_color',
                        'type'     => 'border',
                        'title'    => esc_html__('Border Option', 'digitech'),
                        'subtitle' => esc_html__('Only color validation can be done on this field type', 'digitech'),
                        'default'  => array('border-color' => '#ebebeb'),
                    ), 
                    array(
                        'id'        => 'back_to_top',
                        'type'      => 'switch',
                        'title'     => esc_html__('Back To Top', 'digitech'),
                        'desc'      => esc_html__('Show back to top button on all pages', 'digitech'),
                        'default'   => true,
                    ),
                    array(
                        'id'        => 'row_space',
                        'type'      => 'text',
                        'title'     => esc_html__('Row space', 'digitech'),
                        'desc'      => esc_html__('Space between row, default value: 50px', 'digitech'),
                        "default"   => '50px',
                        'display_value' => 'text',
                    ),
                ),
            );
            // Colors
            $this->sections[] = array(
                'title'     => esc_html__('Colors', 'digitech'),
                'desc'      => esc_html__('Color options', 'digitech'),
                'icon'      => 'el-icon-tint',
                'fields'    => array(
                    array(
                        'id'        => 'primary_color',
                        'type'      => 'color',
                        'title'     => esc_html__('Primary Color', 'digitech'),
                        'subtitle'  => esc_html__('Pick a color for primary color (default: #2e6ed5).', 'digitech'),
                        'transparent' => false,
                        'default'   => '#2e6ed5',
                        'validate'  => 'color',
                    ),
                    
                    array(
                        'id'        => 'sale_color',
                        'type'      => 'color',
                        //'output'    => array(),
                        'title'     => esc_html__('Sale Label BG Color', 'digitech'),
                        'subtitle'  => esc_html__('Pick a color for bg sale label (default: #f26522).', 'digitech'),
                        'transparent' => true,
                        'default'   => '#f26522',
                        'validate'  => 'color',
                    ),
                    
                    array(
                        'id'        => 'saletext_color',
                        'type'      => 'color',
                        //'output'    => array(),
                        'title'     => esc_html__('Sale Label Text Color', 'digitech'),
                        'subtitle'  => esc_html__('Pick a color for sale label text (default: #ffffff).', 'digitech'),
                        'transparent' => false,
                        'default'   => '#ffffff',
                        'validate'  => 'color',
                    ),
                    
                    array(
                        'id'        => 'rate_color',
                        'type'      => 'color',
                        //'output'    => array(),
                        'title'     => esc_html__('Rating Star Color', 'digitech'),
                        'subtitle'  => esc_html__('Pick a color for star of rating (default: #f9ba48).', 'digitech'),
                        'transparent' => false,
                        'default'   => '#f9ba48',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'       => 'link_color',
                        'type'     => 'link_color',
                        //'output'    => array('a'),
                        'title'     => esc_html__('Link Color', 'digitech'),
                        'subtitle'  => esc_html__('Pick a color for link (default: #a43d21).', 'digitech'),
                        'default'  => array(
                            'regular'  => '#a43d21',
                            'hover'    => '#2e6ed5',
                            'active'   => '#2e6ed5',
                            'visited'  => '#2e6ed5',
                        )
                    ),
                    array(
                        'id'        => 'text_selected_bg',
                        'type'      => 'color',
                        'title'     => esc_html__('Text selected background', 'digitech'),
                        'subtitle'  => esc_html__('Select background for selected text (default: #91b2c3).', 'digitech'),
                        'transparent' => false,
                        'default'   => '#91b2c3',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'        => 'text_selected_color',
                        'type'      => 'color',
                        'title'     => esc_html__('Text selected color', 'digitech'),
                        'subtitle'  => esc_html__('Select color for selected text (default: #ffffff).', 'digitech'),
                        'transparent' => false,
                        'default'   => '#ffffff',
                        'validate'  => 'color',
                    ),
                ),
            );
			
			//Header
            $header_layouts = array();
			$header_default = '';
			
            $jscomposer_templates_args = array(
                'orderby'          => 'title',
                'order'            => 'ASC',
                'post_type'        => 'templatera',
                'post_status'      => 'publish',
                'posts_per_page'   => 30,
            );
            $jscomposer_templates = get_posts( $jscomposer_templates_args );
            if(count($jscomposer_templates) > 0) {
                foreach($jscomposer_templates as $jscomposer_template){
                    $header_layouts[$jscomposer_template->post_title] = $jscomposer_template->post_title;
                }
                // $header_default = $jscomposer_templates[0]->post_title;
				$header_default = 'Header 1';
            }
            
			$this->sections[] = array(
                'title'     => esc_html__('Header', 'digitech'),
                'desc'      => esc_html__('Header options', 'digitech'),
                'icon'      => 'el-icon-tasks',
                'fields'    => array(

                    array(
                        'id'        => 'header_layout',
                        'type'      => 'select',
                        'title'     => esc_html__('Header Layout', 'digitech'),
                        'customizer_only'   => false,
                        'desc'      => esc_html__('Go to Visual Composer => Templates to create/edit layout', 'digitech'),
                        //Must provide key => value pairs for select options
                        'options'   => $header_layouts,
                        'default'   => $header_default
                    ),
                    array(
                        'id'        => 'header_bg',
                        'type'      => 'background',
                        'output'    => array(), 
                        'title'     => esc_html__('Header background', 'digitech'),
                        'subtitle'  => esc_html__('Upload image or select color.', 'digitech'), 
                        'default'   => array('background-color' => '#ffffff'),
                    ),
                    array(
                        'id'        => 'header_color',
                        'type'      => 'color',
                        'output'    => array('.header'),
                        'title'     => esc_html__('Header text color', 'digitech'),
                        'subtitle'  => esc_html__('Pick a color for header color (default: #363f4d).', 'digitech'),
                        'transparent' => false,
                        'default'   => '#363f4d',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'       => 'header_link_color',
                        'type'     => 'link_color',
                        'title'     => esc_html__('Header link color', 'digitech'),
                        'subtitle'  => esc_html__('Pick a color for header link color (default: #363f4d).', 'digitech'),
                        'default'  => array(
                            'regular'  => '#363f4d',
                            'hover'    => '#2e6ed5',
                            'active'   => '#2e6ed5',
                            'visited'  => '#2e6ed5',
                        )
                    ),
                    array(
                        'id'        => 'dropdown_bg',
                        'type'      => 'color',
                        //'output'    => array(),
                        'title'     => esc_html__('Dropdown menu background', 'digitech'),
                        'subtitle'  => esc_html__('Pick a color for dropdown menu background (default: #ffffff).', 'digitech'),
                        'transparent' => false,
                        'default'   => '#ffffff',
                        'validate'  => 'color',
                    ),
                ),
            );
            
            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Sticky header', 'digitech' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'        => 'sticky_header',
                        'type'      => 'switch',
                        'title'     => esc_html__('Use sticky header', 'digitech'),
                        'default'   => true,
                    ),
                    array(
                        'id'        => 'header_sticky_bg',
                        'type'      => 'color_rgba',
                        'title'     => esc_html__('Header sticky background', 'digitech'),
                        'subtitle'  => 'Set color and alpha channel',
                        'output'    => array('background-color' => '.header-sticky.ontop'),
                        'default'   => array(
                            'color'     => '#ffffff',
                            'alpha'     => 0.95,
                        ),
                        'options'       => array(
                            'show_input'                => true,
                            'show_initial'              => true,
                            'show_alpha'                => true,
                            'show_palette'              => true,
                            'show_palette_only'         => false,
                            'show_selection_palette'    => true,
                            'max_palette_size'          => 10,
                            'allow_empty'               => true,
                            'clickout_fires_change'     => false,
                            'choose_text'               => 'Choose',
                            'cancel_text'               => 'Cancel',
                            'show_buttons'              => true,
                            'use_extended_classes'      => true,
                            'palette'                   => null,
                            'input_text'                => 'Select Color'
                        ),                        
                    ),
                )
            );
            
            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Top Bar', 'digitech' ),
                'subsection' => true,
                'fields'     => array(
                    
                    array(
                        'id'        => 'topbar_color',
                        'type'      => 'color',
                        'output'    => array('.top-bar'),
                        'title'     => esc_html__('Top bar text color', 'digitech'),
                        'subtitle'  => esc_html__('Pick a color for top bar text color (default: #363f4d).', 'digitech'),
                        'transparent' => false,
                        'default'   => '#363f4d',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'       => 'topbar_link_color',
                        'type'     => 'link_color',
                        'output'    => array('.top-bar a'),
                        'title'     => esc_html__('Top bar link color', 'digitech'),
                        'subtitle'  => esc_html__('Pick a color for top bar link color (default: #363f4d).', 'digitech'),
                        'default'  => array(
                            'regular'  => '#363f4d',
                            'hover'    => '#2e6ed5',
                            'active'   => '#2e6ed5',
                            'visited'  => '#2e6ed5',
                        )
                    ), 
                )
            );

            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Menu', 'digitech' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'        => 'mobile_menu_label',
                        'type'      => 'text',
                        'title'     => esc_html__('Mobile menu label', 'digitech'),
                        'subtitle'     => esc_html__('The label for mobile menu (example: Menu, Go to...', 'digitech'),
                        'default'   => 'Menu'
                    ), 
                    array(
                        'id'        => 'sub_menu_bg',
                        'type'      => 'color',
                        //'output'    => array(),
                        'title'     => esc_html__('Submenu background', 'digitech'),
                        'subtitle'  => esc_html__('Pick a color for sub menu bg (default: #ffffff).', 'digitech'),
                        'transparent' => false,
                        'default'   => '#ffffff',
                        'validate'  => 'color',
                    ),
                )
            ); 
            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Categories Menu', 'digitech' ),
                'fields'     => array(
                    array(
                        'id'        => 'categories_menu_bg',
                        'type'      => 'color',
                        //'output'    => array(),
                        'title'     => esc_html__('Category menu background', 'digitech'),
                        'subtitle'  => esc_html__('Pick a color for category menu background (default: #ffffff).', 'digitech'),
                        'transparent' => false,
                        'default'   => '#ffffff',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'        => 'categories_sub_menu_bg',
                        'type'      => 'color',
                        //'output'    => array(),
                        'title'     => esc_html__('Sub category menu background', 'digitech'),
                        'subtitle'  => esc_html__('Pick a color for category sub menu background (default: #ffffff).', 'digitech'),
                        'transparent' => false,
                        'default'   => '#ffffff',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'        => 'categories_menu_label',
                        'type'      => 'text',
                        'title'     => esc_html__('Category menu label', 'digitech'),
                        'subtitle'     => esc_html__('The label for category menu', 'digitech'),
                        'default'   => 'ALL CATEGORIES'
                    ),
                    array(
                        'id'        => 'categories_menu_items',
                        'type'      => 'slider',
                        'title'     => esc_html__('Number of items', 'digitech'),
                        'desc'      => esc_html__('Number of menu items level 1 to show, default value: 9', 'digitech'),
                        "default"   => 9,
                        "min"       => 1,
                        "step"      => 1,
                        "max"       => 30,
                        'display_value' => 'text'
                    ),
                    array(
                        'id'        => 'categories_more_label',
                        'type'      => 'text',
                        'title'     => esc_html__('More items label', 'digitech'),
                        'subtitle'     => esc_html__('The label for more items button', 'digitech'),
                        'default'   => 'More Categories'
                    ),
                    array(
                        'id'        => 'categories_less_label',
                        'type'      => 'text',
                        'title'     => esc_html__('Less items label', 'digitech'),
                        'subtitle'     => esc_html__('The label for less items button', 'digitech'),
                        'default'   => 'Less Categories'
                    ),
                    array(
                        'id'        => 'categories_menu_home',
                        'type'      => 'switch',
                        'title'     => esc_html__('Home Category Menu', 'digitech'),
                        'subtitle'     => esc_html__('Always show category menu on home page', 'digitech'),
                        'default'   => false,
                    ),
                )
            );
			//Footer
            $footer_layouts = array();
			$footer_default = '';
			
            $jscomposer_templates_args = array(
                'orderby'          => 'title',
                'order'            => 'ASC',
                'post_type'        => 'templatera',
                'post_status'      => 'publish',
                'posts_per_page'   => 30,
            );
            $jscomposer_templates = get_posts( $jscomposer_templates_args );

            if(count($jscomposer_templates) > 0) {
                foreach($jscomposer_templates as $jscomposer_template){
                    $footer_layouts[$jscomposer_template->post_title] = $jscomposer_template->post_title;
                }
				// $footer_default = $jscomposer_templates[0]->post_title;
                $footer_default = 'Footer 1';
            }
            
			$this->sections[] = array(
                'title'     => esc_html__('Footer', 'digitech'),
                'desc'      => esc_html__('Footer options', 'digitech'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(

                    array(
                        'id'        => 'footer_layout',
                        'type'      => 'select',
                        'title'     => esc_html__('Footer Layout', 'digitech'),
                        'customizer_only'   => false,
                        'desc'      => esc_html__('Go to Visual Composer => Templates to create/edit layout', 'digitech'),
                        //Must provide key => value pairs for select options
                        'options'   => $footer_layouts,
                        'default'   => $footer_default
                    ),
                    array(
                        'id'        => 'footer_bg',
                        'type'      => 'background',
                        'output'    => array(), 
                        'title'     => esc_html__('Footer background', 'digitech'),
                        'subtitle'  => esc_html__('Upload image or select color.', 'digitech'), 
                        'default'   => array('background-color' => '#085293'),
                    ), 
                    array(
                        'id'        => 'footer_color',
                        'type'      => 'color',
                        'output'    => array('.footer'),
                        'title'     => esc_html__('Footer text color', 'digitech'),
                        'subtitle'  => esc_html__('Pick a color for footer color (default: #ffffff).', 'digitech'),
                        'transparent' => false,
                        'default'   => '#ffffff',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'       => 'footer_link_color',
                        'type'     => 'link_color',
                        'output'    => array('.footer a'),
                        'title'     => esc_html__('Footer link color', 'digitech'),
                        'subtitle'  => esc_html__('Pick a color for footer link color (default: #ffffff).', 'digitech'),
                        'default'  => array(
                            'regular'  => '#ffffff',
                            'hover'    => '#699ecd',
                            'active'   => '#699ecd',
                            'visited'  => '#699ecd',
                        )
                    ),
                ),
            );
            
            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Social Icons', 'digitech' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'       => 'social_icons',
                        'type'     => 'sortable',
                        'title'    => esc_html__('Social Icons', 'digitech'),
                        'subtitle' => esc_html__('Enter social links', 'digitech'),
                        'desc'     => esc_html__('Drag/drop to re-arrange', 'digitech'),
                        'mode'     => 'text',
                        'options'  => array(
                            'facebook'     => '',
                            'twitter'     => '',
                            'instagram' => '',
                            'tumblr'     => '',
                            'pinterest'     => '',
                            'google-plus'     => '',
                            'linkedin'     => '',
                            'behance'     => '',
                            'dribbble'     => '',
                            'youtube'     => '',
                            'vimeo'     => '',
                            'rss'     => '',
                        ),
                        'default' => array(
                            'facebook'     => 'https://www.facebook.com',
                            'twitter'     => 'https://twitter.com',
                            'instagram' => 'https://www.instagram.com',
                            'tumblr'     => '',
                            'pinterest'     => '',
                            'google-plus'     => '',
                            'linkedin'     => 'https://www.linkedin.com',
                            'behance'     => '',
                            'dribbble'     => '',
                            'youtube'     => '',
                            'vimeo'     => '',
                            'rss'     => 'https://www.rss.com',
                        ),
                    ),
                )
            ); 
			
			//Fonts
            $this->sections[] = array(
                'title'     => esc_html__('Fonts', 'digitech'),
                'desc'      => esc_html__('Fonts options', 'digitech'),
                'icon'      => 'el-icon-font',
                'fields'    => array(

                    array(
                        'id'            => 'bodyfont',
                        'type'          => 'typography',
                        'title'         => esc_html__('Body font', 'digitech'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => true,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'text-align'   => false,
                        //'font-size'     => false,
                        //'line-height'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        //'output'        => array('body'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => esc_html__('Main body font.', 'digitech'),
                        'default'       => array(
                            'color'         => '#666666',
                            'font-weight'    => '400',
                            'font-family'   => 'Rubik',
                            'google'        => true,
                            'font-size'     => '14px',
                            'line-height'   => '25px'
                        ),
                    ),
                    array(
                        'id'            => 'headingfont',
                        'type'          => 'typography',
                        'title'         => esc_html__('Heading font', 'digitech'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => false,
                        'line-height'   => false,
                        'text-align'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        //'output'        => array('h1, h2, h3, h4, h5, h6'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => esc_html__('Heading font.', 'digitech'),
                        'default'       => array(
                            'color'         => '#363f4d',
                            'font-weight'    => '500',
                            'font-family'   => 'Rubik',
                            'google'        => true,
                        ),
                    ),
                    array(
                        'id'            => 'menufont',
                        'type'          => 'typography',
                        'title'         => esc_html__('Menu font', 'digitech'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        'line-height'   => false,
                        'text-align'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        //'output'        => array('h1, h2, h3, h4, h5, h6'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => esc_html__('Menu font.', 'digitech'),
                        'default'       => array(
                            'color'         => '#363f4d',
                            'font-weight'    => '500',
                            'font-family'   => 'Rubik',
                            'font-size'     => '13px',
                            'google'        => true,
                        ),
                    ),
                    array(
                        'id'            => 'submenufont',
                        'type'          => 'typography',
                        'title'         => esc_html__('Sub menu font', 'digitech'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        'line-height'   => false,
                        'text-align'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        //'output'        => array('h1, h2, h3, h4, h5, h6'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => esc_html__('sub menu font.', 'digitech'),
                        'default'       => array(
                            'color'         => '#666666',
                            'font-weight'    => '400',
                            'font-family'   => 'Rubik',
                            'font-size'     => '13px',
                            'google'        => true,
                        ),
                    ),
                    array(
                        'id'            => 'dropdownfont',
                        'type'          => 'typography',
                        'title'         => esc_html__('Dropdown menu font', 'digitech'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        'line-height'   => false,
                        'text-align'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        //'output'        => array('h1, h2, h3, h4, h5, h6'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => esc_html__('Dropdown menu font.', 'digitech'),
                        'default'       => array(
                            'color'         => '#666666',
                            'font-weight'    => '400',
                            'font-family'   => 'Rubik',
                            'font-size'     => '13px',
                            'google'        => true,
                        ),
                    ),
                    array(
                        'id'            => 'categoriesfont',
                        'type'          => 'typography',
                        'title'         => esc_html__('Category menu font', 'digitech'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        'line-height'   => false,
                        'text-align'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        //'output'        => array('h1, h2, h3, h4, h5, h6'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => esc_html__('Category menu font.', 'digitech'),
                        'default'       => array(
                            'color'         => '#666666',
                            'font-weight'    => '400',
                            'font-family'   => 'Rubik',
                            'font-size'     => '13px',
                            'google'        => true,
                        ),
                    ),
                    array(
                        'id'            => 'categoriessubmenufont',
                        'type'          => 'typography',
                        'title'         => esc_html__('Category sub menu font', 'digitech'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        'line-height'   => false,
                        'text-align'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        //'output'        => array('h1, h2, h3, h4, h5, h6'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => esc_html__('Category sub menu font.', 'digitech'),
                        'default'       => array(
                            'color'         => '#333333',
                            'font-weight'    => '400',
                            'font-family'   => 'Rubik',
                            'font-size'     => '13px',
                            'google'        => true,
                        ),
                    ),
                    array(
                        'id'            => 'pricefont',
                        'type'          => 'typography',
                        'title'         => esc_html__('Price font', 'digitech'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        'line-height'   => false,
                        'text-align'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        //'output'        => array('h1, h2, h3, h4, h5, h6'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => esc_html__('Price font.', 'digitech'),
                        'default'       => array(
                            'color'         => '#2e6ed5',
                            'font-weight'    => '500',
                            'font-family'   => 'Rubik', 
                            'font-size'   => '14px', 
                            'google'        => true,
                        ),
                    ),
                ),
            );
			
			// Layout
            $this->sections[] = array(
                'title'     => esc_html__('Layout', 'digitech'),
                'desc'      => esc_html__('Select page layout: Box or Full Width', 'digitech'),
                'icon'      => 'el-icon-align-justify',
                'fields'    => array(
                    array(
                        'id'       => 'page_layout',
                        'type'     => 'select',
                        'multi'    => false,
                        'title'    => esc_html__('Page Layout', 'digitech'),
                        'options'  => array(
                            'full' => 'Full Width',
                            'box' => 'Box'
                        ),
                        'default'  => 'full'
                    ),
                    array(
                        'id'        => 'box_layout_width',
                        'type'      => 'slider',
                        'title'     => esc_html__('Box layout width', 'digitech'),
                        'desc'      => esc_html__('Box layout width in pixels, default value: 1230', 'digitech'),
                        "default"   => 1230,
                        "min"       => 960,
                        "step"      => 1,
                        "max"       => 1920,
                        'display_value' => 'text'
                    ),
                ),
            );
			
			//Brand logos
            $this->sections[] = array(
                'title'     => esc_html__('Brand Logos', 'digitech'),
                'desc'      => esc_html__('Upload brand logos and links', 'digitech'),
                'icon'      => 'el-icon-briefcase',
                'fields'    => array(
                    array(
                        'id'       => 'brandscroll',
                        'type'     => 'switch',
                        'title'    => esc_html__('Auto scroll', 'digitech'),
                        'default'  => true,
                    ),
                    array(
                        'id'        => 'brandscrollnumber',
                        'type'      => 'slider',
                        'title'     => esc_html__('Scroll amount', 'digitech'),
                        'desc'      => esc_html__('Number of logos to scroll one time, default value: 2', 'digitech'),
                        "default"   => 2,
                        "min"       => 1,
                        "step"      => 1,
                        "max"       => 12,
                        'display_value' => 'text'
                    ),
                    array(
                        'id'        => 'brandpause',
                        'type'      => 'slider',
                        'title'     => esc_html__('Pause in (seconds)', 'digitech'),
                        'desc'      => esc_html__('Pause time, default value: 3000', 'digitech'),
                        "default"   => 3000,
                        "min"       => 1000,
                        "step"      => 500,
                        "max"       => 10000,
                        'display_value' => 'text'
                    ),
                    array(
                        'id'        => 'brandanimate',
                        'type'      => 'slider',
                        'title'     => esc_html__('Animate in (seconds)', 'digitech'),
                        'desc'      => esc_html__('Animate time, default value: 2000', 'digitech'),
                        "default"   => 2000,
                        "min"       => 300,
                        "step"      => 100,
                        "max"       => 5000,
                        'display_value' => 'text'
                    ),
                    array(
                        'id'        => 'inner_brand',
                        'type'      => 'switch',
                        'title'     => esc_html__('Brand carousel in inner pages', 'digitech'),
                        'subtitle'   => esc_html__('Show brand carousel in inner pages', 'digitech'),
                        'default'   => false,
                    ),
                    array(
                        'id'          => 'brand_logos',
                        'type'        => 'slides',
                        'title'       => esc_html__('Logos', 'digitech'),
                        'desc'        => esc_html__('Upload logo image and enter logo link.', 'digitech'),
                        'placeholder' => array(
                            'title'           => esc_html__('Title', 'digitech'),
                            'description'     => esc_html__('Description', 'digitech'),
                            'url'             => esc_html__('Link', 'digitech'),
                        ),
                    ),
                ),
            );

			// Sidebar
			$this->sections[] = array(
                'title'     => esc_html__('Sidebar', 'digitech'),
                'desc'      => esc_html__('Sidebar options', 'digitech'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(
					
					array(
                        'id'       => 'sidebarshop_pos',
                        'type'     => 'radio',
                        'title'    => esc_html__('Shop Sidebar Position', 'digitech'),
                        'subtitle'      => esc_html__('Sidebar on shop page', 'digitech'),
                        'options'  => array(
                            'left' => 'Left',
                            'right' => 'Right'),
                        'default'  => 'left'
                    ),
                    array(
                        'id'       => 'sidebarsingleproduct_pos',
                        'type'     => 'radio',
                        'title'    => esc_html__('Single Product Sidebar Position', 'digitech'),
                        'subtitle'      => esc_html__('Sidebar on single product page', 'digitech'),
                        'options'  => array(
                            'left' => 'Left',
                            'right' => 'Right'),
                        'default'  => 'left'
                    ),
                    array(
                        'id'       => 'sidebarse_pos',
                        'type'     => 'radio',
                        'title'    => esc_html__('Pages Sidebar Position', 'digitech'),
                        'subtitle'      => esc_html__('Sidebar on pages', 'digitech'),
                        'options'  => array(
                            'left' => 'Left',
                            'right' => 'Right'),
                        'default'  => 'left'
                    ),
                    array(
                        'id'       => 'sidebarblog_pos',
                        'type'     => 'radio',
                        'title'    => esc_html__('Blog Sidebar Position', 'digitech'),
                        'subtitle'      => esc_html__('Sidebar on Blog pages', 'digitech'),
                        'options'  => array(
                            'left' => 'Left',
                            'right' => 'Right'),
                        'default'  => 'right'
                    ),
                    array(
                        'id'=>'custom-sidebars',
                        'type' => 'multi_text',
                        'title' => esc_html__('Custom Sidebars', 'digitech'),
                        'subtitle' => esc_html__('Add more sidebars', 'digitech'),
                        'desc' => esc_html__('Enter sidebar name (Only allow digits and letters). click Add more to add more sidebar. Edit your page to select a sidebar ', 'digitech')
                    ),
                ),
            );
			
			// Product
            $this->sections[] = array(
                'title'     => esc_html__('Product', 'digitech'),
                'desc'      => esc_html__('Use this section to select options for product', 'digitech'),
                'icon'      => 'el-icon-tags',
                'fields'    => array(
                    array(
                        'id'        => 'shop_banner',
                        'type'      => 'media',
                        'title'     => esc_html__('Banner image in shop pages', 'digitech'),
                        'compiler'  => 'true',
                        'mode'      => false,
                        'desc'      => esc_html__('Upload image here.', 'digitech'),
                    ),
					array(
                        'id'        => 'shop_layout',
                        'type'      => 'select',
                        'title'     => esc_html__('Shop Layout', 'digitech'),
                        'options'   => array(
                            'sidebar'   => 'Sidebar',
                            'fullwidth' => 'Full Width',
                        ),
                        'default'   => 'sidebar',
                    ),
                    array(
                        'id'        => 'default_view',
                        'type'      => 'select',
                        'title'     => esc_html__('Shop default view', 'digitech'),
                        'options'   => array(
                            'grid-view' => 'Grid View',
                            'list-view' => 'List View',
                        ),
                        'default'   => 'grid-view',
                    ),
                    array(
                        'id'        => 'product_per_page',
                        'type'      => 'slider',
                        'title'     => esc_html__('Products per page', 'digitech'),
                        'subtitle'  => esc_html__('Amount of products per page on category page', 'digitech'),
                        "default"   => 12,
                        "min"       => 4,
                        "step"      => 1,
                        "max"       => 48,
                        'display_value' => 'text',
                    ),
                    array(
                        'id'        => 'product_per_row',
                        'type'      => 'slider',
                        'title'     => esc_html__('Product columns', 'digitech'),
                        'subtitle'      => esc_html__('Amount of product columns on category page', 'digitech'),
                        'desc'      => esc_html__('Only works with: 1, 2, 3, 4, 6', 'digitech'),
                        "default"   => 3,
                        "min"       => 1,
                        "step"      => 1,
                        "max"       => 6,
                        'display_value' => 'text',
                    ),
                    array(
                        'id'        => 'product_per_row_fw',
                        'type'      => 'slider',
                        'title'     => esc_html__('Product columns on full width shop', 'digitech'),
                        'subtitle'      => esc_html__('Amount of product columns on full width category page', 'digitech'),
                        'desc'      => esc_html__('Only works with: 1, 2, 3, 4, 6', 'digitech'),
                        "default"   => 4,
                        "min"       => 1,
                        "step"      => 1,
                        "max"       => 6,
                        'display_value' => 'text',
                    ),
                ),
            );
			 

            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Product page', 'digitech' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'        => 'product_banner',
                        'type'      => 'media',
                        'title'     => esc_html__('Banner image for single product pages', 'digitech'),
                        'compiler'  => 'true',
                        'mode'      => false,
                        'desc'      => esc_html__('Upload image here.', 'digitech'),
                    ),
                    array(
                        'id'        => 'related_product_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Related product title', 'digitech'),
                        'default'   => 'Related Products',
                    ),
                    array(
                        'id'        => 'related_amount',
                        'type'      => 'slider',
                        'title'     => esc_html__('Number of related products', 'digitech'),
                        "default"   => 6,
                        "min"       => 1,
                        "step"      => 1,
                        "max"       => 16,
                        'display_value' => 'text',
                    ),
                    array(
                        'id'        => 'product_share_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Product share title', 'digitech'),
                        'default'   => 'Share this product',
                    ),
                    array(
                        'id'        => 'related_product_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Related product title', 'digitech'),
                        'default'   => 'Related Products',
                    ),
                    array(
                        'id'=>'share_head_code',
                        'type' => 'textarea',
                        'title' => esc_html__('ShareThis/AddThis head tag', 'digitech'), 
                        'desc' => esc_html__('Paste your ShareThis or AddThis head tag here', 'digitech'),
                        'default' => '',
                    ),
                    array(
                        'id'=>'share_code',
                        'type' => 'textarea',
                        'title' => esc_html__('ShareThis/AddThis code', 'digitech'), 
                        'desc' => esc_html__('Paste your ShareThis or AddThis code here', 'digitech'),
                        'default' => '',
                    ),
                )
            );
            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Quick View', 'digitech' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'        => 'detail_link_text',
                        'type'      => 'text',
                        'title'     => esc_html__('View details text', 'digitech'),
                        'default'   => 'Quick View'
                    ),
                    array(
                        'id'        => 'quickview_link_text',
                        'type'      => 'text',
                        'title'     => esc_html__('View all features text', 'digitech'),
                        'desc'      => esc_html__('This is the text on quick view box', 'digitech'),
                        'default'   => 'See all features'
                    ),
                    array(
                        'id'        => 'quickview',
                        'type'      => 'switch',
                        'title'     => esc_html__('Quick View', 'digitech'),
                        'desc'      => esc_html__('Show quick view button on all pages', 'digitech'),
                        'default'   => true,
                    ),
                )
            );
			// Blog options
            $this->sections[] = array(
                'title'     => esc_html__('Blog', 'digitech'),
                'desc'      => esc_html__('Use this section to select options for blog', 'digitech'),
                'icon'      => 'el-icon-file',
                'fields'    => array( 
					array(
                        'id'        => 'blog_header_text',
                        'type'      => 'text',
                        'title'     => esc_html__('Blog header text', 'digitech'),
                        'default'   => 'Blog'
                    ), 
                    array(
                        'id'        => 'blog_layout',
                        'type'      => 'select',
                        'title'     => esc_html__('Blog Layout', 'digitech'),
                        'options'   => array(
                            'sidebar'       => 'Sidebar',
                            'nosidebar'     => 'No Sidebar',
                            'largeimage'    => 'Large Image',
							'grid'          => 'Grid',
                        ),
                        'default'   => 'sidebar'
                    ),
                    array(
                        'id'        => 'readmore_text',
                        'type'      => 'text',
                        'title'     => esc_html__('Read more text', 'digitech'),
                        'default'   => 'Read More'
                    ),
                    array(
                        'id'        => 'excerpt_length',
                        'type'      => 'slider',
                        'title'     => esc_html__('Excerpt length on blog page', 'digitech'),
                        "default"   => 45,
                        "min"       => 10,
                        "step"      => 1,
                        "max"       => 120,
                        'display_value' => 'text'
                    ),
                    array(
                        'id'        => 'blog_share_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Blog share title', 'digitech'),
                        'default'   => 'Share this post',
                    ),
                ),
            );
			$this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Latest posts carousel', 'digitech' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'       => 'blogscroll',
                        'type'     => 'switch',
                        'title'    => esc_html__('Latest posts auto scroll', 'digitech'),
                        'default'  => false,
                    ),
                    array(
                        'id'        => 'blogpause',
                        'type'      => 'slider',
                        'title'     => esc_html__('Pause in (seconds)', 'digitech'),
                        'desc'      => esc_html__('Pause time, default value: 3000', 'digitech'),
                        "default"   => 3000,
                        "min"       => 1000,
                        "step"      => 500,
                        "max"       => 10000,
                        'display_value' => 'text'
                    ),
                    array(
                        'id'        => 'bloganimate',
                        'type'      => 'slider',
                        'title'     => esc_html__('Animate in (seconds)', 'digitech'),
                        'desc'      => esc_html__('Animate time, default value: 2000', 'digitech'),
                        "default"   => 2000,
                        "min"       => 300,
                        "step"      => 100,
                        "max"       => 5000,
                        'display_value' => 'text'
                    ),
                )
            );
			// Testimonials options
            $this->sections[] = array(
                'title'     => esc_html__('Testimonials', 'digitech'),
                'desc'      => esc_html__('Use this section to select options for Testimonials', 'digitech'),
                'icon'      => 'el-icon-comment',
                'fields'    => array(
					array(
						'id'       => 'testiscroll',
						'type'     => 'switch',
						'title'    => esc_html__('Auto scroll', 'digitech'),
						'default'  => true,
					),
					array(
						'id'        => 'testipause',
						'type'      => 'slider',
						'title'     => esc_html__('Pause in (seconds)', 'digitech'),
						'desc'      => esc_html__('Pause time, default value: 3000', 'digitech'),
						"default"   => 3000,
						"min"       => 1000,
						"step"      => 500,
						"max"       => 10000,
						'display_value' => 'text'
					),
					array(
						'id'        => 'testianimate',
						'type'      => 'slider',
						'title'     => esc_html__('Animate in (seconds)', 'digitech'),
						'desc'      => esc_html__('Animate time, default value: 2000', 'digitech'),
						"default"   => 2000,
						"min"       => 300,
						"step"      => 100,
						"max"       => 5000,
						'display_value' => 'text'
					),
                ),
            );
			// Error 404 page
            $this->sections[] = array(
                'title'     => esc_html__('Error 404 Page', 'digitech'),
                'desc'      => esc_html__('Error 404 page options', 'digitech'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(
                    array(
                        'id'        => 'background_error',
                        'type'      => 'background',
                        'output'    => array('body.error404'),
                        'title'     => esc_html__('Error 404 background', 'digitech'),
                        'subtitle'  => esc_html__('Upload image or select color.', 'digitech'),
                        'default'   => array('background-color' => '#f2f2f2'),
                    ),
                ),
            );
			
			// Less Compiler
            $this->sections[] = array(
                'title'     => esc_html__('Less Compiler', 'digitech'),
                'desc'      => esc_html__('Turn on this option to apply all theme options. Turn of when you have finished changing theme options and your site is ready.', 'digitech'),
                'icon'      => 'el-icon-wrench',
                'fields'    => array(
					array(
                        'id'        => 'enable_less',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Less Compiler', 'digitech'),
						'default'   => true,
                    ),
                ),
            );
			
            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . esc_html__('<strong>Theme URL:</strong> ', 'digitech') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . esc_html__('<strong>Author:</strong> ', 'digitech') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . esc_html__('<strong>Version:</strong> ', 'digitech') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . esc_html__('<strong>Tags:</strong> ', 'digitech') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            $this->sections[] = array(
                'title'     => esc_html__('Import / Export', 'digitech'),
                'desc'      => esc_html__('Import and Export your Redux Framework settings from file, text or URL.', 'digitech'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => esc_html__('Theme Information', 'digitech'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => esc_html__('Theme Information 1', 'digitech'),
                'content'   => esc_html__('<p>This is the tab content, HTML is allowed.</p>', 'digitech')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => esc_html__('Theme Information 2', 'digitech'),
                'content'   => esc_html__('<p>This is the tab content, HTML is allowed.</p>', 'digitech')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = esc_html__('<p>This is the sidebar content, HTML is allowed.</p>', 'digitech');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'digitech_opt',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => esc_html__('Theme Options', 'digitech'),
                'page_title'        => esc_html__('Theme Options', 'digitech'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => true,                    // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar'         => false,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el-icon-linkedin'
            );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
              } else {
            }

        }

    }
    
    global $reduxConfig;
    $reduxConfig = new digitech_Theme_Config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
