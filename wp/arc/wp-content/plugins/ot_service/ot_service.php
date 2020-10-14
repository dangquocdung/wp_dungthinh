<?php
/*
	Plugin Name: OT Services
	Plugin URI: http://oceanthemes.net/
	Description: Declares a plugin that will create a custom post type displaying portfolio.
	Version: 1.0
	Author: ThemeModern
	Author URI: http://oceanthemes.net/
	Text Domain: ot_service
	Domain Path: /lang
	License: GPLv2 or later
*/

/* UPDATE 
  register_activation_hook is not called when a plugin is updated
  so we need to use the following function 
*/
function ot_service_update() {
	load_plugin_textdomain('ot_service', FALSE, dirname(plugin_basename(__FILE__)) . '/lang/');
}
add_action('plugins_loaded', 'ot_service_update');

function ot_service_type() {
	$servicelabels = array (	

		'name' => __('Services','ot_service'),

		'singular_name' => __('Service','ot_service'),

		'add_new' => __('Add Service','ot_service'),

		'add_new_item' => __('Add new service','ot_service'),

		'edit_item' => __('Edit service','ot_service'),

		'new_item' => __('Add new service','ot_service'),

		'all_items' => __('All Services','ot_service'),

		'view_item' => __('View Service','ot_service'),

		'search_item' => __('Search service','ot_service'),

		'not_found' => __('No service found..','ot_service'),

		'not_found_in_trash' => __('No service found in Trash.','ot_service'),

		'menu_name' => 'Services'

	);

	$args = array(

		'labels' => $servicelabels,
		'hierarchical' => false,
		'description' => 'Manages service',
		'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => null,
		'menu_icon' => 'dashicons-admin-generic',		
		'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite'  => array( 'slug' => 'services' ),
        'capability_type' => 'post',
		'supports' => array( 'title','editor','thumbnail','excerpt','comments','custom-fields'),
	);
		register_post_type ('service',$args);
	}
add_action ('init','ot_service_type');

function ot_service_taxonomy () {
	$taxonomylabels = array(

	'name' => __('Category Service','ot_service'),

	'singular_name' => __('Category Service','ot_service'),

	'search_items' => __('Search Category Service','ot_service'),

	'all_items' => __('All Category Service','ot_service'),

	'edit_item' => __('Edit Category Service','ot_service'),

	'add_new_item' => __('Add new Category Service','ot_service'),

	'menu_name' => __('Category Service','ot_service'),

	);

	$args = array(

	'labels' => $taxonomylabels,

	'hierarchical' => true,

);
	register_taxonomy('category_service','service',$args);
}
add_action ('init','ot_service_taxonomy',0);

// Add to admin_init function
add_filter('manage_edit-service_columns', 'add_new_service_columns');
function add_new_service_columns($service_columns) { 
	$new_columns['cb'] = '<input type="checkbox" />'; 
    $new_columns['title'] = _x('Title', 'ot_service');
    $new_columns['author'] = _x('Author', 'ot_service');
    $new_columns['category_service'] = _x('Category', 'ot_service');
    $new_columns['date'] = _x('Date', 'ot_service');

    return $new_columns;
}

// Add to admin_init function
add_action('manage_service_posts_custom_column', 'manage_service_columns', 10, 2);
function manage_service_columns($column, $post_id) {
    global $wpdb;
    switch ($column) {
        case 'category_service':
            $terms = get_the_terms($post_id, 'category_service');
            if (!empty($terms)) {
                $out = array();
                foreach ($terms as $term) {
                    $out[] = sprintf('<a href="%s&post_type=service">%s</a>', esc_url(add_query_arg(array(
                        'post_type' => $post->post_type,
                        'category_service' => $term->slug
                    ), 'edit.php')), esc_html(sanitize_term_field('name', $term->name, $term->term_id, 'category_service', 'display')));
                }
                echo join(', ', $out);
            } else {
                _e('No Service Category', 'ot_service');
            }
            break;   
        default:
            break;
    } // end switch
}

?>