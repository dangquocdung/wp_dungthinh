<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$items = (array) vc_param_group_parse_atts( $items );

if (!empty($items)): ?>
	<div class="widget widget-contact-info <?php echo esc_attr($el_class); ?>">
		<?php if ($title!=''): ?>
	        <h3 class="widget-title">
	            <span><?php echo esc_attr( $title ); ?></span>
		    </h3>
	    <?php endif; ?>
			<div class="row">
				<?php foreach ($items as $item) { ?>
					<div class="col-xs-12 col-sm-<?php echo (12 / count($items)); ?>">
				    	<?php if ( isset($item['image']) && $item['image'] ): ?>
							<?php $img = wp_get_attachment_image_src($item['image'], 'full'); ?>
							<?php if (isset($img[0]) && $img[0]) { ?>
								<div class="image">
							    	<img src="<?php echo esc_url_raw($img[0]);?>" alt="" />
							    </div>
							<?php } ?>
						<?php endif; ?>
					  	<div class="media-info">
						  	<?php if (isset($item['title']) && $item['title']): ?>
				            	<h3 class="title"><?php echo trim($item['title']); ?></h3>
						    <?php endif ?>
					    	<?php if ( isset($item['description']) ){?>
					    		<div class="content"><?php  echo trim($item['description']); ?></div>
					    	<?php } ?>
					  	</div>
					</div>
				<?php } ?>
			</div>
	</div>
<?php endif; ?>