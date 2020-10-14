<?php
// Registers the new post type 

function rdn_testimonial_ptype() {
	register_post_type( 'testimonial',
		array(
			'labels' => array(
				'name' => __( 'Testimonial', 'cordon_plg' ),
				'singular_name' => __( 'Testimonial' , 'cordon_plg'),
				'add_new' => __( 'Add New Testimonial', 'cordon_plg' ),
				'add_new_item' => __( 'Add New Testimonial', 'cordon_plg' ),
				'edit_item' => __( 'Edit Testimonial', 'cordon_plg' ),
				'new_item' => __( 'Add New Testimonial', 'cordon_plg' ),
				'view_item' => __( 'View Testimonial', 'cordon_plg' ),
				'search_items' => __( 'Search Testimonial', 'cordon_plg' ),
				'not_found' => __( 'No Testimonial found', 'cordon_plg' ),
				'not_found_in_trash' => __( 'No Testimonial found in trash', 'cordon_plg' )
			),
			'public' => true,
			'supports' => array( 'title','editor'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "testimonial"), // Permalinks format
			'menu_position' => 5,
			'menu_icon'           => 'dashicons-format-chat',
			'exclude_from_search' => true 
		)
	);

}

add_action( 'init', 'rdn_testimonial_ptype' );


