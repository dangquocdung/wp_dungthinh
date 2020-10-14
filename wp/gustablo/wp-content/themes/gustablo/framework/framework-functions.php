<?php
/**
 * Framework functions
 *
 * @package gustablo
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return class for reploader
function wprt_preloader_class() {
	// Get preloader option from theme mod
	$class = wprt_get_mod( 'preloader', 'animsition' );

	// Return classes for element
	return esc_attr( $class );
}

// Return classes for elements
function wprt_element_classes( $elm ) {
	// Get element style from theme mod
	$style = wprt_get_mod( $elm, 'style-1' );

	// Return classes for element
	return esc_attr( $style );
}

// Return background style for elements
function wprt_background_css( $bg ) {
	// Define vars
	$css = '';
	$bg_style = $bg .'_style';

	if ( $bg_img = wprt_get_mod( $bg, null ) ) {
		$css .= 'background-image: url('. esc_url( $bg_img ). ');';
	}

	if ( $bg_style = wprt_get_mod( $bg_style ) ) {
		if ( 'fixed' == $bg_style ) {
			$css .= ' background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;';
		} elseif ( 'fixed-top' == $bg_style ) {
			$css .= ' background-position: center top; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;';
		} elseif ( 'fixed-bottom' == $bg_style ) {
			$css .= ' background-position: center bottom; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;';
		} elseif ( 'cover' == $bg_style ) {
			$css .= ' background-repeat: no-repeat; background-position: center center; background-size: cover;';
		} elseif ( 'center-top' == $bg_style ) {
			$css .= ' background-repeat: no-repeat; background-position: center top;';
		} elseif ( 'repeat' == $bg_style ) {
			$css .= ' background-repeat: repeat;';
		} elseif ( 'repeat-x' == $bg_style ) {
			$css .= ' background-repeat: repeat-x;';
		} elseif ( 'repeat-y' == $bg_style ) {
			$css .= ' background-repeat: repeat-y;';
		}
	}

	return esc_attr( $css );
}

// Return search header
function wprt_header_search() {
	?>
	<div id="header-search">
		<a class="header-search-icon" href="#"><span class="search-icon gustablo-magnifier3"></span></a>
    	<form role="search" method="get" class="header-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label class="screen-reader-text"><?php esc_html_e('Search for:', 'gustablo'); ?></label>
			<input type="text" value="<?php the_search_query(); ?>" name="s" class="header-search-field" placeholder="<?php esc_attr_e('SEARCH...', 'gustablo'); ?>" />
			<button type="submit" class="header-search-submit" title="<?php esc_attr_e('Search', 'gustablo'); ?>">
				<?php esc_html_e('Search', 'gustablo'); ?>
			</button>

			<!-- <input type="hidden" name="post_type" value="product" /> -->
			<input type="hidden" name="post_type" value="post" />
		</form>
	</div><!-- /#header-search -->
	<?php
}

// Return cart header
function wprt_header_cart() {
	if ( class_exists( 'woocommerce' ) ) : ?>
        <div class="nav-top-cart-wrapper">
            <a class="nav-cart-trigger" href="<?php echo esc_url( wc_get_cart_url() ) ?>">
            	<span class="cart-icon gustablo-shop">
                <?php if ( $items_count = WC()->cart->get_cart_contents_count() ): ?>
                    <span class="shopping-cart-items-count"><?php echo esc_html( $items_count ) ?></span>
                <?php else: ?>
                    <span class="shopping-cart-items-count">0</span>
                <?php endif ?>
                </span>
            </a>

            <div class="nav-shop-cart">
                <div class="widget_shopping_cart_content">
                    <?php woocommerce_mini_cart() ?>
                </div>
            </div>
        </div><!-- /.nav-top-cart-wrapper -->
	<?php endif;
}

// Remove products and pages results from the search form widget
function wprt_custom_search_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() )
		return;

	if ( isset( $_GET['post_type'] ) && ( $_GET['post_type'] == 'product' ) )
		return;

	if ( $query->is_search() ) {
    	$in_search_post_types = get_post_types( array( 'exclude_from_search' => false ) );

	    $post_types_to_remove = array( 'product' );

	    foreach ( $post_types_to_remove as $post_type_to_remove ) {
			if ( is_array( $in_search_post_types ) 
				&& in_array( $post_type_to_remove, $in_search_post_types ) 
			) {
				unset( $in_search_post_types[ $post_type_to_remove ] );
				$query->set( 'post_type', $in_search_post_types );
			}
	    }
	}
}
add_action( 'pre_get_posts', 'wprt_custom_search_query' );

function wprt_woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();

	if ( class_exists( 'woocommerce' ) ) : ?>
		<a class="cart-info" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php echo esc_attr__('View your shopping cart', 'gustablo'); ?>"><?php echo sprintf( _n( '%d item', '%d items', WC()->cart->cart_contents_count, 'gustablo' ), WC()->cart->cart_contents_count); ?> <?php echo WC()->cart->get_cart_total(); ?></a>
	<?php endif;

	$fragments['a.cart-info'] = ob_get_clean();
	
	return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'wprt_woocommerce_header_add_to_cart_fragment');

// Featured Title Heading classes
function wprt_feature_title_heading_classes() {
	// Define classes
	$classes = '';

	// Get topbar style
	if ( wprt_get_mod( 'featured_title_heading_shadow' ) ) {
		$classes .= 'has-shadow';
	}

	// Return classes
	return esc_attr( $classes );
}

// Get layout position for pages
function wprt_layout_position() {
	// Default layout position
	$layout = 'sidebar-right';

	// Get layout position for site
	$layout = wprt_get_mod( 'site_layout_position', 'sidebar-right' );

	// Get layout position for single post
	if ( is_singular( 'post' ) )
		$layout = wprt_get_mod('single_post_layout_position', 'sidebar-right');

	// Single post/page can have custom layout position
	if ( is_singular() && wprt_metabox('page_layout') )
		$layout = wprt_metabox('page_layout');

	// Get layout position for shop pages
	if ( class_exists( 'woocommerce' ) ) {
		if ( is_shop() || is_product_category() ) $layout = wprt_get_mod('shop_layout_position', 'no-sidebar');  
		if ( is_singular( 'product' ) ) $layout = wprt_get_mod('shop_single_layout_position', 'no-sidebar');
	}

	return $layout;
}

// Render favicon icon to head tag
function wprt_site_icon() {
	if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
		if ( $favicon = wprt_get_mod( 'favicon' ) ) {
			echo '<link rel="shortcut icon" href="'. esc_url( $favicon ) .'" type="image/x-icon">';
		}
	}
}
add_action( 'wp_head', 'wprt_site_icon' );

// Outputs custom CSS to the footer
add_action( 'get_footer', 'wprt_custom_css', 999 );
function wprt_custom_css( $output = NULL ) {
	// Add filter for adding custom css via other functions
	$output = apply_filters( 'wprt_footer_css', $output );

	wp_register_style( 'css-footer', false );
	wp_enqueue_style( 'css-footer' );
	wp_add_inline_style( 'css-footer', $output );
}

// Sets the content width in pixels, based on the theme's design and stylesheet.
function wprt_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wprt_content_width', 1170 );
}
add_action( 'after_setup_theme', 'wprt_content_width', 0 );

// Modifies tag cloud widget arguments to have all tags in the widget same font size.
function wprt_widget_tag_cloud_args( $args ) {
	$args['largest'] = 0.734;
	$args['smallest'] = 0.734;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'wprt_widget_tag_cloud_args' );

// Custom classes to body tag
function wprt_body_classes() {
	$classes[] = '';

	// Get top-bar style
	$top_bar_style = wprt_get_mod( 'top_bar_site_style', 'style-4' );
	if ( is_page() && wprt_metabox('top_bar_style') )
		$top_bar_style = wprt_metabox('top_bar_style');
	$classes[] = 'top-bar-'. $top_bar_style;

	// Header fixed
	if ( wprt_get_mod( 'header_fixed', false ) )
		$classes[] = 'header-fixed';

	// Get layout position
	$classes[] = wprt_layout_position();

	// Get layout style
	$layout_style = wprt_get_mod( 'site_layout_style', 'full-width' );
	$classes[] = 'site-layout-'. $layout_style;

	// Get header style
	$header_style = wprt_get_mod( 'header_site_style', 'style-4' );
	if ( is_page() && wprt_metabox('header_style') )
		$header_style = wprt_metabox('header_style');
	$classes[] = 'header-'. $header_style;

	// Get menu item current style
	$cur_menu_style = wprt_get_mod( 'menu_link_current', 'cur-menu-1' );
	if ( $header_style == 'style-2' ) $cur_menu_style = wprt_get_mod( 'menu_two_link_current', 'cur-menu-1' );
	if ( $header_style == 'style-3' ) $cur_menu_style = wprt_get_mod( 'menu_three_link_current', 'cur-menu-1' );
	if ( $header_style == 'style-4' ) $cur_menu_style = wprt_get_mod( 'menu_four_link_current', 'cur-menu-1' );
	$classes[] = $cur_menu_style;

	if ( is_page() ) $classes[] = 'is-page';

	if ( ( is_page() && wprt_metabox('hide_padding_content') )
		|| ( is_singular('project') && wprt_metabox('hide_padding_content') )
		)
		$classes[] = 'no-padding-content';

	// Add classes for Woo pages
	if ( wprt_is_woocommerce_page() )
		$classes[] = 'woocommerce-page';

	if ( wprt_is_woocommerce_shop() || wprt_is_woocommerce_archive_product() ) {
		$shop_cols = wprt_get_mod( 'shop_columns', '3' );
		$classes[] = 'shop-col-'. $shop_cols;
	}

	// Boxed Layout dropshadow
	if ( 'boxed' == $layout_style && wprt_get_mod( 'site_layout_boxed_shadow' ) )
		$classes[] = 'box-shadow';

	if ( wprt_get_mod( 'header_search_icon' ) )
		$classes[] = 'menu-has-search';

	if ( wprt_get_mod( 'header_cart_icon' ) )
		$classes[] = 'menu-has-cart';	

	if ( is_singular( 'gallery' ) )
		$classes[] = 'page-single-gallery';

	// Custom Date Blog
	if ( wprt_get_mod( 'blog_custom_date', false ) )
		$classes[] = 'blog-has-date';

	// Return classes
	return $classes;
}
add_filter( 'body_class', 'wprt_body_classes' );

// Change default read more style
function wprt_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'wprt_excerpt_more', 10 );

// Custom excerpt length for posts
function wprt_content_length() {
	$length = wprt_get_mod( 'blog_excerpt_length', '46' );

	if ( is_page_template( 'templates/page-blog-grid.php' ) )
		$length = wprt_get_mod( 'blog_excerpt_length_grid', '17' );

	if ( is_page_template( 'templates/page-blog-list.php' ) )
		$length = wprt_get_mod( 'blog_excerpt_length_list', '29' );

	return $length;
}
add_filter( 'excerpt_length', 'wprt_content_length', 999 );

// Prevent page scroll when clicking the more link
function wprt_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'wprt_remove_more_link_scroll' );

// Remove read-more link so we can custom it
function wprt_remove_read_more_link() {
    return '';
}
add_filter( 'the_content_more_link', 'wprt_remove_read_more_link' );

// Returns blog entry blocks
function wprt_blog_entry_layout_blocks() {

	// Get layout blocks
	$blocks = wprt_get_mod( 'blog_entry_composer' );

	// If blocks are 100% empty return defaults
	$blocks = $blocks ? $blocks : 'title,meta,excerpt_content,readmore';

	// Convert blocks to array so we can loop through them
	if ( ! is_array( $blocks ) ) {
		$blocks = explode( ',', $blocks );
	}

	// Set block keys equal to vals
	$blocks = array_combine( $blocks, $blocks );

	// Return blocks
	return $blocks;
}

// Render meta blog bar
function wprt_entry_meta() {
	// Get meta items from theme mod
	$meta_item = wprt_get_mod( 'blog_entry_meta_items', array( 'date' ) );

	// If blocks are 100% empty return defaults
	$meta_item = $meta_item ? $meta_item : 'date';

	// Turn into array if string
	if ( $meta_item && ! is_array( $meta_item ) ) {
		$meta_item = explode( ',', $meta_item );
	}

	// Set keys equal to values
	$meta_item = array_combine( $meta_item, $meta_item );

	// Loop through items
	foreach ( $meta_item as $item ) :
		if ( 'author' == $item ) { 
			printf( '<span class="post-by-author item"><span class="inner">By <a href="%s" title="%s" rel="author">%s</a></span></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( esc_html__( 'View all posts by %s', 'gustablo' ), get_the_author() ) ),
				get_the_author()
				);
		}
		elseif ( 'date' == $item ) {
			printf( '<span class="post-date item"><span class="inner"><span class="entry-date">%1$s</span></span></span>',
				get_the_date()
			);
		}
		elseif ( 'comments' == $item ) {
			if ( comments_open() || get_comments_number() ) {
				echo '<span class="post-comment item"><span class="inner">';
				comments_popup_link( esc_html__( '0 comment', 'gustablo' ), esc_html__( '1 Comment', 'gustablo' ), esc_html__( '% Comments', 'gustablo' ) );
				echo '</span></span>';
			}
		}
		elseif ( 'categories' == $item ) {
			echo '<span class="post-meta-categories item"><span class="inner">';
			the_category( ', ', get_the_ID() );
			echo '</span></span>';
		}
	endforeach;
}

// Returns correct Google Fonts URL if you want to change it to another CDN
function wprt_get_google_fonts_url() {
	return esc_url( apply_filters( 'wprt_get_google_fonts_url', '//fonts.googleapis.com' ) );
}

// Minify CSS
function wprt_minify_css( $css = '' ) {
	// Return if no CSS
	if ( ! $css ) return;

	// Normalize whitespace
	$css = preg_replace( '/\s+/', ' ', $css );

	// Remove ; before }
	$css = preg_replace( '/;(?=\s*})/', '', $css );

	// Remove space after , : ; { } */ >
	$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );

	// Remove space before , ; { }
	$css = preg_replace( '/ (,|;|\{|})/', '$1', $css );

	// Strips leading 0 on decimal values (converts 0.5px into .5px)
	$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );

	// Strips units if value is 0 (converts 0px to 0)
	$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

	// Trim
	$css = trim( $css );

	// Return minified CSS
	return $css;
}

