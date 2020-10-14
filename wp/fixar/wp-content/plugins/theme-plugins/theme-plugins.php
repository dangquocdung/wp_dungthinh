<?php
/***********************************

	Plugin Name:  Theme Plugins
	Plugin URI:   http://templines.com/
	Description:  Additional functionality for theme
	Version:      1.1
	Author:       Templines
	Author URI:   http://templines.com
	License:      GPLv2 or later	
	Text Domain:  tmpl
	Domain Path:  /languages/
	
***********************************/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // disable direct access
}

/** Register widget for brands */

add_action('plugins_loaded', 'tmpl_load_textdomain');
function tmpl_load_textdomain() {
	load_plugin_textdomain( 'tmpl', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}

require_once('theme-plugins-widgets.php');
require_once('shortcode.php');

function register_tmpl_custom_widget() {
	register_widget('Tmpl_Services_Widget');
	if (class_exists('YITH_WCBR')){
		register_widget( 'Tmpl_StaticBlock_Widget' );
	}
}
add_action( 'widgets_init', 'register_tmpl_custom_widget' );


if ( ! class_exists( 'TmplCustom' ) ) :

/************* STATICBLOCK ***************/

	class TmplCustom {
		
		static function tmpl_init(){
			$labels = array(
				'name'               => _x( 'Static Blocks', 'post type general name', 'tmpl' ),
				'singular_name'      => _x( 'Static Block', 'post type singular name', 'tmpl' ),
				'menu_name'          => _x( 'Static Blocks', 'admin menu', 'tmpl' ),
				'name_admin_bar'     => _x( 'Static Block', 'add new on admin bar', 'tmpl' ),
				'add_new'            => _x( 'Add New', 'book', 'tmpl' ),
				'add_new_item'       => __( 'Add New Block', 'tmpl' ),
				'new_item'           => __( 'New Block', 'tmpl' ),
				'edit_item'          => __( 'Edit Block', 'tmpl' ),
				'view_item'          => __( 'View Block', 'tmpl' ),
				'all_items'          => __( 'All Blocks', 'tmpl' ),
				'search_items'       => __( 'Search Block', 'tmpl' ),
				'parent_item_colon'  => __( 'Parent Block:', 'tmpl' ),
				'not_found'          => __( 'No blocks found.', 'tmpl' ),
				'not_found_in_trash' => __( 'No blocks found in Trash.', 'tmpl' )
			);
	
			$args = array(
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'staticblock' ),
				'capability_type'    => 'post',
				'has_archive'        => 'staticblocks',
				'hierarchical'       => false,
				'menu_position'      => 8,
				'supports'           => array( 'title', 'editor',  'thumbnail', 'page-attributes', 'comments' ),
				'menu_icon'			 => get_template_directory_uri() . "/images/pix-static.png"
			);
		
	
	        register_post_type( 'staticblocks', $args );


	        register_post_type( 'portfolio' ,
								array(
									'label' => __('Portfolio', 'tmpl'),
									'singular_label' => __('Portfolio', 'tmpl'),
									'exclude_from_search' => false,
									'publicly_queryable' => true,
									'menu_position' => null,
									'show_ui' => true,
									'public'  =>   true,
									'show_in_menu'  =>   true,
									'menu_icon'     =>   get_template_directory_uri() . '/images/pix-portfolio.png',
									'query_var' => true,
									'capability_type' => 'page',
									'has_archive'  => true,
									'hierarchical' => false,
									'edit_item' => __( 'Edit Work', 'tmpl'),
									'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'comments')
								)
							);

			register_taxonomy( 'portfolio_category',
								'portfolio',
								array( 'hierarchical' => true,
										'label' => __('Categories', 'tmpl'),
										'singular_label' => __('Category', 'tmpl'),
										'public' => true,
		                                'show_tagcloud' => false,
										'query_var' => true,
					                    'rewrite' => array('slug' => 'portfolio_category' , 'with_front' => false)
								)
							);

			add_filter('manage_edit-portfolio_columns', 'tmpl_portfolio_edit_columns');
			add_action('manage_posts_custom_column',  'tmpl_portfolio_custom_columns');

			function tmpl_portfolio_edit_columns($columns){
				$columns = array(
					'cb' => '<input type="checkbox" />',
					'title' => __('Title', 'tmpl'),
					'portfolio_image' => __('Featured Image', 'tmpl'),
					'id' => __('ID', 'tmpl'),
					'portfolio_category' => __('Category', 'tmpl'),
					'portfolio_description' => __('Description', 'tmpl'),

				);

				return $columns;
			}

			function tmpl_portfolio_custom_columns($column){
				global $post;
				switch ($column)
				{
					case "portfolio_category":
						echo get_the_term_list($post->ID, 'portfolio_category', '', ', ','');
						break;

					case 'id':
						echo $post->ID;
						break;

					case 'portfolio_description':
						the_excerpt();
						break;

					case 'portfolio_image':
						the_post_thumbnail('thumbnail');
						break;
				}
			}


			register_post_type( 'services' ,
								array(
									'label' => __('Services', 'tmpl'),
									'singular_label' => __('Service', 'tmpl'),
									'exclude_from_search' => false,
									'publicly_queryable' => true,
									'menu_position' => null,
									'show_ui' => true,
									'public'  =>   true,
									'show_in_menu'  =>   true,
									'menu_icon'     =>   get_template_directory_uri() . '/images/pix-service.png',
									'query_var' => true,
									'capability_type' => 'page',
									'hierarchical' => false,
									'edit_item' => __( 'Edit Work', 'tmpl'),
									'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'comments')
								)
							);

			register_taxonomy( 'services_category',
								'services',
								array( 'hierarchical' => true,
										'label' => __('Departments', 'tmpl'),
										'singular_label' => __('Department', 'tmpl'),
										'public' => true,
		                                'show_tagcloud' => false,
										'query_var' => true,
					                    'rewrite' => array('slug' => 'services_category')
								)
							);

			add_filter('manage_edit-services_columns', 'tmpl_services_edit_columns');
			add_action('manage_posts_custom_column',  'tmpl_services_custom_columns');

			function tmpl_services_edit_columns($columns){
				$columns = array(
					'cb' => '<input type="checkbox" />',
					'title' => __('Title', 'tmpl'),
					'services_image' => __('Featured Image', 'tmpl'),
					'services_category' => __('Department', 'tmpl'),
					'services_description' => __('Description', 'tmpl'),

				);

				return $columns;
			}

			function tmpl_services_custom_columns($column){
				global $post;
				switch ($column)
				{
					case "services_category":
						echo get_the_term_list($post->ID, 'services_category', '', ', ','');
						break;

					case 'services_description':
						the_excerpt();
						break;

					case 'services_image':
						the_post_thumbnail('thumbnail');
						break;
				}
			}

			add_filter('manage_edit-services_category_columns', 'tmpl_services_category_columns');
			add_filter('manage_services_category_custom_column', 'tmpl_services_category_custom_column', 10, 3);

			function tmpl_services_category_columns($columns){
				$columns = array(
					'cb' => '<input type="checkbox" />',
					'name' => __('Name', 'tmpl'),
				    'description' => __('Description', 'tmpl'),
					'slug' => __('Slug', 'tmpl'),
					'posts' => __('Count', 'tmpl'),
					'pix_serv_url' => __('Url', 'tmpl')
				);

				return $columns;
			}

			function tmpl_services_category_custom_column($c, $column_name, $term_id){

				$t_id = $term_id;
				$cat_meta = get_option("services_category_$t_id");
				switch ($column_name)
				{
					case "pix_serv_url":  ;
						echo esc_attr($cat_meta['pix_serv_url']);
						break;

					default:
		                break;
				}

			}

		}

	}
	
	if(!function_exists('pix_show_productpage_static_block')) {
			function pix_show_productpage_static_block() {
			    $product = get_post(get_the_ID());
				// Do not show this on variable products
				if ( $product->product_type <> 'variable' ) {
					$args = array(
						'post_type'        => 'staticblocks',
						'post_status'      => 'publish',
					);
					$staticBlocksData = get_posts( $args );
					foreach($staticBlocksData as $_block){
						$staticBlocks[$_block->ID] = $_block->post_title;
					}

					
					$staticblock = get_post_meta( $product->ID, '_static_bottom', true );
		
					echo '<div class="show_if_simple show_if_variable">';
					tmpl_wp_select_multiple( array( 
						'id' => '_static_bottom', 
						'label' => __( 'Static Block Description', 'tmpl' ), 
						'options' => $staticBlocks, 
						'name' => '_static_bottom[]',
						'desc_tip' => true, 
						'description' => __( 'Select the block to display at the bottom of the product page' , 'tmpl'),
						'value' => explode(",",$staticblock)
					) );
			
					echo '</div>';
				}
			}
		}
		
		
		if(!function_exists('tmpl_add_bottom_block_product')) {
			function tmpl_add_bottom_block_product() {
				$output = "";
				$product = get_post(get_the_ID());
				$staticblockIDs = get_post_meta( $product->ID, '_static_bottom', true );
				$staticblockIDsExploded = explode(',',$staticblockIDs);
				foreach($staticblockIDsExploded as $_staticblockID){
					if (!is_numeric($_staticblockID)) continue;
					$staticblock = get_post($_staticblockID);
					$output .= '<div class="container">' . apply_filters( 'the_content',$staticblock->post_content) . '</div>';
				}
				
				echo $output;
			}
		}
		
		
		
		if(!function_exists('tmpl_woocommerce_product_quick_edit_save')) {
			function tmpl_woocommerce_product_quick_edit_save($product_id){
				
				if ( isset( $_REQUEST['_static_bottom'] ) ){
					if (!get_post_meta( $product_id, '_static_bottom', true )){
						add_post_meta($product_id, '_static_bottom', wc_clean( implode(",",$_REQUEST['_static_bottom'] )));
					}else{
						update_post_meta( $product_id, '_static_bottom', wc_clean( implode(",",$_REQUEST['_static_bottom'] )) );	
					}
					
				}else{
					if (get_post_meta( $product_id, '_static_bottom', true )){
						update_post_meta( $product_id, '_static_bottom', wc_clean( "," ) );	
					}
				}
			}
		}
				
		
		
		
		if(!function_exists('tmpl_staticblocks_get')) {
		    function tmpl_staticblocks_get () {
		        $return_array = array();
		        $args = array( 'post_type' => 'staticblocks', 'posts_per_page' => 30);     
				$myposts = get_posts( $args );
		        $i=0;
		        foreach ( $myposts as $post ) {
		            $i++;
		            $return_array[$i]['label'] = get_the_title($post->ID);
		            $return_array[$i]['value'] = $post->ID;
		        } 
		        wp_reset_postdata();
		        return $return_array;
		    }
		}
		
		
		if(!function_exists('tmpl_staticblocks_show')) {
		    function tmpl_staticblocks_show ($id = false) {
		        echo tmpl_staticblocks_single($id);
		    }
		}
		
		
		if(!function_exists('tmpl_staticblocks_single')) {
		    function tmpl_staticblocks_single($id = false) {
		    	if(!$id) return;
		    	
		    	$output = false;
		    	
		    	$output = wp_cache_get( $id, 'tmpl_staticblocks_single' );
		    	
			    if ( !$output ) {
			   
			        $args = array( 'include' => $id,'post_type' => 'staticblocks', 'posts_per_page' => 1);
			        $output = '';
			        $myposts = get_posts( $args );
			        foreach ( $myposts as $post ) {
			        	setup_postdata($post);
						
			        	$output = do_shortcode(get_the_content($post->ID));
			        	
						$shortcodes_custom_css = get_post_meta( $post->ID, '_wpb_shortcodes_custom_css', true );
						if ( ! empty( $shortcodes_custom_css ) ) {
							$output .= '<style type="text/css" data-type="vc_shortcodes-custom-css">';
							$output .= $shortcodes_custom_css;
							$output .= '</style>';
						}
			        } 
			        wp_reset_postdata();
			        
			        wp_cache_add( $id, $output, 'tmpl_staticblocks_single' );
			    }
			    
		        return $output;
		   }
		}


