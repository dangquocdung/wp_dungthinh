<?php
// main Ultimate Image Gallery Wordpress Plugin plugin class
class FWDUIG
{
	// constants
	const MIN_WP_VER =  "3.5.0";
	const CAPABILITY = "edit_fwduig";
	const VERSION = "1.0";
	
	// variables
	private $_data;
	private $_dir_url;
    
    private static $_uig_id = 0;
    
    // constructor
    public function init()
    {
		$this->_dir_url = plugin_dir_url(dirname(__FILE__));
		
		// set data
		$this->_data = new FWDUIGData();		
		$this->_data->init();
		
    	// set hooks
    	add_action("admin_menu", array($this, "add_plugin_menu"));
		add_action("wp_enqueue_scripts", array($this, "add_header_files"));
		add_shortcode("fwduig", array($this, "set_uigerflow"));
    }
    // functions
    public function add_plugin_menu()
    {
    	// add menus
        add_menu_page("Gallery Title", "Ultimate Image Gallery", FWDUIG::CAPABILITY, "FWDUIGMenu-General-Settings", array($this, "set_general_settings"), $this->_dir_url . "load/icons/menu-icon.png");
       	add_submenu_page("FWDUIGMenu-General-Settings", "General settings", "General settings", FWDUIG::CAPABILITY, "FWDUIGMenu-General-Settings");
       	add_submenu_page("FWDUIGMenu-General-Settings", "Playlists manager", "Playlists manager", FWDUIG::CAPABILITY, "FWDUIGMenu-Playlists-Manager", array($this, "set_playlists_manager"));
       	add_submenu_page("FWDUIGMenu-General-Settings", "CSS Editor", "CSS Editor", FWDUIG::CAPABILITY, "FWDUIGMenu-CSS-Editor", array($this, "set_css_editor"));
       	
       	// add meta boxes
       	$post_type_screens = array("post", "page");
    	foreach ($post_type_screens as $screen)
    	{
       		add_meta_box("fwduig-shortcode-generator", "Ultimate Image Gallery Shortcode Generator",  array($this, "set_custom_meta_box"), $screen, "side", "default");
    	}
    }
    
	private function check_wp_ver()
	{
	    global $wp_version;
	    
		$exit_msg = "The Ultimate Image Gallery requires WordPress " . FWDUIG::MIN_WP_VER . " or newer. <a href='http://codex.wordpress.org/Updating_WordPress'>Please update!</a>";
		
		if (version_compare($wp_version, FWDUIG::MIN_WP_VER) <= 0)
		{
			echo $exit_msg;
			
			return false;
		}
		
		return true;
	}
    public function set_general_settings()
    {
    	if (!$this->check_wp_ver())
    	{
    		return;
    	}
    	
    	$msg = "";
    	
    	$set_id = 0;
		$set_order_id = 0;
		$tab_init_id = 0;
    	
	    if (!empty($_POST) && check_admin_referer("fwduig_general_settings_update", "fwduig_general_settings_nonce"))
		{
			$data_obj = json_decode(str_replace("\\", "", $_POST["settings_data"]), true);
			
			$action = $data_obj["action"];
			$settingsAr = $data_obj["settings_ar"];
			
			$this->_data->settings_ar = $settingsAr;
			$this->_data->set_data();
			
			switch ($action)
			{
			    case "add":
			        $msg = "<div class='fwd-updated'><p style='padding:8px;'>Your new preset has been added!</p></div>";
			        $set_id = $data_obj["set_id"];
					$set_order_id = $data_obj["set_order_id"];
					$tab_init_id = $data_obj["tab_init_id"];
			        break;
			    case "save":
			        $msg = "<div class='fwd-updated'><p style='padding:8px;'>Your preset settings have been updated!</p></div>";
			        $set_id = $data_obj["set_id"];
					$set_order_id = $data_obj["set_order_id"];
					$tab_init_id = $data_obj["tab_init_id"];
			        break;
			    case "del":
			       	$msg = "<div class='fwd-updated'><p style='padding:8px;'>Your preset has been deleted!</p></div>";
			        break;
			}
		}
		
		// jquery ui
		wp_enqueue_style("fwduig_fwd_ui_css", $this->_dir_url . "css/fwd_ui.css");
		wp_enqueue_script("jquery-ui-tabs");
		wp_enqueue_script("jquery-ui-sortable");
		wp_enqueue_script("jquery-ui-accordion");
		wp_enqueue_script("jquery-ui-tooltip");
		
		// spectrum colorpicker
    	wp_enqueue_style("fwduig_spectrum_css", $this->_dir_url . "css/spectrum.css");
    	wp_enqueue_script("fwduig_spectrum_script", $this->_dir_url . "js/spectrum.js");
    	
    	// general settings script
		wp_enqueue_media();
        wp_enqueue_script("fwduig_general_settings_script", $this->_dir_url . "js/general_settings.js");
		
    	include_once "general_settings.php";
    }
    
