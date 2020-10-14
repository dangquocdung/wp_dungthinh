<?php
/**
 * WVT Helper
 *
 * @since 1.0.0
 * @package wvt
 */

/**
 * Jlog value
 *
 * @param object $value Value need to be logged.
 */
if ( ! function_exists( 'jlog' ) ) {
	function jlog( $value ) {
		echo '<pre>';
		print_r( $value );
		echo '</pre>';
	}
}

/**
 * Add filter wp_kses_allowed_html
 */
if ( ! function_exists( 'wvt_allowed_html' ) ) {

	add_filter( 'wp_kses_allowed_html', 'wvt_allowed_html' );

	function wvt_allowed_html( $allowedtags ) {
		$allowedtags['a'] = [
			'href'   => true,
			'target' => true,
			'class'  => true,
		];

		return $allowedtags;
	}
}

/**
 * Ajax add to cart WooCommerce product
 */
if ( ! function_exists( 'wvt_woo_atc' ) ) {

	add_action('wp_ajax_wvt_atc', "wvt_woo_atc");
	add_action('wp_ajax_nopriv_wvt_atc', "wvt_woo_atc");

	function wvt_woo_atc() {
		if ( isset( $_POST['product'] ) && $_POST['product'] ) {
			$product = $_POST['product'];
			$cart    = WC()->cart;
			$cart->add_to_cart( $product );

			echo json_encode( [ 'success' => true ] );
			wp_die();
		}
	}
}


/**
 * Register activation hook
 *
 * @param string $file Plugin file path.
 */
if ( ! function_exists( 'wvt_activation_hook' ) ) {
	function wvt_activation_hook( $file ) {
		register_activation_hook( $file, function() {
			set_transient( '_dashboard_redirect', 1, 30 );
		} );
	}	
}

/**
 * Get coordinate field options
 *
 * @return array
 */
function wvt_coordinate_field_options() {
	return [
		'pitch' => esc_html__( 'Pitch', 'wvt' ),
		'yaw'   => esc_html__( 'Yaw', 'wvt' ),
		'hfov'  => esc_html__( 'Hfov', 'wvt' )
	];
}

/**
 * Get cubemap field options
 *
 * @return array
 */
function wvt_cubemap_field_options() {
	return [
		'front'  => esc_html__( 'Front', 'wvt' ),
		'back'   => esc_html__( 'Back', 'wvt' ),
		'left'   => esc_html__( 'Left', 'wvt' ),
		'right'  => esc_html__( 'Right', 'wvt' ),
		'top'    => esc_html__( 'Top', 'wvt' ),
		'bottom' => esc_html__( 'Bottom', 'wvt' )
	];
}

/**
 * Get deviceheight field options
 *
 * @return array
 */
function wvt_deviceheight_field_options() {
	return [
		'desktop' => esc_html__( 'Desktop', 'wvt' ),
		'tablet'  => esc_html__( 'Tablet', 'wvt' ),
		'mobile'  => esc_html__( 'Mobile', 'wvt' )
	];
}

/**
 * Get menu default value
 *
 * @param string $id Key of field option.
 * @param array $value Array of value.
 * @param mixed $default Default value for this item.
 *
 * @return mixed
 */
function wvt_field_get_value( $id, $value, $default ) {
	if ( isset( $value[ $id ] ) ) {
		return $value[ $id ];
	} else {
		return $default;
	}
}

/**
 * Get field option
 *
 * @param array $field Array of Fields.
 *
 * @return array
 */
function wvt_field_select_option( $field ) {
	$option = array();

	if ( isset( $field['options'] ) ) {
		if ( is_callable( $field['options'] ) ) {
			return call_user_func( $field['options'] );
		} elseif ( is_array( $field['options'] ) ) {
			return $field['options'];
		}
	}

	return $option;
}

/**
 * Prepare Field for WVT Field
 *
 * @param string $key key of this field.
 * @param array $field Field content.
 * @param array $additional Additonal Parameter.
 *
 * @return array
 */
