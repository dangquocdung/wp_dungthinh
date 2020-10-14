jQuery(document).ready(function($)
{
	var DEFAULT_SKINS_NR = 2;
	
	var cur_settings_obj;
	
	$("#tabs").tabs();
	
	$("#backgroundColor").spectrum(
	{
  	    color: "#DDDDDD",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
	
	// gallery bg image custom uploader
	var cov_bg_custom_uploader;
    
    $("#cov_bg_image_btn").click(function(e)
    {
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (cov_bg_custom_uploader)
        {
        	cov_bg_custom_uploader.open();
            return;
        }
        
        //Extend the wp.media object
        cov_bg_custom_uploader = wp.media.frames.file_frame = wp.media(
        {
            title: "Choose Image",
            button:
            {
                text: "Add Image"
            },
            library:
            {
            	type: "image"
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        cov_bg_custom_uploader.on("select", function()
        {
            attachment = cov_bg_custom_uploader.state().get("selection").first().toJSON();
            
            $("#cov_bg_image_url").val(attachment.url);
            $("#cov_bg_upload_img").attr("src", attachment.url);
        });
 
        //Open the uploader dialog
        cov_bg_custom_uploader.open();
    });
    
    $("#thumbnailsOverlayColor").spectrum(
	{
  	    color: "#666666",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
    
    $("#thumbnailsBorderNormalColor").spectrum(
	{
  	    color: "#FCFDFD",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
	
	 $("#largeThumbanilBackgroundColor").spectrum(
	{
  	    color: "#FCFDFD",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
	
	
	
	 $("#thumbnailsMainBackgroundColor").spectrum(
	{
  	    color: "#FCFDFD",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
    
	$("#thumbnailsBackgroundColor").spectrum(
	{
  	    color: "#FCFDFD",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
	
	$("#thumbnailsSecondaryBackgroundColor").spectrum(
	{
  	    color: "#FCFDFD",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
	
	
	
	
    $("#thumbnailsBorderSelectedColor").spectrum(
	{
  	    color: "#E4E4E4",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
    
    $("#thumb_gradient_color1").spectrum(
	{
  	    color: "rgba(0, 0, 0, 0)",
  	    showAlpha: true,
  	  	chooseText: "Update",
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
    
    $("#thumb_gradient_color2").spectrum(
	{
  	    color: "rgba(0, 0, 0, 1)",
  	    showAlpha: true,
  	  	chooseText: "Update",
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
    
    $("#descriptionWindowBackgroundColor").spectrum(
	{
  	    color: "#777777",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
    
    $("#scrollbar_text_normal_color").spectrum(
	{
  	    color: "#777777",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
    
    $("#scrollbar_text_selected_color").spectrum(
	{
  	    color: "#777777",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
    
    $("#thumbnailTextBackgroundColor").spectrum(
	{
  	    color: "#999999",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
	
	 $("#categoriesBackgorundColor").spectrum(
	{
  	    color: "#999999",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
	
	 $("#thumbnailBackgroundColor").spectrum(
	{
  	    color: "#999999",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
	
	
    
    $("#inputBackgroundColor").spectrum(
	{
  	    color: "#FFFFFF",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
	$("#inputColor").spectrum(
	{
  	    color: "#FFFFFF",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
	
    
    $("#lightbox_bg_color").spectrum(
	{
  	    color: "#000000",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
    
    $("#lightbox_info_bg_color").spectrum(
	{
  	    color: "#FFFFFF",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
    
    $("#lightbox_item_border_color1").spectrum(
	{
  	    color: "#FCFDFD",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
    
    $("#lightbox_item_border_color2").spectrum(
	{
  	    color: "#E4E4E4",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
    
    $("#lightbox_item_bg_color").spectrum(
	{
  	    color: "#333333",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
	
	$("#bullets_normal_color").spectrum(
	{
  	    color: "#333333",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
	
	$("#bullets_selected_color").spectrum(
	{
  	    color: "#333333",
  	  	chooseText: "Update",
  	  	showInitial: true,
  	  	showInput: true,
  	  	allowEmpty:true,
  	  	preferredFormat: "hex6"
  	});
    
    $("#tabs").tooltip(
    {
        position:
        {
    		my: "center bottom-10",
    		at: "center top"
        }
    });
	
	$("#itemBorderColor").spectrum({


  	    color: "#5a5a5a",


  	  	chooseText: "Update",


  	  	showInitial: true,


  	  	showInput: true,


  	  	allowEmpty:true,


  	  	preferredFormat: "hex6"


  	});


	


	$("#combo_box_shadow_color").spectrum({


  	    color: "#5a5a5a",


  	  	chooseText: "Update",


  	  	showInitial: true,


  	  	showInput: true,


  	  	allowEmpty:true,


  	  	preferredFormat: "hex6"


  	});


	


	$("#videoControllerBackgroundColor").spectrum({


  	    color: "#5a5a5a",


  	  	chooseText: "Update",


  	  	showInitial: true,


  	  	showInput: true,


  	  	allowEmpty:true,


  	  	preferredFormat: "hex6"


  	});


	


	$("#videoPosterBackgroundColor").spectrum({


  	    color: "#5a5a5a",


  	  	chooseText: "Update",


  	  	showInitial: true,


  	  	showInput: true,


  	  	allowEmpty:true,


  	  	preferredFormat: "hex6"


  	});

	
	$("#audioControllerBackgroundColor").spectrum({


  	    color: "#5a5a5a",


  	  	chooseText: "Update",


  	  	showInitial: true,


  	  	showInput: true,


  	  	allowEmpty:true,


  	  	preferredFormat: "hex6"


  	});
	
	


	


	$("#audio_controller_background_color").spectrum({


  	    color: "#5a5a5a",


  	  	chooseText: "Update",


  	  	showInitial: true,


  	  	showInput: true,


  	  	allowEmpty:true,


  	  	preferredFormat: "hex6"


  	});
	
	$("#timeColor").spectrum({


  	    color: "#5a5a5a",


  	  	chooseText: "Update",


  	  	showInitial: true,


  	  	showInput: true,


  	  	allowEmpty:true,


  	  	preferredFormat: "hex6"


  	});
	
	$("#itemBackgroundColor").spectrum({


  	    color: "#5a5a5a",


  	  	chooseText: "Update",


  	  	showInitial: true,


  	  	showInput: true,


  	  	allowEmpty:true,


  	  	preferredFormat: "hex6"


  	});

    function setSettings() {
    	var settings_obj = settingsAr[cur_order_id];
    	
    	// main settings
    	$("#name").val(settings_obj.name);
		$("#skinPath").val(settings_obj.skinPath);
    	$("#display_type").val(settings_obj.display_type);
    	$("#autoScale").val(settings_obj.autoScale);
    	$("#maxWidth").val(settings_obj.maxWidth);
    	$("#maxHeight").val(settings_obj.maxHeight);
    	$("#skinPath").val(settings_obj.skinPath);
    	$("#backgroundColor").spectrum("set", settings_obj.backgroundColor != "transparent" ? settings_obj.backgroundColor : null);
    	$("#cov_bg_image_url").val(settings_obj.cov_bg_image_url);
    	$("#cov_bg_upload_img").attr("src", settings_obj.cov_bg_image_url);
    	$("#bg_repeat").val(settings_obj.bg_repeat);
    	$("#showFullScreenButton").val(settings_obj.showFullScreenButton);
		$("#useDeepLinking").val(settings_obj.useDeepLinking);
		$("#randomizeCategories").val(settings_obj.randomizeCategories);
		$("#hideAllButtons").val(settings_obj.hideAllButtons);
		
		
		
    	$("#showFacebookButton").val(settings_obj.showFacebookButton);
    	$("#showZoomButton").val(settings_obj.showZoomButton);
    	$("#startAtItem").val(settings_obj.startAtItem);
    	$("#buttonsHideDelay").val(settings_obj.buttonsHideDelay);
    	$("#showSlideShowButton").val(settings_obj.showSlideShowButton);
    	$("#showSlideShowAnimation").val(settings_obj.showSlideShowAnimation);
    	$("#showNextAndPrevButtons").val(settings_obj.showNextAndPrevButtons);
    	$("#cov_slideshow_delay").val(settings_obj.cov_slideshow_delay);
    	$("#rightClickContextMenu").val(settings_obj.rightClickContextMenu);
    	$("#addKeyboardSupport").val(settings_obj.addKeyboardSupport);
    	
    	
    	// thumbs settings
    	$("#thumbnailWidth").val(settings_obj.thumbnailWidth);
		$("#thumbnailHeight").val(settings_obj.thumbnailHeight);
		$("#largeThumbnailBorderSize").val(settings_obj.largeThumbnailBorderSize);
		$("#largeImageWidth").val(settings_obj.largeImageWidth);
		
		
		$("#thumbnailsBackgroundOffestWidthAndHeight").val(settings_obj.thumbnailsBackgroundOffestWidthAndHeight);
		
    	$("#thumbnailsBorderSize").val(settings_obj.thumbnailsBorderSize);
    	$("#thumbnailsBorderRadius").val(settings_obj.thumbnailsBorderRadius);
    	$("#spaceBetweenThumbnailsAndItem").val(settings_obj.spaceBetweenThumbnailsAndItem);
    	$("#thubnaisOffsetTopAndBottom").val(settings_obj.thubnaisOffsetTopAndBottom);
    	$("#spaceBetweenThumbnails").val(settings_obj.spaceBetweenThumbnails);
    	$("#thumb_x_space_2d").val(settings_obj.thumb_x_space_2d);
    	$("#thumb_hover_offset").val(settings_obj.thumb_hover_offset);
    	$("#thumb_border_size").val(settings_obj.thumb_border_size);		
		$("#thumbnailOffsetY").val(settings_obj.thumbnailOffsetY);		
    	$("#thumbnailsOverlayColor").spectrum("set", settings_obj.thumbnailsOverlayColor != "transparent" ? settings_obj.thumbnailsOverlayColor : null);
    	$("#thumbnailsBorderNormalColor").spectrum("set", settings_obj.thumbnailsBorderNormalColor != "transparent" ? settings_obj.thumbnailsBorderNormalColor : null);
		$("#largeThumbanilBackgroundColor").spectrum("set", settings_obj.largeThumbanilBackgroundColor != "transparent" ? settings_obj.largeThumbanilBackgroundColor : null);
		
		$("#thumbnailsMainBackgroundColor").spectrum("set", settings_obj.thumbnailsMainBackgroundColor != "transparent" ? settings_obj.thumbnailsMainBackgroundColor : null);
		$("#thumbnailsBackgroundColor").spectrum("set", settings_obj.thumbnailsBackgroundColor != "transparent" ? settings_obj.thumbnailsBackgroundColor : null);
		$("#thumbnailsSecondaryBackgroundColor").spectrum("set", settings_obj.thumbnailsSecondaryBackgroundColor != "transparent" ? settings_obj.thumbnailsSecondaryBackgroundColor : null);
		
    	$("#thumbnailsBorderSelectedColor").spectrum("set", settings_obj.thumbnailsBorderSelectedColor != "transparent" ? settings_obj.thumbnailsBorderSelectedColor : null);
    	$("#showThumbnails").val(settings_obj.showThumbnails);
		$("#showLargeThumbnail").val(settings_obj.showLargeThumbnail);
		
    	$("#showThumbnailsHideOrShowButton").val(settings_obj.showThumbnailsHideOrShowButton);
    	$("#max_thumbs_mobile").val(settings_obj.max_thumbs_mobile);
    	$("#showThumbnailsByDefault").val(settings_obj.showThumbnailsByDefault);
    	$("#thumb_gradient_color1").spectrum("set", settings_obj.thumb_gradient_color1 != "transparent" ? settings_obj.thumb_gradient_color1 : null);
    	$("#thumb_gradient_color2").spectrum("set", settings_obj.thumb_gradient_color2 != "transparent" ? settings_obj.thumb_gradient_color2 : null);
    	$("#showThumbnailsOverlay").val(settings_obj.showThumbnailsOverlay);
    	$("#text_offset").val(settings_obj.text_offset);
    	$("#showThumbnailsSmallIcon").val(settings_obj.showThumbnailsSmallIcon);
    	$("#box_shadow_css").val(settings_obj.box_shadow_css);
    	$("#thumbnailsHoverEffect").val(settings_obj.thumbnailsHoverEffect);
    	$("#dynamic_tooltip").val(settings_obj.dynamic_tooltip);
    	$("#show_reflection").val(settings_obj.show_reflection);
    	$("#reflection_height").val(settings_obj.reflection_height);
    	$("#reflection_distance").val(settings_obj.reflection_distance);
    	$("#thumbnailsOverlayOpacity").val(settings_obj.thumbnailsOverlayOpacity);
		$("#showNextAndPrevButtonsOnMobile").val(settings_obj.showNextAndPrevButtonsOnMobile);
	
		
		
    	// controls settings
    	$("#showDescriptionButton").val(settings_obj.showDescriptionButton);
    	$("#showDescriptionByDefault").val(settings_obj.showDescriptionByDefault);
    	$("#controls_offset").val(settings_obj.controls_offset);
    	$("#descriptionWindowAnimationType").val(settings_obj.descriptionWindowAnimationType);
		$("#large_next_and_prev_buttons_offest").val(settings_obj.large_next_and_prev_buttons_offest);
		$("#bullets_normal_radius").val(settings_obj.bullets_normal_radius);
		$("#bullets_selected_radius").val(settings_obj.bullets_selected_radius);
		$("#space_between_bullets").val(settings_obj.space_between_bullets);
		$("#bullets_offset").val(settings_obj.bullets_offset);
		$("#descriptionWindowPosition").val(settings_obj.descriptionWindowPosition);
    	$("#disable_btns_mobile").val(settings_obj.disable_btns_mobile);
    	$("#show_slideshow_btn").val(settings_obj.show_slideshow_btn);
		$("#show_bullets_navigation").val(settings_obj.show_bullets_navigation);
    	$("#descriptionWindowBackgroundColor").spectrum("set", settings_obj.descriptionWindowBackgroundColor != "transparent" ? settings_obj.descriptionWindowBackgroundColor : null);
    	$("#show_scrollbar").val(settings_obj.show_scrollbar);
    	$("#descriptionWindowBackgroundOpacity").val(settings_obj.descriptionWindowBackgroundOpacity);
    	$("#disable_scrollbar_mobile").val(settings_obj.disable_scrollbar_mobile);
    	$("#enable_mouse_wheel").val(settings_obj.enable_mouse_wheel);
		$("#scrollbar_text_normal_color").spectrum("set", settings_obj.scrollbar_text_normal_color != "transparent" ? settings_obj.scrollbar_text_normal_color : null);
		$("#scrollbar_text_selected_color").spectrum("set", settings_obj.scrollbar_text_selected_color != "transparent" ? settings_obj.scrollbar_text_selected_color : null);
		$("#bullets_normal_color").spectrum("set", settings_obj.bullets_normal_color != "transparent" ? settings_obj.bullets_normal_color : null);
		$("#bullets_selected_color").spectrum("set", settings_obj.bullets_selected_color != "transparent" ? settings_obj.bullets_selected_color : null);
    	
    	// categories menu settings
    	$("#showCategoriesMenuButton").val(settings_obj.showCategoriesMenuButton);
		$("#showSearchInput").val(settings_obj.showSearchInput);
		$("#randomizeAllCategories").val(settings_obj.randomizeAllCategories);
		$("#randomizeCategories").val(settings_obj.randomizeCategories);
		
		
		
    	$("#startAtCategory").val(settings_obj.startAtCategory);
		$("#thumbnailMaxWidth").val(settings_obj.thumbnailMaxWidth);
		$("#thumbnailMaxHeight").val(settings_obj.thumbnailMaxHeight);
		$("#horizontalSpaceBetweenThumbnails").val(settings_obj.horizontalSpaceBetweenThumbnails);
		$("#verticalSpaceBetweenThumbnails").val(settings_obj.verticalSpaceBetweenThumbnails);

    	$("#categories_menu_max_width").val(settings_obj.categories_menu_max_width);
    	$("#buttonBackgroundOpacity").val(settings_obj.buttonBackgroundOpacity);
    	$("#thumbnailTextBackgroundColor").spectrum("set", settings_obj.thumbnailTextBackgroundColor != "transparent" ? settings_obj.thumbnailTextBackgroundColor : null);
    	$("#inputBackgroundColor").spectrum("set", settings_obj.inputBackgroundColor != "transparent" ? settings_obj.inputBackgroundColor : null);
		$("#inputColor").spectrum("set", settings_obj.inputColor != "transparent" ? settings_obj.inputColor : null);
		
		$("#categoriesBackgorundColor").spectrum("set", settings_obj.categoriesBackgorundColor != "transparent" ? settings_obj.categoriesBackgorundColor : null);
		$("#thumbnailBackgroundColor").spectrum("set", settings_obj.thumbnailBackgroundColor != "transparent" ? settings_obj.thumbnailBackgroundColor : null);
    	
    	//lightbox settings
		$("#buttonsAlignment").val(settings_obj.buttonsAlignment);
		$("#itemBoxShadow").val(settings_obj.itemBoxShadow);
		$("#spaceBetweenControllBarButtons").val(settings_obj.spaceBetweenControllBarButtons);
		
		$("#useAudio").val(settings_obj.useAudio);
		$("#videoShowFullScreenButton").val(settings_obj.videoShowFullScreenButton);
		
		$("#slideShowAutoPlay").val(settings_obj.slideShowAutoPlay);
		$("#addKeyboardSupport").val(settings_obj.addKeyboardSupport);
		
		$("#addVideoKeyboardSupport").val(settings_obj.addVideoKeyboardSupport);
		$("#nextVideoOrAudioAutoPlay").val(settings_obj.nextVideoOrAudioAutoPlay);
		$("#videoAutoPlay").val(settings_obj.videoAutoPlay);
		$("#videoLoop").val(settings_obj.videoLoop);
		$("#audioAutoPlay").val(settings_obj.audioAutoPlay);
		$("#show_next_and_prev_buttons").val(settings_obj.show_next_and_prev_buttons);
		$("#showNextAndPrevButtonsOnMobile").val(settings_obj.showNextAndPrevButtonsOnMobile);
		$("#fluidWidthZIndex").val(settings_obj.fluidWidthZIndex);
		
		$("#audioLoop").val(settings_obj.audioLoop);
		$("#show_description_by_default").val(settings_obj.show_description_by_default);
		$("#video_show_full_screen_button").val(settings_obj.video_show_full_screen_button);
		$("#video_auto_play").val(settings_obj.video_auto_play);
		$("#next_video_or_audio_auto_play").val(settings_obj.next_video_or_audio_auto_play);
		$("#video_loop").val(settings_obj.video_loop);
		$("#audio_auto_play").val(settings_obj.audio_auto_play);
		$("#audio_loop").val(settings_obj.audio_loop);
		$("#videoControllerHideDelay").val(settings_obj.videoControllerHideDelay);
		$("#videoControllerHeight").val(settings_obj.videoControllerHeight);
		$("#audioControllerHeight").val(settings_obj.audioControllerHeight);
		$("#startSpaceBetweenButtons").val(settings_obj.startSpaceBetweenButtons);
		$("#vdSpaceBetweenButtons").val(settings_obj.vdSpaceBetweenButtons);
		$("#mainScrubberOffestTop").val(settings_obj.mainScrubberOffestTop);
		$("#scrubbersOffsetWidth").val(settings_obj.scrubbersOffsetWidth);
		$("#audioScrubbersOffestTotalWidth").val(settings_obj.audioScrubbersOffestTotalWidth);
		$("#timeOffsetLeftWidth").val(settings_obj.timeOffsetLeftWidth);
		$("#timeOffsetRightWidth").val(settings_obj.timeOffsetRightWidth);
		$("#volumeScrubberWidth").val(settings_obj.volumeScrubberWidth);
		
		$("#buttonsHideDelay").val(settings_obj.buttonsHideDelay);
		$("#slideShowDelay").val(settings_obj.slideShowDelay);
		$("#defaultItemWidth").val(settings_obj.defaultItemWidth);
		$("#defaultItemHeight").val(settings_obj.defaultItemHeight);
		$("#itemOffsetHeight").val(settings_obj.itemOffsetHeight);
		$("#spaceBetweenButtons").val(settings_obj.spaceBetweenButtons);
		$("#buttonsOffsetIn").val(settings_obj.buttonsOffsetIn);
		$("#buttonsOffsetOut").val(settings_obj.buttonsOffsetOut);
		$("#itemBorderSize").val(settings_obj.itemBorderSize);
		$("#itemBorderRadius").val(settings_obj.itemBorderRadius);
		$("#itemBorderColor").spectrum("set", settings_obj.itemBorderColor != "transparent" ? settings_obj.itemBorderColor : null);
		
		$("#itemBackgroundColor").spectrum("set", settings_obj.itemBackgroundColor != "transparent" ? settings_obj.itemBackgroundColor : null);
    }


    function init(){   
    	$.each(settingsAr, function(i, el)
		{
			$("#skins").append("<option value='" + el.id + "'>" + el.name + "</option>");
		});
    	
		
    	$("#skins").val(sid);
    	
    	if (cur_order_id < DEFAULT_SKINS_NR)
    	{
    		$("#update_btn").hide();
            $("#del_btn").hide();
    	}
    	else
    	{
    		$("#update_btn").show();
            $("#del_btn").show();
    	}
	    
	    setSettings();
	    
	    $("#preset_id").html("ID : " + sid);
	    
	    $("#tabs").tabs("option", "active", tab_init_id);
    }
    
    init();
    
    $("#skins").change(function()
    {
    	sid = parseInt($("#skins").val());
    	
    	$.each(settingsAr, function(i, el)
		{
			if (sid == el.id)
			{
				cur_order_id = i;
			}
		});
    	
    	setSettings();
    	
    	if (cur_order_id < DEFAULT_SKINS_NR)
    	{
    		$("#update_btn").hide();
            $("#del_btn").hide();
    	}
    	else
    	{
    		$("#update_btn").show();
            $("#del_btn").show();
    	}
    	
    	allFields.removeClass("ui-state-error");
    	$("#tips").text("All form fields are required.");
    	
    	$("#preset_id").html("ID : " + sid);
    });
    
    function updateSettings(){
		
    	// main settings
    	cur_settings_obj.id = sid;
    	cur_settings_obj.name = $("#name").val().replace(/"/g, "'");
		cur_settings_obj.skinPath = $("#skinPath").val().replace(/"/g, "'");
    	cur_settings_obj.display_type = $("#display_type").val();
    	cur_settings_obj.autoScale = $("#autoScale").val();
    	cur_settings_obj.maxWidth = parseInt($("#maxWidth").val());
		
    	cur_settings_obj.maxHeight = parseInt($("#maxHeight").val());
    	cur_settings_obj.skinPath = $("#skinPath").val().replace(/"/g, "'");
    	cur_settings_obj.backgroundColor = $("#backgroundColor").spectrum("get") ? $("#backgroundColor").spectrum("get").toHexString() : "transparent";
    	cur_settings_obj.bg_repeat = $("#bg_repeat").val();
    	cur_settings_obj.showFullScreenButton = $("#showFullScreenButton").val();
		cur_settings_obj.useDeepLinking = $("#useDeepLinking").val();
		cur_settings_obj.randomizeCategories = $("#randomizeCategories").val();
		
		
		
    	cur_settings_obj.showFacebookButton = $("#showFacebookButton").val();
    	cur_settings_obj.showZoomButton = $("#showZoomButton").val();
    	cur_settings_obj.startAtItem = parseInt($("#startAtItem").val());
    	cur_settings_obj.buttonsHideDelay = parseInt($("#buttonsHideDelay").val());
    	cur_settings_obj.showSlideShowButton = $("#showSlideShowButton").val();
    	cur_settings_obj.showSlideShowAnimation = $("#showSlideShowAnimation").val();
    	cur_settings_obj.showNextAndPrevButtons = $("#showNextAndPrevButtons").val();
    	cur_settings_obj.cov_slideshow_delay = parseInt($("#cov_slideshow_delay").val());
    	cur_settings_obj.rightClickContextMenu = $("#rightClickContextMenu").val();
    	cur_settings_obj.addKeyboardSupport = $("#addKeyboardSupport").val();
		
    	// thumbs settings
    	cur_settings_obj.thumbnailWidth = parseInt($("#thumbnailWidth").val());
		cur_settings_obj.thumbnailHeight = parseInt($("#thumbnailHeight").val());
		cur_settings_obj.largeThumbnailBorderSize = parseInt($("#largeThumbnailBorderSize").val());
		cur_settings_obj.largeImageWidth = parseInt($("#largeImageWidth").val());
		
		
		cur_settings_obj.thumbnailsBackgroundOffestWidthAndHeight = parseInt($("#thumbnailsBackgroundOffestWidthAndHeight").val());
		
    	cur_settings_obj.thumbnailsBorderSize = parseInt($("#thumbnailsBorderSize").val());
    	cur_settings_obj.thumbnailsBorderRadius = parseInt($("#thumbnailsBorderRadius").val());
    	cur_settings_obj.spaceBetweenThumbnailsAndItem = parseInt($("#spaceBetweenThumbnailsAndItem").val());
    	cur_settings_obj.thubnaisOffsetTopAndBottom = parseInt($("#thubnaisOffsetTopAndBottom").val());
    	cur_settings_obj.spaceBetweenThumbnails = parseInt($("#spaceBetweenThumbnails").val());
    	cur_settings_obj.thumb_x_space_2d = parseInt($("#thumb_x_space_2d").val());
    	cur_settings_obj.thumb_hover_offset = parseInt($("#thumb_hover_offset").val());
    	cur_settings_obj.thumb_border_size = parseInt($("#thumb_border_size").val());		cur_settings_obj.thumbnailOffsetY = $("#thumbnailOffsetY").val();		
    	cur_settings_obj.thumbnailsOverlayColor = $("#thumbnailsOverlayColor").spectrum("get") ? $("#thumbnailsOverlayColor").spectrum("get").toHexString() : "transparent";
    	cur_settings_obj.thumbnailsBorderNormalColor = $("#thumbnailsBorderNormalColor").spectrum("get") ? $("#thumbnailsBorderNormalColor").spectrum("get").toHexString() : "transparent";
		cur_settings_obj.largeThumbanilBackgroundColor = $("#largeThumbanilBackgroundColor").spectrum("get") ? $("#largeThumbanilBackgroundColor").spectrum("get").toHexString() : "transparent";
		
		
		cur_settings_obj.thumbnailsMainBackgroundColor = $("#thumbnailsMainBackgroundColor").spectrum("get") ? $("#thumbnailsMainBackgroundColor").spectrum("get").toHexString() : "transparent";
		cur_settings_obj.thumbnailsBackgroundColor = $("#thumbnailsBackgroundColor").spectrum("get") ? $("#thumbnailsBackgroundColor").spectrum("get").toHexString() : "transparent";
		cur_settings_obj.thumbnailsSecondaryBackgroundColor = $("#thumbnailsSecondaryBackgroundColor").spectrum("get") ? $("#thumbnailsSecondaryBackgroundColor").spectrum("get").toHexString() : "transparent";
		
		
    	cur_settings_obj.thumbnailsBorderSelectedColor = $("#thumbnailsBorderSelectedColor").spectrum("get") ? $("#thumbnailsBorderSelectedColor").spectrum("get").toHexString() : "transparent";
    	cur_settings_obj.showThumbnails = $("#showThumbnails").val();
		cur_settings_obj.showLargeThumbnail = $("#showLargeThumbnail").val();
		
    	cur_settings_obj.showThumbnailsHideOrShowButton = $("#showThumbnailsHideOrShowButton").val();
    	cur_settings_obj.max_thumbs_mobile = parseInt($("#max_thumbs_mobile").val());
    	cur_settings_obj.showThumbnailsByDefault = $("#showThumbnailsByDefault").val();
    	cur_settings_obj.showThumbnailsOverlay = $("#showThumbnailsOverlay").val();
    	cur_settings_obj.text_offset = parseInt($("#text_offset").val());
    	cur_settings_obj.showThumbnailsSmallIcon = $("#showThumbnailsSmallIcon").val();
    	cur_settings_obj.thumbnailsHoverEffect = $("#thumbnailsHoverEffect").val();
    	cur_settings_obj.dynamic_tooltip = $("#dynamic_tooltip").val();
    	cur_settings_obj.show_reflection = $("#show_reflection").val();
    	cur_settings_obj.reflection_height = parseInt($("#reflection_height").val());
    	cur_settings_obj.reflection_distance = parseInt($("#reflection_distance").val());
    	cur_settings_obj.thumbnailsOverlayOpacity = parseFloat($("#thumbnailsOverlayOpacity").val());
		cur_settings_obj.showNextAndPrevButtonsOnMobile = $("#showNextAndPrevButtonsOnMobile").val();
		cur_settings_obj.fluidWidthZIndex = $("#fluidWidthZIndex").val();
		

    	// controls settings
    	cur_settings_obj.showDescriptionButton = $("#showDescriptionButton").val();
    	cur_settings_obj.showDescriptionByDefault = $("#showDescriptionByDefault").val();
    	cur_settings_obj.controls_offset = parseInt($("#controls_offset").val());
    	cur_settings_obj.descriptionWindowAnimationType = $("#descriptionWindowAnimationType").val();
		cur_settings_obj.large_next_and_prev_buttons_offest = parseInt($("#large_next_and_prev_buttons_offest").val());
		cur_settings_obj.bullets_normal_radius = parseInt($("#bullets_normal_radius").val());
		cur_settings_obj.bullets_selected_radius = parseInt($("#bullets_selected_radius").val());
		cur_settings_obj.space_between_bullets = parseInt($("#space_between_bullets").val());
		cur_settings_obj.bullets_offset = parseInt($("#bullets_offset").val());
		
		
		cur_settings_obj.descriptionWindowPosition = $("#descriptionWindowPosition").val();
    	cur_settings_obj.disable_btns_mobile = $("#disable_btns_mobile").val();
    	cur_settings_obj.show_slideshow_btn = $("#show_slideshow_btn").val();
		cur_settings_obj.show_bullets_navigation = $("#show_bullets_navigation").val();
    	cur_settings_obj.descriptionWindowBackgroundColor = $("#descriptionWindowBackgroundColor").spectrum("get") ? $("#descriptionWindowBackgroundColor").spectrum("get").toHexString() : "transparent";
    	cur_settings_obj.show_scrollbar = $("#show_scrollbar").val();
    	cur_settings_obj.descriptionWindowBackgroundOpacity = $("#descriptionWindowBackgroundOpacity").val();
    	cur_settings_obj.disable_scrollbar_mobile = $("#disable_scrollbar_mobile").val();
    	cur_settings_obj.enable_mouse_wheel = $("#enable_mouse_wheel").val();	
		
    	// categories menu settings
    	cur_settings_obj.showCategoriesMenuButton = $("#showCategoriesMenuButton").val();
		cur_settings_obj.showSearchInput = $("#showSearchInput").val();
		cur_settings_obj.randomizeAllCategories = $("#randomizeAllCategories").val();
		cur_settings_obj.randomizeCategories = $("#randomizeCategories").val();
		cur_settings_obj.hideAllButtons = $("#hideAllButtons").val();
		
		
    	cur_settings_obj.startAtCategory = parseInt($("#startAtCategory").val());
		cur_settings_obj.thumbnailMaxWidth = $("#thumbnailMaxWidth").val();
		cur_settings_obj.thumbnailMaxHeight = $("#thumbnailMaxHeight").val();
		cur_settings_obj.horizontalSpaceBetweenThumbnails = $("#horizontalSpaceBetweenThumbnails").val();
		cur_settings_obj.verticalSpaceBetweenThumbnails = $("#verticalSpaceBetweenThumbnails").val();
		
    	cur_settings_obj.categories_menu_max_width = parseInt($("#categories_menu_max_width").val());
    	cur_settings_obj.buttonBackgroundOpacity = parseInt($("#buttonBackgroundOpacity").val());
    	cur_settings_obj.thumbnailTextBackgroundColor = $("#thumbnailTextBackgroundColor").spectrum("get") ? $("#thumbnailTextBackgroundColor").spectrum("get").toHexString() : "transparent";
    	cur_settings_obj.inputBackgroundColor = $("#inputBackgroundColor").spectrum("get") ? $("#inputBackgroundColor").spectrum("get").toHexString() : "transparent";
		cur_settings_obj.inputColor = $("#inputColor").spectrum("get") ? $("#inputColor").spectrum("get").toHexString() : "transparent";
		
		cur_settings_obj.thumbnailBackgroundColor = $("#thumbnailBackgroundColor").spectrum("get") ? $("#thumbnailBackgroundColor").spectrum("get").toHexString() : "transparent";
		cur_settings_obj.categoriesBackgorundColor = $("#categoriesBackgorundColor").spectrum("get") ? $("#categoriesBackgorundColor").spectrum("get").toHexString() : "transparent";
		

    	// lightbox settings
    	cur_settings_obj.buttonsAlignment = $("#buttonsAlignment").val();
		cur_settings_obj.itemBoxShadow = $("#itemBoxShadow").val();
		cur_settings_obj.spaceBetweenControllBarButtons = $("#spaceBetweenControllBarButtons").val();
		
		cur_settings_obj.useVideo = $("#useVideo").val();
		cur_settings_obj.useAudio = $("#useAudio").val();
		cur_settings_obj.videoShowFullScreenButton = $("#videoShowFullScreenButton").val();
		cur_settings_obj.slideShowAutoPlay = $("#slideShowAutoPlay").val();
		cur_settings_obj.addKeyboardSupport = $("#addKeyboardSupport").val();
		cur_settings_obj.addVideoKeyboardSupport = $("#addVideoKeyboardSupport").val();
		cur_settings_obj.nextVideoOrAudioAutoPlay = $("#nextVideoOrAudioAutoPlay").val();
		cur_settings_obj.videoAutoPlay = $("#videoAutoPlay").val();
		cur_settings_obj.videoLoop = $("#videoLoop").val();
		cur_settings_obj.audioAutoPlay = $("#audioAutoPlay").val();
		cur_settings_obj.show_next_and_prev_buttons = $("#show_next_and_prev_buttons").val();
		cur_settings_obj.showNextAndPrevButtonsOnMobile = $("#showNextAndPrevButtonsOnMobile").val();
		cur_settings_obj.audioLoop = $("#audioLoop").val();
		cur_settings_obj.show_description_by_default = $("#show_description_by_default").val();
		cur_settings_obj.video_show_full_screen_button = $("#video_show_full_screen_button").val();
		cur_settings_obj.video_auto_play = $("#video_auto_play").val();
		cur_settings_obj.next_video_or_audio_auto_play = $("#next_video_or_audio_auto_play").val();
		cur_settings_obj.video_loop = $("#video_loop").val();
		cur_settings_obj.audio_auto_play = $("#audio_auto_play").val();
		cur_settings_obj.audio_loop = $("#audio_loop").val();
		cur_settings_obj.videoControllerHideDelay = parseInt($("#videoControllerHideDelay").val());
		cur_settings_obj.videoControllerHeight = parseInt($("#videoControllerHeight").val());
		cur_settings_obj.audioControllerHeight = parseInt($("#audioControllerHeight").val());
		cur_settings_obj.startSpaceBetweenButtons = parseInt($("#startSpaceBetweenButtons").val());
		cur_settings_obj.vdSpaceBetweenButtons = parseInt($("#vdSpaceBetweenButtons").val());
		cur_settings_obj.mainScrubberOffestTop = parseInt($("#mainScrubberOffestTop").val());
		cur_settings_obj.scrubbersOffsetWidth = parseInt($("#scrubbersOffsetWidth").val());
		cur_settings_obj.audioScrubbersOffestTotalWidth = parseInt($("#audioScrubbersOffestTotalWidth").val());
		cur_settings_obj.timeOffsetLeftWidth = parseInt($("#timeOffsetLeftWidth").val());
		cur_settings_obj.timeOffsetRightWidth = parseInt($("#timeOffsetRightWidth").val());
		cur_settings_obj.volumeScrubberWidth = parseInt($("#volumeScrubberWidth").val());
		cur_settings_obj.buttonsHideDelay = parseInt($("#buttonsHideDelay").val());
		cur_settings_obj.slideShowDelay = parseInt($("#slideShowDelay").val());	
		cur_settings_obj.itemOffsetHeight = parseInt($("#itemOffsetHeight").val());	
		cur_settings_obj.spaceBetweenButtons = parseInt($("#spaceBetweenButtons").val());	
		cur_settings_obj.buttonsOffsetIn = parseInt($("#buttonsOffsetIn").val());	
		cur_settings_obj.buttonsOffsetOut = parseInt($("#buttonsOffsetOut").val());	
		cur_settings_obj.itemBorderSize = parseInt($("#itemBorderSize").val());	
		cur_settings_obj.itemBorderRadius = parseInt($("#itemBorderRadius").val());	
		cur_settings_obj.itemBorderColor = $("#itemBorderColor").spectrum("get") ? $("#itemBorderColor").spectrum("get").toHexString() : "transparent";
		
		cur_settings_obj.itemBackgroundColor = $("#itemBackgroundColor").spectrum("get") ? $("#itemBackgroundColor").spectrum("get").toHexString() : "transparent";

    }
    
    function checkLength(el, prop, min, max)
	{
      	if ((el.val().length > max) || (el.val().length < min))
	    {
        	el.addClass("ui-state-error");
        	updateTips("Length of " + prop + " must be between " + min + " and " + max + ".");
        	
        	return false;
      	}
	    else
		{
        	return true;
      	}
	}
    
    function checkIfIntegerAndLength(el, prop, min, max){
    	var int_reg_exp = /-?[0-9]+/;
    	var str = el.val();
    	var res = str.match(int_reg_exp);
    	
    	if (res && (res[0] == str))
        {
    		if ((el.val().length > max) || (el.val().length < min))
    	    {
            	el.addClass("ui-state-error");
            	updateTips("Length of " + prop + " must be between " + min + " and " + max + ".");
            	
            	return false;
          	}
    	    else
    		{
            	return true;
          	}
        }
        else
        {
        	el.addClass("ui-state-error");
        	updateTips("The " + prop + " field value must be an integer.");
        	
        	return false;
        }
	}
    
    function checkIfFloatAndLength(el, prop, min, max)
	{
    	var float_reg_exp = /1\.0|0?\.[0-9]+|[01]/;
    	var str = el.val();
    	var res = str.match(float_reg_exp);
    	
    	if (res && (res[0] == str))
        {
    		if ((el.val().length > max) || (el.val().length < min))
    	    {
            	el.addClass("ui-state-error");
            	updateTips("Length of " + prop + " must be between " + min + " and " + max + ".");
            	
            	return false;
          	}
    	    else
    		{
            	return true;
          	}
        }
        else
        {
        	el.addClass("ui-state-error");
        	updateTips("The " + prop + " field value must be a float number.");
        	
        	return false;
        }
	}
	
	
	
	function checkIfFloatAndLength2(el, prop, min, max){
    	var float_reg_exp = /[0-9]*\.?[0-9]+/;
    	var str = el.val();
    	var res = str.match(float_reg_exp);

    	if (res && (res[0] == str)){
    		if ((el.val().length > max) || (el.val().length < min)){
            	el.addClass("ui-state-error");
            	updateTips("Length of " + prop + " must be between " + min + " and " + max + ".");
            	return false;
          	}else{
            	return true;
          	}
        }else{
        	el.addClass("ui-state-error");
        	updateTips("The " + prop + " field value must be a float number.");
        	return false;
        }
	}
	
	

	function updateTips(txt)
	{
		$("#tips").text(txt).addClass("ui-state-highlight");

	    setTimeout(function()
		{
	    	$("#tips").removeClass("ui-state-highlight", 1500);
	    }, 500);
	    
	    $("#tips").addClass("fwd-error");
	}
	
	var allFields = $([]).add($("#name")).add($("#maxWidth")).add($("#fluidWidthZIndex")).add($("#maxHeight")).add($("#skinPath")).add($("#cov_bg_image_url")).add($("#startAtItem")).add($("#buttonsHideDelay"))
	 					  .add($("#cov_slideshow_delay")).add($("#thumbnailWidth")).add($("#thumbnailsBorderSize")).add($("#thumbnailsBorderRadius"))
	 					  .add($("#spaceBetweenThumbnailsAndItem")).add($("#thubnaisOffsetTopAndBottom")).add($("#spaceBetweenThumbnails")).add($("#thumb_x_space_2d")).add($("#thumb_hover_offset")).add($("#thumb_border_size"))
	 					  .add($("#max_thumbs_mobile")).add($("#text_offset")).add($("#box_shadow_css")).add($("#reflection_height")).add($("#reflection_distance")).add($("#thumbnailsOverlayOpacity"))
	 					 .add($("#controls_offset")).add($("#descriptionWindowBackgroundOpacity")).add($("#startAtCategory")).add($("#thumbnailMaxWidth")).add($("#categories_menu_max_width"))
	 					  .add($("#buttonBackgroundOpacity")).add($("#videoControllerHideDelay")).add($("#videoControllerHeight")).add($("#timeOffsetRightWidth")).add($("#volumeScrubberWidth")).add($("#timeOffsetLeftWidth")).add($("#audioScrubbersOffestTotalWidth")).add($("#scrubbersOffsetWidth")).add($("#mainScrubberOffestTop")).add($("#vdSpaceBetweenButtons")).add($("#startSpaceBetweenButtons")).add($("#audioControllerHeight")).add($("#buttonsHideDelay")).add($("#slideShowDelay")).add($("#spaceBetweenButtons")).add($("#buttonsOffsetIn")).add($("#buttonsOffsetOut")).add($("#itemBorderSize")).add($("#itemBorderRadius")).add($("#thumbnail_max_width")).add($("#thumbnailMaxHeight")).add($("#defaultItemHeight")).add($("#spaceBetweenControllBarButtons")).add($("#thumbnailsBackgroundOffestWidthAndHeight")).add($("#thumbnailHeight")).add($("#largeThumbnailBorderSize")).add($("#largeImageWidth")).add($("#thumbnailMaxHeight")).add($("#horizontalSpaceBetweenThumbnails")).add($("#verticalSpaceBetweenThumbnails")).add($("#itemBoxShadow"))
				  
	var fValid = false;


	function validateFields()
	{
		fValid = true;
     	
      	allFields.removeClass("ui-state-error");

      	// main settings
      	fValid = fValid && checkLength($("#name"), "name", 1, 64);
		
		fValid = fValid && checkIfIntegerAndLength($("#fluidWidthZIndex"), "fluid width z index", 1, 20);
      	fValid = fValid && checkIfIntegerAndLength($("#maxWidth"), "gallery width", 1, 8);
      	fValid = fValid && checkIfIntegerAndLength($("#maxHeight"), "gallery height", 1, 8);
		fValid = fValid && checkIfIntegerAndLength($("#slideShowDelay"), "slideshow delay", 1, 8);
    	fValid = fValid && checkIfIntegerAndLength($("#startAtItem"), "start at item", 1, 8);
		fValid = fValid && checkIfIntegerAndLength($("#itemOffsetHeight"), "item offset height", 1, 8);
		fValid = fValid && checkIfIntegerAndLength($("#spaceBetweenButtons"), "space between buttons", 1, 8);
		fValid = fValid && checkIfIntegerAndLength($("#itemBorderSize"), "item border size", 1, 8);
		fValid = fValid && checkIfIntegerAndLength($("#itemBorderRadius"), "item border radius", 1, 8);
		fValid = fValid && checkLength($("#itemBoxShadow"), "item box shadow", 1, 124);
		fValid = fValid && checkIfIntegerAndLength($("#spaceBetweenControllBarButtons"), "space between the control bar and main item in px", 1, 8);
		
      	fValid = fValid && checkIfIntegerAndLength($("#buttonsHideDelay"), "buttons hide delay", 1, 8)
      	fValid = fValid && checkIfIntegerAndLength($("#buttonsOffsetIn"), "buttons offset in", 1, 8);	
		fValid = fValid && checkIfIntegerAndLength($("#buttonsOffsetOut"), "buttons offset out", 1, 8);			
      
      	
      	if (!fValid)
      	{
      		$("#tabs").tabs("option", "active", 0);
      		
      		window.scrollTo(0,0);
      		
      		return false;
      	}
      	
      	// thumbs settings
      	fValid = fValid && checkIfIntegerAndLength($("#thumbnailWidth"), "thumbnails image width", 1, 8);
		fValid = fValid && checkIfIntegerAndLength($("#thumbnailHeight"), "thumbnails image height", 1, 8);
		fValid = fValid && checkIfIntegerAndLength($("#largeThumbnailBorderSize"), "large thumbnails border size", 1, 8);
		fValid = fValid && checkIfIntegerAndLength($("#largeImageWidth"), "large thumbnails width", 1, 8);
		
		fValid = fValid && checkIfIntegerAndLength($("#thumbnailsBackgroundOffestWidthAndHeight"), "thumbnails padding", 1, 8);
      	fValid = fValid && checkIfIntegerAndLength($("#thumbnailsBorderSize"), "thumbnails border size:", 1, 8);
      	fValid = fValid && checkIfIntegerAndLength($("#thumbnailsBorderRadius"), "thumbnails border radius", 1, 8);
      	fValid = fValid && checkIfIntegerAndLength($("#spaceBetweenThumbnailsAndItem"), "space between thumbnails and item", 1, 8);
      	fValid = fValid && checkIfIntegerAndLength($("#thubnaisOffsetTopAndBottom"), "thumbnails offset bottom", 1, 8);
      	fValid = fValid && checkIfIntegerAndLength($("#spaceBetweenThumbnails"), "space between thumbnails", 1, 8);
		fValid = fValid && checkIfFloatAndLength2($("#thumbnailsOverlayOpacity"), "thumbnails overlay opacity", 1, 8);
		
    	
      	
      	if (!fValid)
      	{
      		$("#tabs").tabs("option", "active", 1);
      		
      		window.scrollTo(0,1);
      		
      		return false;
      	}
      	
      	//description window
      	fValid = fValid && checkIfFloatAndLength2($("#descriptionWindowBackgroundOpacity"), "description window background opacity", 1, 8);
      	if (!fValid)
      	{
      		$("#tabs").tabs("option", "active", 2);
      		
      		window.scrollTo(0,0);
      		
      		return false;
      	}
      	
      	// categories menu settings
		fValid = fValid && checkLength($("#thumbnailMaxWidth"), "thumbnails max width", 1, 100);
		fValid = fValid && checkLength($("#thumbnailMaxHeight"), "thumbnails max height", 1, 100);
		fValid = fValid && checkLength($("#horizontalSpaceBetweenThumbnails"), "horizontal space between thumbnails", 1, 100);
		fValid = fValid && checkLength($("#verticalSpaceBetweenThumbnails"), "vertical space between thumbnails", 1, 100);
		
		fValid = fValid && checkIfIntegerAndLength($("#startAtCategory"), "combobox start category", 1, 8);
      
      	
      	if (!fValid)
      	{
      		$("#tabs").tabs("option", "active", 3);
      		
      		window.scrollTo(0,0);
      		
      		return false;
      	}
      	
      	
	}
    
    $("#add_btn").click(function(e)
	{
		
		if($("#name").val() == settingsAr[cur_order_id]["name"]){
			updateTips("Please make sure that the preset name is unique");
			$("#name").addClass("ui-state-error");
			$("#tabs").tabs("option", "active", 0);
			window.scrollTo(0,0);
			return false;
		};
		
    	validateFields();

      	if (fValid)
        {
      		cur_settings_obj = {};
        	
        	sid = $("#skins option").length;
        	cur_order_id = $("#skins option").length;
        	
      		var idsAr = [];
      		
      		if (sid > DEFAULT_SKINS_NR)
      		{
      			$.each(settingsAr, function(i, el)
    			{
    				idsAr.push(el.id);
    			});
          		
          		for (var i=DEFAULT_SKINS_NR; i<settingsAr.length; i++)
          		{
          			if ($.inArray(i, idsAr) == -1)
          			{
          				sid = i;
          				break;
          			}
          		}
      		}
        	
			
	    	updateSettings();
	    	settingsAr.push(cur_settings_obj);
	    	
	    	var data_obj =
	    	{
	    		action: "add",
	    		set_id: sid,
	    		set_order_id: cur_order_id,
	    		tab_init_id: $("#tabs").tabs("option", "active"),
	    		settings_ar: settingsAr
	    	};
	    	
	    	$("#settings_data").val(JSON.stringify(data_obj));
			
        }
      	else
      	{
      		return false;
      	}
    });
    
    $("#update_btn").click(function()
	{
    	validateFields();

      	if (fValid)
        {
      		cur_settings_obj = {};
      		
	    	updateSettings();
	    	
	    	settingsAr[cur_order_id] = cur_settings_obj;
	    	
	    	var data_obj =
	    	{
	    		action: "save",
	    		set_id: sid,
	    		set_order_id: cur_order_id,
	    		tab_init_id: $("#tabs").tabs("option", "active"),
	    		settings_ar: settingsAr
	    	};
	    	
	    	$("#settings_data").val(JSON.stringify(data_obj));
        }
      	else
      	{
      		return false;
      	}
    });
    
    $("#del_btn").click(function()
	{
    	settingsAr.splice(cur_order_id, 1);
    	
    	var data_obj =
    	{
    		action: "del",
    		settings_ar: settingsAr
    	};
    	
    	$("#settings_data").val(JSON.stringify(data_obj));
    });
});