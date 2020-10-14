jQuery(document).ready(function($)
{
	$("#playlists").accordion(
	{
		header: ".playlist-header",
    	collapsible: true,
    	heightStyle: "content",
    	active: false
    })
    .sortable(
   	{
        axis: "x, y",
        handle: ".playlist-header",
        start: startPlaylistsOrder,
        update: updatePlaylistsOrder
    });
	$(".cats").accordion(
	{
		header: ".category-header",
    	collapsible: true,
    	heightStyle: "content",
    	active: false
    })
    .sortable(
   	{
        axis: "x, y",
        handle: ".category-header",
        start: startCategoriesOrder,
        update: updateCategoriesOrder
    });
	$(".ths").sortable(
   	{
        axis: "x, y",
        handle: ".image-header",
        start: startThumbsOrder,
        update: updateThumbsOrder
    });
	
	$(".fwd-image").mouseover(function()
	{
		$(this).addClass("th_over");
		$(this).find(".image-header").css("color", "#212121");
	});
	
	$(".fwd-image").mouseout(function()
	{
		$(this).removeClass("th_over");
		$(this).find(".image-header").css("color", "#555555");
	});
	
	if ($("#playlists .playlist").length > 0)
	{
		$("#pl_em").hide();
	}
	
	$("img").tooltip(
    {
        position:
        {
    		my: "center bottom-10",
    		at: "center top"
        }
    });
	
	
	$(".add_bulk_btn").click(function(e){
		var reg_exp1 = /pl[0-9]+_/;
		var reg_exp2 = /cat[0-9]+_/;
		
		cur_pl_id = parseInt($(this).attr("id").match(reg_exp1)[0].slice(2, -1));
		cur_cat_id = parseInt($(this).attr("id").match(reg_exp2)[0].slice(3, -1));
		
		var allPlimages = $("#playlists").sortable("toArray");
		curPlOrderId = allPlimages.indexOf("pl" + cur_pl_id);
		
		var allCatimages = $("#pl" + cur_pl_id + "_cats").sortable("toArray");
		curCatOrderId = allCatimages.indexOf("pl" + cur_pl_id + "_cat" + cur_cat_id);
		
		openBulkUploader(e, curPlOrderId, curCatOrderId);
		return false;
		
	});
	
	var curPlOrderId;
	var newPlOrderId;
	
	function startPlaylistsOrder(ev, ui)
	{
		var allPlimages = $(this).sortable("toArray");
		
		curPlOrderId = allPlimages.indexOf($(ui.item).attr("id"));
	}
	
	function updatePlaylistsOrder(ev, ui)
	{
		var allPlimages = $(this).sortable("toArray");
   		newPlOrderId = allPlimages.indexOf($(ui.item).attr("id"));
   		
   		var curimage = playlistsAr.splice(curPlOrderId, 1)[0];
   	  
   	    playlistsAr.splice(newPlOrderId, 0, curimage);
	};
	
	var curCatOrderId;
	var newCatOrderId;
	
	function startCategoriesOrder(ev, ui)
	{
		var allCatimages = $(this).sortable("toArray");
		
		curCatOrderId = allCatimages.indexOf($(ui.item).attr("id"));
	}
	
	function updateCategoriesOrder(ev, ui)
	{
		var allCatimages = $(this).sortable("toArray");
   		newCatOrderId = allCatimages.indexOf($(ui.item).attr("id"));
   		
   		var allPlimages = $("#playlists").sortable("toArray");
   		var plParent = $(this).closest(".playlist");
   		
   		curPlOrderId = allPlimages.indexOf($(plParent).attr("id"));
   		
   		var curimage = playlistsAr[curPlOrderId].categories.splice(curCatOrderId, 1)[0];
   	  
		playlistsAr[curPlOrderId].categories.splice(newCatOrderId, 0, curimage);
	}
	
	var curThOrderId;
	var newThOrderId;
	
	function startThumbsOrder(ev, ui)
	{
		var allThimages = $(this).sortable("toArray");
		
		curThOrderId = allThimages.indexOf($(ui.item).attr("id"));
	}
	
	function updateThumbsOrder(ev, ui)
	{
		var allThimages = $(this).sortable("toArray");
		
		
   		newThOrderId = allThimages.indexOf($(ui.item).attr("id"));
	
   		
   		var allPlimages = $("#playlists").sortable("toArray");
   		var plParent = $(this).closest(".playlist");
   		
   		curPlOrderId = allPlimages.indexOf($(plParent).attr("id"));
   		
   		var allCatimages = $($(this).closest(".cats")).sortable("toArray");
   		var catParent = $(this).closest(".category");
   		curCatOrderId = allCatimages.indexOf($(catParent).attr("id"));
   		
   		var curimage = playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs.splice(curThOrderId, 1)[0];
		
   	  
   		playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs.splice(newThOrderId, 0, curimage);
		
	
	}
    function checkLength(tips, el, prop, min, max)
	{
      	if ((el.val().length > max) || (el.val().length < min))
	    {
        	el.addClass("ui-state-error");
        	updateTips(tips, "Length of " + prop + " must be between " + min + " and " + max + ".");
        	
        	return false;
      	}
	    else
		{
        	return true;
      	}
	}
    
    function checkIfIntegerAndLength(tips, el, prop, min, max)
	{
    	var int_reg_exp = /-?[0-9]+/;
    	var str = el.val();
    	var res = str.match(int_reg_exp);
    	
    	if (res && (res[0] == str))
        {
    		if ((el.val().length > max) || (el.val().length < min))
    	    {
            	el.addClass("ui-state-error");
            	updateTips(tips, "Length of " + prop + " must be between " + min + " and " + max + ".");
            	
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
        	updateTips(tips, "The " + prop + " field value must be an integer.");
        	
        	return false;
        }
	}
	
	function checkImgLoad(tips, el)
	{
      	if (!is_img_loaded)
	    {
			el.addClass("ui-state-error");
        	updateTips(tips, "Please wait for the image to load.");
			
			el.addClass("ui-state-highlight");
			setTimeout(function()
			{
				el.removeClass("ui-state-highlight");
			}, 500);
        	
        	return false;
      	}
	    else
		{
        	return true;
      	}
	}
	function updateTips(tips, txt)
	{
	    tips.text(txt).addClass("ui-state-highlight");
	    setTimeout(function()
		{
	    	tips.removeClass("ui-state-highlight");
	    }, 500);
	    
	    tips.addClass("fwd-error");
	}
	
	var cur_pl_id = 0;
	var cur_cat_id = 0;
	var cur_th_id = 0;
	// playlist dialogs
	var pl_name = $("#pl_name");
	var pl_thumb = $("#pl_thumb");
    var allFieldsPl = $([]).add(pl_name);
	$("#add-playlist-dialog").dialog(
	{
		autoOpen: false,
		width: 350,
	    height: 210,
	    modal: true,
	    buttons:
		{
	        "Add playlist": function()
	        {
	         	var fValid = true;
	         	var tips = $("#add_pl_tips");
	         	
	          	allFieldsPl.removeClass("ui-state-error");
	 
	          	fValid = fValid && checkLength(tips, pl_name, "name", 1, 64);
	 
	          	if (fValid)
		        {
	          		var pid = $("#playlists .playlist").length;
	          		var plsIdsAr = [];
	          		
	          		if (pid > 0)
	          		{
	          			$.each(playlistsAr, function(i, el)
          				{
          					plsIdsAr.push(el.id);
          				});
    	          		
    	          		for (var i=0; i<playlistsAr.length; i++)
    	          		{
    	          			if ($.inArray(i, plsIdsAr) == -1)
    	          			{
    	          				pid = i;
    	          				break;
    	          			}
    	          		}
	          		}
	          		else
	          		{
	          			$("#pl_em").hide();
	          		}
	          		
		            $("#playlists").append("<div id='pl" + pid + "' class='playlist'>"
		    	    	+ "<h3 class='playlist-header'>" + pl_name.val().replace(/"/g, "'") + " <span style='float:right'>ID : " + pid + "</span></h3>"
		    	       	+ "<div>"
		    	       	+ "<div id='pl" + pid + "_cats' class='cats' style='width:654px'></div>"
		    	       	+ "<button class='add_category_btn' id='pl" + pid + "_add_btn' style='cursor:pointer;'>Add new category</button>"
		    	       	+ "<button class='edit_playlist_btn' id='pl" + pid + "_edit_btn' style='cursor:pointer;'>Edit</button>"
		    	    	+ "<button class='delete_playlist_btn' id='pl" + pid + "_del_btn' style='cursor:pointer;'>Delete</button>"
		    	       	+ "</div>"
		    	   	+ "</div>");
		            $(".add_category_btn").click(function()
            		{
            			var reg_exp = /pl[0-9]+_/;
            			
            			cur_pl_id = parseInt($(this).attr("id").match(reg_exp)[0].slice(2, -1));
            			
            	        $("#add-category-dialog").dialog("open");
            	        return false;
            	    });
		            
		            $(".edit_playlist_btn").click(function()
            		{
            			var reg_exp = /pl[0-9]+_/;
            			
            			cur_pl_id = parseInt($(this).attr("id").match(reg_exp)[0].slice(2, -1));
            			
            			var allPlimages = $("#playlists").sortable("toArray");
            	   		curPlOrderId = allPlimages.indexOf("pl" + cur_pl_id);
            			
            	        $("#edit-playlist-dialog").dialog("open");
            	        return false;
            	    });
		            
		            $(".delete_playlist_btn").click(function()
            		{
            			var reg_exp = /pl[0-9]+_/;
            			
            			cur_pl_id = parseInt($(this).attr("id").match(reg_exp)[0].slice(2, -1));         			
            			
            	        $("#delete-playlist-dialog").dialog("open");
            	        return false;
            	    });
		            
		            $("#pl" + pid + "_cats").accordion(
            		{
            			header: ".category-header",
            	    	collapsible: true,
            	    	heightStyle: "content",
            	    	active: false
            	    })
            	    .sortable(
            	   	{
            	        axis: "x, y",
            	        handle: ".category-header",
            	        start: startCategoriesOrder,
            	        update: updateCategoriesOrder
            	    });       
		            $("#playlists").sortable("refresh");
		            $("#playlists").accordion("refresh");
		            
		            var newPl =
		            {
		            	id: pid,
		            	name: pl_name.val().replace(/"/g, "'"),
		            	categories: []
		            };
		            
		            playlistsAr.push(newPl);
		            $(this).dialog("close");
	         	 }	
	        },
	        "Cancel": function()
	        {
	        	$(this).dialog("close");
	        }
	    },
	    close: function()
	    {
		    allFieldsPl.removeClass("ui-state-error");
		    $("#add_pl_tips").removeClass("fwd-error");
	    },
	    open: function()
	    {
	    	$("#pl_name").val("");
			
		    
		    $("#add_pl_tips").text("The name field is required.");
		}
	});
	
	
	$("#add_playlist_btn").click(function()
	{
        $("#add-playlist-dialog").dialog("open");
        return false;
    });
	
	var pl_name_edit = $("#pl_name_edit");
	var pl_thumb_edit = $("#pl_thumb_edit");
    var pl_text_edit = $("#pl_text_edit");
	
    var allFieldsPlEdit = $([]).add(pl_name_edit);
	$("#edit-playlist-dialog").dialog(
	{
		autoOpen: false,
		width: 350,
	    height: 210,
	    modal: true,
	    buttons:
		{
	        "Update playlist": function()
	        {
	         	var fValid = true;
	         	var tips = $("#edit_pl_tips");
	         	
	         	allFieldsPlEdit.removeClass("ui-state-error");
	 
	          	fValid = fValid && checkLength(tips, pl_name_edit, "name", 1, 64);
	 
	          	if (fValid)
		        {
	          		var content = $("#pl" + cur_pl_id + " > h3").html();
	          		var pos = content.indexOf(playlistsAr[curPlOrderId].name);
	          		
	          		content = content.slice(0, pos);
					
	          		$("#pl" + cur_pl_id + " > h3").html(content + pl_name_edit.val().replace(/"/g, "'") + "<span style='float:right'>ID : " + playlistsAr[curPlOrderId].name + "</span>");
	          		
		            playlistsAr[curPlOrderId].name = pl_name_edit.val().replace(/"/g, "'");
					playlistsAr[curPlOrderId].thumb = pl_thumb_edit.val().replace(/"/g, "'");
	          		playlistsAr[curPlOrderId].text = getPlaylistTextEdit();
		            
		            $(this).dialog("close");
	         	 }	
	        },
	        "Cancel": function()
	        {
	        	$(this).dialog("close");
	        }
	    },
	    close: function()
	    {
		    allFieldsPlEdit.removeClass("ui-state-error");
		    $("#edit_pl_tips").removeClass("fwd-error");
	    },
	    open: function()
	    {
	    	$("#pl_name_edit").val(playlistsAr[curPlOrderId].name);
	    	
	    	$("#edit_pl_tips").text("The name field is required.");
			$("#pl_thumb_edit").val(playlistsAr[curPlOrderId].thumb);
		    //setPlaylistTextEdit(playlistsAr[curPlOrderId].text);
			$("#uploads_pl_thumb_edit").attr("src", playlistsAr[curPlOrderId].thumb);
		}
	});
	
	
	
	$(".edit_playlist_btn").click(function()
	{
		var reg_exp = /pl[0-9]+_/;
		
		cur_pl_id = parseInt($(this).attr("id").match(reg_exp)[0].slice(2, -1));
		
		var allPlimages = $("#playlists").sortable("toArray");
   		curPlOrderId = allPlimages.indexOf("pl" + cur_pl_id);
		
        $("#edit-playlist-dialog").dialog("open");
        return false;
    });
	
	$("#delete-playlist-dialog").dialog(
	{
		autoOpen: false,
		width: 300,
	    height: 160,
	    modal: true,
	    buttons:
		{
	        "Yes": function()
	        {
		   		var allPlimages = $("#playlists").sortable("toArray");
	       		curPlOrderId = allPlimages.indexOf("pl" + cur_pl_id);
		   		
		   		playlistsAr.splice(curPlOrderId, 1);
		   		
	            $("#pl" + cur_pl_id).remove();
	            
	            $("#playlists").accordion("option", "active", false);
	            
	            $("#playlists").sortable("refresh");
	            $("#playlists").accordion("refresh");
	            
	            if ($("#playlists .playlist").length == 0)
	            {
	            	$("#pl_em").show();
	            }
	            
	            $(this).dialog("close");
	        },
	        "No": function()
	        {
	        	$(this).dialog("close");
	        }
	    }
	});
	
	$(".delete_playlist_btn").click(function()
	{
		var reg_exp = /pl[0-9]+_/;
		
		cur_pl_id = parseInt($(this).attr("id").match(reg_exp)[0].slice(2, -1));
		
        $("#delete-playlist-dialog").dialog("open");
        return false;
    });
	// category dialogs
	var cat_name = $("#cat_name");
	var pl_thumb = $("#pl_thumb");
    var allFieldsCat = $([]).add(cat_name);
	
	$("#add-category-dialog").dialog(
	{
		autoOpen: false,
		width: 650,
	    height: 600,
	    modal: true,
	    buttons:
		{
	        "Add category": function()
	        {
	         	var fValid = true;
	         	var tips = $("#add_cat_tips");
	         	
	          	allFieldsCat.removeClass("ui-state-error");
	 
	          	fValid = fValid && checkLength(tips, cat_name, "name", 1, 64);
				fValid = fValid && checkLength(tips, pl_thumb, "category image path", 1, 256);
	 
	          	if (fValid)
		        {
	          		var cid = $("#pl" + cur_pl_id + "_cats .category").length;
	          		var catsIdsAr = [];
	          		
	          		var allPlimages = $("#playlists").sortable("toArray");
	          		curPlOrderId = allPlimages.indexOf("pl" + cur_pl_id);
	          		
	          		$.each($("#pl" + cur_pl_id + "_cats .category"), function(i, el)
      				{
	          			var reg_exp = /cat[0-9]+/;
            			var cat_id = parseInt($(el).attr("id").match(reg_exp)[0].slice(3));
            			
            			catsIdsAr.push(cat_id);
      				});
	          		
	          		for (var i=0; i<playlistsAr[curPlOrderId].categories.length; i++)
	          		{
	          			if ($.inArray(i, catsIdsAr) == -1)
	          			{
	          				cid = i;
	          				break;
	          			}
	          		}
	          		
		            $("#pl" + cur_pl_id + "_cats").append("<div id='pl" + cur_pl_id + "_cat" + cid + "' class='category'>"
		    	    	+ "<h3 class='category-header'>" + cat_name.val().replace(/"/g, "'") + "</h3>"
		    	    	+ "<div>"
		    	    	+ "<div id='pl" + cur_pl_id + "_cat" + cid + "_ths' class='ths' style='width:554px'></div>"
		    	       	+ "<button class='add_image_btn' id='pl" + cur_pl_id + "_cat" + cid + "_btn' style='cursor:pointer;'>Add new image</button>"
						+ "<button class='add_bulk_btn' id='pl" + cur_pl_id + "_cat" + cid + "_bulk_btn'  style='cursor:pointer;'>Add bulk images</button>"
		    	       	+ "<button class='edit_category_btn' id='pl" + cur_pl_id + "_cat" + cid + "_edit_btn' style='cursor:pointer;'>Edit</button>"
		    	    	+ "<button class='delete_category_btn' id='pl" + cur_pl_id + "_cat" + cid + "_del_btn' style='cursor:pointer;'>Delete</button>"
		    	       	+ "</div>"
		    	   	+ "</div>");
		            $(".add_image_btn").click(function(e)
            		{
            			var reg_exp1 = /pl[0-9]+_/;
            			var reg_exp2 = /cat[0-9]+_/;
            			
            			cur_pl_id = parseInt($(this).attr("id").match(reg_exp1)[0].slice(2, -1));
            			cur_cat_id = parseInt($(this).attr("id").match(reg_exp2)[0].slice(3, -1));
            			
            	        $("#add-image-dialog").dialog("open");
            	        return false;
            	    });
		            
		            $(".edit_category_btn").click(function()
            		{
            			var reg_exp1 = /pl[0-9]+_/;
            			var reg_exp2 = /cat[0-9]+_/;
            			
            			cur_pl_id = parseInt($(this).attr("id").match(reg_exp1)[0].slice(2, -1));
            			cur_cat_id = parseInt($(this).attr("id").match(reg_exp2)[0].slice(3, -1));
            			
            			var allPlimages = $("#playlists").sortable("toArray");
            	   		curPlOrderId = allPlimages.indexOf("pl" + cur_pl_id);
            	        
            	        var allCatimages = $("#pl" + cur_pl_id + "_cats").sortable("toArray");
            	   		curCatOrderId = allCatimages.indexOf("pl" + cur_pl_id + "_cat" + cur_cat_id);
            			
            	        $("#edit-category-dialog").dialog("open");
            	        return false;
            	    });
		            
		            $(".delete_category_btn").click(function(){
            			var reg_exp1 = /pl[0-9]+_/;
            			var reg_exp2 = /cat[0-9]+_/;
            			
            			cur_pl_id = parseInt($(this).attr("id").match(reg_exp1)[0].slice(2, -1));
            			cur_cat_id = parseInt($(this).attr("id").match(reg_exp2)[0].slice(3, -1));
            			
            	        $("#delete-category-dialog").dialog("open");
            	        return false;
            	    });
					
					$(".add_bulk_btn").click(function(e){
							var reg_exp1 = /pl[0-9]+_/;
							var reg_exp2 = /cat[0-9]+_/;
							
							cur_pl_id = parseInt($(this).attr("id").match(reg_exp1)[0].slice(2, -1));
							cur_cat_id = parseInt($(this).attr("id").match(reg_exp2)[0].slice(3, -1));
							
							var allPlimages = $("#playlists").sortable("toArray");
							curPlOrderId = allPlimages.indexOf("pl" + cur_pl_id);
							
							var allCatimages = $("#pl" + cur_pl_id + "_cats").sortable("toArray");
							curCatOrderId = allCatimages.indexOf("pl" + cur_pl_id + "_cat" + cur_cat_id);
							
							openBulkUploader(e, cur_pl_id, cur_cat_id);
							return false;
						});
		            
		            $("#pl" + cur_pl_id + "_cat" + cid + "_ths").sortable(
            	   	{
            	        axis: "x, y",
            	        handle: ".image-header",
            	        start: startThumbsOrder,
            	        update: updateThumbsOrder
            	    });
		            $(".cats").sortable("refresh");
		            $(".cats").accordion("refresh");
		            
		            var newCat =
		            {
		            	name: cat_name.val().replace(/"/g, "'"),
						thumb:pl_thumb.val().replace(/"/g, "'"),
						text:getPlaylistText(),
		            	thumbs: []
		            };
		            
		            playlistsAr[curPlOrderId].categories.push(newCat);
		            $(this).dialog("close");
	         	 }	
	        },
	        "Cancel": function()
	        {
	        	$(this).dialog("close");
	        }
	    },
	    close: function()
	    {
		    allFieldsCat.removeClass("ui-state-error");  
		    $("#add_cat_tips").removeClass("fwd-error");
	    },
	    open: function()
	    {
	    	$("#cat_name").val("");
	    	$("#pl_thumb").val("");
		    setPlaylistText("");
			$("#uploads_pl_thumb").attr("src", "");
	    	$("#add_cat_tips").text("The name field is required.");
		}
	});
	$(".add_category_btn").click(function()
	{
		var reg_exp = /pl[0-9]+_/;
		
		cur_pl_id = parseInt($(this).attr("id").match(reg_exp)[0].slice(2, -1));
		
        $("#add-category-dialog").dialog("open");
        return false;
    });
	
	var cat_name_edit = $("#cat_name_edit");
	var pl_thumb_edit = $("#pl_thumb_edit");
    var allFieldsCatEdit = $([]).add(cat_name_edit).add(pl_thumb_edit);
	
	$("#edit-category-dialog").dialog(
	{
		autoOpen: false,
		width: 650,
	    height: 600,
	    modal: true,
	    buttons:
		{
	        "Update category": function()
	        {
	         	var fValid = true;
	         	var tips = $("#edit_cat_tips");
	         	
	          	allFieldsCatEdit.removeClass("ui-state-error");
	 
	          	fValid = fValid && checkLength(tips, cat_name_edit, "name", 1, 64);
				fValid = fValid && checkLength(tips, pl_thumb_edit, "category image path", 1, 256);
	 
	          	if (fValid)
		        {
	          		var content = $("#pl" + cur_pl_id + "_cat" + cur_cat_id + " > h3").html();
	          		var pos = content.indexOf(playlistsAr[curPlOrderId].categories[curCatOrderId].name);
	          		
	          		content = content.slice(0, pos);
	          		
	          		$("#pl" + cur_pl_id + "_cat" + cur_cat_id + " > h3").html(content + cat_name_edit.val().replace(/"/g, "'"));
	          		
	          		playlistsAr[curPlOrderId].categories[curCatOrderId].name = cat_name_edit.val().replace(/"/g, "'");
					playlistsAr[curPlOrderId].categories[curCatOrderId].thumb = pl_thumb_edit.val().replace(/"/g, "'");
					playlistsAr[curPlOrderId].categories[curCatOrderId].text = getPlaylistTextEdit();
	
		            $(this).dialog("close");
	         	 }	
	        },
	        "Cancel": function()
	        {
	        	$(this).dialog("close");
	        }
	    },
	    close: function()
	    {
		    allFieldsCatEdit.removeClass("ui-state-error");
		    $("#edit_cat_tips").removeClass("fwd-error");
	    },
	    open: function()
	    {
	    	$("#cat_name_edit").val(playlistsAr[curPlOrderId].categories[curCatOrderId].name);
	    	
	    	$("#edit_cat_tips").text("The name field is required.");
				
			
			$("#pl_thumb_edit").val(playlistsAr[curPlOrderId].categories[curCatOrderId].thumb);
		    setPlaylistTextEdit(playlistsAr[curPlOrderId].categories[curCatOrderId].text);
			$("#uploads_pl_thumb_edit").attr("src", playlistsAr[curPlOrderId].categories[curCatOrderId].thumb);
		}
	});
	$(".edit_category_btn").click(function()
	{
		var reg_exp1 = /pl[0-9]+_/;
		var reg_exp2 = /cat[0-9]+_/;
		
		cur_pl_id = parseInt($(this).attr("id").match(reg_exp1)[0].slice(2, -1));
		cur_cat_id = parseInt($(this).attr("id").match(reg_exp2)[0].slice(3, -1));
		
		var allPlimages = $("#playlists").sortable("toArray");
   		curPlOrderId = allPlimages.indexOf("pl" + cur_pl_id);
        
        var allCatimages = $("#pl" + cur_pl_id + "_cats").sortable("toArray");
   		curCatOrderId = allCatimages.indexOf("pl" + cur_pl_id + "_cat" + cur_cat_id);
		
        $("#edit-category-dialog").dialog("open");
        return false;
    });
	
	$("#delete-category-dialog").dialog(
	{
		autoOpen: false,
		width: 300,
	    height: 160,
	    modal: true,
	    buttons:
		{
	        "Yes": function()
	        {
	            var allPlimages = $("#playlists").sortable("toArray");
	       		curPlOrderId = allPlimages.indexOf("pl" + cur_pl_id);
	            
	            var allCatimages = $("#pl" + cur_pl_id + "_cats").sortable("toArray");
	       		curCatOrderId = allCatimages.indexOf("pl" + cur_pl_id + "_cat" + cur_cat_id);
	       		
	       		playlistsAr[curPlOrderId].categories.splice(curCatOrderId, 1);
	       		
	       		$("#pl" + cur_pl_id + "_cat" + cur_cat_id).remove();
	       		
	       		$(".cats").accordion("option", "active", false);
	       		$(".cats").sortable("refresh");
	            $(".cats").accordion("refresh");  
	            
	            $(this).dialog("close");
	        },
	        "No": function()
	        {
	        	$(this).dialog("close");
	        }
	    }
	});
	
	$(".delete_category_btn").click(function()
	{
		var reg_exp1 = /pl[0-9]+_/;
		var reg_exp2 = /cat[0-9]+_/;
		
		cur_pl_id = parseInt($(this).attr("id").match(reg_exp1)[0].slice(2, -1));
		cur_cat_id = parseInt($(this).attr("id").match(reg_exp2)[0].slice(3, -1));
		
        $("#delete-category-dialog").dialog("open");
        return false;
    });
	
	// image dialogs
	var th_name = $("#th_name");
    var th_image = $("#th_image");
    var th_image = $("#th_image");
    var th_target = $("#th_target");
	var th_upload_img = $("#upload_img");
	var th_upload_img_edit = $("#upload_img_edit");
	var video_poster_source = $("#video_poster_source");
	var image_max_width = $("#image_max_width");
	var image_max_height = $("#image_max_height");
	var is_img_loaded;
	var is_img_changed;
	var img_width;
	var img_height;
    
    var allFieldsTh = $([]).add(th_name).add(th_image).add(th_image);
	$("#add-image-dialog").dialog(
	{
		autoOpen: false,
		width: 680,
	    height: 560,
	    modal: true,
	    buttons:
		{
	        "Add image": function()
	        {
	         	var fValid = true;
	         	var tips = $("#add_th_tips");
	         	
	          	allFieldsTh.removeClass("ui-state-error");
				
	          	fValid = fValid && checkLength(tips, th_name, "name", 1, 64);
	       		fValid = fValid && checkLength(tips, th_image, "image path", 1, 256);
	       		//fValid = fValid && checkImgLoad(tips, th_upload_img);
	 
	          	if (fValid)
		        {
	          		var tid = $("#pl" + cur_pl_id + "_cat" + cur_cat_id + "_ths .fwd-image").length;
	          		var thsIdsAr = [];
	          		
	          		var allPlimages = $("#playlists").sortable("toArray");
		       		curPlOrderId = allPlimages.indexOf("pl" + cur_pl_id);
		            
		            var allCatimages = $("#pl" + cur_pl_id + "_cats").sortable("toArray");
		       		curCatOrderId = allCatimages.indexOf("pl" + cur_pl_id + "_cat" + cur_cat_id);
	          		
					
	          		$.each($("#pl" + cur_pl_id + "_cat" + cur_cat_id + "_ths .fwd-image"), function(i, el)
      				{
	          			var reg_exp = /th[0-9]+/;
            			var th_id = parseInt($(el).attr("id").match(reg_exp)[0].slice(2));
            			
            			thsIdsAr.push(th_id);
      				});
	          		
	          		for (var i=0; i<playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs.length; i++)
	          		{
	          			if ($.inArray(i, thsIdsAr) == -1)
	          			{
	          				tid = i;
	          				break;
	          			}
	          		}
	          		
	          		$("#pl" + cur_pl_id + "_cat" + cur_cat_id + "_ths").append("<div id='pl" + cur_pl_id + "_cat" + cur_cat_id + "_th" + tid + "' class='fwd-image'>"
		    	    	+ "<h3 class='image-header'>" + th_name.val().replace(/"/g, "'") + "</h3>"
						+ "<img src='" + th_image.val().replace(/"/g, "'") + "' class='fwd-s3dcov-image-product-img' id='pl" + cur_pl_id + "_cat" + cur_cat_id + "_th" + tid + "_img'></img>"
		    	       	+ "<button class='delete_image_btn' id='pl" + cur_pl_id + "_cat" + cur_cat_id + "_th" + tid + "_del_btn'>Delete</button>"
		    	       	+ "<button class='edit_image_btn' id='pl" + cur_pl_id + "_cat" + cur_cat_id + "_th" + tid + "_edit_btn'>Edit</button>"
			    	+ "</div>");
	          		
	          		$(".edit_image_btn").click(function()
      				{
      					var reg_exp1 = /pl[0-9]+_/;
      					var reg_exp2 = /cat[0-9]+_/;
      					var reg_exp3 = /th[0-9]+_/;
      					
      					cur_pl_id = parseInt($(this).attr("id").match(reg_exp1)[0].slice(2, -1));
      					cur_cat_id = parseInt($(this).attr("id").match(reg_exp2)[0].slice(3, -1));
      					cur_th_id = parseInt($(this).attr("id").match(reg_exp3)[0].slice(2));
      					
      					var allPlimages = $("#playlists").sortable("toArray");
      			   		curPlOrderId = allPlimages.indexOf("pl" + cur_pl_id);
      			        
      			        var allCatimages = $("#pl" + cur_pl_id + "_cats").sortable("toArray");
      			   		curCatOrderId = allCatimages.indexOf("pl" + cur_pl_id + "_cat" + cur_cat_id);
						
					
      			   		
      			   		var allThimages = $("#pl" + cur_pl_id + "_cat" + cur_cat_id + "_ths").sortable("toArray");
      			   		curThOrderId = allThimages.indexOf("pl" + cur_pl_id + "_cat" + cur_cat_id + "_th" + cur_th_id);
						
      			        $("#edit-image-dialog").dialog("open");
      			        return false;
      			    });
	          		
	          		$(".delete_image_btn").click(function()
      				{
      					var reg_exp1 = /pl[0-9]+_/;
      					var reg_exp2 = /cat[0-9]+_/;
      					var reg_exp3 = /th[0-9]+_/;
      					
      					cur_pl_id = parseInt($(this).attr("id").match(reg_exp1)[0].slice(2, -1));
      					cur_cat_id = parseInt($(this).attr("id").match(reg_exp2)[0].slice(3, -1));
      					cur_th_id = parseInt($(this).attr("id").match(reg_exp3)[0].slice(2));
      					
      			        $("#delete-image-dialog").dialog("open");
      			        return false;
      			    });
		            $(".ths").sortable("refresh");
		            
		            $(".fwd-image").mouseover(function()
            		{
            			$(this).addClass("th_over");
            			$(this).find(".image-header").css("color", "#212121");
            		});
            		
            		$(".fwd-image").mouseout(function()
            		{
            			$(this).removeClass("th_over");
            			$(this).find(".image-header").css("color", "#555555");
            		});
				
				
					var itmW;
					
		            var newTh ={
		            	name: th_name.val().replace(/"/g, "'"),
		            	path: th_image.val().replace(/"/g, "'"),
		            	url: th_image.val().replace(/"/g, "'"),
		            	info: getThumbInfo()
		            };
		            
		            playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs.push(newTh);
		            $(this).dialog("close");
	         	}else{
	          		$("#add-image-dialog").scrollTop(0);
	          	}
	        },
	        "Cancel": function()
	        {
	        	$(this).dialog("close");
	        }
	    },
	    close: function()
	    {
		    allFieldsTh.removeClass("ui-state-error");
			th_upload_img.removeClass("ui-state-error");
		    $("#add_th_tips").removeClass("fwd-error");
	    },
	    open: function(){
	    	$("#th_name").val("");
	    	$("#th_image").val("");
	    	$("#video_poster_source").val("");
			$("#image_max_width").val("");
			$("#image_max_height").val("");
			
		    setThumbText("");
		    setThumbInfo("");
		    
		    $("#wp-thtext-wrap").attr("style", "margin-top:-30px;");
		    $("#thtext-html").html("HTML");
		    $("#wp-thinfo-wrap").attr("style", "margin-top:-30px;");
		    $("#thinfo-html").html("HTML");
		    
		    var allPlimages = $("#playlists").sortable("toArray");
       		curPlOrderId = allPlimages.indexOf("pl" + cur_pl_id);
   			
   			$("#th_image").val("");
		    $("#upload_img").attr("src", "");
		    
		    $("#add_th_tips").text("The name and image path fields are required.");
       		
       		$("#thtext_ifr").height(181);
       		$("#thinfo_ifr").height(181);
		}
	});
	
	function setThumbText(str)
	{
		if (typeof tinyMCE !== "undefined" && tinyMCE.get("thtext"))
		{
			tinyMCE.get("thtext").setContent(str);
		}
	    
	    $("#thtext").val(str);
	}
	
	function getThumbText()
	{
		var th_text;
		
		if (typeof tinyMCE !== "undefined" && tinyMCE.get("thtext"))
	    {
			if ($("#wp-thtext-wrap").hasClass("tmce-active"))
			{
				th_text = tinyMCE.get("thtext").getContent();
				
				if (th_text.length < 1)
				{
					th_text = $("#thtext").val();
				}
			}
			else
			{
				th_text = $("#thtext").val();
			}
	    }
		else
		{
			th_text = $("#thtext").val();
		}
        return th_text.replace(/"/g, "'").replace(/\n/g, "");
	}
	
	function setThumbInfo(str)
	{
	    if (typeof tinyMCE !== "undefined" && tinyMCE.get("thinfo"))
	    {
	    	tinyMCE.get("thinfo").setContent(str);
	    }
	    
	    $("#thinfo").val(str);
	}
	
	function getThumbInfo()
	{
		var th_info;
		
		if (typeof tinyMCE !== "undefined" && tinyMCE.get("thinfo"))
	    {
			if ($("#wp-thinfo-wrap").hasClass("tmce-active"))
			{
				th_info = tinyMCE.get("thinfo").getContent();
				
				if (th_info.length < 1)
				{
					th_info = $("#thinfo").val();
				}
			}
			else
			{
				th_info = $("#thinfo").val();
			}
	    }
		else
		{
			th_info = $("#thinfo").val();
		}
        return th_info.replace(/"/g, "'").replace(/\n/g, "");
	}
	$(".add_image_btn").click(function(e)
	{
		var reg_exp1 = /pl[0-9]+_/;
		var reg_exp2 = /cat[0-9]+_/;
		
		cur_pl_id = parseInt($(this).attr("id").match(reg_exp1)[0].slice(2, -1));
		cur_cat_id = parseInt($(this).attr("id").match(reg_exp2)[0].slice(3, -1));
		
        $("#add-image-dialog").dialog("open");
        return false;
    });
	
	var th_name_edit = $("#th_name_edit");
    var th_image_edit = $("#th_image_edit");
    var th_image_edit = $("#th_image_edit");
    var th_target_edit = $("#th_target_edit");
	var video_poster_source_edit = $("#video_poster_source_edit");
	var image_max_width_edit = $("#image_max_width_edit");
	var image_max_height_edit = $("#image_max_height_edit");
    
    var allFieldsThEdit = $([]).add(th_name_edit).add(th_image_edit).add(th_image_edit);
	$("#edit-image-dialog").dialog(
	{
		autoOpen: false,
		width: 680,
	    height: 560,
	    modal: true,
	    buttons:
		{
	        "Update image": function()
	        {
	         	var fValid = true;
	         	var tips = $("#edit_th_tips");
	         	
	          	allFieldsThEdit.removeClass("ui-state-error");
	 
	          	fValid = fValid && checkLength(tips, th_name_edit, "name", 1, 64);
	       		//fValid = fValid && checkLength(tips, th_image_edit, "image path", 1, 256);
	       		fValid = fValid && checkLength(tips, th_image_edit, "image path", 1, 256);
				//fValid = fValid && checkImgLoad(tips, th_upload_img_edit);
	 
	          	if (fValid)
		        {
	          		var content = $("#pl" + cur_pl_id + "_cat" + cur_cat_id + "_th" + cur_th_id + " > h3").html();
	          		var pos = content.indexOf(playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs[curThOrderId].name);
	          		
	          		content = content.slice(0, pos);
	          		
	          		$("#pl" + cur_pl_id + "_cat" + cur_cat_id + "_th" + cur_th_id + " > h3").html(content + th_name_edit.val().replace(/"/g, "'"));
	          		
	          		$(".edit_image_btn").click(function()
      				{
      					var reg_exp1 = /pl[0-9]+_/;
      					var reg_exp2 = /cat[0-9]+_/;
      					var reg_exp3 = /th[0-9]+_/;
      					
      					cur_pl_id = parseInt($(this).attr("id").match(reg_exp1)[0].slice(2, -1));
      					cur_cat_id = parseInt($(this).attr("id").match(reg_exp2)[0].slice(3, -1));
      					cur_th_id = parseInt($(this).attr("id").match(reg_exp3)[0].slice(2));
      					
      					var allPlimages = $("#playlists").sortable("toArray");
      			   		curPlOrderId = allPlimages.indexOf("pl" + cur_pl_id);
      			        
      			        var allCatimages = $("#pl" + cur_pl_id + "_cats").sortable("toArray");
      			   		curCatOrderId = allCatimages.indexOf("pl" + cur_pl_id + "_cat" + cur_cat_id);
      			   		
      			   		var allThimages = $("#pl" + cur_pl_id + "_cat" + cur_cat_id + "_ths").sortable("toArray");
      			   		curThOrderId = allThimages.indexOf("pl" + cur_pl_id + "_cat" + cur_cat_id + "_th" + cur_th_id);
      					
      			        $("#edit-image-dialog").dialog("open");
      			        return false;
      			    });
	          		
	          		$(".delete_image_btn").click(function()
      				{
      					var reg_exp1 = /pl[0-9]+_/;
      					var reg_exp2 = /cat[0-9]+_/;
      					var reg_exp3 = /th[0-9]+_/;
      					
      					cur_pl_id = parseInt($(this).attr("id").match(reg_exp1)[0].slice(2, -1));
      					cur_cat_id = parseInt($(this).attr("id").match(reg_exp2)[0].slice(3, -1));
      					cur_th_id = parseInt($(this).attr("id").match(reg_exp3)[0].slice(2));
      					
      			        $("#delete-image-dialog").dialog("open");
      			        return false;
      			    });
	          		
	          		playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs[curThOrderId].name = th_name_edit.val().replace(/"/g, "'");
	          		playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs[curThOrderId].url = th_image_edit.val().replace(/"/g, "'");
	          		
	          		playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs[curThOrderId].path = th_image_edit.val().replace(/"/g, "'");
	          		playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs[curThOrderId].info = getThumbInfoEdit();
					
					$("#pl" + curPlOrderId + "_cat" + curCatOrderId + "_th" + curThOrderId+ "_img").attr("src", playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs[curThOrderId].path);
					
					
					if (is_img_changed)
					{
						playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs[curThOrderId].width = img_width;
						playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs[curThOrderId].height = img_height;
					}
		            $(this).dialog("close");
	         	}
	          	else
	          	{
	          		$("#edit-image-dialog").scrollTop(0);
	          	}
	        },
	        "Cancel": function()
	        {
	        	$(this).dialog("close");
	        }
	    },
	    close: function()
	    {
		    allFieldsThEdit.removeClass("ui-state-error");
		    $("#edit_th_tips").removeClass("fwd-error");
	    },
	    open: function()
	    {
			var allThimages = $("#pl" + cur_pl_id + "_cat" + cur_cat_id + "_ths").sortable("toArray");
		
			
	    	$("#th_name_edit").val(playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs[curThOrderId].name);
	    	$("#th_image_edit").val(playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs[curThOrderId].url);
	    	
		    setThumbTextEdit(playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs[curThOrderId].text);
		    setThumbInfoEdit(playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs[curThOrderId].info);
		    
		    $("#wp-thtextedit-wrap").attr("style", "margin-top:-30px;");
		    $("#thtextedit-html").html("HTML");
		    $("#wp-thinfoedit-wrap").attr("style", "margin-top:-30px;");
		    $("#thinfoedit-html").html("HTML");
		    
		    $("#th_media_edit").show();
		    $("#th_link_target_edit").show();
		    $("#th_media_img_edit").hide();
		      
		    var allPlimages = $("#playlists").sortable("toArray");
       		curPlOrderId = allPlimages.indexOf("pl" + cur_pl_id);
       		
		    $("#th_image_edit").val(playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs[curThOrderId].path);
		    $("#upload_img_edit").attr("src", playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs[curThOrderId].path);
		    
		    $("#edit_th_tips").text("The name and image path fields are required.");
       		
       		$("#thtextedit_ifr").height(181);
       		$("#thinfoedit_ifr").height(181);
			
			is_img_loaded = true;
			is_img_changed = false;
		}
	});
	
	function setThumbTextEdit(str)
	{
		if (typeof tinyMCE !== "undefined" && tinyMCE.get("thtextedit"))
	    {
	    	tinyMCE.get("thtextedit").setContent(str);
	    }
	    
	    $("#thtextedit").val(str);
	}
	
	function getThumbTextEdit()
	{
		var th_text_edit;
		
		if (typeof tinyMCE !== "undefined" && tinyMCE.get("thtextedit"))
	    {
			if ($("#wp-thtextedit-wrap").hasClass("tmce-active"))
			{
				th_text_edit = tinyMCE.get("thtextedit").getContent();
				
				if (th_text_edit.length < 1)
				{
					th_text_edit = $("#thtextedit").val();
				}
			}
			else
			{
				th_text_edit = $("#thtextedit").val();
			}
	    }
		else
		{
			th_text_edit = $("#thtextedit").val();
		}
        return th_text_edit.replace(/"/g, "'").replace(/\n/g, "");
	}
	
	function setThumbInfoEdit(str)
	{
		if (typeof tinyMCE !== "undefined" && tinyMCE.get("thinfoedit"))
	    {
	    	tinyMCE.get("thinfoedit").setContent(str);
	    }
	    
	    $("#thinfoedit").val(str);
	}
	
	function getThumbInfoEdit()
	{
		var th_info_edit;
		
		if (typeof tinyMCE !== "undefined" && tinyMCE.get("thinfoedit"))
	    {
			if ($("#wp-thinfoedit-wrap").hasClass("tmce-active"))
			{
				th_info_edit = tinyMCE.get("thinfoedit").getContent();
				
				if (th_info_edit.length < 1)
				{
					th_info_edit = $("#thinfoedit").val();
				}
			}
			else
			{
				th_info_edit = $("#thinfoedit").val();
			}
	    }
		else
		{
			th_info_edit = $("#thinfoedit").val();
		}
        return th_info_edit.replace(/"/g, "'").replace(/\n/g, "");
	}
	$(".edit_image_btn").click(function()
	{
		var reg_exp1 = /pl[0-9]+_/;
		var reg_exp2 = /cat[0-9]+_/;
		var reg_exp3 = /th[0-9]+_/;
		
		cur_pl_id = parseInt($(this).attr("id").match(reg_exp1)[0].slice(2, -1));
		cur_cat_id = parseInt($(this).attr("id").match(reg_exp2)[0].slice(3, -1));
		cur_th_id = parseInt($(this).attr("id").match(reg_exp3)[0].slice(2));
		
		var allPlimages = $("#playlists").sortable("toArray");
   		curPlOrderId = allPlimages.indexOf("pl" + cur_pl_id);
        
        var allCatimages = $("#pl" + cur_pl_id + "_cats").sortable("toArray");
   		curCatOrderId = allCatimages.indexOf("pl" + cur_pl_id + "_cat" + cur_cat_id);
   		
   		var allThimages = $("#pl" + cur_pl_id + "_cat" + cur_cat_id + "_ths").sortable("toArray");
   		curThOrderId = allThimages.indexOf("pl" + cur_pl_id + "_cat" + cur_cat_id + "_th" + cur_th_id);
		
        $("#edit-image-dialog").dialog("open");
        return false;
    });
	
	
	
	$("#delete-image-dialog").dialog(
	{
		autoOpen: false,
		width: 300,
	    height: 160,
	    modal: true,
	    buttons:
		{
	        "Yes": function()
	        {
				var allPlimages = $("#playlists").sortable("toArray");
		   		curPlOrderId = allPlimages.indexOf("pl" + cur_pl_id);
		        
		        var allCatimages = $("#pl" + cur_pl_id + "_cats").sortable("toArray");
		   		curCatOrderId = allCatimages.indexOf("pl" + cur_pl_id + "_cat" + cur_cat_id);
		   		
		   		var allThimages = $("#pl" + cur_pl_id + "_cat" + cur_cat_id + "_ths").sortable("toArray");
		   		curThOrderId = allThimages.indexOf("pl" + cur_pl_id + "_cat" + cur_cat_id + "_th" + cur_th_id);
		   		
		   		playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs.splice(curThOrderId, 1);
		   		
		   		$("#pl" + cur_pl_id + "_cat" + cur_cat_id + "_th" + cur_th_id).remove();
		
		   		$(".ths").sortable("refresh");
		        
		        $(this).dialog("close");
	        },
	        "No": function()
	        {
	        	$(this).dialog("close");
	        }
	    }
	});
	
	$(".delete_image_btn").click(function()
	{
		var reg_exp1 = /pl[0-9]+_/;
		var reg_exp2 = /cat[0-9]+_/;
		var reg_exp3 = /th[0-9]+_/;
		
		cur_pl_id = parseInt($(this).attr("id").match(reg_exp1)[0].slice(2, -1));
		cur_cat_id = parseInt($(this).attr("id").match(reg_exp2)[0].slice(3, -1));
		cur_th_id = parseInt($(this).attr("id").match(reg_exp3)[0].slice(2));
		
        $("#delete-image-dialog").dialog("open");
        return false;
    });
	// image custom uploader
	var custom_uploader;
    
    $("#upload_image_button").click(function(e)
    {
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader)
        {
            custom_uploader.open();
            return;
        }
        
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media(
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
        custom_uploader.on("select", function()
        {
            attachment = custom_uploader.state().get("selection").first().toJSON();
            
            $("#th_image").val(attachment.url);
			$("#upload_img").attr("src", attachment.url);
			
			is_img_loaded = false;
            $("<img/>").attr("src", attachment.url).load(function()
			{
				is_img_loaded = true;
				th_upload_img.removeClass("ui-state-error");
				
				img_width = this.width;
				img_height = this.height;
			});
        });
 
        //Open the uploader dialog
        custom_uploader.open();
    });
    
    // image custom uploader edit
    var custom_uploader_edit;
    
    $("#upload_image_button_edit").click(function(e)
    {
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader_edit)
        {
            custom_uploader_edit.open();
            return;
        }
        
        //Extend the wp.media object
        custom_uploader_edit = wp.media.frames.file_frame = wp.media(
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
        custom_uploader_edit.on("select", function()
        {
            attachment = custom_uploader_edit.state().get("selection").first().toJSON();
            
            $("#th_image_edit").val(attachment.url);
			$("#upload_img_edit").attr("src", "");
            $("#upload_img_edit").attr("src", attachment.url);
			
			is_img_loaded = false;
			is_img_changed = true;
            $("<img/>").attr("src", attachment.url).load(function()
			{
				is_img_loaded = true;
				th_upload_img_edit.removeClass("ui-state-error");
				
				img_width = this.width;
				img_height = this.height;
			});
        });
 
        //Open the uploader dialog
        custom_uploader_edit.open();
    });
    
    // image custom uploader2
	var custom_uploader2;
    
    $("#url_img_btn").click(function(e)
    {
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader2)
        {
            custom_uploader2.open();
            return;
        }
        
        //Extend the wp.media object
        custom_uploader2 = wp.media.frames.file_frame = wp.media(
        {
            title: "Choose source",
            button:
            {
                text: "Add source"
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader2.on("select", function()
        {
            attachment = custom_uploader2.state().get("selection").first().toJSON();
            
            $("#th_image").val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader2.open();
    });
    
    // image custom uploader2 edit
	var custom_uploader2_edit;
    
    $("#url_img_btn_edit").click(function(e)
    {
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader2_edit)
        {
            custom_uploader2_edit.open();
            return;
        }
        
        //Extend the wp.media object
        custom_uploader2_edit = wp.media.frames.file_frame = wp.media(
        {
            title: "Choose source",
            button:
            {
                text: "Add source"
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader2_edit.on("select", function()
        {
            attachment = custom_uploader2_edit.state().get("selection").first().toJSON();
            
            $("#th_image_edit").val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader2_edit.open();
    });
	
	
	
	
	// image custom uploader
	var custom_uploader_video_poster;
    
    $("#video_poster_upload_button").click(function(e)
    {
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader_video_poster)
        {
            custom_uploader_video_poster.open();
            return;
        }
        
        //Extend the wp.media object
        custom_uploader_video_poster = wp.media.frames.file_frame = wp.media(
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
        custom_uploader_video_poster.on("select", function()
        {
            attachment = custom_uploader_video_poster.state().get("selection").first().toJSON();
            
            $("#video_poster_source").val(attachment.url);
			$("#video_poster_thumb").attr("src", attachment.url);
			
			is_img_loaded = false;
            $("<img/>").attr("src", attachment.url).load(function()
			{
				is_img_loaded = true;
				th_upload_img.removeClass("ui-state-error");
				
				img_width = this.width;
				img_height = this.height;
			});
        });
 
        //Open the uploader dialog
        custom_uploader_video_poster.open();
    });
	
	// image custom uploader
	var custom_uploader_video_poster_edit;
    
    $("#video_poster_upload_button_edit").click(function(e)
    {
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader_video_poster_edit)
        {
            custom_uploader_video_poster_edit.open();
            return;
        }
        
        //Extend the wp.media object
        custom_uploader_video_poster_edit = wp.media.frames.file_frame = wp.media(
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
        custom_uploader_video_poster_edit.on("select", function()
        {
            attachment = custom_uploader_video_poster_edit.state().get("selection").first().toJSON();
            
            $("#video_poster_source_edit").val(attachment.url);
			$("#video_poster_thumb_edit").attr("src", attachment.url);
			
			is_img_loaded = false;
            $("<img/>").attr("src", attachment.url).load(function()
			{
				is_img_loaded = true;
				th_upload_img.removeClass("ui-state-error");
				
				img_width = this.width;
				img_height = this.height;
			});
        });
 
        //Open the uploader dialog
        custom_uploader_video_poster_edit.open();
    });
	
	// playlist thumb custom uploader edit
	var custom_uploader_pl_edit;
    $("#uploads_pl_thumb_button").click(function(e){
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader_pl_edit)
        {
            custom_uploader_pl_edit.open();
            return;
        }
        //Extend the wp.media object
        custom_uploader_pl_edit = wp.media.frames.file_frame = wp.media(
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
        custom_uploader_pl_edit.on("select", function(){
            attachment = custom_uploader_pl_edit.state().get("selection").first().toJSON();
            $("#pl_thumb").val(attachment.url);
            $("#uploads_pl_thumb").attr("src", attachment.url);
        });
        //Open the uploader dialog
        custom_uploader_pl_edit.open();
    });
	
	// playlist thumb custom uploader edit
	var custom_uploader_pl_edit;
    $("#uploads_pl_thumb_button_edit").click(function(e){
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader_pl_edit)
        {
            custom_uploader_pl_edit.open();
            return;
        }
        //Extend the wp.media object
        custom_uploader_pl_edit = wp.media.frames.file_frame = wp.media(
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
        custom_uploader_pl_edit.on("select", function(){
            attachment = custom_uploader_pl_edit.state().get("selection").first().toJSON();
            $("#pl_thumb_edit").val(attachment.url);
            $("#uploads_pl_thumb_edit").attr("src", attachment.url);
        });
        //Open the uploader dialog
        custom_uploader_pl_edit.open();
    });
	
	
	function setPlaylistText(str){
		if (typeof tinyMCE !== "undefined" && tinyMCE.get("pltext")){
			tinyMCE.get("pltext").setContent(str);
		}
	    $("#pltext").val(str);
	}
	
	function getPlaylistText(){
		var pl_text;
		if (typeof tinyMCE !== "undefined" && tinyMCE.get("pltext")){
			if ($("#wp-pltext-wrap").hasClass("tmce-active")){
				pl_text = tinyMCE.get("pltext").getContent();
				if (pl_text.length < 1){
					pl_text = $("#pltext").val();
				}
			}else{
				pl_text = $("#pltext").val();
			}
	    }else{
			pl_text = $("#pltext").val();
		}
        return pl_text.replace(/"/g, "'").replace(/\n/g, "");
	}
	
	function setPlaylistTextEdit(str){
		if (typeof tinyMCE !== "undefined" && tinyMCE.get("pltextedit")){
			tinyMCE.get("pltextedit").setContent(str);
		}
	    $("#pltextedit").val(str);
	}
	function getPlaylistTextEdit(){
		var pl_text_edit;
		if (typeof tinyMCE !== "undefined" && tinyMCE.get("pltextedit")){
			if ($("#wp-pltextedit-wrap").hasClass("tmce-active")){
				pl_text_edit = tinyMCE.get("pltextedit").getContent();
				if (pl_text_edit.length < 1){
					pl_text_edit = $("#pltextedit").val();
				}
			}else{
				pl_text_edit = $("#pltextedit").val();
			}
	    }else{
			pl_text_edit = $("#pltextedit").val();
		}
        return pl_text_edit.replace(/"/g, "'").replace(/\n/g, "");
	}
	
	var custom_bullk;
	function openBulkUploader(e){
        e.preventDefault();
		
		var cur_pl_id = cur_pl_id;
		var cur_cat_id = cur_cat_id;
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_bullk){
            custom_bullk.open();
            return;
        }
        
        //Extend the wp.media object
        custom_bullk = wp.media.frames.file_frame = wp.media({
            title: "Choose multiple images to create a category",
            button:
            {
                text: "Add image"
            },library:
            {
            	type: "image"
            },
            multiple: true
        });
		
        //When a file is selected, grab the URL and set it as the text field's value
        custom_bullk.on("select", function(){
            attachment = custom_bullk.state().get("selection").toJSON();    
			
			for(var i = 0; i<attachment.length; i++){
				var isDuplicate = false;
				
				for(var j=0; j<playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs.length; j++){
					if(playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs[j].path == attachment[i].url){
						isDuplicate = true;
					}
				}
			
				if(!isDuplicate){
					var itemsIdsAr = [];
					
					var tid = $("#pl" + curPlOrderId + "_cat" + curCatOrderId + "_ths .fwd-image").length;
	          		var thsIdsAr = [];
					
	          		$.each($("#pl" + curPlOrderId + "_cat" + curCatOrderId + "_ths .fwd-image"), function(i, el){
	          			var reg_exp = /th[0-9]+/;
            			var th_id = parseInt($(el).attr("id").match(reg_exp)[0].slice(2));
            			thsIdsAr.push(th_id);
      				});
					
	          		for (var k=0; k<playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs.length; k++){
	          			if ($.inArray(k, thsIdsAr) == -1){
	          				tid = k;
	          				break;
	          			}
	          		}
					
					addBulkItems(curPlOrderId, tid, attachment[i].filename, attachment[i].url);
				}
			}
		
			
			
        });
 
        //Open the uploader dialog
        custom_bullk.open();
    };
	
	function addBulkItems(cur_pl_id, tid, title, source){
			
			$("#pl" + cur_pl_id + "_cat" + cur_cat_id + "_ths").append("<div id='pl" + cur_pl_id + "_cat" + cur_cat_id + "_th" + tid + "' class='fwd-image'>"
				+ "<h3 class='image-header'>" + title.replace(/"/g, "'") + "</h3>"
				+ "<img src='" + source.replace(/"/g, "'") + "' class='fwd-s3dcov-image-product-img' id='pl" + cur_pl_id + "_cat" + cur_cat_id + "_th" + tid + "_img'></img>"
				+ "<button class='delete_image_btn' id='pl" + cur_pl_id + "_cat" + cur_cat_id + "_th" + tid + "_del_btn'>Delete</button>"
				+ "<button class='edit_image_btn' id='pl" + cur_pl_id + "_cat" + cur_cat_id + "_th" + tid + "_edit_btn'>Edit</button>"
			+ "</div>");
		
			$(".edit_image_btn").click(function(){
					var reg_exp1 = /pl[0-9]+_/;
					var reg_exp2 = /cat[0-9]+_/;
					var reg_exp3 = /th[0-9]+_/;
					
					cur_pl_id = parseInt($(this).attr("id").match(reg_exp1)[0].slice(2, -1));
					cur_cat_id = parseInt($(this).attr("id").match(reg_exp2)[0].slice(3, -1));
					cur_th_id = parseInt($(this).attr("id").match(reg_exp3)[0].slice(2));
					
					var allPlimages = $("#playlists").sortable("toArray");
					curPlOrderId = allPlimages.indexOf("pl" + cur_pl_id);
					
					var allCatimages = $("#pl" + cur_pl_id + "_cats").sortable("toArray");
					curCatOrderId = allCatimages.indexOf("pl" + cur_pl_id + "_cat" + cur_cat_id);
					
					var allThimages = $("#pl" + cur_pl_id + "_cat" + cur_cat_id + "_ths").sortable("toArray");
					curThOrderId = allThimages.indexOf("pl" + cur_pl_id + "_cat" + cur_cat_id + "_th" + cur_th_id);
					
					
					
					$("#edit-image-dialog").dialog("open");
					return false;
				});
				
				$(".delete_image_btn").click(function(){
					var reg_exp1 = /pl[0-9]+_/;
					var reg_exp2 = /cat[0-9]+_/;
					var reg_exp3 = /th[0-9]+_/;
					
					cur_pl_id = parseInt($(this).attr("id").match(reg_exp1)[0].slice(2, -1));
					cur_cat_id = parseInt($(this).attr("id").match(reg_exp2)[0].slice(3, -1));
					cur_th_id = parseInt($(this).attr("id").match(reg_exp3)[0].slice(2));
					
					$("#delete-image-dialog").dialog("open");
					return false;
				});
				$(".ths").sortable("refresh");
				
				$(".fwd-image").mouseover(function()
				{
					$(this).addClass("th_over");
					$(this).find(".image-header").css("color", "#212121");
				});
				
				$(".fwd-image").mouseout(function()
				{
					$(this).removeClass("th_over");
					$(this).find(".image-header").css("color", "#555555");
				});
				
			
				$(".cats").sortable("refresh");
				$(".cats").accordion("refresh");
			
			
				var itmW;
				
				var newTh ={
					name: title,
					path: source,
					url: source,
					info: ""
				};
				
				playlistsAr[curPlOrderId].categories[curCatOrderId].thumbs.push(newTh);
	}
    
    
    $("#update_btn").click(function()
	{
    	$("#playlist_data").val(JSON.stringify(playlistsAr));
    });
});