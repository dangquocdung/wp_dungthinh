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

if(class_exists('AArpr_about') != true) {
	class AArpr_about {
		
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
		
		public function print_interface()
		{
			$html = array();
			
			
		
			$html[] = '<div id="AArpr_iw-section-content" class="AArpr_iw-section-dashboard">';
			$html[] = 	'<div class="AArpr_iw-section-dashboard-row">';
			$html[] = 		'<div class="AArpr_iw-dashboard-box AArpr_iw-box-size-6">';
			$html[] = 			'<div class="AArpr_iw-dashboard-box-content">';
			$html[] = 				'<div class="AArpr_iw-dashboard-in-box-content">';
			$html[] = 					'
										<img src="' . ( AArpr_asset_url( 'images/m.png' ) ) . '" class="aa-logo" />
										<p><b> Wordpress Movies Bulk Importer</b> allows you to instantly bulk import Movies from the Biggest Online Movie Database. 
<br/><br/>
Get cast info, cast biography, genre, actors, directors, release date, trailer and many more with just a few clicks.
<br/><br/>
You’re a Movie Fanatic / Enthusiast and you want to build a Movie Blog Featuring Latest Movies, Movie News, Top Rated Movies, Movies with Trailers & more? Then this plugin is the perfect choice for you!   
<br/><br/>
Looking for a way to monetize your website also? On each movie you import you can search and display amazon products that are movie related. That way you will earn commissions from <b>Amazon Affiliates</b> in no time!
<br/><br/>
If you’re curious what movies & actors are popular on your website you can check out Top Movies & Top Cast Actors based on user views in the Plugin’s dashboard. 
 </p>
										<h4> If you encounter any difficulties when using the plugin please make sure you read the Documentation of the plugin and searched trough the Knowledgebase for usual problems. </h4>
										
										<a href="http://docs.aa-team.com/products/" target="_blank"><img src="' . ( AArpr_asset_url( 'images/documentation.png' ) ) . '" class="aa-logo" /></a>

										<a href="http://support.aa-team.com" target="_blank"><img src="' . ( AArpr_asset_url( 'images/support.png' ) ) . '" class="aa-logo" /></a>
										<a href="http://support.aa-team.com/knowledgebase/" target="_blank"><img src="' . ( AArpr_asset_url( 'images/knowledgebase.png' ) ) . '" class="aa-logo" /></a>
										<h4> If you do find bugs or unusual issues, you are free to open a ticket on our support system. </h4>';

	
			$html[] = 				'</div>';
			$html[] = 			'</div>';
			$html[] = 		'</div>';
			$html[] = 	'</div>';
			$html[] = '</div>';
			
			return implode( "\n", $html );
		}
	}
}