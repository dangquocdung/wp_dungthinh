<?php
//widget

class rdn_title_line_widget extends WP_Widget {

// constructor
public function __construct() {
        $widget_ops = array(
			'classname' => 'rdn_title_line', 
			'description' => __('Display title & text left-aligned.'),
			'panels_groups' => array('cordon_builder'),
			'panels_icon' => 'dashicons dashicons-welcome-write-blog'
		);
        parent::__construct('rdn_title_line', __('Left-Aligned Title Element'), $widget_ops);
    }

// widget form creation

function form($instance) {

// Check values
if( $instance) {
$title = $instance['title'];
$sub_title = $instance['sub_title'];
} else {
$title = '';
$sub_title = '';
}

?>

<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php esc_html_e('Title', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
  You can use &lt;span&gt;&lt;/span&gt; tag to give the title the theme style color.
</p>
<p>
  <label for="<?php echo $this->get_field_id('sub_title'); ?>">
    <?php esc_html_e('Text', 'cordon_plg'); ?>
  </label>
  <textarea class="widefat" id="<?php echo $this->get_field_id('sub_title'); ?>" name="<?php echo $this->get_field_name('sub_title'); ?>" row="6" ><?php echo $sub_title; ?></textarea>
</p>
 
<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;
// Fields
$instance['title'] =$new_instance['title'];
$instance['sub_title'] = strip_tags($new_instance['sub_title']);
return $instance;
}

// display widget
function widget($args, $instance) {
extract( $args );

// these are the widget options
$title = isset( $instance['title'] ) ?  $instance['title'] : '';
$sub_title = isset( $instance['sub_title'] ) ? esc_attr( $instance['sub_title'] ) : '';

echo $before_widget; ?>

				<div class="left-title-block clearfix">
                	<h3 class="content-title animated" data-animated="fadeInUp"><?php echo wp_kses_post( $title); ?></h3>
                    <?php echo wpautop( $sub_title); ?>
                    <div class="spacing40 clearboth"></div>
                </div>                  
<?php 
echo $after_widget;
}
}
// register widget outsite widget page
function register_text_line() {
	global $pagenow;
	if ($pagenow != 'widgets.php') {
	register_widget( 'rdn_title_line_widget' );
	}
}
add_action( 'widgets_init', 'register_text_line' );



