<?php

class CurrentThemePageMetas extends TTRenderMeta{

    function __construct(){
        $this->items = $this->items();

        $template_uri = get_template_directory_uri();
        
        add_action('admin_enqueue_scripts', array($this, 'print_admin_scripts'));
        add_action('add_meta_boxes', array($this, 'add_custom_meta'), 1);
        add_action('edit_post', array($this, 'save_post'), 99);
    }

    public function items(){
        global $post;

        define('ADMIN_IMAGES', get_template_directory_uri().'/framework/admin-assets/images/');

        $tmp_arr = array(
            'page' => array(
                'label' => 'Page Options',
                'post_type' => 'page',
                'items' => array(

                    array(
                        'name' => 'page_header',
                        'type' => 'select',
                        'label' => 'Page Header',
                        'default' => 'default',
                        'option' => array(
                            'default'   => 'Default - Customizer Option',
                            'header_full'         => 'Header area full',
                            'header_wrapped'     => 'Header wrapped'
                        )
                    ),
                    array(
                        'name' => 'header_dark',
                        'type' => 'select',
                        'label' => 'Page Header',
                        'default' => 'default',
                        'option' => array(
                            'default'   => 'Default - Customizer Option',
                            'dark'         => 'dark',
                            'light'     => 'light'
                        )
                    ),
                    array(
                        'name' => 'page_layout',
                        'type' => 'thumbs',
                        'label' => 'Page Layout',
                        'default' => 'full',
                        'option' => array(
                            'full' => ADMIN_IMAGES . '1col.png',
                            'right' => ADMIN_IMAGES . '2cr.png',
                            'left' => ADMIN_IMAGES . '2cl.png'
                        ),
                        'desc' => 'Select Page Layout (Fullwidth | Right Sidebar | Left Sidebar)'
                    ),
                    array(
                        'type' => 'checkbox',
                        'name' => 'remove_padding',
                        'label' => 'Remove Padding',
                        'default' => '0'
                    ),
                    array(
                        'type' => 'checkbox',
                        'name' => 'title_show',
                        'label' => 'Page Title Show',
                        'default' => '1'
                    )
                )
            ),
            

        );

        return $tmp_arr;
    }

}

new CurrentThemePageMetas();

?>