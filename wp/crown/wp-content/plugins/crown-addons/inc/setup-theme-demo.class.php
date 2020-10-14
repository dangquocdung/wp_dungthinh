<?php
/**
 * Setup theme data (vc template, vc template categories ...)
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
if ( ! class_exists( 'G5ThemeAddons_Setup_Theme_Demo' ) ) {
	class G5ThemeAddons_Setup_Theme_Demo {
		private static $_instance;

		public static function getInstance() {
			if ( self::$_instance == null ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		public function init() {
			add_action( 'template_redirect', array( $this, 'demo_blog_layout' ), 15 );
			add_action( 'pre_get_posts', array( $this, 'demo_blog_post_per_pages' ), 15 );


			add_action( 'template_redirect', array( $this, 'demo_shop_layout' ), 20 );
			add_action( 'pre_get_posts', array( $this, 'demo_shop_post_per_pages' ), 15 );
		}

		public function demo_blog_layout() {
			if ( ! function_exists( 'G5CORE' ) || ! function_exists( 'G5BLOG' ) ) {
				return;
			}
			$post_layout = isset( $_REQUEST['post_layout'] ) ? $_REQUEST['post_layout'] : '';

			if ( ! empty( $post_layout ) ) {
				$ajax_query                = G5CORE()->cache()->get( 'g5core_ajax_query', array() );
				$ajax_query['post_layout'] = $post_layout;
				G5CORE()->cache()->set( 'g5core_ajax_query', $ajax_query );
			}


			$has_sidebar = g5core_has_sidebar();

			if ( ! empty( $post_layout ) ) {
				switch ( $post_layout ) {
					case 'grid':
						G5BLOG()->options()->set_option( 'post_layout', 'grid' );
						G5BLOG()->options()->set_option( 'post_columns_gutter', '20' );
						G5BLOG()->options()->set_option( 'post_columns_xl', '3' );
						G5BLOG()->options()->set_option( 'post_columns_lg', '3' );
						G5BLOG()->options()->set_option( 'post_columns_md', '3' );
						G5BLOG()->options()->set_option( 'post_columns_sm', '2' );
						G5BLOG()->options()->set_option( 'post_columns', '1' );
						G5BLOG()->options()->set_option( 'post_image_size', '330x250' );
						if ( $has_sidebar ) {
							G5BLOG()->options()->set_option( 'post_columns_xl', '2' );
							G5BLOG()->options()->set_option( 'post_columns_lg', '2' );
							G5BLOG()->options()->set_option( 'post_columns_md', '2' );
						}
						break;
					case 'medium-image':
						G5BLOG()->options()->set_option( 'post_layout', 'medium-image' );
						G5BLOG()->options()->set_option( 'post_image_size', '330x225' );
						break;
					case 'large-image':
						G5BLOG()->options()->set_option( 'post_layout', 'large-image' );
						G5BLOG()->options()->set_option( 'post_image_size', '620x400' );
						break;
				}
			}
		}

		public function demo_blog_post_per_pages( $query ) {
			if ( ! function_exists( 'G5CORE' ) || ! function_exists( 'G5BLOG' ) ) {
				return;
			}
			if ( ! is_admin() && $query->is_main_query() ) {
				$post_layout = isset( $_REQUEST['post_layout'] ) ? $_REQUEST['post_layout'] : '';
				if ( empty( $post_layout ) ) {
					return;
				}
				$site_layout = isset( $_REQUEST['site_layout'] ) ? $_REQUEST['site_layout'] : '';
				if ( ! empty( $site_layout ) ) {
					G5CORE()->options()->layout()->set_option( 'site_layout', $site_layout );
				}
				$has_sidebar = g5core_has_sidebar();
				switch ( $post_layout ) {
					case 'grid':
						$query->set( 'posts_per_page', 9 );
						if ( $has_sidebar ) {
							$query->set( 'posts_per_page', 8 );
						}
						break;
					case 'medium-image':
						$query->set( 'posts_per_page', 6 );
						break;
					case 'large-image':
						$query->set( 'posts_per_page', 4 );
						break;
				}
			}

		}



		public function demo_shop_layout() {
			if ( ! function_exists( 'G5CORE' ) || ! function_exists( 'G5SHOP' ) ) {
				return;
			}
			$shop_layout = isset( $_REQUEST['shop_layout'] ) ? $_REQUEST['shop_layout'] : '';
			if ( ! empty( $shop_layout ) ) {
				$ajax_query                = G5CORE()->cache()->get( 'g5core_ajax_query', array() );
				$ajax_query['shop_layout'] = $shop_layout;
				G5CORE()->cache()->set( 'g5core_ajax_query', $ajax_query );
			}

			switch ( $shop_layout ) {
				case 'no-sidebar':
					G5SHOP()->options()->set_option( 'post_columns_xl', '3' );
					G5SHOP()->options()->set_option( 'post_columns_lg', '3' );
					G5SHOP()->options()->set_option( 'post_columns_md', '3' );
					G5SHOP()->options()->set_option( 'post_columns_sm', '2' );
					G5SHOP()->options()->set_option( 'post_columns', '1' );
					G5CORE()->options()->layout()->set_option( 'site_layout', 'none' );
					break;
				case 'left-sidebar':
					G5SHOP()->options()->set_option( 'post_columns_xl', '2' );
					G5SHOP()->options()->set_option( 'post_columns_lg', '2' );
					G5SHOP()->options()->set_option( 'post_columns_md', '2' );
					G5SHOP()->options()->set_option( 'post_columns_sm', '2' );
					G5SHOP()->options()->set_option( 'post_columns', '1' );
					G5CORE()->options()->layout()->set_option( 'site_layout', 'left' );
					break;
				case 'right-sidebar':
					G5SHOP()->options()->set_option( 'post_columns_xl', '2' );
					G5SHOP()->options()->set_option( 'post_columns_lg', '2' );
					G5SHOP()->options()->set_option( 'post_columns_md', '2' );
					G5SHOP()->options()->set_option( 'post_columns_sm', '2' );
					G5SHOP()->options()->set_option( 'post_columns', '1' );
					G5CORE()->options()->layout()->set_option( 'site_layout', 'right' );
					break;
				case 'full-width':
					G5SHOP()->options()->set_option( 'post_columns_xl', '5' );
					G5SHOP()->options()->set_option( 'post_columns_lg', '3' );
					G5SHOP()->options()->set_option( 'post_columns_md', '3' );
					G5SHOP()->options()->set_option( 'post_columns_sm', '2' );
					G5SHOP()->options()->set_option( 'post_columns', '1' );
					G5SHOP()->options()->set_option( 'shop_toolbar_layout', 'stretched_content' );
					G5SHOP()->options()->set_option( 'shop_toolbar', array(
						'left'  =>
							array(
								'cat_filter' => 'Category Filter',
							),
						'right' =>
							array(
								'ordering'      => 'Ordering',
								'switch_layout' => 'Switch Layout',
								'filter'        => 'Filter',
							)
					) );
					G5CORE()->options()->layout()->set_option( 'site_layout', 'none' );
					G5CORE()->options()->layout()->set_option( 'site_stretched_content', 'on' );
					break;
				case 'full-width-left-sidebar':
					G5SHOP()->options()->set_option( 'post_columns_xl', '4' );
					G5SHOP()->options()->set_option( 'post_columns_lg', '3' );
					G5SHOP()->options()->set_option( 'post_columns_md', '3' );
					G5SHOP()->options()->set_option( 'post_columns_sm', '2' );
					G5SHOP()->options()->set_option( 'post_columns', '1' );
					G5SHOP()->options()->set_option( 'shop_toolbar_layout', 'stretched_content' );
					G5SHOP()->options()->set_option( 'shop_toolbar', array(
						'left'  =>
							array(
								'cat_filter' => 'Category Filter',
							),
						'right' =>
							array(
								'ordering'      => 'Ordering',
								'switch_layout' => 'Switch Layout',
								'filter'        => 'Filter',
							)
					) );
					G5CORE()->options()->layout()->set_option( 'site_layout', 'left' );
					G5CORE()->options()->layout()->set_option( 'site_stretched_content', 'on' );
					break;
				case 'full-width-right-sidebar':
					G5SHOP()->options()->set_option( 'post_columns_xl', '4' );
					G5SHOP()->options()->set_option( 'post_columns_lg', '3' );
					G5SHOP()->options()->set_option( 'post_columns_md', '3' );
					G5SHOP()->options()->set_option( 'post_columns_sm', '2' );
					G5SHOP()->options()->set_option( 'post_columns', '1' );
					G5SHOP()->options()->set_option( 'shop_toolbar_layout', 'stretched_content' );
					G5SHOP()->options()->set_option( 'shop_toolbar', array(
						'left'  =>
							array(
								'cat_filter' => 'Category Filter',
							),
						'right' =>
							array(
								'ordering'      => 'Ordering',
								'switch_layout' => 'Switch Layout',
								'filter'        => 'Filter',
							)
					) );
					G5CORE()->options()->layout()->set_option( 'site_layout', 'right' );
					G5CORE()->options()->layout()->set_option( 'site_stretched_content', 'on' );
					break;
			}
		}

		public function demo_shop_post_per_pages( $query ) {
			if ( ! function_exists( 'G5CORE' ) || ! function_exists( 'G5SHOP' ) ) {
				return;
			}
			if ( ! is_admin() && $query->is_main_query() ) {
				$shop_layout    = isset( $_REQUEST['shop_layout'] ) ? $_REQUEST['shop_layout'] : '';
				$post_per_pages = '';

				switch ( $shop_layout ) {
					case 'no-sidebar':
						$post_per_pages = 9;
						break;
					case 'left-sidebar':
						$post_per_pages = 8;
						break;
					case 'right-sidebar':
						$post_per_pages = 8;
						break;
					case 'full-width':
						$post_per_pages = 15;
						break;
					case 'full-width-left-sidebar':
						$post_per_pages = 16;
						break;
					case 'full-width-right-sidebar':
						$post_per_pages = 16;
						break;
				}

				if ( ! empty( $post_per_pages ) ) {
					$query->set( 'posts_per_page', $post_per_pages );
				}
			}
		}



	}
}