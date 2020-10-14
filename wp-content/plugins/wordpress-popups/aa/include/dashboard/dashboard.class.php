<?php
 /**
 * About module
 * http://www.aa-team.com
 * ======================
 *
 * @package AArpr
 * @author		Andrei Dinca, AA-Team
 * @version		1.0
 */
! defined( 'ABSPATH' ) and exit;

if(class_exists('AArpr_dashboard') != true) {
	class AArpr_dashboard {
		
		const VERSION = '1.0';
		
		/**
		 * parent storage
		 *
		 * @var array
		 */
		public $parent = array();
		
		private $action = '';
		private $wp_import = null;
		
		/**
		 * The constructor
		 */
		public function __construct( $parent=array() )
		{
			// load parent
			$this->parent = $parent;
		}

		public function get_popular_cast()
		{
			$cast = array();
			$cast_results = get_terms( 'cast', array(
			    'orderby'    	=> 'count',
			    'order' 		=> 'DESC',
			    'number'		=> 12,
			    'hide_empty' 	=> 0
			) );

			if( !is_wp_error($cast_results) && $cast_results && count($cast_results) > 0 ){
				foreach ($cast_results as $key => $value) {

					$image_ID = get_term_meta( $value->term_id, '_thumbnail', true );

					$cast[$value->term_id] = array(
						'name' => $value->name,
						'count' => $value->count,
						'thumb' => ( trim($image_ID) != "" ? wp_get_attachment_image_src( $image_ID, array(200, 300) )[0] : '' ),
					);
				}
			}

			return $cast;
		}

		public function get_popular_products()
		{
			$products = array();
			$args = array(
				'post_type' => 'movies',
				'meta_key' => '_AArpr_movie_hits',
				'orderby' => 'meta_value_num',
				'order' => 'DESC',
				'posts_per_page' => 12
			);
			$query = new WP_Query($args);
			
			if( (int) $query->found_posts > 0 ){
				foreach ( $query->posts as $post ) {

					$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
					$poster_thumbnail = wp_get_attachment_image_src( $post_thumbnail_id, 'thumbnail' )[0];

					$products[$post->ID] = array(
						'hits' => (int) get_post_meta( $post->ID, '_AArpr_movie_hits', true ),
						'poster_thumbnail' => $poster_thumbnail
					);
				}
			}

			return $products;
		}
		
		public function print_interface()
		{
			$html = array();
			$plugin_register = (string) get_option( "_" . AArpr()->alias . "_register_html" );

			$html[] = '<div id="AArpr_iw-section-content" class="AArpr_iw-section-dashboard">'; // main container

			/*
			$html[] = 	'<div class="AArpr_iw-section-dashboard-row">'; // start row

			//------------------------------------------------
			// start box: Popular Movies
			$html[] = 		'<div class="AArpr_iw-dashboard-box AArpr_iw-box-size-3">';
			$html[] = 			'<div class="AArpr_iw-dashboard-box-content">';
			$html[] = 				'<h3 class="dashboard-box-label">Popular Movies</h3>';
			$html[] = 				'<div class="AArpr_iw-dashboard-in-box-content">';

			$products = $this->get_popular_products();
			if( count($products) > 0 ){
			$html[] = 					'<ul class="AArpr_iw-popular-products">';
				foreach ($products as $product_key => $product_value) {
					$html[] = 				'<li>';
					$html[] = 					'<a href="' . ( get_permalink( $product_key ) ) . '">';

					if( trim($product_value['poster_thumbnail']) != "" ) {
						$html[] = 					'<img src="' . ( $product_value['poster_thumbnail'] ) . '" />';
					}

					$html[] = 					'</a>';
					$html[] = 					'<span>' . ( $product_value['hits'] ) . ' views</span>';
					$html[] = 				'</li>';
				}
				$html[] = 				'</ul>';
			}else{
				$html[] = '<div class="AArpr_iw-no-items">No products yet! You can add new movies: <a href="' . ( admin_url( 'admin.php?page=AArpr&AArpr_action=search' ) ) . '">here</a></div>';
			}
			
			$html[] = 				'</div>';
			$html[] = 			'</div>';
			$html[] = 		'</div>';
			//------------------------------------------------
			// end box: Popular Movies

			//------------------------------------------------
			// start box: Popular Actors
			$html[] = 		'<div class="AArpr_iw-dashboard-box AArpr_iw-box-size-3">';
			$html[] = 			'<div class="AArpr_iw-dashboard-box-content">';
			$html[] = 				'<h3 class="dashboard-box-label">Popular Actors</h3>';
			$html[] = 				'<div class="AArpr_iw-dashboard-in-box-content">';

			$cast = $this->get_popular_cast();
			if( count($cast) > 0 ){
			$html[] = 					'<ul class="AArpr_iw-popular-cast">';
				foreach ($cast as $cast_key => $cast_value) {
					$html[] = 				'<li>';
					$html[] = 					'<a href="' . ( get_term_link( $cast_key ) ) . '">';

					if( trim($cast_value['thumb']) != "" ) {
						$html[] = 					'<img src="' . ( $cast_value['thumb'] ) . '" />';
					}

					$html[] = 					'</a>';
					$html[] = 					'<span>(' . ( $cast_value['count'] ) . ') ' . ( $cast_value['name'] ) . '</span>';
					$html[] = 				'</li>';
				}
				$html[] = 				'</ul>';
			}else{
				$html[] = '<div class="AArpr_iw-no-items">No cast yet! You can add new movies: <a href="' . ( admin_url( 'admin.php?page=AArpr&AArpr_action=search' ) ) . '">here</a></div>';
			}
			
			$html[] = 				'</div>';
			$html[] = 			'</div>';
			$html[] = 		'</div>';
			//------------------------------------------------
			// end box: Popular Actors

			$html[] = 	'</div>'; // end row
			*/
			$html[] = 	'<div class="AArpr_iw-section-dashboard-row">'; // start row
			
			//------------------------------------------------
			// start box: Product Support
			$html[] = 		'<div class="AArpr_iw-dashboard-box AArpr_iw-box-size-2">';
			$html[] = 			'<div class="AArpr_iw-dashboard-box-content">';
			$html[] = 				'<h3 class="dashboard-box-label">Product Support</h3>';
			$html[] = 				'<div class="AArpr_iw-dashboard-in-box-content">';
			
			$html[] = 					'<div class="AArpr_iw-row-icons">';
			$html[] = 						'<i class="fa fa-file-text-o"></i>';
			$html[] = 						'<div class="AArpr_iw-icons-title">';
			$html[] = 							'<p class="AArpr_iw-icons-strong">Online Documentation</p>';
			$html[] = 							'<p>The best start for <strong>' . ( strip_tags( $this->parent->plugin_name ) ) . '</strong> beginners</p>';
			$html[] = 						'</div>';
			$html[] = 					'</div>';
			$html[] = 					'<div class="AArpr_iw-row-icons">';
			$html[] = 						'<i class="fa fa-life-ring"></i>';
			$html[] = 						'<div class="AArpr_iw-icons-title">';
			$html[] = 							'<p class="AArpr_iw-icons-strong">Ticket Support</p>';
			$html[] = 							'<p>Direct help from our qualified support team</p>';
			if( !$plugin_register && trim($plugin_register) == "" ){
				$html[] = 						'<a href="#" class="AArpr_iw-dashboard-button AArpr_iw-color-red AArpr_iw-require_register">Unlock Now</a>';
			}else{
				$html[] = 						'<a href="http://support.aa-team.com/" target="_blank" class="AArpr_iw-dashboard-button AArpr_iw-color-yellow">Open New Ticket</a>';
			}
			$html[] = 						'</div>';
			$html[] = 					'</div>';
			$html[] = 					'<div class="AArpr_iw-row-icons">';
			$html[] = 						'<i class="fa fa-money"></i>';
			$html[] = 						'<div class="AArpr_iw-icons-title">';
			$html[] = 							'<p class="AArpr_iw-icons-strong">Custom Modifications</p>';
			$html[] = 							'<p>Direct help from our qualified dev and design team</p>';
			if( !$plugin_register && trim($plugin_register) == "" ){
				$html[] = 						'<a href="#" class="AArpr_iw-dashboard-button AArpr_iw-color-red AArpr_iw-require_register">Unlock Now</a>';
			}else{
				$html[] = 						'<a href="http://support.aa-team.com/custom-modifications/" target="_blank" class="AArpr_iw-dashboard-button AArpr_iw-color-yellow">Request a Quote</a>';
			}
			$html[] = 						'</div>';
			$html[] = 					'</div>';

			$html[] = 				'</div>';
			$html[] = 			'</div>';
			$html[] = 		'</div>';
			//------------------------------------------------
			// end box: Product Support

			global $current_user;
      		wp_get_current_user(); //deprecated: get_currentuserinfo();

			//------------------------------------------------
			// start box: Your plugin is activated
			$html[] = 		'<div class="AArpr_iw-dashboard-box AArpr_iw-box-size-2">';
			$html[] = 			'<div class="AArpr_iw-dashboard-box-content">';

			//if ( $plugin_register && trim($plugin_register) != "" ) {
			if (1) {
				$html[] = 				'<h3 class="dashboard-box-label">Your plugin is activated</h3>';
				$html[] = 				'<div class="AArpr_iw-dashboard-in-box-content AArpr_iw-aa-register-text">' . ( $plugin_register ) . '</div>';
			} else{

				$html[] = 				'<h3 class="dashboard-box-label">Plugin Activation</h3>';
				$html[] = 				'<div class="AArpr_iw-dashboard-in-box-content">';
				$html[] = 					'<form class="AArpr_iw-register_plugin" action="" method="POST">';
				$html[] = 						'<div class="AArpr_iw-row-icons">';
				$html[] = 							'<i class="fa fa-key"></i>';
				$html[] = 							'<div class="AArpr_iw-icons-title">';
				$html[] = 								'<p class="AArpr_iw-icons-strong">Item Purchase Code (IPC)</p>';
				$html[] = 								'<p>You can learn how to find your purchase code <a href="http://support.aa-team.com/themes/default/assets/images/ipc-help.png" target="_blank">here</a></p>';
				$html[] = 							'</div>';
				$html[] = 						'</div>';
				$html[] = 						'<input type="text" value="" style="width:100%" class="AArpr_iw-dashboard-input" name="AArpr_iw-validation-token" placeholder="IPC Code">';
				$html[] = 						'<input type="text" value="' . ( $current_user->user_email ) . '" style="width:100%" class="AArpr_iw-dashboard-input" name="AArpr_iw-validation-email" placeholder="Register email">';
				$html[] = 						'<p>Reminder! The Regular License is for One Install Only!</p>';
				$html[] = 						'<input type="button" class="AArpr_iw-dashboard-button AArpr_iw-color-yellow" value="Register the code" />';
				$html[] = 					'</form>';
				$html[] = 				'</div>';
			}
			$html[] = 			'</div>';
			$html[] = 		'</div>';
			//------------------------------------------------
			// end box: Your plugin is activated

			//------------------------------------------------
			// start box: System Requirements
			$html[] = 		'<div class="AArpr_iw-dashboard-box AArpr_iw-box-size-2">';
			$html[] = 			'<div class="AArpr_iw-dashboard-box-content">';
			$html[] = 				'<h3 class="dashboard-box-label">System Requirements</h3>';
			$html[] = 				'<div class="AArpr_iw-dashboard-in-box-content">';
			$html[] = 					'<table class="AArpr_iw-system-req">';
			$html[] = 						'<tr>';
			$html[] = 							'<td width="55%">' . ( is_multisite() ? 'WPMU' : 'WP' ) . ' Version:</td>';
			$html[] = 							'<td><span class="AArpr_iw-success"><i class="fa fa-check-square"></i></span></td>';
			$html[] = 							'<td width="30%">' . get_bloginfo('version') . ' </td>';
			$html[] = 						'</tr>';

			$html[] = 						'<tr>';
			$html[] = 							'<td width="55%">Uploads folder writable</td>';
			$html[] = 							'<td><span class="AArpr_iw-success"><i class="fa fa-check-square"></i></span></td>';
			$html[] = 							'<td width="30%"></td>';
			$html[] = 						'</tr>';

			$html[] = 						'<tr>';
			$html[] = 							'<td width="55%">Max Upload Size:</td>';
			$html[] = 							'<td><span class="AArpr_iw-success"><i class="fa fa-exclamation-circle"></i></span></td>';
			$html[] = 							'<td width="30%">' . ( size_format( wp_max_upload_size() ) ) . '</td>';
			$html[] = 						'</tr>';


			$allow_remote_get = (boolean) get_option( "_AArpr_allow_remote_get" );

			if( $allow_remote_get === false ){
				$response = wp_remote_get( 'http://google.com' );
				if( isset($response['body']) && trim($response['body']) != "" ){
					$allow_remote_get = true;
					update_option( "_AArpr_allow_remote_get", true );
				}
			}

			$html[] = 						'<tr>';
			$html[] = 							'<td width="55%">Remote GET:</td>';
			if( $allow_remote_get ){
				$html[] = 						'<td><span class="AArpr_iw-success"><i class="fa fa-exclamation-circle"></i></span></td>';
			}else{
				$html[] = 						'<td><span class="AArpr_iw-error"><i class="fa fa-check-square"></i></span></td>';
			}
			$html[] = 							'<td width="30%"></td>';
			$html[] = 						'</tr>';
			$html[] = 						'<tr>';
			$html[] = 							'<td>Your Theme</td>';
			$template = get_option( 'template' );
			$themes = wp_get_themes();
			$theme = $themes[$template];

			//var_dump('<pre>',$theme ,'</pre>'); die; 
			$html[] = 							'<td><span class="AArpr_iw-success"><i class="fa fa-check-square"></i></span></td>';
			$html[] = 							'<td><a href="' . ( admin_url( '/themes.php' ) ) . '"><img width="80" src="' . ( esc_url( $theme->get_screenshot() ) ) . '" /></a></td>';
			$html[] = 						'</tr>';

			$html[] = 						'<tr>';
			$html[] = 							'<td width="55%">WP DEBUG:</td>';
			$html[] = 							'<td rowspan="2">' . (  defined('WP_DEBUG') && WP_DEBUG === true ? 'YES' : "NO" ) . '</td>';
			$html[] = 						'</tr>';

			$html[] = 					'</table>';
			$html[] = 				'</div>';
			$html[] = 			'</div>';
			$html[] = 		'</div>';
			// end box: System Requirements
			//------------------------------------------------

			$html[] = 	'</div>'; // end row
			
			$html[] = '</div>'; // end main container
			
			return implode( "\n", $html );
		}
	}
}