add_action('admin_init', 'pix_category_custom_fields', 1);
function pix_category_custom_fields()
    {
		add_action( 'edited_services_category', 'pix_category_custom_fields_save');
		add_action( 'services_category_edit_form_fields', 'pix_category_custom_fields_form');
        add_action('services_category_add_form_fields', 'pix_category_custom_fields_add_form');
        add_action('created_services_category', 'pix_category_custom_fields_save');
    }

function pix_category_custom_fields_form($tag)
    {
        $t_id = $tag->term_id;
        $cat_meta = get_option("services_category_$t_id");
?>
        <tr class="form-field">
        	<th scope="row" valign="top"><label for="tag-pix_serv_title"><?php _e('Title', 'tmpl'); ?></label></th>
        	<td>
        		<input type="text" name="pix_serv_title" id="tag-pix_serv_title" size="25" style="width:60%;" value="<?php echo esc_attr($cat_meta['pix_serv_title']) ? esc_attr($cat_meta['pix_serv_title']) : ''; ?>">
        	</td>
        </tr>
        <tr class="form-field">
        	<th scope="row" valign="top"><label for="tag-pix_serv_add_title"><?php _e('Additional Title', 'tmpl'); ?></label></th>
            <td>
                <input type="text" name="pix_serv_add_title" id="tag-pix_serv_add_title" size="25" style="width:60%;" value="<?php echo esc_attr($cat_meta['pix_serv_add_title']) ? esc_attr($cat_meta['pix_serv_add_title']) : ''; ?>">
            </td>
        </tr>
        <tr class="form-field">
        	<th scope="row" valign="top"><label for="tag-pix_icon"><?php _e('Icon', 'tmpl'); ?></label></th>
        	<td>
        		<input type="text" name="pix_icon" id="tag-pix_icon" size="25" style="width:60%;" value="<?php echo esc_attr($cat_meta['pix_icon']) ? esc_attr($cat_meta['pix_icon']) : ''; ?>"><br />
                <span class="description"><?php _e('Icon class', 'tmpl'); ?></span>
            </td>
        </tr>
        <tr class="form-field">
        	<th scope="row" valign="top"><label for="tag-pix_image"><?php _e('Image', 'tmpl'); ?></label></th>
        	<td>
        	    <input type="text" name="pix_image" id="tag-pix_image" style="width:60%;" value="<?php echo isset($cat_meta['pix_image']) ? esc_url($cat_meta['pix_image']) : ''; ?>" />
	            <button data-input="tag-pix_image" class="btn pix-image-upload pix-btn-icon"><i class="fa fa-picture-o"></i></button>
	            <button type="button" class="btn pix-reset pix-btn-icon"><i class="fa fa-trash-o"></i></button>
	            <?php if(isset($cat_meta['pix_image']) && $cat_meta['pix_image']){ ?><p class="pix-bg"> <img src="<?php echo esc_url($cat_meta['pix_image']) ?>" alt="<?php esc_attr_e('Department Image', 'tmpl') ?>"> </p><?php } ?>
            </td>
        </tr>
        <tr class="form-field">
        	<th scope="row" valign="top"><label for="tag-pix_serv_url"><?php _e('Link', 'tmpl'); ?></label></th>
        	<td>
        		<input type="text" name="pix_serv_url" id="tag-pix_serv_url" size="25" style="width:60%;" value="<?php echo esc_attr($cat_meta['pix_serv_url']) ? esc_attr($cat_meta['pix_serv_url']) : ''; ?>"><br />
                <span class="description"><?php _e('Url', 'tmpl'); ?></span>
        	</td>
        </tr>
        <?php
    }

