<?php
//widget

function rdn_client_script() {
    if ( is_active_widget( false, false, 'rdn_client_section', true ) ) {
        wp_enqueue_script('jquery-slick' ,plugins_url( '/js/slick.min.js' , __FILE__ ) , array('jquery'), null, true );
		wp_enqueue_script('slider-client',plugins_url( '/js/client.js' , __FILE__ ) , array('jquery'), null, true );		
    }
}

add_action('wp_enqueue_scripts', 'rdn_client_script', 20, 1);

class rdn_client_testi_widget extends WP_Widget {

// constructor
public function __construct() {
        $widget_ops = array(
			'classname' => 'rdn_client_section', 
			'description' => __('Display client section with title.'),
			'panels_groups' => array('cordon_builder'),
			'panels_icon' => 'dashicons dashicons-universal-access-alt'
		);
        parent::__construct('rdn_client_section', __('Client Section Block'), $widget_ops);
    }

// widget form creation

function form($instance) {

// Check values
if( $instance) {
$cl_delay = $instance['cl_delay'];
} else {
$cl_delay = '';
}

?>

<p>
  <label for="<?php echo $this->get_field_id('cl_delay'); ?>">
    <?php esc_html_e('Client Slider Delay:', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('cl_delay'); ?>" name="<?php echo $this->get_field_name('cl_delay'); ?>" type="text" value="<?php echo $cl_delay ?>">
  <br/>Insert the value for slider delay here (in miliseconds). The default value is 5000
</p>
<h3>Please note</h3>
<p>This block will show the Client post with title. <br />
You can create the Client Post in left menu->Client->Add New Client.</p>
<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;
// Fields
$instance['cl_delay'] = strip_tags($new_instance['cl_delay']);
return $instance;
}

// display widget
function widget($args, $instance) {
extract( $args );

// these are the widget options
$cl_delay = isset( $instance['cl_delay'] ) ? esc_attr( $instance['cl_delay'] ) : '';

echo $before_widget; ?>
		<?php $ridianur_client = new WP_Query(array(  
						'post_type' =>  'client',  
						'posts_per_page'  =>'-1'  
					)  
				);  
				if ($ridianur_client->have_posts()) { ?>
                    
        <!--CLIENT LIST START-->
        <div class="client-list content clearfix">
            <div class="client-slider" data-slick='{"autoplaySpeed": <?php if ($cl_delay !=''){echo $cl_delay;} else {echo '5000'; } ?>}'>
                <?php  
                    while  ($ridianur_client->have_posts()) : $ridianur_client->the_post();
                    global $post ;
                    ?>
                        
                    <div>
                        <img alt="<?php the_title(); ?>" src="<?php echo esc_url( apply_filters('get_the_content', get_post_meta($post->ID, 'client_img', true))); ?>">
                    </div><!--/.col-md-3-->
                    
                <?php endwhile;?>
            </div><!--/.client-slider-->
        </div><!--client-list-->
        <!--CLIENT LIST END-->
        <?php } else { ?>
        <div class="spacing80 clearboth"></div>
        <div class="container alert alert-danger">
            <p><?php echo esc_html( 'No clients  here!
            You need to create client first and display it in Client Section Block settings.','cordon_plg' ); ?></p>
        </div>
        <div class="spacing80 clearboth"></div>
        <?php  } wp_reset_postdata(); ?>
       
                            
		
<?php 
echo $after_widget;
}
}

// register widget outsite widget page
function register_rdn_client_testi_widget() {
	global $pagenow;
	if ($pagenow != 'widgets.php') {
	register_widget( 'rdn_client_testi_widget' );
	}
}
add_action( 'widgets_init', 'register_rdn_client_testi_widget' );



