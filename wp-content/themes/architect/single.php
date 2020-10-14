<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package architect
 */
get_header(); ?>


       <!-- Section BreadCrumb -->
    <section>
       <div class="sub-header sub-header-1 sub-header-blog-grid fake-position" <?php if($architect_option['bg_blog'] != ''){ ?> style="background-image:url(<?php echo esc_url($architect_option['bg_blog']['url']) ?>)"<?php } ?>>
         <div class="sub-header-content">
             <h2 class="text-cap white-text"><?php esc_html_e('Single Blog','architect'); ?></h2>
    			<?php if($architect_option['bread-switch']==true){ ?>
                 <ol class="breadcrumb breadcrumb-arc text-cap">
                    <?php if(function_exists('bcn_display'))
                    {
                        bcn_display();
                    }?>
                </ol>
    			<?php } ?>
          </div>
       </div>
    </section><!--  End Section -->
    <!-- content begin -->
    <section id="content" class="padding">
        <div class="container">
            <div class="row">
		          	<?php if($architect_option['blog_layout']=='left_s'){ ?>
		          	<div class="col-md-3">
			            <div class="main-sidebar">            
			               <?php get_sidebar();?>
			            </div>
		          	</div>
		          	<?php } ?>
                    <div class="col-md-<?php if($architect_option['blog_layout']=='full'){echo '12';}else{echo '9';} ?>">
                    	<main id="main" class="site-main padding-top-50" >
                    	<div class="blog-detail <?php if($architect_option['blog_layout']=='left_s'){echo 'blog-list-left';}elseif($architect_option['blog_layout']=='right_s'){echo 'blog-list-right';}else{'';} ?>">
                        <?php while ( have_posts() ) : the_post(); ?>
                        	<h1><?php the_title(); ?></h1>
                        	<div class="latest-blog-post-data text-cap">
                        	<?php if(has_category()) { ?>
		                        <span class="tags"><?php the_category( ', '); ?></span>
		                    <?php } ?>
		                    </div>
		                    <div class="latest-blog-post-date-2  text-cap">
                            	<span class="month"><?php the_time('M') ?></span>
								<span class="day"><?php the_time('d') ?>,</span>
                                <span class="year"><?php the_time('Y') ?></span>
                            </div>
		                    <div class="lastest-news-detail">
	                        <?php $format = get_post_format(); ?>
	                        	<?php if($format=='audio'){ $link_audio = get_post_meta(get_the_ID(),'_cmb_link_audio', true); ?>
	                          		<iframe style="width:100%" src="<?php echo esc_url( $link_audio ); ?>"></iframe>	            
	                          	<?php } elseif($format=='video'){ $link_video = get_post_meta(get_the_ID(),'_cmb_link_video', true); ?>
	                            	<?php echo wp_oembed_get( $link_video ); ?>	          
	                          	<?php } elseif($format=='gallery'){ ?>
	                          		<div class="slide-services">
									    <div class="customNavigation">
									      <a class="btn prev-detail-services"><i class="fa fa-angle-left"></i></a>
									      <a class="btn next-detail-services"><i class="fa fa-angle-right"></i></a>
									    </div>
		                              <div id="sync3" class="owl-carousel owl-detail-services clearfix">
			                              <?php if( function_exists( 'rwmb_meta' ) ) { ?>  
			                                  <?php $images = rwmb_meta( '_cmb_images', "type=image" ); ?>
			                                  <?php if($images){ ?>		                                    
			                                      <?php foreach ( $images as $image ) {  ?>
			                                      <?php $img = $image['full_url']; ?>
			                                        <div class="item"><img src="<?php echo esc_url($img); ?>" alt=""></div> 
			                                      <?php } ?>                   
			                                    
			                                  <?php } ?>
			                                <?php } ?>
		                              </div>    
		                            </div>      
	                          	<?php } elseif ($format=='image'){ ?>
		                          	<?php if( function_exists( 'rwmb_meta' ) ) { ?>  
			                            <?php $images = rwmb_meta( '_cmb_image', "type=image" ); ?>
			                            <?php if($images){ ?>
				                            <?php foreach ( $images as $image ) { ?>
					                            <?php $img = $image['full_url']; ?>
					                            <img src="<?php echo esc_url($img); ?>" class="img-responsive" alt="">
				                            <?php } ?>
			                            <?php } ?>
		                          	<?php } ?>
	                          <?php }else{ ?>
	                              <?php if(get_the_post_thumbnail()){ ?>              
	                                  <?php  the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
	                              <?php } ?>
	                          <?php } ?>
	                        	<?php the_content(); ?>
	                        </div>					
	                        <div class="footer-data text-cap">
					            <div class="tags">
									<p>	<?php esc_html_e('Tags:', 'architect'); ?>
									<?php echo get_the_tag_list( '', ', ' ); ?></p>
								</div>
								<div class="share">
									<p><?php esc_html_e('SHARE:', 'architect'); ?>
									<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"> <?php esc_html_e('Facebook,','architect'); ?></a> 
									<a target="_blank" href="https://twitter.com/home?status=<?php the_permalink(); ?>"><?php esc_html_e('Twitter,','architect'); ?></a>
									<a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><?php esc_html_e('Google+','architect'); ?></a>	
									</p>
								</div>
							</div>	
							<div class="divider-line"></div>	
							<div class="entry_post_navigation"> 
							  <div class="row">
			                    <div class="col-md-6 preview_entry_post">
			                        <?php previous_post_link( '%link', _x( '<span><i class="fa fa-angle-left" aria-hidden="true"></i> Previous</span> <h4> %title </h4>', 'Previous post link', 'architect' ) ); ?>
			                    </div>
			                    <div class="col-md-6 next_entry_post">
			                        <?php next_post_link( '%link', _x( '<span> Next <i class="fa fa-angle-right" aria-hidden="true"></i></span><h4> %title</h4>', 'Next post link', 'architect' ) ); ?>
			                    </div>
			                  </div>
				            </div>
							<?php //the_post_navigation(); ?>
							<?php
								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;
							?>
						<?php endwhile; // End of the loop. ?> 
					</div>
                </main>                  
                </div>
                <?php if($architect_option['blog_layout']=='right_s'){ ?>
		          <div class="col-md-3">
		            <div class="main-sidebar">            
		               <?php get_sidebar();?>
		            </div>
		          </div>
	          	<?php } ?>
            </div>
        </div>
    </section>
    <!-- content close -->
	
<?php get_footer(); ?>