// Get post meta, using rwmb_meta() function from Meta Box class
function wprt_metabox( $key, $args = array(), $post_id = null ) {
    if ( ! function_exists( 'rwmb_meta' ) )
      	return false;
    return rwmb_meta( $key, $args, $post_id );
}

// Navigation fallback
function wprt_menu_fallback() {
	printf( '
		<a  class="menu-fallback" href="%1$s">%2$s</a>',
		esc_url( admin_url( 'nav-menus.php' ) ),
		esc_html__( 'Create a Menu', 'gustablo' )
	);
}

// Render numeric pagination
function wprt_pagination( $query = '', $echo = true ) {
	
	// Arrows with RTL support
	$prev_arrow = 'prev-arrow arrow';
	$next_arrow = 'next-arrow arrow';
	
	// Get global $query
	if ( ! $query ) {
		global $wp_query;
		$query = $wp_query;
	}

	// Set vars
	$total  = $query->max_num_pages;
	$big    = 999999999;

	// Display pagination
	if ( $total > 1 ) {

		// Get current page
		if ( $current_page = get_query_var( 'paged' ) ) {
			$current_page = $current_page;
		} elseif ( $current_page = get_query_var( 'page' ) ) {
			$current_page = $current_page;
		} else {
			$current_page = 1;
		}

		// Get permalink structure
		if ( get_option( 'permalink_structure' ) ) {
			if ( is_page() ) {
				$format = 'page/%#%/';
			} else {
				$format = '/%#%/';
			}
		} else {
			$format = '&paged=%#%';
		}

		$args = array(
			'base'      => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
			'format'    => $format,
			'current'   => max( 1, $current_page ),
			'total'     => $total,
			'mid_size'  => 3,
			'type'      => 'list',
			'prev_text' => '<span class="'. $prev_arrow .'"></span>',
			'next_text' => '<span class="'. $next_arrow .'"></span>',
		);

		// Output pagination
		if ( $echo ) {
			echo '<div class="wprt-pagination clearfix"><div class="inner">'. paginate_links( $args ) .'</div></div>';
		} else {
			return '<div class="wprt-pagination clearfix"><div class="inner">'. paginate_links( $args ) .'</div></div>';
		}

	}
}

