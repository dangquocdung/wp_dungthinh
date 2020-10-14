<?php


//widget

class rdn_hero_title extends WP_Widget {

// constructor
public function __construct() {
        $widget_ops = array(
			'classname' => 'rdn_hero_title_section', 
			'description' => __('Display hero with title.'),
			'panels_groups' => array('cordon_builder'),
			'panels_icon' => 'dashicons dashicons-welcome-view-site'
		);
        parent::__construct('rdn_hero_title_section', __('Hero Title Block'), $widget_ops);
		
    }

// widget form creation

function form($instance) {

// Check values
if( $instance) {
$title = $instance['title'];
$btn_text = $instance['btn_text'];
$btn_link = $instance['btn_link'];
$textarea = $instance['textarea'];
} else {
$title = '';
$textarea =  '';
$btn_text =  '';
$btn_link =  '';
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
  <label for="<?php echo $this->get_field_id('btn_text'); ?>">
    <?php esc_html_e('Button Text', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('btn_text'); ?>" name="<?php echo $this->get_field_name('btn_text'); ?>" type="text" value="<?php echo $btn_text; ?>" />
  <i>Leave it blank if you don't want it.</i>
</p>

<p>
  <label for="<?php echo $this->get_field_id('btn_link'); ?>">
    <?php esc_html_e('Button Link', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('btn_link'); ?>" name="<?php echo $this->get_field_name('btn_link'); ?>" type="text" value="<?php echo $btn_link; ?>" />
  <i>Leave it blank if you don't want it.</i>
</p>

<p>You can set the background image in row setting( Edit Row->Row Styles->Design ). </p>
<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;
// Fields
$instance['title'] = $new_instance['title'];
$instance['btn_text'] = $new_instance['btn_text'];
$instance['btn_link'] = $new_instance['btn_link'];
$instance['textarea'] = strip_tags($new_instance['textarea']);
return $instance;
}

// display widget
function widget($args, $instance) {
extract( $args );

// these are the widget options
$btn_text = isset( $instance['btn_text'] ) ?  $instance['btn_text']  : '';
$title = isset( $instance['title'] ) ?  $instance['title']  : '';
$btn_link = isset( $instance['btn_link'] ) ?  $instance['btn_link']  : '';
$textarea = isset( $instance['textarea'] ) ? esc_attr( $instance['textarea'] ) : '';


echo $before_widget;
 ?>			
 
 				<div class="hero-padding">
                	<h3 class="hero-title animated" data-animated="puffIn" data-duration="1.5s"><?php echo wp_kses_post( $title); ?></h3>
                    
                    <?php if ($btn_link != '' && $btn_text != '') { ?>
                    <a class="content-btn animated" data-animated="fadeInUp" data-delay="0.5s" href="<?php echo esc_url( $btn_link); ?>"><?php echo esc_attr( $btn_text); ?></a>
                    <div class="spacing80 clearboth"></div>
                    <?php } ?>
                </div><!--/.hero-padding-->
                
				
<?php
echo $after_widget;
}
}


// register widget outsite widget page
function register_rdn_hero_title() {
	global $pagenow;
	if ($pagenow != 'widgets.php') {
	register_widget( 'rdn_hero_title' );
	}
}
add_action( 'widgets_init', 'register_rdn_hero_title' );


