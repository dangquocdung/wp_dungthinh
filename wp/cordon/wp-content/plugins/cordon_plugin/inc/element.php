<?php

function rdn_newelement($tabs) {
    $tabs[] = array(
        'title' => __('Cordon Builder', 'cordon_plg'),
        'filter' => array(
            'groups' => array('cordon_builder')
        )
    );

    return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'rdn_newelement', 20);


//custom styling for site origin
function rdn_so_style() {
    wp_enqueue_style('so-style',plugins_url( 'element/css/style.css' , __FILE__ ));
}
add_action( 'wp_enqueue_scripts', 'rdn_so_style' );

function rdn_custom_admin_css() {
	  wp_register_style( 'rdn-so-style',plugins_url( 'element/css/admin.css', __FILE__ ), false, '1.0.0' );
      wp_enqueue_style( 'rdn-so-style' );
}

add_action( 'admin_enqueue_scripts', 'rdn_custom_admin_css' );


