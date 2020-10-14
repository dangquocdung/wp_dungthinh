<style>
    body { font-size: 10px; }
    p { font-size: 12px; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    .fwd_editor_class { height: 200px !important; }
   
    .playlist { margin-top: 4px; margin-bottom: 4px; }
    .category { margin-top: 4px; margin-bottom: 4px; }
    #add_playlist_btn { margin-top: 6px; }
    .add_category_btn { margin-right: 4px; margin-top: 6px; }
    .edit_playlist_btn { margin-right: 4px; margin-top: 6px; }
    .delete_playlist_btn { margin-right: 4px; margin-top: 6px; }
    .add_image_btn { margin-right: 4px; margin-top: 6px; }
    .edit_category_btn { margin-right: 4px; margin-top: 6px; }
	.add_bulk_btn { margin-right: 4px; margin-top: 6px; }
    .delete_category_btn { margin-right: 4px; margin-top: 6px; }
    
    .fwd-error { color:#FF0000; }
    .ui-tooltip
    {
		max-width: 400px !important;
	}
	
	.fwd-s3dcov-image-product-img{

		width:26px;

		height:25px;

		position:absolute;

		top:2px;

		left:420px;

	}
    
    .edit_image_btn { cursor: pointer; position:absolute; left:454px; top:6px; }
    .delete_image_btn { cursor: pointer; position:absolute; left:494px; top:6px; }
    .image-header { font-size: 10px; cursor: pointer; padding: 8px; margin: 0px; color: #555555; }
    .fwd-image
    {
    	position:relative;
    	margin-top: 4px;
    	margin-bottom: 4px;
    	width: 554px;
    	height: 29px;
		border: 1px solid #d3d3d3;
		border-radius: 4px;
		background: #e6e6e6 url(<?php echo $this->_dir_url . "css/images/ui-bg_glass_75_e6e6e6_1x400.png" ?>) 50% 50% repeat-x;
    }
    .th_over
    {
    	border: 1px solid #999999;
    	background: #dadada url(<?php echo $this->_dir_url . "css/images/ui-bg_glass_75_dadada_1x400.png" ?>) 50% 50% repeat-x;
    }
</style>

<script>
	var playlistsAr = <?php echo json_encode($this->_data->playlists_ar); ?>;

	if (!playlistsAr)
	{
		playlistsAr = [];
	}
</script>

<div id="add-playlist-dialog" title="Add new playlist">
	<p id="add_pl_tips">The name field is required.</p>
	
	<fieldset>
    	<label for="pl_name">Name:</label>
		<br>
    	<input type="text" style="width:320px;"  id="pl_name" class="text ui-widget-content ui-corner-all">
		
		<br>
  	</fieldset>
</div>

<div id="edit-playlist-dialog" title="Edit playlist">
	<p id="edit_pl_tips">The name field is required.</p>
	
	<fieldset>
    	<label for="pl_name_edit">Name:</label>
    	<input type="text" id="pl_name_edit" class="text ui-widget-content ui-corner-all">
  	</fieldset>
</div>

<div id="delete-playlist-dialog" title="Delete playlist">
	<fieldset>
    	<label>Are you sure you want to delete this playlist?</label>
  	</fieldset>
</div>

<div id="add-category-dialog" title="Add new category">
	<p id="add_cat_tips">The name field is required.</p>
	
	<fieldset>
    	<label for="cat_name">Name:</label>
		<br>
    	<input type="text"  style="width:500px;" id="cat_name" class="text ui-widget-content ui-corner-all">
		<br>
		<div id="uploads_pl_thumb_div">
    		<label for="pl_thumb">Category image path (enter a URL or upload an image):</label>
    		<table style="border-spacing:0;">
    			<tr>
		    		<td style="width:500px;padding:0;">
		    			<input id="pl_thumb" type="text" style="width:500px" class="text ui-widget-content ui-corner-all">
		    		 	<button id="uploads_pl_thumb_button" style="cursor:pointer;position:relative;top:-4px;">Add Image</button>
		    		</td>
		    		<td>
		    			<img src="" id="uploads_pl_thumb" style="width:50px;height:50px;margin-left:20px;">
		    		</td>
		    	</tr>
		    </table>
		</div>
		
		<br><br>
		<div id="pl_text_div_edit">
			<label>Category text:</label>
			<?php
				$settings = array("media_buttons" => false, "wpautop" => false, "editor_class" => "fwd_editor_class", "teeny" => true);
				wp_editor("", "pltext", $settings);
			?>
		</div>
  	</fieldset>
</div>

<div id="edit-category-dialog" title="Edit category">
	<p id="edit_cat_tips">The name field is required.</p>
	
	<fieldset>
    	<label for="cat_name_edit">Name:</label>
    	<input type="text" id="cat_name_edit" class="text ui-widget-content ui-corner-all">
		
		<br>

    	<div id="uploads_pl_thumb_div_edit">
    		<label for="pl_thumb_edit">Category image path (enter a URL or upload an image):</label>
    		<table style="border-spacing:0;">
    			<tr>
		    		<td style="width:500px;padding:0;">
		    			<input id="pl_thumb_edit" type="text" style="width:500px" class="text ui-widget-content ui-corner-all">
		    		 	<button id="uploads_pl_thumb_button_edit" style="cursor:pointer;position:relative;top:-4px;">Add Image</button>
		    		</td>
		    		<td>
		    			<img src="" id="uploads_pl_thumb_edit" style="width:50px;height:50px;margin-left:20px;">
		    		</td>
		    	</tr>
		    </table>
		</div>

		<br><br>
		<div id="pl_text_div_edit">
			<label>Category text:</label>
			<?php
				$settings = array("media_buttons" => false, "wpautop" => false, "editor_class" => "fwd_editor_class", "teeny" => true);
				wp_editor("", "pltextedit", $settings);
			?>
		</div>
  	</fieldset>
</div>

<div id="delete-category-dialog" title="Delete category">
	<fieldset>
    	<label>Are you sure you want to delete this category?</label>
  	</fieldset>
</div>

<div id="add-image-dialog" title="Add new image">
	<p id="add_th_tips">The name and image path fields are required.</p>
	
	<fieldset>
    	<label for="th_name">Name:</label>
    	<br>
    	<input type="text" id="th_name" style="width:500px" class="text ui-widget-content ui-corner-all">
		
    	<br>
    	<div id="upload_image_div">
    		<label for="th_image">Image path (enter a URL or upload an image):</label>

    		<table style="border-spacing:0;">
    			<tr>
		    		<td style="width:500px;padding:0;">
		    			<input id="th_image" type="text" style="width:500px" class="text ui-widget-content ui-corner-all">
		    		 	<button id="upload_image_button" style="cursor:pointer;position:relative;top:-8px;">Add Image</button>
		    		</td>
		    		<td>
		    			<img src="" id="upload_img" style="width:50px;height:50px;margin-left:20px;">
		    		</td>
		    	</tr>
		    </table>
		</div>
    
		<br><br>
		<div id="th_info_div">
			<label>Image info text:</label>
			<?php
				$settings = array("media_buttons" => false, "wpautop" => false, "editor_class" => "fwd_editor_class", "teeny" => true);
				wp_editor("", "thinfo", $settings);
			?>
		</div>
  	</fieldset>

</div>

<div id="edit-image-dialog" title="Edit image">
	<p id="edit_th_tips">The name and image path fields are required.</p>
	
	
	<fieldset>
    	<label for="th_name_edit">Name:</label>
    	<br>
    	<input type="text" id="th_name_edit" style="width:500px" class="text ui-widget-content ui-corner-all">
    	
		<br><br>
		<br>
    	<div id="upload_image_div">
    		<label for="th_image_edit">Image path (enter a URL or upload an image):</label>

    		<table style="border-spacing:0;">
    			<tr>
		    		<td style="width:500px;padding:0;">
		    			<input id="th_image_edit" type="text" style="width:500px" class="text ui-widget-content ui-corner-all">
		    		 	<button id="upload_image_button_edit" style="cursor:pointer;position:relative;top:-8px;">Add Image</button>
		    		</td>
		    		<td>
		    			<img src="" id="upload_img_edit" style="width:50px;height:50px;margin-left:20px;">
		    		</td>
		    	</tr>
		    </table>
		</div>
		
		<br><br>
		<div id="th_info_div_edit">
			<label>Image info text:</label>
			<?php
				$settings = array("media_buttons" => false, "wpautop" => false, "editor_class" => "fwd_editor_class", "teeny" => true);
				wp_editor("", "thinfoedit", $settings);
			?>
		</div>
  	</fieldset>

	
</div>

<div id="delete-image-dialog" title="Delete image">
	<fieldset>
    	<label>Are you sure you want to delete this image?</label>
  	</fieldset>
</div>

<form action="" method="post" style="margin-top:20px;margin-right:20px;">
	<div style="height:600px;padding:20px;overflow:auto;" class="ui-widget ui-widget-content ui-corner-all">
		<h3>All playlists:</h3>
	  	
		<div id="playlists" style="width:700px">
			<?php 
				$playlists_str = "";
				
				if (isset($this->_data->playlists_ar))
				{
					foreach ($this->_data->playlists_ar as $playlist)
			    	{
			    		$pid = $playlist["id"];
			    		
			    		$playlists_str .= "<div id='pl" . $pid . "' class='playlist'>";
			    		
			    		$playlists_str .= "<h3 class='playlist-header'>" . $playlist["name"] . "<span style='float:right'>ID : " . $pid . "</span></h3>";
			    		
			    		$playlists_str .= "<div>";
			    		
			    		$playlists_str .= "<div id='pl" . $pid . "_cats' class='cats' style='width:654px'>";
			    		
			    		foreach ($playlist["categories"] as $cid => $category)
		    			{
		    				$playlists_str .= "<div id='pl" .$pid . "_cat" . $cid . "' class='category'>";
		    				
		    				$playlists_str .= "<h3 class='category-header'>" . $category["name"] . "</h3>";
		    				
		    				$playlists_str .= "<div>";
		    				
		    				$playlists_str .= "<div id='pl" . $pid . "_cat" . $cid . "_ths' class='ths' style='width:554px'>";
		    				
		    				foreach ($category["thumbs"] as $tid => $thumb)
		    				{
		    					$playlists_str .= "<div id='pl" . $pid . "_cat" . $cid . "_th" . $tid . "' class='fwd-image'>";
		    					
		    					$playlists_str .= "<h3 class='image-header'>" . $thumb["name"] . "</h3>";
								
								$playlists_str .= "<img src='" . $thumb['path'] . "' class='fwd-s3dcov-image-product-img' id='pl" . $pid . "_cat" . $cid . "_th" . $tid . "_img'></img>";
		    					
		    					$playlists_str .= "<button class='delete_image_btn' id='pl" . $pid . "_cat" . $cid . "_th" . $tid . "_del_btn'>Delete</button>";
		    					
		    					$playlists_str .= "<button class='edit_image_btn' id='pl" . $pid . "_cat" . $cid . "_th" . $tid . "_edit_btn'>Edit</button>";
		    					
		    					$playlists_str .= "</div>";
		    				}
		    				
		    				$playlists_str .= "</div>";
		    				
		    				$playlists_str .= "<button class='add_image_btn' id='pl" . $pid . "_cat" . $cid . "_add_btn' style='cursor:pointer;'>Add new image</button>";
							$playlists_str .= "<button class='add_bulk_btn' id='pl" . $pid . "_cat" . $cid . "_bulk_btn' style='cursor:pointer;'>Add bulk images</button>";
		    				
		    				$playlists_str .= "<button class='edit_category_btn' id='pl" . $pid . "_cat" . $cid . "_edit_btn' style='cursor:pointer;'>Edit</button>";
			    		
			    			$playlists_str .= "<button class='delete_category_btn' id='pl" . $pid . "_cat" . $cid . "_del_btn' style='cursor:pointer;'>Delete</button>";
		    				
		    				$playlists_str .= "</div>";
		    				
		    				$playlists_str .= "</div>";
		    			}
			    		
			    		$playlists_str .= "</div>";
			    		
			    		$playlists_str .= "<button class='add_category_btn' id='pl" .$pid . "_add_btn' style='cursor:pointer;'>Add new category</button>";
			    		
			    		$playlists_str .= "<button class='edit_playlist_btn' id='pl" . $pid . "_edit_btn' style='cursor:pointer;'>Edit</button>";
			    		
			    		$playlists_str .= "<button class='delete_playlist_btn' id='pl" . $pid . "_del_btn' style='cursor:pointer;'>Delete</button>";
			    		
			    		$playlists_str .= "</div>";
			    		
			    		$playlists_str .= "</div>";
			    	}
			    	
			    	echo $playlists_str;
				}
			?>
		</div>
		
		<em id="pl_em" style="display:block;margin-bottom:8px;">No playlists are available.</em>
		
		<button id="add_playlist_btn" style="cursor:pointer">Add new playlist</button>
  	</div>
  	
  	<input type="hidden" id="playlist_data" name="playlist_data" value="">

	<input id="update_btn" type="submit" name="submit" style="cursor:pointer;margin-top:20px;" value="Update playlists" />
	
	<?php wp_nonce_field("fwduig_playlist_manager_update", "fwduig_playlist_manager_nonce"); ?>
</form>

<?php echo $msg; ?>

