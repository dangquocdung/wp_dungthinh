<?php
/**
 * Initialize Custom Post Type - Eunice Theme
 */

function eunice_custom_post_type() {
	$gallery_cpt = (eunice_framework_active()) ? cs_get_option('theme_gallery_name') : '';
	$gallery_slug = (eunice_framework_active()) ? cs_get_option('theme_gallery_slug') : '';
	$gallery_cpt_slug = (eunice_framework_active()) ? cs_get_option('theme_gallery_cat_slug') : '';

	$base = (isset($gallery_cpt_slug) && $gallery_cpt_slug !== '') ? sanitize_title_with_dashes($gallery_cpt_slug) : ((isset($gallery_cpt) && $gallery_cpt !== '') ? strtolower($gallery_cpt) : 'gallery');
	$base_slug = (isset($gallery_slug) && $gallery_slug !== '') ? sanitize_title_with_dashes($gallery_slug) : ((isset($gallery_cpt) && $gallery_cpt !== '') ? strtolower($gallery_cpt) : 'gallery');
	$label = ucfirst((isset($gallery_cpt) && $gallery_cpt !== '') ? strtolower($gallery_cpt) : 'gallery');
	// Register custom post type - Gallery
	register_post_type('gallery',
		array(
			'labels' => array(
				'name' => $label,
				'singular_name' => sprintf(esc_html__('%s Post', 'eunice-core' ), $label),
				'all_items' => sprintf(esc_html__('All %s', 'eunice-core' ), $label),
				'add_new' => esc_html__('Add New', 'eunice-core') ,
				'add_new_item' => sprintf(esc_html__('Add New %s', 'eunice-core' ), $label),
				'edit' => esc_html__('Edit', 'eunice-core') ,
				'edit_item' => sprintf(esc_html__('Edit %s', 'eunice-core' ), $label),
				'new_item' => sprintf(esc_html__('New %s', 'eunice-core' ), $label),
				'view_item' => sprintf(esc_html__('View %s', 'eunice-core' ), $label),
				'search_items' => sprintf(esc_html__('Search %s', 'eunice-core' ), $label),
				'not_found' => esc_html__('Nothing found in the Database.', 'eunice-core') ,
				'not_found_in_trash' => esc_html__('Nothing found in Trash', 'eunice-core') ,
				'parent_item_colon' => ''
			) ,
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 10,
			'menu_icon' => 'dashicons-images-alt2',
			'rewrite' => array(
				'slug' => $base_slug,
				'with_front' => false
			),
			'has_archive' => true,
			'capability_type' => 'post',
			'hierarchical' => true,
			'supports' => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'trackbacks',
				'custom-fields',
				'comments',
				'revisions',
				'sticky',
				'page-attributes'
			)
		)
	);
	// Registered

	// Add Category Taxonomy for our Custom Post Type - Gallery
	register_taxonomy(
		'gallery_category',
		'gallery',
		array(
			'hierarchical' => true,
			'public' => true,
			'show_ui' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'labels' => array(
				'name' => sprintf(esc_html__( '%s Categories', 'eunice-core' ), $label),
				'singular_name' => sprintf(esc_html__('%s Category', 'eunice-core'), $label),
				'search_items' =>  sprintf(esc_html__( 'Search %s Categories', 'eunice-core'), $label),
				'all_items' => sprintf(esc_html__( 'All %s Categories', 'eunice-core'), $label),
				'parent_item' => sprintf(esc_html__( 'Parent %s Category', 'eunice-core'), $label),
				'parent_item_colon' => sprintf(esc_html__( 'Parent %s Category:', 'eunice-core'), $label),
				'edit_item' => sprintf(esc_html__( 'Edit %s Category', 'eunice-core'), $label),
				'update_item' => sprintf(esc_html__( 'Update %s Category', 'eunice-core'), $label),
				'add_new_item' => sprintf(esc_html__( 'Add New %s Category', 'eunice-core'), $label),
				'new_item_name' => sprintf(esc_html__( 'New %s Category Name', 'eunice-core'), $label)
			),
			'rewrite' => array( 'slug' => $base . '_cat' ),
		)
	);

	$args = array(
		'hierarchical' => true,
		'public' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => false,
	);

	// Testimonials - Start
	$testimonial_slug = 'testimonial';
	$testimonials = esc_html__('Testimonials', 'eunice-core');

	// Register custom post type - Testimonials
	register_post_type('testimonials',
		array(
			'labels' => array(
				'name' => $testimonials,
				'singular_name' => sprintf(esc_html__('%s Post', 'eunice-core' ), $testimonials),
				'all_items' => sprintf(esc_html__('All %s', 'eunice-core' ), $testimonials),
				'add_new' => esc_html__('Add New', 'eunice-core') ,
				'add_new_item' => sprintf(esc_html__('Add New %s', 'eunice-core' ), $testimonials),
				'edit' => esc_html__('Edit', 'eunice-core') ,
				'edit_item' => sprintf(esc_html__('Edit %s', 'eunice-core' ), $testimonials),
				'new_item' => sprintf(esc_html__('New %s', 'eunice-core' ), $testimonials),
				'view_item' => sprintf(esc_html__('View %s', 'eunice-core' ), $testimonials),
				'search_items' => sprintf(esc_html__('Search %s', 'eunice-core' ), $testimonials),
				'not_found' => esc_html__('Nothing found in the Database.', 'eunice-core') ,
				'not_found_in_trash' => esc_html__('Nothing found in Trash', 'eunice-core') ,
				'parent_item_colon' => ''
			) ,
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 10,
			'menu_icon' => 'dashicons-groups',
			'rewrite' => array(
				'slug' => $testimonial_slug,
				'with_front' => false
			),
			'has_archive' => true,
			'capability_type' => 'post',
			'hierarchical' => true,
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
				'revisions',
				'sticky',
			)
		)
	);
	// Testimonials - End

	// Team - Start
	$team_slug = 'team';
	$teams = esc_html__('Team', 'eunice-core');

	// Register custom post type - Team
	register_post_type('teams',
		array(
			'labels' => array(
				'name' => $teams,
				'singular_name' => sprintf(esc_html__('%s Post', 'eunice-core' ), $teams),
				'all_items' => sprintf(esc_html__('All %s', 'eunice-core' ), $teams),
				'add_new' => esc_html__('Add New', 'eunice-core') ,
				'add_new_item' => sprintf(esc_html__('Add New %s', 'eunice-core' ), $teams),
				'edit' => esc_html__('Edit', 'eunice-core') ,
				'edit_item' => sprintf(esc_html__('Edit %s', 'eunice-core' ), $teams),
				'new_item' => sprintf(esc_html__('New %s', 'eunice-core' ), $teams),
				'view_item' => sprintf(esc_html__('View %s', 'eunice-core' ), $teams),
				'search_items' => sprintf(esc_html__('Search %s', 'eunice-core' ), $teams),
				'not_found' => esc_html__('Nothing found in the Database.', 'eunice-core') ,
				'not_found_in_trash' => esc_html__('Nothing found in Trash', 'eunice-core') ,
				'parent_item_colon' => ''
			) ,
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 10,
			'menu_icon' => 'dashicons-businessman',
			'rewrite' => array(
				'slug' => $team_slug,
				'with_front' => false
			),
			'has_archive' => true,
			'capability_type' => 'post',
			'hierarchical' => true,
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
				'custom-fields',
			)
		)
	);
	// Registered
	// Team - End
}

