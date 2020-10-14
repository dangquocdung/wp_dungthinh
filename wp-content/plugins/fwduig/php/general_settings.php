<style>

   	body { font-size: 10px; }

    p { font-size: 12px; }

    input.text { width:95%; padding: .4em; }

    fieldset { padding:0; border:0; margin-top:25px; }

    table { border-spacing:0;float:left;margin-right:40px; }

    tr { height:50px;}

    td { padding:0; width:230px;}

    .fwd-error { color:#FF0000; }

</style>



<script>

	var settingsAr = <?php echo json_encode($this->_data->settings_ar); ?>;

	

	var sid = <?php echo $set_id; ?>;



	var cur_order_id = <?php echo $set_order_id; ?>;

	var tab_init_id = <?php echo $tab_init_id; ?>;

</script>



<fieldset class="ui-widget">

	<label for="skins">Select your preset:</label>

	

    <select id="skins" class="ui-widget ui-corner-all" style="max-width:200px;"></select>

    <label id="preset_id" for="skins"></label>

    

    <p id="tips" style="width:600px;">All form fields are required.</p>

</fieldset>



<form action="" method="post" style="margin-top:20px;margin-right:20px;">

	<div id="tabs" style="height:650px;overflow:auto;">

	  	<ul>

			<?php $iconsPath = plugin_dir_url(dirname(__FILE__)) . "load/icons/" ?>

		    <li><a href="#tab1"><img src=<?php echo $iconsPath . "tab1-icon.png" ?> style="vertical-align:middle;"><span style="vertical-align:middle;margin-left:4px;">Main settings</span></a></li>

		    <li><a href="#tab2"><img src=<?php echo $iconsPath . "tab2-icon.png" ?> style="vertical-align:middle;"><span style="vertical-align:middle;margin-left:4px;">Thumbnails settings</span></a></li>

		    <li><a href="#tab3"><img src=<?php echo $iconsPath . "tab3-icon.png" ?> style="vertical-align:middle;"><span style="vertical-align:middle;margin-left:4px;">Description window settings</span></a></li>

		    <li><a href="#tab4"><img src=<?php echo $iconsPath . "tab4-icon.png" ?> style="vertical-align:middle;"><span style="vertical-align:middle;margin-left:4px;">Categories menu settings</span></a></li>

	  	</ul>

	 

	  	<div id="tab1">

			<table>

    			<tr>

		    		<td>

		    			<label for="name">Preset name:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="name" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="skinPath">Skin type:</label>

		    		</td>

		    		<td>

		    			<select id="skinPath" class="ui-corner-all">

							<option value="dark_skin">dark_skin</option>

							<option value="white_skin">white_skin</option>

						</select>

		    		</td>

		    	</tr>

		    	<tr>

		    		<td>

		    			<label for="display_type">Display type:</label>

		    		</td>

		    		<td>

		    			<select id="display_type" class="ui-corner-all">

							<option value="fluidwidth">fluid-width</option>

							<option value="responsive">responsive</option>

						</select>

						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"

						title="If 'fluid-width' the gallery will always fill the browser width and its height will be the below value.

							If 'responsive' the gallery will fill its container width and its height will be the below value.">

		    		</td>

		    	</tr>

		    	<tr>

		    		<td>

		    			<label for="autoScale">Autoscale:</label>

		    		</td>

		    		<td>

		    			<select id="autoScale" class="ui-corner-all">

							<option value="yes">yes</option>

							<option value="no">no</option>

						</select>

						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"

							title="If 'yes' and the layout width is less than the specified gallery width, then it will keep a correct scale ratio.

								If 'no' the gallery size and scale ratio will not be modified.">

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="maxWidth">Gallery width:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="maxWidth" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    		</td>

		    	</tr>

		    	<tr>

		    		<td>

		    			<label for="maxHeight">Gallery height:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="maxHeight" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="rightClickContextMenu">Right-click context menu:</label>

		    		</td>

		    		<td>

		    			<select id="rightClickContextMenu" class="ui-corner-all">

							<option value="developer">developer</option>

							<option value="disabled">disabled</option>

							<option value="default">default</option>

						</select>

						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"

							title="If 'developer' the context menu will be the developer link 'made by FWD'.

							If 'disabled' the context menu will be disabled completely.

							If 'default' the context menu will be the browser default.">

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="useDeepLinking">Use deeplinking:</label>

		    		</td>

		    		<td>

		    			<select id="useDeepLinking" class="ui-corner-all">

							<option value="yes">yes</option>

							<option value="no">no</option>

						</select>

						

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="buttonsAlignment">Buttons alignment:</label>

		    		</td>

		    		<td>

		    			<select id="buttonsAlignment" class="ui-corner-all">

							<option value="in">in</option>

							<option value="out">out</option>

						</select>

		    		</td>

		    	</tr>

				

				<tr>

		    		<td>

		    			<label for="slideShowAutoPlay">Slideshow autoplay:</label>

		    		</td>

		    		<td>

		    			<select id="slideShowAutoPlay" class="ui-corner-all">

							<option value="yes">yes</option>

							<option value="no">no</option>

						</select>

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="addKeyboardSupport">Add keyboard navigation support:</label>

		    		</td>

		    		<td>

		    			<select id="addKeyboardSupport" class="ui-corner-all">

							<option value="yes">yes</option>

							<option value="no">no</option>

						</select>

		    		</td>

		    	</tr>
		    	<tr>

		    		<td>

		    			<label for="showFullScreenButton">Show fullscreen button:</label>

		    		</td>

		    		<td>

		    			<select id="showFullScreenButton" class="ui-corner-all">

							<option value="yes">yes</option>

							<option value="no">no</option>

						</select>

						

		    		</td>

		    	</tr>

		    </table>

		    

		    <table>

		    	

				<tr>

		    		<td>

		    			<label for="showFacebookButton">Show share button:</label>

		    		</td>

		    		<td>

		    			<select id="showFacebookButton" class="ui-corner-all">

		    				<option value="no">no</option>

							<option value="yes">yes</option>

						</select>

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="showZoomButton">Show zoom in / out button:</label>

		    		</td>

		    		<td>

		    			<select id="showZoomButton" class="ui-corner-all">

							<option value="no">no</option>

							<option value="yes">yes</option>

						</select>

		    		</td>

		    	</tr>

				

				<tr>

		    		<td>

		    			<label for="showSlideShowButton">Show slideshow button:</label>

		    		</td>

		    		<td>

		    			<select id="showSlideShowButton" class="ui-corner-all">

		    				<option value="no">no</option>

							<option value="yes">yes</option>

						</select>

		    		</td>

		    	</tr>

		    	<tr>

		    		<td>

		    			<label for="showNextAndPrevButtons">Show next and previous buttons:</label>

		    		</td>

		    		<td>

		    			<select id="showNextAndPrevButtons" class="ui-corner-all">

							<option value="yes">yes</option>

							<option value="no">no</option>

						</select>

						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="Disable next and previous buttons on all devices, mobile and desktop.">

		    		</td>

		    	</tr>

				

				<tr>

		    		<td>

		    			<label for="showNextAndPrevButtonsOnMobile">Show next and previous buttons on mobile:</label>

		    		</td>



		    		<td>

		    			<select id="showNextAndPrevButtonsOnMobile" class="ui-corner-all">

							<option value="yes">yes</option>

							<option value="no">no</option>

						</select>

						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="Disable next and previous buttons only on mobile devices.">

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="fluidWidthZIndex">Fluid width z index:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="fluidWidthZIndex" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"

							title="The gallery z index for the gallery when the display type is fluid width.">

		    		</td>

		    	</tr>

				

				<tr>

		    		<td>

		    			<label for="startAtItem">Start at item:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="startAtItem" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"

							title="The first image to display when the gallery is first displayed.">

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="buttonsHideDelay">Buttons hide delay:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="buttonsHideDelay" style="width:200px;" class="text ui-widget-content ui-corner-all">

						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="Delays in seconds until the buttons will hide after the last mouse or touch interaction.">

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="slideShowDelay">Slideshow delay:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="slideShowDelay" style="width:200px;" class="text ui-widget-content ui-corner-all">

						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="Slideshow delay in seconds.">

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="itemOffsetHeight">Item offset height:</label>

		    		</td>



		    		<td>

		    			<input type="text" id="itemOffsetHeight" style="width:200px;" class="text ui-widget-content ui-corner-all">

						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="Represents the px to remove from the top and bottom part of the item, think of this as margin top and margin bottom for the item.">

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="spaceBetweenButtons">Space between buttons:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="spaceBetweenButtons" style="width:200px;" class="text ui-widget-content ui-corner-all">

						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="Space between buttons in px.">

		    		</td>

		    	</tr>
		    	<tr>

		    		<td>

		    			<label for="buttonsOffsetIn">Buttons offset in:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="buttonsOffsetIn" style="width:200px;" class="text ui-widget-content ui-corner-all">

						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="Space between the buttons in px and the item, think of this as margin left for the buttons from the right side of the item and margin right for the buttons from the left site of the item.">

		    		</td>

		    	</tr>
				

		    </table>

			<table>

				

				<tr>

		    		<td>

		    			<label for="buttonsOffsetOut">Buttons offset out:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="buttonsOffsetOut" style="width:200px;" class="text ui-widget-content ui-corner-all">

						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="Space between the buttons in px and window left or right side, think of this as margin right for the buttons from the right side of the item and margin left for the buttons from the left site of the item.">

		    		</td>

		    	</tr>

				

				<tr>

		    		<td>

		    			<label for="itemBorderSize">Item border size:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="itemBorderSize" style="width:200px;" class="text ui-widget-content ui-corner-all">

						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="Item border size in px.">

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="itemBorderRadius">Item border radius:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="itemBorderRadius" style="width:200px;" class="text ui-widget-content ui-corner-all">

						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="Item border radius in px.">

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="itemBoxShadow">Item box shadow:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="itemBoxShadow" style="width:200px;" class="text ui-widget-content ui-corner-all">

						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="To add a shadow to the item set this option to a box shadow CSS valid value for example 5px 10px #888888, if not set it to none.">

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="spaceBetweenControllBarButtons">Space between the control bar and main item in px:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="spaceBetweenControllBarButtons" style="width:200px;" class="text ui-widget-content ui-corner-all">

						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="A number that represents the space in px between the thumbnails control bar and main item.">

		    		</td>

		    	</tr>

				

		    	<tr>

		    		<td>

		    			<label for="itemBackgroundColor">Item background color:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="itemBackgroundColor" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    		</td>

		    	</tr>

				

				<tr>

		    		<td>

		    			<label for="itemBorderColor">Item border color:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="itemBorderColor" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    		</td>

		    	</tr>

				

				<tr>

		    		<td>

		    			<label for="backgroundColor">Background color:</label>

		    		</td>

		    		<td>

		    			<input id="backgroundColor" />

		    		</td>

		    	</tr>

			</table>

		</div>

	  

		<div id="tab2">

		  	<table>

				<tr>

		    		<td>

		    			<label for="showThumbnails">Show thumbnails:</label>

		    		</td>

		    		<td>

		    			<select id="showThumbnails" class="ui-corner-all">

							<option value="yes">yes</option>

							<option value="no">no</option>

						</select>

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="showLargeThumbnail">Show large thumbnails:</label>

		    		</td>

		    		<td>

		    			<select id="showLargeThumbnail" class="ui-corner-all">

							<option value="yes">yes</option>

							<option value="no">no</option>

						</select>

		    		</td>

		    	</tr>

				

				<tr>

		    		<td>

		    			<label for="showThumbnailsHideOrShowButton">Show thumbnails hide / show button:</label>

		    		</td>

		    		<td>

		    			<select id="showThumbnailsHideOrShowButton" class="ui-corner-all">

							<option value="yes">yes</option>

							<option value="no">no</option>

						</select>

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="showThumbnailsByDefault">Show thumbnails by default:</label>

		    		</td>

		    		<td>

		    			<select id="showThumbnailsByDefault" class="ui-corner-all">

							<option value="yes">yes</option>

							<option value="no">no</option>

						</select>

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="showThumbnailsOverlay">Show thumbnails overlay:</label>

		    		</td>

		    		<td>

		    			<select id="showThumbnailsOverlay" class="ui-corner-all">

							<option value="yes">yes</option>

							<option value="no">no</option>

						</select>

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="thumbnailsBackgroundOffestWidthAndHeight">Thumbnails padding:</label>

		    		</td>

					<td>

		    		<input type="text" id="thumbnailsBackgroundOffestWidthAndHeight" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="Vertical and horizontal padding in px for the thumbnails images.">

						</td>

		    	</tr>

		    	<tr>

		    		<td>

		    			<label for="thumbnailWidth">Thumbnails image width:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="thumbnailWidth" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="A number that represents the thumbnails width in px.">

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="thumbnailHeight">Thumbnails image height:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="thumbnailHeight" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="A number that represents the thumbnails height in px.">

		    		</td>

		    	</tr>

		    	<tr>

		    		<td>

		    			<label for="thumbnailsBorderSize">Thumbnails border size:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="thumbnailsBorderSize" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="The thumbnails border size in px.">

		    		</td>

		    	</tr>

		    	<tr>

		    		<td>

		    			<label for="thumbnailsBorderRadius">Thumbnails border radius:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="thumbnailsBorderRadius" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="The thumbnails border radius in px.">

		    		</td>

		    	</tr>

		    	<tr>

		    		<td>

		    			<label for="spaceBetweenThumbnailsAndItem">Space between thumbnails and item:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="spaceBetweenThumbnailsAndItem" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="A number that represents the space between the thumbnails and the item in px.">

		    		</td>

		    	</tr>

		    	<tr>

		    		<td>

		    			<label for="thubnaisOffsetTopAndBottom">Thumbnails offset top and bottom:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="thubnaisOffsetTopAndBottom" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    		</td>

		    	</tr>

		    </table>

		    

		    <table>	

				<tr>

		    		<td>

		    			<label for="spaceBetweenThumbnails">Space between thumbnails:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="spaceBetweenThumbnails" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="Space between thumbnails in px.">

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="largeThumbnailBorderSize">Large thumbnails border size:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="largeThumbnailBorderSize" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="large thumbnails border size in px.">

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="largeImageWidth">Large thumbnails width:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="largeImageWidth" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="The width of the large thumbanils in px, the height will be generated automatically to keep a correct ratio.">

		    		</td>

		    	</tr>

				

				<tr>

		    		<td>

		    			<label for="thumbnailsOverlayOpacity">Thumbnails overlay opacity:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="thumbnailsOverlayOpacity" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="A number from 0 to 1 that represents the thumbnails overlay opacity where 0.5 represents 50% opacity">

		    		</td>

		    	</tr>

				

				<tr>		    		

					<td>		    			

						<label for="largeThumbanilBackgroundColor">Large thumbnails background color:</label>		    		

					</td>		    		

					<td>		    			

						<input id="largeThumbanilBackgroundColor" />		    			

					</td>		    	

				</tr>

				<tr>		    		

					<td>		    			

						<label for="thumbnailsBorderNormalColor">Thumbnails border normal color:</label>		    		

					</td>		    		

					<td>		    			

						<input id="thumbnailsBorderNormalColor" />		    			

					</td>		    	

				</tr>

		    	<tr>

		    		<td>

		    			<label for="thumbnailsBorderSelectedColor">Thumbnails border selected color:</label>

		    		</td>

		    		<td>

		    			<input id="thumbnailsBorderSelectedColor" />

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="thumbnailsOverlayColor">Thumbnails overlay color:</label>

		    		</td>

		    		<td>

		    			<input id="thumbnailsOverlayColor" />

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="thumbnailsMainBackgroundColor">Thumbnails main background color:</label>

		    		</td>

		    		<td>

		    			<input id="thumbnailsMainBackgroundColor" />

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="thumbnailsSecondaryBackgroundColor">Thumbnails secondary background color:</label>

		    		</td>

		    		<td>

		    			<input id="thumbnailsSecondaryBackgroundColor" />

		    		</td>

		    	</tr>

				

				<tr>

		    		<td>

		    			<label for="thumbnailsBackgroundColor">Thumbnails background color:</label>

		    		</td>

		    		<td>

		    			<input id="thumbnailsBackgroundColor" />

		    		</td>

		    	</tr>

				

				

				

				

		    </table>

		</div>

		  

		<div id="tab3">

	    	<table>

	    		<tr>

		    		<td>

		    			<label for="showDescriptionButton">Show description window button:</label>

		    		</td>

		    		<td>

						<select id="showDescriptionButton" class="ui-corner-all">

							<option value="yes">yes</option>

							<option value="no">no</option>

						</select>

		    		</td>

		    	</tr>

		    	<tr>

		    		<td>

		    			<label for="showDescriptionByDefault">Show description window by default:</label>

		    		</td>

		    		<td>

		    			<select id="showDescriptionByDefault" class="ui-corner-all">

							<option value="yes">yes</option>

							<option value="no">no</option>

						</select>

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="descriptionWindowPosition">Description window position:</label>

		    		</td>

		    		<td>

		    			<select id="descriptionWindowPosition" class="ui-corner-all">

							<option value="top">top</option>

							<option value="bottom">bottom</option>

						</select>

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="descriptionWindowBackgroundColor">Description window background color:</label>

		    		</td>

		    		<td>

		    			<input id="descriptionWindowBackgroundColor" />

		    		</td>

		    	</tr>

		    	<tr>

		    		<td>

		    			<label for="descriptionWindowBackgroundOpacity">Description window background opacity:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="descriptionWindowBackgroundOpacity" style="width:200px;" class="text ui-widget-content ui-corner-all">

						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="A number from 0 to 1. For example 0.5 will set the opacity to 50%.">

		    		</td>

		    	</tr>

						

		     </table>

		</div>

	

		<div id="tab4">

			<table>

		    	<tr>

		    		<td>

		    			<label for="showCategoriesMenuButton">Show categories menu button:</label>

		    		</td>

		    		<td>

		    			<select id="showCategoriesMenuButton" class="ui-corner-all">

							<option value="yes">yes</option>

							<option value="no">no</option>

						</select>

						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"

							title="This is used to show or hide the gallery categories menu. This is used to select the gallery categories.">

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="showSearchInput">Show search input:</label>

		    		</td>

		    		<td>

		    			<select id="showSearchInput" class="ui-corner-all">

							<option value="yes">yes</option>

							<option value="no">no</option>

						</select>

		    		</td>

		    	</tr>

				

				<tr>

		    		<td>

		    			<label for="randomizeCategories">Randomize categories</label>

		    		</td>

		    		<td>

		    			<select id="randomizeCategories" class="ui-corner-all">

							<option value="yes">yes</option>

							<option value="no">no</option>

						</select>

						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"

							title="Randomize or not categories.">

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="startAtCategory">Start at category:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="startAtCategory" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="This is used to specify the selected start category of the categories menu if there is more than one category. Please note that the counting starts from 0.">

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="thumbnailMaxWidth">Thumbnails max width:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="thumbnailMaxWidth" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="The categories thumbnails max width in px.">

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="thumbnailMaxHeight">Thumbnails max height:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="thumbnailMaxHeight" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="The categories thumbnails max height in px.">

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="horizontalSpaceBetweenThumbnails">Horizontal space between thumbnails:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="horizontalSpaceBetweenThumbnails" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="Horizontal space between thumbnails in px.">

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="verticalSpaceBetweenThumbnails">Vertical space between thumbnails:</label>

		    		</td>

		    		<td>

		    			<input type="text" id="verticalSpaceBetweenThumbnails" style="width:200px;" class="text ui-widget-content ui-corner-all">

		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"

							title="Vertical space between thumbnails in px.">

		    		</td>

		    	</tr>

				<tr>

		    		<td>

		    			<label for="categoriesBackgorundColor">Categories background color:</label>

		    		</td>

		    		<td>

		    			<input id="categoriesBackgorundColor" />

		    		</td>

		    	</tr>

		    	<tr>

		    		<td>

		    			<label for="thumbnailBackgroundColor">Thumbnails background color:</label>

		    		</td>

		    		<td>

		    			<input id="thumbnailBackgroundColor" />

		    		</td>

		    	</tr>

		    	<tr>

		    		<td>

		    			<label for="thumbnailTextBackgroundColor">Thumbnails text background color:</label>

		    		</td>

		    		<td>

		    			<input id="thumbnailTextBackgroundColor" />

		    		</td>

		    	</tr>

		    	<tr>

		    		<td>

		    			<label for="inputBackgroundColor">Input background color:</label>

		    		</td>

		    		<td>

		    			<input id="inputBackgroundColor" />

		    		</td>

		    	</tr>

		    </table>

			<table>

				<tr>

		    		<td>

		    			<label for="inputColor">Input text color:</label>

		    		</td>

		    		<td>

		    			<input id="inputColor" />

		    		</td>

				</tr>

			</table>

		</div>

	

	</div>

	

	<input type="hidden" id="settings_data" name="settings_data" value="">

	

	<input id="add_btn" type="submit" name="submit" style="cursor:pointer;margin-top:20px;" value="Add new preset" />

	<input id="update_btn" type="submit" name="submit" style="cursor:pointer;margin-top:20px;" value="Update preset settings" />

	<input id="del_btn" type="submit" name="submit" style="cursor:pointer;margin-top:20px;" value="Delete preset" />

	

	<?php wp_nonce_field("fwduig_general_settings_update", "fwduig_general_settings_nonce"); ?>

</form>



<?php echo $msg; ?>