// Returns array of Social Options for the Top Bar
function wprt_topbar_social_options() {
	return apply_filters ( 'wprt_topbar_social_options', array(
		'facebook' => array(
			'label' => esc_html__( 'Facebook', 'gustablo' ),
			'icon_class' => 'gustablo-facebook',
		),
		'twitter' => array(
			'label' => esc_html__( 'Twitter', 'gustablo' ),
			'icon_class' => 'gustablo-twitter',
		),
		'youtube' => array(
			'label' => esc_html__( 'Youtube', 'gustablo' ),
			'icon_class' => 'gustablo-youtube',
		),
		'vimeo' => array(
			'label' => esc_html__( 'Vimeo', 'gustablo' ),
			'icon_class' => 'gustablo-vimeo',
		),
		'tumblr'  => array(
			'label' => esc_html__( 'Tumblr', 'gustablo' ),
			'icon_class' => 'gustablo-tumblr',
		),
		'pinterest'  => array(
			'label' => esc_html__( 'Pinterest', 'gustablo' ),
			'icon_class' => 'gustablo-pinterest',
		),
		'linkedin'  => array(
			'label' => esc_html__( 'LinkedIn', 'gustablo' ),
			'icon_class' => 'gustablo-linkedin',
		),
		'instagram'  => array(
			'label' => esc_html__( 'Instagram', 'gustablo' ),
			'icon_class' => 'gustablo-instagram',
		),
		'skype' => array(
			'label' => esc_html__( 'Github', 'gustablo' ),
			'icon_class' => 'gustablo-github',
		),
		'Apple' => array(
			'label' => esc_html__( 'Apple', 'gustablo' ),
			'icon_class' => 'gustablo-apple',
		),
		'android' => array(
			'label' => esc_html__( 'Android', 'gustablo' ),
			'icon_class' => 'gustablo-android',
		),
		'behance'  => array(
			'label' => esc_html__( 'Behance', 'gustablo' ),
			'icon_class' => 'gustablo-behance',
		),
		'dribbble' => array(
			'label' => esc_html__( 'Dribbble', 'gustablo' ),
			'icon_class' => 'gustablo-dribbble',
		),
		'flickr'  => array(
			'label' => esc_html__( 'Flickr', 'gustablo' ),
			'icon_class' => 'gustablo-flickr',
		),

		'paypal'  => array(
			'label' => esc_html__( 'Paypal', 'gustablo' ),
			'icon_class' => 'gustablo-paypal',
		),
		'soundcloud'  => array(
			'label' => esc_html__( 'Soundcloud', 'gustablo' ),
			'icon_class' => 'gustablo-soundcloud',
		),
		'spotify'  => array(
			'label' => esc_html__( 'Spotify', 'gustablo' ),
			'icon_class' => 'gustablo-spotify',
		),
	) );
}

