<?php
//widget

class rdn_team_list_widget extends WP_Widget {

// constructor
public function __construct() {
        $widget_ops = array(
			'classname' => 'rdn_team_list', 
			'description' => __('Display team posts.'),
			'panels_groups' => array('cordon_builder'),
			'panels_icon' => 'dashicons dashicons-businessman'
		);
        parent::__construct('rdn_team_list', __('Team List Block'), $widget_ops);
    }

// widget form creation

function form($instance) {

// Check values
if( $instance) {
$team_col = $instance['team_col'];
$team_style = $instance['team_style'];
$title = $instance['title'];
$text = esc_attr($instance['text']);
} else {
$team_col = '';
$title = '';
$text = '';
$team_style = '';
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
      <label for="<?php echo $this->get_field_id('team_col'); ?>">Team Column: 
        <select class='widefat' id="<?php echo $this->get_field_id('team_col'); ?>"
                name="<?php echo $this->get_field_name('team_col'); ?>">
          
          <option value='4 Columns'<?php echo ($team_col=='4 Columns')?'selected':''; ?>>
            4 Columns (Default)
          </option> 
          <option value='3 Columns'<?php echo ($team_col=='3 Columns')?'selected':''; ?>>
            3 Columns
          </option> 
          <option value='2 Columns'<?php echo ($team_col=='2 Columns')?'selected':''; ?>>
            2 Columns
          </option>
          
        </select>                
      </label>
</p>
<p>
      <label for="<?php echo $this->get_field_id('team_style'); ?>">Team Style: 
        <select class='widefat' id="<?php echo $this->get_field_id('team_style'); ?>"
                name="<?php echo $this->get_field_name('team_style'); ?>">
          
          <option value='style1'<?php echo ($team_style=='style1')?'selected':''; ?>>
            Style 1 (default)
          </option> 
          <option value='style2'<?php echo ($team_style=='style2')?'selected':''; ?>>
            Style 2
          </option> 
          
        </select>                
      </label>
</p>
<h3>Please note</h3>
<p>This block will show the Team Posts. <br />You can create the Team Post in left menu->Team Posts->Add New Team Post.</p>

<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;
// Fields
$instance['team_col'] =$new_instance['team_col'];
$instance['team_style'] =$new_instance['team_style'];
$instance['title'] = $new_instance['title'];
$instance['text'] = strip_tags($new_instance['text']);
return $instance;
}

// display widget
function widget($args, $instance) {
extract( $args );

// these are the widget options
$team_col = isset( $instance['team_col'] ) ?$instance['team_col']: '';
$team_style = isset( $instance['team_style'] ) ?$instance['team_style']: '';
$title = isset( $instance['title'] ) ? $instance['title']  : '';
$text = isset( $instance['text'] ) ? esc_attr( $instance['text'] ) : '';
echo $before_widget;
						
        $ridianur_team = new WP_Query(array(  
				'post_type' =>  'team-post',  
				'posts_per_page'  =>'-1'  
			)  
		);
		if ($ridianur_team->have_posts()) {	?> 	
        <!--TEAM START-->
        <div class="team clearfix">
        		
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
                
            	<div class="team-list <?php if ($team_style =='style2') {echo 'team-list-two';} else {echo 'row team-list-one';}?>">
                	<?php  
						$i= 0; 
						if ($ridianur_team->have_posts()) : while  ($ridianur_team->have_posts()) : $ridianur_team->the_post();
						global $post ;
						
					?>
                    
                    <div class="<?php if ($team_col == '3 Columns'){ echo "col-md-4"; } else if ($team_col == '2 Columns'){ echo "col-md-6"; } else { echo "col-md-6 col-lg-3"; }  ?> 
                    ani-width team-col" data-delay="<?php echo $i++*0.2; ?>s">
                    	<div class="port-inner">
                            <div class="port-box"></div>
                            <div class="port-img width-img img-bg" data-background="<?php echo get_the_post_thumbnail_url(); ?>"></div>
                            <div class="img-mask"></div>
                            <div class="port-dbox">
                                <div class="dbox-relative">
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php echo esc_attr( get_post_meta($post->ID, 'tp_post', true)); ?></p>
                                    <ul class="team-sicon">
                                    	<?php if ( get_post_meta($post->ID, 'fb_si', true) != "") { ?>
                                        <li>
                                            <a href="<?php echo esc_url( apply_filters('get_the_content', get_post_meta($post->ID, 'fb_si', true))); ?>">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <?php } ?>
                                        <?php if ( get_post_meta($post->ID, 'twit_si', true) != "") { ?>
                                        <li>
                                            <a href="<?php echo esc_url(  apply_filters('get_the_content', get_post_meta($post->ID, 'twit_si', true))); ?>">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                        <?php } ?>
                                        <?php if ( get_post_meta($post->ID, 'pinterest_si', true) != "") { ?>
                                        <li>
                                            <a href="<?php echo esc_url(  apply_filters('get_the_content', get_post_meta($post->ID, 'pinterest_si', true))); ?>">
                                                <i class="fa fa-pinterest"></i>
                                            </a>
                                        </li>
                                        <?php } ?>
                                        <?php if ( get_post_meta($post->ID, 'gp_si', true) != "") { ?>
                                        <li>
                                            <a href="<?php echo esc_url(  apply_filters('get_the_content', get_post_meta($post->ID, 'gp_si', true))); ?>">
                                                <i class="fa fa-google-plus"></i>
                                            </a>
                                        </li>
                                        <?php } ?>
                                        <?php if ( get_post_meta($post->ID, 'instagram_si', true) != "") { ?>
                                        <li>
                                            <a href="<?php echo esc_url(  apply_filters('get_the_content', get_post_meta($post->ID, 'instagram_si', true))); ?>">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        </li>
                                        <?php } ?>
                                        <?php if ( get_post_meta($post->ID, 'xing_si', true) != "") { ?>
                                        <li>
                                            <a href="<?php echo esc_url(  apply_filters('get_the_content', get_post_meta($post->ID, 'xing_si', true))); ?>">
                                                <i class="fa fa-xing"></i>
                                            </a>
                                        </li>
                                        <?php } ?>
                                        <!--ANOTHER SOCIAL ICON LIST-->
                                        <?php
                                             /* get the icon list */
                                             $socials =  get_post_meta($post->ID, 'another_si',  true);
                                             
                                             if ( ! empty( $socials ) ) {
                                                 foreach( $socials as $social ) {
                                                     echo '
                                                     <li><a href="' . esc_url($social['si_icon_link']) . '"><i class="fa ' . esc_attr($social['si_icon']) . '"></i></a></li>
                                                    ';
                                                 }
                                             }				
                                        ?>
                                        <!--ANOTHER SOCIAL ICON LIST END-->
                                    
                                        <?php if ( get_post_meta($post->ID, 'email_si', true) != "") { ?>
                                        <li>
                                            <a href="mailto:<?php echo esc_attr(apply_filters('get_the_content', get_post_meta($post->ID, 'email_si', true))); ?>">
                                                <i class="fa fa-envelope-o"></i>
                                            </a>
                                        </li>
                                        <?php } ?>
                                    </ul><!--/.team-sicon-->
                                </div><!--/.dbox-relative-->
                            </div><!--/.port-dbox-->
                        </div><!--/.port-inner-->
                    </div><!--.port-item-->
                    
                    
                	
                    <?php endwhile; endif; wp_reset_postdata();?>
                
                   
                
                    
                    
                </div><!--/.row-->
           
        </div><!--/team-->
        <!--TEAM END-->
        <?php } else { ?>
        <div class="spacing80 clearboth"></div>
        <div class="container alert alert-danger">
            <p><?php echo esc_html( 'No Team Post here!
            You need to create Team Post first and display it in Team List Block settings.','cordon_plg' ); ?></p>
        </div>
        <div class="spacing80 clearboth"></div>
        <?php } ?>               
		
<?php 
wp_enqueue_script('imgbg-script',plugins_url( '/js/imgbg.js' , __FILE__ ) , array('jquery'), null, true );
echo $after_widget;
}
}

// register widget outsite widget page
function register_rdn_team_list_widget() {
	global $pagenow;
	if ($pagenow != 'widgets.php') {
	register_widget( 'rdn_team_list_widget' );
	}
}
add_action( 'widgets_init', 'register_rdn_team_list_widget' );



function rdn_team_post_img() {
	if ( is_singular( 'team-post' )) {
		wp_enqueue_script('imgbg-script',plugins_url( '/js/imgbg.js' , __FILE__ ) , array('jquery'), null, true );
	}
}

add_action('wp_enqueue_scripts', 'rdn_team_post_img', 20, 1);