// Gallery Slug
function eunice_custom_gallery_slug() {
	$gallery_cpt = (eunice_framework_active()) ? cs_get_option('theme_gallery_name') : '';
	if ($gallery_cpt === '') $gallery_cp = 'gallery';
  $rules = get_option( 'rewrite_rules' );
  if ( ! isset( $rules['('.$gallery_cpt.')/(\d*)$'] ) ) {
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
  }
}
add_action( 'cs_validate_save_after','eunice_custom_gallery_slug' );

// After Theme Setup
function eunice_custom_flush_rules() {
	// Enter post type function, so rewrite work within this function
	eunice_custom_post_type();
	// Flush it
	flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'eunice_custom_flush_rules');
add_action('init', 'eunice_custom_post_type');

// Avoid gallery post type as 404 page while it change
function vt_cpt_avoid_error_gallery() {
	$gallery_cpt = (eunice_framework_active()) ? cs_get_option('theme_gallery_name') : '';
	if ($gallery_cpt === '') $gallery_cp = 'gallery';
	$set = get_option('post_type_rules_flased_' . $gallery_cpt);
	if ($set !== true){
		flush_rewrite_rules(false);
		update_option('post_type_rules_flased_' . $gallery_cpt,true);
	}
}
add_action('init', 'vt_cpt_avoid_error_gallery');

// Add Filter by Category in Gallery Type
add_action('restrict_manage_posts', 'eunice_filter_gallery_categories');
function eunice_filter_gallery_categories() {
	global $typenow;
	$post_type = 'gallery'; // Gallery post type
	$taxonomy  = 'gallery_category'; // Gallery category taxonomy
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => sprintf(esc_html__("Show All %s", 'eunice-core'), $info_taxonomy->label),
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
}