 	public function set_playlists_manager()
    {
    	if (!$this->check_wp_ver())
    	{
    		return;
    	}
    	
    	$msg = "";
    	
	    if (!empty($_POST) && check_admin_referer("fwduig_playlist_manager_update", "fwduig_playlist_manager_nonce"))
		{
			$playlistsAr = json_decode(str_replace("\\", "", $_POST["playlist_data"]), true);
			
			$this->_data->playlists_ar = $playlistsAr;
			$this->_data->set_data();
			
			$msg = "<div class='fwd-updated'><p style='padding:8px;'>Your playlists have been updated!</p></div>";
		}
		
		// jquery ui
		wp_enqueue_style("fwduig_fwd_ui_css", $this->_dir_url . "css/fwd_ui.css");
		wp_enqueue_script("jquery-ui-tabs");
		wp_enqueue_script("jquery-ui-sortable");
		wp_enqueue_script("jquery-ui-accordion");
		wp_enqueue_script("jquery-ui-dialog");
		wp_enqueue_script("jquery-ui-tooltip");
		
		// playlist manager script
		wp_enqueue_media();
        wp_enqueue_script("fwduig_playlist_manager_script", $this->_dir_url . "js/playlist_manager.js");
        
    	include_once "playlist_manager.php";
    }
    
    public function set_css_editor()
    {
    	if (!$this->check_wp_ver())
    	{
    		return;
    	}
    	
    	$msg = "";
    	$scroll_pos = 0;
    	
    	$css_file = plugin_dir_path(dirname(__FILE__)) . "css/fwduig.css";
    	
	    if (!empty($_POST) && check_admin_referer("fwduig_css_editor_update", "fwduig_css_editor_nonce"))
		{
			$handle = fopen($css_file, "w") or die("Cannot open file: " . $css_file);
			
			$data = $_POST["css_data"];
			$scroll_pos = $_POST["scroll_pos"];
			
			fwrite($handle, $data);
			
			$msg = "<div class='fwd-updated'><p style='padding:8px;'>The CSS file has been updated!</p></div>";
		}
		
		wp_enqueue_style("fwduig_fwd_ui_css", $this->_dir_url . "css/fwd_ui.css");
	  			
		$handle = fopen($css_file, "r") or die("Cannot open file: " . $css_file);
        
    	include_once "css_editor.php";
    	
    	fclose($handle);
    }
    
	public static function set_action_links($links)
	{
		$settings_link = "<a href='" . get_admin_url(null, "admin.php?page=FWDUIGMenu-General-Settings") . "'>Settings</a>";
   		array_unshift($links, $settings_link);
   		
   		return $links;
	}
	
 	public function add_header_files(){
    	wp_enqueue_style("fwduig_uig_css", $this->_dir_url . "css/fwduig.css");
    	wp_enqueue_script("fwduig_uig_script", $this->_dir_url . "js/FWDUIG.js");
    }
    
