<?php
// Registers the new post type 

function rdn_client_ptype() {
	register_post_type( 'client',
		array(
			'labels' => array(
				'name' => __( 'Client', 'cordon_plg' ),
				'singular_name' => __( 'Client' , 'cordon_plg'),
				'add_new' => __( 'Add New Client', 'cordon_plg' ),
				'add_new_item' => __( 'Add New Client', 'cordon_plg' ),
				'edit_item' => __( 'Edit Client', 'cordon_plg' ),
				'new_item' => __( 'Add New Client', 'cordon_plg' ),
				'view_item' => __( 'View Client', 'cordon_plg' ),
				'search_items' => __( 'Search Client', 'cordon_plg' ),
				'not_found' => __( 'No Client found', 'cordon_plg' ),
				'not_found_in_trash' => __( 'No Client found in trash', 'cordon_plg' )
			),
			'public' => true,
			'supports' => array( 'title'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "client"), // Permalinks format
			'menu_position' => 5,
			'menu_icon'           => 'dashicons-universal-access-alt',
			'exclude_from_search' => true 
		)
	);

}

add_action( 'init', 'rdn_client_ptype' );


