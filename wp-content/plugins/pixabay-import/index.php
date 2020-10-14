<?php
/**
 * Plugin Name: Pixabay - Import Free Stock Images from Pixabay into WordPress
 * Description: Search and Import Free Stock Images from Pixabay straight into your WordPress Dashboard!
 * Version: 1.0.0
 * Author: AA-Team
 * Author URI: http://www.aa-team.com
 * Text Domain: aa-nice-image-editor
 * Domain Path: /languages
 *
 * @package aa-nice-image-editor
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if (class_exists('AA_PB') != true) {
	class AA_PB
	{
		private $upload_dir = null;

		protected static $instance = null;

		public static function getInstance()
		{
			if (!isset(static::$instance)) {
				static::$instance = new static;
			}
			return static::$instance;
		}

		protected function __construct()
		{
			$this->upload_dir = wp_upload_dir();

			add_action( 'admin_menu', array( $this, 'menu_page' ) );

			add_action( 'wp_ajax_AA_PBAjaxRequest', array( $this, 'ajax_request' ) );

			$this->backup_folder_path = $this->upload_dir['basedir'] . '/nice-image-backups';
			$this->backup_folder_url = $this->upload_dir['baseurl'] . '/nice-image-backups';
		}

		public function menu_page()
		{
			add_menu_page(
				__( 'Pixabay - Import High Quality Images into WordPress', 'textdomain' ),
				'Pixabay',
				'manage_options',
				'image_import_pixabay',
				array( $this, 'page_html' ),
				plugins_url( 'icon.png', __FILE__ )
			);

			wp_enqueue_script(
				'image/pixabay',
				plugins_url( 'build/backend/backend.build.js', __FILE__ ),
				array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-dom-ready' ),
				'1.0',
				true
			);

			wp_localize_script( 'image/pixabay', 'AAPB', array(
				'edit_url' => admin_url('admin.php?page=image_editor&image_id='),
				'cascadeurl' => plugins_url( 'assets/facefinder.data', __FILE__ ),
				'texturesurl' => plugins_url( 'assets/textures', __FILE__ ),
				'ajax_url' => admin_url('admin-ajax.php?action=AA_PBAjaxRequest'),
				'add_new_url' => admin_url('media-new.php'),
				'plugin_url' => admin_url('admin.php?page=image_import_pixabay'),
				'IDs' => $this->get_wh_ids()
			) );

			wp_enqueue_style(
				'pixabay/editor',
				plugins_url( 'build/backend/backend.editor.css', __FILE__ ),
				array( 'wp-edit-blocks' )
			);
		}

		public function get_wh_ids()
		{
			global $wpdb;
			$sql = "SELECT meta_value FROM {$wpdb->prefix}postmeta WHERE meta_key='_pb_id'";
			$results = $wpdb->get_results( $sql, 'ARRAY_A' );
			$ids = array();
			if( $results ){
				foreach ($results as $row) {
					$ids[] = $row['meta_value'];
				}
			}

			return $ids;
		}

		public function page_html()
		{
			echo "<div id='AA_PB-wrapper' data-where='list'></div>";
		}

		private function scaled_image($attachment_id, $size = 'thumbnail')
		{
			$file = get_attached_file($attachment_id, true);
			if (empty($size) || $size === 'full') {
				// for the original size get_attached_file is fine
				return realpath($file);
			}
			if (! wp_attachment_is_image($attachment_id) ) {
				return false; // the id is not referring to a media
			}

			$info = image_get_intermediate_size($attachment_id, $size);

			if (!is_array($info) || ! isset($info['file'])) {
				return false; // probably a bad size argument
			}

			return array(
				'path' => realpath(str_replace(wp_basename($file), $info['file'], $file)),
				'url' => $info['url']
			);
		}

		private function print_response( $status='valid', $msg='', $data=array() )
		{
			die( json_encode( array(
				'status' => $status,
				'msg' => $msg,
				'data' => $data
			) ) );
		}

		function formatBytes($size, $precision = 2)
		{
			$base = log($size, 1024);
			$suffixes = array('', 'K', 'M', 'G', 'T');

			return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
		}

		public function create_backup_folder_path()
		{
			$files = array(
				array(
					'base'    => $this->backup_folder_path,
					'file'    => '.htaccess',
					'content' => 'Options -Indexes',
				),
				array(
					'base'    => $this->backup_folder_path,
					'file'    => 'index.html',
					'content' => '',
				),
			);

			foreach ( $files as $file ) {
				if ( wp_mkdir_p( $file['base'] ) && ! file_exists( trailingslashit( $file['base'] ) . $file['file'] ) ) {
					$file_handle = @fopen( trailingslashit( $file['base'] ) . $file['file'], 'w' );

					if ( $file_handle ) {
						fwrite( $file_handle, $file['content'] );
						fclose( $file_handle );
					}
				}
			}
		}

		public function backup_file( $attID=0 )
		{
			$original_file = get_attached_file( $attID, false );
			if( file_exists( $original_file ) ) {

				$backup_file_path = $this->backup_folder_path . '/' . basename( $original_file );

				// exit if file already exist
				if( file_exists( $backup_file_path ) ) return true;

				// check if backup folder exist, if not create it
				$this->create_backup_folder_path();

				// move the original image to backup director
				rename( $original_file, $backup_file_path );
			}
		}

		public function ajax_request()
		{
			$request = json_decode( file_get_contents("php://input"), true );

			if( $request['sub_action'] == 'search' ){
				$this->search( $request );
			}

			if( $request['sub_action'] == 'save_image' ){
				$this->save_image( $request );
			}
		}

		private function save_image( $request )
		{
			require_once( 'save-image.php' );

			$download_remote_image = new AA_PB_Download_Remote_Image( $request['img']['imageURL'], array() );
  			$attachment_id = $download_remote_image->download();

			if( $attachment_id ){
				update_post_meta( $attachment_id, '_pb_id', $request['img']['id'] );

				$this->print_response( 'valid', 'done', array(
					'attachment_id' => $attachment_id,
					'attachment_url' => home_url( "/wp-admin/upload.php?item=" . $attachment_id )
				) );
			}
		}

		public function search( $request )
		{
			$params = $request['params'];

			$request_url_params = array();
			$request_url_params['apikey'] = 'w2bWLFvNBFfcA0CErm9MwhlVFSqh5tsl';

			$request_url_params['q'] = $params['query'];
			$request_url_params['page'] = $params['paged'] + 1;
			$request_url_params['atleast'] = $params['resolution'];

			$request_url_params['sorting'] = $params['selected_sorting'];
			$request_url_params['order'] = $params['selected_order'];

			$request_url_params['categories'] = '';
			foreach ( $params['selected_categories'] as $key => $value) {
				$request_url_params['categories'] .= ( $value ? 1 : 0 );
			}

			$request_url_params['purity'] = '';
			foreach ( $params['selected_purity'] as $key => $value) {
				$request_url_params['purity'] .= ( $value ? 1 : 0 );
			}

			$request_url_params['colors'] = $params['selected_color'];
			$url = 'https://wallhaven.cc/api/v1/search?' . http_build_query( $request_url_params );

			$request = wp_remote_get( $url );
			$body = wp_remote_retrieve_body( $request );
			$data = json_decode( $body, true );

			$this->print_response( 'valid', 'done', array(
				'results' => $data
			) );
		}
	}
}


$AA_PB = AA_PB::getInstance();
function AA_PB() {
	global $AA_PB;
	return $AA_PB;
}