    public function get_constructor($sid, $pid)
    {
    	$preset = NULL;
    	
    	foreach ($this->_data->settings_ar as $set)
    	{
    		if ($set["name"] == $sid)
    		{
    			$preset = $set;
    		}
    	}
    	
    	if (is_null($preset))
    	{
    		return "Preset with id ". $sid . " does not exist!";
    	}
    	
    	$playlist = NULL;
    	
    	foreach ($this->_data->playlists_ar as $pl)
    	{
    		if ($pl["name"] == $pid)
    		{
    			$playlist = $pl;
    		}
    	}
    	 	
    	if (is_null($playlist))
    	{
    		return "Playlist with id ". $pid . " does not exist!";
    	}
    	
    	return "<script type='text/javascript'>document.addEventListener('DOMContentLoaded', function(event) {FWDUIGUtils.checkIfHasTransofrms();window.fwduig" . FWDUIG::$_uig_id. " = new FWDUIG({" . "parentId:'fwduigDiv" . FWDUIG::$_uig_id. "',instanceName:'fwduig" . FWDUIG::$_uig_id . "',playlistId:'fwduigPlaylist" . $pid . "', skinPath:'" . $preset['skinPath'] . "', mainFolderPath:'" . $this->_dir_url . "load'," ."displayType:'" . $preset['display_type'] . "',rightClickContextMenu:'" . $preset['rightClickContextMenu'] . "',buttonsAlignment:'" . $preset['buttonsAlignment'] . "',thumbnailMaxWidth:'" . $preset['thumbnailMaxWidth'] . "',useDeepLinking:'" . $preset['useDeepLinking'] . "',autoScale:'" . $preset['autoScale'] . "',showSearchInput:'" . $preset['showSearchInput'] . "',randomizeAllCategories:'" . $preset['randomizeCategories'] . "',randomizeCategories:'" . $preset['randomizeCategories'] . "',slideShowAutoPlay:'" . $preset['slideShowAutoPlay'] . "',addKeyboardSupport:'" . $preset['addKeyboardSupport'] . "',showFullScreenButton:'" . $preset['showFullScreenButton'] . "',showFacebookButton:'" . $preset['showFacebookButton'] . "',showZoomButton:'" . $preset['showZoomButton'] . "',showSlideShowButton:'" . $preset['showSlideShowButton'] . "',showNextAndPrevButtons:'" . $preset['showNextAndPrevButtons'] . "',showNextAndPrevButtonsOnMobile:'" . $preset['showNextAndPrevButtonsOnMobile'] . "',fluidWidthZIndex:" . $preset['fluidWidthZIndex'] . ",maxWidth:" . $preset['maxWidth'] . ",maxHeight:" . $preset['maxHeight'] . ",startAtItem:" . $preset['startAtItem'] . ",buttonsHideDelay:" . $preset['buttonsHideDelay'] . ",slideShowDelay:" . $preset['slideShowDelay'] . ",itemOffsetHeight:" . $preset['itemOffsetHeight'] . ",spaceBetweenButtons:" . $preset['spaceBetweenButtons'] . ",buttonsOffsetIn:" . $preset['buttonsOffsetIn'] . ",buttonsOffsetOut:" . $preset['buttonsOffsetOut'] . ",itemBorderSize:" . $preset['itemBorderSize'] . ",itemBorderRadius:" . $preset['itemBorderRadius'] . ",itemBoxShadow:'" . $preset['itemBoxShadow'] . "',itemBackgroundColor:'" . $preset['itemBackgroundColor'] . "',itemBorderColor:'" . $preset['itemBorderColor'] . "',backgroundColor:'" . $preset['backgroundColor'] . "'," ."showThumbnails:'" . $preset['showThumbnails'] . "',showThumbnailsHideOrShowButton:'" . $preset['showThumbnailsHideOrShowButton'] . "',showThumbnailsByDefault:'" . $preset['showThumbnailsByDefault'] . "',showThumbnailsOverlay:'" . $preset['showThumbnailsOverlay'] . "',thumbnailsBackgroundOffestWidthAndHeight:'" . $preset['thumbnailsBackgroundOffestWidthAndHeight'] . "',thumbnailWidth:" . $preset['thumbnailWidth'] . ",thumbnailHeight:" . $preset['thumbnailHeight'] . ",thumbnailsBorderSize:" . $preset['thumbnailsBorderSize'] . ",thumbnailsBorderRadius:" . $preset['thumbnailsBorderRadius'] . ",spaceBetweenThumbnailsAndItem:" . $preset['spaceBetweenThumbnailsAndItem'] . ",thubnaisOffsetTopAndBottom:" . $preset['thubnaisOffsetTopAndBottom'] . ",spaceBetweenThumbnails:" . $preset['spaceBetweenThumbnails'] . ",thumbnailsOverlayOpacity:" . $preset['thumbnailsOverlayOpacity'] . ",thumbnailsMainBackgroundColor:'" . $preset['thumbnailsMainBackgroundColor'] . "',thumbnailsSecondaryBackgroundColor:'" . $preset['thumbnailsSecondaryBackgroundColor'] . "',thumbnailsOverlayColor:'" . $preset['thumbnailsOverlayColor'] . "',thumbnailsBorderNormalColor:'" . $preset['thumbnailsBorderNormalColor'] . "',thumbnailsBackgroundColor:'" . $preset['thumbnailsBackgroundColor'] . "',thumbnailsBorderSelectedColor:'" . $preset['thumbnailsBorderSelectedColor'] . "'," . 	"showLargeThumbnail:'" . $preset['showLargeThumbnail'] . "',largeThumbanilBackgroundColor:'" . $preset['largeThumbanilBackgroundColor'] . "',largeThumbnailBorderSize:" . $preset['largeThumbnailBorderSize'] . ",largeImageWidth:" . $preset['largeImageWidth'] . "," . "startAtCategory:" . ($preset['startAtCategory']) . ",showCategoriesMenuButton:'" . $preset['showCategoriesMenuButton'] . "',categoriesBackgorundColor:'" . $preset['categoriesBackgorundColor'] . "',thumbnailBackgroundColor:'" . $preset['thumbnailBackgroundColor'] . "',thumbnailTextBackgroundColor:'" . $preset['thumbnailTextBackgroundColor'] . "',inputBackgroundColor:'" . $preset['inputBackgroundColor'] . "'," . "descriptionWindowPosition:'" . $preset['descriptionWindowPosition'] . "',showDescriptionButton:'" . $preset['showDescriptionButton'] . "',showDescriptionByDefault:'" . $preset['showDescriptionByDefault'] . "',descriptionWindowBackgroundColor:'" . $preset['descriptionWindowBackgroundColor'] . "',descriptionWindowBackgroundOpacity:" . $preset['descriptionWindowBackgroundOpacity'] . "," . 					"showSearchInput:'" . $preset['showSearchInput'] . "',showCategoriesMenuButton:'" . $preset['showCategoriesMenuButton'] . "',thumbnailMaxWidth:" . $preset['thumbnailMaxWidth'] . ",thumbnailMaxHeight:" . $preset['thumbnailMaxHeight'] . ",horizontalSpaceBetweenThumbnails:'" . $preset['horizontalSpaceBetweenThumbnails'] . "',verticalSpaceBetweenThumbnails:'" . $preset['verticalSpaceBetweenThumbnails'] . "',thumbnailBackgroundColor:'" . $preset['thumbnailBackgroundColor'] . "',thumbnailTextBackgroundColor:'" . $preset['thumbnailTextBackgroundColor'] . "',inputBackgroundColor:'" . $preset['inputBackgroundColor'] . "',inputColor:'" . $preset['inputColor'] . "'	})});</script>";
    }
    
