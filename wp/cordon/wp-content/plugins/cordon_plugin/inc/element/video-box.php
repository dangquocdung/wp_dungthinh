<?php
//widget

class rdn_video_box_widget extends WP_Widget {

// constructor
public function __construct() {
        $widget_ops = array(
			'classname' => 'rdn_video_box', 
			'description' => __('Display video with title & content.'),
			'panels_groups' => array('cordon_builder'),
			'panels_icon' => 'dashicons dashicons-format-video'
		);
        parent::__construct('rdn_video_box', __('Video With Title & Icon Element'), $widget_ops);
    }

// widget form creation

function form($instance) {

// Check values
if( $instance) {
$iframe = $instance['iframe'];
$title = $instance['title'];
$sub_title = $instance['sub_title'];
$t_icon = $instance['t_icon'];
$text = $instance['text'];
} else {
$iframe = '';
$title = '';
$sub_title = '';
$t_icon = '';
$text = '';
}

?>
<p>
  <label for="<?php echo $this->get_field_id('iframe'); ?>">
    <?php esc_html_e('Embed Iframe Code for video/media', 'cordon_plg'); ?>
  </label>
  <textarea class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('iframe'); ?>" 
  type="textarea" rows="3" ><?php if (!empty($iframe)) echo $iframe; ?></textarea>
</p>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php esc_html_e('Title', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('sub_title'); ?>">
    <?php esc_html_e('Sub Title', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('sub_title'); ?>" name="<?php echo $this->get_field_name('sub_title'); ?>" type="text" value="<?php echo $sub_title; ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('t_icon'); ?>">
    <?php esc_html_e('Title Icon', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('t_icon'); ?>" name="<?php echo $this->get_field_name('t_icon'); ?>" type="text" value="<?php echo $t_icon; ?>" />
  <br />You can check this <a href="http://fontawesome.io/icons/" target="_blank">link</a> for icon list. eg. fa-github
</p>
<p>
  <label for="<?php echo $this->get_field_id('text'); ?>">
    <?php esc_html_e('The Text:', 'cordon_plg'); ?>
  </label>
  <textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" 
  type="textarea" rows="6"><?php if (!empty($text)) echo $text; ?></textarea>
</p>



<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;
// Fields
$instance['iframe'] = $new_instance['iframe'];
$instance['title'] =$new_instance['title'];
$instance['sub_title'] = strip_tags($new_instance['sub_title']);
$instance['t_icon'] = strip_tags($new_instance['t_icon']);
$instance['text'] = $new_instance['text'];
return $instance;
}

// display widget
function widget($args, $instance) {
extract( $args );

// these are the widget options
$iframe = isset( $instance['iframe'] ) ? $instance['iframe']  : '';
$title = isset( $instance['title'] ) ?  $instance['title'] : '';
$sub_title = isset( $instance['sub_title'] ) ? esc_attr( $instance['sub_title'] ) : '';
$t_icon = isset( $instance['t_icon'] ) ? esc_attr( $instance['t_icon'] ) : '';
$text = isset( $instance['text'] ) ?  $instance['text']  : '';

echo $before_widget; ?>


            			<?php echo wp_kses( $iframe, array( 
							'iframe' => array(
									'src' => array(),
									'width' => array(),
									'height' => array(),
									'scrolling' => array(),
									'frameborder' => array(),
								),
						) ); ?>
                        <?php if ($title != '' || $sub_title != '' || $t_icon != '') { ?>
                        <h3 class="small-title"><?php echo wp_kses_post( $title); ?> <i class="fa <?php echo esc_attr( $t_icon); ?>"></i></h3>
                        <p class="small-sub"><?php echo esc_attr( $sub_title); ?></p>
                        <?php }  else { echo'<div class="spacing20 clearfix"></div>';}?>
                        <?php echo wpautop( $text); ?>
                        <div class="spacing20 clearfix"></div>
<?php 
echo $after_widget;
}
}
// register widget outsite widget page
function register_rdn_video_box() {
	global $pagenow;
	if ($pagenow != 'widgets.php') {
	register_widget( 'rdn_video_box_widget' );
	}
}
add_action( 'widgets_init', 'register_rdn_video_box' );