function wvt_prepare_field( $key, $field, $additional = array() ) {
	$option = wvt_field_select_option( $field );

	$setting                = array();
	$setting['id']          = $key;
	$setting['fieldName']   = isset( $additional['fieldName'] ) ? $setting['segment'][ $additional['fieldName'] ] : $key;
	$setting['fieldID']     = isset( $additional['fieldID'] ) ? $additional['fieldID'] : $key;
	$setting['options']     = $option;
	$setting['disabled']    = isset( $field['disabled'] ) ? true : false;
	$setting['type']        = $field['type'];
	$setting['title']       = isset( $field['title'] ) ? $field['title'] : '';
	$setting['description'] = isset( $field['description'] ) ? $field['description'] : '';
	$setting['segment']     = isset( $field['segment'] ) ? $field['segment'] : '';
	$setting['default']     = isset( $field['default'] ) ? $field['default'] : '';
	$setting['choices']     = isset( $field['choices'] ) ? $field['choices'] : '';
	$setting['priority']    = isset( $field['priority'] ) ? $field['priority'] : 10;
	$setting['multiple']    = isset( $field['multiple'] ) ? $field['multiple'] : false;
	$setting['ajax']        = isset( $field['ajax'] ) ? $field['ajax'] : '';
	$setting['ajaxoptions'] = isset( $field['ajaxoptions'] ) ? $field['ajaxoptions'] : '';
	$setting['nonce']       = isset( $field['nonce'] ) ? $field['nonce'] : '';
	$setting['fields']      = isset( $field['fields'] ) ? $field['fields'] : array();
	$setting['row_label']   = isset( $field['row_label'] ) ? $field['row_label'] : array();
	$setting['dependency']  = isset( $field['dependency'] ) ? $field['dependency'] : array();
	$setting['delete']      = isset( $field['delete'] ) ? $field['delete'] : true;

	if ( 'coordinate' === $setting['type'] ) {
		$setting['options'] = wvt_coordinate_field_options();
	}

	if ( 'cubemap' === $setting['type'] ) {
		$setting['options'] = wvt_cubemap_field_options();
	}

	if ( 'deviceheight' === $setting['type'] ) {
		$setting['options'] = wvt_deviceheight_field_options();
	}

	return $setting;
}


/**
 * Check if string is json
 *
 * @param string $string string to check.
 *
 * @return bool
 */
function wvt_is_json( $string ) {
	if ( ! is_string( $string ) ) {
		return false;
	}

	json_decode( urldecode( $string ) );

	return ( JSON_ERROR_NONE === json_last_error() );
}


/**
 * Recursively Sanitize Input Field
 *
 * @param mixed $values Value to be sanitized.
 *
 * @return mixed
 */
function wvt_sanitize_input_field( $values ) {
	foreach ( $values as $key => $value ) {

		if ( is_object( $value ) ) {
			$value = (array) $value;
		}

		if ( is_array( $value ) ) {
			$values[ $key ] = wvt_sanitize_input_field( $value );
		} else {
			if ( preg_match( '/[+-]?([0-9]*[.])?[0-9]+/', $value ) ) {
				$values[ $key ] = $value;
			} elseif ( 'hovercontent' === $key ) {
				$values[ $key ] = $value;
			} else {
				$values[ $key ] = sanitize_text_field( $value );
			}
		}
	}

	return $values;
}

/**
 * Render pagination
 *
 * @param $args
 * @param $total_page
 *
 * @return mixed
 */
function wvt_paging_navigation( $args, $total_page ) {

	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$url_parts    = explode( '?', $pagenum_link );

	$defaults = array(
		'base'               => $pagenum_link,
		'total'              => $total_page,
		'current'            => isset( $_GET['paged'] ) && $_GET['paged'] ? $_GET['paged'] : 1,
		'show_all'           => false,
		'prev_next'          => true,
		'prev_text'          => esc_html__( 'Prev', 'wvt' ),
		'next_text'          => esc_html__( 'Next', 'wvt' ),
		'end_size'           => 1,
		'mid_size'           => 1,
		'type'               => 'plain',
		'add_args'           => array(),
		'add_fragment'       => '',
		'before_page_number' => '',
		'after_page_number'  => ''
	);

	$args = wp_parse_args( $args, $defaults );

	if ( ! is_array( $args['add_args'] ) ) {
		$args['add_args'] = array();
	}

	if ( isset( $url_parts[1] ) ) {
		$format_args  = $url_query_args = array();
		$format       = explode( '?', $args['base'] );
		$format_query = isset( $format[1] ) ? $format[1] : '';
		wp_parse_str( $format_query, $format_args );

		wp_parse_str( $url_parts[1], $url_query_args );

		foreach ( $format_args as $format_arg => $format_arg_value ) {
			unset( $url_query_args[ $format_arg ] );
		}

		$args['add_args'] = array_merge( $args['add_args'], urlencode_deep( $url_query_args ) );
	}

	$total = (int) $args['total'];

	if ( $total < 2 ) {
		return null;
	}

	$current  = (int) $args['current'];
	$end_size = (int) $args['end_size'];

	if ( $end_size < 1 ) {
		$end_size = 1;
	}

	$mid_size = (int) $args['mid_size'];

	if ( $mid_size < 0 ) {
		$mid_size = 2;
	}

	$add_args   = $args['add_args'];
	$r          = '';
	$page_links = array();
	$dots       = false;

	if ( $args['prev_next'] && $current && 1 < $current ) {
		$link = $current > 2 ? $args['base'] . '&paged=' . ( $current - 1 ) : $args['base'];

		if ( $add_args ) {
			$link = add_query_arg( $add_args, $link );
		}

		$link         .= $args['add_fragment'];
		$page_links[] = '<a class="page_nav prev" data-id="' . ( $current - 1 ) . '" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '">
							<span class="navtext">' . $args['prev_text'] . '</span>
						</a>';
	}

	for ( $n = 1; $n <= $total; $n ++ ) {
		if ( $n == $current ) {
			$page_links[] = '<span class="page_number active">' . $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number'] . '</span>';
			$dots         = true;
		} else {
			if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) {
				$link = $n != 1 ? $args['base'] . '&paged=' . $n : $args['base'];

				if ( $add_args ) {
					$link = add_query_arg( $add_args, $link );
				}

				$link         .= $args['add_fragment'];
				$page_links[] = '<a class="page_number" data-id="' . $n . '" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '">
									' . $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number'] .
				                '</a>';
				$dots         = true;
			} elseif ( $dots && ! $args['show_all'] ) {
				$page_links[] = '<span class="page_number dots">' . __( '&hellip;', 'wvt' ) . '</span>';
				$dots         = false;
			}
		}
	}

	if ( $args['prev_next'] && $current && ( $current < $total || - 1 == $total ) ) {
		$link = $args['base'] . '&paged=' . ( $current + 1 );

		if ( $add_args ) {
			$link = add_query_arg( $add_args, $link );
		}

		$link         .= $args['add_fragment'];
		$page_links[] = '<a class="page_nav next" data-id="' . ( $current + 1 ) . '" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '">
							<span class="navtext">' . $args['next_text'] . '</span>
						</a>';
	}

	switch ( $args['type'] ) {
		case 'array' :
			return $page_links;

		case 'list' :
			$r .= '<ul class="page-numbers">"\n\t"<li>';
			$r .= join( '</li>"\n\t"<li>', $page_links );
			$r .= '</li>"\n"</ul>"\n"';
			break;

		default :
			$nav_class = 'wvt_page' . $args['pagination_mode'];
			$nav_align = 'wvt_align' . $args['pagination_align'];
			$nav_text  = $args['pagination_navtext'] ? '' : 'no_navtext';
			$nav_info  = $args['pagination_pageinfo'] ? '' : 'no_pageinfo';

			$paging_text = sprintf( esc_html__( 'Page %s of %s', 'wvt' ), $current, $total );

			$r = join( "\n", $page_links );
			$r = '<div class="wvt_navigation wvt_pagination ' . $nav_class . ' ' . $nav_align . ' ' . $nav_text . ' ' . $nav_info . '">
	                <span class="page_info">' . $paging_text . '</span>
	                ' . $r . '
	            </div>';
			break;
	}

	return $r;
}


