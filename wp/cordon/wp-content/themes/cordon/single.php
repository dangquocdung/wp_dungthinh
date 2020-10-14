<?php

get_header(); ?>
        
		<!--HOME START-->
		<div id="home" class="clearfix">
			<!--HEADER START-->
			<?php get_template_part( 'loop/menu','normal'); ?>
			<!--HEADER END-->
		</div><!--/home end-->
		<!--HOME END--> 

		<div class="content blog-wrapper">  
			<div class="container-fluid clearfix">
				 <div class="row clearfix">
					<div class="<?php if ( get_post_meta($post->ID, 'post_sidebar', true) == '' ||get_post_meta($post->ID, 'post_sidebar', true) == 'on' ){ echo 'col-md-8';} 
					else { echo 'col-md-12';}?> blog-content">
						
						<!--BLOG POST START-->
						<?php while (have_posts()) : the_post(); ?>
								
						<article id="post-<?php  the_ID(); ?>" <?php  post_class('clearfix blog-post'); ?>>
							 
							 <!--if post is standard-->
							 <?php  if ( get_post_meta($post->ID, 'post_format', true) == ''){ the_post_thumbnail(); }?>
							 <?php  if ( get_post_meta($post->ID, 'post_format', true) == 'post_standard'){ ?>
								<?php the_post_thumbnail( 'full', array( 'class' => 'full-size-img' ) );?>
								<!--if post is gallery-->
								<?php } else if ( get_post_meta($post->ID, 'post_format', true) == 'post_gallery'){ 
								echo '<div class="blog-gallery clearboth clearfix">';
									$cordon_image_ids = get_post_meta(get_the_ID(), 'post_gallery_setting', true);
									$cordon_image_ids = explode( ',', $cordon_image_ids );
									foreach( $cordon_image_ids as $cordon_image_id ) {
										$cordon_image_title  = get_the_title( $cordon_image_id );
										$cordon_image_port = wp_get_attachment_image( $cordon_image_id, 'full' );
										$cordon_imageurl     =   wp_get_attachment_url( $cordon_image_id ); 
										echo '<div>
												<a class="blog-popup-img" href="' . esc_url($cordon_imageurl) . '">
													<span>
													<i class="fa fa-search"></i>
													</span>
													' . $cordon_image_port . '
												</a>
											</div>';
								} echo'</div>';
								
								//if post is slider
								}else if ( get_post_meta($post->ID, 'post_format', true) == 'post_slider'){ ?>
									
                                    <div class="blog-slider ani-slider slider" data-slick='{"autoplaySpeed":<?php if ( ot_get_option( 'blog_slide_delay' ) !='' )
										{echo esc_attr ( ot_get_option( 'blog_slide_delay' ));} else {echo '8000'; } ?> }'>
                                    
									<?php $cordon_simage_ids = get_post_meta(get_the_ID(), 'post_slider_setting', true);
									$cordon_simage_ids = explode( ',', $cordon_simage_ids );
									foreach( $cordon_simage_ids as $cordon_simage_id ) {
										$cordon_simage_port = wp_get_attachment_image( $cordon_simage_id, 'full' );
										$cordon_simageurl     =  wp_get_attachment_url( $cordon_simage_id ); ?>
										<div class="slide">
											<div class="slider-mask" data-animation="slideLeftReturn" data-delay="0.1s"></div>
											<div class="slider-img-bg blog-img-bg" data-animation="fadeIn" data-delay="0.2s" data-animation-duration="0.7s" 
											data-background="<?php echo  esc_url($cordon_simageurl); ?>"></div>
											<div class="blog-slider-box">
												<div class="slider-content"></div>
											</div><!--/.blog-slider-box-->
										</div><!--/.slide-->
									<?php }
									echo'</div>'; 

									
								//if post video	
								} else if ( get_post_meta($post->ID, 'post_format', true) == 'post_video'){ 
								echo'<div class="video"><iframe width="570" height="300" 
								src="'.esc_attr( get_post_meta($post->ID, 'post_video_setting', true)).'?wmode=opaque;rel=0;showinfo=0;controls=0;iv_load_policy=3"></iframe></div>';
								
								//if post audio
								} else if ( get_post_meta($post->ID, 'post_format', true) == 'post_audio'){ ?>
								<div class="audio">
								<?php $cordon_audio =get_post_meta($post->ID, 'post_audio_setting', true);
								echo wp_kses( $cordon_audio, array( 
									'iframe' => array(
											'src' => array(),
											'width' => array(),
											'height' => array(),
											'scrolling' => array(),
											'frameborder' => array(),
										),
								) ); ?>
								</div>
								<?php }?>
							 
							 <div class="spacing10 clearfix"></div>
                             <h2 class="blog-title"><?php the_title(); ?></h2>
                             
							 <ul class="post-detail">
							 	<?php if(has_category()) { ?> 
							 		<li><i class="fa fa-archive"></i> <?php the_category(', '); ?></li>
								<?php }?>
								
								<?php if(get_the_tag_list()) { ?> 
									<li><i class="fa fa-tags"></i>
										<?php the_tags('', ', '); ?>
									</li>
								<?php }?>
								<li><i class="fa fa-calendar-o"></i> <?php echo get_the_date(); ?> </li>
							  </ul>
							 <div class="spacing40 clearfix"></div>
							 
							 
							<?php the_content(); ?>
							<div class="spacing20 clearfix"></div>
							<div class="post-pager clearfix">
							<?php wp_link_pages(); ?>
                            </div>
                            <div class="sharebox"></div><!--/.sharebox-->
                            <div class="border-post clearfix"></div>
                            
                            
                            <!--RELATED POST-->
							<?php get_template_part( 'loop/related', 'post' ); ?>
                            <!--RELATED POST END--> 
                        
                            <?php   if ( !post_password_required() ) { //only show comment if post not password protected
							
							// If comments are open or we have at least one comment, load up the comment template.
                             if (  comments_open() || get_comments_number()) :
                                 comments_template();
								  
                             endif; }?>
							
						</article><!--/.blog-post-->
						<!--BLOG POST END-->	
						
								
						<?php endwhile; ?>
							
							<ul class="pagination clearfix">
								<li><?php previous_post_link('%link', esc_html__('Older posts', 'cordon'), '');?></li>
								<li><?php next_post_link('%link', esc_html__('Newer posts', 'cordon'), '');  ?> </li>
							</ul>
                            
						<div class="spacing40 clearfix"></div>
					</div><!--/.col-md-8-->
					
                    <?php if ( get_post_meta($post->ID, 'post_sidebar', true) == '' ||get_post_meta($post->ID, 'post_sidebar', true) == 'on' ){?>
					<?php get_sidebar(); ?>
                    <?php }?>
                    
				 </div><!--/.row-->
			</div><!--/.container-->
		</div><!--/.blog-wrapper-->


               
    <?php  get_footer(); ?>