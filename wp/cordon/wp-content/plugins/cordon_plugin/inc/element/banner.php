<?php


//widget

class rdn_banner_title extends WP_Widget {

// constructor
public function __construct() {
        $widget_ops = array(
			'classname' => 'rdn_banner_title_section', 
			'description' => __('Display banner with title & button.'),
			'panels_groups' => array('cordon_builder'),
			'panels_icon' => 'dashicons dashicons-awards'
		);
        parent::__construct('rdn_banner_title_section', __('Banner Element'), $widget_ops);
		
    }

// widget form creation

function form($instance) {

// Check values
if( $instance) {
$title = $instance['title'];
$textarea = $instance['textarea'];
$btn_text1 = $instance['btn_text1'];
$btn_link1 = $instance['btn_link1'];
} else {
$title = '';
$textarea =  '';
$btn_text1 =  '';
$btn_link1 =  '';
}

?>
	
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php esc_html_e('Banner Title', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
  You can use &lt;span&gt;&lt;/span&gt; tag to give the title the theme style color.
</p>


<p>
  <label for="<?php echo $this->get_field_id('textarea'); ?>">
    <?php esc_html_e('Insert your bottom text here', 'cordon_plg'); ?>
  </label>
  <textarea class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>" type="text" rows="5"><?php echo $textarea ?></textarea>
  <i>Leave it blank if you don't need it</i>.
</p>
<p>
  <label for="<?php echo $this->get_field_id('btn_text1'); ?>">
    <?php esc_html_e('Insert your button text here', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('btn_text1'); ?>" name="<?php echo $this->get_field_name('btn_text1'); ?>" type="text" value="<?php echo $btn_text1 ?>">
  <i>Leave it blank if you don't need it</i>.
</p>
<p>
  <label for="<?php echo $this->get_field_id('btn_link1'); ?>">
    <?php esc_html_e('Insert your button link here', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('btn_link1'); ?>" name="<?php echo $this->get_field_name('btn_link1'); ?>" type="text" value="<?php echo $btn_link1 ?>">
  <i>Leave it blank if you don't need it</i>.
</p>


  

<?php
}


function update($new_instance, $old_instance) {
$instance = $old_instance;
// Fields
$instance['title'] = $new_instance['title'];
$instance['textarea'] = strip_tags($new_instance['textarea']);
$instance['btn_link1'] = strip_tags($new_instance['btn_link1']);
$instance['btn_text1'] = strip_tags($new_instance['btn_text1']);
return $instance;
}

// display widget
function widget($args, $instance) {
extract( $args );

// these are the widget options
$title = isset( $instance['title'] ) ?  $instance['title']  : '';
$textarea = isset( $instance['textarea'] ) ? esc_attr( $instance['textarea'] ) : '';
$btn_link1 = isset( $instance['btn_link1'] ) ? esc_attr( $instance['btn_link1'] ) : '';
$btn_text1 = isset( $instance['btn_text1'] ) ? esc_attr( $instance['btn_text1'] ) : '';

echo $before_widget;
 ?>
 			<div class="table-content">
            	<h3><?php echo wp_kses_post( $title); ?></h3>
                
                <?php if ($textarea != ''){ ?>
                <div class="cell-line"></div>
                <p><?php echo wp_kses_post( $textarea); ?></p>
                <?php } ?>
                
                <?php if ($btn_text1 != '' && $btn_link1 != ''){ ?>
                <div class="spacing40 clearboth"></div>
                <a class="content-btn" href="<?php echo esc_attr ($btn_link1); ?>"><?php echo esc_attr ($btn_text1); ?></a>
                <?php } ?>
            </div><!--/.table-cell-box-->   
       
            
<?php 
echo $after_widget;
}
}


// register widget outsite widget page
function register_rdn_banner_title() {
	global $pagenow;
	if ($pagenow != 'widgets.php') {
	register_widget( 'rdn_banner_title' );
	}
}
add_action( 'widgets_init', 'register_rdn_banner_title' );


