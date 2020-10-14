<?php
/**
 * Single Panorama
 *
 * @author Jegtheme
 * @since 1.0.0
 * @package wordpress-virtual-tour
 */

namespace WVT;

/**
 * Class Single_Panorama
 *
 * @package WVT
 */
class Single_Panorama {

	/**
	 * Single Panorama Create
	 *
	 * @var Single_Panorama_Create
	 */
	private $create;

	/**
	 * Single Panorama Edit
	 *
	 * @var Single_Panorama_Edit
	 */
	private $edit;

	/**
	 * Init Instance
	 *
	 * @var Init
	 */
	private $init;

	/**
	 * Single Panorama Metabox Name
	 *
	 * @var string
	 */
	public static $metabox = 'single-panorama';

	/**
	 * Single_Panorama constructor.
	 */
	public function __construct() {
		$this->init   = Init::get_instance();
		$this->create = new Single_Panorama_Create();
		$this->edit   = new Single_Panorama_Edit();

		add_action( 'init', array( $this, 'single_panorama_post_type' ), 9 );
		add_action( 'init', array( $this, 'handle_action' ) );
	}

	/**
	 * Single Panorama Post Type
	 */
	public function single_panorama_post_type() {
		register_post_type( 'single-panorama', array(
			'labels'          =>
				array(
					'name'               => esc_html__( 'Panorama', 'wvt' ),
					'singular_name'      => esc_html__( 'Panorama', 'wvt' ),
					'menu_name'          => esc_html__( 'Panorama', 'wvt' ),
					'add_new'            => esc_html__( 'New Panorama', 'wvt' ),
					'add_new_item'       => esc_html__( 'Create Panorama', 'wvt' ),
					'edit_item'          => esc_html__( 'Edit Panorama', 'wvt' ),
					'new_item'           => esc_html__( 'New Panorama Entry', 'wvt' ),
					'view_item'          => esc_html__( 'View Panorama', 'wvt' ),
					'search_items'       => esc_html__( 'Search Panorama', 'wvt' ),
					'not_found'          => esc_html__( 'No entry found', 'wvt' ),
					'not_found_in_trash' => esc_html__( 'No Panorama in Trash', 'wvt' ),
					'parent_item_colon'  => '',
				),
			'description'     => esc_html__( 'Panorama', 'wvt' ),
			'public'          => false,
			'show_ui'         => false,
			'menu_position'   => 6,
			'capability_type' => 'post',
			'hierarchical'    => false,
			'supports'        => array( 'title' ),
			'map_meta_cap'    => true,
			'rewrite'         => array(
				'slug' => 'single-panorama',
			),
		) );
	}

	/**
	 * Render HTML for Single Panorama
	 */
	public function html() {
		$query = new \WP_Query( array(
			'post_type'      => 'single-panorama',
			'orderby'        => 'published',
			'order'          => 'DESC',
			'posts_per_page' => get_option( 'posts_per_page' ),
			'paged'          => isset( $_REQUEST['paged'] ) && $_REQUEST['paged'] ? $_REQUEST['paged'] : ''
		) );

		$this->panorama_list( $query );
	}

