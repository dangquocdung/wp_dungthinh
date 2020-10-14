<?php


function rdn_slider() {
    if ( is_active_widget( false, false, 'rdn_slider', true ) || is_singular( 'rdn-slider' )) {
		wp_enqueue_script('jquery-slick' ,plugins_url( '/js/slick.min.js' , __FILE__ ) , array('jquery'), null, true );
		wp_enqueue_script('cordon-slick-slider-animation' ,plugins_url( '/js/slick-animation.js' , __FILE__ ) , array('jquery'), null, true );
        wp_enqueue_script('slider-script',plugins_url( '/js/slider.js' , __FILE__ ) , array('jquery'), null, true );
		
    }
	if ( is_singular( 'rdn-slider' )) {
		wp_enqueue_script('slider-single-script',plugins_url( '/js/slidersingle.js' , __FILE__ ) , array('jquery'), null, true );
	}
}

add_action('wp_enqueue_scripts', 'rdn_slider', 20, 1);


/**
 * Adds Foo_Widget widget.
 */
class rdn_slider extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array(
			'classname' => 'widget_rdn_slider', 
			'description' => __('Choose which homepage slider to display.'),
			'panels_groups' => array('cordon_builder'),
			'panels_icon' => 'dashicons dashicons-slides'
		);
        parent::__construct('rdn_slider', __('Homepage Slider Block'), $widget_ops);
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract($args);

        $current_page = $this->_get_current_page($instance);
		$s_format = isset( $instance['s_format'] ) ? esc_attr( $instance['s_format'] ) : '';
		$video_link = isset( $instance['video_link'] ) ? esc_attr( $instance['video_link'] ) : '';
		$video_mute = isset( $instance['video_mute'] ) ? esc_attr( $instance['video_mute'] ) : '';
		$youtube_link = isset( $instance['youtube_link'] ) ? esc_attr( $instance['youtube_link'] ) : '';
		$youtube_quality = isset( $instance['youtube_quality'] ) ? esc_attr( $instance['youtube_quality'] ) : '';
		$youtube_mute = isset( $instance['youtube_mute'] ) ? esc_attr( $instance['youtube_mute'] ) : '';
        echo $before_widget;
        ?>
        
        <?php if ($current_page == 'noslider' || $current_page == 'none' || $current_page == '') { ?>
        		<div class="spacing80 clearboth"></div>
        		<div class="container alert alert-danger">
        			<p><?php echo esc_html( 'No slider here!
                    You need to create homepage slider first and display it in Homepage Slider Block settings.','cordon_plg' ); ?></p>
                </div>
                <div class="spacing80 clearboth"></div>
        <?php } else { ?>
        	<!--SLIDER HOME START-->
            <div class="<?php if  ($s_format != 'slider') { echo 'home-video-box'; } else {echo 'bg-on';}?>">
                <div class="home-slider ani-slider slider" data-slick='{"autoplaySpeed": <?php echo esc_attr( get_post_meta($current_page, 'slider_delay',  true));  ?>}'>
                
                    <?php 
                              /* get the slider list array */
                              $lists = get_post_meta($current_page, 'slider_list',  true);
                              
                              if ( ! empty( $lists ) ) {
                                foreach( $lists as $list ) { ?>
                                
                                <div class="slide">
                                    <div class="slider-mask" data-animation="slideUpReturn" data-delay="0.1s"></div>
                                    <div class="slider-img-bg" data-animation="puffIn" data-delay="0.2s" data-animation-duration="0.7s" 
                                    data-background="<?php echo $list['slider_image'];  ?>" 
                                    <?php if ( get_post_meta($current_page, 'para_slide',  true) == 'on'){  ?>
                                    data-stellar-background-ratio="<?php echo esc_attr(get_post_meta($current_page, 'para_ratio',  true));  ?>"
                                    <?php } ?> ></div>
                                    <div class="slider-box container-fluid">
                                        <div class="slider-content">
                                            <div class="slider-hidden">
                                                <h3 class="slider-title" data-animation="fadeInUp" data-delay="0.8s"><?php echo wp_kses_post( $list['title']);  ?></h3>
                                            </div><!--/.slider-hidden-->
                                            
                                            <div class="slider-line"  data-animation="swashIn" data-delay="0.5s"></div>
                                            
                                            <p class="slider-text" data-animation="fadeInDown" data-delay="1s">
                                                <?php echo wp_kses_post( $list['bottom_text']);  ?>
                                            </p>
                                            
                                            <?php if ( $list['slider_link'] != '' && $list['slider_text'] != ''){  ?>
                                                <div class="btn-relative" data-animation="swashIn" data-delay="1.5s" data-animation-duration="1s">
                                                    <a href="<?php echo esc_url($list['slider_link']);  ?>" class="slider-btn"><?php echo esc_attr($list['slider_text']);  ?></a>
                                                </div><!--/.btn-relative-->
                                            <?php } ?>
                                                
                                        </div><!--/.slider-content-->
                                    </div><!--/.slider-box-->
                                </div><!--/.slide-->
            
                                  
                                <?php } } ?>
                    
                    
                </div><!--/.slider-->
            </div><!--/.home-video-box-->
			<!--SLIDER HOME END-->
            
         
        
        <?php 
		if ($s_format == 'slider') {
			wp_enqueue_script('sliderbg-script',plugins_url( '/js/sliderbg.js' , __FILE__ ) , array('jquery'), null, true );
		}
		if ($s_format == 'video') { ?>
			<div class="bg-vid" 
            data-link="<?php echo esc_url($video_link); ?>" 
            data-ambient="<?php if  (  $video_mute != 'off') {  echo "true"; } else { echo "false";}  ?>"></div>
                 
			<?php wp_enqueue_script('jquery-videojs',plugins_url( '/js/video.js' , __FILE__ ) , array('jquery'), null, true );
			wp_enqueue_script('jquery-big-video',plugins_url( '/js/bigvideo.js' , __FILE__ ) , array('jquery'), null, true );
			wp_enqueue_script('cordon-video',plugins_url( '/js/homevid.js' , __FILE__ ) , array('jquery'), null, true );
		}
		
		if ($s_format == 'youtube') { ?>
        	<div class="bg-youtube" data-property="{
                                                        videoURL:'http://www.youtube.com/watch?v=<?php echo esc_attr($youtube_link); ?>', 
                                                        opacity:1, 
                                                        autoPlay:true, 
                                                        containment:'.home-video-box', 
                                                        <?php if  (  $youtube_mute == 'on') {  echo 'mute:true,' ;}  ?>
                                                        optimizeDisplay:true, 
                                                        showControls:false, 
                                                        loop:true, 
                                                        addRaster:false, 
                                                        quality:'<?php if  (  $youtube_quality == '') { echo 'large'; } else {echo $youtube_quality; } ?>', 
                                                        realfullscreen:'true', 
                                                        ratio:'auto'
                                                    }">
            </div>
        	<?php wp_enqueue_script( 'cordon_ytPlayer', plugins_url( '/js/jquery.mb.YTPlayer.js' , __FILE__ ) ,array(),'', 'in_footer');
			wp_enqueue_script( 'cordon_homeyt', plugins_url( '/js/homeyt.js' , __FILE__ ) ,array(),'', 'in_footer');
       }
	  }
        echo $after_widget;
		
		
      } 
	 
    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['page'] = stripslashes($new_instance['page']);
		$instance['s_format'] = strip_tags($new_instance['s_format']);
		$instance['video_link'] = strip_tags($new_instance['video_link']);
		$instance['video_mute'] = strip_tags($new_instance['video_mute']);
		$instance['youtube_link'] = strip_tags($new_instance['youtube_link']);
		$instance['youtube_quality'] = strip_tags($new_instance['youtube_quality']);
		$instance['youtube_mute'] = strip_tags($new_instance['youtube_mute']);
        return $instance;
		
    }


    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( ) );
        $current_page = $this->_get_current_page($instance);
		// Check values
		if( $instance) {
		$s_format = $instance['s_format'];
		$video_link = $instance['video_link'];
		$video_mute = $instance['video_mute'];
		$youtube_link = $instance['youtube_link'];
		$youtube_quality = $instance['youtube_quality'];
		$youtube_mute = $instance['youtube_mute'];
		} else {
		$s_format = '';
		$video_link = '';
		$video_mute ='';
		$youtube_link = '';
		$youtube_quality = '';
		$youtube_mute = '';
		}