function pix_category_custom_fields_add_form($tag) {
?>
    <div class="form-field">
        <label for="tag-pix_serv_title"><?php _e('Title', 'tmpl'); ?></label>
        <input type="text" name="pix_serv_title" id="tag-pix_serv_title" size="40" value="">
    </div>
    <div class="form-field">
        <label for="tag-pix_serv_add_title"><?php _e('Additional Title', 'tmpl'); ?></label>
        <input type="text" name="pix_serv_add_title" id="tag-pix_serv_add_title" size="40" value="">
    </div>
    <div class="form-field">
        <label for="tag-pix_icon"><?php _e('Icon', 'tmpl'); ?></label>
        <input type="text" name="pix_icon" id="tag-pix_icon" size="40" value="">
        <br />
        <p><?php _e('Icon class', 'tmpl'); ?></p>
    </div>
    <div class="form-field">
        <label for="tag-pix_image"><?php _e('Image', 'tmpl'); ?></label>
        <input type="text" name="pix_image" id="tag-pix_image" value="">
        <button data-input="tag-pix_image" class="btn pix-image-upload pix-btn-icon"><i class="fa fa-picture-o"></i></button>
	    <button type="button" class="btn pix-reset pix-btn-icon"><i class="fa fa-trash-o"></i></button>
    </div>
    <div class="form-field">
        <label for="tag-pix_serv_url"><?php _e('Link', 'tmpl'); ?></label>
        <input type="text" name="pix_serv_url" id="tag-pix_serv_url" size="40" value="">
        <br />
        <p><?php _e('Url', 'tmpl'); ?></p>
    </div>

    <?php
}