// Display or get post image
function wprt_get_image( $args = array() ) {
	$default =  array(
		'post_id'  => get_the_ID(),
		'size'     => 'thumbnail',
		'format'   => 'html', // html or src
		'attr'     => '',
		'meta_key' => '',
		'scan'     => true,
		'default'  => '',
	);

	$args = wp_parse_args( $args, $default );

	if ( ! $args['post_id'] )
		$args['post_id'] = get_the_ID();

	// Get image from cache
	$key = md5( serialize( $args ) );
	$image_cache = wp_cache_get( $args['post_id'], 'wprt_get_image' );

	if ( ! is_array( $image_cache ) )
		$image_cache = array();

	if ( empty( $image_cache[$key] ) ) {
		// Get post thumbnail
		if ( has_post_thumbnail( $args['post_id'] ) ) {
			$id = get_post_thumbnail_id();
			$html = wp_get_attachment_image( $id, $args['size'], false, $args['attr'] );
			list( $src ) = wp_get_attachment_image_src( $id, $args['size'], false, $args['attr'] );
		}

		// Get the first image in the custom field
		if ( ! isset( $html, $src ) && $args['meta_key'] ) {
			$id = get_post_meta( $args['post_id'], $args['meta_key'], true );

			// Check if this post has attached images
			if ( $id ) {
				$html = wp_get_attachment_image( $id, $args['size'], false, $args['attr'] );
				list( $src ) = wp_get_attachment_image_src( $id, $args['size'], false, $args['attr'] );
			}
		}

		// Get the first attached image
		if ( ! isset( $html, $src ) ) {
			$image_ids = array_keys( get_children( array(
				'post_parent'    => $args['post_id'],
				'post_type'	     => 'attachment',
				'post_mime_type' => 'image',
				'orderby'        => 'menu_order',
				'order'	         => 'ASC',
			) ) );

			// Check if this post has attached images
			if ( ! empty( $image_ids ) ) {
				$id = $image_ids[0];
				$html = wp_get_attachment_image( $id, $args['size'], false, $args['attr'] );
				list( $src ) = wp_get_attachment_image_src( $id, $args['size'], false, $args['attr'] );
			}
		}

		// Get the first image in the post content
		if ( ! isset( $html, $src ) && ( $args['scan'] ) ) {
			preg_match( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', get_post_field( 'post_content', $args['post_id'] ), $matches );

			if ( !empty( $matches ) ) {
				$html = $matches[0];
				$src = $matches[1];
			}
		}

		// Use default when nothing found
		if ( ! isset( $html, $src ) && !empty( $args['default'] ) ) {
			if ( is_array( $args['default'] ) ) {
				$html = $args['html'];
				$src = $args['src'];
			} else {
				$html = $src = $args['default'];
			}
		}

		// Still no images found?
		if ( ! isset( $html, $src ) )
			return false;

		$output = 'html' === strtolower( $args['format'] ) ? $html : $src;

		$image_cache[$key] = $output;
		wp_cache_set( $args['post_id'], $image_cache, 'wprt_get_image' );
	}
	// If image already cached
	else {
		$output = $image_cache[$key];
	}

	$output = apply_filters( 'wprt_get_image', $output, $args );

	return $output;
}

// Check if it is WooCommerce Page
function wprt_is_woocommerce_page() {
    if ( function_exists ( "is_woocommerce" ) && is_woocommerce() )
		return true;

    $woocommerce_keys = array (
    	"woocommerce_shop_page_id" ,
        "woocommerce_terms_page_id" ,
        "woocommerce_cart_page_id" ,
        "woocommerce_checkout_page_id" ,
        "woocommerce_pay_page_id" ,
        "woocommerce_thanks_page_id" ,
        "woocommerce_myaccount_page_id" ,
        "woocommerce_edit_address_page_id" ,
        "woocommerce_view_order_page_id" ,
        "woocommerce_change_password_page_id" ,
        "woocommerce_logout_page_id" ,
        "woocommerce_lost_password_page_id" );

    foreach ( $woocommerce_keys as $wc_page_id ) {
		if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
			return true ;
		}
    }
    
    return false;
}

