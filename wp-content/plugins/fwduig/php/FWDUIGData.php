<?php

// main FWD Simple 3D Gallery Data class
class FWDUIGData
{
	// constants
	const DEFAULT_SKINS_NR = 2;
	
	// variables
	public $settings_ar;
    public $playlists_ar;
	
	private $_dir_url;
	
    // constructor
    public function init()
    {
		$this->_dir_url = plugin_dir_url(dirname(__FILE__));
		
		//$this->reset_presets();
		
		$cur_data = get_option("fwduig_data");
   
	    if (!$cur_data)
	    {
	    	$this->init_settings();
	    	$this->set_data();
	    }
    	
    	$this->set_updates();
    	
    	$this->get_data();
    }
	
	private function reset_presets()
	{
		$this->get_data();
		$this->init_settings();
	    $this->set_data();
	}
	
	private function set_updates(){
		$this->get_data();
		
   		foreach ($this->settings_ar as &$preset){
			// update new or existing fields
			/*
	    	if (!array_key_exists("showSlideShowAnimation", $preset)){
	    		$preset["showSlideShowAnimation"] = "no";
			}						
			*/
    	}
		$this->set_data();
	}
    
    // functions
    private function init_settings()
    {
    	$this->settings_ar = array(
									array(
											//main settings
											"id" => 0,
											"name" => "dark-skin",
											"display_type" => "fluidwidth",
											"parentId" => "myDiv",
											"skinPath" => "dark_skin",
											"playlistId" => "myPlaylist",
											"rightClickContextMenu" => "developer",
											"buttonsAlignment" => "in",
											"useDeepLinking" => "yes",
											"autoScale" => "yes",
											"randomizeCategories" => "no",
											"hideAllButtons" => "no",
											"slideShowAutoPlay" => "no",
											"addKeyboardSupport" => "yes",
											"showFullScreenButton" => "yes",
											"showFacebookButton" => "yes",
											"showZoomButton" => "yes",
											"showSlideShowButton" => "yes",
											"showNextAndPrevButtons" => "yes",
											"showNextAndPrevButtonsOnMobile" => "yes",
											"fluidWidthZIndex" => 999999999,
											"maxWidth" => 960,
											"maxHeight" => 800,
											"startAtItem" => 0,
											"buttonsHideDelay" => 3,
											"slideShowDelay" => 4,
											"itemOffsetHeight" => 20,
											"spaceBetweenButtons" => 3,
											"buttonsOffsetIn" => 4,
											"buttonsOffsetOut" => 4,
											"itemBorderSize" => 0,
											"itemBorderRadius" => 0,
											"backgroundOpacity" => 0.7,
											"spaceBetweenControllBarButtons" => 2,
											"itemBoxShadow" => "none",
											"itemBackgroundColor" => "#333333",
											"itemBorderColor" => "#FFFFFF",
											"backgroundColor" => "#000000",
											//thumbnail settings
											"showThumbnails" => "yes",
											"showThumbnailsHideOrShowButton" => "yes",
											"showThumbnailsByDefault" => "yes",
											"showThumbnailsOverlay" => "yes",
											"thumbnailsBackgroundOffestWidthAndHeight" => 5,
											"thumbnailWidth" => 40,
											"thumbnailHeight" => 40,
											"thumbnailsBorderSize" => 1,
											"thumbnailsBorderRadius" => 0,
											"spaceBetweenThumbnailsAndItem" => 0,
											"thubnaisOffsetTopAndBottom" => 5,
											"spaceBetweenThumbnails" => 5,
											"thumbnailsOverlayOpacity" =>.7,
											"thumbnailsMainBackgroundColor" => "transparent",
											"thumbnailsSecondaryBackgroundColor" => "#333333",
											"thumbnailsOverlayColor" => "#000000",
											"thumbnailsBorderNormalColor" => "#FFFFFF",
											"thumbnailsBorderSelectedColor" => "#333333",
											"thumbnailsBackgroundColor" => "#333333",
											//large thumbnails settings
											"showLargeThumbnail" => "yes",
											"largeThumbnailBorderSize" => 1,
											"largeImageWidth" => 150,
											"largeThumbanilBackgroundColor" => "#FFFFFF",
											//description settings
											"descriptionWindowPosition" => "bottom",
											"showDescriptionButton" => "yes",
											"showDescriptionByDefault" => "no",
											"descriptionWindowBackgroundColor" => "#FFFFFF",
											"descriptionWindowBackgroundOpacity" => .9,
											//categories settings
											"showCategoriesMenuButton" => "yes",
											"showSearchInput" => "yes",
											"startAtCategory" => 0,
											"thumbnailMaxWidth" => 350,
											"thumbnailMaxHeight" => 350,
											"horizontalSpaceBetweenThumbnails" => 40,
											"verticalSpaceBetweenThumbnails" => 40,
											"categoriesBackgorundColor" => "#000000",
											"thumbnailBackgroundColor" => "#333333",
											"thumbnailTextBackgroundColor" => "rgba(255, 255, 255, .9)",
											"inputBackgroundColor" => "#333333",
											"inputColor" => "#999999"
									),
					    			array(
					    					//main settings
											"id" => 1,
											"name" => "white-skin",
											"display_type" => "fluidwidth",
											"parentId" => "myDiv",
											"skinPath" => "dark_skin",
											"playlistId" => "myPlaylist",
											"rightClickContextMenu" => "developer",
											"buttonsAlignment" => "in",
											"useDeepLinking" => "yes",
											"autoScale" => "yes",
											"randomizeCategories" => "no",
											"hideAllButtons" => "no",
											"slideShowAutoPlay" => "no",
											"addKeyboardSupport" => "yes",
											"showFullScreenButton" => "yes",
											"showFacebookButton" => "yes",
											"showZoomButton" => "yes",
											"showSlideShowButton" => "yes",
											"showNextAndPrevButtons" => "yes",
											"showNextAndPrevButtonsOnMobile" => "yes",
											"fluidWidthZIndex" => 999999999,
											"maxWidth" => 960,
											"maxHeight" => 800,
											"startAtItem" => 0,
											"buttonsHideDelay" => 3,
											"slideShowDelay" => 4,
											"itemOffsetHeight" => 20,
											"spaceBetweenButtons" => 3,
											"buttonsOffsetIn" => 4,
											"buttonsOffsetOut" => 4,
											"itemBorderSize" => 0,
											"itemBorderRadius" => 0,
											"backgroundOpacity" => 0.7,
											"spaceBetweenControllBarButtons" => 2,
											"itemBoxShadow" => "none",
											"itemBackgroundColor" => "#666666",
											"itemBorderColor" => "#222222",
											"backgroundColor" => "#eef0f1",
											//thumbnail settings
											"showThumbnails" => "yes",
											"showThumbnailsHideOrShowButton" => "yes",
											"showThumbnailsByDefault" => "yes",
											"showThumbnailsOverlay" => "yes",
											"thumbnailsBackgroundOffestWidthAndHeight" => 5,
											"thumbnailWidth" => 40,
											"thumbnailHeight" => 40,
											"thumbnailsBorderSize" => 1,
											"thumbnailsBorderRadius" => 0,
											"spaceBetweenThumbnailsAndItem" => 0,
											"thubnaisOffsetTopAndBottom" => 5,
											"spaceBetweenThumbnails" => 5,
											"thumbnailsOverlayOpacity" =>.7,
											"thumbnailsMainBackgroundColor" => "transparent",
											"thumbnailsSecondaryBackgroundColor" => "#666666",
											"thumbnailsOverlayColor" => "#000000",
											"thumbnailsBorderNormalColor" => "#222222",
											"thumbnailsBorderSelectedColor" => "#444444",
											"thumbnailsBackgroundColor" => "#666666",
											//large thumbnails settings
											"showLargeThumbnail" => "yes",
											"largeThumbnailBorderSize" => 1,
											"largeImageWidth" => 150,
											"largeThumbanilBackgroundColor" => "#444444",
											//description settings
											"descriptionWindowPosition" => "bottom",
											"showDescriptionButton" => "yes",
											"showDescriptionByDefault" => "no",
											"descriptionWindowBackgroundColor" => "#FFFFFF",
											"descriptionWindowBackgroundOpacity" => .9,
											//categories settings
											"showCategoriesMenuButton" => "yes",
											"showSearchInput" => "yes",
											"startAtCategory" => 0,
											"thumbnailMaxWidth" => 350,
											"thumbnailMaxHeight" => 350,
											"horizontalSpaceBetweenThumbnails" => 40,
											"verticalSpaceBetweenThumbnails" => 40,
											"categoriesBackgorundColor" => "#eef0f1",
											"thumbnailBackgroundColor" => "#666666",
											"thumbnailTextBackgroundColor" => "rgba(255, 255, 255, .9)",
											"inputBackgroundColor" => "#333333",
											"inputColor" => "#999999"
					    			)
							      );
    }

    public function get_data()
    {
	    $cur_data = get_option("fwduig_data");
	       
	    $this->settings_ar = $cur_data->settings_ar;
	    $this->playlists_ar = $cur_data->playlists_ar;
    }
    
    public function set_data(){
    	update_option("fwduig_data", $this);
    }
}

?>