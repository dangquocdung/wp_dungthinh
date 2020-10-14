<?php

function rdn_testimonial_script() {
    if ( is_active_widget( false, false, 'rdn_testimonial', true ) ) {
        wp_enqueue_script('jquery-slick' ,plugins_url( '/js/slick.min.js' , __FILE__ ) , array('jquery'), null, true );
		wp_enqueue_script('slider-testimonial',plugins_url( '/js/testimonial.js' , __FILE__ ) , array('jquery'), null, true );		
    }
}

add_action('wp_enqueue_scripts', 'rdn_testimonial_script', 20, 1);

//widget

class rdn_testimonial_widget extends WP_Widget {

// constructor
public function __construct() {
        $widget_ops = array(
			'classname' => 'rdn_testimonial_section', 
			'description' => __('Display testimonial section.'),
			'panels_groups' => array('cordon_builder'),
			'panels_icon' => 'dashicons dashicons-format-chat'
		);
        parent::__construct('rdn_testimonial', __('Testimonial Section Block'), $widget_ops);
    }

// widget form creation

function form($instance) {

// Check values
if( $instance) {
$testi_style = $instance['testi_style'];
} else {
$testi_style = '';
}

?>
<p>
      <label for="<?php echo $this->get_field_id('testi_style'); ?>">Testimonial Style: 
        <select class='widefat' id="<?php echo $this->get_field_id('testi_style'); ?>"
                name="<?php echo $this->get_field_name('testi_style'); ?>">
          
          <option value='black'<?php echo ($testi_style=='black')?'selected':''; ?>>
            Black Text (default)
          </option> 
          <option value='white'<?php echo ($testi_style=='white')?'selected':''; ?>>
            White Text
          </option> 
          
        </select>                
      </label>
</p>


<h3>Please note</h3>
<p>This block will show the Testimonial. <br />You can create the Testimonial in left menu->Testimonial->Add New Testimonial.</p>
<p>You can set the background image & parallax effect in row settings. ( Edit Row->Row Styles->Design ).</p>

<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;
// Fields
$instance['testi_style'] = $new_instance['testi_style'];
return $instance;
}

// display widget
function widget($args, $instance) {
extract( $args );

// these are the widget options
$testi_style = isset( $instance['testi_style'] ) ?$instance['testi_style']: '';

echo $before_widget; ?>
	<?php $ridianur_about = new WP_Query(array(  
            'post_type' =>  'testimonial',  
            'posts_per_page'  =>'-1'  
        )  
    ); 
    
    if ($ridianur_about->have_posts()) { ?>

		<div class="clearfix <?php if ($testi_style =='white'){ echo 'with-bg';}?>">
            <div id="testimonial" class="testi-slider">
                <?php  
                 
                if ($ridianur_about->have_posts()) : while  ($ridianur_about->have_posts()) : $ridianur_about->the_post();
                global $post ;
                ?>
                <div>
                    <p>
                    <?php echo get_the_content(); ?>
                    </p>
                    <i class="fa fa-quote-left"></i>
                    <h3><?php the_title(); ?></h3>
                    <p class="testi-from"><?php echo esc_attr( apply_filters('get_the_content', get_post_meta($post->ID, 'testi_post', true))); ?></p>
                </div>
                
                <?php endwhile; endif; wp_reset_postdata();?>
            </div><!--/.testimonial-->
		</div>
      <!--BANNER END-->
	<?php } else { ?>
    <div class="spacing80 clearboth"></div>
    <div class="container alert alert-danger">
        <p><?php echo esc_html( 'No Testimonial here!
        You need to create Testimonial first and display it in Testimonial Section Block settings.','cordon_plg' ); ?></p>
    </div>
    <div class="spacing80 clearboth"></div>
    <?php } ?>                  
<?php 
echo $after_widget;
}
}

// register widget outsite widget page
function register_rdn_testimonial_widget() {
	global $pagenow;
	if ($pagenow != 'widgets.php') {
	register_widget( 'rdn_testimonial_widget' );
	}
}
add_action( 'widgets_init', 'register_rdn_testimonial_widget' );
