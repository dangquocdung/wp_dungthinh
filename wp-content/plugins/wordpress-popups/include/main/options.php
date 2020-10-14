<?php
/**
 * Amazon module return as json_encode
 * http://www.aa-team.com
 * =======================
 *
 * @author		Andrei Dinca, AA-Team
 * @version		1.0
 */

$SMPNEW = function_exists('SMPNEW') ? SMPNEW() : null;
//$SMPNEW_pages = function_exists('SMPNEW') ? SMPNEW()->get_pages() : null;
$SMPNEW_Main_Helper = function_exists('SMPNEW') ? SMPNEW()->mainhelper : null;

if ( ! function_exists('SMPNEW_SMP_contentType') ) {
	function SMPNEW_SMP_contentType( $tab ) {
		ob_start();
		//echo __FILE__ . ":" . __LINE__;die . PHP_EOL;
	?>
		<script type="text/javascript">
		(function ($) {
			$(document).ready(function() {
				triggers();
			});

			function triggers() {
				var tab				= '<?php echo $tab; ?>';
				var conv 			= {
					'image' 				: 'SMP_imageurl',
					'video'				  : 'SMP_videoembed',
					'iframe'				: 'SMP_iframeurl',
					'html'				  : 'SMP_html',
					'slide'				  : 'SMP_slide'
				};
				//SMP_videoType

				var body 			= $('body'),
					dropdown 	= body.find('#SMPNEW_Main_Settings-SMP_contentType'),
					main 			= dropdown.parents('.SMPNEW-form-item:first'),
					desc				= main.find('.SMPNEW-form-note:first'),
					mainp			= main.parents('.SMPNEW-form-row:first'),
					mainwrap		= mainp.parent(),
					form				= dropdown.parents('form:first').eq(0);
				//console.log( body, dropdown, main  );

				// dropdown change event
				body.on('change', 'select#SMPNEW_Main_Settings-SMP_contentType', function(e) {
					var $this 	= $(this),
						sel_val = $this.val();
					//console.log( sel_val  );

					_choose_desc( sel_val );
					_choose_elem( sel_val );
				});

				// default
				_choose_desc( dropdown.val() );
				_choose_elem( dropdown.val() );

				// show description vased on dropdown value
				function _choose_desc( value ) {
					desc.find( '> div' ).hide();
					desc.find( '> div.desc-' + value ).show();
				};

				function _choose_elem( value ) {
					var videoType 	= mainwrap.find('#SMPNEW_Main_Settings-SMP_videoType'),
						  videoTypeP = videoType.parents('.SMPNEW-form-row:first');
					videoType.parent().addClass('hide');

					//console.log( value  );
					$.each(conv, function(idx, val) {
						var elem 		= mainwrap.find( '#SMPNEW_Main_Settings-' + val ),
							  parent 	= elem.parents('.SMPNEW-form-row:first');

						if ( value != idx ) {
							elem.parent().addClass('hide');
							parent.hide();
						} else {
							elem.parent().removeClass('hide');
							if ( tab == _get_active_tab( form ) ) {
								parent.show();
							}
						}

						if ( 'video' == idx ) {
							console.log( 'gimi2' );
							if ( elem.parent().hasClass('hide') ) {
								videoType.parent().addClass('hide');
								videoTypeP.hide();
							} else {
								videoType.parent().removeClass('hide');
								if ( tab == _get_active_tab( form ) && 'video' == value ) {
									videoTypeP.show();
								}
							}
						}
					});

					if (1) {
					}
				};

				function _get_active_tab( form ) {
					var link			= form.find('ul.SMPNEW-settings-tabs > li.on'),
						  tab_id		= link.find("a").attr("href").replace("#", "");
					return tab_id;
				}
			};
		})(jQuery);
		</script>
	<?php
		$html = ob_get_clean();
		return $html;
	}
}

