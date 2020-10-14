<?php
//widget

class rdn_block_quote_widget extends WP_Widget {

// constructor
public function __construct() {
        $widget_ops = array(
			'classname' => 'rdn_blockquote_element', 
			'description' => __('Display blockquote text.'),
			'panels_groups' => array('cordon_builder'),
			'panels_icon' => 'dashicons dashicons-format-quote'
		);
        parent::__construct('rdn_blockquote_element', __('Blockquote Element'), $widget_ops);
    }

// widget form creation

function form($instance) {

// Check values
if( $instance) {
$title = $instance['title'];
} else {
$title = '';
}

?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php esc_html_e('Blockquote Text', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>



<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;
// Fields
$instance['title'] =$new_instance['title'];
return $instance;
}

// display widget
function widget($args, $instance) {
extract( $args );

// these are the widget options
$title = isset( $instance['title'] ) ?  $instance['title'] : '';

echo $before_widget; ?>

		<blockquote><?php echo wp_kses_post( $title); ?></blockquote>
                    
<?php 
echo $after_widget;
}
}
// register widget outsite widget page
function register_rdn_blockquote_element() {
	global $pagenow;
	if ($pagenow != 'widgets.php') {
	register_widget( 'rdn_block_quote_widget' );
	}
}
add_action( 'widgets_init', 'register_rdn_blockquote_element' );



