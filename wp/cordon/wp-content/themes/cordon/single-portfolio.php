<?php 
/*
*single portfolio page
*/

get_header(); ?>
        
		<!--HOME START-->
		<div id="home" class="clearfix">
			<!--HEADER START-->
			<?php get_template_part( 'loop/menu'); ?>
			<!--HEADER END-->
		</div><!--/home end-->
		<!--HOME END--> 
        
        
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
            
		//gallery at top
		if ( get_post_meta($post->ID, 'port_format', true) == 'port_standard' ){ ?>
      	<div class="content page-content-wrapper">
            <div class="container-fluid clearfix">
                    <div class="row">
                
                        <div class="port-gallery-body port-top-gallery">
                        
                            
                            <?php /* get the gallery list array */
                              $lists = get_post_meta($post->ID, 'gallery_list',  true);
                              
                              if ( ! empty( $lists ) ) {
                                    foreach( $lists as $list ) { ?>
                                <div class="port-item <?php if ($list['gallery_size'] == 'gallery_size_big'){ echo "col-md-8"; } else {echo 'col-md-4';} ?>">

                                    <div class="port-inner">
                                        <a href="<?php echo esc_url ( $list['gallery_port_img'] );  ?>"  class="popup-portfolio port-link slider-outer-box" title="<?php echo esc_attr ($list['title']);  ?>"></a>
                                        <div class="port-box"></div>
                                        <div class="port-img width-img img-bg" data-background="<?php echo esc_url ( $list['gallery_port_img']);  ?>"></div>
                                    </div><!--/.port-inner-->
                                    
                                </div><!--.port-item-->
                                
                                <?php } 
                            } ?>
                       
                            <div class="spacing40"></div>
                        </div><!--/.port-gallery-body-->
                    
                    	<h3 class="single-work-title"><?php the_title();?></h3>
                            
                		<div class="swork-line"></div>
                        
                        <?php the_content (); ?>
                        
                        <?php if ( get_post_meta($post->ID, 'port_item_btn_text', true) !='' && get_post_meta($post->ID, 'port_item_btn_link', true) != ''){?>
                        <div class="spacing40 clearfix"></div>
                        <a class="content-btn" href="<?php echo  esc_url(get_post_meta($post->ID, 'port_item_btn_link', true)); ?>">
                        	<?php echo  esc_attr( get_post_meta($post->ID, 'port_item_btn_text', true)); ?>
                        </a>
                        <?php } ?>
                        
                    </div><!--/.row-->
             </div><!--/.container-fluid-->
		  </div><!--/.content--> 
               
		  <?php }  else { 
              if ( get_post_meta($post->ID, 'port_format', true) == 'port_two' && get_post_meta($post->ID, 'top_type', true) == 'top_content_youtube' ){ ?>
              <!--YOUTUBE BACKGROUND-->
              <div class="bg-youtube" data-property="{videoURL:'http://www.youtube.com/watch?v=<?php echo esc_attr(get_post_meta($post->ID, 'port_youtube_link', true)); ?>', opacity:1, 
              autoPlay:true, containment:'.home-video-box', startAt:0, stopAt:0, mute:true, optimizeDisplay:true, showControls:false, printUrl:true, loop:true, addRaster:false, 
              quality:'<?php if ( get_post_meta($post->ID, 'port_youtube_quality', true) != '') {echo esc_attr(get_post_meta($post->ID, 'port_youtube_quality', true)); } else {echo 'large';} ?>',
               realfullscreen:'true', ratio:'auto'}"></div>
              <!--YOUTUBE BACKGROUND END-->
              <?php } else if ( get_post_meta($post->ID, 'port_format', true) == 'port_two' && get_post_meta($post->ID, 'top_type', true) == 'top_content_video' ){ ?>
            
            	<div class="bg-vid"  data-link="<?php echo esc_url(get_post_meta($post->ID, 'port_video_link', true)); ?>"  data-ambient="true"></div>
              <?php } ?>
              <div class="page-content-wrapper">
              	<div class="home-video-box">
                  <!--WORK SLIDER START-->
                  <div class="home-slider ani-slider slider" data-slick='{"autoplaySpeed": 8000}'>
                      
                      <div class="slide">
                          <div class="slider-mask" data-animation="slideUpReturn" data-delay="0.1s"></div>
                          <div class="slider-img-bg" data-animation="puffIn" data-delay="0.2s" data-animation-duration="0.7s" 
                          data-background="<?php echo esc_url(get_post_meta($post->ID, 'port_slider_setting', true)); ?>" data-stellar-background-ratio="0.8"></div>
                          <div class="slider-box container-fluid">
                              <div class="slider-content left-box-slider">
                                  <div class="slider-hidden">
                                      <h3 class="slider-title" data-animation="fadeInUp" data-delay="0.8s"><?php the_title(); ?></h3>
                                  </div><!--/.slider-hidden-->
                                  
                                  <div class="slider-line"  data-animation="swashIn" data-delay="0.5s"></div>
                                  
                                  <p class="slider-text" data-animation="fadeIn" data-delay="1s">
                                      <?php echo esc_attr( get_post_meta($post->ID, 'port_text_bottom',  true));  ?>
                                  </p>
                                 
                              </div><!--/.slider-content-->
                          </div><!--/.slider-box-->
                      </div><!--/.slide-->
                     
                  </div><!--/.home-slider-->
                  <!--WORK SLIDER END-->
                 </div> 
              
              
                   <div class="content">
                        <div class="container-fluid clearfix">
                            <div class="row">
                                <div class="col-lg-6">
                                
                                    <?php the_content ();?>
                                    
                                    <?php if ( get_post_meta($post->ID, 'port_item_btn_text', true) !='' && get_post_meta($post->ID, 'port_item_btn_link', true) != ''){?>
                                    <div class="spacing40 clearfix"></div>
                                    <a class="content-btn" href="<?php echo  esc_url(get_post_meta($post->ID, 'port_item_btn_link', true)); ?>">
                                        <?php echo  esc_attr( get_post_meta($post->ID, 'port_item_btn_text', true)); ?>
                                    </a>
                                    <?php } ?>
                                    <div class="spacing40 clearfix"></div>
                                </div><!--/.col-lg-6-->
                            
                                <div class="col-lg-6">
                                    <div class="port-gallery-body">
                                    
                                        <?php /* get the gallery list array */
										  $lists = get_post_meta($post->ID, 'gallery_list',  true);
										  
										  if ( ! empty( $lists ) ) {
												foreach( $lists as $list ) { ?>
											<div class="port-item <?php if ($list['gallery_size'] == 'gallery_size_big'){ echo "col-md-12"; } else {echo 'col-md-6';} ?>">
			
												<div class="port-inner">
													<a href="<?php echo esc_url ( $list['gallery_port_img']);  ?>"  class="popup-portfolio port-link slider-outer-box" 
                                                    title="<?php echo esc_attr($list['title'] );  ?>"></a>
													<div class="port-box"></div>
													<div class="port-img width-img img-bg" data-background="<?php echo esc_attr ( $list['gallery_port_img']);  ?>"></div>
												</div><!--/.port-inner-->
												
											</div><!--.port-item-->
											
											<?php } 
										} ?>
                                    
                                    <div class="spacing40"></div>
                                    </div><!--/.port-gallery-body-->
                                </div><!--/.col-lg-6-->
                            
                            </div><!--/.row-->
                            
                        </div><!--/.container-fluid-->
                    </div><!--/.content-->
                </div>
          <?php }
				
		  endwhile; endif; ?>
               
			
        
		  <?php // get the custom post type's ridianur_taxonomy terms
          $custom_taxterms = wp_get_object_terms( $post->ID, 'portfolio_category', array('fields' => 'ids') );
          // arguments
          $args = array(
              'post_type' => 'portfolio',
              'post_status' => 'publish',
              'posts_per_page' => 4, 
              'orderby' => 'rand',
              'tax_query' => array(
                  array(
                      'taxonomy' => 'portfolio_category',
                      'field' => 'id',
                      'terms' => $custom_taxterms
                      )
                  ),
              'post__not_in' => array ($post->ID),
          );
          $related_items = new WP_Query( $args );
          // loop over query
          if ($related_items->have_posts()) : $i =1; ?>
           <div class="content gray-bg">   
              <div class="container-fluid">
                  <div class="other-portfolio clearfix">
                      <h3 class="op-title"><?php if ( function_exists( 'ot_get_option' )&& ot_get_option( 'other_port_title' ) !='')
                      { echo ot_get_option( 'other_port_title' ); } else {esc_html_e('Other portfolio','cordon');} ?></h3>
                      <p class="op-sub"><?php if ( function_exists( 'ot_get_option' )&& ot_get_option( 'other_port_sub' ) !='')
                      { echo ot_get_option( 'other_port_sub' ); } else {esc_html_e('See our other portfolio','cordon');} ?></p>
                      
                      <?php while ( $related_items->have_posts() ) : $related_items->the_post(); ?>
                      
                      <div class="col-md-3 port-item development ani-width" data-delay="<?php echo esc_attr ( $i++*0.2 ); ?>s">
                      
                          <div class="port-inner">
                              <a href="<?php the_permalink(); ?>" class="port-link"></a>
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
                      </div><!--.port-item-->
                         
                      <?php endwhile; ?>
                      
                      
                  </div><!--/.other-portfolio-->  
              </div><!--/container-fluid-->
          </div>
          <?php  endif; wp_reset_postdata(); ?> 
      
          <?php if (get_post_meta($post->ID, 'port_banner', true)=='on') { ?>
          <div class="table-box single-port-table clearfix <?php if ( get_post_meta($post->ID, 'banner_scheme', true)=='color') { echo'color-bg';} 
          else if ( get_post_meta($post->ID, 'banner_scheme', true)=='dark') { echo'dark-page';}?>">
          
              
              <?php if (get_post_meta($post->ID, 'banner_position', true)!='left') { ?>
              
              <div class="table-cell-box table-content">
                  <h3><?php echo  wp_kses_post(get_post_meta($post->ID, 'port_text_banner', true)); ?></h3>
                  <div class="spacing40 clearboth"></div>
                  
                  <?php if (get_post_meta($post->ID, 'banner_btn_text', true)!='' && get_post_meta($post->ID, 'banner_btn_link', true) !='') { ?>
                  <a class="content-btn" href="<?php echo  esc_url(get_post_meta($post->ID, 'banner_btn_link', true)); ?>">
                      <?php echo  esc_attr(get_post_meta($post->ID, 'banner_btn_text', true)); ?>
                  </a>
                  <?php } ?>
              </div><!--/.table-cell-box--> 
              
              <div class="table-cell-box">
                  <div class="img-bg full-img-bg" data-background="<?php echo  esc_attr(get_post_meta($post->ID, 'port_img_banner', true)); ?>"></div>
                  <div class="cell-box-padding"></div>
              </div><!--/.table-cell-box-->
              
              <?php }  else { ?>
              
              <div class="table-cell-box">
                  <div class="img-bg full-img-bg" data-background="<?php echo  esc_attr(get_post_meta($post->ID, 'port_img_banner', true)); ?>"></div>
                  <div class="cell-box-padding"></div>
              </div><!--/.table-cell-box-->
              
              <div class="table-cell-box table-content">
                  <h3><?php echo  wp_kses_post(get_post_meta($post->ID, 'port_text_banner', true)); ?></h3>
                  
                  
                  <?php if (get_post_meta($post->ID, 'banner_btn_text', true)!='' && get_post_meta($post->ID, 'banner_btn_link', true) !='') { ?>
                  <div class="spacing20 clearboth"></div>
                  <a class="content-btn" href="<?php echo  esc_url(get_post_meta($post->ID, 'banner_btn_link', true)); ?>">
                      <?php echo  esc_attr(get_post_meta($post->ID, 'banner_btn_text', true)); ?>
                  </a>
                  <?php } ?>
              </div><!--/.table-cell-box--> 
              
              
              <?php } ?>    
          </div><!--/.table-box-->
          <?php } ?>  
        
 <?php  get_footer(); ?> 