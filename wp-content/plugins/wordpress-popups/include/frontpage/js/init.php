<?php 
// change header to javascript
header("content-type: application/x-javascript");

/*
if ( !defined('WP_LOAD_PATH') ) {

	// classic root path if wp-content and plugins is below wp-config.php
	$classic_root = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . '/' ;
	
	if (file_exists( $classic_root . 'wp-load.php') )
		define( 'WP_LOAD_PATH', $classic_root);
	else
		if (file_exists( $path . 'wp-load.php') )
			define( 'WP_LOAD_PATH', $path);
		else
			exit("Could not find wp-load.php");
}
// let's load WordPress
require_once( WP_LOAD_PATH . 'wp-load.php');
*/

if ( !defined('ABSPATH') ) {
    $absolute_path = __FILE__;
    $path_to_file = explode( 'wp-content', $absolute_path );
    $path_to_wp = $path_to_file[0];

    /** Set up WordPress environment */
    require_once( $path_to_wp.'/wp-load.php' );
}




//define( 'SMPOPUP_SHORTNAME', 'SMP' );

global $SMPNEW;
$settings = $SMPNEW->settings();
//var_dump('<pre>', $settings , '</pre>'); echo __FILE__ . ":" . __LINE__;die . PHP_EOL;
?>
// close welcome box
function closePopup(){
	jQuery("div#smartPopupfade").fadeOut(<?php echo $settings[SMPOPUP_ALIAS . '_fadeOutTime'];?>);
	jQuery("div.smartPopup").fadeOut(<?php echo $settings[SMPOPUP_ALIAS . '_fadeOutTime'];?>);
	jQuery("div#pietimerholder").fadeOut(<?php echo $settings[SMPOPUP_ALIAS . '_fadeOutTime'];?>);
	jQuery("div.smartPopup").remove();
}
				
jQuery(document).ready(function() {
	// init smartPopup
	smartPopup({
		'fadeOpacity'		: <?php echo $settings[SMPOPUP_ALIAS . '_fadeOpacity'];?>,
		'fadeBackground'	: '<?php echo $settings[SMPOPUP_ALIAS . '_fadeBackground'];?>',
		'fadeOutTime'		: <?php echo $settings[SMPOPUP_ALIAS . '_fadeOutTime'];?>,
		'fadeInTime'		: <?php echo $settings[SMPOPUP_ALIAS . '_fadeInTime'];?>,
		'boxWidth'			: <?php echo $settings[SMPOPUP_ALIAS . '_width'];?>,
		'boxHeight'			: <?php echo $settings[SMPOPUP_ALIAS . '_height'];?>,
		'showOn'			: '<?php echo $settings[SMPOPUP_ALIAS . '_showOn'];?>'
	});
	
	canvasPieTimer.timeLimit = <?php echo (int)$settings[SMPOPUP_ALIAS . '_autoclose'] * 1000;?>;
});
var IEtimeLimit = <?php echo (int)$settings[SMPOPUP_ALIAS . '_autoclose'] * 1000;?>;