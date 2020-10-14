<?php
//widget

class rdn_text_icon_widget extends WP_Widget {

// constructor
public function __construct() {
        $widget_ops = array(
			'classname' => 'rdn_text_icon', 
			'description' => __('Display title with icon & content.'),
			'panels_groups' => array('cordon_builder'),
			'panels_icon' => 'dashicons dashicons-art'
		);
        parent::__construct('rdn_text_icon', __('Title with Icon Element'), $widget_ops);
    }

// widget form creation

function form($instance) {

// Check values
if( $instance) {
$title = $instance['title'];
$t_style = $instance['t_style'];
$button_link = $instance['button_link'];
$button_text = $instance['button_text'];
$sub_title = $instance['sub_title'];
$t_icon = $instance['t_icon'];
$text = $instance['text'];
} else {
$title = '';
$sub_title = '';
$t_icon = '';
$text = '';
$t_style = '';
$button_link = '';
$button_text = '';
}

?>

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
  <i>Leave it blank if you don't need it</i>.
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
  <i>Leave it blank if you don't need it</i>.
</p>
<p>
  <label for="<?php echo $this->get_field_id('button_text'); ?>">
    <?php esc_html_e('Button Text', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo $button_text; ?>" />
  <i>Leave it blank if you don't need it</i>.
</p>
<p>
  <label for="<?php echo $this->get_field_id('button_link'); ?>">
    <?php esc_html_e('Button Link', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('button_link'); ?>" name="<?php echo $this->get_field_name('button_link'); ?>" type="text" value="<?php echo $button_link; ?>" />
  <i>Leave it blank if you don't need it</i>.
</p>
<p>
      <label for="title_style">Title Icon Style: 
        <select class='widefat' id="title_style"
                name="<?php echo $this->get_field_name('t_style'); ?>" type="text">
          <option value='left'<?php echo ($t_style=='left')?'selected':''; ?>>
            Left Align(Default)
          </option>
          <option value='center'<?php echo ($t_style=='center')?'selected':''; ?>>
            Center Align
          </option> 
        </select>                
      </label>
	</p>

<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;
// Fields
$instance['title'] =$new_instance['title'];
$instance['t_style'] =$new_instance['t_style'];
$instance['button_link'] =$new_instance['button_link'];
$instance['button_text'] =$new_instance['button_text'];
$instance['sub_title'] = strip_tags($new_instance['sub_title']);
$instance['t_icon'] = strip_tags($new_instance['t_icon']);
$instance['text'] = $new_instance['text'];
return $instance;
}

// display widget
function widget($args, $instance) {
extract( $args );

// these are the widget options
$button_link = isset( $instance['button_link'] ) ?  $instance['button_link'] : '';
$t_style = isset( $instance['t_style'] ) ?  $instance['t_style'] : '';
$title = isset( $instance['title'] ) ?  $instance['title'] : '';
$button_text = isset( $instance['button_text'] ) ?  $instance['button_text'] : '';
$sub_title = isset( $instance['sub_title'] ) ? esc_attr( $instance['sub_title'] ) : '';
$t_icon = isset( $instance['t_icon'] ) ? esc_attr( $instance['t_icon'] ) : '';
$text = isset( $instance['text'] ) ?  $instance['text']  : '';

echo $before_widget; ?>
						<?php if ( $t_style == 'center') { ?>
                        <div class="box-small-icon">
                        	<i class="fa <?php echo esc_attr( $t_icon); ?>"></i>
                            <h3><?php echo wp_kses_post( $title); ?></h3>
                            
                            <?php if ( $sub_title != '' ) { ?>
                            <p class="box-sub-title"><?php echo esc_attr( $sub_title); ?></p>
                            <?php } ?>
                            <?php echo wpautop( $text); ?>
                            
                            <div class="spacing40 clearboth"></div>
                            
                            <?php if ( $button_text != '' && $button_link != '' ) { ?>
                            	<a class="content-btn" href="<?php echo esc_url( $button_link); ?>"><?php echo esc_attr( $button_text); ?></a>  
                            <?php } ?>
                            
                        </div><!--/.box-small-icon-->
                        <?php } else { ?>
						<div class="box-with-icon">
                        	<i class="fa <?php echo esc_attr( $t_icon); ?>"></i>
                            <h3><?php echo wp_kses_post( $title); ?></h3>
                            <p class="box-sub-title"><?php echo esc_attr( $sub_title); ?></p>
                            
                            <?php echo wpautop( $text); ?>
                            
                            <div class="spacing40 clearboth"></div>
                            
                            <?php if ( $button_text != '' && $button_link != '' ) { ?>
                            	<a class="content-btn" href="<?php echo esc_url( $button_link); ?>"><?php echo esc_attr( $button_text); ?></a>   
                            <?php } ?>
                        </div><!--/.box-with-icon-->
                        
                        <?php } ?>
                      
<?php 
echo $after_widget;
}
}
// register widget outsite widget page
function register_text_icon() {
	global $pagenow;
	if ($pagenow != 'widgets.php') {
	register_widget( 'rdn_text_icon_widget' );
	}
}
add_action( 'widgets_init', 'register_text_icon' );



