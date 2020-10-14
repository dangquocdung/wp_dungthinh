<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$loop = studylms_get_events( $orderby, $number );

?>
<?php if ( $loop->have_posts() ) : ?>
<div class="widget-event <?php echo esc_attr($el_class); ?>">
	<?php if ($title!='' || $description!=''): ?>
		<div class="widget-heading">
			<div class="pull-left">
				<?php if ($title!=''): ?>
			        <h3 class="title">
			            <span><?php echo esc_attr( $title ); ?></span>
				    </h3>
			    <?php endif; ?>
			    <?php if ($description!=''): ?>
			        <div class="widget-description">
			            <?php echo esc_attr( $description ); ?>
				    </div>
			    <?php endif; ?>
		    </div>
		    <?php if ( $view_more_text != '' && $view_more_url != '' ): ?>
		    	<a class="btn btn-default btn-border2x btn-sm pull-right btn-more" href="<?php echo esc_url($view_more_url); ?>">
		    		<?php echo esc_attr($view_more_text); ?>
		    	</a>
		    <?php endif; ?>
	    </div>
    <?php endif; ?>
    <div class="widget-content">
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<?php tribe_get_template_part( 'list/single', 'event-list' ) ?>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
	</div>
</div>
<?php endif; ?>