<?php
//widget

class rdn_google_map_widget extends WP_Widget {

// constructor
public function __construct() {
        $widget_ops = array(
			'classname' => 'rdn_google_map_section', 
			'description' => __('Display google map.'),
			'panels_groups' => array('cordon_builder'),
			'panels_icon' => 'dashicons dashicons-location'
		);
        parent::__construct('rdn_google_map_section', __('Google Map Element'), $widget_ops);
    }

// widget form creation

function form($instance) {

// Check values
if( $instance) {

} else {

}

?>

<h3>Please note:</h3>
<p>This element will show the google map content. You need to set the google map first.<br />
For google map setting, you can go to left menu->Google Map.</p>
<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;
// Fields

return $instance;
}

// display widget
function widget($args, $instance) {
extract( $args );

// these are the widget options

?>
						
              
					
                    
                	<div id="map_canvas" class="map_canvas"><!--DISPLAY GOOGLE MAP HERE--></div>
           
		
<?php 

}
}

// register widget outsite widget page
function register_rdn_google_map_widget() {
	global $pagenow;
	if ($pagenow != 'widgets.php') {
	register_widget( 'rdn_google_map_widget' );
	}
}
add_action( 'widgets_init', 'register_rdn_google_map_widget' );


