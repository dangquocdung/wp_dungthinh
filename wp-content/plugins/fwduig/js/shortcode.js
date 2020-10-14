jQuery(document).ready(function($) {
	
	$.each(fwduigPresetsObj, function(i, el){
		$("#fwduig_presets_list").append("<option value='" + el.name + "'>" + el.name + "</option>");
		setShortodeIntext();
	});

	$("#fwduig_presets_list").change(function(){
		sid = $("#fwduig_presets_list").val();
		setShortodeIntext();
	});
	
	$("#fwduig_div").hide();
	
	function setShortodeIntext(){
		if(fwduigPlaylistsObj.length > 0){
			$("#fwduig_shortocde").val('[fwduig preset_id="' + sid + '" playlist_id="' + pid + '"]');
			$("#fwduig_shortocde").show();
		}else{
			$("#fwduig_shortocde").hide();
		}
	}
		
	if (fwduigPlaylistsObj.length > 0)
	{
		$.each(fwduigPlaylistsObj, function(i, el)
		{
			$("#fwduig_playlists_list").append("<option value='" + el.name + "'>" + el.name + "</option>");
		});

		$("#fwduig_playlists_list").change(function()
		{
			pid = $("#fwduig_playlists_list").val();
			setShortodeIntext();
		});
		
		var sid = $("#fwduig_presets_list").val();
		var pid = $("#fwduig_playlists_list").val();
		
		$("#fwduig_shortcode_btn").click(function()
		{
			var shortcode = '[fwduig preset_id="' + sid + '" playlist_id="' + pid + '"]';
		
			if (typeof tinymce != "undefined")
			{
			    var editor = tinymce.get("content");
			    
			    if (editor && (editor instanceof tinymce.Editor) && ($("textarea#content:hidden").length != 0))
			    {
			        editor.selection.setContent(shortcode);
			        editor.save({no_events: true});
			    }
			    else
			    {
					var text = $("textarea#content").val();
					var select_pos1 = $("textarea#content").prop("selectionStart");
					var select_pos2 = $("textarea#content").prop("selectionEnd");
					
					var new_text = text.slice(0, select_pos1) + shortcode + text.slice(select_pos2);
					
					$("textarea#content").val(new_text);
			    } 
			}
			else
			{
				var text = $("textarea#content").val();
				var select_pos1 = $("textarea#content").prop("selectionStart");
				var select_pos2 = $("textarea#content").prop("selectionEnd");
				
				var new_text = text.slice(0, select_pos1) + shortcode + text.slice(select_pos2);
				
				$("textarea#content").val(new_text);
			}

			$("#fwduig_div").hide();
			$("#fwduig_div").fadeIn(600);
			$("#fwduig_msg").html("The shortcode has been added!");
			
			return false;
		});
	}
	else
	{
		var td = $("#fwduig_playlists_list").parent();
		
		$("#fwduig_playlists_list").remove();
		td.append("<em style='margin-left:8px;'>No playlists are available.</em>");
		
		$("#fwduig_shortcode_btn").prop("disabled", true);
		$("#fwduig_shortcode_btn").css("cursor", "default");
	}
	
	setShortodeIntext();
});