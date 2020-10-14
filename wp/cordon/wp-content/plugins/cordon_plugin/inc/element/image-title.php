<?php


//widget

class rdn_box_title_image extends WP_Widget {

// constructor
public function __construct() {
        $widget_ops = array(
			'classname' => 'rdn_box_title_image_section', 
			'description' => __('Display boxed link image with title and subtitle in it.'),
			'panels_groups' => array('cordon_builder'),
			'panels_icon' => 'dashicons dashicons-format-image'
		);
        parent::__construct('rdn_box_title_image_section', __('Boxed Link Image with Title Element'), $widget_ops);
		
		// Add Widget scripts
  		 add_action('admin_enqueue_scripts', array($this, 'media_scripts'));
    }

// widget form creation

function form($instance) {

// Check values
if( $instance) {
$title = $instance['title'];
$top_text = $instance['top_text'];
$image = $instance['image'];
$btn_link1 = $instance['btn_link1'];
$new_tab = $instance['new_tab'];
} else {
$title = '';
$new_tab = '';
$top_text = '';
$image = '';
$btn_link1 =  '';
}

?>
	
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php esc_html_e('Title', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
  <label for="<?php echo $this->get_field_id('top_text'); ?>">
    <?php esc_html_e('Insert your bottom text here', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('top_text'); ?>" name="<?php echo $this->get_field_name('top_text'); ?>" type="text" value="<?php echo $top_text ?>">
</p>
<p>
  <label for="<?php echo $this->get_field_id('btn_link1'); ?>">
    <?php esc_html_e('Insert your link here', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('btn_link1'); ?>" name="<?php echo $this->get_field_name('btn_link1'); ?>" type="text" value="<?php echo $btn_link1 ?>">
</p>

   <p>
      <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php esc_html_e( 'Image Background:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo esc_url( $image ); ?>" />
      <button class="upload_image_button button button-primary">Upload Image</button>
      
   </p>

<p>
      <label for="<?php echo $this->get_field_id('new_tab'); ?>">Open Link in New Tab: 
        <select class='widefat' id="<?php echo $this->get_field_id('new_tab'); ?>"
                name="<?php echo $this->get_field_name('new_tab'); ?>">
          
          <option value='yes'<?php echo ($new_tab=='yes')?'selected':''; ?>>
            Yes (Default)
          </option> 
          <option value='no'<?php echo ($new_tab=='no')?'selected':''; ?>>
           No
          </option> 
          
        </select>                
      </label>
</p>
   

<?php
}
public function media_scripts()
{
   wp_enqueue_script( 'media-upload' );
   wp_enqueue_media();
   wp_enqueue_script('our_admin',plugins_url( '/js/widget.js' , __FILE__ ) , array('jquery'));
}

function update($new_instance, $old_instance) {
$instance = $old_instance;
// Fields
$instance['title'] = $new_instance['title'];
$instance['new_tab'] = $new_instance['new_tab'];
$instance['top_text'] = $new_instance['top_text'];
$instance['image'] = $new_instance['image'];
$instance['btn_link1'] = strip_tags($new_instance['btn_link1']);
return $instance;
}

// display widget
function widget($args, $instance) {
extract( $args );

// these are the widget options
$title = isset( $instance['title'] ) ?  $instance['title']  : '';
$new_tab = isset( $instance['new_tab'] ) ?  $instance['new_tab']  : '';
$top_text = isset( $instance['top_text'] ) ? $instance['top_text']  : '';
$image = isset( $instance['image'] ) ? $instance['image']  : '';
$btn_link1 = isset( $instance['btn_link1'] ) ? esc_attr( $instance['btn_link1'] ) : '';

echo $before_widget;
 ?>
 
 					<div class="ani-width">
                    	<div class="port-inner  box-bg">
                            <a href="<?php echo esc_url( $btn_link1); ?>" class="port-link" <?php if ($new_tab != 'no') {echo 'target="_blank"'; } ?>></a>
                            <div class="port-box"></div>
                            <div class="port-img width-img img-bg" data-background="<?php echo esc_url( $image); ?>"></div>
                            <div class="img-mask"></div>
                            <div class="port-dbox">
                            	<div class="dbox-relative">
                                    <h3><?php echo wp_kses_post( $title); ?></h3>
                                    <p><?php echo esc_attr( $top_text); ?></p>
                                </div><!--/.dbox-relative-->
                            </div><!--/.port-dbox-->
                            
                        </div><!--/.port-inner-->
                        
                    </div>
   
 					
<?php
wp_enqueue_script('imgbg-script',plugins_url( '/js/imgbg.js' , __FILE__ ) , array('jquery'), null, true );
echo $after_widget;
}
}


// register widget outsite widget page
function register_rdn_box_title_image() {
	global $pagenow;
	if ($pagenow != 'widgets.php') {
	register_widget( 'rdn_box_title_image' );
	}
}
add_action( 'widgets_init', 'register_rdn_box_title_image' );