	/**
	 * Show Panorama List
	 *
	 * @param $posts
	 */
	public function panorama_list( $posts ) {
		$page       = $this->init->get_admin_menu();
		$create_url = add_query_arg( array(
			'page'   => $page['wvt_single']['slug'],
			'action' => Single_Panorama_Create::$create_action,
			'nonce'  => wp_create_nonce( Single_Panorama_Create::$create_action )
		), admin_url( 'admin.php' ) );
		?>
        <div class="panorama-action wvt-clearfix">
            <div class="panorama-item new">
                <a href="<?php echo esc_url( $create_url ); ?>"><i class="fa fa-plus"></i></a>
                <div class="panorama-meta">
                    <span class="panorama-title"><?php esc_html_e( 'New Single Panorama', 'wvt' ); ?></span>
                </div>
            </div>
        </div>

		<?php if ( $posts->have_posts() ): ?>
            <h4><?php esc_html_e( 'Single Panorama List', 'wvt' ); ?></h4>
            <div class="panorama-list wvt-clearfix">
				<?php
				foreach ( $posts->posts as $post ) {
					$thumb   = '';
					$nonce   = wp_create_nonce( 'delete-panorama' );
					$setting = get_post_meta( $post->ID, Single_Panorama::$metabox, true );

					if ( isset( $setting['option']['type'] ) ) {
						if ( 'equirectangular' === $setting['option']['type'] ) {
							if ( isset( $setting['option']['equirectangular_external'] ) && $setting['option']['equirectangular_external'] ) {
								$thumb = $setting['option']['equirectangular_external_url'];
							} else {
								$thumb = $setting['option']['equirectangular'];
							}
						} elseif ( 'cubemap' === $setting['option']['type'] ) {
							$thumb = $setting['option']['cubemap']['top'];
						}
					}

					if ( is_array( $thumb ) ) {
						$image = wp_get_attachment_image_src( $thumb['id'], 'medium' );
						if ( $image[0] ) {
							$thumb = $image[0];	
						}
					}

					$edit_url      = self::generate_edit_url( $post->ID, wp_create_nonce( Single_Panorama_Edit::$action ) );
					$delete_url    = $this->generate_url( $page['wvt_single']['slug'], 'delete', $post->ID, $nonce );
					$duplicate_url = $this->generate_url( $page['wvt_single']['slug'], 'duplicate', $post->ID, $nonce );

					?>
                    <div class="panorama-item" style="background-image:url(<?php esc_attr_e( $thumb ); ?>)">
                        <a href="<?php echo esc_url( $edit_url ); ?>"></a>
                        <div class="panorama-meta">
							<span class="panorama-title">
								<a href="<?php echo esc_url( $edit_url ); ?>"><?php esc_html_e( $post->post_title ); ?></a>
							</span>
                            <a class="panorama-edit" href="<?php echo esc_url( $edit_url ); ?>">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a class="panorama-duplicate" href="<?php echo esc_url( $duplicate_url ); ?>">
                                <i class="fa fa-copy"></i>
                            </a>
                            <a class="panorama-delete" href="<?php echo esc_url( $delete_url ); ?>"
                               onclick="return confirm('<?php esc_html_e( 'Are you sure you want to delete this Panorama ?', 'wvt' ); ?>')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </div>
					<?php
				}
				?>
            </div>
            <div class="panorama-pagination">
				<?php
				echo wvt_paging_navigation(
					array(
						'pagination_mode'     => 'nav_1',
						'pagination_align'    => 'center',
						'pagination_navtext'  => true,
						'pagination_pageinfo' => false,
						'prev_text'           => __( 'Prev', 'wvt' ),
						'next_text'           => __( 'Next', 'wvt' ),
					),
					$posts->max_num_pages
				);
				?>
            </div>
		<?php endif;
	}

	/**
	 * Generate Edit URL
	 *
	 * @param $id
	 * @param $nonce
	 *
	 * @return string
	 */
	public static function generate_edit_url( $id, $nonce ) {
		return add_query_arg( array(
			'action' => Single_Panorama_Edit::$action,
			'post'   => $id,
			'nonce'  => $nonce,
		), admin_url( 'admin.php' ) );
	}

	/**
	 * Generate admin url
	 *
	 * @param  string $page
	 * @param  string $action
	 * @param  int $id
	 * @param  string $nonce
	 *
	 * @return string
	 */
	public function generate_url( $page, $action, $id, $nonce = '' ) {
		return add_query_arg( array(
			'page'   => $page,
			'action' => $action,
			'id'     => $id,
			'nonce'  => $nonce,
		), admin_url( 'admin.php' ) );
	}

	/**
	 * Handle Action
	 */
	public function handle_action() {
		if ( apply_filters( 'wvt_panorama_sandbox', false ) ) {
			return false;
		}

		if ( isset( $_GET['action'], $_GET['nonce'], $_GET['id'] ) && wp_verify_nonce( sanitize_key( $_GET['nonce'] ), 'delete-panorama' ) ) {
			if ( 'delete' === $_GET['action'] && $_GET['id'] ) {
				wp_delete_post( $_GET['id'], true );
			}

			if ( 'duplicate' === $_GET['action'] && $_GET['id'] ) {
				wvt_duplicate_panorama( $_GET['id'] );
			}

			$page = $this->init->get_admin_menu();
			$url  = add_query_arg( array(
				'page' => $page['wvt_single']['slug'],
			), admin_url( 'admin.php' ) );

			wp_safe_redirect( $url );
			exit();
		}
	}
}
