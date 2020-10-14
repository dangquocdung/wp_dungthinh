<?php class cordon_about_me extends WP_Widget {

	// Defines the widget name
	public function __construct() {
        $widget_ops = array(
			'classname' => 'rdn_about_me', 
			'description' => __('Display Image with title & social Icon.'),
			'panels_groups' => array('cordon_builder'),
			'panels_icon' => 'dashicons dashicons-heart'
		);
        parent::__construct('rdn_abut_me', __('About Me Element'), $widget_ops);
		
    }

	// Creates the widget in the WP admin area
	function form($instance) {

		// values
		if( $instance) {
		     $title = $instance['title'];
			 $subtitle = $instance['subtitle'];
		     $image = esc_url($instance['image']);
		     $twitter = esc_url($instance['twitter']);
		     $facebook = esc_url($instance['facebook']);
		     $google = esc_url($instance['google']);
		     $instagram = esc_url($instance['instagram']);
		     $pinterest = esc_url($instance['pinterest']);
		     $youtube = esc_url($instance['youtube']);
		} else {
			$subtitle = '';
		    $title = '';
		    $image = '';
		    $twitter = '';
		    $facebook = '';
		    $google = '';
		    $instagram = '';
		    $pinterest = '';
		    $youtube = '';
		}
		?>

		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', 'cordon_plg'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
        <p>
		<label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php esc_html_e('Subtitle (text below title):', 'cordon_plg'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo $subtitle; ?>" />
		</p>
		 <p>
              <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php esc_html_e( 'Image Background:' ); ?></label>
              <input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo esc_url( $image ); ?>" />
              <button class="upload_image_button button button-primary">Upload Image</button>
              
        </p>
		

	    

	    

		<p>
		<label for="<?php echo $this->get_field_id('social'); ?>"><?php esc_html_e('Social Media:', 'cordon_plg'); ?></label><br />
		</p>
		
		<p>
        <label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php esc_html_e('Facebook', 'cordon_plg'); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>" />
		</p>
		
		<p>
        <label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php esc_html_e('Twitter', 'cordon_plg'); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>"  />
		</p>

		<p>
        <label for="<?php echo $this->get_field_id( 'google' ); ?>"><?php esc_html_e('Google', 'cordon_plg'); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'google' ); ?>" name="<?php echo $this->get_field_name( 'google' ); ?>" type="text" value="<?php echo esc_attr( $google ); ?>" />
		</p>

		<p>
        <label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php esc_html_e('Instagram', 'cordon_plg'); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" type="text" value="<?php echo esc_attr( $instagram ); ?>" />
		</p>

		<p>
        <label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php esc_html_e('Pinterest', 'cordon_plg'); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" type="text" value="<?php echo esc_attr( $pinterest ); ?>" />
		</p>

		<p>
        <label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php esc_html_e('Youtube', 'cordon_plg'); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" type="text" value="<?php echo esc_attr( $youtube ); ?>"/>
		</p>

	<?php
	}// end admin area form

	// Widget Update
	function update($new_instance, $old_instance) {
	    $instance = $old_instance;
	    // Fields
	    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? $new_instance['title']: '';
		$instance['subtitle'] = ( ! empty( $new_instance['subtitle'] ) ) ? $new_instance['subtitle']: '';
	   	$instance['image'] = ( ! empty( $new_instance['image'] ) ) ? strip_tags( $new_instance['image'] ) : '';
	   	$instance['twitter'] = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
	   	$instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
	   	$instance['google'] = ( ! empty( $new_instance['google'] ) ) ? strip_tags( $new_instance['google'] ) : '';
	   	$instance['instagram'] = ( ! empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : '';
	   	$instance['pinterest'] = ( ! empty( $new_instance['pinterest'] ) ) ? strip_tags( $new_instance['pinterest'] ) : '';
	   	$instance['youtube'] = ( ! empty( $new_instance['youtube'] ) ) ? strip_tags( $new_instance['youtube'] ) : '';
		$instance['vimeo'] = ( ! empty( $new_instance['vimeo'] ) ) ? strip_tags( $new_instance['vimeo'] ) : '';
	    return $instance;
	}

	// Output the content on frontend
	function widget($args, $instance) {
	   extract( $args );

	   // Widget options
	   $title = $instance['title'];
	   $subtitle = $instance['subtitle'];
	   $image = $instance['image'];
	   $twitter = $instance['twitter']; 
	   $facebook = $instance['facebook']; 
	   $google = $instance['google']; 
	   $instagram = $instance['instagram']; 
	   $pinterest = $instance['pinterest']; 
	   $youtube = $instance['youtube'];
	   $vimeo = $instance['vimeo'];

	   echo $before_widget;
	   // Display the widget
?>
		     
		 
					
		 			<div class="team-list-two ani-width" data-delay="0.5s">
                    	<div class="port-inner">
                            <div class="port-box"></div>
                            <div class="port-img width-img img-bg" data-background="<?php echo esc_attr ($image); ?>"></div>
                            <div class="img-mask"></div>
                            <div class="port-dbox">
                                <div class="dbox-relative">
                                    <h3><?php echo wp_kses_post ($title); ?></h3>
                                    <p><?php echo esc_attr ($subtitle); ?></p>
                                    <ul class="team-sicon">

									   <?php
                                       // if Facebook is exist
                                       if( $facebook ) { ?>
                                         <li><a href="<?php echo $facebook; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                       <?php
                                       }
                                       
                                       // if Twitter is exist
                                       if( $twitter ) { ?>
                                         <li><a href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                       <?php
                                       }
                            
                                       
                            
                                       // if Google+ is exist
                                       if( $google ) { ?>
                                         <li><a href="<?php echo $google; ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                       <?php
                                       }
                            
                                       // if Instagram is exist
                                       if( $instagram ) { ?>
                                         <li><a href="<?php echo $instagram; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                       <?php
                                       }
                            
                                       // if pinterest is exist
                                       if( $pinterest ) { ?>
                                         <li><a href="<?php echo $pinterest; ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                                       <?php
                                       }
                            
                                       // if Youtube is exist
                                       if( $youtube ) { ?>
                                         <li><a href="<?php echo $youtube; ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
                                       <?php
                                       }
                                       // if Vimeo is exist
                                       if( $vimeo ) { ?>
                                         <li><a href="<?php echo $vimeo; ?>" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>
                                       <?php
                                       }
                                       ?>


                                    </ul><!--/.team-sicon-->
                                </div><!--/.dbox-relative-->
                            </div><!--/.port-dbox-->
                        </div><!--/.port-inner-->
                    </div><!--.port-item-->  

		

	
       
	   <?php wp_enqueue_script('imgbg-script',plugins_url( '/js/imgbg.js' , __FILE__ ) , array('jquery'), null, true );
	   echo $after_widget;
	   
	} // end frontend output
	public function media_scripts()
{
   wp_enqueue_script( 'media-upload' );
   wp_enqueue_media();
   wp_enqueue_script('our_admin',plugins_url( '/js/widget.js' , __FILE__ ) , array('jquery'));
}
}// end class

// Register widget

// register widget outsite widget page
function register_about_me() {
	global $pagenow;
	if ($pagenow != 'widgets.php') {
	register_widget( 'cordon_about_me' );
	}
}
add_action( 'widgets_init', 'register_about_me' );



