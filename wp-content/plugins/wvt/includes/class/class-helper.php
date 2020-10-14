<?php
/**
 * Helper
 *
 * @author Jegtheme
 * @since 1.0.0
 * @package wordpress-virtual-tour
 */

namespace WVT;

/**
 * Class Helper
 *
 * @package WVT
 */
class Helper {

	/**
	 * Helper constructor.
	 */
	public function __construct() {
		add_action( 'wp_ajax_wvt_find_tour', array( $this, 'find_tour' ) );
		add_action( 'wp_ajax_wvt_find_post', array( $this, 'find_post' ) );
		add_action( 'wp_ajax_wvt_find_map', array( $this, 'find_map' ) );
		add_action( 'wp_ajax_wvt_find_product', array( $this, 'find_product' ) );
		add_action( 'wp_ajax_wvt_get_post_option', array( $this, 'get_post_option' ) );

		add_action( 'wp_ajax_wvt_post_popup', array( $this, 'post_popup' ) );
		add_action( 'wp_ajax_nopriv_wvt_post_popup', array( $this, 'post_popup' ) );

		add_action( 'wp_ajax_wvt_product_popup', array( $this, 'product_popup' ) );
		add_action( 'wp_ajax_nopriv_wvt_product_popup', array( $this, 'product_popup' ) );

		add_action( 'wp_ajax_wvt_get_map', array( $this, 'get_map' ) );
		add_action( 'wp_ajax_nopriv_wvt_get_map', array( $this, 'get_map' ) );
	}

	/**
	 * Get Map
	 */
	public function get_map() {
		$post = get_post( $_POST['map_id'] );

		if ( $post && 'publish' === $post->post_status && 'panorama-map' === $post->post_type ) {
			wp_send_json_success( [
				'post_id' => $post->ID,
				'option'  => Helper::get_panorama_map_option( $post->ID )
			] );
		} else {
			wp_send_json_error();
		}
	}

	/**
	 * Ajax find tour
	 */
	public function find_tour() {
		$this->get_post( 'single-panorama' );
	}

	/**
	 * Ajax find post
	 */
	public function find_post() {
		$this->get_post( 'post' );
	}

	/**
	 * Ajax find map
	 */
	public function find_map() {
		$this->get_post( 'panorama-map' );
	}

	/**
	 * Ajax find product
	 */
	public function find_product() {
		$this->get_post( 'product' );
	}

