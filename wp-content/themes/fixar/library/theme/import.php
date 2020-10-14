<?php

function fixar_import_files() {
    
    
    add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
    
    add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
    
    
    return array(
		array(
            'import_file_name'           => esc_html__( 'Import Theme', 'fixar' ),
            'import_file_url'            => esc_url('http://assets.templines.com/plugins/theme/fixar/c8hyhsamx8h7t2hvg7csrkeeh4x6a4nrrdvgsbnmgk6xeb93jp2fbah58tmu3rh6vtg5fvsm3swbd2x4gcjtmh8vh8t6ezeny4m/fixar.xml'),
            'import_widget_file_url'     => esc_url('http://assets.templines.com/plugins/theme/fixar/c8hyhsamx8h7t2hvg7csrkeeh4x6a4nrrdvgsbnmgk6xeb93jp2fbah58tmu3rh6vtg5fvsm3swbd2x4gcjtmh8vh8t6ezeny4m/fixar.wie'),
            'import_customizer_file_url' => esc_url('http://assets.templines.com/plugins/theme/fixar/c8hyhsamx8h7t2hvg7csrkeeh4x6a4nrrdvgsbnmgk6xeb93jp2fbah58tmu3rh6vtg5fvsm3swbd2x4gcjtmh8vh8t6ezeny4m/fixar.dat'),
            'import_preview_image_url'   => '',
            'import_notice'              => '',
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'fixar_import_files' );


function fixar_after_import( $selected_import ) {

    $menu_arr = array();
    $main_menu = get_term_by('name', 'fixar-main', 'nav_menu');
    if(is_object($main_menu))
        $menu_arr['primary_nav'] = $main_menu->term_id;
    set_theme_mod( 'nav_menu_locations', $menu_arr );

    $slider_array = array(
        get_template_directory()."/library/revslider/fixar.zip",             
    );

    $front_page_id = get_page_by_title( 'Welcome fixar' );
    $blog_page_id  = get_page_by_title( 'Blog' );
	
	
	

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );
    set_theme_mod( 'fixar_footer_block', '1711' );

    $absolute_path = __FILE__;
    $path_to_file = explode( 'wp-content', $absolute_path );
    $path_to_wp = $path_to_file[0];

    require_once( $path_to_wp.'/wp-load.php' );
    require_once( $path_to_wp.'/wp-includes/functions.php');

    $slider = new RevSlider();

    foreach($slider_array as $filepath){
     $slider->importSliderFromPost(true,true,$filepath);
    }
	
	update_post_meta($blog_page_id->ID,'pix_selected_sidebar','sidebar-1');

}
add_action( 'pt-ocdi/after_import', 'fixar_after_import' );

?>