<?php
if ( ! defined('ABSPATH') ) {
	die('Please do not load this file directly!');
}

add_action('init', 'register_member_post_type');
/**
  * Register member post type
*/
function register_member_post_type() {
    $member_slug = 'member';

    $labels = array(
        'name'               => esc_html__( 'Members', 'thecraft' ),
        'singular_name'      => esc_html__( 'Member Item', 'thecraft' ),
        'add_new'            => esc_html__( 'Add New', 'thecraft' ),
        'add_new_item'       => esc_html__( 'Add New Item', 'thecraft' ),
        'new_item'           => esc_html__( 'New Item', 'thecraft' ),
        'edit_item'          => esc_html__( 'Edit Item', 'thecraft' ),
        'view_item'          => esc_html__( 'View Item', 'thecraft' ),
        'all_items'          => esc_html__( 'All Items', 'thecraft' ),
        'search_items'       => esc_html__( 'Search Items', 'thecraft' ),
        'parent_item_colon'  => esc_html__( 'Parent Items:', 'thecraft' ),
        'not_found'          => esc_html__( 'No items found.', 'thecraft' ),
        'not_found_in_trash' => esc_html__( 'No items found in Trash.', 'thecraft' )
    );

    $args = array(
        'labels'        => $labels,
        'rewrite'       => array( 'slug' => $member_slug ),
        'supports'      => array( 'title', 'thumbnail' ),
        'public'        => true
    );

    register_post_type( 'member', $args );
}

add_filter( 'post_updated_messages', 'member_updated_messages' );
/**
  * Member update messages.
*/
function member_updated_messages( $messages ) {
    $post             = get_post();
    $post_type        = get_post_type( $post );
    $post_type_object = get_post_type_object( $post_type );

    $messages['member'] = array(
        0  => '', // Unused. Messages start at index 1.
        1  => esc_html__( 'Member updated.', 'thecraft' ),
        2  => esc_html__( 'Custom field updated.', 'thecraft' ),
        3  => esc_html__( 'Custom field deleted.', 'thecraft' ),
        4  => esc_html__( 'Member updated.', 'thecraft' ),
        5  => isset( $_GET['revision'] ) ? sprintf( esc_html__( 'Member restored to revision from %s', 'thecraft' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6  => esc_html__( 'Member published.', 'thecraft' ),
        7  => esc_html__( 'Member saved.', 'thecraft' ),
        8  => esc_html__( 'Member submitted.', 'thecraft' ),
        9  => sprintf(
            esc_html__( 'Member scheduled for: <strong>%1$s</strong>.', 'thecraft' ),
            date_i18n( esc_html__( 'M j, Y @ G:i', 'thecraft' ), strtotime( $post->post_date ) )
        ),
        10 => esc_html__( 'Member draft updated.', 'thecraft' )
    );
    return $messages;
}

add_action( 'init', 'register_member_taxonomy' );
/**
  * Register member taxonomy
*/
function register_member_taxonomy() {
    $cat_slug = 'member_category';

    $labels = array(
        'name'                       => esc_html__( 'Member Categories', 'thecraft' ),
        'singular_name'              => esc_html__( 'Category', 'thecraft' ),
        'search_items'               => esc_html__( 'Search Categories', 'thecraft' ),
        'menu_name'                  => esc_html__( 'Categories', 'thecraft' ),
        'all_items'                  => esc_html__( 'All Categories', 'thecraft' ),
        'parent_item'                => esc_html__( 'Parent Category', 'thecraft' ),
        'parent_item_colon'          => esc_html__( 'Parent Category:', 'thecraft' ),
        'new_item_name'              => esc_html__( 'New Category Name', 'thecraft' ),
        'add_new_item'               => esc_html__( 'Add New Category', 'thecraft' ),
        'edit_item'                  => esc_html__( 'Edit Category', 'thecraft' ),
        'update_item'                => esc_html__( 'Update Category', 'thecraft' ),
        'add_or_remove_items'        => esc_html__( 'Add or remove categories', 'thecraft' ),
        'choose_from_most_used'      => esc_html__( 'Choose from the most used categories', 'thecraft' ),
        'not_found'                  => esc_html__( 'No Category found.', 'thecraft' ),
        'menu_name'                  => esc_html__( 'Categories', 'thecraft' ),
    );
    $args = array(
        'labels'        => $labels,
        'rewrite'             => array('slug'=>$cat_slug),
        'hierarchical'  => true,
    );
    register_taxonomy( 'member_category', 'member', $args );
}