function pix_category_custom_fields_save($term_id) {
    if (isset($_POST['pix_image']) || isset($_POST['pix_icon']) || isset($_POST['pix_serv_url'])) {
        $t_id = $term_id;
        $cat_meta = get_option("services_category_$t_id");
        if (isset($_POST['pix_image'])) {
			$cat_meta['pix_image'] = $_POST['pix_image'];
		}
		if (isset($_POST['pix_icon'])) {
			$cat_meta['pix_icon'] = $_POST['pix_icon'];
		}
		if (isset($_POST['pix_serv_url'])) {
			$cat_meta['pix_serv_url'] = $_POST['pix_serv_url'];
		}
		if (isset($_POST['pix_serv_title'])) {
			$cat_meta['pix_serv_title'] = $_POST['pix_serv_title'];
		}
		if (isset($_POST['pix_serv_add_title'])) {
			$cat_meta['pix_serv_add_title'] = $_POST['pix_serv_add_title'];
		}
        //save the option array
        update_option("services_category_$t_id", $cat_meta);
    }
}


function tmpl_post_type_link_filter_function( $post_link, $id = 0, $leavename = FALSE ) {
    if ( strpos('%portfolio_category%', $post_link)  < 0 ) {
      return $post_link;
    }
    $post = get_post($id);
    if ( !is_object($post) || $post->post_type != 'portfolio' ) {
      return $post_link;
    }
    $terms = wp_get_object_terms($post->ID, 'portfolio_category');
    if ( !$terms ) {
      return str_replace('portfolio/category/%portfolio_category%/', '', $post_link);
    }
    return str_replace('%portfolio_category%', $terms[0]->slug, $post_link);
}
  
