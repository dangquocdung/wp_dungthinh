<?php
// create custom plugin settings menu
add_action('admin_menu', 'cordon_google_map_menu');

function cordon_google_map_menu() {

	//create new top-level menu
	add_menu_page('Google Map Setting', 'Google Map', 'administrator', __FILE__, 'cordon_google_map_page',plugins_url('/map.png', __FILE__));

	//call register settings function
	add_action( 'admin_init', 'register_gmap_setting' );
}


function register_gmap_setting() {
	//register our settings
	register_setting( 'google-map-settings-group', 'map_coordinate' );
	register_setting( 'google-map-settings-group', 'map_zoom' );
	register_setting( 'google-map-settings-group', 'map_lightness' );
	register_setting( 'google-map-settings-group', 'map_saturation' );
	register_setting( 'google-map-settings-group', 'map_image' );
	register_setting( 'google-map-settings-group', 'map_marker_image' );
	register_setting( 'google-map-settings-group', 'marker_content' );
	register_setting( 'google-map-settings-group', 'gmap_api' );
}

function cordon_google_map_page() {
?>
<div class="wrap">
<h2>Google Map Setting</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'google-map-settings-group' ); ?>
    <?php do_settings_sections( 'google-map-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php esc_html_e('1. Google Map Latitude and Longitude','cordon_plg') ?></th>
        <td><input type="text" name="map_coordinate" value="<?php echo get_option('map_coordinate'); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row"><?php esc_html_e('2. Google Map Zoom Value','cordon_plg') ?></th>
        <td><input type="text" name="map_zoom" value="<?php echo get_option('map_zoom'); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('3. Google Map Lightness Value','cordon_plg') ?></th>
        <td><input type="text" name="map_lightness" value="<?php echo get_option('map_lightness'); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('4. Google Map Saturation Value','cordon_plg') ?></th>
        <td><input type="text" name="map_saturation" value="<?php echo get_option('map_saturation'); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row"><?php esc_html_e('5. Google Map Marker Icon','cordon_plg') ?></th>
        <td>
        <label for="upload_image">
            <input id="map_image" type="text" size="36" name="map_image" value="<?php echo get_option('map_image'); ?>" />
            <input id="upload_image_button" class="button" type="button" value="Upload Image" />
            <br /><?php esc_html_e('Enter a URL or upload an image (recommended size 37x37px)','cordon_plg') ?>
        </label>
        </td>
        </tr>
		
		<tr valign="top">
        <th scope="row"><?php esc_html_e('6. Image on Google Map Marker Content','cordon_plg') ?></th>
        <td>
        <label for="upload_image">
            <input id="map_marker_image" type="text" size="36" name="map_marker_image" value="<?php echo get_option('map_marker_image'); ?>" />
            <input id="upload_image_button2" class="button" type="button" value="Upload Image" />
            <br /><?php esc_html_e('Enter a URL or upload an image (recommended max width 400px)','cordon_plg') ?>
        </label>
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('7. Google Map Marker Content','cordon_plg') ?></th>
        <td><textarea id="marker_content" cols="30" rows="5" name="marker_content"><?php echo get_option('marker_content'); ?></textarea></td>
        </tr>
       
        <tr valign="top">
        <th scope="row"><?php esc_html_e('8. Google Map Api','cordon_plg') ?></th>
        <td><input type="text" name="gmap_api" value="<?php echo get_option('gmap_api'); ?>" /></td>
        </tr>
        
        
    </table>
    
    <?php submit_button(); ?>

</form>
		<h4><?php esc_html_e('Explanation:','cordon_plg') ?></h4>
		<ol>
        	<li><p><?php esc_html_e('You can check your latitude and longitude in <a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm">here</a>. example value: -6.94010,107.62575 ','cordon_plg') ?></p></li>
            <li><p><?php esc_html_e('Input your zoom level in here. example value: 15','cordon_plg') ?></p></li>
            <li><p><?php esc_html_e('Input your value for map lightness here. example value: 7','cordon_plg') ?></p></li>
            <li><p><?php esc_html_e('Input your value for map saturation here. example value :0 (for making normal map), default map is -100 (monochrome).','cordon_plg') ?></p></li>
            <li><p><?php esc_html_e('You can upload your icon image there.','cordon_plg') ?></p></li>
			<li><p><?php esc_html_e('You can upload your image for marker content there.','cordon_plg') ?></p></li>
            <li><p><?php esc_html_e('The content will be appear if the marker is clicked. You can use HTML tag there.','cordon_plg') ?></p></li>
            <li><p><?php esc_html_e('Insert your google api here. You can create the google map api in <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">here</a>','cordon_plg') ?></p></li>
        </ol>
</div>
<?php } 