echo json_encode(array(
	// create the box elements array
	'option_name' => 'SMPNEW_Main_Settings',

	'tabs' => array(
		'setup' => array(
			'label' 	=> 'Settings',
			'elements' 	=> 'SMP_developByIP, SMP_showOn, SMP_showOnlyPages, SMP_page_id, SMP_height, SMP_width, SMP_displayPerSession, SMP_sessionLifetime, SMP_fadeOpacity, SMP_fadeBackground, SMP_fadeOutTime, SMP_fadeInTime, SMP_autoclose',
		),
		'amazon' => array(
			'label' 	=> 'Content',
			'elements' 	=> 'protocol, country, help_required_fields, AccessKeyID, SecretAccessKey, AffiliateId, main_aff_id, check_amz_keys, help_available_countries, amazon_requests_rate, SMP_smartPopup_boxcontent, SMP_contentType, SMP_imageurl, SMP_videoembed, SMP_videoType, SMP_iframeurl, SMP_html, SMP_slide ',
		),
		/*
		'amazon2' => array(
			'label' 	=> 'Video tutorial',
			'elements' 	=> 'protocol, country, help_required_fields, AccessKeyID, SecretAccessKey, AffiliateId, main_aff_id, check_amz_keys, help_available_countries, amazon_requests_rate, SMP_smartPopup_copyright, SMP_doc',
		),
		*/

	),

	'elements' => array(



				/* Settings */
				'SMP_developByIP' => array(
                    'type' => 'input-type-text',
                    'std' => '',
                    'size' => 'small',
                    'title' => 'Configurate settings on a local workstation:',
                    //'force_width' => '250',
                    'desc' => "If you are in development mode, the pop-up is showed only for the workstation (ip) you set: (your ip address: <b>".($_SERVER['REMOTE_ADDR']).")</b>. When you're ready just delete/empty this field and your pop-up will be visible to everybody."
                ),

				'SMP_showOn' => array(
                    'type' => 'select',
                    'std' => 'open',
                    'size' => 'small',
                    //'force_width' => '200',
                    'title' => 'Show pop-up on:',
                    'desc' => 'Set when the pop-up should appear On the page loads.',
                    'options' => array(
						'open' 	=> 'On page load',
						//'close' => 'Before page Unload'
					)
                ),



				 'SMP_showOnlyPages' => array(
                    'type' => 'select',
                    'std' => 'all',
                    'size' => 'small',
                    //'force_width' => '200',
                    'title' => 'Show pop-up only on:',
                    'desc' =>  "1. All pages<br />" .
						"2. Home page<br />" .
						"4. Category page<br />" .
						"4. Single page<br />" .
						"4. Specific page<br />" .
						"5. None<br />",
                    "options" => array(
				'all' 		=> 'All pages',
				'home' 		=> 'Home page',
				'category' 	=>  'Category page',
				'single' 	=>  'Single page',
				'specific' 		=> 'Specific page',
				'nopages' 	=>  'None page',
			)
                ),


				'SMP_page_id' => array(
                    'type' => 'input-type-text',
                    'std' => '5',
                    'size' => 'small',
                    'title' => "Specify page ID:",
                    //'force_width' => '250',
                    'desc' => "The id of the page in wich the pop-up will load (ex: 5). For multiple post IDs, sepparate them by comma.",
                ),



				'SMP_width' => array(
                    'type' => 'input-type-text',
                    'std' => '360',
                    'size' => 'small',
                    'title' => "Pop-up box width:",
                    //'force_width' => '250',
                    'desc' => "Width of Pop-up box in px. Default: 800",
                ),


				'SMP_height' => array(
                    'type' => 'input-type-text',
                    'std' => '420',
                    'size' => 'small',
                    'title' => "Pop-up box height:",
                    //'force_width' => '250',
                    'desc' => "Height of Pop-up box in px. Default: 600",
                ),


				/*'SMP_displayPerSession' => array(
                    'type' => 'checkbox',
                    'std' => 'on',
                    'size' => 'small',
                    'title' => "Display settings:",
                    //'force_width' => '250',
                    'desc' => "Display only once on same session for each user. Default: ON",
                ),*/
				'SMP_displayPerSession' => array(
                    'type' => 'select',
                    'std' => 'no',
                    'size' => 'small',
                    //'force_width' => '200',
                    'title' => 'Display only once:',
                    'desc' => 'Display only once on same session for each user. Default: ON.',
                    'options' => array(
						'yes' 	=> 'Yes',
						'no' => 'No'
					)
                ),


				'SMP_sessionLifetime' => array(
                    'type' => 'input-type-text',
                    'std' => '3600',
                    'size' => 'small',
                    'title' => "Session lifetime:",
                    //'force_width' => '250',
                    'desc' => "How long does your user session is in seconds.Default 3600",
                ),

				'SMP_fadeOpacity' => array(
                    'type' => 'input-type-text',
                    'std' => '0.8',
                    'size' => 'small',
                    'title' => "Fade Opacity:",
                    //'force_width' => '250',
                    'desc' => "Background opacity, between 0 - 1 (0.8 default)",
                ),


				'SMP_fadeBackground' => array(
                    'type' => 'input-type-text',
					//'wp-content/plugins/smart-pop-up/frontpage/images/pattern.png'
                    'std' => $SMPNEW->path('INCLUDE_URL', '/frontpage/images/bg-transparent.png'),
                    'size' => 'small',
                    'title' => "Background fade overlay url:",
                    //'force_width' => '250',
                    'desc' => "Background image for fade layer overlay (default: " . $SMPNEW->path('INCLUDE_URL', '/frontpage/images/bg-transparent.png') . ")",
                ),

				'SMP_fadeOutTime' => array(
                    'type' => 'input-type-text',
                    'std' => '300',
                    'size' => 'small',
                    'title' => "FadeOut Time:",
                    //'force_width' => '250',
                    'desc' => "Feedback box and fade overlay fade OUT time in miliseconds (1000 = 1 second) (default: 300)",
                ),



				'SMP_fadeInTime' => array(
                    'type' => 'input-type-text',
                    'std' => '300',
                    'size' => 'small',
                    'title' => "FadeIn Time:",
                    //'force_width' => '250',
                    'desc' => "Feedback box and fade overlay fade IN time in miliseconds (1000 = 1 second) (default: 300)",
                ),

				'SMP_autoclose' => array(
                    'type' => 'input-type-text',
                    'std' => '20',
                    'size' => 'small',
                    'title' => "Pop-up box autoclose:",
                    //'force_width' => '250',
                    'desc' => "Pop-up box autoclose seconds",
                ),

				/* content */

				/*'SMP_smartPopup_boxcontent' => array(
                    'type' => 'starttab',
                    'size' => 'small',
                    'title' => "Pop-up box content:",
                    //'force_width' => '250',
                ),*/


				'SMP_contentType' => array(
                    'type' => 'select',
                    'std' => 'image',
                    'size' => 'small',
                    //'force_width' => '200',
                    'title' => 'Content type:',
                    'desc' =>  "<div class='desc-image'>1. Image - request image full URL</div>" .
						"<div class='desc-video'>2. Video embed - request youtube/vimeo video URL</div>" .
						"<div class='desc-iframe'>3. Iframe - request page full URL</div>" .
						"<div class='desc-html'>4. HTML - request html code</div>" . SMPNEW_SMP_contentType( 'amazon' ),
                    "options" => array(
                    	'choose_option' => '-- Choose Option --',
          						'image' 	=> 'Image',
          						'video' 	=> 'Video',
          						'iframe' 	=> 'Iframe',
          						'html'		=> 'HTML',
          						'slide'		=> 'Slide PopUp'
          					)
                ),

				'SMP_videoType' => array(
                    'type' => 'select',
                    'std' => 'youtube',
                    'size' => 'small',
                    //'force_width' => '200',
                    'title' => 'Video type:',
                    'desc' =>  "This option is only for Video Content Type. Default is Youtube.",
                    "options" => array(
                    	'choose_option' => '-- Choose Option --',
						'youtube' 	=> 'Youtube',
						'vimeo' 	=> 'Vimeo',
					)
                ),

				'SMP_imageurl' => array(
                    'type' => 'input-type-text',
                    'std' =>  $SMPNEW->path('INCLUDE_URL', '/frontpage/images/banner.jpg'),
                    'size' => 'small',
                    'title' => "Image URL:",
                    //'force_width' => '250',
                    'desc' => "Request image full URL.",
					'events-asign'	=> 'image',
					'hidden' => 'true'
                ),


				'SMP_videoembed' => array(
                    'type' => 'input-type-text',
                    'std' => 'https://www.youtube.com/embed/kyrvWDTrsdU',
                    'size' => 'small',
                    'title' => "Video URL:",
                    //'force_width' => '250',
                    'desc' => "Request Youtube/Vimeo video URL. Vimeo example: https://player.vimeo.com/video/206713775 || Youtube example: https://www.youtube.com/embed/kyrvWDTrsdU",
					'events-asign'	=> 'video',
					'hidden' => 'true'
                ),


				'SMP_iframeurl' => array(
                    'type' => 'input-type-text',
                    'std' => 'http://aa-team.com',
                    'size' => 'small',
                    'title' => "Iframe URL:",
                    //'force_width' => '250',
                    'desc' => "Request page full URL. e.g: http://aa-team.com",
					'events-asign'	=> 'iframe',
					'hidden' => 'true'
                ),



				'SMP_html' => array(
                    'type' => 'textarea',
                    'std' => 'Insert Full HTML code here.',
                    'size' => 'small',
                    'title' => "HTML:",
                    //'force_width' => '250',
                    'desc' => "Full HTML code.",
					'events-asign'	=> 'html',
					'hidden' => 'true'
                ),


				'SMP_slide' => array(
                    'type' => 'textarea',
                    'std' => '<div id="new"><span>NEW</span></div><br/><h2>I am a notification popup that is not too distracting or in your face. Scroll down or close me and I will go away. You will still be able to open me later so do not worry.</h2><a href="#" target="_blank" class="button">View Details</a>',
                    'size' => 'small',
                    'title' => "Slide PopUp Content:",
                    //'force_width' => '250',
                    'desc' => "Slide PopUp Content.",
          					'events-asign'	=> 'html',
          					'hidden' => 'true'
                ),
				/* Video tutorial */

				/*'SMP_smartPopup_copyright' => array(
                    'type' => 'starttab',
                    'size' => 'small',
                    'title' => "Copyright:",
                    //'force_width' => '250',
                ),*/

				'SMP_doc' => array(
                    'type' => 'textfield',
                    'std' => '',
                    'size' => 'small',
                    'title' => "Documentation:",
                    //'force_width' => '250',
                    'desc' => '<iframe src="'.($SMPNEW->path( 'DOCS_URL' )).'/index.html" width="100%" height="600" frameborder="0"></iframe>',

                ),


				/*
		array(	"name" => "doc",
				"desc" => '<iframe src="'.(SMPOPUP_URLPATH).'/documentation/index.html" width="100%" height="600" frameborder="0"></iframe>',
				"type" => "textfield"),
			*/






	), // end elements
));
