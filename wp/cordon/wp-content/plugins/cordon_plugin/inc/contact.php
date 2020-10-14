<?php
// Registers the new post type 

function aslina_contact_posttype() {
	register_post_type( 'contact',
		array(
			'labels' => array(
				'name' => __( 'Contact Posts', 'cordon_plg' ),
				'singular_name' => __( 'Contact Post' , 'cordon_plg'),
				'add_new' => __( 'Add New Contact Post', 'cordon_plg' ),
				'add_new_item' => __( 'Add New Contact Post', 'cordon_plg' ),
				'edit_item' => __( 'Edit Contact Post', 'cordon_plg' ),
				'new_item' => __( 'Add New Contact Post', 'cordon_plg' ),
				'view_item' => __( 'View Contact Post', 'cordon_plg' ),
				'search_items' => __( 'Search Contact Posts', 'cordon_plg' ),
				'not_found' => __( 'No Contact Post found', 'cordon_plg' ),
				'not_found_in_trash' => __( 'No Contact Post found in trash', 'cordon_plg' )
			),
			'public' => true,
			'supports' => array( 'title', 'editor', 'thumbnail','excerpt'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "contact"), // Permalinks format
			'menu_position' => 5,
			'menu_icon'           => 'dashicons-exerpt-view',
			'exclude_from_search' => true 
		)
	);

}

add_action( 'init', 'aslina_contact_posttype' );