add_filter('post_type_link', 'tmpl_post_type_link_filter_function', 1, 3);

function tmpl_services_link_filter_function( $post_link, $id = 0, $leavename = FALSE ) {
    if ( strpos('%services_category%', $post_link)  < 0 ) {
      return $post_link;
    }
    $post = get_post($id);
    if ( !is_object($post) || $post->post_type != 'services' ) {
      return $post_link;
    }
    $terms = wp_get_object_terms($post->ID, 'services_category');
    if ( !$terms ) {
      return str_replace('services/category/%services_category%/', '', $post_link);
    }
    return str_replace('%services_category%', $terms[0]->slug, $post_link);
}

add_filter('post_type_link', 'tmpl_services_link_filter_function', 1, 3);
		
endif;


add_action( 'init', array('TmplCustom','tmpl_init') );
add_action( 'woocommerce_product_options_advanced', 'pix_show_productpage_static_block', 55 );
add_action('save_post','tmpl_woocommerce_product_quick_edit_save');
add_action('woocommerce_after_single_product_summary','tmpl_add_bottom_block_product',15);


/************** Multiselect Field***************/
function tmpl_wp_select_multiple( $field ) {
    global $thepostid, $post, $woocommerce;

    $thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
    $field['class']         = isset( $field['class'] ) ? $field['class'] : 'select short';
    $field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
    $field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];
    $field['value']         = isset( $field['value'] ) ? $field['value'] : ( get_post_meta( $thepostid, $field['id'], true ) ? get_post_meta( $thepostid, $field['id'], true ) : array() );

    echo '<p class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label><select id="' . esc_attr( $field['id'] ) . '" name="' . esc_attr( $field['name'] ) . '" class="' . esc_attr( $field['class'] ) . '" multiple="multiple">';

    foreach ( $field['options'] as $key => $value ) {

        echo '<option value="' . esc_attr( $key ) . '" ' . ( in_array( $key, $field['value'] ) ? 'selected="selected"' : '' ) . '>' . esc_html( $value ) . '</option>';

    }

    echo '</select> ';

    if ( ! empty( $field['description'] ) ) {

        if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
            echo '<img class="help_tip" data-tip="' . esc_attr( $field['description'] ) . '" src="' . esc_url( WC()->plugin_url() ) . '/assets/images/help.png" height="16" width="16" />';
        } else {
            echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
        }

    }
    echo '</p>';
}
/********************************************/

