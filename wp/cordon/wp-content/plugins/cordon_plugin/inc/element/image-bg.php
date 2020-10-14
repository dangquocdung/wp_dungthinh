<?php


//widget

class rdn_image_swipe_widget extends WP_Widget {

// constructor
public function __construct() {
        $widget_ops = array(
			'classname' => 'rdn_image_swipe_widget', 
			'description' => __('Display image for banner side content.'),
			'panels_groups' => array('cordon_builder'),
			'panels_icon' => 'dashicons dashicons-format-gallery'
		);
        parent::__construct('rdn_image_swipe_widget', __('Image for Banner Element'), $widget_ops);
		
		// Add Widget scripts
  		 add_action('admin_enqueue_scripts', array($this, 'media_scripts'));
    }

// widget form creation

function form($instance) {

// Check values
if( $instance) {
$b_border = $instance['b_border'];
$image = $instance['image'];
} else {
$b_border = '';
$image = '';
}

?>
	

   <p>
      <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php esc_html_e( 'Image Background:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo esc_url( $image ); ?>" />
      <button class="upload_image_button button button-primary">Upload Image</button>
      
   </p>
  <p>
<label for="b_border">Border: 
        <select class='widefat' id="b_border"
                name="<?php echo $this->get_field_name('b_border'); ?>" >
          <option value='no'<?php echo ($b_border=='no')?'selected':''; ?>>
            No border(Default)
          </option>
          <option value='left'<?php echo ($b_border=='left')?'selected':''; ?>>
            Left Border
          </option> 
          <option value='right'<?php echo ($b_border=='right')?'selected':''; ?>>
           Right Border
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
$instance['b_border'] = $new_instance['b_border'];
$instance['image'] = $new_instance['image'];
return $instance;
}

// display widget
function widget($args, $instance) {
extract( $args );

// these are the widget options
$b_border = isset( $instance['b_border'] ) ?  $instance['b_border']  : '';
$image = isset( $instance['image'] ) ? $instance['image']  : '';

echo $before_widget;
 ?>					
 			<div class="table-cell-box <?php if ($b_border == 'left') { echo'cell-left-border'; } else if ($b_border == 'right') { echo'cell-right-border'; }?>">
                <div class="img-bg full-img-bg" data-background="<?php echo esc_url( $image); ?>"></div>
                <div class="cell-box-padding"></div>
            </div><!--/.table-cell-box-->

		
<?php
wp_enqueue_script('imgbg-script',plugins_url( '/js/imgbg.js' , __FILE__ ) , array('jquery'), null, true );
echo $after_widget;
}
}


// register widget outsite widget page
function rdn_image_swipe_widget() {
	global $pagenow;
	if ($pagenow != 'widgets.php') {
	register_widget( 'rdn_image_swipe_widget' );
	}
}
add_action( 'widgets_init', 'rdn_image_swipe_widget' );