add_action('admin_enqueue_scripts', 'cordon_gmap_admin');
 
function cordon_gmap_admin() {
	if (isset($_GET['page']) && $_GET['page'] == 'cordon_plugin/inc/google-map.php') {
        wp_enqueue_media();
        wp_enqueue_script('my-admin-js',plugins_url( '/js/gmap.js' , __FILE__ ) , array('jquery'),'', true);
	}
}
function marker_content() { ?> 
        <!--MAP MARKER CONTENT-->
        <div class="hidden map-content">
        	<div class="box-map">
            	<img src="<?php echo get_option('map_marker_image'); ?>" alt="">
                <?php echo wp_kses_post( get_option('marker_content'), true ); ?>
            </div>
        </div>
        <!--MAP MARKER CONTENT END-->

<?php } 

function rdn_google_map_start() { ?> 


			<script type="text/javascript" src="//maps.google.com/maps/api/js?key=<?php echo get_option('gmap_api'); ?>"></script>	
			<script type="text/javascript">
			(function ($) {
				'use strict';
				
				//google map load after all page finish
				var isDraggable = !('ontouchstart' in document.documentElement);
    			$(window).on("load", function() { 
					<?php if  ( get_option('map_image') != '') { ?> var icons = '<?php echo get_option('map_image'); ?>'; 
					<?php } else {?> var icons ='<?php echo plugins_url( '/office-building.png' , __FILE__ ) ?>' <?php }?>
					
					$('#map_canvas').gmap({
						'center': '<?php if  ( get_option('map_coordinate') != '') { echo get_option('map_coordinate');} else { echo "-6.94010,107.62575";} ?>',
						'zoom': <?php if  ( get_option('map_zoom') != '') { echo get_option('map_zoom');} else { echo "15";} ?> ,
						scrollwheel: false,
						'draggable' : isDraggable,
						'disableDefaultUI': false,
						'styles': [{
							stylers: [{
								lightness: <?php if  ( get_option('map_lightness') != '') { echo get_option('map_lightness');} else { echo "7";} ?>
							}, {
								saturation: <?php if  ( get_option('map_saturation') != '') { echo get_option('map_saturation');} else { echo "-100";} ?>
							}]
						}],
						'callback': function () {
							var self = this;
							
							self.addMarker({
								'position': this.get('map').getCenter(),
								icon: icons,
							}).click(function () {
								self.openInfoWindow({
									<?php $string = get_option('marker_content'); $output = preg_replace('!\s+!m', ' ', $string); ?>
									'content': $('.map-content').html()
								}, this);
							});
			
						}
			
					});
				});
			
				
			
			
			})(jQuery);
			</script>

<?php
}

function g_maps_load_home() {
	if ( is_active_widget( false, false, 'rdn_google_map_section', true ) || is_active_widget( false, false, 'rdn_contact_map_section', true )){
		wp_enqueue_script( 'ui_map',plugins_url( '/js/jquery.ui.map.js' , __FILE__ ),array(),'', 'in_footer');
		add_action( 'wp_footer', 'rdn_google_map_start',102 );
		add_action( 'wp_footer', 'marker_content',1 );
		
	}
} 





function cordon_gmap() {
	add_action( 'wp_enqueue_scripts', 'g_maps_load_home' );			
}    
add_action( 'init', 'cordon_gmap' );