?>
    <p><strong><label for="<?php echo $this->get_field_id('page'); ?>"><?php esc_html_e('Choose the homepage slider to display:') ?></label></strong></p>
    <select class="widefat" id="<?php echo $this->get_field_id('page'); ?>" name="<?php echo $this->get_field_name('page'); ?>">
    
        
    <?php
		$query = new WP_Query(array(
			'post_type' => 'rdn-slider'
		));
		if( $query->have_posts() ){ ?>
        <option value="none">none</option>
        
        <?php $postlist = get_posts( 'posts_per_page=-1&post_type=rdn-slider' );
		
        $posts = array();
        foreach ( $postlist as $post ) :
        $page = $post->ID ;
        $option = '<option value="' . $page . '"' . selected($page, $current_page, false) . '>';
        $option .= $post->post_title;
        $option .= '</option>';
        echo $option;
        endforeach;  
		} else {?> 
		 <option value="noslider" selected>No Slider Found</option>
		<?php } wp_reset_postdata();?>
        
    </select>
    
    <p>
      <label for="slide_slider_format">Slider Format: 
        <select class='widefat' id="slide_slider_format"
                name="<?php echo $this->get_field_name('s_format'); ?>" type="text">
          <option value='slider'<?php echo ($s_format=='slider')?'selected':''; ?>>
            Slider with Image Background(Default)
          </option>
          <option value='video'<?php echo ($s_format=='video')?'selected':''; ?>>
            Slider with Video Background
          </option> 
          <option value='youtube'<?php echo ($s_format=='youtube')?'selected':''; ?>>
            Slider with Youtube Background
          </option> 
        </select>                
      </label>
	</p>
    <div class="video-link" <?php if ($s_format == '' || $s_format == 'slider' ||  $s_format == 'youtube'){ echo 'style="display: none;"'; } ?>>
        <label for="<?php echo $this->get_field_id('video_link'); ?>">Video Link</label>
        <p>
          <input class="widefat" id="<?php echo $this->get_field_id('video_link'); ?>" name="<?php echo $this->get_field_name('video_link'); ?>" type="text" value="<?php echo $video_link ?>" />
          <br/>Insert the video link here. Please use only the directlink for the video file in here.
        </p>
        <label for="<?php echo $this->get_field_id('video_mute'); ?>">Video Mute</label>
              <select class='widefat' id="<?php echo $this->get_field_id('video_mute'); ?>"
                    name="<?php echo $this->get_field_name('video_mute'); ?>" type="text">
                  <option value='on'<?php echo ($video_mute=='on')?'selected':''; ?>>
                    Mute On(for loop video)
                  </option>
                  <option value='off'<?php echo ($video_mute=='off')?'selected':''; ?>>
                   Mute Off 
                  </option> 
            </select>   
    </div>
    <div class="youtube-link"  <?php if ( $s_format == '' ||$s_format == 'slider' || $s_format == 'video'){ echo 'style="display: none;"'; } ?> >
    <label for="<?php echo $this->get_field_id('youtube_link'); ?>">Youtube Link</label>
    <p>
      <input class="widefat" id="<?php echo $this->get_field_id('youtube_link'); ?>" name="<?php echo $this->get_field_name('youtube_link'); ?>" type="text" value="<?php echo $youtube_link ?>" />
      <br/>Insert the youtube id here. eg. EMy5krGcoOU
    </p>
     <label for="<?php echo $this->get_field_id('youtube_quality'); ?>">Youtube Video Quality</label>
    <p>
      <input class="widefat" id="<?php echo $this->get_field_id('youtube_quality'); ?>" name="<?php echo $this->get_field_name('youtube_quality'); ?>" type="text" value="<?php echo $youtube_quality ?>" />
      <br/>You can input <b>small, medium, large, hd720, hd1080, highres</b>. Default value is <b>large</b>
    </p>
    <label for="<?php echo $this->get_field_id('youtube_mute'); ?>">Youtube Mute</label>
    	  <select class='widefat' id="<?php echo $this->get_field_id('youtube_mute'); ?>"
                name="<?php echo $this->get_field_name('youtube_mute'); ?>" type="text">
          <option value='on'<?php echo ($youtube_mute=='on')?'selected':''; ?>>
            Mute On(for loop video)
          </option>
          <option value='off'<?php echo ($youtube_mute=='off')?'selected':''; ?>>
           Mute Off 
          </option> 
        </select>   
    </div>
    <p>You can turn on/off the parallax in Homepage Slider ( Left menu or when you creating the slider ).</p>
    <h3 style="margin-top:80px;">Please note:</h3>
    <p>This block will show the Homepage Slider. </p>
    <p>You can create the Homepage Slider in left menu->Homepage Slider->Add Homepage Slider.</p>
    
    <p>You can only use this block/section once in every page.</p>
    <p>If you using the pre-made layout and the slider still doesn't show, try create homepage slider first.</p>
    
    <p>Even you choose video/youtube background you still need to set the images when you creating the slider. The images will appear on touch devices.</p>
    <script type="text/javascript">
	jQuery(document).ready(function($){
	$('#slide_slider_format').change(function () {
    if($(this).val()=="video")
       {
       $('.video-link').show();
	   $('.youtube-link').hide();
       }else if ($(this).val()=="youtube"){
		    $('.video-link').hide();
            $('.youtube-link').show();
       } else {
		   $('.video-link').hide();
            $('.youtube-link').hide();
	   }
    });
	
	
	}); 
	</script>
    <?php 
    }

    function _get_current_page($instance) {
		if ( $instance) {
        	return $instance['page'];
		}
    }
} // class Foo_Widget

// register widget outsite widget page
function register_rdn_slider_widget() {
	global $pagenow;
	if ($pagenow != 'widgets.php') {
	register_widget( 'rdn_slider' );
	}
}
add_action( 'widgets_init', 'register_rdn_slider_widget' );

