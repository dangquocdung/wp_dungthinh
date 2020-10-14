<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$time = strtotime( $input_datetime );
$img = wp_get_attachment_image_src($image,'full');
?>
<div class="banner-countdown-widget <?php echo esc_attr($el_class.' '.$style_widget); ?>">
	<div class="row">
		<?php if ( !empty($img) && isset($img[0]) ): ?>
			<div class="col-sm-3 col-xs-12">
	    		<img src="<?php echo esc_url_raw($img[0]); ?>" alt="">
	    	</div>
	    <?php endif; ?>
	    <div class="col-sm-5 col-xs-12">
			<?php if(wpb_js_remove_wpautop( $content, true )){ ?>
				<h3 class="title"><?php echo wpb_js_remove_wpautop( $content, true ); ?></h3>
			<?php } ?>
			<?php if( isset($descript) && $descript ) : ?>
				<div class="des" ><?php echo trim($descript); ?></div>
			<?php endif; ?>	
			<?php if(isset($url) && $url ){ ?>
			    <a class="btn btn-default btn-border2x btn-sm" href="<?php echo esc_attr($url); ?>" ><?php echo esc_html__('View Details','studylms') ?> </a>
		    <?php } ?>
		</div>
		<div class="col-sm-4 col-xs-12">
		   	<?php if( isset($setting) && $setting ) : ?>
				<div class="setting" ><?php echo trim($setting); ?></div>
			<?php endif; ?>	
			<div class="countdown-wrapper">
			    <div class="apus-countdown" data-time="timmer"
			         data-date="<?php echo date('m',$time).'-'.date('d',$time).'-'.date('Y',$time).'-'. date('H',$time) . '-' . date('i',$time) . '-' .  date('s',$time) ; ?>">
			    </div>
			</div>
		</div>
	</div>
</div>