add_action('init', 'tmpl_twitter_register');
function tmpl_twitter_register(){
	require_once( 'twitteroauth/twitteroauth.php' );
}

function pix_display_format($content){
	return do_shortcode($content);
}

function pix_activation_redirect( $plugin ) {
    if( $plugin == plugin_basename( __FILE__ ) ) {
        //exit( wp_redirect( admin_url( 'themes.php?page=adminpanel' ) ) );
    }
}
add_action( 'activated_plugin', 'pix_activation_redirect' );

/** Set custom VC directory */
global $vc_manager;

if ($vc_manager){
    $vc_manager->setCustomUserShortcodesTemplateDir(plugin_dir_path( __FILE__ ) . '/vc_templates');
}

function fixar_theme_is_loaded() {
    
    /** Meta Boxes */
    if (function_exists('fixar_get_option')){

        if(fixar_get_option('header_advanced_page', '0')){
            add_action( 'add_meta_boxes', 'fixar_header_set' );
            add_action( 'add_meta_boxes', 'fixar_header_style' );
            add_action( 'add_meta_boxes', 'fixar_header_elements' );
            add_action( 'add_meta_boxes', 'fixar_layout_fonts' );
            add_action( 'add_meta_boxes', 'fixar_header_responsive' );
        }
    }
}

add_action( 'after_setup_theme', 'fixar_theme_is_loaded' );



/********* HEADER SETTINGS ==> ***********/
add_action( 'add_meta_boxes', 'fixar_layout_side' );
function fixar_layout_side() {
	add_meta_box(
		'fixar_layout_side',
		esc_html__('Page Settings', 'fixar'),
		'fixar_layout_side_content',
		array('post', 'page', 'portfolio', 'services'),
		'side',
		'default'
	);
	
	fixar_posts_init();
}

function fixar_header_set() {
    add_meta_box(
        'fixar_header_set',
        esc_html__('Header', 'fixar'),
        'fixar_header_set_content',
        array('post', 'page', 'portfolio', 'services'),
        'side',
        'low'
    );
}

function fixar_header_style() {
    add_meta_box(
        'fixar_header_style',
        esc_html__('Header Style', 'fixar'),
        'fixar_header_style_content',
        array('post', 'page', 'portfolio', 'services'),
        'side',
        'low'
    );
}



function fixar_header_elements() {
    add_meta_box(
        'fixar_header_elements',
        esc_html__('Header Elements', 'fixar'),
        'fixar_header_elements_content',
        array('post', 'page', 'portfolio', 'services'),
        'side',
        'low'
    );
}

function fixar_header_responsive() {
    add_meta_box(
        'fixar_header_responsive',
        esc_html__('Header Responsive', 'fixar'),
        'fixar_header_responsive_content',
        array('post', 'page', 'portfolio', 'services'),
        'side',
        'low'
    );
}

function fixar_layout_fonts() {
    add_meta_box(
        'fixar_layout_fonts',
        esc_html__('Font Settings', 'fixar'),
        'fixar_layout_fonts_content',
        array('post', 'page', 'portfolio', 'services'),
        'side',
        'default'
    );
}

function fixar_posts_init(){
	if(class_exists( 'WooCommerce' )) {
		add_meta_box('woo_layout', esc_html__('Product Layout', 'fixar'), 'fixar_woo_layout', 'page', 'side', 'low');
	}
	add_meta_box('portfolio_layout_options', esc_html__('Portfolio Layout', 'fixar'), 'fixar_portfolio_layout_options', 'portfolio', 'side', 'low');
	add_meta_box('sidebar_options', esc_html__('Page Layout', 'fixar'), 'fixar_sidebar_options', array('post', 'page', 'portfolio', 'services'), 'side', 'low');
}
