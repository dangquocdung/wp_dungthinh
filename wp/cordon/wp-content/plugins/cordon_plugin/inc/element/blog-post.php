<?php
//widget



class rdn_blog_post_widget extends WP_Widget {

// constructor
public function __construct() {
        $widget_ops = array(
			'classname' => 'rdn_post_section', 
			'description' => __('Display blog post section.'),
			'panels_groups' => array('cordon_builder'),
			'panels_icon' => 'dashicons dashicons-admin-page'
		);
        parent::__construct('rdn_post_section', __('Blog Post Block'), $widget_ops);
    }

// widget form creation

function form($instance) {

// Check values
if( $instance) {
$b_show = $instance['b_show'];
$title = $instance['title'];
$p_col = $instance['p_col'];
} else {
$b_show = '';
$p_col = '';
$title = '';
}

?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e('Title:', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title ?>">
  <i>Leave it blank if you don't need it</i>.
</p>
<p>
  <label for="<?php echo $this->get_field_id('b_show'); ?>">
    <?php esc_html_e('Blog Posts to Show:', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('b_show'); ?>" name="<?php echo $this->get_field_name('b_show'); ?>" type="text" value="<?php echo $b_show ?>">
  <br/>Insert how many posts to show. default is 4.
</p>
<p>
      <label for="<?php echo $this->get_field_id('p_col'); ?>">Choose How Many Columns to display the Blog post: 
        <select class='widefat' id="<?php echo $this->get_field_id('p_col'); ?>"
                name="<?php echo $this->get_field_name('p_col'); ?>" type="text">
          <option value='3col'<?php echo ($p_col=='3col' )?'selected':''; ?>>
            3 Columns
          </option>
          <option value='4col'<?php echo ($p_col=='4col' ||$p_col=='')?'selected':''; ?>>
            4 Columns (Default)
          </option> 
        </select>                
      </label>
</p>
<h3>Please note</h3>
<p>This block will show the blog post section. <br />
You can create the Blog Post in left menu->Posts->Add New Posts. <br /> Make sure to use featured image in the same width/height/ratio for each blog post.</p>
<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;
// Fields
$instance['title'] = strip_tags($new_instance['title']);
$instance['p_col'] = strip_tags($new_instance['p_col']);
$instance['b_show'] = strip_tags($new_instance['b_show']);
return $instance;
}

// display widget
function widget($args, $instance) {
extract( $args );

// these are the widget options
$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
$p_col = isset( $instance['p_col'] ) ? esc_attr( $instance['p_col'] ) : '';
$b_show = isset( $instance['b_show'] ) ? esc_attr( $instance['b_show'] ) : '';

echo $before_widget; ?>
		<?php 
				if ($b_show != ''){ 
					$args=array(
						'post_type' => 'post',
						'posts_per_page' => $b_show
					);
				} else {
					$args=array(
						'post_type' => 'post',
						'posts_per_page' => 4,
					);
				} 
                            
                $ridianur_post = new WP_Query($args);
				if ($ridianur_post->have_posts()) { 
                 ?>
                
                <?php if ($title != '') { ?>
                <h3 class="small-title"><?php echo wp_kses_post ( $title ); ?></h3>
                <?php } ?>
                
                <div class="row blog-post-list ">
                	<?php while  ($ridianur_post->have_posts()) : $ridianur_post->the_post();
                	global $post ; ?>
                	<div class="<?php if  ($p_col == '3col') {echo "col-md-4"; } else  {echo "col-md-3"; } ?>">
                    	<?php the_post_thumbnail(); ?>
                    	<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
                        
                        <p>
							<?php $excerpt = get_the_excerpt();
							$excerpt = substr( $excerpt , 0,150); 
							echo $excerpt;  ?>...
                        </p>
                        <div class="spacing20 clearboth"></div>
                    </div>
                     <?php endwhile;?>
                </div>
               
        
				<?php } else { ?>
                <div class="spacing80 clearboth"></div>
                <div class="container alert alert-danger">
                    <p><?php echo esc_html( 'No posts  here!
                    You need to create post first.','cordon_plg' ); ?></p>
                </div>
                <div class="spacing80 clearboth"></div>
                <?php  } wp_reset_postdata(); ?>
       
                            
		
<?php 
echo $after_widget;
}
}

// register widget outsite widget page
function register_rdn_blog_post_widget() {
	global $pagenow;
	if ($pagenow != 'widgets.php') {
	register_widget( 'rdn_blog_post_widget' );
	}
}
add_action( 'widgets_init', 'register_rdn_blog_post_widget' );