/**
 * Get all panorama post
 *
 * @param string $value ID separated with comma.
 *
 * @return array
 */
function wvt_get_panorama_posts() {
	$query = new \WP_Query( array(
		'post_type'      => 'single-panorama',
		'post_status'    => [ 'publish' ],
		'orderby'        => 'date',
		'order'          => 'DESC',
		'posts_per_page' => - 1,
	) );

	$result   = array();
	$result[] = '';

	foreach ( $query->posts as $post ) {
		$result[ $post->ID ] = $post->post_title;
	}

	return $result;
}

/**
 * Get primary category
 *
 * @param  int $post post ID
 *
 * @return int
 */
function wvt_get_primary_category( $post ) {
	if ( get_post_type( $post ) === 'post' ) {
		$categories = array_slice( get_the_category( $post ), 0, 1 );

		if ( empty( $categories ) ) {
			return null;
		}

		$category    = array_shift( $categories );
		$category_id = $category->term_id;

		return apply_filters( 'wvt_primary_category', $category_id, $post );
	}
}

/**
 * Render primary category
 *
 * @param  int $post post ID
 *
 * @return string
 */
function wvt_primary_category( $post ) {
	$cat_id   = wvt_get_primary_category( $post );
	$category = '';

	if ( $cat_id ) {
		$category = get_category( $cat_id );
		$class    = 'class="category-' . $category->slug . '"';
		$category = '<a href="' . get_category_link( $cat_id ) . '" ' . $class . '>' . $category->name . '</a>';
	}

	return $category;
}

/**
 * Sanitize output
 *
 * @param $output
 *
 * @return mixed
 */
function wvt_sanitize_output( $output ) {
	return $output;
}

/**
 * Duplicate panorama
 *
 * @param $id
 */
function wvt_duplicate_panorama( $id ) {
	global $wpdb;

	$post            = get_post( $id );
	$current_user    = wp_get_current_user();
	$new_post_author = $current_user->ID;

	if ( isset( $post ) && $post != null ) {

		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'publish',
			'post_title'     => $post->post_title . ' ' . esc_html__( 'Clone', 'wvt' ),
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);

		$new_post_id = wp_insert_post( $args );

		$post_meta_infos = $wpdb->get_results( "SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$id" );
		if ( count( $post_meta_infos ) != 0 ) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ( $post_meta_infos as $meta_info ) {
				$meta_key = $meta_info->meta_key;
				if ( $meta_key == '_wp_old_slug' ) {
					continue;
				}
				$meta_value      = addslashes( $meta_info->meta_value );
				$sql_query_sel[] = "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query .= implode( " UNION ALL ", $sql_query_sel );
			$wpdb->query( $sql_query );
		}
	}
}