	/**
	 * Get post list
	 *
	 * @param  string $post_type Post type
	 *
	 * @return array
	 */
	public static function get_post_list( $post_type ) {
		$query = new \WP_Query(
			array(
				'post_type'      => array( $post_type ),
				'posts_per_page' => - 1,
				'post_status'    => 'publish',
				'orderby'        => 'date',
				'order'          => 'DESC',
				'post__not_in'   => isset( $_GET['post'] ) ? array( $_GET['post'] ) : array()
			)
		);

		$result = array(
			0 => esc_html__( 'None', 'wvt' )
		);

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$result[ get_the_ID() ] = get_the_title();
			}
		}

		wp_reset_postdata();

		return $result;
	}

	/**
	 * Get post by query
	 *
	 * @param  string $type
	 */
	protected function get_post( $type ) {
		if ( isset( $_REQUEST['nonce'], $_REQUEST['query'] ) && wp_verify_nonce( sanitize_key( $_REQUEST['nonce'] ), 'wvt_get_post_option' ) ) {
			$query = sanitize_text_field( wp_unslash( $_REQUEST['query'] ) );

			add_filter( 'posts_where', function ( $where ) use ( $query ) {
				global $wpdb;
				$where .= $wpdb->prepare( "AND {$wpdb->posts}.post_title LIKE %s", '%' . $wpdb->esc_like( $query ) . '%' );

				return $where;
			} );

			$exclude = isset( $_REQUEST['exclude'] ) && $_REQUEST['exclude'] ? array( $_REQUEST['exclude'] ) : array();

			$query = new \WP_Query(
				array(
					'post_type'      => array( $type ),
					'posts_per_page' => '15',
					'post_status'    => 'publish',
					'orderby'        => 'date',
					'order'          => 'DESC',
					'post__not_in'   => $exclude
				)
			);

			$result = array();

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();

					$result[] = array(
						'value' => get_the_ID(),
						'text'  => get_the_title()
					);
				}
			}

			wp_reset_postdata();
			wp_send_json_success( $result );
		}
	}

	/**
	 * Render product popup
	 */
	public function product_popup() {
		if ( isset( $_REQUEST['id'] ) && $_REQUEST['id'] ) {

			if ( class_exists( 'WooCommerce' ) ) {
				$category = $rating_content = '';
				$product  = wc_get_product( $_REQUEST['id'] );
				$cat_id   = $product->get_category_ids();

				if ( $cat_id ) {
					$cat_id   = reset( $cat_id );
					$category = get_term( $cat_id, 'product_cat' );
					$category =
						'<div class="wvt-product-category">
	                        <span><a class="category-' . $category->slug . '" href="' . get_category_link( $cat_id ) . '">' . $category->name . '</a></span>
	                    </div>';
				}

				$atc_button = '';
				if ( isset( $_REQUEST['atc'] ) && $_REQUEST['atc'] ) {
					$atc_button = '<a data-id="' . $_REQUEST['id'] . '" class="wvt-product-atc" href="' . $product->get_permalink() . '" >'. esc_html__( 'Add To Cart', 'wvt' ) .'</a>';
				}

				$output =
					'<div class="wvt-product-popup">
						<div class="wvt-thumb">
		                    <a href="' . $product->get_permalink() . '">' . wp_get_attachment_image( $product->get_image_id(), 'thumbnail' ) . '</a>
		                </div>
	                	<div class="wvt-product-content">
	                		' . $category . '
	                		<h3 class="wvt-product-title">
		                        <a href="' . $product->get_permalink() . '">' . $product->get_title() . '</a>
		                    </h3>
		                    <div class="wvt-product-meta">
		                    	<div class="wvt-product-rating">
					    			' . wc_get_rating_html( $product->get_average_rating() ) . '
					    		</div>
					    		<div class="wvt-product-price">
					    			' . $product->get_price_html() . '
					    		</div>
					    		'. $atc_button .'
		                    </div>
	                	</div>
					</div>';
			} else {
				$output = esc_html__( 'WooCommerce is not Active.', 'wvt' );
			}

			wp_send_json_success( $output );
		}
	}

	/**
	 * Render post popup
	 */
	public function post_popup() {
		if ( isset( $_REQUEST['id'] ) && $_REQUEST['id'] ) {
			$post        = get_post( $_REQUEST['id'] );
			$author_url  = get_author_posts_url( $post->post_author );
			$author_name = get_the_author_meta( 'display_name', $post->post_author );
			$excerpt     = '';

			if ( $post->post_excerpt ) {
				$excerpt =
					'<div class="wvt-post-excerpt">
                    	<p>' . $post->post_excerpt . '</p>
                    </div>';
			}

			$output =
				'<div class="wvt-post-popup">
					<div class="wvt-thumb">
	                    <a href="' . get_the_permalink( $post ) . '">' . get_the_post_thumbnail( $post, 'thumbnail' ) . '</a>
	                </div>
                	<div class="wvt-post-content">
                		<div class="wvt-post-category">
	                        <span>' . wvt_primary_category( $post ) . '</span>
	                    </div>
	                    <h3 class="wvt-post-title">
	                        <a href="' . get_the_permalink( $post ) . '">' . $post->post_title . '</a>
	                    </h3>
	                    <div class="wvt-post-meta">
	                    	<div class="wvt-meta-author">
	                    		<span class="label">' . esc_html__( 'by', 'wvt' ) . '</span> <a href="' . $author_url . '">' . $author_name . '</a>
	                    	</div>
	                    	<div class="wvt-meta-date"><i class="fa fa-clock-o"></i> ' . get_the_date( null, $post ) . '</div>
	                    </div>
	                    ' . $excerpt . '
                	</div>
				</div>';

			wp_send_json_success( $output );
		}
	}

	/**
	 * Ajax get post option
	 */
	public function get_post_option() {
		if ( isset( $_REQUEST['nonce'], $_REQUEST['value'] ) && wp_verify_nonce( sanitize_key( $_REQUEST['nonce'] ), 'wvt_get_post_option' ) ) {

			$result = array();
			$values = explode( ',', $_REQUEST['value'] );

			foreach ( $values as $val ) {
				$result[] = array(
					'value' => $val,
					'text'  => get_the_title( $val )
				);
			}

			wp_reset_postdata();
			wp_send_json_success( $result );
		}
	}

	/**
	 * Get global option default setting
	 *
	 * @return array
	 */
	public static function get_global_option_default_setting() {
		return array(
			'context'     => esc_html__( 'Jegtheme', 'wvt' ),
			'context_url' => esc_url( 'http://jegtheme.com' ),
			'load_image'  => '',
			'load_scene'  => 'ball-pulse',
		);
	}

	public static function get_global_option() {
		return get_option( 'wvt', self::get_global_option_default_setting() );
	}

	/**
	 * Get default Setting
	 *
	 * @return array
	 */
	public static function get_option_default_setting() {
		return array(
			'title'                => 'Panorama',
			'type'                 => 'equirectangular',
			'equirectangular'      => '',
			'equirectangular_external' => 0,
			'cubemap'              => array(
				'back'   => '',
				'bottom' => '',
				'front'  => '',
				'left'   => '',
				'right'  => '',
				'top'    => '',
			),
			'coordinate'           => array(
				'pitch' => 0,
				'yaw'   => 0,
				'hfov'  => 100,
			),
			'height'               => array(
				'desktop' => 50,
				'tablet'  => 75,
				'mobile'  => 150,
			),
			'autorotate'           => '0',
			'autorotate_speed'     => 2,
			'autorotate_direction' => 'clockwise',
			'compass'              => '0',
			'north'                => 0,
			'zoom'                 => '1',
			'fullscreen'           => '1',
			'orientation'          => '0',
			'spotlist'             => '1',
			'enable_map'           => 0,
			'mapdimension'         => 25,
			'toolbar_scheme'       => 'default'
		);
	}

	/**
	 * Get Default Info Setting
	 *
	 * @return array
	 */
	public static function get_hotspot_default_setting() {
		return array(
			'title'             => esc_html__( 'Hotspot Title', 'wvt' ),
			'bgcolor'           => '#fff',
			'width'             => '26',
			'shape'             => 'circle',
			'icontype'          => 'icon',
			'icon'              => 'fa-map-pin',
			'badge'             => '5',
			'iconimage'         => '',
			'iconcolor'         => '#000',
			'iconsize'          => '18',
			'click'             => 'none',
			'url'               => '#',
			'video'             => '',
			'gallery'           => array(
				array(
					'src'  => '',
					'text' => ''
				)
			),
			'hover'             => 'none',
			'hovertheme'        => 'default',
			'hoverminwidth'     => 50,
			'hovermaxwidth'     => 300,
			'hovertext'         => '',
			'hoverposition'     => 'auto',
			'hoverlongposition' => array( 'top', 'right', 'bottom', 'left' ),
			'hovercontent'      => '',
			'coordinate'        => array(
				'pitch' => 0,
				'yaw'   => 0,
				'hfov'  => 100,
			)
		);
	}

	/**
	 * Get Default Tour Spot Setting
	 *
	 * @return array
	 */
	public static function get_tour_default_setting() {
		return array(
			'title'         => esc_html__( 'Tour Title', 'wvt' ),
			'bgcolor'       => '#fff',
			'width'         => '26',
			'shape'         => 'circle',
			'icontype'      => 'icon',
			'badge'         => '1',
			'icon'          => 'fa-map-marker',
			'iconimage'     => '',
			'iconcolor'     => '#000',
			'iconsize'      => '18',
			'spot'          => '',
			'hover'         => 'none',
			'hovertheme'    => 'default',
			'hoverminwidth' => 50,
			'hovermaxwidth' => 300,
			'hovertext'     => '',
			'hoverposition' => 'auto',
			'coordinate'    => array(
				'pitch' => 0,
				'yaw'   => 0,
				'hfov'  => 100,
			)
		);
	}

	/**
	 * Get Saved Panorama Option
	 *
	 * @return array
	 */
	public static function get_panorama_option( $post_id ) {
		$meta           = get_post_meta( $post_id, Single_Panorama::$metabox, true );
		$meta['option'] = self::normalize_setting( $meta['option'], Helper::get_option_default_setting() );

		// info
		if ( empty( $meta['hotspot'] ) ) {
			$meta['hotspot'] = array();
		}

		// tour
		if ( empty( $meta['tour'] ) ) {
			$meta['tour'] = array();
		}

		$meta['global'] = self::get_global_option();

		return $meta;
	}

	/**
	 * Normalize panorama setting
	 *
	 * @param array $setting Array setting.
	 * @param array $default Array of default setting.
	 *
	 * @return array
	 */
	public static function normalize_setting( $setting, $default ) {
		return wp_parse_args( $setting, $default );
	}


	/**
	 * Helper to turn Jeg Option to VC Element
	 *
	 * @param array $options Collection of Options.
	 * @param array $segments Collection of Segment.
	 *
	 * @return array
	 */
	public static function options_to_vc( $options, $segments ) {
		$settings = array();

		foreach ( $options as $key => $field ) {
			$setting = array();

			$setting['param_name']  = $key;
			$setting['type']        = $field['type'];
			$setting['heading']     = isset( $field['title'] ) ? $field['title'] : '';
			$setting['description'] = isset( $field['description'] ) ? $field['description'] : '';
			$setting['std']         = isset( $field['default'] ) ? $field['default'] : '';
			$setting['row_label']   = isset( $field['row_label'] ) ? $field['row_label'] : array();
			$setting['fields']      = isset( $field['fields'] ) ? $field['fields'] : array();
			$setting['priority']    = isset( $field['priority'] ) ? $field['priority'] : 10;
			$setting['group']       = $segments['name'];

			if ( 'select' === $setting['type'] ) {
				$setting['value'] = array_flip( call_user_func( $field['options'] ) );
			}

			if ( isset( $field['dependency'] ) ) {
				$value = $field['dependency'][0]['value'];
				if ( is_bool( $value ) ) {
					$value = $value ? 'true' : 'false';
				}

				$setting['dependency'] = array(
					'element' => $field['dependency'][0]['field'],
					'value'   => $value,
				);
			}

			$settings[] = $setting;
		}

		return $settings;
	}


	public static function get_panorama_option_default_setting() {
		return array(
			'title' => 'Panorama Map',
			'map'   => '',
		);
	}

	public static function get_panorama_map_option( $post_id ) {
		$meta           = get_post_meta( $post_id, Panorama_Map::$metabox, true );
		$meta['option'] = self::normalize_setting( $meta['option'], Helper::get_panorama_option_default_setting() );

		// info
		if ( empty( $meta['pin'] ) ) {
			$meta['pin'] = array();
		}

		return $meta;
	}

	public static function get_pin_default_setting() {
		return array(
			'top'   => 0,
			'left'  => 0,
			'color' => '#000',
			'size'  => 10
		);
	}
}
