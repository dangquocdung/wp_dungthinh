<?php
/************* LOAD REQUIRED SCRIPTS AND STYLES *************/
function pixchild_loadCss(){
    wp_enqueue_style('style', get_stylesheet_uri() );
    wp_enqueue_style('fixar', get_template_directory_uri() . '/style.css' );
}
add_action('wp_enqueue_scripts', 'pixchild_loadCss'); //Load All Css



/***   RENAME SERVICES 

function change_services_taxonomies_slug($args, $taxonomy) {
 if ( 'services_category' === $taxonomy ) {
      $args['rewrite']['slug'] = 'custom_category'; // <-- RENAME HERE
   }
  return $args;
}
add_filter( 'register_taxonomy_args', 'change_services_taxonomies_slug', 10, 2 );

add_action( 'admin_init', 'stores_url_rewrite' );
function stores_url_rewrite(){
         add_rewrite_rule("^locations/([^/]*)$",'index.php?stores=$matches[1]','top');
         flush_rewrite_rules();
}

add_filter( 'register_post_type_args', 'rename_post_type_slug', 10, 2 );
function rename_post_type_slug( $args, $post_type ) {

    if ( 'services' === $post_type ) {
        $args['rewrite']['slug'] = 'сustom_services';  // <-- RENAME HERE
    }
    return $args;
}


**/