// Checks if is WooCommerce Shop page
function wprt_is_woocommerce_shop() {
	if ( ! class_exists( 'woocommerce' ) ) {
		return false;
	} elseif ( is_shop() ) {
		return true;
	}
}

// Checks if is WooCommerce archive product page
function wprt_is_woocommerce_archive_product() {
	if ( ! class_exists( 'woocommerce' ) ) {
		return false;
	} elseif ( is_product_category() || is_product_tag() ) {
		return true;
	}
}

function wprt_trim_words( $text, $limit ) {
    if ( str_word_count($text, 0) > $limit ) {
		$words = str_word_count( $text, 2 );
		$pos = array_keys( $words );
		$text = substr( $text, 0, $pos[$limit] );
	}
  return $text;
}

// Allow html tag in tinymce editor
function override_mce_options($initArray) {
    $opts = '*[*]';
    $initArray['valid_elements'] = $opts;
    $initArray['extended_valid_elements'] = $opts;
    return $initArray;
}
add_filter('tiny_mce_before_init', 'override_mce_options');

// Add a class to the last post in loop
function wprt_last_class_in_loop($classes) {
	global $wp_query;
	if ( ( $wp_query->current_post + 1 ) == $wp_query->post_count )
		$classes[] = 'last';

	return $classes;
}
add_filter( 'post_class', 'wprt_last_class_in_loop' );

// Reply button text on comment list
function wpb_comment_reply_text( $link ) {
	$text = wprt_get_mod( 'blog_single_reply', 'REPLY' );
	$link = str_replace( 'Reply', $text, $link );
	
	return $link;
}
add_filter( 'comment_reply_link', 'wpb_comment_reply_text' );