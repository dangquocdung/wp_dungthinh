<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$img = wp_get_attachment_image_src($image_icon,'full');
?>
<div class="clearfix widget-newletter <?php echo esc_attr($el_class).' '.(isset($style) ? esc_attr($style) : ''); ?> <?php echo ($title != '') ? 'hastitle' : ''; ?>" >
    <div class="info-left">
	    <?php if ( !empty($img) && isset($img[0]) ): ?>
	    	<div class="icon">
	    		<img src="<?php echo esc_url_raw($img[0]); ?>" alt="">
	    	</div>
	    <?php endif; ?>
	    <div class="info-right">
		    <?php if ($title!=''): ?>
		        <h3 class="widget-title">
		            <span><?php echo esc_attr( $title ); ?></span>
		        </h3>
		    <?php endif; ?>
			<?php if (!empty($description)) { ?>
				<div class="widget-description">
					<?php echo trim( $description ); ?>
				</div>
			<?php } ?>	
		</div>
	</div>
    <div class="widget-content"> 
		<?php
			if ( function_exists( 'mc4wp_show_form' ) ) {
			  	try {
			  	    $form = mc4wp_get_form(); 
					mc4wp_show_form( $form->ID );
				} catch( Exception $e ) {
				 	esc_html_e( 'Please create a newsletter form from Mailchip plugins', 'studylms' );	
				}
			}
		?>
	</div>
</div>