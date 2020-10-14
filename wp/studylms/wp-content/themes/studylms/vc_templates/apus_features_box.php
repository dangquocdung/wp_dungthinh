<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$items = (array) vc_param_group_parse_atts( $items );
if ( !empty($items) ):
$count = 0;
?>
	<div class="widget-features-box <?php echo esc_attr($el_class); ?> <?php echo esc_attr($style); ?>">
		<?php if ($title!=''): ?>
        <h3 class="widget-title">
            <span><?php echo esc_attr( $title ); ?></span>
	    </h3>
	    <?php endif; ?>
		<div class="content">
			<?php foreach ($items as $item): ?>
				<?php if ( isset($item['image']) && $item['image'] ) $image_bg = wp_get_attachment_image_src($item['image'],'full'); ?>
				<?php $odd = ($count%2 == 1)?'odd':''; ?>
				<?php echo ($count%$number == 0 )?'<div class="row-item clearfix">':''; ?>
				<?php if($number > 1) echo '<div class="'.$odd.' item col-xs-12 col-sm-'.(12/$number).'">'; ?>
				<?php $bg_color = (!empty($item['bg_color'])) ?'style="background-color:'. $item['bg_color'] .';"' : ""; ?>
				<div class="feature-box clearfix" <?php echo trim($bg_color); ?> >
					<div class="feature-box-inner">
						<div class="fbox-icon">
							<div class="fbox-icon-inner">
								<?php if(isset( $image_bg[0]) && $image_bg[0] ) { ?>
										<img class="img" src="<?php echo esc_url_raw($image_bg[0]); ?>" alt="">
								<?php } ?>
								<?php if ( isset($item['image_hover']) && $item['image_hover'] ) $image_bg_hover = wp_get_attachment_image_src($item['image_hover'],'full'); ?>
							    <?php if(isset( $image_bg_hover[0]) && $image_bg_hover[0] ) { ?>
							    	<div class="img-hover">
										<img src="<?php echo esc_url_raw($image_bg_hover[0]); ?>" alt="">
									</div>
								<?php } ?>
							</div>
						</div>
					    <div class="fbox-content ">  
					    	<?php if (isset($item['title']) && trim($item['title'])!='') { ?>
					            <h3 class="ourservice-heading"><?php echo trim($item['title']); ?></h3>
					        <?php } ?>
					         <?php if (isset($item['description']) && trim($item['description'])!='') { ?>
					            <div class="description"><?php echo trim( $item['description'] );?></div>  
					        <?php } ?>
					        <?php if(isset($item['url']) && $item['url'] ){ ?>
							    <a class="readmore" href="<?php echo esc_attr($item['url']); ?>" ><?php echo esc_html__('VIEW MORE','studylms') ?> </a>
						    <?php } ?>
					    </div> 
				    </div>
				</div>
				<?php if($number > 1) echo '</div>'; ?>
				<?php echo (($count%$number == 1 && $count >= ($number - 1) ) || ($count == (count($items)-1) ) )?'</div>':''; ?>
				<?php $count++; ?>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>