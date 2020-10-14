<?php
//widget

class rdn_title_block_widget extends WP_Widget {

// constructor
public function __construct() {
        $widget_ops = array(
			'classname' => 'rdn_title_block_box', 
			'description' => __('Create centered title with subtitle.'),
			'panels_groups' => array('cordon_builder'),
			'panels_icon' => 'dashicons dashicons-edit'
		);
        parent::__construct('title_block', __('Centered Title Element'), $widget_ops);
    }

// widget form creation

function form($instance) {

// Check values
if( $instance) {
$title = $instance['title'];
$text = esc_attr($instance['text']);

} else {
$title = '';
$text = '';

}

?>

<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php esc_html_e('Title', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
  <label for="<?php echo $this->get_field_id('text'); ?>">
    <?php esc_html_e('Small/Below The Title Text:', 'cordon_plg'); ?>
  </label>
  <textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" rows="4"><?php echo $text ?></textarea>
</p>



<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;
// Fields
$instance['title'] = $new_instance['title'];
$instance['text'] = strip_tags($new_instance['text']);
return $instance;
}

// display widget
function widget($args, $instance) {
extract( $args );

// these are the widget options
$title = isset( $instance['title'] ) ? $instance['title']  : '';
$text = isset( $instance['text'] ) ? esc_attr( $instance['text'] ) : '';

echo $before_widget; ?>

						<?php if ($title !='' || $text!='' ) {?>
                        <div class="content-box-title">
                            <div class="slider-hidden">
                                <h2 class="content-title animated" data-animated="fadeInUp"><?php echo wp_kses_post( $title); ?></h2>
                            </div><!--slider-hidden-->
                            
                            <div class="content-line animated" data-animated="swashIn" data-delay="0.2s"></div>
                            
                            <p class="animated" data-animated="fadeInDown" data-delay="0.4s">
                            <?php echo wp_kses_post($text); ?></p>
                        </div><!--/content-box-title-->
                        <?php } ?>
                       
<?php 
echo $after_widget;
}
}


// register widget outsite widget page
function register_rdn_title_block_widget() {
	global $pagenow;
	if ($pagenow != 'widgets.php') {
	register_widget( 'rdn_title_block_widget' );
	}
}
add_action( 'widgets_init', 'register_rdn_title_block_widget' );