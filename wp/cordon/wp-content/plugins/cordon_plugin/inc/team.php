<?php
// Registers the new post type 

function wpt_team_posttype() {
	register_post_type( 'team-post',
		array(
			'labels' => array(
				'name' => __( 'Team Posts', 'cordon_plg' ),
				'singular_name' => __( 'Team Post' , 'cordon_plg'),
				'add_new' => __( 'Add New Team Post', 'cordon_plg' ),
				'add_new_item' => __( 'Add New Team Post', 'cordon_plg' ),
				'edit_item' => __( 'Edit Team Post', 'cordon_plg' ),
				'new_item' => __( 'Add New Team Post', 'cordon_plg' ),
				'view_item' => __( 'View Team Post', 'cordon_plg' ),
				'search_items' => __( 'Search Team Posts', 'cordon_plg' ),
				'not_found' => __( 'No Team Post found', 'cordon_plg' ),
				'not_found_in_trash' => __( 'No Team Post found in trash', 'cordon_plg' )
			),
			'public' => true,
			'supports' => array( 'title', 'thumbnail'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "team-post"), // Permalinks format
			'menu_position' => 5,
			'menu_icon'           => 'dashicons-groups',
			'exclude_from_search' => true 
		)
	);

}

add_action( 'init', 'wpt_team_posttype' );


