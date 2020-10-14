<?php


function rdn_portfolio_wide_script() {
	 if ( is_active_widget( false, false, 'rdn_portfolio_wide_section', true ) ){

?>
	<script type="text/javascript">
	(function ($) {
		"use strict";

			//isotope setting(portfolio)
			var $container = $('.portfolio-body');
			$(window).on("load", function() {
				$container.imagesLoaded(function() {
					$container.isotope();
				});
			});
		
			// filter items when filter link is clicked
			$('.port-filter a').on('click', function() {
				var selector = $(this).attr('data-filter');
				$container.isotope({
					itemSelector: '.port-item',
					filter: selector
				});
				return false;
			});
			
			//adding active state to portfolio filtr
			$(".port-filter a").on('click', function() {
				$(".port-filter a").removeClass("active");
				$(this).addClass("active");
			});	
		})(jQuery);	
	</script>
<?php } 

}
//script for portfolio ajax
add_action( 'wp_footer', 'rdn_portfolio_wide_script',102 );

//create widget
class rdn_portfolio_wide_widget extends WP_Widget {

// constructor
public function __construct() {
        $widget_ops = array(
			'classname' => 'rdn_portfolio_wide_section', 
			'description' => __('Display portfolio section wide.'),
			'panels_groups' => array('cordon_builder'),
			'panels_icon' => 'dashicons dashicons-editor-table'
		);
        parent::__construct('rdn_portfolio_wide_section', __('Portfolio Section Wide Block'), $widget_ops);
    }

// widget form creation

function form($instance) {

// Check values
if( $instance) {
$title = $instance['title'];
$text = $instance['text'];
$f_show = $instance['f_show'];
$p_style = $instance['p_style'];
$port_show = $instance['port_show'];
$p_col = $instance['p_col'];
} else {
$title ='';
$text = '';
$f_show = '';
$port_show = '';
$p_col = '';
$p_style = '';
}

?>

<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php esc_html_e('Title', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
  <i>Leave it blank if you don't want it.</i>
</p>

<p>
  <label for="<?php echo $this->get_field_id('text'); ?>">
    <?php esc_html_e('Small/Below The Title Text:', 'cordon_plg'); ?>
  </label>
  <textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" rows="3" ><?php echo $text ?></textarea>
  <i>Leave it blank if you don't want it.</i>
</p>

<p>
      <label for="<?php echo $this->get_field_id('f_show'); ?>">Show Portfolio Filter: 
        <select class='widefat' id="<?php echo $this->get_field_id('f_show'); ?>"
                name="<?php echo $this->get_field_name('f_show'); ?>" type="text">
          <option value='show'<?php echo ($f_show=='show')?'selected':''; ?>>
            Show(Default)
          </option>
          <option value='hide'<?php echo ($f_show=='hide')?'selected':''; ?>>
            Hide
          </option> 
        </select>                
      </label>
</p>
<p>
      <label for="<?php echo $this->get_field_id('p_style'); ?>">Portfolio Style: 
        <select class='widefat' id="<?php echo $this->get_field_id('p_style'); ?>"
                name="<?php echo $this->get_field_name('p_style'); ?>" type="text">
          <option value='style1'<?php echo ($p_style=='style1')?'selected':''; ?>>
            Style 1(Default)
          </option>
          <option value='style2'<?php echo ($p_style=='style2')?'selected':''; ?>>
            Style 2
          </option> 
        </select>                
      </label>
</p>
<p>
      <label for="<?php echo $this->get_field_id('p_col'); ?>">Choose How Many Columns for Portfolio Items: 
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
<p>
  <label for="<?php echo $this->get_field_id('port_show'); ?>">
    <?php esc_html_e('Portfolio Item to Show:', 'cordon_plg'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('port_show'); ?>" name="<?php echo $this->get_field_name('port_show'); ?>" type="text" value="<?php echo $port_show ?>">
  Choose how many portfolio item you want to show. eg. 8 <br />
   Leave it blank if you want to show all item.
</p>
<h3>Please note</h3>
<p>This block will show the Portfolio Posts. <br />You can create the Portfolio Post in left menu->Portfolio->Add New Portfolio.</p>
<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;
// Fields
$instance['title'] = $new_instance['title'];
$instance['text'] = strip_tags($new_instance['text']);
$instance['f_show'] = strip_tags($new_instance['f_show']);
$instance['p_style'] = strip_tags($new_instance['p_style']);
$instance['port_show'] = strip_tags($new_instance['port_show']);
$instance['p_col'] = strip_tags($new_instance['p_col']);
return $instance;
}

// display widget
function widget($args, $instance) {
extract( $args );

// these are the widget options
$title = isset( $instance['title'] ) ? $instance['title']  : '';
$text = isset( $instance['text'] ) ? esc_attr( $instance['text'] ) : '';
$f_show = isset( $instance['f_show'] ) ? esc_attr( $instance['f_show'] ) : '';
$port_show = isset( $instance['port_show'] ) ? esc_attr( $instance['port_show'] ) : '';
$p_style = isset( $instance['p_style'] ) ? esc_attr( $instance['p_style'] ) : '';
$p_col = isset( $instance['p_col'] ) ? esc_attr( $instance['p_col'] ) : '';

echo $before_widget; ?>

				<?php  
				$ridianur_port = new WP_Query(array(  
						'post_type' =>  'portfolio',  
						'posts_per_page'  =>'-1'  
					)  
				);
				if ($ridianur_port->have_posts()) {
					
                        if ($title !='' || $text!='' ) {?>
                        <div class="content-box-title">
                            <div class="slider-hidden">
                                <h2 class="content-title animated" data-animated="fadeInUp"><?php echo wp_kses_post( $title); ?></h2>
                            </div><!--slider-hidden-->
                            
                            <div class="content-line animated" data-animated="swashIn" data-delay="0.2s"></div>
                            
                            <p class="animated" data-animated="fadeInDown" data-delay="0.4s">
                            <?php echo wp_kses_post($text); ?></p>
                        </div><!--/content-box-title-->
                        <?php } ?>
                        
                        <?php if ($f_show == '' || $f_show=='show'){ ?>
                        <ul class="port-filter center-port-filter">
                            
                                    <?php
                                    $ridianur_taxonomy = 'portfolio_category';
                                    $ridianur_terms = get_terms($ridianur_taxonomy); // Get all terms of a taxonomy
                                    if ( $ridianur_terms && !is_wp_error( $ridianur_terms ) ) : ?>
                                    <li>
                                        <a class="active" href="#" data-filter="*">
                                            <?php if ( function_exists( 'ot_get_option' )&& ot_get_option( 'portfolios_all' ) ) { 
                                            echo esc_attr( ot_get_option( 'portfolios_all' ));} else {esc_html_e('All','cordon_plg'); } ?>
                                        </a>
                                    </li>
                                    <?php    foreach ( $ridianur_terms as $ridianur_term ) { ?>
                                                <li><a data-filter=".<?php echo  strtolower(preg_replace('/[^a-zA-Z]+/', '-', $ridianur_term->name)); ?>" href="#">
                                                <?php echo esc_attr( $ridianur_term->name); ?></a></li>
                                            <?php } 
                                    endif;?>
                        </ul>
                        <?php } ?>
                        
                        
                        
                        <div class="portfolio-body clearfix <?php if ($p_style == 'style2'){ echo "portfolio-type-two"; } ?>">
                            <?php  
                            if ($port_show != ''){ 
                                $args=array(
                                    'post_type' => 'portfolio',
                                    'posts_per_page' => $port_show
                                );
                            } else {
                                $args=array(
                                    'post_type' => 'portfolio',
                                    'posts_per_page' => -1,
                                );
                            } 
                            
                            $ridianur_work = new WP_Query($args);
							$i= 0; 
                            if ($ridianur_work->have_posts()) : while  ($ridianur_work->have_posts()) : $ridianur_work->the_post();
                            global $post ;
							if ($p_col == '3col') {
								$number = 3;
							} else {
								$number = 4;
							}
							
                            ?>
                            
                            <?php $ridianur_terms = get_the_terms( get_the_ID(), 'portfolio_category' ); ?>
                            <div class="<?php if ( ot_get_option( 'port_ani')!='off'){echo 'ani-width';} ?>
							<?php if  ($p_col == '3col') {echo "col-md-4"; } else  {echo "col-md-3"; } ?>
                             port-item <?php foreach ($ridianur_terms as $ridianur_term) { 
                            echo  strtolower(preg_replace('/[^a-zA-Z]+/', '-', $ridianur_term->name)). ' '; } 
                            $ridianur_allClasses = get_post_class(); foreach ($ridianur_allClasses as $ridianur_class) { 
                            echo esc_attr( $ridianur_class . " "); } ?>" id="post-<?php the_ID(); ?>"
                            <?php if ( ot_get_option( 'port_delay')==''){ ?>
                            data-delay="<?php if ( $i >= $number && $i <= $number*2-1) { echo $i++*0.2-0.2*$number;} else if ( $i >= $number*2 & $i <= $number*3-1) { echo $i++*0.2-0.2*$number*2;} 
							else if ( $i >= $number*3 & $i <= $number*4-1) { echo $i++*0.2-0.2*$number*3;} else if ( $i >= $number*4 & $i <= $number*5-1) { echo $i++*0.2-0.2*$number*4;}   
							else if ( $i >= $number*5 & $i <= $number*6-1) { echo $i++*0.2-0.2*$number*5;} else if ( $i >= $number*6 & $i <= $number*7-1) { echo $i++*0.2-0.2*$number*6;} 
							else if ( $i >= $number*7 & $i <= $number*8-1) { echo $i++*0.2-0.2*$number*7;} else if ( $i >= $number*8 & $i <= $number*9-1) { echo $i++*0.2-0.2*$number*8;}
							else if ( $i >= $number*9 & $i <= $number*10-1) { echo $i++*0.2-0.2*$number*9;} else if ( $i >= $number*10 & $i <= $number*11-1) { echo $i++*0.2-0.2*$number*10;} 
							else {echo $i++*0.2;} ?>s" >
                            <?php } else { ?>
                            data-delay="<?php echo $i++*esc_attr(ot_get_option( 'port_delay')); ?>s" >
                            <?php } ?>
                            	<?php if ($p_style != 'style4'){ ?>
                                <div class="port-inner">
                                    <a class="port-link" href="<?php the_permalink(); ?>" ></a>
                                    <div class="port-box"></div>
                                    <div class="port-img width-img img-bg" data-background="<?php echo get_the_post_thumbnail_url(); ?>"></div>
                                    <div class="img-mask"></div>
                                    <div class="port-dbox">
                                        <div class="dbox-relative">
                                            <h3><?php the_title(); ?></h3>
                                            <?php $ridianur_taxonomy = 'portfolio_category'; $args = array('number' => '1',); 
												$ridianur_taxs = wp_get_post_terms($post->ID,$ridianur_taxonomy,$args);  ?> 
                                            <p><?php $ridianur_cats = array();  foreach ( $ridianur_taxs as $ridianur_tax ) { $ridianur_cats[] =   $ridianur_tax->name ;   } 
                                            echo implode(', ', $ridianur_cats);?></p>
                                        </div><!--/.dbox-relative-->
                                    </div><!--/.port-dbox-->
                                </div><!--/.port-inner-->
                                
                                <?php } else { ?>
                                
                                <div class="port-inner">
                                    <div class="img-mask"></div>
                                    <div class="port-img width-img img-bg" data-background="<?php echo get_the_post_thumbnail_url(); ?>"></div>
                                    <a href="<?php the_permalink(); ?>"  class="slider-outer-box">
                                        <div class="slider-center-box ">
                                            <h3><?php the_title(); ?></h3>
                                            <?php $ridianur_taxonomy = 'portfolio_category'; $args = array('number' => '1',); 
												$ridianur_taxs = wp_get_post_terms($post->ID,$ridianur_taxonomy,$args);  ?> 
                                            <p><?php $ridianur_cats = array();  foreach ( $ridianur_taxs as $ridianur_tax ) { $ridianur_cats[] =   $ridianur_tax->name ;   } 
                                            echo implode(', ', $ridianur_cats);?></p>
                                        </div><!--/.slider-center-box-->
                                    </a><!--/.slider-outer-box-->
                                    <div class="slider-padding"></div>
                                </div><!--/.port-inner-->
                                <?php } ?>
                                
                            </div><!--.port-item-->
                           
                            <?php endwhile; endif; wp_reset_postdata();?>
                            
                            
                        </div><!--/.portfolio-body-->
                <?php }  else { ?>
                <div class="spacing80 clearboth"></div>
        		<div class="container alert alert-danger">
        			<p><?php echo esc_html( 'No portfolio here!
                    You need to create portfolio first and display it in Portfolio Section Wide Block settings.','cordon_plg' ); ?></p>
                </div>
                <div class="spacing80 clearboth"></div>
                <?php } ?>
		
<?php 
wp_enqueue_script('imgbg-script',plugins_url( '/js/imgbg.js' , __FILE__ ) , array('jquery'), null, true );
echo $after_widget;
}
}


// register widget outsite widget page
function register_rdn_portfolio_wide_widget() {
	global $pagenow;
	if ($pagenow != 'widgets.php') {
	register_widget( 'rdn_portfolio_wide_widget' );
	}
}
add_action( 'widgets_init', 'register_rdn_portfolio_wide_widget' );