// Gallery Search => ID to Term
add_filter('parse_query', 'eunice_gallery_id_term_search');
function eunice_gallery_id_term_search($query) {
	global $pagenow;
	$post_type = 'gallery'; // Gallery post type
	$taxonomy  = 'gallery_category'; // Gallery category taxonomy
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}

/* ---------------------------------------------------------------------------
 * Custom columns - Gallery
 * --------------------------------------------------------------------------- */
add_filter("manage_edit-gallery_columns", "eunice_gallery_edit_columns");
function eunice_gallery_edit_columns($columns) {
  $new_columns['cb'] = '<input type="checkbox" />';
  $new_columns['title'] = esc_html__('Title', 'eunice-core' );
  $new_columns['thumbnail'] = esc_html__('Image', 'eunice-core' );
  $new_columns['gallery_category'] = esc_html__('Categories', 'eunice-core' );
  $new_columns['gallery_order'] = esc_html__('Order', 'eunice-core' );
  $new_columns['date'] = esc_html__('Date', 'eunice-core' );

  return $new_columns;
}
add_action('manage_gallery_posts_custom_column', 'eunice_manage_gallery_columns', 10, 2);
function eunice_manage_gallery_columns( $column_name ) {
  global $post;

  switch ($column_name) {

    /* If displaying the 'Image' column. */
    case 'thumbnail':
      echo get_the_post_thumbnail( $post->ID, array( 100, 100) );
    break;

    /* If displaying the 'Categories' column. */
    case 'gallery_category' :

      $terms = get_the_terms( $post->ID, 'gallery_category' );

      if ( !empty( $terms ) ) {

        $out = array();
        foreach ( $terms as $term ) {
            $out[] = sprintf( '<a href="%s">%s</a>',
            	esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'gallery_category' => $term->slug ), 'edit.php' ) ),
            	esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'gallery_category', 'display' ) )
            );
        }
        /* Join the terms, separating them with a comma. */
        echo join( ', ', $out );
      }

      /* If no terms were found, output a default message. */
      else {
        echo '&macr;';
      }

    break;

    case "gallery_order":
      echo $post->menu_order;
    break;

    /* Just break out of the switch statement for everything else. */
    default :
      break;
    break;

  }
}

/* ---------------------------------------------------------------------------
 * Custom columns - Testimonial
 * --------------------------------------------------------------------------- */
add_filter("manage_edit-testimonial_columns", "eunice_testimonial_edit_columns");
function eunice_testimonial_edit_columns($columns) {
  $new_columns['cb'] = '<input type="checkbox" />';
  $new_columns['title'] = esc_html__('Title', 'eunice-core' );
  $new_columns['thumbnail'] = esc_html__('Image', 'eunice-core' );
  $new_columns['name'] = esc_html__('Client Name', 'eunice-core' );
  $new_columns['date'] = esc_html__('Date', 'eunice-core' );

  return $new_columns;
}

add_action('manage_testimonial_posts_custom_column', 'eunice_manage_testimonial_columns', 10, 2);
function eunice_manage_testimonial_columns( $column_name ) {
  global $post;

  switch ($column_name) {

    /* If displaying the 'Image' column. */
    case 'thumbnail':
      echo get_the_post_thumbnail( $post->ID, array( 100, 100) );
    break;

    case "name":
    	$testimonial_options = get_post_meta( get_the_ID(), 'testimonial_options', true );
      echo $testimonial_options['testi_name'];
    break;

    /* Just break out of the switch statement for everything else. */
    default :
      break;
    break;

  }
}

/* ---------------------------------------------------------------------------
 * Custom columns - Team
 * --------------------------------------------------------------------------- */
add_filter("manage_edit-team_columns", "eunice_team_edit_columns");
function eunice_team_edit_columns($columns) {
  $new_columns['cb'] = '<input type="checkbox" />';
  $new_columns['title'] = esc_html__('Title', 'eunice-core' );
  $new_columns['thumbnail'] = esc_html__('Image', 'eunice-core' );
  $new_columns['name'] = esc_html__('Job Position', 'eunice-core' );
  $new_columns['date'] = esc_html__('Date', 'eunice-core' );

  return $new_columns;
}

add_action('manage_team_posts_custom_column', 'eunice_manage_team_columns', 10, 2);
function eunice_manage_team_columns( $column_name ) {
  global $post;

  switch ($column_name) {

    /* If displaying the 'Image' column. */
    case 'thumbnail':
      echo get_the_post_thumbnail( $post->ID, array( 100, 100) );
    break;

    case "name":
    	$team_options = get_post_meta( get_the_ID(), 'team_options', true );
      echo $team_options['team_job_position'];
    break;

    /* Just break out of the switch statement for everything else. */
    default :
      break;
    break;

  }
}
