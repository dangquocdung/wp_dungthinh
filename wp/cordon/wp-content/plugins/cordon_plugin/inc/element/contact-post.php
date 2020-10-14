<?php
//widget

class rdn_contact_post_widget extends WP_Widget {

// constructor
public function __construct() {
        $widget_ops = array(
			'classname' => 'rdn_contact_section', 
			'description' => __('Display contact post.'),
			'panels_groups' => array('cordon_builder'),
			'panels_icon' => 'dashicons dashicons-exerpt-view'
		);
        parent::__construct('rdn_contact_section', __('Contact Post Element'), $widget_ops);
    }

// widget form creation

function form($instance) {

// Check values
if( $instance) {

} else {

}

?>


<h3>Please note:</h3>
<p>This block will show the contact post.<br />You can create the contact post in left menu->Contact Posts->Add New Contact Post. After that you can insert the shortcode from contact form 7 inside the contact post to show the form.<br />
You can set the contact form & shortcode in left menu->Contact->Contact Forms.</p>
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


     
            <div class="table-cell-box table-content">
                
                <?php  
                            $ridianur_team = new WP_Query(array(  
                                    'post_type' =>  'contact',  
                                    'posts_per_page'  =>'1'  
                                )  
                            );  
                            if ($ridianur_team->have_posts()) { while  ($ridianur_team->have_posts()) : $ridianur_team->the_post();
                            global $post ;
                            
                            the_content();
                            
                            endwhile; } 
							else { ?>
                            <div class="spacing80 clearboth"></div>
                            <div class="alert alert-danger">
                                <p><?php echo esc_html( 'No Contact Post here!
                                You need to create Contact Post first and display it in Contact Post Element settings.','cordon_plg' ); ?></p>
                            </div>
                            <div class="spacing80 clearboth"></div>
							<?php }
							wp_reset_postdata();?>
               
            </div><!--/.table-cell-box-->
               

						
                
                            
		
<?php 

}
}

// register widget outsite widget page
function register_rdn_contact_post_widget() {
	global $pagenow;
	if ($pagenow != 'widgets.php') {
	register_widget( 'rdn_contact_post_widget' );
	}
}
add_action( 'widgets_init', 'register_rdn_contact_post_widget' );


