<?php
//widget

class rdn_contact_text_widget extends WP_Widget {

// constructor
public function __construct() {
        $widget_ops = array(
			'classname' => 'rdn_contact_section', 
			'description' => __('Display contact detail text.'),
			'panels_groups' => array('cordon_builder'),
			'panels_icon' => 'dashicons dashicons-pressthis'
		);
        parent::__construct('rdn_contact_section', __('Contact Text Element'), $widget_ops);
    }

// widget form creation

function form($instance) {

// Check values
if( $instance) {
$title = $instance['title'];
$text = esc_attr($instance['text']);
$address = $instance['address'];
$phone = $instance['phone'];
$email = $instance['email'];
} else {
$title = '';
$text = '';
$address = '';
$phone = '';
$email = '';
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


<p>
  <label for="<?php echo $this->get_field_id('address'); ?>">
    <?php esc_html_e('Insert your addres here (leave it blank if you don\'t want it)', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo $address ?>">
</p>
<p>
  <label for="<?php echo $this->get_field_id('phone'); ?>">
    <?php esc_html_e('Insert your phone here (leave it blank if you don\'t want it)', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone ?>">
</p>
<p>
  <label for="<?php echo $this->get_field_id('email'); ?>">
    <?php esc_html_e('Insert your email here (leave it blank if you don\'t want it)', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email ?>">
</p>
<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;
// Fields
$instance['title'] = $new_instance['title'];
$instance['text'] = strip_tags($new_instance['text']);
$instance['address'] = $new_instance['address'];
$instance['phone'] = $new_instance['phone'];
$instance['email'] = strip_tags($new_instance['email']);
return $instance;
}

// display widget
function widget($args, $instance) {
extract( $args );

// these are the widget options
$title = isset( $instance['title'] ) ?  $instance['title']  : '';
$text = isset( $instance['text'] ) ? esc_attr( $instance['text'] ) : '';
$address = isset( $instance['address'] ) ? $instance['address']  : '';
$phone = isset( $instance['phone'] ) ? $instance['phone']  : '';
$email = isset( $instance['email'] ) ? $instance['email'] : '';

?>


        
        	<div class="table-cell-box  contact-text table-content">
            	<h3><?php echo wp_kses_post( $title); ?></h3>
                <div class="cell-line"></div>
                <p><?php echo wp_kses_post($text); ?> </p>
                
                <ul class="contact-list">
					<?php if ($address != ''){ ?>
                    <li>
                        <i class="boxs-icon fa fa-building-o"></i> 
                        <?php echo wp_kses_post( $address); ?>
                    </li>
                    <?php } ?>
                    
                    <?php if ($phone != ''){ ?>
                    <li>
                        <i class="boxs-icon fa fa-tty"></i> 
                        <?php echo wp_kses_post( $phone); ?>
                    </li>
                    <?php } ?>
                    <?php if ($email != ''){ ?>
                    <li>
                        <i class="boxs-icon fa fa-envelope-o"></i> 
                        <a href="mailto:<?php echo esc_attr( $email); ?>"><?php echo esc_attr( $email); ?></a>
                    </li>
                    <?php } ?>
                </ul><!--/ctc-list-->
                            
                <div class="spacing40 clearboth"></div>
            </div><!--/.table-cell-box--> 
            

						
                
                            
		
<?php 

}
}

// register widget outsite widget page
function register_rdn_contact_text_widget() {
	global $pagenow;
	if ($pagenow != 'widgets.php') {
	register_widget( 'rdn_contact_text_widget' );
	}
}
add_action( 'widgets_init', 'register_rdn_contact_text_widget' );