    public function get_playlist($pid){
    	$playlist = NULL;
    	
    	foreach ($this->_data->playlists_ar as $pl){
    		if ($pl["name"] == $pid){
    			$playlist = $pl;
    		}
    	}
    	
    	if (is_null($playlist)){
    		return "Playlist with id ". $pid . " does not exist!";
    	}
		
    	$playlist_str = "<div id='fwduigPlaylist$pid' style='display: none;'>";
    	
    	foreach ($playlist["categories"] as $category){
			
    		$playlist_str .= "<ul>";
			if(isset($category["thumb"]) && strlen($category["thumb"]) >= 3){
				$playlist_str .= "<li data-thumbnail-path='" . $category["thumb"] . "'>";
			}
			$playlist_str .= $category["text"];
			$playlist_str .= "</li>";
    		
    		foreach ($category["thumbs"] as $thumb){
				
				$playlist_str .= "<li data-url='" . $thumb["url"] . "'";
					
				$playlist_str .= ">";
					
				if(isset($thumb["info"]) && strlen($thumb["info"]) >= 3){
					$playlist_str .= "<div>" . $thumb["info"] . "</div>";
				}
				
				$playlist_str .= "</li>";
				 
    		}
    	
    		$playlist_str .= "</ul>";
    	}
    	
    	$playlist_str .= "</div>";
    	
    	return $playlist_str;
    }
    
 	public function set_uigerflow($atts)
	{
		extract(shortcode_atts(array("preset_id" => 0, "playlist_id" => 0), $atts, "fwduig"));
		
		$cov_constructor = $this->get_constructor($preset_id, $playlist_id);
		$cov_div = "<div id='fwduigDiv" . FWDUIG::$_uig_id. "'></div>";
		$cov_playlist = $this->get_playlist($playlist_id);
		
		FWDUIG::$_uig_id++;
		
		$cov_output = $cov_constructor . $cov_div . $cov_playlist;
		
		return $cov_output;
	}
	
	public function set_custom_meta_box($post){
		if (!$this->check_wp_ver()){
    		return;
    	}
		
		// presets
		$presetsNames = array();
		
		foreach ($this->_data->settings_ar as $setting){
    		$el = array(
    						"id" => $setting["id"],
    						"name" => $setting["name"]
    				   );
    				   
    		array_push($presetsNames, $el);
    	}
    	
		// playlists
		$playlistsNames = array();

		if (isset($this->_data->playlists_ar))
		{
			foreach ($this->_data->playlists_ar as $playlist)
	    	{
	    		$el = array(
	    						"id" => $playlist["id"],
	    						"name" => $playlist["name"]
	    				   );
	    				   
	    		array_push($playlistsNames, $el);
	    	}
		}
		
    	wp_enqueue_style("fwduig_fwd_ui_css", $this->_dir_url . "css/fwd_ui.css");
		wp_enqueue_script("fwduig_shortcode_script", $this->_dir_url . "js/shortcode.js");
		
    	include_once "meta_box.php";
	}
}
?>